@extends('layouts.partial.app')

@section('title', 'Monitoring Pengolahan Lahan Proyek - Property Management App')

@section('content')

<style>
    /* Styling Persis Dashboard Monitoring Bersih & Elegan */
    .stat-card-clean {
        background: #ffffff;
        border-radius: 16px;
        padding: 20px;
        border: 1px solid #f1f5f9;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.02);
        display: flex;
        align-items: center;
        gap: 16px;
    }
    .stat-icon-box {
        width: 52px;
        height: 52px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #ffffff;
        font-size: 24px;
        font-weight: 700;
        flex-shrink: 0;
    }
    .table-container-card {
        background: #ffffff;
        border-radius: 16px;
        border: 1px solid #f1f5f9;
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.03);
        padding: 24px;
    }
    .filter-select {
        border-radius: 8px;
        border: 1px solid #e2e8f0;
        padding: 7px 14px;
        font-size: 0.88rem;
        color: #334155;
        background-color: #ffffff;
        outline: none;
    }
    .filter-select:focus {
        border-color: #5046e5;
        box-shadow: 0 0 0 2px rgba(80, 70, 229, 0.15);
    }
    .monitoring-table thead th {
        font-size: 0.82rem;
        font-weight: 600;
        color: #1e293b;
        border-bottom: 1px solid #f1f5f9;
        padding: 14px 16px;
        background: transparent;
    }
    .monitoring-table tbody td {
        font-size: 0.86rem;
        color: #1e293b;
        border-bottom: 1px solid #f8fafc;
        padding: 16px;
        vertical-align: middle;
    }
</style>

