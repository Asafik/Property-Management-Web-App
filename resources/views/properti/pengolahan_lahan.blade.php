@extends('layouts.partial.app')

@section('title', 'Pengolahan Lahan per Fase - ' . ($land->name ?? 'Proyek') . ' - Property Management App')

@section('content')
<div class="content-wrapper p-3 p-md-4">
    <!-- Select2 Search JS CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" rel="stylesheet" />

    <!-- Custom Scoped Styles for Phased Site Development -->
    <style>
        .page-header-box {
            background: #ffffff;
            border-radius: 12px;
            padding: 1.25rem 1.5rem;
            border: 1px solid rgba(154, 85, 255, 0.12);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);
        }
        .fase-step-card {
            border: 2px solid #e9ecef !important;
            border-radius: 10px !important;
            background: #ffffff;
            transition: all 0.2s ease;
        }
        .fase-step-card:hover {
            border-color: #d1b8ff !important;
            background: #faf5ff;
        }
        .fase-step-card.active {
            border-color: #9a55ff !important;
            background: #ffffff;
            box-shadow: 0 4px 15px rgba(154, 85, 255, 0.15) !important;
        }
        .task-card-phased {
            background: #ffffff;
            border-radius: 10px;
            border: 1px solid #eef2f6;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.02);
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }
        .task-card-phased:hover {
            border-color: #c4b5fd;
            box-shadow: 0 6px 20px rgba(154, 85, 255, 0.07);
        }
        .badge-soft-primary { background: #f0e7ff; color: #9a55ff; }
        .badge-soft-success { background: #e6f9f0; color: #10b981; }
        .badge-soft-warning { background: #fff8e6; color: #f59e0b; }
        .badge-soft-danger { background: #fef2f2; color: #ef4444; }
        .badge-soft-secondary { background: #f3f4f6; color: #6b7280; }
        .table-elevated thead th {
            background: #f8faff;
            color: #4b5563;
            font-weight: 700;
            font-size: 0.78rem;
            letter-spacing: 0.5px;
            border-bottom: 2px solid #eef2f6;
            padding: 0.9rem 1rem;
        }
        .table-elevated tbody td {
            padding: 0.9rem 1rem;
            border-bottom: 1px solid #f3f4f6;
            font-size: 0.88rem;
        }
        /* Active Selected Card Styling */
        .task-card-active {
            border: 2px solid #9a55ff !important;
            box-shadow: 0 8px 25px rgba(154, 85, 255, 0.18) !important;
            background: #faf6ff !important;
        }
        .card-expense-trigger:hover {
            background: #f3e8ff !important;
            border-color: #9a55ff !important;
            transform: translateY(-2px);
        }
        /* Modern Properti File Upload */
        .properti-file-upload-modern {
            position: relative;
            width: 100%;
            border: none !important;
            background: transparent !important;
            padding: 0 !important;
            margin: 0 !important;
        }
        .properti-file-upload-modern input[type="file"] {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
            z-index: 5;
        }
        .properti-file-upload-modern .properti-file-label-modern {
            display: flex;
            align-items: center;
            padding: 0.45rem 0.75rem;
            gap: 8px;
            pointer-events: none;
            width: 100%;
            margin-bottom: 0;
            background: #faf5ff;
            border: 1.5px dashed #9a55ff !important;
            border-radius: 8px;
            transition: all 0.25s ease;
        }
        .properti-file-upload-modern:hover .properti-file-label-modern {
            border-color: #7a35df !important;
            background: #f3e8ff;
        }
        .properti-file-label-modern i {
            font-size: 1.25rem;
            color: #9a55ff;
            background: rgba(154, 85, 255, 0.12);
            padding: 5px;
            border-radius: 6px;
            line-height: 1;
            flex-shrink: 0;
        }
        .properti-file-info-modern {
            display: flex;
            flex-direction: column;
            flex-grow: 1;
            overflow: hidden;
        }
        .properti-file-info-modern .file-title-text {
            font-weight: 600;
            color: #4b5563;
            font-size: 0.78rem;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            line-height: 1.2;
        }
        .properti-file-info-modern .file-sub-text {
            color: #6b7280;
            font-size: 0.68rem;
            line-height: 1.2;
        }
        .properti-file-size {
            font-size: 0.7rem;
            color: #9a55ff;
            font-weight: 600;
            white-space: nowrap;
        }
        /* Buttons styling & centering */
        .btn-pill-primary, .btn-pill-xs, .btn-table-del {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 6px !important;
            font-weight: 600;
            transition: all 0.2s ease;
            text-decoration: none;
            vertical-align: middle;
            line-height: 1;
        }
        .btn-pill-primary {
            background-color: #9a55ff;
            color: #ffffff !important;
            border: 1px solid #9a55ff;
            padding: 0.3rem 0.75rem;
            font-size: 0.75rem;
            box-shadow: 0 2px 4px rgba(154, 85, 255, 0.2);
            cursor: pointer;
        }
        .btn-pill-primary:hover {
            background-color: #7e3bd0;
            border-color: #7e3bd0;
            color: #ffffff !important;
        }
        .btn-pill-xs {
            background-color: #f1f3f9;
            color: #374151 !important;
            border: 1px solid #d1d5db;
            padding: 0.22rem 0.55rem;
            font-size: 0.72rem;
            cursor: pointer;
        }
        .btn-pill-xs:hover {
            background-color: #9a55ff;
            border-color: #9a55ff;
            color: #ffffff !important;
        }
        .btn-table-del {
            background-color: #fee2e2;
            color: #ef4444 !important;
            border: 1px solid #fca5a5;
            padding: 0.25rem 0.5rem;
            font-size: 0.75rem;
            cursor: pointer;
        }
        .btn-table-del:hover {
            background-color: #ef4444;
            border-color: #ef4444;
            color: #ffffff !important;
        }

        /* Modal Custom Styling & Responsive (Sisa Dikit & Tidak Terlalu Lebar) */
        .modal-custom .modal-dialog,
        .modal-dialog-compact,
        #modalAddStep .modal-dialog {
            max-width: 680px !important;
            width: 92%;
            margin: 1.5rem auto !important;
        }

        #modalValidasiLegalitas .modal-dialog,
        #modalEditTarget .modal-dialog {
            max-width: 560px !important;
            width: 92%;
            margin: 1.5rem auto !important;
        }

        .modal-dialog-scrollable {
            max-height: calc(100vh - 2.5rem) !important;
        }

        .modal-dialog-scrollable .modal-content,
        .modal-content {
            max-height: calc(100vh - 2.5rem) !important;
            border-radius: 14px !important;
            border: none !important;
            box-shadow: 0 12px 35px rgba(0, 0, 0, 0.18) !important;
        }

        .modal-header {
            padding: 1rem 1.25rem !important;
            border-bottom: 1px solid #f0f2f5 !important;
        }

        .modal-body {
            padding: 1.25rem !important;
        }

        .modal-dialog-scrollable .modal-body {
            max-height: calc(100vh - 11rem) !important;
            overflow-y: auto !important;
            overscroll-behavior: contain !important;
            scrollbar-width: thin;
            scrollbar-color: #da8cff #f1f5f9;
        }

        .modal-footer {
            padding: 0.75rem 1.25rem !important;
            border-top: 1px solid #f0f2f5 !important;
        }

        /* Prevent outer body background scroll when modal is open */
        html.modal-open,
        body.modal-open {
            overflow: hidden !important;
            height: 100vh !important;
            padding-right: 0 !important;
            touch-action: none;
        }

        body.modal-open .container-scroller,
        body.modal-open .main-panel,
        body.modal-open .content-wrapper,
        body.modal-open .page-body-wrapper {
            overflow: hidden !important;
            height: 100vh !important;
        }

        .modal {
            padding: 1.25rem 0.5rem !important;
            overflow-x: hidden !important;
            overflow-y: auto !important;
            overscroll-behavior: contain !important;
        }

        /* SELECT2 SEARCH STYLING */
        .select2-container--bootstrap-5 .select2-selection {
            border: 1px solid #ebedf2 !important;
            border-radius: 6px !important;
            min-height: 33px !important;
            padding: 0.2rem 0.5rem !important;
            font-size: 0.82rem !important;
            background-color: #ffffff !important;
        }
        .select2-container--bootstrap-5 .select2-selection--single .select2-selection__rendered {
            color: #495057 !important;
            padding-left: 0 !important;
            line-height: 1.5 !important;
            font-weight: 500;
        }
        .select2-container--bootstrap-5 .select2-selection:hover,
        .select2-container--bootstrap-5.select2-container--focus .select2-selection,
        .select2-container--bootstrap-5.select2-container--open .select2-selection {
            border-color: #9a55ff !important;
            box-shadow: 0 0 0 0.15rem rgba(154, 85, 255, 0.15) !important;
        }
        .select2-container--bootstrap-5 .select2-dropdown {
            border: 1px solid #da8cff !important;
            border-radius: 8px !important;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12) !important;
            z-index: 1060 !important;
        }
        .select2-container--bootstrap-5 .select2-search__field {
            border-radius: 6px !important;
            border: 1px solid #ebedf2 !important;
            padding: 0.35rem 0.6rem !important;
            font-size: 0.85rem !important;
        }
        .select2-container--bootstrap-5 .select2-search__field:focus {
            border-color: #9a55ff !important;
            outline: none !important;
            box-shadow: 0 0 0 0.15rem rgba(154, 85, 255, 0.2) !important;
        }
        .select2-container--bootstrap-5 .select2-results__option {
            padding: 0.4rem 0.75rem !important;
            font-size: 0.82rem !important;
        }
        .select2-container--bootstrap-5 .select2-results__option--highlighted {
            background-color: #9a55ff !important;
            color: #ffffff !important;
        }
        .select2-container--bootstrap-5 .select2-results__group {
            font-size: 0.78rem !important;
            font-weight: 700 !important;
            color: #9a55ff !important;
            background: #fbf9ff !important;
            padding: 0.35rem 0.75rem !important;
        }

        /* Select2 Container 100% Full Width Responsive */
        .select2-container {
            width: 100% !important;
            max-width: 100% !important;
        }

        /* ===== RESPONSIVE OPTIMIZATION (MOBILE & TABLET) ===== */
        @media (max-width: 991.98px) {
            #modalAddStep .modal-dialog,
            #modalValidasiLegalitas .modal-dialog,
            #modalEditTarget .modal-dialog {
                max-width: 94% !important;
                width: 94% !important;
                margin: 1rem auto !important;
            }
            .page-header-box .d-flex.flex-wrap {
                width: 100%;
            }
            .page-header-box .d-flex.flex-wrap .btn {
                flex: 1 1 auto;
                text-align: center;
                justify-content: center;
            }
            .border-start-lg {
                border-left: none !important;
                border-top: 1px solid #eef2f6 !important;
                padding-top: 1rem !important;
                margin-top: 0.5rem !important;
            }
            .fase-header-actions {
                width: 100% !important;
                margin-top: 0.5rem;
            }
            .fase-header-actions .btn {
                flex: 1 1 auto;
                text-align: center;
                justify-content: center;
            }
        }

        @media (max-width: 767.98px) {
            .fase-step-card .card-body {
                padding: 0.75rem 0.65rem !important;
            }
            .fase-step-card h4 {
                font-size: 1.05rem !important;
            }
            .fase-step-card p {
                font-size: 0.75rem !important;
                max-width: 100% !important;
            }
            .table-responsive table {
                min-width: 720px;
            }
            .task-card-phased {
                padding: 0.85rem !important;
            }
            .btn-responsive-full {
                width: 100% !important;
            }
            .footer-nav-actions {
                flex-direction: column !important;
                gap: 0.5rem !important;
            }
            .footer-nav-actions .btn {
                width: 100% !important;
            }
        }

        @media (max-width: 575.98px) {
            .modal {
                padding: 0.5rem 0.25rem 2rem 0.25rem !important;
            }

            .modal-dialog-centered {
                align-items: flex-start !important;
                min-height: auto !important;
                margin-top: 0.75rem !important;
                margin-bottom: 2rem !important;
            }

            #modalAddStep .modal-dialog,
            #modalValidasiLegalitas .modal-dialog,
            #modalEditTarget .modal-dialog {
                max-width: 96% !important;
                width: 96% !important;
                margin: 0.75rem auto 2rem auto !important;
                max-height: calc(100dvh - 3.5rem) !important;
                max-height: calc(100vh - 3.5rem) !important;
            }

            .modal-dialog-scrollable .modal-content,
            .modal-content {
                max-height: calc(100dvh - 3.5rem) !important;
                max-height: calc(100vh - 3.5rem) !important;
                border-radius: 12px !important;
            }

            .modal-dialog-scrollable .modal-body {
                max-height: calc(100dvh - 9.5rem) !important;
                max-height: calc(100vh - 9.5rem) !important;
                padding: 0.85rem 0.75rem !important;
            }

            .modal-header {
                padding: 0.75rem 0.9rem !important;
            }

            .modal-footer {
                padding: 0.6rem 0.85rem !important;
            }

            .page-header-box {
                padding: 1rem !important;
            }
            .page-header-box h4 {
                font-size: 1.1rem;
            }
            .fase-step-card .badge {
                font-size: 0.65rem !important;
                padding: 0.2rem 0.4rem !important;
            }
            .card-expense-trigger {
                flex-direction: column !important;
                align-items: flex-start !important;
                gap: 0.35rem !important;
            }
            .card-expense-trigger > div:last-child {
                width: 100%;
                justify-content: space-between;
            }
        }
    </style>

    <!-- Page Header & Action Bar -->
    <div class="page-header-box mb-4">
        <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-3">
            <div>
                <div>
                    <h4 class="fw-bold text-dark mb-0">
                        Pengolahan Lahan: <span class="text-primary">{{ $land->name }}</span>
                    </h4>
                    <span class="small text-muted">
                        Progres bertahap pembangunan infrastruktur kawasan
                    </span>
                </div>
            </div>
            <div class="d-flex flex-wrap gap-2 align-items-center">
                <a href="{{ route('properti-all') }}" class="btn btn-outline-secondary btn-sm px-3 rounded-2 d-flex align-items-center gap-1 shadow-sm">
                    Kembali
                </a>
                <!-- Validasi Legalitas Status Trigger -->
                @if($land->legal_status == 'verified' || $land->isFromPraLandbank())
                    <button type="button" class="btn btn-sm btn-outline-success px-3 rounded-2 d-flex align-items-center gap-1 shadow-sm" onclick="openLegalitasModal()" title="Status Legalitas Terverifikasi">
                        Legalitas: <strong>Terverifikasi</strong>
                    </button>
                @elseif($land->legal_status == 'rejected')
                    <button type="button" class="btn btn-sm btn-outline-danger px-3 rounded-2 d-flex align-items-center gap-1 shadow-sm" onclick="openLegalitasModal()" title="Status Legalitas Perlu Revisi">
                        Legalitas: <strong>Revisi</strong>
                    </button>
                @else
                    <button type="button" class="btn btn-sm btn-outline-warning px-3 rounded-2 d-flex align-items-center gap-1 shadow-sm" onclick="openLegalitasModal()" title="Status Legalitas Menunggu Verifikasi">
                        Legalitas: <strong>Pending</strong>
                    </button>
                @endif

                <a href="{{ route('master.bahan.index') }}" class="btn btn-outline-primary btn-sm px-3 rounded-2 d-flex align-items-center gap-1 shadow-sm">
                    Master Bahan
                </a>

                @if($land->canCreateKavling())
                    <a href="{{ route('properti.buatKavling', $land->id) }}" class="btn btn-gradient-success btn-sm px-3 rounded-2 d-flex align-items-center gap-1 shadow-sm">
                        Tambah Kavling
                    </a>
                @else
                    <button type="button" class="btn btn-secondary btn-sm px-3 rounded-2 shadow-sm opacity-75 d-flex align-items-center gap-1" onclick="showKavlingLockedInfo()" title="Tambah Kavling Terkunci">
                        Tambah Kavling
                    </button>
                @endif
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
                        <span>Total: <b class="text-primary" id="headerProgressText">{{ $progress }}%</b></span>
                        @if($isCanKavling)
                            <span class="badge bg-soft-success text-success fw-bold">Kavling Terbuka</span>
                        @else
                            <span class="badge bg-soft-danger text-danger fw-bold">Kavling Terkunci</span>
                        @endif
                    </div>
                </div>

                <div class="col-lg-5 border-start-lg ps-lg-4">
                    <div class="p-3 rounded-3 border-0 small" style="background: #f8faff; border: 1px solid #dcd6f7 !important;">
                        <div class="d-flex justify-content-between align-items-center mb-2 pb-1 border-bottom">
                            <strong class="text-dark">
                                Syarat Tambah Kavling:
                            </strong>
                            @if($isCanKavling)
                                <span class="badge bg-success text-white rounded-2 px-2 py-1 small">Lolos</span>
                            @else
                                <span class="badge bg-danger text-white rounded-2 px-2 py-1 small">Belum Lengkap</span>
                            @endif
                        </div>

                        <!-- Rule 1: Validasi Legalitas Tanah -->
                        <div class="d-flex align-items-center justify-content-between py-1">
                            <span class="text-muted">1. Legalitas:</span>
                            @if($isLegalValid)
                                <span class="badge bg-soft-success text-success fw-bold rounded-2">
                                    Terverifikasi
                                </span>
                            @elseif($land->legal_status === 'rejected')
                                <a href="javascript:void(0)" onclick="openLegalitasModal()" class="badge bg-soft-danger text-danger fw-bold rounded-2 text-decoration-none">
                                    Revisi
                                </a>
                            @else
                                <a href="javascript:void(0)" onclick="openLegalitasModal()" class="badge bg-soft-warning text-warning fw-bold rounded-2 text-decoration-none">
                                    Pending
                                </a>
                            @endif
                        </div>

                        <!-- Rule 2: Pengolahan Lahan Selesai -->
                        <div class="d-flex align-items-center justify-content-between py-1">
                            <span class="text-muted">2. Fisik Lahan:</span>
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

    <!-- PHASE STEPPER NAVIGATION TABS (DASHBOARD CARD STYLE) -->
    <div class="row g-2 g-md-3 mb-4" id="faseStepper" role="tablist">
        @foreach($phaseData as $phNum => $phInfo)
            @php
                $pProg = $phInfo['progress'];
            @endphp
            <div class="col-6 col-md-4 col-xl-3">
                <div class="card shadow-sm border-0 h-100 fase-step-card {{ $loop->first ? 'active' : '' }}" 
                     id="step-fase{{ $phNum }}-tab" 
                     data-bs-toggle="pill" 
                     data-bs-target="#step-fase{{ $phNum }}" 
                     role="tab" 
                     onclick="activateTab('#step-fase{{ $phNum }}-tab')"
                     style="cursor: pointer; transition: all 0.2s ease;">
                    <div class="card-body d-flex justify-content-between align-items-center p-2 p-md-3">
                        <div class="overflow-hidden">
                            <div class="d-flex align-items-center gap-1 gap-md-2 mb-1">
                                <h4 class="text-dark mb-0 fw-bold fs-5 fs-md-4">{{ $pProg }}%</h4>
                                @if($pProg >= 100)
                                    <span class="badge bg-success text-white rounded-2" style="font-size: 0.68rem;">Selesai</span>
                                @elseif($pProg > 0)
                                    <span class="badge bg-warning text-dark rounded-2" style="font-size: 0.68rem;">Proses</span>
                                @else
                                    <span class="badge bg-secondary text-white rounded-2" style="font-size: 0.68rem;">Belum</span>
                                @endif
                            </div>
                            <p class="text-muted mb-0 fw-semibold text-truncate small">{{ $phInfo['title'] }}</p>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        <!-- Button Quick Add Tahapan Baru in Stepper (Dashboard Card Style) -->
        <div class="col-6 col-md-4 col-xl-3">
            <div class="card shadow-sm border-0 h-100" 
                 style="border: 2px dashed #9a55ff !important; background: #faf5ff; cursor: pointer; transition: all 0.2s ease;" 
                 onclick="openAddStepModal({{ $nextPhaseNum }})" 
                 title="Tambah Tahapan Baru">
                <div class="card-body d-flex justify-content-between align-items-center p-2 p-md-3">
                    <div>
                        <span class="fw-bold text-primary d-block small" style="font-size: 0.85rem;">+ Tambah Tahapan</span>
                        <small class="text-muted" style="font-size: 0.72rem;">Kustom Fase</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Step: Rekapitulasi Keuangan -->
        <div class="col-6 col-md-4 col-xl-3">
            <div class="card shadow-sm border-0 h-100 fase-step-card" 
                 id="step-keuangan-tab" 
                 data-bs-toggle="pill" 
                 data-bs-target="#step-keuangan" 
                 role="tab" 
                 onclick="activateTab('#step-keuangan-tab')"
                 style="cursor: pointer; transition: all 0.2s ease;">
                <div class="card-body d-flex justify-content-between align-items-center p-2 p-md-3">
                    <div class="overflow-hidden">
                        <h4 class="text-danger mb-1 fw-bold fs-6 fs-md-5 text-truncate">Rp {{ number_format($totalExpense, 0, ',', '.') }}</h4>
                        <p class="text-muted mb-0 fw-semibold text-truncate small">Total Belanja ({{ $expenses->count() }} Nota)</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- TAB CONTENT SECTIONS (DINAMIS SEMUA TAHAPAN) -->
    <div class="tab-content" id="faseStepperContent">
        
        @foreach($phaseData as $phNum => $phInfo)
            @php
                $pItems = $phInfo['items'];
                $pExpenses = $phInfo['expenses'];
                $isLastPhase = $loop->last;
                $nextTabTarget = $isLastPhase ? '#step-keuangan-tab' : '#step-fase' . ($phNum + 1) . '-tab';
                $prevTabTarget = $loop->first ? null : '#step-fase' . ($phNum - 1) . '-tab';
                $nextTitle = $phaseData[$phNum + 1]['title'] ?? 'Rekap Keuangan';
                $prevTitle = $phaseData[$phNum - 1]['title'] ?? '';
            @endphp
            <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="step-fase{{ $phNum }}" role="tabpanel">
                <div class="card border-0 shadow-sm rounded-3 bg-white p-3 p-md-4 mb-4">
                    <!-- Fase Header Info -->
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 pb-3 mb-4 border-bottom">
                        <div>
                            <h5 class="fw-bold text-dark mb-0">{{ $phInfo['title'] }}</h5>
                        </div>
                        <div class="d-flex flex-wrap align-items-center justify-content-md-end gap-2 ms-md-auto fase-header-actions">
                            <button type="button" class="btn btn-sm btn-gradient-primary rounded-2 px-3 shadow-sm fw-semibold" onclick="openAddStepModal({{ $phNum }})">
                                + Tambah Pos
                            </button>
                            <button type="button" class="btn btn-sm btn-primary text-white rounded-2 px-3 shadow-sm fw-semibold" onclick="toggleInlineAddExpense({{ $phNum }})">
                                + Catat Belanja
                            </button>
                            <button type="button" class="btn btn-sm btn-success rounded-2 px-3 shadow-sm fw-semibold" onclick="finalizePhaseAction({{ $phNum }})">
                                Selesaikan (100%)
                            </button>
                        </div>
                    </div>

                    <!-- Inline Form Tambah Pengeluaran Bahan (Collapsible) -->
                    @include('properti.partials.inline_expense_form', ['phase' => $phNum, 'infrastructures' => $pItems])

                    <!-- Tasks Grid -->
                    <h6 class="fw-bold text-dark mb-3">Pos Pekerjaan: {{ $phInfo['title'] }}</h6>
                    <div class="row g-3 g-md-4 mb-4">
                        @forelse($pItems as $item)
                            @include('properti.partials.phase_item_card', ['item' => $item])
                        @empty
                            <div class="col-12">
                                <div class="p-4 text-center bg-light rounded-3 border border-dashed">
                                    <h6 class="text-dark fw-bold mb-2">Belum ada pos pekerjaan di {{ $phInfo['title'] }}</h6>
                                    <button type="button" class="btn btn-sm btn-gradient-primary px-3 rounded-2 shadow-sm fw-semibold" onclick="openAddStepModal({{ $phNum }})">
                                        + Tambah Pos
                                    </button>
                                </div>
                            </div>
                        @endforelse
                    </div>

                    <!-- Expenses Table -->
                    <div class="mt-4 pt-3 border-top">
                        <h6 class="fw-bold text-dark mb-3 d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-2">
                            <span>Riwayat Belanja Bahan</span>
                            <span class="badge bg-soft-danger text-danger">Total: Rp {{ number_format($pExpenses->sum('total_amount'), 0, ',', '.') }}</span>
                        </h6>
                        @include('properti.partials.phase_expense_table', ['phase' => $phNum, 'phaseExpenses' => $pExpenses])
                    </div>

                    <!-- Navigation Footer -->
                    <div class="d-flex flex-column flex-sm-row justify-content-between gap-2 pt-4 border-top mt-4 footer-nav-actions">
                        @if($prevTabTarget)
                            <button type="button" class="btn btn-outline-secondary px-4 rounded-2 mb-2 mb-sm-0" onclick="activateTab('{{ $prevTabTarget }}');">
                                &larr; {{ $prevTitle }}
                            </button>
                        @else
                            <div></div>
                        @endif

                        @if($isLastPhase)
                            @if($land->canCreateKavling())
                                <a href="{{ route('properti.buatKavling', $land->id) }}" class="btn btn-gradient-success px-4 rounded-2 shadow-sm text-center">
                                    Buat Unit Kavling &rarr;
                                </a>
                            @else
                                <button type="button" class="btn btn-gradient-success px-4 rounded-2 shadow-sm" onclick="finalizeAllInfrastruktur()">
                                    Selesaikan Seluruh Pengolahan Lahan (100%)
                                </button>
                            @endif
                        @else
                            <button type="button" class="btn btn-primary px-4 rounded-2 shadow-sm" onclick="activateTab('{{ $nextTabTarget }}');">
                                Lanjut: {{ $nextTitle }} &rarr;
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach

        <!-- =================== STEP 4: REKAP KEUANGAN ERP CONTENT =================== -->
        <div class="tab-pane fade" id="step-keuangan" role="tabpanel">
            <div class="card border-0 shadow-sm rounded-4 bg-white p-4 mb-4">
                <!-- Financial Cards Summary -->
                <div class="row g-3 mb-4">
                    <div class="col-6 col-md-3">
                        <div class="p-3 rounded-4 bg-light border">
                            <span class="text-muted small fw-bold">Total Belanja</span>
                            <h4 class="fw-bold text-danger mb-0 mt-1">Rp {{ number_format($totalExpense, 0, ',', '.') }}</h4>
                            <span class="small text-muted">{{ $expenses->count() }} transaksi</span>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="p-3 rounded-4 bg-light border">
                            <span class="text-muted small fw-bold">Lunas</span>
                            <h4 class="fw-bold text-success mb-0 mt-1">Rp {{ number_format($totalLunas, 0, ',', '.') }}</h4>
                            <span class="small text-muted">{{ $expenses->where('payment_status', 'Lunas')->count() }} transaksi</span>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="p-3 rounded-4 bg-light border">
                            <span class="text-muted small fw-bold">Hutang / Tempo</span>
                            <h4 class="fw-bold text-warning mb-0 mt-1">Rp {{ number_format($totalHutang, 0, ',', '.') }}</h4>
                            <span class="small text-muted">{{ $expenses->where('payment_status', '!=', 'Lunas')->count() }} transaksi</span>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="p-3 rounded-4 bg-light border">
                            <span class="text-muted small fw-bold">Rekap per Fase</span>
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
                    <h5 class="fw-bold text-dark mb-0">Rekap Pengeluaran Bahan & Jasa</h5>
                </div>
                <div class="table-responsive bg-white rounded-4 border">
                    <table class="table table-elevated table-hover align-middle mb-0" style="min-width: 960px;">
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
                                                <i class="mdi mdi-file-image"></i> Nota
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
                                    <td colspan="11" class="text-center py-5 text-muted">
                                        <i class="mdi mdi-cash-remove fs-1 opacity-25"></i>
                                        <p class="mt-2 mb-0">Belum ada pengeluaran bahan tercatat.</p>
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
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-dialog-compact">
            <div class="modal-content rounded-4 border-0 shadow">
                <div class="modal-header border-bottom-0 pb-0">
                    <h5 class="modal-title fw-bold text-dark d-flex align-items-center gap-2">
                        <i class="mdi mdi-pencil-box text-primary fs-4"></i> Sesuaikan Target & Bobot Pos
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
                                <input type="text" class="form-control price-format" id="editTargetCostInput" name="cost_estimate" placeholder="Contoh: 25.000.000">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-top-0 pt-0">
                        <button type="button" class="btn btn-secondary rounded-2 px-3" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-gradient-primary rounded-2 px-4" id="btnSaveTarget">
                            <i class="mdi mdi-check me-1"></i>Simpan Perubahan Target
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Validasi Legalitas Tanah -->
    <div class="modal fade" id="modalValidasiLegalitas" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-dialog-compact">
            <div class="modal-content rounded-4 border-0 shadow">
                <div class="modal-header border-bottom-0 pb-0">
                    <h5 class="modal-title fw-bold text-dark d-flex align-items-center gap-2">
                        <i class="mdi mdi-shield-check text-primary fs-4"></i> Validasi Dokumen Legalitas Tanah
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
                        <label class="small text-muted fw-bold mb-1 d-block"><i class="mdi mdi-folder-outline text-primary me-1"></i>Berkas Dokumen Terlampir:</label>
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
                                <option value="verified" {{ $land->legal_status === 'verified' ? 'selected' : '' }}>✔ Terverifikasi (Sah & Lolos Validasi)</option>
                                <option value="pending" {{ $land->legal_status === 'pending' ? 'selected' : '' }}>⏳ Pending (Menunggu Kelengkapan Berkas)</option>
                                <option value="rejected" {{ $land->legal_status === 'rejected' ? 'selected' : '' }}>✖ Ditolak / Perlu Revisi Dokumen</option>
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
                            <i class="mdi mdi-check me-1"></i>Simpan Status Validasi Legalitas
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Pos Pekerjaan / Step Baru (Dinamis oleh Kepala Legal / Admin) -->
    <div class="modal fade" id="modalAddStep" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-dialog-compact">
            <div class="modal-content rounded-4 border-0 shadow">
                <div class="modal-header border-bottom-0 pb-0">
                    <h5 class="modal-title fw-bold text-dark d-flex align-items-center gap-2" id="modalAddStepTitle">
                        Tambah Pos Pekerjaan Pengolahan Lahan
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formAddStep" onsubmit="submitAddStep(event)" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body pt-2">
                        <p class="small text-muted mb-3" id="modalAddStepSubtitle">
                            Tambahkan pos pekerjaan baru secara dinamis untuk proyek <strong>{{ $land->name }}</strong>.
                        </p>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="small text-muted fw-bold mb-1">Target Tahapan Pembangunan <span class="text-danger">*</span></label>
                                <select class="form-select" id="addStepPhase" name="phase" onchange="toggleNewPhaseInput(this.value)" required>
                                    @foreach($phaseData as $phNum => $phInfo)
                                        <option value="{{ $phNum }}">{{ $phInfo['title'] }}</option>
                                    @endforeach
                                    <option value="{{ $nextPhaseNum }}" class="fw-bold text-primary">+ Buat / Tambah Tahapan Baru</option>
                                </select>
                            </div>
                            <div class="col-md-6" id="newPhaseNameContainer" style="display: none;">
                                <label class="small text-primary fw-bold mb-1">Nama Tahapan Baru <span class="text-danger">*</span></label>
                                <input type="text" class="form-control border-primary" id="addStepNewPhaseName" name="new_phase_name" placeholder="Contoh: Fasum & Masjid, Taman Kawasan, dll.">
                            </div>
                            <div class="col-md-6" id="categoryContainer">
                                <label class="small text-muted fw-bold mb-1">Kategori Pos Pekerjaan</label>
                                <input type="text" class="form-control" id="addStepCategory" name="category" placeholder="Contoh: Cut & Fill, Drainase, Perkerasan, dll.">
                            </div>
                            <div class="col-12">
                                <label class="small text-muted fw-bold mb-1">Nama Pos Pekerjaan / Step <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="addStepItemName" name="item_name" placeholder="Contoh: Galian Tanah Zona Barat & Pembuangan Lumpur" required>
                            </div>
                            <div class="col-md-4">
                                <label class="small text-muted fw-bold mb-1">Target Volume <span class="text-danger">*</span></label>
                                <input type="number" step="any" class="form-control" id="addStepTargetVol" name="target_volume" placeholder="Contoh: 1500" required min="0.01">
                            </div>
                            <div class="col-md-4">
                                <label class="small text-muted fw-bold mb-1">Satuan Volume <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="addStepUnit" name="volume_unit" placeholder="m³, m², meter, titik, paket" required>
                            </div>
                            <div class="col-md-4">
                                <label class="small text-muted fw-bold mb-1">Bobot Persentase (%) <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="number" step="any" class="form-control" id="addStepBobot" name="bobot_persen" placeholder="Contoh: 50" required min="0" max="100">
                                    <span class="input-group-text">%</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="small text-muted fw-bold mb-1">Estimasi Biaya / RAB Pos (Rp)</label>
                                <input type="text" class="form-control price-format" id="addStepCostEstimate" name="cost_estimate" placeholder="Contoh: 25.000.000">
                            </div>
                            <div class="col-md-6">
                                <label class="small text-muted fw-bold mb-1">Kontraktor / Mandor Pelaksana</label>
                                <input type="text" class="form-control" id="addStepContractor" name="contractor_name" placeholder="Nama Kontraktor / Mandor">
                            </div>
                            <div class="col-md-6">
                                <label class="small text-muted fw-bold mb-1">Rencana Mulai Pengerjaan</label>
                                <input type="date" class="form-control" id="addStepStart" name="target_start">
                            </div>
                            <div class="col-md-6">
                                <label class="small text-muted fw-bold mb-1">Target Selesai</label>
                                <input type="date" class="form-control" id="addStepEnd" name="target_end">
                            </div>
                            <div class="col-12">
                                <label class="small text-muted fw-bold mb-1">Catatan / Spesifikasi Teknis</label>
                                <textarea class="form-control" id="addStepNotes" name="notes" rows="2" placeholder="Keterangan spesifikasi teknis, metode pengerjaan, atau catatan penting lainnya..."></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-top-0 pt-0">
                        <button type="button" class="btn btn-secondary rounded-2 px-3" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-gradient-primary rounded-2 px-4" id="btnSaveNewStep">
                            <i class="mdi mdi-plus-circle me-1"></i>Tambah Pos Pekerjaan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>

