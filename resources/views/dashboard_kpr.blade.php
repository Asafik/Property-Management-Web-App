@extends('layouts.partial.app')

@section('title', 'Dashboard KPR & Transaksi Konsumen - Property Management App')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard-clean.css') }}?v={{ time() }}">
    <style>
        /* 7-Card Quick Stat Bar */
        .dash-kpr-summary-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 0.65rem;
            margin-bottom: 1.25rem;
            width: 100%;
        }
        @media (min-width: 768px) {
            .dash-kpr-summary-grid {
                grid-template-columns: repeat(4, 1fr);
            }
        }
        @media (min-width: 1200px) {
            .dash-kpr-summary-grid {
                grid-template-columns: repeat(7, 1fr);
            }
        }

        .kpr-stat-box {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            padding: 0.75rem 0.85rem;
            transition: all 0.2s ease;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.03);
        }
        .kpr-stat-box:hover {
            border-color: #cbd5e1;
            transform: translateY(-2px);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.06);
        }
        .kpr-stat-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 0.35rem;
        }
        .kpr-stat-label {
            font-size: 0.72rem;
            font-weight: 600;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.03em;
        }
        .kpr-stat-val {
            font-size: 1.3rem;
            font-weight: 800;
            color: #0f172a;
            line-height: 1.2;
        }

        /* Clean Micro Action Buttons */
        .action-pill-btn {
            font-size: 0.74rem;
            font-weight: 600;
            padding: 0.25rem 0.6rem;
            border-radius: 4px;
            display: inline-flex;
            align-items: center;
            gap: 4px;
            text-decoration: none !important;
            transition: all 0.2s ease;
        }
        .action-pill-btn.purple {
            background-color: #9a55ff;
            color: #ffffff !important;
            border: 1px solid #9a55ff;
        }
        .action-pill-btn.purple:hover {
            background-color: #8432f7;
            border-color: #8432f7;
            color: #ffffff !important;
        }
        .action-pill-btn.blue {
            background-color: #f0f9ff;
            color: #0284c7;
            border: 1px solid #bae6fd;
        }
        .action-pill-btn.blue:hover {
            background-color: #0284c7;
            color: #ffffff;
        }
        .action-pill-btn.amber {
            background-color: #fffbeb;
            color: #d97706;
            border: 1px solid #fde68a;
        }
        .action-pill-btn.amber:hover {
            background-color: #d97706;
            color: #ffffff;
        }
        .action-pill-btn.green {
            background-color: #ecfdf5;
            color: #059669;
            border: 1px solid #a7f3d0;
        }
        .action-pill-btn.green:hover {
            background-color: #059669;
            color: #ffffff;
        }
        .action-pill-btn.rose {
            background-color: #fff1f2;
            color: #e11d48;
            border: 1px solid #fecdd3;
        }
        .action-pill-btn.rose:hover {
            background-color: #e11d48;
            color: #ffffff;
        }
    </style>
@endpush

