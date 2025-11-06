<!DOCTYPE html>
<html>
<head>
    <title>Edit Barang</title>
</head>
<body>
    <h2>Edit Barang</h2>

    <form action="{{ route('barang.update', $barang->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label>Nama Barang:</label><br>
        <input type="text" name="nama_barang" value="{{ $barang->nama_barang }}"><br><br>

        <label>Deskripsi:</label><br>
        <textarea name="deskripsi">{{ $barang->deskripsi }}</textarea><br><br>

        <label>Stok:</label><br>
        <input type="number" name="stok" value="{{ $barang->stok }}"><br><br>

        <button type="submit">Update</button>
    </form>

    <a href="{{ route('barang.index') }}">Kembali</a>
</body>
</html>