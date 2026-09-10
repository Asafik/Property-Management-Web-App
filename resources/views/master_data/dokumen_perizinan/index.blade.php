@extends('layouts.partial.app')

@section('title', 'Master Dokumen Perizinan & Legalitas Properti - Property Management App')

@section('content')
<div class="container-fluid px-1 px-sm-2 px-md-3 py-2 py-md-3">

    <!-- Header Card Banner -->
    <div class="row mb-3 mb-md-4">
        <div class="col-12">
            <div class="card shadow-sm border-0 header-card" style="background: linear-gradient(135deg, #ffffff 0%, #fbf9ff 100%); border-left: 5px solid #9a55ff !important;">
                <div class="card-body p-4 p-md-4 py-4 py-md-4 d-flex justify-content-between align-items-center" style="min-height: 105px;">
                    <div>
                        <div class="d-flex align-items-center gap-2 mb-1">
                            <span class="badge bg-soft-purple text-purple fw-bold px-2 py-1" style="background-color: rgba(154, 85, 255, 0.12); color: #9a55ff; font-size: 0.75rem; border-radius: 6px;">
                                <i class="mdi mdi-shield-check me-1"></i>KATALOG RESMI PERIZINAN & LEGALITAS
                            </span>
                        </div>
                        <h3 class="text-dark mb-1 fw-bold" style="font-size: 1.35rem;">
                            Master Dokumen Perizinan Developer Properti
                        </h3>
                        <p class="text-muted mb-0" style="font-size: 0.9rem;">
                            Katalog standar perizinan BPN, OSS-RBA (PKKPR/PBG/SLF), DLH, Perpajakan, hingga Pemda untuk workflow Pra & Pasca Land Bank.
                        </p>
                    </div>
                    <div class="d-none d-sm-block pe-2">
                        <i class="mdi mdi-file-certificate-outline" style="font-size: 3.2rem; color: #9a55ff; opacity: 0.25;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Stats Cards -->
    <div class="row g-3 mb-3 mb-md-4">
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 12px;">
                <div class="card-body p-3 d-flex align-items-center gap-3">
                    <div class="rounded-3 d-flex align-items-center justify-content-center" style="width: 44px; height: 44px; background: rgba(154, 85, 255, 0.12); color: #9a55ff;">
                        <i class="mdi mdi-file-document-multiple" style="font-size: 1.4rem;"></i>
                    </div>
                    <div>
                        <div class="text-muted small fw-semibold">Total Dokumen</div>
                        <div class="fw-bold fs-5 text-dark">{{ $stats['total'] ?? 0 }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 12px;">
                <div class="card-body p-3 d-flex align-items-center gap-3">
                    <div class="rounded-3 d-flex align-items-center justify-content-center" style="width: 44px; height: 44px; background: rgba(40, 167, 69, 0.12); color: #28a745;">
                        <i class="mdi mdi-check-decagram" style="font-size: 1.4rem;"></i>
                    </div>
                    <div>
                        <div class="text-muted small fw-semibold">Dokumen Aktif</div>
                        <div class="fw-bold fs-5 text-success">{{ $stats['active'] ?? 0 }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 12px;">
                <div class="card-body p-3 d-flex align-items-center gap-3">
                    <div class="rounded-3 d-flex align-items-center justify-content-center" style="width: 44px; height: 44px; background: rgba(253, 126, 20, 0.12); color: #fd7e14;">
                        <i class="mdi mdi-alert-circle-outline" style="font-size: 1.4rem;"></i>
                    </div>
                    <div>
                        <div class="text-muted small fw-semibold">Dokumen Wajib</div>
                        <div class="fw-bold fs-5 text-warning">{{ $stats['required'] ?? 0 }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 12px;">
                <div class="card-body p-3 d-flex align-items-center gap-3">
                    <div class="rounded-3 d-flex align-items-center justify-content-center" style="width: 44px; height: 44px; background: rgba(23, 162, 184, 0.12); color: #17a2b8;">
                        <i class="mdi mdi-shape-outline" style="font-size: 1.4rem;"></i>
                    </div>
                    <div>
                        <div class="text-muted small fw-semibold">Kategori Standar</div>
                        <div class="fw-bold fs-5 text-info">{{ count($categories) }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Card Content -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm border-0" style="border-radius: 14px;">
                <div class="card-header bg-white d-flex flex-wrap justify-content-between align-items-center gap-2 py-3 border-bottom">
                    <div class="d-flex align-items-center gap-2">
                        <span class="d-inline-flex align-items-center justify-content-center rounded-2" style="width: 32px; height: 32px; background: rgba(154, 85, 255, 0.12); color: #9a55ff;">
                            <i class="mdi mdi-format-list-checks" style="font-size: 1.1rem;"></i>
                        </span>
                        <h5 class="card-title mb-0 fw-bold text-dark" style="font-size: 1.05rem;">
                            Daftar Master Dokumen & Legalitas Perizinan
                        </h5>
                    </div>
                    <button type="button" class="btn btn-sm btn-gradient-primary d-flex align-items-center gap-1 shadow-sm px-3 py-2" onclick="openModal('tambah')">
                        <i class="mdi mdi-plus-circle" style="font-size: 1.05rem;"></i>
                        <span class="fw-semibold">Tambah Master Dokumen</span>
                    </button>
                </div>

                <div class="card-body p-3 p-md-4">
                    <!-- Filter Section -->
                    <div class="filter-card mb-3 p-3" style="background-color: #fcfbfe; border: 1px solid #f0ecf8; border-radius: 10px;">
                        <!-- Desktop Version -->
                        <div class="filter-row-desktop d-none d-md-block">
                            <form id="filterForm" method="GET" action="{{ route('master.dokumen-perizinan.index') }}" onsubmit="return showFilterLoading()">
                                <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 w-100">
                                    <div class="d-flex flex-wrap align-items-center gap-2 flex-grow-1">
                                        <!-- Search Input -->
                                        <div style="min-width: 260px; max-width: 320px; flex: 1;">
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="search" id="searchInput"
                                                    placeholder="Cari nama dokumen, kode, instansi..."
                                                    value="{{ request('search') }}"
                                                    style="border-top-right-radius: 0 !important; border-bottom-right-radius: 0 !important; border-right: none;">
                                                <button class="btn btn-gradient-primary d-flex align-items-center justify-content-center px-3" 
                                                    type="submit" title="Cari"
                                                    style="border-top-left-radius: 0 !important; border-bottom-left-radius: 0 !important; border-top-right-radius: 6px !important; border-bottom-right-radius: 6px !important; height: 38px; box-shadow: none;">
                                                    <i class="mdi mdi-magnify" style="font-size: 1.15rem; color: #ffffff;"></i>
                                                </button>
                                            </div>
                                        </div>

                                        <!-- Category Filter -->
                                        <div style="width: 220px;">
                                            <select class="form-control" name="kategori" id="categorySelect">
                                                <option value="">Semua Kategori</option>
                                                @foreach($categories as $cat)
                                                    <option value="{{ $cat }}" {{ request('kategori') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <!-- Status Filter -->
                                        <div style="width: 150px;">
                                            <select class="form-control" name="status" id="statusSelect">
                                                <option value="">Semua Status</option>
                                                <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Aktif</option>
                                                <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Nonaktif</option>
                                            </select>
                                        </div>

                                        <!-- Required Filter -->
                                        <div style="width: 150px;">
                                            <select class="form-control" name="is_required" id="requiredSelect">
                                                <option value="">Semua Sifat</option>
                                                <option value="1" {{ request('is_required') === '1' ? 'selected' : '' }}>Wajib</option>
                                                <option value="0" {{ request('is_required') === '0' ? 'selected' : '' }}>Opsional</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Right Limit & Buttons -->
                                    <div class="d-flex align-items-center gap-2 ms-auto">
                                        <div style="width: 110px;">
                                            <select class="form-control" name="per_page" id="perPageSelect">
                                                <option value="10" {{ request('per_page', 15) == 10 ? 'selected' : '' }}>10 data</option>
                                                <option value="15" {{ request('per_page', 15) == 15 ? 'selected' : '' }}>15 data</option>
                                                <option value="25" {{ request('per_page', 15) == 25 ? 'selected' : '' }}>25 data</option>
                                                <option value="50" {{ request('per_page', 15) == 50 ? 'selected' : '' }}>50 data</option>
                                            </select>
                                        </div>

                                        <button type="submit" class="btn btn-gradient-primary btn-icon-only" title="Filter">
                                            <i class="mdi mdi-filter"></i>
                                        </button>
                                        <a href="{{ route('master.dokumen-perizinan.index') }}" class="btn btn-gradient-secondary btn-icon-only" title="Reset" onclick="showResetLoading(event)">
                                            <i class="mdi mdi-refresh"></i>
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <!-- Mobile Version -->
                        <div class="filter-row-mobile d-block d-md-none">
                            <form method="GET" action="{{ route('master.dokumen-perizinan.index') }}" onsubmit="return showFilterLoading()">
                                <div class="row g-2">
                                    <div class="col-12 mb-2">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="search" id="searchInputMobile"
                                                placeholder="Cari nama dokumen, kode..."
                                                value="{{ request('search') }}"
                                                style="border-top-right-radius: 0 !important; border-bottom-right-radius: 0 !important; border-right: none;">
                                            <button class="btn btn-gradient-primary d-flex align-items-center justify-content-center px-3" 
                                                type="submit" title="Cari"
                                                style="border-top-left-radius: 0 !important; border-bottom-left-radius: 0 !important; border-top-right-radius: 6px !important; border-bottom-right-radius: 6px !important; height: 38px; box-shadow: none;">
                                                <i class="mdi mdi-magnify" style="font-size: 1.15rem; color: #ffffff;"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="col-12 mb-2">
                                        <select class="form-control" name="kategori" id="categorySelectMobile">
                                            <option value="">Semua Kategori</option>
                                            @foreach($categories as $cat)
                                                <option value="{{ $cat }}" {{ request('kategori') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-6 mb-2">
                                        <select class="form-control" name="status" id="statusSelectMobile">
                                            <option value="">Semua Status</option>
                                            <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Aktif</option>
                                            <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Nonaktif</option>
                                        </select>
                                    </div>

                                    <div class="col-6 mb-2">
                                        <select class="form-control" name="per_page" id="perPageSelectMobile">
                                            <option value="10" {{ request('per_page', 15) == 10 ? 'selected' : '' }}>10 data</option>
                                            <option value="15" {{ request('per_page', 15) == 15 ? 'selected' : '' }}>15 data</option>
                                            <option value="25" {{ request('per_page', 15) == 25 ? 'selected' : '' }}>25 data</option>
                                            <option value="50" {{ request('per_page', 15) == 50 ? 'selected' : '' }}>50 data</option>
                                        </select>
                                    </div>

                                    <div class="col-6">
                                        <button type="submit" class="btn btn-gradient-primary w-100 d-flex align-items-center justify-content-center gap-1">
                                            <i class="mdi mdi-filter"></i> Filter
                                        </button>
                                    </div>
                                    <div class="col-6">
                                        <a href="{{ route('master.dokumen-perizinan.index') }}" class="btn btn-gradient-secondary w-100 d-flex align-items-center justify-content-center gap-1" onclick="showResetLoading(event)">
                                            <i class="mdi mdi-refresh"></i> Reset
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Table Data -->
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0" style="font-size: 0.88rem;">
                            <thead class="table-light">
                                <tr>
                                    <th class="text-center" style="width: 45px;">No</th>
                                    <th class="sortable" data-field="kode_dokumen" data-direction="{{ request('sortField') == 'kode_dokumen' ? (request('sortDirection') == 'asc' ? 'desc' : 'asc') : 'asc' }}" style="cursor: pointer; width: 130px;">
                                        Kode
                                        @if(request('sortField') == 'kode_dokumen')
                                            <i class="mdi mdi-{{ request('sortDirection') == 'asc' ? 'arrow-up' : 'arrow-down' }}"></i>
                                        @else
                                            <i class="mdi mdi-swap-vertical text-muted"></i>
                                        @endif
                                    </th>
                                    <th class="sortable" data-field="nama_dokumen" data-direction="{{ request('sortField') == 'nama_dokumen' ? (request('sortDirection') == 'asc' ? 'desc' : 'asc') : 'asc' }}" style="cursor: pointer;">
                                        Nama Dokumen Perizinan
                                        @if(request('sortField') == 'nama_dokumen')
                                            <i class="mdi mdi-{{ request('sortDirection') == 'asc' ? 'arrow-up' : 'arrow-down' }}"></i>
                                        @else
                                            <i class="mdi mdi-swap-vertical text-muted"></i>
                                        @endif
                                    </th>
                                    <th class="sortable" data-field="kategori" data-direction="{{ request('sortField') == 'kategori' ? (request('sortDirection') == 'asc' ? 'desc' : 'asc') : 'asc' }}" style="cursor: pointer; width: 160px;">
                                        Kategori
                                        @if(request('sortField') == 'kategori')
                                            <i class="mdi mdi-{{ request('sortDirection') == 'asc' ? 'arrow-up' : 'arrow-down' }}"></i>
                                        @else
                                            <i class="mdi mdi-swap-vertical text-muted"></i>
                                        @endif
                                    </th>
                                    <th style="width: 150px;">Instansi Terkait</th>
                                    <th class="text-center" style="width: 140px;">Estimasi Waktu & Biaya</th>
                                    <th class="text-center" style="width: 90px;">Sifat</th>
                                    <th class="text-center sortable" data-field="is_active" data-direction="{{ request('sortField') == 'is_active' ? (request('sortDirection') == 'asc' ? 'desc' : 'asc') : 'asc' }}" style="cursor: pointer; width: 95px;">
                                        Status
                                        @if(request('sortField') == 'is_active')
                                            <i class="mdi mdi-{{ request('sortDirection') == 'asc' ? 'arrow-up' : 'arrow-down' }}"></i>
                                        @else
                                            <i class="mdi mdi-swap-vertical text-muted"></i>
                                        @endif
                                    </th>
                                    <th class="text-center" style="width: 100px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($documents as $index => $doc)
                                    <tr>
                                        <td class="text-center fw-bold text-muted">{{ $documents->firstItem() + $index }}</td>
                                        <td>
                                            <span class="badge bg-light text-dark fw-bold px-2 py-1 border font-monospace" style="font-size: 0.8rem; letter-spacing: 0.4px;">
                                                {{ $doc->kode_dokumen ?? '-' }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="fw-bold text-dark mb-0" style="font-size: 0.92rem;">
                                                {{ $doc->nama_dokumen }}
                                            </div>
                                            @if($doc->deskripsi)
                                                <div class="text-muted small text-truncate" style="max-width: 320px;" title="{{ $doc->deskripsi }}">
                                                    {{ $doc->deskripsi }}
                                                </div>
                                            @endif
                                            @if($doc->syarat_dokumen)
                                                <div class="text-muted" style="font-size: 0.76rem;">
                                                    <i class="mdi mdi-file-outline text-primary me-1"></i>Syarat: {{ Str::limit($doc->syarat_dokumen, 40) }}
                                                </div>
                                            @endif
                                        </td>
                                        <td>
                                            @php
                                                $badgeStyle = match($doc->kategori) {
                                                    'Pertanahan & BPN' => 'background-color: rgba(154, 85, 255, 0.12); color: #9a55ff; border: 1px solid rgba(154, 85, 255, 0.25);',
                                                    'Tata Ruang & PUPR' => 'background-color: rgba(0, 123, 255, 0.12); color: #007bff; border: 1px solid rgba(0, 123, 255, 0.25);',
                                                    'Lingkungan Hidup (DLH)' => 'background-color: rgba(40, 167, 69, 0.12); color: #28a745; border: 1px solid rgba(40, 167, 69, 0.25);',
                                                    'Perpajakan & Bapenda' => 'background-color: rgba(253, 126, 20, 0.12); color: #fd7e14; border: 1px solid rgba(253, 126, 20, 0.25);',
                                                    'Perizinan Gedung (PBG)' => 'background-color: rgba(111, 66, 193, 0.12); color: #6f42c1; border: 1px solid rgba(111, 66, 193, 0.25);',
                                                    'PSU & Disperkim' => 'background-color: rgba(23, 162, 184, 0.12); color: #17a2b8; border: 1px solid rgba(23, 162, 184, 0.25);',
                                                    default => 'background-color: #f8f9fa; color: #495057; border: 1px solid #dee2e6;'
                                                };
                                            @endphp
                                            <span class="badge rounded-pill fw-semibold px-2 py-1" style="{{ $badgeStyle }} font-size: 0.78rem;">
                                                {{ $doc->kategori }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="small fw-semibold text-secondary">
                                                <i class="mdi mdi-office-building me-1 text-muted"></i>{{ $doc->instansi_terkait ?: '-' }}
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <div class="d-flex flex-column gap-1 align-items-center">
                                                <span class="badge bg-light text-dark border px-2 py-1" style="font-size: 0.76rem;">
                                                    <i class="mdi mdi-clock-outline me-1 text-muted"></i>{{ $doc->estimasi_hari ? $doc->estimasi_hari . ' hari' : '-' }}
                                                </span>
                                                @if($doc->estimasi_biaya > 0)
                                                    <span class="fw-bold text-success" style="font-size: 0.8rem;">
                                                        Rp {{ number_format($doc->estimasi_biaya, 0, ',', '.') }}
                                                    </span>
                                                @else
                                                    <span class="text-muted small">-</span>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            @if ($doc->is_required)
                                                <span class="badge bg-danger-soft text-danger fw-bold border border-danger-subtle px-2 py-1" style="background-color: rgba(220, 53, 69, 0.1); font-size: 0.76rem;">
                                                    Wajib
                                                </span>
                                            @else
                                                <span class="badge bg-light text-muted border px-2 py-1" style="font-size: 0.76rem;">
                                                    Opsional
                                                </span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <div class="form-check form-switch d-inline-flex align-items-center justify-content-center p-0 m-0">
                                                <input class="form-check-input ms-0" type="checkbox" role="switch" 
                                                    style="cursor: pointer; width: 34px; height: 18px;"
                                                    {{ $doc->is_active ? 'checked' : '' }} 
                                                    onchange="toggleDocStatus({{ $doc->id }}, this)">
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="d-inline-flex align-items-center gap-1">
                                                <button class="btn btn-sm btn-outline-primary p-1 rounded-2" style="width: 28px; height: 28px;" title="Edit Master Dokumen" onclick="openModal('edit', {{ $doc->id }})">
                                                    <i class="mdi mdi-pencil" style="font-size: 0.95rem;"></i>
                                                </button>
                                                <button class="btn btn-sm btn-outline-danger p-1 rounded-2" style="width: 28px; height: 28px;" title="Hapus Master Dokumen" onclick="confirmDelete({{ $doc->id }})">
                                                    <i class="mdi mdi-trash-can-outline" style="font-size: 0.95rem;"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center text-muted py-5">
                                            <div class="d-flex flex-column align-items-center justify-content-center">
                                                <i class="mdi mdi-file-certificate-outline text-muted mb-2" style="font-size: 2.8rem; opacity: 0.4;"></i>
                                                <h6 class="fw-bold text-secondary mb-1">Belum ada dokumen perizinan</h6>
                                                <p class="small text-muted mb-3">Tambahkan standar dokumen perizinan untuk mempercepat proses legalitas tanah induk.</p>
                                                <button type="button" class="btn btn-sm btn-gradient-primary" onclick="openModal('tambah')">
                                                    <i class="mdi mdi-plus-circle me-1"></i> Tambah Dokumen Sekarang
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if ($documents instanceof \Illuminate\Pagination\LengthAwarePaginator && $documents->total() > 0)
                        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mt-4">
                            <div class="pagination-info mb-2 mb-sm-0 text-muted" style="font-size: 0.82rem;">
                                Menampilkan {{ $documents->firstItem() }} - {{ $documents->lastItem() }} dari {{ $documents->total() }} data master dokumen
                            </div>
                            <nav aria-label="Page navigation">
                                <ul class="pagination pagination-sm flex-wrap justify-content-center mb-0">
                                    <li class="page-item {{ $documents->onFirstPage() ? 'disabled' : '' }}">
                                        <a class="page-link" href="{{ $documents->previousPageUrl() }}" {{ !$documents->onFirstPage() ? 'onclick=showPaginationLoading(event)' : '' }}>
                                            <i class="mdi mdi-chevron-left"></i>
                                        </a>
                                    </li>

                                    @for($page = 1; $page <= $documents->lastPage(); $page++)
                                        <li class="page-item {{ $page == $documents->currentPage() ? 'active' : '' }}">
                                            @if($page == $documents->currentPage())
                                                <span class="page-link">{{ $page }}</span>
                                            @else
                                                <a class="page-link" href="{{ $documents->appends(request()->query())->url($page) }}" onclick="showPaginationLoading(event)">{{ $page }}</a>
                                            @endif
                                        </li>
                                    @endfor

                                    <li class="page-item {{ $documents->hasMorePages() ? '' : 'disabled' }}">
                                        <a class="page-link" href="{{ $documents->nextPageUrl() }}" {{ $documents->hasMorePages() ? 'onclick=showPaginationLoading(event)' : '' }}>
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

<!-- Modal Tambah/Edit Master Dokumen Perizinan -->
<div class="modal fade" id="modalDokumenPerizinan" tabindex="-1" aria-labelledby="modalDokumenLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-white border-bottom py-3">
                <h5 class="modal-title fw-bold" id="modalDokumenLabel" style="color: #2c2e3f;">
                    <i class="mdi mdi-plus-circle me-2" id="modalIcon" style="color: #9a55ff;"></i>
                    <span id="modalTitle">Tambah Master Dokumen Perizinan</span>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formDokumenPerizinan" method="POST" onsubmit="return submitDocForm(event)">
                @csrf
                <input type="hidden" id="docId" name="id">

                <div class="modal-body p-4">
                    <div class="row g-3">
                        <!-- Kode & Urutan -->
                        <div class="col-md-8">
                            <label class="form-label fw-bold small text-dark">Nama Dokumen / Izin <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="nama_dokumen" id="namaDokumen" placeholder="Contoh: Surat Keputusan Pemberian HGB (SK HGB)" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold small text-dark">Kode Dokumen</label>
                            <input type="text" class="form-control" name="kode_dokumen" id="kodeDokumen" placeholder="Contoh: DOC-BPN-01 (Auto)">
                            <small class="text-muted" style="font-size: 0.75rem;">Biarkan kosong untuk auto-generate</small>
                        </div>

                        <!-- Kategori & Instansi -->
                        <div class="col-md-6">
                            <label class="form-label fw-bold small text-dark">Kategori Perizinan <span class="text-danger">*</span></label>
                            <select name="kategori" id="kategoriDokumen" class="form-control" required>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat }}">{{ $cat }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold small text-dark">Instansi / Dinas Terkait</label>
                            <input type="text" name="instansi_terkait" id="instansiDokumen" class="form-control" placeholder="Contoh: Kantor Pertanahan / BPN Kab/Kota, DPMPTSP">
                        </div>

                        <!-- Estimasi Hari & Estimasi Biaya -->
                        <div class="col-md-4">
                            <label class="form-label fw-bold small text-dark">Estimasi Waktu (Hari Kerja)</label>
                            <div class="input-group">
                                <input type="number" name="estimasi_hari" id="estimasiHari" class="form-control" placeholder="14" min="0">
                                <span class="input-group-text bg-light">Hari</span>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <label class="form-label fw-bold small text-dark">Estimasi Biaya Standar (Rp)</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light">Rp</span>
                                <input type="number" name="estimasi_biaya" id="estimasiBiaya" class="form-control" placeholder="0" min="0">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-bold small text-dark">Urutan Display</label>
                            <input type="number" name="urutan" id="urutanDokumen" class="form-control" placeholder="1" min="0" value="0">
                        </div>

                        <!-- Syarat & Deskripsi -->
                        <div class="col-12">
                            <label class="form-label fw-bold small text-dark">Persyaratan Dokumen / Berkas Pengajuan</label>
                            <textarea name="syarat_dokumen" id="syaratDokumen" class="form-control" rows="2" placeholder="Contoh: KTP & KK Direksi, Akta Pendirian PT, Bukti Bayar PBB, Peta Bidang BPN..."></textarea>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-bold small text-dark">Catatan Teknis / Deskripsi Prosedur</label>
                            <textarea name="deskripsi" id="deskripsiDokumen" class="form-control" rows="2" placeholder="Penjelasan mengenai dasar hukum, tahapan di portal OSS, atau tips percepatan..."></textarea>
                        </div>

                        <!-- Switches: Wajib & Status -->
                        <div class="col-md-6">
                            <div class="p-3 border rounded-3 bg-light d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="fw-bold small text-dark">Dokumen Wajib (Mandatory)</div>
                                    <div class="text-muted" style="font-size: 0.75rem;">Tandai jika dokumen ini wajib ada pada proyek standar</div>
                                </div>
                                <div class="form-check form-switch m-0 p-0">
                                    <input class="form-check-input ms-0" type="checkbox" name="is_required" id="isRequired" value="1" style="cursor: pointer; width: 34px; height: 18px;">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-3 border rounded-3 bg-light d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="fw-bold small text-dark">Status Operasional Master</div>
                                    <div class="text-muted" style="font-size: 0.75rem;">Muncul di pilihan picker Pra Land Bank</div>
                                </div>
                                <div class="form-check form-switch m-0 p-0">
                                    <input class="form-check-input ms-0" type="checkbox" name="is_active" id="isActive" value="1" checked style="cursor: pointer; width: 34px; height: 18px;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer bg-light border-top py-3">
                    <button type="button" class="btn btn-secondary btn-sm px-3" data-bs-dismiss="modal">
                        Batal
                    </button>
                    <button type="submit" class="btn btn-gradient-primary btn-sm px-4" id="submitBtn">
                        <i class="mdi mdi-content-save me-1" id="btnIcon"></i>
                        <span id="btnText">Simpan Dokumen</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$(document).ready(function() {
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
            timer: 2500,
            showConfirmButton: true,
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
        html: 'Sedang mereset filter',
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
        html: 'Sedang memuat halaman',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });
    window.location.href = event.currentTarget.href;
}

function submitDocForm(event) {
    event.preventDefault();
    Swal.fire({
        title: 'Mohon tunggu...',
        html: 'Sedang menyimpan data dokumen perizinan',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });

    setTimeout(() => {
        document.getElementById('formDokumenPerizinan').submit();
    }, 100);

    return false;
}

function openModal(type, id = null) {
    if (type === 'tambah') {
        $('#formDokumenPerizinan')[0].reset();
        $('#docId').val('');
        $('#isActive').prop('checked', true);
        $('#isRequired').prop('checked', false);
        $('#formDokumenPerizinan').attr('action', '{{ route("master.dokumen-perizinan.store") }}');

        $('#modalTitle').text('Tambah Master Dokumen Perizinan');
        $('#modalIcon').removeClass('mdi-pencil').addClass('mdi-plus-circle');
        $('#btnText').text('Simpan Dokumen');
        $('#btnIcon').removeClass('mdi-pencil').addClass('mdi-content-save');

        $('#modalDokumenPerizinan').modal('show');
    } else {
        Swal.fire({
            title: 'Mohon tunggu...',
            html: 'Sedang mengambil data dokumen',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        $.get('{{ url("master-data/dokumen-perizinan") }}/' + id + '/edit', function(data) {
            Swal.close();

            $('#docId').val(data.id);
            $('#kodeDokumen').val(data.kode_dokumen);
            $('#namaDokumen').val(data.nama_dokumen);
            $('#kategoriDokumen').val(data.kategori);
            $('#instansiDokumen').val(data.instansi_terkait);
            $('#estimasiHari').val(data.estimasi_hari);
            $('#estimasiBiaya').val(data.estimasi_biaya);
            $('#urutanDokumen').val(data.urutan);
            $('#syaratDokumen').val(data.syarat_dokumen);
            $('#deskripsiDokumen').val(data.deskripsi);
            $('#isRequired').prop('checked', !!data.is_required);
            $('#isActive').prop('checked', !!data.is_active);

            $('#formDokumenPerizinan').attr('action', '{{ url("master-data/dokumen-perizinan") }}/' + id);

            // Add _method PUT
            if (!$('#formDokumenPerizinan input[name="_method"]').length) {
                $('#formDokumenPerizinan').append('<input type="hidden" name="_method" value="PUT">');
            }

            $('#modalTitle').text('Edit Master Dokumen Perizinan');
            $('#modalIcon').removeClass('mdi-plus-circle').addClass('mdi-pencil');
            $('#btnText').text('Update Dokumen');
            $('#btnIcon').removeClass('mdi-content-save').addClass('mdi-pencil');

            $('#modalDokumenPerizinan').modal('show');
        }).fail(function() {
            Swal.close();
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: 'Gagal mengambil data dokumen perizinan',
                confirmButtonColor: '#dc3545'
            });
        });
    }
}

function toggleDocStatus(id, checkbox) {
    let originalState = checkbox.checked;
    
    $.ajax({
        url: '{{ url("master-data/dokumen-perizinan") }}/' + id + '/toggle-status',
        type: 'PATCH',
        data: {
            _token: '{{ csrf_token() }}'
        },
        success: function(response) {
            if (response.success) {
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 2000,
                    timerProgressBar: true
                });
                Toast.fire({
                    icon: 'success',
                    title: response.message
                });
            } else {
                checkbox.checked = !originalState;
                Swal.fire('Error', 'Gagal mengubah status', 'error');
            }
        },
        error: function() {
            checkbox.checked = !originalState;
            Swal.fire('Error', 'Terjadi kesalahan koneksi server', 'error');
        }
    });
}

function confirmDelete(id) {
    Swal.fire({
        title: 'Yakin ingin menghapus?',
        text: "Dokumen ini akan dihapus dari master perizinan!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: 'Menghapus...',
                html: 'Sedang menghapus data',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            setTimeout(() => {
                let form = document.createElement('form');
                form.method = 'POST';
                form.action = '{{ url("master-data/dokumen-perizinan") }}/' + id;

                let csrfInput = document.createElement('input');
                csrfInput.type = 'hidden';
                csrfInput.name = '_token';
                csrfInput.value = '{{ csrf_token() }}';

                let methodInput = document.createElement('input');
                methodInput.type = 'hidden';
                methodInput.name = '_method';
                methodInput.value = 'DELETE';

                form.appendChild(csrfInput);
                form.appendChild(methodInput);

                document.body.appendChild(form);
                form.submit();
            }, 100);
        }
    });
}
</script>
@endpush
