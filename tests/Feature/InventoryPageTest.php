<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\InventoryModule\Models\StockMovement;
use App\Modules\ProductModule\Models\Product;
use App\Modules\SupplierModule\Models\Supplier;

class InventoryPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_display_stock_list(): void
    {
        $product = Product::factory()->create(['name' => 'Laptop Testing', 'minimum_stock' => 5]);
        StockMovement::factory()->in()->create(['product_id' => $product->id, 'quantity' => 2]);

        $response = $this->get(route('inventory.page.index'));

        $response->assertStatus(200);
        $response->assertSee('Laptop Testing');
        $response->assertSee('Stok Menipis');
    }

    public function test_can_display_create_form_and_movement_history(): void
    {
        $product = Product::factory()->create(['name' => 'Mouse Testing']);
        $supplier = Supplier::factory()->create(['name' => 'PT Uji Coba']);
        StockMovement::factory()->in()->create([
            'product_id' => $product->id,
            'supplier_id' => $supplier->id,
        ]);

        $this->get(route('inventory.page.create'))
            ->assertStatus(200)
            ->assertSee('Mouse Testing')
            ->assertSee('PT Uji Coba');

        $this->get(route('inventory.page.movements'))
            ->assertStatus(200)
            ->assertSee('Mouse Testing')
            ->assertSee('PT Uji Coba');
    }

    public function test_can_record_stock_in_via_page(): void
    {
        $product = Product::factory()->create();
        $supplier = Supplier::factory()->create();

        $response = $this->post(route('inventory.page.store'), [
            'product_id' => $product->id,
            'supplier_id' => $supplier->id,
            'type' => 'in',
            'quantity' => 15,
            'movement_date' => '2026-11-25',
            'notes' => 'Pembelian awal',
        ]);

        $response->assertRedirect(route('inventory.page.index'));

        $this->assertDatabaseHas('stock_movements', [
            'product_id' => $product->id,
            'supplier_id' => $supplier->id,
            'type' => 'in',
            'quantity' => 15,
        ]);
    }

    public function test_stock_out_cannot_exceed_available_stock(): void
    {
        $product = Product::factory()->create();
        StockMovement::factory()->in()->create(['product_id' => $product->id, 'quantity' => 5]);

        $response = $this->from(route('inventory.page.create'))
            ->post(route('inventory.page.store'), [
                'product_id' => $product->id,
                'type' => 'out',
                'quantity' => 9,
                'movement_date' => '2026-11-25',
            ]);

        $response->assertRedirect(route('inventory.page.create'));
        $response->assertSessionHasErrors('quantity');
    }

    public function test_rejects_unknown_product(): void
    {
        $response = $this->from(route('inventory.page.create'))
            ->post(route('inventory.page.store'), [
                'product_id' => 999999,
                'type' => 'in',
                'quantity' => 1,
                'movement_date' => '2026-11-25',
            ]);

        $response->assertSessionHasErrors('product_id');
    }
}
