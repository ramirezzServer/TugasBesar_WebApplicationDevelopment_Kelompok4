@extends('layouts.admin')

@section('content')
    <div class="card">
        <h2>Data Keluhan</h2>

        <table>
            <thead>
                <tr>
                    <th>Pengguna</th>
                    <th>Isi Keluhan</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($keluhan as $item)
                    <tr>
                        <td>{{ $item->user->name ?? '-' }}</td>
                        <td>{{ $item->isi_keluhan }}</td>
                        <td>{{ $item->status }}</td>
                        <td>{{ $item->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
