@extends('layouts.partial.app')

@section('title', 'Lokasi Properti - Property Management App')

@section('content')
<style>
/* ===== STYLING UNTUK HALAMAN LOKASI ===== */
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
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
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

.btn-gradient-info {
    background: linear-gradient(135deg, #17a2b8, #5bc0de) !important;
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

/* ===== MAP STYLING ===== */
#map {
    height: 450px;
    width: 100%;
    border-radius: 12px;
    z-index: 1;
}

.leaflet-container {
    border-radius: 12px;
    font-family: 'Nunito', sans-serif;
}

.leaflet-popup-content-wrapper {
    border-radius: 12px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.1);
}

.leaflet-popup-content {
    margin: 12px 16px;
    font-family: 'Nunito', sans-serif;
    color: #2c2e3f;
}

.leaflet-popup-content strong {
    color: #9a55ff;
    font-size: 1rem;
}

.leaflet-popup-content p {
    margin: 5px 0;
    font-size: 0.85rem;
}

.leaflet-popup-tip-container {
    margin-top: -1px;
}

/* Custom marker styling */
.custom-marker {
    background: linear-gradient(135deg, #da8cff, #9a55ff);
    border: 3px solid white;
    border-radius: 50%;
    width: 40px !important;
    height: 40px !important;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 4px 10px rgba(154, 85, 255, 0.3);
}

.custom-marker i {
    color: white;
    font-size: 20px;
}

/* Info Panel */
.info-panel {
    background: white;
    border-radius: 12px;
    padding: 1rem;
    box-shadow: 0 4px 15px rgba(0,0,0,0.05);
    border: 1px solid #e9ecef;
    margin-top: 1rem;
}

.info-item {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 0.5rem;
    border-bottom: 1px solid #e9ecef;
}

.info-item:last-child {
    border-bottom: none;
}

.info-icon {
    width: 35px;
    height: 35px;
    background: linear-gradient(135deg, #f9f7ff, #f2ecff);
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.info-icon i {
    color: #9a55ff;
    font-size: 1.2rem;
}

.info-content {
    flex: 1;
}

.info-title {
    font-size: 0.8rem;
    color: #6c7383;
    margin-bottom: 0.1rem;
}

.info-value {
    font-size: 0.9rem;
    font-weight: 600;
    color: #2c2e3f;
}

/* ===== PAGINATION STYLING ===== */
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
    transition: all 0.2s ease;
    min-width: 32px;
    text-align: center;
}

@media (min-width: 576px) {
    .page-item .page-link {
        padding: 0.4rem 0.8rem;
        font-size: 0.8rem;
        min-width: 36px;
    }
}

@media (min-width: 768px) {
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

/* Info text pagination */
.pagination-info {
    font-size: 0.8rem;
    color: #6c7383;
}

@media (min-width: 576px) {
    .pagination-info {
        font-size: 0.85rem;
    }
}

@media (min-width: 768px) {
    .pagination-info {
        font-size: 0.9rem;
    }
}

/* Typography */
h3.text-dark, h4.text-dark {
    font-size: 1.3rem !important;
    font-weight: 700;
    color: #2c2e3f !important;
    margin-bottom: 0.5rem !important;
}

@media (min-width: 576px) {
    h3.text-dark, h4.text-dark {
        font-size: 1.5rem !important;
    }
}

@media (min-width: 768px) {
    h3.text-dark, h4.text-dark {
        font-size: 1.7rem !important;
    }
}

/* Icon styling */
.mdi {
    vertical-align: middle;
}

/* Styling untuk tombol reset icon-only */
.btn-icon-only {
    width: 40px;
    padding: 0.5rem 0;
    display: flex;
    align-items: center;
    justify-content: center;
}

.btn-icon-only i {
    font-size: 1.2rem;
    margin: 0;
}

/* Responsive untuk mobile */
@media (max-width: 576px) {
    #map {
        height: 300px;
    }

    .info-panel {
        margin-top: 0.5rem;
    }
}
</style>

<!-- Leaflet CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<!-- Leaflet JavaScript -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<div class="container-fluid p-2 p-sm-3 p-md-4">
    <!-- Header -->
    <div class="row mb-3 mb-sm-3 mb-md-4">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="text-dark mb-1">
                            <i class="mdi mdi-map-marker-radius me-2" style="color: #9a55ff;"></i>
                            Lokasi Properti
                        </h3>
                        <p class="text-muted mb-0">
                            <i class="mdi mdi-information-outline me-1"></i>
                            Peta lokasi properti yang tersedia
                        </p>
                    </div>
                    <div class="d-none d-sm-block">
                        <i class="mdi mdi-map" style="font-size: 2.5rem; color: #9a55ff; opacity: 0.2;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Map and Filter in One Card -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-white">
                    <h5 class="card-title mb-0">
                        <i class="mdi mdi-map me-2 text-primary"></i>
                        Peta Lokasi Properti
                    </h5>
                </div>
                <div class="card-body p-2 p-sm-3">
                    <!-- Filter Section - LANGSUNG DI DALAM CARD MAPS -->
                    <div class="filter-card">
                        <div class="card-body">
                            <h6 class="card-title mb-3" style="font-size: 1rem;">
                                <i class="mdi mdi-filter-outline me-1"></i>Cari Lokasi
                            </h6>

                            <!-- FILTER UNTUK MOBILE -->
                            <div class="d-block d-md-none">
                                <div class="mb-3">
                                    <label class="form-label">
                                        <i class="mdi mdi-magnify me-1"></i>Cari Properti
                                    </label>
                                    <input type="text" id="searchMobile" class="form-control" placeholder="Cari nama properti...">
                                </div>
                                <div class="row g-2">
                                    <div class="col-6">
                                        <label class="form-label">
                                            <i class="mdi mdi-home me-1"></i>Kategori
                                        </label>
                                        <select id="kategoriMobile" class="form-control">
                                            <option value="">Semua</option>
                                            <option value="Rumah">Rumah</option>
                                            <option value="Apartemen">Apartemen</option>
                                            <option value="Ruko">Ruko</option>
                                            <option value="Tanah">Tanah</option>
                                        </select>
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label">
                                            <i class="mdi mdi-counter me-1"></i>Tampil
                                        </label>
                                        <select id="tampilMobile" class="form-control">
                                            <option value="10">10</option>
                                            <option value="25">25</option>
                                            <option value="50">50</option>
                                            <option value="100">100</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row g-2 mt-2">
                                    <div class="col-12">
                                        <button class="btn btn-gradient-primary w-100">
                                            <i class="mdi mdi-magnify me-1"></i>Cari
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- FILTER UNTUK TABLET & DESKTOP -->
                            <div class="d-none d-md-block">
                                <div class="row g-2 align-items-end">
                                    <div class="col-md-5">
                                        <label class="form-label">
                                            <i class="mdi mdi-magnify me-1"></i>Cari Properti
                                        </label>
                                        <input type="text" id="search" class="form-control" placeholder="Cari nama properti...">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">
                                            <i class="mdi mdi-home me-1"></i>Kategori
                                        </label>
                                        <select id="kategori" class="form-control">
                                            <option value="">Semua</option>
                                            <option value="Rumah">Rumah</option>
                                            <option value="Apartemen">Apartemen</option>
                                            <option value="Ruko">Ruko</option>
                                            <option value="Tanah">Tanah</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label">
                                            <i class="mdi mdi-counter me-1"></i>Tampil
                                        </label>
                                        <select id="tampil" class="form-control">
                                            <option value="10">10</option>
                                            <option value="25">25</option>
                                            <option value="50">50</option>
                                            <option value="100">100</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label" style="visibility: hidden;">Cari</label>
                                        <button class="btn btn-gradient-primary w-100">
                                            <i class="mdi mdi-magnify me-1"></i>Cari
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Map Container -->
                    <div id="map"></div>

                    <!-- Info Panel -->
                    <div class="info-panel">
                        <div class="row g-2">
                            <div class="col-6 col-md-3">
                                <div class="info-item">
                                    <div class="info-icon">
                                        <i class="mdi mdi-home-group"></i>
                                    </div>
                                    <div class="info-content">
                                        <div class="info-title">Total Properti</div>
                                        <div class="info-value">24 Properti</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-md-3">
                                <div class="info-item">
                                    <div class="info-icon">
                                        <i class="mdi mdi-check-circle"></i>
                                    </div>
                                    <div class="info-content">
                                        <div class="info-title">Tersedia</div>
                                        <div class="info-value">18 Unit</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-md-3">
                                <div class="info-item">
                                    <div class="info-icon">
                                        <i class="mdi mdi-clock"></i>
                                    </div>
                                    <div class="info-content">
                                        <div class="info-title">Booking</div>
                                        <div class="info-value">4 Unit</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-md-3">
                                <div class="info-item">
                                    <div class="info-icon">
                                        <i class="mdi mdi-cash-check"></i>
                                    </div>
                                    <div class="info-content">
                                        <div class="info-title">Terjual</div>
                                        <div class="info-value">2 Unit</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Daftar Properti -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">
                        <i class="mdi mdi-format-list-bulleted me-2 text-primary"></i>
                        Daftar Properti Terdekat
                    </h5>
                    <span class="badge badge-gradient-primary">24 Properti</span>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Properti</th>
                                    <th>Kategori</th>
                                    <th>Lokasi</th>
                                    <th>Jarak</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-center fw-bold">1</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="mdi mdi-home-variant text-primary me-2"></i>
                                            Griya Permata
                                        </div>
                                    </td>
                                    <td>Rumah</td>
                                    <td>Jakarta Selatan</td>
                                    <td>2.5 km</td>
                                    <td><span class="badge badge-gradient-success">Tersedia</span></td>
                                    <td>
                                        <button class="btn btn-outline-primary btn-sm" onclick="flyToLocation(-6.2088, 106.8456)">
                                            <i class="mdi mdi-map-marker"></i> Lihat
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center fw-bold">2</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="mdi mdi-office-building text-primary me-2"></i>
                                            Apartemen Menteng
                                        </div>
                                    </td>
                                    <td>Apartemen</td>
                                    <td>Jakarta Pusat</td>
                                    <td>3.8 km</td>
                                    <td><span class="badge badge-gradient-warning">Booking</span></td>
                                    <td>
                                        <button class="btn btn-outline-primary btn-sm" onclick="flyToLocation(-6.1988, 106.8356)">
                                            <i class="mdi mdi-map-marker"></i> Lihat
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center fw-bold">3</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="mdi mdi-store text-primary me-2"></i>
                                            Ruko CBD
                                        </div>
                                    </td>
                                    <td>Ruko</td>
                                    <td>Jakarta Barat</td>
                                    <td>5.2 km</td>
                                    <td><span class="badge badge-gradient-success">Tersedia</span></td>
                                    <td>
                                        <button class="btn btn-outline-primary btn-sm" onclick="flyToLocation(-6.1688, 106.7556)">
                                            <i class="mdi mdi-map-marker"></i> Lihat
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center fw-bold">4</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="mdi mdi-terrain text-primary me-2"></i>
                                            Tanah BSD
                                        </div>
                                    </td>
                                    <td>Tanah</td>
                                    <td>Tangerang</td>
                                    <td>15.3 km</td>
                                    <td><span class="badge badge-gradient-success">Tersedia</span></td>
                                    <td>
                                        <button class="btn btn-outline-primary btn-sm" onclick="flyToLocation(-6.3018, 106.6456)">
                                            <i class="mdi mdi-map-marker"></i> Lihat
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center fw-bold">5</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="mdi mdi-home-variant text-primary me-2"></i>
                                            Griya Bekasi
                                        </div>
                                    </td>
                                    <td>Rumah</td>
                                    <td>Bekasi</td>
                                    <td>12.7 km</td>
                                    <td><span class="badge badge-gradient-danger">Terjual</span></td>
                                    <td>
                                        <button class="btn btn-outline-primary btn-sm" onclick="flyToLocation(-6.2388, 106.9956)">
                                            <i class="mdi mdi-map-marker"></i> Lihat
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mt-3">
                        <div class="pagination-info mb-2 mb-sm-0">
                            <i class="mdi mdi-information-outline me-1"></i>
                            Menampilkan 1 - 5 dari 24 data
                        </div>
                        <nav aria-label="Page navigation">
                            <ul class="pagination pagination-sm flex-wrap justify-content-center mb-0" style="gap: 2px;">
                                <li class="page-item disabled">
                                    <a class="page-link" href="#" tabindex="-1" aria-label="Previous">
                                        <i class="mdi mdi-chevron-left"></i>
                                    </a>
                                </li>
                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="page-link" href="#">4</a></li>
                                <li class="page-item"><a class="page-link" href="#">5</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Next">
                                        <i class="mdi mdi-chevron-right"></i>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
$(document).ready(function() {
    // Inisialisasi peta
    var map = L.map('map').setView([-6.2088, 106.8456], 11); // Koordinat Jakarta

    // Tambahkan tile layer dari OpenStreetMap
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
        maxZoom: 19
    }).addTo(map);

    // Data lokasi properti (contoh)
    var locations = [
        {
            name: 'Griya Permata',
            address: 'Jakarta Selatan',
            lat: -6.2088,
            lng: 106.8456,
            category: 'Rumah',
            price: 'Rp 1.200.000.000',
            status: 'Tersedia',
            icon: 'home-variant'
        },
        {
            name: 'Apartemen Menteng',
            address: 'Jakarta Pusat',
            lat: -6.1988,
            lng: 106.8356,
            category: 'Apartemen',
            price: 'Rp 850.000.000',
            status: 'Booking',
            icon: 'office-building'
        },
        {
            name: 'Ruko CBD',
            address: 'Jakarta Barat',
            lat: -6.1688,
            lng: 106.7556,
            category: 'Ruko',
            price: 'Rp 2.500.000.000',
            status: 'Tersedia',
            icon: 'store'
        },
        {
            name: 'Tanah BSD',
            address: 'Tangerang',
            lat: -6.3018,
            lng: 106.6456,
            category: 'Tanah',
            price: 'Rp 950.000.000',
            status: 'Tersedia',
            icon: 'terrain'
        },
        {
            name: 'Griya Bekasi',
            address: 'Bekasi',
            lat: -6.2388,
            lng: 106.9956,
            category: 'Rumah',
            price: 'Rp 1.500.000.000',
            status: 'Terjual',
            icon: 'home-variant'
        }
    ];

    // Tambahkan marker untuk setiap lokasi
    locations.forEach(function(loc) {
        // Buat custom icon
        var customIcon = L.divIcon({
            className: 'custom-marker',
            html: '<i class="mdi mdi-' + loc.icon + '"></i>',
            iconSize: [40, 40],
            iconAnchor: [20, 40],
            popupAnchor: [0, -40]
        });

        // Buat marker
        var marker = L.marker([loc.lat, loc.lng], { icon: customIcon }).addTo(map);

        // Buat popup content
        var popupContent = `
            <div style="min-width: 200px;">
                <strong>${loc.name}</strong>
                <p><i class="mdi mdi-map-marker" style="color: #9a55ff;"></i> ${loc.address}</p>
                <p><i class="mdi mdi-home" style="color: #9a55ff;"></i> ${loc.category}</p>
                <p><i class="mdi mdi-currency-usd" style="color: #9a55ff;"></i> ${loc.price}</p>
                <p>
                    <span class="badge" style="background: ${loc.status === 'Tersedia' ? 'linear-gradient(135deg, #28a745, #5cb85c)' : loc.status === 'Booking' ? 'linear-gradient(135deg, #ffc107, #ffdb6d)' : 'linear-gradient(135deg, #dc3545, #e4606d)'}; color: white; padding: 4px 8px; border-radius: 20px;">
                        ${loc.status}
                    </span>
                </p>
                <button class="btn btn-sm" style="background: linear-gradient(to right, #da8cff, #9a55ff); color: white; border: none; border-radius: 6px; padding: 5px 10px; margin-top: 5px;" onclick="alert('Detail ${loc.name}')">
                    <i class="mdi mdi-eye"></i> Detail
                </button>
            </div>
        `;

        marker.bindPopup(popupContent);
    });

    // Fungsi untuk fly to location
    window.flyToLocation = function(lat, lng) {
        map.flyTo([lat, lng], 15, {
            animate: true,
            duration: 1.5
        });
    };
});
</script>
@endpush
@endsection
