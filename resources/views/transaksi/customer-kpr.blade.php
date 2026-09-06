@extends('layouts.partial.app')

@section('title', 'Daftar User KPR - Property Management App')

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
    background: #ffffff;
    border-radius: 12px;
    padding: 0;
    margin-bottom: 1.25rem;
    border: none;
}

/* Search Input Group in Filter (Input on Left, Purple Button on Right) */
.search-input-group {
    display: flex !important;
    flex-wrap: nowrap !important;
    align-items: stretch !important;
    width: 100% !important;
    height: 38px !important;
}

.search-input-group .form-control {
    height: 38px !important;
    min-height: 38px !important;
    border-top-left-radius: 8px !important;
    border-bottom-left-radius: 8px !important;
    border-top-right-radius: 0 !important;
    border-bottom-right-radius: 0 !important;
    border: 1.5px solid #e2e8f0 !important;
    border-right: none !important;
    font-size: 0.88rem !important;
    padding: 0.45rem 0.85rem !important;
    margin: 0 !important;
    flex: 1 1 auto;
}

.search-input-group .btn-search-submit {
    height: 38px !important;
    min-height: 38px !important;
    border-top-left-radius: 0 !important;
    border-bottom-left-radius: 0 !important;
    border-top-right-radius: 8px !important;
    border-bottom-right-radius: 8px !important;
    padding: 0 0.95rem !important;
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    box-shadow: none !important;
    border: none !important;
    font-size: 1.15rem !important;
    color: #ffffff !important;
    margin: 0 !important;
    flex-shrink: 0;
}

.search-input-group:focus-within .form-control {
    border-color: #9a55ff !important;
    box-shadow: 0 0 0 3px rgba(154, 85, 255, 0.15) !important;
}

/* SELECT2 ENHANCEMENTS */
.select2-container--bootstrap-5 .select2-selection {
    border: 1.5px solid #e2e8f0 !important;
    border-radius: 8px !important;
    min-height: 38px !important;
    height: 38px !important;
    padding: 0.35rem 0.75rem !important;
    font-family: inherit !important;
    background-color: #ffffff !important;
}

.select2-container--bootstrap-5 .select2-selection--single .select2-selection__rendered {
    color: #2c2e3f !important;
    font-size: 0.88rem !important;
    font-weight: 600 !important;
    line-height: 24px !important;
    padding-left: 0 !important;
}

.select2-container--bootstrap-5 .select2-selection--single .select2-selection__arrow {
    height: 36px !important;
    right: 8px !important;
}

.select2-container--bootstrap-5 .select2-selection:hover,
.select2-container--bootstrap-5.select2-container--focus .select2-selection,
.select2-container--bootstrap-5.select2-container--open .select2-selection {
    border-color: #9a55ff !important;
    box-shadow: 0 0 0 3px rgba(154, 85, 255, 0.12) !important;
}

.select2-container--bootstrap-5 .select2-dropdown {
    border-color: #e2e8f0 !important;
    border-radius: 8px !important;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08) !important;
}

.select2-container--bootstrap-5 .select2-results__option {
    padding: 0.55rem 0.8rem !important;
    font-size: 0.86rem !important;
    font-weight: 600 !important;
}

.select2-container--bootstrap-5 .select2-results__option--selected {
    background-color: #f3e8ff !important;
    color: #7e22ce !important;
}

.select2-container--bootstrap-5 .select2-results__option--highlighted {
    background: #9a55ff !important;
    color: #ffffff !important;
}

