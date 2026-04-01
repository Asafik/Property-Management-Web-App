@extends('layouts.partial.app')

@section('title', 'Verifikasi KPR - Tahap Akad - Property Management App')

@section('content')
    @php
        $documentsCount = $kpr->documents->whereNotNull('path')->count();
        $missingDocuments = max(0, 8 - $documentsCount);
        $akadSelesai = optional($kpr->booking->akad)->status === 'selesai';
        $isSubsidi = strtolower($kpr->booking->unit->jenis ?? '') === 'subsidi';
        $surveyDone = !empty($kpr->rekomendasi) || strtolower($kpr->status_survey ?? '') == 'done' || ($kpr->booking->status_survey ?? 0) == 1;
        $totalSteps = 6;

        if ($isSubsidi) {
            $currentStep = $akadSelesai ? 6 : 5;
        } else {
            $currentStep = $akadSelesai ? 5 : 4;
        }
        $progressWidth = intval(($currentStep / $totalSteps) * 100);
    @endphp

    <div class="transaksi-page">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div
                            class="customer-header d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between gap-3">
                            <div class="d-flex align-items-center gap-3">
                                <div class="customer-avatar">
                                    <i class="mdi mdi-account text-white" style="font-size: 2.2rem;"></i>
                                </div>
                                <div>
                                    <h4 class="customer-name mb-1 d-flex align-items-center gap-2">
                                        {{ $kpr->booking->customer->full_name ?? '-' }}
                                        @php
                                            $jenis = strtolower($kpr->booking->unit->jenis ?? '');
                                            $badgeClass =
                                                $jenis == 'subsidi'
                                                    ? 'badge-gradient-success'
                                                    : ($jenis == 'komersil'
                                                        ? 'badge-gradient-primary'
                                                        : 'badge-gradient-secondary');
                                        @endphp
                                        <span class="badge {{ $badgeClass }} ms-2"
                                            style="font-size: 0.85rem; padding: 0.4rem 1rem;">
                                            <i class="mdi mdi-home-outline me-1"></i>
                                            {{ strtoupper($kpr->booking->unit->jenis ?? '-') }}
                                        </span>
                                    </h4>
                                    <p class="customer-booking mb-0">Booking ID: {{ $kpr->booking->booking_code ?? '-' }}
                                    </p>
                                </div>
                            </div>

                            <div class="customer-unit-info">
                                <div class="info-item">
                                    <small>Unit</small>
                                    <span>Tipe {{ $kpr->unit->type ?? '-' }}</span>
                                </div>
                                <div class="info-item">
                                    <small>Blok/No</small>
                                    <span>{{ $kpr->unit->unit_code ?? '-' }}</span>
                                </div>
                                <div class="info-item">
                                    <small>Harga Unit</small>
                                    <span class="text-primary fw-bold">Rp
                                        {{ number_format($kpr->unit->price ?? 0, 0, ',', '.') }}</span>
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
                            <span>Tahapan KPR</span>
                        </div>

                        <div class="transaksi-progress-top">
                            <span class="transaksi-muted">Progress Proses</span>
                            <span>Tahap {{ $currentStep }} dari {{ $totalSteps }}</span>
                        </div>

                        <div class="transaksi-progress">
                            <div class="transaksi-progress-bar" style="width: {{ $progressWidth }}%;"></div>
                        </div>

                        <div class="transaksi-steps" style="grid-template-columns: repeat(6, 1fr);">
                            <div class="transaksi-step completed">
                                <div class="transaksi-step-icon">
                                    <i class="mdi mdi-check"></i>
                                </div>
                                <span class="transaksi-step-title">Diajukan</span>
                                <small>{{ $kpr->submitted_at ? \Carbon\Carbon::parse($kpr->submitted_at)->translatedFormat('d F Y') : '-' }}</small>
                            </div>

                            <div class="transaksi-step completed">
                                <div class="transaksi-step-icon">
                                    <i class="mdi mdi-check"></i>
                                </div>
                                <span class="transaksi-step-title">Verifikasi</span>
                                <small>{{ $kpr->approved_at ? \Carbon\Carbon::parse($kpr->approved_at)->translatedFormat('d F Y') : \Carbon\Carbon::parse($kpr->updated_at)->translatedFormat('d F Y') }}</small>
                            </div>

                            @php
                                $status = strtolower($kpr->unit->construction_progress ?? '');

                                $statusText = [
                                    'belum_mulai' => 'Belum mulai pembangunan',
                                    'pondasi' => 'Tahap pondasi',
                                    'dinding' => 'Tahap dinding',
                                    'atap' => 'Tahap atap',
                                    'finishing' => 'Tahap finishing',
                                    'selesai' => 'Pembangunan selesai',
                                ];

                                // pisahin icon & warna biar fleksibel
                                $statusConfig = [
                                    'belum_mulai' => ['icon' => 'mdi-home-city', 'color' => 'secondary'],
                                    'pondasi' => ['icon' => 'mdi-hammer', 'color' => 'warning'],
                                    'dinding' => ['icon' => 'mdi-wall', 'color' => 'warning'],
                                    'atap' => ['icon' => 'mdi-home-roof', 'color' => 'info'],
                                    'finishing' => ['icon' => 'mdi-brush', 'color' => 'primary'],
                                    'selesai' => ['icon' => 'mdi-check-circle', 'color' => 'success'],
                                ];

                                $config = $statusConfig[$status] ?? ['icon' => 'mdi-home-city', 'color' => 'secondary'];
                            @endphp

                            <div class="transaksi-step {{ $status == 'selesai' ? 'completed' : '' }}">
                                @if ($status == 'selesai')
                                    <div class="transaksi-step-icon">
                                        <i class="mdi mdi-check"></i>
                                    </div>
                                @else
                                    <div class="transaksi-step-icon border border-{{ $config['color'] }} text-{{ $config['color'] }}">
                                        <i class="mdi {{ $config['icon'] }}"></i>
                                    </div>
                                @endif

                                <span class="transaksi-step-title">Pembangunan</span>
                                <small>{{ $statusText[$status] ?? '-' }}</small>
                            </div>
                            @if ($isSubsidi)
                                <div class="transaksi-step {{ $surveyDone ? 'completed' : '' }}">
                                    @if ($surveyDone)
                                        <div class="transaksi-step-icon"><i class="mdi mdi-check"></i></div>
                                    @else
                                        <div class="transaksi-step-icon"><i class="mdi mdi-home-search-outline"></i></div>
                                    @endif
                                    <span class="transaksi-step-title">Survey</span>
                                    <small>{{ $surveyDone ? 'Selesai' : 'Menunggu' }}</small>
                                </div>

                                <div class="transaksi-step {{ $akadSelesai ? 'completed' : 'active' }}">
                                    @if ($akadSelesai)
                                        <div class="transaksi-step-icon"><i class="mdi mdi-check"></i></div>
                                    @else
                                        <div class="transaksi-step-icon"><i class="mdi mdi-handshake-outline"></i></div>
                                    @endif
                                    <span class="transaksi-step-title">Akad</span>
                                    <small>{{ $akadSelesai ? 'Selesai' : 'Proses Closing' }}</small>
                                </div>
                            @else
                                <div class="transaksi-step {{ $surveyDone ? 'completed' : ($akadSelesai ? 'active' : '') }}">
                                    @if ($surveyDone)
                                        <div class="transaksi-step-icon"><i class="mdi mdi-check"></i></div>
                                    @else
                                        <div class="transaksi-step-icon"><i class="mdi mdi-home-search-outline"></i></div>
                                    @endif
                                    <span class="transaksi-step-title">Survey</span>
                                    <small>{{ $surveyDone ? 'Selesai' : ($akadSelesai ? 'Progress' : 'Menunggu') }}</small>
                                </div>

                                <div class="transaksi-step {{ $akadSelesai ? 'completed' : 'active' }}">
                                    @if ($akadSelesai)
                                        <div class="transaksi-step-icon"><i class="mdi mdi-check"></i></div>
                                    @else
                                        <div class="transaksi-step-icon"><i class="mdi mdi-handshake-outline"></i></div>
                                    @endif
                                    <span class="transaksi-step-title">Akad</span>
                                    <small>{{ $akadSelesai ? 'Selesai' : 'Proses Closing' }}</small>
                                </div>
                            @endif

                            <div class="transaksi-step">
                                <div class="transaksi-step-icon">
                                    <i class="mdi mdi-home-outline"></i>
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
                            <span>Detail KPR</span>
                        </div>

                        <div class="transaksi-detail-list">
                            <div class="transaksi-detail-item">
                                <span>Bank Tujuan</span>
                                <span>{{ $kpr->bank->bank_name ?? '-' }}</span>
                            </div>
                            <div class="transaksi-detail-item">
                                <span>Jumlah Pinjaman</span>
                                <span>Rp {{ number_format($kpr->jumlah_pinjaman ?? 0, 0, ',', '.') }}</span>
                            </div>
                            <div class="transaksi-detail-item">
                                <span>Tenor</span>
                                <span>{{ $kpr->tenor ?? '-' }} Tahun</span>
                            </div>
                            <div class="transaksi-detail-item">
                                <span>Angsuran / bln</span>
                                <span class="highlight">Rp
                                    {{ number_format($kpr->estimasi_angsuran ?? 0, 0, ',', '.') }}</span>
                            </div>
                        </div>

                        <hr class="my-4">

                        <small class="transaksi-muted d-block mb-2">Ditangani oleh</small>
                        <div class="transaksi-handler">
                            <div class="transaksi-handler-icon">
                                <i class="mdi mdi-account-tie"></i>
                            </div>
                            <div>
                                <div class="fw-bold">{{ $kpr->booking->sales->name ?? '-' }}</div>
                                {{-- <small class="transaksi-muted">{{ $kpr->booking->sales->role ?? '-' }}</small> --}}
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
                            <i class="mdi mdi-file-document-multiple-outline"></i>
                            <span>Kelengkapan Dokumen</span>
                        </div>

                        @if ($documentsCount < 8)
                            <div class="transaksi-inline-alert warning">
                                <i class="mdi mdi-alert-circle-outline"></i>
                                <div>
                                    Masih ada
                                    <strong>{{ $missingDocuments }} dokumen</strong>
                                    yang perlu dilengkapi sebelum proses akad final berjalan optimal.
                                </div>
                            </div>
                        @else
                            <div class="transaksi-inline-alert success">
                                <i class="mdi mdi-check-circle-outline"></i>
                                <div>Semua dokumen utama telah tersedia dan siap untuk ditinjau pada tahap akad.</div>
                            </div>
                        @endif

                        <div class="table-responsive">
                            <table class="table transaksi-doc-table align-middle mb-0">
                                <thead>
                                    <tr>
                                        <th style="width: 40%;">Nama Dokumen</th>
                                        <th style="width: 20%;">Status</th>
                                        <th style="width: 20%;">Tanggal Upload</th>
                                        <th style="width: 20%;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($kpr->documents as $doc)
                                        <tr>
                                            <td>
                                                <div class="transaksi-doc-name">
                                                    <div class="transaksi-doc-icon">
                                                        <i class="mdi mdi-file-document-outline"></i>
                                                    </div>
                                                    <div>
                                                        <div>{{ strtoupper(str_replace('_', ' ', $doc->type ?? '-')) }}
                                                        </div>
                                                        <small
                                                            class="transaksi-muted">{{ $doc->path ? 'Siap direview' : 'Perlu dilengkapi' }}</small>
                                                    </div>
                                                </div>
                                            </td>

                                            <td>
                                                @if ($doc->path)
                                                    <span class="badge bg-success">Lengkap</span>
                                                @else
                                                    <span class="badge bg-danger">Kurang</span>
                                                @endif
                                            </td>

                                            <td>
                                                <span class="transaksi-muted">
                                                    {{ $doc->created_at ? \Carbon\Carbon::parse($doc->created_at)->translatedFormat('d M Y') : '-' }}
                                                </span>
                                            </td>

                                            <td>
                                                @if ($doc->path)
                                                    <a href="{{ asset('uploads/' . $doc->path) }}" target="_blank"
                                                        class="transaksi-doc-action" title="Lihat dokumen">
                                                        <i class="mdi mdi-eye-outline"></i>
                                                    </a>
                                                @else
                                                    <button type="button" class="transaksi-doc-action disabled"
                                                        title="Dokumen belum tersedia" disabled>
                                                        <i class="mdi mdi-eye-off-outline"></i>
                                                    </button>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center text-muted">Belum ada data dokumen</td>
                                        </tr>
                                    @endforelse
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
                                <span>Informasi Akad</span>
                            </div>

                            <div class="mb-3">
                                @if ($akadSelesai)
                                    <div class="transaksi-status-banner success">
                                        <i class="mdi mdi-check-circle-outline"></i>
                                        Akad Sudah Selesai
                                    </div>
                                @else
                                    <div class="transaksi-status-banner warning">
                                        <i class="mdi mdi-handshake-outline"></i>
                                        Menunggu Proses Akad
                                    </div>
                                @endif
                            </div>

                            <div class="transaksi-summary-grid">
                                <div class="transaksi-summary-box success">
                                    <div class="label">Dokumen Lengkap</div>
                                    <div class="value">{{ $documentsCount }}</div>
                                </div>
                                <div class="transaksi-summary-box danger">
                                    <div class="label">Dokumen Kurang</div>
                                    <div class="value">{{ $missingDocuments }}</div>
                                </div>
                            </div>

                            <div class="transaksi-sidebar-section">
                                <div class="transaksi-sidebar-title">Rekomendasi Sistem</div>
                                @if ($documentsCount >= 8)
                                    <div class="transaksi-inline-alert success mb-0">
                                        <i class="mdi mdi-check-decagram-outline"></i>
                                        <div>Dokumen sudah lengkap. Proses akad dapat dilanjutkan ke tahap berikutnya.</div>
                                    </div>
                                @else
                                    <div class="transaksi-inline-alert warning mb-0">
                                        <i class="mdi mdi-file-alert-outline"></i>
                                        <div>Masih ada dokumen yang perlu dilengkapi agar proses akad berjalan lebih aman
                                            dan jelas.</div>
                                    </div>
                                @endif
                            </div>

                            <div class="transaksi-sidebar-section">
                                <div class="transaksi-sidebar-title">Rencana Akad</div>
                                <ul class="transaksi-mini-list mb-0">
                                    <li>
                                        <i class="mdi mdi-calendar-outline"></i>
                                        <span>Rencana akad:
                                            {{ optional($kpr->booking->akad)->tanggal_akad
                                                ? \Carbon\Carbon::parse($kpr->booking->akad->tanggal_akad)->translatedFormat('d F Y')
                                                : '20 Maret 2025' }}
                                        </span>
                                    </li>
                                    <li>
                                        <i class="mdi mdi-map-marker-outline"></i>
                                        <span>Lokasi:
                                            {{ optional($kpr->booking->akad)->lokasi_akad ?? 'Kantor Notaris Siti, SH' }}
                                        </span>
                                    </li>
                                    <li>
                                        <i class="mdi mdi-account-tie-outline"></i>
                                        <span>Notaris:
                                            {{ optional($kpr->booking->akad)->nama_notaris ?? 'Siti Nurhaliza, SH' }}
                                        </span>
                                    </li>

                                    {{-- Tambahan Dokumen Akad --}}
                                    <li>
                                        <i class="mdi mdi-file-document-outline"></i>
                                        <span>
                                            Dokumen:
                                            @if (optional($kpr->booking->akad)->dokumen)
                                                <a href="{{ asset('uploads/' . $kpr->booking->akad->dokumen) }}"
                                                    target="_blank" class="btn btn-sm btn-primary ms-2">
                                                    Lihat
                                                </a>
                                            @else
                                                <span class="text-muted">Belum tersedia</span>
                                            @endif
                                        </span>
                                    </li>
                                </ul>
                            </div>

                            @if ($akadSelesai)
                                <div class="transaksi-sidebar-section">
                                    <div class="transaksi-sidebar-title">Langkah Berikutnya</div>
                                    <a href="{{ route('kpr.serahterima', $kpr->id) }}"
                                        class="transaksi-btn transaksi-btn-primary w-100 justify-content-center">
                                        <i class="mdi mdi-home-check-outline"></i>
                                        Proses Serah Terima
                                    </a>
                                </div>
                            @endif
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
                            <i class="mdi mdi-handshake-outline"></i>
                            <span>Proses Akad</span>
                        </div>

                        <div class="transaksi-inline-alert info mb-4" id="akadHint">
                            <i class="mdi mdi-information-outline"></i>
                            <div>Pilih salah satu status di bawah ini. Form akan menyesuaikan secara otomatis sesuai hasil
                                proses akad.</div>
                        </div>

                        <form action="{{ route('akad.kpr.store', $kpr->booking_id) }}" method="POST"
                            enctype="multipart/form-data" id="formProsesAkad">
                            @csrf
                            <input type="hidden" name="status" id="statusAkadInput" value="">

                            <div class="row g-3 mb-3 align-items-stretch">
                                <div class="col-12 col-md-6 d-flex">
                                    <div class="akad-choice-card success w-100">
                                        <input type="radio" name="akad_choice" id="choiceSelesai" value="completed">
                                        <label for="choiceSelesai" class="akad-choice-label">
                                            <div class="akad-choice-icon">
                                                <i class="mdi mdi-check-bold"></i>
                                            </div>
                                            <div class="akad-choice-content">
                                                <div class="akad-choice-title">Selesai Akad</div>
                                                <p class="akad-choice-desc mb-0">
                                                    Dokumen dan proses closing telah selesai dan siap lanjut ke tahap
                                                    berikutnya.
                                                </p>
                                            </div>
                                            <div class="akad-choice-check">
                                                <i class="mdi mdi-check-circle"></i>
                                            </div>
                                        </label>
                                    </div>
                                </div>

                                <div class="col-12 col-md-6 d-flex">
                                    <div class="akad-choice-card danger w-100">
                                        <input type="radio" name="akad_choice" id="choiceTunda" value="cancelled">
                                        <label for="choiceTunda" class="akad-choice-label">
                                            <div class="akad-choice-icon">
                                                <i class="mdi mdi-alert-outline"></i>
                                            </div>
                                            <div class="akad-choice-content">
                                                <div class="akad-choice-title">Tolak akad / Bermasalah</div>
                                                <p class="akad-choice-desc mb-0">
                                                    Ada kendala saat proses akad dan perlu tindak lanjut lebih lanjut.
                                                </p>
                                            </div>
                                            <div class="akad-choice-check">
                                                <i class="mdi mdi-check-circle"></i>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div id="formSelesai" class="akad-form-shell success">
                                <div class="akad-form-title success">Form Penyelesaian Akad</div>

                                <div class="transaksi-inline-alert success">
                                    <i class="mdi mdi-check-circle-outline"></i>
                                    <div><strong>Akad selesai.</strong> Pengajuan dapat diarahkan ke proses <strong>Serah
                                            Terima</strong>.</div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="akad-form-group">
                                            <label class="akad-form-label">Tanggal Akad</label>
                                            <input type="date" class="akad-form-control" name="tanggal_akad"
                                                value="{{ optional($kpr->booking->akad)->tanggal_akad ?? '2025-03-20' }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="akad-form-group">
                                            <label class="akad-form-label">Lokasi Akad</label>
                                            <input type="text" class="akad-form-control" name="lokasi_akad"
                                                value="{{ optional($kpr->booking->akad)->lokasi_akad ?? 'Kantor Notaris Siti, SH' }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="akad-form-group">
                                            <label class="akad-form-label">Nama Notaris</label>
                                            <input type="text" class="akad-form-control" name="nama_notaris"
                                                value="{{ optional($kpr->booking->akad)->nama_notaris ?? 'Siti Nurhaliza, SH' }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="akad-form-group">
                                            <label class="akad-form-label">Nomor Akad</label>
                                            <input type="text" class="akad-form-control" name="nomor_akad"
                                                id="no_akad"
                                                value="{{ $noAkadDraf }}"
                                                placeholder="Kosongkan untuk otomatis (opsional)">
                                        </div>
                                    </div>
                                </div>

                                <div class="akad-form-group">
                                    <label class="akad-form-label">Upload Dokumen Akad</label>
                                    <div class="verifikasi-file-upload">
                                        <input type="file" name="dokumen_akad" accept=".jpg,.jpeg,.png,.pdf">
                                        <div class="verifikasi-file-label">
                                            <i class="mdi mdi-cloud-upload"></i>
                                            <div class="verifikasi-file-info">
                                                <span>Upload Dokumen Akad</span>
                                                <small>Format: JPG, PNG, PDF (Max 5MB)</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="akad-form-group mb-0">
                                    <label class="akad-form-label">Catatan Akad</label>
                                    <textarea class="akad-form-control" name="catatan" rows="3"
                                        placeholder="Contoh: Proses akad selesai, seluruh dokumen telah ditandatangani dan siap lanjut serah terima."></textarea>
                                </div>
                            </div>

                            <div id="formTunda" class="akad-form-shell danger">
                                <div class="akad-form-title danger">Form Penundaan / Kendala Akad</div>

                                <div class="transaksi-inline-alert danger">
                                    <i class="mdi mdi-alert-circle-outline"></i>
                                    <div><strong>Akad ditunda atau bermasalah.</strong> Pilih alasan dan tindakan lanjutan
                                        agar proses tetap jelas untuk tim dan customer.</div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="akad-form-group">
                                            <label class="akad-form-label">Nomor Akad</label>
                                            <input type="text" class="akad-form-control" id="nomor_akad_tunda"
                                                value="{{ optional($kpr->booking->akad)->nomor_akad ?? 'AKD/2025/03/123' }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="akad-form-group">
                                            <label class="akad-form-label">Tanggal Akad</label>
                                            <input type="date" class="akad-form-control" name="tanggal_akad_tolak"
                                                value="{{ optional($kpr->booking->akad)->tanggal_akad ?? date('Y-m-d') }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="akad-form-group">
                                    <label class="akad-form-label">Upload Dokumen Pendukung</label>
                                    <div class="verifikasi-file-upload">
                                        <input type="file" name="dokumen_tolak" accept=".jpg,.jpeg,.png,.pdf">
                                        <div class="verifikasi-file-label">
                                            <i class="mdi mdi-cloud-upload"></i>
                                            <div class="verifikasi-file-info">
                                                <span>Upload Dokumen Pendukung</span>
                                                <small>Format: JPG, PNG, PDF (Max 5MB)</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="akad-form-group">
                                    <label class="akad-form-label">Alasan Penundaan</label>
                                    <select class="akad-form-control" name="alasan_masalah">
                                        <option value="jadwal_belum_cocok">Jadwal Belum Cocok</option>
                                        <option value="dokumen_kurang">Dokumen Kurang Lengkap</option>
                                        <option value="customer_belum_siap">Customer Belum Siap</option>
                                        <option value="bank_belum_terbit">SP3K Belum Terbit</option>
                                        <option value="lainnya">Lainnya</option>
                                    </select>
                                </div>

                                <div class="akad-form-group">
                                    <label class="akad-form-label">Catatan / Keterangan</label>
                                    <textarea class="akad-form-control" name="catatan_masalah" rows="3"
                                        placeholder="Jelaskan detail kendala akad secara spesifik..."></textarea>
                                </div>

                                <div class="akad-form-group mb-0">
                                    <label class="akad-form-label">Tindakan Selanjutnya</label>

                                    <div class="akad-next-grid">
                                        <div class="akad-next-card">
                                            <input type="radio" name="tindakan" id="tindakanJadwalUlang"
                                                value="jadwal_ulang" checked>
                                            <label class="akad-next-label" for="tindakanJadwalUlang">
                                                <div class="akad-next-icon">
                                                    <i class="mdi mdi-calendar-clock-outline"></i>
                                                </div>
                                                <div class="akad-next-content">
                                                    <span class="akad-next-title">Jadwal Ulang</span>
                                                    <span class="akad-next-desc">Atur ulang jadwal akad dengan pihak
                                                        customer, bank, dan notaris.</span>
                                                </div>
                                                <div class="akad-next-check">
                                                    <i class="mdi mdi-check-circle"></i>
                                                </div>
                                            </label>
                                        </div>

                                        <div class="akad-next-card">
                                            <input type="radio" name="tindakan" id="tindakanLengkapi"
                                                value="lengkapi_dokumen">
                                            <label class="akad-next-label" for="tindakanLengkapi">
                                                <div class="akad-next-icon">
                                                    <i class="mdi mdi-file-document-edit-outline"></i>
                                                </div>
                                                <div class="akad-next-content">
                                                    <span class="akad-next-title">Lengkapi Dokumen</span>
                                                    <span class="akad-next-desc">Dokumen perlu dilengkapi sebelum akad
                                                        dilanjutkan kembali.</span>
                                                </div>
                                                <div class="akad-next-check">
                                                    <i class="mdi mdi-check-circle"></i>
                                                </div>
                                            </label>
                                        </div>

                                        <div class="akad-next-card">
                                            <input type="radio" name="tindakan" id="tindakanKoordinasiBank"
                                                value="koordinasi_ulang_dengan_bank">
                                            <label class="akad-next-label" for="tindakanKoordinasiBank">
                                                <div class="akad-next-icon">
                                                    <i class="mdi mdi-bank-transfer"></i>
                                                </div>
                                                <div class="akad-next-content">
                                                    <span class="akad-next-title">Koordinasi Ulang Bank</span>
                                                    <span class="akad-next-desc">Lakukan follow up ulang ke pihak bank
                                                        untuk kendala administrasi/SP3K.</span>
                                                </div>
                                                <div class="akad-next-check">
                                                    <i class="mdi mdi-check-circle"></i>
                                                </div>
                                            </label>
                                        </div>

                                        <div class="akad-next-card">
                                            <input type="radio" name="tindakan" id="tindakanReviewInternal"
                                                value="review_internal">
                                            <label class="akad-next-label" for="tindakanReviewInternal">
                                                <div class="akad-next-icon">
                                                    <i class="mdi mdi-clipboard-search-outline"></i>
                                                </div>
                                                <div class="akad-next-content">
                                                    <span class="akad-next-title">Review Internal</span>
                                                    <span class="akad-next-desc">Perlu review tambahan dari tim internal
                                                        sebelum menentukan jadwal berikutnya.</span>
                                                </div>
                                                <div class="akad-next-check">
                                                    <i class="mdi mdi-check-circle"></i>
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="akad-action-bar">
                                <a href="{{ url('/marketing/kpr') }}" class="transaksi-btn transaksi-btn-secondary">
                                    <i class="mdi mdi-arrow-left"></i>
                                    Kembali
                                </a>

                                <button type="submit" class="transaksi-btn transaksi-btn-primary">
                                    <i class="mdi mdi-content-save-outline"></i>
                                    Simpan Proses Akad
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
                                <span>Panduan Proses</span>
                            </div>

                            <div class="transaksi-sidebar-section">
                                <div class="transaksi-sidebar-title">Saat Akad Selesai</div>
                                <ul class="transaksi-mini-list mb-0">
                                    <li>
                                        <i class="mdi mdi-arrow-right-circle-outline"></i>
                                        <span>Gunakan jika seluruh proses penandatanganan dan closing telah selesai tanpa
                                            kendala material.</span>
                                    </li>
                                    <li>
                                        <i class="mdi mdi-arrow-right-circle-outline"></i>
                                        <span>Isi tanggal, lokasi, notaris, dan nomor akad agar arsip proses lengkap.</span>
                                    </li>
                                    <li>
                                        <i class="mdi mdi-arrow-right-circle-outline"></i>
                                        <span>Upload dokumen akad bila sudah tersedia sebagai bukti administrasi.</span>
                                    </li>
                                </ul>
                            </div>

                            <div class="transaksi-sidebar-section">
                                <div class="transaksi-sidebar-title">Saat Ditunda / Bermasalah</div>
                                <ul class="transaksi-mini-list mb-0">
                                    <li>
                                        <i class="mdi mdi-arrow-right-circle-outline"></i>
                                        <span>Gunakan jika ada hambatan jadwal, dokumen, kesiapan customer, atau proses dari
                                            bank/notaris.</span>
                                    </li>
                                    <li>
                                        <i class="mdi mdi-arrow-right-circle-outline"></i>
                                        <span>Jelaskan alasan kendala secara spesifik dan mudah ditindaklanjuti.</span>
                                    </li>
                                    <li>
                                        <i class="mdi mdi-arrow-right-circle-outline"></i>
                                        <span>Pilih tindakan lanjutan yang paling relevan agar proses berikutnya tidak
                                            ambigu.</span>
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

    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal Proses',
                text: '{{ session('error') }}',
                confirmButtonText: 'OK'
            });
        </script>
    @endif

    <script>
        $(document).ready(function() {
            const $choiceSelesai = $('#choiceSelesai');
            const $choiceTunda = $('#choiceTunda');
            const $statusInput = $('#statusAkadInput');
            const $formSelesai = $('#formSelesai');
            const $formTunda = $('#formTunda');

            function switchAkad(type) {
                if (type === 'completed') {
                    $statusInput.val('completed');
                    $formSelesai.stop(true, true).slideDown(180);
                    $formTunda.stop(true, true).slideUp(180);
                    $('#nomor_akad_selesai').attr('name', 'nomor_akad');
                    $('#nomor_akad_tunda').removeAttr('name');
                } else if (type === 'cancelled') {
                    $statusInput.val('cancelled');
                    $formTunda.stop(true, true).slideDown(180);
                    $formSelesai.stop(true, true).slideUp(180);
                    $('#nomor_akad_tunda').attr('name', 'nomor_akad');
                    $('#nomor_akad_selesai').removeAttr('name');
                }
            }

            $choiceSelesai.on('change', function() {
                if ($(this).is(':checked')) {
                    switchAkad('completed');
                }
            });

            $choiceTunda.on('change', function() {
                if ($(this).is(':checked')) {
                    switchAkad('cancelled');
                }
            });

            $(document).on('change', 'input[type="file"]', function(e) {
                const file = e.target.files[0];
                const $container = $(this).closest('.verifikasi-file-upload');

                if (file) {
                    const sizeInMB = (file.size / (1024 * 1024)).toFixed(2);
                    $container.find('.verifikasi-file-info span').text(file.name);
                    $container.find('.verifikasi-file-info small').text(sizeInMB + ' MB');
                }
            });
        });
    </script>
@endpush
