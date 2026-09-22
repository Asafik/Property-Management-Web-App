@extends('layouts.partial.app')

@section('title', 'Dashboard - Property Management App')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard-clean.css') }}?v={{ time() }}">
@endpush

@section('content')
<div class="dash-wrapper">

    <!-- 1. HEADER SECTION -->
    <div class="dash-header">
        <!-- Kiri: Greeting Title & Subtitle -->
        <div>
            <h1 class="dash-header-title">
                Selamat datang, {{ auth()->user()->name ?? 'Admin' }}
            </h1>
            <p class="dash-header-sub">
                Berikut ringkasan aset, progres, penjualan dan keuangan perusahaan.
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
                    Selamat bekerja, {{ auth()->user()->name ?? 'Admin' }}!
                </div>
            </div>
        </div>
    </div>

    <!-- 2. 4 METRIC CARDS GRID (KONSISTEN: TINGGI SAMA, PADDING SAMA, POSISI ANGKA RAPI, FLAT TANPA SHADOW) -->
    <div class="dash-kpi-grid">
        
        <!-- Card 1: Total Tanah / Proyek (Ungu) -->
        <div class="dash-kpi-card">
            <div class="dash-kpi-left">
                <div class="dash-kpi-icon purple">
                    <i class="mdi mdi-office-building"></i>
                </div>
                <div class="dash-kpi-info">
                    <div class="dash-kpi-label">Total Tanah / Proyek</div>
                    <div class="dash-kpi-val">{{ $totalProperty ?? 0 }}</div>
                    <div class="dash-kpi-sub">Tanah Induk Terdaftar</div>
                </div>
            </div>
            <a href="#proyekTableSection" class="dash-kpi-action purple" title="Lihat Daftar Proyek">
                <i class="mdi mdi-arrow-right"></i>
            </a>
        </div>

        <!-- Card 2: Total Unit (Biru) -->
        <div class="dash-kpi-card">
            <div class="dash-kpi-left">
                <div class="dash-kpi-icon blue">
                    <i class="mdi mdi-home"></i>
                </div>
                <div class="dash-kpi-info">
                    <div class="dash-kpi-label">Total Unit</div>
                    <div class="dash-kpi-val">{{ number_format($totalUnit ?? 0, 0, ',', '.') }}</div>
                    <div class="dash-kpi-sub">Kavling & Unit Bangunan</div>
                </div>
            </div>
            <a href="{{ route('marketing.jual-unit') }}" class="dash-kpi-action blue" title="Lihat Unit">
                <i class="mdi mdi-arrow-right"></i>
            </a>
        </div>

        <!-- Card 3: Total Pendapatan (Hijau Mint) -->
        <div class="dash-kpi-card">
            <div class="dash-kpi-left">
                <div class="dash-kpi-icon green">
                    <i class="mdi mdi-wallet"></i>
                </div>
                <div class="dash-kpi-info">
                    <div class="dash-kpi-label">Total Pendapatan</div>
                    <div class="dash-kpi-val">Rp {{ number_format($totalPendapatan ?? 0, 0, ',', '.') }}</div>
                    <div class="dash-kpi-sub">Penerimaan Dana Masuk</div>
                </div>
            </div>
            <div class="dash-kpi-action green">
                <i class="mdi mdi-arrow-right"></i>
            </div>
        </div>

        <!-- Card 4: Total Piutang (Merah / Rose) -->
        <div class="dash-kpi-card">
            <div class="dash-kpi-left">
                <div class="dash-kpi-icon rose">
                    <i class="mdi mdi-file-document"></i>
                </div>
                <div class="dash-kpi-info">
                    <div class="dash-kpi-label">Total Piutang</div>
                    <div class="dash-kpi-val">Rp {{ number_format($totalPiutang ?? 0, 0, ',', '.') }}</div>
                    <div class="dash-kpi-sub">Tagihan & Belanja Lahan</div>
                </div>
            </div>
            <div class="dash-kpi-action rose">
                <i class="mdi mdi-arrow-right"></i>
            </div>
        </div>

    </div>

    <!-- 3. BARIS 1: DAFTAR TANAH / PROYEK & STATUS PERIZINAN -->
    <div id="proyekTableSection" class="dash-row-grid">
        
        <!-- Tabel Kiri: Daftar Tanah / Proyek (Jarak Rapat & Kompak) -->
        <div class="dash-panel">
            <div class="dash-panel-header">
                <div class="dash-panel-title-wrap">
                    <div class="dash-panel-icon">
                        <i class="mdi mdi-office-building"></i>
                    </div>
                    <div>
                        <h2 class="dash-panel-title">Daftar Tanah / Proyek</h2>
                        <p class="dash-panel-subtitle">5 proyek terbaru yang sedang dikelola</p>
                    </div>
                </div>
                <a href="{{ route('proyek.index') }}" class="dash-link-all">
                    Lihat Semua <i class="mdi mdi-arrow-right"></i>
                </a>
            </div>

            <!-- Tabel Data Tanah / Proyek (Rapat & Tanpa Ruang Kosong) -->
            <div class="dash-table-wrap">
                <table class="dash-table">
                    <thead>
                        <tr>
                            <th style="width: 28px; text-align: center;">No</th>
                            <th>Nama Proyek</th>
                            <th>Lokasi</th>
                            <th>Luas</th>
                            <th style="text-align: center;">Unit</th>
                            <th>Tahap</th>
                            <th>Progress</th>
                            <th style="width: 32px; text-align: center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentProjects as $index => $proj)
                            @php
                                $tahap = $proj->development_status ?: 'Perencanaan';
                                $badgeClass = match(strtolower($tahap)) {
                                    'selesai' => 'green',
                                    'sedang dibangun', 'pembangunan' => 'blue',
                                    'perizinan' => 'sky',
                                    'legal' => 'teal',
                                    'pemasaran' => 'orange',
                                    default => 'gray'
                                };
                                $progress = $proj->overall_progress_percentage;
                            @endphp
                            <tr>
                                <td style="font-weight: 700; text-align: center;">{{ $index + 1 }}</td>
                                <td style="font-weight: 700; color: #0f172a;">{{ $proj->name }}</td>
                                <td style="color: #64748b;">{{ $proj->city ?? ($proj->district ?? 'Jember') }}</td>
                                <td style="color: #475569; font-weight: 500;">
                                    @if($proj->area >= 10000)
                                        {{ number_format($proj->area / 10000, 1, ',', '.') }} Ha
                                    @else
                                        {{ number_format($proj->area, 0, ',', '.') }} m²
                                    @endif
                                </td>
                                <td style="text-align: center;">
                                    <span class="dash-badge gray" style="font-weight: 700;">{{ $proj->units_count ?? $proj->units->count() }}</span>
                                </td>
                                <td>
                                    <span class="dash-badge {{ $badgeClass }}">{{ $tahap }}</span>
                                </td>
                                <td>
                                    <div class="dash-progress-wrap">
                                        <div class="dash-progress-bar-bg">
                                            <div class="dash-progress-bar-fill" style="width: {{ $progress }}%; background-color: {{ $progress >= 70 ? '#7c3aed' : ($progress >= 40 ? '#0284c7' : '#ea580c') }};"></div>
                                        </div>
                                        <span style="font-size: 0.68rem; font-weight: 700; color: #334155;">{{ $progress }}%</span>
                                    </div>
                                </td>
                                <td style="text-align: center;">
                                    <a href="{{ route('proyek.index') }}" class="dash-action-btn" title="Kelola Proyek">
                                        <i class="mdi mdi-dots-horizontal"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" style="text-align: center; color: #94a3b8; padding: 24px;">Belum ada data proyek lahan aktif</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Tabel Kanan: Status Perizinan (LEBIH VISUAL DENGAN BADGE & STAT SUMMARY) -->
        <div class="dash-panel">
            <div class="dash-panel-header">
                <div class="dash-panel-title-wrap">
                    <div class="dash-panel-icon">
                        <i class="mdi mdi-file-document-edit-outline"></i>
                    </div>
                    <div>
                        <h2 class="dash-panel-title">Status Perizinan</h2>
                        <p class="dash-panel-subtitle">Ringkasan pengurusan izin di semua proyek</p>
                    </div>
                </div>
                <a href="{{ route('perizinan.index') }}" class="dash-link-all">
                    Lihat Semua <i class="mdi mdi-arrow-right"></i>
                </a>
            </div>

            <!-- Ringkasan Visual Status Perizinan (Mini Badges) -->
            <div class="dash-perizinan-summary">
                <div class="dash-perizinan-box gray">
                    <div class="label">Total Izin</div>
                    <div class="num">{{ $perizinanSummary['total'] ?? 0 }}</div>
                </div>
                <div class="dash-perizinan-box green">
                    <div class="label">Selesai</div>
                    <div class="num">{{ $perizinanSummary['selesai'] ?? 0 }}</div>
                </div>
                <div class="dash-perizinan-box blue">
                    <div class="label">Berjalan</div>
                    <div class="num">{{ $perizinanSummary['berjalan'] ?? 0 }}</div>
                </div>
                <div class="dash-perizinan-box rose">
                    <div class="label">Tertunda</div>
                    <div class="num">{{ $perizinanSummary['tertunda'] ?? 0 }}</div>
                </div>
            </div>

            <!-- Tabel Data Status Perizinan dengan Badge Warna Tegas -->
            <div class="dash-table-wrap">
                <table class="dash-table">
                    <thead>
                        <tr>
                            <th style="width: 28px; text-align: center;">No</th>
                            <th>Jenis Perizinan</th>
                            <th style="text-align: center;">Total</th>
                            <th style="text-align: center;">Selesai</th>
                            <th style="text-align: center;">Berjalan</th>
                            <th style="text-align: center;">Tertunda</th>
                            <th style="width: 32px; text-align: center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($perizinanRows as $idx => $pz)
                            <tr>
                                <td style="font-weight: 700; text-align: center;">{{ $idx + 1 }}</td>
                                <td style="font-weight: 700; color: #0f172a;">{{ $pz['nama'] }}</td>
                                <td style="text-align: center; font-weight: 700; color: #334155;">{{ $pz['total'] }}</td>
                                <td style="text-align: center;">
                                    <span class="dash-pill-count {{ $pz['selesai'] > 0 ? 'green' : 'gray' }}">{{ $pz['selesai'] }}</span>
                                </td>
                                <td style="text-align: center;">
                                    <span class="dash-pill-count {{ $pz['berjalan'] > 0 ? 'blue' : 'gray' }}">{{ $pz['berjalan'] }}</span>
                                </td>
                                <td style="text-align: center;">
                                    <span class="dash-pill-count {{ $pz['tertunda'] > 0 ? 'rose' : 'gray' }}">{{ $pz['tertunda'] }}</span>
                                </td>
                                <td style="text-align: center;">
                                    <a href="{{ route('perizinan.index') }}" class="dash-action-btn" title="Detail Perizinan">
                                        <i class="mdi mdi-dots-horizontal"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" style="text-align: center; color: #94a3b8; padding: 24px;">Belum ada data status perizinan</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <!-- 4. BARIS 2: STATUS UNIT (COMPACT) & PROGRES PEMBANGUNAN (BERBASIS UNIT) -->
    <div class="dash-row-grid">
        
        <!-- Kartu Kiri: Status Unit (COMPACT & TIDAK TERLALU TINGGI) -->
        <div class="dash-panel">
            <div class="dash-panel-header">
                <div class="dash-panel-title-wrap">
                    <div class="dash-panel-icon">
                        <i class="mdi mdi-home-outline"></i>
                    </div>
                    <div>
                        <h2 class="dash-panel-title">Status Unit</h2>
                        <p class="dash-panel-subtitle">Ringkasan status unit di seluruh proyek</p>
                    </div>
                </div>
                <a href="{{ route('marketing.jual-unit') }}" class="dash-link-all">
                    Lihat Semua <i class="mdi mdi-arrow-right"></i>
                </a>
            </div>

            <!-- 4 Mini Cards Grid (COMPACT PADDING) -->
            <div class="dash-unit-grid">
                
                <!-- 1. Tersedia -->
                <div class="dash-unit-card green">
                    <div class="dash-unit-card-head">
                        <div class="dash-unit-icon green">
                            <i class="mdi mdi-home-circle"></i>
                        </div>
                        <span class="dash-unit-name">Tersedia</span>
                    </div>
                    <div class="dash-unit-val">{{ number_format($unitStats['ready']) }}</div>
                    <div class="dash-unit-pct green">
                        ● {{ $unitStats['ready_pct'] }}%
                    </div>
                </div>

                <!-- 2. Booking -->
                <div class="dash-unit-card blue">
                    <div class="dash-unit-card-head">
                        <div class="dash-unit-icon blue">
                            <i class="mdi mdi-bookmark-check"></i>
                        </div>
                        <span class="dash-unit-name">Booking</span>
                    </div>
                    <div class="dash-unit-val">{{ number_format($unitStats['booking']) }}</div>
                    <div class="dash-unit-pct blue">
                        ● {{ $unitStats['booking_pct'] }}%
                    </div>
                </div>

                <!-- 3. Terjual -->
                <div class="dash-unit-card purple">
                    <div class="dash-unit-card-head">
                        <div class="dash-unit-icon purple">
                            <i class="mdi mdi-home-lock"></i>
                        </div>
                        <span class="dash-unit-name">Terjual</span>
                    </div>
                    <div class="dash-unit-val">{{ number_format($unitStats['sold']) }}</div>
                    <div class="dash-unit-pct purple">
                        ● {{ $unitStats['sold_pct'] }}%
                    </div>
                </div>

                <!-- 4. Dipesan KPR -->
                <div class="dash-unit-card amber">
                    <div class="dash-unit-card-head">
                        <div class="dash-unit-icon amber">
                            <i class="mdi mdi-file-document-check"></i>
                        </div>
                        <span class="dash-unit-name">KPR</span>
                    </div>
                    <div class="dash-unit-val">{{ number_format($unitStats['kpr']) }}</div>
                    <div class="dash-unit-pct amber">
                        ● {{ $unitStats['kpr_pct'] }}%
                    </div>
                </div>

            </div>

            <!-- Visual Proposi Bar (Rasio Keseluruhan Unit) -->
            <div class="dash-unit-ratio">
                <span>Rasio Komposisi Unit:</span>
                <div class="dash-ratio-bar">
                    <div class="dash-ratio-segment" style="width: {{ $unitStats['ready_pct'] }}%; background-color: #10b981;" title="Tersedia {{ $unitStats['ready_pct'] }}%"></div>
                    <div class="dash-ratio-segment" style="width: {{ $unitStats['booking_pct'] }}%; background-color: #3b82f6;" title="Booking {{ $unitStats['booking_pct'] }}%"></div>
                    <div class="dash-ratio-segment" style="width: {{ $unitStats['sold_pct'] }}%; background-color: #a855f7;" title="Terjual {{ $unitStats['sold_pct'] }}%"></div>
                    <div class="dash-ratio-segment" style="width: {{ $unitStats['kpr_pct'] }}%; background-color: #f59e0b;" title="KPR {{ $unitStats['kpr_pct'] }}%"></div>
                </div>
                <span style="font-weight: 700; color: #334155;">Total {{ number_format($unitStats['total']) }}</span>
            </div>
        </div>

        <!-- Kartu Kanan: Progres Pembangunan (BERBASIS UNIT: BLOK A.1 MAWAR, DLL) -->
        <div class="dash-panel">
            <div class="dash-panel-header">
                <div class="dash-panel-title-wrap">
                    <div class="dash-panel-icon">
                        <i class="mdi mdi-chart-timeline-variant-shimmer"></i>
                    </div>
                    <div>
                        <h2 class="dash-panel-title">Progres Pembangunan</h2>
                        <p class="dash-panel-subtitle">Progress pembangunan per unit properti</p>
                    </div>
                </div>
                <a href="{{ route('marketing.jual-unit') }}" class="dash-link-all">
                    Lihat Semua <i class="mdi mdi-arrow-right"></i>
                </a>
            </div>

            <!-- Tabel Data Progres Pembangunan (Berbasis Unit) -->
            <div class="dash-table-wrap">
                <table class="dash-table">
                    <thead>
                        <tr>
                            <th style="width: 28px; text-align: center;">No</th>
                            <th>Unit / Proyek</th>
                            <th>Target</th>
                            <th>Progress</th>
                            <th style="text-align: center;">Status</th>
                            <th style="width: 32px; text-align: center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentUnitProgress as $uIdx => $u)
                            @php
                                $progressPct = $u->construction_progress_percentage;
                            @endphp
                            <tr>
                                <td style="font-weight: 700; text-align: center;">{{ $uIdx + 1 }}</td>
                                <td>
                                    <div style="font-weight: 700; color: #0f172a;">Blok {{ $u->block }}.{{ $u->unit_number }} {{ $u->unit_name }}</div>
                                    <div style="font-size: 0.68rem; color: #94a3b8; margin-top: 1px;">{{ $u->landBank?->name ?? 'Proyek' }}</div>
                                </td>
                                <td style="color: #64748b; font-weight: 500;">
                                    {{ $u->created_at ? $u->created_at->addMonths(4)->translatedFormat('M Y') : 'Des 2025' }}
                                </td>
                                <td>
                                    <div class="dash-progress-wrap">
                                        <div class="dash-progress-bar-bg" style="width: 80px;">
                                            <div class="dash-progress-bar-fill" style="width: {{ $progressPct }}%; background-color: {{ $progressPct >= 80 ? '#7c3aed' : ($progressPct >= 40 ? '#0284c7' : '#ea580c') }};"></div>
                                        </div>
                                        <span style="font-size: 0.75rem; font-weight: 800; color: #0f172a; width: 30px; text-align: right;">{{ $progressPct }}%</span>
                                    </div>
                                </td>
                                <td style="text-align: center;">
                                    @if($progressPct >= 100)
                                        <span class="dash-status-pill on-track">
                                            <span class="dot"></span> Selesai
                                        </span>
                                    @elseif($progressPct >= 50)
                                        <span class="dash-status-pill on-track">
                                            <span class="dot"></span> On Track
                                        </span>
                                    @elseif($progressPct > 0)
                                        <span class="dash-status-pill warning">
                                            <span class="dot"></span> Perhatian
                                        </span>
                                    @else
                                        <span class="dash-status-pill" style="background:#f1f5f9; color:#64748b;">
                                            <span class="dot" style="background:#94a3b8;"></span> Belum Mulai
                                        </span>
                                    @endif
                                </td>
                                <td style="text-align: center;">
                                    <a href="{{ route('marketing.jual-unit') }}" class="dash-action-btn" title="Detail Unit">
                                        <i class="mdi mdi-dots-horizontal"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" style="text-align: center; color: #94a3b8; padding: 24px;">Belum ada progres unit yang tercatat</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <!-- 5. BARIS 3: TUGAS TIM TERBARU & RINGKASAN PENJUALAN & KEUANGAN (SEIMBANG & RAPI) -->
    <div class="dash-row-grid stretch">
        
        <!-- Kartu Kiri: Tugas Tim Terbaru (Rapat & Seimbang) -->
        <div class="dash-panel">
            <div>
                <div class="dash-panel-header">
                    <div class="dash-panel-title-wrap">
                        <div class="dash-panel-icon">
                            <i class="mdi mdi-checkbox-marked-circle-outline"></i>
                        </div>
                        <div>
                            <h2 class="dash-panel-title">Tugas Tim Terbaru</h2>
                            <p class="dash-panel-subtitle">5 tugas terbaru dari seluruh divisi</p>
                        </div>
                    </div>
                    <a href="{{ route('perizinan.tugas.index') }}" class="dash-link-all">
                        Lihat Semua <i class="mdi mdi-arrow-right"></i>
                    </a>
                </div>

                <!-- Tabel Data Tugas Tim -->
                <div class="dash-table-wrap">
                    <table class="dash-table">
                        <thead>
                            <tr>
                                <th style="width: 28px; text-align: center;">No</th>
                                <th>Tugas</th>
                                <th>Proyek</th>
                                <th>Ditugaskan Ke</th>
                                <th>Divisi</th>
                                <th>Deadline</th>
                                <th style="text-align: center;">Status</th>
                                <th style="width: 32px; text-align: center;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentTeamTasks as $tIdx => $t)
                                @php
                                    $taskStatus = strtolower($t->status ?? '');
                                    $taskBadge = match(true) {
                                        str_contains($taskStatus, 'selesai') => 'green',
                                        str_contains($taskStatus, 'kendala') || str_contains($taskStatus, 'terlambat') => 'red',
                                        str_contains($taskStatus, 'proses') || str_contains($taskStatus, 'berjalan') => 'yellow',
                                        default => 'blue'
                                    };
                                @endphp
                                <tr>
                                    <td style="font-weight: 700; text-align: center;">{{ $tIdx + 1 }}</td>
                                    <td style="font-weight: 700; color: #0f172a;">{{ $t->nama_tugas }}</td>
                                    <td style="color: #475569;">{{ $t->proyek_nama ?? ($t->proyek?->name ?? 'Semua Proyek') }}</td>
                                    <td>
                                        <div style="display: flex; align-items: center; gap: 6px;">
                                            <div style="width: 22px; height: 22px; border-radius: 50%; background: #ede9fe; color: #7c3aed; font-size: 0.65rem; font-weight: 700; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                                <i class="mdi mdi-account" style="font-size: 0.75rem;"></i>
                                            </div>
                                            <span style="font-weight: 600; color: #1e293b; font-size: 0.76rem; white-space: nowrap;">
                                                {{ $t->employee?->name ?? 'Belum Ditugaskan' }}
                                            </span>
                                        </div>
                                    </td>
                                    <td style="color: #64748b;">{{ $t->employee?->division?->name ?? 'Legal' }}</td>
                                    <td style="color: #64748b;">{{ $t->deadline ? $t->deadline->translatedFormat('d M Y') : '-' }}</td>
                                    <td style="text-align: center;">
                                        <span class="dash-badge {{ $taskBadge }}">{{ $t->status ?: 'Menunggu' }}</span>
                                    </td>
                                    <td style="text-align: center;">
                                        <a href="{{ route('perizinan.tugas.index') }}" class="dash-action-btn" title="Detail Tugas">
                                            <i class="mdi mdi-dots-horizontal"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" style="text-align: center; color: #94a3b8; padding: 24px;">Belum ada tugas tim yang aktif</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Kartu Kanan: Ringkasan Penjualan & Keuangan (KOMPAK & TINGGI SEIMBANG) -->
        <div class="dash-panel">
            <div>
                <div class="dash-panel-header">
                    <div class="dash-panel-title-wrap">
                        <div class="dash-panel-icon">
                            <i class="mdi mdi-chart-box-outline"></i>
                        </div>
                        <div>
                            <h2 class="dash-panel-title">Ringkasan Penjualan & Keuangan</h2>
                            <p class="dash-panel-subtitle">Rekap penjualan unit dan posisi keuangan</p>
                        </div>
                    </div>
                    <a href="{{ route('marketing.list_pengajuan') }}" class="dash-link-all">
                        Lihat Semua <i class="mdi mdi-arrow-right"></i>
                    </a>
                </div>

                <!-- 4 Mini Cards Atas -->
                <div class="dash-finance-mini-grid">
                    
                    <!-- 1. Unit Terjual -->
                    <div class="dash-finance-mini-card sky">
                        <div class="dash-finance-mini-icon sky">
                            <i class="mdi mdi-cart-outline"></i>
                        </div>
                        <div class="dash-finance-mini-info">
                            <div class="dash-finance-mini-label">Unit Terjual</div>
                            <div class="dash-finance-mini-val">{{ number_format($financeSummary['unit_terjual']) }}</div>
                        </div>
                    </div>

                    <!-- 2. Nilai Penjualan -->
                    <div class="dash-finance-mini-card purple">
                        <div class="dash-finance-mini-icon purple">
                            <i class="mdi mdi-tag-outline"></i>
                        </div>
                        <div class="dash-finance-mini-info">
                            <div class="dash-finance-mini-label">Nilai Penjualan</div>
                            <div class="dash-finance-mini-val">
                                @if($financeSummary['nilai_penjualan'] >= 1000000000)
                                    {{ number_format($financeSummary['nilai_penjualan'] / 1000000000, 1, ',', '.') }} M
                                @elseif($financeSummary['nilai_penjualan'] >= 1000000)
                                    {{ number_format($financeSummary['nilai_penjualan'] / 1000000, 1, ',', '.') }} Jt
                                @else
                                    {{ number_format($financeSummary['nilai_penjualan'], 0, ',', '.') }}
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- 3. Uang Diterima -->
                    <div class="dash-finance-mini-card green">
                        <div class="dash-finance-mini-icon green">
                            <i class="mdi mdi-wallet-outline"></i>
                        </div>
                        <div class="dash-finance-mini-info">
                            <div class="dash-finance-mini-label">Uang Diterima</div>
                            <div class="dash-finance-mini-val">
                                @if($financeSummary['uang_diterima'] >= 1000000000)
                                    {{ number_format($financeSummary['uang_diterima'] / 1000000000, 1, ',', '.') }} M
                                @elseif($financeSummary['uang_diterima'] >= 1000000)
                                    {{ number_format($financeSummary['uang_diterima'] / 1000000, 1, ',', '.') }} Jt
                                @else
                                    {{ number_format($financeSummary['uang_diterima'], 0, ',', '.') }}
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- 4. Piutang Penjualan -->
                    <div class="dash-finance-mini-card rose">
                        <div class="dash-finance-mini-icon rose">
                            <i class="mdi mdi-file-document-outline"></i>
                        </div>
                        <div class="dash-finance-mini-info">
                            <div class="dash-finance-mini-label">Piutang</div>
                            <div class="dash-finance-mini-val">
                                @if($financeSummary['piutang'] >= 1000000000)
                                    {{ number_format($financeSummary['piutang'] / 1000000000, 1, ',', '.') }} M
                                @elseif($financeSummary['piutang'] >= 1000000)
                                    {{ number_format($financeSummary['piutang'] / 1000000, 1, ',', '.') }} Jt
                                @else
                                    {{ number_format($financeSummary['piutang'], 0, ',', '.') }}
                                @endif
                            </div>
                        </div>
                    </div>

                </div>

                <!-- 2 Card Bawah: Total Pengeluaran & Saldo Posisi Keuangan -->
                <div class="dash-finance-bottom-grid">
                    
                    <!-- Total Pengeluaran Proyek -->
                    <div class="dash-finance-bottom-card rose">
                        <div class="dash-finance-bottom-icon rose">
                            <i class="mdi mdi-minus-circle-outline"></i>
                        </div>
                        <div style="min-width: 0;">
                            <div style="font-size: 0.68rem; color: #64748b; font-weight: 500;">Total Pengeluaran</div>
                            <div style="font-size: 1rem; font-weight: 800; color: #0f172a; margin-top: 2px;">Rp {{ number_format($financeSummary['total_pengeluaran'], 0, ',', '.') }}</div>
                            <div style="font-size: 0.65rem; color: #94a3b8;">Tanah, pengolahan, operasional</div>
                        </div>
                    </div>

                    <!-- Saldo / Posisi Keuangan -->
                    <div class="dash-finance-bottom-card green">
                        <div class="dash-finance-bottom-icon green">
                            <i class="mdi mdi-bank-outline"></i>
                        </div>
                        <div style="min-width: 0;">
                            <div style="font-size: 0.68rem; color: #64748b; font-weight: 500;">Saldo Keuangan</div>
                            <div style="font-size: 1rem; font-weight: 800; color: {{ $financeSummary['saldo_keuangan'] >= 0 ? '#15803d' : '#e11d48' }}; margin-top: 2px;">Rp {{ number_format($financeSummary['saldo_keuangan'], 0, ',', '.') }}</div>
                            <div style="font-size: 0.65rem; color: #94a3b8;">Kas masuk - kas keluar</div>
                    </div>

                </div>

            </div>
        </div>

    </div>

</div>
@endsection
