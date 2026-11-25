<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\SupplierModule\Models\Supplier;
use App\Modules\SupplierModule\Contracts\SupplierCatalogContract;

class SupplierCatalogTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_find_supplier_by_id(): void
    {
        $supplier = Supplier::factory()->create();

        $catalog = app(SupplierCatalogContract::class);

        $result = $catalog->findById($supplier->id);

        $this->assertNotNull($result);
        $this->assertEquals($supplier->id, $result['id']);
        $this->assertEquals($supplier->code, $result['code']);
        $this->assertEquals($supplier->name, $result['name']);
        $this->assertEquals($supplier->phone, $result['phone']);
        $this->assertEquals($supplier->email, $result['email']);
    }

    public function test_returns_null_when_supplier_not_found(): void
    {
        $catalog = app(SupplierCatalogContract::class);

        $result = $catalog->findById(999999);

        $this->assertNull($result);
    }
}