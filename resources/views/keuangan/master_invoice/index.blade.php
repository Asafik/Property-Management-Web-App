@extends('layouts.partial.app')

@section('title', 'Master Invoice Keuangan - Property Management App')

@section('content')

    <style>
        .header-card {
            background: #ffffff;
            border-radius: 8px !important;
            border: none !important;
            box-shadow: 0 4px 18px rgba(0, 0, 0, 0.04);
            margin-bottom: 0;
        }

        .filter-card {
            background: #ffffff;
            padding: 0.85rem 1rem !important;
            margin-bottom: 1rem !important;
        }

        /* Select2 & Input Theme Alignment */
        .select2-container--bootstrap-5 .select2-selection {
            min-height: 38px !important;
            height: 38px !important;
            padding: 0.375rem 0.75rem !important;
            display: flex !important;
            align-items: center !important;
            border-color: #ebedf2 !important;
            border-radius: 6px !important;
            font-size: 0.875rem !important;
            background-color: #ffffff !important;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }
        .select2-container--bootstrap-5 .select2-selection--single .select2-selection__rendered {
            line-height: 1.5 !important;
            padding-left: 0 !important;
            color: #3b3f5c !important;
        }
        .select2-container--bootstrap-5.select2-container--focus .select2-selection,
        .select2-container--bootstrap-5.select2-container--open .select2-selection {
            border-color: #bfa5fa !important;
            box-shadow: 0 0 0 0.2rem rgba(154, 85, 255, 0.12) !important;
        }

        /* Responsive Table & Scroll Styling */
        .table-responsive {
            overflow-x: auto !important;
            -webkit-overflow-scrolling: touch !important;
            width: 100% !important;
            margin-bottom: 0 !important;
        }

        .table thead th {
            color: #9a55ff;
            font-weight: 700;
            font-size: 0.78rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            background: #fbf9ff;
            border-bottom: 1px solid #ebe5f5;
            padding: 0.75rem 0.85rem;
            white-space: nowrap;
        }

        .table tbody td {
            padding: 0.75rem 0.85rem;
            vertical-align: middle;
            border-bottom: 1px solid #f2eff8;
            font-size: 0.88rem;
        }

        .badge-cat {
            font-size: 11px;
            font-weight: 700;
            padding: 4px 10px;
            border-radius: 20px;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .badge-cat-pra {
            background-color: #ede9fe;
            color: #6d28d9;
            border: 1px solid #ddd6fe;
        }

        .badge-cat-unit {
            background-color: #e0f2fe;
            color: #0369a1;
            border: 1px solid #bae6fd;
        }

        .badge-cat-ops {
            background-color: #f1f5f9;
            color: #475569;
            border: 1px solid #e2e8f0;
        }

        .badge-status-pill {
            font-size: 11px;
            font-weight: 700;
            padding: 4px 12px;
            border-radius: 20px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .badge-status-lunas {
            background: #dcfce7;
            color: #15803d;
            border: 1px solid #bbf7d0;
        }

        .badge-status-partial {
            background: #fef9c3;
            color: #a16207;
            border: 1px solid #fef08a;
        }

        .badge-status-pending {
            background: #fee2e2;
            color: #b91c1c;
            border: 1px solid #fecaca;
        }

        .badge-status-cancelled {
            background: #f3f4f6;
            color: #6b7280;
            border: 1px solid #e5e7eb;
        }

        .btn-action-icon {
            width: 32px;
            height: 32px;
            border-radius: 6px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: 1px solid #e2e8f0;
            background: #ffffff;
            color: #475569;
            font-size: 15px;
            transition: all 0.2s ease;
            text-decoration: none;
        }

        .btn-action-icon:hover {
            background: #f8fafc;
            color: #1e293b;
            border-color: #cbd5e1;
            transform: translateY(-1px);
        }

        .btn-action-print {
            color: #7c3aed;
            border-color: #ddd6fe;
            background: #f5f3ff;
        }
        .btn-action-print:hover {
            background: #7c3aed;
            color: #ffffff;
        }

        .btn-action-edit {
            color: #0284c7;
            border-color: #bae6fd;
            background: #f0f9ff;
        }
        .btn-action-edit:hover {
            background: #0284c7;
            color: #ffffff;
        }

        .pagination {
            margin: 0;
            gap: 4px;
        }

        .page-item .page-link {
            border: 1px solid #e9ecef;
            padding: 0.35rem 0.75rem;
            font-size: 0.8rem;
            color: #6c7383;
            background-color: #ffffff;
            border-radius: 6px !important;
            min-width: 34px;
            text-align: center;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .page-item.active .page-link {
            background: linear-gradient(135deg, #da8cff, #9a55ff) !important;
            border-color: transparent !important;
            color: #ffffff !important;
            box-shadow: 0 4px 10px rgba(154, 85, 255, 0.25);
            font-weight: 700;
        }

        .page-item .page-link:hover {
            background-color: #f6f1ff;
            color: #792fe0;
            border-color: #d8b4fe;
        }

        .page-item.disabled .page-link {
            background-color: #f8fafc;
            color: #cbd5e1;
            border-color: #e2e8f0;
        }

        .pagination-info {
            font-size: 0.85rem;
            color: #6c7383;
            font-weight: 500;
        }

        .btn-action-delete {
            color: #ef4444;
            border-color: #fecaca;
            background: #fef2f2;
        }
        .btn-action-delete:hover {
            background: #ef4444;
            color: #ffffff;
        }
    </style>

    <div class="container-fluid px-1 px-sm-2 px-md-3 py-2 py-md-3">

        <!-- Header Dashboard Card Banner -->
        <div class="row mb-3 mb-md-4">
            <div class="col-12">
                <div class="card shadow-sm border-0 header-card">
                    <div class="card-body p-4 p-md-4 py-4 py-md-4 d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3" style="min-height: 105px;">
                        <div>
                            <h3 class="text-dark mb-1 fw-bold" style="font-size: 1.35rem;">
                                Master Invoice Keuangan
                            </h3>
                            <p class="text-muted mb-0" style="font-size: 0.9rem;">
                                Pusat pencatatan, pemantauan status, dan arsip invoice pengadaan lahan Pra Land Bank & transaksi properti.
                            </p>
                        </div>
                        <div class="d-flex flex-wrap align-items-center gap-2">
                            <button type="button" class="btn btn-sm btn-gradient-secondary d-inline-flex align-items-center gap-1 shadow-sm py-2 px-3" onclick="syncAllInvoices()">
                                <i class="mdi mdi-sync fs-6" id="syncIcon"></i>
                                <span>Sinkronkan Transaksi</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistic Cards (Sesuai Desain Dashboard) -->
        <div class="row g-3 mb-4">
            <!-- Total Nilai Invoice -->
            <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                <div class="card shadow-sm border-0 h-100 mb-0">
                    <div class="card-body d-flex justify-content-between align-items-center p-3">
                        <div>
                            <h4 class="text-dark mb-1 fw-bold" style="font-size: 1.15rem;">Rp {{ number_format($stats['total_amount'], 0, ',', '.') }}</h4>
                            <p class="text-muted mb-0" style="font-size: 0.85rem;">Total Akumulasi Tagihan</p>
                            <small class="text-muted" style="font-size: 0.78rem;">{{ $stats['total_invoices_count'] }} Transaksi Terdata</small>
                        </div>
                        <div class="d-none d-sm-block">
                            <i class="mdi mdi-receipt-text-outline" style="font-size: 2.2rem; color: #9a55ff; opacity: 0.25;"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Terbayar (Lunas) -->
            <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                <div class="card shadow-sm border-0 h-100 mb-0">
                    <div class="card-body d-flex justify-content-between align-items-center p-3">
                        <div>
                            <h4 class="text-success mb-1 fw-bold" style="font-size: 1.15rem;">Rp {{ number_format($stats['total_paid'], 0, ',', '.') }}</h4>
                            <p class="text-muted mb-0" style="font-size: 0.85rem;">Realisasi Terbayar</p>
                            <small class="text-success fw-semibold" style="font-size: 0.78rem;">{{ $stats['count_lunas'] }} Invoice Lunas</small>
                        </div>
                        <div class="d-none d-sm-block">
                            <i class="mdi mdi-cash-check" style="font-size: 2.2rem; color: #28a745; opacity: 0.3;"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sisa Tagihan (Outstanding) -->
            <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                <div class="card shadow-sm border-0 h-100 mb-0">
                    <div class="card-body d-flex justify-content-between align-items-center p-3">
                        <div>
                            <h4 class="text-danger mb-1 fw-bold" style="color: #ea580c !important; font-size: 1.15rem;">Rp {{ number_format($stats['total_remaining'], 0, ',', '.') }}</h4>
                            <p class="text-muted mb-0" style="font-size: 0.85rem;">Sisa Tagihan Berjalan</p>
                            <small class="text-danger" style="font-size: 0.78rem;">{{ $stats['count_partial'] + $stats['count_pending'] }} Invoice Belum Lunas</small>
                        </div>
                        <div class="d-none d-sm-block">
                            <i class="mdi mdi-cash-clock" style="font-size: 2.2rem; color: #ea580c; opacity: 0.3;"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Invoice Pra Land Bank -->
            <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                <div class="card shadow-sm border-0 h-100 mb-0">
                    <div class="card-body d-flex justify-content-between align-items-center p-3">
                        <div>
                            <h4 class="text-primary mb-1 fw-bold" style="font-size: 1.15rem;">{{ $stats['count_pra_landbank'] }} Dokumen</h4>
                            <p class="text-muted mb-0" style="font-size: 0.85rem;">Invoice Pra Land Bank</p>
                            <small class="text-muted" style="font-size: 0.78rem;">Pengadaan & Akuisisi Lahan</small>
                        </div>
                        <div class="d-none d-sm-block">
                            <i class="mdi mdi-map-marker-radius" style="font-size: 2.2rem; color: #0d6efd; opacity: 0.25;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabel Data Master Invoice -->
        <div class="row mt-2 mt-sm-2 mt-md-3">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-white d-flex flex-wrap flex-md-row justify-content-between align-items-center gap-2 py-3">
                        <h5 class="card-title mb-0">
                            Daftar Master Invoice Database
                        </h5>
                        <button type="button" class="btn btn-sm btn-gradient-primary d-inline-flex align-items-center gap-1 shadow-sm py-2 px-3" data-bs-toggle="modal" data-bs-target="#modalCreateInvoice">
                            <i class="mdi mdi-plus me-1 fs-6"></i>
                            <span>Tambah Invoice</span>
                        </button>
                    </div>

                    <div class="card-body">
                        <!-- FILTER SECTION (PERSIS DASHBOARD) -->
                        <div class="filter-card mb-3">
                            <!-- DESKTOP & TABLET VERSION -->
                            <div class="filter-row-desktop d-none d-md-block">
                                <form method="GET" action="{{ route('keuangan.master-invoice.index') }}" id="filterForm">
                                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 w-100">
                                        <div class="d-flex flex-wrap align-items-center gap-2 flex-grow-1">
                                            <!-- Search -->
                                            <div style="min-width: 200px; max-width: 260px; flex: 1;">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" name="search" id="searchInput"
                                                        placeholder="No Invoice, Penerima, Objek..." value="{{ request('search') }}"
                                                        style="border-top-right-radius: 0 !important; border-bottom-right-radius: 0 !important; border-right: none; height: 38px;">
                                                    <button class="btn btn-gradient-primary d-flex align-items-center justify-content-center px-3" 
                                                        type="submit" id="searchSubmitBtn" title="Cari"
                                                        style="border-top-left-radius: 0 !important; border-bottom-left-radius: 0 !important; border-top-right-radius: 4px !important; border-bottom-right-radius: 4px !important; height: 38px; box-shadow: none;">
                                                        <i class="mdi mdi-magnify" style="font-size: 1.15rem; color: #ffffff;"></i>
                                                    </button>
                                                </div>
                                            </div>

                                            <!-- Kategori Filter -->
                                            <div style="min-width: 170px;">
                                                <select class="form-select" name="category" onchange="document.getElementById('filterForm').submit()" style="height: 38px;">
                                                    <option value="all" {{ request('category') == 'all' ? 'selected' : '' }}>Semua Kategori</option>
                                                    <option value="pra_landbank" {{ request('category') == 'pra_landbank' ? 'selected' : '' }}>Pra Land Bank (Lahan)</option>
                                                    <option value="unit_cash" {{ request('category') == 'unit_cash' ? 'selected' : '' }}>Unit Cash</option>
                                                    <option value="operasional" {{ request('category') == 'operasional' ? 'selected' : '' }}>Operasional</option>
                                                </select>
                                            </div>

                                            <!-- Status Pembayaran Filter -->
                                            <div style="min-width: 160px;">
                                                <select class="form-select" name="status" onchange="document.getElementById('filterForm').submit()" style="height: 38px;">
                                                    <option value="all" {{ request('status') == 'all' ? 'selected' : '' }}>Semua Status</option>
                                                    <option value="lunas" {{ request('status') == 'lunas' ? 'selected' : '' }}>Lunas</option>
                                                    <option value="partial" {{ request('status') == 'partial' ? 'selected' : '' }}>Sebagian</option>
                                                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                                </select>
                                            </div>

                                            <!-- Tanggal Mulai -->
                                            <div style="min-width: 135px;">
                                                <input type="date" class="form-control" name="start_date" value="{{ request('start_date') }}" title="Tanggal Mulai" style="height: 38px;">
                                            </div>

                                            <!-- Tanggal Akhir -->
                                            <div style="min-width: 135px;">
                                                <input type="date" class="form-control" name="end_date" value="{{ request('end_date') }}" title="Tanggal Akhir" style="height: 38px;">
                                            </div>
                                        </div>

                                        <!-- Right Side: Limit Dropdown + Filter & Reset Buttons (PERSIS DASHBOARD) -->
                                        <div class="d-flex align-items-center gap-2 ms-auto">
                                            <div style="width: 85px;">
                                                <select class="form-select" name="per_page" id="perPageSelect" onchange="document.getElementById('filterForm').submit()" style="height: 38px;">
                                                    <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10</option>
                                                    <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                                                    <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                                                    <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100</option>
                                                </select>
                                            </div>
                                            <button type="submit" class="btn btn-gradient-primary d-inline-flex align-items-center justify-content-center" style="width: 38px; height: 38px; padding: 0;" title="Filter">
                                                <i class="mdi mdi-filter"></i>
                                            </button>
                                            <a href="{{ route('keuangan.master-invoice.index') }}" class="btn btn-gradient-secondary d-inline-flex align-items-center justify-content-center" style="width: 38px; height: 38px; padding: 0;" title="Reset">
                                                <i class="mdi mdi-refresh"></i>
                                            </a>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <!-- MOBILE VERSION (PERSIS DASHBOARD) -->
                            <div class="filter-row-mobile d-block d-md-none">
                                <form method="GET" action="{{ route('keuangan.master-invoice.index') }}" id="filterFormMobile">
                                    <div class="row g-2">
                                        <div class="col-12 mb-2">
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="search" placeholder="No Invoice, Penerima, Objek..." value="{{ request('search') }}" style="border-top-right-radius: 0 !important; border-bottom-right-radius: 0 !important; border-right: none; height: 38px;">
                                                <button class="btn btn-gradient-primary d-flex align-items-center justify-content-center px-3" type="submit" style="border-top-left-radius: 0 !important; border-bottom-left-radius: 0 !important; border-top-right-radius: 4px !important; border-bottom-right-radius: 4px !important; height: 38px; box-shadow: none;">
                                                    <i class="mdi mdi-magnify" style="font-size: 1.15rem; color: #ffffff;"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="col-12 mb-2">
                                            <select class="form-select" name="category" onchange="document.getElementById('filterFormMobile').submit()" style="height: 38px;">
                                                <option value="all" {{ request('category') == 'all' ? 'selected' : '' }}>Semua Kategori</option>
                                                <option value="pra_landbank" {{ request('category') == 'pra_landbank' ? 'selected' : '' }}>Pra Land Bank (Lahan)</option>
                                                <option value="unit_cash" {{ request('category') == 'unit_cash' ? 'selected' : '' }}>Unit Cash</option>
                                                <option value="operasional" {{ request('category') == 'operasional' ? 'selected' : '' }}>Operasional</option>
                                            </select>
                                        </div>
                                        <div class="col-12 mb-2">
                                            <select class="form-select" name="status" onchange="document.getElementById('filterFormMobile').submit()" style="height: 38px;">
                                                <option value="all" {{ request('status') == 'all' ? 'selected' : '' }}>Semua Status</option>
                                                <option value="lunas" {{ request('status') == 'lunas' ? 'selected' : '' }}>Lunas</option>
                                                <option value="partial" {{ request('status') == 'partial' ? 'selected' : '' }}>Sebagian</option>
                                                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                            </select>
                                        </div>
                                        <div class="col-6 mb-2">
                                            <input type="date" class="form-control" name="start_date" value="{{ request('start_date') }}" title="Tanggal Mulai" style="height: 38px;">
                                        </div>
                                        <div class="col-6 mb-2">
                                            <input type="date" class="form-control" name="end_date" value="{{ request('end_date') }}" title="Tanggal Akhir" style="height: 38px;">
                                        </div>
                                        <div class="col-12 mb-2">
                                            <select class="form-select" name="per_page" onchange="document.getElementById('filterFormMobile').submit()" style="height: 38px;">
                                                <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10</option>
                                                <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                                                <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                                                <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100</option>
                                            </select>
                                        </div>
                                        <div class="col-6">
                                            <button type="submit" class="btn btn-gradient-primary w-100" style="height: 38px;" title="Filter">
                                                <i class="mdi mdi-filter"></i> Filter
                                            </button>
                                        </div>
                                        <div class="col-6">
                                            <a href="{{ route('keuangan.master-invoice.index') }}" class="btn btn-gradient-secondary w-100 d-inline-flex align-items-center justify-content-center" style="height: 38px;" title="Reset">
                                                <i class="mdi mdi-refresh"></i> Reset
                                            </a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-center" width="5%">No</th>
                                        <th width="14%">Nomor Invoice</th>
                                        <th width="12%">Kategori</th>
                                        <th width="22%">Judul / Objek Transaksi</th>
                                        <th width="15%">Pihak Penerima</th>
                                        <th width="14%" class="text-end">Total Tagihan</th>
                                        <th width="14%" class="text-end">Realisasi & Sisa</th>
                                        <th width="10%" class="text-center">Status</th>
                                        <th width="10%" class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($invoices as $idx => $inv)
                                        @php
                                            $percentPaid = $inv->total_amount > 0 ? min(100, round(($inv->paid_amount / $inv->total_amount) * 100)) : 0;
                                        @endphp
                                        <tr>
                                            <td class="text-center text-muted fw-bold">
                                                {{ $invoices->firstItem() + $idx }}
                                            </td>
                                            <td>
                                                <div class="fw-bold text-dark font-monospace" style="font-size: 0.88rem;">
                                                    {{ $inv->invoice_number }}
                                                </div>
                                                <small class="text-muted d-block" style="font-size: 11px;">
                                                    <i class="mdi mdi-calendar-blank me-1"></i>{{ $inv->invoice_date ? $inv->invoice_date->format('d/m/Y') : '-' }}
                                                </small>
                                            </td>
                                            <td>
                                                @if($inv->category === 'pra_landbank')
                                                    <span class="badge-cat badge-cat-pra">
                                                        <i class="mdi mdi-map-clock"></i> Pra Land Bank
                                                    </span>
                                                @elseif($inv->category === 'unit_cash')
                                                    <span class="badge-cat badge-cat-unit">
                                                        <i class="mdi mdi-home-outline"></i> Unit Cash
                                                    </span>
                                                @else
                                                    <span class="badge-cat badge-cat-ops">
                                                        <i class="mdi mdi-receipt"></i> {{ ucfirst($inv->category) }}
                                                    </span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="fw-bold text-dark" style="font-size: 0.88rem;">
                                                    {{ $inv->title }}
                                                </div>
                                                @if($inv->praLandbank)
                                                    <small class="text-muted d-block" style="font-size: 11px;">
                                                        <i class="mdi mdi-map-marker-outline"></i> {{ $inv->praLandbank->city ?? 'Lokasi Lahan' }} ({{ number_format($inv->praLandbank->area ?? 0, 0, ',', '.') }} m²)
                                                    </small>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="fw-semibold text-dark">
                                                    {{ $inv->recipient_name ?? '-' }}
                                                </div>
                                                @if($inv->recipient_contact)
                                                    <small class="text-muted d-block" style="font-size: 11px;">
                                                        <i class="mdi mdi-phone-outline"></i> {{ $inv->recipient_contact }}
                                                    </small>
                                                @endif
                                            </td>
                                            <td class="text-end">
                                                <div class="fw-bold text-dark" style="font-size: 0.9rem;">
                                                    Rp {{ number_format($inv->total_amount, 0, ',', '.') }}
                                                </div>
                                                <small class="text-muted" style="font-size: 11px;">
                                                    Metode: <strong class="text-uppercase">{{ $inv->payment_method ?? 'Cash' }}</strong>
                                                </small>
                                            </td>
                                            <td class="text-end">
                                                <div class="fw-bold text-success" style="font-size: 0.85rem;">
                                                    Rp {{ number_format($inv->paid_amount, 0, ',', '.') }}
                                                </div>
                                                @if($inv->remaining_amount > 0)
                                                    <div class="text-warning" style="font-size: 11px; font-weight: 600;">
                                                        Sisa: Rp {{ number_format($inv->remaining_amount, 0, ',', '.') }}
                                                    </div>
                                                @endif
                                                <div class="progress mt-1" style="height: 4px;" title="{{ $percentPaid }}% Terbayar">
                                                    <div class="progress-bar {{ $percentPaid >= 100 ? 'bg-success' : 'bg-warning' }}" role="progressbar" style="width: {{ $percentPaid }}%"></div>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                @if($inv->payment_status === 'lunas')
                                                    <span class="badge-status-pill badge-status-lunas">
                                                        <i class="mdi mdi-check-circle-outline me-1"></i>Lunas
                                                    </span>
                                                @elseif($inv->payment_status === 'partial')
                                                    <span class="badge-status-pill badge-status-partial">
                                                        <i class="mdi mdi-clock-outline me-1"></i>Sebagian
                                                    </span>
                                                @elseif($inv->payment_status === 'cancelled')
                                                    <span class="badge-status-pill badge-status-cancelled">
                                                        Batal
                                                    </span>
                                                @else
                                                    <span class="badge-status-pill badge-status-pending">
                                                        <i class="mdi mdi-alert-circle-outline me-1"></i>Pending
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <div class="d-inline-flex gap-1">
                                                    <!-- Tombol Detail / Preview -->
                                                    <button type="button" class="btn-action-icon" title="Lihat Detail Invoice" onclick="showInvoiceDetail({{ $inv->id }})">
                                                        <i class="mdi mdi-eye-outline"></i>
                                                    </button>

                                                    <!-- Tombol Cetak / PDF Format Resmi -->
                                                    @if($inv->pra_landbank_id)
                                                        <a href="{{ route('pra-landbank.invoice', $inv->pra_landbank_id) }}" target="_blank" class="btn-action-icon btn-action-print" title="Cetak Format Resmi Pra Land Bank">
                                                            <i class="mdi mdi-printer"></i>
                                                        </a>
                                                    @else
                                                        <button type="button" class="btn-action-icon btn-action-print" title="Cetak Rincian Invoice" onclick="printInvoiceDirect({{ $inv->id }})">
                                                            <i class="mdi mdi-printer"></i>
                                                        </button>
                                                    @endif

                                                    <!-- Tombol Edit / Update Pembayaran -->
                                                    <button type="button" class="btn-action-icon btn-action-edit" title="Update Pembayaran / Status" onclick="openEditModal({{ json_encode($inv) }})">
                                                        <i class="mdi mdi-pencil-outline"></i>
                                                    </button>

                                                    <!-- Tombol Hapus -->
                                                    <button type="button" class="btn-action-icon btn-action-delete" title="Hapus Invoice" onclick="confirmDeleteInvoice({{ $inv->id }}, '{{ $inv->invoice_number }}')">
                                                        <i class="mdi mdi-trash-can-outline"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="9" class="text-center py-5">
                                                <div class="text-muted">
                                                    <i class="mdi mdi-file-document-outline fs-1 d-block mb-2 text-secondary"></i>
                                                    <h6 class="fw-bold mb-1">Belum Ada Data Invoice Tersimpan</h6>
                                                    <p class="mb-3 text-muted" style="font-size: 0.85rem;">Data transaksi Pra Land Bank atau invoice baru akan otomatis tercatat di sini.</p>
                                                    <button type="button" class="btn btn-sm btn-primary px-3" onclick="syncAllInvoices()">
                                                        <i class="mdi mdi-sync me-1"></i> Sinkronkan Data Pra Land Bank Sekarang
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- PAGINATION - PERSIS DASHBOARD -->
                        @if ($invoices instanceof \Illuminate\Pagination\LengthAwarePaginator && $invoices->total() > 0)
                            <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mt-4">
                                <div class="pagination-info mb-2 mb-sm-0">
                                    Menampilkan {{ $invoices->firstItem() }} - {{ $invoices->lastItem() }} dari
                                    {{ $invoices->total() }} data
                                </div>
                                <nav aria-label="Page navigation">
                                    <ul class="pagination pagination-sm flex-wrap justify-content-center mb-0">
                                        {{-- Previous Page Link --}}
                                        @if ($invoices->onFirstPage())
                                            <li class="page-item disabled" aria-disabled="true">
                                                <span class="page-link" aria-label="Previous">
                                                    <i class="mdi mdi-chevron-left"></i>
                                                </span>
                                            </li>
                                        @else
                                            <li class="page-item">
                                                <a class="page-link"
                                                    href="{{ $invoices->appends(request()->query())->previousPageUrl() }}"
                                                    rel="prev" aria-label="Previous">
                                                    <i class="mdi mdi-chevron-left"></i>
                                                </a>
                                            </li>
                                        @endif

                                        {{-- Pagination Elements --}}
                                        @foreach ($invoices->getUrlRange(max(1, $invoices->currentPage() - 2), min($invoices->lastPage(), $invoices->currentPage() + 2)) as $page => $url)
                                            @if ($page == $invoices->currentPage())
                                                <li class="page-item active" aria-current="page">
                                                    <span class="page-link">{{ $page }}</span>
                                                </li>
                                            @else
                                                <li class="page-item">
                                                    <a class="page-link"
                                                        href="{{ $invoices->appends(request()->query())->url($page) }}">{{ $page }}</a>
                                                </li>
                                            @endif
                                        @endforeach

                                        {{-- Next Page Link --}}
                                        @if ($invoices->hasMorePages())
                                            <li class="page-item">
                                                <a class="page-link"
                                                    href="{{ $invoices->appends(request()->query())->nextPageUrl() }}"
                                                    rel="next" aria-label="Next">
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

    <!-- ========================================================================= -->
    <!-- MODAL DETAIL INVOICE -->
    <!-- ========================================================================= -->
    <div class="modal fade" id="modalDetailInvoice" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg" style="border-radius: 12px;">
                <div class="modal-header text-white" style="background: linear-gradient(135deg, #da8cff, #9a55ff); border-radius: 12px 12px 0 0;">
                    <div class="d-flex align-items-center gap-2">
                        <i class="mdi mdi-receipt-text-outline fs-4"></i>
                        <div>
                            <h5 class="modal-title fw-bold mb-0 text-white" id="modalDetailTitle">Detail Invoice</h5>
                            <span class="text-white-50" style="font-size: 11px;" id="modalDetailNumber">-</span>
                        </div>
                    </div>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4" id="modalDetailBody">
                    <div class="text-center py-4">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light border-top d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary px-3" data-bs-dismiss="modal">Tutup</button>
                    <a href="#" target="_blank" id="modalBtnPrintOfficial" class="btn btn-primary px-3">
                        <i class="mdi mdi-printer me-1"></i> Buka Format Cetak Resmi
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- ========================================================================= -->
    <!-- MODAL TAMBAH INVOICE MANUAL -->
    <!-- ========================================================================= -->
    <div class="modal fade" id="modalCreateInvoice" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg" style="border-radius: 12px;">
                <form id="formCreateInvoice" onsubmit="submitCreateInvoice(event)">
                    @csrf
                    <div class="modal-header bg-white border-bottom py-3 px-4">
                        <div class="d-flex align-items-center gap-2">
                            <div class="p-2 rounded-2 bg-soft-primary text-primary">
                                <i class="mdi mdi-plus-box-multiple fs-5"></i>
                            </div>
                            <h5 class="modal-title fw-bold text-dark mb-0">Tambah Invoice Baru (Keuangan)</h5>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Nomor Invoice (Opsional)</label>
                                <input type="text" class="form-control" name="invoice_number" placeholder="Otomatis jika dikosongkan (cth: INV-OPS/2026/00001)">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Kategori Transaksi <span class="text-danger">*</span></label>
                                <select class="form-select" name="category" required>
                                    <option value="operasional">Operasional Keuangan</option>
                                    <option value="pra_landbank">Pengadaan Pra Land Bank</option>
                                    <option value="unit_cash">Penjualan Unit Cash</option>
                                    <option value="lainnya">Lain-lain</option>
                                </select>
                            </div>

                            <div class="col-12">
                                <label class="form-label fw-bold">Judul / Peruntukan Invoice <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="title" placeholder="Contoh: Biaya Notaris Pengadaan Lahan Menteng" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold">Nama Pihak Penerima / Pembayar <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="recipient_name" placeholder="Nama Pemilik / Mitra / Rekanan" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Kontak / Telepon (Opsional)</label>
                                <input type="text" class="form-control" name="recipient_contact" placeholder="0812xxxxxx">
                            </div>

                            <div class="col-md-4">
                                <label class="form-label fw-bold">Total Nilai Invoice (Rp) <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="total_amount" id="createTotalAmount" placeholder="Contoh: 100.000.000" onkeyup="formatRupiahInput(this)" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Nominal Terbayar (Rp)</label>
                                <input type="text" class="form-control" name="paid_amount" id="createPaidAmount" placeholder="Contoh: 50.000.000" onkeyup="formatRupiahInput(this)">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Status Pembayaran <span class="text-danger">*</span></label>
                                <select class="form-select" name="payment_status" required>
                                    <option value="pending">Pending (Belum Bayar)</option>
                                    <option value="partial">Sebagian (Partial)</option>
                                    <option value="lunas">Lunas (100%)</option>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label fw-bold">Metode Pembayaran</label>
                                <select class="form-select" name="payment_method">
                                    <option value="transfer">Transfer Bank</option>
                                    <option value="cash">Tunai / Cash</option>
                                    <option value="termin">Termin / Bertahap</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Tanggal Invoice <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" name="invoice_date" value="{{ date('Y-m-d') }}" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Jatuh Tempo</label>
                                <input type="date" class="form-control" name="due_date">
                            </div>

                            <div class="col-12">
                                <label class="form-label fw-bold">Catatan / Keterangan Tambahan</label>
                                <textarea class="form-control" name="notes" rows="2" placeholder="Catatan perincian atau rekening tujuan..."></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer bg-light border-top">
                        <button type="button" class="btn btn-secondary px-3" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary px-4 fw-bold" id="btnSubmitCreate">
                            <i class="mdi mdi-content-save me-1"></i> Simpan Invoice
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- ========================================================================= -->
    <!-- MODAL EDIT / UPDATE STATUS PEMBAYARAN -->
    <!-- ========================================================================= -->
    <div class="modal fade" id="modalEditInvoice" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg" style="border-radius: 12px;">
                <form id="formEditInvoice" onsubmit="submitEditInvoice(event)">
                    @csrf
                    <input type="hidden" id="editInvoiceId">
                    <div class="modal-header bg-white border-bottom py-3 px-4">
                        <div class="d-flex align-items-center gap-2">
                            <div class="p-2 rounded-2 bg-soft-info text-info">
                                <i class="mdi mdi-cash-sync fs-5"></i>
                            </div>
                            <div>
                                <h5 class="modal-title fw-bold text-dark mb-0">Update Status Pembayaran</h5>
                                <span class="text-muted" style="font-size: 11px;" id="editInvoiceNumberBadge">-</span>
                            </div>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label fw-bold">Judul Transaksi</label>
                                <input type="text" class="form-control" id="editTitle" name="title" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-bold">Nama Pihak Penerima</label>
                                <input type="text" class="form-control" id="editRecipientName" name="recipient_name" required>
                            </div>
                            <div class="col-6">
                                <label class="form-label fw-bold">Total Nilai Tagihan (Rp)</label>
                                <input type="text" class="form-control" id="editTotalAmount" name="total_amount" onkeyup="formatRupiahInput(this)" required>
                            </div>
                            <div class="col-6">
                                <label class="form-label fw-bold">Realisasi Terbayar (Rp)</label>
                                <input type="text" class="form-control" id="editPaidAmount" name="paid_amount" onkeyup="formatRupiahInput(this)">
                            </div>
                            <div class="col-6">
                                <label class="form-label fw-bold">Status Pembayaran</label>
                                <select class="form-select" id="editPaymentStatus" name="payment_status" required>
                                    <option value="pending">Pending</option>
                                    <option value="partial">Sebagian (Partial)</option>
                                    <option value="lunas">Lunas</option>
                                    <option value="cancelled">Batal</option>
                                </select>
                            </div>
                            <div class="col-6">
                                <label class="form-label fw-bold">Metode Pembayaran</label>
                                <select class="form-select" id="editPaymentMethod" name="payment_method">
                                    <option value="transfer">Transfer Bank</option>
                                    <option value="cash">Tunai / Cash</option>
                                    <option value="termin">Termin</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-bold">Catatan Pembayaran</label>
                                <textarea class="form-control" id="editNotes" name="notes" rows="2"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer bg-light border-top">
                        <button type="button" class="btn btn-secondary px-3" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary px-4 fw-bold" id="btnSubmitEdit">
                            <i class="mdi mdi-check-circle me-1"></i> Perbarui Status
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function formatRupiahInput(el) {
            let val = el.value.replace(/[^0-9]/g, '');
            el.value = val ? parseInt(val, 10).toLocaleString('id-ID') : '';
        }

        function formatRupiahNumber(num) {
            return 'Rp ' + (parseFloat(num) || 0).toLocaleString('id-ID');
        }

        function formatDateIndo(dateStr) {
            if (!dateStr) return '-';
            try {
                const cleanDate = dateStr.split('T')[0];
                const parts = cleanDate.split('-');
                if (parts.length === 3) {
                    const year = parseInt(parts[0], 10);
                    const month = parseInt(parts[1], 10) - 1;
                    const day = parseInt(parts[2], 10);
                    const months = [
                        'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                        'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
                    ];
                    return `${day} ${months[month] || ''} ${year}`;
                }
                const d = new Date(dateStr);
                if (isNaN(d.getTime())) return dateStr;
                return d.toLocaleDateString('id-ID', {
                    day: 'numeric',
                    month: 'long',
                    year: 'numeric'
                });
            } catch (e) {
                return dateStr;
            }
        }

        // ==========================================
        // SINKRONISASI MASSAL TRANSAKSI KE INVOICE DB
        // ==========================================
        async function syncAllInvoices() {
            const syncIcon = document.getElementById('syncIcon');
            if (syncIcon) syncIcon.classList.add('mdi-spin');

            Swal.fire({
                title: 'Menyinkronkan Database Invoice...',
                text: 'Sistem sedang membaca seluruh data pengadaan Pra Land Bank dan memperbarui tabel Master Invoice...',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            try {
                const res = await fetch("{{ route('keuangan.master-invoice.sync-all') }}", {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                    }
                });
                const data = await res.json();

                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Sinkronisasi Berhasil!',
                        text: data.message,
                        confirmButtonColor: '#7c3aed'
                    }).then(() => {
                        window.location.reload();
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal Sinkronisasi',
                        text: data.message || 'Terjadi kesalahan sistem.'
                    });
                }
            } catch (err) {
                console.error(err);
                Swal.fire({
                    icon: 'error',
                    title: 'Kesalahan Jaringan',
                    text: 'Tidak dapat menghubungi server: ' + err.message
                });
            } finally {
                if (syncIcon) syncIcon.classList.remove('mdi-spin');
            }
        }

        // ==========================================
        // LIHAT DETAIL INVOICE (MODAL)
        // ==========================================
        async function showInvoiceDetail(id) {
            const modalEl = document.getElementById('modalDetailInvoice');
            const modal = new bootstrap.Modal(modalEl);
            modal.show();

            const body = document.getElementById('modalDetailBody');
            body.innerHTML = `
                <div class="text-center py-4">
                    <div class="spinner-border text-primary" role="status"></div>
                    <p class="text-muted mt-2 mb-0" style="font-size: 13px;">Memuat data rincian invoice...</p>
                </div>
            `;

            try {
                const res = await fetch(`{{ url('/keuangan/master-invoice') }}/${id}`, {
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });
                const result = await res.json();

                if (!result.success || !result.data) {
                    body.innerHTML = `<div class="alert alert-danger">${result.message || 'Gagal memuat detail invoice.'}</div>`;
                    return;
                }

                const inv = result.data;
                document.getElementById('modalDetailTitle').innerText = inv.title;
                document.getElementById('modalDetailNumber').innerText = inv.invoice_number;

                const printBtn = document.getElementById('modalBtnPrintOfficial');
                if (result.print_url) {
                    printBtn.href = result.print_url;
                    printBtn.style.display = 'inline-flex';
                } else {
                    printBtn.style.display = 'none';
                }

                let statusBadge = '';
                if (inv.payment_status === 'lunas') {
                    statusBadge = '<span class="badge bg-success py-1 px-3">LUNAS</span>';
                } else if (inv.payment_status === 'partial') {
                    statusBadge = '<span class="badge bg-warning text-dark py-1 px-3">SEBAGIAN (PARTIAL)</span>';
                } else {
                    statusBadge = '<span class="badge bg-danger py-1 px-3">PENDING</span>';
                }

                let paymentsHtml = '';
                if (inv.pra_landbank && inv.pra_landbank.payments && inv.pra_landbank.payments.length > 0) {
                    paymentsHtml = `
                        <h6 class="fw-bold mt-4 mb-2 text-dark"><i class="mdi mdi-calendar-clock text-primary me-1"></i> Rincian Realisasi Pembayaran Bertahap</h6>
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered">
                                <thead class="table-light">
                                    <tr>
                                        <th>Tahap / Deskripsi</th>
                                        <th>Saluran / Bank</th>
                                        <th>Jatuh Tempo</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-end">Nominal (Rp)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    ${inv.pra_landbank.payments.map(p => `
                                        <tr>
                                            <td class="fw-semibold">${p.term_name || '-'}</td>
                                            <td>${p.bank_name ? `${p.bank_name} (${p.account_number || '-'})` : (p.payment_type || 'Cash')}</td>
                                            <td>${formatDateIndo(p.due_date)}</td>
                                            <td class="text-center"><span class="badge ${p.status === 'lunas' ? 'bg-success' : 'bg-warning text-dark'}">${(p.status || '').toUpperCase()}</span></td>
                                            <td class="text-end fw-bold">${formatRupiahNumber(p.amount)}</td>
                                        </tr>
                                    `).join('')}
                                </tbody>
                            </table>
                        </div>
                    `;
                }

                body.innerHTML = `
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="p-3 bg-light rounded-3 border">
                                <small class="text-muted fw-bold d-block text-uppercase" style="font-size: 11px;">Informasi Pihak & Tagihan</small>
                                <table class="table table-sm table-borderless mb-0 mt-2" style="font-size: 13px;">
                                    <tr>
                                        <td class="text-muted" width="40%">Penerima / Pemilik:</td>
                                        <td class="fw-bold text-dark">${inv.recipient_name || '-'}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">Kontak HP/Telp:</td>
                                        <td>${inv.recipient_contact || '-'}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">Tanggal Invoice:</td>
                                        <td class="fw-bold text-dark">${formatDateIndo(inv.invoice_date)}</td>
                                    </tr>
                                    ${inv.due_date ? `
                                        <tr>
                                            <td class="text-muted">Jatuh Tempo:</td>
                                            <td class="fw-bold text-danger">${formatDateIndo(inv.due_date)}</td>
                                        </tr>
                                    ` : ''}
                                    <tr>
                                        <td class="text-muted">Metode Bayar:</td>
                                        <td class="fw-bold text-uppercase">${inv.payment_method || 'Cash'}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="p-3 bg-light rounded-3 border">
                                <small class="text-muted fw-bold d-block text-uppercase" style="font-size: 11px;">Status Finansial</small>
                                <table class="table table-sm table-borderless mb-0 mt-2" style="font-size: 13px;">
                                    <tr>
                                        <td class="text-muted" width="40%">Status Invoice:</td>
                                        <td>${statusBadge}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">Total Tagihan:</td>
                                        <td class="fw-bold text-dark fs-6">${formatRupiahNumber(inv.total_amount)}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">Sudah Terbayar:</td>
                                        <td class="fw-bold text-success">${formatRupiahNumber(inv.paid_amount)}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">Sisa Tagihan:</td>
                                        <td class="fw-bold text-danger">${formatRupiahNumber(inv.remaining_amount)}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        ${inv.notes ? `
                            <div class="col-12">
                                <div class="p-3 rounded-3 border bg-white">
                                    <small class="text-muted fw-bold d-block text-uppercase" style="font-size: 11px;">Catatan Tambahan:</small>
                                    <p class="mb-0 text-dark mt-1" style="font-size: 13px;">${inv.notes}</p>
                                </div>
                            </div>
                        ` : ''}

                        ${paymentsHtml}
                    </div>
                `;
            } catch (err) {
                console.error(err);
                body.innerHTML = `<div class="alert alert-danger">Terjadi kesalahan: ${err.message}</div>`;
            }
        }

        // ==========================================
        // TAMBAH INVOICE BARU (MANUAL)
        // ==========================================
        async function submitCreateInvoice(e) {
            e.preventDefault();
            const form = document.getElementById('formCreateInvoice');
            const btn = document.getElementById('btnSubmitCreate');
            btn.disabled = true;

            const formData = new FormData(form);

            try {
                const res = await fetch("{{ route('keuangan.master-invoice.store') }}", {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                    },
                    body: formData
                });
                const data = await res.json();

                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Tersimpan!',
                        text: data.message,
                        confirmButtonColor: '#7c3aed'
                    }).then(() => {
                        window.location.reload();
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal Menyimpan',
                        text: data.message || 'Harap periksa isian formulir.'
                    });
                }
            } catch (err) {
                console.error(err);
                Swal.fire({
                    icon: 'error',
                    title: 'Kesalahan Sistem',
                    text: err.message
                });
            } finally {
                btn.disabled = false;
            }
        }

        // ==========================================
        // EDIT / UPDATE STATUS PEMBAYARAN
        // ==========================================
        function openEditModal(inv) {
            document.getElementById('editInvoiceId').value = inv.id;
            document.getElementById('editInvoiceNumberBadge').innerText = inv.invoice_number;
            document.getElementById('editTitle').value = inv.title || '';
            document.getElementById('editRecipientName').value = inv.recipient_name || '';
            document.getElementById('editTotalAmount').value = inv.total_amount ? parseInt(inv.total_amount).toLocaleString('id-ID') : '';
            document.getElementById('editPaidAmount').value = inv.paid_amount ? parseInt(inv.paid_amount).toLocaleString('id-ID') : '';
            document.getElementById('editPaymentStatus').value = inv.payment_status || 'pending';
            document.getElementById('editPaymentMethod').value = inv.payment_method || 'transfer';
            document.getElementById('editNotes').value = inv.notes || '';

            const modal = new bootstrap.Modal(document.getElementById('modalEditInvoice'));
            modal.show();
        }

        async function submitEditInvoice(e) {
            e.preventDefault();
            const id = document.getElementById('editInvoiceId').value;
            const form = document.getElementById('formEditInvoice');
            const btn = document.getElementById('btnSubmitEdit');
            btn.disabled = true;

            const formData = new FormData(form);

            try {
                const res = await fetch(`{{ url('/keuangan/master-invoice') }}/${id}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                    },
                    body: formData
                });
                const data = await res.json();

                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: data.message,
                        confirmButtonColor: '#7c3aed'
                    }).then(() => {
                        window.location.reload();
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal Update',
                        text: data.message
                    });
                }
            } catch (err) {
                console.error(err);
                Swal.fire({
                    icon: 'error',
                    title: 'Kesalahan Sistem',
                    text: err.message
                });
            } finally {
                btn.disabled = false;
            }
        }

        // ==========================================
        // HAPUS INVOICE
        // ==========================================
        function confirmDeleteInvoice(id, number) {
            Swal.fire({
                title: 'Hapus Invoice?',
                text: `Apakah Anda yakin ingin menghapus invoice ${number} dari database?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#64748b',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then(async (result) => {
                if (result.isConfirmed) {
                    try {
                        const res = await fetch(`{{ url('/keuangan/master-invoice') }}/${id}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json',
                            }
                        });
                        const data = await res.json();

                        if (data.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Terhapus!',
                                text: data.message,
                                confirmButtonColor: '#7c3aed'
                            }).then(() => {
                                window.location.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: data.message
                            });
                        }
                    } catch (err) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Kesalahan',
                            text: err.message
                        });
                    }
                }
            });
        }
    </script>
@endpush
