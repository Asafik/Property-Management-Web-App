@extends('layouts.partial.app')

@section('title', 'Manajemen Proyek Kawasan - Property Management App')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard-clean.css') }}?v={{ time() }}">
    <style>
        /* Table Responsive & Compact persis Dashboard Clean */
        .table-proyek {
            width: 100% !important;
            margin-bottom: 0;
        }
        .table-proyek thead th {
            background: #f8fafc !important;
            color: #475569 !important;
            font-weight: 700;
            font-size: 0.78rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 2px solid #e2e8f0 !important;
            padding: 0.75rem 0.65rem !important;
            vertical-align: middle;
            white-space: nowrap;
        }
        .table-proyek tbody td {
            padding: 0.75rem 0.65rem !important;
            vertical-align: middle;
            font-size: 0.83rem;
            border-bottom: 1px solid #f1f5f9;
            white-space: normal !important;
        }
        .table-proyek .col-no {
            width: 45px;
            text-align: center;
            white-space: nowrap !important;
        }
        .table-proyek .col-aksi {
            width: 175px;
            text-align: center;
            white-space: nowrap !important;
        }

        /* Styling Card Tabel Meniru Persis Card Total (.dash-kpi-card) */
        .card.compact-table-card,
        .compact-table-card {
            background: #ffffff !important;
            border: 1px solid #e2e8f0 !important;
            border-radius: 8px !important;
            box-shadow: none !important;
            transition: border-color 0.2s ease;
            overflow: hidden;
        }
        .card.compact-table-card:hover,
        .compact-table-card:hover {
            border-color: #cbd5e1 !important;
            box-shadow: none !important;
        }
        .compact-table-card .card-header {
            background: #ffffff !important;
            border-bottom: 1px solid #e2e8f0 !important;
            padding: 0.65rem 1.25rem !important;
            border-top-left-radius: 8px !important;
            border-top-right-radius: 8px !important;
        }
        .compact-table-card .card-body {
            padding: 0.75rem 1.25rem 1.15rem 1.25rem !important;
            background: #ffffff !important;
        }
        .compact-table-card .filter-card {
            margin-top: 0 !important;
            margin-bottom: 0.6rem !important;
        }
        .compact-table-card .filter-card form {
            margin-bottom: 0 !important;
        }

        /* Action Buttons with Text */
        .btn-action-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 5px 12px;
            border-radius: 6px;
            font-size: 0.79rem;
            font-weight: 600;
            line-height: 1;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            text-decoration: none !important;
            cursor: pointer;
            border: 1px solid transparent;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
            white-space: nowrap;
        }
        .btn-action-badge i {
            font-size: 0.95rem;
            line-height: 1;
        }
        .btn-action-badge:hover {
            transform: translateY(-1px);
        }
        .btn-action-badge.btn-lahan {
            background-color: #fffbeb;
            border-color: #fde68a;
            color: #b45309 !important;
        }
        .btn-action-badge.btn-lahan:hover {
            background: linear-gradient(135deg, #f59e0b, #d97706);
            border-color: #d97706;
            color: #ffffff !important;
            box-shadow: 0 4px 10px rgba(245, 158, 11, 0.3);
        }
        .btn-action-badge.btn-spk {
            background-color: #eff6ff;
            border-color: #bfdbfe;
            color: #1d4ed8 !important;
        }
        .btn-action-badge.btn-spk:hover {
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
            border-color: #1d4ed8;
            color: #ffffff !important;
            box-shadow: 0 4px 10px rgba(37, 99, 235, 0.3);
        }
    </style>
@endpush

@section('content')

<div class="container-fluid px-2 px-md-4 py-3">

    <!-- Page Title & Subtitle -->
    <div class="mb-4">
        <h2 class="text-dark mb-1 fw-bold" style="font-size: 1.55rem; letter-spacing: -0.02em;">
            Manajemen Proyek
        </h2>
        <p class="text-muted mb-0" style="font-size: 0.88rem;">
            Kelola profil kawasan proyek, denah siteplan, dan kelengkapan dokumen legalitas secara terpusat.
        </p>
    </div>

    <!-- 4 KPI Metrics Card Grid (Dashboard Clean Aesthetic) -->
    <div class="dash-kpi-grid mb-4">
        
        <!-- Card 1: Total Proyek (Ungu) -->
        <div class="dash-kpi-card">
            <div class="dash-kpi-left">
                <div class="dash-kpi-icon purple">
                    <i class="mdi mdi-office-building"></i>
                </div>
                <div class="dash-kpi-info">
                    <div class="dash-kpi-label">Total Kawasan Proyek</div>
                    <div class="dash-kpi-val">{{ $totalProjects ?? 0 }}</div>
                    <div class="dash-kpi-sub">Seluruh Proyek Terdaftar</div>
                </div>
            </div>
            <div class="dash-kpi-action purple">
                <i class="mdi mdi-arrow-right"></i>
            </div>
        </div>

        <!-- Card 2: Profil Lengkap (Hijau) -->
        <div class="dash-kpi-card">
            <div class="dash-kpi-left">
                <div class="dash-kpi-icon green">
                    <i class="mdi mdi-check-decagram-outline"></i>
                </div>
                <div class="dash-kpi-info">
                    <div class="dash-kpi-label">Profil Proyek Lengkap</div>
                    <div class="dash-kpi-val">{{ $totalLengkap ?? 0 }}</div>
                    <div class="dash-kpi-sub">Data Profil 100% Terisi</div>
                </div>
            </div>
            <div class="dash-kpi-action green">
                <i class="mdi mdi-arrow-right"></i>
            </div>
        </div>

        <!-- Card 3: Perlu Dilengkapi (Amber / Oranye) -->
        <div class="dash-kpi-card">
            <div class="dash-kpi-left">
                <div class="dash-kpi-icon orange">
                    <i class="mdi mdi-alert-circle-outline"></i>
                </div>
                <div class="dash-kpi-info">
                    <div class="dash-kpi-label">Perlu Dilengkapi</div>
                    <div class="dash-kpi-val">{{ $totalBelumLengkap ?? 0 }}</div>
                    <div class="dash-kpi-sub">Profil / Denah Belum Ada</div>
                </div>
            </div>
            <div class="dash-kpi-action orange">
                <i class="mdi mdi-arrow-right"></i>
            </div>
        </div>

        <!-- Card 4: Dokumen Terverifikasi (Biru) -->
        <div class="dash-kpi-card">
            <div class="dash-kpi-left">
                <div class="dash-kpi-icon blue">
                    <i class="mdi mdi-file-certificate-outline"></i>
                </div>
                <div class="dash-kpi-info">
                    <div class="dash-kpi-label">Dokumen Terverifikasi</div>
                    <div class="dash-kpi-val">{{ $totalVerifiedDocs ?? 0 }}</div>
                    <div class="dash-kpi-sub">Berkas Legalitas Disetujui</div>
                </div>
            </div>
            <div class="dash-kpi-action blue">
                <i class="mdi mdi-arrow-right"></i>
            </div>
        </div>

    </div>

    <!-- Main Container: Table & Filters -->
    <div class="row mt-2 mt-sm-2 mt-md-3">
        <div class="col-12">
            <div class="card compact-table-card">
                <div class="card-header bg-white d-flex flex-wrap flex-md-row justify-content-between align-items-center gap-2">
                    <div class="d-flex align-items-center gap-2">
                        <div style="width: 32px; height: 32px; border-radius: 6px; background-color: #f3e8ff; color: #9333ea; display: inline-flex; align-items: center; justify-content: center; font-size: 1.15rem; flex-shrink: 0;">
                            <i class="mdi mdi-city-variant-outline"></i>
                        </div>
                        <span style="font-size: 0.95rem; font-weight: 700; color: #0f172a;">Daftar Proyek Kawasan</span>
                    </div>
                    <div>
                        <a href="{{ route('properti') }}" class="btn btn-gradient-primary d-inline-flex align-items-center gap-1.5 px-3 py-1.5 fw-semibold shadow-sm text-decoration-none" style="border-radius: 6px; font-size: 0.82rem; height: 36px; white-space: nowrap;">
                            <i class="mdi mdi-plus-circle-outline fs-6"></i>
                            <span>Tambah Proyek Baru</span>
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <!-- Filter Toolbar -->
                    <div class="filter-card">
                        <form id="filterForm" method="GET" action="{{ route('proyek.index') }}" style="margin-bottom: 0 !important;">
                            <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 w-100">
                                <div class="d-flex flex-wrap align-items-center gap-2 flex-grow-1">
                                    <!-- Search Input -->
                                    <div style="min-width: 240px; max-width: 340px; flex: 1;">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="search" id="liveSearchInput"
                                                placeholder="Cari nama proyek, lokasi, PT..."
                                                value="{{ request('search') }}"
                                                onkeyup="applyLiveSearch(this.value)"
                                                style="border-top-right-radius: 0 !important; border-bottom-right-radius: 0 !important; border-right: none;">
                                            <button class="btn btn-gradient-primary d-flex align-items-center justify-content-center px-3" 
                                                type="submit" title="Cari"
                                                style="border-top-left-radius: 0 !important; border-bottom-left-radius: 0 !important; border-top-right-radius: 4px !important; border-bottom-right-radius: 4px !important; height: 38px; box-shadow: none;">
                                                <i class="mdi mdi-magnify" style="font-size: 1.15rem; color: #ffffff;"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <!-- Filter PT Pengembang -->
                                    <div style="min-width: 180px;">
                                        <select name="company_profile_id" class="form-control" onchange="document.getElementById('filterForm').submit()">
                                            <option value="all">Semua Pengembang (PT)</option>
                                            @foreach($companies as $comp)
                                                <option value="{{ $comp->id }}" {{ request('company_profile_id') == $comp->id ? 'selected' : '' }}>
                                                    {{ $comp->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Filter Status Kelengkapan Profil -->
                                    <div style="width: 170px;">
                                        <select class="form-control" name="profil_status" onchange="document.getElementById('filterForm').submit()">
                                            <option value="all" {{ request('profil_status') == 'all' ? 'selected' : '' }}>Semua Profil</option>
                                            <option value="lengkap" {{ request('profil_status') == 'lengkap' ? 'selected' : '' }}>Profil Lengkap (100%)</option>
                                            <option value="belum" {{ request('profil_status') == 'belum' ? 'selected' : '' }}>Perlu Dilengkapi</option>
                                        </select>
                                    </div>

                                    <!-- Filter Legalitas Status -->
                                    <div style="width: 160px;">
                                        <select class="form-control" name="legal_status" onchange="document.getElementById('filterForm').submit()">
                                            <option value="all" {{ request('legal_status') == 'all' ? 'selected' : '' }}>Semua Legalitas</option>
                                            <option value="verified" {{ request('legal_status') == 'verified' ? 'selected' : '' }}>Terverifikasi</option>
                                            <option value="pending" {{ request('legal_status') == 'pending' ? 'selected' : '' }}>Menunggu Review</option>
                                            <option value="rejected" {{ request('legal_status') == 'rejected' ? 'selected' : '' }}>Revisi / Ditolak</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Action Buttons -->
                                <div class="d-flex align-items-center gap-2 ms-auto">
                                    <button type="submit" class="btn btn-gradient-primary btn-icon-only" title="Terapkan Filter">
                                        <i class="mdi mdi-filter"></i>
                                    </button>
                                    <a href="{{ route('proyek.index') }}" class="btn btn-gradient-secondary btn-icon-only" title="Reset Filter">
                                        <i class="mdi mdi-refresh"></i>
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Pure Clean Table: Daftar Proyek Kawasan -->
                    <div class="table-responsive">
                        <table class="table table-hover align-middle table-proyek mb-0">
                            <thead>
                                <tr>
                                    <th class="col-no text-center" style="width: 40px;">No</th>
                                    <th>Nama Proyek</th>
                                    <th>Pengembang (PT)</th>
                                    <th>Lokasi Kawasan</th>
                                    <th>Luas Lahan</th>
                                    <th class="text-center" style="width: 130px;">Denah Siteplan</th>
                                    <th style="width: 130px;">Pengolahan Lahan</th>
                                    <th class="col-aksi text-center" style="width: 175px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($projects as $index => $item)
                                    @php
                                        $devPercent = (int) $item->overall_infrastructure_progress;
                                    @endphp
                                    <tr class="proyek-table-row" id="row_proyek_{{ $item->id }}" 
                                        data-search="{{ strtolower($item->name . ' ' . ($item->companyProfile->name ?? '') . ' ' . ($item->address ?? '') . ' ' . ($item->city ?? '') . ' ' . ($item->district ?? '')) }}">
                                        
                                        <td class="col-no fw-bold text-center">
                                            {{ ($projects->currentPage() - 1) * $projects->perPage() + $loop->iteration }}
                                        </td>

                                        <td>
                                            <a href="{{ route('properti.edit', $item->id) }}" class="fw-bold text-dark text-decoration-none" style="line-height: 1.35; font-size: 0.88rem;" title="Edit Profil Proyek">
                                                {{ $item->name }}
                                            </a>
                                        </td>

                                        <td>
                                            <div style="font-size: 0.83rem; font-weight: 600; color: #334155;">
                                                {{ $item->companyProfile->name ?? 'Belum Dipilih' }}
                                            </div>
                                        </td>

                                        <td>
                                            <div style="font-size: 0.85rem; font-weight: 600; color: #1e293b; line-height: 1.35;">
                                                {{ $item->district ? $item->district . ', ' : '' }}{{ $item->city ?: ($item->address ?: 'Lokasi belum diisi') }}
                                            </div>
                                            @if($item->address && ($item->district || $item->city))
                                                <div class="text-muted text-truncate" style="font-size: 0.74rem; max-width: 220px;" title="{{ $item->address }}">
                                                    {{ $item->address }}
                                                </div>
                                            @endif
                                        </td>

                                        <td>
                                            <span class="badge bg-light text-dark px-2 py-1 border font-monospace" style="font-size: 0.76rem; width: fit-content;">
                                                <i class="mdi mdi-texture-box text-muted me-1"></i>{{ number_format($item->area ?? 0, 0, ',', '.') }} m²
                                            </span>
                                        </td>

                                        <td class="text-center">
                                            @if($item->denah)
                                                <a href="{{ asset($item->denah) }}" target="_blank" class="text-primary text-decoration-none d-inline-flex align-items-center gap-1 fw-semibold" style="font-size: 0.76rem;" title="Buka Denah Siteplan">
                                                    <i class="mdi mdi-floor-plan text-primary fs-6"></i>
                                                    <span>Lihat Siteplan</span>
                                                </a>
                                            @else
                                                <span class="text-muted d-inline-flex align-items-center gap-1" style="font-size: 0.74rem;">
                                                    <i class="mdi mdi-file-excel-outline text-danger"></i>
                                                    <span>Siteplan Kosong</span>
                                                </span>
                                            @endif
                                        </td>

                                        <td>
                                            <div class="d-flex align-items-center gap-1.5">
                                                <div class="progress flex-grow-1" style="height: 6px; background-color: #e2e8f0; border-radius: 9999px;">
                                                    <div class="progress-bar rounded-pill bg-primary" role="progressbar" style="width: {{ $devPercent }}%;"></div>
                                                </div>
                                                <span style="font-size: 0.75rem; font-weight: 700; color: #475569;">{{ $devPercent }}%</span>
                                            </div>
                                        </td>

                                        <td class="col-aksi text-center">
                                            <div class="d-inline-flex align-items-center justify-content-center gap-2">
                                                <!-- Shortcut ke Pengolahan Lahan -->
                                                <a href="{{ route('properti.pengolahanLahan', $item->id) }}" 
                                                    class="btn btn-sm btn-gradient-primary d-inline-flex align-items-center gap-1 py-1 px-2.5 fw-semibold shadow-sm text-decoration-none" 
                                                    style="border-radius: 6px; font-size: 0.78rem;"
                                                    title="Kelola Pengolahan Lahan (Cut & Fill, Jalan, Utilitas)">
                                                    <i class="mdi mdi-hard-hat" style="font-size: 0.88rem;"></i>
                                                    <span>Kelola</span>
                                                </a>

                                                <!-- Shortcut ke SPK Kontraktor -->
                                                <a href="{{ route('spk.index', ['land_bank_id' => $item->id]) }}" 
                                                    class="btn btn-sm btn-gradient-primary d-inline-flex align-items-center gap-1 py-1 px-2.5 fw-semibold shadow-sm text-decoration-none" 
                                                    style="border-radius: 6px; font-size: 0.78rem;"
                                                    title="Kelola SPK Kontraktor Proyek Ini">
                                                    <i class="mdi mdi-file-sign" style="font-size: 0.88rem;"></i>
                                                    <span>SPK</span>
                                                </a>
                                            </div>
                                        </td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center text-muted py-4">
                                            <i class="mdi mdi-city-variant-outline me-2" style="font-size: 1.6rem; color: #cbd5e1;"></i>
                                            Belum ada data proyek kawasan yang ditemukan.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if($projects->hasPages())
                        <div class="mt-3 d-flex justify-content-end">
                            {{ $projects->links('pagination::bootstrap-5') }}
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function applyLiveSearch(keyword) {
        keyword = (keyword || '').toLowerCase().trim();
        const rows = document.querySelectorAll('.proyek-table-row');
        rows.forEach(row => {
            const searchData = row.getAttribute('data-search') || '';
            if (!keyword || searchData.includes(keyword)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }
</script>
@endpush

@endsection
