@extends('layouts.admin')

@section('content')

<div class="kendaraan-wrapper">
    {{-- Header --}}
    <div class="kendaraan-header">
        <div>
            <h2>Data Kendaraan</h2>
            <p>Kelola data kendaraan tuc-tuc yang tersedia</p>
        </div>
        <button class="btn-tambah" data-bs-toggle="modal" data-bs-target="#tambahModal">
            <span>+</span> Tambah Kendaraan
        </button>
    </div>

    {{-- Alert Success --}}
    @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Table Card --}}
    <div class="kendaraan-table-card">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Plat Nomor</th>
                    <th>Status</th>
                    <th style="width: 200px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($kendaraans as $index => $kendaraan)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            <strong style="font-size: 15px; color: var(--hitam);">{{ $kendaraan->plat_nomor }}</strong>
                        </td>
                        <td>
                            <span class="status-badge {{ $kendaraan->status }}">
                                {{ ucfirst($kendaraan->status) }}
                            </span>
                        </td>
                        <td>
                            <div class="aksi-buttons">
                                <button class="btn-edit" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#editModal{{ $kendaraan->id }}">
                                    Edit
                                </button>

                                <form action="{{ route('admin.kendaraan.destroy', $kendaraan->id) }}" 
                                      method="POST" 
                                      class="d-inline" 
                                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus kendaraan ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-hapus">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>

                    {{-- Modal Edit --}}
                    <div class="modal fade" id="editModal{{ $kendaraan->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{ route('admin.kendaraan.update', $kendaraan->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Kendaraan</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label class="form-label">Plat Nomor</label>
                                            <input type="text" 
                                                   name="plat_nomor" 
                                                   class="form-control" 
                                                   value="{{ $kendaraan->plat_nomor }}" 
                                                   required
                                                   placeholder="Masukkan plat nomor">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Status</label>
                                            <select name="status" class="form-select" required>
                                                <option value="aktif" {{ $kendaraan->status == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                                <option value="nonaktif" {{ $kendaraan->status == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn-secondary" type="button" data-bs-dismiss="modal">Batal</button>
                                        <button class="btn-primary" type="submit">Simpan Perubahan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <tr>
                        <td colspan="4" class="empty-state">
                            <p>Belum ada data kendaraan</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- Modal Tambah --}}
<div class="modal fade" id="tambahModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.kendaraan.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Kendaraan Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Plat Nomor</label>
                        <input type="text" 
                               name="plat_nomor" 
                               class="form-control" 
                               required
                               placeholder="Contoh: B 1234 XYZ">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select" required>
                            <option value="aktif" selected>Aktif</option>
                            <option value="nonaktif">Nonaktif</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn-secondary" type="button" data-bs-dismiss="modal">Batal</button>
                    <button class="btn-primary" type="submit">Tambah Kendaraan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
