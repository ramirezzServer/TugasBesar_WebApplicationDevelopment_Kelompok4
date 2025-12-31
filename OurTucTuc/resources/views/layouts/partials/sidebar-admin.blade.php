<div class="sidebar">
    <h3>Admin</h3>

    <a href="{{ route('admin.dashboard') }}"
        class="menu-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
        Dashboard
    </a>

    <a href="{{ route('admin.keluhan') }}" class="menu-item {{ request()->routeIs('admin.keluhan') ? 'active' : '' }}">
        Keluhan
    </a>

    <a href="/admin/sopir" class="menu-item">
        Sopir
    </a>

    <a href="/admin/kendaraan" class="menu-item">
        Kendaraan
    </a>

    <a href="/admin/halte" class="menu-item">
        Halte
    </a>

    <a href="{{ route('admin.rute') }}" class="menu-item {{ request()->routeIs('admin.rute') ? 'active' : '' }}">
        Rute
    </a>

    <a href="/admin/jadwal-sopir" class="menu-item">
        Jadwal Sopir
    </a>

    <a href="{{ route('admin.rute-halte') }}"
        class="menu-item {{ request()->routeIs('admin.rute-halte') ? 'active' : '' }}">
        Jadwal Rute
    </a>

    <a href="{{ route('admin.user') }}" class="menu-item {{ request()->routeIs('admin.user') ? 'active' : '' }}">
        Data User
    </a>
</div>
