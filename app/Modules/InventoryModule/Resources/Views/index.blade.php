<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stok Barang - Warehouse</title>

    <style>
        body { font-family: Arial, sans-serif; background: #f4f6f9; margin: 0; padding: 30px; }
        .container { max-width: 1100px; margin: auto; background: white; padding: 25px; border-radius: 10px; }
        h1 { margin-top: 0; color: #263445; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 12px; border-bottom: 1px solid #ddd; text-align: left; }
        th { background: #263445; color: white; }
        .empty { text-align: center; padding: 25px; color: #777; }
        .btn { display: inline-block; padding: 10px 15px; background: #263445; color: white; text-decoration: none; border-radius: 5px; margin-right: 6px; }
        .success { color: green; margin: 15px 0; }
        .badge { padding: 4px 10px; border-radius: 12px; font-size: 13px; color: white; }
        .badge-ok { background: #16a34a; }
        .badge-low { background: #dc2626; }
    </style>
</head>

<body>
    <div class="container">

        <h1>Stok Barang</h1>

        <p>Stok saat ini dihitung dari total barang masuk dikurangi barang keluar.</p>

        @if (session('success'))
            <p class="success">{{ session('success') }}</p>
        @endif

        <a href="{{ route('inventory.page.create') }}" class="btn">+ Catat Stok Masuk/Keluar</a>
        <a href="{{ route('inventory.page.movements') }}" class="btn">Riwayat Pergerakan</a>
        <a href="{{ route('product.page.index') }}" class="btn">Data Barang</a>
        <a href="{{ route('supplier.page.index') }}" class="btn">Data Supplier</a>

        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>SKU</th>
                    <th>Nama Barang</th>
                    <th>Satuan</th>
                    <th>Stok Saat Ini</th>
                    <th>Stok Minimum</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($stocks as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item['sku'] }}</td>
                        <td>{{ $item['name'] }}</td>
                        <td>{{ $item['unit'] }}</td>
                        <td>{{ $item['stock'] }}</td>
                        <td>{{ $item['minimum_stock'] }}</td>
                        <td>
                            @if ($item['is_low'])
                                <span class="badge badge-low">Stok Menipis</span>
                            @else
                                <span class="badge badge-ok">Aman</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="empty">Belum ada data barang.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    </div>
</body>
</html>
