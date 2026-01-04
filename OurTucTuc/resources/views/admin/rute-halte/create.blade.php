@extends('layouts.admin')

@section('content')
<div class="page-wrapper">

    <div class="page-container">
        <div class="form-card">

            <h2 class="form-title">Tambah Rute - Halte</h2>

            @if ($errors->any())
                <div class="alert-error">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.rute-halte.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label>Rute</label>
                    <select name="id_rute" required>
                        <option value="">Pilih Rute</option>
                        @foreach ($rutes as $rute)
                            <option value="{{ $rute->id }}"
                                {{ old('id_rute') == $rute->id ? 'selected' : '' }}>
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
                                {{ old('id_halte') == $halte->id ? 'selected' : '' }}>
                                {{ $halte->nama_halte }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Jam Berangkat</label>
                    <input type="time"
                           name="jam_berangkat"
                           value="{{ old('jam_berangkat') }}"
                           required>
                </div>

                <div class="form-actions">
                    <a href="{{ route('admin.rute-halte.index') }}" class="btn-cancel">
                        Batal
                    </a>
                    <button class="btn-submit">
                        Simpan
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

/* ===== ALERT ===== */
.alert-error {
    background: #fff5f5;
    border: 1px solid #fecaca;
    color: #b91c1c;
    padding: 14px 16px;
    border-radius: 10px;
    margin-bottom: 20px;
    font-size: 14px;
}

.alert-error ul {
    margin: 0;
    padding-left: 18px;
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
