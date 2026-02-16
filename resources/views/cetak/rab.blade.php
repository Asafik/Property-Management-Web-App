<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>RAB Pembangunan - Properti Management</title>

    <link rel="stylesheet" href="{{ asset('admin/assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/vendors/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/style.css') }}">

    <style>
        /* Style khusus untuk RAB */
        body {
            background-color: #f5f7fa;
            padding: 20px;
            font-family: 'Roboto', sans-serif;
        }

        .rab-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        /* Style untuk tombol */
        .btn-container {
            margin-bottom: 20px;
        }

        .btn {
            padding: 8px 16px;
            border-radius: 4px;
            border: none;
            cursor: pointer;
            font-size: 14px;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .btn-primary {
            background: linear-gradient(45deg, #4b49ac, #7a78c5);
            color: white;
        }

        .btn-success {
            background: linear-gradient(45deg, #00d25b, #028a44);
            color: white;
        }

        .btn-outline-secondary {
            border: 1px solid #6c757d;
            color: #6c757d;
            background: white;
        }

        /* Style untuk laporan seperti Excel */
        .rab-content {
            background: white;
            padding: 30px;
            box-shadow: 0 2px 15px rgba(0,0,0,0.1);
        }

        .header-title {
            text-align: center;
            margin-bottom: 30px;
        }

        .header-title h2 {
            color: #4b49ac;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .header-title h4 {
            color: #333;
            font-weight: bold;
            margin-top: 10px;
            text-decoration: underline;
        }

        .info-box {
            border: 1px solid #ddd;
            padding: 15px;
            margin-bottom: 20px;
            background-color: #f8f9fc;
        }

        .info-table {
            width: 100%;
        }

        .info-table td {
            padding: 5px;
            border: none;
        }

        .info-table td:first-child {
            width: 150px;
            font-weight: bold;
        }

        .section-title {
            background-color: #4b49ac;
            color: white;
            padding: 8px 12px;
            margin: 20px 0 10px 0;
            font-weight: bold;
            font-size: 16px;
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

        .subtotal-row td {
            background-color: #f0f0f0;
        }

        .grand-total {
            background-color: #4b49ac;
            color: white;
            font-weight: bold;
        }

        .grand-total td {
            background-color: #4b49ac;
            color: white;
        }

        /* Style untuk rekap 2 kolom */
        .rekap-container {
            display: flex;
            gap: 20px;
            margin-top: 30px;
        }

        .rekap-left {
            flex: 1;
            padding-right: 10px;
            border-right: 2px dashed #ccc;
        }

        .rekap-right {
            flex: 1;
            padding-left: 10px;
        }

        .rekap-table {
            width: 100%;
            border-collapse: collapse;
        }

        .rekap-table td {
            padding: 8px 5px;
            border-bottom: 1px solid #eee;
        }

        .rekap-table td:first-child {
            font-weight: 500;
        }

        .rekap-table td:last-child {
            text-align: right;
            font-weight: bold;
        }

        .rekap-total {
            background-color: #4b49ac;
            color: white;
            font-weight: bold;
        }

        .rekap-total td {
            background-color: #4b49ac;
            color: white;
            padding: 10px 5px;
            border: none;
        }

        .footer-note {
            margin-top: 40px;
            text-align: center;
            font-size: 12px;
            color: #6c757d;
        }

        /* Mode cetak seperti Excel */
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
            .d-print-none {
                display: none !important;
            }

            .rab-content {
                padding: 0;
                box-shadow: none;
            }

            .section-title {
                background-color: #4b49ac !important;
                color: white !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            .grand-total td,
            .rekap-total td {
                background-color: #4b49ac !important;
                color: white !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            .rab-table th {
                background-color: #e9ecef !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            .rekap-left {
                border-right: 2px dashed #999;
            }
        }
    </style>
</head>
<body>
    <div class="rab-container">
        <!-- Tombol Navigasi (tidak ikut print) -->
        <div class="btn-container d-print-none">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <button class="btn btn-outline-secondary" onclick="history.back()">
                        <i class="mdi mdi-arrow-left me-2"></i> Kembali
                    </button>
                </div>
                <div>
                    <button class="btn btn-primary me-2" onclick="window.print()">
                        <i class="mdi mdi-printer me-2"></i> Cetak RAB
                    </button>
                    <button class="btn btn-success" id="btnDownloadPDF">
                        <i class="mdi mdi-download me-2"></i> Download PDF
                    </button>
                </div>
            </div>
            <div class="alert alert-info">
                <i class="mdi mdi-information-outline me-2"></i>
                Halaman ini dioptimalkan untuk cetak format A4 Landscape (seperti Excel)
            </div>
        </div>

        <!-- Konten RAB -->
        <div class="rab-content">
            <!-- Header -->
            <div class="header-title">
                <h2>PT PROPERTI MANAGEMENT</h2>
                <p>Jl. Sudirman No. 123, Jakarta Selatan 12190</p>
                <p>Telp: (021) 1234567 | Email: info@propertimanagement.com</p>
                <h4>RENCANA ANGGARAN BIAYA (RAB) PEMBANGUNAN</h4>
            </div>

            <!-- Info Proyek -->
            <div class="info-box">
                <table class="info-table">
                    <tr>
                        <td>Nama Proyek</td>
                        <td>: Green Lake City</td>
                        <td>Unit / Blok</td>
                        <td>: A.1 - The Lavender Tipe 45</td>
                    </tr>
                    <tr>
                        <td>Lokasi</td>
                        <td>: Jl. Raya No. 123, Jakarta Selatan</td>
                        <td>Luas Tanah / Bangunan</td>
                        <td>: 200 m² / 45 m²</td>
                    </tr>
                    <tr>
                        <td>No. RAB</td>
                        <td>: RAB/2025/03/001</td>
                        <td>Tanggal</td>
                        <td>: 25 Maret 2025</td>
                    </tr>
                </table>
            </div>

            <!-- ===== I. PEKERJAAN PERSIAPAN ===== -->
            <div class="section-title">I. PEKERJAAN PERSIAPAN</div>
            <table class="rab-table">
                <thead>
                    <tr>
                        <th style="width: 5%">No</th>
                        <th style="width: 35%">Uraian Pekerjaan</th>
                        <th style="width: 8%">Volume</th>
                        <th style="width: 8%">Satuan</th>
                        <th style="width: 15%">Harga Satuan (Rp)</th>
                        <th style="width: 15%">Total (Rp)</th>
                        <th style="width: 14%">Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1.1</td>
                        <td>Pembersihan Lahan</td>
                        <td class="text-end">1</td>
                        <td>ls</td>
                        <td class="text-end">2.000.000</td>
                        <td class="text-end">2.000.000</td>
                        <td>Manual</td>
                    </tr>
                    <tr>
                        <td>1.2</td>
                        <td>Pemasangan Pagar Pengaman</td>
                        <td class="text-end">50</td>
                        <td>m'</td>
                        <td class="text-end">150.000</td>
                        <td class="text-end">7.500.000</td>
                        <td>Seng</td>
                    </tr>
                    <tr>
                        <td>1.3</td>
                        <td>Pembuatan Direksi Keet</td>
                        <td class="text-end">1</td>
                        <td>unit</td>
                        <td class="text-end">3.500.000</td>
                        <td class="text-end">3.500.000</td>
                        <td>3x4 m</td>
                    </tr>
                    <tr>
                        <td>1.4</td>
                        <td>Pemasangan Listrik Sementara</td>
                        <td class="text-end">1</td>
                        <td>ls</td>
                        <td class="text-end">1.500.000</td>
                        <td class="text-end">1.500.000</td>
                        <td>PLN</td>
                    </tr>
                    <tr>
                        <td>1.5</td>
                        <td>Pemasangan Air Sementara</td>
                        <td class="text-end">1</td>
                        <td>ls</td>
                        <td class="text-end">1.000.000</td>
                        <td class="text-end">1.000.000</td>
                        <td>PDAM</td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr class="subtotal-row">
                        <td colspan="5" class="text-end">SUB TOTAL I</td>
                        <td class="text-end">15.500.000</td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>

            <!-- ===== II. PEKERJAAN PONDASI ===== -->
            <div class="section-title">II. PEKERJAAN PONDASI</div>
            <table class="rab-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Uraian Pekerjaan</th>
                        <th>Volume</th>
                        <th>Satuan</th>
                        <th>Harga Satuan (Rp)</th>
                        <th>Total (Rp)</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>2.1</td>
                        <td>Galian Tanah Pondasi</td>
                        <td class="text-end">30</td>
                        <td>m³</td>
                        <td class="text-end">80.000</td>
                        <td class="text-end">2.400.000</td>
                        <td>Kedalaman 1,5m</td>
                    </tr>
                    <tr>
                        <td>2.2</td>
                        <td>Pasir Urug</td>
                        <td class="text-end">8</td>
                        <td>m³</td>
                        <td class="text-end">250.000</td>
                        <td class="text-end">2.000.000</td>
                        <td>Tebal 10cm</td>
                    </tr>
                    <tr>
                        <td>2.3</td>
                        <td>Batu Kali / Batu Belah</td>
                        <td class="text-end">25</td>
                        <td>m³</td>
                        <td class="text-end">350.000</td>
                        <td class="text-end">8.750.000</td>
                        <td>Ukuran 15/20</td>
                    </tr>
                    <tr>
                        <td>2.4</td>
                        <td>Semen PC (50kg)</td>
                        <td class="text-end">150</td>
                        <td>zak</td>
                        <td class="text-end">75.000</td>
                        <td class="text-end">11.250.000</td>
                        <td>Pondasi</td>
                    </tr>
                    <tr>
                        <td>2.5</td>
                        <td>Pasir Pasang</td>
                        <td class="text-end">10</td>
                        <td>m³</td>
                        <td class="text-end">300.000</td>
                        <td class="text-end">3.000.000</td>
                        <td>Adukan</td>
                    </tr>
                    <tr>
                        <td>2.6</td>
                        <td>Besi Beton Ø12mm</td>
                        <td class="text-end">150</td>
                        <td>batang</td>
                        <td class="text-end">120.000</td>
                        <td class="text-end">18.000.000</td>
                        <td>Sloof</td>
                    </tr>
                    <tr>
                        <td>2.7</td>
                        <td>Besi Beton Ø8mm</td>
                        <td class="text-end">80</td>
                        <td>batang</td>
                        <td class="text-end">55.000</td>
                        <td class="text-end">4.400.000</td>
                        <td>Begel</td>
                    </tr>
                    <tr>
                        <td>2.8</td>
                        <td>Kawat Beton</td>
                        <td class="text-end">30</td>
                        <td>kg</td>
                        <td class="text-end">25.000</td>
                        <td class="text-end">750.000</td>
                        <td>Bendrat</td>
                    </tr>
                    <tr>
                        <td>2.9</td>
                        <td>Bekisting Kayu</td>
                        <td class="text-end">40</td>
                        <td>lembar</td>
                        <td class="text-end">180.000</td>
                        <td class="text-end">7.200.000</td>
                        <td>Multiplek 9mm</td>
                    </tr>
                    <tr>
                        <td>2.10</td>
                        <td>Paku</td>
                        <td class="text-end">15</td>
                        <td>kg</td>
                        <td class="text-end">20.000</td>
                        <td class="text-end">300.000</td>
                        <td>2''-4''</td>
                    </tr>
                    <tr>
                        <td>2.11</td>
                        <td>Upah Pekerja</td>
                        <td class="text-end">12</td>
                        <td>hari</td>
                        <td class="text-end">350.000</td>
                        <td class="text-end">4.200.000</td>
                        <td>4 orang</td>
                    </tr>
                    <tr>
                        <td>2.12</td>
                        <td>Upah Tukang</td>
                        <td class="text-end">12</td>
                        <td>hari</td>
                        <td class="text-end">450.000</td>
                        <td class="text-end">5.400.000</td>
                        <td>2 tukang</td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr class="subtotal-row">
                        <td colspan="5" class="text-end">SUB TOTAL II</td>
                        <td class="text-end">69.900.000</td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>

            <!-- ===== III. PEKERJAAN STRUKTUR BETON ===== -->
            <div class="section-title">III. PEKERJAAN STRUKTUR BETON</div>
            <table class="rab-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Uraian Pekerjaan</th>
                        <th>Volume</th>
                        <th>Satuan</th>
                        <th>Harga Satuan (Rp)</th>
                        <th>Total (Rp)</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>3.1</td>
                        <td>Besi Beton Ø12mm (Kolom)</td>
                        <td class="text-end">200</td>
                        <td>batang</td>
                        <td class="text-end">120.000</td>
                        <td class="text-end">24.000.000</td>
                        <td>Kolom utama</td>
                    </tr>
                    <tr>
                        <td>3.2</td>
                        <td>Besi Beton Ø10mm (Balok)</td>
                        <td class="text-end">150</td>
                        <td>batang</td>
                        <td class="text-end">90.000</td>
                        <td class="text-end">13.500.000</td>
                        <td>Balok ring</td>
                    </tr>
                    <tr>
                        <td>3.3</td>
                        <td>Besi Beton Ø8mm</td>
                        <td class="text-end">100</td>
                        <td>batang</td>
                        <td class="text-end">55.000</td>
                        <td class="text-end">5.500.000</td>
                        <td>Tulangan</td>
                    </tr>
                    <tr>
                        <td>3.4</td>
                        <td>Semen PC (50kg)</td>
                        <td class="text-end">200</td>
                        <td>zak</td>
                        <td class="text-end">75.000</td>
                        <td class="text-end">15.000.000</td>
                        <td>K 225</td>
                    </tr>
                    <tr>
                        <td>3.5</td>
                        <td>Pasir Beton</td>
                        <td class="text-end">15</td>
                        <td>m³</td>
                        <td class="text-end">320.000</td>
                        <td class="text-end">4.800.000</td>
                        <td>Cor beton</td>
                    </tr>
                    <tr>
                        <td>3.6</td>
                        <td>Split / Kerikil</td>
                        <td class="text-end">20</td>
                        <td>m³</td>
                        <td class="text-end">350.000</td>
                        <td class="text-end">7.000.000</td>
                        <td>1-2cm</td>
                    </tr>
                    <tr>
                        <td>3.7</td>
                        <td>Kayu Bekisting</td>
                        <td class="text-end">60</td>
                        <td>lembar</td>
                        <td class="text-end">180.000</td>
                        <td class="text-end">10.800.000</td>
                        <td>Multiplek</td>
                    </tr>
                    <tr>
                        <td>3.8</td>
                        <td>Kayu Usuk</td>
                        <td class="text-end">80</td>
                        <td>batang</td>
                        <td class="text-end">45.000</td>
                        <td class="text-end">3.600.000</td>
                        <td>Struktur</td>
                    </tr>
                    <tr>
                        <td>3.9</td>
                        <td>Paku</td>
                        <td class="text-end">20</td>
                        <td>kg</td>
                        <td class="text-end">20.000</td>
                        <td class="text-end">400.000</td>
                        <td>Bekisting</td>
                    </tr>
                    <tr>
                        <td>3.10</td>
                        <td>Kawat Beton</td>
                        <td class="text-end">25</td>
                        <td>kg</td>
                        <td class="text-end">25.000</td>
                        <td class="text-end">625.000</td>
                        <td>Ikat besi</td>
                    </tr>
                    <tr>
                        <td>3.11</td>
                        <td>Upah Pekerja</td>
                        <td class="text-end">20</td>
                        <td>hari</td>
                        <td class="text-end">350.000</td>
                        <td class="text-end">7.000.000</td>
                        <td>5 orang</td>
                    </tr>
                    <tr>
                        <td>3.12</td>
                        <td>Upah Tukang</td>
                        <td class="text-end">20</td>
                        <td>hari</td>
                        <td class="text-end">450.000</td>
                        <td class="text-end">9.000.000</td>
                        <td>3 tukang</td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr class="subtotal-row">
                        <td colspan="5" class="text-end">SUB TOTAL III</td>
                        <td class="text-end">101.225.000</td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>

            <!-- ===== IV. PEKERJAAN DINDING & PLAFON ===== -->
            <div class="section-title">IV. PEKERJAAN DINDING & PLAFON</div>
            <table class="rab-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Uraian Pekerjaan</th>
                        <th>Volume</th>
                        <th>Satuan</th>
                        <th>Harga Satuan (Rp)</th>
                        <th>Total (Rp)</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>4.1</td>
                        <td>Bata Ringan / Hebel</td>
                        <td class="text-end">800</td>
                        <td>buah</td>
                        <td class="text-end">8.000</td>
                        <td class="text-end">6.400.000</td>
                        <td>60x20</td>
                    </tr>
                    <tr>
                        <td>4.2</td>
                        <td>Semen Perekat</td>
                        <td class="text-end">80</td>
                        <td>zak</td>
                        <td class="text-end">75.000</td>
                        <td class="text-end">6.000.000</td>
                        <td>Perekat</td>
                    </tr>
                    <tr>
                        <td>4.3</td>
                        <td>Pasir Pasang</td>
                        <td class="text-end">8</td>
                        <td>m³</td>
                        <td class="text-end">300.000</td>
                        <td class="text-end">2.400.000</td>
                        <td>Halus</td>
                    </tr>
                    <tr>
                        <td>4.4</td>
                        <td>Lem Hebel</td>
                        <td class="text-end">40</td>
                        <td>sak</td>
                        <td class="text-end">60.000</td>
                        <td class="text-end">2.400.000</td>
                        <td>Thinbed</td>
                    </tr>
                    <tr>
                        <td>4.5</td>
                        <td>Rangka Plafon</td>
                        <td class="text-end">80</td>
                        <td>m²</td>
                        <td class="text-end">85.000</td>
                        <td class="text-end">6.800.000</td>
                        <td>Hollow</td>
                    </tr>
                    <tr>
                        <td>4.6</td>
                        <td>Plafon Gypsum</td>
                        <td class="text-end">80</td>
                        <td>m²</td>
                        <td class="text-end">70.000</td>
                        <td class="text-end">5.600.000</td>
                        <td>9mm</td>
                    </tr>
                    <tr>
                        <td>4.7</td>
                        <td>List Plafon</td>
                        <td class="text-end">40</td>
                        <td>m'</td>
                        <td class="text-end">35.000</td>
                        <td class="text-end">1.400.000</td>
                        <td>Gypsum</td>
                    </tr>
                    <tr>
                        <td>4.8</td>
                        <td>Upah Pekerja</td>
                        <td class="text-end">15</td>
                        <td>hari</td>
                        <td class="text-end">350.000</td>
                        <td class="text-end">5.250.000</td>
                        <td>4 orang</td>
                    </tr>
                    <tr>
                        <td>4.9</td>
                        <td>Upah Tukang</td>
                        <td class="text-end">15</td>
                        <td>hari</td>
                        <td class="text-end">450.000</td>
                        <td class="text-end">6.750.000</td>
                        <td>2 tukang</td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr class="subtotal-row">
                        <td colspan="5" class="text-end">SUB TOTAL IV</td>
                        <td class="text-end">43.000.000</td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>

            <!-- ===== V. PEKERJAAN ATAP ===== -->
            <div class="section-title">V. PEKERJAAN ATAP</div>
            <table class="rab-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Uraian Pekerjaan</th>
                        <th>Volume</th>
                        <th>Satuan</th>
                        <th>Harga Satuan (Rp)</th>
                        <th>Total (Rp)</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>5.1</td>
                        <td>Kayu Kuda-kuda</td>
                        <td class="text-end">15</td>
                        <td>batang</td>
                        <td class="text-end">250.000</td>
                        <td class="text-end">3.750.000</td>
                        <td>Kruing</td>
                    </tr>
                    <tr>
                        <td>5.2</td>
                        <td>Kayu Gording</td>
                        <td class="text-end">20</td>
                        <td>batang</td>
                        <td class="text-end">180.000</td>
                        <td class="text-end">3.600.000</td>
                        <td>6/12</td>
                    </tr>
                    <tr>
                        <td>5.3</td>
                        <td>Kayu Reng</td>
                        <td class="text-end">50</td>
                        <td>batang</td>
                        <td class="text-end">45.000</td>
                        <td class="text-end">2.250.000</td>
                        <td>2/3</td>
                    </tr>
                    <tr>
                        <td>5.4</td>
                        <td>Genteng Beton</td>
                        <td class="text-end">800</td>
                        <td>buah</td>
                        <td class="text-end">5.500</td>
                        <td class="text-end">4.400.000</td>
                        <td>Natural</td>
                    </tr>
                    <tr>
                        <td>5.5</td>
                        <td>Nok Genteng</td>
                        <td class="text-end">25</td>
                        <td>buah</td>
                        <td class="text-end">15.000</td>
                        <td class="text-end">375.000</td>
                        <td>Warna</td>
                    </tr>
                    <tr>
                        <td>5.6</td>
                        <td>Paku Atap</td>
                        <td class="text-end">10</td>
                        <td>kg</td>
                        <td class="text-end">25.000</td>
                        <td class="text-end">250.000</td>
                        <td>Anti karat</td>
                    </tr>
                    <tr>
                        <td>5.7</td>
                        <td>Talang Air</td>
                        <td class="text-end">20</td>
                        <td>m'</td>
                        <td class="text-end">85.000</td>
                        <td class="text-end">1.700.000</td>
                        <td>PVC</td>
                    </tr>
                    <tr>
                        <td>5.8</td>
                        <td>Listplank</td>
                        <td class="text-end">18</td>
                        <td>m'</td>
                        <td class="text-end">65.000</td>
                        <td class="text-end">1.170.000</td>
                        <td>Kayu</td>
                    </tr>
                    <tr>
                        <td>5.9</td>
                        <td>Upah Pekerja</td>
                        <td class="text-end">10</td>
                        <td>hari</td>
                        <td class="text-end">350.000</td>
                        <td class="text-end">3.500.000</td>
                        <td>3 orang</td>
                    </tr>
                    <tr>
                        <td>5.10</td>
                        <td>Upah Tukang</td>
                        <td class="text-end">10</td>
                        <td>hari</td>
                        <td class="text-end">450.000</td>
                        <td class="text-end">4.500.000</td>
                        <td>2 tukang</td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr class="subtotal-row">
                        <td colspan="5" class="text-end">SUB TOTAL V</td>
                        <td class="text-end">25.495.000</td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>

            <!-- ===== VI. PEKERJAAN LANTAI ===== -->
            <div class="section-title">VI. PEKERJAAN LANTAI</div>
            <table class="rab-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Uraian Pekerjaan</th>
                        <th>Volume</th>
                        <th>Satuan</th>
                        <th>Harga Satuan (Rp)</th>
                        <th>Total (Rp)</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>6.1</td>
                        <td>Urug Tanah</td>
                        <td class="text-end">15</td>
                        <td>m³</td>
                        <td class="text-end">150.000</td>
                        <td class="text-end">2.250.000</td>
                        <td>Tanah merah</td>
                    </tr>
                    <tr>
                        <td>6.2</td>
                        <td>Pasir Urug</td>
                        <td class="text-end">5</td>
                        <td>m³</td>
                        <td class="text-end">250.000</td>
                        <td class="text-end">1.250.000</td>
                        <td>Tebal 5cm</td>
                    </tr>
                    <tr>
                        <td>6.3</td>
                        <td>Semen (Lantai Kerja)</td>
                        <td class="text-end">50</td>
                        <td>zak</td>
                        <td class="text-end">75.000</td>
                        <td class="text-end">3.750.000</td>
                        <td>Lantai kerja</td>
                    </tr>
                    <tr>
                        <td>6.4</td>
                        <td>Keramik 60x60</td>
                        <td class="text-end">85</td>
                        <td>m²</td>
                        <td class="text-end">150.000</td>
                        <td class="text-end">12.750.000</td>
                        <td>Granit motif</td>
                    </tr>
                    <tr>
                        <td>6.5</td>
                        <td>Semen (Perekat)</td>
                        <td class="text-end">30</td>
                        <td>zak</td>
                        <td class="text-end">75.000</td>
                        <td class="text-end">2.250.000</td>
                        <td>Perekat</td>
                    </tr>
                    <tr>
                        <td>6.6</td>
                        <td>Pasir Halus</td>
                        <td class="text-end">4</td>
                        <td>m³</td>
                        <td class="text-end">300.000</td>
                        <td class="text-end">1.200.000</td>
                        <td>Spesi</td>
                    </tr>
                    <tr>
                        <td>6.7</td>
                        <td>Semen Warna (Nat)</td>
                        <td class="text-end">5</td>
                        <td>kg</td>
                        <td class="text-end">15.000</td>
                        <td class="text-end">75.000</td>
                        <td>Nat</td>
                    </tr>
                    <tr>
                        <td>6.8</td>
                        <td>Upah Pekerja</td>
                        <td class="text-end">8</td>
                        <td>hari</td>
                        <td class="text-end">350.000</td>
                        <td class="text-end">2.800.000</td>
                        <td>3 orang</td>
                    </tr>
                    <tr>
                        <td>6.9</td>
                        <td>Upah Tukang</td>
                        <td class="text-end">8</td>
                        <td>hari</td>
                        <td class="text-end">450.000</td>
                        <td class="text-end">3.600.000</td>
                        <td>2 tukang</td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr class="subtotal-row">
                        <td colspan="5" class="text-end">SUB TOTAL VI</td>
                        <td class="text-end">29.925.000</td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>

            <!-- ===== VII. PEKERJAAN INSTALASI ===== -->
            <div class="section-title">VII. PEKERJAAN INSTALASI</div>
            <table class="rab-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Uraian Pekerjaan</th>
                        <th>Volume</th>
                        <th>Satuan</th>
                        <th>Harga Satuan (Rp)</th>
                        <th>Total (Rp)</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>7.1</td>
                        <td>Kabel Listrik 2.5mm</td>
                        <td class="text-end">150</td>
                        <td>m'</td>
                        <td class="text-end">8.000</td>
                        <td class="text-end">1.200.000</td>
                        <td>NYA</td>
                    </tr>
                    <tr>
                        <td>7.2</td>
                        <td>Kabel Listrik 1.5mm</td>
                        <td class="text-end">100</td>
                        <td>m'</td>
                        <td class="text-end">5.500</td>
                        <td class="text-end">550.000</td>
                        <td>Lampu</td>
                    </tr>
                    <tr>
                        <td>7.3</td>
                        <td>MCB Box</td>
                        <td class="text-end">1</td>
                        <td>unit</td>
                        <td class="text-end">350.000</td>
                        <td class="text-end">350.000</td>
                        <td>6 group</td>
                    </tr>
                    <tr>
                        <td>7.4</td>
                        <td>MCB 10A</td>
                        <td class="text-end">4</td>
                        <td>buah</td>
                        <td class="text-end">85.000</td>
                        <td class="text-end">340.000</td>
                        <td>Schneider</td>
                    </tr>
                    <tr>
                        <td>7.5</td>
                        <td>Stop Kontak</td>
                        <td class="text-end">8</td>
                        <td>buah</td>
                        <td class="text-end">45.000</td>
                        <td class="text-end">360.000</td>
                        <td>Broco</td>
                    </tr>
                    <tr>
                        <td>7.6</td>
                        <td>Saklar</td>
                        <td class="text-end">6</td>
                        <td>buah</td>
                        <td class="text-end">35.000</td>
                        <td class="text-end">210.000</td>
                        <td>Broco</td>
                    </tr>
                    <tr>
                        <td>7.7</td>
                        <td>Fitting Lampu</td>
                        <td class="text-end">8</td>
                        <td>buah</td>
                        <td class="text-end">20.000</td>
                        <td class="text-end">160.000</td>
                        <td>Plafon</td>
                    </tr>
                    <tr>
                        <td>7.8</td>
                        <td>Pipa Listrik</td>
                        <td class="text-end">80</td>
                        <td>m'</td>
                        <td class="text-end">12.000</td>
                        <td class="text-end">960.000</td>
                        <td>PVC 5/8</td>
                    </tr>
                    <tr>
                        <td>7.9</td>
                        <td>Pipa Air 3/4"</td>
                        <td class="text-end">60</td>
                        <td>m'</td>
                        <td class="text-end">25.000</td>
                        <td class="text-end">1.500.000</td>
                        <td>PVC</td>
                    </tr>
                    <tr>
                        <td>7.10</td>
                        <td>Pipa Air 1/2"</td>
                        <td class="text-end">30</td>
                        <td>m'</td>
                        <td class="text-end">18.000</td>
                        <td class="text-end">540.000</td>
                        <td>PVC</td>
                    </tr>
                    <tr>
                        <td>7.11</td>
                        <td>Kran Air</td>
                        <td class="text-end">4</td>
                        <td>buah</td>
                        <td class="text-end">55.000</td>
                        <td class="text-end">220.000</td>
                        <td>Stainless</td>
                    </tr>
                    <tr>
                        <td>7.12</td>
                        <td>Closet Duduk</td>
                        <td class="text-end">1</td>
                        <td>unit</td>
                        <td class="text-end">1.200.000</td>
                        <td class="text-end">1.200.000</td>
                        <td>Toto</td>
                    </tr>
                    <tr>
                        <td>7.13</td>
                        <td>Wastafel</td>
                        <td class="text-end">1</td>
                        <td>unit</td>
                        <td class="text-end">850.000</td>
                        <td class="text-end">850.000</td>
                        <td>Dengan kran</td>
                    </tr>
                    <tr>
                        <td>7.14</td>
                        <td>Shower</td>
                        <td class="text-end">1</td>
                        <td>set</td>
                        <td class="text-end">450.000</td>
                        <td class="text-end">450.000</td>
                        <td>K. mandi</td>
                    </tr>
                    <tr>
                        <td>7.15</td>
                        <td>Upah Instalasi</td>
                        <td class="text-end">5</td>
                        <td>hari</td>
                        <td class="text-end">350.000</td>
                        <td class="text-end">1.750.000</td>
                        <td>2 pekerja</td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr class="subtotal-row">
                        <td colspan="5" class="text-end">SUB TOTAL VII</td>
                        <td class="text-end">10.640.000</td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>

            <!-- ===== VIII. PEKERJAAN FINISHING ===== -->
            <div class="section-title">VIII. PEKERJAAN FINISHING</div>
            <table class="rab-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Uraian Pekerjaan</th>
                        <th>Volume</th>
                        <th>Satuan</th>
                        <th>Harga Satuan (Rp)</th>
                        <th>Total (Rp)</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>8.1</td>
                        <td>Cat Tembok Interior</td>
                        <td class="text-end">200</td>
                        <td>m²</td>
                        <td class="text-end">35.000</td>
                        <td class="text-end">7.000.000</td>
                        <td>Dulux</td>
                    </tr>
                    <tr>
                        <td>8.2</td>
                        <td>Cat Tembok Exterior</td>
                        <td class="text-end">100</td>
                        <td>m²</td>
                        <td class="text-end">40.000</td>
                        <td class="text-end">4.000.000</td>
                        <td>Weathershield</td>
                    </tr>
                    <tr>
                        <td>8.3</td>
                        <td>Cat Plafon</td>
                        <td class="text-end">80</td>
                        <td>m²</td>
                        <td class="text-end">30.000</td>
                        <td class="text-end">2.400.000</td>
                        <td>Putih</td>
                    </tr>
                    <tr>
                        <td>8.4</td>
                        <td>Pintu</td>
                        <td class="text-end">5</td>
                        <td>unit</td>
                        <td class="text-end">1.200.000</td>
                        <td class="text-end">6.000.000</td>
                        <td>Kayu jati</td>
                    </tr>
                    <tr>
                        <td>8.5</td>
                        <td>Jendela</td>
                        <td class="text-end">4</td>
                        <td>unit</td>
                        <td class="text-end">900.000</td>
                        <td class="text-end">3.600.000</td>
                        <td>Alumunium</td>
                    </tr>
                    <tr>
                        <td>8.6</td>
                        <td>Kusen Pintu</td>
                        <td class="text-end">5</td>
                        <td>unit</td>
                        <td class="text-end">650.000</td>
                        <td class="text-end">3.250.000</td>
                        <td>Kayu kamper</td>
                    </tr>
                    <tr>
                        <td>8.7</td>
                        <td>Kusen Jendela</td>
                        <td class="text-end">4</td>
                        <td>unit</td>
                        <td class="text-end">550.000</td>
                        <td class="text-end">2.200.000</td>
                        <td>Kayu kamper</td>
                    </tr>
                    <tr>
                        <td>8.8</td>
                        <td>Kaca</td>
                        <td class="text-end">8</td>
                        <td>lembar</td>
                        <td class="text-end">250.000</td>
                        <td class="text-end">2.000.000</td>
                        <td>5mm</td>
                    </tr>
                    <tr>
                        <td>8.9</td>
                        <td>Upah Pekerja</td>
                        <td class="text-end">10</td>
                        <td>hari</td>
                        <td class="text-end">350.000</td>
                        <td class="text-end">3.500.000</td>
                        <td>3 pekerja</td>
                    </tr>
                    <tr>
                        <td>8.10</td>
                        <td>Upah Tukang</td>
                        <td class="text-end">10</td>
                        <td>hari</td>
                        <td class="text-end">450.000</td>
                        <td class="text-end">4.500.000</td>
                        <td>2 tukang</td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr class="subtotal-row">
                        <td colspan="5" class="text-end">SUB TOTAL VIII</td>
                        <td class="text-end">38.450.000</td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>

            <!-- REKAP 2 KOLOM (KIRI & KANAN) -->
            <div class="rekap-container">
                <!-- Kolom Kiri: RAB per Bagian -->
                <div class="rekap-left">
                    <h5 style="margin-top: 0; margin-bottom: 15px; color: #4b49ac;">REKAPITULASI RAB</h5>
                    <table class="rekap-table">
                        <tr>
                            <td>I. PEKERJAAN PERSIAPAN</td>
                            <td>Rp 15.500.000</td>
                        </tr>
                        <tr>
                            <td>II. PEKERJAAN PONDASI</td>
                            <td>Rp 69.900.000</td>
                        </tr>
                        <tr>
                            <td>III. PEKERJAAN STRUKTUR BETON</td>
                            <td>Rp 101.225.000</td>
                        </tr>
                        <tr>
                            <td>IV. PEKERJAAN DINDING & PLAFON</td>
                            <td>Rp 43.000.000</td>
                        </tr>
                        <tr>
                            <td>V. PEKERJAAN ATAP</td>
                            <td>Rp 25.495.000</td>
                        </tr>
                        <tr>
                            <td>VI. PEKERJAAN LANTAI</td>
                            <td>Rp 29.925.000</td>
                        </tr>
                        <tr>
                            <td>VII. PEKERJAAN INSTALASI</td>
                            <td>Rp 10.640.000</td>
                        </tr>
                        <tr>
                            <td>VIII. PEKERJAAN FINISHING</td>
                            <td>Rp 38.450.000</td>
                        </tr>
                        <tr style="background-color: #e9ecef; font-weight: bold;">
                            <td>TOTAL RAB</td>
                            <td>Rp 334.135.000</td>
                        </tr>
                    </table>
                </div>

                <!-- Kolom Kanan: Biaya Lain & Grand Total -->
                <div class="rekap-right">
                    <h5 style="margin-top: 0; margin-bottom: 15px; color: #4b49ac;">BIAYA LAIN & TOTAL</h5>
                    <table class="rekap-table">
                        <tr>
                            <td>Biaya Arsitek & Perencanaan</td>
                            <td>Rp 10.000.000</td>
                        </tr>
                        <tr>
                            <td>Biaya Pengawas</td>
                            <td>Rp 8.000.000</td>
                        </tr>
                        <tr>
                            <td>Biaya Perizinan (IMB)</td>
                            <td>Rp 5.000.000</td>
                        </tr>
                        <tr>
                            <td>Biaya Tak Terduga (5%)</td>
                            <td>Rp 16.706.750</td>
                        </tr>
                        <tr style="background-color: #e9ecef; font-weight: bold;">
                            <td>TOTAL BIAYA LAIN</td>
                            <td>Rp 39.706.750</td>
                        </tr>
                    </table>

                    <div style="margin-top: 30px;">
                        <table class="rekap-table">
                            <tr class="grand-total">
                                <td style="font-size: 16px;">TOTAL ANGGARAN PEMBANGUNAN</td>
                                <td style="font-size: 16px;">Rp 373.841.750</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="footer-note">
                <p>Dokumen ini sah dan dicetak secara elektronik</p>
                <p>Dicetak pada: {{ date('d/m/Y H:i:s') }}</p>
            </div>
        </div>
    </div>

    <script src="{{ asset('admin/assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <script>
        $(document).ready(function() {
            // Simulasi download PDF
            $('#btnDownloadPDF').click(function() {
                alert('Fitur download PDF akan segera tersedia. Untuk sekarang, gunakan Cetak > Save as PDF');
            });
        });
    </script>
</body>
</html>
