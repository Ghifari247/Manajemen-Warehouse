<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\ProductModule\Models\Product;

class ProductPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_display_product_list(): void
    {
        $product = Product::factory()->create([
            'sku' => 'BRGTEST001',
            'name' => 'Laptop Testing',
        ]);

        $response = $this->get(route('product.page.index'));

        $response->assertStatus(200);
        $response->assertSee('Laptop Testing');
        $response->assertSee('BRGTEST001');
    }

    public function test_can_create_product(): void
    {
        $response = $this->post(route('product.page.store'), [
            'sku' => 'BRGTEST002',
            'name' => 'Monitor Testing',
            'description' => 'Monitor untuk pengujian',
            'unit' => 'unit',
            'minimum_stock' => 5,
        ]);

        $response->assertRedirect(route('product.page.index'));

        $this->assertDatabaseHas('products', [
            'sku' => 'BRGTEST002',
            'name' => 'Monitor Testing',
        ]);
    }

    public function test_can_update_product(): void
    {
        $product = Product::factory()->create([
            'sku' => 'BRGTEST003',
            'name' => 'Keyboard Lama',
        ]);

        $response = $this->put(
            route('product.page.update', $product->id),
            [
                'sku' => 'BRGTEST003',
                'name' => 'Keyboard Baru',
                'description' => 'Keyboard terbaru',
                'unit' => 'pcs',
                'minimum_stock' => 8,
            ]
        );

        $response->assertRedirect(route('product.page.index'));

        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'name' => 'Keyboard Baru',
        ]);
    }

    public function test_can_delete_product(): void
    {
        $product = Product::factory()->create();

        $response = $this->delete(
            route('product.page.destroy', $product->id)
        );

        $response->assertRedirect(route('product.page.index'));

        $this->assertDatabaseMissing('products', [
            'id' => $product->id,
        ]);
    }

    public function test_product_validation_rejects_duplicate_sku(): void
    {
        Product::factory()->create([
            'sku' => 'BRGTEST004',
        ]);

        $response = $this->from(route('product.page.create'))
            ->post(route('product.page.store'), [
                'sku' => 'BRGTEST004',
                'name' => 'Barang Duplikat',
                'description' => 'Percobaan SKU duplikat',
                'unit' => 'pcs',
                'minimum_stock' => 5,
            ]);

        $response->assertRedirect(route('product.page.create'));
        $response->assertSessionHasErrors('sku');
    }
}
