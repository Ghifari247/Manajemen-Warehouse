<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catat Stok - Warehouse</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f6f9; padding: 30px; }
        .container { max-width: 600px; margin: auto; background: white; padding: 25px; border-radius: 10px; }
        h1 { color: #263445; }
        label { display: block; margin-top: 15px; margin-bottom: 6px; }
        input, textarea, select { width: 100%; padding: 10px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 5px; }
        button { margin-top: 20px; padding: 11px 18px; background: #263445; color: white; border: none; border-radius: 5px; cursor: pointer; }
        a { color: #263445; }
        .error { color: red; font-size: 14px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Catat Stok Masuk/Keluar</h1>

        @if ($errors->any())
            <div class="error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('inventory.page.store') }}" method="POST">
            @csrf

            <label>Barang</label>
            <select name="product_id" required>
                <option value="">-- Pilih Barang --</option>
                @foreach ($products as $product)
                    <option value="{{ $product['id'] }}" @selected(old('product_id') == $product['id'])>
                        {{ $product['sku'] }} - {{ $product['name'] }}
                    </option>
                @endforeach
            </select>

            <label>Jenis Pergerakan</label>
            <select name="type" id="type" required>
                <option value="in" @selected(old('type', 'in') === 'in')>Barang Masuk</option>
                <option value="out" @selected(old('type') === 'out')>Barang Keluar</option>
            </select>

            <label>Jumlah</label>
            <input type="number" name="quantity" value="{{ old('quantity', 1) }}" min="1" required>

            <div id="supplier-field">
                <label>Supplier (untuk barang masuk)</label>
                <select name="supplier_id">
                    <option value="">-- Tanpa Supplier --</option>
                    @foreach ($suppliers as $supplier)
                        <option value="{{ $supplier['id'] }}" @selected(old('supplier_id') == $supplier['id'])>
                            {{ $supplier['code'] }} - {{ $supplier['name'] }}
                        </option>
                    @endforeach
                </select>
            </div>

            <label>Tanggal</label>
            <input type="date" name="movement_date" value="{{ old('movement_date', now()->toDateString()) }}" required>

            <label>Catatan</label>
            <textarea name="notes">{{ old('notes') }}</textarea>

            <button type="submit">Simpan</button>
        </form>

        <p><a href="{{ route('inventory.page.index') }}">Kembali ke Stok Barang</a></p>
    </div>

    <script>
        const type = document.getElementById('type');
        const supplierField = document.getElementById('supplier-field');
        function toggleSupplier() {
            supplierField.style.display = type.value === 'in' ? 'block' : 'none';
        }
        type.addEventListener('change', toggleSupplier);
        toggleSupplier();
    </script>
</body>
</html>
