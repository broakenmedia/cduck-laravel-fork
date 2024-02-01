<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class SaleFactory extends Factory
{
    public function definition(): array
    {
        $product = Product::inRandomOrder()->first();
        $profitMargin = $product !== null ? $product->profit_margin : 0.00;
        $quantity = $this->faker->randomDigitNotZero();
        $unitCost = $this->faker->randomFloat(2, 1, 100);

        $cost = $quantity * $unitCost;
        $price = $cost / (1 - $profitMargin) + config('psyduck.shipping.countries.UK', 0.00);

        return [
            'product_id' => $product->id,
            'quantity' => $quantity,
            'unit_cost' => $unitCost,
            'sale_price' => $price
        ];
    }
}
