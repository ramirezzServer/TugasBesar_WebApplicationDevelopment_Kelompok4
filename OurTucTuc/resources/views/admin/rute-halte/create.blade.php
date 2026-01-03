@extends('layouts.admin')

@section('content')
<div class="card">
    <h2>Tambah Rute - Halte</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.rute-halte.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Rute</label>
            <select name="id_rute" class="form-select" required>
                <option value="">-- Pilih Rute --</option>
                @foreach ($rutes as $rute)
                    <option value="{{ $rute->id }}"
                        {{ old('id_rute') == $rute->id ? 'selected' : '' }}>
                        {{ $rute->nama_rute }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Halte</label>
            <select name="id_halte" class="form-select" required>
                <option value="">-- Pilih Halte --</option>
                @foreach ($haltes as $halte)
                    <option value="{{ $halte->id }}"
                        {{ old('id_halte') == $halte->id ? 'selected' : '' }}>
                        {{ $halte->nama_halte }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Jam Berangkat</label>
            <input type="time"
                   name="jam_berangkat"
                   class="form-control"
                   value="{{ old('jam_berangkat') }}"
                   required>
        </div>

        <div class="d-flex gap-2">
            <button class="btn btn-primary">Simpan</button>
            <a href="{{ route('admin.rute-halte.index') }}" class="btn btn-secondary">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection
