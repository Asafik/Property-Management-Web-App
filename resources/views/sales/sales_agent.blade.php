@extends('layouts.partial.app')

@section('title', 'Tambah Sales / Agent - Property Management App')

@section('content')
<style>
/* ===== MODERN FORM STYLING UNTUK SALES ===== */
.sales-form-group {
    margin-bottom: 1rem;
}

.sales-form-group label {
    font-size: 0.8rem;
    font-weight: 600;
    color: #9a55ff !important;
    margin-bottom: 0.3rem;
    letter-spacing: 0.3px;
    font-family: 'Nunito', sans-serif;
    display: block;
}

.sales-form-control {
    border: 1px solid #e9ecef;
    border-radius: 10px;
    padding: 0.7rem 0.8rem;
    font-size: 0.85rem;
    transition: all 0.2s ease;
    background-color: #ffffff;
    color: #2c2e3f;
    width: 100%;
    font-family: 'Nunito', sans-serif;
}

.sales-form-control:focus {
    border-color: #9a55ff;
    box-shadow: 0 0 0 3px rgba(154, 85, 255, 0.1);
    outline: none;
}

select.sales-form-control {
    appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%239a55ff' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 0.75rem center;
    background-size: 12px;
    padding-right: 2rem;
}

textarea.sales-form-control {
    resize: vertical;
    min-height: 100px;
}

/* ===== MODERN BUTTON STYLING UNTUK SALES ===== */
.sales-btn {
    font-size: 0.8rem;
    padding: 0.5rem 1rem;
    border-radius: 8px;
    font-weight: 600;
    transition: all 0.3s ease;
    font-family: 'Nunito', sans-serif;
    display: inline-block;
    text-decoration: none;
    cursor: pointer;
    border: none;
    width: 100%;
    text-align: center;
}

@media (min-width: 576px) {
    .sales-btn {
        width: auto;
        padding: 0.5rem 1.2rem;
    }
}

