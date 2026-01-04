@extends('layouts.admin')

@section('content')
<div class="container-fluid">

   <!-- header yh-->
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <div class="header-title">
                <h4>Rute & Halte</h4>
            </div>

            <small class="text-muted">
                Kelola rute dan halte beserta jam keberangkatan
            </small>
        </div>

        <div class="flex-shrink-0">
            <a href="{{ route('admin.rute-halte.create') }}"
                class="btn btn-sm btn-danger px-4 py-2">
                + Tambah
            </a>
        </div>
    </div>

    <!-- List  datany-->
    @forelse ($data->groupBy('rute.id') as $ruteGroup)
    <div class="card border shadow-sm mb-3">
        <div class="card-header bg-white fw-semibold">
            {{ $ruteGroup->first()->rute->nama_rute }}
        </div>

        <div class="list-group list-group-flush">
            @foreach ($ruteGroup as $item)
            <div class="list-group-item d-flex justify-content-between align-items-center hover-shadow">

                <div class="d-flex flex-column">
                    <span class="fw-medium">{{ $item->halte->nama_halte }}</span>
                    <small class="text-muted">
                        Jam Berangkat: {{ $item->jam_berangkat }}
                    </small>
                </div>

                <div class="d-flex gap-2">
                    <a href="{{ route('admin.rute-halte.edit', $item->id) }}"
                        class="btn btn-light btn-sm">
                        Edit
                    </a>

                    <form action="{{ route('admin.rute-halte.destroy', $item->id) }}"
                        method="POST"
                        onsubmit="return confirm('Yakin ingin menghapus halte ini dari rute?');">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-light btn-sm text-danger">
                            Hapus
                        </button>
                    </form>
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

<style>
    .header-title h4 {
        margin: 0;
        font-size: 24px;
        font-weight: 600;
        color: #d11919ff;
    }

    .card {
        border-radius: 12px;
    }

    .card-header {
        font-size: 15px;
        padding: 14px 20px;
    }


    .list-group-item {
        padding: 16px 20px;
        border: none;
    }

    .hover-shadow:hover {
        background-color: #f9fafb;
    }


    .btn-light {
        border: 1px solid #e5e7eb;
    }

    .header-title {
        padding-bottom: 6px;
        margin-bottom: 6px;
        border-bottom: 2px solid #e5e7eb;
        gap: 4px;
    }

    .wrap-header-title {
        display: flex;
        flex-direction: column;
    }
</style>
@endsection

