@extends('layouts.partial.app')

@section('title', 'Master Data Notaris - Property Management App')

@section('content')

<div class="container-fluid px-1 px-sm-2 px-md-3 py-2 py-md-3">

    <!-- Header Card Banner -->
    <div class="row mb-3 mb-md-4">
        <div class="col-12">
            <div class="card shadow-sm border-0 header-card">
                <div class="card-body p-4 p-md-4 py-4 py-md-4 d-flex justify-content-between align-items-center" style="min-height: 105px;">
                    <div>
                        <h3 class="text-dark mb-1 fw-bold" style="font-size: 1.35rem;">
                            Master Data Notaris
                        </h3>
                        <p class="text-muted mb-0" style="font-size: 0.9rem;">
                            Kelola daftar rekanan notaris &amp; PPAT untuk proses tanah, jadwal tanda tangan akta, dan akad
                        </p>
                    </div>
                    <div class="d-none d-sm-block pe-2">
                        <i class="mdi mdi-scale-balance" style="font-size: 3rem; color: #9a55ff; opacity: 0.25;"></i>
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
                        <i class="mdi mdi-format-list-bulleted me-2"></i>Daftar Rekanan Notaris
                    </h5>
                    <button type="button" class="btn btn-sm btn-gradient-primary d-flex align-items-center gap-1 shadow-sm" onclick="openModal('tambah')">
                        <i class="mdi mdi-plus-circle" style="font-size: 1rem;"></i>
                        <span>Tambah Notaris</span>
                    </button>
                </div>

                <div class="card-body">
                    <!-- Filter Section -->
                    <div class="filter-card mb-3">
                        <!-- Desktop Version -->
                        <div class="filter-row-desktop d-none d-md-block">
                            <form id="filterForm" method="GET" action="{{ route('notaris.index') }}" onsubmit="return showFilterLoading()">
                                <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 w-100">
                                    <div class="d-flex flex-wrap align-items-center gap-2 flex-grow-1">
                                        <!-- Search Input -->
                                        <div style="min-width: 260px; max-width: 360px; flex: 1;">
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="search" id="searchInput"
                                                    placeholder="Cari nama notaris, wilayah, kontak..."
                                                    value="{{ request('search') }}"
                                                    style="border-top-right-radius: 0 !important; border-bottom-right-radius: 0 !important; border-right: none;">
                                                <button class="btn btn-gradient-primary d-flex align-items-center justify-content-center px-3" 
                                                    type="submit" title="Cari"
                                                    style="border-top-left-radius: 0 !important; border-bottom-left-radius: 0 !important; border-top-right-radius: 4px !important; border-bottom-right-radius: 4px !important; height: 38px; box-shadow: none;">
                                                    <i class="mdi mdi-magnify" style="font-size: 1.15rem; color: #ffffff;"></i>
                                                </button>
                                            </div>
                                        </div>

                                        <!-- Status Filter -->
                                        <div style="width: 155px;">
                                            <select class="form-control" name="status" id="statusSelect">
                                                <option value="">Semua Status</option>
                                                <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Aktif</option>
                                                <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Nonaktif</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Right Limit & Buttons -->
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
                                        <a href="{{ route('notaris.index') }}" class="btn btn-gradient-secondary btn-icon-only" title="Reset" onclick="showResetLoading(event)">
                                            <i class="mdi mdi-refresh"></i>
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <!-- Mobile Version -->
                        <div class="filter-row-mobile d-block d-md-none">
                            <form method="GET" action="{{ route('notaris.index') }}" onsubmit="return showFilterLoading()">
                                <div class="row g-2">
                                    <div class="col-12 mb-2">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="search" id="searchInputMobile"
                                                placeholder="Cari notaris..."
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
                                        <select class="form-control" name="status" id="statusSelectMobile">
                                            <option value="">Semua Status</option>
                                            <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Aktif</option>
                                            <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Nonaktif</option>
                                        </select>
                                    </div>

                                    <div class="col-12 mb-2">
                                        <select class="form-control" name="per_page" id="perPageSelectMobile">
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
                                        <a href="{{ route('notaris.index') }}" class="btn btn-gradient-secondary w-100 d-flex align-items-center justify-content-center gap-1" onclick="showResetLoading(event)">
                                            <i class="mdi mdi-refresh"></i> Reset
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Tabel Data Notaris -->
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="sortable" data-field="nama_notaris" data-direction="{{ request('sortField') == 'nama_notaris' ? (request('sortDirection') == 'asc' ? 'desc' : 'asc') : 'asc' }}">
                                        Nama Notaris
                                        @if(request('sortField') == 'nama_notaris')
                                            <i class="mdi mdi-{{ request('sortDirection') == 'asc' ? 'arrow-up' : 'arrow-down' }}"></i>
                                        @else
                                            <i class="mdi mdi-swap-vertical"></i>
                                        @endif
                                    </th>
                                    <th class="sortable" data-field="no_sk" data-direction="{{ request('sortField') == 'no_sk' ? (request('sortDirection') == 'asc' ? 'desc' : 'asc') : 'asc' }}">
                                        Nomor SK / Izin
                                        @if(request('sortField') == 'no_sk')
                                            <i class="mdi mdi-{{ request('sortDirection') == 'asc' ? 'arrow-up' : 'arrow-down' }}"></i>
                                        @else
                                            <i class="mdi mdi-swap-vertical"></i>
                                        @endif
                                    </th>
                                    <th class="sortable" data-field="telepon" data-direction="{{ request('sortField') == 'telepon' ? (request('sortDirection') == 'asc' ? 'desc' : 'asc') : 'asc' }}">
                                        Kontak Kantor
                                        @if(request('sortField') == 'telepon')
                                            <i class="mdi mdi-{{ request('sortDirection') == 'asc' ? 'arrow-up' : 'arrow-down' }}"></i>
                                        @else
                                            <i class="mdi mdi-swap-vertical"></i>
                                        @endif
                                    </th>
                                    <th>Alamat Kantor</th>
                                    <th class="sortable" data-field="is_active" data-direction="{{ request('sortField') == 'is_active' ? (request('sortDirection') == 'asc' ? 'desc' : 'asc') : 'asc' }}">
                                        Status
                                        @if(request('sortField') == 'is_active')
                                            <i class="mdi mdi-{{ request('sortDirection') == 'asc' ? 'arrow-up' : 'arrow-down' }}"></i>
                                        @else
                                            <i class="mdi mdi-swap-vertical"></i>
                                        @endif
                                    </th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($notarisList as $index => $item)
                                    @php
                                        $nName = $item->nama_notaris ?? 'Notaris';
                                        $nParts = explode(' ', trim(str_replace(['Notaris', 'NOTARIS', 'notaris', 'Hj.', 'H.', 'Dr.'], '', $nName)));
                                        $initials = strtoupper(substr($nParts[0] ?? $nName, 0, 2));
                                        if (trim($initials) == '') {
                                            $initials = 'NT';
                                        }
                                    @endphp
                                    <tr>
                                        <td class="text-center fw-bold">{{ $notarisList->firstItem() + $index }}</td>
                                        <td>
                                            <div class="info-inline">
                                                <span class="initial-avatar" style="background: linear-gradient(135deg, #da8cff, #9a55ff);">{{ $initials }}</span>
                                                <span class="fw-bold text-dark">{{ $item->nama_notaris }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            @if($item->no_sk)
                                                <span class="badge bg-light text-dark fw-bold px-2 py-1 border font-monospace" style="font-size: 0.82rem; letter-spacing: 0.3px;">
                                                    <i class="mdi mdi-certificate-outline text-primary me-1"></i>{{ $item->no_sk }}
                                                </span>
                                            @else
                                                <span class="text-muted fst-italic" style="font-size: 0.8rem;">-</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div>
                                                @if($item->telepon)
                                                    <div class="d-flex align-items-center gap-1">
                                                        <i class="mdi mdi-whatsapp text-success"></i>
                                                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $item->telepon) }}" target="_blank" class="text-dark fw-medium text-decoration-none">
                                                            {{ $item->telepon }}
                                                        </a>
                                                    </div>
                                                @endif
                                                @if($item->email)
                                                    <small class="text-muted d-block" style="font-size: 0.76rem;">
                                                        <i class="mdi mdi-email-outline me-1"></i>{{ $item->email }}
                                                    </small>
                                                @endif
                                                @if(!$item->telepon && !$item->email)
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </div>
                                        </td>
                                        <td>
                                            <span class="text-muted" style="font-size: 0.83rem;" title="{{ $item->alamat_kantor }}">
                                                {{ Str::limit($item->alamat_kantor ?? '-', 55) }}
                                            </span>
                                        </td>
                                        <td>
                                            @if ($item->is_active)
                                                <span class="status-badge aktif">
                                                    <i class="mdi mdi-check-circle"></i> Aktif
                                                </span>
                                            @else
                                                <span class="status-badge nonaktif">
                                                    <i class="mdi mdi-close-circle"></i> Nonaktif
                                                </span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <div class="d-inline-flex align-items-center gap-1">
                                                <button class="btn-action view" title="Detail Notaris" onclick="showDetail({{ $item->id }})">
                                                    <i class="mdi mdi-eye"></i>
                                                </button>
                                                <button class="btn-action edit" title="Edit Notaris" onclick="openModal('edit', {{ $item->id }})">
                                                    <i class="mdi mdi-pencil"></i>
                                                </button>
                                                <button class="btn-action delete" title="Hapus Notaris" onclick="confirmDelete({{ $item->id }})">
                                                    <i class="mdi mdi-trash-can-outline"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center text-muted py-4">
                                            <i class="mdi mdi-scale-balance me-2" style="font-size: 1.5rem;"></i>
                                            Belum ada data notaris rekanan yang tersimpan.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if ($notarisList instanceof \Illuminate\Pagination\LengthAwarePaginator && $notarisList->total() > 0)
                        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mt-4">
                            <div class="pagination-info mb-2 mb-sm-0 text-muted" style="font-size: 0.82rem;">
                                Menampilkan {{ $notarisList->firstItem() }} - {{ $notarisList->lastItem() }} dari {{ $notarisList->total() }} data
                            </div>
                            <nav aria-label="Page navigation">
                                <ul class="pagination pagination-sm flex-wrap justify-content-center mb-0">
                                    <li class="page-item {{ $notarisList->onFirstPage() ? 'disabled' : '' }}">
                                        <a class="page-link" href="{{ $notarisList->previousPageUrl() }}" {{ !$notarisList->onFirstPage() ? 'onclick=showPaginationLoading(event)' : '' }}>
                                            <i class="mdi mdi-chevron-left"></i>
                                        </a>
                                    </li>

                                    @for($page = 1; $page <= $notarisList->lastPage(); $page++)
                                        <li class="page-item {{ $page == $notarisList->currentPage() ? 'active' : '' }}">
                                            @if($page == $notarisList->currentPage())
                                                <span class="page-link">{{ $page }}</span>
                                            @else
                                                <a class="page-link" href="{{ $notarisList->appends(request()->query())->url($page) }}" onclick="showPaginationLoading(event)">{{ $page }}</a>
                                            @endif
                                        </li>
                                    @endfor

                                    <li class="page-item {{ $notarisList->hasMorePages() ? '' : 'disabled' }}">
                                        <a class="page-link" href="{{ $notarisList->nextPageUrl() }}" {{ $notarisList->hasMorePages() ? 'onclick=showPaginationLoading(event)' : '' }}>
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

