<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Barang | SIPBAR</title>
    <style>
        body {
            font-family: system-ui, -apple-system, 'Segoe UI', sans-serif;
            margin: 0;
            background-color: #f4f6f9;
            color: #333;
            display: flex;
            flex-direction: column;
            min-height: 100vh; /* biar footer tetap di bawah */
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
            font-weight: 600;
            letter-spacing: 0.5px;
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
            flex: 1; /* dorong footer ke bawah */
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

        .add-btn {
            display: inline-block;
            background-color: #4682B4;
            color: white;
            padding: 8px 16px;
            border-radius: 6px;
            text-decoration: none;
            margin-bottom: 15px;
            transition: 0.2s;
        }

        .add-btn:hover {
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

        footer {
            text-align: center;
            padding: 12px 0;
            background-color: #4682B4;
            color: white;
            font-size: 14px;
            box-shadow: 0 -2px 6px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <header>
        <div class="logo">SIPBAR</div>
        <nav>
            <a href="{{ url('/dashboard') }}">Beranda</a>
            <a href="{{ url('/barang') }}" class="active">Barang</a>
            <a href="{{ url('/peminjaman') }}">Peminjaman</a>
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
        <h2>Data Barang</h2>

        @if(session('success'))
            <p class="success">{{ session('success') }}</p>
        @endif

        <div class="table-container">
            @if($user->role === 'admin')
                <a href="{{ route('barang.create') }}" class="add-btn">+ Tambah Barang</a>
            @endif

            <table>
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
                        <a href="{{ route('barang.edit', $barang->id) }}" class="action-btn">Edit</a> |
                        <form action="{{ route('barang.destroy', $barang->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="action-btn" onclick="return confirm('Yakin hapus?')">Hapus</button>
                        </form>
                    </td>
                    @endif
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
