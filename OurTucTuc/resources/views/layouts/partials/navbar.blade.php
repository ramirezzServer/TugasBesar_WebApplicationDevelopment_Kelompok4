<nav class="bg-red-700 text-white px-8 py-4 flex justify-between items-center shadow-lg">
    <a href="/" class="font-bold text-lg tracking-wide">
        OurTucTuc
    </a>

    <div class="flex gap-6 items-center">
        {{-- ADMIN --}}
        @if(Auth::check() && Auth::user()->role === 'admin')
            <a href="/admin/dashboard">Dashboard</a>
            <a href="/admin/vehicles">Kendaraan</a>
            <a href="/admin/drivers">Sopir</a>
            <a href="/admin/routes">Rute</a>

            <div class="relative group">
                <span class="cursor-pointer">Lainnya ▾</span>
                <div class="absolute hidden group-hover:block bg-white text-black p-3 rounded shadow right-0">
                    <a href="/admin/stations" class="block px-2 py-1 hover:bg-gray-100">Halte</a>
                    <a href="/admin/schedules" class="block px-2 py-1 hover:bg-gray-100">Jadwal Sopir</a>
                    <a href="/admin/complaints" class="block px-2 py-1 hover:bg-gray-100">Keluhan</a>
                </div>
            </div>

            <a href="#" onclick="logout()">Keluar</a>

        {{-- PENUMPANG --}}
        @elseif(Auth::check())
            <a href="/dashboard">Dashboard</a>
            <a href="/rute">Rute</a>
            <a href="/keluhan">Keluhan</a>

            <a href="#" onclick="logout()">Keluar</a>

        {{-- GUEST --}}
        @else
            <a href="/login">Login</a>
            <a href="/register" class="bg-white text-red-700 px-3 py-1 rounded font-semibold">
                Register
            </a>
        @endif
    </div>
</nav>

<script>
async function logout() {
    try {
        const response = await fetch('/api/logout', {
            method: 'POST',
            headers: {
                'Accept': 'application/json',
                'Authorization': 'Bearer ' + localStorage.getItem('token')
            }
        });

        if (response.ok) {
            localStorage.removeItem('token');
            window.location.href = '/login';
        } else {
            alert('Gagal logout');
        }
    } catch (error) {
        alert('Terjadi kesalahan saat logout');
    }
}
</script>
