<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'full_name' => fake()->name(),
            'phone' => fake()->phoneNumber(),
            'email' => fake()->unique()->safeEmail(),
            'password' => bcrypt('password'), // Change 'password' to your desired default password
            'company_name' => fake()->company(),
            'company_address' => fake()->address(),
            'company_phone' => fake()->phoneNumber(),
            'company_logo_path' => fake()->imageUrl(),
            'bank_dest' => fake()->compamy(),
            'account_number' => fake()->phoneNumber(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
