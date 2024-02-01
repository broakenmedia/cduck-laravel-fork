<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::insert([
            [
                'name' => 'Gold',
                'profit_margin' => 0.25,
            ],
            [
                'name' => 'Arabic',
                'profit_margin' => 0.15,
            ],
        ]);
    }
}
