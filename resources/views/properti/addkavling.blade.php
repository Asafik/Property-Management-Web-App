@extends('layouts.partial.app')

@section('title', 'Buat Kavling - Property Management App')

@push('styles')
<style>
/* Status Badges & Action Buttons */
.badge-kavling-status {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    padding: 0.32rem 0.75rem;
    border-radius: 30px;
    font-size: 0.75rem;
    font-weight: 600;
    line-height: 1.2;
    white-space: nowrap;
}

.badge-kavling-status.status-draft {
    background: #343a40;
    color: #ffffff;
    border: 1px solid #23272b;
    box-shadow: 0 2px 4px rgba(52, 58, 64, 0.2);
}

.badge-kavling-status.status-sold {
    background: rgba(255, 87, 87, 0.15);
    color: #ff5757;
    border: 1px solid rgba(255, 87, 87, 0.3);
}

.badge-kavling-status.status-booked {
    background: rgba(255, 184, 0, 0.15);
    color: #d97706;
    border: 1px solid rgba(255, 184, 0, 0.3);
}

.badge-kavling-status.status-ready-subsidi {
    background: rgba(0, 201, 167, 0.15);
    color: #00897b;
    border: 1px solid rgba(0, 201, 167, 0.3);
}

.badge-kavling-status.status-ready-komersil {
    background: rgba(132, 94, 194, 0.15);
    color: #845ec2;
    border: 1px solid rgba(132, 94, 194, 0.3);
}

.btn-action {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 32px;
    height: 32px;
    border-radius: 8px;
    border: none;
    transition: all 0.2s ease;
    text-decoration: none;
    cursor: pointer;
    font-size: 0.95rem;
}

.btn-action-edit {
    background: linear-gradient(135deg, #36d1dc, #5b86e5);
    color: #ffffff !important;
    box-shadow: 0 2px 4px rgba(54, 209, 220, 0.25);
}

.btn-action-edit:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(54, 209, 220, 0.4);
    color: #ffffff !important;
}

.btn-action-view {
    background: linear-gradient(135deg, #da8cff, #9a55ff);
    color: #ffffff !important;
    box-shadow: 0 2px 4px rgba(154, 85, 255, 0.25);
}

.btn-action-view:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(154, 85, 255, 0.4);
    color: #ffffff !important;
}

.btn-action-delete {
    background: linear-gradient(135deg, #ff416c, #ff4b2b);
    color: #ffffff !important;
    box-shadow: 0 2px 4px rgba(255, 65, 108, 0.25);
}

.btn-action-delete:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(255, 65, 108, 0.4);
    color: #ffffff !important;
}

.btn-gradient-info {
    background: linear-gradient(to right, #36d1dc, #5b86e5) !important;
    color: #ffffff !important;
    border: none !important;
    box-shadow: 0 2px 5px rgba(54, 209, 220, 0.3) !important;
    transition: all 0.2s ease;
}

.btn-gradient-info:hover {
    background: linear-gradient(to right, #2abec9, #4974d0) !important;
    color: #ffffff !important;
    transform: translateY(-1px);
    box-shadow: 0 4px 10px rgba(54, 209, 220, 0.45) !important;
}

/* Custom styling untuk Denah Kavling & Modal Tabs */
.denah-container {
    background-color: #f8f9fa;
    padding: 1.25rem;
    border-radius: 12px;
    border: 1px solid #e9ecef;
}

.denah-unit-box {
    color: #ffffff;
    padding: 6px 10px;
    border-radius: 6px;
    font-size: 11px;
    font-weight: 700;
    position: relative;
    min-width: 58px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    transition: transform 0.2s ease;
    cursor: pointer;
}

.denah-unit-box:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(0,0,0,0.18);
}

.denah-type-badge {
    position: absolute;
    top: -6px;
    right: -6px;
    background: #1e1e2d;
    color: #ffffff;
    font-size: 8px;
    padding: 1px 4px;
    border-radius: 50%;
    border: 1px solid #ffffff;
}

/* =========================================== */
/* HOUSE CARD — Visualisasi Progress Bangunan  */
/* =========================================== */
.house-card-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(90px, 1fr));
    gap: 10px;
    padding: 4px;
}

.house-card {
    position: relative;
    background: #ffffff;
    border-radius: 10px;
    border: 2px solid #dee2e6;
    padding: 8px 6px 6px;
    text-align: center;
    cursor: pointer;
    transition: all 0.22s cubic-bezier(.34,1.56,.64,1);
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(0,0,0,0.06);
}

.house-card:hover {
    transform: translateY(-4px) scale(1.04);
    box-shadow: 0 8px 24px rgba(0,0,0,0.14);
    border-color: #9a55ff;
    z-index: 5;
}

/* Atap rumah SVG */
.house-roof {
    width: 48px;
    height: 24px;
    margin: 0 auto 2px;
    display: block;
}

/* Progress bar vertikal di dalam rumah */
.house-progress-wrap {
    position: relative;
    width: 32px;
    height: 38px;
    background: #f0f0f0;
    border-radius: 4px;
    margin: 0 auto 4px;
    overflow: hidden;
    border: 1px solid #dee2e6;
}

.house-progress-fill {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    border-radius: 0 0 4px 4px;
    transition: height 0.8s ease;
}

.house-unit-code {
    font-size: 9px;
    font-weight: 800;
    color: #2c2e3f;
    line-height: 1.1;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.house-status-dot {
    width: 7px;
    height: 7px;
    border-radius: 50%;
    display: inline-block;
    margin-right: 2px;
    flex-shrink: 0;
}

.house-status-label {
    font-size: 8px;
    font-weight: 600;
    opacity: 0.85;
    white-space: nowrap;
}

/* Animasi shimmer untuk unit yang sedang dibangun */
@keyframes construction-shimmer {
    0%   { background-position: -200% center; }
    100% { background-position: 200% center; }
}

.house-card.in-progress::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 3px;
    background: linear-gradient(90deg, #ff9800 0%, #ffc107 40%, #ff9800 100%);
    background-size: 200% auto;
    animation: construction-shimmer 1.5s linear infinite;
}

.house-card.selesai {
    border-color: #28a74540;
    background: linear-gradient(135deg, #f8fff8, #ffffff);
}

.house-card.selesai::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 3px;
    background: #28a745;
}

.house-card.sold-unit {
    opacity: 0.75;
    border-color: #dc354540;
    background: linear-gradient(135deg, #fff5f5, #ffffff);
}

.house-card.booked-unit {
    border-color: #ffc10760;
    background: linear-gradient(135deg, #fffdf0, #ffffff);
}

/* Badge progress di pojok kanan atas */
.house-progress-badge {
    position: absolute;
    top: 4px;
    right: 4px;
    font-size: 8px;
    font-weight: 800;
    padding: 1px 4px;
    border-radius: 4px;
    color: #fff;
    line-height: 1.4;
}

/* Filter pill buttons */
.denah-filter-pill {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    padding: 3px 10px;
    border-radius: 20px;
    font-size: 11px;
    font-weight: 600;
    border: 1.5px solid transparent;
    cursor: pointer;
    transition: all 0.18s ease;
    background: #f0f0f5;
    color: #6c757d;
}

.denah-filter-pill:hover,
.denah-filter-pill.active {
    background: #9a55ff;
    color: #fff;
    border-color: #9a55ff;
    box-shadow: 0 2px 8px rgba(154,85,255,0.25);
}

/* Tooltip on hover */
.house-tooltip {
    visibility: hidden;
    opacity: 0;
    pointer-events: none;
    position: absolute;
    bottom: calc(100% + 8px);
    left: 50%;
    transform: translateX(-50%);
    background: #1e1e2d;
    color: #fff;
    font-size: 10px;
    line-height: 1.5;
    padding: 6px 10px;
    border-radius: 8px;
    white-space: nowrap;
    z-index: 99;
    box-shadow: 0 4px 16px rgba(0,0,0,0.2);
    transition: opacity 0.18s ease, visibility 0.18s ease;
}

.house-tooltip::after {
    content: '';
    position: absolute;
    top: 100%;
    left: 50%;
    transform: translateX(-50%);
    border: 5px solid transparent;
    border-top-color: #1e1e2d;
}

.house-card:hover .house-tooltip {
    visibility: visible;
    opacity: 1;
}

/* Tab button siteplan */

.modal-tabs-wrapper {
    background: #f6f9ff;
    border-radius: 10px;
    padding: 5px;
    margin-bottom: 1.25rem;
    border: 1px solid #e9ecef;
}

.modal-tabs {
    display: flex;
    gap: 6px;
    list-style: none;
    padding: 0;
    margin: 0;
}

.modal-tab-link {
    display: flex;
    align-items: center;
    gap: 6px;
    padding: 8px 16px;
    font-size: 0.85rem;
    font-weight: 600;
    color: #6c757d;
    background: transparent;
    border: none;
    border-radius: 8px;
    text-decoration: none;
    cursor: pointer;
    transition: all 0.2s ease;
}

.modal-tab-link:hover {
    color: #9a55ff;
    background: rgba(154, 85, 255, 0.08);
}

.modal-tab-link.active {
    color: #9a55ff;
    background: #ffffff;
    box-shadow: 0 2px 8px rgba(154, 85, 255, 0.15);
}

.modal-tab-pane {
    display: none;
}

.modal-tab-pane.active {
    display: block;
    animation: fadeInTab 0.3s ease;
}

@keyframes fadeInTab {
    from { opacity: 0; transform: translateY(6px); }
    to { opacity: 1; transform: translateY(0); }
}

.upload-dropzone-box {
    border: 2px dashed #d9dce2;
    border-radius: 12px;
    padding: 1.25rem 1rem;
    background: #fafbfc;
    text-align: center;
    transition: all 0.3s ease;
    cursor: pointer;
    position: relative;
}

.upload-dropzone-box:hover {
    border-color: #9a55ff;
    background: #fbf9ff;
}

.upload-dropzone-box input[type="file"] {
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
    opacity: 0;
    cursor: pointer;
    z-index: 5;
}

/* Custom Responsive Modal Sizing (Lega & Nyaman) */
.modal-custom .modal-dialog,
.modal-dialog-compact {
    max-width: 760px !important;
    width: 92%;
    margin: 1.5rem auto !important;
}

#modalSpkUnit .modal-dialog {
    max-width: 780px !important;
    width: 92%;
    margin: 1.5rem auto !important;
}

.modal-dialog-scrollable {
    max-height: calc(100vh - 2.5rem) !important;
}

.modal-dialog-scrollable .modal-content {
    max-height: calc(100vh - 2.5rem) !important;
    border-radius: 14px !important;
    border: none !important;
    box-shadow: 0 12px 35px rgba(0, 0, 0, 0.18) !important;
}

.modal-header {
    padding: 1rem 1.25rem !important;
    border-bottom: 1px solid #f0f2f5 !important;
}

.modal-body {
    padding: 1.25rem !important;
}

.modal-dialog-scrollable .modal-body {
    max-height: calc(100vh - 11rem) !important;
    overflow-y: auto !important;
    overscroll-behavior: contain !important;
    scrollbar-width: thin;
    scrollbar-color: #da8cff #f1f5f9;
}

.modal-footer {
    padding: 0.75rem 1.25rem !important;
    border-top: 1px solid #f0f2f5 !important;
}

/* Prevent outer body background scroll when modal is open */
html.modal-open,
body.modal-open {
    overflow: hidden !important;
    height: 100vh !important;
    padding-right: 0 !important;
    touch-action: none;
}

body.modal-open .container-scroller,
body.modal-open .main-panel,
body.modal-open .content-wrapper,
body.modal-open .page-body-wrapper {
    overflow: hidden !important;
    height: 100vh !important;
}

.modal {
    padding: 1.25rem 0.5rem !important;
    overflow-x: hidden !important;
    overflow-y: auto !important;
    overscroll-behavior: contain !important;
}

.modal-dialog-scrollable .modal-body::-webkit-scrollbar {
    width: 6px;
}

.modal-dialog-scrollable .modal-body::-webkit-scrollbar-thumb {
    background: #da8cff;
    border-radius: 4px;
}

@media (max-width: 991.98px) {
    .modal-custom .modal-dialog,
    .modal-dialog-compact,
    #modalSpkUnit .modal-dialog {
        max-width: 94% !important;
        width: 94% !important;
        margin: 1rem auto !important;
    }
}

@media (max-width: 576px) {
    .modal {
        padding: 0.5rem 0.25rem 2rem 0.25rem !important;
    }

    .modal-dialog-centered {
        align-items: flex-start !important;
        min-height: auto !important;
        margin-top: 0.75rem !important;
        margin-bottom: 2rem !important;
    }

    .modal-custom .modal-dialog,
    .modal-dialog-compact,
    #modalSpkUnit .modal-dialog {
        max-width: 96% !important;
        width: 96% !important;
        margin: 0.75rem auto 2rem auto !important;
        max-height: calc(100dvh - 3.5rem) !important;
        max-height: calc(100vh - 3.5rem) !important;
    }

    .modal-dialog-scrollable .modal-content {
        max-height: calc(100dvh - 3.5rem) !important;
        max-height: calc(100vh - 3.5rem) !important;
        border-radius: 12px !important;
    }

    .modal-dialog-scrollable .modal-body {
        max-height: calc(100dvh - 9.5rem) !important;
        max-height: calc(100vh - 9.5rem) !important;
        padding: 0.85rem 0.75rem !important;
    }

    .modal-header {
        padding: 0.75rem 0.9rem !important;
    }

    .modal-footer {
        padding: 0.6rem 0.85rem !important;
    }
}

