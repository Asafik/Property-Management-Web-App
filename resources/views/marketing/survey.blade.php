@extends('layouts.partial.app')

@section('title', 'Survey KPR - Properti Management')

@section('content')
    <style>
        /* Style spesifik halaman survey yang tidak ada di global */
        .survey-checklist-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 12px;
        }

        .survey-checkbox-wrapper {
            position: relative;
        }

        .survey-checkbox-input {
            position: absolute;
            opacity: 0;
            width: 0;
            height: 0;
        }

        .survey-checkbox-label {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 0.9rem 1rem;
            background: linear-gradient(135deg, #f9f7ff, #f2ecff);
            border: 2px solid rgba(154, 85, 255, 0.2);
            border-radius: 14px;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(154, 85, 255, 0.08);
            min-height: 64px;
        }

        .survey-checkbox-input:checked+.survey-checkbox-label {
            border-color: var(--primary);
            background: linear-gradient(135deg, #f1f0ff, #e8e0ff);
            box-shadow: 0 5px 15px rgba(154, 85, 255, 0.2);
        }

        .survey-check-icon {
            font-size: 1.45rem;
            color: #d0d4db;
            background: white;
            border-radius: 50%;
            padding: 4px;
        }

        .survey-checkbox-input:checked+.survey-checkbox-label .survey-check-icon {
            color: var(--primary);
        }

        .survey-input-group {
            display: flex;
            width: 100%;
        }

        .survey-input-group-text {
            display: flex;
            align-items: center;
            padding: 0.78rem 0.85rem;
            font-size: 0.85rem;
            color: var(--gray-600);
            background: #f8f9fa;
            border: 1px solid var(--gray-300);
            border-radius: var(--radius-md) 0 0 var(--radius-md);
            border-right: none;
        }

        .survey-input-group .transaksi-form-control {
            border-radius: 0 var(--radius-md) var(--radius-md) 0;
        }

        @media (max-width: 767.98px) {
            .survey-checklist-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <div class="transaksi-page">
        {{-- HEADER CUSTOMER --}}
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div
                            class="customer-header d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between gap-3">
                            <div class="d-flex align-items-center gap-3">
                                <div class="customer-avatar">
                                    <i class="mdi mdi-account text-white"></i>
                                </div>
                                <div>
                                    <h4 class="customer-name mb-1 d-flex align-items-center gap-2">
                                        {{ $application->customer->full_name ?? '-' }}
                                        @php
                                            $jenis = strtolower($application->unit->jenis ?? '');
                                            $badgeClass =
                                                $jenis == 'subsidi'
                                                    ? 'badge-gradient-success'
                                                    : ($jenis == 'komersil'
                                                        ? 'badge-gradient-primary'
                                                        : 'badge-gradient-secondary');
                                            $icon =
                                                $jenis == 'subsidi'
                                                    ? 'mdi-home-assistant'
                                                    : ($jenis == 'komersil'
                                                        ? 'mdi-office-building'
                                                        : 'mdi-help-circle-outline');
                                        @endphp
                                        <span class="badge {{ $badgeClass }}">
                                            <i class="mdi {{ $icon }} me-1"></i>
                                            {{ strtoupper($application->unit->jenis ?? '-') }}
                                        </span>
                                    </h4>
                                    <p class="customer-booking mb-0">
                                        Booking ID: {{ optional($application->unit->activeBooking)->booking_code ?? '-' }}
                                    </p>
                                </div>
                            </div>

                            <div class="customer-unit-info">
                                <div class="info-item">
                                    <small>Unit</small>
                                    <span>{{ $application->unit->unit_name ?? '-' }}</span>
                                </div>
                                <div class="info-item">
                                    <small>Blok/No</small>
                                    <span>{{ $application->unit->unit_code ?? '-' }}</span>
                                </div>
                                <div class="info-item">
                                    <small>Harga Unit</small>
                                    <span class="highlight">
                                        Rp {{ number_format($application->unit->price ?? 0, 0, ',', '.') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if (session('error'))
            <div class="row mt-3">
                <div class="col-12">
                    <div class="transaksi-inline-alert danger">
                        <i class="mdi mdi-alert-circle"></i>
                        {{ session('error') }}
                    </div>
                </div>
            </div>
        @endif

        {{-- PROGRESS & DETAIL --}}
        <div class="row mt-4">
            <div class="col-12 col-lg-8 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="transaksi-section-title">
                            <i class="mdi mdi-timeline-text"></i>
                            <span>Tahapan Survey KPR</span>
                        </div>

                        @php
                            $jenis = strtolower($application->unit->jenis ?? '');
                            $isSubsidi = $jenis === 'subsidi';
                            $surveyDone =
                                !empty($application->rekomendasi) ||
                                strtolower($application->status_survey ?? '') == 'done' ||
                                ($application->booking->status_survey ?? 0) == 1;

                            $spkDone = !empty($application->unit->dokumen_spk);

                            $totalSteps = 7;
                            // Jika subsidi, Survey adalah tahap 5. Jika komersil, Survey tahap 5.
                            $currentStep = 5;
                            $progressWidth = intval(($currentStep / $totalSteps) * 100);
                            $stepsStyle = $totalSteps
                                ? 'style="grid-template-columns: repeat(' . $totalSteps . ', 1fr);"'
                                : '';
                        @endphp

                        <div class="transaksi-progress-top">
                            <span class="transaksi-muted">Progress Survey</span>
                            <span>Tahap {{ $currentStep }} dari {{ $totalSteps }}</span>
                        </div>

                        <div class="transaksi-progress">
                            <div class="transaksi-progress-bar" style="width: {{ $progressWidth }}%;"></div>
                        </div>

                        <div class="transaksi-steps" {!! $stepsStyle !!}>
                            <div class="transaksi-step completed">
                                <div class="transaksi-step-icon"><i class="mdi mdi-check"></i></div>
                                <span class="transaksi-step-title">Pengajuan</span>
                                <small>{{ \Carbon\Carbon::parse($application->created_at)->translatedFormat('j F Y') }}</small>
                            </div>

                            <div class="transaksi-step completed">
                                <div class="transaksi-step-icon"><i class="mdi mdi-check"></i></div>
                                <span class="transaksi-step-title">Verifikasi</span>
                                <small>{{ $application->submitted_at ? \Carbon\Carbon::parse($application->submitted_at)->translatedFormat('j F Y') : '-' }}</small>
                            </div>

                            <div class="transaksi-step {{ $spkDone ? 'completed' : '' }}">
                                <div class="transaksi-step-icon">
                                    <i class="mdi {{ $spkDone ? 'mdi-check' : 'mdi-clipboard-text' }}"></i>
                                </div>
                                <span class="transaksi-step-title">SPK</span>
                                <small>{{ $spkDone ? 'Selesai' : 'Menunggu' }}</small>
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
                                    <div
                                        class="transaksi-step-icon border border-{{ $config['color'] }} text-{{ $config['color'] }}">
                                        <i class="mdi {{ $config['icon'] }}"></i>
                                    </div>
                                @endif

                                <span class="transaksi-step-title">Pembangunan</span>
                                <small>{{ $statusText[$status] ?? '-' }}</small>
                            </div>

                            @if ($isSubsidi)
                                <div class="transaksi-step {{ $surveyDone ? 'completed' : 'active' }}">
                                    @if ($surveyDone)
                                        <div class="transaksi-step-icon"><i class="mdi mdi-check"></i></div>
                                    @else
                                        <div class="transaksi-step-icon"><i class="mdi mdi-home-search-outline"></i></div>
                                    @endif
                                    <span class="transaksi-step-title">Survey</span>
                                    <small>{{ $surveyDone ? 'Selesai' : 'Progress' }}</small>
                                </div>

                                <div class="transaksi-step">
                                    <div class="transaksi-step-icon"><i class="mdi mdi-handshake-outline"></i></div>
                                    <span class="transaksi-step-title">Akad</span>
                                    <small>Menunggu</small>
                                </div>
                            @else
                                <div class="transaksi-step {{ $surveyDone ? 'completed' : 'active' }}">
                                    @if ($surveyDone)
                                        <div class="transaksi-step-icon"><i class="mdi mdi-check"></i></div>
                                    @else
                                        <div class="transaksi-step-icon"><i class="mdi mdi-home-search-outline"></i></div>
                                    @endif
                                    <span class="transaksi-step-title">Survey</span>
                                    <small>{{ $surveyDone ? 'Selesai' : 'Progress' }}</small>
                                </div>

                                <div class="transaksi-step">
                                    <div class="transaksi-step-icon"><i class="mdi mdi-handshake-outline"></i></div>
                                    <span class="transaksi-step-title">Akad</span>
                                    <small>Menunggu</small>
                                </div>
                            @endif

                            <div class="transaksi-step">
                                <div class="transaksi-step-icon"><i class="mdi mdi-cash-fast"></i></div>
                                <span class="transaksi-step-title">Serah Terima</span>
                                <small>Menunggu</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-4 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="transaksi-section-title">
                            <i class="mdi mdi-bank-outline"></i>
                            <span>Detail KPR</span>
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
                                <span class="highlight">Rp
                                    {{ number_format($application->estimasi_angsuran ?? 0, 0, ',', '.') }}</span>
                            </div>
                        </div>

                        <hr class="my-4">

                        <small class="transaksi-muted d-block mb-2">Ditangani oleh</small>
                        <div class="transaksi-handler">
                            <div class="transaksi-handler-icon">
                                <i class="mdi mdi-account-tie"></i>
                            </div>
                            <div>
                                <div class="fw-bold">{{ $application->booking->sales->name ?? '-' }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- FORM SURVEY --}}
        <div class="row mt-2">
            <div class="col-12 col-lg-8">
                <form id="formSurveyKpr" action="{{ route('kpr.survey.store', $application->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-body">
                            <div class="transaksi-section-title">
                                <i class="mdi mdi-home-map-marker"></i>
                                <span>Form Survey Lapangan</span>
                            </div>

                            <div class="transaksi-inline-alert info">
                                <i class="mdi mdi-information-outline"></i>
                                <div>Isi hasil survey unit dengan lengkap untuk penilaian bank.</div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="transaksi-form-group">
                                        <label class="transaksi-form-label">Tanggal Survey</label>
                                        <input type="date" class="transaksi-form-control" name="survey_date"
                                            value="{{ $application->survey_date?->format('Y-m-d') ?? '' }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="transaksi-form-group">
                                        <label class="transaksi-form-label">Jam Survey</label>
                                        <input type="time" class="transaksi-form-control" name="survey_time"
                                            value="{{ $application->survey_time?->format('H:i') ?? '' }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="transaksi-form-group">
                                        <label class="transaksi-form-label">Surveyor</label>
                                        <select class="transaksi-form-control" name="surveyor_id">
                                            <option value="">Pilih Surveyor</option>
                                            @foreach ($surveyors as $surveyor)
                                                <option value="{{ $surveyor->id }}"
                                                    {{ $application->surveyor_id == $surveyor->id ? 'selected' : '' }}>
                                                    {{ $surveyor->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <hr class="my-4">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="transaksi-form-group">
                                        <label class="transaksi-form-label">Nilai Pasar Unit <span
                                                class="text-danger">*</span></label>
                                        <div class="survey-input-group">
                                            <span class="survey-input-group-text">Rp</span>
                                            <input type="text" class="transaksi-form-control" name="harga_unit"
                                                value="{{ number_format($application->harga_unit ?? 0, 0, ',', '.') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="transaksi-form-group">
                                        <label class="transaksi-form-label">Nilai Appraisal <span
                                                class="text-danger">*</span></label>
                                        <div class="survey-input-group">
                                            <span class="survey-input-group-text">Rp</span>
                                            <input type="text" class="transaksi-form-control" name="appraisal_value"
                                                value="{{ number_format($application->jumlah_pinjaman ?? 0, 0, ',', '.') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr class="my-4">

                            <div class="transaksi-section-title mb-3">
                                <i class="mdi mdi-checkbox-marked-outline"></i>
                                <span>Checklist Kondisi Unit</span>
                            </div>

                            <div class="survey-checklist-grid">
                                @foreach (['listrik' => 'Instalasi Listrik', 'air' => 'PDAM / Air Bersih', 'akses' => 'Akses Jalan', 'sertifikat' => 'Sertifikat Sesuai', 'imb' => 'IMB'] as $field => $label)
                                    <div class="survey-checkbox-wrapper">
                                        <input type="checkbox" class="survey-checkbox-input" id="{{ $field }}"
                                            name="{{ $field }}" {{ $application->$field ? 'checked' : '' }}>
                                        <label class="survey-checkbox-label" for="{{ $field }}">
                                            <i class="mdi mdi-check-circle survey-check-icon"></i>
                                            <span class="survey-check-text">{{ $label }}</span>
                                        </label>
                                    </div>
                                @endforeach
                            </div>

                            <hr class="my-4">

                            <div class="transaksi-section-title mb-3">
                                <i class="mdi mdi-camera-outline"></i>
                                <span>Dokumentasi Survey</span>
                            </div>

                            <div class="row">
                                @foreach (['foto_depan' => 'Foto Depan', 'foto_interior' => 'Foto Interior', 'foto_lingkungan' => 'Foto Lingkungan'] as $field => $label)
                                    <div class="col-md-4">
                                        <div class="transaksi-form-group">
                                            <label class="transaksi-form-label">{{ $label }}</label>
                                            <div class="transaksi-file-upload">
                                                <input type="file" name="{{ $field }}"
                                                    accept=".jpg,.jpeg,.png">
                                                <div class="transaksi-file-label">
                                                    <i class="mdi mdi-camera"></i>
                                                    <div class="transaksi-file-info">
                                                        <span>Upload Foto</span>
                                                        <small>Format: JPG, PNG</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <hr class="my-4">

                            <div class="transaksi-form-group">
                                <label class="transaksi-form-label">Catatan Survey</label>
                                <textarea class="transaksi-form-control" name="catatan_survey" rows="3">{{ $application->catatan_survey ?? '' }}</textarea>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="transaksi-form-group">
                                        <label class="transaksi-form-label">Rekomendasi</label>
                                        <select class="transaksi-form-control" name="rekomendasi">
                                            <option value="">Pilih Kelayakan</option>
                                            <option value="Layak"
                                                {{ $application->rekomendasi == 'Layak' ? 'selected' : '' }}>Layak</option>
                                            <option value="Tidak Layak"
                                                {{ $application->rekomendasi == 'Tidak Layak' ? 'selected' : '' }}>Tidak
                                                Layak</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <button type="submit"
                                class="transaksi-btn transaksi-btn-primary w-100 justify-content-center mt-3">
                                <i class="mdi mdi-content-save-outline"></i> Simpan Hasil Survey
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            {{-- SIDEBAR RINGKASAN --}}
            <div class="col-12 col-lg-4">
                <div class="transaksi-sticky">
                    <div class="card">
                        <div class="card-body">
                            <div class="transaksi-section-title">
                                <i class="mdi mdi-clipboard-text-outline"></i>
                                <span>Ringkasan Survey</span>
                            </div>

                            <div class="mb-3">
                                @if ($application->status === 'survey')
                                    <div class="transaksi-status-banner success">
                                        <i class="mdi mdi-check-circle-outline"></i> Sudah selesai melakukan survey
                                    </div>
                                @else
                                    <div class="transaksi-status-banner warning">
                                        <i class="mdi mdi-progress-clock"></i> Menunggu Survey
                                    </div>
                                @endif
                            </div>

                            <div class="transaksi-summary-grid">
                                <div class="transaksi-summary-box success">
                                    <div class="label">Appraisal</div>
                                    <div class="value" style="font-size: 0.95rem; font-weight: 700;">
                                        Rp {{ number_format($application->jumlah_pinjaman ?? 0, 0, ',', '.') }}
                                    </div>
                                </div>
                                <div class="transaksi-summary-box">
                                    <div class="label">Kelayakan</div>
                                    <div class="value" style="font-size: 0.95rem; font-weight: 700;">
                                        {{ $application->rekomendasi ? $application->rekomendasi : 'Belum ditentukan' }}
                                    </div>
                                </div>
                            </div>

                            <div class="transaksi-sidebar-section">
                                <div class="transaksi-sidebar-title">Checklist Wajib</div>
                                <ul class="transaksi-mini-list">
                                    <li><i class="mdi mdi-check-circle-outline"></i> Jadwal & Surveyor terisi.</li>
                                    <li><i class="mdi mdi-check-circle-outline"></i> Nilai Pasar & Appraisal.</li>
                                    <li><i class="mdi mdi-check-circle-outline"></i> Foto dokumentasi lengkap.</li>
                                </ul>
                            </div>

                            @if ($application->status === 'survey' && !$isSubsidi)
                                <div class="mt-3">
                                    <a href="{{ route('kpr.pecahlegal', $application->id) }}" class="btn btn-success w-100">
                                        <i class="mdi mdi-arrow-right-bold-circle-outline me-1"></i>
                                        Lanjut ke Pecah Legal Unit
                                    </a>
                                </div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')

        <script>
            $(document).ready(function() {
                function truncateFileName(name, maxLength = 28) {
                    if (!name) return '';
                    if (name.length <= maxLength) return name;

                    const lastDot = name.lastIndexOf('.');
                    if (lastDot === -1) {
                        return name.slice(0, maxLength - 3) + '...';
                    }

                    const extension = name.slice(lastDot);
                    const baseName = name.slice(0, lastDot);
                    const allowedBase = Math.max(1, maxLength - extension.length - 3);

                    if (allowedBase <= 0) {
                        return name.slice(0, maxLength - 3) + '...';
                    }

                    return baseName.slice(0, allowedBase) + '...' + extension;
                }

                $(document).on('change', 'input[type="file"]', function(e) {
                    const file = e.target.files[0];
                    const $container = $(this).closest('.transaksi-file-upload');
                    if (file) {
                        const sizeInMB = (file.size / (1024 * 1024)).toFixed(2);
                        const displayName = truncateFileName(file.name, 28);
                        $container.find('.transaksi-file-info span').text(displayName);
                        $container.find('.transaksi-file-info small').text(sizeInMB + ' MB');
                    } else {
                        $container.find('.transaksi-file-info span').text('Upload Foto');
                        $container.find('.transaksi-file-info small').text('Format: JPG, PNG');
                    }
                });

                $('#formSurveyKpr').on('submit', function(e) {
                    e.preventDefault();
                    var form = this;

                    Swal.fire({
                        title: 'Simpan Hasil Survey?',
                        text: "Data survey yang Anda masukkan akan disimpan ke sistem.",
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#9a55ff', // Warna primary theme
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'Ya, Simpan',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            Swal.fire({
                                title: 'Mohon tunggu...',
                                html: 'Sedang menyimpan data survey KPR.',
                                allowOutsideClick: false,
                                didOpen: () => {
                                    Swal.showLoading();
                                }
                            });
                            form.submit();
                        }
                    });
                });
            });
        </script>

        @if (session('success'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil Menyimpan!',
                    text: '{{ session('success') }}',
                    timer: 3000,
                    timerProgressBar: true,
                    showConfirmButton: false
                });
            </script>
        @endif

        @if (session('error'))
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: '{{ session('error') }}',
                    confirmButtonColor: '#dc3545'
                });
            </script>
        @endif
    @endpush
@endsection
