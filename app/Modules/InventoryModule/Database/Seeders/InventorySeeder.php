<?php

namespace App\Modules\InventoryModule\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\InventoryModule\Models\StockMovement;
use App\Modules\ProductModule\Models\Product;
use App\Modules\SupplierModule\Models\Supplier;

class InventorySeeder extends Seeder
{
    public function run(): void
    {
        $supplier = Supplier::first();

        foreach (Product::all() as $product) {
            StockMovement::create([
                'product_id' => $product->id,
                'supplier_id' => $supplier?->id,
                'type' => StockMovement::TYPE_IN,
                'quantity' => 20,
                'movement_date' => now()->toDateString(),
                'notes' => 'Stok awal',
            ]);
        }
    }
}
