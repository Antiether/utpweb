<!DOCTYPE html>
<html>
<head>
    <title>Data Peminjaman</title>
</head>
<body>
    <h2>Daftar Peminjaman</h2>
    <a href="/dashboard">Kembali ke Dashboard</a> | 
    <a href="{{ route('peminjaman.create') }}">Tambah Peminjaman</a>

    @if(session('success'))
        <p style="color:green;">{{ session('success') }}</p>
    @endif

    <table border="1" cellpadding="8">
        <tr>
            <th>ID</th>
            <th>Nama Barang</th>
            <th>Peminjam</th>
            <th>Tanggal Pinjam</th>
            <th>Tanggal Kembali</th>
            <th>Status</th>
            <th>Catatan</th>
            <th>Aksi</th>
        </tr>

        @foreach ($peminjamen as $p)
        <tr>
            <td>{{ $p->id }}</td>
            <td>{{ $p->barang->nama_barang }}</td>
            <td>{{ $p->user->name }}</td>
            <td>{{ $p->tanggal_pinjam }}</td>
            <td>{{ $p->tanggal_kembali ?? '-' }}</td>
            <td>{{ $p->status }}</td>
            <td>{{ $p->catatan_terenkripsi ?: '-' }}</td>
            <td>
                @if($user->role === 'admin')
                    <a href="{{ route('peminjaman.edit', $p->id) }}">Edit</a> |
                    <form action="{{ route('peminjaman.destroy', $p->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Yakin hapus?')">Hapus</button>
                    </form>
                @elseif($user->role === 'user' && $p->status === 'dipinjam')
                    <a href="{{ route('peminjaman.formPengembalian', $p->id) }}">Kembalikan</a>
                @else
                    -
                @endif
            </td>
        </tr>
        @endforeach
    </table>
</body>
</html>