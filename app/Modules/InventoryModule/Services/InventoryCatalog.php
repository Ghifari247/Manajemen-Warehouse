<?php

namespace App\Modules\InventoryModule\Services;

use App\Modules\ProductModule\Models\Product;
use App\Modules\SupplierModule\Models\Supplier;

/**
 * Pembaca daftar barang & supplier khusus untuk modul Inventory.
 * Dibuat di sini agar contract Product/Supplier yang sudah ada tidak perlu diubah.
 */
class InventoryCatalog
{
    public function products(): array
    {
        return Product::orderBy('name')
            ->get(['id', 'sku', 'name', 'unit', 'minimum_stock'])
            ->map(fn (Product $p) => [
                'id' => $p->id,
                'sku' => $p->sku,
                'name' => $p->name,
                'unit' => $p->unit,
                'minimum_stock' => $p->minimum_stock,
            ])
            ->all();
    }

    public function suppliers(): array
    {
        return Supplier::orderBy('name')
            ->get(['id', 'code', 'name'])
            ->map(fn (Supplier $s) => [
                'id' => $s->id,
                'code' => $s->code,
                'name' => $s->name,
            ])
            ->all();
    }
}