/* Interactive Siteplan Styles */
.siteplan-viewer-wrapper {
    background: #f8fafc;
    border-radius: 12px;
    border: 1px solid #e2e8f0;
    overflow: hidden;
    position: relative;
}
.siteplan-toolbar {
    background: #ffffff;
    border-bottom: 1px solid #eef2f6;
    padding: 0.5rem 0.75rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 8px;
    flex-wrap: wrap;
}
.siteplan-viewport {
    height: 420px;
    overflow: auto;
    position: relative;
    background: #0f172a;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: grab;
    user-select: none;
}
.siteplan-viewport:active {
    cursor: grabbing;
}
.siteplan-img {
    max-width: 100%;
    max-height: 100%;
    object-fit: contain;
    transition: transform 0.2s ease-out;
    transform-origin: center center;
}
.siteplan-tab-btn {
    border: 1.5px solid transparent;
    padding: 0.35rem 0.85rem;
    font-size: 0.82rem;
    font-weight: 600;
    border-radius: 20px;
    background: #f1f5f9;
    color: #64748b;
    cursor: pointer;
    transition: all 0.2s ease;
}
.siteplan-tab-btn:hover {
    background: #e2e8f0;
    color: #334155;
}
/* ===== MODAL DETAIL UNIT LENGKAP STYLES ===== */
.modal-detail-unit .modal-header {
    background: linear-gradient(135deg, #da8cff, #9a55ff);
    color: white;
    border-radius: 16px 16px 0 0;
    padding: 1rem 1.5rem;
    border: none;
}
.modal-detail-unit .modal-title {
    color: #ffffff;
    font-weight: 600;
    font-size: 1.1rem;
}
.modal-detail-unit .modal-header .btn-close {
    filter: brightness(0) invert(1);
    opacity: 0.8;
}
.modal-detail-unit .modal-content {
    border: none;
    border-radius: 16px;
}
.modal-detail-unit .modal-body {
    padding: 1.5rem;
    background: #ffffff;
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
    display: flex;
    align-items: center;
    gap: 0.5rem;
}
.timeline-detail-item {
    background: #ffffff;
    border: 1px solid #efe6ff;
    border-radius: 10px;
    padding: 0.75rem 0.85rem;
    height: 100%;
    transition: all 0.3s ease;
}
.timeline-detail-item:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(154, 85, 255, 0.1);
    border-color: #9a55ff;
}
.timeline-detail-label {
    font-size: 0.8rem;
    color: #4b5563 !important;
    margin-bottom: 0.35rem;
    font-weight: 700;
    display: flex;
    align-items: center;
    gap: 0.4rem;
}
.timeline-detail-label i {
    color: #9a55ff;
    font-size: 1rem;
}
.timeline-detail-value {
    font-size: 0.95rem;
    color: #111827;
    font-weight: 700;
}
.timeline-detail-value.price, .timeline-detail-value.fee-text {
    color: #16a34a;
    font-weight: 800;
}
.name-wrap {
    display: flex;
    align-items: center;
    gap: 0.65rem;
}
.name-initial {
    width: 34px;
    height: 34px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #ffffff;
    font-weight: 700;
    font-size: 0.85rem;
    flex-shrink: 0;
}
.name-title {
    font-weight: 700;
    color: #111827;
    font-size: 0.9rem;
}
.progress-wrapper {
    margin-top: 4px;
}
.progress-row {
    display: flex;
    align-items: center;
    gap: 10px;
}
.progress-row .progress {
    flex: 1;
    height: 10px;
    border-radius: 6px;
    background: #e5e7eb;
}
.progress-bar-custom {
    height: 100%;
    border-radius: 6px;
    transition: width 0.4s ease;
}
.progress-green {
    background: linear-gradient(135deg, #28a745, #5cb85c);
}
.progress-percent {
    font-size: 0.82rem;
    font-weight: 800;
    color: #111827;
    white-space: nowrap;
}
</style>
@endpush

@section('content')

<div class="container-fluid px-1 px-sm-2 px-md-3 py-2 py-md-3">

    <!-- Header Card Banner -->
    <div class="row mb-3 mb-md-4">
        <div class="col-12">
            <div class="card shadow-sm border-0 header-card">
                <div class="card-body p-3 p-md-4 d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
                    <div>
                        <h3 class="text-dark mb-1 fw-bold" style="font-size: 1.35rem;">
                            Buat Kavling / Master Unit
                        </h3>
                        <p class="text-muted mb-0" style="font-size: 0.88rem;">
                            Kelola pembagian unit kavling tanah induk
                        </p>
                    </div>
                    <div>
                        <a href="{{ route('properti-all') }}" class="btn btn-sm btn-gradient-secondary px-3 py-2" style="border-radius: 6px;">
                            Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Alert Section --}}
    @if (session('success'))
        <div class="alert alert-success border-0 shadow-sm d-flex align-items-center gap-2 mb-3 py-2 px-3" style="border-radius: 8px;">
            <i class="mdi mdi-check-circle" style="font-size: 1.25rem;"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger border-0 shadow-sm d-flex align-items-center gap-2 mb-3 py-2 px-3" style="border-radius: 8px;">
            <i class="mdi mdi-alert-circle" style="font-size: 1.25rem;"></i>
            <span>{{ session('error') }}</span>
        </div>
    @endif

    <!-- Card 1: Informasi Tanah Induk -->
    <div class="row mb-3 mb-md-4">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white py-3 border-bottom">
                    <h5 class="card-title mb-0 fw-bold text-dark" style="font-size: 1.05rem;">Informasi Tanah Induk</h5>
                </div>
                <div class="card-body p-3 p-md-4">
                    <div class="row g-3">
                        <div class="col-sm-6 col-md-3">
                            <small class="text-muted d-block mb-1">Nama Tanah</small>
                            <h6 class="fw-bold text-dark mb-0">{{ $land->name ?? '-' }}</h6>
                        </div>

                        <div class="col-sm-6 col-md-3">
                            <small class="text-muted d-block mb-1">Luas Total</small>
                            <h6 class="fw-bold text-dark mb-0">{{ number_format($land->area ?? 0, 0, ',', '.') }} m²</h6>
                        </div>

                        <div class="col-sm-6 col-md-3">
                            <small class="text-muted d-block mb-1">Sisa Luas</small>
                            <h6 class="fw-bold text-primary mb-0">
                                {{ number_format($land->remaining_area ?? ($land->area ?? 0), 0, ',', '.') }} m²
                            </h6>
                        </div>

                        <div class="col-sm-6 col-md-3">
                            <small class="text-muted d-block mb-1">Status Legalitas</small>
                            @if ($land->legal_status == 'verified')
                                <span class="badge badge-success px-2.5 py-1">
                                    Terverifikasi
                                </span>
                            @else
                                <span class="badge badge-warning px-2.5 py-1">
                                    {{ ucfirst($land->legal_status ?? 'Pending') }}
                                </span>
                            @endif
                        </div>
                    </div>

                    <hr class="my-3" style="border-top: 1px dashed #e9ecef;">

                    <div class="row">
                        <div class="col-12">
                            <small class="text-muted d-block mb-1">Lokasi</small>
                            <p class="text-dark mb-0 fw-semibold" style="font-size: 0.88rem;">
                                {{ $land->address ?? '-' }},
                                Kel. {{ $land->village ?? '-' }},
                                Kec. {{ $land->district ?? '-' }},
                                {{ $land->city ?? '-' }},
                                {{ $land->province ?? '-' }}
                                {{ $land->postal_code ? '(' . $land->postal_code . ')' : '' }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Card 2: Daftar Unit Kavling -->
    <div class="row mb-3 mb-md-4">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white d-flex flex-wrap flex-md-row justify-content-between align-items-center gap-2 py-3 border-bottom">
                    <h5 class="card-title mb-0 fw-bold text-dark" style="font-size: 1.05rem;">
                        Daftar Unit Kavling
                    </h5>

                    <div class="d-flex flex-wrap align-items-center gap-2">
                        <button type="button" class="btn btn-sm btn-gradient-info text-white px-3 py-1.5" data-bs-toggle="modal" data-bs-target="#modalSpkUnit" style="border-radius: 6px;">
                            Atur SPK
                        </button>

                        <button type="button" class="btn btn-sm btn-gradient-primary text-white px-3 py-1.5" data-bs-toggle="modal" data-bs-target="#tambahUnitModal" style="border-radius: 6px;">
                            + Tambah Unit
                        </button>
                    </div>
                </div>

                <div class="card-body">
                    <!-- Filter Section (Standard Sesuai Halaman Lain) -->
                    <div class="filter-card mb-3">
                        <!-- Desktop Version -->
                        <div class="filter-row-desktop d-none d-md-block">
                            <form id="filterForm" method="GET" action="{{ url()->current() }}" onsubmit="return showFilterLoading()">
                                <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 w-100">
                                    <div class="d-flex flex-wrap align-items-center gap-2 flex-grow-1">
                                        <!-- Search Input -->
                                        <div style="min-width: 220px; max-width: 280px; flex: 1;">
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="search" id="searchInput"
                                                    placeholder="Cari blok / unit / nama..."
                                                    value="{{ request('search') }}"
                                                    style="border-top-right-radius: 0 !important; border-bottom-right-radius: 0 !important; border-right: none;">
                                                <button class="btn btn-gradient-primary d-flex align-items-center justify-content-center px-3" 
                                                    type="submit" title="Cari"
                                                    style="border-top-left-radius: 0 !important; border-bottom-left-radius: 0 !important; border-top-right-radius: 4px !important; border-bottom-right-radius: 4px !important; height: 38px; box-shadow: none;">
                                                    <i class="mdi mdi-magnify" style="font-size: 1.15rem; color: #ffffff;"></i>
                                                </button>
                                            </div>
                                        </div>

                                        <!-- Type Filter -->
                                        <div style="width: 140px;">
                                            <select class="form-control" name="type" id="filterType">
                                                <option value="">Semua Type</option>
                                                @foreach ($land->units->pluck('type')->unique() as $type)
                                                    @if ($type)
                                                        <option value="{{ $type }}" {{ request('type') == $type ? 'selected' : '' }}>{{ $type }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>

                                        <!-- Posisi Filter -->
                                        <div style="width: 140px;">
                                            <select class="form-control" name="position" id="filterPosisi">
                                                <option value="">Semua Posisi</option>
                                                @foreach ($land->units->pluck('position')->unique() as $position)
                                                    @if ($position)
                                                        <option value="{{ $position }}" {{ request('position') == $position ? 'selected' : '' }}>{{ $position }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>

                                        <!-- Hadap Filter -->
                                        <div style="width: 140px;">
                                            <select class="form-control" name="facing" id="filterHadap">
                                                <option value="">Semua Hadap</option>
                                                @foreach ($land->units->pluck('facing')->unique() as $facing)
                                                    @if ($facing)
                                                        <option value="{{ $facing }}" {{ request('facing') == $facing ? 'selected' : '' }}>{{ $facing }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Right Limit & Buttons (Mentok Kanan) -->
                                    <div class="d-flex align-items-center gap-2 ms-auto">
                                        <div style="width: 110px;">
                                            <select class="form-control" name="per_page" id="perPageSelect">
                                                <option value="5" {{ request('per_page', 5) == 5 ? 'selected' : '' }}>5 data</option>
                                                <option value="10" {{ request('per_page', 5) == 10 ? 'selected' : '' }}>10 data</option>
                                                <option value="15" {{ request('per_page', 5) == 15 ? 'selected' : '' }}>15 data</option>
                                                <option value="25" {{ request('per_page', 5) == 25 ? 'selected' : '' }}>25 data</option>
                                                <option value="50" {{ request('per_page', 5) == 50 ? 'selected' : '' }}>50 data</option>
                                                <option value="100" {{ request('per_page', 5) == 100 ? 'selected' : '' }}>100 data</option>
                                            </select>
                                        </div>

                                        <button type="submit" class="btn btn-gradient-primary btn-icon-only" title="Filter">
                                            <i class="mdi mdi-filter"></i>
                                        </button>
                                        <a href="{{ url()->current() }}" class="btn btn-gradient-secondary btn-icon-only" title="Reset" onclick="showResetLoading(event)">
                                            <i class="mdi mdi-refresh"></i>
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <!-- Mobile Version -->
                        <div class="filter-row-mobile d-block d-md-none">
                            <form method="GET" action="{{ url()->current() }}" onsubmit="return showFilterLoading()">
                                <div class="row g-2">
                                    <div class="col-12 mb-2">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="search" id="searchInputMobile"
                                                placeholder="Cari blok / unit..."
                                                value="{{ request('search') }}"
                                                style="border-top-right-radius: 0 !important; border-bottom-right-radius: 0 !important; border-right: none;">
                                            <button class="btn btn-gradient-primary d-flex align-items-center justify-content-center px-3" 
                                                type="submit" title="Cari"
                                                style="border-top-left-radius: 0 !important; border-bottom-left-radius: 0 !important; border-top-right-radius: 4px !important; border-bottom-right-radius: 4px !important; height: 38px; box-shadow: none;">
                                                <i class="mdi mdi-magnify" style="font-size: 1.15rem; color: #ffffff;"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-6 mb-2">
                                        <select class="form-control" name="type" id="filterTypeMobile">
                                            <option value="">Semua Type</option>
                                            @foreach ($land->units->pluck('type')->unique() as $type)
                                                @if ($type)
                                                    <option value="{{ $type }}" {{ request('type') == $type ? 'selected' : '' }}>{{ $type }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-6 mb-2">
                                        <select class="form-control" name="position" id="filterPosisiMobile">
                                            <option value="">Semua Posisi</option>
                                            @foreach ($land->units->pluck('position')->unique() as $position)
                                                @if ($position)
                                                    <option value="{{ $position }}" {{ request('position') == $position ? 'selected' : '' }}>{{ $position }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-6 mb-2">
                                        <select class="form-control" name="facing" id="filterHadapMobile">
                                            <option value="">Semua Hadap</option>
                                            @foreach ($land->units->pluck('facing')->unique() as $facing)
                                                @if ($facing)
                                                    <option value="{{ $facing }}" {{ request('facing') == $facing ? 'selected' : '' }}>{{ $facing }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-6 mb-2">
                                        <select class="form-control" name="per_page" id="perPageMobile">
                                            <option value="5" {{ request('per_page', 5) == 5 ? 'selected' : '' }}>5 data</option>
                                            <option value="10" {{ request('per_page', 5) == 10 ? 'selected' : '' }}>10 data</option>
                                            <option value="15" {{ request('per_page', 5) == 15 ? 'selected' : '' }}>15 data</option>
                                            <option value="25" {{ request('per_page', 5) == 25 ? 'selected' : '' }}>25 data</option>
                                            <option value="50" {{ request('per_page', 5) == 50 ? 'selected' : '' }}>50 data</option>
                                            <option value="100" {{ request('per_page', 5) == 100 ? 'selected' : '' }}>100 data</option>
                                        </select>
                                    </div>
                                    <div class="col-6">
                                        <button type="submit" class="btn btn-gradient-primary btn-icon-only-mobile w-100" title="Filter">
                                            <i class="mdi mdi-filter me-1"></i> Filter
                                        </button>
                                    </div>
                                    <div class="col-6">
                                        <a href="{{ url()->current() }}" class="btn btn-gradient-secondary btn-icon-only-mobile w-100" title="Reset" onclick="showResetLoading(event)">
                                            <i class="mdi mdi-refresh me-1"></i> Reset
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Table Data Kavling -->
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0" style="min-width: 1100px;">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width: 50px;">No</th>
                                    <th>Nama - Unit</th>
                                    <th>Luas Tanah</th>
                                    <th>Luas Bangunan</th>
                                    <th>Jenis & Tipe</th>
                                    <th>Harga</th>
                                    <th>Harga IJB</th>
                                    <th>Harga AJB</th>
                                    <th>Hadap</th>
                                    <th>Posisi</th>
                                    <th class="text-center" style="width: 130px;">SPK</th>
                                    <th class="text-center" style="width: 100px;">Status</th>
                                    <th class="text-center" style="width: 120px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($units as $i => $unit)
                                    <tr>
                                        <td class="text-center fw-bold text-muted">{{ $units->firstItem() + $i }}</td>

                                        <td>
                                            @php
                                                $blok = $unit->block ?? (explode('.', $unit->unit_code)[0] ?? '-');
                                                $nomor = $unit->unit_number ?? (explode('.', $unit->unit_code)[1] ?? '-');
                                                $kodeTampil = $unit->unit_code ?? ($blok . '.' . $nomor);
                                            @endphp
                                            <div>
                                                <span class="fw-bold text-dark d-block">{{ $unit->unit_name ?? '-' }}</span>
                                                <small class="text-muted">Kode: {{ $kodeTampil }}</small>
                                            </div>
                                        </td>

                                        <td>
                                            <span class="fw-semibold text-dark">
                                                {{ number_format($unit->area, 0, ',', '.') }} m²
                                            </span>
                                        </td>

                                        <td>
                                            <span class="fw-semibold text-dark">
                                                {{ number_format($unit->building_area ?? 0, 0, ',', '.') }} m²
                                            </span>
                                        </td>

                                        <td>
                                            @if (($unit->jenis ?? $unit->type) == 'subsidi')
                                                <span class="badge badge-success px-2 py-1">
                                                    Subsidi - {{ $unit->type ?: '-' }}
                                                </span>
                                            @else
                                                <span class="badge badge-primary px-2 py-1">
                                                    Komersil - {{ $unit->type ?: '-' }}
                                                </span>
                                            @endif
                                        </td>

                                        <td>
                                            <span class="fw-bold text-success">
                                                Rp {{ number_format($unit->price ?? 0, 0, ',', '.') }}
                                            </span>
                                        </td>

                                        <td>
                                            <span class="fw-bold text-success">
                                                Rp {{ number_format($unit->ijb_price ?? 0, 0, ',', '.') }}
                                            </span>
                                        </td>

                                        <td>
                                            <span class="fw-bold text-success">
                                                Rp {{ number_format($unit->ajb_price ?? 0, 0, ',', '.') }}
                                            </span>
                                        </td>

                                        <td>
                                            <span class="text-dark">{{ $unit->facing ?? '-' }}</span>
                                        </td>

                                        <td>
                                            <span class="text-dark">{{ $unit->position ?? '-' }}</span>
                                        </td>

                                        <td class="text-center">
                                            @if ($unit->no_spk)
                                                @php
                                                    $spkDocUrl = null;
                                                    if (!empty($unit->dokumen_spk)) {
                                                        $cleanSpk = ltrim($unit->dokumen_spk, '/');
                                                        $spkDocUrl = asset(str_starts_with($cleanSpk, 'uploads/') ? $cleanSpk : 'uploads/' . $cleanSpk);
                                                    }
                                                    $spkRecord = \App\Models\Spk::where('no_spk', $unit->no_spk)->first();
                                                @endphp

                                                @if ($spkRecord)
                                                    <a href="{{ route('spk.cetak', $spkRecord->id) }}" target="_blank" class="text-primary text-decoration-none fw-bold" style="font-size: 0.85rem;" title="Cetak / Buka Surat Resmi SPK {{ $unit->no_spk }} (Kontraktor: {{ $unit->kontraktor ?? '-' }})">
                                                        {{ $unit->no_spk }}
                                                    </a>
                                                @elseif ($spkDocUrl)
                                                    <a href="{{ $spkDocUrl }}" target="_blank" class="text-primary text-decoration-none fw-bold" style="font-size: 0.85rem;" title="Buka berkas PDF SPK {{ $unit->no_spk }} (Kontraktor: {{ $unit->kontraktor ?? '-' }})">
                                                        {{ $unit->no_spk }}
                                                    </a>
                                                @else
                                                    <span class="text-dark fw-bold" style="font-size: 0.85rem;">{{ $unit->no_spk }}</span>
                                                @endif


                                            @else
                                                <span class="text-muted small">-</span>
                                            @endif
                                        </td>

                                        <td class="text-center">
                                            @php
                                                $st = strtolower($unit->status ?? 'ready');
                                                $isSubsidi = ($unit->jenis ?? $unit->type) == 'subsidi';
                                            @endphp
                                            @if ($st == 'sold' || $st == 'terjual')
                                                <span class="badge-kavling-status status-sold">
                                                    <i class="mdi mdi-close-circle-outline"></i>Sold
                                                </span>
                                            @elseif($st == 'booked' || $st == 'booking')
                                                <span class="badge-kavling-status status-booked">
                                                    <i class="mdi mdi-calendar-clock"></i>Booked
                                                </span>
                                            @elseif($st == 'draft')
                                                <span class="badge-kavling-status status-draft">
                                                    <i class="mdi mdi-pencil-outline"></i>Draft
                                                </span>
                                            @else
                                                @if($isSubsidi)
                                                    <span class="badge-kavling-status status-ready-subsidi">
                                                        <i class="mdi mdi-check-circle-outline"></i>Ready (Subsidi)
                                                    </span>
                                                @else
                                                    <span class="badge-kavling-status status-ready-komersil">
                                                        <i class="mdi mdi-check-circle-outline"></i>Ready (Komersil)
                                                    </span>
                                                @endif
                                            @endif
                                        </td>

                                        <td class="text-center">
                                            <div class="d-flex justify-content-center align-items-center gap-1">
                                                <button type="button" class="btn-action btn-action-edit" data-bs-toggle="modal" data-bs-target="#editUnitModal{{ $unit->id }}" title="Edit">
                                                    <i class="mdi mdi-pencil"></i>
                                                </button>

                                                <a href="{{ route('properti.progress', ['land_bank_id' => $unit->land_bank_id, 'unit_id' => $unit->id]) }}" class="btn-action btn-action-view" title="Progress Unit">
                                                    <i class="mdi mdi-progress-check"></i>
                                                </a>

                                                <form action="{{ route('properti.kavling.destroy', ['unit' => $unit->id]) }}" method="POST" class="d-inline delete-form">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn-action btn-action-delete" type="button" onclick="confirmDelete(this, '{{ $unit->unit_code }}')" title="Hapus">
                                                        <i class="mdi mdi-delete"></i>
                                                    </button>
                                                </form>
                                            </div>

                                            <!-- Modal Edit Unit -->
                                            <div class="modal fade modal-custom" id="editUnitModal{{ $unit->id }}" tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title fw-bold text-dark">
                                                                <i class="mdi mdi-pencil-circle me-1 text-primary"></i>Edit Unit Kavling - {{ $unit->unit_code }}
                                                            </h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                        </div>
                                                        <div class="modal-body text-start p-3 p-md-4" style="max-height: 65vh; overflow-y: auto;">
                                                            <form action="{{ route('properti.kavling.update', ['unit' => $unit->id]) }}" method="POST" id="formEditUnitManual{{ $unit->id }}" enctype="multipart/form-data">
                                                                @csrf
                                                                @method('PUT')
                                                                
                                                                <div class="row g-3">
                                                                    <!-- Baris 1: 2 Kolom Sejajar -->
                                                                    <div class="col-12 col-md-6">
                                                                        <label class="form-label fw-bold small mb-1">Blok / Kode <span class="text-danger">*</span></label>
                                                                        <input type="text" name="block" class="form-control" value="{{ $unit->block }}" placeholder="Contoh: A" required>
                                                                    </div>
                                                                    <div class="col-12 col-md-6">
                                                                        <label class="form-label fw-bold small mb-1">Nomor Unit <span class="text-danger">*</span></label>
                                                                        <input type="text" name="unit_number" class="form-control" value="{{ $unit->unit_number }}" placeholder="Contoh: 1" required>
                                                                    </div>

                                                                    <!-- Baris 2: 2 Kolom Sejajar -->
                                                                    <div class="col-12 col-md-6">
                                                                        <label class="form-label fw-bold small mb-1">Nama Unit</label>
                                                                        <input type="text" name="unit_name" class="form-control" value="{{ $unit->unit_name }}" placeholder="Contoh: Cluster A">
                                                                    </div>
                                                                    <div class="col-12 col-md-6">
                                                                        <label class="form-label fw-bold small mb-1">Jenis Unit <span class="text-danger">*</span></label>
                                                                        <select name="jenis" class="form-control" required>
                                                                            <option value="">-- Pilih Jenis --</option>
                                                                            <option value="subsidi" {{ ($unit->jenis ?? $unit->type) == 'subsidi' ? 'selected' : '' }}>Subsidi</option>
                                                                            <option value="komersil" {{ ($unit->jenis ?? $unit->type) == 'komersil' ? 'selected' : '' }}>Komersil</option>
                                                                        </select>
                                                                    </div>

                                                                    <!-- Baris 3: 2 Kolom Sejajar -->
                                                                    <div class="col-12 col-md-6">
                                                                        <label class="form-label fw-bold small mb-1">Type Bangunan <span class="text-danger">*</span></label>
                                                                        <input type="text" name="type" class="form-control" value="{{ $unit->type }}" placeholder="Contoh: 36/60" required>
                                                                    </div>
                                                                    <div class="col-12 col-md-6">
                                                                        <label class="form-label fw-bold small mb-1">Luas Tanah (m²) <span class="text-danger">*</span></label>
                                                                        <input type="number" name="area" class="form-control" value="{{ $unit->area }}" placeholder="60" min="1" step="any" required>
                                                                    </div>

                                                                    <!-- Baris 4: 2 Kolom Sejajar -->
                                                                    <div class="col-12 col-md-6">
                                                                        <label class="form-label fw-bold small mb-1">Luas Bangunan (m²) <span class="text-danger">*</span></label>
                                                                        <input type="number" name="building_area" class="form-control" value="{{ $unit->building_area }}" placeholder="36" min="1" step="any" required>
                                                                    </div>
                                                                    <div class="col-12 col-md-6">
                                                                        <label class="form-label fw-bold small mb-1">Harga Unit (Rp) <span class="text-danger">*</span></label>
                                                                        <input type="text" name="price" class="form-control price-format" value="{{ number_format($unit->price ?? 0, 0, ',', '.') }}" placeholder="150.000.000" required>
                                                                    </div>

                                                                    <!-- Baris 5: 2 Kolom Sejajar -->
                                                                    <div class="col-12 col-md-6">
                                                                        <label class="form-label fw-bold small mb-1">Harga IJB (Rp)</label>
                                                                        <input type="text" name="ijb_price" class="form-control price-format" value="{{ number_format($unit->ijb_price ?? 0, 0, ',', '.') }}" placeholder="150.000.000">
                                                                    </div>
                                                                    <div class="col-12 col-md-6">
                                                                        <label class="form-label fw-bold small mb-1">Harga AJB (Rp)</label>
                                                                        <input type="text" name="ajb_price" class="form-control price-format" value="{{ number_format($unit->ajb_price ?? 0, 0, ',', '.') }}" placeholder="150.000.000">
                                                                    </div>

                                                                    <!-- Baris 6: 2 Kolom Sejajar -->
                                                                    <div class="col-12 col-md-6">
                                                                        <label class="form-label fw-bold small mb-1">Hadap</label>
                                                                        <select name="facing" class="form-control">
                                                                            <option value="Utara" {{ $unit->facing == 'Utara' ? 'selected' : '' }}>Utara</option>
                                                                            <option value="Selatan" {{ $unit->facing == 'Selatan' ? 'selected' : '' }}>Selatan</option>
                                                                            <option value="Timur" {{ $unit->facing == 'Timur' ? 'selected' : '' }}>Timur</option>
                                                                            <option value="Barat" {{ $unit->facing == 'Barat' ? 'selected' : '' }}>Barat</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-12 col-md-6">
                                                                        <label class="form-label fw-bold small mb-1">Posisi</label>
                                                                        <select name="position" class="form-control">
                                                                            <option value="Hook" {{ $unit->position == 'Hook' ? 'selected' : '' }}>Hook</option>
                                                                            <option value="Tengah" {{ $unit->position == 'Tengah' ? 'selected' : '' }}>Tengah</option>
                                                                            <option value="Sudut" {{ $unit->position == 'Sudut' ? 'selected' : '' }}>Sudut</option>
                                                                        </select>
                                                                    </div>

                                                                    <!-- Baris 7: Full Width -->
                                                                    <div class="col-12">
                                                                        <label class="form-label fw-bold small mb-1">Keterangan Tambahan</label>
                                                                        <input type="text" name="description" class="form-control" value="{{ $unit->description }}" placeholder="Catatan tambahan (opsional)">
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-sm btn-gradient-secondary" data-bs-dismiss="modal">
                                                                <i class="mdi mdi-close me-1"></i>Batal
                                                            </button>
                                                            <button type="submit" form="formEditUnitManual{{ $unit->id }}" class="btn btn-sm btn-gradient-primary">
                                                                <i class="mdi mdi-content-save me-1"></i>Simpan Perubahan
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="12" class="text-center text-muted py-4">
                                            <i class="mdi mdi-alert-circle-outline d-block mb-1" style="font-size: 2rem; color: #da8cff;"></i>
                                            Belum ada data unit kavling untuk tanah induk ini.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if ($units->hasPages())
                        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mt-4">
                            <div class="pagination-info mb-2 mb-sm-0">
                                Menampilkan {{ $units->firstItem() }} - {{ $units->lastItem() }} dari {{ $units->total() }} data
                            </div>
                            <div>
                                {{ $units->links() }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Card 3: Ringkasan Kavling (Full Width 4 Kolom) -->
    <div class="row mb-3 mb-md-4">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white d-flex align-items-center gap-2 py-3">
                    <span class="badge bg-primary bg-opacity-10 text-primary p-2 rounded-3">
                        <i class="mdi mdi-chart-pie" style="font-size: 1.1rem;"></i>
                    </span>
                    <h5 class="card-title mb-0 fw-bold text-dark">Ringkasan Kavling & Pembangunan</h5>
                </div>
                <div class="card-body p-3 p-md-4">
                    @php
                        $totalUnits = $land->units->count();
                        $totalArea = $land->units->sum('area');
                        $sisaLuas = max(0, $land->remaining_area ?? ($land->area - $totalArea));
                        $totalNilai = $land->units->sum('price');

                        $mapProgress = [
                            'belum_mulai' => 0,
                            'pondasi' => 20,
                            'dinding' => 40,
                            'atap' => 60,
                            'finishing' => 80,
                            'selesai' => 100,
                        ];

                        $unitProgress = $land->units->map(function ($u) use ($mapProgress) {
                            $st = strtolower($u->construction_progress ?? 'belum_mulai');
                            return $mapProgress[$st] ?? 0;
                        });

                        $progressPercent = $unitProgress->count() > 0 ? $unitProgress->avg() : 0;
                    @endphp

                    <div class="row g-3">
                        <div class="col-6 col-md-3">
                            <div class="p-3 bg-light rounded-3 h-100 border-start border-primary border-3">
                                <small class="text-muted d-block mb-1"><i class="mdi mdi-counter me-1 text-primary"></i>Total Unit</small>
                                <h4 class="fw-bold text-dark mb-0">{{ $totalUnits }} Unit</h4>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="p-3 bg-light rounded-3 h-100 border-start border-info border-3">
                                <small class="text-muted d-block mb-1"><i class="mdi mdi-ruler-square me-1 text-info"></i>Total Luas Unit</small>
                                <h4 class="fw-bold text-dark mb-0">{{ number_format($totalArea, 0, ',', '.') }} m²</h4>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="p-3 bg-light rounded-3 h-100 border-start border-warning border-3">
                                <small class="text-muted d-block mb-1"><i class="mdi mdi-chart-arc me-1 text-warning"></i>Sisa Luas Tanah</small>
                                <h4 class="fw-bold text-warning mb-0">{{ number_format($sisaLuas, 0, ',', '.') }} m²</h4>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="p-3 bg-light rounded-3 h-100 border-start border-success border-3">
                                <small class="text-muted d-block mb-1"><i class="mdi mdi-currency-usd me-1 text-success"></i>Nilai Total Unit</small>
                                <h4 class="fw-bold text-success mb-0" style="font-size: 1.05rem;">Rp {{ number_format($totalNilai, 0, ',', '.') }}</h4>
                            </div>
                        </div>
                    </div>

                    <div class="mt-3">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <small class="fw-bold text-dark"><i class="mdi mdi-progress-clock me-1 text-primary"></i>Progress Pembangunan Keseluruhan</small>
                            <small class="fw-bold text-primary">{{ number_format($progressPercent, 0) }}% Rata-rata</small>
                        </div>
                        <div class="progress" style="height: 8px; border-radius: 6px;">
                            <div class="progress-bar bg-gradient-primary" role="progressbar" style="width: {{ $progressPercent }}%;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Card 4: Denah Kavling Interaktif (Full Width Luas & Besar) -->
    <div class="row mb-3 mb-md-4">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                @php
                    $hasDenah = !empty($land->denah);
                    $denahUrl = null;
                    $isPdf = false;
                    $denahFileName = null;
                    if ($hasDenah) {
                        $cleanPath = ltrim($land->denah, '/');
                        if (str_starts_with($cleanPath, 'uploads/')) {
                            $denahUrl = asset($cleanPath);
                        } elseif (file_exists(public_path('uploads/' . $cleanPath))) {
                            $denahUrl = asset('uploads/' . $cleanPath);
                        } elseif (file_exists(public_path('storage/' . $cleanPath))) {
                            $denahUrl = asset('storage/' . $cleanPath);
                        } elseif (file_exists(public_path($cleanPath))) {
                            $denahUrl = asset($cleanPath);
                        } else {
                            $denahUrl = asset('uploads/' . $cleanPath);
                        }
                        $denahFileName = basename($cleanPath);
                        $ext = strtolower(pathinfo($cleanPath, PATHINFO_EXTENSION));
                        $isPdf = ($ext === 'pdf');
                    }
                @endphp

                <div class="card-header bg-white d-flex flex-wrap align-items-center justify-content-between gap-2 py-3 border-bottom">
                    <div>
                        <h5 class="card-title mb-0 fw-bold text-dark" style="font-size: 1.05rem;">Denah & Siteplan</h5>
                    </div>
                    
                    <!-- Tab Switcher Header (Siteplan vs Matriks Blok vs Progress) -->
                    <div class="d-flex align-items-center gap-1 bg-light p-1 rounded-pill border">
                        <button type="button" class="siteplan-tab-btn {{ $hasDenah ? 'active' : '' }}" id="btnTabSiteplan" onclick="switchSiteplanView('siteplan')">
                            Siteplan Asli
                        </button>
                        <button type="button" class="siteplan-tab-btn {{ !$hasDenah ? 'active' : '' }}" id="btnTabMatriks" onclick="switchSiteplanView('matriks')">
                            Matriks Unit
                        </button>
                        <button type="button" class="siteplan-tab-btn" id="btnTabProgress" onclick="switchSiteplanView('progress')">
                            <i class="mdi mdi-home-city-outline me-1"></i>Progress Bangunan
                        </button>
                    </div>
                </div>

                <div class="card-body p-3 p-md-4">
                    <!-- VIEW 1: SITEPLAN ASLI (DARI PASCA LAND BANK) -->
                    <div id="viewSiteplanContainer" class="{{ $hasDenah ? '' : 'd-none' }}">
                        @if ($hasDenah)
                            <div class="siteplan-viewer-wrapper">
                                <!-- Toolbar Kontrol Zoom & Aksi -->
                                <div class="siteplan-toolbar">
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="badge bg-soft-primary text-primary px-2 py-1 rounded-pill small fw-bold">
                                            <i class="mdi mdi-check-circle me-1"></i>Siteplan Terunggah
                                        </span>
                                        <span class="small text-muted text-truncate d-none d-sm-inline" style="max-width: 180px;" title="{{ $denahFileName }}">
                                            {{ $denahFileName }}
                                        </span>
                                    </div>
                                    <div class="d-flex align-items-center gap-1">
                                        @if(!$isPdf)
                                            <button type="button" class="btn btn-sm btn-outline-secondary p-1 px-2 rounded-2" onclick="zoomSiteplan(0.2)" title="Perbesar (Zoom In)">
                                                <i class="mdi mdi-magnify-plus-outline"></i>
                                            </button>
                                            <button type="button" class="btn btn-sm btn-outline-secondary p-1 px-2 rounded-2" onclick="zoomSiteplan(-0.2)" title="Perkecil (Zoom Out)">
                                                <i class="mdi mdi-magnify-minus-outline"></i>
                                            </button>
                                            <button type="button" class="btn btn-sm btn-outline-secondary p-1 px-2 rounded-2" onclick="resetSiteplanZoom()" title="Reset Ukuran">
                                                <i class="mdi mdi-restore"></i>
                                            </button>
                                            <button type="button" class="btn btn-sm btn-outline-primary p-1 px-2 rounded-2" onclick="openSiteplanLightbox()" title="Lihat Layar Penuh">
                                                <i class="mdi mdi-fullscreen"></i>
                                            </button>
                                        @endif
                                        <a href="{{ $denahUrl }}" target="_blank" download class="btn btn-sm btn-gradient-primary p-1 px-2 rounded-2" title="Unduh Berkas Asli">
                                            <i class="mdi mdi-download"></i>
                                        </a>
                                    </div>
                                </div>

                                <!-- Viewport Display -->
                                @if ($isPdf)
                                    <div class="p-4 text-center bg-light" style="min-height: 380px;">
                                        <i class="mdi mdi-file-pdf-box text-danger" style="font-size: 4rem;"></i>
                                        <h6 class="fw-bold text-dark mt-2 mb-1">Dokumen Siteplan format PDF</h6>
                                        <p class="small text-muted mb-3">{{ $denahFileName }}</p>
                                        <a href="{{ $denahUrl }}" target="_blank" class="btn btn-sm btn-gradient-primary px-3 rounded-pill shadow-sm">
                                            <i class="mdi mdi-open-in-new me-1"></i>Buka & Lihat Berkas PDF Penuh
                                        </a>
                                    </div>
                                @else
                                    <!-- Interactive Fabric.js Canvas Engine untuk Tim Legal (Tinggi 620px Besar & Luas) -->
                                    <div class="siteplan-scroll-container" style="min-height: 580px; height: 620px; overflow: hidden; border: 2px solid #9a55ff; border-radius: 12px; background: #ffffff; display: flex; justify-content: center; align-items: center; position: relative;">
                                        <canvas id="siteplanCanvasLegal"></canvas>
                                    </div>

                                    <!-- Legend Status Penjualan & Progress Pembangunan -->
                                    <div class="mt-2 p-2 bg-light rounded-3 border small">
                                        <div class="row g-2">
                                            <div class="col-md-7 border-end">
                                                <strong class="d-block text-dark mb-1" style="font-size: 10px;">
                                                    <i class="mdi mdi-hammer-wrench text-warning me-1"></i>Status Pembangunan Fisik (Warna Bulatan):
                                                </strong>
                                                <div class="d-flex flex-wrap gap-1">
                                                    <span class="badge" style="background: #adb5bd; color: #fff; font-size: 9px;">Belum Mulai (0%)</span>
                                                    <span class="badge" style="background: #fd7e14; color: #fff; font-size: 9px;">Pondasi (20%)</span>
                                                    <span class="badge" style="background: #ffc107; color: #212529; font-size: 9px;">Dinding (40%)</span>
                                                    <span class="badge" style="background: #17a2b8; color: #fff; font-size: 9px;">Atap (60%)</span>
                                                    <span class="badge" style="background: #9a55ff; color: #fff; font-size: 9px;">Finishing (80%)</span>
                                                    <span class="badge" style="background: #28a745; color: #fff; font-size: 9px;">Selesai (100%)</span>
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <strong class="d-block text-dark mb-1" style="font-size: 10px;">
                                                    <i class="mdi mdi-circle-outline text-primary me-1"></i>Status Penjualan (Garis Border):
                                                </strong>
                                                <div class="d-flex flex-wrap gap-1">
                                                    <span class="badge" style="background: rgba(220,53,69,0.15); color: #dc3545; border: 1.5px solid #dc3545; font-size: 9px;">Terjual / Sold (Border Merah)</span>
                                                    <span class="badge" style="background: rgba(255,193,7,0.15); color: #d39e00; border: 1.5px solid #ffc107; font-size: 9px;">Booked (Border Emas)</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="p-2 px-3 bg-light border-top d-flex flex-wrap justify-content-between align-items-center gap-2 small text-muted">
                                        <span><i class="mdi mdi-cursor-move me-1"></i>Geser buletan unit untuk memposisikan kavling di siteplan</span>
                                        <div class="d-flex align-items-center gap-2">
                                            <button type="button" class="btn btn-xs btn-primary px-2 py-1 shadow-sm" onclick="savePositionLegal()">
                                                <i class="mdi mdi-content-save me-1"></i>Simpan Posisi Unit
                                            </button>
                                            <a href="{{ route('properti.edit', $land->id) }}" class="text-primary text-decoration-none fw-bold small">
                                                <i class="mdi mdi-pencil-box-outline me-1"></i>Ganti Siteplan
                                            </a>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @else
                            <!-- Empty State jika belum upload di pasca land bank -->
                            <div class="p-4 text-center bg-light rounded-4 border" style="border-style: dashed !important; border-width: 2px !important;">
                                <div class="mb-2">
                                    <span class="p-3 bg-white rounded-circle shadow-sm d-inline-flex align-items-center justify-content-center text-primary" style="width: 60px; height: 60px;">
                                        <i class="mdi mdi-map-marker-question-outline fs-2"></i>
                                    </span>
                                </div>
                                <h6 class="fw-bold text-dark mb-1">Berkas Siteplan / Denah Belum Diunggah</h6>
                                <p class="small text-muted mb-3" style="max-width: 440px; margin: 0 auto;">
                                    Belum ada berkas siteplan yang dilampirkan untuk properti lahan ini di Pasca Land Bank. Anda dapat mengunggah denah gambar/PDF sekarang.
                                </p>
                                <a href="{{ route('properti.edit', $land->id) }}" class="btn btn-sm btn-gradient-primary px-3 rounded-pill shadow-sm">
                                    <i class="mdi mdi-upload me-1"></i>Upload Denah / Siteplan di Edit Properti
                                </a>
                            </div>
                        @endif
                    </div>

                    <!-- VIEW 2: MATRIKS GRID UNIT (KAVLING BLOK) -->
                    <div id="viewMatriksContainer" class="{{ !$hasDenah ? '' : 'd-none' }}">
                        <div class="denah-container">
                            @php
                                $allUnits = $land->units;
                                $blokKavlings = [];
                                foreach ($allUnits as $unit) {
                                    $blok = explode('.', $unit->unit_code)[0] ?? 'A';
                                    $blokKavlings[$blok][] = $unit;
                                }
                                $allBloks = array_keys($blokKavlings);
                            @endphp

                            @forelse ($allBloks as $blok)
                                <div class="mb-3 text-center">
                                    <h6 class="fw-bold text-dark mb-2">Blok {{ $blok }}</h6>
                                    <div class="d-flex flex-wrap gap-2 justify-content-center">
                                        @php
                                            $numbers = [];
                                            foreach ($blokKavlings[$blok] as $u) {
                                                $num = (int) (explode('.', $u->unit_code)[1] ?? 0);
                                                $numbers[] = $num;
                                            }
                                            $maxNum = count($numbers) ? max($numbers) : 0;
                                        @endphp

                                        @for ($i = 1; $i <= $maxNum; $i++)
                                            @php
                                                $uFound = collect($blokKavlings[$blok])->firstWhere('unit_code', $blok . '.' . $i);
                                                $bgColor = '#6c757d';
                                                $icon = 'close';
                                                $borderStyle = 'none';
                                                $typeBadge = '';

                                                if ($uFound) {
                                                    switch ($uFound->status) {
                                                        case 'sold': $bgColor = '#dc3545'; $icon = 'check'; break;
                                                        case 'booked': $bgColor = '#ffc107'; $icon = 'clock'; break;
                                                        case 'draft': $bgColor = '#343a40'; $icon = 'pencil'; break;
                                                        case 'ready':
                                                            if ($uFound->type == 'subsidi') {
                                                                $bgColor = '#28a745';
                                                                $typeBadge = 'S';
                                                            } else {
                                                                $bgColor = '#0d6efd';
                                                                $typeBadge = 'K';
                                                            }
                                                            $icon = 'home';
                                                            break;
                                                    }

                                                    switch ($uFound->construction_progress) {
                                                        case 'belum_mulai': $borderStyle = '2px dashed #000'; break;
                                                        case 'pondasi': $borderStyle = '2px solid #000'; break;
                                                        case 'dinding': $borderStyle = '3px solid #000'; break;
                                                        case 'atap': $borderStyle = '3px double #000'; break;
                                                        case 'finishing': $borderStyle = '3px groove #000'; break;
                                                        case 'selesai': $borderStyle = '3px solid #155724'; break;
                                                    }
                                                }
                                            @endphp

                                            <span class="denah-unit-box" style="background-color: {{ $bgColor }}; border: {{ $borderStyle }};">
                                                @if ($typeBadge)
                                                    <small class="denah-type-badge">{{ $typeBadge }}</small>
                                                @endif
                                                <i class="mdi mdi-{{ $icon }} me-1"></i>{{ $blok . '.' . $i }}
                                            </span>
                                        @endfor
                                    </div>
                                </div>
                            @empty
                                <p class="text-muted text-center mb-0">Belum ada data kavling untuk divisualisasikan.</p>
                            @endforelse

                            <hr class="my-3">

                            <!-- Legend Status -->
                            <div class="small">
                                <h6 class="fw-bold text-dark mb-2" style="font-size: 0.8rem;">Status Penjualan:</h6>
                                <div class="d-flex flex-wrap gap-2 mb-3">
                                    <span class="badge bg-danger">Sold</span>
                                    <span class="badge bg-warning text-dark">Booked</span>
                                    <span class="badge bg-dark">Draft</span>
                                    <span class="badge bg-success">Ready (Subsidi)</span>
                                    <span class="badge bg-primary">Ready (Komersil)</span>
                                </div>

                                <h6 class="fw-bold text-dark mb-2" style="font-size: 0.8rem;">Tipe Unit:</h6>
                                <div class="d-flex gap-2">
                                    <span class="badge bg-success">S = Subsidi</span>
                                    <span class="badge bg-primary">K = Komersil</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ============================================== -->
                    <!-- VIEW 3: PROGRESS BANGUNAN — VISUALISASI RUMAH  -->
                    <!-- ============================================== -->
                    <div id="viewProgressContainer" class="d-none">
                        @php
                            $allUnitsProgress = $land->units->sortBy('unit_code');
                            $progressMap = [
                                'belum_mulai' => ['label' => 'Belum Mulai', 'pct' => 0,   'color' => '#adb5bd'],
                                'pondasi'     => ['label' => 'Pondasi',     'pct' => 20,  'color' => '#fd7e14'],
                                'dinding'     => ['label' => 'Dinding',     'pct' => 40,  'color' => '#ffc107'],
                                'atap'        => ['label' => 'Atap',        'pct' => 60,  'color' => '#17a2b8'],
                                'finishing'   => ['label' => 'Finishing',   'pct' => 80,  'color' => '#9a55ff'],
                                'selesai'     => ['label' => 'Selesai',     'pct' => 100, 'color' => '#28a745'],
                            ];
                            $blokGroupsProgress = [];
                            foreach ($allUnitsProgress as $u) {
                                $blk = explode('.', $u->unit_code)[0] ?? 'A';
                                $blokGroupsProgress[$blk][] = $u;
                            }
                            $totalUnits      = $allUnitsProgress->count();
                            $selesaiCount    = $allUnitsProgress->where('construction_progress', 'selesai')->count();
                            $inProgressCount = $allUnitsProgress->whereIn('construction_progress', ['pondasi','dinding','atap','finishing'])->count();
                            $belumCount      = $totalUnits - $selesaiCount - $inProgressCount;
                            $avgPct = $totalUnits > 0 ? round($allUnitsProgress->map(fn($u) => ($progressMap[$u->construction_progress ?? 'belum_mulai']['pct'] ?? 0))->average()) : 0;
                        @endphp

                        @if($allUnitsProgress->isEmpty())
                            <div class="text-center py-5 text-muted">
                                <i class="mdi mdi-home-outline" style="font-size: 3rem; opacity: 0.3;"></i>
                                <p class="mt-2 small">Belum ada unit kavling untuk divisualisasikan.</p>
                            </div>
                        @else
                            <!-- Statistik Ringkasan -->
                            <div class="row g-2 mb-3">
                                <div class="col-6 col-md-3">
                                    <div class="rounded-3 p-2 text-center" style="background: linear-gradient(135deg,#28a74515,#28a74508); border: 1px solid #28a74530;">
                                        <div class="fw-bold fs-5 text-success">{{ $selesaiCount }}</div>
                                        <div style="font-size: 10px;" class="text-muted">Selesai</div>
                                    </div>
                                </div>
                                <div class="col-6 col-md-3">
                                    <div class="rounded-3 p-2 text-center" style="background: linear-gradient(135deg,#ffc10715,#ff980008); border: 1px solid #ffc10740;">
                                        <div class="fw-bold fs-5" style="color: #fd7e14;">{{ $inProgressCount }}</div>
                                        <div style="font-size: 10px;" class="text-muted">Dibangun</div>
                                    </div>
                                </div>
                                <div class="col-6 col-md-3">
                                    <div class="rounded-3 p-2 text-center" style="background: linear-gradient(135deg,#6c757d15,#adb5bd08); border: 1px solid #adb5bd40;">
                                        <div class="fw-bold fs-5 text-secondary">{{ $belumCount }}</div>
                                        <div style="font-size: 10px;" class="text-muted">Belum Mulai</div>
                                    </div>
                                </div>
                                <div class="col-6 col-md-3">
                                    <div class="rounded-3 p-2 text-center" style="background: linear-gradient(135deg,#9a55ff15,#9a55ff08); border: 1px solid #9a55ff30;">
                                        <div class="fw-bold fs-5" style="color: #9a55ff;">{{ $avgPct }}%</div>
                                        <div style="font-size: 10px;" class="text-muted">Rata-rata</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Progress Bar Keseluruhan -->
                            <div class="mb-3">
                                <div class="d-flex justify-content-between small text-muted mb-1">
                                    <span><i class="mdi mdi-home-city-outline me-1"></i>Progress Pembangunan Keseluruhan</span>
                                    <span class="fw-bold">{{ $avgPct }}% rata-rata</span>
                                </div>
                                <div class="progress rounded-pill" style="height: 8px;">
                                    <div class="progress-bar" role="progressbar"
                                         style="width: {{ $avgPct }}%; background: linear-gradient(90deg, #9a55ff, #da8cff);"
                                         aria-valuenow="{{ $avgPct }}" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>

                            <!-- Filter Pills Per Blok -->
                            <div class="d-flex flex-wrap gap-1 mb-3">
                                <button class="denah-filter-pill active" onclick="filterHouseBlok('all', this)">
                                    <i class="mdi mdi-apps" style="font-size: 10px;"></i>Semua
                                </button>
                                @foreach(array_keys($blokGroupsProgress) as $blkKey)
                                    <button class="denah-filter-pill" onclick="filterHouseBlok('{{ $blkKey }}', this)">
                                        Blok {{ $blkKey }}
                                    </button>
                                @endforeach
                            </div>

                            <!-- Grid House Cards Per Blok -->
                            @foreach($blokGroupsProgress as $blkName => $blokUnits)
                                <div class="house-blok-section mb-4" data-blok="{{ $blkName }}">
                                    <div class="d-flex align-items-center gap-2 mb-2">
                                        <span class="badge bg-dark px-2 py-1" style="font-size: 10px; border-radius: 6px;">Blok {{ $blkName }}</span>
                                        <span style="font-size: 10px; color: #adb5bd;">{{ count($blokUnits) }} unit</span>
                                        <hr class="flex-grow-1 my-0" style="border-color: #dee2e6;">
                                    </div>
                                    <div class="house-card-grid">
                                        @foreach($blokUnits as $hu)
                                            @php
                                                $prog  = $hu->construction_progress ?? 'belum_mulai';
                                                $pInfo = $progressMap[$prog] ?? $progressMap['belum_mulai'];
                                                $pct   = $pInfo['pct'];
                                                $isInProgress = in_array($prog, ['pondasi','dinding','atap','finishing']);
                                                $isSelesai    = ($prog === 'selesai');

                                                $roofColor = match($hu->status ?? 'draft') {
                                                    'sold'   => '#dc3545',
                                                    'booked' => '#ffc107',
                                                    'ready'  => ($hu->type === 'subsidi' ? '#28a745' : '#0d6efd'),
                                                    default  => '#6c757d',
                                                };

                                                $cardClasses = 'house-card';
                                                if ($isInProgress)         $cardClasses .= ' in-progress';
                                                if ($isSelesai)            $cardClasses .= ' selesai';
                                                if ($hu->status === 'sold')   $cardClasses .= ' sold-unit';
                                                if ($hu->status === 'booked') $cardClasses .= ' booked-unit';

                                                $hasSpk    = !empty($hu->no_spk);
                                                $spkRecord = $hasSpk ? \App\Models\Spk::where('no_spk', $hu->no_spk)->first() : null;
                                            @endphp

                                            <div class="{{ $cardClasses }}" data-blok="{{ $blkName }}"
                                                 data-bs-toggle="modal" data-bs-target="#editUnitModal{{ $hu->id }}"
                                                 title="{{ $hu->unit_code }} — {{ $pInfo['label'] }} ({{ $pct }}%) — {{ ucfirst($hu->status ?? '-') }}">

                                                <!-- Tooltip -->
                                                <div class="house-tooltip">
                                                    <strong>{{ $hu->unit_code }}</strong><br>
                                                    Type: {{ $hu->type ?? '-' }}{{ $hu->building_area ? ' | ' . $hu->building_area . 'm²' : '' }}<br>
                                                    Status: {{ ucfirst($hu->status ?? '-') }}<br>
                                                    Bangunan: {{ $pInfo['label'] }} ({{ $pct }}%)<br>
                                                    SPK: {{ $hasSpk ? $hu->no_spk : 'Belum diterbitkan' }}
                                                </div>

                                                <!-- Badge % progress -->
                                                @if($pct > 0)
                                                    <div class="house-progress-badge" style="background: {{ $pInfo['color'] }};">{{ $pct }}%</div>
                                                @endif

                                                <!-- Atap Rumah -->
                                                <svg class="house-roof" viewBox="0 0 48 24" xmlns="http://www.w3.org/2000/svg">
                                                    <polygon points="0,24 24,2 48,24" fill="{{ $roofColor }}" />
                                                    @if($isInProgress)
                                                        <polygon points="22,13 26,13 25,19 23,19" fill="#fff" opacity="0.4"/>
                                                    @endif
                                                </svg>

                                                <!-- Progress Bar Vertikal (Badan Rumah) -->
                                                <div class="house-progress-wrap">
                                                    <div class="house-progress-fill" style="height: {{ $pct }}%; background: {{ $pInfo['color'] }};"></div>
                                                    @if($isInProgress)
                                                        <div style="position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);z-index:2;">
                                                            <i class="mdi mdi-hammer-wrench" style="font-size:11px;color:#fd7e14;"></i>
                                                        </div>
                                                    @elseif($isSelesai)
                                                        <div style="position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);z-index:2;">
                                                            <i class="mdi mdi-check" style="font-size:11px;color:#28a745;"></i>
                                                        </div>
                                                    @endif
                                                </div>

                                                <!-- Kode Unit -->
                                                <div class="house-unit-code mb-1">{{ $hu->unit_code }}</div>

                                                <!-- Status dot + label -->
                                                <div class="d-flex align-items-center justify-content-center" style="gap:2px;">
                                                    <span class="house-status-dot" style="background:{{ $pInfo['color'] }};"></span>
                                                    <span class="house-status-label" style="color:{{ $pInfo['color'] }};">{{ $pInfo['label'] }}</span>
                                                </div>

                                                @if($hasSpk)
                                                    <i class="mdi mdi-file-check" style="font-size:9px;color:#28a745;margin-top:2px;" title="SPK: {{ $hu->no_spk }}"></i>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach

                            <!-- Legend -->
                            <hr class="my-3">
                            <div class="d-flex flex-wrap gap-2">
                                @foreach($progressMap as $pv)
                                    <span style="display:inline-flex;align-items:center;gap:4px;font-size:10px;background:{{ $pv['color'] }}18;color:{{ $pv['color'] }};padding:2px 8px;border-radius:8px;border:1px solid {{ $pv['color'] }}35;font-weight:600;">
                                        <span style="width:6px;height:6px;border-radius:50%;background:{{ $pv['color'] }};display:inline-block;"></span>
                                        {{ $pv['label'] }} {{ $pv['pct'] }}%
                                    </span>
                                @endforeach
                            </div>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Unit -->
    <div class="modal fade modal-custom" id="tambahUnitModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold text-dark">
                        <i class="mdi mdi-plus-circle me-1 text-primary"></i>Tambah Unit Kavling Baru
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-3 p-md-4" style="max-height: 65vh; overflow-y: auto;">
                    <!-- Tab Switcher as Distinct Buttons -->
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <button type="button" class="btn btn-sm btn-gradient-primary modal-tab-btn active d-inline-flex align-items-center gap-1.5 px-3 py-2 shadow-sm" data-modal-tab="manual" style="border-radius: 8px;">
                            <i class="mdi mdi-pencil" style="font-size: 0.95rem;"></i>
                            <span>Manual Satu per Satu</span>
                        </button>
                        <button type="button" class="btn btn-sm btn-outline-secondary modal-tab-btn d-inline-flex align-items-center gap-1.5 px-3 py-2 shadow-sm" data-modal-tab="import" style="border-radius: 8px; background: #f8f9fa; color: #475569; border-color: #e2e8f0;">
                            <i class="mdi mdi-file-excel text-success" style="font-size: 0.95rem;"></i>
                            <span>Import File Excel</span>
                        </button>
                    </div>

                    <!-- Pane Manual -->
                    <div class="modal-tab-pane active" id="modal-manual-pane">
                        <form action="{{ route('properti.storeKavling', $land->id) }}" method="POST" id="formTambahUnitManual" enctype="multipart/form-data">
                            @csrf
                            <div class="row g-3">
                                <!-- Baris 1: 2 Kolom Sejajar -->
                                <div class="col-12 col-md-6">
                                    <label class="form-label fw-bold small mb-1">Blok / Kode <span class="text-danger">*</span></label>
                                    <input type="text" name="block" class="form-control" placeholder="Contoh: A" required>
                                </div>
                                <div class="col-12 col-md-6">
                                    <label class="form-label fw-bold small mb-1">Nomor Unit <span class="text-danger">*</span></label>
                                    <input type="text" name="unit_number" class="form-control" placeholder="Contoh: 1" required>
                                </div>

                                <!-- Baris 2: 2 Kolom Sejajar -->
                                <div class="col-12 col-md-6">
                                    <label class="form-label fw-bold small mb-1">Nama Unit</label>
                                    <input type="text" name="unit_name" class="form-control" placeholder="Contoh: Cluster A">
                                </div>
                                <div class="col-12 col-md-6">
                                    <label class="form-label fw-bold small mb-1">Jenis Unit <span class="text-danger">*</span></label>
                                    <select name="jenis" class="form-control" required>
                                        <option value="">-- Pilih Jenis --</option>
                                        <option value="subsidi">Subsidi</option>
                                        <option value="komersil">Komersil</option>
                                    </select>
                                </div>

                                <!-- Baris 3: 2 Kolom Sejajar -->
                                <div class="col-12 col-md-6">
                                    <label class="form-label fw-bold small mb-1">Type Bangunan <span class="text-danger">*</span></label>
                                    <input type="text" name="type" class="form-control" placeholder="Contoh: 36/60" required>
                                </div>
                                <div class="col-12 col-md-6">
                                    <label class="form-label fw-bold small mb-1">Luas Tanah (m²) <span class="text-danger">*</span></label>
                                    <input type="number" name="area" class="form-control" placeholder="60" min="1" step="any" required>
                                </div>

                                <!-- Baris 4: 2 Kolom Sejajar -->
                                <div class="col-12 col-md-6">
                                    <label class="form-label fw-bold small mb-1">Luas Bangunan (m²) <span class="text-danger">*</span></label>
                                    <input type="number" name="building_area" class="form-control" placeholder="36" min="1" step="any" required>
                                </div>
                                <div class="col-12 col-md-6">
                                    <label class="form-label fw-bold small mb-1">Harga Unit (Rp) <span class="text-danger">*</span></label>
                                    <input type="text" name="price" class="form-control price-format" placeholder="150.000.000" required>
                                </div>

                                <!-- Baris 5: 2 Kolom Sejajar -->
                                <div class="col-12 col-md-6">
                                    <label class="form-label fw-bold small mb-1">Harga IJB (Rp)</label>
                                    <input type="text" name="ijb_price" class="form-control price-format" placeholder="150.000.000">
                                </div>
                                <div class="col-12 col-md-6">
                                    <label class="form-label fw-bold small mb-1">Harga AJB (Rp)</label>
                                    <input type="text" name="ajb_price" class="form-control price-format" placeholder="150.000.000">
                                </div>

                                <!-- Baris 6: 2 Kolom Sejajar -->
                                <div class="col-12 col-md-6">
                                    <label class="form-label fw-bold small mb-1">Hadap</label>
                                    <select name="facing" class="form-control">
                                        <option value="Utara">Utara</option>
                                        <option value="Selatan">Selatan</option>
                                        <option value="Timur">Timur</option>
                                        <option value="Barat">Barat</option>
                                    </select>
                                </div>
                                <div class="col-12 col-md-6">
                                    <label class="form-label fw-bold small mb-1">Posisi</label>
                                    <select name="position" class="form-control">
                                        <option value="Hook">Hook</option>
                                        <option value="Tengah" selected>Tengah</option>
                                        <option value="Sudut">Sudut</option>
                                    </select>
                                </div>

                                <!-- Baris 7: Full Width -->
                                <div class="col-12">
                                    <label class="form-label fw-bold small mb-1">Keterangan Tambahan</label>
                                    <input type="text" name="description" class="form-control" placeholder="Catatan tambahan (opsional)">
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Pane Import -->
                    <div class="modal-tab-pane" id="modal-import-pane">
                        <div class="text-center py-3">
                            <div class="d-inline-flex p-3 rounded-circle bg-success bg-opacity-10 text-success mb-3">
                                <i class="mdi mdi-file-excel" style="font-size: 2.5rem;"></i>
                            </div>
                            <h5 class="fw-bold text-dark mb-1">Import Unit Kavling dari Excel</h5>
                            <p class="text-muted small mb-3">Unduh template file Excel, lengkapi data unit, lalu unggah kembali file tersebut.</p>

                            <div class="mb-4">
                                <a href="{{ route('kavling.template') }}" class="btn btn-sm btn-outline-success px-3">
                                    <i class="mdi mdi-download me-1"></i>Unduh Template Kavling (.xlsx)
                                </a>
                            </div>

                            <form action="{{ route('kavling.import', $land->id) }}" method="POST" enctype="multipart/form-data" id="formImportExcelModal">
                                @csrf
                                <div class="upload-dropzone-box">
                                    <input type="file" id="uploadExcelModal" name="file" accept=".xlsx,.xls" required>
                                    <i class="mdi mdi-cloud-upload-outline text-primary d-block mb-2" style="font-size: 2rem;"></i>
                                    <span class="fw-bold text-dark d-block" id="fileNameModal">Pilih atau Drag & Drop file Excel di sini</span>
                                    <small class="text-muted">Format didukung: .xlsx, .xls (Maksimal 5MB)</small>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-gradient-secondary" data-bs-dismiss="modal">
                        <i class="mdi mdi-close me-1"></i>Batal
                    </button>
                    
                    <button type="submit" form="formTambahUnitManual" id="btnSubmitManual" class="btn btn-sm btn-gradient-primary">
                        <i class="mdi mdi-content-save me-1"></i>Simpan Unit
                    </button>

                    <button type="submit" form="formImportExcelModal" id="btnSubmitImport" class="btn btn-sm btn-gradient-success d-none">
                        <i class="mdi mdi-upload me-1"></i>Import File Excel
                    </button>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Modal Lightbox Siteplan Fullscreen -->
<div class="modal fade" id="modalSiteplanLightbox" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content rounded-4 border-0 shadow">
            <div class="modal-header border-bottom py-3">
                <h5 class="modal-title fw-bold text-dark d-flex align-items-center gap-2">
                    <i class="mdi mdi-image-area text-primary fs-4"></i>
                    <span>Siteplan Proyek: {{ $land->name }}</span>
                </h5>
                <div class="d-flex align-items-center gap-2">
                    @if($hasDenah)
                        <a href="{{ $denahUrl }}" target="_blank" download class="btn btn-sm btn-outline-primary rounded-pill px-3">
                            <i class="mdi mdi-download me-1"></i>Unduh Asli
                        </a>
                    @endif
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            </div>
            <div class="modal-body p-0 text-center bg-dark" style="min-height: 500px; display: flex; align-items: center; justify-content: center; overflow: auto;">
                @if($hasDenah && !$isPdf)
                    <img src="{{ $denahUrl }}" alt="Siteplan {{ $land->name }}" class="img-fluid" style="max-height: 80vh; object-fit: contain;">
                @endif
            </div>
            <div class="modal-footer border-top py-2 px-3 justify-content-between bg-light">
                <span class="small text-muted">Berkas resmi denah lahan Pasca Land Bank</span>
                <button type="button" class="btn btn-secondary btn-sm rounded-pill px-3" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- MODAL: ATUR / TERBITKAN SPK KE MULTI-UNIT KAVLING -->
<div class="modal fade" id="modalSpkUnit" tabindex="-1" aria-labelledby="modalSpkUnitLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content rounded-4 border-0 shadow">
            <div class="modal-header border-bottom py-3 px-4">
                <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 w-100 me-2">
                    <div class="d-flex align-items-center gap-2">
                        <div class="d-inline-flex p-2 rounded-3 bg-primary bg-opacity-10 text-primary">
                            <i class="mdi mdi-file-document-edit-outline fs-4"></i>
                        </div>
                        <h5 class="modal-title fw-bold text-dark mb-0" id="modalSpkUnitLabel">Atur SPK Unit Kavling</h5>
                    </div>
                    <a href="{{ route('spk.create', ['land_bank_id' => $land->id]) }}" target="_blank" class="btn btn-sm btn-outline-primary d-inline-flex align-items-center gap-1.5 px-3 py-1.5 shadow-sm" style="border-radius: 6px; font-weight: 600; font-size: 0.8rem;" title="Buka Form Pembuatan SPK Lengkap & Rincian Termin">
                        <i class="mdi mdi-open-in-new"></i>
                        <span>Buat Form SPK Lengkap</span>
                    </a>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body p-3 p-md-4" style="max-height: 65vh; overflow-y: auto;">
                <form id="formAssignSpkModal" action="{{ route('properti.kavling.assignSpk', $land->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row g-3 mb-3">
                        <div class="col-12 col-md-6">
                            <label class="form-label fw-bold small text-dark mb-1">Nomor SPK <span class="text-danger">*</span></label>
                            <input type="text" name="no_spk" class="form-control" placeholder="Nomor SPK..." required>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label fw-bold small text-dark mb-1">Nama Kontraktor <span class="text-danger">*</span></label>
                            <input type="text" name="kontraktor" class="form-control" placeholder="Nama kontraktor..." required>
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-bold small text-dark mb-1">Keterangan</label>
                            <input type="text" name="description" class="form-control" placeholder="Keterangan (opsional)...">
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-bold small text-dark mb-1">Upload Berkas SPK (PDF)</label>
                            <div class="upload-dropzone-box py-2.5 px-3">
                                <input type="file" id="uploadDokumenSpkInput" name="dokumen_spk" accept=".pdf">
                                <div class="d-flex align-items-center justify-content-center gap-3">
                                    <div class="rounded-circle p-2 bg-danger bg-opacity-10 text-danger d-inline-flex align-items-center justify-content-center" style="width: 38px; height: 38px;">
                                        <i class="mdi mdi-file-pdf-box" style="font-size: 1.4rem;"></i>
                                    </div>
                                    <div class="text-start">
                                        <span class="fw-bold text-dark d-block" id="dokumenSpkFileName" style="font-size: 0.85rem;">Pilih berkas PDF atau seret ke sini</span>
                                        <small class="text-muted" style="font-size: 0.75rem;">Maksimal 10MB</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pilih Multi-Unit Kavling -->
                    <div class="border rounded-3 p-3 bg-light">
                        <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-2 pb-2 border-bottom">
                            <div>
                                <h6 class="fw-bold text-dark mb-0" style="font-size: 0.88rem;">Pilih Unit Kavling <span class="text-danger">*</span></h6>
                                <small class="text-muted" id="spkUnitCounter">0 unit dipilih</small>
                            </div>
                            <div class="d-flex align-items-center gap-1.5">
                                <button type="button" class="btn btn-sm btn-light border text-primary fw-semibold px-2.5 py-1 d-inline-flex align-items-center gap-1" id="btnSelectAllSpkUnits" style="font-size: 0.78rem; border-radius: 6px; background: #ffffff; border-color: #cbd5e1 !important;">
                                    <i class="mdi mdi-checkbox-multiple-marked-outline text-primary"></i>
                                    <span>Pilih Semua</span>
                                </button>
                                <button type="button" class="btn btn-sm btn-light border text-muted fw-semibold px-2.5 py-1 d-inline-flex align-items-center gap-1" id="btnUnselectAllSpkUnits" style="font-size: 0.78rem; border-radius: 6px; background: #ffffff; border-color: #cbd5e1 !important;">
                                    <i class="mdi mdi-checkbox-multiple-blank-outline"></i>
                                    <span>Hapus Semua</span>
                                </button>
                            </div>
                        </div>

                        <!-- Search Unit di Modal -->
                        <div class="mb-2">
                            <div class="input-group">
                                <input type="text" class="form-control" id="filterSpkUnitSearch"
                                    placeholder="Cari unit..."
                                    style="border-top-right-radius: 0 !important; border-bottom-right-radius: 0 !important; border-right: none; height: 36px; font-size: 0.85rem;">
                                <button class="btn btn-gradient-primary d-flex align-items-center justify-content-center px-3" 
                                    type="button" id="btnSearchSpkUnit" title="Cari"
                                    style="border-top-left-radius: 0 !important; border-bottom-left-radius: 0 !important; border-top-right-radius: 4px !important; border-bottom-right-radius: 4px !important; height: 36px; box-shadow: none;">
                                    <i class="mdi mdi-magnify" style="font-size: 1.1rem; color: #ffffff;"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Daftar Unit Checkbox List -->
                        <div class="spk-unit-selection-grid" style="max-height: 240px; overflow-y: auto; padding-right: 5px;">
                            <div class="row g-2" id="spkUnitListContainer">
                                @forelse ($land->units as $u)
                                    @php
                                        $uBlok = $u->block ?? (explode('.', $u->unit_code)[0] ?? '-');
                                        $uNomor = $u->unit_number ?? (explode('.', $u->unit_code)[1] ?? '-');
                                        $uKode = $u->unit_code ?? ($uBlok . '.' . $uNomor);
                                    @endphp
                                    <div class="col-md-4 col-sm-6 spk-unit-item-col" data-code="{{ strtolower($uKode) }}" data-name="{{ strtolower($u->unit_name ?? '') }}" data-type="{{ strtolower($u->type ?? '') }}">
                                        <label class="d-flex align-items-start gap-2 p-2 rounded-3 border bg-white h-100 shadow-sm spk-unit-card" style="cursor: pointer;">
                                            <input type="checkbox" name="unit_ids[]" value="{{ $u->id }}" class="form-check-input mt-1 spk-unit-checkbox">
                                            <div class="flex-grow-1" style="font-size: 12px; line-height: 1.3;">
                                                <div class="fw-bold text-dark d-flex justify-content-between align-items-center">
                                                    <span>{{ $uKode }}</span>
                                                    <span class="badge bg-light text-muted border py-0 px-1" style="font-size: 10px;">{{ $u->type }}</span>
                                                </div>
                                                <div class="text-muted small text-truncate" style="max-width: 130px;">{{ $u->unit_name ?: 'Unit' }}</div>
                                                @if($u->no_spk)
                                                    <div class="text-primary mt-1" style="font-size: 10px;" title="SPK: {{ $u->no_spk }}">
                                                        SPK: {{ $u->no_spk }}
                                                    </div>
                                                @else
                                                    <div class="text-muted mt-1" style="font-size: 10px;">
                                                        Belum ada SPK
                                                    </div>
                                                @endif
                                            </div>
                                        </label>
                                    </div>
                                @empty
                                    <div class="col-12 text-center py-4 text-muted">
                                        <i class="mdi mdi-home-alert-outline fs-3 d-block mb-1"></i>
                                        Belum ada unit kavling untuk lahan ini.
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer border-top py-2.5 px-4 d-flex justify-content-end gap-2">
                <button type="button" class="btn btn-sm btn-light border px-3" data-bs-dismiss="modal">
                    Batal
                </button>
                <button type="submit" form="formAssignSpkModal" class="btn btn-sm btn-gradient-primary fw-bold text-white px-3 shadow-sm">
                    <i class="mdi mdi-check-all me-1"></i>Simpan SPK
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Detail Unit Lengkap (Legal View) -->
<div class="modal fade modal-detail-unit" id="detailUnitModalLegal" tabindex="-1">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content shadow-lg border-0">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="mdi mdi-home-circle me-2"></i>
                    Detail Unit Kavling Lengkap
                </h5>
                <div class="d-flex align-items-center gap-2">
                    <button type="button" class="btn btn-sm btn-light text-primary fw-bold px-3 rounded-pill" id="btnEditFromDetailLegal" style="display: none;">
                        <i class="mdi mdi-pencil me-1"></i>Edit Data Unit
                    </button>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
            </div>
            <div class="modal-body p-4">
                <!-- Informasi Unit -->
                <div class="timeline-detail-card">
                    <div class="timeline-detail-title">
                        <i class="mdi mdi-home-outline me-1"></i>Informasi Unit
                    </div>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <div class="timeline-detail-item">
                                <div class="timeline-detail-label"><i class="mdi mdi-home-outline"></i>Nama Unit</div>
                                <div class="timeline-detail-value" id="leg_unit_name">-</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="timeline-detail-item">
                                <div class="timeline-detail-label"><i class="mdi mdi-alpha-b-box-outline"></i>Blok</div>
                                <div class="timeline-detail-value" id="leg_block">-</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="timeline-detail-item">
                                <div class="timeline-detail-label"><i class="mdi mdi-numeric"></i>Nomor Unit</div>
                                <div class="timeline-detail-value" id="leg_unit_number">-</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="timeline-detail-item">
                                <div class="timeline-detail-label"><i class="mdi mdi-format-list-bulleted-type"></i>Jenis Unit</div>
                                <div class="timeline-detail-value" id="leg_jenis">-</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="timeline-detail-item">
                                <div class="timeline-detail-label"><i class="mdi mdi-home-group"></i>Tipe Unit</div>
                                <div class="timeline-detail-value" id="leg_type">-</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="timeline-detail-item">
                                <div class="timeline-detail-label"><i class="mdi mdi-ruler-square"></i>Luas Tanah</div>
                                <div class="timeline-detail-value" id="leg_area">-</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="timeline-detail-item">
                                <div class="timeline-detail-label"><i class="mdi mdi-home-city-outline"></i>Luas Bangunan</div>
                                <div class="timeline-detail-value" id="leg_building">-</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="timeline-detail-item">
                                <div class="timeline-detail-label"><i class="mdi mdi-cash-outline"></i>Harga</div>
                                <div class="timeline-detail-value price" id="leg_price">-</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="timeline-detail-item">
                                <div class="timeline-detail-label"><i class="mdi mdi-compass-outline"></i>Arah Hadap</div>
                                <div class="timeline-detail-value" id="leg_direction">-</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="timeline-detail-item">
                                <div class="timeline-detail-label"><i class="mdi mdi-toggle-switch-outline"></i>Status Unit</div>
                                <div class="timeline-detail-value" id="leg_status">-</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="timeline-detail-item">
                                <div class="timeline-detail-label"><i class="mdi mdi-progress-check"></i>Status Pembangunan</div>
                                <div class="timeline-detail-value">
                                    <div class="progress-wrapper">
                                        <div class="progress-row">
                                            <div class="progress">
                                                <div class="progress-bar-custom progress-green" id="leg_progress_bar" style="width: 0%"></div>
                                            </div>
                                            <span class="progress-percent" id="leg_progress_pct">0%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="timeline-detail-item">
                                <div class="timeline-detail-label"><i class="mdi mdi-map-marker-outline"></i>Alamat / Lokasi</div>
                                <div class="timeline-detail-value" id="leg_address">-</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Informasi Booking -->
                <div class="timeline-detail-card" id="leg_booking_card">
                    <div class="timeline-detail-title">
                        <i class="mdi mdi-calendar-check-outline me-1"></i>Informasi Penjualan & Booking
                    </div>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="timeline-detail-item">
                                <div class="timeline-detail-label"><i class="mdi mdi-account-outline"></i>Customer</div>
                                <div class="timeline-detail-value">
                                    <div class="name-wrap">
                                        <div class="name-initial" id="leg_customer_initial" style="background: linear-gradient(135deg, #da8cff, #9a55ff);">-</div>
                                        <div class="name-info">
                                            <div class="name-title" id="leg_customer">-</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="timeline-detail-item">
                                <div class="timeline-detail-label"><i class="mdi mdi-account-tie-outline"></i>Sales / Agency</div>
                                <div class="timeline-detail-value">
                                    <div class="name-wrap">
                                        <div class="name-initial" id="leg_sales_initial" style="background: linear-gradient(135deg, #667eea, #764ba2);">-</div>
                                        <div class="name-info">
                                            <div class="name-title" id="leg_sales">-</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="timeline-detail-item">
                                <div class="timeline-detail-label"><i class="mdi mdi-calendar-today"></i>Tanggal Booking</div>
                                <div class="timeline-detail-value" id="leg_booking_date">-</div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="timeline-detail-item">
                                <div class="timeline-detail-label"><i class="mdi mdi-cash-multiple"></i>Booking Fee</div>
                                <div class="timeline-detail-value fee-text" id="leg_booking_fee">-</div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="timeline-detail-item">
                                <div class="timeline-detail-label"><i class="mdi mdi-hand-coin-outline"></i>Agent Fee</div>
                                <div class="timeline-detail-value fee-text" id="leg_agent_fee">-</div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="timeline-detail-item">
                                <div class="timeline-detail-label"><i class="mdi mdi-toggle-switch"></i>Status Booking</div>
                                <div class="timeline-detail-value" id="leg_booking_status">-</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Placeholder jika tidak ada booking -->
                <div class="timeline-detail-card" id="leg_no_booking_card" style="display:none;">
                    <div class="text-center text-muted py-4">
                        <i class="mdi mdi-information-outline text-primary" style="font-size: 2.5rem;"></i>
                        <p class="mb-0 fw-semibold">Belum ada booking atau transaksi penjualan untuk unit ini.</p>
                        <small class="text-muted">Unit masih berstatus Tersedia / Ready.</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
// Switch Siteplan vs Matriks Grid View vs Progress Bangunan
function switchSiteplanView(view) {
    // Reset all tab button active states
    $('#btnTabSiteplan, #btnTabMatriks, #btnTabProgress').removeClass('active');
    // Hide all containers
    $('#viewSiteplanContainer, #viewMatriksContainer, #viewProgressContainer').addClass('d-none');

    if (view === 'siteplan') {
        $('#btnTabSiteplan').addClass('active');
        $('#viewSiteplanContainer').removeClass('d-none');
        if (typeof initLegalSiteplanCanvas === 'function') {
            setTimeout(initLegalSiteplanCanvas, 100);
        }
    } else if (view === 'matriks') {
        $('#btnTabMatriks').addClass('active');
        $('#viewMatriksContainer').removeClass('d-none');
    } else if (view === 'progress') {
        $('#btnTabProgress').addClass('active');
        $('#viewProgressContainer').removeClass('d-none');
    }
}

@if($hasDenah && !$isPdf)
// =========================================================================
// FABRIC.JS SITEPLAN CANVAS ENGINE (TIM LEGAL MEMETAKAN BULETAN UNIT)
// =========================================================================
// FABRIC.JS SITEPLAN CANVAS ENGINE (TIM LEGAL MEMETAKAN BULETAN UNIT)
// =========================================================================
let canvasLegal = null;
let isDraggingLegal = false;
let lastPosXLegal, lastPosYLegal;

const legalUnitsData = [
    @foreach ($land->units as $unit)
    @php
        $booking = $unit->bookings ? $unit->bookings->first() : null;
        $custName = $booking ? ($booking->customer_name ?? ($booking->customer->name ?? '-')) : '-';
        $salesName = $booking ? ($booking->sales_name ?? ($booking->sales->name ?? '-')) : '-';
        $bDate = $booking && $booking->booking_date ? \Carbon\Carbon::parse($booking->booking_date)->translatedFormat('d F Y') : '-';
        $bFee = $booking->booking_fee ?? 0;
        $aFee = $booking->agent_fee ?? 0;
        $bStat = $booking->status ?? '-';
        $hasBk = $booking ? true : false;
    @endphp
    {
        id: "{{ $unit->id }}",
        unitCode: "{{ $unit->unit_code }}",
        unitName: "{{ str_replace(["\r", "\n"], ' ', addslashes($unit->unit_name ?? '-')) }}",
        unitNumber: "{{ str_replace(["\r", "\n"], ' ', addslashes($unit->unit_number ?? '-')) }}",
        block: "{{ str_replace(["\r", "\n"], ' ', addslashes($unit->block ?? '-')) }}",
        jenis: "{{ str_replace(["\r", "\n"], ' ', addslashes($unit->jenis ?? 'rumah')) }}",
        type: "{{ str_replace(["\r", "\n"], ' ', addslashes($unit->type ?? '-')) }}",
        address: "{{ str_replace(["\r", "\n"], ' ', addslashes($unit->address ?? ($land->address ?? '-'))) }}",
        area: "{{ $unit->area ?? '-' }}",
        building: "{{ $unit->building_area ?? '-' }}",
        price: {{ $unit->price ?? 0 }},
        direction: "{{ str_replace(["\r", "\n"], ' ', addslashes($unit->facing ?? ($unit->direction ?? '-'))) }}",
        statusRaw: "{{ $unit->status ?? 'ready' }}",
        statusText: "{{ ucfirst($unit->status ?? 'ready') }}",
        construction: "{{ $unit->construction_progress ?? 'belum_mulai' }}",
        pos_x: {{ $unit->pos_x ?? 100 }},
        pos_y: {{ $unit->pos_y ?? 100 }},
        width: {{ $unit->width ?? 70 }},
        angle: {{ $unit->angle ?? 0 }},
        hasBooking: {{ $hasBk ? 'true' : 'false' }},
        customer: "{{ str_replace(["\r", "\n"], ' ', addslashes($custName)) }}",
        sales: "{{ str_replace(["\r", "\n"], ' ', addslashes($salesName)) }}",
        bookingDate: "{{ $bDate }}",
        bookingFee: {{ $bFee }},
        agentFee: {{ $aFee }},
        bookingStatus: "{{ $bStat }}",
    },
    @endforeach
];

function populateModalLegal(data) {
    document.getElementById('leg_unit_name').innerText = data.unitName || '-';
    document.getElementById('leg_block').innerText = data.block || '-';
    document.getElementById('leg_unit_number').innerText = data.unitNumber || '-';
    document.getElementById('leg_jenis').innerText = data.jenis ? (data.jenis.charAt(0).toUpperCase() + data.jenis.slice(1)) : '-';
    document.getElementById('leg_type').innerText = data.type || '-';
    document.getElementById('leg_area').innerText = data.area ? data.area + ' m²' : '-';
    document.getElementById('leg_building').innerText = data.building ? data.building + ' m²' : '-';
    document.getElementById('leg_price').innerText = 'Rp ' + new Intl.NumberFormat('id-ID').format(data.price || 0);
    document.getElementById('leg_direction').innerText = data.direction || '-';
    document.getElementById('leg_address').innerText = data.address || '-';

    // Status Penjualan (Jelas & Kontras Tinggi)
    const sRaw = (data.statusRaw || '').toLowerCase();
    const tRaw = (data.type || '').toLowerCase();
    let sHtml = '';
    if (sRaw === 'ready' || sRaw === 'tersedia') {
        if (tRaw === 'komersil') {
            sHtml = `<span class="badge shadow-sm" style="background: #2675BB; color: #ffffff !important; font-size: 0.82rem; font-weight: 700; padding: 6px 12px; border-radius: 20px;"><i class="mdi mdi-office-building me-1"></i>Tersedia (Ready Komersil)</span>`;
        } else {
            sHtml = `<span class="badge shadow-sm" style="background: #28a745; color: #ffffff !important; font-size: 0.82rem; font-weight: 700; padding: 6px 12px; border-radius: 20px;"><i class="mdi mdi-check-circle me-1"></i>Tersedia (Ready Subsidi)</span>`;
        }
    } else if (sRaw === 'booked') {
        sHtml = `<span class="badge shadow-sm" style="background: #ffc107; color: #212529 !important; font-size: 0.82rem; font-weight: 700; padding: 6px 12px; border-radius: 20px;"><i class="mdi mdi-bookmark-check me-1"></i>Booked (Terbooking)</span>`;
    } else if (sRaw === 'sold' || sRaw === 'terjual') {
        sHtml = `<span class="badge shadow-sm" style="background: #dc3545; color: #ffffff !important; font-size: 0.82rem; font-weight: 700; padding: 6px 12px; border-radius: 20px;"><i class="mdi mdi-close-circle me-1"></i>Terjual (Sold)</span>`;
    } else {
        sHtml = `<span class="badge bg-secondary shadow-sm" style="color: #ffffff !important; font-size: 0.82rem; font-weight: 700; padding: 6px 12px; border-radius: 20px;">${data.statusText || sRaw}</span>`;
    }
    document.getElementById('leg_status').innerHTML = sHtml;

    // Progress Pembangunan Fisik (Gradient & Jelas)
    const cMap = {
        'belum_mulai': { pct: 0, label: '0% - Belum Mulai', bg: '#adb5bd' },
        'pondasi': { pct: 20, label: '20% - Pondasi', bg: 'linear-gradient(135deg, #fd7e14, #ff922b)' },
        'dinding': { pct: 40, label: '40% - Dinding', bg: 'linear-gradient(135deg, #ffc107, #ffd43b)' },
        'atap': { pct: 60, label: '60% - Atap', bg: 'linear-gradient(135deg, #17a2b8, #3bc9db)' },
        'finishing': { pct: 80, label: '80% - Finishing', bg: 'linear-gradient(135deg, #9a55ff, #da8cff)' },
        'selesai': { pct: 100, label: '100% - Selesai', bg: 'linear-gradient(135deg, #28a745, #5cb85c)' }
    };
    const cInfo = cMap[data.construction] || { pct: 0, label: '0% - Belum Mulai', bg: '#adb5bd' };
    const pBar = document.getElementById('leg_progress_bar');
    pBar.style.width = cInfo.pct + '%';
    pBar.style.background = cInfo.bg;
    document.getElementById('leg_progress_pct').innerText = cInfo.label;

    // Tombol Edit Unit
    const btnEdit = document.getElementById('btnEditFromDetailLegal');
    if (data.unitId) {
        btnEdit.style.display = 'inline-block';
        btnEdit.onclick = function() {
            const detailModal = bootstrap.Modal.getInstance(document.getElementById('detailUnitModalLegal'));
            if (detailModal) detailModal.hide();
            setTimeout(() => {
                const editModalEl = document.getElementById('editUnitModal' + data.unitId);
                if (editModalEl) {
                    const m = new bootstrap.Modal(editModalEl);
                    m.show();
                }
            }, 300);
        };
    } else {
        btnEdit.style.display = 'none';
    }

    // Informasi Booking
    if (data.hasBooking) {
        document.getElementById('leg_booking_card').style.display = 'block';
        document.getElementById('leg_no_booking_card').style.display = 'none';

        const cust = data.customer || '-';
        const sales = data.sales || '-';
        document.getElementById('leg_customer').innerText = cust;
        document.getElementById('leg_customer_initial').innerText = (cust !== '-' && cust) ? cust.trim().charAt(0).toUpperCase() : '?';
        document.getElementById('leg_sales').innerText = sales;
        document.getElementById('leg_sales_initial').innerText = (sales !== '-' && sales) ? sales.trim().charAt(0).toUpperCase() : '?';
        document.getElementById('leg_booking_date').innerText = data.bookingDate || '-';
        document.getElementById('leg_booking_fee').innerText = 'Rp ' + new Intl.NumberFormat('id-ID').format(data.bookingFee || 0);
        document.getElementById('leg_agent_fee').innerText = 'Rp ' + new Intl.NumberFormat('id-ID').format(data.agentFee || 0);

        const bStatus = data.bookingStatus || '-';
        let bBadge = '';
        if (bStatus === 'active') {
            bBadge = `<span class="badge bg-success px-2 py-1 rounded-pill"><i class="mdi mdi-check-circle me-1"></i>Aktif</span>`;
        } else if (bStatus === 'completed' || bStatus === 'lunas') {
            bBadge = `<span class="badge bg-success px-2 py-1 rounded-pill"><i class="mdi mdi-check-circle me-1"></i>Selesai</span>`;
        } else if (bStatus === 'cancelled') {
            bBadge = `<span class="badge bg-danger px-2 py-1 rounded-pill"><i class="mdi mdi-close-circle me-1"></i>Dibatalkan</span>`;
        } else {
            bBadge = `<span class="badge bg-secondary px-2 py-1 rounded-pill">${bStatus}</span>`;
        }
        document.getElementById('leg_booking_status').innerHTML = bBadge;
    } else {
        document.getElementById('leg_booking_card').style.display = 'none';
        document.getElementById('leg_no_booking_card').style.display = 'block';
    }
}

function openUnitDetailModalLegal(target) {
    if (!target || !target.unitId) return;
    populateModalLegal(target);
    const modal = new bootstrap.Modal(document.getElementById('detailUnitModalLegal'));
    modal.show();
}

function initLegalSiteplanCanvas() {
    if (typeof fabric === 'undefined') return;
    const canvasEl = document.getElementById('siteplanCanvasLegal');
    if (!canvasEl) return;

    const scrollContainer = canvasEl.closest('.siteplan-scroll-container') || canvasEl.parentElement;
    const containerWidth = (scrollContainer && scrollContainer.clientWidth > 100) ? scrollContainer.clientWidth : 1100;
    const containerHeight = (scrollContainer && scrollContainer.clientHeight > 100) ? scrollContainer.clientHeight : 620;

    if (!canvasLegal) {
        canvasLegal = new fabric.Canvas('siteplanCanvasLegal', {
            defaultCursor: 'grab'
        });

        // Zoom via Mouse Wheel
        canvasLegal.on('mouse:wheel', function(opt) {
            const delta = opt.e.deltaY;
            let zoomVal = canvasLegal.getZoom();
            zoomVal *= (delta < 0 ? 1.1 : 0.9);
            if (zoomVal > 3.5) zoomVal = 3.5;
            if (zoomVal < 0.3) zoomVal = 0.3;
            legalZoomLevel = zoomVal;
            const pointer = canvasLegal.getPointer(opt.e);
            canvasLegal.zoomToPoint(new fabric.Point(pointer.x, pointer.y), legalZoomLevel);
            opt.e.preventDefault();
            opt.e.stopPropagation();
            canvasLegal.renderAll();
        });

        // Background Drag to Pan & Click to Open Detail Modal
        let clickStartPosLegal = { x: 0, y: 0 };
        canvasLegal.on('mouse:down', function(opt) {
            if (opt.e) {
                clickStartPosLegal = { x: opt.e.clientX, y: opt.e.clientY };
            }
            if (!canvasLegal.getActiveObject()) {
                isDraggingLegal = true;
                canvasLegal.selection = false;
                canvasLegal.setCursor('grabbing');
                lastPosXLegal = opt.e.clientX;
                lastPosYLegal = opt.e.clientY;
            }
        });
        canvasLegal.on('mouse:move', function(opt) {
            if (isDraggingLegal) {
                const e = opt.e;
                const vpt = canvasLegal.viewportTransform;
                vpt[4] += e.clientX - lastPosXLegal;
                vpt[5] += e.clientY - lastPosYLegal;
                canvasLegal.requestRenderAll();
                lastPosXLegal = e.clientX;
                lastPosYLegal = e.clientY;
            }
        });
        canvasLegal.on('mouse:up', function(opt) {
            canvasLegal.setViewportTransform(canvasLegal.viewportTransform);
            isDraggingLegal = false;
            canvasLegal.selection = true;
            canvasLegal.setCursor('grab');

            // Buka Modal Detail Unit saat bulatan di-KLIK (tanpa drag)
            if (opt.target && opt.target.unitId && opt.e) {
                const dist = Math.hypot(opt.e.clientX - clickStartPosLegal.x, opt.e.clientY - clickStartPosLegal.y);
                if (dist < 6) {
                    openUnitDetailModalLegal(opt.target);
                }
            }
        });

        // Buka Modal Detail Unit saat bulatan di-DOUBLE CLICK
        canvasLegal.on('mouse:dblclick', function(opt) {
            if (opt.target && opt.target.unitId) {
                openUnitDetailModalLegal(opt.target);
            }
        });
    } else {
        canvasLegal.clear();
    }

    const denahUrl = "{{ $denahUrl }}";
    fabric.Image.fromURL(denahUrl, function(img) {
        if (!img || !img.width) return;

        // Skala agar gambar denah mengisi bidang kanvas secara optimal dan besar
        const scaleX = containerWidth / img.width;
        const scaleY = containerHeight / img.height;
        const scaleFactor = Math.max(scaleX, scaleY);

        canvasLegal.setWidth(containerWidth);
        canvasLegal.setHeight(containerHeight);

        img.set({
            scaleX: scaleFactor,
            scaleY: scaleFactor,
            originX: 'left',
            originY: 'top'
        });

        canvasLegal.setBackgroundImage(img, function() {
            legalUnitsData.forEach(u => {
                // Warna & Gaya Utama mengikuti STATUS PEMBANGUNAN FISIK
                let fillColor = '#adb5bd'; // default abu-abu untuk Belum Mulai (0%)
                let strokeColor = '#495057';
                let strokeWidth = 1.5;
                let strokeDash = null;

                switch (u.construction) {
                    case 'pondasi':
                        fillColor = '#fd7e14'; // Oranye
                        strokeColor = '#d96509';
                        strokeWidth = 3;
                        strokeDash = [5, 2];
                        break;
                    case 'dinding':
                        fillColor = '#ffc107'; // Kuning Emas
                        strokeColor = '#d39e00';
                        strokeWidth = 3;
                        strokeDash = [5, 2];
                        break;
                    case 'atap':
                        fillColor = '#17a2b8'; // Cyan
                        strokeColor = '#117a8b';
                        strokeWidth = 3.5;
                        strokeDash = [6, 2];
                        break;
                    case 'finishing':
                        fillColor = '#9a55ff'; // Ungu
                        strokeColor = '#7a3bcf';
                        strokeWidth = 3.5;
                        strokeDash = [6, 2];
                        break;
                    case 'selesai':
                        fillColor = '#28a745'; // HIJAU HANYA JIKA PEMBANGUNAN SUDAH SELESAI (100%)
                        strokeColor = '#1e7e34';
                        strokeWidth = 3;
                        break;
                    default:
                        // Belum Mulai -> Abu-abu Netral
                        fillColor = '#adb5bd';
                        strokeColor = '#6c757d';
                        strokeWidth = 1.5;
                        break;
                }

                // Border Khusus jika unit sudah Sold atau Booked
                if (u.statusRaw === 'sold') {
                    strokeColor = '#dc3545'; // Merah Sold
                    strokeWidth = 4;
                    strokeDash = null;
                } else if (u.statusRaw === 'booked') {
                    strokeColor = '#ffc107'; // Kuning Emas Booked
                    strokeWidth = 3.5;
                }

                const circle = new fabric.Circle({
                    left: (u.pos_x || 100) * scaleFactor,
                    top: (u.pos_y || 100) * scaleFactor,
                    radius: ((u.width || 70) * scaleFactor) / 2,
                    angle: u.angle || 0,
                    fill: fillColor,
                    opacity: 0.75,
                    stroke: strokeColor,
                    strokeWidth: strokeWidth,
                    strokeDashArray: strokeDash,
                    hasControls: true,
                    hasBorders: true,
                    lockRotation: false
                });

                // Attach all rich attributes
                circle.unitId = u.id;
                circle.unitCode = u.unitCode;
                circle.unitName = u.unitName;
                circle.unitNumber = u.unitNumber;
                circle.block = u.block;
                circle.jenis = u.jenis;
                circle.type = u.type;
                circle.address = u.address;
                circle.area = u.area;
                circle.building = u.building;
                circle.price = u.price;
                circle.direction = u.direction;
                circle.statusRaw = u.statusRaw;
                circle.statusText = u.statusText;
                circle.construction = u.construction;
                circle.hasBooking = u.hasBooking;
                circle.customer = u.customer;
                circle.sales = u.sales;
                circle.bookingDate = u.bookingDate;
                circle.bookingFee = u.bookingFee;
                circle.agentFee = u.agentFee;
                circle.bookingStatus = u.bookingStatus;
                circle.scaleFactor = scaleFactor;

                canvasLegal.add(circle);
            });

            canvasLegal.renderAll();
        });
    });
}

function savePositionLegal() {
    if (!canvasLegal) return;
    let units = [];
    canvasLegal.getObjects().forEach(function(obj) {
        if (obj.unitId) {
            const sf = obj.scaleFactor || 1;
            units.push({
                id: obj.unitId,
                pos_x: Math.round(obj.left / sf),
                pos_y: Math.round(obj.top / sf),
                width: Math.round(obj.getScaledWidth() / sf),
                height: Math.round(obj.getScaledHeight() / sf),
                angle: Math.round(obj.angle || 0)
            });
        }
    });

    Swal.fire({
        title: 'Menyimpan Posisi...',
        text: 'Menyimpan koordinat buletan unit di siteplan',
        allowOutsideClick: false,
        didOpen: () => Swal.showLoading()
    });

    fetch("{{ route('unit.save.position') }}", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ units: units })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Posisi buletan unit di siteplan berhasil disimpan dan tersinkronisasi ke marketing.',
                timer: 1800,
                showConfirmButton: false
            });
        } else {
            Swal.fire('Gagal', 'Gagal menyimpan posisi unit', 'error');
        }
    })
    .catch(error => {
        Swal.fire('Error', 'Terjadi kesalahan sistem', 'error');
    });
}

$(document).ready(function() {
    setTimeout(initLegalSiteplanCanvas, 300);
});
@endif

// Filter House Cards berdasarkan Blok di Tab Progress
function filterHouseBlok(blok, btn) {
    $('.denah-filter-pill').removeClass('active');
    $(btn).addClass('active');

    if (blok === 'all') {
        $('.house-blok-section').removeClass('d-none');
        $('.house-card').removeClass('d-none');
    } else {
        $('.house-blok-section').each(function() {
            if ($(this).data('blok') === blok) {
                $(this).removeClass('d-none');
            } else {
                $(this).addClass('d-none');
            }
        });
    }
}

// Zoom Interactive Engine for Siteplan
let currentZoom = 1.0;
let legalZoomLevel = 1.0;

function zoomSiteplan(delta) {
    if (typeof canvasLegal !== 'undefined' && canvasLegal) {
        legalZoomLevel = Math.max(0.3, Math.min(3.0, legalZoomLevel + delta));
        canvasLegal.zoomToPoint(new fabric.Point(canvasLegal.getWidth() / 2, canvasLegal.getHeight() / 2), legalZoomLevel);
        canvasLegal.renderAll();
        return;
    }
    const img = document.getElementById('siteplanImageElement');
    if (!img) return;
    currentZoom = Math.max(0.5, Math.min(3.5, currentZoom + delta));
    img.style.transform = `scale(${currentZoom})`;
}

function resetSiteplanZoom() {
    if (typeof canvasLegal !== 'undefined' && canvasLegal) {
        legalZoomLevel = 1.0;
        canvasLegal.setZoom(1.0);
        canvasLegal.setViewportTransform([1, 0, 0, 1, 0, 0]);
        canvasLegal.renderAll();
        return;
    }
    const img = document.getElementById('siteplanImageElement');
    if (!img) return;
    currentZoom = 1.0;
    img.style.transform = 'scale(1)';
}

function openSiteplanLightbox() {
    $('#modalSiteplanLightbox').modal('show');
}

function showFilterLoading() {
    Swal.fire({
        title: 'Memuat...',
        text: 'Memfilter data unit kavling',
        allowOutsideClick: false,
        didOpen: () => Swal.showLoading()
    });
    return true;
}

function showResetLoading(e) {
    e.preventDefault();
    Swal.fire({
        title: 'Mereset...',
        text: 'Mengembalikan filter ke default',
        allowOutsideClick: false,
        didOpen: () => Swal.showLoading()
    });
    window.location.href = "{{ url()->current() }}";
}

$(document).ready(function() {
    // Auto-submit saat ganti opsi limit/filter
    $('#perPageSelect, #filterType, #filterPosisi, #filterHadap').on('change', function() {
        $('#filterForm').submit();
    });

    // Tab switching modal as distinct buttons
    $('.modal-tab-btn').on('click', function(e) {
        e.preventDefault();
        $('.modal-tab-btn').removeClass('active btn-gradient-primary btn-gradient-success text-white')
            .addClass('btn-outline-secondary')
            .css({'background': '#f8f9fa', 'color': '#475569', 'border-color': '#e2e8f0'});
        
        var target = $(this).data('modal-tab');
        $('.modal-tab-pane').removeClass('active');

        if (target === 'manual') {
            $(this).addClass('active btn-gradient-primary text-white').removeClass('btn-outline-secondary').css({'background': '', 'color': '', 'border-color': ''});
            $('#modal-manual-pane').addClass('active');
            $('#btnSubmitManual').removeClass('d-none');
            $('#btnSubmitImport').addClass('d-none');
        } else {
            $(this).addClass('active btn-gradient-success text-white').removeClass('btn-outline-secondary').css({'background': '', 'color': '', 'border-color': ''});
            $('#modal-import-pane').addClass('active');
            $('#btnSubmitManual').addClass('d-none');
            $('#btnSubmitImport').removeClass('d-none');
        }
    });

    // File change Excel
    $('#uploadExcelModal').on('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            if (file.size > 5 * 1024 * 1024) {
                Swal.fire('Error', 'Ukuran file maksimal 5MB!', 'error');
                $(this).val('');
                $('#fileNameModal').text('Pilih atau Drag & Drop file Excel di sini');
                return;
            }
            $('#fileNameModal').text(file.name);
        } else {
            $('#fileNameModal').text('Pilih atau Drag & Drop file Excel di sini');
        }
    });

    // File change SPK PDF
    $('#uploadDokumenSpkInput').on('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            if (file.size > 10 * 1024 * 1024) {
                Swal.fire('Error', 'Ukuran file PDF maksimal 10MB!', 'error');
                $(this).val('');
                $('#dokumenSpkFileName').text('Pilih berkas PDF atau seret ke sini');
                return;
            }
            $('#dokumenSpkFileName').html('<span class="text-primary fw-bold"><i class="mdi mdi-file-pdf me-1 text-danger"></i>' + file.name + '</span>');
        } else {
            $('#dokumenSpkFileName').text('Pilih berkas PDF atau seret ke sini');
        }
    });

    // Price formatting
    $(document).on('keyup', '.price-format', function() {
        let val = $(this).val().replace(/\D/g, '');
        if (val) {
            $(this).val(new Intl.NumberFormat('id-ID').format(val));
        }
    });

    // Submit form manual
    $('#formTambahUnitManual').on('submit', function(e) {
        e.preventDefault();
        $('.price-format').each(function() {
            let val = $(this).val().replace(/\./g, '');
            $(this).val(val);
        });
        Swal.fire({
            title: 'Memuat...',
            text: 'Sedang menyimpan unit kavling',
            allowOutsideClick: false,
            didOpen: () => Swal.showLoading()
        });
        this.submit();
    });

    // Submit form edit
    $(document).on('submit', '[id^="formEditUnitManual"]', function(e) {
        e.preventDefault();
        $(this).find('.price-format').each(function() {
            let val = $(this).val().replace(/\./g, '');
            $(this).val(val);
        });
        Swal.fire({
            title: 'Memuat...',
            text: 'Sedang menyimpan perubahan unit',
            allowOutsideClick: false,
            didOpen: () => Swal.showLoading()
        });
        this.submit();
    });

    // Submit import
    $('#formImportExcelModal').on('submit', function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Mengimpor Data...',
            text: 'Sedang memproses file Excel',
            allowOutsideClick: false,
            didOpen: () => Swal.showLoading()
        });
        this.submit();
    });

    // SPK Unit Multi-Select Controls
    function updateSpkUnitCounter() {
        const count = $('.spk-unit-checkbox:checked').length;
        $('#spkUnitCounter').text(count + ' unit kavling dipilih');
    }

    $(document).on('change', '.spk-unit-checkbox', function() {
        updateSpkUnitCounter();
        if ($(this).is(':checked')) {
            $(this).closest('.spk-unit-card').addClass('border-primary bg-primary bg-opacity-10');
        } else {
            $(this).closest('.spk-unit-card').removeClass('border-primary bg-primary bg-opacity-10');
        }
    });

    $('#btnSelectAllSpkUnits').on('click', function() {
        $('.spk-unit-item-col:visible .spk-unit-checkbox').prop('checked', true).trigger('change');
    });

    $('#btnUnselectAllSpkUnits').on('click', function() {
        $('.spk-unit-checkbox').prop('checked', false).trigger('change');
    });

    $('#filterSpkUnitSearch').on('keyup', function() {
        const q = $(this).val().toLowerCase();
        $('.spk-unit-item-col').each(function() {
            const code = $(this).data('code') || '';
            const name = $(this).data('name') || '';
            const type = $(this).data('type') || '';
            if (code.includes(q) || name.includes(q) || type.includes(q)) {
                $(this).removeClass('d-none');
            } else {
                $(this).addClass('d-none');
            }
        });
    });

    // Submit Form SPK
    $('#formAssignSpkModal').on('submit', function(e) {
        const selectedCount = $('.spk-unit-checkbox:checked').length;
        if (selectedCount === 0) {
            e.preventDefault();
            Swal.fire('Peringatan', 'Silakan pilih minimal 1 unit kavling yang akan dihubungkan dengan SPK ini!', 'warning');
            return false;
        }

        Swal.fire({
            title: 'Menerbitkan SPK...',
            text: 'Menghubungkan nomor SPK ke unit-unit terpilih',
            allowOutsideClick: false,
            didOpen: () => Swal.showLoading()
        });
    });
});

// Konfirmasi Hapus SweetAlert
function confirmDelete(btn, code) {
    Swal.fire({
        title: 'Hapus Unit ' + code + '?',
        text: 'Data unit kavling yang dihapus tidak dapat dikembalikan.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            btn.closest('form').submit();
        }
    });
}
</script>
@endpush
