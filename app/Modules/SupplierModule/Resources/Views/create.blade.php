<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Supplier</title>
</head>

<body>
    <h1>Tambah Supplier</h1>

    @if ($errors->any())
    <ul style="color: red;">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
    @endif

    <form action="{{ route('supplier.page.store') }}" method="POST">
        @csrf

        <label>Kode Supplier</label><br>
        <input type="text" name="code" value="{{ old('code') }}" required>
        <br><br>

        <label>Nama Supplier</label><br>
        <input type="text" name="name" value="{{ old('name') }}" required>
        <br><br>

        <label>Telepon</label><br>
        <input type="text" name="phone" value="{{ old('phone') }}">
        <br><br>

        <label>Email</label><br>
        <input type="email" name="email" value="{{ old('email') }}">
        <br><br>

        <label>Alamat</label><br>
        <textarea name="address">{{ old('address') }}</textarea>
        <br><br>

        <button type="submit">Simpan Supplier</button>
    </form>

    <br>
    <a href="{{ route('supplier.page.index') }}">Kembali</a>
</body>

</html>