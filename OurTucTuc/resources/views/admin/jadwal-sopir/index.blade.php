@extends('layouts.admin')

@section('head')
<link rel="stylesheet" href="{{ asset('css/jadwalsopir.css') }}">
@endsection

@section('content')
<div class="jadwal-sopir-wrapper">

    {{-- HEADER --}}
    <div class="jadwal-sopir-header">
        <div>
            <h2>Jadwal Sopir</h2>
            <p>Kelola jadwal kerja sopir</p>
        </div>

    {{-- SEARCH --}}
    <form action="{{ route('admin.jadwal-sopir') }}" method="GET" class="mb-3">
        <div class="input-group">
            <input type="text"
                   name="search"
                   class="form-control"
                   placeholder="Cari sopir / plat kendaraan / rute / status"
                   value="{{ request('search') }}">

            <button class="btn-secondary" type="submit">
                🔍 Search
            </button>
            @if(request('search'))
                <a href="{{ route('admin.jadwal-sopir') }}" class="btn-reset">
                    Reset
                </a>
            @endif
        </div>
    </form>

    {{-- BUTTON TAMBAH --}}
    <a href="{{ route('admin.jadwal-sopir.create') }}" class="btn-primary">
        + Tambah Jadwal
    </a>
    
</form>
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
                            <span class="status {{ $item->status ?? 'belum_aktif' }}">
                                {{ ucfirst($item->status ?? 'belum aktif') }}
                            </span>
                        </td>

                        <td>
                            {{ $item->created_at->format('d M Y') }}<br>
                            <small>{{ $item->created_at->format('H:i') }}</small>
                        </td>

                        {{-- AKSI --}}
                        <td>
                            <a href="{{ route('admin.jadwal-sopir.edit', $item->id) }}"
                               class="btn-warning">
                                Edit
                            </a>

                            <form action="{{ route('admin.jadwal-sopir.destroy', $item->id) }}"
                                  method="POST"
                                  style="display:inline-block">
                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="btn-danger"
                                        onclick="return confirm('Hapus jadwal ini?')">
                                    Hapus
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
