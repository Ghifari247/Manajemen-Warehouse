<?php

use Illuminate\Support\Facades\Route;
use App\Modules\SupplierModule\Http\Controllers\SupplierPageController;

Route::middleware(['web', 'auth'])->group(function () {

    Route::get('/warehouse/suppliers', [SupplierPageController::class, 'index'])
        ->name('supplier.page.index');

    Route::middleware('role:admin')->group(function () {
        Route::get('/warehouse/suppliers/create', [SupplierPageController::class, 'create'])
            ->name('supplier.page.create');

        Route::post('/warehouse/suppliers', [SupplierPageController::class, 'store'])
            ->name('supplier.page.store');

        Route::get('/warehouse/suppliers/{supplier}/edit', [SupplierPageController::class, 'edit'])
            ->name('supplier.page.edit');

        Route::put('/warehouse/suppliers/{supplier}', [SupplierPageController::class, 'update'])
            ->name('supplier.page.update');

        Route::delete('/warehouse/suppliers/{supplier}', [SupplierPageController::class, 'destroy'])
            ->name('supplier.page.destroy');
    });

});
