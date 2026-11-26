<?php

use Illuminate\Support\Facades\Route;
use App\Modules\InventoryModule\Http\Controllers\InventoryController;

Route::middleware(['api', 'auth:sanctum'])
    ->prefix('inventory')
    ->name('inventory.')
    ->group(function () {
        Route::get('/stocks', [InventoryController::class, 'stocks'])
            ->name('stocks');

        Route::get('/movements', [InventoryController::class, 'movements'])
            ->name('movements');

        Route::post('/movements', [InventoryController::class, 'store'])
            ->name('store');
    });
