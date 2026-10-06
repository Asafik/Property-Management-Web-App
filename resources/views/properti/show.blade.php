@extends('layouts.partial.app')

@section('title', 'Detail Properti - ' . $item->name)

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard-clean.css') }}?v={{ time() }}">
    <style>
        /* Tab Navigation */
        .custom-tabs-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.04);
            overflow: hidden;
        }
        .custom-tabs-header {
            background: #ffffff;
            border-bottom: 2px solid #edf2f7;
            padding: 0 1rem;
        }
        .custom-tabs-header .nav-tabs {
            border-bottom: none;
            gap: 0.5rem;
        }
        .custom-tabs-header .nav-link {
            border: none;
            color: #64748b;
            font-weight: 600;
            font-size: 0.88rem;
            padding: 1rem 1.25rem;
            border-bottom: 3px solid transparent;
            transition: all 0.2s ease;
            background: transparent;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }
        .custom-tabs-header .nav-link:hover {
            color: #9a55ff;
            border-bottom-color: #d8b4fe;
        }
        .custom-tabs-header .nav-link.active {
            color: #9a55ff !important;
            border-bottom-color: #9a55ff !important;
            background: transparent !important;
        }

        /* ==================== TABEL PERIZINAN (PERSIS PERIZINAN.SHOW) ==================== */
        .table-perizinan {
            width: 100% !important;
            margin-bottom: 0;
        }
        .table-perizinan thead th {
            background: #f8fafc !important;
            color: #4b5563 !important;
            font-weight: 700;
            font-size: 0.78rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 2px solid #e2e8f0 !important;
            padding: 0.75rem 0.6rem !important;
            vertical-align: middle;
            white-space: nowrap;
        }
        .table-perizinan tbody td {
            padding: 0.75rem 0.6rem !important;
            vertical-align: middle;
            font-size: 0.83rem;
            border-bottom: 1px solid #f1f5f9;
            white-space: normal !important;
        }
        .table-perizinan .col-no {
            width: 45px;
            text-align: center;
            white-space: nowrap !important;
        }
        .table-perizinan .col-kode {
            width: 100px;
            text-align: center;
            white-space: nowrap !important;
        }
        .table-perizinan .col-nama {
            min-width: 250px;
        }
        .table-perizinan .col-no-sk {
            width: 170px;
        }
        .table-perizinan .col-tgl {
            width: 130px;
            white-space: nowrap !important;
        }
        .table-perizinan .col-status {
            width: 90px;
            text-align: center;
            white-space: nowrap !important;
        }
        .table-perizinan .col-progres {
            width: 130px;
            white-space: nowrap !important;
        }
        .table-perizinan .col-aksi {
            width: 75px;
            text-align: center;
            white-space: nowrap !important;
        }

        /* Action Buttons Styling Persis Tabel Pasca */
        .action-group {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
        }
        .btn-action {
            width: 32px;
            height: 32px;
            padding: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            border: none;
            transition: all 0.2s ease;
            text-decoration: none !important;
            cursor: pointer;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.08);
        }
        .btn-action i {
            font-size: 0.95rem;
            line-height: 1;
        }
        .btn-action:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        }
        .btn-action.view {
            background: linear-gradient(135deg, #da8cff, #9a55ff);
            color: #ffffff !important;
        }
        .btn-action.view:hover {
            background: linear-gradient(135deg, #d279ff, #8b40ff);
            color: #ffffff !important;
        }

        /* Card Compact Persis Perizinan */
        .compact-table-card {
            background: #ffffff !important;
            border: 1px solid #e2e8f0 !important;
            border-radius: 8px !important;
            box-shadow: none !important;
            transition: border-color 0.2s ease;
            overflow: hidden;
        }
        .compact-table-card:hover {
            border-color: #cbd5e1 !important;
            box-shadow: none !important;
        }
        .compact-table-card .card-header {
            background: #ffffff !important;
            border-bottom: 1px solid #e2e8f0 !important;
            padding: 0.65rem 1.25rem !important;
            border-top-left-radius: 8px !important;
            border-top-right-radius: 8px !important;
        }
        .compact-table-card .card-body {
            padding: 0.75rem 1.25rem 1.15rem 1.25rem !important;
            background: #ffffff !important;
        }

        /* Status Badges Persis Perizinan */
        .status-badge.aktif {
            background-color: #ecfdf5 !important;
            color: #059669 !important;
            border: 1px solid #a7f3d0 !important;
            border-radius: 20px;
            font-weight: 600;
            display: inline-block;
        }
        .badge-development-progress {
            background-color: #eff6ff !important;
            color: #2563eb !important;
            border: 1px solid #bfdbfe !important;
            border-radius: 20px;
            font-weight: 600;
            display: inline-block;
        }
        .badge-development-belum {
            border-radius: 20px;
            font-weight: 600;
            border: 1px solid;
            display: inline-block;
        }

        .badge-category {
            display: inline-flex;
            align-items: center;
            padding: 0.35rem 0.75rem;
            border-radius: 6px;
            font-size: 0.78rem;
            font-weight: 600;
            background: rgba(154, 85, 255, 0.1);
            color: #9a55ff;
            border: 1px solid rgba(154, 85, 255, 0.2);
            text-transform: capitalize;
        }

        /* Detail Table Legalitas & Pengindukan */
        .table-detail-clean {
            width: 100% !important;
            margin-bottom: 0;
            border-collapse: collapse;
        }
        .table-detail-clean tr td {
            padding: 0.42rem 0 !important;
            border: none !important;
            vertical-align: middle;
        }
        .table-detail-clean td.col-lbl {
            width: 44%;
            color: #64748b;
            font-size: 0.83rem;
            text-align: left !important;
            font-weight: 500;
        }
        .table-detail-clean td.col-sep {
            width: 16px;
            text-align: center !important;
            color: #94a3b8;
            font-weight: 600;
            font-size: 0.84rem;
        }
        .table-detail-clean td.col-val {
            text-align: left !important;
            color: #1e293b;
            font-size: 0.84rem;
        }
    </style>
@endpush

@section('content')
<div class="content-wrapper">
    <div class="container-fluid px-2 px-md-4 py-3">

        <!-- Header Halaman Persis Perizinan Show -->
        <div class="d-flex flex-wrap justify-content-between align-items-start gap-3 mb-4">
            <div>
                <h2 class="text-dark mb-1 fw-bold" style="font-size: 1.55rem; letter-spacing: -0.02em;">
                    Detail Properti: {{ $item->name }}
                </h2>
                <p class="text-muted mb-0" style="font-size: 0.88rem;">
                    {{ $item->companyProfile->name ?? '-' }} &bull; {{ $item->city ?: 'Jember' }} &bull; Luas: {{ number_format($item->area ?? 0, 0, ',', '.') }} m²
                </p>
            </div>
            <div class="d-flex align-items-center gap-2">
                <a href="{{ route('properti.all') }}" class="btn btn-sm d-inline-flex align-items-center gap-2 px-3 py-2 shadow-sm text-white fw-bold" style="border: 1px solid #64748b; background-color: #64748b; border-radius: 8px; font-size: 0.85rem; transition: all 0.2s ease;">
                    <i class="mdi mdi-arrow-left text-white" style="font-size: 1.1rem; line-height: 1;"></i>
                    <span>Kembali</span>
                </a>
            </div>
        </div>

        <!-- 4 KPI Metrics Card Grid (Persis Halaman Pasca Land Bank) -->
        <div class="dash-kpi-grid mb-4">
            
            <!-- Card 1: Total Luas Lahan (Ungu) -->
            <div class="dash-kpi-card">
                <div class="dash-kpi-left">
                    <div class="dash-kpi-icon purple">
                        <i class="mdi mdi-texture-box"></i>
                    </div>
                    <div class="dash-kpi-info">
                        <div class="dash-kpi-label">Total Luas Lahan</div>
                        <div class="dash-kpi-val">{{ number_format($item->area ?? 0, 0, ',', '.') }} m²</div>
                        <div class="dash-kpi-sub">Sisa Efektif: {{ number_format($item->remaining_area ?? 0, 0, ',', '.') }} m²</div>
                    </div>
                </div>
                <div class="dash-kpi-action purple">
                    <i class="mdi mdi-arrow-right"></i>
                </div>
            </div>

            <!-- Card 2: Legalitas Terverifikasi (Hijau) -->
            <div class="dash-kpi-card">
                <div class="dash-kpi-left">
                    <div class="dash-kpi-icon green">
                        <i class="mdi mdi-check-decagram-outline"></i>
                    </div>
                    <div class="dash-kpi-info">
                        <div class="dash-kpi-label">Legalitas Dokumen PT</div>
                        <div class="dash-kpi-val">100%</div>
                        <div class="dash-kpi-sub">Dokumen Sah Atas Nama PT</div>
                    </div>
                </div>
                <div class="dash-kpi-action green">
                    <i class="mdi mdi-arrow-right"></i>
                </div>
            </div>

            <!-- Card 3: Dokumen Perizinan (Biru) -->
            <div class="dash-kpi-card">
                <div class="dash-kpi-left">
                    <div class="dash-kpi-icon blue">
                        <i class="mdi mdi-file-certificate-outline"></i>
                    </div>
                    <div class="dash-kpi-info">
                        <div class="dash-kpi-label">Dokumen Perizinan PT</div>
                        <div class="dash-kpi-val">{{ $totalTerbit ?? 0 }} / {{ $totalIzin ?? 0 }}</div>
                        <div class="dash-kpi-sub">{{ $totalProses ?? 0 }} Sedang Proses Dinas</div>
                    </div>
                </div>
                <div class="dash-kpi-action blue">
                    <i class="mdi mdi-arrow-right"></i>
                </div>
            </div>

            <!-- Card 4: Infrastruktur Kawasan (Kuning / Amber) -->
            <div class="dash-kpi-card">
                <div class="dash-kpi-left">
                    <div class="dash-kpi-icon amber">
                        <i class="mdi mdi-progress-wrench"></i>
                    </div>
                    <div class="dash-kpi-info">
                        <div class="dash-kpi-label">Infrastruktur Kawasan</div>
                        <div class="dash-kpi-val">{{ (float) $item->overall_infrastructure_progress }}%</div>
                        <div class="dash-kpi-sub">Status: {{ ucfirst($item->development_status ?? 'Belum Mulai') }}</div>
                    </div>
                </div>
                <div class="dash-kpi-action amber">
                    <i class="mdi mdi-arrow-right"></i>
                </div>
            </div>

        </div>

        @php
            $hasDenah = !empty($item->denah);
            $denahUrl = null;
            if ($hasDenah) {
                if (file_exists(public_path('uploads/' . $item->denah))) {
                    $denahUrl = asset('uploads/' . $item->denah);
                } elseif (file_exists(public_path($item->denah))) {
                    $denahUrl = asset($item->denah);
                } elseif (str_starts_with($item->denah, 'http://') || str_starts_with($item->denah, 'https://')) {
                    $denahUrl = $item->denah;
                } else {
                    $denahUrl = asset(str_starts_with($item->denah, 'uploads/') ? $item->denah : 'uploads/' . $item->denah);
                }
            }
        @endphp

        <!-- Custom Tabs Card (Konten Detail) -->
        <div class="custom-tabs-card">
            <!-- Tabs Navigation -->
            <div class="custom-tabs-header">
                <ul class="nav nav-tabs" id="propertyDetailTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="tab-info-btn" data-bs-toggle="tab" data-bs-target="#tab-info" type="button" role="tab" aria-controls="tab-info" aria-selected="true">
                            <i class="mdi mdi-card-account-details-outline"></i> Identitas Tanah
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="tab-legal-btn" data-bs-toggle="tab" data-bs-target="#tab-legal" type="button" role="tab" aria-controls="tab-legal" aria-selected="false">
                            <i class="mdi mdi-certificate-outline"></i> Legalitas & Pengindukan
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="tab-docs-btn" data-bs-toggle="tab" data-bs-target="#tab-docs" type="button" role="tab" aria-controls="tab-docs" aria-selected="false">
                            <i class="mdi mdi-file-document-check-outline text-primary"></i> Berkas Dokumen PT
                            <span class="badge rounded-pill bg-primary ms-1" style="font-size: 0.72rem;">{{ $perizinanDocs->count() }}</span>
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="tab-infra-btn" data-bs-toggle="tab" data-bs-target="#tab-infra" type="button" role="tab" aria-controls="tab-infra" aria-selected="false">
                            <i class="mdi mdi-road-variant"></i> Lahan & Akses Kawasan
                        </button>
                    </li>
                </ul>
            </div>

            <!-- Tab Content -->
            <div class="card-body p-3 p-md-4">
                <div class="tab-content" id="propertyDetailTabsContent">

                    <!-- ==================== TAB 1: IDENTITAS TANAH ==================== -->
                    <div class="tab-pane fade show active" id="tab-info" role="tabpanel" aria-labelledby="tab-info-btn">
                        <div class="row g-4">
                            <!-- Kolom Kiri: Identitas Proyek & Akuisisi Aset PT -->
                            <div class="col-lg-6">
                                <h6 class="fw-bold text-dark border-bottom pb-2 mb-3 d-flex align-items-center gap-1.5">
                                    <i class="mdi mdi-office-building-marker text-primary fs-5"></i> Identitas Properti & Akuisisi
                                </h6>
                                <table class="table table-sm table-borderless mb-0">
                                    <tr>
                                        <td class="text-muted" width="40%">Nama Properti</td>
                                        <td class="fw-bold text-dark">: {{ $item->name }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">Perusahaan Pengembang</td>
                                        <td class="fw-semibold text-dark">: {{ $item->companyProfile->name ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">Status Kepemilikan</td>
                                        <td>
                                            : <span class="badge py-1 px-2.5" style="background-color: #ecfdf5; color: #059669; border: 1px solid #a7f3d0; border-radius: 6px; font-size: 0.76rem; font-weight: 700;">
                                                <i class="mdi mdi-check-decagram me-1"></i>Aset Resmi PT
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">Peruntukan Zonasi</td>
                                        <td class="fw-semibold text-dark">: <span class="badge-category">{{ $item->zoning ?: 'Perumahan Komersil' }}</span></td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">Tanggal Akuisisi</td>
                                        <td class="fw-semibold text-dark">: {{ $item->acquisition_date ? \Carbon\Carbon::parse($item->acquisition_date)->locale('id')->translatedFormat('d F Y') : '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">Nilai Total Akuisisi</td>
                                        <td class="fw-bold text-success font-monospace" style="font-size: 0.95rem;">
                                            : Rp {{ number_format($item->grand_total_acquisition_price, 0, ',', '.') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">Total Luas Lahan</td>
                                        <td class="fw-semibold text-dark">: {{ number_format($item->area ?? 0, 0, ',', '.') }} m²</td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">Sisa Luas Efektif</td>
                                        <td class="fw-semibold text-dark">: {{ number_format($item->remaining_area ?? 0, 0, ',', '.') }} m²</td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">Kondisi Lahan Awal</td>
                                        <td class="fw-semibold text-dark">: {{ $item->land_condition ?: 'Lahan Siap Bangun / Matang' }}</td>
                                    </tr>
                                </table>
                            </div>

                            <!-- Kolom Kanan: Alamat, Wilayah & Legalitas Awal -->
                            <div class="col-lg-6">
                                <h6 class="fw-bold text-dark border-bottom pb-2 mb-3 d-flex align-items-center gap-1.5">
                                    <i class="mdi mdi-map-marker-radius text-success fs-5"></i> Alamat & Wilayah Administratif
                                </h6>
                                <table class="table table-sm table-borderless mb-0">
                                    <tr>
                                        <td class="text-muted" width="38%">Alamat Lengkap</td>
                                        <td class="fw-semibold text-dark">: {{ $item->address ?: '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">Desa / Kelurahan</td>
                                        <td class="fw-semibold text-dark">: {{ $item->village ?: '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">Kecamatan</td>
                                        <td class="fw-semibold text-dark">: {{ $item->district ?: '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">Kota / Kabupaten</td>
                                        <td class="fw-semibold text-dark">: {{ $item->city ?: '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">Provinsi</td>
                                        <td class="fw-semibold text-dark">: {{ $item->province ?: '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">Kode Pos</td>
                                        <td class="fw-semibold text-dark">: {{ $item->postal_code ?: '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">Koordinat GPS</td>
                                        <td class="fw-semibold text-dark">
                                            : @if(!empty($item->lat) && !empty($item->lng))
                                                <a href="https://www.google.com/maps?q={{ $item->lat }},{{ $item->lng }}" target="_blank" class="text-decoration-none text-primary">
                                                    <i class="mdi mdi-google-maps me-0.5"></i>{{ $item->lat }}, {{ $item->lng }}
                                                </a>
                                            @else
                                                -
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">Notaris Rekanan</td>
                                        <td class="fw-semibold text-dark">
                                            : {{ $item->notaris->nama_notaris ?? ($item->notaris_name ?? ($pra->notaris->nama_notaris ?? '-')) }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">Status Validasi Legal</td>
                                        <td>
                                            : <span class="badge py-1 px-2.5" style="background-color: #ecfdf5; color: #059669; border: 1px solid #a7f3d0; border-radius: 6px; font-size: 0.74rem; font-weight: 700;">
                                                <i class="mdi mdi-shield-check me-1"></i>{{ ucfirst($item->legal_status ?: 'Aman & Terverifikasi') }}
                                            </span>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- ==================== TAB 2: LEGALITAS & PENGINDUKAN ==================== -->
                    <div class="tab-pane fade" id="tab-legal" role="tabpanel" aria-labelledby="tab-legal-btn">
                        @php
                            $resolveDocUrl = function($filePath) {
                                if (empty($filePath)) return null;
                                if (str_starts_with($filePath, 'http://') || str_starts_with($filePath, 'https://')) {
                                    return $filePath;
                                }
                                $clean = ltrim($filePath, '/\\');
                                
                                if (file_exists(public_path('storage/' . $clean))) {
                                    return asset('storage/' . $clean);
                                }
                                if (file_exists(public_path('uploads/' . $clean))) {
                                    return asset('uploads/' . $clean);
                                }
                                if (file_exists(public_path($clean))) {
                                    return asset($clean);
                                }
                                if (file_exists(storage_path('app/public/' . $clean))) {
                                    return asset('storage/' . $clean);
                                }
                                if (file_exists(storage_path('app/private/public/' . $clean))) {
                                    @copy(storage_path('app/private/public/' . $clean), public_path('storage/' . $clean));
                                    return asset('storage/' . $clean);
                                }
                                
                                if (str_starts_with($clean, 'uploads/')) {
                                    return asset($clean);
                                }
                                if (str_starts_with($clean, 'perizinan_dokumen/')) {
                                    return asset('storage/' . $clean);
                                }
                                return asset('uploads/' . $clean);
                            };

                            // Ambil task perizinan SHGB Induk
                            $docShgb = $perizinanDocs->first(function($d) {
                                return str_contains(strtolower($d['nama_dokumen'] ?? ''), 'shgb induk selesai') 
                                    || str_contains(strtolower($d['nama_dokumen'] ?? ''), 'shgb induk an. pt');
                            });

                            $noShgbInduk = $item->shgb_induk_no ?: ($docShgb['nomor_dokumen'] ?? null);
                            if ($noShgbInduk === '-') $noShgbInduk = null;

                            $tglShgbInduk = $item->shgb_induk_date 
                                ? \Carbon\Carbon::parse($item->shgb_induk_date)->format('d/m/Y') 
                                : (!empty($docShgb['tanggal']) && $docShgb['tanggal'] !== '-' ? $docShgb['tanggal'] : null);

                            $fileShgbInduk = $item->shgb_induk_file ?: ($docShgb['file_dokumen'] ?? null);

                            // Dokumen & Alas Hak Awal Lahan
                            $certAsalFile = $item->file_certificate ?: ($pra->file_certificate ?? null);
                            $pbbAsalFile  = $item->file_pbb ?: ($pra->pbb_mutasi_file ?? null);
                            $imbAsalFile  = $item->file_imb ?? null;
                            $notarisNama  = $item->notaris->nama_notaris ?? ($item->notaris_name ?? ($pra->notaris->nama_notaris ?? '-'));
                            $notarisSk    = $item->notaris->no_sk ?? ($pra->notaris->no_sk ?? null);
                        @endphp

                        <div class="row g-4">
                            <!-- Kolom Kiri: Card Sertifikat SHGB Induk PT -->
                            <div class="col-lg-6">
                                <div class="card h-100 border shadow-xs rounded-3 p-3 bg-white d-flex flex-column" style="border-color: #e2e8f0 !important;">
                                    <div class="d-flex align-items-center justify-content-between mb-3 pb-2 border-bottom">
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="p-2 rounded-2 bg-success text-white shadow-xs">
                                                <i class="mdi mdi-certificate fs-5"></i>
                                            </div>
                                            <div>
                                                <h6 class="fw-bold text-dark mb-0" style="font-size: 0.95rem;">Sertifikat SHGB Induk an. PT</h6>
                                                <small class="text-muted" style="font-size: 0.75rem;">Legalitas resmi kepemilikan tanah atas nama Badan Hukum PT</small>
                                            </div>
                                        </div>
                                        <span style="display:inline-flex; align-items:center; gap:4px; padding: 4px 12px; border-radius: 20px; font-size: 0.76rem; font-weight: 700; {{ $noShgbInduk ? 'background:#ecfdf5; color:#059669; border:1px solid #a7f3d0;' : 'background:#fffbeb; color:#d97706; border:1px solid #fde68a;' }}">
                                            <i class="mdi {{ $noShgbInduk ? 'mdi-check-decagram' : 'mdi-clock-outline' }}"></i>
                                            {{ $noShgbInduk ? 'Terbit Resmi' : 'Dalam Proses' }}
                                        </span>
                                    </div>

                                    <table class="table-detail-clean mb-3">
                                        <tbody>
                                            <tr>
                                                <td class="col-lbl">Atas Nama Sertifikat</td>
                                                <td class="col-sep">:</td>
                                                <td class="col-val fw-bold">
                                                    <i class="fas fa-building text-primary me-1"></i> {{ $item->companyProfile->name ?? '-' }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="col-lbl">Bentuk Hak Tanah</td>
                                                <td class="col-sep">:</td>
                                                <td class="col-val">
                                                    <span style="display:inline-block; padding: 4px 11px; border-radius: 6px; font-size: 0.76rem; font-weight: 700; background: #ecfdf5; color: #059669; border: 1px solid #a7f3d0;">
                                                        SHGB Induk Kawasan
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="col-lbl">Nomor SHGB Induk</td>
                                                <td class="col-sep">:</td>
                                                <td class="col-val fw-bold font-monospace">
                                                    {{ $noShgbInduk ?: '-' }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="col-lbl">Tanggal Terbit SHGB</td>
                                                <td class="col-sep">:</td>
                                                <td class="col-val fw-semibold">
                                                    {{ $tglShgbInduk ?: '-' }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="col-lbl">Masa Berlaku Hak</td>
                                                <td class="col-sep">:</td>
                                                <td class="col-val fw-semibold">
                                                    30 Tahun (Standar UUPA)
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="col-lbl">Luas SHGB Induk</td>
                                                <td class="col-sep">:</td>
                                                <td class="col-val fw-bold">
                                                    {{ number_format($item->shgb_induk_area ?: $item->area, 0, ',', '.') }} m²
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="col-lbl">Instansi Penerbit</td>
                                                <td class="col-sep">:</td>
                                                <td class="col-val fw-semibold">
                                                    Kantor Pertanahan (ATR/BPN)
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>

                                    @php
                                        $shgbUrl = $resolveDocUrl($fileShgbInduk);
                                    @endphp
                                    @if($fileShgbInduk && $shgbUrl)
                                        <div class="rounded-3 mt-auto mb-1" style="background: #f0fdf4; border: 1.5px solid #86efac; padding: 14px 20px; min-height: 64px;">
                                            <div class="d-flex align-items-center justify-content-between gap-3">
                                                <div class="d-flex align-items-center gap-2.5 overflow-hidden flex-grow-1" style="min-width: 0;">
                                                    <div class="p-2 rounded-2 flex-shrink-0 d-flex align-items-center justify-content-center" style="background: rgba(0, 201, 167, 0.15); color: #00c9a7; width: 38px; height: 38px; border-radius: 6px;">
                                                        <i class="mdi mdi-file-check-outline" style="font-size: 1.35rem;"></i>
                                                    </div>
                                                    <div class="overflow-hidden" style="min-width: 0;">
                                                        <span class="d-block fw-bold text-success text-truncate" style="font-size: 0.88rem; line-height: 1.2;">Berkas SK Resmi Terunggah</span>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-center flex-shrink-0">
                                                    <a href="{{ $shgbUrl }}" target="_blank" class="btn btn-sm text-white fw-bold px-3 py-1.5 shadow-sm d-inline-flex align-items-center justify-content-center" style="background-color: #10b981; border: none; font-size: 0.78rem; border-radius: 6px; gap: 4px;">
                                                        <i class="mdi mdi-eye" style="font-size: 0.95rem; line-height: 1;"></i>
                                                        <span>Lihat</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="rounded-3 mt-auto mb-1" style="background: #f8fafc; border: 1.5px dashed #cbd5e1; padding: 14px 20px; min-height: 64px;">
                                            <div class="d-flex align-items-center justify-content-between gap-3">
                                                <div class="d-flex align-items-center gap-2.5 overflow-hidden flex-grow-1" style="min-width: 0;">
                                                    <div class="p-2 rounded-2 flex-shrink-0 d-flex align-items-center justify-content-center" style="background: #f1f5f9; color: #94a3b8; width: 38px; height: 38px; border-radius: 6px;">
                                                        <i class="mdi mdi-file-document-outline" style="font-size: 1.35rem;"></i>
                                                    </div>
                                                    <div class="overflow-hidden" style="min-width: 0;">
                                                        <span class="d-block fw-semibold text-muted text-truncate" style="font-size: 0.85rem; line-height: 1.2;">Scan SHGB Induk belum diunggah</span>
                                                    </div>
                                                </div>
                                                <span class="badge bg-light text-muted border px-2.5 py-1" style="font-size: 0.72rem; border-radius: 4px;">Belum Ada</span>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Kolom Kanan: Card Legalitas Asal & Alas Hak Tanah -->
                            <div class="col-lg-6">
                                <div class="card h-100 border shadow-xs rounded-3 p-3 bg-white d-flex flex-column" style="border-color: #e2e8f0 !important;">
                                    <div class="d-flex align-items-center justify-content-between mb-3 pb-2 border-bottom">
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="p-2 rounded-2 bg-primary text-white shadow-xs">
                                                <i class="mdi mdi-file-document-check fs-5"></i>
                                            </div>
                                            <div>
                                                <h6 class="fw-bold text-dark mb-0" style="font-size: 0.95rem;">Legalitas Asal & Alas Hak Tanah</h6>
                                                <small class="text-muted" style="font-size: 0.75rem;">Status: <strong>{{ $item->ownership_status }}</strong> (Wajib {{ $item->required_document_count }} Berkas)</small>
                                            </div>
                                        </div>
                                        <span style="display:inline-flex; align-items:center; gap:4px; padding: 4px 12px; border-radius: 20px; font-size: 0.76rem; font-weight: 700; background: #eff6ff; color: #2563eb; border: 1px solid #bfdbfe;">
                                            <i class="mdi mdi-file-check"></i>{{ $item->uploaded_document_count }}/{{ $item->required_document_count }} Berkas
                                        </span>
                                    </div>

                                    <table class="table-detail-clean mb-3">
                                        <tbody>
                                            <tr>
                                                <td class="col-lbl">Status Kepemilikan Asal</td>
                                                <td class="col-sep">:</td>
                                                <td class="col-val">
                                                    <span style="display:inline-block; padding: 4px 10px; border-radius: 6px; font-size: 0.76rem; font-weight: 700; background: #eff6ff; color: #2563eb; border: 1px solid #bfdbfe;">
                                                        {{ ($pra && $pra->ownership_status) ? $pra->ownership_status : $item->ownership_status }} ({{ $item->required_document_count }} Dokumen Wajib)
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="col-lbl">Nomor Sertifikat Asal</td>
                                                <td class="col-sep">:</td>
                                                <td class="col-val fw-semibold font-monospace">
                                                    {{ ($pra && $pra->certificate_no && $pra->certificate_no !== $noShgbInduk) ? $pra->certificate_no : ($item->certificate_no && $item->certificate_no !== $noShgbInduk ? $item->certificate_no : '-') }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="col-lbl">Atas Nama Pemilik Asal</td>
                                                <td class="col-sep">:</td>
                                                <td class="col-val fw-semibold">
                                                    {{ $pra->owner_name ?? ($pra->land_owner ?? ($item->certificate_owner ?: '-')) }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="col-lbl">Status Kondisi Pemilik</td>
                                                <td class="col-sep">:</td>
                                                <td class="col-val">
                                                    @php $ownerSt = $pra->owner_status ?? ($item->owner_status ?? 'hidup'); @endphp
                                                    @if($ownerSt === 'meninggal')
                                                        <span style="display:inline-flex; align-items:center; gap:4px; padding: 3px 8px; border-radius: 6px; font-size: 0.76rem; font-weight: 700; background: #fef2f2; color: #dc2626; border: 1px solid #fecaca;">
                                                            <i class="mdi mdi-alert-circle"></i> Meninggal Dunia (Pewaris)
                                                        </span>
                                                    @else
                                                        <span style="display:inline-flex; align-items:center; gap:4px; padding: 3px 8px; border-radius: 6px; font-size: 0.76rem; font-weight: 600; background: #ecfdf5; color: #059669; border: 1px solid #a7f3d0;">
                                                            <i class="mdi mdi-account-check"></i> Masih Hidup
                                                        </span>
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="col-lbl">Nomor SPPT PBB Awal</td>
                                                <td class="col-sep">:</td>
                                                <td class="col-val fw-semibold font-monospace">
                                                    {{ $item->pbb_no ?: ($pra->pbb_mutasi_nop ?? '-') }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="col-lbl">Status Pembayaran PBB</td>
                                                <td class="col-sep">:</td>
                                                <td class="col-val">
                                                    @if(($pra && $pra->pbb_status == 'lunas') || $item->pbb_no)
                                                        <span style="display:inline-flex; align-items:center; gap:4px; padding: 4px 10px; border-radius: 6px; font-size: 0.76rem; font-weight: 700; background: #ecfdf5; color: #059669; border: 1px solid #a7f3d0;">
                                                            <i class="mdi mdi-check-circle"></i>Lunas / Terverifikasi
                                                        </span>
                                                    @else
                                                        <span class="text-muted">-</span>
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="col-lbl">Notaris PPAT Pengurusan</td>
                                                <td class="col-sep">:</td>
                                                <td class="col-val fw-semibold">
                                                    {{ $notarisNama }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="col-lbl">Status Verifikasi Legal</td>
                                                <td class="col-sep">:</td>
                                                <td class="col-val">
                                                    @php
                                                        $ls = strtolower($item->legal_status ?? '');
                                                        if ($ls === 'pending' || $ls === 'proses') {
                                                            $lsBg = '#fffbeb'; $lsColor = '#d97706'; $lsBorder = '#fde68a'; $lsIcon = 'mdi-clock-outline';
                                                        } elseif ($ls === 'ditolak' || $ls === 'bermasalah') {
                                                            $lsBg = '#fef2f2'; $lsColor = '#dc2626'; $lsBorder = '#fecaca'; $lsIcon = 'mdi-shield-off';
                                                        } else {
                                                            $lsBg = '#ecfdf5'; $lsColor = '#059669'; $lsBorder = '#a7f3d0'; $lsIcon = 'mdi-shield-check';
                                                        }
                                                    @endphp
                                                    <span style="display:inline-flex; align-items:center; gap:4px; padding: 4px 10px; border-radius: 6px; font-size: 0.76rem; font-weight: 700; background: {{ $lsBg }}; color: {{ $lsColor }}; border: 1px solid {{ $lsBorder }};">
                                                        <i class="mdi {{ $lsIcon }}"></i>{{ ucfirst($item->legal_status ?: 'Aman & Terverifikasi') }}
                                                    </span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>

                                    @php
                                        $asalDocFile = $certAsalFile ?: ($pbbAsalFile ?: $imbAsalFile);
                                        $asalUrl = $resolveDocUrl($asalDocFile);
                                    @endphp
                                    @if($asalDocFile && $asalUrl)
                                        <div class="rounded-3 mt-auto mb-1" style="background: #f0fdf4; border: 1.5px solid #86efac; padding: 14px 20px; min-height: 64px;">
                                            <div class="d-flex align-items-center justify-content-between gap-3">
                                                <div class="d-flex align-items-center gap-2.5 overflow-hidden flex-grow-1" style="min-width: 0;">
                                                    <div class="p-2 rounded-2 flex-shrink-0 d-flex align-items-center justify-content-center" style="background: rgba(0, 201, 167, 0.15); color: #00c9a7; width: 38px; height: 38px; border-radius: 6px;">
                                                        <i class="mdi mdi-file-check-outline" style="font-size: 1.35rem;"></i>
                                                    </div>
                                                    <div class="overflow-hidden" style="min-width: 0;">
                                                        <span class="d-block fw-bold text-success text-truncate" style="font-size: 0.88rem; line-height: 1.2;">Berkas SK Resmi Terunggah</span>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-center flex-shrink-0">
                                                    <a href="{{ $asalUrl }}" target="_blank" class="btn btn-sm text-white fw-bold px-3 py-1.5 shadow-sm d-inline-flex align-items-center justify-content-center" style="background-color: #10b981; border: none; font-size: 0.78rem; border-radius: 6px; gap: 4px;">
                                                        <i class="mdi mdi-eye" style="font-size: 0.95rem; line-height: 1;"></i>
                                                        <span>Lihat</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="rounded-3 mt-auto mb-1" style="background: #f8fafc; border: 1.5px dashed #cbd5e1; padding: 14px 20px; min-height: 64px;">
                                            <div class="d-flex align-items-center justify-content-between gap-3">
                                                <div class="d-flex align-items-center gap-2.5 overflow-hidden flex-grow-1" style="min-width: 0;">
                                                    <div class="p-2 rounded-2 flex-shrink-0 d-flex align-items-center justify-content-center" style="background: #f1f5f9; color: #94a3b8; width: 38px; height: 38px; border-radius: 6px;">
                                                        <i class="mdi mdi-file-document-outline" style="font-size: 1.35rem;"></i>
                                                    </div>
                                                    <div class="overflow-hidden" style="min-width: 0;">
                                                        <span class="d-block fw-semibold text-muted text-truncate" style="font-size: 0.85rem; line-height: 1.2;">Dokumen asal belum diunggah</span>
                                                    </div>
                                                </div>
                                                <span class="badge bg-light text-muted border px-2.5 py-1" style="font-size: 0.72rem; border-radius: 4px;">Belum Ada</span>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ==================== TAB 3: BERKAS DOKUMEN PT (PERSIS PERIZINAN.SHOW) ==================== -->
                    <div class="tab-pane fade" id="tab-docs" role="tabpanel" aria-labelledby="tab-docs-btn">
                        
                        <!-- Card Meniru Persis perizinan.show -->
                        <div class="card compact-table-card">
                            <!-- Card Header Persis perizinan.show -->
                            <div class="card-header bg-white d-flex flex-wrap flex-md-row justify-content-between align-items-center gap-2">
                                <div class="d-flex align-items-center gap-2">
                                    <div style="width: 32px; height: 32px; border-radius: 6px; background-color: #f3e8ff; color: #9333ea; display: inline-flex; align-items: center; justify-content: center; font-size: 1.15rem; flex-shrink: 0;">
                                        <i class="mdi mdi-format-list-bulleted"></i>
                                    </div>
                                    <span style="font-size: 0.95rem; font-weight: 700; color: #0f172a;">Rincian Dokumen Perizinan Kawasan (Atas Nama PT)</span>
                                </div>
                            </div>

                            <div class="card-body">
                                <!-- TABEL DATA DOKUMEN PERIZINAN PT -->
                                <div class="table-responsive">
                                    <table class="table table-hover align-middle table-perizinan">
                                        <thead>
                                            <tr>
                                                <th class="col-no">No</th>
                                                <th class="col-kode">Kode</th>
                                                <th class="col-nama">Nama Perizinan & Instansi</th>
                                                <th class="col-no-sk">Nomor Izin / SK</th>
                                                <th class="col-tgl">Target / Tgl</th>
                                                <th class="col-status">Status</th>
                                                <th class="col-progres">Progres</th>
                                                <th class="col-aksi">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($perizinanDocs as $index => $doc)
                                                @php
                                                    $pVal = (int) ($doc['progress'] ?? 0);
                                                    if ($pVal >= 100) {
                                                        $pColor = '#10b981'; // Green
                                                    } elseif ($pVal >= 70) {
                                                        $pColor = '#7c3aed'; // Purple
                                                    } elseif ($pVal >= 40) {
                                                        $pColor = '#0284c7'; // Blue
                                                    } else {
                                                        $pColor = '#e11d48'; // Rose
                                                    }

                                                    $st = $doc['status'] ?? 'Belum';
                                                    $searchData = strtolower(($doc['kode_dokumen'] ?? '') . ' ' . ($doc['nama_izin'] ?? '') . ' ' . ($doc['instansi'] ?? '') . ' ' . ($doc['no_izin'] ?? ''));
                                                @endphp
                                                <tr class="permit-table-row" id="row_permit_{{ $doc['id'] ?? $loop->iteration }}" 
                                                    data-search="{{ $searchData }}" 
                                                    data-status="{{ $st }}">
                                                    <td class="col-no fw-bold text-center">{{ $loop->iteration }}</td>
                                                    <td class="col-kode text-center">
                                                        <span class="badge bg-light text-dark fw-bold px-2 py-1 border font-monospace" style="font-size: 0.78rem; letter-spacing: 0.4px;">
                                                            {{ $doc['kode_dokumen'] ?? ($doc['poin_label'] ?? '-') }}
                                                        </span>
                                                    </td>
                                                    <td class="col-nama">
                                                        <div class="fw-bold text-dark" style="line-height: 1.35; font-size: 0.85rem;">
                                                            {{ $doc['nama_izin'] ?? ($doc['nama_dokumen'] ?? '-') }}
                                                        </div>
                                                        <div class="text-secondary mt-0.5" style="font-size: 0.78rem; line-height: 1.3;">
                                                            {{ $doc['instansi'] ?: '-' }}
                                                        </div>
                                                    </td>
                                                    <td class="col-no-sk">
                                                        @if(!empty($doc['no_izin']) && $doc['no_izin'] !== '-')
                                                            <span class="badge bg-light text-dark px-2 py-1 border font-monospace text-wrap" style="font-size: 0.75rem; word-break: break-all; line-height: 1.25;">
                                                                {{ $doc['no_izin'] }}
                                                            </span>
                                                        @else
                                                            <span class="text-muted" style="font-size: 0.78rem;">-</span>
                                                        @endif
                                                    </td>
                                                    <td class="col-tgl">
                                                        <span class="text-muted" style="font-size: 0.8rem;">
                                                            {{ $doc['tanggal'] ?: '-' }}
                                                        </span>
                                                    </td>
                                                    <td class="col-status text-center">
                                                        @if($st == 'Terbit' || $st == 'Selesai')
                                                            <span class="status-badge aktif" style="padding: 3px 8px; font-size: 0.75rem;">Terbit</span>
                                                        @elseif($st == 'Proses' || $st == 'Berjalan')
                                                            <span class="badge-development-progress" style="padding: 3px 8px; font-size: 0.75rem;">Proses</span>
                                                        @elseif($st == 'Tertunda' || $st == 'Revisi')
                                                            <span class="badge-development-belum" style="background-color: #fee2e2; color: #b91c1c; border-color: #fecdd3; padding: 3px 8px; font-size: 0.75rem;">Revisi</span>
                                                        @else
                                                            <span class="badge-development-belum" style="background-color: #f1f5f9; color: #64748b; border-color: #e2e8f0; padding: 3px 8px; font-size: 0.75rem;">Belum</span>
                                                        @endif
                                                    </td>
                                                    <td class="col-progres">
                                                        <div class="d-flex align-items-center gap-2" style="width: 100%;">
                                                            <div style="flex-grow: 1; background-color: #f1f5f9; border-radius: 9999px; height: 6px; overflow: hidden;">
                                                                <div style="width: {{ $pVal }}%; background-color: {{ $pColor }}; height: 100%; border-radius: 9999px;"></div>
                                                            </div>
                                                            <span style="font-size: 0.75rem; font-weight: 700; color: #334155;">{{ $pVal }}%</span>
                                                        </div>
                                                    </td>
                                                    <td class="col-aksi text-center">
                                                        <!-- Tombol Aksi Persis Tabel Pasca Land Bank (.btn-action.view) -->
                                                        <div class="action-group">
                                                            @if(!empty($doc['file_dokumen']))
                                                                @php
                                                                    $fUrl = $resolveDocUrl($doc['file_dokumen']);
                                                                @endphp
                                                                <a href="{{ $fUrl }}" target="_blank" 
                                                                   class="btn-action view" 
                                                                   title="Lihat Berkas Dokumen">
                                                                    <i class="mdi mdi-eye"></i>
                                                                </a>
                                                            @else
                                                                <button type="button" 
                                                                   class="btn-action view" 
                                                                   disabled 
                                                                   title="Berkas Belum Diunggah" 
                                                                   style="opacity: 0.4; cursor: not-allowed; box-shadow: none; filter: grayscale(1);">
                                                                    <i class="mdi mdi-eye-off"></i>
                                                                </button>
                                                            @endif
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="8" class="text-center text-muted py-4">
                                                        <i class="mdi mdi-file-question-outline me-2" style="font-size: 1.5rem;"></i>
                                                        Tidak ada dokumen perizinan kawasan yang tercatat.
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- ==================== TAB 4: LAHAN & AKSES KAWASAN ==================== -->
                    <div class="tab-pane fade" id="tab-infra" role="tabpanel" aria-labelledby="tab-infra-btn">
                        <div class="row g-4">
                            <!-- Kolom Kiri: Akses Jalan & Topografi -->
                            <div class="col-lg-6">
                                <h6 class="fw-bold text-dark border-bottom pb-2 mb-3 d-flex align-items-center gap-1.5">
                                    <i class="mdi mdi-road text-warning fs-5"></i> Aksesibilitas & Jalan Masuk
                                </h6>
                                <table class="table table-sm table-borderless mb-0">
                                    <tr>
                                        <td class="text-muted" width="40%">Lebar Jalan Masuk (Row)</td>
                                        <td class="fw-bold text-dark">: {{ $item->road_width ? $item->road_width . ' Meter' : '8 Meter' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">Tipe Perkerasan Jalan</td>
                                        <td class="fw-semibold text-dark">: {{ $item->road_type ?: 'Paving Block / Aspal' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">Kondisi Topografi Tanah</td>
                                        <td class="fw-semibold text-dark">: {{ $item->topography ?: 'Datar (Siap Bangun)' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">Akses Angkutan Umum</td>
                                        <td class="fw-semibold text-dark">: {{ $item->public_transport ?: 'Dekat Jalan Provinsi / Kabupaten' }}</td>
                                    </tr>
                                </table>
                            </div>

                            <!-- Kolom Kanan: Utilitas & Jaringan Publik -->
                            <div class="col-lg-6">
                                <h6 class="fw-bold text-dark border-bottom pb-2 mb-3 d-flex align-items-center gap-1.5">
                                    <i class="mdi mdi-lightning-bolt text-info fs-5"></i> Utilitas Dasar Kawasan
                                </h6>
                                <table class="table table-sm table-borderless mb-0">
                                    <tr>
                                        <td class="text-muted" width="40%">Jaringan Listrik (PLN)</td>
                                        <td class="fw-semibold text-success">: <i class="mdi mdi-check-circle me-1"></i>Tersedia (Tiang & Gardu PLN Terpasang)</td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">Sumber Air Bersih</td>
                                        <td class="fw-semibold text-success">: <i class="mdi mdi-check-circle me-1"></i>Tersedia (PDAM / Sumur Bor Artesis)</td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">Saluran Pembuangan / Drainase</td>
                                        <td class="fw-semibold text-success">: <i class="mdi mdi-check-circle me-1"></i>Saluran Induk Mengalir ke Sungai</td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">Jaringan Internet / Fiber</td>
                                        <td class="fw-semibold text-dark">: Tercover Provider Telkom / Indihome</td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <!-- Section Fasilitas Sekitar Lahan -->
                        <div class="row mt-4 pt-3 border-top">
                            <div class="col-12">
                                <div class="d-flex align-items-center justify-content-between border-bottom pb-2 mb-3">
                                    <h6 class="fw-bold text-dark mb-0 d-flex align-items-center gap-2" style="font-size: 0.95rem;">
                                        <div class="p-1.5 rounded-2 d-inline-flex align-items-center justify-content-center" style="background: #fef3c7; color: #d97706; width: 30px; height: 30px;">
                                            <i class="mdi mdi-storefront-outline fs-5"></i>
                                        </div>
                                        <span>Fasilitas Umum Sekitar Lahan</span>
                                    </h6>
                                    <span class="text-muted small" style="font-size: 0.78rem;">Akses fasilitas publik terdekat</span>
                                </div>

                                <div class="row g-3">
                                    <!-- 1. Dekat Sekolah -->
                                    <div class="col-6 col-md-4 col-lg-2">
                                        <div class="h-100 p-3 rounded-3 text-center d-flex flex-column align-items-center justify-content-center gap-2" 
                                             style="background: #ffffff; border: 1.5px solid {{ $item->facility_school ? '#86efac' : '#e2e8f0' }}; box-shadow: 0 1px 3px rgba(0,0,0,0.04); transition: all 0.2s ease;">
                                            <div class="d-flex align-items-center justify-content-center" 
                                                 style="width: 44px; height: 44px; border-radius: 8px; background: {{ $item->facility_school ? '#ede9fe' : '#f1f5f9' }}; color: {{ $item->facility_school ? '#7c3aed' : '#94a3b8' }};">
                                                <i class="mdi mdi-school" style="font-size: 1.45rem;"></i>
                                            </div>
                                            <span style="font-size: 0.84rem; font-weight: 700; color: #0f172a; line-height: 1.2;">Dekat Sekolah</span>
                                            @if($item->facility_school)
                                                <span style="display: inline-flex; align-items: center; gap: 4px; padding: 3px 10px; border-radius: 20px; font-size: 0.74rem; font-weight: 700; background: #ecfdf5; color: #059669; border: 1px solid #a7f3d0;">
                                                    <i class="mdi mdi-check-circle" style="font-size: 0.82rem;"></i> Tersedia
                                                </span>
                                            @else
                                                <span style="display: inline-flex; align-items: center; gap: 4px; padding: 3px 10px; border-radius: 20px; font-size: 0.74rem; font-weight: 600; background: #f8fafc; color: #94a3b8; border: 1px solid #e2e8f0;">
                                                    <i class="mdi mdi-minus-circle-outline" style="font-size: 0.82rem;"></i> Belum Ada
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- 2. Rumah Sakit -->
                                    <div class="col-6 col-md-4 col-lg-2">
                                        <div class="h-100 p-3 rounded-3 text-center d-flex flex-column align-items-center justify-content-center gap-2" 
                                             style="background: #ffffff; border: 1.5px solid {{ $item->facility_hospital ? '#86efac' : '#e2e8f0' }}; box-shadow: 0 1px 3px rgba(0,0,0,0.04); transition: all 0.2s ease;">
                                            <div class="d-flex align-items-center justify-content-center" 
                                                 style="width: 44px; height: 44px; border-radius: 8px; background: {{ $item->facility_hospital ? '#ffe4e6' : '#f1f5f9' }}; color: {{ $item->facility_hospital ? '#e11d48' : '#94a3b8' }};">
                                                <i class="mdi mdi-hospital-building" style="font-size: 1.45rem;"></i>
                                            </div>
                                            <span style="font-size: 0.84rem; font-weight: 700; color: #0f172a; line-height: 1.2;">Rumah Sakit</span>
                                            @if($item->facility_hospital)
                                                <span style="display: inline-flex; align-items: center; gap: 4px; padding: 3px 10px; border-radius: 20px; font-size: 0.74rem; font-weight: 700; background: #ecfdf5; color: #059669; border: 1px solid #a7f3d0;">
                                                    <i class="mdi mdi-check-circle" style="font-size: 0.82rem;"></i> Tersedia
                                                </span>
                                            @else
                                                <span style="display: inline-flex; align-items: center; gap: 4px; padding: 3px 10px; border-radius: 20px; font-size: 0.74rem; font-weight: 600; background: #f8fafc; color: #94a3b8; border: 1px solid #e2e8f0;">
                                                    <i class="mdi mdi-minus-circle-outline" style="font-size: 0.82rem;"></i> Belum Ada
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- 3. Pasar -->
                                    <div class="col-6 col-md-4 col-lg-2">
                                        <div class="h-100 p-3 rounded-3 text-center d-flex flex-column align-items-center justify-content-center gap-2" 
                                             style="background: #ffffff; border: 1.5px solid {{ $item->facility_market ? '#86efac' : '#e2e8f0' }}; box-shadow: 0 1px 3px rgba(0,0,0,0.04); transition: all 0.2s ease;">
                                            <div class="d-flex align-items-center justify-content-center" 
                                                 style="width: 44px; height: 44px; border-radius: 8px; background: {{ $item->facility_market ? '#fef3c7' : '#f1f5f9' }}; color: {{ $item->facility_market ? '#d97706' : '#94a3b8' }};">
                                                <i class="mdi mdi-store-outline" style="font-size: 1.45rem;"></i>
                                            </div>
                                            <span style="font-size: 0.84rem; font-weight: 700; color: #0f172a; line-height: 1.2;">Pasar</span>
                                            @if($item->facility_market)
                                                <span style="display: inline-flex; align-items: center; gap: 4px; padding: 3px 10px; border-radius: 20px; font-size: 0.74rem; font-weight: 700; background: #ecfdf5; color: #059669; border: 1px solid #a7f3d0;">
                                                    <i class="mdi mdi-check-circle" style="font-size: 0.82rem;"></i> Tersedia
                                                </span>
                                            @else
                                                <span style="display: inline-flex; align-items: center; gap: 4px; padding: 3px 10px; border-radius: 20px; font-size: 0.74rem; font-weight: 600; background: #f8fafc; color: #94a3b8; border: 1px solid #e2e8f0;">
                                                    <i class="mdi mdi-minus-circle-outline" style="font-size: 0.82rem;"></i> Belum Ada
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- 4. Transportasi -->
                                    <div class="col-6 col-md-4 col-lg-2">
                                        <div class="h-100 p-3 rounded-3 text-center d-flex flex-column align-items-center justify-content-center gap-2" 
                                             style="background: #ffffff; border: 1.5px solid {{ $item->facility_transport ? '#86efac' : '#e2e8f0' }}; box-shadow: 0 1px 3px rgba(0,0,0,0.04); transition: all 0.2s ease;">
                                            <div class="d-flex align-items-center justify-content-center" 
                                                 style="width: 44px; height: 44px; border-radius: 8px; background: {{ $item->facility_transport ? '#e0f2fe' : '#f1f5f9' }}; color: {{ $item->facility_transport ? '#0284c7' : '#94a3b8' }};">
                                                <i class="mdi mdi-bus" style="font-size: 1.45rem;"></i>
                                            </div>
                                            <span style="font-size: 0.84rem; font-weight: 700; color: #0f172a; line-height: 1.2;">Transportasi</span>
                                            @if($item->facility_transport)
                                                <span style="display: inline-flex; align-items: center; gap: 4px; padding: 3px 10px; border-radius: 20px; font-size: 0.74rem; font-weight: 700; background: #ecfdf5; color: #059669; border: 1px solid #a7f3d0;">
                                                    <i class="mdi mdi-check-circle" style="font-size: 0.82rem;"></i> Tersedia
                                                </span>
                                            @else
                                                <span style="display: inline-flex; align-items: center; gap: 4px; padding: 3px 10px; border-radius: 20px; font-size: 0.74rem; font-weight: 600; background: #f8fafc; color: #94a3b8; border: 1px solid #e2e8f0;">
                                                    <i class="mdi mdi-minus-circle-outline" style="font-size: 0.82rem;"></i> Belum Ada
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- 5. Mall / Swalayan -->
                                    <div class="col-6 col-md-4 col-lg-2">
                                        <div class="h-100 p-3 rounded-3 text-center d-flex flex-column align-items-center justify-content-center gap-2" 
                                             style="background: #ffffff; border: 1.5px solid {{ $item->facility_mall ? '#86efac' : '#e2e8f0' }}; box-shadow: 0 1px 3px rgba(0,0,0,0.04); transition: all 0.2s ease;">
                                            <div class="d-flex align-items-center justify-content-center" 
                                                 style="width: 44px; height: 44px; border-radius: 8px; background: {{ $item->facility_mall ? '#dcfce7' : '#f1f5f9' }}; color: {{ $item->facility_mall ? '#16a34a' : '#94a3b8' }};">
                                                <i class="mdi mdi-cart-outline" style="font-size: 1.45rem;"></i>
                                            </div>
                                            <span style="font-size: 0.84rem; font-weight: 700; color: #0f172a; line-height: 1.2;">Mall / Swalayan</span>
                                            @if($item->facility_mall)
                                                <span style="display: inline-flex; align-items: center; gap: 4px; padding: 3px 10px; border-radius: 20px; font-size: 0.74rem; font-weight: 700; background: #ecfdf5; color: #059669; border: 1px solid #a7f3d0;">
                                                    <i class="mdi mdi-check-circle" style="font-size: 0.82rem;"></i> Tersedia
                                                </span>
                                            @else
                                                <span style="display: inline-flex; align-items: center; gap: 4px; padding: 3px 10px; border-radius: 20px; font-size: 0.74rem; font-weight: 600; background: #f8fafc; color: #94a3b8; border: 1px solid #e2e8f0;">
                                                    <i class="mdi mdi-minus-circle-outline" style="font-size: 0.82rem;"></i> Belum Ada
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- 6. Bank / ATM -->
                                    <div class="col-6 col-md-4 col-lg-2">
                                        <div class="h-100 p-3 rounded-3 text-center d-flex flex-column align-items-center justify-content-center gap-2" 
                                             style="background: #ffffff; border: 1.5px solid {{ $item->facility_bank ? '#86efac' : '#e2e8f0' }}; box-shadow: 0 1px 3px rgba(0,0,0,0.04); transition: all 0.2s ease;">
                                            <div class="d-flex align-items-center justify-content-center" 
                                                 style="width: 44px; height: 44px; border-radius: 8px; background: {{ $item->facility_bank ? '#ccfbf1' : '#f1f5f9' }}; color: {{ $item->facility_bank ? '#0f766e' : '#94a3b8' }};">
                                                <i class="mdi mdi-bank-outline" style="font-size: 1.45rem;"></i>
                                            </div>
                                            <span style="font-size: 0.84rem; font-weight: 700; color: #0f172a; line-height: 1.2;">Bank / ATM</span>
                                            @if($item->facility_bank)
                                                <span style="display: inline-flex; align-items: center; gap: 4px; padding: 3px 10px; border-radius: 20px; font-size: 0.74rem; font-weight: 700; background: #ecfdf5; color: #059669; border: 1px solid #a7f3d0;">
                                                    <i class="mdi mdi-check-circle" style="font-size: 0.82rem;"></i> Tersedia
                                                </span>
                                            @else
                                                <span style="display: inline-flex; align-items: center; gap: 4px; padding: 3px 10px; border-radius: 20px; font-size: 0.74rem; font-weight: 600; background: #f8fafc; color: #94a3b8; border: 1px solid #e2e8f0;">
                                                    <i class="mdi mdi-minus-circle-outline" style="font-size: 0.82rem;"></i> Belum Ada
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>
@endsection

