@extends('layouts.user')

@section('content')
    <div class="keluhan-wrapper page-animate">

        {{-- HEADER --}}
        <div class="keluhan-header">
            <div>
                <h2>Edit Keluhan</h2>
                <p>
                    Perbarui keluhan Anda.
                    <strong>Perhatian:</strong> keluhan yang diedit akan diajukan ulang.
                </p>
            </div>

            <a href="{{ route('user.keluhan') }}" class="btn-back">
                ← Kembali
            </a>
        </div>

        {{-- CARD --}}
        <div class="keluhan-edit-card">

            {{-- INFO STATUS --}}
            <div class="keluhan-info">
                <div class="info-icon">ℹ️</div>
                <div class="info-text">
                    Status saat ini:
                    <span class="status {{ $keluhan->status }}">
                        {{ ucfirst($keluhan->status) }}
                    </span>

                    @if ($keluhan->status === 'diajukan')
                        <div class="info-warning">
                            Keluhan masih <strong>diajukan</strong>, tidak dapat diedit.
                        </div>
                    @else
                        <div class="info-warning">
                            Setelah disimpan, status akan kembali menjadi
                            <strong>Diajukan</strong>.
                        </div>
                    @endif
                </div>
            </div>

            {{-- FORM --}}
            <form id="editForm" method="POST" action="{{ route('user.keluhan.update', $keluhan->id) }}">
                @csrf
                @method('PUT')

                <label class="form-label">Nama Keluhan</label>

                <textarea id="keluhanText" name="nama_keluhan" rows="5"
                    class="form-control @error('nama_keluhan') is-invalid @enderror" maxlength="255"
                    {{ $keluhan->status === 'diajukan' ? 'disabled' : '' }} required>{{ old('nama_keluhan', $keluhan->nama_keluhan) }}</textarea>

                <div class="char-counter">
                    <span id="charCount">0</span>/255 karakter
                </div>

                @error('nama_keluhan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror

                {{-- ACTION --}}
                <div class="form-action">
                    @if ($keluhan->status !== 'diajukan')
                        <button type="button" class="btn-save" onclick="openConfirm()">
                            💾 Simpan Perubahan
                        </button>
                    @endif

                    <a href="{{ route('user.keluhan') }}" class="btn-cancel">
                        ✖ Batal
                    </a>
                </div>
            </form>
        </div>
    </div>

    {{-- MODAL CONFIRM --}}
    <div id="confirmModal" class="modal-overlay">
        <div class="modal-box">
            <h3>Konfirmasi Perubahan</h3>
            <p>
                Mengubah keluhan akan mengatur ulang status menjadi
                <strong>Diajukan</strong>.
            </p>

            <div class="modal-action">
                <button class="btn-save" onclick="submitForm()">Ya, Simpan</button>
                <button class="btn-cancel" onclick="closeConfirm()">Batal</button>
            </div>
        </div>
    </div>

    {{-- INLINE SCRIPT --}}
    <script>
        const textarea = document.getElementById('keluhanText');
        const counter = document.getElementById('charCount');
        const modal = document.getElementById('confirmModal');

        // Auto focus
        if (textarea && !textarea.disabled) {
            textarea.focus();
        }

        // Character counter
        function updateCounter() {
            counter.innerText = textarea.value.length;
        }
        if (textarea) {
            updateCounter();
            textarea.addEventListener('input', updateCounter);
        }

        // Modal
        function openConfirm() {
            modal.classList.add('show');
        }

        function closeConfirm() {
            modal.classList.remove('show');
        }

        function submitForm() {
            document.getElementById('editForm').submit();
        }
    </script>
@endsection
