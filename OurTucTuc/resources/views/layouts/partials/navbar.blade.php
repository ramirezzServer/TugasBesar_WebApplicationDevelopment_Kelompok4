<nav class="navbar">
    <a href="/" class="navbar-brand">
        OurTucTuc
    </a>

    <div class="navbar-menu">

        {{-- ================= ADMIN ================= --}}
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
            </div>

            <form action="{{ route('logout') }}" method="POST" class="logout-form">
                @csrf
                <button type="submit" class="logout-btn">Keluar</button>
            </form>

            {{-- ================= PENUMPANG ================= --}}
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
        @endif

    </div>
</nav>
