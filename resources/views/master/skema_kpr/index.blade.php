@extends('layouts.partial.app')

@section('title', 'Master Skema Angsuran KPR - Property Management App')

@push('styles')
<style>
    /* Table Styling Sesuai Catalog Unit */
    .table-unit {
        width: 100% !important;
        margin-bottom: 0;
    }
    .table-unit thead th {
        background: #f8fafc !important;
        color: #4b5563 !important;
        font-weight: 700;
        font-size: 0.78rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border-bottom: 2px solid #e2e8f0 !important;
        padding: 0.75rem 0.65rem !important;
        vertical-align: middle;
        white-space: nowrap;
    }
    .table-unit tbody td {
        padding: 0.75rem 0.65rem !important;
        vertical-align: middle;
        font-size: 0.83rem;
        border-bottom: 1px solid #f1f5f9;
    }
    .table-unit .col-no {
        width: 45px;
        text-align: center;
        white-space: nowrap !important;
    }
    .table-unit .col-status {
        width: 110px;
        text-align: center;
        white-space: nowrap !important;
    }
    .table-unit .col-aksi {
        width: 100px;
        text-align: center;
        white-space: nowrap !important;
    }

    .card.compact-table-card,
    .compact-table-card {
        background: #ffffff !important;
        border: 1px solid #e2e8f0 !important;
        border-radius: 8px !important;
        box-shadow: none !important;
        overflow: hidden;
    }

    .compact-table-card .card-body,
    .card.compact-table-card .card-body {
        padding: 0.75rem 1.25rem 1.15rem 1.25rem !important;
        background: #ffffff !important;
    }

    .filter-card {
        margin-top: 0 !important;
        margin-bottom: 0.75rem !important;
    }
    .filter-card form {
        margin-bottom: 0 !important;
    }

    /* Action Buttons (Persis Halaman Bank: Amber Edit & Red Delete) */
    .btn-action {
        width: 32px;
        height: 32px;
        padding: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 6px;
        margin: 0 2px;
        transition: all 0.2s ease;
        border: none;
        cursor: pointer;
        font-size: 0.95rem;
        text-decoration: none !important;
        vertical-align: middle;
    }
    .btn-action:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
    }
    .btn-action.edit {
        background: #f59e0b !important;
        color: #ffffff !important;
    }
    .btn-action.delete {
        background: #ef4444 !important;
        color: #ffffff !important;
    }

    /* Status Badge (Persis Halaman Bank) */
    .status-badge {
        padding: 0.25rem 0.65rem;
        border-radius: 4px;
        font-weight: 600;
        font-size: 0.78rem;
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
    }
    .status-badge.aktif {
        background: #16a34a !important;
        color: #ffffff !important;
    }
    .status-badge.nonaktif {
        background: #e9ecef !important;
        color: #6c7383 !important;
        border: 1px solid #dee2e6 !important;
    }

    /* Bank Avatar Box */
    .bank-avatar-box {
        width: 32px;
        height: 32px;
        border-radius: 6px;
        background: #f3e8ff;
        color: #9a55ff;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 1.1rem;
        flex-shrink: 0;
    }

    /* Produk Badge */
    .badge-produk-subsidi {
        background: #ecfdf5;
        color: #059669;
        border: 1px solid #a7f3d0;
        border-radius: 6px;
        font-weight: 600;
        font-size: 0.74rem;
        padding: 4px 8px;
    }
    .badge-produk-syariah {
        background: #f0fdf4;
        color: #16a34a;
        border: 1px solid #bbf7d0;
        border-radius: 6px;
        font-weight: 600;
        font-size: 0.74rem;
        padding: 4px 8px;
    }
    .badge-produk-non-subsidi {
        background: #eff6ff;
        color: #2563eb;
        border: 1px solid #bfdbfe;
        border-radius: 6px;
        font-weight: 600;
        font-size: 0.74rem;
        padding: 4px 8px;
    }

    /* Periode Flat Badge */
    .badge-periode-tahun {
        background: #ede9fe;
        color: #7c3aed;
        border: 1px solid #ddd6fe;
        border-radius: 6px;
        font-weight: 700;
        font-size: 0.78rem;
        padding: 4px 8px;
    }
