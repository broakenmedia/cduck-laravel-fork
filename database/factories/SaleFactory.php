<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class SaleFactory extends Factory
{
    public function definition(): array
    {
        //I want to use real products for the purposes of the demo, it looks nicer. In reality it'd probably just be the factory.
        $product = Product::inRandomOrder()->first() ?? Product::factory()->create();
        $profitMargin = $product !== null ? $product->profit_margin : 0.00;
        $quantity = $this->faker->randomDigitNotZero();
        $unitCost = $this->faker->randomFloat(2, 1, 100);

        $cost = $quantity * $unitCost;
        $price = ($cost / (1 - $profitMargin)) + config('psyduck.shipping.countries.UK', 0.00);

        return [
            'product_id' => $product->id,
            'quantity' => $quantity,
            'unit_cost' => $unitCost,
            'sale_price' => $price,
            //I want to use real users for the purposes of the demo, it looks nicer. In reality it'd probably just be the factory.
            'sales_agent_id' => (User::inRandomOrder()->first() ?? User::factory()->create())->id,
        ];
    }
}
