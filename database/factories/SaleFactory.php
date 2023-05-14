<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class SaleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween(1,5),
            'status' => $this->faker->numberBetween(1,5),
            'total' => $this->faker->numberBetween(5000, 100000),
            'sale_date' => now(), // password
            'code' => Str::random(10),
            'description' => $this->faker->sentence( 6, true),
        ];
    }
}
