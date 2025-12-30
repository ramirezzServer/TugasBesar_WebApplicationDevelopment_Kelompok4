@extends('layouts.admin')

@section('content')
    <div class="card">
        <h2>Data Keluhan</h2>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Pengguna</th>
                    <th>Isi Keluhan</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($keluhan as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->penumpang->name ?? '-' }}</td>
                        <td>{{ $item->nama_keluhan }}</td>
                        <td>{{ $item->status }}</td>
                        <td>{{ $item->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
