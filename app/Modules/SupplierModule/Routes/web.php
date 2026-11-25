<?php

use Illuminate\Support\Facades\Route;
use App\Modules\SupplierModule\Http\Controllers\SupplierController;

Route::middleware('api')->prefix('suppliers')->name('suppliers.')->group(function () {
    Route::get('/', [SupplierController::class, 'index'])->name('index');

    Route::post('/', [SupplierController::class, 'store'])->name('store');

    Route::get('/{supplier}', [SupplierController::class, 'show'])->name('show');

    Route::put('/{supplier}', [SupplierController::class, 'update'])->name('update');

    Route::delete('/{supplier}', [SupplierController::class, 'destroy'])->name('destroy');
});