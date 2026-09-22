@extends('layouts.partial.app')

@section('title', 'Tambah Kavling - Property Management App')

@push('styles')
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
            width: 90px;
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
        .badge-status.processing {
            background: rgba(245, 158, 11, 0.15);
            color: #b45309;
            border: 1px solid rgba(245, 158, 11, 0.35);
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
        .btn-action.create {
            background: linear-gradient(135deg, #da8cff, #9a55ff);
            color: #ffffff !important;
            box-shadow: 0 2px 5px rgba(154, 85, 255, 0.25);
        }
        .btn-action.create i {
            color: #ffffff !important;
            font-size: 1.05rem;
        }
        .btn-action.create:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(154, 85, 255, 0.4);
            color: #ffffff !important;
        }
        .btn-action.locked {
            background: linear-gradient(135deg, #f59e0b, #d97706);
            color: #ffffff !important;
            box-shadow: 0 2px 5px rgba(245, 158, 11, 0.25);
        }
        .btn-action.locked i {
            color: #ffffff !important;
            font-size: 1.05rem;
        }
        .btn-action.locked:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(245, 158, 11, 0.4);
            color: #ffffff !important;
        }

        .sortable {
            cursor: pointer;
            user-select: none;
        }
        .sortable:hover {
            background: #f1f5f9 !important;
        }
    </style>
@endpush

@section('content')

<div class="container-fluid px-2 px-md-4 py-3">

    <!-- Page Title & Subtitle (Persis Perizinan) -->
    <div class="row align-items-center mb-4">
        <div class="col">
            <h2 class="text-dark mb-1 fw-bold" style="font-size: 1.55rem; letter-spacing: -0.02em;">
                Tambah Kavling
            </h2>
            <p class="text-muted mb-0" style="font-size: 0.88rem;">
                Daftar tanah / landbank terverifikasi untuk pembuatan dan pemecahan unit kavling
            </p>
        </div>
    </div>

    <!-- 4 KPI Metrics Card Grid (Persis Perizinan / Pra Tanah) -->
    <div class="dash-kpi-grid mb-4">
        
        <!-- Card 1: Total Tanah Terverifikasi (Ungu) -->
        <div class="dash-kpi-card">
            <div class="dash-kpi-left">
                <div class="dash-kpi-icon purple">
                    <i class="mdi mdi-office-building-marker"></i>
                </div>
                <div class="dash-kpi-info">
                    <div class="dash-kpi-label">Tanah Terverifikasi</div>
                    <div class="dash-kpi-val">{{ $totalVerified ?? $lands->total() }}</div>
                    <div class="dash-kpi-sub">Siap Untuk Pemecahan</div>
                </div>
            </div>
            <div class="dash-kpi-action purple">
                <i class="mdi mdi-arrow-right"></i>
            </div>
        </div>

        <!-- Card 2: Siap Tambah Kavling (Hijau) -->
        <div class="dash-kpi-card">
            <div class="dash-kpi-left">
                <div class="dash-kpi-icon green">
                    <i class="mdi mdi-check-decagram-outline"></i>
                </div>
                <div class="dash-kpi-info">
                    <div class="dash-kpi-label">Siap Tambah Kavling</div>
                    <div class="dash-kpi-val">{{ $readyKavling ?? 0 }}</div>
                    <div class="dash-kpi-sub">Infrastruktur 100% Selesai</div>
                </div>
            </div>
            <div class="dash-kpi-action green">
                <i class="mdi mdi-arrow-right"></i>
            </div>
        </div>

        <!-- Card 3: Dalam Pengolahan Fisik (Kuning / Amber) -->
        <div class="dash-kpi-card">
            <div class="dash-kpi-left">
                <div class="dash-kpi-icon amber">
                    <i class="mdi mdi-progress-wrench"></i>
                </div>
                <div class="dash-kpi-info">
                    <div class="dash-kpi-label">Dalam Pengolahan Fisik</div>
                    <div class="dash-kpi-val">{{ $processingLahan ?? 0 }}</div>
                    <div class="dash-kpi-sub">Proses Infrastruktur Lahan</div>
                </div>
            </div>
            <div class="dash-kpi-action amber">
                <i class="mdi mdi-arrow-right"></i>
            </div>
        </div>

        <!-- Card 4: Total Luas Lahan (Biru) -->
        <div class="dash-kpi-card">
            <div class="dash-kpi-left">
                <div class="dash-kpi-icon blue">
                    <i class="mdi mdi-ruler-square"></i>
                </div>
                <div class="dash-kpi-info">
                    <div class="dash-kpi-label">Total Luas Lahan</div>
                    <div class="dash-kpi-val" style="font-size: 1.15rem;">{{ number_format($totalLuasLahan ?? 0, 0, ',', '.') }} m²</div>
                    <div class="dash-kpi-sub">Akumulasi Luas Tanah</div>
                </div>
            </div>
            <div class="dash-kpi-action blue">
                <i class="mdi mdi-arrow-right"></i>
            </div>
        </div>

    </div>

    <!-- Main Container: Table Card -->
    <div class="row">
        <div class="col-12">
            <div class="card compact-table-card shadow-sm border-0">
                
                <!-- Card Header -->
                <div class="card-header bg-white d-flex flex-wrap justify-content-between align-items-center gap-2 py-3 border-bottom">
                    <div>
                        <h5 class="card-title mb-0" style="font-weight: 700; color: #1e293b; font-size: 1.05rem;">
                            <i class="mdi mdi-vector-arrange-below me-2" style="color: #9a55ff;"></i>Daftar Tanah / LandBank Terverifikasi
                        </h5>
                    </div>
                </div>

                <div class="card-body p-0">
                    
                    <!-- Search & Filter Toolbar (Kategori Dihapus Sesuai Permintaan) -->
                    <div class="card-toolbar-box p-3 border-bottom bg-white">
                        <form id="filterForm" method="GET" action="{{ route('kavling.index') }}" onsubmit="return showFilterLoading()">
                            
                            <!-- DESKTOP VERSION -->
                            <div class="d-none d-md-block">
                                <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 w-100">
                                    <div class="d-flex flex-wrap align-items-center gap-2 flex-grow-1">
                                        <!-- Search Input -->
                                        <div style="min-width: 240px; max-width: 360px; flex: 1;">
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="search" id="liveSearchInput"
                                                    placeholder="Cari nama properti / lokasi..."
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

                                        <!-- Status Filter -->
                                        <div style="width: 170px;">
                                            <select class="form-select" name="status" id="statusSelect" onchange="document.getElementById('filterForm').submit()" style="height: 38px;">
                                                <option value="">Semua Status</option>
                                                <option value="available" {{ request('status') == 'available' ? 'selected' : '' }}>Tersedia</option>
                                                <option value="processing" {{ request('status') == 'processing' ? 'selected' : '' }}>Dalam Pengolahan</option>
                                                <option value="booking" {{ request('status') == 'booking' ? 'selected' : '' }}>Booking</option>
                                                <option value="sold" {{ request('status') == 'sold' ? 'selected' : '' }}>Terjual</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Right: Limit + Action Buttons -->
                                    <div class="d-flex align-items-center gap-2 ms-auto">
                                        <div style="width: 110px;">
                                            <select class="form-select" name="per_page" id="showSelect" onchange="document.getElementById('filterForm').submit()" style="height: 38px;">
                                                <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10 data</option>
                                                <option value="25" {{ request('per_page', 25) == 25 ? 'selected' : '' }}>25 data</option>
                                                <option value="50" {{ request('per_page', 50) == 50 ? 'selected' : '' }}>50 data</option>
                                                <option value="100" {{ request('per_page', 100) == 100 ? 'selected' : '' }}>100 data</option>
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-gradient-primary d-inline-flex align-items-center justify-content-center" style="width: 38px; height: 38px; padding: 0;" title="Filter">
                                            <i class="mdi mdi-filter"></i>
                                        </button>
                                        <a href="{{ route('kavling.index') }}" class="btn btn-gradient-secondary d-inline-flex align-items-center justify-content-center" style="width: 38px; height: 38px; padding: 0;" title="Reset" onclick="showResetLoading(event)">
                                            <i class="mdi mdi-refresh"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!-- MOBILE VERSION -->
                            <div class="d-block d-md-none">
                                <div class="row g-2">
                                    <div class="col-12 mb-2">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="search" id="searchInputMobile"
                                                placeholder="Cari properti / lokasi..."
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
                                    <div class="col-6 mb-2">
                                        <select class="form-select" name="status" id="statusSelectMobile" onchange="document.getElementById('filterForm').submit()" style="height: 38px;">
                                            <option value="">Semua Status</option>
                                            <option value="available" {{ request('status') == 'available' ? 'selected' : '' }}>Tersedia</option>
                                            <option value="processing" {{ request('status') == 'processing' ? 'selected' : '' }}>Dalam Pengolahan</option>
                                            <option value="booking" {{ request('status') == 'booking' ? 'selected' : '' }}>Booking</option>
                                            <option value="sold" {{ request('status') == 'sold' ? 'selected' : '' }}>Terjual</option>
                                        </select>
                                    </div>
                                    <div class="col-6 mb-2">
                                        <select class="form-select" name="per_page" id="showSelectMobile" onchange="document.getElementById('filterForm').submit()" style="height: 38px;">
                                            <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10 data</option>
                                            <option value="25" {{ request('per_page', 25) == 25 ? 'selected' : '' }}>25 data</option>
                                            <option value="50" {{ request('per_page', 50) == 50 ? 'selected' : '' }}>50 data</option>
                                            <option value="100" {{ request('per_page', 100) == 100 ? 'selected' : '' }}>100 data</option>
                                        </select>
                                    </div>
                                    <div class="col-6">
                                        <button type="submit" class="btn btn-gradient-primary w-100" style="height: 38px;" title="Filter">
                                            <i class="mdi mdi-filter"></i> Filter
                                        </button>
                                    </div>
                                    <div class="col-6">
                                        <a href="{{ route('kavling.index') }}" class="btn btn-gradient-secondary w-100 d-inline-flex align-items-center justify-content-center" style="height: 38px;" title="Reset" onclick="showResetLoading(event)">
                                            <i class="mdi mdi-refresh"></i> Reset
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Table Responsive -->
                    <div class="table-responsive">
                        <table class="table table-lahan table-hover align-middle mb-0">
                            <thead>
                                <tr>
                                    <th class="col-no text-center">NO</th>
                                    <th class="sortable {{ request('sort') == 'name' ? 'active-sort' : '' }}" data-field="name" data-direction="{{ request('sort') == 'name' ? (request('direction') == 'asc' ? 'desc' : 'asc') : 'asc' }}">
                                        NAMA PROPERTI
                                        @if(request('sort') == 'name')
                                            <i class="mdi mdi-{{ request('direction') == 'asc' ? 'arrow-up' : 'arrow-down' }}"></i>
                                        @else
                                            <i class="mdi mdi-swap-vertical text-muted"></i>
                                        @endif
                                    </th>
                                    <th class="no-sort">LOKASI</th>
                                    <th class="sortable {{ request('sort') == 'acquisition_price' ? 'active-sort' : '' }}" data-field="acquisition_price" data-direction="{{ request('sort') == 'acquisition_price' ? (request('direction') == 'asc' ? 'desc' : 'asc') : 'asc' }}">
                                        HARGA
                                        @if(request('sort') == 'acquisition_price')
                                            <i class="mdi mdi-{{ request('direction') == 'asc' ? 'arrow-up' : 'arrow-down' }}"></i>
                                        @else
                                            <i class="mdi mdi-swap-vertical text-muted"></i>
                                        @endif
                                    </th>
                                    <th class="sortable {{ request('sort') == 'area' ? 'active-sort' : '' }}" data-field="area" data-direction="{{ request('sort') == 'area' ? (request('direction') == 'asc' ? 'desc' : 'asc') : 'asc' }}">
                                        LUAS TANAH
                                        @if(request('sort') == 'area')
                                            <i class="mdi mdi-{{ request('direction') == 'asc' ? 'arrow-up' : 'arrow-down' }}"></i>
                                        @else
                                            <i class="mdi mdi-swap-vertical text-muted"></i>
                                        @endif
                                    </th>
                                    <th class="no-sort">SISA TANAH</th>
                                    <th class="no-sort text-center">PENGOLAHAN LAHAN</th>
                                    <th class="sortable text-center {{ request('sort') == 'status' ? 'active-sort' : '' }}" data-field="status" data-direction="{{ request('sort') == 'status' ? (request('direction') == 'asc' ? 'desc' : 'asc') : 'asc' }}">
                                        STATUS
                                        @if(request('sort') == 'status')
                                            <i class="mdi mdi-{{ request('direction') == 'asc' ? 'arrow-up' : 'arrow-down' }}"></i>
                                        @else
                                            <i class="mdi mdi-swap-vertical text-muted"></i>
                                        @endif
                                    </th>
                                    <th class="col-aksi text-center">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($lands as $index => $land)
                                    @php
                                        $totalUnitArea = $land->units->sum('area');
                                        $remainingArea = ($land->area ?? 0) - $totalUnitArea;
                                        $canCreateKavling = $land->canCreateKavling();
                                        $devProgress = $land->overall_infrastructure_progress;
                                        $searchKeywords = strtolower(($land->name ?? '') . ' ' . ($land->address ?? ''));
                                    @endphp
                                    <tr class="project-table-row" data-search="{{ $searchKeywords }}">
                                        <td class="col-no text-center fw-bold text-muted">{{ $index + $lands->firstItem() }}</td>

                                        <td>
                                            <div class="d-flex align-items-center">
                                                <i class="mdi mdi-home-city text-primary me-2" style="font-size: 1.15rem;"></i>
                                                <span class="fw-bold text-dark" style="font-size: 0.88rem;">{{ $land->name ?? '-' }}</span>
                                            </div>
                                        </td>

                                        <td>
                                            <span class="d-inline-flex align-items-center gap-1 text-muted" title="{{ $land->address ?? '-' }}">
                                                <i class="mdi mdi-map-marker text-danger"></i>
                                                <span>{{ Str::limit($land->address ?? '-', 24) }}</span>
                                            </span>
                                        </td>

                                        <td class="fw-bold text-success">
                                            Rp {{ number_format($land->grand_total_acquisition_price, 0, ',', '.') }}
                                        </td>

                                        <td class="fw-semibold text-dark">{{ number_format($land->area ?? 0, 0, ',', '.') }} m²</td>
                                        <td class="fw-semibold text-secondary">{{ number_format($remainingArea, 0, ',', '.') }} m²</td>

                                        <td class="text-center">
                                            @if($canCreateKavling)
                                                <span class="badge bg-success text-white py-1 px-2.5 rounded-pill" style="font-size: 0.74rem;">
                                                    <i class="mdi mdi-check-circle me-1"></i>Selesai (100%)
                                                </span>
                                            @else
                                                <span class="badge bg-warning text-dark py-1 px-2.5 rounded-pill" style="font-size: 0.74rem;">
                                                    <i class="mdi mdi-progress-wrench me-1"></i>{{ $land->development_status ?? 'Proses' }} ({{ $devProgress }}%)
                                                </span>
                                            @endif
                                        </td>

                                        <td class="text-center">
                                            @if ($land->status == 'sold')
                                                <span class="badge-status sold">
                                                    <i class="mdi mdi-close-circle-outline me-1"></i>Terjual
                                                </span>
                                            @elseif($land->status == 'booking')
                                                <span class="badge-status booking">
                                                    <i class="mdi mdi-calendar-clock me-1"></i>Booking
                                                </span>
                                            @elseif(!$canCreateKavling)
                                                <span class="badge-status processing">
                                                    <i class="mdi mdi-progress-wrench me-1"></i>Dalam Pengolahan
                                                </span>
                                            @else
                                                <span class="badge-status available">
                                                    <i class="mdi mdi-check-circle-outline me-1"></i>Tersedia
                                                </span>
                                            @endif
                                        </td>

                                        <td class="col-aksi text-center">
                                            @if($canCreateKavling)
                                                <a href="{{ route('properti.buatKavling', ['land_bank_id' => $land->id]) }}"
                                                   class="btn-action create"
                                                   data-bs-toggle="tooltip"
                                                   title="Buat Unit Kavling">
                                                    <i class="mdi mdi-pencil-ruler"></i>
                                                </a>
                                            @else
                                                <button type="button"
                                                        class="btn-action locked"
                                                        onclick="showLockedKavlingAlert('{{ addslashes($land->name) }}', '{{ $land->id }}', '{{ $land->development_status }}', '{{ $devProgress }}')"
                                                        data-bs-toggle="tooltip"
                                                        title="Pengolahan lahan belum selesai (Terkunci - Klik info)">
                                                    <i class="mdi mdi-lock"></i>
                                                </button>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center text-muted py-4">
                                            <i class="mdi mdi-information-outline me-2"></i> Tidak ada data tanah / landbank terverifikasi
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- PAGINATION FOOTER -->
                    @if ($lands instanceof \Illuminate\Pagination\LengthAwarePaginator && $lands->total() > 0)
                        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center p-3 border-top bg-white">
                            <div class="pagination-info mb-2 mb-sm-0 text-muted" style="font-size: 0.84rem;">
                                Menampilkan {{ $lands->firstItem() ?? 0 }} - {{ $lands->lastItem() ?? 0 }} dari {{ $lands->total() }} data
                            </div>
                            <div>
                                {{ $lands->appends(request()->query())->links('pagination::bootstrap-5') }}
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    document.querySelectorAll('.sortable').forEach(item => {
        item.addEventListener('click', function() {
            let field = this.getAttribute('data-field');
            let direction = this.getAttribute('data-direction');

            Swal.fire({
                title: 'Memuat...',
                html: 'Sedang mengurutkan data',
                allowOutsideClick: false,
                didOpen: () => Swal.showLoading()
            });

            let url = new URL(window.location.href);
            url.searchParams.set('sort', field);
            url.searchParams.set('direction', direction);
            url.searchParams.set('page', 1);

            window.location.href = url.toString();
        });
    });
});

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

