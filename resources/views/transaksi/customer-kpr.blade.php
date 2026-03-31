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
    background: linear-gradient(135deg, #f9f7ff, #f2ecff);
    border-radius: 12px;
    padding: 1rem;
    margin-bottom: 1.25rem;
    border: none;
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
    min-height: 40px;
    border: 1px solid #e0e4e9;
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

.btn-action-purple i {
    font-size: 1rem;
}

.btn-action-purple:hover {
    background: linear-gradient(135deg, #da8cff, #9a55ff);
    color: #fff;
    border-color: #9a55ff;
    box-shadow: 0 6px 18px rgba(154, 85, 255, 0.22);
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
                    <div class="filter-card mb-4">
                        <div class="card-body">
                            <div class="filter-row-desktop">
                                <div class="filter-text">
                                    <i class="mdi mdi-filter-outline"></i>
                                    <span>Filter data user KPR</span>
                                </div>

                                <form method="GET" action="{{ route('customer.kpr') }}">
                                    <div class="row g-2 align-items-end w-100">
                                        <div class="col-md-5">
                                            <label class="form-label">Search</label>
                                            <input type="text" class="form-control" name="search" value="{{ request('search') }}" placeholder="Cari nama user...">
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label">Filter Status</label>
                                            <select class="form-control" name="status">
                                                <option value="">Semua Status</option>
                                                <option value="booking" {{ request('status') == 'booking' ? 'selected' : '' }}>Booking</option>
                                                <option value="proses" {{ request('status') == 'proses' ? 'selected' : '' }}>Proses</option>
                                                <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                                                <option value="lanjut_kpr" {{ request('status') == 'lanjut_kpr' ? 'selected' : '' }}>Lanjut KPR</option>
                                            </select>
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
                                            <button type="submit" class="btn btn-gradient-primary btn-icon-only w-100" title="Filter" onclick="showFilterLoading()">
                                                <i class="mdi mdi-filter"></i>
                                            </button>
                                        </div>

                                        <div class="col-md-1">
                                            <a href="{{ route('customer.kpr') }}" class="btn btn-gradient-secondary btn-icon-only w-100" title="Reset" style="text-decoration:none;" onclick="showResetLoading(event)">
                                                <i class="mdi mdi-refresh"></i>
                                            </a>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="filter-row-mobile">
                                <div class="filter-text mb-2">
                                    <i class="mdi mdi-filter-outline"></i>
                                    <span>Filter data user KPR</span>
                                </div>

                                <form method="GET" action="{{ route('customer.kpr') }}">
                                    <div class="row g-2">
                                        <div class="col-12 mb-2">
                                            <label class="form-label">Search</label>
                                            <input type="text" class="form-control" name="search" value="{{ request('search') }}" placeholder="Cari nama user...">
                                        </div>

                                        <div class="col-6 mb-2">
                                            <label class="form-label">Status</label>
                                            <select class="form-control" name="status">
                                                <option value="">Semua</option>
                                                <option value="booking" {{ request('status') == 'booking' ? 'selected' : '' }}>Booking</option>
                                                <option value="proses" {{ request('status') == 'proses' ? 'selected' : '' }}>Proses</option>
                                                <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                                                <option value="lanjut_kpr" {{ request('status') == 'lanjut_kpr' ? 'selected' : '' }}>Lanjut KPR</option>
                                            </select>
                                        </div>

                                        <div class="col-12 mb-2">
                                            <label class="form-label">Tampil</label>
                                            <select class="form-control" name="per_page">
                                                <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10</option>
                                                <option value="15" {{ request('per_page') == 15 ? 'selected' : '' }}>15</option>
                                                <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                                            </select>
                                        </div>

                                        <div class="col-6">
                                            <button type="submit" class="btn btn-gradient-primary w-100" onclick="showFilterLoading()">
                                                <i class="mdi mdi-filter me-1"></i>Filter
                                            </button>
                                        </div>
                                        <div class="col-6">
                                            <a href="{{ route('customer.kpr') }}" class="btn btn-gradient-secondary w-100" style="text-decoration:none;" onclick="showResetLoading(event)">
                                                <i class="mdi mdi-refresh me-1"></i>Reset
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
                                    <th>Status</th>
                                    <th>Tanggal Booking</th>
                                    <th>Dokumen</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($bookings ?? [] as $booking)
                                    @php
                                        $documents = json_decode($booking->kprApplication?->documents, true) ?: [];

                                        $requiredTypes = [
                                            'ktp', 'kk', 'slip_gaji', 'rekening_koran',
                                            'npwp', 'sku', 'surat_nikah', 'ktp_pasangan'
                                        ];

                                        $uploadedCount = 0;
                                        $hasMissingValues = false;

                                        foreach ($requiredTypes as $reqType) {
                                            $foundPath = '';
                                            foreach ($documents as $doc) {
                                                if (isset($doc['type']) && $doc['type'] === $reqType && !empty($doc['path'])) {
                                                    $foundPath = $doc['path'];
                                                    break;
                                                }
                                            }

                                            if (empty($foundPath)) {
                                                $hasMissingValues = true;
                                            } else {
                                                $uploadedCount++;
                                            }
                                        }

                                        $isComplete = !$hasMissingValues;

                                        $customerName = $booking->customer->full_name ?? '-';
                                        $words = collect(explode(' ', trim($customerName)))->filter();
                                        $initial = $words->count() >= 2
                                            ? strtoupper(substr($words->first(), 0, 1) . substr($words->last(), 0, 1))
                                            : strtoupper(substr($customerName, 0, 2));

                                        $statusClass = in_array($booking->status, ['booking', 'proses', 'approved', 'lanjut_kpr'])
                                            ? $booking->status
                                            : 'default';
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
                                            <i class="mdi mdi-home-city-outline text-primary me-2"></i>
                                            <span class="fw-bold">{{ $booking->unit->unit_name ?? '-' }} - {{ $booking->unit->unit_code ?? '-' }}</span>
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
                                        <td>
                                            <span class="badge-status {{ $statusClass }}">
                                                {{ strtoupper(str_replace('_', ' ', $booking->status ?? '-')) }}
                                            </span>
                                        </td>
                                        <td>
                                            <i class="mdi mdi-calendar-month-outline text-primary me-2"></i>
                                            {{ \Carbon\Carbon::parse($booking->created_at)->format('d M Y') }}
                                        </td>
                                        <td>
                                            <button
                                                type="button"
                                                class="badge-doc btnOpenDocumentModal"
                                                data-bs-toggle="modal"
                                                data-bs-target="#documentModal"
                                                data-customer="{{ $customerName }}"
                                                data-unit="{{ $booking->unit->unit_code ?? '-' }}"
                                                data-status="{{ strtoupper(str_replace('_', ' ', $booking->status ?? '-')) }}"
                                                data-harga="Rp {{ number_format($booking->unit->price ?? 0, 0, ',', '.') }}"
                                                data-sales="{{ $booking->sales->name ?? '-' }}"
                                                data-booking="{{ \Carbon\Carbon::parse($booking->created_at)->format('d M Y') }}"
                                                data-documents='@json($documents)'>
                                                <i class="mdi mdi-file-document-multiple-outline"></i>
                                                {{ $uploadedCount }}/8
                                            </button>
                                        </td>
                                        <td class="text-center">
                                            @if($isComplete)
                                                <a href="{{ route('transaksi.kpr.approve', $booking->id) }}"
                                                   class="btn btn-gradient-success btn-sm btnApproveKpr">
                                                    <i class="mdi mdi-check-circle-outline me-1"></i>Approved
                                                </a>
                                            @else
                                                <button class="btn btn-secondary btn-sm" disabled title="Dokumen belum lengkap">
                                                    <i class="mdi mdi-check-circle-outline me-1"></i>Approved
                                                </button>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center text-muted py-4">
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
                </div>

                <div class="table-responsive" style="max-height: 400px;">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th class="col-no-small">No</th>
                                <th>Nama Dokumen</th>
                                <th class="text-end">Aksi</th>
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).ready(function() {
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

        $('#detailCustomerName').text(customer);
        $('#detailCustomerUnit').text(unit);
        $('#detailCustomerPrice').text(harga);
        $('#detailCustomerSales').text(sales);
        $('#detailCustomerStatus').text(status);
        $('#detailCustomerBooking').text(bookingDate);

        let tbody = $('#documentTableBody');
        tbody.html('');

        const requiredDocsList = [
            { type: 'ktp', label: 'KTP' },
            { type: 'kk', label: 'KK' },
            { type: 'slip_gaji', label: 'Slip Gaji' },
            { type: 'rekening_koran', label: 'Rekening Koran' },
            { type: 'npwp', label: 'NPWP' },
            { type: 'sku', label: 'SKU' },
            { type: 'surat_nikah', label: 'Surat Nikah' },
            { type: 'ktp_pasangan', label: 'KTP Pasangan' }
        ];

        requiredDocsList.forEach(function(reqDoc, index) {
            let docName = reqDoc.label;

            // Find in given documents
            let docInfo = false;
            if (Array.isArray(documents)) {
                docInfo = documents.find(d => d.type === reqDoc.type);
            }

            let docUrl = (docInfo && docInfo.path) ? formatStorageUrl(docInfo.path) : null;

            let actionHtml = '';

            if (docUrl) {
                actionHtml = `
                    <a href="${docUrl}" target="_blank" class="btn-action-purple">
                        <i class="mdi mdi-eye-outline me-1"></i>Lihat
                    </a>`;
            } else {
                actionHtml = `
                    <div class="d-flex flex-column gap-1 mt-1 text-end">
                        <span class="text-danger small fw-bold mb-1" style="font-size: 0.75rem;">
                            <i class="mdi mdi-alert-circle-outline"></i> Belum Upload
                        </span>
                        <div class="d-flex align-items-stretch justify-content-end gap-2">
                            <div class="properti-file-upload-modern text-start" style="width: 240px;">
                                <input type="file" accept=".pdf,.jpg,.jpeg,.png">
                                <div class="properti-file-label-modern m-0 h-100 flex-row text-start" style="padding: 0.4rem 0.6rem; min-height: 42px; justify-content: flex-start; border-radius: 10px;">
                                    <i class="mdi mdi-cloud-upload-outline" style="font-size: 1.3rem; padding: 4px; margin-right: 4px; min-width: 30px; text-align: center;"></i>
                                    <div class="properti-file-info-modern" style="line-height: 1.2;">
                                        <span style="font-size: 0.75rem; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 110px;">Pilih File</span>
                                        <small style="font-size: 0.6rem;">Format: PDF/JPG/PNG</small>
                                    </div>
                                    <span class="properti-file-size" style="font-size: 0.65rem; padding: 2px 6px; margin: 0 0 0 auto;"></span>
                                </div>
                            </div>
                            <button type="button" class="btn btn-sm btn-gradient-primary text-nowrap d-flex align-items-center justify-content-center" style="padding: 0 1rem; border-radius: 10px; height: auto;">
                                <i class="mdi mdi-upload me-1"></i> Upload
                            </button>
                        </div>
                    </div>
                `;
            }

            tbody.append(`
                <tr>
                    <td class="col-no-small fw-bold">${index + 1}</td>
                    <td>
                        <div class="doc-name-inline">
                            <span class="doc-file-icon">
                                <i class="mdi mdi-file-document-outline"></i>
                            </span>
                            <span>${docName}</span>
                        </div>
                    </td>
                    <td class="text-end">
                        ${actionHtml}
                    </td>
                </tr>
            `);
        });

    });

    $(document).on('change', '.properti-file-upload-modern input[type="file"]', function(e) {
        const fileName = e.target.files[0]?.name;
        const fileSize = e.target.files[0]?.size;
        const label = $(this).closest('.properti-file-upload-modern').find('.properti-file-info-modern span');
        const sizeSpan = $(this).closest('.properti-file-upload-modern').find('.properti-file-size');

        if (fileName) {
            label.text(fileName.length > 30 ? fileName.substring(0, 30) + '...' : fileName);
            if (fileSize) {
                const sizeInMB = (fileSize / (1024 * 1024)).toFixed(2);
                sizeSpan.text(sizeInMB + ' MB');
            }
        } else {
            label.text('Pilih File');
            sizeSpan.text('');
        }
    });

    $(document).on('click', '.btnApproveKpr', function(e) {
        e.preventDefault();

        let href = $(this).attr('href');
        let customerName = $(this).closest('tr').find('.customer-name').text();

        Swal.fire({
            title: 'Approve KPR?',
            text: "User " + customerName + " akan di-approve",
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
