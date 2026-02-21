@extends('layouts.partial.app')

@section('title', 'Pembelian Cash - Property Management App')

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
    </style>

    <div class="container-fluid p-3 p-md-4">
        <!-- Header -->
        <div class="pengajuan-row mb-3 mb-md-4">
            <div class="pengajuan-col-12">
                <div class="d-flex align-items-center gap-2 mb-2">
                    <h3 class="text-dark fw-bold" style="color: #2c2e3f; margin-bottom: 0;">
                        <i class="fas fa-coins cash-icon me-2" style="color: #9a55ff;"></i>
                        Form Pembelian Cash
                    </h3>
                    <span class="badge-cash">Pembayaran Tunai</span>
                </div>
                <p class="pengajuan-text-muted small" style="margin-bottom: 0;">
                    Lengkapi data pembelian cash untuk customer yang sudah booking unit
                </p>
            </div>
        </div>

        <!-- Info Status -->
        <div class="pengajuan-row mb-3">
            <div class="pengajuan-col-12">
                <div class="pengajuan-card pengajuan-bg-light border-0">
                    <div class="pengajuan-card-body py-3">
                        <div class="d-flex flex-column flex-sm-row align-items-start align-items-sm-center gap-2">
                            <div>
                                <span class="pengajuan-badge pengajuan-badge-primary">Pembelian Cash Baru</span>
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
            <span>Transaksi cash akan diproses setelah pembayaran lunas diterima oleh finance</span>
        </div>

        <!-- Form Pembelian Cash -->
        <div class="pengajuan-row">
            <div class="pengajuan-col-12 pengajuan-col-lg-8">
                <div class="pengajuan-card">
                    <div class="pengajuan-card-header d-flex align-items-center gap-2">
                        <i class="fas fa-file-invoice" style="color: #9a55ff; font-size: 1.2rem;"></i>
                        <h4 class="mb-0">Data Pembelian Cash</h4>
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
                                Detail Pembayaran Cash
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
                                        <select class="pengajuan-form-control">
                                            <option value="">-- Pilih Metode --</option>
                                            <option value="cash" selected>Cash (Tunai)</option>
                                            <option value="transfer">Transfer Bank</option>
                                            <option value="giro">Cek / Giro</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="pengajuan-row">
                                <div class="pengajuan-col-12 pengajuan-col-md-6">
                                    <div class="pengajuan-form-group">
                                        <label>Tanggal Jatuh Tempo</label>
                                        <input type="date" class="pengajuan-form-control" value="2026-03-21">
                                        <small class="pengajuan-text-muted">Batas waktu pembayaran cash (30 hari)</small>
                                    </div>
                                </div>

                                <div class="pengajuan-col-12 pengajuan-col-md-6">
                                    <div class="pengajuan-form-group">
                                        <label>Keterangan</label>
                                        <textarea class="pengajuan-form-control" rows="1" placeholder="Catatan tambahan">Pembayaran melalui bank transfer</textarea>
                                    </div>
                                </div>
                            </div>

                            <hr class="pengajuan-hr">

                            <!-- Upload Dokumen -->
                            <div class="pengajuan-section-title">
                                <i class="fas fa-file-upload me-2" style="color: #9a55ff;"></i>
                                Upload Dokumen Pendukung
                            </div>
                            <p class="pengajuan-text-muted small mb-3">Upload dokumen untuk verifikasi pembelian cash</p>

                            <div class="pengajuan-row">
                                @php
                                    $uploadFields = [
                                        'ktp' => 'KTP Customer',
                                        'npwp' => 'NPWP',
                                        'bukti_bayar' => 'Bukti Pembayaran',
                                        'surat_booking' => 'Surat Booking'
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

            <!-- Sidebar - Hanya Timeline -->
            <div class="pengajuan-col-12 pengajuan-col-lg-4">
                <!-- Timeline -->
                <div class="pengajuan-card">
                    <div class="pengajuan-card-header">
                        <i class="fas fa-history me-2" style="color: #9a55ff;"></i>
                        Timeline Pembayaran
                    </div>
                    <div class="pengajuan-card-body">
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
                        <div class="timeline-item">
                            <div class="timeline-icon">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div>
                                <h6 class="mb-1">Pelunasan Cash</h6>
                                <small class="pengajuan-text-muted">Belum dibayar</small>
                                <p class="mb-0 small">Rp 475.000.000</p>
                            </div>
                        </div>

                        <!-- Button Aksi di dalam sidebar -->
                        <hr class="pengajuan-hr mt-4">
                        <div class="d-grid gap-2 mt-3">
                            <button class="btn-primary-custom">
                                <i class="fas fa-save me-2"></i>
                                Proses Pembelian Cash
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

    {{-- Script untuk File Upload --}}
    @push('scripts')
    <script>
        // File upload modern preview
        document.addEventListener('DOMContentLoaded', function() {
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
        });
    </script>
    @endpush

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endsection
