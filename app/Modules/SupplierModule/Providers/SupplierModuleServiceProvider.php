<?php

namespace App\Modules\SupplierModule\Providers;

use Illuminate\Support\ServiceProvider;
use App\Modules\SupplierModule\Contracts\SupplierCatalogContract;
use App\Modules\SupplierModule\Services\SupplierCatalogService;

class SupplierModuleServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            SupplierCatalogContract::class,
            SupplierCatalogService::class
        );
    }

    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__.'/../Routes/web.php');

        $this->loadRoutesFrom(__DIR__.'/../Routes/web-ui.php');

        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations');

        $this->loadViewsFrom(__DIR__.'/../Resources/Views', 'supplier');
    }
}