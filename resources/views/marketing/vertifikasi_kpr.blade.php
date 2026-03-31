@extends('layouts.partial.app')

@section('title', 'Verifikasi KPR - Properti Management')
@section('content')
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
                                        {{ $booking->customer->full_name ?? '-' }}
                                        @php
                                            $jenis = strtolower($booking->unit->jenis ?? '');
                                            $badgeClass = $jenis == 'subsidi' ? 'badge-gradient-success' : ($jenis == 'komersil' ? 'badge-gradient-primary' : 'badge-gradient-secondary');
                                        @endphp
                                        <span class="badge {{ $badgeClass }} ms-2">
                                            <i class="mdi mdi-home-outline me-1"></i>
                                            {{ strtoupper($booking->unit->jenis ?? '-') }}
                                        </span>
                                    </h4>
                                    <p class="customer-booking mb-0">Booking ID: {{ $booking->booking_code ?? '-' }}</p>
                                </div>
                            </div>

                            <div class="customer-unit-info">
                                <div class="info-item">
                                    <small>Unit</small>
                                    <span>{{ $booking->unit->unit_name ?? '-' }}</span>
                                </div>
                                <div class="info-item">
                                    <small>Blok/No</small>
                                    <span>{{ $booking->unit->unit_code ?? '-' }}</span>
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
                            <span>Tahapan Verifikasi KPR</span>
                        </div>

                        @php
                            $jenis = strtolower($booking->unit->jenis ?? '');
                            $totalSteps = 6;
                            $currentStep = 2;

                            $developmentDone = ($booking->status_pembangunan ?? 0) == 1 || optional($booking->kprApplication)->status_pembangunan == 'done';
                            if ($developmentDone) $currentStep = 3;

                            $akadDone = ($booking->status_akad ?? 0) == 1 || optional($booking->kprApplication)->status_akad == 1;
                            if ($akadDone) $currentStep = 4;

                            $surveyDone = ($booking->status_survey ?? 0) == 1 || optional($booking->kprApplication)->status_survey == 'done';
                            if ($surveyDone) $currentStep = 5;

                            $serahTerimaDone = ($booking->status_serahterima ?? 0) == 1 || optional($booking->kprApplication)->status_serahterima == 1;
                            if ($serahTerimaDone) $currentStep = 6;

                            $progressWidth = intval(($currentStep / $totalSteps) * 100);
                            $stepsStyle = 'style="grid-template-columns: repeat(6, 1fr);"';
                            $stepClass = fn($index) => $index < $currentStep ? 'completed' : ($index == $currentStep ? 'active' : '');
                        @endphp

                        <div class="transaksi-progress-top">
                            <span class="transaksi-muted">Progress Proses</span>
                            <span>Tahap {{ $currentStep }} dari {{ $totalSteps }}</span>
                        </div>

                        <div class="transaksi-progress">
                            <div class="transaksi-progress-bar" style="width: {{ $progressWidth }}%;"></div>
                        </div>

                        <div class="transaksi-steps" {!! $stepsStyle !!}>
                            <div class="transaksi-step {{ $stepClass(1) }}">
                                <div class="transaksi-step-icon"><i class="mdi mdi-check"></i></div>
                                <span class="transaksi-step-title">Pengajuan</span>
                                <small>{{ optional($booking->kprApplication)->submitted_at ? \Carbon\Carbon::parse($booking->kprApplication->submitted_at)->translatedFormat('d F Y') : '-' }}</small>
                            </div>
                            <div class="transaksi-step {{ $stepClass(2) }}">
                                <div class="transaksi-step-icon"><i class="mdi mdi-file-document-edit-outline"></i></div>
                                <span class="transaksi-step-title">Verifikasi</span>
                                <small>{{ $currentStep == 2 ? 'Dalam Proses' : ($currentStep > 2 ? 'Selesai' : 'Menunggu') }}</small>
                            </div>
                            <div class="transaksi-step {{ $stepClass(3) }}">
                                <div class="transaksi-step-icon"><i class="mdi mdi-home-city"></i></div>
                                <span class="transaksi-step-title">Pembangunan</span>
                                <small>{{ $developmentDone ? 'Sedang/ Selesai' : ($currentStep == 3 ? 'Dalam Proses' : 'Menunggu') }}</small>
                            </div>
                            <div class="transaksi-step {{ $stepClass(4) }}">
                                <div class="transaksi-step-icon"><i class="mdi mdi-handshake-outline"></i></div>
                                <span class="transaksi-step-title">Akad</span>
                                <small>{{ $akadDone ? 'Selesai' : ($currentStep == 4 ? 'Dalam Proses' : 'Menunggu') }}</small>
                            </div>
                            <div class="transaksi-step {{ $stepClass(5) }}">
                                <div class="transaksi-step-icon"><i class="mdi mdi-home-search-outline"></i></div>
                                <span class="transaksi-step-title">Survey</span>
                                <small>{{ $surveyDone ? 'Selesai' : ($currentStep == 5 ? 'Dalam Proses' : 'Menunggu') }}</small>
                            </div>
                            <div class="transaksi-step {{ $stepClass(6) }}">
                                <div class="transaksi-step-icon"><i class="mdi mdi-cash-fast"></i></div>
                                <span class="transaksi-step-title">Serah Terima</span>
                                <small>{{ $serahTerimaDone ? 'Selesai' : ($currentStep == 6 ? 'Dalam Proses' : 'Menunggu') }}</small>
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
                            <span>Detail KPR</span>
                        </div>
                        <div class="transaksi-detail-list">
                            <div class="transaksi-detail-item">
                                <span>Bank Tujuan</span>
                                <span>{{ $booking->kprApplication->bank->bank_name ?? '-' }}</span>
                            </div>
                            <div class="transaksi-detail-item">
                                <span>Jumlah Pinjaman</span>
                                <span>Rp {{ number_format($booking->kprApplication->jumlah_pinjaman ?? 0, 0, ',', '.') }}</span>
                            </div>
                            <div class="transaksi-detail-item">
                                <span>Tenor</span>
                                <span>{{ $booking->kprApplication->tenor ?? '-' }} Tahun</span>
                            </div>
                            <div class="transaksi-detail-item">
                                <span>Angsuran / bln</span>
                                <span class="highlight">Rp {{ number_format($booking->kprApplication->estimasi_angsuran ?? 0, 0, ',', '.') }}</span>
                            </div>
                        </div>
                        <hr class="my-4">
                        <small class="transaksi-muted d-block mb-2">Ditangani oleh</small>
                        <div class="transaksi-handler">
                            <div class="transaksi-handler-icon"><i class="mdi mdi-account-tie"></i></div>
                            <div><div class="fw-bold">{{ $booking->sales->name ?? '-' }}</div></div>
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
                            <i class="mdi mdi-file-document-multiple-outline"></i>
                            <span>Kelengkapan Dokumen</span>
                        </div>

                        @php
                            $documentTypes = ['ktp', 'kk', 'npwp', 'slip_gaji', 'rekening_koran', 'surat_nikah', 'sku', 'ktp_pasangan'];
                            $documents = $booking->kprApplication->documents ?? [];
                            $completeCount = collect($documentTypes)->filter(fn($type) => collect($documents)->firstWhere('type', $type))->count();
                            $missingCount = 8 - $completeCount;
                        @endphp

                        @if ($missingCount > 0)
                            <div class="transaksi-inline-alert warning">
                                <i class="mdi mdi-alert-circle-outline"></i>
                                <div>Masih ada <strong>{{ $missingCount }} dokumen</strong> yang perlu dilengkapi sebelum proses verifikasi final.</div>
                            </div>
                        @else
                            <div class="transaksi-inline-alert success">
                                <i class="mdi mdi-check-circle-outline"></i>
                                <div>Semua dokumen utama telah tersedia dan siap untuk ditinjau.</div>
                            </div>
                        @endif

                        <div class="table-responsive">
                            <table class="table transaksi-doc-table align-middle mb-0">
                                <thead>
                                    <tr>
                                        <th style="width: 38%;">Nama Dokumen</th>
                                        <th style="width: 20%;">Status</th>
                                        <th style="width: 22%;">Tanggal Upload</th>
                                        <th style="width: 20%;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($documentTypes as $type)
                                        @php
                                            $doc      = collect($documents)->firstWhere('type', $type);
                                            $fileUrl  = $doc ? asset('storage/' . $doc->path) : null;
                                            $docLabel = strtoupper(str_replace('_', ' ', $type));
                                        @endphp
                                        <tr>
                                            <td>
                                                <div class="transaksi-doc-name">
                                                    <div class="transaksi-doc-icon"><i class="mdi mdi-file-document-outline"></i></div>
                                                    <div>
                                                        <div>{{ $docLabel }}</div>
                                                        <small class="transaksi-muted">{{ $doc ? 'Siap direview' : 'Perlu dilengkapi' }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="badge {{ $doc ? 'bg-success' : 'bg-danger' }}">
                                                    {{ $doc ? 'Lengkap' : 'Kurang' }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="transaksi-muted">
                                                    {{ $doc ? \Carbon\Carbon::parse($doc->created_at)->translatedFormat('d M Y') : '-' }}
                                                </span>
                                            </td>
                                            <td>
                                                @if ($doc)
                                                    @php
                                                        $fileExt = strtolower(pathinfo($doc->path, PATHINFO_EXTENSION));
                                                    @endphp
                                                    <button type="button"
                                                        class="transaksi-doc-action btn-preview-doc"
                                                        title="Lihat dokumen"
                                                        data-url="{{ $fileUrl }}"
                                                        data-ext="{{ $fileExt }}"
                                                        data-label="{{ $docLabel }}">
                                                        <i class="mdi mdi-eye-outline"></i>
                                                    </button>
                                                @else
                                                    <button type="button" class="transaksi-doc-action disabled" title="Dokumen belum tersedia" disabled>
                                                        <i class="mdi mdi-eye-off-outline"></i>
                                                    </button>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="text-muted small mt-3 d-block d-sm-none">
                            <i class="mdi mdi-information-outline me-1"></i>
                            Geser tabel untuk melihat kolom lainnya
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-4">
                <div class="transaksi-sticky">
                    <div class="card">
                        <div class="card-body">
                            <div class="transaksi-section-title">
                                <i class="mdi mdi-clipboard-text-outline"></i>
                                <span>Informasi Verifikasi</span>
                            </div>

                            <div class="mb-3">
                                @if ($completeCount === 8)
                                    <div class="transaksi-status-banner success">
                                        <i class="mdi mdi-check-circle-outline"></i>
                                        Semua Dokumen Lengkap
                                    </div>
                                @else
                                    <div class="transaksi-status-banner warning">
                                        <i class="mdi mdi-progress-clock"></i>
                                        Menunggu Kelengkapan Dokumen
                                    </div>
                                @endif
                            </div>

                            <div class="transaksi-summary-grid">
                                <div class="transaksi-summary-box success">
                                    <div class="label">Dokumen Lengkap</div>
                                    <div class="value">{{ $completeCount }}</div>
                                </div>
                                <div class="transaksi-summary-box danger">
                                    <div class="label">Dokumen Kurang</div>
                                    <div class="value">{{ $missingCount }}</div>
                                </div>
                            </div>

                            <div class="transaksi-sidebar-section">
                                <div class="transaksi-sidebar-title">Rekomendasi Sistem</div>
                                @if ($completeCount === 8)
                                    <div class="transaksi-inline-alert success mb-0">
                                        <i class="mdi mdi-check-decagram-outline"></i>
                                        <div>Dokumen sudah lengkap. Verifikasi dapat dilanjutkan ke pengambilan keputusan.</div>
                                    </div>
                                @else
                                    <div class="transaksi-inline-alert warning mb-0">
                                        <i class="mdi mdi-file-alert-outline"></i>
                                        <div>Fokus utama saat ini adalah melengkapi {{ $missingCount }} dokumen yang belum tersedia.</div>
                                    </div>
                                @endif
                            </div>

                            <div class="transaksi-sidebar-section transaksi-decision-summary" id="decisionSummary">
                                <div class="transaksi-sidebar-title">Ringkasan Keputusan</div>
                                <div class="summary-state" id="decisionStateBadge">
                                    <i class="mdi mdi-help-circle-outline"></i>
                                    <span id="decisionStateText">Belum dipilih</span>
                                </div>
                                <ul class="transaksi-mini-list mt-3 mb-0" id="decisionSummaryList">
                                    <li><i class="mdi mdi-information-outline"></i><span>Pilih keputusan verifikasi untuk melihat ringkasan langkah berikutnya.</span></li>
                                </ul>
                            </div>

                            <div class="transaksi-sidebar-section">
                                <div class="transaksi-sidebar-title">Checklist Review</div>
                                <ul class="transaksi-mini-list mb-0">
                                    <li><i class="mdi mdi-check-circle-outline"></i><span>Pastikan seluruh dokumen yang tersedia sudah ditinjau.</span></li>
                                    <li><i class="mdi mdi-check-circle-outline"></i><span>Isi catatan verifikasi agar keputusan mudah dilacak tim berikutnya.</span></li>
                                    <li><i class="mdi mdi-check-circle-outline"></i><span>Unggah berita acara bila dibutuhkan untuk arsip proses.</span></li>
                                </ul>
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
                            <span>Keputusan Verifikasi KPR</span>
                        </div>

                        <div class="transaksi-inline-alert info mb-4" id="decisionHint">
                            <i class="mdi mdi-information-outline"></i>
                            <div>Pilih salah satu keputusan di bawah ini. Form akan menyesuaikan secara otomatis sesuai status verifikasi.</div>
                        </div>

                        <div class="transaksi-inline-alert danger transaksi-error-box" id="decisionErrorBox">
                            <i class="mdi mdi-alert-circle-outline"></i>
                            <div>Silakan pilih keputusan verifikasi terlebih dahulu sebelum submit.</div>
                        </div>

                        <form action="{{ route('kpr.verifikasi.store', $booking->id) }}" method="POST" enctype="multipart/form-data" id="formVerifikasiKpr">
                            @csrf
                            <input type="hidden" name="status" id="statusVerifikasiInput" value="">

                            <div class="row g-3 mb-3">
                                <div class="col-12 col-md-6">
                                    <div class="transaksi-decision-card approve">
                                        <input type="radio" name="decision_choice" id="decisionApprove" value="survey">
                                        <label for="decisionApprove" class="transaksi-decision-label">
                                            <div class="transaksi-decision-icon"><i class="mdi mdi-check-bold"></i></div>
                                            <div class="transaksi-decision-content">
                                                <div class="transaksi-decision-title">Setujui Verifikasi</div>
                                                <p class="transaksi-decision-desc mb-0">Dokumen dan data dinilai memadai untuk lanjut ke tahap survey.</p>
                                            </div>
                                            <div class="transaksi-decision-check"><i class="mdi mdi-check-circle"></i></div>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="transaksi-decision-card reject">
                                        <input type="radio" name="decision_choice" id="decisionReject" value="rejected">
                                        <label for="decisionReject" class="transaksi-decision-label">
                                            <div class="transaksi-decision-icon"><i class="mdi mdi-close-thick"></i></div>
                                            <div class="transaksi-decision-content">
                                                <div class="transaksi-decision-title">Tolak Verifikasi</div>
                                                <p class="transaksi-decision-desc mb-0">Pengajuan belum dapat dilanjutkan dan perlu tindakan lanjutan.</p>
                                            </div>
                                            <div class="transaksi-decision-check"><i class="mdi mdi-check-circle"></i></div>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div id="formSetuju" class="transaksi-form-shell approve">
                                <div class="transaksi-form-title approve">Form Persetujuan Verifikasi</div>
                                <div class="transaksi-inline-alert success">
                                    <i class="mdi mdi-check-circle-outline"></i>
                                    <div><strong>Verifikasi disetujui.</strong> Pengajuan akan diarahkan ke tahap <strong>Survey</strong>.</div>
                                </div>
                                <div class="transaksi-form-group">
                                    <label class="transaksi-form-label" for="catatan_setuju">Catatan Verifikasi</label>
                                    <textarea id="catatan_setuju" class="transaksi-form-control" name="catatan_setuju" rows="4" placeholder="Contoh: Semua dokumen lengkap, valid, dan layak dilanjutkan ke tahap survey."></textarea>
                                </div>
                                <div class="transaksi-form-group mb-0">
                                    <label class="transaksi-form-label">Upload Berita Acara (Opsional)</label>
                                    <div class="transaksi-file-upload">
                                        <input type="file" name="berita_acara_setuju" accept=".jpg,.jpeg,.png,.pdf">
                                        <div class="transaksi-file-label">
                                            <i class="mdi mdi-cloud-upload"></i>
                                            <div class="transaksi-file-info">
                                                <span>Upload Berita Acara</span>
                                                <small>Format: JPG, PNG, PDF (Max 5MB)</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="formTolak" class="transaksi-form-shell reject">
                                <div class="transaksi-form-title reject">Form Penolakan Verifikasi</div>
                                <div class="transaksi-inline-alert danger">
                                    <i class="mdi mdi-close-circle-outline"></i>
                                    <div><strong>Verifikasi ditolak.</strong> Pilih alasan dan tindakan lanjutan agar proses tetap jelas untuk customer dan internal.</div>
                                </div>
                                <div class="transaksi-form-group">
                                    <label class="transaksi-form-label" for="catatan_tolak">Catatan / Alasan</label>
                                    <textarea id="catatan_tolak" class="transaksi-form-control" name="catatan_tolak" rows="4" placeholder="Contoh: NPWP belum tersedia dan rekening koran belum sesuai periode yang diminta."></textarea>
                                </div>
                                <div class="transaksi-form-group">
                                    <label class="transaksi-form-label">Upload Berita Acara (Opsional)</label>
                                    <div class="transaksi-file-upload">
                                        <input type="file" name="berita_acara_tolak" accept=".jpg,.jpeg,.png,.pdf">
                                        <div class="transaksi-file-label">
                                            <i class="mdi mdi-cloud-upload"></i>
                                            <div class="transaksi-file-info">
                                                <span>Upload Berita Acara</span>
                                                <small>Format: JPG, PNG, PDF (Max 5MB)</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="transaksi-form-group mb-0">
                                    <label class="transaksi-form-label">Tindakan Selanjutnya</label>
                                    <div class="transaksi-next-step-grid">
                                        <div class="transaksi-next-card">
                                            <input type="radio" name="tindakan" id="tindakanLengkapi" value="Lengkapi Dokumen" checked>
                                            <label class="transaksi-next-label" for="tindakanLengkapi">
                                                <div class="transaksi-next-icon"><i class="mdi mdi-file-document-edit-outline"></i></div>
                                                <div class="transaksi-next-content">
                                                    <span class="transaksi-next-title">Lengkapi Dokumen</span>
                                                    <span class="transaksi-next-desc">Customer diminta melengkapi dokumen yang belum tersedia atau belum valid.</span>
                                                </div>
                                                <div class="transaksi-next-check"><i class="mdi mdi-check-circle"></i></div>
                                            </label>
                                        </div>
                                        <div class="transaksi-next-card">
                                            <input type="radio" name="tindakan" id="tindakanUlang" value="Ajukan ke Bank Lain">
                                            <label class="transaksi-next-label" for="tindakanUlang">
                                                <div class="transaksi-next-icon"><i class="mdi mdi-bank-transfer-out"></i></div>
                                                <div class="transaksi-next-content">
                                                    <span class="transaksi-next-title">Ajukan ke Bank Lain</span>
                                                    <span class="transaksi-next-desc">Pengajuan diulang ke bank lain dengan penyesuaian kelengkapan bila diperlukan.</span>
                                                </div>
                                                <div class="transaksi-next-check"><i class="mdi mdi-check-circle"></i></div>
                                            </label>
                                        </div>
                                        <div class="transaksi-next-card">
                                            <input type="radio" name="tindakan" id="tindakanCash" value="Pindah ke Cash">
                                            <label class="transaksi-next-label" for="tindakanCash">
                                                <div class="transaksi-next-icon"><i class="mdi mdi-cash-multiple"></i></div>
                                                <div class="transaksi-next-content">
                                                    <span class="transaksi-next-title">Pindah ke Cash</span>
                                                    <span class="transaksi-next-desc">Customer melanjutkan pembelian dengan metode pembayaran tunai.</span>
                                                </div>
                                                <div class="transaksi-next-check"><i class="mdi mdi-check-circle"></i></div>
                                            </label>
                                        </div>
                                        <div class="transaksi-next-card">
                                            <input type="radio" name="tindakan" id="tindakanBatal" value="Batalkan Transaksi">
                                            <label class="transaksi-next-label" for="tindakanBatal">
                                                <div class="transaksi-next-icon"><i class="mdi mdi-cancel"></i></div>
                                                <div class="transaksi-next-content">
                                                    <span class="transaksi-next-title">Batalkan Transaksi</span>
                                                    <span class="transaksi-next-desc">Customer membatalkan transaksi pembelian dan proses diarahkan ke refund.</span>
                                                </div>
                                                <div class="transaksi-next-check"><i class="mdi mdi-check-circle"></i></div>
                                            </label>
                                        </div>
                                        <div class="transaksi-next-card">
                                            <input type="radio" name="tindakan" id="tindakanBanding" value="Banding Ulang">
                                            <label class="transaksi-next-label" for="tindakanBanding">
                                                <div class="transaksi-next-icon"><i class="mdi mdi-scale-balance"></i></div>
                                                <div class="transaksi-next-content">
                                                    <span class="transaksi-next-title">Banding Ulang</span>
                                                    <span class="transaksi-next-desc">Ajukan banding atau review ulang ke bank yang sama dengan catatan tambahan.</span>
                                                </div>
                                                <div class="transaksi-next-check"><i class="mdi mdi-check-circle"></i></div>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="transaksi-action-bar">
                                <a href="{{ url('/marketing/kpr') }}" class="transaksi-btn transaksi-btn-secondary">
                                    <i class="mdi mdi-arrow-left"></i> Kembali
                                </a>
                                <button type="submit" class="transaksi-btn transaksi-btn-primary">
                                    <i class="mdi mdi-content-save-outline"></i> Simpan Verifikasi
                                </button>
                            </div>
                        </form>

                        <div class="text-muted small mt-3 d-block d-sm-none">
                            <i class="mdi mdi-information-outline me-1"></i>
                            Scroll untuk melihat seluruh isi form
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-4">
                <div class="transaksi-sticky">
                    <div class="card">
                        <div class="card-body">
                            <div class="transaksi-section-title">
                                <i class="mdi mdi-lightbulb-on-outline"></i>
                                <span>Panduan Keputusan</span>
                            </div>
                            <div class="transaksi-sidebar-section">
                                <div class="transaksi-sidebar-title">Saat Disetujui</div>
                                <ul class="transaksi-mini-list mb-0">
                                    <li><i class="mdi mdi-arrow-right-circle-outline"></i><span>Gunakan jika dokumen utama lengkap dan tidak ada temuan material.</span></li>
                                    <li><i class="mdi mdi-arrow-right-circle-outline"></i><span>Tambahkan catatan singkat agar tim survey memahami konteks review.</span></li>
                                </ul>
                            </div>
                            <div class="transaksi-sidebar-section">
                                <div class="transaksi-sidebar-title">Saat Ditolak</div>
                                <ul class="transaksi-mini-list mb-0">
                                    <li><i class="mdi mdi-arrow-right-circle-outline"></i><span>Jelaskan alasan penolakan secara spesifik dan dapat ditindaklanjuti.</span></li>
                                    <li><i class="mdi mdi-arrow-right-circle-outline"></i><span>Pilih tindakan lanjutan yang paling relevan agar proses berikutnya tidak ambigu.</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL PREVIEW DOKUMEN --}}
    <div class="modal fade" id="modalPreviewDokumen" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content" style="border-radius:12px; overflow:hidden;">
                <div class="modal-header">
                    <div class="d-flex align-items-center gap-2">
                        <i class="mdi mdi-file-eye-outline" id="modalDocIcon" style="font-size:1.3rem;"></i>
                        <h5 class="modal-title mb-0" id="modalDocLabel">Preview Dokumen</h5>
                        <span class="badge bg-secondary ms-1" id="modalDocExt" style="font-size:0.7rem;"></span>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <a href="#" id="btnDownloadDoc" class="btn btn-sm btn-outline-secondary" download title="Download">
                            <i class="mdi mdi-download"></i>
                        </a>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                </div>

                <div class="modal-body p-0" style="background:#f0f0f0; min-height:70vh; position:relative;">
                    {{-- Loading --}}
                    <div id="previewLoading" class="d-flex flex-column align-items-center justify-content-center gap-3" style="height:70vh;">
                        <div class="spinner-border text-primary" style="width:2.5rem;height:2.5rem;"></div>
                        <span class="text-muted small">Memuat dokumen...</span>
                    </div>

                    {{-- Error --}}
                    <div id="previewError" class="d-none flex-column align-items-center justify-content-center gap-3 text-center p-4" style="height:70vh;">
                        <i class="mdi mdi-file-alert-outline" style="font-size:3rem; color:#dc3545; opacity:.6;"></i>
                        <div>
                            <div class="fw-semibold text-danger">Dokumen tidak dapat ditampilkan</div>
                            <small class="text-muted">Coba download untuk melihat isinya.</small>
                        </div>
                        <a href="#" id="btnErrorDownload" class="btn btn-sm btn-primary" download>
                            <i class="mdi mdi-download me-1"></i> Download Dokumen
                        </a>
                    </div>

                    {{-- PDF via iframe blob --}}
                    <iframe id="iframePreview" src="" class="d-none"
                        style="width:100%; height:75vh; border:none; display:block;"></iframe>

                    {{-- Gambar --}}
                    <div id="divImagePreview" class="d-none align-items-center justify-content-center p-3"
                        style="min-height:70vh; background:#1a1a1a;">
                        <img id="imgPreview" src="" alt="Preview"
                            style="max-width:100%; max-height:75vh; object-fit:contain; border-radius:4px; box-shadow:0 4px 24px rgba(0,0,0,.5);" />
                    </div>
                </div>

                <div class="modal-footer">
                    <small class="text-muted me-auto" id="previewFooterInfo"></small>
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '{{ session('success') }}',
                confirmButtonText: 'OK'
            });
        </script>
    @endif

    <script>
        $(document).ready(function () {

            /* =====================================================
               VERIFIKASI FORM LOGIC
               ===================================================== */
            const $decisionApprove  = $('#decisionApprove');
            const $decisionReject   = $('#decisionReject');
            const $statusInput      = $('#statusVerifikasiInput');
            const $formSetuju       = $('#formSetuju');
            const $formTolak        = $('#formTolak');
            const $decisionErrorBox = $('#decisionErrorBox');
            const $decisionStateText   = $('#decisionStateText');
            const $decisionSummaryList = $('#decisionSummaryList');
            const $decisionSummary     = $('#decisionSummary');

            function renderSummary(type) {
                $decisionSummary.removeClass('approve reject').show();
                if (type === 'survey') {
                    $decisionSummary.addClass('approve');
                    $decisionStateText.text('Verifikasi Disetujui');
                    $decisionSummaryList.html(`
                        <li><i class="mdi mdi-check-circle-outline"></i><span>Status booking akan diarahkan ke tahap <strong>Survey</strong>.</span></li>
                        <li><i class="mdi mdi-note-text-outline"></i><span>Isi catatan singkat sebagai referensi untuk tim berikutnya.</span></li>
                        <li><i class="mdi mdi-paperclip"></i><span>Berita acara bisa ditambahkan bila diperlukan untuk arsip.</span></li>
                    `);
                } else if (type === 'rejected') {
                    $decisionSummary.addClass('reject');
                    const tindakan = $('input[name="tindakan"]:checked').val() || 'Lengkapi Dokumen';
                    $decisionStateText.text('Verifikasi Ditolak');
                    $decisionSummaryList.html(`
                        <li><i class="mdi mdi-close-circle-outline"></i><span>Pengajuan tidak dilanjutkan ke tahap survey pada kondisi saat ini.</span></li>
                        <li><i class="mdi mdi-arrow-right-bold-circle-outline"></i><span>Tindakan lanjutan terpilih: <strong>${tindakan}</strong>.</span></li>
                        <li><i class="mdi mdi-note-text-outline"></i><span>Catatan alasan penolakan sebaiknya diisi dengan detail yang jelas.</span></li>
                    `);
                }
            }

            function switchDecision(type) {
                $decisionErrorBox.hide();
                if (type === 'survey') {
                    $statusInput.val('survey');
                    $formSetuju.stop(true, true).slideDown(180);
                    $formTolak.stop(true, true).slideUp(180);
                    renderSummary('survey');
                } else if (type === 'rejected') {
                    $statusInput.val('rejected');
                    $formTolak.stop(true, true).slideDown(180);
                    $formSetuju.stop(true, true).slideUp(180);
                    renderSummary('rejected');
                }
            }

            $decisionApprove.on('change', function () {
                if ($(this).is(':checked')) switchDecision('survey');
            });

            $decisionReject.on('change', function () {
                if ($(this).is(':checked')) switchDecision('rejected');
            });

            $(document).on('change', 'input[name="tindakan"]', function () {
                if ($decisionReject.is(':checked')) renderSummary('rejected');
            });

            $(document).on('change', 'input[type="file"]', function (e) {
                const file = e.target.files[0];
                const $container = $(this).closest('.transaksi-file-upload');
                if (file) {
                    const sizeInMB = (file.size / (1024 * 1024)).toFixed(2);
                    $container.find('.transaksi-file-info span').text(file.name);
                    $container.find('.transaksi-file-info small').text(sizeInMB + ' MB');
                }
            });

            $('#formVerifikasiKpr').on('submit', function (e) {
                if (!$statusInput.val()) {
                    e.preventDefault();
                    $decisionErrorBox.stop(true, true).slideDown(160);
                    $('html, body').animate({ scrollTop: $decisionErrorBox.offset().top - 120 }, 300);
                }
            });

        }); // end document.ready
    </script>

    <script>
        /* =====================================================
           MODAL PREVIEW DOKUMEN — fetch → blob → iframe/img
           Cara kerja:
           - JS fetch file dari storage (raw bytes)
           - Convert ke Blob URL (browser render langsung, tidak download)
           - PDF  → ditampilkan di <iframe> dalam modal
           - Gambar → ditampilkan di <img> dalam modal
           ===================================================== */

        const IMAGE_EXTS = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'bmp'];
        const PDF_EXTS   = ['pdf'];
        let   activeBlobUrl = null;

        function resetPreviewState() {
            $('#previewLoading').removeClass('d-none').css('display', 'flex');
            $('#previewError').addClass('d-none').css('display', 'none');
            $('#iframePreview').addClass('d-none').attr('src', '');
            $('#divImagePreview').addClass('d-none').css('display', 'none');
            $('#imgPreview').attr('src', '');
            if (activeBlobUrl) {
                URL.revokeObjectURL(activeBlobUrl);
                activeBlobUrl = null;
            }
        }

        function showError(url) {
            $('#previewLoading').addClass('d-none').css('display', 'none');
            $('#previewError').removeClass('d-none').css('display', 'flex');
            $('#btnErrorDownload').attr('href', url);
        }

        function previewPdf(blob) {
            activeBlobUrl = URL.createObjectURL(blob);
            const $iframe = $('#iframePreview');
            $iframe.off('load').on('load', function () {
                $('#previewLoading').addClass('d-none').css('display', 'none');
                $iframe.removeClass('d-none');
            });
            $iframe.attr('src', activeBlobUrl);
        }

        function previewImage(blob) {
            activeBlobUrl = URL.createObjectURL(blob);
            const $img = $('#imgPreview');
            $img.off('load error')
                .on('load', function () {
                    $('#previewLoading').addClass('d-none').css('display', 'none');
                    $('#divImagePreview').removeClass('d-none').css('display', 'flex');
                    $('#previewFooterInfo').text($img[0].naturalWidth + ' × ' + $img[0].naturalHeight + ' px');
                })
                .on('error', function () {
                    showError($('#btnDownloadDoc').attr('href'));
                });
            $img.attr('src', activeBlobUrl);
        }

        $(document).on('click', '.btn-preview-doc', function () {
            const url   = $(this).data('url');
            const ext   = $(this).data('ext').toLowerCase();
            const label = $(this).data('label');

            // Set info modal
            $('#modalDocLabel').text(label);
            $('#modalDocExt').text(ext.toUpperCase());
            $('#btnDownloadDoc').attr('href', url);
            $('#btnErrorDownload').attr('href', url);
            $('#previewFooterInfo').text(url.split('/').pop());

            // Icon sesuai tipe
            if (PDF_EXTS.includes(ext)) {
                $('#modalDocIcon').attr('class', 'mdi mdi-file-pdf-box').css('color', '#e53935');
            } else if (IMAGE_EXTS.includes(ext)) {
                $('#modalDocIcon').attr('class', 'mdi mdi-image-outline').css('color', '#1e88e5');
            } else {
                $('#modalDocIcon').attr('class', 'mdi mdi-file-document-outline').css('color', '');
            }

            // Reset & buka modal
            resetPreviewState();
            new bootstrap.Modal(document.getElementById('modalPreviewDokumen')).show();

            // Fetch file → blob
            fetch(url)
                .then(function (res) {
                    if (!res.ok) throw new Error('Fetch failed: ' + res.status);
                    return res.blob();
                })
                .then(function (blob) {
                    if (PDF_EXTS.includes(ext)) {
                        // Paksa MIME type PDF supaya browser render, bukan download
                        const pdfBlob = new Blob([blob], { type: 'application/pdf' });
                        previewPdf(pdfBlob);
                    } else if (IMAGE_EXTS.includes(ext)) {
                        previewImage(blob);
                    } else {
                        showError(url);
                    }
                })
                .catch(function () {
                    showError(url);
                });
        });

        // Bersihkan blob URL saat modal ditutup
        document.getElementById('modalPreviewDokumen').addEventListener('hidden.bs.modal', function () {
            resetPreviewState();
        });
    </script>
@endpush