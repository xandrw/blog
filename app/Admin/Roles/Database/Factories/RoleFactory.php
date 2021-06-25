<?php

namespace App\Admin\Roles\Database\Factories;

use App\Admin\Roles\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoleFactory extends Factory
{
    protected $model = Role::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'description' => $this->faker->name(),
            'ignore_id' => $this->faker->boolean(),
            'ignore_columns' => $this->faker->boolean()
        ];
    }
}
