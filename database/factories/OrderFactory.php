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
    public function definition()
    {
        $created_at = fake()->dateTimeBetween('-30 days', 'now');
        return [
            'vehicle_id' => 1,
            'user_id' => 2,
            'c_name' => fake('ar_EG')->name(),
            'c_mobile' => fake()->numerify('########'),
            'order_datetime' => fake()->dateTime(),
            'notes' => fake()->realText(30),
            'amount' => fake()->numberBetween(8, 40),
            'created_at' => $created_at,
        ];
    }
}
