@extends('layouts.admin')

@section('content')
<div class="page-wrapper">

    <div class="page-container">
        <div class="form-card">

            <h2 class="form-title">Edit Rute – Halte</h2>

            <form action="{{ route('admin.rute-halte.update', $ruteHalte->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label>Rute</label>
                    <select name="id_rute" required>
                        <option value="">Pilih Rute</option>
                        @foreach ($rutes as $rute)
                            <option value="{{ $rute->id }}"
                                {{ $ruteHalte->id_rute == $rute->id ? 'selected' : '' }}>
                                {{ $rute->nama_rute }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Halte</label>
                    <select name="id_halte" required>
                        <option value="">Pilih Halte</option>
                        @foreach ($haltes as $halte)
                            <option value="{{ $halte->id }}"
                                {{ $ruteHalte->id_halte == $halte->id ? 'selected' : '' }}>
                                {{ $halte->nama_halte }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Jam Berangkat</label>
                    <input type="time"
                           name="jam_berangkat"
                           value="{{ $ruteHalte->jam_berangkat }}"
                           required>
                </div>

                <div class="form-actions">
                    <a href="{{ route('admin.rute-halte.index') }}" class="btn-cancel">
                        Batal
                    </a>
                    <button class="btn-submit">
                        Simpan Perubahan
                    </button>
                </div>
            </form>

        </div>
    </div>

</div>
@endsection

<style>
/* ===== PAGE ===== */
.page-wrapper {
    background: #f6f7fb;
    padding: 40px 32px;
    min-height: calc(100vh - 80px);
}

.page-container {
    display: grid;
    grid-template-columns: 1fr 520px 1fr;
}

/* ===== CARD ===== */
.form-card {
    grid-column: 2;
    background: #fff;
    border-radius: 14px;
    padding: 32px;
    box-shadow: 0 10px 30px rgba(0,0,0,.08);
}

/* ===== TITLE ===== */
.form-title {
    font-size: 22px;
    font-weight: 600;
    margin-bottom: 24px;
    color: #c4161c;
}

/* ===== FORM ===== */
.form-group {
    display: flex;
    flex-direction: column;
    gap: 8px;
    margin-bottom: 20px;
}

.form-group label {
    font-size: 14px;
    font-weight: 500;
}

.form-group input,
.form-group select {
    height: 44px;
    padding: 0 14px;
    border-radius: 10px;
    border: 1px solid #ddd;
    font-size: 14px;
}

.form-group input:focus,
.form-group select:focus {
    outline: none;
    border-color: #d11919;
}

/* ===== ACTION ===== */
.form-actions {
    display: flex;
    justify-content: flex-end;
    gap: 12px;
    margin-top: 28px;
}

.btn-cancel {
    padding: 10px 18px;
    border-radius: 10px;
    border: 1px solid #ddd;
    background: white;
    color: #111;
    text-decoration: none;
    font-size: 14px;
}

.btn-submit {
    padding: 10px 22px;
    border-radius: 10px;
    border: none;
    background: #e63946;
    color: white;
    font-weight: 500;
    font-size: 14px;
}
</style>
