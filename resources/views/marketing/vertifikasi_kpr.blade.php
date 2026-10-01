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
.transaksi-step.active,
.transaksi-step.rejected {
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

.transaksi-step.rejected .transaksi-step-icon {
    background: #ef4444 !important;
    border: 3px solid #ffffff !important;
    box-shadow: 0 0 0 2px #ef4444;
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
    border: 1px solid #edf0f5;
    padding: 0.65rem 0.85rem;
    border-radius: 10px;
}

.transaksi-handler.verifier {
    background: #f0fdf4;
    border-color: #dcfce7;
}

.transaksi-handler-icon {
    width: 38px;
    height: 38px;
    border-radius: 8px;
    background: linear-gradient(135deg, #667eea, #764ba2);
    display: flex;
    align-items: center;
    justify-content: center;
    color: #ffffff;
    font-size: 1.2rem;
    flex-shrink: 0;
}

.transaksi-handler.verifier .transaksi-handler-icon {
    background: linear-gradient(135deg, #0ba360, #3cba92);
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
    width: 34px;
    height: 34px;
    border-radius: 8px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border: 1.5px solid #9a55ff;
    color: #9a55ff;
    background: #ffffff;
    transition: all 0.2s ease;
    text-decoration: none !important;
    font-size: 1.05rem;
    padding: 0;
    cursor: pointer;
}

.transaksi-doc-action:hover {
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.12);
    transform: translateY(-1.5px);
}

.transaksi-doc-action.btn-action-preview {
    border-color: #9a55ff;
    color: #9a55ff;
    background: rgba(154, 85, 255, 0.06);
}
.transaksi-doc-action.btn-action-preview:hover {
    background: #9a55ff;
    color: #ffffff;
    box-shadow: 0 4px 10px rgba(154, 85, 255, 0.25);
}

.transaksi-doc-action.btn-action-approve {
    border-color: #10b981;
    color: #10b981;
    background: rgba(16, 185, 129, 0.06);
}
.transaksi-doc-action.btn-action-approve:hover,
.transaksi-doc-action.btn-action-approve.active {
    background: #10b981;
    color: #ffffff;
    box-shadow: 0 4px 10px rgba(16, 185, 129, 0.25);
}

.transaksi-doc-action.btn-action-revisi {
    border-color: #f59e0b;
    color: #f59e0b;
    background: rgba(245, 158, 11, 0.06);
}
.transaksi-doc-action.btn-action-revisi:hover,
.transaksi-doc-action.btn-action-revisi.active {
    background: #f59e0b;
    color: #ffffff;
    box-shadow: 0 4px 10px rgba(245, 158, 11, 0.25);
}

.transaksi-doc-action.btn-action-reject {
    border-color: #ef4444;
    color: #ef4444;
    background: rgba(239, 68, 68, 0.06);
}
.transaksi-doc-action.btn-action-reject:hover,
.transaksi-doc-action.btn-action-reject.active {
    background: #ef4444;
    color: #ffffff;
    box-shadow: 0 4px 10px rgba(239, 68, 68, 0.25);
}

.transaksi-doc-action.btn-action-reset {
    border-color: #94a3b8;
    color: #64748b;
    background: rgba(100, 116, 139, 0.06);
}
.transaksi-doc-action.btn-action-reset:hover {
    background: #64748b;
    color: #ffffff;
    box-shadow: 0 4px 10px rgba(100, 116, 139, 0.25);
}

.transaksi-doc-action.disabled {
    border-color: #e2e8f0;
    color: #cbd5e1;
    background: #f8fafc;
    cursor: not-allowed;
    transform: none !important;
    box-shadow: none !important;
}

.transaksi-doc-action.btn-action-upload {
    border-color: #0284c7;
    color: #0284c7;
    background: rgba(2, 132, 199, 0.08);
}
.transaksi-doc-action.btn-action-upload:hover {
    background: #0284c7;
    color: #ffffff;
    box-shadow: 0 4px 10px rgba(2, 132, 199, 0.25);
}

.reupload-dropzone {
    border: 2px dashed #c084fc;
    background: #faf7ff;
    border-radius: 12px;
    padding: 24px 16px;
    text-align: center;
    cursor: pointer;
    transition: all 0.2s ease;
}
.reupload-dropzone:hover,
.reupload-dropzone.dragover {
    border-color: #9a55ff;
    background: #f3e8ff;
    transform: scale(1.01);
}
.reupload-dropzone-icon {
    width: 52px;
    height: 52px;
    border-radius: 50%;
    background: #eedeff;
    color: #9a55ff;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 1.6rem;
    margin-bottom: 0.5rem;
}
.reupload-file-card {
    border: 1px solid #e9d5ff;
    background: #ffffff;
    border-radius: 10px;
    padding: 10px 14px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 10px;
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

.transaksi-decision-card.disabled {
    opacity: 0.65;
    cursor: not-allowed;
}

.transaksi-decision-card.disabled .transaksi-decision-label {
    cursor: not-allowed !important;
    background: #f8fafc !important;
    border-color: #e2e8f0 !important;
    box-shadow: none !important;
}

.transaksi-decision-card.disabled .transaksi-decision-icon {
    opacity: 0.55;
    filter: grayscale(0.5);
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

                            $kprStatus = strtolower(optional($booking->kprApplication)->status ?? 'pending');
                            $verifikasiApproved = in_array($kprStatus, ['approved', 'analisa', 'survey', 'akad', 'selesai', 'completed']);
                            $verifikasiRejected = ($kprStatus === 'rejected');
                            $verifikasiDone = $verifikasiApproved;

                            if ($verifikasiApproved) {
                                $currentStep = 3;
                                if ($spkDone) {
                                    $currentStep = 4;
                                }
                                if ($developmentDone) {
                                    $currentStep = 5;
                                }
                                if ($surveyDone) {
                                    $currentStep = 6;
                                }
                                if ($akadDone) {
                                    $currentStep = 7;
                                }
                            } else {
                                $currentStep = 2;
                            }

                            // =======================
                            // UI HELPER
                            // =======================

                            $progressWidth = intval(($currentStep / $totalSteps) * 100);

                            $stepsStyle = 'style="grid-template-columns: repeat(' . $totalSteps . ', 1fr);"';

                            $stepClass = function($index) use ($currentStep, $verifikasiApproved, $verifikasiRejected) {
                                if ($index === 1) {
                                    return 'completed';
                                }
                                if ($index === 2) {
                                    if ($verifikasiRejected) {
                                        return 'rejected';
                                    }
                                    if ($verifikasiApproved) {
                                        return 'completed';
                                    }
                                    return 'active';
                                }
                                if ($verifikasiRejected || !$verifikasiApproved) {
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
                            @php
                                $tglPengajuan = optional($booking->kprApplication)->submitted_at 
                                    ?? optional($booking->kprApplication)->created_at 
                                    ?? $booking->booking_date 
                                    ?? $booking->created_at;

                                // Navigasi URL setiap tahapan
                                // 1. Pengajuan KPR
                                $urlPengajuan = route('pengajuan.show', $booking->id);

                                // 2. Verifikasi KPR (halaman saat ini)
                                $urlVerifikasi = route('transaksi.kpr.approve', $booking->id);

                                // 3. SPK Kontraktor
                                $spkModel = null;
                                if ($unit) {
                                    $spkModel = \App\Models\Spk::where('land_bank_unit_id', $unit->id)
                                        ->orWhere(function ($q) use ($unit) {
                                            if (!empty($unit->no_spk)) {
                                                $q->where('no_spk', $unit->no_spk);
                                            } else {
                                                $q->whereRaw('0 = 1');
                                            }
                                        })->first();
                                }
                                $urlSpk = $spkModel ? route('spk.show', $spkModel->id) : route('spk.index');

                                // 4. Pembangunan Unit (RAP & Progress)
                                $landBankId = $booking->unit->land_bank_id ?? 1;
                                $urlPembangunan = route('properti.progress', [
                                    'land_bank_id' => $landBankId,
                                    'unit_id' => $booking->unit_id,
                                ]);

                                // 5. Survey Lapangan KPR
                                $kprAppId = optional($booking->kprApplication)->id ?? $booking->id;
                                $urlSurvey = route('kpr.survey', $kprAppId);

                                // 6. Akad KPR
                                $urlAkad = url('/transaksi/kpr/akad-kpr/' . $booking->id);

                                // 7. Serah Terima
                                $urlSerahTerima = $serahTerimaDone 
                                    ? route('unit.selesai', $booking->id) 
                                    : route('kpr.serahterima', $kprAppId);
                            @endphp

                            {{-- Tahap 1: Pengajuan --}}
                            <div class="transaksi-step {{ $stepClass(1) }}">
                                <a href="{{ $urlPengajuan }}" class="transaksi-step-icon" title="Buka Halaman Pengajuan KPR">
                                    <i class="mdi mdi-check"></i>
                                </a>
                                <a href="{{ $urlPengajuan }}" class="transaksi-step-title-link" title="Buka Halaman Pengajuan KPR">
                                    <span class="transaksi-step-title">Pengajuan</span>
                                </a>
                                <small>{{ $tglPengajuan ? \Carbon\Carbon::parse($tglPengajuan)->translatedFormat('d F Y') : '-' }}</small>
                            </div>

                            {{-- Tahap 2: Verifikasi --}}
                            <div class="transaksi-step {{ $stepClass(2) }}">
                                <a href="{{ $urlVerifikasi }}" class="transaksi-step-icon" title="Halaman Verifikasi KPR (Saat Ini)">
                                    @if ($verifikasiRejected)
                                        <i class="mdi mdi-close"></i>
                                    @elseif ($verifikasiApproved)
                                        <i class="mdi mdi-check"></i>
                                    @else
                                        <i class="mdi mdi-file-document-edit-outline"></i>
                                    @endif
                                </a>
                                <a href="{{ $urlVerifikasi }}" class="transaksi-step-title-link" title="Halaman Verifikasi KPR (Saat Ini)">
                                    <span class="transaksi-step-title">Verifikasi</span>
                                </a>
                                <small>
                                    @if ($verifikasiRejected)
                                        <span class="text-danger fw-bold">Ditolak</span>
                                    @elseif ($verifikasiApproved)
                                        <span class="text-success fw-bold">Selesai</span>
                                    @else
                                        Dalam Proses
                                    @endif
                                </small>
                            </div>

                            {{-- Tahap 3: SPK --}}
                            <div class="transaksi-step {{ $spkDone ? 'completed' : ($currentStep == 3 ? 'active' : '') }}">
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

                            {{-- Tahap 4: Pembangunan --}}
                            <div class="transaksi-step {{ $statusProgress == 'selesai' ? 'completed' : ($currentStep == 4 ? 'active' : '') }}">
                                <a href="{{ $urlPembangunan }}" class="transaksi-step-icon" title="Buka Monitoring Progress Pembangunan Unit">
                                    @if ($statusProgress == 'selesai')
                                        <i class="mdi mdi-check"></i>
                                    @else
                                        <i class="mdi {{ $config['icon'] }}"></i>
                                    @endif
                                </a>
                                <a href="{{ $urlPembangunan }}" class="transaksi-step-title-link" title="Buka Monitoring Progress Pembangunan Unit">
                                    <span class="transaksi-step-title">Pembangunan</span>
                                </a>
                                <small>{{ $statusText[$statusProgress] ?? ($developmentDone ? 'Pembangunan selesai' : ($currentStep == 4 ? 'Dalam Proses' : 'Menunggu')) }}</small>
                            </div>

                            {{-- Tahap 5: Survey --}}
                            <div class="transaksi-step {{ $stepClass(5) }}">
                                <a href="{{ $urlSurvey }}" class="transaksi-step-icon" title="Buka Halaman Hasil Survey Lapangan KPR">
                                    @if ($surveyDone)
                                        <i class="mdi mdi-check"></i>
                                    @else
                                        <i class="mdi mdi-home-search-outline"></i>
                                    @endif
                                </a>
                                <a href="{{ $urlSurvey }}" class="transaksi-step-title-link" title="Buka Halaman Hasil Survey Lapangan KPR">
                                    <span class="transaksi-step-title">Survey</span>
                                </a>
                                <small>{{ $surveyDone ? 'Selesai' : ($currentStep == 5 ? 'Dalam Proses' : 'Menunggu') }}</small>
                            </div>

                            {{-- Tahap 6: Akad --}}
                            <div class="transaksi-step {{ $stepClass(6) }}">
                                <a href="{{ $urlAkad }}" class="transaksi-step-icon" title="Buka Halaman Akad KPR">
                                    @if ($akadDone)
                                        <i class="mdi mdi-check"></i>
                                    @else
                                        <i class="mdi mdi-handshake-outline"></i>
                                    @endif
                                </a>
                                <a href="{{ $urlAkad }}" class="transaksi-step-title-link" title="Buka Halaman Akad KPR">
                                    <span class="transaksi-step-title">Akad</span>
                                </a>
                                <small>{{ $akadDone ? 'Selesai' : ($currentStep == 6 ? 'Dalam Proses' : 'Menunggu') }}</small>
                            </div>

                            {{-- Tahap 7: Serah Terima --}}
                            <div class="transaksi-step {{ $stepClass(7) }}">
                                <a href="{{ $urlSerahTerima }}" class="transaksi-step-icon" title="{{ $serahTerimaDone ? 'Lihat Detail Serah Terima Unit (Selesai)' : 'Buka Halaman Serah Terima Unit' }}">
                                    @if ($serahTerimaDone)
                                        <i class="mdi mdi-check"></i>
                                    @else
                                        <i class="mdi mdi-cash-fast"></i>
                                    @endif
                                </a>
                                <a href="{{ $urlSerahTerima }}" class="transaksi-step-title-link" title="{{ $serahTerimaDone ? 'Lihat Detail Serah Terima Unit (Selesai)' : 'Buka Halaman Serah Terima Unit' }}">
                                    <span class="transaksi-step-title">Serah Terima</span>
                                </a>
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
                                <span>Harga Unit</span>
                                <span>Rp {{ number_format($booking->kprApplication->harga_unit ?? ($booking->unit->price ?? 0), 0, ',', '.') }}</span>
                            </div>
                            @if(($booking->kprApplication->promo_value ?? 0) > 0 || !empty($booking->kprApplication->promo_name))
                            <div class="transaksi-detail-item">
                                <span>Promo</span>
                                <span class="text-primary fw-bold">{{ $booking->kprApplication->promo_name ?? 'Promo Spesial' }}</span>
                            </div>
                            <div class="transaksi-detail-item">
                                <span>Diskon Promo</span>
                                <span class="text-danger fw-bold">- Rp {{ number_format($booking->kprApplication->promo_value ?? 0, 0, ',', '.') }}</span>
                            </div>
                            @endif

                            <div class="transaksi-detail-item">
                                <span>Total DP yang Dibayar</span>
                                <span style="color: #2563eb; font-weight: 700;">
                                    Rp {{ number_format($booking->kprApplication->dp ?? 0, 0, ',', '.') }}
                                </span>
                            </div>

                            <div class="transaksi-detail-item">
                                <span>Jumlah Pinjaman (Plafond)</span>
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
                        <small class="transaksi-muted d-block mb-2 fw-semibold">Pihak yang Menangani</small>
                        <div class="transaksi-handler-group">
                            <!-- MARKETING (PENGAJU) -->
                            <div class="transaksi-handler">
                                <div class="transaksi-handler-icon">
                                    <i class="mdi mdi-account-tie"></i>
                                </div>
                                <div>
                                    <div class="transaksi-handler-role">Marketing / Sales (Pengaju)</div>
                                    <div class="transaksi-handler-name">{{ $booking->sales->name ?? 'Staff Marketing' }}</div>
                                </div>
                            </div>

                            @php
                                $currentUserRole = auth()->user()->position->name ?? (auth()->user()->role ?? 'Petugas');
                            @endphp
                            <!-- USER LOGIN YANG MENANGANI -->
                            <div class="transaksi-handler verifier">
                                <div class="transaksi-handler-icon">
                                    <i class="mdi mdi-shield-account-variant-outline"></i>
                                </div>
                                <div>
                                    <div class="transaksi-handler-role">{{ $currentUserRole }}</div>
                                    <div class="transaksi-handler-name">
                                        {{ auth()->user()->name ?? 'Petugas' }}
                                    </div>
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
                            <i class="mdi mdi-file-document-multiple-outline"></i>
                            <span>Kelengkapan Dokumen</span>
                        </div>

                        @php
                            $kprApp = $booking->kprApplication;
                            $documents = $kprApp->documents ?? collect();
                            $totalDocs = $documents->count();
                            $approvedDocs = $documents->where('status', 'disetujui')->count();
                            $revisionDocs = $documents->where('status', 'revisi')->count();
                            $rejectedDocs = $documents->where('status', 'ditolak')->count();
                            $pendingDocs = $documents->whereNotIn('status', ['disetujui', 'revisi', 'ditolak'])->count();
                            $completeCount = $totalDocs;
                            $docCount = $totalDocs;
                            $missingCount = 0;
                        @endphp

                        @if ($totalDocs > 0)
                            <div class="transaksi-inline-alert {{ $approvedDocs === $totalDocs ? 'success' : ($revisionDocs > 0 || $rejectedDocs > 0 ? 'warning' : 'info') }} mb-3" id="docSummaryAlert">
                                <i class="mdi {{ $approvedDocs === $totalDocs ? 'mdi-check-circle-outline' : ($revisionDocs > 0 || $rejectedDocs > 0 ? 'mdi-alert-circle-outline' : 'mdi-information-outline') }}"></i>
                                <div id="docSummaryAlertText">
                                    @if ($approvedDocs === $totalDocs)
                                        Seluruh <strong>{{ $totalDocs }} berkas dokumen</strong> telah lengkap dan disetujui.
                                    @elseif ($revisionDocs > 0 || $rejectedDocs > 0)
                                        Terdapat <strong>{{ $totalDocs }} dokumen</strong> (<strong>{{ $approvedDocs }} disetujui</strong>, <strong class="text-warning">{{ $revisionDocs }} perlu revisi</strong>, <strong class="text-danger">{{ $rejectedDocs }} ditolak</strong>).
                                    @else
                                        Terdapat <strong>{{ $totalDocs }} berkas dokumen</strong> yang telah diunggah dan siap untuk ditinjau (<strong>{{ $approvedDocs }} disetujui</strong>, <strong>{{ $pendingDocs }} menunggu verifikasi</strong>).
                                    @endif
                                </div>
                            </div>

                            <!-- TOOLBAR STATUS & BULK ACTION -->
                            <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mb-3 p-2.5 rounded-3" style="background: #f8fafc; border: 1px solid #eef2f6;">
                                <div class="d-flex flex-wrap align-items-center gap-1.5" style="font-size: 0.78rem;">
                                    <span class="badge bg-white text-dark border px-2 py-1 shadow-xs">
                                        Total: <strong id="statTotalDocs">{{ $totalDocs }}</strong>
                                    </span>
                                    <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1">
                                        <i class="mdi mdi-check-circle me-0.5"></i> Disetujui: <strong id="statApprovedDocs">{{ $approvedDocs }}</strong>
                                    </span>
                                    <span class="badge bg-warning-subtle text-warning border border-warning-subtle px-2 py-1">
                                        <i class="mdi mdi-alert-circle me-0.5"></i> Revisi: <strong id="statRevisionDocs">{{ $revisionDocs }}</strong>
                                    </span>
                                    <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-2 py-1">
                                        <i class="mdi mdi-close-circle me-0.5"></i> Ditolak: <strong id="statRejectedDocs">{{ $rejectedDocs }}</strong>
                                    </span>
                                    <span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle px-2 py-1">
                                        <i class="mdi mdi-clock-outline me-0.5"></i> Pending: <strong id="statPendingDocs">{{ $pendingDocs }}</strong>
                                    </span>
                                </div>

                                @if ($kprApp)
                                    <div id="btnApproveAllContainer" style="{{ $approvedDocs === $totalDocs ? 'display: none;' : '' }}">
                                        <button type="button" 
                                            class="btn btn-xs btn-outline-success d-inline-flex align-items-center gap-1.5 py-1 px-2.5 rounded-2 fw-semibold btn-approve-all" 
                                            data-kpr-id="{{ $kprApp->id }}"
                                            style="font-size: 0.78rem;">
                                            <i class="mdi mdi-check-all fs-6"></i> Setujui Semua Dokumen
                                        </button>
                                    </div>
                                @endif
                            </div>
                        @else
                            <div class="transaksi-inline-alert warning mb-3">
                                <i class="mdi mdi-alert-circle-outline"></i>
                                <div>Belum ada dokumen yang diunggah untuk pengajuan KPR ini.</div>
                            </div>
                        @endif

                        <div class="table-responsive">
                            <table class="table transaksi-doc-table align-middle mb-0">
                                <thead>
                                    <tr>
                                        <th style="width: 35%;">Nama Dokumen</th>
                                        <th style="width: 22%;">Status</th>
                                        <th style="width: 18%;">Tanggal Upload</th>
                                        <th style="width: 25%;">Aksi Verifikasi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($documents as $doc)
                                        @php
                                            $docLabel = $doc->document_name ?? strtoupper(str_replace('_', ' ', $doc->type));
                                            $ext = strtolower(pathinfo($doc->path, PATHINFO_EXTENSION));
                                            $status = strtolower($doc->status ?? 'pending');
                                        @endphp
                                        <tr id="doc-row-{{ $doc->id }}" class="doc-row-item">
                                            <td>
                                                <div class="transaksi-doc-name">
                                                    <div class="transaksi-doc-icon">
                                                        @if(in_array($ext, ['pdf']))
                                                            <i class="mdi mdi-file-pdf-box" style="color: #ef4444;"></i>
                                                        @elseif(in_array($ext, ['jpg', 'jpeg', 'png', 'webp']))
                                                            <i class="mdi mdi-file-image" style="color: #3b82f6;"></i>
                                                        @else
                                                            <i class="mdi mdi-file-document-outline"></i>
                                                        @endif
                                                    </div>
                                                    <div>
                                                        <div class="fw-semibold text-dark">{{ $docLabel }}</div>
                                                        <div class="transaksi-muted small d-flex align-items-center gap-1" style="font-size: 0.76rem;">
                                                            <span>{{ strtoupper(str_replace('_', ' ', $doc->type)) }}</span>
                                                            <span id="doc-validator-info-{{ $doc->id }}" class="{{ ($status !== 'pending' && $doc->validator) ? '' : 'd-none' }}">
                                                                • <span class="text-success"><i class="mdi mdi-account-check-outline"></i> {{ $doc->validator->name ?? 'Verifikator' }}</span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td id="doc-status-cell-{{ $doc->id }}">
                                                @if ($status === 'disetujui')
                                                    <span class="badge bg-success text-white px-2 py-1">
                                                        <i class="mdi mdi-check-circle me-1"></i>Disetujui
                                                    </span>
                                                @elseif ($status === 'revisi')
                                                    <span class="badge bg-warning text-dark px-2 py-1">
                                                        <i class="mdi mdi-alert-circle me-1"></i>Perlu Revisi
                                                    </span>
                                                    @if ($doc->catatan)
                                                        <div class="text-danger small mt-1 doc-catatan-text" style="font-size: 0.78rem; line-height: 1.25;">
                                                            <i class="mdi mdi-information-outline me-0.5"></i><strong>Catatan:</strong> {{ $doc->catatan }}
                                                        </div>
                                                    @endif
                                                    <div class="mt-1.5 doc-reupload-quick-btn">
                                                        <button type="button" 
                                                            class="btn btn-xs btn-outline-warning py-1 px-2.5 rounded-pill btn-reupload-doc d-inline-flex align-items-center gap-1 shadow-sm"
                                                            data-id="{{ $doc->id }}"
                                                            data-name="{{ $docLabel }}"
                                                            data-type="{{ $doc->type }}"
                                                            data-status="{{ $status }}"
                                                            data-catatan="{{ $doc->catatan ?? '' }}"
                                                            data-reupload-url="{{ route('kpr.document.reupload', $doc->id) }}"
                                                            style="font-size: 0.74rem; font-weight: 600;">
                                                            <i class="mdi mdi-cloud-upload-outline"></i> Upload Pengganti
                                                        </button>
                                                    </div>
                                                @elseif ($status === 'ditolak')
                                                    <span class="badge bg-danger text-white px-2 py-1">
                                                        <i class="mdi mdi-close-circle me-1"></i>Ditolak
                                                    </span>
                                                    @if ($doc->catatan)
                                                        <div class="text-danger small mt-1 doc-catatan-text" style="font-size: 0.78rem; line-height: 1.25;">
                                                            <i class="mdi mdi-close-circle-outline me-0.5"></i><strong>Alasan:</strong> {{ $doc->catatan }}
                                                        </div>
                                                    @endif
                                                    <div class="mt-1.5 doc-reupload-quick-btn">
                                                        <button type="button" 
                                                            class="btn btn-xs btn-outline-danger py-1 px-2.5 rounded-pill btn-reupload-doc d-inline-flex align-items-center gap-1 shadow-sm"
                                                            data-id="{{ $doc->id }}"
                                                            data-name="{{ $docLabel }}"
                                                            data-type="{{ $doc->type }}"
                                                            data-status="{{ $status }}"
                                                            data-catatan="{{ $doc->catatan ?? '' }}"
                                                            data-reupload-url="{{ route('kpr.document.reupload', $doc->id) }}"
                                                            style="font-size: 0.74rem; font-weight: 600;">
                                                            <i class="mdi mdi-cloud-upload-outline"></i> Upload Pengganti
                                                        </button>
                                                    </div>
                                                @else
                                                    <span class="badge bg-secondary text-white px-2 py-1">
                                                        <i class="mdi mdi-clock-outline me-1"></i>Pending
                                                    </span>
                                                @endif
                                            </td>
                                            <td>
                                                <span class="transaksi-muted" style="font-size: 0.83rem;">
                                                    {{ $doc->created_at ? \Carbon\Carbon::parse($doc->created_at)->translatedFormat('d M Y') : '-' }}
                                                </span>
                                            </td>
                                            <td id="doc-action-cell-{{ $doc->id }}">
                                                <div class="d-flex align-items-center gap-1.5 flex-wrap doc-action-group">
                                                    {{-- 1. Tombol Preview --}}
                                                    <button type="button" 
                                                        class="transaksi-doc-action btn-action-preview btn-preview-doc" 
                                                        data-id="{{ $doc->id }}"
                                                        data-url="{{ route('dokumen.preview', ['path' => urlencode($doc->path)]) }}"
                                                        data-ext="{{ $ext }}"
                                                        data-label="{{ $docLabel }}"
                                                        data-status="{{ $status }}"
                                                        data-catatan="{{ $doc->catatan ?? '' }}"
                                                        data-validator="{{ $doc->validator->name ?? '' }}"
                                                        title="Lihat & Verifikasi Dokumen">
                                                        <i class="mdi mdi-eye-outline"></i>
                                                    </button>

                                                    {{-- 2. Tombol Setujui --}}
                                                    <button type="button" 
                                                        class="transaksi-doc-action btn-action-approve btn-validate-doc {{ $status === 'disetujui' ? 'active' : '' }}" 
                                                        data-id="{{ $doc->id }}"
                                                        data-status="disetujui"
                                                        data-name="{{ $docLabel }}"
                                                        title="{{ $status === 'disetujui' ? 'Sudah Disetujui' : 'Setujui Dokumen Ini' }}">
                                                        <i class="mdi mdi-check"></i>
                                                    </button>

                                                    {{-- 3. Tombol Minta Revisi --}}
                                                    <button type="button" 
                                                        class="transaksi-doc-action btn-action-revisi btn-validate-doc {{ $status === 'revisi' ? 'active' : '' }}" 
                                                        data-id="{{ $doc->id }}"
                                                        data-status="revisi"
                                                        data-name="{{ $docLabel }}"
                                                        data-catatan="{{ $doc->catatan ?? '' }}"
                                                        title="Minta Revisi Dokumen">
                                                        <i class="mdi mdi-pencil-outline"></i>
                                                    </button>

                                                    {{-- 4. Tombol Tolak --}}
                                                    <button type="button" 
                                                        class="transaksi-doc-action btn-action-reject btn-validate-doc {{ $status === 'ditolak' ? 'active' : '' }}" 
                                                        data-id="{{ $doc->id }}"
                                                        data-status="ditolak"
                                                        data-name="{{ $docLabel }}"
                                                        data-catatan="{{ $doc->catatan ?? '' }}"
                                                        title="Tolak Dokumen">
                                                        <i class="mdi mdi-close"></i>
                                                    </button>

                                                    @if ($status !== 'pending')
                                                        {{-- 5. Tombol Reset ke Pending jika sudah diubah --}}
                                                        <button type="button" 
                                                            class="transaksi-doc-action btn-action-reset btn-validate-doc" 
                                                            data-id="{{ $doc->id }}"
                                                            data-status="pending"
                                                            data-name="{{ $docLabel }}"
                                                            title="Kembalikan Status ke Pending">
                                                            <i class="mdi mdi-refresh"></i>
                                                        </button>
                                                    @endif

                                                    {{-- 6. Tombol Upload Pengganti --}}
                                                    <button type="button" 
                                                        class="transaksi-doc-action btn-action-upload btn-reupload-doc" 
                                                        data-id="{{ $doc->id }}"
                                                        data-name="{{ $docLabel }}"
                                                        data-type="{{ $doc->type }}"
                                                        data-status="{{ $status }}"
                                                        data-catatan="{{ $doc->catatan ?? '' }}"
                                                        data-reupload-url="{{ route('kpr.document.reupload', $doc->id) }}"
                                                        title="Upload Berkas Pengganti">
                                                        <i class="mdi mdi-cloud-upload-outline"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center py-4 text-muted">
                                                <i class="mdi mdi-file-question-outline fs-3 d-block mb-1"></i>
                                                Belum ada dokumen yang diunggah
                                            </td>
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
                                <span>Informasi Verifikasi</span>
                            </div>

                            <div class="mb-3">
                                @if ($completeCount > 0)
                                    <div class="transaksi-status-banner success">
                                        <i class="mdi mdi-check-circle-outline"></i>
                                        Dokumen Tersedia ({{ $completeCount }})
                                    </div>
                                @else
                                    <div class="transaksi-status-banner warning">
                                        <i class="mdi mdi-progress-clock"></i>
                                        Menunggu Unggah Dokumen
                                    </div>
                                @endif
                            </div>

                            <div class="transaksi-summary-grid">
                                <div class="transaksi-summary-box success">
                                    <div class="label">Dokumen Terunggah</div>
                                    <div class="value">{{ $completeCount }}</div>
                                </div>
                                <div class="transaksi-summary-box info">
                                    <div class="label">Status Berkas</div>
                                    <div class="value" style="font-size: 0.95rem; font-weight: 700; padding-top: 4px;">{{ $completeCount > 0 ? 'Tersedia' : 'Belum Ada' }}</div>
                                </div>
                            </div>

                            <div class="transaksi-sidebar-section">
                                <div class="transaksi-sidebar-title">Rekomendasi Sistem</div>
                                @php
                                    $canApprove = ($totalDocs > 0 && $approvedDocs === $totalDocs);
                                @endphp
                                @if ($canApprove)
                                    <div class="transaksi-inline-alert success mb-0" id="sidebarRekomendasi">
                                        <i class="mdi mdi-check-decagram-outline"></i>
                                        <div id="sidebarRekomendasiText">Seluruh <strong>{{ $totalDocs }} dokumen</strong> telah disetujui. Pengajuan direkomendasikan untuk <strong>Setujui Verifikasi</strong>.</div>
                                    </div>
                                @elseif ($rejectedDocs > 0)
                                    <div class="transaksi-inline-alert danger mb-0" id="sidebarRekomendasi">
                                        <i class="mdi mdi-close-circle-outline"></i>
                                        <div id="sidebarRekomendasiText">Terdapat <strong>{{ $rejectedDocs }} berkas ditolak</strong>. Pengajuan diarahkan ke <strong>Tolak Verifikasi</strong>.</div>
                                    </div>
                                @elseif ($revisionDocs > 0)
                                    <div class="transaksi-inline-alert warning mb-0" id="sidebarRekomendasi">
                                        <i class="mdi mdi-alert-circle-outline"></i>
                                        <div id="sidebarRekomendasiText">Terdapat <strong>{{ $revisionDocs }} berkas perlu revisi</strong>. Opsi disesuaikan ke <strong>Lengkapi Dokumen</strong>.</div>
                                    </div>
                                @elseif ($pendingDocs > 0)
                                    <div class="transaksi-inline-alert info mb-0" id="sidebarRekomendasi">
                                        <i class="mdi mdi-clock-alert-outline"></i>
                                        <div id="sidebarRekomendasiText">Masih terdapat <strong>{{ $pendingDocs }} berkas pending</strong>. Harap periksa seluruh dokumen terlebih dahulu.</div>
                                    </div>
                                @else
                                    <div class="transaksi-inline-alert warning mb-0" id="sidebarRekomendasi">
                                        <i class="mdi mdi-file-alert-outline"></i>
                                        <div id="sidebarRekomendasiText">Belum ada dokumen yang diunggah untuk pengajuan KPR ini.</div>
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
                                    <li><i class="mdi mdi-check-circle-outline"></i><span>Unggah dokumen SP3K dari Bank.</span></li>
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

                        @php
                            $initialCatatanTolak = '';
                            if ($rejectedDocs > 0) {
                                $initialCatatanTolak = "Penolakan verifikasi KPR karena berkas berikut ditolak:\n";
                                foreach ($documents->where('status', 'ditolak') as $d) {
                                    $initialCatatanTolak .= "• " . ($d->document_name ?? strtoupper(str_replace('_', ' ', $d->type))) . ($d->catatan ? ": {$d->catatan}" : "") . "\n";
                                }
                            } elseif ($revisionDocs > 0) {
                                $initialCatatanTolak = "Dokumen berikut perlu perbaikan/revisi oleh nasabah:\n";
                                foreach ($documents->where('status', 'revisi') as $d) {
                                    $initialCatatanTolak .= "• " . ($d->document_name ?? strtoupper(str_replace('_', ' ', $d->type))) . ($d->catatan ? ": {$d->catatan}" : "") . "\n";
                                }
                            }
                        @endphp

                        {{-- Alert sinkronisasi keputusan dengan hasil verifikasi berkas --}}
                        <div class="transaksi-inline-alert {{ $canApprove ? 'success' : ($rejectedDocs > 0 ? 'danger' : ($revisionDocs > 0 ? 'warning' : 'info')) }} mb-4" id="decisionDocSyncAlert">
                            <i class="mdi {{ $canApprove ? 'mdi-check-decagram-outline' : ($rejectedDocs > 0 ? 'mdi-close-circle-outline' : ($revisionDocs > 0 ? 'mdi-alert-circle-outline' : 'mdi-clock-alert-outline')) }}" id="decisionDocSyncIcon"></i>
                            <div id="decisionDocSyncText">
                                @if ($canApprove)
                                    <strong>Dokumen Terverifikasi Penuh:</strong> Seluruh <strong>{{ $totalDocs }} berkas dokumen</strong> telah disetujui. Keputusan disesuaikan untuk <strong>Setujui Verifikasi</strong> ke tahap Survey.
                                @elseif ($rejectedDocs > 0)
                                    <strong>Terdapat Dokumen Ditolak:</strong> Ada <strong>{{ $rejectedDocs }} berkas</strong> yang ditolak. Opsi Setujui Verifikasi dikunci dan keputusan otomatis disesuaikan ke <strong>Tolak Verifikasi</strong>.
                                @elseif ($revisionDocs > 0)
                                    <strong>Dokumen Memerlukan Revisi:</strong> Terdapat <strong>{{ $revisionDocs }} berkas</strong> yang memerlukan perbaikan. Opsi Setujui Verifikasi dikunci. Keputusan disesuaikan ke <strong>Tolak Verifikasi (Lengkapi Dokumen)</strong>.
                                @elseif ($pendingDocs > 0)
                                    <strong>Pemeriksaan Berkas Belum Selesai:</strong> Masih terdapat <strong>{{ $pendingDocs }} dokumen</strong> berstatus pending. Harap verifikasi seluruh berkas di atas terlebih dahulu untuk membuka opsi <strong>Setujui Verifikasi</strong>.
                                @else
                                    <strong>Belum Ada Dokumen:</strong> Belum ada berkas dokumen yang diunggah. Pengajuan belum dapat disetujui.
                                @endif
                            </div>
                        </div>

                        <div class="transaksi-inline-alert danger transaksi-error-box" id="decisionErrorBox">
                            <i class="mdi mdi-alert-circle-outline"></i>
                            <div>Silakan pilih keputusan verifikasi terlebih dahulu sebelum submit.</div>
                        </div>

                        <form action="{{ route('kpr.verifikasi.store', $booking->id) }}" method="POST"
                            enctype="multipart/form-data" id="formVerifikasiKpr">
                            @csrf
                            <input type="hidden" name="status" id="statusVerifikasiInput" value="{{ $canApprove ? 'survey' : 'rejected' }}">

                            <div class="row g-3 mb-3">
                                <div class="col-12 col-md-6">
                                    <div class="transaksi-decision-card approve {{ !$canApprove ? 'disabled' : '' }}" id="cardDecisionApprove">
                                        <input type="radio" name="decision_choice" id="decisionApprove"
                                            value="survey" {{ $canApprove ? 'checked' : '' }} {{ !$canApprove ? 'disabled' : '' }}>
                                        <label for="decisionApprove" class="transaksi-decision-label">
                                            <div class="transaksi-decision-icon"><i class="mdi mdi-check-bold"></i></div>
                                            <div class="transaksi-decision-content">
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <div class="transaksi-decision-title mb-0">Setujui Verifikasi</div>
                                                    <span id="approveLockedBadge" class="badge {{ $rejectedDocs > 0 ? 'bg-danger' : ($revisionDocs > 0 ? 'bg-warning text-dark' : 'bg-secondary') }} py-1 px-1.5 align-middle" style="font-size: 0.72rem; {{ $canApprove ? 'display: none;' : '' }}">
                                                        <i class="mdi mdi-lock-outline"></i> Terkunci
                                                    </span>
                                                </div>
                                                <p class="transaksi-decision-desc mb-0 mt-1">Dokumen dan data dinilai memadai
                                                    untuk lanjut ke tahap survey.</p>
                                            </div>
                                            <div class="transaksi-decision-check"><i class="mdi mdi-check-circle"></i>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="transaksi-decision-card reject" id="cardDecisionReject">
                                        <input type="radio" name="decision_choice" id="decisionReject"
                                            value="rejected" {{ !$canApprove ? 'checked' : '' }}>
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

                            <div id="formSetuju" class="transaksi-form-shell approve" style="display: {{ $canApprove ? 'block' : 'none' }};">
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
                                        placeholder="Contoh: Semua dokumen lengkap, valid, dan layak dilanjutkan ke tahap survey.">{{ $canApprove ? "Seluruh berkas dokumen ($totalDocs dokumen) telah lengkap, valid, dan disetujui." : '' }}</textarea>
                                </div>
                                <div class="transaksi-form-group mb-0">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <label class="transaksi-form-label mb-0">Upload Dokumen SP3K dari Bank <span class="text-danger">*</span></label>
                                        @if (!empty(optional($booking->kprApplication)->berita_acara))
                                            <a href="{{ asset('uploads/' . $booking->kprApplication->berita_acara) }}" target="_blank" class="badge bg-success-subtle text-success text-decoration-none px-2 py-1" style="font-size: 0.78rem;">
                                                <i class="mdi mdi-file-check me-1"></i>SP3K Sudah Ada (Klik Lihat)
                                            </a>
                                        @endif
                                    </div>
                                    <div class="transaksi-file-upload">
                                        <input type="file" name="berita_acara" id="inputBeritaAcara" accept=".jpg,.jpeg,.png,.pdf" data-has-file="{{ !empty(optional($booking->kprApplication)->berita_acara) ? '1' : '0' }}" {{ empty(optional($booking->kprApplication)->berita_acara) ? 'required' : '' }}>
                                        <div class="transaksi-file-label">
                                            <i class="mdi mdi-cloud-upload"></i>
                                            <div class="transaksi-file-info">
                                                <span>{{ !empty(optional($booking->kprApplication)->berita_acara) ? basename($booking->kprApplication->berita_acara) : 'Upload Dokumen SP3K dari Bank' }}</span>
                                                <small>Format: JPG, PNG, PDF (Max 5MB){{ !empty(optional($booking->kprApplication)->berita_acara) ? ' — Pilih file baru jika ingin memperbarui' : '' }}</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="formTolak" class="transaksi-form-shell reject" style="display: {{ !$canApprove ? 'block' : 'none' }};">
                                <div class="transaksi-form-title reject">Form Penolakan Verifikasi</div>
                                <div class="transaksi-inline-alert danger">
                                    <i class="mdi mdi-close-circle-outline"></i>
                                    <div><strong>Verifikasi ditolak.</strong> Pilih alasan dan tindakan lanjutan agar proses
                                        tetap jelas untuk customer dan internal.</div>
                                </div>
                                <div class="transaksi-form-group">
                                    <label class="transaksi-form-label" for="catatan_tolak">Catatan / Alasan</label>
                                    <textarea id="catatan_tolak" class="transaksi-form-control" name="catatan_tolak" rows="4"
                                        placeholder="Contoh: NPWP belum tersedia dan rekening koran belum sesuai periode yang diminta.">{{ trim($initialCatatanTolak) }}</textarea>
                                </div>
                                <div class="transaksi-form-group">
                                    <label class="transaksi-form-label">Upload Dokumen Penolakan / Surat Bank (Opsional)</label>
                                    <div class="transaksi-file-upload">
                                        <input type="file" name="berita_acara_tolak" accept=".jpg,.jpeg,.png,.pdf">
                                        <div class="transaksi-file-label">
                                            <i class="mdi mdi-cloud-upload"></i>
                                            <div class="transaksi-file-info">
                                                <span>Upload Dokumen Penolakan / Surat Bank</span>
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

    {{-- MODAL PREVIEW DOKUMEN & VERIFIKASI --}}
    <div class="modal fade" id="modalPreviewDokumen" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content" style="border-radius:12px; overflow:hidden;">
                <div class="modal-header">
                    <div class="d-flex align-items-center gap-2">
                        <i class="mdi mdi-file-eye-outline" id="modalDocIcon" style="font-size:1.3rem;"></i>
                        <h5 class="modal-title mb-0" id="modalDocLabel">Preview Dokumen</h5>
                        <span class="badge bg-secondary ms-1" id="modalDocExt" style="font-size:0.7rem;"></span>
                        <span class="badge bg-secondary ms-1" id="modalDocStatusBadge" style="font-size:0.75rem;">Pending</span>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <a href="#" id="btnOpenNewTabDoc" target="_blank" rel="noopener noreferrer" class="btn btn-sm btn-outline-secondary" title="Buka Dokumen di Tab Baru">
                            <i class="mdi mdi-open-in-new"></i>
                        </a>
                        <a href="#" id="btnDownloadDoc" class="btn btn-sm btn-outline-secondary" download
                            title="Download Dokumen">
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

                <div class="modal-footer d-flex flex-wrap align-items-center justify-content-between gap-2">
                    <div class="text-start me-auto">
                        <small class="text-muted d-block" id="previewFooterInfo"></small>
                        <div id="modalDocCatatanBox" class="small text-danger d-none mt-1" style="font-size:0.8rem;">
                            <i class="mdi mdi-alert-circle-outline me-1"></i><span id="modalDocCatatanText"></span>
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-2 flex-wrap" id="modalVerifyButtons">
                        <button type="button" class="btn btn-sm btn-info text-white btn-modal-reupload" id="btnModalReupload" title="Upload Berkas Pengganti Dokumen Ini">
                            <i class="mdi mdi-cloud-upload-outline me-1"></i> Upload Pengganti
                        </button>
                        <button type="button" class="btn btn-sm btn-success text-white btn-modal-validate" data-status="disetujui" title="Setujui Dokumen Ini">
                            <i class="mdi mdi-check me-1"></i> Setujui
                        </button>
                        <button type="button" class="btn btn-sm btn-warning text-dark btn-modal-validate" data-status="revisi" title="Minta Revisi Dokumen">
                            <i class="mdi mdi-pencil-outline me-1"></i> Minta Revisi
                        </button>
                        <button type="button" class="btn btn-sm btn-danger text-white btn-modal-validate" data-status="ditolak" title="Tolak Dokumen">
                            <i class="mdi mdi-close me-1"></i> Tolak
                        </button>
                        <button type="button" class="btn btn-sm btn-outline-secondary btn-modal-validate" data-status="pending" id="btnModalResetPending" title="Reset ke Status Pending">
                            <i class="mdi mdi-refresh me-1"></i> Reset
                        </button>
                        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL UPLOAD PENGGANTI DOKUMEN --}}
    <div class="modal fade" id="modalReuploadDokumen" tabindex="-1" aria-hidden="true" style="z-index: 1065;">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius:14px; overflow:hidden; border:none; box-shadow: 0 15px 35px rgba(0,0,0,0.2);">
                <div class="modal-header py-3 px-4" style="background: linear-gradient(135deg, #f8f9fa, #f1f3f5); border-bottom: 1.5px solid #edf0f5;">
                    <div class="d-flex align-items-center gap-2">
                        <div style="width:36px; height:36px; border-radius:10px; background:rgba(154,85,255,0.12); color:#9a55ff; display:flex; align-items:center; justify-content:center; font-size:1.25rem;">
                            <i class="mdi mdi-cloud-upload-outline"></i>
                        </div>
                        <div>
                            <h5 class="modal-title fw-bold mb-0 text-dark" style="font-size: 1.05rem;">Upload Berkas Pengganti</h5>
                            <small class="text-muted" id="modalReuploadDocSubLabel">Ganti dokumen dengan berkas yang sudah diperbaiki</small>
                        </div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form id="formReuploadDokumen" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="reuploadDocId" name="document_id">
                    
                    <div class="modal-body p-4">
                        {{-- Info Dokumen Saat Ini --}}
                        <div class="p-3 mb-3" style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 10px;">
                            <div class="d-flex align-items-center justify-content-between mb-1">
                                <span class="fw-bold text-dark" id="modalReuploadDocName">-</span>
                                <span id="modalReuploadDocStatusBadge">-</span>
                            </div>
                            <div id="modalReuploadCatatanBox" class="small text-danger mt-1.5 p-2 rounded" style="background: #fef2f2; border: 1px solid #fee2e2;">
                                <i class="mdi mdi-information-outline me-1"></i><strong>Catatan:</strong> <span id="modalReuploadDocCatatan">-</span>
                            </div>
                        </div>

                        {{-- Dropzone / File Input --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold text-dark small mb-1">Pilih File Pengganti <span class="text-danger">*</span></label>
                            
                            <label for="reuploadFileInput" class="reupload-dropzone d-block w-100 mb-0" id="reuploadDropzone" style="cursor: pointer;">
                                <div id="dropzonePrompt">
                                    <div class="reupload-dropzone-icon">
                                        <i class="mdi mdi-tray-arrow-up"></i>
                                    </div>
                                    <div class="fw-semibold text-dark mb-0.5">Tarik & lepaskan file ke sini</div>
                                    <div class="text-muted small mb-2">atau <span class="text-primary fw-bold text-decoration-underline">Klik untuk Memilih File</span></div>
                                    <div class="badge bg-light text-muted border px-2 py-1" style="font-size: 0.72rem;">
                                        Format: PDF, JPG, JPEG, PNG (Maks. 5MB)
                                    </div>
                                </div>

                                <div id="dropzoneFileSelected" class="d-none">
                                    <div class="reupload-file-card" style="cursor: default;">
                                        <div class="d-flex align-items-center gap-2 overflow-hidden">
                                            <div id="selectedFileIcon" style="font-size: 1.8rem; color: #9a55ff;">
                                                <i class="mdi mdi-file-document-outline"></i>
                                            </div>
                                            <div class="text-start overflow-hidden">
                                                <div class="fw-bold text-dark text-truncate" id="selectedFileName" style="max-width: 200px; font-size: 0.85rem;">filename.pdf</div>
                                                <small class="text-muted" id="selectedFileSize">0 KB</small>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center gap-1.5">
                                            <button type="button" class="btn btn-sm btn-outline-primary px-2 py-1" id="btnChangeSelectedFile" style="font-size: 0.75rem; border-radius: 6px;">
                                                <i class="mdi mdi-file-replace-outline me-0.5"></i> Ganti
                                            </button>
                                            <button type="button" class="btn btn-sm btn-outline-danger p-1 rounded-circle" id="btnRemoveSelectedFile" title="Hapus File" style="width: 28px; height: 28px; display: inline-flex; align-items: center; justify-content: center;">
                                                <i class="mdi mdi-close" style="font-size: 0.9rem;"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <input type="file" id="reuploadFileInput" name="file" accept=".pdf,.jpg,.jpeg,.png" style="position: absolute; width: 1px; height: 1px; padding: 0; margin: -1px; overflow: hidden; clip: rect(0,0,0,0); border: 0; opacity: 0;">
                            </label>
                        </div>

                        {{-- Catatan Perbaikan (Opsional) --}}
                        <div class="mb-0">
                            <label class="form-label fw-semibold text-dark small mb-1">Keterangan Tambahan / Perbaikan <span class="text-muted font-monospace fw-normal">(Opsional)</span></label>
                            <textarea class="form-control" id="reuploadKeterangan" name="keterangan" rows="2" placeholder="Contoh: Berkas telah di-scan ulang dengan resolusi lebih tajam..." style="border-radius: 8px; font-size: 0.85rem;"></textarea>
                        </div>
                    </div>

                    <div class="modal-footer py-2.5 px-4 bg-light d-flex justify-content-between align-items-center">
                        <button type="button" class="btn btn-sm btn-secondary px-3" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-sm btn-gradient-primary px-3 d-inline-flex align-items-center gap-1.5" id="btnSubmitReupload" style="border-radius: 8px; font-weight: 600;">
                            <i class="mdi mdi-cloud-upload-outline"></i> Upload & Simpan Berkas
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
                        <li><i class="mdi mdi-paperclip"></i><span>Unggah dokumen <strong>SP3K dari Bank</strong>.</span></li>
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

            window.switchDecision = function(type) {
                $decisionErrorBox.hide();
                if (type === 'survey') {
                    $statusInput.val('survey');
                    $formSetuju.stop(true, true).slideDown(180);
                    $formTolak.stop(true, true).slideUp(180);
                    const hasFile = $('#inputBeritaAcara').data('has-file') == 1;
                    $('input[name="berita_acara"]').prop('required', !hasFile);
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
            };

            window.syncDecisionWithDocuments = function(isInitial = false) {
                const $items = $('.doc-row-item');
                const total = $items.length;
                let disetujui = 0, revisi = 0, ditolak = 0, pending = 0;
                const rejectedList = [];
                const revisionList = [];

                $items.each(function() {
                    const $preview = $(this).find('.btn-preview-doc');
                    const st = $preview.data('status') || 'pending';
                    const docName = $preview.data('label') || 'Dokumen';
                    const catatan = $preview.data('catatan') || '';

                    if (st === 'disetujui') {
                        disetujui++;
                    } else if (st === 'revisi') {
                        revisi++;
                        revisionList.push({ name: docName, catatan: catatan });
                    } else if (st === 'ditolak') {
                        ditolak++;
                        rejectedList.push({ name: docName, catatan: catatan });
                    } else {
                        pending++;
                    }
                });

                const isAllApproved = (total > 0 && disetujui === total);
                const $cardApprove = $('#cardDecisionApprove');
                const $inputApprove = $('#decisionApprove');
                const $inputReject = $('#decisionReject');
                const $lockBadge = $('#approveLockedBadge');
                const $syncAlert = $('#decisionDocSyncAlert');
                const $syncIcon = $('#decisionDocSyncIcon');
                const $syncText = $('#decisionDocSyncText');
                const $sidebarAlert = $('#sidebarRekomendasi');
                const $sidebarText = $('#sidebarRekomendasiText');
                const $catatanSetuju = $('#catatan_setuju');
                const $catatanTolak = $('#catatan_tolak');

                if (isAllApproved) {
                    // Dokumen lengkap & semua disetujui
                    $cardApprove.removeClass('disabled');
                    $inputApprove.prop('disabled', false);
                    $lockBadge.hide();

                    $syncAlert.attr('class', 'transaksi-inline-alert success mb-4');
                    $syncIcon.attr('class', 'mdi mdi-check-decagram-outline');
                    $syncText.html(`<strong>Dokumen Terverifikasi Penuh:</strong> Seluruh <strong>${total} berkas dokumen</strong> telah disetujui. Keputusan disesuaikan untuk <strong>Setujui Verifikasi</strong> ke tahap Survey.`);

                    if ($sidebarAlert.length) {
                        $sidebarAlert.attr('class', 'transaksi-inline-alert success mb-0');
                        $sidebarAlert.find('i').attr('class', 'mdi mdi-check-decagram-outline');
                        $sidebarText.html(`Seluruh <strong>${total} dokumen</strong> telah disetujui. Pengajuan direkomendasikan untuk <strong>Setujui Verifikasi</strong>.`);
                    }

                    // Otomatis pilih opsi Setujui Verifikasi dan langsung tampilkan form persetujuan / upload SP3K
                    $inputApprove.prop('checked', true);
                    $inputReject.prop('checked', false);
                    window.switchDecision('survey');

                    if (!$catatanSetuju.val().trim() || $catatanSetuju.data('auto')) {
                        $catatanSetuju.val(`Seluruh berkas dokumen (${total} dokumen) telah lengkap, valid, dan disetujui.`);
                        $catatanSetuju.data('auto', true);
                    }

                    if (!isInitial) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Dokumen Lengkap & Valid',
                            text: 'Semua dokumen telah disetujui. Opsi keputusan dialihkan ke "Setujui Verifikasi".',
                            timer: 2000,
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false
                        });
                    }
                } else {
                    // Dokumen ada yang ditolak, revisi, atau pending
                    $cardApprove.addClass('disabled');
                    $inputApprove.prop('disabled', true);
                    $lockBadge.show();

                    $inputReject.prop('checked', true);
                    window.switchDecision('rejected');

                    if (ditolak > 0) {
                        $lockBadge.attr('class', 'badge bg-danger py-1 px-1.5 align-middle')
                                  .html(`<i class="mdi mdi-lock-outline"></i> Terkunci (${ditolak} ditolak)`);
                        $syncAlert.attr('class', 'transaksi-inline-alert danger mb-4');
                        $syncIcon.attr('class', 'mdi mdi-close-circle-outline');
                        $syncText.html(`<strong>Terdapat Dokumen Ditolak:</strong> Ada <strong>${ditolak} berkas</strong> yang ditolak. Opsi Setujui Verifikasi dikunci dan keputusan otomatis disesuaikan ke <strong>Tolak Verifikasi</strong>.`);

                        if ($sidebarAlert.length) {
                            $sidebarAlert.attr('class', 'transaksi-inline-alert danger mb-0');
                            $sidebarAlert.find('i').attr('class', 'mdi mdi-close-circle-outline');
                            $sidebarText.html(`Terdapat <strong>${ditolak} berkas ditolak</strong>. Pengajuan diarahkan ke penolakan.`);
                        }

                        let msg = 'Penolakan verifikasi KPR karena berkas berikut ditolak:\n';
                        rejectedList.forEach(item => {
                            msg += `• ${item.name}` + (item.catatan ? `: ${item.catatan}` : '') + '\n';
                        });
                        if (!$catatanTolak.val().trim() || $catatanTolak.data('auto')) {
                            $catatanTolak.val(msg.trim());
                            $catatanTolak.data('auto', true);
                        }
                    } else if (revisi > 0) {
                        $lockBadge.attr('class', 'badge bg-warning text-dark py-1 px-1.5 align-middle')
                                  .html(`<i class="mdi mdi-lock-outline"></i> Terkunci (${revisi} revisi)`);
                        $syncAlert.attr('class', 'transaksi-inline-alert warning mb-4');
                        $syncIcon.attr('class', 'mdi mdi-alert-circle-outline');
                        $syncText.html(`<strong>Dokumen Memerlukan Revisi:</strong> Terdapat <strong>${revisi} berkas</strong> yang memerlukan perbaikan. Opsi Setujui Verifikasi dikunci. Keputusan disesuaikan ke <strong>Tolak Verifikasi (Lengkapi Dokumen)</strong>.`);

                        if ($sidebarAlert.length) {
                            $sidebarAlert.attr('class', 'transaksi-inline-alert warning mb-0');
                            $sidebarAlert.find('i').attr('class', 'mdi mdi-alert-circle-outline');
                            $sidebarText.html(`Terdapat <strong>${revisi} berkas perlu revisi</strong>. Opsi disesuaikan ke Lengkapi Dokumen.`);
                        }

                        $('#tindakanLengkapi').prop('checked', true).trigger('change');

                        let msg = 'Dokumen berikut perlu perbaikan/revisi oleh nasabah:\n';
                        revisionList.forEach(item => {
                            msg += `• ${item.name}` + (item.catatan ? `: ${item.catatan}` : '') + '\n';
                        });
                        if (!$catatanTolak.val().trim() || $catatanTolak.data('auto')) {
                            $catatanTolak.val(msg.trim());
                            $catatanTolak.data('auto', true);
                        }
                    } else if (pending > 0) {
                        $lockBadge.attr('class', 'badge bg-secondary py-1 px-1.5 align-middle')
                                  .html(`<i class="mdi mdi-lock-outline"></i> Terkunci (${pending} pending)`);
                        $syncAlert.attr('class', 'transaksi-inline-alert info mb-4');
                        $syncIcon.attr('class', 'mdi mdi-clock-alert-outline');
                        $syncText.html(`<strong>Pemeriksaan Berkas Belum Selesai:</strong> Masih terdapat <strong>${pending} dokumen</strong> berstatus pending. Harap verifikasi seluruh berkas di atas terlebih dahulu untuk membuka opsi <strong>Setujui Verifikasi</strong>.`);

                        if ($sidebarAlert.length) {
                            $sidebarAlert.attr('class', 'transaksi-inline-alert info mb-0');
                            $sidebarAlert.find('i').attr('class', 'mdi mdi-clock-alert-outline');
                            $sidebarText.html(`Masih terdapat <strong>${pending} berkas pending</strong>. Harap periksa seluruh dokumen terlebih dahulu.`);
                        }
                    } else {
                        $lockBadge.attr('class', 'badge bg-secondary py-1 px-1.5 align-middle')
                                  .html(`<i class="mdi mdi-lock-outline"></i> Terkunci`);
                        $syncAlert.attr('class', 'transaksi-inline-alert warning mb-4');
                        $syncIcon.attr('class', 'mdi mdi-file-alert-outline');
                        $syncText.html(`<strong>Belum Ada Dokumen:</strong> Belum ada berkas dokumen yang diunggah. Pengajuan belum dapat disetujui.`);
                    }
                }
            };

            $decisionApprove.on('change', function() {
                if ($(this).is(':checked') && !$(this).prop('disabled')) window.switchDecision('survey');
            });

            $decisionReject.on('change', function() {
                if ($(this).is(':checked')) window.switchDecision('rejected');
            });

            $(document).on('change', 'input[name="tindakan"]', function() {
                if ($decisionReject.is(':checked')) renderSummary('rejected');
            });

            $('#catatan_setuju, #catatan_tolak').on('input', function() {
                $(this).data('auto', false);
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

            // Klik kartu keputusan dengan handling proteksi ketika terkunci
            $('.transaksi-decision-card').on('click', function(e) {
                if ($(this).hasClass('disabled')) {
                    e.preventDefault();
                    e.stopPropagation();

                    const $items = $('.doc-row-item');
                    let disetujui = 0, revisi = 0, ditolak = 0, pending = 0;
                    $items.each(function() {
                        const st = $(this).find('.btn-preview-doc').data('status') || 'pending';
                        if (st === 'disetujui') disetujui++;
                        else if (st === 'revisi') revisi++;
                        else if (st === 'ditolak') ditolak++;
                        else pending++;
                    });

                    if (ditolak > 0) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Persetujuan Terkunci',
                            html: `Terdapat <strong>${ditolak} berkas dokumen yang ditolak</strong>.<br>Pengajuan KPR tidak dapat disetujui jika ada berkas yang ditolak.`,
                            confirmButtonColor: '#6777ef',
                            confirmButtonText: 'Saya Mengerti'
                        });
                    } else if (revisi > 0) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Persetujuan Terkunci',
                            html: `Terdapat <strong>${revisi} berkas yang memerlukan revisi</strong>.<br>Harap minta nasabah melengkapi atau memperbaiki dokumen terlebih dahulu.`,
                            confirmButtonColor: '#6777ef',
                            confirmButtonText: 'Saya Mengerti'
                        });
                    } else if (pending > 0) {
                        Swal.fire({
                            icon: 'info',
                            title: 'Verifikasi Dokumen Belum Selesai',
                            html: `Masih ada <strong>${pending} dokumen berstatus pending</strong>.<br>Harap periksa semua berkas pada tabel di atas (atau klik tombol <strong>"Setujui Semua Dokumen"</strong>) untuk mengaktifkan opsi ini.`,
                            confirmButtonColor: '#6777ef',
                            confirmButtonText: 'Baik, Saya Periksa'
                        });
                    } else {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Dokumen Belum Tersedia',
                            text: 'Belum ada dokumen yang diunggah untuk pengajuan KPR ini.',
                            confirmButtonColor: '#6777ef'
                        });
                    }
                    return false;
                }

                const $radio = $(this).find('input[type="radio"]');
                if (!$radio.prop('disabled')) {
                    $radio.prop('checked', true);
                    window.switchDecision($radio.val());
                }
            });

            // Initialize default on page load based on document results
            window.syncDecisionWithDocuments(true);

            $('#formVerifikasiKpr').on('submit', function(e) {
                e.preventDefault();
                const form = this;
                const status = $statusInput.val();

                if (!status) {
                    $decisionErrorBox.stop(true, true).slideDown(160);
                    $('html, body').animate({
                        scrollTop: $decisionErrorBox.offset().top - 120
                    }, 300);
                    return false;
                }

                if (status === 'survey') {
                    // Validasi: pastikan semua dokumen disetujui
                    const $items = $('.doc-row-item');
                    let unapproved = 0;
                    $items.each(function() {
                        const st = $(this).find('.btn-preview-doc').data('status') || 'pending';
                        if (st !== 'disetujui') unapproved++;
                    });

                    if ($items.length === 0 || unapproved > 0) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Verifikasi Dokumen Belum Memenuhi Syarat',
                            text: 'Semua berkas dokumen harus disetujui terlebih dahulu sebelum menyetujui verifikasi KPR ke tahap Survey.',
                            confirmButtonColor: '#6777ef',
                            confirmButtonText: 'Periksa Dokumen'
                        });
                        return false;
                    }

                    const fileInput = document.getElementById('inputBeritaAcara');
                    if (!fileInput || !fileInput.files || fileInput.files.length === 0) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Dokumen SP3K Wajib Diunggah',
                            text: 'Harap lampirkan file dokumen SP3K dari Bank terlebih dahulu sebelum menyimpan.',
                            confirmButtonColor: '#6777ef',
                            confirmButtonText: 'OK, Saya Mengerti'
                        });
                        return false;
                    }
                }

                const isApprove = status === 'survey';
                Swal.fire({
                    title: isApprove ? 'Konfirmasi Persetujuan KPR' : 'Konfirmasi Penolakan KPR',
                    text: isApprove 
                        ? 'Apakah Anda yakin ingin menyetujui verifikasi KPR ini dan meneruskannya ke tahap berikutnya?' 
                        : 'Apakah Anda yakin ingin menolak pengajuan verifikasi KPR ini?',
                    icon: isApprove ? 'question' : 'warning',
                    showCancelButton: true,
                    confirmButtonColor: isApprove ? '#28a745' : '#dc3545',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: isApprove ? 'Ya, Setujui & Simpan' : 'Ya, Tolak Pengajuan',
                    cancelButtonText: 'Batal',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: 'Menyimpan Data...',
                            html: 'Mohon tunggu sebentar, sedang memproses verifikasi dan upload dokumen.',
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        });
                        form.submit();
                    }
                });
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

        let currentPreviewDocId = null;
        let currentPreviewDocName = '';
        let currentPreviewStatus = 'pending';
        let currentPreviewCatatan = '';

        function escapeHtml(str) {
            if (!str) return '';
            return String(str)
                .replace(/&/g, '&amp;')
                .replace(/</g, '&lt;')
                .replace(/>/g, '&gt;')
                .replace(/"/g, '&quot;')
                .replace(/'/g, '&#039;');
        }

        function resetPreviewState() {
            $('#previewLoading').removeClass('d-none').css('display', 'flex');
            $('#previewError').addClass('d-none').css('display', 'none');
            $('#iframePreview').off('load error').addClass('d-none').css('display', 'none').attr('src', '');
            $('#divImagePreview').addClass('d-none').css('display', 'none');
            $('#imgPreview').off('load error').attr('src', '');
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

        function previewPdf(url, blob) {
            if (blob) {
                activeBlobUrl = URL.createObjectURL(blob);
            }
            const pdfSrc = activeBlobUrl || url;
            const $iframe = $('#iframePreview');
            $iframe.off('load error')
                .on('load', function() {
                    $('#previewLoading').addClass('d-none').css('display', 'none');
                    $('#previewError').addClass('d-none').css('display', 'none');
                    $iframe.removeClass('d-none').css('display', 'block');
                })
                .on('error', function() {
                    showError(url);
                });
            $iframe.attr('src', pdfSrc);
        }

        function previewImage(url, blob) {
            if (blob) {
                activeBlobUrl = URL.createObjectURL(blob);
            }
            const imgSrc = activeBlobUrl || url;
            const $img = $('#imgPreview');
            $img.off('load error')
                .on('load', function() {
                    $('#previewLoading').addClass('d-none').css('display', 'none');
                    $('#previewError').addClass('d-none').css('display', 'none');
                    $('#divImagePreview').removeClass('d-none').css('display', 'flex');
                    $('#previewFooterInfo').text($img[0].naturalWidth + ' × ' + $img[0].naturalHeight + ' px');
                })
                .on('error', function() {
                    if (activeBlobUrl && imgSrc === activeBlobUrl) {
                        activeBlobUrl = null;
                        $img.attr('src', url);
                    } else {
                        showError(url);
                    }
                });
            $img.attr('src', imgSrc);
        }

        function updateModalDocUI(data) {
            currentPreviewStatus = data.status;
            currentPreviewCatatan = data.catatan || '';

            let badgeClass = 'bg-secondary text-white';
            let badgeText = 'Pending';
            if (data.status === 'disetujui') {
                badgeClass = 'bg-success text-white';
                badgeText = 'Disetujui';
            } else if (data.status === 'revisi') {
                badgeClass = 'bg-warning text-dark';
                badgeText = 'Perlu Revisi';
            } else if (data.status === 'ditolak') {
                badgeClass = 'bg-danger text-white';
                badgeText = 'Ditolak';
            }

            $('#modalDocStatusBadge')
                .attr('class', `badge ${badgeClass} ms-1`)
                .text(badgeText);

            if (data.catatan && (data.status === 'revisi' || data.status === 'ditolak')) {
                $('#modalDocCatatanText').text(data.catatan);
                $('#modalDocCatatanBox').removeClass('d-none');
            } else {
                $('#modalDocCatatanBox').addClass('d-none');
            }

            if (data.status !== 'pending') {
                $('#btnModalResetPending').removeClass('d-none');
            } else {
                $('#btnModalResetPending').addClass('d-none');
            }
        }

        function updateDocRowUI(docId, data) {
            const $row = $(`#doc-row-${docId}`);
            if (!$row.length) return;

            let statusBadge = '';
            let catatanHtml = '';

            if (data.status === 'disetujui') {
                statusBadge = '<span class="badge bg-success text-white px-2 py-1"><i class="mdi mdi-check-circle me-1"></i>Disetujui</span>';
            } else if (data.status === 'revisi') {
                statusBadge = '<span class="badge bg-warning text-dark px-2 py-1"><i class="mdi mdi-alert-circle me-1"></i>Perlu Revisi</span>';
                if (data.catatan) {
                    catatanHtml = `<div class="text-danger small mt-1 doc-catatan-text" style="font-size: 0.78rem; line-height: 1.25;"><i class="mdi mdi-information-outline me-0.5"></i><strong>Catatan:</strong> ${escapeHtml(data.catatan)}</div>`;
                }
                const docLabel = $row.find('.btn-preview-doc').data('label') || 'Dokumen';
                const docType = $row.find('.btn-reupload-doc').data('type') || '';
                catatanHtml += `
                    <div class="mt-1.5 doc-reupload-quick-btn">
                        <button type="button" 
                            class="btn btn-xs btn-outline-warning py-1 px-2.5 rounded-pill btn-reupload-doc d-inline-flex align-items-center gap-1 shadow-sm"
                            data-id="${docId}"
                            data-name="${escapeHtml(docLabel)}"
                            data-type="${escapeHtml(docType)}"
                            data-status="${data.status}"
                            data-catatan="${escapeHtml(data.catatan || '')}"
                            data-reupload-url="/transaksi/kpr/document/${docId}/reupload"
                            style="font-size: 0.74rem; font-weight: 600;">
                            <i class="mdi mdi-cloud-upload-outline"></i> Upload Pengganti
                        </button>
                    </div>
                `;
            } else if (data.status === 'ditolak') {
                statusBadge = '<span class="badge bg-danger text-white px-2 py-1"><i class="mdi mdi-close-circle me-1"></i>Ditolak</span>';
                if (data.catatan) {
                    catatanHtml = `<div class="text-danger small mt-1 doc-catatan-text" style="font-size: 0.78rem; line-height: 1.25;"><i class="mdi mdi-close-circle-outline me-0.5"></i><strong>Alasan:</strong> ${escapeHtml(data.catatan)}</div>`;
                }
                const docLabel = $row.find('.btn-preview-doc').data('label') || 'Dokumen';
                const docType = $row.find('.btn-reupload-doc').data('type') || '';
                catatanHtml += `
                    <div class="mt-1.5 doc-reupload-quick-btn">
                        <button type="button" 
                            class="btn btn-xs btn-outline-danger py-1 px-2.5 rounded-pill btn-reupload-doc d-inline-flex align-items-center gap-1 shadow-sm"
                            data-id="${docId}"
                            data-name="${escapeHtml(docLabel)}"
                            data-type="${escapeHtml(docType)}"
                            data-status="${data.status}"
                            data-catatan="${escapeHtml(data.catatan || '')}"
                            data-reupload-url="/transaksi/kpr/document/${docId}/reupload"
                            style="font-size: 0.74rem; font-weight: 600;">
                            <i class="mdi mdi-cloud-upload-outline"></i> Upload Pengganti
                        </button>
                    </div>
                `;
            } else {
                statusBadge = '<span class="badge bg-secondary text-white px-2 py-1"><i class="mdi mdi-clock-outline me-1"></i>Pending</span>';
            }

            $(`#doc-status-cell-${docId}`).html(statusBadge + catatanHtml);

            // Update validator info under document name
            const $validatorInfo = $(`#doc-validator-info-${docId}`);
            if (data.status !== 'pending' && data.validator_name) {
                $validatorInfo.html(`• <span class="text-success"><i class="mdi mdi-account-check-outline"></i> ${escapeHtml(data.validator_name)}</span>`).removeClass('d-none');
            } else {
                $validatorInfo.empty().addClass('d-none');
            }

            // Update data attributes on buttons for this row
            $row.find('.btn-preview-doc')
                .data('status', data.status)
                .data('catatan', data.catatan || '')
                .data('validator', data.validator_name || '');

            $row.find('.btn-validate-doc').data('catatan', data.catatan || '');
            $row.find('.btn-reupload-doc').data('status', data.status).data('catatan', data.catatan || '');

            // Update active state on buttons
            $row.find('.btn-action-approve').toggleClass('active', data.status === 'disetujui');
            $row.find('.btn-action-revisi').toggleClass('active', data.status === 'revisi');
            $row.find('.btn-action-reject').toggleClass('active', data.status === 'ditolak');

            // Show/hide reset button
            const $resetBtn = $row.find('.btn-action-reset');
            if (data.status !== 'pending') {
                if (!$resetBtn.length) {
                    const docName = $row.find('.btn-preview-doc').data('label') || 'Dokumen';
                    $row.find('.doc-action-group').append(`
                        <button type="button" 
                            class="transaksi-doc-action btn-action-reset btn-validate-doc" 
                            data-id="${docId}"
                            data-status="pending"
                            data-name="${escapeHtml(docName)}"
                            title="Kembalikan Status ke Pending">
                            <i class="mdi mdi-refresh"></i>
                        </button>
                    `);
                }
            } else {
                $resetBtn.remove();
            }

            recalculateDocSummary();
        }

        function recalculateDocSummary() {
            const $items = $('.doc-row-item');
            const total = $items.length;
            if (total === 0) return;

            let disetujui = 0, revisi = 0, ditolak = 0, pending = 0;

            $items.each(function() {
                const st = $(this).find('.btn-preview-doc').data('status') || 'pending';
                if (st === 'disetujui') disetujui++;
                else if (st === 'revisi') revisi++;
                else if (st === 'ditolak') ditolak++;
                else pending++;
            });

            $('#statTotalDocs').text(total);
            $('#statApprovedDocs').text(disetujui);
            $('#statRevisionDocs').text(revisi);
            $('#statRejectedDocs').text(ditolak);
            $('#statPendingDocs').text(pending);

            const $alert = $('#docSummaryAlert');
            const $alertText = $('#docSummaryAlertText');
            if ($alert.length && $alertText.length) {
                $alert.removeClass('success warning info');
                if (disetujui === total) {
                    $alert.addClass('success');
                    $alert.find('i').attr('class', 'mdi mdi-check-circle-outline');
                    $alertText.html(`Seluruh <strong>${total} berkas dokumen</strong> telah lengkap dan disetujui.`);
                    $('#btnApproveAllContainer').hide();
                } else if (revisi > 0 || ditolak > 0) {
                    $alert.addClass('warning');
                    $alert.find('i').attr('class', 'mdi mdi-alert-circle-outline');
                    $alertText.html(`Terdapat <strong>${total} dokumen</strong> (<strong>${disetujui} disetujui</strong>, <strong class="text-warning">${revisi} perlu revisi</strong>, <strong class="text-danger">${ditolak} ditolak</strong>).`);
                    $('#btnApproveAllContainer').show();
                } else {
                    $alert.addClass('info');
                    $alert.find('i').attr('class', 'mdi mdi-information-outline');
                    $alertText.html(`Terdapat <strong>${total} berkas dokumen</strong> yang telah diunggah dan siap untuk ditinjau (<strong>${disetujui} disetujui</strong>, <strong>${pending} menunggu verifikasi</strong>).`);
                    $('#btnApproveAllContainer').show();
                }
            }

            if (typeof window.syncDecisionWithDocuments === 'function') {
                window.syncDecisionWithDocuments(false);
            }
        }

        function sendDocumentValidation(docId, status, catatan, docName) {
            Swal.fire({
                title: 'Menyimpan...',
                text: 'Sedang memperbarui status dokumen',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            $.ajax({
                url: `/transaksi/kpr/document/${docId}/validate`,
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    status: status,
                    catatan: catatan
                },
                success: function(res) {
                    Swal.close();
                    if (res.success) {
                        updateDocRowUI(docId, res.data);

                        if ($('#modalPreviewDokumen').hasClass('show') && currentPreviewDocId == docId) {
                            updateModalDocUI(res.data);
                        }

                        Swal.fire({
                            icon: 'success',
                            title: 'Status Diperbarui!',
                            text: res.message,
                            timer: 1600,
                            showConfirmButton: false,
                            toast: true,
                            position: 'top-end'
                        });
                    } else {
                        Swal.fire('Gagal', res.message || 'Terjadi kesalahan.', 'error');
                    }
                },
                error: function(xhr) {
                    Swal.close();
                    let msg = 'Gagal memperbarui status dokumen.';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        msg = xhr.responseJSON.message;
                    }
                    Swal.fire('Gagal', msg, 'error');
                }
            });
        }

        function triggerValidationPrompt(docId, status, currentCatatan, docName) {
            if (status === 'disetujui') {
                Swal.fire({
                    title: 'Setujui Dokumen?',
                    html: `Apakah Anda yakin ingin menyetujui dokumen <br><strong>${escapeHtml(docName)}</strong>?`,
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: '<i class="mdi mdi-check me-1"></i> Ya, Setujui',
                    cancelButtonText: 'Batal',
                    confirmButtonColor: '#10b981',
                    cancelButtonColor: '#6c757d',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        sendDocumentValidation(docId, 'disetujui', null, docName);
                    }
                });
            } else if (status === 'revisi') {
                Swal.fire({
                    title: 'Minta Revisi Dokumen',
                    html: `<p class="mb-2">Masukkan catatan revisi untuk dokumen <strong>${escapeHtml(docName)}</strong>:</p>`,
                    input: 'textarea',
                    inputValue: currentCatatan || '',
                    inputPlaceholder: 'Tuliskan bagian dokumen yang harus diperbaiki (contoh: Foto kurang jelas, data buram)...',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: '<i class="mdi mdi-pencil-outline me-1"></i> Kirim Revisi',
                    cancelButtonText: 'Batal',
                    confirmButtonColor: '#f59e0b',
                    cancelButtonColor: '#6c757d',
                    reverseButtons: true,
                    inputValidator: (value) => {
                        if (!value || !value.trim()) {
                            return 'Catatan revisi wajib diisi!';
                        }
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        sendDocumentValidation(docId, 'revisi', result.value, docName);
                    }
                });
            } else if (status === 'ditolak') {
                Swal.fire({
                    title: 'Tolak Dokumen',
                    html: `<p class="mb-2">Masukkan alasan penolakan dokumen <strong>${escapeHtml(docName)}</strong>:</p>`,
                    input: 'textarea',
                    inputValue: currentCatatan || '',
                    inputPlaceholder: 'Tuliskan alasan dokumen ditolak (contoh: Dokumen tidak valid / palsu)...',
                    icon: 'error',
                    showCancelButton: true,
                    confirmButtonText: '<i class="mdi mdi-close me-1"></i> Tolak Dokumen',
                    cancelButtonText: 'Batal',
                    confirmButtonColor: '#ef4444',
                    cancelButtonColor: '#6c757d',
                    reverseButtons: true,
                    inputValidator: (value) => {
                        if (!value || !value.trim()) {
                            return 'Alasan penolakan dokumen wajib diisi!';
                        }
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        sendDocumentValidation(docId, 'ditolak', result.value, docName);
                    }
                });
            } else if (status === 'pending') {
                Swal.fire({
                    title: 'Kembalikan ke Status Pending?',
                    html: `Reset status verifikasi dokumen <strong>${escapeHtml(docName)}</strong> kembali ke pending?`,
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonText: '<i class="mdi mdi-refresh me-1"></i> Ya, Reset',
                    cancelButtonText: 'Batal',
                    confirmButtonColor: '#64748b',
                    cancelButtonColor: '#6c757d',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        sendDocumentValidation(docId, 'pending', null, docName);
                    }
                });
            }
        }

        // Click on Table Row Validate Action Buttons
        $(document).on('click', '.btn-validate-doc', function(e) {
            e.preventDefault();
            const docId = $(this).data('id');
            const status = $(this).data('status');
            const docName = $(this).data('name') || $(`#doc-row-${docId}`).find('.btn-preview-doc').data('label') || 'Dokumen';
            const currentCatatan = $(this).data('catatan') || '';

            triggerValidationPrompt(docId, status, currentCatatan, docName);
        });

        // Click on Modal Footer Validate Action Buttons
        $(document).on('click', '.btn-modal-validate', function(e) {
            e.preventDefault();
            if (!currentPreviewDocId) return;
            const status = $(this).data('status');

            triggerValidationPrompt(currentPreviewDocId, status, currentPreviewCatatan, currentPreviewDocName);
        });

        // Click on Bulk Approve All Documents Button
        $(document).on('click', '.btn-approve-all', function(e) {
            e.preventDefault();
            const kprId = $(this).data('kpr-id');
            if (!kprId) return;

            Swal.fire({
                title: 'Setujui Semua Dokumen?',
                text: 'Apakah Anda yakin ingin menyetujui seluruh berkas dokumen pengajuan KPR ini sekaligus?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: '<i class="mdi mdi-check-all me-1"></i> Ya, Setujui Semua',
                cancelButtonText: 'Batal',
                confirmButtonColor: '#10b981',
                cancelButtonColor: '#6c757d',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Menyimpan...',
                        text: 'Sedang menyetujui seluruh dokumen KPR',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    $.ajax({
                        url: `/transaksi/kpr/${kprId}/validate-all-documents`,
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            status: 'disetujui'
                        },
                        success: function(res) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: res.message || 'Semua dokumen berhasil disetujui.',
                                confirmButtonColor: '#10b981',
                                confirmButtonText: 'OK'
                            }).then(() => {
                                window.location.reload();
                            });
                        },
                        error: function(xhr) {
                            let msg = 'Gagal memproses persetujuan semua dokumen.';
                            if (xhr.responseJSON && xhr.responseJSON.message) {
                                msg = xhr.responseJSON.message;
                            }
                            Swal.fire('Gagal', msg, 'error');
                        }
                    });
                }
            });
        });

        // Open Modal Preview Click
        $(document).on('click', '.btn-preview-doc', function() {
            const url = $(this).data('url');
            const ext = ($(this).data('ext') || '').toLowerCase();
            const label = $(this).data('label') || 'Dokumen';
            const docId = $(this).data('id');
            const status = $(this).data('status') || 'pending';
            const catatan = $(this).data('catatan') || '';

            currentPreviewDocId = docId;
            currentPreviewDocName = label;
            currentPreviewStatus = status;
            currentPreviewCatatan = catatan;

            // Set info modal
            $('#modalDocLabel').text(label);
            $('#modalDocExt').text(ext.toUpperCase());
            $('#btnDownloadDoc').attr('href', url);
            $('#btnOpenNewTabDoc').attr('href', url);
            $('#btnErrorDownload').attr('href', url);
            $('#previewFooterInfo').text(url.split('/').pop());

            // Status badge in modal header & catatan in modal footer
            updateModalDocUI({
                status: status,
                catatan: catatan
            });

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
            const modalEl = document.getElementById('modalPreviewDokumen');
            let modalInstance = bootstrap.Modal.getInstance(modalEl);
            if (!modalInstance) {
                modalInstance = new bootstrap.Modal(modalEl);
            }
            modalInstance.show();

            // Load file based on type
            if (PDF_EXTS.includes(ext)) {
                fetch(url)
                    .then(function(res) {
                        if (!res.ok) throw new Error('Fetch failed: ' + res.status);
                        return res.blob();
                    })
                    .then(function(blob) {
                        const pdfBlob = new Blob([blob], {
                            type: 'application/pdf'
                        });
                        previewPdf(url, pdfBlob);
                    })
                    .catch(function() {
                        previewPdf(url, null);
                    });
            } else if (IMAGE_EXTS.includes(ext)) {
                previewImage(url, null);
            } else {
                fetch(url)
                    .then(function(res) {
                        if (!res.ok) throw new Error('Fetch failed: ' + res.status);
                        const contentType = res.headers.get('content-type') || '';
                        if (contentType.includes('pdf')) {
                            return res.blob().then(b => previewPdf(url, new Blob([b], { type: 'application/pdf' })));
                        } else if (contentType.includes('image')) {
                            previewImage(url, null);
                        } else {
                            showError(url);
                        }
                    })
                    .catch(function() {
                        showError(url);
                    });
            }
        });

        // Bersihkan blob URL saat modal ditutup
        document.getElementById('modalPreviewDokumen').addEventListener('hidden.bs.modal', function() {
            resetPreviewState();
            currentPreviewDocId = null;
        });

        // ==========================================
        // MODAL UPLOAD PENGGANTI DOKUMEN (REUPLOAD)
        // ==========================================
        let selectedReuploadFile = null;

        function resetReuploadModal() {
            selectedReuploadFile = null;
            const input = document.getElementById('reuploadFileInput');
            if (input) input.value = '';
            const form = document.getElementById('formReuploadDokumen');
            if (form) form.reset();
            $('#dropzonePrompt').removeClass('d-none');
            $('#dropzoneFileSelected').addClass('d-none');
            $('#selectedFileName').text('');
            $('#selectedFileSize').text('');
            $('#reuploadDropzone').removeClass('dragover border-danger');
            $('#btnSubmitReupload').prop('disabled', false).html('<i class="mdi mdi-cloud-upload-outline me-1"></i> Upload & Simpan Berkas');
        }

        function formatBytes(bytes, decimals = 1) {
            if (bytes === 0) return '0 Bytes';
            const k = 1024;
            const dm = decimals < 0 ? 0 : decimals;
            const sizes = ['Bytes', 'KB', 'MB', 'GB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + ' ' + sizes[i];
        }

        function handleFileSelection(file) {
            if (!file) return;

            const allowedExts = ['pdf', 'jpg', 'jpeg', 'png'];
            const ext = file.name.split('.').pop().toLowerCase();
            const maxSize = 5 * 1024 * 1024; // 5MB

            if (!allowedExts.includes(ext)) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Format File Tidak Didukung',
                    text: 'Silakan pilih file dengan format PDF, JPG, JPEG, atau PNG.',
                    confirmButtonColor: '#9a55ff'
                });
                resetReuploadModal();
                return;
            }

            if (file.size > maxSize) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Ukuran File Terlalu Besar',
                    text: 'Ukuran file maksimal adalah 5MB. File yang Anda pilih berukuran ' + formatBytes(file.size) + '.',
                    confirmButtonColor: '#9a55ff'
                });
                resetReuploadModal();
                return;
            }

            selectedReuploadFile = file;
            $('#selectedFileName').text(file.name);
            $('#selectedFileSize').text(formatBytes(file.size));

            if (ext === 'pdf') {
                $('#selectedFileIcon').html('<i class="mdi mdi-file-pdf-box" style="color: #ef4444;"></i>');
            } else {
                $('#selectedFileIcon').html('<i class="mdi mdi-file-image" style="color: #3b82f6;"></i>');
            }

            $('#dropzonePrompt').addClass('d-none');
            $('#dropzoneFileSelected').removeClass('d-none');
        }

        // Buka Modal Reupload dari Table atau Quick Button
        $(document).on('click', '.btn-reupload-doc', function(e) {
            e.preventDefault();
            const docId = $(this).data('id');
            const docName = $(this).data('name') || 'Dokumen';
            const status = $(this).data('status') || 'pending';
            const catatan = $(this).data('catatan') || '';

            openReuploadModal(docId, docName, status, catatan);
        });

        // Buka Modal Reupload dari Footer Modal Preview
        $(document).on('click', '.btn-modal-reupload', function(e) {
            e.preventDefault();
            if (!currentPreviewDocId) return;

            openReuploadModal(currentPreviewDocId, currentPreviewDocName, currentPreviewStatus, currentPreviewCatatan);
        });

        function openReuploadModal(docId, docName, status, catatan) {
            resetReuploadModal();

            $('#reuploadDocId').val(docId);
            $('#modalReuploadDocName').text(docName);
            $('#modalReuploadDocSubLabel').text('Ganti file dokumen "' + docName + '"');

            // Status badge
            let statusBadge = '<span class="badge bg-secondary text-white">Pending</span>';
            if (status === 'revisi') {
                statusBadge = '<span class="badge bg-warning text-dark"><i class="mdi mdi-alert-circle me-1"></i>Perlu Revisi</span>';
            } else if (status === 'ditolak') {
                statusBadge = '<span class="badge bg-danger text-white"><i class="mdi mdi-close-circle me-1"></i>Ditolak</span>';
            } else if (status === 'disetujui') {
                statusBadge = '<span class="badge bg-success text-white"><i class="mdi mdi-check-circle me-1"></i>Disetujui</span>';
            }
            $('#modalReuploadDocStatusBadge').html(statusBadge);

            // Catatan sebelumnya
            if (catatan && (status === 'revisi' || status === 'ditolak')) {
                $('#modalReuploadDocCatatan').text(catatan);
                $('#modalReuploadCatatanBox').removeClass('d-none');
            } else {
                $('#modalReuploadCatatanBox').addClass('d-none');
            }

            // Show modal
            const modalEl = document.getElementById('modalReuploadDokumen');
            let modalInstance = bootstrap.Modal.getInstance(modalEl);
            if (!modalInstance) {
                modalInstance = new bootstrap.Modal(modalEl);
            }
            modalInstance.show();
        }

        // Dropzone & File selection interactions
        $(document).on('click', '#reuploadDropzone', function(e) {
            // Jika klik tombol hapus
            if ($(e.target).closest('#btnRemoveSelectedFile').length) {
                e.preventDefault();
                e.stopPropagation();
                resetReuploadModal();
                return false;
            }
            // Jika klik tombol ganti file
            if ($(e.target).closest('#btnChangeSelectedFile').length) {
                e.preventDefault();
                e.stopPropagation();
                const input = document.getElementById('reuploadFileInput');
                if (input) input.click();
                return false;
            }
            // Jika file sudah terpilih dan klik di card, jangan re-trigger input
            if ($(e.target).closest('#dropzoneFileSelected').length) {
                e.preventDefault();
                return false;
            }
        });

        // File input changed (Native selection)
        $(document).on('change', '#reuploadFileInput', function() {
            if (this.files && this.files[0]) {
                handleFileSelection(this.files[0]);
            }
        });

        // Drag and Drop Events
        $(document).on('dragover dragenter', '#reuploadDropzone', function(e) {
            e.preventDefault();
            e.stopPropagation();
            $(this).addClass('dragover');
        });

        $(document).on('dragleave dragend drop', '#reuploadDropzone', function(e) {
            e.preventDefault();
            e.stopPropagation();
            $(this).removeClass('dragover');
        });

        $(document).on('drop', '#reuploadDropzone', function(e) {
            e.preventDefault();
            e.stopPropagation();
            const dt = e.originalEvent ? e.originalEvent.dataTransfer : e.dataTransfer;
            if (dt && dt.files && dt.files.length) {
                handleFileSelection(dt.files[0]);
                const fileInput = document.getElementById('reuploadFileInput');
                if (fileInput) {
                    fileInput.files = dt.files;
                }
            }
        });

        // Submit Form Reupload
        $(document).on('submit', '#formReuploadDokumen', function(e) {
            e.preventDefault();
            const docId = $('#reuploadDocId').val();
            if (!docId) return;

            const fileInput = document.getElementById('reuploadFileInput');
            if (!selectedReuploadFile && (!fileInput || !fileInput.files || !fileInput.files.length)) {
                Swal.fire({
                    icon: 'warning',
                    title: 'File Belum Dipilih',
                    text: 'Silakan pilih file berkas pengganti terlebih dahulu.',
                    confirmButtonColor: '#9a55ff'
                });
                return;
            }

            const formData = new FormData(this);
            if (selectedReuploadFile && (!formData.get('file') || !formData.get('file').name)) {
                formData.set('file', selectedReuploadFile);
            }

            $('#btnSubmitReupload').prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-1"></span> Mengunggah...');

            Swal.fire({
                title: 'Mengunggah Berkas...',
                text: 'Sedang menyimpan dokumen pengganti...',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            $.ajax({
                url: `/transaksi/kpr/document/${docId}/reupload`,
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: formData,
                processData: false,
                contentType: false,
                success: function(res) {
                    const modalEl = document.getElementById('modalReuploadDokumen');
                    const modalInstance = bootstrap.Modal.getInstance(modalEl);
                    if (modalInstance) {
                        modalInstance.hide();
                    }

                    const prevModalEl = document.getElementById('modalPreviewDokumen');
                    const prevModalInstance = bootstrap.Modal.getInstance(prevModalEl);
                    if (prevModalInstance) {
                        prevModalInstance.hide();
                    }

                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil Diunggah!',
                        text: res.message || 'Dokumen pengganti berhasil disimpan dan siap diverifikasi kembali.',
                        confirmButtonColor: '#10b981',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        window.location.reload();
                    });
                },
                error: function(xhr) {
                    $('#btnSubmitReupload').prop('disabled', false).html('<i class="mdi mdi-cloud-upload-outline me-1"></i> Upload & Simpan Berkas');
                    let msg = 'Gagal mengunggah dokumen pengganti. Silakan periksa format dan ukuran file.';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        msg = xhr.responseJSON.message;
                    } else if (xhr.responseJSON && xhr.responseJSON.errors) {
                        const firstErr = Object.values(xhr.responseJSON.errors)[0];
                        if (firstErr && firstErr.length) msg = firstErr[0];
                    }
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal Mengunggah',
                        text: msg,
                        confirmButtonColor: '#ef4444'
                    });
                }
            });
        });
    </script>
@endpush
