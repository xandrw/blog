<?php

namespace App\Admin\Roles\Database\Factories;

use App\Admin\Roles\Models\Permission;
use App\Admin\Roles\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;

class PermissionFactory extends Factory
{
    protected $model = Permission::class;

    public function definition(): array
    {
        return [
            'role_id' => $this->faker->randomElement(Role::all('id')->pluck('id')->toArray()),
            'name' => $this->faker->name()
        ];
    }
}
