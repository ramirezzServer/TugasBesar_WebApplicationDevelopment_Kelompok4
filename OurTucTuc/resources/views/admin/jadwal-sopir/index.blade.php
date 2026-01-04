@extends('layouts.admin')

@section('head')
<link rel="stylesheet" href="{{ asset('css/jadwalsopir.css') }}">
@endsection

@section('content')
<div class="js-wrapper">

    {{-- HEADER --}}
    <div class="js-header">
        {{-- KIRI: Judul --}}
        <div class="js-title-section">
            <h2 class="js-title">Jadwal Sopir</h2>
            <p class="js-subtitle">Kelola jadwal kerja sopir</p>
        </div>

        {{-- KANAN: Search + Button --}}
        <div class="js-action-group">
            <form action="{{ route('admin.jadwal-sopir') }}" method="GET" class="js-search-form">
                <input type="text"
                       name="search"
                       class="js-search-input"
                       placeholder="Cari sopir / plat kendaraan / rute / status"
                       value="{{ request('search') }}">
                <button class="js-btn-primary" type="submit">Cari</button>
            </form>

            <a href="{{ route('admin.jadwal-sopir.create') }}" class="js-btn-primary">
                + Tambah Jadwal
            </a>
        </div>
    </div>

    {{-- FLASH MESSAGE --}}
    @if (session('success'))
        <div class="js-alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- TABLE --}}
    <div class="js-table-container">
        <table class="js-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Sopir</th>
                    <th>Kendaraan</th>
                    <th>Rute</th>
                    <th>Jam Mulai</th>
                    <th>Jam Selesai</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($data as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>

                        <td>
                            {{ data_get($item, 'sopir.nama_sopir', '-') }}<br>
                            <small>{{ data_get($item, 'sopir.notelp_sopir') }}</small>
                        </td>

                        <td>
                            {{ data_get($item, 'kendaraan.plat_nomor', '-') }}<br>
                            <small>{{ ucfirst(data_get($item, 'kendaraan.status', '-')) }}</small>
                        </td>

                        <td>
                            {{ data_get($item, 'ruteHalte.rute.nama_rute', '-') }}<br>
                            <small>{{ data_get($item, 'ruteHalte.halte.nama_halte') }}</small>
                        </td>

                        <td>{{ $item->jam_mulai ? \Carbon\Carbon::parse($item->jam_mulai)->format('H:i') : '-' }}</td>
                        <td>{{ $item->jam_selesai ? \Carbon\Carbon::parse($item->jam_selesai)->format('H:i') : '-' }}</td>

                        <td>
                            <span class="js-status js-status-{{ $item->status ?? 'belum_aktif' }}">
                                {{ ucfirst($item->status ?? 'belum aktif') }}
                            </span>
                        </td>

                        <td>
                            {{ $item->created_at->format('d M Y') }}<br>
                            <small>{{ $item->created_at->format('H:i') }}</small>
                        </td>

                        <td>
                            <a href="{{ route('admin.jadwal-sopir.update', $item->id) }}" class="js-btn-warning">
                                Edit
                            </a>

                            <form action="{{ route('admin.jadwal-sopir.destroy', $item->id) }}"
                                  method="POST"
                                  style="display:inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="js-btn-danger"
                                        onclick="return confirm('Hapus jadwal ini?')">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="js-text-center">
                            Belum ada jadwal sopir
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection