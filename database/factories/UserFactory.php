<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

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
            'name' => $this->faker->name,
            'telegram_id' => $this->faker->unique()->numberBetween(100000000, 999999999), // Ensure a unique 9-digit number
            'subscribed' => true, // User is subscribed by default
        ];
    }
}
