<?php

namespace App\Modules\SupplierModule\Services;

use App\Modules\SupplierModule\Contracts\SupplierCatalogContract;
use App\Modules\SupplierModule\Models\Supplier;

class SupplierCatalogService implements SupplierCatalogContract
{
    public function findById(int $supplierId): ?array
    {
        $supplier = Supplier::find($supplierId);

        if (!$supplier) {
            return null;
        }

        return [
            'id' => $supplier->id,
            'code' => $supplier->code,
            'name' => $supplier->name,
            'phone' => $supplier->phone,
            'email' => $supplier->email,
        ];
    }

    public function all(): array
    {
        return Supplier::orderBy('name')
            ->get(['id', 'code', 'name'])
            ->toArray();
    }
}