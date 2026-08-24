@extends('layouts.partial.app')

@section('title', 'Verifikasi KPR - Properti Management')
@section('content')
<style>
/* =========================================================
   TRANSAKSI VERIFIKASI KPR STYLES
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

.transaksi-progress-top .step-counter-purple {
    color: #9a55ff !important;
    font-weight: 700;
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
    color: #94a3b8;
    transition: all 0.25s ease;
}

.transaksi-step.completed .transaksi-step-icon,
.transaksi-step.active .transaksi-step-icon {
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

.summary-state {
    display: inline-flex;
    align-items: center;
    gap: 0.4rem;
    padding: 0.4rem 0.8rem;
    border-radius: 20px;
    font-size: 0.82rem;
    font-weight: 700;
    background: #f1f5f9;
    color: #64748b;
}

.transaksi-decision-summary.approve .summary-state {
    background: #dcfce7;
    color: #15803d;
}

.transaksi-decision-summary.reject .summary-state {
    background: #fee2e2;
    color: #b91c1c;
}

/* DECISION RADIO CARDS */
.transaksi-decision-card {
    position: relative;
    height: 100%;
}

.transaksi-decision-card input[type="radio"] {
    display: none;
}

.transaksi-decision-label {
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

.transaksi-decision-icon {
    width: 44px;
    height: 44px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.35rem;
    flex-shrink: 0;
}

.transaksi-decision-card.approve .transaksi-decision-icon {
    background: #eefcf3;
    color: #28c76f;
}

.transaksi-decision-card.reject .transaksi-decision-icon {
    background: #fef2f2;
    color: #ea5455;
}

.transaksi-decision-content {
    flex: 1;
}

.transaksi-decision-title {
    font-size: 0.98rem;
    font-weight: 700;
    color: #2c2e3f;
    margin-bottom: 0.25rem;
}

.transaksi-decision-desc {
    font-size: 0.82rem;
    color: #64748b;
    line-height: 1.35;
}

.transaksi-decision-check {
    font-size: 1.25rem;
    color: #cbd5e1;
    transition: all 0.25s ease;
}

.transaksi-decision-card.approve input[type="radio"]:checked + .transaksi-decision-label {
    border-color: #28c76f;
    background: #f6fcf8;
    box-shadow: 0 6px 18px rgba(40, 199, 111, 0.15);
}

.transaksi-decision-card.approve input[type="radio"]:checked + .transaksi-decision-label .transaksi-decision-check {
    color: #28c76f;
}

.transaksi-decision-card.reject input[type="radio"]:checked + .transaksi-decision-label {
    border-color: #ea5455;
    background: #fff8f8;
    box-shadow: 0 6px 18px rgba(234, 84, 85, 0.15);
}

.transaksi-decision-card.reject input[type="radio"]:checked + .transaksi-decision-label .transaksi-decision-check {
    color: #ea5455;
}

/* FORM SHELL */
.transaksi-form-shell {
    display: none;
    border-radius: 12px;
    padding: 1.25rem;
    margin-top: 1.25rem;
}

.transaksi-form-shell.approve {
    background: #f6fcf8;
    border: 1.5px solid #d1f2dc;
}

.transaksi-form-shell.reject {
    background: #fff8f8;
    border: 1.5px solid #fed7d7;
}

.transaksi-form-title {
    font-size: 1rem;
    font-weight: 700;
    margin-bottom: 1rem;
}

.transaksi-form-title.approve {
    color: #15803d;
}

.transaksi-form-title.reject {
    color: #b91c1c;
}

.transaksi-form-group {
    margin-bottom: 1rem;
}

.transaksi-form-label {
    display: block;
    font-size: 0.85rem;
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

/* FILE UPLOAD STYLING */
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

.transaksi-file-info span {
    display: block;
    font-size: 0.85rem;
    font-weight: 700;
    color: #2c2e3f;
}

.transaksi-file-info small {
    display: block;
    font-size: 0.75rem;
    color: #8b8fa3;
}

/* NEXT STEP RADIO GRID */
.transaksi-next-step-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 0.65rem;
}

.transaksi-next-card input[type="radio"] {
    display: none;
}

.transaksi-next-label {
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

.transaksi-next-icon {
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

.transaksi-next-content {
    flex: 1;
    display: flex;
    flex-direction: column;
}

.transaksi-next-title {
    font-size: 0.88rem;
    font-weight: 700;
    color: #2c2e3f;
}

.transaksi-next-desc {
    font-size: 0.75rem;
    color: #8b8fa3;
    line-height: 1.3;
}

.transaksi-next-check {
    font-size: 1.15rem;
    color: #cbd5e1;
}

.transaksi-next-card input[type="radio"]:checked + .transaksi-next-label {
    border-color: #9a55ff;
    background: #faf7ff;
}

.transaksi-next-card input[type="radio"]:checked + .transaksi-next-label .transaksi-next-icon {
    background: linear-gradient(135deg, #da8cff, #9a55ff);
    color: #ffffff;
}

.transaksi-next-card input[type="radio"]:checked + .transaksi-next-label .transaksi-next-check {
    color: #9a55ff;
}

/* ACTION BAR */
.transaksi-action-bar {
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

.transaksi-error-box {
    display: none;
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
                                        {{ $booking->customer->full_name ?? '-' }}
                                        @php
                                            $jenis = strtolower($booking->unit->jenis ?? '');
                                            $badgeClass =
                                                $jenis == 'subsidi'
                                                    ? 'badge-gradient-success'
                                                    : ($jenis == 'komersil'
                                                        ? 'badge-gradient-primary'
                                                        : 'badge-gradient-secondary');
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
                                    <span class="text-primary fw-bold">Rp
                                        {{ number_format($booking->unit->price ?? 0, 0, ',', '.') }}</span>
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
                            $isSubsidi = $jenis === 'subsidi';
                            $isKomersil = $jenis === 'komersil';

                            $totalSteps = 7;
                            $currentStep = 2; // default: verifikasi

                            // =======================
                            // STATUS CHECK
                            // =======================

                            $spkDone = !empty($booking->unit->dokumen_spk);

                            $developmentDone =
                                ($booking->status_pembangunan ?? 0) == 1 ||
                                optional($booking->kprApplication)->status_pembangunan == 'done';

                            $surveyDone =
                                ($booking->status_survey ?? 0) == 1 ||
                                optional($booking->kprApplication)->status_survey == 'done';

                            $akadDone =
                                ($booking->status_akad ?? 0) == 1 ||
                                optional($booking->kprApplication)->status_akad == 1;

                            $serahTerimaDone =
                                ($booking->status_serahterima ?? 0) == 1 ||
                                optional($booking->kprApplication)->status_serahterima == 1;

                            // =======================
                            // STEP FLOW (URUT)
                            // =======================

                            $verifikasiDone = in_array(strtolower(optional($booking->kprApplication)->status ?? ''), ['approved', 'rejected', 'analisa']);

                            if ($spkDone) {
                                $currentStep = 3;
                            }

                            if ($developmentDone) {
                                $currentStep = 4;
                            }

                            if ($surveyDone) {
                                $currentStep = 5;
                            }

                            if ($akadDone) {
                                $currentStep = 6;
                            }

                            if ($serahTerimaDone) {
                                $currentStep = 7;
                            }

                            // If not verified yet, we are still on step 1 (Pengajuan) in terms of overall progress
                            if (!$verifikasiDone) {
                                $currentStep = 1;
                            }

                            // =======================
                            // UI HELPER
                            // =======================

                            $progressWidth = intval(($currentStep / $totalSteps) * 100);

                            $stepsStyle = 'style="grid-template-columns: repeat(' . $totalSteps . ', 1fr);"';

                            $stepClass = function($index) use ($currentStep, $verifikasiDone) {
                                if ($index === 1) {
                                    return 'completed';
                                }
                                if (!$verifikasiDone && $index >= 2) {
                                    return '';
                                }
                                return $index < $currentStep
                                    ? 'completed'
                                    : ($index == $currentStep
                                        ? 'active'
                                        : '');
                            };
                        @endphp

                        <div class="transaksi-progress-top">
                            <span class="transaksi-muted">Progress Proses</span>
                            <span class="step-counter-purple">Tahap {{ $currentStep }} dari {{ $totalSteps }}</span>
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
                                <div class="transaksi-step-icon">
                                    @if ($verifikasiDone)
                                        <i class="mdi mdi-check"></i>
                                    @else
                                        <i class="mdi mdi-file-document-edit-outline"></i>
                                    @endif
                                </div>
                                <span class="transaksi-step-title">Verifikasi</span>
                                <small>{{ $verifikasiDone ? 'Selesai' : 'Belum Selesai' }}</small>
                            </div>

                            <div class="transaksi-step {{ $spkDone ? 'completed' : ($currentStep == 3 ? 'active' : '') }}">
                                @if ($spkDone)
                                    <div class="transaksi-step-icon">
                                        <i class="mdi mdi-check"></i>
                                    </div>
                                @else
                                    <div class="transaksi-step-icon">
                                        <i class="mdi mdi-clipboard-text"></i>
                                    </div>
                                @endif

                                <span class="transaksi-step-title">SPK</span>
                                <small>
                                    {{ $spkDone ? 'Selesai' : ($currentStep == 3 ? 'Dalam Proses' : 'Menunggu') }}
                                </small>
                            </div>

                            @php
                                $statusProgress = strtolower($booking->unit->construction_progress ?? '');

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

                                $config = $statusConfig[$statusProgress] ?? [
                                    'icon' => 'mdi-home-city',
                                    'color' => 'secondary',
                                ];
                            @endphp

                            <div
                                class="transaksi-step {{ $statusProgress == 'selesai' ? 'completed' : ($currentStep == 4 ? 'active' : '') }}">
                                @if ($statusProgress == 'selesai')
                                    <div class="transaksi-step-icon">
                                        <i class="mdi mdi-check"></i>
                                    </div>
                                @else
                                    <div class="transaksi-step-icon">
                                        <i class="mdi {{ $config['icon'] }}"></i>
                                    </div>
                                @endif
                                <span class="transaksi-step-title">Pembangunan</span>
                                <small>{{ $statusText[$statusProgress] ?? ($developmentDone ? 'Pembangunan selesai' : ($currentStep == 4 ? 'Dalam Proses' : 'Menunggu')) }}</small>
                            </div>

                            @if ($isSubsidi)
                                <div class="transaksi-step {{ $stepClass(5) }}">
                                    <div class="transaksi-step-icon"><i class="mdi mdi-home-search-outline"></i></div>
                                    <span class="transaksi-step-title">Survey</span>
                                    <small>{{ $surveyDone ? 'Selesai' : ($currentStep == 5 ? 'Dalam Proses' : 'Menunggu') }}</small>
                                </div>
                                <div class="transaksi-step {{ $stepClass(6) }}">
                                    <div class="transaksi-step-icon"><i class="mdi mdi-handshake-outline"></i></div>
                                    <span class="transaksi-step-title">Akad</span>
                                    <small>{{ $akadDone ? 'Selesai' : ($currentStep == 6 ? 'Dalam Proses' : 'Menunggu') }}</small>
                                </div>
                            @else
                                <div class="transaksi-step {{ $stepClass(5) }}">
                                    <div class="transaksi-step-icon"><i class="mdi mdi-home-search-outline"></i></div>
                                    <span class="transaksi-step-title">Survey</span>
                                    <small>{{ $surveyDone ? 'Selesai' : ($currentStep == 5 ? 'Dalam Proses' : 'Menunggu') }}</small>
                                </div>
                                <div class="transaksi-step {{ $stepClass(6) }}">
                                    <div class="transaksi-step-icon"><i class="mdi mdi-handshake-outline"></i></div>
                                    <span class="transaksi-step-title">Akad</span>
                                    <small>{{ $akadDone ? 'Selesai' : ($currentStep == 6 ? 'Dalam Proses' : 'Menunggu') }}</small>
                                </div>
                            @endif
                            <div class="transaksi-step {{ $stepClass(7) }}">
                                <div class="transaksi-step-icon"><i class="mdi mdi-cash-fast"></i></div>
                                <span class="transaksi-step-title">Serah Terima</span>
                                <small>{{ $serahTerimaDone ? 'Selesai' : ($currentStep == 7 ? 'Dalam Proses' : 'Menunggu') }}</small>
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
                                <span>Rp
                                    {{ number_format($booking->kprApplication->jumlah_pinjaman ?? 0, 0, ',', '.') }}</span>
                            </div>
                            <div class="transaksi-detail-item">
                                <span>Tenor</span>
                                <span>{{ $booking->kprApplication->tenor ?? '-' }} Tahun</span>
                            </div>
                            <div class="transaksi-detail-item">
                                <span>Angsuran / bln</span>
                                <span class="highlight">Rp
                                    {{ number_format($booking->kprApplication->estimasi_angsuran ?? 0, 0, ',', '.') }}
                                </span>
                            </div>


                            <div class="transaksi-detail-item">
                                <span>Promo</span>
                                <span>
                                    {{ $booking->kprApplication->promo_name ?? '-' }}
                                </span>
                            </div>

                            <div class="transaksi-detail-item">
                                <span>Nilai Promo</span>
                                <span>
                                    Rp {{ number_format($booking->kprApplication->promo_value ?? 0, 0, ',', '.') }}
                                </span>
                            </div>
                        </div>
                        <hr class="my-4">
                        <small class="transaksi-muted d-block mb-2">Ditangani oleh</small>
                        <div class="transaksi-handler">
                            <div class="transaksi-handler-icon"><i class="mdi mdi-account-tie"></i></div>
                            <div>
                                <div class="fw-bold">{{ $booking->sales->name ?? '-' }}</div>
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

                        @php
                            $documentTypes = [
                                'ktp',
                                'kk',
                                'npwp',
                                'slip_gaji',
                                'rekening_koran',
                                'surat_nikah',
                                'sku',
                                'ktp_pasangan',
                            ];
                            $documents = $booking->kprApplication->documents ?? [];
                            $completeCount = collect($documentTypes)
                                ->filter(fn($type) => collect($documents)->firstWhere('type', $type))
                                ->count();
                            $missingCount = 8 - $completeCount;
                        @endphp

                        @if ($missingCount > 0)
                            <div class="transaksi-inline-alert warning">
                                <i class="mdi mdi-alert-circle-outline"></i>
                                <div>Masih ada <strong>{{ $missingCount }} dokumen</strong> yang perlu dilengkapi sebelum
                                    proses verifikasi final.</div>
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
                                            $doc = collect($documents)->firstWhere('type', $type);
                                            $fileUrl = $doc ? asset('uploads/' . $doc->path) : null;
                                            $docLabel = strtoupper(str_replace('_', ' ', $type));
                                        @endphp
                                        <tr>
                                            <td>
                                                <div class="transaksi-doc-name">
                                                    <div class="transaksi-doc-icon"><i
                                                            class="mdi mdi-file-document-outline"></i></div>
                                                    <div>
                                                        <div>{{ $docLabel }}</div>
                                                        <small
                                                            class="transaksi-muted">{{ $doc ? 'Siap direview' : 'Perlu dilengkapi' }}</small>
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
                                                    <a href="{{ route('dokumen.preview', ['path' => urlencode($doc->path)]) }}"
                                                        target="_blank" rel="noopener noreferrer"
                                                        class="transaksi-doc-action" title="Lihat dokumen di tab baru">
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
                                        <div>Dokumen sudah lengkap. Verifikasi dapat dilanjutkan ke pengambilan keputusan.
                                        </div>
                                    </div>
                                @else
                                    <div class="transaksi-inline-alert warning mb-0">
                                        <i class="mdi mdi-file-alert-outline"></i>
                                        <div>Fokus utama saat ini adalah melengkapi {{ $missingCount }} dokumen yang belum
                                            tersedia.</div>
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
                                    <li><i class="mdi mdi-information-outline"></i><span>Pilih keputusan verifikasi untuk
                                            melihat ringkasan langkah berikutnya.</span></li>
                                </ul>
                            </div>

                            <div class="transaksi-sidebar-section">
                                <div class="transaksi-sidebar-title">Checklist Review</div>
                                <ul class="transaksi-mini-list mb-0">
                                    <li><i class="mdi mdi-check-circle-outline"></i><span>Pastikan seluruh dokumen yang
                                            tersedia sudah ditinjau.</span></li>
                                    <li><i class="mdi mdi-check-circle-outline"></i><span>Isi catatan verifikasi agar
                                            keputusan mudah dilacak tim berikutnya.</span></li>
                                    <li><i class="mdi mdi-check-circle-outline"></i><span>Unggah berita acara bila
                                            dibutuhkan untuk arsip proses.</span></li>
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
                            <div>Pilih salah satu keputusan di bawah ini. Form akan menyesuaikan secara otomatis sesuai
                                status verifikasi.</div>
                        </div>

                        <div class="transaksi-inline-alert danger transaksi-error-box" id="decisionErrorBox">
                            <i class="mdi mdi-alert-circle-outline"></i>
                            <div>Silakan pilih keputusan verifikasi terlebih dahulu sebelum submit.</div>
                        </div>

                        <form action="{{ route('kpr.verifikasi.store', $booking->id) }}" method="POST"
                            enctype="multipart/form-data" id="formVerifikasiKpr">
                            @csrf
                            <input type="hidden" name="status" id="statusVerifikasiInput" value="">

                            <div class="row g-3 mb-3">
                                <div class="col-12 col-md-6">
                                    <div class="transaksi-decision-card approve">
                                        <input type="radio" name="decision_choice" id="decisionApprove"
                                            value="survey">
                                        <label for="decisionApprove" class="transaksi-decision-label">
                                            <div class="transaksi-decision-icon"><i class="mdi mdi-check-bold"></i></div>
                                            <div class="transaksi-decision-content">
                                                <div class="transaksi-decision-title">Setujui Verifikasi</div>
                                                <p class="transaksi-decision-desc mb-0">Dokumen dan data dinilai memadai
                                                    untuk lanjut ke tahap survey.</p>
                                            </div>
                                            <div class="transaksi-decision-check"><i class="mdi mdi-check-circle"></i>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="transaksi-decision-card reject">
                                        <input type="radio" name="decision_choice" id="decisionReject"
                                            value="rejected">
                                        <label for="decisionReject" class="transaksi-decision-label">
                                            <div class="transaksi-decision-icon"><i class="mdi mdi-close-thick"></i></div>
                                            <div class="transaksi-decision-content">
                                                <div class="transaksi-decision-title">Tolak Verifikasi</div>
                                                <p class="transaksi-decision-desc mb-0">Pengajuan belum dapat dilanjutkan
                                                    dan perlu tindakan lanjutan.</p>
                                            </div>
                                            <div class="transaksi-decision-check"><i class="mdi mdi-check-circle"></i>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div id="formSetuju" class="transaksi-form-shell approve">
                                <div class="transaksi-form-title approve">Form Persetujuan Verifikasi</div>
                                <div class="transaksi-inline-alert success">
                                    <i class="mdi mdi-check-circle-outline"></i>
                                    <div><strong>Verifikasi disetujui.</strong> Pengajuan akan diarahkan ke tahap
                                        <strong>Survey</strong>.
                                    </div>
                                </div>
                                <div class="transaksi-form-group">
                                    <label class="transaksi-form-label" for="catatan_setuju">Catatan Verifikasi</label>
                                    <textarea id="catatan_setuju" class="transaksi-form-control" name="catatan_setuju" rows="4"
                                        placeholder="Contoh: Semua dokumen lengkap, valid, dan layak dilanjutkan ke tahap survey."></textarea>
                                </div>
                                <div class="transaksi-form-group mb-0">
                                    <label class="transaksi-form-label">Upload Berita Acara (Opsional)</label>
                                    <div class="transaksi-file-upload">
                                        <input type="file" name="berita_acara" accept=".jpg,.jpeg,.png,.pdf">
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
                                    <div><strong>Verifikasi ditolak.</strong> Pilih alasan dan tindakan lanjutan agar proses
                                        tetap jelas untuk customer dan internal.</div>
                                </div>
                                <div class="transaksi-form-group">
                                    <label class="transaksi-form-label" for="catatan_tolak">Catatan / Alasan</label>
                                    <textarea id="catatan_tolak" class="transaksi-form-control" name="catatan_tolak" rows="4"
                                        placeholder="Contoh: NPWP belum tersedia dan rekening koran belum sesuai periode yang diminta."></textarea>
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
                                            <input type="radio" name="tindakan" id="tindakanLengkapi"
                                                value="Lengkapi Dokumen" checked>
                                            <label class="transaksi-next-label" for="tindakanLengkapi">
                                                <div class="transaksi-next-icon"><i
                                                        class="mdi mdi-file-document-edit-outline"></i></div>
                                                <div class="transaksi-next-content">
                                                    <span class="transaksi-next-title">Lengkapi Dokumen</span>
                                                    <span class="transaksi-next-desc">Customer diminta melengkapi dokumen
                                                        yang belum tersedia atau belum valid.</span>
                                                </div>
                                                <div class="transaksi-next-check"><i class="mdi mdi-check-circle"></i>
                                                </div>
                                            </label>
                                        </div>
                                        <div class="transaksi-next-card">
                                            <input type="radio" name="tindakan" id="tindakanUlang"
                                                value="Ajukan ke Bank Lain">
                                            <label class="transaksi-next-label" for="tindakanUlang">
                                                <div class="transaksi-next-icon"><i class="mdi mdi-bank-transfer-out"></i>
                                                </div>
                                                <div class="transaksi-next-content">
                                                    <span class="transaksi-next-title">Ajukan ke Bank Lain</span>
                                                    <span class="transaksi-next-desc">Pengajuan diulang ke bank lain dengan
                                                        penyesuaian kelengkapan bila diperlukan.</span>
                                                </div>
                                                <div class="transaksi-next-check"><i class="mdi mdi-check-circle"></i>
                                                </div>
                                            </label>
                                        </div>
                                        <div class="transaksi-next-card">
                                            <input type="radio" name="tindakan" id="tindakanCash"
                                                value="Pindah ke Cash">
                                            <label class="transaksi-next-label" for="tindakanCash">
                                                <div class="transaksi-next-icon"><i class="mdi mdi-cash-multiple"></i>
                                                </div>
                                                <div class="transaksi-next-content">
                                                    <span class="transaksi-next-title">Pindah ke Cash</span>
                                                    <span class="transaksi-next-desc">Customer melanjutkan pembelian dengan
                                                        metode pembayaran tunai.</span>
                                                </div>
                                                <div class="transaksi-next-check"><i class="mdi mdi-check-circle"></i>
                                                </div>
                                            </label>
                                        </div>
                                        <div class="transaksi-next-card">
                                            <input type="radio" name="tindakan" id="tindakanBatal"
                                                value="Batalkan Transaksi">
                                            <label class="transaksi-next-label" for="tindakanBatal">
                                                <div class="transaksi-next-icon"><i class="mdi mdi-cancel"></i></div>
                                                <div class="transaksi-next-content">
                                                    <span class="transaksi-next-title">Batalkan Transaksi</span>
                                                    <span class="transaksi-next-desc">Customer membatalkan transaksi
                                                        pembelian dan proses diarahkan ke refund.</span>
                                                </div>
                                                <div class="transaksi-next-check"><i class="mdi mdi-check-circle"></i>
                                                </div>
                                            </label>
                                        </div>
                                        <div class="transaksi-next-card">
                                            <input type="radio" name="tindakan" id="tindakanBanding"
                                                value="Banding Ulang">
                                            <label class="transaksi-next-label" for="tindakanBanding">
                                                <div class="transaksi-next-icon"><i class="mdi mdi-scale-balance"></i>
                                                </div>
                                                <div class="transaksi-next-content">
                                                    <span class="transaksi-next-title">Banding Ulang</span>
                                                    <span class="transaksi-next-desc">Ajukan banding atau review ulang ke
                                                        bank yang sama dengan catatan tambahan.</span>
                                                </div>
                                                <div class="transaksi-next-check"><i class="mdi mdi-check-circle"></i>
                                                </div>
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
                                    <li><i class="mdi mdi-arrow-right-circle-outline"></i><span>Gunakan jika dokumen utama
                                            lengkap dan tidak ada temuan material.</span></li>
                                    <li><i class="mdi mdi-arrow-right-circle-outline"></i><span>Tambahkan catatan singkat
                                            agar tim survey memahami konteks review.</span></li>
                                </ul>
                            </div>
                            <div class="transaksi-sidebar-section">
                                <div class="transaksi-sidebar-title">Saat Ditolak</div>
                                <ul class="transaksi-mini-list mb-0">
                                    <li><i class="mdi mdi-arrow-right-circle-outline"></i><span>Jelaskan alasan penolakan
                                            secara spesifik dan dapat ditindaklanjuti.</span></li>
                                    <li><i class="mdi mdi-arrow-right-circle-outline"></i><span>Pilih tindakan lanjutan
                                            yang paling relevan agar proses berikutnya tidak ambigu.</span></li>
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
                        <a href="#" id="btnDownloadDoc" class="btn btn-sm btn-outline-secondary" download
                            title="Download">
                            <i class="mdi mdi-download"></i>
                        </a>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                </div>

                <div class="modal-body p-0" style="background:#f0f0f0; min-height:70vh; position:relative;">
                    {{-- Loading --}}
                    <div id="previewLoading" class="d-flex flex-column align-items-center justify-content-center gap-3"
                        style="height:70vh;">
                        <div class="spinner-border text-primary" style="width:2.5rem;height:2.5rem;"></div>
                        <span class="text-muted small">Memuat dokumen...</span>
                    </div>

                    {{-- Error --}}
                    <div id="previewError"
                        class="d-none flex-column align-items-center justify-content-center gap-3 text-center p-4"
                        style="height:70vh;">
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
        $(document).ready(function() {

            /* =====================================================
               VERIFIKASI FORM LOGIC
               ===================================================== */
            const $decisionApprove = $('#decisionApprove');
            const $decisionReject = $('#decisionReject');
            const $statusInput = $('#statusVerifikasiInput');
            const $formSetuju = $('#formSetuju');
            const $formTolak = $('#formTolak');
            const $decisionErrorBox = $('#decisionErrorBox');
            const $decisionStateText = $('#decisionStateText');
            const $decisionSummaryList = $('#decisionSummaryList');
            const $decisionSummary = $('#decisionSummary');

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

            $decisionApprove.on('change', function() {
                if ($(this).is(':checked')) switchDecision('survey');
            });

            $decisionReject.on('change', function() {
                if ($(this).is(':checked')) switchDecision('rejected');
            });

            $(document).on('change', 'input[name="tindakan"]', function() {
                if ($decisionReject.is(':checked')) renderSummary('rejected');
            });

            $(document).on('change', 'input[type="file"]', function(e) {
                const file = e.target.files[0];
                const $container = $(this).closest('.transaksi-file-upload');
                if (file) {
                    const sizeInMB = (file.size / (1024 * 1024)).toFixed(2);
                    $container.find('.transaksi-file-info span').text(file.name);
                    $container.find('.transaksi-file-info small').text(sizeInMB + ' MB');
                }
            });

            $('#formVerifikasiKpr').on('submit', function(e) {
                if (!$statusInput.val()) {
                    e.preventDefault();
                    $decisionErrorBox.stop(true, true).slideDown(160);
                    $('html, body').animate({
                        scrollTop: $decisionErrorBox.offset().top - 120
                    }, 300);
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
        const PDF_EXTS = ['pdf'];
        let activeBlobUrl = null;

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
            $iframe.off('load').on('load', function() {
                $('#previewLoading').addClass('d-none').css('display', 'none');
                $iframe.removeClass('d-none');
            });
            $iframe.attr('src', activeBlobUrl);
        }

        function previewImage(blob) {
            activeBlobUrl = URL.createObjectURL(blob);
            const $img = $('#imgPreview');
            $img.off('load error')
                .on('load', function() {
                    $('#previewLoading').addClass('d-none').css('display', 'none');
                    $('#divImagePreview').removeClass('d-none').css('display', 'flex');
                    $('#previewFooterInfo').text($img[0].naturalWidth + ' × ' + $img[0].naturalHeight + ' px');
                })
                .on('error', function() {
                    showError($('#btnDownloadDoc').attr('href'));
                });
            $img.attr('src', activeBlobUrl);
        }

        $(document).on('click', '.btn-preview-doc', function() {
            const url = $(this).data('url');
            const ext = $(this).data('ext').toLowerCase();
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
                .then(function(res) {
                    if (!res.ok) throw new Error('Fetch failed: ' + res.status);
                    return res.blob();
                })
                .then(function(blob) {
                    if (PDF_EXTS.includes(ext)) {
                        // Paksa MIME type PDF supaya browser render, bukan download
                        const pdfBlob = new Blob([blob], {
                            type: 'application/pdf'
                        });
                        previewPdf(pdfBlob);
                    } else if (IMAGE_EXTS.includes(ext)) {
                        previewImage(blob);
                    } else {
                        showError(url);
                    }
                })
                .catch(function() {
                    showError(url);
                });
        });

        // Bersihkan blob URL saat modal ditutup
        document.getElementById('modalPreviewDokumen').addEventListener('hidden.bs.modal', function() {
            resetPreviewState();
        });
    </script>
@endpush
