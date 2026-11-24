<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\ProductModule\Models\Product;
use App\Modules\ProductModule\Contracts\ProductCatalogContract;

class ProductCatalogTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_find_product_by_id(): void
    {
        $product = Product::factory()->create();

        $catalog = app(ProductCatalogContract::class);

        $result = $catalog->findById($product->id);

        $this->assertNotNull($result);
        $this->assertEquals($product->id, $result['id']);
        $this->assertEquals($product->name, $result['name']);
    }

    public function test_returns_null_when_product_not_found(): void
    {
        $catalog = app(ProductCatalogContract::class);

        $result = $catalog->findById(999999);

        $this->assertNull($result);
    }
}