.form-control, .form-select {
    border: 1px solid #e9ecef;
    border-radius: 8px;
    padding: 0.6rem 0.8rem;
    font-size: 0.9rem;
    transition: all 0.2s ease;
    background-color: #ffffff;
    color: #2c2e3f;
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
.btn:hover {
    transform: translateY(-2px);
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
    background: linear-gradient(135deg, #28c76f, #48da89) !important;
    color: #ffffff !important;
    box-shadow: 0 4px 10px rgba(40, 199, 111, 0.18);
}
.btn-gradient-success:hover {
    box-shadow: 0 7px 16px rgba(40, 199, 111, 0.28);
}

.btn-icon-only {
    width: 40px;
    height: 40px;
    padding: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 8px;
}

.table-responsive {
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
    border-radius: 8px;
    margin-bottom: 0.5rem;
    scrollbar-width: thin;
    scrollbar-color: #9a55ff #f0f0f0;
}
.table-responsive::-webkit-scrollbar {
    width: 8px;
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
    position: sticky;
    top: 0;
    z-index: 10;
    cursor: pointer;
    transition: all 0.2s ease;
}
.table thead th:hover {
    color: #7a3fcc;
}
.table thead th i {
    font-size: 0.8rem;
    margin-left: 4px;
    opacity: 0.5;
}
.table thead th:first-child,
.table tbody td:first-child {
    width: 50px;
    text-align: center;
}
.table tbody td {
    vertical-align: middle;
    font-size: 0.9rem;
    padding: 0.9rem 0.6rem;
    border-bottom: 1px solid #e9ecef;
    color: #2c2e3f;
    white-space: nowrap;
}
.table tbody tr:hover { background-color: #f8f9fa; }

.customer-cell {
    display: flex;
    align-items: center;
    gap: 0.75rem;
}
.customer-initial {
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
    box-shadow: 0 4px 12px rgba(154, 85, 255, 0.18);
}
.customer-name {
    font-weight: 700;
    color: #2c2e3f;
    font-size: 0.9rem;
}

.badge-status {
    padding: 0.45rem 0.9rem;
    border-radius: 20px;
    font-weight: 700;
    font-size: 0.76rem;
    display: inline-block;
    letter-spacing: 0.3px;
}
.badge-status.booking {
    background: linear-gradient(135deg, #ffc107, #ffdb6d);
    color: #2c2e3f;
}
.badge-status.proses {
    background: linear-gradient(135deg, #17a2b8, #56c6d8);
    color: #ffffff;
}
.badge-status.approved {
    background: linear-gradient(135deg, #28c76f, #48da89);
    color: #ffffff;
}
.badge-status.lanjut_kpr {
    background: linear-gradient(135deg, #6c757d, #868e96);
    color: #ffffff;
}
.badge-status.default {
    background: linear-gradient(135deg, #adb5bd, #c7ced4);
    color: #ffffff;
}

.badge {
    padding: 0.35rem 0.6rem;
    font-size: 0.75rem;
    font-weight: 600;
    border-radius: 30px;
    display: inline-block;
    white-space: nowrap;
}
@media (min-width: 576px) { .badge { padding: 0.4rem 0.75rem; font-size: 0.8rem; } }
.badge-gradient-success { background: linear-gradient(135deg, #28a745, #5cb85c); color: #ffffff; }
.badge-gradient-primary { background: linear-gradient(to right, #da8cff, #9a55ff) !important; color: #ffffff !important; }
.badge-gradient-secondary { background: #6c757d !important; color: #ffffff !important; }

.badge-doc {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 0.45rem;
    padding: 0.65rem 1rem;
    border-radius: 12px;
    background: #ffffff;
    color: #9a55ff;
    font-weight: 700;
    font-size: 0.9rem;
    cursor: pointer;
    border: 1.5px solid #9a55ff;
    min-width: 78px;
    transition: all 0.3s ease;
    box-shadow: 0 3px 8px rgba(154, 85, 255, 0.14);
}
.badge-doc:hover {
    background: #9a55ff;
    color: #ffffff;
    border-color: #9a55ff;
    box-shadow: 0 8px 20px rgba(154, 85, 255, 0.30);
    transform: translateY(-2px);
}

.text-price {
    color: #28a745 !important;
    font-weight: 700;
}

.text-belum-upload {
    display: inline-block;
    padding: 0.55rem 0.9rem;
    border-radius: 10px;
    background: #f1f3f5;
    color: #868e96;
    font-size: 0.82rem;
    font-weight: 700;
}

.pagination { margin: 0; gap: 3px; }
.page-item .page-link {
    border: 1px solid #e9ecef;
    padding: 0.35rem 0.7rem;
    font-size: 0.75rem;
    color: #6c7383;
    background-color: #ffffff;
    border-radius: 6px !important;
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

.text-primary  { color: #9a55ff !important; }
.text-muted    { color: #a5b3cb !important; }
.fw-bold       { font-weight: 600 !important; }

h3.text-dark, h4.text-dark {
    font-weight: 700;
    color: #2c2e3f !important;
    margin-bottom: 0.5rem !important;
}

.mdi { vertical-align: middle; }

.filter-row-desktop {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}
.filter-row-desktop .filter-text {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: #9a55ff;
    font-weight: 600;
    font-size: 0.95rem;
}
.filter-row-mobile { display: none; }

@media (max-width: 767px) {
    .filter-row-desktop { display: none; }
    .filter-row-mobile { display: block; margin-top: 1rem; }
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

.document-name {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}
.document-action-cell {
    text-align: right;
}

.customer-detail-card {
    background: linear-gradient(135deg, #faf7ff, #f4efff);
    border: 1px solid #eadcff;
    border-radius: 14px;
    padding: 1rem;
    margin-bottom: 1rem;
}
.customer-detail-title {
    font-size: 0.95rem;
    font-weight: 700;
    color: #9a55ff;
    margin-bottom: 0.85rem;
}
.customer-detail-item {
    background: #ffffff;
    border: 1px solid #efe6ff;
    border-radius: 10px;
    padding: 0.75rem 0.85rem;
    height: 100%;
}
.customer-detail-label {
    font-size: 0.75rem;
    color: #8b8fa3;
    margin-bottom: 0.2rem;
    font-weight: 600;
}
.customer-detail-value {
    font-size: 0.92rem;
    color: #2c2e3f;
    font-weight: 700;
}
.customer-detail-value.price {
    color: #28a745;
}

/* MODAL TABLE ACTION */
.btn-action-purple {
    display: inline-flex;
    align-items: center;
    gap: 0.4rem;
    padding: 0.45rem 0.9rem;
    border-radius: 10px;
    border: 1.5px solid #9a55ff;
    background: #fff;
    color: #9a55ff;
    font-size: 0.82rem;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.25s ease;
}

.btn-action-purple i, .btn-action-green i {
    font-size: 1rem;
}

.btn-action-purple:hover {
    background: linear-gradient(135deg, #da8cff, #9a55ff);
    color: #fff;
    border-color: #9a55ff;
    box-shadow: 0 6px 18px rgba(154, 85, 255, 0.22);
    transform: translateY(-2px);
}

.btn-action-green {
    display: inline-flex;
    align-items: center;
    gap: 0.4rem;
    padding: 0.45rem 0.9rem;
    border-radius: 10px;
    border: 1.5px solid #28c76f;
    background: #fff;
    color: #28c76f;
    font-size: 0.82rem;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.25s ease;
}

.btn-action-green:hover {
    background: linear-gradient(135deg, #48da89, #28c76f);
    color: #fff;
    border-color: #28c76f;
    box-shadow: 0 6px 18px rgba(40, 199, 111, 0.22);
    transform: translateY(-2px);
}

.doc-name-inline {
    display: inline-flex;
    align-items: center;
    gap: 0.55rem;
}

.doc-file-icon {
    width: 36px;
    height: 36px;
    border-radius: 10px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #f3e8ff, #efe2ff);
    color: #9a55ff;
    font-size: 1.1rem;
    border: 1px solid #eadbff;
    flex-shrink: 0;
}

.col-no-small {
    width: 55px;
    min-width: 55px;
    max-width: 55px;
    text-align: center;
}

/* ===== MODERN FILE UPLOAD STYLING ===== */
.properti-file-upload-modern {
    position: relative;
    width: 100%;
}

.properti-file-upload-modern input[type="file"] {
    position: absolute;
    opacity: 0;
    width: 100%;
    height: 100%;
    cursor: pointer;
    z-index: 2;
}

.properti-file-upload-modern .properti-file-label-modern {
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
    .properti-file-upload-modern .properti-file-label-modern {
        flex-direction: row;
        text-align: left;
        gap: 8px;
        padding: 0.75rem 1rem;
        min-height: auto;
    }
}

.properti-file-upload-modern:hover .properti-file-label-modern {
    border-color: #9a55ff;
    background: linear-gradient(135deg, #f1f0ff, #f8f9fa);
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(154, 85, 255, 0.1);
}

.properti-file-upload-modern .properti-file-label-modern i {
    font-size: 1.6rem;
    color: #9a55ff;
    background: rgba(154, 85, 255, 0.1);
    padding: 8px;
    border-radius: 50%;
}

.properti-file-upload-modern .properti-file-label-modern .properti-file-info-modern {
    flex: 1;
    width: 100%;
}

.properti-file-upload-modern .properti-file-label-modern .properti-file-info-modern span {
    display: block;
    font-weight: 600;
    color: #2c2e3f;
    font-size: 0.8rem;
    word-break: break-word;
}

.properti-file-upload-modern .properti-file-label-modern .properti-file-info-modern small {
    color: #6c7383;
    font-size: 0.65rem;
    display: block;
    margin-top: 2px;
}

.properti-file-upload-modern .properti-file-label-modern .properti-file-size {
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
    .properti-file-upload-modern .properti-file-label-modern .properti-file-size {
        margin-top: 0;
    }
}
</style>

<div class="container-fluid p-2 p-sm-3 p-md-4">

    <div class="row mb-3 mb-sm-3 mb-md-4">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="text-dark mb-1">
                            <i class="mdi mdi-bank me-2" style="color: #9a55ff;"></i>Daftar User KPR
                        </h4>
                        <p class="text-muted mb-0">
                            Kelola data user yang mengajukan KPR
                        </p>
                    </div>
                    <div class="d-none d-sm-block">
                        <i class="mdi mdi-home-account" style="font-size: 2.5rem; color: #9a55ff; opacity: 0.2;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-2 mt-sm-2 mt-md-3">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-white d-flex flex-wrap justify-content-between align-items-center gap-2">
                    <h5 class="card-title mb-0">
                        <i class="mdi mdi-format-list-bulleted me-2"></i>Data User KPR
                    </h5>
                </div>

                <div class="card-body">
                    <!-- Filter Section -->
                    <div class="filter-card mb-3">
                        <form method="GET" action="{{ route('customer.kpr') }}" id="filterForm">
                            <!-- FILTER DESKTOP -->
                            <div class="filter-row-desktop d-none d-md-block">
                                <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 w-100">
                                    <div class="d-flex flex-wrap align-items-center gap-2 flex-grow-1">
                                        <!-- Search Input -->
                                        <div style="min-width: 220px; max-width: 280px; flex: 1;">
                                            <div class="input-group search-input-group">
                                                <input type="text" name="search" value="{{ request('search') }}"
                                                    class="form-control" placeholder="Cari nama user...">
                                                <button class="btn btn-gradient-primary btn-search-submit" 
                                                    type="submit" title="Cari">
                                                    <i class="mdi mdi-magnify"></i>
                                                </button>
                                            </div>
                                        </div>

                                        <!-- Filter Status Dropdown -->
                                        <div style="width: 190px;">
                                            <select name="status" class="form-control select2" id="statusSelect" style="width: 100%;">
                                                <option value="">Semua Status</option>
                                                <option value="booking" {{ request('status') == 'booking' ? 'selected' : '' }}>Booking</option>
                                                <option value="proses" {{ in_array(request('status'), ['proses', 'menunggu']) ? 'selected' : '' }}>Menunggu Verifikasi</option>
                                                <option value="revisi" {{ request('status') == 'revisi' ? 'selected' : '' }}>Perlu Revisi</option>
                                                <option value="survey" {{ request('status') == 'survey' ? 'selected' : '' }}>Survey</option>
                                                <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                                                <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Ditolak</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Right Side: Limit Dropdown + Filter & Reset Buttons -->
                                    <div class="d-flex align-items-center gap-2 ms-auto">
                                        <div style="width: 90px;">
                                            <select name="per_page" class="form-control select2" id="perPageSelect" style="width: 100%;">
                                                <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10</option>
                                                <option value="15" {{ request('per_page', 15) == 15 ? 'selected' : '' }}>15</option>
                                                <option value="25" {{ request('per_page', 25) == 25 ? 'selected' : '' }}>25</option>
                                            </select>
                                        </div>
                                        <button type="submit"
                                            class="btn btn-gradient-primary btn-icon-only"
                                            id="filterBtn" title="Filter" onclick="showFilterLoading()">
                                            <i class="mdi mdi-filter"></i>
                                        </button>
                                        <a href="{{ route('customer.kpr') }}"
                                            class="btn btn-gradient-secondary btn-icon-only"
                                            title="Reset" onclick="showResetLoading(event)">
                                            <i class="mdi mdi-refresh"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!-- FILTER MOBILE -->
                            <div class="d-block d-md-none">
                                <div class="row g-2">
                                    <div class="col-12 mb-2">
                                        <div class="input-group search-input-group">
                                            <input type="text" name="search_mobile"
                                                value="{{ request('search') }}" class="form-control"
                                                placeholder="Cari nama user..." id="searchMobile">
                                            <button class="btn btn-gradient-primary btn-search-submit" 
                                                type="submit" title="Cari">
                                                <i class="mdi mdi-magnify"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-6 mb-2">
                                        <select name="status_mobile" class="form-control select2-mobile" id="statusSelectMobile" style="width: 100%;">
                                            <option value="">Semua Status</option>
                                            <option value="booking" {{ request('status') == 'booking' ? 'selected' : '' }}>Booking</option>
                                            <option value="proses" {{ in_array(request('status'), ['proses', 'menunggu']) ? 'selected' : '' }}>Menunggu Verifikasi</option>
                                            <option value="revisi" {{ request('status') == 'revisi' ? 'selected' : '' }}>Perlu Revisi</option>
                                            <option value="survey" {{ request('status') == 'survey' ? 'selected' : '' }}>Survey</option>
                                            <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                                            <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Ditolak</option>
                                        </select>
                                    </div>
                                    <div class="col-6 mb-2">
                                        <select name="per_page_mobile" class="form-control select2-mobile" id="perPageSelectMobile" style="width: 100%;">
                                            <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10</option>
                                            <option value="15" {{ request('per_page', 15) == 15 ? 'selected' : '' }}>15</option>
                                            <option value="25" {{ request('per_page', 25) == 25 ? 'selected' : '' }}>25</option>
                                        </select>
                                    </div>
                                    <div class="col-6">
                                        <button type="submit"
                                            class="btn btn-gradient-primary w-100 d-inline-flex align-items-center justify-content-center"
                                            id="filterBtnMobile" title="Filter"
                                            onclick="showFilterLoading()" style="height: 38px;">
                                            <i class="mdi mdi-filter me-1"></i>Filter
                                        </button>
                                    </div>
                                    <div class="col-6">
                                        <a href="{{ route('customer.kpr') }}"
                                            class="btn btn-gradient-secondary w-100 d-inline-flex align-items-center justify-content-center"
                                            title="Reset" onclick="showResetLoading(event)" style="height: 38px; text-decoration: none;">
                                            <i class="mdi mdi-refresh me-1"></i>Reset
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="sortable" data-field="name" data-direction="{{ request('sort', 'latest') == 'name_asc' ? 'asc' : 'desc' }}" style="cursor:pointer;">
                                        Nama User
                                        <i class="mdi {{ request('sort') == 'name_asc' ? 'mdi-sort-alphabetical-ascending' : (request('sort') == 'name_desc' ? 'mdi-sort-alphabetical-descending' : 'mdi-sort') }}"></i>
                                    </th>
                                    <th class="sortable" data-field="unit" data-direction="{{ request('sort', 'latest') == 'unit_asc' ? 'asc' : 'desc' }}" style="cursor:pointer;">
                                        Nama - Unit
                                        <i class="mdi {{ request('sort') == 'unit_asc' ? 'mdi-sort-alphabetical-ascending' : (request('sort') == 'unit_desc' ? 'mdi-sort-alphabetical-descending' : 'mdi-sort') }}"></i>
                                    </th>
                                    <th>Jenis & Tipe</th>
                                    <th>Harga</th>
                                    <th>Sales/Agent</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Tanggal Booking</th>
                                    <th class="text-center" style="width: 110px;">Dokumen</th>
                                    <th class="text-center" style="width: 140px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($bookings ?? [] as $booking)
                                    @php
                                        $uploadedDocs = $booking->kprApplication?->documents ?? collect();
                                        $totalUploaded = $uploadedDocs->count();
                                        $approvedDocsCount = $uploadedDocs->where('status', 'disetujui')->count();
                                        $revisiDocsCount   = $uploadedDocs->where('status', 'revisi')->count();
                                        $rejectedDocsCount = $uploadedDocs->where('status', 'ditolak')->count();
                                        $pendingDocsCount  = $uploadedDocs->where('status', 'pending')->count();

                                        $requiredTypes = [
                                            'ktp', 'kk', 'slip_gaji', 'rekening_koran',
                                            'npwp', 'sku', 'surat_nikah', 'ktp_pasangan'
                                        ];

                                        $uploadedStandardCount = $uploadedDocs->whereIn('type', $requiredTypes)->count();

                                        $customerName = $booking->customer->full_name ?? '-';
                                        $words = collect(explode(' ', trim($customerName)))->filter();
                                        $initial = $words->count() >= 2
                                            ? strtoupper(substr($words->first(), 0, 1) . substr($words->last(), 0, 1))
                                            : strtoupper(substr($customerName, 0, 2));

                                        $kprStatus = strtolower($booking->kprApplication?->status ?? '');
                                    @endphp
                                    <tr>
                                        <td class="text-center fw-bold">
                                            {{ $loop->iteration + (($bookings->currentPage() - 1) * $bookings->perPage()) }}
                                        </td>
                                        <td>
                                            <div class="customer-cell">
                                                <span class="customer-initial">{{ $initial }}</span>
                                                <span class="customer-name">{{ $customerName }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex flex-column">
                                                <div class="d-flex align-items-center">
                                                    <i class="mdi mdi-home-city-outline text-primary me-1.5"></i>
                                                    <span class="fw-bold text-dark">{{ $booking->unit->unit_name ?? '-' }} - {{ $booking->unit->unit_code ?? '-' }}</span>
                                                </div>
                                                @php
                                                    $bProg = strtolower($booking->unit->construction_progress ?? 'belum_mulai');
                                                    $bPercent = $booking->unit->construction_progress_percentage ?? 0;
                                                    $bLabelMap = [
                                                        'belum_mulai' => 'Belum Mulai',
                                                        'pondasi'     => 'Pondasi',
                                                        'dinding'     => 'Dinding',
                                                        'atap'        => 'Atap',
                                                        'finishing'   => 'Finishing',
                                                        'selesai'     => 'Selesai 100%',
                                                    ];
                                                    $bLabel = $bLabelMap[$bProg] ?? ucfirst($bProg);
                                                @endphp
                                                <div class="mt-1">
                                                    <span class="badge {{ $bProg === 'selesai' ? 'bg-success text-white' : 'bg-light text-secondary border' }}" style="font-size: 0.68rem; padding: 2px 6px;">
                                                        <i class="mdi {{ $bProg === 'selesai' ? 'mdi-check-decagram' : 'mdi-home-city-outline' }} me-0.5"></i>Fisik: {{ $bLabel }} ({{ $bPercent }}%)
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            @php
                                                $jenis = $booking->unit->jenis ?? '';
                                                $tipe = $booking->unit->type ?? '-';
                                            @endphp
                                            @if (strtolower($jenis) == 'subsidi')
                                                <span class="badge badge-gradient-success">
                                                    <i class="mdi mdi-home-assistant me-1"></i>{{ $jenis }} - {{ $tipe }}
                                                </span>
                                            @elseif(strtolower($jenis) == 'komersil')
                                                <span class="badge badge-gradient-primary">
                                                    <i class="mdi mdi-office-building me-1"></i>{{ $jenis }} - {{ $tipe }}
                                                </span>
                                            @else
                                                <span class="badge badge-gradient-secondary">
                                                    <i class="mdi mdi-help-circle-outline me-1"></i>{{ ($jenis ?: '-') . ' - ' . $tipe }}
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="text-price">Rp {{ number_format($booking->unit->price ?? 0, 0, ',', '.') }}</span>
                                        </td>
                                        <td>
                                            @if ($booking->sales)
                                                @php
                                                    $salesName = $booking->sales->name;
                                                    $sInitials = '';
                                                    foreach (explode(' ', trim($salesName)) as $word) {
                                                        if ($word !== '') {
                                                            $sInitials .= strtoupper(substr($word, 0, 1));
                                                        }
                                                    }
                                                    $sInitials = substr($sInitials ?: 'S', 0, 2);
                                                @endphp
                                                <div class="customer-info">
                                                    <div class="customer-initial" style="background: linear-gradient(135deg, #667eea, #764ba2);">
                                                        {{ $sInitials }}
                                                    </div>
                                                    <span>{{ $salesName }}</span>
                                                </div>
                                            @else
                                                <i class="mdi mdi-account-tie text-primary me-1"></i>
                                                -
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if ($kprStatus === 'approved')
                                                <span class="badge badge-gradient-success">
                                                    <i class="mdi mdi-check-decagram me-1"></i>Approved
                                                </span>
                                            @elseif ($kprStatus === 'survey')
                                                <span class="badge badge-gradient-primary">
                                                    <i class="mdi mdi-account-search me-1"></i>Survey
                                                </span>
                                            @elseif ($kprStatus === 'rejected')
                                                <span class="badge bg-danger text-white">
                                                    <i class="mdi mdi-close-octagon me-1"></i>Ditolak
                                                </span>
                                            @elseif ($revisiDocsCount > 0)
                                                <span class="badge bg-warning text-dark">
                                                    <i class="mdi mdi-alert-circle me-1"></i>Perlu Revisi ({{ $revisiDocsCount }})
                                                </span>
                                            @elseif ($rejectedDocsCount > 0)
                                                <span class="badge bg-danger text-white">
                                                    <i class="mdi mdi-close-circle me-1"></i>Dokumen Ditolak
                                                </span>
                                            @elseif ($totalUploaded > 0 && $approvedDocsCount === $totalUploaded)
                                                <span class="badge bg-success text-white">
                                                    <i class="mdi mdi-check-circle me-1"></i>Dokumen Disetujui
                                                </span>
                                            @elseif ($booking->kprApplication)
                                                <span class="badge bg-info text-white">
                                                    <i class="mdi mdi-clock-outline me-1"></i>Menunggu Verifikasi
                                                </span>
                                            @else
                                                <span class="badge badge-gradient-secondary">
                                                    Belum Pengajuan
                                                </span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <i class="mdi mdi-calendar-month-outline text-primary me-1"></i>
                                            {{ \Carbon\Carbon::parse($booking->created_at)->format('d M Y') }}
                                        </td>
                                        <td class="text-center">
                                            @php
                                                $totalDocTarget = max(8, $totalUploaded);
                                                $verifyPercent = $totalDocTarget > 0 ? min(100, round(($approvedDocsCount / $totalDocTarget) * 100)) : 0;
                                                $docBadgeClass = 'badge-doc';
                                                if ($revisiDocsCount > 0) {
                                                    $docBadgeClass .= ' bg-warning text-dark border-warning';
                                                } elseif ($rejectedDocsCount > 0) {
                                                    $docBadgeClass .= ' bg-danger text-white border-danger';
                                                } elseif ($verifyPercent === 100) {
                                                    $docBadgeClass .= ' bg-success text-white border-success';
                                                }
                                            @endphp
                                            <div class="d-flex flex-column align-items-center justify-content-center gap-1" style="min-width: 105px;">
                                                <button
                                                    type="button"
                                                    class="{{ $docBadgeClass }} btnOpenDocumentModal d-inline-flex align-items-center justify-content-center gap-1 w-100"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#documentModal"
                                                    data-customer="{{ $customerName }}"
                                                    data-unit="{{ $booking->unit->unit_code ?? '-' }}"
                                                    data-status="{{ $booking->kprApplication ? strtoupper($booking->kprApplication->status) : 'DRAFT' }}"
                                                    data-harga="Rp {{ number_format($booking->unit->price ?? 0, 0, ',', '.') }}"
                                                    data-sales="{{ $booking->sales->name ?? '-' }}"
                                                    data-booking="{{ \Carbon\Carbon::parse($booking->created_at)->format('d M Y') }}"
                                                    data-documents='@json($uploadedDocs)'
                                                    data-percent="{{ $verifyPercent }}"
                                                    data-uploaded-count="{{ $uploadedStandardCount }}"
                                                    data-approved-count="{{ $approvedDocsCount }}"
                                                    data-total-count="{{ $totalDocTarget }}"
                                                    title="{{ $approvedDocsCount }}/{{ $totalDocTarget }} Dokumen Disetujui ({{ $verifyPercent }}%)">
                                                    <i class="mdi mdi-shield-check-outline"></i>
                                                    <span>{{ $approvedDocsCount }}/{{ $totalDocTarget }}</span>
                                                    <span class="ms-1 fw-bold" style="font-size: 0.73rem;">({{ $verifyPercent }}%)</span>
                                                </button>
                                                <div class="progress w-100" style="height: 6px; border-radius: 10px; background: #e2e8f0; overflow: hidden;">
                                                    <div class="progress-bar {{ $verifyPercent === 100 ? 'bg-success' : ($verifyPercent > 0 ? 'bg-primary' : 'bg-secondary') }}"
                                                         role="progressbar"
                                                         style="width: {{ $verifyPercent }}%; transition: width 0.4s ease;"
                                                         aria-valuenow="{{ $verifyPercent }}"
                                                         aria-valuemin="0"
                                                         aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="d-flex justify-content-center align-items-center">
                                                @php
                                                    $currentUser = auth()->user();
                                                    $posName = strtolower($currentUser->position->name ?? '');
                                                    $isKepalaMarketing = str_contains($posName, 'kepala') || ($currentUser->position_id ?? null) == 1 || str_contains($posName, 'admin') || str_contains($posName, 'direktur');

                                                    $isAlreadyApproved = in_array(strtolower($booking->status ?? ''), ['completed', 'sold', 'lunas', 'akad_selesai'])
                                                        || ($booking->kprApplication && in_array(strtolower($booking->kprApplication->status ?? ''), ['approved', 'survey', 'akad', 'completed', 'lunas', 'analisa']));
                                                @endphp

                                                @if($isAlreadyApproved)
                                                    <a href="{{ route('transaksi.kpr.approve', $booking->id) }}" class="btn btn-sm d-inline-flex align-items-center justify-content-center px-3" title="Pengajuan KPR ini sudah disetujui / diproses. Klik untuk melihat detail verifikasi & cetak Berita Acara"
                                                            style="background: #ecfdf5; color: #059669; border: 1.5px solid #10b981; border-radius: 8px; min-height: 34px; font-weight: 700; text-decoration: none; box-shadow: 0 2px 6px rgba(16, 185, 129, 0.12);">
                                                        <i class="mdi mdi-check-all me-1" style="font-size: 1.1rem; color: #10b981;"></i>Detail Selesai
                                                    </a>
                                                @elseif($isKepalaMarketing)
                                                    <a href="{{ route('transaksi.kpr.approve', $booking->id) }}"
                                                       class="btn btn-gradient-primary btn-sm btnApproveKpr d-inline-flex align-items-center justify-content-center px-3"
                                                       style="border-radius: 8px; min-height: 34px; font-weight: 700; box-shadow: 0 2px 8px rgba(154, 85, 255, 0.25);"
                                                       title="Verifikasi Dokumen & Pengajuan KPR">
                                                        <i class="mdi mdi-clipboard-check-outline me-1"></i>Verifikasi
                                                    </a>
                                                @else
                                                    {{-- Staff Marketing Role --}}
                                                    @if($revisiDocsCount > 0 || $rejectedDocsCount > 0)
                                                        <a href="{{ route('transaksi.kpr.approve', $booking->id) }}"
                                                           class="btn btn-sm {{ $revisiDocsCount > 0 ? 'btn-warning text-dark' : 'btn-danger text-white' }} d-inline-flex align-items-center justify-content-center px-3 font-weight-bold"
                                                           style="border-radius: 8px; min-height: 34px; font-weight: 700; box-shadow: 0 2px 8px rgba(255, 193, 7, 0.35);"
                                                           title="{{ ($revisiDocsCount + $rejectedDocsCount) }} dokumen perlu diperbaiki / diunggah ulang. Klik untuk upload berkas perbaikan">
                                                            <i class="mdi mdi-pencil-box-multiple me-1"></i>Perbaiki Dokumen ({{ $revisiDocsCount + $rejectedDocsCount }})
                                                        </a>
                                                    @else
                                                        <a href="{{ route('transaksi.kpr.approve', $booking->id) }}"
                                                           class="btn btn-sm d-inline-flex align-items-center justify-content-center px-3"
                                                           style="border-radius: 8px; min-height: 34px; font-weight: 700; background: #f3e8ff; color: #9a55ff; border: 1.5px solid #d8b4fe;"
                                                           title="Lihat Progress & Detail Validasi KPR">
                                                            <i class="mdi mdi-eye-outline me-1"></i>Lihat Progress
                                                        </a>
                                                    @endif
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="10" class="text-center text-muted py-4">
                                            Tidak ada data user KPR
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if(($bookings->count() ?? 0) > 0)
                        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mt-4">
                            <div class="pagination-info mb-2 mb-sm-0">
                                Menampilkan {{ $bookings->firstItem() }} - {{ $bookings->lastItem() }} dari {{ $bookings->total() }} data
                            </div>
                            <nav aria-label="Page navigation">
                                <ul class="pagination pagination-sm flex-wrap justify-content-center mb-0">
                                    @if ($bookings->onFirstPage())
                                        <li class="page-item disabled">
                                            <span class="page-link"><i class="mdi mdi-chevron-left"></i></span>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $bookings->previousPageUrl() }}" onclick="showPaginationLoading(event)"><i class="mdi mdi-chevron-left"></i></a>
                                        </li>
                                    @endif

                                    @foreach ($bookings->getUrlRange(1, $bookings->lastPage()) as $page => $url)
                                        <li class="page-item {{ $bookings->currentPage() == $page ? 'active' : '' }}">
                                            <a class="page-link" href="{{ $url }}" onclick="showPaginationLoading(event)">{{ $page }}</a>
                                        </li>
                                    @endforeach

                                    @if ($bookings->hasMorePages())
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $bookings->nextPageUrl() }}" onclick="showPaginationLoading(event)"><i class="mdi mdi-chevron-right"></i></a>
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

<div class="modal fade" id="documentModal" tabindex="-1" aria-labelledby="documentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="documentModalLabel">
                    <i class="mdi mdi-file-document-multiple-outline me-2"></i>Detail Dokumen User KPR
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="customer-detail-card">
                    <div class="customer-detail-title">
                        <i class="mdi mdi-account-box-outline me-1"></i>Detail User
                    </div>

                    <div class="row g-3">
                        <div class="col-md-4">
                            <div class="customer-detail-item">
                                <div class="customer-detail-label">Nama User</div>
                                <div class="customer-detail-value" id="detailCustomerName">-</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="customer-detail-item">
                                <div class="customer-detail-label">Status</div>
                                <div class="customer-detail-value" id="detailCustomerStatus">-</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="customer-detail-item">
                                <div class="customer-detail-label">Unit</div>
                                <div class="customer-detail-value" id="detailCustomerUnit">-</div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="customer-detail-item">
                                <div class="customer-detail-label">Harga</div>
                                <div class="customer-detail-value price" id="detailCustomerPrice">-</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="customer-detail-item">
                                <div class="customer-detail-label">Sales / Agent</div>
                                <div class="customer-detail-value" id="detailCustomerSales">-</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="customer-detail-item">
                                <div class="customer-detail-label">Tanggal Booking</div>
                                <div class="customer-detail-value" id="detailCustomerBooking">-</div>
                            </div>
                        </div>
                    </div>

                    <!-- PROGRESS VERIFIKASI MODAL -->
                    <div class="mt-3 pt-3 border-top">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <span class="small fw-bold text-dark d-flex align-items-center">
                                <i class="mdi mdi-shield-check-outline text-primary me-1" style="font-size:1.1rem;"></i>
                                Progress Verifikasi Dokumen (Kepala Marketing):
                            </span>
                            <span class="fw-bold" id="detailDocPercentText" style="color: #9a55ff; font-size: 0.88rem;">0%</span>
                        </div>
                        <div class="progress" style="height: 7px; border-radius: 10px; background: #e2e8f0; overflow: hidden;">
                            <div class="progress-bar bg-primary" id="detailDocProgressBar" role="progressbar" style="width: 0%; transition: width 0.4s ease;"></div>
                        </div>
                    </div>
                </div>

                <div class="table-responsive" style="max-height: 400px;">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th class="col-no-small">No</th>
                                <th>Nama Dokumen</th>
                                <th style="width: 28%;">Status Validasi</th>
                                <th class="text-end" style="width: 22%;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="documentTableBody"></tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Inisialisasi Select2
    $('#statusSelect').select2({
        theme: 'bootstrap-5',
        placeholder: 'Semua Status',
        allowClear: true,
        width: '100%',
        minimumResultsForSearch: Infinity
    });

    $('#perPageSelect').select2({
        theme: 'bootstrap-5',
        placeholder: '10',
        allowClear: false,
        width: '100%',
        minimumResultsForSearch: Infinity
    });

    $('#statusSelectMobile').select2({
        theme: 'bootstrap-5',
        placeholder: 'Semua Status',
        allowClear: true,
        width: '100%',
        minimumResultsForSearch: Infinity
    });

    $('#perPageSelectMobile').select2({
        theme: 'bootstrap-5',
        placeholder: '10',
        allowClear: false,
        width: '100%',
        minimumResultsForSearch: Infinity
    });

    // Search input sync between desktop and mobile
    $('input[name="search"]').on('input', function() {
        $('#searchMobile').val($(this).val());
    });
    $('#searchMobile').on('input', function() {
        $('input[name="search"]').val($(this).val());
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
        url.searchParams.set('sort', field + '_' + direction);
        url.searchParams.set('page', 1);

        window.location.href = url.toString();
    });

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

    function formatDocName(type) {
        if (!type) return 'Dokumen';
        return type.replace(/_/g, ' ').replace(/\b\w/g, function(l) {
            return l.toUpperCase();
        });
    }

    function formatStorageUrl(path) {
        if (!path) return '#';
        return "{{ asset('uploads') }}/" + path;
    }

    $(document).on('click', '.btnOpenDocumentModal', function() {
        let customer = $(this).data('customer') || '-';
        let unit = $(this).data('unit') || '-';
        let status = $(this).data('status') || '-';
        let harga = $(this).data('harga') || '-';
        let sales = $(this).data('sales') || '-';
        let bookingDate = $(this).data('booking') || '-';
        let documents = $(this).data('documents') || [];
        let percent = $(this).data('percent') || 0;
        let approvedCount = $(this).data('approved-count') || 0;
        let totalCount = $(this).data('total-count') || 8;

        $('#detailCustomerName').text(customer);
        $('#detailCustomerUnit').text(unit);
        $('#detailCustomerPrice').text(harga);
        $('#detailCustomerSales').text(sales);
        $('#detailCustomerStatus').text(status);
        $('#detailCustomerBooking').text(bookingDate);

        $('#detailDocPercentText').text(`${approvedCount}/${totalCount} Dokumen Disetujui (${percent}%)`);
        $('#detailDocProgressBar').css('width', `${percent}%`);
        if (percent === 100) {
            $('#detailDocProgressBar').removeClass('bg-primary bg-warning bg-secondary').addClass('bg-success');
        } else if (percent > 0) {
            $('#detailDocProgressBar').removeClass('bg-success bg-warning bg-secondary').addClass('bg-primary');
        } else {
            $('#detailDocProgressBar').removeClass('bg-success bg-primary bg-warning').addClass('bg-secondary');
        }

        let tbody = $('#documentTableBody');
        tbody.html('');

        const standardDocsList = [
            { type: 'ktp', label: 'KTP Pemohon' },
            { type: 'kk', label: 'Kartu Keluarga (KK)' },
            { type: 'npwp', label: 'NPWP Pemohon' },
            { type: 'slip_gaji', label: 'Slip Gaji 3 Bulan' },
            { type: 'rekening_koran', label: 'Rekening Koran' },
            { type: 'sku', label: 'SKU / Keterangan Kerja' },
            { type: 'surat_nikah', label: 'Buku / Surat Nikah' },
            { type: 'ktp_pasangan', label: 'KTP Pasangan' }
        ];

        let allModalDocs = [];

        // 1. Standard docs
        standardDocsList.forEach(function(sDoc) {
            let docInfo = false;
            if (Array.isArray(documents)) {
                docInfo = documents.find(d => d.type === sDoc.type);
            }
            allModalDocs.push({
                name: sDoc.label,
                is_custom: false,
                doc: docInfo
            });
        });

        // 2. Dynamic / custom docs
        if (Array.isArray(documents)) {
            documents.forEach(function(d) {
                const isStandard = standardDocsList.some(s => s.type === d.type);
                if (!isStandard) {
                    allModalDocs.push({
                        name: d.document_name || d.type,
                        is_custom: true,
                        doc: d
                    });
                }
            });
        }

        allModalDocs.forEach(function(item, index) {
            let docInfo = item.doc;
            let docUrl = (docInfo && docInfo.path) ? formatStorageUrl(docInfo.path) : null;

            let statusHtml = '';
            if (!docInfo) {
                statusHtml = '<span class="badge bg-secondary opacity-75"><i class="mdi mdi-minus-circle-outline me-1"></i>Belum Di-upload</span>';
            } else if (docInfo.status === 'disetujui') {
                statusHtml = '<span class="badge bg-success text-white"><i class="mdi mdi-check-circle me-1"></i>Disetujui</span>';
            } else if (docInfo.status === 'revisi') {
                statusHtml = `<span class="badge bg-warning text-dark"><i class="mdi mdi-alert-circle me-1"></i>Perlu Revisi</span>`;
                if (docInfo.catatan) {
                    statusHtml += `<div class="text-danger small mt-1" style="font-size:0.75rem;"><strong>Catatan:</strong> ${docInfo.catatan}</div>`;
                }
            } else if (docInfo.status === 'ditolak') {
                statusHtml = `<span class="badge bg-danger text-white"><i class="mdi mdi-close-circle me-1"></i>Ditolak</span>`;
                if (docInfo.catatan) {
                    statusHtml += `<div class="text-danger small mt-1" style="font-size:0.75rem;"><strong>Alasan:</strong> ${docInfo.catatan}</div>`;
                }
            } else {
                statusHtml = '<span class="badge bg-info text-white"><i class="mdi mdi-clock-outline me-1"></i>Menunggu</span>';
            }

            let actionHtml = '';
            if (docUrl) {
                actionHtml = `
                    <div class="d-flex justify-content-end gap-2">
                        <a href="${docUrl}" target="_blank" class="btn-action-purple">
                            <i class="mdi mdi-eye-outline me-1"></i>Lihat
                        </a>
                        <a href="${docUrl}" download class="btn-action-green">
                            <i class="mdi mdi-download me-1"></i>Download
                        </a>
                    </div>`;
            } else {
                actionHtml = `<span class="text-muted small">-</span>`;
            }

            tbody.append(`
                <tr>
                    <td class="col-no-small fw-bold">${index + 1}</td>
                    <td>
                        <div class="doc-name-inline">
                            <span class="doc-file-icon">
                                <i class="mdi mdi-file-document-outline"></i>
                            </span>
                            <span>
                                ${item.name}
                                ${item.is_custom ? '<span class="badge bg-light text-primary border ms-1" style="font-size:0.65rem;">Dinamis</span>' : ''}
                            </span>
                        </div>
                    </td>
                    <td>
                        ${statusHtml}
                    </td>
                    <td class="text-end">
                        ${actionHtml}
                    </td>
                </tr>
            `);
        });

    });



    // SweetAlert modal confirmation removed as requested: button navigates directly
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
