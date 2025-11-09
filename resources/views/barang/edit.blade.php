<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Barang | SIPBAR</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: system-ui, -apple-system, 'Segoe UI', sans-serif;
            margin: 0;
            background-color: #f4f6f9;
            color: #333;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
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
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
        }

        .form-box {
            background-color: white;
            padding: 40px 50px;
            border-radius: 12px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 480px;
        }

        h2 {
            text-align: center;
            color: #4682B4;
            font-weight: 700;
            font-size: 26px;
            margin-bottom: 25px;
        }

        label {
            font-weight: 600;
            display: block;
            margin-bottom: 6px;
            color: #333;
        }

        input[type="text"],
        input[type="number"],
        textarea {
            width: 100%;
            padding: 10px;
            border-radius: 8px;
            border: 1px solid #ccc;
            margin-bottom: 16px;
            font-size: 15px;
            font-family: inherit;
        }

        textarea {
            resize: none;
            height: 70px;
        }

        .btn-group {
            display: flex;
            gap: 12px;
            justify-content: center;
            margin-top: 10px;
        }

        .submit-btn,
        .back-btn {
            background-color: #4682B4;
            color: white;
            padding: 10px 18px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            font-size: 15px;
            transition: background-color 0.25s ease;
            text-decoration: none;
        }

        .submit-btn:hover,
        .back-btn:hover {
            background-color: #315f86;
        }

        footer {
            background-color: #4682B4;
            color: white;
            text-align: center;
            padding: 12px 0;
            font-size: 14px;
            box-shadow: 0 -2px 6px rgba(0,0,0,0.1);
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
        <div class="form-box">
            <h2>Edit Barang</h2>

            <form action="{{ route('barang.update', $barang->id) }}" method="POST">
                @csrf
                @method('PUT')

                <label>Nama Barang:</label>
                <input type="text" name="nama_barang" value="{{ $barang->nama_barang }}" required>

                <label>Deskripsi:</label>
                <textarea name="deskripsi" required>{{ $barang->deskripsi }}</textarea>

                <label>Stok:</label>
                <input type="number" name="stok" value="{{ $barang->stok }}" required>

                <div class="btn-group">
                    <button type="submit" class="submit-btn">Update Barang</button>
                    <a href="{{ route('barang.index') }}" class="back-btn">Kembali</a>
                </div>
            </form>
        </div>
    </main>

    <footer>
        <p>© 2025 SIPBAR - Sistem Peminjaman Barang Kampus</p>
    </footer>
</body>
</html>
