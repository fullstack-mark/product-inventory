<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 3; $i++) {

            Order::create([
                'user_id' => User::inRandomOrder()->value('id'),
                'product_id' => Product::inRandomOrder()->value('id'),
                'price' => Product::inRandomOrder()->value('price'),
            ]);

        }
    }
}

