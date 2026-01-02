<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Admin - OurTucTuc</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/keluhan.css') }}">
    <link rel="stylesheet" href="{{ asset('css/kendaraan.css') }}">
    <link rel="icon" href="{{ asset('favicon.ico') }}">

    {{-- Bootstrap CSS (necessary for modal) --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">


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

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    {{-- SweetAlert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    @stack('scripts')

</body>

</html>
