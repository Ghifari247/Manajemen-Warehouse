<?php

namespace App\Modules\InventoryModule\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;
use App\Modules\InventoryModule\Models\StockMovement;
use App\Modules\ProductModule\Contracts\ProductCatalogContract;
use App\Modules\SupplierModule\Contracts\SupplierCatalogContract;

class StoreStockMovementRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'product_id' => 'required|integer',
            'type' => 'required|in:' . StockMovement::TYPE_IN . ',' . StockMovement::TYPE_OUT,
            'quantity' => 'required|integer|min:1',
            'supplier_id' => 'nullable|integer',
            'movement_date' => 'required|date',
            'notes' => 'nullable|string|max:500',
        ];
    }

    public function after(): array
    {
        return [
            function (Validator $validator) {
                if ($validator->errors()->isNotEmpty()) {
                    return;
                }

                if (!app(ProductCatalogContract::class)->findById((int) $this->input('product_id'))) {
                    $validator->errors()->add('product_id', 'Barang tidak ditemukan.');
                }

                $supplierId = $this->input('supplier_id');

                if ($this->input('type') === StockMovement::TYPE_IN
                    && $supplierId
                    && !app(SupplierCatalogContract::class)->findById((int) $supplierId)) {
                    $validator->errors()->add('supplier_id', 'Supplier tidak ditemukan.');
                }
            },
        ];
    }
}
