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
            width: 140px;
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

        /* Modal Checklist Styling */
        .profile-check-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0.6rem 0.85rem;
            border-radius: 8px;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            margin-bottom: 0.5rem;
            transition: all 0.2s ease;
        }
        .profile-check-item.is-valid {
            background: #f0fdf4;
            border-color: #bbf7d0;
        }
        .profile-check-item.is-invalid {
            background: #fef2f2;
            border-color: #fecaca;
        }
    </style>
@endpush

@section('content')

<div class="container-fluid px-2 px-md-4 py-3">

    <!-- Page Title & Subtitle -->
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
        <div>
            <h2 class="text-dark mb-1 fw-bold" style="font-size: 1.55rem; letter-spacing: -0.02em;">
                Manajemen Proyek
            </h2>
            <p class="text-muted mb-0" style="font-size: 0.88rem;">
                Kelola profil kawasan proyek, denah siteplan, dan kelengkapan dokumen legalitas secara terpusat.
            </p>
        </div>
        <div class="d-flex align-items-center gap-2">
            <a href="{{ route('properti') }}" class="btn btn-gradient-primary d-inline-flex align-items-center gap-1.5 px-3 py-2 fw-semibold shadow-sm" style="border-radius: 6px; font-size: 0.86rem;">
                <i class="mdi mdi-plus-circle-outline fs-6"></i>
                <span>Tambah Proyek Baru</span>
            </a>
        </div>
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
                        <span style="font-size: 0.95rem; font-weight: 700; color: #0f172a;">Daftar Proyek Kawasan & Status Profil</span>
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
                                    <th class="col-no text-center">No</th>
                                    <th>Nama Proyek & Pengembang</th>
                                    <th>Lokasi Kawasan</th>
                                    <th>Luas & Denah Siteplan</th>
                                    <th style="width: 170px;">Kelengkapan Profil</th>
                                    <th class="text-center" style="width: 100px;">Dokumen</th>
                                    <th style="width: 130px;">Pengolahan Lahan</th>
                                    <th class="col-aksi text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($projects as $index => $item)
                                    @php
                                        $score = $item->profile_score;
                                        $isComplete = $item->isProfileComplete();
                                        $missing = $item->getMissingProfileFields();
                                        $docCount = $item->merged_documents->count();
                                        $devPercent = (int) $item->overall_infrastructure_progress;

                                        // Warna progress profil
                                        if ($score >= 100) {
                                            $barColor = '#10b981';
                                            $badgeText = 'Lengkap 100%';
                                            $badgeBg = '#ecfdf5';
                                            $badgeColor = '#059669';
                                            $badgeBorder = '#a7f3d0';
                                        } elseif ($score >= 60) {
                                            $barColor = '#f59e0b';
                                            $badgeText = count($missing) . ' Field Kurang';
                                            $badgeBg = '#fffbeb';
                                            $badgeColor = '#b45309';
                                            $badgeBorder = '#fde68a';
                                        } else {
                                            $barColor = '#ef4444';
                                            $badgeText = 'Belum Lengkap';
                                            $badgeBg = '#fef2f2';
                                            $badgeColor = '#b91c1c';
                                            $badgeBorder = '#fecaca';
                                        }
                                    @endphp
                                    <tr class="proyek-table-row" id="row_proyek_{{ $item->id }}" 
                                        data-search="{{ strtolower($item->name . ' ' . ($item->companyProfile->name ?? '') . ' ' . ($item->address ?? '') . ' ' . ($item->city ?? '') . ' ' . ($item->district ?? '')) }}">
                                        
                                        <td class="col-no fw-bold text-center">
                                            {{ ($projects->currentPage() - 1) * $projects->perPage() + $loop->iteration }}
                                        </td>

                                        <td>
                                            <div class="fw-bold text-dark" style="line-height: 1.35; font-size: 0.88rem;">
                                                {{ $item->name }}
                                            </div>
                                            <div class="text-secondary mt-0.5 d-flex align-items-center gap-1" style="font-size: 0.77rem; line-height: 1.3;">
                                                <i class="mdi mdi-domain" style="font-size: 0.85rem; color: #94a3b8;"></i>
                                                <span>{{ $item->companyProfile->name ?? 'PT Pengembang Belum Dipilih' }}</span>
                                            </div>
                                        </td>

                                        <td>
                                            <div class="text-secondary" style="font-size: 0.82rem; line-height: 1.35;">
                                                <i class="mdi mdi-map-marker-outline text-danger me-0.5"></i>
                                                {{ $item->district ? $item->district . ', ' : '' }}{{ $item->city ?: ($item->address ?: 'Lokasi belum diisi') }}
                                            </div>
                                            @if($item->lat && $item->lng)
                                                <small class="text-muted d-block mt-0.5" style="font-size: 0.72rem;">
                                                    <i class="mdi mdi-crosshairs-gps text-primary me-0.5"></i>{{ round($item->lat, 4) }}, {{ round($item->lng, 4) }}
                                                </small>
                                            @else
                                                <small class="text-warning d-block mt-0.5" style="font-size: 0.72rem;">
                                                    <i class="mdi mdi-alert-circle-outline me-0.5"></i>Peta belum ditandai
                                                </small>
                                            @endif
                                        </td>

                                        <td>
                                            <div class="d-flex flex-column gap-1">
                                                <span class="badge bg-light text-dark px-2 py-1 border font-monospace" style="font-size: 0.76rem; width: fit-content;">
                                                    <i class="mdi mdi-texture-box text-muted me-1"></i>{{ number_format($item->area ?? 0, 0, ',', '.') }} m²
                                                </span>
                                                @if($item->denah)
                                                    <a href="{{ asset($item->denah) }}" target="_blank" class="text-primary text-decoration-none d-inline-flex align-items-center gap-1" style="font-size: 0.75rem; font-weight: 600;">
                                                        <i class="mdi mdi-floor-plan"></i>
                                                        <span>Lihat Siteplan</span>
                                                    </a>
                                                @else
                                                    <span class="text-muted d-inline-flex align-items-center gap-1" style="font-size: 0.74rem;">
                                                        <i class="mdi mdi-file-excel-outline text-danger"></i>
                                                        <span>Siteplan Kosong</span>
                                                    </span>
                                                @endif
                                            </div>
                                        </td>

                                        <td>
                                            <div class="d-flex align-items-center justify-content-between mb-1">
                                                <button type="button" class="btn p-0 border-0 text-start" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#modalChecklistProfil{{ $item->id }}"
                                                    title="Klik untuk melihat checklist kelengkapan profil">
                                                    <span class="badge py-1 px-2 fw-semibold" 
                                                        style="font-size: 0.72rem; border-radius: 6px; background-color: {{ $badgeBg }}; color: {{ $badgeColor }}; border: 1px solid {{ $badgeBorder }}; cursor: pointer;">
                                                        <i class="mdi {{ $score >= 100 ? 'mdi-check' : 'mdi-alert-circle-outline' }} me-0.5"></i>{{ $badgeText }}
                                                    </span>
                                                </button>
                                                <span class="fw-bold" style="font-size: 0.75rem; color: #334155;">{{ $score }}%</span>
                                            </div>
                                            <div class="progress" style="height: 6px; background-color: #e2e8f0; border-radius: 9999px;">
                                                <div class="progress-bar rounded-pill" role="progressbar" style="width: {{ $score }}%; background-color: {{ $barColor }};"></div>
                                            </div>
                                        </td>

                                        <td class="text-center">
                                            <button type="button" class="btn btn-sm btn-outline-secondary d-inline-flex align-items-center gap-1 px-2.5 py-1 border shadow-none" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#modalDokumenProyek{{ $item->id }}"
                                                style="border-radius: 6px; font-size: 0.76rem;"
                                                title="Lihat Berkas Dokumen Legalitas">
                                                <i class="mdi mdi-file-document-multiple-outline text-primary"></i>
                                                <span class="fw-bold">{{ $docCount }}</span>
                                            </button>
                                        </td>

                                        <td>
                                            <div class="d-flex align-items-center gap-1.5 mb-1">
                                                <div class="progress flex-grow-1" style="height: 5px; background-color: #e2e8f0; border-radius: 9999px;">
                                                    <div class="progress-bar rounded-pill bg-primary" role="progressbar" style="width: {{ $devPercent }}%;"></div>
                                                </div>
                                                <span style="font-size: 0.72rem; font-weight: 700; color: #475569;">{{ $devPercent }}%</span>
                                            </div>
                                            <a href="{{ route('properti.pengolahanLahan', $item->id) }}" class="text-decoration-none text-muted d-inline-flex align-items-center gap-1" style="font-size: 0.73rem; font-weight: 600;" title="Buka Detail Pengolahan Lahan Fisik">
                                                <i class="mdi mdi-hard-hat text-warning"></i>
                                                <span>Fisik Lahan</span>
                                            </a>
                                        </td>

                                        <td class="col-aksi text-center">
                                            <div class="d-flex align-items-center justify-content-center gap-1.5">
                                                <!-- Edit / Lengkapi Profil -->
                                                <a href="{{ route('properti.edit', $item->id) }}" 
                                                    class="btn btn-sm btn-gradient-primary d-inline-flex align-items-center gap-1 px-2.5 py-1.5 shadow-sm text-decoration-none fw-semibold" 
                                                    style="border-radius: 6px; font-size: 0.78rem;"
                                                    title="Lengkapi & Edit Profil Proyek">
                                                    <i class="mdi mdi-pencil" style="font-size: 0.85rem;"></i>
                                                    <span>Profil</span>
                                                </a>

                                                <!-- Shortcut ke Pengolahan Lahan -->
                                                <a href="{{ route('properti.pengolahanLahan', $item->id) }}" 
                                                    class="btn btn-sm btn-outline-secondary d-inline-flex align-items-center px-2 py-1.5 border shadow-none" 
                                                    style="border-radius: 6px; font-size: 0.85rem;"
                                                    title="Kelola Pengolahan Lahan (Cut & Fill, Jalan, Utilitas)">
                                                    <i class="mdi mdi-hard-hat text-warning"></i>
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

