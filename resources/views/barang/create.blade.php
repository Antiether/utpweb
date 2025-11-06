<!DOCTYPE html>
<html>
<head>
    <title>Tambah Barang</title>
</head>
<body>
    <h2>Tambah Barang</h2>

    <form action="{{ route('barang.store') }}" method="POST">
        @csrf
        <label>Nama Barang:</label><br>
        <input type="text" name="nama_barang"><br><br>

        <label>Deskripsi:</label><br>
        <textarea name="deskripsi"></textarea><br><br>

        <label>Stok:</label><br>
        <input type="number" name="stok"><br><br>

        <button type="submit">Simpan</button>
    </form>

    <a href="{{ route('barang.index') }}">Kembali</a>
</body>
</html>