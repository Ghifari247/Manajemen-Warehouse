<?php

use Illuminate\Support\Facades\Route;
use App\Modules\ProductModule\Http\Controllers\ProductPageController;

Route::middleware('web')->group(function () {

    Route::get('/warehouse/products', [ProductPageController::class, 'index'])
        ->name('product.page.index');

    Route::get('/warehouse/products/create', [ProductPageController::class, 'create'])
        ->name('product.page.create');

    Route::post('/warehouse/products', [ProductPageController::class, 'store'])
        ->name('product.page.store');

    Route::get('/warehouse/products/{product}/edit', [ProductPageController::class, 'edit'])
        ->name('product.page.edit');

    Route::put('/warehouse/products/{product}', [ProductPageController::class, 'update'])
        ->name('product.page.update');

    Route::delete('/warehouse/products/{product}', [ProductPageController::class, 'destroy'])
        ->name('product.page.destroy');

});
