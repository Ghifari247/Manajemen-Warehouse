<?php

namespace App\Modules\InventoryModule\Database\Factories;

use App\Modules\InventoryModule\Models\StockMovement;
use Illuminate\Database\Eloquent\Factories\Factory;

class StockMovementFactory extends Factory
{
    protected $model = StockMovement::class;

    public function definition(): array
    {
        return [
            'product_id' => 1,
            'supplier_id' => null,
            'type' => StockMovement::TYPE_IN,
            'quantity' => fake()->numberBetween(1, 50),
            'movement_date' => fake()->date(),
            'notes' => fake()->sentence(),
        ];
    }

    public function in(): static
    {
        return $this->state(fn () => ['type' => StockMovement::TYPE_IN]);
    }

    public function out(): static
    {
        return $this->state(fn () => ['type' => StockMovement::TYPE_OUT, 'supplier_id' => null]);
    }
}
