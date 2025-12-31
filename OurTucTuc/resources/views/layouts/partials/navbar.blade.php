<nav class="w-full bg-red-700 shadow-md">
    <div class="w-full px-6 py-3 flex items-center justify-between">

        {{-- LEFT: LOGO + BRAND --}}
        {{--
        <a href="/" class="flex items-center gap-3 text-white font-bold text-lg">
        --}}
        <div class="flex items-center gap-3 text-white font-bold text-lg cursor-default select-none">
            <img src="{{ asset('android-chrome-192x192.png') }}" class="w-9 h-9 rounded-full" alt="OurTucTuc Logo">
            <span>OurTucTuc</span>
        </div>

        {{-- RIGHT: USER DROPDOWN --}}
        @auth
            <div class="relative">
                <button type="button"
                    class="flex items-center justify-center w-10 h-10 rounded-full bg-red-900 focus:ring-2 focus:ring-white"
                    data-dropdown-toggle="user-dropdown">
                    <img src="{{ asset('android-chrome-192x192.png') }}" class="w-9 h-9 rounded-full" alt="User">
                </button>

                {{-- DROPDOWN --}}
                <div id="user-dropdown"
                    class="hidden absolute right-0 mt-3 w-52 bg-white rounded-xl shadow-lg overflow-hidden z-50">
                    <div class="px-4 py-3 border-b">
                        <p class="font-semibold text-gray-800">{{ Auth::user()->name }}</p>
                        <p class="text-sm text-gray-500 truncate">{{ Auth::user()->email }}</p>
                    </div>

                    <a href="{{ route('profile') }}" class="block px-4 py-2 text-sm hover:bg-gray-100">
                        👤 Lihat Profil
                    </a>

                    <form action="{{ route('logout') }}" method="POST" class="border-t">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100">
                            🚪 Logout
                        </button>
                    </form>
                </div>
            </div>
        @endauth

    </div>
</nav>

{{-- Flowbite JS --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.5.2/flowbite.min.js"></script>
