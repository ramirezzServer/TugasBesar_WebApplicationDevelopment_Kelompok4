@extends('layouts.user')

@section('content')
    <div class="card">
        <h2>Dashboard</h2>
        <p>Selamat datang di sistem OurTucTuc.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div class="card">
            <h4>Informasi Rute</h4>
            <p>
                Lihat informasi rute kendaraan yang tersedia di lingkungan kampus
                untuk mendukung mobilitas Anda.
            </p>
            <a href="/rute" class="text-red-700 font-semibold">Lihat Rute</a>
        </div>

        <div class="card">
            <h4>Keluhan</h4>
            <p>
                Sampaikan keluhan atau masukan terkait layanan transportasi kampus.
            </p>
            <a href="/keluhan" class="text-red-700 font-semibold">Lihat Keluhan</a>
        </div>
    </div>
@endsection
