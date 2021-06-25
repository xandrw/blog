<?php

namespace Database\Seeders;

use App\Admin\Roles\Models\Permission;
use App\Admin\Roles\Models\Role;
use App\Users\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        (new DatabaseSeeder)->run();

        $user = (new User)->create([
            'name' => 'Admin',
            'email' => 'admin@blog.test',
            'password' => 'password'
        ]);

        $role = (new Role)->create([
            'name' => 'Admin',
            'description' => 'Blog administrator',
            'ignore_id' => true,
            'ignore_columns' => true
        ]);

        $user->roles()->attach($role);

        $permissions = [
            'create.users',
            'read.users',
            'update.users',
            'delete.users'
        ];

        foreach ($permissions as $permissionName) {
            (new Permission)->create([
                'role_id' => $role->id,
                'name' => $permissionName
            ]);
        }
    }
}
