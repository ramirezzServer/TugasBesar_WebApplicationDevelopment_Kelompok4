<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Login - OurTucTuc</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="icon" href="{{ asset('favicon.ico') }}">
</head>

<body class="auth-body">

    <div class="auth-container">
        <div class="auth-card">
            <h2>Selamat Datang</h2>
            <p>Masuk ke sistem OurTucTuc</p>

            <form method="POST" action="/web-login">
                @csrf
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>

                <button class="btn-primary">Masuk</button>
            </form>

            <p class="auth-link">
                Belum punya akun?
                <a href="/register">Daftar sekarang</a>
            </p>
        </div>
    </div>

</body>

</html>
