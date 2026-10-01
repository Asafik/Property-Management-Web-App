@extends('layouts.partial.app')

@section('title', 'RAP Pembangunan - Property Management App')

@section('content')

    <style>
        .rab-info-card {
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.03);
            border: 1px solid #f0f2f5;
            padding: 1.25rem;
        }

        .rab-label {
            font-size: 0.78rem;
            font-weight: 600;
            color: #718096;
            margin-bottom: 0.35rem;
            display: flex;
            align-items: center;
        }

        .rab-form-control {
            width: 100%;
            padding: 0.5rem 0.75rem;
            font-size: 0.88rem;
            font-weight: 600;
            color: #2d3748;
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            transition: all 0.2s ease;
        }

        .rab-form-control:focus {
            outline: none;
            border-color: #9a55ff;
            background-color: #ffffff;
            box-shadow: 0 0 0 3px rgba(154, 85, 255, 0.12);
        }

        select.rab-form-control {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%239a55ff' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 0.75rem center;
            background-size: 12px;
            padding-right: 2rem;
            cursor: pointer;
        }

        .rab-card {
            border: none;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.04);
            margin-bottom: 1.5rem;
            background: #ffffff;
        }

        .rab-card-header {
            background: #ffffff !important;
            padding: 1rem 1.25rem;
            border-bottom: 1px solid #f0f2f5 !important;
        }

        .rab-card-header h5 {
            font-size: 0.95rem;
            font-weight: 700;
            color: #2c2e3f;
            margin: 0;
        }

        .rab-btn-add {
            background: linear-gradient(135deg, #da8cff, #9a55ff);
            color: #ffffff !important;
            border: none;
            border-radius: 6px;
            padding: 0.4rem 0.95rem;
            font-size: 0.8rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 4px;
            cursor: pointer;
            transition: all 0.2s ease;
            text-decoration: none;
            box-shadow: 0 2px 6px rgba(154, 85, 255, 0.25);
        }

        .rab-btn-add:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 10px rgba(154, 85, 255, 0.35);
            color: #ffffff !important;
        }

        .rab-table thead th {
            background-color: #f8f9fc !important;
            color: #4a5568 !important;
            font-size: 0.76rem !important;
            font-weight: 700 !important;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 0.75rem 0.65rem;
            border-bottom: 2px solid #e2e8f0;
            vertical-align: middle;
            text-align: center;
        }

        .rab-table tbody td {
            vertical-align: middle;
            padding: 0.5rem 0.65rem;
            font-size: 0.84rem;
            color: #2d3748;
        }

        .rab-table tfoot th {
            background-color: #f8f9fc !important;
            padding: 0.65rem 0.75rem;
            font-size: 0.84rem;
            vertical-align: middle;
        }

        .file-upload-modern {
            position: relative;
            width: 100%;
        }

        .file-upload-input {
            position: absolute;
            opacity: 0;
            width: 100%;
            height: 100%;
            cursor: pointer;
            z-index: 2;
        }

        .file-upload-label {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 4px;
            padding: 0.35rem 0.5rem;
            background: #f8fafc;
            border: 1px dashed #cbd5e1;
            border-radius: 6px;
            font-size: 0.78rem;
            color: #475569;
            cursor: pointer;
            transition: all 0.2s ease;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .file-upload-label:hover, .file-upload-label.file-selected {
            border-color: #9a55ff;
            background: #f3e8ff;
            color: #9a55ff;
        }

        .file-preview-btn {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 0.25rem 0.5rem;
            border-radius: 4px;
            background: rgba(154, 85, 255, 0.1);
            color: #9a55ff;
            font-size: 0.75rem;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .file-preview-btn:hover {
            background: #9a55ff;
            color: #ffffff;
        }

        .ringkasan-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 0.75rem;
        }

        .ringkasan-label {
            font-size: 0.85rem;
            color: #4a5568;
        }

        .ringkasan-input {
            width: 55%;
        }

        .ringkasan-divider {
            height: 1px;
            background-color: #e2e8f0;
            margin: 0.75rem 0;
        }

        .aksi-buttons {
            display: flex;
            gap: 0.5rem;
            margin-top: 1.25rem;
            flex-wrap: wrap;
        }

        .aksi-btn {
            flex: 1 1 auto;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            padding: 0.55rem 1rem;
            border-radius: 8px;
            font-size: 0.85rem;
            font-weight: 600;
            border: none;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.2s ease;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.08);
            color: #ffffff !important;
        }

        .aksi-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
        }

        .rab-btn-success {
            background: linear-gradient(135deg, #11998e, #38ef7d);
        }

        .rab-btn-primary {
            background: linear-gradient(135deg, #36d1dc, #5b86e5);
        }

        .rab-btn-warning {
            background: linear-gradient(135deg, #da8cff, #9a55ff);
        }

        .btn-action {
            width: 30px;
            height: 30px;
            padding: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 6px;
            transition: all 0.2s ease;
            border: none;
            cursor: pointer;
            font-size: 0.95rem;
            text-decoration: none;
            vertical-align: middle;
        }

        .btn-action:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
        }

        .btn-action.delete {
            background: linear-gradient(135deg, #dc3545, #e4606d) !important;
            color: #ffffff !important;
        }

        /* Badge Status Capaian Progress RAP */
        .badge-status-pill {
            font-size: 11px;
            font-weight: 700;
            padding: 4px 10px;
            border-radius: 6px;
            text-transform: uppercase;
            letter-spacing: 0.4px;
            display: inline-flex;
            align-items: center;
        }
        .badge-status-lunas {
            background: #dcfce7 !important;
            color: #15803d !important;
            border: 1px solid #bbf7d0 !important;
        }
        .badge-status-partial {
            background: #fef9c3 !important;
            color: #a16207 !important;
            border: 1px solid #fef08a !important;
        }
        .badge-status-pending {
            background: #fee2e2 !important;
            color: #b91c1c !important;
            border: 1px solid #fecaca !important;
        }

        /* CHECKLIST KONDISI UNIT */
        .survey-checklist-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 14px;
        }
        @media (max-width: 768px) {
            .survey-checklist-grid {
                grid-template-columns: 1fr;
                gap: 10px;
            }
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
            padding: 0.95rem 1.15rem;
            background: #ffffff;
            border: 2px solid #ede4ff;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.25s ease;
            margin-bottom: 0;
            min-height: 56px;
        }
        .survey-checkbox-label:hover {
            border-color: #c4a1ff;
            background: #faf7ff;
            transform: translateY(-1px);
        }
        .survey-check-icon {
            font-size: 1.35rem;
            color: #cbd5e1;
            transition: all 0.25s ease;
            flex-shrink: 0;
        }
        .survey-check-text {
            font-size: 0.9rem;
            font-weight: 700;
            color: #2c2e3f;
        }
        .survey-checkbox-input:checked + .survey-checkbox-label {
            border-color: #9a55ff;
            background: #fbf9ff;
            box-shadow: 0 4px 14px rgba(154, 85, 255, 0.16);
        }
        .survey-checkbox-input:checked + .survey-checkbox-label .survey-check-icon {
            color: #9a55ff;
        }
    </style>

    <div class="container-fluid px-2 px-sm-3 px-md-4 py-3">
        <!-- Header Card Banner -->
        <div class="row mb-3 mb-md-4">
            <div class="col-12">
                <div class="card shadow-sm border-0 header-card" style="border-radius: 12px;">
                    <div class="card-body p-3 p-md-4 d-flex justify-content-between align-items-center" style="min-height: 90px;">
                        <div>
                            <h3 class="text-dark mb-1 fw-bold" style="font-size: clamp(1.1rem, 2.5vw, 1.35rem);">
                                Rencana Anggaran Pekerjaan (RAP) Pembangunan
                            </h3>
                            <p class="text-muted mb-0" style="font-size: clamp(0.78rem, 1.8vw, 0.9rem);">
                                Rincian anggaran pekerjaan pembangunan unit dari awal hingga selesai
                            </p>
                        </div>
                        <div class="d-none d-sm-block pe-2">
                            <i class="mdi mdi-calculator" style="font-size: 2.8rem; color: #9a55ff; opacity: 0.25;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" style="border-radius: 10px;">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" style="border-radius: 10px;">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger" style="border-radius: 10px;">
                {{ $errors->first() }}
            </div>
        @endif

        <!-- Info Unit -->
        <div class="row mb-3 mb-md-4">
            <div class="col-12">
                <div class="card shadow-sm border-0 rab-info-card" style="border-radius: 12px;">
                    <div class="row g-2 g-md-3 align-items-center">
                        {{-- UNIT --}}
                        <div class="col-12 col-sm-6 col-lg-2">
                            <span class="rab-label">
                                <i class="mdi mdi-home text-primary me-1"></i>Unit
                            </span>
                            <select class="rab-form-control" id="unitSelect">
                                @foreach ($land->units as $unit)
                                    <option value="{{ $unit->id }}"
                                        {{ $unit->id == $selectedUnit->id ? 'selected' : '' }}
                                        data-type="{{ $unit->type }}" data-area="{{ $unit->area }}"
                                        data-building="{{ $unit->building_area }}" data-price="{{ $unit->price }}">
                                        {{ $unit->unit_code }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- TIPE / NAMA --}}
                        <div class="col-12 col-sm-6 col-lg-3">
                            <span class="rab-label">
                                <i class="mdi mdi-shape-outline text-info me-1"></i>Tipe / Nama
                            </span>
                            <input type="text" id="unitType" class="rab-form-control" readonly>
                        </div>

                        {{-- LUAS TANAH --}}
                        <div class="col-6 col-sm-6 col-lg-2">
                            <span class="rab-label">
                                <i class="mdi mdi-ruler-square text-warning me-1"></i>Luas Tanah
                            </span>
                            <input type="text" id="unitArea" class="rab-form-control" readonly>
                        </div>

                        {{-- LUAS BANGUNAN --}}
                        <div class="col-6 col-sm-6 col-lg-2">
                            <span class="rab-label">
                                <i class="mdi mdi-office-building-marker text-success me-1"></i>Luas Bangunan
                            </span>
                            <input type="text" id="unitBuilding" class="rab-form-control" readonly>
                        </div>

                        {{-- HARGA --}}
                        <div class="col-12 col-sm-12 col-lg-3">
                            <span class="rab-label">
                                <i class="mdi mdi-currency-usd text-danger me-1"></i>Harga Jual Unit
                            </span>
                            <input type="text" id="unitPrice" class="rab-form-control fw-bold text-success" readonly>
                        </div>
                    </div>
                </div>
            </div>
        @if(isset($selectedUnit))
            <form id="formApplyTemplate" action="{{ route('properti.progress.applyTemplate', $selectedUnit->id) }}" method="POST" style="display: none;">
                @csrf
            </form>
        @endif

        <form action="{{ route('properti.progress.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="land_bank_unit_id" value="{{ $selectedUnit->id }}">
            <input type="hidden" name="development_progress_id" value="{{ $selectedUnit->progress->id }}">
            <input type="hidden" name="title" value="Progress Pembangunan">

            @php
                $defaultKategoriConfig = [
                    'perizinan' => ['title' => 'I. PERIZINAN & LEGALITAS (PBG/IMB, SERTIFIKAT, DLL)', 'icon' => 'file-certificate-outline', 'prefix' => 'P'],
                    'persiapan' => ['title' => 'II. PEKERJAAN PERSIAPAN', 'icon' => 'tools', 'prefix' => '1'],
                    'pondasi'   => ['title' => 'III. PEKERJAAN PONDASI', 'icon' => 'foundation', 'prefix' => '2'],
                    'struktur'  => ['title' => 'IV. PEKERJAAN STRUKTUR', 'icon' => 'bridge', 'prefix' => '3'],
                    'dinding'   => ['title' => 'V. PEKERJAAN DINDING', 'icon' => 'wall', 'prefix' => '4'],
                    'atap'      => ['title' => 'VI. PEKERJAAN ATAP', 'icon' => 'roofing', 'prefix' => '5'],
                    'finishing' => ['title' => 'VII. PEKERJAAN FINISHING', 'icon' => 'brush', 'prefix' => '6'],
                    'lainnya'   => ['title' => 'VIII. PEKERJAAN LAINNYA', 'icon' => 'dots-horizontal', 'prefix' => '7'],
                ];

                $kategoriConfig = [];
                if (isset($masterCategories) && $masterCategories->count() > 0) {
                    foreach ($masterCategories as $mc) {
                        $kategoriConfig[$mc->slug] = [
                            'title'  => $mc->nama_kategori,
                            'icon'   => $mc->icon ?? 'folder-outline',
                            'prefix' => $mc->prefix ?? '1',
                        ];
                    }
                } else {
                    $kategoriConfig = $defaultKategoriConfig;
                }

                // Ambil semua kategori yang ada di item unit ini secara dinamis jika ada custom
                if ($selectedUnit->progress && $selectedUnit->progress->items) {
                    $existingCats = $selectedUnit->progress->items->pluck('kategori')->filter()->unique();
                    $counter = count($kategoriConfig);
                    foreach ($existingCats as $cat) {
                        $catKey = strtolower(trim($cat));
                        if (!isset($kategoriConfig[$catKey])) {
                            $counter++;
                            $kategoriConfig[$catKey] = [
                                'title'  => strtoupper($cat),
                                'icon'   => 'folder-outline',
                                'prefix' => (string)$counter,
                            ];
                        }
                    }
                }

                $jsKategoriMap = [];
                foreach ($kategoriConfig as $kKey => $cfg) {
                    $jsKategoriMap[$kKey] = [
                        'prefix'   => $cfg['prefix'],
                        'body'     => 'body-' . $kKey,
                        'subtotal' => 'subtotal-' . $kKey,
                    ];
                }
            @endphp

            @php
                $isUnitSoldOut = in_array(strtolower($selectedUnit->status ?? ''), ['sold', 'soldout']) || strtolower($selectedUnit->construction_progress ?? '') === 'selesai' || ($selectedUnit->progress && $selectedUnit->progress->status === 'completed');
            @endphp

            @if($isUnitSoldOut)
                <div class="alert alert-warning border-0 shadow-sm d-flex align-items-center gap-3 mb-4 p-3" style="border-radius: 10px; background: #fff8e6; color: #92400e; border-left: 4px solid #f59e0b !important;">
                    <i class="mdi mdi-lock-check fs-2 text-warning"></i>
                    <div>
                        <h6 class="mb-0 fw-bold">Unit Telah Selesai / Sold Out (Mode Read-Only)</h6>
                        <small class="text-muted">Rincian RAP dan seluruh tahapan progress pembangunan pada unit ini telah dikunci dan tidak dapat diubah lagi.</small>
                    </div>
                </div>
            @endif

            {{-- TOOLBAR DINAMIS: SEEDER TEMPLATE, TAMBAH KATEGORI & MENU MASTER --}}
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3 mb-3 mb-md-4 p-3 bg-white rounded-3 border shadow-sm">
                <div class="d-flex align-items-center gap-2 flex-wrap">
                    <h5 class="fw-bold text-dark mb-0" style="font-size: 1.05rem;">
                        Tahapan Pekerjaan Unit
                    </h5>
                    <span class="badge bg-primary bg-opacity-10 text-primary font-monospace px-2.5 py-1 rounded-2 fw-bold" style="font-size: 0.82rem;">
                        {{ count($kategoriConfig) }} Kategori
                    </span>
                </div>
                <div class="d-flex flex-wrap gap-2 w-100 w-md-auto justify-content-start justify-content-md-end">
                    <a href="{{ route('master.progress.index') }}" target="_blank" class="btn btn-sm btn-secondary text-white px-3 py-1.5 rounded-2 fw-semibold shadow-sm" style="font-size: 0.82rem;" title="Kelola Master Kategori & Item Template">
                        <i class="mdi mdi-cog-outline me-1"></i>Master Template
                    </a>
                    @if($isUnitSoldOut)
                        <button type="button" class="btn btn-sm btn-secondary shadow-sm px-3 py-1.5 rounded-2 fw-semibold opacity-75" disabled style="font-size: 0.82rem; cursor: not-allowed;" title="Unit Selesai / Sold Out">
                            <i class="mdi mdi-lock-outline me-1"></i>Terapkan Template (Terkunci)
                        </button>
                        <button type="button" class="btn btn-sm btn-secondary shadow-sm px-3 py-1.5 rounded-2 fw-semibold opacity-75" disabled style="font-size: 0.82rem; cursor: not-allowed;" title="Unit Selesai / Sold Out">
                            <i class="mdi mdi-lock-outline me-1"></i>Tambah Kategori (Terkunci)
                        </button>
                    @else
                        <button type="button" class="btn btn-sm btn-info text-white px-3 py-1.5 rounded-2 fw-semibold shadow-sm" style="font-size: 0.82rem;" onclick="confirmApplyTemplate()">
                            <i class="mdi mdi-flash me-1"></i>Terapkan Template
                        </button>
                        <button type="button" class="btn btn-sm btn-gradient-primary px-3 py-1.5 rounded-2 fw-semibold text-white shadow-sm" style="font-size: 0.82rem;" onclick="modalTambahKategoriBaru()">
                            <i class="mdi mdi-plus-circle-outline me-1"></i>Tambah Kategori
                        </button>
                    @endif
                </div>
            </div>

            <div id="dynamic-categories-container">
            @foreach ($kategoriConfig as $key => $cfg)
                @php
                    $catItems = $selectedUnit->progress ? $selectedUnit->progress->items->where('kategori', $key)->values() : collect();
                    $catItemCount = $catItems->count();
                    $catProgress = $catItemCount > 0 ? round($catItems->avg('progress_persen')) : 0;
                    
                    if ($catProgress == 100) {
                        $badgeClass = 'badge-status-lunas';
                        $badgeIcon = 'mdi-check-circle';
                        $badgeText = 'Selesai';
                    } elseif ($catProgress > 0) {
                        $badgeClass = 'badge-status-partial';
                        $badgeIcon = 'mdi-progress-wrench';
                        $badgeText = 'Sedang Berjalan';
                    } else {
                        $badgeClass = 'badge-status-pending';
                        $badgeIcon = 'mdi-clock-outline';
                        $badgeText = 'Belum Berjalan';
                    }
                @endphp
                <div class="row mb-3 mb-md-4 category-section" id="section-{{ $key }}">
                    <div class="col-12">
                        <div class="card shadow-sm border-0 rab-card" style="border-radius: 12px; overflow: hidden;">
                            <div class="card-header bg-light bg-opacity-75 d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-2 py-2.5 px-3 px-md-4 border-bottom">
                                <div class="d-flex align-items-center gap-2 flex-wrap">
                                    <span class="badge bg-primary bg-opacity-10 text-primary font-monospace px-2.5 py-1 rounded-2 fw-bold" style="font-size: 0.82rem;">
                                        Prefix: {{ $cfg['prefix'] }}
                                    </span>
                                    <h6 class="mb-0 fw-bold text-dark d-flex align-items-center" style="font-size: 0.98rem;">
                                        <i class="mdi mdi-{{ $cfg['icon'] ?? 'folder-outline' }} me-2" style="color: #9a55ff; font-size: 1.15rem;"></i>
                                        {{ $cfg['title'] }}
                                    </h6>
                                </div>

                                <div class="d-flex align-items-center gap-2 flex-wrap ms-md-auto">
                                    <!-- Badge Status Capaian -->
                                    <span class="badge-status-pill {{ $badgeClass }}" id="badge-status-{{ $key }}">
                                        <i class="mdi {{ $badgeIcon }} me-1"></i><span class="status-text">{{ $badgeText }}</span>
                                    </span>

                                    <!-- Mini Progress Bar & Persentase -->
                                    <div class="d-flex align-items-center gap-1.5 px-2 py-1 bg-white border rounded-2" style="min-width: 120px;">
                                        <div class="progress flex-grow-1" style="height: 6px; border-radius: 4px; background: #e2e8f0; width: 60px;">
                                            <div class="progress-bar bg-gradient-primary" id="progbar-{{ $key }}" style="width: {{ $catProgress }}%;"></div>
                                        </div>
                                        <span class="fw-bold font-monospace text-primary" id="progpct-{{ $key }}" style="font-size: 0.8rem; width: 38px; text-align: right;">{{ $catProgress }}%</span>
                                    </div>

                                    @if(!$isUnitSoldOut)
                                        <button type="button" class="btn btn-sm btn-success text-white px-3 py-1 rounded-2 fw-semibold shadow-sm d-inline-flex align-items-center gap-1" style="height: 30px; font-size: 0.8rem;" onclick="tambahItem('{{ $key }}')">
                                            + Tambah Item
                                        </button>
                                    @endif
                                </div>
                            </div>

                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-hover table-bordered align-middle mb-0 rab-table">
                                        <thead>
                                            <tr>
                                                <th style="width: 50px;">NO</th>
                                                <th>URAIAN</th>
                                                <th style="width: 85px;">VOLUME</th>
                                                <th style="width: 75px;">SATUAN</th>
                                                <th style="width: 130px;">HARGA</th>
                                                <th style="width: 140px;">TOTAL</th>
                                                <th>KETERANGAN</th>
                                                <th style="width: 100px;">PROGRESS</th>
                                                <th style="width: 130px;">DEADLINE</th>
                                                <th style="width: 140px;">DOKUMENTASI</th>
                                                <th style="width: 175px; background: linear-gradient(135deg, #f0fdf4, #eff6ff); color: #374151;" title="Opname Mingguan & Pembayaran Termin per uraian">OPNAME &amp; TERMIN</th>
                                                <th style="width: 60px;">AKSI</th>
                                            </tr>
                                        </thead>
                                        <tbody id="body-{{ $key }}">
                                            {{-- DATA DARI DB --}}
                                            @if ($selectedUnit->progress && $catItems->count() > 0)
                                                @foreach ($catItems as $item)
                                                    <tr>
                                                        <td style="display:none;">
                                                             <input type="hidden" name="items[{{ $item->id }}][id]"
                                                                value="{{ $item->id }}">
                                                        </td>

                                                        <td class="text-center fw-bold text-muted">{{ $loop->iteration }}</td>

                                                        <td class="fw-semibold">{{ $item->uraian }}</td>

                                                        <td class="text-center">{{ $item->volume }}</td>

                                                        <td class="text-center">{{ $item->satuan }}</td>

                                                        <td class="text-end">Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}</td>

                                                        <td class="text-end fw-bold text-success">Rp {{ number_format($item->total, 0, ',', '.') }}</td>

                                                        <td>{{ $item->keterangan ?? '-' }}</td>

                                                        <!-- Kolom Capaian Progress Item -->
                                                        <td class="text-center">
                                                            <div class="input-group input-group-sm" style="width: 80px; margin: 0 auto;">
                                                                <input type="number" min="0" max="100" name="items[{{ $item->id }}][progress_persen]"
                                                                    class="form-control form-control-sm text-center font-monospace fw-bold item-progress-input"
                                                                    style="border-radius: 6px 0 0 6px; padding: 2px 4px; font-size: 0.82rem;"
                                                                    value="{{ $item->progress_persen ?? 0 }}"
                                                                    oninput="hitungSemua();" placeholder="0">
                                                                <span class="input-group-text px-1 bg-light text-muted" style="border-radius: 0 6px 6px 0; font-size: 11px;">%</span>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <input type="date" name="deadline[{{ $item->id }}]"
                                                                class="form-control form-control-sm" style="border-radius: 6px;"
                                                                value="{{ $item->deadline ? $item->deadline->format('Y-m-d') : '' }}">
                                                        </td>

                                                        <td>
                                                            @php $documents = $item->documents; @endphp

                                                            @if ($documents->count())
                                                                <div class="d-flex flex-wrap gap-1 mb-1">
                                                                    @foreach ($documents as $doc)
                                                                        @php
                                                                            $docRaw = $doc->file_path;
                                                                            $docClean = ltrim(preg_replace('/^(storage\/)+/', '', $docRaw), '/');
                                                                            $docUrl = str_starts_with($docRaw, 'http')
                                                                                ? $docRaw
                                                                                : (str_starts_with($docRaw, 'uploads/') ? asset($docRaw) : (file_exists(public_path($docRaw)) ? asset($docRaw) : asset('storage/' . $docClean)));
                                                                        @endphp
                                                                        <a href="{{ $docUrl }}"
                                                                            target="_blank" class="file-preview-btn">
                                                                            <i class="mdi mdi-eye"></i>
                                                                            <span>Lihat ({{ $loop->iteration }})</span>
                                                                        </a>
                                                                    @endforeach
                                                                </div>
                                                            @endif

                                                            <div class="file-upload-modern">
                                                                <input type="file"
                                                                       name="items[{{ $item->id }}][dokumentasi]"
                                                                       id="file-existing-{{ $item->id }}"
                                                                       class="file-upload-input"
                                                                       accept=".jpg,.jpeg,.png,.webp,.pdf,.doc,.docx"
                                                                       onchange="handleFileSelect(this, 'existing-{{ $item->id }}')">
                                                                <div class="file-upload-label" id="label-existing-{{ $item->id }}">
                                                                    <i class="mdi mdi-cloud-upload text-primary me-1"></i>
                                                                    <span id="fileName-existing-{{ $item->id }}">{{ $documents->count() ? 'Tambah file' : 'Pilih file' }}</span>
                                                                    <span class="file-upload-size" id="fileSize-existing-{{ $item->id }}"></span>
                                                                </div>
                                                            </div>
                                                        </td>

                                                        {{-- Kolom Opname & Termin per Uraian --}}
                                                        @php
                                                            $itemOpnames = $item->opnames()->latest()->take(2)->get();
                                                            $itemTermins = $item->termins()->latest()->take(2)->get();
                                                            $totalItemOpname = $item->opnames()->count();
                                                            $totalItemTermin = $item->termins()->count();
                                                        @endphp
                                                        <td class="p-0" style="vertical-align: top; min-width: 175px;">
                                                            <div style="font-size: 0.75rem;">
                                                                {{-- Opname Mingguan --}}
                                                                <div class="px-2 py-1.5 border-bottom" style="background: rgba(16,185,129,0.04);">
                                                                    <div class="d-flex align-items-center justify-content-between mb-1">
                                                                        <span class="fw-bold text-success" style="font-size: 0.7rem;"><i class="mdi mdi-clipboard-text-outline me-1"></i>Opname ({{ $totalItemOpname }})</span>
                                                                        @if(!$isUnitSoldOut)
                                                                        <button type="button" class="btn btn-xs py-0 px-1.5 btn-outline-success rounded-1 shadow-none"
                                                                            style="font-size: 0.68rem; line-height: 1.5;"
                                                                            onclick="modalOpnamePerItem({{ $item->id }}, '{{ addslashes($item->uraian) }}', {{ $item->progress_persen ?? 0 }})">
                                                                            <i class="mdi mdi-plus"></i> Tambah
                                                                        </button>
                                                                        @endif
                                                                    </div>
                                                                    @forelse($itemOpnames as $iop)
                                                                        <div class="d-flex align-items-center justify-content-between gap-1 mb-0.5">
                                                                            <span style="color:#6b7280; font-size:0.68rem;">Mg {{ $iop->minggu_ke }}</span>
                                                                            <span style="background:#d1fae5; color:#059669; font-size:0.65rem; padding:1px 5px; border-radius:4px; font-weight:700;">+{{ number_format($iop->progress_minggu_ini, 1) }}%</span>
                                                                            <span style="background:#dbeafe; color:#2563eb; font-size:0.65rem; padding:1px 5px; border-radius:4px; font-weight:700;">{{ number_format($iop->progress_kumulatif, 1) }}%</span>
                                                                        </div>
                                                                    @empty
                                                                        <span style="color:#9ca3af; font-size:0.68rem;">Belum ada opname</span>
                                                                    @endforelse
                                                                </div>
                                                                {{-- Pembayaran Termin --}}
                                                                <div class="px-2 py-1.5" style="background: rgba(59,130,246,0.04);">
                                                                    <div class="d-flex align-items-center justify-content-between mb-1">
                                                                        <span class="fw-bold text-primary" style="font-size: 0.7rem;"><i class="mdi mdi-cash-multiple me-1"></i>Termin ({{ $totalItemTermin }})</span>
                                                                        @if(!$isUnitSoldOut)
                                                                        <button type="button" class="btn btn-xs py-0 px-1.5 btn-outline-primary rounded-1 shadow-none"
                                                                            style="font-size: 0.68rem; line-height: 1.5;"
                                                                            onclick="modalTerminPerItem({{ $item->id }}, '{{ addslashes($item->uraian) }}', {{ (float)$item->total }})">
                                                                            <i class="mdi mdi-plus"></i> Tambah
                                                                        </button>
                                                                        @endif
                                                                    </div>
                                                                    @forelse($itemTermins as $itr)
                                                                        <div class="d-flex align-items-center justify-content-between gap-1 mb-0.5">
                                                                            <span style="color:#6b7280; font-size:0.68rem; max-width:65px; overflow:hidden; text-overflow:ellipsis; white-space:nowrap; display:inline-block;">{{ $itr->nama_termin }}</span>
                                                                            @php
                                                                                $tBg = match($itr->status) {
                                                                                    'dibayar'   => ['#d1fae5','#059669'],
                                                                                    'disetujui' => ['#cffafe','#0891b2'],
                                                                                    'diajukan'  => ['#fef3c7','#d97706'],
                                                                                    'ditolak'   => ['#fee2e2','#dc2626'],
                                                                                    default     => ['#f3f4f6','#6b7280'],
                                                                                };
                                                                            @endphp
                                                                            <span style="background:{{ $tBg[0] }}; color:{{ $tBg[1] }}; font-size:0.62rem; padding:1px 5px; border-radius:4px; font-weight:700; white-space:nowrap;">{{ $itr->status_label }}</span>
                                                                        </div>
                                                                    @empty
                                                                        <span style="color:#9ca3af; font-size:0.68rem;">Belum ada termin</span>
                                                                    @endforelse
                                                                </div>
                                                            </div>
                                                        </td>

                                                        <td class="text-center">
                                                            <button type="button" class="btn-action delete"
                                                                onclick="hapusItem(this, '{{ $key }}', {{ $item->id }})" title="Hapus Item">
                                                                <i class="mdi mdi-trash-can-outline"></i>
                                                            </button>
                                                        </td>

                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="13" class="text-center text-muted py-3">
                                                        Belum ada progress untuk kategori ini
                                                    </td>
                                                </tr>
                                            @endif
                                        </tbody>
                                        <tfoot>
                                            <tr class="bg-light bg-opacity-75" style="border-top: 1px solid #e2e8f0;">
                                                <td colspan="5" class="text-start ps-3 ps-md-4 fw-bold text-dark small py-2.5">
                                                    Subtotal {{ $cfg['title'] }}
                                                </td>
                                                <td colspan="8" class="text-end pe-3 pe-md-4 py-2.5">
                                                    <span id="subtotal-display-{{ $key }}" class="font-monospace fw-bold text-success" style="font-size: 1rem;">
                                                        Rp 0
                                                    </span>
                                                    <input type="hidden" id="subtotal-{{ $key }}" value="0">
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            </div>

            {{-- Rincian RAP --}}
            @php
                $isAccCompleted = ($selectedUnit->progress && $selectedUnit->progress->status === 'completed') || $selectedUnit->construction_progress === 'selesai';
                $isUnitSoldOut  = in_array(strtolower($selectedUnit->status ?? ''), ['sold', 'soldout']) || $isAccCompleted;
                $subtotalPerizinan = $items->where('kategori', 'perizinan')->sum(fn($item) => $item->total);
                $subtotalRumah = $items->where('kategori', '!=', 'perizinan')->sum(fn($item) => $item->total);
                $subtotal = $items->sum(fn($item) => $item->total);
                $ppn = round($subtotal * 0.1);
                $totalRAB = $subtotal + $ppn;

                if ($isAccCompleted) {
                    $finalPrice = $selectedUnit->price ?? 0;
                    $unitPrice = max(0, $finalPrice - $totalRAB);
                } else {
                    $unitPrice = $selectedUnit->price ?? 0;
                    $finalPrice = $totalRAB + $unitPrice;
                }
            @php
                $savedChecklist = $selectedUnit->progress->checklist_kondisi ?? [];
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

                $isFirstTime = empty($savedChecklist);
                $checkedCount = 0;
                foreach ($kondisiItems as $f => $l) {
                    if ($isFirstTime || !empty($savedChecklist[$f])) {
                        $checkedCount++;
                    }
                }
            @endphp

            <!-- Checklist Kondisi Unit -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card shadow-sm border-0 rab-card" style="border-radius: 12px; overflow: hidden;">
                        <div class="card-header bg-light bg-opacity-75 d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center gap-2 py-3 px-3 px-md-4 border-bottom">
                            <div class="d-flex align-items-center gap-2">
                                <span class="badge font-monospace px-2.5 py-1 rounded-2 fw-bold" style="background: rgba(154, 85, 255, 0.12); color: #9a55ff; font-size: 0.85rem;">
                                    <i class="mdi mdi-checkbox-marked-circle-outline"></i>
                                </span>
                                <div>
                                    <h6 class="mb-0 fw-bold text-dark d-flex align-items-center" style="font-size: 0.98rem;">
                                        Checklist Kondisi Unit
                                    </h6>
                                    <small class="text-muted">Pemeriksaan kondisi fisik dan kelayakan unit sebelum proses serah terima</small>
                                </div>
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <span class="badge" id="badgeChecklistStatus" style="background: #eef2ff; color: #4f46e5; font-size: 0.82rem; font-weight: 700; padding: 0.4rem 0.85rem; border-radius: 20px; border: 1px solid #c7d2fe;">
                                    <span id="checklistCountText">{{ $checkedCount }}</span> / {{ count($kondisiItems) }} Kondisi Terpenuhi
                                </span>
                            </div>
                        </div>
                        <div class="card-body p-3 p-md-4">
                            <div class="survey-checklist-grid">
                                @foreach ($kondisiItems as $field => $label)
                                    @php
                                        $isChecked = $isFirstTime ? true : (!empty($savedChecklist[$field]));
                                    @endphp
                                    <div class="survey-checkbox-wrapper">
                                        <input type="checkbox" class="survey-checkbox-input unit-checklist-input" id="chk_kondisi_{{ $field }}"
                                            name="checklist_kondisi[{{ $field }}]" value="1" {{ $isChecked ? 'checked' : '' }}
                                            data-field="{{ $field }}" data-unit-id="{{ $selectedUnit->id }}">
                                        <label class="survey-checkbox-label" for="chk_kondisi_{{ $field }}">
                                            <i class="mdi mdi-check-circle survey-check-icon"></i>
                                            <span class="survey-check-text">{{ $label }}</span>
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bagian Rincian RAP - Yang Diperbaiki -->
            <div class="row">
                <!-- Ringkasan RAP -->
                <div class="col-12 col-md-6">
                    <div class="card shadow-sm border-0 mb-3" style="border-radius: 12px;">
                        <div class="card-body">
                            <h6 class="card-title fw-bold text-dark mb-3">
                                <i class="mdi mdi-chart-pie me-2" style="color: #9a55ff;"></i>Ringkasan RAP Terpadu
                            </h6>

                            <div class="ringkasan-row">
                                <span class="ringkasan-label">Biaya Perizinan & Legalitas</span>
                                <div class="ringkasan-input">
                                    <input type="text" id="summary-perizinan" class="rab-form-control text-end fw-bold text-info"
                                        value="Rp {{ number_format($subtotalPerizinan, 0, ',', '.') }}" readonly>
                                </div>
                            </div>

                            <div class="ringkasan-row">
                                <span class="ringkasan-label">Biaya Konstruksi Fisik Rumah</span>
                                <div class="ringkasan-input">
                                    <input type="text" id="summary-rumah" class="rab-form-control text-end fw-bold text-dark"
                                        value="Rp {{ number_format($subtotalRumah, 0, ',', '.') }}" readonly>
                                </div>
                            </div>

                            <div class="ringkasan-row">
                                <span class="ringkasan-label">Subtotal Semua Pekerjaan</span>
                                <div class="ringkasan-input">
                                    <input type="text" id="summary-subtotal" class="rab-form-control text-end fw-bold"
                                        value="Rp {{ number_format($subtotal, 0, ',', '.') }}" readonly>
                                </div>
                            </div>

                            <div class="ringkasan-row">
                                <span class="ringkasan-label">PPN (10%)</span>
                                <div class="ringkasan-input">
                                    <input type="text" id="summary-ppn" class="rab-form-control text-end fw-bold"
                                        value="Rp {{ number_format($ppn, 0, ',', '.') }}" readonly>
                                </div>
                            </div>

                            <div class="ringkasan-divider"></div>

                            <div class="ringkasan-row">
                                <span class="ringkasan-label fw-bold">Total RAP (Masuk HPP)</span>
                                <div class="ringkasan-input">
                                    <input type="text" id="summary-total-rab" class="rab-form-control text-end fw-bold text-primary"
                                        value="Rp {{ number_format($totalRAB, 0, ',', '.') }}" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Harga Jual Final -->
                <div class="col-12 col-md-6">
                    <div class="card shadow-sm border-0 mb-3" style="border-radius: 12px;">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h6 class="card-title fw-bold text-dark mb-0">
                                    <i class="mdi mdi-cash-check me-2" style="color: #28a745;"></i>Harga Jual Final
                                </h6>
                                @if($isAccCompleted)
                                    <span class="badge bg-success bg-opacity-10 text-success fw-bold px-2 py-1" style="font-size: 0.75rem; border-radius: 6px;">
                                        <i class="mdi mdi-check-circle me-1"></i>Telah Di-ACC
                                    </span>
                                @endif
                            </div>

                            <input type="hidden" name="price" value="{{ $finalPrice }}">

                            <div class="ringkasan-row">
                                <span class="ringkasan-label">Total RAP</span>
                                <div class="ringkasan-input">
                                    <input type="text" id="summary-total-rab-final" class="rab-form-control text-end fw-bold"
                                        value="Rp {{ number_format($totalRAB, 0, ',', '.') }}" readonly>
                                </div>
                            </div>

                            <div class="ringkasan-row">
                                <span class="ringkasan-label">{{ $isAccCompleted ? 'Harga Awal Unit' : 'Harga Jual Unit' }}</span>
                                <div class="ringkasan-input">
                                    <input type="text" id="summary-unit-price" class="rab-form-control text-end fw-bold"
                                        value="Rp {{ number_format($unitPrice, 0, ',', '.') }}" readonly>
                                </div>
                            </div>

                            <div class="ringkasan-divider"></div>

                            <div class="ringkasan-row">
                                <span class="ringkasan-label fw-bold">TOTAL FINAL</span>
                                <div class="ringkasan-input">
                                    <input type="text" id="summary-final-price" class="rab-form-control text-end fw-bold text-success"
                                        value="Rp {{ number_format($finalPrice, 0, ',', '.') }}" readonly>
                                </div>
                            </div>

                            <!-- Tombol aksi - TETAP DI DALAM CARD Harga Jual Final -->
                            <div class="aksi-buttons">
                                @if($isUnitSoldOut)
                                    <button type="button" class="aksi-btn" style="background: #6c757d; cursor: not-allowed; opacity: 0.85;" disabled title="Unit ini telah selesai / sold out (Read Only)">
                                        <i class="mdi mdi-lock-check me-1"></i>Terkunci (Sold Out)
                                    </button>
                                @else
                                    <button type="submit" class="aksi-btn rab-btn-success">
                                        <i class="mdi mdi-content-save me-1"></i>Simpan
                                    </button>
                                @endif

                                <a href="{{ route('cetak.rab', $selectedUnit->id) }}" target="_blank"
                                    class="aksi-btn rab-btn-primary">
                                    <i class="mdi mdi-printer me-1"></i>Cetak RAP
                                </a>

                                @if ($isAccCompleted || $isUnitSoldOut)
                                    <button type="button" class="aksi-btn" style="background: #6c757d; cursor: not-allowed; opacity: 0.85;" disabled title="RAP untuk unit ini sudah di-ACC / Selesai">
                                        <i class="mdi mdi-check-all me-1"></i>Sudah di-ACC
                                    </button>
                                @else
                                    <button type="button" class="aksi-btn rab-btn-warning acc-btn"
                                        data-id="{{ $selectedUnit->id }}">
                                        <i class="mdi mdi-check me-1"></i>ACC RAP
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <!-- Form Hidden untuk Apply Template Standar RAP -->
        <form id="formApplyTemplate" action="{{ route('properti.progress.applyTemplate', $selectedUnit->id) }}" method="POST" style="display: none;">
            @csrf
        </form>

        {{-- ============================================================
             OPNAME MINGGUAN
        ============================================================ --}}
        @php
            $isUnitSoldOut = in_array(strtolower($selectedUnit->status ?? ''), ['sold', 'soldout']) || strtolower($selectedUnit->construction_progress ?? '') === 'selesai' || ($selectedUnit->progress && $selectedUnit->progress->status === 'completed');
            $totalOpname = $opnameMingguan->count();
            $latestKumulatif = $opnameMingguan->last()?->progress_kumulatif ?? 0;

            // Siapkan payload item RAP per uraian untuk modal Opname Mingguan
            $rapItemsCollection = $selectedUnit->progress && $selectedUnit->progress->items
                ? $selectedUnit->progress->items->values()
                : collect();
            $totalRapBudget = $rapItemsCollection->sum('total');
            $rapItemsPayload = $rapItemsCollection->map(function($it, $idx) use ($totalRapBudget, $rapItemsCollection) {
                $bobot = $totalRapBudget > 0 
                    ? round(($it->total / $totalRapBudget) * 100, 2) 
                    : ($rapItemsCollection->count() > 0 ? round(100 / $rapItemsCollection->count(), 2) : 0);
                return [
                    'id'              => $it->id,
                    'kategori'        => $it->kategori,
                    'kode'            => $it->kode ?: ('Item ' . ($idx + 1)),
                    'uraian'          => $it->uraian,
                    'volume'          => $it->volume,
                    'satuan'          => $it->satuan,
                    'harga_satuan'    => (float)$it->harga_satuan,
                    'total'           => (float)$it->total,
                    'bobot'           => $bobot,
                    'progress_persen' => (float)($it->progress_persen ?? 0),
                ];
            });
        @endphp

        {{-- ============================================================
             MODAL: TAMBAH OPNAME MINGGUAN (PER URAIAN PEKERJAAN RAP)
        ============================================================ --}}
        <div class="modal fade" id="modalTambahOpnameModal" tabindex="-1" aria-labelledby="modalTambahOpnameLabel" aria-hidden="true" data-bs-backdrop="static">
            <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content border-0 shadow-lg" style="border-radius: 16px; overflow: hidden;">
                    <div class="modal-header py-3 px-4" style="background: linear-gradient(135deg, #059669, #10b981); color: #fff;">
                        <div class="d-flex align-items-center gap-3">
                            <div style="width: 44px; height: 44px; border-radius: 12px; background: rgba(255,255,255,0.2); display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                                <i class="mdi mdi-clipboard-text-play-outline"></i>
                            </div>
                            <div>
                                <h5 class="modal-title fw-bold mb-0 text-white" id="modalTambahOpnameLabel">Input Laporan Opname Mingguan</h5>
                                <small class="text-white-50">Unit: <strong class="text-white">{{ $selectedUnit->nama_unit ?? ('Unit #' . $selectedUnit->unit_code) }}</strong> · Catat capaian fisik mingguan & kumulatif per rincian uraian RAP</small>
                            </div>
                        </div>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body p-4 bg-light bg-opacity-50">
                        <!-- Info Periode & Pekerja -->
                        <div class="card border-0 shadow-xs mb-3" style="border-radius: 12px;">
                            <div class="card-body p-3">
                                <div class="row g-3">
                                    <div class="col-md-2 col-6">
                                        <label class="form-label small fw-bold text-muted mb-1"><i class="mdi mdi-numeric me-1 text-primary"></i>Minggu Ke <span class="text-danger">*</span></label>
                                        <input type="number" id="opname_minggu_ke" class="form-control form-control-sm fw-bold font-monospace" min="1" value="1">
                                    </div>
                                    <div class="col-md-2 col-6">
                                        <label class="form-label small fw-bold text-muted mb-1"><i class="mdi mdi-account-group me-1 text-primary"></i>Jml Pekerja</label>
                                        <input type="number" id="opname_pekerja" class="form-control form-control-sm" placeholder="0" min="0">
                                    </div>
                                    <div class="col-md-4 col-6">
                                        <label class="form-label small fw-bold text-muted mb-1"><i class="mdi mdi-calendar-start me-1 text-primary"></i>Tgl Mulai Minggu <span class="text-danger">*</span></label>
                                        <input type="date" id="opname_tgl_mulai" class="form-control form-control-sm">
                                    </div>
                                    <div class="col-md-4 col-6">
                                        <label class="form-label small fw-bold text-muted mb-1"><i class="mdi mdi-calendar-end me-1 text-primary"></i>Tgl Selesai Minggu <span class="text-danger">*</span></label>
                                        <input type="date" id="opname_tgl_akhir" class="form-control form-control-sm">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Capaian Rincian Uraian Pekerjaan (RAP) -->
                        <div class="card border-0 shadow-xs mb-3" style="border-radius: 12px; overflow: hidden;">
                            <div class="card-header bg-white py-2.5 px-3 border-bottom d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-2">
                                <div class="d-flex align-items-center gap-2">
                                    <i class="mdi mdi-format-list-checks text-success fs-5"></i>
                                    <h6 class="mb-0 fw-bold text-dark" style="font-size: 0.95rem;">Rincian Progres Per Uraian Pekerjaan RAP</h6>
                                </div>
                                <div class="d-flex align-items-center gap-2 flex-wrap">
                                    <button type="button" class="btn btn-xs btn-outline-secondary py-1 px-2.5 rounded-2" onclick="setSemua100Opname()">
                                        <i class="mdi mdi-check-all me-1 text-success"></i>Set Semua 100%
                                    </button>
                                    <button type="button" class="btn btn-xs btn-outline-secondary py-1 px-2.5 rounded-2" onclick="resetSemuaProgresOpname()">
                                        <i class="mdi mdi-refresh me-1 text-warning"></i>Reset 0%
                                    </button>
                                    <div class="vr mx-1 d-none d-md-block"></div>
                                    <div class="px-2.5 py-1 rounded-2 fw-semibold d-inline-flex align-items-center" style="font-size: 0.8rem; background-color: #d1fae5; color: #065f46; border: 1px solid #6ee7b7;">
                                        Capaian Mg Ini:&nbsp;<span id="badgeProgMingguIni" class="fw-bold fs-6" style="color: #047857;">0.0%</span>
                                    </div>
                                    <div class="px-2.5 py-1 rounded-2 fw-semibold d-inline-flex align-items-center" style="font-size: 0.8rem; background-color: #dbeafe; color: #1e40af; border: 1px solid #93c5fd;">
                                        Kumulatif:&nbsp;<span id="badgeProgKumulatif" class="fw-bold fs-6" style="color: #1d4ed8;">0.0%</span>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body p-0">
                                <div class="table-responsive" style="max-height: 380px; overflow-y: auto;">
                                    <table class="table table-sm table-hover align-middle mb-0" style="font-size: 0.82rem;">
                                        <thead class="table-light sticky-top" style="z-index: 2; font-size: 0.75rem; text-transform: uppercase;">
                                            <tr>
                                                <th class="px-3 py-2 text-center" style="width: 50px;">No</th>
                                                <th class="px-2 py-2" style="min-width: 200px;">Uraian Pekerjaan</th>
                                                <th class="px-2 py-2 text-center" style="width: 90px;">Vol / Sat</th>
                                                <th class="px-2 py-2 text-center" style="width: 75px;">Bobot</th>
                                                <th class="px-2 py-2 text-center" style="width: 85px;">Lalu (%)</th>
                                                <th class="px-2 py-2 text-center" style="width: 110px;">Mg Ini (%)</th>
                                                <th class="px-2 py-2 text-center" style="width: 110px;">Total (%)</th>
                                                <th class="px-3 py-2" style="min-width: 150px;">Catatan / Hasil Fisik</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tabelBodyOpnameModal">
                                            <!-- Rendered dynamically by JS -->
                                        </tbody>
                                    </table>
                                </div>
                                <div id="noticeNoRapItems" class="p-4 text-center text-muted d-none">
                                    <i class="mdi mdi-alert-circle-outline text-warning" style="font-size: 2.5rem;"></i>
                                    <h6 class="fw-bold mt-2 text-dark">Item Pekerjaan RAP Belum Tersedia</h6>
                                    <p class="small text-muted mb-3">Unit ini belum memiliki rincian RAP tersimpan. Terapkan template standar RAP terlebih dahulu agar sistem menampilkan rincian per uraian.</p>
                                    <button type="button" class="btn btn-sm btn-primary rounded-2 px-3 fw-semibold" onclick="confirmApplyTemplate()">
                                        <i class="mdi mdi-file-document-edit-outline me-1"></i>Terapkan Template RAP Sekarang
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Accordion Data Tambahan / Kendala & Material -->
                        <div class="accordion" id="accordionOpnameTambahan">
                            <div class="accordion-item border-0 shadow-xs" style="border-radius: 12px; overflow: hidden;">
                                <h2 class="accordion-header" id="headingOpnameTambahan">
                                    <button class="accordion-button collapsed py-2 px-3 bg-white text-muted fw-bold small" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOpnameTambahan" aria-expanded="false" aria-controls="collapseOpnameTambahan" style="font-size: 0.85rem;">
                                        <i class="mdi mdi-note-text-outline text-primary me-2"></i>Catatan Tambahan, Logistik & Kendala Lapangan (Opsional)
                                    </button>
                                </h2>
                                <div id="collapseOpnameTambahan" class="accordion-collapse collapse" aria-labelledby="headingOpnameTambahan" data-bs-parent="#accordionOpnameTambahan">
                                    <div class="accordion-body bg-white pt-2 pb-3 px-3">
                                        <div class="row g-2">
                                            <div class="col-md-6">
                                                <label class="form-label small fw-bold text-muted mb-1">Material Digunakan</label>
                                                <textarea id="opname_material" class="form-control form-control-sm" rows="2" placeholder="Semen Gresik 20 sak, Pasir 1 truk, Besi 10mm..."></textarea>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label small fw-bold text-muted mb-1">Kendala / Hambatan Lapangan</label>
                                                <textarea id="opname_kendala" class="form-control form-control-sm" rows="2" placeholder="Hujan lebat di sore hari, keterlambatan pengiriman semen..."></textarea>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label small fw-bold text-muted mb-1">Solusi / Tindak Lanjut</label>
                                                <textarea id="opname_solusi" class="form-control form-control-sm" rows="2" placeholder="Lembur malam hari, penambahan tenaga kerja..."></textarea>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label small fw-bold text-muted mb-1">Rencana Minggu Depan</label>
                                                <textarea id="opname_rencana" class="form-control form-control-sm" rows="2" placeholder="Pengecoran plat lantai 2, pemasangan kusen..."></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="modal-footer py-2.5 px-4 bg-white border-top d-flex justify-content-between align-items-center">
                        <div class="small text-muted">
                            Total Bobot RAP: <strong class="text-dark">100%</strong>
                        </div>
                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-sm btn-outline-secondary px-3 rounded-2" data-bs-dismiss="modal">Batal</button>
                            <button type="button" class="btn btn-sm btn-success px-4 rounded-2 fw-semibold text-white shadow-sm" onclick="simpanOpnamePerUraian()">
                                <i class="mdi mdi-check me-1"></i>Simpan Laporan Opname
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ============================================================
             MODAL: DETAIL OPNAME MINGGUAN (PER RINCIAN URAIAN)
        ============================================================ --}}
        <div class="modal fade" id="modalDetailOpnameModal" tabindex="-1" aria-labelledby="modalDetailOpnameLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content border-0 shadow-lg" style="border-radius: 16px; overflow: hidden;">
                    <div class="modal-header py-3 px-4 bg-light border-bottom">
                        <div class="d-flex align-items-center gap-2">
                            <div style="width: 38px; height: 38px; border-radius: 10px; background: rgba(16,185,129,0.12); color: #10b981; display: flex; align-items: center; justify-content: center; font-size: 1.25rem;">
                                <i class="mdi mdi-clipboard-text-search-outline"></i>
                            </div>
                            <div>
                                <h5 class="modal-title fw-bold text-dark mb-0" id="detailOpnameJudul">Rincian Opname Mingguan</h5>
                                <small class="text-muted" id="detailOpnameSubjudul">No. Opname</small>
                            </div>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body p-4">
                        <!-- Info Ringkasan Header -->
                        <div class="row g-2 mb-3">
                            <div class="col-md-3 col-6">
                                <div class="p-2.5 rounded-3 bg-light border text-center">
                                    <small class="text-muted d-block" style="font-size:0.75rem;">Periode</small>
                                    <span class="fw-bold text-dark" id="detailOpnamePeriode" style="font-size:0.85rem;">-</span>
                                </div>
                            </div>
                            <div class="col-md-3 col-6">
                                <div class="p-2.5 rounded-3 bg-light border text-center">
                                    <small class="text-muted d-block" style="font-size:0.75rem;">Tenaga Kerja</small>
                                    <span class="fw-bold text-dark" id="detailOpnamePekerja" style="font-size:0.85rem;">-</span>
                                </div>
                            </div>
                            <div class="col-md-3 col-6">
                                <div class="p-2.5 rounded-3 bg-success bg-opacity-10 border border-success-subtle text-center">
                                    <small class="text-success d-block fw-semibold" style="font-size:0.75rem;">Progress Minggu Ini</small>
                                    <span class="fw-bold text-success" id="detailOpnameProgMinggu" style="font-size:1.1rem;">0%</span>
                                </div>
                            </div>
                            <div class="col-md-3 col-6">
                                <div class="p-2.5 rounded-3 bg-primary bg-opacity-10 border border-primary-subtle text-center">
                                    <small class="text-primary d-block fw-semibold" style="font-size:0.75rem;">Progress Kumulatif</small>
                                    <span class="fw-bold text-primary" id="detailOpnameProgKumulatif" style="font-size:1.1rem;">0%</span>
                                </div>
                            </div>
                        </div>

                        <!-- Tabel Rincian Uraian -->
                        <div class="card border mb-3" style="border-radius: 10px; overflow: hidden;">
                            <div class="card-header bg-light py-2 px-3 fw-bold small text-dark d-flex align-items-center gap-1">
                                <i class="mdi mdi-format-list-numbered text-primary"></i> Capaian Tiap Uraian Pekerjaan
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive" style="max-height: 320px; overflow-y: auto;">
                                    <table class="table table-sm table-hover align-middle mb-0" style="font-size: 0.82rem;">
                                        <thead class="table-light sticky-top" style="font-size: 0.72rem; text-transform: uppercase;">
                                            <tr>
                                                <th class="px-3 py-2 text-center" style="width: 45px;">No</th>
                                                <th class="px-2 py-2">Uraian Pekerjaan</th>
                                                <th class="px-2 py-2 text-center" style="width: 80px;">Vol/Sat</th>
                                                <th class="px-2 py-2 text-center" style="width: 70px;">Bobot</th>
                                                <th class="px-2 py-2 text-center" style="width: 95px;">Mg Ini</th>
                                                <th class="px-2 py-2 text-center" style="width: 95px;">Total</th>
                                                <th class="px-2 py-2">Catatan</th>
                                            </tr>
                                        </thead>
                                        <tbody id="detailOpnameTableBody">
                                            <!-- Rendered dynamically -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Catatan & Info Tambahan Lapangan -->
                        <div class="row g-2" id="detailOpnameInfoTambahan">
                            <div class="col-md-6" id="wrapperDetailMaterial">
                                <div class="p-2.5 rounded-3 bg-light border small">
                                    <strong class="text-muted d-block mb-1"><i class="mdi mdi-cube-outline me-1"></i>Material Digunakan:</strong>
                                    <div id="detailOpnameMaterial" class="text-dark">-</div>
                                </div>
                            </div>
                            <div class="col-md-6" id="wrapperDetailKendala">
                                <div class="p-2.5 rounded-3 bg-light border small">
                                    <strong class="text-muted d-block mb-1"><i class="mdi mdi-alert-circle-outline me-1"></i>Kendala:</strong>
                                    <div id="detailOpnameKendala" class="text-dark">-</div>
                                </div>
                            </div>
                            <div class="col-md-6" id="wrapperDetailSolusi">
                                <div class="p-2.5 rounded-3 bg-light border small">
                                    <strong class="text-muted d-block mb-1"><i class="mdi mdi-lightbulb-on-outline me-1"></i>Solusi:</strong>
                                    <div id="detailOpnameSolusi" class="text-dark">-</div>
                                </div>
                            </div>
                            <div class="col-md-6" id="wrapperDetailRencana">
                                <div class="p-2.5 rounded-3 bg-light border small">
                                    <strong class="text-muted d-block mb-1"><i class="mdi mdi-arrow-right-bold-circle-outline me-1"></i>Rencana Minggu Depan:</strong>
                                    <div id="detailOpnameRencana" class="text-dark">-</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer py-2 px-4 bg-light border-top">
                        <button type="button" class="btn btn-sm btn-secondary px-4 rounded-2" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const select = document.getElementById('unitSelect');

            function updateFields() {
                const selected = select.options[select.selectedIndex];

                document.getElementById('unitType').value = selected.dataset.type ?? '-';
                document.getElementById('unitArea').value = (selected.dataset.area ?? 0) + ' m²';
                document.getElementById('unitBuilding').value =
                    (selected.dataset.building ?? 0) + ' m²';

                const price = selected.dataset.price ?? 0;
                document.getElementById('unitPrice').value =
                    'Rp ' + Number(price).toLocaleString('id-ID');
            }

            updateFields();
            select.addEventListener('change', updateFields);

            // Handle Auto-save & Count Checklist Kondisi Unit
            $(document).on('change', '.unit-checklist-input', function() {
                const unitId = $(this).data('unit-id');
                const total = $('.unit-checklist-input').length;
                const checked = $('.unit-checklist-input:checked').length;

                $('#checklistCountText').text(checked);

                if (checked === total) {
                    $('#badgeChecklistStatus').css({
                        'background': '#dcfce7',
                        'color': '#15803d',
                        'border': '1px solid #bbf7d0'
                    });
                } else {
                    $('#badgeChecklistStatus').css({
                        'background': '#eef2ff',
                        'color': '#4f46e5',
                        'border': '1px solid #c7d2fe'
                    });
                }

                // Kumpulkan payload
                const payload = {};
                $('.unit-checklist-input').each(function() {
                    const f = $(this).data('field');
                    if ($(this).is(':checked')) {
                        payload[f] = 1;
                    }
                });

                // Kirim via AJAX
                $.ajax({
                    url: `/properti/progress/checklist-kondisi/${unitId}`,
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        checklist_kondisi: payload
                    },
                    success: function(res) {
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 1500,
                            timerProgressBar: false
                        });
                        Toast.fire({
                            icon: 'success',
                            title: 'Checklist kondisi unit tersimpan'
                        });
                    },
                    error: function(err) {
                        console.error('Gagal menyimpan checklist', err);
                    }
                });
            });
        });
    </script>

    <script>
        let indexItem = 0;
        let kategoriMap = @json($jsKategoriMap);

        function confirmApplyTemplate() {
            let form = document.getElementById('formApplyTemplate');
            if (!form) {
                Swal.fire('Perhatian', 'Form penerapan template tidak ditemukan pada unit ini.', 'warning');
                return;
            }

            Swal.fire({
                title: 'Terapkan Template Standar RAP?',
                text: 'Sistem akan otomatis memasukkan rincian pekerjaan standar (I. Perizinan & Legalitas s/d VIII. Pekerjaan Lainnya) pada unit ini.',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#9a55ff',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Terapkan!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Memproses...',
                        text: 'Sedang menerapkan template standar RAP...',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });
                    form.submit();
                }
            });
        }

        function modalTambahKategoriBaru() {
            Swal.fire({
                title: 'Tambah Kategori Pekerjaan Baru',
                html: `
                    <div class="text-start">
                        <label class="form-label small fw-bold text-muted">Nama Kategori / Tahapan Pekerjaan</label>
                        <input type="text" id="swal-cat-title" class="form-control" placeholder="Contoh: IX. PEKERJAAN INTERIOR & MEUBEL">
                        <small class="text-muted d-block mt-1">Kategori baru akan otomatis ditambahkan ke form RAP dan terhubung ke kalkulasi HPP.</small>
                    </div>
                `,
                showCancelButton: true,
                confirmButtonColor: '#10b981',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Tambahkan Kategori',
                cancelButtonText: 'Batal',
                preConfirm: () => {
                    const title = document.getElementById('swal-cat-title').value.trim();
                    if (!title) {
                        Swal.showValidationMessage('Nama kategori tidak boleh kosong!');
                        return false;
                    }
                    return title;
                }
            }).then((result) => {
                if (result.isConfirmed && result.value) {
                    tambahKategoriSection(result.value);
                }
            });
        }

        function tambahKategoriSection(title) {
            // Buat key unik
            let cleanKey = title.toLowerCase().replace(/[^a-z0-9]/g, '_').replace(/_+/g, '_').replace(/^_|_$/g, '');
            if (!cleanKey) cleanKey = 'kategori_' + Date.now();
            if (kategoriMap[cleanKey]) {
                cleanKey += '_' + Math.floor(Math.random() * 100);
            }

            let nextPrefix = Object.keys(kategoriMap).length + 1;
            kategoriMap[cleanKey] = {
                prefix: String(nextPrefix),
                body: "body-" + cleanKey,
                subtotal: "subtotal-" + cleanKey
            };

            let cardHtml = `
                <div class="row mb-4 category-section animate__animated animate__fadeIn" id="section-${cleanKey}">
                    <div class="col-12">
                        <div class="card shadow-sm border-0 rab-card" style="border-radius: 12px; overflow: hidden;">
                            <div class="card-header bg-light bg-opacity-75 d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-2 py-2.5 px-3 px-md-4 border-bottom">
                                <div class="d-flex align-items-center gap-2 flex-wrap">
                                    <span class="badge bg-primary bg-opacity-10 text-primary font-monospace px-2.5 py-1 rounded-2 fw-bold" style="font-size: 0.82rem;">
                                        Prefix: ${nextPrefix}
                                    </span>
                                    <h6 class="mb-0 fw-bold text-dark d-flex align-items-center" style="font-size: 0.98rem;">
                                        <i class="mdi mdi-folder-outline me-2" style="color: #9a55ff; font-size: 1.15rem;"></i>
                                        ${title}
                                    </h6>
                                </div>

                                <div class="d-flex align-items-center gap-2 flex-wrap ms-md-auto">
                                    <!-- Badge Status Capaian -->
                                    <span class="badge-status-pill badge-status-pending" id="badge-status-${cleanKey}">
                                        <i class="mdi mdi-clock-outline me-1"></i><span class="status-text">Belum Berjalan</span>
                                    </span>

                                    <!-- Mini Progress Bar & Persentase -->
                                    <div class="d-flex align-items-center gap-1.5 px-2 py-1 bg-white border rounded-2" style="min-width: 120px;">
                                        <div class="progress flex-grow-1" style="height: 6px; border-radius: 4px; background: #e2e8f0; width: 60px;">
                                            <div class="progress-bar bg-gradient-primary" id="progbar-${cleanKey}" style="width: 0%;"></div>
                                        </div>
                                        <span class="fw-bold font-monospace text-primary" id="progpct-${cleanKey}" style="font-size: 0.8rem; width: 38px; text-align: right;">0%</span>
                                    </div>

                                    <button type="button" class="btn btn-sm btn-success text-white px-3 py-1 rounded-2 fw-semibold shadow-sm d-inline-flex align-items-center gap-1" style="height: 30px; font-size: 0.8rem;" onclick="tambahItem('${cleanKey}')">
                                        + Tambah Item
                                    </button>
                                </div>
                            </div>

                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-hover table-bordered align-middle mb-0 rab-table">
                                        <thead>
                                            <tr>
                                                <th style="width: 50px;">NO</th>
                                                <th>URAIAN</th>
                                                <th style="width: 85px;">VOLUME</th>
                                                <th style="width: 75px;">SATUAN</th>
                                                <th style="width: 130px;">HARGA</th>
                                                <th style="width: 140px;">TOTAL</th>
                                                <th>KETERANGAN</th>
                                                <th style="width: 100px;">PROGRESS</th>
                                                <th style="width: 130px;">DEADLINE</th>
                                                <th style="width: 140px;">DOKUMENTASI</th>
                                                <th style="width: 60px;">AKSI</th>
                                            </tr>
                                        </thead>
                                        <tbody id="body-${cleanKey}">
                                            <tr>
                                                <td colspan="11" class="text-center py-3 text-muted">
                                                    Belum ada item pekerjaan. Klik <strong>+ Tambah Item</strong> di atas.
                                                </td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr class="bg-light bg-opacity-75" style="border-top: 1px solid #e2e8f0;">
                                                <td colspan="5" class="text-start ps-3 ps-md-4 fw-bold text-dark small py-2.5">
                                                    Subtotal ${title}
                                                </td>
                                                <td colspan="6" class="text-end pe-3 pe-md-4 py-2.5">
                                                    <span id="subtotal-display-${cleanKey}" class="font-monospace fw-bold text-success" style="font-size: 1rem;">
                                                        Rp 0
                                                    </span>
                                                    <input type="hidden" id="subtotal-${cleanKey}" value="0">
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `;

            document.getElementById('dynamic-categories-container').insertAdjacentHTML('beforeend', cardHtml);

            // Scroll ke seksi baru dan tambahkan 1 item awal otomatis
            document.getElementById(`section-${cleanKey}`).scrollIntoView({ behavior: 'smooth', block: 'center' });
            tambahItem(cleanKey);

            Swal.fire({
                icon: 'success',
                title: 'Kategori Ditambahkan!',
                text: `Kategori "${title}" berhasil ditambahkan dan siap diisi.`,
                timer: 2000,
                showConfirmButton: false
            });
        }

        function tambahItem(kategori) {
            let config = kategoriMap[kategori];
            let tbody = document.getElementById(config.body);

            // Hapus row "Belum ada data" jika ada
            if (tbody.querySelector('tr td[colspan="11"]') || tbody.querySelector('tr td[colspan="10"]')) {
                tbody.innerHTML = '';
            }

            let nomor = tbody.querySelectorAll("tr").length + 1;
            let kode = config.prefix + "." + nomor;

            let row = `
                <tr>
                    <td class="text-center fw-bold text-muted">${kode}</td>
                    <td>
                        <input type="hidden" name="items[${indexItem}][kategori]" value="${kategori}">
                        <input type="hidden" name="items[${indexItem}][kode]" value="${kode}">
                        <input type="text" name="items[${indexItem}][uraian]"
                               class="form-control form-control-sm" placeholder="Uraian pekerjaan..." required>
                    </td>
                    <td>
                        <input type="text"
                               name="items[${indexItem}][volume]"
                               class="form-control form-control-sm volume text-center" placeholder="0" oninput="hitungSemua()" required>
                    </td>
                    <td>
                        <input type="text"
                               name="items[${indexItem}][satuan]"
                               class="form-control form-control-sm text-center" placeholder="m² / ls / dll" required>
                    </td>
                    <td>
                        <input type="text"
                               name="items[${indexItem}][harga_satuan]"
                               class="form-control form-control-sm harga-satuan text-end" placeholder="0" oninput="formatRupiahInput(this)" required>
                    </td>
                    <td class="text-end">
                        <input type="text"
                               name="items[${indexItem}][total]"
                               class="form-control form-control-sm text-end total-item fw-bold text-success"
                               placeholder="0" readonly>
                    </td>
                    <td>
                        <input type="text"
                               name="items[${indexItem}][keterangan]"
                               class="form-control form-control-sm" placeholder="Keterangan...">
                    </td>
                    <td class="text-center">
                        <div class="input-group input-group-sm" style="width: 80px; margin: 0 auto;">
                            <input type="number" min="0" max="100" name="items[${indexItem}][progress_persen]"
                                   class="form-control form-control-sm text-center font-monospace fw-bold item-progress-input"
                                   style="border-radius: 6px 0 0 6px; padding: 2px 4px; font-size: 0.82rem;"
                                   value="0"
                                   oninput="hitungSemua()" placeholder="0">
                            <span class="input-group-text px-1 bg-light text-muted" style="border-radius: 0 6px 6px 0; font-size: 11px;">%</span>
                        </div>
                    </td>
                    <td>
                        <input type="date"
                               name="items[${indexItem}][deadline]"
                               class="form-control form-control-sm">
                    </td>
                    <td>
                        <div class="file-upload-modern">
                            <input type="file"
                                   name="items[${indexItem}][dokumentasi]"
                                   id="file-${indexItem}"
                                   class="file-upload-input"
                                   accept=".jpg,.jpeg,.png,.webp,.pdf,.doc,.docx"
                                   onchange="handleFileSelect(this, ${indexItem})">
                            <div class="file-upload-label" id="label-${indexItem}">
                                <i class="mdi mdi-cloud-upload text-primary me-1"></i>
                                <span id="fileName-${indexItem}">Pilih file</span>
                                <span class="file-upload-size" id="fileSize-${indexItem}"></span>
                            </div>
                        </div>
                    </td>
                    <td class="text-center">
                        <button type="button"
                                class="btn-action delete"
                                onclick="hapusItem(this, '${kategori}')" title="Hapus Item">
                            <i class="mdi mdi-trash-can-outline"></i>
                        </button>
                    </td>
                </tr>
            `;

            tbody.insertAdjacentHTML('beforeend', row);
            indexItem++;
            hitungSemua();
        }

        function formatRupiahInput(input) {
            let val = input.value.replace(/[^0-9]/g, '');
            if (val) {
                input.value = Number(val).toLocaleString('id-ID');
            } else {
                input.value = '';
            }
            hitungSemua();
        }

        function parseVolumeVal(val) {
            if (!val) return 0;
            if (typeof val === 'number') return val;
            let str = String(val).trim().replace(',', '.');
            let num = parseFloat(str);
            return isNaN(num) ? 0 : num;
        }

        function parseRupiahVal(val) {
            if (!val) return 0;
            if (typeof val === 'number') return val;
            let clean = String(val).replace(/[^0-9]/g, '');
            let num = parseInt(clean, 10);
            return isNaN(num) ? 0 : num;
        }

        function handleFileSelect(input, index) {
            const file = input.files[0];
            const label = document.getElementById(`label-${index}`);
            const fileNameSpan = document.getElementById(`fileName-${index}`);
            const fileSizeSpan = document.getElementById(`fileSize-${index}`);

            if (file) {
                const allowedExts = ['jpg', 'jpeg', 'png', 'webp', 'pdf', 'doc', 'docx'];
                const fileExt = file.name.split('.').pop().toLowerCase();
                const maxSizeBytes = 10 * 1024 * 1024; // 10MB

                if (!allowedExts.includes(fileExt)) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Format File Tidak Didukung',
                        text: 'Format file "' + fileExt.toUpperCase() + '" tidak didukung. Harap pilih file dokumentasi dengan format: JPG, JPEG, PNG, WEBP, atau PDF.',
                        confirmButtonColor: '#9a55ff'
                    });
                    input.value = '';
                    fileNameSpan.textContent = 'Pilih file';
                    if (fileSizeSpan) fileSizeSpan.textContent = '';
                    label.classList.remove('file-selected');
                    return;
                }

                if (file.size > maxSizeBytes) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Ukuran File Terlalu Besar',
                        text: 'Ukuran file (' + (file.size / (1024 * 1024)).toFixed(1) + ' MB) melebihi batas maksimal 10 MB.',
                        confirmButtonColor: '#9a55ff'
                    });
                    input.value = '';
                    fileNameSpan.textContent = 'Pilih file';
                    if (fileSizeSpan) fileSizeSpan.textContent = '';
                    label.classList.remove('file-selected');
                    return;
                }

                fileNameSpan.textContent = file.name.length > 15 ? file.name.substring(0, 12) + '...' : file.name;

                if (fileSizeSpan) {
                    if (file.size < 1024 * 1024) {
                        fileSizeSpan.textContent = ' (' + (file.size / 1024).toFixed(0) + 'KB)';
                    } else {
                        fileSizeSpan.textContent = ' (' + (file.size / (1024 * 1024)).toFixed(1) + 'MB)';
                    }
                }

                label.classList.add('file-selected');
            } else {
                fileNameSpan.textContent = 'Pilih file';
                if (fileSizeSpan) fileSizeSpan.textContent = '';
                label.classList.remove('file-selected');
            }
        }

        function hapusItem(button, kategori, itemId = null) {
            Swal.fire({
                title: 'Yakin ingin menghapus item ini?',
                text: "Data yang dihapus tidak bisa dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    if (itemId) {
                        // Row sudah tersimpan di DB → hapus via AJAX
                        $.ajax({
                            url: '/properti/progress/item/' + itemId,
                            type: 'DELETE',
                            data: {
                                _token: $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(response) {
                                if (response.success) {
                                    $(button).closest('tr').remove();
                                    updateNomor(kategori);
                                    hitungSemua();
                                    Swal.fire('Dihapus!', response.message, 'success');
                                }
                            },
                            error: function() {
                                Swal.fire('Error!', 'Terjadi kesalahan saat menghapus item.', 'error');
                            }
                        });
                    } else {
                        // Row baru, belum ada di DB → hapus langsung
                        $(button).closest('tr').remove();
                        updateNomor(kategori);
                        hitungSemua();
                        Swal.fire('Dihapus!', 'Item baru berhasil dihapus dari tabel.', 'success');
                    }
                }
            });
        }

        function updateNomor(kategori) {
            let config = kategoriMap[kategori];
            let rows = document.querySelectorAll("#" + config.body + " tr");

            rows.forEach((row, i) => {
                let kode = config.prefix + "." + (i + 1);
                row.cells[0].innerText = kode;

                let kodeInput = row.querySelector("input[name*='[kode]']");
                if (kodeInput) {
                    kodeInput.value = kode;
                }
            });
        }

        function hitungSemua() {
            let grandTotal = 0;
            let totalPerizinan = 0;
            let totalRumah = 0;

            Object.keys(kategoriMap).forEach(function(kategori) {
                let config = kategoriMap[kategori];
                let subtotal = 0;
                let totalProgress = 0;
                let itemCount = 0;

                let rows = document.querySelectorAll("#" + config.body + " tr");
                rows.forEach(function(row) {
                    // Cek jika row kosong
                    if (row.querySelector('td[colspan]')) return;

                    let volumeInput = row.querySelector(".volume");
                    let hargaInput = row.querySelector(".harga-satuan");
                    let totalInput = row.querySelector(".total-item");

                    if (volumeInput && hargaInput && totalInput) {
                        let volume = parseVolumeVal(volumeInput.value);
                        let harga = parseRupiahVal(hargaInput.value);
                        let total = Math.round(volume * harga);

                        totalInput.value = total.toLocaleString('id-ID');
                        subtotal += total;
                    } else {
                        let totalText = row.cells[5]?.innerText || "0";
                        let total = parseInt(totalText.replace(/[^0-9]/g, '')) || 0;
                        subtotal += total;
                    }

                    // Hitung progress item
                    let progressInput = row.querySelector(".item-progress-input");
                    if (progressInput) {
                        let pVal = Math.max(0, Math.min(100, parseInt(progressInput.value) || 0));
                        totalProgress += pVal;
                        itemCount++;
                    }
                });

                // Update Progress Kategori (Rata-rata)
                let avgProgress = itemCount > 0 ? Math.round(totalProgress / itemCount) : 0;
                let progbar = document.getElementById('progbar-' + kategori);
                if (progbar) progbar.style.width = avgProgress + '%';

                let progpct = document.getElementById('progpct-' + kategori);
                if (progpct) progpct.innerText = avgProgress + '%';

                let badgeStatus = document.getElementById('badge-status-' + kategori);
                if (badgeStatus) {
                    badgeStatus.className = 'badge-status-pill';
                    if (avgProgress >= 100) {
                        badgeStatus.classList.add('badge-status-lunas');
                        badgeStatus.innerHTML = '<i class="mdi mdi-check-circle me-1"></i><span class="status-text">Selesai</span>';
                    } else if (avgProgress > 0) {
                        badgeStatus.classList.add('badge-status-partial');
                        badgeStatus.innerHTML = '<i class="mdi mdi-progress-wrench me-1"></i><span class="status-text">Sedang Berjalan</span>';
                    } else {
                        badgeStatus.classList.add('badge-status-pending');
                        badgeStatus.innerHTML = '<i class="mdi mdi-clock-outline me-1"></i><span class="status-text">Belum Berjalan</span>';
                    }
                }

                let subtotalInput = document.getElementById(config.subtotal);
                if (subtotalInput) {
                    subtotalInput.value = 'Rp ' + subtotal.toLocaleString('id-ID');
                }
                let subtotalDisplay = document.getElementById('subtotal-display-' + kategori);
                if (subtotalDisplay) {
                    subtotalDisplay.innerText = 'Rp ' + subtotal.toLocaleString('id-ID');
                }

                if (kategori === 'perizinan') {
                    totalPerizinan += subtotal;
                } else {
                    totalRumah += subtotal;
                }

                grandTotal += subtotal;
            });

            // Live Update Ringkasan RAP & Harga Jual Final
            let ppn = Math.round(grandTotal * 0.1);
            let totalRAB = grandTotal + ppn;

            let perizinanEl = document.getElementById('summary-perizinan');
            if (perizinanEl) perizinanEl.value = 'Rp ' + totalPerizinan.toLocaleString('id-ID');

            let rumahEl = document.getElementById('summary-rumah');
            if (rumahEl) rumahEl.value = 'Rp ' + totalRumah.toLocaleString('id-ID');

            let subtotalEl = document.getElementById('summary-subtotal');
            if (subtotalEl) subtotalEl.value = 'Rp ' + grandTotal.toLocaleString('id-ID');

            let ppnEl = document.getElementById('summary-ppn');
            if (ppnEl) ppnEl.value = 'Rp ' + ppn.toLocaleString('id-ID');

            let totalRABEl = document.getElementById('summary-total-rab');
            if (totalRABEl) totalRABEl.value = 'Rp ' + totalRAB.toLocaleString('id-ID');

            let totalRABFinalEl = document.getElementById('summary-total-rab-final');
            if (totalRABFinalEl) totalRABFinalEl.value = 'Rp ' + totalRAB.toLocaleString('id-ID');

            let unitPriceEl = document.getElementById('summary-unit-price');
            let unitPrice = unitPriceEl ? parseRupiahVal(unitPriceEl.value) : 0;
            let finalPrice = totalRAB + unitPrice;

            let finalPriceEl = document.getElementById('summary-final-price');
            if (finalPriceEl) finalPriceEl.value = 'Rp ' + finalPrice.toLocaleString('id-ID');

            let hiddenPrice = document.querySelector('input[name="price"]');
            if (hiddenPrice) hiddenPrice.value = finalPrice;
        }

        document.addEventListener("input", function(e) {
            if (e.target.classList.contains("volume") || e.target.classList.contains("harga-satuan") || e.target.classList.contains("item-progress-input")) {
                hitungSemua();
            }
        });

        document.addEventListener("DOMContentLoaded", function() {
            hitungSemua();
        });

        document.getElementById("unitSelect").addEventListener("change", function() {
            let unitId = this.value;
            let url = new URL(window.location.href);
            url.searchParams.set('unit_id', unitId);
            window.location.href = url.toString();
        });

        document.querySelectorAll('.acc-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                let unitId = this.dataset.id;

                Swal.fire({
                    title: 'ACC RAP',
                    text: 'Apakah yakin ACC RAP untuk unit ini?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#9a55ff',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, ACC!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch(`/properti/progress/acc-ajax/${unitId}`, {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                    'Accept': 'application/json',
                                    'Content-Type': 'application/json'
                                }
                            })
                            .then(res => res.json())
                            .then(data => {
                                if (data.success) {
                                    Swal.fire({
                                        title: 'Berhasil!',
                                        text: data.message,
                                        icon: 'success'
                                    }).then(() => {
                                        window.location.reload();
                                    });
                                } else {
                                    Swal.fire('Gagal!', data.message, 'warning');
                                }
                            })
                            .catch(err => {
                                console.error(err);
                                Swal.fire('Error!', 'Terjadi error pada request AJAX',
                                    'error');
                            });
                    }
                });
            });
        });
    </script>

    {{-- ============================================================
         JS: OPNAME MINGGUAN & PEMBAYARAN TERMIN
    ============================================================ --}}
    <script>
        const CSRF_TOKEN = '{{ csrf_token() }}';
        const PROGRESS_ID = '{{ $selectedUnit->progress ? $selectedUnit->progress->id : "" }}';
        const UNIT_ID = '{{ $selectedUnit->id }}';
        const RAP_ITEMS = @json($rapItemsPayload);
        const TOTAL_RAP_BUDGET = {{ (float)$totalRapBudget }};

        let modalTambahOpnameInstance = null;
        let modalDetailOpnameInstance = null;

        /* ─── OPNAME MINGGUAN (PER URAIAN PEKERJAAN) ─── */
        function modalTambahOpname() {
            if (!PROGRESS_ID) {
                Swal.fire('Perhatian', 'Simpan data RAP terlebih dahulu sebelum menambah opname.', 'warning');
                return;
            }

            const nextMinggu = {{ $opnameMingguan->count() + 1 }};
            document.getElementById('opname_minggu_ke').value = nextMinggu;
            document.getElementById('opname_pekerja').value = '';

            // Default periode tanggal
            @if($opnameMingguan->isNotEmpty() && $opnameMingguan->last()->tanggal_akhir_minggu)
                let lastEnd = new Date('{{ $opnameMingguan->last()->tanggal_akhir_minggu }}');
                let nextStart = new Date(lastEnd);
                nextStart.setDate(nextStart.getDate() + 1);
                let nextEnd = new Date(nextStart);
                nextEnd.setDate(nextEnd.getDate() + 6);
                document.getElementById('opname_tgl_mulai').value = nextStart.toISOString().split('T')[0];
                document.getElementById('opname_tgl_akhir').value = nextEnd.toISOString().split('T')[0];
            @else
                let now = new Date();
                let day = now.getDay();
                let diffToMonday = now.getDate() - day + (day === 0 ? -6 : 1);
                let mon = new Date(now.setDate(diffToMonday));
                let sun = new Date(mon);
                sun.setDate(sun.getDate() + 6);
                document.getElementById('opname_tgl_mulai').value = mon.toISOString().split('T')[0];
                document.getElementById('opname_tgl_akhir').value = sun.toISOString().split('T')[0];
            @endif

            // Reset field opsional
            document.getElementById('opname_material').value = '';
            document.getElementById('opname_kendala').value = '';
            document.getElementById('opname_solusi').value = '';
            document.getElementById('opname_rencana').value = '';

            // Render rincian tabel per uraian
            renderTabelOpnameUraian();

            if (!modalTambahOpnameInstance) {
                modalTambahOpnameInstance = new bootstrap.Modal(document.getElementById('modalTambahOpnameModal'));
            }
            modalTambahOpnameInstance.show();
        }

        function renderTabelOpnameUraian() {
            const tbody = document.getElementById('tabelBodyOpnameModal');
            const notice = document.getElementById('noticeNoRapItems');
            tbody.innerHTML = '';

            if (!RAP_ITEMS || RAP_ITEMS.length === 0) {
                notice.classList.remove('d-none');
                document.getElementById('badgeProgMingguIni').innerText = '+0.0%';
                document.getElementById('badgeProgKumulatif').innerText = '0.0%';
                return;
            }
            notice.classList.add('d-none');

            RAP_ITEMS.forEach((it, idx) => {
                const progLalu = parseFloat(it.progress_persen) || 0;
                const bobot = parseFloat(it.bobot) || 0;

                const tr = document.createElement('tr');
                tr.className = 'opname-item-row';
                tr.dataset.itemId = it.id || '';
                tr.dataset.kode = it.kode || '';
                tr.dataset.kategori = it.kategori || '';
                tr.dataset.uraian = it.uraian || '';
                tr.dataset.volume = it.volume || '';
                tr.dataset.satuan = it.satuan || '';
                tr.dataset.bobot = bobot;
                tr.dataset.progLalu = progLalu;

                tr.innerHTML = `
                    <td class="text-center fw-bold text-muted px-2 py-2">${it.kode || (idx + 1)}</td>
                    <td class="px-2 py-2">
                        <span class="badge bg-secondary bg-opacity-10 text-secondary me-1" style="font-size:0.68rem; text-transform:uppercase;">${it.kategori || 'PEKERJAAN'}</span>
                        <strong class="text-dark d-block text-truncate" style="max-width: 250px;" title="${it.uraian}">${it.uraian}</strong>
                    </td>
                    <td class="text-center px-2 py-2 text-muted font-monospace small">
                        ${it.volume ? Number(it.volume).toLocaleString('id-ID') : '-'} ${it.satuan || ''}
                    </td>
                    <td class="text-center px-2 py-2">
                        <span class="fw-bold font-monospace text-info" style="font-size:0.85rem;">${bobot.toFixed(2)}%</span>
                    </td>
                    <td class="text-center px-2 py-2">
                        <span class="fw-bold font-monospace text-muted" style="font-size:0.85rem;">${progLalu.toFixed(1)}%</span>
                    </td>
                    <td class="text-center px-2 py-2">
                        <div class="input-group input-group-sm">
                            <input type="number" min="0" max="${(100 - progLalu).toFixed(1)}" step="0.5" 
                                   class="form-control form-control-sm text-center fw-bold text-success font-monospace item-opname-minggu" 
                                   value="0" style="font-size:0.84rem; padding: 2px 4px;">
                            <span class="input-group-text px-1 bg-light text-muted" style="font-size:10px;">%</span>
                        </div>
                    </td>
                    <td class="text-center px-2 py-2">
                        <div class="input-group input-group-sm">
                            <input type="number" min="${progLalu}" max="100" step="0.5" 
                                   class="form-control form-control-sm text-center fw-bold text-primary font-monospace item-opname-total" 
                                   value="${progLalu.toFixed(1)}" style="font-size:0.84rem; padding: 2px 4px;">
                            <span class="input-group-text px-1 bg-light text-muted" style="font-size:10px;">%</span>
                        </div>
                    </td>
                    <td class="px-2 py-2">
                        <input type="text" class="form-control form-control-sm item-opname-catatan" placeholder="Catatan fisik..." style="font-size:0.8rem;">
                    </td>
                `;

                const inpMinggu = tr.querySelector('.item-opname-minggu');
                const inpTotal = tr.querySelector('.item-opname-total');

                inpMinggu.addEventListener('input', function() {
                    let mVal = parseFloat(this.value) || 0;
                    if (mVal < 0) { mVal = 0; this.value = 0; }
                    if (mVal + progLalu > 100) {
                        mVal = Math.max(0, 100 - progLalu);
                        this.value = mVal.toFixed(1);
                    }
                    inpTotal.value = (progLalu + mVal).toFixed(1);
                    hitungTotalOpname();
                });

                inpTotal.addEventListener('input', function() {
                    let tVal = parseFloat(this.value) || 0;
                    if (tVal > 100) { tVal = 100; this.value = 100; }
                    if (tVal < progLalu) {
                        tVal = progLalu;
                        this.value = tVal.toFixed(1);
                    }
                    inpMinggu.value = Math.max(0, tVal - progLalu).toFixed(1);
                    hitungTotalOpname();
                });

                tbody.appendChild(tr);
            });

            hitungTotalOpname();
        }

        function hitungTotalOpname() {
            let sumMinggu = 0;
            let sumTotal = 0;
            const rows = document.querySelectorAll('#tabelBodyOpnameModal tr.opname-item-row');
            
            rows.forEach(row => {
                const bobot = parseFloat(row.dataset.bobot) || 0;
                const inpMinggu = row.querySelector('.item-opname-minggu');
                const inpTotal = row.querySelector('.item-opname-total');
                const pMinggu = parseFloat(inpMinggu?.value) || 0;
                const pTotal = parseFloat(inpTotal?.value) || 0;

                sumMinggu += (pMinggu * bobot) / 100;
                sumTotal += (pTotal * bobot) / 100;
            });

            sumTotal = Math.min(100, Math.max(0, sumTotal));
            sumMinggu = Math.max(0, sumMinggu);

            const badgeMinggu = document.getElementById('badgeProgMingguIni');
            const badgeTotal = document.getElementById('badgeProgKumulatif');
            if (badgeMinggu) badgeMinggu.innerText = '+' + sumMinggu.toFixed(2) + '%';
            if (badgeTotal) badgeTotal.innerText = sumTotal.toFixed(2) + '%';

            return { minggu: sumMinggu, total: sumTotal };
        }

        function setSemua100Opname() {
            const rows = document.querySelectorAll('#tabelBodyOpnameModal tr.opname-item-row');
            rows.forEach(row => {
                const progLalu = parseFloat(row.dataset.progLalu) || 0;
                const inpMinggu = row.querySelector('.item-opname-minggu');
                const inpTotal = row.querySelector('.item-opname-total');
                if (inpTotal) inpTotal.value = '100';
                if (inpMinggu) inpMinggu.value = Math.max(0, 100 - progLalu).toFixed(1);
            });
            hitungTotalOpname();
        }

        function resetSemuaProgresOpname() {
            const rows = document.querySelectorAll('#tabelBodyOpnameModal tr.opname-item-row');
            rows.forEach(row => {
                const progLalu = parseFloat(row.dataset.progLalu) || 0;
                const inpMinggu = row.querySelector('.item-opname-minggu');
                const inpTotal = row.querySelector('.item-opname-total');
                if (inpMinggu) inpMinggu.value = '0';
                if (inpTotal) inpTotal.value = progLalu.toFixed(1);
            });
            hitungTotalOpname();
        }

        function simpanOpnamePerUraian() {
            const mingguKe = document.getElementById('opname_minggu_ke').value;
            const tglMulai = document.getElementById('opname_tgl_mulai').value;
            const tglAkhir = document.getElementById('opname_tgl_akhir').value;

            if (!mingguKe || !tglMulai || !tglAkhir) {
                Swal.fire('Validasi Gagal', 'Minggu ke, tanggal mulai, dan tanggal selesai wajib diisi!', 'warning');
                return;
            }

            const { minggu: progMinggu, total: progTotal } = hitungTotalOpname();

            const uraianArr = [];
            const rows = document.querySelectorAll('#tabelBodyOpnameModal tr.opname-item-row');
            rows.forEach(row => {
                const itemId = row.dataset.itemId ? parseInt(row.dataset.itemId) : null;
                const kode = row.dataset.kode || '';
                const kategori = row.dataset.kategori || '';
                const uraian = row.dataset.uraian || '';
                const volume = row.dataset.volume || '';
                const satuan = row.dataset.satuan || '';
                const bobot = parseFloat(row.dataset.bobot) || 0;
                const progLalu = parseFloat(row.dataset.progLalu) || 0;
                const pMinggu = parseFloat(row.querySelector('.item-opname-minggu')?.value) || 0;
                const pTotal = parseFloat(row.querySelector('.item-opname-total')?.value) || 0;
                const catatan = row.querySelector('.item-opname-catatan')?.value.trim() || '';

                uraianArr.push({
                    item_id: itemId,
                    kode: kode,
                    kategori: kategori,
                    uraian: uraian,
                    volume: volume,
                    satuan: satuan,
                    bobot: bobot,
                    progress_lalu: progLalu,
                    progress_minggu_ini: pMinggu,
                    progress_total: pTotal,
                    catatan: catatan
                });
            });

            const payload = {
                development_progress_id: PROGRESS_ID,
                land_bank_unit_id: UNIT_ID,
                minggu_ke: parseInt(mingguKe),
                tanggal_mulai_minggu: tglMulai,
                tanggal_akhir_minggu: tglAkhir,
                progress_minggu_ini: parseFloat(progMinggu.toFixed(2)),
                progress_kumulatif: parseFloat(progTotal.toFixed(2)),
                jumlah_pekerja: parseInt(document.getElementById('opname_pekerja').value) || null,
                material_digunakan: document.getElementById('opname_material').value.trim() || null,
                kendala: document.getElementById('opname_kendala').value.trim() || null,
                solusi: document.getElementById('opname_solusi').value.trim() || null,
                rencana_minggu_depan: document.getElementById('opname_rencana').value.trim() || null,
                uraian_pekerjaan: uraianArr,
            };

            // Ikutkan item_id jika ada (dari tombol per uraian)
            const hiddenItemId = document.getElementById('opname_item_id_hidden');
            if (hiddenItemId && hiddenItemId.value) {
                payload.development_progress_item_id = parseInt(hiddenItemId.value);
            }

            simpanOpname(payload);
        }

        function bukaDetailOpname(opname) {
            if (!opname) return;

            document.getElementById('detailOpnameJudul').innerText = `Opname Minggu Ke-${opname.minggu_ke}`;
            document.getElementById('detailOpnameSubjudul').innerText = `No: ${opname.no_opname || '-'} · Dibuat: ${opname.created_at ? new Date(opname.created_at).toLocaleDateString('id-ID') : '-'}`;

            const tMulai = opname.tanggal_mulai_minggu ? new Date(opname.tanggal_mulai_minggu).toLocaleDateString('id-ID', {day: 'numeric', month: 'short'}) : '-';
            const tAkhir = opname.tanggal_akhir_minggu ? new Date(opname.tanggal_akhir_minggu).toLocaleDateString('id-ID', {day: 'numeric', month: 'short', year: 'numeric'}) : '-';
            document.getElementById('detailOpnamePeriode').innerText = `${tMulai} - ${tAkhir}`;
            document.getElementById('detailOpnamePekerja').innerText = opname.jumlah_pekerja ? `${opname.jumlah_pekerja} Orang` : '-';
            document.getElementById('detailOpnameProgMinggu').innerText = `+${Number(opname.progress_minggu_ini || 0).toFixed(1)}%`;
            document.getElementById('detailOpnameProgKumulatif').innerText = `${Number(opname.progress_kumulatif || 0).toFixed(1)}%`;

            // Render table rincian
            const tbody = document.getElementById('detailOpnameTableBody');
            tbody.innerHTML = '';

            const listUraian = Array.isArray(opname.uraian_pekerjaan) ? opname.uraian_pekerjaan : [];

            if (listUraian.length > 0) {
                listUraian.forEach((item, idx) => {
                    const isObj = typeof item === 'object' && item !== null;
                    const kode = isObj ? (item.kode || (idx + 1)) : (idx + 1);
                    const nama = isObj ? (item.uraian || '-') : item;
                    const vol = isObj && (item.volume || item.satuan) ? `${item.volume || ''} ${item.satuan || ''}` : '-';
                    const bobot = isObj && item.bobot !== undefined ? `${Number(item.bobot).toFixed(2)}%` : '-';
                    const pMinggu = isObj && item.progress_minggu_ini !== undefined ? `+${Number(item.progress_minggu_ini).toFixed(1)}%` : '-';
                    const pTotal = isObj && item.progress_total !== undefined ? `${Number(item.progress_total).toFixed(1)}%` : '-';
                    const catatan = isObj ? (item.catatan || '-') : '-';

                    const tr = document.createElement('tr');
                    tr.innerHTML = `
                        <td class="text-center fw-bold text-muted px-2 py-1.5">${kode}</td>
                        <td class="px-2 py-1.5">
                            <span class="fw-semibold text-dark">${nama}</span>
                            ${isObj && item.kategori ? `<span class="badge bg-light text-muted border ms-1" style="font-size:0.68rem;">${item.kategori}</span>` : ''}
                        </td>
                        <td class="text-center px-2 py-1.5 font-monospace text-muted small">${vol}</td>
                        <td class="text-center px-2 py-1.5"><span class="badge bg-info bg-opacity-10 text-info fw-bold">${bobot}</span></td>
                        <td class="text-center px-2 py-1.5 text-success fw-bold font-monospace">${pMinggu}</td>
                        <td class="text-center px-2 py-1.5 text-primary fw-bold font-monospace">${pTotal}</td>
                        <td class="px-2 py-1.5 text-muted small">${catatan}</td>
                    `;
                    tbody.appendChild(tr);
                });
            } else {
                const tr = document.createElement('tr');
                tr.innerHTML = `<td colspan="7" class="text-center py-3 text-muted">Belum ada rincian uraian pekerjaan tersimpan.</td>`;
                tbody.appendChild(tr);
            }

            // Material, Kendala, Solusi, Rencana
            const setOrHide = (wrapId, textId, val) => {
                const wrap = document.getElementById(wrapId);
                const text = document.getElementById(textId);
                if (val && val.trim().length > 0) {
                    wrap.classList.remove('d-none');
                    text.innerText = val;
                } else {
                    wrap.classList.add('d-none');
                }
            };

            setOrHide('wrapperDetailMaterial', 'detailOpnameMaterial', opname.material_digunakan);
            setOrHide('wrapperDetailKendala', 'detailOpnameKendala', opname.kendala);
            setOrHide('wrapperDetailSolusi', 'detailOpnameSolusi', opname.solusi);
            setOrHide('wrapperDetailRencana', 'detailOpnameRencana', opname.rencana_minggu_depan);

            if (!modalDetailOpnameInstance) {
                modalDetailOpnameInstance = new bootstrap.Modal(document.getElementById('modalDetailOpnameModal'));
            }
            modalDetailOpnameInstance.show();
        }

        function simpanOpname(data) {
            Swal.fire({ title: 'Menyimpan...', allowOutsideClick: false, didOpen: () => Swal.showLoading() });
            fetch('{{ route("properti.progress.opname.store") }}', {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': CSRF_TOKEN, 'Content-Type': 'application/json', 'Accept': 'application/json' },
                body: JSON.stringify({ ...data, development_progress_id: PROGRESS_ID, land_bank_unit_id: UNIT_ID })
            })
            .then(res => res.json())
            .then(resp => {
                if (resp.success) {
                    if (modalTambahOpnameInstance) modalTambahOpnameInstance.hide();
                    Swal.fire({ icon: 'success', title: 'Berhasil!', text: resp.message, timer: 1800, showConfirmButton: false })
                        .then(() => window.location.reload());
                } else {
                    Swal.fire('Gagal!', resp.message || 'Terjadi kesalahan.', 'error');
                }
            })
            .catch(() => Swal.fire('Error!', 'Terjadi kesalahan server.', 'error'));
        }

        document.addEventListener('click', function(e) {
            const btnHapusOpname = e.target.closest('.btn-hapus-opname');
            if (btnHapusOpname) {
                const id = btnHapusOpname.dataset.id;
                Swal.fire({
                    title: 'Hapus Opname?',
                    text: 'Data laporan opname ini akan dihapus permanen.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc3545',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal'
                }).then(result => {
                    if (result.isConfirmed) {
                        fetch(`/properti/progress/opname/${id}`, {
                            method: 'DELETE',
                            headers: { 'X-CSRF-TOKEN': CSRF_TOKEN, 'Accept': 'application/json' }
                        })
                        .then(r => r.json())
                        .then(resp => {
                            if (resp.success) {
                                Swal.fire({ icon: 'success', title: 'Dihapus!', text: resp.message, timer: 1500, showConfirmButton: false })
                                    .then(() => window.location.reload());
                            } else {
                                Swal.fire('Gagal!', resp.message, 'error');
                            }
                        });
                    }
                });
            }
        });

        /* ─── OPNAME PER ITEM (dari tombol di tabel RAP) ─── */
        function modalOpnamePerItem(itemId, uraianLabel, progLaluItem) {
            if (!PROGRESS_ID) {
                Swal.fire('Perhatian', 'Simpan data RAP terlebih dahulu sebelum menambah opname.', 'warning');
                return;
            }

            // Set form modal dengan info item
            const nextMinggu = {{ $opnameMingguan->count() + 1 }};
            document.getElementById('opname_minggu_ke').value = nextMinggu;
            document.getElementById('opname_pekerja').value = '';
            document.getElementById('opname_material').value = '';
            document.getElementById('opname_kendala').value = '';
            document.getElementById('opname_solusi').value = '';
            document.getElementById('opname_rencana').value = '';

            // Set default tanggal
            @if($opnameMingguan->isNotEmpty() && $opnameMingguan->last()->tanggal_akhir_minggu)
                let lastEnd2 = new Date('{{ $opnameMingguan->last()->tanggal_akhir_minggu }}');
                let nextStart2 = new Date(lastEnd2); nextStart2.setDate(nextStart2.getDate() + 1);
                let nextEnd2 = new Date(nextStart2); nextEnd2.setDate(nextEnd2.getDate() + 6);
                document.getElementById('opname_tgl_mulai').value = nextStart2.toISOString().split('T')[0];
                document.getElementById('opname_tgl_akhir').value = nextEnd2.toISOString().split('T')[0];
            @else
                let now2 = new Date();
                let day2 = now2.getDay();
                let diffMonday2 = now2.getDate() - day2 + (day2 === 0 ? -6 : 1);
                let mon2 = new Date(now2.setDate(diffMonday2));
                let sun2 = new Date(mon2); sun2.setDate(sun2.getDate() + 6);
                document.getElementById('opname_tgl_mulai').value = mon2.toISOString().split('T')[0];
                document.getElementById('opname_tgl_akhir').value = sun2.toISOString().split('T')[0];
            @endif

            // Simpan item_id sebagai data attribute di tombol simpan – gunakan hidden input dalam modal
            let hiddenItemId = document.getElementById('opname_item_id_hidden');
            if (!hiddenItemId) {
                hiddenItemId = document.createElement('input');
                hiddenItemId.type = 'hidden';
                hiddenItemId.id = 'opname_item_id_hidden';
                document.getElementById('modalTambahOpnameModal').appendChild(hiddenItemId);
            }
            hiddenItemId.value = itemId;

            // Update subjudul modal dengan nama uraian
            const subLabel = document.getElementById('modalTambahOpnameLabel');
            if (subLabel) {
                subLabel.innerHTML = `Input Opname Mingguan`;
            }
            const subSmall = document.querySelector('#modalTambahOpnameModal .modal-header small');
            if (subSmall) {
                subSmall.innerHTML = `Uraian: <strong class="text-white">${uraianLabel}</strong> · Progres Lalu: <span class="badge bg-white text-success">${progLaluItem}%</span>`;
            }

            // Render tabel opname (sama seperti biasa, tapi highlight baris item ini)
            renderTabelOpnameUraian(itemId);

            if (!modalTambahOpnameInstance) {
                modalTambahOpnameInstance = new bootstrap.Modal(document.getElementById('modalTambahOpnameModal'));
            }
            modalTambahOpnameInstance.show();
        }

        /* ─── TERMIN PER ITEM (dari tombol di tabel RAP) ─── */
        function modalTerminPerItem(itemId, uraianLabel, nilaiItem) {
            if (!PROGRESS_ID) {
                Swal.fire('Perhatian', 'Simpan data RAP terlebih dahulu sebelum menambah termin.', 'warning');
                return;
            }
            const nextTermin = {{ $pembayaranTermin->count() + 1 }};
            const nilaiFormatted = new Intl.NumberFormat('id-ID').format(nilaiItem);

            Swal.fire({
                title: `<i class="mdi mdi-cash-multiple text-primary me-2"></i>Tambah Termin Pembayaran`,
                width: 680,
                html: `
                    <div class="text-start">
                        <div class="alert alert-primary d-flex align-items-center gap-2 py-2 px-3 mb-3" style="font-size:0.85rem; border-radius:8px;">
                            <i class="mdi mdi-tag-text-outline fs-5"></i>
                            <div>Uraian: <strong>${uraianLabel}</strong><br><small class="text-muted">Nilai RAP: Rp ${nilaiFormatted}</small></div>
                        </div>
                        <div class="row g-3">
                            <div class="col-4">
                                <label class="form-label small fw-bold text-muted mb-1">Termin Ke</label>
                                <input type="number" id="swal-termin-ke" class="form-control form-control-sm" value="${nextTermin}" min="1">
                            </div>
                            <div class="col-8">
                                <label class="form-label small fw-bold text-muted mb-1">Nama Termin <span class="text-danger">*</span></label>
                                <input type="text" id="swal-nama-termin" class="form-control form-control-sm" placeholder="Contoh: Termin 1 – Pekerjaan Pondasi">
                            </div>
                            <div class="col-6">
                                <label class="form-label small fw-bold text-muted mb-1">Syarat Progress (%)</label>
                                <input type="number" id="swal-syarat-progress" class="form-control form-control-sm" placeholder="0" min="0" max="100" step="5">
                            </div>
                            <div class="col-6">
                                <label class="form-label small fw-bold text-muted mb-1">Persentase Bayar (%)</label>
                                <input type="number" id="swal-persen-bayar" class="form-control form-control-sm" placeholder="0" min="0" max="100" step="5">
                            </div>
                            <div class="col-6">
                                <label class="form-label small fw-bold text-muted mb-1">Nominal (Rp)</label>
                                <input type="text" id="swal-nominal" class="form-control form-control-sm" placeholder="0" oninput="this.value=this.value.replace(/[^0-9]/g,'').replace(/\\B(?=(\\d{3})+(?!\\d))/g,'.')">
                            </div>
                            <div class="col-6">
                                <label class="form-label small fw-bold text-muted mb-1">Jatuh Tempo</label>
                                <input type="date" id="swal-jatuh-tempo" class="form-control form-control-sm">
                            </div>
                            <div class="col-12">
                                <label class="form-label small fw-bold text-muted mb-1">Catatan</label>
                                <textarea id="swal-catatan-termin" class="form-control form-control-sm" rows="2" placeholder="Catatan tambahan..."></textarea>
                            </div>
                        </div>
                    </div>
                `,
                showCancelButton: true,
                confirmButtonColor: '#3b82f6',
                cancelButtonColor: '#6c757d',
                confirmButtonText: '<i class="mdi mdi-check me-1"></i>Simpan Termin',
                cancelButtonText: 'Batal',
                preConfirm: () => {
                    const namaTermin = document.getElementById('swal-nama-termin').value.trim();
                    if (!namaTermin) {
                        Swal.showValidationMessage('Nama termin wajib diisi!');
                        return false;
                    }
                    const nominalRaw = document.getElementById('swal-nominal').value.replace(/\./g, '');
                    return {
                        termin_ke: parseInt(document.getElementById('swal-termin-ke').value),
                        nama_termin: namaTermin,
                        uraian_pekerjaan: uraianLabel,
                        syarat_progress_persen: parseFloat(document.getElementById('swal-syarat-progress').value) || 0,
                        persentase_bayar: parseFloat(document.getElementById('swal-persen-bayar').value) || 0,
                        nominal: nominalRaw,
                        tanggal_jatuh_tempo: document.getElementById('swal-jatuh-tempo').value || null,
                        catatan: document.getElementById('swal-catatan-termin').value || null,
                        development_progress_item_id: itemId,
                    };
                }
            }).then(result => {
                if (result.isConfirmed && result.value) {
                    simpanTermin(result.value);
                }
            });
        }

        /* ─── PEMBAYARAN TERMIN ─── */
        function modalTambahTermin() {
            if (!PROGRESS_ID) {
                Swal.fire('Perhatian', 'Simpan data RAP terlebih dahulu sebelum menambah termin.', 'warning');
                return;
            }
            const nextTermin = {{ $pembayaranTermin->count() + 1 }};
            Swal.fire({
                title: '<i class="mdi mdi-cash-multiple text-primary me-2"></i>Tambah Termin Pembayaran',
                width: 680,
                html: `
                    <div class="text-start">
                        <div class="row g-3">
                            <div class="col-4">
                                <label class="form-label small fw-bold text-muted mb-1">Termin Ke</label>
                                <input type="number" id="swal-termin-ke" class="form-control form-control-sm" value="${nextTermin}" min="1">
                            </div>
                            <div class="col-8">
                                <label class="form-label small fw-bold text-muted mb-1">Nama Termin <span class="text-danger">*</span></label>
                                <input type="text" id="swal-nama-termin" class="form-control form-control-sm" placeholder="Contoh: Termin 1 – Pekerjaan Pondasi">
                            </div>
                            <div class="col-12">
                                <label class="form-label small fw-bold text-muted mb-1">Uraian Pekerjaan</label>
                                <textarea id="swal-uraian-termin" class="form-control form-control-sm" rows="2" placeholder="Deskripsi pekerjaan yang dibayar pada termin ini..."></textarea>
                            </div>
                            <div class="col-4">
                                <label class="form-label small fw-bold text-muted mb-1">Syarat Progress (%)</label>
                                <input type="number" id="swal-syarat-progress" class="form-control form-control-sm" placeholder="0" min="0" max="100" step="5">
                            </div>
                            <div class="col-4">
                                <label class="form-label small fw-bold text-muted mb-1">% Bayar dari Kontrak</label>
                                <input type="number" id="swal-persen-bayar" class="form-control form-control-sm" placeholder="0" min="0" max="100" step="5">
                            </div>
                            <div class="col-4">
                                <label class="form-label small fw-bold text-muted mb-1">Nominal (Rp) <span class="text-danger">*</span></label>
                                <input type="text" id="swal-nominal" class="form-control form-control-sm font-monospace" placeholder="0" oninput="this.value=this.value.replace(/[^0-9]/g,'').replace(/\\B(?=(\\d{3})+(?!\\d))/g,'.')">
                            </div>
                            <div class="col-6">
                                <label class="form-label small fw-bold text-muted mb-1">Tanggal Jatuh Tempo</label>
                                <input type="date" id="swal-jatuh-tempo" class="form-control form-control-sm">
                            </div>
                            <div class="col-12">
                                <label class="form-label small fw-bold text-muted mb-1">Catatan</label>
                                <textarea id="swal-catatan-termin" class="form-control form-control-sm" rows="2" placeholder="Catatan tambahan..."></textarea>
                            </div>
                        </div>
                    </div>
                `,
                showCancelButton: true,
                confirmButtonColor: '#3b82f6',
                cancelButtonColor: '#6c757d',
                confirmButtonText: '<i class="mdi mdi-check me-1"></i>Simpan Termin',
                cancelButtonText: 'Batal',
                preConfirm: () => {
                    const namaTermin = document.getElementById('swal-nama-termin').value.trim();
                    const nominalRaw = document.getElementById('swal-nominal').value;
                    if (!namaTermin) {
                        Swal.showValidationMessage('Nama termin wajib diisi!');
                        return false;
                    }
                    const nominal = nominalRaw.replace(/\./g, '');
                    return {
                        termin_ke: parseInt(document.getElementById('swal-termin-ke').value),
                        nama_termin: namaTermin,
                        uraian_pekerjaan: document.getElementById('swal-uraian-termin').value || null,
                        syarat_progress_persen: parseFloat(document.getElementById('swal-syarat-progress').value) || 0,
                        persentase_bayar: parseFloat(document.getElementById('swal-persen-bayar').value) || 0,
                        nominal: nominal,
                        tanggal_jatuh_tempo: document.getElementById('swal-jatuh-tempo').value || null,
                        catatan: document.getElementById('swal-catatan-termin').value || null,
                    };
                }
            }).then(result => {
                if (result.isConfirmed && result.value) {
                    simpanTermin(result.value);
                }
            });
        }

        function simpanTermin(data) {
            Swal.fire({ title: 'Menyimpan...', allowOutsideClick: false, didOpen: () => Swal.showLoading() });
            fetch('{{ route("properti.progress.termin.store") }}', {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': CSRF_TOKEN, 'Content-Type': 'application/json', 'Accept': 'application/json' },
                body: JSON.stringify({ ...data, development_progress_id: PROGRESS_ID, land_bank_unit_id: UNIT_ID })
            })
            .then(res => res.json())
            .then(resp => {
                if (resp.success) {
                    Swal.fire({ icon: 'success', title: 'Berhasil!', text: resp.message, timer: 1800, showConfirmButton: false })
                        .then(() => window.location.reload());
                } else {
                    Swal.fire('Gagal!', resp.message || 'Terjadi kesalahan.', 'error');
                }
            })
            .catch(() => Swal.fire('Error!', 'Terjadi kesalahan server.', 'error'));
        }

        document.addEventListener('click', function(e) {
            // Bayar termin
            const btnBayar = e.target.closest('.btn-bayar-termin');
            if (btnBayar) {
                const id = btnBayar.dataset.id;
                const nama = btnBayar.dataset.nama;
                const nominal = btnBayar.dataset.nominal;
                Swal.fire({
                    title: `Tandai Dibayar?`,
                    html: `
                        <div class="text-start">
                            <p class="mb-2"><strong>${nama}</strong> — Rp ${nominal}</p>
                            <label class="form-label small fw-bold text-muted mb-1">No. Bukti Bayar</label>
                            <input type="text" id="swal-no-bukti" class="form-control form-control-sm mb-2" placeholder="No. kwitansi / transfer">
                            <label class="form-label small fw-bold text-muted mb-1">Tanggal Bayar</label>
                            <input type="date" id="swal-tgl-bayar" class="form-control form-control-sm mb-2" value="${new Date().toISOString().substr(0,10)}">
                            <label class="form-label small fw-bold text-muted mb-1">Catatan</label>
                            <textarea id="swal-catatan-bayar" class="form-control form-control-sm" rows="2" placeholder="Catatan pembayaran..."></textarea>
                        </div>
                    `,
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#10b981',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: '<i class="mdi mdi-cash-check me-1"></i>Konfirmasi Dibayar',
                    cancelButtonText: 'Batal'
                }).then(result => {
                    if (result.isConfirmed) {
                        fetch(`/properti/progress/termin/${id}/status`, {
                            method: 'PUT',
                            headers: { 'X-CSRF-TOKEN': CSRF_TOKEN, 'Content-Type': 'application/json', 'Accept': 'application/json' },
                            body: JSON.stringify({
                                status: 'dibayar',
                                no_bukti_bayar: document.getElementById('swal-no-bukti').value,
                                tanggal_bayar: document.getElementById('swal-tgl-bayar').value,
                                catatan: document.getElementById('swal-catatan-bayar').value,
                            })
                        })
                        .then(r => r.json())
                        .then(resp => {
                            if (resp.success) {
                                Swal.fire({ icon: 'success', title: 'Dibayar!', text: resp.message, timer: 1500, showConfirmButton: false })
                                    .then(() => window.location.reload());
                            } else {
                                Swal.fire('Gagal!', resp.message, 'error');
                            }
                        });
                    }
                });
            }

            // Hapus termin
            const btnHapusTermin = e.target.closest('.btn-hapus-termin');
            if (btnHapusTermin) {
                const id = btnHapusTermin.dataset.id;
                Swal.fire({
                    title: 'Hapus Termin?',
                    text: 'Data termin pembayaran ini akan dihapus permanen.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc3545',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal'
                }).then(result => {
                    if (result.isConfirmed) {
                        fetch(`/properti/progress/termin/${id}`, {
                            method: 'DELETE',
                            headers: { 'X-CSRF-TOKEN': CSRF_TOKEN, 'Accept': 'application/json' }
                        })
                        .then(r => r.json())
                        .then(resp => {
                            if (resp.success) {
                                Swal.fire({ icon: 'success', title: 'Dihapus!', text: resp.message, timer: 1500, showConfirmButton: false })
                                    .then(() => window.location.reload());
                            } else {
                                Swal.fire('Gagal!', resp.message, 'error');
                            }
                        });
                    }
                });
            }
        });
    </script>
@endpush
