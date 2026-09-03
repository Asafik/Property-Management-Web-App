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
            gap: 6px;
            padding: 0.35rem 0.6rem;
            background: #f8fafc;
            border: 1px dashed #cbd5e1;
            border-radius: 6px;
            font-size: 0.75rem;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .file-upload-label:hover, .file-upload-label.file-selected {
            border-color: #9a55ff;
            background: #f3e8ff;
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
    </style>

    <div class="container-fluid p-4">
        <!-- Header Card Banner -->
        <div class="row mb-3 mb-md-4">
            <div class="col-12">
                <div class="card shadow-sm border-0 header-card">
                    <div class="card-body p-4 p-md-4 py-4 py-md-4 d-flex justify-content-between align-items-center" style="min-height: 105px;">
                        <div>
                            <h3 class="text-dark mb-1 fw-bold" style="font-size: 1.35rem;">
                                Rencana Anggaran Pekerjaan (RAP) Pembangunan
                            </h3>
                            <p class="text-muted mb-0" style="font-size: 0.9rem;">
                                Rincian anggaran pekerjaan pembangunan unit dari awal hingga selesai
                            </p>
                        </div>
                        <div class="d-none d-sm-block pe-2">
                            <i class="mdi mdi-calculator" style="font-size: 3rem; color: #9a55ff; opacity: 0.25;"></i>
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
        <div class="row mb-4">
            <div class="col-12">
                <div class="card shadow-sm border-0 rab-info-card">
                    <div class="row g-3 align-items-center">
                        {{-- UNIT --}}
                        <div class="col-12 col-sm-6 col-md-2">
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
                        <div class="col-12 col-sm-6 col-md-3">
                            <span class="rab-label">
                                <i class="mdi mdi-shape-outline text-info me-1"></i>Tipe / Nama
                            </span>
                            <input type="text" id="unitType" class="rab-form-control" readonly>
                        </div>

                        {{-- LUAS TANAH --}}
                        <div class="col-6 col-sm-4 col-md-2">
                            <span class="rab-label">
                                <i class="mdi mdi-ruler-square text-warning me-1"></i>Luas Tanah
                            </span>
                            <input type="text" id="unitArea" class="rab-form-control" readonly>
                        </div>

                        {{-- LUAS BANGUNAN --}}
                        <div class="col-6 col-sm-4 col-md-2">
                            <span class="rab-label">
                                <i class="mdi mdi-office-building-marker text-success me-1"></i>Luas Bangunan
                            </span>
                            <input type="text" id="unitBuilding" class="rab-form-control" readonly>
                        </div>

                        {{-- HARGA --}}
                        <div class="col-12 col-sm-4 col-md-3">
                            <span class="rab-label">
                                <i class="mdi mdi-currency-usd text-danger me-1"></i>Harga Jual Unit
                            </span>
                            <input type="text" id="unitPrice" class="rab-form-control fw-bold text-success" readonly>
                        </div>
                    </div>
                </div>
            </div>
        </div>

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

            {{-- TOOLBAR DINAMIS: SEEDER TEMPLATE, TAMBAH KATEGORI & MENU MASTER --}}
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4 p-3 bg-white rounded-3 border shadow-sm">
                <div class="d-flex align-items-center gap-2">
                    <span class="badge bg-primary px-3 py-2" style="font-size: 0.82rem;">
                        <i class="mdi mdi-layers-outline me-1"></i>{{ count($kategoriConfig) }} Kategori Pekerjaan Terhubung Master
                    </span>
                    <span class="text-muted small d-none d-md-inline">Seluruh tahapan dari Perizinan sampai Pekerjaan Lainnya dikelola secara dinamis.</span>
                </div>
                <div class="d-flex flex-wrap gap-2">
                    <a href="{{ route('master.progress.index') }}" target="_blank" class="btn btn-sm btn-outline-secondary shadow-sm px-3" style="border-radius: 8px; font-weight: 600;" title="Kelola Master Kategori & Item Template">
                        <i class="mdi mdi-cog-outline me-1"></i>Menu Master Tahapan
                    </a>
                    <button type="button" class="btn btn-sm btn-outline-primary shadow-sm px-3" onclick="confirmApplyTemplate()" style="border-radius: 8px; font-weight: 600;">
                        <i class="mdi mdi-flash me-1"></i>⚡ Terapkan Template Standar RAP
                    </button>
                    <button type="button" class="btn btn-sm btn-outline-success shadow-sm px-3" onclick="modalTambahKategoriBaru()" style="border-radius: 8px; font-weight: 600;">
                        <i class="mdi mdi-plus-circle-outline me-1"></i>+ Tambah Kategori Baru
                    </button>
                </div>
            </div>

            <div id="dynamic-categories-container">
            @foreach ($kategoriConfig as $key => $cfg)
                <div class="row mb-4 category-section" id="section-{{ $key }}">
                    <div class="col-12">
                        <div class="card shadow-sm border-0 rab-card">
                            <div class="card-header rab-card-header d-flex justify-content-between align-items-center py-3">
                                <h5 class="mb-0 fw-bold">
                                    <i class="mdi mdi-{{ $cfg['icon'] ?? 'dots-horizontal' }} me-2" style="color: #9a55ff;"></i>
                                    {{ $cfg['title'] }}
                                </h5>
                                <button type="button" class="rab-btn-add"
                                    onclick="tambahItem('{{ $key }}')">
                                    <i class="mdi mdi-plus me-1"></i>Tambah Item
                                </button>
                            </div>

                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-hover table-bordered align-middle mb-0 rab-table">
                                        <thead>
                                            <tr>
                                                <th style="width: 50px;">NO</th>
                                                <th>URAIAN</th>
                                                <th style="width: 90px;">VOLUME</th>
                                                <th style="width: 80px;">SATUAN</th>
                                                <th style="width: 140px;">HARGA</th>
                                                <th style="width: 150px;">TOTAL</th>
                                                <th>KETERANGAN</th>
                                                <th style="width: 130px;">DEADLINE</th>
                                                <th style="width: 140px;">DOKUMENTASI</th>
                                                <th style="width: 60px;">AKSI</th>
                                            </tr>
                                        </thead>
                                        <tbody id="body-{{ $key }}">
                                            {{-- DATA DARI DB --}}
                                            @if ($selectedUnit->progress)
                                                @foreach ($selectedUnit->progress->items->where('kategori', $key)->values() as $item)
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

                                                        <td>
                                                            <input type="date" name="deadline[{{ $item->id }}]"
                                                                class="form-control form-control-sm" style="border-radius: 6px;"
                                                                value="{{ $item->deadline ? $item->deadline->format('Y-m-d') : '' }}">
                                                        </td>

                                                        <td>
                                                            @php $documents = $item->documents; @endphp

                                                            @if ($documents->count())
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
                                                                        <span>Lihat</span>
                                                                    </a>
                                                                @endforeach
                                                            @else
                                                                <span class="text-muted">-</span>
                                                            @endif
                                                        </td>

                                                        <td class="text-center">
                                                            <button type="button" class="btn btn-outline-danger btn-sm" style="border-radius: 6px; padding: 4px 8px;"
                                                                onclick="hapusItem(this, '{{ $key }}', {{ $item->id }})" title="Hapus Item">
                                                                <i class="mdi mdi-trash-can-outline"></i>
                                                            </button>
                                                        </td>

                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="10" class="text-center text-muted py-3">
                                                        <i class="mdi mdi-information-outline me-1"></i>Belum ada progress untuk kategori ini
                                                    </td>
                                                </tr>
                                            @endif
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th colspan="6" class="text-end fw-bold text-dark">SUB TOTAL {{ strtoupper($key) }}</th>
                                                <th colspan="4">
                                                    <input type="text" id="subtotal-{{ $key }}"
                                                        class="rab-form-control text-end fw-bold text-primary"
                                                        style="font-size: 0.95rem;" readonly>
                                                </th>
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
                                <button type="submit" class="aksi-btn rab-btn-success">
                                    <i class="mdi mdi-content-save me-1"></i>Simpan
                                </button>

                                <a href="{{ route('cetak.rab', $selectedUnit->id) }}" target="_blank"
                                    class="aksi-btn rab-btn-primary">
                                    <i class="mdi mdi-printer me-1"></i>Cetak RAP
                                </a>

                                @if ($isAccCompleted)
                                    <button type="button" class="aksi-btn" style="background: #6c757d; cursor: not-allowed; opacity: 0.85;" disabled title="RAP untuk unit ini sudah di-ACC">
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
                    document.getElementById('formApplyTemplate').submit();
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
                        <div class="card shadow-sm border-0 rab-card">
                            <div class="card-header rab-card-header d-flex justify-content-between align-items-center py-3">
                                <h5 class="mb-0 fw-bold">
                                    <i class="mdi mdi-folder-plus-outline me-2" style="color: #10b981;"></i>
                                    ${title}
                                </h5>
                                <div class="d-flex gap-2">
                                    <button type="button" class="rab-btn-add" onclick="tambahItem('${cleanKey}')">
                                        <i class="mdi mdi-plus me-1"></i>Tambah Item
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
                                                <th style="width: 90px;">VOLUME</th>
                                                <th style="width: 80px;">SATUAN</th>
                                                <th style="width: 140px;">HARGA</th>
                                                <th style="width: 150px;">TOTAL</th>
                                                <th>KETERANGAN</th>
                                                <th style="width: 130px;">DEADLINE</th>
                                                <th style="width: 140px;">DOKUMENTASI</th>
                                                <th style="width: 60px;">AKSI</th>
                                            </tr>
                                        </thead>
                                        <tbody id="body-${cleanKey}">
                                            <tr>
                                                <td colspan="10" class="text-center py-3 text-muted">
                                                    Belum ada item pekerjaan. Klik <strong>+ Tambah Item</strong> di atas.
                                                </td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="5" class="text-end fw-bold rab-subtotal-label">
                                                    SUBTOTAL ${title}:
                                                </td>
                                                <td colspan="5">
                                                    <input type="text" id="subtotal-${cleanKey}"
                                                           class="form-control form-control-sm fw-bold rab-subtotal-input"
                                                           value="Rp 0" readonly>
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
            if (tbody.querySelector('tr td[colspan="10"]')) {
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
                                <i class="mdi mdi-cloud-upload text-primary"></i>
                                <div class="file-upload-info">
                                    <span id="fileName-${indexItem}">Pilih file dokumentasi</span>
                                    <small class="text-muted" style="font-size: 0.68rem;">Format: JPG, PNG, WEBP, PDF (Maks 10MB)</small>
                                </div>
                                <span class="file-upload-size" id="fileSize-${indexItem}"></span>
                            </div>
                        </div>
                    </td>
                    <td class="text-center">
                        <button type="button"
                                class="btn btn-outline-danger btn-sm" style="border-radius: 6px; padding: 4px 8px;"
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
            let str = val.toString().replace(/,/g, '.');
            return parseFloat(str) || 0;
        }

        function parseRupiahVal(val) {
            if (!val) return 0;
            let clean = val.toString().replace(/[^0-9]/g, '');
            return parseInt(clean, 10) || 0;
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
                    fileNameSpan.textContent = 'Pilih file dokumentasi';
                    fileSizeSpan.textContent = '';
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
                    fileNameSpan.textContent = 'Pilih file dokumentasi';
                    fileSizeSpan.textContent = '';
                    label.classList.remove('file-selected');
                    return;
                }

                fileNameSpan.textContent = file.name.length > 20 ? file.name.substring(0, 20) + '...' : file.name;

                if (file.size < 1024 * 1024) {
                    fileSizeSpan.textContent = (file.size / 1024).toFixed(1) + ' KB';
                } else {
                    fileSizeSpan.textContent = (file.size / (1024 * 1024)).toFixed(1) + ' MB';
                }

                label.classList.add('file-selected');
            } else {
                fileNameSpan.textContent = 'Pilih file dokumentasi';
                fileSizeSpan.textContent = '';
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

                document.querySelectorAll("#" + config.body + " tr").forEach(function(row) {
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
                        let totalText = row.cells[6]?.innerText || row.cells[5]?.innerText || "0";
                        let total = parseInt(totalText.replace(/[^0-9]/g, '')) || 0;
                        subtotal += total;
                    }
                });

                let subtotalInput = document.getElementById(config.subtotal);
                if (subtotalInput) {
                    subtotalInput.value = 'Rp ' + subtotal.toLocaleString('id-ID');
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
            if (e.target.classList.contains("volume") || e.target.classList.contains("harga-satuan")) {
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
@endpush
