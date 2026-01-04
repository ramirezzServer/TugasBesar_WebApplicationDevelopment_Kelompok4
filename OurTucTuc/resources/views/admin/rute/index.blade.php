@extends('layouts.admin')

@section('content')
<div class="page-wrapper">


    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <div class="header-title">
                <h4>Data Rute</h4>
            </div>
            <small class="text-muted">
                Kelola daftar rute operasional
            </small>
        </div>

        <div class="flex-shrink-0">
            <a href="{{ route('admin.rute.create') }}"
               class="btn btn-sm btn-danger px-4 py-2">
                + Tambah
            </a>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="table-responsive">
           <table class="table table-borderless align-middle rute-table table-fixed">
                <thead>
                    <tr>
                        <th style="width: 80px">No</th>
                        <th>Nama Rute</th>
                        <th style="width: 140px" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($data as $index => $item)
                        <tr>
                            <td class="text-muted">
                                {{ $index + 1 }}
                            </td>
                            <td>
                                <div class="fw-medium">{{ $item->nama_rute }}</div>
                            </td>
                            <td class="text-center">
                                <div class="d-inline-flex gap-2">
                                    <a href="{{ route('admin.rute.edit', $item->id) }}"
                                       class="btn btn-light btn-sm">
                                        Edit
                                    </a>

                                    <form action="{{ route('admin.rute.destroy', $item->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('Yakin ingin menghapus rute ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-light btn-sm text-danger">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center text-muted py-5">
                                Data tidak ditemukan
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

<style>

.page-wrapper {
    max-width: 1100px;
    margin: 0 auto;
}
.header-title h4 {
    margin: 0;
    font-size: 24px;
    font-weight: 600;
    color: #d11919;
}

.header-title {
    padding-bottom: 6px;
    margin-bottom: 6px;
    border-bottom: 2px solid #e5e7eb;
}

.card {
    border-radius: 14px;
}
.rute-table th:nth-child(2),
.rute-table td:nth-child(2) {
    width: 60%;
}


.rute-table th:nth-child(3),
.rute-table td:nth-child(3) {
    width: 160px;
}

.rute-table thead th {
    font-size: 13px;
    font-weight: 500;
    color: #6b7280;
    padding: 14px 20px;
    border-bottom: 1px solid #e5e7eb;
}

.rute-table tbody td {
    padding: 18px 20px;
    border-bottom: 1px solid #f1f5f9;
    font-size: 14px;
}

.rute-table tbody tr:hover {
    background-color: #f9fafb;
}

.fw-medium {
    font-weight: 500;
}


.btn-light {
    border: 1px solid #e5e7eb;
    border-radius: 10px;
}
</style>
@endsection
