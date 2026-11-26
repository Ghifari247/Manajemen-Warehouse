<?php

use Illuminate\Support\Facades\Route;
use App\Modules\ProductModule\Http\Controllers\ProductController;

Route::middleware(['api', 'auth:sanctum'])
    ->prefix('products')
    ->name('products.')
    ->group(function () {

        // Admin dan Staff
        Route::get('/', [ProductController::class, 'index'])
            ->name('index');

        Route::get('/{product}', [ProductController::class, 'show'])
            ->name('show');

        // Khusus Admin
        Route::middleware('role:admin')->group(function () {
            Route::post('/', [ProductController::class, 'store'])
                ->name('store');

            Route::put('/{product}', [ProductController::class, 'update'])
                ->name('update');

            Route::delete('/{product}', [ProductController::class, 'destroy'])
                ->name('destroy');
        });
    });
