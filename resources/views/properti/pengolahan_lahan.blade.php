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
            border-radius: 18px;
            padding: 1.5rem 1.75rem;
            border: 1px solid rgba(154, 85, 255, 0.15);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
        }
        .fase-stepper {
            display: flex;
            gap: 0.75rem;
            overflow-x: auto;
            padding-bottom: 0.5rem;
        }
        .fase-step-btn {
            flex: 1;
            min-width: 220px;
            background: #ffffff;
            border: 2px solid #e9ecef;
            border-radius: 16px;
            padding: 1rem 1.25rem;
            text-align: left;
            transition: all 0.25s ease;
            position: relative;
            cursor: pointer;
        }
        .fase-step-btn:hover {
            border-color: #d1b8ff;
            background: #faf5ff;
        }
        .fase-step-btn.active {
            background: #ffffff;
            border-color: #9a55ff;
            box-shadow: 0 6px 20px rgba(154, 85, 255, 0.18);
        }
        .fase-step-btn.active .step-number {
            background: linear-gradient(135deg, #da8cff, #9a55ff);
            color: #ffffff;
        }
        .step-number {
            width: 32px;
            height: 32px;
            border-radius: 10px;
            background: #f1f3f9;
            color: #6b7280;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 0.9rem;
        }
        .task-card-phased {
            background: #ffffff;
            border-radius: 16px;
            border: 1px solid #eef2f6;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.02);
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }
        .task-card-phased:hover {
            border-color: #c4b5fd;
            box-shadow: 0 8px 25px rgba(154, 85, 255, 0.07);
        }
        .slider-box-phased {
            background: #f8faff;
            border-radius: 12px;
            padding: 1rem;
            border: 1px solid #e2e8f0;
        }
        .custom-range-slider {
            accent-color: #9a55ff;
            cursor: pointer;
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
            padding: 0.9rem 1rem;
        }
        .table-elevated tbody td {
            padding: 0.9rem 1rem;
            border-bottom: 1px solid #f3f4f6;
            font-size: 0.88rem;
        }
        /* Select2 Theme Customization */
        .select2-container--bootstrap-5 .select2-selection {
            border-radius: 10px;
            border-color: #dcd6f7;
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
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(154, 85, 255, 0.15);
            border: 1px solid #dcd6f7;
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
            box-shadow: 0 10px 30px rgba(154, 85, 255, 0.22) !important;
            background: #faf6ff !important;
        }
        .card-expense-trigger:hover {
            background: #f3e8ff !important;
            border-color: #9a55ff !important;
            transform: translateY(-2px);
        }
    </style>

    <!-- Page Header & Action Bar -->
    <div class="page-header-box mb-4">
        <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-3">
            <div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-1 small">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none text-muted">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('properti-all') }}" class="text-decoration-none text-muted">Pasca Land Bank</a></li>
                        <li class="breadcrumb-item active text-primary fw-bold" aria-current="page">Pengolahan Lahan per Fase</li>
                    </ol>
                </nav>
                <div class="d-flex align-items-center gap-2 mt-2">
                    <div class="p-2 rounded-3 bg-gradient-primary text-white d-inline-flex align-items-center justify-content-center shadow-sm" style="width: 44px; height: 44px;">
                        <i class="mdi mdi-layers-triple fs-5"></i>
                    </div>
                    <div>
                        <h4 class="fw-bold text-dark mb-0">
                            Pengolahan Lahan per Fase: <span class="text-primary">{{ $land->name }}</span>
                        </h4>
                        <span class="small text-muted">
                            Progres bertahap pembangunan kawasan (Semua tahapan pekerjaan harus 100% selesai untuk membuka Tambah Kavling)
                        </span>
                    </div>
                </div>
            </div>
            <div class="d-flex flex-wrap gap-2 align-items-center">
                <a href="{{ route('properti-all') }}" class="btn btn-outline-secondary btn-sm px-3 rounded-pill d-flex align-items-center gap-1 shadow-sm">
                    <i class="mdi mdi-arrow-left"></i> Kembali
                </a>
                <button type="button" class="btn btn-gradient-primary btn-sm px-3 rounded-pill d-flex align-items-center gap-1 shadow-sm" onclick="openAddStepModal(1)">
                    <i class="mdi mdi-plus-circle"></i> + Tambah Step / Pos
                </button>
                <!-- Validasi Legalitas Status Trigger -->
                @if($land->legal_status == 'verified' || $land->isFromPraLandbank())
                    <button type="button" class="btn btn-sm btn-outline-success px-3 rounded-pill d-flex align-items-center gap-1 shadow-sm" onclick="openLegalitasModal()" title="Status Legalitas Terverifikasi (Klik untuk ubah / cek berkas)">
                        <i class="mdi mdi-shield-check fs-6 text-success"></i> Legalitas: <strong>Terverifikasi</strong>
                    </button>
                @elseif($land->legal_status == 'rejected')
                    <button type="button" class="btn btn-sm btn-outline-danger px-3 rounded-pill d-flex align-items-center gap-1 shadow-sm" onclick="openLegalitasModal()" title="Status Legalitas Perlu Revisi">
                        <i class="mdi mdi-shield-alert fs-6 text-danger"></i> Legalitas: <strong>Revisi</strong>
                    </button>
                @else
                    <button type="button" class="btn btn-sm btn-outline-warning px-3 rounded-pill d-flex align-items-center gap-1 shadow-sm" onclick="openLegalitasModal()" title="Status Legalitas Menunggu Verifikasi">
                        <i class="mdi mdi-shield-clock fs-6 text-warning"></i> Legalitas: <strong>Pending</strong>
                    </button>
                @endif

                <a href="{{ route('master.bahan.index') }}" class="btn btn-outline-primary btn-sm px-3 rounded-pill d-flex align-items-center gap-1 shadow-sm">
                    <i class="mdi mdi-package-variant"></i> Master Bahan
                </a>

                @if($land->canCreateKavling())
                    <a href="{{ route('properti.buatKavling', $land->id) }}" class="btn btn-gradient-success btn-sm px-3 rounded-pill d-flex align-items-center gap-1 shadow-sm">
                        <i class="mdi mdi-pencil-ruler"></i> Tambah Kavling
                    </a>
                @else
                    <button type="button" class="btn btn-secondary btn-sm px-3 rounded-pill d-flex align-items-center gap-1 shadow-sm opacity-75" onclick="showKavlingLockedInfo()" title="Tambah Kavling Terkunci">
                        <i class="mdi mdi-lock"></i> Tambah Kavling
                    </button>
                @endif
            </div>
        </div>
    </div>

    <!-- Overall Progress & Dual Validation Rules Alert (Legalitas + Pengolahan Lahan) -->
    <div class="card border-0 shadow-sm rounded-4 mb-4 bg-white">
        <div class="card-body p-4">
            <div class="row align-items-center g-4">
                <div class="col-lg-7">
                    @php
                        $progress = $land->overall_infrastructure_progress;
                        $isDevSelesai = in_array(strtolower($land->development_status), ['selesai', 'done']) || $progress >= 100;
                        $isLegalValid = ($land->legal_status === 'verified') || $land->isFromPraLandbank();
                        $isCanKavling = $land->canCreateKavling();
                    @endphp
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="fw-bold text-dark fs-6">Progres Pengolahan Lahan:</span>
                        @if($isDevSelesai)
                            <span class="badge bg-success text-white py-2 px-3 rounded-pill fw-bold" id="headerStatusBadge">
                                <i class="mdi mdi-check-circle me-1"></i>Pembangunan Selesai (100%)
                            </span>
                        @elseif($progress > 0)
                            <span class="badge bg-warning text-dark py-2 px-3 rounded-pill fw-bold" id="headerStatusBadge">
                                <i class="mdi mdi-progress-wrench me-1"></i>Dalam Proses ({{ $progress }}%)
                            </span>
                        @else
                            <span class="badge bg-secondary text-white py-2 px-3 rounded-pill fw-bold" id="headerStatusBadge">
                                <i class="mdi mdi-clock-outline me-1"></i>Belum Dimulai
                            </span>
                        @endif
                    </div>

                    <div class="progress mb-2" style="height: 14px; border-radius: 10px; background: #e9ecef;">
                        <div class="progress-bar progress-bar-striped progress-bar-animated {{ $isDevSelesai ? 'bg-success' : ($progress > 0 ? 'bg-warning' : 'bg-primary') }}" 
                             id="headerProgressBar" 
                             role="progressbar" 
                             style="width: {{ $progress }}%; border-radius: 10px;"></div>
                    </div>

                    <div class="d-flex justify-content-between small text-muted">
                        <span>Total Akumulasi Progres: <b class="text-primary fs-6" id="headerProgressText">{{ $progress }}%</b></span>
                        @if($isCanKavling)
                            <span class="badge bg-soft-success text-success fw-bold"><i class="mdi mdi-lock-open-variant me-1"></i>Syarat Kavling Terpenuhi (Terbuka)</span>
                        @else
                            <span class="badge bg-soft-danger text-danger fw-bold"><i class="mdi mdi-lock me-1"></i>Kavling Terkunci</span>
                        @endif
                    </div>
                </div>

                <div class="col-lg-5 border-start-lg ps-lg-4">
                    <div class="p-3 rounded-3 border-0 small" style="background: #f8faff; border: 1px solid #dcd6f7 !important;">
                        <div class="d-flex justify-content-between align-items-center mb-2 pb-1 border-bottom">
                            <strong class="text-dark d-flex align-items-center gap-1">
                                <i class="mdi mdi-shield-lock-outline text-primary fs-5"></i> Validasi Syarat Tambah Kavling:
                            </strong>
                            @if($isCanKavling)
                                <span class="badge bg-success text-white rounded-pill px-2 py-1 small">Lolos Validasi</span>
                            @else
                                <span class="badge bg-danger text-white rounded-pill px-2 py-1 small">Belum Lengkap</span>
                            @endif
                        </div>

                        <!-- Rule 1: Validasi Legalitas Tanah -->
                        <div class="d-flex align-items-center justify-content-between py-1">
                            <span class="text-muted">1. Dokumen Legalitas Tanah:</span>
                            @if($isLegalValid)
                                <span class="badge bg-soft-success text-success fw-bold rounded-pill">
                                    <i class="mdi mdi-check-circle me-1"></i>Terverifikasi (Valid)
                                </span>
                            @elseif($land->legal_status === 'rejected')
                                <a href="javascript:void(0)" onclick="openLegalitasModal()" class="badge bg-soft-danger text-danger fw-bold rounded-pill text-decoration-none">
                                    <i class="mdi mdi-alert-circle me-1"></i>Ditolak / Revisi (Validasi)
                                </a>
                            @else
                                <a href="javascript:void(0)" onclick="openLegalitasModal()" class="badge bg-soft-warning text-warning fw-bold rounded-pill text-decoration-none">
                                    <i class="mdi mdi-clock-outline me-1"></i>Pending (Klik Validasi)
                                </a>
                            @endif
                        </div>

                        <!-- Rule 2: Pengolahan Lahan Selesai -->
                        <div class="d-flex align-items-center justify-content-between py-1">
                            <span class="text-muted">2. Fisik Pengolahan Lahan:</span>
                            @if($isDevSelesai)
                                <span class="badge bg-soft-success text-success fw-bold rounded-pill">
                                    <i class="mdi mdi-check-circle me-1"></i>100% Selesai
                                </span>
                            @else
                                <span class="badge bg-soft-secondary text-muted rounded-pill">
                                    <i class="mdi mdi-progress-clock me-1"></i>{{ $progress }}% / 100%
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- PHASE STEPPER NAVIGATION TABS (DINAMIS BERDASARKAN NAMA) -->
    <div class="fase-stepper mb-4" id="faseStepper" role="tablist">
        @foreach($phaseData as $phNum => $phInfo)
            @php
                $pProg = $phInfo['progress'];
            @endphp
            <button class="fase-step-btn {{ $loop->first ? 'active' : '' }}" id="step-fase{{ $phNum }}-tab" data-bs-toggle="pill" data-bs-target="#step-fase{{ $phNum }}" data-toggle="pill" data-target="#step-fase{{ $phNum }}" type="button" role="tab" onclick="activateTab('#step-fase{{ $phNum }}-tab')">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span class="step-number">{{ $phNum }}</span>
                    @if($pProg >= 100)
                        <span class="badge bg-success text-white rounded-pill small"><i class="mdi mdi-check"></i> Selesai</span>
                    @elseif($pProg > 0)
                        <span class="badge bg-warning text-dark rounded-pill small">Proses</span>
                    @else
                        <span class="badge bg-secondary text-white rounded-pill small">Belum</span>
                    @endif
                </div>
                <h6 class="fw-bold text-dark mb-1">{{ $phInfo['title'] }}</h6>
                <span class="small text-muted d-block text-truncate">{{ $phInfo['subtitle'] }}</span>
                <div class="progress mt-2" style="height: 6px;">
                    <div class="progress-bar bg-primary" style="width: {{ $pProg }}%;"></div>
                </div>
                <span class="small fw-bold text-primary mt-1 d-block text-end">{{ $pProg }}%</span>
            </button>
        @endforeach

        <!-- Button Quick Add Tahapan Baru in Stepper -->
        <button type="button" class="fase-step-btn d-flex flex-column align-items-center justify-content-center border-dashed" style="border: 2px dashed #9a55ff; background: #faf5ff; min-width: 180px;" onclick="openAddStepModal({{ $nextPhaseNum }})" title="Klik untuk menambah Tahapan Pembangunan Baru">
            <i class="mdi mdi-plus-circle text-primary fs-3 mb-1"></i>
            <span class="fw-bold text-primary small">+ Tambah Tahapan Baru</span>
            <small class="text-muted" style="font-size: 0.72rem;">Kustom Pembangunan</small>
        </button>

        <!-- Step: Rekapitulasi Keuangan -->
        <button class="fase-step-btn" id="step-keuangan-tab" data-bs-toggle="pill" data-bs-target="#step-keuangan" data-toggle="pill" data-target="#step-keuangan" type="button" role="tab" onclick="activateTab('#step-keuangan-tab')">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <span class="step-number"><i class="mdi mdi-cash-multiple"></i></span>
                <span class="badge bg-soft-danger text-danger rounded-pill small fw-bold">{{ $expenses->count() }} Nota</span>
            </div>
            <h6 class="fw-bold text-dark mb-1">Rekap Keuangan</h6>
            <span class="small text-muted d-block">Total Realisasi Belanja Bahan</span>
            <span class="fw-bold text-danger d-block mt-2 fs-6">Rp {{ number_format($totalExpense, 0, ',', '.') }}</span>
        </button>
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
                <div class="card border-0 shadow-sm rounded-4 bg-white p-4 mb-4">
                    <!-- Fase Header Info -->
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 pb-3 mb-4 border-bottom">
                        <div>
                            <div class="d-flex align-items-center gap-2">
                                <h5 class="fw-bold text-dark mb-0">{{ $phInfo['title'] }}</h5>
                            </div>
                            <span class="small text-muted mt-1 d-block">
                                {{ $phInfo['subtitle'] }}
                            </span>
                        </div>
                        <div class="d-flex flex-wrap gap-2">
                            <button type="button" class="btn btn-sm btn-gradient-primary rounded-pill px-3 shadow-sm" onclick="openAddStepModal({{ $phNum }})">
                                <i class="mdi mdi-plus-circle me-1"></i>+ Tambah Step ({{ $phInfo['title'] }})
                            </button>
                            <button type="button" class="btn btn-sm btn-outline-primary rounded-pill px-3" onclick="toggleInlineAddExpense({{ $phNum }})">
                                <i class="mdi mdi-plus-box me-1"></i>+ Catat Belanja Bahan
                            </button>
                            <button type="button" class="btn btn-sm btn-success rounded-pill px-3" onclick="finalizePhaseAction({{ $phNum }})">
                                <i class="mdi mdi-check-all me-1"></i>Selesaikan ({{ $phInfo['title'] }}) 100%
                            </button>
                        </div>
                    </div>

                    <!-- Inline Form Tambah Pengeluaran Bahan (Collapsible) -->
                    @include('properti.partials.inline_expense_form', ['phase' => $phNum, 'infrastructures' => $pItems])

                    <!-- Tasks Grid -->
                    <h6 class="fw-bold text-dark mb-3"><i class="mdi mdi-format-list-checks text-primary me-1"></i> Pos Pekerjaan Fisik: {{ $phInfo['title'] }}</h6>
                    <div class="row g-4 mb-4">
                        @forelse($pItems as $item)
                            @include('properti.partials.phase_item_card', ['item' => $item])
                        @empty
                            <div class="col-12">
                                <div class="p-4 text-center bg-light rounded-4 border border-dashed">
                                    <i class="mdi mdi-layers-plus text-primary fs-2 opacity-50 mb-2"></i>
                                    <h6 class="text-dark fw-bold mb-1">Belum Ada Pos Pekerjaan di {{ $phInfo['title'] }}</h6>
                                    <p class="small text-muted mb-3">Klik tombol di bawah untuk menambahkan rincian pekerjaan atau step untuk tahapan ini.</p>
                                    <button type="button" class="btn btn-sm btn-gradient-primary px-3 rounded-pill" onclick="openAddStepModal({{ $phNum }})">
                                        <i class="mdi mdi-plus-circle me-1"></i>+ Tambah Step Pertama
                                    </button>
                                </div>
                            </div>
                        @endforelse
                    </div>

                    <!-- Expenses Table -->
                    <div class="mt-4 pt-3 border-top">
                        <h6 class="fw-bold text-dark mb-3 d-flex justify-content-between align-items-center">
                            <span><i class="mdi mdi-receipt text-danger me-1"></i> Riwayat Belanja Bahan / Nota: {{ $phInfo['title'] }}</span>
                            <span class="badge bg-soft-danger text-danger">Total: Rp {{ number_format($pExpenses->sum('total_amount'), 0, ',', '.') }}</span>
                        </h6>
                        @include('properti.partials.phase_expense_table', ['phase' => $phNum, 'phaseExpenses' => $pExpenses])
                    </div>

                    <!-- Navigation Footer -->
                    <div class="d-flex justify-content-between gap-2 pt-4 border-top mt-4">
                        @if($prevTabTarget)
                            <button type="button" class="btn btn-outline-secondary px-4 rounded-pill" onclick="$('{{ $prevTabTarget }}').tab('show');">
                                <i class="mdi mdi-arrow-left me-1"></i> Kembali ke {{ $prevTitle }}
                            </button>
                        @else
                            <div></div>
                        @endif

                        @if($isLastPhase)
                            @if($land->canCreateKavling())
                                <a href="{{ route('properti.buatKavling', $land->id) }}" class="btn btn-gradient-success px-4 rounded-pill shadow-sm">
                                    <i class="mdi mdi-pencil-ruler me-1"></i> PENGOLAHAN SELESAI &rarr; Buat Unit Kavling
                                </a>
                            @else
                                <button type="button" class="btn btn-gradient-success px-4 rounded-pill shadow-sm" onclick="finalizeAllInfrastruktur()">
                                    <i class="mdi mdi-check-all me-1"></i> Selesaikan Seluruh Pengolahan Lahan (100%)
                                </button>
                            @endif
                        @else
                            <button type="button" class="btn btn-primary px-4 rounded-pill shadow-sm" onclick="$('{{ $nextTabTarget }}').tab('show');">
                                Lanjut ke {{ $nextTitle }} <i class="mdi mdi-arrow-right ms-1"></i>
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
                            <span class="text-muted small fw-bold">Total Belanja Realisasi</span>
                            <h4 class="fw-bold text-danger mb-0 mt-1">Rp {{ number_format($totalExpense, 0, ',', '.') }}</h4>
                            <span class="small text-muted">{{ $expenses->count() }} total transaksi</span>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="p-3 rounded-4 bg-light border">
                            <span class="text-muted small fw-bold">Lunas Terbayar</span>
                            <h4 class="fw-bold text-success mb-0 mt-1">Rp {{ number_format($totalLunas, 0, ',', '.') }}</h4>
                            <span class="small text-muted">{{ $expenses->where('payment_status', 'Lunas')->count() }} transaksi lunas</span>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="p-3 rounded-4 bg-light border">
                            <span class="text-muted small fw-bold">Hutang / Tempo Vendor</span>
                            <h4 class="fw-bold text-warning mb-0 mt-1">Rp {{ number_format($totalHutang, 0, ',', '.') }}</h4>
                            <span class="small text-muted">{{ $expenses->where('payment_status', '!=', 'Lunas')->count() }} belum lunas</span>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="p-3 rounded-4 bg-light border">
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
                    <h5 class="fw-bold text-dark mb-0"><i class="mdi mdi-cash-multiple text-danger me-1"></i> Seluruh Rekapitulasi Pengeluaran Bahan & Jasa</h5>
                </div>
                <div class="table-responsive bg-white rounded-4 border">
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
                                        <span class="badge bg-gradient-primary text-white rounded-pill small">Fase {{ $exp->phase ?? 1 }}</span>
                                    </td>
                                    <td>
                                        <strong class="text-dark d-block">{{ $exp->item_name }}</strong>
                                        @if($exp->category)
                                            <span class="badge bg-soft-primary text-primary small py-0 px-2 rounded-pill">{{ $exp->category }}</span>
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
                                            <span class="badge bg-soft-success text-success rounded-pill px-2 py-1 small fw-bold">Lunas</span>
                                        @else
                                            <span class="badge bg-soft-warning text-warning rounded-pill px-2 py-1 small fw-bold">Belum Lunas</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($exp->receipt_proof)
                                            <a href="{{ asset('storage/' . $exp->receipt_proof) }}" target="_blank" class="btn btn-sm btn-outline-info p-1 px-2 rounded-pill">
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
        <div class="modal-dialog modal-dialog-centered">
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
                                <input type="number" step="any" class="form-control" id="editTargetCostInput" name="cost_estimate" placeholder="0">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-top-0 pt-0">
                        <button type="button" class="btn btn-secondary rounded-pill px-3" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-gradient-primary rounded-pill px-4" id="btnSaveTarget">
                            <i class="mdi mdi-check me-1"></i>Simpan Perubahan Target
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Validasi Legalitas Tanah -->
    <div class="modal fade" id="modalValidasiLegalitas" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
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
                        <button type="button" class="btn btn-secondary rounded-pill px-3" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-gradient-primary rounded-pill px-4" id="btnSaveLegalitas">
                            <i class="mdi mdi-check me-1"></i>Simpan Status Validasi Legalitas
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Pos Pekerjaan / Step Baru (Dinamis oleh Kepala Legal / Admin) -->
    <div class="modal fade" id="modalAddStep" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content rounded-4 border-0 shadow">
                <div class="modal-header border-bottom-0 pb-0">
                    <h5 class="modal-title fw-bold text-dark d-flex align-items-center gap-2">
                        <i class="mdi mdi-plus-box-multiple text-primary fs-4"></i> Tambah Pos Pekerjaan (Step) Pengolahan Lahan
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formAddStep" onsubmit="submitAddStep(event)" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body pt-2">
                        <p class="small text-muted mb-3">
                            Tambahkan pos pekerjaan (step) baru secara dinamis untuk proyek <strong>{{ $land->name }}</strong>.
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
                                <input type="number" step="any" class="form-control" id="addStepCostEstimate" name="cost_estimate" placeholder="Contoh: 25000000">
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
                        <button type="button" class="btn btn-secondary rounded-pill px-3" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-gradient-primary rounded-pill px-4" id="btnSaveNewStep">
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
        if ($tab.length) {
            $('.fase-step-btn').removeClass('active');
            $tab.addClass('active');

            if (typeof $tab.tab === 'function') {
                $tab.tab('show');
            }

            let targetPane = $tab.attr('data-bs-target') || $tab.attr('data-target') || selector.replace('-tab', '');
            $('.tab-pane').removeClass('show active');
            $(targetPane).addClass('show active');

            setSavedActiveTab(selector);
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

    let phaseCategoryMap = {
        @foreach($phaseData as $phNum => $phInfo)
            {{ $phNum }}: "{{ addslashes($phInfo['title']) }}",
        @endforeach
    };

    window.toggleNewPhaseInput = function(phaseVal) {
        let maxExisting = {{ $nextPhaseNum - 1 }};
        if (parseInt(phaseVal) > maxExisting) {
            $('#newPhaseNameContainer').slideDown();
            $('#addStepNewPhaseName').prop('required', true).val('').focus();
            $('#categoryContainer').removeClass('col-md-6').addClass('col-md-12');
            $('#addStepCategory').val('');
        } else {
            $('#newPhaseNameContainer').slideUp();
            $('#addStepNewPhaseName').prop('required', false).val('');
            $('#categoryContainer').removeClass('col-md-12').addClass('col-md-6');
            if (phaseCategoryMap[phaseVal]) {
                $('#addStepCategory').val(phaseCategoryMap[phaseVal]);
            }
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
            $(`#inputPrice_${phase}_${rowIdx}`).val(price);
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
        if (!rowCounter[phase]) {
            rowCounter[phase] = 1;
        }
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
