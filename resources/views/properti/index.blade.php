@extends('layouts.partial.app')

@section('title', 'Semua Properti Proyek')

@section('content')

    @php
        function sortIcon($column)
        {
            if (request('sort_by') !== $column) {
                return 'mdi-swap-vertical text-muted';
            }
            return request('sort_order', 'asc') === 'desc'
                ? 'mdi-arrow-down text-primary fw-bold'
                : 'mdi-arrow-up text-primary fw-bold';
        }
    @endphp



    <div class="container-fluid px-1 px-sm-2 px-md-3 py-2 py-md-3">
        <!-- Header Card Banner -->
        <div class="row mb-3 mb-md-4">
            <div class="col-12">
                <div class="card shadow-sm border-0 header-card">
                    <div class="card-body p-4 p-md-4 py-4 py-md-4 d-flex justify-content-between align-items-center" style="min-height: 105px;">
                        <div>
                            <h3 class="text-dark mb-1 fw-bold" style="font-size: 1.35rem;">
                                Semua Tanah Pasca Land Bank
                            </h3>
                            <p class="text-muted mb-0" style="font-size: 0.9rem;">
                                Daftar seluruh properti proyek yang terdaftar dalam sistem
                            </p>
                        </div>
                        <div class="d-none d-sm-block pe-2">
                            <i class="mdi mdi-home-city-outline" style="font-size: 3rem; color: #9a55ff; opacity: 0.25;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-2 mt-sm-2 mt-md-3">
            <div class="col-12">
                <div class="card shadow-sm border-0">
                    <div
                        class="card-header bg-white d-flex flex-wrap flex-md-row justify-content-between align-items-center gap-2 py-3">
                        <h5 class="card-title mb-0" style="font-weight: 700; color: #2c2e3f;">
                            <i class="mdi mdi-format-list-bulleted me-2" style="color: #9a55ff;"></i>Daftar Properti
                        </h5>
                        <a href="{{ route('properti') }}" class="btn btn-sm btn-gradient-primary d-inline-flex align-items-center" style="gap: 5px;">
                            <i class="mdi mdi-plus me-1"></i> Tambah Pasca Landbank
                        </a>
                    </div>

                    <div class="card-body">
                        <!-- Filter Section -->
                        <div class="filter-card mb-3">
                            <form id="filterForm" method="GET" action="{{ route('properti-all') }}">
                                <input type="hidden" name="sort_by" id="sort_by" value="{{ request('sort_by') }}">
                                <input type="hidden" name="sort_order" id="sort_order"
                                    value="{{ request('sort_order', 'asc') }}">

                                <!-- DESKTOP VERSION -->
                                <div class="filter-row-desktop d-none d-md-block">
                                    <div class="row g-2 align-items-center w-100">
                                        <div class="col-12 col-md-3 col-lg-3">
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="search" id="searchInput"
                                                    placeholder="Nama Properti..." value="{{ request('search') }}"
                                                    style="border-top-right-radius: 0 !important; border-bottom-right-radius: 0 !important; border-right: none;">
                                                <button class="btn btn-gradient-primary d-flex align-items-center justify-content-center px-3" 
                                                    type="submit" title="Cari"
                                                    style="border-top-left-radius: 0 !important; border-bottom-left-radius: 0 !important; border-top-right-radius: 4px !important; border-bottom-right-radius: 4px !important; height: 38px; box-shadow: none;">
                                                    <i class="mdi mdi-magnify" style="font-size: 1.15rem; color: #ffffff;"></i>
                                                </button>
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-2 col-lg-2">
                                            <select name="company_profile_id" id="filterCompany"
                                                class="form-control select2">
                                                <option value="">Semua Perusahaan</option>
                                                @foreach ($companies as $company)
                                                    <option value="{{ $company->id }}"
                                                        {{ request('company_profile_id') == $company->id ? 'selected' : '' }}>
                                                        {{ $company->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-6 col-md-2 col-lg-2">
                                            <select name="kategori" class="form-control">
                                                <option value="">Semua Kategori</option>
                                                @foreach ($categories as $cat)
                                                    <option value="{{ $cat }}"
                                                        {{ request('kategori') == $cat ? 'selected' : '' }}>
                                                        {{ $cat }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-6 col-md-2 col-lg-2">
                                            <select name="legalitas" class="form-control">
                                                <option value="">Semua Legalitas</option>
                                                <option value="verified"
                                                    {{ request('legalitas') == 'verified' ? 'selected' : '' }}>
                                                    Terverifikasi</option>
                                                <option value="pending"
                                                    {{ request('legalitas') == 'pending' ? 'selected' : '' }}>Pending
                                                </option>
                                                <option value="rejected"
                                                    {{ request('legalitas') == 'rejected' ? 'selected' : '' }}>Rejected
                                                </option>
                                            </select>
                                        </div>

                                        <div class="col-6 col-md-2 col-lg-2">
                                            <select name="pembangunan" class="form-control">
                                                <option value="">Semua Status</option>
                                                <option value="Selesai"
                                                    {{ request('pembangunan') == 'Selesai' ? 'selected' : '' }}>Selesai
                                                </option>
                                                <option value="progress"
                                                    {{ request('pembangunan') == 'progress' ? 'selected' : '' }}>
                                                    Progress</option>
                                                <option value="Belum"
                                                    {{ request('pembangunan') == 'Belum' ? 'selected' : '' }}>Belum
                                                </option>
                                            </select>
                                        </div>

                                        <div class="col-6 col-md-1 col-lg-1">
                                            <div class="d-flex gap-2">
                                                <button type="submit" class="btn btn-gradient-primary btn-icon-only flex-fill"
                                                    title="Filter">
                                                    <i class="mdi mdi-filter"></i>
                                                </button>
                                                <a href="{{ route('properti-all') }}"
                                                    class="btn btn-gradient-secondary btn-icon-only flex-fill btn-reset"
                                                    title="Reset">
                                                    <i class="mdi mdi-refresh"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- MOBILE VERSION -->
                                <div class="filter-row-mobile d-block d-md-none">
                                    <div class="row g-2">
                                        <div class="col-12 mb-2">
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="searchInputMobile" name="search"
                                                    placeholder="Nama Properti..." value="{{ request('search') }}"
                                                    style="border-top-right-radius: 0 !important; border-bottom-right-radius: 0 !important; border-right: none;">
                                                <button class="btn btn-gradient-primary d-flex align-items-center justify-content-center px-3" 
                                                    type="submit" title="Cari"
                                                    style="border-top-left-radius: 0 !important; border-bottom-left-radius: 0 !important; border-top-right-radius: 4px !important; border-bottom-right-radius: 4px !important; height: 38px; box-shadow: none;">
                                                    <i class="mdi mdi-magnify" style="font-size: 1.15rem; color: #ffffff;"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="col-12 mb-2">
                                            <select name="company_profile_id" id="filterCompanyMobile"
                                                class="form-control select2">
                                                <option value="">Semua Perusahaan</option>
                                                @foreach ($companies as $company)
                                                    <option value="{{ $company->id }}"
                                                        {{ request('company_profile_id') == $company->id ? 'selected' : '' }}>
                                                        {{ $company->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-6 mb-2">
                                            <select name="kategori" class="form-control">
                                                <option value="">Semua Kategori</option>
                                                @foreach ($categories as $cat)
                                                    <option value="{{ $cat }}"
                                                        {{ request('kategori') == $cat ? 'selected' : '' }}>
                                                        {{ $cat }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-6 mb-2">
                                            <select name="legalitas" class="form-control">
                                                <option value="">Semua Legalitas</option>
                                                <option value="verified"
                                                    {{ request('legalitas') == 'verified' ? 'selected' : '' }}>
                                                    Terverifikasi</option>
                                                <option value="pending"
                                                    {{ request('legalitas') == 'pending' ? 'selected' : '' }}>Pending
                                                </option>
                                                <option value="rejected"
                                                    {{ request('legalitas') == 'rejected' ? 'selected' : '' }}>Rejected
                                                </option>
                                            </select>
                                        </div>
                                        <div class="col-6 mb-2">
                                            <select name="pembangunan" class="form-control">
                                                <option value="">Semua Status</option>
                                                <option value="Selesai"
                                                    {{ request('pembangunan') == 'Selesai' ? 'selected' : '' }}>Selesai
                                                </option>
                                                <option value="progress"
                                                    {{ request('pembangunan') == 'progress' ? 'selected' : '' }}>
                                                    Progress</option>
                                                <option value="Belum"
                                                    {{ request('pembangunan') == 'Belum' ? 'selected' : '' }}>Belum
                                                </option>
                                            </select>
                                        </div>
                                        <div class="col-6 mb-2">
                                            <div class="d-flex gap-2">
                                                <button type="submit" class="btn btn-gradient-primary btn-icon-only flex-fill"
                                                    title="Filter">
                                                    <i class="mdi mdi-filter"></i>
                                                </button>
                                                <a href="{{ route('properti-all') }}"
                                                    class="btn btn-gradient-secondary btn-icon-only flex-fill btn-reset"
                                                    title="Reset">
                                                    <i class="mdi mdi-refresh"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead>
                                    <th class="text-center">No</th>
                                    <th class="sort-th" onclick="handleSort('company_profile_id')">Nama Properti <i
                                            class="mdi {{ sortIcon('company_profile_id') }}"></i></th>
                                    <th class="sort-th" onclick="handleSort('name')">Nama Perusahaan <i
                                            class="mdi {{ sortIcon('name') }}"></i></th>
                                    <th class="sort-th" onclick="handleSort('zoning')">Kategori <i
                                            class="mdi {{ sortIcon('zoning') }}"></i></th>
                                    <th class="d-none d-md-table-cell sort-th" onclick="handleSort('address')">Lokasi <i
                                            class="mdi {{ sortIcon('address') }}"></i></th>
                                    <th class="sort-th" onclick="handleSort('acquisition_price')">Harga Beli <i
                                            class="mdi {{ sortIcon('acquisition_price') }}"></i></th>
                                    <th class="sort-th" onclick="handleSort('legal_status')">Legalitas <i
                                            class="mdi {{ sortIcon('legal_status') }}"></i></th>
                                    <th class="sort-th" onclick="handleSort('development_status')">Pembangunan <i
                                            class="mdi {{ sortIcon('development_status') }}"></i></th>
                                    <th class="text-center">Dokumen</th>
                                    <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($landBanks as $index => $item)
                                        <tr>
                                            <td class="text-center fw-bold">{{ $landBanks->firstItem() + $index }}</td>
                                            <td>
                                                <div class="property-info">
                                                    <i class="mdi mdi-home-city text-primary"
                                                        style="font-size: 1.2rem;"></i>
                                                    <span class="fw-bold">{{ Str::limit($item->name, 25) }}</span>
                                                </div>
                                                <small class="text-muted d-block d-md-none mt-1"><i
                                                        class="mdi mdi-map-marker me-1"></i>{{ Str::limit($item->address ?? '-', 15) }}</small>
                                            </td>
                                            <td>
                                                <div class="company-info">
                                                    <i class="mdi mdi-domain text-primary"
                                                        style="font-size: 1.15rem;"></i>
                                                    <span class="fw-bold">{{ $item->companyProfile->name ?? '-' }}</span>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="badge-category"><i
                                                        class="mdi mdi-shape-outline"></i>{{ $item->zoning ?? 'Tanah' }}</span>
                                            </td>
                                            <td class="d-none d-md-table-cell">
                                                <div class="location-info">
                                                    <i class="mdi mdi-map-marker text-danger"
                                                        style="font-size: 1.15rem;"></i>
                                                    <span class="location-text"
                                                        title="{{ $item->address ?? '-' }}">{{ Str::limit($item->address ?? '-', 20) }}</span>
                                                </div>
                                            </td>
                                            <td class="fw-bold text-success-custom">
                                                <i class="mdi mdi-currency-usd text-success me-1"></i>Rp
                                                {{ number_format($item->acquisition_price, 0, ',', '.') }}
                                            </td>
                                            <td>
                                                @if ($item->legal_status == 'verified')
                                                    <span class="badge-legalitas-verified"><i
                                                            class="mdi mdi-check-circle me-1"></i>Terverifikasi</span>
                                                @elseif ($item->legal_status == 'pending')
                                                    <span class="badge-legalitas-pending"><i
                                                            class="mdi mdi-clock-outline me-1"></i>Pending</span>
                                                @else
                                                    <span class="badge-legalitas-rejected"><i
                                                            class="mdi mdi-close-circle me-1"></i>Revisi</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('properti.pengolahanLahan', $item->id) }}" 
                                                   class="btn btn-sm btn-link text-decoration-none p-0"
                                                   title="Buka Halaman Pengolahan Lahan (PJU, Selokan, Jalan, dll)">
                                                    @if (in_array(strtolower($item->development_status), ['selesai', 'done']))
                                                        <span class="badge-development-selesai"><i
                                                                class="mdi mdi-check-circle me-1"></i>Selesai (100%)</span>
                                                    @elseif (in_array(strtolower($item->development_status), ['progress', 'proses']))
                                                        <span class="badge-development-progress"><i
                                                                class="mdi mdi-progress-wrench me-1"></i>Proses ({{ $item->overall_infrastructure_progress }}%)</span>
                                                    @else
                                                        <span class="badge-development-belum"><i
                                                                class="mdi mdi-close-circle me-1"></i>Belum ({{ $item->overall_infrastructure_progress }}%)</span>
                                                    @endif
                                                </a>
                                            </td>
                                            <td class="text-center">
                                                <button type="button" class="document-trigger" data-bs-toggle="modal"
                                                    data-bs-target="#modalDokumen{{ $item->id }}">
                                                    <i
                                                        class="mdi mdi-file-document-multiple-outline"></i>{{ $item->merged_documents->count() }}
                                                </button>
                                            </td>
                                            <td class="text-center">
                                                @if ($item->isFromPraLandbank())
                                                    <span class="action-text action-text-verified"><i
                                                            class="mdi mdi-check-circle me-1"></i>Sudah Verifikasi</span>
                                                @elseif ($item->merged_documents->count() == 0)
                                                    <span class="action-text action-text-verified"><i
                                                            class="mdi mdi-check-circle me-1"></i>Sudah Verifikasi</span>
                                                @elseif($item->merged_documents->contains('status', 'rejected'))
                                                    <span class="action-text action-text-rejected"><i
                                                            class="mdi mdi-close-circle me-1"></i>Ditolak</span>
                                                @elseif($item->merged_documents->every(fn($d) => $d->status == 'verified'))
                                                    <span class="action-text action-text-verified"><i
                                                            class="mdi mdi-check-circle me-1"></i>Sudah Verifikasi</span>
                                                @else
                                                    <a href="{{ route('properti.verifikasi', $item->id) }}"
                                                        class="action-text action-text-verify btn-verifikasi">
                                                        <i class="mdi mdi-check-decagram me-1"></i>Verifikasi
                                                    </a>
                                                @endif
                                                <a href="{{ route('properti.pengolahanLahan', $item->id) }}" 
                                                   class="btn-action fase1 ms-1" 
                                                   title="Kelola Pengolahan Lahan (PJU, Selokan, Jalan, dll)">
                                                    <i class="mdi mdi-wrench"></i>
                                                </a>
                                                <a href="{{ route('properti.edit', $item->id) }}" class="btn-action edit ms-1" title="Edit Properti">
                                                    <i class="mdi mdi-pencil"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="10" class="text-center text-muted py-4">
                                                <i class="mdi mdi-information-outline me-2"></i> Belum ada data properti
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        @if ($landBanks->count() > 0)
                            <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mt-4">
                                <div class="pagination-info mb-2 mb-sm-0">
                                    Menampilkan {{ $landBanks->firstItem() }} - {{ $landBanks->lastItem() }} dari
                                    {{ $landBanks->total() }} data
                                </div>
                                <nav aria-label="Page navigation">
                                    <ul class="pagination pagination-sm flex-wrap justify-content-center mb-0">
                                        @if ($landBanks->onFirstPage())
                                            <li class="page-item disabled"><span class="page-link"><i
                                                        class="mdi mdi-chevron-left"></i></span></li>
                                        @else
                                            <li class="page-item">
                                                <a class="page-link prev-next-btn"
                                                    href="{{ $landBanks->previousPageUrl() }}">
                                                    <i class="mdi mdi-chevron-left"></i>
                                                </a>
                                            </li>
                                        @endif

                                        @foreach ($landBanks->getUrlRange(1, $landBanks->lastPage()) as $page => $url)
                                            <li
                                                class="page-item {{ $landBanks->currentPage() == $page ? 'active' : '' }}">
                                                <a class="page-link {{ $landBanks->currentPage() == $page ? '' : 'page-click' }}"
                                                    href="{{ $url }}">{{ $page }}</a>
                                            </li>
                                        @endforeach

                                        @if ($landBanks->hasMorePages())
                                            <li class="page-item">
                                                <a class="page-link prev-next-btn"
                                                    href="{{ $landBanks->nextPageUrl() }}">
                                                    <i class="mdi mdi-chevron-right"></i>
                                                </a>
                                            </li>
                                        @else
                                            <li class="page-item disabled"><span class="page-link"><i
                                                        class="mdi mdi-chevron-right"></i></span></li>
                                        @endif
                                    </ul>
                                </nav>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>

    @foreach ($landBanks as $item)
        <div class="modal fade" id="modalDokumen{{ $item->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><i class="mdi mdi-file-document-multiple-outline me-2"></i>Detail Dokumen
                            Properti</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @if ($item->fee_document_verification)
                            <!-- FEE VERIFIKASI DOKUMEN -->
                            <div class="alert alert-success border-0 p-3 mb-4 d-flex align-items-center" 
                                 style="background-color: #ebfbee; border-radius: 12px; border-left: 4px solid #2e7d32 !important; margin: 0 4px 20px 4px;">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="rounded-circle bg-white d-flex align-items-center justify-content-center" style="width: 42px; height: 42px; box-shadow: 0 2px 4px rgba(46, 125, 50, 0.1);">
                                        <i class="mdi mdi-cash-multiple text-success" style="font-size: 1.4rem; color: #2e7d32 !important;"></i>
                                    </div>
                                    <div>
                                        <div class="text-muted small fw-semibold" style="font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px;">Fee Dokumen Verifikasi Pasca</div>
                                        <div class="text-success fw-bold" style="font-size: 1.25rem; color: #2e7d32 !important; font-weight: 800;">
                                            Rp {{ number_format($item->fee_document_verification, 0, ',', '.') }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- DAFTAR DOKUMEN -->
                        <div class="card border-0 shadow-sm mb-4">
                            <div class="card-header bg-light fw-bold">
                                <i class="mdi mdi-file-document-outline me-2 text-primary"></i>
                                Daftar Dokumen
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive" style="max-height: unset;">
                                    @if ($item->merged_documents->count() > 0)
                                        <table class="table table-hover mb-0">
                                            <thead class="table-light">
                                                <tr>
                                                    <th width="5%" class="text-center">No</th>
                                                    <th width="25%">Nomor Dokumen</th>
                                                    <th>Nama Dokumen</th>
                                                    <th width="15%" class="text-center">Status</th>
                                                    <th width="12%" class="text-center">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($item->merged_documents as $idx => $doc)
                                                    <tr>
                                                        <td class="text-center">{{ $idx + 1 }}</td>
                                                        <td class="fw-bold">{{ $doc->document_number ?? '-' }}</td>
                                                        <td>
                                                            <div class="d-flex align-items-center gap-2">
                                                                <i class="mdi mdi-file-{{ $doc->type == 'sertifikat' ? 'certificate' : 'document' }}-outline text-primary"
                                                                    style="font-size: 1.2rem;"></i>
                                                                <span class="fw-semibold text-dark">{{ $doc->documentType->name ?? '-' }}</span>
                                                            </div>
                                                            @if ($doc->status === 'rejected')
                                                                <div class="alert alert-danger border-0 p-2 mt-2 mb-0 d-flex align-items-start gap-2 text-danger small" style="background-color: #fff5f5; border-radius: 8px; font-weight: 500;">
                                                                    <i class="mdi mdi-alert-circle text-danger mt-0.5" style="font-size: 1.1rem; line-height: 1;"></i>
                                                                    <div>
                                                                        <strong class="text-danger">Alasan Penolakan:</strong> 
                                                                        <span class="text-muted d-block mt-0.5" style="font-weight: normal; line-height: 1.4;">{{ $doc->admin_notes ?? 'Tidak ada catatan khusus.' }}</span>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        </td>
                                                        <td class="text-center">
                                                            @if ($item->isFromPraLandbank())
                                                                <span class="badge rounded-pill bg-success px-3 py-2"><i
                                                                        class="mdi mdi-check-circle me-1"></i>Terverifikasi</span>
                                                            @elseif ($doc->status == 'pending')
                                                                <span
                                                                    class="badge rounded-pill bg-warning text-dark px-3 py-2"><i
                                                                        class="mdi mdi-clock-outline me-1"></i>Pending</span>
                                                            @elseif($doc->status == 'rejected')
                                                                <span class="badge rounded-pill bg-danger px-3 py-2"><i
                                                                        class="mdi mdi-close-circle me-1"></i>Ditolak</span>
                                                            @elseif($doc->status == 'verified')
                                                                <span class="badge rounded-pill bg-success px-3 py-2"><i
                                                                        class="mdi mdi-check-circle me-1"></i>Terverifikasi</span>
                                                            @endif
                                                        </td>
                                                        <td class="text-center">
                                                            <a href="{{ asset(str_starts_with($doc->file_path, 'uploads/') ? $doc->file_path : 'uploads/' . $doc->file_path) }}"
                                                                target="_blank" class="btn-outline-purple px-2 py-1" title="Lihat">
                                                                <i class="mdi mdi-eye m-0"></i>
                                                            </a>
                                                             @php
                                                                 $ext = pathinfo($doc->file_path, PATHINFO_EXTENSION);
                                                                 $cleanDocName = str_replace(' ', '_', $doc->documentType->name ?? 'Dokumen');
                                                                 $cleanPropName = str_replace(' ', '_', $item->name);
                                                                 $downloadName = $cleanDocName . '_' . $cleanPropName . '.' . $ext;
                                                                 $filePathUrl = asset(str_starts_with($doc->file_path, 'uploads/') ? $doc->file_path : 'uploads/' . $doc->file_path);
                                                             @endphp
                                                             @if($item->isFromPraLandbank() || $doc->status != 'rejected')
                                                                 <a href="{{ $filePathUrl }}"
                                                                     download="{{ $downloadName }}" class="btn-outline-green px-2 py-1 ms-1" title="Download">
                                                                     <i class="mdi mdi-download m-0"></i>
                                                                 </a>
                                                             @endif
                                                             @if(!$item->isFromPraLandbank() && $doc->status == 'rejected')
                                                                 <button type="button" 
                                                                     class="btn-outline-red px-2 py-1 ms-1 btn-revisi-trigger" 
                                                                     data-doc-id="{{ $doc->id }}" 
                                                                     data-doc-name="{{ $doc->documentType->name ?? 'Dokumen' }}"
                                                                     data-doc-reason="{{ $doc->admin_notes ?? 'Tidak ada catatan khusus.' }}"
                                                                     data-property-id="{{ $item->id }}"
                                                                     title="Upload Revisi">
                                                                     <i class="mdi mdi-upload m-0"></i>
                                                                 </button>
                                                             @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    @else
                                        <div class="text-center text-muted py-5">
                                            <i class="mdi mdi-file-document-outline"
                                                style="font-size: 3rem; opacity: 0.3;"></i>
                                            <p class="mt-2 mb-0">Tidak ada dokumen.</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- UPLOAD REVISI FORM (COLLAPSED BY DEFAULT) -->
                        <div class="card border-0 shadow-sm mb-4 d-none" id="revisionCard{{ $item->id }}">
                            <div class="card-header bg-soft-danger fw-bold text-danger d-flex align-items-center justify-content-between p-3" style="border-radius: 12px 12px 0 0;">
                                <span>
                                    <i class="mdi mdi-cloud-upload-outline me-2"></i>
                                    Form Upload Revisi Dokumen: <span id="revisionDocName{{ $item->id }}" class="text-dark"></span>
                                </span>
                                <button type="button" class="btn-close-revision" data-target="#revisionCard{{ $item->id }}" style="background: none; border: none; font-size: 1.5rem; color: #dc3545; cursor: pointer; font-weight: bold;">&times;</button>
                            </div>
                            <div class="card-body p-4">
                                <form action="#" method="POST" enctype="multipart/form-data" id="revisionForm{{ $item->id }}">
                                    @csrf
                                    <!-- Hidden input for document ID -->
                                    <input type="hidden" name="document_id" id="revisionDocId{{ $item->id }}">
                                    

                                    <div class="row">
                                        <div class="col-md-6 mb-3 text-start">
                                            <label class="form-label fw-bold text-muted small mb-2 d-block" style="color: #9a55ff !important;">Nomor Dokumen Baru <span class="text-danger">*</span></label>
                                            <input type="text" name="document_number" class="form-control" placeholder="Masukkan nomor dokumen baru" required style="border-radius: 10px; padding: 0.7rem 0.8rem; font-size: 0.85rem; border: 1px solid #e9ecef; width: 100%;">
                                        </div>
                                        <div class="col-md-6 mb-3 text-start">
                                            <label class="form-label fw-bold text-muted small mb-2 d-block" style="color: #9a55ff !important;">Pilih File Baru (PDF/Gambar) <span class="text-danger">*</span></label>
                                            <div class="properti-file-upload-modern">
                                                <input type="file" name="file_dokumen" id="fileRevision{{ $item->id }}" class="properti-file-input-modern" accept=".pdf,.jpg,.jpeg,.png" required>
                                                <label for="fileRevision{{ $item->id }}" class="properti-file-label-modern w-100">
                                                    <div class="properti-file-info-modern">
                                                        <i class="mdi mdi-cloud-upload-outline properti-file-icon-modern" style="font-size: 1.8rem;"></i>
                                                        <span class="d-block mt-1">Pilih File Revisi</span>
                                                        <small class="properti-file-size d-block text-muted mt-1"></small>
                                                    </div>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-end gap-2 mt-3">
                                        <button type="button" class="btn btn-gradient-secondary btn-sm px-4 btn-close-revision" data-target="#revisionCard{{ $item->id }}" style="border-radius: 8px;">Batal</button>
                                        <button type="submit" class="btn btn-gradient-primary btn-sm px-4" style="border-radius: 8px;">
                                            <i class="mdi mdi-check-circle-outline me-1"></i>Kirim Revisi
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">
                            <i class="mdi mdi-close me-1"></i>Tutup
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

@endsection

@push('scripts')


    <script>

        function showLoading(message = 'Memproses data...') {
            Swal.fire({
                title: message,
                text: 'Mohon tunggu sebentar',
                allowOutsideClick: false,
                allowEscapeKey: false,
                showConfirmButton: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
        }

        function handleSort(column) {
            let currentSort = $('#sort_by').val();
            let currentOrder = $('#sort_order').val();
            let newOrder = 'asc';

            if (currentSort === column) {
                newOrder = currentOrder === 'asc' ? 'desc' : 'asc';
            }

            $('#sort_by').val(column);
            $('#sort_order').val(newOrder);

            showLoading('Mengurutkan data...');
            $('#filterForm').submit();
        }

        $(document).ready(function() {
            // Handle pagination clicks
            $('.page-click, .prev-next-btn').on('click', function(e) {
                e.preventDefault();
                let url = $(this).attr('href');
                if (url) {
                    showLoading('Memindahkan halaman...');
                    window.location.href = url;
                }
            });

            // Handle reset button
            $('.btn-reset').on('click', function(e) {
                e.preventDefault();
                showLoading('Mereset data...');
                window.location.href = $(this).attr('href');
            });

            // Handle show per page changes
            $('#showSelect, #showSelectMobile').on('change', function() {
                showLoading('Mengubah jumlah data...');
                $('#filterForm').submit();
            });

            // Handle form submission for filter and search
            $('#filterForm').on('submit', function(e) {
                // Get search values from both inputs
                let searchDesktop = $('#searchInput').val();
                let searchMobile = $('#searchInputMobile').val();

                // Use the non-empty search value
                let searchValue = searchDesktop || searchMobile;

                // Set the search input value to the combined value
                if (searchValue) {
                    $('#searchInput').val(searchValue);
                    $('#searchInputMobile').val(searchValue);
                } else {
                    // If empty, remove the search parameter
                    $('#searchInput').val('');
                    $('#searchInputMobile').val('');
                }

                // Show loading based on action
                let searchTerm = searchValue ? searchValue.trim() : '';
                if (searchTerm !== '') {
                    showLoading('Mencari data...');
                } else {
                    showLoading('Menyaring data...');
                }

                // Let the form submit normally
                return true;
            });

            // Sync search inputs between desktop and mobile
            $('#searchInput').on('input', function() {
                $('#searchInputMobile').val($(this).val());
            });

            $('#searchInputMobile').on('input', function() {
                $('#searchInput').val($(this).val());
            });

            // Initialize Select2 for desktop
            $('#filterCompany').select2({
                theme: 'bootstrap-5',
                width: '100%',
                placeholder: 'Semua Perusahaan',
                allowClear: true,
                minimumResultsForSearch: 0,
                dropdownCssClass: 'select2-limited-items',
                language: {
                    noResults: function() {
                        return "Perusahaan tidak ditemukan";
                    },
                    searching: function() {
                        return "Mencari...";
                    }
                }
            });

            // Initialize Select2 for mobile
            $('#filterCompanyMobile').select2({
                theme: 'bootstrap-5',
                width: '100%',
                placeholder: 'Semua Perusahaan',
                allowClear: true,
                minimumResultsForSearch: 0,
                dropdownCssClass: 'select2-limited-items',
                dropdownParent: $('#filterCompanyMobile').parent(),
                language: {
                    noResults: function() {
                        return "Perusahaan tidak ditemukan";
                    },
                    searching: function() {
                        return "Mencari...";
                    }
                }
            });

            // Sync Select2 between desktop and mobile
            $('#filterCompany').on('change', function() {
                $('#filterCompanyMobile').val($(this).val()).trigger('change');
            });

            $('#filterCompanyMobile').on('change', function() {
                $('#filterCompany').val($(this).val()).trigger('change');
            });

            // Handle verification button (shows loader instantly upon click)
            $('.btn-verifikasi').on('click', function(e) {
                showLoading('Memverifikasi properti...');
            });

            // Trigger Revision Form
            $('.btn-revisi-trigger').on('click', function() {
                let docId = $(this).data('doc-id');
                let docName = $(this).data('doc-name');
                let propertyId = $(this).data('property-id');
                
                let card = $('#revisionCard' + propertyId);
                $('#revisionDocId' + propertyId).val(docId);
                $('#revisionDocName' + propertyId).text(docName);
                
                // Set form action dynamically
                let formAction = "{{ route('dokumen.update', ':id') }}".replace(':id', docId);
                $('#revisionForm' + propertyId).attr('action', formAction);
                
                // Show revision card
                card.removeClass('d-none');
                
                // Smooth scroll to the form card inside modal body
                let modalBody = $(this).closest('.modal-body');
                modalBody.animate({
                    scrollTop: card.offset().top - modalBody.offset().top + modalBody.scrollTop()
                }, 500);
            });

            // Close/Batal Revision Form
            $('.btn-close-revision').on('click', function() {
                let target = $(this).data('target');
                $(target).addClass('d-none');
            });

            // Handle file input preview for revision files
            $('.properti-file-input-modern').on('change', function(e) {
                const fileName = e.target.files[0]?.name;
                const fileSize = e.target.files[0]?.size;
                const label = $(this).next('.properti-file-label-modern').find('.properti-file-info-modern span');
                const sizeSpan = $(this).next('.properti-file-label-modern').find('.properti-file-info-modern .properti-file-size');

                if (fileName) {
                    label.text(fileName.length > 30 ? fileName.substring(0, 30) + '...' : fileName);
                    if (fileSize) {
                        const sizeInMB = (fileSize / (1024 * 1024)).toFixed(2);
                        sizeSpan.text(sizeInMB + ' MB');
                    }
                } else {
                    label.text('Pilih File Revisi');
                    sizeSpan.text('');
                }
            });

            window.formatRupiahEdit = function(input) {
                let value = input.value.replace(/\D/g, '');
                if (value) {
                    value = parseInt(value).toLocaleString('id-ID');
                    input.value = value;
                }
            }

            // Handle session flash messages with beautiful SweetAlert
            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: "{{ session('success') }}",
                    confirmButtonColor: '#9a55ff'
                });
            @endif

            @if (session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: "{{ session('error') }}",
                    confirmButtonColor: '#dc3545'
                });
            @endif
        });
    </script>
@endpush
