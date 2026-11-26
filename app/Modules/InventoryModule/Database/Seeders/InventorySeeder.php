<?php

namespace App\Modules\InventoryModule\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\InventoryModule\Models\StockMovement;
use App\Modules\ProductModule\Contracts\ProductCatalogContract;
use App\Modules\SupplierModule\Contracts\SupplierCatalogContract;

class InventorySeeder extends Seeder
{
    public function run(): void
    {
        $products = app(ProductCatalogContract::class)->all();
        $suppliers = app(SupplierCatalogContract::class)->all();

        $supplierId = $suppliers[0]['id'] ?? null;

        foreach ($products as $product) {
            StockMovement::firstOrCreate(
                [
                    'product_id' => $product['id'],
                    'type' => StockMovement::TYPE_IN,
                    'notes' => 'Stok awal',
                ],
                [
                    'supplier_id' => $supplierId,
                    'quantity' => 20,
                    'movement_date' => now()->toDateString(),
                ]
            );
        }
    }
}
