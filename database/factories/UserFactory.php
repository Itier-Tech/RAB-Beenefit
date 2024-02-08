<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{

    protected $model = User::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'full_name' => $this->fake()->name(),
            'phone' => $this->fake()->phoneNumber(),
            'email' => $this->fake()->unique()->safeEmail(),
            'password' => bcrypt('password'), // Change 'password' to your desired default password
            'company_name' => $this->fake()->company(),
            'company_address' => $this->fake()->address(),
            'company_phone' => $this->fake()->phoneNumber(),
            'company_logo_path' => $this->fake()->imageUrl(), // You might need to adjust this based on your logic for storing images
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
