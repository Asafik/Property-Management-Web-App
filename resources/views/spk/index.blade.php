@extends('layouts.partial.app')

@section('title', 'Master Data SPK Kontraktor - Property Management App')

@section('content')

    <style>
        .stat-card {
            border: none !important;
            border-radius: 10px;
            background: #ffffff;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.04);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
        }

        .stat-icon-box {
            width: 48px;
            height: 48px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }

        .btn-action {
            width: 32px;
            height: 32px;
            border-radius: 6px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: none;
            color: #ffffff !important;
            transition: all 0.2s ease;
            box-shadow: 0 2px 4px rgba(0,0,0,0.08);
            text-decoration: none;
            cursor: pointer;
        }

        .btn-action i {
            font-size: 0.95rem;
        }

        .btn-action:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.15);
            color: #ffffff !important;
        }

        .btn-action.view {
            background: linear-gradient(135deg, #da8cff, #9a55ff);
        }

        .btn-action.print {
            background: linear-gradient(135deg, #11998e, #38ef7d);
        }

        .btn-action.edit {
            background: linear-gradient(135deg, #36d1dc, #5b86e5);
        }

        .btn-action.delete {
            background: linear-gradient(135deg, #ff416c, #ff4b2b);
        }

        .btn-icon-only {
            width: 38px;
            height: 38px;
            padding: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 4px;
        }

        .header-card {
            background: #ffffff;
            border-radius: 8px !important;
            border: none !important;
            box-shadow: 0 4px 18px rgba(0, 0, 0, 0.04);
            margin-bottom: 0;
        }

        .table thead th {
            color: #9a55ff;
            font-weight: 700;
            font-size: 0.78rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            background: #fbf9ff;
            border-bottom: 1px solid #ebe5f5;
            padding: 0.75rem 0.75rem !important;
        }

        .table tbody td {
            padding: 0.75rem 0.75rem !important;
            vertical-align: middle;
            border-bottom: 1px solid #f2eff8;
            font-size: 0.88rem;
        }

        /* Status Badge Styling */
        .status-badge-spk {
            font-size: 0.75rem;
            font-weight: 600;
            padding: 0.28rem 0.65rem;
            border-radius: 30px;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .status-badge-spk.draft {
            background: rgba(108, 117, 125, 0.12);
            color: #6c757d;
            border: 1px solid rgba(108, 117, 125, 0.25);
        }

        .status-badge-spk.berjalan {
            background: rgba(23, 162, 184, 0.12);
            color: #0d8a9e;
            border: 1px solid rgba(23, 162, 184, 0.25);
        }

        .status-badge-spk.selesai {
            background: rgba(40, 167, 69, 0.12);
            color: #1e7e34;
            border: 1px solid rgba(40, 167, 69, 0.25);
        }

        .status-badge-spk.dibatalkan {
            background: rgba(220, 53, 69, 0.12);
            color: #bd2130;
            border: 1px solid rgba(220, 53, 69, 0.25);
        }
    </style>

    <div class="container-fluid px-1 px-sm-2 px-md-3 py-2 py-md-3">

        <!-- Header Card Banner -->
        <div class="row mb-3 mb-md-4">
            <div class="col-12">
                <div class="card shadow-sm border-0 header-card">
                    <div class="card-body p-4 p-md-4 py-4 py-md-4 d-flex justify-content-between align-items-center" style="min-height: 105px;">
                        <div>
                            <h3 class="text-dark mb-1 fw-bold" style="font-size: 1.35rem;">
                                Surat Perintah Kerja (SPK) Kontraktor
                            </h3>
                            <p class="text-muted mb-0" style="font-size: 0.9rem;">
                                Buat, kelola, monitor termin pembayaran, dan cetak surat resmi SPK kontraktor & pemborong
                            </p>
                        </div>
                        <div class="d-none d-sm-block pe-2">
                            <i class="mdi mdi-file-document-edit-outline" style="font-size: 3rem; color: #9a55ff; opacity: 0.25;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Summary Statistics Cards -->
        <div class="row g-3 mb-3 mb-md-4">
            <div class="col-6 col-md-3">
                <div class="card stat-card p-3">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <span class="text-muted small fw-semibold">Total SPK</span>
                            <h4 class="fw-bold text-dark mb-0 mt-1">{{ $stats['total_spk'] }}</h4>
                        </div>
                        <div class="stat-icon-box" style="background: rgba(154, 85, 255, 0.12); color: #9a55ff;">
                            <i class="mdi mdi-file-document-multiple-outline"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-6 col-md-3">
                <div class="card stat-card p-3">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <span class="text-muted small fw-semibold">SPK Berjalan</span>
                            <h4 class="fw-bold text-info mb-0 mt-1">{{ $stats['spk_berjalan'] }}</h4>
                        </div>
                        <div class="stat-icon-box" style="background: rgba(23, 162, 184, 0.12); color: #17a2b8;">
                            <i class="mdi mdi-progress-clock"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-6 col-md-3">
                <div class="card stat-card p-3">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <span class="text-muted small fw-semibold">SPK Selesai</span>
                            <h4 class="fw-bold text-success mb-0 mt-1">{{ $stats['spk_selesai'] }}</h4>
                        </div>
                        <div class="stat-icon-box" style="background: rgba(40, 167, 69, 0.12); color: #28a745;">
                            <i class="mdi mdi-check-decagram-outline"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-6 col-md-3">
                <div class="card stat-card p-3">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <span class="text-muted small fw-semibold">Total Nilai Kontrak</span>
                            <h5 class="fw-bold text-primary mb-0 mt-1" style="font-size: 1.05rem;">Rp {{ number_format($stats['total_nilai'], 0, ',', '.') }}</h5>
                        </div>
                        <div class="stat-icon-box" style="background: rgba(84, 110, 237, 0.12); color: #546eed;">
                            <i class="mdi mdi-cash-multiple"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabel & Filter Card (Mirroring Halaman Bank) -->
        <div class="row mt-2 mt-sm-2 mt-md-3">
            <div class="col-12">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white d-flex flex-wrap flex-md-row justify-content-between align-items-center gap-2">
                        <h5 class="card-title mb-0">
                            <i class="mdi mdi-format-list-bulleted me-2"></i>Daftar SPK Kontraktor
                        </h5>
                        <a href="{{ route('spk.create') }}" class="btn btn-sm btn-gradient-primary d-flex align-items-center gap-1 shadow-sm">
                            <i class="mdi mdi-plus-circle" style="font-size: 1rem;"></i>
                            <span>Buat SPK Baru</span>
                        </a>
                    </div>

                    <div class="card-body">
                        <!-- Filter Section -->
                        <div class="filter-card mb-3">
                            <!-- Desktop Version -->
                            <div class="filter-row-desktop d-none d-md-block">
                                <form id="filterForm" method="GET" action="{{ route('spk.index') }}" onsubmit="return showFilterLoading()">
                                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 w-100">
                                        <div class="d-flex flex-wrap align-items-center gap-2 flex-grow-1">
                                            <!-- Search Input -->
                                            <div style="min-width: 260px; max-width: 360px; flex: 1;">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" name="search" id="searchInput"
                                                        placeholder="Cari no SPK / kontraktor / pekerjaan..."
                                                        value="{{ request('search') }}"
                                                        style="border-top-right-radius: 0 !important; border-bottom-right-radius: 0 !important; border-right: none;">
                                                    <button class="btn btn-gradient-primary d-flex align-items-center justify-content-center px-3" 
                                                        type="submit" title="Cari"
                                                        style="border-top-left-radius: 0 !important; border-bottom-left-radius: 0 !important; border-top-right-radius: 4px !important; border-bottom-right-radius: 4px !important; height: 38px; box-shadow: none;">
                                                        <i class="mdi mdi-magnify" style="font-size: 1.15rem; color: #ffffff;"></i>
                                                    </button>
                                                </div>
                                            </div>

                                            <!-- Proyek / Land Bank Filter -->
                                            <div style="min-width: 200px;">
                                                <select class="form-control" name="land_bank_id" id="landBankSelect">
                                                    <option value="">Semua Proyek / Land Bank</option>
                                                    @foreach($landBanks as $lb)
                                                        <option value="{{ $lb->id }}" {{ request('land_bank_id') == $lb->id ? 'selected' : '' }}>
                                                            {{ $lb->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <!-- Status Filter -->
                                            <div style="width: 155px;">
                                                <select class="form-control" name="status" id="statusSelect">
                                                    <option value="">Semua Status</option>
                                                    <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                                                    <option value="berjalan" {{ request('status') == 'berjalan' ? 'selected' : '' }}>Berjalan</option>
                                                    <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                                    <option value="dibatalkan" {{ request('status') == 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
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
                                            <a href="{{ route('spk.index') }}" class="btn btn-gradient-secondary btn-icon-only" title="Reset" onclick="showResetLoading(event)">
                                                <i class="mdi mdi-refresh"></i>
                                            </a>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <!-- Mobile Version -->
                            <div class="filter-row-mobile d-block d-md-none">
                                <form method="GET" action="{{ route('spk.index') }}" onsubmit="return showFilterLoading()">
                                    <div class="row g-2">
                                        <div class="col-12 mb-2">
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="search" id="searchInputMobile"
                                                    placeholder="Cari no SPK / kontraktor / pekerjaan..."
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
                                            <select class="form-control" name="land_bank_id">
                                                <option value="">Semua Proyek / Land Bank</option>
                                                @foreach($landBanks as $lb)
                                                    <option value="{{ $lb->id }}" {{ request('land_bank_id') == $lb->id ? 'selected' : '' }}>
                                                        {{ $lb->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-12 mb-2">
                                            <select class="form-control" name="status">
                                                <option value="">Semua Status</option>
                                                <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                                                <option value="berjalan" {{ request('status') == 'berjalan' ? 'selected' : '' }}>Berjalan</option>
                                                <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                                <option value="dibatalkan" {{ request('status') == 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
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
                                            <a href="{{ route('spk.index') }}" class="btn btn-gradient-secondary w-100 d-flex align-items-center justify-content-center gap-1" onclick="showResetLoading(event)">
                                                <i class="mdi mdi-refresh"></i> Reset
                                            </a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Tabel Data SPK -->
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 50px;">No</th>
                                        <th>Nomor SPK & Tanggal</th>
                                        <th>Proyek & Pekerjaan</th>
                                        <th>Kontraktor / Mandor</th>
                                        <th class="text-end">Nilai Kontrak</th>
                                        <th class="text-center">Progress</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center" style="width: 150px;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($spks as $index => $spk)
                                        <tr>
                                            <td class="text-center fw-bold">{{ $spks->firstItem() + $index }}</td>
                                            <td>
                                                <div class="fw-bold text-dark mb-1">
                                                    <i class="mdi mdi-file-document-outline text-primary me-1"></i>{{ $spk->no_spk }}
                                                </div>
                                                <small class="text-muted">
                                                    <i class="mdi mdi-calendar-blank-outline me-1"></i>{{ $spk->tanggal_spk ? date('d/m/Y', strtotime($spk->tanggal_spk)) : '-' }}
                                                </small>
                                            </td>
                                            <td>
                                                <div class="fw-bold text-dark mb-1">
                                                    {{ $spk->nama_pekerjaan }}
                                                </div>
                                                <div class="small text-muted d-flex align-items-center gap-1">
                                                    <i class="mdi mdi-domain" style="color: #9a55ff;"></i>
                                                    <span>{{ $spk->landBank->name ?? '-' }}</span>
                                                    @if($spk->unit)
                                                        <span class="badge bg-light text-dark border ms-1 font-monospace" style="font-size: 0.75rem;">
                                                            Kav. {{ $spk->unit->unit_code }} ({{ $spk->unit->type }})
                                                        </span>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div class="fw-semibold text-dark mb-1">
                                                    <i class="mdi mdi-account-hard-hat me-1 text-muted"></i>{{ $spk->kontraktor_nama }}
                                                </div>
                                                @if($spk->kontraktor_pic)
                                                    <small class="text-muted d-block">
                                                        PIC: {{ $spk->kontraktor_pic }}
                                                    </small>
                                                @endif
                                                @if($spk->kontraktor_telepon)
                                                    <small class="text-muted d-block">
                                                        <i class="mdi mdi-phone-outline me-1"></i>{{ $spk->kontraktor_telepon }}
                                                    </small>
                                                @endif
                                            </td>
                                            <td class="text-end">
                                                <span class="badge bg-light text-dark fw-bold px-2 py-1 border font-monospace" style="font-size: 0.85rem; letter-spacing: 0.5px;">
                                                    {{ $spk->formatted_nilai_kontrak }}
                                                </span>
                                                <small class="text-muted d-block mt-1">
                                                    {{ $spk->termins->count() }} Termin
                                                </small>
                                            </td>
                                            <td class="text-center">
                                                <div class="d-flex align-items-center justify-content-center gap-2">
                                                    <div class="progress flex-grow-1" style="height: 6px; width: 55px; background: #e9ecef; border-radius: 4px;">
                                                        <div class="progress-bar bg-gradient-primary" role="progressbar" 
                                                             style="width: {{ $spk->progress }}%;" 
                                                             aria-valuenow="{{ $spk->progress }}" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                    <span class="small fw-bold text-dark">{{ $spk->progress }}%</span>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                @if($spk->status == 'berjalan')
                                                    <span class="status-badge-spk berjalan">
                                                        <i class="mdi mdi-play-circle-outline"></i> Berjalan
                                                    </span>
                                                @elseif($spk->status == 'selesai')
                                                    <span class="status-badge-spk selesai">
                                                        <i class="mdi mdi-check-circle"></i> Selesai
                                                    </span>
                                                @elseif($spk->status == 'dibatalkan')
                                                    <span class="status-badge-spk dibatalkan">
                                                        <i class="mdi mdi-close-circle"></i> Batal
                                                    </span>
                                                @else
                                                    <span class="status-badge-spk draft">
                                                        <i class="mdi mdi-file-clock-outline"></i> Draft
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <div class="d-inline-flex align-items-center gap-1">
                                                    <a href="{{ route('spk.show', $spk->id) }}" class="btn-action view" title="Lihat Detail SPK">
                                                        <i class="mdi mdi-eye"></i>
                                                    </a>
                                                    <a href="{{ route('spk.cetak', $spk->id) }}" target="_blank" class="btn-action print" title="Cetak SPK">
                                                        <i class="mdi mdi-printer"></i>
                                                    </a>
                                                    <a href="{{ route('spk.edit', $spk->id) }}" class="btn-action edit" title="Edit SPK">
                                                        <i class="mdi mdi-pencil"></i>
                                                    </a>
                                                    <button type="button" class="btn-action delete" title="Hapus SPK" onclick="confirmDeleteSpk('{{ $spk->id }}', '{{ $spk->no_spk }}')">
                                                        <i class="mdi mdi-trash-can-outline"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center text-muted py-4">
                                                <i class="mdi mdi-file-document-outline me-2" style="font-size: 1.5rem;"></i>
                                                Belum ada data SPK Kontraktor yang tersimpan.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        @if ($spks instanceof \Illuminate\Pagination\LengthAwarePaginator && $spks->total() > 0)
                            <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mt-4">
                                <div class="pagination-info mb-2 mb-sm-0 text-muted" style="font-size: 0.82rem;">
                                    Menampilkan {{ $spks->firstItem() }} - {{ $spks->lastItem() }} dari {{ $spks->total() }} data
                                </div>
                                <nav aria-label="Page navigation">
                                    <ul class="pagination pagination-sm flex-wrap justify-content-center mb-0">
                                        <li class="page-item {{ $spks->onFirstPage() ? 'disabled' : '' }}">
                                            <a class="page-link" href="{{ $spks->previousPageUrl() }}" {{ !$spks->onFirstPage() ? 'onclick=showPaginationLoading(event)' : '' }}>
                                                <i class="mdi mdi-chevron-left"></i>
                                            </a>
                                        </li>

                                        @for($page = 1; $page <= $spks->lastPage(); $page++)
                                            <li class="page-item {{ $page == $spks->currentPage() ? 'active' : '' }}">
                                                @if($page == $spks->currentPage())
                                                    <span class="page-link">{{ $page }}</span>
                                                @else
                                                    <a class="page-link" href="{{ $spks->appends(request()->query())->url($page) }}" onclick="showPaginationLoading(event)">{{ $page }}</a>
                                                @endif
                                            </li>
                                        @endfor

                                        <li class="page-item {{ $spks->hasMorePages() ? '' : 'disabled' }}">
                                            <a class="page-link" href="{{ $spks->nextPageUrl() }}" {{ $spks->hasMorePages() ? 'onclick=showPaginationLoading(event)' : '' }}>
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

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
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

    function confirmDeleteSpk(id, noSpk) {
        Swal.fire({
            title: 'Yakin ingin menghapus?',
            text: `Data SPK ${noSpk} beserta seluruh jadwal terminnya akan dihapus permanen!`,
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
                    html: 'Sedang menghapus data SPK',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                $.ajax({
                    url: `/spk/${id}`,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(res) {
                        if (res.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Terhapus!',
                                text: res.message,
                                timer: 1800,
                                showConfirmButton: false
                            }).then(() => {
                                window.location.reload();
                            });
                        } else {
                            Swal.fire('Error', res.message || 'Gagal menghapus data', 'error');
                        }
                    },
                    error: function(xhr) {
                        Swal.fire('Error', 'Terjadi kesalahan sistem saat menghapus data.', 'error');
                    }
                });
            }
        });
    }
</script>
@endpush
