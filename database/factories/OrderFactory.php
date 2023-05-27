<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'code' => fake()->numerify('OR-######'),
            'full_name' => fake()->name(),
            'phone_number' => fake()->phoneNumber(),
            'email' => fake()->email(),
            'shipping_address' => fake()->address(),
        ];
    }
}
