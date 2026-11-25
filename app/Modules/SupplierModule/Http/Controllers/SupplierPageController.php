<?php

namespace App\Modules\SupplierModule\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\SupplierModule\Models\Supplier;
use App\Modules\SupplierModule\Http\Requests\StoreSupplierRequest;
use App\Modules\SupplierModule\Http\Requests\UpdateSupplierRequest;

class SupplierPageController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::latest()->get();

        return view('supplier::index', compact('suppliers'));
    }

    public function create()
    {
        return view('supplier::create');
    }

    public function store(StoreSupplierRequest $request)
    {
        Supplier::create($request->validated());

        return redirect()
            ->route('supplier.page.index')
            ->with('success', 'Supplier berhasil ditambahkan!');
    }

    public function edit(Supplier $supplier)
    {
        return view('supplier::edit', compact('supplier'));
    }

    public function update(UpdateSupplierRequest $request, Supplier $supplier)
    {
        $supplier->update($request->validated());

        return redirect()
            ->route('supplier.page.index')
            ->with('success', 'Supplier berhasil diperbarui!');
    }

    public function destroy(Supplier $supplier)
    {
        $supplier->delete();

        return redirect()
            ->route('supplier.page.index')
            ->with('success', 'Supplier berhasil dihapus!');
    }
}