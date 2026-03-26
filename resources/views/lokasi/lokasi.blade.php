@extends('layouts.partial.app')

@section('title', 'Lokasi Properti - Property Management App')

@section('content')
    <style>
        /* ===== STYLING UNTUK HALAMAN LOKASI ===== */
        .card {
            transition: all 0.3s ease;
            margin-bottom: 1rem;
        }

        .card:hover {
            box-shadow: 0 8px 25px rgba(154, 85, 255, 0.1) !important;
        }

        .card-header {
            background: linear-gradient(135deg, #ffffff, #f8f9fa);
            border-bottom: 1px solid #e9ecef;
            padding: 0.75rem;
        }

        @media (min-width: 576px) {
            .card-header {
                padding: 1rem;
            }
        }

        @media (min-width: 768px) {
            .card-header {
                padding: 1.2rem;
            }
        }

        .card-body {
            padding: 0.75rem;
        }

        @media (min-width: 576px) {
            .card-body {
                padding: 1rem;
            }
        }

        @media (min-width: 768px) {
            .card-body {
                padding: 1.2rem;
            }
        }

        /* Card Title */
        .card-title {
            font-size: 0.9rem;
            font-weight: 600;
            color: #9a55ff;
            margin-bottom: 0;
        }

        @media (min-width: 576px) {
            .card-title {
                font-size: 1rem;
            }
        }

        @media (min-width: 768px) {
            .card-title {
                font-size: 1.1rem;
            }
        }

        /* ===== FILTER SECTION ===== */
        .filter-card {
            background: linear-gradient(135deg, #f9f7ff, #f2ecff);
            border-radius: 12px;
            padding: 1rem;
            margin-bottom: 1.25rem;
        }

        .filter-card .card-body {
            padding: 1rem !important;
        }

        .filter-card .form-label {
            font-size: 0.85rem;
            font-weight: 600;
            color: #9a55ff !important;
            margin-bottom: 0.4rem;
            letter-spacing: 0.3px;
        }

        .filter-card .form-control,
        .filter-card .form-select {
            padding: 0.5rem 0.75rem;
            font-size: 0.9rem;
            border-radius: 8px;
            height: auto;
            min-height: 40px;
            border: 1px solid #e0e4e9;
        }

        .filter-card .btn {
            padding: 0.5rem 0.75rem;
            font-size: 0.85rem;
            min-height: 40px;
            border-radius: 8px;
            font-weight: 600;
        }

        /* Form Controls */
        .form-control,
        .form-select {
            border: 1px solid #e9ecef;
            border-radius: 8px;
            padding: 0.6rem 0.8rem;
            font-size: 0.9rem;
            transition: all 0.2s ease;
            background-color: #ffffff;
            color: #2c2e3f;
            height: auto;
        }

        @media (min-width: 576px) {

            .form-control,
            .form-select {
                padding: 0.7rem 1rem;
                font-size: 0.95rem;
                border-radius: 10px;
            }
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #9a55ff;
            box-shadow: 0 0 0 3px rgba(154, 85, 255, 0.1);
            outline: none;
        }

        /* Form Label */
        .form-label {
            font-size: 0.85rem;
            font-weight: 600;
            color: #9a55ff !important;
            margin-bottom: 0.3rem;
            letter-spacing: 0.3px;
            font-family: 'Nunito', sans-serif;
        }

        /* Button Styling */
        .btn {
            font-size: 0.85rem;
            padding: 0.6rem 1rem;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
            font-family: 'Nunito', sans-serif;
            border: none;
        }

        @media (min-width: 576px) {
            .btn {
                font-size: 0.9rem;
                padding: 0.7rem 1.2rem;
                border-radius: 10px;
            }
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .btn-sm {
            padding: 0.35rem 0.7rem;
            font-size: 0.8rem;
            border-radius: 6px;
        }

        .btn-gradient-primary {
            background: linear-gradient(to right, #da8cff, #9a55ff) !important;
            color: #ffffff !important;
        }

        .btn-gradient-secondary {
            background: #6c757d !important;
            color: #ffffff !important;
        }

        .btn-gradient-secondary:hover {
            background: #5a6268 !important;
        }

        .btn-gradient-success {
            background: linear-gradient(135deg, #28a745, #5cb85c) !important;
            color: #ffffff !important;
        }

        .btn-gradient-danger {
            background: linear-gradient(135deg, #dc3545, #e4606d) !important;
            color: #ffffff !important;
        }

        .btn-gradient-info {
            background: linear-gradient(135deg, #17a2b8, #5bc0de) !important;
            color: #ffffff !important;
        }

        /* Outline Buttons */
        .btn-outline-primary {
            background: transparent;
            border: 1px solid #9a55ff;
            color: #9a55ff;
            padding: 0.4rem 0.75rem;
        }

        .btn-outline-primary:hover {
            background: linear-gradient(to right, #da8cff, #9a55ff);
            color: #ffffff;
            border-color: transparent;
        }

        /* ===== MAP STYLING ===== */
        #map {
            height: 450px;
            width: 100%;
            border-radius: 12px;
            z-index: 1;
        }

        .leaflet-container {
            border-radius: 12px;
            font-family: 'Nunito', sans-serif;
        }

        .leaflet-popup-content-wrapper {
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        }

        .leaflet-popup-content {
            margin: 12px 16px;
            font-family: 'Nunito', sans-serif;
            color: #2c2e3f;
        }

        .leaflet-popup-content strong {
            color: #9a55ff;
            font-size: 1rem;
        }

        .leaflet-popup-content p {
            margin: 5px 0;
            font-size: 0.85rem;
        }

        .leaflet-popup-tip-container {
            margin-top: -1px;
        }

        /* Custom marker styling */
        .custom-marker {
            background: linear-gradient(135deg, #da8cff, #9a55ff);
            border: 3px solid white;
            border-radius: 50%;
            width: 40px !important;
            height: 40px !important;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 10px rgba(154, 85, 255, 0.3);
        }

        .custom-marker i {
            color: white;
            font-size: 20px;
        }

        /* Info Panel */
        .info-panel {
            background: white;
            border-radius: 12px;
            padding: 1rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            border: 1px solid #e9ecef;
            margin-top: 1rem;
        }

        .info-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.5rem;
            border-bottom: 1px solid #e9ecef;
        }

        .info-item:last-child {
            border-bottom: none;
        }

        .info-icon {
            width: 35px;
            height: 35px;
            background: linear-gradient(135deg, #f9f7ff, #f2ecff);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .info-icon i {
            color: #9a55ff;
            font-size: 1.2rem;
        }

        .info-content {
            flex: 1;
        }

        .info-title {
            font-size: 0.8rem;
            color: #6c7383;
            margin-bottom: 0.1rem;
        }

        .info-value {
            font-size: 0.9rem;
            font-weight: 600;
            color: #2c2e3f;
        }

        /* ===== PAGINATION STYLING ===== */
        .pagination {
            margin: 0;
            gap: 3px;
        }

        .page-item .page-link {
            border: 1px solid #e9ecef;
            padding: 0.35rem 0.7rem;
            font-size: 0.75rem;
            color: #6c7383;
            background-color: #ffffff;
            border-radius: 6px !important;
            transition: all 0.2s ease;
            min-width: 32px;
            text-align: center;
        }

        @media (min-width: 576px) {
            .page-item .page-link {
                padding: 0.4rem 0.8rem;
                font-size: 0.8rem;
                min-width: 36px;
            }
        }

        @media (min-width: 768px) {
            .page-item .page-link {
                padding: 0.45rem 0.9rem;
                font-size: 0.85rem;
                min-width: 40px;
            }
        }

        .page-item.active .page-link {
            background: linear-gradient(to right, #da8cff, #9a55ff);
            border-color: transparent;
            color: #ffffff;
            box-shadow: 0 4px 12px rgba(154, 85, 255, 0.3);
        }

        .page-item .page-link:hover {
            background-color: #f8f9fa;
            border-color: #9a55ff;
            color: #9a55ff;
            transform: translateY(-1px);
        }

        /* Info text pagination */
        .pagination-info {
            font-size: 0.8rem;
            color: #6c7383;
        }

        @media (min-width: 576px) {
            .pagination-info {
                font-size: 0.85rem;
            }
        }

        @media (min-width: 768px) {
            .pagination-info {
                font-size: 0.9rem;
            }
        }

        /* Typography */
        h3.text-dark,
        h4.text-dark {
            font-size: 1.3rem !important;
            font-weight: 700;
            color: #2c2e3f !important;
            margin-bottom: 0.5rem !important;
        }

        @media (min-width: 576px) {

            h3.text-dark,
            h4.text-dark {
                font-size: 1.5rem !important;
            }
        }

        @media (min-width: 768px) {

            h3.text-dark,
            h4.text-dark {
                font-size: 1.7rem !important;
            }
        }

        /* Icon styling */
        .mdi {
            vertical-align: middle;
        }

        /* ===== TABLE MODERN STYLE ===== */
        .table-responsive {
            overflow-x: auto;
            overflow-y: visible;
            -webkit-overflow-scrolling: touch;
            border-radius: 8px;
            margin-bottom: 0.5rem;
            scrollbar-width: thin;
            scrollbar-color: #9a55ff #f0f0f0;
        }

        .table-responsive::-webkit-scrollbar {
            height: 8px;
        }

        .table-responsive::-webkit-scrollbar-track {
            background: #f0f0f0;
            border-radius: 10px;
        }

        .table-responsive::-webkit-scrollbar-thumb {
            background: #9a55ff;
            border-radius: 10px;
        }

        .table-responsive::-webkit-scrollbar-thumb:hover {
            background: #7a3fcc;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 0;
        }

        .table thead th {
            background: linear-gradient(135deg, #f8f9fa, #f1f3f5);
            color: #9a55ff;
            font-weight: 600;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 2px solid #e9ecef;
            padding: 0.8rem 0.5rem;
            white-space: nowrap;
        }

        @media (min-width: 576px) {
            .table thead th {
                font-size: 0.85rem;
                padding: 0.9rem 0.6rem;
            }
        }

        @media (min-width: 768px) {
            .table thead th {
                font-size: 0.9rem;
                padding: 1rem 0.75rem;
            }
        }

        .table thead th:first-child {
            text-align: center;
            width: 40px;
        }

        .table tbody td {
            vertical-align: middle;
            font-size: 0.85rem;
            padding: 0.8rem 0.5rem;
            border-bottom: 1px solid #e9ecef;
            color: #2c2e3f;
            white-space: nowrap;
        }

        .table tbody td:first-child {
            text-align: center;
            font-weight: 600;
        }

        @media (min-width: 576px) {
            .table tbody td {
                font-size: 0.9rem;
                padding: 0.9rem 0.6rem;
            }
        }

        @media (min-width: 768px) {
            .table tbody td {
                font-size: 0.95rem;
                padding: 1rem 0.75rem;
            }
        }

        .table tbody tr:hover {
            background-color: #f8f9fa;
        }

        /* Badge Status */
        .badge-status {
            padding: 0.3rem 0.8rem;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.8rem;
            display: inline-block;
        }

        .badge-tersedia {
            background: linear-gradient(135deg, #28a745, #5cb85c);
            color: #fff;
        }

        .badge-booking {
            background: linear-gradient(135deg, #ffc107, #ffdb6d);
            color: #2c2e3f;
        }

        .badge-terjual {
            background: linear-gradient(135deg, #dc3545, #e4606d);
            color: #fff;
        }

        .badge-default {
            background: linear-gradient(135deg, #6c757d, #adb5bd);
            color: #fff;
        }

        /* Action Buttons */
        .btn-action {
            min-width: 90px;
            height: 36px;
            padding: 0 12px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            border-radius: 10px;
            margin: 0 2px;
            transition: all 0.3s ease;
            cursor: pointer;
            font-weight: 600;
            font-size: 0.85rem;
            background: transparent;
        }

        .btn-action i {
            font-size: 1rem;
        }

        .btn-action.view {
            background: linear-gradient(135deg, #17a2b8, #5bc0de);
            color: white;
        }

        .btn-action.view:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(23, 162, 184, 0.4);
        }

        .btn-action.locate {
            border: 1.5px solid #9a55ff;
            color: #9a55ff;
            background: transparent;
        }

        .btn-action.locate:hover {
            background: linear-gradient(135deg, #9a55ff, #da8cff);
            color: #ffffff;
            border-color: transparent;
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(154, 85, 255, 0.4);
        }

        /* Responsive untuk mobile */
        @media (max-width: 576px) {
            #map {
                height: 300px;
            }

            .info-panel {
                margin-top: 0.5rem;
            }

            .btn-action {
                min-width: 78px;
                font-size: 0.8rem;
                padding: 0 10px;
            }
        }
    </style>

    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <!-- Leaflet JavaScript -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <div class="container-fluid p-2 p-sm-3 p-md-4">
        <!-- Header -->
        <div class="row mb-3 mb-sm-3 mb-md-4">
            <div class="col-12">
                <div class="card shadow-sm border-0">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="text-dark mb-1">
                                <i class="mdi mdi-map-marker-radius me-2" style="color: #9a55ff;"></i>
                                Lokasi Properti
                            </h3>
                            <p class="text-muted mb-0">
                                <i class="mdi mdi-information-outline me-1"></i>
                                Peta lokasi properti yang tersedia
                            </p>
                        </div>
                        <div class="d-none d-sm-block">
                            <i class="mdi mdi-map" style="font-size: 2.5rem; color: #9a55ff; opacity: 0.2;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Map and Filter in One Card -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-white">
                        <h5 class="card-title mb-0">
                            <i class="mdi mdi-map me-2 text-primary"></i>
                            Peta Lokasi Properti
                        </h5>
                    </div>
                    <div class="card-body p-2 p-sm-3">
                        <div id="map"></div>

                        <div class="info-panel">
                            <div class="row g-2">
                                <div class="col-6 col-md-3">
                                    <div class="info-item">
                                        <div class="info-icon">
                                            <i class="mdi mdi-home-group"></i>
                                        </div>
                                        <div class="info-content">
                                            <div class="info-title">Total Properti</div>
                                            <div class="info-value">{{ $totalLandBanks }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 col-md-3">
                                    <div class="info-item">
                                        <div class="info-icon">
                                            <i class="mdi mdi-check-circle"></i>
                                        </div>
                                        <div class="info-content">
                                            <div class="info-title">Tersedia</div>
                                            <div class="info-value">{{ $totalReady }} Unit</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 col-md-3">
                                    <div class="info-item">
                                        <div class="info-icon">
                                            <i class="mdi mdi-clock"></i>
                                        </div>
                                        <div class="info-content">
                                            <div class="info-title">Booking</div>
                                            <div class="info-value">{{ $totalBooked }} Unit</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 col-md-3">
                                    <div class="info-item">
                                        <div class="info-icon">
                                            <i class="mdi mdi-cash-check"></i>
                                        </div>
                                        <div class="info-content">
                                            <div class="info-title">Terjual</div>
                                            <div class="info-value">{{ $totalSold }} Unit</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Daftar Properti --}}
        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-white">
                        <h5 class="card-title mb-0">
                            <i class="mdi mdi-format-list-bulleted me-2"></i>Daftar Properti Terdekat
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="filter-card">
                            <div class="card-body">
                                <form method="GET" action="{{ route('lokasi.index') }}">
                                    <!-- Mobile Filter -->
                                    <div class="d-block d-md-none">
                                        <div class="mb-3">
                                            <label class="form-label">
                                                <i class="mdi mdi-magnify me-1"></i>Cari Properti
                                            </label>
                                            <input type="text" name="search" value="{{ request('search') }}"
                                                class="form-control" placeholder="Cari nama properti...">
                                        </div>

                                        <div class="row g-2">
                                            <div class="col-md-3">
                                                <label class="form-label">
                                                    <i class="mdi mdi-home me-1"></i>Kategori
                                                </label>
                                                <select name="kategori" class="form-control">
                                                    <option value="">Semua</option>
                                                    @foreach ($zonings as $zoning)
                                                        <option value="{{ $zoning }}" {{ request('kategori') == $zoning ? 'selected' : '' }}>
                                                            {{ $zoning }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-6">
                                                <label class="form-label">
                                                    <i class="mdi mdi-counter me-1"></i>Tampil
                                                </label>
                                                <select name="tampil" class="form-control">
                                                    <option value="10" {{ request('tampil') == 10 ? 'selected' : '' }}>10</option>
                                                    <option value="25" {{ request('tampil') == 25 ? 'selected' : '' }}>25</option>
                                                    <option value="50" {{ request('tampil') == 50 ? 'selected' : '' }}>50</option>
                                                    <option value="100" {{ request('tampil') == 100 ? 'selected' : '' }}>100</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row g-2 mt-2">
                                            <div class="col-12">
                                                <button type="submit" class="btn btn-gradient-primary w-100">
                                                    <i class="mdi mdi-magnify me-1"></i>Cari
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                                <form method="GET" action="{{ route('lokasi.index') }}">
                                    <!-- Desktop Filter -->
                                    <div class="d-none d-md-block">
                                        <div class="row g-2 align-items-end">
                                            <div class="col-md-5">
                                                <label class="form-label">
                                                    <i class="mdi mdi-magnify me-1"></i>Cari Properti
                                                </label>
                                                <input type="text" name="search" value="{{ request('search') }}"
                                                    class="form-control" placeholder="Cari nama properti...">
                                            </div>

                                            <div class="col-md-3">
                                                <label class="form-label">
                                                    <i class="mdi mdi-home me-1"></i>Kategori
                                                </label>
                                                <select name="kategori" class="form-control">
                                                    <option value="">Semua</option>
                                                    @foreach ($zonings as $zoning)
                                                        <option value="{{ $zoning }}" {{ request('kategori') == $zoning ? 'selected' : '' }}>
                                                            {{ $zoning }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-md-2">
                                                <label class="form-label">
                                                    <i class="mdi mdi-counter me-1"></i>Tampil
                                                </label>
                                                <select name="tampil" class="form-control">
                                                    <option value="10" {{ request('tampil', 10) == 10 ? 'selected' : '' }}>10</option>
                                                    <option value="25" {{ request('tampil') == 25 ? 'selected' : '' }}>25</option>
                                                    <option value="50" {{ request('tampil') == 50 ? 'selected' : '' }}>50</option>
                                                    <option value="100" {{ request('tampil') == 100 ? 'selected' : '' }}>100</option>
                                                </select>
                                            </div>

                                            <div class="col-md-2">
                                                <button type="submit" class="btn btn-gradient-primary w-100" title="Filter">
                                                    <i class="mdi mdi-filter"></i> Filter
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-hover align-middle" style="width:100%;margin-bottom:0;">
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
                                            <td>{{ $loop->iteration + ($landBanks->currentPage() - 1) * $landBanks->perPage() }}</td>
                                            <td>
                                                <div class="d-flex align-items-center gap-1">
                                                    <i class="mdi mdi-home-variant" style="color:#9a55ff;font-size:1.1rem;"></i>
                                                    <span>{{ $item->name }}</span>
                                                </div>
                                            </td>
                                            <td>{{ $item->zoning }}</td>
                                            <td>{{ Str::limit($item->address, 35) }}</td>
                                            <td class="distance" data-lat="{{ $item->lat }}" data-lng="{{ $item->lng }}">
                                                <span class="text-muted">Menghitung...</span>
                                            </td>
                                            <td>
                                                @php $st = strtolower($item->status ?? ''); @endphp
                                                @if (str_contains($st, 'tersedia'))
                                                    <span class="badge-status badge-tersedia">{{ $item->status }}</span>
                                                @elseif(str_contains($st, 'booking'))
                                                    <span class="badge-status badge-booking">{{ $item->status }}</span>
                                                @elseif(str_contains($st, 'terjual') || str_contains($st, 'sold'))
                                                    <span class="badge-status badge-terjual">{{ $item->status }}</span>
                                                @else
                                                    <span class="badge-status badge-default">{{ $item->status }}</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <button class="btn-action locate" title="Lihat di Peta"
                                                    onclick="flyToLocation({{ $item->lat }}, {{ $item->lng }})">
                                                    <i class="mdi mdi-map-marker"></i>
                                                    <span>Lihat</span>
                                                </button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center py-4">
                                                <i class="mdi mdi-map-marker-off" style="font-size:2rem;color:#9a55ff;opacity:0.4;"></i>
                                                <p class="mt-2 mb-0 text-muted">Tidak ada properti ditemukan.</p>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        {{-- Pagination --}}
                        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mt-4">
                            <div class="pagination-info mb-2 mb-sm-0">
                                Menampilkan <strong>{{ $landBanks->firstItem() ?? 0 }}</strong> -
                                <strong>{{ $landBanks->lastItem() ?? 0 }}</strong> dari
                                <strong>{{ $landBanks->total() }}</strong> data
                            </div>
                            <nav>
                                <ul class="pagination">
                                    @if ($landBanks->onFirstPage())
                                        <li class="page-item disabled">
                                            <span class="page-link"><i class="mdi mdi-chevron-left"></i></span>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $landBanks->appends(request()->query())->previousPageUrl() }}">
                                                <i class="mdi mdi-chevron-left"></i>
                                            </a>
                                        </li>
                                    @endif

                                    @foreach ($landBanks->getUrlRange(max(1, $landBanks->currentPage() - 2), min($landBanks->lastPage(), $landBanks->currentPage() + 2)) as $page => $url)
                                        @if ($page == $landBanks->currentPage())
                                            <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                                        @else
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $landBanks->appends(request()->query())->url($page) }}">{{ $page }}</a>
                                            </li>
                                        @endif
                                    @endforeach

                                    @if ($landBanks->hasMorePages())
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $landBanks->appends(request()->query())->nextPageUrl() }}">
                                                <i class="mdi mdi-chevron-right"></i>
                                            </a>
                                        </li>
                                    @else
                                        <li class="page-item disabled">
                                            <span class="page-link"><i class="mdi mdi-chevron-right"></i></span>
                                        </li>
                                    @endif
                                </ul>
                            </nav>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function() {
                // Inisialisasi peta default Jember
                var map = L.map('map').setView([-8.1725, 113.7026], 12);

                // Tile layer OpenStreetMap
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
                    maxZoom: 19
                }).addTo(map);

                // Ambil data lokasi dari backend
                $.getJSON('/lokasi-data', function(locations) {
                    locations.forEach(function(loc) {
                        // Tentukan icon berdasarkan kategori
                        let iconMap = {
                            'Rumah': 'home-variant',
                            'Apartemen': 'office-building',
                            'Ruko': 'store',
                            'Tanah': 'terrain'
                        };
                        var iconName = iconMap[loc.category] || 'map-marker';

                        // Custom marker
                        var customIcon = L.divIcon({
                            className: 'custom-marker',
                            html: '<i class="mdi mdi-' + iconName +
                                '" style="font-size: 24px; color: #9a55ff;"></i>',
                            iconSize: [40, 40],
                            iconAnchor: [20, 40],
                            popupAnchor: [0, -40]
                        });

                        // Marker
                        var marker = L.marker([loc.lat, loc.lng], {
                            icon: customIcon
                        }).addTo(map);

                        // Popup content
                        var popupContent = `
                            <div style="min-width: 200px;">
                                <strong>${loc.name}</strong>
                                <p><i class="mdi mdi-map-marker" style="color: #9a55ff;"></i> ${loc.address}</p>
                                <p><i class="mdi mdi-home" style="color: #9a55ff;"></i> ${loc.category}</p>
                                <p><i class="mdi mdi-currency-usd" style="color: #9a55ff;"></i> ${loc.price}</p>
                                <p>
                                    <span class="badge" style="background: ${
                                        loc.status === 'Tersedia' ? 'linear-gradient(135deg, #28a745, #5cb85c)' :
                                        loc.status === 'Booking' ? 'linear-gradient(135deg, #ffc107, #ffdb6d)' :
                                        'linear-gradient(135deg, #dc3545, #e4606d)'
                                    }; color: white; padding: 4px 8px; border-radius: 20px;">
                                        ${loc.status}
                                    </span>
                                </p>
                                <button class="btn btn-sm" style="background: linear-gradient(to right, #da8cff, #9a55ff); color: white; border: none; border-radius: 6px; padding: 5px 10px; margin-top: 5px;" onclick="alert('Detail ${loc.name}')">
                                    <i class="mdi mdi-eye"></i> Detail
                                </button>
                            </div>
                        `;
                        marker.bindPopup(popupContent);
                    });
                });

                // Fungsi flyTo lokasi
                window.flyToLocation = function(lat, lng) {
                    map.flyTo([lat, lng], 15, {
                        animate: true,
                        duration: 1.5
                    });
                };
            });
        </script>
        <script>
            function toRad(Value) {
                return Value * Math.PI / 180;
            }

            function getDistanceFromLatLonInKm(lat1, lon1, lat2, lon2) {
                var R = 6371; // Radius bumi km
                var dLat = toRad(lat2 - lat1);
                var dLon = toRad(lon2 - lon1);
                var a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
                    Math.cos(toRad(lat1)) * Math.cos(toRad(lat2)) *
                    Math.sin(dLon / 2) * Math.sin(dLon / 2);
                var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
                var d = R * c;
                return d.toFixed(1); // km
            }

            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    let userLat = position.coords.latitude;
                    let userLng = position.coords.longitude;

                    document.querySelectorAll('.distance').forEach(function(td) {
                        let propLat = parseFloat(td.dataset.lat);
                        let propLng = parseFloat(td.dataset.lng);
                        let distance = getDistanceFromLatLonInKm(userLat, userLng, propLat, propLng);
                        td.innerText = distance + ' km';
                    });
                }, function() {
                    console.log("User tidak mengizinkan lokasi.");
                });
            } else {
                console.log("Browser tidak mendukung Geolocation");
            }
        </script>
    @endpush
@endsection