</style>
@endpush

@section('content')

<div class="container-fluid px-2 px-md-4 py-3">

    <!-- Flash Alert Success / Error -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show d-flex align-items-center gap-2 mb-3" role="alert" style="border-radius: 8px;">
            <i class="mdi mdi-check-circle fs-5"></i>
            <div>{{ session('success') }}</div>
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center gap-2 mb-3" role="alert" style="border-radius: 8px;">
            <i class="mdi mdi-alert-circle fs-5"></i>
            <div>{{ session('error') }}</div>
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Page Title & Subtitle (Persis Catalog Unit & Perizinan) -->
    <div class="row align-items-center mb-4">
        <div class="col">
            <h2 class="text-dark mb-1 fw-bold" style="font-size: 1.55rem; letter-spacing: -0.02em;">
                Master Skema Angsuran KPR
            </h2>
            <p class="text-muted mb-0" style="font-size: 0.88rem;">
                Kelola data nominal angsuran flat KPR per bank, produk, dan tenor tahun (Tahun 1-5, 6-10, dst) untuk pengajuan KPR
            </p>
        </div>
    </div>

    <!-- Main Container: Table & Filters (Sama Persis Catalog Unit) -->
    <div class="row">
        <div class="col-12">
            <div class="card compact-table-card">
                
                <!-- Card Header (Sama Persis Catalog Unit / Perizinan) -->
                <div class="card-header bg-white d-flex flex-wrap flex-md-row justify-content-between align-items-center gap-2" style="padding: 0.65rem 1.25rem !important; border-bottom: 1px solid #e2e8f0 !important;">
                    <div class="d-flex align-items-center gap-2">
                        <div style="width: 32px; height: 32px; border-radius: 6px; background-color: #f3e8ff; color: #9333ea; display: inline-flex; align-items: center; justify-content: center; font-size: 1.15rem; flex-shrink: 0;">
                            <i class="mdi mdi-format-list-bulleted"></i>
                        </div>
                        <span style="font-size: 0.95rem; font-weight: 700; color: #0f172a;">Daftar Skema Angsuran Flat KPR</span>
                    </div>
                    <!-- Tombol Tambah Halaman Sendiri -->
                    <a href="{{ route('master.skema-kpr.create') }}" class="btn btn-sm btn-gradient-primary d-flex align-items-center gap-1 shadow-sm px-3 py-2 fw-semibold" style="border-radius: 6px;">
                        <i class="mdi mdi-plus-circle" style="font-size: 1rem;"></i>
                        <span>Tambah Skema KPR</span>
                    </a>
                </div>

                <div class="card-body">
                    
                    <!-- Toolbar Filter & Search (Sama Persis Catalog Unit / Perizinan) -->
                    <div class="filter-card">
                        <form method="GET" action="{{ route('master.skema-kpr.index') }}" id="filterForm">
                            <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 w-100">
                                
                                <div class="d-flex flex-wrap align-items-center gap-2 flex-grow-1">
                                    <!-- Search Input -->
                                    <div style="min-width: 240px; max-width: 340px; flex: 1;">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="search" id="searchInput"
                                                placeholder="Cari skema, periode, atau bank..."
                                                value="{{ request('search') }}"
                                                style="border-top-right-radius: 0 !important; border-bottom-right-radius: 0 !important; border-right: none;">
                                            <button class="btn btn-gradient-primary d-flex align-items-center justify-content-center px-3" 
                                                type="submit" title="Cari"
                                                style="border-top-left-radius: 0 !important; border-bottom-left-radius: 0 !important; border-top-right-radius: 4px !important; border-bottom-right-radius: 4px !important; height: 38px; box-shadow: none;">
                                                <i class="mdi mdi-magnify" style="font-size: 1.15rem; color: #ffffff;"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <!-- Filter Bank -->
                                    <div style="min-width: 170px;">
                                        <select class="form-control" name="bank_id" onchange="document.getElementById('filterForm').submit()">
                                            <option value="">Semua Bank</option>
                                            @foreach($banks as $b)
                                                <option value="{{ $b->id }}" {{ request('bank_id') == $b->id ? 'selected' : '' }}>
                                                    {{ $b->bank_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Filter Tenor -->
                                    <div style="min-width: 150px;">
                                        <select class="form-control" name="tenor" onchange="document.getElementById('filterForm').submit()">
                                            <option value="">Semua Tenor</option>
                                            <option value="5" {{ request('tenor') == '5' ? 'selected' : '' }}>5 Tahun (60 Bln)</option>
                                            <option value="10" {{ request('tenor') == '10' ? 'selected' : '' }}>10 Tahun (120 Bln)</option>
                                            <option value="15" {{ request('tenor') == '15' ? 'selected' : '' }}>15 Tahun (180 Bln)</option>
                                            <option value="20" {{ request('tenor') == '20' ? 'selected' : '' }}>20 Tahun (240 Bln)</option>
                                        </select>
                                    </div>

                                    <!-- Filter Produk -->
                                    <div style="min-width: 150px;">
                                        <select class="form-control" name="produk_kpr" onchange="document.getElementById('filterForm').submit()">
                                            <option value="">Semua Produk</option>
                                            <option value="subsidi" {{ request('produk_kpr') == 'subsidi' ? 'selected' : '' }}>KPR Subsidi</option>
                                            <option value="non_subsidi" {{ request('produk_kpr') == 'non_subsidi' ? 'selected' : '' }}>KPR Non Subsidi</option>
                                            <option value="syariah" {{ request('produk_kpr') == 'syariah' ? 'selected' : '' }}>KPR Syariah</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Action Filter / Reset Buttons (Sama Persis Catalog Unit) -->
                                <div class="d-flex align-items-center gap-2 ms-auto">
                                    <button type="submit" class="btn btn-gradient-primary btn-icon-only" title="Terapkan Filter">
                                        <i class="mdi mdi-filter"></i>
                                    </button>
                                    <a href="{{ route('master.skema-kpr.index') }}" class="btn btn-gradient-secondary btn-icon-only" title="Reset Filter">
                                        <i class="mdi mdi-refresh"></i>
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Clean Table (Sesuai Catalog Unit) -->
                    <div class="table-responsive">
                        <table class="table table-hover align-middle table-unit mb-0">
                            <thead>
                                <tr>
                                    <th class="col-no text-center">No</th>
                                    <th>Bank Tujuan</th>
                                    <th>Produk KPR</th>
                                    <th>Tenor</th>
                                    <th class="text-center">Bunga (%)</th>
                                    <th>Periode Cicilan (Flat)</th>
                                    <th style="min-width: 140px;">Angsuran / Bulan</th>
                                    <th class="col-status text-center">Status</th>
                                    <th class="col-aksi text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($skemas as $index => $item)
                                    <tr>
                                        <td class="col-no fw-bold text-center text-muted">
                                            {{ $skemas->firstItem() + $index }}
                                        </td>

                                        <td>
                                            <div class="d-flex align-items-center gap-2">
                                                <div class="bank-avatar-box">
                                                    <i class="mdi mdi-bank"></i>
                                                </div>
                                                <span class="fw-bold text-dark" style="font-size: 0.88rem;">
                                                    {{ $item->bank->bank_name ?? '-' }}
                                                </span>
                                            </div>
                                        </td>

                                        <td>
                                            @if($item->produk_kpr === 'subsidi')
                                                <span class="badge badge-produk-subsidi">
                                                    <i class="mdi mdi-shield-check-outline me-1"></i>KPR Subsidi
                                                </span>
                                            @elseif($item->produk_kpr === 'syariah')
                                                <span class="badge badge-produk-syariah">
                                                    <i class="mdi mdi-crescent-moon me-1"></i>KPR Syariah
                                                </span>
                                            @else
                                                <span class="badge badge-produk-non-subsidi">
                                                    <i class="mdi mdi-home-outline me-1"></i>KPR Non Subsidi
                                                </span>
                                            @endif
                                        </td>

                                        <td>
                                            <span class="fw-bold text-dark d-block" style="font-size: 0.86rem; line-height: 1.2;">{{ $item->tenor }} Tahun</span>
                                            <small class="text-muted d-block mt-0.5" style="font-size: 0.73rem;">({{ $item->tenor * 12 }} Bulan)</small>
                                        </td>

                                        <td class="text-center">
                                            <span class="badge bg-light text-dark border fw-bold px-2 py-1" style="font-size: 0.78rem;">
                                                {{ number_format($item->bunga, 2, ',', '.') }}%
                                            </span>
                                        </td>

                                        <td>
                                            <span class="badge badge-periode-tahun">
                                                <i class="mdi mdi-calendar-check me-1"></i>{{ $item->periode_tahun }}
                                            </span>
                                        </td>

                                        <td>
                                            <div class="d-flex align-items-baseline gap-1">
                                                <span class="fw-bold" style="color: #059669; font-size: 0.92rem; font-family: monospace;">
                                                    Rp {{ number_format($item->angsuran_per_bulan, 0, ',', '.') }}
                                                </span>
                                                <small class="text-muted" style="font-size: 0.74rem;">/bln</small>
                                            </div>
                                        </td>

                                        <!-- Status Badge (Persis Halaman Bank) -->
                                        <td class="col-status text-center">
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

                                        <!-- Tombol Aksi (Persis Halaman Bank: Edit Amber & Delete Red) -->
                                        <td class="col-aksi text-center">
                                            <div class="d-inline-flex align-items-center gap-1">
                                                <a href="{{ route('master.skema-kpr.edit', $item->id) }}" class="btn-action edit" title="Edit Skema">
                                                    <i class="mdi mdi-pencil"></i>
                                                </a>
                                                <button type="button" class="btn-action delete" title="Hapus Skema" onclick="confirmDelete({{ $item->id }})">
                                                    <i class="mdi mdi-trash-can-outline"></i>
                                                </button>
                                            </div>
                                            <form id="delete-form-{{ $item->id }}" action="{{ route('master.skema-kpr.destroy', $item->id) }}" method="POST" style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center py-5 text-muted">
                                            <div class="d-flex flex-column align-items-center justify-content-center">
                                                <div class="bank-avatar-box mb-2" style="width: 46px; height: 46px; font-size: 1.4rem;">
                                                    <i class="mdi mdi-calculator-variant-outline"></i>
                                                </div>
                                                <span class="fw-semibold text-dark">Belum ada data skema angsuran KPR</span>
                                                <small class="text-muted mt-1">Silakan klik tombol <strong>Tambah Skema KPR</strong> untuk menambahkan skema baru.</small>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination Sesuai Catalog Unit -->
                    <div class="d-flex justify-content-between align-items-center mt-3 flex-wrap gap-2">
                        <small class="text-muted fw-semibold">
                            Menampilkan {{ $skemas->firstItem() ?? 0 }} - {{ $skemas->lastItem() ?? 0 }} dari {{ $skemas->total() }} data
                        </small>
                        <div>
                            {{ $skemas->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
function confirmDelete(id) {
    Swal.fire({
        title: 'Hapus Skema KPR?',
        text: 'Data skema angsuran ini akan dihapus secara permanen.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, Hapus',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('delete-form-' + id).submit();
        }
    });
}
</script>
@endpush