<!-- Modal Tambah/Edit Notaris -->
<div class="modal fade" id="modalNotaris" tabindex="-1" aria-labelledby="modalNotarisLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 540px;">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-white border-bottom">
                <h5 class="modal-title fw-bold" id="modalNotarisLabel" style="color: #2c2e3f;">
                    <i class="mdi mdi-plus-circle me-2" id="modalIcon" style="color: #9a55ff;"></i>
                    <span id="modalTitle">Tambah Notaris</span>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formNotaris" method="POST" onsubmit="return submitForm(event)">
                @csrf
                <input type="hidden" name="_method" id="methodField" value="POST">
                <input type="hidden" id="notarisId" name="id">

                <div class="modal-body p-3 p-md-4">
                    <div class="mb-3">
                        <label class="form-label fw-bold" style="color: #2c2e3f;">Nama Notaris &amp; Gelar <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="nama_notaris" id="namaNotaris" placeholder="" required>
                    </div>

                    <div class="row g-2 mb-3">
                        <div class="col-sm-7">
                            <label class="form-label fw-bold" style="color: #2c2e3f;">Nomor SK / Izin PPAT</label>
                            <input type="text" class="form-control" name="no_sk" id="noSk" placeholder="">
                        </div>
                        <div class="col-sm-5">
                            <label class="form-label fw-bold" style="color: #2c2e3f;">Status</label>
                            <select class="form-control" name="is_active" id="status">
                                <option value="1">Aktif</option>
                                <option value="0">Nonaktif</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold" style="color: #2c2e3f;">Alamat Kantor Notaris <span class="text-danger">*</span></label>
                        <textarea class="form-control" name="alamat_kantor" id="alamatKantor" rows="2" placeholder="" required></textarea>
                    </div>

                    <div class="row g-2 mb-3">
                        <div class="col-sm-6">
                            <label class="form-label fw-bold" style="color: #2c2e3f;">No. Telepon / WhatsApp <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="telepon" id="telepon" placeholder="" required>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label fw-bold" style="color: #2c2e3f;">Email</label>
                            <input type="email" class="form-control" name="email" id="email" placeholder="">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold" style="color: #2c2e3f;">Nama Kontak Person / Staf Notaris (PIC)</label>
                        <input type="text" class="form-control" name="nama_kontak_person" id="namaKontakPerson" placeholder="">
                    </div>

                    <div class="row g-2 mb-3">
                        <div class="col-sm-5">
                            <label class="form-label fw-bold" style="color: #2c2e3f;">Nama Bank</label>
                            <input type="text" class="form-control" name="nama_bank" id="namaBank" placeholder="">
                        </div>
                        <div class="col-sm-7">
                            <label class="form-label fw-bold" style="color: #2c2e3f;">Nomor Rekening</label>
                            <input type="text" class="form-control" name="nomor_rekening" id="nomorRekening" placeholder="">
                        </div>
                        <div class="col-12 mt-2">
                            <label class="form-label fw-bold" style="color: #2c2e3f;">Atas Nama Rekening</label>
                            <input type="text" class="form-control" name="atas_nama_rekening" id="atasNamaRekening" placeholder="">
                        </div>
                    </div>

                    <div class="mb-0">
                        <label class="form-label fw-bold" style="color: #2c2e3f;">Catatan / Keterangan</label>
                        <textarea class="form-control" name="keterangan" id="keterangan" rows="2" placeholder=""></textarea>
                    </div>
                </div>

                <div class="modal-footer bg-light border-top">
                    <button type="button" class="btn btn-secondary btn-sm px-3" data-bs-dismiss="modal">
                        Batal
                    </button>
                    <button type="submit" class="btn btn-gradient-primary btn-sm px-4" id="submitBtn">
                        <i class="mdi mdi-content-save me-1" id="btnIcon"></i>
                        <span id="btnText">Simpan Data</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Detail Notaris -->
