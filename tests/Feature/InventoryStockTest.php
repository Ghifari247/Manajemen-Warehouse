<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\InventoryModule\Contracts\InventoryStockContract;
use App\Modules\InventoryModule\Models\StockMovement;
use App\Modules\ProductModule\Models\Product;

class InventoryStockTest extends TestCase
{
    use RefreshDatabase;

    public function test_current_stock_is_in_minus_out(): void
    {
        $product = Product::factory()->create();

        StockMovement::factory()->in()->create(['product_id' => $product->id, 'quantity' => 30]);
        StockMovement::factory()->out()->create(['product_id' => $product->id, 'quantity' => 12]);

        $inventory = app(InventoryStockContract::class);

        $this->assertEquals(18, $inventory->currentStock($product->id));
    }

    public function test_current_stock_is_zero_without_movements(): void
    {
        $product = Product::factory()->create();

        $this->assertEquals(0, app(InventoryStockContract::class)->currentStock($product->id));
    }

    public function test_stock_levels_flags_low_stock(): void
    {
        $low = Product::factory()->create(['minimum_stock' => 10]);
        $ok = Product::factory()->create(['minimum_stock' => 5]);

        StockMovement::factory()->in()->create(['product_id' => $low->id, 'quantity' => 4]);
        StockMovement::factory()->in()->create(['product_id' => $ok->id, 'quantity' => 50]);

        $levels = collect(app(InventoryStockContract::class)->stockLevels())->keyBy('id');

        $this->assertTrue($levels[$low->id]['is_low']);
        $this->assertEquals(4, $levels[$low->id]['stock']);
        $this->assertFalse($levels[$ok->id]['is_low']);
    }

    public function test_api_can_record_stock_in_and_out(): void
    {
        $product = Product::factory()->create();

        $this->postJson(route('inventory.store'), [
            'product_id' => $product->id,
            'type' => 'in',
            'quantity' => 20,
            'movement_date' => '2026-11-25',
        ])->assertCreated();

        $this->postJson(route('inventory.store'), [
            'product_id' => $product->id,
            'type' => 'out',
            'quantity' => 5,
            'movement_date' => '2026-11-25',
        ])->assertCreated();

        $this->getJson(route('inventory.stocks'))
            ->assertOk()
            ->assertJsonFragment(['id' => $product->id, 'stock' => 15]);
    }

    public function test_api_rejects_stock_out_exceeding_available(): void
    {
        $product = Product::factory()->create();

        StockMovement::factory()->in()->create(['product_id' => $product->id, 'quantity' => 3]);

        $this->postJson(route('inventory.store'), [
            'product_id' => $product->id,
            'type' => 'out',
            'quantity' => 10,
            'movement_date' => '2026-11-25',
        ])->assertStatus(422)->assertJsonValidationErrors('quantity');

        $this->assertDatabaseCount('stock_movements', 1);
    }
}
