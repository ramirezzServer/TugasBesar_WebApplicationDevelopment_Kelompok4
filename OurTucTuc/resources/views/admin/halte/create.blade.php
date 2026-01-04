@extends('layouts.admin')

@section('content')
    <div class="container-fluid py-4">
        <div class="card shadow-sm border-0" style="border-radius: 12px;">
            <div class="card-header bg-white py-3 border-bottom-0">
                <h3 class="m-0" style="font-weight: 700; color: #333;">Tambah Data Halte</h3>
            </div>

            <div class="card-body p-4">
                <form action="{{ route('admin.halte.store') }}" method="POST">
                    @csrf

                    <div class="form-group mb-4">
                        <label for="nama_halte" class="form-label font-weight-bold"
                            style="color: #444; font-size: 14px;">Nama Halte</label>
                        <input type="text" name="nama_halte" id="nama_halte"
                            class="form-control @error('nama_halte') is-invalid @enderror"
                            placeholder="Masukkan nama halte baru..."
                            style="padding: 15px; border-radius: 10px; border: 2px solid #eee; font-size: 15px;"
                            value="{{ old('nama_halte') }}" required>

                        @error('nama_halte')
                            <div class="invalid-feedback font-weight-bold">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-end align-items-center mt-5" style="gap: 15px;">
                        <a href="{{ route('admin.halte.index') }}" class="btn btn-light"
                            style="padding: 12px 30px; border-radius: 10px; font-weight: 600; color: #666; border: 1px solid #ddd;">
                            Batal
                        </a>

                        <button type="submit" class="btn text-white shadow"
                                style="background-color: #b91c1c;
                                    border-radius: 10px;
                                    padding: 12px 45px;
                                    font-weight: 700;
                                    font-size: 16px;
                                    border: none;
                                    min-width: 160px;
                                    display: inline-block;
                                    line-height: 1.5;">
                            <i class="fas fa-save mr-2"></i> Simpan Halte
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style>
        /* Mengatur fokus input agar berwarna merah sesuai tema */
        .form-control:focus {
            border-color: #b91c1c !error;
            box-shadow: 0 0 0 0.2rem rgba(185, 28, 28, 0.1);
            outline: none;
        }

        /* Efek hover tombol */
        .btn:hover {
            opacity: 0.9;
            transform: translateY(-2px);
            transition: all 0.2s ease;
        }
    </style>
@endsection
