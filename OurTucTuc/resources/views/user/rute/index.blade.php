@extends('layouts.user')

@section('content')
<div class="card">
    <h2>Daftar Rute</h2>

    <table>
        <thead>
            <tr>
                <th>Nama Rute</th>
                <th>Deskripsi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rute as $item)
                <tr>
                    <td>{{ $item->nama_rute }}</td>
                    <td>{{ $item->deskripsi }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
