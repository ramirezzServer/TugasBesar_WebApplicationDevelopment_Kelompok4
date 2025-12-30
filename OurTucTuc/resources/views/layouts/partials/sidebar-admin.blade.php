 <div class="wrapper">
        <div class="sidebar">
            <h3>Admin</h3>
            <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'text-blue-400' : '' }}">
           Dashboard
        </a>
            <a href="{{ route('admin.keluhan') }}" class="{{ request()->routeIs('admin.keluhan') ? 'text-blue-400' : '' }}">Keluhan</a>
            <a href="/admin/sopir">Sopir</a>
            <a href="/admin/kendaraan">Kendaraan</a>
            <a href="/admin/halte">Halte</a>
            <a href="{{ route('admin.rute') }}" class="{{ request()->routeIs('admin.rute') ? 'text-blue-400' : '' }}">Rute</a>
            <a href="/admin/jadwal-sopir">Jadwal Sopir</a>
            <a href="{{ route('admin.rute-halte') }} " class="{{ request()->routeIs('admin.rute-halte') ? 'text-blue-400' : '' }}">Jadwal rute</a>
            <a href="{{ route('admin.user') }}" class="{{ request()->routeIs('admin.user') ? 'text-blue-400' : '' }}">data user</a>
        </div>