<!-- MODALS PER PROJECT -->
@foreach ($projects as $item)
    
    <!-- Modal 1: Checklist Kelengkapan Profil Proyek -->
    <div class="modal fade" id="modalChecklistProfil{{ $item->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 520px;">
            <div class="modal-content border-0 shadow-lg" style="border-radius: 14px; overflow: hidden;">
                <div class="modal-header bg-white border-bottom px-4 py-3">
                    <div class="d-flex align-items-center gap-2">
                        <div style="width: 34px; height: 34px; border-radius: 8px; background: #eff6ff; color: #1d4ed8; display: flex; align-items: center; justify-content: center; font-size: 1.15rem;">
                            <i class="mdi mdi-clipboard-check-outline"></i>
                        </div>
                        <div>
                            <h5 class="modal-title fw-bold text-dark mb-0" style="font-size: 1rem;">Status Profil Proyek</h5>
                            <small class="text-muted" style="font-size: 0.78rem;">{{ $item->name }}</small>
                        </div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                
                <div class="modal-body px-4 py-3">
                    <!-- Skor Header -->
                    <div class="d-flex align-items-center justify-content-between p-3 mb-3" style="background: #f8fafc; border-radius: 10px; border: 1px solid #e2e8f0;">
                        <div>
                            <div class="text-muted small fw-semibold" style="font-size: 0.75rem; text-transform: uppercase;">Tingkat Kelengkapan</div>
                            <div class="fw-bold text-dark" style="font-size: 1.25rem;">{{ $item->profile_score }}% Lengkap</div>
                        </div>
                        <span class="badge py-1 px-3 fw-bold" style="font-size: 0.78rem; border-radius: 6px; background-color: {{ $item->profile_score >= 100 ? '#ecfdf5' : '#fffbeb' }}; color: {{ $item->profile_score >= 100 ? '#059669' : '#b45309' }}; border: 1px solid {{ $item->profile_score >= 100 ? '#a7f3d0' : '#fde68a' }};">
                            {{ $item->profile_score >= 100 ? 'Siap Operasional' : 'Perlu Dilengkapi' }}
                        </span>
                    </div>

                    <!-- Checklist Items -->
                    <div class="mb-2">
                        <div class="fw-bold text-dark mb-2" style="font-size: 0.83rem;">Rincian 6 Parameter Profil Proyek:</div>
                        @foreach ($item->core_profile_checklist as $chk)
                            <div class="profile-check-item {{ $chk['is_filled'] ? 'is-valid' : 'is-invalid' }}">
                                <div class="d-flex align-items-center gap-2">
                                    <i class="mdi {{ $chk['icon'] }}" style="font-size: 1.1rem; color: {{ $chk['is_filled'] ? '#16a34a' : '#dc2626' }};"></i>
                                    <div>
                                        <div class="fw-semibold text-dark" style="font-size: 0.82rem;">{{ $chk['label'] }}</div>
                                        <small class="text-muted" style="font-size: 0.73rem;">
                                            {{ $chk['val'] ?? 'Belum diisi / belum diunggah' }}
                                        </small>
                                    </div>
                                </div>
                                <div>
                                    @if ($chk['is_filled'])
                                        <span class="badge bg-success py-1 px-2" style="font-size: 0.7rem; border-radius: 4px;">
                                            <i class="mdi mdi-check"></i> Sudah Ada
                                        </span>
                                    @else
                                        <span class="badge bg-danger py-1 px-2" style="font-size: 0.7rem; border-radius: 4px;">
                                            <i class="mdi mdi-close"></i> Belum
                                        </span>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="modal-footer bg-light px-4 py-2.5 border-top d-flex justify-content-between">
                    <button type="button" class="btn btn-sm btn-outline-secondary px-3" data-bs-dismiss="modal" style="border-radius: 6px;">
                        Tutup
                    </button>
                    <a href="{{ route('properti.edit', $item->id) }}" class="btn btn-sm btn-gradient-primary fw-semibold px-3 d-inline-flex align-items-center gap-1" style="border-radius: 6px;">
                        <i class="mdi mdi-pencil"></i>
                        <span>Lengkapi Profil Sekarang</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal 2: Daftar Dokumen Legalitas Proyek -->
    <div class="modal fade" id="modalDokumenProyek{{ $item->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content border-0 shadow-lg" style="border-radius: 14px; overflow: hidden;">
                <div class="modal-header bg-white border-bottom px-4 py-3">
                    <div class="d-flex align-items-center gap-2">
                        <div style="width: 34px; height: 34px; border-radius: 8px; background: #f3e8ff; color: #9333ea; display: flex; align-items: center; justify-content: center; font-size: 1.15rem;">
                            <i class="mdi mdi-file-document-multiple-outline"></i>
                        </div>
                        <div>
                            <h5 class="modal-title fw-bold text-dark mb-0" style="font-size: 1rem;">Dokumen Legalitas Kawasan</h5>
                            <small class="text-muted" style="font-size: 0.78rem;">{{ $item->name }}</small>
                        </div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body px-4 py-3">
                    @if ($item->merged_documents->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0" style="font-size: 0.83rem;">
                                <thead class="table-light">
                                    <tr>
                                        <th width="5%" class="text-center">No</th>
                                        <th width="30%">Jenis Dokumen</th>
                                        <th>Nomor Berkas</th>
                                        <th width="18%" class="text-center">Status</th>
                                        <th width="15%" class="text-center">Berkas</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($item->merged_documents as $idx => $doc)
                                        @php
                                            $stDoc = strtolower($doc->status ?? 'pending');
                                            if ($stDoc === 'verified' || $stDoc === 'approved') {
                                                $dBadge = 'bg-success';
                                                $dLabel = 'Terverifikasi';
                                            } elseif ($stDoc === 'rejected') {
                                                $dBadge = 'bg-danger';
                                                $dLabel = 'Ditolak / Revisi';
                                            } else {
                                                $dBadge = 'bg-warning text-dark';
                                                $dLabel = 'Menunggu Review';
                                            }
                                        @endphp
                                        <tr>
                                            <td class="text-center fw-bold">{{ $loop->iteration }}</td>
                                            <td>
                                                <div class="fw-semibold text-dark">{{ $doc->documentType->name ?? ($doc->name ?? 'Dokumen Legalitas') }}</div>
                                            </td>
                                            <td>
                                                <span class="font-monospace text-secondary">{{ $doc->document_number ?: '-' }}</span>
                                            </td>
                                            <td class="text-center">
                                                <span class="badge {{ $dBadge }} py-1 px-2" style="font-size: 0.72rem; border-radius: 4px;">
                                                    {{ $dLabel }}
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                @if ($doc->file_path)
                                                    <a href="{{ asset($doc->file_path) }}" target="_blank" class="btn btn-sm btn-outline-primary py-0.5 px-2" style="font-size: 0.72rem; border-radius: 4px;">
                                                        <i class="mdi mdi-download"></i> Unduh
                                                    </a>
                                                @else
                                                    <span class="text-muted small">-</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center text-muted py-4">
                            <i class="mdi mdi-file-document-outline me-1" style="font-size: 2rem; color: #cbd5e1;"></i>
                            <p class="mb-2 mt-1">Belum ada berkas dokumen legalitas yang terunggah untuk proyek ini.</p>
                            <a href="{{ route('properti.edit', $item->id) }}" class="btn btn-sm btn-gradient-primary px-3 fw-semibold" style="border-radius: 6px;">
                                <i class="mdi mdi-upload me-1"></i> Unggah Dokumen Sekarang
                            </a>
                        </div>
                    @endif
                </div>

                <div class="modal-footer bg-light px-4 py-2.5 border-top d-flex justify-content-between">
                    <button type="button" class="btn btn-sm btn-outline-secondary px-3" data-bs-dismiss="modal" style="border-radius: 6px;">
                        Tutup
                    </button>
                    <a href="{{ route('properti.edit', $item->id) }}" class="btn btn-sm btn-gradient-primary fw-semibold px-3 d-inline-flex align-items-center gap-1" style="border-radius: 6px;">
                        <i class="mdi mdi-pencil"></i>
                        <span>Kelola / Unggah Dokumen</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

@endforeach

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
