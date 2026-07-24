<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create 5 dummy users
        User::factory()->count(5)->create();

        // Run other seeders
        $this->call([
            ProductSeeder::class,
            OrderSeeder::class,
        ]);

       
    }
}
