@extends('layouts.partial.app')

@section('title', 'Pengelolaan Unit Halaman Utama - Property Management')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard-clean.css') }}?v={{ time() }}">
    <style>
        /* Styling Tabel Persis Katalog Unit (jual_unit) */
        .table-perizinan {
            width: 100% !important;
            margin-bottom: 0;
            border-collapse: collapse;
        }
        .table-perizinan thead th {
            background: linear-gradient(135deg, #f8f9fa, #f1f3f5) !important;
            color: #9a55ff !important;
            font-weight: 600;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 2px solid #e9ecef !important;
            padding: 0.8rem 0.6rem !important;
            vertical-align: middle;
            white-space: nowrap;
        }
        .table-perizinan tbody td {
            padding: 0.85rem 0.65rem !important;
            vertical-align: middle;
            font-size: 0.85rem;
            border-bottom: 1px solid #f1f5f9;
            color: #2c2e3f;
        }
        .table-perizinan tbody tr:hover {
            background-color: #f8f9fa;
        }
        .table-perizinan .col-no {
            width: 45px;
            text-align: center;
            white-space: nowrap !important;
        }
        .table-perizinan .col-status {
            width: 110px;
            text-align: center;
            white-space: nowrap !important;
        }
        .table-perizinan .col-aksi {
            width: 120px;
            text-align: center;
            white-space: nowrap !important;
        }

        /* Solid Buttons - 1 Warna, Tanpa Gradient (Persis Katalog Unit) */
        .btn-gradient-primary {
            background: #9a55ff !important;
            border-color: #9a55ff !important;
            color: #ffffff !important;
            box-shadow: none !important;
        }
        .btn-gradient-primary:hover {
            background: #8b3df5 !important;
            border-color: #8b3df5 !important;
            color: #ffffff !important;
        }
        .btn-gradient-secondary {
            background: #64748b !important;
            border-color: #64748b !important;
            color: #ffffff !important;
            box-shadow: none !important;
        }
        .btn-gradient-secondary:hover {
            background: #475569 !important;
            border-color: #475569 !important;
            color: #ffffff !important;
        }
        .btn-icon-only {
            width: 38px;
            height: 38px;
            padding: 0 !important;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 4px;
        }

        /* Badge Styling - Solid 1 Warna, Tanpa Gradient (Persis Katalog Unit) */
        .badge {
            padding: 0.35rem 0.65rem;
            font-size: 0.75rem;
            font-weight: 600;
            border-radius: 6px;
            display: inline-block;
            white-space: nowrap;
        }
        .badge-gradient-success {
            background: #10b981 !important;
            color: #ffffff !important;
            border-radius: 6px;
            border: none !important;
        }
        .badge-gradient-primary {
            background: #9a55ff !important;
            color: #ffffff !important;
            border-radius: 6px;
            border: none !important;
        }
        .badge-gradient-warning {
            background: #f59e0b !important;
            color: #ffffff !important;
            border-radius: 6px;
            border: none !important;
        }
        .badge-gradient-secondary {
            background: #64748b !important;
            color: #ffffff !important;
            border-radius: 6px;
            border: none !important;
        }

        .price-text {
            color: #28a745 !important;
            font-weight: 700;
        }
        .icon-text {
            display: inline-flex;
            align-items: center;
            gap: 0.45rem;
        }
        .icon-text i {
            font-size: 1rem;
            color: #9a55ff;
        }
        .text-primary {
            color: #9a55ff !important;
        }

        /* Styling Card Tabel Meniru Persis Card Total (.dash-kpi-card) */
        .card.compact-table-card,
        .compact-table-card {
            background: #ffffff !important;
            border: 1px solid #e2e8f0 !important;
            border-radius: 8px !important;
            box-shadow: none !important;
            transition: border-color 0.2s ease;
            overflow: hidden;
        }
        .card.compact-table-card:hover,
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
        .compact-table-card .card-body,
        .card.compact-table-card .card-body {
            padding: 0.75rem 1.25rem 1.15rem 1.25rem !important;
            background: #ffffff !important;
        }
        .compact-table-card .filter-card {
            margin-top: 0 !important;
            margin-bottom: 0.6rem !important;
        }
        .compact-table-card .filter-card form {
            margin-bottom: 0 !important;
        }

        .img-preview-thumb {
            width: 72px;
            height: 52px;
            border-radius: 8px;
            object-fit: cover;
            border: 1px solid #e2e8f0;
        }
        .no-photo-box {
            width: 72px;
            height: 52px;
            border-radius: 8px;
            background: #f1f5f9;
            border: 1px dashed #cbd5e1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: #94a3b8;
            font-size: 0.65rem;
            font-weight: 600;
        }
    </style>
@endpush

@section('content')

<div class="container-fluid px-2 px-md-4 py-3">

    <!-- Alert Notifikasi Flash -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show d-flex align-items-center gap-2 mb-3" role="alert" style="border-radius: 8px;">
            <i class="mdi mdi-check-circle fs-5"></i>
            <div>{{ session('success') }}</div>
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Page Title & Subtitle -->
    <div class="row align-items-center mb-4">
        <div class="col">
            <h2 class="text-dark mb-1 fw-bold" style="font-size: 1.55rem; letter-spacing: -0.02em;">
                Pengelolaan Unit Halaman Utama
            </h2>
            <p class="text-muted mb-0" style="font-size: 0.88rem;">
                Kelola unit-unit yang berstatus <strong>Ready to Sell</strong> untuk ditampilkan ke publik pada katalog halaman utama.
            </p>
        </div>
    </div>

    <!-- 4 KPI Metrics Card Grid -->
    <div class="dash-kpi-grid mb-4">
        <!-- Card 1: Total Unit Ready -->
        <div class="dash-kpi-card">
            <div class="dash-kpi-left">
                <div class="dash-kpi-icon purple">
                    <i class="mdi mdi-home-heart"></i>
                </div>
                <div class="dash-kpi-info">
                    <div class="dash-kpi-label">Unit Siap Pasang</div>
                    <div class="dash-kpi-val">{{ $totalReady }}</div>
                    <div class="dash-kpi-sub">Status Unit: Ready to Sell</div>
                </div>
            </div>
            <div class="dash-kpi-action purple">
                <i class="mdi mdi-arrow-right"></i>
            </div>
        </div>

        <!-- Card 2: Foto Sudah Ada -->
        <div class="dash-kpi-card">
            <div class="dash-kpi-left">
                <div class="dash-kpi-icon green">
                    <i class="mdi mdi-image-check"></i>
                </div>
                <div class="dash-kpi-info">
                    <div class="dash-kpi-label">Sudah Ada Foto</div>
                    <div class="dash-kpi-val">{{ $totalWithPhoto }}</div>
                    <div class="dash-kpi-sub">Tampil Optimal di Web</div>
                </div>
            </div>
            <div class="dash-kpi-action green">
                <i class="mdi mdi-arrow-right"></i>
            </div>
        </div>

        <!-- Card 3: Belum Ada Foto -->
        <div class="dash-kpi-card">
            <div class="dash-kpi-left">
                <div class="dash-kpi-icon rose">
                    <i class="mdi mdi-image-off"></i>
                </div>
                <div class="dash-kpi-info">
                    <div class="dash-kpi-label">Belum Ada Foto</div>
                    <div class="dash-kpi-val">{{ $totalNoPhoto }}</div>
                    <div class="dash-kpi-sub">Perlu Upload Foto Fasad</div>
                </div>
            </div>
            <div class="dash-kpi-action rose">
                <i class="mdi mdi-arrow-right"></i>
            </div>
        </div>

        <!-- Card 4: Unit Unggulan -->
        <div class="dash-kpi-card">
            <div class="dash-kpi-left">
                <div class="dash-kpi-icon amber">
                    <i class="mdi mdi-star"></i>
                </div>
                <div class="dash-kpi-info">
                    <div class="dash-kpi-label">Unit Unggulan</div>
                    <div class="dash-kpi-val">{{ $totalFeatured }}</div>
                    <div class="dash-kpi-sub">Prioritas Teratas di Web</div>
                </div>
            </div>
            <div class="dash-kpi-action amber">
                <i class="mdi mdi-arrow-right"></i>
            </div>
        </div>
    </div>

    <!-- Main Container: Table & Filters (Persis UI Perizinan) -->
    <div class="row">
        <div class="col-12">
            <div class="card compact-table-card">
                <div class="card-body">
                    
                    <!-- Header Teks Daftar Unit & Pembatas HR -->
                    <div class="d-flex align-items-center mb-2 pt-1">
                        <div class="d-flex align-items-center gap-2">
                            <div style="width: 32px; height: 32px; border-radius: 6px; background-color: #f3e8ff; color: #9333ea; display: inline-flex; align-items: center; justify-content: center; font-size: 1.15rem; flex-shrink: 0;">
                                <i class="mdi mdi-home-group"></i>
                            </div>
                            <div>
                                <h4 class="mb-0 fw-bold text-dark" style="font-size: 1.05rem; letter-spacing: -0.01em;">Daftar Unit</h4>
                            </div>
                        </div>
                    </div>

                    <hr class="mt-2.5 mb-3" style="border: 0; border-top: 1px solid #e2e8f0; opacity: 1;">

                    <!-- FILTER CARD PERSIS PERIZINAN -->
                    <div class="filter-card">
                        <form method="GET" action="{{ route('marketing.landingpage.index') }}" id="filterForm">
                            <div class="d-flex flex-wrap align-items-center gap-2">
                                <div class="d-flex flex-wrap align-items-center gap-2 flex-grow-1">
                                    
                                    <!-- Search Input -->
                                    <div style="min-width: 240px; max-width: 360px; flex: 1;">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="search" id="liveSearchInput"
                                                placeholder="Cari kode unit, tipe, nama, proyek..."
                                                value="{{ request('search') }}"
                                                onkeyup="applyLiveSearch(this.value)"
                                                style="border-top-right-radius: 0 !important; border-bottom-right-radius: 0 !important; border-right: none;">
                                            <button class="btn btn-gradient-primary d-flex align-items-center justify-content-center px-3" 
                                                type="submit" title="Cari"
                                                style="border-top-left-radius: 0 !important; border-bottom-left-radius: 0 !important; border-top-right-radius: 4px !important; border-bottom-right-radius: 4px !important; height: 38px; box-shadow: none;">
                                                <i class="mdi mdi-magnify" style="font-size: 1.15rem; color: #ffffff;"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <!-- Filter Kategori -->
                                    <div style="width: 160px;">
                                        <select class="form-control" name="kategori" id="kategoriFilterSelect" onchange="document.getElementById('filterForm').submit()">
                                            <option value="all">Semua Kategori</option>
                                            <option value="subsidi" {{ request('kategori') == 'subsidi' ? 'selected' : '' }}>Subsidi</option>
                                            <option value="komersil" {{ request('kategori') == 'komersil' ? 'selected' : '' }}>Komersil</option>
                                        </select>
                                    </div>

                                    <!-- Filter Status Web -->
                                    <div style="width: 160px;">
                                        <select class="form-control" name="status" id="statusFilterSelect" onchange="document.getElementById('filterForm').submit()">
                                            <option value="all">Semua Status</option>
                                            <option value="tayang" {{ request('status') == 'tayang' ? 'selected' : '' }}>Tayang</option>
                                            <option value="kosong" {{ request('status') == 'kosong' ? 'selected' : '' }}>Foto Kosong</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Reset & Filter Action Button -->
                                <div class="d-flex align-items-center gap-2 ms-auto">
                                    <button type="submit" class="btn btn-gradient-primary btn-icon-only" title="Terapkan Filter">
                                        <i class="mdi mdi-filter"></i>
                                    </button>
                                    <a href="{{ route('marketing.landingpage.index') }}" class="btn btn-gradient-secondary btn-icon-only" title="Reset Filter">
                                        <i class="mdi mdi-refresh"></i>
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- TABEL DATA PERSIS PERIZINAN -->
                    <div class="table-responsive">
                        <table class="table table-hover align-middle table-perizinan">
                            <thead>
                                <tr>
                                    <th class="col-no">No</th>
                                    <th style="width: 85px;">Foto Unit</th>
                                    <th>Kode & Nama Kavling</th>
                                    <th>Proyek</th>
                                    <th>Tipe Unit</th>
                                    <th class="text-center" style="width: 110px;">Kategori</th>
                                    <th>Harga</th>
                                    <th class="col-status text-center">Status Web</th>
                                    <th class="col-aksi text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($filteredUnits as $index => $u)
                                    <tr class="unit-table-row" id="row_unit_{{ $u->id }}" 
                                        data-search="{{ strtolower($u->unit_code . ' ' . $u->unit_name . ' ' . $u->project_name . ' ' . $u->type . ' ' . $u->jenis) }}">
                                        
                                        <!-- No -->
                                        <td class="col-no fw-bold text-center">{{ $loop->iteration }}</td>
                                        
                                        <!-- Foto Thumbnail -->
                                        <td>
                                            @php
                                                $photoUrl = null;
                                                if (!empty($u->photo)) {
                                                    if (str_starts_with($u->photo, 'http://') || str_starts_with($u->photo, 'https://')) {
                                                        $photoUrl = $u->photo;
                                                    } elseif (file_exists(public_path($u->photo))) {
                                                        $photoUrl = asset($u->photo);
                                                    } else {
                                                        $photoUrl = asset('storage/' . ltrim($u->photo, '/'));
                                                    }
                                                }
                                            @endphp
                                            @if($photoUrl)
                                                <img src="{{ $photoUrl }}" alt="{{ $u->unit_code }}" class="img-preview-thumb shadow-sm" onerror="this.onerror=null; this.parentElement.innerHTML='<div class=\'no-photo-box\'><i class=\'mdi mdi-camera-plus fs-5\'></i><span>No Photo</span></div>';">
                                            @else
                                                <div class="no-photo-box">
                                                    <i class="mdi mdi-camera-plus fs-5"></i>
                                                    <span>No Photo</span>
                                                </div>
                                            @endif
                                        </td>

                                        <!-- Kode & Nama Kavling (Persis Katalog Unit) -->
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <i class="mdi mdi-home-outline text-primary me-2" style="font-size: 1.15rem;"></i>
                                                <div>
                                                    <div class="fw-bold text-dark font-monospace" style="font-size: 0.86rem; line-height: 1.35;">
                                                        {{ $u->unit_code }}
                                                    </div>
                                                    <div class="text-secondary mt-0.5" style="font-size: 0.78rem; line-height: 1.3;">
                                                        {{ $u->unit_name }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>

                                        <!-- Proyek (Persis Katalog Unit) -->
                                        <td>
                                            <span class="icon-text">
                                                <i class="mdi mdi-office-building text-primary me-1"></i>
                                                <span class="fw-bold text-dark" style="font-size: 0.84rem;">{{ $u->project_name }}</span>
                                            </span>
                                        </td>

                                        <!-- Tipe Unit Saja (tanpa LB, LT, KT, KM) -->
                                        <td>
                                            <span class="badge bg-light text-dark border fw-bold" style="font-size: 0.78rem; padding: 4px 8px;">
                                                Tipe {{ $u->type }}
                                            </span>
                                        </td>

                                        <!-- Kategori Subsidi / Komersil (Solid 1 Warna Persis Katalog Unit) -->
                                        <td class="text-center">
                                            @if(strtolower($u->jenis) == 'subsidi')
                                                <span class="badge badge-gradient-success">
                                                    <i class="mdi mdi-home-assistant me-1"></i>Subsidi
                                                </span>
                                            @else
                                                <span class="badge badge-gradient-primary">
                                                    <i class="mdi mdi-office-building me-1"></i>Komersil
                                                </span>
                                            @endif
                                        </td>

                                        <!-- Harga (Persis Katalog Unit) -->
                                        <td>
                                            <span class="price-text" style="font-size: 0.88rem; font-family: monospace;">
                                                Rp {{ number_format($u->price, 0, ',', '.') }}
                                            </span>
                                        </td>

                                        <!-- Status Web (Solid 1 Warna Persis Katalog Unit) -->
                                        <td class="col-status text-center">
                                            @if($u->photo)
                                                <span class="badge badge-gradient-success">
                                                    <i class="mdi mdi-check-circle me-1"></i>Tayang
                                                </span>
                                            @else
                                                <span class="badge badge-gradient-warning">
                                                    <i class="mdi mdi-alert me-1"></i>Foto Kosong
                                                </span>
                                            @endif
                                        </td>

                                        <!-- Aksi Edit Foto & Data Web (Solid 1 Warna Persis Katalog Unit) -->
                                        <td class="col-aksi text-center">
                                            <a href="{{ route('marketing.landingpage.edit', $u->id) }}" 
                                               class="btn btn-sm btn-gradient-primary d-inline-flex align-items-center py-1.5 px-3 fw-semibold shadow-sm text-decoration-none" 
                                               style="font-size: 0.78rem; border-radius: 6px;">
                                                <i class="mdi mdi-pencil-box-outline me-1"></i>
                                                <span>Edit Web</span>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center text-muted py-5">
                                            <i class="mdi mdi-home-search-outline fs-2 text-muted d-block mb-1"></i>
                                            Belum ada unit ready to sell yang cocok dengan pencarian.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Footer Info (Persis Halaman Perizinan) -->
                    <div class="p-3 border-top bg-light d-flex justify-content-between align-items-center" style="border-bottom-left-radius: 8px; border-bottom-right-radius: 8px;">
                        <small class="text-muted" style="font-size: 0.78rem;">
                            Menampilkan <strong>{{ count($filteredUnits) }}</strong> Unit Ready to Sell
                        </small>
                        <small class="text-muted" style="font-size: 0.78rem;">
                            <i class="mdi mdi-database-check text-success me-1"></i>Sinkronisasi Otomatis Database Unit
                        </small>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>

@push('scripts')
<script>
    // Live Search Filter Tabel Unit Persis Perizinan
    function applyLiveSearch(query) {
        var filter = query.toLowerCase();
        var rows = document.querySelectorAll('.unit-table-row');
        rows.forEach(function(row) {
            var text = row.getAttribute('data-search') || row.innerText.toLowerCase();
            if (text.toLowerCase().indexOf(filter) > -1) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }
</script>
@endpush

@endsection
