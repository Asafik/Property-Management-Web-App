@extends('layouts.partial.app')

@section('title', 'Pengolahan Lahan per Fase - ' . ($land->name ?? 'Proyek') . ' - Property Management App')

@section('content')
<div class="content-wrapper p-3 p-md-4">
    <!-- Select2 Search JS CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" rel="stylesheet" />

    <!-- Custom Scoped Styles for Phased Site Development -->
    <style>
        .header-card {
            background: #ffffff;
            border-radius: 8px !important;
            border: none !important;
            box-shadow: 0 4px 18px rgba(0, 0, 0, 0.04);
            margin-bottom: 0;
        }

        .phase-stat-card {
            background: #ffffff;
            border: 1px solid #eef2f6;
            border-radius: 12px;
            transition: all 0.25s ease;
            cursor: pointer;
            position: relative;
            user-select: none;
        }
        .phase-stat-card:hover {
            border-color: #d1b8ff;
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(154, 85, 255, 0.08);
        }
        .phase-stat-card.active {
            border: 2px solid #9a55ff !important;
            background: #faf7ff !important;
            box-shadow: 0 4px 14px rgba(154, 85, 255, 0.12) !important;
        }

        .task-card-phased {
            background: #ffffff;
            border-radius: 12px;
            border: 1px solid #eef2f6;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.02);
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }
        .task-card-phased:hover {
            border-color: #c4b5fd;
            box-shadow: 0 4px 16px rgba(154, 85, 255, 0.07);
        }
        .badge-soft-primary { background: #f0e7ff; color: #9a55ff; }
        .badge-soft-success { background: #e6f9f0; color: #10b981; }
        .badge-soft-warning { background: #fff8e6; color: #f59e0b; }
        .badge-soft-danger { background: #fef2f2; color: #ef4444; }
        .table-elevated thead th {
            background: #f8faff;
            color: #4b5563;
            font-weight: 700;
            font-size: 0.78rem;
            letter-spacing: 0.5px;
            border-bottom: 2px solid #eef2f6;
            padding: 0.8rem 1rem;
        }
        .table-elevated tbody td {
            padding: 0.8rem 1rem;
            border-bottom: 1px solid #f3f4f6;
            font-size: 0.88rem;
        }
        /* Select2 Theme Customization */
        .select2-container--bootstrap-5 .select2-selection {
            border-radius: 8px;
            border-color: #e9ecef;
            min-height: 38px;
            display: flex;
            align-items: center;
        }
        .select2-container--bootstrap-5 .select2-selection--single .select2-selection__rendered {
            color: #4b5563;
            font-size: 0.88rem;
            padding-left: 0.5rem;
        }
        .select2-container--bootstrap-5 .select2-dropdown {
            border-radius: 8px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
            border: 1px solid #e9ecef;
        }
        .select2-container--bootstrap-5 .select2-results__group {
            font-weight: 700;
            color: #9a55ff;
            background: #f8faff;
            padding: 6px 12px;
            font-size: 0.8rem;
            border-bottom: 1px solid #eef2f6;
        }
        .select2-container--bootstrap-5 .select2-results__option--highlighted {
            background-color: #9a55ff !important;
            color: #ffffff !important;
        }
        /* Active Selected Card Styling */
        .task-card-active {
            border: 2px solid #9a55ff !important;
            box-shadow: 0 6px 20px rgba(154, 85, 255, 0.15) !important;
            background: #faf6ff !important;
        }
        .card-expense-trigger:hover {
            background: #f3e8ff !important;
            border-color: #9a55ff !important;
            transform: translateY(-2px);
        }

        /* ===== MODERN FILE UPLOAD STYLING (MATCHING PROPERTI) ===== */
        .properti-file-upload-modern {
            position: relative;
            width: 100%;
        }
        .properti-file-upload-modern input[type="file"] {
            position: absolute;
            opacity: 0;
            width: 100%;
            height: 100%;
            cursor: pointer;
            z-index: 2;
            top: 0;
            left: 0;
        }
        .properti-file-upload-modern .properti-file-label-modern {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 0.6rem 0.85rem;
            background: linear-gradient(135deg, #f8f9fa, #f1f3f5);
            border: 2px dashed #d0d4db;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.25s ease;
        }
        .properti-file-upload-modern:hover .properti-file-label-modern {
            border-color: #9a55ff;
            background: linear-gradient(135deg, #f1f0ff, #f8f9fa);
            transform: translateY(-1px);
        }
        .properti-file-upload-modern .properti-file-label-modern i {
            font-size: 1.2rem;
            color: #9a55ff;
            background: rgba(154, 85, 255, 0.1);
            padding: 6px;
            border-radius: 50%;
            flex-shrink: 0;
        }
        .properti-file-upload-modern .properti-file-info-modern {
            display: flex;
            flex-direction: column;
            flex-grow: 1;
            overflow: hidden;
        }
        .properti-file-upload-modern .file-title-text {
            font-size: 0.82rem;
            font-weight: 600;
            color: #2c2e3f;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .properti-file-upload-modern .file-sub-text {
            font-size: 0.7rem;
            color: #6c757d;
        }
        .properti-file-upload-modern .properti-file-size {
            font-size: 0.72rem;
            font-weight: 600;
            color: #9a55ff;
            flex-shrink: 0;
        }

        /* ===== UNIVERSAL BUTTON & BADGE VERTICAL/HORIZONTAL CENTERING ===== */
        .btn,
        .btn-sm,
        .btn-xs,
        .badge,
        a.btn,
        span.btn,
        label.btn,
        button.btn {
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            text-align: center !important;
            vertical-align: middle !important;
            line-height: 1 !important;
            box-sizing: border-box !important;
        }

        .btn-pill-primary {
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            background-color: #9a55ff !important;
            color: #ffffff !important;
            font-size: 0.75rem !important;
            font-weight: 600 !important;
            padding: 6px 12px !important;
            border-radius: 6px !important;
            border: none !important;
            line-height: 1 !important;
            box-shadow: 0 2px 4px rgba(154, 85, 255, 0.2) !important;
            cursor: pointer !important;
            text-decoration: none !important;
            white-space: nowrap !important;
            transition: all 0.2s ease !important;
        }
        .btn-pill-primary:hover {
            background-color: #8333e6 !important;
            color: #ffffff !important;
            transform: translateY(-1px) !important;
            box-shadow: 0 4px 8px rgba(154, 85, 255, 0.3) !important;
        }

        .btn-pill-xs {
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            background-color: #9a55ff !important;
            color: #ffffff !important;
            font-size: 0.7rem !important;
            font-weight: 600 !important;
            padding: 4px 8px !important;
            border-radius: 4px !important;
            border: none !important;
            line-height: 1 !important;
            box-shadow: 0 1px 3px rgba(154, 85, 255, 0.15) !important;
            cursor: pointer !important;
            text-decoration: none !important;
            white-space: nowrap !important;
        }
        .btn-pill-xs:hover {
            background-color: #8333e6 !important;
            color: #ffffff !important;
        }

        .btn-table-del {
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            width: 28px !important;
            height: 28px !important;
            padding: 0 !important;
            border-radius: 6px !important;
            background-color: #fe7c96 !important;
            color: #ffffff !important;
            border: none !important;
            font-size: 0.95rem !important;
            line-height: 1 !important;
            cursor: pointer !important;
            box-shadow: 0 1px 3px rgba(254, 124, 150, 0.2) !important;
            transition: all 0.2s ease !important;
        }
        .btn-table-del:hover {
            background-color: #e65675 !important;
            color: #ffffff !important;
        }
    </style>

    <!-- Header Dashboard Card Banner -->
    <div class="row mb-3 mb-md-4">
        <div class="col-12">
            <div class="card shadow-sm border-0 header-card">
                <div class="card-body p-4 d-flex flex-wrap justify-content-between align-items-center gap-3" style="min-height: 105px;">
                    <div>
                        <h3 class="text-dark mb-1 fw-bold" style="font-size: 1.35rem;">
                            Pengolahan Lahan: <span class="text-primary">{{ $land->name }}</span>
                        </h3>
                        <p class="text-muted mb-0" style="font-size: 0.9rem;">
                            Progres bertahap Fase 1 &rarr; Fase 2 &rarr; Fase 3 (Semua fase harus 100% selesai untuk membuka Tambah Kavling)
                        </p>
                    </div>
                    <div class="d-flex flex-wrap gap-2 align-items-center">
                        <a href="{{ route('properti-all') }}" class="btn btn-outline-secondary btn-sm px-3 rounded-2 d-flex align-items-center gap-1 shadow-sm">
                            <i class="mdi mdi-arrow-left"></i> Kembali
                        </a>

                        <!-- Validasi Legalitas Status Trigger -->
                        @if($land->legal_status == 'verified' || $land->isFromPraLandbank())
                            <button type="button" class="btn btn-sm btn-outline-success px-3 rounded-2 shadow-sm" onclick="openLegalitasModal()" title="Status Legalitas Terverifikasi">
                                Legalitas: <strong>Terverifikasi</strong>
                            </button>
                        @elseif($land->legal_status == 'rejected')
                            <button type="button" class="btn btn-sm btn-outline-danger px-3 rounded-2 shadow-sm" onclick="openLegalitasModal()" title="Status Legalitas Perlu Revisi">
                                Legalitas: <strong>Revisi</strong>
                            </button>
                        @else
                            <button type="button" class="btn btn-sm btn-outline-warning px-3 rounded-2 shadow-sm" onclick="openLegalitasModal()" title="Status Legalitas Menunggu Verifikasi">
                                Legalitas: <strong>Pending</strong>
                            </button>
                        @endif

                        <a href="{{ route('master.bahan.index') }}" class="btn btn-outline-primary btn-sm px-3 rounded-2 shadow-sm">
                            Master Bahan
                        </a>

                        @if($land->canCreateKavling())
                            <a href="{{ route('properti.buatKavling', $land->id) }}" class="btn btn-gradient-success btn-sm px-3 rounded-2 shadow-sm">
                                Tambah Kavling
                            </a>
                        @else
                            <button type="button" class="btn btn-secondary btn-sm px-3 rounded-2 shadow-sm opacity-75" onclick="showKavlingLockedInfo()" title="Tambah Kavling Terkunci">
                                <i class="mdi mdi-lock me-1"></i> Tambah Kavling
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Overall Progress & Dual Validation Rules Alert -->
    <div class="card border-0 shadow-sm rounded-3 mb-4 bg-white">
        <div class="card-body p-3 p-md-4">
            <div class="row align-items-center g-4">
                <div class="col-lg-7">
                    @php
                        $progress = $land->overall_infrastructure_progress;
                        $isDevSelesai = in_array(strtolower($land->development_status), ['selesai', 'done']) || $progress >= 100;
                        $isLegalValid = ($land->legal_status === 'verified') || $land->isFromPraLandbank();
                        $isCanKavling = $land->canCreateKavling();
                    @endphp
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="fw-bold text-dark" style="font-size: 0.9rem;">Progres Pengolahan Lahan:</span>
                        @if($isDevSelesai)
                            <span class="badge bg-success text-white py-1 px-3 rounded-2 fw-bold" id="headerStatusBadge">
                                Selesai (100%)
                            </span>
                        @elseif($progress > 0)
                            <span class="badge bg-warning text-dark py-1 px-3 rounded-2 fw-bold" id="headerStatusBadge">
                                Dalam Proses ({{ $progress }}%)
                            </span>
                        @else
                            <span class="badge bg-secondary text-white py-1 px-3 rounded-2 fw-bold" id="headerStatusBadge">
                                Belum Dimulai
                            </span>
                        @endif
                    </div>

                    <div class="progress mb-2" style="height: 12px; border-radius: 8px; background: #e9ecef;">
                        <div class="progress-bar progress-bar-striped progress-bar-animated {{ $isDevSelesai ? 'bg-success' : ($progress > 0 ? 'bg-warning' : 'bg-primary') }}" 
                             id="headerProgressBar" 
                             role="progressbar" 
                             style="width: {{ $progress }}%; border-radius: 8px;"></div>
                    </div>

                    <div class="d-flex justify-content-between small text-muted">
                        <span>Total Akumulasi: <b class="text-primary" id="headerProgressText">{{ $progress }}%</b></span>
                        @if($isCanKavling)
                            <span class="badge bg-soft-success text-success fw-bold">Syarat Kavling Terpenuhi (Terbuka)</span>
                        @else
                            <span class="badge bg-soft-danger text-danger fw-bold">Kavling Terkunci</span>
                        @endif
                    </div>
                </div>

                <div class="col-lg-5 border-start-lg ps-lg-4">
                    <div class="p-3 rounded-3 border-0 small" style="background: #f8faff; border: 1px solid #eef2f6 !important;">
                        <div class="d-flex justify-content-between align-items-center mb-2 pb-1 border-bottom">
                            <strong class="text-dark">
                                Validasi Syarat Tambah Kavling:
                            </strong>
                            @if($isCanKavling)
                                <span class="badge bg-success text-white rounded-2 px-2 py-1 small">Lolos Validasi</span>
                            @else
                                <span class="badge bg-danger text-white rounded-2 px-2 py-1 small">Belum Lengkap</span>
                            @endif
                        </div>

                        <!-- Rule 1: Validasi Legalitas Tanah -->
                        <div class="d-flex align-items-center justify-content-between py-1">
                            <span class="text-muted">1. Dokumen Legalitas:</span>
                            @if($isLegalValid)
                                <span class="badge bg-soft-success text-success fw-bold rounded-2">
                                    Terverifikasi (Valid)
                                </span>
                            @elseif($land->legal_status === 'rejected')
                                <a href="javascript:void(0)" onclick="openLegalitasModal()" class="badge bg-soft-danger text-danger fw-bold rounded-2 text-decoration-none">
                                    Ditolak / Revisi
                                </a>
                            @else
                                <a href="javascript:void(0)" onclick="openLegalitasModal()" class="badge bg-soft-warning text-warning fw-bold rounded-2 text-decoration-none">
                                    Pending (Validasi)
                                </a>
                            @endif
                        </div>

                        <!-- Rule 2: Pengolahan Lahan Selesai -->
                        <div class="d-flex align-items-center justify-content-between py-1">
                            <span class="text-muted">2. Fisik Pengolahan:</span>
                            @if($isDevSelesai)
                                <span class="badge bg-soft-success text-success fw-bold rounded-2">
                                    100% Selesai
                                </span>
                            @else
                                <span class="badge bg-soft-secondary text-muted rounded-2">
                                    {{ $progress }}% / 100%
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- STATISTIC CARDS (PERSIS DASHBOARD STYLE & INTERACTIVE PHASE TAB TRIGGERS) -->
    <div class="row g-3 mb-4" id="faseStepper" role="tablist">
        <!-- Card 1: Fase 1 -->
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="card shadow-sm border-0 h-100 phase-stat-card active" id="step-fase1-tab" data-bs-toggle="pill" data-bs-target="#step-fase1" role="tab">
                <div class="card-body d-flex justify-content-between align-items-center p-3">
                    <div>
                        <div class="d-flex align-items-center gap-2 mb-1">
                            <h4 class="text-dark mb-0 fw-bold">{{ $fase1Progress }}%</h4>
                            @if($fase1Progress >= 100)
                                <span class="badge bg-success text-white rounded-2" style="font-size: 0.7rem;">Selesai</span>
                            @elseif($fase1Progress > 0)
                                <span class="badge bg-warning text-dark rounded-2" style="font-size: 0.7rem;">Proses</span>
                            @else
                                <span class="badge bg-secondary text-white rounded-2" style="font-size: 0.7rem;">Belum</span>
                            @endif
                        </div>
                        <p class="text-muted mb-0 fw-semibold" style="font-size: 0.85rem;">Fase 1: Pematangan Lahan</p>
                    </div>
                    <div class="d-none d-sm-block">
                        <i class="mdi mdi-layers-triple" style="font-size: 2.2rem; color: #9a55ff; opacity: 0.25;"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card 2: Fase 2 -->
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="card shadow-sm border-0 h-100 phase-stat-card" id="step-fase2-tab" data-bs-toggle="pill" data-bs-target="#step-fase2" role="tab">
                <div class="card-body d-flex justify-content-between align-items-center p-3">
                    <div>
                        <div class="d-flex align-items-center gap-2 mb-1">
                            <h4 class="text-dark mb-0 fw-bold">{{ $fase2Progress }}%</h4>
                            @if($fase2Progress >= 100)
                                <span class="badge bg-success text-white rounded-2" style="font-size: 0.7rem;">Selesai</span>
                            @elseif($fase2Progress > 0)
                                <span class="badge bg-warning text-dark rounded-2" style="font-size: 0.7rem;">Proses</span>
                            @else
                                <span class="badge bg-secondary text-white rounded-2" style="font-size: 0.7rem;">Belum</span>
                            @endif
                        </div>
                        <p class="text-muted mb-0 fw-semibold" style="font-size: 0.85rem;">Fase 2: Drainase & Jalan</p>
                    </div>
                    <div class="d-none d-sm-block">
                        <i class="mdi mdi-road-variant" style="font-size: 2.2rem; color: #0d6efd; opacity: 0.25;"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card 3: Fase 3 -->
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="card shadow-sm border-0 h-100 phase-stat-card" id="step-fase3-tab" data-bs-toggle="pill" data-bs-target="#step-fase3" role="tab">
                <div class="card-body d-flex justify-content-between align-items-center p-3">
                    <div>
                        <div class="d-flex align-items-center gap-2 mb-1">
                            <h4 class="text-dark mb-0 fw-bold">{{ $fase3Progress }}%</h4>
                            @if($fase3Progress >= 100)
                                <span class="badge bg-success text-white rounded-2" style="font-size: 0.7rem;">Selesai</span>
                            @elseif($fase3Progress > 0)
                                <span class="badge bg-warning text-dark rounded-2" style="font-size: 0.7rem;">Proses</span>
                            @else
                                <span class="badge bg-secondary text-white rounded-2" style="font-size: 0.7rem;">Belum</span>
                            @endif
                        </div>
                        <p class="text-muted mb-0 fw-semibold" style="font-size: 0.85rem;">Fase 3: Utilitas & Fasilitas</p>
                    </div>
                    <div class="d-none d-sm-block">
                        <i class="mdi mdi-lightbulb-on-outline" style="font-size: 2.2rem; color: #ffc107; opacity: 0.35;"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card 4: Rekapitulasi Keuangan -->
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="card shadow-sm border-0 h-100 phase-stat-card" id="step-keuangan-tab" data-bs-toggle="pill" data-bs-target="#step-keuangan" role="tab">
                <div class="card-body d-flex justify-content-between align-items-center p-3">
                    <div>
                        <h4 class="text-danger mb-1 fw-bold" style="font-size: 1.05rem;">Rp {{ number_format($totalExpense, 0, ',', '.') }}</h4>
                        <p class="text-muted mb-0 fw-semibold" style="font-size: 0.85rem;">Total Belanja ({{ $expenses->count() }} Nota)</p>
                    </div>
                    <div class="d-none d-sm-block">
                        <i class="mdi mdi-cash-multiple" style="font-size: 2.2rem; color: #dc3545; opacity: 0.25;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- TAB CONTENT SECTIONS -->
    <div class="tab-content" id="faseStepperContent">
        
        <!-- =================== STEP 1: FASE 1 CONTENT =================== -->
        <div class="tab-pane fade show active" id="step-fase1" role="tabpanel">
            <div class="card border-0 shadow-sm rounded-3 bg-white p-3 p-md-4 mb-4">
                <!-- Fase Header Info -->
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 pb-3 mb-4 border-bottom">
                    <div>
                        <div class="d-flex align-items-center gap-2">
                            <span class="badge bg-gradient-primary text-white px-3 py-2 rounded-2 fw-bold">FASE 1</span>
                            <h5 class="fw-bold text-dark mb-0">Pematangan Lahan & Cut-Fill</h5>
                        </div>
                        <span class="small text-muted mt-1 d-block">
                            Tahap awal pembersihan lahan, perataan kontur lahan (Cut & Fill), dan pemadatan tanah.
                        </span>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="button" class="btn btn-sm btn-primary text-white rounded-2 px-3 shadow-sm fw-semibold" onclick="toggleInlineAddExpense(1)">
                            + Catat Belanja Bahan Fase 1
                        </button>
                        <button type="button" class="btn btn-sm btn-success rounded-2 px-3 shadow-sm fw-semibold" onclick="finalizePhaseAction(1)">
                            Selesaikan Fase 1 (100%)
                        </button>
                    </div>
                </div>

                <!-- Inline Form Tambah Pengeluaran Bahan Fase 1 (Collapsible) -->
                @include('properti.partials.inline_expense_form', ['phase' => 1, 'infrastructures' => $fase1Items])

                <!-- Tasks Grid Fase 1 -->
                <h6 class="fw-bold text-dark mb-3">Pos Pekerjaan Fisik Fase 1</h6>
                <div class="row g-3 g-md-4 mb-4">
                    @foreach($fase1Items as $item)
                        @include('properti.partials.phase_item_card', ['item' => $item])
                    @endforeach
                </div>

                <!-- Expenses Table Fase 1 -->
                @php $fase1Expenses = $expenses->where('phase', 1); @endphp
                <div class="mt-4 pt-3 border-top">
                    <h6 class="fw-bold text-dark mb-3 d-flex justify-content-between align-items-center">
                        <span>Riwayat Belanja Bahan / Nota Fase 1</span>
                        <span class="badge bg-soft-danger text-danger">Total: Rp {{ number_format($fase1Expenses->sum('total_amount'), 0, ',', '.') }}</span>
                    </h6>
                    @include('properti.partials.phase_expense_table', ['phase' => 1, 'phaseExpenses' => $fase1Expenses])
                </div>

                <!-- Next Phase Navigation Footer -->
                <div class="d-flex justify-content-end gap-2 pt-4 border-top mt-4">
                    <button type="button" class="btn btn-primary px-4 rounded-2 shadow-sm" onclick="$('#step-fase2-tab').tab('show');">
                        Lanjut ke Fase 2 (Drainase & Jalan) &rarr;
                    </button>
                </div>
            </div>
        </div>

        <!-- =================== STEP 2: FASE 2 CONTENT =================== -->
        <div class="tab-pane fade" id="step-fase2" role="tabpanel">
            <div class="card border-0 shadow-sm rounded-3 bg-white p-3 p-md-4 mb-4">
                <!-- Fase Header Info -->
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 pb-3 mb-4 border-bottom">
                    <div>
                        <div class="d-flex align-items-center gap-2">
                            <span class="badge bg-gradient-primary text-white px-3 py-2 rounded-2 fw-bold">FASE 2</span>
                            <h5 class="fw-bold text-dark mb-0">Drainase & Akses Jalan Kawasan</h5>
                        </div>
                        <span class="small text-muted mt-1 d-block">
                            Tahap pembangunan saluran drainase selokan (U-Ditch) dan pengerasan jalan utama/lingkungan paving/aspal.
                        </span>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="button" class="btn btn-sm btn-primary text-white rounded-2 px-3 shadow-sm fw-semibold" onclick="toggleInlineAddExpense(2)">
                            + Catat Belanja Bahan Fase 2
                        </button>
                        <button type="button" class="btn btn-sm btn-success rounded-2 px-3 shadow-sm fw-semibold" onclick="finalizePhaseAction(2)">
                            Selesaikan Fase 2 (100%)
                        </button>
                    </div>
                </div>

                <!-- Inline Form Tambah Pengeluaran Bahan Fase 2 -->
                @include('properti.partials.inline_expense_form', ['phase' => 2, 'infrastructures' => $fase2Items])

                <!-- Tasks Grid Fase 2 -->
                <h6 class="fw-bold text-dark mb-3">Pos Pekerjaan Fisik Fase 2</h6>
                <div class="row g-3 g-md-4 mb-4">
                    @foreach($fase2Items as $item)
                        @include('properti.partials.phase_item_card', ['item' => $item])
                    @endforeach
                </div>

                <!-- Expenses Table Fase 2 -->
                @php $fase2Expenses = $expenses->where('phase', 2); @endphp
                <div class="mt-4 pt-3 border-top">
                    <h6 class="fw-bold text-dark mb-3 d-flex justify-content-between align-items-center">
                        <span>Riwayat Belanja Bahan / Nota Fase 2</span>
                        <span class="badge bg-soft-danger text-danger">Total: Rp {{ number_format($fase2Expenses->sum('total_amount'), 0, ',', '.') }}</span>
                    </h6>
                    @include('properti.partials.phase_expense_table', ['phase' => 2, 'phaseExpenses' => $fase2Expenses])
                </div>

                <!-- Navigation Buttons -->
                <div class="d-flex justify-content-between gap-2 pt-4 border-top mt-4">
                    <button type="button" class="btn btn-outline-secondary px-4 rounded-2" onclick="$('#step-fase1-tab').tab('show');">
                        &larr; Kembali ke Fase 1
                    </button>
                    <button type="button" class="btn btn-primary px-4 rounded-2 shadow-sm" onclick="$('#step-fase3-tab').tab('show');">
                        Lanjut ke Fase 3 (Utilitas & PJU) &rarr;
                    </button>
                </div>
            </div>
        </div>

        <!-- =================== STEP 3: FASE 3 CONTENT =================== -->
        <div class="tab-pane fade" id="step-fase3" role="tabpanel">
            <div class="card border-0 shadow-sm rounded-3 bg-white p-3 p-md-4 mb-4">
                <!-- Fase Header Info -->
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 pb-3 mb-4 border-bottom">
                    <div>
                        <div class="d-flex align-items-center gap-2">
                            <span class="badge bg-gradient-primary text-white px-3 py-2 rounded-2 fw-bold">FASE 3</span>
                            <h5 class="fw-bold text-dark mb-0">Utilitas Kawasan (PJU, Air Bersih, Listrik & Gerbang)</h5>
                        </div>
                        <span class="small text-muted mt-1 d-block">
                            Tahap akhir instalasi tiang & lampu PJU, pipa distribusi air, gardu listrik PLN, dan gapura/pos kawasan.
                        </span>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="button" class="btn btn-sm btn-primary text-white rounded-2 px-3 shadow-sm fw-semibold" onclick="toggleInlineAddExpense(3)">
                            + Catat Belanja Bahan Fase 3
                        </button>
                        <button type="button" class="btn btn-sm btn-success rounded-2 px-3 shadow-sm fw-semibold" onclick="finalizePhaseAction(3)">
                            Selesaikan Fase 3 & Finalisasi Lahan (100%)
                        </button>
                    </div>
                </div>

                <!-- Inline Form Tambah Pengeluaran Bahan Fase 3 -->
                @include('properti.partials.inline_expense_form', ['phase' => 3, 'infrastructures' => $fase3Items])

                <!-- Tasks Grid Fase 3 -->
                <h6 class="fw-bold text-dark mb-3">Pos Pekerjaan Fisik Fase 3</h6>
                <div class="row g-3 g-md-4 mb-4">
                    @foreach($fase3Items as $item)
                        @include('properti.partials.phase_item_card', ['item' => $item])
                    @endforeach
                </div>

                <!-- Expenses Table Fase 3 -->
                @php $fase3Expenses = $expenses->where('phase', 3); @endphp
                <div class="mt-4 pt-3 border-top">
                    <h6 class="fw-bold text-dark mb-3 d-flex justify-content-between align-items-center">
                        <span>Riwayat Belanja Bahan / Nota Fase 3</span>
                        <span class="badge bg-soft-danger text-danger">Total: Rp {{ number_format($fase3Expenses->sum('total_amount'), 0, ',', '.') }}</span>
                    </h6>
                    @include('properti.partials.phase_expense_table', ['phase' => 3, 'phaseExpenses' => $fase3Expenses])
                </div>

                <!-- Navigation Buttons -->
                <div class="d-flex justify-content-between gap-2 pt-4 border-top mt-4">
                    <button type="button" class="btn btn-outline-secondary px-4 rounded-2" onclick="$('#step-fase2-tab').tab('show');">
                        &larr; Kembali ke Fase 2
                    </button>
                    @if($land->canCreateKavling())
                        <a href="{{ route('properti.buatKavling', $land->id) }}" class="btn btn-gradient-success px-4 rounded-2 shadow-sm">
                            PENGOLAHAN SELESAI &rarr; Buat Unit Kavling
                        </a>
                    @else
                        <button type="button" class="btn btn-gradient-success px-4 rounded-2 shadow-sm" onclick="finalizeAllInfrastruktur()">
                            Selesaikan Seluruh Pengolahan Lahan (100%)
                        </button>
                    @endif
                </div>
            </div>
        </div>

        <!-- =================== STEP 4: REKAP KEUANGAN ERP CONTENT =================== -->
        <div class="tab-pane fade" id="step-keuangan" role="tabpanel">
            <div class="card border-0 shadow-sm rounded-3 bg-white p-3 p-md-4 mb-4">
                <!-- Financial Cards Summary -->
                <div class="row g-3 mb-4">
                    <div class="col-6 col-md-3">
                        <div class="p-3 rounded-3 bg-light border">
                            <span class="text-muted small fw-bold">Total Belanja Realisasi</span>
                            <h4 class="fw-bold text-danger mb-0 mt-1">Rp {{ number_format($totalExpense, 0, ',', '.') }}</h4>
                            <span class="small text-muted">{{ $expenses->count() }} total transaksi</span>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="p-3 rounded-3 bg-light border">
                            <span class="text-muted small fw-bold">Lunas Terbayar</span>
                            <h4 class="fw-bold text-success mb-0 mt-1">Rp {{ number_format($totalLunas, 0, ',', '.') }}</h4>
                            <span class="small text-muted">{{ $expenses->where('payment_status', 'Lunas')->count() }} transaksi lunas</span>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="p-3 rounded-3 bg-light border">
                            <span class="text-muted small fw-bold">Hutang / Tempo Vendor</span>
                            <h4 class="fw-bold text-warning mb-0 mt-1">Rp {{ number_format($totalHutang, 0, ',', '.') }}</h4>
                            <span class="small text-muted">{{ $expenses->where('payment_status', '!=', 'Lunas')->count() }} belum lunas</span>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="p-3 rounded-3 bg-light border">
                            <span class="text-muted small fw-bold">Rincian per Fase</span>
                            <div class="small mt-1">
                                <div>Fase 1: <b>Rp {{ number_format($expenses->where('phase', 1)->sum('total_amount'), 0, ',', '.') }}</b></div>
                                <div>Fase 2: <b>Rp {{ number_format($expenses->where('phase', 2)->sum('total_amount'), 0, ',', '.') }}</b></div>
                                <div>Fase 3: <b>Rp {{ number_format($expenses->where('phase', 3)->sum('total_amount'), 0, ',', '.') }}</b></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Grand Total Expenses Table -->
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="fw-bold text-dark mb-0">Seluruh Rekapitulasi Pengeluaran Bahan & Jasa</h5>
                </div>
                <div class="table-responsive bg-white rounded-3 border">
                    <table class="table table-elevated table-hover align-middle mb-0">
                        <thead>
                            <tr>
                                <th class="ps-3">KODE / TANGGAL</th>
                                <th>FASE</th>
                                <th>NAMA BAHAN / JASA</th>
                                <th>POS INFRASTRUKTUR</th>
                                <th>QTY & SATUAN</th>
                                <th>HARGA SATUAN</th>
                                <th>TOTAL BIAYA</th>
                                <th>VENDOR / TOKO</th>
                                <th>STATUS</th>
                                <th>NOTA</th>
                                <th class="text-center pe-3">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($expenses as $exp)
                                <tr>
                                    <td class="ps-3">
                                        <code class="text-primary fw-bold">{{ $exp->expense_code ?? '-' }}</code>
                                        <span class="small text-muted d-block">{{ $exp->expense_date ? $exp->expense_date->format('d M Y') : '-' }}</span>
                                    </td>
                                    <td>
                                        <span class="badge bg-gradient-primary text-white rounded-2 small">Fase {{ $exp->phase ?? 1 }}</span>
                                    </td>
                                    <td>
                                        <strong class="text-dark d-block">{{ $exp->item_name }}</strong>
                                        @if($exp->category)
                                            <span class="badge bg-soft-primary text-primary small py-0 px-2 rounded-2">{{ $exp->category }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($exp->infrastructure)
                                            <span class="badge bg-light text-dark border">{{ $exp->infrastructure->item_name }}</span>
                                        @else
                                            <span class="text-muted small">- Umum -</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="fw-bold">{{ number_format($exp->quantity, 0, ',', '.') }}</span>
                                        <span class="text-muted small">{{ $exp->unit }}</span>
                                    </td>
                                    <td>
                                        Rp {{ number_format($exp->unit_price, 0, ',', '.') }}
                                    </td>
                                    <td>
                                        <strong class="text-danger fs-6">
                                            Rp {{ number_format($exp->total_amount, 0, ',', '.') }}
                                        </strong>
                                    </td>
                                    <td>
                                        <span class="small text-dark fw-bold">{{ $exp->vendor_name ?? '-' }}</span>
                                        <small class="text-muted d-block">{{ $exp->payment_method }}</small>
                                    </td>
                                    <td>
                                        @if($exp->payment_status === 'Lunas')
                                            <span class="badge bg-soft-success text-success rounded-2 px-2 py-1 small fw-bold">Lunas</span>
                                        @else
                                            <span class="badge bg-soft-warning text-warning rounded-2 px-2 py-1 small fw-bold">Belum Lunas</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($exp->receipt_proof)
                                            <a href="{{ asset('storage/' . $exp->receipt_proof) }}" target="_blank" class="btn btn-sm btn-outline-info p-1 px-2 rounded-2">
                                                Nota
                                            </a>
                                        @else
                                            <span class="text-muted small">-</span>
                                        @endif
                                    </td>
                                    <td class="text-center pe-3">
                                        <button type="button" class="btn btn-sm btn-outline-danger p-1 px-2 rounded-2" onclick="deleteExpense({{ $exp->id }})" title="Hapus">
                                            <i class="mdi mdi-delete"></i>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="11" class="text-center py-4 text-muted">
                                        <p class="mb-0">Belum ada pengeluaran bahan tercatat.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    <!-- Modal Edit Target Volume & Bobot Pos Pekerjaan -->
    <div class="modal fade" id="modalEditTarget" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-3 border-0 shadow">
                <div class="modal-header border-bottom-0 pb-0">
                    <h5 class="modal-title fw-bold text-dark">
                        Sesuaikan Target & Bobot Pos
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formEditTarget" onsubmit="submitEditTarget(event)">
                    @csrf
                    <input type="hidden" id="editTargetItemId" name="item_id">
                    <div class="modal-body pt-2">
                        <div class="p-3 bg-light rounded-3 mb-3 border">
                            <label class="small text-muted fw-bold d-block mb-1">Pos Pekerjaan:</label>
                            <h6 class="fw-bold text-primary mb-0" id="editTargetItemName">-</h6>
                        </div>
                        <div class="row g-3">
                            <div class="col-7">
                                <label class="small text-muted fw-bold mb-1">Target Volume <span class="text-danger">*</span></label>
                                <input type="number" step="any" class="form-control" id="editTargetVolInput" name="target_volume" required min="0.01">
                            </div>
                            <div class="col-5">
                                <label class="small text-muted fw-bold mb-1">Satuan <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="editTargetUnitInput" name="volume_unit" placeholder="m³, meter, m², titik" required>
                            </div>
                            <div class="col-6">
                                <label class="small text-muted fw-bold mb-1">Bobot Pekerjaan (%) <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="number" step="any" class="form-control" id="editTargetBobotInput" name="bobot_persen" required min="0" max="100">
                                    <span class="input-group-text">%</span>
                                </div>
                            </div>
                            <div class="col-6">
                                <label class="small text-muted fw-bold mb-1">Estimasi Biaya / RAB (Rp)</label>
                                <input type="number" step="any" class="form-control" id="editTargetCostInput" name="cost_estimate" placeholder="0">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-top-0 pt-0">
                        <button type="button" class="btn btn-secondary rounded-2 px-3" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-gradient-primary rounded-2 px-4" id="btnSaveTarget">
                            Simpan Perubahan Target
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Validasi Legalitas Tanah -->
    <div class="modal fade" id="modalValidasiLegalitas" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-3 border-0 shadow">
                <div class="modal-header border-bottom-0 pb-0">
                    <h5 class="modal-title fw-bold text-dark">
                        Validasi Dokumen Legalitas Tanah
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formValidasiLegalitas" onsubmit="submitUpdateLegalitas(event)">
                    @csrf
                    <div class="modal-body pt-2">
                        <div class="p-3 bg-light rounded-3 mb-3 border">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <label class="small text-muted fw-bold d-block mb-0">Nama Properti Lahan:</label>
                                    <h6 class="fw-bold text-primary mb-0">{{ $land->name }}</h6>
                                </div>
                                <span class="badge bg-white text-dark border px-2 py-1 small">
                                    {{ $land->ownership_status ?? 'SHM' }} ({{ number_format($land->area, 0, ',', '.') }} m²)
                                </span>
                            </div>
                        </div>

                        <!-- Ringkasan Kelengkapan Berkas Dokumen -->
                        <label class="small text-muted fw-bold mb-1 d-block">Berkas Dokumen Terlampir:</label>
                        <div class="p-2 px-3 bg-white rounded-3 border mb-3 small">
                            <div class="d-flex justify-content-between py-1 border-bottom">
                                <span class="text-muted">No. Sertifikat:</span>
                                <strong class="text-dark">{{ $land->ceritificate_no ?? '-' }}</strong>
                            </div>
                            <div class="d-flex justify-content-between py-1 border-bottom">
                                <span class="text-muted">Pemilik Sertifikat:</span>
                                <strong class="text-dark">{{ $land->certificate_owner ?? '-' }}</strong>
                            </div>
                            <div class="d-flex justify-content-between py-1 border-bottom">
                                <span class="text-muted">No. IMB / PBG:</span>
                                <strong class="text-dark">{{ $land->imb_no ?? '-' }}</strong>
                            </div>
                            <div class="d-flex justify-content-between py-1">
                                <span class="text-muted">No. PBB:</span>
                                <strong class="text-dark">{{ $land->pbb_no ?? '-' }}</strong>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="small text-muted fw-bold mb-1">Status Validasi Legalitas <span class="text-danger">*</span></label>
                            <select class="form-select" name="legal_status" id="selectLegalStatus" required>
                                <option value="verified" {{ $land->legal_status === 'verified' ? 'selected' : '' }}>Terverifikasi (Sah & Lolos Validasi)</option>
                                <option value="pending" {{ $land->legal_status === 'pending' ? 'selected' : '' }}>Pending (Menunggu Kelengkapan Berkas)</option>
                                <option value="rejected" {{ $land->legal_status === 'rejected' ? 'selected' : '' }}>Ditolak / Perlu Revisi Dokumen</option>
                            </select>
                        </div>

                        <div class="mb-2">
                            <label class="small text-muted fw-bold mb-1">Catatan Verifikator Legalitas</label>
                            <textarea class="form-control" name="admin_notes" id="textareaLegalNotes" rows="3" placeholder="Catatan keabsahan sertifikat, perizinan, atau instruksi revisi...">{{ $land->description ?? '' }}</textarea>
                        </div>
                    </div>
                    <div class="modal-footer border-top-0 pt-0">
                        <button type="button" class="btn btn-secondary rounded-2 px-3" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-gradient-primary rounded-2 px-4" id="btnSaveLegalitas">
                            Simpan Status Validasi Legalitas
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    const currentLandId = {{ $land->id }};
    const storageKey = 'active_phase_tab_' + currentLandId;

    // TAB PERSISTENCE ENGINE (Kompatibel Bootstrap 4 & 5)
    function activateTab(tabIdOrSelector) {
        if (!tabIdOrSelector) return;
        let selector = tabIdOrSelector;
        if (!selector.startsWith('#')) selector = '#' + selector;
        if (!selector.endsWith('-tab') && !selector.includes('keuangan')) selector = selector + '-tab';
        
        let $tab = $(selector);
        if ($tab.length && typeof $tab.tab === 'function') {
            $tab.tab('show');
        }
    }

    function setSavedActiveTab(tabSelector) {
        if (tabSelector) {
            sessionStorage.setItem(storageKey, tabSelector);
            localStorage.setItem(storageKey, tabSelector);
            if (window.history && window.history.replaceState) {
                let cleanHash = tabSelector.replace('-tab', '');
                window.history.replaceState(null, null, cleanHash);
            }
        }
    }

    // Export functions globally so inline HTML onclick/oninput never fail
    window.selectCardForExpense = function(phase, itemId, itemName) {
        // 1. Highlight selected card
        $(`.task-card-item-${phase}`).removeClass('task-card-active');
        $(`#cardBox_${itemId}`).addClass('task-card-active');

        // 2. Open inline expense form and bind to this item
        let formBox = $(`#inlineExpenseForm_Phase${phase}`);
        if (formBox.length) {
            formBox.removeClass('d-none');
            $(`#selectedInfraId_${phase}`).val(itemId);
            $(`#selectedPosName_${phase}`).text(itemName);

            // 3. Filter Table below for this specific pos
            filterTableByPos(phase, itemId, itemName);

            // 4. Smooth scroll to form area
            try {
                let offset = formBox.offset();
                if (offset && offset.top) {
                    $('html, body').stop().animate({
                        scrollTop: offset.top - 80
                    }, 400);
                }
            } catch(e) {
                console.warn('Scroll error:', e);
            }
        }
    };

    window.resetSelectedPos = function(phase) {
        $(`#selectedInfraId_${phase}`).val('');
        $(`#selectedPosName_${phase}`).text(`- Seluruh Pos Fase ${phase} (Umum) -`);
        $(`.task-card-item-${phase}`).removeClass('task-card-active');
        clearTableFilter(phase);
    };

    window.filterTableByPos = function(phase, itemId, itemName) {
        $(`#tableFilterBanner_${phase}`).removeClass('d-none');
        $(`#filterPosName_${phase}`).text(itemName);

        let rows = $(`.expense-row-phase-${phase}`);
        let matchCount = 0;
        rows.each(function() {
            let rowInfraId = $(this).attr('data-infra-id');
            if (rowInfraId == itemId) {
                $(this).removeClass('d-none');
                matchCount++;
            } else {
                $(this).addClass('d-none');
            }
        });

        if (matchCount === 0) {
            $(`#emptyFilterRow_${phase}`).removeClass('d-none');
        } else {
            $(`#emptyFilterRow_${phase}`).addClass('d-none');
        }
    };

    window.clearTableFilter = function(phase) {
        $(`#tableFilterBanner_${phase}`).addClass('d-none');
        $(`.expense-row-phase-${phase}`).removeClass('d-none');
        $(`#emptyFilterRow_${phase}`).addClass('d-none');
        $(`.task-card-item-${phase}`).removeClass('task-card-active');
        $(`#selectedInfraId_${phase}`).val('');
        $(`#selectedPosName_${phase}`).text(`- Seluruh Pos Fase ${phase} (Umum) -`);
    };

    window.toggleInlineAddExpense = function(phase) {
        let formBox = $(`#inlineExpenseForm_Phase${phase}`);
        formBox.toggleClass('d-none');
    };

    window.calculateVolumePercentage = function(itemId) {
        if (!itemId) return;
        let targetEl = $(`#targetVol_${itemId}`);
        let realizedEl = $(`#realizedVolInput_${itemId}`);

        let target = parseFloat(targetEl.val());
        if (isNaN(target) || target <= 0) target = 1;

        let rawRealized = realizedEl.val();
        let realized = parseFloat(rawRealized);
        if (isNaN(realized) || realized < 0) realized = 0;

        let pct = Math.round(Math.min(100, (realized / target) * 100) * 10) / 10;
        if (isNaN(pct)) pct = 0;

        $(`#progressPercentDisplay_${itemId}`).text(pct + '%');
        $(`#progressBarDisplay_${itemId}`).css('width', pct + '%');

        let statusHidden = $(`#statusHidden_${itemId}`);
        let statusBadgeDisplay = $(`#statusBadgeDisplay_${itemId}`);
        let badgeHeaderEl = $(`#badgeStatus_${itemId}`);
        let barEl = $(`#progressBarDisplay_${itemId}`);

        if (pct >= 100 || realized >= target) {
            if (statusHidden.length) statusHidden.val('selesai');
            if (statusBadgeDisplay.length) {
                statusBadgeDisplay.html('<span class="badge bg-success text-white px-2 py-1 rounded-pill small fw-bold"><i class="mdi mdi-check-circle me-1"></i>Selesai (100%)</span>');
            }
            if (badgeHeaderEl.length) {
                badgeHeaderEl.attr('class', 'badge bg-success text-white px-2 py-1 rounded-pill small fw-bold').html('<i class="mdi mdi-check-circle me-1"></i>Selesai (100%)');
            }
            if (barEl.length) {
                barEl.attr('class', 'progress-bar progress-bar-striped bg-success');
            }
        } else if (pct > 0 || realized > 0) {
            if (statusHidden.length) statusHidden.val('proses');
            if (statusBadgeDisplay.length) {
                statusBadgeDisplay.html('<span class="badge bg-warning text-dark px-2 py-1 rounded-pill small fw-bold"><i class="mdi mdi-progress-wrench me-1"></i>Dalam Proses</span>');
            }
            if (badgeHeaderEl.length) {
                badgeHeaderEl.attr('class', 'badge bg-warning text-dark px-2 py-1 rounded-pill small fw-bold').html(`<i class="mdi mdi-progress-wrench me-1"></i>Proses (${pct}%)`);
            }
            if (barEl.length) {
                barEl.attr('class', 'progress-bar progress-bar-striped bg-primary');
            }
        } else {
            if (statusHidden.length) statusHidden.val('belum_mulai');
            if (statusBadgeDisplay.length) {
                statusBadgeDisplay.html('<span class="badge bg-secondary text-white px-2 py-1 rounded-pill small"><i class="mdi mdi-clock-outline me-1"></i>Belum Mulai</span>');
            }
            if (badgeHeaderEl.length) {
                badgeHeaderEl.attr('class', 'badge bg-secondary text-white px-2 py-1 rounded-pill small').html('<i class="mdi mdi-clock-outline me-1"></i>Belum Mulai');
            }
            if (barEl.length) {
                barEl.attr('class', 'progress-bar progress-bar-striped bg-primary');
            }
        }
    };

    window.saveRealProgress = function(event, itemId, phase) {
        event.preventDefault();
        let form = document.getElementById(`formInfraItem_${itemId}`);
        let formData = new FormData(form);
        formData.append('_token', '{{ csrf_token() }}');

        let targetPhase = phase || $(form).data('phase') || $(form).find('input[name="phase"]').val() || 1;
        setSavedActiveTab('#step-fase' + targetPhase + '-tab');

        let submitBtn = $(`#btnSubmit_${itemId}`);
        submitBtn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-1"></span>Menyimpan...');

        $.ajax({
            url: `/properti/infrastruktur/${itemId}/update`,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function(res) {
                submitBtn.prop('disabled', false).html('<i class="mdi mdi-check-circle-outline me-1"></i>Simpan Realisasi Progres');
                if (res.success) {
                    if (res.item && res.item.phase) {
                        setSavedActiveTab('#step-fase' + res.item.phase + '-tab');
                    }
                    Swal.fire({
                        icon: 'success',
                        title: 'Progres Tersimpan!',
                        text: res.message,
                        timer: 1500,
                        showConfirmButton: false
                    }).then(() => {
                        window.location.reload();
                    });
                }
            },
            error: function(xhr) {
                submitBtn.prop('disabled', false).html('<i class="mdi mdi-check-circle-outline me-1"></i>Simpan Realisasi Progres');
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: 'Gagal memperbarui progres pekerjaan'
                });
            }
        });
    };

    window.openLegalitasModal = function() {
        $('#modalValidasiLegalitas').modal('show');
    };

    window.submitUpdateLegalitas = function(event) {
        event.preventDefault();
        let submitBtn = $('#btnSaveLegalitas');
        submitBtn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-1"></span>Menyimpan...');

        $.ajax({
            url: `/properti/${currentLandId}/update-legal-status`,
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                legal_status: $('#selectLegalStatus').val(),
                admin_notes: $('#textareaLegalNotes').val()
            },
            dataType: 'json',
            success: function(res) {
                submitBtn.prop('disabled', false).html('<i class="mdi mdi-check me-1"></i>Simpan Status Validasi Legalitas');
                if (res.success) {
                    $('#modalValidasiLegalitas').modal('hide');
                    Swal.fire({
                        icon: 'success',
                        title: 'Validasi Tersimpan!',
                        text: res.message,
                        timer: 1500,
                        showConfirmButton: false
                    }).then(() => {
                        window.location.reload();
                    });
                }
            },
            error: function(xhr) {
                submitBtn.prop('disabled', false).html('<i class="mdi mdi-check me-1"></i>Simpan Status Validasi Legalitas');
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: 'Gagal memperbarui status validasi legalitas.'
                });
            }
        });
    };

    window.showKavlingLockedInfo = function() {
        let isLegal = {{ ($land->legal_status === 'verified' || $land->isFromPraLandbank()) ? 'true' : 'false' }};
        let isDev = {{ (in_array(strtolower($land->development_status), ['selesai', 'done']) || $land->overall_infrastructure_progress >= 100) ? 'true' : 'false' }};

        let msg = '';
        if (!isLegal && !isDev) {
            msg = 'Untuk membuka fitur Tambah Kavling, kedua syarat berikut harus dipenuhi:\n1. Dokumen Legalitas Tanah harus TERVERIFIKASI.\n2. Seluruh Fase Pengolahan Lahan harus 100% SELESAI.';
        } else if (!isLegal) {
            msg = 'Pengolahan lahan telah selesai, namun status Legalitas Tanah masih belum Terverifikasi. Silakan lakukan validasi berkas legalitas terlebih dahulu.';
        } else if (!isDev) {
            msg = 'Legalitas tanah sudah terverifikasi, namun Pengolahan Lahan masih belum 100% selesai. Selesaikan Fase 1, 2, dan 3 terlebih dahulu.';
        }

        Swal.fire({
            title: 'Syarat Tambah Kavling Terkunci',
            text: msg,
            icon: 'warning',
            confirmButtonColor: '#9a55ff',
            confirmButtonText: 'Mengerti'
        });
    };

    window.openEditTargetModal = function(itemId, itemName, targetVol, unit, bobot, cost) {
        $('#editTargetItemId').val(itemId);
        $('#editTargetItemName').text(itemName);
        $('#editTargetVolInput').val(targetVol);
        $('#editTargetUnitInput').val(unit);
        $('#editTargetBobotInput').val(bobot);
        $('#editTargetCostInput').val(cost);
        $('#modalEditTarget').modal('show');
    };

    window.submitEditTarget = function(event) {
        event.preventDefault();
        let itemId = $('#editTargetItemId').val();
        let submitBtn = $('#btnSaveTarget');
        submitBtn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-1"></span>Menyimpan...');

        $.ajax({
            url: `/properti/infrastruktur/${itemId}/update`,
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                target_volume: $('#editTargetVolInput').val(),
                volume_unit: $('#editTargetUnitInput').val(),
                bobot_persen: $('#editTargetBobotInput').val(),
                cost_estimate: $('#editTargetCostInput').val()
            },
            dataType: 'json',
            success: function(res) {
                submitBtn.prop('disabled', false).html('<i class="mdi mdi-check me-1"></i>Simpan Perubahan Target');
                if (res.success) {
                    if (res.item && res.item.phase) {
                        setSavedActiveTab('#step-fase' + res.item.phase + '-tab');
                    }
                    $('#modalEditTarget').modal('hide');
                    Swal.fire({
                        icon: 'success',
                        title: 'Target Diperbarui!',
                        text: res.message,
                        timer: 1500,
                        showConfirmButton: false
                    }).then(() => {
                        window.location.reload();
                    });
                }
            },
            error: function(xhr) {
                submitBtn.prop('disabled', false).html('<i class="mdi mdi-check me-1"></i>Simpan Perubahan Target');
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: 'Gagal memperbarui target volume'
                });
            }
        });
    };

    window.previewCardPhoto = function(input, itemId) {
        if (input.files && input.files[0]) {
            let reader = new FileReader();
            reader.onload = function(e) {
                $(`#imgPreview_${itemId}`).attr('src', e.target.result);
                $(`#previewContainer_${itemId}`).removeClass('d-none');
                $(`#photoInput_${itemId}`).addClass('d-none');
                if ($(`#fileNamePreview_${itemId}`).length) {
                    $(`#fileNamePreview_${itemId}`).text(input.files[0].name);
                }
            };
            reader.readAsDataURL(input.files[0]);
        }
    };

    let rowCounter = { 1: 1, 2: 1, 3: 1 };

    window.onSelectRowMaterial = function(selectEl, phase, rowIdx) {
        let opt = $(selectEl).find(':selected');
        if (opt.val()) {
            $(`#inputMatId_${phase}_${rowIdx}`).val(opt.val());
            $(`#inputItemName_${phase}_${rowIdx}`).val(opt.data('name') || opt.attr('data-name') || '');
            $(`#inputCat_${phase}_${rowIdx}`).val(opt.data('category') || opt.attr('data-category') || '');
            $(`#inputUnit_${phase}_${rowIdx}`).val(opt.data('unit') || opt.attr('data-unit') || '');
            $(`#inputPrice_${phase}_${rowIdx}`).val(opt.data('price') || opt.attr('data-price') || 0);
        } else {
            $(`#inputMatId_${phase}_${rowIdx}`).val('');
        }
        calcMultiRowTotal(phase, rowIdx);
    };

    window.calcMultiRowTotal = function(phase, rowIdx) {
        let qty = parseFloat($(`#inputQty_${phase}_${rowIdx}`).val()) || 0;
        let price = parseFloat($(`#inputPrice_${phase}_${rowIdx}`).val()) || 0;
        let total = qty * price;
        $(`#displayRowSubtotal_${phase}_${rowIdx}`).val('Rp ' + total.toLocaleString('id-ID'));
        recalculateGrandTotal(phase);
    };

    window.recalculateGrandTotal = function(phase) {
        let grandTotal = 0;
        $(`#multiItemBody_${phase} tr`).each(function() {
            let rowIdx = $(this).attr('data-row-idx');
            let qty = parseFloat($(`#inputQty_${phase}_${rowIdx}`).val()) || 0;
            let price = parseFloat($(`#inputPrice_${phase}_${rowIdx}`).val()) || 0;
            grandTotal += (qty * price);
        });
        $(`#grandTotalNotaDisplay_${phase}`).text('Rp ' + grandTotal.toLocaleString('id-ID'));
    };

    window.addNewMaterialRow = function(phase) {
        let newIdx = rowCounter[phase]++;
        let optionsHtml = $(`#masterOptionsTemplate_${phase}`).html();

        let newRow = `
            <tr id="rowItem_${phase}_${newIdx}" data-row-idx="${newIdx}">
                <td>
                    <div class="d-flex flex-column gap-1">
                        <select class="form-select form-select-sm select-master-item-row" onchange="onSelectRowMaterial(this, ${phase}, ${newIdx})">
                            ${optionsHtml}
                        </select>
                        <input type="hidden" name="items[${newIdx}][material_id]" id="inputMatId_${phase}_${newIdx}">
                        <input type="text" name="items[${newIdx}][item_name]" id="inputItemName_${phase}_${newIdx}" class="form-control form-control-sm" placeholder="Nama Bahan / Jasa *" required>
                    </div>
                </td>
                <td>
                    <input type="text" name="items[${newIdx}][category]" id="inputCat_${phase}_${newIdx}" class="form-control form-control-sm" placeholder="Kategori">
                </td>
                <td>
                    <input type="number" step="any" name="items[${newIdx}][quantity]" id="inputQty_${phase}_${newIdx}" class="form-control form-control-sm text-end" value="1" min="0.01" required oninput="calcMultiRowTotal(${phase}, ${newIdx})">
                </td>
                <td>
                    <input type="text" name="items[${newIdx}][unit]" id="inputUnit_${phase}_${newIdx}" class="form-control form-control-sm text-center" placeholder="sak, m3" required>
                </td>
                <td>
                    <input type="number" step="any" name="items[${newIdx}][unit_price]" id="inputPrice_${phase}_${newIdx}" class="form-control form-control-sm text-end" placeholder="0" required oninput="calcMultiRowTotal(${phase}, ${newIdx})">
                </td>
                <td>
                    <input type="text" id="displayRowSubtotal_${phase}_${newIdx}" class="form-control form-control-sm text-end fw-bold text-danger bg-light" value="Rp 0" readonly>
                </td>
                <td class="text-center">
                    <button type="button" class="btn btn-sm btn-link text-danger p-0" onclick="removeMaterialRow(${phase}, ${newIdx})" title="Hapus baris">
                        <i class="mdi mdi-close-circle fs-5"></i>
                    </button>
                </td>
            </tr>
        `;

        $(`#multiItemBody_${phase}`).append(newRow);
    };

    window.removeMaterialRow = function(phase, rowIdx) {
        let totalRows = $(`#multiItemBody_${phase} tr`).length;
        if (totalRows > 1) {
            $(`#rowItem_${phase}_${rowIdx}`).remove();
        } else {
            $(`#inputMatId_${phase}_${rowIdx}`).val('');
            $(`#inputItemName_${phase}_${rowIdx}`).val('');
            $(`#inputCat_${phase}_${rowIdx}`).val('');
            $(`#inputQty_${phase}_${rowIdx}`).val(1);
            $(`#inputUnit_${phase}_${rowIdx}`).val('');
            $(`#inputPrice_${phase}_${rowIdx}`).val(0);
            $(`#displayRowSubtotal_${phase}_${rowIdx}`).val('Rp 0');
        }
        recalculateGrandTotal(phase);
    };

    window.calculateTotalInline = function(phase) {
        let qty = parseFloat($(`#inputQuantity_${phase}`).val()) || 0;
        let price = parseFloat($(`#inputUnitPrice_${phase}`).val()) || 0;
        let total = qty * price;
        $(`#displayTotal_${phase}`).val('Rp ' + total.toLocaleString('id-ID'));
    };

    window.finalizePhaseAction = function(phase) {
        setSavedActiveTab('#step-fase' + phase + '-tab');
        Swal.fire({
            title: `Selesaikan Seluruh Pekerjaan Fase ${phase}?`,
            text: `Seluruh pos pekerjaan pada Fase ${phase} akan ditandai 100% Selesai.`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#28a745',
            cancelButtonColor: '#6c757d',
            confirmButtonText: '<i class="mdi mdi-check-all me-1"></i>Ya, Selesaikan Fase ' + phase,
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `/properti/${currentLandId}/infrastruktur/phase/${phase}/finalize`,
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(res) {
                        if (res.success) {
                            Swal.fire({
                                icon: 'success',
                                title: `Fase ${phase} Selesai!`,
                                text: res.message,
                                confirmButtonColor: '#9a55ff'
                            }).then(() => {
                                window.location.reload();
                            });
                        }
                    }
                });
            }
        });
    };

    window.finalizeAllInfrastruktur = function() {
        Swal.fire({
            title: 'Selesaikan Seluruh Pengolahan Lahan?',
            text: 'Seluruh fase (1, 2, 3) akan ditandai 100% Selesai dan fitur Tambah Kavling untuk proyek ini akan otomatis dibuka.',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#28a745',
            cancelButtonColor: '#6c757d',
            confirmButtonText: '<i class="mdi mdi-check-all me-1"></i>Ya, Selesaikan (100%)',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `/properti/${currentLandId}/infrastruktur/finalize`,
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        development_status: 'Selesai'
                    },
                    dataType: 'json',
                    success: function(res) {
                        if (res.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Status Diperbarui!',
                                text: 'Pembangunan pengolahan lahan berstatus SELESAI. Fitur Tambah Kavling telah dibuka.',
                                confirmButtonColor: '#9a55ff'
                            }).then(() => {
                                window.location.reload();
                            });
                        }
                    }
                });
            }
        });
    };

    window.deleteExpense = function(expenseId) {
        let activeTab = $('.fase-step-btn.active').attr('id');
        if (activeTab) {
            setSavedActiveTab('#' + activeTab);
        }

        Swal.fire({
            title: 'Hapus Pencatatan Biaya?',
            text: 'Data transaksi pengeluaran ini akan dihapus dari laporan keuangan proyek.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `/properti/infrastruktur/expense/${expenseId}`,
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        _method: 'DELETE'
                    },
                    dataType: 'json',
                    success: function(res) {
                        if (res.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Terhapus!',
                                text: res.message,
                                timer: 1500,
                                showConfirmButton: false
                            }).then(() => {
                                window.location.reload();
                            });
                        }
                    }
                });
            }
        });
    };

    $(document).ready(function() {
        // 1. Simpan tab saat user mengklik / mengganti tab
        $('.fase-step-btn').on('shown.bs.tab', function(e) {
            let targetId = $(this).attr('id');
            setSavedActiveTab('#' + targetId);
        });

        // 2. Simpan tab saat submit form belanja bahan
        $('form[id^="multiExpenseForm_"]').on('submit', function() {
            let phase = $(this).find('input[name="phase"]').val() || 1;
            setSavedActiveTab('#step-fase' + phase + '-tab');
        });

        // 3. Event Delegation Realtime untuk input volume capaian progres
        $(document).on('input keyup change paste', 'input[id^="realizedVolInput_"]', function() {
            let id = $(this).attr('id').replace('realizedVolInput_', '');
            window.calculateVolumePercentage(id);
        });

        // 4. Modern File Upload Preview Listener
        $(document).on('change', '.properti-file-upload-modern input[type="file"]', function(e) {
            const file = e.target.files[0];
            const container = $(this).closest('.properti-file-upload-modern');
            const label = container.find('.file-title-text');
            const subText = container.find('.file-sub-text');
            const sizeSpan = container.find('.properti-file-size');
            const typeName = $(this).attr('data-type-name') || 'Berkas';

            if (file) {
                const fileName = file.name;
                const fileSize = file.size;
                label.text(fileName.length > 28 ? fileName.substring(0, 28) + '...' : fileName);
                label.addClass('text-primary fw-bold');
                subText.text('File terpilih siap disimpan');
                if (fileSize) {
                    const sizeInMB = (fileSize / (1024 * 1024)).toFixed(2);
                    sizeSpan.text(sizeInMB + ' MB');
                }
            } else {
                label.text('Upload ' + typeName);
                label.removeClass('text-primary fw-bold');
                subText.text('PDF, JPG, PNG (Max: 2MB)');
                sizeSpan.text('');
            }
        });

        // 5. Cek Prioritas Tab saat Halaman Dimuat:
        const urlParams = new URLSearchParams(window.location.search);
        const queryPhase = urlParams.get('phase') || urlParams.get('fase');
        const hash = window.location.hash;
        const savedTab = sessionStorage.getItem(storageKey) || localStorage.getItem(storageKey);

        if (queryPhase) {
            let targetId = (queryPhase === 'keuangan') ? '#step-keuangan-tab' : '#step-fase' + queryPhase + '-tab';
            activateTab(targetId);
        } else if (hash && (hash.startsWith('#step-fase') || hash.startsWith('#step-keuangan'))) {
            activateTab(hash);
        } else if (savedTab) {
            activateTab(savedTab);
        }
    });

    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: "{{ session('success') }}",
            confirmButtonColor: '#9a55ff'
        });
    @endif
</script>
@endpush
