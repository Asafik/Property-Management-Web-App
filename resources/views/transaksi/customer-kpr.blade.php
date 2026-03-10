@extends('layouts.partial.app')

@section('title', 'Daftar Customer KPR - Property Management App')

@section('content')
    <style>
        /* ===== CSS SAMA PERSIS DENGAN HALAMAN YANG ANDA BERIKAN ===== */
        .card {
            transition: all 0.3s ease;
            margin-bottom: 1rem;
        }

        .card:hover {
            box-shadow: 0 8px 25px rgba(154, 85, 255, 0.1) !important;
        }

        .card-header {
            background: linear-gradient(135deg, #ffffff, #f8f9fa);
            border-bottom: 1px solid #e9ecef;
            padding: 0.75rem;
        }

        @media (min-width: 576px) {
            .card-header {
                padding: 1rem;
            }
        }

        @media (min-width: 768px) {
            .card-header {
                padding: 1.2rem;
            }
        }

        .card-body {
            padding: 0.75rem;
        }

        @media (min-width: 576px) {
            .card-body {
                padding: 1rem;
            }
        }

        @media (min-width: 768px) {
            .card-body {
                padding: 1.2rem;
            }
        }

        /* Card Title */
        .card-title {
            font-size: 0.9rem;
            font-weight: 600;
            color: #9a55ff;
            margin-bottom: 0;
        }

        @media (min-width: 576px) {
            .card-title {
                font-size: 1rem;
            }
        }

        @media (min-width: 768px) {
            .card-title {
                font-size: 1.1rem;
            }
        }

        /* ===== FILTER SECTION ===== */
        .filter-card {
            background: linear-gradient(135deg, #f9f7ff, #f2ecff);
            border-radius: 12px;
            padding: 1rem;
            margin-bottom: 1.25rem;
        }

        .filter-card .card-body {
            padding: 1rem !important;
        }

        .filter-card .form-label {
            font-size: 0.85rem;
            font-weight: 600;
            color: #9a55ff !important;
            margin-bottom: 0.4rem;
            letter-spacing: 0.3px;
        }

        .filter-card .form-control,
        .filter-card .form-select {
            padding: 0.5rem 0.75rem;
            font-size: 0.9rem;
            border-radius: 8px;
            height: 40px;
            border: 1px solid #e0e4e9;
            width: 100%;
        }

        .filter-card .btn {
            padding: 0.5rem 0.75rem;
            font-size: 0.85rem;
            height: 40px;
            border-radius: 8px;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Form Controls */
        .form-control,
        .form-select {
            border: 1px solid #e9ecef;
            border-radius: 8px;
            padding: 0.6rem 0.8rem;
            font-size: 0.9rem;
            transition: all 0.2s ease;
            background-color: #ffffff;
            color: #2c2e3f;
            height: 40px;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #9a55ff;
            box-shadow: 0 0 0 3px rgba(154, 85, 255, 0.1);
            outline: none;
        }

        /* Form Label */
        .form-label {
            font-size: 0.85rem;
            font-weight: 600;
            color: #9a55ff !important;
            margin-bottom: 0.3rem;
            letter-spacing: 0.3px;
            font-family: 'Nunito', sans-serif;
        }

        /* Button Styling */
        .btn {
            font-size: 0.85rem;
            padding: 0.6rem 1rem;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
            font-family: 'Nunito', sans-serif;
            border: none;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .btn-sm {
            padding: 0.35rem 0.7rem;
            font-size: 0.8rem;
            border-radius: 6px;
            height: 32px;
        }

        .btn-gradient-primary {
            background: linear-gradient(to right, #da8cff, #9a55ff) !important;
            color: #ffffff !important;
        }

        .btn-gradient-secondary {
            background: #6c757d !important;
            color: #ffffff !important;
        }

        .btn-gradient-success {
            background: linear-gradient(135deg, #28a745, #5cb85c) !important;
            color: #ffffff !important;
        }

        .btn-gradient-danger {
            background: linear-gradient(135deg, #dc3545, #e4606d) !important;
            color: #ffffff !important;
        }

        .btn-gradient-warning {
            background: linear-gradient(135deg, #ffc107, #ffdb6d) !important;
            color: #2c2e3f !important;
        }

        .btn-gradient-info {
            background: linear-gradient(135deg, #17a2b8, #5bc0de) !important;
            color: #ffffff !important;
        }

        /* Badge Styling */
        .badge {
            padding: 0.35rem 0.6rem;
            font-size: 0.75rem;
            font-weight: 600;
            border-radius: 30px;
            display: inline-block;
            white-space: nowrap;
        }

        @media (min-width: 576px) {
            .badge {
                padding: 0.4rem 0.75rem;
                font-size: 0.8rem;
            }
        }

        .badge-gradient-success {
            background: linear-gradient(135deg, #28a745, #5cb85c);
            color: #ffffff;
        }

        .badge-gradient-warning {
            background: linear-gradient(135deg, #ffc107, #ffdb6d);
            color: #2c2e3f;
        }

        .badge-gradient-info {
            background: linear-gradient(135deg, #17a2b8, #5bc0de);
            color: #ffffff;
        }

        .badge-gradient-danger {
            background: linear-gradient(135deg, #dc3545, #e4606d);
            color: #ffffff;
        }

        /* Badge Abu-abu untuk Lanjut KPR (tanpa icon) */
        .badge-gradient-gray {
            background: linear-gradient(135deg, #6c757d, #868e96);
            color: #ffffff;
        }

        /* ===== TABLE STYLING ===== */
        .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            border-radius: 8px;
            margin-bottom: 0.5rem;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 0;
        }

        .table thead th {
            background: linear-gradient(135deg, #f8f9fa, #f1f3f5);
            color: #9a55ff;
            font-weight: 600;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 2px solid #e9ecef;
            padding: 0.8rem 0.5rem;
            white-space: nowrap;
        }

        @media (min-width: 576px) {
            .table thead th {
                font-size: 0.85rem;
                padding: 0.9rem 0.6rem;
            }
        }

        @media (min-width: 768px) {
            .table thead th {
                font-size: 0.9rem;
                padding: 1rem 0.75rem;
            }
        }

        .table thead th:first-child {
            padding-left: 0.75rem;
            width: 60px;
        }

        .table tbody td:first-child {
            padding-left: 0.75rem;
            font-weight: 500;
            width: 60px;
        }

        .table tbody td {
            vertical-align: middle;
            font-size: 0.85rem;
            padding: 0.8rem 0.5rem;
            border-bottom: 1px solid #e9ecef;
            color: #2c2e3f;
        }

        @media (min-width: 576px) {
            .table tbody td {
                font-size: 0.9rem;
                padding: 0.9rem 0.6rem;
            }
        }

        @media (min-width: 768px) {
            .table tbody td {
                font-size: 0.95rem;
                padding: 1rem 0.75rem;
            }
        }

        .table tbody tr:hover {
            background-color: #f8f9fa;
        }

        .table tbody td i {
            font-size: 1rem;
        }

        /* ===== ACTION BUTTONS ===== */
        .aksi-wrapper {
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .btn-doc-icon {
            width: 36px;
            height: 36px;
            border-radius: 8px;
            border: none;
            background: linear-gradient(135deg, #da8cff, #9a55ff) !important;
            color: #fff !important;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: all 0.25s ease;
            box-shadow: 0 4px 12px rgba(154, 85, 255, 0.20);
            text-decoration: none !important;
        }

        .btn-doc-icon i {
            font-size: 1.1rem !important;
        }

        .btn-doc-icon:hover {
            transform: translateY(-2px);
            color: #fff !important;
            box-shadow: 0 8px 18px rgba(154, 85, 255, 0.28);
            text-decoration: none !important;
        }

        .btn-doc-icon:active {
            transform: translateY(0);
            text-decoration: none !important;
        }

        /* Button Approve - Bold dan tanpa garis bawah */
        .btn-approve-sm {
            height: 36px;
            padding: 0 1rem;
            font-size: 0.8rem;
            font-weight: 700 !important; /* Bold */
            border-radius: 8px;
            background: linear-gradient(135deg, #28a745, #5cb85c) !important;
            color: white !important;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.3rem;
            border: none;
            transition: all 0.25s ease;
            box-shadow: 0 4px 12px rgba(40, 167, 69, 0.2);
            text-decoration: none !important; /* Hapus garis bawah */
            letter-spacing: 0.3px;
        }

        .btn-approve-sm i {
            font-size: 1rem;
        }

        .btn-approve-sm:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 18px rgba(40, 167, 69, 0.3);
            color: white !important;
            text-decoration: none !important;
        }

        .btn-approve-sm:active {
            transform: translateY(0);
            text-decoration: none !important;
        }

        .btn-approve-sm.disabled,
        .btn-approve-sm:disabled {
            opacity: 0.5;
            pointer-events: none;
        }

        /* Teks Belum Upload */
        .text-belum-upload {
            font-size: 0.8rem;
            color: #a5b3cb;
            font-weight: 500;
        }

        .empty-state {
            text-align: center;
            padding: 2rem;
        }

        .empty-state i {
            font-size: 3rem;
            color: #ccc;
            margin-bottom: 1rem;
        }

        .empty-state p {
            color: #6c757d;
            margin-bottom: 0.25rem;
        }

        /* ===== MODAL STYLING ===== */
        .document-modal .modal-content {
            border: none;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }

        .document-modal .modal-header {
            background: linear-gradient(135deg, #f9f7ff, #f2ecff);
            border-bottom: 1px solid #ece6ff;
            padding: 1rem 1.25rem;
        }

        .document-modal .modal-title {
            color: #9a55ff;
            font-weight: 700;
        }

        .document-modal .modal-body {
            padding: 1.25rem;
            background: #fff;
        }

        .document-list {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }

        .document-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            border: 1px solid #ebe7f7;
            border-radius: 12px;
            padding: 0.85rem 1rem;
            background: #faf8ff;
            transition: all 0.2s ease;
        }

        .document-item:hover {
            background: #f4efff;
            border-color: #d9c8ff;
        }

        .document-info {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            min-width: 0;
            flex: 1;
        }

        .document-icon-box {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            background: linear-gradient(135deg, #da8cff, #9a55ff);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            font-size: 1.2rem;
        }

        .document-name {
            font-weight: 700;
            color: #2c2e3f;
            margin-bottom: 0;
            word-break: break-word;
        }

        .btn-eye-purple {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            border: none;
            background: linear-gradient(135deg, #da8cff, #9a55ff) !important;
            color: #fff !important;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            transition: all 0.25s ease;
            box-shadow: 0 4px 12px rgba(154, 85, 255, 0.20);
        }

        .btn-eye-purple i {
            font-size: 1rem !important;
        }

        .btn-eye-purple:hover {
            transform: translateY(-2px);
            color: #fff !important;
            box-shadow: 0 8px 18px rgba(154, 85, 255, 0.28);
        }

        .empty-document-box {
            text-align: center;
            padding: 1.5rem 1rem;
            border: 1px dashed #d7c7ff;
            border-radius: 14px;
            background: #faf8ff;
        }

        .empty-document-box i {
            font-size: 2.2rem;
            color: #b399f7;
            opacity: 0.8;
        }

        .modal-customer-meta {
            background: #faf8ff;
            border: 1px solid #ece6ff;
            border-radius: 12px;
            padding: 0.85rem 1rem;
            margin-bottom: 1rem;
        }

        .modal-customer-meta .meta-row {
            display: flex;
            flex-wrap: wrap;
            gap: 0.75rem 1rem;
            font-size: 0.9rem;
            color: #4f566b;
        }

        .modal-customer-meta .meta-row span strong {
            color: #2c2e3f;
        }

        /* Pagination */
        .pagination {
            margin: 0;
            gap: 3px;
        }

        .page-item .page-link {
            border: 1px solid #e9ecef;
            padding: 0.4rem 0.8rem;
            font-size: 0.8rem;
            color: #6c7383;
            background-color: #ffffff;
            border-radius: 6px !important;
            transition: all 0.2s ease;
            min-width: 36px;
            text-align: center;
            text-decoration: none;
        }

        @media (min-width: 576px) {
            .page-item .page-link {
                padding: 0.45rem 0.9rem;
                font-size: 0.85rem;
                min-width: 40px;
            }
        }

        .page-item.active .page-link {
            background: linear-gradient(to right, #da8cff, #9a55ff);
            border-color: transparent;
            color: #ffffff;
            box-shadow: 0 4px 12px rgba(154, 85, 255, 0.3);
        }

        .page-item .page-link:hover {
            background-color: #f8f9fa;
            border-color: #9a55ff;
            color: #9a55ff;
            transform: translateY(-1px);
        }

        .pagination-info {
            font-size: 0.8rem;
            color: #6c7383;
        }

        /* Responsive */
        @media (max-width: 576px) {
            .aksi-wrapper {
                flex-direction: column;
                gap: 0.3rem;
            }

            .btn-doc-icon {
                width: 100%;
            }

            .btn-approve-sm {
                width: 100%;
            }
        }
    </style>

    <div class="container-fluid p-2 p-sm-3 p-md-4">
        <!-- Header -->
        <div class="row mb-3 mb-sm-3 mb-md-4">
            <div class="col-12">
                <div class="card shadow-sm border-0">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="mb-1 fw-bold text-dark">
                                <i class="mdi mdi-bank me-2" style="color: #9a55ff;"></i>
                                Daftar Customer KPR
                            </h4>
                            <p class="mb-0 text-muted small">
                                <i class="mdi mdi-information-outline me-1"></i>
                                Kelola data customer yang mengajukan KPR
                            </p>
                        </div>
                        <div class="d-none d-sm-block">
                            <i class="mdi mdi-account-group" style="font-size: 2.5rem; color: #9a55ff; opacity: 0.2;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabel -->
        <div class="row mt-2 mt-sm-2 mt-md-3">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-white">
                        <h5 class="card-title mb-0">
                            <i class="mdi mdi-format-list-bulleted me-2 text-primary"></i>
                            Daftar Customer KPR
                        </h5>
                    </div>

                    <div class="card-body">
                        <!-- FILTER SECTION -->
                        <div class="filter-card mb-4">
                            <div class="card-body">
                                <h6 class="card-title mb-3" style="font-size: 1rem;">
                                    <i class="mdi mdi-filter-outline me-1" style="color: #9a55ff;"></i>
                                    Filter Data
                                </h6>

                                <!-- MOBILE VERSION -->
                                <div class="d-block d-md-none">
                                    <form method="GET" action="{{ route('customer.kpr') }}">
                                        <div class="mb-3">
                                            <label class="form-label">
                                                <i class="mdi mdi-magnify me-1" style="color: #9a55ff;"></i>
                                                Cari Customer
                                            </label>
                                            <input type="text" class="form-control" name="search"
                                                value="{{ request('search') }}" placeholder="Cari nama customer...">
                                        </div>

                                        <div class="row g-2 mb-3">
                                            <div class="col-6">
                                                <label class="form-label">
                                                    <i class="mdi mdi-flag me-1" style="color: #9a55ff;"></i>Status
                                                </label>
                                                <select class="form-control" name="status">
                                                    <option value="">Semua</option>
                                                    <option value="booking" {{ request('status') == 'booking' ? 'selected' : '' }}>Booking</option>
                                                    <option value="proses" {{ request('status') == 'proses' ? 'selected' : '' }}>Proses</option>
                                                    <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                                                    <option value="lanjut_kpr" {{ request('status') == 'lanjut_kpr' ? 'selected' : '' }}>Lanjut KPR</option>
                                                </select>
                                            </div>
                                            <div class="col-6">
                                                <label class="form-label">
                                                    <i class="mdi mdi-counter me-1" style="color: #9a55ff;"></i>Tampil
                                                </label>
                                                <select class="form-control" name="per_page">
                                                    <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10</option>
                                                    <option value="15" {{ request('per_page') == 15 ? 'selected' : '' }}>15</option>
                                                    <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row g-2">
                                            <div class="col-6">
                                                <button type="submit" class="btn btn-gradient-primary w-100 py-2">
                                                    <i class="mdi mdi-filter me-1"></i> Filter
                                                </button>
                                            </div>
                                            <div class="col-6">
                                                <a href="{{ route('customer.kpr') }}" class="btn btn-gradient-secondary w-100 py-2">
                                                    <i class="mdi mdi-refresh me-1"></i> Reset
                                                </a>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <!-- DESKTOP VERSION -->
                                <div class="d-none d-md-block">
                                    <form method="GET" action="{{ route('customer.kpr') }}">
                                        <div class="row g-2 align-items-end">
                                            <div class="col-md-4">
                                                <label class="form-label">
                                                    <i class="mdi mdi-magnify me-1" style="color: #9a55ff;"></i>
                                                    Cari Customer
                                                </label>
                                                <input type="text" class="form-control" name="search"
                                                    value="{{ request('search') }}" placeholder="Cari nama customer...">
                                            </div>

                                            <div class="col-md-3">
                                                <label class="form-label">
                                                    <i class="mdi mdi-flag me-1" style="color: #9a55ff;"></i>Status
                                                </label>
                                                <select class="form-control" name="status">
                                                    <option value="">Semua</option>
                                                    <option value="booking" {{ request('status') == 'booking' ? 'selected' : '' }}>Booking</option>
                                                    <option value="proses" {{ request('status') == 'proses' ? 'selected' : '' }}>Proses</option>
                                                    <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                                                    <option value="lanjut_kpr" {{ request('status') == 'lanjut_kpr' ? 'selected' : '' }}>Lanjut KPR</option>
                                                </select>
                                            </div>

                                            <div class="col-md-2">
                                                <label class="form-label">
                                                    <i class="mdi mdi-counter me-1" style="color: #9a55ff;"></i>Tampil
                                                </label>
                                                <select class="form-control" name="per_page">
                                                    <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10</option>
                                                    <option value="15" {{ request('per_page') == 15 ? 'selected' : '' }}>15</option>
                                                    <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                                                </select>
                                            </div>

                                            <div class="col-md-1">
                                                <label class="form-label invisible">Filter</label>
                                                <button type="submit" class="btn btn-gradient-primary w-100" style="height: 40px;">
                                                    <i class="mdi mdi-filter"></i>
                                                </button>
                                            </div>

                                            <div class="col-md-1">
                                                <label class="form-label invisible">Reset</label>
                                                <a href="{{ route('customer.kpr') }}" class="btn btn-gradient-secondary w-100" style="height: 40px; display: flex; align-items: center; justify-content: center; text-decoration: none;">
                                                    <i class="mdi mdi-refresh"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- TABEL DATA -->
                        <div class="table-responsive">
                            <table class="table table-hover align-middle" id="tableCustomerKPR">
                                <thead>
                                    <tr>
                                        <th class="text-center" width="5%">NO</th>
                                        <th width="18%">NAMA CUSTOMER</th>
                                        <th width="10%">UNIT</th>
                                        <th width="15%">HARGA</th>
                                        <th width="12%">SALES</th>
                                        <th width="12%">STATUS</th>
                                        <th width="15%">TANGGAL BOOKING</th>
                                        <th class="text-center" width="13%">AKSI</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($bookings ?? [] as $key => $booking)
                                        <tr>
                                            <td class="text-center fw-bold">
                                                <span class="badge bg-light text-dark">{{ $loop->iteration }}</span>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <i class="mdi mdi-account-circle text-primary me-2" style="font-size: 1.2rem;"></i>
                                                    <span class="fw-bold">{{ $booking->customer->full_name ?? '-' }}</span>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <i class="mdi mdi-home-variant text-info me-2"></i>
                                                    {{ $booking->unit->unit_code ?? '-' }}
                                                </div>
                                            </td>
                                            <td>
                                                <span class="fw-bold text-success">
                                                    Rp {{ number_format($booking->unit->price ?? 0, 0, ',', '.') }}
                                                </span>
                                            </td>
                                            <td>
                                                @if ($booking->sales)
                                                    <div class="d-flex align-items-center">
                                                        <i class="mdi mdi-account-tie text-warning me-1"></i>
                                                        {{ $booking->sales->name }}
                                                    </div>
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($booking->status == 'booking')
                                                    <span class="badge badge-gradient-warning">
                                                        <i class="mdi mdi-clock-outline me-1"></i>BOOKING
                                                    </span>
                                                @elseif($booking->status == 'proses')
                                                    <span class="badge badge-gradient-info">
                                                        <i class="mdi mdi-progress-check me-1"></i>PROSES
                                                    </span>
                                                @elseif($booking->status == 'approved')
                                                    <span class="badge badge-gradient-success">
                                                        <i class="mdi mdi-check-circle me-1"></i>APPROVED
                                                    </span>
                                                @elseif($booking->status == 'lanjut_kpr')
                                                    {{-- Abu-abu tanpa icon --}}
                                                    <span class="badge badge-gradient-gray">
                                                        LANJUT KPR
                                                    </span>
                                                @else
                                                    <span class="badge bg-secondary">
                                                        {{ strtoupper(str_replace('_', ' ', $booking->status)) }}
                                                    </span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <i class="mdi mdi-calendar text-primary me-1"></i>
                                                    {{ \Carbon\Carbon::parse($booking->created_at)->format('d M Y') }}
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                @php
                                                    $documents = json_decode($booking->kprApplication?->documents, true);
                                                    $documentCount = is_array($documents) ? count($documents) : 0;
                                                @endphp

                                                <div class="aksi-wrapper">
                                                    @if ($documentCount > 0)
                                                        <button type="button" class="btn-doc-icon btnOpenDocumentModal"
                                                            data-bs-toggle="modal" data-bs-target="#documentModal"
                                                            data-customer="{{ $booking->customer->full_name ?? '-' }}"
                                                            data-unit="{{ $booking->unit->unit_code ?? '-' }}"
                                                            data-status="{{ strtoupper(str_replace('_', ' ', $booking->status ?? '-')) }}"
                                                            data-harga="Rp {{ number_format($booking->unit->price ?? 0, 0, ',', '.') }}"
                                                            data-booking="{{ \Carbon\Carbon::parse($booking->created_at)->format('d M Y') }}"
                                                            data-approve-url="{{ route('transaksi.kpr.approve', $booking->id) }}"
                                                            data-documents='@json($documents)'
                                                            title="Lihat Dokumen">
                                                            <i class="mdi mdi-file-document-outline"></i>
                                                        </button>

                                                        <a href="{{ route('transaksi.kpr.approve', $booking->id) }}"
                                                            class="btn-approve-sm">
                                                            <i class="mdi mdi-check"></i> APPROVE
                                                        </a>
                                                    @else
                                                        <span class="text-belum-upload">Belum upload</span>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="empty-state">
                                                <i class="mdi mdi-account-off"></i>
                                                <p class="fw-bold">Tidak ada data customer KPR</p>
                                                <p class="text-muted small">Belum ada customer yang mengajukan KPR.</p>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- PAGINATION -->
                        @if (($bookings->count() ?? 0) > 0)
                            <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mt-4">
                                <div class="pagination-info mb-2 mb-sm-0">
                                    <i class="mdi mdi-information-outline me-1 text-primary"></i>
                                    Menampilkan
                                    <span class="fw-bold">{{ $bookings->firstItem() }}</span>
                                    -
                                    <span class="fw-bold">{{ $bookings->lastItem() }}</span>
                                    dari
                                    <span class="fw-bold">{{ $bookings->total() }}</span>
                                    data
                                </div>

                                <nav aria-label="Page navigation">
                                    <ul class="pagination pagination-sm flex-wrap justify-content-center mb-0">
                                        @if ($bookings->onFirstPage())
                                            <li class="page-item disabled">
                                                <span class="page-link">
                                                    <i class="mdi mdi-chevron-left"></i>
                                                </span>
                                            </li>
                                        @else
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $bookings->previousPageUrl() }}">
                                                    <i class="mdi mdi-chevron-left"></i>
                                                </a>
                                            </li>
                                        @endif

                                        @foreach ($bookings->getUrlRange(1, $bookings->lastPage()) as $page => $url)
                                            <li class="page-item {{ $bookings->currentPage() == $page ? 'active' : '' }}">
                                                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                            </li>
                                        @endforeach

                                        @if ($bookings->hasMorePages())
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $bookings->nextPageUrl() }}">
                                                    <i class="mdi mdi-chevron-right"></i>
                                                </a>
                                            </li>
                                        @else
                                            <li class="page-item disabled">
                                                <span class="page-link">
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

        <!-- Tombol Kembali -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-body p-3">
                        <a href="{{ route('dashboard') }}" class="btn btn-gradient-secondary" style="text-decoration: none;">
                            <i class="mdi mdi-arrow-left me-1"></i>
                            Kembali ke Dashboard
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL DOKUMEN -->
    <div class="modal fade document-modal" id="documentModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="mdi mdi-file-document-multiple-outline me-2"></i>
                        Dokumen KPR
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="modal-customer-meta">
                        <div class="meta-row">
                            <span><strong>Customer:</strong> <span id="modalCustomerName">-</span></span>
                            <span><strong>Unit:</strong> <span id="modalUnit">-</span></span>
                            <span><strong>Status:</strong> <span id="modalStatus">-</span></span>
                            <span><strong>Harga:</strong> <span id="modalHarga">-</span></span>
                            <span><strong>Tgl Booking:</strong> <span id="modalBookingDate">-</span></span>
                        </div>
                    </div>

                    <div id="documentListWrapper">
                        <div class="document-list" id="documentList"></div>
                    </div>

                    <div class="mt-4 text-end">
                        <a href="javascript:void(0)" id="modalApproveBtn" class="btn btn-gradient-success" style="font-weight: 700; text-decoration: none;">
                            <i class="mdi mdi-check me-1"></i>
                            APPROVE KPR
                        </a>
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
            // SweetAlert untuk notifikasi
            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: "{{ session('success') }}",
                    timer: 2000,
                    showConfirmButton: false
                });
            @endif

            @if (session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: "{{ session('error') }}",
                    timer: 2000,
                    showConfirmButton: false
                });
            @endif

            // Fungsi untuk format nama dokumen
            function formatDocName(type) {
                if (!type) return 'Dokumen';
                return type.replace(/_/g, ' ').replace(/\b\w/g, function(l) {
                    return l.toUpperCase();
                });
            }

            // Event untuk membuka modal dokumen
            $(document).on('click', '.btnOpenDocumentModal', function() {
                let customer = $(this).data('customer') || '-';
                let unit = $(this).data('unit') || '-';
                let status = $(this).data('status') || '-';
                let harga = $(this).data('harga') || '-';
                let bookingDate = $(this).data('booking') || '-';
                let approveUrl = $(this).data('approve-url') || '#';
                let documents = $(this).data('documents') || [];

                $('#modalCustomerName').text(customer);
                $('#modalUnit').text(unit);
                $('#modalStatus').text(status);
                $('#modalHarga').text(harga);
                $('#modalBookingDate').text(bookingDate);
                $('#modalApproveBtn').attr('href', approveUrl);
                $('#modalApproveBtn').attr('data-customer-name', customer);

                let html = '';

                if (Array.isArray(documents) && documents.length > 0) {
                    documents.forEach(function(doc) {
                        let docName = formatDocName(doc.type);
                        let docPath = doc.path ? doc.path : '';
                        let docUrl = "{{ asset('storage') }}/" + docPath;

                        html += `
                            <div class="document-item">
                                <div class="document-info">
                                    <div class="document-icon-box">
                                        <i class="mdi mdi-file-document-outline"></i>
                                    </div>
                                    <div>
                                        <div class="document-name">${docName}</div>
                                    </div>
                                </div>
                                <div class="document-actions">
                                    <a href="${docUrl}" target="_blank" class="btn-eye-purple" title="Lihat Dokumen">
                                        <i class="mdi mdi-eye-outline"></i>
                                    </a>
                                </div>
                            </div>
                        `;
                    });
                } else {
                    html = `
                        <div class="empty-document-box">
                            <i class="mdi mdi-file-cancel-outline"></i>
                            <p class="mt-2 mb-1 fw-bold">Belum ada dokumen</p>
                            <p class="text-muted mb-0 small">Customer ini belum upload dokumen KPR.</p>
                        </div>
                    `;
                }

                $('#documentList').html(html);
            });

            // Approve dari modal
            $(document).on('click', '#modalApproveBtn', function(e) {
                e.preventDefault();

                let href = $(this).attr('href');
                let customerName = $(this).attr('data-customer-name') || $('#modalCustomerName').text();

                if (href === '#') {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Perhatian',
                        text: 'URL approve tidak valid',
                    });
                    return;
                }

                Swal.fire({
                    title: 'Approve KPR?',
                    text: "Customer " + customerName + " akan di-approve",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#28a745',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, Approve',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = href;
                    }
                });
            });

            // Approve dari tombol di tabel
            $(document).on('click', '.btn-approve-sm', function(e) {
                let href = $(this).attr('href');
                let customerName = $(this).closest('tr').find('td:eq(1) span.fw-bold').text();

                e.preventDefault();

                Swal.fire({
                    title: 'Approve KPR?',
                    text: "Customer " + customerName + " akan di-approve",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#28a745',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, Approve',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = href;
                    }
                });
            });
        });
    </script>
@endpush
