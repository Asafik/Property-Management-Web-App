<?php $__env->startSection('title', 'Dashboard - Property Management App'); ?>

<?php $__env->startPush('styles'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/dashboard-clean.css')); ?>?v=<?php echo e(time()); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="dash-wrapper">

    <!-- 1. HEADER SECTION -->
    <div class="dash-header">
        <!-- Kiri: Greeting Title & Subtitle -->
        <div>
            <h1 class="dash-header-title">
                Selamat datang, <?php echo e(auth()->user()->name ?? 'Admin'); ?>

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
                    <?php echo e(\Carbon\Carbon::now()->locale('id')->translatedFormat('l, d F Y')); ?>

                </div>
                <div class="dash-header-date-sub">
                    Selamat bekerja, <?php echo e(auth()->user()->name ?? 'Admin'); ?>!
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
                    <div class="dash-kpi-val"><?php echo e($totalProperty ?? 0); ?></div>
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
                    <div class="dash-kpi-val"><?php echo e(number_format($totalUnit ?? 0, 0, ',', '.')); ?></div>
                    <div class="dash-kpi-sub">Kavling & Unit Bangunan</div>
                </div>
            </div>
            <a href="<?php echo e(route('marketing.jual-unit')); ?>" class="dash-kpi-action blue" title="Lihat Unit">
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
                    <div class="dash-kpi-val">Rp <?php echo e(number_format($totalPendapatan ?? 0, 0, ',', '.')); ?></div>
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
                    <div class="dash-kpi-val">Rp <?php echo e(number_format($totalPiutang ?? 0, 0, ',', '.')); ?></div>
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
                <a href="#" class="dash-link-all">
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
                        <!-- Row 1 -->
                        <tr>
                            <td style="font-weight: 700; text-align: center;">1</td>
                            <td style="font-weight: 700; color: #0f172a;">Perumahan Jember Indah</td>
                            <td style="color: #64748b;">Jember</td>
                            <td style="color: #475569; font-weight: 500;">5.2 Ha</td>
                            <td style="text-align: center;">
                                <span class="dash-badge gray" style="font-weight: 700;">120</span>
                            </td>
                            <td>
                                <span class="dash-badge blue">Pembangunan</span>
                            </td>
                            <td>
                                <div class="dash-progress-wrap">
                                    <div class="dash-progress-bar-bg">
                                        <div class="dash-progress-bar-fill" style="width: 78%; background-color: #7c3aed;"></div>
                                    </div>
                                    <span style="font-size: 0.68rem; font-weight: 700; color: #334155;">78%</span>
                                </div>
                            </td>
                            <td style="text-align: center;">
                                <button type="button" class="dash-action-btn">
                                    <i class="mdi mdi-dots-horizontal"></i>
                                </button>
                            </td>
                        </tr>

                        <!-- Row 2 -->
                        <tr>
                            <td style="font-weight: 700; text-align: center;">2</td>
                            <td style="font-weight: 700; color: #0f172a;">Kebonsari Village</td>
                            <td style="color: #64748b;">Jember</td>
                            <td style="color: #475569; font-weight: 500;">3.1 Ha</td>
                            <td style="text-align: center;">
                                <span class="dash-badge gray" style="font-weight: 700;">200</span>
                            </td>
                            <td>
                                <span class="dash-badge sky">Perizinan</span>
                            </td>
                            <td>
                                <div class="dash-progress-wrap">
                                    <div class="dash-progress-bar-bg">
                                        <div class="dash-progress-bar-fill" style="width: 62%; background-color: #0284c7;"></div>
                                    </div>
                                    <span style="font-size: 0.68rem; font-weight: 700; color: #334155;">62%</span>
                                </div>
                            </td>
                            <td style="text-align: center;">
                                <button type="button" class="dash-action-btn">
                                    <i class="mdi mdi-dots-horizontal"></i>
                                </button>
                            </td>
                        </tr>

                        <!-- Row 3 -->
                        <tr>
                            <td style="font-weight: 700; text-align: center;">3</td>
                            <td style="font-weight: 700; color: #0f172a;">Tanah Perumahan Kota</td>
                            <td style="color: #64748b;">Jember</td>
                            <td style="color: #475569; font-weight: 500;">4.8 Ha</td>
                            <td style="text-align: center;">
                                <span class="dash-badge gray" style="font-weight: 700;">150</span>
                            </td>
                            <td>
                                <span class="dash-badge teal">Legal</span>
                            </td>
                            <td>
                                <div class="dash-progress-wrap">
                                    <div class="dash-progress-bar-bg">
                                        <div class="dash-progress-bar-fill" style="width: 45%; background-color: #0d9488;"></div>
                                    </div>
                                    <span style="font-size: 0.68rem; font-weight: 700; color: #334155;">45%</span>
                                </div>
                            </td>
                            <td style="text-align: center;">
                                <button type="button" class="dash-action-btn">
                                    <i class="mdi mdi-dots-horizontal"></i>
                                </button>
                            </td>
                        </tr>

                        <!-- Row 4 -->
                        <tr>
                            <td style="font-weight: 700; text-align: center;">4</td>
                            <td style="font-weight: 700; color: #0f172a;">Jember Residence</td>
                            <td style="color: #64748b;">Jember</td>
                            <td style="color: #475569; font-weight: 500;">2.5 Ha</td>
                            <td style="text-align: center;">
                                <span class="dash-badge gray" style="font-weight: 700;">80</span>
                            </td>
                            <td>
                                <span class="dash-badge orange">Pemasaran</span>
                            </td>
                            <td>
                                <div class="dash-progress-wrap">
                                    <div class="dash-progress-bar-bg">
                                        <div class="dash-progress-bar-fill" style="width: 20%; background-color: #ea580c;"></div>
                                    </div>
                                    <span style="font-size: 0.68rem; font-weight: 700; color: #334155;">20%</span>
                                </div>
                            </td>
                            <td style="text-align: center;">
                                <button type="button" class="dash-action-btn">
                                    <i class="mdi mdi-dots-horizontal"></i>
                                </button>
                            </td>
                        </tr>

                        <!-- Row 5 -->
                        <tr>
                            <td style="font-weight: 700; text-align: center;">5</td>
                            <td style="font-weight: 700; color: #0f172a;">Tanah Sumbersari</td>
                            <td style="color: #64748b;">Jember</td>
                            <td style="color: #475569; font-weight: 500;">6.0 Ha</td>
                            <td style="text-align: center;">
                                <span class="dash-badge gray" style="font-weight: 700;">300</span>
                            </td>
                            <td>
                                <span class="dash-badge gray">Perencanaan</span>
                            </td>
                            <td>
                                <div class="dash-progress-wrap">
                                    <div class="dash-progress-bar-bg">
                                        <div class="dash-progress-bar-fill" style="width: 35%; background-color: #64748b;"></div>
                                    </div>
                                    <span style="font-size: 0.68rem; font-weight: 700; color: #334155;">35%</span>
                                </div>
                            </td>
                            <td style="text-align: center;">
                                <button type="button" class="dash-action-btn">
                                    <i class="mdi mdi-dots-horizontal"></i>
                                </button>
                            </td>
                        </tr>
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
                <a href="#" class="dash-link-all">
                    Lihat Semua <i class="mdi mdi-arrow-right"></i>
                </a>
            </div>

            <!-- Ringkasan Visual Status Perizinan (Mini Badges) -->
            <div class="dash-perizinan-summary">
                <div class="dash-perizinan-box gray">
                    <div class="label">Total Izin</div>
                    <div class="num">15</div>
                </div>
                <div class="dash-perizinan-box green">
                    <div class="label">Selesai</div>
                    <div class="num">6</div>
                </div>
                <div class="dash-perizinan-box blue">
                    <div class="label">Berjalan</div>
                    <div class="num">8</div>
                </div>
                <div class="dash-perizinan-box rose">
                    <div class="label">Tertunda</div>
                    <div class="num">1</div>
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
                        <!-- Row 1 -->
                        <tr>
                            <td style="font-weight: 700; text-align: center;">1</td>
                            <td style="font-weight: 700; color: #0f172a;">PERTEK</td>
                            <td style="text-align: center; font-weight: 700; color: #334155;">4</td>
                            <td style="text-align: center;">
                                <span class="dash-pill-count green">2</span>
                            </td>
                            <td style="text-align: center;">
                                <span class="dash-pill-count blue">2</span>
                            </td>
                            <td style="text-align: center;">
                                <span class="dash-pill-count gray">0</span>
                            </td>
                            <td style="text-align: center;">
                                <button type="button" class="dash-action-btn">
                                    <i class="mdi mdi-dots-horizontal"></i>
                                </button>
                            </td>
                        </tr>

                        <!-- Row 2 -->
                        <tr>
                            <td style="font-weight: 700; text-align: center;">2</td>
                            <td style="font-weight: 700; color: #0f172a;">PKKPR</td>
                            <td style="text-align: center; font-weight: 700; color: #334155;">3</td>
                            <td style="text-align: center;">
                                <span class="dash-pill-count green">2</span>
                            </td>
                            <td style="text-align: center;">
                                <span class="dash-pill-count blue">1</span>
                            </td>
                            <td style="text-align: center;">
                                <span class="dash-pill-count gray">0</span>
                            </td>
                            <td style="text-align: center;">
                                <button type="button" class="dash-action-btn">
                                    <i class="mdi mdi-dots-horizontal"></i>
                                </button>
                            </td>
                        </tr>

                        <!-- Row 3 -->
                        <tr>
                            <td style="font-weight: 700; text-align: center;">3</td>
                            <td style="font-weight: 700; color: #0f172a;">PBG (IMB)</td>
                            <td style="text-align: center; font-weight: 700; color: #334155;">5</td>
                            <td style="text-align: center;">
                                <span class="dash-pill-count green">1</span>
                            </td>
                            <td style="text-align: center;">
                                <span class="dash-pill-count blue">3</span>
                            </td>
                            <td style="text-align: center;">
                                <span class="dash-pill-count rose">1</span>
                            </td>
                            <td style="text-align: center;">
                                <button type="button" class="dash-action-btn">
                                    <i class="mdi mdi-dots-horizontal"></i>
                                </button>
                            </td>
                        </tr>

                        <!-- Row 4 -->
                        <tr>
                            <td style="font-weight: 700; text-align: center;">4</td>
                            <td style="font-weight: 700; color: #0f172a;">SLF</td>
                            <td style="text-align: center; font-weight: 700; color: #334155;">2</td>
                            <td style="text-align: center;">
                                <span class="dash-pill-count green">1</span>
                            </td>
                            <td style="text-align: center;">
                                <span class="dash-pill-count blue">1</span>
                            </td>
                            <td style="text-align: center;">
                                <span class="dash-pill-count gray">0</span>
                            </td>
                            <td style="text-align: center;">
                                <button type="button" class="dash-action-btn">
                                    <i class="mdi mdi-dots-horizontal"></i>
                                </button>
                            </td>
                        </tr>

                        <!-- Row 5 -->
                        <tr>
                            <td style="font-weight: 700; text-align: center;">5</td>
                            <td style="font-weight: 700; color: #0f172a;">Perubahan Tata Ruang</td>
                            <td style="text-align: center; font-weight: 700; color: #334155;">1</td>
                            <td style="text-align: center;">
                                <span class="dash-pill-count gray">0</span>
                            </td>
                            <td style="text-align: center;">
                                <span class="dash-pill-count blue">1</span>
                            </td>
                            <td style="text-align: center;">
                                <span class="dash-pill-count gray">0</span>
                            </td>
                            <td style="text-align: center;">
                                <button type="button" class="dash-action-btn">
                                    <i class="mdi mdi-dots-horizontal"></i>
                                </button>
                            </td>
                        </tr>
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
                <a href="<?php echo e(route('marketing.jual-unit')); ?>" class="dash-link-all">
                    Lihat Semua <i class="mdi mdi-arrow-right"></i>
                </a>
            </div>

            <!-- 4 Mini Cards Grid (COMPACT PADDING) -->
            <div class="dash-unit-grid">
                
                <!-- 1. Tersedia -->
                <div class="dash-unit-card green">
                    <div class="dash-unit-card-head">
                        <div class="dash-unit-icon green">
                            <i class="mdi mdi-home-check"></i>
                        </div>
                        <span class="dash-unit-name">Tersedia</span>
                    </div>
                    <div class="dash-unit-val">620</div>
                    <div class="dash-unit-pct green">
                        ● 49.7%
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
                    <div class="dash-unit-val">180</div>
                    <div class="dash-unit-pct blue">
                        ● 14.4%
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
                    <div class="dash-unit-val">420</div>
                    <div class="dash-unit-pct purple">
                        ● 33.7%
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
                    <div class="dash-unit-val">28</div>
                    <div class="dash-unit-pct amber">
                        ● 2.2%
                    </div>
                </div>

            </div>

            <!-- Visual Proposi Bar (Rasio Keseluruhan Unit) -->
            <div class="dash-unit-ratio">
                <span>Rasio Komposisi Unit:</span>
                <div class="dash-ratio-bar">
                    <div class="dash-ratio-segment" style="width: 49.7%; background-color: #10b981;" title="Tersedia 49.7%"></div>
                    <div class="dash-ratio-segment" style="width: 14.4%; background-color: #3b82f6;" title="Booking 14.4%"></div>
                    <div class="dash-ratio-segment" style="width: 33.7%; background-color: #a855f7;" title="Terjual 33.7%"></div>
                    <div class="dash-ratio-segment" style="width: 2.2%; background-color: #f59e0b;" title="KPR 2.2%"></div>
                </div>
                <span style="font-weight: 700; color: #334155;">Total 1.248</span>
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
                <a href="#" class="dash-link-all">
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
                        <!-- Row 1 -->
                        <tr>
                            <td style="font-weight: 700; text-align: center;">1</td>
                            <td>
                                <div style="font-weight: 700; color: #0f172a;">Blok A.1 Mawar</div>
                                <div style="font-size: 0.68rem; color: #94a3b8; margin-top: 1px;">Perumahan Jember Indah</div>
                            </td>
                            <td style="color: #64748b; font-weight: 500;">Des 2025</td>
                            <td>
                                <div class="dash-progress-wrap">
                                    <div class="dash-progress-bar-bg" style="width: 80px;">
                                        <div class="dash-progress-bar-fill" style="width: 78%; background-color: #7c3aed;"></div>
                                    </div>
                                    <span style="font-size: 0.75rem; font-weight: 800; color: #0f172a; width: 30px; text-align: right;">78%</span>
                                </div>
                            </td>
                            <td style="text-align: center;">
                                <span class="dash-status-pill on-track">
                                    <span class="dot"></span> On Track
                                </span>
                            </td>
                            <td style="text-align: center;">
                                <button type="button" class="dash-action-btn">
                                    <i class="mdi mdi-dots-horizontal"></i>
                                </button>
                            </td>
                        </tr>

                        <!-- Row 2 -->
                        <tr>
                            <td style="font-weight: 700; text-align: center;">2</td>
                            <td>
                                <div style="font-weight: 700; color: #0f172a;">Blok B.3 Melati</div>
                                <div style="font-size: 0.68rem; color: #94a3b8; margin-top: 1px;">Kebonsari Village</div>
                            </td>
                            <td style="color: #64748b; font-weight: 500;">Mar 2026</td>
                            <td>
                                <div class="dash-progress-wrap">
                                    <div class="dash-progress-bar-bg" style="width: 80px;">
                                        <div class="dash-progress-bar-fill" style="width: 62%; background-color: #0284c7;"></div>
                                    </div>
                                    <span style="font-size: 0.75rem; font-weight: 800; color: #0f172a; width: 30px; text-align: right;">62%</span>
                                </div>
                            </td>
                            <td style="text-align: center;">
                                <span class="dash-status-pill on-track">
                                    <span class="dot"></span> On Track
                                </span>
                            </td>
                            <td style="text-align: center;">
                                <button type="button" class="dash-action-btn">
                                    <i class="mdi mdi-dots-horizontal"></i>
                                </button>
                            </td>
                        </tr>

                        <!-- Row 3 -->
                        <tr>
                            <td style="font-weight: 700; text-align: center;">3</td>
                            <td>
                                <div style="font-weight: 700; color: #0f172a;">Blok C.5 Anggrek</div>
                                <div style="font-size: 0.68rem; color: #94a3b8; margin-top: 1px;">Jember Residence</div>
                            </td>
                            <td style="color: #64748b; font-weight: 500;">Des 2025</td>
                            <td>
                                <div class="dash-progress-wrap">
                                    <div class="dash-progress-bar-bg" style="width: 80px;">
                                        <div class="dash-progress-bar-fill" style="width: 45%; background-color: #ea580c;"></div>
                                    </div>
                                    <span style="font-size: 0.75rem; font-weight: 800; color: #0f172a; width: 30px; text-align: right;">45%</span>
                                </div>
                            </td>
                            <td style="text-align: center;">
                                <span class="dash-status-pill warning">
                                    <span class="dot"></span> Perhatian
                                </span>
                            </td>
                            <td style="text-align: center;">
                                <button type="button" class="dash-action-btn">
                                    <i class="mdi mdi-dots-horizontal"></i>
                                </button>
                            </td>
                        </tr>

                        <!-- Row 4 -->
                        <tr>
                            <td style="font-weight: 700; text-align: center;">4</td>
                            <td>
                                <div style="font-weight: 700; color: #0f172a;">Blok D.2 Kenanga</div>
                                <div style="font-size: 0.68rem; color: #94a3b8; margin-top: 1px;">Taman Asri</div>
                            </td>
                            <td style="color: #64748b; font-weight: 500;">Jun 2025</td>
                            <td>
                                <div class="dash-progress-wrap">
                                    <div class="dash-progress-bar-bg" style="width: 80px;">
                                        <div class="dash-progress-bar-fill" style="width: 20%; background-color: #64748b;"></div>
                                    </div>
                                    <span style="font-size: 0.75rem; font-weight: 800; color: #0f172a; width: 30px; text-align: right;">20%</span>
                                </div>
                            </td>
                            <td style="text-align: center;">
                                <span class="dash-status-pill danger">
                                    <span class="dot"></span> Terlambat
                                </span>
                            </td>
                            <td style="text-align: center;">
                                <button type="button" class="dash-action-btn">
                                    <i class="mdi mdi-dots-horizontal"></i>
                                </button>
                            </td>
                        </tr>
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
                    <a href="#" class="dash-link-all">
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
                                <th>Divisi</th>
                                <th>Deadline</th>
                                <th style="text-align: center;">Status</th>
                                <th style="width: 32px; text-align: center;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Row 1 -->
                            <tr>
                                <td style="font-weight: 700; text-align: center;">1</td>
                                <td style="font-weight: 700; color: #0f172a;">Verifikasi dokumen KPR</td>
                                <td style="color: #475569;">Tanah Jember</td>
                                <td style="color: #64748b;">Marketing</td>
                                <td style="color: #64748b;">15 Sep 2025</td>
                                <td style="text-align: center;">
                                    <span class="dash-badge blue">Menunggu</span>
                                </td>
                                <td style="text-align: center;">
                                    <button type="button" class="dash-action-btn">
                                        <i class="mdi mdi-dots-horizontal"></i>
                                    </button>
                                </td>
                            </tr>

                            <!-- Row 2 -->
                            <tr>
                                <td style="font-weight: 700; text-align: center;">2</td>
                                <td style="font-weight: 700; color: #0f172a;">Upload akta tanah</td>
                                <td style="color: #475569;">Kebonsari Village</td>
                                <td style="color: #64748b;">Legal</td>
                                <td style="color: #64748b;">16 Sep 2025</td>
                                <td style="text-align: center;">
                                    <span class="dash-badge red">Terlambat</span>
                                </td>
                                <td style="text-align: center;">
                                    <button type="button" class="dash-action-btn">
                                        <i class="mdi mdi-dots-horizontal"></i>
                                    </button>
                                </td>
                            </tr>

                            <!-- Row 3 -->
                            <tr>
                                <td style="font-weight: 700; text-align: center;">3</td>
                                <td style="font-weight: 700; color: #0f172a;">Progress pembangunan Blok A</td>
                                <td style="color: #475569;">Jember Residence</td>
                                <td style="color: #64748b;">Proyek</td>
                                <td style="color: #64748b;">16 Sep 2025</td>
                                <td style="text-align: center;">
                                    <span class="dash-badge green">Berjalan</span>
                                </td>
                                <td style="text-align: center;">
                                    <button type="button" class="dash-action-btn">
                                        <i class="mdi mdi-dots-horizontal"></i>
                                    </button>
                                </td>
                            </tr>

                            <!-- Row 4 -->
                            <tr>
                                <td style="font-weight: 700; text-align: center;">4</td>
                                <td style="font-weight: 700; color: #0f172a;">Follow up pembayaran</td>
                                <td style="color: #475569;">Tanah Jember</td>
                                <td style="color: #64748b;">Keuangan</td>
                                <td style="color: #64748b;">16 Sep 2025</td>
                                <td style="text-align: center;">
                                    <span class="dash-badge yellow">Proses</span>
                                </td>
                                <td style="text-align: center;">
                                    <button type="button" class="dash-action-btn">
                                        <i class="mdi mdi-dots-horizontal"></i>
                                    </button>
                                </td>
                            </tr>

                            <!-- Row 5 -->
                            <tr>
                                <td style="font-weight: 700; text-align: center;">5</td>
                                <td style="font-weight: 700; color: #0f172a;">Pengurusan PERTEK</td>
                                <td style="color: #475569;">Jember Indah</td>
                                <td style="color: #64748b;">Legal</td>
                                <td style="color: #64748b;">17 Sep 2025</td>
                                <td style="text-align: center;">
                                    <span class="dash-badge yellow">Proses</span>
                                </td>
                                <td style="text-align: center;">
                                    <button type="button" class="dash-action-btn">
                                        <i class="mdi mdi-dots-horizontal"></i>
                                    </button>
                                </td>
                            </tr>
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
                    <a href="#" class="dash-link-all">
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
                            <div class="dash-finance-mini-val">420</div>
                        </div>
                    </div>

                    <!-- 2. Nilai Penjualan -->
                    <div class="dash-finance-mini-card purple">
                        <div class="dash-finance-mini-icon purple">
                            <i class="mdi mdi-tag-outline"></i>
                        </div>
                        <div class="dash-finance-mini-info">
                            <div class="dash-finance-mini-label">Nilai Penjualan</div>
                            <div class="dash-finance-mini-val">62.4 M</div>
                        </div>
                    </div>

                    <!-- 3. Uang Diterima -->
                    <div class="dash-finance-mini-card green">
                        <div class="dash-finance-mini-icon green">
                            <i class="mdi mdi-wallet-outline"></i>
                        </div>
                        <div class="dash-finance-mini-info">
                            <div class="dash-finance-mini-label">Uang Diterima</div>
                            <div class="dash-finance-mini-val">58.0 M</div>
                        </div>
                    </div>

                    <!-- 4. Piutang Penjualan -->
                    <div class="dash-finance-mini-card rose">
                        <div class="dash-finance-mini-icon rose">
                            <i class="mdi mdi-file-document-outline"></i>
                        </div>
                        <div class="dash-finance-mini-info">
                            <div class="dash-finance-mini-label">Piutang</div>
                            <div class="dash-finance-mini-val">4.3 M</div>
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
                            <div style="font-size: 1rem; font-weight: 800; color: #0f172a; margin-top: 2px;">Rp 28.750.000.000</div>
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
                            <div style="font-size: 1rem; font-weight: 800; color: #15803d; margin-top: 2px;">Rp 29.330.000.000</div>
                            <div style="font-size: 0.65rem; color: #94a3b8;">Kas masuk - kas keluar</div>
                        </div>
                    </div>

                </div>

            </div>
        </div>

    </div>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.partial.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Property-Management-Web-App\resources\views/dashboard.blade.php ENDPATH**/ ?>