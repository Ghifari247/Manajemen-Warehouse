
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Barang - Warehouse</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            margin: 0;
            padding: 30px;
        }

        .container {
            max-width: 1100px;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 10px;
        }

        h1 {
            margin-top: 0;
            color: #263445;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        th {
            background: #263445;
            color: white;
        }

        .empty {
            text-align: center;
            padding: 25px;
            color: #777;
        }

        .btn {
            display: inline-block;
            padding: 10px 15px;
            background: #263445;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        .btn-edit {
            padding: 7px 12px;
            background: #2563eb;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        .btn-delete {
            padding: 7px 12px;
            background: #dc2626;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .success {
            color: green;
            margin: 15px 0;
        }
    </style>
</head>

<body>
    <div class="container">

        <h1>Data Barang</h1>

        <p>Daftar barang pada Warehouse Management System.</p>

        @if (session('success'))
            <p class="success">{{ session('success') }}</p>
        @endif

        <a href="{{ route('product.page.create') }}" class="btn">
            + Tambah Barang
        </a>

        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>SKU</th>
                    <th>Nama Barang</th>
                    <th>Satuan</th>
                    <th>Stok Minimum</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($products as $index => $product)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $product->sku }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->unit }}</td>
                        <td>{{ $product->minimum_stock }}</td>
                        <td>
                            <a href="{{ route('product.page.edit', $product->id) }}"
                               class="btn-edit">
                                Edit
                            </a>

                            <form action="{{ route('product.page.destroy', $product->id) }}"
                                  method="POST"
                                  style="display:inline;"
                                  onsubmit="return confirm('Yakin ingin menghapus barang ini?')">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn-delete">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="empty">
                            Belum ada data barang.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    </div>
</body>
</html>
