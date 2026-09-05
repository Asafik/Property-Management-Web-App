<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lembar Rincian Transaksi & Legalitas Notaris - {{ $booking->booking_code ?? 'REKAP-TRS' }}</title>
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
            font-size: 11pt;
            line-height: 1.45;
            padding: 20px 0;
        }

        /* Floating Top Action Bar (Identik BA) */
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

        /* Printable Sheet Container (F4 Size: 215mm x 330mm) */
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
            font-size: 60pt;
            font-weight: bold;
            color: rgba(0, 75, 147, 0.04);
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
            font-size: 26px !important;
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
            font-size: 16.5px !important;
            font-weight: 800 !important;
            letter-spacing: 0.3px;
            margin: 0 0 4px 0;
            font-family: 'Plus Jakarta Sans', 'Segoe UI', Arial, sans-serif !important;
            text-align: center;
        }

        .company-address {
            color: #000000 !important;
            margin: 0;
            font-size: 12.5px !important;
            font-weight: 600;
            line-height: 1.35;
            font-family: Arial, Helvetica, sans-serif !important;
            text-align: center;
        }

        /* TANGGAL SURAT */
        .doc-date-line {
            text-align: right;
            font-size: 10.5pt;
            color: #1e293b;
            margin-bottom: 8px;
        }

        /* DOCUMENT TITLE (Identik BA) */
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

        /* SECTION STYLING (Identik BA) */
        .doc-section-title {
            font-size: 10.5pt;
            font-weight: bold;
            text-transform: uppercase;
            background: #f1f5f9;
            padding: 4px 8px;
            border-left: 4px solid #004b93;
            margin: 12px 0 8px 0;
            color: #0f172a;
        }

        /* DATA TABLE (Identik BA) */
        .table-data {
            width: 100%;
            border-collapse: collapse;
            font-size: 10pt;
            margin-bottom: 6px;
        }

        .table-data td {
            padding: 3px 6px;
            vertical-align: top;
        }

        .table-data td.td-label {
            width: 32%;
            color: #334155;
            font-weight: 600;
        }

        .table-data td.td-colon {
            width: 2%;
            text-align: center;
        }

        .table-data td.td-value {
            width: 66%;
            color: #0f172a;
        }

        /* HIGHLIGHT */
        .price-highlight {
            font-weight: bold;
            color: #15803d;
        }

        /* SIGNATURE SECTION (Identik BA) */
        .signature-grid {
            width: 100%;
            margin-top: 12px;
            border-collapse: collapse;
            page-break-inside: avoid;
        }

        .signature-grid td {
            width: 33.33%;
            text-align: center;
            vertical-align: top;
            font-size: 10pt;
            padding: 0 8px;
        }

        .sig-role {
            font-weight: 600;
            color: #334155;
            margin-bottom: 60px;
            font-size: 10pt;
            white-space: nowrap;
        }

        .sig-name {
            font-weight: bold;
            text-decoration: underline;
            color: #0f172a;
            font-size: 10pt;
            white-space: nowrap;
        }

        .sig-title {
            font-size: 8.5pt;
            color: #64748b;
            margin-top: 2px;
            white-space: nowrap;
        }

        /* FOOTER NOTE */
        .footer-note {
            margin-top: 24px;
            text-align: center;
            font-size: 8.5pt;
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
                margin: 0 !important;
                padding: 0 !important;
                box-shadow: none !important;
            }

            @page {
                size: 215mm 330mm portrait; /* F4 / Folio Standar */
                margin: 1.5cm 1.8cm;
            }

            .watermark-bg {
                opacity: 0.12;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            .doc-section-title {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
        }
    </style>
</head>
<body>

    @php
        $kpr = $booking->kprApplication;
        $akad = $booking->akad;
        $serahTerima = $booking->serahTerima;
        $customer = $booking->customer;
        $unit = $booking->unit;
        $purchaseType = strtolower($booking->purchase_type ?? ($unit->purchase_type ?? 'kpr'));

        $totalPrice = $purchaseType == 'kpr' && ($kpr->harga_unit ?? false) ? $kpr->harga_unit : ($booking->total_price ?? ($unit->price ?? 0));
        $utjAmount = $booking->utj ?? ($booking->booking_fee ?? 0);
        $totalPaid = $booking->payments ? $booking->payments->sum('amount') : 0;
        if ($totalPaid == 0) {
            $totalPaid = $utjAmount + ($purchaseType == 'kpr' ? ($kpr->dp ?? 0) : 0);
        }
        $remaining = max(0, $totalPrice - $totalPaid);
        $tglAkad = $akad?->tanggal_akad ? \Carbon\Carbon::parse($akad->tanggal_akad) : \Carbon\Carbon::now();
    @endphp

    <!-- Floating Top Action Bar -->
    <div class="no-print-bar">
        <a href="javascript:window.print()" class="btn-action-print">
            <i class="mdi mdi-printer"></i>
            <span>Cetak / Simpan PDF</span>
        </a>
        <a href="javascript:void(0)" onclick="window.close(); if(!window.closed){ history.back(); }" class="btn-action-close">
            <i class="mdi mdi-close"></i>
            <span>Tutup</span>
        </a>
    </div>

    <!-- Printable Paper Sheet (F4) -->
    <div class="print-container">
        <div class="watermark-bg">UNIT TERJUAL</div>

        <div class="content-wrap">
            <!-- KOP SURAT DENGAN LOGO RESMI PT. GRAHA CIPTA SEJAHTERA -->
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

            <!-- TITLE -->
            <div class="doc-title-block">
                <div class="doc-main-title">LEMBAR RINCIAN TRANSAKSI, HARGA &amp; LEGALITAS NOTARIS</div>
                <div class="doc-number">Nomor: REKAP/TRS/{{ date('Ym') }}/{{ str_pad($booking->id, 4, '0', STR_PAD_LEFT) }}</div>
            </div>

            <p style="margin-bottom: 10px; font-size: 10pt; text-align: justify;">
                Berdasarkan data sistem manajemen properti terverifikasi, berikut rincian lengkap transaksi penjualan unit properti, data konsumen, skema pembiayaan, serta pelaksanaan akad notaris yang telah disepakati:
            </p>

            <!-- I. DATA KONSUMEN -->
            <div class="doc-section-title">I. DATA KONSUMEN / PEMBELI</div>
            <table class="table-data">
                <tr>
                    <td class="td-label">Nama Lengkap Konsumen</td>
                    <td class="td-colon">:</td>
                    <td class="td-value"><strong>{{ $customer->full_name ?? '-' }}</strong></td>
                </tr>
                <tr>
                    <td class="td-label">Nomor Induk Kependudukan (NIK)</td>
                    <td class="td-colon">:</td>
                    <td class="td-value">{{ $customer->nik ?? '-' }}</td>
                </tr>
                <tr>
                    <td class="td-label">NPWP</td>
                    <td class="td-colon">:</td>
                    <td class="td-value">{{ $customer->npwp ?? '-' }}</td>
                </tr>
                <tr>
                    <td class="td-label">Nomor Telepon / WhatsApp</td>
                    <td class="td-colon">:</td>
                    <td class="td-value">{{ $customer->phone ?? '-' }}</td>
                </tr>
                <tr>
                    <td class="td-label">Email</td>
                    <td class="td-colon">:</td>
                    <td class="td-value">{{ $customer->email ?? '-' }}</td>
                </tr>
                <tr>
                    <td class="td-label">Alamat Lengkap</td>
                    <td class="td-colon">:</td>
                    <td class="td-value">{{ $customer->address ?? '-' }}</td>
                </tr>
                <tr>
                    <td class="td-label">Pekerjaan / Profesi</td>
                    <td class="td-colon">:</td>
                    <td class="td-value">{{ $customer->job_status ?? '-' }}</td>
                </tr>
                <tr>
                    <td class="td-label">Kode Booking / Transaksi</td>
                    <td class="td-colon">:</td>
                    <td class="td-value"><strong>{{ $booking->booking_code ?? '-' }}</strong></td>
                </tr>
            </table>

            <!-- II. DATA UNIT PROPERTI -->
            <div class="doc-section-title">II. DETAIL SPESIFIKASI UNIT PROPERTI / KAVLING</div>
            <table class="table-data">
                <tr>
                    <td class="td-label">Nama Unit / Tipe</td>
                    <td class="td-colon">:</td>
                    <td class="td-value"><strong>Tipe {{ $unit->type ?? '-' }} - {{ $unit->unit_name ?? '-' }}</strong></td>
                </tr>
                <tr>
                    <td class="td-label">Blok &amp; Nomor Kavling</td>
                    <td class="td-colon">:</td>
                    <td class="td-value"><strong>Blok {{ $unit->unit_code ?? '-' }}</strong></td>
                </tr>
                <tr>
                    <td class="td-label">Luas Tanah / Luas Bangunan</td>
                    <td class="td-colon">:</td>
                    <td class="td-value">{{ $unit->area ?? ($kpr->luas_tanah ?? '-') }} m² / {{ $unit->building_area ?? ($kpr->luas_bangunan ?? '-') }} m²</td>
                </tr>
                <tr>
                    <td class="td-label">Arah Hadap / Posisi Unit</td>
                    <td class="td-colon">:</td>
                    <td class="td-value">{{ $unit->facing ?? '-' }} / {{ $unit->position ?? '-' }}</td>
                </tr>
                <tr>
                    <td class="td-label">Lokasi Proyek Perumahan</td>
                    <td class="td-colon">:</td>
                    <td class="td-value">{{ $unit->landBank->address ?? ($unit->landBank->project_name ?? '-') }}</td>
                </tr>
                <tr>
                    <td class="td-label">Zonasi / Lebar Akses Jalan</td>
                    <td class="td-colon">:</td>
                    <td class="td-value">{{ $unit->landBank->zoning ?? ($unit->landBank->nama_cluster ?? '-') }} / {{ $unit->landBank->road_width ? $unit->landBank->road_width . ' Meter' : '-' }} ({{ $unit->landBank->road_type ?? '-' }})</td>
                </tr>
                <tr>
                    <td class="td-label">Fasilitas Daya Listrik / Air</td>
                    <td class="td-colon">:</td>
                    <td class="td-value">{{ $unit->electricity ?? ($unit->listrik ?? '1300 VA') }} / {{ $unit->water_source ?? ($unit->air ?? 'PDAM / Sumur Bor') }}</td>
                </tr>
            </table>

            <!-- III. RINCIAN HARGA & PEMBAYARAN -->
            <div class="doc-section-title">III. RINCIAN HARGA &amp; SKEMA PEMBIAYAAN ({{ strtoupper($purchaseType) }})</div>
            <table class="table-data">
                <tr>
                    <td class="td-label">Harga Kesepakatan Unit</td>
                    <td class="td-colon">:</td>
                    <td class="td-value"><strong class="price-highlight" style="font-size: 11pt;">Rp {{ number_format($totalPrice, 0, ',', '.') }}</strong></td>
                </tr>
                <tr>
                    <td class="td-label">Uang Tanda Jadi (UTJ / Booking Fee)</td>
                    <td class="td-colon">:</td>
                    <td class="td-value">Rp {{ number_format($utjAmount, 0, ',', '.') }}</td>
                </tr>
                @if($purchaseType == 'kpr' && $kpr)
                    <tr>
                        <td class="td-label">Uang Muka / DP (Down Payment)</td>
                        <td class="td-colon">:</td>
                        <td class="td-value">Rp {{ number_format($kpr->dp ?? 0, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td class="td-label">Plafon / Pinjaman KPR Disetujui</td>
                        <td class="td-colon">:</td>
                        <td class="td-value"><strong style="color: #004b93;">Rp {{ number_format($kpr->jumlah_pinjaman ?? 0, 0, ',', '.') }}</strong></td>
                    </tr>
                    <tr>
                        <td class="td-label">Jangka Waktu (Tenor)</td>
                        <td class="td-colon">:</td>
                        <td class="td-value"><strong>{{ $kpr->tenor ?? '-' }} Tahun</strong></td>
                    </tr>
                    <tr>
                        <td class="td-label">Suku Bunga KPR</td>
                        <td class="td-colon">:</td>
                        <td class="td-value"><strong>{{ $kpr->bunga ?? '-' }}%</strong></td>
                    </tr>
                    <tr>
                        <td class="td-label">Estimasi Angsuran per Bulan</td>
                        <td class="td-colon">:</td>
                        <td class="td-value"><strong style="color: #15803d; font-size: 11pt;">Rp {{ number_format($kpr->estimasi_angsuran ?? 0, 0, ',', '.') }} / Bulan</strong></td>
                    </tr>
                @endif
                <tr>
                    <td class="td-label">Total Uang Masuk Terverifikasi</td>
                    <td class="td-colon">:</td>
                    <td class="td-value"><strong style="color: #15803d;">Rp {{ number_format($totalPaid, 0, ',', '.') }}</strong></td>
                </tr>
                @if($purchaseType != 'kpr')
                    <tr>
                        <td class="td-label">Sisa Tagihan Pelunasan</td>
                        <td class="td-colon">:</td>
                        <td class="td-value"><strong style="color: {{ $remaining > 0 ? '#dc2626' : '#15803d' }};">Rp {{ number_format($remaining, 0, ',', '.') }} {{ $remaining == 0 ? '(LUNAS)' : '' }}</strong></td>
                    </tr>
                @endif
            </table>

            <!-- IV. DATA LEGALITAS & NOTARIS -->
            <div class="doc-section-title">IV. DATA LEGALITAS, NOTARIS &amp; PERJANJIAN AKAD</div>
            <table class="table-data">
                <tr>
                    <td class="td-label">Pejabat Notaris / PPAT</td>
                    <td class="td-colon">:</td>
                    <td class="td-value"><strong>{{ $akad->nama_notaris ?? 'Siti Nurhaliza, SH' }}</strong></td>
                </tr>
                <tr>
                    <td class="td-label">Nomor Akta / Akad Resmi</td>
                    <td class="td-colon">:</td>
                    <td class="td-value"><strong style="font-family: monospace;">{{ $akad->no_akad ?? ($kpr->no_akad ?? 'AKAD/09/2026/001') }}</strong></td>
                </tr>
                <tr>
                    <td class="td-label">Tanggal Pelaksanaan Akad</td>
                    <td class="td-colon">:</td>
                    <td class="td-value"><strong>{{ $akad?->tanggal_akad ? \Carbon\Carbon::parse($akad->tanggal_akad)->translatedFormat('l, d F Y') : '-' }}</strong></td>
                </tr>
                <tr>
                    <td class="td-label">Tempat / Lokasi Akad</td>
                    <td class="td-colon">:</td>
                    <td class="td-value">{{ $akad->lokasi_akad ?? 'Kantor Notaris / Bank Penyalur' }}</td>
                </tr>
                @if($purchaseType == 'kpr' && $kpr)
                    <tr>
                        <td class="td-label">Bank Penyalur Pembiayaan KPR</td>
                        <td class="td-colon">:</td>
                        <td class="td-value"><strong>{{ $kpr->bank->bank_name ?? 'Bank Penyalur KPR' }}</strong></td>
                    </tr>
                    <tr>
                        <td class="td-label">Nomor Surat Persetujuan (SP3K)</td>
                        <td class="td-colon">:</td>
                        <td class="td-value">{{ $kpr->no_sp3k ?? '-' }}</td>
                    </tr>
                @endif
                <tr>
                    <td class="td-label">Nomor BAST &amp; Serah Terima Unit</td>
                    <td class="td-colon">:</td>
                    <td class="td-value">{{ $serahTerima->no_bast ?? '-' }} (Tgl: {{ $serahTerima?->tanggal_serah_terima ? \Carbon\Carbon::parse($serahTerima->tanggal_serah_terima)->translatedFormat('d F Y') : '-' }})</td>
                </tr>
                <tr>
                    <td class="td-label">Masa Garansi Bangunan</td>
                    <td class="td-colon">:</td>
                    <td class="td-value"><strong>12 Bulan</strong> (s/d {{ $serahTerima?->tanggal_serah_terima ? \Carbon\Carbon::parse($serahTerima->tanggal_serah_terima)->addYear()->translatedFormat('d F Y') : \Carbon\Carbon::now()->addYear()->translatedFormat('d F Y') }})</td>
                </tr>
            </table>

            <!-- TANGGAL DI ATAS AREA TANDA TANGAN (RATA KANAN) -->
            <div style="text-align: right; margin-top: 28px; margin-bottom: 12px; font-size: 10.5pt; color: #1e293b;">
                Jember, {{ $tglAkad->translatedFormat('d F Y') }}
            </div>

            <!-- TANDA TANGAN (3 PIHAK SEJAJAR 100%) -->
            <table class="signature-grid">
                <tr>
                    <td>
                        <div class="sig-role">Pihak Konsumen / Pembeli,</div>
                        <div class="sig-name">{{ $customer->full_name ?? '_____________________' }}</div>
                        <div class="sig-title">Konsumen Pembeli</div>
                    </td>

                    <td>
                        <div class="sig-role">Notaris / PPAT / Bank,</div>
                        <div class="sig-name">{{ $akad->nama_notaris ?? 'Siti Nurhaliza, SH' }}</div>
                        <div class="sig-title">Pejabat Pembuat Akta</div>
                    </td>

                    <td>
                        <div class="sig-role">Pihak Pengembang (Developer),</div>
                        <div class="sig-name">PT. GRAHA CIPTA SEJAHTERA</div>
                        <div class="sig-title">Manajemen &amp; Direksi</div>
                    </td>
                </tr>
            </table>

            <!-- FOOTER -->
            <div class="footer-note">
                <p>Lembar Rincian Transaksi ini merupakan rekapan resmi transaksi pembelian unit properti yang sah dan terverifikasi di sistem.</p>
                <p>Dicetak secara sistematis pada: {{ date('d F Y, H:i:s') }} WIB</p>
            </div>

        </div>
    </div>

</body>
</html>
