<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Hasil Survey KPR - {{ $application->customer->full_name ?? 'Survey-KPR' }}</title>
    <link rel="icon" type="image/jpeg" href="{{ asset('images/logo.jpeg') }}">
    <link rel="shortcut icon" href="{{ asset('images/logo.jpeg') }}">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@800;900&family=Plus+Jakarta+Sans:wght@500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Material Design Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font@7.2.96/css/materialdesignicons.min.css">

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            background-color: #f1f5f9;
            font-family: 'Times New Roman', Times, Georgia, serif;
            color: #111827;
            font-size: 10.5pt;
            line-height: 1.4;
            padding: 20px 0;
        }

        /* Floating Top Action Bar */
        .no-print-bar {
            position: fixed;
            top: 15px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 9999;
            background: rgba(15, 23, 42, 0.92);
            backdrop-filter: blur(8px);
            padding: 8px 18px;
            border-radius: 50px;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.25);
            display: flex;
            align-items: center;
            gap: 12px;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .no-print-bar .btn-action-print {
            background: linear-gradient(135deg, #004b93, #0284c7);
            color: #ffffff;
            border: none;
            padding: 7px 18px;
            font-size: 0.85rem;
            font-weight: 600;
            border-radius: 30px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            cursor: pointer;
            transition: all 0.2s ease;
            text-decoration: none;
        }

        .no-print-bar .btn-action-print:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(2, 132, 199, 0.4);
            color: #ffffff;
        }

        .no-print-bar .btn-action-close {
            background: rgba(255, 255, 255, 0.15);
            color: #f8fafc;
            border: 1px solid rgba(255, 255, 255, 0.25);
            padding: 7px 16px;
            font-size: 0.85rem;
            font-weight: 500;
            border-radius: 30px;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            cursor: pointer;
            transition: all 0.2s ease;
            text-decoration: none;
        }

        .no-print-bar .btn-action-close:hover {
            background: rgba(255, 255, 255, 0.25);
            color: #ffffff;
        }

        /* Printable Sheet Container (F4 Size) */
        .print-container {
            width: 215mm;
            min-height: 330mm;
            padding: 14mm 18mm 18mm 18mm;
            margin: 50px auto 30px auto;
            background: #ffffff;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            position: relative;
        }

        /* Watermark */
        .watermark-bg {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-30deg);
            font-size: 55pt;
            font-weight: bold;
            color: rgba(0, 75, 147, 0.035);
            white-space: nowrap;
            pointer-events: none;
            z-index: 0;
            text-transform: uppercase;
            letter-spacing: 6px;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .content-wrap {
            position: relative;
            z-index: 1;
        }

        /* KOP SURAT RESMI PT. GRAHA CIPTA SEJAHTERA (PATEN) */
        .document-header {
            margin-bottom: 14px;
            border-bottom: 3.5px double #004b93;
            padding-bottom: 10px;
            position: relative;
        }

        .document-header-inner {
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            min-height: 75px;
        }

        .header-logo-left {
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            display: flex;
            align-items: center;
        }

        .document-header-logo {
            height: 70px;
            max-width: 125px;
            object-fit: contain;
        }

        .document-header-text {
            text-align: center;
            width: 100%;
            padding: 0 60px;
        }

        .company-main-title {
            color: #004b93 !important;
            font-size: 24px !important;
            font-weight: 900 !important;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            margin: 0 0 2px 0;
            font-family: 'Montserrat', 'Arial Black', sans-serif !important;
            -webkit-font-smoothing: antialiased;
            text-align: center;
        }

        .company-sub-title {
            color: #002d62 !important;
            font-size: 15.5px !important;
            font-weight: 800 !important;
            letter-spacing: 0.3px;
            margin: 0 0 3px 0;
            font-family: 'Plus Jakarta Sans', 'Segoe UI', Arial, sans-serif !important;
            text-align: center;
        }

        .company-address {
            color: #000000 !important;
            margin: 0;
            font-size: 11.5px !important;
            font-weight: 600;
            line-height: 1.35;
            font-family: Arial, Helvetica, sans-serif !important;
            text-align: center;
        }

        /* DOCUMENT TITLE */
        .doc-title-block {
            text-align: center;
            margin-bottom: 14px;
        }

        .doc-main-title {
            font-size: 12.5pt;
            font-weight: bold;
            text-decoration: underline;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #0f172a;
        }

        .doc-number {
            font-size: 9.5pt;
            margin-top: 2px;
            color: #334155;
            font-weight: 600;
        }

        /* SECTION STYLING */
        .doc-section-title {
            font-size: 10pt;
            font-weight: bold;
            text-transform: uppercase;
            background: #f1f5f9;
            padding: 3px 8px;
            border-left: 4px solid #0284c7;
            margin: 10px 0 6px 0;
            color: #1e293b;
        }

        /* DATA TABLE */
        .table-data {
            width: 100%;
            border-collapse: collapse;
            font-size: 9.5pt;
            margin-bottom: 6px;
        }

        .table-data td {
            padding: 2.5px 5px;
            vertical-align: top;
        }

        .table-data td.td-label {
            width: 26%;
            color: #334155;
            font-weight: 600;
        }

        .table-data td.td-colon {
            width: 2%;
            text-align: center;
        }

        .table-data td.td-value {
            width: 72%;
            color: #0f172a;
        }

        /* TWO-COLUMN GRID TABLE */
        .table-two-col {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 4px;
        }

        .table-two-col td {
            width: 50%;
            vertical-align: top;
            padding: 0 4px;
        }

        /* CHECKLIST TABLE */
        .table-checklist {
            width: 100%;
            border-collapse: collapse;
            font-size: 9pt;
            margin: 6px 0 10px 0;
        }

        .table-checklist th,
        .table-checklist td {
            border: 1px solid #94a3b8;
            padding: 4.5px 8px;
        }

        .table-checklist th {
            background-color: #f8fafc;
            color: #0f172a;
            font-weight: bold;
            text-align: center;
            text-transform: uppercase;
            font-size: 8.5pt;
        }

        .status-badge-doc {
            font-weight: bold;
            display: inline-block;
            padding: 1px 7px;
            border-radius: 4px;
            font-size: 8.5pt;
        }

        .status-badge-doc.valid {
            background-color: #dcfce7;
            color: #15803d;
            border: 1px solid #86efac;
        }

        .status-badge-doc.missing {
            background-color: #fee2e2;
            color: #b91c1c;
            border: 1px solid #fca5a5;
        }

        /* PHOTO GRID */
        .photo-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
            margin: 8px 0 12px 0;
        }

        .photo-box {
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            padding: 5px;
            background: #fafbfc;
            text-align: center;
        }

        .photo-box img {
            width: 100%;
            height: 105px;
            object-fit: cover;
            border-radius: 4px;
            border: 1px solid #e2e8f0;
            display: block;
        }

        .photo-placeholder {
            width: 100%;
            height: 105px;
            background: #f1f5f9;
            border: 1.5px dashed #94a3b8;
            border-radius: 4px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: #64748b;
            font-size: 8.5pt;
        }

        .photo-title {
            font-size: 8.5pt;
            font-weight: bold;
            color: #1e293b;
            margin-top: 4px;
        }

        /* RESULT BOX */
        .decision-box {
            border: 1.5px solid #0284c7;
            background: #f0f9ff;
            border-radius: 6px;
            padding: 8px 12px;
            margin: 8px 0 12px 0;
        }

        .decision-title {
            font-weight: bold;
            font-size: 10pt;
            color: #0369a1;
            margin-bottom: 3px;
        }

        .decision-desc {
            font-size: 9pt;
            color: #0c4a6e;
        }

        /* SIGNATURE SECTION */
        .signature-grid {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        .signature-grid td {
            width: 33.33%;
            text-align: center;
            vertical-align: top;
            font-size: 9.5pt;
            padding: 0 10px;
        }

        .sig-date {
            text-align: right;
            font-size: 9.5pt;
            margin-bottom: 12px;
            color: #1e293b;
        }

        .sig-role {
            font-weight: 600;
            color: #334155;
            margin-bottom: 52px;
        }

        .sig-name {
            font-weight: bold;
            text-decoration: underline;
            color: #0f172a;
        }

        .sig-title {
            font-size: 8.5pt;
            color: #475569;
            margin-top: 2px;
        }

        /* PRINT STYLING */
        @media print {
            @page {
                size: 215mm 330mm; /* F4 / Folio Size */
                margin: 12mm 15mm 15mm 15mm;
            }

            body {
                background: #ffffff;
                padding: 0;
                font-size: 10pt;
            }

            .no-print-bar {
                display: none !important;
            }

            .print-container {
                width: 100%;
                min-height: auto;
                margin: 0;
                padding: 0;
                box-shadow: none;
            }

            .doc-section-title {
                background-color: #f1f5f9 !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            .table-checklist th {
                background-color: #f8fafc !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            .status-badge-doc.valid {
                background-color: #dcfce7 !important;
                color: #15803d !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            .status-badge-doc.missing {
                background-color: #fee2e2 !important;
                color: #b91c1c !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            .decision-box {
                background: #f0f9ff !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            .page-break {
                page-break-after: always;
            }
        }
    </style>
</head>
<body>

    <!-- Floating Top Action Bar -->
    <div class="no-print-bar">
        <button onclick="window.print()" class="btn-action-print">
            <i class="mdi mdi-printer"></i>
            <span>Cetak Dokumen</span>
        </button>
        <button onclick="window.close()" class="btn-action-close">
            <i class="mdi mdi-close"></i>
            <span>Tutup</span>
        </button>
    </div>

    <!-- Printable Container -->
    <div class="print-container">
        <div class="watermark-bg">SURVEY LAPANGAN</div>

        <div class="content-wrap">
            <!-- KOP SURAT RESMI PT. GRAHA CIPTA SEJAHTERA (PATEN) -->
            <div class="document-header">
                <div class="document-header-inner">
                    <div class="header-logo-left">
                        @if(!empty($companyProfile?->logo) && file_exists(public_path('uploads/' . $companyProfile->logo)))
                            <img src="{{ asset('uploads/' . $companyProfile->logo) }}" alt="Logo" class="document-header-logo">
                        @elseif(!empty($companyProfile?->logo) && file_exists(public_path($companyProfile->logo)))
                            <img src="{{ asset($companyProfile->logo) }}" alt="Logo" class="document-header-logo">
                        @elseif(file_exists(public_path('images/logo.jpeg')))
                            <img src="{{ asset('images/logo.jpeg') }}" alt="Logo" class="document-header-logo">
                        @elseif(file_exists(public_path('images/logo1.png')))
                            <img src="{{ asset('images/logo1.png') }}" alt="Logo" class="document-header-logo">
                        @endif
                    </div>
                    <div class="document-header-text">
                        <h1 class="company-main-title">{{ $companyProfile->name ?? 'PT. GRAHA CIPTA SEJAHTERA' }}</h1>
                        <h2 class="company-sub-title">DEVELOPER PROPERTY & REAL ESTATE</h2>
                        <p class="company-address">
                            {{ $companyProfile->address ?? 'Jl. Letjen Panjaitan No. 45, Kebonsari, Kec. Sumbersari, Kabupaten Jember, Jawa Timur 68122' }}<br>
                            Telp: {{ $companyProfile->phone ?? '0812-3456-7890' }} | Email: {{ $companyProfile->email ?? 'grahaciptasejahtera@gmail.com' }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- TITLE BLOCK -->
            <div class="doc-title-block">
                <div class="doc-main-title">LAPORAN HASIL SURVEY LAPANGAN KPR</div>
                @php
                    $surveyDate = $application->survey_date ? \Carbon\Carbon::parse($application->survey_date) : \Carbon\Carbon::parse($application->created_at);
                    $docNo = 'SRV/' . $surveyDate->format('Ymd') . '/' . str_pad($application->id, 4, '0', STR_PAD_LEFT);
                @endphp
                <div class="doc-number">Nomor: {{ $docNo }}</div>
            </div>

            <!-- RINGKASAN JADWAL & SURVEYOR -->
            <table class="table-data" style="margin-bottom: 8px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 4px; padding: 4px 8px;">
                <tr>
                    <td style="width: 18%; font-weight: 600; color: #334155;">Tanggal Survey</td>
                    <td style="width: 2%;">:</td>
                    <td style="width: 30%; font-weight: bold; color: #0f172a;">
                        {{ $application->survey_date ? \Carbon\Carbon::parse($application->survey_date)->translatedFormat('l, d F Y') : 'Belum Dijadwalkan' }}
                    </td>
                    <td style="width: 18%; font-weight: 600; color: #334155;">Surveyor / Penilai</td>
                    <td style="width: 2%;">:</td>
                    <td style="width: 30%; font-weight: bold; color: #0f172a;">
                        {{ $application->surveyor->name ?? 'Tim Surveyor Legal' }} ({{ $application->surveyor->position->name ?? 'Surveyor' }})
                    </td>
                </tr>
                <tr>
                    <td style="font-weight: 600; color: #334155;">Waktu Pelaksanaan</td>
                    <td>:</td>
                    <td style="color: #0f172a;">
                        {{ $application->survey_time ? (is_string($application->survey_time) ? substr($application->survey_time, 0, 5) . ' WIB' : \Carbon\Carbon::parse($application->survey_time)->format('H:i') . ' WIB') : '-' }}
                    </td>
                    <td style="font-weight: 600; color: #334155;">Bank Pengajuan</td>
                    <td>:</td>
                    <td style="font-weight: bold; color: #0284c7;">
                        {{ $application->bank->bank_name ?? '-' }}
                    </td>
                </tr>
            </table>

            <!-- SECTION I: DATA PEMOHON -->
            <div class="doc-section-title">I. IDENTITAS PEMOHON KPR (CUSTOMER)</div>
            <table class="table-data">
                <tr>
                    <td class="td-label">Nama Lengkap</td>
                    <td class="td-colon">:</td>
                    <td class="td-value" style="font-weight: bold;">{{ $application->customer->full_name ?? '-' }}</td>
                </tr>
                <tr>
                    <td class="td-label">Nomor Induk Kependudukan (NIK)</td>
                    <td class="td-colon">:</td>
                    <td class="td-value">{{ $application->customer->nik ?? '-' }}</td>
                </tr>
                <tr>
                    <td class="td-label">No. Telepon / WhatsApp</td>
                    <td class="td-colon">:</td>
                    <td class="td-value">{{ $application->customer->phone ?? '-' }}</td>
                </tr>
                <tr>
                    <td class="td-label">Pekerjaan / Profesi</td>
                    <td class="td-colon">:</td>
                    <td class="td-value">{{ $application->customer->job ?? ($application->customer->pekerjaan ?? 'Karyawan / Wiraswasta') }}</td>
                </tr>
                <tr>
                    <td class="td-label">Alamat Sesuai KTP</td>
                    <td class="td-colon">:</td>
                    <td class="td-value">{{ $application->customer->address ?? ($application->customer->alamat ?? '-') }}</td>
                </tr>
            </table>

            <!-- SECTION II: DATA OBJEK PROPERTI -->
            <div class="doc-section-title">II. SPESIFIKASI OBJEK PROPERTI</div>
            <table class="table-data">
                <tr>
                    <td class="td-label">Proyek / Lokasi Perumahan</td>
                    <td class="td-colon">:</td>
                    <td class="td-value" style="font-weight: bold;">{{ $application->unit->landBank->name ?? 'Proyek Perumahan' }}</td>
                </tr>
                <tr>
                    <td class="td-label">Unit & Kavling</td>
                    <td class="td-colon">:</td>
                    <td class="td-value" style="font-weight: bold; color: #004b93;">
                        {{ $application->unit->unit_name ?? '-' }} (Blok {{ $application->unit->block ?? '-' }} No. {{ $application->unit->unit_number ?? ($application->unit->unit_code ?? '-') }})
                    </td>
                </tr>
                <tr>
                    <td class="td-label">Jenis & Tipe Unit</td>
                    <td class="td-colon">:</td>
                    <td class="td-value">{{ ucfirst($application->unit->jenis ?? 'KPR') }} - Tipe {{ $application->unit->type ?? 'Standar' }}</td>
                </tr>
                <tr>
                    <td class="td-label">Dimensi Tanah & Bangunan</td>
                    <td class="td-colon">:</td>
                    <td class="td-value">
                        Luas Tanah (LT): <strong>{{ $application->unit->surface_area ?? ($application->luas_tanah ?? 0) }} m²</strong> &nbsp;|&nbsp; 
                        Luas Bangunan (LB): <strong>{{ $application->unit->building_area ?? ($application->luas_bangunan ?? 0) }} m²</strong>
                    </td>
                </tr>
                <tr>
                    <td class="td-label">Arah Hadap & Posisi</td>
                    <td class="td-colon">:</td>
                    <td class="td-value">{{ $application->unit->direction ?? 'Hadap Depan' }} (Posisi: {{ $application->unit->position ?? 'Standar' }})</td>
                </tr>
            </table>

            <!-- SECTION III: PENILAIAN & FINANSIAL KPR -->
            <div class="doc-section-title">III. PENILAIAN & FINANSIAL KPR</div>
            <table class="table-data">
                <tr>
                    <td class="td-label">Harga Unit (Nilai Pasar)</td>
                    <td class="td-colon">:</td>
                    <td class="td-value" style="font-weight: bold;">Rp {{ number_format($application->harga_unit ?? ($application->unit->price ?? 0), 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td class="td-label">Nilai Appraisal / Taksasi Bank</td>
                    <td class="td-colon">:</td>
                    <td class="td-value" style="font-weight: bold; color: #15803d;">
                        Rp {{ number_format($application->appraisal_value ?? ($application->jumlah_pinjaman ?? 0), 0, ',', '.') }}
                    </td>
                </tr>
                <tr>
                    <td class="td-label">Uang Muka (DP)</td>
                    <td class="td-colon">:</td>
                    <td class="td-value">Rp {{ number_format($application->dp ?? 0, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td class="td-label">Plafond Pinjaman KPR Disetujui</td>
                    <td class="td-colon">:</td>
                    <td class="td-value" style="font-weight: bold;">Rp {{ number_format($application->jumlah_pinjaman ?? 0, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td class="td-label">Jangka Waktu (Tenor) & Angsuran</td>
                    <td class="td-colon">:</td>
                    <td class="td-value">{{ $application->tenor ?? '-' }} Tahun &nbsp;|&nbsp; Estimasi Rp {{ number_format($application->estimasi_angsuran ?? 0, 0, ',', '.') }} / bulan</td>
                </tr>
            </table>

            <!-- SECTION IV: CHECKLIST KONDISI FISIK & LEGALITAS -->
            <div class="doc-section-title">IV. HASIL CHECKLIST KONDISI FISIK & LEGALITAS LAPANGAN</div>
            <table class="table-checklist">
                <thead>
                    <tr>
                        <th style="width: 6%;">No</th>
                        <th style="width: 38%; text-align: left;">Item Pemeriksaan Lapangan</th>
                        <th style="width: 26%;">Standar / Kriteria</th>
                        <th style="width: 30%;">Status Hasil Survey</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="text-align: center; font-weight: bold;">1</td>
                        <td style="font-weight: 600;">Instalasi Listrik & Penerangan</td>
                        <td>Tersedia & Siap Sambung PLN</td>
                        <td style="text-align: center;">
                            @if($application->listrik)
                                <span class="status-badge-doc valid"><i class="mdi mdi-check-circle"></i> Memenuhi Syarat</span>
                            @else
                                <span class="status-badge-doc missing"><i class="mdi mdi-close-circle"></i> Belum Memenuhi</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: center; font-weight: bold;">2</td>
                        <td style="font-weight: 600;">Sumber Air Bersih / PDAM</td>
                        <td>Tersedia Jaringan Air Bersih</td>
                        <td style="text-align: center;">
                            @if($application->air)
                                <span class="status-badge-doc valid"><i class="mdi mdi-check-circle"></i> Memenuhi Syarat</span>
                            @else
                                <span class="status-badge-doc missing"><i class="mdi mdi-close-circle"></i> Belum Memenuhi</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: center; font-weight: bold;">3</td>
                        <td style="font-weight: 600;">Akses Jalan & Saluran Lingkungan</td>
                        <td>Akses Mobil & Saluran Terintegrasi</td>
                        <td style="text-align: center;">
                            @if($application->akses)
                                <span class="status-badge-doc valid"><i class="mdi mdi-check-circle"></i> Memenuhi Syarat</span>
                            @else
                                <span class="status-badge-doc missing"><i class="mdi mdi-close-circle"></i> Belum Memenuhi</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: center; font-weight: bold;">4</td>
                        <td style="font-weight: 600;">Legalitas Sertifikat Tanah (SHM/SHGB)</td>
                        <td>Sesuai Kavling & Bebas Sengketa</td>
                        <td style="text-align: center;">
                            @if($application->sertifikat || $application->shm)
                                <span class="status-badge-doc valid"><i class="mdi mdi-check-circle"></i> Sesuai & Terverifikasi</span>
                            @else
                                <span class="status-badge-doc missing"><i class="mdi mdi-close-circle"></i> Dalam Proses</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: center; font-weight: bold;">5</td>
                        <td style="font-weight: 600;">Izin Mendirikan Bangunan (IMB / PBG)</td>
                        <td>IMB / PBG Unit Resmi Terbit</td>
                        <td style="text-align: center;">
                            @if($application->imb)
                                <span class="status-badge-doc valid"><i class="mdi mdi-check-circle"></i> Lengkap / Terbit</span>
                            @else
                                <span class="status-badge-doc missing"><i class="mdi mdi-close-circle"></i> Belum Terbit</span>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>

            <!-- SECTION V: LAMPIRAN DOKUMENTASI FOTO -->
            <div class="doc-section-title">V. LAMPIRAN DOKUMENTASI FOTO SURVEY LAPANGAN</div>
            <div class="photo-grid">
                <!-- 1. Foto Tampak Depan -->
                <div class="photo-box">
                    @php
                        $fotoDepan = null;
                        if (!empty($application->foto_depan)) {
                            if (file_exists(public_path('uploads/' . $application->foto_depan))) {
                                $fotoDepan = asset('uploads/' . $application->foto_depan);
                            } elseif (file_exists(storage_path('app/public/' . $application->foto_depan))) {
                                $fotoDepan = asset('storage/' . $application->foto_depan);
                            } elseif (file_exists(public_path($application->foto_depan))) {
                                $fotoDepan = asset($application->foto_depan);
                            }
                        }
                    @endphp

                    @if($fotoDepan)
                        <img src="{{ $fotoDepan }}" alt="Foto Depan Unit">
                    @else
                        <div class="photo-placeholder">
                            <i class="mdi mdi-camera" style="font-size: 1.5rem; margin-bottom: 2px;"></i>
                            <span>Foto Tampak Depan</span>
                        </div>
                    @endif
                    <div class="photo-title">Tampak Depan Unit</div>
                </div>

                <!-- 2. Foto Interior -->
                <div class="photo-box">
                    @php
                        $fotoInterior = null;
                        if (!empty($application->foto_interior)) {
                            if (file_exists(public_path('uploads/' . $application->foto_interior))) {
                                $fotoInterior = asset('uploads/' . $application->foto_interior);
                            } elseif (file_exists(storage_path('app/public/' . $application->foto_interior))) {
                                $fotoInterior = asset('storage/' . $application->foto_interior);
                            } elseif (file_exists(public_path($application->foto_interior))) {
                                $fotoInterior = asset($application->foto_interior);
                            }
                        }
                    @endphp

                    @if($fotoInterior)
                        <img src="{{ $fotoInterior }}" alt="Foto Interior Unit">
                    @else
                        <div class="photo-placeholder">
                            <i class="mdi mdi-camera" style="font-size: 1.5rem; margin-bottom: 2px;"></i>
                            <span>Foto Interior / Ruangan</span>
                        </div>
                    @endif
                    <div class="photo-title">Interior & Tata Ruang</div>
                </div>

                <!-- 3. Foto Lingkungan -->
                <div class="photo-box">
                    @php
                        $fotoLingkungan = null;
                        if (!empty($application->foto_lingkungan)) {
                            if (file_exists(public_path('uploads/' . $application->foto_lingkungan))) {
                                $fotoLingkungan = asset('uploads/' . $application->foto_lingkungan);
                            } elseif (file_exists(storage_path('app/public/' . $application->foto_lingkungan))) {
                                $fotoLingkungan = asset('storage/' . $application->foto_lingkungan);
                            } elseif (file_exists(public_path($application->foto_lingkungan))) {
                                $fotoLingkungan = asset($application->foto_lingkungan);
                            }
                        }
                    @endphp

                    @if($fotoLingkungan)
                        <img src="{{ $fotoLingkungan }}" alt="Foto Lingkungan">
                    @else
                        <div class="photo-placeholder">
                            <i class="mdi mdi-camera" style="font-size: 1.5rem; margin-bottom: 2px;"></i>
                            <span>Foto Lingkungan Sekitar</span>
                        </div>
                    @endif
                    <div class="photo-title">Akses & Lingkungan Sekitar</div>
                </div>
            </div>

            <!-- SECTION VI: KESIMPULAN & REKOMENDASI SURVEY -->
            <div class="doc-section-title">VI. CATATAN & REKOMENDASI KELAYAKAN SURVEYOR</div>
            <div class="decision-box">
                @php
                    $isLayak = strtolower($application->rekomendasi ?? '') === 'layak';
                    $rekomendasiText = $application->rekomendasi ?? 'Layak';
                @endphp
                <div class="decision-title" style="display: flex; justify-content: space-between; align-items: center;">
                    <span>KESIMPULAN: REKOMENDASI UNIT {{ strtoupper($rekomendasiText) }}</span>
                    <span style="font-size: 9pt; font-weight: normal; color: #475569;">
                        Persentase Penilaian: <strong>{{ number_format($application->persentase_kelayakan ?? 100, 0) }}%</strong>
                    </span>
                </div>
                <div class="decision-desc">
                    <strong>Catatan Lapangan:</strong> 
                    {{ !empty($application->catatan_survey) ? $application->catatan_survey : 'Berdasarkan hasil peninjauan dan survey fisik di lokasi, seluruh aspek fisik, aksesibilitas, infrastruktur penunjang, dan legalitas objek properti telah diperiksa dan dinyatakan memenuhi standar kelayakan operasional perbankan.' }}
                </div>
            </div>

        </div>
    </div>

</body>
</html>
