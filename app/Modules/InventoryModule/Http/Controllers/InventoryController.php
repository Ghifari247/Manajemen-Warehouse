<?php

namespace App\Modules\InventoryModule\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\InventoryModule\Contracts\InventoryStockContract;
use App\Modules\InventoryModule\Http\Requests\StoreStockMovementRequest;
use App\Modules\InventoryModule\Models\StockMovement;
use App\Modules\InventoryModule\Services\InventoryStockService;

class InventoryController extends Controller
{
    public function stocks(InventoryStockContract $inventory)
    {
        return response()->json($inventory->stockLevels());
    }

    public function movements()
    {
        return response()->json(
            StockMovement::latest('movement_date')->latest('id')->get()
        );
    }

    public function store(StoreStockMovementRequest $request, InventoryStockService $inventory)
    {
        $movement = $inventory->record($request->validated());

        return response()->json([
            'message' => 'Pergerakan stok berhasil dicatat',
            'data' => $movement,
        ], 201);
    }
}
