@extends('layouts.partial.app')

@section('title', 'Konfirmasi Persetujuan KPR - Properti Management')

@section('content')
    <style>
        /* ============================================
           CSS LOKAL (Spesifik Halaman KPR)
           ============================================ */

        /* Progress Bar Khusus Halaman Akad */
        .akad-progress {
            height: 12px;
            background: #e9ecef;
            border-radius: 999px;
            overflow: hidden;
            margin-bottom: 1.25rem;
        }

        .akad-progress-bar {
            height: 100%;
            border-radius: 999px;
            background: linear-gradient(90deg, #c784ff, #9a55ff);
            transition: width 0.3s ease;
            max-width: 50%;
        }

        /* Override jumlah step menjadi 5 kolom (Global default 4) */
        .transaksi-steps.steps-5 {
            grid-template-columns: repeat(5, 1fr);
        }
        /* Override jumlah step menjadi 6 kolom untuk unit komersil */
        .transaksi-steps.steps-6 {
            grid-template-columns: repeat(6, 1fr);
        }
        @media (max-width: 767.98px) {
            .transaksi-steps.steps-5,
            .transaksi-steps.steps-6 {
                grid-template-columns: 1fr;
            }
        }

        /* Custom Input Group (untuk Prefix Rp & Suffix %) */
        .transaksi-input-group {
            display: flex;
            align-items: stretch;
        }
        .transaksi-input-group-prepend,
        .transaksi-input-group-append {
            display: flex;
        }
        .transaksi-input-group-text {
            display: flex;
            align-items: center;
            padding: 0.85rem 0.95rem;
            background: #f8f9fc;
            border: 1px solid var(--gray-300);
            color: var(--gray-600);
            font-weight: 500;
        }

        /* Prepend (Rp) */
        .transaksi-input-group-prepend .transaksi-input-group-text {
            border-radius: var(--radius-lg) 0 0 var(--radius-lg);
        }
        .transaksi-input-group:not(.append) .transaksi-form-control {
            border-radius: 0 var(--radius-lg) var(--radius-lg) 0;
            border-left: none;
        }

        /* Append (%) */
        .transaksi-input-group.append .transaksi-form-control {
            border-radius: var(--radius-lg) 0 0 var(--radius-lg);
            border-right: none;
        }
        .transaksi-input-group.append .transaksi-input-group-text {
            border-radius: 0 var(--radius-lg) var(--radius-lg) 0;
            border-left: none;
        }

        /* Custom Icon Arrow pada Select */
        select.transaksi-form-control {
            appearance: none;
            background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%236c7383' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 1rem center;
            background-size: 1em;
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
                                    <i class="mdi mdi-account text-white" style="font-size: 2.2rem;"></i>
                                </div>
                                <div>
                                    <h4 class="customer-name mb-1 d-flex align-items-center gap-2">
                                        {{ $application->customer->full_name ?? '-' }}
                                        @php
                                            $jenis = strtolower($application->unit->jenis ?? '');
                                            $badgeClass = $jenis == 'subsidi' ? 'badge-gradient-success' : ($jenis == 'komersil' ? 'badge-gradient-primary' : 'badge-gradient-secondary');
                                            $icon = $jenis == 'subsidi' ? 'mdi-home-assistant' : ($jenis == 'komersil' ? 'mdi-office-building' : 'mdi-help-circle-outline');
                                        @endphp
                                        <span class="badge {{ $badgeClass }}">
                                            <i class="mdi {{ $icon }} me-1"></i>
                                            {{ strtoupper($application->unit->jenis ?? '-') }}
                                        </span>
                                    </h4>
                                    <p class="customer-booking mb-0">Booking ID: {{ optional($application->unit->activeBooking)->booking_code ?? '-' }}</p>
                                </div>
                            </div>

                            <div class="customer-unit-info">
                                <div class="info-item">
                                    <small>Unit - Type</small>
                                    <span>{{ $application->unit->unit_name ?? '-' }} - {{ $application->unit->type ?? '-' }}</span>
                                </div>
                                <div class="info-item">
                                    <small>Blok/No</small>
                                    <span>{{ $application->unit->unit_code ?? '-' }}</span>
                                </div>
                                <div class="info-item">
                                    <small>Harga Unit</small>
                                    <span class="text-primary fw-bold">Rp {{ number_format($application->unit->price ?? 0, 0, ',', '.') }}</span>
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
                            <span>Tahapan Verifikasi KPR</span>
                        </div>

                        @php
                            $jenis = strtolower($application->unit->jenis ?? '');
                            $surveyDone = !empty($application->rekomendasi) ||
                                       strtolower($application->status_survey ?? '') == 'done' ||
                                       ($application->booking->status_survey ?? 0) == 1;
                        @endphp

                        <div class="transaksi-progress-top">
                            <span class="transaksi-muted">Progress Proses</span>
                            @if($jenis == 'komersil')
                                @if($surveyDone)
                                    <span>Tahap 5 dari 6 (Proses Akad)</span>
                                @else
                                    <span>Menunggu</span>
                                @endif
                            @else
                                @if($surveyDone)
                                    <span>Tahap 4 dari 5 (Proses Akad)</span>
                                @else
                                    <span>Menunggu</span>
                                @endif
                            @endif
                        </div>

                        <div class="akad-progress">
                            <div class="akad-progress-bar"></div>
                        </div>

                        <div class="transaksi-steps {{ $jenis == 'komersil' ? 'steps-6' : 'steps-5' }}" {!! $jenis == 'subsidi' ? 'style="grid-template-columns: repeat(5, 1fr);"' : ($jenis != 'komersil' && $jenis != 'subsidi' ? 'style="grid-template-columns: repeat(4, 1fr);"' : '') !!}>
                            <div class="transaksi-step completed">
                                <div class="transaksi-step-icon">
                                    <i class="mdi mdi-check"></i>
                                </div>
                                <span class="transaksi-step-title">Pengajuan</span>
                                <small>{{ \Carbon\Carbon::parse($application->submitted_at ?? now())->translatedFormat('j F Y') }}</small>
                            </div>

                            <div class="transaksi-step completed">
                                <div class="transaksi-step-icon">
                                    <i class="mdi mdi-check"></i>
                                </div>
                                <span class="transaksi-step-title">Verifikasi</span>
                                <small>{{ \Carbon\Carbon::parse($application->created_at ?? now())->translatedFormat('j F Y') }}</small>
                            </div>

                            @php
                                $status = strtolower($application->unit->construction_progress ?? '');
                                $statusText = [
                                    'belum_mulai' => 'Belum mulai pembangunan',
                                    'pondasi' => 'Tahap pondasi',
                                    'dinding' => 'Tahap dinding',
                                    'atap' => 'Tahap atap',
                                    'finishing' => 'Tahap finishing',
                                    'selesai' => 'Pembangunan selesai',
                                ];
                                $config = [
                                    'belum_mulai' => ['icon' => 'mdi-home-city', 'color' => 'secondary'],
                                    'pondasi' => ['icon' => 'mdi-hammer', 'color' => 'warning'],
                                    'dinding' => ['icon' => 'mdi-wall', 'color' => 'warning'],
                                    'atap' => ['icon' => 'mdi-home-roof', 'color' => 'info'],
                                    'finishing' => ['icon' => 'mdi-brush', 'color' => 'primary'],
                                    'selesai' => ['icon' => 'mdi-check-circle', 'color' => 'success'],
                                ];
                                $statusConfig = $config[$status] ?? ['icon' => 'mdi-home-city', 'color' => 'secondary'];
                            @endphp

                            <div class="transaksi-step {{ $status == 'selesai' ? 'completed' : '' }}">
                                @if ($status == 'selesai')
                                    <div class="transaksi-step-icon">
                                        <i class="mdi mdi-check"></i>
                                    </div>
                                @else
                                    <div class="transaksi-step-icon border border-{{ $statusConfig['color'] }} text-{{ $statusConfig['color'] }}">
                                        <i class="mdi {{ $statusConfig['icon'] }}"></i>
                                    </div>
                                @endif
                                <span class="transaksi-step-title">Pembangunan</span>
                                <small>{{ $statusText[$status] ?? 'Pembangunan selesai' }}</small>
                            </div>

                            @if($jenis == 'komersil')
                            <div class="transaksi-step {{ $surveyDone ? 'completed' : '' }}">
                                @if($surveyDone)
                                    <div class="transaksi-step-icon">
                                        <i class="mdi mdi-check"></i>
                                    </div>
                                    <span class="transaksi-step-title">Survey</span>
                                    <small>{{ $application->survey_date ? \Carbon\Carbon::parse($application->survey_date)->translatedFormat('j F Y') : 'Selesai' }}</small>
                                @else
                                    <div class="transaksi-step-icon">
                                        <i class="mdi mdi-home-search-outline"></i>
                                    </div>
                                    <span class="transaksi-step-title">Survey</span>
                                    <small>Menunggu</small>
                                @endif
                            </div>
                            @else
                            <div class="transaksi-step {{ $surveyDone ? 'completed' : '' }}">
                                @if($surveyDone)
                                    <div class="transaksi-step-icon">
                                        <i class="mdi mdi-check"></i>
                                    </div>
                                    <span class="transaksi-step-title">Survey</span>
                                    <small>{{ $application->survey_date ? \Carbon\Carbon::parse($application->survey_date)->translatedFormat('j F Y') : 'Selesai' }}</small>
                                @else
                                    <div class="transaksi-step-icon">
                                        <i class="mdi mdi-home-search-outline"></i>
                                    </div>
                                    <span class="transaksi-step-title">Survey</span>
                                    <small>Menunggu</small>
                                @endif
                            </div>
                            @endif

                            <div class="transaksi-step active">
                                <div class="transaksi-step-icon">
                                    <i class="mdi mdi-handshake-outline"></i>
                                </div>
                                <span class="transaksi-step-title">Akad</span>
                                <small>Progress</small>
                            </div>

                            <div class="transaksi-step">
                                <div class="transaksi-step-icon">
                                    <i class="mdi mdi-key-variant"></i>
                                </div>
                                <span class="transaksi-step-title">Serah Terima</span>
                                <small>Menunggu</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="transaksi-section-title">
                            <i class="mdi mdi-bank-outline"></i>
                            <span>Detail Pengajuan KPR</span>
                        </div>

                        <div class="transaksi-detail-list">
                            <div class="transaksi-detail-item">
                                <span>Bank Tujuan</span>
                                <span>{{ $application->bank->bank_name ?? '-' }}</span>
                            </div>
                            <div class="transaksi-detail-item">
                                <span>Jumlah Pinjaman</span>
                                <span>Rp {{ number_format($application->jumlah_pinjaman ?? 0, 0, ',', '.') }}</span>
                            </div>
                            <div class="transaksi-detail-item">
                                <span>Tenor</span>
                                <span>{{ $application->tenor ?? '-' }} Tahun</span>
                            </div>
                            <div class="transaksi-detail-item">
                                <span>Angsuran / bln</span>
                                <span class="highlight">Rp {{ number_format($application->estimasi_angsuran ?? 0, 0, ',', '.') }}</span>
                            </div>
                            <div class="transaksi-detail-item">
                                <span>Metode Pembayaran</span>
                                <span class="badge badge-gradient-primary">
                                    <i class="mdi mdi-bank-transfer-in me-1"></i>
                                    KPR
                                </span>
                            </div>
                        </div>

                        <hr class="my-4">

                        <small class="transaksi-muted d-block mb-2">Ditangani oleh</small>
                        <div class="transaksi-handler">
                            <div class="transaksi-handler-icon">
                                <i class="mdi mdi-account-tie"></i>
                            </div>
                            <div>
                                <div class="fw-bold">{{ optional(optional($application->unit)->activeBooking)->sales->name ?? '-' }}</div>
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
                            <i class="mdi mdi-shield-check-outline"></i>
                            <span>Konfirmasi Persetujuan KPR</span>
                        </div>

                        @if (session('success'))
                            <div class="transaksi-inline-alert success">
                                <i class="mdi mdi-check-circle-outline"></i>
                                <div>{{ session('success') }}</div>
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="transaksi-inline-alert danger">
                                <i class="mdi mdi-alert-circle-outline"></i>
                                <div>{{ session('error') }}</div>
                            </div>
                        @endif

                        <div class="transaksi-inline-alert info mb-4">
                            <i class="mdi mdi-information-outline"></i>
                            <div>Pilih status persetujuan dari bank. Keputusan ini akan menentukan langkah selanjutnya.</div>
                        </div>

                        <div class="transaksi-inline-alert danger transaksi-error-box" id="decisionErrorBox">
                            <i class="mdi mdi-alert-circle-outline"></i>
                            <div>Silakan pilih keputusan persetujuan terlebih dahulu sebelum submit.</div>
                        </div>

                        <form action="{{ route('kpr.verifikasi.store', $application->booking_id ?? $application->id) }}" method="POST" enctype="multipart/form-data" id="formKonfirmasiKpr">
                            @csrf
                            <input type="hidden" name="status" id="inputStatus" value="">

                            <div class="row g-3 mb-3">
                                <div class="col-12 col-md-6">
                                    <div class="transaksi-decision-card approve" id="cardSetuju">
                                        <input type="radio" name="decision_choice" id="decisionApprove" value="survey">
                                        <label for="decisionApprove" class="transaksi-decision-label">
                                            <div class="transaksi-decision-icon">
                                                <i class="mdi mdi-check-bold"></i>
                                            </div>
                                            <div class="transaksi-decision-content">
                                                <div class="transaksi-decision-title">KPR DISETUJUI</div>
                                                <p class="transaksi-decision-desc mb-0">Lanjut ke proses Survey / Akad</p>
                                            </div>
                                            <div class="transaksi-decision-check">
                                                <i class="mdi mdi-check-circle"></i>
                                            </div>
                                        </label>
                                    </div>
                                </div>

                                <div class="col-12 col-md-6">
                                    <div class="transaksi-decision-card reject" id="cardTolak">
                                        <input type="radio" name="decision_choice" id="decisionReject" value="rejected">
                                        <label for="decisionReject" class="transaksi-decision-label">
                                            <div class="transaksi-decision-icon">
                                                <i class="mdi mdi-close-thick"></i>
                                            </div>
                                            <div class="transaksi-decision-content">
                                                <div class="transaksi-decision-title">KPR DITOLAK</div>
                                                <p class="transaksi-decision-desc mb-0">Pindah ke Cash / Pengajuan Ulang</p>
                                            </div>
                                            <div class="transaksi-decision-check">
                                                <i class="mdi mdi-check-circle"></i>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div id="formSetuju" class="transaksi-form-shell approve">
                                <div class="transaksi-form-title approve">Form Persetujuan KPR</div>

                                <div class="transaksi-inline-alert success">
                                    <i class="mdi mdi-check-circle-outline"></i>
                                    <div><strong>KPR disetujui.</strong> Silakan isi detail persetujuan dari bank.</div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="transaksi-form-group">
                                            <label class="transaksi-form-label">Nilai Disetujui</label>
                                            <div class="transaksi-input-group">
                                                <div class="transaksi-input-group-prepend">
                                                    <span class="transaksi-input-group-text">Rp</span>
                                                </div>
                                                <input type="text" class="transaksi-form-control" name="jumlah_pinjaman" value="{{ $application->jumlah_pinjaman ?? '' }}">
                                            </div>
                                            <small class="transaksi-muted">Bisa berbeda dari pengajuan</small>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="transaksi-form-group">
                                            <label class="transaksi-form-label">Angsuran Disetujui</label>
                                            <div class="transaksi-input-group">
                                                <div class="transaksi-input-group-prepend">
                                                    <span class="transaksi-input-group-text">Rp</span>
                                                </div>
                                                <input type="text" class="transaksi-form-control" name="estimasi_angsuran" value="{{ $application->estimasi_angsuran ?? '' }}">
                                            </div>
                                            <small class="transaksi-muted">Bisa berbeda dari pengajuan</small>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="transaksi-form-group">
                                            <label class="transaksi-form-label">Tenor Disetujui</label>
                                            <select class="transaksi-form-control" name="tenor">
                                                <option value="5" {{ ($application->tenor ?? '') == 5 ? 'selected' : '' }}>5 Tahun</option>
                                                <option value="10" {{ ($application->tenor ?? '') == 10 ? 'selected' : '' }}>10 Tahun</option>
                                                <option value="15" {{ ($application->tenor ?? '') == 15 ? 'selected' : '' }}>15 Tahun</option>
                                                <option value="20" {{ ($application->tenor ?? '') == 20 ? 'selected' : '' }}>20 Tahun</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="transaksi-form-group">
                                            <label class="transaksi-form-label">Bunga Final</label>
                                            <div class="transaksi-input-group append">
                                                <input type="text" class="transaksi-form-control" name="bunga" value="{{ $application->bunga ?? '' }}">
                                                <div class="transaksi-input-group-append">
                                                    <span class="transaksi-input-group-text">%</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="transaksi-form-group">
                                            <label class="transaksi-form-label">No. Surat Persetujuan (SP3K)</label>
                                            <input type="text" class="transaksi-form-control" name="no_sp3k" value="SP3K/2025/021/ABC">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="transaksi-form-group">
                                            <label class="transaksi-form-label">Tanggal Persetujuan</label>
                                            <input type="date" class="transaksi-form-control" name="approved_at" value="{{ date('Y-m-d') }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="transaksi-form-group">
                                    <label class="transaksi-form-label">Upload Surat Persetujuan Prinsip</label>
                                    <div class="transaksi-file-upload">
                                        <input type="file" name="berita_acara" accept=".jpg,.jpeg,.png,.pdf">
                                        <div class="transaksi-file-label">
                                            <i class="mdi mdi-cloud-upload"></i>
                                            <div class="transaksi-file-info">
                                                <span>Upload Surat Persetujuan</span>
                                                <small>Format: JPG, PNG, PDF (Max 5MB)</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="transaksi-form-group mb-0">
                                    <label class="transaksi-form-label">Catatan Persetujuan</label>
                                    <textarea class="transaksi-form-control" name="catatan" rows="2">Disetujui dengan nilai Rp {{ number_format($application->jumlah_pinjaman ?? 0, 0, ',', '.') }}, bunga {{ $application->bunga ?? '' }}%</textarea>
                                </div>
                            </div>

                            <div id="formTolak" class="transaksi-form-shell reject">
                                <div class="transaksi-form-title reject">Form Penolakan KPR</div>

                                <div class="transaksi-inline-alert danger">
                                    <i class="mdi mdi-close-circle-outline"></i>
                                    <div><strong>KPR DITOLAK</strong> - Pilih alasan penolakan dari bank.</div>
                                </div>

                                <div class="transaksi-form-group">
                                    <label class="transaksi-form-label">Alasan Penolakan dari Bank</label>
                                    <select class="transaksi-form-control" name="alasan_tolak" id="alasanTolak">
                                        <option value="">-- Pilih Alasan --</option>
                                        <option value="BI Checking">BI Checking / SLIK Bermasalah</option>
                                        <option value="Kemampuan Bayar">Kemampuan Bayar Kurang</option>
                                        <option value="Dokumen Tidak Lengkap">Dokumen Tidak Lengkap</option>
                                        <option value="Appraisal">Nilai Appraisal Rendah</option>
                                        <option value="Usia">Usia Tidak Memenuhi</option>
                                        <option value="Lainnya">Lainnya</option>
                                    </select>
                                </div>

                                <div class="transaksi-form-group" id="alasanLainnya" style="display: none;">
                                    <label class="transaksi-form-label">Tulis Alasan Lainnya</label>
                                    <input type="text" class="transaksi-form-control" name="alasan_lainnya" placeholder="Contoh: Kebijakan bank baru">
                                </div>

                                <div class="transaksi-form-group mb-0">
                                    <label class="transaksi-form-label">Catatan Penolakan</label>
                                    <textarea class="transaksi-form-control" name="catatan" rows="2" placeholder="Detail penolakan dari bank..."></textarea>
                                </div>
                            </div>

                            <div class="transaksi-action-bar">
                                <a href="{{ url('/marketing/kpr') }}" class="transaksi-btn transaksi-btn-secondary">
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
                                <i class="mdi mdi-home-key"></i>
                                <span>Serah Terima Unit</span>
                            </div>

                            @if (($application->status ?? '') === 'approved')
                                <div class="text-center py-3">
                                    <i class="mdi mdi-check-circle text-success" style="font-size: 48px;"></i>
                                    <p class="mt-3 mb-2 fw-medium">Akad telah disetujui</p>
                                    <p class="text-muted small">Unit siap untuk proses serah terima</p>
                                </div>
                                <a href="{{ route('booking.serah-terima', $application->booking->id ?? 0) }}" class="transaksi-btn transaksi-btn-primary w-100 justify-content-center">
                                    <i class="mdi mdi-key me-1"></i> Proses Serah Terima
                                </a>
                            @else
                                <div class="text-center py-4">
                                    <i class="mdi mdi-clock-outline text-warning" style="font-size: 48px;"></i>
                                    <p class="mt-3 mb-0 text-muted">Menunggu persetujuan akad</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="card mt-4">
                        <div class="card-body">
                            <div class="transaksi-section-title">
                                <i class="mdi mdi-lightbulb-on-outline"></i>
                                <span>Panduan Konfirmasi</span>
                            </div>

                            <div class="transaksi-sidebar-section">
                                <div class="transaksi-sidebar-title">Saat Disetujui</div>
                                <ul class="transaksi-mini-list mb-0">
                                    <li>
                                        <i class="mdi mdi-arrow-right-circle-outline"></i>
                                        <span>Isi nilai pinjaman dan angsuran yang disetujui bank.</span>
                                    </li>
                                    <li>
                                        <i class="mdi mdi-arrow-right-circle-outline"></i>
                                        <span>Upload surat persetujuan prinsip sebagai bukti.</span>
                                    </li>
                                    <li>
                                        <i class="mdi mdi-arrow-right-circle-outline"></i>
                                        <span>Setelah disimpan, proses akan lanjut ke tahap Survey.</span>
                                    </li>
                                </ul>
                            </div>

                            <div class="transaksi-sidebar-section">
                                <div class="transaksi-sidebar-title">Saat Ditolak</div>
                                <ul class="transaksi-mini-list mb-0">
                                    <li>
                                        <i class="mdi mdi-arrow-right-circle-outline"></i>
                                        <span>Pilih alasan penolakan yang sesuai dari bank.</span>
                                    </li>
                                    <li>
                                        <i class="mdi mdi-arrow-right-circle-outline"></i>
                                        <span>Isi catatan detail agar tim sales dapat menindaklanjuti.</span>
                                    </li>
                                    <li>
                                        <i class="mdi mdi-arrow-right-circle-outline"></i>
                                        <span>Customer akan diarahkan ke opsi alternatif (cash/pengajuan ulang).</span>
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
            const $decisionApprove = $('#decisionApprove');
            const $decisionReject = $('#decisionReject');
            const $statusInput = $('#inputStatus');
            const $formSetuju = $('#formSetuju');
            const $formTolak = $('#formTolak');
            const $decisionErrorBox = $('#decisionErrorBox');

            function switchDecision(type) {
                $decisionErrorBox.hide();

                if (type === 'survey') {
                    $statusInput.val('survey');
                    $formSetuju.slideDown(180);
                    $formTolak.slideUp(180);
                } else if (type === 'rejected') {
                    $statusInput.val('rejected');
                    $formTolak.slideDown(180);
                    $formSetuju.slideUp(180);
                }
            }

            $decisionApprove.on('change', function() {
                if ($(this).is(':checked')) {
                    switchDecision('survey');
                }
            });

            $decisionReject.on('change', function() {
                if ($(this).is(':checked')) {
                    switchDecision('rejected');
                }
            });

            // Tampilkan input alasan lainnya
            $('#alasanTolak').change(function() {
                if ($(this).val() === 'Lainnya') {
                    $('#alasanLainnya').slideDown();
                } else {
                    $('#alasanLainnya').slideUp();
                }
            });

            // File upload preview
            $(document).on('change', 'input[type="file"]', function(e) {
                const file = e.target.files[0];
                const $container = $(this).closest('.transaksi-file-upload');

                if (file) {
                    const sizeInMB = (file.size / (1024 * 1024)).toFixed(2);
                    $container.find('.transaksi-file-info span').text(file.name);
                    $container.find('.transaksi-file-info small').text(sizeInMB + ' MB');
                }
            });

            // Set progress bar width dynamically
            const jenis = '{{ $jenis ?? '' }}';
            const surveyDone = {{ $surveyDone ? 'true' : 'false' }};

            if (surveyDone) {
                // Survey sudah selesai, progress sampai Akad
                const progressWidth = jenis === 'komersil' ? '50%' : '40%';
                $('.akad-progress-bar').css('width', progressWidth);
            } else {
                // Survey belum selesai, progress berhenti di Survey
                const progressWidth = jenis === 'komersil' ? '33%' : '25%';
                $('.akad-progress-bar').css('width', progressWidth);
            }
        });

            // Form validation
            $('#formKonfirmasiKpr').on('submit', function(e) {
                if (!$statusInput.val()) {
                    e.preventDefault();
                    $decisionErrorBox.slideDown(160);

                    $('html, body').animate({
                        scrollTop: $decisionErrorBox.offset().top - 120
                    }, 300);
                }
            });
        });
    </script>
@endpush
