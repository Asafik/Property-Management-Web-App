@extends('layouts.partial.app')

@section('title', 'Survey KPR - Properti Management')

@section('content')
<style>
/* =========================================================
   TRANSAKSI VERIFIKASI KPR & SURVEY STYLES
   ========================================================= */

.transaksi-page {
    font-family: 'Nunito', 'Segoe UI', sans-serif;
    color: #2c2e3f;
}

.card {
    border-radius: 14px !important;
    border: none !important;
    box-shadow: 0 4px 18px rgba(0, 0, 0, 0.04);
    background: #ffffff;
    transition: all 0.3s ease;
}

.card-body {
    padding: 1.5rem !important;
}

/* CUSTOMER HEADER */
.customer-header {
    width: 100%;
}

.customer-avatar {
    width: 58px;
    height: 58px;
    border-radius: 14px;
    background: linear-gradient(135deg, #da8cff, #9a55ff);
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 4px 12px rgba(154, 85, 255, 0.25);
    flex-shrink: 0;
}

.customer-avatar i {
    font-size: 2.2rem;
    color: #ffffff;
}

.customer-name {
    font-size: 1.25rem;
    font-weight: 700;
    color: #2c2e3f;
}

.customer-booking {
    font-size: 0.88rem;
    color: #8b8fa3;
    font-weight: 600;
}

.customer-unit-info {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: 1.25rem;
    background: #fbf9ff;
    border: 1px solid #ede4ff;
    padding: 0.75rem 1.25rem;
    border-radius: 12px;
}

.customer-unit-info .info-item {
    display: flex;
    flex-direction: column;
}

.customer-unit-info .info-item small {
    font-size: 0.75rem;
    color: #8b8fa3;
    font-weight: 600;
    margin-bottom: 2px;
}

.customer-unit-info .info-item span {
    font-size: 0.95rem;
    font-weight: 700;
    color: #2c2e3f;
}

.customer-unit-info .info-item span.highlight {
    color: #9a55ff;
}

/* BADGES */
.badge-gradient-success {
    background: linear-gradient(135deg, #28c76f, #48da89) !important;
    color: #fff !important;
    padding: 0.4rem 0.75rem;
    font-size: 0.75rem;
    border-radius: 8px;
    font-weight: 700;
}

.badge-gradient-primary {
    background: linear-gradient(135deg, #da8cff, #9a55ff) !important;
    color: #fff !important;
    padding: 0.4rem 0.75rem;
    font-size: 0.75rem;
    border-radius: 8px;
    font-weight: 700;
}

.badge-gradient-secondary {
    background: #6c757d !important;
    color: #fff !important;
    padding: 0.4rem 0.75rem;
    font-size: 0.75rem;
    border-radius: 8px;
    font-weight: 700;
}

/* SECTION TITLES */
.transaksi-section-title {
    display: flex;
    align-items: center;
    gap: 0.55rem;
    font-size: 1.05rem;
    font-weight: 700;
    color: #2c2e3f;
    margin-bottom: 1.25rem;
    padding-bottom: 0.75rem;
    border-bottom: 1px solid #f1f3f7;
}

.transaksi-section-title i {
    font-size: 1.35rem;
    color: #9a55ff;
}

/* STEPPER PROGRESS */
.transaksi-progress-top {
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-size: 0.92rem;
    margin-bottom: 0.75rem;
}

.transaksi-progress-top .transaksi-muted {
    color: #64748b !important;
    font-weight: 500;
}

.transaksi-progress {
    height: 8px;
    background: #eef1f6;
    border-radius: 20px;
    overflow: hidden;
    margin-bottom: 2rem;
}

.transaksi-progress-bar {
    height: 100%;
    background: #9a55ff;
    border-radius: 20px;
    transition: width 0.4s ease;
}

.transaksi-steps {
    display: grid;
    position: relative;
}

/* Connecting Line on parent container (Always 100% behind icons) */
.transaksi-steps::before {
    content: '';
    position: absolute;
    top: 26px;
    left: calc(100% / 14);
    right: calc(100% / 14);
    height: 2.5px;
    background: #e2e8f0;
    z-index: 1;
}

@media (max-width: 767px) {
    .transaksi-steps {
        grid-template-columns: repeat(2, 1fr) !important;
        gap: 1.25rem 0.5rem;
    }
    .transaksi-steps::before {
        display: none !important;
    }
}

.transaksi-step {
    position: relative;
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    padding: 0.25rem 0.15rem;
    background: transparent !important;
    border: none !important;
    box-shadow: none !important;
    z-index: 2;
}

.transaksi-step.completed,
.transaksi-step.active {
    background: transparent !important;
    border: none !important;
    box-shadow: none !important;
}

.transaksi-step-icon {
    position: relative;
    z-index: 3;
    width: 44px;
    height: 44px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 0.65rem;
    font-size: 1.25rem;
    background: #f1f3f7 !important;
    border: 3px solid #ffffff !important;
    box-shadow: 0 0 0 1px #edf2f7;
    color: #94a3b8 !important;
    transition: all 0.25s ease;
}

.transaksi-step.completed .transaksi-step-icon {
    background: #28c76f !important;
    border: 3px solid #ffffff !important;
    box-shadow: 0 0 0 1px #28c76f;
    color: #ffffff !important;
}

.transaksi-step-title {
    font-size: 0.88rem;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 2px;
    white-space: nowrap;
}

.transaksi-step small {
    font-size: 0.75rem;
    color: #64748b;
    font-weight: 500;
    line-height: 1.3;
    display: block;
}

/* DETAIL KPR LIST */
.transaksi-detail-list {
    display: flex;
    flex-direction: column;
    gap: 0.85rem;
}

.transaksi-detail-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-size: 0.88rem;
    padding-bottom: 0.6rem;
    border-bottom: 1px dashed #f0f2f7;
}

.transaksi-detail-item:last-child {
    border-bottom: none;
    padding-bottom: 0;
}

.transaksi-detail-item > span:first-child {
    color: #8b8fa3;
    font-weight: 600;
}

.transaksi-detail-item > span:last-child {
    color: #2c2e3f;
    font-weight: 700;
    text-align: right;
}

.transaksi-detail-item .highlight {
    color: #28c76f !important;
    font-size: 0.98rem;
}

.transaksi-handler {
    display: flex;
    align-items: center;
    gap: 0.85rem;
    background: #f8fafc;
    border: 1px solid #edf0f5;
    padding: 0.75rem 1rem;
    border-radius: 12px;
}

.transaksi-handler-icon {
    width: 42px;
    height: 42px;
    border-radius: 10px;
    background: linear-gradient(135deg, #667eea, #764ba2);
    display: flex;
    align-items: center;
    justify-content: center;
    color: #ffffff;
    font-size: 1.3rem;
}

/* INLINE ALERTS */
.transaksi-inline-alert {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 0.85rem 1rem;
    border-radius: 10px;
    font-size: 0.88rem;
    margin-bottom: 1.25rem;
}

.transaksi-inline-alert i {
    font-size: 1.25rem;
    flex-shrink: 0;
}

.transaksi-inline-alert.success {
    background: #eefcf3;
    border: 1px solid #cbf4d8;
    color: #1b7a42;
}

.transaksi-inline-alert.warning {
    background: #fff9ed;
    border: 1px solid #ffe6be;
    color: #b26b00;
}

.transaksi-inline-alert.info {
    background: #f3f8ff;
    border: 1px solid #dbeafe;
    color: #1d4ed8;
}

.transaksi-inline-alert.danger {
    background: #fef2f2;
    border: 1px solid #fed7d7;
    color: #b91c1c;
}

/* FORM CONTROLS */
.transaksi-form-group {
    margin-bottom: 1.15rem;
}

.transaksi-form-label {
    display: block;
    font-size: 0.86rem;
    font-weight: 700;
    color: #2c2e3f;
    margin-bottom: 0.4rem;
}

.transaksi-form-control {
    width: 100%;
    border: 1.5px solid #e2e8f0;
    border-radius: 8px;
    padding: 0.65rem 0.85rem;
    font-size: 0.88rem;
    color: #2c2e3f;
    background: #ffffff;
    transition: all 0.2s ease;
}

.transaksi-form-control:focus {
    outline: none;
    border-color: #9a55ff;
    box-shadow: 0 0 0 3px rgba(154, 85, 255, 0.15);
}

/* CHECKLIST GRID */
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
    background: #fbf9ff;
    border: 2px solid #ede4ff;
    border-radius: 12px;
    cursor: pointer;
    transition: all 0.25s ease;
    margin-bottom: 0;
}

.survey-check-icon {
    font-size: 1.35rem;
    color: #cbd5e1;
    transition: all 0.25s ease;
}

.survey-check-text {
    font-size: 0.9rem;
    font-weight: 700;
    color: #2c2e3f;
}

.survey-checkbox-input:checked + .survey-checkbox-label {
    border-color: #9a55ff;
    background: #f5eeff;
    box-shadow: 0 4px 12px rgba(154, 85, 255, 0.15);
}

.survey-checkbox-input:checked + .survey-checkbox-label .survey-check-icon {
    color: #9a55ff;
}

.survey-input-group {
    display: flex;
    width: 100%;
}

.survey-input-group-text {
    display: flex;
    align-items: center;
    padding: 0.65rem 0.85rem;
    font-size: 0.88rem;
    font-weight: 700;
    color: #64748b;
    background: #f8fafc;
    border: 1.5px solid #e2e8f0;
    border-radius: 8px 0 0 8px;
    border-right: none;
}

.survey-input-group .transaksi-form-control {
    border-radius: 0 8px 8px 0;
}

/* FILE UPLOADS */
.transaksi-file-upload {
    position: relative;
}

.transaksi-file-upload input[type="file"] {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    opacity: 0;
    cursor: pointer;
    z-index: 2;
}

.transaksi-file-label {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 0.75rem 1rem;
    background: #ffffff;
    border: 1.5px dashed #cbd5e1;
    border-radius: 8px;
    transition: all 0.2s ease;
}

.transaksi-file-upload:hover .transaksi-file-label {
    border-color: #9a55ff;
    background: #fbf9ff;
}

.transaksi-file-label i {
    font-size: 1.5rem;
    color: #9a55ff;
}

.transaksi-file-info {
    min-width: 0;
    flex: 1;
    overflow: hidden;
}

.transaksi-file-info span {
    display: block;
    font-size: 0.85rem;
    font-weight: 700;
    color: #2c2e3f;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.transaksi-file-info small {
    display: block;
    font-size: 0.75rem;
    color: #8b8fa3;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

/* BUTTONS */
.transaksi-btn {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.75rem 1.5rem;
    border-radius: 10px;
    font-weight: 700;
    font-size: 0.92rem;
    border: none;
    cursor: pointer;
    transition: all 0.25s ease;
    text-decoration: none !important;
}

.transaksi-btn-primary {
    background: linear-gradient(135deg, #da8cff, #9a55ff);
    color: #ffffff;
    box-shadow: 0 4px 12px rgba(154, 85, 255, 0.25);
}

.transaksi-btn-primary:hover {
    box-shadow: 0 6px 18px rgba(154, 85, 255, 0.4);
    transform: translateY(-2px);
    color: #ffffff;
}

/* SIDEBAR & SUMMARY */
.transaksi-sticky {
    position: sticky;
    top: 20px;
}

.transaksi-status-banner {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.75rem 1rem;
    border-radius: 10px;
    font-weight: 700;
    font-size: 0.88rem;
}

.transaksi-status-banner.success {
    background: linear-gradient(135deg, #eefcf3, #dcfce7);
    color: #15803d;
    border: 1px solid #bbf7d0;
}

.transaksi-status-banner.warning {
    background: linear-gradient(135deg, #fffbeb, #fef3c7);
    color: #b45309;
    border: 1px solid #fde68a;
}

.transaksi-summary-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 0.75rem;
    margin-bottom: 1.25rem;
}

.transaksi-summary-box {
    padding: 0.85rem;
    border-radius: 10px;
    text-align: center;
}

.transaksi-summary-box.success {
    background: #f0fdf4;
    border: 1px solid #bbf7d0;
}

.transaksi-summary-box.success .label {
    font-size: 0.75rem;
    color: #16a34a;
    font-weight: 600;
}

.transaksi-summary-box.success .value {
    font-size: 1.1rem;
    color: #15803d;
    font-weight: 800;
}

.transaksi-summary-box.danger {
    background: #fef2f2;
    border: 1px solid #fecaca;
}

.transaksi-summary-box.danger .label {
    font-size: 0.75rem;
    color: #dc2626;
    font-weight: 600;
}

.transaksi-summary-box.danger .value {
    font-size: 1.1rem;
    color: #b91c1c;
    font-weight: 800;
}

.transaksi-summary-box .label {
    font-size: 0.75rem;
    color: #64748b;
    font-weight: 600;
}

.transaksi-summary-box .value {
    font-size: 1.1rem;
    color: #1e293b;
    font-weight: 800;
}

.transaksi-sidebar-section {
    padding-top: 1rem;
    margin-top: 1rem;
    border-top: 1px solid #f1f3f7;
}

.transaksi-sidebar-title {
    font-size: 0.88rem;
    font-weight: 700;
    color: #2c2e3f;
    margin-bottom: 0.65rem;
}

.transaksi-mini-list {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.transaksi-mini-list li {
    display: flex;
    align-items: flex-start;
    gap: 0.5rem;
    font-size: 0.82rem;
    color: #64748b;
    line-height: 1.4;
}

.transaksi-mini-list li i {
    font-size: 1rem;
    color: #9a55ff;
    flex-shrink: 0;
    margin-top: 1px;
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
                                    <i class="mdi mdi-account"></i>
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

                            $unit = $application->unit ?? null;
                            $spkDone = !empty($unit?->no_spk) || !empty($unit?->dokumen_spk) || !empty($unit?->kontraktor);

                            $status = strtolower($application->unit->construction_progress ?? '');
                            $devDone = $status == 'selesai';

                            $totalSteps = 7;
                            $completedCount = 2; // Pengajuan + Verifikasi
                            if ($spkDone) $completedCount++;
                            if ($devDone) $completedCount++;
                            if ($surveyDone) $completedCount++;
                            
                            $progressWidth = intval(($completedCount / $totalSteps) * 100);
                        @endphp

                        <div class="transaksi-progress-top">
                            <span class="transaksi-muted">Progress Survey</span>
                            <span>Tahap {{ $completedCount }} dari {{ $totalSteps }}</span>
                        </div>

                        <div class="transaksi-progress">
                            <div class="transaksi-progress-bar" style="width: {{ $progressWidth }}%;"></div>
                        </div>

                        <div class="transaksi-steps" style="grid-template-columns: repeat(7, 1fr);">
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
                                $statusText = [
                                    'belum_mulai' => 'Belum mulai pembangunan',
                                    'pondasi' => 'Tahap pondasi',
                                    'dinding' => 'Tahap dinding',
                                    'atap' => 'Tahap atap',
                                    'finishing' => 'Tahap finishing',
                                    'selesai' => 'Pembangunan selesai',
                                ];
                            @endphp

                            <div class="transaksi-step {{ $devDone ? 'completed' : '' }}">
                                @if ($devDone)
                                    <div class="transaksi-step-icon">
                                        <i class="mdi mdi-check"></i>
                                    </div>
                                @else
                                    <div class="transaksi-step-icon">
                                        <i class="mdi mdi-home-city"></i>
                                    </div>
                                @endif

                                <span class="transaksi-step-title">Pembangunan</span>
                                <small>{{ $statusText[$status] ?? 'Belum mulai pembangunan' }}</small>
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

                                <div class="transaksi-step">
                                    <div class="transaksi-step-icon"><i class="mdi mdi-handshake-outline"></i></div>
                                    <span class="transaksi-step-title">Akad</span>
                                    <small>Menunggu</small>
                                </div>
                            @else
                                <div class="transaksi-step {{ $surveyDone ? 'completed' : '' }}">
                                    @if ($surveyDone)
                                        <div class="transaksi-step-icon"><i class="mdi mdi-check"></i></div>
                                    @else
                                        <div class="transaksi-step-icon"><i class="mdi mdi-home-search-outline"></i></div>
                                    @endif
                                    <span class="transaksi-step-title">Survey</span>
                                    <small>{{ $surveyDone ? 'Selesai' : 'Menunggu' }}</small>
                                </div>

                                <div class="transaksi-step">
                                    <div class="transaksi-step-icon"><i class="mdi mdi-handshake-outline"></i></div>
                                    <span class="transaksi-step-title">Akad</span>
                                    <small>Menunggu</small>
                                </div>
                            @endif

                            <div class="transaksi-step">
                                <div class="transaksi-step-icon"><i class="mdi mdi-home-outline"></i></div>
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

        {{-- RINCIAN INFORMASI UNIT PROPERTI --}}
        <div class="row mt-2 mb-3">
            <div class="col-12">
                <div class="card shadow-sm border-0" style="border-radius: 14px; background: #ffffff;">
                    <div class="card-body p-3 p-md-4">
                        {{-- Header Title --}}
                        <div class="d-flex flex-wrap align-items-center justify-content-between pb-3 mb-3 border-bottom gap-2">
                            <div class="d-flex align-items-center gap-2.5">
                                <div class="rounded-3 d-flex align-items-center justify-content-center" 
                                     style="width: 38px; height: 38px; background: linear-gradient(135deg, #da8cff, #9a55ff); color: #fff; box-shadow: 0 4px 10px rgba(154, 85, 255, 0.25);">
                                    <i class="mdi mdi-home-analytics fs-5"></i>
                                </div>
                                <div>
                                    <h5 class="fw-bold text-dark mb-0" style="font-size: 1.05rem;">Rincian Informasi Unit Properti</h5>
                                    <small class="text-muted" style="font-size: 0.8rem;">Spesifikasi fisik, lokasi kavling, dan nilai transaksi unit yang disurvey</small>
                                </div>
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                @if(($application->unit->jenis ?? '') == 'subsidi')
                                    <span class="badge badge-gradient-success px-3 py-2" style="font-size: 0.78rem;">
                                        <i class="mdi mdi-home-assistant me-1"></i>SUBSIDI - {{ $application->unit->type ?? 'Standar' }}
                                    </span>
                                @else
                                    <span class="badge badge-gradient-primary px-3 py-2" style="font-size: 0.78rem;">
                                        <i class="mdi mdi-office-building me-1"></i>KOMERSIL - {{ $application->unit->type ?? 'Standar' }}
                                    </span>
                                @endif
                                <span class="badge bg-light text-dark border px-3 py-2 fw-bold" style="font-size: 0.78rem;">
                                    <i class="mdi mdi-cube-outline text-primary me-1"></i>{{ $application->unit->unit_code ?? '-' }}
                                </span>
                            </div>
                        </div>

                        {{-- 4-Column Balanced Grid --}}
                        <div class="row g-2.5 g-md-3">
                            {{-- 1. Unit & Blok --}}
                            <div class="col-12 col-sm-6 col-lg-3">
                                <div class="d-flex align-items-center p-3 rounded-3 border h-100" style="background: #fafbfe; border-color: #eef2f6 !important;">
                                    <div class="rounded-2 p-2 me-2.5 d-flex align-items-center justify-content-center flex-shrink-0" style="background: #ede4ff; color: #9a55ff; width: 38px; height: 38px;">
                                        <i class="mdi mdi-home-outline fs-5"></i>
                                    </div>
                                    <div class="overflow-hidden">
                                        <small class="text-muted d-block fw-semibold text-uppercase" style="font-size: 0.68rem; letter-spacing: 0.5px;">Unit & Blok</small>
                                        <span class="fw-bold text-dark d-block text-truncate" style="font-size: 0.95rem;">{{ $application->unit->unit_name ?? '-' }}</span>
                                        <small class="text-primary font-monospace fw-bold" style="font-size: 0.75rem;">Blok {{ $application->unit->block ?? '-' }} No. {{ $application->unit->unit_number ?? '-' }}</small>
                                    </div>
                                </div>
                            </div>

                            {{-- 2. Lokasi / Perumahan --}}
                            <div class="col-12 col-sm-6 col-lg-3">
                                <div class="d-flex align-items-center p-3 rounded-3 border h-100" style="background: #fafbfe; border-color: #eef2f6 !important;">
                                    <div class="rounded-2 p-2 me-2.5 d-flex align-items-center justify-content-center flex-shrink-0" style="background: #e0f2fe; color: #0284c7; width: 38px; height: 38px;">
                                        <i class="mdi mdi-map-marker-radius-outline fs-5"></i>
                                    </div>
                                    <div class="overflow-hidden">
                                        <small class="text-muted d-block fw-semibold text-uppercase" style="font-size: 0.68rem; letter-spacing: 0.5px;">Lokasi / Proyek</small>
                                        <span class="fw-bold text-dark d-block text-truncate" style="font-size: 0.95rem;" title="{{ $application->unit->landBank->name ?? '-' }}">{{ $application->unit->landBank->name ?? 'Proyek Utama' }}</span>
                                        <small class="text-muted text-truncate d-block" style="font-size: 0.75rem;">{{ $application->unit->landBank->village ?? ($application->unit->landBank->address ?? 'Lokasi Proyek') }}</small>
                                    </div>
                                </div>
                            </div>

                            {{-- 3. Dimensi Lahan & Bangunan --}}
                            <div class="col-12 col-sm-6 col-lg-3">
                                <div class="d-flex align-items-center p-3 rounded-3 border h-100" style="background: #fafbfe; border-color: #eef2f6 !important;">
                                    <div class="rounded-2 p-2 me-2.5 d-flex align-items-center justify-content-center flex-shrink-0" style="background: #fef3c7; color: #d97706; width: 38px; height: 38px;">
                                        <i class="mdi mdi-ruler-square fs-5"></i>
                                    </div>
                                    <div class="overflow-hidden">
                                        <small class="text-muted d-block fw-semibold text-uppercase" style="font-size: 0.68rem; letter-spacing: 0.5px;">Dimensi Kavling</small>
                                        <div class="d-flex align-items-center gap-1.5 my-0.5">
                                            <span class="badge bg-white text-dark border fw-bold" style="font-size: 0.72rem;">LT: {{ number_format($application->unit->area ?? 0, 0, ',', '.') }} m²</span>
                                            <span class="badge bg-white text-primary border fw-bold" style="font-size: 0.72rem;">LB: {{ number_format($application->unit->building_area ?? 0, 0, ',', '.') }} m²</span>
                                        </div>
                                        <small class="text-muted d-block" style="font-size: 0.72rem;">Luas Tanah & Bangunan</small>
                                    </div>
                                </div>
                            </div>

                            {{-- 4. Arah Hadap & Posisi --}}
                            <div class="col-12 col-sm-6 col-lg-3">
                                <div class="d-flex align-items-center p-3 rounded-3 border h-100" style="background: #fafbfe; border-color: #eef2f6 !important;">
                                    <div class="rounded-2 p-2 me-2.5 d-flex align-items-center justify-content-center flex-shrink-0" style="background: #f1f5f9; color: #475569; width: 38px; height: 38px;">
                                        <i class="mdi mdi-compass-outline fs-5"></i>
                                    </div>
                                    <div class="overflow-hidden">
                                        <small class="text-muted d-block fw-semibold text-uppercase" style="font-size: 0.68rem; letter-spacing: 0.5px;">Arah & Posisi</small>
                                        <span class="fw-bold text-dark d-block" style="font-size: 0.95rem;">Hadap {{ $application->unit->facing ?? 'Utara' }}</span>
                                        <small class="text-muted d-block" style="font-size: 0.75rem;">Posisi: <span class="fw-semibold text-dark">{{ $application->unit->position ?? 'Badan' }}</span></small>
                                    </div>
                                </div>
                            </div>

                            {{-- 5. Harga Unit Properti --}}
                            <div class="col-12 col-sm-6 col-lg-3">
                                <div class="d-flex align-items-center p-3 rounded-3 border h-100" style="background: #fafbfe; border-color: #eef2f6 !important;">
                                    <div class="rounded-2 p-2 me-2.5 d-flex align-items-center justify-content-center flex-shrink-0" style="background: #dcfce7; color: #16a34a; width: 38px; height: 38px;">
                                        <i class="mdi mdi-cash-multiple fs-5"></i>
                                    </div>
                                    <div class="overflow-hidden">
                                        <small class="text-muted d-block fw-semibold text-uppercase" style="font-size: 0.68rem; letter-spacing: 0.5px;">Harga Unit</small>
                                        <span class="fw-bold text-success d-block" style="font-size: 0.98rem;">Rp {{ number_format($application->unit->price ?? $application->harga_unit ?? 0, 0, ',', '.') }}</span>
                                        <small class="text-muted d-block" style="font-size: 0.75rem;">IJB: Rp {{ number_format($application->unit->ijb_price ?? 0, 0, ',', '.') }}</small>
                                    </div>
                                </div>
                            </div>

                            {{-- 6. Progress Konstruksi --}}
                            <div class="col-12 col-sm-6 col-lg-3">
                                <div class="d-flex align-items-center p-3 rounded-3 border h-100" style="background: #fafbfe; border-color: #eef2f6 !important;">
                                    <div class="rounded-2 p-2 me-2.5 d-flex align-items-center justify-content-center flex-shrink-0" style="background: #fae8ff; color: #a855f7; width: 38px; height: 38px;">
                                        <i class="mdi mdi-progress-wrench fs-5"></i>
                                    </div>
                                    <div class="overflow-hidden">
                                        <small class="text-muted d-block fw-semibold text-uppercase" style="font-size: 0.68rem; letter-spacing: 0.5px;">Progress Pembangunan</small>
                                        @php
                                            $cProgress = strtolower($application->unit->construction_progress ?? 'belum_mulai');
                                            $cBadge = match($cProgress) {
                                                'selesai' => 'badge-gradient-success',
                                                'finishing' => 'bg-info text-white',
                                                'atap', 'dinding', 'pondasi' => 'bg-warning text-dark',
                                                default => 'bg-secondary text-white'
                                            };
                                        @endphp
                                        <span class="badge {{ $cBadge }} px-2.5 py-1 text-uppercase fw-bold my-0.5 d-inline-block" style="font-size: 0.72rem;">
                                            {{ str_replace('_', ' ', $cProgress) }}
                                        </span>
                                        <small class="text-muted d-block" style="font-size: 0.72rem;">Tahap Pembangunan</small>
                                    </div>
                                </div>
                            </div>

                            {{-- 7. Kontraktor / SPK --}}
                            <div class="col-12 col-sm-6 col-lg-3">
                                <div class="d-flex align-items-center p-3 rounded-3 border h-100" style="background: #fafbfe; border-color: #eef2f6 !important;">
                                    <div class="rounded-2 p-2 me-2.5 d-flex align-items-center justify-content-center flex-shrink-0" style="background: #e2e8f0; color: #334155; width: 38px; height: 38px;">
                                        <i class="mdi mdi-hard-hat fs-5"></i>
                                    </div>
                                    <div class="overflow-hidden">
                                        <small class="text-muted d-block fw-semibold text-uppercase" style="font-size: 0.68rem; letter-spacing: 0.5px;">Kontraktor / SPK</small>
                                        <span class="fw-bold text-dark d-block text-truncate" style="font-size: 0.95rem;" title="{{ $application->unit->kontraktor ?? 'Pembangunan Mandiri' }}">{{ $application->unit->kontraktor ?? 'Pembangunan Mandiri' }}</span>
                                        <small class="text-muted font-monospace text-truncate d-block" style="font-size: 0.75rem;">{{ $application->unit->no_spk ? 'No: ' . $application->unit->no_spk : 'SPK Standar' }}</small>
                                    </div>
                                </div>
                            </div>

                            {{-- 8. Status Unit --}}
                            <div class="col-12 col-sm-6 col-lg-3">
                                <div class="d-flex align-items-center p-3 rounded-3 border h-100" style="background: #fafbfe; border-color: #eef2f6 !important;">
                                    <div class="rounded-2 p-2 me-2.5 d-flex align-items-center justify-content-center flex-shrink-0" style="background: #ede9fe; color: #7c3aed; width: 38px; height: 38px;">
                                        <i class="mdi mdi-shield-check-outline fs-5"></i>
                                    </div>
                                    <div class="overflow-hidden">
                                        <small class="text-muted d-block fw-semibold text-uppercase" style="font-size: 0.68rem; letter-spacing: 0.5px;">Status Unit</small>
                                        <span class="badge badge-gradient-primary px-2.5 py-1 text-uppercase fw-bold my-0.5 d-inline-block" style="font-size: 0.72rem;">
                                            {{ $application->unit->status ?? 'BOOKED' }}
                                        </span>
                                        <small class="text-muted d-block" style="font-size: 0.72rem;">Unit Terjadwal Survey</small>
                                    </div>
                                </div>
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
                                            value="{{ $application->survey_date ? \Carbon\Carbon::parse($application->survey_date)->format('Y-m-d') : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="transaksi-form-group">
                                        <label class="transaksi-form-label">Jam Survey</label>
                                        <input type="time" class="transaksi-form-control" name="survey_time"
                                            value="{{ $application->survey_time ? (is_string($application->survey_time) ? substr($application->survey_time, 0, 5) : \Carbon\Carbon::parse($application->survey_time)->format('H:i')) : '' }}">
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
                                                    {{ $surveyor->name }} ({{ $surveyor->position->name ?? 'Petugas' }})
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
                                            <input type="text" class="transaksi-form-control rupiah-format" name="appraisal_value"
                                                value="{{ number_format($application->appraisal_value ?? $application->jumlah_pinjaman ?? 0, 0, ',', '.') }}" required>
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
                                            @if ($application->$field)
                                                @php
                                                    $photoUrl = file_exists(public_path('uploads/' . $application->$field))
                                                        ? asset('uploads/' . $application->$field)
                                                        : (file_exists(storage_path('app/public/' . $application->$field)) ? asset('storage/' . $application->$field) : asset($application->$field));
                                                @endphp
                                                <div class="p-2.5 px-3 bg-white rounded-3 border d-flex flex-column gap-2" style="border-color: #cbd5e1 !important;">
                                                    <div class="d-flex align-items-center gap-2">
                                                        <div class="rounded-2 bg-success bg-opacity-10 text-success p-1.5 d-inline-flex align-items-center justify-content-center flex-shrink-0" style="width: 32px; height: 32px;">
                                                            <i class="mdi mdi-image-check text-success fs-5"></i>
                                                        </div>
                                                        <div style="min-width: 0; flex: 1;">
                                                            <span class="fw-bold text-dark d-block text-truncate survey-file-title" style="font-size: 0.82rem;">Foto Tersimpan</span>
                                                            <small class="text-success fw-semibold d-block text-truncate survey-file-subtitle" style="font-size: 0.72rem;">
                                                                <i class="mdi mdi-check-circle me-1"></i>Sudah diunggah
                                                            </small>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex align-items-center gap-2 pt-2 border-top" style="border-color: #f1f5f9 !important;">
                                                        <a href="{{ $photoUrl }}" target="_blank" class="btn btn-sm btn-outline-primary flex-fill py-1 px-2 d-inline-flex align-items-center justify-content-center gap-1 text-decoration-none" style="font-size: 0.76rem; border-radius: 6px; font-weight: 600;">
                                                            <i class="mdi mdi-eye-outline"></i>
                                                            <span>Lihat Foto</span>
                                                        </a>
                                                        <label class="btn btn-sm btn-outline-secondary flex-fill py-1 px-2 d-inline-flex align-items-center justify-content-center gap-1 mb-0" style="font-size: 0.76rem; border-radius: 6px; font-weight: 600; cursor: pointer;">
                                                            <i class="mdi mdi-camera-flip-outline"></i>
                                                            <span>Ganti Foto</span>
                                                            <input type="file" name="{{ $field }}" accept=".jpg,.jpeg,.png" style="display: none;" class="survey-file-input">
                                                        </label>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="transaksi-file-upload">
                                                    <input type="file" name="{{ $field }}" accept=".jpg,.jpeg,.png" class="survey-file-input">
                                                    <div class="transaksi-file-label">
                                                        <i class="mdi mdi-camera"></i>
                                                        <div class="transaksi-file-info">
                                                            <span>Upload Foto</span>
                                                            <small>Format: JPG, PNG</small>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
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
                                        Rp {{ number_format($application->appraisal_value ?? $application->jumlah_pinjaman ?? 0, 0, ',', '.') }}
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
                    const $group = $(this).closest('.transaksi-form-group');
                    const $container = $(this).closest('.transaksi-file-upload');
                    
                    if (file) {
                        const sizeInMB = (file.size / (1024 * 1024)).toFixed(2);
                        const displayName = truncateFileName(file.name, 22);
                        if ($container.length) {
                            $container.find('.transaksi-file-info span').text(displayName);
                            $container.find('.transaksi-file-info small').text(sizeInMB + ' MB (Siap upload)');
                        } else {
                            $group.find('.survey-file-title').text(displayName);
                            $group.find('.survey-file-subtitle').removeClass('text-success').addClass('text-primary').html('<i class="mdi mdi-file-check me-1"></i>' + sizeInMB + ' MB (Foto baru dipilih)');
                        }
                    } else {
                        if ($container.length) {
                            $container.find('.transaksi-file-info span').text('Upload Foto');
                            $container.find('.transaksi-file-info small').text('Format: JPG, PNG');
                        }
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
