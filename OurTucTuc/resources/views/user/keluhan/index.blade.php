@extends('layouts.user')

@section('content')
    <div class="keluhan-wrapper">

        {{-- HEADER --}}
        <div class="keluhan-header">
            <div>
                <h2>Keluhan Pengguna</h2>
                <p>Laporkan kendala selama menggunakan layanan OurTucTuc</p>
            </div>

            <a href="{{ route('user.keluhan') }}" class="btn-refresh">
                🔄 Refresh
            </a>
        </div>

        {{-- GRID --}}
        <div class="keluhan-grid">

            {{-- FORM --}}
            <div class="keluhan-form-card">
                <h4>Buat Keluhan Baru</h4>

                <form method="POST" action="{{ route('user.keluhan.store') }}">
                    @csrf

                    <label>Nama Keluhan</label>
                    <textarea name="nama_keluhan" rows="5" placeholder="Contoh: Kendaraan terlambat, halte penuh, sopir tidak hadir"
                        required>{{ old('nama_keluhan') }}</textarea>

                    @error('nama_keluhan')
                        <small class="error">{{ $message }}</small>
                    @enderror

                    <button type="submit">
                        Kirim Keluhan
                    </button>
                </form>
            </div>

            {{-- LIST --}}
            <div class="keluhan-table-card">

                {{-- FILTER --}}
                <div class="keluhan-filter">
                    <form method="GET">
                        <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari keluhan...">

                        <select name="status">
                            <option value="">Semua Status</option>
                            <option value="diajukan" @selected(request('status') === 'diajukan')>Diajukan</option>
                            <option value="diselesaikan" @selected(request('status') === 'diselesaikan')>Diselesaikan</option>
                        </select>

                        <button type="submit" class="btn-filter">Filter</button>
                        <a href="{{ route('user.keluhan') }}" class="btn-reset">Reset</a>
                    </form>
                </div>

                {{-- TABLE --}}
                <table>
                    <thead>
                        <tr>
                            <th>Keluhan</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($keluhans as $k)
                            <tr>
                                <td>{{ $k->nama_keluhan }}</td>
                                <td>
                                    <span class="status {{ $k->status }}">
                                        {{ ucfirst($k->status) }}
                                    </span>
                                </td>
                                <td>{{ $k->created_at->format('d M Y') }}</td>
                                <td class="aksi">
                                    <a href="{{ route('user.keluhan.edit', $k->id) }}">Edit</a>

                                    <form method="POST" action="{{ route('user.keluhan.destroy', $k->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button onclick="return confirm('Hapus keluhan?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="empty">Belum ada keluhan</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="keluhan-pagination">
                    {{ $keluhans->withQueryString()->links() }}
                </div>

            </div>

        </div>
    </div>
@endsection
