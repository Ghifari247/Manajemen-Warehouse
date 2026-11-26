
<?php

use Illuminate\Support\Facades\Route;
use App\Modules\SupplierModule\Http\Controllers\SupplierController;

Route::middleware(['api', 'auth:sanctum'])
    ->prefix('suppliers')
    ->name('suppliers.')
    ->group(function () {

        // Admin dan Staff
        Route::get('/', [SupplierController::class, 'index'])
            ->name('index');

        Route::get('/{supplier}', [SupplierController::class, 'show'])
            ->name('show');

        // Khusus Admin
        Route::middleware('role:admin')->group(function () {
            Route::post('/', [SupplierController::class, 'store'])
                ->name('store');

            Route::put('/{supplier}', [SupplierController::class, 'update'])
                ->name('update');

            Route::delete('/{supplier}', [SupplierController::class, 'destroy'])
                ->name('destroy');
        });
    });
