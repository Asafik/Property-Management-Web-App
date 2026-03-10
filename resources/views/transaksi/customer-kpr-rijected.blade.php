@extends('layouts.partial.app')

@section('title', 'Daftar Customer KPR Rijected - Property Management App')

@section('content')

    <style>
        /* ===== SEMUA CSS SAMA PERSIS DENGAN HALAMAN DASHBOARD ===== */
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
            height: auto;
            min-height: 40px;
            border: 1px solid #e0e4e9;
        }

        .filter-card .btn {
            padding: 0.5rem 0.75rem;
            font-size: 0.85rem;
            min-height: 40px;
            border-radius: 8px;
            font-weight: 600;
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
            height: auto;
        }

        @media (min-width: 576px) {

            .form-control,
            .form-select {
                padding: 0.7rem 1rem;
                font-size: 0.95rem;
                border-radius: 10px;
            }
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

        @media (min-width: 576px) {
            .btn {
                font-size: 0.9rem;
                padding: 0.7rem 1.2rem;
                border-radius: 10px;
            }
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .btn-sm {
            padding: 0.35rem 0.7rem;
            font-size: 0.8rem;
            border-radius: 6px;
        }

        .btn-gradient-primary {
            background: linear-gradient(to right, #da8cff, #9a55ff) !important;
            color: #ffffff !important;
        }

        .btn-gradient-secondary {
            background: #6c757d !important;
            color: #ffffff !important;
        }

        .btn-gradient-secondary:hover {
            background: #5a6268 !important;
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

        .btn-gradient-purple {
            background: linear-gradient(135deg, #9a55ff, #b47aff) !important;
            color: #ffffff !important;
        }

        /* Outline Buttons */
        .btn-outline-primary {
            background: transparent;
            border: 1px solid #9a55ff;
            color: #9a55ff;
            padding: 0.4rem 0.75rem;
        }

        .btn-outline-primary:hover {
            background: linear-gradient(to right, #da8cff, #9a55ff);
            color: #ffffff;
            border-color: transparent;
        }

        .btn-outline-purple {
            background: transparent;
            border: 1px solid #9a55ff;
            color: #9a55ff;
            padding: 0.35rem 0.7rem;
            font-size: 0.8rem;
            border-radius: 6px;
        }

        .btn-outline-purple:hover {
            background: linear-gradient(135deg, #9a55ff, #b47aff);
            color: #ffffff;
            border-color: transparent;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(154, 85, 255, 0.2);
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

        @media (min-width: 768px) {
            .badge {
                padding: 0.45rem 0.8rem;
                font-size: 0.85rem;
            }
        }

        .badge-sm {
            padding: 0.25rem 0.5rem;
            font-size: 0.7rem;
        }

        .badge-gradient-success {
            background: linear-gradient(135deg, #28a745, #5cb85c);
            color: #ffffff;
        }

        .badge-gradient-warning {
            background: linear-gradient(135deg, #ffc107, #ffdb6d);
            color: #2c2e3f;
        }

        .badge-gradient-danger {
            background: linear-gradient(135deg, #dc3545, #e4606d);
            color: #ffffff;
        }

        .badge-gradient-info {
            background: linear-gradient(135deg, #17a2b8, #5bc0de);
            color: #ffffff;
        }

        .badge-gradient-primary {
            background: linear-gradient(135deg, #9a55ff, #da8cff);
            color: #ffffff;
        }

        .badge-gradient-secondary {
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

        /* Kolom No lebih rapat */
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

        /* Icon dalam tabel */
        .table tbody td i {
            font-size: 1rem;
        }

        /* Text colors */
        .text-primary {
            color: #9a55ff !important;
        }

        .text-info {
            color: #17a2b8 !important;
        }

        .text-danger {
            color: #dc3545 !important;
        }

        .text-success {
            color: #28a745 !important;
        }

        .text-warning {
            color: #ffc107 !important;
        }

        .fw-bold {
            font-weight: 600 !important;
        }

        .text-muted {
            color: #a5b3cb !important;
        }

        /* Typography */
        h3.text-dark {
            font-size: 1.3rem !important;
            font-weight: 700;
            color: #2c2e3f !important;
            margin-bottom: 0.5rem !important;
        }

        @media (min-width: 576px) {
            h3.text-dark {
                font-size: 1.5rem !important;
            }
        }

        @media (min-width: 768px) {
            h3.text-dark {
                font-size: 1.7rem !important;
            }
        }

        /* DataTables Custom Styling */
        .dataTables_wrapper {
            padding: 0;
        }

        .dataTables_filter {
            display: none !important;
        }

        .dataTables_length {
            display: none !important;
        }

        .dataTables_info {
            margin-top: 1rem;
            font-size: 0.85rem;
            color: #6c7383;
        }

        .dataTables_paginate {
            display: none !important;
        }

        /* Unit info styling - digabung dalam satu kolom */
        .unit-info {
            display: flex;
            flex-direction: column;
            gap: 0.3rem;
        }

        .unit-name {
            font-weight: 600;
            color: #2c2e3f;
            font-size: 0.95rem;
        }

        .unit-details {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            align-items: center;
        }

        .unit-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
            padding: 0.2rem 0.6rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .unit-badge i {
            font-size: 0.7rem;
        }

        .unit-badge.code {
            background-color: #f8f9fa;
            color: #6c7383;
            border: 1px solid #e9ecef;
        }

        .unit-badge.type {
            background: linear-gradient(135deg, #f2ecff, #e6d9ff);
            color: #9a55ff;
        }

        /* Aksi button styling */
        .aksi-buttons {
            display: flex;
            gap: 0.3rem;
            flex-wrap: wrap;
            justify-content: center;
        }

        .aksi-buttons .btn-sm {
            padding: 0.35rem 0.8rem;
            font-size: 0.8rem;
            white-space: nowrap;
        }

        /* Responsive untuk mobile */
        @media (max-width: 576px) {
            .table thead th {
                font-size: 0.75rem;
                padding: 0.6rem 0.3rem;
            }

            .table tbody td {
                font-size: 0.8rem;
                padding: 0.6rem 0.3rem;
            }

            .filter-card {
                padding: 0.75rem;
            }

            .filter-card .form-label {
                font-size: 0.8rem;
            }

            .filter-card .form-control,
            .filter-card .form-select,
            .filter-card .btn {
                font-size: 0.8rem;
                min-height: 38px;
            }

            h3.text-dark {
                font-size: 1.2rem !important;
            }

            .unit-details {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.2rem;
            }
        }
    </style>

    <div class="container-fluid p-2 p-sm-3 p-md-4">
        <!-- Header Dashboard -->
        <div class="row mb-3 mb-sm-3 mb-md-4">
            <div class="col-12">
                <div class="card shadow-sm border-0">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="text-dark mb-1">
                                <i class="mdi mdi-home-account me-2" style="color: #9a55ff;"></i>
                                Daftar Customer KPR Rijected
                            </h3>
                            <p class="text-muted mb-0">
                                <i class="mdi mdi-information-outline me-1"></i>
                                Kelola data customer KPR yang telah rijected
                            </p>
                        </div>
                        <div class="d-none d-sm-block">
                            <i class="mdi mdi-home-account" style="font-size: 2.5rem; color: #9a55ff; opacity: 0.2;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabel Data KPR -->
        <div class="row mt-2 mt-sm-2 mt-md-3">
            <div class="col-12">
                <div class="card">
                    <div
                        class="card-header bg-white d-flex flex-wrap flex-md-row justify-content-between align-items-center gap-2">
                        <h5 class="card-title mb-0">
                            <i class="mdi mdi-format-list-bulleted me-2 text-primary"></i>
                            Data Customer KPR Rijected
                        </h5>
                    </div>

                    <div class="card-body">
                        <!-- FILTER SECTION -->
                        <div class="filter-card mb-4">
                            <div class="card-body">
                                <h6 class="card-title mb-3" style="font-size: 1rem;">
                                    <i class="mdi mdi-filter-outline me-1" style="color: #9a55ff;"></i>
                                    Filter Data KPR
                                </h6>

                                <form method="GET" action="">
                                    <div class="row g-2 align-items-end">
                                        <div class="col-md-3">
                                            <label class="form-label">
                                                <i class="mdi mdi-magnify me-1" style="color: #9a55ff;"></i>
                                                Cari Customer
                                            </label>
                                            <input type="text" class="form-control" name="search_customer"
                                                value="{{ request('search_customer') }}" placeholder="Nama customer...">
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label">
                                                <i class="mdi mdi-home me-1" style="color: #9a55ff;"></i>
                                                Cari Unit
                                            </label>
                                            <input type="text" class="form-control" name="search_unit"
                                                value="{{ request('search_unit') }}" placeholder="Nama/kode/tipe unit...">
                                        </div>

                                        <div class="col-md-2">
                                            <label class="form-label">
                                                <i class="mdi mdi-flag me-1" style="color: #9a55ff;"></i>Status Dokumen
                                            </label>
                                            <select class="form-control" name="status">
                                                <option value="">Semua</option>
                                                <option value="dokumen"
                                                    {{ request('status') == 'dokumen' ? 'selected' : '' }}>Terverifikasi
                                                </option>
                                                <option value="survey"
                                                    {{ request('status') == 'survey' ? 'selected' : '' }}>Survey</option>
                                                <option value="akad" {{ request('status') == 'akad' ? 'selected' : '' }}>
                                                    Akad</option>
                                            </select>
                                        </div>

                                        <div class="col-md-4 d-flex gap-2">
                                            <button type="submit"
                                                class="btn btn-gradient-primary w-100 d-flex align-items-center justify-content-center">
                                                <i class="mdi mdi-filter me-1"></i> Filter
                                            </button>

                                            <a href=""
                                                class="btn btn-gradient-secondary w-100 d-flex align-items-center justify-content-center">
                                                <i class="mdi mdi-refresh me-1"></i> Reset
                                            </a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- TABEL DATA -->
                        <div class="table-responsive">
                            <table class="table table-hover align-middle" id="tableKPR">
                                <thead>
                                    <tr>
                                        <th class="text-center" width="5%">No</th>
                                        <th width="18%">Nama Customer</th>
                                        <th width="20%">Unit Rumah</th>
                                        <th width="10%">Unit</th>
                                        <th width="15%">Bank</th>
                                        <th width="12%">Status Dokumen</th>
                                        <th width="12%">Tgl Verifikasi</th>
                                        <th width="12%">Alasan Riject</th>
                                        <th class="text-center" width="18%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($kprApplications as $index => $application)
                                        <tr>
                                            <td class="text-center fw-bold">{{ $index + 1 }}</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <i class="mdi mdi-account-circle text-primary me-2"
                                                        style="font-size: 1.2rem;"></i>
                                                    <span
                                                        class="fw-bold">{{ $application->customer->full_name ?? '-' }}</span>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="unit-info">
                                                    <span class="unit-name">
                                                        <i class="mdi mdi-home-outline text-primary me-1"></i>
                                                        {{ $application->unit->unit_name ?? '-' }}
                                                    </span>
                                                    <div class="unit-details">
                                                        <span class="unit-badge type">
                                                            <i class="mdi mdi-shape-outline"></i>
                                                            {{ $application->unit->type ?? '-' }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <i class="mdi mdi-tag-outline"></i>
                                                    {{ $application->unit->unit_code ?? '-' }}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <i class="mdi mdi-bank text-info me-2" style="font-size: 1.2rem;"></i>
                                                    {{ $application->bank->bank_name ?? '-' }}
                                                </div>
                                            </td>
                                            <td>
                                                @if ($application->status === 'dokumen')
                                                    <span class="badge badge-gradient-success">
                                                        <i class="mdi mdi-check-circle me-1"></i>Terverifikasi
                                                    </span>
                                                @elseif ($application->status === 'survey')
                                                    <span class="badge badge-gradient-warning">
                                                        <i class="mdi mdi-map-marker me-1"></i>Survey
                                                    </span>
                                                @elseif ($application->status === 'akad')
                                                    <span class="badge badge-gradient-primary">
                                                        <i class="mdi mdi-handshake me-1"></i>Akad
                                                    </span>
                                                @elseif ($application->status === 'rejected')
                                                    <span class="badge badge-gradient-danger">
                                                        <i class="mdi mdi-close-circle me-1"></i>Ditolak
                                                    </span>
                                                @else
                                                    <span class="badge badge-gradient-secondary">
                                                        <i
                                                            class="mdi mdi-progress-question me-1"></i>{{ ucfirst($application->status) }}
                                                    </span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <i class="mdi mdi-calendar text-muted me-2"></i>
                                                    {{ $application->updated_at->format('d M Y') }}
                                                </div>
                                            </td>
                                            <td>
                                                 <div class="d-flex align-items-center">
                                                    
                                                    {{ $application->catatan?? '-'}}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="aksi-buttons">
                                                    @if ($application->unit->type === 'komersil')
                                                        @if ($application->status === 'survey')
                                                            <a href="{{ route('kpr.survey', $application->id) }}"
                                                                class="btn btn-outline-purple btn-sm">
                                                                <i class="mdi mdi-map-marker me-1"></i>Lanjut ke Survey
                                                            </a>
                                                        @else
                                                            <a href="{{ route('kpr.akad', $application->id) }}"
                                                                class="btn btn-gradient-success btn-sm">
                                                                <i class="mdi mdi-handshake me-1"></i>Lanjut ke Akad
                                                            </a>
                                                        @endif
                                                    @else
                                                        <a href="{{ route('kpr.survey', $application->id) }}"
                                                            class="btn btn-outline-purple btn-sm">
                                                            <i class="mdi mdi-map-marker me-1"></i>Lanjut ke Survey
                                                        </a>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center text-muted py-5">
                                                <i class="mdi mdi-home-account-off"
                                                    style="font-size: 3rem; opacity: 0.3;"></i>
                                                <p class="mt-2 mb-0">Tidak ada data KPR terverifikasi.</p>
                                                <p class="text-muted small">Belum ada customer KPR yang terverifikasi.</p>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tombol Kembali -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="d-flex flex-column flex-sm-row justify-content-start">
                            <a href="{{ route('dashboard') }}" class="btn btn-gradient-secondary">
                                <i class="mdi mdi-arrow-left me-1"></i>
                                Kembali ke Dashboard
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // Inisialisasi DataTables hanya dengan fitur sorting
            $('#tableKPR').DataTable({
                responsive: true,
                ordering: true,
                paging: false,
                info: false,
                searching: false,
                lengthChange: false,
                language: {
                    emptyTable: "Tidak ada data KPR terverifikasi",
                    zeroRecords: "Data tidak ditemukan"
                },
                columnDefs: [{
                        orderable: false,
                        targets: [7]
                    } // Kolom aksi tidak bisa diurutkan
                ]
            });
        });
    </script>
@endpush
