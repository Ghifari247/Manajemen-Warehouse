<?php

namespace App\Modules\SupplierModule\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\SupplierModule\Models\Supplier;

class SupplierSeeder extends Seeder
{
    public function run(): void
    {
        Supplier::firstOrCreate(
            ['code' => 'SUP001'],
            [
                'name' => 'PT Sumber Makmur',
                'phone' => '081234567890',
                'email' => 'sumbermakmur@example.com',
                'address' => 'Yogyakarta',
            ]
        );

        Supplier::firstOrCreate(
            ['code' => 'SUP002'],
            [
                'name' => 'CV Berkah Jaya',
                'phone' => '082345678901',
                'email' => 'berkahjaya@example.com',
                'address' => 'Sleman, Yogyakarta',
            ]
        );

        Supplier::factory()->count(3)->create();
    }
}