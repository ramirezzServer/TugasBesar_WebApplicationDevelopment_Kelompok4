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
        </tr>
    </thead>
    <tbody>
        @foreach ($data->groupBy('rute.id') as $ruteGroup)
            @foreach ($ruteGroup as $index => $item)
                <tr>
                    @if ($index === 0)
                        <td rowspan="{{ $ruteGroup->count() }}">
                            <strong>{{ $item->rute->nama_rute }}</strong>
                        </td>
                    @endif
                    <td>{{ $item->halte->nama_halte }}</td>
                    <td>{{ $item->jam_berangkat }}</td>
                </tr>
            @endforeach
        @endforeach
    </tbody>
</table>

</table>
@endsection
