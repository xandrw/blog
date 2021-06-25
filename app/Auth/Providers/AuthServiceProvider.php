<?php

namespace App\Auth\Providers;

use App\Users\Models\User;
use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    public function boot(Gate $gate)
    {
        $this->registerPolicies();

        $this->loadRoutesFrom(__DIR__ . '/../routes.php');

        $this->loadViewsFrom(__DIR__ . '/../Views', 'Auth');

        // defined module permissions
        $permissions = [
            'create.users',
            'read.users',
            'update.users',
            'delete.users',
            'read.users.id',
            'read.users.name',
            'read.users.email',
            'read.users.created_at',
        ];

        // user roles
        $roles = [
            'admin' => [
                'ignore_id' => true,
                'ignore_columns' => true,
                'permissions' => [
                    'read.users' => true,
                    'read.users.1' => true
                ]
            ],
            // 'moderator' => [
            //     'ignore_id' => false,
            //     'permissions' => [
            //         'read:users:id' => true,
            //         'read:users:name' => true,
            //         'read:users:email' => true,
            //         'read:users:created_at' => true
            //     ]
            // ]
        ];

        foreach ($permissions as $permission) {
            $gate->define($permission, function(User $user, int $id = null) use ($permission, $roles): bool {
                foreach ($roles as $config) {
                    [
                        'ignore_id' => $ignoreId,
                        'ignore_columns' => $ignoreColumns,
                        'permissions' => $userPermissions
                    ] = $config;

                    if ($ignoreColumns && substr_count($permission, '.') > 1) {
                        $permission = substr($permission, 0, strrpos($permission, '.'));
                    }

                    if (!empty($id) && empty($ignoreId)) {
                        if (isset($userPermissions["{$permission}.{$id}"])) return true;
                    }

                    if (isset($userPermissions[$permission])) return true;
                }

                return false;
            });
        }
    }
}
