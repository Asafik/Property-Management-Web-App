@extends('layouts.partial.app')

@section('title', 'Master Biaya Legalitas & Administrasi - Property Management App')

@push('styles')
<style>
    .header-card {
        background: linear-gradient(135deg, #ffffff 0%, #faf8ff 100%);
        border: 1px solid #ede8f7 !important;
        border-radius: 14px;
    }

    .badge-legalitas {
        background: rgba(126, 34, 206, 0.1);
        color: #7e22ce;
        border: 1px solid rgba(126, 34, 206, 0.2);
    }
    .badge-pajak {
        background: rgba(220, 38, 38, 0.1);
        color: #dc2626;
        border: 1px solid rgba(220, 38, 38, 0.2);
    }
    .badge-broker {
        background: rgba(217, 119, 6, 0.1);
        color: #d97706;
        border: 1px solid rgba(217, 119, 6, 0.2);
    }
    .badge-desa {
        background: rgba(16, 185, 129, 0.1);
        color: #059669;
        border: 1px solid rgba(16, 185, 129, 0.2);
    }
    .badge-admin {
        background: rgba(59, 130, 246, 0.1);
        color: #2563eb;
        border: 1px solid rgba(59, 130, 246, 0.2);
    }

    #modalBiayaLegalitas .input-group {
        display: flex !important;
        flex-wrap: nowrap !important;
    }
    #modalBiayaLegalitas input.form-control,
    #modalBiayaLegalitas select.form-control,
    #modalBiayaLegalitas .input-group-text {
        height: 38px;
        font-size: 0.88rem;
    }
    #modalBiayaLegalitas textarea.form-control {
        height: auto !important;
        font-size: 0.88rem;
        line-height: 1.6;
    }

    /* Tablet & Mobile Responsiveness */
    @media (max-width: 767.98px) {
        #modalBiayaLegalitas .modal-dialog {
            margin: 0.75rem auto !important;
            max-width: calc(100% - 1.5rem) !important;
        }
        #modalBiayaLegalitas .modal-body {
            max-height: 72vh !important;
            padding: 1rem !important;
        }
        #modalBiayaLegalitas .modal-header,
        #modalBiayaLegalitas .modal-footer {
            padding: 0.75rem 1rem !important;
        }
        #modalBiayaLegalitas .modal-title {
            font-size: 0.95rem !important;
        }
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
                        <div class="d-flex align-items-center gap-2 mb-1">
                            <h3 class="text-dark mb-0 fw-bold" style="font-size: 1.35rem;">
                                Master Biaya Legalitas, Pajak & Administrasi
                            </h3>
                            <span class="badge bg-purple-subtle text-purple px-2 py-1" style="background: rgba(154, 85, 255, 0.15); color: #7e22ce; font-size: 11px; font-weight: 700;">
                                Transaksi Tanah & Land Bank
                            </span>
                        </div>
                        <p class="text-muted mb-0" style="font-size: 0.9rem;">
                            Katalog acuan tarif baku IJB/PPJB Notaris, Estimasi Pajak PPh/BPHTB, Fee Makelar, Kompensasi Desa, hingga biaya kustom operasional tanah.
                        </p>
                    </div>
                    <div class="d-none d-sm-block pe-2">
                        <i class="mdi mdi-cash-multiple" style="font-size: 3.2rem; color: #9a55ff; opacity: 0.25;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Stats Cards -->
    <div class="row g-3 mb-3 mb-md-4">
        <div class="col-12 col-sm-6 col-md-3">
            <div class="card shadow-sm border-0 h-100 mb-0">
                <div class="card-body d-flex justify-content-between align-items-center p-3">
                    <div>
                        <h4 class="text-dark mb-1 fw-bold">{{ $stats['total'] ?? 0 }}</h4>
                        <p class="text-muted mb-0" style="font-size: 0.85rem;">Total Komponen Biaya</p>
                    </div>
                    <div class="d-none d-sm-block">
                        <i class="mdi mdi-calculator-variant-outline" style="font-size: 2.2rem; color: #9a55ff; opacity: 0.25;"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="card shadow-sm border-0 h-100 mb-0">
                <div class="card-body d-flex justify-content-between align-items-center p-3">
                    <div>
                        <h4 class="text-success mb-1 fw-bold">{{ $stats['active'] ?? 0 }}</h4>
                        <p class="text-muted mb-0" style="font-size: 0.85rem;">Biaya Aktif</p>
                    </div>
                    <div class="d-none d-sm-block">
                        <i class="mdi mdi-check-circle-outline" style="font-size: 2.2rem; color: #28a745; opacity: 0.25;"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="card shadow-sm border-0 h-100 mb-0">
                <div class="card-body d-flex justify-content-between align-items-center p-3">
                    <div>
                        <h4 class="text-primary mb-1 fw-bold" style="color: #6f42c1 !important;">{{ $stats['standard'] ?? 0 }}</h4>
                        <p class="text-muted mb-0" style="font-size: 0.85rem;">Komponen Baku Standar</p>
                    </div>
                    <div class="d-none d-sm-block">
                        <i class="mdi mdi-star-circle-outline" style="font-size: 2.2rem; color: #6f42c1; opacity: 0.25;"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="card shadow-sm border-0 h-100 mb-0">
                <div class="card-body d-flex justify-content-between align-items-center p-3">
                    <div>
                        <h4 class="text-info mb-1 fw-bold" style="color: #0284c7 !important;">{{ $stats['custom'] ?? 0 }}</h4>
                        <p class="text-muted mb-0" style="font-size: 0.85rem;">Biaya Tambahan / Opsi</p>
                    </div>
                    <div class="d-none d-sm-block">
                        <i class="mdi mdi-plus-box-multiple-outline" style="font-size: 2.2rem; color: #0284c7; opacity: 0.25;"></i>
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
                            Daftar Komponen Biaya Legalitas & Administrasi
                        </h5>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <a href="{{ route('pralandbank.all') }}" class="btn btn-sm btn-outline-secondary d-flex align-items-center gap-1 shadow-xs px-3 py-2">
                            <i class="mdi mdi-arrow-left" style="font-size: 1rem;"></i>
                            <span>Kembali ke Pra Land Bank</span>
                        </a>
                        <button type="button" class="btn btn-sm btn-gradient-primary d-flex align-items-center gap-1 shadow-sm px-3 py-2" onclick="openModal('tambah')">
                            <i class="mdi mdi-plus-circle" style="font-size: 1.05rem;"></i>
                            <span class="fw-semibold">Tambah Komponen Biaya</span>
                        </button>
                    </div>
                </div>

                <div class="card-body p-3 p-md-4">
                    <!-- Filter Section -->
                    <div class="filter-card mb-3 p-3" style="background-color: #fcfbfe; border: 1px solid #f0ecf8; border-radius: 10px;">
                        <!-- Desktop Version -->
                        <div class="filter-row-desktop d-none d-md-block">
                            <form id="filterForm" method="GET" action="{{ route('master.biaya-legalitas.index') }}">
                                <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 w-100">
                                    <div class="d-flex flex-wrap align-items-center gap-2 flex-grow-1">
                                        <!-- Search Input -->
                                        <div style="min-width: 250px; max-width: 300px; flex: 1;">
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="search" id="searchInput"
                                                    placeholder="Cari kode, nama biaya, deskripsi..."
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
                                        <div style="width: 200px;">
                                            <select class="form-control" name="kategori" id="categorySelect" onchange="document.getElementById('filterForm').submit()">
                                                <option value="">Semua Kategori</option>
                                                @foreach($categories as $catKey => $catLabel)
                                                    <option value="{{ $catKey }}" {{ request('kategori') == $catKey ? 'selected' : '' }}>{{ $catKey }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <!-- Tipe Perhitungan Filter -->
                                        <div style="width: 170px;">
                                            <select class="form-control" name="tipe_perhitungan" id="tipeSelect" onchange="document.getElementById('filterForm').submit()">
                                                <option value="">Semua Tipe</option>
                                                <option value="nominal_tetap" {{ request('tipe_perhitungan') == 'nominal_tetap' ? 'selected' : '' }}>Nominal Tetap</option>
                                                <option value="persentase" {{ request('tipe_perhitungan') == 'persentase' ? 'selected' : '' }}>Persentase (%)</option>
                                                <option value="fleksibel" {{ request('tipe_perhitungan') == 'fleksibel' ? 'selected' : '' }}>Fleksibel / Manual</option>
                                            </select>
                                        </div>

                                        <!-- Status Filter -->
                                        <div style="width: 130px;">
                                            <select class="form-control" name="status" id="statusSelect" onchange="document.getElementById('filterForm').submit()">
                                                <option value="">Semua Status</option>
                                                <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Aktif</option>
                                                <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Nonaktif</option>
                                            </select>
                                        </div>

                                        <!-- Sifat Standar Filter -->
                                        <div style="width: 140px;">
                                            <select class="form-control" name="is_standard" id="standardSelect" onchange="document.getElementById('filterForm').submit()">
                                                <option value="">Semua Sifat</option>
                                                <option value="1" {{ request('is_standard') === '1' ? 'selected' : '' }}>Baku Standar</option>
                                                <option value="0" {{ request('is_standard') === '0' ? 'selected' : '' }}>Tambahan</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Right Limit & Buttons -->
                                    <div class="d-flex align-items-center gap-2 ms-auto">
                                        <div style="width: 110px;">
                                            <select class="form-control" name="per_page" id="perPageSelect" onchange="document.getElementById('filterForm').submit()">
                                                <option value="10" {{ request('per_page', 15) == 10 ? 'selected' : '' }}>10 data</option>
                                                <option value="15" {{ request('per_page', 15) == 15 ? 'selected' : '' }}>15 data</option>
                                                <option value="25" {{ request('per_page', 15) == 25 ? 'selected' : '' }}>25 data</option>
                                                <option value="50" {{ request('per_page', 15) == 50 ? 'selected' : '' }}>50 data</option>
                                            </select>
                                        </div>

                                        <button type="submit" class="btn btn-gradient-primary btn-icon-only" title="Filter">
                                            <i class="mdi mdi-filter"></i>
                                        </button>
                                        <a href="{{ route('master.biaya-legalitas.index') }}" class="btn btn-gradient-secondary btn-icon-only" title="Reset">
                                            <i class="mdi mdi-refresh"></i>
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <!-- Mobile Version -->
                        <div class="filter-row-mobile d-block d-md-none">
                            <form method="GET" action="{{ route('master.biaya-legalitas.index') }}">
                                <div class="row g-2">
                                    <div class="col-12 mb-2">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="search"
                                                placeholder="Cari kode, nama..."
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
                                        <select class="form-control" name="kategori">
                                            <option value="">Semua Kategori</option>
                                            @foreach($categories as $catKey => $catLabel)
                                                <option value="{{ $catKey }}" {{ request('kategori') == $catKey ? 'selected' : '' }}>{{ $catKey }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-6 mb-2">
                                        <select class="form-control" name="tipe_perhitungan">
                                            <option value="">Semua Tipe</option>
                                            <option value="nominal_tetap" {{ request('tipe_perhitungan') == 'nominal_tetap' ? 'selected' : '' }}>Nominal Tetap</option>
                                            <option value="persentase" {{ request('tipe_perhitungan') == 'persentase' ? 'selected' : '' }}>Persentase (%)</option>
                                            <option value="fleksibel" {{ request('tipe_perhitungan') == 'fleksibel' ? 'selected' : '' }}>Fleksibel</option>
                                        </select>
                                    </div>

                                    <div class="col-6 mb-2">
                                        <select class="form-control" name="status">
                                            <option value="">Semua Status</option>
                                            <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Aktif</option>
                                            <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Nonaktif</option>
                                        </select>
                                    </div>

                                    <div class="col-6">
                                        <button type="submit" class="btn btn-gradient-primary w-100 d-flex align-items-center justify-content-center gap-1">
                                            <i class="mdi mdi-filter"></i> Filter
                                        </button>
                                    </div>
                                    <div class="col-6">
                                        <a href="{{ route('master.biaya-legalitas.index') }}" class="btn btn-gradient-secondary w-100 d-flex align-items-center justify-content-center gap-1">
                                            <i class="mdi mdi-refresh"></i> Reset
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Alerts -->
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="mdi mdi-check-circle me-1"></i> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="mdi mdi-alert-circle me-1"></i> {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <!-- Table Data -->
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0" style="font-size: 0.88rem;">
                            <thead class="table-light">
                                <tr>
                                    <th class="text-center" style="width: 45px;">No</th>
                                    <th style="width: 150px;">Kode Biaya</th>
                                    <th>Nama Komponen Biaya & Keterangan</th>
                                    <th style="width: 170px;">Kategori</th>
                                    <th style="width: 160px;">Tipe & Acuan</th>
                                    <th style="width: 140px;">Penanggung</th>
                                    <th class="text-center" style="width: 100px;">Sifat</th>
                                    <th class="text-center" style="width: 90px;">Status</th>
                                    <th class="text-center" style="width: 100px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($biayas as $index => $item)
                                    @php
                                        $catClass = match($item->kategori) {
                                            'Legalitas & Notaris'       => 'badge-legalitas',
                                            'Pajak & Retribusi'         => 'badge-pajak',
                                            'Perantara & Broker'        => 'badge-broker',
                                            'Perizinan & Kas Desa'      => 'badge-desa',
                                            default                     => 'badge-admin',
                                        };
                                    @endphp
                                    <tr>
                                        <td class="text-center text-muted fw-semibold">
                                            {{ $biayas->firstItem() + $index }}
                                        </td>
                                        <td>
                                            <span class="badge bg-light text-dark border font-monospace px-2 py-1" style="font-size: 11px;">
                                                {{ $item->kode_biaya }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="fw-bold text-dark">{{ $item->nama_biaya }}</div>
                                            @if($item->deskripsi)
                                                <small class="text-muted d-block text-truncate" style="max-width: 320px;" title="{{ $item->deskripsi }}">
                                                    {{ $item->deskripsi }}
                                                </small>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="badge {{ $catClass }} px-2 py-1" style="font-size: 11px; font-weight: 600;">
                                                {{ $item->kategori }}
                                            </span>
                                        </td>
                                        <td>
                                            @if($item->tipe_perhitungan === 'nominal_tetap')
                                                <span class="badge bg-light text-dark border">Nominal Tetap</span>
                                                <div class="fw-bold text-success mt-1" style="font-size: 0.82rem;">
                                                    Rp {{ number_format($item->nominal_standar ?? 0, 0, ',', '.') }}
                                                </div>
                                            @elseif($item->tipe_perhitungan === 'persentase')
                                                <span class="badge bg-warning-subtle text-warning border border-warning" style="color: #b45309 !important;">
                                                    Persentase (%)
                                                </span>
                                                <div class="fw-bold text-dark mt-1" style="font-size: 0.82rem;">
                                                    {{ $item->persentase_standar }}% dari Deal
                                                    @if($item->nominal_standar)
                                                        <span class="text-muted fw-normal d-block" style="font-size: 10px;">(Est: Rp {{ number_format($item->nominal_standar, 0, ',', '.') }})</span>
                                                    @endif
                                                </div>
                                            @else
                                                <span class="badge bg-secondary text-white">Fleksibel / Bebas</span>
                                                @if($item->nominal_standar)
                                                    <div class="text-muted mt-1" style="font-size: 0.8rem;">
                                                        Acuan: Rp {{ number_format($item->nominal_standar, 0, ',', '.') }}
                                                    </div>
                                                @endif
                                            @endif
                                        </td>
                                        <td>
                                            <span class="badge bg-light text-secondary border px-2 py-1" style="font-size: 11px;">
                                                {{ $pihakPenanggung[$item->pihak_penanggung] ?? ucfirst($item->pihak_penanggung) }}
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            @if($item->is_standard)
                                                <span class="badge bg-purple-subtle text-purple border" style="background: rgba(126, 34, 206, 0.1); color: #7e22ce; border-color: rgba(126, 34, 206, 0.2) !important; font-size: 11px;" title="Komponen standar baku di form Pra Land Bank">
                                                    <i class="mdi mdi-star me-1"></i> Baku
                                                </span>
                                            @else
                                                <span class="badge bg-light text-muted border" style="font-size: 11px;">
                                                    Tambahan
                                                </span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <div class="form-check form-switch d-inline-block mb-0">
                                                <input class="form-check-input" type="checkbox" role="switch"
                                                    id="switchStatus_{{ $item->id }}"
                                                    {{ $item->is_active ? 'checked' : '' }}
                                                    onchange="toggleActiveStatus({{ $item->id }}, this)">
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="d-inline-flex align-items-center gap-1">
                                                <button type="button" class="btn btn-sm btn-outline-primary p-1 px-2"
                                                    title="Edit Data"
                                                    onclick="editBiaya({{ $item->id }})">
                                                    <i class="mdi mdi-pencil" style="font-size: 0.95rem;"></i>
                                                </button>
                                                <button type="button" class="btn btn-sm btn-outline-danger p-1 px-2"
                                                    title="Hapus Data"
                                                    onclick="deleteBiaya({{ $item->id }}, '{{ addslashes($item->nama_biaya) }}')">
                                                    <i class="mdi mdi-delete" style="font-size: 0.95rem;"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center py-5 text-muted">
                                            <i class="mdi mdi-cash-remove mb-2" style="font-size: 3rem; color: #d1d5db;"></i>
                                            <h6 class="fw-bold mb-1">Belum ada data Master Biaya Legalitas</h6>
                                            <p class="mb-3" style="font-size: 0.85rem;">Silakan tambahkan komponen biaya baru atau reset filter.</p>
                                            <button type="button" class="btn btn-sm btn-gradient-primary" onclick="openModal('tambah')">
                                                <i class="mdi mdi-plus-circle me-1"></i> Tambah Komponen Baru
                                            </button>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if($biayas->hasPages())
                        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center gap-2 mt-4 pt-3 border-top">
                            <small class="text-muted">
                                Menampilkan {{ $biayas->firstItem() }} s/d {{ $biayas->lastItem() }} dari {{ $biayas->total() }} data
                            </small>
                            <div>
                                {{ $biayas->links('pagination::bootstrap-5') }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah/Edit Master Biaya Legalitas -->
<div class="modal fade" id="modalBiayaLegalitas" tabindex="-1" aria-labelledby="modalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-gradient-primary text-white py-3 px-4">
                <h5 class="modal-title fw-bold text-white d-flex align-items-center gap-2" id="modalTitle">
                    <i class="mdi mdi-cash-multiple" style="font-size: 1.25rem;"></i>
                    <span id="modalTitleText">Tambah Master Biaya Legalitas</span>
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formBiayaLegalitas" method="POST" action="{{ route('master.biaya-legalitas.store') }}">
                @csrf
                <div id="methodContainer"></div>

                <div class="modal-body p-4" style="max-height: 75vh; overflow-y: auto;">
                    <div class="row g-3">
                        <!-- Kode Biaya -->
                        <div class="col-md-5">
                            <label class="form-label fw-semibold text-dark" style="font-size: 0.85rem;">
                                Kode Biaya <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="kode_biaya" id="modal_kode_biaya" class="form-control font-monospace" placeholder="Contoh: BIAYA-IJB-PPJB" required style="text-transform: uppercase;">
                            <small class="text-muted" style="font-size: 11px;">Unik, huruf kapital dan strip (A-Z, 0-9, -)</small>
                        </div>

                        <!-- Nama Biaya -->
                        <div class="col-md-7">
                            <label class="form-label fw-semibold text-dark" style="font-size: 0.85rem;">
                                Nama Komponen Biaya <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="nama_biaya" id="modal_nama_biaya" class="form-control" placeholder="Contoh: Biaya IJB / PPJB Notaris" required>
                        </div>

                        <!-- Kategori -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-dark" style="font-size: 0.85rem;">
                                Kategori <span class="text-danger">*</span>
                            </label>
                            <select name="kategori" id="modal_kategori" class="form-control" required>
                                <option value="">-- Pilih Kategori --</option>
                                @foreach($categories as $catKey => $catLabel)
                                    <option value="{{ $catKey }}">{{ $catKey }} ({{ $catLabel }})</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Tipe Perhitungan -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-dark" style="font-size: 0.85rem;">
                                Tipe Perhitungan Biaya <span class="text-danger">*</span>
                            </label>
                            <select name="tipe_perhitungan" id="modal_tipe_perhitungan" class="form-control" required onchange="handleTipePerhitunganChange()">
                                <option value="nominal_tetap">Nominal Tetap (Rp Acuan)</option>
                                <option value="persentase">Persentase (% dari Deal Price)</option>
                                <option value="fleksibel">Fleksibel / Input Bebas</option>
                            </select>
                        </div>

                        <!-- Nominal Standar -->
                        <div class="col-md-6" id="container_nominal_standar">
                            <label class="form-label fw-semibold text-dark" style="font-size: 0.85rem;">
                                Estimasi / Nominal Standar (Rp)
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light fw-bold text-muted">Rp</span>
                                <input type="text" name="nominal_standar" id="modal_nominal_standar" class="form-control" placeholder="Contoh: 10.000.000" onkeyup="formatRupiah(this)">
                            </div>
                        </div>

                        <!-- Persentase Standar -->
                        <div class="col-md-6" id="container_persentase_standar" style="display: none;">
                            <label class="form-label fw-semibold text-dark" style="font-size: 0.85rem;">
                                Persentase Standar (%)
                            </label>
                            <div class="input-group">
                                <input type="number" step="0.01" min="0" max="100" name="persentase_standar" id="modal_persentase_standar" class="form-control" placeholder="Contoh: 2.50 atau 5.00">
                                <span class="input-group-text bg-light fw-bold text-muted">%</span>
                            </div>
                            <small class="text-muted" style="font-size: 11px;">Dihitung otomatis terhadap Deal Price saat di form Pra Land Bank</small>
                        </div>

                        <!-- Pihak Penanggung -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-dark" style="font-size: 0.85rem;">
                                Pihak Penanggung Beban <span class="text-danger">*</span>
                            </label>
                            <select name="pihak_penanggung" id="modal_pihak_penanggung" class="form-control" required>
                                @foreach($pihakPenanggung as $val => $label)
                                    <option value="{{ $val }}">{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Urutan -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-dark" style="font-size: 0.85rem;">
                                Urutan Tampilan
                            </label>
                            <input type="number" name="urutan" id="modal_urutan" class="form-control" min="0" value="0">
                        </div>

                        <!-- Deskripsi / Acuan Perhitungan -->
                        <div class="col-12">
                            <label class="form-label fw-semibold text-dark" style="font-size: 0.85rem;">
                                Deskripsi / Dasar Acuan Perhitungan
                            </label>
                            <textarea name="deskripsi" id="modal_deskripsi" class="form-control" rows="2" placeholder="Catatan aturan hukum, peruntukan biaya, atau keterangan lainnya..."></textarea>
                        </div>

                        <!-- Checkboxes & Switches -->
                        <div class="col-12">
                            <div class="card p-3 border rounded-3" style="background: #fdfcff;">
                                <div class="row g-3">
                                    <div class="col-sm-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="is_standard" id="modal_is_standard" value="1">
                                            <label class="form-check-label fw-semibold text-dark" for="modal_is_standard" style="font-size: 0.85rem;">
                                                Komponen Baku Form
                                            </label>
                                            <small class="text-muted d-block" style="font-size: 11px;">Muncul secara default di form utama</small>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="is_required" id="modal_is_required" value="1">
                                            <label class="form-check-label fw-semibold text-dark" for="modal_is_required" style="font-size: 0.85rem;">
                                                Wajib Diisi (Required)
                                            </label>
                                            <small class="text-muted d-block" style="font-size: 11px;">Form transaksi wajib mengisi komponen ini</small>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" name="is_active" id="modal_is_active" value="1" checked>
                                            <label class="form-check-label fw-semibold text-success" for="modal_is_active" style="font-size: 0.85rem;">
                                                Status Aktif
                                            </label>
                                            <small class="text-muted d-block" style="font-size: 11px;">Bisa dipilih di form transaksi</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light py-2 px-4 border-top">
                    <button type="button" class="btn btn-secondary px-3" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-gradient-primary px-4 fw-bold" id="btnSubmitModal">
                        <i class="mdi mdi-content-save me-1"></i> Simpan Data
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Hidden Delete Form -->
<form id="deleteBiayaForm" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>

@endsection

@push('scripts')
<script>
    function formatRupiah(input) {
        let value = input.value.replace(/[^0-9]/g, '');
        if (value) {
            input.value = new Intl.NumberFormat('id-ID').format(value);
        } else {
            input.value = '';
        }
    }

    function handleTipePerhitunganChange() {
        const tipe = document.getElementById('modal_tipe_perhitungan').value;
        const containerNominal = document.getElementById('container_nominal_standar');
        const containerPersen = document.getElementById('container_persentase_standar');

        if (tipe === 'persentase') {
            containerPersen.style.display = 'block';
            containerNominal.style.display = 'block';
            containerNominal.querySelector('label').textContent = 'Estimasi Nominal Awal (Opsional)';
        } else if (tipe === 'nominal_tetap') {
            containerPersen.style.display = 'none';
            containerNominal.style.display = 'block';
            containerNominal.querySelector('label').textContent = 'Estimasi / Nominal Standar (Rp)';
        } else {
            // Fleksibel
            containerPersen.style.display = 'none';
            containerNominal.style.display = 'block';
            containerNominal.querySelector('label').textContent = 'Nominal Acuan Default (Opsional)';
        }
    }

    function openModal(action) {
        const form = document.getElementById('formBiayaLegalitas');
        const modalTitle = document.getElementById('modalTitleText');
        const methodContainer = document.getElementById('methodContainer');

        form.reset();
        methodContainer.innerHTML = '';

        if (action === 'tambah') {
            modalTitle.textContent = 'Tambah Master Biaya Legalitas & Admin';
            form.action = "{{ route('master.biaya-legalitas.store') }}";
            document.getElementById('modal_is_active').checked = true;
            document.getElementById('modal_tipe_perhitungan').value = 'nominal_tetap';
            handleTipePerhitunganChange();
        }

        const modal = new bootstrap.Modal(document.getElementById('modalBiayaLegalitas'));
        modal.show();
    }

    function editBiaya(id) {
        fetch(`/master-data/biaya-legalitas/${id}/edit`)
            .then(res => res.json())
            .then(data => {
                const form = document.getElementById('formBiayaLegalitas');
                const modalTitle = document.getElementById('modalTitleText');
                const methodContainer = document.getElementById('methodContainer');

                form.reset();
                methodContainer.innerHTML = '<input type="hidden" name="_method" value="PUT">';
                form.action = `/master-data/biaya-legalitas/${id}`;
                modalTitle.textContent = 'Edit Master Biaya Legalitas: ' + data.nama_biaya;

                document.getElementById('modal_kode_biaya').value = data.kode_biaya;
                document.getElementById('modal_nama_biaya').value = data.nama_biaya;
                document.getElementById('modal_kategori').value = data.kategori;
                document.getElementById('modal_tipe_perhitungan').value = data.tipe_perhitungan;
                document.getElementById('modal_pihak_penanggung').value = data.pihak_penanggung;
                document.getElementById('modal_urutan').value = data.urutan || 0;
                document.getElementById('modal_deskripsi').value = data.deskripsi || '';

                if (data.nominal_standar) {
                    document.getElementById('modal_nominal_standar').value = new Intl.NumberFormat('id-ID').format(data.nominal_standar);
                } else {
                    document.getElementById('modal_nominal_standar').value = '';
                }

                document.getElementById('modal_persentase_standar').value = data.persentase_standar || '';

                document.getElementById('modal_is_standard').checked = !!data.is_standard;
                document.getElementById('modal_is_required').checked = !!data.is_required;
                document.getElementById('modal_is_active').checked = !!data.is_active;

                handleTipePerhitunganChange();

                const modal = new bootstrap.Modal(document.getElementById('modalBiayaLegalitas'));
                modal.show();
            })
            .catch(err => {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal Memuat Data',
                    text: 'Tidak dapat mengambil detail biaya: ' + err.message
                });
            });
    }

    function toggleActiveStatus(id, checkbox) {
        const originalState = !checkbox.checked;
        fetch(`/master-data/biaya-legalitas/${id}/toggle-status`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            }
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                const toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 2000,
                    timerProgressBar: true
                });
                toast.fire({
                    icon: 'success',
                    title: data.message
                });
            } else {
                checkbox.checked = originalState;
                Swal.fire('Gagal!', data.message || 'Gagal memperbarui status', 'error');
            }
        })
        .catch(err => {
            checkbox.checked = originalState;
            Swal.fire('Error!', 'Terjadi kesalahan sistem: ' + err.message, 'error');
        });
    }

    function deleteBiaya(id, name) {
        Swal.fire({
            title: 'Hapus Komponen Biaya?',
            html: `Apakah Anda yakin ingin menghapus <strong>"${name}"</strong> dari Master Data?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: '<i class="mdi mdi-delete me-1"></i> Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                const form = document.getElementById('deleteBiayaForm');
                form.action = `/master-data/biaya-legalitas/${id}`;
                form.submit();
            }
        });
    }
</script>
@endpush
