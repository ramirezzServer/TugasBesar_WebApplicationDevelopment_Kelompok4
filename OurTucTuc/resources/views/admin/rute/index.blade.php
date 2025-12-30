@extends('layouts.admin')

@section('content')
    <div class="card">
        <h2>Data Rute</h2>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Rute</th>
                    <th>aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->nama_rute }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
