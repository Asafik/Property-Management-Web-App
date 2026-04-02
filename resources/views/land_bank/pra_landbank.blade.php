@extends('layouts.partial.app')

@section('title', 'Pra Tanah - Property Management App')

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

.card-title { font-size: 0.9rem; font-weight: 600; color: #9a55ff; margin-bottom: 0; }
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
    height: auto;
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
    height: auto;
}
@media (min-width: 576px) {
    .form-control, .form-select {
        padding: 0.7rem 1rem;
        font-size: 0.95rem;
        border-radius: 10px;
    }
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
.btn-gradient-primary   { background: linear-gradient(to right, #da8cff, #9a55ff) !important; color: #ffffff !important; }
.btn-gradient-secondary { background: #6c757d !important; color: #ffffff !important; }
.btn-gradient-secondary:hover { background: #5a6268 !important; }
.btn-gradient-info { background: linear-gradient(135deg, #17a2b8, #56c6d8) !important; color: #ffffff !important; }
.btn-gradient-warning { background: linear-gradient(135deg, #ffc107, #ffdb6d) !important; color: #2c2e3f !important; }
.btn-gradient-danger { background: linear-gradient(135deg, #dc3545, #e4606d) !important; color: #ffffff !important; }
.btn-gradient-success { background: linear-gradient(135deg, #28a745, #6fdf8c) !important; color: #ffffff !important; }

.btn-action {
    width: 36px;
    height: 36px;
    padding: 0;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: 10px;
    margin: 0 3px;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
}
.btn-action i { font-size: 1.1rem; }
.btn-action.fase1 {
    background: linear-gradient(135deg, #9a55ff, #da8cff);
    color: white;
}
.btn-action.fase2 {
    background: linear-gradient(135deg, #17a2b8, #56c6d8);
    color: white;
}
.btn-action.fase3 {
    background: linear-gradient(135deg, #28a745, #6fdf8c);
    color: white;
}
.btn-action.edit {
    background: linear-gradient(135deg, #ffc107, #ffdb6d);
    color: #2c2e3f;
}
.btn-action.delete {
    background: linear-gradient(135deg, #dc3545, #e4606d);
    color: white;
}
.btn-action.view {
    background: linear-gradient(135deg, #6c757d, #8a8f97);
    color: white;
}
.btn-action:hover {
    transform: translateY(-3px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
}

/* TABEL - DENGAN SCROLLBAR */
.table-wrapper {
    width: 100%;
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
    border-radius: 8px;
    margin-bottom: 0.5rem;
    scrollbar-width: thin;
    scrollbar-color: #9a55ff #f0f0f0;
}

.table-wrapper::-webkit-scrollbar {
    height: 8px;
}

.table-wrapper::-webkit-scrollbar-track {
    background: #f0f0f0;
    border-radius: 10px;
}

.table-wrapper::-webkit-scrollbar-thumb {
    background: #9a55ff;
    border-radius: 10px;
}

.table-wrapper::-webkit-scrollbar-thumb:hover {
    background: #7b3fcc;
}

.table {
    width: 100%;
    table-layout: auto;
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

.table thead th:first-child { padding-left: 0.5rem; width: 50px; text-align: center; }
.table tbody td:first-child { padding-left: 0.5rem; font-weight: 500; width: 50px; text-align: center; }
.table tbody td {
    vertical-align: middle;
    font-size: 0.85rem;
    padding: 0.8rem 0.5rem;
    border-bottom: 1px solid #e9ecef;
    color: #2c2e3f;
}
@media (min-width: 576px) { .table tbody td { font-size: 0.9rem; padding: 0.9rem 0.6rem; } }
@media (min-width: 768px) { .table tbody td { font-size: 0.95rem; padding: 1rem 0.75rem; } }
.table tbody tr:hover { background-color: #f8f9fa; }

/* Progress Bar Styling */
.progress-fase {
    width: 100%;
    min-width: 180px;
}
.progress-fase .progress-label {
    font-size: 0.65rem;
    color: #9a55ff;
    margin-bottom: 3px;
    font-weight: 600;
}
.progress-fase .progress-bar-container {
    background-color: #e9ecef;
    border-radius: 10px;
    height: 8px;
    overflow: hidden;
}
.progress-fase .progress-bar-fill {
    background: linear-gradient(to right, #9a55ff, #da8cff);
    border-radius: 10px;
    height: 100%;
    transition: width 0.3s ease;
}
.progress-fase .progress-percent {
    font-size: 0.6rem;
    color: #6c7383;
    margin-top: 3px;
    text-align: right;
}

/* FASE Badge */
.fase-badge {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 4px 10px;
    border-radius: 20px;
    font-size: 0.7rem;
    font-weight: 600;
}
.fase-badge.fase1 { background: rgba(154, 85, 255, 0.15); color: #9a55ff; }
.fase-badge.fase2 { background: rgba(23, 162, 184, 0.15); color: #17a2b8; }
.fase-badge.fase3 { background: rgba(40, 167, 69, 0.15); color: #28a745; }
.fase-badge.completed { background: rgba(40, 167, 69, 0.15); color: #28a745; }
.fase-badge.cancelled { background: rgba(220, 53, 69, 0.15); color: #dc3545; }

.badge-status {
    padding: 0.35rem 0.8rem;
    border-radius: 20px;
    font-weight: 600;
    font-size: 0.75rem;
    display: inline-block;
}
.badge-status.nego {
    background: linear-gradient(135deg, #ffc107, #ffdb6d);
    color: #2c2e3f;
}
.badge-status.survey {
    background: linear-gradient(135deg, #17a2b8, #56c6d8);
    color: #fff;
}
.badge-status.deal {
    background: linear-gradient(135deg, #28a745, #6fdf8c);
    color: #fff;
}
.badge-status.batal {
    background: linear-gradient(135deg, #dc3545, #e4606d);
    color: #fff;
}
.badge-status.pending {
    background: linear-gradient(135deg, #6c757d, #8a8f97);
    color: #fff;
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

/* MODAL STYLING */
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
    max-height: 70vh;
    overflow-y: auto;
}
.modal-footer {
    border-top: 1px solid #e9ecef;
    padding: 1rem 1.5rem;
}

/* Section dalam Modal */
.modal-section {
    margin-bottom: 1.5rem;
    border-bottom: 1px solid #e9ecef;
    padding-bottom: 1rem;
}
.modal-section:last-child {
    border-bottom: none;
    margin-bottom: 0;
    padding-bottom: 0;
}
.modal-section-title {
    font-size: 0.9rem;
    font-weight: 700;
    color: #9a55ff;
    margin-bottom: 0.8rem;
    display: flex;
    align-items: center;
    gap: 8px;
}
.modal-section-title i {
    font-size: 1rem;
}

.info-row {
    display: flex;
    margin-bottom: 0.5rem;
    font-size: 0.85rem;
}
.info-label {
    width: 120px;
    font-weight: 600;
    color: #6c7383;
}
.info-value {
    flex: 1;
    color: #2c2e3f;
}

.text-primary { color: #9a55ff !important; }
.text-muted { color: #a5b3cb !important; }
.fw-bold { font-weight: 600 !important; }

h3.text-dark {
    font-size: 1.3rem !important;
    font-weight: 700;
    color: #2c2e3f !important;
    margin-bottom: 0.5rem !important;
}
@media (min-width: 576px) { h3.text-dark { font-size: 1.5rem !important; } }
@media (min-width: 768px) { h3.text-dark { font-size: 1.7rem !important; } }

.mdi { vertical-align: middle; }


/* MODERN CHECKBOX & UPLOAD STYLES FROM PRA_LAND_BANK */
.pratanah-checkbox-group {
    display: flex;
    flex-wrap: wrap;
    gap: 0.75rem;
    justify-content: flex-start;
    margin-top: 0.5rem;
}

.pratanah-checkbox-wrapper {
    position: relative;
    min-width: 130px;
    flex: 1 1 auto;
}

.pratanah-checkbox-input {
    position: absolute;
    opacity: 0;
    width: 0;
    height: 0;
}

.pratanah-checkbox-label {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 0.6rem 1rem;
    background: linear-gradient(135deg, #f8f9fa, #f1f3f5);
    border: 2px solid #e9ecef;
    border-radius: 10px;
    cursor: pointer;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.pratanah-checkbox-input:checked+.pratanah-checkbox-label {
    border-color: #9a55ff;
    background: linear-gradient(135deg, #f1f0ff, #e8e0ff);
    box-shadow: 0 5px 15px rgba(154, 85, 255, 0.1);
}

.pratanah-check-icon {
    font-size: 1.2rem;
    color: #d0d4db;
    transition: all 0.3s ease;
}

.pratanah-checkbox-input:checked+.pratanah-checkbox-label .pratanah-check-icon {
    color: #9a55ff;
}

.pratanah-check-text {
    font-size: 0.85rem;
    color: #2c2e3f;
    font-weight: 500;
}

.pratanah-checkbox-input:checked+.pratanah-checkbox-label .pratanah-check-text {
    color: #9a55ff;
    font-weight: 600;
}

/* Modern File Upload */
.pratanah-file-upload-modern {
    position: relative;
    width: 100%;
}

.pratanah-file-upload-modern input[type="file"] {
    position: absolute;
    opacity: 0;
    width: 100%;
    height: 100%;
    cursor: pointer;
    z-index: 2;
}

.pratanah-file-label-modern {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 0.6rem 1rem;
    background: linear-gradient(135deg, #f8f9fa, #f1f3f5);
    border: 2px dashed #d0d4db;
    border-radius: 12px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.pratanah-file-upload-modern:hover .pratanah-file-label-modern {
    border-color: #9a55ff;
    background: linear-gradient(135deg, #f1f0ff, #f8f9fa);
}

.pratanah-file-label-modern i {
    font-size: 1.5rem;
    color: #9a55ff;
    background: rgba(154, 85, 255, 0.1);
    padding: 8px;
    border-radius: 50%;
}

.pratanah-file-info-modern {
    flex: 1;
}

.pratanah-file-info-modern span {
    display: block;
    font-weight: 600;
    color: #2c2e3f;
    font-size: 0.8rem;
}

.pratanah-file-info-modern small {
    color: #6c7383;
    font-size: 0.65rem;
}

.pratanah-file-size {
    font-size: 0.7rem;
    color: #9a55ff;
    font-weight: 600;
    background: rgba(154, 85, 255, 0.1);
    padding: 2px 8px;
    border-radius: 20px;
}

/* Map Container */
.pratanah-map-container {
    border-radius: 12px;
    overflow: hidden;
    border: 1px solid #e9ecef;
    height: 300px;
    margin-top: 0.5rem;
}

/* Filter Styles from posisi.blade.php */
.filter-row-desktop { display: flex; flex-direction: column; gap: 1rem; }
.filter-row-desktop .filter-text { display: flex; align-items: center; gap: 0.5rem; color: #9a55ff; font-weight: 600; font-size: 0.95rem; }
.filter-row-mobile  { display: none; }
@media (max-width: 767px) { 
    .filter-row-desktop { display: none; } 
    .filter-row-mobile  { display: block; margin-top: 1rem; } 
}

.btn-icon-only { width: 40px; height: 40px; padding: 0; display: flex; align-items: center; justify-content: center; border-radius: 8px; }
.btn-icon-only i { font-size: 1.2rem; margin: 0; }
.btn-icon-only-mobile { width: 100%; height: 40px; padding: 0; display: flex; align-items: center; justify-content: center; border-radius: 8px; }
.btn-icon-only-mobile i { font-size: 1.2rem; margin: 0; }
</style>

<div class="container-fluid p-2 p-sm-3 p-md-4">

    <div class="row mb-3 mb-sm-3 mb-md-4">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="text-dark mb-1">
                            <i class="mdi mdi-hand-holding-usd me-2" style="color: #9a55ff;"></i>Pra Tanah / Pra Pelepasan
                        </h3>
                        <p class="text-muted mb-0">
                            Kelola data tanah yang masih dalam tahap penawaran dan negosiasi
                        </p>
                    </div>
                    <div class="d-none d-sm-block">
                        <i class="mdi mdi-hand-holding-usd" style="font-size: 2.5rem; color: #9a55ff; opacity: 0.2;"></i>
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
                        <i class="mdi mdi-format-list-bulleted me-2"></i>Daftar Pra Tanah
                    </h5>
                    <button class="btn btn-gradient-primary" style="padding: 0.6rem 1.2rem; font-size: 0.9rem;" onclick="openModal('modalFase1')">
                        <i class="mdi mdi-plus me-1"></i>Tambah Pra Tanah
                    </button>
                </div>

                <div class="card-body">
                    <div class="filter-card mb-4">
                        <div class="card-body">
                            <!-- Desktop Filter -->
                            <div class="filter-row-desktop">
                                <div class="filter-text">
                                    <i class="mdi mdi-filter-outline"></i>
                                    <span>Filter data pra tanah</span>
                                </div>
                                <div class="row g-2 align-items-end w-100">
                                    <div class="col-md-8">
                                        <label class="form-label">Cari Nama Tanah / Makelar</label>
                                        <input type="text" class="form-control" id="searchInput" placeholder="Nama tanah atau makelar..." value="">
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label">Tampil</label>
                                        <select class="form-control" id="limitSelect">
                                            <option value="5">5</option>
                                            <option value="10" selected>10</option>
                                            <option value="15">15</option>
                                            <option value="25">25</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="d-flex gap-2">
                                            <button type="button" class="btn btn-gradient-primary btn-icon-only flex-fill" title="Filter" onclick="filterData()">
                                                <i class="mdi mdi-filter"></i>
                                            </button>
                                            <button type="button" class="btn btn-gradient-secondary btn-icon-only flex-fill" title="Reset" onclick="resetFilter()">
                                                <i class="mdi mdi-refresh"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Mobile Filter -->
                            <div class="filter-row-mobile">
                                <div class="filter-text mb-2">
                                    <i class="mdi mdi-filter-outline"></i>
                                    <span>Filter data pra tanah</span>
                                </div>
                                <div class="row g-2">
                                    <div class="col-12 mb-2">
                                        <label class="form-label">Cari Nama Tanah / Makelar</label>
                                        <input type="text" class="form-control" id="searchInputMobile" placeholder="Nama tanah atau makelar..." value="">
                                    </div>
                                    <div class="col-12 mb-2">
                                        <label class="form-label">Tampil</label>
                                        <select class="form-control" id="limitSelectMobile">
                                            <option value="5">5</option>
                                            <option value="10" selected>10</option>
                                            <option value="15">15</option>
                                            <option value="25">25</option>
                                        </select>
                                    </div>
                                    <div class="col-6">
                                        <button type="button" class="btn btn-gradient-primary btn-icon-only-mobile w-100" onclick="filterData()">
                                            <i class="mdi mdi-filter"></i> Filter
                                        </button>
                                    </div>
                                    <div class="col-6">
                                        <button type="button" class="btn btn-gradient-secondary btn-icon-only-mobile w-100" onclick="resetFilter()">
                                            <i class="mdi mdi-refresh"></i> Reset
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="table-wrapper">
                        <table class="table table-hover align-middle">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th>Nama Tanah</th>
                                    <th>Makelar</th>
                                    <th>Harga Negosiasi</th>
                                    <th>Progress 3 FASE</th>
                                    <th>Status</th>
                                    <th>Prioritas</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="tableBody">
                                <!-- Data dummy langsung di HTML -->
                                <tr id="row-1">
                                    <td class="text-center fw-bold">1</td>
                                    <td>
                                        <i class="mdi mdi-map-marker text-primary me-2"></i>
                                        <span class="fw-bold">Tanah Jember Kavling A</span>
                                    </td>
                                    <td>
                                        <i class="mdi mdi-account-tie me-1"></i>Budi Makmur
                                    </td>
                                    <td class="text-nowrap">Rp 850.000.000</td>
                                    <td>
                                        <div class="progress-fase">
                                            <div class="progress-label">FASE 2/3</div>
                                            <div class="progress-bar-container">
                                                <div class="progress-bar-fill" style="width: 50%"></div>
                                            </div>
                                            <div class="progress-percent">50%</div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge-status nego">Masih Negosiasi</span>
                                    </td>
                                    <td>
                                        <span class="badge-status" style="background:#ffc107;color:#2c2e3f;">🟠 Tinggi</span>
                                    </td>
                                    <td class="text-center">
                                        <button class="btn-action fase1 me-1" title="FASE 1: Informasi Makelar">
                                            <i class="mdi mdi-account-tie"></i>
                                        </button>
                                        <button class="btn-action fase2 me-1" title="FASE 2: Verifikasi & Kelayakan">
                                            <i class="mdi mdi-magnify"></i>
                                        </button>
                                        <button class="btn-action fase3 me-1" title="FASE 3: Keputusan Akhir">
                                            <i class="mdi mdi-check-decagram"></i>
                                        </button>
                                        <button class="btn-action delete" title="Hapus">
                                            <i class="mdi mdi-delete"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mt-4">
                        <div class="pagination-info mb-2 mb-sm-0" id="paginationInfo">
                            Menampilkan 1 - 1 dari 1 data
                        </div>
                        <nav aria-label="Page navigation">
                            <ul class="pagination pagination-sm flex-wrap justify-content-center mb-0" id="pagination">
                                <li class="page-item disabled"><span class="page-link"><i class="mdi mdi-chevron-left"></i></span></li>
                                <li class="page-item active"><span class="page-link">1</span></li>
                                <li class="page-item disabled"><span class="page-link"><i class="mdi mdi-chevron-right"></i></span></li>
                            </ul>
                        </nav>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>

<!-- MODAL FASE 1: Informasi dari Makelar -->
<div class="modal fade" id="modalFase1" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="mdi mdi-account-tie me-2"></i>
                    FASE 1: Informasi dari Makelar
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="fase1_id">

                <div class="modal-section">
                    <div class="modal-section-title">
                        <i class="mdi mdi-account-tie"></i> Data Makelar
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nama Makelar/Broker <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="fase1_makelar" placeholder="Nama Makelar">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Perusahaan Makelar</label>
                            <input type="text" class="form-control" id="fase1_perusahaan" placeholder="Perusahaan Makelar">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">No. Telepon/WA</label>
                            <input type="text" class="form-control" id="fase1_kontak" placeholder="No WhatsApp">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tanggal Penawaran</label>
                            <input type="date" class="form-control" id="fase1_tgl_penawaran">
                        </div>
                    </div>
                </div>

                <div class="modal-section">
                    <div class="modal-section-title">
                        <i class="mdi mdi-map-marker"></i> Data Tanah
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nama Tanah <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="fase1_nama_tanah" placeholder="Nama Tanah/Lokasi">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nama Pemilik</label>
                            <input type="text" class="form-control" id="fase1_pemilik" placeholder="Nama Pemilik">
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label">Alamat <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="fase1_alamat" placeholder="Alamat lengkap">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Luas (m²)</label>
                            <input type="number" class="form-control" id="fase1_luas" placeholder="Luas">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Lebar Jalan (m)</label>
                            <input type="number" class="form-control" id="fase1_lebar_jalan" placeholder="Lebar jalan">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Jenis Jalan</label>
                            <select class="form-select" id="fase1_jenis_jalan">
                                <option value="">Pilih</option>
                                <option value="aspal">Aspal</option>
                                <option value="beton">Beton</option>
                                <option value="paving">Paving</option>
                                <option value="tanah">Tanah</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="modal-section">
                    <div class="modal-section-title">
                        <i class="mdi mdi-handshake"></i> Negosiasi Harga
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Harga Penawaran Awal (Rp)</label>
                            <input type="text" class="form-control" id="fase1_harga_awal" placeholder="0" oninput="formatRupiah(this)">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Harga Negosiasi Terakhir (Rp)</label>
                            <input type="text" class="form-control" id="fase1_harga_nego" placeholder="0" oninput="formatRupiah(this)">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Status Negosiasi</label>
                            <select class="form-select" id="fase1_status_nego">
                                <option value="negotiation">Masih Negosiasi</option>
                                <option value="almost_deal">Hampir Deal</option>
                                <option value="deal">Sudah Deal</option>
                                <option value="cancel">Batal</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-gradient-secondary" data-bs-dismiss="modal">
                    <i class="mdi mdi-close me-1"></i>Tutup
                </button>
                <button type="button" class="btn btn-gradient-primary" onclick="saveFase1()">
                    <i class="mdi mdi-content-save me-1"></i>Simpan FASE 1
                </button>
            </div>
        </div>
    </div>
</div>

<!-- MODAL FASE 2: Verifikasi & Kelayakan -->
<div class="modal fade" id="modalFase2" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="mdi mdi-magnify me-2"></i>
                    FASE 2: Verifikasi & Kelayakan
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="fase2_id">

                <div class="modal-section">
                    <div class="modal-section-title">
                        <i class="mdi mdi-clipboard-list"></i> Survey Lapangan
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Tanggal Survey</label>
                            <input type="date" class="form-control" id="fase2_tgl_survey">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Petugas Survey</label>
                            <input type="text" class="form-control" id="fase2_petugas" placeholder="Nama Petugas">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Hasil Survey</label>
                            <select class="form-select" id="fase2_hasil_survey">
                                <option value="belum">Belum Survey</option>
                                <option value="sesuai">Sesuai</option>
                                <option value="tidak_sesuai">Tidak Sesuai</option>
                                <option value="survey_ulang">Perlu Survey Ulang</option>
                            </select>
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label">Catatan Survey</label>
                            <textarea class="form-control" id="fase2_catatan_survey" rows="2" placeholder="Catatan hasil survey..."></textarea>
                        </div>
                    </div>
                </div>

                <div class="modal-section">
                    <div class="modal-section-title">
                        <i class="mdi mdi-check-decagram"></i> Status Kelayakan
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Status Kejelasan Tanah</label>
                            <select class="form-select" id="fase2_status_tanah">
                                <option value="clear">Clear & Clean (Bebas Sengketa)</option>
                                <option value="checking">Dalam Pengecekan</option>
                                <option value="problem">Bermasalah</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Keterangan Masalah</label>
                            <input type="text" class="form-control" id="fase2_keterangan_masalah" placeholder="Jika bermasalah">
                        </div>
                    </div>
                </div>

                <div class="modal-section">
                    <div class="modal-section-title">
                        <i class="mdi mdi-domain"></i> Perizinan & Fasilitas
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Zonasi/Peruntukan</label>
                            <input type="text" class="form-control" id="fase2_zonasi" placeholder="Contoh: Perumahan, Komersial">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tingkat Kesulitan Izin</label>
                            <select class="form-select" id="fase2_kesulitan_izin">
                                <option value="mudah">Mudah</option>
                                <option value="sedang">Sedang</option>
                                <option value="sulit">Sulit</option>
                                <option value="very_sulit">Sangat Sulit</option>
                            </select>
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label">Fasilitas Sekitar</label>
                            <div class="pratanah-checkbox-group">
                                <div class="pratanah-checkbox-wrapper">
                                    <input type="checkbox" class="pratanah-checkbox-input" id="fac_sekolah" value="sekolah">
                                    <label class="pratanah-checkbox-label" for="fac_sekolah">
                                        <i class="mdi mdi-check-circle pratanah-check-icon"></i>
                                        <span class="pratanah-check-text">Sekolah</span>
                                    </label>
                                </div>
                                <div class="pratanah-checkbox-wrapper">
                                    <input type="checkbox" class="pratanah-checkbox-input" id="fac_rs" value="rumah_sakit">
                                    <label class="pratanah-checkbox-label" for="fac_rs">
                                        <i class="mdi mdi-check-circle pratanah-check-icon"></i>
                                        <span class="pratanah-check-text">Rumah Sakit</span>
                                    </label>
                                </div>
                                <div class="pratanah-checkbox-wrapper">
                                    <input type="checkbox" class="pratanah-checkbox-input" id="fac_pasar" value="pasar">
                                    <label class="pratanah-checkbox-label" for="fac_pasar">
                                        <i class="mdi mdi-check-circle pratanah-check-icon"></i>
                                        <span class="pratanah-check-text">Pasar</span>
                                    </label>
                                </div>
                                <div class="pratanah-checkbox-wrapper">
                                    <input type="checkbox" class="pratanah-checkbox-input" id="fac_trans" value="transportasi">
                                    <label class="pratanah-checkbox-label" for="fac_trans">
                                        <i class="mdi mdi-check-circle pratanah-check-icon"></i>
                                        <span class="pratanah-check-text">Transportasi</span>
                                    </label>
                                </div>
                                <div class="pratanah-checkbox-wrapper">
                                    <input type="checkbox" class="pratanah-checkbox-input" id="fac_mall" value="mall">
                                    <label class="pratanah-checkbox-label" for="fac_mall">
                                        <i class="mdi mdi-check-circle pratanah-check-icon"></i>
                                        <span class="pratanah-check-text">Mall</span>
                                    </label>
                                </div>
                                <div class="pratanah-checkbox-wrapper">
                                    <input type="checkbox" class="pratanah-checkbox-input" id="fac_bank" value="bank">
                                    <label class="pratanah-checkbox-label" for="fac_bank">
                                        <i class="mdi mdi-check-circle pratanah-check-icon"></i>
                                        <span class="pratanah-check-text">Bank/ATM</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Upload Sertifikat</label>
                            <div class="pratanah-file-upload-modern">
                                <input type="file" id="fase2_sertifikat" accept=".pdf,.jpg,.jpeg,.png">
                                <div class="pratanah-file-label-modern">
                                    <i class="mdi mdi-certificate"></i>
                                    <div class="pratanah-file-info-modern">
                                        <span>Pilih File Sertifikat</span>
                                        <small>PDF, JPG, PNG (Max 2MB)</small>
                                    </div>
                                    <span class="pratanah-file-size"></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Upload Foto Lokasi</label>
                            <div class="pratanah-file-upload-modern">
                                <input type="file" id="fase2_foto_lokasi" accept=".jpg,.jpeg,.png">
                                <div class="pratanah-file-label-modern">
                                    <i class="mdi mdi-camera"></i>
                                    <div class="pratanah-file-info-modern">
                                        <span>Pilih Foto Lokasi</span>
                                        <small>JPG, PNG (Max 2MB)</small>
                                    </div>
                                    <span class="pratanah-file-size"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-section">
                    <div class="modal-section-title">
                        <i class="mdi mdi-map-marker-radius"></i> Koordinat Lokasi
                    </div>
                    <div class="row">
                        <div class="col-md-5 mb-3">
                            <label class="form-label">Latitude</label>
                            <input type="text" class="form-control" id="fase2_lat" placeholder="-8.1727">
                        </div>
                        <div class="col-md-5 mb-3">
                            <label class="form-label">Longitude</label>
                            <input type="text" class="form-control" id="fase2_lng" placeholder="113.7000">
                        </div>
                        <div class="col-md-2 mb-3 d-flex align-items-end">
                            <button type="button" class="btn btn-gradient-info w-100" title="Dapatkan Lokasi Saya" onclick="getCurrentLocation()">
                                <i class="mdi mdi-crosshairs-gps"></i>
                            </button>
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label">Pilih Lokasi di Peta</label>
                            <div class="pratanah-map-container">
                                <div id="map-fase2" style="height: 100%; width: 100%;"></div>
                            </div>
                            <small class="text-muted mt-1 d-block"><i class="mdi mdi-information-outline me-1"></i>Klik pada peta atau geser marker untuk menentukan koordinat.</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-gradient-secondary" data-bs-dismiss="modal">
                    <i class="mdi mdi-close me-1"></i>Tutup
                </button>
                <button type="button" class="btn btn-gradient-primary" onclick="saveFase2()">
                    <i class="mdi mdi-content-save me-1"></i>Simpan FASE 2
                </button>
            </div>
        </div>
    </div>
</div>

<!-- MODAL FASE 3: Keputusan Akhir -->
<div class="modal fade" id="modalFase3" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="mdi mdi-check-decagram me-2"></i>
                    FASE 3: Keputusan Akhir
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="fase3_id">

                <div class="modal-section">
                    <div class="modal-section-title">
                        <i class="mdi mdi-tag"></i> Status Akhir
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Status Tanah <span class="text-danger">*</span></label>
                        <select class="form-select" id="fase3_status_akhir">
                            <option value="draft">Draft (Masih Proses)</option>
                            <option value="beli">DIBELI - Lanjut ke Pembelian Resmi</option>
                            <option value="ambil">DIAMBIL - Deal dan akan diproses</option>
                            <option value="pending">DIPENDING - Ditunda sementara</option>
                            <option value="batal">DIBATALKAN - Tidak jadi dibeli</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Prioritas</label>
                        <select class="form-select" id="fase3_prioritas">
                            <option value="urgent">Urgent (Harus segera diputuskan)</option>
                            <option value="high">Tinggi</option>
                            <option value="normal">Normal</option>
                            <option value="low">Rendah</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Catatan & Kesimpulan</label>
                        <textarea class="form-control" id="fase3_catatan" rows="3" placeholder="Catatan kesimpulan akhir..."></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-gradient-secondary" data-bs-dismiss="modal">
                    <i class="mdi mdi-close me-1"></i>Tutup
                </button>
                <button type="button" class="btn btn-gradient-primary" onclick="saveFase3()">
                    <i class="mdi mdi-content-save me-1"></i>Simpan FASE 3
                </button>
            </div>
        </div>
    </div>
</div>


@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
// Fungsi untuk membuka modal
function openModal(modalId) {
    const modal = new bootstrap.Modal(document.getElementById(modalId));
    modal.show();
}

// Event listener untuk tombol aksi
document.addEventListener('DOMContentLoaded', function() {



    // File upload preview logic
    document.querySelectorAll('.pratanah-file-upload-modern input[type="file"]').forEach(input => {
        input.addEventListener('change', function(e) {
            const fileName = e.target.files[0]?.name;
            const fileSize = e.target.files[0]?.size;
            const infoSpan = this.closest('.pratanah-file-upload-modern').querySelector('.pratanah-file-info-modern span');
            const sizeSpan = this.closest('.pratanah-file-upload-modern').querySelector('.pratanah-file-size');

            if (fileName) {
                infoSpan.textContent = fileName.length > 25 ? fileName.substring(0, 25) + '...' : fileName;
                if (fileSize) {
                    const sizeInMB = (fileSize / (1024 * 1024)).toFixed(2);
                    sizeSpan.textContent = sizeInMB + ' MB';
                    sizeSpan.style.display = 'inline-block';
                }
            } else {
                infoSpan.textContent = this.id.includes('foto') ? 'Pilih Foto Lokasi' : 'Pilih File Sertifikat';
                sizeSpan.textContent = '';
                sizeSpan.style.display = 'none';
            }
        });
    });

    // Tombol FASE 1
    const fase1Btn = document.querySelector('.btn-action.fase1');
    if (fase1Btn) {
        fase1Btn.addEventListener('click', function() {
            openModal('modalFase1');
        });
    }

    // Tombol FASE 2
    const fase2Btn = document.querySelector('.btn-action.fase2');
    let mapFase2 = null;
    let markerFase2 = null;

    if (fase2Btn) {
        fase2Btn.addEventListener('click', function() {
            openModal('modalFase2');
            
            // Inisialisasi peta FASE 2 setelah modal terbuka
            setTimeout(() => {
                initMapFase2();
            }, 500);
        });
    }

    function initMapFase2() {
        // Koordinat default Jember jika input kosong
        let lat = document.getElementById('fase2_lat').value || -8.1727;
        let lng = document.getElementById('fase2_lng').value || 113.7000;
        
        if (!mapFase2) {
            mapFase2 = L.map('map-fase2').setView([lat, lng], 13);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors'
            }).addTo(mapFase2);

            markerFase2 = L.marker([lat, lng], {draggable: true}).addTo(mapFase2);
            
            // Event saat marker di-drag
            markerFase2.on('dragend', function(e) {
                const pos = markerFase2.getLatLng();
                document.getElementById('fase2_lat').value = pos.lat.toFixed(6);
                document.getElementById('fase2_lng').value = pos.lng.toFixed(6);
            });

            // Event saat peta di-klik
            mapFase2.on('click', function(e) {
                const pos = e.latlng;
                markerFase2.setLatLng(pos);
                document.getElementById('fase2_lat').value = pos.lat.toFixed(6);
                document.getElementById('fase2_lng').value = pos.lng.toFixed(6);
            });
        } else {
            mapFase2.invalidateSize();
            mapFase2.setView([lat, lng], 13);
            markerFase2.setLatLng([lat, lng]);
        }
    }

    // Fungsi Global untuk Geolocation
    window.getCurrentLocation = function() {
        if ("geolocation" in navigator) {
            navigator.geolocation.getCurrentPosition(function(position) {
                const lat = position.coords.latitude;
                const lng = position.coords.longitude;
                
                document.getElementById('fase2_lat').value = lat.toFixed(6);
                document.getElementById('fase2_lng').value = lng.toFixed(6);
                
                if (mapFase2 && markerFase2) {
                    mapFase2.setView([lat, lng], 15);
                    markerFase2.setLatLng([lat, lng]);
                } else {
                    initMapFase2();
                }
                
                Swal.fire({
                    icon: 'success',
                    title: 'Lokasi Berhasil Ditemukan',
                    text: `Latitude: ${lat.toFixed(6)}, Longitude: ${lng.toFixed(6)}`,
                    timer: 2000,
                    showConfirmButton: false
                });
            }, function(error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal Mendapatkan Lokasi',
                    text: 'Pastikan izin lokasi diaktifkan pada browser Anda.'
                });
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Tidak Didukung',
                text: 'Browser Anda tidak mendukung fitur lokasi.'
            });
        }
    };

    // Tombol FASE 3
    const fase3Btn = document.querySelector('.btn-action.fase3');
    if (fase3Btn) {
        fase3Btn.addEventListener('click', function() {
            openModal('modalFase3');
        });
    }

    // Tombol Delete
    const deleteBtn = document.querySelector('.btn-action.delete');
    if (deleteBtn) {
        deleteBtn.addEventListener('click', function() {
            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: 'Data pra tanah akan dihapus secara permanen.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({ icon: 'success', title: 'Berhasil!', text: 'Data berhasil dihapus.', confirmButtonColor: '#9a55ff' });
                }
            });
        });
    }
});
</script>
@endpush
