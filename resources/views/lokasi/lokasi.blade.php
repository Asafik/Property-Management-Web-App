@extends('layouts.partial.app')

@section('title', 'Lokasi Properti - Property Management App')

@section('content')

<!-- Leaflet CSS & JS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<div class="container-fluid px-1 px-sm-2 px-md-3 py-2 py-md-3">

    <!-- Header Halaman (Tanpa Card Box) -->
    <div class="row mb-3 mb-md-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center px-1">
                <div>
                    <h3 class="text-dark mb-1 fw-bold">
                        <i class="mdi mdi-map-marker-radius me-2" style="color: #9a55ff;"></i>Peta Lokasi Properti
                    </h3>
                    <p class="text-muted mb-0">Pemetaan geografis dan status seluruh properti dan landbank</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistic Cards (Sesuai Desain Dashboard) -->
    <div class="row g-3 mb-4">
        <div class="col-6 col-md-3">
            <div class="card shadow-sm border-0 h-100 mb-0">
                <div class="card-body d-flex justify-content-between align-items-center p-3">
                    <div>
                        <h3 class="text-dark mb-1 fw-bold">{{ $totalLandBanks }}</h3>
                        <p class="text-muted mb-0">Total Properti</p>
                    </div>
                    <div class="d-none d-sm-block">
                        <i class="mdi mdi-home-city-outline" style="font-size: 2.5rem; color: #9a55ff; opacity: 0.2;"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card shadow-sm border-0 h-100 mb-0">
                <div class="card-body d-flex justify-content-between align-items-center p-3">
                    <div>
                        <h3 class="text-dark mb-1 fw-bold">{{ $totalReady }}</h3>
                        <p class="text-muted mb-0">Unit Tersedia</p>
                    </div>
                    <div class="d-none d-sm-block">
                        <i class="mdi mdi-check-circle-outline" style="font-size: 2.5rem; color: #28a745; opacity: 0.2;"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card shadow-sm border-0 h-100 mb-0">
                <div class="card-body d-flex justify-content-between align-items-center p-3">
                    <div>
                        <h3 class="text-dark mb-1 fw-bold">{{ $totalBooked }}</h3>
                        <p class="text-muted mb-0">Unit Booking</p>
                    </div>
                    <div class="d-none d-sm-block">
                        <i class="mdi mdi-clock-outline" style="font-size: 2.5rem; color: #ffc107; opacity: 0.2;"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card shadow-sm border-0 h-100 mb-0">
                <div class="card-body d-flex justify-content-between align-items-center p-3">
                    <div>
                        <h3 class="text-dark mb-1 fw-bold">{{ $totalSold }}</h3>
                        <p class="text-muted mb-0">Unit Terjual</p>
                    </div>
                    <div class="d-none d-sm-block">
                        <i class="mdi mdi-close-circle-outline" style="font-size: 2.5rem; color: #dc3545; opacity: 0.2;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Peta Lokasi Google Maps Card -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">
                        <i class="mdi mdi-google-maps me-2"></i>Google Maps View
                    </h5>
                    <span class="badge bg-light text-muted fw-normal" style="font-size: 0.75rem;">
                        <i class="mdi mdi-information-outline me-1"></i>Klik pin lokasi untuk melihat detail
                    </span>
                </div>
                <div class="card-body p-0">
                    <div id="map" style="height: 480px; width: 100%; border-radius: 0 0 12px 12px; z-index: 1;"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Daftar Properti & Filter Section -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white d-flex flex-wrap flex-md-row justify-content-between align-items-center gap-2">
                    <h5 class="card-title mb-0">
                        <i class="mdi mdi-format-list-bulleted me-2"></i>Daftar Properti Terdekat
                    </h5>
                </div>

                <div class="card-body">
                    <!-- Filter Section -->
                    <div class="filter-card mb-3">
                        <!-- Desktop Filter -->
                        <div class="filter-row-desktop d-none d-md-block">
                            <form method="GET" action="{{ route('lokasi.index') }}">
                                <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 w-100">
                                    <div class="d-flex flex-wrap align-items-center gap-2 flex-grow-1">
                                        <div style="min-width: 240px; max-width: 320px; flex: 1;">
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="search" id="searchInput"
                                                    placeholder="Cari nama properti / alamat..."
                                                    value="{{ request('search') }}"
                                                    style="border-top-right-radius: 0 !important; border-bottom-right-radius: 0 !important; border-right: none;">
                                                <button class="btn btn-gradient-primary d-flex align-items-center justify-content-center px-3" 
                                                    type="submit" title="Cari"
                                                    style="border-top-left-radius: 0 !important; border-bottom-left-radius: 0 !important; border-top-right-radius: 4px !important; border-bottom-right-radius: 4px !important; height: 38px; box-shadow: none;">
                                                    <i class="mdi mdi-magnify" style="font-size: 1.15rem; color: #ffffff;"></i>
                                                </button>
                                            </div>
                                        </div>

                                        <div style="width: 180px;">
                                            <select name="kategori" class="form-control" id="categorySelect">
                                                <option value="">Semua Kategori</option>
                                                @foreach ($zonings as $zoning)
                                                    <option value="{{ $zoning }}" {{ request('kategori') == $zoning ? 'selected' : '' }}>
                                                        {{ $zoning }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-center gap-2 ms-auto">
                                        <div style="width: 115px;">
                                            <select name="tampil" class="form-control" id="showSelect">
                                                <option value="10" {{ request('tampil', 10) == 10 ? 'selected' : '' }}>10 data</option>
                                                <option value="25" {{ request('tampil') == 25 ? 'selected' : '' }}>25 data</option>
                                                <option value="50" {{ request('tampil') == 50 ? 'selected' : '' }}>50 data</option>
                                                <option value="100" {{ request('tampil') == 100 ? 'selected' : '' }}>100 data</option>
                                            </select>
                                        </div>

                                        <button type="submit" class="btn btn-gradient-primary btn-icon-only" title="Filter">
                                            <i class="mdi mdi-filter"></i>
                                        </button>
                                        <a href="{{ route('lokasi.index') }}" class="btn btn-gradient-secondary btn-icon-only" title="Reset">
                                            <i class="mdi mdi-refresh"></i>
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <!-- Mobile Filter -->
                        <div class="filter-row-mobile d-block d-md-none">
                            <form method="GET" action="{{ route('lokasi.index') }}">
                                <div class="row g-2">
                                    <div class="col-12 mb-2">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="search" id="searchInputMobile"
                                                placeholder="Cari nama properti..."
                                                value="{{ request('search') }}"
                                                style="border-top-right-radius: 0 !important; border-bottom-right-radius: 0 !important; border-right: none;">
                                            <button class="btn btn-gradient-primary d-flex align-items-center justify-content-center px-3" 
                                                type="submit" title="Cari"
                                                style="border-top-left-radius: 0 !important; border-bottom-left-radius: 0 !important; border-top-right-radius: 4px !important; border-bottom-right-radius: 4px !important; height: 38px; box-shadow: none;">
                                                <i class="mdi mdi-magnify" style="font-size: 1.15rem; color: #ffffff;"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="col-12 mb-2">
                                        <select name="kategori" class="form-control" id="categorySelectMobile">
                                            <option value="">Semua Kategori</option>
                                            @foreach ($zonings as $zoning)
                                                <option value="{{ $zoning }}" {{ request('kategori') == $zoning ? 'selected' : '' }}>
                                                    {{ $zoning }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-12 mb-2">
                                        <select name="tampil" class="form-control" id="showSelectMobile">
                                            <option value="10" {{ request('tampil') == 10 ? 'selected' : '' }}>10 data</option>
                                            <option value="25" {{ request('tampil') == 25 ? 'selected' : '' }}>25 data</option>
                                            <option value="50" {{ request('tampil') == 50 ? 'selected' : '' }}>50 data</option>
                                            <option value="100" {{ request('tampil') == 100 ? 'selected' : '' }}>100 data</option>
                                        </select>
                                    </div>

                                    <div class="col-6">
                                        <button type="submit" class="btn btn-gradient-primary w-100 d-flex align-items-center justify-content-center gap-1">
                                            <i class="mdi mdi-filter"></i> Filter
                                        </button>
                                    </div>

                                    <div class="col-6">
                                        <a href="{{ route('lokasi.index') }}" class="btn btn-gradient-secondary w-100 d-flex align-items-center justify-content-center gap-1">
                                            <i class="mdi mdi-refresh"></i> Reset
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Tabel Data Properti -->
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th>Nama Properti</th>
                                    <th>Kategori</th>
                                    <th>Lokasi</th>
                                    <th>Jarak</th>
                                    <th>Status</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($landBanks as $item)
                                    <tr>
                                        <td class="text-center fw-bold">{{ $loop->iteration + ($landBanks->currentPage() - 1) * $landBanks->perPage() }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <i class="mdi mdi-home-city text-primary me-2" style="font-size: 1.2rem;"></i>
                                                <span class="fw-bold">{{ $item->name }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge-category">
                                                <i class="mdi mdi-shape-outline"></i>
                                                {{ $item->zoning ?? 'Tanah' }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="d-inline-flex align-items-center gap-1" title="{{ $item->address }}">
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
                                        <td class="text-center">
                                            <button type="button" class="btn-action fase2" title="Lihat Lokasi di Google Maps"
                                                onclick="flyToLocation({{ $item->lat ?? 0 }}, {{ $item->lng ?? 0 }}, '{{ addslashes($item->name) }}')">
                                                <i class="mdi mdi-crosshairs-gps"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center text-muted py-4">
                                            <i class="mdi mdi-information-outline me-2"></i> Tidak ada properti ditemukan.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mt-4">
                        <div class="pagination-info mb-2 mb-sm-0 text-muted" style="font-size: 0.82rem;">
                            Menampilkan {{ $landBanks->firstItem() ?? 0 }} - {{ $landBanks->lastItem() ?? 0 }} dari {{ $landBanks->total() }} data
                        </div>

                        <nav aria-label="Page navigation">
                            <ul class="pagination pagination-sm flex-wrap justify-content-center mb-0">
                                <li class="page-item {{ $landBanks->onFirstPage() ? 'disabled' : '' }}">
                                    <a class="page-link" href="{{ $landBanks->previousPageUrl() }}">
                                        <i class="mdi mdi-chevron-left"></i>
                                    </a>
                                </li>

                                @for($page = 1; $page <= $landBanks->lastPage(); $page++)
                                    <li class="page-item {{ $page == $landBanks->currentPage() ? 'active' : '' }}">
                                        @if($page == $landBanks->currentPage())
                                            <span class="page-link">{{ $page }}</span>
                                        @else
                                            <a class="page-link" href="{{ $landBanks->appends(request()->query())->url($page) }}">{{ $page }}</a>
                                        @endif
                                    </li>
                                @endfor

                                <li class="page-item {{ $landBanks->hasMorePages() ? '' : 'disabled' }}">
                                    <a class="page-link" href="{{ $landBanks->nextPageUrl() }}">
                                        <i class="mdi mdi-chevron-right"></i>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>

@endsection

@push('scripts')
<script>
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