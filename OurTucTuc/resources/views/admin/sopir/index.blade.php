@extends('layouts.admin')

@section('content')
<div class="card">
    <h2>Data Sopir</h2>

    <table>
        <thead>
            <tr>
                <th>Nama Sopir</th>
                <th>No Telepon</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sopir as $item)
            <tr>
                <td>{{ $item->nama_sopir }}</td>
                <td>{{ $item->notelp_sopir }}</td>
                <td>{{ $item->status }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
