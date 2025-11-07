<!DOCTYPE html>
<html>
<head>
    <title>Form Pengembalian Barang</title>
</head>
<body>
    <h2>Form Pengembalian Barang</h2>

    <a href="{{ route('peminjaman.index') }}">← Kembali ke Daftar Peminjaman</a>

    <form action="{{ route('peminjaman.prosesPengembalian', $peminjaman->id) }}" method="POST">
        @csrf
        @method('PUT')

        <p><strong>Nama Barang:</strong> {{ $peminjaman->barang->nama_barang }}</p>
        <p><strong>Tanggal Pinjam:</strong> {{ $peminjaman->tanggal_pinjam }}</p>

        <label for="tanggal_kembali">Tanggal Kembali:</label><br>
        <input type="date" name="tanggal_kembali" required><br><br>

        <label for="catatan">Catatan (opsional):</label><br>
        <textarea name="catatan" rows="3" cols="40"></textarea><br><br>

        <button type="submit">Kembalikan Barang</button>
    </form>
</body>
</html>