@extends('layouts.admin')

@section('content')
    <div class="card">
        <h2>Data user</h2>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>No Telepon</th>
                    <th>role</th>
                    <th>jumlah keluhan</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($data as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->NoTelp }}</td>
                        <td>{{ $item->role }}</td>
                        <td>{{ $item->keluhans_count }}</td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