<div class="container-fluid px-2 px-md-4 py-3">

    <!-- Page Title & Subtitle -->
    <div class="mb-4">
        <h2 class="text-dark mb-1 fw-bold" style="font-size: 1.55rem; letter-spacing: -0.02em;">
            Monitoring Pengolahan Lahan Proyek
        </h2>
        <p class="text-muted mb-0" style="font-size: 0.88rem;">
            Manajemen & Monitoring Infrastruktur Kawasan (Cut & Fill, Drainase, Jalan, PJU & Utilitas Proyek).
        </p>
    </div>

    <!-- 4 KPI Metrics Card -->
    <div class="row g-3 mb-4">
        <!-- Card 1: Total Proyek -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="stat-card-clean">
                <div class="stat-icon-box" style="background-color: #5b50e6;">
                    <i class="mdi mdi-hard-hat" style="font-size: 26px;"></i>
                </div>
                <div>
                    <div class="text-muted" style="font-size: 0.82rem; font-weight: 500;">Total Proyek Lahan</div>
                    <div class="fw-bold text-dark mt-0" style="font-size: 1.75rem; line-height: 1.2;">{{ $totalProyek }}</div>
                </div>
            </div>
        </div>

        <!-- Card 2: Lahan Selesai -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="stat-card-clean">
                <div class="stat-icon-box" style="background-color: #00a96e;">
                    <span>{{ $totalSelesai }}</span>
                </div>
                <div>
                    <div class="text-muted" style="font-size: 0.82rem; font-weight: 500;">Lahan Selesai Diolah</div>
                    <div class="fw-bold text-dark mt-0" style="font-size: 1.75rem; line-height: 1.2;">{{ $totalSelesai }}</div>
                </div>
            </div>
        </div>

        <!-- Card 3: Dalam Pengerjaan Fisik -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="stat-card-clean">
                <div class="stat-icon-box" style="background-color: #48a7f8;">
                    <i class="mdi mdi-progress-wrench" style="font-size: 24px;"></i>
                </div>
                <div>
                    <div class="text-muted" style="font-size: 0.82rem; font-weight: 500;">Dalam Pengerjaan Fisik</div>
                    <div class="fw-bold text-dark mt-0" style="font-size: 1.75rem; line-height: 1.2;">{{ $dalamProses }}</div>
                </div>
            </div>
        </div>

        <!-- Card 4: Tertunda/Kendala -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="stat-card-clean">
                <div class="stat-icon-box" style="background-color: #e54861;">
                    <span>{{ $tertunda }}</span>
                </div>
                <div>
                    <div class="text-muted" style="font-size: 0.82rem; font-weight: 500;">Tertunda / Kendala</div>
                    <div class="fw-bold text-dark mt-0" style="font-size: 1.75rem; line-height: 1.2;">{{ $tertunda }}</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Container: Table & Filters -->
    <div class="table-container-card">
        
        <!-- Filter Toolbar Form -->
        <form id="filterForm" method="GET" action="{{ route('proyek.pengolahan-lahan.index') }}">
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">
                
                <!-- Left: Proyek & Status Filter -->
                <div class="d-flex flex-wrap align-items-center gap-3">
                    
                    <!-- Proyek Dropdown -->
                    <div class="d-flex align-items-center gap-2">
                        <label class="mb-0 text-dark fw-medium" style="font-size: 0.88rem; white-space: nowrap;">Proyek :</label>
                        <select name="proyek_id" class="filter-select" onchange="document.getElementById('filterForm').submit()">
                            <option value="all">Semua Proyek Kawasan</option>
                            @foreach($projects as $p)
                                <option value="{{ $p['id'] }}" {{ request('proyek_id') == $p['id'] ? 'selected' : '' }}>
                                    {{ $p['nama'] }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Status Dropdown -->
                    <div class="d-flex align-items-center gap-2">
                        <label class="mb-0 text-dark fw-medium" style="font-size: 0.88rem; white-space: nowrap;">Status:</label>
                        <select name="status" class="filter-select" onchange="document.getElementById('filterForm').submit()" style="min-width: 100px;">
                            <option value="all" {{ request('status') == 'all' ? 'selected' : '' }}>All</option>
                            <option value="Selesai" {{ request('status') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                            <option value="Berjalan" {{ request('status') == 'Berjalan' ? 'selected' : '' }}>Berjalan</option>
                            <option value="Tertunda" {{ request('status') == 'Tertunda' ? 'selected' : '' }}>Tertunda</option>
                        </select>
                    </div>

                </div>

            </div>
        </form>

        <!-- Pure Clean Table: Daftar Pengolahan Lahan Kawasan -->
        <div class="table-responsive">
            <table class="table align-middle monitoring-table mb-0">
                <thead>
                    <tr>
                        <th style="width: 50px;">No</th>
                        <th>Nama Proyek</th>
                        <th>Status Tanah</th>
                        <th>Tahapan Aktif</th>
                        <th>Lokasi</th>
                        <th>Luas Lahan</th>
                        <th>Target Selesai</th>
                        <th style="width: 150px;">Progress Fisik</th>
                        <th style="width: 110px;">Status</th>
                        <th class="text-center" style="width: 210px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($projects as $index => $proj)
                        @php
                            $pVal = $proj['progress'] ?? 65;
                            $st = $proj['status'] ?? 'Berjalan';
                            if ($st == 'Selesai') {
                                $badgeBg = '#dcfce7';
                                $badgeColor = '#15803d';
                                $stLabel = 'Selesai';
                            } elseif ($st == 'Berjalan') {
                                $badgeBg = '#e0f2fe';
                                $badgeColor = '#0369a1';
                                $stLabel = 'Berjalan';
                            } else {
                                $badgeBg = '#fee2e2';
                                $badgeColor = '#b91c1c';
                                $stLabel = 'Tertunda';
                            }
                        @endphp
                        <tr>
                            <td class="fw-bold">{{ $loop->iteration }}</td>
                            <td>
                                <div class="fw-bold text-dark fs-6">{{ $proj['nama'] }}</div>
                                <small class="text-muted">{{ $proj['pt'] ?? 'PT Graha Cipta Sejahtera' }}</small>
                            </td>
                            <td>
                                <span class="badge py-1 px-2.5 font-monospace"
                                    style="background-color: #f3e8ff; color: #7e22ce; font-size: 0.78rem; font-weight: 700; border-radius: 6px; border: 1px solid #e9d5ff;">
                                    {{ $proj['ownership_status'] ?? 'SHGB Induk' }}
                                </span>
                            </td>
                            <td>
                                <span class="badge py-1 px-2.5"
                                    style="background-color: #fef3c7; color: #92400e; font-size: 0.78rem; font-weight: 600; border-radius: 6px; border: 1px solid #fde68a;">
                                    <i class="mdi mdi-hammer-wrench me-1"></i>{{ $proj['fase_aktif'] ?? 'Fase 1' }}
                                </span>
                            </td>
                            <td>
                                <span class="text-secondary fw-medium">
                                    <i class="mdi mdi-map-marker-outline text-danger me-0.5"></i>{{ $proj['lokasi'] }}
                                </span>
                            </td>
                            <td>
                                <span class="badge bg-light text-dark px-2 py-1 border font-monospace" style="font-size: 0.78rem;">
                                    {{ $proj['luas'] }}
                                </span>
                            </td>
                            <td>
                                <span class="text-secondary">{{ $proj['target_selesai'] ?? '30 Jul 2026' }}</span>
                            </td>
                            <td>
                                <div class="d-flex align-items-center gap-2" style="min-width: 120px;">
                                    <div style="width: 90px; height: 8px; background-color: #e2e8f0; border-radius: 9999px; overflow: hidden;">
                                        <div style="width: {{ $pVal }}%; height: 100%; background-color: #3b82f6; border-radius: 9999px;"></div>
                                    </div>
                                    <span style="font-size: 0.75rem; font-weight: 700; color: #334155;">{{ $pVal }}%</span>
                                </div>
                            </td>
                            <td>
                                <span class="badge rounded-pill" style="background-color: {{ $badgeBg }}; color: {{ $badgeColor }}; font-weight: 600; padding: 5px 14px; font-size: 0.78rem;">
                                    {{ $stLabel }}
                                </span>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('properti.pengolahanLahan', $proj['id']) }}" class="btn btn-sm text-white fw-semibold d-inline-flex align-items-center gap-1.5 px-3 py-1.5 shadow-sm text-decoration-none" style="background-color: #5046e5; border-radius: 6px; font-size: 0.82rem;">
                                    <i class="mdi mdi-tools"></i>
                                    <span>Kelola</span>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="text-center text-muted py-4">
                                <i class="mdi mdi-domain-off me-2" style="font-size: 1.5rem;"></i>
                                Tidak ada data proyek pengolahan lahan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>

</div>

@endsection
