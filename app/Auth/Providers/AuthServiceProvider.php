<?php

namespace App\Auth\Providers;

use App\Admin\Roles\Models\Role;
use App\Users\Models\User;
use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Cache;

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
            'read.users.updated_at',
        ];

        foreach ($permissions as $permission) {
            $gate->define($permission, function(User $user, int $id = null) use ($permission): bool {
                $user = Cache::remember('user.roles.permissions', 60, function() use ($user) {
                    $user->load('roles.permissions:id,role_id,name');

                    return $user;
                });

                /** @var Role $role */
                foreach ($user->roles as $role) {
                    $rolePermissions = $role->permissions->keyBy('name');

                    if ($role->ignore_columns && substr_count($permission, '.') > 1) {
                        $permission = substr($permission, 0, strrpos($permission, '.'));
                    }

                    if (!empty($id) && !$role->ignore_id) {
                        if (isset($rolePermissions["{$permission}.{$id}"])) return true;
                        continue;
                    }

                    if (isset($rolePermissions[$permission])) return true;
                }

                return false;
            });
        }
    }
}
