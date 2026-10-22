@extends('layouts.partial.app')

@section('title', ($isStaffLegal ?? false) ? 'Dashboard Staff Legal - Property Management App' : 'Dashboard Kepala Legal - Property Management App')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard-clean.css') }}?v={{ time() }}">
    <style>
        .dash-badge.purple {
            background-color: #f3e8ff;
            color: #9333ea;
        }
        .dash-badge.teal {
            background-color: #ccfbf1;
            color: #0f766e;
        }
        .dash-badge.sky {
            background-color: #e0f2fe;
            color: #0284c7;
        }
        .dash-badge.orange {
            background-color: #ffedd5;
            color: #ea580c;
        }
        .dash-badge.yellow {
            background-color: #fef9c3;
            color: #a16207;
        }
        .dash-badge.blue {
            background-color: #dbeafe;
            color: #1d4ed8;
        }
        .dash-badge.green {
            background-color: #dcfce7;
            color: #15803d;
        }
        .dash-badge.red {
            background-color: #fee2e2;
            color: #b91c1c;
        }
        .dash-badge.gray {
            background-color: #f1f5f9;
            color: #64748b;
        }
        .btn-kelola-doc {
            background: linear-gradient(135deg, #0284c7, #0369a1);
            color: #ffffff !important;
            font-size: 0.74rem;
            font-weight: 700;
            padding: 5px 12px;
            border-radius: 6px;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            border: none;
            transition: all 0.15s ease;
            box-shadow: 0 1px 3px rgba(2, 132, 199, 0.25);
            text-decoration: none !important;
            white-space: nowrap;
        }
        .btn-kelola-doc:hover {
            background: linear-gradient(135deg, #0369a1, #075985);
            transform: translateY(-1px);
            color: #ffffff !important;
        }
    </style>
@endpush

@section('content')
<div class="dash-wrapper">

@if($isStaffLegal ?? false)
    {{-- ========================================================================= --}}
    {{-- ====================== DASHBOARD KHUSUS STAFF LEGAL ===================== --}}
    {{-- ========================================================================= --}}

    <!-- 1. HEADER SECTION STAFF LEGAL (TANPA BADGE) -->
    <div class="dash-header">
        <div>
            <h1 class="dash-header-title">
                Selamat datang, {{ auth()->user()->name ?? 'Staff Legal' }}
            </h1>
            <p class="dash-header-sub">
                Dashboard tugas harian, pengurusan perizinan dinas, dan pengunggahan berkas prasyarat.
            </p>
        </div>

        <div class="dash-header-date-box">
            <div class="dash-header-date-icon">
                <i class="mdi mdi-calendar-month-outline"></i>
            </div>
            <div>
                <div class="dash-header-date-text">
                    {{ \Carbon\Carbon::now()->locale('id')->translatedFormat('l, d F Y') }}
                </div>
                <div class="dash-header-date-sub">
                    {{ $myTasksCount ?? 0 }} Tugas Dikelola
                </div>
            </div>
        </div>
    </div>

    <!-- 2. 4 METRIC CARDS GRID KHUSUS TUGAS STAFF LEGAL -->
    <div class="dash-kpi-grid">
        
        <!-- Card 1: Total Tugas Saya (Ungu) -->
        <div class="dash-kpi-card">
            <div class="dash-kpi-left">
                <div class="dash-kpi-icon purple">
                    <i class="mdi mdi-clipboard-account-outline"></i>
                </div>
                <div class="dash-kpi-info">
                    <div class="dash-kpi-label">Tugas Saya</div>
                    <div class="dash-kpi-val">{{ $myTasksCount ?? 0 }}</div>
                    <div class="dash-kpi-sub">Total Tanggung Jawab</div>
                </div>
            </div>
            <a href="#tugasSayaSection" class="dash-kpi-action purple" title="Lihat Tugas Saya">
                <i class="mdi mdi-arrow-right"></i>
            </a>
        </div>

        <!-- Card 2: Sedang Diproses (Biru) -->
        <div class="dash-kpi-card">
            <div class="dash-kpi-left">
                <div class="dash-kpi-icon blue">
                    <i class="mdi mdi-clock-outline"></i>
                </div>
                <div class="dash-kpi-info">
                    <div class="dash-kpi-label">Sedang Diproses</div>
                    <div class="dash-kpi-val">{{ $myTasksActive ?? 0 }}</div>
                    <div class="dash-kpi-sub">Proses Dinas & Lapangan</div>
                </div>
            </div>
            <a href="#tugasSayaSection" class="dash-kpi-action blue" title="Tugas Berjalan">
                <i class="mdi mdi-arrow-right"></i>
            </a>
        </div>

        <!-- Card 3: Perlu Revisi / Kendala (Rose / Merah) -->
        <div class="dash-kpi-card">
            <div class="dash-kpi-left">
                <div class="dash-kpi-icon rose">
                    <i class="mdi mdi-alert-circle-outline"></i>
                </div>
                <div class="dash-kpi-info">
                    <div class="dash-kpi-label">Perlu Tindak Lanjut</div>
                    <div class="dash-kpi-val">{{ $myTasksProblem ?? 0 }}</div>
                    <div class="dash-kpi-sub">
                        {{ ($myTasksProblem ?? 0) > 0 ? 'Segera Perbaiki Berkas' : 'Tidak Ada Kendala' }}
                    </div>
                </div>
            </div>
            <a href="#tugasSayaSection" class="dash-kpi-action rose" title="Lihat Kendala">
                <i class="mdi mdi-arrow-right"></i>
            </a>
        </div>

        <!-- Card 4: Tugas Selesai (Hijau Mint) -->
        <div class="dash-kpi-card">
            <div class="dash-kpi-left">
                <div class="dash-kpi-icon green">
                    <i class="mdi mdi-checkbox-marked-circle-outline"></i>
                </div>
                <div class="dash-kpi-info">
                    <div class="dash-kpi-label">Tugas Selesai</div>
                    <div class="dash-kpi-val">{{ $myTasksDone ?? 0 }}</div>
                    <div class="dash-kpi-sub">Dokumen Resmi Terbit</div>
                </div>
            </div>
            <a href="#tugasSayaSection" class="dash-kpi-action green" title="Tugas Selesai">
                <i class="mdi mdi-arrow-right"></i>
            </a>
        </div>

    </div>

    <!-- 3. TABEL UTAMA: AGENDA & TUGAS PERIZINAN SAYA (FULL WIDTH) -->
    <div id="tugasSayaSection" class="dash-panel mb-3">
        <div class="dash-panel-header">
            <div class="dash-panel-title-wrap">
                <div class="dash-panel-icon" style="background: rgba(2, 132, 199, 0.12); color: #0284c7;">
                    <i class="mdi mdi-clipboard-list-outline"></i>
                </div>
                <div>
                    <h2 class="dash-panel-title">Agenda & Tugas Perizinan Saya</h2>
                    <p class="dash-panel-subtitle">Daftar izin yang ditugaskan kepada Anda. Klik untuk melengkapi berkas atau update progres.</p>
                </div>
            </div>
            <span class="dash-badge sky fw-bold" style="font-size: 0.76rem;">
                {{ $myTasksCount ?? 0 }} Tugas Terdaftar
            </span>
        </div>

        <div class="dash-table-wrap">
            <table class="dash-table">
                <thead>
                    <tr>
                        <th style="width: 32px; text-align: center;">No</th>
                        <th>Dokumen / Tugas Perizinan</th>
                        <th>Nomor Dokumen / SK</th>
                        <th>Kawasan Proyek</th>
                        <th>Instansi Dinas</th>
                        <th>Tenggat (Deadline)</th>
                        <th>Progres Berkas</th>
                        <th style="text-align: center;">Status</th>
                        <th style="width: 140px; text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($myTasks as $idx => $t)
                        @php
                            $taskStatus = strtolower($t->status ?? '');
                            $taskBadge = match(true) {
                                str_contains($taskStatus, 'selesai') || str_contains($taskStatus, 'terbit') => 'green',
                                str_contains($taskStatus, 'kendala') || str_contains($taskStatus, 'terlambat') || str_contains($taskStatus, 'revisi') => 'red',
                                str_contains($taskStatus, 'proses') || str_contains($taskStatus, 'berjalan') => 'yellow',
                                default => 'blue'
                            };

                            $isNearDeadline = false;
                            if ($t->deadline) {
                                $diffDays = now()->diffInDays(\Carbon\Carbon::parse($t->deadline), false);
                                if ($diffDays <= 3 && !str_contains($taskStatus, 'selesai') && !str_contains($taskStatus, 'terbit')) {
                                    $isNearDeadline = true;
                                }
                            }
                        @endphp
                        <tr>
                            <td style="font-weight: 700; text-align: center;">{{ $idx + 1 }}</td>
                            <td>
                                <div style="font-weight: 700; color: #0f172a; font-size: 0.86rem;">
                                    {{ $t->nama_tugas }}
                                </div>
                            </td>
                            <td>
                                @if($t->nomor_dokumen)
                                    <span class="dash-badge" style="background: #f1f5f9; color: #1e293b; border: 1px solid #cbd5e1; font-family: 'SFMono-Regular', Consolas, 'Liberation Mono', Menlo, monospace; font-size: 0.74rem; font-weight: 700; padding: 3px 8px; border-radius: 6px; display: inline-flex; align-items: center; gap: 4px; letter-spacing: 0.01em;">
                                        <i class="mdi mdi-file-document-outline" style="color: #6366f1; font-size: 0.82rem;"></i>
                                        {{ $t->nomor_dokumen }}
                                    </span>
                                @else
                                    <span class="dash-badge" style="background: #f8fafc; color: #94a3b8; border: 1px dashed #cbd5e1; font-size: 0.7rem; font-weight: 500; padding: 2px 7px; border-radius: 6px;">
                                        Belum Terbit
                                    </span>
                                @endif
                            </td>
                            <td style="color: #475569; font-weight: 600;">
                                {{ $t->proyek?->land_name ?? ($t->proyek_nama ?? 'Kawasan Proyek') }}
                            </td>
                            <td style="color: #64748b; font-size: 0.8rem;">
                                {{ $t->instansi ?: 'Dinas Terkait' }}
                            </td>
                            <td>
                                @if($t->deadline)
                                    <div style="font-size: 0.8rem; font-weight: {{ $isNearDeadline ? '700' : '500' }}; color: {{ $isNearDeadline ? '#dc2626' : '#475569' }};">
                                        {{ \Carbon\Carbon::parse($t->deadline)->translatedFormat('d M Y') }}
                                        @if($isNearDeadline)
                                            <span class="badge bg-danger ms-1" style="font-size: 0.62rem; padding: 2px 4px;">Segera</span>
                                        @endif
                                    </div>
                                @else
                                    <span class="text-muted" style="font-size: 0.8rem;">-</span>
                                @endif
                            </td>
                            <td>
                                <div class="dash-progress-wrap" style="width: 110px;">
                                    <div class="dash-progress-bar-bg" style="width: 70px;">
                                        <div class="dash-progress-bar-fill" style="width: {{ $t->progress ?? 0 }}%; background: linear-gradient(90deg, #0284c7, #10b981);"></div>
                                    </div>
                                    <span style="font-size: 0.72rem; font-weight: 700; color: #0f172a;">{{ $t->progress ?? 0 }}%</span>
                                </div>
                            </td>
                            <td style="text-align: center;">
                                <span class="dash-badge {{ $taskBadge }}" style="padding: 4px 10px; font-weight: 700;">
                                    {{ $t->status ?: 'Menunggu' }}
                                </span>
                            </td>
                            <td style="text-align: center;">
                                <a href="{{ route('perizinan.dokumen.kelola', ['id' => $t->proyek_id, 'item_id' => $t->id]) }}" 
                                   class="btn-kelola-doc" title="Buka form kelola & upload berkas">
                                    <i class="mdi mdi-file-upload-outline"></i>
                                    <span>Kelola Berkas</span>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" style="text-align: center; color: #94a3b8; padding: 36px;">
                                <i class="mdi mdi-checkbox-marked-circle-outline fs-2 d-block mb-1 text-success"></i>
                                <span class="fw-bold">Belum ada tugas perizinan yang ditugaskan kepada Anda saat ini.</span>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- 4. BARIS 2: KAWASAN PROYEK SAYA & PANDUAN KERJA STAF -->
    <div class="dash-row-grid stretch">
        
        <!-- Panel Kiri: Kawasan Proyek yang Sedang Ditangani -->
        <div class="dash-panel">
            <div class="dash-panel-header">
                <div class="dash-panel-title-wrap">
                    <div class="dash-panel-icon" style="background: rgba(154, 85, 255, 0.12); color: #9a55ff;">
                        <i class="mdi mdi-office-building"></i>
                    </div>
                    <div>
                        <h2 class="dash-panel-title">Kawasan Proyek yang Saya Tangani</h2>
                        <p class="dash-panel-subtitle">Kawasan proyek aktif yang menjadi wilayah tugas Anda</p>
                    </div>
                </div>
            </div>

            <div class="dash-table-wrap">
                <table class="dash-table">
                    <thead>
                        <tr>
                            <th style="width: 32px; text-align: center;">No</th>
                            <th>Nama Kawasan</th>
                            <th>Lokasi</th>
                            <th>Luas</th>
                            <th style="width: 40px; text-align: center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($myProjects as $pIdx => $proj)
                            <tr>
                                <td style="font-weight: 700; text-align: center;">{{ $pIdx + 1 }}</td>
                                <td style="font-weight: 700; color: #0f172a;">{{ $proj->name }}</td>
                                <td style="color: #64748b;">{{ $proj->city ?? ($proj->district ?? 'Jember') }}</td>
                                <td style="color: #475569; font-weight: 600;">
                                    @if($proj->area >= 10000)
                                        {{ number_format($proj->area / 10000, 1, ',', '.') }} Ha
                                    @else
                                        {{ number_format($proj->area, 0, ',', '.') }} m²
                                    @endif
                                </td>
                                <td style="text-align: center;">
                                    <a href="{{ route('perizinan.show', $proj->id) }}" class="dash-action-btn" title="Lihat Daftar Perizinan Kawasan">
                                        <i class="mdi mdi-arrow-right"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" style="text-align: center; color: #94a3b8; padding: 24px;">Belum ada kawasan terkait</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Panel Kanan: Standar Alur Pelaksanaan Staf Legal -->
        <div class="dash-panel">
            <div class="dash-panel-header">
                <div class="dash-panel-title-wrap">
                    <div class="dash-panel-icon" style="background: rgba(16, 185, 129, 0.12); color: #10b981;">
                        <i class="mdi mdi-lightbulb-on-outline"></i>
                    </div>
                    <div>
                        <h2 class="dash-panel-title">Standar Alur Kerja Lapangan</h2>
                        <p class="dash-panel-subtitle">Pedoman ringkas pengurusan izin & kelengkapan berkas</p>
                    </div>
                </div>
            </div>

            <div style="padding: 1.15rem 1.25rem;">
                <!-- Step 1 -->
                <div style="display: flex; align-items: flex-start; padding: 13px 15px; background: #ffffff; border: 1px solid #e2e8f0; border-radius: 10px; margin-bottom: 12px; box-shadow: 0 1px 3px rgba(0,0,0,0.03); transition: all 0.2s ease;">
                    <div style="width: 28px; height: 28px; min-width: 28px; border-radius: 50%; background: #0284c7; color: #ffffff; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 0.8rem; margin-right: 14px; margin-top: 1px; box-shadow: 0 2px 4px rgba(2, 132, 199, 0.25);">
                        1
                    </div>
                    <div style="flex: 1;">
                        <div style="font-weight: 700; color: #0f172a; font-size: 0.84rem; line-height: 1.35; margin-bottom: 3px;">
                            Cek Checklist Prasyarat
                        </div>
                        <div style="color: #64748b; font-size: 0.75rem; line-height: 1.45;">
                            Buka tombol <span style="font-weight: 600; color: #0284c7;">"Kelola Berkas"</span> untuk melihat berkas prasyarat apa saja yang belum diunggah.
                        </div>
                    </div>
                </div>

                <!-- Step 2 -->
                <div style="display: flex; align-items: flex-start; padding: 13px 15px; background: #ffffff; border: 1px solid #e2e8f0; border-radius: 10px; margin-bottom: 12px; box-shadow: 0 1px 3px rgba(0,0,0,0.03); transition: all 0.2s ease;">
                    <div style="width: 28px; height: 28px; min-width: 28px; border-radius: 50%; background: #8b5cf6; color: #ffffff; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 0.8rem; margin-right: 14px; margin-top: 1px; box-shadow: 0 2px 4px rgba(139, 92, 246, 0.25);">
                        2
                    </div>
                    <div style="flex: 1;">
                        <div style="font-weight: 700; color: #0f172a; font-size: 0.84rem; line-height: 1.35; margin-bottom: 3px;">
                            Koordinasi Dinas & Catat Progres
                        </div>
                        <div style="color: #64748b; font-size: 0.75rem; line-height: 1.45;">
                            Tulis hasil koordinasi dengan dinas/kantor instansi pada kolom <span style="font-weight: 600; color: #8b5cf6;">Catatan Lapangan</span>.
                        </div>
                    </div>
                </div>

                <!-- Step 3 -->
                <div style="display: flex; align-items: flex-start; padding: 13px 15px; background: #ffffff; border: 1px solid #e2e8f0; border-radius: 10px; margin-bottom: 0; box-shadow: 0 1px 3px rgba(0,0,0,0.03); transition: all 0.2s ease;">
                    <div style="width: 28px; height: 28px; min-width: 28px; border-radius: 50%; background: #10b981; color: #ffffff; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 0.8rem; margin-right: 14px; margin-top: 1px; box-shadow: 0 2px 4px rgba(16, 185, 129, 0.25);">
                        3
                    </div>
                    <div style="flex: 1;">
                        <div style="font-weight: 700; color: #0f172a; font-size: 0.84rem; line-height: 1.35; margin-bottom: 3px;">
                            Unggah Berkas & SK Resmi
                        </div>
                        <div style="color: #64748b; font-size: 0.75rem; line-height: 1.45;">
                            Unggah berkas prasyarat atau SK izin resmi saat dokumen telah terbit, lalu simpan perubahan.
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@else
    {{-- ========================================================================= --}}
    {{-- ===================== DASHBOARD KHUSUS KEPALA LEGAL ===================== --}}
    {{-- ========================================================================= --}}

    <!-- 1. HEADER SECTION (TANPA BADGE ATAS) -->
    <div class="dash-header">
        <!-- Kiri: Greeting Title & Subtitle -->
        <div>
            <h1 class="dash-header-title">
                Selamat datang, {{ auth()->user()->name ?? 'Kepala Legal' }}
            </h1>
            <p class="dash-header-sub">
                Monitoring perizinan kawasan dan pengawasan penugasan staf legal.
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
                    Divisi Legalitas & Perizinan
                </div>
            </div>
        </div>
    </div>

    <!-- 2. 4 METRIC CARDS GRID (FOKUS PERIZINAN & KAWASAN - TANPA VALIDASI & TANPA KEUANGAN) -->
    <div class="dash-kpi-grid">
        
        <!-- Card 1: Total Tanah / Kawasan (Ungu) -->
        <div class="dash-kpi-card">
            <div class="dash-kpi-left">
                <div class="dash-kpi-icon purple">
                    <i class="mdi mdi-office-building"></i>
                </div>
                <div class="dash-kpi-info">
                    <div class="dash-kpi-label">Total Tanah / Kawasan</div>
                    <div class="dash-kpi-val">{{ $totalProperty ?? 0 }}</div>
                    <div class="dash-kpi-sub">{{ $totalPraTanah ?? 0 }} Prospek Pra-Tanah</div>
                </div>
            </div>
            <a href="#proyekTableSection" class="dash-kpi-action purple" title="Lihat Daftar Kawasan">
                <i class="mdi mdi-arrow-right"></i>
            </a>
        </div>

        <!-- Card 2: Total Dokumen Perizinan (Sky Blue) -->
        <div class="dash-kpi-card">
            <div class="dash-kpi-left">
                <div class="dash-kpi-icon blue">
                    <i class="mdi mdi-file-document-multiple-outline"></i>
                </div>
                <div class="dash-kpi-info">
                    <div class="dash-kpi-label">Total Dokumen Izin</div>
                    <div class="dash-kpi-val">{{ $perizinanSummary['total'] ?? 0 }}</div>
                    <div class="dash-kpi-sub">Di Seluruh Kawasan Proyek</div>
                </div>
            </div>
            <a href="{{ route('perizinan.index') }}" class="dash-kpi-action blue" title="Lihat Master Perizinan">
                <i class="mdi mdi-arrow-right"></i>
            </a>
        </div>

        <!-- Card 3: Perizinan Berjalan (Amber / Oranye) -->
        <div class="dash-kpi-card">
            <div class="dash-kpi-left">
                <div class="dash-kpi-icon rose" style="background: rgba(245, 158, 11, 0.12); color: #d97706;">
                    <i class="mdi mdi-clock-outline"></i>
                </div>
                <div class="dash-kpi-info">
                    <div class="dash-kpi-label">Perizinan Berjalan</div>
                    <div class="dash-kpi-val">{{ $perizinanSummary['berjalan'] ?? 0 }}</div>
                    <div class="dash-kpi-sub">Sedang Proses Dinas & Staf</div>
                </div>
            </div>
            <a href="{{ route('perizinan.index') }}" class="dash-kpi-action rose" style="color: #d97706;" title="Kelola Perizinan Berjalan">
                <i class="mdi mdi-arrow-right"></i>
            </a>
        </div>

        <!-- Card 4: Dokumen Sah & Terbit (Hijau Mint) -->
        <div class="dash-kpi-card">
            <div class="dash-kpi-left">
                <div class="dash-kpi-icon green">
                    <i class="mdi mdi-certificate-outline"></i>
                </div>
                <div class="dash-kpi-info">
                    <div class="dash-kpi-label">Perizinan Selesai / Terbit</div>
                    <div class="dash-kpi-val">{{ $perizinanSummary['selesai'] ?? 0 }}</div>
                    <div class="dash-kpi-sub">Dokumen Resmi Terbit</div>
                </div>
            </div>
            <a href="{{ route('perizinan.index') }}" class="dash-kpi-action green" title="Lihat Dokumen Terbit">
                <i class="mdi mdi-arrow-right"></i>
            </a>
        </div>

    </div>

    <!-- 3. BARIS 1: DAFTAR TANAH / PROYEK & STATUS PERIZINAN -->
    <div id="proyekTableSection" class="dash-row-grid">
        
        <!-- Tabel Kiri: Daftar Tanah / Proyek Kawasan -->
        <div class="dash-panel">
            <div class="dash-panel-header">
                <div class="dash-panel-title-wrap">
                    <div class="dash-panel-icon">
                        <i class="mdi mdi-office-building"></i>
                    </div>
                    <div>
                        <h2 class="dash-panel-title">Daftar Tanah / Kawasan</h2>
                        <p class="dash-panel-subtitle">5 kawasan proyek yang sedang dikelola perizinannya</p>
                    </div>
                </div>
                <a href="{{ route('proyek.index') }}" class="dash-link-all">
                    Lihat Semua <i class="mdi mdi-arrow-right"></i>
                </a>
            </div>

            <!-- Tabel Data Kawasan -->
            <div class="dash-table-wrap">
                <table class="dash-table">
                    <thead>
                        <tr>
                            <th style="width: 28px; text-align: center;">No</th>
                            <th>Nama Kawasan</th>
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
                                    <a href="{{ route('perizinan.show', $proj->id) }}" class="dash-action-btn" title="Kelola Perizinan Proyek">
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

        <!-- Tabel Kanan: Status Perizinan Proyek -->
        <div class="dash-panel">
            <div class="dash-panel-header">
                <div class="dash-panel-title-wrap">
                    <div class="dash-panel-icon">
                        <i class="mdi mdi-file-document-edit-outline"></i>
                    </div>
                    <div>
                        <h2 class="dash-panel-title">Status Perizinan Proyek</h2>
                        <p class="dash-panel-subtitle">Ringkasan pengurusan izin di seluruh kawasan</p>
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

            <!-- Tabel Data Status Perizinan -->
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

    <!-- 4. BARIS 2: MONITORING TUGAS TIM LEGAL (FULL WIDTH PANEL) -->
    <div class="dash-panel mt-3">
        <div class="dash-panel-header">
            <div class="dash-panel-title-wrap">
                <div class="dash-panel-icon">
                    <i class="mdi mdi-checkbox-marked-circle-outline"></i>
                </div>
                <div>
                    <h2 class="dash-panel-title">Monitoring Tugas Tim Legal</h2>
                    <p class="dash-panel-subtitle">Penugasan perizinan dan tindak lanjut kepada Staf Legal pelaksana</p>
                </div>
            </div>
            <a href="{{ route('perizinan.tugas.index') }}" class="dash-link-all">
                Kelola Semua Tugas <i class="mdi mdi-arrow-right"></i>
            </a>
        </div>

        <!-- Tabel Data Tugas Tim Legal -->
        <div class="dash-table-wrap">
            <table class="dash-table">
                <thead>
                    <tr>
                        <th style="width: 36px; text-align: center;">No</th>
                        <th>Tugas Perizinan</th>
                        <th>Kawasan Proyek</th>
                        <th>Ditugaskan Ke</th>
                        <th>Tenggat Waktu (Deadline)</th>
                        <th style="text-align: center;">Status</th>
                        <th style="width: 50px; text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentTeamTasks as $tIdx => $t)
                        @php
                            $taskStatus = strtolower($t->status ?? '');
                            $taskBadge = match(true) {
                                str_contains($taskStatus, 'selesai') || str_contains($taskStatus, 'terbit') => 'green',
                                str_contains($taskStatus, 'kendala') || str_contains($taskStatus, 'terlambat') || str_contains($taskStatus, 'revisi') => 'red',
                                str_contains($taskStatus, 'proses') || str_contains($taskStatus, 'berjalan') => 'yellow',
                                default => 'blue'
                            };
                        @endphp
                        <tr>
                            <td style="font-weight: 700; text-align: center;">{{ $tIdx + 1 }}</td>
                            <td>
                                <div style="font-weight: 700; color: #0f172a; font-size: 0.86rem;">
                                    {{ $t->nama_tugas }}
                                </div>
                                @if($t->catatan)
                                    <small class="text-muted d-block text-truncate" style="font-size: 0.72rem; max-width: 400px;">
                                        {{ $t->catatan }}
                                    </small>
                                @endif
                            </td>
                            <td style="color: #475569; font-weight: 600;">
                                {{ $t->proyek?->land_name ?? ($t->proyek_nama ?? 'Semua Kawasan') }}
                            </td>
                            <td>
                                <div style="display: flex; align-items: center; gap: 8px;">
                                    <div style="width: 24px; height: 24px; border-radius: 50%; background: #ede9fe; color: #7c3aed; font-size: 0.7rem; font-weight: 700; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                        <i class="mdi mdi-account" style="font-size: 0.8rem;"></i>
                                    </div>
                                    <span style="font-weight: 600; color: #1e293b; font-size: 0.8rem; white-space: nowrap;">
                                        {{ $t->employee?->name ?? 'Belum Ditugaskan' }}
                                    </span>
                                </div>
                            </td>
                            <td style="color: #64748b; font-size: 0.8rem;">
                                {{ $t->deadline ? \Carbon\Carbon::parse($t->deadline)->translatedFormat('d F Y') : '-' }}
                            </td>
                            <td style="text-align: center;">
                                <span class="dash-badge {{ $taskBadge }}" style="padding: 4px 10px; font-weight: 700;">
                                    {{ $t->status ?: 'Menunggu' }}
                                </span>
                            </td>
                            <td style="text-align: center;">
                                <a href="{{ route('perizinan.tugas.index') }}" class="dash-action-btn" title="Detail & Kelola Tugas">
                                    <i class="mdi mdi-dots-horizontal"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" style="text-align: center; color: #94a3b8; padding: 32px;">
                                <i class="mdi mdi-clipboard-text-outline fs-3 d-block mb-1 text-muted"></i>
                                Belum ada penugasan perizinan yang aktif saat ini
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endif

</div>
@endsection
