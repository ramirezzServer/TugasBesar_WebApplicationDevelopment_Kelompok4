<div class="sidebar">
    <h3>Admin Menu</h3>

    <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
        Dashboard
    </a>

    <a href="{{ route('admin.keluhan') }}" class="{{ request()->routeIs('admin.keluhan') ? 'active' : '' }}">
        Keluhan
    </a>

    <a href="{{ route('admin.user') }}" class="{{ request()->routeIs('admin.user') ? 'active' : '' }}">
        User
    </a>

    <a href="{{ route('admin.sopir.index') }}" class="{{ request()->routeIs('admin.sopir.*') ? 'active' : '' }}">
        Sopir
    </a>

    <a href="{{ route('admin.kendaraan.index') }}" class="{{ request()->routeIs('admin.kendaraan.*') ? 'active' : '' }}">
        Kendaraan
    </a>

    <a href="{{ route('admin.halte.index') }}" class="{{ request()->routeIs('admin.halte.*') ? 'active' : '' }}">
        Halte
    </a>

    <a href="{{ route('admin.rute.index') }}" class="{{ request()->routeIs('admin.rute.*') ? 'active' : '' }}">
        Rute
    </a>

    <a href="{{ route('admin.rute-halte.index') }}" class="{{ request()->routeIs('admin.rute-halte.*') ? 'active' : '' }}">
        Rute Halte
    </a>

    <a href="{{ route('admin.jadwal-sopir') }}"
        class="{{ request()->routeIs('admin.jadwal-sopir') ? 'active' : '' }}">
        Jadwal Sopir
    </a>
</div>
