@extends('layouts.partial.app')

@section('title', 'Data Tamu / Proyeksi')

@section('content')

    <style>
        .card {
            border: none !important;
            border-radius: 12px !important;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            margin-bottom: 1.25rem;
            background: #ffffff;
            transition: all 0.3s ease;
        }

        .card:hover {
            box-shadow: 0 8px 25px rgba(154, 85, 255, 0.08) !important;
        }

        .card-header {
            background: #ffffff !important;
            border-bottom: 1px solid #f0f2f5 !important;
            padding: 1rem 1.25rem;
            border-top-left-radius: 12px !important;
            border-top-right-radius: 12px !important;
        }

        .card-title {
            font-size: 1.05rem;
            font-weight: 700;
            color: #2c2e3f;
            margin-bottom: 0;
        }

        .stat-card {
            background: #ffffff;
            border-radius: 12px;
            padding: 1.2rem;
            height: 100%;
            display: flex;
            align-items: center;
            gap: 1rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            border: 1px solid #f0f2f8;
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(154, 85, 255, 0.12);
        }

        .stat-card .stat-icon {
            width: 52px;
            height: 52px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.6rem;
            color: white;
            flex-shrink: 0;
        }

        .stat-card .stat-icon.total {
            background: linear-gradient(135deg, #da8cff, #9a55ff);
            box-shadow: 0 4px 12px rgba(154, 85, 255, 0.3);
        }

        .stat-card .stat-icon.prospek {
            background: linear-gradient(135deg, #ff9a9e, #f6416c);
            box-shadow: 0 4px 12px rgba(246, 65, 108, 0.3);
        }

        .stat-card .stat-icon.followup {
            background: linear-gradient(135deg, #4facfe, #00f2fe);
            box-shadow: 0 4px 12px rgba(0, 242, 254, 0.3);
        }

        .stat-card .stat-icon.converted {
            background: linear-gradient(135deg, #43e97b, #38f9d7);
            box-shadow: 0 4px 12px rgba(67, 233, 123, 0.3);
        }

        .stat-card .stat-content {
            flex: 1;
            min-width: 0;
        }

        .stat-card .stat-content h3 {
            font-size: 1.6rem;
            font-weight: 700;
            margin-bottom: 0.15rem;
            color: #2c2e3f;
            line-height: 1.2;
        }

        .stat-card .stat-content p {
            font-size: 0.82rem;
            color: #8a94a6;
            margin-bottom: 0;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            font-weight: 600;
        }

        .filter-card {
            background: #fbfaff;
            border: 1px solid #efe6ff;
            border-radius: 12px;
            padding: 1rem;
            margin-bottom: 1.25rem;
        }

        .filter-card .form-control,
        .filter-card .form-select {
            padding: 0.5rem 0.75rem;
            font-size: 0.88rem;
            border-radius: 8px;
            height: 38px;
            border: 1px solid #e0e4e9;
            background-color: #ffffff;
            color: #2c2e3f;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #9a55ff;
            box-shadow: 0 0 0 3px rgba(154, 85, 255, 0.1);
            outline: none;
        }

        .btn-gradient-primary {
            background: linear-gradient(to right, #da8cff, #9a55ff) !important;
            color: #ffffff !important;
            border: none;
        }

        .btn-gradient-success {
            background: linear-gradient(135deg, #11998e, #38ef7d) !important;
            color: #ffffff !important;
            border: none;
        }

        .btn-gradient-danger {
            background: linear-gradient(135deg, #ff416c, #ff4b2b) !important;
            color: #ffffff !important;
            border: none;
        }

        .btn-gradient-secondary {
            background: #6c757d !important;
            color: #ffffff !important;
            border: none;
        }

        .btn-icon-only {
            width: 38px;
            height: 38px;
            padding: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
        }

        .table-responsive {
            border-radius: 8px;
        }

        .table thead th {
            background: #f8f9fc !important;
            color: #6e707e !important;
            font-weight: 700;
            font-size: 0.78rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 1px solid #e3e6f0;
            padding: 12px 10px;
            white-space: nowrap;
            vertical-align: middle;
        }

        .table thead th.sortable {
            cursor: pointer;
            transition: color 0.2s ease;
        }

        .table thead th.sortable:hover {
            color: #9a55ff !important;
        }

        .table tbody td {
            vertical-align: middle;
            font-size: 0.88rem;
            padding: 12px 10px;
            border-bottom: 1px solid #f2f4f8;
            color: #2c2e3f;
            white-space: nowrap;
        }

        .table tbody tr:hover {
            background-color: #faf9ff;
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
            padding: 0.35rem 0.75rem;
            border-radius: 30px;
            font-weight: 600;
            font-size: 0.78rem;
            display: inline-flex;
            align-items: center;
            gap: 4px;
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
            border-radius: 8px;
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

        <!-- Header Halaman -->
        <div class="row mb-3 mb-md-4">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center px-1">
                    <div>
                        <h3 class="text-dark mb-1 fw-bold">
                            <i class="mdi mdi-account-group me-2" style="color: #9a55ff;"></i>Data Tamu / Proyeksi
                        </h3>
                        <p class="text-muted mb-0">Kelola data pengunjung dan calon pembeli unit properti</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistic Cards - Style Dashboard -->
        <div class="row g-3 mb-4">
            <div class="col-6 col-md-3">
                <div class="card shadow-sm border-0 h-100 mb-0">
                    <div class="card-body d-flex justify-content-between align-items-center p-3">
                        <div>
                            <h3 class="text-dark mb-1 fw-bold">{{ $totalGuests ?? 0 }}</h3>
                            <p class="text-muted mb-0">Total Tamu / Proyeksi</p>
                        </div>
                        <div class="d-none d-sm-block">
                            <i class="mdi mdi-account-group" style="font-size: 2.5rem; color: #9a55ff; opacity: 0.2;"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-6 col-md-3">
                <div class="card shadow-sm border-0 h-100 mb-0">
                    <div class="card-body d-flex justify-content-between align-items-center p-3">
                        <div>
                            <h3 class="text-dark mb-1 fw-bold">{{ $totalProspek ?? 0 }}</h3>
                            <p class="text-muted mb-0">Total Proyeksi Aktif</p>
                        </div>
                        <div class="d-none d-sm-block">
                            <i class="mdi mdi-fire" style="font-size: 2.5rem; color: #9a55ff; opacity: 0.2;"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-6 col-md-3">
                <div class="card shadow-sm border-0 h-100 mb-0">
                    <div class="card-body d-flex justify-content-between align-items-center p-3">
                        <div>
                            <h3 class="text-dark mb-1 fw-bold">{{ $totalFollowUp ?? 0 }}</h3>
                            <p class="text-muted mb-0">Follow Up Hari Ini</p>
                        </div>
                        <div class="d-none d-sm-block">
                            <i class="mdi mdi-phone-check" style="font-size: 2.5rem; color: #9a55ff; opacity: 0.2;"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-6 col-md-3">
                <div class="card shadow-sm border-0 h-100 mb-0">
                    <div class="card-body d-flex justify-content-between align-items-center p-3">
                        <div>
                            <h3 class="text-dark mb-1 fw-bold">{{ $guests->where('status', 'converted')->count() ?? 0 }}</h3>
                            <p class="text-muted mb-0">Converted / Deal</p>
                        </div>
                        <div class="d-none d-sm-block">
                            <i class="mdi mdi-handshake" style="font-size: 2.5rem; color: #9a55ff; opacity: 0.2;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card Tabel & Filter -->
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white d-flex flex-wrap flex-md-row justify-content-between align-items-center gap-3">
                        <h5 class="card-title mb-0">
                            <i class="mdi mdi-format-list-bulleted me-2 text-primary"></i>Daftar Tamu / Prospek
                        </h5>

                        <div class="header-action-group">
                            <button class="btn btn-gradient-success" onclick="$('#modalImportTamu').modal('show')">
                                <i class="mdi mdi-import me-1"></i><span class="d-none d-sm-inline">Import</span>
                            </button>
                            <button class="btn btn-gradient-danger" onclick="$('#modalExportTamu').modal('show')">
                                <i class="mdi mdi-export me-1"></i><span class="d-none d-sm-inline">Export</span>
                            </button>
                            <button type="button" class="btn btn-gradient-primary btn-add" data-bs-toggle="modal"
                                data-bs-target="#modalGuest">
                                <i class="mdi mdi-plus me-1"></i><span class="d-none d-sm-inline">Tambah Proyeksi</span>
                            </button>
                        </div>
                    </div>

                    <div class="card-body">
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
                                        <th class="text-center" width="5%">No</th>
                                        <th class="sortable" width="15%" data-field="name"
                                            data-direction="{{ request('sortField') == 'name' ? (request('sortDirection') == 'asc' ? 'desc' : 'asc') : 'asc' }}">
                                            Nama Tamu
                                            @if (request('sortField') == 'name')
                                                <i
                                                    class="mdi mdi-{{ request('sortDirection') == 'asc' ? 'arrow-up' : 'arrow-down' }}"></i>
                                            @else
                                                <i class="mdi mdi-swap-vertical"></i>
                                            @endif
                                        </th>
                                        <th class="sortable" width="12%" data-field="phone"
                                            data-direction="{{ request('sortField') == 'phone' ? (request('sortDirection') == 'asc' ? 'desc' : 'asc') : 'asc' }}">
                                            No HP
                                            @if (request('sortField') == 'phone')
                                                <i
                                                    class="mdi mdi-{{ request('sortDirection') == 'asc' ? 'arrow-up' : 'arrow-down' }}"></i>
                                            @else
                                                <i class="mdi mdi-swap-vertical"></i>
                                            @endif
                                        </th>
                                        <th>Email</th>
                                        <th>Sumber Info</th>
                                        <th>Tugas</th>
                                        <th>Proyek</th>
                                        <th>Nama - Unit</th>
                                        <th>Jenis & Tipe</th>
                                        <th class="sortable" width="12%" data-field="assigned_to"
                                            data-direction="{{ request('sortField') == 'assigned_to' ? (request('sortDirection') == 'asc' ? 'desc' : 'asc') : 'asc' }}">
                                            Agent
                                            @if (request('sortField') == 'assigned_to')
                                                <i
                                                    class="mdi mdi-{{ request('sortDirection') == 'asc' ? 'arrow-up' : 'arrow-down' }}"></i>
                                            @else
                                                <i class="mdi mdi-swap-vertical"></i>
                                            @endif
                                        </th>
                                        <th class="sortable" width="10%" data-field="status"
                                            data-direction="{{ request('sortField') == 'status' ? (request('sortDirection') == 'asc' ? 'desc' : 'asc') : 'asc' }}">
                                            Status
                                            @if (request('sortField') == 'status')
                                                <i
                                                    class="mdi mdi-{{ request('sortDirection') == 'asc' ? 'arrow-up' : 'arrow-down' }}"></i>
                                            @else
                                                <i class="mdi mdi-swap-vertical"></i>
                                            @endif
                                        </th>
                                        <th class="sortable" width="12%" data-field="last_follow_up"
                                            data-direction="{{ request('sortField') == 'last_follow_up' ? (request('sortDirection') == 'asc' ? 'desc' : 'asc') : 'asc' }}">
                                            Last Follow
                                            @if (request('sortField') == 'last_follow_up')
                                                <i
                                                    class="mdi mdi-{{ request('sortDirection') == 'asc' ? 'arrow-up' : 'arrow-down' }}"></i>
                                            @else
                                                <i class="mdi mdi-swap-vertical"></i>
                                            @endif
                                        </th>
                                        <th class="sortable" width="12%" data-field="next_follow_up"
                                            data-direction="{{ request('sortField') == 'next_follow_up' ? (request('sortDirection') == 'asc' ? 'desc' : 'asc') : 'asc' }}">
                                            Next Follow
                                            @if (request('sortField') == 'next_follow_up')
                                                <i
                                                    class="mdi mdi-{{ request('sortDirection') == 'asc' ? 'arrow-up' : 'arrow-down' }}"></i>
                                            @else
                                                <i class="mdi mdi-swap-vertical"></i>
                                            @endif
                                        </th>
                                        <th class="text-center" width="10%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($guests as $index => $guest)
                                        @php
                                            $initials = collect(explode(' ', trim($guest->name)))
                                                ->filter()
                                                ->take(2)
                                                ->map(fn($word) => strtoupper(substr($word, 0, 1)))
                                                ->implode('');
                                        @endphp
                                        <tr>
                                            <td class="text-center fw-bold">{{ $index + 1 }}</td>
                                            <td>
                                                <div class="name-wrap">
                                                    <div class="name-avatar">{{ $initials ?: 'TG' }}</div>
                                                    <div class="fw-bold">{{ $guest->name }}</div>
                                                </div>
                                            </td>
                                            <td>
                                                <i class="mdi mdi-phone info-icon"></i>{{ $guest->phone }}
                                            </td>
                                            <td>
                                                <i class="mdi mdi-email-outline info-icon"></i>{{ $guest->email ?? '-' }}
                                            </td>
                                            <td>
                                                <i class="mdi mdi-bullhorn-outline info-icon"></i>{{ $guest->source }}
                                            </td>
                                            <td>
                                                @if($guest->marketingTask)
                                                    <i class="mdi mdi-clipboard-text-outline info-icon"></i>{{ $guest->marketingTask->nama_tugas }}
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>
                                            <td>
                                                <span class="icon-text">
                                                    <i class="mdi mdi-office-building info-icon"></i>
                                                    <span class="fw-bold">{{ $guest->project->name ?? '-' }}</span>
                                                </span>
                                            </td>
                                            <td>
                                                <span class="icon-text">
                                                    <i class="mdi mdi-home-outline info-icon"></i>
                                                    <span class="fw-bold">{{ $guest->unit->unit_name ?? '-' }} -
                                                        {{ $guest->unit->unit_code ?? '-' }}</span>
                                                </span>
                                            </td>
                                            <td>
                                                @if ($guest->unit)
                                                    @if (strtolower($guest->unit->jenis ?? '') == 'subsidi')
                                                        <span class="badge badge-gradient-success">
                                                            <i
                                                                class="mdi mdi-home-assistant me-1"></i>{{ $guest->unit->jenis }}/{{ $guest->unit->type ?? '-' }}
                                                        </span>
                                                    @elseif(strtolower($guest->unit->jenis ?? '') == 'komersil')
                                                        <span class="badge badge-gradient-primary">
                                                            <i
                                                                class="mdi mdi-office-building me-1"></i>{{ $guest->unit->jenis }}/{{ $guest->unit->type ?? '-' }}
                                                        </span>
                                                    @else
                                                        <span class="badge badge-gradient-secondary">
                                                            <i
                                                                class="mdi mdi-help-circle-outline me-1"></i>{{ ($guest->unit->jenis ?? '-') . '/' . ($guest->unit->type ?? '-') }}
                                                        </span>
                                                    @endif
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($guest->employee)
                                                    @php
                                                        $agentName = $guest->employee->name;
                                                        $aInitials = '';
                                                        foreach (explode(' ', trim($agentName)) as $word) {
                                                            if ($word !== '') {
                                                                $aInitials .= strtoupper(substr($word, 0, 1));
                                                            }
                                                        }
                                                        $aInitials = substr($aInitials ?: 'A', 0, 2);
                                                    @endphp
                                                    <div class="customer-info">
                                                        <div class="customer-initial">
                                                            {{ $aInitials }}
                                                        </div>
                                                        <span class="fw-bold">{{ $agentName }}</span>
                                                    </div>
                                                @else
                                                    <i class="mdi mdi-account-tie text-primary me-1"></i>
                                                    -
                                                @endif
                                            </td>
                                            <td>
                                                <span class="badge-status {{ $guest->status }}">
                                                    @if ($guest->status == 'hot_prospect')
                                                        Hot Prospect
                                                    @elseif ($guest->status == 'medium_prospect')
                                                        Medium Prospect
                                                    @elseif ($guest->status == 'cold_prospect')
                                                        Cold Prospect
                                                    @elseif ($guest->status == 'converted')
                                                        Dikonversi / Deal
                                                    @elseif ($guest->status == 'lost')
                                                        Gagal / Batal
                                                    @else
                                                        {{ ucfirst(str_replace('_', ' ', $guest->status)) }}
                                                    @endif
                                                </span>
                                            </td>
                                            <td>
                                                <i class="mdi mdi-calendar-clock info-icon"></i>
                                                {{ $guest->last_follow_up ? \Carbon\Carbon::parse($guest->last_follow_up)->format('d M Y') : '-' }}
                                            </td>
                                            <td>
                                                <i class="mdi mdi-calendar-check-outline info-icon"></i>
                                                {{ $guest->next_follow_up ? \Carbon\Carbon::parse($guest->next_follow_up)->format('d M Y') : '-' }}
                                            </td>
                                            <td class="text-center">
                                                <div class="d-flex justify-content-center gap-1">
                                                    <button class="btn-action info" title="Follow Up"
                                                        onclick="openFollowUpModal({{ $guest->id }}, '{{ addslashes($guest->name) }}')">
                                                        <i class="mdi mdi-phone-log"></i>
                                                    </button>

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

                                                    <button class="btn-action edit btnEditTamu" title="Edit"
                                                        data-id="{{ $guest->id }}">
                                                        <i class="mdi mdi-pencil"></i>
                                                    </button>

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
                                            <td colspan="13" class="text-center text-muted py-4">
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
    </div>

    <div class="modal fade" id="modalGuest" tabindex="-1" aria-labelledby="modalGuestLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-medium">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalGuestLabel">
                        <i class="mdi mdi-plus-circle me-2"></i>Tambah Tamu / Prospek
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="{{ route('customer.tamu.store') }}" method="POST">
                    @csrf


                    <div class="modal-body modal-scroll-body">
                        <div class="row">
                            <div class="col-12 mb-3">
                                <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="name"
                                    placeholder="Masukkan nama lengkap" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">No HP <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="phone"
                                    placeholder="Masukkan nomor HP" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" placeholder="Masukkan email">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Sumber Informasi <span class="text-danger">*</span></label>
                                <select class="form-control" name="source" required>
                                    <option value="">Pilih Sumber Informasi</option>
                                    <option value="Instagram">Instagram</option>
                                    <option value="Facebook">Facebook</option>
                                    <option value="Website">Website</option>
                                    <option value="Referensi">Referensi</option>
                                    <option value="Pameran">Pameran</option>
                                    <option value="Lainnya">Lainnya</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Marketing Task</label>
                                <select class="form-control" name="marketing_task_id">
                                    <option value="">Pilih Task</option>
                                    @foreach ($marketingTasks as $task)
                                        <option value="{{ $task->id }}">{{ $task->nama_tugas }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Proyek Minat <span class="text-danger">*</span></label>
                                <select class="form-control" name="land_bank_id" id="projectSelect" required style="width: 100%;">
                                    <option value="">Pilih Proyek</option>
                                    @foreach ($projects as $project)
                                        <option value="{{ $project->id }}">{{ $project->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tipe Unit</label>
                                <select class="form-control" name="unit_id" id="unitSelect" style="width: 100%;">
                                    <option value="">-- Pilih Proyek Terlebih Dahulu --</option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Agent <span class="text-danger">*</span></label>
                                <select class="form-control" name="assigned_to" required>
                                    <option value="">Pilih Agent</option>
                                    @foreach ($agents as $agent)
                                        <option value="{{ $agent->id }}">{{ $agent->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Status <span class="text-danger">*</span></label>
                                <select class="form-control" name="status" required>
                                    <option value="">Pilih Status</option>
                                    <option value="hot_prospect">Hot Prospek</option>
                                    <option value="medium_prospect">Medium Prospek</option>
                                    <option value="cold_prospect">Cold Prospek</option>
                                    <option value="converted">Deal / Booking</option>
                                    <option value="lost">Gagal / Batal</option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Budget (Anggaran)</label>
                                <div class="input-group">
                                    <span class="input-group-text fw-bold text-primary" style="background: #f8f6fc; border: 1.5px solid #e2e8f0; border-right: none; font-size: 0.88rem; border-top-left-radius: 8px; border-bottom-left-radius: 8px;">Rp</span>
                                    <input type="text" class="form-control" name="budget" id="budgetInput"
                                        placeholder="Contoh: 350.000.000"
                                        style="border-top-left-radius: 0 !important; border-bottom-left-radius: 0 !important;">
                                </div>
                                <small class="text-muted" style="font-size: 0.75rem;">Format angka otomatis ribuan</small>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Next Follow Up <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" name="next_follow_up" required>
                            </div>

                            <div class="col-12 mb-3">
                                <label class="form-label">Catatan</label>
                                <textarea class="form-control" name="notes" rows="3" placeholder="Masukkan catatan tambahan"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-gradient-secondary" data-bs-dismiss="modal">
                            <i class="mdi mdi-close me-1"></i>Batal
                        </button>
                        <button type="submit" class="btn btn-gradient-primary">
                            <i class="mdi mdi-content-save me-1"></i>Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalEditTamu" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-dialog-medium">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="mdi mdi-account-edit me-2"></i>Edit Data Tamu
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <form id="formEditTamu" method="POST">
                        @csrf
                        @method('PUT')

                        <input type="hidden" id="edit_id">

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                <input type="text" name="name" id="edit_name" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">No. HP <span class="text-danger">*</span></label>
                                <input type="text" name="phone" id="edit_phone" class="form-control" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" id="edit_email" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Sumber Informasi <span class="text-danger">*</span></label>
                                <select name="source" id="edit_source" class="form-control" required>
                                    <option value="">-- Pilih Sumber --</option>
                                    <option value="instagram">Instagram</option>
                                    <option value="facebook">Facebook</option>
                                    <option value="tiktok">TikTok</option>
                                    <option value="iklan">Iklan Online</option>
                                    <option value="referensi">Referensi</option>
                                    <option value="walk-in">Walk-in</option>
                                    <option value="lainnya">Lainnya</option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Agent <span class="text-danger">*</span></label>
                                <select name="assigned_to" id="edit_assigned_to" class="form-control" required>
                                    <option value="">-- Pilih Agent --</option>
                                    @foreach ($agents as $agent)
                                        <option value="{{ $agent->id }}">{{ $agent->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Status Prospek <span class="text-danger">*</span></label>
                                <select name="status" id="edit_status" class="form-control" required>
                                    <option value="new">Baru</option>
                                    <option value="follow_up">Sudah Dihubungi</option>
                                    <option value="negotiation">Negosiasi</option>
                                    <option value="converted">Dikonversi / Deal</option>
                                    <option value="lost">Gagal / Batal</option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Proyek Minat <span class="text-danger">*</span></label>
                                <select name="land_bank_id" id="edit_land_bank_id" class="form-control" required style="width: 100%;">
                                    <option value="">-- Pilih Proyek --</option>
                                    @foreach ($projects as $project)
                                        <option value="{{ $project->id }}">{{ $project->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tipe Unit</label>
                                <select name="unit_id" id="edit_unit_id" class="form-control" style="width: 100%;">
                                    <option value="">-- Pilih Unit --</option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Last Follow Up</label>
                                <input type="datetime-local" name="last_follow_up" id="edit_last_follow_up"
                                    class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Next Follow Up <span class="text-danger">*</span></label>
                                <input type="datetime-local" name="next_follow_up" id="edit_next_follow_up"
                                    class="form-control" required>
                            </div>

                            <div class="col-12">
                                <hr style="border-color: rgba(154,85,255,0.15);">
                            </div>

                            <div class="col-12 mb-3">
                                <label class="form-label">Catatan</label>
                                <textarea name="notes" id="edit_notes" class="form-control" rows="4"
                                    placeholder="Masukkan catatan tambahan"></textarea>
                            </div>
                        </div>

                        <div class="modal-footer px-0 pb-0">
                            <button type="button" class="btn btn-gradient-secondary" data-bs-dismiss="modal">
                                <i class="mdi mdi-close me-1"></i>Batal
                            </button>
                            <button type="submit" class="btn btn-gradient-primary">
                                <i class="mdi mdi-content-save me-1"></i>Update Data
                            </button>
                        </div>
                    </form>
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
        const projectsData = @json($projects);
        const allUnitsData = @json($units);

        function getUnitDisplayName(unit) {
            let name = unit.unit_name || unit.unit_code || ('Unit #' + unit.id);
            if (unit.block) {
                name += ' (Blok ' + unit.block + (unit.unit_number ? ' No. ' + unit.unit_number : '') + ')';
            }
            if (unit.type) {
                name += ' - Tipe ' + unit.type;
            }
            return name;
        }

        function filterUnitsForSelect(selectEl, projectId, selectedUnitId = null) {
            const $select = $(selectEl);
            if (!$select.length) return;

            $select.empty();

            if (!projectId) {
                $select.append('<option value="">-- Pilih Proyek Terlebih Dahulu --</option>');
            } else {
                $select.append('<option value="">-- Pilih Unit --</option>');

                let unitsToRender = [];
                const selectedProject = projectsData.find(p => String(p.id) === String(projectId));
                if (selectedProject && selectedProject.units && selectedProject.units.length > 0) {
                    unitsToRender = selectedProject.units;
                } else {
                    unitsToRender = allUnitsData.filter(u => String(u.land_bank_id) === String(projectId));
                }

                if (unitsToRender.length === 0) {
                    $select.append('<option value="" disabled>Tidak ada unit tersedia untuk proyek ini</option>');
                } else {
                    unitsToRender.forEach(unit => {
                        const isSelected = selectedUnitId && String(selectedUnitId) === String(unit.id);
                        const opt = new Option(getUnitDisplayName(unit), unit.id, false, isSelected);
                        $(opt).attr('data-project', unit.land_bank_id);
                        $select.append(opt);
                    });
                }
            }

            if (selectedUnitId) {
                $select.val(selectedUnitId);
            } else {
                $select.val('');
            }

            if ($select.hasClass('select2-hidden-accessible')) {
                $select.trigger('change.select2');
            }
        }

        $(document).on('click', '.btnEditTamu', function() {
            let id = $(this).data('id');

            $.ajax({
                url: '/customer/guest/' + id + '/edit',
                type: 'GET',
                success: function(data) {
                    $('#formEditTamu')[0].reset();

                    $('#edit_id').val(data.id);
                    $('#edit_name').val(data.name ?? '');
                    $('#edit_phone').val(data.phone ?? '');
                    $('#edit_email').val(data.email ?? '');
                    $('#edit_source').val(data.source ?? '');
                    $('#edit_assigned_to').val(data.assigned_to ?? '');
                    $('#edit_status').val(data.status ?? '');

                    // Set proyek minat dan otomatis filter unit
                    if (data.land_bank_id) {
                        $('#edit_land_bank_id').val(data.land_bank_id).trigger('change', [true]);
                        $('#edit_land_bank_id').trigger('change.select2');
                    } else {
                        $('#edit_land_bank_id').val('').trigger('change.select2');
                    }

                    filterUnitsForSelect($('#edit_unit_id'), data.land_bank_id, data.unit_id);

                    $('#edit_notes').val(data.notes ?? '');

                    if (data.last_follow_up) {
                        $('#edit_last_follow_up').val(data.last_follow_up.replace(' ', 'T').substring(0,
                            16));
                    }
                    if (data.next_follow_up) {
                        $('#edit_next_follow_up').val(data.next_follow_up.replace(' ', 'T').substring(0,
                            16));
                    }

                    $('#formEditTamu').attr('action', '/customer/guest/' + data.id);

                    const modal = new bootstrap.Modal(document.getElementById('modalEditTamu'));
                    modal.show();
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: 'Data tidak dapat dimuat.',
                        confirmButtonColor: '#dc3545'
                    });
                }
            });
        });

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
                html: `Tamu <b>${name}</b> akan dikonversi menjadi customer.`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#198754',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Konversi!',
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

        function formatBudgetCustom(value) {
            let onlyNumbers = value.replace(/\D/g, '');
            if (!onlyNumbers) return '';
            return new Intl.NumberFormat('id-ID').format(onlyNumbers);
        }

        // Setup Select2 & Event Listeners
        $(document).ready(function() {
            // Inisialisasi Select2 untuk Modal Tambah Tamu
            $('#projectSelect').select2({
                theme: 'bootstrap-5',
                dropdownParent: $('#modalGuest'),
                placeholder: 'Pilih Proyek',
                allowClear: true,
                width: '100%'
            });

            $('#unitSelect').select2({
                theme: 'bootstrap-5',
                dropdownParent: $('#modalGuest'),
                placeholder: '-- Pilih Proyek Terlebih Dahulu --',
                allowClear: true,
                width: '100%'
            });

            // Inisialisasi Select2 untuk Modal Edit Tamu
            $('#edit_land_bank_id').select2({
                theme: 'bootstrap-5',
                dropdownParent: $('#modalEditTamu'),
                placeholder: 'Pilih Proyek',
                allowClear: true,
                width: '100%'
            });

            $('#edit_unit_id').select2({
                theme: 'bootstrap-5',
                dropdownParent: $('#modalEditTamu'),
                placeholder: '-- Pilih Unit --',
                allowClear: true,
                width: '100%'
            });

            // Event saat Proyek Minat di Modal Tambah dipilih / diubah
            $('#projectSelect').on('change select2:select select2:clear', function() {
                const projectId = $(this).val();
                filterUnitsForSelect($('#unitSelect'), projectId, null);
            });

            // Event saat Proyek Minat di Modal Edit diubah oleh pengguna
            $('#edit_land_bank_id').on('change select2:select select2:clear', function(e, isInit) {
                if (!isInit) {
                    const projectId = $(this).val();
                    filterUnitsForSelect($('#edit_unit_id'), projectId, null);
                }
            });

            // Reset saat modal tambah dibuka
            $('#modalGuest').on('show.bs.modal', function() {
                $('#projectSelect').val('').trigger('change.select2');
                filterUnitsForSelect($('#unitSelect'), null, null);
            });

            // Tutup dropdown Select2 saat modal ditutup
            $('#modalGuest, #modalEditTamu').on('hidden.bs.modal', function() {
                $('.select2-container--open').removeClass('select2-container--open');
            });

            // Format Budget Input
            const budgetInput = document.getElementById('budgetInput');
            if (budgetInput) {
                budgetInput.addEventListener('input', function() {
                    this.value = formatBudgetCustom(this.value);
                });
            }
        });


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
            $('#modalGuest form, #formEditTamu, #modalFollowUp form, #modalImportTamu form').on('submit',
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
