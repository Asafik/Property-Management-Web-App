@extends('layouts.partial.app')

@section('title', 'Manajemen Promo - Property Management App')

@section('content')

<link rel="stylesheet" href="{{ asset('assets/css/masterdata/promo.css') }}">

<div class="container-fluid p-2 p-sm-3 p-md-4">

    <!-- Header -->
    <div class="row mb-3 mb-sm-3 mb-md-4">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="text-dark mb-1">
                            <i class="mdi mdi-tag-multiple me-2" style="color: #9a55ff;"></i>Manajemen Promo
                        </h3>
                        <p class="text-muted mb-0">
                            Kelola promo, diskon, biaya tambahan, dan fasilitas
                        </p>
                    </div>
                    <div class="d-none d-sm-block">
                        <i class="mdi mdi-tag-multiple" style="font-size: 2.5rem; color: #9a55ff; opacity: 0.2;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel Data Promo -->
    <div class="row mt-2 mt-sm-2 mt-md-3">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-white d-flex flex-wrap flex-md-row justify-content-between align-items-center gap-2">
                    <h5 class="card-title mb-0">
                        <i class="mdi mdi-filter-outline me-2"></i>Daftar Promo
                    </h5>
                    <button class="btn btn-gradient-primary" style="padding: 0.6rem 1.2rem; font-size: 0.9rem;" onclick="openModal('tambah')">
                        <i class="mdi mdi-plus me-1"></i>Tambah Promo
                    </button>
                </div>

                <div class="card-body">
                    <!-- FILTER SECTION -->
                    <div class="filter-card mb-4">
                        <div class="card-body">

                            <!-- DESKTOP VERSION -->
                            <div class="filter-row-desktop">
                                <div class="filter-text">
                                    <i class="mdi mdi-filter-outline"></i>
                                    <span>Filter data promo</span>
                                </div>
                                <form id="filterForm" method="GET" action="{{ route('promo.index') }}">
                                    <div class="row g-2 align-items-end w-100">

                                        <!-- Search -->
                                        <div class="col-md-3">
                                            <label class="form-label">Cari</label>
                                            <input type="text" class="form-control" name="search" id="searchInput" placeholder="Nama promo..." value="{{ request('search') }}">
                                        </div>

                                        <!-- Kategori Filter -->
                                        <div class="col-md-2">
                                            <label class="form-label">Kategori</label>
                                            <select class="form-control" name="category" id="kategoriSelect">
                                                <option value="">Semua</option>
                                                <option value="promo" {{ request('category') == 'promo' ? 'selected' : '' }}>Promo</option>
                                                <option value="biaya" {{ request('category') == 'biaya' ? 'selected' : '' }}>Biaya Tambahan</option>
                                                <option value="fasilitas" {{ request('category') == 'fasilitas' ? 'selected' : '' }}>Fasilitas</option>
                                            </select>
                                        </div>

                                        <!-- Type Filter -->
                                        <div class="col-md-2">
                                            <label class="form-label">Tipe</label>
                                            <select class="form-control" name="type" id="typeSelect">
                                                <option value="">Semua</option>
                                                <option value="persen" {{ request('type') == 'persen' ? 'selected' : '' }}>Persentase</option>
                                                <option value="nominal" {{ request('type') == 'nominal' ? 'selected' : '' }}>Nominal</option>
                                            </select>
                                        </div>

                                        <!-- Status -->
                                        <div class="col-md-2">
                                            <label class="form-label">Status</label>
                                            <select class="form-control" name="status" id="statusSelect">
                                                <option value="">Semua</option>
                                                <option value="aktif" {{ request('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                                <option value="tidak_aktif" {{ request('status') == 'tidak_aktif' ? 'selected' : '' }}>Nonaktif</option>
                                            </select>
                                        </div>

                                        <!-- Tampil -->
                                        <div class="col-md-1">
                                            <label class="form-label">Tampil</label>
                                            <select class="form-control" name="per_page" id="perPageSelect">
                                                <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                                                <option value="15" {{ request('per_page') == 15 ? 'selected' : '' }}>15</option>
                                                <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                                            </select>
                                        </div>

                                        <!-- Tombol Filter + Reset -->
                                        <div class="col-md-2">
                                            <label class="form-label invisible d-none d-md-block">Aksi</label>
                                            <div class="d-flex gap-2">
                                                <button type="submit" class="btn btn-gradient-primary btn-icon-only flex-fill" id="filterBtn" title="Filter" onclick="showFilterLoading()">
                                                    <i class="mdi mdi-filter"></i>
                                                </button>
                                                <a href="{{ route('promo.index') }}" class="btn btn-gradient-secondary btn-icon-only flex-fill" title="Reset" onclick="showResetLoading(event)">
                                                    <i class="mdi mdi-refresh"></i>
                                                </a>
                                            </div>
                                        </div>

                                    </div>
                                </form>
                            </div>

                            <!-- MOBILE VERSION -->
                            <div class="filter-row-mobile">
                                <div class="filter-text mb-2">
                                    <i class="mdi mdi-filter-outline"></i>
                                    <span>Filter data promo</span>
                                </div>
                                <form method="GET" action="{{ route('promo.index') }}">
                                    <div class="row g-2">
                                        <div class="col-12 mb-2">
                                            <label class="form-label">Cari</label>
                                            <input type="text" class="form-control" name="search" id="searchInputMobile" placeholder="Nama promo..." value="{{ request('search') }}">
                                        </div>
                                        <div class="col-12 mb-2">
                                            <label class="form-label">Kategori</label>
                                            <select class="form-control" name="category" id="kategoriSelectMobile">
                                                <option value="">Semua</option>
                                                <option value="promo" {{ request('category') == 'promo' ? 'selected' : '' }}>Promo</option>
                                                <option value="biaya" {{ request('category') == 'biaya' ? 'selected' : '' }}>Biaya Tambahan</option>
                                                <option value="fasilitas" {{ request('category') == 'fasilitas' ? 'selected' : '' }}>Fasilitas</option>
                                            </select>
                                        </div>
                                        <div class="col-12 mb-2">
                                            <label class="form-label">Tipe</label>
                                            <select class="form-control" name="type" id="typeSelectMobile">
                                                <option value="">Semua</option>
                                                <option value="persen" {{ request('type') == 'persen' ? 'selected' : '' }}>Persentase</option>
                                                <option value="nominal" {{ request('type') == 'nominal' ? 'selected' : '' }}>Nominal</option>
                                            </select>
                                        </div>
                                        <div class="col-12 mb-2">
                                            <label class="form-label">Status</label>
                                            <select class="form-control" name="status" id="statusSelectMobile">
                                                <option value="">Semua</option>
                                                <option value="aktif" {{ request('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                                <option value="tidak_aktif" {{ request('status') == 'tidak_aktif' ? 'selected' : '' }}>Nonaktif</option>
                                            </select>
                                        </div>
                                        <div class="col-12 mb-2">
                                            <label class="form-label">Tampil</label>
                                            <select class="form-control" name="per_page" id="perPageSelectMobile">
                                                <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                                                <option value="15" {{ request('per_page') == 15 ? 'selected' : '' }}>15</option>
                                                <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                                            </select>
                                        </div>
                                        <div class="col-6">
                                            <button type="submit" class="btn btn-gradient-primary btn-icon-only-mobile w-100" id="filterBtnMobile" title="Filter" onclick="showFilterLoading()">
                                                <i class="mdi mdi-filter"></i> Filter
                                            </button>
                                        </div>
                                        <div class="col-6">
                                            <a href="{{ route('promo.index') }}" class="btn btn-gradient-secondary btn-icon-only-mobile w-100" title="Reset" onclick="showResetLoading(event)">
                                                <i class="mdi mdi-refresh"></i> Reset
                                            </a>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>

                    <!-- TABEL DATA PROMO -->
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="sortable" data-field="name" data-direction="{{ request('sortField') == 'name' ? (request('sortDirection') == 'asc' ? 'desc' : 'asc') : 'asc' }}">
                                        Nama Promo
                                        @if(request('sortField') == 'name')
                                            <i class="mdi mdi-{{ request('sortDirection') == 'asc' ? 'arrow-up' : 'arrow-down' }}"></i>
                                        @else
                                            <i class="mdi mdi-swap-vertical"></i>
                                        @endif
                                    </th>
                                    <th class="sortable" data-field="category" data-direction="{{ request('sortField') == 'category' ? (request('sortDirection') == 'asc' ? 'desc' : 'asc') : 'asc' }}">
                                        Kategori
                                        @if(request('sortField') == 'category')
                                            <i class="mdi mdi-{{ request('sortDirection') == 'asc' ? 'arrow-up' : 'arrow-down' }}"></i>
                                        @else
                                            <i class="mdi mdi-swap-vertical"></i>
                                        @endif
                                    </th>
                                    <th class="sortable" data-field="type" data-direction="{{ request('sortField') == 'type' ? (request('sortDirection') == 'asc' ? 'desc' : 'asc') : 'asc' }}">
                                        Tipe
                                        @if(request('sortField') == 'type')
                                            <i class="mdi mdi-{{ request('sortDirection') == 'asc' ? 'arrow-up' : 'arrow-down' }}"></i>
                                        @else
                                            <i class="mdi mdi-swap-vertical"></i>
                                        @endif
                                    </th>
                                    <th class="sortable" data-field="value" data-direction="{{ request('sortField') == 'value' ? (request('sortDirection') == 'asc' ? 'desc' : 'asc') : 'asc' }}">
                                        Nilai
                                        @if(request('sortField') == 'value')
                                            <i class="mdi mdi-{{ request('sortDirection') == 'asc' ? 'arrow-up' : 'arrow-down' }}"></i>
                                        @else
                                            <i class="mdi mdi-swap-vertical"></i>
                                        @endif
                                    </th>
                                    <th class="sortable" data-field="validity_period" data-direction="{{ request('sortField') == 'validity_period' ? (request('sortDirection') == 'asc' ? 'desc' : 'asc') : 'asc' }}">
                                        Berlaku
                                        @if(request('sortField') == 'validity_period')
                                            <i class="mdi mdi-{{ request('sortDirection') == 'asc' ? 'arrow-up' : 'arrow-down' }}"></i>
                                        @else
                                            <i class="mdi mdi-swap-vertical"></i>
                                        @endif
                                    </th>
                                    <th class="sortable" data-field="start_date" data-direction="{{ request('sortField') == 'start_date' ? (request('sortDirection') == 'asc' ? 'desc' : 'asc') : 'asc' }}">
                                        Periode
                                        @if(request('sortField') == 'start_date')
                                            <i class="mdi mdi-{{ request('sortDirection') == 'asc' ? 'arrow-up' : 'arrow-down' }}"></i>
                                        @else
                                            <i class="mdi mdi-swap-vertical"></i>
                                        @endif
                                    </th>
                                    <th class="sortable" data-field="status" data-direction="{{ request('sortField') == 'status' ? (request('sortDirection') == 'asc' ? 'desc' : 'asc') : 'asc' }}">
                                        Status
                                        @if(request('sortField') == 'status')
                                            <i class="mdi mdi-{{ request('sortDirection') == 'asc' ? 'arrow-up' : 'arrow-down' }}"></i>
                                        @else
                                            <i class="mdi mdi-swap-vertical"></i>
                                        @endif
                                    </th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($promo as $index => $item)
                                <tr>
                                    <td class="text-center fw-bold">{{ $promo->firstItem() + $index }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="mdi mdi-tag text-primary me-2" style="font-size: 1.2rem;"></i>
                                            <span class="fw-bold">{{ $item->name }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        @if($item->category == 'promo')
                                            <span class="kategori-badge promo">
                                                <i class="mdi mdi-sale"></i> Promo
                                            </span>
                                        @elseif($item->category == 'biaya')
                                            <span class="kategori-badge biaya">
                                                <i class="mdi mdi-cash-plus"></i> Biaya Tambahan
                                            </span>
                                        @else
                                            <span class="kategori-badge fasilitas">
                                                <i class="mdi mdi-home"></i> Fasilitas
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($item->type == 'persen')
                                            <span class="tipe-badge persen">
                                                <i class="mdi mdi-percent"></i> Persentase
                                            </span>
                                        @else
                                            <span class="tipe-badge nominal">
                                                <i class="mdi mdi-currency-usd"></i> Nominal
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($item->type == 'persen')
                                            <span class="fw-bold text-success">{{ $item->value }}%</span>
                                        @else
                                            <span class="fw-bold text-danger">Rp {{ number_format($item->value, 0, ',', '.') }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($item->validity_period == 'selalu')
                                            <span class="berlaku-badge selalu">
                                                <i class="mdi mdi-check"></i> Selalu
                                            </span>
                                        @else
                                            <span class="berlaku-badge periode">
                                                <i class="mdi mdi-calendar"></i> Periode
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($item->validity_period == 'periode')
                                            <small class="text-muted">
                                                {{ Carbon\Carbon::parse($item->start_date)->format('d/m/Y') }} - {{ Carbon\Carbon::parse($item->end_date)->format('d/m/Y') }}
                                            </small>
                                        @else
                                            <small class="text-muted">-</small>
                                        @endif
                                    </td>
                                    <td>
                                        @if($item->status == 'aktif')
                                            <span class="status-badge aktif">
                                                <i class="mdi mdi-check-circle"></i> Aktif
                                            </span>
                                        @else
                                            <span class="status-badge tidak_aktif">
                                                <i class="mdi mdi-close-circle"></i> Nonaktif
                                            </span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <button class="btn-action edit me-1" title="Edit" onclick="openModal('edit', {{ $item->id }})">
                                            <i class="mdi mdi-pencil"></i>
                                        </button>
                                        <button class="btn-action delete" title="Hapus" onclick="confirmDelete({{ $item->id }})">
                                            <i class="mdi mdi-delete"></i>
                                        </button>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="9" class="text-center">
                                        <div class="empty-state">
                                            <i class="mdi mdi-tag-remove"></i>
                                            <p>Belum ada data promo</p>
                                            <small>Klik tombol "Tambah Promo" untuk menambahkan data</small>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- PAGINATION -->
                    @if ($promo instanceof \Illuminate\Pagination\LengthAwarePaginator && $promo->total() > 0)
                    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mt-4">
                        <div class="pagination-info mb-2 mb-sm-0">
                            Menampilkan {{ $promo->firstItem() }} - {{ $promo->lastItem() }} dari {{ $promo->total() }} data
                        </div>
                        <nav aria-label="Page navigation">
                            <ul class="pagination pagination-sm flex-wrap justify-content-center mb-0">
                                {{-- Previous Page Link --}}
                                @if ($promo->onFirstPage())
                                    <li class="page-item disabled" aria-disabled="true">
                                        <span class="page-link" aria-label="Previous">
                                            <i class="mdi mdi-chevron-left"></i>
                                        </span>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $promo->appends(request()->query())->previousPageUrl() }}" rel="prev" aria-label="Previous" onclick="showPaginationLoading(event)">
                                            <i class="mdi mdi-chevron-left"></i>
                                        </a>
                                    </li>
                                @endif

                                {{-- Pagination Elements --}}
                                @foreach ($promo->getUrlRange(max(1, $promo->currentPage() - 2), min($promo->lastPage(), $promo->currentPage() + 2)) as $page => $url)
                                    @if ($page == $promo->currentPage())
                                        <li class="page-item active" aria-current="page">
                                            <span class="page-link">{{ $page }}</span>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $promo->appends(request()->query())->url($page) }}" onclick="showPaginationLoading(event)">{{ $page }}</a>
                                        </li>
                                    @endif
                                @endforeach

                                {{-- Next Page Link --}}
                                @if ($promo->hasMorePages())
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $promo->appends(request()->query())->nextPageUrl() }}" rel="next" aria-label="Next" onclick="showPaginationLoading(event)">
                                            <i class="mdi mdi-chevron-right"></i>
                                        </a>
                                    </li>
                                @else
                                    <li class="page-item disabled" aria-disabled="true">
                                        <span class="page-link" aria-label="Next">
                                            <i class="mdi mdi-chevron-right"></i>
                                        </span>
                                    </li>
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

<!-- MODAL TAMBAH/EDIT PROMO -->
<div class="modal fade" id="modalPromo" tabindex="-1" aria-labelledby="modalPromoLabel" aria-hidden="true">
    <div class="modal-dialog modal-medium modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalPromoLabel">
                    <i class="mdi mdi-plus-circle me-2" id="modalIcon"></i>
                    <span id="modalTitle">Tambah Promo</span>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formPromo" method="POST" action="{{ route('promo.store') }}">
                @csrf
                <input type="hidden" name="_method" id="methodField" value="POST">
                <input type="hidden" id="promoId" name="id">
                <div class="modal-body">
                    <!-- Nama Promo -->
                    <div class="mb-3">
                        <label class="form-label">Nama Promo <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="name" id="namaPromo" placeholder="Contoh: Diskon Early Bird" value="{{ old('name') }}" required>
                    </div>

                    <!-- Kategori -->
                    <div class="mb-3">
                        <label class="form-label">Kategori <span class="text-danger">*</span></label>
                        <select class="form-control" name="category" id="kategori" onchange="ubahKategori()" required>
                            <option value="">-- Pilih Kategori --</option>
                            <option value="promo">Promo</option>
                            <option value="biaya">Biaya Tambahan</option>
                            <option value="fasilitas">Fasilitas</option>
                        </select>
                    </div>

                    <!-- Tipe dan Nilai -->
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tipe <span class="text-danger">*</span></label>
                            <select class="form-control" name="type" id="tipe" onchange="ubahTipe()" required>
                                <option value="">-- Pilih Tipe --</option>
                                <option value="persen">Persentase (%)</option>
                                <option value="nominal">Nominal (Rp)</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" id="labelNilai">Nilai <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text" id="iconNilai">#</span>
                                <input type="text" class="form-control" name="value" id="nilai" placeholder="0" value="{{ old('value') }}" required>
                            </div>
                        </div>
                    </div>

                    <!-- Berlaku -->
                    <div class="mb-3">
                        <label class="form-label">Berlaku <span class="text-danger">*</span></label>
                        <select class="form-control" name="validity_period" id="berlaku" onchange="ubahBerlaku()" required>
                            <option value="">-- Pilih --</option>
                            <option value="selalu">Selalu</option>
                            <option value="periode">Periode Tertentu</option>
                        </select>
                    </div>

                    <!-- Periode (muncul jika pilih periode) -->
                    <div class="row" id="periodeContainer" style="display: none;">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tanggal Mulai <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" name="start_date" id="tanggalMulai" value="{{ old('start_date') }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tanggal Berakhir <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" name="end_date" id="tanggalBerakhir" value="{{ old('end_date') }}">
                        </div>
                    </div>

                    <!-- Status -->
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select class="form-control" name="status" id="status">
                            <option value="aktif">Aktif</option>
                            <option value="tidak_aktif">Nonaktif</option>
                        </select>
                    </div>

                    <!-- Keterangan (Description) -->
                    <div class="mb-3">
                        <label class="form-label">Keterangan</label>
                        <textarea class="form-control" name="description" id="keterangan" rows="2" placeholder="Deskripsi promo...">{{ old('description') }}</textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-gradient-secondary" data-bs-dismiss="modal">
                        <i class="mdi mdi-close me-1"></i>Batal
                    </button>
                    <button type="submit" class="btn btn-gradient-primary" id="submitBtn" onclick="showSubmitLoading()">
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
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).ready(function() {
    // Sorting functionality
    $('.sortable').click(function() {
        let field = $(this).data('field');
        let direction = $(this).data('direction');

        // Tampilkan loading
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
            timerProgressBar: true,
            didOpen: () => {
                const timer = Swal.getPopup().querySelector("b");
                if (timer) {
                    timer.style.width = "100%";
                }
            }
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
});

// Fungsi loading untuk filter
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

// Fungsi loading untuk reset
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

// Fungsi loading untuk pagination
function showPaginationLoading(event) {
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

// Fungsi loading untuk submit form
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

// Fungsi ubah kategori
function ubahKategori() {
    // Kosongkan
}

// Fungsi ubah tipe
function ubahTipe() {
    let tipe = document.getElementById('tipe').value;
    let iconNilai = document.getElementById('iconNilai');
    let labelNilai = document.getElementById('labelNilai');

    if (tipe === 'persen') {
        iconNilai.innerHTML = '%';
        labelNilai.innerHTML = 'Nilai <span class="text-danger">*</span>';
    } else if (tipe === 'nominal') {
        iconNilai.innerHTML = 'Rp';
        labelNilai.innerHTML = 'Nilai <span class="text-danger">*</span>';
    } else {
        iconNilai.innerHTML = '#';
    }
}

// Fungsi ubah berlaku
function ubahBerlaku() {
    let berlaku = document.getElementById('berlaku').value;
    let periodeContainer = document.getElementById('periodeContainer');

    if (berlaku === 'periode') {
        periodeContainer.style.display = 'flex';
        document.getElementById('tanggalMulai').required = true;
        document.getElementById('tanggalBerakhir').required = true;
    } else {
        periodeContainer.style.display = 'none';
        document.getElementById('tanggalMulai').required = false;
        document.getElementById('tanggalBerakhir').required = false;
    }
}

// Buka Modal untuk Tambah atau Edit
function openModal(type, id = null) {
    if (type === 'tambah') {
        // Reset form
        $('#formPromo')[0].reset();
        $('#promoId').val('');
        $('#methodField').val('POST');
        $('#formPromo').attr('action', '{{ route("promo.store") }}');

        // Reset UI
        document.getElementById('periodeContainer').style.display = 'none';
        document.getElementById('iconNilai').innerHTML = '#';

        // Ubah title dan icon
        $('#modalTitle').text('Tambah Promo');
        $('#modalIcon').removeClass('mdi-pencil-circle').addClass('mdi-plus-circle');
        $('#btnText').text('Simpan');
        $('#btnIcon').removeClass('mdi-pencil').addClass('mdi-content-save');

        $('#modalPromo').modal('show');
    } else {
        // Tampilkan loading saat mengambil data
        Swal.fire({
            title: 'Mohon tunggu...',
            html: 'Sedang mengambil data promo',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        // Ambil data promo via AJAX
        $.get('{{ url("master-data-promo/get") }}/' + id, function(response) {
            Swal.close(); // Tutup loading

            if (response.success) {
                let data = response.data;

                $('#promoId').val(data.id);
                $('#namaPromo').val(data.name);
                $('#kategori').val(data.category);
                $('#tipe').val(data.type);

                if (data.type === 'nominal') {
                    $('#nilai').val(new Intl.NumberFormat('id-ID').format(data.value));
                } else {
                    $('#nilai').val(data.value);
                }

                $('#berlaku').val(data.validity_period);

                if (data.validity_period === 'periode') {
                    $('#tanggalMulai').val(data.start_date);
                    $('#tanggalBerakhir').val(data.end_date);
                }

                $('#status').val(data.status);
                $('#keterangan').val(data.description);

                // Update UI
                ubahTipe();
                ubahBerlaku();

                // Ubah title dan icon
                $('#modalTitle').text('Edit Promo');
                $('#modalIcon').removeClass('mdi-plus-circle').addClass('mdi-pencil-circle');
                $('#btnText').text('Update');
                $('#btnIcon').removeClass('mdi-content-save').addClass('mdi-pencil');

                // Ubah action form untuk update
                $('#methodField').val('PUT');
                $('#formPromo').attr('action', '{{ url("master-data-promo") }}/' + id);

                $('#modalPromo').modal('show');
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: response.message || 'Gagal mengambil data promo',
                    confirmButtonColor: '#dc3545'
                });
            }
        }).fail(function() {
            Swal.close();
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: 'Gagal mengambil data promo',
                confirmButtonColor: '#dc3545'
            });
        });
    }
}

// Fungsi Konfirmasi Hapus dengan Loading
function confirmDelete(id) {
    Swal.fire({
        title: 'Yakin ingin menghapus?',
        text: "Data yang dihapus tidak dapat dikembalikan!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            // Tampilkan loading sebelum submit
            Swal.fire({
                title: 'Menghapus...',
                html: 'Sedang menghapus data promo',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            // Buat form delete dan submit setelah loading ditampilkan
            setTimeout(() => {
                let form = document.createElement('form');
                form.method = 'POST';
                form.action = '{{ url("master-data-promo") }}/' + id;

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
