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

.transaksi-step.completed .transaksi-step-icon {
    background: #28c76f !important;
    border: 3px solid #ffffff !important;
    box-shadow: 0 0 0 1px #28c76f;
    color: #ffffff !important;
}

.transaksi-step.active .transaksi-step-icon {
    background: linear-gradient(135deg, #da8cff, #9a55ff) !important;
    border: 3px solid #ffffff !important;
    box-shadow: 0 0 0 2px #9a55ff;
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

.btn-cetak-ba-action {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    background: linear-gradient(135deg, #da8cff 0%, #9a55ff 100%);
    color: #ffffff !important;
    padding: 6px 14px;
    border-radius: 8px;
    font-size: 0.83rem;
    font-weight: 700;
    text-decoration: none !important;
    box-shadow: 0 4px 12px rgba(154, 85, 255, 0.28);
    border: none;
    transition: all 0.25s ease;
    cursor: pointer;
}

.btn-cetak-ba-action:hover {
    background: linear-gradient(135deg, #c96eff 0%, #8b3ffc 100%);
    color: #ffffff !important;
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(154, 85, 255, 0.42);
}

.btn-cetak-ba-action i {
    font-size: 1.1rem;
    line-height: 1;
}
</style>
    @php
        $currentUser = auth()->user();
        $posName = strtolower($currentUser->position->name ?? '');
        $isKepalaMarketing = $isKepalaMarketing ?? (str_contains($posName, 'kepala') || ($currentUser->position_id ?? null) == 1 || str_contains($posName, 'admin') || str_contains($posName, 'direktur'));
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
                                    <p class="customer-booking mb-0">
                                        Booking ID: {{ $booking->booking_code ?? '-' }} 
                                        &bull; <span class="badge {{ $isKepalaMarketing ? 'bg-primary' : 'bg-info' }} text-white" style="font-size: 0.72rem;">{{ $isKepalaMarketing ? 'Verifikator: Kepala Marketing' : 'Staff Marketing' }}</span>
                                    </p>
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

                            $unit = $booking->unit ?? (optional($booking->kprApplication)->unit ?? null);
                            $spkDone = !empty($unit?->no_spk) || !empty($unit?->dokumen_spk) || !empty($unit?->kontraktor);

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
                            $standardTypes = [
                                'ktp'            => 'KTP Pemohon',
                                'kk'             => 'Kartu Keluarga (KK)',
                                'npwp'           => 'NPWP Pemohon',
                                'slip_gaji'      => 'Slip Gaji 3 Bulan',
                                'rekening_koran' => 'Rekening Koran',
                                'sku'            => 'SKU / Surat Keterangan Kerja',
                                'surat_nikah'    => 'Buku / Surat Nikah',
                                'ktp_pasangan'   => 'KTP Pasangan',
                            ];

                            $uploadedDocs = $booking->kprApplication->documents ?? collect();

                            // Buat daftar gabungan (dokumen standar + dokumen dinamis tambahan)
                            $allDocRows = [];
                            foreach ($standardTypes as $typeKey => $typeLabel) {
                                $foundDoc = $uploadedDocs->firstWhere('type', $typeKey);
                                $allDocRows[] = [
                                    'type'          => $typeKey,
                                    'label'         => $typeLabel,
                                    'is_custom'     => false,
                                    'doc'           => $foundDoc,
                                ];
                            }

                            // Tambahkan dokumen dinamis tambahan (yang type-nya bukan standard atau custom_*)
                            foreach ($uploadedDocs as $uDoc) {
                                if (!array_key_exists($uDoc->type, $standardTypes)) {
                                    $allDocRows[] = [
                                        'type'          => $uDoc->type,
                                        'label'         => $uDoc->document_name ?? ucwords(str_replace('_', ' ', $uDoc->type)),
                                        'is_custom'     => true,
                                        'doc'           => $uDoc,
                                    ];
                                }
                            }

                            $totalUploaded = $uploadedDocs->count();
                            $uploadedStandardCount = $uploadedDocs->whereIn('type', array_keys($standardTypes))->count();
                            $completeCount = $uploadedStandardCount;
                            $missingCount  = max(0, count($standardTypes) - $uploadedStandardCount);
                            $approvedCount = $uploadedDocs->where('status', 'disetujui')->count();
                            $revisiCount   = $uploadedDocs->where('status', 'revisi')->count();
                            $rejectedCount = $uploadedDocs->where('status', 'ditolak')->count();
                            $pendingCount  = $uploadedDocs->where('status', 'pending')->count();

                            $completenessPercent = min(100, round(($uploadedStandardCount / 8) * 100));
                            $validationPercent = $totalUploaded > 0 ? round(($approvedCount / $totalUploaded) * 100) : 0;
                        @endphp

                        <!-- PROGRESS BAR KELENGKAPAN & VALIDASI DOKUMEN -->
                        <div class="card p-3 mb-3 border-0" style="background: linear-gradient(135deg, #fbf9ff, #f3e8ff); border-radius: 12px; border: 1px solid #ede4ff !important;">
                            <div class="row g-3 align-items-center">
                                <div class="col-12 col-md-6">
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <span class="small fw-bold text-dark d-flex align-items-center">
                                            <i class="mdi mdi-file-check-outline text-primary me-1" style="font-size:1.1rem;"></i>
                                            Kelengkapan Dokumen Pokok:
                                        </span>
                                        <span class="fw-bold {{ $completenessPercent === 100 ? 'text-success' : 'text-primary' }}" style="font-size:0.85rem;">
                                            {{ $uploadedStandardCount }}/8 ({{ $completenessPercent }}%)
                                        </span>
                                    </div>
                                    <div class="progress" style="height: 7px; border-radius: 10px; background: #e9d5ff; overflow: hidden;">
                                        <div class="progress-bar {{ $completenessPercent === 100 ? 'bg-success' : 'bg-primary' }}" role="progressbar" style="width: {{ $completenessPercent }}%; transition: width 0.4s ease;"></div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <span class="small fw-bold text-dark d-flex align-items-center">
                                            <i class="mdi mdi-shield-check-outline text-success me-1" style="font-size:1.1rem;"></i>
                                            Validasi Kepala Marketing:
                                        </span>
                                        <span class="fw-bold {{ $validationPercent === 100 ? 'text-success' : 'text-primary' }}" style="font-size:0.85rem;">
                                            {{ $approvedCount }}/{{ $totalUploaded }} ({{ $validationPercent }}%)
                                        </span>
                                    </div>
                                    <div class="progress" style="height: 7px; border-radius: 10px; background: #e9d5ff; overflow: hidden;">
                                        <div class="progress-bar {{ $validationPercent === 100 ? 'bg-success' : ($validationPercent >= 50 ? 'bg-primary' : 'bg-warning') }}" role="progressbar" style="width: {{ $validationPercent }}%; transition: width 0.4s ease;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if ($revisiCount > 0 || $rejectedCount > 0)
                            <div class="transaksi-inline-alert warning mb-3">
                                <i class="mdi mdi-alert-circle-outline"></i>
                                @if ($isKepalaMarketing)
                                    <div>Terdapat <strong>{{ $revisiCount }} dokumen perlu revisi</strong> dan <strong>{{ $rejectedCount }} dokumen ditolak</strong>. Hubungi pemohon/sales untuk perbaikan.</div>
                                @else
                                    <div>Terdapat <strong>{{ $revisiCount }} dokumen perlu revisi</strong> dan <strong>{{ $rejectedCount }} dokumen ditolak</strong>. Silakan periksa catatan alasan penolakan/revisi pada tabel di bawah, lalu klik tombol <strong>"Perbaiki Dokumen"</strong> atau <strong>"Upload Revisi"</strong> untuk mengunggah berkas baru.</div>
                                @endif
                            </div>
                        @elseif ($approvedCount > 0 && $approvedCount === $totalUploaded)
                            <div class="transaksi-inline-alert success mb-3">
                                <i class="mdi mdi-check-circle-outline"></i>
                                <div>Semua dokumen telah <strong>Disetujui</strong> oleh Kepala Marketing dan siap untuk keputusan verifikasi.</div>
                            </div>
                        @endif

                        <div class="table-responsive">
                            <table class="table transaksi-doc-table align-middle mb-0">
                                <thead>
                                    <tr>
                                        <th style="width: 32%;">Nama Dokumen</th>
                                        <th style="width: 20%;">Status Dokumen</th>
                                        <th style="width: 18%;">Tgl Upload</th>
                                        <th style="width: 30%;" class="text-end">{{ $isKepalaMarketing ? 'Aksi Validasi' : 'Aksi Dokumen' }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($allDocRows as $row)
                                        @php
                                            $doc = $row['doc'];
                                            $docLabel = $row['label'];
                                            $rawPath = $doc ? ($doc->path ?? '') : '';
                                            $cleanPath = ltrim(str_replace('\\', '/', $rawPath), '/');

                                            if (empty($cleanPath)) {
                                                $fileUrl = '';
                                                $fileExt = '';
                                            } elseif (str_starts_with($cleanPath, 'http://') || str_starts_with($cleanPath, 'https://')) {
                                                $fileUrl = $cleanPath;
                                                $fileExt = strtolower(pathinfo(parse_url($cleanPath, PHP_URL_PATH), PATHINFO_EXTENSION));
                                            } elseif (file_exists(public_path('uploads/' . $cleanPath))) {
                                                $fileUrl = asset('uploads/' . $cleanPath);
                                                $fileExt = strtolower(pathinfo($cleanPath, PATHINFO_EXTENSION));
                                            } elseif (file_exists(public_path($cleanPath))) {
                                                $fileUrl = asset($cleanPath);
                                                $fileExt = strtolower(pathinfo($cleanPath, PATHINFO_EXTENSION));
                                            } elseif (file_exists(public_path('uploads/customer_documents/' . basename($cleanPath)))) {
                                                $fileUrl = asset('uploads/customer_documents/' . basename($cleanPath));
                                                $fileExt = strtolower(pathinfo($cleanPath, PATHINFO_EXTENSION));
                                            } elseif (file_exists(public_path('uploads/kpr/' . basename($cleanPath)))) {
                                                $fileUrl = asset('uploads/kpr/' . basename($cleanPath));
                                                $fileExt = strtolower(pathinfo($cleanPath, PATHINFO_EXTENSION));
                                            } else {
                                                $fileUrl = asset(str_starts_with($cleanPath, 'uploads/') ? $cleanPath : 'uploads/' . $cleanPath);
                                                $fileExt = strtolower(pathinfo($cleanPath, PATHINFO_EXTENSION));
                                            }

                                            $docStatus = $doc ? ($doc->status ?? 'pending') : 'missing';
                                        @endphp
                                        <tr id="docRow_{{ $doc->id ?? 'empty_' . $row['type'] }}">
                                            <td>
                                                <div class="transaksi-doc-name">
                                                    <div class="transaksi-doc-icon">
                                                        @if($fileExt === 'pdf')
                                                            <i class="mdi mdi-file-pdf-box text-danger"></i>
                                                        @else
                                                            <i class="mdi mdi-file-document-outline text-primary"></i>
                                                        @endif
                                                    </div>
                                                    <div>
                                                        <div class="d-flex align-items-center gap-1">
                                                            <strong class="text-dark">{{ $docLabel }}</strong>
                                                            @if($row['is_custom'])
                                                                <span class="badge bg-light text-primary border" style="font-size: 0.68rem; padding: 2px 6px;">Dinamis</span>
                                                            @endif
                                                        </div>
                                                        <small class="transaksi-muted">
                                                            @if ($doc)
                                                                {{ $doc->validator ? 'Divalidasi oleh: ' . $doc->validator->name : ($doc->status === 'disetujui' ? 'Sudah disetujui' : ($isKepalaMarketing ? 'Siap divalidasi' : 'Telah diunggah')) }}
                                                            @else
                                                                <span class="text-danger">Belum diunggah pemohon</span>
                                                            @endif
                                                        </small>
                                                    </div>
                                                </div>

                                                {{-- Tampilkan Catatan Alasan jika ada Revisi atau Ditolak --}}
                                                @if ($doc && in_array($doc->status, ['revisi', 'ditolak']) && !empty($doc->catatan))
                                                    <div class="mt-2 p-2 rounded {{ $doc->status === 'revisi' ? 'bg-warning-subtle text-dark border border-warning' : 'bg-danger-subtle text-danger border border-danger' }}" style="font-size: 0.78rem;">
                                                        <strong><i class="mdi {{ $doc->status === 'revisi' ? 'mdi-alert-outline' : 'mdi-close-octagon-outline' }} me-1"></i>{{ $doc->status === 'revisi' ? 'Catatan Revisi:' : 'Alasan Penolakan:' }}</strong>
                                                        <div class="mt-1">{{ $doc->catatan }}</div>
                                                    </div>
                                                @endif
                                            </td>
                                            <td>
                                                @if (!$doc)
                                                    <span class="badge bg-secondary opacity-75">
                                                        <i class="mdi mdi-minus-circle-outline me-1"></i>Belum Ada
                                                    </span>
                                                @elseif ($doc->status === 'disetujui')
                                                    <span class="badge bg-success text-white">
                                                        <i class="mdi mdi-check-circle me-1"></i>Disetujui
                                                    </span>
                                                @elseif ($doc->status === 'revisi')
                                                    <span class="badge bg-warning text-dark">
                                                        <i class="mdi mdi-alert-circle me-1"></i>Perlu Revisi
                                                    </span>
                                                @elseif ($doc->status === 'ditolak')
                                                    <span class="badge bg-danger text-white">
                                                        <i class="mdi mdi-close-circle me-1"></i>Ditolak
                                                    </span>
                                                @else
                                                    <span class="badge bg-info text-white">
                                                        <i class="mdi mdi-clock-outline me-1"></i>Menunggu
                                                    </span>
                                                @endif
                                            </td>
                                            <td>
                                                <span class="transaksi-muted small">
                                                    {{ $doc ? \Carbon\Carbon::parse($doc->created_at)->translatedFormat('d M Y') : '-' }}
                                                </span>
                                            </td>
                                            <td class="text-end">
                                                @if ($doc)
                                                    <div class="d-inline-flex align-items-center gap-1">
                                                        {{-- Button Preview --}}
                                                        <button type="button" class="btn btn-sm btn-outline-primary btn-preview-doc"
                                                            data-url="{{ $fileUrl }}"
                                                            data-ext="{{ $fileExt }}"
                                                            data-label="{{ $docLabel }}"
                                                            title="Preview Dokumen"
                                                            style="border-radius: 6px; padding: 4px 8px;">
                                                            <i class="mdi mdi-eye-outline"></i>
                                                        </button>

                                                        @if ($isKepalaMarketing)
                                                            {{-- Button Setujui (Disetujui) --}}
                                                            <button type="button" class="btn btn-sm {{ $doc->status === 'disetujui' ? 'btn-success' : 'btn-outline-success' }} btn-action-approve"
                                                                data-doc-id="{{ $doc->id }}"
                                                                data-doc-name="{{ $docLabel }}"
                                                                title="Setujui Dokumen"
                                                                style="border-radius: 6px; padding: 4px 8px;">
                                                                <i class="mdi mdi-check-bold"></i>
                                                            </button>

                                                            {{-- Button Minta Revisi --}}
                                                            <button type="button" class="btn btn-sm {{ $doc->status === 'revisi' ? 'btn-warning text-dark' : 'btn-outline-warning' }} btn-action-revisi"
                                                                data-doc-id="{{ $doc->id }}"
                                                                data-doc-name="{{ $docLabel }}"
                                                                data-catatan="{{ $doc->catatan ?? '' }}"
                                                                title="Minta Revisi (dengan alasan)"
                                                                style="border-radius: 6px; padding: 4px 8px;">
                                                                <i class="mdi mdi-pencil-outline"></i>
                                                            </button>

                                                            {{-- Button Tolak (Ditolak) --}}
                                                            <button type="button" class="btn btn-sm {{ $doc->status === 'ditolak' ? 'btn-danger' : 'btn-outline-danger' }} btn-action-reject"
                                                                data-doc-id="{{ $doc->id }}"
                                                                data-doc-name="{{ $docLabel }}"
                                                                data-catatan="{{ $doc->catatan ?? '' }}"
                                                                title="Tolak Dokumen (dengan alasan)"
                                                                style="border-radius: 6px; padding: 4px 8px;">
                                                                <i class="mdi mdi-close"></i>
                                                            </button>
                                                        @else
                                                            {{-- Staff Marketing Role --}}
                                                            @if ($doc->status === 'revisi')
                                                                <button type="button" class="btn btn-sm btn-warning text-dark btn-open-upload-revisi d-inline-flex align-items-center gap-1 font-weight-bold"
                                                                    data-doc-id="{{ $doc->id }}"
                                                                    data-doc-name="{{ $docLabel }}"
                                                                    data-catatan="{{ $doc->catatan ?? '' }}"
                                                                    data-mode="revisi"
                                                                    title="Upload Dokumen Revisi"
                                                                    style="border-radius: 6px; padding: 4px 10px; font-weight: 700; font-size: 0.8rem; box-shadow: 0 2px 6px rgba(255, 193, 7, 0.3);">
                                                                    <i class="mdi mdi-cloud-upload-outline"></i>
                                                                    <span>Upload Revisi</span>
                                                                </button>
                                                            @elseif ($doc->status === 'ditolak')
                                                                <button type="button" class="btn btn-sm btn-danger text-white btn-open-upload-revisi d-inline-flex align-items-center gap-1 font-weight-bold"
                                                                    data-doc-id="{{ $doc->id }}"
                                                                    data-doc-name="{{ $docLabel }}"
                                                                    data-catatan="{{ $doc->catatan ?? '' }}"
                                                                    data-mode="ditolak"
                                                                    title="Perbaiki / Upload Ulang Dokumen yang Ditolak"
                                                                    style="border-radius: 6px; padding: 4px 10px; font-weight: 700; font-size: 0.8rem; box-shadow: 0 2px 6px rgba(220, 53, 69, 0.3);">
                                                                    <i class="mdi mdi-cloud-upload-outline"></i>
                                                                    <span>Perbaiki Dokumen</span>
                                                                </button>
                                                            @elseif ($doc->status === 'pending')
                                                                <button type="button" class="btn btn-sm btn-outline-secondary btn-open-upload-revisi d-inline-flex align-items-center gap-1"
                                                                    data-doc-id="{{ $doc->id }}"
                                                                    data-doc-name="{{ $docLabel }}"
                                                                    data-catatan=""
                                                                    data-mode="pending"
                                                                    title="Ganti / Perbarui Berkas"
                                                                    style="border-radius: 6px; padding: 4px 8px; font-size: 0.78rem;">
                                                                    <i class="mdi mdi-file-replace-outline"></i>
                                                                    <span>Ganti File</span>
                                                                </button>
                                                            @endif
                                                        @endif
                                                    </div>
                                                @else
                                                    @if (!$isKepalaMarketing && $booking->kprApplication)
                                                        <button type="button" class="btn btn-sm btn-outline-primary btn-open-upload-revisi d-inline-flex align-items-center gap-1"
                                                            data-kpr-id="{{ $booking->kprApplication->id }}"
                                                            data-doc-type="{{ $row['type'] }}"
                                                            data-doc-name="{{ $docLabel }}"
                                                            data-mode="new"
                                                            title="Upload Dokumen Baru"
                                                            style="border-radius: 6px; padding: 4px 10px; font-size: 0.8rem; font-weight: 600;">
                                                            <i class="mdi mdi-cloud-upload"></i>
                                                            <span>Upload Dokumen</span>
                                                        </button>
                                                    @else
                                                        <span class="text-muted small italic">Tidak ada aksi</span>
                                                    @endif
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
                                @if ($approvedCount > 0 && $approvedCount === $totalUploaded)
                                    <div class="transaksi-status-banner success">
                                        <i class="mdi mdi-check-circle-outline"></i>
                                        Semua Dokumen Disetujui
                                    </div>
                                @elseif ($revisiCount > 0 || $rejectedCount > 0)
                                    <div class="transaksi-status-banner warning">
                                        <i class="mdi mdi-alert-circle-outline"></i>
                                        Ada Dokumen Revisi / Ditolak
                                    </div>
                                @else
                                    <div class="transaksi-status-banner info">
                                        <i class="mdi mdi-progress-clock"></i>
                                        Menunggu Validasi Dokumen
                                    </div>
                                @endif
                            </div>

                            <div class="transaksi-summary-grid">
                                <div class="transaksi-summary-box success">
                                    <div class="label">Disetujui</div>
                                    <div class="value" id="summaryApprovedCount">{{ $approvedCount }}</div>
                                </div>
                                <div class="transaksi-summary-box warning">
                                    <div class="label">Perlu Revisi</div>
                                    <div class="value" id="summaryRevisiCount">{{ $revisiCount }}</div>
                                </div>
                                <div class="transaksi-summary-box danger">
                                    <div class="label">Ditolak</div>
                                    <div class="value" id="summaryRejectedCount">{{ $rejectedCount }}</div>
                                </div>
                                <div class="transaksi-summary-box info">
                                    <div class="label">Menunggu</div>
                                    <div class="value" id="summaryPendingCount">{{ $pendingCount }}</div>
                                </div>
                            </div>

                            <div class="transaksi-sidebar-section">
                                <div class="transaksi-sidebar-title">Rekomendasi Sistem</div>
                                @if ($revisiCount > 0 || $rejectedCount > 0)
                                    <div class="transaksi-inline-alert warning mb-0">
                                        <i class="mdi mdi-file-alert-outline"></i>
                                        <div>Fokus utama saat ini adalah memperbaiki <strong>{{ $revisiCount + $rejectedCount }} berkas</strong> yang ditolak / perlu revisi.</div>
                                    </div>
                                @elseif ($completeCount === 8)
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
                                    <li><i class="mdi mdi-check-circle-outline"></i><span>Unggah Berita Acara persetujuan
                                            verifikasi.</span></li>
                                </ul>
                            </div>

                            <div class="mt-3 pt-2 border-top">
                                <a href="{{ route('kpr.verifikasi.cetak-ba', $booking->id) }}" target="_blank" class="btn btn-outline-primary w-100 d-inline-flex align-items-center justify-content-center gap-2 py-2 font-weight-bold" style="border-radius: 10px; text-decoration: none;">
                                    <i class="mdi mdi-printer" style="font-size: 1.15rem;"></i>
                                    <span>Cetak Berita Acara (BA)</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-12 col-lg-8 mb-4 mb-lg-0">
                @if ($isKepalaMarketing)
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
                                        <div class="d-flex justify-content-between align-items-center mb-2 flex-wrap gap-2">
                                            <label class="transaksi-form-label mb-0">Upload Berita Acara <span class="text-danger">*</span></label>
                                            <a href="{{ route('kpr.verifikasi.cetak-ba', $booking->id) }}" target="_blank" class="btn-cetak-ba-action" title="Cetak atau Unduh Dokumen Berita Acara Resmi">
                                                <i class="mdi mdi-printer"></i>
                                                <span>Cetak / Unduh Format BA</span>
                                            </a>
                                        </div>
                                        <div class="transaksi-file-upload">
                                            <input type="file" name="berita_acara" id="inputBeritaAcara" accept=".jpg,.jpeg,.png,.pdf" required>
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
                                        <label class="transaksi-form-label">Upload Berita Acara</label>
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
                                    <a href="{{ route('customer.kpr') }}" class="transaksi-btn transaksi-btn-secondary">
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
                @else
                    {{-- STAFF MARKETING VIEW --}}
                    <div class="card">
                        <div class="card-body">
                            <div class="transaksi-section-title">
                                <i class="mdi mdi-information-outline"></i>
                                <span>Status & Petunjuk Tindak Lanjut Staff Marketing</span>
                            </div>

                            @if ($revisiCount > 0)
                                <div class="transaksi-inline-alert warning mb-3">
                                    <i class="mdi mdi-alert-circle-outline"></i>
                                    <div>
                                        <strong>Perhatian:</strong> Terdapat <strong>{{ $revisiCount }} dokumen</strong> yang diminta revisi oleh Kepala Marketing.
                                        Silakan klik tombol <strong>"Upload Revisi"</strong> pada tabel dokumen di atas untuk mengunggah berkas yang telah diperbaiki.
                                    </div>
                                </div>
                            @elseif ($rejectedCount > 0)
                                <div class="transaksi-inline-alert danger mb-3">
                                    <i class="mdi mdi-close-circle-outline"></i>
                                    <div>
                                        <strong>Dokumen Ditolak:</strong> Terdapat <strong>{{ $rejectedCount }} dokumen</strong> yang ditolak oleh Kepala Marketing. Silakan cek alasan penolakan dan hubungi pemohon.
                                    </div>
                                </div>
                            @elseif ($approvedCount > 0 && $approvedCount === $totalUploaded)
                                <div class="transaksi-inline-alert success mb-3">
                                    <i class="mdi mdi-check-circle-outline"></i>
                                    <div>
                                        <strong>Dokumen Lengkap & Terverifikasi:</strong> Seluruh dokumen telah disetujui oleh Kepala Marketing. Pengajuan saat ini menunggu proses verifikasi KPR tahap berikutnya.
                                    </div>
                                </div>
                            @else
                                <div class="transaksi-inline-alert info mb-3">
                                    <i class="mdi mdi-clock-outline"></i>
                                    <div>
                                        <strong>Menunggu Validasi:</strong> Dokumen pengajuan KPR sedang ditinjau dan divalidasi oleh Kepala Marketing.
                                    </div>
                                </div>
                            @endif

                            <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mt-4 pt-3 border-top">
                                <a href="{{ route('customer.kpr') }}" class="btn btn-secondary px-4 py-2 d-inline-flex align-items-center gap-2" style="border-radius: 8px;">
                                    <i class="mdi mdi-arrow-left"></i>
                                    <span>Kembali ke Daftar KPR</span>
                                </a>
                                <span class="badge bg-light text-secondary border px-3 py-2" style="font-size: 0.8rem;">
                                    <i class="mdi mdi-account-tie me-1"></i>Peran: Staff Marketing (Monitoring & Revisi)
                                </span>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <div class="col-12 col-lg-4">
                <div class="transaksi-sticky">
                    <div class="card">
                        <div class="card-body">
                            <div class="transaksi-section-title">
                                <i class="mdi mdi-lightbulb-on-outline"></i>
                                <span>{{ $isKepalaMarketing ? 'Panduan Keputusan' : 'Informasi Alur' }}</span>
                            </div>
                            @if ($isKepalaMarketing)
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
                            @else
                                <div class="transaksi-sidebar-section">
                                    <div class="transaksi-sidebar-title">Tugas Staff Marketing</div>
                                    <ul class="transaksi-mini-list mb-0">
                                        <li><i class="mdi mdi-check-circle-outline text-success"></i><span>Memantau kelengkapan dan persentase verifikasi berkas KPR.</span></li>
                                        <li><i class="mdi mdi-pencil-circle-outline text-warning"></i><span>Mengunggah dokumen pengganti jika ada permintaan revisi dari Kepala Marketing.</span></li>
                                        <li><i class="mdi mdi-clock-outline text-primary"></i><span>Setelah revisi diunggah, berkas otomatis siap divalidasi ulang oleh Kepala Marketing.</span></li>
                                    </ul>
                                </div>
                            @endif
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
            </div>
        </div>
    </div>

    {{-- MODAL MINTA REVISI DOKUMEN (KEPALA MARKETING) --}}
    <div class="modal fade" id="modalDocRevisi" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius:14px; overflow:hidden;">
                <div class="modal-header bg-warning bg-opacity-10 py-3">
                    <div class="d-flex align-items-center gap-2">
                        <i class="mdi mdi-pencil-box-multiple text-warning" style="font-size:1.4rem;"></i>
                        <h5 class="modal-title fw-bold text-dark mb-0">Minta Revisi Dokumen</h5>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="formDocRevisi">
                    @csrf
                    <input type="hidden" id="revisiDocId" name="doc_id">
                    <input type="hidden" name="status" value="revisi">
                    <div class="modal-body p-4">
                        <div class="mb-3">
                            <label class="form-label fw-bold text-dark">Nama Dokumen</label>
                            <input type="text" id="revisiDocName" class="form-control" readonly style="background:#f8fafc; font-weight:600;">
                        </div>
                        <div class="mb-2">
                            <label class="form-label fw-bold text-dark">Catatan / Instruksi Revisi <span class="text-danger">*</span></label>
                            <textarea id="revisiCatatan" name="catatan" class="form-control" rows="4" placeholder="Contoh: Foto dokumen buram dan terpotong di bagian sudut kanan, mohon scan ulang dengan jelas." required></textarea>
                            <small class="text-muted"><i class="mdi mdi-information-outline me-1"></i>Catatan ini akan menjadi acuan bagi sales/pemohon untuk mengunggah revisi berkas.</small>
                        </div>
                    </div>
                    <div class="modal-footer bg-light py-2 px-3">
                        <button type="button" class="btn btn-secondary px-3" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-warning px-4 fw-bold text-dark">
                            <i class="mdi mdi-send-check me-1"></i> Simpan Permintaan Revisi
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- MODAL TOLAK DOKUMEN (KEPALA MARKETING) --}}
    <div class="modal fade" id="modalDocReject" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius:14px; overflow:hidden;">
                <div class="modal-header bg-danger bg-opacity-10 py-3">
                    <div class="d-flex align-items-center gap-2">
                        <i class="mdi mdi-close-octagon text-danger" style="font-size:1.4rem;"></i>
                        <h5 class="modal-title fw-bold text-dark mb-0">Tolak Dokumen</h5>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="formDocReject">
                    @csrf
                    <input type="hidden" id="rejectDocId" name="doc_id">
                    <input type="hidden" name="status" value="ditolak">
                    <div class="modal-body p-4">
                        <div class="mb-3">
                            <label class="form-label fw-bold text-dark">Nama Dokumen</label>
                            <input type="text" id="rejectDocName" class="form-control" readonly style="background:#f8fafc; font-weight:600;">
                        </div>
                        <div class="mb-2">
                            <label class="form-label fw-bold text-dark">Alasan Penolakan <span class="text-danger">*</span></label>
                            <textarea id="rejectCatatan" name="catatan" class="form-control" rows="4" placeholder="Contoh: Dokumen tidak valid atau tidak sesuai dengan identitas pemohon yang terdaftar." required></textarea>
                            <small class="text-muted"><i class="mdi mdi-alert-outline me-1"></i>Alasan penolakan wajib dicantumkan secara jelas.</small>
                        </div>
                    </div>
                    <div class="modal-footer bg-light py-2 px-3">
                        <button type="button" class="btn btn-secondary px-3" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger px-4 fw-bold text-white">
                            <i class="mdi mdi-close-thick me-1"></i> Tolak Dokumen
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- MODAL UPLOAD REVISI / PERBAIKAN DOKUMEN (STAFF MARKETING) --}}
    <div class="modal fade" id="modalUploadRevisi" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius:14px; overflow:hidden;">
                <div class="modal-header py-3" id="modalUploadRevisiHeader" style="background:#fef3c7;">
                    <div class="d-flex align-items-center gap-2">
                        <i class="mdi mdi-cloud-upload text-warning" id="modalUploadRevisiIcon" style="font-size:1.4rem;"></i>
                        <h5 class="modal-title fw-bold text-dark mb-0" id="modalUploadRevisiTitle">Upload Dokumen Revisi</h5>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="formUploadRevisi" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="uploadRevisiDocId" name="doc_id">
                    <input type="hidden" id="uploadNewKprId" name="kpr_id">
                    <input type="hidden" id="uploadNewDocType" name="type">
                    <input type="hidden" id="uploadNewDocNameHidden" name="document_name">
                    <div class="modal-body p-4">
                        <div class="mb-3">
                            <label class="form-label fw-bold text-dark">Nama Dokumen</label>
                            <input type="text" id="uploadRevisiDocName" class="form-control" readonly style="background:#f8fafc; font-weight:600;">
                        </div>

                        <div class="mb-3 p-3 rounded" id="boxUploadRevisiCatatan" style="background:#fef3c7; border:1px solid #fde68a;">
                            <strong class="d-block mb-1 text-dark" id="uploadRevisiCatatanTitle">
                                <i class="mdi mdi-alert-outline me-1"></i>Catatan Kepala Marketing:
                            </strong>
                            <span id="uploadRevisiCatatanText" class="small text-dark">-</span>
                        </div>

                        <div class="mb-2">
                            <label class="form-label fw-bold text-dark">Pilih File Berkas <span class="text-danger">*</span></label>
                            <input type="file" id="uploadRevisiFile" name="file" class="form-control" accept=".jpg,.jpeg,.png,.pdf" required>
                            <small class="text-muted"><i class="mdi mdi-information-outline me-1"></i>Format yang didukung: PDF, JPG, JPEG, PNG (Maksimal 5MB).</small>
                        </div>
                    </div>
                    <div class="modal-footer bg-light py-2 px-3">
                        <button type="button" class="btn btn-secondary px-3" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-warning px-4 fw-bold text-dark" id="btnSubmitUploadRevisi">
                            <i class="mdi mdi-cloud-upload me-1"></i> Simpan & Unggah Berkas
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: "{{ session('success') }}",
                timer: 2000,
                showConfirmButton: false
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "{{ session('error') }}",
                timer: 2000,
                showConfirmButton: false
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
                        <li><i class="mdi mdi-paperclip"></i><span>Unggah dokumen <strong>Berita Acara Verifikasi</strong>.</span></li>
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
                    $('input[name="berita_acara"]').prop('required', true);
                    $('input[name="berita_acara_tolak"]').prop('required', false);
                    renderSummary('survey');
                } else if (type === 'rejected') {
                    $statusInput.val('rejected');
                    $formTolak.stop(true, true).slideDown(180);
                    $formSetuju.stop(true, true).slideUp(180);
                    $('input[name="berita_acara"]').prop('required', false);
                    $('input[name="berita_acara_tolak"]').prop('required', false);
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

            /* =====================================================
               3-WAY DOKUMEN VALIDATION LOGIC (KEPALA MARKETING)
               ===================================================== */
            const validateUrlTemplate = "{{ route('kpr.document.validate', ':id') }}";

            function postDocValidation(docId, status, catatan) {
                const url = validateUrlTemplate.replace(':id', docId);

                Swal.fire({
                    title: 'Memproses...',
                    text: 'Menyimpan status validasi dokumen',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        status: status,
                        catatan: catatan
                    },
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: response.message || 'Status validasi dokumen berhasil diperbarui.',
                            timer: 1500,
                            showConfirmButton: false
                        }).then(() => {
                            location.reload();
                        });
                    },
                    error: function(xhr) {
                        const msg = xhr.responseJSON?.message || 'Terjadi kesalahan saat memvalidasi dokumen.';
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal Validasi',
                            text: msg
                        });
                    }
                });
            }

            // 1. Aksi Setujui (Disetujui)
            $(document).on('click', '.btn-action-approve', function() {
                const docId = $(this).data('doc-id');
                const docName = $(this).data('doc-name');

                Swal.fire({
                    title: 'Setujui Dokumen?',
                    text: `Apakah Anda yakin ingin menyetujui dokumen "${docName}"?`,
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#28a745',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: '<i class="mdi mdi-check me-1"></i> Ya, Setujui',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        postDocValidation(docId, 'disetujui', null);
                    }
                });
            });

            // 2. Aksi Minta Revisi (Modal)
            $(document).on('click', '.btn-action-revisi', function() {
                const docId = $(this).data('doc-id');
                const docName = $(this).data('doc-name');
                const catatan = $(this).data('catatan') || '';

                $('#revisiDocId').val(docId);
                $('#revisiDocName').val(docName);
                $('#revisiCatatan').val(catatan);

                const modal = new bootstrap.Modal(document.getElementById('modalDocRevisi'));
                modal.show();
            });

            $('#formDocRevisi').on('submit', function(e) {
                e.preventDefault();
                const docId = $('#revisiDocId').val();
                const catatan = $('#revisiCatatan').val();

                if (!catatan.trim()) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Catatan Wajib Diisi',
                        text: 'Silakan isi catatan/alasan apa yang perlu direvisi oleh pemohon.'
                    });
                    return;
                }

                bootstrap.Modal.getInstance(document.getElementById('modalDocRevisi')).hide();
                postDocValidation(docId, 'revisi', catatan);
            });

            // 3. Aksi Tolak Dokumen (Modal)
            $(document).on('click', '.btn-action-reject', function() {
                const docId = $(this).data('doc-id');
                const docName = $(this).data('doc-name');
                const catatan = $(this).data('catatan') || '';

                $('#rejectDocId').val(docId);
                $('#rejectDocName').val(docName);
                $('#rejectCatatan').val(catatan);

                const modal = new bootstrap.Modal(document.getElementById('modalDocReject'));
                modal.show();
            });

            $('#formDocReject').on('submit', function(e) {
                e.preventDefault();
                const docId = $('#rejectDocId').val();
                const catatan = $('#rejectCatatan').val();

                if (!catatan.trim()) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Alasan Wajib Diisi',
                        text: 'Silakan isi alasan penolakan dokumen.'
                    });
                    return;
                }

                bootstrap.Modal.getInstance(document.getElementById('modalDocReject')).hide();
                postDocValidation(docId, 'ditolak', catatan);
            });

            /* =====================================================
               UPLOAD REVISI / PERBAIKAN DOKUMEN (STAFF MARKETING)
               ===================================================== */
            const reuploadUrlTemplate = "{{ route('kpr.document.reupload', ':id') }}";
            const uploadNewUrlTemplate = "{{ route('kpr.document.upload-new', ':kprId') }}";

            $(document).on('click', '.btn-open-upload-revisi', function() {
                const docId = $(this).data('doc-id');
                const docName = $(this).data('doc-name');
                const catatan = $(this).data('catatan') || '';
                const mode = $(this).data('mode') || 'revisi';
                const kprId = $(this).data('kpr-id');
                const docType = $(this).data('doc-type');

                $('#uploadRevisiDocId').val(docId || '');
                $('#uploadNewKprId').val(kprId || '');
                $('#uploadNewDocType').val(docType || '');
                $('#uploadNewDocNameHidden').val(docName || '');
                $('#uploadRevisiDocName').val(docName);
                $('#uploadRevisiFile').val('');

                const $header = $('#modalUploadRevisiHeader');
                const $icon = $('#modalUploadRevisiIcon');
                const $title = $('#modalUploadRevisiTitle');
                const $catatanBox = $('#boxUploadRevisiCatatan');
                const $catatanTitle = $('#uploadRevisiCatatanTitle');
                const $catatanText = $('#uploadRevisiCatatanText');
                const $btnSubmit = $('#btnSubmitUploadRevisi');

                if (mode === 'ditolak') {
                    $header.css('background', '#fee2e2');
                    $icon.attr('class', 'mdi mdi-alert-circle text-danger');
                    $title.text('Perbaiki Dokumen Ditolak');
                    $catatanBox.css({'background': '#fee2e2', 'border-color': '#fca5a5'}).show();
                    $catatanTitle.html('<i class="mdi mdi-close-octagon me-1 text-danger"></i>Alasan Penolakan Kepala Marketing:');
                    $catatanText.text(catatan || 'Dokumen ditolak. Mohon perbaiki dan unggah ulang berkas yang valid.');
                    $btnSubmit.attr('class', 'btn btn-danger px-4 fw-bold text-white').html('<i class="mdi mdi-cloud-upload me-1"></i> Unggah Dokumen Perbaikan');
                } else if (mode === 'revisi') {
                    $header.css('background', '#fef3c7');
                    $icon.attr('class', 'mdi mdi-pencil-box-multiple text-warning');
                    $title.text('Upload Dokumen Revisi');
                    $catatanBox.css({'background': '#fef3c7', 'border-color': '#fde68a'}).show();
                    $catatanTitle.html('<i class="mdi mdi-alert-outline me-1 text-warning"></i>Instruksi Revisi Kepala Marketing:');
                    $catatanText.text(catatan || 'Mohon perbaiki dokumen sesuai catatan Kepala Marketing.');
                    $btnSubmit.attr('class', 'btn btn-warning px-4 fw-bold text-dark').html('<i class="mdi mdi-cloud-upload me-1"></i> Unggah File Revisi');
                } else if (mode === 'pending') {
                    $header.css('background', '#f1f5f9');
                    $icon.attr('class', 'mdi mdi-file-replace-outline text-primary');
                    $title.text('Ganti / Perbarui Berkas Dokumen');
                    $catatanBox.hide();
                    $btnSubmit.attr('class', 'btn btn-primary px-4 fw-bold text-white').html('<i class="mdi mdi-cloud-upload me-1"></i> Ganti Berkas');
                } else {
                    $header.css('background', '#eff6ff');
                    $icon.attr('class', 'mdi mdi-cloud-upload text-primary');
                    $title.text('Upload Dokumen Pokok');
                    $catatanBox.hide();
                    $btnSubmit.attr('class', 'btn btn-primary px-4 fw-bold text-white').html('<i class="mdi mdi-cloud-upload me-1"></i> Unggah Dokumen');
                }

                const modal = new bootstrap.Modal(document.getElementById('modalUploadRevisi'));
                modal.show();
            });

            $('#formUploadRevisi').on('submit', function(e) {
                e.preventDefault();
                const docId = $('#uploadRevisiDocId').val();
                const kprId = $('#uploadNewKprId').val();
                const fileInput = document.getElementById('uploadRevisiFile');

                if (!fileInput.files || fileInput.files.length === 0) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'File Belum Dipilih',
                        text: 'Silakan pilih file berkas terlebih dahulu.'
                    });
                    return;
                }

                const formData = new FormData(this);
                let url = '';

                if (docId) {
                    url = reuploadUrlTemplate.replace(':id', docId);
                } else if (kprId) {
                    url = uploadNewUrlTemplate.replace(':kprId', kprId);
                } else {
                    Swal.fire({ icon: 'error', title: 'Target Dokumen Tidak Ditemukan' });
                    return;
                }

                Swal.fire({
                    title: 'Mengunggah...',
                    text: 'Sedang mengunggah berkas dokumen',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: response.message || 'Dokumen berhasil diunggah.',
                            timer: 1800,
                            showConfirmButton: false
                        }).then(() => {
                            location.reload();
                        });
                    },
                    error: function(xhr) {
                        const msg = xhr.responseJSON?.message || 'Terjadi kesalahan saat mengunggah dokumen.';
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal Upload',
                            text: msg
                        });
                    }
                });
            });

        }); // end document.ready
    </script>

    <script>
        /* =====================================================
           MODAL PREVIEW DOKUMEN — Direct Load & Fallback
           ===================================================== */
        const IMAGE_EXTS = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'bmp', 'svg'];
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
            $('#divImagePreview').addClass('d-none').css('display', 'none');
            $('#iframePreview').addClass('d-none').css('display', 'none');
            $('#previewError').removeClass('d-none').css('display', 'flex');
            $('#btnErrorDownload').attr('href', url);
        }

        $(document).on('click', '.btn-preview-doc', function() {
            const url = $(this).data('url');
            const ext = ($(this).data('ext') || '').toLowerCase();
            const label = $(this).data('label');

            if (!url) {
                Swal.fire({
                    icon: 'warning',
                    title: 'File Belum Diunggah',
                    text: 'Dokumen ini belum memiliki file berkas.'
                });
                return;
            }

            // Set info modal
            $('#modalDocLabel').text(label);
            $('#modalDocExt').text((ext || 'FILE').toUpperCase());
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

            if (IMAGE_EXTS.includes(ext)) {
                const $img = $('#imgPreview');
                $img.off('load error')
                    .on('load', function() {
                        $('#previewLoading').addClass('d-none').css('display', 'none');
                        $('#previewError').addClass('d-none').css('display', 'none');
                        $('#divImagePreview').removeClass('d-none').css('display', 'flex');
                    })
                    .on('error', function() {
                        // Coba via fetch blob sebagai fallback jika direct image diblokir
                        fetch(url)
                            .then(res => {
                                if (!res.ok) throw new Error('Fetch failed');
                                return res.blob();
                            })
                            .then(blob => {
                                activeBlobUrl = URL.createObjectURL(blob);
                                $img.off('load error')
                                    .on('load', function() {
                                        $('#previewLoading').addClass('d-none').css('display', 'none');
                                        $('#previewError').addClass('d-none').css('display', 'none');
                                        $('#divImagePreview').removeClass('d-none').css('display', 'flex');
                                    })
                                    .on('error', function() {
                                        showError(url);
                                    })
                                    .attr('src', activeBlobUrl);
                            })
                            .catch(() => {
                                showError(url);
                            });
                    });
                $img.attr('src', url);
            } else if (PDF_EXTS.includes(ext)) {
                const $iframe = $('#iframePreview');
                $iframe.off('load error')
                    .on('load', function() {
                        $('#previewLoading').addClass('d-none').css('display', 'none');
                        $('#iframePreview').removeClass('d-none');
                    })
                    .on('error', function() {
                        showError(url);
                    });
                $iframe.attr('src', url);
            } else {
                showError(url);
            }
        });

        // Bersihkan blob URL saat modal ditutup
        document.getElementById('modalPreviewDokumen').addEventListener('hidden.bs.modal', function() {
            resetPreviewState();
        });
    </script>
@endpush
