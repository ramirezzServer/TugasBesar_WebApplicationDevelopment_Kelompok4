@extends('layouts.admin')

@section('content')
<div class="card">
    <h2 class="text-2xl font-semibold my-2">Dashboard Admin</h2>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    <div class="card">
        <p class="font-poppins text-lg font-medium">Total Keluhan</p>
        <strong>{{ $totalKeluhan ?? 0 }}</strong>
    </div>
    <div class="card">
        <p class="font-poppins text-lg font-medium">Total Sopir</p>
        <strong>{{ $totalSopir ?? 0 }}</strong>
    </div>
    <div class="card">
        <p class="font-poppins text-lg font-medium">Total Kendaraan</p>
        <strong>{{ $totalKendaraan ?? 0 }}</strong>
    </div>
</div>


<div class="card">
    <div class="my-4 ">
        <p class="text-2xl font-semibold">Data jadwal yang sedang aktif</p>
    </div>
    <div class="relative overflow-x-auto bg-neutral-primary-soft shadow-xs rounded-base border border-default">
        <table class="w-full text-sm text-left rtl:text-right text-body">
            <thead class="text-lg text-body bg-neutral-secondary-soft border-b rounded-base border-default">
                <tr>
                    <th scope="col" class="px-6 py-3 font-medium">
                        No
                    </th>
                    <th scope="col" class="px-6 py-3 font-medium">
                        Jam berangkat
                    </th>
                    <th scope="col" class="px-6 py-3 font-medium">
                        Nama rute
                    </th>
                    <th scope="col" class="px-6 py-3 font-medium">
                        Nama halte
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($data as $index => $item)
                <tr class="text-base bg-neutral-primary border-b border-default">
                    <th scope="row" class="px-6 py-4 font-medium text-heading whitespace-nowrap">
                        {{ $index + 1 }}
                    </th>
                    <td class="px-6 py-4">
                        {{ $item->jam_berangkat }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $item->rute->nama_rute ?? '-' }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $item->halte->nama_halte ?? '-' }}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                        Tidak ada jadwal aktif
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
