@extends('layouts.user')

@section('content')
    <div class="card">
        <h2>Keluhan Saya</h2>

        <table>
            <thead>
                <tr>
                    <th>Isi Keluhan</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($keluhan as $item)
                    <tr>
                        <td>{{ $item->isi_keluhan }}</td>
                        <td>{{ $item->status }}</td>
                        <td>{{ $item->created_at }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3">Belum ada keluhan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