function showFilterLoading() {
    Swal.fire({
        title: 'Memuat...',
        html: 'Sedang memfilter data',
        allowOutsideClick: false,
        didOpen: () => Swal.showLoading()
    });
    return true;
}

function showResetLoading(event) {
    event.preventDefault();
    Swal.fire({
        title: 'Memuat...',
        html: 'Sedang mereset filter',
        allowOutsideClick: false,
        didOpen: () => Swal.showLoading()
    });
    window.location.href = event.currentTarget.href;
}

function showPaginationLoading(event) {
    if (event.currentTarget.parentElement.classList.contains('disabled')) return;
    event.preventDefault();
    Swal.fire({
        title: 'Memuat...',
        html: 'Sedang memuat halaman',
        allowOutsideClick: false,
        didOpen: () => Swal.showLoading()
    });
    window.location.href = event.currentTarget.href;
}

function showLockedKavlingAlert(landName, landId, status, progress) {
    Swal.fire({
        icon: 'warning',
        title: 'Pengolahan Lahan Belum Selesai',
        html: `<div class="text-start">
            <p>Proyek <strong>${landName}</strong> belum dapat dibuatkan unit kavling karena proses <strong>pengolahan lahan & pembangunan infrastruktur</strong> (PJU, Selokan, Jalan, dll) masih belum selesai.</p>
            <div class="p-3 bg-light rounded border mb-3">
                <div class="d-flex justify-content-between mb-1 small">
                    <span class="text-muted">Status Pembangunan:</span>
                    <span class="badge bg-warning text-dark">${status || 'Proses'}</span>
                </div>
                <div class="d-flex justify-content-between mb-2 small">
                    <span class="text-muted">Progres Pekerjaan:</span>
                    <span class="fw-bold text-primary">${progress}%</span>
                </div>
                <div class="progress" style="height: 8px;">
                    <div class="progress-bar bg-warning" role="progressbar" style="width: ${progress}%"></div>
                </div>
            </div>
            <p class="small text-muted mb-0"><i class="mdi mdi-information-outline me-1"></i>Selesaikan seluruh item pekerjaan pengolahan lahan di menu <strong>Semua Tanah Pasca Land Bank</strong> hingga 100% untuk membuka fitur Buat Kavling.</p>
        </div>`,
        showCancelButton: true,
        confirmButtonColor: '#9a55ff',
        cancelButtonColor: '#6c757d',
        confirmButtonText: '<i class="mdi mdi-wrench me-1"></i> Kelola Pengolahan Lahan',
        cancelButtonText: 'Tutup'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = `/properti-pengolahan-lahan/${landId}`;
        }
    });
}
</script>
@endpush
