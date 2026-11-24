
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Barang - Warehouse</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            padding: 30px;
        }

        .container {
            max-width: 600px;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 10px;
        }

        h1 { color: #263445; }

        label {
            display: block;
            margin-top: 15px;
            margin-bottom: 6px;
        }

        input, textarea {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            margin-top: 20px;
            padding: 11px 18px;
            background: #263445;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        a { color: #263445; }
        .error { color: red; font-size: 14px; }
    </style>
</head>

<body>
    <div class="container">
        <h1>Edit Barang</h1>

        @if ($errors->any())
            <div class="error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('product.page.update', $product->id) }}" method="POST">
            @csrf
            @method('PUT')

            <label>SKU Barang</label>
            <input type="text" name="sku"
                value="{{ old('sku', $product->sku) }}" required>

            <label>Nama Barang</label>
            <input type="text" name="name"
                value="{{ old('name', $product->name) }}" required>

            <label>Deskripsi</label>
            <textarea name="description">{{ old('description', $product->description) }}</textarea>

            <label>Satuan</label>
            <input type="text" name="unit"
                value="{{ old('unit', $product->unit) }}" required>

            <label>Stok Minimum</label>
            <input type="number" name="minimum_stock"
                value="{{ old('minimum_stock', $product->minimum_stock) }}"
                min="0" required>

            <button type="submit">Simpan Perubahan</button>
        </form>

        <p>
            <a href="{{ route('product.page.index') }}">
                Kembali ke Data Barang
            </a>
        </p>
    </div>
</body>
</html>
