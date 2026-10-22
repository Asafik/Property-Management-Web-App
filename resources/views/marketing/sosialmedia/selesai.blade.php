@extends('layouts.partial.app')

@section('title', 'Riwayat Tugas Selesai - Sosial Media - Property Management')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/dashboard-clean.css') }}?v={{ time() }}">
<meta name="referrer" content="no-referrer">
<style>
    /* 100% Solid Flat Colors - Sesuai Catalog Unit (Tanpa Gradient) */
    .compact-table-card {
        background: #ffffff !important;
        border: 1px solid #e2e8f0 !important;
        border-radius: 8px !important;
        box-shadow: none !important;
        overflow: hidden;
    }

    /* Table Clean (Persis Catalog Unit & Table Lahan) */
    .table-clean {
        width: 100% !important;
        margin-bottom: 0;
    }

    .table-clean thead th {
        background: #f8fafc !important;
        color: #4b5563 !important;
        font-weight: 700;
        font-size: 0.76rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border-bottom: 2px solid #e2e8f0 !important;
        padding: 0.8rem 0.75rem !important;
        vertical-align: middle;
        white-space: nowrap;
    }

    .table-clean tbody td {
        padding: 0.8rem 0.75rem !important;
        vertical-align: middle;
        font-size: 0.84rem;
        border-bottom: 1px solid #f1f5f9;
        white-space: nowrap;
    }

    /* Tombol Aksi Persis Catalog Unit (jual_unit.blade.php) */
    .action-group {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.35rem;
    }

    .btn-action {
        width: 36px;
        height: 36px;
        padding: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 6px;
        transition: all 0.2s ease;
        border: none;
        cursor: pointer;
        text-decoration: none !important;
    }

    .btn-action i {
        font-size: 1.05rem;
        line-height: 1;
    }

    .btn-action.view {
        background: #9a55ff;
        color: #ffffff !important;
    }

    .btn-action.view:hover {
        background: #8b3df5;
        color: #ffffff !important;
        transform: translateY(-1px);
    }

    /* KPI Flat Solid Metrics Cards (Persis Catalog Unit) */
    .dash-kpi-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 1rem;
        margin-bottom: 1.5rem;
    }

    .dash-kpi-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        padding: 1.15rem 1.25rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
        transition: transform 0.15s ease, border-color 0.15s ease;
    }

    .dash-kpi-card:hover {
        transform: translateY(-2px);
        border-color: #cbd5e1;
    }

    .dash-kpi-left {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .dash-kpi-icon {
        width: 44px;
        height: 44px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.35rem;
        flex-shrink: 0;
    }

    .dash-kpi-info {
        display: flex;
        flex-direction: column;
    }

    .dash-kpi-label {
        font-size: 0.76rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #64748b;
        margin-bottom: 0.2rem;
    }

    .dash-kpi-val {
        font-size: 1.55rem;
        font-weight: 800;
        color: #0f172a;
        line-height: 1.15;
    }

    .dash-kpi-sub {
        font-size: 0.74rem;
        color: #94a3b8;
        margin-top: 0.2rem;
    }
</style>
@endpush

@section('content')
<div class="container-fluid px-3 px-md-4 py-4">

    <!-- Header Bersih Solid (Catalog Unit Pattern) -->
    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 mb-4">
        <div>
            <h3 class="fw-bold text-dark mb-1" style="letter-spacing: -0.02em;">Riwayat Tugas Promosi Selesai</h3>
            <p class="text-muted mb-0" style="font-size: 0.88rem;">
                Daftar seluruh tugas konten promosi yang telah berhasil disetor dan dipublikasikan di media sosial.
            </p>
        </div>
        <div class="d-flex flex-wrap align-items-center gap-2">
            <a href="{{ route('marketing.sosialmedia.tugas') }}" class="btn text-white px-3 py-2 fw-semibold d-inline-flex align-items-center gap-2 shadow-sm" style="border-radius: 6px; background-color: #9a55ff; border: 1px solid #9a55ff; font-size: 0.85rem;">
                <i class="mdi mdi-clipboard-text-outline fs-6"></i>
                <span>Buka Tugas Aktif</span>
            </a>
        </div>
    </div>

    <!-- Alert Sukses Jika Ada Flash Message -->
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert" style="background-color: #ecfdf5; color: #065f46; border-left: 4px solid #10b981 !important;">
        <i class="mdi mdi-check-circle me-1"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <!-- KPI Metric Cards (Solid Flat - Catalog Unit Style) -->
    <div class="dash-kpi-grid">
        <!-- Card 1: Tugas Selesai (Hijau Solid) -->
        <div class="dash-kpi-card">
            <div class="dash-kpi-left">
                <div class="dash-kpi-icon" style="background-color: #ecfdf5; color: #059669;">
                    <i class="mdi mdi-checkbox-marked-circle-outline"></i>
                </div>
                <div class="dash-kpi-info">
                    <div class="dash-kpi-label">Tugas Selesai</div>
                    <div class="dash-kpi-val">{{ $totalCompletedCount }}</div>
                    <div class="dash-kpi-sub">Telah Disetor & Tayang</div>
                </div>
            </div>
        </div>

        <!-- Card 2: Total Tayangan (Biru Solid) -->
        <div class="dash-kpi-card">
            <div class="dash-kpi-left">
                <div class="dash-kpi-icon" style="background-color: #f0f9ff; color: #0284c7;">
                    <i class="mdi mdi-eye-outline"></i>
                </div>
                <div class="dash-kpi-info">
                    <div class="dash-kpi-label">Total Tayangan</div>
                    <div class="dash-kpi-val">{{ number_format($totalViews, 0, ',', '.') }}</div>
                    <div class="dash-kpi-sub">Akumulasi Views Video</div>
                </div>
            </div>
        </div>

        <!-- Card 3: Total Interaksi / Suka (Merah Solid) -->
        <div class="dash-kpi-card">
            <div class="dash-kpi-left">
                <div class="dash-kpi-icon" style="background-color: #fef2f2; color: #ef4444;">
                    <i class="mdi mdi-heart-outline"></i>
                </div>
                <div class="dash-kpi-info">
                    <div class="dash-kpi-label">Total Suka (Likes)</div>
                    <div class="dash-kpi-val">{{ number_format($totalLikes, 0, ',', '.') }}</div>
                    <div class="dash-kpi-sub">Interaksi Tayangan</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Card Container: Daftar Riwayat Selesai -->
    <div class="card compact-table-card shadow-sm border-0 mb-4">
        <div class="card-header bg-white border-bottom p-3 px-md-4 d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center gap-2">
                <div style="width: 32px; height: 32px; border-radius: 6px; background-color: #ecfdf5; color: #059669; display: inline-flex; align-items: center; justify-content: center; font-size: 1.15rem; flex-shrink: 0;">
                    <i class="mdi mdi-check-all"></i>
                </div>
                <div>
                    <span style="font-size: 0.95rem; font-weight: 700; color: #0f172a;">Daftar Tugas yang Telah Disetor</span>
                    <span class="badge bg-light text-secondary border ms-2" style="font-size: 0.75rem;">{{ $totalCompletedCount }} Konten</span>
                </div>
            </div>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle table-clean mb-0">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 45px;">No</th>
                            <th>Nama Tugas Promosi</th>
                            <th>Disetor Oleh</th>
                            <th>Platform</th>
                            <th>Waktu Disetor</th>
                            <th class="text-center">Performa Video</th>
                            <th class="text-center" style="width: 120px;">Status</th>
                            <th class="text-center" style="width: 140px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($completedTasks as $index => $ct)
                        <tr>
                            <td class="text-center fw-bold">{{ $index + 1 }}</td>
                            <td>
                                <a href="{{ route('marketing.sosialmedia.task.show', $ct->id) }}" class="fw-bold text-dark text-decoration-none" title="Lihat Detail & Deskripsi Lengkap">
                                    {{ $ct->nama_tugas }}
                                </a>
                            </td>
                            <td>
                                <span class="fw-semibold text-dark" style="font-size: 0.85rem;">{{ $ct->employee->name ?? 'Staff Marketing' }}</span>
                            </td>
                            <td>
                                <span class="badge bg-light text-danger border font-monospace px-2 py-1" style="font-size: 0.75rem;">
                                    <i class="mdi mdi-instagram me-1"></i>{{ $ct->platform ?: 'Instagram Reels' }}
                                </span>
                            </td>
                            <td>
                                <div class="fw-semibold text-dark">{{ $ct->tanggal_setor ? \Carbon\Carbon::parse($ct->tanggal_setor)->format('d M Y') : '-' }}</div>
                                <small class="text-muted">{{ $ct->tanggal_setor ? \Carbon\Carbon::parse($ct->tanggal_setor)->format('H:i') . ' WIB' : '' }}</small>
                            </td>
                            <td class="text-center">
                                <div class="d-flex align-items-center justify-content-center gap-3">
                                    <span class="fw-bold text-dark" style="font-size: 0.82rem;">
                                        <i class="mdi mdi-eye text-primary me-1"></i>{{ number_format($ct->views ?: 0, 0, ',', '.') }} View
                                    </span>
                                    <span class="fw-bold text-dark" style="font-size: 0.82rem;">
                                        <i class="mdi mdi-heart text-danger me-1"></i>{{ number_format($ct->likes ?: 0, 0, ',', '.') }} Like
                                    </span>
                                </div>
                            </td>
                            <td class="text-center">
                                <span class="badge py-1.5 px-2.5 fw-semibold" style="font-size: 0.74rem; border-radius: 6px; background-color: #ecfdf5; color: #059669; border: 1px solid #a7f3d0;">
                                    <i class="mdi mdi-check-circle me-1"></i>Sudah Selesai
                                </span>
                            </td>
                            <td class="text-center">
                                <div class="action-group">
                                    <a href="{{ route('marketing.sosialmedia.task.show', $ct->id) }}" class="btn-action view" title="Detail Tugas">
                                        <i class="mdi mdi-eye"></i>
                                    </a>
                                    <a href="{{ $ct->link_postingan }}" target="_blank" class="btn-action" style="background: #10b981; color: #ffffff;" title="Tonton Video Tayang">
                                        <i class="mdi mdi-play"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted py-5">
                                <div class="d-flex flex-column align-items-center justify-content-center">
                                    <i class="mdi mdi-clipboard-text-outline text-muted mb-2" style="font-size: 2.2rem; opacity: 0.5;"></i>
                                    <h6 class="fw-bold text-dark mb-1">Belum Ada Riwayat Tugas yang Disetor</h6>
                                    <p class="text-muted small mb-3" style="max-width: 400px;">
                                        Silakan setor link video tugas promosi Anda pada menu Tugas untuk mulai merekam riwayat publikasi.
                                    </p>
                                    <a href="{{ route('marketing.sosialmedia.tugas') }}" class="btn btn-sm text-white px-3 py-1.5 fw-semibold" style="border-radius: 6px; background-color: #9a55ff; border: 1px solid #9a55ff;">
                                        <i class="mdi mdi-upload me-1"></i>Buka Halaman Tugas
                                    </a>
                                </div>
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
