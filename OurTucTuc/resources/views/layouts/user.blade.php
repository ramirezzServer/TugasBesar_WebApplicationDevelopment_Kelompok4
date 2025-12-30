<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>User - OurTucTuc</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
</head>
<body>

@include('layouts.partials.navbar')

<div class="main-content">
    @yield('content')
    @include('layouts.partials.footer')
</div>

</body>
</html>
