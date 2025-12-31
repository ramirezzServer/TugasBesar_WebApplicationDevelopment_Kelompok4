<div class="sidebar">
    <h3>User Menu</h3>

    <a href="{{ route('user.dashboard') }}" class="{{ request()->routeIs('user.dashboard') ? 'active' : '' }}">
        Dashboard
    </a>

    <a href="{{ route('user.rute') }}" class="{{ request()->routeIs('user.rute') ? 'active' : '' }}">
        Rute
    </a>

    <a href="{{ route('user.keluhan') }}" class="{{ request()->routeIs('user.keluhan') ? 'active' : '' }}">
        Keluhan
    </a>

    <a href="{{ route('profile') }}" class="{{ request()->routeIs('profile') ? 'active' : '' }}">
        Profil
    </a>
</div>
