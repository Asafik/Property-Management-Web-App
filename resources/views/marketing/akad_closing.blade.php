@extends('layouts.partial.app')

@section('title', 'Verifikasi KPR - Tahap Akad - Property Management App')

@section('content')
<style>
/* =========================================================
   TRANSAKSI VERIFIKASI KPR & AKAD STYLES
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

/* DOCUMENT TABLE */
.transaksi-doc-table {
    width: 100%;
}

.transaksi-doc-table thead th {
    background: #f8fafc;
    color: #8b8fa3;
    font-size: 0.82rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.4px;
    padding: 0.75rem 1rem;
    border-bottom: 1.5px solid #edf0f5;
}

.transaksi-doc-table tbody td {
    padding: 0.85rem 1rem;
    border-bottom: 1px solid #f1f3f7;
    font-size: 0.88rem;
    vertical-align: middle;
}

.transaksi-doc-name {
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.transaksi-doc-icon {
    width: 36px;
    height: 36px;
    border-radius: 8px;
    background: rgba(154, 85, 255, 0.1);
    color: #9a55ff;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.15rem;
    flex-shrink: 0;
}

.transaksi-doc-action {
    width: 36px;
    height: 36px;
    border-radius: 8px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border: 1.5px solid #9a55ff;
    color: #9a55ff;
    background: #ffffff;
    transition: all 0.25s ease;
    text-decoration: none !important;
    font-size: 1.1rem;
}

.transaksi-doc-action:hover {
    background: #9a55ff;
    color: #ffffff;
    box-shadow: 0 4px 10px rgba(154, 85, 255, 0.25);
    transform: translateY(-2px);
}

.transaksi-doc-action.disabled {
    border-color: #e2e8f0;
    color: #cbd5e1;
    background: #f8fafc;
    cursor: not-allowed;
    transform: none !important;
    box-shadow: none !important;
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
    font-size: 1.4rem;
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
    font-size: 1.4rem;
    color: #b91c1c;
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

/* AKAD CHOICE CARDS */
.akad-choice-card {
    position: relative;
    height: 100%;
}

.akad-choice-card input[type="radio"] {
    display: none;
}

.akad-choice-label {
    display: flex;
    align-items: flex-start;
    gap: 0.85rem;
    padding: 1.15rem;
    border-radius: 12px;
    border: 2px solid #e2e8f0;
    background: #ffffff;
    cursor: pointer;
    transition: all 0.25s ease;
    height: 100%;
    margin-bottom: 0;
}

.akad-choice-icon {
    width: 44px;
    height: 44px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.35rem;
    flex-shrink: 0;
}

.akad-choice-card.success .akad-choice-icon {
    background: #eefcf3;
    color: #28c76f;
}

.akad-choice-card.danger .akad-choice-icon {
    background: #fef2f2;
    color: #ea5455;
}

.akad-choice-content {
    flex: 1;
}

.akad-choice-title {
    font-size: 0.98rem;
    font-weight: 700;
    color: #2c2e3f;
    margin-bottom: 0.25rem;
}

.akad-choice-desc {
    font-size: 0.82rem;
    color: #64748b;
    line-height: 1.35;
}

.akad-choice-check {
    font-size: 1.25rem;
    color: #cbd5e1;
    transition: all 0.25s ease;
}

.akad-choice-card.success input[type="radio"]:checked + .akad-choice-label {
    border-color: #28c76f;
    background: #f6fcf8;
    box-shadow: 0 6px 18px rgba(40, 199, 111, 0.15);
}

.akad-choice-card.success input[type="radio"]:checked + .akad-choice-label .akad-choice-check {
    color: #28c76f;
}

.akad-choice-card.danger input[type="radio"]:checked + .akad-choice-label {
    border-color: #ea5455;
    background: #fff8f8;
    box-shadow: 0 6px 18px rgba(234, 84, 85, 0.15);
}

.akad-choice-card.danger input[type="radio"]:checked + .akad-choice-label .akad-choice-check {
    color: #ea5455;
}

/* AKAD FORM SHELL */
.akad-form-shell {
    display: none;
    border-radius: 12px;
    padding: 1.25rem;
    margin-top: 1.25rem;
}

.akad-form-shell.success {
    background: #f6fcf8;
    border: 1.5px solid #d1f2dc;
}

.akad-form-shell.danger {
    background: #fff8f8;
    border: 1.5px solid #fed7d7;
}

.akad-form-title {
    font-size: 1rem;
    font-weight: 700;
    margin-bottom: 1rem;
}

.akad-form-title.success {
    color: #15803d;
}

.akad-form-title.danger {
    color: #b91c1c;
}

.akad-form-group {
    margin-bottom: 1rem;
}

.akad-form-label {
    display: block;
    font-size: 0.85rem;
    font-weight: 700;
    color: #2c2e3f;
    margin-bottom: 0.4rem;
}

.akad-form-control {
    width: 100%;
    border: 1.5px solid #e2e8f0;
    border-radius: 8px;
    padding: 0.65rem 0.85rem;
    font-size: 0.88rem;
    color: #2c2e3f;
    background: #ffffff;
    transition: all 0.2s ease;
}

.akad-form-control:focus {
    outline: none;
    border-color: #9a55ff;
    box-shadow: 0 0 0 3px rgba(154, 85, 255, 0.15);
}

/* FILE UPLOAD STYLING */
.verifikasi-file-upload {
    position: relative;
}

.verifikasi-file-upload input[type="file"] {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    opacity: 0;
    cursor: pointer;
    z-index: 2;
}

.verifikasi-file-label {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 0.75rem 1rem;
    background: #ffffff;
    border: 1.5px dashed #cbd5e1;
    border-radius: 8px;
    transition: all 0.2s ease;
}

.verifikasi-file-upload:hover .verifikasi-file-label {
    border-color: #9a55ff;
    background: #fbf9ff;
}

.verifikasi-file-label i {
    font-size: 1.5rem;
    color: #9a55ff;
}

.verifikasi-file-info span {
    display: block;
    font-size: 0.85rem;
    font-weight: 700;
    color: #2c2e3f;
}

.verifikasi-file-info small {
    display: block;
    font-size: 0.75rem;
    color: #8b8fa3;
}

/* NEXT STEP RADIO GRID */
.akad-next-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 0.65rem;
}

.akad-next-card input[type="radio"] {
    display: none;
}

.akad-next-label {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 0.75rem 1rem;
    border-radius: 10px;
    border: 1.5px solid #e2e8f0;
    background: #ffffff;
    cursor: pointer;
    transition: all 0.2s ease;
    margin-bottom: 0;
}

.akad-next-icon {
    width: 36px;
    height: 36px;
    border-radius: 8px;
    background: #f1f5f9;
    color: #64748b;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.15rem;
    flex-shrink: 0;
}

.akad-next-content {
    flex: 1;
    display: flex;
    flex-direction: column;
}

.akad-next-title {
    font-size: 0.88rem;
    font-weight: 700;
    color: #2c2e3f;
}

.akad-next-desc {
    font-size: 0.75rem;
    color: #8b8fa3;
    line-height: 1.3;
}

.akad-next-check {
    font-size: 1.15rem;
    color: #cbd5e1;
}

.akad-next-card input[type="radio"]:checked + .akad-next-label {
    border-color: #9a55ff;
    background: #faf7ff;
}

.akad-next-card input[type="radio"]:checked + .akad-next-label .akad-next-icon {
    background: linear-gradient(135deg, #da8cff, #9a55ff);
    color: #ffffff;
}

.akad-next-card input[type="radio"]:checked + .akad-next-label .akad-next-check {
    color: #9a55ff;
}

/* ACTION BAR */
.akad-action-bar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 1rem;
    margin-top: 1.5rem;
    padding-top: 1.25rem;
    border-top: 1px solid #f1f3f7;
}

.transaksi-btn {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.65rem 1.35rem;
    border-radius: 10px;
    font-weight: 700;
    font-size: 0.88rem;
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

.transaksi-btn-secondary {
    background: #f1f5f9;
    color: #64748b;
}

.transaksi-btn-secondary:hover {
    background: #e2e8f0;
    color: #334155;
    transform: translateY(-2px);
}
</style>

    @php
        $documentsCount = $kpr->documents->whereNotNull('path')->count();
        $missingDocuments = max(0, 8 - $documentsCount);
        $akadSelesai = optional($kpr->booking->akad)->status === 'selesai';
        $isSubsidi = strtolower($kpr->booking->unit->jenis ?? '') === 'subsidi';
        $surveyDone = !empty($kpr->rekomendasi) || strtolower($kpr->status_survey ?? '') == 'done' || ($kpr->booking->status_survey ?? 0) == 1;

        $unit = $kpr->booking->unit ?? ($kpr->unit ?? null);
        $spkDone = !empty($unit?->no_spk) || !empty($unit?->dokumen_spk) || !empty($unit?->kontraktor);
        $status = strtolower($unit->construction_progress ?? '');
        $devDone = $status == 'selesai';

        $totalSteps = 7;
        $completedCount = 2; // Pengajuan + Verifikasi
        if ($spkDone) $completedCount++;
        if ($devDone) $completedCount++;
        if ($surveyDone) $completedCount++;
        if ($akadSelesai) $completedCount++;

        $progressWidth = intval(($completedCount / $totalSteps) * 100);
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
                            <span>Tahap {{ $completedCount }} dari {{ $totalSteps }}</span>
                        </div>

                        <div class="transaksi-progress">
                            <div class="transaksi-progress-bar" style="width: {{ $progressWidth }}%;"></div>
                        </div>

                        <div class="transaksi-steps" style="grid-template-columns: repeat(7, 1fr);">
                            <div class="transaksi-step completed">
                                <div class="transaksi-step-icon">
                                    <i class="mdi mdi-check"></i>
                                </div>
                                <span class="transaksi-step-title">Pengajuan</span>
                                <small>{{ $kpr->submitted_at ? \Carbon\Carbon::parse($kpr->submitted_at)->translatedFormat('d F Y') : '-' }}</small>
                            </div>

                            <div class="transaksi-step completed">
                                <div class="transaksi-step-icon">
                                    <i class="mdi mdi-check"></i>
                                </div>
                                <span class="transaksi-step-title">Verifikasi</span>
                                <small>{{ $kpr->approved_at ? \Carbon\Carbon::parse($kpr->approved_at)->translatedFormat('d F Y') : \Carbon\Carbon::parse($kpr->updated_at)->translatedFormat('d F Y') }}</small>
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

                                <div class="transaksi-step {{ $akadSelesai ? 'completed' : '' }}">
                                    @if ($akadSelesai)
                                        <div class="transaksi-step-icon"><i class="mdi mdi-check"></i></div>
                                    @else
                                        <div class="transaksi-step-icon"><i class="mdi mdi-handshake-outline"></i></div>
                                    @endif
                                    <span class="transaksi-step-title">Akad</span>
                                    <small>{{ $akadSelesai ? 'Selesai' : 'Menunggu' }}</small>
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

                                <div class="transaksi-step {{ $akadSelesai ? 'completed' : '' }}">
                                    @if ($akadSelesai)
                                        <div class="transaksi-step-icon"><i class="mdi mdi-check"></i></div>
                                    @else
                                        <div class="transaksi-step-icon"><i class="mdi mdi-handshake-outline"></i></div>
                                    @endif
                                    <span class="transaksi-step-title">Akad</span>
                                    <small>{{ $akadSelesai ? 'Selesai' : 'Menunggu' }}</small>
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
                                <a href="{{ url()->previous() }}" class="transaksi-btn transaksi-btn-secondary">
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
