<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product_name' => fake()->words(3, true),
            'product_description' => fake()->sentence(),
            'quantity' => fake()->numberBetween(1, 100),
            'price' => fake()->randomFloat(2, 100, 5000),
            'status' => true,
        ];
    }
}
