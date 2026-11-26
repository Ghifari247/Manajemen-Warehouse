<?php

namespace App\Modules\InventoryModule\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\InventoryModule\Contracts\InventoryStockContract;
use App\Modules\InventoryModule\Http\Requests\StoreStockMovementRequest;
use App\Modules\InventoryModule\Models\StockMovement;
use App\Modules\InventoryModule\Services\InventoryStockService;
use App\Modules\InventoryModule\Services\InventoryCatalog;

class InventoryPageController extends Controller
{
    public function index(InventoryStockContract $inventory)
    {
        $stocks = $inventory->stockLevels();

        return view('inventory::index', compact('stocks'));
    }

    public function movements(InventoryCatalog $catalog)
    {
        $movements = StockMovement::latest('movement_date')->latest('id')->get();

        $productNames = collect($catalog->products())->pluck('name', 'id');
        $supplierNames = collect($catalog->suppliers())->pluck('name', 'id');

        return view('inventory::movements', compact('movements', 'productNames', 'supplierNames'));
    }

    public function create(InventoryCatalog $catalog)
    {
        return view('inventory::create', [
            'products' => $catalog->products(),
            'suppliers' => $catalog->suppliers(),
        ]);
    }

    public function store(StoreStockMovementRequest $request, InventoryStockService $inventory)
    {
        $inventory->record($request->validated());

        return redirect()
            ->route('inventory.page.index')
            ->with('success', 'Pergerakan stok berhasil dicatat!');
    }
}
