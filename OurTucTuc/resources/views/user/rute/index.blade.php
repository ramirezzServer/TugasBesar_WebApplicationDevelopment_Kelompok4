@extends('layouts.user')

@section('title', 'Rute')

@section('content')
<div class="container-fluid rute-wrapper">

    {{-- HEADER --}}
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div class="wrap-header-title">
            <div class="header-title">
                <h4>Jadwal TUC-TUC</h4>
            </div>
            <small class="text-muted">
                User bisa lihat jadwal TUC-TUC di sini
            </small>
        </div>
    </div>

    {{-- LIST RUTE --}}
    @forelse ($data->groupBy('rute.id') as $ruteGroup)
        <div class="card rute-card mb-3">

            {{-- RUTE HEADER --}}
            <div class="card-header rute-header">
                {{ $ruteGroup->first()->rute->nama_rute }}
            </div>

            {{-- HALTE LIST --}}
            <div class="list-group list-group-flush">
                @foreach ($ruteGroup as $item)
                    <div class="list-group-item halte-item">

                        <div class="halte-info">
                            <span class="halte-name">
                                {{ $item->halte->nama_halte }}
                            </span>

                            <span class="halte-time">
                                {{ $item->jam_berangkat }}
                            </span>
                        </div>

                    </div>
                @endforeach
            </div>
        </div>
    @empty
        <div class="text-center text-muted py-5">
            Data tidak ditemukan
        </div>
    @endforelse

</div>

{{-- STYLE --}}
<style>
/* ===== WRAPPER ===== */
.rute-wrapper {
    max-width: 1100px;
    margin: 0 auto;
}

/* ===== HEADER ===== */
.header-title h4 {
    margin: 0;
    font-size: 24px;
    font-weight: 600;
    color: #d11919;
}

.header-title {
    padding-bottom: 6px;
    margin-bottom: 4px;
    border-bottom: 2px solid #e5e7eb;
}

.wrap-header-title {
    display: flex;
    flex-direction: column;
    gap: 4px;
}

/* ===== CARD ===== */
.rute-card {
    border-radius: 14px;
    border: 1px solid #e5e7eb;
    box-shadow: 0 4px 14px rgba(0,0,0,0.04);
}

/* ===== CARD HEADER ===== */
.rute-header {
    background-color: #fff;
    padding: 14px 20px;
    font-size: 20px;
    font-weight: 600;
    color: #111827;
    border-bottom: 1px solid #f1f5f9;
}

/* ===== HALTE ITEM ===== */
.halte-item {
    padding: 14px 20px;
    border: none;
}

.halte-item:hover {
    background-color: #f9fafb;
}

/* ===== HALTE CONTENT ===== */
.halte-info {
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.halte-name {
    font-size: 14px;
    font-weight: 500;
    color: #111827;
}

.halte-time {
    font-size: 13px;
    color: #6b7280;
    background-color: #f3f4f6;
    padding: 4px 10px;
    border-radius: 999px;
    white-space: nowrap;
}
</style>
@endsection
