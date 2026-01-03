@extends('layouts.admin')

@section('content')
    <div class="card">
        <h2>Data Rute</h2>

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
                @forelse ($data->groupBy('rute.id') as $ruteGroup)
                    @foreach ($ruteGroup as $index => $item)
                        <tr>
                            @if ($index === 0)
                                <td rowspan="{{ $ruteGroup->count() }}">
                                    <strong>{{ $item->rute->nama_rute }}</strong>
                                </td>
                            @endif

                            <td>{{ $item->halte->nama_halte }}</td>
                            <td>{{ $item->jam_berangkat }}</td>
                            <td>
                                <form action="{{ route('admin.rute-halte.destroy', $item->id) }}" method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus halte ini dari rute?');">
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
@endsection
