@extends('layouts.partial.app')

@section('title', 'Lokasi Properti - Property Management App')

@push('styles')
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <link rel="stylesheet" href="{{ asset('css/dashboard-clean.css') }}?v={{ time() }}">
    <style>
        /* Table Responsive & Text Wrapping persis Perizinan */
        .table-lahan {
            width: 100% !important;
            margin-bottom: 0;
        }
        .table-lahan thead th {
            background: #f8fafc !important;
            color: #4b5563 !important;
            font-weight: 700;
            font-size: 0.78rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 2px solid #e2e8f0 !important;
            padding: 0.75rem 0.65rem !important;
            vertical-align: middle;
            white-space: nowrap;
        }
        .table-lahan tbody td {
            padding: 0.75rem 0.65rem !important;
            vertical-align: middle;
            font-size: 0.83rem;
            border-bottom: 1px solid #f1f5f9;
            white-space: normal !important;
        }
        .table-lahan .col-no {
            width: 45px;
            text-align: center;
            white-space: nowrap !important;
        }
        .table-lahan .col-aksi {
            width: 80px;
            text-align: center;
            white-space: nowrap !important;
        }

        /* Compact Table Card persis Perizinan */
        .card.compact-table-card,
        .compact-table-card {
            background: #ffffff !important;
            border: 1px solid #e2e8f0 !important;
            border-radius: 8px !important;
            box-shadow: none !important;
            transition: border-color 0.2s ease;
            overflow: hidden;
        }
        .card.compact-table-card:hover,
        .compact-table-card:hover {
            border-color: #cbd5e1 !important;
            box-shadow: none !important;
        }
        .compact-table-card .card-header {
            background: #ffffff !important;
            border-bottom: 1px solid #e2e8f0 !important;
            padding: 0.75rem 1.25rem !important;
            border-top-left-radius: 8px !important;
            border-top-right-radius: 8px !important;
        }
        .compact-table-card .card-body,
        .card.compact-table-card .card-body {
            padding: 0 !important;
            background: #ffffff !important;
        }

        /* Badge Status */
        .badge-status {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 0.32rem 0.65rem;
            border-radius: 6px;
            font-size: 0.75rem;
            font-weight: 600;
            line-height: 1.2;
        }
        .badge-status.available {
            background: rgba(16, 185, 129, 0.1);
            color: #059669;
            border: 1px solid rgba(16, 185, 129, 0.25);
        }
        .badge-status.booking {
            background: rgba(245, 158, 11, 0.1);
            color: #d97706;
            border: 1px solid rgba(245, 158, 11, 0.25);
        }
        .badge-status.sold {
            background: rgba(239, 68, 68, 0.1);
            color: #dc2626;
            border: 1px solid rgba(239, 68, 68, 0.25);
        }

        /* Action Buttons */
        .btn-action {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 34px;
            height: 34px;
            border-radius: 8px;
            border: none;
            transition: all 0.2s ease;
            text-decoration: none;
            cursor: pointer;
        }
        .btn-action.fase2 {
            background: linear-gradient(135deg, #0284c7, #0369a1);
            color: #ffffff !important;
            box-shadow: 0 2px 5px rgba(2, 132, 199, 0.25);
        }
        .btn-action.fase2 i {
            color: #ffffff !important;
            font-size: 1.05rem;
        }
        .btn-action.fase2:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(2, 132, 199, 0.4);
            color: #ffffff !important;
        }
    </style>
@endpush

@section('content')

