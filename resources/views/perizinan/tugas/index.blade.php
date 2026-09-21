@extends('layouts.partial.app')

@section('title', 'Pembagian Tugas Perizinan - Property Management App')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard-clean.css') }}?v={{ time() }}">
    <style>
        .task-user-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        .user-avatar-circle {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: linear-gradient(135deg, #6366f1, #a855f7);
            color: #ffffff;
            font-size: 0.76rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            box-shadow: 0 2px 4px rgba(99, 102, 241, 0.2);
        }
        .user-avatar-circle.updater {
            background: linear-gradient(135deg, #0ea5e9, #2563eb);
            width: 26px;
            height: 26px;
            font-size: 0.68rem;
        }
        .timeline-container {
            position: relative;
            padding-left: 28px;
        }
        .timeline-container::before {
            content: '';
            position: absolute;
            top: 6px;
            bottom: 6px;
            left: 11px;
            width: 2px;
            background: #e2e8f0;
        }
        .timeline-item {
            position: relative;
            margin-bottom: 20px;
        }
        .timeline-point {
            position: absolute;
            left: -28px;
            top: 2px;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background: #ffffff;
            border: 2px solid #4f46e5;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.7rem;
            color: #4f46e5;
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
        }
        .timeline-point.success {
            border-color: #16a34a;
            color: #16a34a;
            box-shadow: 0 0 0 3px rgba(22, 163, 74, 0.1);
        }
        .timeline-point.warning {
            border-color: #f59e0b;
            color: #f59e0b;
            box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.1);
        }
        .timeline-point.danger {
            border-color: #ef4444;
            color: #ef4444;
            box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
        }
        .timeline-box {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            padding: 12px 16px;
        }

        /* Table Responsive & Text Wrapping persis Perizinan */
        .table-perizinan {
            width: 100% !important;
            margin-bottom: 0;
        }
        .table-perizinan thead th {
            background: #f8fafc !important;
            color: #4b5563 !important;
            font-weight: 700;
            font-size: 0.78rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 2px solid #e2e8f0 !important;
            padding: 0.75rem 0.6rem !important;
            vertical-align: middle;
            white-space: nowrap;
        }
        .table-perizinan tbody td {
            padding: 0.75rem 0.6rem !important;
            vertical-align: middle;
            font-size: 0.83rem;
            border-bottom: 1px solid #f1f5f9;
            white-space: normal !important;
        }
        .table-perizinan .col-no {
            width: 45px;
            text-align: center;
            white-space: nowrap !important;
        }
        .table-perizinan .col-status {
            width: 105px;
            text-align: center;
            white-space: nowrap !important;
        }
        .table-perizinan .col-aksi {
            width: 130px;
            text-align: center;
            white-space: nowrap !important;
        }

        /* Styling Card Tabel Meniru Persis Card Perizinan (.compact-table-card) */
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
        .compact-table-card .card-body,
        .card.compact-table-card .card-body {
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

        /* Button Action styling persis Perizinan */
        .btn-action-edit {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            color: #1e293b;
            border-radius: 6px;
            padding: 4px 12px;
            font-size: 0.8rem;
            font-weight: 500;
            transition: all 0.15s ease;
        }
        .btn-action-edit:hover {
            background: #f8fafc;
            border-color: #cbd5e1;
            color: #0f172a;
        }
        .btn-action-dots {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            color: #64748b;
            border-radius: 6px;
            padding: 4px 9px;
            font-size: 0.85rem;
        }
        .btn-action-dots:hover {
            background: #f8fafc;
            color: #1e293b;
        }
    </style>
@endpush

@section('content')
<div class="container-fluid px-2 px-md-4 py-3">

    <!-- Header Judul & Navigasi Tab -->
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-3">
        <div>
            <h2 class="text-dark mb-1 fw-bold" style="font-size: 1.55rem; letter-spacing: -0.02em;">
                Pembagian Tugas Perizinan
            </h2>
            <p class="text-muted mb-0" style="font-size: 0.88rem;">
                Delegasi tugas perizinan staf legal, update progres lapangan, serta pelacakan riwayat aktivitas pembaruan.
            </p>
        </div>

        <div class="d-flex align-items-center gap-2">
            @if($canManage)
                <button type="button" class="btn btn-primary d-inline-flex align-items-center gap-1.5 px-3 py-2 fw-semibold shadow-sm"
                    data-bs-toggle="modal" data-bs-target="#modalTambahTugas" style="border-radius: 8px; font-size: 0.86rem;">
                    <i class="mdi mdi-plus-circle-outline fs-6"></i>
                    <span>Tugaskan Staf Legal</span>
                </button>
            @endif
        </div>
    </div>

    <!-- Alert Notifikasi -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm d-flex align-items-center gap-2 mb-4" role="alert" style="border-radius: 8px; background: #ecfdf5; color: #065f46;">
            <i class="mdi mdi-check-circle fs-5 text-success"></i>
            <div>{{ session('success') }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm d-flex align-items-center gap-2 mb-4" role="alert" style="border-radius: 8px; background: #fef2f2; color: #991b1b;">
            <i class="mdi mdi-alert-circle fs-5 text-danger"></i>
            <div>{{ session('error') }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif


    <!-- 4 KPI Metrics Card -->
    <div class="dash-kpi-grid mb-4">
        <!-- Total Tugas -->
        <div class="dash-kpi-card">
            <div class="dash-kpi-left">
                <div class="dash-kpi-icon purple">
                    <i class="mdi mdi-clipboard-text-outline"></i>
                </div>
                <div class="dash-kpi-info">
                    <div class="dash-kpi-label">Total Tugas</div>
                    <div class="dash-kpi-val">{{ $totalTugas }}</div>
                    <div class="dash-kpi-sub">{{ $isStaffLegal && !$canManage ? 'Tugas Saya' : 'Semua Staf Legal' }}</div>
                </div>
            </div>
            <div class="dash-kpi-action purple">
                <i class="mdi mdi-arrow-right"></i>
            </div>
        </div>

        <!-- Dalam Proses -->
        <div class="dash-kpi-card">
            <div class="dash-kpi-left">
                <div class="dash-kpi-icon blue">
                    <i class="mdi mdi-progress-clock"></i>
                </div>
                <div class="dash-kpi-info">
                    <div class="dash-kpi-label">Dalam Proses</div>
                    <div class="dash-kpi-val">{{ $tugasProses }}</div>
                    <div class="dash-kpi-sub">Sedang Dikerjakan Lapangan</div>
                </div>
            </div>
            <div class="dash-kpi-action blue">
                <i class="mdi mdi-arrow-right"></i>
            </div>
        </div>

        <!-- Selesai (Terbit) -->
        <div class="dash-kpi-card">
            <div class="dash-kpi-left">
                <div class="dash-kpi-icon green">
                    <i class="mdi mdi-check-decagram-outline"></i>
                </div>
                <div class="dash-kpi-info">
                    <div class="dash-kpi-label">Izin Selesai</div>
                    <div class="dash-kpi-val">{{ $tugasSelesai }}</div>
                    <div class="dash-kpi-sub">Dokumen Terbit Resmi</div>
                </div>
            </div>
            <div class="dash-kpi-action green">
                <i class="mdi mdi-arrow-right"></i>
            </div>
        </div>

        <!-- Terkendala / Pending -->
        <div class="dash-kpi-card">
            <div class="dash-kpi-left">
                <div class="dash-kpi-icon {{ $tugasTerkendala > 0 ? 'rose' : 'orange' }}">
                    <i class="mdi {{ $tugasTerkendala > 0 ? 'mdi-alert-circle-outline' : 'mdi-clock-outline' }}"></i>
                </div>
                <div class="dash-kpi-info">
                    <div class="dash-kpi-label">{{ $tugasTerkendala > 0 ? 'Terkendala' : 'Pending' }}</div>
                    <div class="dash-kpi-val">{{ $tugasTerkendala > 0 ? $tugasTerkendala : $tugasPending }}</div>
                    <div class="dash-kpi-sub">{{ $tugasTerkendala > 0 ? 'Butuh Tindak Lanjut' : 'Menunggu Pengerjaan' }}</div>
                </div>
            </div>
            <div class="dash-kpi-action {{ $tugasTerkendala > 0 ? 'rose' : 'orange' }}">
                <i class="mdi mdi-arrow-right"></i>
            </div>
        </div>
    </div>

    <!-- Main Container: Table & Filters (Sama Persis Format Perizinan) -->
    <div class="row mt-2 mt-sm-2 mt-md-3">
        <div class="col-12">
            <div class="card compact-table-card">
                <div class="card-header bg-white d-flex flex-wrap flex-md-row justify-content-between align-items-center gap-2">
                    <div class="d-flex align-items-center gap-2">
                        <div style="width: 32px; height: 32px; border-radius: 6px; background-color: #f3e8ff; color: #9333ea; display: inline-flex; align-items-center; justify-content: center; font-size: 1.15rem; flex-shrink: 0;">
                            <i class="mdi mdi-format-list-checks"></i>
                        </div>
                        <span style="font-size: 0.95rem; font-weight: 700; color: #0f172a;">Daftar Delegasi Tugas Perizinan</span>
                    </div>
                    @if($canManage)
                        <button type="button" class="btn btn-sm btn-gradient-primary d-flex align-items-center gap-1 shadow-sm"
                            data-bs-toggle="modal" data-bs-target="#modalTambahTugas">
                            <i class="mdi mdi-plus-circle" style="font-size: 1rem;"></i>
                            <span>Tugaskan Staf Legal</span>
                        </button>
                    @endif
                </div>

                <div class="card-body">
                    <!-- Filter Toolbar -->
                    <div class="filter-card">
                        <form id="filterForm" method="GET" action="{{ route('perizinan.tugas.index') }}">
                            <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 w-100">
                                <div class="d-flex flex-wrap align-items-center gap-2 flex-grow-1">
                                    <!-- Search Input -->
                                    <div style="min-width: 220px; max-width: 320px; flex: 1;">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="search" id="liveSearchInput"
                                                placeholder="Cari tugas, instansi, proyek..."
                                                value="{{ request('search') }}"
                                                style="border-top-right-radius: 0 !important; border-bottom-right-radius: 0 !important; border-right: none;">
                                            <button class="btn btn-gradient-primary d-flex align-items-center justify-content-center px-3" 
                                                type="submit" title="Cari"
                                                style="border-top-left-radius: 0 !important; border-bottom-left-radius: 0 !important; border-top-right-radius: 4px !important; border-bottom-right-radius: 4px !important; height: 38px; box-shadow: none;">
                                                <i class="mdi mdi-magnify" style="font-size: 1.15rem; color: #ffffff;"></i>
                                            </button>
                                        </div>
                                    </div>

                                    @if($canManage)
                                        <!-- Filter Staf Legal -->
                                        <div style="width: 170px;">
                                            <select name="employee_id" class="form-control" onchange="document.getElementById('filterForm').submit()">
                                                <option value="all">Semua Staf Legal</option>
                                                @foreach($legalStaffs as $staf)
                                                    <option value="{{ $staf->id }}" {{ request('employee_id') == $staf->id ? 'selected' : '' }}>
                                                        {{ $staf->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @endif

                                    <!-- Filter Proyek -->
                                    <div style="width: 170px;">
                                        <select name="proyek_id" class="form-control" onchange="document.getElementById('filterForm').submit()">
                                            <option value="all">Semua Proyek</option>
                                            @foreach($projects as $p)
                                                <option value="{{ $p['id'] }}" {{ request('proyek_id') == $p['id'] ? 'selected' : '' }}>
                                                    {{ $p['nama'] }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Filter Status -->
                                    <div style="width: 150px;">
                                        <select name="status" class="form-control" onchange="document.getElementById('filterForm').submit()">
                                            <option value="all" {{ request('status') == 'all' ? 'selected' : '' }}>Semua Status</option>
                                            <option value="Pending" {{ request('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="Dalam Proses" {{ request('status') == 'Dalam Proses' ? 'selected' : '' }}>Dalam Proses</option>
                                            <option value="Selesai" {{ request('status') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                            <option value="Terkendala" {{ request('status') == 'Terkendala' ? 'selected' : '' }}>Terkendala</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Filter Buttons -->
                                <div class="d-flex align-items-center gap-2 ms-auto">
                                    <button type="submit" class="btn btn-gradient-primary btn-icon-only" title="Terapkan Filter">
                                        <i class="mdi mdi-filter"></i>
                                    </button>
                                    @if(request()->hasAny(['search', 'employee_id', 'proyek_id', 'status']))
                                        <a href="{{ route('perizinan.tugas.index') }}" class="btn btn-gradient-secondary btn-icon-only" title="Reset Filter">
                                            <i class="mdi mdi-refresh"></i>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- TABEL DATA (PERSIS PERIZINAN) -->
                    <div class="table-responsive">
                        <table class="table table-hover align-middle table-perizinan">
                            <thead>
                                <tr>
                                    <th class="col-no">No</th>
                                    <th>Tugas Perizinan & Instansi</th>
                                    <th>Proyek Kawasan</th>
                                    <th>Staf Pelaksana</th>
                                    <th style="width: 110px;">Deadline</th>
                                    <th style="width: 120px;">Progres</th>
                                    <th class="col-status text-center">Status</th>
                                    <th>Terakhir Diupdate</th>
                                    <th class="col-aksi text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($tasks as $task)
                                    @php
                                        $st = $task->status;
                                        if ($st === 'Selesai') {
                                            $pColor = '#10b981';
                                        } elseif ($st === 'Dalam Proses') {
                                            $pColor = '#4f46e5';
                                        } elseif ($st === 'Terkendala') {
                                            $pColor = '#dc2626';
                                        } else {
                                            $pColor = '#94a3b8';
                                        }

                                        // Inisial Staf
                                        $staffName = $task->employee->name ?? 'Staf';
                                        $words = explode(' ', trim($staffName));
                                        $initials = count($words) >= 2 
                                            ? strtoupper(substr($words[0], 0, 1) . substr($words[1], 0, 1))
                                            : strtoupper(substr($staffName, 0, 2));

                                        // Inisial Updater
                                        $updaterName = $task->updater->name ?? ($task->assigner->name ?? '-');
                                        $updaterPos  = $task->updater->position->name ?? ($task->assigner->position->name ?? 'Staff');
                                        $upWords = explode(' ', trim($updaterName));
                                        $upInitials = count($upWords) >= 2 
                                            ? strtoupper(substr($upWords[0], 0, 1) . substr($upWords[1], 0, 1))
                                            : strtoupper(substr($updaterName, 0, 2));
                                    @endphp
                                    <tr>
                                        <td class="col-no fw-bold text-center text-muted">
                                            {{ $loop->iteration + ($tasks->currentPage() - 1) * $tasks->perPage() }}
                                        </td>

                                        <!-- Tugas & Instansi -->
                                        <td>
                                            <div class="fw-bold text-dark" style="font-size: 0.86rem; line-height: 1.35;">
                                                {{ $task->nama_tugas }}
                                            </div>
                                            <div class="text-secondary small mt-0.5" style="font-size: 0.76rem;">
                                                <i class="mdi mdi-bank-outline me-1"></i>{{ $task->instansi ?: 'Instansi Pemda / BPN' }}
                                            </div>
                                            @if($task->nomor_dokumen)
                                                <div class="mt-1">
                                                    <span class="badge bg-light text-dark border font-monospace" style="font-size: 0.7rem;">
                                                        <i class="mdi mdi-certificate-outline me-0.5 text-primary"></i>{{ $task->nomor_dokumen }}
                                                    </span>
                                                </div>
                                            @endif
                                        </td>

                                        <!-- Proyek Kawasan -->
                                        <td>
                                            <span class="badge px-2 py-1 text-wrap text-start" style="background-color: #f1f5f9; color: #334155; font-size: 0.78rem; font-weight: 600; border: 1px solid #e2e8f0;">
                                                <i class="mdi mdi-map-marker-outline text-danger me-0.5"></i>{{ $task->proyek_nama ?: 'Kawasan Umum' }}
                                            </span>
                                        </td>

                                        <!-- Staf Pelaksana -->
                                        <td>
                                            <div class="task-user-badge">
                                                <div class="user-avatar-circle" title="{{ $staffName }}">
                                                    {{ $initials }}
                                                </div>
                                                <div class="overflow-hidden">
                                                    <div class="fw-bold text-dark text-truncate" style="font-size: 0.84rem; line-height: 1.2;">
                                                        {{ $staffName }}
                                                    </div>
                                                    <small class="text-muted d-block text-truncate" style="font-size: 0.72rem;">
                                                        {{ $task->employee->position->name ?? 'Staff Legal' }}
                                                    </small>
                                                </div>
                                            </div>
                                        </td>

                                        <!-- Deadline -->
                                        <td>
                                            @if($task->deadline)
                                                @php
                                                    $isOverdue = $task->deadline->isPast() && $task->status !== 'Selesai';
                                                @endphp
                                                <div style="font-size: 0.8rem; font-weight: 600; color: {{ $isOverdue ? '#dc2626' : '#475569' }};">
                                                    <i class="mdi mdi-calendar-clock me-0.5"></i>{{ $task->deadline->format('d M Y') }}
                                                </div>
                                                @if($isOverdue)
                                                    <span class="badge bg-danger-subtle text-danger border border-danger-subtle mt-0.5" style="font-size: 0.68rem;">Terlambat</span>
                                                @else
                                                    <small class="text-muted d-block" style="font-size: 0.7rem;">{{ $task->deadline->diffForHumans() }}</small>
                                                @endif
                                            @else
                                                <span class="text-muted" style="font-size: 0.8rem;">-</span>
                                            @endif
                                        </td>

                                        <!-- Progres -->
                                        <td>
                                            <div class="dash-progress-wrap">
                                                <div class="dash-progress-bar-bg" style="width: 75px;">
                                                    <div class="dash-progress-bar-fill" style="width: {{ $task->progress }}%; background-color: {{ $pColor }};"></div>
                                                </div>
                                                <span style="font-size: 0.75rem; font-weight: 700; color: #334155;">{{ $task->progress }}%</span>
                                            </div>
                                        </td>

                                        <!-- Status -->
                                        <td class="col-status text-center">
                                            @if($task->status == 'Selesai')
                                                <span class="dash-status-pill on-track"><span class="dot"></span>Selesai</span>
                                            @elseif($task->status == 'Dalam Proses')
                                                <span class="dash-status-pill" style="background-color: #e0f2fe; color: #0284c7; border-color: #bae6fd;"><span class="dot" style="background-color: #0284c7;"></span>Proses</span>
                                            @elseif($task->status == 'Terkendala')
                                                <span class="dash-status-pill danger"><span class="dot"></span>Kendala</span>
                                            @else
                                                <span class="dash-status-pill" style="background-color: #f1f5f9; color: #64748b; border-color: #e2e8f0;"><span class="dot" style="background-color: #94a3b8;"></span>Pending</span>
                                            @endif
                                        </td>

                                        <!-- Terakhir Diupdate Oleh -->
                                        <td>
                                            <div class="d-flex align-items-center gap-2">
                                                <div class="user-avatar-circle updater" title="{{ $updaterName }}">
                                                    {{ $upInitials }}
                                                </div>
                                                <div>
                                                    <div class="fw-bold text-dark text-truncate" style="font-size: 0.82rem; line-height: 1.2;">
                                                        {{ $updaterName }}
                                                    </div>
                                                    <div class="d-flex align-items-center gap-1">
                                                        <span class="badge" style="background: #e0f2fe; color: #0284c7; font-size: 0.65rem; padding: 1px 5px; font-weight: 600;">
                                                            {{ $updaterPos }}
                                                        </span>
                                                        <small class="text-muted" style="font-size: 0.7rem;">
                                                            {{ $task->last_activity_at ? $task->last_activity_at->diffForHumans() : $task->updated_at->diffForHumans() }}
                                                        </small>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>

                                        <!-- Aksi -->
                                        <td class="col-aksi text-center">
                                            <div class="d-flex align-items-center justify-content-center gap-1">
                                                @if($canManage || ($isStaffLegal && $task->employee_id == auth()->id()))
                                                    <button type="button" class="btn btn-action-edit d-inline-flex align-items-center gap-1 shadow-none"
                                                        title="Update Progres & Dokumen"
                                                        onclick='bukaModalUpdateProgres(@json($task))'>
                                                        <i class="mdi mdi-pencil text-primary"></i>
                                                        <span>Progres</span>
                                                    </button>
                                                @endif

                                                <button type="button" class="btn btn-action-edit d-inline-flex align-items-center gap-1 shadow-none"
                                                    title="Lihat Riwayat & Audit Trail"
                                                    onclick="bukaModalRiwayatLog({{ $task->id }})">
                                                    <i class="mdi mdi-history text-info"></i>
                                                    <span>Log</span>
                                                </button>

                                                @if($canManage)
                                                    <div class="dropdown d-inline-block">
                                                        <button class="btn btn-action-dots d-inline-flex align-items-center justify-content-center shadow-none" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="mdi mdi-dots-vertical"></i>
                                                        </button>
                                                        <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0" style="font-size: 0.82rem; border-radius: 8px;">
                                                            <li>
                                                                <a class="dropdown-item d-flex align-items-center gap-2 py-1.5" href="javascript:void(0)" onclick='bukaModalEditTugas(@json($task))'>
                                                                    <i class="mdi mdi-account-switch-outline text-warning"></i>
                                                                    <span>Edit Penugasan / Reassign</span>
                                                                </a>
                                                            </li>
                                                            <li><hr class="dropdown-divider my-1"></li>
                                                            <li>
                                                                <form action="{{ route('perizinan.tugas.destroy', $task->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus tugas ini? Riwayat log tugas juga akan terhapus.');">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="dropdown-item text-danger d-flex align-items-center gap-2 py-1.5">
                                                                        <i class="mdi mdi-trash-can-outline"></i>
                                                                        <span>Hapus Tugas</span>
                                                                    </button>
                                                                </form>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center text-muted py-5">
                                            <div class="p-3">
                                                <i class="mdi mdi-clipboard-text-off-outline text-secondary" style="font-size: 2.8rem; opacity: 0.5;"></i>
                                                <h5 class="fw-bold text-dark mt-2 mb-1" style="font-size: 1rem;">Belum Ada Tugas Perizinan</h5>
                                                <p class="text-muted mb-0" style="font-size: 0.82rem;">
                                                    {{ $isStaffLegal && !$canManage ? 'Saat ini belum ada tugas perizinan yang didelegasikan kepada Anda.' : 'Silakan klik tombol "Tugaskan Staf Legal" untuk membagi tugas baru.' }}
                                                </p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if($tasks->hasPages())
                        <div class="p-3 border-top d-flex flex-wrap justify-content-between align-items-center gap-2">
                            <small class="text-muted" style="font-size: 0.82rem;">
                                Menampilkan {{ $tasks->firstItem() }} - {{ $tasks->lastItem() }} dari {{ $tasks->total() }} tugas
                            </small>
                            <div>
                                {{ $tasks->links('pagination::bootstrap-4') }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

</div>

<!-- ================= MODAL 1: TUGASKAN STAF LEGAL BARU ================= -->
@if($canManage)
<div class="modal fade" id="modalTambahTugas" tabindex="-1" aria-labelledby="modalTambahTugasLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 12px; overflow: hidden;">
            <div class="modal-header px-4 py-3 bg-white border-bottom">
                <div class="d-flex align-items-center gap-2">
                    <div class="p-2 rounded-2" style="background: rgba(79, 70, 229, 0.1); color: #4f46e5;">
                        <i class="mdi mdi-clipboard-plus-outline fs-5"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold text-dark mb-0" style="font-size: 1rem;">Tugaskan Staf Legal Baru</h5>
                        <small class="text-muted" style="font-size: 0.78rem;">Pemberian tugas pengurusan berkas izin & delegasi wewenang</small>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="{{ route('perizinan.tugas.store') }}" method="POST" onsubmit="return validateTambahTugasForm()">
                @csrf
                <div class="modal-body px-4 py-3 bg-white">
                    
                    <div class="row g-3">
                        <!-- Nama Tugas Perizinan (Pilihan Dropdown Master Izin + Ketik Manual) -->
                        <div class="col-md-7">
                            <div class="d-flex align-items-center justify-content-between mb-1">
                                <label class="form-label mb-0 fw-semibold text-dark" style="font-size: 0.8rem;">
                                    Nama Dokumen / Tugas Perizinan <span class="text-danger">*</span>
                                </label>
                                <button type="button" class="btn btn-link p-0 text-primary text-decoration-none fw-semibold" id="btnToggleManualTugas" onclick="toggleManualNamaTugas()" style="font-size: 0.75rem;">
                                    <i class="mdi mdi-keyboard-outline me-0.5"></i>Ketik Manual
                                </button>
                            </div>

                            <!-- Dropdown Pilihan Dokumen Perizinan (Default) -->
                            <div id="wrapperSelectNamaTugas">
                                <select class="form-select form-select-sm" id="selectNamaTugas" onchange="onSelectNamaTugasChange(this)">
                                    <option value="">-- Pilih Dokumen / Tugas Perizinan --</option>
                                    @foreach($masterDocs as $md)
                                        <option value="{{ $md->nama_dokumen }}" 
                                            data-instansi="{{ $md->instansi_terkait }}"
                                            data-catatan="{{ $md->deskripsi }}">
                                            {{ $md->kode_dokumen ? '[' . $md->kode_dokumen . '] ' : '' }}{{ $md->nama_dokumen }}
                                        </option>
                                    @endforeach
                                    <option value="__custom__">✍️ + Ketik Manual / Izin Lainnya...</option>
                                </select>
                            </div>

                            <!-- Input Ketik Manual (Jika memilih custom atau klik toggle) -->
                            <div id="wrapperInputNamaTugas" style="display: none;" class="mt-1.5">
                                <input type="text" id="inputManualNamaTugas" class="form-control form-control-sm" placeholder="Contoh: Pengurusan Izin Reklame / Amdal Khusus" oninput="onManualInputNamaTugas(this.value)">
                            </div>

                            <!-- Hidden field yang dikirim ke controller -->
                            <input type="hidden" name="nama_tugas" id="tambahNamaTugas" required>
                        </div>

                        <!-- Instansi Terkait -->
                        <div class="col-md-5">
                            <label class="form-label mb-1 fw-semibold text-dark" style="font-size: 0.8rem;">
                                Instansi / Dinas Terkait
                            </label>
                            <input type="text" name="instansi" id="tambahInstansi" class="form-control form-control-sm" placeholder="Otomatis terisi dari master / sesuaikan">
                        </div>

                        <!-- Proyek Kawasan -->
                        <div class="col-md-6">
                            <label class="form-label mb-1 fw-semibold text-dark" style="font-size: 0.8rem;">
                                Proyek Kawasan Tanah
                            </label>
                            <select name="proyek_id" class="form-select form-select-sm">
                                <option value="">-- Pilih Proyek Tanah / Bebas --</option>
                                @foreach($projects as $proj)
                                    <option value="{{ $proj['id'] }}">{{ $proj['nama'] }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Ditugaskan Kepada (Staf Legal) -->
                        <div class="col-md-6">
                            <label class="form-label mb-1 fw-semibold text-dark" style="font-size: 0.8rem;">
                                Ditugaskan Kepada (Staf Legal) <span class="text-danger">*</span>
                            </label>
                            <select name="employee_id" class="form-select form-select-sm" required>
                                <option value="">-- Pilih Staf Legal Pelaksana --</option>
                                @foreach($legalStaffs as $staf)
                                    <option value="{{ $staf->id }}">
                                        {{ $staf->name }} ({{ $staf->position->name ?? 'Staff Legal' }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Deadline Selesai -->
                        <div class="col-md-6">
                            <label class="form-label mb-1 fw-semibold text-dark" style="font-size: 0.8rem;">
                                Tenggat Waktu (Deadline)
                            </label>
                            <input type="date" name="deadline" class="form-control form-control-sm" min="{{ date('Y-m-d') }}">
                        </div>

                        <!-- Instruksi & Catatan Khusus -->
                        <div class="col-12">
                            <label class="form-label mb-1 fw-semibold text-dark" style="font-size: 0.8rem;">
                                Instruksi / Catatan Khusus Kepala Legal
                            </label>
                            <textarea name="catatan" id="tambahCatatan" rows="3" class="form-control form-control-sm" placeholder="Instruksi spesifik pengurusan berkas, persyaratan yang wajib dibawa, kontak dinas, dll."></textarea>
                        </div>
                    </div>

                </div>

                <div class="modal-footer px-4 py-2.5 bg-white border-top d-flex justify-content-between">
                    <button type="button" class="btn btn-light border btn-sm px-3" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary btn-sm px-4 fw-semibold shadow-sm">
                        <i class="mdi mdi-send-check me-1"></i> Simpan & Delegasikan Tugas
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif

<!-- ================= MODAL 2: UPDATE PROGRES & STATUS (STAF LEGAL & KEPALA) ================= -->
<div class="modal fade" id="modalUpdateProgres" tabindex="-1" aria-labelledby="modalUpdateProgresLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 12px; overflow: hidden;">
            <div class="modal-header px-4 py-3 bg-white border-bottom d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center gap-2">
                    <div class="p-2 rounded-2" style="background: rgba(16, 185, 129, 0.1); color: #10b981;">
                        <i class="mdi mdi-progress-check fs-5"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold text-dark mb-0" style="font-size: 1rem;" id="modalProgresTitle">
                            Update Progres Tugas Perizinan
                        </h5>
                        <small class="text-muted" style="font-size: 0.78rem;" id="modalProgresSubtitle">
                            Perbarui status penyelesaian, kendala lapangan, atau unggah dokumen izin resmi
                        </small>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="formUpdateProgres" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="modal-body px-4 py-3 bg-white">
                    
                    <!-- Alert Peringatan Audit Trail -->
                    <div class="p-2.5 rounded-3 mb-3 d-flex align-items-center gap-2" style="background: #eff6ff; border: 1px solid #bfdbfe; color: #1e40af; font-size: 0.8rem;">
                        <i class="mdi mdi-shield-account fs-5"></i>
                        <div>
                            Pembaruan data ini akan dicatat atas nama <strong>{{ auth()->user()->name }} ({{ auth()->user()->position->name ?? 'Staff' }})</strong> ke dalam Audit Trail / Riwayat Aktivitas.
                        </div>
                    </div>

                    <div class="row g-3">
                        <!-- Status Pengerjaan -->
                        <div class="col-md-6">
                            <label class="form-label mb-1 fw-semibold text-dark" style="font-size: 0.8rem;">
                                Status Pengerjaan <span class="text-danger">*</span>
                            </label>
                            <select name="status" id="updStatus" class="form-select form-select-sm fw-bold" required onchange="handleStatusChange(this.value)">
                                <option value="Pending">Pending (Belum Berjalan)</option>
                                <option value="Dalam Proses">Dalam Proses (Sedang di Instansi)</option>
                                <option value="Terkendala">Terkendala (Ada Masalah / Butuh Revisi)</option>
                                <option value="Selesai">Selesai (Izin Terbit & Sah)</option>
                            </select>
                        </div>

                        <!-- Persentase Progres (Slider + Input) -->
                        <div class="col-md-6">
                            <label class="form-label mb-1 fw-semibold text-dark d-flex justify-content-between" style="font-size: 0.8rem;">
                                <span>Persentase Progres (%)</span>
                                <span class="fw-bold text-primary" id="progressValDisplay">0%</span>
                            </label>
                            <div class="d-flex align-items-center gap-2">
                                <input type="range" class="form-range flex-grow-1" id="updProgressRange" min="0" max="100" step="5" oninput="syncProgressInput(this.value)">
                                <input type="number" name="progress" id="updProgressNum" class="form-control form-control-sm text-center fw-bold" min="0" max="100" style="width: 70px;" oninput="syncProgressRange(this.value)">
                            </div>
                        </div>

                        <!-- Nomor SK & Tanggal Terbit (Tampil Jika Selesai / Terbit) -->
                        <div class="col-md-7">
                            <label class="form-label mb-1 fw-semibold text-dark" style="font-size: 0.8rem;">
                                Nomor Izin / SK Resmi
                            </label>
                            <input type="text" name="nomor_dokumen" id="updNomorDokumen" class="form-control form-control-sm font-monospace" placeholder="Contoh: 503/123/PUPR/2026">
                        </div>

                        <div class="col-md-5">
                            <label class="form-label mb-1 fw-semibold text-dark" style="font-size: 0.8rem;">
                                Tanggal Terbit SK
                            </label>
                            <input type="date" name="tanggal_terbit" id="updTanggalTerbit" class="form-control form-control-sm">
                        </div>

                        <!-- Upload Berkas SK / Izin -->
                        <div class="col-12">
                            <label class="form-label mb-1 fw-semibold text-dark" style="font-size: 0.8rem;">
                                Unggah Dokumen Bukti / File SK (PDF / Gambar)
                            </label>
                            <input type="file" name="file_dokumen" class="form-control form-control-sm" accept=".pdf,.jpg,.jpeg,.png">
                            <small class="text-muted" style="font-size: 0.72rem;">Format didukung: PDF, JPG, PNG. Maksimal 15 MB.</small>
                            <div id="fileExistingContainer" class="mt-1" style="display: none;">
                                <a href="#" id="fileExistingLink" target="_blank" class="btn btn-sm btn-outline-success py-0.5 px-2" style="font-size: 0.74rem;">
                                    <i class="mdi mdi-file-check me-1"></i>Lihat Berkas Terunggah
                                </a>
                            </div>
                        </div>

                        <!-- Catatan Progres / Kendala Lapangan -->
                        <div class="col-12">
                            <label class="form-label mb-1 fw-semibold text-dark" style="font-size: 0.8rem;">
                                Catatan Progres / Kendala Lapangan
                            </label>
                            <textarea name="kendala" id="updKendala" rows="3" class="form-control form-control-sm" placeholder="Jelaskan progres hari ini, kendala di instansi, berkas yang kurang, atau arahan tindak lanjut..."></textarea>
                        </div>
                    </div>

                </div>

                <div class="modal-footer px-4 py-2.5 bg-white border-top d-flex justify-content-between">
                    <button type="button" class="btn btn-light border btn-sm px-3" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success btn-sm px-4 fw-semibold shadow-sm text-white">
                        <i class="mdi mdi-content-save-check me-1"></i> Simpan Pembaruan Progres
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ================= MODAL 3: AUDIT TRAIL / RIWAYAT AKTIVITAS ================= -->
<div class="modal fade" id="modalRiwayatLog" tabindex="-1" aria-labelledby="modalRiwayatLogLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 12px; overflow: hidden;">
            <div class="modal-header px-4 py-3 bg-white border-bottom">
                <div class="d-flex align-items-center gap-2">
                    <div class="p-2 rounded-2" style="background: rgba(14, 165, 233, 0.1); color: #0ea5e9;">
                        <i class="mdi mdi-history fs-5"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold text-dark mb-0" style="font-size: 1rem;">
                            Riwayat Aktivitas & Audit Trail
                        </h5>
                        <small class="text-muted" id="auditModalSubtitle" style="font-size: 0.78rem;">
                            Kronologis pembaruan data dan staf pengubah
                        </small>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body px-4 py-3 bg-white">
                <!-- Header Ringkasan Tugas -->
                <div class="p-3 rounded-3 mb-4" style="background: #f8fafc; border: 1px solid #e2e8f0;">
                    <div class="row g-2">
                        <div class="col-sm-6">
                            <span class="text-muted small d-block" style="font-size: 0.72rem;">NAMA TUGAS</span>
                            <span class="fw-bold text-dark" id="auditTaskNama" style="font-size: 0.88rem;">-</span>
                        </div>
                        <div class="col-sm-6">
                            <span class="text-muted small d-block" style="font-size: 0.72rem;">PROYEK KAWASAN</span>
                            <span class="fw-bold text-dark" id="auditTaskProyek" style="font-size: 0.88rem;">-</span>
                        </div>
                        <div class="col-sm-6 mt-2">
                            <span class="text-muted small d-block" style="font-size: 0.72rem;">STAF PELAKSANA</span>
                            <span class="fw-bold text-primary" id="auditTaskStaff" style="font-size: 0.84rem;">-</span>
                        </div>
                        <div class="col-sm-6 mt-2">
                            <span class="text-muted small d-block" style="font-size: 0.72rem;">STATUS & PROGRES SAAT INI</span>
                            <span id="auditTaskStatusBadge" class="badge bg-secondary">-</span>
                        </div>
                    </div>
                </div>

                <!-- Container Timeline Kronologis -->
                <h6 class="fw-bold text-dark mb-3" style="font-size: 0.86rem;">
                    <i class="mdi mdi-timeline-clock-outline me-1 text-primary"></i> Kronologi Pembaruan (Terbaru ke Terlama):
                </h6>
                
                <div id="timelineContentWrapper" class="timeline-container">
                    <div class="text-center py-4 text-muted">
                        <div class="spinner-border spinner-border-sm text-primary me-1" role="status"></div>
                        <span>Memuat riwayat aktivitas...</span>
                    </div>
                </div>
            </div>

            <div class="modal-footer px-4 py-2.5 bg-white border-top">
                <button type="button" class="btn btn-secondary btn-sm px-4" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- ================= MODAL 4: EDIT PENUGASAN / REASSIGN (KEPALA & OWNER) ================= -->
@if($canManage)
<div class="modal fade" id="modalEditTugas" tabindex="-1" aria-labelledby="modalEditTugasLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 12px; overflow: hidden;">
            <div class="modal-header px-4 py-3 bg-white border-bottom">
                <div class="d-flex align-items-center gap-2">
                    <div class="p-2 rounded-2" style="background: rgba(245, 158, 11, 0.1); color: #f59e0b;">
                        <i class="mdi mdi-account-switch-outline fs-5"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold text-dark mb-0" style="font-size: 1rem;">Edit Penugasan / Reassign Staf</h5>
                        <small class="text-muted" style="font-size: 0.78rem;">Alihkan tugas perizinan ke staf legal lain atau perpanjang deadline</small>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="formEditTugas" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body px-4 py-3 bg-white">
                    <div class="row g-3">
                        <div class="col-md-7">
                            <label class="form-label mb-1 fw-semibold text-dark" style="font-size: 0.8rem;">
                                Nama Tugas Perizinan <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="nama_tugas" id="editNamaTugas" class="form-control form-control-sm" required list="masterDocsListEdit" placeholder="Pilih atau ketik nama tugas...">
                            <datalist id="masterDocsListEdit">
                                @foreach($masterDocs as $md)
                                    <option value="{{ $md->nama_dokumen }}">
                                @endforeach
                            </datalist>
                        </div>

                        <div class="col-md-5">
                            <label class="form-label mb-1 fw-semibold text-dark" style="font-size: 0.8rem;">
                                Instansi Terkait
                            </label>
                            <input type="text" name="instansi" id="editInstansi" class="form-control form-control-sm">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label mb-1 fw-semibold text-dark" style="font-size: 0.8rem;">
                                Proyek Kawasan
                            </label>
                            <select name="proyek_id" id="editProyekId" class="form-select form-select-sm">
                                <option value="">-- Bebas / Tanpa Proyek --</option>
                                @foreach($projects as $proj)
                                    <option value="{{ $proj['id'] }}">{{ $proj['nama'] }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label mb-1 fw-semibold text-dark" style="font-size: 0.8rem;">
                                Alihkan Tugas Kepada (Staf Legal) <span class="text-danger">*</span>
                            </label>
                            <select name="employee_id" id="editEmployeeId" class="form-select form-select-sm" required>
                                @foreach($legalStaffs as $staf)
                                    <option value="{{ $staf->id }}">
                                        {{ $staf->name }} ({{ $staf->position->name ?? 'Staff Legal' }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label mb-1 fw-semibold text-dark" style="font-size: 0.8rem;">
                                Batas Waktu (Deadline)
                            </label>
                            <input type="date" name="deadline" id="editDeadline" class="form-control form-control-sm">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label mb-1 fw-semibold text-dark" style="font-size: 0.8rem;">
                                Status Tugas
                            </label>
                            <select name="status" id="editStatus" class="form-select form-select-sm">
                                <option value="Pending">Pending</option>
                                <option value="Dalam Proses">Dalam Proses</option>
                                <option value="Terkendala">Terkendala</option>
                                <option value="Selesai">Selesai</option>
                            </select>
                        </div>

                        <div class="col-12">
                            <label class="form-label mb-1 fw-semibold text-dark" style="font-size: 0.8rem;">
                                Catatan / Instruksi Tambahan
                            </label>
                            <textarea name="catatan" id="editCatatan" rows="3" class="form-control form-control-sm"></textarea>
                        </div>
                    </div>
                </div>

                <div class="modal-footer px-4 py-2.5 bg-white border-top d-flex justify-content-between">
                    <button type="button" class="btn btn-light border btn-sm px-3" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-warning btn-sm px-4 fw-semibold shadow-sm">
                        <i class="mdi mdi-content-save-edit me-1"></i> Simpan Perubahan Penugasan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif

@push('scripts')
<script>
    // TOGGLE & PILIHAN NAMA DOKUMEN / TUGAS PERIZINAN
    var isManualNamaTugasMode = false;

    function toggleManualNamaTugas(forceManual = null) {
        if (forceManual !== null) {
            isManualNamaTugasMode = forceManual;
        } else {
            isManualNamaTugasMode = !isManualNamaTugasMode;
        }

        var wrapperSelect = document.getElementById('wrapperSelectNamaTugas');
        var wrapperInput = document.getElementById('wrapperInputNamaTugas');
        var btnToggle = document.getElementById('btnToggleManualTugas');
        var selectEl = document.getElementById('selectNamaTugas');
        var inputManual = document.getElementById('inputManualNamaTugas');
        var hiddenInput = document.getElementById('tambahNamaTugas');

        if (isManualNamaTugasMode) {
            wrapperSelect.style.display = 'none';
            wrapperInput.style.display = 'block';
            btnToggle.innerHTML = '<i class="mdi mdi-format-list-bulleted me-0.5"></i>Pilih dari Daftar';
            hiddenInput.value = inputManual.value.trim();
            setTimeout(function() { inputManual.focus(); }, 100);
        } else {
            wrapperSelect.style.display = 'block';
            wrapperInput.style.display = 'none';
            btnToggle.innerHTML = '<i class="mdi mdi-keyboard-outline me-0.5"></i>Ketik Manual';
            if (selectEl.value && selectEl.value !== '__custom__') {
                hiddenInput.value = selectEl.value;
            } else {
                selectEl.value = '';
                hiddenInput.value = '';
            }
        }
    }

    function onSelectNamaTugasChange(selectEl) {
        var val = selectEl.value;
        var hiddenInput = document.getElementById('tambahNamaTugas');

        if (val === '__custom__') {
            toggleManualNamaTugas(true);
            return;
        }

        hiddenInput.value = val;

        // Auto-fill instansi & catatan jika dipilih dari master
        var selectedOpt = selectEl.options[selectEl.selectedIndex];
        if (selectedOpt && val) {
            var instansi = selectedOpt.getAttribute('data-instansi') || '';
            var catatan = selectedOpt.getAttribute('data-catatan') || '';

            var instansiInput = document.getElementById('tambahInstansi');
            var catatanInput = document.getElementById('tambahCatatan');

            if (instansi) {
                instansiInput.value = instansi;
            }
            if (catatan && (!catatanInput.value || catatanInput.value.trim() === '')) {
                catatanInput.value = catatan;
            }
        }
    }

    function onManualInputNamaTugas(val) {
        document.getElementById('tambahNamaTugas').value = val.trim();
    }

    function validateTambahTugasForm() {
        var hiddenInput = document.getElementById('tambahNamaTugas');
        if (isManualNamaTugasMode) {
            hiddenInput.value = document.getElementById('inputManualNamaTugas').value.trim();
        } else {
            var selectVal = document.getElementById('selectNamaTugas').value;
            if (selectVal && selectVal !== '__custom__') {
                hiddenInput.value = selectVal;
            }
        }

        if (!hiddenInput.value || hiddenInput.value.trim() === '') {
            alert('Silakan pilih salah satu dokumen perizinan dari daftar atau ketik nama tugas manual.');
            if (isManualNamaTugasMode) {
                document.getElementById('inputManualNamaTugas').focus();
            } else {
                document.getElementById('selectNamaTugas').focus();
            }
            return false;
        }
        return true;
    }

    // HELPER UNTUK SET NILAI PROGRES (RANGE, NUMBER, & DISPLAY)
    function setProgressValues(val) {
        var n = Math.min(100, Math.max(0, parseInt(val) || 0));
        document.getElementById('updProgressRange').value = n;
        document.getElementById('updProgressNum').value = n;
        document.getElementById('progressValDisplay').textContent = n + '%';
        return n;
    }

    // KETIKA SLIDER ATAU INPUT ANGKA PROGRES DIUBAH
    function syncProgressInput(val) {
        var n = setProgressValues(val);
        var statusEl = document.getElementById('updStatus');
        
        if (n === 100) {
            statusEl.value = 'Selesai';
        } else if (n === 0) {
            if (statusEl.value !== 'Terkendala') {
                statusEl.value = 'Pending';
            }
        } else { // 1% - 99%
            if (statusEl.value === 'Pending' || statusEl.value === 'Selesai') {
                statusEl.value = 'Dalam Proses';
            }
        }
    }

    function syncProgressRange(val) {
        syncProgressInput(val);
    }

    // KETIKA PILIHAN STATUS PENGERJAAN DIUBAH
    function handleStatusChange(status) {
        var currentProg = parseInt(document.getElementById('updProgressNum').value) || 0;

        if (status === 'Selesai') {
            setProgressValues(100);
        } else if (status === 'Pending') {
            setProgressValues(0);
        } else if (status === 'Dalam Proses') {
            // Jika sebelumnya 0% atau 100%, beri progres aktif wajar (misal 50%)
            if (currentProg === 0 || currentProg === 100) {
                setProgressValues(50);
            }
        } else if (status === 'Terkendala') {
            // Status Terkendala tidak boleh 100% (selesai)
            if (currentProg >= 100) {
                setProgressValues(50);
            } else if (currentProg === 0) {
                setProgressValues(25);
            }
        }
    }

    // BUKA MODAL UPDATE PROGRES
    function bukaModalUpdateProgres(task) {
        document.getElementById('modalProgresTitle').textContent = 'Update Progres: ' + task.nama_tugas;
        document.getElementById('modalProgresSubtitle').textContent = 'Proyek: ' + (task.proyek_nama || 'Umum') + ' • Pelaksana: ' + (task.employee ? task.employee.name : '-');
        
        var form = document.getElementById('formUpdateProgres');
        form.action = '/perizinan-tugas/' + task.id + '/progress';

        var st = task.status || 'Pending';
        var prog = parseInt(task.progress) || 0;

        // Pastikan status & progres awal selaras
        if (st === 'Selesai') {
            prog = 100;
        } else if (st === 'Pending' && prog !== 0) {
            prog = 0;
        } else if (st === 'Terkendala' && prog >= 100) {
            prog = 50;
        }

        document.getElementById('updStatus').value = st;
        setProgressValues(prog);

        document.getElementById('updNomorDokumen').value = task.nomor_dokumen || '';
        document.getElementById('updTanggalTerbit').value = task.tanggal_terbit ? task.tanggal_terbit.substring(0, 10) : '';
        document.getElementById('updKendala').value = task.kendala || '';

        var fileBox = document.getElementById('fileExistingContainer');
        var fileLink = document.getElementById('fileExistingLink');
        if (task.file_dokumen) {
            fileBox.style.display = 'block';
            fileLink.href = '/storage/' + task.file_dokumen;
        } else {
            fileBox.style.display = 'none';
        }

        var modal = new bootstrap.Modal(document.getElementById('modalUpdateProgres'));
        modal.show();
    }

    // BUKA MODAL EDIT TUGAS / REASSIGN
    function bukaModalEditTugas(task) {
        var form = document.getElementById('formEditTugas');
        form.action = '/perizinan-tugas/' + task.id;

        document.getElementById('editNamaTugas').value = task.nama_tugas || '';
        document.getElementById('editInstansi').value = task.instansi || '';
        document.getElementById('editProyekId').value = task.proyek_id || '';
        document.getElementById('editEmployeeId').value = task.employee_id || '';
        document.getElementById('editDeadline').value = task.deadline ? task.deadline.substring(0, 10) : '';
        document.getElementById('editStatus').value = task.status || 'Pending';
        document.getElementById('editCatatan').value = task.catatan || '';

        var modal = new bootstrap.Modal(document.getElementById('modalEditTugas'));
        modal.show();
    }

    // BUKA MODAL RIWAYAT AUDIT TRAIL LOG
    function bukaModalRiwayatLog(taskId) {
        var modal = new bootstrap.Modal(document.getElementById('modalRiwayatLog'));
        modal.show();

        var container = document.getElementById('timelineContentWrapper');
        container.innerHTML = `
            <div class="text-center py-4 text-muted">
                <div class="spinner-border spinner-border-sm text-primary me-1" role="status"></div>
                <span>Memuat riwayat aktivitas...</span>
            </div>
        `;

        fetch('/perizinan-tugas/' + taskId + '/logs')
            .then(res => res.json())
            .then(data => {
                if (data.status !== 'success') {
                    container.innerHTML = '<div class="alert alert-danger py-2">Gagal memuat log aktivitas.</div>';
                    return;
                }

                var task = data.task;
                document.getElementById('auditTaskNama').textContent = task.nama_tugas;
                document.getElementById('auditTaskProyek').textContent = task.proyek_nama || 'Kawasan Umum';
                document.getElementById('auditTaskStaff').textContent = task.staff_name + ' (' + task.staff_pos + ')';
                
                var stBadge = document.getElementById('auditTaskStatusBadge');
                stBadge.textContent = task.status + ' (' + task.progress + '%)';
                stBadge.className = 'badge ' + (task.status === 'Selesai' ? 'bg-success' : (task.status === 'Dalam Proses' ? 'bg-primary' : (task.status === 'Terkendala' ? 'bg-danger' : 'bg-secondary')));

                var logs = data.logs;
                if (!logs || logs.length === 0) {
                    container.innerHTML = '<p class="text-muted text-center py-3">Belum ada catatan aktivitas perubahan.</p>';
                    return;
                }

                var html = '';
                logs.forEach(function(item) {
                    var pointClass = '';
                    var icon = 'mdi-pencil';
                    if (item.action.includes('Selesai') || item.new_status === 'Selesai') {
                        pointClass = 'success';
                        icon = 'mdi-check-bold';
                    } else if (item.action.includes('Kendala') || item.new_status === 'Terkendala') {
                        pointClass = 'danger';
                        icon = 'mdi-alert';
                    } else if (item.action.includes('Penugasan') || item.action.includes('Reassign')) {
                        pointClass = 'warning';
                        icon = 'mdi-account-arrow-right';
                    }

                    var fileBtn = '';
                    if (item.file_url) {
                        fileBtn = `
                            <div class="mt-2">
                                <a href="${item.file_url}" target="_blank" class="btn btn-xs btn-outline-success py-1 px-2 fw-semibold" style="font-size: 0.74rem; border-radius: 4px;">
                                    <i class="mdi mdi-file-download-outline me-1"></i>Unduh / Pratinjau Dokumen SK
                                </a>
                            </div>
                        `;
                    }

                    html += `
                        <div class="timeline-item">
                            <div class="timeline-point ${pointClass}">
                                <i class="mdi ${icon}"></i>
                            </div>
                            <div class="timeline-box">
                                <div class="d-flex flex-wrap align-items-center justify-content-between gap-1 mb-1">
                                    <div class="d-flex align-items-center gap-1.5">
                                        <span class="fw-bold text-dark" style="font-size: 0.86rem;">${item.user_name}</span>
                                        <span class="badge" style="background: #e0f2fe; color: #0369a1; font-size: 0.68rem; font-weight: 600;">
                                            ${item.user_pos}
                                        </span>
                                    </div>
                                    <small class="text-muted" style="font-size: 0.72rem;">
                                        <i class="mdi mdi-clock-outline me-0.5"></i>${item.created_at} (${item.time_ago})
                                    </small>
                                </div>

                                <div class="fw-semibold text-primary mb-1" style="font-size: 0.8rem;">
                                    ${item.action}
                                </div>

                                ${item.new_status ? `
                                    <div class="mb-1.5" style="font-size: 0.78rem;">
                                        <span class="text-muted">Status:</span>
                                        <span class="badge bg-light text-dark border px-2 py-0.5">${item.old_status || 'Awal'}</span>
                                        <i class="mdi mdi-arrow-right text-muted mx-1"></i>
                                        <span class="badge bg-primary px-2 py-0.5">${item.new_status}</span>
                                        ${item.new_progress !== null ? `<span class="fw-bold text-dark ms-1">(${item.new_progress}%)</span>` : ''}
                                    </div>
                                ` : ''}

                                <div class="text-secondary" style="font-size: 0.8rem; line-height: 1.35; background: #ffffff; padding: 6px 10px; border-radius: 6px; border: 1px solid #f1f5f9;">
                                    ${item.keterangan || 'Tidak ada catatan tambahan.'}
                                </div>

                                ${fileBtn}
                            </div>
                        </div>
                    `;
                });

                container.innerHTML = html;
            })
            .catch(err => {
                console.error(err);
                container.innerHTML = '<div class="alert alert-danger py-2">Gagal menghubungi server untuk memuat log.</div>';
            });
    }
</script>
@endpush

@endsection
