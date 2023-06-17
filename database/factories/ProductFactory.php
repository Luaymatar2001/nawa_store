<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Product::class;
    public function definition(): array
    {

        return [
            'name' => fake()->word,
            'description' => fake()->sentence,
            'short_description' => fake()->words,
            'price' => fake()->randomFloat(10, 10.0, 1000.0),
            'compare_price' => fake()->randomFloat(10, 10.0, 1000.0),
            'image' => fake()->sentence,
            'status' => fake()->randomElement(['draft', 'active', 'archived']),
            'category_id' => fake()->numberBetween(1)
        ];
    }
}
