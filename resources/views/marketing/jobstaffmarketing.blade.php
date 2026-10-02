@extends('layouts.partial.app')

@section('title', 'Daftar Tugas Staff Marketing - Property Management App')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard-clean.css') }}?v={{ time() }}">
    <style>
        /* ─── Compact Table Card (Sama Persis Perizinan) ───────────── */
        .card.compact-table-card,
        .compact-table-card {
            background: #ffffff !important;
            border: 1px solid #e2e8f0 !important;
            border-radius: 8px !important;
            box-shadow: none !important;
            transition: border-color 0.2s ease;
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
            padding: 0.85rem 1.25rem 1.25rem 1.25rem !important;
            background: #ffffff !important;
        }

        /* ─── Filter Card ─────────────────────────────────────────── */
        .filter-card {
            padding: 0.75rem 1rem !important;
            margin-bottom: 1rem !important;
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
        }

        .compact-table-card .filter-card {
            margin-top: 0 !important;
            margin-bottom: 0.75rem !important;
        }

        .compact-table-card .filter-card form {
            margin-bottom: 0 !important;
        }

        /* ─── Form Controls & Buttons (Solid 1 Warna, Tanpa Gradient) ── */
        .form-control, .form-select, select.form-control {
            border: 1px solid #cbd5e1;
            border-radius: 6px !important;
            padding: 0.55rem 0.8rem;
            font-size: 0.86rem;
            color: #1e293b;
            background-color: #ffffff;
            height: auto;
            min-height: 38px;
            transition: all 0.2s ease;
        }

        .form-control:focus, .form-select:focus, select.form-control:focus {
            border-color: #5046e5 !important;
            box-shadow: 0 0 0 3px rgba(80, 70, 229, 0.15) !important;
            outline: none;
        }

        /* ─── Tombol Solid Ungu (1 Warna, Tanpa Gradient) ────────── */
        .btn-gradient-primary {
            background-color: #7c3aed !important;
            background-image: none !important;
            color: #ffffff !important;
            border: none !important;
            transition: all 0.2s ease;
        }

        .btn-gradient-primary:hover {
            background-color: #6d28d9 !important;
            background-image: none !important;
            color: #ffffff !important;
        }

        .btn-gradient-secondary {
            background-color: #64748b !important;
            background-image: none !important;
            color: #ffffff !important;
            border: none !important;
            transition: all 0.2s ease;
        }

        .btn-gradient-secondary:hover {
            background-color: #475569 !important;
            background-image: none !important;
            color: #ffffff !important;
        }

        .btn-icon-only {
            width: 38px;
            height: 38px;
            padding: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 6px;
            flex-shrink: 0;
        }

        .btn-icon-only i {
            font-size: 1.15rem;
        }

        .btn-icon-only-mobile {
            height: 38px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 6px;
        }

        .btn-icon-only-mobile i {
            font-size: 1.15rem;
        }

        /* ─── Table Styling (Persis Perizinan) ────────────────────── */
        .table-marketing {
            width: 100% !important;
            margin-bottom: 0;
        }

        .table-marketing thead th {
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

        .table-marketing tbody td {
            padding: 0.75rem 0.6rem !important;
            font-size: 0.84rem;
            color: #1e293b;
            border-bottom: 1px solid #f1f5f9;
            vertical-align: middle;
        }

        .table-marketing tbody tr:hover {
            background-color: #f8fafc;
        }

        /* ─── Status Badge ─────────────────────────────────────────── */
        .badge-status {
            padding: 0.35rem 0.75rem;
            border-radius: 30px;
            font-weight: 600;
            font-size: 0.78rem;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .badge-status.pending {
            background: #fef3c7;
            color: #b45309;
            border: 1px solid #fde68a;
        }

        .badge-status.proses {
            background: #e0f2fe;
            color: #0284c7;
            border: 1px solid #bae6fd;
        }

        .badge-status.selesai {
            background: #dcfce7;
            color: #15803d;
            border: 1px solid #bbf7d0;
        }

        /* ─── Action Buttons (Persis Perizinan) ──────────────────── */
        .btn-action-edit {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            color: #1e293b;
            border-radius: 6px;
            padding: 4px 10px;
            font-size: 0.8rem;
            font-weight: 500;
            transition: all 0.15s ease;
            text-decoration: none !important;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .btn-action-edit:hover {
            background: #f8fafc;
            border-color: #cbd5e1;
            color: #0f172a;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        }

        .col-aksi {
            min-width: 195px !important;
            white-space: nowrap !important;
        }

        /* ─── Modals (Solid 1 Warna, Tanpa Gradient) ──────────────── */
        .modal-content {
            border: none;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
        }

        .modal-header {
            background-color: #5046e5 !important;
            background-image: none !important;
            color: white !important;
            padding: 1rem 1.25rem;
            border-bottom: none;
        }

        .modal-header .btn-close {
            filter: brightness(0) invert(1);
        }

        .modal-title {
            font-weight: 700;
            font-size: 1.05rem;
            color: #ffffff !important;
        }

        .modal-body {
            padding: 1.25rem;
            background: #ffffff;
        }

        .modal-body .form-label {
            font-size: 0.82rem;
            font-weight: 700;
            color: #1e293b !important;
            margin-bottom: 0.35rem;
        }

        .modal-footer {
            background: #f8fafc;
            border-top: 1px solid #edf2f9;
            padding: 0.85rem 1.25rem;
        }

        /* ─── Select2 Bootstrap-5 Alignment ───────────────────────── */
        .select2-container--bootstrap-5 .select2-selection {
            min-height: 38px !important;
            height: 38px !important;
            padding: 0.375rem 0.75rem !important;
            display: flex !important;
            align-items: center !important;
            border-color: #cbd5e1 !important;
            border-radius: 6px !important;
            font-size: 0.86rem !important;
            background-color: #ffffff !important;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

        .select2-container--bootstrap-5 .select2-selection--single .select2-selection__rendered {
            line-height: 1.5 !important;
            padding-left: 0 !important;
            color: #1e293b !important;
        }

        .select2-container--bootstrap-5.select2-container--focus .select2-selection,
        .select2-container--bootstrap-5.select2-container--open .select2-selection {
            border-color: #5046e5 !important;
            box-shadow: 0 0 0 3px rgba(80, 70, 229, 0.15) !important;
        }

        .select2-container--bootstrap-5 .select2-dropdown {
            border: 1px solid #e2e8f0 !important;
            border-radius: 8px !important;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08) !important;
            overflow: hidden !important;
            z-index: 1050 !important;
        }

        .select2-container--bootstrap-5 .select2-results__option {
            padding: 0.45rem 0.85rem !important;
            font-size: 0.85rem !important;
            color: #1e293b !important;
            transition: background-color 0.15s ease, color 0.15s ease;
        }

        .select2-container--bootstrap-5 .select2-results__option--highlighted,
        .select2-container--bootstrap-5 .select2-results__option--highlighted.select2-results__option--selectable {
            background-color: #eef2ff !important;
            color: #5046e5 !important;
        }

        .select2-container--bootstrap-5 .select2-results__option[aria-selected="true"],
        .select2-container--bootstrap-5 .select2-results__option--selected {
            background-color: #e0e7ff !important;
            color: #3730a3 !important;
            font-weight: 600 !important;
        }
    </style>
@endpush

@section('content')
<div class="container-fluid px-2 px-md-4 py-3">

    <!-- Page Title (Bersih tanpa deskripsi, persis Perizinan) -->
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">
        <div>
            <h2 class="text-dark mb-0 fw-bold" style="font-size: 1.55rem; letter-spacing: -0.02em;">
                Tugas Staff Marketing
            </h2>
        </div>
    </div>

    <!-- 4 KPI Metrics Card Grid (Persis Dashboard & Perizinan) -->
    <div class="dash-kpi-grid mb-4">
        <!-- Card 1: Total Tugas (Ungu) -->
        <div class="dash-kpi-card">
            <div class="dash-kpi-left">
                <div class="dash-kpi-icon purple">
                    <i class="mdi mdi-clipboard-text-outline"></i>
                </div>
                <div class="dash-kpi-info">
                    <div class="dash-kpi-label">Total Tugas</div>
                    <div class="dash-kpi-val">{{ $totalTugas ?? 0 }}</div>
                    <div class="dash-kpi-sub">Seluruh Tugas Marketing</div>
                </div>
            </div>
            <div class="dash-kpi-action purple">
                <i class="mdi mdi-arrow-right"></i>
            </div>
        </div>

        <!-- Card 2: Pending (Amber / Orange) -->
        <div class="dash-kpi-card">
            <div class="dash-kpi-left">
                <div class="dash-kpi-icon amber">
                    <i class="mdi mdi-clock-outline"></i>
                </div>
                <div class="dash-kpi-info">
                    <div class="dash-kpi-label">Pending</div>
                    <div class="dash-kpi-val">{{ $pendingTugas ?? 0 }}</div>
                    <div class="dash-kpi-sub">Menunggu Dikerjakan</div>
                </div>
            </div>
            <div class="dash-kpi-action amber">
                <i class="mdi mdi-arrow-right"></i>
            </div>
        </div>

        <!-- Card 3: Sedang Proses (Biru) -->
        <div class="dash-kpi-card">
            <div class="dash-kpi-left">
                <div class="dash-kpi-icon blue">
                    <i class="mdi mdi-progress-wrench"></i>
                </div>
                <div class="dash-kpi-info">
                    <div class="dash-kpi-label">Sedang Proses</div>
                    <div class="dash-kpi-val">{{ $prosesTugas ?? 0 }}</div>
                    <div class="dash-kpi-sub">Dalam Pengerjaan</div>
                </div>
            </div>
            <div class="dash-kpi-action blue">
                <i class="mdi mdi-arrow-right"></i>
            </div>
        </div>

        <!-- Card 4: Selesai (Hijau) -->
        <div class="dash-kpi-card">
            <div class="dash-kpi-left">
                <div class="dash-kpi-icon green">
                    <i class="mdi mdi-check-circle-outline"></i>
                </div>
                <div class="dash-kpi-info">
                    <div class="dash-kpi-label">Selesai</div>
                    <div class="dash-kpi-val">{{ $selesaiTugas ?? 0 }}</div>
                    <div class="dash-kpi-sub">Tugas Telah Tuntas</div>
                </div>
            </div>
            <div class="dash-kpi-action green">
                <i class="mdi mdi-arrow-right"></i>
            </div>
        </div>
    </div>

    <!-- Main Container: Table & Filters (Persis Format Perizinan) -->
    <div class="row mt-2 mt-sm-2 mt-md-3">
        <div class="col-12">
            <div class="card compact-table-card">
                <div class="card-header bg-white d-flex flex-wrap flex-md-row justify-content-between align-items-center gap-2">
                    <div class="d-flex align-items-center gap-2">
                        <div style="width: 32px; height: 32px; border-radius: 5px; background-color: #f3e8ff; color: #5046e5; display: inline-flex; align-items: center; justify-content: center; font-size: 1.15rem; flex-shrink: 0;">
                            <i class="mdi mdi-format-list-checks"></i>
                        </div>
                        <span style="font-size: 0.95rem; font-weight: 700; color: #0f172a;">Daftar Tugas Marketing</span>
                    </div>

                    <a href="{{ route('marketing.create') }}" class="btn btn-sm btn-gradient-primary d-inline-flex align-items-center px-3 py-1.5 fw-semibold shadow-sm" style="border-radius: 5px; font-size: 0.84rem;">
                        <i class="mdi mdi-plus-circle-outline fs-6" style="margin-right: 6px !important;"></i>
                        <span>Tambah Tugas</span>
                    </a>
                </div>

                <div class="card-body">
                    <!-- FILTER SECTION -->
                    <div class="filter-card">

                        <!-- DESKTOP & TABLET VERSION -->
                        <div class="filter-row-desktop d-none d-md-block">
                            <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 w-100">
                                <div class="d-flex flex-wrap align-items-center gap-2 flex-grow-1">

                                    <!-- Search -->
                                    <div style="min-width: 200px; max-width: 280px; flex: 1;">
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="searchInput"
                                                placeholder="Cari tugas / deskripsi / staff..." value="{{ request('search') }}"
                                                style="border-top-right-radius: 0 !important; border-bottom-right-radius: 0 !important; border-right: none;">
                                            <button class="btn btn-gradient-primary d-flex align-items-center justify-content-center px-3" 
                                                type="button" id="searchSubmitBtn" title="Cari"
                                                style="border-top-left-radius: 0 !important; border-bottom-left-radius: 0 !important; border-top-right-radius: 4px !important; border-bottom-right-radius: 4px !important; height: 38px; box-shadow: none;">
                                                <i class="mdi mdi-magnify" style="font-size: 1.15rem; color: #ffffff;"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <!-- Staff Marketing -->
                                    <div style="min-width: 200px; max-width: 280px;">
                                        <select class="form-control select2" id="employeeSelect" style="width: 100%;">
                                            <option value="">Semua Staff Marketing</option>
                                            @foreach ($marketingStaff as $staff)
                                                <option value="{{ $staff->id }}" {{ request('employee_id') == $staff->id ? 'selected' : '' }}>
                                                    {{ $staff->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Kategori -->
                                    <div style="width: 200px;">
                                        <select class="form-control select2" id="kategoriSelect" style="width: 100%;">
                                            <option value="">Semua Kategori</option>
                                            @foreach($kategoriList as $val => $label)
                                                <option value="{{ $val }}" {{ request('kategori') == $val ? 'selected' : '' }}>{{ $label }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Status -->
                                    <div style="width: 150px;">
                                        <select class="form-control select2" id="statusSelect" style="width: 100%;">
                                            <option value="">Semua Status</option>
                                            <option value="Pending" {{ request('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="Proses" {{ request('status') == 'Proses' ? 'selected' : '' }}>Proses</option>
                                            <option value="Selesai" {{ request('status') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                        </select>
                                    </div>

                                </div>

                                <!-- Right Side: Limit Dropdown + Filter & Reset Buttons -->
                                <div class="d-flex align-items-center gap-2 ms-auto">
                                    <div style="width: 90px;">
                                        <select class="form-control select2" id="limitSelect" style="width: 100%;">
                                            <option value="10" {{ request('limit') == 10 ? 'selected' : '' }}>10</option>
                                            <option value="15" {{ request('limit', 15) == 15 ? 'selected' : '' }}>15</option>
                                            <option value="25" {{ request('limit') == 25 ? 'selected' : '' }}>25</option>
                                            <option value="50" {{ request('limit') == 50 ? 'selected' : '' }}>50</option>
                                        </select>
                                    </div>
                                    <button type="button" class="btn btn-gradient-primary btn-icon-only" id="filterBtn" title="Filter">
                                        <i class="mdi mdi-filter"></i>
                                    </button>
                                    <button type="button" class="btn btn-gradient-secondary btn-icon-only" id="refreshBTN" title="Reset">
                                        <i class="mdi mdi-refresh"></i>
                                    </button>
                                </div>

                            </div>
                        </div>

                        <!-- MOBILE VERSION -->
                        <div class="filter-row-mobile d-block d-md-none">
                            <div class="row g-2">
                                <div class="col-12 mb-2">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="searchInputMobile"
                                            placeholder="Cari tugas / deskripsi / staff..." value="{{ request('search') }}"
                                            style="border-top-right-radius: 0 !important; border-bottom-right-radius: 0 !important; border-right: none;">
                                        <button class="btn btn-gradient-primary d-flex align-items-center justify-content-center px-3" 
                                            type="button" id="searchSubmitBtnMobile" title="Cari"
                                            style="border-top-left-radius: 0 !important; border-bottom-left-radius: 0 !important; border-top-right-radius: 4px !important; border-bottom-right-radius: 4px !important; height: 38px; box-shadow: none;">
                                            <i class="mdi mdi-magnify" style="font-size: 1.15rem; color: #ffffff;"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-12 mb-2">
                                    <select class="form-control select2-mobile" id="employeeSelectMobile" style="width: 100%;">
                                        <option value="">Semua Staff Marketing</option>
                                        @foreach ($marketingStaff as $staff)
                                            <option value="{{ $staff->id }}" {{ request('employee_id') == $staff->id ? 'selected' : '' }}>
                                                {{ $staff->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12 mb-2">
                                    <select class="form-control select2-mobile" id="statusSelectMobile" style="width: 100%;">
                                        <option value="">Semua Status</option>
                                        <option value="Pending" {{ request('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="Proses" {{ request('status') == 'Proses' ? 'selected' : '' }}>Proses</option>
                                        <option value="Selesai" {{ request('status') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                    </select>
                                </div>
                                <div class="col-12 mb-2">
                                    <select class="form-control select2-mobile" id="limitSelectMobile" style="width: 100%;">
                                        <option value="10" {{ request('limit') == 10 ? 'selected' : '' }}>10</option>
                                        <option value="15" {{ request('limit', 15) == 15 ? 'selected' : '' }}>15</option>
                                        <option value="25" {{ request('limit') == 25 ? 'selected' : '' }}>25</option>
                                        <option value="50" {{ request('limit') == 50 ? 'selected' : '' }}>50</option>
                                    </select>
                                </div>
                                <div class="col-6">
                                    <button type="button" class="btn btn-gradient-primary btn-icon-only-mobile w-100" id="filterBtnMobile" title="Filter">
                                        <i class="mdi mdi-filter"></i>
                                    </button>
                                </div>
                                <div class="col-6">
                                    <button type="button" class="btn btn-gradient-secondary btn-icon-only-mobile w-100" id="refreshBTNMobile" title="Reset">
                                        <i class="mdi mdi-refresh"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Table Responsive (Deskripsi Dihapus & Inisial Dihapus) -->
                    <div class="table-responsive">
                        <table class="table table-hover align-middle table-marketing">
                            <thead>
                                <tr>
                                    <th class="text-center" width="4%">No</th>
                                    <th width="18%">Nama Staff</th>
                                    <th width="26%">Nama Tugas</th>
                                    <th width="15%">Kategori</th>
                                    <th width="14%">Deadline</th>
                                    <th class="text-center" width="9%">Status</th>
                                    <th class="text-center col-aksi" width="14%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($tugas as $index => $item)
                                    <tr>
                                        <td class="text-center fw-bold text-muted">{{ $tugas->firstItem() + $index }}</td>
                                        <td>
                                            <div class="fw-semibold text-dark" style="font-size: 0.86rem;">
                                                {{ $item->employee->name ?? 'Tidak ada staff' }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <i class="mdi mdi-clipboard-text-outline text-primary me-2" style="font-size: 1.1rem; color: #9a55ff !important;"></i>
                                                <span class="fw-bold text-dark">{{ $item->nama_tugas }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            @php
                                                $katColors = ['sosmed' => '#e0f2fe|#0284c7', 'proyeksi' => '#dcfce7|#16a34a', 'umum' => '#f3e8ff|#7c3aed'];
                                                [$katBg, $katTxt] = explode('|', $katColors[$item->kategori] ?? '#f1f5f9|#64748b');
                                            @endphp
                                            <span style="display:inline-block; background:{{ $katBg }}; color:{{ $katTxt }}; font-size:0.72rem; font-weight:700; padding:3px 8px; border-radius:5px;">
                                                @if($item->kategori === 'sosmed')<i class="mdi mdi-instagram me-0.5"></i>
                                                @elseif($item->kategori === 'proyeksi')<i class="mdi mdi-account-multiple me-0.5"></i>
                                                @else<i class="mdi mdi-briefcase-outline me-0.5"></i>
                                                @endif
                                                {{ $item->kategoriLabel }}
                                            </span>
                                        </td>
                                        <td>
                                            <div style="font-size: 0.84rem; color: #334155;">
                                                <i class="mdi mdi-calendar-clock me-1" style="color: #9a55ff;"></i>
                                                {{ \Carbon\Carbon::parse($item->deadline)->format('d M Y') }}
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            @php
                                                $statusClass = strtolower($item->status);
                                            @endphp
                                            <span class="badge-status {{ $statusClass }}">
                                                @if($item->status == 'Pending')
                                                    <i class="mdi mdi-clock-outline"></i>
                                                @elseif($item->status == 'Proses')
                                                    <i class="mdi mdi-progress-wrench"></i>
                                                @elseif($item->status == 'Selesai')
                                                    <i class="mdi mdi-check-circle-outline"></i>
                                                @endif
                                                {{ $item->status }}
                                            </span>
                                        </td>
                                        <td class="text-center col-aksi">
                                            <div class="d-inline-flex align-items-center gap-1">
                                                <a href="{{ route('marketing.tugas.progress', $item->id) }}" class="btn btn-action-edit shadow-none" title="Update Progres">
                                                    <i class="mdi mdi-chart-timeline-variant text-info"></i>
                                                    <span>Progres</span>
                                                </a>
                                                <a href="{{ route('marketing.tugas.edit', $item->id) }}" class="btn btn-action-edit shadow-none" title="Edit Tugas">
                                                    <i class="mdi mdi-pencil text-primary"></i>
                                                    <span>Edit</span>
                                                </a>
                                                <form action="{{ route('marketing.tugas.destroy', $item->id) }}" method="POST" class="d-inline" id="deleteForm{{ $item->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-action-edit shadow-none text-danger" title="Hapus Tugas" onclick="confirmDeleteTask('{{ $item->id }}', '{{ addslashes($item->nama_tugas) }}')">
                                                        <i class="mdi mdi-delete text-danger"></i>
                                                        <span>Hapus</span>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center text-muted py-5">
                                            <i class="mdi mdi-clipboard-text-off-outline" style="font-size: 3rem; color: #5046e5; opacity: 0.3;"></i>
                                            <p class="mt-2 mb-0 fw-bold">Belum ada data tugas untuk staff marketing.</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mt-4">
                        <div class="pagination-info mb-2 mb-sm-0 text-muted small">
                            Menampilkan {{ $tugas->firstItem() ?? 0 }} - {{ $tugas->lastItem() ?? 0 }} dari {{ $tugas->total() }} tugas
                        </div>
                        <nav aria-label="Page navigation">
                            {{ $tugas->links('pagination::bootstrap-4') }}
                        </nav>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>

@endsection

@push('scripts')
<script>
// Filter Function - Mirroring Dashboard
function executeFilter(isMobile = false) {
    const search = isMobile 
        ? document.getElementById('searchInputMobile').value 
        : document.getElementById('searchInput').value;
    
    const employeeId = isMobile 
        ? document.getElementById('employeeSelectMobile').value 
        : document.getElementById('employeeSelect').value;

    const kategori = isMobile
        ? (document.getElementById('kategoriSelectMobile') ? document.getElementById('kategoriSelectMobile').value : '')
        : (document.getElementById('kategoriSelect') ? document.getElementById('kategoriSelect').value : '');
    
    const status = isMobile 
        ? document.getElementById('statusSelectMobile').value 
        : document.getElementById('statusSelect').value;
    
    const limit = isMobile 
        ? document.getElementById('limitSelectMobile').value 
        : document.getElementById('limitSelect').value;

    let url = new URL(window.location.origin + window.location.pathname);
    
    if (search.trim()) url.searchParams.set('search', search.trim());
    if (employeeId) url.searchParams.set('employee_id', employeeId);
    if (kategori) url.searchParams.set('kategori', kategori);
    if (status) url.searchParams.set('status', status);
    if (limit) url.searchParams.set('limit', limit);

    window.location.href = url.toString();
}

function resetAllFilters() {
    window.location.href = "{{ route('master.data.tugas-staff-marketing') }}";
}

$(document).ready(function() {
    // Init Select2 Filters (All Without Search Input)
    $('#employeeSelect, #employeeSelectMobile, #kategoriSelect, #statusSelect, #limitSelect, #statusSelectMobile, #limitSelectMobile').select2({
        theme: 'bootstrap-5',
        minimumResultsForSearch: Infinity,
        width: '100%'
    });
});

document.addEventListener('DOMContentLoaded', function() {
    // Desktop Buttons
    const filterBtn = document.getElementById('filterBtn');
    const refreshBTN = document.getElementById('refreshBTN');
    const searchSubmitBtn = document.getElementById('searchSubmitBtn');
    const searchInput = document.getElementById('searchInput');

    if (filterBtn) filterBtn.addEventListener('click', () => executeFilter(false));
    if (searchSubmitBtn) searchSubmitBtn.addEventListener('click', () => executeFilter(false));
    if (refreshBTN) refreshBTN.addEventListener('click', resetAllFilters);
    if (searchInput) {
        searchInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') executeFilter(false);
        });
    }

    // Mobile Buttons
    const filterBtnMobile = document.getElementById('filterBtnMobile');
    const refreshBTNMobile = document.getElementById('refreshBTNMobile');
    const searchSubmitBtnMobile = document.getElementById('searchSubmitBtnMobile');
    const searchInputMobile = document.getElementById('searchInputMobile');

    if (filterBtnMobile) filterBtnMobile.addEventListener('click', () => executeFilter(true));
    if (searchSubmitBtnMobile) searchSubmitBtnMobile.addEventListener('click', () => executeFilter(true));
    if (refreshBTNMobile) refreshBTNMobile.addEventListener('click', resetAllFilters);
    if (searchInputMobile) {
        searchInputMobile.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') executeFilter(true);
        });
    }
});

function confirmDeleteTask(id, taskName) {
    Swal.fire({
        title: 'Yakin ingin menghapus?',
        html: `Tugas <b>${taskName}</b> akan dihapus secara permanen!`,
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
                html: 'Mohon tunggu sebentar',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
            document.getElementById('deleteForm' + id).submit();
        }
    });
}

@if (session('success'))
    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: "{{ session('success') }}",
        timer: 3000,
        timerProgressBar: true,
        confirmButtonText: 'OK',
        confirmButtonColor: '#5046e5'
    });
@endif

@if (session('error'))
    Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: "{{ session('error') }}",
        confirmButtonColor: '#5046e5',
        confirmButtonText: 'OK'
    });
@endif
</script>
@endpush
