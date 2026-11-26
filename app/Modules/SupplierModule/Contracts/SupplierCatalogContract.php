<?php

namespace App\Modules\SupplierModule\Contracts;

interface SupplierCatalogContract
{
    public function findById(int $supplierId): ?array;

    public function all(): array;
}