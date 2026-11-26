<?php

namespace App\Modules\AuthModule\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class AuthModuleServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // Route API
        Route::middleware('api')
            ->prefix('api')
            ->group(__DIR__.'/../Routes/api.php');

        // Route Web
        Route::middleware('web')
            ->group(__DIR__.'/../Routes/web.php');
    }
}
