@extends('layouts.partial.app')

@section('title', 'Detail Unit ' . ($unit->unit_code ?: ($unit->block . '-' . $unit->unit_number)) . ' - Catalog Unit')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard-clean.css') }}?v={{ time() }}">
    <style>
        /* Button Kembali (Sama Persis Pasca Land Bank & Perizinan) */
        .btn-kembali-proyek {
            border-radius: 8px !important;
            font-size: 0.85rem !important;
            font-weight: 700 !important;
            border: 1px solid #64748b !important;
            background-color: #64748b !important;
            color: #ffffff !important;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1) !important;
            transition: all 0.15s ease !important;
            text-decoration: none !important;
        }
        .btn-kembali-proyek:hover {
            background-color: #475569 !important;
            border-color: #475569 !important;
            color: #ffffff !important;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15) !important;
        }

        /* Tab Navigation (Persis Pasca Land Bank Detail) */
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

        /* Detail Table Clean (Persis Tabel Pasca Land Bank Detail) */
        .table-detail-clean {
            width: 100% !important;
            margin-bottom: 0;
            border-collapse: collapse;
        }
        .table-detail-clean tr td {
            padding: 0.48rem 0 !important;
            border: none !important;
            vertical-align: middle;
        }
        .table-detail-clean td.col-lbl {
            width: 40%;
            color: #64748b;
            font-size: 0.84rem;
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
            font-size: 0.85rem;
            font-weight: 600;
        }

        /* Soft Badges */
        .badge-soft {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 5px 12px;
            border-radius: 6px;
            font-size: 0.8rem;
            font-weight: 700;
        }
        .badge-available-subsidi {
            background: #e0f2fe;
            color: #0369a1 !important;
            border: 1px solid #bae6fd;
        }
        .badge-available-komersil {
            background: #eff6ff;
            color: #1d4ed8 !important;
            border: 1px solid #bfdbfe;
        }
        .badge-booking {
            background: #fef3c7;
            color: #b45309 !important;
            border: 1px solid #fde68a;
        }
        .badge-sold {
            background: #fee2e2;
            color: #b91c1c !important;
            border: 1px solid #fecaca;
        }
        .badge-draft {
            background: #f1f5f9;
            color: #475569 !important;
            border: 1px solid #e2e8f0;
        }

        /* Progress Bar */
        .progress-wrapper {
            margin-top: 4px;
        }
        .progress-row {
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .progress-row .progress {
            flex: 1;
            height: 8px;
            border-radius: 4px;
            background-color: #e2e8f0;
            margin-bottom: 0;
        }
        .progress-bar-custom {
            height: 100%;
            border-radius: 4px;
            transition: width 0.4s ease;
        }
        .progress-percent {
            font-size: 0.8rem;
            font-weight: 700;
            color: #475569;
            min-width: 38px;
        }

        /* Name Initial Avatar */
        .name-avatar-wrap {
            display: flex;
            align-items: center;
            gap: 0.85rem;
            padding: 0.75rem 1rem;
            background: #f8fafc;
            border-radius: 10px;
            border: 1px solid #e2e8f0;
            margin-bottom: 1.25rem;
        }
        .name-initial {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            color: #fff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 1rem;
            flex-shrink: 0;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.12);
        }
        .name-meta-title {
            font-weight: 700;
            color: #1e293b;
            font-size: 1rem;
        }
        .name-meta-sub {
            font-size: 0.82rem;
            color: #64748b;
        }

        /* Empty state card */
        .empty-state-box {
            text-align: center;
            padding: 3rem 1.5rem;
            background: #fafafa;
            border-radius: 10px;
            border: 1px dashed #cbd5e1;
        }
        .empty-state-box i {
            font-size: 2.75rem;
            color: #94a3b8;
        }
    </style>
@endpush

