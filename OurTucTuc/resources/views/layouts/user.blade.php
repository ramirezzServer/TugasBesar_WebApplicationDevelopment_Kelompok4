<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'OurTucTuc')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="icon" href="{{ asset('favicon.ico') }}">
</head>

<body>

    @include('layouts.partials.navbar')

    <main class="main-content">
        @yield('content')
    </main>

    @include('layouts.partials.footer')

</body>

</html>
