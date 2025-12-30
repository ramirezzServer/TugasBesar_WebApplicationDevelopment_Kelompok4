@extends('layouts.admin')

@section('content')
<div class="card">
    <h2>Jadwal Sopir</h2>

    <table>
        <thead>
            <tr>
                <th>Sopir</th>
                <th>Rute</th>
                <th>Jam Mulai</th>
                <th>Jam Selesai</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($jadwalSopir as $item)
            <tr>
                <td>{{ $item->sopir->nama_sopir ?? '-' }}</td>
                <td>{{ $item->rute->nama_rute ?? '-' }}</td>
                <td>{{ $item->jam_mulai }}</td>
                <td>{{ $item->jam_selesai }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
