<?php

namespace App\Modules\InventoryModule\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use App\Modules\InventoryModule\Contracts\InventoryStockContract;
use App\Modules\InventoryModule\Models\StockMovement;

class InventoryStockService implements InventoryStockContract
{
    public function __construct(
        private readonly InventoryCatalog $catalog,
    ) {
    }

    public function currentStock(int $productId): int
    {
        return (int) StockMovement::where('product_id', $productId)
            ->selectRaw("COALESCE(SUM(CASE WHEN type = 'in' THEN quantity ELSE -quantity END), 0) AS stock")
            ->value('stock');
    }

    public function stockLevels(): array
    {
        $stocks = StockMovement::query()
            ->selectRaw("product_id, SUM(CASE WHEN type = 'in' THEN quantity ELSE -quantity END) AS stock")
            ->groupBy('product_id')
            ->pluck('stock', 'product_id');

        return array_map(function (array $product) use ($stocks) {
            $stock = (int) ($stocks[$product['id']] ?? 0);

            return $product + [
                'stock' => $stock,
                'is_low' => $stock <= $product['minimum_stock'],
            ];
        }, $this->catalog->products());
    }

    /**
     * Catat pergerakan stok. Stok keluar tidak boleh melebihi stok saat ini.
     */
    public function record(array $data): StockMovement
    {
        return DB::transaction(function () use ($data) {
            if ($data['type'] === StockMovement::TYPE_OUT) {
                $available = $this->currentStock((int) $data['product_id']);

                if ($data['quantity'] > $available) {
                    throw ValidationException::withMessages([
                        'quantity' => "Stok tidak cukup. Stok tersedia: {$available}.",
                    ]);
                }

                $data['supplier_id'] = null;
            }

            return StockMovement::create($data);
        });
    }
}
