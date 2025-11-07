<!DOCTYPE html>
<html>
<head>
    <title>Data Barang</title>
</head>
<body>
    <h2>Data Barang</h2>
    <a href="/dashboard">Kembali ke Dashboard</a>

    @if($user->role === 'admin')
        | <a href="{{ route('barang.create') }}">Tambah Barang</a>
    @endif

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <table border="1" cellpadding="8">
        <tr>
            <th>ID</th>
            <th>Nama Barang</th>
            <th>Deskripsi</th>
            <th>Stok</th>
            @if($user->role === 'admin')
                <th>Aksi</th>
            @endif
        </tr>

        @foreach ($barangs as $barang)
        <tr>
            <td>{{ $barang->id }}</td>
            <td>{{ $barang->nama_barang }}</td>
            <td>{{ $barang->deskripsi }}</td>
            <td>{{ $barang->stok }}</td>

            @if($user->role === 'admin')
            <td>
                <a href="{{ route('barang.edit', $barang->id) }}">Edit</a> |
                <form action="{{ route('barang.destroy', $barang->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Yakin hapus?')">Hapus</button>
                </form>
            </td>
            @endif
        </tr>
        @endforeach
    </table>
</body>
</html>