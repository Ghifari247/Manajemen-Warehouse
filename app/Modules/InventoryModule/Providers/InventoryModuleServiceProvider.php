<?php

namespace App\Modules\InventoryModule\Providers;

use Illuminate\Support\ServiceProvider;
use App\Modules\InventoryModule\Contracts\InventoryStockContract;
use App\Modules\InventoryModule\Services\InventoryStockService;

class InventoryModuleServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            InventoryStockContract::class,
            InventoryStockService::class
        );
    }

    public function boot(): void
    {
        $this->loadMigrationsFrom(
            __DIR__ . '/../Database/Migrations'
        );

        $this->loadRoutesFrom(
            __DIR__ . '/../Routes/web.php'
        );

        $this->loadRoutesFrom(
            __DIR__ . '/../Routes/web-ui.php'
        );

        $this->loadViewsFrom(
            __DIR__ . '/../Resources/Views',
            'inventory'
        );
    }
}
