@extends('layouts.partial.app')

@push('styles')
<style>
    /* Modern File Upload (Sama seperti Proses Pra Tanah & Modul Lain) */
    .pratanah-file-upload-modern {
        position: relative;
        width: 100%;
    }
    .pratanah-file-upload-modern input[type="file"] {
        position: absolute;
        opacity: 0;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        cursor: pointer;
        z-index: 2;
    }
    .pratanah-file-label-modern {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 0.5rem 0.75rem;
        background: #f8fafc;
        border: 1.5px dashed #cbd5e1;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.25s ease;
    }
    .pratanah-file-upload-modern:hover .pratanah-file-label-modern {
        border-color: #9a55ff;
        background: #f5f3ff;
    }
    .pratanah-file-label-modern i {
        font-size: 1.15rem;
        color: #9a55ff;
        background: rgba(154, 85, 255, 0.12);
        padding: 5px;
        border-radius: 50%;
        flex-shrink: 0;
    }
    .pratanah-file-info-modern {
        flex: 1;
        overflow: hidden;
        min-width: 0;
    }
    .pratanah-file-info-modern .file-label-text {
        display: block;
        font-weight: 600;
        color: #334155;
        font-size: 0.76rem;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .pratanah-file-info-modern .file-label-hint {
        display: block;
        color: #94a3b8;
        font-size: 0.68rem;
    }
</style>
@endpush

@section('content')

<div class="container-fluid px-1 px-sm-2 px-md-3 py-2 py-md-3">

    <!-- Header Card Banner -->
    <div class="row mb-3 mb-md-4">
        <div class="col-12">
            <div class="card shadow-sm border-0 header-card">
                <div class="card-body p-4 p-md-4 py-4 py-md-4 d-flex justify-content-between align-items-center" style="min-height: 105px;">
                    <div>
                        <h3 class="text-dark mb-1 fw-bold" style="font-size: 1.35rem;">
                            Master Data Perusahaan (PT)
                        </h3>
                        <p class="text-muted mb-0" style="font-size: 0.9rem;">
                            Kelola data legalitas entitas perusahaan dan developer properti
                        </p>
                    </div>
                    <div class="d-none d-sm-block pe-2">
                        <i class="mdi mdi-domain" style="font-size: 3rem; color: #9a55ff; opacity: 0.25;"></i>
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
                        <i class="mdi mdi-format-list-bulleted me-2"></i>Daftar Perusahaan (PT)
                    </h5>
                    <button type="button" class="btn btn-sm btn-gradient-primary d-flex align-items-center gap-1 shadow-sm" onclick="openModal('tambah')">
                        <i class="mdi mdi-plus-circle" style="font-size: 1rem;"></i>
                        <span>Tambah Perusahaan</span>
                    </button>
                </div>

                <div class="card-body">
                    <!-- Filter Section -->
                    <div class="filter-card mb-3">
                        <!-- Desktop Version -->
                        <div class="filter-row-desktop d-none d-md-block">
                            <form id="filterForm" method="GET" action="{{ route('company-profile.index') }}" onsubmit="return showFilterLoading()">
                                <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 w-100">
                                    <div class="d-flex flex-wrap align-items-center gap-2 flex-grow-1">
                                        <div style="min-width: 260px; max-width: 380px; flex: 1;">
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="search" id="searchInput"
                                                    placeholder="Cari nama perusahaan..."
                                                    value="{{ request('search') }}"
                                                    style="border-top-right-radius: 0 !important; border-bottom-right-radius: 0 !important; border-right: none;">
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
                                            <select class="form-control" name="per_page" id="perPageSelect">
                                                <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10 data</option>
                                                <option value="15" {{ request('per_page', 15) == 15 ? 'selected' : '' }}>15 data</option>
                                                <option value="25" {{ request('per_page', 25) == 25 ? 'selected' : '' }}>25 data</option>
                                                <option value="50" {{ request('per_page', 50) == 50 ? 'selected' : '' }}>50 data</option>
                                            </select>
                                        </div>

                                        <button type="submit" class="btn btn-gradient-primary btn-icon-only" title="Filter">
                                            <i class="mdi mdi-filter"></i>
                                        </button>
                                        <a href="{{ route('company-profile.index') }}" class="btn btn-gradient-secondary btn-icon-only" title="Reset" onclick="showResetLoading(event)">
                                            <i class="mdi mdi-refresh"></i>
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <!-- Mobile Version -->
                        <div class="filter-row-mobile d-block d-md-none">
                            <form method="GET" action="{{ route('company-profile.index') }}" onsubmit="return showFilterLoading()">
                                <div class="row g-2">
                                    <div class="col-12 mb-2">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="search" id="searchInputMobile"
                                                placeholder="Cari nama perusahaan..."
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
                                        <select class="form-control" name="per_page" id="perPageSelectMobile">
                                            <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10 data</option>
                                            <option value="15" {{ request('per_page', 15) == 15 ? 'selected' : '' }}>15 data</option>
                                            <option value="25" {{ request('per_page', 25) == 25 ? 'selected' : '' }}>25 data</option>
                                            <option value="50" {{ request('per_page', 50) == 50 ? 'selected' : '' }}>50 data</option>
                                        </select>
                                    </div>

                                    <div class="col-6">
                                        <button type="submit" class="btn btn-gradient-primary w-100 d-flex align-items-center justify-content-center gap-1">
                                            <i class="mdi mdi-filter"></i> Filter
                                        </button>
                                    </div>
                                    <div class="col-6">
                                        <a href="{{ route('company-profile.index') }}" class="btn btn-gradient-secondary w-100 d-flex align-items-center justify-content-center gap-1" onclick="showResetLoading(event)">
                                            <i class="mdi mdi-refresh"></i> Reset
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Tabel Data Perusahaan -->
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="sortable" data-field="name" data-direction="{{ request('sortField') == 'name' ? (request('sortDirection') == 'asc' ? 'desc' : 'asc') : 'asc' }}">
                                        Nama Perusahaan (PT)
                                        @if(request('sortField') == 'name')
                                            <i class="mdi mdi-{{ request('sortDirection') == 'asc' ? 'arrow-up' : 'arrow-down' }}"></i>
                                        @else
                                            <i class="mdi mdi-swap-vertical"></i>
                                        @endif
                                    </th>
                                    <th class="sortable" data-field="address" data-direction="{{ request('sortField') == 'address' ? (request('sortDirection') == 'asc' ? 'desc' : 'asc') : 'asc' }}">
                                        Alamat Kantor
                                        @if(request('sortField') == 'address')
                                            <i class="mdi mdi-{{ request('sortDirection') == 'asc' ? 'arrow-up' : 'arrow-down' }}"></i>
                                        @else
                                            <i class="mdi mdi-swap-vertical"></i>
                                        @endif
                                    </th>
                                    <th class="sortable" data-field="phone" data-direction="{{ request('sortField') == 'phone' ? (request('sortDirection') == 'asc' ? 'desc' : 'asc') : 'asc' }}">
                                        No. Telepon
                                        @if(request('sortField') == 'phone')
                                            <i class="mdi mdi-{{ request('sortDirection') == 'asc' ? 'arrow-up' : 'arrow-down' }}"></i>
                                        @else
                                            <i class="mdi mdi-swap-vertical"></i>
                                        @endif
                                    </th>
                                    <th class="sortable text-center" data-field="land_banks_count" data-direction="{{ request('sortField') == 'land_banks_count' ? (request('sortDirection') == 'asc' ? 'desc' : 'asc') : 'asc' }}">
                                        Jumlah Proyek
                                        @if(request('sortField') == 'land_banks_count')
                                            <i class="mdi mdi-{{ request('sortDirection') == 'asc' ? 'arrow-up' : 'arrow-down' }}"></i>
                                        @else
                                            <i class="mdi mdi-swap-vertical"></i>
                                        @endif
                                    </th>
                                    <th class="text-center">Legalitas PT</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($companies as $index => $company)
                                    @php
                                        $cName = $company->name ?? '-';
                                        $nameParts = explode(' ', trim(str_replace(['PT.', 'PT', 'pt.', 'pt'], '', $cName)));
                                        $initials = strtoupper(substr($nameParts[0] ?? '', 0, 1) . substr($nameParts[1] ?? '', 0, 1));
                                        if (trim($initials) == '') {
                                            $initials = 'PT';
                                        }
                                        $legCount = $company->uploaded_legal_docs_count;
                                    @endphp
                                    <tr>
                                        <td class="text-center fw-bold">{{ $companies->firstItem() + $index }}</td>
                                        <td>
                                            <div class="info-inline">
                                                <span class="initial-avatar">{{ $initials }}</span>
                                                <div>
                                                    <span class="fw-bold d-block text-dark">{{ $cName }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="d-inline-flex align-items-center gap-1 text-muted" title="{{ $company->address }}">
                                                <i class="mdi mdi-map-marker text-danger"></i>
                                                <span>{{ Str::limit($company->address ?: '-', 45) }}</span>
                                            </span>
                                        </td>
                                        <td>
                                            <span class="d-inline-flex align-items-center gap-1 text-success fw-medium">
                                                <i class="mdi mdi-phone"></i>
                                                <span>{{ $company->phone ?: '-' }}</span>
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <span class="badge bg-primary bg-opacity-10 text-primary fw-semibold px-2 py-1 border border-primary border-opacity-25" style="font-size: 0.78rem;">
                                                <i class="mdi mdi-office-building me-1"></i>{{ $company->land_banks_count }} Proyek
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            @if($legCount == 6)
                                                <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 px-2 py-1" style="font-size: 0.78rem;" title="Semua 6 Berkas Legalitas PT Lengkap">
                                                    <i class="mdi mdi-shield-check me-1"></i>Lengkap (6/6)
                                                </span>
                                            @elseif($legCount > 0)
                                                <span class="badge bg-warning bg-opacity-10 text-warning-emphasis border border-warning border-opacity-50 px-2 py-1" style="font-size: 0.78rem;" title="Baru {{ $legCount }} dari 6 Berkas Legalitas Terunggah">
                                                    <i class="mdi mdi-clock-outline me-1"></i>{{ $legCount }}/6 Berkas
                                                </span>
                                            @else
                                                <span class="badge bg-secondary bg-opacity-10 text-muted border px-2 py-1" style="font-size: 0.78rem;" title="Belum Ada Berkas Legalitas">
                                                    <i class="mdi mdi-alert-circle-outline me-1"></i>Belum Ada
                                                </span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <div class="d-inline-flex align-items-center gap-1">
                                                <button class="btn-action edit" title="Edit Perusahaan & Berkas Legalitas" onclick="openModal('edit', {{ $company->id }})">
                                                    <i class="mdi mdi-pencil"></i>
                                                </button>
                                                <button class="btn-action delete" title="Hapus Perusahaan" onclick="confirmDelete({{ $company->id }})">
                                                    <i class="mdi mdi-trash-can-outline"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center text-muted py-4">
                                            <i class="mdi mdi-domain-off me-2" style="font-size: 1.5rem;"></i>
                                            Belum ada data perusahaan (PT) yang tersimpan.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if ($companies instanceof \Illuminate\Pagination\LengthAwarePaginator && $companies->total() > 0)
                        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mt-4">
                            <div class="pagination-info mb-2 mb-sm-0 text-muted" style="font-size: 0.82rem;">
                                Menampilkan {{ $companies->firstItem() }} - {{ $companies->lastItem() }} dari {{ $companies->total() }} data
                            </div>
                            <nav aria-label="Page navigation">
                                <ul class="pagination pagination-sm flex-wrap justify-content-center mb-0">
                                    <li class="page-item {{ $companies->onFirstPage() ? 'disabled' : '' }}">
                                        <a class="page-link" href="{{ $companies->previousPageUrl() }}" {{ !$companies->onFirstPage() ? 'onclick=showPaginationLoading(event)' : '' }}>
                                            <i class="mdi mdi-chevron-left"></i>
                                        </a>
                                    </li>

                                    @for($page = 1; $page <= $companies->lastPage(); $page++)
                                        <li class="page-item {{ $page == $companies->currentPage() ? 'active' : '' }}">
                                            @if($page == $companies->currentPage())
                                                <span class="page-link">{{ $page }}</span>
                                            @else
                                                <a class="page-link" href="{{ $companies->appends(request()->query())->url($page) }}" onclick="showPaginationLoading(event)">{{ $page }}</a>
                                            @endif
                                        </li>
                                    @endfor

                                    <li class="page-item {{ $companies->hasMorePages() ? '' : 'disabled' }}">
                                        <a class="page-link" href="{{ $companies->nextPageUrl() }}" {{ $companies->hasMorePages() ? 'onclick=showPaginationLoading(event)' : '' }}>
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

<!-- Modal Tambah/Edit Perusahaan -->
<div class="modal fade" id="modalPerusahaan" tabindex="-1" aria-labelledby="modalPerusahaanLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 620px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalPerusahaanLabel">
                    <i class="mdi mdi-plus-circle me-2" id="modalIcon"></i>
                    <span id="modalTitle">Tambah Perusahaan</span>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formPerusahaan" method="POST" action="{{ route('company-profile.store') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_method" id="methodField" value="POST">
                <input type="hidden" id="perusahaanId" name="id">

                <div class="modal-body p-3 p-md-4">
                    <!-- Data Umum Perusahaan -->
                    <div class="row">
                        <div class="col-md-7 mb-3">
                            <label class="form-label fw-bold" style="color: #2c2e3f; font-size: 0.85rem;">Nama Perusahaan (PT) <span class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-sm" name="name" id="namaPerusahaan" placeholder="Contoh: PT. Graha Cipta Sejahtera" value="{{ old('name') }}" required style="height: 38px;">
                        </div>
                        <div class="col-md-5 mb-3">
                            <label class="form-label fw-bold" style="color: #2c2e3f; font-size: 0.85rem;">Nomor Telepon</label>
                            <input type="text" class="form-control form-control-sm" name="phone" id="nomorTelepon" placeholder="Contoh: 0331-331447" value="{{ old('phone') }}" style="height: 38px;">
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label fw-bold" style="color: #2c2e3f; font-size: 0.85rem;">Alamat Kantor</label>
                            <textarea class="form-control" name="address" id="alamat" rows="2" placeholder="Jl. Letjen Sutoyo No. 99 A Jember" style="font-size: 0.85rem;">{{ old('address') }}</textarea>
                        </div>
                    </div>

                    <!-- BERKAS LEGALITAS PT (6 DOKUMEN SESUAI SOP NOTARIS & BPN) -->
                    <div class="border-top pt-3 mt-1">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <div>
                                <h6 class="fw-bold text-dark mb-0 d-flex align-items-center gap-1" style="font-size: 0.9rem;">
                                    <i class="mdi mdi-shield-account text-purple"></i> Dokumen Legalitas PT (SOP Poin 3)
                                </h6>
                                <small class="text-muted" style="font-size: 0.73rem;">Unggah 6 berkas legalitas resmi perusahaan untuk Notaris & BPN.</small>
                            </div>
                            <span class="badge bg-soft-primary text-primary border border-primary-subtle py-1 px-2" style="font-size: 0.72rem;">
                                6 Berkas Wajib
                            </span>
                        </div>

                        <div class="row g-2.5 mt-1">
                            @php
                                $legalDocs = [
                                    ['id' => 'file_akta_pendirian', 'title' => '1. Akta Pendirian PT & AHU', 'hint' => 'Akta Pendirian dan SK Kemenkumham'],
                                    ['id' => 'file_akta_perubahan', 'title' => '2. Akta Perubahan PT & AHU', 'hint' => 'Akta Perubahan Terakhir & SK Kemenkumham'],
                                    ['id' => 'file_npwp',           'title' => '3. NPWP Perusahaan',        'hint' => 'NPWP resmi badan hukum PT'],
                                    ['id' => 'file_direksi',        'title' => '4. Identitas Direksi',      'hint' => 'KTP, NPWP, & KK Direktur'],
                                    ['id' => 'file_nib',            'title' => '5. NIB Perusahaan',         'hint' => 'Nomor Induk Berusaha (OSS RBA)'],
                                    ['id' => 'file_domisili',       'title' => '6. Surat Domisili PT',      'hint' => 'Surat Domisili Desa/Kelurahan'],
                                ];
                            @endphp

                            @foreach($legalDocs as $doc)
                                <div class="col-12 col-sm-6 mb-3">
                                    <div class="d-flex flex-column h-100 justify-content-between">
                                        <div class="mb-1.5">
                                            <label class="form-label fw-bold text-dark mb-0 d-block text-truncate" style="font-size: 0.82rem;" title="{{ $doc['title'] }}">
                                                {{ $doc['title'] }}
                                            </label>
                                            <small class="text-muted d-block text-truncate" style="font-size: 0.7rem;" title="{{ $doc['hint'] }}">
                                                {{ $doc['hint'] }}
                                            </small>
                                        </div>

                                        <div>
                                            <!-- Box Preview Jika Berkas Sudah Ada -->
                                            <div id="box_prev_{{ $doc['id'] }}" class="p-2 rounded-2 mb-1.5 d-none" style="background: #f0fdf4; border: 1.5px solid #86efac;">
                                                <div class="d-flex align-items-center justify-content-between gap-1">
                                                    <div class="d-flex align-items-center gap-1 overflow-hidden">
                                                        <i class="mdi mdi-file-check text-success" style="font-size: 1.05rem;"></i>
                                                        <span class="fw-bold text-success text-truncate" style="font-size: 0.74rem;">Ada Berkas</span>
                                                    </div>
                                                    <a href="#" id="link_prev_{{ $doc['id'] }}" target="_blank" class="btn btn-xs btn-success text-white py-1 px-2 d-inline-flex align-items-center gap-1 shadow-none" style="font-size: 0.7rem; border-radius: 5px;">
                                                        <i class="mdi mdi-eye"></i> Lihat
                                                    </a>
                                                </div>
                                            </div>

                                            <!-- Komponen Upload Modern -->
                                            <div class="pratanah-file-upload-modern">
                                                <input type="file" name="{{ $doc['id'] }}" id="{{ $doc['id'] }}" accept=".pdf,.jpg,.jpeg,.png">
                                                <div class="pratanah-file-label-modern py-1.5 px-2">
                                                    <i class="mdi mdi-cloud-upload"></i>
                                                    <div class="pratanah-file-info-modern">
                                                        <span class="file-label-text" id="label_text_{{ $doc['id'] }}">Pilih File</span>
                                                        <span class="file-label-hint">PDF, JPG, PNG maks 10MB</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm px-3" data-bs-dismiss="modal">
                        Batal
                    </button>
                    <button type="submit" class="btn btn-gradient-primary btn-sm px-4" id="submitBtn" onclick="showSubmitLoading()">
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

    // Live change label untuk upload modern
    $('.pratanah-file-upload-modern input[type="file"]').on('change', function() {
        const file = this.files && this.files.length > 0 ? this.files[0] : null;
        const labelText = $(this).closest('.pratanah-file-upload-modern').find('.file-label-text');
        if (file) {
            labelText.html(`<span class="text-success fw-bold text-truncate d-block"><i class="mdi mdi-file-check me-1"></i>${file.name}</span>`);
        } else {
            labelText.text('Pilih File');
        }
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

function showSubmitLoading() {
    Swal.fire({
        title: 'Mohon tunggu...',
        html: 'Sedang menyimpan data',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });
    return true;
}

function openModal(type, id = null) {
    const fileFields = ['file_akta_pendirian', 'file_akta_perubahan', 'file_npwp', 'file_direksi', 'file_nib', 'file_domisili'];

    if (type === 'tambah') {
        $('#formPerusahaan')[0].reset();
        $('#perusahaanId').val('');
        $('#methodField').val('POST');
        $('#formPerusahaan').attr('action', '{{ route("company-profile.store") }}');

        fileFields.forEach(f => {
            $('#box_prev_' + f).addClass('d-none');
            $('#link_prev_' + f).attr('href', '#');
            $('#label_text_' + f).text('Pilih File');
            $('#' + f).val('');
        });

        $('#modalTitle').text('Tambah Perusahaan');
        $('#modalIcon').removeClass('mdi-pencil').addClass('mdi-plus-circle');
        $('#btnText').text('Simpan');
        $('#btnIcon').removeClass('mdi-pencil').addClass('mdi-content-save');

        $('#modalPerusahaan').modal('show');
    } else {
        Swal.fire({
            title: 'Mohon tunggu...',
            html: 'Sedang mengambil data perusahaan',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        $.get('{{ url("master-data-pt") }}/' + id + '/edit', function(data) {
            Swal.close();

            $('#perusahaanId').val(data.id);
            $('#namaPerusahaan').val(data.name);
            $('#alamat').val(data.address);
            $('#nomorTelepon').val(data.phone);

            fileFields.forEach(f => {
                if (data[f]) {
                    $('#box_prev_' + f).removeClass('d-none');
                    $('#link_prev_' + f).attr('href', '{{ asset("") }}' + data[f]);
                    $('#label_text_' + f).text('Ganti / Upload Ulang');
                } else {
                    $('#box_prev_' + f).addClass('d-none');
                    $('#link_prev_' + f).attr('href', '#');
                    $('#label_text_' + f).text('Pilih File');
                }
                $('#' + f).val('');
            });

            $('#methodField').val('PUT');
            $('#formPerusahaan').attr('action', '{{ url("master-data-pt") }}/' + id);

            $('#modalTitle').text('Edit Perusahaan');
            $('#modalIcon').removeClass('mdi-plus-circle').addClass('mdi-pencil');
            $('#btnText').text('Update');
            $('#btnIcon').removeClass('mdi-content-save').addClass('mdi-pencil');

            $('#modalPerusahaan').modal('show');
        }).fail(function() {
            Swal.close();
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: 'Gagal mengambil data perusahaan',
                confirmButtonColor: '#dc3545'
            });
        });
    }
}

function confirmDelete(id) {
    Swal.fire({
        title: 'Yakin ingin menghapus?',
        text: "Data perusahaan ini akan dihapus permanen!",
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
                html: 'Sedang menghapus data perusahaan',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            setTimeout(() => {
                let form = document.createElement('form');
                form.method = 'POST';
                form.action = '{{ url("master-data-pt") }}/' + id;

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