.sales-btn-primary {
    background: linear-gradient(to right, #da8cff, #9a55ff);
    color: #ffffff;
    box-shadow: 0 4px 12px rgba(154, 85, 255, 0.3);
}

.sales-btn-primary:hover {
    background: linear-gradient(to right, #c77cff, #8a45e6);
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(154, 85, 255, 0.4);
}

.sales-btn-success {
    background: linear-gradient(135deg, #28a745, #5cb85c);
    color: #ffffff;
    box-shadow: 0 4px 12px rgba(40, 167, 69, 0.3);
}

.sales-btn-success:hover {
    background: linear-gradient(135deg, #218838, #4cae4c);
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(40, 167, 69, 0.4);
}

.sales-btn-secondary {
    background: linear-gradient(135deg, #f0f2f5, #e4e6ea);
    border: 1px solid #e9ecef;
    color: #2c2e3f;
}

.sales-btn-secondary:hover {
    background: linear-gradient(135deg, #e4e6ea, #d8dce2);
    transform: translateY(-2px);
    color: #2c2e3f;
}

.sales-btn-outline-secondary {
    background: transparent;
    border: 1px solid #e9ecef;
    color: #6c7383;
}

.sales-btn-outline-secondary:hover {
    background: linear-gradient(135deg, #f8f9fa, #f1f3f5);
    color: #2c2e3f;
    border-color: #9a55ff;
    transform: translateY(-2px);
}

/* Card Styling */
.sales-card {
    border: 1px solid #e9ecef;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.02);
    background: #ffffff;
    transition: all 0.3s ease;
    margin-bottom: 1rem;
}

.sales-card-header {
    background: linear-gradient(135deg, #ffffff, #f8f9fa);
    border-bottom: 1px solid #e9ecef;
    padding: 1rem 1.2rem;
    border-radius: 16px 16px 0 0 !important;
}

.sales-card-header h4 {
    font-size: 1rem;
    font-weight: 700;
    color: #2c2e3f;
    margin: 0;
}

@media (min-width: 768px) {
    .sales-card-header h4 {
        font-size: 1.125rem;
    }
}

.sales-card-body {
    padding: 1.2rem;
}

@media (min-width: 768px) {
    .sales-card-body {
        padding: 1.5rem;
    }
}

/* Alert Styling */
.sales-alert {
    border: none;
    border-radius: 10px;
    padding: 0.8rem 1rem;
    font-size: 0.8rem;
    border-left: 4px solid;
    margin-bottom: 1rem;
}

.sales-alert-info {
    background: linear-gradient(135deg, #f6f9ff, #f0f4ff);
    color: #2c2e3f;
    border-left-color: #9a55ff;
}

.sales-alert-info i {
    color: #9a55ff;
}

/* Badge Styling */
.sales-badge {
    padding: 0.35rem 0.7rem;
    border-radius: 30px;
    font-size: 0.7rem;
    font-weight: 600;
    letter-spacing: 0.3px;
    font-family: 'Nunito', sans-serif;
    display: inline-block;
    white-space: nowrap;
}

.sales-badge-primary {
    background: linear-gradient(to right, #da8cff, #9a55ff);
    color: #ffffff;
    box-shadow: 0 2px 8px rgba(154, 85, 255, 0.3);
}

.sales-badge-secondary {
    background: linear-gradient(135deg, #6c757d, #939ba3);
    color: #ffffff;
    box-shadow: 0 2px 8px rgba(108, 117, 125, 0.2);
}

/* Section Title */
.sales-section-title {
    font-size: 0.9rem;
    font-weight: 700;
    color: #9a55ff !important;
    margin-bottom: 0.8rem;
    padding-bottom: 0.4rem;
    border-bottom: 2px solid #e9ecef;
    display: flex;
    align-items: center;
    gap: 8px;
    flex-wrap: wrap;
}

.sales-section-title i {
    color: #9a55ff;
    font-size: 1rem;
    background: rgba(154, 85, 255, 0.1);
    padding: 6px;
    border-radius: 8px;
}

/* Divider */
.sales-hr {
    border-top: 1px solid #e9ecef;
    margin: 0.8rem 0;
}

/* Text colors */
.sales-text-muted {
    color: #a5b3cb !important;
    font-size: 0.7rem;
    display: block;
    margin-top: 0.2rem;
}

.sales-text-primary {
    color: #9a55ff !important;
}

/* Grid System */
.sales-row {
    display: flex;
    flex-wrap: wrap;
    margin-right: -0.5rem;
    margin-left: -0.5rem;
}

.sales-col-6,
.sales-col-12,
.sales-col-md-4,
.sales-col-md-6 {
    position: relative;
    width: 100%;
    padding-right: 0.5rem;
    padding-left: 0.5rem;
    margin-bottom: 0.5rem;
}

.sales-col-12 {
    flex: 0 0 100%;
    max-width: 100%;
}

@media (min-width: 768px) {
    .sales-col-md-4 {
        flex: 0 0 33.333333%;
        max-width: 33.333333%;
    }

    .sales-col-md-6 {
        flex: 0 0 50%;
        max-width: 50%;
    }
}

/* Container */
.container-fluid {
    padding-left: 1rem;
    padding-right: 1rem;
}

@media (min-width: 768px) {
    .container-fluid {
        padding-left: 1.5rem;
        padding-right: 1.5rem;
    }
}

/* Button Group */
.sales-btn-group {
    display: flex;
    gap: 0.5rem;
    flex-wrap: wrap;
}

@media (max-width: 576px) {
    .sales-btn-group {
        flex-direction: column;
    }

    .sales-btn-group .sales-btn {
        width: 100%;
    }
}

/* Responsive */
@media (max-width: 576px) {
    .sales-card-body {
        padding: 1rem !important;
    }

    .sales-btn {
        width: 100%;
        margin-bottom: 0.5rem;
    }
}

/* Better touch targets for mobile */
input, select, textarea, button {
    font-size: 16px !important;
}
</style>

<div class="container-fluid p-3 p-md-4">
    <!-- Header -->
    <div class="sales-row mb-3 mb-md-4">
        <div class="sales-col-12">
            <h3 class="text-dark fw-bold" style="color: #2c2e3f; margin-bottom: 0.25rem;">Tambah Sales / Agent</h3>
            <p class="sales-text-muted small" style="margin-bottom: 0;">Input data sales/agent marketing properti</p>
        </div>
    </div>

    <!-- Form Tambah Sales -->
    <div class="sales-row">
        <div class="sales-col-12">
            <div class="sales-card">
                <div class="sales-card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0 d-flex align-items-center">
                        <i class="mdi mdi-account-tie me-2 sales-text-primary"></i>
                        Form Input Data Sales
                    </h4>
                    <span class="sales-badge sales-badge-secondary">* Wajib</span>
                </div>
                <div class="sales-card-body">
                    <form action="" method="POST">
                        @csrf

                        <!-- Alert Info -->
                        <div class="sales-alert sales-alert-info d-flex align-items-start gap-2 mb-4" role="alert">
                            <i class="mdi mdi-information-outline mt-1 flex-shrink-0"></i>
                            <span>Data sales akan digunakan untuk penugasan unit dan komisi penjualan.</span>
                        </div>

                        <!-- Input Form -->
                        <div class="sales-row">
                            <!-- Nama Lengkap -->
                            <div class="sales-col-md-6">
                                <div class="sales-form-group">
                                    <label>Nama Lengkap <span class="text-danger">*</span></label>
                                    <input type="text" name="nama" class="sales-form-control" placeholder="Masukkan nama lengkap" required>
                                    <small class="sales-text-muted">Contoh: Ahmad Rizki</small>
                                </div>
                            </div>

                            <!-- Nomor HP -->
                            <div class="sales-col-md-6">
                                <div class="sales-form-group">
                                    <label>Nomor HP <span class="text-danger">*</span></label>
                                    <input type="text" name="no_hp" class="sales-form-control" placeholder="081234567890" required>
                                    <small class="sales-text-muted">Nomor WhatsApp aktif</small>
                                </div>
                            </div>
                        </div>

                        <!-- Alamat -->
                        <div class="sales-row">
                            <div class="sales-col-12">
                                <div class="sales-form-group">
                                    <label>Alamat <span class="text-danger">*</span></label>
                                    <textarea name="alamat" class="sales-form-control" placeholder="Masukkan alamat lengkap" required></textarea>
                                    <small class="sales-text-muted">Contoh: Jl. Contoh No. 123, Jakarta Selatan</small>
                                </div>
                            </div>
                        </div>

                        <hr class="sales-hr">

                        <!-- Tombol Aksi -->
                        <div class="sales-btn-group mt-4">
                            <a href="{{ url('/sales') }}" class="sales-btn sales-btn-secondary">
                                <i class="mdi mdi-arrow-left me-2"></i>Kembali
                            </a>

                            <div style="margin-left: auto;">
                                <button type="reset" class="sales-btn sales-btn-outline-secondary me-2">
                                    <i class="mdi mdi-refresh me-1"></i>Reset
                                </button>

                                <button type="submit" class="sales-btn sales-btn-primary">
                                    <i class="mdi mdi-content-save me-2"></i>Simpan Sales
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
