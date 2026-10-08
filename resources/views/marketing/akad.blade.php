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

/* DOCUMENT TABLE (Sama persis dengan vertifikasi-kpr) */
.transaksi-doc-table {
    width: 100%;
}

.transaksi-doc-table thead th {
    background: #f8fafc;
    color: #475569;
    font-size: 0.8rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    padding: 1rem 1.25rem;
    border-bottom: 1.5px solid #e2e8f0;
}

.transaksi-doc-table tbody td {
    padding: 1.15rem 1.25rem;
    border-bottom: 1px solid #f1f5f9;
    font-size: 0.88rem;
    vertical-align: middle;
}

.transaksi-doc-table tbody tr:hover td {
    background: #f8fafc;
}

.transaksi-doc-name {
    display: flex;
    align-items: center;
    gap: 0.95rem;
}

.transaksi-doc-icon {
    width: 38px;
    height: 38px;
    border-radius: 6px;
    background: #f1f5f9;
    color: #9a55ff;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.25rem;
    flex-shrink: 0;
}

.transaksi-doc-action {
    width: 36px;
    height: 36px;
    border-radius: 6px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    transition: all 0.2s ease;
    text-decoration: none !important;
    font-size: 1.15rem;
    padding: 0;
    cursor: pointer;
    border: none;
}

.transaksi-doc-action:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
}

/* 1. Preview - Ungu Solid (sama dengan vertifikasi-kpr) */
.transaksi-doc-action.btn-action-preview {
    background: #9a55ff;
    color: #ffffff;
    border: 1px solid #8b5cf6;
}
.transaksi-doc-action.btn-action-preview:hover {
    background: #8435f7;
    border-color: #7c3aed;
    color: #ffffff;
}

/* 2. Print - Biru Solid */
.transaksi-doc-action.btn-action-print {
    background: #0ea5e9;
    color: #ffffff;
    border: 1px solid #0284c7;
}
.transaksi-doc-action.btn-action-print:hover {
    background: #0284c7;
    border-color: #0369a1;
    color: #ffffff;
}

.transaksi-doc-action.disabled {
    background: #f1f5f9 !important;
    border: 1px solid #e2e8f0 !important;
    color: #94a3b8 !important;
    opacity: 0.6;
    cursor: not-allowed;
    transform: none !important;
    box-shadow: none !important;
}

/* Document Status Badges with Rich Spacing & Tailored Colors (Sama persis dengan vertifikasi-kpr) */
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

a.badge-doc-status {
    text-decoration: none !important;
    transition: all 0.2s ease;
}

a.badge-doc-status.status-disetujui:hover {
    background: #d1fae5 !important;
    border-color: #86efac !important;
    color: #166534 !important;
    transform: translateY(-1px);
    box-shadow: 0 3px 8px rgba(16, 185, 129, 0.25) !important;
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
    border-radius: 6px;
    font-weight: 700;
    font-size: 0.88rem;
}

.transaksi-status-banner.success {
    background: #ecfdf5;
    color: #15803d;
    border: 1px solid #bbf7d0;
}

.transaksi-status-banner.warning {
    background: #fffbeb;
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
    border-radius: 6px;
    text-align: center;
    background: #f8fafc;
    border: 1px solid #e2e8f0;
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

.transaksi-summary-box.primary {
    background: #f5f3ff;
    border: 1px solid #ddd6fe;
}

.transaksi-summary-box.primary .label {
    font-size: 0.75rem;
    color: #7c3aed;
    font-weight: 600;
}

.transaksi-summary-box.primary .value {
    font-size: 1.1rem;
    color: #6d28d9;
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
    border-radius: 6px;
    border: 1px solid #e2e8f0;
    background: #ffffff;
    cursor: pointer;
    transition: all 0.25s ease;
    height: 100%;
    margin-bottom: 0;
}

.akad-choice-icon {
    width: 44px;
    height: 44px;
    border-radius: 6px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.35rem;
    flex-shrink: 0;
}

.akad-choice-card.success .akad-choice-icon {
    background: #f0fdf4;
    color: #10b981;
}

.akad-choice-card.danger .akad-choice-icon {
    background: #fef2f2;
    color: #ef4444;
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
    border-color: #10b981;
    background: #f0fdf4;
    box-shadow: none;
}

.akad-choice-card.success input[type="radio"]:checked + .akad-choice-label .akad-choice-check {
    color: #10b981;
}

.akad-choice-card.danger input[type="radio"]:checked + .akad-choice-label {
    border-color: #ef4444;
    background: #fef2f2;
    box-shadow: none;
}

.akad-choice-card.danger input[type="radio"]:checked + .akad-choice-label .akad-choice-check {
    color: #ef4444;
}

/* AKAD FORM SHELL */
.akad-form-shell {
    display: none;
    border-radius: 6px;
    padding: 1.25rem;
    margin-top: 1.25rem;
}

.akad-form-shell.success {
    background: #f0fdf4;
    border: 1px solid #bbf7d0;
}

.akad-form-shell.danger {
    background: #fef2f2;
    border: 1px solid #fecaca;
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
    margin-bottom: 1.15rem;
}

.akad-form-label {
    display: block;
    font-size: 0.86rem;
    font-weight: 700;
    color: #2c2e3f;
    margin-bottom: 0.4rem;
}

.akad-form-control {
    width: 100%;
    border: 1px solid #cbd5e1;
    border-radius: 6px;
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
    border-radius: 6px;
    transition: all 0.2s ease;
}

.verifikasi-file-upload:hover .verifikasi-file-label {
    border-color: #9a55ff;
    background: #f8fafc;
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
    border-radius: 6px;
    border: 1px solid #e2e8f0;
    background: #ffffff;
    cursor: pointer;
    transition: all 0.25s ease;
    margin-bottom: 0;
}

.akad-next-icon {
    width: 36px;
    height: 36px;
    border-radius: 6px;
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
    background: #f5eeff;
}

.akad-next-card input[type="radio"]:checked + .akad-next-label .akad-next-icon {
    background: #9a55ff;
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
    padding: 0.75rem 1.5rem;
    border-radius: 6px;
    font-weight: 700;
    font-size: 0.92rem;
    border: none;
    cursor: pointer;
    transition: all 0.25s ease;
    text-decoration: none !important;
}

.transaksi-btn-primary {
    background: #9a55ff;
    color: #ffffff;
    box-shadow: none;
}

.transaksi-btn-primary:hover {
    background: #873cf4;
    color: #ffffff;
}

.transaksi-btn-secondary {
    background: #f1f5f9;
    color: #64748b;
}

.transaksi-btn-secondary:hover {
    background: #e2e8f0;
    color: #334155;
}

/* CETAK DOKUMEN AKAD BUTTON */
.btn-cetak-akad-action {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.45rem 1rem;
    border-radius: 6px;
    font-size: 0.82rem;
    font-weight: 700;
    color: #ffffff !important;
    background: #9a55ff;
    box-shadow: none;
    text-decoration: none !important;
    transition: all 0.25s ease;
    border: none;
}

.btn-cetak-akad-action:hover {
    background: #873cf4;
    color: #ffffff !important;
}

.btn-cetak-akad-action i {
    font-size: 1.05rem;
}

/* RESPONSIVE DESIGN ENHANCEMENTS */
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
        top: 24px;
        left: 20px;
        width: 650px;
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

    .transaksi-summary-grid {
        grid-template-columns: 1fr 1fr;
        gap: 0.5rem;
    }

    .transaksi-btn {
        width: 100% !important;
        justify-content: center !important;
    }
}

