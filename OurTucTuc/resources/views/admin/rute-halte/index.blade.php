@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-header">
        <h2>Data Rute</h2>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Rute</th>
                    <th>Halte</th>
                    <th>Jam Berangkat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($ruteHalte->groupBy('rute.id') as $ruteId => $ruteGroup)
                    @foreach ($ruteGroup as $index => $item)
                        <tr>
                            {{-- Kolom Nama Rute hanya muncul di baris pertama grup --}}
                            @if ($index === 0)
                                <td rowspan="{{ $ruteGroup->count() }}" style="vertical-align: middle;">
                                    <strong>{{ $item->rute->nama_rute ?? 'N/A' }}</strong>
                                </td>
                            @endif

                            <td>{{ $item->halte->nama_halte ?? 'N/A' }}</td>
                            <td>{{ $item->jam_berangkat }}</td>
                            
                            <td>
                                <form action="{{ route('admin.rute-halte.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus halte ini dari rute?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @empty
                    <tr>
                        <td colspan="4" class="text-center">Data tidak ditemukan</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection