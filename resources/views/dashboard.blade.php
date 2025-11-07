<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>
    <h2>Selamat datang, {{ auth()->user()->name }}!</h2>
    <p>Role kamu: <strong>{{ auth()->user()->role }}</strong></p>

    <nav>
        <a href="{{ url('/barang') }}">Barang</a> |
        <a href="{{ url('/peminjaman') }}">Peminjaman</a> |
        <form action="{{ route('logout') }}" method="POST" style="display:inline;">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </nav>

    <hr>

    <p>Ini halaman dashboard utama.</p>
</body>
</html>