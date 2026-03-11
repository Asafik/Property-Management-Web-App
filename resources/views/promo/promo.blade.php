@extends('layouts.partial.app')

@section('title', 'Manajemen Promo - Property Management App')

@section('content')
<link rel="stylesheet" href="{{ asset('assets/css/promo/promo.css') }}">

<style>
/* Fix untuk tombol aksi di mobile */
.action-buttons {
    position: relative;
    z-index: 10;
}

.btn-outline-warning, .btn-outline-danger {
    position: relative;
    z-index: 15;
    pointer-events: auto !important;
    cursor: pointer !important;
}

/* DataTables wrapper styling */
.dataTables_wrapper {
    width: 100%;
    overflow-x: auto;
}

/* Pastikan tabel tetap terlihat */
.table {
    width: 100% !important;
    margin-bottom: 0;
}

/* Fix untuk DataTables di mobile */
@media (max-width: 768px) {
    .dataTables_wrapper .table {
        width: 100% !important;
    }
}
</style>

<div class="container-fluid p-2 p-sm-3 p-md-4">
    <!-- Header Dashboard -->
    <div class="row mb-3 mb-sm-3 mb-md-4">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="text-dark mb-1">
                            <i class="mdi mdi-tag-multiple me-2" style="color: #9a55ff;"></i>
                            Manajemen Promo & Biaya Tambahan
                        </h3>
                        <p class="text-muted mb-0">
                            <i class="mdi mdi-information-outline me-1"></i>
                            Kelola promo, diskon, dan biaya tambahan seperti PPN, kanopi, pagar, dll
                        </p>
                    </div>
                    <div class="d-none d-sm-block">
                        <i class="mdi mdi-percent" style="font-size: 2.5rem; color: #9a55ff; opacity: 0.2;"></i>
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
                        <i class="mdi mdi-format-list-bulleted me-2 text-primary"></i>
                        Daftar Promo & Biaya Tambahan
                    </h5>
                    <div class="ms-auto">
                        <button class="btn btn-gradient-primary" style="padding: 8px 20px; font-size: 0.95rem; white-space: nowrap;" onclick="$('#modalTambahPromo').modal('show')">
                            <i class="mdi mdi-plus me-1"></i>
                            <span>Tambah Promo</span>
                        </button>
                    </div>
                </div>

                <div class="card-body">
                    <!-- FILTER SECTION -->
                    <div class="filter-card mb-4">
                        <div class="card-body">
                            <h6 class="card-title mb-3" style="font-size: 1rem;">
                                <i class="mdi mdi-filter-outline me-1" style="color: #9a55ff;"></i>
                                Filter Data Promo
                            </h6>

                            <!-- MOBILE VERSION -->
                            <div class="d-block d-md-none">
                                <form method="GET" action="{{ route('promo.index') }}" id="filterFormMobile">
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">
                                            <i class="mdi mdi-magnify me-1" style="color: #9a55ff;"></i>
                                            Cari Promo
                                        </label>
                                        <input type="text" class="form-control" name="search" value="{{ request('search') }}" placeholder="Cari nama promo..." style="height: 45px;">
                                    </div>

                                    <div class="row g-2 mb-3">
                                        <div class="col-6">
                                            <label class="form-label fw-semibold">
                                                <i class="mdi mdi-shape-outline me-1" style="color: #9a55ff;"></i>Kategori
                                            </label>
                                            <select class="form-control" name="category" style="height: 45px;">
                                                <option value="">Semua</option>
                                                <option value="promo" {{ request('category') == 'promo' ? 'selected' : '' }}>Promo Diskon</option>
                                                <option value="biaya" {{ request('category') == 'biaya' ? 'selected' : '' }}>Biaya Tambahan</option>
                                                <option value="fasilitas" {{ request('category') == 'fasilitas' ? 'selected' : '' }}>Fasilitas</option>
                                            </select>
                                        </div>
                                        <div class="col-6">
                                            <label class="form-label fw-semibold">
                                                <i class="mdi mdi-calculator me-1" style="color: #9a55ff;"></i>Tipe
                                            </label>
                                            <select class="form-control" name="type" style="height: 45px;">
                                                <option value="">Semua</option>
                                                <option value="persen" {{ request('type') == 'persen' ? 'selected' : '' }}>Persentase (%)</option>
                                                <option value="nominal" {{ request('type') == 'nominal' ? 'selected' : '' }}>Nominal (Rp)</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row g-2 mb-3">
                                        <div class="col-6">
                                            <label class="form-label fw-semibold">
                                                <i class="mdi mdi-flag me-1" style="color: #9a55ff;"></i>Status
                                            </label>
                                            <select class="form-control" name="status" style="height: 45px;">
                                                <option value="">Semua</option>
                                                <option value="aktif" {{ request('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                                <option value="tidak_aktif" {{ request('status') == 'tidak_aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                                            </select>
                                        </div>
                                        <div class="col-6">
                                            <label class="form-label fw-semibold">
                                                <i class="mdi mdi-counter me-1" style="color: #9a55ff;"></i>Tampil
                                            </label>
                                            <select class="form-control" name="per_page" style="height: 45px;">
                                                <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10</option>
                                                <option value="15" {{ request('per_page') == 15 ? 'selected' : '' }}>15</option>
                                                <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row g-2">
                                        <div class="col-6">
                                            <button type="submit" class="btn btn-gradient-primary w-100 py-2 d-flex align-items-center justify-content-center">
                                                <i class="mdi mdi-filter me-1"></i> Filter
                                            </button>
                                        </div>
                                        <div class="col-6">
                                            <a href="{{ route('promo.index') }}" class="btn btn-gradient-secondary w-100 py-2 d-flex align-items-center justify-content-center">
                                                <i class="mdi mdi-refresh me-1"></i> Reset
                                            </a>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <!-- DESKTOP VERSION -->
                            <div class="d-none d-md-block">
                                <form method="GET" action="{{ route('promo.index') }}" id="filterFormDesktop">
                                    <div class="row g-2 align-items-end">
                                        <div class="col-md-3">
                                            <label class="form-label">
                                                <i class="mdi mdi-magnify me-1" style="color: #9a55ff;"></i>
                                                Cari Promo
                                            </label>
                                            <input type="text" class="form-control" name="search" value="{{ request('search') }}" placeholder="Cari nama promo...">
                                        </div>

                                        <div class="col-md-2">
                                            <label class="form-label">
                                                <i class="mdi mdi-shape-outline me-1" style="color: #9a55ff;"></i>Kategori
                                            </label>
                                            <select class="form-control" name="category">
                                                <option value="">Semua</option>
                                                <option value="promo" {{ request('category') == 'promo' ? 'selected' : '' }}>Promo Diskon</option>
                                                <option value="biaya" {{ request('category') == 'biaya' ? 'selected' : '' }}>Biaya Tambahan</option>
                                                <option value="fasilitas" {{ request('category') == 'fasilitas' ? 'selected' : '' }}>Fasilitas</option>
                                            </select>
                                        </div>

                                        <div class="col-md-2">
                                            <label class="form-label">
                                                <i class="mdi mdi-calculator me-1" style="color: #9a55ff;"></i>Tipe
                                            </label>
                                            <select class="form-control" name="type">
                                                <option value="">Semua</option>
                                                <option value="persen" {{ request('type') == 'persen' ? 'selected' : '' }}>Persentase (%)</option>
                                                <option value="nominal" {{ request('type') == 'nominal' ? 'selected' : '' }}>Nominal (Rp)</option>
                                            </select>
                                        </div>

                                        <div class="col-md-2">
                                            <label class="form-label">
                                                <i class="mdi mdi-flag me-1" style="color: #9a55ff;"></i>Status
                                            </label>
                                            <select class="form-control" name="status">
                                                <option value="">Semua</option>
                                                <option value="aktif" {{ request('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                                <option value="tidak_aktif" {{ request('status') == 'tidak_aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                                            </select>
                                        </div>

                                        <div class="col-md-1">
                                            <label class="form-label">
                                                <i class="mdi mdi-counter me-1" style="color: #9a55ff;"></i>Tampil
                                            </label>
                                            <select class="form-control" name="per_page">
                                                <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10</option>
                                                <option value="15" {{ request('per_page') == 15 ? 'selected' : '' }}>15</option>
                                                <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                                            </select>
                                        </div>

                                        <div class="col-md-1">
                                            <label class="form-label invisible">Filter</label>
                                            <button type="submit" class="btn btn-gradient-primary w-100 d-flex align-items-center justify-content-center" title="Filter">
                                                <i class="mdi mdi-filter"></i>
                                            </button>
                                        </div>

                                        <div class="col-md-1">
                                            <label class="form-label invisible">Reset</label>
                                            <a href="{{ route('promo.index') }}" class="btn btn-gradient-secondary w-100 d-flex align-items-center justify-content-center" title="Reset">
                                                <i class="mdi mdi-refresh"></i>
                                            </a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- TABEL PROMO -->
                    <div class="table-responsive">
                        <table class="table table-hover align-middle" id="tablePromo" {{ $promo->count() > 0 ? 'data-use-datatables=true' : '' }}>
                            <thead>
                                <tr>
                                    <th class="text-center" width="5%">No</th>
                                    <th width="20%">Nama Promo</th>
                                    <th width="12%">Kategori</th>
                                    <th width="10%">Tipe</th>
                                    <th width="12%">Nilai</th>
                                    <th width="12%">Berlaku</th>
                                    <th width="10%">Status</th>
                                    <th class="text-center" width="10%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($promo as $item)
                                <tr>
                                    <td class="text-center fw-bold">{{ $loop->iteration }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="mdi mdi-tag text-primary me-2" style="font-size: 1.2rem;"></i>
                                            <span class="fw-bold">{{ $item->name }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            @if($item->category == 'promo')
                                                <i class="mdi mdi-sale text-primary" style="font-size: 1.2rem;"></i>
                                                <span>Promo Diskon</span>
                                            @elseif($item->category == 'biaya')
                                                <i class="mdi mdi-cash text-success" style="font-size: 1.2rem;"></i>
                                                <span>Biaya Tambahan</span>
                                            @else
                                                <i class="mdi mdi-home-city text-info" style="font-size: 1.2rem;"></i>
                                                <span>Fasilitas</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            @if($item->type == 'persen')
                                                <i class="mdi mdi-percent text-warning" style="font-size: 1.2rem;"></i>
                                                <span>Persentase</span>
                                            @else
                                                <i class="mdi mdi-currency-usd text-success" style="font-size: 1.2rem;"></i>
                                                <span>Nominal</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        @if($item->type == 'persen')
                                            <span class="fw-bold">{{ $item->value }} %</span>
                                        @else
                                            <span class="fw-bold">Rp {{ number_format($item->value, 0, ',', '.') }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($item->validity_period == 'selalu')
                                            <span class="badge bg-info">Selalu</span>
                                        @else
                                            <div class="d-flex flex-column">
                                                <small><i class="mdi mdi-calendar-start text-primary me-1"></i>{{ \Carbon\Carbon::parse($item->start_date)->format('d/m/Y') }}</small>
                                                <small class="text-muted my-1">↓</small>
                                                <small><i class="mdi mdi-calendar-end text-danger me-1"></i>{{ \Carbon\Carbon::parse($item->end_date)->format('d/m/Y') }}</small>
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        @if($item->status == 'aktif')
                                            <span class="badge badge-gradient-success">
                                                <i class="mdi mdi-check-circle me-1"></i>Aktif
                                            </span>
                                        @else
                                            <span class="badge badge-gradient-secondary">
                                                <i class="mdi mdi-close-circle me-1"></i>Tidak Aktif
                                            </span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-1 action-buttons">
                                            <button class="btn btn-outline-warning btn-sm btn-edit" title="Edit" data-id="{{ $item->id }}">
                                                <i class="mdi mdi-pencil"></i>
                                            </button>
                                            <form action="{{ route('promo.destroy', $item->id) }}" method="POST" class="d-inline form-delete">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-outline-danger btn-sm btn-delete" title="Hapus" data-name="{{ $item->name }}">
                                                    <i class="mdi mdi-delete"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="text-center text-muted py-5">
                                        <i class="mdi mdi-tag-off" style="font-size: 3rem; opacity: 0.3;"></i>
                                        <p class="mt-2 mb-0">Tidak ada data promo yang tersedia.</p>
                                        <p class="text-muted small">Silahkan tambahkan promo baru.</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- PAGINATION SECTION -->
                    @if($promo->count() > 0)
                    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mt-4">
                        <div class="pagination-info mb-2 mb-sm-0">
                            <i class="mdi mdi-information-outline me-1 text-primary"></i>
                            Menampilkan
                            <span class="fw-bold">{{ $promo->firstItem() }}</span>
                            -
                            <span class="fw-bold">{{ $promo->lastItem() }}</span>
                            dari
                            <span class="fw-bold">{{ $promo->total() }}</span>
                            data promo
                        </div>

                        <nav aria-label="Page navigation">
                            <ul class="pagination pagination-sm flex-wrap justify-content-center mb-0" style="gap: 2px;">
                                {{-- Previous Page Link --}}
                                @if($promo->onFirstPage())
                                    <li class="page-item disabled">
                                        <span class="page-link" aria-label="Previous">
                                            <i class="mdi mdi-chevron-left"></i>
                                        </span>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $promo->previousPageUrl() }}" aria-label="Previous">
                                            <i class="mdi mdi-chevron-left"></i>
                                        </a>
                                    </li>
                                @endif

                                {{-- Page Links --}}
                                @foreach ($promo->getUrlRange(1, $promo->lastPage()) as $page => $url)
                                    <li class="page-item {{ $promo->currentPage() == $page ? 'active' : '' }}">
                                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                    </li>
                                @endforeach

                                {{-- Next Page Link --}}
                                @if($promo->hasMorePages())
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $promo->nextPageUrl() }}" aria-label="Next">
                                            <i class="mdi mdi-chevron-right"></i>
                                        </a>
                                    </li>
                                @else
                                    <li class="page-item disabled">
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

    <!-- Tombol Kembali -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body p-3">
                    <div class="d-flex flex-column flex-sm-row justify-content-start">
                        <a href="{{ route('dashboard') }}" class="btn btn-gradient-secondary">
                            <i class="mdi mdi-arrow-left me-1"></i>
                            Kembali ke Dashboard
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- MODAL TAMBAH PROMO -->
<div class="modal fade" id="modalTambahPromo" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="mdi mdi-tag-plus me-2" style="color: #9a55ff;"></i>
                    Tambah Promo / Biaya Baru
                </h5>
                <button type="button" class="btn-close" onclick="$('#modalTambahPromo').modal('hide')" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('promo.store') }}" method="POST" id="formTambahPromo">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="modal-form-group">
                                <label>
                                    <i class="mdi mdi-tag me-1"></i>Nama Promo <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="name" class="modal-form-control" required
                                    placeholder="Contoh: Diskon Early Bird">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="modal-form-group">
                                <label>
                                    <i class="mdi mdi-shape-outline me-1"></i>Kategori <span class="text-danger">*</span>
                                </label>
                                <select class="modal-form-control" name="category" required>
                                    <option value="promo">Promo Diskon</option>
                                    <option value="biaya">Biaya Tambahan</option>
                                    <option value="fasilitas">Fasilitas</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="modal-form-group">
                                <label>
                                    <i class="mdi mdi-calculator me-1"></i>Tipe <span class="text-danger">*</span>
                                </label>
                                <select class="modal-form-control" name="type" id="tipePromo" required>
                                    <option value="persen">Persentase (%)</option>
                                    <option value="nominal">Nominal (Rp)</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="modal-form-group">
                                <label>
                                    <i class="mdi mdi-currency-usd me-1"></i>Nilai <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="value" class="modal-form-control" id="nilaiPromo" required
                                    placeholder="Contoh: 10 atau 500000">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="modal-form-group">
                                <label>
                                    <i class="mdi mdi-calendar me-1"></i>Berlaku <span class="text-danger">*</span>
                                </label>
                                <select class="modal-form-control" name="validity_period" id="berlaku" required>
                                    <option value="selalu">Selalu</option>
                                    <option value="periode">Periode Tertentu</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row" id="periodeContainer" style="display: none;">
                        <div class="col-md-6">
                            <div class="modal-form-group">
                                <label>
                                    <i class="mdi mdi-calendar-start me-1"></i>Tanggal Mulai
                                </label>
                                <input type="date" name="start_date" class="modal-form-control" id="startDate">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="modal-form-group">
                                <label>
                                    <i class="mdi mdi-calendar-end me-1"></i>Tanggal Berakhir
                                </label>
                                <input type="date" name="end_date" class="modal-form-control" id="endDate">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="modal-form-group">
                                <label>
                                    <i class="mdi mdi-flag me-1"></i>Status <span class="text-danger">*</span>
                                </label>
                                <select class="modal-form-control" name="status" required>
                                    <option value="aktif">Aktif</option>
                                    <option value="tidak_aktif">Tidak Aktif</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="modal-form-group">
                                <label>
                                    <i class="mdi mdi-note-text me-1"></i>Keterangan <span class="text-danger">*</span>
                                </label>
                                <textarea name="description" class="modal-form-control" rows="3" required placeholder="Deskripsi promo..."></textarea>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-gradient-secondary" onclick="$('#modalTambahPromo').modal('hide')">Batal</button>
                <button type="submit" form="formTambahPromo" class="btn btn-gradient-primary">Simpan</button>
            </div>
        </div>
    </div>
</div>

<!-- MODAL EDIT PROMO -->
<div class="modal fade" id="modalEditPromo" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="mdi mdi-pencil me-2" style="color: #9a55ff;"></i>
                    Edit Promo
                </h5>
                <button type="button" class="btn-close" onclick="$('#modalEditPromo').modal('hide')" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="POST" id="formEditPromo">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="modal-form-group">
                                <label>
                                    <i class="mdi mdi-tag me-1"></i>Nama Promo <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="name" class="modal-form-control" id="editNama" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="modal-form-group">
                                <label>
                                    <i class="mdi mdi-shape-outline me-1"></i>Kategori <span class="text-danger">*</span>
                                </label>
                                <select class="modal-form-control" name="category" id="editKategori" required>
                                    <option value="promo">Promo Diskon</option>
                                    <option value="biaya">Biaya Tambahan</option>
                                    <option value="fasilitas">Fasilitas</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="modal-form-group">
                                <label>
                                    <i class="mdi mdi-calculator me-1"></i>Tipe <span class="text-danger">*</span>
                                </label>
                                <select class="modal-form-control" name="type" id="editTipe" required>
                                    <option value="persen">Persentase (%)</option>
                                    <option value="nominal">Nominal (Rp)</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="modal-form-group">
                                <label>
                                    <i class="mdi mdi-currency-usd me-1"></i>Nilai <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="value" class="modal-form-control" id="editNilai" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="modal-form-group">
                                <label>
                                    <i class="mdi mdi-calendar me-1"></i>Berlaku <span class="text-danger">*</span>
                                </label>
                                <select class="modal-form-control" name="validity_period" id="editBerlaku" required>
                                    <option value="selalu">Selalu</option>
                                    <option value="periode">Periode Tertentu</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row" id="editPeriodeContainer" style="display: none;">
                        <div class="col-md-6">
                            <div class="modal-form-group">
                                <label>
                                    <i class="mdi mdi-calendar-start me-1"></i>Tanggal Mulai
                                </label>
                                <input type="date" name="start_date" class="modal-form-control" id="editStart">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="modal-form-group">
                                <label>
                                    <i class="mdi mdi-calendar-end me-1"></i>Tanggal Berakhir
                                </label>
                                <input type="date" name="end_date" class="modal-form-control" id="editEnd">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="modal-form-group">
                                <label>
                                    <i class="mdi mdi-flag me-1"></i>Status <span class="text-danger">*</span>
                                </label>
                                <select class="modal-form-control" name="status" id="editStatus" required>
                                    <option value="aktif">Aktif</option>
                                    <option value="tidak_aktif">Tidak Aktif</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="modal-form-group">
                                <label>
                                    <i class="mdi mdi-note-text me-1"></i>Keterangan <span class="text-danger">*</span>
                                </label>
                                <textarea name="description" class="modal-form-control" rows="3" id="editDeskripsi" required></textarea>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-gradient-secondary" onclick="$('#modalEditPromo').modal('hide')">Batal</button>
                <button type="submit" form="formEditPromo" class="btn btn-gradient-primary">Update</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$(document).ready(function() {
    // Inisialisasi DataTables
    const tableElement = document.getElementById('tablePromo');
    if (tableElement && tableElement.getAttribute('data-use-datatables') === 'true') {
        if ($.fn.DataTable.isDataTable('#tablePromo')) {
            $('#tablePromo').DataTable().destroy();
        }

        $('#tablePromo').DataTable({
            responsive: true,
            ordering: true,
            paging: false,
            info: false,
            searching: false,
            lengthChange: false,
            destroy: true,
            language: {
                emptyTable: "Data promo belum tersedia",
                zeroRecords: "Data tidak ditemukan",
            },
            columnDefs: [
                { orderable: false, targets: [7] }
            ],
            autoWidth: false,
            deferRender: true
        });
    }

    // ===== HANDLE FORM TAMBAH PROMO =====
    $('#formTambahPromo').on('submit', function(e) {
        e.preventDefault();

        Swal.fire({
            title: 'Menyimpan...',
            text: 'Mohon tunggu sebentar',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        this.submit();
    });

    // ===== HANDLE FORM EDIT PROMO =====
    $('#formEditPromo').on('submit', function(e) {
        e.preventDefault();

        Swal.fire({
            title: 'Menyimpan...',
            text: 'Mohon tunggu sebentar',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        this.submit();
    });

    // Toggle periode container
    $('#berlaku').change(function() {
        if ($(this).val() === 'periode') {
            $('#periodeContainer').slideDown();
            $('#startDate, #endDate').prop('required', true);
        } else {
            $('#periodeContainer').slideUp();
            $('#startDate, #endDate').prop('required', false);
        }
    });

    $('#editBerlaku').change(function() {
        if ($(this).val() === 'periode') {
            $('#editPeriodeContainer').slideDown();
            $('#editStart, #editEnd').prop('required', true);
        } else {
            $('#editPeriodeContainer').slideUp();
            $('#editStart, #editEnd').prop('required', false);
        }
    });

    // Format Rupiah untuk input nilai jika tipe nominal
    $('#tipePromo, #editTipe').change(function() {
        let isEdit = $(this).attr('id') === 'editTipe';
        let nilaiInput = isEdit ? $('#editNilai') : $('#nilaiPromo');

        if ($(this).val() === 'nominal') {
            nilaiInput.attr('placeholder', 'Contoh: 500.000');
        } else {
            nilaiInput.attr('placeholder', 'Contoh: 10');
        }
    });

    // Format Rupiah on input
    $('#nilaiPromo, #editNilai').on('input', function() {
        let isEdit = $(this).attr('id') === 'editNilai';
        let tipeSelect = isEdit ? $('#editTipe') : $('#tipePromo');

        if (tipeSelect.val() === 'nominal') {
            let nilai = this.value.replace(/\D/g, '');
            if (nilai) {
                let rupiah = new Intl.NumberFormat('id-ID').format(nilai);
                this.value = rupiah;
            }
        }
    });

    // ===== HANDLE EDIT BUTTON CLICK =====
    $(document).on('click', '.btn-edit', function() {
        let id = $(this).data('id');

        Swal.fire({
            title: 'Memuat...',
            text: 'Mohon tunggu sebentar',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        $.ajax({
            url: '/promo/get/' + id,
            type: 'GET',
            success: function(response) {
                Swal.close();

                if (response.success) {
                    let promo = response.data;

                    $('#editNama').val(promo.name);
                    $('#editKategori').val(promo.category);
                    $('#editTipe').val(promo.type);
                    $('#editNilai').val(promo.value_formatted || promo.value);
                    $('#editBerlaku').val(promo.validity_period);
                    $('#editStatus').val(promo.status);
                    $('#editDeskripsi').val(promo.description);

                    if (promo.validity_period === 'periode') {
                        $('#editStart').val(promo.start_date);
                        $('#editEnd').val(promo.end_date);
                        $('#editPeriodeContainer').show();
                        $('#editStart, #editEnd').prop('required', true);
                    } else {
                        $('#editPeriodeContainer').hide();
                        $('#editStart, #editEnd').prop('required', false);
                    }

                    $('#formEditPromo').attr('action', '/promo/' + id);
                    $('#modalEditPromo').modal('show');
                }
            },
            error: function(xhr, status, error) {
                Swal.close();
                console.error('Error:', error);

                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Gagal mengambil data promo',
                    confirmButtonColor: '#9a55ff',
                    confirmButtonText: 'OK'
                });
            }
        });
    });

    // ===== HANDLE DELETE BUTTON CLICK =====
    $(document).on('click', '.btn-delete', function() {
        let form = $(this).closest('.form-delete');
        let name = $(this).data('name');

        Swal.fire({
            title: 'Hapus Promo?',
            text: "Promo " + name + " akan dihapus",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Menghapus...',
                    text: 'Mohon tunggu sebentar',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
                form.submit();
            }
        });
    });

    // Filter form submit with loading
    $('#filterFormMobile, #filterFormDesktop').on('submit', function() {
        Swal.fire({
            title: 'Memuat...',
            text: 'Mohon tunggu sebentar',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });
    });

    // Reset button with loading
    $('a[href="{{ route('promo.index') }}"]').on('click', function(e) {
        e.preventDefault();
        let href = $(this).attr('href');

        Swal.fire({
            title: 'Memuat...',
            text: 'Mohon tunggu sebentar',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        window.location.href = href;
    });
});

// Sweet Alert untuk session success - DENGAN TIMER 3000, PROGRESS BAR, DAN TOMBOL OK
@if(session('success'))
    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: "{{ session('success') }}",
        timer: 3000,
        timerProgressBar: true,
        confirmButtonText: 'OK',
        confirmButtonColor: '#9a55ff'
    });
@endif

// Sweet Alert untuk session error - TANPA TIMER (pakai tombol OK)
@if(session('error'))
    Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: "{{ session('error') }}",
        confirmButtonColor: '#9a55ff',
        confirmButtonText: 'OK'
    });
@endif
</script>
@endpush
