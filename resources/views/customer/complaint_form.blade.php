@extends('home.layouts.partials.app')

@section('title', 'Layanan Pengaduan & Klaim Garansi Unit - ' . ($unit->unit_name ?? 'Rumah'))

@push('styles')
<style>
    .complaint-page {
        min-height: 100vh;
        background: #f1f5f9;
        padding: 3rem 1.25rem 5rem;
    }

    .complaint-container {
        max-width: 760px;
        margin: 0 auto;
    }

    /* ===== UNIFIED 1 SINGLE CARD ===== */
    .complaint-single-card {
        background: #ffffff;
        border-radius: 8px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 15px 35px -5px rgba(15, 23, 42, 0.06), 0 5px 15px rgba(0, 0, 0, 0.03);
        overflow: hidden;
    }

    /* ===== HERO HEADER OF THE CARD ===== */
    .card-hero-header {
        background: linear-gradient(145deg, #1e293b, #0f172a);
        padding: 2.75rem 2rem 2.25rem;
        text-align: center;
        position: relative;
    }

    .complaint-logo-badge {
        width: 74px;
        height: 74px;
        border-radius: 50%;
        background: #ffffff;
        border: 3px solid var(--gold, #c9973a);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.15rem;
        overflow: hidden;
        box-shadow: 0 6px 20px rgba(201, 151, 58, 0.3);
    }

    .complaint-logo-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .complaint-hero-pill {
        display: inline-flex;
        align-items: center;
        padding: 0.35rem 0.95rem;
        border-radius: 4px;
        background: rgba(255, 255, 255, 0.12);
        color: #f1f5f9;
        font-size: 0.76rem;
        font-weight: 700;
        letter-spacing: 0.6px;
        margin-bottom: 0.85rem;
        border: 1px solid rgba(255, 255, 255, 0.15);
    }

    .complaint-hero-title {
        font-family: 'DM Serif Display', serif;
        font-size: 1.85rem;
        color: #ffffff;
        margin-bottom: 0.45rem;
        line-height: 1.25;
    }

    .complaint-hero-sub {
        font-size: 0.9rem;
        color: rgba(255, 255, 255, 0.75);
        max-width: 520px;
        margin: 0 auto;
        line-height: 1.55;
    }

    /* ===== BODY OF THE CARD ===== */
    .card-hero-body {
        padding: 2.25rem 2.25rem 2.5rem;
    }

    /* ===== SECTION BLOCKS ===== */
    .form-section-block {
        margin-bottom: 2rem;
        padding-bottom: 2rem;
        border-bottom: 1px solid #f1f5f9;
    }

    .form-section-block:last-child {
        margin-bottom: 0;
        padding-bottom: 0;
        border-bottom: none;
    }

    .section-head {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 0.75rem;
        margin-bottom: 1.25rem;
        flex-wrap: wrap;
    }

    .section-title {
        font-size: 1rem;
        font-weight: 700;
        color: #0f172a;
        margin: 0 0 0.15rem;
    }

    .section-sub {
        font-size: 0.8rem;
        color: #64748b;
        margin: 0;
    }

    /* ===== UNIT BANNER ===== */
    .unit-banner-box {
        background: #f8fafc;
        border: 1.5px solid #e2e8f0;
        border-radius: 6px;
        padding: 1.15rem 1.35rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1.25rem;
        flex-wrap: wrap;
    }

    .warranty-tag {
        display: inline-flex;
        align-items: center;
        padding: 0.4rem 0.85rem;
        border-radius: 4px;
        font-size: 0.78rem;
        font-weight: 700;
    }

    .warranty-active {
        background: #ecfdf5;
        color: #059669;
        border: 1px solid #a7f3d0;
    }

    .warranty-expired {
        background: #fef2f2;
        color: #dc2626;
        border: 1px solid #fecaca;
    }

    /* ===== FORM CONTROLS ===== */
    .form-group-custom {
        margin-bottom: 1.25rem;
    }

    .form-group-custom:last-child {
        margin-bottom: 0;
    }

    .form-label-custom {
        display: block;
        font-size: 0.84rem;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 0.45rem;
    }

    .form-label-custom .req {
        color: #ef4444;
    }

    .form-control-custom {
        width: 100%;
        border: 1.5px solid #cbd5e1;
        border-radius: 6px;
        padding: 0.75rem 1rem;
        font-size: 0.92rem;
        color: #0f172a;
        background-color: #ffffff;
        transition: all 0.2s ease;
        outline: none;
        font-family: inherit;
    }

    .form-control-custom:focus {
        border-color: #9a55ff;
        box-shadow: 0 0 0 3px rgba(154, 85, 255, 0.15);
    }

    /* ===== CUSTOM DROPDOWN (BERSIH TANPA ICON & EMOJI) ===== */
    .custom-select-wrapper {
        position: relative;
        user-select: none;
        width: 100%;
    }

    .custom-select-trigger {
        position: relative;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0.75rem 1rem;
        font-size: 0.92rem;
        font-weight: 500;
        color: #0f172a;
        background: #ffffff;
        border: 1.5px solid #cbd5e1;
        border-radius: 6px;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .custom-select-trigger:hover {
        border-color: #94a3b8;
        background: #fafafa;
    }

    .custom-select-wrapper.is-open .custom-select-trigger {
        border-color: #9a55ff;
        box-shadow: 0 0 0 3px rgba(154, 85, 255, 0.15);
    }

    .custom-select-value {
        color: #0f172a;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .custom-select-value.text-muted {
        color: #94a3b8;
    }

    .custom-select-arrow {
        width: 8px;
        height: 8px;
        border-right: 2px solid #64748b;
        border-bottom: 2px solid #64748b;
        transform: rotate(45deg);
        transition: transform 0.2s ease, border-color 0.2s ease;
        margin-left: 0.5rem;
        flex-shrink: 0;
        display: inline-block;
    }

    .custom-select-wrapper.is-open .custom-select-arrow {
        transform: rotate(-135deg);
        border-color: #9a55ff;
    }

    .custom-select-menu {
        position: absolute;
        top: calc(100% + 4px);
        left: 0;
        right: 0;
        background: #ffffff;
        border: 1.5px solid #e2e8f0;
        border-radius: 6px;
        box-shadow: 0 10px 25px -4px rgba(0, 0, 0, 0.1);
        z-index: 1000;
        max-height: 250px;
        overflow-y: auto;
        -webkit-overflow-scrolling: touch;
        display: none;
        padding: 5px;
    }

    .custom-select-wrapper.is-open .custom-select-menu {
        display: block;
        animation: dropFade 0.2s ease-out forwards;
    }

    @keyframes dropFade {
        from { opacity: 0; transform: translateY(-4px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .custom-option {
        padding: 0.7rem 0.9rem;
        font-size: 0.88rem;
        color: #334155;
        border-radius: 4px;
        cursor: pointer;
        min-height: 42px;
        display: flex;
        align-items: center;
        transition: background 0.15s ease, color 0.15s ease;
    }

    .custom-option:hover {
        background: #f8fafc;
        color: #0f172a;
    }

    .custom-option.is-selected {
        background: #f1f5f9;
        color: #0f172a;
        font-weight: 700;
    }

    /* ===== REPEATER ITEM BOX ===== */
    .complaint-item-box {
        background: #faf8ff;
        border: 1.5px solid #eee6ff;
        border-radius: 6px;
        padding: 1.35rem;
        margin-bottom: 1.25rem;
        transition: border-color 0.2s ease;
    }

    .complaint-item-box:hover {
        border-color: #ddd0ff;
    }

    .complaint-item-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 1.15rem;
        padding-bottom: 0.75rem;
        border-bottom: 1px dashed #d8c8fc;
    }

    .item-number-tag {
        font-size: 0.9rem;
        font-weight: 700;
        color: #1e1b4b;
    }

    .btn-remove-item {
        background: transparent;
        border: 1px solid #fecaca;
        color: #ef4444;
        border-radius: 4px;
        padding: 0.35rem 0.75rem;
        font-size: 0.78rem;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .btn-remove-item:hover {
        background: #fef2f2;
        border-color: #ef4444;
    }

    /* ===== UPLOAD AREA ===== */
    .photo-upload-area {
        border: 2px dashed #cbd5e1;
        border-radius: 6px;
        padding: 1.35rem 1rem;
        text-align: center;
        background: #ffffff;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .photo-upload-area:hover {
        border-color: #9a55ff;
        background: #faf5ff;
    }

    .photo-preview-image {
        max-height: 140px;
        border-radius: 6px;
        object-fit: cover;
        display: none;
        margin: 0.85rem auto 0;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        border: 1px solid #e2e8f0;
    }

    /* ===== BUTTONS ===== */
    .btn-add-complaint {
        width: 100%;
        background: #ffffff;
        border: 2px dashed #9a55ff;
        color: #9a55ff;
        border-radius: 6px;
        padding: 0.9rem;
        font-weight: 700;
        font-size: 0.92rem;
        cursor: pointer;
        transition: all 0.2s ease;
        text-align: center;
    }

    .btn-add-complaint:hover {
        background: #faf5ff;
        color: #7c3aed;
    }

    .btn-submit-complaint {
        width: 100%;
        background: linear-gradient(135deg, #1e293b, #0f172a);
        color: #ffffff;
        border: 1.5px solid var(--gold, #c9973a);
        border-radius: 6px;
        padding: 1rem 1.5rem;
        font-size: 1.02rem;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.25s ease;
        box-shadow: 0 8px 20px rgba(15, 23, 42, 0.2);
        text-align: center;
    }

    .btn-submit-complaint:hover {
        background: #0f172a;
        transform: translateY(-2px);
        box-shadow: 0 12px 25px rgba(15, 23, 42, 0.3);
        color: #ffffff;
    }

    .faq-info-card {
        background: #f8fafc;
        border-radius: 6px;
        padding: 1.25rem 1.5rem;
        border: 1px solid #e2e8f0;
        font-size: 0.85rem;
    }

    .faq-info-card ul {
        margin: 0;
        padding-left: 1.25rem;
        color: #64748b;
        line-height: 1.6;
    }

    /* ===== FORM 2-COLUMN GRID ===== */
    .form-grid-2col {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1.25rem;
    }

    .unit-owner-col {
        text-align: right;
    }

    /* ===== RESPONSIVE (TABLET & MOBILE) ===== */
    @media (max-width: 768px) {
        .complaint-page {
            padding: 1.25rem 0.75rem 3.5rem;
        }

        .complaint-single-card {
            border-radius: 8px;
        }

        .card-hero-header {
            padding: 2rem 1.25rem 1.5rem;
        }

        .complaint-logo-badge {
            width: 64px;
            height: 64px;
            margin-bottom: 0.85rem;
        }

        .complaint-hero-title {
            font-size: 1.45rem;
            line-height: 1.3;
        }

        .complaint-hero-sub {
            font-size: 0.84rem;
        }

        .card-hero-body {
            padding: 1.35rem 1rem 1.75rem;
        }

        .unit-banner-box {
            flex-direction: column;
            align-items: flex-start;
            gap: 0.85rem;
            padding: 1rem;
        }

        .unit-owner-col {
            text-align: left;
            width: 100%;
            border-top: 1px dashed #cbd5e1;
            padding-top: 0.65rem;
        }

        .form-grid-2col {
            grid-template-columns: 1fr;
            gap: 1rem;
        }

        /* Prevent auto-zoom on iOS Safari */
        .form-control-custom,
        .custom-select-trigger {
            font-size: 16px;
        }
    }

    @media (max-width: 480px) {
        .complaint-page {
            padding: 0.65rem 0.4rem 2.5rem;
        }

        .complaint-single-card {
            border-radius: 8px;
        }

        .card-hero-header {
            padding: 1.5rem 0.85rem 1.25rem;
        }

        .complaint-logo-badge {
            width: 56px;
            height: 56px;
            margin-bottom: 0.65rem;
        }

        .complaint-hero-title {
            font-size: 1.25rem;
        }

        .complaint-hero-pill {
            font-size: 0.68rem;
            padding: 0.25rem 0.65rem;
        }

        .complaint-hero-sub {
            font-size: 0.8rem;
        }

        .card-hero-body {
            padding: 1.15rem 0.75rem 1.5rem;
        }

        .section-head {
            flex-direction: column;
            align-items: flex-start;
            gap: 0.35rem;
        }

        .warranty-tag {
            font-size: 0.72rem;
            padding: 0.3rem 0.6rem;
        }

        .complaint-item-box {
            padding: 0.95rem 0.75rem;
            border-radius: 6px;
        }

        .photo-upload-area {
            padding: 1rem 0.75rem;
        }

        .btn-add-complaint {
            font-size: 0.86rem;
            padding: 0.75rem;
        }

        .btn-submit-complaint {
            font-size: 0.92rem;
            padding: 0.85rem 1rem;
            border-radius: 6px;
        }

        .faq-info-card {
            padding: 1rem 0.85rem;
            font-size: 0.8rem;
        }

        .faq-info-card ul {
            padding-left: 1rem;
        }
    }
</style>
@endpush

@section('content')

{{-- Tanpa Navbar Sesuai Permintaan --}}

<div class="complaint-page">
    <div class="complaint-container">

        <!-- UNIFIED 1 SINGLE CARD -->
        <div class="complaint-single-card">
            
            <!-- HEADER OF THE CARD -->
            <div class="card-hero-header">
                <!-- Logo Perusahaan Resmi -->
                <div class="complaint-logo-badge">
                    <img src="{{ asset('images/logo.jpeg') }}" alt="Logo Graha Cipta Sejahtera" class="complaint-logo-img">
                </div>

                <div class="complaint-hero-pill">
                    <span>LAYANAN PURNA JUAL & GARANSI</span>
                </div>
                <h1 class="complaint-hero-title">Form Pengaduan & Keluhan Unit</h1>
                <p class="complaint-hero-sub">
                    Sampaikan keluhan kondisi fisik atau fasilitas rumah Anda langsung ke Tim Maintenance Graha Cipta Sejahtera untuk penanganan resmi.
                </p>
            </div>

            <!-- BODY OF THE CARD -->
            <div class="card-hero-body">
                
                <!-- Alert Notifikasi -->
                @if(session('error'))
                    <div style="background: #fef2f2; border: 1.5px solid #fecaca; border-radius: 6px; padding: 1rem 1.25rem; margin-bottom: 1.5rem; color: #991b1b; font-size: 0.88rem;">
                        {{ session('error') }}
                    </div>
                @endif

                @if(session('success'))
                    <div style="background: #ecfdf5; border: 1.5px solid #a7f3d0; border-radius: 6px; padding: 1rem 1.25rem; margin-bottom: 1.5rem; color: #065f46; font-size: 0.88rem;">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- SECTION 1: DATA KEPEMILIKAN UNIT -->
                <div class="form-section-block">
                    <div class="section-head">
                        <div>
                            <h2 class="section-title">Data Kepemilikan Unit</h2>
                            <p class="section-sub">Informasi unit rumah yang diajukan pengaduan</p>
                        </div>
                        <div>
                            @if($garansiStatus === 'Aktif')
                                <span class="warranty-tag warranty-active">
                                    Garansi Aktif ({{ $garansiDaysLeft }} hari)
                                </span>
                            @else
                                <span class="warranty-tag warranty-expired">
                                    Masa Garansi Berakhir
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="unit-banner-box">
                        <div>
                            <div style="font-size: 1.1rem; font-weight: 800; color: #0f172a; margin-bottom: 0.2rem;">
                                {{ $unit->unit_name ?? 'Unit Rumah' }}
                            </div>
                            <div style="font-size: 0.84rem; color: #64748b; margin-bottom: 0.5rem;">
                                Perumahan: <strong style="color: #1e293b;">{{ $unit->landBank->name ?? '-' }}</strong>
                            </div>
                            <div style="display: flex; gap: 0.4rem; flex-wrap: wrap;">
                                <span style="background: #9a55ff; color: #fff; font-family: monospace; font-size: 0.72rem; font-weight: 700; padding: 0.25rem 0.6rem; border-radius: 6px;">
                                    Blok {{ $unit->unit_code ?? '-' }}
                                </span>
                                <span style="background: #ffffff; color: #475569; border: 1px solid #e2e8f0; font-size: 0.72rem; font-weight: 600; padding: 0.25rem 0.6rem; border-radius: 6px;">
                                    Tipe {{ $unit->type ?? 'Standar' }}
                                </span>
                            </div>
                        </div>
                        <div class="unit-owner-col">
                            <small style="color: #8b8fa3; font-size: 0.75rem; display: block;">Pemilik Terdaftar:</small>
                            <span style="font-weight: 700; color: #0f172a; font-size: 0.95rem; display: block;">
                                {{ $customer->full_name ?? '-' }}
                            </span>
                            <small style="color: #64748b; font-family: monospace; font-size: 0.75rem;">
                                #{{ $booking->booking_code ?? $booking->id }}
                            </small>
                        </div>
                    </div>
                </div>

                <!-- FORMULIR PENGADUAN KONSUMEN -->
                <form action="{{ route('complaint.customer.store', $booking->booking_code ?: $booking->id) }}" method="POST" enctype="multipart/form-data" id="complaintForm">
                    @csrf

                    <!-- SECTION 2: KONTAK PELAPOR -->
                    <div class="form-section-block">
                        <div class="section-head">
                            <div>
                                <h2 class="section-title">Kontak Pelapor / Pemilik</h2>
                                <p class="section-sub">Untuk konfirmasi jadwal survei & update penanganan</p>
                            </div>
                        </div>

                        <div class="form-grid-2col">
                            <div class="form-group-custom">
                                <label class="form-label-custom">Nama Pelapor <span class="req">*</span></label>
                                <input type="text" name="nama_pelapor" class="form-control-custom" value="{{ old('nama_pelapor', $customer->full_name ?? '') }}" placeholder="Nama Anda" required>
                            </div>
                            <div class="form-group-custom">
                                <label class="form-label-custom">No. WhatsApp / HP Aktif <span class="req">*</span></label>
                                <input type="tel" name="no_whatsapp" class="form-control-custom" value="{{ old('no_whatsapp', $customer->phone ?? '') }}" placeholder="08xxxxxxxxxx" required>
                                <small style="font-size: 0.74rem; color: #8b8fa3; display: block; margin-top: 0.35rem;">
                                    Tim teknisi akan menghubungi nomor ini sebelum inspeksi ke lokasi unit.
                                </small>
                            </div>
                        </div>
                    </div>

                    <!-- SECTION 3: RINCIAN TITIK KERUSAKAN -->
                    <div class="form-section-block">
                        <div class="section-head">
                            <div>
                                <h2 class="section-title">Rincian Titik Kerusakan / Keluhan</h2>
                                <p class="section-sub">Anda dapat mengajukan lebih dari satu kerusakan sekaligus</p>
                            </div>
                        </div>

                        <div id="itemsContainer">
                            <!-- Item #0 (Default) -->
                            <div class="complaint-item-box" data-index="0">
                                <div class="complaint-item-header">
                                    <span class="item-number-tag item-badge">
                                        Titik Keluhan #1
                                    </span>
                                    <button type="button" class="btn-remove-item d-none" onclick="removeItem(this)">
                                        Hapus
                                    </button>
                                </div>

                                <div class="form-grid-2col" style="margin-bottom: 1rem;">
                                    
                                    <!-- Custom Select Kategori (Tanpa Icon & Emoji) -->
                                    <div class="form-group-custom">
                                        <label class="form-label-custom">Kategori Masalah <span class="req">*</span></label>
                                        <div class="custom-select-wrapper" id="wrapper_kategori_0">
                                            <div class="custom-select-trigger" onclick="toggleDropdown('wrapper_kategori_0')">
                                                <span class="custom-select-value text-muted" id="trigger_text_kategori_0">
                                                    -- Pilih Bagian Rusak --
                                                </span>
                                                <span class="custom-select-arrow"></span>
                                            </div>
                                            <div class="custom-select-menu">
                                                <div class="custom-option" data-value="kebocoran" onclick="selectDropdownOption('wrapper_kategori_0', 'kebocoran', 'Kebocoran Atap / Plafon / Talang')">
                                                    Kebocoran Atap / Plafon / Talang
                                                </div>
                                                <div class="custom-option" data-value="sanitasi_pipa" onclick="selectDropdownOption('wrapper_kategori_0', 'sanitasi_pipa', 'Sanitasi, Kran Bocor & Saluran Pembuangan')">
                                                    Sanitasi, Kran Bocor & Saluran Pembuangan
                                                </div>
                                                <div class="custom-option" data-value="kelistrikan" onclick="selectDropdownOption('wrapper_kategori_0', 'kelistrikan', 'Kelistrikan, Stopkontak, MCB & Lampu')">
                                                    Kelistrikan, Stopkontak, MCB & Lampu
                                                </div>
                                                <div class="custom-option" data-value="pintu_jendela" onclick="selectDropdownOption('wrapper_kategori_0', 'pintu_jendela', 'Kusen, Daun Pintu, Jendela & Kunci')">
                                                    Kusen, Daun Pintu, Jendela & Kunci
                                                </div>
                                                <div class="custom-option" data-value="struktur_dinding" onclick="selectDropdownOption('wrapper_kategori_0', 'struktur_dinding', 'Dinding Retak / Plesteran Mengelupas')">
                                                    Dinding Retak / Plesteran Mengelupas
                                                </div>
                                                <div class="custom-option" data-value="finishing_cat" onclick="selectDropdownOption('wrapper_kategori_0', 'finishing_cat', 'Keramik Lantai / Cat Dinding Terkelupas')">
                                                    Keramik Lantai / Cat Dinding Terkelupas
                                                </div>
                                                <div class="custom-option" data-value="lainnya" onclick="selectDropdownOption('wrapper_kategori_0', 'lainnya', 'Lainnya / Masalah Umum')">
                                                    Lainnya / Masalah Umum
                                                </div>
                                            </div>
                                            <input type="hidden" name="items[0][kategori]" id="input_kategori_0" required>
                                        </div>
                                    </div>

                                    <!-- Custom Select Urgensi (Tanpa Icon & Emoji) -->
                                    <div class="form-group-custom">
                                        <label class="form-label-custom">Tingkat Urgensi</label>
                                        <div class="custom-select-wrapper" id="wrapper_prioritas_0">
                                            <div class="custom-select-trigger" onclick="toggleDropdown('wrapper_prioritas_0')">
                                                <span class="custom-select-value" id="trigger_text_prioritas_0">
                                                    Sedang (Bisa dijadwalkan)
                                                </span>
                                                <span class="custom-select-arrow"></span>
                                            </div>
                                            <div class="custom-select-menu">
                                                <div class="custom-option is-selected" data-value="sedang" onclick="selectDropdownOption('wrapper_prioritas_0', 'sedang', 'Sedang (Bisa dijadwalkan)')">
                                                    Sedang (Bisa dijadwalkan)
                                                </div>
                                                <div class="custom-option" data-value="tinggi" onclick="selectDropdownOption('wrapper_prioritas_0', 'tinggi', 'Tinggi (Perlu penanganan segera)')">
                                                    Tinggi (Perlu penanganan segera)
                                                </div>
                                                <div class="custom-option" data-value="darurat" onclick="selectDropdownOption('wrapper_prioritas_0', 'darurat', 'Darurat (Air meluap / korsleting / bocor deras)')">
                                                    Darurat (Air meluap / korsleting / bocor deras)
                                                </div>
                                                <div class="custom-option" data-value="rendah" onclick="selectDropdownOption('wrapper_prioritas_0', 'rendah', 'Rendah (Penyempurnaan estetika)')">
                                                    Rendah (Penyempurnaan estetika)
                                                </div>
                                            </div>
                                            <input type="hidden" name="items[0][prioritas]" id="input_prioritas_0" value="sedang">
                                        </div>
                                    </div>

                                </div>

                                <div class="form-group-custom">
                                    <label class="form-label-custom">Judul / Ringkasan Masalah <span class="req">*</span></label>
                                    <input type="text" name="items[0][judul_keluhan]" class="form-control-custom" placeholder="Contoh: Plafon kamar utama bocor saat hujan deras" required>
                                </div>

                                <div class="form-group-custom">
                                    <label class="form-label-custom">Deskripsi & Posisi Titik Kerusakan <span class="req">*</span></label>
                                    <textarea name="items[0][deskripsi]" rows="3" class="form-control-custom" placeholder="Jelaskan secara detail di ruangan mana letak kerusakannya dan gejalanya..." required></textarea>
                                </div>

                                <div class="form-group-custom">
                                    <label class="form-label-custom">Foto / Bukti Kerusakan (Opsional tapi disarankan)</label>
                                    <div class="photo-upload-area" onclick="triggerFileInput(0)">
                                        <span style="font-size: 0.88rem; font-weight: 700; color: #1e293b; display: block; margin-bottom: 0.25rem;">Klik untuk ambil foto dari Kamera atau Galeri</span>
                                        <small style="color: #8b8fa3; font-size: 0.76rem;">Format: JPG, PNG, WEBP (Maks 10MB)</small>
                                        <input type="file" name="items[0][foto_keluhan]" id="fileInput_0" accept="image/*" capture="environment" style="display: none;" onchange="previewImage(this, 0)">
                                        <img src="" id="previewImg_0" class="photo-preview-image" alt="Preview Foto">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Tombol Tambah Titik Kerusakan -->
                        <button type="button" class="btn-add-complaint" onclick="addNewItem()">
                            + Tambah Titik Kerusakan Lain
                        </button>
                    </div>

                    <!-- SECTION 4: SUBMIT BUTTON -->
                    <div style="margin-top: 2rem; margin-bottom: 2rem; text-align: center;">
                        <button type="submit" class="btn-submit-complaint" id="submitBtn">
                            Kirim Pengaduan / Klaim Garansi Sekarang
                        </button>
                        <div style="font-size: 0.78rem; color: #8b8fa3; margin-top: 0.75rem;">
                            Data keluhan Anda akan langsung tercatat dan ditugaskan ke supervisor lapangan.
                        </div>
                    </div>
                </form>

                <!-- SECTION 5: INFORMASI KEBIJAKAN GARANSI -->
                <div class="faq-info-card">
                    <div style="font-weight: 700; color: #0f172a; margin-bottom: 0.5rem;">
                        Ketentuan Klaim Garansi Purna Jual
                    </div>
                    <ul>
                        <li>Masa garansi pemeliharaan unit berlaku selama <strong>100 hari</strong> terhitung sejak Berita Acara Serah Terima (BAST).</li>
                        <li>Garansi mencakup kebocoran atap, instalasi air bersih/kotor, instalasi listrik standar, dan retak rambut plesteran dinding akibat susut bangunan.</li>
                        <li>Garansi <strong>tidak mencakup</strong> renovasi mandiri yang dilakukan konsumen di luar spesifikasi bawaan developer.</li>
                        <li>Tim pengawas / teknisi akan melakukan konfirmasi kunjungan dalam waktu <strong>1x24 jam kerja</strong> setelah laporan diterima.</li>
                    </ul>
                </div>

            </div>
        </div>

    </div>
</div>

{{-- Footer Publik --}}
@include('home.layouts.footer')

@endsection

@push('scripts')
<script>
    let itemIndex = 0;

    /* ===== CUSTOM DROPDOWN LOGIC (CLEAN WITHOUT ICONS/EMOJIS) ===== */
    function toggleDropdown(wrapperId) {
        const wrapper = document.getElementById(wrapperId);
        if (!wrapper) return;
        const isOpen = wrapper.classList.contains('is-open');
        
        // Close all other dropdowns
        document.querySelectorAll('.custom-select-wrapper').forEach(w => {
            if (w !== wrapper) w.classList.remove('is-open');
        });

        if (isOpen) {
            wrapper.classList.remove('is-open');
        } else {
            wrapper.classList.add('is-open');
        }
    }

    function selectDropdownOption(wrapperId, value, displayText) {
        const wrapper = document.getElementById(wrapperId);
        if (!wrapper) return;

        // Set hidden input value
        const hiddenInput = wrapper.querySelector('input[type="hidden"]');
        if (hiddenInput) {
            hiddenInput.value = value;
        }

        // Set trigger text
        const triggerText = wrapper.querySelector('.custom-select-value');
        if (triggerText) {
            triggerText.textContent = displayText;
            triggerText.classList.remove('text-muted');
        }

        // Update active class on options
        wrapper.querySelectorAll('.custom-option').forEach(opt => {
            if (opt.getAttribute('data-value') === value) {
                opt.classList.add('is-selected');
            } else {
                opt.classList.remove('is-selected');
            }
        });

        // Close dropdown
        wrapper.classList.remove('is-open');
    }

    // Close dropdowns when clicking outside
    document.addEventListener('click', function(e) {
        if (!e.target.closest('.custom-select-wrapper')) {
            document.querySelectorAll('.custom-select-wrapper').forEach(w => w.classList.remove('is-open'));
        }
    });

    /* ===== PHOTO PREVIEW & FILE TRIGGER ===== */
    function triggerFileInput(idx) {
        const input = document.getElementById('fileInput_' + idx);
        if (input) input.click();
    }

    function previewImage(input, idx) {
        const preview = document.getElementById('previewImg_' + idx);
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    /* ===== DYNAMIC REPEATER ITEMS ===== */
    function addNewItem() {
        itemIndex++;
        const container = document.getElementById('itemsContainer');
        const itemHtml = `
            <div class="complaint-item-box" data-index="${itemIndex}">
                <div class="complaint-item-header">
                    <span class="item-number-tag item-badge">
                        Titik Keluhan #${itemIndex + 1}
                    </span>
                    <button type="button" class="btn-remove-item" onclick="removeItem(this)">
                        Hapus
                    </button>
                </div>

                <div class="form-grid-2col" style="margin-bottom: 1rem;">
                    
                    <!-- Custom Select Kategori -->
                    <div class="form-group-custom">
                        <label class="form-label-custom">Kategori Masalah <span class="req">*</span></label>
                        <div class="custom-select-wrapper" id="wrapper_kategori_${itemIndex}">
                            <div class="custom-select-trigger" onclick="toggleDropdown('wrapper_kategori_${itemIndex}')">
                                <span class="custom-select-value text-muted" id="trigger_text_kategori_${itemIndex}">
                                    -- Pilih Bagian Rusak --
                                </span>
                                <span class="custom-select-arrow"></span>
                            </div>
                            <div class="custom-select-menu">
                                <div class="custom-option" data-value="kebocoran" onclick="selectDropdownOption('wrapper_kategori_${itemIndex}', 'kebocoran', 'Kebocoran Atap / Plafon / Talang')">
                                    Kebocoran Atap / Plafon / Talang
                                </div>
                                <div class="custom-option" data-value="sanitasi_pipa" onclick="selectDropdownOption('wrapper_kategori_${itemIndex}', 'sanitasi_pipa', 'Sanitasi, Kran Bocor & Saluran Pembuangan')">
                                    Sanitasi, Kran Bocor & Saluran Pembuangan
                                </div>
                                <div class="custom-option" data-value="kelistrikan" onclick="selectDropdownOption('wrapper_kategori_${itemIndex}', 'kelistrikan', 'Kelistrikan, Stopkontak, MCB & Lampu')">
                                    Kelistrikan, Stopkontak, MCB & Lampu
                                </div>
                                <div class="custom-option" data-value="pintu_jendela" onclick="selectDropdownOption('wrapper_kategori_${itemIndex}', 'pintu_jendela', 'Kusen, Daun Pintu, Jendela & Kunci')">
                                    Kusen, Daun Pintu, Jendela & Kunci
                                </div>
                                <div class="custom-option" data-value="struktur_dinding" onclick="selectDropdownOption('wrapper_kategori_${itemIndex}', 'struktur_dinding', 'Dinding Retak / Plesteran Mengelupas')">
                                    Dinding Retak / Plesteran Mengelupas
                                </div>
                                <div class="custom-option" data-value="finishing_cat" onclick="selectDropdownOption('wrapper_kategori_${itemIndex}', 'finishing_cat', 'Keramik Lantai / Cat Dinding Terkelupas')">
                                    Keramik Lantai / Cat Dinding Terkelupas
                                </div>
                                <div class="custom-option" data-value="lainnya" onclick="selectDropdownOption('wrapper_kategori_${itemIndex}', 'lainnya', 'Lainnya / Masalah Umum')">
                                    Lainnya / Masalah Umum
                                </div>
                            </div>
                            <input type="hidden" name="items[${itemIndex}][kategori]" id="input_kategori_${itemIndex}" required>
                        </div>
                    </div>

                    <!-- Custom Select Urgensi -->
                    <div class="form-group-custom">
                        <label class="form-label-custom">Tingkat Urgensi</label>
                        <div class="custom-select-wrapper" id="wrapper_prioritas_${itemIndex}">
                            <div class="custom-select-trigger" onclick="toggleDropdown('wrapper_prioritas_${itemIndex}')">
                                <span class="custom-select-value" id="trigger_text_prioritas_${itemIndex}">
                                    Sedang (Bisa dijadwalkan)
                                </span>
                                <span class="custom-select-arrow"></span>
                            </div>
                            <div class="custom-select-menu">
                                <div class="custom-option is-selected" data-value="sedang" onclick="selectDropdownOption('wrapper_prioritas_${itemIndex}', 'sedang', 'Sedang (Bisa dijadwalkan)')">
                                    Sedang (Bisa dijadwalkan)
                                </div>
                                <div class="custom-option" data-value="tinggi" onclick="selectDropdownOption('wrapper_prioritas_${itemIndex}', 'tinggi', 'Tinggi (Perlu penanganan segera)')">
                                    Tinggi (Perlu penanganan segera)
                                </div>
                                <div class="custom-option" data-value="darurat" onclick="selectDropdownOption('wrapper_prioritas_${itemIndex}', 'darurat', 'Darurat (Air meluap / korsleting / bocor deras)')">
                                    Darurat (Air meluap / korsleting / bocor deras)
                                </div>
                                <div class="custom-option" data-value="rendah" onclick="selectDropdownOption('wrapper_prioritas_${itemIndex}', 'rendah', 'Rendah (Penyempurnaan estetika)')">
                                    Rendah (Penyempurnaan estetika)
                                </div>
                            </div>
                            <input type="hidden" name="items[${itemIndex}][prioritas]" id="input_prioritas_${itemIndex}" value="sedang">
                        </div>
                    </div>

                </div>

                <div class="form-group-custom">
                    <label class="form-label-custom">Judul / Ringkasan Masalah <span class="req">*</span></label>
                    <input type="text" name="items[${itemIndex}][judul_keluhan]" class="form-control-custom" placeholder="Contoh: Kran cuci piring bocor" required>
                </div>

                <div class="form-group-custom">
                    <label class="form-label-custom">Deskripsi & Posisi Titik Kerusakan <span class="req">*</span></label>
                    <textarea name="items[${itemIndex}][deskripsi]" rows="3" class="form-control-custom" placeholder="Jelaskan detail posisi kerusakan..." required></textarea>
                </div>

                <div class="form-group-custom">
                    <label class="form-label-custom">Foto / Bukti Kerusakan (Opsional)</label>
                    <div class="photo-upload-area" onclick="triggerFileInput(${itemIndex})">
                        <span style="font-size: 0.88rem; font-weight: 700; color: #1e293b; display: block; margin-bottom: 0.25rem;">Klik untuk ambil foto dari Kamera atau Galeri</span>
                        <small style="color: #8b8fa3; font-size: 0.76rem;">Format: JPG, PNG, WEBP (Maks 10MB)</small>
                        <input type="file" name="items[${itemIndex}][foto_keluhan]" id="fileInput_${itemIndex}" accept="image/*" capture="environment" style="display: none;" onchange="previewImage(this, ${itemIndex})">
                        <img src="" id="previewImg_${itemIndex}" class="photo-preview-image" alt="Preview Foto">
                    </div>
                </div>
            </div>
        `;
        container.insertAdjacentHTML('beforeend', itemHtml);
        updateRemoveButtons();
    }

    function removeItem(btn) {
        const itemBox = btn.closest('.complaint-item-box');
        if (itemBox) {
            itemBox.remove();
            renumberItems();
            updateRemoveButtons();
        }
    }

    function renumberItems() {
        const items = document.querySelectorAll('#itemsContainer .complaint-item-box');
        items.forEach((item, index) => {
            const badge = item.querySelector('.item-badge');
            if (badge) {
                badge.textContent = `Titik Keluhan #${index + 1}`;
            }
        });
    }

    function updateRemoveButtons() {
        const items = document.querySelectorAll('#itemsContainer .complaint-item-box');
        const removeButtons = document.querySelectorAll('#itemsContainer .btn-remove-item');
        if (items.length > 1) {
            removeButtons.forEach(btn => btn.classList.remove('d-none'));
        } else {
            removeButtons.forEach(btn => btn.classList.add('d-none'));
        }
    }

    document.getElementById('complaintForm').addEventListener('submit', function() {
        const btn = document.getElementById('submitBtn');
        btn.textContent = 'Mengirim Pengaduan...';
        btn.disabled = true;
    });
</script>
@endpush
