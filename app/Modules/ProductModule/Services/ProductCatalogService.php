<?php

namespace App\Modules\ProductModule\Services;

use App\Modules\ProductModule\Contracts\ProductCatalogContract;
use App\Modules\ProductModule\Models\Product;

class ProductCatalogService implements ProductCatalogContract
{
    public function findById(int $productId): ?array
    {
        $product = Product::find($productId);

        if (!$product) {
            return null;
        }

        return [
            'id' => $product->id,
            'sku' => $product->sku,
            'name' => $product->name,
            'unit' => $product->unit,
            'minimum_stock' => $product->minimum_stock,
        ];
    }
}
