@extends('layouts.partial.app')

@section('title', 'Pengajuan KPR - Property Management App')

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
        background: linear-gradient(135deg, #f0fff4, #e6f7e6);
        color: #2c2e3f;
        border-left-color: #28a745;
    }

    .alert-danger {
        background: linear-gradient(135deg, #fff0f0, #ffe6e6);
        color: #2c2e3f;
        border-left-color: #dc3545;
    }

    /* Custom responsive adjustments untuk file upload */
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

        .properti-file-upload-modern .properti-file-label-modern .properti-file-info-modern small {
            font-size: 0.6rem;
        }
    }

    /* Better touch targets for mobile */
    input, select, textarea, button {
        font-size: 16px !important;
    }
    </style>

    <div class="container-fluid p-3 p-md-4">
        <!-- Header -->
        <div class="pengajuan-row mb-3 mb-md-4">
            <div class="pengajuan-col-12">
                <h3 class="text-dark fw-bold" style="color: #2c2e3f; margin-bottom: 0.25rem;">Form Pengajuan KPR</h3>
                <p class="pengajuan-text-muted small" style="margin-bottom: 0;">Lengkapi data pengajuan KPR untuk customer
                    yang sudah booking unit</p>
            </div>
        </div>

        <!-- Info Status -->
        <div class="pengajuan-row mb-3">
            <div class="pengajuan-col-12">
                <div class="pengajuan-card pengajuan-bg-light border-0">
                    <div class="pengajuan-card-body py-3">
                        <div class="d-flex flex-column flex-sm-row align-items-start align-items-sm-center gap-2">
                            <div>
                                <span class="pengajuan-badge pengajuan-badge-primary">Pengajuan Baru</span>
                            </div>
                            <div class="pengajuan-text-muted small d-flex align-items-center">
                                <i class="mdi mdi-calendar me-1 pengajuan-text-primary"></i>
                                <span>Tanggal: 14 Februari 2026</span>
                            </div>
                            <div class="ms-sm-auto mt-2 mt-sm-0">
                                <span class="pengajuan-badge pengajuan-badge-warning">Status: Draft</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                <i class="fas fa-check-circle me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show">
                <i class="fas fa-exclamation-circle me-2"></i>
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle me-2"></i>
                {{ $errors->first() }}
            </div>
        @endif

        <!-- Form Pengajuan KPR -->
        <div class="pengajuan-row">
            <div class="pengajuan-col-12">
                <div class="pengajuan-card">
                    <div
                        class="pengajuan-card-header d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-2">
                        <h4 class="mb-0 d-flex align-items-center">
                            <i class="mdi mdi-bank me-2 pengajuan-text-primary"></i>
                            Data Pengajuan KPR
                        </h4>
                    </div>
                    <div class="pengajuan-card-body">
                        <form action="{{ route('pengajuan.store') }}" method="POST" enctype="multipart/form-data"
                            class="pengajuan-form-sample">
                            @csrf

                            <!-- Hidden dari Booking -->
                            <input type="hidden" name="customer_id" value="{{ $booking->customer->id ?? '' }}">
                            <input type="hidden" name="unit_id" value="{{ $booking->unit->id ?? '' }}">
                            <input type="hidden" name="booking_id" value="{{ $booking->id }}">

                            <!-- Alert Info -->
                            <div class="pengajuan-alert pengajuan-alert-info d-flex align-items-start gap-2 mb-4">
                                <i class="mdi mdi-information-outline mt-1 flex-shrink-0"></i>
                                <span>Pastikan data customer sudah lengkap di menu <strong>Tambah Customer</strong> sebelum
                                    mengajukan KPR.</span>
                            </div>

                            <!-- Customer & Unit -->
                            <div class="pengajuan-form-group">
                                <label>Customer *</label>
                                <input type="text" class="pengajuan-form-control"
                                    value="{{ $booking->customer->full_name ?? '-' }}" readonly>
                            </div>

                            <hr class="pengajuan-hr">

                            <div class="pengajuan-section-title">
                                <i class="mdi mdi-home-city"></i>Detail Unit yang Dibooking
                            </div>

                            <div class="pengajuan-row">
                                <div class="pengajuan-col-12 pengajuan-col-sm-6 pengajuan-col-md-3">
                                    <div class="pengajuan-form-group">
                                        <label>Type Unit</label>
                                        <input type="text" class="pengajuan-form-control"
                                            value="{{ $booking->unit->type ?? '-' }}" readonly>
                                    </div>
                                </div>
                                <div class="pengajuan-col-6 pengajuan-col-sm-6 pengajuan-col-md-2">
                                    <div class="pengajuan-form-group">
                                        <label>Blok/No</label>
                                        <input type="text" class="pengajuan-form-control"
                                            value="{{ $booking->unit->block ?? '-' }} / {{ $booking->unit->unit_code ?? '-' }}"
                                            readonly>
                                    </div>
                                </div>
                                <div class="pengajuan-col-6 pengajuan-col-sm-6 pengajuan-col-md-3">
                                    <div class="pengajuan-form-group">
                                        <label>Harga Unit</label>
                                        <input type="number" class="pengajuan-form-control" name="jumlah_pinjaman"
                                            id="jumlahPinjaman" value="{{ $booking->unit->price ?? 0 }}" readonly>
                                    </div>
                                </div>
                            </div>

                            <hr class="pengajuan-hr">

                            <div class="pengajuan-section-title">
                                <i class="mdi mdi-bank"></i>Data Pengajuan KPR
                            </div>

                            <div class="pengajuan-row">
                                <div class="pengajuan-col-12 pengajuan-col-md-6">
                                    <div class="pengajuan-form-group">
                                        <label>Bank Tujuan *</label>
                                        <select class="pengajuan-form-control" name="banks_id" required>
                                            <option value="">-- Pilih Bank --</option>
                                            @foreach ($banks as $bank)
                                                <option value="{{ $bank->id }}">{{ $bank->bank_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="pengajuan-col-12 pengajuan-col-md-6">
                                    <div class="pengajuan-form-group">
                                        <label>Produk KPR</label>
                                        <select class="pengajuan-form-control" name="produk_kpr">
                                            <option value="subsidi">KPR Subsidi</option>
                                            <option value="non_subsidi">KPR Non Subsidi</option>
                                            <option value="syariah">KPR Syariah</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="pengajuan-row">
                                <!-- Harga Unit -->
                                <div class="pengajuan-col-12 pengajuan-col-sm-6 pengajuan-col-md-4">
                                    <div class="pengajuan-form-group">
                                        <label>Harga Unit</label>
                                        <div class="pengajuan-input-group">
                                            <span class="pengajuan-input-group-text">Rp</span>
                                            <input type="number" class="pengajuan-form-control" id="hargaUnit"
                                                value="{{ $booking->unit->price ?? 0 }}" readonly>
                                        </div>
                                    </div>
                                </div>

                                <!-- DP -->
                                <div class="pengajuan-col-12 pengajuan-col-sm-6 pengajuan-col-md-4">
                                    <div class="pengajuan-form-group">
                                        <label>DP *</label>
                                        <div class="pengajuan-input-group">
                                            <span class="pengajuan-input-group-text">Rp</span>
                                            <input type="number" class="pengajuan-form-control" name="dp"
                                                id="dp" required value="{{ $booking->booking_fee ?? 0 }}">
                                        </div>
                                    </div>
                                </div>

                                <!-- Tenor -->
                                <div class="pengajuan-col-12 pengajuan-col-sm-6 pengajuan-col-md-4">
                                    <div class="pengajuan-form-group">
                                        <label>Tenor *</label>
                                        <select class="pengajuan-form-control" name="tenor" id="tenor" required>
                                            <option value="">-- Pilih --</option>
                                            <option value="5">5 Tahun</option>
                                            <option value="10">10 Tahun</option>
                                            <option value="15">15 Tahun</option>
                                            <option value="20">20 Tahun</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Bunga -->
                                <div class="pengajuan-col-12 pengajuan-col-sm-6 pengajuan-col-md-4 mt-3">
                                    <div class="pengajuan-form-group">
                                        <label>Bunga (%) *</label>
                                        <input type="number" class="pengajuan-form-control" name="bunga"
                                            step="0.1" id="bunga" required>
                                    </div>
                                </div>

                                <!-- Jumlah Pinjaman (readonly, otomatis) -->
                                <div class="pengajuan-col-12 pengajuan-col-sm-6 pengajuan-col-md-4 mt-3">
                                    <div class="pengajuan-form-group">
                                        <label>Jumlah Pinjaman</label>
                                        <div class="pengajuan-input-group">
                                            <span class="pengajuan-input-group-text">Rp</span>
                                            <input type="number" class="pengajuan-form-control" name="jumlah_pinjaman"
                                                id="jumlahPinjaman"
                                                value="{{ ($booking->unit->price ?? 0) - ($booking->booking_fee ?? 0) }}"
                                                readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="pengajuan-row">
                                <div class="pengajuan-col-12 pengajuan-col-sm-6 pengajuan-col-md-4">
                                    <div class="pengajuan-form-group">
                                        <label>Estimasi Angsuran</label>
                                        <input type="number" class="pengajuan-form-control" name="estimasi_angsuran"
                                            id="angsuran">
                                    </div>
                                </div>

                                <div class="pengajuan-col-12 pengajuan-col-sm-6 pengajuan-col-md-4">
                                    <div class="pengajuan-form-group">
                                        <label>Status Pekerjaan</label>
                                        <input type="text" class="pengajuan-form-control" name="status_pekerjaan"
                                            value="{{ ($booking->customer->job_status ?? '') === 'Lainnya'
                                                ? $booking->customer->job_status_lainnya ?? ''
                                                : $booking->customer->job_status ?? '' }}">
                                    </div>
                                </div>
                            </div>

                            <hr class="pengajuan-hr">

                            <div class="pengajuan-section-title">
                                <i class="mdi mdi-file-document"></i>Upload Dokumen Pendukung
                            </div>
                            <p class="pengajuan-text-muted small mb-3">Dokumen tambahan untuk pengajuan KPR</p>

                            <div class="pengajuan-row">
                                @php
                                    $uploadFields = [
                                        'slip_gaji' => 'Slip Gaji',
                                        'rekening_koran' => 'Rekening Koran',
                                        'npwp' => 'NPWP',
                                        'sku' => 'SKU',
                                        'surat_nikah' => 'Surat Nikah',
                                        'ktp_pasangan' => 'KTP Pasangan'
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

                            <div class="d-flex flex-column flex-sm-row justify-content-between gap-3 mt-4">
                                <a href="{{ url('/marketing/kpr') }}"
                                    class="pengajuan-btn pengajuan-btn-outline-secondary">Kembali</a>
                                <button type="submit" class="pengajuan-btn pengajuan-btn-primary">Ajukan KPR</button>
                            </div>
                        </form>

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
                        // Reset ke teks awal
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

        // Auto hide alert
        document.addEventListener("DOMContentLoaded", function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                setTimeout(() => {
                    alert.style.transition = "opacity 0.5s ease";
                    alert.style.opacity = "0";
                    setTimeout(() => alert.remove(), 500);
                }, 3000);
            });
        });

        // Hitung angsuran
        document.addEventListener('DOMContentLoaded', function() {
            const hargaUnitInput = {{ $booking->unit->price ?? 0 }};
            const dpInput = document.querySelector('#dp');
            const bungaInput = document.querySelector('#bunga');
            const tenorSelect = document.querySelector('#tenor');
            const angsuranInput = document.querySelector('#angsuran');
            const jumlahPinjamanInput = document.querySelector('#jumlahPinjaman');

            function hitungPinjaman() {
                const dp = parseFloat(dpInput.value) || 0;
                const jumlahPinjaman = Math.max(hargaUnitInput - dp, 0);
                jumlahPinjamanInput.value = jumlahPinjaman;
                return jumlahPinjaman;
            }

            function hitungAngsuran() {
                const jumlahPinjaman = hitungPinjaman();
                const bunga = parseFloat(bungaInput.value) || 0;
                const tenor = parseInt(tenorSelect.value) || 0;

                if (jumlahPinjaman > 0 && bunga >= 0 && tenor > 0) {
                    const bungaTotal = jumlahPinjaman * (bunga / 100);
                    const totalPinjaman = jumlahPinjaman + bungaTotal;
                    const angsuran = totalPinjaman / (tenor * 12);
                    angsuranInput.value = Math.round(angsuran);
                } else {
                    angsuranInput.value = '';
                }
            }

            dpInput.addEventListener('input', hitungAngsuran);
            bungaInput.addEventListener('input', hitungAngsuran);
            tenorSelect.addEventListener('change', hitungAngsuran);

            hitungPinjaman();
        });
    </script>

    @endpush

    {{-- Font Awesome untuk icon --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">


@endsection