@section('content')
<div class="dash-wrapper">

    <!-- ========================================================================= -->
    <!-- 1. HEADER SECTION KPR & TRANSAKSI -->
    <!-- ========================================================================= -->
    <div class="dash-header mb-3">
        <div>
            <h1 class="dash-header-title">
                Dashboard KPR & Transaksi Konsumen
            </h1>
            <p class="dash-header-sub">
                Monitoring 5 transaksi terbaru per alur: Booking Masuk, Pengajuan KPR, Verifikasi Berkas, ACC, Ditolak, Cash Tempo, dan KPR Komersil.
            </p>
        </div>
        <div class="d-flex align-items-center gap-2">
            <a href="{{ route('customer.kpr') }}" class="btn btn-sm btn-outline-primary d-inline-flex align-items-center gap-1 shadow-sm px-3 py-1.5" style="border-radius: 4px; font-size: 0.82rem;">
                <i class="mdi mdi-home-analytics me-1"></i> Menu KPR
            </a>
            <a href="{{ route('customer.kpr.survey') }}" class="btn btn-sm btn-outline-info d-inline-flex align-items-center gap-1 shadow-sm px-3 py-1.5" style="border-radius: 4px; font-size: 0.82rem;">
                <i class="mdi mdi-clipboard-check-outline me-1"></i> Survey
            </a>
        </div>
    </div>

    <!-- ========================================================================= -->
    <!-- 2. 7 KPI SUMMARY COUNTER BOXES -->
    <!-- ========================================================================= -->
    <div class="dash-kpr-summary-grid">
        <!-- 1. Booking -->
        <div class="kpr-stat-box">
            <div class="kpr-stat-top">
                <span class="kpr-stat-label">User Booking</span>
                <i class="mdi mdi-calendar-check text-primary fs-5"></i>
            </div>
            <div class="kpr-stat-val text-primary">{{ $countBooking }}</div>
        </div>

        <!-- 2. Menu KPR -->
        <div class="kpr-stat-box">
            <div class="kpr-stat-top">
                <span class="kpr-stat-label">Masuk KPR</span>
                <i class="mdi mdi-home-analytics text-warning fs-5"></i>
            </div>
            <div class="kpr-stat-val text-warning">{{ $countKpr }}</div>
        </div>

        <!-- 3. Verifikasi -->
        <div class="kpr-stat-box">
            <div class="kpr-stat-top">
                <span class="kpr-stat-label">Verifikasi</span>
                <i class="mdi mdi-file-check-outline text-purple fs-5" style="color: #9a55ff;"></i>
            </div>
            <div class="kpr-stat-val" style="color: #9a55ff;">{{ $countVerified }}</div>
        </div>

        <!-- 4. ACC / SP3K -->
        <div class="kpr-stat-box">
            <div class="kpr-stat-top">
                <span class="kpr-stat-label">KPR ACC</span>
                <i class="mdi mdi-check-decagram text-success fs-5"></i>
            </div>
            <div class="kpr-stat-val text-success">{{ $countAcc }}</div>
        </div>

        <!-- 5. Reject -->
        <div class="kpr-stat-box">
            <div class="kpr-stat-top">
                <span class="kpr-stat-label">Reject</span>
                <i class="mdi mdi-close-octagon-outline text-danger fs-5"></i>
            </div>
            <div class="kpr-stat-val text-danger">{{ $countRejected }}</div>
        </div>

        <!-- 6. User Tempo -->
        <div class="kpr-stat-box">
            <div class="kpr-stat-top">
                <span class="kpr-stat-label">User Tempo</span>
                <i class="mdi mdi-clock-fast text-info fs-5"></i>
            </div>
            <div class="kpr-stat-val text-info">{{ $countTempo }}</div>
        </div>

        <!-- 7. Komersil -->
        <div class="kpr-stat-box">
            <div class="kpr-stat-top">
                <span class="kpr-stat-label">Komersil</span>
                <i class="mdi mdi-domain text-secondary fs-5"></i>
            </div>
            <div class="kpr-stat-val text-secondary">{{ $countKomersil }}</div>
        </div>
    </div>

    <!-- ========================================================================= -->
    <!-- 3. PANEL 1: 5 TERBARU YANG MASUK DI USER BOOKING -->
    <!-- ========================================================================= -->
    <div class="dash-panel mb-4">
        <div class="dash-panel-header">
            <div class="dash-panel-title-wrap">
                <div class="dash-panel-icon blue">
                    <i class="mdi mdi-bookmark-check-outline"></i>
                </div>
                <div>
                    <h3 class="dash-panel-title">5 Terbaru Masuk di User Booking</h3>
                    <p class="dash-panel-subtitle">Daftar transaksi pemesanan unit kavling konsumen yang baru masuk</p>
                </div>
            </div>
        </div>

        <div class="dash-panel-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" style="font-size: 0.85rem;">
                    <thead>
                        <tr style="background: linear-gradient(135deg, #f8f9fa, #f1f3f5); border-bottom: 2px solid #e9ecef;">
                            <th class="py-2.5 px-3 text-center" style="width: 50px; color: #9a55ff; font-weight: 700; font-size: 0.78rem; text-transform: uppercase;">NO</th>
                            <th class="py-2.5" style="color: #9a55ff; font-weight: 700; font-size: 0.78rem; text-transform: uppercase;">NASABAH & KONTAK</th>
                            <th class="py-2.5" style="color: #9a55ff; font-weight: 700; font-size: 0.78rem; text-transform: uppercase;">UNIT KAVLING</th>
                            <th class="py-2.5" style="color: #9a55ff; font-weight: 700; font-size: 0.78rem; text-transform: uppercase;">SKEMA BAYAR</th>
                            <th class="py-2.5 text-end" style="color: #9a55ff; font-weight: 700; font-size: 0.78rem; text-transform: uppercase;">TOTAL HARGA</th>
                            <th class="py-2.5 text-center" style="color: #9a55ff; font-weight: 700; font-size: 0.78rem; text-transform: uppercase;">TANGGAL</th>
                            <th class="py-2.5 text-center" style="color: #9a55ff; font-weight: 700; font-size: 0.78rem; text-transform: uppercase; width: 100px;">STATUS</th>
                            <th class="py-2.5 text-center" style="color: #9a55ff; font-weight: 700; font-size: 0.78rem; text-transform: uppercase; width: 90px;">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentBookings as $bIdx => $b)
                            <tr>
                                <td class="px-3 text-center text-muted fw-bold">{{ $bIdx + 1 }}</td>
                                <td>
                                    <div class="fw-bold text-dark">{{ $b->customer->full_name ?? 'Nasabah' }}</div>
                                    <small class="text-muted font-monospace" style="font-size: 0.72rem;">{{ $b->customer->phone ?? '-' }}</small>
                                </td>
                                <td>
                                    <span class="fw-semibold text-dark d-block">
                                        <span class="badge bg-light text-dark border px-1.5 py-0.5 me-1 font-monospace" style="font-size: 0.7rem;">
                                            {{ $b->unit->unit_code ?? ($b->unit->block . '.' . $b->unit->unit_number ?? '-') }}
                                        </span>
                                        {{ $b->unit->unit_name ?? 'Kavling' }}
                                    </span>
                                    <small class="text-muted" style="font-size: 0.72rem;">{{ $b->unit->landBank->name ?? '-' }}</small>
                                </td>
                                <td>
                                    <span class="badge py-1 px-2 text-uppercase" style="font-size: 0.72rem; border-radius: 4px; background: #e0f2fe; color: #0369a1;">
                                        {{ $b->purchase_type ?: 'KPR' }}
                                    </span>
                                </td>
                                <td class="text-end">
                                    <span class="fw-bold text-dark font-monospace">Rp {{ number_format($b->total_price ?: ($b->unit->price ?? 0), 0, ',', '.') }}</span>
                                </td>
                                <td class="text-center">
                                    <small class="text-muted">{{ $b->created_at ? $b->created_at->format('d M Y') : '-' }}</small>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-primary text-white py-1 px-2" style="font-size: 0.7rem; border-radius: 4px;">
                                        {{ ucfirst($b->status ?: 'Booking') }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('transaksi.kpr.approve', $b->id) }}" class="action-pill-btn blue" title="Buka Detail Booking">
                                        <i class="mdi mdi-eye"></i> Detail
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-4 text-muted">
                                    <i class="mdi mdi-bookmark-outline fs-3 d-block mb-1 opacity-50"></i>
                                    Belum ada data user booking yang masuk.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- ========================================================================= -->
    <!-- 4. PANEL 2: 5 YANG MASUK KE MENU KPR -->
    <!-- ========================================================================= -->
    <div class="dash-panel mb-4">
        <div class="dash-panel-header">
            <div class="dash-panel-title-wrap">
                <div class="dash-panel-icon amber">
                    <i class="mdi mdi-home-analytics"></i>
                </div>
                <div>
                    <h3 class="dash-panel-title">5 Pengajuan Masuk ke Menu KPR</h3>
                    <p class="dash-panel-subtitle">Nasabah dengan pilihan metode bayar KPR yang masuk ke menu transaksi KPR</p>
                </div>
            </div>
            <a href="{{ route('customer.kpr') }}" class="small text-primary fw-bold text-decoration-none d-inline-flex align-items-center">
                Lihat Semua KPR <i class="mdi mdi-chevron-right"></i>
            </a>
        </div>

        <div class="dash-panel-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" style="font-size: 0.85rem;">
                    <thead>
                        <tr style="background: linear-gradient(135deg, #f8f9fa, #f1f3f5); border-bottom: 2px solid #e9ecef;">
                            <th class="py-2.5 px-3 text-center" style="width: 50px; color: #9a55ff; font-weight: 700; font-size: 0.78rem; text-transform: uppercase;">NO</th>
                            <th class="py-2.5" style="color: #9a55ff; font-weight: 700; font-size: 0.78rem; text-transform: uppercase;">NASABAH & KONTAK</th>
                            <th class="py-2.5" style="color: #9a55ff; font-weight: 700; font-size: 0.78rem; text-transform: uppercase;">UNIT KAVLING</th>
                            <th class="py-2.5" style="color: #9a55ff; font-weight: 700; font-size: 0.78rem; text-transform: uppercase;">BANK PENGAJUAN</th>
                            <th class="py-2.5 text-end" style="color: #9a55ff; font-weight: 700; font-size: 0.78rem; text-transform: uppercase;">PLAFON PENGAJUAN</th>
                            <th class="py-2.5 text-center" style="color: #9a55ff; font-weight: 700; font-size: 0.78rem; text-transform: uppercase; width: 110px;">STATUS KPR</th>
                            <th class="py-2.5 text-center" style="color: #9a55ff; font-weight: 700; font-size: 0.78rem; text-transform: uppercase; width: 90px;">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentKprMenu as $kIdx => $k)
                            <tr>
                                <td class="px-3 text-center text-muted fw-bold">{{ $kIdx + 1 }}</td>
                                <td>
                                    <div class="fw-bold text-dark">{{ $k->customer->full_name ?? 'Nasabah' }}</div>
                                    <small class="text-muted font-monospace" style="font-size: 0.72rem;">{{ $k->customer->phone ?? '-' }}</small>
                                </td>
                                <td>
                                    <span class="fw-semibold text-dark d-block">
                                        <span class="badge bg-light text-dark border px-1.5 py-0.5 me-1 font-monospace" style="font-size: 0.7rem;">
                                            {{ $k->unit->unit_code ?? ($k->unit->block . '.' . $k->unit->unit_number ?? '-') }}
                                        </span>
                                        {{ $k->unit->unit_name ?? 'Kavling' }}
                                    </span>
                                    <small class="text-muted" style="font-size: 0.72rem;">{{ $k->unit->landBank->name ?? '-' }}</small>
                                </td>
                                <td>
                                    <span class="fw-semibold text-dark d-block">
                                        <i class="mdi mdi-bank me-1 text-primary"></i>{{ $k->kprApplication->bank->bank_name ?? 'Bank Belum Dipilih' }}
                                    </span>
                                </td>
                                <td class="text-end">
                                    <span class="fw-bold text-dark font-monospace">
                                        Rp {{ number_format($k->nominal_pembiayaan ?: ($k->kprApplication->jumlah_pinjaman ?? ($k->total_price - $k->dp_amount)), 0, ',', '.') }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-warning text-dark py-1 px-2" style="font-size: 0.7rem; border-radius: 4px;">
                                        {{ ucfirst($k->kprApplication->status ?? 'Pengajuan KPR') }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('transaksi.kpr.approve', $k->id) }}" class="action-pill-btn purple" title="Proses Menu KPR">
                                        <i class="mdi mdi-pencil-outline"></i> Proses
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4 text-muted">
                                    <i class="mdi mdi-home-analytics fs-3 d-block mb-1 opacity-50"></i>
                                    Belum ada data pengajuan KPR yang masuk.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- ========================================================================= -->
    <!-- 5. SECTION 2 KOLOM: VERIFIKASI & ACC -->
    <!-- ========================================================================= -->
    <div class="dash-row-grid mb-4">

        <!-- Kolom Kiri: 5 Masuk ke User Verifikasi -->
        <div class="dash-panel">
            <div class="dash-panel-header">
                <div class="dash-panel-title-wrap">
                    <div class="dash-panel-icon purple">
                        <i class="mdi mdi-file-check-outline"></i>
                    </div>
                    <div>
                        <h3 class="dash-panel-title">5 Masuk ke Verifikasi Berkas</h3>
                        <p class="dash-panel-subtitle">Nasabah dalam tahap verifikasi kelayakan dokumen</p>
                    </div>
                </div>
                <a href="{{ route('kpr.customer-verified') }}" class="small text-primary fw-bold text-decoration-none d-inline-flex align-items-center">
                    Semua Verifikasi <i class="mdi mdi-chevron-right"></i>
                </a>
            </div>

            <div class="dash-panel-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0" style="font-size: 0.83rem;">
                        <thead>
                            <tr style="background: linear-gradient(135deg, #f8f9fa, #f1f3f5); border-bottom: 2px solid #e9ecef;">
                                <th class="py-2.5 px-3" style="color: #9a55ff; font-weight: 700; font-size: 0.78rem; text-transform: uppercase;">DEBITUR & KONTAK</th>
                                <th class="py-2.5" style="color: #9a55ff; font-weight: 700; font-size: 0.78rem; text-transform: uppercase;">UNIT</th>
                                <th class="py-2.5 text-center" style="color: #9a55ff; font-weight: 700; font-size: 0.78rem; text-transform: uppercase; width: 90px;">STATUS</th>
                                <th class="py-2.5 text-center" style="color: #9a55ff; font-weight: 700; font-size: 0.78rem; text-transform: uppercase; width: 80px;">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentVerified as $v)
                                <tr>
                                    <td class="px-3">
                                        <div class="fw-bold text-dark">{{ $v->customer->full_name ?? 'Nasabah' }}</div>
                                        <small class="text-muted font-monospace">{{ $v->customer->phone ?? '-' }}</small>
                                    </td>
                                    <td>
                                        <span class="text-dark fw-semibold d-block">{{ $v->unit->unit_name ?? ($v->unit->unit_code ?? 'Kavling') }}</span>
                                        <small class="text-muted">{{ $v->unit->landBank->name ?? '-' }}</small>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-info text-white py-1 px-2" style="font-size: 0.7rem; border-radius: 4px;">
                                            {{ ucfirst($v->status ?: 'Verifikasi') }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('transaksi.kpr.approve', $v->booking_id ?: $v->id) }}" class="action-pill-btn purple" title="Periksa Berkas">
                                            <i class="mdi mdi-check"></i> Cek
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-4 text-muted">
                                        <i class="mdi mdi-file-document-outline fs-3 d-block mb-1 opacity-50"></i>
                                        Belum ada data masuk verifikasi.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Kolom Kanan: 5 yang ACC (Approved) -->
        <div class="dash-panel">
            <div class="dash-panel-header">
                <div class="dash-panel-title-wrap">
                    <div class="dash-panel-icon emerald">
                        <i class="mdi mdi-check-decagram-outline"></i>
                    </div>
                    <div>
                        <h3 class="dash-panel-title">5 KPR yang ACC (Disetujui)</h3>
                        <p class="dash-panel-subtitle">Nasabah dengan persetujuan KPR / SP3K bank resmi</p>
                    </div>
                </div>
                <span class="badge px-2.5 py-1" style="background: rgba(16, 185, 129, 0.12); color: #059669; font-size: 0.74rem; font-weight: 700; border-radius: 4px;">
                    ACC Bank
                </span>
            </div>

            <div class="dash-panel-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0" style="font-size: 0.83rem;">
                        <thead>
                            <tr style="background: linear-gradient(135deg, #f8f9fa, #f1f3f5); border-bottom: 2px solid #e9ecef;">
                                <th class="py-2.5 px-3" style="color: #9a55ff; font-weight: 700; font-size: 0.78rem; text-transform: uppercase;">DEBITUR & BANK</th>
                                <th class="py-2.5" style="color: #9a55ff; font-weight: 700; font-size: 0.78rem; text-transform: uppercase;">NO SP3K</th>
                                <th class="py-2.5 text-end" style="color: #9a55ff; font-weight: 700; font-size: 0.78rem; text-transform: uppercase;">PLAFON ACC</th>
                                <th class="py-2.5 text-center" style="color: #9a55ff; font-weight: 700; font-size: 0.78rem; text-transform: uppercase; width: 80px;">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentAcc as $acc)
                                <tr>
                                    <td class="px-3">
                                        <div class="fw-bold text-dark">{{ $acc->customer->full_name ?? 'Nasabah' }}</div>
                                        <small class="text-muted"><i class="mdi mdi-bank me-0.5"></i>{{ $acc->bank->bank_name ?? 'Bank' }}</small>
                                    </td>
                                    <td>
                                        <span class="fw-semibold text-dark font-monospace d-block" style="font-size: 0.78rem;">
                                            {{ $acc->no_sp3k ?: 'SP3K Terbit' }}
                                        </span>
                                    </td>
                                    <td class="text-end">
                                        <span class="fw-bold text-success font-monospace">Rp {{ number_format($acc->jumlah_pinjaman ?? 0, 0, ',', '.') }}</span>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('transaksi.kpr.approve', $acc->booking_id ?: $acc->id) }}" class="action-pill-btn green" title="Buka Detail ACC">
                                            <i class="mdi mdi-eye"></i> Detail
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-4 text-muted">
                                        <i class="mdi mdi-check-circle-outline fs-3 d-block mb-1 opacity-50"></i>
                                        Belum ada data KPR yang ACC.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

    <!-- ========================================================================= -->
    <!-- 6. SECTION 2 KOLOM: REJECT & KOMERSIL -->
    <!-- ========================================================================= -->
    <div class="dash-row-grid mb-4">

        <!-- Kolom Kiri: 5 yang Reject -->
        <div class="dash-panel">
            <div class="dash-panel-header">
                <div class="dash-panel-title-wrap">
                    <div class="dash-panel-icon rose">
                        <i class="mdi mdi-close-octagon"></i>
                    </div>
                    <div>
                        <h3 class="dash-panel-title">5 KPR yang Reject (Ditolak)</h3>
                        <p class="dash-panel-subtitle">Nasabah dengan riwayat pengajuan ditolak bank</p>
                    </div>
                </div>
                <a href="{{ route('customer.kpr.rijected') }}" class="small text-danger fw-bold text-decoration-none d-inline-flex align-items-center">
                    Semua Reject <i class="mdi mdi-chevron-right"></i>
                </a>
            </div>

            <div class="dash-panel-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0" style="font-size: 0.83rem;">
                        <thead>
                            <tr style="background: linear-gradient(135deg, #f8f9fa, #f1f3f5); border-bottom: 2px solid #e9ecef;">
                                <th class="py-2.5 px-3" style="color: #9a55ff; font-weight: 700; font-size: 0.78rem; text-transform: uppercase;">DEBITUR & UNIT</th>
                                <th class="py-2.5" style="color: #9a55ff; font-weight: 700; font-size: 0.78rem; text-transform: uppercase;">CATATAN / ALASAN</th>
                                <th class="py-2.5 text-center" style="color: #9a55ff; font-weight: 700; font-size: 0.78rem; text-transform: uppercase; width: 90px;">STATUS</th>
                                <th class="py-2.5 text-center" style="color: #9a55ff; font-weight: 700; font-size: 0.78rem; text-transform: uppercase; width: 80px;">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentRejected as $rej)
                                <tr>
                                    <td class="px-3">
                                        <div class="fw-bold text-dark">{{ $rej->customer->full_name ?? 'Nasabah' }}</div>
                                        <small class="text-muted">{{ $rej->unit->unit_name ?? ($rej->unit->unit_code ?? '-') }}</small>
                                    </td>
                                    <td>
                                        <span class="text-muted d-block small">{{ Str::limit($rej->catatan ?: 'Ditolak saat analisa bank', 28) }}</span>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-danger text-white py-1 px-2" style="font-size: 0.7rem; border-radius: 4px;">Rejected</span>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('transaksi.kpr.approve', $rej->booking_id ?: $rej->id) }}" class="action-pill-btn rose" title="Lihat Catatan">
                                            <i class="mdi mdi-eye"></i> Detail
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-4 text-muted">
                                        <i class="mdi mdi-shield-check-outline fs-3 d-block mb-1 opacity-50"></i>
                                        Tidak ada pengajuan KPR yang ditolak.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Kolom Kanan: 5 User Komersil -->
        <div class="dash-panel">
            <div class="dash-panel-header">
                <div class="dash-panel-title-wrap">
                    <div class="dash-panel-icon blue">
                        <i class="mdi mdi-domain"></i>
                    </div>
                    <div>
                        <h3 class="dash-panel-title">5 User KPR Komersil</h3>
                        <p class="dash-panel-subtitle">Nasabah pengajuan unit kavling tipe komersil (Non-Subsidi)</p>
                    </div>
                </div>
                <a href="{{ route('analisa.kpr.komersil') }}" class="small text-primary fw-bold text-decoration-none d-inline-flex align-items-center">
                    Analisa Komersil <i class="mdi mdi-chevron-right"></i>
                </a>
            </div>

            <div class="dash-panel-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0" style="font-size: 0.83rem;">
                        <thead>
                            <tr style="background: linear-gradient(135deg, #f8f9fa, #f1f3f5); border-bottom: 2px solid #e9ecef;">
                                <th class="py-2.5 px-3" style="color: #9a55ff; font-weight: 700; font-size: 0.78rem; text-transform: uppercase;">DEBITUR</th>
                                <th class="py-2.5" style="color: #9a55ff; font-weight: 700; font-size: 0.78rem; text-transform: uppercase;">UNIT KOMERSIL</th>
                                <th class="py-2.5 text-end" style="color: #9a55ff; font-weight: 700; font-size: 0.78rem; text-transform: uppercase;">HARGA / PLAFON</th>
                                <th class="py-2.5 text-center" style="color: #9a55ff; font-weight: 700; font-size: 0.78rem; text-transform: uppercase; width: 80px;">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentKomersil as $kom)
                                <tr>
                                    <td class="px-3">
                                        <div class="fw-bold text-dark">{{ $kom->customer->full_name ?? 'Nasabah' }}</div>
                                        <small class="text-muted font-monospace">{{ $kom->customer->phone ?? '-' }}</small>
                                    </td>
                                    <td>
                                        <span class="text-dark fw-semibold d-block">{{ $kom->unit->unit_name ?? ($kom->unit->unit_code ?? 'Komersil') }}</span>
                                        <span class="badge bg-light text-dark border px-1.5 py-0.5" style="font-size: 0.68rem;">Komersil</span>
                                    </td>
                                    <td class="text-end">
                                        <span class="fw-bold text-dark font-monospace">Rp {{ number_format($kom->jumlah_pinjaman ?: ($kom->total_price ?: ($kom->unit->price ?? 0)), 0, ',', '.') }}</span>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('transaksi.kpr.approve', $kom->booking_id ?: $kom->id) }}" class="action-pill-btn blue" title="Analisa Komersil">
                                            <i class="mdi mdi-chart-line"></i> Analisa
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-4 text-muted">
                                        <i class="mdi mdi-domain fs-3 d-block mb-1 opacity-50"></i>
                                        Belum ada data KPR unit komersil.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

    <!-- ========================================================================= -->
    <!-- 7. PANEL 5: 5 USER TEMPO (CASH TEMPO) -->
    <!-- ========================================================================= -->
    <div class="dash-panel mb-4">
        <div class="dash-panel-header">
            <div class="dash-panel-title-wrap">
                <div class="dash-panel-icon amber">
                    <i class="mdi mdi-clock-outline"></i>
                </div>
                <div>
                    <h3 class="dash-panel-title">5 User Tempo (Cash Bertahap)</h3>
                    <p class="dash-panel-subtitle">Monitoring nasabah dengan skema cicilan pembayaran tempo langsung ke developer</p>
                </div>
            </div>
        </div>

        <div class="dash-panel-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" style="font-size: 0.85rem;">
                    <thead>
                        <tr style="background: linear-gradient(135deg, #f8f9fa, #f1f3f5); border-bottom: 2px solid #e9ecef;">
                            <th class="py-2.5 px-3 text-center" style="width: 50px; color: #9a55ff; font-weight: 700; font-size: 0.78rem; text-transform: uppercase;">NO</th>
                            <th class="py-2.5" style="color: #9a55ff; font-weight: 700; font-size: 0.78rem; text-transform: uppercase;">NASABAH & KONTAK</th>
                            <th class="py-2.5" style="color: #9a55ff; font-weight: 700; font-size: 0.78rem; text-transform: uppercase;">UNIT KAVLING</th>
                            <th class="py-2.5 text-center" style="color: #9a55ff; font-weight: 700; font-size: 0.78rem; text-transform: uppercase;">TENOR</th>
                            <th class="py-2.5 text-end" style="color: #9a55ff; font-weight: 700; font-size: 0.78rem; text-transform: uppercase;">TOTAL NILAI TEMPO</th>
                            <th class="py-2.5 text-center" style="color: #9a55ff; font-weight: 700; font-size: 0.78rem; text-transform: uppercase; width: 100px;">STATUS</th>
                            <th class="py-2.5 text-center" style="color: #9a55ff; font-weight: 700; font-size: 0.78rem; text-transform: uppercase; width: 90px;">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentTempo as $tIdx => $t)
                            @php
                                $cName = $t->booking->customer->full_name ?? ($t->customer->full_name ?? 'Nasabah');
                                $cPhone = $t->booking->customer->phone ?? ($t->customer->phone ?? '-');
                                $uName = $t->booking->unit->unit_name ?? ($t->unit->unit_name ?? 'Kavling');
                                $uCode = $t->booking->unit->unit_code ?? ($t->unit->unit_code ?? '-');
                                $tenor = $t->tenor_bulan ? $t->tenor_bulan . ' Bulan' : ($t->tenor ? $t->tenor . ' Bln' : '-');
                                $nominal = $t->total_harga ?: ($t->total_price ?: ($t->booking->total_price ?? 0));
                            @endphp
                            <tr>
                                <td class="px-3 text-center text-muted fw-bold">{{ $tIdx + 1 }}</td>
                                <td>
                                    <div class="fw-bold text-dark">{{ $cName }}</div>
                                    <small class="text-muted font-monospace" style="font-size: 0.72rem;">{{ $cPhone }}</small>
                                </td>
                                <td>
                                    <span class="fw-semibold text-dark d-block">
                                        <span class="badge bg-light text-dark border px-1.5 py-0.5 me-1 font-monospace" style="font-size: 0.7rem;">
                                            {{ $uCode }}
                                        </span>
                                        {{ $uName }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-light text-dark border px-2 py-0.5" style="font-size: 0.72rem;">
                                        {{ $tenor }}
                                    </span>
                                </td>
                                <td class="text-end">
                                    <span class="fw-bold text-dark font-monospace">Rp {{ number_format($nominal, 0, ',', '.') }}</span>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-info text-white py-1 px-2" style="font-size: 0.7rem; border-radius: 4px;">
                                        {{ ucfirst($t->status ?: 'Tempo') }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('transaksi.kpr.approve', $t->booking_id ?: ($t->id ?? 1)) }}" class="action-pill-btn blue" title="Detail Tempo">
                                        <i class="mdi mdi-eye"></i> Detail
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4 text-muted">
                                    <i class="mdi mdi-clock-outline fs-3 d-block mb-1 opacity-50"></i>
                                    Belum ada transaksi user tempo yang tercatat.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection
