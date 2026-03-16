@extends('layouts.partial.app')

@section('title', 'Analisa KPR Komersil - Property Management App')

@section('content')
<style>
    /* ===== STYLING SAMA PERSIS DENGAN HALAMAN SEBELUMNYA ===== */
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
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 5px;
    }

    .btn-gradient-primary {
        background: linear-gradient(to right, #da8cff, #9a55ff) !important;
        color: #ffffff !important;
    }

    .btn-gradient-secondary {
        background: #6c757d !important;
        color: #ffffff !important;
    }

    .btn-gradient-info {
        background: linear-gradient(135deg, #17a2b8, #5bc0de) !important;
        color: #ffffff !important;
    }

    .btn-gradient-success {
        background: linear-gradient(135deg, #28a745, #5cb85c) !important;
        color: #ffffff !important;
    }

    .btn-gradient-warning {
        background: linear-gradient(135deg, #ffc107, #ffdb6d) !important;
        color: #2c2e3f !important;
    }

    .btn-gradient-danger {
        background: linear-gradient(135deg, #dc3545, #e4606d) !important;
        color: #ffffff !important;
    }

    /* Outline Buttons */
    .btn-outline-info {
        background: transparent;
        border: 1px solid #17a2b8;
        color: #17a2b8;
        height: 32px;
        width: 32px;
        padding: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .btn-outline-info:hover {
        background: linear-gradient(135deg, #17a2b8, #5bc0de);
        color: #ffffff;
        border-color: transparent;
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

    .table thead th:first-child {
        padding-left: 0.75rem;
        width: 5%;
        text-align: center;
    }

    .table tbody td:first-child {
        padding-left: 0.75rem;
        font-weight: 500;
        width: 5%;
        text-align: center;
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

    .table tbody tr:hover {
        background-color: #f8f9fa;
    }

    .table tbody td i {
        font-size: 1rem;
        margin-right: 0.5rem;
    }

    .text-primary {
        color: #9a55ff !important;
    }

    .fw-bold {
        font-weight: 600 !important;
    }

    .text-muted {
        color: #a5b3cb !important;
    }

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

    /* Pagination */
    .pagination {
        margin: 0;
        gap: 3px;
    }

    .page-item .page-link {
        border: 1px solid #e9ecef;
        padding: 0.35rem 0.7rem;
        font-size: 0.75rem;
        color: #6c7383;
        background-color: #ffffff;
        border-radius: 6px !important;
        min-width: 32px;
        text-align: center;
    }

    .page-item.active .page-link {
        background: linear-gradient(to right, #da8cff, #9a55ff);
        border-color: transparent;
        color: #ffffff;
    }

    .pagination-info {
        font-size: 0.8rem;
        color: #6c7383;
    }

    /* Responsive */
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

        h3.text-dark {
            font-size: 1.2rem !important;
        }

        .btn-sm {
            height: 28px;
            font-size: 0.75rem;
        }
    }

    .mdi {
        vertical-align: middle;
    }

    /* DataTables Custom Styling */
    .dataTables_filter,
    .dataTables_length,
    .dataTables_paginate,
    .dataTables_info {
        display: none !important;
    }

    .dataTables_wrapper {
        width: 100%;
        overflow-x: auto;
    }
</style>

<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap4.min.css">

<div class="container-fluid p-2 p-sm-3 p-md-4">
    <!-- Header Dashboard -->
    <div class="row mb-3 mb-sm-3 mb-md-4">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="text-dark mb-1">
                            <i class="mdi mdi-bank me-2" style="color: #9a55ff;"></i>
                            Analisa KPR Komersil
                        </h3>
                        <p class="text-muted mb-0">
                            <i class="mdi mdi-information-outline me-1"></i>
                            Data analisa kelayakan KPR untuk unit komersil
                        </p>
                    </div>
                    <div class="d-none d-sm-block">
                        <i class="mdi mdi-bank" style="font-size: 2.5rem; color: #9a55ff; opacity: 0.2;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel Analisa KPR -->
    <div class="row mt-2 mt-sm-2 mt-md-3">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-white d-flex flex-wrap flex-md-row justify-content-between align-items-center gap-2">
                    <h5 class="card-title mb-0">
                        <i class="mdi mdi-format-list-bulleted me-2 text-primary"></i>
                        Data Customer KPR Komersil
                    </h5>
                </div>

                <div class="card-body">
                    <!-- FILTER SECTION - UI ONLY -->
                    <div class="filter-card mb-4">
                        <div class="card-body">
                            <h6 class="card-title mb-3" style="font-size: 1rem;">
                                <i class="mdi mdi-filter-outline me-1" style="color: #9a55ff;"></i>
                                Filter Data
                            </h6>

                            <!-- MOBILE VERSION -->
                            <div class="d-block d-md-none">
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">
                                        <i class="mdi mdi-magnify me-1" style="color: #9a55ff;"></i>
                                        Cari Customer / Unit
                                    </label>
                                    <input type="text" class="form-control" placeholder="Cari nama customer atau unit..." style="height: 45px;">
                                </div>

                                <div class="row g-2 mb-3">
                                    <div class="col-6">
                                        <label class="form-label fw-semibold">
                                            <i class="mdi mdi-bank me-1" style="color: #9a55ff;"></i>Bank
                                        </label>
                                        <select class="form-control" style="height: 45px;">
                                            <option>Semua Bank</option>
                                            <option>Bank Mandiri</option>
                                            <option>BCA</option>
                                            <option>BNI</option>
                                            <option>BRI</option>
                                        </select>
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label fw-semibold">
                                            <i class="mdi mdi-chart-arc me-1" style="color: #9a55ff;"></i>Rekomendasi
                                        </label>
                                        <select class="form-control" style="height: 45px;">
                                            <option>Semua</option>
                                            <option>Layak</option>
                                            <option>Tidak Layak</option>
                                            <option>Review</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row g-2">
                                    <div class="col-6">
                                        <button type="button" class="btn btn-gradient-primary w-100 py-2 d-flex align-items-center justify-content-center btn-filter">
                                            <i class="mdi mdi-filter me-1"></i> Filter
                                        </button>
                                    </div>
                                    <div class="col-6">
                                        <button type="button" class="btn btn-gradient-secondary w-100 py-2 d-flex align-items-center justify-content-center btn-reset">
                                            <i class="mdi mdi-refresh me-1"></i> Reset
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- DESKTOP VERSION -->
                            <div class="d-none d-md-block">
                                <div class="row g-2 align-items-end">
                                    <div class="col-md-3">
                                        <label class="form-label">
                                            <i class="mdi mdi-magnify me-1" style="color: #9a55ff;"></i>
                                            Cari Customer / Unit
                                        </label>
                                        <input type="text" class="form-control" placeholder="Cari nama customer atau unit...">
                                    </div>

                                    <div class="col-md-2">
                                        <label class="form-label">
                                            <i class="mdi mdi-bank me-1" style="color: #9a55ff;"></i>Bank
                                        </label>
                                        <select class="form-control">
                                            <option>Semua Bank</option>
                                            <option>Bank Mandiri</option>
                                            <option>BCA</option>
                                            <option>BNI</option>
                                            <option>BRI</option>
                                        </select>
                                    </div>

                                    <div class="col-md-2">
                                        <label class="form-label">
                                            <i class="mdi mdi-chart-arc me-1" style="color: #9a55ff;"></i>Rekomendasi
                                        </label>
                                        <select class="form-control">
                                            <option>Semua</option>
                                            <option>Layak</option>
                                            <option>Tidak Layak</option>
                                            <option>Review</option>
                                        </select>
                                    </div>

                                    <div class="col-md-2">
                                        <label class="form-label">
                                            <i class="mdi mdi-counter me-1" style="color: #9a55ff;"></i>Tampil
                                        </label>
                                        <select class="form-control">
                                            <option>10</option>
                                            <option>15</option>
                                            <option>25</option>
                                            <option>50</option>
                                        </select>
                                    </div>

                                    <div class="col-md-1">
                                        <label class="form-label invisible">Filter</label>
                                        <button type="button" class="btn btn-gradient-primary w-100 btn-icon-only btn-filter">
                                            <i class="mdi mdi-filter"></i>
                                        </button>
                                    </div>

                                    <div class="col-md-2">
                                        <label class="form-label invisible">Reset</label>
                                        <button type="button" class="btn btn-gradient-secondary w-100 btn-icon-only btn-reset">
                                            <i class="mdi mdi-refresh"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- TABEL DATA -->
                    <div class="table-responsive">
                        <table class="table table-hover align-middle" id="tableKprKomersil" data-use-datatables="{{ $applications->count() > 0 ? 'true' : 'false' }}">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th>Customer</th>
                                    <th>Unit</th>
                                    <th>Blok</th>
                                    <th>Bank</th>
                                    <th>Harga Unit</th>
                                    <th>Appraisal</th>
                                    <th>Persentase</th>
                                    <th>Rekomendasi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($applications as $key => $app)
                                    @php
                                        $rekomendasi = $app->rekomendasi ?? '-';
                                        $rekomClass = 'badge-gradient-secondary';
                                        $rekomIcon = 'mdi-information';

                                        if ($rekomendasi == 'Layak') {
                                            $rekomClass = 'badge-gradient-success';
                                            $rekomIcon = 'mdi-check-circle';
                                        } elseif ($rekomendasi == 'Tidak Layak') {
                                            $rekomClass = 'badge-gradient-danger';
                                            $rekomIcon = 'mdi-close-circle';
                                        } elseif ($rekomendasi == 'Review') {
                                            $rekomClass = 'badge-gradient-warning';
                                            $rekomIcon = 'mdi-clock-outline';
                                        }
                                    @endphp
                                    <tr>
                                        <td class="text-center fw-bold">{{ $key + 1 }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <i class="mdi mdi-account-circle text-primary me-2"></i>
                                                {{ $app->customer->full_name ?? '-' }}
                                            </div>
                                        </td>
                                        <td>{{ $app->unit->unit_name ?? '-' }} - {{ $app->unit->type ?? '-' }}</td>
                                        <td>{{ $app->unit->unit_code ?? '-' }}</td>
                                        <td>{{ $app->bank->bank_name ?? '-' }}</td>
                                        <td>Rp {{ number_format($app->unit->price ?? 0, 0, ',', '.') }}</td>
                                        <td>Rp {{ number_format($app->appraisal_value ?? 0, 0, ',', '.') }}</td>
                                        <td>
                                            <span class="badge bg-light text-dark">
                                                {{ $app->persentase_kelayakan ?? '-' }}%
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge {{ $rekomClass }}">
                                                <i class="mdi {{ $rekomIcon }} me-1"></i>
                                                {{ $app->rekomendasi ?? '-' }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('properti.progress', ['land_bank_id' => $app->unit->land_bank_id, 'unit_id' => $app->unit->id]) }}"
                                               class="btn btn-gradient-info btn-sm" title="Progress Pembangunan">
                                                <i class="mdi mdi-home-edit"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="10" class="text-center py-5">
                                            <i class="mdi mdi-information-outline" style="font-size: 3rem; color: #ccc;"></i>
                                            <p class="mt-2 text-muted">Tidak ada data analisa KPR komersil</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- PAGINATION - UI ONLY (tampil jika ada data) -->
                    @if($applications->count() > 0)
                    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mt-4">
                        <div class="pagination-info mb-2 mb-sm-0">
                            <i class="mdi mdi-information-outline me-1 text-primary"></i>
                            Menampilkan 1 - {{ $applications->count() }} dari {{ $applications->count() }} data
                        </div>

                        <nav aria-label="Page navigation">
                            <ul class="pagination pagination-sm flex-wrap justify-content-center mb-0" style="gap: 2px;">
                                <li class="page-item disabled">
                                    <span class="page-link" aria-label="Previous">
                                        <i class="mdi mdi-chevron-left"></i>
                                    </span>
                                </li>
                                <li class="page-item active">
                                    <span class="page-link">1</span>
                                </li>
                                <li class="page-item disabled">
                                    <span class="page-link" aria-label="Next">
                                        <i class="mdi mdi-chevron-right"></i>
                                    </span>
                                </li>
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
                    <div class="d-flex flex-column flex-sm-row justify-content-start">
                        <a href="#" class="btn btn-gradient-secondary btn-back">
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
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            // Inisialisasi DataTables jika ada data
            const tableElement = document.getElementById('tableKprKomersil');
            const useDatatables = tableElement?.getAttribute('data-use-datatables') === 'true';

            if (useDatatables) {
                if ($.fn.DataTable.isDataTable('#tableKprKomersil')) {
                    $('#tableKprKomersil').DataTable().destroy();
                }

                $('#tableKprKomersil').DataTable({
                    responsive: true,
                    ordering: true,
                    paging: false,
                    info: false,
                    searching: false,
                    lengthChange: false,
                    destroy: true,
                    language: {
                        emptyTable: "Data analisa KPR belum tersedia",
                        zeroRecords: "Data tidak ditemukan",
                    },
                    columnDefs: [{
                        orderable: false,
                        targets: [9] // Kolom aksi
                    }],
                    autoWidth: false,
                    deferRender: true
                });
            }

            // Fungsi loading
            function showLoading(message = 'Mohon tunggu sebentar') {
                Swal.fire({
                    title: 'Memuat...',
                    text: message,
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
            }

            // Filter buttons
            $('.btn-filter').on('click', function(e) {
                e.preventDefault();
                showLoading('Menyaring data...');
                setTimeout(() => {
                    Swal.close();
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'Filter diterapkan',
                        timer: 1500,
                        showConfirmButton: false
                    });
                }, 1000);
            });

            // Reset buttons
            $('.btn-reset').on('click', function(e) {
                e.preventDefault();
                showLoading('Mereset filter...');
                setTimeout(() => {
                    Swal.close();
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'Filter direset',
                        timer: 1500,
                        showConfirmButton: false
                    });
                }, 1000);
            });

            // Back button
            $('.btn-back').on('click', function(e) {
                e.preventDefault();
                showLoading('Kembali ke dashboard...');
                setTimeout(() => {
                    Swal.close();
                    window.location.href = '#';
                }, 1000);
            });
        });
    </script>
@endpush