<div class="container-fluid px-2 px-md-4 py-3">

    <!-- Page Title & Subtitle (Persis Perizinan) -->
    <div class="row align-items-center mb-4">
        <div class="col">
            <h2 class="text-dark mb-1 fw-bold" style="font-size: 1.55rem; letter-spacing: -0.02em;">
                Peta Lokasi Properti
            </h2>
            <p class="text-muted mb-0" style="font-size: 0.88rem;">
                Pemetaan geografis dan status seluruh properti dan landbank
            </p>
        </div>
    </div>

    <!-- 4 KPI Metrics Card Grid (Persis Perizinan / Pra Tanah) -->
    <div class="dash-kpi-grid mb-4">
        
        <!-- Card 1: Total Properti (Ungu) -->
        <div class="dash-kpi-card">
            <div class="dash-kpi-left">
                <div class="dash-kpi-icon purple">
                    <i class="mdi mdi-home-city-outline"></i>
                </div>
                <div class="dash-kpi-info">
                    <div class="dash-kpi-label">Total Properti</div>
                    <div class="dash-kpi-val">{{ $totalLandBanks ?? 0 }}</div>
                    <div class="dash-kpi-sub">Proyek Terdaftar</div>
                </div>
            </div>
            <div class="dash-kpi-action purple">
                <i class="mdi mdi-arrow-right"></i>
            </div>
        </div>

        <!-- Card 2: Unit Tersedia (Hijau) -->
        <div class="dash-kpi-card">
            <div class="dash-kpi-left">
                <div class="dash-kpi-icon green">
                    <i class="mdi mdi-check-decagram-outline"></i>
                </div>
                <div class="dash-kpi-info">
                    <div class="dash-kpi-label">Unit Tersedia</div>
                    <div class="dash-kpi-val">{{ $totalReady ?? 0 }}</div>
                    <div class="dash-kpi-sub">Siap Dipasarkan</div>
                </div>
            </div>
            <div class="dash-kpi-action green">
                <i class="mdi mdi-arrow-right"></i>
            </div>
        </div>

        <!-- Card 3: Unit Booking (Kuning / Amber) -->
        <div class="dash-kpi-card">
            <div class="dash-kpi-left">
                <div class="dash-kpi-icon amber">
                    <i class="mdi mdi-clock-outline"></i>
                </div>
                <div class="dash-kpi-info">
                    <div class="dash-kpi-label">Unit Booking</div>
                    <div class="dash-kpi-val">{{ $totalBooked ?? 0 }}</div>
                    <div class="dash-kpi-sub">Proses Pemesanan</div>
                </div>
            </div>
            <div class="dash-kpi-action amber">
                <i class="mdi mdi-arrow-right"></i>
            </div>
        </div>

        <!-- Card 4: Unit Terjual (Biru) -->
        <div class="dash-kpi-card">
            <div class="dash-kpi-left">
                <div class="dash-kpi-icon blue">
                    <i class="mdi mdi-handshake-outline"></i>
                </div>
                <div class="dash-kpi-info">
                    <div class="dash-kpi-label">Unit Terjual</div>
                    <div class="dash-kpi-val">{{ $totalSold ?? 0 }}</div>
                    <div class="dash-kpi-sub">Penjualan Selesai</div>
                </div>
            </div>
            <div class="dash-kpi-action blue">
                <i class="mdi mdi-arrow-right"></i>
            </div>
        </div>

    </div>

    <!-- Peta Lokasi Google Maps Card -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card compact-table-card shadow-sm border-0">
                <div class="card-header bg-white d-flex justify-content-between align-items-center py-3 border-bottom">
                    <h5 class="card-title mb-0" style="font-weight: 700; color: #1e293b; font-size: 1.05rem;">
                        <i class="mdi mdi-google-maps me-2" style="color: #9a55ff;"></i>Google Maps View
                    </h5>
                    <span class="badge bg-light text-muted fw-normal" style="font-size: 0.78rem;">
                        <i class="mdi mdi-information-outline me-1"></i>Klik pin lokasi untuk melihat detail
                    </span>
                </div>
                <div class="card-body p-0">
                    <div id="map" style="height: 480px; width: 100%; z-index: 1;"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Daftar Properti & Filter Section -->
    <div class="row">
        <div class="col-12">
            <div class="card compact-table-card shadow-sm border-0">
                <div class="card-header bg-white d-flex flex-wrap flex-md-row justify-content-between align-items-center gap-2 py-3 border-bottom">
                    <div>
                        <h5 class="card-title mb-0" style="font-weight: 700; color: #1e293b; font-size: 1.05rem;">
                            <i class="mdi mdi-format-list-bulleted me-2" style="color: #9a55ff;"></i>Daftar Properti Terdekat
                        </h5>
                    </div>
                </div>

                <div class="card-body p-0">
                    <!-- Filter Toolbar -->
                    <div class="card-toolbar-box p-3 border-bottom bg-white">
                        <!-- Desktop Filter -->
                        <div class="d-none d-md-block">
                            <form method="GET" action="{{ route('lokasi.index') }}">
                                <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 w-100">
                                    <div class="d-flex flex-wrap align-items-center gap-2 flex-grow-1">
                                        <div style="min-width: 240px; max-width: 360px; flex: 1;">
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="search" id="liveSearchInput"
                                                    placeholder="Cari nama properti / alamat..."
                                                    value="{{ request('search') }}"
                                                    onkeyup="applyLiveSearch(this.value)"
                                                    style="border-top-right-radius: 0 !important; border-bottom-right-radius: 0 !important; border-right: none; height: 38px;">
                                                <button class="btn btn-gradient-primary d-flex align-items-center justify-content-center px-3" 
                                                    type="submit" title="Cari"
                                                    style="border-top-left-radius: 0 !important; border-bottom-left-radius: 0 !important; border-top-right-radius: 4px !important; border-bottom-right-radius: 4px !important; height: 38px; box-shadow: none;">
                                                    <i class="mdi mdi-magnify" style="font-size: 1.15rem; color: #ffffff;"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-center gap-2 ms-auto">
                                        <div style="width: 115px;">
                                            <select name="tampil" class="form-select" id="showSelect" onchange="this.form.submit()" style="height: 38px;">
                                                <option value="10" {{ request('tampil', 10) == 10 ? 'selected' : '' }}>10 data</option>
                                                <option value="25" {{ request('tampil') == 25 ? 'selected' : '' }}>25 data</option>
                                                <option value="50" {{ request('tampil') == 50 ? 'selected' : '' }}>50 data</option>
                                                <option value="100" {{ request('tampil') == 100 ? 'selected' : '' }}>100 data</option>
                                            </select>
                                        </div>

                                        <button type="submit" class="btn btn-gradient-primary d-inline-flex align-items-center justify-content-center" style="width: 38px; height: 38px; padding: 0;" title="Filter">
                                            <i class="mdi mdi-filter"></i>
                                        </button>
                                        <a href="{{ route('lokasi.index') }}" class="btn btn-gradient-secondary d-inline-flex align-items-center justify-content-center" style="width: 38px; height: 38px; padding: 0;" title="Reset">
                                            <i class="mdi mdi-refresh"></i>
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <!-- Mobile Filter -->
                        <div class="d-block d-md-none">
                            <form method="GET" action="{{ route('lokasi.index') }}">
                                <div class="row g-2">
                                    <div class="col-12 mb-2">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="search" id="searchInputMobile"
                                                placeholder="Cari nama properti..."
                                                value="{{ request('search') }}"
                                                onkeyup="applyLiveSearch(this.value)"
                                                style="border-top-right-radius: 0 !important; border-bottom-right-radius: 0 !important; border-right: none; height: 38px;">
                                            <button class="btn btn-gradient-primary d-flex align-items-center justify-content-center px-3" 
                                                type="submit" title="Cari"
                                                style="border-top-left-radius: 0 !important; border-bottom-left-radius: 0 !important; border-top-right-radius: 4px !important; border-bottom-right-radius: 4px !important; height: 38px; box-shadow: none;">
                                                <i class="mdi mdi-magnify" style="font-size: 1.15rem; color: #ffffff;"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <select name="tampil" class="form-select" id="showSelectMobile" onchange="this.form.submit()" style="height: 38px;">
                                            <option value="10" {{ request('tampil', 10) == 10 ? 'selected' : '' }}>10 data</option>
                                            <option value="25" {{ request('tampil') == 25 ? 'selected' : '' }}>25 data</option>
                                            <option value="50" {{ request('tampil') == 50 ? 'selected' : '' }}>50 data</option>
                                            <option value="100" {{ request('tampil') == 100 ? 'selected' : '' }}>100 data</option>
                                        </select>
                                    </div>

                                    <div class="col-4">
                                        <button type="submit" class="btn btn-gradient-primary w-100" style="height: 38px;" title="Filter">
                                            <i class="mdi mdi-filter"></i>
                                        </button>
                                    </div>

                                    <div class="col-4">
                                        <a href="{{ route('lokasi.index') }}" class="btn btn-gradient-secondary w-100 d-inline-flex align-items-center justify-content-center" style="height: 38px;" title="Reset">
                                            <i class="mdi mdi-refresh"></i>
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Tabel Data Properti -->
                    <div class="table-responsive">
                        <table class="table table-lahan table-hover align-middle mb-0">
                            <thead>
                                <tr>
                                    <th class="col-no text-center">NO</th>
                                    <th>NAMA PROPERTI</th>
                                    <th>LOKASI</th>
                                    <th>JARAK</th>
                                    <th>STATUS</th>
                                    <th class="col-aksi text-center">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($landBanks as $item)
                                    @php
                                        $searchKeywords = strtolower(($item->name ?? '') . ' ' . ($item->address ?? ''));
                                    @endphp
                                    <tr class="project-table-row" data-search="{{ $searchKeywords }}">
                                        <td class="col-no text-center fw-bold text-muted">{{ $loop->iteration + ($landBanks->currentPage() - 1) * $landBanks->perPage() }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <i class="mdi mdi-home-city text-primary me-2" style="font-size: 1.15rem;"></i>
                                                <span class="fw-bold text-dark" style="font-size: 0.88rem;">{{ $item->name }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="d-inline-flex align-items-center gap-1 text-muted" title="{{ $item->address }}">
                                                <i class="mdi mdi-map-marker text-danger"></i>
                                                <span>{{ Str::limit($item->address, 35) }}</span>
                                            </span>
                                        </td>
                                        <td class="distance fw-semibold text-primary" data-lat="{{ $item->lat }}" data-lng="{{ $item->lng }}">
                                            <span class="text-muted">Menghitung...</span>
                                        </td>
                                        <td>
                                            @php $st = strtolower($item->status ?? ''); @endphp
                                            @if (str_contains($st, 'tersedia') || str_contains($st, 'available'))
                                                <span class="badge-status available">
                                                    <i class="mdi mdi-check-circle-outline me-1"></i>Tersedia
                                                </span>
                                            @elseif(str_contains($st, 'booking') || str_contains($st, 'booked'))
                                                <span class="badge-status booking">
                                                    <i class="mdi mdi-calendar-clock me-1"></i>Booking
                                                </span>
                                            @elseif(str_contains($st, 'terjual') || str_contains($st, 'sold'))
                                                <span class="badge-status sold">
                                                    <i class="mdi mdi-close-circle-outline me-1"></i>Terjual
                                                </span>
                                            @else
                                                <span class="badge-status available">
                                                    {{ $item->status ?? 'Tersedia' }}
                                                </span>
                                            @endif
                                        </td>
                                        <td class="col-aksi text-center">
                                            <button type="button" class="btn-action fase2" title="Lihat Lokasi di Google Maps"
                                                onclick="flyToLocation({{ $item->lat ?? 0 }}, {{ $item->lng ?? 0 }}, '{{ addslashes($item->name) }}')">
                                                <i class="mdi mdi-crosshairs-gps"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted py-4">
                                            <i class="mdi mdi-information-outline me-2"></i> Tidak ada properti ditemukan.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if ($landBanks instanceof \Illuminate\Pagination\LengthAwarePaginator && $landBanks->total() > 0)
                        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center p-3 border-top bg-white">
                            <div class="pagination-info mb-2 mb-sm-0 text-muted" style="font-size: 0.84rem;">
                                Menampilkan {{ $landBanks->firstItem() ?? 0 }} - {{ $landBanks->lastItem() ?? 0 }} dari {{ $landBanks->total() }} data
                            </div>
                            <div>
                                {{ $landBanks->appends(request()->query())->links('pagination::bootstrap-5') }}
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>

</div>

@endsection

@push('scripts')
<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
    function applyLiveSearch(query) {
        var filter = (query || '').toLowerCase().trim();
        var rows = document.querySelectorAll('.project-table-row');
        rows.forEach(function(row) {
            var text = row.getAttribute('data-search') || row.innerText.toLowerCase();
            if (!filter || text.indexOf(filter) > -1) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }

    $(document).ready(function() {
        // Google Maps Tile Layers
        var googleStreets = L.tileLayer('https://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
            maxZoom: 20,
            subdomains: ['mt0', 'mt1', 'mt2', 'mt3'],
            attribution: '&copy; Google Maps'
        });

        var googleHybrid = L.tileLayer('https://{s}.google.com/vt/lyrs=y&x={x}&y={y}&z={z}', {
            maxZoom: 20,
            subdomains: ['mt0', 'mt1', 'mt2', 'mt3'],
            attribution: '&copy; Google Maps'
        });

        var googleTerrain = L.tileLayer('https://{s}.google.com/vt/lyrs=p&x={x}&y={y}&z={z}', {
            maxZoom: 20,
            subdomains: ['mt0', 'mt1', 'mt2', 'mt3'],
            attribution: '&copy; Google Maps'
        });

        // Inisialisasi peta default Jember (Google Maps Streets)
        var map = L.map('map', {
            center: [-8.1725, 113.7026],
            zoom: 12,
            layers: [googleStreets]
        });

        // Layer Control (Streets, Hybrid/Satellite, Terrain)
        var baseMaps = {
            "Google Maps": googleStreets,
            "Google Satellite / Hybrid": googleHybrid,
            "Google Terrain": googleTerrain
        };
        L.control.layers(baseMaps).addTo(map);

        var markersGroup = L.featureGroup().addTo(map);
        var markersList = {};

        // Ambil data lokasi dari endpoint JSON
        $.getJSON("{{ route('lokasi.data') }}", function(locations) {
            if (locations && locations.length > 0) {
                locations.forEach(function(loc) {
                    if (!loc.lat || !loc.lng) return;

                    var iconMap = {
                        'Rumah': 'home-variant',
                        'Apartemen': 'office-building',
                        'Ruko': 'store',
                        'Tanah': 'terrain'
                    };
                    var iconName = iconMap[loc.category] || 'map-marker';

                    // Modern Custom HTML Marker Pin
                    var customIcon = L.divIcon({
                        className: 'custom-google-marker',
                        html: `<div style="
                            width: 36px;
                            height: 36px;
                            background: linear-gradient(135deg, #da8cff, #9a55ff);
                            border: 2px solid #ffffff;
                            border-radius: 50%;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            box-shadow: 0 4px 10px rgba(154, 85, 255, 0.4);
                            color: #ffffff;
                            font-size: 1.15rem;
                            cursor: pointer;
                        ">
                            <i class="mdi mdi-${iconName}"></i>
                        </div>`,
                        iconSize: [36, 36],
                        iconAnchor: [18, 18],
                        popupAnchor: [0, -18]
                    });

                    var marker = L.marker([loc.lat, loc.lng], { icon: customIcon }).addTo(markersGroup);
                    markersList[loc.lat + '_' + loc.lng] = marker;

                    var statusBadge = (loc.status || 'Tersedia');
                    var badgeBg = 'linear-gradient(135deg, #28a745, #5dd879)';
                    if (statusBadge.toLowerCase().includes('booking')) {
                        badgeBg = 'linear-gradient(135deg, #ffc107, #ffdb6d)';
                    } else if (statusBadge.toLowerCase().includes('terjual') || statusBadge.toLowerCase().includes('sold')) {
                        badgeBg = 'linear-gradient(135deg, #dc3545, #e4606d)';
                    }

                    var formattedPrice = loc.price ? 'Rp ' + Number(loc.price).toLocaleString('id-ID') : '-';

                    var popupContent = `
                        <div style="font-family: 'Nunito', sans-serif; min-width: 220px; padding: 4px;">
                            <div style="font-weight: 700; font-size: 0.95rem; color: #2c2e3f; margin-bottom: 4px;">
                                <i class="mdi mdi-home-city text-primary me-1"></i>${loc.name}
                            </div>
                            <div style="font-size: 0.8rem; color: #6c757d; margin-bottom: 6px;">
                                <i class="mdi mdi-map-marker text-danger me-1"></i>${loc.address || '-'}
                            </div>
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 6px;">
                                <span style="font-size: 0.78rem; font-weight: 600; color: #9a55ff;">
                                    <i class="mdi mdi-shape-outline me-1"></i>${loc.category || 'Tanah'}
                                </span>
                                <span style="background: ${badgeBg}; color: ${statusBadge.toLowerCase().includes('booking') ? '#2c2e3f' : '#ffffff'}; font-size: 0.72rem; font-weight: 600; padding: 2px 8px; border-radius: 4px;">
                                    ${statusBadge}
                                </span>
                            </div>
                            <div style="font-weight: 700; color: #28a745; font-size: 0.88rem; margin-bottom: 8px;">
                                ${formattedPrice}
                            </div>
                            <a href="https://www.google.com/maps/dir/?api=1&destination=${loc.lat},${loc.lng}" target="_blank" 
                                class="btn btn-sm btn-gradient-primary w-100 text-white text-center text-decoration-none d-block" 
                                style="border-radius: 6px; font-size: 0.78rem; padding: 4px 8px;">
                                <i class="mdi mdi-directions me-1"></i>Buka Rute Google Maps
                            </a>
                        </div>
                    `;
                    marker.bindPopup(popupContent);
                });

                if (markersGroup.getLayers().length > 0) {
                    map.fitBounds(markersGroup.getBounds(), { padding: [40, 40] });
                }
            }
        });

        // Fungsi Fly to Location saat tombol aksi diklik
        window.flyToLocation = function(lat, lng, name) {
            if (!lat || !lng) {
                alert('Koordinat lokasi tidak tersedia untuk properti ini.');
                return;
            }
            $('html, body').animate({
                scrollTop: $("#map").offset().top - 80
            }, 500);

            map.flyTo([lat, lng], 16, {
                animate: true,
                duration: 1.2
            });

            var key = lat + '_' + lng;
            if (markersList[key]) {
                setTimeout(function() {
                    markersList[key].openPopup();
                }, 1300);
            }
        };
    });

    // Geolocation Distance Calculation
    function toRad(Value) {
        return Value * Math.PI / 180;
    }

    function getDistanceFromLatLonInKm(lat1, lon1, lat2, lon2) {
        var R = 6371;
        var dLat = toRad(lat2 - lat1);
        var dLon = toRad(lon2 - lon1);
        var a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
            Math.cos(toRad(lat1)) * Math.cos(toRad(lat2)) *
            Math.sin(dLon / 2) * Math.sin(dLon / 2);
        var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
        return (R * c).toFixed(1);
    }

    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            let userLat = position.coords.latitude;
            let userLng = position.coords.longitude;

            document.querySelectorAll('.distance').forEach(function(td) {
                let propLat = parseFloat(td.dataset.lat);
                let propLng = parseFloat(td.dataset.lng);
                if (propLat && propLng) {
                    let distance = getDistanceFromLatLonInKm(userLat, userLng, propLat, propLng);
                    td.innerHTML = `<i class="mdi mdi-navigation-variant-outline me-1"></i>${distance} km`;
                } else {
                    td.innerHTML = `<span class="text-muted">-</span>`;
                }
            });
        }, function() {
            document.querySelectorAll('.distance').forEach(function(td) {
                td.innerHTML = `<span class="text-muted">-</span>`;
            });
        });
    }
</script>
@endpush