@media (max-width: 575.98px) {
    .customer-unit-info {
        display: grid !important;
        grid-template-columns: repeat(3, 1fr) !important;
        text-align: center;
    }

    .transaksi-summary-box .value {
        font-size: 0.95rem;
    }
    
    .transaksi-summary-box .label {
        font-size: 0.7rem;
    }
}

/* SELECT2 STYLES FOR NOTARIS (Sama persis dengan master/catalog unit) */
.select2-container--bootstrap-5 .select2-selection {
    border: 1px solid #cbd5e1 !important;
    border-radius: 6px !important;
    min-height: 40px !important;
    padding: 0.35rem 0.75rem !important;
    font-family: inherit !important;
    background-color: #ffffff !important;
    display: flex !important;
    align-items: center !important;
    transition: all 0.2s ease !important;
}

.select2-container--bootstrap-5 .select2-selection--single .select2-selection__rendered {
    color: #2c2e3f !important;
    font-size: 0.88rem !important;
    font-weight: 600 !important;
    padding-left: 0 !important;
}

.select2-container--bootstrap-5 .select2-selection--single .select2-selection__arrow {
    height: 38px !important;
    right: 10px !important;
}

.select2-container--bootstrap-5 .select2-selection:hover,
.select2-container--bootstrap-5.select2-container--focus .select2-selection,
.select2-container--bootstrap-5.select2-container--open .select2-selection {
    border-color: #9a55ff !important;
    box-shadow: 0 0 0 3px rgba(154, 85, 255, 0.15) !important;
}

.select2-container--bootstrap-5 .select2-dropdown {
    border-color: #e2e8f0 !important;
    border-radius: 6px !important;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1) !important;
    overflow: hidden !important;
    z-index: 1055 !important;
}

.select2-container--bootstrap-5 .select2-search--dropdown {
    padding: 0.5rem !important;
}

.select2-container--bootstrap-5 .select2-search--dropdown .select2-search__field {
    border: 1px solid #cbd5e1 !important;
    border-radius: 6px !important;
    padding: 0.4rem 0.65rem !important;
    font-size: 0.85rem !important;
}

.select2-container--bootstrap-5 .select2-search--dropdown .select2-search__field:focus {
    border-color: #9a55ff !important;
    outline: none !important;
    box-shadow: 0 0 0 2px rgba(154, 85, 255, 0.15) !important;
}

.select2-container--bootstrap-5 .select2-results__option {
    padding: 0.55rem 0.85rem !important;
    font-size: 0.86rem !important;
    font-weight: 600 !important;
}

.select2-container--bootstrap-5 .select2-results__option--selected {
    background-color: #f3e8ff !important;
    color: #7e22ce !important;
}

