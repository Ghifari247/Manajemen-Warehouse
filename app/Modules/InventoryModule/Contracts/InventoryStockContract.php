<?php

namespace App\Modules\InventoryModule\Contracts;

interface InventoryStockContract
{
    public function currentStock(int $productId): int;

    public function stockLevels(): array;
}
