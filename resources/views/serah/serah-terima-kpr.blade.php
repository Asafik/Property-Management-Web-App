@extends('layouts.partial.app')

@section('title', 'Serah Terima Unit - Properti Management')

@section('content')
<style>
/* =========================================================
   TRANSAKSI VERIFIKASI KPR & SERAH TERIMA STYLES
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

a.transaksi-step-icon {
    text-decoration: none !important;
    cursor: pointer;
}

a.transaksi-step-icon:hover {
    transform: translateY(-3px) scale(1.1);
    box-shadow: 0 6px 16px rgba(0, 0, 0, 0.15) !important;
}

.transaksi-step.completed a.transaksi-step-icon:hover {
    box-shadow: 0 6px 16px rgba(40, 199, 111, 0.4) !important;
}

.transaksi-step.active a.transaksi-step-icon:hover {
    box-shadow: 0 6px 16px rgba(154, 85, 255, 0.45) !important;
}

.transaksi-step-title-link {
    text-decoration: none !important;
    color: inherit;
    display: inline-block;
    cursor: pointer;
}

.transaksi-step-title-link:hover .transaksi-step-title {
    color: #9a55ff !important;
    text-decoration: underline;
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

/* DETAIL LIST */
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

/* SIDEBAR & SUMMARY */
.transaksi-sticky {
    position: sticky;
    top: 20px;
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

/* SPECIFIC SERAH TERIMA STYLES */
.jenis-badge {
    background: linear-gradient(135deg, #ebf9eb, #d1f3d1);
    color: #28a745;
    border: 1px solid #9ce0a6;
    display: inline-flex;
    align-items: center;
    padding: 0.35rem 0.85rem;
    border-radius: 8px;
    font-size: 0.8rem;
    font-weight: 700;
    gap: 6px;
}

.payment-method-badge {
    display: inline-flex;
    align-items: center;
    padding: 0.25rem 0.6rem;
    border-radius: 6px;
    font-size: 0.75rem;
    font-weight: 700;
    gap: 4px;
    background: linear-gradient(135deg, #da8cff, #9a55ff);
    color: #ffffff;
}

.header-badge {
    display: inline-flex;
    align-items: center;
    padding: 0.3rem 0.7rem;
    border-radius: 6px;
    font-size: 0.75rem;
    font-weight: 600;
    gap: 4px;
    white-space: nowrap;
}

.serah-form-group {
    margin-bottom: 1rem;
}

.serah-form-label {
    display: block;
    font-size: 0.86rem;
    font-weight: 700;
    color: #2c2e3f;
    margin-bottom: 0.45rem;
}

.serah-form-control {
    width: 100%;
    border: 1.5px solid #e2e8f0;
    border-radius: 8px;
    padding: 0.65rem 0.85rem;
    font-size: 0.88rem;
    color: #2c2e3f;
    transition: all 0.2s ease;
    background: #fff;
}

.serah-form-control:focus {
    border-color: #9a55ff;
    box-shadow: 0 0 0 3px rgba(154, 85, 255, 0.15);
    outline: none;
}

select.serah-form-control {
    appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%239a55ff' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 0.9rem center;
    background-size: 14px;
    padding-right: 2.5rem;
}

/* SURVEY STYLE CHECKBOX GRID */
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
    min-height: 56px;
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

.doc-badge {
    background: linear-gradient(135deg, #ffc107, #ffdb6d);
    color: #2c2e3f;
    padding: 0.3rem 0.65rem;
    border-radius: 999px;
    font-size: 0.7rem;
    font-weight: 700;
    white-space: nowrap;
    transition: all 0.25s ease;
}

.survey-checkbox-input:checked + .survey-checkbox-label .doc-badge {
    background: linear-gradient(135deg, #9a55ff, #da8cff);
    color: #ffffff;
    box-shadow: 0 2px 6px rgba(154, 85, 255, 0.25);
}

/* AGREEMENT GREEN CHECKBOX (ON / OFF) */
.agreement-checkbox-label {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 0.85rem 1rem;
    background: #f8fafc;
    border: 1.5px solid #e2e8f0;
    border-radius: 12px;
    cursor: pointer;
    transition: all 0.25s ease;
    margin-bottom: 0;
}

.agreement-checkbox-label .agreement-icon {
    font-size: 1.35rem;
    color: #cbd5e1;
    transition: all 0.25s ease;
}

.agreement-checkbox-label .agreement-text {
    font-size: 0.85rem;
    font-weight: 700;
    color: #64748b;
    transition: all 0.25s ease;
}

.survey-checkbox-input:checked + .agreement-checkbox-label {
    background: #f0fdf4;
    border-color: #22c55e;
    box-shadow: 0 4px 12px rgba(34, 197, 94, 0.18);
}

.survey-checkbox-input:checked + .agreement-checkbox-label .agreement-icon {
    color: #16a34a;
}

.survey-checkbox-input:checked + .agreement-checkbox-label .agreement-text {
    color: #15803d;
}

.serah-file-upload-modern {
    position: relative;
    width: 100%;
}

.serah-file-upload-modern input[type="file"] {
    position: absolute;
    opacity: 0;
    width: 100%;
    height: 100%;
    cursor: pointer;
    z-index: 2;
}

.serah-file-upload-modern .serah-file-label-modern {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 0.75rem 1rem;
    background: #ffffff;
    border: 1.5px dashed #cbd5e1;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.2s ease;
}

.serah-file-upload-modern:hover .serah-file-label-modern {
    border-color: #9a55ff;
    background: #fbf9ff;
}

.serah-file-upload-modern .serah-file-label-modern i {
    font-size: 1.5rem;
    color: #9a55ff;
}

.serah-file-upload-modern .serah-file-label-modern .serah-file-info-modern {
    flex: 1;
}

.serah-file-upload-modern .serah-file-label-modern .serah-file-info-modern span {
    display: block;
    font-weight: 700;
    color: #2c2e3f;
    font-size: 0.85rem;
}

.serah-file-upload-modern .serah-file-label-modern .serah-file-info-modern small {
    color: #8b8fa3;
    font-size: 0.75rem;
    display: block;
}

.serah-file-upload-modern .serah-file-label-modern .serah-file-size {
    font-size: 0.75rem;
    color: #9a55ff;
    font-weight: 700;
    background: rgba(154, 85, 255, 0.1);
    padding: 3px 8px;
    border-radius: 6px;
}

.serah-btn {
    border: none;
    border-radius: 10px;
    font-size: 0.92rem;
    font-weight: 700;
    padding: 0.75rem 1.5rem;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    transition: all 0.25s ease;
    cursor: pointer;
    width: 100%;
}

.serah-btn-success {
    background: linear-gradient(135deg, #28c76f, #48da89);
    color: #fff;
    box-shadow: 0 4px 12px rgba(40, 199, 111, 0.25);
}

.serah-btn-success:hover {
    color: #fff;
    box-shadow: 0 6px 18px rgba(40, 199, 111, 0.4);
    transform: translateY(-2px);
}

.approval-check-green .check-label {
    border-color: #d1f2dc;
    background: #f6fcf8;
}

.approval-check-green .check-label:hover {
    border-color: #28c76f;
    background: #edf9f3;
}

.approval-check-green .check-icon {
    background: #eefcf3;
    color: #28c76f;
}

.approval-check-green input[type="checkbox"]:checked + .check-label {
    border-color: #28c76f;
    background: #eefcf3;
    box-shadow: 0 4px 12px rgba(40, 199, 111, 0.15);
}

.approval-check-green input[type="checkbox"]:checked + .check-label .check-icon {
    background: #28c76f;
    color: #ffffff;
}

.approval-check-green input[type="checkbox"]:checked + .check-label .check-text {
    color: #15803d;
}

/* =========================================================
   RESPONSIVE DESIGN ENHANCEMENTS
   ========================================================= */

@media (max-width: 991.98px) {
    .transaksi-steps {
        overflow-x: auto;
        display: flex !important;
        justify-content: flex-start;
        gap: 1.25rem;
        padding: 0.5rem 0.25rem 1rem 0.25rem;
        scroll-snap-type: x mandatory;
        -webkit-overflow-scrolling: touch;
    }
    
    .transaksi-steps::-webkit-scrollbar {
        height: 5px;
    }
    .transaksi-steps::-webkit-scrollbar-track {
        background: #f1f5f9;
        border-radius: 10px;
    }
    .transaksi-steps::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 10px;
    }

    .transaksi-steps::before {
        display: none !important;
    }

    .transaksi-step {
        flex: 0 0 115px;
        scroll-snap-align: start;
    }

    .transaksi-step-title {
        white-space: normal !important;
        font-size: 0.82rem;
    }

    .transaksi-sticky {
        position: static !important;
        top: 0;
    }
}

@media (max-width: 767.98px) {
    .card-body {
        padding: 1.1rem !important;
    }

    .customer-header {
        flex-direction: column !important;
        align-items: stretch !important;
        gap: 1rem !important;
    }

    .customer-avatar {
        width: 48px;
        height: 48px;
    }

    .customer-avatar i {
        font-size: 1.7rem !important;
    }

    .customer-name {
        font-size: 1.1rem;
    }

    .customer-unit-info {
        display: flex !important;
        flex-direction: row !important;
        justify-content: space-between !important;
        width: 100% !important;
        padding: 0.65rem 0.85rem !important;
        gap: 0.5rem !important;
    }

    .customer-unit-info .info-item small {
        font-size: 0.68rem;
    }

    .customer-unit-info .info-item span {
        font-size: 0.82rem;
    }
}
</style>

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
                                        {{ $application->customer->full_name }}
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
                                        <span class="header-badge {{ $badgeClass }}">
                                            <i class="mdi {{ $icon }}"></i>
                                            {{ strtoupper($application->unit->jenis ?? '-') }}
                                        </span>
                                    </h4>
                                    <p class="customer-booking mb-0">Id Booking:
                                        {{ $application->booking->booking_code ?? '-' }}</p>
                                </div>
                            </div>

                            <div class="customer-unit-info">
                                <div class="info-item">
                                    <small>Unit</small>
                                    <span>{{ $application->unit->unit_name }}</span>
                                </div>
                                <div class="info-item">
                                    <small>Blok/No</small>
                                    <span>{{ $application->unit->unit_code ?? '-' }}</span>
                                </div>
                                <div class="info-item">
                                    <small>Harga Unit</small>
                                    <span class="text-primary fw-bold">Rp
                                        {{ number_format($application->unit->price ?? 0, 0, ',', '.') }}</span>
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
                            <span>Tahapan Serah Terima Unit</span>
                        </div>

                        @php
                            $jenis = strtolower($application->unit->jenis ?? '');
                            $isSubsidi = $jenis === 'subsidi';
                            $totalSteps = 7;

                            $unit = $application->unit ?? null;
                            $spkDone = !empty($unit?->no_spk) || !empty($unit?->dokumen_spk) || !empty($unit?->kontraktor);
                            $status = strtolower($unit->construction_progress ?? '');
                            $pembangunanDone = $status == 'selesai';
                            $surveyDone = true;
                            $akadDone = true;
                            $serahTerimaDone =
                                $application->booking->status == 'completed' &&
                                !empty($application->booking->serah_terima_date);

                            $completedCount = 2; // Pengajuan + Verifikasi
                            if ($spkDone) $completedCount++;
                            if ($pembangunanDone) $completedCount++;
                            if ($surveyDone) $completedCount++;
                            if ($akadDone) $completedCount++;
                            if ($serahTerimaDone) $completedCount++;

                            $progressWidth = intval(($completedCount / $totalSteps) * 100);
                            $stepStyle = 'style="grid-template-columns: repeat(' . $totalSteps . ', 1fr);"';
                        @endphp

                        <div class="transaksi-progress-top">
                            <span class="transaksi-muted">Progress Transaksi</span>
                            <span>Tahap {{ $completedCount }} dari {{ $totalSteps }}</span>
                        </div>

                        <div class="transaksi-progress">
                            <div class="transaksi-progress-bar" style="width: {{ $progressWidth }}%;"></div>
                        </div>

                        @php
                            $bookingId = $application->booking_id ?? optional($application->booking)->id;
                            $unitId = $application->unit_id ?? optional($application->unit)->id;
                            $landBankId = optional($application->unit)->land_bank_id ?? 1;

                            $urlPengajuan = $bookingId ? route('pengajuan.show', $bookingId) : '#';
                            $urlVerifikasi = $bookingId ? route('transaksi.kpr.approve', $bookingId) : '#';

                            $spkModel = null;
                            if ($application->unit) {
                                $spkModel = \App\Models\Spk::where('land_bank_unit_id', $application->unit->id)
                                    ->orWhere(function ($q) use ($application) {
                                        if (!empty($application->unit->no_spk)) {
                                            $q->where('no_spk', $application->unit->no_spk);
                                        } else {
                                            $q->whereRaw('0 = 1');
                                        }
                                    })->first();
                            }
                            $urlSpk = $spkModel ? route('spk.show', $spkModel->id) : route('spk.index');

                            $urlPembangunan = route('properti.progress', [
                                'land_bank_id' => $landBankId,
                                'unit_id' => $unitId,
                            ]);

                            $urlSurvey = route('kpr.survey', $application->id);
                            $urlAkad = $bookingId ? url('/transaksi/kpr/akad-kpr/' . $bookingId) : '#';
                            $urlSerahTerima = route('kpr.serahterima', $application->id);
                        @endphp

                        <div class="transaksi-steps" {!! $stepStyle !!}>
                            {{-- Tahap 1: Pengajuan --}}
                            <div class="transaksi-step completed">
                                <a href="{{ $urlPengajuan }}" class="transaksi-step-icon" title="Buka Halaman Pengajuan KPR">
                                    <i class="mdi mdi-check"></i>
                                </a>
                                <a href="{{ $urlPengajuan }}" class="transaksi-step-title-link" title="Buka Halaman Pengajuan KPR">
                                    <span class="transaksi-step-title">Pengajuan</span>
                                </a>
                                <small>{{ \Carbon\Carbon::parse($application->created_at)->translatedFormat('j F Y') }}</small>
                            </div>

                            {{-- Tahap 2: Verifikasi --}}
                            <div class="transaksi-step completed">
                                <a href="{{ $urlVerifikasi }}" class="transaksi-step-icon" title="Buka Halaman Verifikasi KPR">
                                    <i class="mdi mdi-check"></i>
                                </a>
                                <a href="{{ $urlVerifikasi }}" class="transaksi-step-title-link" title="Buka Halaman Verifikasi KPR">
                                    <span class="transaksi-step-title">Verifikasi</span>
                                </a>
                                <small>{{ $application->submitted_at ? \Carbon\Carbon::parse($application->submitted_at)->translatedFormat('j F Y') : '-' }}</small>
                            </div>

                            {{-- Tahap 3: SPK --}}
                            <div class="transaksi-step {{ $spkDone ? 'completed' : '' }}">
                                <a href="{{ $urlSpk }}" class="transaksi-step-icon" title="{{ $spkModel ? 'Lihat Detail SPK (' . $spkModel->no_spk . ')' : 'Buka Manajemen SPK Kontraktor' }}">
                                    @if ($spkDone)
                                        <i class="mdi mdi-check"></i>
                                    @else
                                        <i class="mdi mdi-clipboard-text"></i>
                                    @endif
                                </a>
                                <a href="{{ $urlSpk }}" class="transaksi-step-title-link" title="{{ $spkModel ? 'Lihat Detail SPK (' . $spkModel->no_spk . ')' : 'Buka Manajemen SPK Kontraktor' }}">
                                    <span class="transaksi-step-title">SPK</span>
                                </a>
                                <small>
                                    @if ($spkDone)
                                        Selesai
                                    @else
                                        Menunggu
                                    @endif
                                </small>
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

                            {{-- Tahap 4: Pembangunan --}}
                            <div class="transaksi-step {{ $pembangunanDone ? 'completed' : '' }}">
                                <a href="{{ $urlPembangunan }}" class="transaksi-step-icon" title="Buka Monitoring Progress Pembangunan Unit">
                                    @if ($pembangunanDone)
                                        <i class="mdi mdi-check"></i>
                                    @else
                                        <i class="mdi mdi-home-city"></i>
                                    @endif
                                </a>
                                <a href="{{ $urlPembangunan }}" class="transaksi-step-title-link" title="Buka Monitoring Progress Pembangunan Unit">
                                    <span class="transaksi-step-title">Pembangunan</span>
                                </a>
                                <small>{{ $statusText[$status] ?? 'Belum mulai pembangunan' }}</small>
                            </div>

                            {{-- Tahap 5: Survey --}}
                            <div class="transaksi-step completed">
                                <a href="{{ $urlSurvey }}" class="transaksi-step-icon" title="Buka Halaman Hasil Survey Lapangan KPR">
                                    <i class="mdi mdi-check"></i>
                                </a>
                                <a href="{{ $urlSurvey }}" class="transaksi-step-title-link" title="Buka Halaman Hasil Survey Lapangan KPR">
                                    <span class="transaksi-step-title">Survey</span>
                                </a>
                                <small>{{ $application->updated_at ? \Carbon\Carbon::parse($application->updated_at)->translatedFormat('j F Y') : '-' }}</small>
                            </div>

                            {{-- Tahap 6: Akad --}}
                            <div class="transaksi-step completed">
                                <a href="{{ $urlAkad }}" class="transaksi-step-icon" title="Buka Halaman Akad KPR">
                                    <i class="mdi mdi-check"></i>
                                </a>
                                <a href="{{ $urlAkad }}" class="transaksi-step-title-link" title="Buka Halaman Akad KPR">
                                    <span class="transaksi-step-title">Akad</span>
                                </a>
                                <small>{{ $application->akad_at ? \Carbon\Carbon::parse($application->akad_at)->translatedFormat('j F Y') : '-' }}</small>
                            </div>

                            {{-- Tahap 7: Serah Terima --}}
                            <div class="transaksi-step active {{ $serahTerimaDone ? 'completed' : '' }}">
                                <a href="{{ $urlSerahTerima }}" class="transaksi-step-icon" title="Halaman Serah Terima Unit (Saat Ini)">
                                    @if ($serahTerimaDone)
                                        <i class="mdi mdi-check"></i>
                                    @else
                                        <i class="mdi mdi-key"></i>
                                    @endif
                                </a>
                                <a href="{{ $urlSerahTerima }}" class="transaksi-step-title-link" title="Halaman Serah Terima Unit (Saat Ini)">
                                    <span class="transaksi-step-title">Serah Terima</span>
                                </a>
                                <small>
                                    @if ($serahTerimaDone)
                                        {{ \Carbon\Carbon::parse($application->booking->serah_terima_date)->translatedFormat('d F Y') }}
                                    @else
                                        Dalam Proses
                                    @endif
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="transaksi-section-title">
                            <i class="mdi mdi-cash-multiple"></i>
                            <span>Status KPR</span>
                        </div>

                        <div class="transaksi-detail-list">
                            <div class="transaksi-detail-item">
                                <span>Harga Unit</span>
                                <span>Rp {{ number_format($application->unit->price ?? 0, 0, ',', '.') }}</span>
                            </div>
                            <div class="transaksi-detail-item">
                                <span>Uang Muka (DP)</span>
                                <span class="highlight">Rp
                                    {{ number_format($application->booking->booking_fee ?? 0, 0, ',', '.') }}</span>
                            </div>
                            <div class="transaksi-detail-item">
                                <span>Bank</span>
                                <span>{{ $application->bank->bank_name ?? '-' }}</span>
                            </div>
                            <div class="transaksi-detail-item">
                                <span>Status KPR</span>
                                <span>
                                    <span class="payment-method-badge badge-gradient-success text-white">
                                        <i class="mdi mdi-check-circle-outline"></i>Disetujui
                                    </span>
                                </span>
                            </div>
                            <div class="transaksi-detail-item">
                                <span>Promo</span>
                                <span>{{ $application->promo_name ?? '-' }}</span>
                            </div>
                            <div class="transaksi-detail-item">
                                <span>Nilai Promo</span>
                                <span>Rp {{ number_format($application->promo_value ?? 0, 0, ',', '.') }}</span>
                            </div>
                        </div>

                        <hr class="my-4">

                        <small class="transaksi-muted d-block mb-2">Ditangani oleh</small>
                        <div class="transaksi-handler">
                            <div class="transaksi-handler-icon">
                                <i class="mdi mdi-account-tie"></i>
                            </div>
                            <div>
                                <div class="fw-bold">{{ $application->booking->sales->name ?? ($booking->sales->name ?? ($application->unit->activeBooking->sales->name ?? 'Staff Marketing')) }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <form action="{{ route('serah-terima.store', $booking->id) }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row mt-4 align-items-start">
                <div class="col-12 col-lg-8 mb-4 mb-lg-0">
                    <div class="card shadow-sm border-0">
                        <div class="card-body p-3 p-md-4">
                            <div class="transaksi-section-title">
                                <i class="mdi mdi-key"></i>
                                <span>Form Serah Terima Unit</span>
                            </div>

                            <div class="transaksi-inline-alert info">
                                <i class="mdi mdi-information-outline"></i>
                                <div>Silakan isi data serah terima, dokumen yang diserahkan, dan dokumentasi pendukung. Checklist kondisi kelayakan fisik unit diverifikasi langsung melalui <strong>Progress Pembangunan RAP</strong>.</div>
                            </div>

                            <div class="row g-3">
                                <div class="col-12 col-md-6">
                                    <div class="serah-form-group">
                                        <label class="serah-form-label">Tanggal Serah Terima</label>
                                        <input type="date" name="tanggal_serah_terima" class="serah-form-control"
                                            value="{{ date('Y-m-d') }}">
                                    </div>
                                </div>

                                <div class="col-12 col-md-6">
                                    <div class="serah-form-group">
                                        <label class="serah-form-label">No. BAST</label>
                                        <input type="text" name="no_bast" class="serah-form-control"
                                            placeholder="BAST-2026/09/001" value="{{ $noBast ?? '' }}">
                                    </div>
                                </div>
                            </div>

                            <div class="serah-form-group mt-3">
                                <label class="serah-form-label">Lokasi Serah Terima</label>
                                <select name="lokasi_serah_terima" class="serah-form-control">
                                    <option value="site">Di Site / Proyek</option>
                                    <option value="kantor">Di Kantor Marketing</option>
                                    <option value="lainnya">Lainnya</option>
                                </select>
                            </div>

                            <hr class="my-4">

                            @php
                                $unitProgress = optional(optional($application)->unit)->progress;
                                $savedChecklist = $unitProgress ? ($unitProgress->checklist_kondisi ?? []) : [];
                                if (!is_array($savedChecklist)) {
                                    $savedChecklist = json_decode($savedChecklist, true) ?: [];
                                }
                                $kondisiItems = [
                                    'listrik' => 'Listrik berfungsi normal',
                                    'air' => 'Air mengalir lancar',
                                    'pintu_jendela' => 'Pintu & jendela berfungsi baik',
                                    'kunci_lengkap' => 'Kunci lengkap (pintu utama, pagar)',
                                    'dinding_plafon' => 'Dinding & plafon baik',
                                    'lantai' => 'Lantai keramik baik',
                                    'sanitasi' => 'Kloset & sanitasi berfungsi',
                                    'meteran' => 'Meteran listrik & air terpasang',
                                ];
                                $totalKondisi = count($kondisiItems);
                                $terpenuhi = 0;
                                foreach ($kondisiItems as $kKey => $kLabel) {
                                    if (empty($savedChecklist) || !empty($savedChecklist[$kKey])) {
                                        $terpenuhi++;
                                    }
                                }
                                $isAllReady = ($terpenuhi === $totalKondisi);
                                $urlProgressRap = route('properti.progress', [
                                    'land_bank_id' => $application->unit->land_bank_id ?? 1,
                                    'unit_id' => $application->unit_id ?? ($booking->unit_id ?? 1),
                                ]);
                            @endphp

                            <div class="card border-0 mb-3" style="background: #faf7ff; border: 1.5px solid #e9d5ff !important; border-radius: 12px;">
                                <div class="card-body p-3 p-md-4">
                                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-2 mb-3">
                                        <div class="d-flex align-items-center gap-2">
                                            <div style="width: 38px; height: 38px; border-radius: 10px; background: rgba(154, 85, 255, 0.15); color: #9a55ff; display: flex; align-items: center; justify-content: center; font-size: 1.25rem;">
                                                <i class="mdi mdi-checkbox-marked-circle-outline"></i>
                                            </div>
                                            <div>
                                                <h6 class="fw-bold text-dark mb-0" style="font-size: 0.95rem;">Checklist Kondisi Unit</h6>
                                                <small class="text-muted">Kondisi fisik unit diverifikasi langsung pada <strong>Progress Pembangunan RAP</strong></small>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center gap-2 flex-wrap">
                                            <span class="badge {{ $isAllReady ? 'bg-success-subtle text-success' : 'bg-warning-subtle text-warning' }} px-3 py-1.5 rounded-pill fw-bold" style="font-size: 0.8rem; border: 1px solid {{ $isAllReady ? '#bbf7d0' : '#fef08a' }};">
                                                <i class="mdi {{ $isAllReady ? 'mdi-check-decagram' : 'mdi-alert-circle' }} me-1"></i>
                                                {{ $terpenuhi }}/{{ $totalKondisi }} Kondisi Terpenuhi
                                            </span>
                                            <a href="{{ $urlProgressRap }}" target="_blank" class="btn btn-sm btn-outline-primary rounded-pill px-3 fw-semibold d-inline-flex align-items-center gap-1" style="font-size: 0.78rem;">
                                                <i class="mdi mdi-open-in-new"></i> Buka Progress RAP
                                            </a>
                                        </div>
                                    </div>

                                    <div class="row g-2">
                                        @foreach ($kondisiItems as $field => $label)
                                            @php
                                                $ok = empty($savedChecklist) ? true : !empty($savedChecklist[$field]);
                                            @endphp
                                            <div class="col-12 col-md-6">
                                                <div class="d-flex align-items-center justify-content-between px-3 py-2 bg-white rounded-3 border" style="border-color: #ede4ff !important;">
                                                    <div class="d-flex align-items-center gap-2">
                                                        <i class="mdi {{ $ok ? 'mdi-check-circle text-success' : 'mdi-close-circle text-danger' }}" style="font-size: 1.15rem;"></i>
                                                        <span class="small fw-semibold text-dark">{{ $label }}</span>
                                                    </div>
                                                    <span class="badge {{ $ok ? 'bg-success-subtle text-success' : 'bg-danger-subtle text-danger' }} rounded-pill" style="font-size: 0.68rem;">
                                                        {{ $ok ? 'Terpenuhi' : 'Belum' }}
                                                    </span>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <hr class="my-4">

                            <div class="transaksi-section-title mb-3">
                                <i class="mdi mdi-file-document-check-outline"></i>
                                <span>Dokumen yang Diserahkan</span>
                            </div>

                            <div class="survey-checklist-grid">
                                @php
                                    $dokumenItems = [
                                        'doc_kunci' => 'Kunci Unit (3 buah)',
                                        'doc_ajb' => 'Akta Jual Beli (AJB)',
                                        'doc_shm' => 'Sertifikat Hak Milik (SHM)',
                                        'doc_imb' => 'IMB / PBG',
                                    ];
                                @endphp
                                @foreach ($dokumenItems as $field => $label)
                                    <div class="survey-checkbox-wrapper">
                                        <input type="checkbox" class="survey-checkbox-input" id="{{ $field }}"
                                            name="{{ $field }}" value="1" checked>
                                        <label class="survey-checkbox-label d-flex justify-content-between align-items-center" for="{{ $field }}">
                                            <div class="d-flex align-items-center gap-2">
                                                <i class="mdi mdi-check-circle survey-check-icon"></i>
                                                <span class="survey-check-text">{{ $label }}</span>
                                            </div>
                                            <span class="doc-badge">Wajib</span>
                                        </label>
                                    </div>
                                @endforeach
                            </div>

                            <hr class="my-4">

                            <div class="transaksi-section-title mb-3">
                                <i class="mdi mdi-camera-outline"></i>
                                <span>Dokumentasi Serah Terima</span>
                            </div>

                            <div class="row g-3">
                                <div class="col-12 col-md-6">
                                    <div class="serah-form-group mb-0">
                                        <label class="serah-form-label">Foto Penyerahan Kunci</label>
                                        <div class="serah-file-upload-modern">
                                            <input type="file" name="foto_serah_kunci" accept=".jpg,.jpeg,.png">
                                            <div class="serah-file-label-modern">
                                                <i class="mdi mdi-cloud-upload"></i>
                                                <div class="serah-file-info-modern">
                                                    <span>Upload Foto Kunci</span>
                                                    <small>Format: JPG, PNG (Max 5MB)</small>
                                                </div>
                                                <span class="serah-file-size" style="display:none;"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-md-6">
                                    <div class="serah-form-group mb-0">
                                        <label class="serah-form-label">Foto Bersama Unit</label>
                                        <div class="serah-file-upload-modern">
                                            <input type="file" name="foto_unit" accept=".jpg,.jpeg,.png">
                                            <div class="serah-file-label-modern">
                                                <i class="mdi mdi-cloud-upload"></i>
                                                <div class="serah-file-info-modern">
                                                    <span>Upload Foto Unit</span>
                                                    <small>Format: JPG, PNG (Max 5MB)</small>
                                                </div>
                                                <span class="serah-file-size" style="display:none;"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr class="my-4">

                            <div class="serah-form-group mb-0">
                                <label class="serah-form-label">Catatan Tambahan</label>
                                <textarea name="catatan" rows="3" class="serah-form-control"
                                    placeholder="Tambahkan catatan serah terima bila diperlukan..."></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-4 mb-4 mb-lg-0">
                    <div class="card shadow-sm border-0 sticky-top" style="top: 20px; z-index: 5;">
                        <div class="card-body p-3 p-md-4">
                            <div class="transaksi-section-title">
                                <i class="mdi mdi-clipboard-text-outline"></i>
                                <span>Informasi Serah Terima</span>
                            </div>

                            <div class="d-flex align-items-center gap-2 mb-3 text-dark fw-bold" style="font-size: 0.92rem;">
                                <i class="mdi mdi-key text-primary" style="font-size: 1.25rem;"></i>
                                <span>Tahap Final Transaksi</span>
                            </div>

                            <div class="mb-3 text-muted" style="font-size: 0.88rem; line-height: 1.6;">
                                <div><span class="text-secondary">Status Unit:</span> <span class="fw-bold text-dark d-block">Siap</span></div>
                                <div class="mt-1"><span class="text-secondary">Tahap:</span> <span class="fw-bold text-dark d-block">Serah Terima</span></div>
                            </div>

                            <hr class="my-3">

                            <div class="transaksi-sidebar-section mb-3">
                                <div class="transaksi-sidebar-title fw-bold text-dark mb-2" style="font-size: 0.92rem;">Persetujuan</div>

                                <div class="serah-form-group mb-3">
                                    <label class="serah-form-label fw-bold" style="font-size: 0.84rem;">Saksi (Opsional)</label>
                                    <input type="text" name="saksi" class="serah-form-control"
                                        placeholder="Nama saksi">
                                </div>

                                <div class="serah-form-group mb-0">
                                    <div class="survey-checkbox-wrapper" style="width: 100%;">
                                        <input type="checkbox" name="persetujuan" value="1"
                                            id="persetujuan" class="survey-checkbox-input" required checked>
                                        <label for="persetujuan" class="agreement-checkbox-label">
                                            <i class="mdi mdi-check-circle agreement-icon"></i>
                                            <span class="agreement-text">Saya menyatakan unit diterima dalam kondisi baik.</span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <hr class="my-3">

                            <div class="transaksi-sidebar-section mb-3">
                                <div class="transaksi-sidebar-title fw-bold text-dark mb-2" style="font-size: 0.92rem;">Panduan Proses</div>
                                <ul class="transaksi-mini-list mb-0" style="padding-left: 0; list-style: none;">
                                    <li class="d-flex align-items-start gap-2 mb-2 text-muted" style="font-size: 0.82rem;">
                                        <i class="mdi mdi-arrow-right-circle-outline text-primary mt-0.5"></i>
                                        <span>Pastikan kondisi unit telah diverifikasi di Progress Pembangunan RAP.</span>
                                    </li>
                                    <li class="d-flex align-items-start gap-2 mb-2 text-muted" style="font-size: 0.82rem;">
                                        <i class="mdi mdi-arrow-right-circle-outline text-primary mt-0.5"></i>
                                        <span>Pastikan dokumen wajib yang diserahkan sudah ditandai dengan benar.</span>
                                    </li>
                                    <li class="d-flex align-items-start gap-2 text-muted" style="font-size: 0.82rem;">
                                        <i class="mdi mdi-arrow-right-circle-outline text-primary mt-0.5"></i>
                                        <span>Upload dokumentasi pendukung untuk mempermudah arsip serah terima.</span>
                                    </li>
                                </ul>
                            </div>

                            <div class="mt-4">
                                <button type="submit" class="serah-btn serah-btn-success">
                                    <i class="mdi mdi-check-circle-outline"></i>
                                    Proses Serah Terima
                                </button>
                                <div class="text-center mt-2.5">
                                    <small class="transaksi-muted" style="font-size: 0.78rem;">
                                        <i class="mdi mdi-information-outline me-1"></i>
                                        Pastikan semua checklist terisi
                                    </small>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('.serah-file-upload-modern input[type="file"]').change(function(e) {
                const file = e.target.files[0];
                const $container = $(this).closest('.serah-file-upload-modern');
                const label = $container.find('.serah-file-info-modern span');
                const sizeSpan = $container.find('.serah-file-size');

                if (file) {
                    const fileName = file.name;
                    const fileSize = (file.size / (1024 * 1024)).toFixed(2);

                    label.text(fileName.length > 30 ? fileName.substring(0, 30) + '...' : fileName);
                    sizeSpan.text(fileSize + ' MB').show();
                } else {
                    if ($(this).attr('name') === 'foto_serah_kunci') {
                        label.text('Upload Foto Kunci');
                    } else {
                        label.text('Upload Foto Unit');
                    }
                    sizeSpan.text('').hide();
                }
            });

            // Notifikasi Sukses Setelah Refresh
            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: '{{ session('success') }}',
                    confirmButtonColor: '#9a55ff',
                    timer: 3500,
                    timerProgressBar: true
                });
            @endif

            // Notifikasi Error Jika Terjadi Kesalahan
            @if (session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: '{{ session('error') }}',
                    confirmButtonColor: '#ff4747'
                });
            @endif

            // Intercept Submit Form untuk Konfirmasi & Loading
            $('form').on('submit', function(e) {
                e.preventDefault();
                const form = this;

                // Cek apakah checkbox persetujuan sudah di-centang
                if (!$('#persetujuan').is(':checked')) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Perhatian',
                        text: 'Silakan centang pernyataan persetujuan terlebih dahulu.',
                        confirmButtonColor: '#9a55ff'
                    });
                    return false;
                }

                // Munculkan Konfirmasi SweetAlert
                Swal.fire({
                    title: 'Proses Serah Terima?',
                    text: 'Pastikan data dan dokumentasi sudah sesuai.',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#28a745',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, Proses Sekarang',
                    cancelButtonText: 'Cek Kembali'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // TAMPILKAN LOADING
                        Swal.fire({
                            title: 'Sedang Memproses...',
                            text: 'Mohon tunggu sebentar, jangan menutup halaman ini.',
                            allowOutsideClick: false,
                            showConfirmButton: false,
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        });

                        // Kirim Form
                        form.submit();
                    }
                });
            });
        });
    </script>
@endpush
