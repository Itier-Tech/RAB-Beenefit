<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Project;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Rab>
 */
class RabFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'project_id' => Project::inRandomOrder()->first()->project_id,
            'status' => fake()->randomNumber(1, true),
            'rab_discount' => fake()->randomNumber(2, false),
            'total_price' => fake()->randomNumber(8, false),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
