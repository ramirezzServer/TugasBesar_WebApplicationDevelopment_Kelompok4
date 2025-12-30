<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin - OurTucTuc</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
</head>
<body>

@include('layouts.partials.navbar')

<div class="wrapper">
    <div class="sidebar">
        <h3>Admin</h3>
        <a href="/admin/dashboard">Dashboard</a>
        <a href="/admin/keluhan">Keluhan</a>
        <a href="/admin/sopir">Sopir</a>
        <a href="/admin/kendaraan">Kendaraan</a>
        <a href="/admin/halte">Halte</a>
        <a href="/admin/rute">Rute</a>
        <a href="/admin/jadwal-sopir">Jadwal Sopir</a>
    </div>

    <div class="main-content">
        @yield('content')
        @include('layouts.partials.footer')
    </div>
</div>

</body>
</html>
