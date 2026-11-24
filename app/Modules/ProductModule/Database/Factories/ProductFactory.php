<?php

namespace App\Modules\ProductModule\Database\Factories;

use App\Modules\ProductModule\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        return [
            'sku' => 'BRG' . fake()->unique()->numerify('#####'),
            'name' => fake()->words(2, true),
            'description' => fake()->sentence(),
            'unit' => fake()->randomElement([
                'pcs',
                'unit',
                'box',
                'pack'
            ]),
            'minimum_stock' => fake()->numberBetween(1, 20),
        ];
    }
}
