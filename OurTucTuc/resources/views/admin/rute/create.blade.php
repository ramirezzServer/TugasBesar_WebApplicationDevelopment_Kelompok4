@extends('layouts.admin')

@section('content')
<div class="page-wrapper">

    <div class="page-container">
        <div class="form-card">

            <h2 class="form-title">Tambah Rute</h2>

            <form action="{{ route('admin.rute.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Nama Rute</label>
                    <input type="text" name="nama_rute" placeholder="Masukkan nama rute" required>
                </div>

                <div class="form-actions">
                    <button>
                    <a href="{{ route('admin.rute.index') }}" class="btn-cancel">
                        Batal
                    </a>
                    </button>
                    <button class="btn-submit">Simpan</button>
                </div>
            </form>

        </div>
    </div>

</div>
@endsection
<style>
.page-wrapper {
    background: #f6f7fb;
    padding: 40px 32px;
    min-height: calc(100vh - 80px);
}

.page-container {
    max-width: 1200px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: 1fr 520px 1fr;

}

.form-card {
    grid-column: 2;
    background: #fff;
    border-radius: 14px;
    padding: 32px;
    box-shadow: 0 10px 30px rgba(0,0,0,.08);
}

.form-title {
    font-size: 22px;
    font-weight: 600;
    margin-bottom: 24px;
    color: #c4161c;
}

.form-group {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.form-group label {
    font-size: 14px;
    font-weight: 500;
}

.form-group input {
    height: 44px;
    padding: 0 14px;
    border-radius: 10px;
    border: 1px solid #ddd;
    font-size: 14px;
}

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
}

.btn-submit {
    padding: 10px 22px;
    border-radius: 10px;
    border: none;
    background: #e63946;
    color: white;
    font-weight: 500;
}
</style>
