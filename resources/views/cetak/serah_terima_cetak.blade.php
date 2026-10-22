<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Berita Acara Serah Terima (BAST) Unit - {{ $booking->customer->full_name ?? ($booking->booking_code ?? 'BAST') }}</title>
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
            line-height: 1.45;
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
            padding: 16mm 20mm 20mm 20mm;
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
            margin-bottom: 16px;
            border-bottom: 3.5px double #004b93;
            padding-bottom: 12px;
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
            height: 72px;
            max-width: 130px;
            object-fit: contain;
        }

        .document-header-text {
            text-align: center;
            width: 100%;
            padding: 0 65px;
        }

        .company-main-title {
            color: #004b93 !important;
            font-size: 25px !important;
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
            font-size: 16px !important;
            font-weight: 800 !important;
            letter-spacing: 0.3px;
            margin: 0 0 4px 0;
            font-family: 'Plus Jakarta Sans', 'Segoe UI', Arial, sans-serif !important;
            text-align: center;
        }

        .company-address {
            color: #000000 !important;
            margin: 0;
            font-size: 12px !important;
            font-weight: 600;
            line-height: 1.35;
            font-family: Arial, Helvetica, sans-serif !important;
            text-align: center;
        }

        /* DOCUMENT TITLE */
        .doc-title-block {
            text-align: center;
            margin-bottom: 16px;
        }

        .doc-main-title {
            font-size: 13pt;
            font-weight: bold;
            text-decoration: underline;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #0f172a;
        }

        .doc-number {
            font-size: 10pt;
            margin-top: 3px;
            color: #334155;
            font-weight: 600;
        }

        .paragraph {
            font-size: 10.5pt;
            line-height: 1.5;
            text-align: justify;
            margin-bottom: 14px;
        }

        /* SECTION STYLING */
        .doc-section-title {
            font-size: 10.5pt;
            font-weight: bold;
            text-transform: uppercase;
            background: #f1f5f9;
            padding: 5px 10px;
            border-left: 4px solid #004b93;
            margin: 14px 0 8px 0;
            color: #1e293b;
        }

        /* DATA TABLE */
        .table-data {
            width: 100%;
            border-collapse: collapse;
            font-size: 10pt;
            margin-bottom: 8px;
        }

        .table-data td {
            padding: 3.5px 6px;
            vertical-align: top;
        }

        .table-data td.td-label {
            width: 30%;
            color: #334155;
            font-weight: 600;
        }

        .table-data td.td-colon {
            width: 3%;
            text-align: center;
        }

        .table-data td.td-value {
            width: 67%;
            color: #0f172a;
        }

        /* CHECKLIST & DOCS TABLE */
        .table-checklist {
            width: 100%;
            border-collapse: collapse;
            font-size: 9.5pt;
            margin: 8px 0 12px 0;
        }

        .table-checklist th,
        .table-checklist td {
            border: 1px solid #94a3b8;
            padding: 6px 9px;
        }

        .table-checklist th {
            background-color: #f8fafc;
            color: #0f172a;
            font-weight: bold;
            text-align: center;
            text-transform: uppercase;
            font-size: 9pt;
        }

        .table-checklist td.text-center {
            text-align: center;
        }

        .badge-status-pills {
            font-weight: 700;
            display: inline-block;
            padding: 2px 10px;
            border-radius: 4px;
            font-size: 8.5pt;
        }

        .badge-status-pills.baik {
            background-color: #dcfce7;
            color: #15803d;
            border: 1px solid #86efac;
        }

        .badge-status-pills.perbaikan {
            background-color: #fee2e2;
            color: #b91c1c;
            border: 1px solid #fca5a5;
        }

        .badge-status-pills.diserahkan {
            background-color: #e0f2fe;
            color: #0369a1;
            border: 1px solid #7dd3fc;
        }

        .badge-status-pills.proses {
            background-color: #fef3c7;
            color: #b45309;
            border: 1px solid #fde68a;
        }

        .notes-box {
            padding: 10px 14px;
            background: #f8fafc;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            font-size: 9.5pt;
            line-height: 1.5;
            margin-top: 4px;
            color: #1e293b;
        }

        .photo-card {
            flex: 1;
            border: 1px solid #cbd5e1;
            padding: 10px;
            border-radius: 6px;
            text-align: center;
            background: #f8fafc;
        }

        .photo-card img {
            max-width: 100%;
            max-height: 160px;
            object-fit: contain;
            border-radius: 4px;
            border: 1px solid #e2e8f0;
            background: #ffffff;
        }

        /* SIGNATURE SECTION */
        .signature-grid {
            width: 100%;
            margin-top: 30px;
            border-collapse: collapse;
            page-break-inside: avoid;
        }

        .signature-grid td {
            width: 32%;
            text-align: center;
            vertical-align: top;
            font-size: 10pt;
            padding: 0 10px;
        }

        .sig-role {
            font-weight: 600;
            color: #334155;
            margin-bottom: 60px;
        }

        .sig-name {
            font-weight: bold;
            text-decoration: underline;
            color: #0f172a;
        }

        .sig-title {
            font-size: 8.5pt;
            color: #64748b;
            margin-top: 2px;
        }

        .footer-note {
            margin-top: 26px;
            text-align: center;
            font-size: 8pt;
            color: #64748b;
            border-top: 1px dashed #cbd5e1;
            padding-top: 10px;
            page-break-inside: avoid;
        }

        /* PRINT STYLES */
        @media print {
            body {
                background: #ffffff !important;
                padding: 0 !important;
                margin: 0 !important;
            }

            .no-print-bar {
                display: none !important;
            }

            .print-container {
                width: 100% !important;
                min-height: auto !important;
                padding: 0 !important;
                margin: 0 !important;
                box-shadow: none !important;
            }

            .watermark-bg {
                opacity: 0.1 !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            @page {
                size: 215mm 330mm portrait; /* Kertas F4 / Folio Indonesia */
                margin: 14mm 15mm;
            }
        }
    </style>
</head>
<body>

    @php
        if (!function_exists('resolveFileUrl')) {
            function resolveFileUrl(?string $path): string {
                if (empty($path)) return '';
                if (preg_match('/^https?:\/\//i', $path)) return $path;
                $cleanPath = ltrim($path, '/');
                if (file_exists(public_path($cleanPath))) return asset($cleanPath);
                if (!str_starts_with($cleanPath, 'uploads/') && file_exists(public_path('uploads/' . $cleanPath))) return asset('uploads/' . $cleanPath);
                if (!str_starts_with($cleanPath, 'storage/') && file_exists(public_path('storage/' . $cleanPath))) return asset('storage/' . $cleanPath);
                if (str_starts_with($cleanPath, 'uploads/') || str_starts_with($cleanPath, 'storage/')) return asset($cleanPath);
                return asset('uploads/' . $cleanPath);
            }
        }

        $statusSerahTerima = 'Selesai';

        if (isset($serahTerima) && $serahTerima && $serahTerima->items && $serahTerima->items->count() > 0) {
            $checklists = $serahTerima->items->map(function($item) {
                return [
                    'nama' => $item->item_name,
                    'status' => (bool)$item->is_checked,
                    'keterangan' => $item->status ?? ($item->is_checked ? 'Baik' : 'Perlu Perbaikan')
                ];
            })->toArray();
        } else {
            $checklists = [
                ['nama' => 'Listrik & Instalasi Penerangan', 'status' => true, 'keterangan' => 'Berfungsi Normal'],
                ['nama' => 'Saluran Air Bersih & Kran', 'status' => true, 'keterangan' => 'Mengalir Lancar'],
                ['nama' => 'Pintu, Jendela, Kunci & Kusen', 'status' => true, 'keterangan' => 'Berfungsi Baik'],
                ['nama' => 'Kelengkapan Kunci Unit (Utama & Kamar)', 'status' => true, 'keterangan' => 'Lengkap Diserahkan'],
                ['nama' => 'Kondisi Dinding, Cat & Plafon', 'status' => true, 'keterangan' => 'Rapi & Baik'],
                ['nama' => 'Lantai Keramik / Granit', 'status' => true, 'keterangan' => 'Rapi & Baik'],
                ['nama' => 'Sanitasi, Kloset & Saluran Buang', 'status' => true, 'keterangan' => 'Berfungsi Normal'],
                ['nama' => 'Meteran Listrik (PLN) & Air', 'status' => true, 'keterangan' => 'Terpasang'],
            ];
        }

        if (isset($serahTerima) && $serahTerima && $serahTerima->documents && $serahTerima->documents->count() > 0) {
            $dokumenDiserahkan = $serahTerima->documents->map(function($doc) {
                return [
                    'nama' => $doc->document_name,
                    'status' => (bool)$doc->is_submitted,
                    'keterangan' => $doc->status ?? ($doc->is_submitted ? 'Diserahkan' : 'Proses')
                ];
            })->toArray();
        } else {
            $dokumenDiserahkan = [
                ['nama' => 'Kunci Fisik Unit & Cadangan', 'status' => true, 'keterangan' => 'Diserahkan'],
                ['nama' => 'Salinan Berkas Akad / SPK', 'status' => true, 'keterangan' => 'Lengkap'],
                ['nama' => 'Sertifikat & Legalitas Unit Terdaftar', 'status' => true, 'keterangan' => 'Arsip Resmi'],
                ['nama' => 'Buku Petunjuk & Garansi Bangunan', 'status' => true, 'keterangan' => 'Aktif'],
            ];
        }
    @endphp

    <!-- Floating Top Action Bar -->
    <div class="no-print-bar">
        <button class="btn-action-close" onclick="window.close(); if(!window.closed){ history.back(); }">
            <i class="mdi mdi-arrow-left"></i> Tutup / Kembali
        </button>
        <button class="btn-action-print" onclick="window.print()">
            <i class="mdi mdi-printer"></i> Cetak / Simpan PDF
        </button>
    </div>

    <!-- Printable Container -->
    <div class="print-container">
        <!-- Subtle Watermark -->
        <div class="watermark-bg">BAST SERAH TERIMA</div>

        <div class="content-wrap">
            <!-- Kop Surat Resmi -->
            <div class="document-header">
                <div class="document-header-inner">
                    <div class="header-logo-left">
                        <img src="{{ asset('images/logo1.png') }}" alt="Logo PT. Graha Cipta Sejahtera" class="document-header-logo">
                    </div>
                    <div class="document-header-text">
                        <h2 class="company-main-title">PT. GRAHA CIPTA SEJAHTERA</h2>
                        <div class="company-sub-title">Developer &amp; General Contractor</div>
                        <p class="company-address">Kantor : Jl. Letjen Sutoyo No. 99 A Jember &nbsp;&nbsp; Telp. : 0331 - 331447, 0331 - 321533</p>
                    </div>
                </div>
            </div>

            <!-- Document Title Block -->
            <div class="doc-title-block">
                <div class="doc-main-title">BERITA ACARA SERAH TERIMA (BAST) UNIT</div>
                <div class="doc-number">
                    Nomor: <strong>{{ $serahTerima->no_bast ?? ($serahTerima->nomor_bast ?? 'BAST/' . date('m/Y') . '/' . str_pad($booking->id ?? 1, 3, '0', STR_PAD_LEFT)) }}</strong>
                </div>
            </div>

            <!-- Opening Paragraph -->
            <div class="paragraph">
                Pada hari ini,
                <strong>{{ \Carbon\Carbon::parse($serahTerima->tanggal_serah_terima ?? ($booking->serah_terima_date ?? now()))->translatedFormat('l, d F Y') }}</strong>,
                bertempat di
                <strong>{{ $serahTerima->lokasi_serah_terima ?? 'Lokasi Proyek Perumahan' }}</strong>,
                telah dilakukan serah terima fisik bangunan dan kelengkapan dokumen unit properti dari pihak pengembang kepada pihak pembeli/konsumen dengan rincian data sebagai berikut:
            </div>

            <!-- I. DATA KONSUMEN / PEMBELI -->
            <div class="doc-section-title">I. DATA KONSUMEN / PEMBELI</div>
            <table class="table-data">
                <tr>
                    <td class="td-label">Nama Lengkap Konsumen</td>
                    <td class="td-colon">:</td>
                    <td class="td-value"><strong>{{ $booking->customer->full_name ?? '-' }}</strong></td>
                </tr>
                <tr>
                    <td class="td-label">NIK (Nomor Induk Kependudukan)</td>
                    <td class="td-colon">:</td>
                    <td class="td-value">{{ $booking->customer->nik ?? '-' }}</td>
                </tr>
                <tr>
                    <td class="td-label">Nomor Telepon / WhatsApp</td>
                    <td class="td-colon">:</td>
                    <td class="td-value">{{ $booking->customer->phone ?? '-' }}</td>
                </tr>
                <tr>
                    <td class="td-label">Kode Booking Transaksi</td>
                    <td class="td-colon">:</td>
                    <td class="td-value"><strong style="font-family: monospace;">{{ $booking->booking_code ?? '-' }}</strong></td>
                </tr>
                <tr>
                    <td class="td-label">Skema Pembelian</td>
                    <td class="td-colon">:</td>
                    <td class="td-value"><strong>{{ strtoupper($booking->payment_method ?? 'KPR / CASH') }}</strong></td>
                </tr>
            </table>

            <!-- II. RINCIAN UNIT PROPERTI -->
            <div class="doc-section-title">II. RINCIAN UNIT PROPERTI</div>
            <table class="table-data">
                <tr>
                    <td class="td-label">Nama Proyek / Perumahan</td>
                    <td class="td-colon">:</td>
                    <td class="td-value"><strong>{{ $unit->unit_name ?? ($booking->unit->unit_name ?? '-') }}</strong></td>
                </tr>
                <tr>
                    <td class="td-label">Blok &amp; Nomor Unit</td>
                    <td class="td-colon">:</td>
                    <td class="td-value"><strong>Blok {{ $unit->unit_code ?? ($booking->unit->unit_code ?? '-') }}</strong></td>
                </tr>
                <tr>
                    <td class="td-label">Tipe / Luas Tanah &amp; Bangunan</td>
                    <td class="td-colon">:</td>
                    <td class="td-value">{{ $unit->type ?? ($booking->unit->type ?? 'Standar') }} (LT: {{ $unit->land_area ?? '-' }} m² / LB: {{ $unit->building_area ?? '-' }} m²)</td>
                </tr>
                <tr>
                    <td class="td-label">Harga Jual Unit</td>
                    <td class="td-colon">:</td>
                    <td class="td-value"><strong>Rp {{ number_format($unit->price ?? ($booking->unit->price ?? 0), 0, ',', '.') }}</strong></td>
                </tr>
                <tr>
                    <td class="td-label">Status Serah Terima</td>
                    <td class="td-colon">:</td>
                    <td class="td-value">
                        <span class="badge-status-pills baik">
                            SELESAI (Unit Diserahterimakan)
                        </span>
                    </td>
                </tr>
            </table>

            <!-- III. PIHAK PENYERAH & PENERIMA -->
            <div class="doc-section-title">III. PIHAK PENYERAH &amp; PENERIMA</div>
            <table class="table-data">
                <tr>
                    <td class="td-label">Diserahkan Oleh</td>
                    <td class="td-colon">:</td>
                    <td class="td-value"><strong>{{ $serahTerima->handled_by_name ?? ($booking->sales->name ?? 'Tim Marketing & Legal') }}</strong></td>
                </tr>
                <tr>
                    <td class="td-label">Jabatan / Peran</td>
                    <td class="td-colon">:</td>
                    <td class="td-value">{{ $serahTerima->handled_by_role ?? 'Pengelola / Marketing Resmi' }}</td>
                </tr>
                <tr>
                    <td class="td-label">Diterima Oleh</td>
                    <td class="td-colon">:</td>
                    <td class="td-value"><strong>{{ $booking->customer->full_name ?? '-' }}</strong> (Konsumen)</td>
                </tr>
                <tr>
                    <td class="td-label">Saksi Serah Terima</td>
                    <td class="td-colon">:</td>
                    <td class="td-value">{{ $serahTerima->saksi ?? '-' }}</td>
                </tr>
            </table>

            <!-- IV. CHECKLIST HASIL PEMERIKSAAN FISIK UNIT -->
            <div class="doc-section-title">IV. CHECKLIST HASIL PEMERIKSAAN FISIK UNIT</div>
            <table class="table-checklist">
                <thead>
                    <tr>
                        <th style="width: 7%;">No</th>
                        <th>Item Pemeriksaan Fisik Bangunan</th>
                        <th style="width: 24%;">Kondisi</th>
                        <th style="width: 30%;">Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($checklists as $i => $item)
                    <tr>
                        <td class="text-center">{{ $i + 1 }}</td>
                        <td><strong>{{ is_array($item) ? $item['nama'] : $item->nama }}</strong></td>
                        <td class="text-center">
                            @if(is_array($item) ? $item['status'] : $item->status)
                                <span class="badge-status-pills baik">Baik / Sesuai</span>
                            @else
                                <span class="badge-status-pills perbaikan">Perlu Perbaikan</span>
                            @endif
                        </td>
                        <td>{{ is_array($item) ? ($item['keterangan'] ?? '-') : ($item->keterangan ?? '-') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- V. DOKUMEN & KELENGKAPAN YANG DISERAHKAN -->
            <div class="doc-section-title">V. DOKUMEN &amp; KELENGKAPAN YANG DISERAHKAN</div>
            <table class="table-checklist">
                <thead>
                    <tr>
                        <th style="width: 7%;">No</th>
                        <th>Nama Dokumen / Item Perlengkapan</th>
                        <th style="width: 24%;">Status Penyerahan</th>
                        <th style="width: 30%;">Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($dokumenDiserahkan as $i => $doc)
                    <tr>
                        <td class="text-center">{{ $i + 1 }}</td>
                        <td><strong>{{ is_array($doc) ? $doc['nama'] : $doc->nama }}</strong></td>
                        <td class="text-center">
                            @if((is_array($doc) ? $doc['status'] : $doc->status))
                                <span class="badge-status-pills diserahkan">Diserahkan</span>
                            @else
                                <span class="badge-status-pills proses">Dalam Proses</span>
                            @endif
                        </td>
                        <td>{{ is_array($doc) ? ($doc['keterangan'] ?? '-') : ($doc->keterangan ?? '-') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- VI. DOKUMENTASI FOTO SERAH TERIMA -->
            @if($serahTerima && ($serahTerima->foto_serah_kunci || $serahTerima->foto_kondisi_unit))
            <div class="doc-section-title">VI. DOKUMENTASI FOTO SERAH TERIMA</div>
            <div style="display: flex; gap: 16px; margin-top: 8px; page-break-inside: avoid;">
                @if($serahTerima->foto_serah_kunci)
                    <div class="photo-card">
                        <strong style="font-size: 9pt; display: block; margin-bottom: 6px; color: #1e293b;">Foto Serah Terima Kunci</strong>
                        <img src="{{ resolveFileUrl($serahTerima->foto_serah_kunci) }}" alt="Foto Kunci">
                    </div>
                @endif
                @if($serahTerima->foto_kondisi_unit)
                    <div class="photo-card">
                        <strong style="font-size: 9pt; display: block; margin-bottom: 6px; color: #1e293b;">Foto Kondisi Fisik Unit</strong>
                        <img src="{{ resolveFileUrl($serahTerima->foto_kondisi_unit) }}" alt="Foto Kondisi Unit">
                    </div>
                @endif
            </div>
            @endif

            <!-- VII. CATATAN & PERNYATAAN BERSAMA -->
            <div class="doc-section-title">{{ ($serahTerima && ($serahTerima->foto_serah_kunci || $serahTerima->foto_kondisi_unit)) ? 'VII' : 'VI' }}. CATATAN &amp; PERNYATAAN BERSAMA</div>
            <div class="notes-box">
                <strong>Catatan Khusus:</strong><br>
                {{ $serahTerima->catatan ?? 'Tidak ada catatan tambahan. Unit properti diserahterimakan dalam keadaan baik, bersih, dan siap untuk dihuni.' }}
            </div>
            <div class="paragraph" style="margin-top: 10px; margin-bottom: 0; font-size: 10pt;">
                Dengan ditandatanganinya Berita Acara Serah Terima (BAST) Unit ini, maka pihak pembeli menyatakan bahwa fisik bangunan dan dokumen unit telah diterima dalam kondisi baik, layak huni, dan sesuai dengan spesifikasi checklist pemeriksaan. Segala hak pemanfaatan unit beralih kepada pembeli sejak tanggal serah terima ini.
            </div>

            <!-- LEMBAR TANDA TANGAN -->
            <table class="signature-grid">
                <tr>
                    <td>
                        <div class="sig-role">Pihak Pengembang (Menyerahkan),</div>
                        <div class="sig-name">{{ $serahTerima->handled_by_name ?? ($booking->sales->name ?? 'Tim Marketing & Legal') }}</div>
                        <div class="sig-title">{{ $serahTerima->handled_by_role ?? 'Pengelola / Marketing Resmi' }}</div>
                    </td>

                    <td>
                        <div class="sig-role">Konsumen / Pembeli (Menerima),</div>
                        <div class="sig-name">{{ $booking->customer->full_name ?? '________________________' }}</div>
                        <div class="sig-title">Customer / Pemilik Unit</div>
                    </td>

                    <td>
                        <div class="sig-role">Saksi Pihak Terkait,</div>
                        <div class="sig-name">{{ $serahTerima->saksi ?? '________________________' }}</div>
                        <div class="sig-title">Saksi Serah Terima</div>
                    </td>
                </tr>
            </table>

            <!-- FOOTER -->
            <div class="footer-note">
                <p>Dokumen ini sah dan diterbitkan secara resmi oleh Sistem Manajemen Properti PT. Graha Cipta Sejahtera</p>
                <p>Waktu Cetak Dokumen: {{ date('d/m/Y H:i:s') }} WIB &bull; Kode Transaksi: {{ $booking->booking_code ?? '-' }}</p>
            </div>
        </div>
    </div>

</body>
</html>
