<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | SIPBAR</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>
    <div class="container">
        <div class="left-side">
            <h1>Selamat Datang.</h1>
        </div>

        <div class="right-side">
            <div class="login-card">
                <h2>SIPBAR</h2>
                <form method="POST" action="/login">
                    @csrf
                    <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
                    <input type="password" name="password" placeholder="Kata sandi" required>
                    <button type="submit">Masuk</button>
                </form>

                <p class="register-text">
                    Belum punya akun? <a href="/register">Daftar di sini</a>
                </p>
            </div>
        </div>
    </div>

    <footer>
        <p>© 2025 SIPBAR - Sistem Peminjaman Barang Kampus</p>
    </footer>
</body>
</html>
