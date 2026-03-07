@extends('layouts.partial.app')

@section('title', 'Pembelian Cash Tenor - Property Management App')

@section('content')
    <link rel="stylesheet" href="{{ asset('assets/css/marketing/pengajuan.css') }}">

    {{-- Styling Upload dari Halaman Properti --}}
    <style>
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
        box-shadow: 0 5px 15px rgba(154, 85, 255, 0.15);
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

    /* Alert styling */
    .alert {
        border: none;
        border-radius: 10px;
        padding: 0.8rem 1rem;
        font-size: 0.8rem;
        border-left: 4px solid;
        margin-bottom: 1rem;
    }

    .alert-success {
        background: linear-gradient(135deg, #f6f9ff, #f0f4ff);
        color: #2c2e3f;
        border-left-color: #9a55ff;
    }

    .alert-info {
        background: linear-gradient(135deg, #f6f9ff, #f0f4ff);
        color: #2c2e3f;
        border-left-color: #9a55ff;
    }

    /* Custom badge untuk cash */
    .badge-cash {
        background: linear-gradient(135deg, #da8cff, #9a55ff);
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.75rem;
    }

    .badge-cash-tenor {
        background: linear-gradient(135deg, #ffc107, #ffdb6d);
        color: #2c2e3f;
        padding: 0.5rem 1rem;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.75rem;
    }

    /* Progress bar */
    .progress {
        background-color: #f0f0f0;
        border-radius: 10px;
        height: 10px;
    }

    .progress-bar {
        background: linear-gradient(135deg, #da8cff, #9a55ff) !important;
        border-radius: 10px;
    }

    /* Timeline */
    .timeline-item {
        display: flex;
        gap: 1rem;
        margin-bottom: 1rem;
    }

    .timeline-icon {
        width: 40px;
        height: 40px;
        background: #f1f0ff;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #9a55ff;
    }

    .timeline-icon.completed {
        background: linear-gradient(135deg, #da8cff, #9a55ff);
        color: white;
    }

    .timeline-icon.warning {
        background: linear-gradient(135deg, #ffc107, #ffdb6d);
        color: #2c2e3f;
    }

    /* Custom responsive adjustments */
    @media (max-width: 576px) {
        .properti-file-upload-modern .properti-file-label-modern {
            padding: 0.8rem 0.5rem;
        }

        .properti-file-upload-modern .properti-file-label-modern i {
            font-size: 1.4rem;
        }

        .properti-file-upload-modern .properti-file-label-modern .properti-file-info-modern span {
            font-size: 0.75rem;
        }
    }

    input, select, textarea, button {
        font-size: 16px !important;
    }

    /* Animasi */
    @keyframes cashPulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.05); }
        100% { transform: scale(1); }
    }

    .cash-icon {
        animation: cashPulse 2s infinite;
    }

    /* Button primary */
    .btn-primary-custom {
        background: linear-gradient(to right, #da8cff, #9a55ff);
        color: #ffffff;
        border: none;
        padding: 12px;
        border-radius: 12px;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(154, 85, 255, 0.3);
        width: 100%;
        text-decoration: none;
        display: inline-block;
        text-align: center;
    }

    .btn-primary-custom:hover {
        background: linear-gradient(to right, #c77cff, #8a45e6);
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(154, 85, 255, 0.4);
        color: white;
    }

    .btn-secondary-custom {
        background: #f8f9fa;
        color: #2c2e3f;
        border: 1px solid #dee2e6;
        padding: 12px;
        border-radius: 12px;
        transition: all 0.3s ease;
        width: 100%;
        text-decoration: none;
        display: inline-block;
        text-align: center;
    }

    .btn-secondary-custom:hover {
        background: linear-gradient(135deg, #f0f2f5, #e4e6ea);
        transform: translateY(-2px);
        color: #2c2e3f;
    }

    /* Text primary */
    .text-primary-custom {
        color: #9a55ff !important;
    }

    /* Sticky header untuk tabel */
    .table-responsive {
        max-height: 250px;
        overflow-y: auto;
    }

    .table thead th {
        position: sticky;
        top: 0;
        background: #f8f9fa;
        z-index: 1;
    }

    /* Card border colors */
    .border-left-warning {
        border-left: 4px solid #ffc107 !important;
    }

    .border-left-primary {
        border-left: 4px solid #9a55ff !important;
    }
    </style>

    <div class="container-fluid p-3 p-md-4">
        <!-- Header -->
       <div class="row mb-4">
            <div class="col-12">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
                            <div>
                                <div class="d-flex align-items-center gap-2 mb-2">
                                    <h3 class="text-dark fw-bold" style="color: #2c2e3f; margin-bottom: 0;">
                                        <i class="fas fa-coins cash-icon me-2" style="color: #9a55ff;"></i>
                                        Form Pembelian Cash Tenor
                                    </h3>
                                     <span class="badge-cash-tenor">Cash Tenor (Maks. 3 Tahun)</span>
                                </div>
                                <p class="text-muted small" style="margin-bottom: 0;">
                                    <i class="mdi mdi-information-outline me-1 text-primary"></i>
                                    Pembayaran bertahap dengan jangka waktu maksimal 36 bulan (3 tahun)
                                </p>
                            </div>
                            <div class="d-none d-md-block mt-3 mt-md-0">
                                <i class="fas fa-coins" style="font-size: 2.5rem; color: #9a55ff; opacity: 0.2;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Info Status -->
        <div class="pengajuan-row mb-3">
            <div class="pengajuan-col-12">
                <div class="pengajuan-card pengajuan-bg-light border-0">
                    <div class="pengajuan-card-body py-3">
                        <div class="d-flex flex-column flex-sm-row align-items-start align-items-sm-center gap-2">
                            <div>
                                <span class="pengajuan-badge pengajuan-badge-primary">Pembelian Cash Tenor</span>
                            </div>
                            <div class="pengajuan-text-muted small d-flex align-items-center">
                                <i class="mdi mdi-calendar me-1 text-primary-custom"></i>
                                <span>Tanggal: 21 Februari 2026</span>
                            </div>
                            <div class="ms-sm-auto mt-2 mt-sm-0">
                                <span class="pengajuan-badge pengajuan-badge-warning">Status: Menunggu Pembayaran</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Alert Info -->
        <div class="alert alert-info d-flex align-items-center gap-2 mb-4">
            <i class="fas fa-info-circle" style="color: #9a55ff;"></i>
            <span>Cash Tenor: Pembayaran bertahap dengan jangka waktu maksimal 3 tahun (36 bulan)</span>
        </div>

        <!-- Form Pembelian Cash -->
        <div class="pengajuan-row">
            <div class="pengajuan-col-12 pengajuan-col-lg-8">
                <div class="pengajuan-card">
                    <div class="pengajuan-card-header d-flex align-items-center gap-2">
                        <i class="fas fa-file-invoice" style="color: #9a55ff; font-size: 1.2rem;"></i>
                        <h4 class="mb-0">Data Pembelian Cash Tenor</h4>
                    </div>
                    <div class="pengajuan-card-body">
                        <form class="pengajuan-form-sample">
                            <!-- Customer -->
                            <div class="pengajuan-row">
                                <div class="pengajuan-col-12 pengajuan-col-md-6">
                                    <div class="pengajuan-form-group">
                                        <label>Nama Customer <span class="text-primary-custom">*</span></label>
                                        <input type="text" class="pengajuan-form-control"
                                            placeholder="Masukkan nama lengkap customer" value="Budi Santoso">
                                        <small class="pengajuan-text-muted">Contoh: Budi Santoso</small>
                                    </div>
                                </div>
                                <div class="pengajuan-col-12 pengajuan-col-md-6">
                                    <div class="pengajuan-form-group">
                                        <label>No. KTP <span class="text-primary-custom">*</span></label>
                                        <input type="text" class="pengajuan-form-control"
                                            placeholder="Masukkan nomor KTP" value="3174123456789012">
                                    </div>
                                </div>
                            </div>

                            <div class="pengajuan-row">
                                <div class="pengajuan-col-12 pengajuan-col-md-6">
                                    <div class="pengajuan-form-group">
                                        <label>No. NPWP</label>
                                        <input type="text" class="pengajuan-form-control"
                                            placeholder="Masukkan nomor NPWP" value="99.999.999.9-999.999">
                                    </div>
                                </div>
                                <div class="pengajuan-col-12 pengajuan-col-md-6">
                                    <div class="pengajuan-form-group">
                                        <label>No. Telepon <span class="text-primary-custom">*</span></label>
                                        <input type="text" class="pengajuan-form-control"
                                            placeholder="Masukkan nomor telepon" value="081234567890">
                                    </div>
                                </div>
                            </div>

                            <div class="pengajuan-form-group">
                                <label>Alamat Lengkap <span class="text-primary-custom">*</span></label>
                                <textarea class="pengajuan-form-control" rows="2"
                                    placeholder="Masukkan alamat lengkap customer">Jl. Contoh No. 123, RT 01 RW 02, Kelurahan Contoh, Kecamatan Contoh, Jakarta Selatan</textarea>
                            </div>

                            <hr class="pengajuan-hr">

                            <!-- Unit -->
                            <div class="pengajuan-section-title">
                                <i class="fas fa-building me-2" style="color: #9a55ff;"></i>
                                Detail Unit
                            </div>

                            <div class="pengajuan-row">
                                <div class="pengajuan-col-12 pengajuan-col-sm-6 pengajuan-col-md-3">
                                    <div class="pengajuan-form-group">
                                        <label>Type Unit</label>
                                        <input type="text" class="pengajuan-form-control" value="Tipe 36/72" readonly>
                                    </div>
                                </div>
                                <div class="pengajuan-col-6 pengajuan-col-sm-6 pengajuan-col-md-3">
                                    <div class="pengajuan-form-group">
                                        <label>Blok</label>
                                        <input type="text" class="pengajuan-form-control" value="A" readonly>
                                    </div>
                                </div>
                                <div class="pengajuan-col-6 pengajuan-col-sm-6 pengajuan-col-md-3">
                                    <div class="pengajuan-form-group">
                                        <label>No. Unit</label>
                                        <input type="text" class="pengajuan-form-control" value="12" readonly>
                                    </div>
                                </div>
                                <div class="pengajuan-col-12 pengajuan-col-sm-6 pengajuan-col-md-3">
                                    <div class="pengajuan-form-group">
                                        <label>Luas Tanah/Bangunan</label>
                                        <input type="text" class="pengajuan-form-control" value="72 m² / 36 m²" readonly>
                                    </div>
                                </div>
                            </div>

                            <hr class="pengajuan-hr">

                            <!-- Detail Pembayaran -->
                            <div class="pengajuan-section-title">
                                <i class="fas fa-calculator me-2" style="color: #9a55ff;"></i>
                                Detail Pembayaran Cash Tenor
                            </div>

                            <div class="pengajuan-row">
                                <div class="pengajuan-col-12 pengajuan-col-md-6">
                                    <div class="pengajuan-form-group">
                                        <label>Harga Unit <span class="text-primary-custom">*</span></label>
                                        <div class="pengajuan-input-group">
                                            <span class="pengajuan-input-group-text">Rp</span>
                                            <input type="number" class="pengajuan-form-control" id="hargaUnit" value="500000000">
                                        </div>
                                    </div>
                                </div>

                                <div class="pengajuan-col-12 pengajuan-col-md-6">
                                    <div class="pengajuan-form-group">
                                        <label>Diskon</label>
                                        <div class="pengajuan-input-group">
                                            <span class="pengajuan-input-group-text">Rp</span>
                                            <input type="number" class="pengajuan-form-control" id="diskon" value="25000000">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="pengajuan-row">
                                <div class="pengajuan-col-12 pengajuan-col-md-6">
                                    <div class="pengajuan-form-group">
                                        <label>Booking Fee (Sudah Dibayar)</label>
                                        <div class="pengajuan-input-group">
                                            <span class="pengajuan-input-group-text">Rp</span>
                                            <input type="number" class="pengajuan-form-control" id="bookingFee" value="5000000" readonly>
                                        </div>
                                        <small class="pengajuan-text-muted">Booking fee sudah dibayar saat booking</small>
                                    </div>
                                </div>

                                <div class="pengajuan-col-12 pengajuan-col-md-6">
                                    <div class="pengajuan-form-group">
                                        <label>Metode Pembayaran <span class="text-primary-custom">*</span></label>
                                        <select class="pengajuan-form-control" id="metodePembayaran">
                                            <option value="">-- Pilih Metode --</option>
                                            <option value="transfer" selected>Transfer Bank</option>
                                            <option value="cash">Cash (Tunai)</option>
                                            <option value="giro">Cek / Giro</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- CASH TENOR SECTION -->
                            <div id="sectionCashTenor">
                                <div class="pengajuan-card mt-3 border-left-warning">
                                    <div class="pengajuan-card-header" style="background: transparent; border-bottom: 1px solid #dee2e6;">
                                        <i class="fas fa-calendar-alt text-warning me-2"></i>
                                        <span class="fw-bold">Cash Tenor / Tempo - Angsuran Maksimal 3 Tahun</span>
                                    </div>
                                    <div class="pengajuan-card-body">
                                        <!-- Detail Pembayaran Cash Tenor -->
                                        <div class="pengajuan-row">
                                            <div class="pengajuan-col-12 pengajuan-col-md-4">
                                                <div class="pengajuan-form-group">
                                                    <label>Jangka Waktu Tenor <span class="text-primary-custom">*</span></label>
                                                    <select class="pengajuan-form-control" id="jangkaTenor">
                                                        <option value="6">6 Bulan</option>
                                                        <option value="12" selected>12 Bulan (1 Tahun)</option>
                                                        <option value="18">18 Bulan</option>
                                                        <option value="24">24 Bulan (2 Tahun)</option>
                                                        <option value="30">30 Bulan</option>
                                                        <option value="36">36 Bulan (3 Tahun)</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="pengajuan-col-12 pengajuan-col-md-4">
                                                <div class="pengajuan-form-group">
                                                    <label>Uang Muka (DP) <span class="text-primary-custom">*</span></label>
                                                    <div class="pengajuan-input-group">
                                                        <span class="pengajuan-input-group-text">Rp</span>
                                                        <input type="number" class="pengajuan-form-control" id="uangMuka" value="100000000">
                                                    </div>
                                                    <small class="text-muted">Minimal 20% dari harga</small>
                                                </div>
                                            </div>
                                            <div class="pengajuan-col-12 pengajuan-col-md-4">
                                                <div class="pengajuan-form-group">
                                                    <label>Sisa Angsuran</label>
                                                    <div class="pengajuan-input-group">
                                                        <span class="pengajuan-input-group-text">Rp</span>
                                                        <input type="number" class="pengajuan-form-control" id="sisaAngsuran" value="375000000" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="pengajuan-row">
                                            <div class="pengajuan-col-12 pengajuan-col-md-4">
                                                <div class="pengajuan-form-group">
                                                    <label>Tanggal Mulai Angsuran</label>
                                                    <input type="date" class="pengajuan-form-control" id="tanggalMulaiAngsuran" value="2026-03-21">
                                                </div>
                                            </div>
                                            <div class="pengajuan-col-12 pengajuan-col-md-4">
                                                <div class="pengajuan-form-group">
                                                    <label>Tanggal Jatuh Tempo Akhir</label>
                                                    <input type="date" class="pengajuan-form-control" id="jatuhTempoAkhir" value="2027-02-21" readonly>
                                                </div>
                                            </div>
                                            <div class="pengajuan-col-12 pengajuan-col-md-4">
                                                <div class="pengajuan-form-group">
                                                    <label>Denda Keterlambatan</label>
                                                    <div class="pengajuan-input-group">
                                                        <span class="pengajuan-input-group-text">%</span>
                                                        <input type="number" class="pengajuan-form-control" id="denda" value="2" step="0.1">
                                                    </div>
                                                    <small>per bulan</small>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Tabel Simulasi Angsuran -->
                                        <div class="mt-4">
                                            <label class="fw-bold mb-2">
                                                <i class="fas fa-table me-2" style="color: #9a55ff;"></i>
                                                Simulasi Angsuran (<span id="tenorText">12 Bulan</span>)
                                            </label>
                                            <div class="table-responsive" style="max-height: 300px; overflow-y: auto;">
                                                <table class="table table-sm table-bordered small" id="tabelAngsuran">
                                                    <thead class="bg-light">
                                                        <tr>
                                                            <th>Bulan Ke-</th>
                                                            <th>Jatuh Tempo</th>
                                                            <th>Nominal Angsuran</th>
                                                            <th>Sisa Pokok</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tbodyAngsuran">
                                                        <!-- Akan diisi oleh JavaScript -->
                                                    </tbody>
                                                    <tfoot class="bg-light fw-bold">
                                                        <tr>
                                                            <td colspan="2" class="text-end">Total Angsuran:</td>
                                                            <td id="totalAngsuran">Rp 375.000.000</td>
                                                            <td></td>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                            <small class="text-muted">*Booking fee Rp 5.000.000 sudah termasuk dalam uang muka</small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr class="pengajuan-hr">

                            <!-- Upload Dokumen Pendukung -->
                            <div class="pengajuan-section-title">
                                <i class="fas fa-file-upload me-2" style="color: #9a55ff;"></i>
                                Upload Dokumen Pendukung
                            </div>
                            <p class="pengajuan-text-muted small mb-3">Upload dokumen untuk verifikasi pembelian cash tenor</p>

                            <div class="pengajuan-row">
                                @php
                                    $uploadFields = [
                                        'ktp' => 'KTP Customer',
                                        'npwp' => 'NPWP',
                                        'surat_perjanjian' => 'Surat Perjanjian'
                                    ];
                                @endphp

                                @foreach ($uploadFields as $field => $label)
                                    <div class="pengajuan-col-12 pengajuan-col-md-6 mb-3">
                                        <div class="pengajuan-form-group">
                                            <label for="{{ $field }}">{{ $label }}</label>
                                            <div class="properti-file-upload-modern">
                                                <input type="file" id="{{ $field }}" name="{{ $field }}"
                                                    accept=".jpg,.jpeg,.png,.pdf">
                                                <div class="properti-file-label-modern">
                                                    <i class="fas fa-cloud-upload-alt"></i>
                                                    <div class="properti-file-info-modern">
                                                        <span>Upload {{ $label }}</span>
                                                        <small>Format: PDF, JPG, PNG (Max: 2MB)</small>
                                                    </div>
                                                    <span class="properti-file-size"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Sidebar - Timeline dan Aksi -->
            <div class="pengajuan-col-12 pengajuan-col-lg-4">
                <!-- Timeline -->
                <div class="pengajuan-card">
                    <div class="pengajuan-card-header">
                        <i class="fas fa-history me-2" style="color: #9a55ff;"></i>
                        Timeline Pembayaran
                    </div>
                    <div class="pengajuan-card-body">
                        <!-- Timeline Booking Fee (Fixed) -->
                        <div class="timeline-item">
                            <div class="timeline-icon completed">
                                <i class="fas fa-check"></i>
                            </div>
                            <div>
                                <h6 class="mb-1">Booking Fee</h6>
                                <small class="pengajuan-text-muted">21 Jan 2026</small>
                                <p class="mb-0 small">Rp 5.000.000</p>
                            </div>
                        </div>

                        <!-- Dynamic Timeline untuk Cash Tenor -->
                        <div id="timelineTenor">
                            <div class="timeline-item">
                                <div class="timeline-icon warning">
                                    <i class="fas fa-hand-holding-usd"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1">Uang Muka (DP)</h6>
                                    <small class="pengajuan-text-muted">21 Feb 2026</small>
                                    <p class="mb-0 small">Rp 100.000.000</p>
                                </div>
                            </div>
                            <div class="timeline-item">
                                <div class="timeline-icon">
                                    <i class="fas fa-clock"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1" id="timelineAngsuran">Angsuran 1 - 12</h6>
                                    <small class="pengajuan-text-muted" id="timelinePeriode">Mar 2026 - Feb 2027</small>
                                    <p class="mb-0 small" id="timelineNominal">12 x Rp 31.250.000</p>
                                </div>
                            </div>
                        </div>

                        <!-- Summary -->
                        <hr class="pengajuan-hr mt-4">
                        <div class="d-flex justify-content-between mb-2">
                            <span>Total Harga Unit:</span>
                            <span class="fw-bold" id="totalHargaDisplay">Rp 500.000.000</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Diskon:</span>
                            <span class="fw-bold text-success" id="diskonDisplay">- Rp 25.000.000</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Booking Fee (terbayar):</span>
                            <span class="fw-bold" id="bookingFeeDisplay">Rp 5.000.000</span>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <span class="fw-bold">Sisa yang harus dibayar:</span>
                            <span class="fw-bold text-primary" id="sisaBayarDisplay">Rp 470.000.000</span>
                        </div>

                        <!-- Button Aksi -->
                        <div class="d-grid gap-2 mt-3">
                            <button class="btn-primary-custom" id="btnProses">
                                <i class="fas fa-save me-2"></i>
                                Proses Cash Tenor
                            </button>
                            <a href="#" class="btn-secondary-custom">
                                <i class="fas fa-arrow-left me-2"></i>
                                Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Script untuk File Upload dan Perhitungan --}}
    @push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // File upload modern preview
            document.querySelectorAll('.properti-file-upload-modern input[type="file"]').forEach(input => {
                input.addEventListener('change', function(e) {
                    const fileName = e.target.files[0]?.name;
                    const fileSize = e.target.files[0]?.size;
                    const label = this.closest('.properti-file-upload-modern').querySelector('.properti-file-info-modern span');
                    const sizeSpan = this.closest('.properti-file-upload-modern').querySelector('.properti-file-size');

                    if (fileName) {
                        label.textContent = fileName.length > 30 ? fileName.substring(0, 30) + '...' : fileName;
                        if (fileSize) {
                            const sizeInMB = (fileSize / (1024 * 1024)).toFixed(2);
                            sizeSpan.textContent = sizeInMB + ' MB';
                        }
                    } else {
                        const inputId = this.id;
                        const labelText = inputId.split('_').map(word =>
                            word.charAt(0).toUpperCase() + word.slice(1)
                        ).join(' ');
                        label.textContent = 'Upload ' + labelText;
                        sizeSpan.textContent = '';
                    }
                });
            });

            // ===== FUNGSI HITUNG CASH TENOR =====
            function hitungTenor() {
                var hargaUnit = parseFloat($('#hargaUnit').val()) || 0;
                var diskon = parseFloat($('#diskon').val()) || 0;
                var bookingFee = parseFloat($('#bookingFee').val()) || 0;
                var uangMuka = parseFloat($('#uangMuka').val()) || 0;

                var hargaSetelahDiskon = hargaUnit - diskon;
                var sisaAngsuran = hargaSetelahDiskon - uangMuka;

                $('#sisaAngsuran').val(sisaAngsuran);

                // Update display di sidebar
                var sisaBayar = hargaSetelahDiskon - bookingFee;
                $('#sisaBayarDisplay').text('Rp ' + formatRupiah(sisaBayar));

                return sisaAngsuran;
            }

            // ===== GENERATE TABEL ANGSURAN =====
            function generateTabelAngsuran() {
                var sisaAngsuran = parseFloat($('#sisaAngsuran').val()) || 0;
                var jangkaTenor = parseInt($('#jangkaTenor').val()) || 12;
                var tanggalMulai = $('#tanggalMulaiAngsuran').val() || '2026-03-21';

                var angsuranPerBulan = sisaAngsuran / jangkaTenor;
                var sisa = sisaAngsuran;

                var tbody = '';
                for (var i = 1; i <= jangkaTenor; i++) {
                    var tanggal = new Date(tanggalMulai);
                    tanggal.setMonth(tanggal.getMonth() + (i - 1));

                    var options = { day: 'numeric', month: 'short', year: 'numeric' };
                    var tanggalFormatted = tanggal.toLocaleDateString('id-ID', options);

                    sisa -= angsuranPerBulan;
                    if (i === jangkaTenor) {
                        sisa = 0;
                    }

                    tbody += '<tr>' +
                        '<td>' + i + '</td>' +
                        '<td>' + tanggalFormatted + '</td>' +
                        '<td>Rp ' + formatRupiah(angsuranPerBulan) + '</td>' +
                        '<td>Rp ' + formatRupiah(Math.max(sisa, 0)) + '</td>' +
                        '</tr>';
                }

                $('#tbodyAngsuran').html(tbody);
                $('#totalAngsuran').text('Rp ' + formatRupiah(sisaAngsuran));
                $('#tenorText').text(jangkaTenor + ' Bulan');

                // Update timeline
                var akhirBulan = new Date(tanggalMulai);
                akhirBulan.setMonth(akhirBulan.getMonth() + (jangkaTenor - 1));
                var tahunAkhir = akhirBulan.getFullYear();
                var bulanAkhir = akhirBulan.toLocaleDateString('id-ID', { month: 'short' });
                var tahunMulai = new Date(tanggalMulai).getFullYear();
                var bulanMulai = new Date(tanggalMulai).toLocaleDateString('id-ID', { month: 'short' });

                $('#timelineAngsuran').text('Angsuran 1 - ' + jangkaTenor);
                $('#timelinePeriode').text(bulanMulai + ' ' + tahunMulai + ' - ' + bulanAkhir + ' ' + tahunAkhir);
                $('#timelineNominal').text(jangkaTenor + ' x Rp ' + formatRupiah(angsuranPerBulan));

                // Update jatuh tempo akhir
                updateJatuhTempoAkhir();
            }

            // ===== UPDATE JATUH TEMPO AKHIR =====
            function updateJatuhTempoAkhir() {
                var bulan = parseInt($('#jangkaTenor').val()) || 12;
                var tanggalMulai = $('#tanggalMulaiAngsuran').val() || '2026-03-21';

                if (tanggalMulai) {
                    var date = new Date(tanggalMulai);
                    date.setMonth(date.getMonth() + bulan);
                    var tahun = date.getFullYear();
                    var bulanAngka = ('0' + (date.getMonth() + 1)).slice(-2);
                    var hari = ('0' + date.getDate()).slice(-2);
                    $('#jatuhTempoAkhir').val(tahun + '-' + bulanAngka + '-' + hari);
                }
            }

            // ===== FORMAT RUPIAH =====
            function formatRupiah(angka) {
                if (angka === undefined || angka === null || isNaN(angka)) return '0';
                return Math.round(angka).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            }

            // ===== EVENT LISTENERS =====
            $('#hargaUnit, #diskon, #uangMuka').on('input', function() {
                var sisa = hitungTenor();
                generateTabelAngsuran();
            });

            $('#jangkaTenor, #tanggalMulaiAngsuran').on('change', function() {
                generateTabelAngsuran();
            });

            // Update total harga display
            function updateDisplay() {
                var hargaUnit = parseFloat($('#hargaUnit').val()) || 0;
                var diskon = parseFloat($('#diskon').val()) || 0;
                var bookingFee = parseFloat($('#bookingFee').val()) || 0;

                $('#totalHargaDisplay').text('Rp ' + formatRupiah(hargaUnit));
                $('#diskonDisplay').text('- Rp ' + formatRupiah(diskon));
                $('#bookingFeeDisplay').text('Rp ' + formatRupiah(bookingFee));
            }

            $('#hargaUnit, #diskon').on('input', function() {
                updateDisplay();
            });

            // Initial calls
            updateDisplay();
            generateTabelAngsuran();
            hitungTenor();
        });
    </script>
    @endpush

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endsection
