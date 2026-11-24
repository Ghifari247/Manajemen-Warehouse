<?php

namespace App\Modules\SupplierModule\Providers;

use Illuminate\Support\ServiceProvider;

class SupplierModuleServiceProvider extends ServiceProvider
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