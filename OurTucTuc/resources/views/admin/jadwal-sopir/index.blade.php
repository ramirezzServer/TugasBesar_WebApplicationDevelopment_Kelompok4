@extends('layouts.admin')

@section('head')
<link rel="stylesheet" href="{{ asset('css/jadwal-sopir.css') }}">

@section('content')
<div class="jadwal-sopir-wrapper">

    {{-- HEADER --}}
    <div class="jadwal-sopir-header">
        <div>
            <h2>Jadwal Sopir</h2>
            <p>Kelola jadwal kerja sopir</p>
        </div>

    {{-- SEARCH --}}
    <form action="{{ route('jadwal-sopir.index') }}" method="GET" class="mb-3">
    <div class="input-group">
        <input type="text"
               name="search"
               class="form-control"
               placeholder="Cari sopir / plat kendaraan / rute / status"
               value="{{ request('search') }}">

        <button class="btn btn-secondary" type="submit">
            Search
        </button>
    </div>
    </form>

        {{-- BUTTON TAMBAH --}}
        <a href="{{ route('jadwal-sopir.create') }}" class="btn btn-primary">
            Tambah Jadwal
        </a>
    </div>

    {{-- FLASH MESSAGE --}}
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- TABLE --}}
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
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
                @forelse($jadwalSopir as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>

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

                        <td>{{ $item->jam_mulai ?? '-' }}</td>
                        <td>{{ $item->jam_selesai ?? '-' }}</td>

                        <td>{{ ucfirst($item->status ?? 'belum aktif') }}</td>

                        <td>
                            {{ $item->created_at->format('d M Y') }}<br>
                            <small>{{ $item->created_at->format('H:i') }}</small>
                        </td>

                        {{-- AKSI --}}
                        <td>
                            <a href="{{ route('jadwal-sopir.edit', $item->id) }}"
                               class="btn btn-sm btn-warning">
                                Update
                            </a>

                            <form action="{{ route('jadwal-sopir.destroy', $item->id) }}"
                                  method="POST"
                                  style="display:inline-block">
                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="btn btn-sm btn-danger"
                                        onclick="return confirm('Hapus jadwal ini?')">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center">
                            Belum ada jadwal sopir
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection
