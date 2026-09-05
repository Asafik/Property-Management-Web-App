{{-- resources/views/cetak/rab.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>RAP Pembangunan - PT. Graha Cipta Sejahtera</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700;800;900&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('admin/assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/vendors/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/style.css') }}">

    <style>
        /* Style khusus untuk RAB */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #f5f7fa;
            padding: 20px;
            font-family: 'Roboto', sans-serif;
            position: relative;
        }

        .rab-container {
            max-width: 1200px;
            margin: 0 auto;
            position: relative;
        }

        /* Watermark PT GRAHA CIPTA SEJAHTERA */
        .watermark-text {
            user-select: none;
            font-size: 70px;
            color: rgba(0, 75, 147, 0.08);
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-30deg);
            white-space: nowrap;
            z-index: 999;
            pointer-events: none;
            font-weight: bold;
            border: 3px solid rgba(0, 75, 147, 0.06);
            padding: 20px 40px;
            border-radius: 15px;
            letter-spacing: 5px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.05);
        }

        .watermark-pattern {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            pointer-events: none;
            z-index: 998;
            opacity: 0.05;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            align-items: center;
            transform: rotate(-20deg);
        }

        .watermark-pattern span {
            font-size: 55px;
            font-weight: bold;
            color: #004b93;
            margin: 50px;
            white-space: nowrap;
        }

        .btn-container { margin-bottom: 20px; }
        .btn { padding: 8px 16px; border-radius: 4px; border: none; cursor: pointer; font-size: 14px; display: inline-flex; align-items: center; gap: 5px; }
        .btn-primary { background: linear-gradient(45deg, #004b93, #0070ba); color: white; }
        .btn-success { background: linear-gradient(45deg, #00d25b, #028a44); color: white; }
        .btn-outline-secondary { border: 1px solid #6c757d; color: #6c757d; background: white; }

        .rab-content {
            background: white;
            padding: 30px;
            box-shadow: 0 2px 15px rgba(0,0,0,0.1);
            position: relative;
            z-index: 1;
        }

        /* KOP SURAT RESMI PT. GRAHA CIPTA SEJAHTERA (PATEN) */
        .document-header {
            margin-bottom: 14px;
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
            padding: 0 70px;
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
            font-size: 15px !important;
            font-weight: 800 !important;
            letter-spacing: 0.3px;
            margin: 0 0 4px 0;
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
            margin-bottom: 18px;
            margin-top: 6px;
        }

        .doc-main-title {
            font-size: 13.5pt;
            font-weight: bold;
            text-decoration: underline;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #0f172a;
        }

        .info-box {
            border: 1px solid #dee2e6;
            padding: 12px 16px;
            margin-bottom: 20px;
            background-color: #f8f9fc;
            border-radius: 4px;
        }

        .info-table {
            width: 100%;
        }

        .info-table td {
            padding: 4px 8px;
            border: none;
            font-size: 13px;
        }

        .info-table td:first-child {
            width: 150px;
            font-weight: bold;
        }

        .section-title {
            background-color: #004b93;
            color: white;
            padding: 8px 12px;
            margin: 20px 0 10px 0;
            font-weight: bold;
            font-size: 15px;
            border-radius: 2px;
        }

        .rab-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
            font-size: 12px;
        }

        .rab-table th {
            background-color: #e9ecef;
            border: 1px solid #dee2e6;
            padding: 8px;
            text-align: center;
            font-weight: 600;
        }

        .rab-table td {
            border: 1px solid #dee2e6;
            padding: 6px 8px;
            vertical-align: top;
        }

        .rab-table td:last-child {
            text-align: center;
        }

        .text-end {
            text-align: right;
        }

        .subtotal-row {
            background-color: #f0f0f0;
            font-weight: bold;
        }

        .grand-total {
            background-color: #004b93;
            color: white;
            font-weight: bold;
        }

        .footer-note {
            margin-top: 40px;
            text-align: center;
            font-size: 12px;
            color: #6c757d;
        }

        /* ===== MODE CETAK - A4 LANDSCAPE ===== */
        @media print {
            @page {
                size: A4 landscape;
                margin: 1cm;
            }

            body {
                background: white;
                padding: 0;
                margin: 0;
            }

            .btn-container,
            .d-print-none,
            .alert-info {
                display: none !important;
            }

            .rab-content {
                padding: 0;
                box-shadow: none;
                background: white;
            }

            .document-header {
                border-bottom: 3.5px double #004b93 !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            .company-main-title {
                color: #004b93 !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            .company-sub-title {
                color: #002d62 !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            .document-header-logo {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            .section-title {
                background-color: #004b93 !important;
                color: white !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            .grand-total {
                background-color: #004b93 !important;
                color: white !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            .watermark-text {
                opacity: 0.08;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            .watermark-pattern span {
                opacity: 0.05;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            .info-box {
                background-color: #f8f9fc !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            .subtotal-row {
                background-color: #f0f0f0 !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            /* Atur lebar tabel lebih proporsional */
            .rab-table th, .rab-table td {
                font-size: 10.5pt;
                padding: 6px 4px;
            }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .watermark-text {
                font-size: 40px;
                padding: 10px 20px;
            }

            .watermark-pattern span {
                font-size: 30px;
                margin: 20px;
            }

            .document-header-logo {
                height: 50px;
            }

            .company-main-title {
                font-size: 18px !important;
            }
        }
    </style>
</head>
<body>
    <!-- Watermark PT GRAHA CIPTA SEJAHTERA (besar di tengah) -->
    <div class="watermark-text">PT GRAHA CIPTA SEJAHTERA</div>

    <!-- Watermark pattern berulang -->
    <div class="watermark-pattern">
        <span>PT GRAHA CIPTA SEJAHTERA</span>
        <span>PT GRAHA CIPTA SEJAHTERA</span>
        <span>PT GRAHA CIPTA SEJAHTERA</span>
        <span>PT GRAHA CIPTA SEJAHTERA</span>
        <span>PT GRAHA CIPTA SEJAHTERA</span>
        <span>PT GRAHA CIPTA SEJAHTERA</span>
    </div>

    <div class="rab-container">
        <!-- Tombol Navigasi -->
        <div class="btn-container d-print-none">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <a href="{{ route('properti.progress', ['land_bank_id' => $unit->land_bank_id, 'unit_id' => $unit->id]) }}" class="btn btn-outline-secondary">
                        <i class="mdi mdi-arrow-left me-2"></i> Kembali
                    </a>
                </div>
                <div>
                    <button class="btn btn-primary me-2" onclick="window.print()">
                        <i class="mdi mdi-printer me-2"></i> Cetak RAP
                    </button>
                </div>
            </div>
            <div class="alert alert-info">
                <i class="mdi mdi-information-outline me-2"></i>
                Halaman ini dioptimalkan untuk cetak format A4 Landscape (seperti Excel)
            </div>
        </div>

        <div class="rab-content">
            <!-- KOP SURAT RESMI PT. GRAHA CIPTA SEJAHTERA (PATEN) -->
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

            <!-- JUDUL DOKUMEN -->
            <div class="doc-title-block">
                <div class="doc-main-title">RENCANA ANGGARAN PELAKSANAAN (RAP) PEMBANGUNAN</div>
            </div>

            <!-- Info Proyek -->
            <div class="info-box">
                <table class="info-table">
                    <tr>
                        <td>Nama Proyek</td>
                        <td>: {{ $unit->landBank->name }}</td>
                        <td>Unit / Type</td>
                        <td>: {{ $unit->block . ' - ' . $unit->unit_number . ' / ' . $unit->type }}</td>
                    </tr>
                    <tr>
                        <td>Lokasi</td>
                        <td>: {{ $unit->landBank->address }}</td>
                        <td>Luas Tanah / Bangunan</td>
                        <td>: {{ $unit->area }} m² / {{ $unit->building_area }} m²</td>
                    </tr>
                    <tr>
                        <td>No. RAP</td>
                        <td>: {{ $unit->no_rab ?? 'RAP/' . date('Y/m/d') }}</td>
                        <td>Tanggal</td>
                        <td>: {{ date('d F Y') }}</td>
                    </tr>
                </table>
            </div>

            @php
                $categoryTitles = [
                    'perizinan' => 'I. PERIZINAN & LEGALITAS (PBG/IMB, SERTIFIKAT, DLL)',
                    'persiapan' => 'II. PEKERJAAN PERSIAPAN',
                    'pondasi'   => 'III. PEKERJAAN PONDASI',
                    'struktur'  => 'IV. PEKERJAAN STRUKTUR',
                    'dinding'   => 'V. PEKERJAAN DINDING',
                    'atap'      => 'VI. PEKERJAAN ATAP',
                    'finishing' => 'VII. PEKERJAAN FINISHING',
                    'lainnya'   => 'VIII. PEKERJAAN LAINNYA',
                ];

                // Urutkan kategori sesuai urutan standar
                $categoryOrder = array_keys($categoryTitles);
                $categories = $progressItems->groupBy('kategori')->sortBy(function ($items, $key) use ($categoryOrder) {
                    $index = array_search(strtolower($key), $categoryOrder);
                    return $index !== false ? $index : 99;
                });

                $grandTotal = 0;
                $totalPerizinan = 0;
                $totalRumah = 0;
            @endphp

            @foreach($categories as $kategori => $items)
                @php
                    $displayTitle = $categoryTitles[strtolower($kategori)] ?? strtoupper($kategori);
                @endphp
                <div class="section-title">{{ $displayTitle }}</div>
                <table class="rab-table" border="1" cellspacing="0" cellpadding="5">
                    <thead>
                        <tr>
                            <th style="width: 50px;">No</th>
                            <th>Uraian Pekerjaan</th>
                            <th style="width: 80px;">Volume</th>
                            <th style="width: 70px;">Satuan</th>
                            <th style="width: 130px;">Harga Satuan (Rp)</th>
                            <th style="width: 140px;">Total (Rp)</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $subtotal = 0; @endphp
                        @foreach($items as $item)
                            <tr>
                                <td style="text-align: center;">{{ $item->kode }}</td>
                                <td>{{ $item->uraian }}</td>
                                <td class="text-end">{{ $item->volume }}</td>
                                <td style="text-align: center;">{{ $item->satuan }}</td>
                                <td class="text-end">{{ number_format($item->harga_satuan,0,",",".") }}</td>
                                <td class="text-end">{{ number_format($item->total,0,",",".") }}</td>
                                <td>{{ $item->keterangan ?? '-' }}</td>
                            </tr>
                            @php $subtotal += $item->total; @endphp
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="subtotal-row">
                            <td colspan="5" class="text-end">SUB TOTAL {{ $displayTitle }}</td>
                            <td colspan="2" class="text-end">Rp {{ number_format($subtotal,0,",",".") }}</td>
                        </tr>
                    </tfoot>
                </table>
                @php 
                    $grandTotal += $subtotal; 
                    if (strtolower($kategori) === 'perizinan') {
                        $totalPerizinan += $subtotal;
                    } else {
                        $totalRumah += $subtotal;
                    }
                @endphp
            @endforeach

            @php
                $ppn = round($grandTotal * 0.1);
                $finalGrandTotal = $grandTotal + $ppn;
            @endphp

            {{-- REKAPITULASI & GRAND TOTAL --}}
            <table class="rab-table" border="1" cellspacing="0" cellpadding="5" style="margin-top: 20px;">
                <tr style="background-color: #f8f9fc; font-weight: bold;">
                    <td colspan="5" class="text-end">Total Biaya Perizinan &amp; Legalitas</td>
                    <td colspan="2" class="text-end" style="width: 240px;">Rp {{ number_format($totalPerizinan, 0, ',', '.') }}</td>
                </tr>
                <tr style="background-color: #f8f9fc; font-weight: bold;">
                    <td colspan="5" class="text-end">Total Biaya Konstruksi Fisik Rumah</td>
                    <td colspan="2" class="text-end">Rp {{ number_format($totalRumah, 0, ',', '.') }}</td>
                </tr>
                <tr style="background-color: #e9ecef; font-weight: bold;">
                    <td colspan="5" class="text-end">Subtotal Semua Pekerjaan</td>
                    <td colspan="2" class="text-end">Rp {{ number_format($grandTotal, 0, ',', '.') }}</td>
                </tr>
                <tr style="background-color: #f8f9fc; font-weight: bold;">
                    <td colspan="5" class="text-end">PPN (10%)</td>
                    <td colspan="2" class="text-end">Rp {{ number_format($ppn, 0, ',', '.') }}</td>
                </tr>
                <tr class="grand-total">
                    <td colspan="5" class="text-end" style="font-size: 13px;">GRAND TOTAL ANGGARAN RAP (HPP UNIT)</td>
                    <td colspan="2" class="text-end" style="font-size: 13px;">Rp {{ number_format($finalGrandTotal, 0, ',', '.') }}</td>
                </tr>
            </table>

            <div class="footer-note">
                Dokumen ini dicetak dari sistem PT. Graha Cipta Sejahtera. Semua harga dalam Rupiah (Rp).
                <br>
                <small class="text-muted">Dokumen resmi terverifikasi &amp; dilengkapi watermark keamanan</small>
            </div>
        </div>
    </div>

    <script src="{{ asset('admin/assets/vendors/js/vendor.bundle.base.js') }}"></script>
</body>
</html>
