<!DOCTYPE html>
<html>
<head>
    <title>Edit Peminjaman</title>
</head>
<body>
    <h2>Edit Peminjaman</h2>

    <form action="{{ route('peminjaman.update', $peminjaman->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Pilih Barang:</label><br>
        <select name="barang_id">
            @foreach ($barangs as $b)
                <option value="{{ $b->id }}" {{ $peminjaman->barang_id == $b->id ? 'selected' : '' }}>
                    {{ $b->nama_barang }}
                </option>
            @endforeach
        </select><br><br>

        <label>Tanggal Kembali:</label><br>
        <input type="date" name="tanggal_kembali" value="{{ $peminjaman->tanggal_kembali }}"><br><br>

        <label>Status:</label><br>
        <select name="status">
            <option value="dipinjam" {{ $peminjaman->status == 'dipinjam' ? 'selected' : '' }}>Dipinjam</option>
            <option value="dikembalikan" {{ $peminjaman->status == 'dikembalikan' ? 'selected' : '' }}>Dikembalikan</option>
        </select><br><br>

        <label>Catatan (terenkripsi):</label><br>
        <textarea name="catatan_terenkripsi">{{ $peminjaman->catatan_terenkripsi }}</textarea><br><br>

        <button type="submit">Update</button>
    </form>

    <a href="{{ route('peminjaman.index') }}">Kembali</a>
</body>
</html>