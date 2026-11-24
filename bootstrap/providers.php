<?php

use App\Providers\AppServiceProvider;

return [
    AppServiceProvider::class,

     App\Modules\ProductModule\Providers\ProductModuleServiceProvider::class,
    App\Modules\SupplierModule\Providers\SupplierModuleServiceProvider::class,
    App\Modules\InventoryModule\Providers\InventoryModuleServiceProvider::class,
];
