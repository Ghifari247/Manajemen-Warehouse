<?php

namespace App\Modules\ProductModule\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\ProductModule\Models\Product;
use App\Modules\ProductModule\Http\Requests\StoreProductRequest;
use App\Modules\ProductModule\Http\Requests\UpdateProductRequest;

class ProductPageController extends Controller
{
    public function index()
    {
        $products = Product::latest()->get();

        return view('product::index', compact('products'));
    }

    public function create()
    {
        return view('product::create');
    }

    public function store(StoreProductRequest $request)
    {
        Product::create($request->validated());

        return redirect()
            ->route('product.page.index')
            ->with('success', 'Barang berhasil ditambahkan!');
    }

    public function edit(Product $product)
    {
        return view('product::edit', compact('product'));
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $product->update($request->validated());

        return redirect()
            ->route('product.page.index')
            ->with('success', 'Barang berhasil diperbarui!');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()
            ->route('product.page.index')
            ->with('success', 'Barang berhasil dihapus!');
    }
}