@section('content')
<div class="content-wrapper">
    <div class="container-fluid px-2 px-md-4 py-3">

        <!-- Top Header (Persis Halaman Pasca Land Bank Detail) -->
        <div class="d-flex flex-wrap justify-content-between align-items-start gap-3 mb-4">
            <div>
                <h2 class="text-dark mb-1 fw-bold d-flex align-items-center gap-2" style="font-size: 1.55rem; letter-spacing: -0.02em;">
                    <span>Unit {{ $unit->unit_code ?: ($unit->block . '-' . $unit->unit_number) }}</span>
                    @if(strtolower($unit->jenis) == 'subsidi')
                        <span class="badge py-1 px-2.5 fw-semibold" style="background-color: #eff6ff; color: #1d4ed8; font-size: 0.75rem; border-radius: 6px; border: 1px solid #bfdbfe;">Subsidi</span>
                    @else
                        <span class="badge py-1 px-2.5 fw-semibold" style="background-color: #fef3c7; color: #92400e; font-size: 0.75rem; border-radius: 6px; border: 1px solid #fde68a;">Komersil</span>
                    @endif
                </h2>
                <p class="text-muted mb-0" style="font-size: 0.88rem;">
                    {{ $unit->landBank->name ?? 'Proyek' }} &bull; {{ $unit->unit_name ?: ('Blok ' . $unit->block . ' No. ' . $unit->unit_number) }} &bull; Tipe: {{ $unit->type ?: '-' }}
                </p>
            </div>
            <div class="d-flex align-items-center gap-2">
                <a href="{{ route('marketing.jual-unit') }}" class="btn btn-sm d-inline-flex align-items-center gap-2 px-3 py-2 shadow-sm text-white fw-bold btn-kembali-proyek">
                    <i class="mdi mdi-arrow-left text-white" style="font-size: 1.1rem; line-height: 1;"></i>
                    <span>Kembali</span>
                </a>
            </div>
        </div>

        @php
            // Logic Status & Progres
            $statusRaw = strtolower($unit->status ?? 'ready');
            $jenisRaw = strtolower($unit->jenis ?? '');
            $typeRaw = strtolower($unit->type ?? '');

            if ($statusRaw === 'ready' || $statusRaw === 'tersedia') {
                $statusText = 'Tersedia';
            } elseif ($statusRaw === 'booked' || $statusRaw === 'booking') {
                $statusText = 'Booking';
            } elseif ($statusRaw === 'sold' || $statusRaw === 'terjual') {
                $statusText = 'Terjual';
            } else {
                $statusText = ucfirst($statusRaw ?: 'Draft');
            }

            $progPct = (int) ($unit->construction_progress_percentage ?? 0);
            $progColor = $progPct >= 100 ? '#10b981' : ($progPct >= 40 ? '#0284c7' : '#f59e0b');
        @endphp

        <!-- 4 KPI Metrics Card Grid (Persis Halaman Pasca Land Bank - Mode Murni Display) -->
        <div class="dash-kpi-grid mb-4">
            
            <!-- Card 1: Harga Jual Unit (Ungu) -->
            <div class="dash-kpi-card">
                <div class="dash-kpi-left">
                    <div class="dash-kpi-icon purple">
                        <i class="mdi mdi-cash-multiple"></i>
                    </div>
                    <div class="dash-kpi-info">
                        <div class="dash-kpi-label">Harga Jual Unit</div>
                        <div class="dash-kpi-val" style="font-size: 1.15rem; color: #28a745;">
                            @if(!empty($unit->price) && $unit->price > 0)
                                Rp {{ number_format($unit->price, 0, ',', '.') }}
                            @else
                                <span class="text-danger fs-6 fw-bold">Belum Diberi Harga</span>
                            @endif
                        </div>
                        <div class="dash-kpi-sub">Jenis: {{ ucfirst($unit->jenis ?? 'Komersil') }} | Tipe: {{ $unit->type ?? '-' }}</div>
                    </div>
                </div>
            </div>

            <!-- Card 2: Status Pemasaran -->
            <div class="dash-kpi-card">
                <div class="dash-kpi-left">
                    <div class="dash-kpi-icon {{ $statusRaw === 'draft' ? '' : ($statusRaw === 'booked' || $statusRaw === 'booking' ? 'amber' : ($statusRaw === 'sold' || $statusRaw === 'terjual' ? 'rose' : 'green')) }}"
                        style="{{ $statusRaw === 'draft' ? 'background-color: #f1f5f9; color: #475569;' : '' }}">
                        <i class="mdi {{ $statusRaw === 'draft' ? 'mdi-file-document-edit-outline' : ($statusRaw === 'booked' || $statusRaw === 'booking' ? 'mdi-bookmark-check-outline' : ($statusRaw === 'sold' || $statusRaw === 'terjual' ? 'mdi-cash-check' : 'mdi-tag-outline')) }}"></i>
                    </div>
                    <div class="dash-kpi-info">
                        <div class="dash-kpi-label">Status Pemasaran</div>
                        <div class="dash-kpi-val">{{ $statusText }}</div>
                        <div class="dash-kpi-sub">Luas Tanah: {{ number_format($unit->area ?? 0, 0, ',', '.') }} m²</div>
                    </div>
                </div>
            </div>

            <!-- Card 3: Fisik Bangunan (Biru) -->
            <div class="dash-kpi-card">
                <div class="dash-kpi-left">
                    <div class="dash-kpi-icon blue">
                        <i class="mdi mdi-progress-check"></i>
                    </div>
                    <div class="dash-kpi-info">
                        <div class="dash-kpi-label">Fisik Bangunan</div>
                        <div class="dash-kpi-val">{{ $progPct }}%</div>
                        <div class="dash-kpi-sub">Tahap: {{ ucwords(str_replace('_', ' ', $unit->construction_progress ?? 'Belum Mulai')) }}</div>
                    </div>
                </div>
            </div>

            <!-- Card 4: Uang Tanda Jadi / UTJ (Kuning / Amber) -->
            <div class="dash-kpi-card">
                <div class="dash-kpi-left">
                    <div class="dash-kpi-icon amber">
                        <i class="mdi mdi-calendar-check-outline"></i>
                    </div>
                    <div class="dash-kpi-info">
                        <div class="dash-kpi-label">Uang Tanda Jadi (UTJ)</div>
                        <div class="dash-kpi-val">
                            Rp {{ number_format($unit->activeBooking->booking_fee ?? 0, 0, ',', '.') }}
                        </div>
                        <div class="dash-kpi-sub">
                            @if($unit->activeBooking)
                                {{ $unit->activeBooking->customer->full_name ?? 'Ada Booking' }}
                            @else
                                Belum Ada Booking
                            @endif
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Custom Tabs Card (2 Tab: 1. Unit yang Dibeli, 2. Customer & Agen) -->
        <div class="custom-tabs-card">
            <!-- Tabs Navigation (Hanya 2 Tab) -->
            <div class="custom-tabs-header">
                <ul class="nav nav-tabs" id="unitDetailTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="tab-unit-btn" data-bs-toggle="tab" data-bs-target="#tab-unit" type="button" role="tab" aria-controls="tab-unit" aria-selected="true">
                            <i class="mdi mdi-home-outline me-2"></i>Unit yang Dibeli
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="tab-customer-agent-btn" data-bs-toggle="tab" data-bs-target="#tab-customer-agent" type="button" role="tab" aria-controls="tab-customer-agent" aria-selected="false">
                            <i class="mdi mdi-account-group-outline me-2"></i>Customer & Agen
                            @if($unit->activeBooking)
                                <span class="badge bg-success ms-1.5" style="font-size: 0.72rem; border-radius: 6px;">Aktif</span>
                            @endif
                        </button>
                    </li>
                </ul>
            </div>

            <!-- Tab Content -->
            <div class="card-body p-3 p-md-4">
                <div class="tab-content" id="unitDetailTabsContent">

                    <!-- ==================== TAB 1: UNIT YANG DIBELI ==================== -->
                    <div class="tab-pane fade show active" id="tab-unit" role="tabpanel" aria-labelledby="tab-unit-btn">
                        <div class="row g-4">
                            <!-- Kolom Kiri: Spesifikasi & Identitas Fisik Unit -->
                            <div class="col-lg-6">
                                <h6 class="fw-bold text-dark border-bottom pb-2 mb-3 d-flex align-items-center">
                                    <i class="mdi mdi-home-city-outline text-primary fs-5 me-2"></i>Spesifikasi & Identitas Unit
                                </h6>
                                <table class="table-detail-clean">
                                    <tr>
                                        <td class="col-lbl">Nama Unit</td>
                                        <td class="col-sep">:</td>
                                        <td class="col-val">{{ $unit->unit_name ?: '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="col-lbl">Kode Unit</td>
                                        <td class="col-sep">:</td>
                                        <td class="col-val font-monospace">{{ $unit->unit_code ?: '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="col-lbl">Blok</td>
                                        <td class="col-sep">:</td>
                                        <td class="col-val">{{ $unit->block ?: '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="col-lbl">Nomor Unit</td>
                                        <td class="col-sep">:</td>
                                        <td class="col-val">{{ $unit->unit_number ?: '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="col-lbl">Jenis Unit</td>
                                        <td class="col-sep">:</td>
                                        <td class="col-val">{{ ucfirst($unit->jenis ?: '-') }}</td>
                                    </tr>
                                    <tr>
                                        <td class="col-lbl">Tipe Unit</td>
                                        <td class="col-sep">:</td>
                                        <td class="col-val">{{ $unit->type ?: '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="col-lbl">Luas Tanah</td>
                                        <td class="col-sep">:</td>
                                        <td class="col-val">{{ number_format($unit->area ?? 0, 0, ',', '.') }} m²</td>
                                    </tr>
                                    <tr>
                                        <td class="col-lbl">Luas Bangunan</td>
                                        <td class="col-sep">:</td>
                                        <td class="col-val">{{ number_format($unit->building_area ?? 0, 0, ',', '.') }} m²</td>
                                    </tr>

                                </table>
                            </div>

                            <!-- Kolom Kanan: Legalitas, Finansial & Lokasi -->
                            <div class="col-lg-6">
                                <h6 class="fw-bold text-dark border-bottom pb-2 mb-3 d-flex align-items-center">
                                    <i class="mdi mdi-shield-check-outline text-success fs-5 me-2"></i>Legalitas, Finansial & Lokasi
                                </h6>
                                <table class="table-detail-clean">
                                    <tr>
                                        <td class="col-lbl">Harga Jual Unit</td>
                                        <td class="col-sep">:</td>
                                        <td class="col-val text-success" style="font-size: 1rem; font-weight: 800;">
                                            @if(!empty($unit->price) && $unit->price > 0)
                                                Rp {{ number_format($unit->price, 0, ',', '.') }}
                                            @else
                                                <span class="text-danger fs-6 fw-bold">Belum Diberi Harga</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="col-lbl">Status Unit</td>
                                        <td class="col-sep">:</td>
                                        <td class="col-val">
                                            @if ($statusRaw === 'ready' || $statusRaw === 'tersedia')
                                                <span class="badge-soft {{ ($jenisRaw === 'subsidi' || $typeRaw === 'subsidi') ? 'badge-available-subsidi' : 'badge-available-komersil' }}">
                                                    <i class="mdi mdi-check-circle-outline"></i>Tersedia
                                                </span>
                                            @elseif ($statusRaw === 'booked' || $statusRaw === 'booking')
                                                <span class="badge-soft badge-booking">
                                                    <i class="mdi mdi-bookmark-check-outline"></i>Booking
                                                </span>
                                            @elseif ($statusRaw === 'sold' || $statusRaw === 'terjual')
                                                <span class="badge-soft badge-sold">
                                                    <i class="mdi mdi-cash-check"></i>Terjual
                                                </span>
                                            @elseif ($statusRaw === 'draft')
                                                <span class="badge-soft badge-draft">
                                                    <i class="mdi mdi-file-document-edit-outline"></i>Draft (Belum Diberi Harga)
                                                </span>
                                            @else
                                                <span class="badge-soft badge-draft">
                                                    <i class="mdi mdi-information-outline"></i>{{ ucfirst($statusRaw ?: 'Draft') }}
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="col-lbl">Progres Fisik</td>
                                        <td class="col-sep">:</td>
                                        <td class="col-val">
                                            <div class="progress-wrapper">
                                                <div class="progress-row">
                                                    <div class="progress">
                                                        <div class="progress-bar-custom" style="width: {{ $progPct }}%; background-color: {{ $progColor }};"></div>
                                                    </div>
                                                    <span class="progress-percent">{{ $progPct }}%</span>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="col-lbl">Tahap Pembangunan</td>
                                        <td class="col-sep">:</td>
                                        <td class="col-val">{{ ucwords(str_replace('_', ' ', $unit->construction_progress ?? 'Belum Mulai')) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="col-lbl">Nomor Sertifikat</td>
                                        <td class="col-sep">:</td>
                                        <td class="col-val font-monospace">{{ $unit->certificate_no ?: '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="col-lbl">Dokumen Sertifikat</td>
                                        <td class="col-sep">:</td>
                                        <td class="col-val">
                                            @if($unit->file_certificate)
                                                <a href="{{ asset($unit->file_certificate) }}" target="_blank" class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25 py-1 px-2.5 text-decoration-none d-inline-flex align-items-center" style="font-size: 0.8rem;">
                                                    <i class="mdi mdi-file-document-outline me-1.5"></i>Lihat Dokumen
                                                </a>
                                            @else
                                                <span class="text-muted small">-</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="col-lbl">Kawasan Proyek</td>
                                        <td class="col-sep">:</td>
                                        <td class="col-val">{{ $unit->landBank->name ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="col-lbl">Alamat Proyek</td>
                                        <td class="col-sep">:</td>
                                        <td class="col-val">{{ $unit->landBank->address ?? '-' }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- ==================== TAB 2: CUSTOMER & AGEN (JADI 1 TAB) ==================== -->
                    <div class="tab-pane fade" id="tab-customer-agent" role="tabpanel" aria-labelledby="tab-customer-agent-btn">
                        @if($unit->activeBooking)
                            <!-- Banner Ringkasan Booking Aktif -->
                            <div class="p-3 mb-4 rounded-3 border d-flex flex-wrap justify-content-between align-items-center gap-3" style="background: linear-gradient(135deg, #f8fafc, #eff6ff); border-color: #bfdbfe !important;">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="name-initial" style="background: linear-gradient(135deg, #da8cff, #9a55ff);">
                                        {{ strtoupper(substr($unit->activeBooking->customer->full_name ?? 'C', 0, 2)) }}
                                    </div>
                                    <div>
                                        <div class="fw-bold text-dark" style="font-size: 1.05rem;">
                                            {{ $unit->activeBooking->customer->full_name ?? '-' }}
                                        </div>
                                        <div class="small text-muted d-flex flex-wrap align-items-center gap-2 mt-0.5">
                                            <span><i class="mdi mdi-ticket-outline me-1"></i>Kode: <strong>{{ $unit->activeBooking->booking_code ?? ('BK-' . $unit->activeBooking->id) }}</strong></span>
                                            <span>&bull;</span>
                                            <span><i class="mdi mdi-calendar-month-outline me-1"></i>{{ $unit->activeBooking->booking_date ? \Carbon\Carbon::parse($unit->activeBooking->booking_date)->translatedFormat('d F Y') : '-' }}</span>
                                            <span>&bull;</span>
                                            <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 px-2 py-0.5" style="font-size: 0.75rem;">
                                                <i class="mdi mdi-check-circle-outline me-0.5"></i>{{ ucfirst($unit->activeBooking->status ?? 'Aktif') }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <a href="{{ route('cetak.kuitansi_utj', $unit->activeBooking->id) }}" target="_blank" class="btn btn-sm btn-outline-success fw-bold d-inline-flex align-items-center px-3 py-2 shadow-sm" style="border-radius: 8px;">
                                        <i class="mdi mdi-printer me-2"></i>
                                        <span>Cetak Kuitansi UTJ</span>
                                    </a>
                                </div>
                            </div>

                            <!-- Bagian 1: Data Customer & Rincian Booking -->
                            <div class="row g-4 mb-4 pb-4 border-bottom">
                                <!-- Kolom Kiri: Identitas Lengkap Customer -->
                                <div class="col-lg-6">
                                    <h6 class="fw-bold text-dark border-bottom pb-2 mb-3 d-flex align-items-center">
                                        <i class="mdi mdi-card-account-details-outline text-primary fs-5 me-2"></i>Identitas Customer
                                    </h6>
                                    <table class="table-detail-clean">
                                        <tr>
                                            <td class="col-lbl">Nama Lengkap</td>
                                            <td class="col-sep">:</td>
                                            <td class="col-val">{{ $unit->activeBooking->customer->full_name ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="col-lbl">NIK</td>
                                            <td class="col-sep">:</td>
                                            <td class="col-val font-monospace">{{ $unit->activeBooking->customer->nik ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="col-lbl">Nomor WhatsApp / HP</td>
                                            <td class="col-sep">:</td>
                                            <td class="col-val">
                                                @if(!empty($unit->activeBooking->customer->phone))
                                                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $unit->activeBooking->customer->phone) }}" target="_blank" class="text-decoration-none text-success fw-semibold">
                                                        <i class="mdi mdi-whatsapp me-1"></i>{{ $unit->activeBooking->customer->phone }}
                                                    </a>
                                                @else
                                                    -
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="col-lbl">Email</td>
                                            <td class="col-sep">:</td>
                                            <td class="col-val">{{ $unit->activeBooking->customer->email ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="col-lbl">Pekerjaan / Jabatan</td>
                                            <td class="col-sep">:</td>
                                            <td class="col-val">{{ $unit->activeBooking->customer->job_status ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="col-lbl">Nama Perusahaan</td>
                                            <td class="col-sep">:</td>
                                            <td class="col-val">{{ $unit->activeBooking->customer->company_name ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="col-lbl">NPWP</td>
                                            <td class="col-sep">:</td>
                                            <td class="col-val font-monospace">{{ $unit->activeBooking->customer->npwp ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="col-lbl">Alamat Lengkap</td>
                                            <td class="col-sep">:</td>
                                            <td class="col-val">{{ $unit->activeBooking->customer->address ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="col-lbl">Dokumen Customer</td>
                                            <td class="col-sep">:</td>
                                            <td class="col-val">
                                                @if(isset($unit->activeBooking->customer->documents) && $unit->activeBooking->customer->documents->count() > 0)
                                                    <div class="d-flex flex-wrap gap-1.5 pt-1">
                                                        @foreach($unit->activeBooking->customer->documents as $doc)
                                                            @php
                                                                $fileUrl = file_exists(public_path('uploads/' . $doc->file)) ? asset('uploads/' . $doc->file) : asset('storage/' . $doc->file);
                                                            @endphp
                                                            <a href="{{ $fileUrl }}" target="_blank" class="badge py-1 px-2 text-decoration-none d-inline-flex align-items-center gap-1" style="background-color: #f1f5f9; color: #334155; border: 1px solid #cbd5e1; font-size: 0.76rem; border-radius: 6px;" title="Lihat {{ $doc->document_name }}">
                                                                <i class="mdi mdi-file-document-check text-success"></i>
                                                                <span>{{ $doc->document_name }}</span>
                                                            </a>
                                                        @endforeach
                                                    </div>
                                                @else
                                                    <span class="text-muted small">-</span>
                                                @endif
                                            </td>
                                        </tr>
                                    </table>
                                </div>

                                <!-- Kolom Kanan: Detail Booking & Finansial Transaksi -->
                                <div class="col-lg-6">
                                    <h6 class="fw-bold text-dark border-bottom pb-2 mb-3 d-flex align-items-center">
                                        <i class="mdi mdi-receipt-text-check-outline text-success fs-5 me-2"></i>Rincian Transaksi Booking
                                    </h6>
                                    <table class="table-detail-clean">
                                        <tr>
                                            <td class="col-lbl">Kode Booking</td>
                                            <td class="col-sep">:</td>
                                            <td class="col-val font-monospace">{{ $unit->activeBooking->booking_code ?? ('BK-' . $unit->activeBooking->id) }}</td>
                                        </tr>
                                        <tr>
                                            <td class="col-lbl">Tanggal Booking</td>
                                            <td class="col-sep">:</td>
                                            <td class="col-val">{{ $unit->activeBooking->booking_date ? \Carbon\Carbon::parse($unit->activeBooking->booking_date)->translatedFormat('d F Y') : '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="col-lbl">Skema Pembelian</td>
                                            <td class="col-sep">:</td>
                                            <td class="col-val">
                                                <span class="badge py-1 px-2.5" style="background-color: #f3f4f6; color: #374151; border: 1px solid #d1d5db; border-radius: 6px; font-size: 0.78rem;">
                                                    {{ strtoupper($unit->activeBooking->purchase_type ?? 'KPR') }}
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="col-lbl">Uang Tanda Jadi (UTJ)</td>
                                            <td class="col-sep">:</td>
                                            <td class="col-val text-success" style="font-size: 1rem; font-weight: 800;">
                                                Rp {{ number_format($unit->activeBooking->booking_fee ?? 0, 0, ',', '.') }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="col-lbl">Status Booking</td>
                                            <td class="col-sep">:</td>
                                            <td class="col-val">
                                                <span class="badge-soft badge-booking">
                                                    <i class="mdi mdi-bookmark-check-outline"></i>{{ ucfirst($unit->activeBooking->status ?? 'Booking') }}
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="col-lbl">Tanggal Akad (Est.)</td>
                                            <td class="col-sep">:</td>
                                            <td class="col-val">{{ $unit->activeBooking->akad_date ? \Carbon\Carbon::parse($unit->activeBooking->akad_date)->translatedFormat('d F Y') : '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="col-lbl">Serah Terima (Est.)</td>
                                            <td class="col-sep">:</td>
                                            <td class="col-val">{{ $unit->activeBooking->serah_terima_date ? \Carbon\Carbon::parse($unit->activeBooking->serah_terima_date)->translatedFormat('d F Y') : '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="col-lbl">Catatan Booking</td>
                                            <td class="col-sep">:</td>
                                            <td class="col-val">{{ $unit->activeBooking->notes ?: '-' }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>

                            <!-- Bagian 2: Data Sales & Mitra Agen (Digabung dalam tab yang sama) -->
                            <div class="row g-4">
                                <!-- Kolom Kiri: Tenaga Pemasaran (Sales Internal) -->
                                <div class="col-lg-6">
                                    <h6 class="fw-bold text-dark border-bottom pb-2 mb-3 d-flex align-items-center">
                                        <i class="mdi mdi-badge-account-horizontal-outline text-primary fs-5 me-2"></i>Tenaga Pemasaran (Sales)
                                    </h6>

                                    @if($unit->activeBooking && $unit->activeBooking->sales)
                                        <div class="name-avatar-wrap">
                                            <div class="name-initial" style="background: linear-gradient(135deg, #667eea, #764ba2);">
                                                {{ strtoupper(substr($unit->activeBooking->sales->name ?? 'S', 0, 2)) }}
                                            </div>
                                            <div>
                                                <div class="name-meta-title">{{ $unit->activeBooking->sales->name ?? '-' }}</div>
                                                <div class="name-meta-sub">{{ $unit->activeBooking->sales->position->name ?? 'Sales Marketing' }} &bull; {{ $unit->activeBooking->sales->division->name ?? 'Marketing' }}</div>
                                            </div>
                                        </div>

                                        <table class="table-detail-clean">
                                            <tr>
                                                <td class="col-lbl">Nama Lengkap</td>
                                                <td class="col-sep">:</td>
                                                <td class="col-val">{{ $unit->activeBooking->sales->name ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <td class="col-lbl">Jabatan / Posisi</td>
                                                <td class="col-sep">:</td>
                                                <td class="col-val">{{ $unit->activeBooking->sales->position->name ?? 'Sales Marketing' }}</td>
                                            </tr>
                                            <tr>
                                                <td class="col-lbl">Divisi Kerja</td>
                                                <td class="col-sep">:</td>
                                                <td class="col-val">{{ $unit->activeBooking->sales->division->name ?? 'Divisi Marketing' }}</td>
                                            </tr>
                                            <tr>
                                                <td class="col-lbl">Nomor Telepon / HP</td>
                                                <td class="col-sep">:</td>
                                                <td class="col-val">
                                                    @if(!empty($unit->activeBooking->sales->phone))
                                                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $unit->activeBooking->sales->phone) }}" target="_blank" class="text-decoration-none text-success fw-semibold">
                                                            <i class="mdi mdi-whatsapp me-1"></i>{{ $unit->activeBooking->sales->phone }}
                                                        </a>
                                                    @else
                                                        -
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="col-lbl">Alamat Domisili</td>
                                                <td class="col-sep">:</td>
                                                <td class="col-val">{{ $unit->activeBooking->sales->address ?? '-' }}</td>
                                            </tr>
                                        </table>
                                    @else
                                        <div class="empty-state-box py-4">
                                            <i class="mdi mdi-account-off-outline d-block mb-1" style="font-size: 2rem;"></i>
                                            <p class="text-muted small mb-0">Belum ada Sales internal yang ditautkan pada unit ini.</p>
                                        </div>
                                    @endif
                                </div>

                                <!-- Kolom Kanan: Mitra Agency & Komisi (Fee) -->
                                <div class="col-lg-6">
                                    <h6 class="fw-bold text-dark border-bottom pb-2 mb-3 d-flex align-items-center">
                                        <i class="mdi mdi-handshake-outline text-success fs-5 me-2"></i>Mitra Agency & Komisi (Fee)
                                    </h6>

                                    <table class="table-detail-clean">
                                        <tr>
                                            <td class="col-lbl">Mitra / Agency Ditugaskan</td>
                                            <td class="col-sep">:</td>
                                            <td class="col-val">
                                                {{ $unit->agency->name ?? ($unit->activeBooking->sales->name ?? '-') }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="col-lbl">Agent Fee / Komisi</td>
                                            <td class="col-sep">:</td>
                                            <td class="col-val text-success" style="font-size: 1rem; font-weight: 800;">
                                                Rp {{ number_format($unit->activeBooking->agent_fee ?? 0, 0, ',', '.') }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="col-lbl">Status Komisi Fee</td>
                                            <td class="col-sep">:</td>
                                            <td class="col-val">
                                                @if(!empty($unit->activeBooking->agent_fee) && $unit->activeBooking->agent_fee > 0)
                                                    <span class="badge py-1 px-2.5" style="background-color: #ecfdf5; color: #059669; border: 1px solid #a7f3d0; border-radius: 6px; font-size: 0.76rem; font-weight: 700;">
                                                        <i class="mdi mdi-check-circle me-1"></i>Tercatat dalam Sistem
                                                    </span>
                                                @else
                                                    <span class="badge py-1 px-2.5" style="background-color: #f1f5f9; color: #64748b; border: 1px solid #e2e8f0; border-radius: 6px; font-size: 0.76rem;">
                                                        Belum Ditetapkan
                                                    </span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="col-lbl">Penugasan Agency</td>
                                            <td class="col-sep">:</td>
                                            <td class="col-val">
                                                @if($unit->agency)
                                                    <span class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25 px-2 py-1" style="font-size: 0.75rem;">
                                                        <i class="mdi mdi-check-decagram me-0.5"></i>Agency Eksklusif Terdaftar
                                                    </span>
                                                @else
                                                    <span class="text-muted small">Reguler (Sales Internal / Terbuka)</span>
                                                @endif
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        @else
                            <!-- Empty State jika Belum Ada Booking (Murni Lihat Detail, Tanpa Tombol Tambah) -->
                            <div class="empty-state-box">
                                <i class="mdi mdi-account-group-outline d-block mb-2"></i>
                                <h5 class="fw-bold text-dark mb-1">Belum Ada Transaksi Customer & Agen</h5>
                                <p class="text-muted mb-0" style="max-width: 480px; margin: 0 auto; font-size: 0.88rem;">
                                    Unit ini berstatus <strong>{{ $statusText }}</strong> dan saat ini belum memiliki data customer yang mengikat booking maupun penugasan agen.
                                </p>
                            </div>
                        @endif
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>
@endsection
