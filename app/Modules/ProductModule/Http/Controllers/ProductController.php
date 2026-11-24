<?php

namespace App\Modules\ProductModule\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\ProductModule\Models\Product;
use App\Modules\ProductModule\Http\Requests\StoreProductRequest;
use App\Modules\ProductModule\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{
    public function index()
    {
        return response()->json(
            Product::latest()->get()
        );
    }

    public function store(StoreProductRequest $request)
    {
        $product = Product::create($request->validated());

        return response()->json([
            'message' => 'Barang berhasil ditambahkan',
            'data' => $product
        ], 201);
    }

    public function show(Product $product)
    {
        return response()->json($product);
    }

public function update(UpdateProductRequest $request, Product $product)
{
    $product->update($request->validated());

    return response()->json([
        'message' => 'Barang berhasil diperbarui',
        'data' => $product->fresh()
    ]);
}

    public function destroy(Product $product)
    {
        $product->delete();

        return response()->json([
            'message' => 'Barang berhasil dihapus'
        ]);
    }
}
