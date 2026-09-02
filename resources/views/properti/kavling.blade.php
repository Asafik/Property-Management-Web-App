@extends('layouts.partial.app')

@section('title', 'Tambah Kavling - Property Management App')

@section('content')

    <style>
        .badge-status {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 0.35rem 0.75rem;
            border-radius: 30px;
            font-size: 0.78rem;
            font-weight: 600;
            line-height: 1.2;
        }

        .badge-status.available {
            background: rgba(40, 167, 69, 0.12);
            color: #28a745;
            border: 1px solid rgba(40, 167, 69, 0.25);
        }

        .badge-status.booking {
            background: rgba(255, 193, 7, 0.12);
            color: #e67e22;
            border: 1px solid rgba(255, 193, 7, 0.25);
        }

        .badge-status.processing {
            background: rgba(255, 193, 7, 0.15);
            color: #d97706;
            border: 1px solid rgba(255, 193, 7, 0.35);
        }

        .badge-status.sold {
            background: rgba(220, 53, 69, 0.12);
            color: #dc3545;
            border: 1px solid rgba(220, 53, 69, 0.25);
        }

        .badge-category {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 0.35rem 0.75rem;
            border-radius: 30px;
            font-size: 0.78rem;
            font-weight: 600;
            background: linear-gradient(135deg, rgba(154, 85, 255, 0.12), rgba(218, 140, 255, 0.12));
            color: #9a55ff;
            border: 1px solid rgba(154, 85, 255, 0.25);
        }

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
    </style>

    <div class="container-fluid px-1 px-sm-2 px-md-3 py-2 py-md-3">

    <!-- Header Card Banner -->
    <div class="row mb-3 mb-md-4">
        <div class="col-12">
            <div class="card shadow-sm border-0 header-card">
                <div class="card-body p-4 p-md-4 py-4 py-md-4 d-flex justify-content-between align-items-center" style="min-height: 105px;">
                    <div>
                        <h3 class="text-dark mb-1 fw-bold" style="font-size: 1.35rem;">
                            Tambah Kavling
                        </h3>
                        <p class="text-muted mb-0" style="font-size: 0.9rem;">
                            Daftar tanah / landbank terverifikasi untuk pembuatan dan pemecahan unit kavling
                        </p>
                    </div>
                    <div class="d-none d-sm-block pe-2">
                        <i class="mdi mdi-vector-arrange-below" style="font-size: 3rem; color: #9a55ff; opacity: 0.25;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-2 mt-sm-2 mt-md-3">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white d-flex flex-wrap flex-md-row justify-content-between align-items-center gap-2">
                    <h5 class="card-title mb-0">
                        <i class="mdi mdi-format-list-bulleted me-2"></i>Daftar Tanah / LandBank Terverifikasi
                    </h5>
                </div>

                <div class="card-body">
                    <!-- Filter Section -->
                    <div class="filter-card mb-3">
                        <!-- Desktop Filter -->
                        <div class="filter-row-desktop d-none d-md-block">
                            <form method="GET" action="{{ route('kavling.index') }}" onsubmit="return showFilterLoading()">
                                <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 w-100">
                                    <div class="d-flex flex-wrap align-items-center gap-2 flex-grow-1">
                                        <div style="min-width: 220px; max-width: 280px; flex: 1;">
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="search" id="searchInput"
                                                    placeholder="Cari nama properti / lokasi..."
                                                    value="{{ request('search') }}"
                                                    style="border-top-right-radius: 0 !important; border-bottom-right-radius: 0 !important; border-right: none;">
                                                <button class="btn btn-gradient-primary d-flex align-items-center justify-content-center px-3" 
                                                    type="submit" title="Cari"
                                                    style="border-top-left-radius: 0 !important; border-bottom-left-radius: 0 !important; border-top-right-radius: 4px !important; border-bottom-right-radius: 4px !important; height: 38px; box-shadow: none;">
                                                    <i class="mdi mdi-magnify" style="font-size: 1.15rem; color: #ffffff;"></i>
                                                </button>
                                            </div>
                                        </div>

                                        <div style="width: 170px;">
                                            <select class="form-control" name="type" id="categorySelect">
                                                <option value="">Semua Kategori</option>
                                                @foreach($types as $type)
                                                    <option value="{{ $type }}" {{ request('type') == $type ? 'selected' : '' }}>
                                                        {{ $type }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div style="width: 150px;">
                                            <select class="form-control" name="status" id="statusSelect">
                                                <option value="">Semua Status</option>
                                                <option value="sold" {{ request('status') == 'sold' ? 'selected' : '' }}>Terjual</option>
                                                <option value="booking" {{ request('status') == 'booking' ? 'selected' : '' }}>Booking</option>
                                                <option value="processing" {{ request('status') == 'processing' ? 'selected' : '' }}>Dalam Pengolahan</option>
                                                <option value="available" {{ request('status') == 'available' ? 'selected' : '' }}>Tersedia</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-center gap-2 ms-auto">
                                        <div style="width: 115px;">
                                            <select class="form-control" name="per_page" id="showSelect">
                                                <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10 data</option>
                                                <option value="25" {{ request('per_page', 25) == 25 ? 'selected' : '' }}>25 data</option>
                                                <option value="50" {{ request('per_page', 50) == 50 ? 'selected' : '' }}>50 data</option>
                                                <option value="100" {{ request('per_page', 100) == 100 ? 'selected' : '' }}>100 data</option>
                                            </select>
                                        </div>

                                        <button type="submit" class="btn btn-gradient-primary btn-icon-only" title="Filter">
                                            <i class="mdi mdi-filter"></i>
                                        </button>
                                        <a href="{{ route('kavling.index') }}" class="btn btn-gradient-secondary btn-icon-only" title="Reset" onclick="showResetLoading(event)">
                                            <i class="mdi mdi-refresh"></i>
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <!-- Mobile Filter -->
                        <div class="filter-row-mobile d-block d-md-none">
                            <form method="GET" action="{{ route('kavling.index') }}" onsubmit="return showFilterLoading()">
                                <div class="row g-2">
                                    <div class="col-12 mb-2">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="search" id="searchInputMobile"
                                                placeholder="Cari properti / lokasi..."
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
                                        <select class="form-control" name="type" id="categorySelectMobile">
                                            <option value="">Semua Kategori</option>
                                            @foreach($types as $type)
                                                <option value="{{ $type }}" {{ request('type') == $type ? 'selected' : '' }}>
                                                    {{ $type }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-6 mb-2">
                                        <select class="form-control" name="status" id="statusSelectMobile">
                                            <option value="">Semua Status</option>
                                            <option value="sold" {{ request('status') == 'sold' ? 'selected' : '' }}>Terjual</option>
                                            <option value="booking" {{ request('status') == 'booking' ? 'selected' : '' }}>Booking</option>
                                            <option value="processing" {{ request('status') == 'processing' ? 'selected' : '' }}>Dalam Pengolahan</option>
                                            <option value="available" {{ request('status') == 'available' ? 'selected' : '' }}>Tersedia</option>
                                        </select>
                                    </div>

                                    <div class="col-6 mb-2">
                                        <select class="form-control" name="per_page" id="showSelectMobile">
                                            <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10 data</option>
                                            <option value="25" {{ request('per_page', 25) == 25 ? 'selected' : '' }}>25 data</option>
                                            <option value="50" {{ request('per_page', 50) == 50 ? 'selected' : '' }}>50 data</option>
                                            <option value="100" {{ request('per_page', 100) == 100 ? 'selected' : '' }}>100 data</option>
                                        </select>
                                    </div>

                                    <div class="col-6">
                                        <button type="submit" class="btn btn-gradient-primary w-100 d-flex align-items-center justify-content-center gap-1">
                                            <i class="mdi mdi-filter"></i> Filter
                                        </button>
                                    </div>

                                    <div class="col-6">
                                        <a href="{{ route('kavling.index') }}" class="btn btn-gradient-secondary w-100 d-flex align-items-center justify-content-center gap-1" onclick="showResetLoading(event)">
                                            <i class="mdi mdi-refresh"></i> Reset
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="sortable {{ request('sort') == 'name' ? 'active-sort' : '' }}" data-field="name" data-direction="{{ request('sort') == 'name' ? (request('direction') == 'asc' ? 'desc' : 'asc') : 'asc' }}">
                                        Nama Properti
                                        @if(request('sort') == 'name')
                                            <i class="mdi mdi-{{ request('direction') == 'asc' ? 'arrow-up' : 'arrow-down' }}"></i>
                                        @else
                                            <i class="mdi mdi-swap-vertical text-muted"></i>
                                        @endif
                                    </th>
                                    <th class="sortable {{ request('sort') == 'zoning' ? 'active-sort' : '' }}" data-field="zoning" data-direction="{{ request('sort') == 'zoning' ? (request('direction') == 'asc' ? 'desc' : 'asc') : 'asc' }}">
                                        Kategori
                                        @if(request('sort') == 'zoning')
                                            <i class="mdi mdi-{{ request('direction') == 'asc' ? 'arrow-up' : 'arrow-down' }}"></i>
                                        @else
                                            <i class="mdi mdi-swap-vertical text-muted"></i>
                                        @endif
                                    </th>
                                    <th class="no-sort">Lokasi</th>
                                    <th class="sortable {{ request('sort') == 'acquisition_price' ? 'active-sort' : '' }}" data-field="acquisition_price" data-direction="{{ request('sort') == 'acquisition_price' ? (request('direction') == 'asc' ? 'desc' : 'asc') : 'asc' }}">
                                        Harga
                                        @if(request('sort') == 'acquisition_price')
                                            <i class="mdi mdi-{{ request('direction') == 'asc' ? 'arrow-up' : 'arrow-down' }}"></i>
                                        @else
                                            <i class="mdi mdi-swap-vertical text-muted"></i>
                                        @endif
                                    </th>
                                    <th class="sortable {{ request('sort') == 'area' ? 'active-sort' : '' }}" data-field="area" data-direction="{{ request('sort') == 'area' ? (request('direction') == 'asc' ? 'desc' : 'asc') : 'asc' }}">
                                        Luas Tanah
                                        @if(request('sort') == 'area')
                                            <i class="mdi mdi-{{ request('direction') == 'asc' ? 'arrow-up' : 'arrow-down' }}"></i>
                                        @else
                                            <i class="mdi mdi-swap-vertical text-muted"></i>
                                        @endif
                                    </th>
                                    <th class="no-sort">Sisa Tanah</th>
                                    <th class="no-sort text-center">Pengolahan Lahan</th>
                                    <th class="sortable {{ request('sort') == 'status' ? 'active-sort' : '' }}" data-field="status" data-direction="{{ request('sort') == 'status' ? (request('direction') == 'asc' ? 'desc' : 'asc') : 'asc' }}">
                                        Status
                                        @if(request('sort') == 'status')
                                            <i class="mdi mdi-{{ request('direction') == 'asc' ? 'arrow-up' : 'arrow-down' }}"></i>
                                        @else
                                            <i class="mdi mdi-swap-vertical text-muted"></i>
                                        @endif
                                    </th>
                                    <th class="text-center action-cell">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($lands as $index => $land)
                                    @php
                                        $totalUnitArea = $land->units->sum('area');
                                        $remainingArea = ($land->area ?? 0) - $totalUnitArea;
                                        $canCreateKavling = $land->canCreateKavling();
                                        $devProgress = $land->overall_infrastructure_progress;
                                    @endphp
                                    <tr>
                                        <td class="text-center fw-bold">{{ $index + $lands->firstItem() }}</td>

                                        <td>
                                            <div class="d-flex align-items-center">
                                                <i class="mdi mdi-home-city text-primary me-2" style="font-size: 1.2rem;"></i>
                                                <span class="fw-bold">{{ $land->name ?? '-' }}</span>
                                            </div>
                                        </td>

                                        <td>
                                            <span class="badge-category">
                                                @if(($land->zoning ?? 'Tanah') == 'Rumah')
                                                    <i class="mdi mdi-home-city"></i>
                                                @elseif(($land->zoning ?? 'Tanah') == 'Apartemen')
                                                    <i class="mdi mdi-office-building"></i>
                                                @elseif(($land->zoning ?? 'Tanah') == 'Ruko')
                                                    <i class="mdi mdi-store"></i>
                                                @elseif(($land->zoning ?? 'Tanah') == 'Tanah')
                                                    <i class="mdi mdi-terrain"></i>
                                                @else
                                                    <i class="mdi mdi-shape-outline"></i>
                                                @endif
                                                {{ $land->zoning ?? 'Tanah' }}
                                            </span>
                                        </td>

                                        <td>
                                            <span class="d-inline-flex align-items-center gap-1" title="{{ $land->address ?? '-' }}">
                                                <i class="mdi mdi-map-marker text-danger"></i>
                                                <span>{{ Str::limit($land->address ?? '-', 22) }}</span>
                                            </span>
                                        </td>

                                        <td class="fw-bold text-success">
                                            Rp {{ number_format($land->grand_total_acquisition_price, 0, ',', '.') }}
                                        </td>

                                        <td>{{ number_format($land->area ?? 0, 0, ',', '.') }} m²</td>
                                        <td>{{ number_format($remainingArea, 0, ',', '.') }} m²</td>

                                        <td class="text-center">
                                            @if($canCreateKavling)
                                                <span class="badge bg-success text-white py-1 px-2 rounded-pill" style="font-size: 0.75rem;">
                                                    <i class="mdi mdi-check-circle me-1"></i>Selesai (100%)
                                                </span>
                                            @else
                                                <span class="badge bg-warning text-dark py-1 px-2 rounded-pill" style="font-size: 0.75rem;">
                                                    <i class="mdi mdi-progress-wrench me-1"></i>{{ $land->development_status }} ({{ $devProgress }}%)
                                                </span>
                                            @endif
                                        </td>

                                        <td>
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

                                        <td class="text-center">
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
                                        <td colspan="10" class="text-center text-muted py-4">
                                            <i class="mdi mdi-information-outline me-2"></i> Tidak ada data tanah / landbank terverifikasi
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mt-4">
                        <div class="pagination-info mb-2 mb-sm-0 text-muted" style="font-size: 0.82rem;">
                            Menampilkan {{ $lands->firstItem() ?? 0 }} - {{ $lands->lastItem() ?? 0 }} dari {{ $lands->total() }} data
                        </div>

                        <nav aria-label="Page navigation">
                            <ul class="pagination pagination-sm flex-wrap justify-content-center mb-0">
                                <li class="page-item {{ $lands->onFirstPage() ? 'disabled' : '' }}">
                                    <a class="page-link" href="{{ $lands->previousPageUrl() }}" {{ !$lands->onFirstPage() ? 'onclick=showPaginationLoading(event)' : '' }}>
                                        <i class="mdi mdi-chevron-left"></i>
                                    </a>
                                </li>

                                @for($page = 1; $page <= $lands->lastPage(); $page++)
                                    <li class="page-item {{ $page == $lands->currentPage() ? 'active' : '' }}">
                                        @if($page == $lands->currentPage())
                                            <span class="page-link">{{ $page }}</span>
                                        @else
                                            <a class="page-link" href="{{ $lands->appends(request()->query())->url($page) }}" onclick="showPaginationLoading(event)">{{ $page }}</a>
                                        @endif
                                    </li>
                                @endfor

                                <li class="page-item {{ $lands->hasMorePages() ? '' : 'disabled' }}">
                                    <a class="page-link" href="{{ $lands->nextPageUrl() }}" {{ $lands->hasMorePages() ? 'onclick=showPaginationLoading(event)' : '' }}>
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
                    <span class="badge bg-warning text-dark">${status}</span>
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