.select2-container--bootstrap-5 .select2-results__option--highlighted {
    background: #9a55ff !important;
    color: #ffffff !important;
}
</style>

    @php
        $kpr = $application ?? $kpr;
        $booking = $kpr->booking ?? optional($kpr->unit)->activeBooking;
        $customer = $kpr->customer ?? optional($booking)->customer;
        $unit = $kpr->unit ?? optional($booking)->unit;

        $notarisList = $notarisList ?? \App\Models\Notaris::where('is_active', true)->orderBy('nama_notaris', 'asc')->get();
        $documentsCount = optional($kpr->documents)->whereNotNull('path')->count() ?? 0;
        $missingDocuments = max(0, 8 - $documentsCount);
        $akadSelesai = optional(optional($booking)->akad)->status === 'selesai' || in_array(strtolower($kpr->status ?? ''), ['akad', 'selesai', 'lunas', 'completed']);
        $isSubsidi = strtolower($unit->jenis ?? '') === 'subsidi';

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
        $spkDone = !empty($spkModel) || !empty($unit?->no_spk) || !empty($unit?->dokumen_spk) || !empty($unit?->kontraktor);

        $status = strtolower($unit->construction_progress ?? '');
        $devDone = $status == 'selesai';

        $surveyDone = !empty($kpr->rekomendasi) || !empty($kpr->survey_date) || strtolower($kpr->status_survey ?? '') == 'done' || (optional($booking)->status_survey ?? 0) == 1;
        $serahTerimaDone = !empty(optional(optional($kpr->booking)->serahTerima)->id);

        $totalSteps = 7;
        $currentStep = $serahTerimaDone ? 7 : 6;
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
                                    <i class="mdi mdi-account text-white" style="font-size: 2rem;"></i>
                                </div>
                                <div>
                                    <h4 class="customer-name mb-1 d-flex align-items-center gap-2">
                                        {{ $customer->full_name ?? ($booking->customer->full_name ?? '-') }}
                                        @php
                                            $jenis = strtolower($unit->jenis ?? 'komersil');
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
                                            {{ strtoupper($unit->jenis ?? 'Komersil') }}
                                        </span>
                                    </h4>
                                    <p class="customer-booking mb-0">Booking ID: {{ $booking->booking_code ?? '-' }}
                                    </p>
                                </div>
                            </div>

                            <div class="customer-unit-info">
                                <div class="info-item">
                                    <small>Unit</small>
                                    <span>Tipe {{ $unit->type ?? '-' }}</span>
                                </div>
                                <div class="info-item">
                                    <small>Blok/No</small>
                                    <span>{{ $unit->unit_code ?? '-' }}</span>
                                </div>
                                <div class="info-item">
                                    <small>Harga Unit</small>
                                    <span class="highlight">Rp
                                        {{ number_format($unit->price ?? 0, 0, ',', '.') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4 g-4">
            <!-- LEFT COLUMN: FLOW & ACTIONS -->
            <div class="col-12 col-lg-8 d-flex flex-column gap-4">
                
                <!-- CARD 1: TAHAPAN KPR -->
                <div class="card">
                    <div class="card-body">
                        <div class="transaksi-section-title">
                            <i class="mdi mdi-timeline-text"></i>
                            <span>Tahapan KPR</span>
                        </div>

                        <div class="transaksi-progress-top">
                            <span class="transaksi-muted">Progress Proses</span>
                            <span class="step-counter-purple">Tahap {{ $currentStep }} dari {{ $totalSteps }}</span>
                        </div>

                        <div class="transaksi-progress">
                            <div class="transaksi-progress-bar" style="width: {{ $progressWidth }}%;"></div>
                        </div>

                        @php
                            $bookingId = $kpr->booking_id ?? optional($kpr->booking)->id;
                            $unitId = $kpr->unit_id ?? optional($kpr->unit)->id;
                            $landBankId = optional($kpr->unit)->land_bank_id ?? 1;

                            $urlPengajuan = $bookingId ? route('pengajuan.show', $bookingId) : '#';
                            $urlVerifikasi = $bookingId ? route('transaksi.kpr.approve', $bookingId) : '#';

                            $spkModel = null;
                            if ($kpr->unit) {
                                $spkModel = \App\Models\Spk::where('land_bank_unit_id', $kpr->unit->id)
                                    ->orWhere(function ($q) use ($kpr) {
                                        if (!empty($kpr->unit->no_spk)) {
                                            $q->where('no_spk', $kpr->unit->no_spk);
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

                            $urlSurvey = route('kpr.survey', $kpr->id);
                            $urlAkad = url('/transaksi/kpr/' . $kpr->id . '/akad');
                            $urlSerahTerima = route('kpr.serahterima', $kpr->id);
                        @endphp

                        <div class="transaksi-steps" style="grid-template-columns: repeat(7, 1fr);">
                            {{-- Tahap 1: Pengajuan --}}
                            <div class="transaksi-step completed">
                                <a href="{{ $urlPengajuan }}" class="transaksi-step-icon" title="Buka Halaman Pengajuan KPR">
                                    <i class="mdi mdi-check"></i>
                                </a>
                                <a href="{{ $urlPengajuan }}" class="transaksi-step-title-link" title="Buka Halaman Pengajuan KPR">
                                    <span class="transaksi-step-title">Pengajuan</span>
                                </a>
                                <small>{{ $kpr->submitted_at ? \Carbon\Carbon::parse($kpr->submitted_at)->translatedFormat('d F Y') : '-' }}</small>
                            </div>

                            {{-- Tahap 2: Verifikasi --}}
                            <div class="transaksi-step completed">
                                <a href="{{ $urlVerifikasi }}" class="transaksi-step-icon" title="Buka Halaman Verifikasi KPR">
                                    <i class="mdi mdi-check"></i>
                                </a>
                                <a href="{{ $urlVerifikasi }}" class="transaksi-step-title-link" title="Buka Halaman Verifikasi KPR">
                                    <span class="transaksi-step-title">Verifikasi</span>
                                </a>
                                <small>{{ $kpr->approved_at ? \Carbon\Carbon::parse($kpr->approved_at)->translatedFormat('d F Y') : \Carbon\Carbon::parse($kpr->updated_at)->translatedFormat('d F Y') }}</small>
                            </div>

                            {{-- Tahap 3: SPK --}}
                            <div class="transaksi-step {{ $spkDone ? 'completed' : '' }}">
                                <a href="{{ $urlSpk }}" class="transaksi-step-icon" title="{{ $spkModel ? 'Lihat Detail SPK (' . $spkModel->no_spk . ')' : 'Buka Manajemen SPK Kontraktor' }}">
                                    <i class="mdi {{ $spkDone ? 'mdi-check' : 'mdi-clipboard-text' }}"></i>
                                </a>
                                <a href="{{ $urlSpk }}" class="transaksi-step-title-link" title="{{ $spkModel ? 'Lihat Detail SPK (' . $spkModel->no_spk . ')' : 'Buka Manajemen SPK Kontraktor' }}">
                                    <span class="transaksi-step-title">SPK</span>
                                </a>
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

                            {{-- Tahap 4: Pembangunan --}}
                            <div class="transaksi-step {{ $devDone ? 'completed' : '' }}">
                                <a href="{{ $urlPembangunan }}" class="transaksi-step-icon" title="Buka Monitoring Progress Pembangunan Unit">
                                    @if ($devDone)
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
                            <div class="transaksi-step {{ $surveyDone ? 'completed' : '' }}">
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
                                <small>{{ $surveyDone ? 'Selesai' : 'Menunggu' }}</small>
                            </div>

                            @php
                                $serahTerimaDone = !empty(optional($kpr->booking->serahTerima)->id);
                            @endphp

                            {{-- Tahap 6: Akad --}}
                            <div class="transaksi-step {{ $akadSelesai ? 'completed' : 'active' }}">
                                <a href="{{ $urlAkad }}" class="transaksi-step-icon" title="Halaman Akad KPR (Saat Ini)">
                                    @if ($akadSelesai)
                                        <i class="mdi mdi-check"></i>
                                    @else
                                        <i class="mdi mdi-handshake-outline"></i>
                                    @endif
                                </a>
                                <a href="{{ $urlAkad }}" class="transaksi-step-title-link" title="Halaman Akad KPR (Saat Ini)">
                                    <span class="transaksi-step-title">Akad</span>
                                </a>
                                <small>{{ $akadSelesai ? 'Selesai' : 'Dalam Proses' }}</small>
                            </div>

                            @php
                                $isKomersil = strtolower($unit->jenis ?? 'komersil') === 'komersil';
                                $isBangunanSelesai = $devDone || (strtolower($unit->construction_progress ?? '') === 'selesai') || (($unit->construction_progress_percentage ?? 0) >= 100);
                                $canClickSerahTerima = !$isKomersil || $isBangunanSelesai;
                            @endphp

                            {{-- Tahap 7: Serah Terima --}}
                            <div class="transaksi-step {{ $serahTerimaDone ? 'completed' : '' }}">
                                @if($canClickSerahTerima)
                                    <a href="{{ $urlSerahTerima }}" class="transaksi-step-icon" title="Buka Halaman Serah Terima Unit">
                                        @if ($serahTerimaDone)
                                            <i class="mdi mdi-check"></i>
                                        @else
                                            <i class="mdi mdi-home-outline"></i>
                                        @endif
                                    </a>
                                    <a href="{{ $urlSerahTerima }}" class="transaksi-step-title-link" title="Buka Halaman Serah Terima Unit">
                                        <span class="transaksi-step-title">Serah Terima</span>
                                    </a>
                                @else
                                    <span class="transaksi-step-icon" title="Unit Komersil: Serah Terima baru dapat dilakukan setelah pembangunan fisik unit selesai 100%" style="opacity: 0.6; cursor: not-allowed; background: #f1f5f9; color: #94a3b8;">
                                        <i class="mdi mdi-lock-outline"></i>
                                    </span>
                                    <span class="transaksi-step-title-link" style="opacity: 0.6; cursor: not-allowed;" title="Unit Komersil: Serah Terima baru dapat dilakukan setelah pembangunan fisik unit selesai 100%">
                                        <span class="transaksi-step-title">Serah Terima</span>
                                    </span>
                                @endif
                                <small>{{ $serahTerimaDone ? 'Selesai' : ($isKomersil && !$isBangunanSelesai ? 'Fisik Belum 100%' : 'Menunggu') }}</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- CARD 2: DOKUMEN PENDUKUNG & HASIL SURVEY KPR -->
                <div class="card">
                    <div class="card-body">
                        <div class="transaksi-section-title">
                            <i class="mdi mdi-file-certificate-outline"></i>
                            <span>Dokumen Pendukung & Hasil Survey KPR</span>
                        </div>

                        @php
                            $surveyDone = !empty($kpr->rekomendasi) || !empty($kpr->survey_date) || !empty($kpr->appraisal_value);
                            $allDocsReady = !empty($kpr->berita_acara) && $surveyDone;
                        @endphp

                        @if ($allDocsReady)
                            <div class="transaksi-inline-alert success">
                                <i class="mdi mdi-check-circle-outline"></i>
                                <div>Dokumen Berita Acara Verifikasi dan Laporan Hasil Survey Lapangan telah lengkap. Pengajuan siap diproses untuk tahap akad.</div>
                            </div>
                        @elseif ($kpr->berita_acara || $surveyDone)
                            <div class="transaksi-inline-alert info">
                                <i class="mdi mdi-information-outline"></i>
                                <div>Sebagian dokumen pendukung telah tersedia. Periksa kelengkapan berkas sebelum melanjutkan ke akad.</div>
                            </div>
                        @else
                            <div class="transaksi-inline-alert warning">
                                <i class="mdi mdi-alert-circle-outline"></i>
                                <div>Dokumen pendukung KPR belum lengkap.</div>
                            </div>
                        @endif

                        <div class="table-responsive">
                            <table class="table transaksi-doc-table align-middle mb-0">
                                <thead>
                                    <tr>
                                        <th style="width: 45%;">Nama Dokumen</th>
                                        <th style="width: 20%;">Status</th>
                                        <th style="width: 20%;">Tanggal Dokumen</th>
                                        <th style="width: 15%; text-align: center;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- 1. Berita Acara Verifikasi KPR --}}
                                    <tr>
                                        <td>
                                            <div class="transaksi-doc-name">
                                                <div class="transaksi-doc-icon" style="background: rgba(154, 85, 255, 0.12); color: #9a55ff;">
                                                    <i class="mdi mdi-file-certificate-outline"></i>
                                                </div>
                                                <div>
                                                    <div class="fw-bold">Berita Acara Verifikasi KPR</div>
                                                    <small class="transaksi-muted">Dokumen resmi hasil verifikasi berkas & kelayakan KPR</small>
                                                </div>
                                            </div>
                                        </td>

                                        <td>
                                            @if ($kpr->berita_acara)
                                                <span class="badge-doc-status status-disetujui">
                                                    <i class="mdi mdi-check-circle"></i>Lengkap
                                                </span>
                                            @else
                                                <span class="badge-doc-status status-pending">
                                                    <i class="mdi mdi-clock-outline"></i>Menunggu
                                                </span>
                                            @endif
                                        </td>

                                        <td>
                                            <span class="transaksi-muted">
                                                {{ $kpr->updated_at ? \Carbon\Carbon::parse($kpr->updated_at)->translatedFormat('d M Y') : '-' }}
                                            </span>
                                        </td>

                                        <td class="text-center">
                                            @if ($kpr->berita_acara)
                                                <a href="{{ asset('uploads/' . $kpr->berita_acara) }}" target="_blank"
                                                    class="transaksi-doc-action btn-action-preview" title="Lihat Berita Acara">
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

                                    {{-- 2. Laporan Hasil Survey Lapangan KPR --}}
                                    <tr>
                                        <td>
                                            <div class="transaksi-doc-name">
                                                <div class="transaksi-doc-icon" style="background: rgba(37, 99, 235, 0.12); color: #2563eb;">
                                                    <i class="mdi mdi-home-search-outline"></i>
                                                </div>
                                                <div>
                                                    <div class="fw-bold">Laporan Hasil Survey Lapangan KPR</div>
                                                    <small class="transaksi-muted">Hasil penilaian appraisal, kelayakan fisik & legalitas kavling</small>
                                                </div>
                                            </div>
                                        </td>

                                        <td>
                                            @if ($surveyDone)
                                                <span class="badge-doc-status status-disetujui">
                                                    <i class="mdi mdi-check-circle"></i>Selesai ({{ $kpr->rekomendasi ?? 'Layak' }})
                                                </span>
                                            @else
                                                <span class="badge-doc-status status-pending">
                                                    <i class="mdi mdi-clock-outline"></i>Menunggu Survey
                                                </span>
                                            @endif
                                        </td>

                                        <td>
                                            <span class="transaksi-muted">
                                                {{ $kpr->survey_date ? \Carbon\Carbon::parse($kpr->survey_date)->translatedFormat('d M Y') : '-' }}
                                            </span>
                                        </td>

                                        <td class="text-center">
                                            @if ($surveyDone)
                                                <a href="{{ route('kpr.survey.cetak', $kpr->id) }}" target="_blank"
                                                    class="transaksi-doc-action btn-action-print" title="Lihat & Cetak Laporan Hasil Survey">
                                                    <i class="mdi mdi-printer"></i>
                                                </a>
                                            @else
                                                <a href="{{ route('kpr.survey', $kpr->id) }}"
                                                    class="transaksi-doc-action" style="background: #0284c7; color: #ffffff; border: 1px solid #0284c7;"
                                                    title="Mulai / Lakukan Survey Lapangan KPR">
                                                    <i class="mdi mdi-clipboard-edit-outline"></i>
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- CARD 3: PROSES AKAD FORM -->
                <div class="card">
                    <div class="card-body">
                        <div class="transaksi-section-title">
                            <i class="mdi mdi-handshake-outline"></i>
                            <span>Proses Akad</span>
                        </div>

                        <div class="transaksi-inline-alert info mb-4" id="akadHint">
                            <i class="mdi mdi-information-outline"></i>
                            <div>Pilih salah satu status di bawah ini. Form akan menyesuaikan secara otomatis sesuai hasil proses akad.</div>
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
                                                    Dokumen dan proses closing telah selesai dan siap lanjut ke tahap berikutnya.
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
                                    <div><strong>Formulir Akad KPR.</strong> Lengkapi data notaris dan berkas dokumen hasil akad untuk menyelesaikan tahapan akad.</div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="akad-form-group">
                                            <label class="akad-form-label">Tanggal Akad <span class="text-danger">*</span></label>
                                            <input type="date" class="akad-form-control" name="tanggal_akad" id="tanggal_akad"
                                                value="{{ optional($kpr->booking->akad)->tanggal_akad ?? '2025-03-20' }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="akad-form-group">
                                            <label class="akad-form-label">Lokasi Akad <span class="text-danger">*</span></label>
                                            @php
                                                $savedLokasi = optional($kpr->booking->akad)->lokasi_akad;
                                                $savedNotaris = optional($kpr->booking->akad)->nama_notaris;
                                                $firstNotarisName = $notarisList->first()->nama_notaris ?? '';
                                                $initialNotarisName = $savedNotaris ?: $firstNotarisName;
                                                $defaultLokasi = $savedLokasi ?: ($initialNotarisName ? 'Kantor Notaris ' . $initialNotarisName : 'Kantor Notaris');
                                            @endphp
                                            <input type="text" class="akad-form-control" name="lokasi_akad" id="lokasi_akad"
                                                value="{{ $defaultLokasi }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="akad-form-group">
                                            <label class="akad-form-label">Nama Notaris <span class="text-danger">*</span></label>
                                            <select class="form-control select2-notaris" name="nama_notaris" id="nama_notaris" style="width: 100%;" required>
                                                <option value="">-- Cari & Pilih Notaris Rekanan --</option>
                                                @foreach ($notarisList as $item)
                                                    @php
                                                        $isSelected = ($savedNotaris && ($savedNotaris === $item->nama_notaris || str_contains($savedNotaris, $item->nama_notaris))) 
                                                            || (!$savedNotaris && $loop->first);
                                                    @endphp
                                                    <option value="{{ $item->nama_notaris }}" {{ $isSelected ? 'selected' : '' }}>
                                                        {{ $item->nama_notaris }}
                                                    </option>
                                                @endforeach
                                                @if ($savedNotaris && !$notarisList->contains('nama_notaris', $savedNotaris))
                                                    <option value="{{ $savedNotaris }}" selected>{{ $savedNotaris }}</option>
                                                @endif
                                            </select>
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
                                    <div class="d-flex justify-content-between align-items-center mb-2 flex-wrap gap-2">
                                        <label class="akad-form-label mb-0">Upload Dokumen Hasil Akad (Scan TTD Para Pihak) <span class="text-danger">*</span></label>
                                        <a href="{{ route('akad.kpr.cetak', $kpr->booking_id ?? $kpr->id) }}" target="_blank" class="btn-cetak-akad-action" title="Cetak Format Dokumen Akad Resmi">
                                            <i class="mdi mdi-printer"></i>
                                            <span>Cetak / Unduh Format Dokumen Akad</span>
                                        </a>
                                    </div>

                                    @php
                                        $hasDokumenAkad = !empty(optional($kpr->booking->akad)->dokumen);
                                        $dokumenAkadUrl = '#';
                                        $dokumenAkadName = 'Upload Dokumen Akad';
                                        if ($hasDokumenAkad) {
                                            $dokumenAkadUrl = asset('uploads/' . $kpr->booking->akad->dokumen);
                                            $dokumenAkadName = basename($kpr->booking->akad->dokumen);
                                        }
                                    @endphp

                                    <!-- State 1: Belum Ada Berkas / Box Upload Kosong -->
                                    <div id="dokumen_akad_empty_box" class="verifikasi-file-upload" onclick="document.getElementById('inputDokumenAkad').click()" style="cursor: pointer; {{ $hasDokumenAkad ? 'display: none;' : '' }}">
                                        <div class="verifikasi-file-label">
                                            <i class="mdi mdi-cloud-upload"></i>
                                            <div class="verifikasi-file-info">
                                                <span>Upload Dokumen Akad</span>
                                                <small>Format: JPG, PNG, PDF (Max 5MB)</small>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- State 2: Box Berkas Terunggah (Persis Halaman Survey) -->
                                    <div id="dokumen_akad_uploaded_box" class="rounded-3 mb-0" style="background: #f0fdf4; border: 1.5px solid #86efac; padding: 12px 14px; min-height: 64px; {{ $hasDokumenAkad ? '' : 'display: none;' }}">
                                        <div class="d-flex align-items-center justify-content-between gap-2 flex-wrap">
                                            <div class="d-flex align-items-center gap-2 overflow-hidden flex-grow-1" style="min-width: 0;">
                                                <div class="p-2 rounded-2 flex-shrink-0 d-flex align-items-center justify-content-center" style="background: rgba(0, 201, 167, 0.15); color: #00c9a7; width: 38px; height: 38px;">
                                                    <i class="mdi mdi-file-check-outline" style="font-size: 1.35rem;"></i>
                                                </div>
                                                <div class="overflow-hidden" style="min-width: 0;">
                                                    <span class="d-block fw-bold text-success text-truncate" id="dokumen_akad_status_text" style="font-size: 0.85rem; line-height: 1.2;">
                                                        {{ $hasDokumenAkad ? $dokumenAkadName : 'Berkas Dokumen Akad Terunggah' }}
                                                    </span>
                                                    <small class="text-muted" id="dokumen_akad_size_text">{{ $hasDokumenAkad ? 'Berkas Tersimpan' : '' }}</small>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center flex-shrink-0" style="gap: 6px;">
                                                <a href="{{ $dokumenAkadUrl }}" target="_blank" id="dokumen_akad_view_link" class="btn btn-sm text-white fw-bold px-2.5 py-1.5 shadow-sm d-inline-flex align-items-center justify-content-center" style="background-color: #10b981; border: none; font-size: 0.78rem; border-radius: 6px; gap: 4px; text-decoration: none; {{ $hasDokumenAkad ? '' : 'display: none;' }}">
                                                    <i class="mdi mdi-eye" style="font-size: 0.95rem; line-height: 1;"></i>
                                                    <span>Lihat</span>
                                                </a>
                                                <button type="button" onclick="document.getElementById('inputDokumenAkad').click()" class="btn btn-sm text-white fw-bold px-2.5 py-1.5 shadow-sm d-inline-flex align-items-center justify-content-center" style="background-color: #9a55ff; border: 1px solid #9a55ff; font-size: 0.78rem; border-radius: 6px; gap: 4px;">
                                                    <i class="mdi mdi-cloud-sync" style="font-size: 0.95rem; line-height: 1;"></i>
                                                    <span>Ganti</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Input File Asli -->
                                    <input type="file" name="dokumen_akad" id="inputDokumenAkad" class="d-none" accept=".jpg,.jpeg,.png,.pdf" onchange="previewAkadFile(this, 'dokumen_akad')">
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
                                    <div><strong>Akad ditunda atau bermasalah.</strong> Pilih alasan dan tindakan lanjutan agar proses tetap jelas untuk tim dan customer.</div>
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
                                    @php
                                        $hasDokumenTolak = !empty(optional($kpr->booking->akad)->dokumen) && optional($kpr->booking->akad)->status === 'batal';
                                        $dokumenTolakUrl = '#';
                                        $dokumenTolakName = 'Upload Dokumen Pendukung';
                                        if ($hasDokumenTolak) {
                                            $dokumenTolakUrl = asset('uploads/' . $kpr->booking->akad->dokumen);
                                            $dokumenTolakName = basename($kpr->booking->akad->dokumen);
                                        }
                                    @endphp

                                    <!-- State 1: Belum Ada Berkas -->
                                    <div id="dokumen_tolak_empty_box" class="verifikasi-file-upload" onclick="document.getElementById('inputDokumenTolak').click()" style="cursor: pointer; {{ $hasDokumenTolak ? 'display: none;' : '' }}">
                                        <div class="verifikasi-file-label">
                                            <i class="mdi mdi-cloud-upload"></i>
                                            <div class="verifikasi-file-info">
                                                <span>Upload Dokumen Pendukung</span>
                                                <small>Format: JPG, PNG, PDF (Max 5MB)</small>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- State 2: Box Berkas Terunggah -->
                                    <div id="dokumen_tolak_uploaded_box" class="rounded-3 mb-0" style="background: #f0fdf4; border: 1.5px solid #86efac; padding: 12px 14px; min-height: 64px; {{ $hasDokumenTolak ? '' : 'display: none;' }}">
                                        <div class="d-flex align-items-center justify-content-between gap-2 flex-wrap">
                                            <div class="d-flex align-items-center gap-2 overflow-hidden flex-grow-1" style="min-width: 0;">
                                                <div class="p-2 rounded-2 flex-shrink-0 d-flex align-items-center justify-content-center" style="background: rgba(0, 201, 167, 0.15); color: #00c9a7; width: 38px; height: 38px;">
                                                    <i class="mdi mdi-file-check-outline" style="font-size: 1.35rem;"></i>
                                                </div>
                                                <div class="overflow-hidden" style="min-width: 0;">
                                                    <span class="d-block fw-bold text-success text-truncate" id="dokumen_tolak_status_text" style="font-size: 0.85rem; line-height: 1.2;">
                                                        {{ $hasDokumenTolak ? $dokumenTolakName : 'Berkas Pendukung Terunggah' }}
                                                    </span>
                                                    <small class="text-muted" id="dokumen_tolak_size_text">{{ $hasDokumenTolak ? 'Berkas Tersimpan' : '' }}</small>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center flex-shrink-0" style="gap: 6px;">
                                                <a href="{{ $dokumenTolakUrl }}" target="_blank" id="dokumen_tolak_view_link" class="btn btn-sm text-white fw-bold px-2.5 py-1.5 shadow-sm d-inline-flex align-items-center justify-content-center" style="background-color: #10b981; border: none; font-size: 0.78rem; border-radius: 6px; gap: 4px; text-decoration: none; {{ $hasDokumenTolak ? '' : 'display: none;' }}">
                                                    <i class="mdi mdi-eye" style="font-size: 0.95rem; line-height: 1;"></i>
                                                    <span>Lihat</span>
                                                </a>
                                                <button type="button" onclick="document.getElementById('inputDokumenTolak').click()" class="btn btn-sm text-white fw-bold px-2.5 py-1.5 shadow-sm d-inline-flex align-items-center justify-content-center" style="background-color: #9a55ff; border: 1px solid #9a55ff; font-size: 0.78rem; border-radius: 6px; gap: 4px;">
                                                    <i class="mdi mdi-cloud-sync" style="font-size: 0.95rem; line-height: 1;"></i>
                                                    <span>Ganti</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <input type="file" name="dokumen_tolak" id="inputDokumenTolak" class="d-none" accept=".jpg,.jpeg,.png,.pdf" onchange="previewAkadFile(this, 'dokumen_tolak')">
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
                                                    <span class="akad-next-desc">Atur ulang jadwal akad dengan pihak customer, bank, dan notaris.</span>
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
                                                    <span class="akad-next-desc">Dokumen perlu dilengkapi sebelum akad dilanjutkan kembali.</span>
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
                                                    <span class="akad-next-desc">Lakukan follow up ulang ke pihak bank untuk kendala administrasi/SP3K.</span>
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
                                                    <span class="akad-next-desc">Perlu review tambahan dari tim internal sebelum menentukan jadwal berikutnya.</span>
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
                                <a href="{{ route('kpr.customer-verified') }}" class="transaksi-btn transaksi-btn-secondary">
                                    <i class="mdi mdi-arrow-left"></i>
                                    Kembali
                                </a>

                                <button type="submit" class="transaksi-btn transaksi-btn-primary">
                                    <i class="mdi mdi-content-save-outline"></i>
                                    Simpan Proses Akad
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>

            <!-- RIGHT COLUMN: SIDEBAR DETAILS & SUMMARY -->
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
                                <span>{{ $kpr->bank->bank_name ?? '-' }}</span>
                            </div>
                            <div class="transaksi-detail-item">
                                <span>Harga Unit</span>
                                <span>Rp {{ number_format($kpr->harga_unit ?? ($kpr->unit->price ?? 0), 0, ',', '.') }}</span>
                            </div>
                            @if(($kpr->promo_value ?? 0) > 0 || !empty($kpr->promo_name))
                            <div class="transaksi-detail-item">
                                <span>Promo</span>
                                <span class="text-primary fw-bold">{{ $kpr->promo_name ?? 'Promo Spesial' }}</span>
                            </div>
                            <div class="transaksi-detail-item">
                                <span>Diskon Promo</span>
                                <span class="text-danger fw-bold">- Rp {{ number_format($kpr->promo_value ?? 0, 0, ',', '.') }}</span>
                            </div>
                            @endif

                            <div class="transaksi-detail-item">
                                <span>Total DP yang Dibayar</span>
                                <span style="color: #2563eb; font-weight: 700;">
                                    Rp {{ number_format($kpr->dp ?? 0, 0, ',', '.') }}
                                </span>
                            </div>

                            <div class="transaksi-detail-item">
                                <span>Jumlah Pinjaman (Plafond)</span>
                                <span>Rp {{ number_format($kpr->jumlah_pinjaman ?? 0, 0, ',', '.') }}</span>
                            </div>
                            <div class="transaksi-detail-item">
                                <span>Tenor</span>
                                <span>{{ $kpr->tenor ?? '-' }} Tahun</span>
                            </div>
                            <div class="transaksi-detail-item">
                                <span>Angsuran / bln</span>
                                <span class="highlight">Rp {{ number_format($kpr->estimasi_angsuran ?? 0, 0, ',', '.') }}</span>
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
                                    <div class="transaksi-handler-name">{{ $kpr->booking->sales->name ?? ($kpr->unit->activeBooking->sales->name ?? 'Staff Marketing') }}</div>
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

                <!-- SIDEBAR CARD 2: INFORMASI AKAD -->
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
                                <div class="label">Berita Acara (BA)</div>
                                <div class="value" style="font-size: 1rem; font-weight: 700;">{{ $kpr->berita_acara ? 'Tersedia' : 'Belum Ada' }}</div>
                            </div>
                            <div class="transaksi-summary-box primary">
                                <div class="label">Skema Unit</div>
                                <div class="value" style="font-size: 1rem; font-weight: 700;">{{ strtoupper($kpr->unit->jenis ?? 'KPR') }}</div>
                            </div>
                        </div>

                        <div class="transaksi-sidebar-section">
                            <div class="transaksi-sidebar-title">Rekomendasi Sistem</div>
                            @if ($kpr->berita_acara || in_array(strtolower($kpr->status ?? ''), ['approved', 'survey', 'analisa']))
                                <div class="transaksi-inline-alert success mb-0">
                                    <i class="mdi mdi-check-decagram-outline"></i>
                                    <div>Berita Acara KPR telah terverifikasi. Proses penandatanganan akad dapat dilanjutkan.</div>
                                </div>
                            @else
                                <div class="transaksi-inline-alert warning mb-0">
                                    <i class="mdi mdi-file-alert-outline"></i>
                                    <div>Menunggu kelengkapan verifikasi Berita Acara KPR.</div>
                                </div>
                            @endif
                        </div>

                        <div class="transaksi-sidebar-section">
                            <div class="transaksi-sidebar-title">Rencana Akad</div>
                            <ul class="transaksi-mini-list mb-0">
                                <li>
                                    <i class="mdi mdi-calendar-outline"></i>
                                    <span>Rencana akad:
                                        <span id="sidebarTanggalAkad">
                                            {{ optional(optional($kpr->booking)->akad)->tanggal_akad
                                                ? \Carbon\Carbon::parse($kpr->booking->akad->tanggal_akad)->translatedFormat('d F Y')
                                                : \Carbon\Carbon::now()->translatedFormat('d F Y') }}
                                        </span>
                                    </span>
                                </li>
                                <li>
                                    <i class="mdi mdi-map-marker-outline"></i>
                                    <span>Lokasi:
                                        <span id="sidebarLokasiAkad">
                                            {{ optional(optional($kpr->booking)->akad)->lokasi_akad ?? ($defaultLokasi ?? 'Kantor Notaris') }}
                                        </span>
                                    </span>
                                </li>
                                <li>
                                    <i class="mdi mdi-account-tie-outline"></i>
                                    <span>Notaris:
                                        <span id="sidebarNotarisName">
                                            {{ optional(optional($kpr->booking)->akad)->nama_notaris ?? ($notarisList->first()->nama_notaris ?? 'Notaris Rekanan') }}
                                        </span>
                                    </span>
                                </li>

                                <li>
                                    <i class="mdi mdi-file-document-outline"></i>
                                    <span class="d-inline-flex align-items-center flex-wrap">
                                        Dokumen:
                                        <span id="sidebarDokumenWrap">
                                            @if (optional($kpr->booking->akad)->dokumen)
                                                <a href="{{ asset('uploads/' . $kpr->booking->akad->dokumen) }}"
                                                    target="_blank" id="sidebarDokumenLink" class="badge-doc-status status-disetujui ms-2"
                                                    style="padding: 4px 10px; font-size: 0.78rem; cursor: pointer; border-radius: 6px;"
                                                    title="Buka & Lihat Berita Acara Akad">
                                                    <i class="mdi mdi-check-circle"></i> Berita Acara Akad
                                                </a>
                                            @else
                                                <span class="text-muted ms-1">Belum tersedia</span>
                                            @endif
                                        </span>
                                    </span>
                                </li>
                            </ul>
                        </div>

                        @php
                            $isKomersil = strtolower($unit->jenis ?? 'komersil') === 'komersil';
                            $isBangunanSelesai = $devDone || (strtolower($unit->construction_progress ?? '') === 'selesai') || (($unit->construction_progress_percentage ?? 0) >= 100);
                            $canSerahTerima = $akadSelesai && (!$isKomersil || $isBangunanSelesai);
                        @endphp

                        @if ($canSerahTerima)
                            <div class="transaksi-sidebar-section">
                                <div class="transaksi-sidebar-title">Langkah Berikutnya</div>
                                <a href="{{ route('kpr.serahterima', $kpr->id) }}"
                                    class="transaksi-btn transaksi-btn-primary w-100 justify-content-center">
                                    <i class="mdi mdi-home-check-outline"></i>
                                    Proses Serah Terima
                                </a>
                            </div>
                        @elseif ($isKomersil && $akadSelesai && !$isBangunanSelesai)
                            <div class="transaksi-sidebar-section">
                                <div class="transaksi-sidebar-title">Langkah Berikutnya</div>
                                <div class="p-2.5 rounded text-center" style="background: #fffbeb; border: 1px solid #fde68a; color: #b45309; font-size: 0.8rem; font-weight: 600; line-height: 1.4; border-radius: 6px;">
                                    <i class="mdi mdi-lock-outline me-1"></i>
                                    Serah Terima belum dapat dilakukan. Pembangunan fisik unit komersil harus selesai 100% terlebih dahulu.
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- SIDEBAR CARD 3: PANDUAN PROSES -->
                <div class="card">
                    <div class="card-body">
                        <div class="transaksi-section-title">
                            <i class="mdi mdi-lightbulb-on-outline"></i>
                            <span>Panduan Proses</span>
                        </div>

                        <div class="transaksi-sidebar-section pt-0 mt-0 border-0">
                            <div class="transaksi-sidebar-title">Saat Akad Selesai</div>
                            <ul class="transaksi-mini-list mb-0">
                                <li>
                                    <i class="mdi mdi-arrow-right-circle-outline"></i>
                                    <span>Gunakan jika penandatanganan akad telah selesai tanpa kendala.</span>
                                </li>
                                <li>
                                    <i class="mdi mdi-arrow-right-circle-outline"></i>
                                    <span>Isi tanggal, lokasi, notaris, dan upload dokumen akad.</span>
                                </li>
                            </ul>
                        </div>

                        <div class="transaksi-sidebar-section">
                            <div class="transaksi-sidebar-title">Saat Ditunda / Bermasalah</div>
                            <ul class="transaksi-mini-list mb-0">
                                <li>
                                    <i class="mdi mdi-arrow-right-circle-outline"></i>
                                    <span>Gunakan jika ada kendala jadwal, dokumen, atau SP3K bank.</span>
                                </li>
                                <li>
                                    <i class="mdi mdi-arrow-right-circle-outline"></i>
                                    <span>Pilih tindakan lanjutan yang relevan untuk follow-up tim.</span>
                                </li>
                            </ul>
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
            const $selectNotaris = $('#nama_notaris');

            // Inisialisasi Select2 untuk Notaris (Searchable & Tags support)
            function initNotarisSelect2() {
                if ($selectNotaris.length) {
                    $selectNotaris.select2({
                        theme: 'bootstrap-5',
                        placeholder: '-- Cari & Pilih Notaris Rekanan --',
                        allowClear: true,
                        width: '100%',
                        tags: true
                    });
                }
            }

            initNotarisSelect2();

            // Handler perubahan pilihan notaris -> auto-fill Lokasi Akad menyesuaikan nama notaris
            $selectNotaris.on('change select2:select', function() {
                const notarisName = $(this).val();

                if (notarisName) {
                    let nama = notarisName.trim();
                    let kantorText = nama.toLowerCase().startsWith('notaris') 
                        ? 'Kantor ' + nama 
                        : 'Kantor Notaris ' + nama;
                    $('#lokasi_akad').val(kantorText);
                    $('#sidebarLokasiAkad').text(kantorText);
                    $('#sidebarNotarisName').text(nama);
                }
            });

            // Sinkronisasi realtime field Lokasi & Tanggal ke Sidebar
            $('#lokasi_akad').on('input', function() {
                $('#sidebarLokasiAkad').text($(this).val() || '-');
            });

            $('#tanggal_akad').on('change', function() {
                if ($(this).val()) {
                    try {
                        const d = new Date($(this).val());
                        const options = { day: 'numeric', month: 'long', year: 'numeric' };
                        $('#sidebarTanggalAkad').text(d.toLocaleDateString('id-ID', options));
                    } catch(e) {}
                }
            });

            // Trigger sinkronisasi awal saat halaman dimuat
            if ($selectNotaris.val()) {
                const notarisName = $selectNotaris.val().trim();
                $('#sidebarNotarisName').text(notarisName);
                if (!$('#lokasi_akad').val()) {
                    let kantorText = notarisName.toLowerCase().startsWith('notaris') 
                        ? 'Kantor ' + notarisName 
                        : 'Kantor Notaris ' + notarisName;
                    $('#lokasi_akad').val(kantorText);
                    $('#sidebarLokasiAkad').text(kantorText);
                }
            }

            function switchAkad(type) {
                if (type === 'completed') {
                    $statusInput.val('completed');
                    $formSelesai.stop(true, true).slideDown(180, function() {
                        initNotarisSelect2();
                    });
                    $formTunda.stop(true, true).slideUp(180);
                    $('#no_akad').attr('name', 'nomor_akad');
                    $('#nomor_akad_tunda').removeAttr('name');
                } else if (type === 'cancelled') {
                    $statusInput.val('cancelled');
                    $formTunda.stop(true, true).slideDown(180);
                    $formSelesai.stop(true, true).slideUp(180);
                    $('#nomor_akad_tunda').attr('name', 'nomor_akad');
                    $('#no_akad').removeAttr('name');
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

            window.previewAkadFile = function(input, field) {
                if (input.files && input.files[0]) {
                    const file = input.files[0];
                    const fileUrl = URL.createObjectURL(file);
                    const sizeInMB = (file.size / (1024 * 1024)).toFixed(2);

                    const emptyBox = document.getElementById(field + '_empty_box');
                    const uploadedBox = document.getElementById(field + '_uploaded_box');
                    const statusTextEl = document.getElementById(field + '_status_text');
                    const sizeTextEl = document.getElementById(field + '_size_text');
                    const viewLinkEl = document.getElementById(field + '_view_link');

                    if (statusTextEl) {
                        statusTextEl.textContent = file.name;
                    }
                    if (sizeTextEl) {
                        sizeTextEl.textContent = sizeInMB + ' MB';
                    }
                    if (viewLinkEl) {
                        viewLinkEl.href = fileUrl;
                        viewLinkEl.style.display = 'inline-flex';
                    }
                    if (emptyBox) emptyBox.style.display = 'none';
                    if (uploadedBox) uploadedBox.style.display = 'block';

                    if (field === 'dokumen_akad') {
                        const $wrap = $('#sidebarDokumenWrap');
                        if ($wrap.length) {
                            $wrap.html(`
                                <a href="${fileUrl}" target="_blank" id="sidebarDokumenLink" class="badge-doc-status status-disetujui ms-2"
                                    style="padding: 4px 10px; font-size: 0.78rem; cursor: pointer; border-radius: 6px;"
                                    title="Buka & Lihat Berita Acara Akad">
                                    <i class="mdi mdi-check-circle"></i> Berita Acara Akad
                                </a>
                            `);
                        }
                    }
                }
            };
        });
    </script>
@endpush
