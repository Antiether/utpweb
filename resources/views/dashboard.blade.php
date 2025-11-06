<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>
    <h2>Selamat datang, {{ auth()->user()->name }}!</h2>
    <p>Role kamu: <strong>{{ auth()->user()->role }}</strong></p>


    <p>Ini halaman dashboard. Kamu berhasil login</p>

    <form action="/logout" method="POST">
        @csrf
        <button type="submit">Logout</button>
    </form>
</body>
</html>