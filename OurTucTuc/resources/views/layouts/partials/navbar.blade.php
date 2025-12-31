<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.5.2/flowbite.min.css" rel="stylesheet" />
    <title>Document</title>
</head>

<body>


<nav class="navbar">
    <a href="#" class="navbar-brand">
        OurTucTuc
    </a>

    <div class="navbar-menu">
        <button type="button" class="flex text-sm bg-sky-950 rounded-full md:me-0 focus:ring-4 focus:ring-neutral-tertiary" id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown" data-dropdown-placement="bottom">
            <span class="sr-only">Open user menu</span>
            <img class="w-8 h-8 rounded-full" src="{{ asset('android-chrome-192x192.png') }}" alt="user photo">
        </button>
        <div class="z-50 hidden bg-sky-950 border border-default-medium rounded-lg shadow-lg w-44" id="user-dropdown">
            <div class="px-4 py-3 text-sm border-b border-default">
                <span class="block text-heading font-medium">Joseph McFall</span>
                <span class="block text-body truncate">name@flowbite.com</span>
            </div>
            <ul class="p-2 text-sm text-body font-medium" aria-labelledby="user-menu-button">
                <li>
                    <a href="#" class="inline-flex items-center w-full p-2 hover:bg-neutral-tertiary-medium hover:text-heading rounded ">Lihat profil</a>
                </li>
            </ul>
        </div>




        <!-- {{-- ================= ADMIN ================= --}}
        @if (Auth::check() && Auth::user()->role === 'admin')
            <a href="/admin/dashboard">Dashboard</a>
            <a href="/admin/vehicles">Kendaraan</a>
            <a href="/admin/drivers">Sopir</a>
            <a href="/admin/routes">Rute</a>

            <div class="dropdown">
                <span class="dropdown-toggle">Lainnya ▾</span>
                <div class="dropdown-menu">
                    <a href="/admin/stations">Halte</a>
                    <a href="/admin/schedules">Jadwal Sopir</a>
                    <a href="/admin/complaints">Keluhan</a>
                </div>
            </div> -->

        <form action="{{ route('logout') }}" method="POST" class="logout-form">
            @csrf
            <button type="submit" class="logout-btn">Keluar</button>
        </form>

        <!-- {{-- ================= PENUMPANG ================= --}}
        @elseif(Auth::check())
            <a href="/dashboard">Dashboard</a>
            <a href="/rute">Rute</a>
            <a href="/keluhan">Keluhan</a>

            <form action="{{ route('logout') }}" method="POST" class="logout-form">
                @csrf
                <button type="submit" class="logout-btn">Keluar</button>
            </form>

            {{-- ================= GUEST ================= --}}
        @else
            <a href="/login">Login</a>
            <a href="/register" class="btn-register">Register</a>
        @endif -->

    </div>
</nav>
</body>
