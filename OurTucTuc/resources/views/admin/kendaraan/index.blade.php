@extends('layouts.admin')

@section('content')
<div class="card">
    <h2>Data Kendaraan</h2>

    <table>
        <thead>
            <tr>
                <th>Nama Kendaraan</th>
                <th>Plat Nomor</th>
                <th>Kapasitas</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($kendaraan as $item)
            <tr>
                <td>{{ $item->nama_kendaraan }}</td>
                <td>{{ $item->plat_nomor }}</td>
                <td>{{ $item->kapasitas }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
