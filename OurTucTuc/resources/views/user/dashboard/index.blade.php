@extends('layouts.user')

@section('content')
   <div class="container mx-auto p-6">

    {{-- HEADER --}}
    <div class="mb-6">
        <h1 class="text-2xl font-bold">Dashboard Kendaraan</h1>
        <p class="text-gray-500">Pantau rute, halte, dan status TUC-TUC</p>
    </div>

    {{-- ROUTE DETAILS --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        @foreach ($rutes as $rute)
        <div class="bg-white rounded-xl shadow p-5">

            {{-- RUTE TITLE --}}
            <h2 class="text-lg font-semibold mb-4">
                🚏 {{ $rute->nama_rute }}
            </h2>

            {{-- LIST HALTE --}}
            <div class="space-y-4">

                @foreach ($rute->rute_halte as $rh)
                <div class="border-l-4 pl-4
                    {{ $rh->jadwalSopir->first()?->status_auto == 'Aktif' ? 'border-green-500' : '' }}
                    {{ $rh->jadwalSopir->first()?->status_auto == 'Belum Aktif' ? 'border-yellow-500' : '' }}
                    {{ $rh->jadwalSopir->first()?->status_auto == 'Selesai' ? 'border-gray-400' : '' }}
                ">

                    <div class="flex justify-between items-center">
                        <div>
                            <p class="font-medium">{{ $rh->halte->nama_halte }}</p>
                            <p class="text-sm text-gray-500">
                                {{ $rh->halte->alamat ?? '-' }}
                            </p>
                        </div>

                        {{-- STATUS BADGE --}}
                        @php
                            $jadwal = $rh->jadwalSopir->first();
                        @endphp

                        @if ($jadwal)
                            <span class="px-3 py-1 text-sm rounded-full
                                {{ $jadwal->status_auto == 'Aktif' ? 'bg-green-100 text-green-700' : '' }}
                                {{ $jadwal->status_auto == 'Belum Aktif' ? 'bg-yellow-100 text-yellow-700' : '' }}
                                {{ $jadwal->status_auto == 'Selesai' ? 'bg-gray-200 text-gray-700' : '' }}
                            ">
                                {{ $jadwal->status_auto }}
                            </span>
                        @endif
                    </div>

                    {{-- DETAIL JADWAL --}}
                    @if ($jadwal)
                    <div class="mt-2 text-sm text-gray-600">
                        🚐 {{ $jadwal->kendaraan->plat_nomor }} <br>
                        👤 {{ $jadwal->sopir->nama_sopir }} <br>
                        ⏰ {{ $jadwal->jam_mulai }} - {{ $jadwal->jam_selesai }}
                    </div>
                    @endif

                </div>
                @endforeach

            </div>

        </div>
        @endforeach

    </div>

</div>
@endsection
