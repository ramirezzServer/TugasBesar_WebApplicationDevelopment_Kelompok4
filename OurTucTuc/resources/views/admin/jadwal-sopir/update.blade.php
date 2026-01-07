@extends('layouts.admin')

@section('head')
<link rel="stylesheet" href="{{ asset('css/jadwalsopir.css') }}">
@endsection

@section('content')

    <div class="js-form-wrapper">

        {{-- HEADER --}}
        <div class="js-header">
            <div>
                <div class="js-title-section">
            <h2 class="js-title">Edit Jadwal Sopir</h2>
            <p class="js-subtitle">Perbarui jadwal sopir yang ada</p>
        </div>
            </div>
            <a href="{{ route('admin.jadwal-sopir') }}" class="btn-back">
                ← Kembali
            </a>
        </div>

        {{-- FLASH MESSAGE --}}
        @if (session('success'))
            <div class="alert-success">
                {{ session('success') }}
            </div>
        @endif

        {{-- FORM CARD --}}
        <div class="js-form-card">
            <form method="POST" action="{{ route('admin.jadwal-sopir.update', $jadwalSopir->id) }}">
                @csrf
                @method('PUT')
                <div class="form-row">
                    {{-- SOPIR --}}
                    <div class="form-group">
                        <label for="id_sopir">Sopir <span class="required">*</span></label>
                        <select name="id_sopir" id="id_sopir" required>
                            <option value="">Pilih Sopir</option>
                            @foreach ($sopirs as $sopir)
                                <option value="{{ $sopir->id }}"
                                    @selected(old('id_sopir', $jadwalSopir->id_sopir) == $sopir->id)>
                                    {{ $sopir->nama_sopir }}
                                    @if($sopir->notelp_sopir)
                                        - {{ $sopir->notelp_sopir }}
                                    @endif
                                </option>
                            @endforeach
                        </select>
                        @error('id_sopir')
                            <small class="error">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- KENDARAAN --}}
                    <div class="form-group">
                        <label for="id_kendaraan">Kendaraan <span class="required">*</span></label>
                        <select name="id_kendaraan" id="id_kendaraan" required>
                            <option value="">Pilih Kendaraan</option>
                            @foreach ($kendaraans as $kendaraan)
                                <option value="{{ $kendaraan->id }}"
                                    @selected(old('id_kendaraan', $jadwalSopir->id_kendaraan) == $kendaraan->id)>
                                    {{ $kendaraan->plat_nomor }}
                                    @if($kendaraan->status)
                                        ({{ ucfirst($kendaraan->status) }})
                                    @endif
                                </option>
                            @endforeach
                        </select>
                        @error('id_kendaraan')
                            <small class="error">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                {{-- RUTE HALTE --}}
                <div class="form-group">
                    <label for="id_rute_halte">Rute & Halte <span class="required">*</span></label>
                    <select name="id_rute_halte" id="id_rute_halte" required>
                        <option value="">Pilih Rute & Halte</option>
                        @foreach ($ruteHaltes as $ruteHalte)
                            <option value="{{ $ruteHalte->id }}"
                                @selected(old('id_rute_halte', $jadwalSopir->id_rute_halte) == $ruteHalte->id)>
                                {{ $ruteHalte->rute->nama_rute ?? 'Rute' }} -
                                {{ $ruteHalte->halte->nama_halte ?? 'Halte' }}
                                @if($ruteHalte->jam_berangkat)
                                    (Berangkat: {{ $ruteHalte->jam_berangkat }})
                                @endif
                            </option>
                        @endforeach
                    </select>
                    @error('id_rute_halte')
                        <small class="error">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-row">
                    {{-- JAM MULAI --}}
                    <div class="form-group">
                        <label for="jam_mulai">Jam Mulai <span class="required">*</span></label>
                        <input type="time"
                               name="jam_mulai"
                               id="jam_mulai"
                               value="{{ old('jam_mulai', $jadwalSopir->jam_mulai ? \Carbon\Carbon::parse($jadwalSopir->jam_mulai)->format('H:i') : '') }}"
                               required>
                        @error('jam_mulai')
                            <small class="error">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- JAM SELESAI --}}
                    <div class="form-group">
                        <label for="jam_selesai">Jam Selesai <span class="required">*</span></label>
                        <input type="time"
                               name="jam_selesai"
                               id="jam_selesai"
                               value="{{ old('jam_selesai', $jadwalSopir->jam_selesai ? \Carbon\Carbon::parse($jadwalSopir->jam_selesai)->format('H:i') : '') }}"
                               required>
                        @error('jam_selesai')
                            <small class="error">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                {{-- STATUS --}}
                <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" id="status">
                        <option value="belum_aktif" @selected(old('status', $jadwalSopir->status) == 'belum_aktif')>
                            Belum Aktif
                        </option>
                        <option value="aktif" @selected(old('status', $jadwalSopir->status) == 'aktif')>
                            Aktif
                        </option>
                        <option value="selesai" @selected(old('status', $jadwalSopir->status) == 'selesai')>
                            Selesai
                        </option>
                    </select>
                    @error('status')
                        <small class="error">{{ $message }}</small>
                    @enderror
                </div>

                {{-- BUTTONS --}}
                <div class="form-actions">
                    <button type="submit" class="btn-simpan">
                        Update Jadwal
                    </button>
                    <a href="{{ route('admin.jadwal-sopir') }}" class="btn-cancel">
                        Batal
                    </a>
                </div>

            </form>
        </div>

    </div>

@endsection
