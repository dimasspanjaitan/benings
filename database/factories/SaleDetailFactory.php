<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SaleDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'sale_id' => $this->faker->numberBetween(1,1000),
            'product_id' => $this->faker->numberBetween(1,3),
            'unit' => 'pcs',
            'qty' => $this->faker->numberBetween(1, 10),
            'price' => $this->faker->randomElement([75000, 90000, 110000, 150000, 180000, 200000, 210000, 350000]),
        ];
    }
}
