
<?php

use Illuminate\Support\Facades\Route;
use App\Modules\AuthModule\Http\Controllers\WebAuthController;

Route::middleware('web')->group(function () {
    Route::get('/login', [WebAuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [WebAuthController::class, 'login'])
        ->name('login.process');

    Route::post('/logout', [WebAuthController::class, 'logout'])
        ->middleware('auth')
        ->name('logout');
});
