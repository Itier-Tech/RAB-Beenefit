<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Item>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'item_name' => fake()->word(),
            'buy_price' => fake()->randomNumber(6, false),
            'sell_price' => fake()->randomNumber(6, false),
            'category' => fake()->word(),
            'unit' => fake()->randomElement(['kg', 'g', 'pcs', 'm', 'cm']),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