<div class="modal fade" id="modalDetailNotaris" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 540px;">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-white border-bottom">
                <h5 class="modal-title fw-bold" style="color: #2c2e3f;">
                    <i class="mdi mdi-eye me-2" style="color: #9a55ff;"></i>Detail Informasi Notaris
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4" id="detailModalBody">
                <div class="text-center py-4 text-muted">
                    <i class="mdi mdi-loading mdi-spin fs-3"></i> Memuat data...
                </div>
            </div>
            <div class="modal-footer bg-light border-top">
                <button type="button" class="btn btn-secondary btn-sm px-3" data-bs-dismiss="modal">Tutup</button>
            </div>
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

function submitForm(event) {
    event.preventDefault();
    Swal.fire({
        title: 'Mohon tunggu...',
        html: 'Sedang menyimpan data notaris',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });

    setTimeout(() => {
        document.getElementById('formNotaris').submit();
    }, 100);

    return false;
}

function openModal(type, id = null) {
    if (type === 'tambah') {
        $('#formNotaris')[0].reset();
        $('#notarisId').val('');
        $('#methodField').val('POST');
        $('#formNotaris').attr('action', '{{ route("notaris.store") }}');

        $('#modalTitle').text('Tambah Notaris');
        $('#modalIcon').removeClass('mdi-pencil').addClass('mdi-plus-circle');
        $('#btnText').text('Simpan Data');
        $('#btnIcon').removeClass('mdi-pencil').addClass('mdi-content-save');

        $('#modalNotaris').modal('show');
    } else {
        Swal.fire({
            title: 'Mohon tunggu...',
            html: 'Sedang mengambil data notaris',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        $.get('{{ url("master-data-notaris") }}/' + id + '/edit', function(res) {
            Swal.close();
            let data = res.data;

            $('#notarisId').val(data.id);
            $('#namaNotaris').val(data.nama_notaris);
            $('#noSk').val(data.no_sk);
            $('#wilayahKerja').val(data.wilayah_kerja);
            $('#alamatKantor').val(data.alamat_kantor);
            $('#telepon').val(data.telepon);
            $('#email').val(data.email);
            $('#namaKontakPerson').val(data.nama_kontak_person);
            $('#namaBank').val(data.nama_bank);
            $('#nomorRekening').val(data.nomor_rekening);
            $('#atasNamaRekening').val(data.atas_nama_rekening);
            $('#keterangan').val(data.keterangan);
            $('#status').val(data.is_active ? '1' : '0');

            $('#methodField').val('PUT');
            $('#formNotaris').attr('action', '{{ url("master-data-notaris") }}/' + id);

            $('#modalTitle').text('Edit Notaris');
            $('#modalIcon').removeClass('mdi-plus-circle').addClass('mdi-pencil');
            $('#btnText').text('Update Data');
            $('#btnIcon').removeClass('mdi-content-save').addClass('mdi-pencil');

            $('#modalNotaris').modal('show');
        }).fail(function() {
            Swal.close();
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: 'Gagal mengambil data notaris',
                confirmButtonColor: '#dc3545'
            });
        });
    }
}

