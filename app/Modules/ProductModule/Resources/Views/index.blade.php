<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Barang - Warehouse</title>
    <style>
        body { font-family: Arial; background: #f4f6f9; margin: 0; padding: 30px; }
        .container { max-width: 1100px; margin: auto; background: white; padding: 25px; border-radius: 10px; }
        h1 { color: #263445; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 12px; border-bottom: 1px solid #ddd; text-align: left; }
        th { background: #263445; color: white; }
        .btn { display: inline-block; padding: 9px 13px; background: #263445; color: white; text-decoration: none; border-radius: 5px; border: none; cursor: pointer; }
        .edit { background: #2563eb; }
        .delete { background: #dc2626; }
        .logout { background: #dc2626; }
        .empty { text-align: center; padding: 25px; }
        .success { color: green; }
        .top { display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 10px; }
    </style>
</head>
<body>
<div class="container">

    <div class="top">
        <h1>Data Barang</h1>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="btn logout" type="submit">Logout</button>
        </form>
    </div>

    <p>Login sebagai: {{ auth()->user()->email }} | Role: {{ auth()->user()->role }}</p>
    <p>Daftar barang pada Warehouse Management System.</p>

    @if (session('success'))
        <p class="success">{{ session('success') }}</p>
    @endif

    @if (auth()->user()->role === 'admin')
        <a href="{{ route('product.page.create') }}" class="btn">+ Tambah Barang</a>
    @endif

    <table>
        <thead>
            <tr>
                <th>No</th><th>SKU</th><th>Nama Barang</th>
                <th>Kategori</th><th>Satuan</th><th>Stok Minimum</th><th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        @forelse ($products as $product)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $product->sku }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->category }}</td>
                <td>{{ $product->unit }}</td>
                <td>{{ $product->minimum_stock }}</td>
                <td>
                    @if (auth()->user()->role === 'admin')
                        <a href="{{ route('product.page.edit', $product->id) }}" class="btn edit">Edit</a>
                        <form action="{{ route('product.page.destroy', $product->id) }}" method="POST" style="display:inline" onsubmit="return confirm('Hapus barang ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn delete" type="submit">Hapus</button>
                        </form>
                    @else
                        -
                    @endif
                </td>
            </tr>
        @empty
            <tr><td colspan="7" class="empty">Belum ada data barang.</td></tr>
        @endforelse
        </tbody>
    </table>
</div>
</body>
</html>
