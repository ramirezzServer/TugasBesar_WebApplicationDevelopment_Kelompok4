<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>User - OurTucTuc</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="icon" href="{{ asset('favicon.ico') }}">
</head>

<body>

    {{-- NAVBAR --}}
    @include('layouts.partials.navbar')

    <div class="wrapper">

        {{-- SIDEBAR USER --}}
        @include('layouts.partials.sidebar-user')

        {{-- MAIN CONTENT --}}
        <div class="main-content">
            @yield('content')

            {{-- FOOTER --}}
            @include('layouts.partials.footer')
        </div>
    </div>

</body>

</html>
