<?php

namespace App\Modules\InventoryModule\Services;

use App\Modules\ProductModule\Contracts\ProductCatalogContract;
use App\Modules\SupplierModule\Contracts\SupplierCatalogContract;

class InventoryCatalog
{
    public function __construct(
        private readonly ProductCatalogContract $productsCatalog,
        private readonly SupplierCatalogContract $suppliersCatalog,
    ) {
    }

    public function products(): array
    {
        return $this->productsCatalog->all();
    }

    public function suppliers(): array
    {
        return $this->suppliersCatalog->all();
    }
}