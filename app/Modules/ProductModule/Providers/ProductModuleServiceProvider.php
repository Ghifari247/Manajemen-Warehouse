<?php

namespace App\Modules\ProductModule\Providers;

use Illuminate\Support\ServiceProvider;
use App\Modules\ProductModule\Contracts\ProductCatalogContract;
use App\Modules\ProductModule\Services\ProductCatalogService;

class ProductModuleServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            ProductCatalogContract::class,
            ProductCatalogService::class
        );
    }

    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__.'/../Routes/web-ui.php');
        
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations');

        $this->loadRoutesFrom(__DIR__.'/../Routes/web.php');

        $this->loadViewsFrom(
            __DIR__.'/../Resources/Views',
            'product'
        );
    }
}
