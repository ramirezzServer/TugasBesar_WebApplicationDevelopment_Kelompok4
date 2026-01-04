@extends('layouts.admin')

@section('content')
    <div class="container-fluid py-4">
        <div class="card shadow-sm border-0" style="border-radius: 12px;">
            <div class="card-header bg-white py-3 border-bottom-0">
                <h3 class="m-0" style="font-weight: 700; color: #333;">Edit Data Halte</h3>
            </div>

            <div class="card-body p-4">
                <form action="{{ route('admin.halte.update', $halte->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group mb-4">
                        <label class="form-label font-weight-bold" style="color: #444;">Nama Halte</label>
                        <input type="text" name="nama_halte"
                            class="form-control @error('nama_halte') is-invalid @enderror"
                            style="padding: 12px; border-radius: 8px; border: 2px solid #eee;"
                            value="{{ old('nama_halte', $halte->nama_halte) }}" required>

                        @error('nama_halte')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-end align-items-center mt-5" style="gap: 15px;">
                        <a href="{{ route('admin.halte.index') }}" class="btn btn-light"
                            style="padding: 10px 25px; border-radius: 8px; font-weight: 600; color: #666; border: 1px solid #ddd;">
                            Batal
                        </a>

                        <button type="submit" class="btn text-white shadow"
                            style="background-color: #b91c1c; border-radius: 8px; padding: 10px 30px; font-weight: 700; border: none;">
                            <i class="fas fa-save mr-2"></i> Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
