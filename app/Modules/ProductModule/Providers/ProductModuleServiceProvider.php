<?php

namespace App\Modules\ProductModule\Providers;

use Illuminate\Support\ServiceProvider;

class ProductModuleServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadMigrationsFrom(
            __DIR__ . '/../Database/Migrations'
        );

        $this->loadRoutesFrom(
            __DIR__ . '/../Routes/web.php'
        );
    }
}