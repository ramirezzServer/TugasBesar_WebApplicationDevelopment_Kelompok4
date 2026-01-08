    @extends('layouts.admin')

    @section('content')
        <div class="page-animate">

            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="mb-1">Data Sopir</h2>
                    <p class="text-muted mb-0">
                        Daftar semua sopir yang terdaftar dalam sistem.
                    </p>
                </div>
                <div class="col-6 text-end">
                    <a href="{{ route('admin.sopir.create') }}" class="btn-add">
                        + Tambah Sopir
                    </a>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped text-nowrap align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Nama Sopir</th>
                                    <th>No Telepon</th>
                                    <th>Alamat</th>
                                    <th>Email</th>
                                    <th>Foto</th>
                                    <th class="text-center" style="width: 180px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($sopir as $item)
                                    <tr>
                                        <td><strong>{{ $item->nama_sopir }}</strong></td>
                                        <td>{{ $item->notelp_sopir }}</td>
                                        <td>{{ Str::limit($item->alamat, 30) }}</td>
                                        <td>{{ $item->email_sopir }}</td>
                                        <td>
                                            @if($item->foto)
                                                <img src="{{ asset('storage/' . $item->foto) }}" alt="Foto" width="50" height="50" class="rounded-circle object-fit-cover shadow-sm">
                                            @else
                                                <span class="badge bg-secondary">No Image</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center gap-2">

                                                <a href="{{ route('admin.sopir.edit', $item->id) }}" class="btn-action-edit">
                                                    Edit
                                                </a>

                                                <form action="{{ route('admin.sopir.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn-action-delete">
                                                        Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-5 text-muted">
                                            <div class="mb-2">📂</div>
                                            Belum ada data sopir.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <style>
            .btn-add {
                background-color: #dc3545 !important;
                color: white !important;
                border: none;
                padding: 10px 20px;
                border-radius: 8px;
                font-weight: 600;
                display: inline-flex;
                align-items: center;
                gap: 8px;
                transition: all 0.3s;
                text-decoration: none;
                box-shadow: 0 4px 6px rgba(220, 53, 69, 0.2);
            }
            .btn-add:hover {
                background-color: #bb2d3b !important;
                transform: translateY(-2px);
            }

            .btn-action-edit {
                background-color: #ffc107 !important;
                color: white !important;
                border: none;
                padding: 6px 20px;
                border-radius: 6px;
                font-size: 0.85rem;
                font-weight: 600;
                margin-bottom: 10px;
                text-decoration: none;
                display: inline-flex;
                align-items: center;
                gap: 5px;
                transition: all 0.2s;
                box-shadow: 0 2px 4px rgba(255, 193, 7, 0.3);
            }
            .btn-action-edit:hover {
                background-color: #e0a800 !important;
                transform: translateY(-1px);
            }

            .btn-action-delete {
                background-color: #ff4d4d !important;
                color: white !important;
                border: none;
                padding: 6px 14px;
                border-radius: 6px;
                font-size: 0.85rem;
                font-weight: 600;
                display: inline-flex;
                align-items: center;
                gap: 5px;
                transition: all 0.2s;
                cursor: pointer;
                box-shadow: 0 2px 4px rgba(255, 77, 77, 0.3);
            }
            .btn-action-delete:hover {
                background-color: #cc0000 !important;
                transform: translateY(-1px);
            }

            .table thead th {
                background-color: #f1f3f5;
                color: #495057;
                font-weight: 600;
                border-bottom: 2px solid #dee2e6;
                vertical-align: middle;
            }

            .object-fit-cover {
                object-fit: cover;
            }

            .page-animate {
                animation: fadeIn 0.5s ease-in-out;
            }

            @keyframes fadeIn {
                from { opacity: 0; transform: translateY(10px); }
                to { opacity: 1; transform: translateY(0); }
            }
        </style>
    @endsection
