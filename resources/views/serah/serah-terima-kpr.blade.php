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
    border-radius: 6px !important;
    border: 1px solid #e2e8f0 !important;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04) !important;
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
    width: 48px;
    height: 48px;
    border-radius: 6px;
    background: #9a55ff;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: none;
    flex-shrink: 0;
}

.customer-avatar i {
    font-size: 2rem;
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
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    padding: 0.65rem 1rem;
    border-radius: 6px;
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
    background: #10b981 !important;
    color: #fff !important;
    padding: 0.35rem 0.65rem;
    font-size: 0.75rem;
    border-radius: 6px;
    font-weight: 700;
}

.badge-gradient-primary {
    background: #9a55ff !important;
    color: #fff !important;
    padding: 0.35rem 0.65rem;
    font-size: 0.75rem;
    border-radius: 6px;
    font-weight: 700;
}

.badge-gradient-secondary {
    background: #64748b !important;
    color: #fff !important;
    padding: 0.35rem 0.65rem;
    font-size: 0.75rem;
    border-radius: 6px;
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
    font-weight: 700 !important;
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

.transaksi-step.active:not(.completed) .transaksi-step-icon {
    background: #e2e8f0 !important;
    border: 2.5px solid #f59e0b !important;
    box-shadow: 0 0 0 2px rgba(245, 158, 11, 0.2) !important;
    color: #d97706 !important;
    position: relative;
}

.transaksi-step.active:not(.completed) .transaksi-step-icon::before {
    content: '';
    position: absolute;
    top: -6px;
    left: -6px;
    right: -6px;
    bottom: -6px;
    border-radius: 50%;
    border: 2px dashed #f59e0b;
    animation: stepSpinnerRotate 4s linear infinite;
    pointer-events: none;
}

@keyframes stepSpinnerRotate {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

.transaksi-step.active:not(.completed) a.transaksi-step-icon:hover {
    box-shadow: 0 6px 16px rgba(245, 158, 11, 0.45) !important;
}

.transaksi-step.active:not(.completed) .transaksi-step-title {
    color: #b45309 !important;
}

.transaksi-step.active:not(.completed) small {
    color: #d97706 !important;
    font-weight: 700;
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

/* HANDLER GROUP */
.transaksi-handler-group {
    display: flex;
    flex-direction: column;
    gap: 0.65rem;
}

.transaksi-handler {
    display: flex;
    align-items: center;
    gap: 0.85rem;
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    padding: 0.65rem 0.85rem;
    border-radius: 6px;
}

.transaksi-handler.verifier {
    background: #f0fdf4;
    border-color: #bbf7d0;
}

.transaksi-handler-icon {
    width: 36px;
    height: 36px;
    border-radius: 6px;
    background: #6366f1;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #ffffff;
    font-size: 1.2rem;
    flex-shrink: 0;
}

.transaksi-handler.verifier .transaksi-handler-icon {
    background: #10b981;
}

.transaksi-handler-role {
    font-size: 0.72rem;
    color: #64748b;
    font-weight: 600;
    line-height: 1.2;
}

.transaksi-handler-name {
    font-size: 0.88rem;
    font-weight: 700;
    color: #1e293b;
}

/* DOCUMENT STATUS BADGES */
.badge-doc-status {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 6px 12px;
    font-size: 0.8rem;
    font-weight: 700;
    border-radius: 6px;
    white-space: nowrap;
}

.badge-doc-status.status-pending {
    background: #fffbeb;
    color: #b45309;
    border: 1px solid #fde68a;
}

.badge-doc-status.status-disetujui {
    background: #ecfdf5;
    color: #15803d;
    border: 1px solid #bbf7d0;
}

/* INLINE ALERTS */
.transaksi-inline-alert {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 0.85rem 1rem;
    border-radius: 6px;
    font-size: 0.88rem;
    margin-bottom: 1.25rem;
}

.transaksi-inline-alert i {
    font-size: 1.25rem;
    flex-shrink: 0;
}

.transaksi-inline-alert.success {
    background: #f0fdf4;
    border: 1px solid #bbf7d0;
    color: #15803d;
}

.transaksi-inline-alert.warning {
    background: #fffbeb;
    border: 1px solid #fde68a;
    color: #b45309;
}

.transaksi-inline-alert.info {
    background: #eff6ff;
    border: 1px solid #bfdbfe;
    color: #1d4ed8;
}

.transaksi-inline-alert.danger {
    background: #fef2f2;
    border: 1px solid #fecaca;
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
    border: 1px solid #cbd5e1;
    border-radius: 6px;
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
    padding: 0.85rem 1rem;
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 6px;
    cursor: pointer;
    transition: all 0.25s ease;
    margin-bottom: 0;
    min-height: 52px;
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
    box-shadow: none;
}

.survey-checkbox-input:checked + .survey-checkbox-label .survey-check-icon {
    color: #9a55ff;
}

.doc-badge {
    background: #fef3c7;
    color: #92400e;
    border: 1px solid #fde68a;
    padding: 0.25rem 0.6rem;
    border-radius: 4px;
    font-size: 0.72rem;
    font-weight: 700;
    white-space: nowrap;
    transition: all 0.25s ease;
}

.survey-checkbox-input:checked + .survey-checkbox-label .doc-badge {
    background: #9a55ff;
    color: #ffffff;
    border-color: #9a55ff;
    box-shadow: none;
}

/* READ-ONLY KONDISI TERPENUHI: GREEN STATE (data dari RAP, tidak bisa diubah) */
.survey-checkbox-wrapper.is-terpenuhi .survey-checkbox-label {
    border-color: #86efac;
    background: #f0fdf4;
    box-shadow: none;
}

.survey-checkbox-wrapper.is-terpenuhi .survey-check-icon {
    color: #16a34a;
}

.survey-checkbox-wrapper.is-terpenuhi .doc-badge {
    background: #dcfce7;
    color: #15803d;
    border-color: #86efac;
}

/* AGREEMENT GREEN CHECKBOX (ON / OFF) */
.agreement-checkbox-label {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 0.85rem 1rem;
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 6px;
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
    border-color: #86efac;
    box-shadow: none;
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
    border-radius: 6px;
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
    border-radius: 4px;
}

.serah-btn {
    border: none;
    border-radius: 6px;
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
    background: #10b981;
    color: #fff;
    box-shadow: none;
}

.serah-btn-success:hover {
    background: #059669;
    color: #fff;
    box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
    transform: translateY(-2px);
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
/* UPLOAD BOX: same as addkavling spk-upload-box */
.serah-upload-box {
    position: relative;
    border: 2px dashed #cbd5e1;
    border-radius: 10px;
    background: #f8fafc;
    padding: 12px 16px;
    cursor: pointer;
    transition: all 0.2s ease;
    min-height: 64px;
    display: flex;
    align-items: center;
}

.serah-upload-box:hover {
    border-color: #9a55ff;
    background: #faf5ff;
}

.serah-upload-box input[type="file"] {
    position: absolute;
    top: 0; left: 0;
    width: 100%; height: 100%;
    opacity: 0;
    cursor: pointer;
    z-index: 10;
}

.serah-upload-box > div {
    pointer-events: none;
}

.serah-uploaded-box {
    background: #f0fdf4;
    border: 1.5px solid #86efac;
    border-radius: 10px;
    padding: 12px 16px;
    min-height: 64px;
    display: none;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
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
                                    <i class="mdi mdi-account text-white" style="font-size: 2rem;"></i>
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
                                        @endphp
                                        <span class="badge {{ $badgeClass }} ms-2"
                                            style="font-size: 0.8rem; padding: 0.35rem 0.65rem; border-radius: 6px;">
                                            <i class="mdi mdi-home-outline me-1"></i>
                                            {{ strtoupper($application->unit->jenis ?? '-') }}
                                        </span>
                                    </h4>
                                    <p class="customer-booking mb-0">Booking ID: {{ $application->booking->booking_code ?? '-' }}</p>
                                </div>
                            </div>

                            <div class="customer-unit-info">
                                <div class="info-item">
                                    <small>Unit</small>
                                    <span>Tipe {{ $application->unit->type ?? ($application->unit->unit_name ?? '-') }}</span>
                                </div>
                                <div class="info-item">
                                    <small>Blok/No</small>
                                    <span>{{ $application->unit->unit_code ?? '-' }}</span>
                                </div>
                                <div class="info-item">
                                    <small>Harga Unit</small>
                                    <span class="highlight">Rp
                                        {{ number_format($application->unit->price ?? 0, 0, ',', '.') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <form action="{{ route('serah-terima.store', $booking->id) }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row mt-4 g-4">
                <!-- LEFT COLUMN: FLOW & FORM -->
                <div class="col-12 col-lg-8 d-flex flex-column gap-4">
                    
                    <!-- CARD 1: TAHAPAN KPR -->
                    <div class="card">
                        <div class="card-body">
                            <div class="transaksi-section-title">
                                <i class="mdi mdi-timeline-text"></i>
                                <span>Tahapan KPR</span>
                            </div>

                            @php
                                $jenis = strtolower($application->unit->jenis ?? '');
                                $isSubsidi = $jenis === 'subsidi';
                                $totalSteps = 7;

                                $unit = $application->unit ?? null;
                                $spkDone = !empty($unit?->no_spk) || !empty($unit?->dokumen_spk) || !empty($unit?->kontraktor);
                                $status = strtolower($unit->construction_progress ?? '');
                                $devDone = $status == 'selesai';
                                $pembangunanDone = $devDone;
                                $surveyDone = !empty($application->rekomendasi) || strtolower($application->status_survey ?? '') == 'done' || ($application->booking->status_survey ?? 0) == 1;
                                $akadDone = !empty(optional($application->booking->akad)->tanggal_akad) || !empty($application->akad_at);
                                $serahTerimaDone =
                                    $application->booking->status == 'completed' &&
                                    !empty($application->booking->serah_terima_date);

                                $currentStep = $serahTerimaDone ? 7 : 6;
                                $progressWidth = intval(($currentStep / $totalSteps) * 100);
                                $stepStyle = 'style="grid-template-columns: repeat(' . $totalSteps . ', 1fr);"';
                            @endphp

                            <div class="transaksi-progress-top">
                                <span class="transaksi-muted">Progress Proses</span>
                                <span class="step-counter-purple">Tahap {{ $currentStep }} dari {{ $totalSteps }}</span>
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
                                    <small>
                                        @if($application->akad_at)
                                            {{ \Carbon\Carbon::parse($application->akad_at)->translatedFormat('j F Y') }}
                                        @elseif(optional($application->booking->akad)->tanggal_akad)
                                            {{ \Carbon\Carbon::parse($application->booking->akad->tanggal_akad)->translatedFormat('j F Y') }}
                                        @else
                                            Selesai
                                        @endif
                                    </small>
                                </div>

                                {{-- Tahap 7: Serah Terima --}}
                                <div class="transaksi-step {{ $serahTerimaDone ? 'completed' : 'active' }}">
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

                    <!-- CARD 2: FORM SERAH TERIMA UNIT -->
                    <div class="card">
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

                            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-2 mb-3">
                                <div class="transaksi-section-title mb-0">
                                    <i class="mdi mdi-checkbox-marked-circle-outline"></i>
                                    <span>Checklist Kondisi Unit</span>
                                </div>
                                <div class="d-flex align-items-center gap-2 flex-wrap">
                                    <span class="badge {{ $isAllReady ? 'bg-success-subtle text-success' : 'bg-warning-subtle text-warning' }} px-3 py-1.5 fw-bold" style="font-size: 0.8rem; border-radius: 6px; border: 1px solid {{ $isAllReady ? '#bbf7d0' : '#fef08a' }};">
                                        <i class="mdi {{ $isAllReady ? 'mdi-check-decagram' : 'mdi-alert-circle' }} me-1"></i>
                                        {{ $terpenuhi }}/{{ $totalKondisi }} Kondisi Terpenuhi
                                    </span>
                                    <a href="{{ $urlProgressRap }}" target="_blank" class="btn btn-sm text-white fw-bold px-3 py-1.5 shadow-sm d-inline-flex align-items-center justify-content-center" style="background-color: #9a55ff; border: 1px solid #9a55ff; font-size: 0.78rem; border-radius: 6px; gap: 5px;" title="Buka Progress Pembangunan RAP">
                                        <i class="mdi mdi-open-in-new" style="font-size: 0.95rem; line-height: 1;"></i>
                                        <span>Buka Progress RAP</span>
                                    </a>
                                </div>
                            </div>

                            {{-- Read-only: UI sama dengan Dokumen yang Diserahkan, tidak bisa diubah (data dari RAP) --}}
                            <div class="survey-checklist-grid" style="pointer-events: none; user-select: none;">
                                @foreach ($kondisiItems as $field => $label)
                                    @php $ok = empty($savedChecklist) ? true : !empty($savedChecklist[$field]); @endphp
                                    <div class="survey-checkbox-wrapper {{ $ok ? 'is-terpenuhi' : '' }}" style="{{ $ok ? '' : 'border-color: #fca5a5 !important; background: #fff5f5;' }}">
                                        <div class="survey-checkbox-label d-flex justify-content-between align-items-center">
                                            <div class="d-flex align-items-center gap-2">
                                                <i class="mdi {{ $ok ? 'mdi-check-circle survey-check-icon' : 'mdi-close-circle' }}" style="font-size: 1.15rem; {{ $ok ? '' : 'color: #ef4444;' }}"></i>
                                                <span class="survey-check-text">{{ $label }}</span>
                                            </div>
                                            <span class="doc-badge">{{ $ok ? 'Terpenuhi' : 'Belum' }}</span>
                                        </div>
                                    </div>
                                @endforeach
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
                                {{-- Upload 1: Foto Penyerahan Kunci --}}
                                <div class="col-12 col-md-6">
                                    <div class="serah-form-group mb-0">
                                        <label class="serah-form-label">Foto Penyerahan Kunci</label>

                                        {{-- Empty state --}}
                                        <div id="emptyBoxKunci" class="serah-upload-box" onclick="document.getElementById('fotoKunciInput').click()">
                                            <input type="file" name="foto_serah_kunci" id="fotoKunciInput" accept=".jpg,.jpeg,.png" onchange="serahFilePreview(this, 'kunci')">
                                            <div class="d-flex align-items-center gap-2 w-100">
                                                <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width:36px;height:36px;background:rgba(154,85,255,0.1);color:#9a55ff;">
                                                    <i class="mdi mdi-camera-plus" style="font-size:1.2rem;"></i>
                                                </div>
                                                <div>
                                                    <span class="fw-bold text-dark d-block" style="font-size:0.84rem;">Pilih foto penyerahan kunci</span>
                                                    <small class="text-muted" style="font-size:0.72rem;">JPG, PNG (Maks 5MB)</small>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Uploaded state --}}
                                        <div id="uploadedBoxKunci" class="serah-uploaded-box">
                                            <div class="d-flex align-items-center gap-2 overflow-hidden flex-grow-1" style="min-width:0;">
                                                <div class="d-flex align-items-center justify-content-center flex-shrink-0" style="width:38px;height:38px;border-radius:8px;background:rgba(0,201,167,0.15);color:#00c9a7;">
                                                    <i class="mdi mdi-image-check" style="font-size:1.35rem;"></i>
                                                </div>
                                                <div class="overflow-hidden" style="min-width:0;">
                                                    <span class="fw-bold text-success d-block text-truncate" id="fileNameKunci" style="font-size:0.85rem;"></span>
                                                    <small class="text-muted" id="fileSizeKunci" style="font-size:0.72rem;"></small>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center flex-shrink-0" style="gap: 8px;">
                                                <a href="#" target="_blank" id="viewLinkKunci" class="btn btn-sm text-white fw-bold px-3 py-1.5 shadow-sm d-inline-flex align-items-center justify-content-center" style="background-color: #10b981; border: none; font-size: 0.78rem; border-radius: 6px; gap: 4px;">
                                                    <i class="mdi mdi-eye" style="font-size: 0.95rem; line-height: 1;"></i>
                                                    <span>Lihat</span>
                                                </a>
                                                <button type="button" onclick="document.getElementById('fotoKunciInput').click()" class="btn btn-sm text-white fw-bold px-3 py-1.5 shadow-sm d-inline-flex align-items-center justify-content-center" style="background-color: #9a55ff; border: 1px solid #9a55ff; font-size: 0.78rem; border-radius: 6px; gap: 4px;">
                                                    <i class="mdi mdi-cloud-sync" style="font-size: 0.95rem; line-height: 1;"></i>
                                                    <span>Ganti</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Upload 2: Foto Bersama Unit --}}
                                <div class="col-12 col-md-6">
                                    <div class="serah-form-group mb-0">
                                        <label class="serah-form-label">Foto Bersama Unit</label>

                                        {{-- Empty state --}}
                                        <div id="emptyBoxUnit" class="serah-upload-box" onclick="document.getElementById('fotoUnitInput').click()">
                                            <input type="file" name="foto_unit" id="fotoUnitInput" accept=".jpg,.jpeg,.png" onchange="serahFilePreview(this, 'unit')">
                                            <div class="d-flex align-items-center gap-2 w-100">
                                                <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width:36px;height:36px;background:rgba(154,85,255,0.1);color:#9a55ff;">
                                                    <i class="mdi mdi-camera-plus" style="font-size:1.2rem;"></i>
                                                </div>
                                                <div>
                                                    <span class="fw-bold text-dark d-block" style="font-size:0.84rem;">Pilih foto bersama unit</span>
                                                    <small class="text-muted" style="font-size:0.72rem;">JPG, PNG (Maks 5MB)</small>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Uploaded state --}}
                                        <div id="uploadedBoxUnit" class="serah-uploaded-box">
                                            <div class="d-flex align-items-center gap-2 overflow-hidden flex-grow-1" style="min-width:0;">
                                                <div class="d-flex align-items-center justify-content-center flex-shrink-0" style="width:38px;height:38px;border-radius:8px;background:rgba(0,201,167,0.15);color:#00c9a7;">
                                                    <i class="mdi mdi-image-check" style="font-size:1.35rem;"></i>
                                                </div>
                                                <div class="overflow-hidden" style="min-width:0;">
                                                    <span class="fw-bold text-success d-block text-truncate" id="fileNameUnit" style="font-size:0.85rem;"></span>
                                                    <small class="text-muted" id="fileSizeUnit" style="font-size:0.72rem;"></small>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center flex-shrink-0" style="gap: 8px;">
                                                <a href="#" target="_blank" id="viewLinkUnit" class="btn btn-sm text-white fw-bold px-3 py-1.5 shadow-sm d-inline-flex align-items-center justify-content-center" style="background-color: #10b981; border: none; font-size: 0.78rem; border-radius: 6px; gap: 4px;">
                                                    <i class="mdi mdi-eye" style="font-size: 0.95rem; line-height: 1;"></i>
                                                    <span>Lihat</span>
                                                </a>
                                                <button type="button" onclick="document.getElementById('fotoUnitInput').click()" class="btn btn-sm text-white fw-bold px-3 py-1.5 shadow-sm d-inline-flex align-items-center justify-content-center" style="background-color: #9a55ff; border: 1px solid #9a55ff; font-size: 0.78rem; border-radius: 6px; gap: 4px;">
                                                    <i class="mdi mdi-cloud-sync" style="font-size: 0.95rem; line-height: 1;"></i>
                                                    <span>Ganti</span>
                                                </button>
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

                <!-- RIGHT COLUMN: SIDEBAR DETAILS & SUBMISSION -->
                <div class="col-12 col-lg-4 d-flex flex-column gap-4">
                    
                    <!-- SIDEBAR CARD 1: DETAIL KPR -->
                    <div class="card">
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
                                    <span>Harga Unit</span>
                                    <span>Rp {{ number_format($application->harga_unit ?? ($application->unit->price ?? 0), 0, ',', '.') }}</span>
                                </div>
                                @if(($application->promo_value ?? 0) > 0 || !empty($application->promo_name))
                                <div class="transaksi-detail-item">
                                    <span>Promo</span>
                                    <span class="text-primary fw-bold">{{ $application->promo_name ?? 'Promo Spesial' }}</span>
                                </div>
                                <div class="transaksi-detail-item">
                                    <span>Diskon Promo</span>
                                    <span class="text-danger fw-bold">- Rp {{ number_format($application->promo_value ?? 0, 0, ',', '.') }}</span>
                                </div>
                                @endif

                                <div class="transaksi-detail-item">
                                    <span>Total DP yang Dibayar</span>
                                    <span style="color: #2563eb; font-weight: 700;">
                                        Rp {{ number_format($application->dp ?? ($application->booking->booking_fee ?? 0), 0, ',', '.') }}
                                    </span>
                                </div>

                                <div class="transaksi-detail-item">
                                    <span>Jumlah Pinjaman (Plafond)</span>
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
                            </div>

                            <hr class="my-3">

                            <small class="transaksi-muted d-block mb-2 fw-semibold">Pihak yang Menangani</small>
                            <div class="transaksi-handler-group">
                                <!-- MARKETING (PENGAJU) -->
                                <div class="transaksi-handler">
                                    <div class="transaksi-handler-icon">
                                        <i class="mdi mdi-account-tie"></i>
                                    </div>
                                    <div>
                                        <div class="transaksi-handler-role">Marketing / Sales (Pengaju)</div>
                                        <div class="transaksi-handler-name">{{ $application->booking->sales->name ?? ($booking->sales->name ?? ($application->unit->activeBooking->sales->name ?? 'Staff Marketing')) }}</div>
                                    </div>
                                </div>

                                <!-- VERIFIKATOR -->
                                <div class="transaksi-handler verifier">
                                    <div class="transaksi-handler-icon">
                                        <i class="mdi mdi-shield-check"></i>
                                    </div>
                                    <div>
                                        <div class="transaksi-handler-role">Petugas Verifikasi</div>
                                        <div class="transaksi-handler-name">{{ $application->verifier->name ?? 'Admin Verifikator' }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- SIDEBAR CARD 2: INFORMASI & PERSETUJUAN SERAH TERIMA -->
                    <div class="card sticky-top" style="top: 20px; z-index: 5;">
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
            // Foto upload preview — dual state (persis addkavling)
            window.serahFilePreview = function(input, key) {
                const file = input.files[0];
                const capKey      = key.charAt(0).toUpperCase() + key.slice(1);
                const emptyBox    = document.getElementById('emptyBox'    + capKey);
                const uploadedBox = document.getElementById('uploadedBox' + capKey);
                const fileName    = document.getElementById('fileName'    + capKey);
                const fileSize    = document.getElementById('fileSize'    + capKey);
                const viewLink    = document.getElementById('viewLink'    + capKey);

                if (file) {
                    fileName.textContent = file.name;
                    fileSize.textContent = (file.size / (1024 * 1024)).toFixed(2) + ' MB';
                    if (viewLink) {
                        viewLink.href = URL.createObjectURL(file);
                    }
                    emptyBox.style.display    = 'none';
                    uploadedBox.style.display = 'flex';
                } else {
                    if (viewLink) {
                        viewLink.href = '#';
                    }
                    emptyBox.style.display    = 'flex';
                    uploadedBox.style.display = 'none';
                }
            };


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
