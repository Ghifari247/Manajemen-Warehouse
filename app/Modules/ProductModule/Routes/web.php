<?php

use Illuminate\Support\Facades\Route;
use App\Modules\ProductModule\Http\Controllers\ProductController;

Route::middleware('api')
    ->prefix('products')
    ->name('products.')
    ->group(function () {
        Route::get('/', [ProductController::class, 'index'])
            ->name('index');

        Route::post('/', [ProductController::class, 'store'])
            ->name('store');

        Route::get('/{product}', [ProductController::class, 'show'])
            ->name('show');

        Route::put('/{product}', [ProductController::class, 'update'])
            ->name('update');

        Route::delete('/{product}', [ProductController::class, 'destroy'])
            ->name('destroy');
    });
