<?php

namespace App\Modules\SupplierModule\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\SupplierModule\Models\Supplier;
use App\Modules\SupplierModule\Http\Requests\StoreSupplierRequest;
use App\Modules\SupplierModule\Http\Requests\UpdateSupplierRequest;
use Illuminate\Http\JsonResponse;

class SupplierController extends Controller
{
    // Menampilkan seluruh data supplier
    public function index(): JsonResponse
    {
        return response()->json([
            'message' => 'Daftar supplier berhasil diambil',
            'data' => Supplier::latest()->get(),
        ]);
    }

    // Menambahkan supplier baru
    public function store(StoreSupplierRequest $request): JsonResponse
    {
        $supplier = Supplier::create($request->validated());

        return response()->json([
            'message' => 'Supplier berhasil ditambahkan',
            'data' => $supplier,
        ], 201);
    }

    // Menampilkan detail supplier
    public function show(int $supplier): JsonResponse
    {
        $data = Supplier::findOrFail($supplier);

        return response()->json([
            'data' => $data,
        ]);
    }

    // Memperbarui data supplier
    public function update(
        UpdateSupplierRequest $request,
        int $supplier
    ): JsonResponse {
        $data = Supplier::findOrFail($supplier);
        $data->update($request->validated());

        return response()->json([
            'message' => 'Supplier berhasil diperbarui',
            'data' => $data->fresh(),
        ]);
    }

    // Menghapus supplier
    public function destroy(int $supplier): JsonResponse
    {
        $data = Supplier::findOrFail($supplier);
        $data->delete();

        return response()->json([
            'message' => 'Supplier berhasil dihapus',
        ]);
    }
}