<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pengembalian | SIPBAR</title>
    <style>
        body {
            font-family: system-ui, -apple-system, 'Segoe UI', sans-serif;
            margin: 0;
            background-color: #f4f6f9;
            color: #333;
            padding-bottom: 60px; /* supaya footer gak nutup form */
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
            padding: 50px 40px;
        }

        h2 {
            color: #4682B4;
            text-align: center;
            margin-bottom: 30px;
            font-weight: 700;
            font-size: 28px;
        }

        .form-container {
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
            padding: 30px 40px;
            max-width: 600px;
            margin: 0 auto;
        }

        label {
            font-weight: 600;
            color: #444;
        }

        input[type="date"],
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
            margin-top: 6px;
            margin-bottom: 18px;
            font-size: 15px;
        }

        textarea {
            resize: vertical;
            height: 80px;
        }

        p strong {
            color: #315f86;
        }

        .btn-group {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 10px;
        }

        .submit-btn, .back-btn {
            background-color: #4682B4;
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            text-decoration: none;
            border: none;
            font-weight: 600;
            cursor: pointer;
            transition: 0.25s;
        }

        .submit-btn:hover, .back-btn:hover {
            background-color: #315f86;
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
            box-shadow: 0 -2px 6px rgba(0,0,0,0.1);
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
        <h2>Form Pengembalian Barang</h2>

        <div class="form-container">
            <form action="{{ route('peminjaman.prosesPengembalian', $peminjaman->id) }}" method="POST">
                @csrf
                @method('PUT')

                <p><strong>Nama Barang:</strong> {{ $peminjaman->barang->nama_barang }}</p>
                <p><strong>Tanggal Pinjam:</strong> {{ $peminjaman->tanggal_pinjam }}</p>

                <label for="tanggal_kembali">Tanggal Kembali:</label>
                <input type="date" id="tanggal_kembali" name="tanggal_kembali" required>

                <label for="catatan">Catatan (opsional):</label>
                <textarea id="catatan" name="catatan" placeholder="Tulis catatan tambahan jika perlu..."></textarea>

                <div class="btn-group">
                    <button type="submit" class="submit-btn">Kembalikan Barang</button>
                    <a href="{{ route('peminjaman.index') }}" class="back-btn">Kembali</a>
                </div>
            </form>
        </div>
    </main>

    <footer>
        <p>© 2025 SIPBAR - Sistem Peminjaman Barang Kampus</p>
    </footer>
</body>
</html>
