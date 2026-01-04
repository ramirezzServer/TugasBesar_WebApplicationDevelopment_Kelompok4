<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Admin - OurTucTuc</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/keluhan.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jadwalsopir.css') }}">
    <link rel="icon" href="{{ asset('favicon.ico') }}">

    @stack('styles')
</head>

<body class="page-admin">

    {{-- NAVBAR --}}
    @include('layouts.partials.navbar')

    <div class="wrapper">

        {{-- SIDEBAR ADMIN --}}
        @include('layouts.partials.sidebar-admin')

        {{-- MAIN CONTENT --}}
        <div class="main-content">
            @yield('content')

            {{-- FOOTER --}}
            @include('layouts.partials.footer')
        </div>
    </div>

</body>

</html>
