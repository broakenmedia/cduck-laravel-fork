<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'profit_margin' =>  $this->faker->randomFloat(2, 0, 50)
        ];
    }
}
