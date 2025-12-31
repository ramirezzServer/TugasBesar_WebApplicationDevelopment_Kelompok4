@extends('layouts.admin')

@section('content')
    <div class="keluhan-wrapper">

        {{-- HEADER --}}
        <div class="keluhan-header">
            <div>
                <h2>Manajemen Keluhan</h2>
                <p>Admin hanya dapat melihat dan memperbarui status keluhan</p>
            </div>
        </div>

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
                <a href="{{ route('admin.keluhan') }}" class="btn-reset">Reset</a>
            </form>
        </div>

        {{-- FLASH MESSAGE --}}
        @if (session('success'))
            <div class="alert-success">
                {{ session('success') }}
            </div>
        @endif

        {{-- TABLE --}}
        <div class="keluhan-table-card">
            <table>
                <thead>
                    <tr>
                        <th>Nama Penumpang</th>
                        <th>Keluhan</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                        <th style="width:180px">Update Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($keluhans as $k)
                        <tr>
                            <td>
                                <strong>{{ $k->penumpang->name }}</strong><br>
                                <small>{{ $k->penumpang->email }}</small>
                            </td>
                            <td>{{ $k->nama_keluhan }}</td>
                            <td>
                                <span class="status {{ $k->status }}">
                                    {{ ucfirst($k->status) }}
                                </span>
                            </td>
                            <td>{{ $k->created_at->format('d M Y') }}</td>
                            <td>
                                <form method="POST" action="{{ route('admin.keluhan.update', $k->id) }}">
                                    @csrf
                                    @method('PUT')

                                    <select name="status" onchange="this.form.submit()">
                                        <option value="diajukan" @selected($k->status === 'diajukan')>
                                            Diajukan
                                        </option>
                                        <option value="diselesaikan" @selected($k->status === 'diselesaikan')>
                                            Diselesaikan
                                        </option>
                                    </select>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="empty">
                                Belum ada keluhan
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="keluhan-pagination">
                {{ $keluhans->withQueryString()->links() }}
            </div>
        </div>

    </div>
@endsection
