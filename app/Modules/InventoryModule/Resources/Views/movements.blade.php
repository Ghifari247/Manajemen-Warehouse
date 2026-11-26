<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pergerakan Stok - Warehouse</title>

    <style>
        body { font-family: Arial, sans-serif; background: #f4f6f9; margin: 0; padding: 30px; }
        .container { max-width: 1100px; margin: auto; background: white; padding: 25px; border-radius: 10px; }
        h1 { margin-top: 0; color: #263445; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 12px; border-bottom: 1px solid #ddd; text-align: left; }
        th { background: #263445; color: white; }
        .empty { text-align: center; padding: 25px; color: #777; }
        .btn { display: inline-block; padding: 10px 15px; background: #263445; color: white; text-decoration: none; border-radius: 5px; margin-right: 6px; }
        .in { color: #16a34a; font-weight: bold; }
        .out { color: #dc2626; font-weight: bold; }
    </style>
</head>

<body>
    <div class="container">

        <h1>Riwayat Pergerakan Stok</h1>

        <p>Catatan seluruh barang masuk dan keluar.</p>

        <a href="{{ route('inventory.page.create') }}" class="btn">+ Catat Stok Masuk/Keluar</a>
        <a href="{{ route('inventory.page.index') }}" class="btn">Kembali ke Stok Barang</a>

        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Tanggal</th>
                    <th>Barang</th>
                    <th>Jenis</th>
                    <th>Jumlah</th>
                    <th>Supplier</th>
                    <th>Catatan</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($movements as $index => $movement)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $movement->movement_date->format('d-m-Y') }}</td>
                        <td>{{ $productNames[$movement->product_id] ?? '-' }}</td>
                        <td>
                            @if ($movement->type === 'in')
                                <span class="in">Masuk</span>
                            @else
                                <span class="out">Keluar</span>
                            @endif
                        </td>
                        <td>{{ $movement->quantity }}</td>
                        <td>{{ $supplierNames[$movement->supplier_id] ?? '-' }}</td>
                        <td>{{ $movement->notes ?? '-' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="empty">Belum ada pergerakan stok.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    </div>
</body>
</html>
