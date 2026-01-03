@extends('layouts.admin')

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-body">
        <h4 class="mb-4 fw-semibold">Edit Rute – Halte</h4>

        <form action="{{ route('admin.rute-halte.update', $ruteHalte->id) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Rute --}}
            <div class="mb-3">
                <label class="form-label">Rute</label>
                <select name="id_rute" class="form-select" required>
                    <option value="">Pilih Rute</option>
                    @foreach ($rutes as $rute)
                        <option value="{{ $rute->id }}"
                            {{ $ruteHalte->id_rute == $rute->id ? 'selected' : '' }}>
                            {{ $rute->nama_rute }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Halte --}}
            <div class="mb-3">
                <label class="form-label">Halte</label>
                <select name="id_halte" class="form-select" required>
                    <option value="">Pilih Halte</option>
                    @foreach ($haltes as $halte)
                        <option value="{{ $halte->id }}"
                            {{ $ruteHalte->id_halte == $halte->id ? 'selected' : '' }}>
                            {{ $halte->nama_halte }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Jam Berangkat --}}
            <div class="mb-4">
                <label class="form-label">Jam Berangkat</label>
                <input
                    type="time"
                    name="jam_berangkat"
                    class="form-control"
                    value="{{ $ruteHalte->jam_berangkat }}"
                    required>
            </div>

            {{-- Action --}}
            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('admin.rute-halte.index') }}"
                    class="btn btn-secondary">
                    Batal
                </a>
                <button type="submit" class="btn btn-outline-primary">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
