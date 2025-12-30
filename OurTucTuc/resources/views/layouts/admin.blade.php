<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Admin - OurTucTuc</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="icon" href="{{ asset('favicon.ico') }}">

</head>

<body>

    @include('layouts.partials.navbar')
@include('layouts.partials.sidebar-admin')


        <div class="main-content">
            @yield('content')
            @include('layouts.partials.footer')
        </div>
    </div>

</body>

</html>
