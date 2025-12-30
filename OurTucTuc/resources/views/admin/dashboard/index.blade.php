@extends('layouts.admin')

@section('content')
<div class="card">
    <h2>Dashboard Admin</h2>
    <p>Ringkasan pengelolaan sistem OurTucTuc.</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    <div class="card">
        <h4>Total Keluhan</h4>
        <strong>{{ $totalKeluhan ?? 0 }}</strong>
    </div>
    <div class="card">
        <h4>Total Sopir</h4>
        <strong>{{ $totalSopir ?? 0 }}</strong>
    </div>
    <div class="card">
        <h4>Total Kendaraan</h4>
        <strong>{{ $totalKendaraan ?? 0 }}</strong>
    </div>
</div>
@endsection
