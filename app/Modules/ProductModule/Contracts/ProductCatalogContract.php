<?php

namespace App\Modules\ProductModule\Contracts;

interface ProductCatalogContract
{
    public function findById(int $productId): ?array;
}