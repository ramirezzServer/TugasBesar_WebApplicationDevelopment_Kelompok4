<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Profil Saya</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen">

    @auth
        @include('layouts.partials.navbar')
    @endauth

    <div class="max-w-5xl mx-auto px-6 py-10">

        {{-- CARD PROFILE --}}
        <div class="bg-white rounded-2xl shadow overflow-hidden">

            {{-- HEADER --}}
            <div class="bg-red-700 p-8 flex flex-col md:flex-row items-center gap-6">
                <img src="{{ asset('android-chrome-192x192.png') }}"
                    class="w-28 h-28 rounded-full border-4 border-white shadow">

                <div class="text-white text-center md:text-left">
                    <h1 class="text-3xl font-bold">{{ $user->name }}</h1>
                    <p class="opacity-90">{{ $user->email }}</p>
                    <span class="inline-block mt-3 px-4 py-1 text-xs bg-red-900 rounded-full tracking-wide">
                        {{ strtoupper($user->role) }}
                    </span>
                </div>
            </div>

            {{-- CONTENT --}}
            <div class="p-8 grid grid-cols-1 md:grid-cols-2 gap-6">

                {{-- INFORMASI AKUN --}}
                <div class="bg-gray-50 rounded-xl p-6">
                    <h2 class="font-semibold text-lg mb-4">📄 Informasi Akun</h2>

                    {{-- MODE VIEW --}}
                    @if (!request()->has('edit'))
                        <ul class="space-y-2 text-sm">
                            <li><b>Nama:</b> {{ $user->name }}</li>
                            <li><b>Email:</b> {{ $user->email }}</li>
                            <li><b>No Telp:</b> {{ $user->NoTelp ?? '-' }}</li>
                        </ul>

                        <a href="{{ route('profile.index', ['edit' => true]) }}"
                            class="inline-block mt-5 px-5 py-2 text-sm rounded-lg bg-red-600 text-white hover:bg-red-700 transition">
                            ✏️ Edit Profil
                        </a>
                    @endif

                    {{-- MODE EDIT --}}
                    @if (request()->has('edit'))
                        <form method="POST" action="{{ route('profile.update') }}" class="space-y-4">
                            @csrf
                            @method('PUT')

                            <div>
                                <label class="block text-sm font-medium mb-1">Nama</label>
                                <input type="text" name="name" value="{{ old('name', $user->name) }}"
                                    class="w-full px-4 py-2 rounded-lg border focus:ring-2 focus:ring-red-500" required>
                            </div>

                            <div>
                                <label class="block text-sm font-medium mb-1">Email</label>
                                <input type="email" name="email" value="{{ old('email', $user->email) }}"
                                    class="w-full px-4 py-2 rounded-lg border focus:ring-2 focus:ring-red-500" required>
                            </div>

                            <div>
                                <label class="block text-sm font-medium mb-1">No Telp</label>
                                <input type="text" name="NoTelp" value="{{ old('NoTelp', $user->NoTelp) }}"
                                    class="w-full px-4 py-2 rounded-lg border focus:ring-2 focus:ring-red-500">
                            </div>

                            <div class="flex gap-3 pt-2">
                                <button type="submit"
                                    class="px-6 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
                                    💾 Simpan
                                </button>

                                <a href="{{ route('profile.index') }}"
                                    class="px-6 py-2 rounded-lg border hover:bg-gray-100">
                                    ✖ Batal
                                </a>
                            </div>
                        </form>
                    @endif
                </div>

                {{-- STATUS AKUN --}}
                <div class="bg-gray-50 rounded-xl p-6">
                    <h2 class="font-semibold text-lg mb-4">📊 Status Akun</h2>
                    <ul class="space-y-2 text-sm">
                        <li><b>Role:</b> {{ strtoupper($user->role) }}</li>
                        <li><b>Bergabung:</b> {{ $user->created_at->format('d M Y') }}</li>
                    </ul>

                    <span class="inline-block mt-4 px-4 py-1 text-xs bg-green-100 text-green-700 rounded-full">
                        ✅ Aktif
                    </span>
                </div>

            </div>

            {{-- FOOTER --}}
            <div class="px-8 py-4 bg-gray-50 flex justify-end">
                <a href="{{ auth()->user()->role === 'admin' ? route('admin.dashboard') : route('user.dashboard') }}"
                    class="px-5 py-2 rounded-lg border text-sm hover:bg-gray-100">
                    ← Kembali
                </a>
            </div>

        </div>

    </div>

</body>

</html>