@endsection

@push('scripts')
<script>
    const currentLandId = {{ $land->id }};
    const storageKey = 'active_phase_tab_' + currentLandId;

    window.initSelect2Materials = function(context) {
        if (!$.fn.select2) return;
        let $ctx = context ? $(context) : $(document);
        $ctx.find('.select-master-item-row').each(function() {
            let $sel = $(this);
            if ($sel.hasClass('select2-hidden-accessible')) {
                $sel.select2('destroy');
            }
            $sel.select2({
                theme: 'bootstrap-5',
                width: '100%',
                placeholder: '-- Cari / Pilih dari Master Bahan --',
                allowClear: true,
                minimumResultsForSearch: 0,
                language: {
                    noResults: function() {
                        return "Bahan tidak ditemukan";
                    },
                    searching: function() {
                        return "Mencari bahan...";
                    }
                }
            }).off('change.master select2:select.master select2:clear.master').on('change.master select2:select.master select2:clear.master', function() {
                let phase = $(this).data('phase') || $(this).closest('form').find('input[name="phase"]').val() || 1;
                let rowIdx = $(this).data('row-idx') || $(this).closest('tr').data('row-idx') || 0;
                onSelectRowMaterial(this, phase, rowIdx);
            });
        });
    };

    // Auto-focus select2 search input when opened
    $(document).on('select2:open', () => {
        setTimeout(() => {
            let searchField = document.querySelector('.select2-container--open .select2-search__field');
            if (searchField) {
                searchField.focus();
            }
        }, 10);
    });

    // TAB PERSISTENCE ENGINE (Kompatibel Bootstrap 4 & 5)
    window.activateTab = function(tabIdOrSelector) {
        if (!tabIdOrSelector) return;
        let selector = String(tabIdOrSelector).trim();
        
        // If numeric like 1, 2, 3, 4
        if (/^\d+$/.test(selector)) {
            selector = '#step-fase' + selector + '-tab';
        } else {
            if (!selector.startsWith('#')) selector = '#' + selector;
            if (!selector.endsWith('-tab') && !selector.includes('keuangan')) {
                selector = selector + '-tab';
            }
        }
        
        let $tab = $(selector);
        if (!$tab.length) {
            let cleanId = selector.replace('#', '').replace('-tab', '');
            $tab = $(`#${cleanId}-tab, [data-target="#${cleanId}"], [data-bs-target="#${cleanId}"]`).first();
        }
        
        if ($tab.length) {
            $('.fase-step-btn, .fase-step-card').removeClass('active');
            $tab.addClass('active');

            if (typeof $tab.tab === 'function') {
                try { $tab.tab('show'); } catch(e) {}
            }

            let targetPane = $tab.attr('data-bs-target') || $tab.attr('data-target') || selector.replace('-tab', '');
            $('#faseStepperContent > .tab-pane').removeClass('show active');
            $(targetPane).addClass('show active');

            setSavedActiveTab(selector);
        }
    };

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
            initSelect2Materials(formBox);
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
        if (!formBox.hasClass('d-none')) {
            initSelect2Materials(formBox);
        }
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
                statusBadgeDisplay.html('<span class="badge bg-success text-white px-2 py-1 rounded-2 small fw-bold"><i class="mdi mdi-check-circle me-1"></i>Selesai (100%)</span>');
            }
            if (badgeHeaderEl.length) {
                badgeHeaderEl.attr('class', 'badge bg-success text-white px-2 py-1 rounded-2 small fw-bold').html('<i class="mdi mdi-check-circle me-1"></i>Selesai (100%)');
            }
            if (barEl.length) {
                barEl.attr('class', 'progress-bar progress-bar-striped bg-success');
            }
        } else if (pct > 0 || realized > 0) {
            if (statusHidden.length) statusHidden.val('proses');
            if (statusBadgeDisplay.length) {
                statusBadgeDisplay.html('<span class="badge bg-warning text-dark px-2 py-1 rounded-2 small fw-bold"><i class="mdi mdi-progress-wrench me-1"></i>Dalam Proses</span>');
            }
            if (badgeHeaderEl.length) {
                badgeHeaderEl.attr('class', 'badge bg-warning text-dark px-2 py-1 rounded-2 small fw-bold').html(`<i class="mdi mdi-progress-wrench me-1"></i>Proses (${pct}%)`);
            }
            if (barEl.length) {
                barEl.attr('class', 'progress-bar progress-bar-striped bg-primary');
            }
        } else {
            if (statusHidden.length) statusHidden.val('belum_mulai');
            if (statusBadgeDisplay.length) {
                statusBadgeDisplay.html('<span class="badge bg-secondary text-white px-2 py-1 rounded-2 small"><i class="mdi mdi-clock-outline me-1"></i>Belum Mulai</span>');
            }
            if (badgeHeaderEl.length) {
                badgeHeaderEl.attr('class', 'badge bg-secondary text-white px-2 py-1 rounded-2 small').html('<i class="mdi mdi-clock-outline me-1"></i>Belum Mulai');
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

    window.formatRupiahNumber = function(val) {
        if (val === null || val === undefined || val === '') return '';
        let num = parseInt(val.toString().replace(/\D/g, ''), 10);
        return isNaN(num) ? '' : new Intl.NumberFormat('id-ID').format(num);
    };

    window.cleanRupiahNumber = function(val) {
        if (!val) return 0;
        let clean = val.toString().replace(/\D/g, '');
        return clean ? parseInt(clean, 10) : 0;
    };

    window.openEditTargetModal = function(itemId, itemName, targetVol, unit, bobot, cost) {
        $('#editTargetItemId').val(itemId);
        $('#editTargetItemName').text(itemName);
        $('#editTargetVolInput').val(targetVol);
        $('#editTargetUnitInput').val(unit);
        $('#editTargetBobotInput').val(bobot);
        $('#editTargetCostInput').val(cost ? formatRupiahNumber(cost) : '');
        $('#modalEditTarget').modal('show');
    };

    window.submitEditTarget = function(event) {
        event.preventDefault();
        let itemId = $('#editTargetItemId').val();
        let submitBtn = $('#btnSaveTarget');
        submitBtn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-1"></span>Menyimpan...');

        let rawCost = $('#editTargetCostInput').val();
        let cleanCost = cleanRupiahNumber(rawCost);

        $.ajax({
            url: `/properti/infrastruktur/${itemId}/update`,
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                target_volume: $('#editTargetVolInput').val(),
                volume_unit: $('#editTargetUnitInput').val(),
                bobot_persen: $('#editTargetBobotInput').val(),
                cost_estimate: cleanCost
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

    let phaseCategoryMap = {
        @foreach($phaseData as $phNum => $phInfo)
            {{ $phNum }}: "{{ addslashes($phInfo['title']) }}",
        @endforeach
    };

    window.toggleNewPhaseInput = function(phaseVal) {
        let maxExisting = {{ $nextPhaseNum - 1 }};
        let isNewPhase = parseInt(phaseVal) > maxExisting;
        if (isNewPhase) {
            $('#newPhaseNameContainer').slideDown();
            $('#addStepNewPhaseName').prop('required', true).val('').focus();
            $('#categoryContainer').removeClass('col-md-6').addClass('col-md-12');
            $('#addStepCategory').val('');
            $('#modalAddStepTitle').text('Tambah Tahapan (Fase) Pembangunan Baru');
            $('#modalAddStepSubtitle').html('Buat tahapan pembangunan baru dan tentukan rincian pos pekerjaan pertama untuk proyek <strong>{{ $land->name }}</strong>.');
            $('#btnSaveNewStep').html('Simpan & Buat Tahapan Baru');
        } else {
            $('#newPhaseNameContainer').slideUp();
            $('#addStepNewPhaseName').prop('required', false).val('');
            $('#categoryContainer').removeClass('col-md-12').addClass('col-md-6');
            let phaseTitle = phaseCategoryMap[phaseVal] || ('Fase ' + phaseVal);
            if (phaseCategoryMap[phaseVal]) {
                $('#addStepCategory').val(phaseCategoryMap[phaseVal]);
            }
            $('#modalAddStepTitle').text('Tambah Pos Pekerjaan: ' + phaseTitle);
            $('#modalAddStepSubtitle').html('Tambahkan pos pekerjaan baru ke dalam <strong>' + phaseTitle + '</strong> untuk proyek <strong>{{ $land->name }}</strong>.');
            $('#btnSaveNewStep').html('Tambah Pos Pekerjaan');
        }
    };

    window.onPhaseDropdownChange = function(phaseVal) {
        window.toggleNewPhaseInput(phaseVal);
    };

    window.openAddStepModal = function(phase = 1) {
        let form = document.getElementById('formAddStep');
        if (form) {
            form.reset();
        }
        $('#addStepPhase').val(phase);
        window.toggleNewPhaseInput(phase);

        if (phase == 1) {
            $('#addStepUnit').val('m³');
        } else if (phase == 2) {
            $('#addStepUnit').val('meter');
        } else if (phase == 3) {
            $('#addStepUnit').val('titik');
        } else {
            $('#addStepUnit').val('paket');
        }
        $('#modalAddStep').modal('show');
    };

    window.submitAddStep = function(e) {
        e.preventDefault();
        let form = document.getElementById('formAddStep');
        let formData = new FormData(form);
        
        let costEst = cleanRupiahNumber($('#addStepCostEstimate').val());
        formData.set('cost_estimate', costEst);
        
        let phase = $('#addStepPhase').val() || 1;
        let btn = $('#btnSaveNewStep');
        btn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-1"></span>Menyimpan...');

        $.ajax({
            url: `/properti/${currentLandId}/infrastruktur/store`,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function(res) {
                btn.prop('disabled', false).html('<i class="mdi mdi-plus-circle me-1"></i>Tambah Pos Pekerjaan');
                if (res.success) {
                    $('#modalAddStep').modal('hide');
                    setSavedActiveTab('#step-fase' + phase + '-tab');
                    Swal.fire({
                        icon: 'success',
                        title: 'Pos Pekerjaan Ditambahkan!',
                        text: res.message,
                        timer: 1500,
                        showConfirmButton: false
                    }).then(() => {
                        window.location.reload();
                    });
                } else {
                    Swal.fire('Gagal', res.message || 'Terjadi kesalahan', 'error');
                }
            },
            error: function(xhr) {
                btn.prop('disabled', false).html('<i class="mdi mdi-plus-circle me-1"></i>Tambah Pos Pekerjaan');
                let msg = 'Gagal menambahkan pos pekerjaan.';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    msg = xhr.responseJSON.message;
                }
                Swal.fire('Error', msg, 'error');
            }
        });
    };

    window.deleteInfrastructureStep = function(itemId, itemName) {
        let activeTab = $('.fase-step-btn.active').attr('id');
        if (activeTab) {
            setSavedActiveTab('#' + activeTab);
        }

        Swal.fire({
            title: `Hapus Pos '${itemName}'?`,
            text: 'Pos pekerjaan ini dan seluruh catatan capaian lapangannya akan dihapus.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: '<i class="mdi mdi-delete me-1"></i>Ya, Hapus Pos',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `/properti/infrastruktur/${itemId}`,
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
                        } else {
                            Swal.fire('Gagal', res.message || 'Terjadi kesalahan', 'error');
                        }
                    },
                    error: function(xhr) {
                        Swal.fire('Error', 'Gagal menghapus pos pekerjaan.', 'error');
                    }
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

    let rowCounter = {};

    window.onSelectRowMaterial = function(selectEl, phase, rowIdx) {
        let opt = $(selectEl).find(':selected');
        if (opt.val()) {
            $(`#inputMatId_${phase}_${rowIdx}`).val(opt.val());
            $(`#inputItemName_${phase}_${rowIdx}`).val(opt.data('name') || opt.attr('data-name') || '');
            $(`#inputCat_${phase}_${rowIdx}`).val(opt.data('category') || opt.attr('data-category') || '');
            $(`#inputUnit_${phase}_${rowIdx}`).val(opt.data('unit') || opt.attr('data-unit') || '');
            
            let price = parseFloat(opt.data('price') || opt.attr('data-price')) || 0;
            $(`#inputPrice_${phase}_${rowIdx}`).val(price ? formatRupiahNumber(price) : '');
        } else {
            $(`#inputMatId_${phase}_${rowIdx}`).val('');
        }
        calcMultiRowTotal(phase, rowIdx);
    };

    window.calcMultiRowTotal = function(phase, rowIdx) {
        let qty = parseFloat($(`#inputQty_${phase}_${rowIdx}`).val()) || 0;
        let rawPrice = $(`#inputPrice_${phase}_${rowIdx}`).val() || '0';
        let price = cleanRupiahNumber(rawPrice);
        let total = qty * price;
        $(`#displayRowSubtotal_${phase}_${rowIdx}`).val('Rp ' + total.toLocaleString('id-ID'));
        recalculateGrandTotal(phase);
    };

    window.recalculateGrandTotal = function(phase) {
        let grandTotal = 0;
        $(`#multiItemBody_${phase} tr`).each(function() {
            let rowIdx = $(this).attr('data-row-idx');
            let qty = parseFloat($(`#inputQty_${phase}_${rowIdx}`).val()) || 0;
            let rawPrice = $(`#inputPrice_${phase}_${rowIdx}`).val() || '0';
            let price = cleanRupiahNumber(rawPrice);
            grandTotal += (qty * price);
        });
        $(`#grandTotalNotaDisplay_${phase}`).text('Rp ' + grandTotal.toLocaleString('id-ID'));
    };

    window.addNewMaterialRow = function(phase) {
        if (!rowCounter[phase]) {
            rowCounter[phase] = 1;
        }
        let newIdx = rowCounter[phase]++;
        let optionsHtml = $(`#masterOptionsTemplate_${phase}`).html();

        let newRow = `
            <tr id="rowItem_${phase}_${newIdx}" data-row-idx="${newIdx}">
                <td>
                    <div class="d-flex flex-column gap-1">
                        <select class="form-select form-select-sm select-master-item-row" data-phase="${phase}" data-row-idx="${newIdx}" onchange="onSelectRowMaterial(this, ${phase}, ${newIdx})" style="width: 100%;">
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
                    <input type="text" name="items[${newIdx}][unit_price]" id="inputPrice_${phase}_${newIdx}" class="form-control form-control-sm text-end price-format" placeholder="0" required oninput="calcMultiRowTotal(${phase}, ${newIdx})">
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
        initSelect2Materials(`#rowItem_${phase}_${newIdx}`);
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

    window.previewCardPhoto = function(input, itemId) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                $(`#imgPreview_${itemId}`).attr('src', e.target.result);
                $(`#fileNamePreview_${itemId}`).text(input.files[0].name);
                $(`#previewContainer_${itemId}`).removeClass('d-none');
                $(`#uploadWrapper_${itemId}`).addClass('d-none');
            };
            reader.readAsDataURL(input.files[0]);
        }
    };

    function initFileUploadEvents() {
        $(document).on('change', '.properti-file-upload-modern input[type="file"]', function() {
            const input = this;
            const container = $(this).closest('.properti-file-upload-modern');
            const titleEl = container.find('.file-title-text');
            const sizeEl = container.find('.properti-file-size');
            const subEl = container.find('.file-sub-text');
            const typeName = $(this).data('type-name') || 'File Terpilih';

            if (input.files && input.files[0]) {
                const file = input.files[0];
                titleEl.text(file.name);
                let sizeStr = '';
                if (file.size > 1024 * 1024) {
                    sizeStr = (file.size / (1024 * 1024)).toFixed(2) + ' MB';
                } else {
                    sizeStr = (file.size / 1024).toFixed(0) + ' KB';
                }
                sizeEl.text(sizeStr);
                subEl.text(typeName + ' siap diupload');
                container.css({
                    'border-color': '#10b981',
                    'background-color': '#f0fdf4'
                });
                container.find('.properti-file-label-modern i').css('color', '#10b981');
            }
        });
    }

    $(document).ready(function() {
        initFileUploadEvents();
        initSelect2Materials();

        // 1. Simpan tab saat user mengklik / mengganti tab
        $('.fase-step-btn, .fase-step-card').on('shown.bs.tab click', function(e) {
            let targetId = $(this).attr('id');
            if (targetId) {
                setSavedActiveTab('#' + targetId);
            }
        });

        // 2. Simpan tab saat submit form belanja bahan & unmask harga rupiah ke angka murni
        $('form[id^="multiExpenseForm_"]').on('submit', function() {
            let phase = $(this).find('input[name="phase"]').val() || 1;
            setSavedActiveTab('#step-fase' + phase + '-tab');

            // Unmask semua input harga agar controller menerima integer/angka murni
            $(this).find('.price-format, [name*="[unit_price]"]').each(function() {
                let val = $(this).val();
                if (val) {
                    $(this).val(val.toString().replace(/\D/g, ''));
                }
            });
        });

        // 3. Realtime auto-format ribuan Rupiah saat user mengetik nominal
        $(document).on('input keyup change paste', '.price-format', function() {
            let val = $(this).val();
            if (val) {
                let clean = val.toString().replace(/\D/g, '');
                if (clean) {
                    $(this).val(new Intl.NumberFormat('id-ID').format(clean));
                } else {
                    $(this).val('');
                }
            }
        });

        // 3. Event Delegation Realtime untuk input volume capaian progres
        $(document).on('input keyup change paste', 'input[id^="realizedVolInput_"]', function() {
            let id = $(this).attr('id').replace('realizedVolInput_', '');
            window.calculateVolumePercentage(id);
        });

        // 4. Cek Prioritas Tab saat Halaman Dimuat:
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
