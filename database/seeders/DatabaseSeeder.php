<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        User::factory()->create([
            'name' => 'Sales Agent Sandy',
            'email' => 'sales@coffee.shop',
        ]);

        User::factory()->create([
            'name' => 'Sales Agent Smith',
            'email' => 'smith.sales@coffee.shop',
        ]);

        $this->call([
            ProductSeeder::class,
            SaleSeeder::class,
        ]);
    }
}
