<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\SupplierModule\Models\Supplier;

class SupplierTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_display_suppliers(): void
    {
        Supplier::create([
            'code' => 'SUP001',
            'name' => 'PT Sumber Makmur',
            'phone' => '081234567890',
            'email' => 'sumber@example.com',
            'address' => 'Yogyakarta',
        ]);

        $response = $this->getJson('/suppliers');

        $response->assertOk()
            ->assertJsonFragment([
                'name' => 'PT Sumber Makmur',
            ]);
    }

    public function test_can_create_supplier(): void
    {
        $response = $this->postJson('/suppliers', [
            'code' => 'SUP002',
            'name' => 'CV Berkah Jaya',
            'phone' => '081234567890',
            'email' => 'berkah@example.com',
            'address' => 'Sleman',
        ]);

        $response->assertCreated();

        $this->assertDatabaseHas('suppliers', [
            'code' => 'SUP002',
            'name' => 'CV Berkah Jaya',
        ]);
    }

    public function test_can_update_supplier(): void
    {
        $supplier = Supplier::create([
            'code' => 'SUP003',
            'name' => 'Supplier Lama',
            'phone' => '081234567890',
            'email' => 'lama@example.com',
            'address' => 'Yogyakarta',
        ]);

        $response = $this->putJson(
            "/suppliers/{$supplier->id}",
            [
                'code' => 'SUP003',
                'name' => 'Supplier Baru',
                'phone' => '081234567899',
                'email' => 'baru@example.com',
                'address' => 'Bantul',
            ]
        );

        $response->assertOk();

        $this->assertDatabaseHas('suppliers', [
            'id' => $supplier->id,
            'name' => 'Supplier Baru',
        ]);
    }

    public function test_can_delete_supplier(): void
    {
        $supplier = Supplier::create([
            'code' => 'SUP004',
            'name' => 'Supplier Hapus',
            'phone' => '081234567890',
            'email' => 'hapus@example.com',
            'address' => 'Yogyakarta',
        ]);

        $response = $this->deleteJson(
            "/suppliers/{$supplier->id}"
        );

        $response->assertOk();

        $this->assertDatabaseMissing('suppliers', [
            'id' => $supplier->id,
        ]);
    }

    public function test_rejects_duplicate_supplier_code(): void
    {
        Supplier::create([
            'code' => 'SUP005',
            'name' => 'Supplier Pertama',
            'phone' => '081234567890',
            'email' => 'pertama@example.com',
            'address' => 'Yogyakarta',
        ]);

        $response = $this->postJson('/suppliers', [
            'code' => 'SUP005',
            'name' => 'Supplier Duplikat',
            'phone' => '081234567891',
            'email' => 'duplikat@example.com',
            'address' => 'Sleman',
        ]);

        $response->assertUnprocessable()
            ->assertJsonValidationErrors(['code']);
    }
}