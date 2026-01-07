@extends('layouts.admin')

@section('content')
    <div class="keluhan-wrapper">

        {{-- HEADER (ikut style admin keluhan) --}}
        <div class="keluhan-header">
            <div>
                <h2>Data user</h2>
                <p>Admin hanya dapat melihat data user</p>
            </div>
        </div>

        {{-- TABLE (ikut card/table style admin keluhan) --}}
        <div class="keluhan-table-card">
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
                    @forelse ($data as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->NoTelp }}</td>
                            <td>{{ $item->role }}</td>
                            <td>{{ $item->keluhans_count }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="empty">Belum ada data user</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
@endsection
