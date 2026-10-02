@extends('layouts.partial.app')

@section('title', $isKepalaMarketing ? 'Dashboard Kepala Marketing - Property Management' : 'Dashboard Staff Marketing - Property Management')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard-clean.css') }}?v={{ time() }}">
@endpush

@section('content')
<div class="dash-wrapper">

    <!-- ========================================================================= -->
    <!-- 1. HEADER SECTION (PERSIS DASHBOARD ADMIN) -->
    <!-- ========================================================================= -->
    <div class="dash-header mb-4">
        <!-- Kiri: Greeting Title & Subtitle -->
        <div>
            <h1 class="dash-header-title">
                Selamat datang, {{ auth()->user()->name ?? 'Staff Marketing' }}
            </h1>
            <p class="dash-header-sub">
                {{ $isKepalaMarketing 
                    ? 'Berikut ringkasan performa penjualan, pipeline booking, dan monitoring tim marketing.' 
                    : 'Berikut ringkasan tugas video promosi sosial media dan ketersediaan unit proyek.' }}
            </p>
        </div>

        <!-- Kanan: Tanggal Hari Ini & Sapaan -->
        <div class="dash-header-date-box">
            <div class="dash-header-date-icon">
                <i class="mdi mdi-calendar-month-outline"></i>
            </div>
            <div>
                <div class="dash-header-date-text">
                    {{ \Carbon\Carbon::now()->locale('id')->translatedFormat('l, d F Y') }}
                </div>
                <div class="dash-header-date-sub">
                    Selamat bekerja, {{ auth()->user()->name ?? 'Staff Marketing' }}!
                </div>
            </div>
        </div>
    </div>

    <!-- ========================================================================= -->
    <!-- METRIC STATS CARDS (PERSIS DASHBOARD ADMIN) -->
    <!-- ========================================================================= -->
    @if($isKepalaMarketing)
        <!-- STATS KEPALA MARKETING (EXECUTIVE OVERVIEW - 4 METRIC CARDS) -->
        <div class="dash-kpi-grid mb-4">
            <!-- Card 1: Unit Tersedia di Katalog -->
            <div class="dash-kpi-card">
                <div class="dash-kpi-left">
                    <div class="dash-kpi-icon green">
                        <i class="mdi mdi-home-circle"></i>
                    </div>
                    <div class="dash-kpi-info">
                        <div class="dash-kpi-label">Unit Tersedia (Ready)</div>
                        <div class="dash-kpi-val">{{ $readyUnits }} <span style="font-size: 0.75rem; font-weight: normal; color: #64748b;">/ {{ $totalUnits }} Unit</span></div>
                        <div class="dash-kpi-sub">Komersil: {{ $readyKomersil }} | Subsidi: {{ $readySubsidi }}</div>
                    </div>
                </div>
                <a href="{{ route('marketing.jual-unit') }}" class="dash-kpi-action green" title="Buka Catalog Unit">
                    <i class="mdi mdi-arrow-right"></i>
                </a>
            </div>

            <!-- Card 2: Pengajuan Booking dari Catalog Unit -->
            <div class="dash-kpi-card">
                <div class="dash-kpi-left">
                    <div class="dash-kpi-icon blue">
                        <i class="mdi mdi-bookmark-check"></i>
                    </div>
                    <div class="dash-kpi-info">
                        <div class="dash-kpi-label">Pengajuan Booking Catalog</div>
                        <div class="dash-kpi-val">{{ $activeBookings }} <span style="font-size: 0.75rem; font-weight: normal; color: #64748b;">Transaksi</span></div>
                        <div class="dash-kpi-sub">KPR: {{ $kprBookings }} | Cash: {{ $cashBookings }} (Total: {{ $totalBookings }})</div>
                    </div>
                </div>
                <a href="{{ route('marketing.list_pengajuan') }}" class="dash-kpi-action blue" title="Daftar Pengajuan Booking">
                    <i class="mdi mdi-arrow-right"></i>
                </a>
            </div>

            <!-- Card 3: Unit Terjual (Closing) -->
            <div class="dash-kpi-card">
                <div class="dash-kpi-left">
                    <div class="dash-kpi-icon purple">
                        <i class="mdi mdi-cash-check"></i>
                    </div>
                    <div class="dash-kpi-info">
                        <div class="dash-kpi-label">Unit Terjual (Closing)</div>
                        <div class="dash-kpi-val">{{ $soldUnits }} <span style="font-size: 0.75rem; font-weight: normal; color: #64748b;">Unit Terjual</span></div>
                        <div class="dash-kpi-sub">Fee Booking: Rp {{ number_format($totalBookingFee, 0, ',', '.') }}</div>
                    </div>
                </div>
                <a href="{{ route('marketing.list_pengajuan') }}" class="dash-kpi-action purple" title="Lihat Transaksi Closing">
                    <i class="mdi mdi-arrow-right"></i>
                </a>
            </div>

            <!-- Card 4: Total Tayangan Sosmed Staf Marketing -->
            <div class="dash-kpi-card">
                <div class="dash-kpi-left">
                    <div class="dash-kpi-icon rose">
                        <i class="mdi mdi-eye-outline"></i>
                    </div>
                    <div class="dash-kpi-info">
                        <div class="dash-kpi-label">Total Tayangan Sosmed</div>
                        <div class="dash-kpi-val" style="font-size: 1.15rem; color: #e11d48;">
                            {{ number_format($totalMarketingViews, 0, ',', '.') }} <span style="font-size: 0.75rem; font-weight: normal; color: #64748b;">Views</span>
                        </div>
                        <div class="dash-kpi-sub">{{ $completedTasks }} Video Tayang | {{ number_format($totalMarketingLikes, 0, ',', '.') }} Suka</div>
                    </div>
                </div>
                <a href="{{ route('marketing.sosialmedia.selesai') }}" class="dash-kpi-action rose" title="Video Promosi Selesai">
                    <i class="mdi mdi-arrow-right"></i>
                </a>
            </div>
        </div>
    @else
        <!-- STATS STAFF MARKETING (TUGAS PROMOSI & SOSIAL MEDIA) -->
        <div class="dash-kpi-grid mb-4">
            <!-- Card 1: Tugas Perlu Dikerjakan -->
            <div class="dash-kpi-card">
                <div class="dash-kpi-left">
                    <div class="dash-kpi-icon amber">
                        <i class="mdi mdi-clipboard-clock-outline"></i>
                    </div>
                    <div class="dash-kpi-info">
                        <div class="dash-kpi-label">Tugas Perlu Dikerjakan</div>
                        <div class="dash-kpi-val" style="color: #d97706;">{{ $myPendingTasks }} <span style="font-size: 0.75rem; font-weight: normal; color: #64748b;">Tugas</span></div>
                        <div class="dash-kpi-sub">Total tugas: {{ $myTotalTasks }}</div>
                    </div>
                </div>
                <a href="{{ route('marketing.sosialmedia.tugas') }}" class="dash-kpi-action amber" title="Lihat Tugas">
                    <i class="mdi mdi-arrow-right"></i>
                </a>
            </div>

            <!-- Card 2: Video Disetor -->
            <div class="dash-kpi-card">
                <div class="dash-kpi-left">
                    <div class="dash-kpi-icon green">
                        <i class="mdi mdi-check-decagram-outline"></i>
                    </div>
                    <div class="dash-kpi-info">
                        <div class="dash-kpi-label">Video Berhasil Disetor</div>
                        <div class="dash-kpi-val" style="color: #16a34a;">{{ $myCompletedTasksCount }} <span style="font-size: 0.75rem; font-weight: normal; color: #64748b;">Konten</span></div>
                        <div class="dash-kpi-sub">Status tayang & terverifikasi</div>
                    </div>
                </div>
                <a href="{{ route('marketing.sosialmedia.selesai') }}" class="dash-kpi-action green" title="Lihat Video Selesai">
                    <i class="mdi mdi-arrow-right"></i>
                </a>
            </div>

            <!-- Card 3: Total Tayangan (Views) Video Saya -->
            <div class="dash-kpi-card">
                <div class="dash-kpi-left">
                    <div class="dash-kpi-icon blue">
                        <i class="mdi mdi-eye-outline"></i>
                    </div>
                    <div class="dash-kpi-info">
                        <div class="dash-kpi-label">Total Tayangan (Views)</div>
                        <div class="dash-kpi-val" style="color: #0284c7;">{{ number_format($myTotalViews, 0, ',', '.') }}</div>
                        <div class="dash-kpi-sub">Akumulasi views video</div>
                    </div>
                </div>
                <div class="dash-kpi-action blue">
                    <i class="mdi mdi-arrow-right"></i>
                </div>
            </div>

            <!-- Card 4: Total Suka (Likes) Video Saya -->
            <div class="dash-kpi-card">
                <div class="dash-kpi-left">
                    <div class="dash-kpi-icon rose">
                        <i class="mdi mdi-heart-outline"></i>
                    </div>
                    <div class="dash-kpi-info">
                        <div class="dash-kpi-label">Total Suka (Likes)</div>
                        <div class="dash-kpi-val" style="color: #e11d48;">{{ number_format($myTotalLikes, 0, ',', '.') }}</div>
                        <div class="dash-kpi-sub">Interaksi suka tayangan</div>
                    </div>
                </div>
                <div class="dash-kpi-action rose">
                    <i class="mdi mdi-arrow-right"></i>
                </div>
            </div>
        </div>
    @endif



    <!-- ========================================================================= -->
    <!-- SECTION 2: MONITORING PEKERJAAN STAF & TOP VIEWS SOSMED -->
    <!-- ========================================================================= -->
    <div class="row g-3 mb-4">
        @if($isKepalaMarketing)
            <!-- MONITORING PEKERJAAN STAF MARKETING (FOR KEPALA MARKETING) -->
            <div class="col-12 col-lg-7">
                <div class="dash-panel h-100 d-flex flex-column">
                    <div class="dash-panel-header">
                        <div class="dash-panel-title-wrap">
                            <div class="dash-panel-icon" style="background-color: #f3e8ff; color: #9333ea;">
                                <i class="mdi mdi-clipboard-check-outline"></i>
                            </div>
                            <div>
                                <div class="d-flex align-items-center gap-2">
                                    <h2 class="dash-panel-title">Tugas yang Diberikan Kepala Marketing</h2>
                                    <span class="badge" style="background: #dcfce7; color: #16a34a; font-size: 0.72rem; font-weight: 700;">{{ $completedTasks ?? 0 }}/{{ $totalTasks ?? 0 }} Selesai</span>
                                </div>
                                <p class="dash-panel-subtitle">5 tugas terkini dan staf yang telah menyelesaikan pengerjaannya</p>
                            </div>
                        </div>
                        @if(Route::has('master.data.tugas-staff-marketing'))
                            <a href="{{ route('master.data.tugas-staff-marketing') }}" class="dash-link-all">
                                Kelola Semua Tugas <i class="mdi mdi-arrow-right"></i>
                            </a>
                        @endif
                    </div>

                    <!-- TABEL TUGAS DARI KEPALA MARKETING (MAKS 5, PERSIS DASHBOARD ADMIN) -->
                    <div class="dash-table-wrap">
                        <table class="dash-table">
                            <thead>
                                <tr>
                                    <th style="width: 28px; text-align: center;">No</th>
                                    <th>Nama Tugas</th>
                                    <th>Staf Penyelesai</th>
                                    <th style="text-align: center;">Capaian Tayangan</th>
                                    <th style="text-align: center;">Status</th>
                                    <th style="width: 32px; text-align: center;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($allMarketingTasks as $idx => $task)
                                    <tr>
                                        <td style="font-weight: 700; text-align: center;">{{ $idx + 1 }}</td>
                                        <td style="font-weight: 700; color: #0f172a;">
                                            <a href="{{ route('marketing.sosialmedia.task.show', $task->id) }}" style="color: #0f172a; text-decoration: none;">
                                                {{ $task->nama_tugas ?? '-' }}
                                            </a>
                                        </td>
                                        <td>
                                            <span class="dash-badge gray" style="font-weight: 600;">
                                                <i class="mdi mdi-account me-0.5 text-primary"></i>{{ $task->employee->name ?? '-' }}
                                            </span>
                                        </td>
                                        <td style="text-align: center;">
                                            @if(($task->views ?? 0) > 0)
                                                <span style="font-weight: 700; color: #0284c7; font-size: 0.78rem;">
                                                    <i class="mdi mdi-eye me-0.5"></i>{{ number_format($task->views, 0, ',', '.') }}
                                                </span>
                                                <span style="font-weight: 600; color: #e11d48; font-size: 0.74rem; margin-left: 6px;">
                                                    <i class="mdi mdi-heart me-0.5"></i>{{ number_format($task->likes ?? 0, 0, ',', '.') }}
                                                </span>
                                            @else
                                                <span style="color: #94a3b8; font-size: 0.74rem;">-</span>
                                            @endif
                                        </td>
                                        <td style="text-align: center;">
                                            @if(strtolower($task->status ?? '') === 'selesai')
                                                <span class="dash-badge green">Selesai</span>
                                            @else
                                                <span class="dash-badge amber">Proses</span>
                                            @endif
                                        </td>
                                        <td style="text-align: center;">
                                            <a href="{{ route('marketing.sosialmedia.task.show', $task->id) }}" class="dash-action-btn" title="Lihat Detail Tugas">
                                                <i class="mdi mdi-dots-horizontal"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" style="text-align: center; color: #94a3b8; padding: 24px;">Belum ada tugas marketing yang dibuat.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- TOP KONTEN SOSMED (VIEWS TERBANYAK) (FOR KEPALA MARKETING) -->
            <div class="col-12 col-lg-5">
                <div class="dash-panel h-100 d-flex flex-column">
                    <div class="dash-panel-header">
                        <div class="dash-panel-title-wrap">
                            <div class="dash-panel-icon" style="background-color: #ffe4e6; color: #e11d48;">
                                <i class="mdi mdi-fire"></i>
                            </div>
                                <div>
                                    <h2 class="dash-panel-title">Top Konten Sosmed (Views Terbanyak)</h2>
                                    <p class="dash-panel-subtitle">Video promosi staf marketing dengan jumlah tayangan tertinggi</p>
                                </div>
                        </div>
                        @if(Route::has('marketing.sosialmedia.selesai'))
                            <a href="{{ route('marketing.sosialmedia.selesai') }}" class="dash-link-all">
                                Semua Video <i class="mdi mdi-arrow-right"></i>
                            </a>
                        @endif
                    </div>
                    <div class="flex-grow-1 p-2">
                        <div class="d-flex flex-column gap-2">
                            @forelse($topViewedTasks as $idx => $task)
                                @php
                                    $platform = strtolower($task->platform ?? '');
                                @endphp
                                <div class="p-2.5 rounded-3 border d-flex align-items-center justify-content-between transition-all" style="background: #f8fafc;">
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="fw-bold text-muted" style="font-size: 0.85rem; width: 22px;">#{{ $idx + 1 }}</span>
                                        <div>
                                            <a href="{{ route('marketing.sosialmedia.task.show', $task->id) }}" class="fw-bold text-dark text-decoration-none d-block line-clamp-1" style="font-size: 0.86rem;" title="{{ $task->nama_tugas }}">
                                                {{ Str::limit($task->nama_tugas, 42) }}
                                            </a>
                                            <div class="d-flex align-items-center flex-wrap gap-1.5 mt-0.5">
                                                <small class="text-muted" style="font-size: 0.74rem;">
                                                    <i class="mdi mdi-account-outline me-0.5"></i>{{ $task->employee->name ?? 'Staf Marketing' }}
                                                </small>
                                                <span class="badge" style="font-size: 0.72rem; padding: 4px 8px; border-radius: 5px; font-weight: 600; line-height: 1.25;
                                                    @if(str_contains($platform, 'instagram') || str_contains($platform, 'reels'))
                                                        background: #fdf2f8; color: #db2777; border: 1px solid #fbcfe8;
                                                    @elseif(str_contains($platform, 'tiktok'))
                                                        background: #f1f5f9; color: #0f172a; border: 1px solid #cbd5e1;
                                                    @elseif(str_contains($platform, 'youtube'))
                                                        background: #fef2f2; color: #dc2626; border: 1px solid #fecaca;
                                                    @else
                                                        background: #eff6ff; color: #2563eb; border: 1px solid #bfdbfe;
                                                    @endif
                                                ">
                                                    @if(str_contains($platform, 'instagram') || str_contains($platform, 'reels'))
                                                        <i class="mdi mdi-instagram me-0.5"></i>Instagram
                                                    @elseif(str_contains($platform, 'tiktok'))
                                                        <i class="mdi mdi-music-note me-0.5"></i>TikTok
                                                    @elseif(str_contains($platform, 'youtube'))
                                                        <i class="mdi mdi-youtube me-0.5"></i>YouTube
                                                    @else
                                                        <i class="mdi mdi-video-outline me-0.5"></i>{{ $task->platform ?: 'Sosial Media' }}
                                                    @endif
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center gap-2.5 text-nowrap">
                                        <span class="fw-bold text-dark" style="font-size: 0.82rem;">
                                            <i class="mdi mdi-eye text-primary me-0.5"></i>{{ number_format($task->views ?? 0, 0, ',', '.') }}
                                        </span>
                                        <span class="fw-bold text-danger" style="font-size: 0.78rem;">
                                            <i class="mdi mdi-heart me-0.5"></i>{{ number_format($task->likes ?? 0, 0, ',', '.') }}
                                        </span>
                                        <a href="{{ $task->link_postingan ?: route('marketing.sosialmedia.task.show', $task->id) }}" class="dash-action-btn ms-1" title="Detail Konten" @if($task->link_postingan) target="_blank" rel="noopener noreferrer" @endif>
                                            <i class="mdi mdi-dots-horizontal"></i>
                                        </a>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-4 text-muted">
                                    <i class="mdi mdi-video-off-outline fs-2 d-block mb-1 opacity-50"></i>
                                    Belum ada data tayangan video promosi staf.
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        @else
            <!-- TUGAS SAYA (FOR STAFF MARKETING) -->
            <div class="col-12 col-lg-6">
                <div class="dash-panel">
                    <div class="dash-panel-header">
                        <div class="dash-panel-title-wrap">
                            <div class="dash-panel-icon" style="background-color: #f3e8ff; color: #9333ea;">
                                <i class="mdi mdi-clipboard-text-outline"></i>
                            </div>
                            <div>
                                <div class="d-flex align-items-center gap-2">
                                    <h2 class="dash-panel-title">Tugas & Aktivitas Harian Saya</h2>
                                    <span class="badge" style="background-color: #fef3c7; color: #d97706; font-size: 0.72rem; font-weight: 700;">{{ $myPendingTasks }} Perlu Dikerjakan</span>
                                </div>
                                <p class="dash-panel-subtitle">Daftar penugasan pembuatan video promosi media sosial</p>
                            </div>
                        </div>
                        <a href="{{ route('marketing.sosialmedia.tugas') }}" class="dash-link-all">
                            Buka Semua Tugas <i class="mdi mdi-arrow-right"></i>
                        </a>
                    </div>
                    <div>
                        <div class="list-group list-group-flush">
                            @forelse($myTasks as $task)
                                <div class="list-group-item px-3 py-2.5 mb-2 border rounded-3 d-flex align-items-start justify-content-between" style="background: #f8fafc;">
                                    <div>
                                        <a href="{{ route('marketing.sosialmedia.task.show', $task->id) }}" class="fw-bold text-dark text-decoration-none d-block mb-1" style="font-size: 0.9rem;">
                                            {{ $task->nama_tugas ?? '-' }}
                                        </a>
                                        <p class="text-muted small mb-1">{{ Str::limit($task->deskripsi ?? 'Tidak ada catatan khusus.', 90) }}</p>
                                        <small class="text-muted" style="font-size: 0.74rem;">
                                            <i class="mdi mdi-clock-outline me-1"></i>Deadline: {{ $task->deadline ? \Carbon\Carbon::parse($task->deadline)->format('d M Y') : '-' }}
                                        </small>
                                    </div>
                                    <div>
                                        @if(strtolower($task->status ?? '') === 'selesai')
                                            <span class="badge" style="background: #10b981; color: #fff; font-size: 0.72rem; padding: 4px 8px; border-radius: 6px;">Selesai</span>
                                        @else
                                            <a href="{{ route('marketing.sosialmedia.task.show', $task->id) }}" class="badge text-decoration-none shadow-sm" style="background: #f59e0b; color: #fff; font-size: 0.72rem; padding: 5px 10px; border-radius: 6px;">
                                                <i class="mdi mdi-pencil-outline me-0.5"></i>Kerjakan
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-4 text-muted">
                                    <i class="mdi mdi-check-all fs-2 d-block mb-1 text-success opacity-75"></i>
                                    Tidak ada tugas pending saat ini. Kerja bagus!
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

            <!-- FAST UNIT AVAILABILITY CHECKER (5 UNIT BERSTATUS TERSEDIA DARI CATALOG UNIT) -->
            <div class="col-12 col-lg-6">
                <div class="dash-panel">
                    <div class="dash-panel-header">
                        <div class="dash-panel-title-wrap">
                            <div class="dash-panel-icon" style="background-color: #dcfce7; color: #16a34a;">
                                <i class="mdi mdi-home-search-outline"></i>
                            </div>
                            <div>
                                <h2 class="dash-panel-title">Ketersediaan Unit Kavling Siap Jual</h2>
                                <p class="dash-panel-subtitle">5 unit terbaru berstatus Tersedia di Katalog Unit</p>
                            </div>
                        </div>
                        <a href="{{ route('marketing.jual-unit') }}" class="dash-link-all">
                            Buka Catalog Unit <i class="mdi mdi-arrow-right"></i>
                        </a>
                    </div>
                    <div class="dash-table-wrap">
                        <table class="dash-table">
                            <thead>
                                <tr>
                                    <th style="width: 28px; text-align: center;">No</th>
                                    <th>Unit / Proyek</th>
                                    <th>Tipe / Jenis</th>
                                    <th>Harga Jual</th>
                                    <th style="text-align: center;">Status</th>
                                    <th style="width: 32px; text-align: center;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($readyCatalogUnits ?? [] as $cuIdx => $cu)
                                    <tr>
                                        <td style="font-weight: 700; text-align: center;">{{ $cuIdx + 1 }}</td>
                                        <td>
                                            <div style="font-weight: 700; color: #0f172a;">
                                                Blok {{ $cu->block }}.{{ $cu->unit_number }} {{ $cu->unit_name }}
                                            </div>
                                            <div style="font-size: 0.68rem; color: #94a3b8; margin-top: 1px;">
                                                {{ $cu->landBank?->name ?? 'Proyek' }}
                                            </div>
                                        </td>
                                        <td>
                                            <div style="color: #334155; font-weight: 600; font-size: 0.76rem;">
                                                {{ $cu->type ? 'Tipe ' . $cu->type : 'Standar' }}
                                            </div>
                                            <div style="font-size: 0.68rem; color: #64748b;">
                                                {{ $cu->jenis ? ucfirst($cu->jenis) : 'Komersil' }}
                                            </div>
                                        </td>
                                        <td>
                                            @if(!empty($cu->price) && $cu->price > 0)
                                                <span style="font-weight: 700; color: #16a34a; font-size: 0.8rem;">
                                                    Rp {{ number_format($cu->price, 0, ',', '.') }}
                                                </span>
                                            @else
                                                <span style="color: #94a3b8; font-size: 0.72rem; font-style: italic;">
                                                    Belum Diset
                                                </span>
                                            @endif
                                        </td>
                                        <td style="text-align: center;">
                                            <span class="dash-badge green">
                                                Tersedia
                                            </span>
                                        </td>
                                        <td style="text-align: center;">
                                            <a href="{{ route('marketing.jual-unit') }}" class="dash-action-btn" title="Lihat di Katalog Unit">
                                                <i class="mdi mdi-dots-horizontal"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" style="text-align: center; color: #94a3b8; padding: 24px;">Belum ada unit yang berstatus tersedia di katalog.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <!-- ========================================================================= -->
    <!-- SECTION 3: PENGAJUAN BOOKING CATALOG UNIT & LEADERBOARD/PROYEK -->
    <!-- ========================================================================= -->
    <div class="row g-3">
        <!-- TABEL KONTEN UTAMA: PENGAJUAN BOOKING CATALOG UNIT (KEPALA) / RIWAYAT VIDEO (STAFF) -->
        <div class="col-12 col-xl-8">
            <div class="dash-panel h-100 d-flex flex-column">
                @if($isKepalaMarketing)
                    <div class="dash-panel-header">
                        <div class="dash-panel-title-wrap">
                            <div class="dash-panel-icon" style="background-color: #e0f2fe; color: #0284c7;">
                                <i class="mdi mdi-home-export-outline"></i>
                            </div>
                            <div>
                                <div class="d-flex align-items-center gap-2">
                                    <h2 class="dash-panel-title">Pengajuan Booking Unit (Catalog Unit)</h2>
                                    <span class="badge" style="background: #e0f2fe; color: #0284c7; font-size: 0.72rem; font-weight: 700;">{{ $recentBookings->count() }} Pengajuan Terkini</span>
                                </div>
                                <p class="dash-panel-subtitle">Monitoring unit yang diajukan ke booking dari katalog, atas nama calon pembeli, dan staf marketing yang mengajukan</p>
                            </div>
                        </div>
                        <a href="{{ route('marketing.list_pengajuan') }}" class="dash-link-all">
                            Lihat Semua <i class="mdi mdi-arrow-right"></i>
                        </a>
                    </div>
                    <div class="dash-table-wrap">
                        <table class="dash-table">
                            <thead>
                                <tr>
                                    <th>Unit Diajukan</th>
                                    <th>Atas Nama Calon Pembeli</th>
                                    <th>Diajukan oleh Staf</th>
                                    <th>Skema Bayar</th>
                                    <th>Booking Fee</th>
                                    <th style="text-align: center;">Status</th>
                                    <th style="width: 32px; text-align: center;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentBookings as $b)
                                    <tr>
                                        <td>
                                            <span class="dash-badge sky" style="font-weight: 700;">
                                                Unit {{ $b->unit->unit_code ?? ($b->unit ? $b->unit->block . '.' . $b->unit->unit_number : '-') }}
                                            </span>
                                        </td>
                                        <td style="font-weight: 700; color: #0f172a;">
                                            {{ $b->customer->full_name ?? ($b->customer->name ?? '-') }}
                                        </td>
                                        <td>
                                            <span style="font-weight: 600; color: #334155;">
                                                {{ $b->sales->name ?? '-' }}
                                            </span>
                                            @if($b->agent_fee > 0)
                                                <div style="color: #9333ea; font-weight: 700; font-size: 0.72rem; margin-top: 1px;">
                                                    Fee: Rp {{ number_format($b->agent_fee, 0, ',', '.') }}
                                                </div>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="dash-badge gray">
                                                {{ strtoupper(str_replace('_', ' ', $b->purchase_type ?? 'KPR')) }}
                                            </span>
                                        </td>
                                        <td>
                                            <span style="font-weight: 700; color: #16a34a;">
                                                Rp {{ number_format($b->booking_fee ?? 0, 0, ',', '.') }}
                                            </span>
                                        </td>
                                        <td style="text-align: center;">
                                            @php
                                                $st = strtolower($b->status ?? 'pending');
                                                $badgeClass = 'amber';
                                                if(in_array($st, ['approved', 'aktif', 'acc', 'selesai', 'completed', 'lunas'])) $badgeClass = 'green';
                                                elseif(in_array($st, ['rejected', 'batal', 'rijected'])) $badgeClass = 'red';
                                            @endphp
                                            <span class="dash-badge {{ $badgeClass }}">
                                                {{ ucfirst($b->status ?? 'Pending') }}
                                            </span>
                                        </td>
                                        <td style="text-align: center;">
                                            <a href="{{ route('marketing.list_pengajuan') }}" class="dash-action-btn" title="Detail Pengajuan">
                                                <i class="mdi mdi-dots-horizontal"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" style="text-align: center; color: #94a3b8; padding: 24px;">Belum ada data unit yang diajukan ke booking.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="dash-panel-header">
                        <div class="dash-panel-title-wrap">
                            <div class="dash-panel-icon" style="background-color: #e0f2fe; color: #0284c7;">
                                <i class="mdi mdi-video-check-outline"></i>
                            </div>
                            <div>
                                <h2 class="dash-panel-title">Riwayat Setoran Video Promosi Saya</h2>
                                <p class="dash-panel-subtitle">Video promosi yang telah diunggah dan terverifikasi</p>
                            </div>
                        </div>
                        <a href="{{ route('marketing.sosialmedia.selesai') }}" class="dash-link-all">
                            Lihat Semua <i class="mdi mdi-arrow-right"></i>
                        </a>
                    </div>
                    <div class="dash-table-wrap">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0" style="font-size: 0.85rem;">
                                <thead class="table-light">
                                    <tr style="background: #f8fafc; border-bottom: 2px solid #e2e8f0;">
                                        <th class="py-2.5 px-3" style="color: #334155; font-weight: 700; width: 45px;">No</th>
                                        <th class="py-2.5" style="color: #334155; font-weight: 700;">Nama Tugas Promosi</th>
                                        <th class="py-2.5" style="color: #334155; font-weight: 700;">Platform</th>
                                        <th class="py-2.5" style="color: #334155; font-weight: 700;">Waktu Setor</th>
                                        <th class="py-2.5 text-center" style="color: #334155; font-weight: 700;">Performa Video</th>
                                        <th class="py-2.5 text-center" style="color: #334155; font-weight: 700; width: 110px;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($myCompletedTasks as $idx => $mct)
                                        <tr>
                                            <td class="px-3 text-center text-muted fw-bold">{{ $idx + 1 }}</td>
                                            <td>
                                                <a href="{{ route('marketing.sosialmedia.task.show', $mct->id) }}" class="fw-bold text-dark text-decoration-none">
                                                    {{ $mct->nama_tugas }}
                                                </a>
                                            </td>
                                            <td>
                                                <span class="badge bg-light text-danger border font-monospace px-2 py-1" style="font-size: 0.72rem;">
                                                    <i class="mdi mdi-instagram me-1"></i>{{ $mct->platform ?: 'Instagram Reels' }}
                                                </span>
                                            </td>
                                            <td>
                                                <div class="fw-semibold text-dark" style="font-size: 0.8rem;">
                                                    {{ $mct->tanggal_setor ? \Carbon\Carbon::parse($mct->tanggal_setor)->format('d M Y') : '-' }}
                                                </div>
                                                <small class="text-muted" style="font-size: 0.72rem;">
                                                    {{ $mct->tanggal_setor ? \Carbon\Carbon::parse($mct->tanggal_setor)->format('H:i') . ' WIB' : '' }}
                                                </small>
                                            </td>
                                            <td class="text-center">
                                                <div class="d-flex align-items-center justify-content-center gap-2.5">
                                                    <span class="fw-bold text-dark" style="font-size: 0.78rem;">
                                                        <i class="mdi mdi-eye text-primary me-0.5"></i>{{ number_format($mct->views ?: 0, 0, ',', '.') }}
                                                    </span>
                                                    <span class="fw-bold text-dark" style="font-size: 0.78rem;">
                                                        <i class="mdi mdi-heart text-danger me-0.5"></i>{{ number_format($mct->likes ?: 0, 0, ',', '.') }}
                                                    </span>
                                                </div>
                                            </td>
                                            <td style="text-align: center;">
                                                <a href="{{ route('marketing.sosialmedia.task.show', $mct->id) }}" class="dash-action-btn" title="Detail Video">
                                                    <i class="mdi mdi-dots-horizontal"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center py-4 text-muted">
                                                <i class="mdi mdi-video-outline fs-2 d-block mb-1 opacity-50"></i>
                                                Belum ada video promosi yang disetor.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- KOLOM KANAN: LEADERBOARD SALES (KEPALA) & PROGRES PENJUALAN PER PROYEK -->
        <div class="col-12 col-xl-4 d-flex flex-column gap-3">
            @if($isKepalaMarketing)
                <!-- LEADERBOARD TIM SALES & AGENCY -->
                <div class="dash-panel">
                    <div class="dash-panel-header">
                        <div class="dash-panel-title-wrap">
                            <div class="dash-panel-icon" style="background-color: #fef3c7; color: #d97706;">
                                <i class="mdi mdi-trophy-outline"></i>
                            </div>
                            <div>
                                <h2 class="dash-panel-title">Leaderboard Tim Sales</h2>
                                <p class="dash-panel-subtitle">Peringkat transaksi closing unit tim penjualan</p>
                            </div>
                        </div>
                        <a href="{{ route('agency.index') }}" class="dash-link-all">
                            Lihat Semua <i class="mdi mdi-arrow-right"></i>
                        </a>
                    </div>
                    <div>
                        <div class="d-flex flex-column gap-2.5">
                            @forelse($salesLeaderboard as $idx => $sales)
                                <div class="px-3 py-2.5 d-flex align-items-center justify-content-between border rounded-3" style="background: #f8fafc;">
                                    <div class="d-flex align-items-center gap-2.5">
                                        <span class="fw-bold text-muted" style="font-size: 0.85rem; width: 24px; text-align: center;">#{{ $idx + 1 }}</span>
                                        <div>
                                            <span class="fw-bold text-dark d-block" style="font-size: 0.84rem;">{{ $sales->name }}</span>
                                            <small class="text-muted" style="font-size: 0.72rem;">{{ $sales->phone ?? '-' }}</small>
                                        </div>
                                    </div>
                                    <div class="text-end">
                                        <span class="dash-badge purple">{{ $sales->total_bookings }} Closing</span>
                                        <small class="text-success d-block fw-bold mt-1" style="font-size: 0.72rem;">Rp {{ number_format($sales->total_fee ?? 0, 0, ',', '.') }}</small>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-3 text-muted" style="font-size: 0.82rem;">
                                    Belum ada data perolehan sales
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            @endif

            <!-- PROGRES PENJUALAN PER PROYEK -->
            <div class="dash-panel">
                <div class="dash-panel-header">
                    <div class="dash-panel-title-wrap">
                        <div class="dash-panel-icon" style="background-color: #ede9fe; color: #7c3aed;">
                            <i class="mdi mdi-domain"></i>
                        </div>
                        <div>
                            <h2 class="dash-panel-title">Progres Penjualan per Proyek</h2>
                            <p class="dash-panel-subtitle">Persentase unit terjual pada masing-masing proyek</p>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="d-flex flex-column gap-2.5">
                        @forelse($projects as $p)
                            @php
                                $percentSold = $p->total_units > 0 ? round(($p->sold_units / $p->total_units) * 100) : 0;
                            @endphp
                            <div class="p-3 rounded-3 border" style="background: #f8fafc;">
                                <div class="d-flex justify-content-between align-items-center mb-1.5">
                                    <span class="fw-bold text-dark" style="font-size: 0.9rem;">{{ $p->name }}</span>
                                    <span class="badge" style="background: #f3e8ff; color: #7c3aed; font-weight: 700; font-size: 0.74rem;">{{ $percentSold }}% Terjual</span>
                                </div>
                                <div class="progress mb-2" style="height: 6px; border-radius: 10px; background-color: #e2e8f0;">
                                    <div class="progress-bar" role="progressbar" style="width: {{ $percentSold }}%; background: #9a55ff;" aria-valuenow="{{ $percentSold }}" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <div class="d-flex justify-content-between small text-muted pt-1" style="font-size: 0.76rem;">
                                    <span>Tersedia: <strong class="text-success">{{ $p->ready_units }}</strong></span>
                                    <span>Booking: <strong class="text-warning">{{ $p->booked_units }}</strong></span>
                                    <span>Sold: <strong class="text-primary">{{ $p->sold_units }}</strong></span>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-4 text-muted">Belum ada proyek terdaftar.</div>
                        @endforelse
                    </div>
                </div>
                @if($projects->hasPages())
                    <div class="pt-2.5 mt-auto border-top d-flex flex-wrap justify-content-between align-items-center gap-2">
                        <small class="text-muted" style="font-size: 0.75rem;">
                            Menampilkan {{ $projects->firstItem() }}-{{ $projects->lastItem() }} dari {{ $projects->total() }} Proyek
                        </small>
                        <div class="pagination-wrapper">
                            {{ $projects->appends(request()->except('project_page'))->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

</div>

<style>
    .pagination {
        margin-bottom: 0 !important;
        gap: 3px;
    }
    .page-item .page-link {
        font-size: 0.74rem !important;
        padding: 3px 8px !important;
        border-radius: 4px !important;
        color: #475569 !important;
        border: 1px solid #cbd5e1 !important;
    }
    .page-item.active .page-link {
        background: #9a55ff !important;
        border-color: #9a55ff !important;
        color: #ffffff !important;
        font-weight: bold;
    }
    .page-item.disabled .page-link {
        opacity: 0.5;
        border-color: #e2e8f0 !important;
    }
</style>
@endsection
