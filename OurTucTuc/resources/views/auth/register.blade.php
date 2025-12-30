<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar - OurTucTuc</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="icon" href="{{ asset('favicon.ico') }}">
</head>
<body class="auth-body">

<div class="auth-container">
    <div class="auth-card">
        <h2>Daftar Akun</h2>
        <p>Buat akun penumpang OurTucTuc</p>

        <form method="POST" action="/web-register">
            @csrf

            <input type="text" name="name" placeholder="Nama Lengkap" required>
            <input type="text" name="NoTelp" placeholder="No Telepon" required>
            <input type="email" name="email" placeholder="Email" required>

            <input type="password" name="password" placeholder="Password (min. 8 karakter)" required>
            <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" required>

            <button type="submit" class="btn-primary">Daftar</button>
        </form>

        <p class="auth-link">
            Sudah punya akun?
            <a href="/login">Masuk</a>
        </p>
    </div>
</div>

</body>
</html>