function showDetail(id) {
    Swal.fire({
        title: 'Mohon tunggu...',
        html: 'Sedang mengambil data detail',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });

    $.get('{{ url("master-data-notaris") }}/' + id, function(res) {
        Swal.close();
        if (res.success) {
            let d = res.data;
            let statusBadge = d.is_active 
                ? '<span class="status-badge aktif"><i class="mdi mdi-check-circle"></i> Aktif</span>' 
                : '<span class="status-badge nonaktif"><i class="mdi mdi-close-circle"></i> Nonaktif</span>';

            let html = `
                <div class="row g-3">
                    <div class="col-12 pb-2 border-bottom d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="fw-bold mb-0 text-dark">${d.nama_notaris}</h4>
                            <small class="text-muted">SK / Izin: ${d.no_sk || '-'}</small>
                        </div>
                        <div>${statusBadge}</div>
                    </div>
                    <div class="col-md-6">
                        <label class="text-muted small fw-bold mb-1">Wilayah Kerja</label>
                        <p class="fw-bold text-dark mb-0">${d.wilayah_kerja || '-'}</p>
                    </div>
                    <div class="col-md-6">
                        <label class="text-muted small fw-bold mb-1">No. Telepon / WhatsApp</label>
                        <p class="fw-bold text-dark mb-0">
                            ${d.telepon ? `<a href="https://wa.me/${d.telepon.replace(/[^0-9]/g, '')}" target="_blank" class="text-success text-decoration-none"><i class="mdi mdi-whatsapp me-1"></i>${d.telepon}</a>` : '-'}
                        </p>
                    </div>
                    <div class="col-md-6">
                        <label class="text-muted small fw-bold mb-1">Email</label>
                        <p class="fw-medium text-dark mb-0">${d.email || '-'}</p>
                    </div>
                    <div class="col-md-6">
                        <label class="text-muted small fw-bold mb-1">PIC / Staf Notaris</label>
                        <p class="fw-medium text-dark mb-0">${d.nama_kontak_person || '-'}</p>
                    </div>
                    <div class="col-12">
                        <label class="text-muted small fw-bold mb-1">Alamat Kantor Notaris</label>
                        <div class="p-2 bg-light rounded border text-dark">${d.alamat_kantor || '-'}</div>
                    </div>
                    <div class="col-12 pt-2 border-top">
                        <label class="text-muted small fw-bold mb-1">Informasi Rekening Bank</label>
                        <p class="mb-0 text-dark">
                            <strong>${d.nama_bank || '-'}</strong> - <span class="badge bg-light text-dark border font-monospace">${d.nomor_rekening || '-'}</span> (A.N. ${d.atas_nama_rekening || '-'})
                        </p>
                    </div>
                    ${d.keterangan ? `
                    <div class="col-12 pt-2 border-top">
                        <label class="text-muted small fw-bold mb-1">Catatan / Keterangan</label>
                        <p class="mb-0 text-muted fst-italic">${d.keterangan}</p>
                    </div>
                    ` : ''}
                </div>
            `;

            $('#detailModalBody').html(html);
            $('#modalDetailNotaris').modal('show');
        }
    }).fail(function() {
        Swal.close();
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: 'Gagal mengambil data detail',
            confirmButtonColor: '#dc3545'
        });
    });
}

function confirmDelete(id) {
    Swal.fire({
        title: 'Yakin ingin menghapus?',
        text: "Data notaris ini akan dihapus permanen!",
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
                form.action = '{{ url("master-data-notaris") }}/' + id;

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
