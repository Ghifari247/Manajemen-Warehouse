<?php

namespace App\Modules\SupplierModule\Database\Factories;

use App\Modules\SupplierModule\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\Factory;

class SupplierFactory extends Factory
{
    protected $model = Supplier::class;

    public function definition(): array
    {
        return [
            'code' => 'SUP' . fake()->unique()->numerify('#####'),
            'name' => fake()->company(),
            'phone' => fake()->numerify('08##########'),
            'email' => fake()->companyEmail(),
            'address' => fake()->address(),
        ];
    }
}