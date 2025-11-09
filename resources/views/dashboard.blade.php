<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | SIPBAR</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: system-ui, -apple-system, 'Segoe UI', sans-serif;
            margin: 0;
            background-color: #f4f6f9;
            color: #333;
            height: 100vh;
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
            flex-shrink: 0;
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
            padding: 0 20px;
        }

        .welcome-box {
            background-color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 40px;
            border-radius: 12px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
            padding: 40px 60px;
            width: 80%;
            max-width: 1000px;
            height: 65vh; /* biar proporsional dan gak bikin scroll */
        }

        .welcome-box img {
            width: 45%;
            height: 100%;
            object-fit: cover;
            border-radius: 12px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }

        .welcome-text {
            flex: 1;
            text-align: left;
        }

        .welcome-text h2 {
            color: #4682B4;
            font-weight: 700;
            font-size: 30px;
            margin-bottom: 16px;
        }

        .welcome-text p {
            color: #555;
            font-size: 16px;
            line-height: 1.6;
        }

        footer {
            background-color: #4682B4;
            color: white;
            text-align: center;
            padding: 12px 0;
            font-size: 14px;
            box-shadow: 0 -2px 6px rgba(0,0,0,0.1);
            flex-shrink: 0;
        }

        /* Responsive */
        @media (max-width: 850px) {
            .welcome-box {
                flex-direction: column;
                height: auto;
                padding: 30px;
            }

            .welcome-box img {
                width: 100%;
                max-height: 250px;
            }

            .welcome-text {
                text-align: center;
            }

            .welcome-text h2 {
                font-size: 26px;
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="logo">SIPBAR</div>
        <nav>
            <a href="{{ url('/dashboard') }}" class="active">Beranda</a>
            <a href="{{ url('/barang') }}">Barang</a>
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
        <div class="welcome-box">
            <img src="{{ asset('images/beranda_utp.jpg') }}" alt="Beranda UTP">
            <div class="welcome-text">
                <h2>Selamat Datang di SIPBAR</h2>
                <p>Sistem Peminjaman Barang Kampus (SIPBAR). <br>  
                Di sini kamu dapat melakukan peminjaman barang kampus atau mengelola data barang yang tersedia dengan mudah dan cepat.  
                Mari gunakan fasilitas ini dengan bijak dan bertanggung jawab!</p>
            </div>
        </div>
    </main>

    <footer>
        <p>© 2025 SIPBAR - Sistem Peminjaman Barang Kampus</p>
    </footer>
</body>
</html>
