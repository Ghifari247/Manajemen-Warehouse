<?php

use Illuminate\Support\Facades\Route;
use App\Modules\InventoryModule\Http\Controllers\InventoryPageController;

Route::middleware('web')->group(function () {

    Route::get('/warehouse/inventory', [InventoryPageController::class, 'index'])
        ->name('inventory.page.index');

    Route::get('/warehouse/inventory/movements', [InventoryPageController::class, 'movements'])
        ->name('inventory.page.movements');

    Route::get('/warehouse/inventory/create', [InventoryPageController::class, 'create'])
        ->name('inventory.page.create');

    Route::post('/warehouse/inventory', [InventoryPageController::class, 'store'])
        ->name('inventory.page.store');

});
