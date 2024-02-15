<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::inRandomOrder()->first()->user_id,
            'client_name' => fake()->name(),
            'project_address' => fake()->address(),
            'project_name' => fake()->word(),
            'budget' => fake()->randomNumber(8, false),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
