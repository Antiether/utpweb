<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | SIPBAR</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>
    <div class="container">
        <div class="left-side">
            <h1>Selamat Datang.</h1>
        </div>

        <div class="right-side">
            <div class="login-card">
                <h2>Buat Akun</h2>

                @if ($errors->any())
                    <div class="error-messages">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <form method="POST" action="/register">
                    @csrf
                    <input type="text" name="name" placeholder="Nama Lengkap" value="{{ old('name') }}" required>
                    <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
                    <input type="password" name="password" placeholder="Kata Sandi" required>
                    <input type="password" name="password_confirmation" placeholder="Konfirmasi Kata Sandi" required>

                    <button type="submit">Daftar</button>
                </form>

                <p class="register-text">
                    Sudah punya akun? <a href="/login">Login di sini</a>
                </p>
            </div>
        </div>
    </div>

    <footer>
        <p>© 2025 SIPBAR - Sistem Peminjaman Barang Kampus</p>
    </footer>
</body>
</html>
