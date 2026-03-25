@extends('layouts.partial.app')

@section('title', 'Timeline Pembayaran - Property Management App')

@section('content')

<style>
.card {
    transition: all 0.3s ease;
    margin-bottom: 1rem;
    border: none !important;
    box-shadow: 0 4px 15px rgba(0,0,0,0.05);
}
.card:hover { box-shadow: 0 8px 25px rgba(154, 85, 255, 0.1) !important; }

.card-header {
    background: linear-gradient(135deg, #ffffff, #f8f9fa);
    border-bottom: 1px solid #e9ecef;
    padding: 0.75rem;
}
@media (min-width: 576px) { .card-header { padding: 1rem; } }
@media (min-width: 768px) { .card-header { padding: 1.2rem; } }

.card-body { padding: 0.75rem; }
@media (min-width: 576px) { .card-body { padding: 1rem; } }
@media (min-width: 768px) { .card-body { padding: 1.2rem; } }

.card-title {
    font-size: 0.9rem;
    font-weight: 600;
    color: #9a55ff;
    margin-bottom: 0;
}
@media (min-width: 576px) { .card-title { font-size: 1rem; } }
@media (min-width: 768px) { .card-title { font-size: 1.1rem; } }

.filter-card {
    background: linear-gradient(135deg, #f9f7ff, #f2ecff);
    border-radius: 12px;
    padding: 1rem;
    margin-bottom: 1.25rem;
    border: none;
}

.form-control, .form-select {
    border: 1px solid #e9ecef;
    border-radius: 10px;
    padding: 0.7rem 1rem;
    font-size: 0.92rem;
    transition: all 0.2s ease;
    background-color: #ffffff;
    color: #2c2e3f;
    height: auto;
    min-height: 42px;
}
.form-control:focus, .form-select:focus {
    border-color: #9a55ff;
    box-shadow: 0 0 0 3px rgba(154, 85, 255, 0.1);
    outline: none;
}
.form-label {
    font-size: 0.85rem;
    font-weight: 600;
    color: #9a55ff !important;
    margin-bottom: 0.3rem;
    letter-spacing: 0.3px;
    font-family: 'Nunito', sans-serif;
}

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
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
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

.btn-action {
    width: 36px;
    height: 36px;
    padding: 0;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: 10px;
    margin: 0 2px;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
}
.btn-action i { font-size: 1.05rem; }

.btn-action.document {
    background: linear-gradient(135deg, #17a2b8, #56c6d8);
    color: #fff;
}
.btn-action.document:hover {
    transform: translateY(-3px);
    box-shadow: 0 5px 15px rgba(23, 162, 184, 0.35);
}

.btn-action.view {
    background: linear-gradient(135deg, #0d6efd, #6ea8fe);
    color: #fff;
}
.btn-action.view:hover {
    transform: translateY(-3px);
    box-shadow: 0 5px 15px rgba(13, 110, 253, 0.35);
}

.btn-action.edit {
    background: linear-gradient(135deg, #ffc107, #ffdb6d);
    color: #2c2e3f;
}
.btn-action.edit:hover {
    transform: translateY(-3px);
    box-shadow: 0 5px 15px rgba(255, 193, 7, 0.4);
}

.btn-action.delete {
    background: linear-gradient(135deg, #dc3545, #e4606d);
    color: #fff;
}
.btn-action.delete:hover {
    transform: translateY(-3px);
    box-shadow: 0 5px 15px rgba(220, 53, 69, 0.4);
}

.btn-icon-only {
    width: 42px;
    height: 42px;
    padding: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 10px;
}
.btn-icon-only i { font-size: 1.15rem; margin: 0; }

.table-responsive {
    overflow-x: auto;
    overflow-y: hidden;
    -webkit-overflow-scrolling: touch;
    border-radius: 8px;
    margin-bottom: 0.5rem;
    scrollbar-width: thin;
    scrollbar-color: #9a55ff #f0f0f0;
}
.table-responsive::-webkit-scrollbar {
    height: 8px;
}
.table-responsive::-webkit-scrollbar-track {
    background: #f0f0f0;
    border-radius: 10px;
}
.table-responsive::-webkit-scrollbar-thumb {
    background: #9a55ff;
    border-radius: 10px;
}
.table-responsive::-webkit-scrollbar-thumb:hover {
    background: #7a3fcc;
}

.table {
    width: 100%;
    min-width: 1180px;
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
@media (min-width: 576px) { .table thead th { font-size: 0.85rem; padding: 0.9rem 0.6rem; } }
@media (min-width: 768px) { .table thead th { font-size: 0.9rem; padding: 1rem 0.75rem; } }

.table thead th:first-child,
.table tbody td:first-child {
    width: 50px;
    text-align: center;
}

.table tbody td {
    vertical-align: middle;
    font-size: 0.85rem;
    padding: 0.8rem 0.5rem;
    border-bottom: 1px solid #e9ecef;
    color: #2c2e3f;
    white-space: nowrap;
}
@media (min-width: 576px) { .table tbody td { font-size: 0.9rem; padding: 0.9rem 0.6rem; } }
@media (min-width: 768px) { .table tbody td { font-size: 0.95rem; padding: 1rem 0.75rem; } }

.table tbody tr:hover { background-color: #f8f9fa; }

.sortable-link {
    color: #9a55ff !important;
    text-decoration: none !important;
    display: inline-flex;
    align-items: center;
    gap: 0.25rem;
    font-weight: 600;
}
.sortable-link:hover {
    color: #7a3fcc !important;
}

.name-wrap {
    display: flex;
    align-items: center;
    gap: 0.75rem;
}
.name-initial {
    width: 38px;
    height: 38px;
    border-radius: 50%;
    background: linear-gradient(135deg, #da8cff, #9a55ff);
    color: #fff;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 0.9rem;
    flex-shrink: 0;
    box-shadow: 0 4px 12px rgba(154, 85, 255, 0.25);
}
.name-info {
    display: flex;
    flex-direction: column;
    line-height: 1.3;
}
.name-title {
    font-weight: 700;
    color: #2c2e3f;
}

.info-chip {
    display: inline-flex;
    align-items: center;
    gap: 0.45rem;
    padding: 0.45rem 0.8rem;
    border-radius: 999px;
    font-size: 0.82rem;
    font-weight: 700;
}
.info-chip.tenor {
    background: rgba(154, 85, 255, 0.1);
    color: #9a55ff;
}
.info-chip.penalty {
    background: rgba(220, 53, 69, 0.1);
    color: #dc3545;
}

.badge-status {
    padding: 0.45rem 0.85rem;
    border-radius: 20px;
    font-weight: 700;
    font-size: 0.82rem;
    display: inline-flex;
    align-items: center;
    gap: 0.4rem;
}
.badge-status.active {
    background: linear-gradient(135deg, #28a745, #5dd39e);
    color: #fff;
}
.badge-status.inactive {
    background: linear-gradient(135deg, #6c757d, #9aa0a6);
    color: #fff;
}
.badge-status.process {
    background: linear-gradient(135deg, #ffc107, #ffdb6d);
    color: #2c2e3f;
}

.pagination { margin: 0; gap: 3px; }
.page-item .page-link {
    border: 1px solid #e9ecef;
    padding: 0.35rem 0.7rem;
    font-size: 0.75rem;
    color: #6c7383;
    background-color: #ffffff;
    border-radius: 6px !important;
    transition: all 0.2s ease;
    min-width: 32px;
    text-align: center;
    text-decoration: none;
}
.page-item.active .page-link {
    background: linear-gradient(to right, #da8cff, #9a55ff);
    border-color: transparent;
    color: #ffffff;
    box-shadow: 0 4px 12px rgba(154, 85, 255, 0.3);
}
.pagination-info {
    font-size: 0.8rem;
    color: #6c7383;
}

.modal-content {
    border: none;
    border-radius: 16px;
}
.modal-header {
    background: linear-gradient(135deg, #da8cff, #9a55ff);
    color: white;
    border-radius: 16px 16px 0 0;
    padding: 1rem 1.5rem;
}
.modal-header .btn-close {
    filter: brightness(0) invert(1);
}
.modal-title {
    font-weight: 600;
    font-size: 1.1rem;
}
.modal-body {
    padding: 1.5rem;
}
.modal-footer {
    border-top: 1px solid #e9ecef;
    padding: 1rem 1.5rem;
}

.modal-scroll-body {
    max-height: 75vh;
    overflow-y: auto;
    overflow-x: hidden;
    scrollbar-width: thin;
    scrollbar-color: #9a55ff #f0f0f0;
}
.modal-scroll-body::-webkit-scrollbar {
    width: 8px;
}
.modal-scroll-body::-webkit-scrollbar-track {
    background: #f0f0f0;
    border-radius: 10px;
}
.modal-scroll-body::-webkit-scrollbar-thumb {
    background: #9a55ff;
    border-radius: 10px;
}
.modal-scroll-body::-webkit-scrollbar-thumb:hover {
    background: #7a3fcc;
}

.timeline-detail-card {
    background: linear-gradient(135deg, #faf7ff, #f4efff);
    border: 1px solid #eadcff;
    border-radius: 14px;
    padding: 1rem;
    margin-bottom: 1rem;
}
.timeline-detail-title {
    font-size: 0.95rem;
    font-weight: 700;
    color: #9a55ff;
    margin-bottom: 0.85rem;
}
.timeline-detail-item {
    background: #ffffff;
    border: 1px solid #efe6ff;
    border-radius: 10px;
    padding: 0.75rem 0.85rem;
    height: 100%;
}
.timeline-detail-label {
    font-size: 0.75rem;
    color: #8b8fa3;
    margin-bottom: 0.2rem;
    font-weight: 600;
}
.timeline-detail-value {
    font-size: 0.92rem;
    color: #2c2e3f;
    font-weight: 700;
}
.timeline-detail-value.price {
    color: #28a745;
    font-weight: 800;
}

.total-paid {
    color: #28a745 !important;
    font-weight: 800 !important;
}

.btn-eye-purple {
    height: 36px;
    padding: 0 14px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: 10px;
    transition: all 0.3s ease;
    cursor: pointer;
    font-size: 0.82rem;
    font-weight: 600;
    gap: 0.35rem;
    background: transparent;
    color: #9a55ff;
    border: 1.5px solid #9a55ff;
    text-decoration: none !important;
}
.btn-eye-purple i {
    font-size: 1rem;
    margin: 0 !important;
}
.btn-eye-purple:hover,
.btn-eye-purple:focus,
.btn-eye-purple:active {
    background: #9a55ff;
    color: #ffffff;
    border-color: #9a55ff;
    box-shadow: 0 5px 15px rgba(154, 85, 255, 0.25);
    transform: translateY(-2px);
    text-decoration: none !important;
}

.badge-payment-status {
    padding: 0.45rem 0.9rem;
    border-radius: 20px;
    font-weight: 700;
    font-size: 0.76rem;
    display: inline-block;
    letter-spacing: 0.3px;
}
.badge-payment-status.active {
    background: linear-gradient(135deg, #28c76f, #48da89);
    color: #ffffff;
}
.badge-payment-status.pending {
    background: linear-gradient(135deg, #ffc107, #ffdb6d);
    color: #2c2e3f;
}
.badge-payment-status.late {
    background: linear-gradient(135deg, #dc3545, #ff6b6b);
    color: #ffffff;
}

.text-primary  { color: #9a55ff !important; }
.text-danger   { color: #dc3545 !important; }
.text-muted    { color: #a5b3cb !important; }
.fw-bold       { font-weight: 600 !important; }

h3.text-dark {
    font-size: 1.3rem !important;
    font-weight: 700;
    color: #2c2e3f !important;
    margin-bottom: 0.5rem !important;
}
@media (min-width: 576px) { h3.text-dark { font-size: 1.5rem !important; } }
@media (min-width: 768px) { h3.text-dark { font-size: 1.7rem !important; } }

.mdi { vertical-align: middle; }

.filter-row {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}
.filter-row .filter-text {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: #9a55ff;
    font-weight: 600;
    font-size: 0.95rem;
}
.action-group {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 4px;
}

/* Select2 */
.select2-container--bootstrap-5 .select2-selection {
    border: 1px solid #e9ecef !important;
    border-radius: 10px !important;
    padding: 0.5rem 0.9rem !important;
    min-height: 42px !important;
    font-family: 'Nunito', sans-serif !important;
    background-color: #ffffff !important;
}
.select2-container--bootstrap-5 .select2-selection--single .select2-selection__rendered {
    color: #2c2e3f !important;
    font-size: 0.92rem !important;
    line-height: 1.6 !important;
    padding-left: 0 !important;
}
.select2-container--bootstrap-5 .select2-selection--single .select2-selection__arrow {
    height: 40px !important;
    right: 10px !important;
}
.select2-container--bootstrap-5 .select2-selection:hover {
    border-color: #9a55ff !important;
}
.select2-container--bootstrap-5.select2-container--focus .select2-selection,
.select2-container--bootstrap-5.select2-container--open .select2-selection {
    border-color: #9a55ff !important;
    box-shadow: 0 0 0 3px rgba(154, 85, 255, 0.1) !important;
}
.select2-container--bootstrap-5 .select2-dropdown {
    border-color: #e9ecef !important;
    border-radius: 10px !important;
    overflow: hidden !important;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1) !important;
}
.select2-container--bootstrap-5 .select2-results__option {
    padding: 0.65rem 0.9rem !important;
    font-size: 0.9rem !important;
}
.select2-container--bootstrap-5 .select2-results__option--selected {
    background-color: #9a55ff !important;
    color: #ffffff !important;
}
.select2-container--bootstrap-5 .select2-results__option--highlighted {
    background: linear-gradient(135deg, #da8cff, #9a55ff) !important;
    color: #ffffff !important;
}
.select2-container--bootstrap-5 .select2-search--dropdown .select2-search__field {
    border: 1px solid #e9ecef !important;
    border-radius: 8px !important;
    padding: 0.5rem !important;
    margin: 0.5rem !important;
    width: calc(100% - 1rem) !important;
}
.select2-container--bootstrap-5 .select2-search--dropdown .select2-search__field:focus {
    border-color: #9a55ff !important;
    box-shadow: 0 0 0 3px rgba(154, 85, 255, 0.1) !important;
    outline: none !important;
}

/* Modern file upload */
.modern-file-upload {
    position: relative;
    width: 100%;
}
.modern-file-upload input[type="file"] {
    position: absolute;
    opacity: 0;
    width: 100%;
    height: 100%;
    cursor: pointer;
    z-index: 2;
}
.modern-file-upload .file-label {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;
    gap: 6px;
    padding: 1rem 0.6rem;
    background: linear-gradient(135deg, #f8f9fa, #f1f3f5);
    border: 2px dashed #d0d4db;
    border-radius: 12px;
    cursor: pointer;
    transition: all 0.3s ease;
    min-height: 100px;
}
@media (min-width: 576px) {
    .modern-file-upload .file-label {
        flex-direction: row;
        text-align: left;
        gap: 8px;
        padding: 0.75rem 1rem;
        min-height: auto;
    }
}
.modern-file-upload:hover .file-label {
    border-color: #9a55ff;
    background: linear-gradient(135deg, #f1f0ff, #f8f9fa);
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(154, 85, 255, 0.1);
}
.modern-file-upload .file-label i {
    font-size: 1.6rem;
    color: #9a55ff;
    background: rgba(154, 85, 255, 0.1);
    padding: 8px;
    border-radius: 50%;
}
.modern-file-upload .file-label .file-info {
    flex: 1;
    width: 100%;
}
.modern-file-upload .file-label .file-info span {
    display: block;
    font-weight: 600;
    color: #2c2e3f;
    font-size: 0.8rem;
    word-break: break-word;
}
.modern-file-upload .file-label .file-info small {
    color: #6c7383;
    font-size: 0.65rem;
    display: block;
    margin-top: 2px;
}
.modern-file-upload .file-label .file-size {
    font-size: 0.7rem;
    color: #9a55ff;
    font-weight: 600;
    background: rgba(154, 85, 255, 0.1);
    padding: 4px 10px;
    border-radius: 20px;
    white-space: nowrap;
    margin-top: 5px;
}
@media (min-width: 576px) {
    .modern-file-upload .file-label .file-size {
        margin-top: 0;
    }
}
</style>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" rel="stylesheet" />

<div class="container-fluid p-2 p-sm-3 p-md-4">
    <div class="row mb-3 mb-sm-3 mb-md-4">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="text-dark mb-1">
                            <i class="mdi mdi-calendar-clock me-2" style="color: #9a55ff;"></i>Timeline Pembayaran Cash Tempo
                        </h3>
                        <p class="text-muted mb-0">
                            Kelola data tenor dan timeline pembayaran
                        </p>
                    </div>
                    <div class="d-none d-sm-block">
                        <i class="mdi mdi-calendar-clock" style="font-size: 2.5rem; color: #9a55ff; opacity: 0.2;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-2 mt-sm-2 mt-md-3">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-white d-flex flex-wrap flex-md-row justify-content-between align-items-center gap-2">
                    <h5 class="card-title mb-0">
                        <i class="mdi mdi-format-list-bulleted me-2"></i>Daftar Tenor Pembayaran
                    </h5>
                    <button class="btn btn-gradient-primary" style="padding: 0.6rem 1.2rem; font-size: 0.9rem;" data-bs-toggle="modal" data-bs-target="#modalCreatePayment">
                        <i class="mdi mdi-plus me-1"></i>Tambah Pembayaran
                    </button>
                </div>

                <div class="card-body">
                    <div class="filter-card mb-4">
                        <div class="card-body">
                            <div class="filter-row">
                                <div class="filter-text">
                                    <i class="mdi mdi-filter-outline"></i>
                                    <span>Filter data tenor</span>
                                </div>

                                <form method="GET" action="{{ route('cash-tempo.timeline') }}" id="filterForm">
                                    <input type="hidden" name="sort" value="{{ request('sort', 'latest') }}">
                                    <div class="row g-2 align-items-end w-100">
                                        <div class="col-md-8">
                                            <label class="form-label">Search</label>
                                            <input type="text" class="form-control" name="search" value="{{ request('search') }}" placeholder="Cari nama customer...">
                                        </div>

                                        <div class="col-md-2">
                                            <label class="form-label">Tampil</label>
                                            <select class="form-control" name="per_page">
                                                <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10</option>
                                                <option value="15" {{ request('per_page') == 15 ? 'selected' : '' }}>15</option>
                                                <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                                            </select>
                                        </div>

                                        <div class="col-md-1">
                                            <label class="form-label invisible">Filter</label>
                                            <button type="submit" class="btn btn-gradient-primary btn-icon-only w-100" title="Filter">
                                                <i class="mdi mdi-filter"></i>
                                            </button>
                                        </div>

                                        <div class="col-md-1">
                                            <label class="form-label invisible">Reset</label>
                                            <a href="{{ route('cash-tempo.timeline') }}" class="btn btn-gradient-secondary btn-icon-only w-100 btn-reset-filter" title="Reset Filter">
                                                <i class="mdi mdi-refresh"></i>
                                            </a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>

                                    <th>
                                        <a href="{{ route('cash-tempo.timeline', array_merge(request()->query(), ['sort' => request('sort') == 'name_asc' ? 'name_desc' : 'name_asc'])) }}" class="sortable-link btn-sort-link">
                                            Nama
                                            @if(request('sort') == 'name_asc')
                                                <i class="mdi mdi-arrow-up"></i>
                                            @elseif(request('sort') == 'name_desc')
                                                <i class="mdi mdi-arrow-down"></i>
                                            @else
                                                <i class="mdi mdi-swap-vertical"></i>
                                            @endif
                                        </a>
                                    </th>

                                    <th>
                                        <a href="{{ route('cash-tempo.timeline', array_merge(request()->query(), ['sort' => request('sort') == 'tenor_asc' ? 'tenor_desc' : 'tenor_asc'])) }}" class="sortable-link btn-sort-link">
                                            Tenor
                                            @if(request('sort') == 'tenor_asc')
                                                <i class="mdi mdi-arrow-up"></i>
                                            @elseif(request('sort') == 'tenor_desc')
                                                <i class="mdi mdi-arrow-down"></i>
                                            @else
                                                <i class="mdi mdi-swap-vertical"></i>
                                            @endif
                                        </a>
                                    </th>

                                    <th>Total Bulan</th>
                                    <th>Jatuh Tempo</th>
                                    <th>Denda Keterlambatan</th>
                                    <th>Status</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($tenors as $index => $tenor)
                                    @php
                                        $customerName = $tenor->booking->customer->full_name ?? '-';

                                        $words = collect(explode(' ', trim($customerName)))->filter();
                                        $initial = $words->count() >= 2
                                            ? strtoupper(substr($words->first(), 0, 1) . substr($words->last(), 0, 1))
                                            : strtoupper(substr($customerName, 0, 2));

                                        $tahun = floor(($tenor->tenor_bulan ?? 0) / 12);
                                        $tenorText = $tahun > 0 ? $tahun . ' Tahun' : (($tenor->tenor_bulan ?? 0) . ' Bulan');

                                        $statusClass = match($tenor->status) {
                                            'lunas' => 'active',
                                            'process' => 'process',
                                            default => 'inactive',
                                        };

                                        $statusIcon = match($tenor->status) {
                                            'lunas' => 'mdi-check-circle-outline',
                                            'process' => 'mdi-timer-sand',
                                            default => 'mdi-close-circle-outline',
                                        };

                                        $statusText = match($tenor->status) {
                                            'lunas' => 'Lunas',
                                            'process' => 'Berjalan',
                                            default => ucfirst($tenor->status ?? '-'),
                                        };

                                        $installments = $tenor->installments ?? collect();
                                        $bookingCode = $tenor->booking->booking_code ?? '-';
                                        $typeUnit = $tenor->booking->unit->type ?? '-';
                                        $jenisUnit = $tenor->booking->unit->jenis ?? '-';
                                        $jatuhTempoDay = \Carbon\Carbon::parse($tenor->tanggal_mulai_angsuran)->format('d');
                                        $angsuranNominal = $tenor->tenor_bulan > 0 ? ($tenor->sisa_pembayaran / $tenor->tenor_bulan) : 0;

                                        $installmentData = $installments->values()->map(function ($item, $key) use ($tenor) {
                                            $jatuhTempo = \Carbon\Carbon::parse($item->jatuh_tempo);
                                            $isLate = $item->status != 'paid' && $jatuhTempo->lt(now());
                                            $denda = $isLate ? (($item->nominal_angsuran ?? 0) * (($tenor->denda_persen ?? 0) / 100)) : 0;

                                            return [
                                                'no' => $key + 1,
                                                'tanggal' => $jatuhTempo->translatedFormat('d F Y'),
                                                'nominal' => 'Rp ' . number_format($item->nominal_angsuran ?? 0, 0, ',', '.'),
                                                'status' => $item->status == 'paid' ? 'Lunas' : ($isLate ? 'Terlambat' : 'Pending'),
                                                'denda' => $item->status == 'paid' ? '-' : ($isLate ? 'Rp ' . number_format($denda, 0, ',', '.') : '-'),
                                                'bukti' => !empty($item->bukti_pembayaran),
                                                'bukti_url' => !empty($item->bukti_pembayaran) ? asset('storage/' . $item->bukti_pembayaran) : null,
                                                'total' => $item->status == 'paid'
                                                    ? 'Rp ' . number_format($item->nominal_angsuran ?? 0, 0, ',', '.')
                                                    : '-',
                                            ];
                                        })->toArray();
                                    @endphp

                                    <tr>
                                        <td class="text-center fw-bold">
                                            {{ $tenors->firstItem() + $index }}
                                        </td>
                                        <td>
                                            <div class="name-wrap">
                                                <span class="name-initial">{{ $initial }}</span>
                                                <div class="name-info">
                                                    <span class="name-title">{{ $customerName }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="info-chip tenor">
                                                <i class="mdi mdi-calendar-range"></i>{{ $tenorText }}
                                            </span>
                                        </td>
                                        <td>{{ $tenor->tenor_bulan }} Bulan</td>
                                        <td>Setiap Tanggal {{ $jatuhTempoDay }}</td>
                                        <td>
                                            <span class="info-chip penalty">
                                                <i class="mdi mdi-percent-outline"></i>{{ $tenor->denda_persen }}% per bulan
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge-status {{ $statusClass }}">
                                                <i class="mdi {{ $statusIcon }}"></i>{{ $statusText }}
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <div class="action-group">
                                                @if($tenor->status == 'lunas')
                                                    <a href="{{ route('document.user.persiapan-legal') }}" class="btn-action document" title="Dokumen">
                                                        <i class="mdi mdi-file-document-outline"></i>
                                                    </a>
                                                @else
                                                    <button class="btn-action document" title="Dokumen" type="button" onclick="showAction('Dokumen', {{ $tenor->id }})">
                                                        <i class="mdi mdi-file-document-outline"></i>
                                                    </button>
                                                @endif

                                                <button
                                                    class="btn-action view btn-detail-timeline"
                                                    title="Detail"
                                                    type="button"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#modalDetailTimeline"
                                                    data-name="{{ $customerName }}"
                                                    data-booking-id="{{ $bookingCode }}"
                                                    data-status="{{ $statusText }}"
                                                    data-type-unit="{{ $typeUnit }}"
                                                    data-jenis-unit="{{ $jenisUnit }}"
                                                    data-jatuh-tempo="Setiap tanggal {{ $jatuhTempoDay }}"
                                                    data-angsuran="Rp {{ number_format($angsuranNominal, 0, ',', '.') }}"
                                                    data-denda="{{ $tenor->denda_persen }}% per bulan"
                                                    data-installments='@json($installmentData)'>
                                                    <i class="mdi mdi-eye-outline"></i>
                                                </button>

                                                <button
                                                    class="btn-action edit"
                                                    title="Edit"
                                                    type="button"
                                                    onclick="openEditModal(
                                                        '{{ $tenor->id }}',
                                                        @js($customerName),
                                                        @js($tenorText),
                                                        @js($tenor->tenor_bulan . ' Bulan'),
                                                        @js('Setiap tanggal ' . $jatuhTempoDay),
                                                        @js($tenor->denda_persen . '% per bulan'),
                                                        @js($statusText)
                                                    )">
                                                    <i class="mdi mdi-pencil"></i>
                                                </button>

                                                <button class="btn-action delete btn-delete-tenor" title="Hapus" type="button" data-id="{{ $tenor->id }}">
                                                    <i class="mdi mdi-delete"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center text-muted py-4">
                                            Tidak ada data tenor pembayaran
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if($tenors->count() > 0)
                        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mt-4">
                            <div class="pagination-info mb-2 mb-sm-0">
                                Menampilkan {{ $tenors->firstItem() }} - {{ $tenors->lastItem() }} dari {{ $tenors->total() }} data
                            </div>
                            <nav aria-label="Page navigation">
                                <ul class="pagination pagination-sm flex-wrap justify-content-center mb-0">
                                    @if ($tenors->onFirstPage())
                                        <li class="page-item disabled">
                                            <span class="page-link"><i class="mdi mdi-chevron-left"></i></span>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link btn-page-link" href="{{ $tenors->previousPageUrl() }}"><i class="mdi mdi-chevron-left"></i></a>
                                        </li>
                                    @endif

                                    @foreach ($tenors->getUrlRange(1, $tenors->lastPage()) as $page => $url)
                                        <li class="page-item {{ $tenors->currentPage() == $page ? 'active' : '' }}">
                                            <a class="page-link btn-page-link" href="{{ $url }}">{{ $page }}</a>
                                        </li>
                                    @endforeach

                                    @if ($tenors->hasMorePages())
                                        <li class="page-item">
                                            <a class="page-link btn-page-link" href="{{ $tenors->nextPageUrl() }}"><i class="mdi mdi-chevron-right"></i></a>
                                        </li>
                                    @else
                                        <li class="page-item disabled">
                                            <span class="page-link"><i class="mdi mdi-chevron-right"></i></span>
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

<div class="modal fade" id="modalCreatePayment" tabindex="-1" aria-labelledby="modalCreatePaymentLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCreatePaymentLabel">
                    <i class="mdi mdi-cash-plus me-2"></i>Tambah Pembayaran Angsuran
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="formCreatePayment" method="POST" action="{{ route('cash-tempo.storePayment') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body modal-scroll-body">
                    <div class="mb-3">
                        <label class="form-label">Customer / Unit <span class="text-danger">*</span></label>
                        <select class="form-control select2-customer" name="cash_tempo_id" id="selectTenor" required style="width: 100%;">
                            <option value="">-- Pilih Customer / Unit --</option>
                            @foreach ($tenors as $tempo)
                                <option value="{{ $tempo->id }}">
                                    {{ $tempo->booking->customer->full_name ?? '-' }} - Unit {{ $tempo->booking->unit->unit_name ?? '-' }} (Tenor: {{ $tempo->tenor_bulan }} bulan)
                                </option>
                            @endforeach
                        </select>
                        <small class="text-muted">Ketik untuk mencari customer atau unit</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Pilih Angsuran <span class="text-danger">*</span></label>
                        <select class="form-control" name="installment_id" id="selectCashTempo" required>
                            <option value="">-- Pilih Angsuran --</option>
                            @foreach ($tenors as $tempo)
                                @foreach ($tempo->installments as $installment)
                                    @if ($installment->status != 'paid')
                                        <option value="{{ $installment->id }}" data-tenor="{{ $tempo->id }}" data-nominal="{{ $installment->nominal_angsuran }}">
                                            Angsuran ke-{{ $loop->iteration }} - Jatuh tempo {{ \Carbon\Carbon::parse($installment->jatuh_tempo)->format('d M Y') }}
                                        </option>
                                    @endif
                                @endforeach
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nominal Angsuran</label>
                        <input type="text" class="form-control total-paid" name="nominal_angsuran_display" id="nominalAngsuranDisplay" placeholder="Rp 0" readonly>
                        <input type="hidden" name="nominal_angsuran" id="nominalAngsuran" value="0">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Status Pembayaran</label>
                        <select class="form-control" name="status" required>
                            <option value="paid" selected>Lunas</option>
                        </select>
                    </div>

                    <div class="mb-0">
                        <label class="form-label">Upload Bukti Pembayaran <span class="text-danger">*</span></label>
                        <div class="modern-file-upload">
                            <input type="file" id="buktiPembayaran" name="bukti_pembayaran" accept="image/*,application/pdf" required>
                            <div class="file-label">
                                <i class="mdi mdi-cloud-upload"></i>
                                <div class="file-info">
                                    <span id="fileName">Upload Bukti Pembayaran</span>
                                    <small>Format: JPG, PNG, PDF</small>
                                </div>
                                <span class="file-size" id="fileSize" style="display:none;"></span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-gradient-secondary" data-bs-dismiss="modal">
                        <i class="mdi mdi-close me-1"></i>Batal
                    </button>
                    <button type="submit" class="btn btn-gradient-primary btn-save-payment">
                        <i class="mdi mdi-content-save me-1"></i>Simpan Pembayaran
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modalTenor" tabindex="-1" aria-labelledby="modalTenorLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTenorLabel">
                    <i class="mdi mdi-pencil-circle me-2"></i>
                    <span id="modalTitle">Detail Tenor</span>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <input type="hidden" id="tenorId" name="id">

            <div class="modal-body modal-scroll-body">
                <div class="mb-3">
                    <label class="form-label">Nama</label>
                    <input type="text" class="form-control" id="namaTenor" readonly>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tenor</label>
                    <input type="text" class="form-control" id="tenorValue" readonly>
                </div>

                <div class="mb-3">
                    <label class="form-label">Total Bulan</label>
                    <input type="text" class="form-control" id="totalBulan" readonly>
                </div>

                <div class="mb-3">
                    <label class="form-label">Jatuh Tempo</label>
                    <input type="text" class="form-control" id="jatuhTempo" readonly>
                </div>

                <div class="mb-3">
                    <label class="form-label">Denda Keterlambatan</label>
                    <input type="text" class="form-control" id="dendaValue" readonly>
                </div>

                <div class="mb-0">
                    <label class="form-label">Status</label>
                    <input type="text" class="form-control" id="statusValue" readonly>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-gradient-secondary" data-bs-dismiss="modal">
                    <i class="mdi mdi-close me-1"></i>Tutup
                </button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalDetailTimeline" tabindex="-1" aria-labelledby="modalDetailTimelineLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDetailTimelineLabel">
                    <i class="mdi mdi-eye-outline me-2"></i>Detail Timeline Pembayaran
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body modal-scroll-body">
                <div class="timeline-detail-card">
                    <div class="timeline-detail-title">
                        <i class="mdi mdi-cash-clock me-1"></i>Informasi Pembayaran
                    </div>

                    <div class="row g-3">
                        <div class="col-md-4">
                            <div class="timeline-detail-item">
                                <div class="timeline-detail-label">Nama</div>
                                <div class="timeline-detail-value" id="detailName">-</div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="timeline-detail-item">
                                <div class="timeline-detail-label">Booking ID</div>
                                <div class="timeline-detail-value" id="detailBookingId">-</div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="timeline-detail-item">
                                <div class="timeline-detail-label">Status</div>
                                <div class="timeline-detail-value" id="detailStatus">-</div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="timeline-detail-item">
                                <div class="timeline-detail-label">Type Unit</div>
                                <div class="timeline-detail-value" id="detailTypeUnit">-</div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="timeline-detail-item">
                                <div class="timeline-detail-label">Jenis Unit</div>
                                <div class="timeline-detail-value" id="detailJenisUnit">-</div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="timeline-detail-item">
                                <div class="timeline-detail-label">Jatuh Tempo</div>
                                <div class="timeline-detail-value" id="detailJatuhTempo">-</div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="timeline-detail-item">
                                <div class="timeline-detail-label">Angsuran</div>
                                <div class="timeline-detail-value price" id="detailAngsuran">-</div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="timeline-detail-item">
                                <div class="timeline-detail-label">Denda</div>
                                <div class="timeline-detail-value" id="detailDenda">-</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th style="width: 60px;">No</th>
                                <th>Tanggal Jatuh Tempo</th>
                                <th>Nominal Angsuran</th>
                                <th>Status</th>
                                <th>Denda</th>
                                <th>Bukti Pembayaran</th>
                                <th>Total Bayar</th>
                            </tr>
                        </thead>
                        <tbody id="timelineTableBody"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
function showLoading(message = 'Mohon tunggu sebentar') {
    Swal.fire({
        title: 'Memuat...',
        html: message,
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });
}

function openEditModal(id, nama, tenor, totalBulan, jatuhTempo, denda, status) {
    document.getElementById('tenorId').value = id;
    document.getElementById('namaTenor').value = nama;
    document.getElementById('tenorValue').value = tenor;
    document.getElementById('totalBulan').value = totalBulan;
    document.getElementById('jatuhTempo').value = jatuhTempo;
    document.getElementById('dendaValue').value = denda;
    document.getElementById('statusValue').value = status;

    const modal = new bootstrap.Modal(document.getElementById('modalTenor'));
    modal.show();
}

function showAction(type, id) {
    Swal.fire({
        icon: 'info',
        title: type,
        text: type + ' untuk data ID ' + id + '.',
        confirmButtonColor: '#9a55ff'
    });
}

function renderStatusBadge(status) {
    const s = (status || '').toLowerCase();

    if (s === 'lunas' || s === 'aktif') {
        return `<span class="badge-payment-status active">${status}</span>`;
    }
    if (s === 'pending' || s === 'belum bayar') {
        return `<span class="badge-payment-status pending">${status}</span>`;
    }
    if (s === 'terlambat') {
        return `<span class="badge-payment-status late">${status}</span>`;
    }

    return `<span class="badge-payment-status pending">${status}</span>`;
}

document.addEventListener('DOMContentLoaded', function () {
    $('.select2-customer').select2({
        theme: 'bootstrap-5',
        placeholder: '-- Pilih Customer / Unit --',
        allowClear: true,
        width: '100%',
        dropdownParent: $('#modalCreatePayment'),
        minimumResultsForSearch: 0,
        language: {
            noResults: function() {
                return "Data tidak ditemukan";
            },
            searching: function() {
                return "Mencari...";
            }
        }
    });

    const filterForm = document.getElementById('filterForm');
    if (filterForm) {
        filterForm.addEventListener('submit', function () {
            showLoading('Sedang memfilter data...');
        });
    }

    document.querySelectorAll('.btn-reset-filter').forEach(button => {
        button.addEventListener('click', function (e) {
            e.preventDefault();
            showLoading('Sedang mereset filter...');
            window.location.href = this.href;
        });
    });

    document.querySelectorAll('.btn-page-link').forEach(button => {
        button.addEventListener('click', function (e) {
            e.preventDefault();
            showLoading('Sedang memuat halaman...');
            window.location.href = this.href;
        });
    });

    document.querySelectorAll('.btn-sort-link').forEach(button => {
        button.addEventListener('click', function (e) {
            e.preventDefault();
            showLoading('Sedang mengurutkan data...');
            window.location.href = this.href;
        });
    });

    document.querySelectorAll('.btn-detail-timeline').forEach(button => {
        button.addEventListener('click', function () {
            showLoading('Sedang memuat detail timeline...');

            document.getElementById('detailName').textContent = this.dataset.name || '-';
            document.getElementById('detailBookingId').textContent = this.dataset.bookingId || '-';
            document.getElementById('detailStatus').textContent = this.dataset.status || '-';
            document.getElementById('detailTypeUnit').textContent = this.dataset.typeUnit || '-';
            document.getElementById('detailJenisUnit').textContent = this.dataset.jenisUnit || '-';
            document.getElementById('detailJatuhTempo').textContent = this.dataset.jatuhTempo || '-';
            document.getElementById('detailAngsuran').textContent = this.dataset.angsuran || '-';
            document.getElementById('detailDenda').textContent = this.dataset.denda || '-';

            const tbody = document.getElementById('timelineTableBody');
            tbody.innerHTML = '';

            let installments = [];
            try {
                installments = JSON.parse(this.dataset.installments || '[]');
            } catch (e) {
                installments = [];
            }

            if (Array.isArray(installments) && installments.length > 0) {
                installments.forEach((item) => {
                    tbody.insertAdjacentHTML('beforeend', `
                        <tr>
                            <td>${item.no}</td>
                            <td>${item.tanggal}</td>
                            <td class="total-paid">${item.nominal}</td>
                            <td>${renderStatusBadge(item.status)}</td>
                            <td>${item.denda}</td>
                            <td class="text-center">
                                ${item.bukti && item.bukti_url
                                    ? `<a href="${item.bukti_url}" target="_blank" class="btn-eye-purple">
                                            <i class="mdi mdi-eye-outline"></i>Lihat
                                       </a>`
                                    : '-'
                                }
                            </td>
                            <td class="total-paid">${item.total}</td>
                        </tr>
                    `);
                });
            } else {
                tbody.innerHTML = `
                    <tr>
                        <td colspan="7" class="text-center text-muted py-4">
                            Belum ada data pembayaran
                        </td>
                    </tr>
                `;
            }

            Swal.close();
        });
    });

    const selectTenor = document.getElementById('selectTenor');
    const selectCashTempo = document.getElementById('selectCashTempo');
    const nominalDisplay = document.getElementById('nominalAngsuranDisplay');
    const nominalInput = document.getElementById('nominalAngsuran');

    if (selectTenor && selectCashTempo) {
        selectTenor.addEventListener('change', function () {
            const tenorId = this.value;

            Array.from(selectCashTempo.options).forEach(option => {
                const optionTenor = option.dataset.tenor;
                if (!optionTenor) return;
                option.hidden = optionTenor != tenorId;
            });

            selectCashTempo.value = '';
            nominalDisplay.value = '';
            nominalInput.value = 0;
        });

        selectCashTempo.addEventListener('change', function () {
            const nominal = this.options[this.selectedIndex]?.dataset.nominal || 0;
            nominalInput.value = nominal;
            nominalDisplay.value = nominal ? 'Rp ' + Number(nominal).toLocaleString('id-ID') : '';
        });
    }

    const buktiPembayaran = document.getElementById('buktiPembayaran');
    if (buktiPembayaran) {
        buktiPembayaran.addEventListener('change', function(e) {
            const file = e.target.files[0];
            const fileName = document.getElementById('fileName');
            const fileSize = document.getElementById('fileSize');

            if (file) {
                fileName.textContent = file.name.length > 30 ? file.name.substring(0, 30) + '...' : file.name;
                fileSize.textContent = (file.size / (1024 * 1024)).toFixed(2) + ' MB';
                fileSize.style.display = 'inline-block';
            } else {
                fileName.textContent = 'Upload Bukti Pembayaran';
                fileSize.textContent = '';
                fileSize.style.display = 'none';
            }
        });
    }

    const formCreatePayment = document.getElementById('formCreatePayment');
    if (formCreatePayment) {
        formCreatePayment.addEventListener('submit', function (e) {
            e.preventDefault();

            const form = this;
            const formData = new FormData(form);
            const submitBtn = form.querySelector('.btn-save-payment');

            showLoading('Sedang menyimpan pembayaran...');
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="mdi mdi-loading mdi-spin me-1"></i>Menyimpan...';

            fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')
                }
            })
            .then(async response => {
                const data = await response.json().catch(() => ({}));
                if (!response.ok) throw new Error(data.message || 'Terjadi kesalahan');
                return data;
            })
            .then(() => {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: 'Pembayaran berhasil disimpan',
                    confirmButtonColor: '#9a55ff'
                }).then(() => window.location.reload());
            })
            .catch(error => {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: error.message || 'Terjadi kesalahan',
                    confirmButtonColor: '#dc3545'
                });
            })
            .finally(() => {
                submitBtn.disabled = false;
                submitBtn.innerHTML = '<i class="mdi mdi-content-save me-1"></i>Simpan Pembayaran';
            });
        });
    }

    document.querySelectorAll('.btn-delete-tenor').forEach(button => {
        button.addEventListener('click', function () {
            const id = this.dataset.id;

            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: 'Data tenor yang dihapus tidak dapat dikembalikan.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    showLoading('Sedang menghapus data...');
                    setTimeout(() => {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'Silakan hubungkan ke route delete untuk ID ' + id,
                            confirmButtonColor: '#9a55ff'
                        });
                    }, 700);
                }
            });
        });
    });

    @if (session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: "{{ session('success') }}",
            confirmButtonColor: '#9a55ff'
        });
    @endif

    @if ($errors->any())
        Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: "{{ $errors->first() }}",
            confirmButtonColor: '#dc3545'
        });
    @endif
});
</script>
@endpush
