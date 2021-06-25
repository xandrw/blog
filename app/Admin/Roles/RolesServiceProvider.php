<?php

namespace App\Admin\Roles;

use App\Admin\Roles\Models\Role;
use App\Users\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\ServiceProvider;

class RolesServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/Database/Migrations');

        User::resolveRelationUsing('roles', function(User $user): BelongsToMany {
            return $user->belongsToMany(Role::class);
        });
    }
}
