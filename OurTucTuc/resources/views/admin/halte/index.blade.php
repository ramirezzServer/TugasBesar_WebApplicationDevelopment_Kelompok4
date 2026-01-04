@extends('layouts.admin')

@section('content')
    <div class="container-fluid py-4">
        <div class="card shadow-sm border-0" style="border-radius: 12px;">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h3 class="m-0" style="font-weight: 700; color: #333;">Data Halte</h3>
                        <p class="text-muted small">Daftar lokasi pemberhentian bus</p>
                    </div>

                    <a href="{{ route('admin.halte.create') }}" class="btn text-white px-4 shadow-sm"
                        style="background-color: #b91c1c; border-radius: 8px; font-weight: 600; padding: 3px 10px;">
                        <i class="fas fa-plus mr-2"></i> Tambah Halte
                    </a>
                </div>

                @if (session('success'))
                    <div class="alert alert-success border-0 shadow-sm mb-4" style="border-radius: 8px;">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-hover border-0">
                        <thead style="background-color: #f8f9fa;">
                            <tr>
                                <th class="py-3 px-4 border-0 text-center"
                                    style="width: 80px; border-radius: 10px 0 0 10px;">No</th>
                                <th class="py-3 px-4 border-0">Nama Halte</th>
                                <th class="py-3 px-4 border-0" style="width: 250px; border-radius: 0 10px 10px 0;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($halte as $index => $item)
                                <tr style="vertical-align: middle;">
                                    <td class="px-4 font-weight-bold text-muted text-center">{{ $index + 1 }}</td>
                                    <td class="px-4" style="font-weight: 500; color: #444;">{{ $item->nama_halte }}</td>
                                    <td class="px-4">
                                        <div class="d-flex align-items-center" style="gap: 12px;">

                                            <a href="{{ route('admin.halte.edit', $item->id) }}"
                                                class="btn btn-sm text-white shadow-sm d-inline-flex align-items-center justify-content-center"
                                                style="background-color: #f59e0b; border-radius: 6px; padding: 8px 16px; font-weight: 600; border: none; height: 36px; min-width: 90px;">
                                                <i class="fas fa-edit mr-1"></i> Edit
                                            </a>

                                            <form action="{{ route('admin.halte.destroy', $item->id) }}" method="POST"
                                                onsubmit="return confirm('Yakin ingin menghapus halte ini?');"
                                                class="m-0" style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="btn btn-sm text-white shadow-sm d-inline-flex align-items-center justify-content-center"
                                                    style="background-color: #b91c1c; border-radius: 6px; padding: 8px 14px; font-weight: 600; border: none; height: 36px; min-width: 90px;">
                                                    <i class="fas fa-trash mr-1"></i> Hapus
                                                </button>
                                            </form>

                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center py-5 text-muted">
                                        <i class="fas fa-info-circle fa-2x mb-3 d-block"></i>
                                        Data Halte Masih Kosong
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
