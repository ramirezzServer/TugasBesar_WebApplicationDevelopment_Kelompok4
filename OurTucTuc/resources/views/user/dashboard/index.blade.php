@extends('layouts.user')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/user-dashboard.css') }}">

    <div class="dash-page">
        {{-- HEADER + STATS --}}
        <div class="dash-card dash-header">
            <div class="dash-header__top">
                <div>
                    <h1 class="dash-title">Dashboard Kendaraan</h1>
                    <p class="dash-subtitle">Pantau jadwal & status TUC-TUC secara realtime</p>
                </div>

                <div class="dash-header__right">
                    <div class="dash-live">
                        <span class="dash-live__dot"></span>
                        <span>Live Update</span>
                    </div>
                    <button id="btnRefresh" class="dash-btn" type="button">Refresh</button>
                </div>
            </div>

            <div class="dash-stats">
                <div class="dash-stat dash-stat--active">
                    <div class="dash-stat__icon">🚌</div>
                    <div>
                        <div class="dash-stat__value" id="statActive">0</div>
                        <div class="dash-stat__label">Beroperasi</div>
                    </div>
                </div>

                <div class="dash-stat dash-stat--transit">
                    <div class="dash-stat__icon">🧭</div>
                    <div>
                        <div class="dash-stat__value" id="statTransit">0</div>
                        <div class="dash-stat__label">Belum Aktif / Transit</div>
                    </div>
                </div>

                <div class="dash-stat dash-stat--inactive">
                    <div class="dash-stat__icon">⛔</div>
                    <div>
                        <div class="dash-stat__value" id="statInactive">0</div>
                        <div class="dash-stat__label">Tidak Aktif</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- GRID MAP + LIST --}}
        <div class="dash-grid">
            {{-- MAP --}}
            <div class="dash-card dash-map-card">
                <div class="dash-card__head">
                    <h2 class="dash-card__title">Peta Lokasi (Simulasi)</h2>
                    <div class="dash-card__meta">
                        Server: <span id="serverTime">-</span>
                    </div>
                </div>

                <div class="dash-map">
                    <div class="dash-map__grid"></div>

                    <svg class="dash-map__lines" viewBox="0 0 900 520" preserveAspectRatio="none">
                        <path d="M 60 220 Q 240 120 440 170 T 860 220" />
                        <path d="M 120 340 L 320 290 L 520 340 L 780 290" />
                    </svg>

                    <div id="mapMarkers" class="dash-map__markers"></div>

                    <div class="dash-map__note">
                        <div class="dash-map__noteIcon">📍</div>
                        <div>
                            <div class="dash-map__noteTitle">Peta Interaktif</div>
                            <div class="dash-map__noteText">Klik marker untuk highlight kendaraan di daftar.</div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- LIST --}}
            <div class="dash-card dash-list-card">
                <div class="dash-card__head dash-card__head--stack">
                    <div class="dash-list__top">
                        <h2 class="dash-card__title">Daftar Kendaraan</h2>
                        <input id="searchInput" class="dash-input" placeholder="Cari plat / rute / halte..." />
                    </div>

                    <div class="dash-filters">
                        <button class="dash-filterBtn is-active" data-filter="" type="button">Semua</button>
                        <button class="dash-filterBtn" data-filter="active" type="button">Aktif</button>
                        <button class="dash-filterBtn" data-filter="transit" type="button">Transit</button>
                        <button class="dash-filterBtn" data-filter="inactive" type="button">Nonaktif</button>
                    </div>
                </div>

                <div id="vehiclesList" class="dash-list">
                    <div class="dash-list__loading">Loading data…</div>
                </div>
            </div>
        </div>

        {{-- Quick links --}}
        <div class="dash-links">
            <div class="dash-card dash-linkCard">
                <h3>Informasi Rute</h3>
                <p>Lihat jadwal & daftar halte berdasarkan rute.</p>
                <a href="{{ route('user.rute') }}">Lihat Rute →</a>
            </div>

            <div class="dash-card dash-linkCard">
                <h3>Keluhan</h3>
                <p>Sampaikan keluhan layanan transportasi kampus.</p>
                <a href="{{ route('user.keluhan') }}">Lihat Keluhan →</a>
            </div>
        </div>
    </div>

    <script>
        window.USER_DASHBOARD_DATA_URL = @json(route('user.dashboard.data'));
    </script>
    <script src="{{ asset('js/user-dashboard-live.js') }}"></script>
@endsection
