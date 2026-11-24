<?php

namespace App\Modules\ProductModule\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\ProductModule\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::create([
            'sku' => 'BRG001',
            'name' => 'Laptop ASUS',
            'description' => 'Laptop untuk kebutuhan kantor',
            'unit' => 'unit',
            'minimum_stock' => 5,
        ]);

        Product::create([
            'sku' => 'BRG002',
            'name' => 'Mouse Logitech',
            'description' => 'Mouse wireless',
            'unit' => 'pcs',
            'minimum_stock' => 10,
        ]);

        Product::create([
            'sku' => 'BRG003',
            'name' => 'Keyboard Mechanical',
            'description' => 'Keyboard untuk komputer',
            'unit' => 'pcs',
            'minimum_stock' => 3,
        ]);
    }
}
