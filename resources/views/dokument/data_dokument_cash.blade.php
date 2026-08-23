@extends('layouts.partial.app')

@section('title', 'Data User Persiapan Pecah Legal - Property Management App')

@section('content')

<div class="container-fluid px-1 px-sm-2 px-md-3 py-2 py-md-3">

    <!-- Header Halaman (Tanpa Card Box) -->
    <div class="row mb-3 mb-md-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center px-1">
                <div>
                    <h3 class="text-dark mb-1 fw-bold">
                        <i class="mdi mdi-file-document-check-outline me-2" style="color: #9a55ff;"></i>Data User Persiapan Pecah Legal
                    </h3>
                    <p class="text-muted mb-0">Pengecekan kelengkapan dokumen legal persiapan pecah unit per booking</p>
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
                        <h3 class="text-dark mb-1 fw-bold">{{ $totalBooking }}</h3>
                        <p class="text-muted mb-0">Total Booking</p>
                    </div>
                    <div class="d-none d-sm-block">
                        <i class="mdi mdi-bookmark-multiple-outline" style="font-size: 2.5rem; color: #9a55ff; opacity: 0.2;"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-6 col-md-3">
            <div class="card shadow-sm border-0 h-100 mb-0">
                <div class="card-body d-flex justify-content-between align-items-center p-3">
                    <div>
                        <h3 class="text-dark mb-1 fw-bold">{{ $lengkap }}</h3>
                        <p class="text-muted mb-0">Dokumen Lengkap</p>
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
                        <h3 class="text-dark mb-1 fw-bold">{{ $kurang }}</h3>
                        <p class="text-muted mb-0">Dokumen Kurang</p>
                    </div>
                    <div class="d-none d-sm-block">
                        <i class="mdi mdi-alert-circle-outline" style="font-size: 2.5rem; color: #ffc107; opacity: 0.2;"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-6 col-md-3">
            <div class="card shadow-sm border-0 h-100 mb-0">
                <div class="card-body d-flex justify-content-between align-items-center p-3">
                    <div>
                        <h3 class="text-dark mb-1 fw-bold">{{ $revisi }}</h3>
                        <p class="text-muted mb-0">Perlu Revisi</p>
                    </div>
                    <div class="d-none d-sm-block">
                        <i class="mdi mdi-file-refresh-outline" style="font-size: 2.5rem; color: #dc3545; opacity: 0.2;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Table & Filter Card -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white d-flex justify-content-between align-items-center gap-2 flex-wrap">
                    <h5 class="card-title mb-0">
                        <i class="mdi mdi-format-list-bulleted me-2"></i>Daftar Pengecekan Dokumen
                    </h5>
                </div>

                <div class="card-body">
                    <!-- Filter Section -->
                    <div class="filter-card mb-3">
                        <!-- Desktop Version -->
                        <div class="filter-row-desktop d-none d-md-block">
                            <form id="filterForm" method="GET" action="{{ route(Route::currentRouteName()) }}" onsubmit="return showFilterLoading()">
                                <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 w-100">
                                    <div class="d-flex flex-wrap align-items-center gap-2 flex-grow-1">
                                        <!-- Search -->
                                        <div style="min-width: 200px; max-width: 260px; flex: 1;">
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="search" id="searchInput"
                                                    placeholder="Cari Customer / ID..."
                                                    value="{{ request('search') }}"
                                                    style="border-top-right-radius: 0 !important; border-bottom-right-radius: 0 !important; border-right: none;">
                                                <button class="btn btn-gradient-primary d-flex align-items-center justify-content-center px-3" 
                                                    type="submit" title="Cari"
                                                    style="border-top-left-radius: 0 !important; border-bottom-left-radius: 0 !important; border-top-right-radius: 4px !important; border-bottom-right-radius: 4px !important; height: 38px; box-shadow: none;">
                                                    <i class="mdi mdi-magnify" style="font-size: 1.15rem; color: #ffffff;"></i>
                                                </button>
                                            </div>
                                        </div>

                                        <!-- Kelengkapan -->
                                        <div style="width: 155px;">
                                            <select class="form-control" name="kelengkapan" id="kelengkapanSelect">
                                                <option value="">Semua Dokumen</option>
                                                <option value="lengkap" {{ request('kelengkapan') == 'lengkap' ? 'selected' : '' }}>Lengkap</option>
                                                <option value="belum_lengkap" {{ request('kelengkapan') == 'belum_lengkap' ? 'selected' : '' }}>Belum Lengkap</option>
                                            </select>
                                        </div>

                                        <!-- Status -->
                                        <div style="width: 165px;">
                                            <select class="form-control" name="status" id="statusSelect">
                                                <option value="">Semua Status</option>
                                                <option value="siap_pecah" {{ request('status') == 'siap_pecah' ? 'selected' : '' }}>Siap Pecah Legal</option>
                                                <option value="revisi" {{ request('status') == 'revisi' ? 'selected' : '' }}>Perlu Revisi</option>
                                            </select>
                                        </div>

                                        <!-- Jenis -->
                                        <div style="width: 140px;">
                                            <select class="form-control" name="jenis" id="jenisSelect">
                                                <option value="">Semua Jenis</option>
                                                <option value="komersil" {{ request('jenis') == 'komersil' ? 'selected' : '' }}>Komersil</option>
                                                <option value="subsidi" {{ request('jenis') == 'subsidi' ? 'selected' : '' }}>Subsidi</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Right Limit & Action Buttons -->
                                    <div class="d-flex align-items-center gap-2 ms-auto">
                                        <div style="width: 110px;">
                                            <select class="form-control" name="per_page" id="perPageSelect">
                                                <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10 data</option>
                                                <option value="15" {{ request('per_page') == 15 ? 'selected' : '' }}>15 data</option>
                                                <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25 data</option>
                                                <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50 data</option>
                                            </select>
                                        </div>

                                        <button type="submit" class="btn btn-gradient-primary btn-icon-only" title="Filter">
                                            <i class="mdi mdi-filter"></i>
                                        </button>
                                        <a href="{{ request()->url() }}" class="btn btn-gradient-secondary btn-icon-only" title="Reset" onclick="showResetLoading(event)">
                                            <i class="mdi mdi-refresh"></i>
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <!-- Mobile Version -->
                        <div class="filter-row-mobile d-block d-md-none">
                            <form method="GET" action="{{ route(Route::currentRouteName()) }}" onsubmit="return showFilterLoading()">
                                <div class="row g-2">
                                    <div class="col-12 mb-2">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="search" id="searchInputMobile"
                                                placeholder="Cari Customer / ID..."
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
                                        <select class="form-control" name="kelengkapan">
                                            <option value="">Semua Dokumen</option>
                                            <option value="lengkap" {{ request('kelengkapan') == 'lengkap' ? 'selected' : '' }}>Lengkap</option>
                                            <option value="belum_lengkap" {{ request('kelengkapan') == 'belum_lengkap' ? 'selected' : '' }}>Belum Lengkap</option>
                                        </select>
                                    </div>

                                    <div class="col-12 mb-2">
                                        <select class="form-control" name="status">
                                            <option value="">Semua Status</option>
                                            <option value="siap_pecah" {{ request('status') == 'siap_pecah' ? 'selected' : '' }}>Siap Pecah Legal</option>
                                            <option value="revisi" {{ request('status') == 'revisi' ? 'selected' : '' }}>Perlu Revisi</option>
                                        </select>
                                    </div>

                                    <div class="col-12 mb-2">
                                        <select class="form-control" name="jenis">
                                            <option value="">Semua Jenis</option>
                                            <option value="komersil" {{ request('jenis') == 'komersil' ? 'selected' : '' }}>Komersil</option>
                                            <option value="subsidi" {{ request('jenis') == 'subsidi' ? 'selected' : '' }}>Subsidi</option>
                                        </select>
                                    </div>

                                    <div class="col-12 mb-2">
                                        <select class="form-control" name="per_page">
                                            <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10 data</option>
                                            <option value="15" {{ request('per_page') == 15 ? 'selected' : '' }}>15 data</option>
                                            <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25 data</option>
                                            <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50 data</option>
                                        </select>
                                    </div>

                                    <div class="col-6">
                                        <button type="submit" class="btn btn-gradient-primary w-100 d-flex align-items-center justify-content-center gap-1">
                                            <i class="mdi mdi-filter"></i> Filter
                                        </button>
                                    </div>

                                    <div class="col-6">
                                        <a href="{{ request()->url() }}" class="btn btn-gradient-secondary w-100 d-flex align-items-center justify-content-center gap-1" onclick="showResetLoading(event)">
                                            <i class="mdi mdi-refresh"></i> Reset
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Data Table -->
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="sortable" data-field="booking_code" data-direction="{{ request('sortField') == 'booking_code' ? (request('sortDirection') == 'asc' ? 'desc' : 'asc') : 'asc' }}">
                                        ID Booking
                                        @if (request('sortField') == 'booking_code')
                                            <i class="mdi mdi-{{ request('sortDirection') == 'asc' ? 'arrow-up' : 'arrow-down' }}"></i>
                                        @else
                                            <i class="mdi mdi-swap-vertical"></i>
                                        @endif
                                    </th>
                                    <th class="sortable" data-field="name" data-direction="{{ request('sortField') == 'name' ? (request('sortDirection') == 'asc' ? 'desc' : 'asc') : 'asc' }}">
                                        Nama Customer
                                        @if (request('sortField') == 'name')
                                            <i class="mdi mdi-{{ request('sortDirection') == 'asc' ? 'arrow-up' : 'arrow-down' }}"></i>
                                        @else
                                            <i class="mdi mdi-swap-vertical"></i>
                                        @endif
                                    </th>
                                    <th class="sortable" data-field="unit" data-direction="{{ request('sortField') == 'unit' ? (request('sortDirection') == 'asc' ? 'desc' : 'asc') : 'asc' }}">
                                        Unit Properti
                                        @if (request('sortField') == 'unit')
                                            <i class="mdi mdi-{{ request('sortDirection') == 'asc' ? 'arrow-up' : 'arrow-down' }}"></i>
                                        @else
                                            <i class="mdi mdi-swap-vertical"></i>
                                        @endif
                                    </th>
                                    <th>Jenis - Tipe</th>
                                    <th>Kelengkapan</th>
                                    <th>Status</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($bookings as $booking)
                                    @php
                                        $requiredDocs = $documents->where('required', true)->count();
                                        $uploadedDocs = $booking->documentUploads
                                            ->whereIn('document_id', $documents->where('required', true)->pluck('id'))
                                            ->count();

                                        $isLengkap = $uploadedDocs >= $requiredDocs && $requiredDocs > 0;

                                        $customerName = $booking->customer->full_name ?? '-';
                                        $nameParts = explode(' ', trim($customerName));
                                        $initials = strtoupper(substr($nameParts[0] ?? '', 0, 1) . substr($nameParts[1] ?? '', 0, 1));
                                        if (trim($initials) == '') {
                                            $initials = 'CU';
                                        }

                                        $jenisUnit = strtolower(trim($booking->unit->jenis ?? ''));
                                        $modalId = 'detailDokumenModal' . $booking->id;
                                    @endphp
                                    <tr>
                                        <td class="text-center fw-bold">
                                            {{ method_exists($bookings, 'firstItem') ? $bookings->firstItem() + $loop->index : $loop->iteration }}
                                        </td>
                                        <td>
                                            <div class="info-inline">
                                                <span class="info-icon">
                                                    <i class="mdi mdi-bookmark-outline"></i>
                                                </span>
                                                <span class="fw-bold text-primary">{{ $booking->booking_code }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="info-inline">
                                                <span class="initial-avatar">{{ $initials }}</span>
                                                <span class="fw-bold">{{ $customerName }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="info-inline align-items-start">
                                                <span class="info-icon mt-1">
                                                    <i class="mdi mdi-home-city-outline"></i>
                                                </span>
                                                <div>
                                                    <span class="fw-bold d-block">{{ $booking->unit->unit_name ?? '-' }}</span>
                                                    <small class="text-muted">{{ $booking->unit->block ?? '' }} {{ $booking->unit->unit_number ?? '' }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge-category">
                                                <i class="mdi mdi-shape-outline"></i>
                                                {{ ucfirst($booking->unit->jenis ?? 'Unit') }} - {{ $booking->unit->type ?? '-' }}
                                            </span>
                                        </td>
                                        <td>
                                            @if ($isLengkap)
                                                <span class="badge-status available">
                                                    <i class="mdi mdi-check-circle me-1"></i>Lengkap
                                                </span>
                                            @else
                                                <span class="badge-status booking">
                                                    <i class="mdi mdi-alert-circle-outline me-1"></i>{{ $uploadedDocs }}/{{ $requiredDocs }} Kurang
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($isLengkap)
                                                <span class="badge-status available">
                                                    <i class="mdi mdi-check-decagram-outline me-1"></i>Siap Pecah Legal
                                                </span>
                                            @else
                                                <span class="badge bg-light text-muted fw-semibold px-2 py-1 border" style="font-size: 0.78rem;">
                                                    <i class="mdi mdi-timer-sand me-1"></i>Pending
                                                </span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <div class="d-inline-flex align-items-center gap-1">
                                                <!-- Detail View Modal Button -->
                                                <button type="button" class="btn-action fase2"
                                                    title="Lihat Detail Dokumen" data-bs-toggle="modal"
                                                    data-bs-target="#{{ $modalId }}">
                                                    <i class="mdi mdi-eye-outline"></i>
                                                </button>

                                                @if ($isLengkap)
                                                    @if (strtolower($booking->purchase_type) == 'kpr')
                                                        <a href="{{ route('kpr.approve', $booking->id) }}"
                                                            class="btn-action edit"
                                                            title="Proses Persetujuan KPR">
                                                            <i class="mdi mdi-clipboard-check"></i>
                                                        </a>
                                                    @elseif(in_array(strtolower($booking->purchase_type), ['cash', 'cash_tempo']))
                                                        <a href="{{ route('akad.cash', $booking->id) }}"
                                                            class="btn-action fase1" title="Proses Akad Cash">
                                                            <i class="mdi mdi-file-sign"></i>
                                                        </a>
                                                    @endif
                                                @else
                                                    <button class="btn-action" disabled style="opacity: 0.4; cursor: not-allowed; background: #e9ecef; color: #6c7383;"
                                                        title="Dokumen belum lengkap">
                                                        <i class="mdi mdi-file-sign"></i>
                                                    </button>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center text-muted py-4">
                                            <i class="mdi mdi-information-outline me-2"></i>Tidak ada data booking ditemukan.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if ($bookings instanceof \Illuminate\Pagination\LengthAwarePaginator && $bookings->total() > 0)
                        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mt-4">
                            <div class="pagination-info mb-2 mb-sm-0 text-muted" style="font-size: 0.82rem;">
                                Menampilkan {{ $bookings->firstItem() }} - {{ $bookings->lastItem() }} dari {{ $bookings->total() }} data
                            </div>
                            <nav aria-label="Page navigation">
                                <ul class="pagination pagination-sm flex-wrap justify-content-center mb-0">
                                    <li class="page-item {{ $bookings->onFirstPage() ? 'disabled' : '' }}">
                                        <a class="page-link" href="{{ $bookings->previousPageUrl() }}" {{ !$bookings->onFirstPage() ? 'onclick=showPaginationLoading(event)' : '' }}>
                                            <i class="mdi mdi-chevron-left"></i>
                                        </a>
                                    </li>

                                    @for($page = 1; $page <= $bookings->lastPage(); $page++)
                                        <li class="page-item {{ $page == $bookings->currentPage() ? 'active' : '' }}">
                                            @if($page == $bookings->currentPage())
                                                <span class="page-link">{{ $page }}</span>
                                            @else
                                                <a class="page-link" href="{{ $bookings->appends(request()->query())->url($page) }}" onclick="showPaginationLoading(event)">{{ $page }}</a>
                                            @endif
                                        </li>
                                    @endfor

                                    <li class="page-item {{ $bookings->hasMorePages() ? '' : 'disabled' }}">
                                        <a class="page-link" href="{{ $bookings->nextPageUrl() }}" {{ $bookings->hasMorePages() ? 'onclick=showPaginationLoading(event)' : '' }}>
                                            <i class="mdi mdi-chevron-right"></i>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>

</div>

<!-- Modal Detail Dokumen Per Booking -->
@foreach ($bookings as $booking)
    @php
        $requiredDocs = $documents->where('required', true)->count();
        $uploadedDocs = $booking->documentUploads
            ->whereIn('document_id', $documents->where('required', true)->pluck('id'))
            ->count();

        $isLengkap = $uploadedDocs >= $requiredDocs && $requiredDocs > 0;
        $customerName = $booking->customer->full_name ?? '-';
        $unitName = $booking->unit->unit_name ?? '-';
        $modalId = 'detailDokumenModal' . $booking->id;
        $statusText = $isLengkap ? 'Siap Pecah Legal Unit' : 'Pending';
    @endphp

    <div class="modal fade" id="{{ $modalId }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header bg-white border-bottom">
                    <h5 class="modal-title fw-bold" style="color: #2c2e3f;">
                        <i class="mdi mdi-file-document-outline me-2" style="color: #9a55ff;"></i>Detail Dokumen Booking
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body p-4">
                    <!-- Detail Summary Box -->
                    <div class="row g-3 mb-4">
                        <div class="col-6 col-md-3">
                            <div class="detail-box">
                                <div class="detail-label">ID Booking</div>
                                <div class="detail-value text-primary">{{ $booking->booking_code }}</div>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="detail-box">
                                <div class="detail-label">Nama Customer</div>
                                <div class="detail-value">{{ $customerName }}</div>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="detail-box">
                                <div class="detail-label">Unit Properti</div>
                                <div class="detail-value">{{ $unitName }}</div>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="detail-box">
                                <div class="detail-label">Status Legal</div>
                                <div class="detail-value {{ $isLengkap ? 'text-success' : 'text-warning' }}">{{ $statusText }}</div>
                            </div>
                        </div>
                    </div>

                    <!-- Document Table -->
                    <div class="card shadow-sm border-0 mb-0">
                        <div class="card-header bg-light d-flex justify-content-between align-items-center">
                            <h6 class="mb-0 fw-bold" style="color: #9a55ff;">
                                <i class="mdi mdi-clipboard-text-outline me-2"></i>Daftar Dokumen Persyaratan
                            </h6>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-center" style="width: 50px;">No</th>
                                            <th>Nama Dokumen</th>
                                            <th class="text-end">Aksi Upload / File</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $bookingUploads = $booking->documentUploads->keyBy('document_id');
                                        @endphp

                                        @forelse ($documents as $doc)
                                            @php
                                                $uploadedFile = $bookingUploads->get($doc->id);
                                            @endphp
                                            <tr>
                                                <td class="text-center fw-bold">{{ $loop->iteration }}</td>
                                                <td>
                                                    <div class="d-flex align-items-center gap-2">
                                                        <span class="doc-file-icon">
                                                            <i class="mdi mdi-file-document-outline"></i>
                                                        </span>
                                                        <div>
                                                            <span class="fw-bold d-block">{{ $doc->name }}</span>
                                                            @if($doc->required)
                                                                <small class="text-danger"><i class="mdi mdi-asterisk" style="font-size: 0.65rem;"></i> Wajib</small>
                                                            @else
                                                                <small class="text-muted">Opsional</small>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-end">
                                                    @if ($uploadedFile && !empty($uploadedFile->file_path))
                                                        <a href="{{ asset('storage/' . $uploadedFile->file_path) }}"
                                                            target="_blank" class="btn-action-outline-purple">
                                                            <i class="mdi mdi-eye-outline me-1"></i>Lihat File
                                                        </a>
                                                    @else
                                                        <div class="d-flex flex-column gap-1 text-end">
                                                            <form action="{{ route('document.upload') }}" 
                                                                method="POST" 
                                                                enctype="multipart/form-data">
                                                                @csrf
                                                                <input type="hidden" name="booking_id" value="{{ $booking->id }}">
                                                                <input type="hidden" name="document_id" value="{{ $doc->id }}">

                                                                <div class="d-flex align-items-center justify-content-end gap-2">
                                                                    <div class="pratanah-file-upload-modern text-start" style="width: 220px;">
                                                                        <input type="file" name="file" accept=".pdf,.jpg,.jpeg,.png" required>
                                                                        <div class="pratanah-file-label-modern">
                                                                            <i class="mdi mdi-cloud-upload-outline"></i>
                                                                            <div class="pratanah-file-info-modern">
                                                                                <span>Pilih File</span>
                                                                                <small>PDF / JPG / PNG</small>
                                                                            </div>
                                                                            <span class="pratanah-file-size" style="display: none;"></span>
                                                                        </div>
                                                                    </div>

                                                                    <button type="submit" class="btn btn-sm btn-gradient-primary d-flex align-items-center">
                                                                        <i class="mdi mdi-upload me-1"></i> Upload
                                                                    </button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3" class="text-center text-muted py-4">
                                                    Belum ada dokumen yang bisa ditampilkan
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer bg-light border-top">
                    <button type="button" class="btn btn-secondary btn-sm px-3" data-bs-dismiss="modal">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>
@endforeach

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Modern file upload preview
    document.querySelectorAll('.pratanah-file-upload-modern input[type="file"]').forEach(input => {
        input.addEventListener('change', function(e) {
            const fileName = e.target.files[0]?.name;
            const fileSize = e.target.files[0]?.size;
            const label = this.closest('.pratanah-file-upload-modern').querySelector('.pratanah-file-info-modern span');
            const sizeSpan = this.closest('.pratanah-file-upload-modern').querySelector('.pratanah-file-size');

            if (fileName) {
                label.textContent = fileName.length > 25 ? fileName.substring(0, 25) + '...' : fileName;
                if (fileSize) {
                    const sizeInMB = (fileSize / (1024 * 1024)).toFixed(2);
                    sizeSpan.textContent = sizeInMB + ' MB';
                    sizeSpan.style.display = 'inline-block';
                }
            } else {
                label.textContent = 'Pilih File';
                sizeSpan.textContent = '';
                sizeSpan.style.display = 'none';
            }
        });
    });
});

$(document).ready(function() {
    // Sorting functionality
    $('.sortable').click(function() {
        let field = $(this).data('field');
        let direction = $(this).data('direction');

        Swal.fire({
            title: 'Memuat...',
            html: 'Sedang mengurutkan data',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        let url = new URL(window.location.href);
        url.searchParams.set('sortField', field);
        url.searchParams.set('sortDirection', direction);
        url.searchParams.set('page', 1);

        window.location.href = url.toString();
    });

    @if (session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session('success') }}',
            timer: 3000,
            showConfirmButton: true,
            confirmButtonText: 'OK',
            confirmButtonColor: '#9a55ff',
            timerProgressBar: true
        });
    @endif

    @if (session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: '{{ session('error') }}',
            confirmButtonColor: '#dc3545'
        });
    @endif
});

function showFilterLoading() {
    Swal.fire({
        title: 'Memuat...',
        html: 'Sedang memfilter data',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });
    return true;
}

function showResetLoading(event) {
    event.preventDefault();
    Swal.fire({
        title: 'Memuat...',
        html: 'Mengembalikan data awal',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });
    window.location.href = event.currentTarget.href;
}

function showPaginationLoading(event) {
    if (event.currentTarget.parentElement.classList.contains('disabled')) return;
    event.preventDefault();
    Swal.fire({
        title: 'Memuat...',
        html: 'Berpindah halaman',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });
    window.location.href = event.currentTarget.href;
}
</script>
@endpush
