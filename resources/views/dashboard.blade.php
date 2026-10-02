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
            <a href="{{ route('proyek.unit.index') }}" class="dash-kpi-action blue" title="Lihat Unit Proyek">
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
                <a href="{{ route('proyek.unit.index') }}" class="dash-link-all">
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
                                    <a href="{{ route('proyek.unit.index') }}" class="dash-action-btn" title="Kelola Unit Proyek">
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

        <!-- Tabel Kanan: Daftar Tanah (Pasca Land Bank) (Simple & Seimbang dengan Tabel Kiri) -->
        <div class="dash-panel">
            <div class="dash-panel-header">
                <div class="dash-panel-title-wrap">
                    <div class="dash-panel-icon" style="background-color: #ede9fe; color: #7c3aed;">
                        <i class="mdi mdi-office-building-marker-outline"></i>
                    </div>
                    <div>
                        <h2 class="dash-panel-title">Daftar Tanah (Pasca Land Bank)</h2>
                        <p class="dash-panel-subtitle">5 tanah / kawasan yang sudah diakuisisi</p>
                    </div>
                </div>
                <a href="{{ route('properti-all') }}" class="dash-link-all">
                    Lihat Semua <i class="mdi mdi-arrow-right"></i>
                </a>
            </div>

            <!-- Tabel Data Tanah Pasca Land Bank (Simple & Kompak) -->
            <div class="dash-table-wrap">
                <table class="dash-table">
                    <thead>
                        <tr>
                            <th style="width: 28px; text-align: center;">No</th>
                            <th>Nama Properti</th>
                            <th>Lokasi</th>
                            <th>Luas</th>
                            <th style="text-align: center;">Legalitas</th>
                            <th>Tahap</th>
                            <th>Progress</th>
                            <th style="width: 32px; text-align: center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pascaProjects as $pIndex => $pasca)
                            @php
                                $tahapPasca = $pasca->development_status ?: 'Perencanaan';
                                $badgePasca = match(strtolower($tahapPasca)) {
                                    'selesai' => 'green',
                                    'sedang dibangun', 'pembangunan' => 'blue',
                                    'perizinan' => 'sky',
                                    'legal' => 'teal',
                                    'pemasaran' => 'orange',
                                    default => 'gray'
                                };
                                $progPasca = $pasca->overall_progress_percentage;
                                $isVerified = ($pasca->legal_status === 'verified') || $pasca->isFromPraLandbank();
                            @endphp
                            <tr>
                                <td style="font-weight: 700; text-align: center;">{{ $pIndex + 1 }}</td>
                                <td>
                                    <a href="{{ route('properti.show', $pasca->id) }}" style="font-weight: 700; color: #0f172a; text-decoration: none;" class="hover-primary" title="Lihat detail properti">
                                        {{ $pasca->name }}
                                    </a>
                                    <div style="font-size: 0.68rem; color: #94a3b8; margin-top: 1px;">
                                        {{ $pasca->companyProfile?->name ?? ($pasca->zoning ?? 'Kawasan Perumahan') }}
                                    </div>
                                </td>
                                <td style="color: #64748b;">
                                    {{ $pasca->city ?? ($pasca->district ?? 'Jember') }}
                                </td>
                                <td style="color: #475569; font-weight: 500;">
                                    @if($pasca->area >= 10000)
                                        {{ number_format($pasca->area / 10000, 1, ',', '.') }} Ha
                                    @else
                                        {{ number_format($pasca->area, 0, ',', '.') }} m²
                                    @endif
                                </td>
                                <td style="text-align: center;">
                                    @if($isVerified)
                                        <span class="dash-badge green">Terverifikasi</span>
                                    @else
                                        <span class="dash-badge sky">Proses</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="dash-badge {{ $badgePasca }}">{{ $tahapPasca }}</span>
                                </td>
                                <td>
                                    <div class="dash-progress-wrap">
                                        <div class="dash-progress-bar-bg" style="width: 70px;">
                                            <div class="dash-progress-bar-fill" style="width: {{ $progPasca }}%; background-color: {{ $progPasca >= 70 ? '#7c3aed' : ($progPasca >= 40 ? '#0284c7' : '#ea580c') }};"></div>
                                        </div>
                                        <span style="font-size: 0.68rem; font-weight: 700; color: #334155;">{{ $progPasca }}%</span>
                                    </div>
                                </td>
                                <td style="text-align: center;">
                                    <a href="{{ route('properti.show', $pasca->id) }}" class="dash-action-btn" title="Detail Pasca Land Bank">
                                        <i class="mdi mdi-dots-horizontal"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" style="text-align: center; color: #94a3b8; padding: 24px;">Belum ada data tanah pasca land bank</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <!-- 4. BARIS 2: STATUS UNIT (COMPACT) & PROGRES PEMBANGUNAN (BERBASIS UNIT) -->
    <div class="dash-row-grid">
        
        <!-- Kartu Kiri: Status Unit (5 Unit Terbaru dari Catalog Unit) -->
        <div class="dash-panel">
            <div class="dash-panel-header">
                <div class="dash-panel-title-wrap">
                    <div class="dash-panel-icon">
                        <i class="mdi mdi-home-outline"></i>
                    </div>
                    <div>
                        <h2 class="dash-panel-title">Status Unit</h2>
                        <p class="dash-panel-subtitle">5 unit terbaru dari katalog unit properti</p>
                    </div>
                </div>
                <a href="{{ route('marketing.jual-unit') }}" class="dash-link-all">
                    Lihat Semua <i class="mdi mdi-arrow-right"></i>
                </a>
            </div>

            <!-- Mini Summary Status Badges (Kompak seperti Status Perizinan) -->
            <div class="dash-perizinan-summary">
                <div class="dash-perizinan-box green">
                    <div class="label">Tersedia</div>
                    <div class="num">{{ $unitStats['ready'] }}</div>
                </div>
                <div class="dash-perizinan-box blue">
                    <div class="label">Booking</div>
                    <div class="num">{{ $unitStats['booking'] }}</div>
                </div>
                <div class="dash-perizinan-box purple">
                    <div class="label">Terjual</div>
                    <div class="num">{{ $unitStats['sold'] }}</div>
                </div>
                <div class="dash-perizinan-box amber">
                    <div class="label">KPR</div>
                    <div class="num">{{ $unitStats['kpr'] }}</div>
                </div>
            </div>

            <!-- Tabel Data 5 Unit Terbaru dari Catalog Unit -->
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
                        @forelse($recentCatalogUnits as $cuIdx => $cu)
                            @php
                                $cuStatus = strtolower($cu->status ?? 'ready');
                                $cuBadge = match(true) {
                                    in_array($cuStatus, ['ready', 'tersedia', 'available', 'draft']) => 'green',
                                    in_array($cuStatus, ['booked', 'booking']) => 'yellow',
                                    in_array($cuStatus, ['sold', 'terjual']) => 'purple',
                                    default => 'gray'
                                };
                                $cuLabel = match(true) {
                                    in_array($cuStatus, ['ready', 'tersedia', 'available', 'draft']) => 'Tersedia',
                                    in_array($cuStatus, ['booked', 'booking']) => 'Booking',
                                    in_array($cuStatus, ['sold', 'terjual']) => 'Terjual',
                                    default => ucfirst($cuStatus)
                                };
                            @endphp
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
                                    <span class="dash-badge {{ $cuBadge }}">
                                        {{ $cuLabel }}
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
                                <td colspan="6" style="text-align: center; color: #94a3b8; padding: 24px;">Belum ada data unit di katalog</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
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
                <a href="{{ route('proyek.unit.index') }}" class="dash-link-all">
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
                                    <a href="{{ route('proyek.unit.index', ['search' => $u->block . '.' . $u->unit_number]) }}" style="font-weight: 700; color: #0f172a; text-decoration: none;" class="hover-primary" title="Buka di Unit Proyek">
                                        Blok {{ $u->block }}.{{ $u->unit_number }} {{ $u->unit_name }}
                                    </a>
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
                                    <a href="{{ route('proyek.unit.index', ['search' => $u->block . '.' . $u->unit_number]) }}" class="dash-action-btn" title="Buka di Unit Proyek">
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

    <!-- 5. BARIS 3: MARKETING & TRANSAKSI (STATUS KPR DI KIRI & 5 BOOKING TERKINI DI KANAN) -->
    <div class="dash-row-grid">
        
        <!-- Kartu Kiri: Status & Tahapan KPR (5 Booking KPR Terbaru) -->
        <div class="dash-panel">
            <div class="dash-panel-header">
                <div class="dash-panel-title-wrap">
                    <div class="dash-panel-icon" style="background-color: #ede9fe; color: #7c3aed;">
                        <i class="mdi mdi-bank-check"></i>
                    </div>
                    <div>
                        <h2 class="dash-panel-title">Status & Tahapan KPR</h2>
                        <p class="dash-panel-subtitle">5 pengajuan KPR & status tahapan bank</p>
                    </div>
                </div>
                <a href="{{ route('customer.kpr') }}" class="dash-link-all">
                    Lihat Semua <i class="mdi mdi-arrow-right"></i>
                </a>
            </div>

            <!-- Tabel Data 5 KPR Terbaru -->
            <div class="dash-table-wrap">
                <table class="dash-table">
                    <thead>
                        <tr>
                            <th style="width: 28px; text-align: center;">No</th>
                            <th>Konsumen / Unit</th>
                            <th>Proyek</th>
                            <th>Bank / Tipe</th>
                            <th style="text-align: center;">Tahapan KPR</th>
                            <th style="width: 32px; text-align: center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentKprBookings as $kIdx => $kpr)
                            @php
                                $kprApp = $kpr->kprApplication;
                                $appStatus = strtolower($kprApp?->status ?? '');
                                $revisiCount = $kprApp?->documents?->where('status', 'revisi')->count() ?? 0;
                                $isAkadDone = ($kpr->status_akad === 'done') 
                                    || in_array(strtolower($kpr->status ?? ''), ['completed', 'sold', 'lunas', 'akad_selesai']) 
                                    || in_array($appStatus, ['akad', 'completed', 'lunas']);

                                if ($isAkadDone) {
                                    $kprBadge = 'green';
                                    $kprLabel = 'Akad Selesai';
                                } elseif ($appStatus === 'approved') {
                                    $kprBadge = 'teal';
                                    $kprLabel = 'SP3K Disetujui';
                                } elseif ($appStatus === 'survey') {
                                    $kprBadge = 'blue';
                                    $kprLabel = 'Survey Bank';
                                } elseif ($revisiCount > 0) {
                                    $kprBadge = 'amber';
                                    $kprLabel = 'Revisi Berkas (' . $revisiCount . ')';
                                } elseif ($appStatus === 'rejected') {
                                    $kprBadge = 'red';
                                    $kprLabel = 'Ditolak Bank';
                                } elseif ($kprApp) {
                                    $kprBadge = 'sky';
                                    $kprLabel = 'Verifikasi Berkas';
                                } else {
                                    $kprBadge = 'gray';
                                    $kprLabel = 'Booking Awal';
                                }
                            @endphp
                            <tr>
                                <td style="font-weight: 700; text-align: center;">{{ $kIdx + 1 }}</td>
                                <td>
                                    <div style="font-weight: 700; color: #0f172a;">
                                        {{ $kpr->customer->full_name ?? ($kpr->customer->name ?? '-') }}
                                    </div>
                                    <div style="font-size: 0.68rem; color: #64748b; margin-top: 1px;">
                                        Blok {{ $kpr->unit?->block ?? '-' }}.{{ $kpr->unit?->unit_number ?? '-' }} {{ $kpr->unit?->unit_name ?? '' }}
                                    </div>
                                </td>
                                <td>
                                    <div style="color: #334155; font-weight: 600; font-size: 0.74rem;">
                                        {{ $kpr->unit?->landBank?->name ?? 'Proyek' }}
                                    </div>
                                    <div style="font-size: 0.68rem; color: #94a3b8;">
                                        {{ $kpr->unit?->landBank?->city ?? 'Jember' }}
                                    </div>
                                </td>
                                <td>
                                    <div style="font-weight: 600; color: #1e293b; font-size: 0.74rem;">
                                        {{ $kprApp?->bank?->name ?? 'Bank Pengajuan' }}
                                    </div>
                                    <div style="font-size: 0.68rem; color: #64748b;">
                                        {{ $kpr->unit?->jenis ? ucfirst($kpr->unit->jenis) : 'Subsidi' }} {{ $kpr->unit?->type ? 'T.' . $kpr->unit->type : '' }}
                                    </div>
                                </td>
                                <td style="text-align: center;">
                                    <span class="dash-badge {{ $kprBadge }}">
                                        {{ $kprLabel }}
                                    </span>
                                </td>
                                <td style="text-align: center;">
                                    <a href="{{ route('transaksi.kpr.approve', $kpr->id) }}" class="dash-action-btn" title="Detail Verifikasi KPR">
                                        <i class="mdi mdi-dots-horizontal"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" style="text-align: center; color: #94a3b8; padding: 24px;">Belum ada pengajuan KPR aktif</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Kartu Kanan: Transaksi Booking Terkini (5 Booking Terbaru Semua Skema) -->
        <div class="dash-panel">
            <div class="dash-panel-header">
                <div class="dash-panel-title-wrap">
                    <div class="dash-panel-icon" style="background-color: #e0f2fe; color: #0284c7;">
                        <i class="mdi mdi-clipboard-text-clock-outline"></i>
                    </div>
                    <div>
                        <h2 class="dash-panel-title">Transaksi Booking Terkini</h2>
                        <p class="dash-panel-subtitle">5 transaksi booking unit (KPR, Cash & Tempo)</p>
                    </div>
                </div>
                <a href="{{ route('marketing.list_pengajuan') }}" class="dash-link-all">
                    Lihat Semua <i class="mdi mdi-arrow-right"></i>
                </a>
            </div>

            <!-- Tabel Data 5 Booking Terkini -->
            <div class="dash-table-wrap">
                <table class="dash-table">
                    <thead>
                        <tr>
                            <th style="width: 28px; text-align: center;">No</th>
                            <th>Konsumen</th>
                            <th>Unit / Proyek</th>
                            <th>Skema Bayar</th>
                            <th>Harga / UTJ</th>
                            <th style="text-align: center;">Status Unit</th>
                            <th style="width: 32px; text-align: center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentAllBookings as $bIdx => $bk)
                            @php
                                $ptype = strtolower($bk->purchase_type ?? 'kpr');
                                $skemaBadge = match(true) {
                                    str_contains($ptype, 'tempo') => 'orange',
                                    str_contains($ptype, 'cash') => 'green',
                                    default => 'blue'
                                };
                                $skemaLabel = match(true) {
                                    str_contains($ptype, 'tempo') => 'Cash Tempo',
                                    str_contains($ptype, 'cash') => 'Cash Keras',
                                    default => 'KPR'
                                };

                                $uStat = strtolower($bk->unit?->status ?? 'booked');
                                $unitBadge = match(true) {
                                    in_array($uStat, ['sold', 'terjual']) => 'purple',
                                    in_array($uStat, ['booked', 'booking']) => 'yellow',
                                    in_array($uStat, ['ready', 'tersedia']) => 'green',
                                    default => 'gray'
                                };
                                $unitLabel = match(true) {
                                    in_array($uStat, ['sold', 'terjual']) => 'Terjual',
                                    in_array($uStat, ['booked', 'booking']) => 'Booking',
                                    in_array($uStat, ['ready', 'tersedia']) => 'Tersedia',
                                    default => ucfirst($uStat)
                                };
                            @endphp
                            <tr>
                                <td style="font-weight: 700; text-align: center;">{{ $bIdx + 1 }}</td>
                                <td>
                                    <div style="font-weight: 700; color: #0f172a;">
                                        {{ $bk->customer->full_name ?? ($bk->customer->name ?? '-') }}
                                    </div>
                                    <div style="font-size: 0.68rem; color: #94a3b8; margin-top: 1px;">
                                        Sales: {{ $bk->sales?->name ?? '-' }}
                                    </div>
                                </td>
                                <td>
                                    <div style="font-weight: 600; color: #1e293b; font-size: 0.76rem;">
                                        Blok {{ $bk->unit?->block ?? '-' }}.{{ $bk->unit?->unit_number ?? '-' }} {{ $bk->unit?->unit_name ?? '' }}
                                    </div>
                                    <div style="font-size: 0.68rem; color: #64748b;">
                                        {{ $bk->unit?->landBank?->name ?? 'Proyek' }}
                                    </div>
                                </td>
                                <td>
                                    <span class="dash-badge {{ $skemaBadge }}">
                                        {{ $skemaLabel }}
                                    </span>
                                </td>
                                <td>
                                    <div style="font-weight: 700; color: #16a34a; font-size: 0.78rem;">
                                        Rp {{ number_format($bk->unit?->price ?? 0, 0, ',', '.') }}
                                    </div>
                                    <div style="font-size: 0.68rem; color: #64748b;">
                                        UTJ: Rp {{ number_format($bk->booking_fee ?? 0, 0, ',', '.') }}
                                    </div>
                                </td>
                                <td style="text-align: center;">
                                    <span class="dash-badge {{ $unitBadge }}">
                                        {{ $unitLabel }}
                                    </span>
                                </td>
                                <td style="text-align: center;">
                                    <a href="{{ route('marketing.list_pengajuan') }}" class="dash-action-btn" title="Detail Pengajuan Booking">
                                        <i class="mdi mdi-dots-horizontal"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" style="text-align: center; color: #94a3b8; padding: 24px;">Belum ada transaksi booking tercatat</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <!-- 6. BARIS 4: TUGAS TIM TERBARU & RINGKASAN PENJUALAN & KEUANGAN (SEIMBANG & RAPI) -->
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
