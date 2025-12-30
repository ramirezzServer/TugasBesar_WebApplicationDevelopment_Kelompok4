@extends('layouts.admin')

@section('content')
    <div class="card">
        <h2>Data Halte</h2>

        <table>
            <thead>
                <tr>
                    <th>Nama Halte</th>
                    <th>Lokasi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($halte as $item)
                    <tr>
                        <td>{{ $item->nama_halte }}</td>
                        <td>{{ $item->lokasi }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
