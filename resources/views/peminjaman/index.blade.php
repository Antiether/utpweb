<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Peminjaman | SIPBAR</title>
    <style>
        body {
            font-family: system-ui, -apple-system, 'Segoe UI', sans-serif;
            margin: 0;
            background-color: #f4f6f9;
            color: #333;
        }

        header {
            background-color: #4682B4;
            color: white;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 12px 40px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }

        .logo {
            font-size: 22px;
            font-weight: 500;
            letter-spacing: 0.5px;
        } 

         footer {
    position: fixed;
    bottom: 0;
    left: 0;
    width: 100%;
    text-align: center;
    padding: 12px 0;
    background-color: #4682B4;
    color: white;
    font-size: 14px;
    box-shadow: 0 -2px 6px rgba(0, 0, 0, 0.1);
}

        nav {
            display: flex;
            gap: 25px;
            justify-content: center;
            flex: 1;
        }

        nav a {
            background-color: white;
            color: #4682B4;
            text-decoration: none;
            padding: 8px 18px;
            border-radius: 20px;
            font-weight: 500;
            transition: 0.25s ease;
            border: 2px solid transparent;
        }

        nav a:hover {
            background-color: #f0f0f0;
            border-color: white;
        }

        nav a.active {
            background-color: #315f86;
            color: white;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .logout-btn {
            background-color: white;
            color: #4682B4;
            border: none;
            padding: 6px 12px;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 500;
            transition: 0.25s;
        }

        .logout-btn:hover {
            background-color: #f0f0f0;
        }

        main {
            padding: 50px 40px;
        }

        h2 {
            color: #4682B4;
            text-align: center;
            margin-bottom: 30px;
            font-weight: 700;
            font-size: 28px;
        }

        .table-container {
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
            padding: 20px;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 15px;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #4682B4;
            color: white;
        }

        tr:hover {
            background-color: #f9f9f9;
        }

        /* Tombol Dashboard dan Tambah */
        .btn-group {
            display: flex;
            justify-content: center; /* tombol di tengah */
            gap: 15px;
            margin-bottom: 20px;
        }

        .add-btn, .back-btn {
            background-color: #4682B4;
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600; /* bikin tulisannya tebal */
            transition: 0.25s;
        }

        .add-btn:hover, .back-btn:hover {
            background-color: #315f86;
        }

        .action-btn {
            background: none;
            border: none;
            color: #4682B4;
            cursor: pointer;
            text-decoration: underline;
        }

        .action-btn:hover {
            color: #315f86;
        }

        .success {
            color: green;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <header>
        <div class="logo">SIPBAR</div>
        <nav>
            <a href="{{ url('/dashboard') }}">Beranda</a>
            <a href="{{ url('/barang') }}">Barang</a>
            <a href="{{ url('/peminjaman') }}" class="active">Peminjaman</a>
        </nav>
        <div class="user-info">
            <span>Halo, {{ Auth::user()->name }}</span>
            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="logout-btn">Logout</button>
            </form>
        </div>
    </header>

    <main>
        <h2>Daftar Peminjaman</h2>

        @if(session('success'))
            <p class="success">{{ session('success') }}</p>
        @endif

        <div class="table-container">
            <div class="btn-group">
                <a href="/dashboard" class="back-btn">← Kembali ke Dashboard</a>
                <a href="{{ route('peminjaman.create') }}" class="add-btn">+ Tambah Peminjaman</a>
            </div>

            <table>
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
                            <a href="{{ route('peminjaman.edit', $p->id) }}" class="action-btn">Edit</a> |
                            <form action="{{ route('peminjaman.destroy', $p->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="action-btn" onclick="return confirm('Yakin hapus?')">Hapus</button>
                            </form>
                        @elseif($user->role === 'user' && $p->status === 'dipinjam')
                            <a href="{{ route('peminjaman.formPengembalian', $p->id) }}" class="action-btn">Kembalikan</a>
                        @else
                            -
                        @endif
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </main>
    <footer>
        <p>© 2025 SIPBAR - Sistem Peminjaman Barang Kampus</p>
    </footer> 
</body>
</html>
