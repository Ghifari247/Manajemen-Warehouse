<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // product_id & supplier_id sengaja tanpa foreign key lintas modul;
        // keberadaannya divalidasi lewat ProductCatalogContract / SupplierCatalogContract.
        Schema::create('stock_movements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id')->index();
            $table->unsignedBigInteger('supplier_id')->nullable()->index();
            $table->string('type', 3); // in | out
            $table->unsignedInteger('quantity');
            $table->date('movement_date');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stock_movements');
    }
};
