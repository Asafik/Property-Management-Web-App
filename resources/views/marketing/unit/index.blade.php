@extends('layouts.partial.app')

@section('title', 'Daftar Unit Marketing - Penetapan Harga Jual')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard-clean.css') }}?v={{ time() }}">
    <style>
        /* Table Unit Marketing Styles */
        .table-unit {
            width: 100% !important;
            margin-bottom: 0;
        }
        .table-unit thead th {
            background: #f8fafc !important;
            color: #4b5563 !important;
            font-weight: 700;
            font-size: 0.78rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 2px solid #e2e8f0 !important;
            padding: 0.75rem 0.65rem !important;
            vertical-align: middle;
            white-space: nowrap;
        }
        .table-unit tbody td {
            padding: 0.75rem 0.65rem !important;
            vertical-align: middle;
            font-size: 0.83rem;
            border-bottom: 1px solid #f1f5f9;
            white-space: normal !important;
        }
        .table-unit .col-no {
            width: 45px;
            text-align: center;
            white-space: nowrap !important;
        }
        .table-unit .col-status {
            width: 110px;
            text-align: center;
            white-space: nowrap !important;
        }
        .table-unit .col-aksi {
            width: 130px;
            text-align: center;
            white-space: nowrap !important;
        }

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
        .compact-table-card .card-body,
        .card.compact-table-card .card-body {
            padding: 0 !important;
            background: #ffffff !important;
        }

        .price-badge-notset {
            background: #fef2f2;
            color: #dc2626;
            border: 1px dashed #fca5a5;
            padding: 3px 8px;
            border-radius: 6px;
            font-size: 0.78rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }
        .price-badge-set {
            color: #059669;
            font-weight: 700;
            font-size: 0.88rem;
            font-family: monospace;
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
                Daftar Unit Marketing
            </h2>
            <p class="text-muted mb-0" style="font-size: 0.88rem;">
                Unit kavling hasil pemecahan Legal & Proyek. Tentukan dan sesuaikan harga jual unit untuk siap dipasarkan oleh Tim Marketing.
            </p>
        </div>
    </div>

    <!-- 4 KPI Metrics Card Grid -->
    <div class="dash-kpi-grid mb-4">
        
        <!-- Card 1: Total Unit (Ungu) -->
        <div class="dash-kpi-card">
            <div class="dash-kpi-left">
                <div class="dash-kpi-icon purple">
                    <i class="mdi mdi-home-city-outline"></i>
                </div>
                <div class="dash-kpi-info">
                    <div class="dash-kpi-label">Total Unit Kavling</div>
                    <div class="dash-kpi-val">{{ $totalUnit ?? 0 }}</div>
                    <div class="dash-kpi-sub">Unit Terdaftar dari Legal</div>
                </div>
            </div>
            <div class="dash-kpi-action purple">
                <i class="mdi mdi-arrow-right"></i>
            </div>
        </div>

        <!-- Card 2: Belum Ada Harga (Rose / Merah) -->
        <div class="dash-kpi-card">
            <div class="dash-kpi-left">
                <div class="dash-kpi-icon rose">
                    <i class="mdi mdi-tag-off-outline"></i>
                </div>
                <div class="dash-kpi-info">
                    <div class="dash-kpi-label">Harga Belum Diset</div>
                    <div class="dash-kpi-val">{{ $totalHargaBelumSet ?? 0 }}</div>
                    <div class="dash-kpi-sub">Perlu Diberi Harga Jual</div>
                </div>
            </div>
            <div class="dash-kpi-action rose">
                <i class="mdi mdi-arrow-right"></i>
            </div>
        </div>

        <!-- Card 3: Siap Dipasarkan (Hijau) -->
        <div class="dash-kpi-card">
            <div class="dash-kpi-left">
                <div class="dash-kpi-icon green">
                    <i class="mdi mdi-tag-check-outline"></i>
                </div>
                <div class="dash-kpi-info">
                    <div class="dash-kpi-label">Harga Sudah Diset</div>
                    <div class="dash-kpi-val">{{ $totalHargaSudahSet ?? 0 }}</div>
                    <div class="dash-kpi-sub">Siap / Sedang Dipasarkan</div>
                </div>
            </div>
            <div class="dash-kpi-action green">
                <i class="mdi mdi-arrow-right"></i>
            </div>
        </div>

        <!-- Card 4: Unit Terjual (Sold) (Amber / Kuning) -->
        <div class="dash-kpi-card">
            <div class="dash-kpi-left">
                <div class="dash-kpi-icon amber">
                    <i class="mdi mdi-cash-check"></i>
                </div>
                <div class="dash-kpi-info">
                    <div class="dash-kpi-label">Unit Sold / Terjual</div>
                    <div class="dash-kpi-val">{{ $totalSold ?? 0 }}</div>
                    <div class="dash-kpi-sub">Sudah Closing / Lunas</div>
                </div>
            </div>
            <div class="dash-kpi-action amber">
                <i class="mdi mdi-arrow-right"></i>
            </div>
        </div>
    </div>

    <!-- Main Container: Table & Filters -->
    <div class="row">
        <div class="col-12">
            <div class="card compact-table-card">
                <div class="card-body">
                    
                    <!-- Toolbar Filter & Search -->
                    <div class="p-3 border-bottom bg-white">
                        <form method="GET" action="{{ route('marketing.unit.index') }}" id="filterForm">
                            <div class="d-flex flex-wrap align-items-center justify-content-between gap-2.5">
                                
                                <div class="d-flex flex-wrap align-items-center gap-2 flex-grow-1">
                                    <!-- Search Input -->
                                    <div class="search-input-group flex-grow-1" style="max-width: 260px;">
                                        <div class="input-group input-group-sm">
                                            <span class="input-group-text bg-light border-end-0">
                                                <i class="mdi mdi-magnify text-muted"></i>
                                            </span>
                                            <input type="text" class="form-control border-start-0" 
                                                   name="search" value="{{ request('search') }}" 
                                                   placeholder="Cari kode unit, blok, nama..." 
                                                   style="font-size: 0.84rem;">
                                        </div>
                                    </div>

                                    <!-- Filter Tanah / Proyek -->
                                    <div style="width: 180px;">
                                        <select class="form-select form-select-sm" name="land_bank_id" onchange="document.getElementById('filterForm').submit()">
                                            <option value="all">Semua Proyek</option>
                                            @foreach($landBanks as $lb)
                                                <option value="{{ $lb->id }}" {{ request('land_bank_id') == $lb->id ? 'selected' : '' }}>
                                                    {{ $lb->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Filter Status Harga -->
                                    <div style="width: 170px;">
                                        <select class="form-select form-select-sm" name="status_harga" onchange="document.getElementById('filterForm').submit()">
                                            <option value="all" {{ request('status_harga') == 'all' ? 'selected' : '' }}>Semua Kondisi Harga</option>
                                            <option value="belum" {{ request('status_harga') == 'belum' ? 'selected' : '' }}>Belum Diset (Rp 0)</option>
                                            <option value="sudah" {{ request('status_harga') == 'sudah' ? 'selected' : '' }}>Sudah Diberi Harga</option>
                                        </select>
                                    </div>

                                    <!-- Filter Jenis Dropdown -->
                                    <div style="width: 130px;">
                                        <select class="form-select form-select-sm" name="jenis" onchange="document.getElementById('filterForm').submit()">
                                            <option value="all" {{ request('jenis') == 'all' ? 'selected' : '' }}>Semua Jenis</option>
                                            <option value="subsidi" {{ request('jenis') == 'subsidi' ? 'selected' : '' }}>Subsidi</option>
                                            <option value="komersil" {{ request('jenis') == 'komersil' ? 'selected' : '' }}>Komersil</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Action Filter / Reset Buttons -->
                                <div class="d-flex align-items-center gap-2 ms-auto">
                                    <button type="submit" class="btn btn-sm text-white px-3" style="background: #9a55ff; border-radius: 6px; font-weight: 600;" title="Terapkan Filter">
                                        <i class="mdi mdi-filter me-1"></i>Filter
                                    </button>
                                    <a href="{{ route('marketing.unit.index') }}" class="btn btn-sm btn-light border px-2.5" style="border-radius: 6px;" title="Reset Filter">
                                        <i class="mdi mdi-refresh"></i>
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Clean Table: Daftar Unit Riil -->
                    <div class="table-responsive">
                        <table class="table table-hover align-middle table-unit mb-0">
                            <thead>
                                <tr>
                                    <th class="col-no text-center">No</th>
                                    <th>Kode / Unit</th>
                                    <th>Tanah / Proyek Asal</th>
                                    <th>Tipe & Dimensi</th>
                                    <th>Jenis</th>
                                    <th style="min-width: 160px;">Harga Jual (Wewenang Marketing)</th>
                                    <th class="col-status text-center">Status Jual</th>
                                    <th class="col-aksi text-center">Aksi Marketing</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($units as $index => $u)
                                    @php
                                        $st = strtolower($u->status ?? 'draft');
                                        if ($st == 'ready' || $st == 'available' || $st == 'tersedia') {
                                            $badgeBg = '#ecfdf5';
                                            $badgeColor = '#059669';
                                            $badgeBorder = '#a7f3d0';
                                            $stLabel = 'Ready to Sell';
                                        } elseif ($st == 'booked' || $st == 'booking') {
                                            $badgeBg = '#fffbeb';
                                            $badgeColor = '#d97706';
                                            $badgeBorder = '#fde68a';
                                            $stLabel = 'Booked';
                                        } elseif ($st == 'sold' || $st == 'terjual') {
                                            $badgeBg = '#fef2f2';
                                            $badgeColor = '#dc2626';
                                            $badgeBorder = '#fecaca';
                                            $stLabel = 'Sold';
                                        } else {
                                            $badgeBg = '#f8fafc';
                                            $badgeColor = '#475569';
                                            $badgeBorder = '#e2e8f0';
                                            $stLabel = 'Draft (Belum Rilis)';
                                        }

                                        $hasPrice = !empty($u->price) && $u->price > 0;
                                    @endphp
                                    <tr class="unit-table-row">
                                        
                                        <td class="col-no fw-bold text-center">
                                            {{ $units->firstItem() + $index }}
                                        </td>

                                        <td>
                                            <!-- KODE / BLOK -->
                                            <div class="fw-bold text-dark font-monospace" style="font-size: 0.88rem; line-height: 1.3;">
                                                {{ $u->unit_code ?: ($u->block . '-' . $u->unit_number) }}
                                            </div>
                                            <div class="text-secondary mt-0.5" style="font-size: 0.77rem; line-height: 1.3;">
                                                {{ $u->unit_name ?: ('Blok ' . $u->block . ' No. ' . $u->unit_number) }}
                                            </div>
                                        </td>

                                        <td>
                                            <!-- PROYEK ASAL -->
                                            <span class="badge py-1 px-2.5"
                                                style="background-color: #f3e8ff; color: #7e22ce; font-size: 0.76rem; font-weight: 700; border-radius: 6px; border: 1px solid #e9d5ff;">
                                                <i class="mdi mdi-map-marker me-0.5"></i>{{ $u->landBank->name ?? 'Proyek' }}
                                            </span>
                                        </td>

                                        <td>
                                            <!-- TIPE & DIMENSI -->
                                            <div class="fw-bold text-dark" style="font-size: 0.82rem;">
                                                {{ $u->type ? 'Tipe ' . $u->type : '-' }}
                                            </div>
                                            <div class="text-secondary font-monospace" style="font-size: 0.75rem;">
                                                LB: {{ $u->building_area ?? '-' }} m² | LT: {{ $u->area ?? '-' }} m²
                                            </div>
                                        </td>

                                        <td>
                                            <!-- JENIS -->
                                            @if(strtolower($u->jenis) == 'subsidi')
                                                <span class="badge py-0.5 px-2 fw-semibold" 
                                                    style="background-color: #eff6ff; color: #1d4ed8; font-size: 0.72rem; border-radius: 4px; border: 1px solid #bfdbfe;">
                                                    Subsidi
                                                </span>
                                            @else
                                                <span class="badge py-0.5 px-2 fw-semibold" 
                                                    style="background-color: #fef3c7; color: #92400e; font-size: 0.72rem; border-radius: 4px; border: 1px solid #fde68a;">
                                                    Komersil
                                                </span>
                                            @endif
                                        </td>

                                        <td>
                                            <!-- HARGA JUAL -->
                                            @if($hasPrice)
                                                <div class="price-badge-set">
                                                    Rp {{ number_format($u->price, 0, ',', '.') }}
                                                </div>
                                            @else
                                                <span class="price-badge-notset">
                                                    <i class="mdi mdi-alert-circle-outline"></i> Belum Diberi Harga
                                                </span>
                                            @endif
                                        </td>

                                        <td class="col-status text-center">
                                            <!-- STATUS -->
                                            <span class="badge py-1 px-2.5 fw-semibold" style="font-size: 0.74rem; border-radius: 6px; background-color: {{ $badgeBg }}; color: {{ $badgeColor }}; border: 1px solid {{ $badgeBorder }};">
                                                {{ $stLabel }}
                                            </span>
                                        </td>

                                        <td class="col-aksi text-center">
                                            <!-- AKSI SET HARGA (MODAL TRIGGER) -->
                                            <button type="button" class="btn btn-sm text-white d-inline-flex align-items-center gap-1 px-2.5 py-1.5 shadow-sm"
                                                    style="background: {{ $hasPrice ? '#0284c7' : '#9a55ff' }}; border-radius: 6px; font-size: 0.8rem; font-weight: 600;"
                                                    data-bs-toggle="modal" data-bs-target="#modalSetHarga"
                                                    data-id="{{ $u->id }}"
                                                    data-code="{{ $u->unit_code ?: ($u->block . '-' . $u->unit_number) }}"
                                                    data-name="{{ $u->unit_name ?: ('Blok ' . $u->block . ' No. ' . $u->unit_number) }}"
                                                    data-project="{{ $u->landBank->name ?? '-' }}"
                                                    data-price="{{ $u->price ?? '' }}"
                                                    data-status="{{ $u->status ?? 'ready' }}"
                                                    title="{{ $hasPrice ? 'Ubah Harga Jual' : 'Tentukan Harga Jual Baru' }}">
                                                <i class="mdi {{ $hasPrice ? 'mdi-pencil-outline' : 'mdi-tag-plus-outline' }}"></i>
                                                <span>{{ $hasPrice ? 'Ubah Harga' : 'Set Harga' }}</span>
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center text-muted py-5">
                                            <i class="mdi mdi-home-alert-outline me-2" style="font-size: 2rem; color: #94a3b8;"></i>
                                            <p class="mt-2 mb-0">Belum ada unit kavling yang dibuat dari Legal atau sesuai filter.</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if ($units->hasPages())
                        <div class="p-3 border-top bg-light d-flex flex-wrap justify-content-between align-items-center gap-2">
                            <small class="text-muted" style="font-size: 0.78rem;">
                                Menampilkan {{ $units->firstItem() }} - {{ $units->lastItem() }} dari {{ $units->total() }} Unit
                            </small>
                            <div class="pagination-wrapper">
                                {{ $units->links('pagination::bootstrap-5') }}
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>

</div>

<!-- MODAL TENTUKAN / UBAH HARGA JUAL UNIT -->
<div class="modal fade" id="modalSetHarga" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 12px; border: none; box-shadow: 0 10px 25px rgba(0,0,0,0.15);">
            <div class="modal-header border-bottom py-3 px-4" style="background: #f8fafc;">
                <h5 class="modal-title fw-bold text-dark d-flex align-items-center gap-2" style="font-size: 1.05rem;">
                    <i class="mdi mdi-tag-text-outline text-primary fs-4"></i>
                    <span>Penetapan Harga Jual Unit</span>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="POST" id="formSetHarga">
                @csrf
                <div class="modal-body p-4">
                    
                    <!-- Ringkasan Info Unit -->
                    <div class="p-3 rounded-3 mb-3 border" style="background: #faf5ff; border-color: #f3e8ff !important;">
                        <div class="small text-muted mb-0.5">Unit Kavling:</div>
                        <div class="fw-bold text-dark" id="modalUnitTitle" style="font-size: 1rem;">-</div>
                        <small class="text-primary fw-semibold" id="modalProjectName">-</small>
                    </div>

                    <!-- Input Harga Jual -->
                    <div class="mb-3">
                        <label class="form-label fw-bold text-dark" style="font-size: 0.86rem;">
                            Harga Jual Unit (Rp) <span class="text-danger">*</span>
                        </label>
                        <div class="input-group">
                            <span class="input-group-text bg-light fw-bold" style="font-size: 0.88rem;">Rp</span>
                            <input type="text" inputmode="numeric" name="price" id="modalInputPrice" class="form-control" 
                                   placeholder="Contoh: 185.000.000" required autocomplete="off"
                                   style="font-size: 0.95rem; font-weight: 600;">
                        </div>
                        <small class="text-muted" style="font-size: 0.74rem;">Wewenang penuh bagian Marketing menentukan harga resmi ke konsumen.</small>
                    </div>

                    <!-- Status Pemasaran -->
                    <div class="mb-2">
                        <label class="form-label fw-bold text-dark" style="font-size: 0.86rem;">
                            Status Pemasaran
                        </label>
                        <select name="status" id="modalSelectStatus" class="form-select" style="font-size: 0.86rem;">
                            <option value="ready">Ready to Sell (Siap Dipasarkan)</option>
                            <option value="draft">Draft (Tahan / Belum Dirilis)</option>
                            <option value="booked">Booked (Dalam Booking)</option>
                            <option value="sold">Sold (Terjual)</option>
                        </select>
                        <small class="text-muted" style="font-size: 0.74rem;">Unit yang berstatus "Ready to Sell" akan langsung tampil di Catalog Unit & Siteplan.</small>
                    </div>

                </div>
                <div class="modal-footer border-top py-2.5 px-4 bg-light d-flex justify-content-between">
                    <button type="button" class="btn btn-sm btn-light border px-3" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-sm text-white px-4 fw-bold shadow-sm" style="background: #9a55ff; border-radius: 6px;">
                        <i class="mdi mdi-content-save me-1"></i>Simpan Harga
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const modalSetHarga = document.getElementById('modalSetHarga');
        const inputPrice = document.getElementById('modalInputPrice');
        const formSetHarga = document.getElementById('formSetHarga');

        // Fungsi format nominal Rupiah (pemisah ribuan dengan titik)
        function formatRupiah(value) {
            if (!value && value !== 0) return '';
            const clean = value.toString().replace(/[^0-9]/g, '');
            if (!clean) return '';
            return new Intl.NumberFormat('id-ID').format(clean);
        }

        // Event listener saat user mengetik nominal harga
        if (inputPrice) {
            inputPrice.addEventListener('input', function () {
                const selectionStart = this.selectionStart;
                const prevLen = this.value.length;
                this.value = formatRupiah(this.value);
                const newLen = this.value.length;
                // Jaga posisi cursor tetap nyaman saat mengetik
                if (selectionStart !== null) {
                    const diff = newLen - prevLen;
                    this.setSelectionRange(selectionStart + diff, selectionStart + diff);
                }
            });
        }

        if (modalSetHarga) {
            modalSetHarga.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget;
                const id = button.getAttribute('data-id');
                const code = button.getAttribute('data-code');
                const name = button.getAttribute('data-name');
                const project = button.getAttribute('data-project');
                const price = button.getAttribute('data-price');
                const status = button.getAttribute('data-status');

                // Set Action Form
                if (formSetHarga) {
                    formSetHarga.action = "{{ url('/marketing/unit') }}/" + id + "/price";
                }

                // Set View Content
                document.getElementById('modalUnitTitle').textContent = code + ' - ' + name;
                document.getElementById('modalProjectName').textContent = project;
                
                // Format harga saat modal dibuka jika unit sudah punya harga
                if (inputPrice) {
                    inputPrice.value = price ? formatRupiah(price) : '';
                }
                
                const statusSelect = document.getElementById('modalSelectStatus');
                if (statusSelect) {
                    if (status) {
                        statusSelect.value = status;
                    } else {
                        statusSelect.value = 'ready';
                    }
                }
            });

            // Bersihkan format titik sebelum dikirim ke backend
            if (formSetHarga) {
                formSetHarga.addEventListener('submit', function () {
                    if (inputPrice) {
                        inputPrice.value = inputPrice.value.replace(/[^0-9]/g, '');
                    }
                });
            }
        }
    });
</script>
@endpush

@endsection
