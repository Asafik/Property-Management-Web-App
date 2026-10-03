@extends('layouts.partial.app')

@section('title', 'Data Tamu / Proyeksi')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard-clean.css') }}?v={{ time() }}">
@endpush

@section('content')

    <style>
        /* Card Compact Persis Catalog Unit */
        .compact-table-card {
            background: #ffffff !important;
            border: 1px solid #e2e8f0 !important;
            border-radius: 8px !important;
            box-shadow: none !important;
            transition: border-color 0.2s ease;
            overflow: hidden;
        }
        .compact-table-card:hover {
            border-color: #cbd5e1 !important;
            box-shadow: none !important;
        }

        .filter-card {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 0.75rem 1rem;
            margin-bottom: 1rem;
        }

        .filter-card .form-control,
        .filter-card .form-select {
            padding: 0.5rem 0.75rem;
            font-size: 0.85rem;
            border-radius: 6px;
            height: 38px;
            border: 1px solid #e2e8f0;
            background-color: #ffffff;
            color: #1e293b;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #7c3aed;
            box-shadow: 0 0 0 3px rgba(124, 58, 237, 0.15);
            outline: none;
        }

        /* Solid Buttons - 1 Warna, Tanpa Gradient */
        .btn-gradient-primary {
            background: #7c3aed !important;
            border-color: #7c3aed !important;
            color: #ffffff !important;
            border-radius: 6px;
        }
        .btn-gradient-primary:hover {
            background: #6d28d9 !important;
            border-color: #6d28d9 !important;
            color: #ffffff !important;
        }

        .btn-gradient-success {
            background: #10b981 !important;
            border-color: #10b981 !important;
            color: #ffffff !important;
            border-radius: 6px;
        }
        .btn-gradient-success:hover {
            background: #059669 !important;
            border-color: #059669 !important;
            color: #ffffff !important;
        }

        .btn-gradient-danger {
            background: #ef4444 !important;
            border-color: #ef4444 !important;
            color: #ffffff !important;
            border-radius: 6px;
        }
        .btn-gradient-danger:hover {
            background: #dc2626 !important;
            border-color: #dc2626 !important;
            color: #ffffff !important;
        }

        .btn-gradient-secondary {
            background: #64748b !important;
            border-color: #64748b !important;
            color: #ffffff !important;
            border-radius: 6px;
        }
        .btn-gradient-secondary:hover {
            background: #475569 !important;
            border-color: #475569 !important;
            color: #ffffff !important;
        }

        .btn-gradient-info {
            background: #0284c7 !important;
            border-color: #0284c7 !important;
            color: #ffffff !important;
            border-radius: 6px;
        }
        .btn-gradient-info:hover {
            background: #0369a1 !important;
            border-color: #0369a1 !important;
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
        }

        .table thead th {
            background: #f8fafc !important;
            color: #475569 !important;
            font-weight: 700;
            font-size: 0.78rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 1px solid #e2e8f0;
            padding: 0.85rem 0.85rem;
            white-space: nowrap;
            vertical-align: middle;
        }

        .table thead th.sortable:hover {
            color: #7c3aed !important;
        }

        .table tbody td {
            vertical-align: middle;
            font-size: 0.88rem;
            padding: 0.85rem 0.85rem;
            border-bottom: 1px solid #f1f5f9;
            color: #334155;
        }

        .table-responsive {
            border-radius: 8px;
        }

        .name-avatar {
            width: 36px;
            height: 36px;
            min-width: 36px;
            border-radius: 50%;
            background: linear-gradient(135deg, #da8cff, #9a55ff);
            color: #fff;
            font-size: 0.82rem;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 3px 8px rgba(154, 85, 255, 0.25);
        }

        .name-wrap {
            display: flex;
            align-items: center;
            gap: 0.65rem;
        }

        .customer-initial {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: #fff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 0.78rem;
            font-weight: 700;
            flex-shrink: 0;
        }

        .info-icon {
            color: #9a55ff;
            font-size: 0.95rem;
            margin-right: 0.3rem;
            vertical-align: middle;
        }

        .badge-status {
            padding: 0.3rem 0.65rem;
            border-radius: 4px;
            font-weight: 600;
            font-size: 0.76rem;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .badge-unit {
            padding: 0.28rem 0.65rem;
            border-radius: 4px;
            font-size: 0.72rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .badge-unit.subsidi {
            background: linear-gradient(135deg, #10b981, #059669);
            color: #ffffff;
        }

        .badge-unit.komersil {
            background: linear-gradient(135deg, #6366f1, #4f46e5);
            color: #ffffff;
        }

        .badge-unit.default {
            background: linear-gradient(135deg, #64748b, #475569);
            color: #ffffff;
        }

        .badge-status.new {
            background: #e0f2fe;
            color: #0284c7;
            border: 1px solid #bae6fd;
        }

        .badge-status.follow_up {
            background: #fef3c7;
            color: #b45309;
            border: 1px solid #fde68a;
        }

        .badge-status.negotiation {
            background: #f3e8ff;
            color: #7e22ce;
            border: 1px solid #e9d5ff;
        }

        .badge-status.converted {
            background: #dcfce7;
            color: #15803d;
            border: 1px solid #bbf7d0;
        }

        .badge-status.lost {
            background: #f1f5f9;
            color: #64748b;
            border: 1px solid #e2e8f0;
        }

        .badge-status.hot_prospect {
            background: #fee2e2;
            color: #b91c1c;
            border: 1px solid #fecaca;
        }

        .badge-status.medium_prospect {
            background: #fef3c7;
            color: #b45309;
            border: 1px solid #fde68a;
        }

        .badge-status.cold_prospect {
            background: #e0f2fe;
            color: #0284c7;
            border: 1px solid #bae6fd;
        }

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
            color: #ffffff !important;
        }

        .btn-action:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
        }

        .btn-action.detail {
            background: linear-gradient(135deg, #8b5cf6, #7c3aed);
        }

        .btn-action.info {
            background: linear-gradient(135deg, #06b6d4, #0ea5e9);
        }

        .btn-action.success {
            background: linear-gradient(135deg, #10b981, #059669);
        }

        .btn-action.edit {
            background: linear-gradient(135deg, #6366f1, #4f46e5);
        }

        .btn-action.delete {
            background: linear-gradient(135deg, #ef4444, #dc2626);
        }

        .header-action-group {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
        }

        .modal-content {
            border: none;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
        }

        @media (min-width: 576px) {
            .modal-dialog-medium {
                max-width: 680px !important;
                margin-left: auto;
                margin-right: auto;
            }
        }

        .modal-header {
            background: linear-gradient(135deg, #da8cff, #9a55ff) !important;
            color: white !important;
            padding: 1.1rem 1.5rem;
            border-bottom: none;
        }

        .modal-header .btn-close {
            filter: brightness(0) invert(1);
        }

        .modal-title {
            font-weight: 700;
            font-size: 1.1rem;
            color: #ffffff !important;
        }

        .modal-body {
            padding: 1.5rem;
            background: #ffffff;
        }

        .modal-body .form-label {
            font-size: 0.82rem;
            font-weight: 700;
            color: #3b3f5c !important;
            margin-bottom: 0.35rem;
            letter-spacing: 0.3px;
        }

        .modal-body .form-control,
        .modal-body .form-select,
        .modal-body select.form-control {
            border: 1.5px solid #e2e8f0;
            border-radius: 8px !important;
            padding: 0.6rem 0.85rem;
            font-size: 0.88rem;
            color: #2c2e3f;
            background-color: #ffffff;
            height: auto;
            min-height: 40px;
            transition: all 0.2s ease;
        }

        .modal-body .form-control:focus,
        .modal-body .form-select:focus,
        .modal-body select.form-control:focus {
            border-color: #9a55ff !important;
            box-shadow: 0 0 0 3px rgba(154, 85, 255, 0.15) !important;
            outline: none;
        }

        .modal-footer {
            background: #fafbfe;
            border-top: 1px solid #edf2f9;
            padding: 1rem 1.5rem;
        }

        /* SELECT2 CUSTOM STYLING (BOOTSTRAP 5) */
        .select2-container--bootstrap-5 .select2-selection {
            border: 1.5px solid #e2e8f0 !important;
            border-radius: 8px !important;
            padding: 0.4rem 0.85rem !important;
            min-height: 40px !important;
            height: 40px !important;
            font-family: inherit !important;
            background-color: #ffffff !important;
            display: flex !important;
            align-items: center !important;
            transition: all 0.2s ease;
        }

        .select2-container--bootstrap-5 .select2-selection--single .select2-selection__rendered {
            color: #2c2e3f !important;
            font-size: 0.88rem !important;
            line-height: 24px !important;
            padding-left: 0 !important;
            font-weight: 500;
        }

        .select2-container--bootstrap-5 .select2-selection--single .select2-selection__placeholder {
            color: #6c757d !important;
            font-size: 0.88rem !important;
        }

        .select2-container--bootstrap-5 .select2-selection--single .select2-selection__arrow {
            height: 38px !important;
            right: 8px !important;
        }

        .select2-container--bootstrap-5 .select2-selection:hover,
        .select2-container--bootstrap-5.select2-container--focus .select2-selection,
        .select2-container--bootstrap-5.select2-container--open .select2-selection {
            border-color: #9a55ff !important;
            box-shadow: 0 0 0 3px rgba(154, 85, 255, 0.15) !important;
        }

        .select2-container--bootstrap-5 .select2-dropdown {
            border-color: #e2e8f0 !important;
            border-radius: 8px !important;
            overflow: hidden !important;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1) !important;
            z-index: 1060 !important;
        }

        .select2-container--bootstrap-5 .select2-search--dropdown {
            padding: 0.5rem !important;
        }

        .select2-container--bootstrap-5 .select2-search--dropdown .select2-search__field {
            border: 1px solid #e2e8f0 !important;
            border-radius: 6px !important;
            padding: 0.45rem 0.75rem !important;
            font-size: 0.85rem !important;
        }

        .select2-container--bootstrap-5 .select2-search--dropdown .select2-search__field:focus {
            border-color: #9a55ff !important;
            box-shadow: 0 0 0 2px rgba(154, 85, 255, 0.15) !important;
            outline: none !important;
        }

        .select2-container--bootstrap-5 .select2-results__option {
            padding: 0.55rem 0.85rem !important;
            font-size: 0.86rem !important;
            font-weight: 500 !important;
        }

        .select2-container--bootstrap-5 .select2-results__option--selected {
            background-color: #f3e8ff !important;
            color: #7e22ce !important;
        }

        .select2-container--bootstrap-5 .select2-results__option--highlighted {
            background: linear-gradient(135deg, #da8cff, #9a55ff) !important;
            color: #ffffff !important;
        }
    </style>

    <div class="container-fluid p-2 p-sm-3 p-md-4">

        <!-- Header Title (Persis Catalog Unit & Data User) -->
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">
            <div>
                <h2 class="text-dark mb-1 fw-bold" style="font-size: 1.55rem; letter-spacing: -0.02em;">
                    Data Tamu / Proyeksi
                </h2>
                <p class="text-muted mb-0" style="font-size: 0.88rem;">
                    Kelola data pengunjung dan calon pembeli unit properti
                </p>
            </div>
        </div>

        @if ($activeTask)
            <!-- Card Pemberitahuan Tugas Proyeksi Aktif -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card shadow-sm border-0" style="background: linear-gradient(135deg, #faf5ff 0%, #ffffff 100%); border: 1.5px solid #d8b4fe !important; border-radius: 12px;">
                        <div class="card-body p-3 p-md-4">
                            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                                <div class="d-flex align-items-center gap-3">
                                    <div style="width: 46px; height: 46px; border-radius: 10px; background-color: #7c3aed; color: #ffffff; display: flex; align-items: center; justify-content: center; font-size: 1.4rem; flex-shrink: 0;">
                                        <i class="mdi mdi-bullseye-arrow"></i>
                                    </div>
                                    <div>
                                        <div class="d-flex align-items-center gap-2 mb-1">
                                            <span class="badge" style="background: #ede9fe; color: #6d28d9; font-weight: 700; font-size: 0.74rem;">
                                                TUGAS PROYEKSI AKTIF
                                            </span>
                                        </div>
                                        <h5 class="fw-bold text-dark mb-1" style="font-size: 1.05rem;">
                                            {{ $activeTask->nama_tugas }}
                                        </h5>
                                        <p class="text-muted mb-0" style="font-size: 0.82rem;">
                                            Tenggat: <b>{{ \Carbon\Carbon::parse($activeTask->deadline)->format('d M Y') }}</b>
                                            @if($activeTask->deskripsi)
                                                &bull; <span class="d-none d-md-inline">{{ Str::limit($activeTask->deskripsi, 75) }}</span>
                                            @endif
                                        </p>
                                    </div>
                                </div>

                                <div class="d-flex flex-column align-items-md-end gap-2 ms-auto" style="min-width: 240px;">
                                    <div class="d-flex align-items-center justify-content-between w-100 gap-3">
                                        <span class="text-muted" style="font-size: 0.82rem; font-weight: 600;">Capaian Target:</span>
                                        <span class="fw-bold" style="color: #7c3aed; font-size: 0.95rem;">
                                            {{ $activeTask->realisasi_aktual }} / {{ $activeTask->target_jumlah }} {{ $activeTask->satuan_target ?: 'Calon Pembeli' }}
                                            ({{ $activeTask->persentase_capaian }}%)
                                        </span>
                                    </div>
                                    @php
                                        $barW = $activeTask->persentase_capaian;
                                        $barBg = $barW >= 100 ? '#10b981' : '#7c3aed';
                                    @endphp
                                    <div class="progress w-100" style="height: 7px; background: #e9d5ff; border-radius: 4px;">
                                        <div class="progress-bar" style="width: {{ $barW }}%; background-color: {{ $barBg }}; border-radius: 4px;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- 4 KPI Metrics Card Grid (Persis Catalog Unit & Data User) -->
        <div class="dash-kpi-grid mb-4">
            <!-- Card 1: Total Tamu (Ungu) -->
            <div class="dash-kpi-card">
                <div class="dash-kpi-left">
                    <div class="dash-kpi-icon purple">
                        <i class="mdi mdi-account-group"></i>
                    </div>
                    <div class="dash-kpi-info">
                        <div class="dash-kpi-label">Total Tamu / Proyeksi</div>
                        <div class="dash-kpi-val">{{ $totalGuests ?? 0 }}</div>
                        <div class="dash-kpi-sub">Semua Tamu & Prospek</div>
                    </div>
                </div>
            </div>

            <!-- Card 2: Proyeksi Aktif (Amber) -->
            <div class="dash-kpi-card">
                <div class="dash-kpi-left">
                    <div class="dash-kpi-icon amber">
                        <i class="mdi mdi-fire"></i>
                    </div>
                    <div class="dash-kpi-info">
                        <div class="dash-kpi-label">Total Proyeksi Aktif</div>
                        <div class="dash-kpi-val">{{ $totalProspek ?? 0 }}</div>
                        <div class="dash-kpi-sub">Hot, Medium & Cold Prospek</div>
                    </div>
                </div>
            </div>

            <!-- Card 3: Follow Up Hari Ini (Biru) -->
            <div class="dash-kpi-card">
                <div class="dash-kpi-left">
                    <div class="dash-kpi-icon blue">
                        <i class="mdi mdi-phone-check"></i>
                    </div>
                    <div class="dash-kpi-info">
                        <div class="dash-kpi-label">Follow Up Hari Ini</div>
                        <div class="dash-kpi-val">{{ $totalFollowUp ?? 0 }}</div>
                        <div class="dash-kpi-sub">Jadwal Follow Up Tamu</div>
                    </div>
                </div>
            </div>

            <!-- Card 4: Converted / Deal (Hijau) -->
            <div class="dash-kpi-card">
                <div class="dash-kpi-left">
                    <div class="dash-kpi-icon green">
                        <i class="mdi mdi-handshake"></i>
                    </div>
                    <div class="dash-kpi-info">
                        <div class="dash-kpi-label">Converted / Deal</div>
                        <div class="dash-kpi-val">{{ $totalConverted ?? ($guests->where('status', 'converted')->count() ?? 0) }}</div>
                        <div class="dash-kpi-sub">Telah Jadi Pembeli Unit</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabel Data (Card Compact Meniru Persis Catalog Unit) -->
        <div class="row">
            <div class="col-12">
                <div class="card compact-table-card">
                    <div class="card-header bg-white d-flex flex-column flex-lg-row justify-content-between align-items-start align-items-lg-center py-2.5 px-3 px-md-4 gap-2" style="border-bottom: 1px solid #e2e8f0 !important;">
                        <div class="d-flex align-items-center gap-2">
                            <div style="width: 32px; height: 32px; border-radius: 6px; background-color: #f3e8ff; color: #9333ea; display: inline-flex; align-items: center; justify-content: center; font-size: 1.15rem; flex-shrink: 0;">
                                <i class="mdi mdi-format-list-bulleted"></i>
                            </div>
                            <span style="font-size: 0.95rem; font-weight: 700; color: #0f172a;">Daftar Tamu / Prospek</span>
                        </div>
                        <div class="d-flex flex-wrap align-items-center gap-2">
                            <button class="btn btn-sm d-inline-flex align-items-center gap-1 px-3 text-white fw-semibold" style="height: 32px; border-radius: 6px; background-color: #10b981; border: 1px solid #10b981;" onclick="$('#modalImportTamu').modal('show')">
                                <i class="mdi mdi-file-excel"></i>
                                <span>Import</span>
                            </button>
                            <button class="btn btn-sm d-inline-flex align-items-center gap-1 px-3 text-white fw-semibold" style="height: 32px; border-radius: 6px; background-color: #ef4444; border: 1px solid #ef4444;" onclick="$('#modalExportTamu').modal('show')">
                                <i class="mdi mdi-file-pdf"></i>
                                <span>Export</span>
                            </button>
                            <a href="{{ route('customer.tamu.create') }}" class="btn btn-sm d-inline-flex align-items-center gap-1 px-3 text-white fw-semibold" style="height: 32px; border-radius: 6px; background-color: #7c3aed; border: 1px solid #7c3aed; text-decoration: none;">
                                <i class="mdi mdi-plus"></i>
                                <span>Tambah Proyeksi</span>
                            </a>
                        </div>
                    </div>

                    <div class="card-body p-3 p-md-4">
                        <!-- FILTER SECTION -->
                        <div class="filter-card mb-3">
                            <!-- DESKTOP & TABLET -->
                            <div class="d-none d-md-block">
                                <form method="GET" action="{{ route('customer.tamu') }}" id="filterFormDesktop">
                                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 w-100">
                                        <div class="d-flex flex-wrap align-items-center gap-2 flex-grow-1">
                                            <!-- Search -->
                                            <div style="min-width: 200px; max-width: 260px; flex: 1;">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" name="search" id="searchInput"
                                                        placeholder="Nama tamu / prospek..." value="{{ request('search') }}"
                                                        style="border-top-right-radius: 0 !important; border-bottom-right-radius: 0 !important; border-right: none;">
                                                    <button class="btn btn-gradient-primary d-flex align-items-center justify-content-center px-3"
                                                        type="submit" title="Cari"
                                                        style="border-top-left-radius: 0 !important; border-bottom-left-radius: 0 !important; border-top-right-radius: 8px !important; border-bottom-right-radius: 8px !important; height: 38px; box-shadow: none;">
                                                        <i class="mdi mdi-magnify" style="font-size: 1.15rem; color: #ffffff;"></i>
                                                    </button>
                                                </div>
                                            </div>

                                            <!-- Agent -->
                                            <div style="min-width: 170px;">
                                                <select class="form-control" name="agent" id="agentSelect" onchange="this.form.submit()">
                                                    <option value="">Semua Agent</option>
                                                    @foreach ($agents as $agent)
                                                        <option value="{{ $agent->id }}" {{ request('agent') == $agent->id ? 'selected' : '' }}>
                                                            {{ $agent->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <!-- Status -->
                                            <div style="min-width: 160px;">
                                                <select class="form-control" name="status" id="statusSelect" onchange="this.form.submit()">
                                                    <option value="">Semua Status</option>
                                                    <option value="new" {{ request('status') == 'new' ? 'selected' : '' }}>Baru</option>
                                                    <option value="follow_up" {{ request('status') == 'follow_up' ? 'selected' : '' }}>Sudah Dihubungi</option>
                                                    <option value="negotiation" {{ request('status') == 'negotiation' ? 'selected' : '' }}>Negosiasi</option>
                                                    <option value="converted" {{ request('status') == 'converted' ? 'selected' : '' }}>Dikonversi / Deal</option>
                                                    <option value="lost" {{ request('status') == 'lost' ? 'selected' : '' }}>Gagal / Batal</option>
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Right side: Limit + Reset -->
                                        <div class="d-flex align-items-center gap-2 ms-auto">
                                            <div style="width: 85px;">
                                                <select class="form-control" name="per_page" onchange="this.form.submit()">
                                                    <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10</option>
                                                    <option value="25" {{ request('per_page', 25) == 25 ? 'selected' : '' }}>25</option>
                                                    <option value="50" {{ request('per_page', 50) == 50 ? 'selected' : '' }}>50</option>
                                                    <option value="100" {{ request('per_page', 100) == 100 ? 'selected' : '' }}>100</option>
                                                </select>
                                            </div>
                                            <button type="submit" class="btn btn-gradient-primary btn-icon-only" title="Filter">
                                                <i class="mdi mdi-filter"></i>
                                            </button>
                                            <a href="{{ route('customer.tamu') }}" class="btn btn-gradient-secondary btn-icon-only" title="Reset">
                                                <i class="mdi mdi-refresh"></i>
                                            </a>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <!-- MOBILE VERSION -->
                            <div class="d-block d-md-none">
                                <form method="GET" action="{{ route('customer.tamu') }}" id="filterFormMobile">
                                    <div class="row g-2">
                                        <div class="col-12 mb-2">
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="search"
                                                    placeholder="Nama tamu / prospek..." value="{{ request('search') }}"
                                                    style="border-top-right-radius: 0 !important; border-bottom-right-radius: 0 !important; border-right: none;">
                                                <button class="btn btn-gradient-primary d-flex align-items-center justify-content-center px-3"
                                                    type="submit" title="Cari"
                                                    style="border-top-left-radius: 0 !important; border-bottom-left-radius: 0 !important; border-top-right-radius: 8px !important; border-bottom-right-radius: 8px !important; height: 38px; box-shadow: none;">
                                                    <i class="mdi mdi-magnify" style="font-size: 1.15rem; color: #ffffff;"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="col-12 mb-2">
                                            <select class="form-control" name="agent">
                                                <option value="">Semua Agent</option>
                                                @foreach ($agents as $agent)
                                                    <option value="{{ $agent->id }}" {{ request('agent') == $agent->id ? 'selected' : '' }}>
                                                        {{ $agent->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-12 mb-2">
                                            <select class="form-control" name="status">
                                                <option value="">Semua Status</option>
                                                <option value="new" {{ request('status') == 'new' ? 'selected' : '' }}>Baru</option>
                                                <option value="follow_up" {{ request('status') == 'follow_up' ? 'selected' : '' }}>Sudah Dihubungi</option>
                                                <option value="negotiation" {{ request('status') == 'negotiation' ? 'selected' : '' }}>Negosiasi</option>
                                                <option value="converted" {{ request('status') == 'converted' ? 'selected' : '' }}>Dikonversi / Deal</option>
                                                <option value="lost" {{ request('status') == 'lost' ? 'selected' : '' }}>Gagal / Batal</option>
                                            </select>
                                        </div>
                                        <div class="col-12 mb-2">
                                            <select class="form-control" name="per_page">
                                                <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10</option>
                                                <option value="25" {{ request('per_page', 25) == 25 ? 'selected' : '' }}>25</option>
                                                <option value="50" {{ request('per_page', 50) == 50 ? 'selected' : '' }}>50</option>
                                                <option value="100" {{ request('per_page', 100) == 100 ? 'selected' : '' }}>100</option>
                                            </select>
                                        </div>
                                        <div class="col-6">
                                            <button type="submit" class="btn btn-gradient-primary w-100">
                                                <i class="mdi mdi-filter me-1"></i> Filter
                                            </button>
                                        </div>
                                        <div class="col-6">
                                            <a href="{{ route('customer.tamu') }}" class="btn btn-gradient-secondary w-100 text-center">
                                                <i class="mdi mdi-refresh me-1"></i> Reset
                                            </a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead>
                                    <tr>
                                        <th class="text-center" width="4%">No</th>
                                        <th class="sortable" width="20%" data-field="name"
                                            data-direction="{{ request('sortField') == 'name' ? (request('sortDirection') == 'asc' ? 'desc' : 'asc') : 'asc' }}">
                                            Nama Calon Pembeli
                                            @if (request('sortField') == 'name')
                                                <i class="mdi mdi-{{ request('sortDirection') == 'asc' ? 'arrow-up' : 'arrow-down' }}"></i>
                                            @else
                                                <i class="mdi mdi-swap-vertical"></i>
                                            @endif
                                        </th>
                                        <th width="16%">Proyek</th>
                                        <th width="15%">Unit Minat</th>
                                        <th width="15%">Jenis & Tipe</th>
                                        <th class="sortable" width="12%" data-field="assigned_to"
                                            data-direction="{{ request('sortField') == 'assigned_to' ? (request('sortDirection') == 'asc' ? 'desc' : 'asc') : 'asc' }}">
                                            Agent
                                            @if (request('sortField') == 'assigned_to')
                                                <i class="mdi mdi-{{ request('sortDirection') == 'asc' ? 'arrow-up' : 'arrow-down' }}"></i>
                                            @else
                                                <i class="mdi mdi-swap-vertical"></i>
                                            @endif
                                        </th>
                                        <th class="sortable" width="10%" data-field="status"
                                            data-direction="{{ request('sortField') == 'status' ? (request('sortDirection') == 'asc' ? 'desc' : 'asc') : 'asc' }}">
                                            Status
                                            @if (request('sortField') == 'status')
                                                <i class="mdi mdi-{{ request('sortDirection') == 'asc' ? 'arrow-up' : 'arrow-down' }}"></i>
                                            @else
                                                <i class="mdi mdi-swap-vertical"></i>
                                            @endif
                                        </th>
                                        <th class="text-center" width="8%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($guests as $index => $guest)
                                        <tr>
                                            <td class="text-center fw-bold">{{ $index + 1 }}</td>
                                            <td>
                                                <span class="fw-bold text-dark" style="font-size: 0.92rem;">{{ $guest->name }}</span>
                                            </td>
                                            <td>
                                                <span class="icon-text">
                                                    <i class="mdi mdi-office-building info-icon"></i>
                                                    <span class="fw-semibold text-dark">{{ $guest->project->name ?? '-' }}</span>
                                                </span>
                                            </td>
                                            <td>
                                                @if ($guest->unit)
                                                    <span class="icon-text">
                                                        <i class="mdi mdi-home-outline info-icon"></i>
                                                        <span class="fw-semibold text-dark">{{ $guest->unit->unit_name ?? $guest->unit->unit_code }}</span>
                                                    </span>
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($guest->unit && ($guest->unit->jenis || $guest->unit->type))
                                                    @php
                                                        $unitJenis = strtolower($guest->unit->jenis ?? '');
                                                        $badgeClass = match($unitJenis) {
                                                            'subsidi' => 'subsidi',
                                                            'komersil' => 'komersil',
                                                            default => 'default'
                                                        };
                                                        $iconClass = match($unitJenis) {
                                                            'subsidi' => 'mdi-home-assistant',
                                                            'komersil' => 'mdi-office-building',
                                                            default => 'mdi-tag-outline'
                                                        };
                                                    @endphp
                                                    <span class="badge-unit {{ $badgeClass }}">
                                                        <i class="mdi {{ $iconClass }} me-1"></i>{{ ($guest->unit->jenis ?? '') . ($guest->unit->type ? '/' . $guest->unit->type : '') }}
                                                    </span>
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($guest->employee)
                                                    <span class="fw-semibold text-dark">{{ $guest->employee->name }}</span>
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>
                                            <td>
                                                <span class="badge-status {{ $guest->status }}">
                                                    @if ($guest->status == 'hot_prospect')
                                                        Hot Prospek
                                                    @elseif ($guest->status == 'medium_prospect')
                                                        Medium Prospek
                                                    @elseif ($guest->status == 'cold_prospect')
                                                        Cold Prospek
                                                    @elseif ($guest->status == 'converted')
                                                        Dikonversi / Deal
                                                    @elseif ($guest->status == 'lost')
                                                        Gagal / Batal
                                                    @else
                                                        {{ ucfirst(str_replace('_', ' ', $guest->status)) }}
                                                    @endif
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                <div class="d-flex justify-content-center gap-1">
                                                    <!-- Tombol Detail Halaman Sendiri -->
                                                    <a href="{{ route('customer.tamu.show', $guest->id) }}" class="btn-action detail" title="Lihat Detail Lengkap" style="text-decoration: none;">
                                                        <i class="mdi mdi-eye"></i>
                                                    </a>

                                                    <button class="btn-action info" title="Follow Up"
                                                        onclick="openFollowUpModal({{ $guest->id }}, '{{ addslashes($guest->name) }}')">
                                                        <i class="mdi mdi-phone-log"></i>
                                                    </button>

                                                    @if($guest->status !== 'converted')
                                                        <form action="{{ route('costomer.guests.convert', $guest->id) }}"
                                                            method="POST" style="display:inline;"
                                                            id="convertForm{{ $guest->id }}">
                                                            @csrf
                                                            <button type="button" class="btn-action success"
                                                                title="Konversi ke Customer"
                                                                onclick="confirmConvert({{ $guest->id }}, '{{ addslashes($guest->name) }}')">
                                                                <i class="mdi mdi-account-convert"></i>
                                                            </button>
                                                        </form>
                                                    @endif

                                                    <a href="{{ route('customer.tamu.edit', $guest->id) }}" class="btn-action edit" title="Edit" style="text-decoration: none;">
                                                        <i class="mdi mdi-pencil"></i>
                                                    </a>

                                                    <form action="/customer/guest/{{ $guest->id }}" method="POST"
                                                        id="deleteForm{{ $guest->id }}" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn-action delete" title="Hapus"
                                                            onclick="confirmDelete({{ $guest->id }})">
                                                            <i class="mdi mdi-delete"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center text-muted py-4">
                                                <i class="mdi mdi-account-off" style="font-size: 2rem; opacity: 0.3;"></i>
                                                <p class="mt-2 mb-0">Tidak ada data tamu / prospek</p>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        @if ($guests instanceof \Illuminate\Pagination\LengthAwarePaginator && $guests->total() > 0)
                            <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mt-4">
                                <div class="pagination-info mb-2 mb-sm-0">
                                    Menampilkan {{ $guests->firstItem() }} - {{ $guests->lastItem() }} dari
                                    {{ $guests->total() }} data
                                </div>
                                <nav aria-label="Page navigation">
                                    <ul class="pagination pagination-sm flex-wrap justify-content-center mb-0">
                                        {{-- Previous Page Link --}}
                                        @if ($guests->onFirstPage())
                                            <li class="page-item disabled" aria-disabled="true">
                                                <span class="page-link" aria-label="Previous">
                                                    <i class="mdi mdi-chevron-left"></i>
                                                </span>
                                            </li>
                                        @else
                                            <li class="page-item">
                                                <a class="page-link"
                                                    href="{{ $guests->appends(request()->query())->previousPageUrl() }}"
                                                    rel="prev" aria-label="Previous"
                                                    onclick="showPaginationLoading(event)">
                                                    <i class="mdi mdi-chevron-left"></i>
                                                </a>
                                            </li>
                                        @endif

                                        {{-- Pagination Elements --}}
                                        @foreach ($guests->getUrlRange(max(1, $guests->currentPage() - 2), min($guests->lastPage(), $guests->currentPage() + 2)) as $page => $url)
                                            @if ($page == $guests->currentPage())
                                                <li class="page-item active" aria-current="page">
                                                    <span class="page-link">{{ $page }}</span>
                                                </li>
                                            @else
                                                <li class="page-item">
                                                    <a class="page-link"
                                                        href="{{ $guests->appends(request()->query())->url($page) }}"
                                                        onclick="showPaginationLoading(event)">{{ $page }}</a>
                                                </li>
                                            @endif
                                        @endforeach

                                        {{-- Next Page Link --}}
                                        @if ($guests->hasMorePages())
                                            <li class="page-item">
                                                <a class="page-link"
                                                    href="{{ $guests->appends(request()->query())->nextPageUrl() }}"
                                                    rel="next" aria-label="Next"
                                                    onclick="showPaginationLoading(event)">
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
    <div class="modal fade" id="modalFollowUp" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ route('customer.tamu.followup') }}" method="POST">
                    @csrf
                    <input type="hidden" name="guest_id" id="followup_guest_id">

                    <div class="modal-header">
                        <h5 class="modal-title">
                            <i class="mdi mdi-phone-log me-2"></i>Follow Up Tamu
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Nama Tamu</label>
                            <input type="text" class="form-control" id="followup_guest_name" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Waktu Follow Up <span class="text-danger">*</span></label>
                            <input type="datetime-local" class="form-control" name="last_follow_up" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Catatan Follow Up</label>
                            <textarea class="form-control" name="notes" rows="3" placeholder="Hasil follow up..."></textarea>
                        </div>
                        <hr style="border-color: rgba(154,85,255,0.2);">
                        <div class="mb-3">
                            <label class="form-label">Jadwal Follow Up Berikutnya</label>
                            <input type="datetime-local" class="form-control" name="next_follow_up">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-gradient-secondary" data-bs-dismiss="modal">
                            <i class="mdi mdi-close me-1"></i>Batal
                        </button>
                        <button type="submit" class="btn btn-gradient-primary">
                            <i class="mdi mdi-content-save me-1"></i>Simpan Follow Up
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal Import Tamu --}}
    <div class="modal fade" id="modalImportTamu" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="mdi mdi-import me-2" style="color: #9a55ff;"></i>Import Data Tamu
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center mb-4">
                        <i class="mdi mdi-file-excel" style="font-size: 64px; color: #28a745;"></i>
                        <h6 class="mt-3">Import dari file Excel</h6>
                        <p class="text-muted small">Download template terlebih dahulu untuk memudahkan import data</p>
                    </div>

                    <div class="d-flex gap-2 mb-4">
                        <a href="#" class="btn btn-outline-success w-50">
                            <i class="mdi mdi-download me-1"></i>Download Template
                        </a>
                        <a href="#" class="btn btn-outline-info w-50">
                            <i class="mdi mdi-eye me-1"></i>Lihat Contoh
                        </a>
                    </div>

                    <div class="mb-3">
                        <label class="form-label"><i class="mdi mdi-file-upload me-1 text-primary"></i>Upload File
                            Excel</label>
                        <input type="file" class="form-control" accept=".xlsx,.xls,.csv">
                        <small class="text-muted">Format: .xlsx, .xls, .csv (Max 5MB)</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-gradient-secondary" data-bs-dismiss="modal">
                        <i class="mdi mdi-close me-1"></i>Batal
                    </button>
                    <button type="button" class="btn btn-gradient-success">
                        <i class="mdi mdi-import me-1"></i>Import Data
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Export Tamu --}}
    <div class="modal fade" id="modalExportTamu" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="mdi mdi-export me-2" style="color: #9a55ff;"></i>Export Data Tamu
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center mb-4">
                        <i class="mdi mdi-file-download" style="font-size: 64px; color: #9a55ff;"></i>
                        <h6 class="mt-3">Pilih format export</h6>
                    </div>

                    <div class="d-flex gap-3 justify-content-center">
                        <button class="btn btn-outline-success p-3" style="width: 100px;">
                            <i class="mdi mdi-file-excel" style="font-size: 32px;"></i>
                            <span class="d-block small mt-2">Excel</span>
                        </button>
                        <button class="btn btn-outline-danger p-3" style="width: 100px;">
                            <i class="mdi mdi-file-pdf" style="font-size: 32px;"></i>
                            <span class="d-block small mt-2">PDF</span>
                        </button>
                        <button class="btn btn-outline-primary p-3" style="width: 100px;">
                            <i class="mdi mdi-file-delimited" style="font-size: 32px;"></i>
                            <span class="d-block small mt-2">CSV</span>
                        </button>
                    </div>

                    <hr class="my-4">

                    <div class="mb-3">
                        <label class="form-label"><i class="mdi mdi-filter-outline me-1 text-primary"></i>Filter Data yang
                            Diexport</label>
                        <select class="form-control">
                            <option value="semua">Semua Tamu</option>
                            <option value="new">Tamu Baru</option>
                            <option value="follow_up">Sudah Dihubungi</option>
                            <option value="negotiation">Negosiasi</option>
                            <option value="converted">Jadi Booking / Beli</option>
                            <option value="lost">Batal</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-gradient-secondary" data-bs-dismiss="modal">
                        <i class="mdi mdi-close me-1"></i>Batal
                    </button>
                    <button type="button" class="btn btn-gradient-primary">
                        <i class="mdi mdi-export me-1"></i>Export Data
                    </button>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function openFollowUpModal(id, name) {
            document.getElementById('followup_guest_id').value = id;
            document.getElementById('followup_guest_name').value = name;
            var modal = new bootstrap.Modal(document.getElementById('modalFollowUp'));
            modal.show();
        }

        function confirmDelete(id) {
            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: 'Data tamu ini akan dihapus secara permanen.',
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

        function confirmConvert(id, name) {
            Swal.fire({
                title: 'Konversi ke Customer?',
                html: `Calon pembeli <b>${name}</b> akan langsung disimpan sebagai data User / Customer baru.<br><br><span class="badge bg-warning text-dark px-2 py-1"><i class="mdi mdi-alert me-1"></i>Status: Belum Lengkap</span><br><small class="text-muted mt-2 d-block">Data NIK dan berkas KTP wajib dilengkapi di menu Data Customer agar dapat diproses untuk booking unit.</small>`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#7c3aed',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Konversi Sekarang',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Memproses...',
                        html: 'Mohon tunggu sebentar',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });
                    document.getElementById('convertForm' + id).submit();
                }
            });
        }

        // Notification Session SweetAlerts
        @if (session('success'))
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

        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "{{ session('error') }}",
                confirmButtonColor: '#9a55ff',
                confirmButtonText: 'OK'
            });
        @endif

        // Sorting functionality
        $(document).ready(function() {
            $('#modalFollowUp form, #modalImportTamu form').on('submit',
                function() {
                    Swal.fire({
                        title: 'Memproses...',
                        text: 'Mohon tunggu sebentar',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });
                });

            $('.sortable').click(function() {
                let field = $(this).data('field');
                let direction = $(this).data('direction');

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

            $('#filterFormDesktop, #filterFormMobile').on('submit', function() {
                Swal.fire({
                    title: 'Memuat...',
                    text: 'Mohon tunggu sebentar',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
            });
        });

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

        function showFilterLoading() {
            Swal.fire({
                title: 'Memuat...',
                html: 'Sedang memfilter data',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
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
    </script>
@endpush
