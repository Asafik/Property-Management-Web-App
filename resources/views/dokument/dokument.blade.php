@extends('layouts.partial.app')

@section('title', 'Dokumen Tanah Induk (LandBank) - Property Management App')

@section('content')

<style>
    /* Modal Custom Sizing & Aesthetics */
    #modalDokumen .modal-dialog {
        max-width: 660px;
    }
    #modalDokumen .modal-content {
        border-radius: 16px;
        overflow: hidden;
        border: none;
        box-shadow: 0 20px 45px rgba(0, 0, 0, 0.12) !important;
    }
    #modalDokumen .modal-header {
        background: #ffffff;
        padding: 1.25rem 1.75rem;
        border-bottom: 1px solid #f1f5f9;
    }
    #modalDokumen .modal-body {
        padding: 1.5rem 1.75rem;
        background: #ffffff;
    }
    #modalDokumen .modal-footer {
        padding: 1rem 1.75rem;
        background: #f8fafc;
        border-top: 1px solid #f1f5f9;
    }

    /* Category Card Selector */
    .cat-selector-box {
        background: #f8fafc;
        border: 1.5px solid #e2e8f0;
        border-radius: 14px;
        padding: 1.15rem;
    }
    .category-select-card {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0.75rem 0.95rem;
        background: #ffffff;
        border: 1.5px solid #e2e8f0;
        border-radius: 10px;
        cursor: pointer;
        transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        margin-bottom: 0;
        user-select: none;
        position: relative;
    }
    .category-select-card:hover {
        border-color: #c084fc;
        background: #faf5ff;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(154, 85, 255, 0.08);
    }
    .category-select-card.active {
        border-color: #9a55ff;
        background: linear-gradient(135deg, #fdfaff 0%, #f5edff 100%);
        box-shadow: 0 4px 14px rgba(154, 85, 255, 0.15);
    }
    .category-select-card .cat-checkbox {
        width: 19px;
        height: 19px;
        accent-color: #9a55ff;
        cursor: pointer;
        border-radius: 5px;
        flex-shrink: 0;
    }
    .category-select-card .cat-badge {
        font-size: 10px;
        font-weight: 700;
        padding: 3px 7px;
        border-radius: 6px;
        letter-spacing: 0.3px;
        flex-shrink: 0;
    }
    .category-select-card .cat-title {
        font-size: 0.84rem;
        font-weight: 600;
        color: #334155;
        line-height: 1.25;
        white-space: nowrap;
    }
    .category-select-card.active .cat-title {
        color: #581c87;
        font-weight: 700;
    }

    /* Soft Table Badges */
    .cat-pill {
        font-size: 10.5px;
        font-weight: 600;
        padding: 2.5px 7px;
        border-radius: 5px;
        display: inline-flex;
        align-items: center;
        gap: 3px;
        border-width: 1px;
        border-style: solid;
        line-height: 1.2;
    }
    .cat-pill-shm {
        background: #eff6ff;
        color: #1d4ed8;
        border-color: #bfdbfe;
    }
    .cat-pill-ajb {
        background: #f0fdfa;
        color: #0f766e;
        border-color: #99f6e4;
    }
    .cat-pill-aphb {
        background: #fefce8;
        color: #a16207;
        border-color: #fef08a;
    }
    .cat-pill-warisan {
        background: #fff1f2;
        color: #be123c;
        border-color: #fecdd3;
    }
    .cat-pill-petok {
        background: #f8fafc;
        color: #475569;
        border-color: #cbd5e1;
    }
    .cat-pill-all {
        background: #f0fdf4;
        color: #15803d;
        border-color: #bbf7d0;
        font-size: 11px;
        padding: 3.5px 9px;
    }
</style>

<div class="container-fluid px-1 px-sm-2 px-md-3 py-2 py-md-3">

    <!-- Header Card Banner -->
    <div class="row mb-3 mb-md-4">
        <div class="col-12">
            <div class="card shadow-sm border-0 header-card">
                <div class="card-body p-4 p-md-4 py-4 py-md-4 d-flex flex-wrap justify-content-between align-items-center gap-3" style="min-height: 105px;">
                    <div>
                        <h3 class="text-dark mb-1 fw-bold" style="font-size: 1.35rem;">
                            Dokumen Tanah Induk (LandBank)
                        </h3>
                        <p class="text-muted mb-0" style="font-size: 0.9rem;">
                            Kelola master jenis dokumen legalitas tanah induk landbank
                        </p>
                    </div>
                    <div class="d-flex align-items-center gap-3">
                        <button type="button" class="btn btn-sm btn-gradient-primary d-flex align-items-center gap-1 shadow-sm px-3 py-2" onclick="openModal('tambah')">
                            <i class="mdi mdi-plus-circle" style="font-size: 1rem;"></i>
                            <span>Tambah Dokumen</span>
                        </button>
                        <div class="d-none d-md-block pe-2">
                            <i class="mdi mdi-file-document-multiple-outline" style="font-size: 3rem; color: #9a55ff; opacity: 0.25;"></i>
                        </div>
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
                        <i class="mdi mdi-format-list-bulleted me-2"></i>Daftar Jenis Dokumen
                    </h5>
                </div>

                <div class="card-body">
                    <!-- Filter Section -->
                    <div class="filter-card mb-3">
                        <!-- Desktop Filter -->
                        <div class="filter-row-desktop d-none d-md-block">
                            <form method="GET" action="{{ route('dokument.index') }}" onsubmit="return showFilterLoading()">
                                <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 w-100">
                                    <div class="d-flex flex-wrap align-items-center gap-2 flex-grow-1">
                                        <div style="min-width: 240px; max-width: 320px; flex: 1;">
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="search" id="searchInput"
                                                    placeholder="Cari nama / kode dokumen..."
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
                                            <select class="form-control" name="category" id="categorySelect">
                                                <option value="">Semua Kategori</option>
                                                <option value="SHM" {{ request('category') == 'SHM' ? 'selected' : '' }}>SHM</option>
                                                <option value="AJB" {{ request('category') == 'AJB' ? 'selected' : '' }}>AJB / Hibah</option>
                                                <option value="APHB" {{ request('category') == 'APHB' ? 'selected' : '' }}>APHB</option>
                                                <option value="WARISAN" {{ request('category') == 'WARISAN' ? 'selected' : '' }}>Warisan</option>
                                                <option value="PETOK_C" {{ request('category') == 'PETOK_C' ? 'selected' : '' }}>Petok C</option>
                                            </select>
                                        </div>

                                        <div style="width: 170px;">
                                            <select class="form-control" name="has_expiry" id="expirySelect">
                                                <option value="">Semua Masa Berlaku</option>
                                                <option value="yes" {{ request('has_expiry') == 'yes' ? 'selected' : '' }}>Ada Masa Berlaku</option>
                                                <option value="no" {{ request('has_expiry') == 'no' ? 'selected' : '' }}>Tanpa Masa Berlaku</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-center gap-2 ms-auto">
                                        <div style="width: 115px;">
                                            <select class="form-control" name="per_page" id="showSelect">
                                                <option value="10" {{ request('per_page', 15) == 10 ? 'selected' : '' }}>10 data</option>
                                                <option value="15" {{ request('per_page', 15) == 15 ? 'selected' : '' }}>15 data</option>
                                                <option value="25" {{ request('per_page', 15) == 25 ? 'selected' : '' }}>25 data</option>
                                                <option value="50" {{ request('per_page', 15) == 50 ? 'selected' : '' }}>50 data</option>
                                            </select>
                                        </div>

                                        <button type="submit" class="btn btn-gradient-primary btn-icon-only" title="Filter">
                                            <i class="mdi mdi-filter"></i>
                                        </button>
                                        <a href="{{ route('dokument.index') }}" class="btn btn-gradient-secondary btn-icon-only" title="Reset" onclick="showResetLoading(event)">
                                            <i class="mdi mdi-refresh"></i>
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <!-- Mobile Filter -->
                        <div class="filter-row-mobile d-block d-md-none">
                            <form method="GET" action="{{ route('dokument.index') }}" onsubmit="return showFilterLoading()">
                                <div class="row g-2">
                                    <div class="col-12 mb-2">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="search" id="searchInputMobile"
                                                placeholder="Cari nama / kode dokumen..."
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
                                        <select class="form-control" name="category" id="categorySelectMobile">
                                            <option value="">Semua Kategori</option>
                                            <option value="SHM" {{ request('category') == 'SHM' ? 'selected' : '' }}>SHM</option>
                                            <option value="AJB" {{ request('category') == 'AJB' ? 'selected' : '' }}>AJB / Hibah</option>
                                            <option value="APHB" {{ request('category') == 'APHB' ? 'selected' : '' }}>APHB</option>
                                            <option value="WARISAN" {{ request('category') == 'WARISAN' ? 'selected' : '' }}>Warisan</option>
                                            <option value="PETOK_C" {{ request('category') == 'PETOK_C' ? 'selected' : '' }}>Petok C</option>
                                        </select>
                                    </div>

                                    <div class="col-12 mb-2">
                                        <select class="form-control" name="has_expiry" id="expirySelectMobile">
                                            <option value="">Semua Masa Berlaku</option>
                                            <option value="yes" {{ request('has_expiry') == 'yes' ? 'selected' : '' }}>Ada Masa Berlaku</option>
                                            <option value="no" {{ request('has_expiry') == 'no' ? 'selected' : '' }}>Tanpa Masa Berlaku</option>
                                        </select>
                                    </div>

                                    <div class="col-12 mb-2">
                                        <select class="form-control" name="per_page" id="showSelectMobile">
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
                                        <a href="{{ route('dokument.index') }}" class="btn btn-gradient-secondary w-100 d-flex align-items-center justify-content-center gap-1" onclick="showResetLoading(event)">
                                            <i class="mdi mdi-refresh"></i> Reset
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Tabel Data Dokumen -->
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th>Nama Dokumen</th>
                                    <th>Kode Dokumen</th>
                                    <th>Berlaku Untuk Alas Hak</th>
                                    <th>Masa Berlaku</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($documentTypes as $index => $item)
                                <tr>
                                    <td class="text-center fw-bold">{{ $documentTypes->firstItem() + $index }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="mdi mdi-file-document-outline text-primary me-2" style="font-size: 1.2rem;"></i>
                                            <span class="fw-bold">{{ $item->name }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-light text-dark fw-semibold px-2 py-1 border" style="font-size: 0.78rem;">
                                            {{ $item->code }}
                                        </span>
                                    </td>
                                    <td>
                                        @php
                                            $cats = $item->applicable_categories ?? [];
                                            $allKnown = ['SHM', 'AJB', 'APHB', 'WARISAN', 'PETOK_C'];
                                        @endphp
                                        @if(empty($cats) || count(array_intersect($allKnown, $cats)) === 5)
                                            <span class="cat-pill cat-pill-all">
                                                <i class="mdi mdi-check-all me-1"></i>Semua Alas Hak
                                            </span>
                                        @else
                                            <div class="d-flex flex-wrap gap-1 align-items-center">
                                                @if(in_array('SHM', $cats))
                                                    <span class="cat-pill cat-pill-shm">SHM</span>
                                                @endif
                                                @if(in_array('AJB', $cats))
                                                    <span class="cat-pill cat-pill-ajb">AJB / Hibah</span>
                                                @endif
                                                @if(in_array('APHB', $cats))
                                                    <span class="cat-pill cat-pill-aphb">APHB</span>
                                                @endif
                                                @if(in_array('WARISAN', $cats))
                                                    <span class="cat-pill cat-pill-warisan">Warisan</span>
                                                @endif
                                                @if(in_array('PETOK_C', $cats))
                                                    <span class="cat-pill cat-pill-petok">Petok C</span>
                                                @endif
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($item->has_expiry)
                                            <span class="badge-status available">
                                                <i class="mdi mdi-calendar-clock me-1"></i>Ada Masa Berlaku
                                            </span>
                                        @else
                                            <span class="badge bg-light text-muted fw-semibold px-2 py-1 border" style="font-size: 0.78rem;">
                                                <i class="mdi mdi-calendar-remove me-1"></i>Tanpa Masa Berlaku
                                            </span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <button class="btn-action edit me-1" title="Edit Dokumen" onclick="openModal('edit', {{ $item->id }})">
                                            <i class="mdi mdi-pencil"></i>
                                        </button>
                                        <button class="btn-action delete" title="Hapus Dokumen" onclick="confirmDelete({{ $item->id }})">
                                            <i class="mdi mdi-trash-can-outline"></i>
                                        </button>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-4">
                                        <i class="mdi mdi-file-document-off-outline me-2" style="font-size: 1.5rem;"></i>
                                        Tidak ada data dokumen yang tersedia.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if ($documentTypes instanceof \Illuminate\Pagination\LengthAwarePaginator && $documentTypes->total() > 0)
                    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mt-4">
                        <div class="pagination-info mb-2 mb-sm-0 text-muted" style="font-size: 0.82rem;">
                            Menampilkan {{ $documentTypes->firstItem() }} - {{ $documentTypes->lastItem() }} dari {{ $documentTypes->total() }} data
                        </div>

                        <nav aria-label="Page navigation">
                            <ul class="pagination pagination-sm flex-wrap justify-content-center mb-0">
                                <li class="page-item {{ $documentTypes->onFirstPage() ? 'disabled' : '' }}">
                                    <a class="page-link" href="{{ $documentTypes->previousPageUrl() }}" {{ !$documentTypes->onFirstPage() ? 'onclick=showPaginationLoading(event)' : '' }}>
                                        <i class="mdi mdi-chevron-left"></i>
                                    </a>
                                </li>

                                @for($page = 1; $page <= $documentTypes->lastPage(); $page++)
                                    <li class="page-item {{ $page == $documentTypes->currentPage() ? 'active' : '' }}">
                                        @if($page == $documentTypes->currentPage())
                                            <span class="page-link">{{ $page }}</span>
                                        @else
                                            <a class="page-link" href="{{ $documentTypes->appends(request()->query())->url($page) }}" onclick="showPaginationLoading(event)">{{ $page }}</a>
                                        @endif
                                    </li>
                                @endfor

                                <li class="page-item {{ $documentTypes->hasMorePages() ? '' : 'disabled' }}">
                                    <a class="page-link" href="{{ $documentTypes->nextPageUrl() }}" {{ $documentTypes->hasMorePages() ? 'onclick=showPaginationLoading(event)' : '' }}>
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

<!-- Modal Tambah/Edit Dokumen -->
<div class="modal fade" id="modalDokumen" tabindex="-1" aria-labelledby="modalDokumenLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 660px;">
        <div class="modal-content">
            <div class="modal-header">
                <div class="d-flex align-items-center gap-2.5">
                    <div class="p-2 rounded-3" style="background: rgba(154, 85, 255, 0.1); color: #9a55ff;">
                        <i class="mdi mdi-file-document-edit-outline" id="modalIcon" style="font-size: 1.4rem;"></i>
                    </div>
                    <div>
                        <h5 class="modal-title fw-bold text-dark mb-0" id="modalDokumenLabel" style="font-size: 1.15rem;">
                            <span id="modalTitle">Tambah Dokumen</span>
                        </h5>
                        <small class="text-muted" style="font-size: 0.78rem;">Kelola konfigurasi jenis dokumen legalitas tanah induk</small>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formDokumen" method="POST" onsubmit="return submitForm(event)">
                @csrf
                <input type="hidden" name="_method" id="methodField" value="POST">
                
                <div class="modal-body">
                    <div class="row g-3 mb-3">
                        <div class="col-12 col-md-7">
                            <label class="form-label fw-bold" style="color: #334155; font-size: 0.85rem;">
                                Nama Dokumen <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="name" id="namaDokumen" class="form-control" placeholder="Contoh: Akta Jual Beli (AJB)" required style="border-radius: 8px; font-size: 0.88rem; padding: 0.6rem 0.85rem;">
                        </div>

                        <div class="col-12 col-md-5">
                            <label class="form-label fw-bold" style="color: #334155; font-size: 0.85rem;">
                                Kode Dokumen <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="code" id="kodeDokumen" class="form-control" placeholder="Contoh: AJB_HIBAH" required style="border-radius: 8px; font-size: 0.88rem; padding: 0.6rem 0.85rem; text-transform: uppercase;">
                        </div>
                    </div>

                    <!-- Kategori Dasar Perolehan Tanah / Alas Hak -->
                    <div class="cat-selector-box mb-3">
                        <div class="d-flex flex-wrap justify-content-between align-items-center mb-2.5 gap-2">
                            <div>
                                <label class="form-label fw-bold mb-0 text-dark d-flex align-items-center gap-1.5" style="font-size: 0.88rem;">
                                    <i class="mdi mdi-checkbox-multiple-marked-circle text-primary" style="font-size: 1.15rem;"></i>
                                    <span>Dasar Perolehan Tanah / Alas Hak</span>
                                    <span class="text-danger">*</span>
                                </label>
                                <small class="text-muted d-block" style="font-size: 0.75rem;">
                                    Pilih jenis alas hak yang mewajibkan dokumen ini (sesuai SOP)
                                </small>
                            </div>
                            <div class="d-flex gap-1.5">
                                <button type="button" class="btn btn-xs btn-outline-primary px-2.5 py-1 rounded-pill fw-semibold shadow-none" style="font-size: 11px;" onclick="toggleAllCategories(true)">
                                    <i class="mdi mdi-check-all me-1"></i>Pilih Semua
                                </button>
                                <button type="button" class="btn btn-xs btn-outline-secondary px-2.5 py-1 rounded-pill fw-semibold shadow-none" style="font-size: 11px;" onclick="toggleAllCategories(false)">
                                    <i class="mdi mdi-refresh me-1"></i>Kosongkan
                                </button>
                            </div>
                        </div>

                        <div class="row g-2">
                            <!-- Card SHM -->
                            <div class="col-12 col-sm-6">
                                <label class="category-select-card w-100" id="card_cat_SHM" for="cat_SHM">
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="badge bg-primary cat-badge">SHM</span>
                                        <span class="cat-title">Sertifikat Hak Milik</span>
                                    </div>
                                    <input class="form-check-input cat-checkbox m-0" type="checkbox" name="applicable_categories[]" value="SHM" id="cat_SHM" onchange="syncCardState(this)">
                                </label>
                            </div>

                            <!-- Card AJB -->
                            <div class="col-12 col-sm-6">
                                <label class="category-select-card w-100" id="card_cat_AJB" for="cat_AJB">
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="badge bg-info text-dark cat-badge">AJB</span>
                                        <span class="cat-title">AJB / Akta Hibah</span>
                                    </div>
                                    <input class="form-check-input cat-checkbox m-0" type="checkbox" name="applicable_categories[]" value="AJB" id="cat_AJB" onchange="syncCardState(this)">
                                </label>
                            </div>

                            <!-- Card APHB -->
                            <div class="col-12 col-sm-6">
                                <label class="category-select-card w-100" id="card_cat_APHB" for="cat_APHB">
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="badge bg-warning text-dark cat-badge">APHB</span>
                                        <span class="cat-title">Akta Pembagian Bersama</span>
                                    </div>
                                    <input class="form-check-input cat-checkbox m-0" type="checkbox" name="applicable_categories[]" value="APHB" id="cat_APHB" onchange="syncCardState(this)">
                                </label>
                            </div>

                            <!-- Card WARISAN -->
                            <div class="col-12 col-sm-6">
                                <label class="category-select-card w-100" id="card_cat_WARISAN" for="cat_WARISAN">
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="badge bg-danger text-white cat-badge">Warisan</span>
                                        <span class="cat-title">AJB/Hibah Warisan</span>
                                    </div>
                                    <input class="form-check-input cat-checkbox m-0" type="checkbox" name="applicable_categories[]" value="WARISAN" id="cat_WARISAN" onchange="syncCardState(this)">
                                </label>
                            </div>

                            <!-- Card PETOK C -->
                            <div class="col-12 col-sm-6">
                                <label class="category-select-card w-100" id="card_cat_PETOK_C" for="cat_PETOK_C">
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="badge bg-secondary text-white cat-badge">Petok C</span>
                                        <span class="cat-title">Petok C / Girik Asli</span>
                                    </div>
                                    <input class="form-check-input cat-checkbox m-0" type="checkbox" name="applicable_categories[]" value="PETOK_C" id="cat_PETOK_C" onchange="syncCardState(this)">
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Masa Berlaku Dokumen -->
                    <div class="d-flex justify-content-between align-items-center p-3 rounded-3 border" style="background: #f8fafc; border-color: #e2e8f0 !important;">
                        <div>
                            <span class="fw-bold d-block text-dark" style="font-size: 0.88rem;">Masa Berlaku Dokumen</span>
                            <small class="text-muted" style="font-size: 0.75rem;">
                                Aktifkan switch ini jika dokumen memiliki batas waktu / kedaluwarsa
                            </small>
                        </div>
                        <div class="form-check form-switch mb-0">
                            <input class="form-check-input" type="checkbox" name="has_expiry" value="1" id="hasExpiryCheckbox" style="cursor: pointer; width: 42px; height: 22px;">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light btn-sm px-4 fw-semibold border" data-bs-dismiss="modal" style="border-radius: 8px;">
                        Batal
                    </button>
                    <button type="submit" class="btn btn-gradient-primary btn-sm px-4 fw-bold shadow-sm" id="submitBtn" style="border-radius: 8px;">
                        <i class="mdi mdi-content-save me-1" id="btnIcon"></i>
                        <span id="btnText">Simpan</span>
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
    // Notifikasi sukses dari session
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

    // Notifikasi error dari session
    @if (session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: '{{ session('error') }}',
            confirmButtonColor: '#dc3545'
        });
    @endif
    
    // Validasi error
    @if(isset($errors) && $errors->any())
        Swal.fire({
            icon: 'warning',
            title: 'Validasi Gagal',
            html: `
                <ul style="text-align: left; margin-top: 10px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            `,
            confirmButtonColor: '#9a55ff'
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

function submitForm(event) {
    event.preventDefault();

    Swal.fire({
        title: 'Mohon tunggu...',
        html: 'Sedang menyimpan data',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });

    setTimeout(() => {
        document.getElementById('formDokumen').submit();
    }, 100);

    return false;
}

function syncCardState(checkbox) {
    const card = document.getElementById('card_' + checkbox.id) || checkbox.closest('.category-select-card');
    if (card) {
        if (checkbox.checked) {
            card.classList.add('active');
        } else {
            card.classList.remove('active');
        }
    }
}

function syncAllCards() {
    $('.cat-checkbox').each(function() {
        syncCardState(this);
    });
}

function toggleAllCategories(checked) {
    $('.cat-checkbox').prop('checked', checked);
    syncAllCards();
}

function openModal(type, id = null) {
    if (type === 'tambah') {
        $('#formDokumen')[0].reset();
        $('#methodField').val('POST');
        $('#formDokumen').attr('action', '{{ route("dokument.store") }}');

        $('#modalTitle').text('Tambah Dokumen');
        $('#modalIcon').removeClass('mdi-pencil').addClass('mdi-file-document-plus-outline');
        $('#btnText').text('Simpan');
        $('#btnIcon').removeClass('mdi-pencil').addClass('mdi-content-save');
        $('#hasExpiryCheckbox').prop('checked', false);
        $('.cat-checkbox').prop('checked', true); // Default checked all for new doc
        syncAllCards();

        $('#modalDokumen').modal('show');
    } else {
        Swal.fire({
            title: 'Mohon tunggu...',
            html: 'Sedang mengambil data dokumen',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        $.get('{{ url("dokument") }}/' + id + '/edit', function(data) {
            Swal.close();

            $('#namaDokumen').val(data.name);
            $('#kodeDokumen').val(data.code);
            $('#hasExpiryCheckbox').prop('checked', data.has_expiry == 1);

            // Populate checkboxes
            $('.cat-checkbox').prop('checked', false);
            if (data.applicable_categories && Array.isArray(data.applicable_categories)) {
                data.applicable_categories.forEach(function(cat) {
                    $('#cat_' + cat).prop('checked', true);
                });
            }
            syncAllCards();

            $('#methodField').val('PUT');
            $('#formDokumen').attr('action', '{{ url("dokument") }}/' + id);

            $('#modalTitle').text('Edit Dokumen');
            $('#modalIcon').removeClass('mdi-file-document-plus-outline').addClass('mdi-pencil');
            $('#btnText').text('Update');
            $('#btnIcon').removeClass('mdi-content-save').addClass('mdi-pencil');

            $('#modalDokumen').modal('show');
        }).fail(function() {
            Swal.close();
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: 'Gagal mengambil data dokumen',
                confirmButtonColor: '#dc3545'
            });
        });
    }
}

function confirmDelete(id) {
    Swal.fire({
        title: 'Yakin ingin menghapus?',
        text: "Data yang dihapus tidak dapat dikembalikan!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal',
        showLoaderOnConfirm: true,
        preConfirm: () => {
            return new Promise((resolve) => {
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
                    form.action = '{{ url("dokument") }}/' + id;

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

                    resolve();
                }, 100);
            });
        }
    });
}
</script>
@endpush
