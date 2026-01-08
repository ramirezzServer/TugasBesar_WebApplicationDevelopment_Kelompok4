```@extends('layouts.admin')

@section('content')
    <div class="page-animate">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="mb-1">Edit Data Sopir</h2>
                <p class="text-muted mb-5">
                    Silakan perbarui data sopir di bawah ini.
                </p>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.sopir.update', $sopir->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">Nama Sopir</label>
                        <input type="text" name="nama_sopir" class="form-control" required
                               value="{{ old('nama_sopir', $sopir->nama_sopir) }}"
                               placeholder="Masukkan nama lengkap">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">No Telepon</label>
                        <input type="number" name="notelp_sopir" class="form-control" required
                               value="{{ old('notelp_sopir', $sopir->notelp_sopir) }}"
                               placeholder="08...">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Alamat</label>
                        <textarea name="alamat" class="form-control" rows="3" required
                                  placeholder="Masukkan alamat lengkap">{{ old('alamat', $sopir->alamat) }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email_sopir" class="form-control" required
                               value="{{ old('email_sopir', $sopir->email_sopir) }}"
                               placeholder="email@contoh.com">
                    </div>

                    <div class="mb-3">
                        <label class="form-label d-block">Foto Saat Ini</label>

                        @if($sopir->foto)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $sopir->foto) }}" alt="Foto Lama" width="100" class="img-thumbnail">
                            </div>
                        @else
                            <div class="mb-2 text-muted fst-italic">
                                <small>Belum ada foto yang diunggah.</small>
                            </div>
                        @endif

                        <label class="form-label mt-2">Ganti Foto (Opsional)</label>
                        <input type="file" name="foto" class="form-control">
                        <small class="text-muted">Biarkan kosong jika tidak ingin mengubah foto.</small>
                    </div>

                    <hr class="my-4">

                    <div class="form-action d-flex gap-3">

                        <button type="submit" class="btn-save">
                            Save
                        </button>

                        <a href="{{ route('admin.sopir.index') }}" class="btn-cancel">
                            Cancel
                        </a>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <style>
        .btn-back {
            text-decoration: none;
            color: #6c757d;
            font-weight: 600;
            padding: 8px 16px;
            border-radius: 8px;
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            transition: all 0.3s;
        }
        .btn-back:hover {
            background-color: #e9ecef;
            color: #495057;
        }

        .btn-save {
            background-color: #dc3545 !important;
            color: white !important;
            border: none;
            padding: 10px 24px;
            border-radius: 8px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s;
            cursor: pointer;
            text-decoration: none;
        }
        .btn-save:hover {
            background-color: #bb2d3b !important;
            color: white !important;
            transform: translateY(-1px);
        }

        /* Style untuk tombol Batal */
        .btn-cancel {
            background-color: white;
            color: #6c757d;
            border: 1px solid #dee2e6;
            padding: 10px 24px;
            border-radius: 8px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s;
        }
        .btn-cancel:hover {
            background-color: #f8f9fa;
            color: #dc3545;
            border-color: #dc3545;
        }

        .form-label {
            font-weight: 500;
            margin-bottom: 0.5rem;
        }

        .page-animate {
            animation: fadeIn 0.5s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
@endsection```
