<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Laporan KPR - Properti Management</title>

    <link rel="stylesheet" href="{{ asset('admin/assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/vendors/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/style.css') }}">

    <style>
        /* Style khusus untuk laporan */
        body {
            background-color: #f5f7fa;
            padding: 20px;
            font-family: 'Roboto', sans-serif;
            position: relative;
        }

        .laporan-container {
            max-width: 900px;
            margin: 0 auto;
            position: relative;
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

        .btn-sm {
            padding: 5px 10px;
            font-size: 12px;
        }

        .btn-primary {
            background: linear-gradient(45deg, #4b49ac, #7a78c5);
            color: white;
            border: none;
        }

        .btn-success {
            background: linear-gradient(45deg, #00d25b, #028a44);
            color: white;
            border: none;
        }

        .btn-warning {
            background: linear-gradient(45deg, #ffab2e, #f16a0e);
            color: white;
            border: none;
        }

        .btn-outline-primary {
            border: 1px solid #4b49ac;
            color: #4b49ac;
            background: white;
        }

        .btn-outline-success {
            border: 1px solid #00d25b;
            color: #00d25b;
            background: white;
        }

        .btn-outline-info {
            border: 1px solid #00c5fb;
            color: #00c5fb;
            background: white;
        }

        .btn-outline-warning {
            border: 1px solid #ffab2e;
            color: #ffab2e;
            background: white;
        }

        .btn-outline-danger {
            border: 1px solid #dc3545;
            color: #dc3545;
            background: white;
        }

        .btn-outline-secondary {
            border: 1px solid #6c757d;
            color: #6c757d;
            background: white;
        }

        .btn.active {
            transform: scale(1.05);
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }

        .btn:hover {
            opacity: 0.9;
        }

        /* Style untuk card */
        .card {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 15px rgba(0,0,0,0.1);
            margin-bottom: 20px;
            position: relative;
            z-index: 1;
        }

        .card-body {
            padding: 30px;
        }

        /* Style untuk laporan */
        .laporan-header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #4b49ac;
            padding-bottom: 20px;
        }

        .laporan-header h2 {
            color: #4b49ac;
            margin-bottom: 5px;
        }

        .laporan-header p {
            color: #6c757d;
            margin: 2px 0;
        }

        .laporan-title {
            text-align: center;
            margin: 30px 0;
        }

        .laporan-title h3 {
            font-size: 24px;
            font-weight: bold;
            color: #333;
            border-bottom: 2px dashed #4b49ac;
            padding-bottom: 10px;
            display: inline-block;
        }

        .info-section {
            margin-bottom: 30px;
            padding: 20px;
            background-color: #f8f9fc;
            border-radius: 8px;
        }

        .info-table {
            width: 100%;
        }

        .info-table td {
            padding: 8px 5px;
            border: none;
        }

        .info-table td:first-child {
            width: 150px;
            font-weight: bold;
            color: #555;
        }

        .info-table td:nth-child(2) {
            width: 20px;
        }

        .detail-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        .detail-table th {
            background-color: #4b49ac;
            color: white;
            padding: 12px;
            text-align: left;
        }

        .detail-table td {
            padding: 12px;
            border-bottom: 1px solid #dee2e6;
        }

        .detail-table tr:last-child td {
            border-bottom: none;
        }

        .total-row {
            font-weight: bold;
            background-color: #f0f0f0;
        }

        .total-row td {
            font-size: 16px;
        }

        .grand-total {
            background-color: #4b49ac;
            color: white;
        }

        .grand-total td {
            font-size: 18px;
            font-weight: bold;
        }

        .terbilang {
            margin: 20px 0;
            padding: 15px;
            background-color: #f8f9fc;
            border-left: 4px solid #4b49ac;
            font-style: italic;
            font-size: 16px;
        }

        .payment-method {
            margin: 20px 0;
            padding: 15px;
            border: 1px dashed #4b49ac;
            border-radius: 8px;
        }

        .signature-section {
            margin-top: 50px;
            display: flex;
            justify-content: space-between;
        }

        .signature-box {
            text-align: center;
            width: 45%;
        }

        .signature-line {
            margin-top: 60px;
            border-top: 1px solid #333;
            padding-top: 10px;
        }

        .footer-note {
            margin-top: 30px;
            text-align: center;
            font-size: 12px;
            color: #6c757d;
        }

        .badge-status {
            display: inline-block;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: bold;
        }

        .badge-success {
            background-color: #00d25b;
            color: white;
        }

        .badge-warning {
            background-color: #ffab2e;
            color: white;
        }

        .badge-info {
            background-color: #00c5fb;
            color: white;
        }

        .badge-secondary {
            background-color: #6c757d;
            color: white;
        }

        .text-success {
            color: #00d25b;
        }

        .text-danger {
            color: #dc3545;
        }

        .text-muted {
            color: #6c757d;
        }

        .small {
            font-size: 12px;
        }

        .d-none {
            display: none;
        }

        /* Mode cetak yang rapi */
        @media print {
            @page {
                size: A4;
                margin: 1.5cm;
            }

            body {
                background: white;
                padding: 0;
                margin: 0;
                font-size: 11pt;
                line-height: 1.4;
            }

            .laporan-container {
                max-width: 100%;
                margin: 0;
                padding: 0;
            }

            .btn-container,
            .btn-group,
            .card:first-child,
            .card:last-child,
            .alert-info,
            .d-print-none {
                display: none !important;
            }

            .card {
                box-shadow: none;
                border: none !important;
                margin: 0;
                padding: 0;
            }

            .card-body {
                padding: 0 !important;
            }

            .badge-status {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            .detail-table th {
                background-color: #4b49ac !important;
                color: white !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            .grand-total {
                background-color: #4b49ac !important;
                color: white !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            .bg-light {
                background-color: #f0f0f0 !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            /* Pastikan tidak ada potongan */
            table {
                page-break-inside: avoid;
            }

            tr {
                page-break-inside: avoid;
            }

            .signature-section {
                page-break-inside: avoid;
                margin-top: 40px;
            }

            .footer-note {
                position: running(footer);
                font-size: 9pt;
                color: #666;
            }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .signature-section {
                flex-direction: column;
                gap: 30px;
            }

            .signature-box {
                width: 100%;
            }

            .info-table td:first-child {
                width: 120px;
            }
        }
    </style>
</head>
<body>
    <div class="laporan-container">
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
                        <i class="mdi mdi-printer me-2"></i> Cetak Laporan
                    </button>
                    <button class="btn btn-success" id="btnDownloadPDF">
                        <i class="mdi mdi-download me-2"></i> Download PDF
                    </button>
                </div>
            </div>

            <!-- Pilihan Jenis Laporan -->
            <div class="d-flex justify-content-center mb-4">
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-outline-primary active" id="btnLaporanPengajuan">
                        <i class="mdi mdi-file-document me-1"></i> Pengajuan KPR
                    </button>
                    <button type="button" class="btn btn-outline-success" id="btnLaporanSP3K">
                        <i class="mdi mdi-check-decagram me-1"></i> SP3K
                    </button>
                    <button type="button" class="btn btn-outline-info" id="btnLaporanBiaya">
                        <i class="mdi mdi-cash-multiple me-1"></i> Biaya
                    </button>
                    <button type="button" class="btn btn-outline-warning" id="btnLaporanDokumen">
                        <i class="mdi mdi-file-document-multiple me-1"></i> Dokumen
                    </button>
                    <button type="button" class="btn btn-outline-danger" id="btnLaporanPenolakan">
                        <i class="mdi mdi-close-octagon me-1"></i> Penolakan
                    </button>
                </div>
                <small class="text-muted ms-3 d-none d-md-inline">Klik untuk ganti jenis laporan</small>
            </div>
        </div>

        <!-- Card Laporan -->
        <div class="card">
            <div class="card-body">
                <!-- LAPORAN PENGAJUAN KPR -->
                <div id="laporanPengajuan">
                    <!-- Header Perusahaan -->
                    <div class="laporan-header">
                        <h2>PT PROPERTI MANAGEMENT</h2>
                        <p>Jl. Sudirman No. 123, Jakarta Selatan 12190</p>
                        <p>Telp: (021) 1234567 | Email: info@propertimanagement.com</p>
                        <p>NPWP: 01.234.567.8-123.000</p>
                    </div>

                    <!-- Judul Laporan -->
                    <div class="laporan-title">
                        <h3>LAPORAN PENGAJUAN KPR</h3>
                    </div>

                    <!-- Nomor Laporan -->
                    <div style="display: flex; justify-content: space-between; margin-bottom: 20px;">
                        <div style="width: 48%;">
                            <table class="info-table">
                                <tr>
                                    <td>No. Laporan</td>
                                    <td>:</td>
                                    <td><strong>LAP/KPR/2025/021</strong></td>
                                </tr>
                                <tr>
                                    <td>Tanggal Laporan</td>
                                    <td>:</td>
                                    <td>25 Februari 2025</td>
                                </tr>
                            </table>
                        </div>
                        <div style="width: 48%;">
                            <table class="info-table">
                                <tr>
                                    <td>Status</td>
                                    <td>:</td>
                                    <td>
                                        <span class="badge-status badge-info">Menunggu Persetujuan</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Jenis</td>
                                    <td>:</td>
                                    <td>KPR Non Subsidi</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <!-- Info Customer -->
                    <div class="info-section">
                        <h5 style="margin-bottom: 15px; color: #4b49ac;">DATA CUSTOMER</h5>
                        <table class="info-table">
                            <tr>
                                <td>Nama Customer</td>
                                <td>:</td>
                                <td><strong>Budi Santoso</strong></td>
                            </tr>
                            <tr>
                                <td>NIK</td>
                                <td>:</td>
                                <td>3273011203850001</td>
                            </tr>
                            <tr>
                                <td>No. HP</td>
                                <td>:</td>
                                <td>081234567890</td>
                            </tr>
                            <tr>
                                <td>Booking ID</td>
                                <td>:</td>
                                <td>#INV/202502/001</td>
                            </tr>
                            <tr>
                                <td>Unit</td>
                                <td>:</td>
                                <td>The Lavender - Tipe 45</td>
                            </tr>
                            <tr>
                                <td>Blok/No</td>
                                <td>:</td>
                                <td>C/12</td>
                            </tr>
                            <tr>
                                <td>Harga Unit</td>
                                <td>:</td>
                                <td>Rp 450.000.000</td>
                            </tr>
                        </table>
                    </div>

                    <!-- Detail KPR -->
                    <h5 style="margin-bottom: 15px; color: #4b49ac;">DETAIL KPR</h5>
                    <table class="detail-table">
                        <tbody>
                            <tr>
                                <td width="30%"><strong>Bank Tujuan</strong></td>
                                <td width="70%">Bank ABC Syariah</td>
                            </tr>
                            <tr>
                                <td><strong>Jumlah Pinjaman</strong></td>
                                <td>Rp 360.000.000</td>
                            </tr>
                            <tr>
                                <td><strong>Tenor</strong></td>
                                <td>15 Tahun (180 bulan)</td>
                            </tr>
                            <tr>
                                <td><strong>Angsuran per Bulan</strong></td>
                                <td>Rp 3.200.000</td>
                            </tr>
                            <tr>
                                <td><strong>Suku Bunga</strong></td>
                                <td>7.5% per tahun</td>
                            </tr>
                        </tbody>
                    </table>

                    <!-- Timeline Proses -->
                    <h5 style="margin-bottom: 15px; color: #4b49ac;">TIMELINE PROSES</h5>
                    <table class="detail-table">
                        <thead>
                            <tr>
                                <th>Tahapan</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Pengajuan KPR</td>
                                <td>12 Feb 2025</td>
                                <td><span class="badge-status badge-success">Selesai</span></td>
                                <td>Dokumen lengkap</td>
                            </tr>
                            <tr>
                                <td>Verifikasi Dokumen</td>
                                <td>14 Feb 2025</td>
                                <td><span class="badge-status badge-success">Selesai</span></td>
                                <td>Verifikasi by bank</td>
                            </tr>
                            <tr>
                                <td>Survey Lapangan</td>
                                <td>20 Feb 2025</td>
                                <td><span class="badge-status badge-success">Selesai</span></td>
                                <td>Nilai appraisal Rp 445 Juta</td>
                            </tr>
                            <tr>
                                <td>Persetujuan Bank</td>
                                <td>-</td>
                                <td><span class="badge-status badge-warning">Proses</span></td>
                                <td>Menunggu keputusan</td>
                            </tr>
                        </tbody>
                    </table>

                    <!-- Hasil Survey -->
                    <h5 style="margin-bottom: 15px; color: #4b49ac;">HASIL SURVEY</h5>
                    <table class="detail-table">
                        <tbody>
                            <tr>
                                <td width="30%"><strong>Nilai Appraisal</strong></td>
                                <td width="70%">Rp 445.000.000</td>
                            </tr>
                            <tr>
                                <td><strong>Surveyor</strong></td>
                                <td>Hendra Wijaya</td>
                            </tr>
                            <tr>
                                <td><strong>Rekomendasi</strong></td>
                                <td>Layak - Sesuai Harga</td>
                            </tr>
                            <tr>
                                <td><strong>Tanggal Survey</strong></td>
                                <td>20 Februari 2025</td>
                            </tr>
                        </tbody>
                    </table>

                    <!-- Catatan -->
                    <h5 style="margin-bottom: 15px; color: #4b49ac;">CATATAN</h5>
                    <div class="p-3 border rounded mb-4">
                        Pengajuan KPR dalam proses persetujuan bank. Dokumen lengkap dan survey sudah dilakukan.
                    </div>

                    <!-- Tanda Tangan -->
                    <div class="signature-section">
                        <div class="signature-box">
                            <p>Mengetahui,</p>
                            <div class="signature-line">( ___________________ )</div>
                            <p class="text-muted small">Manager Marketing</p>
                        </div>
                        <div class="signature-box">
                            <p>Mengetahui,</p>
                            <div class="signature-line">( ___________________ )</div>
                            <p class="text-muted small">Finance</p>
                        </div>
                        <div class="signature-box">
                            <p>Jakarta, 25 Februari 2025</p>
                            <div class="signature-line">( Ahmad Rizki )</div>
                            <p class="text-muted small">Marketing Officer</p>
                        </div>
                    </div>
                </div>

                <!-- LAPORAN SP3K -->
                <div id="laporanSP3K" style="display: none;">
                    <div class="laporan-header">
                        <h2 style="color: #0047ab;">BANK ABC SYARIAH</h2>
                        <p>Kantor Cabang Jakarta Selatan</p>
                        <p>Jl. Sudirman No. 456, Jakarta</p>
                    </div>

                    <div class="laporan-title">
                        <h3>SURAT PERSETUJUAN PRINSIP (SP3K)</h3>
                    </div>

                    <div style="margin-bottom: 20px;">
                        <table class="info-table">
                            <tr>
                                <td>No. SP3K</td>
                                <td>:</td>
                                <td><strong>SP3K/2025/021/ABC</strong></td>
                            </tr>
                            <tr>
                                <td>Tanggal</td>
                                <td>:</td>
                                <td>25 Februari 2025</td>
                            </tr>
                        </table>
                    </div>

                    <div class="mb-4">
                        <p>Kepada Yth,<br>Bapak Budi Santoso<br>di Tempat</p>

                        <p class="mt-4">Dengan ini kami sampaikan bahwa permohonan KPR Saudara telah <strong>DISETUJUI</strong> dengan ketentuan sebagai berikut:</p>

                        <table class="detail-table mt-3">
                            <tr>
                                <td width="40%"><strong>Plafon Kredit</strong></td>
                                <td>Rp 360.000.000</td>
                            </tr>
                            <tr>
                                <td><strong>Tenor</strong></td>
                                <td>15 Tahun (180 bulan)</td>
                            </tr>
                            <tr>
                                <td><strong>Suku Bunga</strong></td>
                                <td>7.25% per tahun (fixed 3 tahun)</td>
                            </tr>
                            <tr>
                                <td><strong>Angsuran per Bulan</strong></td>
                                <td>Rp 3.150.000</td>
                            </tr>
                            <tr>
                                <td><strong>Jenis KPR</strong></td>
                                <td>KPR Non Subsidi</td>
                            </tr>
                        </table>

                        <p class="mt-4"><strong>Syarat dan Ketentuan:</strong></p>
                        <ol>
                            <li>Persetujuan ini berlaku selama 30 hari sejak tanggal diterbitkan.</li>
                            <li>Akad kredit dilaksanakan paling lambat 30 Maret 2025.</li>
                            <li>Dokumen asli harus diserahkan saat akad.</li>
                            <li>Biaya provisi 1% dari plafon dibayar sebelum akad.</li>
                        </ol>
                    </div>

                    <div class="signature-section" style="justify-content: center;">
                        <div class="signature-box" style="width: 60%;">
                            <p>Jakarta, 25 Februari 2025</p>
                            <div class="signature-line">( ___________________ )</div>
                            <p class="text-muted small">Branch Manager Bank ABC Syariah</p>
                        </div>
                    </div>
                </div>

                <!-- LAPORAN RINGKASAN BIAYA -->
                <div id="laporanBiaya" style="display: none;">
                    <div class="laporan-header">
                        <h2>PT PROPERTI MANAGEMENT</h2>
                        <p>Jl. Sudirman No. 123, Jakarta Selatan 12190</p>
                    </div>

                    <div class="laporan-title">
                        <h3>RINGKASAN BIAYA</h3>
                    </div>

                    <div style="margin-bottom: 20px;">
                        <table class="info-table">
                            <tr>
                                <td>No. Biaya</td>
                                <td>:</td>
                                <td><strong>BIAYA/2025/021</strong></td>
                            </tr>
                            <tr>
                                <td>Tanggal</td>
                                <td>:</td>
                                <td>25 Februari 2025</td>
                            </tr>
                        </table>
                    </div>

                    <div class="info-section">
                        <table class="info-table">
                            <tr>
                                <td>Nama Customer</td>
                                <td>:</td>
                                <td><strong>Budi Santoso</strong></td>
                            </tr>
                            <tr>
                                <td>Booking ID</td>
                                <td>:</td>
                                <td>#INV/202502/001</td>
                            </tr>
                            <tr>
                                <td>Unit</td>
                                <td>:</td>
                                <td>The Lavender Tipe 45</td>
                            </tr>
                        </table>
                    </div>

                    <h5 style="margin-bottom: 15px; color: #4b49ac;">RINCIAN BIAYA</h5>
                    <table class="detail-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Keterangan</th>
                                <th class="text-end">Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Booking Fee</td>
                                <td class="text-end">Rp 10.000.000</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>DP 20%</td>
                                <td class="text-end">Rp 90.000.000</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Biaya Survey</td>
                                <td class="text-end">Rp 500.000</td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>Biaya Provisi Bank (1%)</td>
                                <td class="text-end">Rp 3.600.000</td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>Biaya Notaris</td>
                                <td class="text-end">Rp 5.000.000</td>
                            </tr>
                            <tr>
                                <td>6</td>
                                <td>BPHTB</td>
                                <td class="text-end">Rp 4.500.000</td>
                            </tr>
                            <tr class="grand-total">
                                <td colspan="2" class="text-end"><strong>TOTAL</strong></td>
                                <td class="text-end"><strong>Rp 113.600.000</strong></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- LAPORAN CHECKLIST DOKUMEN -->
                <div id="laporanDokumen" style="display: none;">
                    <div class="laporan-header">
                        <h2>PT PROPERTI MANAGEMENT</h2>
                        <p>Jl. Sudirman No. 123, Jakarta Selatan 12190</p>
                    </div>

                    <div class="laporan-title">
                        <h3>CHECKLIST DOKUMEN KPR</h3>
                    </div>

                    <div style="margin-bottom: 20px;">
                        <table class="info-table">
                            <tr>
                                <td>No. Dokumen</td>
                                <td>:</td>
                                <td><strong>DOK/2025/021</strong></td>
                            </tr>
                            <tr>
                                <td>Tanggal</td>
                                <td>:</td>
                                <td>25 Februari 2025</td>
                            </tr>
                        </table>
                    </div>

                    <div class="info-section">
                        <table class="info-table">
                            <tr>
                                <td>Nama Customer</td>
                                <td>:</td>
                                <td><strong>Budi Santoso</strong></td>
                            </tr>
                            <tr>
                                <td>Bank Tujuan</td>
                                <td>:</td>
                                <td>Bank ABC Syariah</td>
                            </tr>
                        </table>
                    </div>

                    <h5 style="margin-bottom: 15px; color: #4b49ac;">KELENGKAPAN DOKUMEN</h5>
                    <table class="detail-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Jenis Dokumen</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>KTP Customer</td>
                                <td><span class="badge-status badge-success">Lengkap</span></td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Kartu Keluarga</td>
                                <td><span class="badge-status badge-success">Lengkap</span></td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>NPWP</td>
                                <td><span class="badge-status badge-success">Lengkap</span></td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>Slip Gaji (3 bulan)</td>
                                <td><span class="badge-status badge-warning">Belum Lengkap</span></td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>Rekening Tabungan</td>
                                <td><span class="badge-status badge-warning">Belum Lengkap</span></td>
                            </tr>
                            <tr>
                                <td>6</td>
                                <td>Surat Nikah</td>
                                <td><span class="badge-status badge-success">Lengkap</span></td>
                            </tr>
                            <tr>
                                <td>7</td>
                                <td>KTP Pasangan</td>
                                <td><span class="badge-status badge-success">Lengkap</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- LAPORAN SURAT PENOLAKAN -->
                <div id="laporanPenolakan" style="display: none;">
                    <div class="laporan-header">
                        <h2 style="color: #dc3545;">BANK ABC SYARIAH</h2>
                        <p>Kantor Cabang Jakarta Selatan</p>
                        <p>Jl. Sudirman No. 456, Jakarta</p>
                    </div>

                    <div class="laporan-title">
                        <h3 style="color: #dc3545;">SURAT PENOLAKAN KPR</h3>
                    </div>

                    <div style="margin-bottom: 20px;">
                        <table class="info-table">
                            <tr>
                                <td>No. Penolakan</td>
                                <td>:</td>
                                <td><strong>TOLAK/2025/021/ABC</strong></td>
                            </tr>
                            <tr>
                                <td>Tanggal</td>
                                <td>:</td>
                                <td>25 Februari 2025</td>
                            </tr>
                        </table>
                    </div>

                    <div class="mb-4">
                        <p>Kepada Yth,<br>Bapak Budi Santoso<br>di Tempat</p>

                        <p class="mt-4">Dengan ini kami sampaikan bahwa permohonan KPR Saudara atas unit <strong>The Lavender Tipe 45 Blok C/12</strong> dengan pengajuan sebagai berikut:</p>

                        <table class="detail-table" style="width: 70%; margin: 0 auto;">
                            <tr>
                                <td>Jumlah Pinjaman</td>
                                <td>Rp 360.000.000</td>
                            </tr>
                            <tr>
                                <td>Tenor</td>
                                <td>15 Tahun</td>
                            </tr>
                        </table>

                        <div class="p-3 mt-4" style="background-color: #f8d7da; border: 1px solid #f5c6cb; border-radius: 8px;">
                            <h6 class="fw-bold" style="color: #721c24;">ALASAN PENOLAKAN:</h6>
                            <p class="mb-0" style="color: #721c24;">BI Checking / SLIK bermasalah. Terdapat catatan kredit macet pada 2 tahun terakhir.</p>
                        </div>

                        <p class="mt-4"><strong>Rekomendasi:</strong></p>
                        <ul>
                            <li>Dapat mengajukan kembali setelah 6 bulan dengan perbaikan BI Checking</li>
                            <li>Mengajukan ke bank lain dengan program khusus</li>
                            <li>Menggunakan skema pembayaran cash/bertahap ke developer</li>
                        </ul>
                    </div>

                    <div class="signature-section" style="justify-content: center;">
                        <div class="signature-box" style="width: 60%;">
                            <p>Jakarta, 25 Februari 2025</p>
                            <div class="signature-line">( ___________________ )</div>
                            <p class="text-muted small">Analis Kredit Bank ABC Syariah</p>
                        </div>
                    </div>
                </div>

                <!-- Footer Note -->
                <div class="footer-note">
                    <p>Dokumen ini sah dan dicetak secara elektronik</p>
                    <p>Dicetak pada: {{ date('d/m/Y H:i:s') }}</p>
                </div>
            </div>
        </div>

        <!-- Informasi (tidak ikut print) -->
        <div class="alert alert-info d-print-none mt-3">
            <i class="mdi mdi-information-outline me-2"></i>
            Pilih jenis laporan di atas untuk melihat preview berbeda.
        </div>
    </div>

    <script src="{{ asset('admin/assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <script>
        $(document).ready(function() {
            // Switch antara jenis laporan
            $('#btnLaporanPengajuan').click(function() {
                setActiveButton($(this));
                $('#laporanPengajuan').show();
                $('#laporanSP3K, #laporanBiaya, #laporanDokumen, #laporanPenolakan').hide();
            });

            $('#btnLaporanSP3K').click(function() {
                setActiveButton($(this));
                $('#laporanSP3K').show();
                $('#laporanPengajuan, #laporanBiaya, #laporanDokumen, #laporanPenolakan').hide();
            });

            $('#btnLaporanBiaya').click(function() {
                setActiveButton($(this));
                $('#laporanBiaya').show();
                $('#laporanPengajuan, #laporanSP3K, #laporanDokumen, #laporanPenolakan').hide();
            });

            $('#btnLaporanDokumen').click(function() {
                setActiveButton($(this));
                $('#laporanDokumen').show();
                $('#laporanPengajuan, #laporanSP3K, #laporanBiaya, #laporanPenolakan').hide();
            });

            $('#btnLaporanPenolakan').click(function() {
                setActiveButton($(this));
                $('#laporanPenolakan').show();
                $('#laporanPengajuan, #laporanSP3K, #laporanBiaya, #laporanDokumen').hide();
            });

            function setActiveButton(btn) {
                $('.btn-group .btn').removeClass('active');
                btn.addClass('active');
            }

            // Simulasi download PDF
            $('#btnDownloadPDF').click(function() {
                alert('Fitur download PDF akan segera tersedia. Untuk sekarang, gunakan Cetak > Save as PDF');
            });
        });
    </script>
</body>
</html>
