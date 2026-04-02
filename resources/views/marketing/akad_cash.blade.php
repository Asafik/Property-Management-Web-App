@extends('layouts.partial.app')

@section('title', 'Konfirmasi Akad Cash - Properti Management')

@section('content')
    <style>
        /* ============================================
           CSS LOKAL (Spesifik Halaman Akad Cash)
           ============================================ */

        /* Override jumlah step menjadi 7 kolom (Global default 4) */
        .transaksi-steps {
            grid-template-columns: repeat(7, 1fr);
        }
        @media (max-width: 767.98px) {
            .transaksi-steps {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        /* Custom Icon Arrow pada Select */
        select.transaksi-form-control {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%239a55ff' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 0.95rem center;
            background-size: 14px;
        }

        /* Custom Input Group (untuk Prefix Rp) */
        .transaksi-input-group {
            display: flex;
            align-items: stretch;
        }
        .transaksi-input-group-prepend {
            display: flex;
            margin-right: -1px;
        }
        .transaksi-input-group-text {
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--gray-50);
            border: 1px solid var(--gray-300);
            border-radius: var(--radius-lg) 0 0 var(--radius-lg);
            padding: 0.85rem 0.95rem;
            font-size: 0.9rem;
            color: var(--primary);
            font-weight: 600;
        }
        .transaksi-input-group .transaksi-form-control {
            border-radius: 0 var(--radius-lg) var(--radius-lg) 0;
            z-index: 0;
        }

        /* State Interaktif untuk File Upload ketika sudah ada file */
        .transaksi-file-upload.has-file .transaksi-file-label {
            border-color: var(--success);
            background: linear-gradient(135deg, #f0fff4, #ffffff);
            transition: all 0.3s ease;
        }
        .transaksi-file-upload.has-file:hover .transaksi-file-label {
            border-color: #218838;
            background: var(--success) !important;
            box-shadow: 0 5px 15px rgba(40, 167, 69, 0.25);
            transform: translateY(-2px);
        }
        .transaksi-file-upload.has-file:hover .transaksi-file-label i,
        .transaksi-file-upload.has-file:hover .transaksi-file-label .transaksi-file-info span,
        .transaksi-file-upload.has-file:hover .transaksi-file-label .transaksi-file-info small {
            color: #ffffff !important;
        }
        .transaksi-file-upload.has-file:hover .transaksi-file-label i {
            background: rgba(255, 255, 255, 0.2);
        }
        .transaksi-file-upload.has-file .transaksi-file-label i {
            color: var(--success);
            background: rgba(40, 167, 69, 0.1);
        }

        /* Custom style untuk step yang off/default */
        .transaksi-page .transaksi-steps .transaksi-step:not(.completed):not(.active) .transaksi-step-icon {
            background: #e5e7eb !important;
            color: #6b7280 !important;
            border: 2px solid #d1d5db !important;
            box-shadow: none !important;
        }
        .transaksi-page .transaksi-steps .transaksi-step:not(.completed):not(.active) .transaksi-step-icon i {
            color: #6b7280 !important;
        }
        .transaksi-page .transaksi-steps .transaksi-step:not(.completed):not(.active) .transaksi-step-title {
            color: #6b7280 !important;
        }
        .transaksi-page .transaksi-steps .transaksi-step:not(.completed):not(.active) small {
            color: #9ca3af !important;
        }

        /* Override global CSS untuk default step */
        .transaksi-page .transaksi-steps .transaksi-step .transaksi-step-icon {
            background: #e5e7eb !important;
            color: #6b7280 !important;
            border: 2px solid #d1d5db !important;
        }
        .transaksi-page .transaksi-steps .transaksi-step .transaksi-step-icon i {
            color: #6b7280 !important;
        }

        /* Override untuk active dan completed */
        .transaksi-page .transaksi-steps .transaksi-step.active .transaksi-step-icon {
            background: var(--warning) !important;
            color: var(--white) !important;
            border: none !important;
            box-shadow: 0 0 0 3px rgba(255, 193, 7, 0.2) !important;
        }
        .transaksi-page .transaksi-steps .transaksi-step.active .transaksi-step-icon i {
            color: var(--white) !important;
        }
        .transaksi-page .transaksi-steps .transaksi-step.completed .transaksi-step-icon {
            background: var(--success) !important;
            color: var(--white) !important;
            border: none !important;
        }
        .transaksi-page .transaksi-steps .transaksi-step.completed .transaksi-step-icon i {
            color: var(--white) !important;
        }
    </style>

    <div class="transaksi-page">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="customer-header d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between gap-3">
                            <div class="d-flex align-items-center gap-3">
                                <div class="customer-avatar">
                                    {{ strtoupper(substr($booking->customer->full_name ?? 'C', 0, 1)) }}
                                </div>
                                <div>
                                    <h4 class="customer-name mb-1 d-flex align-items-center gap-2">
                                        {{ $booking->customer->full_name ?? '-' }}
                                        @php
                                            $jenis = strtolower($booking->unit->jenis ?? '');
                                            $badgeClass = $jenis == 'subsidi' ? 'badge-gradient-success' : ($jenis == 'komersil' ? 'badge-gradient-primary' : 'badge-gradient-secondary');
                                            $icon = $jenis == 'subsidi' ? 'mdi-home-assistant' : ($jenis == 'komersil' ? 'mdi-office-building' : 'mdi-help-circle-outline');
                                        @endphp
                                        <span class="badge {{ $badgeClass }}">
                                            <i class="mdi {{ $icon }} me-1"></i>
                                            {{ strtoupper($booking->unit->jenis ?? '-') }}
                                        </span>
                                    </h4>
                                    <p class="customer-booking mb-0">Booking ID: {{ $booking->booking_code ?? '-' }}</p>
                                </div>
                            </div>

                            <div class="customer-unit-info">
                                <div class="info-item">
                                    <small>Nama - Unit</small>
                                    <span>{{ $booking->unit->unit_name ?? $booking->unit->landBank->name ?? '-' }} - {{ $booking->unit->unit_code ?? '-' }}</span>
                                </div>
                                <div class="info-item">
                                    <small>Tipe</small>
                                    <span>{{ $booking->unit->type ?? '-' }}</span>
                                </div>
                                <div class="info-item">
                                    <small>Harga Unit</small>
                                    <span class="text-primary fw-bold">Rp {{ number_format($booking->unit->price ?? 0, 0, ',', '.') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-12 col-lg-8 mb-4 mb-lg-0">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="transaksi-section-title">
                            <i class="mdi mdi-timeline-text"></i>
                            <span>Tahapan Akad Cash</span>
                        </div>

                        @php
                            $steps = [
                                'booking' => 'Booking',
                                'cash' => 'Pelunasan',
                                'legal' => 'Persiapan Legal',
                                'spk' => 'SPK',
                                'construction' => 'Pembangunan',
                                'akad' => 'Akad',
                                'completed' => 'Serah Terima',
                            ];
                            $isBookingDone = !empty($booking->booking_date);
                            $isCashDone = strtolower($booking->status_cash ?? '') == 'done' || in_array(strtolower($booking->purchase_type), ['cash', 'cash_tempo']);
                            $isLegalDone = strtolower($booking->status_legal ?? '') == 'done';
                            $isSpkDone = strtolower($booking->status_spk ?? '') == 'done';
                            $construction = strtolower($booking->unit->construction_progress ?? '');
                            $isBuildDone = $construction == 'selesai';
                            $isAkadDone = $booking->status_akad == 'done';
                            $isCompleted = $booking->status == 'completed';

                            $completedCount = 0;
                            if ($isBookingDone) $completedCount++;
                            if ($isCashDone) $completedCount++;
                            if ($isLegalDone) $completedCount++;
                            // SPK tidak dihitung karena masih off
                            if ($isBuildDone) $completedCount++;
                            // Akad sedang aktif, jadi tidak dihitung sebagai completed

                            $progressPercent = ($completedCount / 7) * 100;
                        @endphp

                        <div class="transaksi-progress-top">
                            <span class="transaksi-muted">Progress Akad</span>
                            <span>4 dari 7 tahap selesai</span>
                        </div>

                        <div class="transaksi-progress">
                            <div class="transaksi-progress-bar" style="width: {{ $progressPercent }}%;"></div>
                        </div>

                        <div class="transaksi-steps">
                            @foreach ($steps as $key => $label)
                                @php
                                    $isStepCompleted = false;
                                    $isStepActive = false;
                                    if ($key == 'booking') {
                                        $isStepCompleted = $isBookingDone;
                                        $isStepActive = !$isBookingDone;
                                    }
                                    if ($key == 'cash') {
                                        $isStepCompleted = $isCashDone;
                                        $isStepActive = $isBookingDone && !$isCashDone;
                                    }
                                    if ($key == 'legal') {
                                        $isStepCompleted = $isLegalDone;
                                        $isStepActive = $isCashDone && !$isLegalDone;
                                    }
                                    if ($key == 'spk') {
                                        $isStepCompleted = false; // SPK tetap off
                                        $isStepActive = false; // SPK tidak aktif
                                    }
                                    if ($key == 'construction') {
                                        if ($construction == 'selesai') {
                                            $isStepCompleted = true;
                                        } elseif ($construction == 'proses') {
                                            $isStepActive = true;
                                        }
                                    }
                                    if ($key == 'akad') {
                                        if ($isAkadDone) {
                                            $isStepCompleted = true;
                                        } else {
                                            $isStepActive = true; // Akad sedang aktif
                                        }
                                    }
                                    if ($key == 'completed') {
                                        $isStepCompleted = $isCompleted;
                                    }
                                @endphp

                                <div class="transaksi-step {{ $isStepCompleted ? 'completed' : ($isStepActive ? 'active' : '') }}">
                                    <div class="transaksi-step-icon">
                                        @if ($isStepCompleted)
                                            <i class="mdi mdi-check"></i>
                                        @else
                                            @if ($key == 'booking')
                                                <i class="mdi mdi-book-open-page-variant"></i>
                                            @elseif($key == 'cash')
                                                <i class="mdi mdi-cash"></i>
                                            @elseif($key == 'legal')
                                                <i class="mdi mdi-file-document-outline"></i>
                                            @elseif($key == 'spk')
                                                <i class="mdi mdi-clipboard-text"></i>
                                            @elseif($key == 'construction')
                                                <i class="mdi mdi-home-city-outline"></i>
                                            @elseif($key == 'akad')
                                                <i class="mdi mdi-handshake"></i>
                                            @else
                                                <i class="mdi mdi-key"></i>
                                            @endif
                                        @endif
                                    </div>
                                    <span class="transaksi-step-title">{{ $label }}</span>
                                    <small>
                                        @if ($key == 'booking' && $booking->booking_date)
                                            {{ \Carbon\Carbon::parse($booking->booking_date)->translatedFormat('j F Y') }}
                                        @elseif($isStepCompleted || $isStepActive)
                                            {{ $booking->updated_at->translatedFormat('j F Y') }}
                                        @else
                                            Menunggu
                                        @endif
                                    </small>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="transaksi-section-title">
                            <i class="mdi mdi-cash-multiple"></i>
                            <span>Detail Pembayaran</span>
                        </div>

                        <div class="transaksi-detail-list">
                            @php
                                $hargaUnit = $booking->unit->price ?? 0;
                                $hargaNego = (!empty($booking->harga_nego) && $booking->harga_nego > 0) ? $booking->harga_nego : $hargaUnit;
                                $diskon = max(0, $hargaUnit - $hargaNego);
                                $bookingFee = $booking->booking_fee ?? 0;
                                $sisaPembayaran = max(0, $hargaNego - $bookingFee);
                            @endphp
                            <div class="transaksi-detail-item">
                                <span>Harga Unit</span>
                                <span>Rp {{ number_format($hargaUnit, 0, ',', '.') }}</span>
                            </div>
                            @if(strtolower($booking->purchase_type) != 'cash_tempo')
                            <div class="transaksi-detail-item">
                                <span>Diskon / Negosiasi</span>
                                <span class="highlight">- Rp {{ number_format($diskon, 0, ',', '.') }}</span>
                            </div>
                            @endif
                            <div class="transaksi-detail-item">
                                <span>Harga Final</span>
                                <span class="highlight">Rp {{ number_format($hargaNego, 0, ',', '.') }}</span>
                            </div>
                            <div class="transaksi-detail-item">
                                <span>Booking Fee</span>
                                <span>Rp {{ number_format($bookingFee, 0, ',', '.') }}</span>
                            </div>
                            <div class="transaksi-detail-item">
                                <span>Sisa Pembayaran</span>
                                <span class="highlight">Rp {{ number_format($sisaPembayaran, 0, ',', '.') }}</span>
                            </div>
                            <div class="transaksi-detail-item mt-2 align-items-center">
                                <span>Status Pembayaran</span>
                                <div class="ms-auto text-end" style="flex: 1;">
                                    <span class="badge bg-success text-white">
                                        <i class="mdi mdi-check-circle-outline me-1"></i>Lunas
                                    </span>
                                </div>
                            </div>
                            <div class="transaksi-detail-item mt-2 align-items-center">
                                <span>Metode Pembayaran</span>
                                <div class="ms-auto text-end" style="flex: 1;">
                                    <span class="badge bg-success text-white">
                                        <i class="mdi mdi-cash me-1"></i>{{ $booking->purchase_type == 'cash' ? 'Cash Keras' : ($booking->purchase_type == 'cash_tempo' ? 'Cash Tempo' : 'Cash') }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">

                        <div class="transaksi-sidebar-section">
                            <div class="transaksi-sidebar-title mb-2" style="font-size: 0.86rem; font-weight: 700; color: #4b5565;">Ditangani oleh</div>
                            <div class="transaksi-handler">
                                <div class="transaksi-handler-icon">
                                    <i class="mdi mdi-account-tie"></i>
                                </div>
                                <div>
                                    <div class="fw-bold">{{ $booking->sales->name ?? 'Marketing' }}</div>
                                    <!-- <small class="transaksi-muted">{{ $booking->sales->role ?? 'Marketing Staff' }}</small> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-12 col-lg-8 mb-4 mb-lg-0">
                <div class="card">
                    <div class="card-body">
                        <div class="transaksi-section-title">
                            <i class="mdi mdi-handshake"></i>
                            <span>Konfirmasi Akad Cash</span>
                        </div>

                        <div class="transaksi-inline-alert info mb-4">
                            <i class="mdi mdi-information-outline"></i>
                            <div>Pilih salah satu keputusan di bawah ini. Form akan menyesuaikan secara otomatis sesuai status akad.</div>
                        </div>

                        <div class="transaksi-inline-alert danger transaksi-error-box" id="akadErrorBox">
                            <i class="mdi mdi-alert-circle-outline"></i>
                            <div>Silakan pilih status akad terlebih dahulu sebelum submit.</div>
                        </div>

                        <form action="{{ route('akad.cash.store', $booking->id) }}" method="POST" enctype="multipart/form-data" id="formAkadCash">
                            @csrf
                            <input type="hidden" name="status_akad" id="statusAkadInput" value="">

                            <div class="row g-3 mb-3">
                                <div class="col-12 col-md-6">
                                    <div class="transaksi-decision-card approve">
                                        <input type="radio" name="decision_choice" id="decisionSelesai" value="selesai">
                                        <label for="decisionSelesai" class="transaksi-decision-label">
                                            <div class="transaksi-decision-icon">
                                                <i class="mdi mdi-check-bold"></i>
                                            </div>
                                            <div class="transaksi-decision-content">
                                                <div class="transaksi-decision-title">Akad Selesai</div>
                                                <p class="transaksi-decision-desc mb-0">Proses akad telah selesai dan siap lanjut ke serah terima unit.</p>
                                            </div>
                                            <div class="transaksi-decision-check">
                                                <i class="mdi mdi-check-circle"></i>
                                            </div>
                                        </label>
                                    </div>
                                </div>

                                <div class="col-12 col-md-6">
                                    <div class="transaksi-decision-card reject">
                                        <input type="radio" name="decision_choice" id="decisionBatal" value="batal">
                                        <label for="decisionBatal" class="transaksi-decision-label">
                                            <div class="transaksi-decision-icon">
                                                <i class="mdi mdi-close-thick"></i>
                                            </div>
                                            <div class="transaksi-decision-content">
                                                <div class="transaksi-decision-title">Akad Batal</div>
                                                <p class="transaksi-decision-desc mb-0">Proses akad dibatalkan dan perlu tindakan lanjutan.</p>
                                            </div>
                                            <div class="transaksi-decision-check">
                                                <i class="mdi mdi-check-circle"></i>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div id="formSelesai" class="transaksi-form-shell approve">
                                <div class="transaksi-form-title approve">Form Akad Selesai</div>

                                <div class="transaksi-inline-alert success">
                                    <i class="mdi mdi-check-circle-outline"></i>
                                    <div><strong>Akad disetujui.</strong> Pengajuan akan diarahkan ke tahap <strong>Serah Terima</strong>.</div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="transaksi-form-group">
                                            <label class="transaksi-form-label">No. Akad</label>
                                            <input type="text" name="no_akad" class="transaksi-form-control"
                                                value="AKAD/CASH/{{ date('Y') }}/{{ str_pad($booking->id, 4, '0', STR_PAD_LEFT) }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="transaksi-form-group">
                                            <label class="transaksi-form-label">Tanggal Akad</label>
                                            <input type="date" name="tanggal_akad" class="transaksi-form-control"
                                                value="{{ date('Y-m-d') }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="transaksi-form-group">
                                            <label class="transaksi-form-label">Total Pembayaran</label>
                                            <div class="transaksi-input-group">
                                                <div class="transaksi-input-group-prepend">
                                                    <span class="transaksi-input-group-text">Rp</span>
                                                </div>
                                                <input type="text" class="transaksi-form-control"
                                                    value="{{ number_format($sisaPembayaran, 0, ',', '.') }}"
                                                    readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="transaksi-form-group">
                                            <label class="transaksi-form-label">Status Pembayaran</label>
                                            <select name="status_pembayaran" class="transaksi-form-control">
                                                <option value="lunas" selected>Lunas</option>
                                                <option value="bertahap">Bertahap (Belum Lunas)</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="transaksi-form-group">
                                    <label class="transaksi-form-label">Upload Dokumen Akad</label>
                                    <div class="transaksi-file-upload">
                                        <input type="file" name="dokumen" id="uploadDokumenSelesai" accept=".jpg,.jpeg,.png,.pdf">
                                        <div class="transaksi-file-label">
                                            <i class="mdi mdi-cloud-upload"></i>
                                            <div class="transaksi-file-info">
                                                <span>Upload Dokumen Akad</span>
                                                <small>Format: JPG, PNG, PDF (Max 5MB)</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="transaksi-form-group">
                                    <label class="transaksi-form-label">Catatan Akad</label>
                                    <textarea name="catatan" class="transaksi-form-control" rows="3" placeholder="Contoh: Proses akad berjalan lancar, seluruh dokumen telah ditandatangani."></textarea>
                                </div>
                            </div>

                            <div id="formBatal" class="transaksi-form-shell reject">
                                <div class="transaksi-form-title reject">Form Pembatalan Akad</div>

                                <div class="transaksi-inline-alert danger">
                                    <i class="mdi mdi-close-circle-outline"></i>
                                    <div><strong>Akad dibatalkan.</strong> Pilih alasan dan tindakan lanjutan.</div>
                                </div>

                                <div class="transaksi-form-group">
                                    <label class="transaksi-form-label">Alasan Pembatalan</label>
                                    <select name="alasan_batal" id="alasanBatalSelect" class="transaksi-form-control">
                                        <option value="">-- Pilih Alasan --</option>
                                        <option value="customer batal">Customer Batal Beli</option>
                                        <option value="dana tidak cukup">Dana Tidak Cukup</option>
                                        <option value="masalah dokumen">Masalah Dokumen</option>
                                        <option value="mengundurkan diri">Customer Mengundurkan Diri</option>
                                        <option value="Lainnya">Lainnya</option>
                                    </select>
                                </div>

                                <div class="transaksi-form-group" id="alasanLainnyaGroup" style="display: none;">
                                    <label class="transaksi-form-label">Tulis Alasan Lainnya</label>
                                    <input type="text" name="alasan_lainnya" class="transaksi-form-control" placeholder="Contoh: Masalah internal perusahaan">
                                </div>

                                <div class="transaksi-form-group">
                                    <label class="transaksi-form-label">Catatan Pembatalan</label>
                                    <textarea name="catatan" class="transaksi-form-control" rows="3" placeholder="Detail pembatalan..."></textarea>
                                </div>

                                <hr class="my-4">

                                <label class="transaksi-form-label">Tindakan Selanjutnya</label>
                                <div class="transaksi-next-step-grid">
                                    <div class="transaksi-next-card">
                                        <input type="radio" name="tindakan" id="tindakanRefund" value="refund" checked>
                                        <label class="transaksi-next-label" for="tindakanRefund">
                                            <div class="transaksi-next-icon">
                                                <i class="mdi mdi-cash-refund"></i>
                                            </div>
                                            <div class="transaksi-next-content">
                                                <span class="transaksi-next-title">Refund DP</span>
                                                <span class="transaksi-next-desc">Kembalikan uang muka sesuai ketentuan</span>
                                            </div>
                                            <div class="transaksi-next-check">
                                                <i class="mdi mdi-check-circle"></i>
                                            </div>
                                        </label>
                                    </div>

                                    <div class="transaksi-next-card">
                                        <input type="radio" name="tindakan" id="tindakanHangus" value="hangus">
                                        <label class="transaksi-next-label" for="tindakanHangus">
                                            <div class="transaksi-next-icon">
                                                <i class="mdi mdi-cancel"></i>
                                            </div>
                                            <div class="transaksi-next-content">
                                                <span class="transaksi-next-title">DP Hangus</span>
                                                <span class="transaksi-next-desc">Sesuai perjanjian yang telah disepakati</span>
                                            </div>
                                            <div class="transaksi-next-check">
                                                <i class="mdi mdi-check-circle"></i>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="transaksi-action-bar">
                                <a href="{{ url('/marketing/booking') }}" class="transaksi-btn transaksi-btn-secondary">
                                    <i class="mdi mdi-arrow-left"></i>
                                    Kembali
                                </a>

                                <button type="submit" class="transaksi-btn transaksi-btn-primary">
                                    <i class="mdi mdi-content-save-outline"></i>
                                    Simpan Konfirmasi
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-4">
                <div class="transaksi-sticky">
                    <div class="card">
                        <div class="card-body">
                            <div class="transaksi-section-title">
                                <i class="mdi mdi-lightbulb-on-outline"></i>
                                <span>Informasi & Panduan</span>
                            </div>

                            <div class="transaksi-sidebar-section">
                                <div class="transaksi-sidebar-title">Status Akad Saat Ini</div>
                                @if($booking->status_akad == 'done')
                                    <div class="transaksi-status-banner success">
                                        <i class="mdi mdi-check-circle-outline"></i>
                                        Akad telah selesai
                                    </div>
                                    @if($booking->status != 'completed')
                                        <div class="mt-3">
                                            <a href="{{ route('booking.serah-terima', $booking->id) }}" class="transaksi-btn transaksi-btn-primary w-100">
                                                <i class="mdi mdi-key me-1"></i> Lanjut Serah Terima Unit
                                            </a>
                                        </div>
                                    @endif
                                @elseif($booking->status_akad == 'cancelled')
                                    <div class="transaksi-status-banner warning">
                                        <i class="mdi mdi-close-circle-outline"></i>
                                        Akad dibatalkan
                                    </div>
                                @else
                                    <div class="transaksi-status-banner warning">
                                        <i class="mdi mdi-progress-clock"></i>
                                        Menunggu konfirmasi akad
                                    </div>
                                @endif
                            </div>

                            <hr class="my-4">

                            <div class="transaksi-sidebar-section">
                                <div class="transaksi-sidebar-title">Panduan Konfirmasi</div>
                                <ul class="transaksi-mini-list">
                                    <li>
                                        <i class="mdi mdi-check-circle-outline"></i>
                                        <span>Pastikan seluruh dokumen akad telah ditandatangani</span>
                                    </li>
                                    <li>
                                        <i class="mdi mdi-check-circle-outline"></i>
                                        <span>Verifikasi kelengkapan pembayaran sebelum konfirmasi</span>
                                    </li>
                                    <li>
                                        <i class="mdi mdi-check-circle-outline"></i>
                                        <span>Upload dokumen akad sebagai arsip digital</span>
                                    </li>
                                    <li>
                                        <i class="mdi mdi-check-circle-outline"></i>
                                        <span>Isi catatan untuk dokumentasi proses</span>
                                    </li>
                                </ul>
                            </div>

                            <div class="transaksi-sidebar-section">
                                <div class="transaksi-sidebar-title">Checklist Akad</div>
                                <ul class="transaksi-mini-list mb-0">
                                    <li>
                                        <i class="mdi mdi-file-document-outline"></i>
                                        <span>Akta Jual Beli (AJB) ditandatangani</span>
                                    </li>
                                    <li>
                                        <i class="mdi mdi-cash-multiple"></i>
                                        <span>Bukti pelunasan pembayaran</span>
                                    </li>
                                    <li>
                                        <i class="mdi mdi-account-check"></i>
                                        <span>Identitas customer lengkap</span>
                                    </li>
                                    <li>
                                        <i class="mdi mdi-handshake"></i>
                                        <span>Berita acara serah terima dokumen</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            const $decisionSelesai = $('#decisionSelesai');
            const $decisionBatal = $('#decisionBatal');
            const $statusInput = $('#statusAkadInput');
            const $formSelesai = $('#formSelesai');
            const $formBatal = $('#formBatal');
            const $errorBox = $('#akadErrorBox');

            function switchDecision(type) {
                $errorBox.hide();

                if (type === 'selesai') {
                    $statusInput.val('selesai');
                    $formSelesai.stop(true, true).slideDown(180);
                    $formBatal.stop(true, true).slideUp(180);
                } else if (type === 'batal') {
                    $statusInput.val('batal');
                    $formBatal.stop(true, true).slideDown(180);
                    $formSelesai.stop(true, true).slideUp(180);
                }
            }

            $decisionSelesai.on('change', function() {
                if ($(this).is(':checked')) {
                    switchDecision('selesai');
                }
            });

            $decisionBatal.on('change', function() {
                if ($(this).is(':checked')) {
                    switchDecision('batal');
                }
            });

            // Alasan lainnya handler
            $('#alasanBatalSelect').on('change', function() {
                const $alasanLainnya = $('#alasanLainnyaGroup');
                if ($(this).val() === 'Lainnya') {
                    $alasanLainnya.slideDown(180);
                } else {
                    $alasanLainnya.slideUp(180);
                }
            });

            // File upload handler
            $('#uploadDokumenSelesai').on('change', function(e) {
                const file = e.target.files[0];
                const $container = $(this).closest('.transaksi-file-upload');

                if (file) {
                    $container.addClass('has-file');
                    const sizeInMB = (file.size / (1024 * 1024)).toFixed(2);
                    $container.find('.transaksi-file-info span').text(file.name.length > 40 ? file.name.substring(0, 40) + '...' : file.name);
                    $container.find('.transaksi-file-info small').text(sizeInMB + ' MB | Format: ' + file.type.split('/').pop().toUpperCase());
                } else {
                    $container.removeClass('has-file');
                    $container.find('.transaksi-file-info span').text('Upload Dokumen Akad');
                    $container.find('.transaksi-file-info small').text('Format: JPG, PNG, PDF (Max 5MB)');
                }
            });

            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: '{{ session('success') }}',
                    confirmButtonColor: '#9a55ff'
                });
            @endif

            @if (session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Terjadi Kesalahan',
                    text: '{{ session('error') }}',
                    confirmButtonColor: '#9a55ff'
                });
            @endif
        });

        $('#formAkadCash').on('submit', function(e) {
            const status = $('#statusAkadInput').val();

            if (!status) {
                e.preventDefault();
                $('#akadErrorBox').stop(true, true).slideDown(160);
                $('html, body').animate({
                    scrollTop: $('#akadErrorBox').offset().top - 120
                }, 300);
                return false;
            }

            if (status === 'selesai') {
                const tanggal = $('input[name="tanggal_akad"]').val();
                if (!tanggal) {
                    e.preventDefault();
                    Swal.fire({
                        icon: 'warning',
                        title: 'Tanggal Akad Harus Diisi',
                        text: 'Silakan isi tanggal pelaksanaan akad',
                        confirmButtonColor: '#9a55ff'
                    });
                    return false;
                }
            }

            if (status === 'batal') {
                const alasan = $('select[name="alasan_batal"]').val();
                if (!alasan) {
                    e.preventDefault();
                    Swal.fire({
                        icon: 'warning',
                        title: 'Alasan Pembatalan Harus Dipilih',
                        text: 'Silakan pilih alasan pembatalan akad',
                        confirmButtonColor: '#9a55ff'
                    });
                    return false;
                }
            }

            e.preventDefault();

            Swal.fire({
                title: 'Simpan Konfirmasi Akad?',
                text: "Pastikan semua data dan dokumen sudah lengkap.",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#9a55ff',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Simpan',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Menyimpan...',
                        text: 'Mohon tunggu sebentar',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                            e.target.submit();
                        }
                    });
                }
            });
        });
    </script>
@endpush
