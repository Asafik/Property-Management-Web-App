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
                                                    <td colspan="11" class="text-center text-muted py-3">
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
                                                <td colspan="6" class="text-end pe-3 pe-md-4 py-2.5">
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
            @endphp

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
            $isUnitSoldOut = false; // TODO: set to true when unit is sold/completed to lock editing
            $totalOpname = $opnameMingguan->count();
            $latestKumulatif = $opnameMingguan->last()?->progress_kumulatif ?? 0;
        @endphp
        <div class="row mt-3 mt-md-4">
            <div class="col-12">
                <div class="card shadow-sm border-0" style="border-radius: 14px; overflow: hidden;">
                    <div class="card-header d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-2 py-3 px-4" style="background: linear-gradient(135deg, #f0fdf4, #dcfce7); border-bottom: 1.5px solid #bbf7d0;">
                        <div class="d-flex align-items-center gap-2">
                            <div style="width:38px;height:38px;border-radius:10px;background:rgba(16,185,129,0.12);color:#10b981;display:flex;align-items:center;justify-content:center;font-size:1.3rem;">
                                <i class="mdi mdi-clipboard-list-outline"></i>
                            </div>
                            <div>
                                <h5 class="mb-0 fw-bold text-dark" style="font-size: 1rem;">Opname Mingguan</h5>
                                <small class="text-muted">Laporan progress fisik per minggu · Kumulatif: <strong class="text-success">{{ number_format($latestKumulatif, 1) }}%</strong></small>
                            </div>
                        </div>
                        <div class="d-flex gap-2 flex-wrap">
                            <span class="badge bg-success bg-opacity-15 text-success fw-bold px-3 py-1.5 rounded-2" style="font-size:0.82rem;">{{ $totalOpname }} Laporan</span>
                            @if(!$isUnitSoldOut)
                                <button type="button" class="btn btn-sm btn-success text-white px-3 fw-semibold shadow-sm rounded-2" onclick="modalTambahOpname()" id="btnTambahOpname">
                                    <i class="mdi mdi-plus me-1"></i>Tambah Opname
                                </button>
                            @endif
                        </div>
                    </div>

                    <div class="card-body p-0">
                        @if($opnameMingguan->isNotEmpty())
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0" style="font-size:0.84rem;">
                                    <thead style="background:#f8fffe;">
                                        <tr>
                                            <th class="px-3 py-2 text-muted fw-bold" style="width:60px; font-size:0.75rem; text-transform:uppercase;">No</th>
                                            <th class="px-3 py-2 text-muted fw-bold" style="font-size:0.75rem; text-transform:uppercase;">No Opname</th>
                                            <th class="px-3 py-2 text-muted fw-bold" style="font-size:0.75rem; text-transform:uppercase;">Periode Minggu</th>
                                            <th class="px-3 py-2 text-muted fw-bold text-center" style="width:120px; font-size:0.75rem; text-transform:uppercase;">Progress Minggu</th>
                                            <th class="px-3 py-2 text-muted fw-bold text-center" style="width:120px; font-size:0.75rem; text-transform:uppercase;">Kumulatif</th>
                                            <th class="px-3 py-2 text-muted fw-bold" style="font-size:0.75rem; text-transform:uppercase;">Uraian Pekerjaan</th>
                                            <th class="px-3 py-2 text-muted fw-bold text-center" style="width:110px; font-size:0.75rem; text-transform:uppercase;">Status</th>
                                            <th class="px-3 py-2 text-muted fw-bold text-center" style="width:80px; font-size:0.75rem; text-transform:uppercase;">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tableBodyOpname">
                                        @foreach($opnameMingguan as $opname)
                                        <tr>
                                            <td class="px-3 text-center fw-bold text-muted">{{ $loop->iteration }}</td>
                                            <td class="px-3">
                                                <span class="fw-bold font-monospace text-success">{{ $opname->no_opname ?? '-' }}</span>
                                                <br><small class="text-muted">Minggu ke-{{ $opname->minggu_ke }}</small>
                                            </td>
                                            <td class="px-3">
                                                <div class="fw-semibold">{{ \Carbon\Carbon::parse($opname->tanggal_mulai_minggu)->isoFormat('D MMM') }} – {{ \Carbon\Carbon::parse($opname->tanggal_akhir_minggu)->isoFormat('D MMM Y') }}</div>
                                            </td>
                                            <td class="px-3 text-center">
                                                <div class="fw-bold text-success" style="font-size:1.05rem;">{{ number_format($opname->progress_minggu_ini, 1) }}%</div>
                                                <div class="progress mt-1" style="height:5px; border-radius:4px;">
                                                    <div class="progress-bar bg-success" style="width:{{ $opname->progress_minggu_ini }}%"></div>
                                                </div>
                                            </td>
                                            <td class="px-3 text-center">
                                                <div class="fw-bold text-primary" style="font-size:1rem;">{{ number_format($opname->progress_kumulatif, 1) }}%</div>
                                            </td>
                                            <td class="px-3">
                                                @if($opname->uraian_pekerjaan && count($opname->uraian_pekerjaan) > 0)
                                                    <ul class="mb-0 ps-3" style="font-size:0.8rem;">
                                                        @foreach(array_slice($opname->uraian_pekerjaan, 0, 3) as $uraian)
                                                            <li>{{ $uraian }}</li>
                                                        @endforeach
                                                        @if(count($opname->uraian_pekerjaan) > 3)
                                                            <li class="text-muted">+{{ count($opname->uraian_pekerjaan) - 3 }} lainnya...</li>
                                                        @endif
                                                    </ul>
                                                @else
                                                    <span class="text-muted small">{{ $opname->catatan ?? '-' }}</span>
                                                @endif
                                            </td>
                                            <td class="px-3 text-center">
                                                <span class="badge bg-{{ $opname->status_badge_class }} bg-opacity-15 text-{{ $opname->status_badge_class }} fw-bold px-2 py-1 rounded-2" style="font-size:0.75rem;">{{ $opname->status_label }}</span>
                                            </td>
                                            <td class="px-3 text-center">
                                                @if(!$isUnitSoldOut)
                                                <button type="button" class="btn btn-sm btn-outline-danger rounded-circle p-1 btn-hapus-opname" data-id="{{ $opname->id }}" style="width:28px;height:28px;display:inline-flex;align-items:center;justify-content:center;">
                                                    <i class="mdi mdi-trash-can-outline" style="font-size:0.85rem;"></i>
                                                </button>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-center py-5 text-muted">
                                <i class="mdi mdi-clipboard-text-off-outline" style="font-size:3rem; opacity:0.25;"></i>
                                <p class="mt-2 mb-0 fw-semibold" style="font-size:0.9rem;">Belum ada laporan opname mingguan</p>
                                <small>Klik "Tambah Opname" untuk mencatat progres fisik pembangunan per minggu</small>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        {{-- ============================================================
             PEMBAYARAN TERMIN
        ============================================================ --}}
        @php
            $totalTermin = $pembayaranTermin->count();
            $totalNominalTermin = $pembayaranTermin->sum('nominal');
            $sudahDibayar = $pembayaranTermin->where('status', 'dibayar')->sum('nominal');
            $belumDibayar = $totalNominalTermin - $sudahDibayar;
        @endphp
        <div class="row mt-3 mt-md-4 mb-4">
            <div class="col-12">
                <div class="card shadow-sm border-0" style="border-radius: 14px; overflow: hidden;">
                    <div class="card-header d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-2 py-3 px-4" style="background: linear-gradient(135deg, #eff6ff, #dbeafe); border-bottom: 1.5px solid #bfdbfe;">
                        <div class="d-flex align-items-center gap-2">
                            <div style="width:38px;height:38px;border-radius:10px;background:rgba(59,130,246,0.12);color:#3b82f6;display:flex;align-items:center;justify-content:center;font-size:1.3rem;">
                                <i class="mdi mdi-cash-multiple"></i>
                            </div>
                            <div>
                                <h5 class="mb-0 fw-bold text-dark" style="font-size: 1rem;">Pembayaran Termin Pembangunan</h5>
                                <small class="text-muted">
                                    Total: <strong class="text-primary">Rp {{ number_format($totalNominalTermin, 0, ',', '.') }}</strong>
                                    · Dibayar: <strong class="text-success">Rp {{ number_format($sudahDibayar, 0, ',', '.') }}</strong>
                                    · Sisa: <strong class="text-danger">Rp {{ number_format($belumDibayar, 0, ',', '.') }}</strong>
                                </small>
                            </div>
                        </div>
                        <div class="d-flex gap-2 flex-wrap">
                            <span class="badge bg-primary bg-opacity-15 text-primary fw-bold px-3 py-1.5 rounded-2" style="font-size:0.82rem;">{{ $totalTermin }} Termin</span>
                            @if(!$isUnitSoldOut)
                                <button type="button" class="btn btn-sm btn-primary text-white px-3 fw-semibold shadow-sm rounded-2" onclick="modalTambahTermin()">
                                    <i class="mdi mdi-plus me-1"></i>Tambah Termin
                                </button>
                            @endif
                        </div>
                    </div>

                    <div class="card-body p-0">
                        @if($pembayaranTermin->isNotEmpty())
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0" style="font-size:0.84rem;">
                                    <thead style="background:#f5f9ff;">
                                        <tr>
                                            <th class="px-3 py-2 text-muted fw-bold" style="width:60px;font-size:0.75rem;text-transform:uppercase;">Termin</th>
                                            <th class="px-3 py-2 text-muted fw-bold" style="font-size:0.75rem;text-transform:uppercase;">Nama Termin</th>
                                            <th class="px-3 py-2 text-muted fw-bold" style="font-size:0.75rem;text-transform:uppercase;">Uraian Pekerjaan</th>
                                            <th class="px-3 py-2 text-muted fw-bold text-center" style="width:110px;font-size:0.75rem;text-transform:uppercase;">Syarat Progress</th>
                                            <th class="px-3 py-2 text-muted fw-bold text-end" style="width:150px;font-size:0.75rem;text-transform:uppercase;">Nominal</th>
                                            <th class="px-3 py-2 text-muted fw-bold text-center" style="width:110px;font-size:0.75rem;text-transform:uppercase;">Jatuh Tempo</th>
                                            <th class="px-3 py-2 text-muted fw-bold text-center" style="width:110px;font-size:0.75rem;text-transform:uppercase;">Status</th>
                                            <th class="px-3 py-2 text-muted fw-bold text-center" style="width:100px;font-size:0.75rem;text-transform:uppercase;">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tableBodyTermin">
                                        @foreach($pembayaranTermin as $termin)
                                        @php
                                            $statusColor = match($termin->status) {
                                                'dibayar'   => 'success',
                                                'disetujui' => 'info',
                                                'diajukan'  => 'warning',
                                                'ditolak'   => 'danger',
                                                default     => 'secondary',
                                            };
                                        @endphp
                                        <tr @if($termin->status === 'dibayar') style="background: rgba(16,185,129,0.04);" @endif>
                                            <td class="px-3 text-center">
                                                <span class="badge bg-primary bg-opacity-15 text-primary fw-bold rounded-circle" style="width:28px;height:28px;display:inline-flex;align-items:center;justify-content:center;font-size:0.85rem;">{{ $termin->termin_ke }}</span>
                                            </td>
                                            <td class="px-3">
                                                <div class="fw-bold text-dark">{{ $termin->nama_termin }}</div>
                                                @if($termin->persentase_bayar > 0)
                                                    <small class="text-muted">{{ $termin->persentase_bayar }}% dari nilai kontrak</small>
                                                @endif
                                            </td>
                                            <td class="px-3">
                                                <small class="text-muted" style="font-size:0.8rem;">{{ $termin->uraian_pekerjaan ? \Str::limit($termin->uraian_pekerjaan, 80) : '-' }}</small>
                                            </td>
                                            <td class="px-3 text-center">
                                                @if($termin->syarat_progress_persen > 0)
                                                    <span class="badge bg-warning bg-opacity-15 text-warning fw-bold rounded-2">≥ {{ $termin->syarat_progress_persen }}%</span>
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>
                                            <td class="px-3 text-end">
                                                <span class="fw-bold font-monospace text-{{ $termin->status === 'dibayar' ? 'success' : 'dark' }}" style="font-size:0.92rem;">
                                                    Rp {{ number_format($termin->nominal, 0, ',', '.') }}
                                                </span>
                                                @if($termin->status === 'dibayar' && $termin->tanggal_bayar)
                                                    <br><small class="text-success"><i class="mdi mdi-check-circle me-0.5"></i>{{ \Carbon\Carbon::parse($termin->tanggal_bayar)->isoFormat('D MMM Y') }}</small>
                                                @endif
                                            </td>
                                            <td class="px-3 text-center">
                                                <small class="text-muted">{{ $termin->tanggal_jatuh_tempo ? \Carbon\Carbon::parse($termin->tanggal_jatuh_tempo)->isoFormat('D MMM Y') : '-' }}</small>
                                            </td>
                                            <td class="px-3 text-center">
                                                <span class="badge bg-{{ $statusColor }} bg-opacity-15 text-{{ $statusColor }} fw-bold px-2 py-1 rounded-2" style="font-size:0.75rem;">{{ $termin->status_label }}</span>
                                            </td>
                                            <td class="px-3 text-center">
                                                <div class="d-flex gap-1 justify-content-center">
                                                    @if(!$isUnitSoldOut && $termin->status !== 'dibayar')
                                                        <button type="button" class="btn btn-sm btn-outline-success rounded-2 px-2 py-1 btn-bayar-termin"
                                                            data-id="{{ $termin->id }}"
                                                            data-nama="{{ $termin->nama_termin }}"
                                                            data-nominal="{{ number_format($termin->nominal, 0, ',', '.') }}"
                                                            style="font-size:0.75rem;" title="Tandai Dibayar">
                                                            <i class="mdi mdi-cash-check"></i>
                                                        </button>
                                                    @endif
                                                    @if(!$isUnitSoldOut)
                                                        <button type="button" class="btn btn-sm btn-outline-danger rounded-circle p-1 btn-hapus-termin"
                                                            data-id="{{ $termin->id }}"
                                                            style="width:28px;height:28px;display:inline-flex;align-items:center;justify-content:center;">
                                                            <i class="mdi mdi-trash-can-outline" style="font-size:0.85rem;"></i>
                                                        </button>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr style="background:#f5f9ff; border-top: 2px solid #bfdbfe;">
                                            <td colspan="4" class="px-3 py-2 fw-bold text-dark text-end small">TOTAL PEMBAYARAN TERMIN</td>
                                            <td class="px-3 py-2 text-end fw-bold text-primary font-monospace" style="font-size:0.95rem;">Rp {{ number_format($totalNominalTermin, 0, ',', '.') }}</td>
                                            <td colspan="3" class="px-3 py-2 small text-muted">{{ $pembayaranTermin->where('status', 'dibayar')->count() }}/{{ $totalTermin }} termin terbayar</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        @else
                            <div class="text-center py-5 text-muted">
                                <i class="mdi mdi-cash-off" style="font-size:3rem; opacity:0.25;"></i>
                                <p class="mt-2 mb-0 fw-semibold" style="font-size:0.9rem;">Belum ada termin pembayaran</p>
                                <small>Klik "Tambah Termin" untuk menambahkan jadwal pembayaran berdasarkan progress pembangunan</small>
                            </div>
                        @endif
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

        /* ─── OPNAME MINGGUAN ─── */
        function modalTambahOpname() {
            if (!PROGRESS_ID) {
                Swal.fire('Perhatian', 'Simpan data RAP terlebih dahulu sebelum menambah opname.', 'warning');
                return;
            }
            const nextMinggu = {{ $opnameMingguan->count() + 1 }};
            Swal.fire({
                title: '<i class="mdi mdi-clipboard-list-outline text-success me-2"></i>Tambah Opname Mingguan',
                width: 700,
                html: `
                    <div class="text-start">
                        <div class="row g-3">
                            <div class="col-6">
                                <label class="form-label small fw-bold text-muted mb-1">Minggu Ke</label>
                                <input type="number" id="swal-minggu-ke" class="form-control form-control-sm" value="${nextMinggu}" min="1">
                            </div>
                            <div class="col-6">
                                <label class="form-label small fw-bold text-muted mb-1">Jumlah Pekerja</label>
                                <input type="number" id="swal-pekerja" class="form-control form-control-sm" placeholder="0" min="0">
                            </div>
                            <div class="col-6">
                                <label class="form-label small fw-bold text-muted mb-1">Tanggal Mulai Minggu</label>
                                <input type="date" id="swal-tgl-mulai" class="form-control form-control-sm">
                            </div>
                            <div class="col-6">
                                <label class="form-label small fw-bold text-muted mb-1">Tanggal Akhir Minggu</label>
                                <input type="date" id="swal-tgl-akhir" class="form-control form-control-sm">
                            </div>
                            <div class="col-6">
                                <label class="form-label small fw-bold text-muted mb-1">Progress Minggu Ini (%)</label>
                                <input type="number" id="swal-prog-minggu" class="form-control form-control-sm" placeholder="0.00" min="0" max="100" step="0.5">
                            </div>
                            <div class="col-6">
                                <label class="form-label small fw-bold text-muted mb-1">Progress Kumulatif (%)</label>
                                <input type="number" id="swal-prog-kumulatif" class="form-control form-control-sm" placeholder="0.00" min="0" max="100" step="0.5">
                            </div>
                            <div class="col-12">
                                <label class="form-label small fw-bold text-muted mb-1">Uraian Pekerjaan Minggu Ini</label>
                                <small class="text-muted d-block mb-1">Satu baris = satu uraian pekerjaan</small>
                                <textarea id="swal-uraian" class="form-control form-control-sm" rows="3" placeholder="Contoh:&#10;Pemasangan kolom lantai 1&#10;Cor balok ring"></textarea>
                            </div>
                            <div class="col-6">
                                <label class="form-label small fw-bold text-muted mb-1">Material Digunakan</label>
                                <textarea id="swal-material" class="form-control form-control-sm" rows="2" placeholder="Semen, pasir, besi 10mm..."></textarea>
                            </div>
                            <div class="col-6">
                                <label class="form-label small fw-bold text-muted mb-1">Kendala / Hambatan</label>
                                <textarea id="swal-kendala" class="form-control form-control-sm" rows="2" placeholder="Cuaca buruk, keterlambatan material..."></textarea>
                            </div>
                            <div class="col-6">
                                <label class="form-label small fw-bold text-muted mb-1">Solusi</label>
                                <textarea id="swal-solusi" class="form-control form-control-sm" rows="2" placeholder="Solusi dari kendala..."></textarea>
                            </div>
                            <div class="col-6">
                                <label class="form-label small fw-bold text-muted mb-1">Rencana Minggu Depan</label>
                                <textarea id="swal-rencana" class="form-control form-control-sm" rows="2" placeholder="Rencana pekerjaan minggu berikutnya..."></textarea>
                            </div>
                        </div>
                    </div>
                `,
                showCancelButton: true,
                confirmButtonColor: '#10b981',
                cancelButtonColor: '#6c757d',
                confirmButtonText: '<i class="mdi mdi-check me-1"></i>Simpan Opname',
                cancelButtonText: 'Batal',
                preConfirm: () => {
                    const mingguKe = document.getElementById('swal-minggu-ke').value;
                    const tglMulai = document.getElementById('swal-tgl-mulai').value;
                    const tglAkhir = document.getElementById('swal-tgl-akhir').value;
                    if (!mingguKe || !tglMulai || !tglAkhir) {
                        Swal.showValidationMessage('Minggu ke, tanggal mulai, dan tanggal akhir wajib diisi!');
                        return false;
                    }
                    const uraianRaw = document.getElementById('swal-uraian').value;
                    const uraianArr = uraianRaw.split('\n').map(s => s.trim()).filter(s => s.length > 0);
                    return {
                        minggu_ke: parseInt(mingguKe),
                        tanggal_mulai_minggu: tglMulai,
                        tanggal_akhir_minggu: tglAkhir,
                        progress_minggu_ini: parseFloat(document.getElementById('swal-prog-minggu').value) || 0,
                        progress_kumulatif: parseFloat(document.getElementById('swal-prog-kumulatif').value) || 0,
                        jumlah_pekerja: parseInt(document.getElementById('swal-pekerja').value) || null,
                        uraian_pekerjaan: uraianArr,
                        material_digunakan: document.getElementById('swal-material').value || null,
                        kendala: document.getElementById('swal-kendala').value || null,
                        solusi: document.getElementById('swal-solusi').value || null,
                        rencana_minggu_depan: document.getElementById('swal-rencana').value || null,
                    };
                }
            }).then(result => {
                if (result.isConfirmed && result.value) {
                    simpanOpname(result.value);
                }
            });
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
