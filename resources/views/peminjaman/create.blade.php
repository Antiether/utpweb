<!DOCTYPE html>
<html>
<head>
    <title>Tambah Peminjaman</title>
</head>
<body>
    <h2>Tambah Peminjaman</h2>

    <form action="{{ route('peminjaman.store') }}" method="POST">
        @csrf
        <label>Pilih Barang:</label><br>
        <select name="barang_id">
            @foreach ($barangs as $b)
                <option value="{{ $b->id }}">{{ $b->nama_barang }}</option>
            @endforeach
        </select><br><br>

        <label>Tanggal Pinjam:</label><br>
        <input type="date" name="tanggal_pinjam"><br><br>

        <label>Catatan (terenkripsi):</label><br>
        <textarea name="catatan_terenkripsi"></textarea><br><br>

        <button type="submit">Simpan</button>
    </form>

    <a href="{{ route('peminjaman.index') }}">Kembali</a>
</body>
</html>