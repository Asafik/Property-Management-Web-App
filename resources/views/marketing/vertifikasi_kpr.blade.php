@extends('layouts.partial.app')

@section('title', 'Vertifikasi KPR - Properti Management')

@section('content')

<style>
    /* ===== STYLING DARI VERIFIKASI KPR UNTUK UPLOAD DOKUMEN ===== */
    .verifikasi-file-upload {
        position: relative;
        width: 100%;
    }

    .verifikasi-file-upload input[type="file"] {
        position: absolute;
        opacity: 0;
        width: 100%;
        height: 100%;
        cursor: pointer;
        z-index: 2;
    }

    .verifikasi-file-upload .verifikasi-file-label {
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
        .verifikasi-file-upload .verifikasi-file-label {
            flex-direction: row;
            text-align: left;
            gap: 8px;
            padding: 0.75rem 1rem;
            min-height: auto;
        }
    }

    .verifikasi-file-upload:hover .verifikasi-file-label {
        border-color: #9a55ff;
        background: linear-gradient(135deg, #f1f0ff, #f8f9fa);
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(154, 85, 255, 0.1);
    }

    .verifikasi-file-upload .verifikasi-file-label i {
        font-size: 1.6rem;
        color: #9a55ff;
        background: rgba(154, 85, 255, 0.1);
        padding: 8px;
        border-radius: 50%;
    }

    .verifikasi-file-upload .verifikasi-file-label .verifikasi-file-info {
        flex: 1;
        width: 100%;
    }

    .verifikasi-file-upload .verifikasi-file-label .verifikasi-file-info span {
        display: block;
        font-weight: 600;
        color: #2c2e3f;
        font-size: 0.8rem;
        word-break: break-word;
    }

    .verifikasi-file-upload .verifikasi-file-label .verifikasi-file-info small {
        color: #6c7383;
        font-size: 0.65rem;
        display: block;
        margin-top: 2px;
    }

    /* ===== STYLING BUTTON DARI VERIFIKASI KPR ===== */
    .verifikasi-btn {
        font-size: 0.8rem;
        padding: 0.5rem 1rem;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s ease;
        font-family: 'Nunito', sans-serif;
        display: inline-block;
        text-decoration: none;
        cursor: pointer;
        border: none;
        width: 100%;
        text-align: center;
    }

    @media (min-width: 576px) {
        .verifikasi-btn {
            width: auto;
            padding: 0.5rem 1.2rem;
        }
    }

    .verifikasi-btn-primary {
        background: linear-gradient(to right, #da8cff, #9a55ff);
        color: #ffffff;
        box-shadow: 0 4px 12px rgba(154, 85, 255, 0.3);
    }

    .verifikasi-btn-primary:hover {
        background: linear-gradient(to right, #c77cff, #8a45e6);
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(154, 85, 255, 0.4);
    }

    .verifikasi-btn-success {
        background: linear-gradient(135deg, #28a745, #5cb85c);
        color: #ffffff;
        box-shadow: 0 4px 12px rgba(40, 167, 69, 0.3);
    }

    .verifikasi-btn-success:hover {
        background: linear-gradient(135deg, #218838, #4cae4c);
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(40, 167, 69, 0.4);
    }

    .verifikasi-btn-outline-primary {
        background: transparent;
        border: 1px solid #9a55ff;
        color: #9a55ff;
    }

    .verifikasi-btn-outline-primary:hover {
        background: linear-gradient(135deg, #9a55ff, #da8cff);
        color: #ffffff;
        border-color: transparent;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(154, 85, 255, 0.3);
    }

    .verifikasi-btn-outline-secondary {
        background: transparent;
        border: 1px solid #e9ecef;
        color: #6c7383;
    }

    .verifikasi-btn-outline-secondary:hover {
        background: linear-gradient(135deg, #f8f9fa, #f1f3f5);
        color: #2c2e3f;
        border-color: #9a55ff;
        transform: translateY(-2px);
    }

    .verifikasi-btn-outline-warning {
        background: transparent;
        border: 1px solid #ffc107;
        color: #ffc107;
    }

    .verifikasi-btn-outline-warning:hover {
        background: linear-gradient(135deg, #ffc107, #ffdb6d);
        color: #2c2e3f;
        border-color: transparent;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(255, 193, 7, 0.3);
    }

    /* Text colors */
    .verifikasi-text-primary {
        color: #9a55ff !important;
    }

    /* ===== STYLE CSS DARI HALAMAN AKAD (HANYA YANG DIPERLUKAN) ===== */
    .konfirmasi-alert {
        border: none;
        border-radius: 10px;
        padding: 0.8rem 1rem;
        font-size: 0.8rem;
        border-left: 4px solid;
        margin-bottom: 1rem;
    }

    .konfirmasi-alert-danger {
        background: linear-gradient(135deg, #fff0f0, #ffe6e6);
        color: #2c2e3f;
        border-left-color: #dc3545;
    }

    .konfirmasi-alert-danger i {
        color: #dc3545;
    }

    .konfirmasi-form-group {
        margin-bottom: 1rem;
    }

    .konfirmasi-form-group label {
        font-size: 0.8rem;
        font-weight: 600;
        color: #9a55ff !important;
        margin-bottom: 0.3rem;
        display: block;
    }

    .konfirmasi-form-control {
        border: 1px solid #e9ecef;
        border-radius: 10px;
        padding: 0.7rem 0.8rem;
        font-size: 0.85rem;
        width: 100%;
    }

    .konfirmasi-form-control:focus {
        border-color: #9a55ff;
        box-shadow: 0 0 0 3px rgba(154, 85, 255, 0.1);
        outline: none;
    }

    .konfirmasi-text-primary {
        color: #9a55ff !important;
    }

    .konfirmasi-tindakan-card {
        position: relative;
        margin-bottom: 1rem;
        width: 100%;
    }

    .konfirmasi-tindakan-card input[type="radio"] {
        position: absolute;
        opacity: 0;
        width: 0;
        height: 0;
    }

    .konfirmasi-tindakan-label {
        display: flex;
        align-items: center;
        gap: 15px;
        padding: 1rem 1rem;
        background: linear-gradient(135deg, #f8f9fa, #f1f3f5);
        border: 2px solid #e9ecef;
        border-radius: 16px;
        cursor: pointer;
        transition: all 0.3s ease;
        min-height: 70px;
    }

    .konfirmasi-tindakan-label:hover {
        border-color: #9a55ff;
        background: linear-gradient(135deg, #f1f0ff, #f8f9fa);
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(154, 85, 255, 0.15);
    }

    .konfirmasi-tindakan-card input[type="radio"]:checked + .konfirmasi-tindakan-label {
        border-color: #9a55ff;
        background: linear-gradient(135deg, #f1f0ff, #e8e0ff);
    }

    .konfirmasi-tindakan-icon {
        flex-shrink: 0;
        width: 45px;
        height: 45px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: white;
        border-radius: 12px;
    }

    .konfirmasi-tindakan-icon i {
        font-size: 24px;
        color: #9a55ff;
    }

    .konfirmasi-tindakan-content {
        flex: 1;
        display: flex;
        flex-direction: column;
        gap: 2px;
    }

    .konfirmasi-tindakan-title {
        font-size: 0.95rem;
        font-weight: 700;
        color: #2c2e3f;
    }

    .konfirmasi-tindakan-desc {
        font-size: 0.75rem;
        color: #6c7383;
    }

    .konfirmasi-tindakan-check {
        flex-shrink: 0;
        width: 24px;
        height: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .konfirmasi-tindakan-check i {
        font-size: 20px;
        color: #d0d4db;
    }

    .konfirmasi-tindakan-card input[type="radio"]:checked + .konfirmasi-tindakan-label .konfirmasi-tindakan-check i {
        color: #9a55ff;
    }

    .konfirmasi-btn {
        font-size: 0.8rem;
        padding: 0.5rem 1rem;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s ease;
        display: inline-block;
        text-decoration: none;
        cursor: pointer;
        border: none;
    }

    .konfirmasi-btn-primary {
        background: linear-gradient(to right, #da8cff, #9a55ff);
        color: #ffffff;
    }

    .konfirmasi-btn-primary:hover {
        background: linear-gradient(to right, #c77cff, #8a45e6);
        transform: translateY(-2px);
    }

    .konfirmasi-btn-outline-secondary {
        background: transparent;
        border: 1px solid #e9ecef;
        color: #6c7383;
    }

    .konfirmasi-btn-outline-secondary:hover {
        background: linear-gradient(135deg, #f8f9fa, #f1f3f5);
        color: #2c2e3f;
        border-color: #9a55ff;
        transform: translateY(-2px);
    }

    .badge.bg-warning {
        background: linear-gradient(135deg, #ffc107, #ffdb6d) !important;
        color: #2c2e3f;
    }

    .badge.bg-success {
        background: linear-gradient(135deg, #28a745, #5cb85c) !important;
        color: white;
    }

    .badge.bg-danger {
        background: linear-gradient(135deg, #dc3545, #e4606d) !important;
        color: white;
    }

    .badge {
        padding: 5px 10px;
        font-weight: 500;
        border-radius: 30px;
    }

    .table th {
        font-weight: 600;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #495057;
    }

    .table td {
        vertical-align: middle;
        padding: 0.75rem;
    }

    .table tbody tr:hover {
        background-color: #f8f9fa;
    }

    .timeline-steps .step .step-icon {
        transition: all 0.3s ease;
    }
    .timeline-steps .step.completed .step-icon {
        background-color: #28a745 !important;
    }
    .timeline-steps .step.active .step-icon {
        background-color: #ffc107 !important;
        box-shadow: 0 0 0 3px rgba(255, 193, 7, 0.2);
    }
</style>

<div class="row">
    <div class="col-12">
        <!-- Header Info Customer -->
        <div class="card">
            <div class="card-body">
                <div class="d-flex flex-wrap align-items-center gap-3">
                    <!-- Avatar -->
                    <div class="flex-shrink-0">
                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center"
                            style="width: 50px; height: 50px;">
                            <i class="mdi mdi-account" style="font-size: 24px;"></i>
                        </div>
                    </div>

                    <!-- Info Customer -->
                    <div class="flex-grow-1">
                        <h4 class="mb-1">{{ $booking->customer->full_name ?? '-' }}</h4>
                        <p class="text-muted mb-0">Booking ID: {{ $booking->booking_code ?? '-' }}</p>
                    </div>

                    <!-- Info Unit -->
                    <div class="mt-3 mt-sm-0">
                        <div class="d-flex flex-wrap gap-3">
                            <div>
                                <small class="text-muted d-block">Unit</small>
                                <span class="fw-medium">{{ $booking->unit->unit_name ?? '-' }}</span>
                            </div>
                            <div>
                                <small class="text-muted d-block">Blok/No</small>
                                <span class="fw-medium">{{ $booking->unit->unit_code ?? '-' }}</span>
                            </div>
                            <div>
                                <small class="text-muted d-block">Harga Unit</small>
                                <span class="fw-medium text-primary">
                                    Rp {{ number_format($booking->unit->price ?? 0, 0, ',', '.') }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Row untuk Progress dan Detail -->
<div class="row mt-4">
    <!-- Kolom Kiri: Progress Timeline -->
    <div class="col-12 col-lg-8 mb-4 mb-lg-0">
        <div class="card h-100">
            <div class="card-body">
                <h5 class="card-title">
                    <i class="mdi mdi-timeline-text me-2 text-primary"></i>
                    Tahapan Verifikasi KPR
                </h5>

                <!-- Progress Bar -->
                <div class="mb-4">
                    <div class="d-flex flex-wrap justify-content-between mb-2">
                        <span class="text-muted">Progress Verifikasi</span>
                        <span class="text-primary">Tahap 2 dari 5</span>
                    </div>
                    <div class="progress">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 40%;" aria-valuenow="40"
                            aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>

                <!-- Timeline Steps -->
                <div class="timeline-steps">
                    <div class="row g-2 g-md-0">
                        <div class="col-4 col-md text-center mb-3 mb-md-0">
                            <div class="step completed">
                                <div class="step-icon bg-success text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-2"
                                    style="width: 35px; height: 35px;">
                                    <i class="mdi mdi-check" style="font-size: 18px;"></i>
                                </div>
                                <span class="d-block text-success small fw-medium">Diajukan</span>
                                <small class="text-muted d-none d-sm-block">
                                    {{ $booking->kprApplication->submitted_at ? \Carbon\Carbon::parse($booking->kprApplication->submitted_at)->translatedFormat('j F Y') : '-' }}
                                </small>
                            </div>
                        </div>
                        <div class="col-4 col-md text-center mb-3 mb-md-0">
                            <div class="step active">
                                <div class="step-icon bg-primary text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-2"
                                    style="width: 35px; height: 35px;">
                                    <i class="mdi mdi-file-document" style="font-size: 18px;"></i>
                                </div>
                                <span class="d-block small fw-medium">Verifikasi</span>
                                <small class="text-muted d-none d-sm-block">Sedang Proses</small>
                            </div>
                        </div>
                        <div class="col-4 col-md text-center mb-3 mb-md-0">
                            <div class="step">
                                <div class="step-icon bg-light text-muted rounded-circle d-flex align-items-center justify-content-center mx-auto mb-2"
                                    style="width: 35px; height: 35px;">
                                    <i class="mdi mdi-home" style="font-size: 18px;"></i>
                                </div>
                                <span class="d-block text-muted small fw-medium">Survey</span>
                                <small class="text-muted d-none d-sm-block">Menunggu</small>
                            </div>
                        </div>
                        <div class="col-4 col-md text-center mt-2 mt-md-0">
                            <div class="step">
                                <div class="step-icon bg-light text-muted rounded-circle d-flex align-items-center justify-content-center mx-auto mb-2"
                                    style="width: 35px; height: 35px;">
                                    <i class="mdi mdi-handshake" style="font-size: 18px;"></i>
                                </div>
                                <span class="d-block text-muted small fw-medium">Akad</span>
                                <small class="text-muted d-none d-sm-block">Menunggu</small>
                            </div>
                        </div>
                        <div class="col-4 col-md text-center mt-2 mt-md-0">
                            <div class="step">
                                <div class="step-icon bg-light text-muted rounded-circle d-flex align-items-center justify-content-center mx-auto mb-2"
                                    style="width: 35px; height: 35px;">
                                    <i class="mdi mdi-cash" style="font-size: 18px;"></i>
                                </div>
                                <span class="d-block text-muted small fw-medium">Cair</span>
                                <small class="text-muted d-none d-sm-block">Menunggu</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Kolom Kanan: Detail KPR -->
    <div class="col-12 col-lg-4">
        <div class="card h-100">
            <div class="card-body">
                <h5 class="card-title">
                    <i class="mdi mdi-bank me-2 text-primary"></i>
                    Detail KPR
                </h5>

                <div class="detail-info">
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Bank Tujuan</span>
                        <span class="fw-medium">{{ $booking->kprApplication->bank->bank_name ?? '-' }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Jumlah Pinjaman</span>
                        <span class="fw-medium">
                            Rp {{ number_format($booking->kprApplication->jumlah_pinjaman ?? 0, 0, ',', '.') }}
                        </span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Tenor</span>
                        <span class="fw-medium">{{ $booking->kprApplication->tenor ?? '-' }} Tahun</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span class="text-muted">Angsuran/bln</span>
                        <span class="fw-medium text-primary">
                            Rp {{ number_format($booking->kprApplication->estimasi_angsuran ?? 0, 0, ',', '.') }}
                        </span>
                    </div>
                </div>

                <hr class="my-3">

                <div class="mt-3">
                    <small class="text-muted d-block mb-2">Ditangani oleh:</small>
                    <div class="d-flex align-items-center">
                        <div class="bg-light rounded-circle p-2 me-2">
                            <i class="mdi mdi-account-tie text-primary"></i>
                        </div>
                        <div>
                            <span class="fw-medium d-block">{{ $booking->sales->name ?? '-' }}</span>
                            <small class="text-muted">{{ $booking->sales->role ?? '-' }}</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Row Kelengkapan Dokumen -->
<div class="row mt-4">
    <div class="col-12 col-lg-8 mb-4 mb-lg-0">
        <div class="card h-100">
            <div class="card-body">
                <h5 class="card-title">
                    <i class="mdi mdi-file-document-multiple me-2 text-primary"></i>
                    Kelengkapan Dokumen
                </h5>

                @php
                    $allTypes = [
                        'ktp',
                        'kk',
                        'npwp',
                        'slip_gaji',
                        'rekening_koran',
                        'surat_nikah',
                        'sku',
                        'ktp_pasangan',
                    ];

                    $missingCount = collect($allTypes)
                        ->filter(function ($type) use ($booking) {
                            return !$booking->kprApplication->documents->where('type', $type)->first();
                        })
                        ->count();
                @endphp

                @if ($missingCount > 0)
                    <div class="konfirmasi-alert konfirmasi-alert-warning" role="alert">
                        <i class="mdi mdi-information-outline me-2"></i>
                        Masih ada {{ $missingCount }} dokumen yang perlu dilengkapi
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="bg-light">
                            <tr>
                                <th style="width:40%">Nama Dokumen</th>
                                <th style="width:25%">Status</th>
                                <th style="width:20%">Tanggal Upload</th>
                                <th style="width:15%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($allTypes as $type)
                                @php
                                    $doc = $booking->kprApplication->documents->where('type', $type)->first();
                                    $status = $doc ? 'Lengkap' : 'Kurang';
                                    $badge = $doc ? 'bg-success' : 'bg-danger';
                                    $date = $doc
                                        ? \Carbon\Carbon::parse($doc->created_at)->translatedFormat('d M Y')
                                        : '-';
                                @endphp
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="mdi mdi-file-document-outline text-primary me-2"></i>
                                            <span>{{ strtoupper(str_replace('_', ' ', $type)) }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge {{ $badge }}">{{ $status }}</span>
                                    </td>
                                    <td>
                                        <small>{{ $date }}</small>
                                    </td>
                                    <td>
                                        @if ($doc)
                                            <a href="{{ asset('storage/' . $doc->path) }}" target="_blank"
                                                class="btn btn-sm btn-outline-primary">
                                                <i class="mdi mdi-eye"></i>
                                            </a>
                                        @else
                                            <button class="btn btn-sm btn-outline-secondary" disabled>
                                                <i class="mdi mdi-eye-off"></i>
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="text-muted small mt-2 d-block d-sm-none">
                    <i class="mdi mdi-information-outline me-1"></i>
                    Geser tabel untuk melihat kolom lainnya
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-lg-4">
        <div class="card h-100">
            <div class="card-body">
                <h5 class="card-title">
                    <i class="mdi mdi-information me-2 text-primary"></i>
                    Informasi Verifikasi
                </h5>

                <!-- Status Card -->
                @php
                    $lengkapCount = collect($allTypes)
                        ->filter(fn($type) => $booking->kprApplication->documents->where('type', $type)->first())
                        ->count();
                    $kurangCount = count($allTypes) - $lengkapCount;
                @endphp

                @if ($kurangCount > 0)
                    <div class="text-center mb-3">
                    <span class="badge bg-warning p-2">
                        <i class="mdi mdi-progress-clock me-1"></i>
                        Menunggu Verifikasi Dokumen ({{ $kurangCount }} dokumen kurang)
                    </span>
                </div>
                @else
                    <div class="text-center mb-4">
                        <span class="badge bg-success p-2" style="font-size: 14px;">
                            <i class="mdi mdi-check-circle-outline me-1"></i>
                            Semua Dokumen Lengkap
                        </span>
                    </div>
                @endif

                <!-- Ringkasan Dokumen -->
                <h6 class="mb-3 konfirmasi-text-primary">Status Dokumen</h6>
                <div class="mb-3">
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Dokumen Lengkap</span>
                        <span class="fw-medium text-success">{{ $lengkapCount }} Dokumen</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Dokumen Kurang</span>
                        <span class="fw-medium text-danger">{{ $kurangCount }} Dokumen</span>
                    </div>
                </div>

                <hr class="my-3">

                <!-- Rekomendasi -->
                <h6 class="mb-3 konfirmasi-text-primary">Rekomendasi</h6>
                @if ($kurangCount > 0)
                    <div class="konfirmasi-alert konfirmasi-alert-warning py-2">
                        <i class="mdi mdi-information-outline me-2"></i>
                        Lengkapi {{ $kurangCount }} dokumen yang kurang sebelum verifikasi
                    </div>
                @else
                    <div class="konfirmasi-alert konfirmasi-alert-success py-2">
                        <i class="mdi mdi-check-circle-outline me-2"></i>
                        Semua dokumen lengkap, siap untuk verifikasi
                    </div>
                @endif

                <hr class="my-3">

                <!-- Timeline -->
                <h6 class="mb-3 konfirmasi-text-primary">Timeline Pengajuan</h6>
                <div class="konfirmasi-timeline">
                    <div class="konfirmasi-timeline-item">
                        <div class="konfirmasi-timeline-icon">
                            <i class="mdi mdi-check-circle text-success"></i>
                        </div>
                        <div class="konfirmasi-timeline-content">
                            <span class="konfirmasi-timeline-text">Pengajuan KPR</span>
                            <small class="konfirmasi-timeline-date">
                                {{ $booking->kprApplication->submitted_at ? \Carbon\Carbon::parse($booking->kprApplication->submitted_at)->translatedFormat('j F Y') : '-' }}
                            </small>
                        </div>
                    </div>
                    <div class="konfirmasi-timeline-item">
                        <div class="konfirmasi-timeline-icon">
                            <i class="mdi mdi-progress-clock text-warning"></i>
                        </div>
                        <div class="konfirmasi-timeline-content">
                            <span class="konfirmasi-timeline-text">Verifikasi Dokumen</span>
                            <small class="konfirmasi-timeline-date">Sedang Proses</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Row untuk Verifikasi KPR - HANYA FORM PENOLAKAN -->
<div class="row mt-4">
    <!-- Kolom Kiri: Form Verifikasi -->
    <div class="col-12 col-lg-8 mb-4 mb-lg-0">
        <div class="card h-100">
            <div class="card-body">
                 <h5 class="card-title">
                            <i class="mdi mdi-help-circle me-2 text-primary"></i>
                            Verifikasi KPR
                        </h5>

                <div class="konfirmasi-alert konfirmasi-alert-danger" role="alert">
                    <i class="mdi mdi-information-outline me-2"></i>
                    Pilih status verifikasi. Keputusan ini akan menentukan langkah selanjutnya.
                </div>

                <form action="{{ route('kpr.verifikasi.store', $booking->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="status_verifikasi" value="ditolak">

                    <!-- FORM PENOLAKAN -->
                    <div>
                        <div class="konfirmasi-form-group">
                            <label>Catatan / Alasan</label>
                            <textarea class="konfirmasi-form-control" name="catatan_tolak" rows="3" placeholder="Berikan catatan untuk customer atau internal..."></textarea>
                        </div>

                        <!-- Upload Berita Acara (Opsional) - PAKAI STYLING ASLI VERIFIKASI -->
                        <div class="verifikasi-form-group mb-4">
                            <label class="verifikasi-text-primary">Upload Berita Acara (Opsional)</label>
                            <div class="verifikasi-file-upload">
                                <input type="file" id="uploadDokumen" name="berita_acara" accept=".jpg,.jpeg,.png,.pdf">
                                <div class="verifikasi-file-label">
                                    <i class="mdi mdi-cloud-upload"></i>
                                    <div class="verifikasi-file-info">
                                        <span>Upload Berita Acara</span>
                                        <small>Format: JPG, PNG, PDF (Max 5MB)</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr class="my-3">

                        <h6 class="mb-3 konfirmasi-text-primary">Tindakan Selanjutnya</h6>

                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <div class="konfirmasi-tindakan-card">
                                    <input type="radio" name="tindakan" id="tindakanLengkapi" value="Lengkapi Dokumen" checked>
                                    <label class="konfirmasi-tindakan-label" for="tindakanLengkapi">
                                        <div class="konfirmasi-tindakan-icon">
                                            <i class="mdi mdi-file-document-edit"></i>
                                        </div>
                                        <div class="konfirmasi-tindakan-content">
                                            <span class="konfirmasi-tindakan-title">Lengkapi Dokumen</span>
                                            <span class="konfirmasi-tindakan-desc">Customer diminta melengkapi dokumen</span>
                                        </div>
                                        <div class="konfirmasi-tindakan-check">
                                            <i class="mdi mdi-check-circle"></i>
                                        </div>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="konfirmasi-tindakan-card">
                                    <input type="radio" name="tindakan" id="tindakanUlang" value="Ajukan ke Bank Lain">
                                    <label class="konfirmasi-tindakan-label" for="tindakanUlang">
                                        <div class="konfirmasi-tindakan-icon">
                                            <i class="mdi mdi-bank-transfer"></i>
                                        </div>
                                        <div class="konfirmasi-tindakan-content">
                                            <span class="konfirmasi-tindakan-title">Ajukan ke Bank Lain</span>
                                            <span class="konfirmasi-tindakan-desc">Pengajuan ulang KPR</span>
                                        </div>
                                        <div class="konfirmasi-tindakan-check">
                                            <i class="mdi mdi-check-circle"></i>
                                        </div>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="konfirmasi-tindakan-card">
                                    <input type="radio" name="tindakan" id="tindakanCash" value="Pindah ke Cash">
                                    <label class="konfirmasi-tindakan-label" for="tindakanCash">
                                        <div class="konfirmasi-tindakan-icon">
                                            <i class="mdi mdi-cash-multiple"></i>
                                        </div>
                                        <div class="konfirmasi-tindakan-content">
                                            <span class="konfirmasi-tindakan-title">Pindah ke Cash</span>
                                            <span class="konfirmasi-tindakan-desc">Customer akan membayar tunai</span>
                                        </div>
                                        <div class="konfirmasi-tindakan-check">
                                            <i class="mdi mdi-check-circle"></i>
                                        </div>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="konfirmasi-tindakan-card">
                                    <input type="radio" name="tindakan" id="tindakanBatal" value="Batalkan Transaksi">
                                    <label class="konfirmasi-tindakan-label" for="tindakanBatal">
                                        <div class="konfirmasi-tindakan-icon">
                                            <i class="mdi mdi-cancel"></i>
                                        </div>
                                        <div class="konfirmasi-tindakan-content">
                                            <span class="konfirmasi-tindakan-title">Batalkan Transaksi</span>
                                            <span class="konfirmasi-tindakan-desc">Customer batal beli (refund)</span>
                                        </div>
                                        <div class="konfirmasi-tindakan-check">
                                            <i class="mdi mdi-check-circle"></i>
                                        </div>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="konfirmasi-tindakan-card">
                                    <input type="radio" name="tindakan" id="tindakanBanding" value="Banding Ulang">
                                    <label class="konfirmasi-tindakan-label" for="tindakanBanding">
                                        <div class="konfirmasi-tindakan-icon">
                                            <i class="mdi mdi-scale-balance"></i>
                                        </div>
                                        <div class="konfirmasi-tindakan-content">
                                            <span class="konfirmasi-tindakan-title">Banding Ulang</span>
                                            <span class="konfirmasi-tindakan-desc">Ajukan banding ke bank yang sama</span>
                                        </div>
                                        <div class="konfirmasi-tindakan-check">
                                            <i class="mdi mdi-check-circle"></i>
                                        </div>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 d-flex justify-content-between">
                        <a href="{{ url('/marketing/kpr') }}" class="konfirmasi-btn konfirmasi-btn-outline-secondary">
                            <i class="mdi mdi-arrow-left me-2"></i>
                            Kembali
                        </a>

                        <button type="submit" class="konfirmasi-btn konfirmasi-btn-primary">
                            <i class="mdi mdi-content-save me-2"></i>
                            Submit Verifikasi
                        </button>
                    </div>
                </form>

                <!-- Informasi Tambahan untuk Mobile -->
                <div class="text-muted small mt-2 d-block d-sm-none">
                    <i class="mdi mdi-information-outline me-1"></i>
                    Geser untuk melihat konten lainnya
                </div>
            </div>
        </div>
    </div>

    <!-- Kolom Kanan: Info & Ringkasan (sudah di atas) -->
    <div class="col-12 col-lg-4">
        <!-- Konten sudah di atas, tidak perlu diulang -->
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Handler untuk file upload - menampilkan nama file
        const fileInput = document.getElementById('uploadDokumen');
        if (fileInput) {
            fileInput.addEventListener('change', function(e) {
                const fileName = e.target.files[0]?.name;
                const label = this.closest('.verifikasi-file-upload').querySelector(
                    '.verifikasi-file-info span');
                if (fileName && label) {
                    label.textContent = fileName.length > 30 ? fileName.substring(0, 30) + '...' :
                        fileName;
                }
            });
        }
    });
</script>
@endpush
