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
        /* ===== RESET & BASE ===== */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #f5f7fa;
            font-family: 'Times New Roman', Times, serif !important;
            padding: 30px 20px;
            display: flex;
            justify-content: center;
            min-height: 100vh;
        }

        /* PAKSA SEMUA PAKAI TIMES NEW ROMAN */
        body, .card, .card-body, table, td, th, p, h1, h2, h3, h4, h5, h6,
        .btn, .badge-status, .info-section, .laporan-header, .footer-note,
        .signature-box, .signature-line, .alert, small, strong, span, div, li {
            font-family: 'Times New Roman', Times, serif !important;
        }

        /* ===== LAYOUT A4 ===== */
        .laporan-container {
            max-width: 210mm;
            width: 100%;
            margin: 0 auto;
            position: relative;
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        }

        /* ===== TOMBOL ===== */
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
            font-family: 'Times New Roman', Times, serif;
        }

        .btn-primary {
            background: linear-gradient(45deg, #4b49ac, #7a78c5);
            color: white;
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

        .btn.active {
            transform: scale(1.02);
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
            border: 2px solid #4b49ac;
            font-weight: bold;
        }

        /* ===== CARD ===== */
        .card {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 15px rgba(0,0,0,0.1);
            margin-bottom: 20px;
            border: 1px solid #e0e5ec;
        }

        .card-body {
            padding: 40px 45px;
        }

        /* ===== HEADER ===== */
        .laporan-header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #4b49ac;
            padding-bottom: 20px;
        }

        .laporan-header h2 {
            color: #4b49ac;
            font-size: 28px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .laporan-header p {
            color: #6c757d;
            font-size: 14px;
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

        /* ===== TABEL INFO ===== */
        .info-section {
            margin-bottom: 30px;
            padding: 20px;
            background-color: #f8f9fc;
            border-left: 6px solid #4b49ac;
            border-radius: 8px;
        }

        .info-section h5 {
            font-size: 18px;
            font-weight: bold;
            color: #4b49ac;
            text-decoration: underline;
            margin-bottom: 15px;
        }

        .info-table {
            width: 100%;
            border-collapse: collapse;
        }

        .info-table td {
            padding: 8px 5px;
            border: none;
            font-size: 15px;
            vertical-align: top;
        }

        .info-table td:first-child {
            width: 150px;
            font-weight: 600;
            color: #555;
        }

        .info-table td:nth-child(2) {
            width: 20px;
            text-align: center;
        }

        /* ===== TABEL DETAIL ===== */
        .detail-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            font-size: 15px;
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

        .grand-total {
            background-color: #4b49ac;
            color: white;
            font-weight: bold;
        }

        .text-end {
            text-align: right;
        }

        /* ===== BADGE ===== */
        .badge-status {
            display: inline-block;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
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

        /* ===== TANDA TANGAN - SUPER PAKSA SEJAJAR ===== */
        .signature-wrapper {
            margin-top: 50px;
            width: 100%;
            page-break-inside: avoid;
        }

        .signature-table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        .signature-table td {
            text-align: center;
            vertical-align: top;
            padding: 0 5px;
            width: 33.33%;
        }

        .signature-label {
            font-weight: 500;
            font-size: 14px;
            margin-bottom: 5px;
            white-space: nowrap;
        }

        .signature-line-container {
            margin-top: 40px;
            width: 100%;
        }

        .signature-line {
            border-top: 2px solid #333;
            padding-top: 8px;
            font-weight: 600;
            font-size: 15px;
            width: 90%;
            margin: 0 auto;
            min-height: 30px;
        }

        .signature-role {
            color: #6c757d;
            font-size: 12px;
            margin-top: 5px;
        }

        /* ===== FOOTER ===== */
        .footer-note {
            margin-top: 30px;
            text-align: center;
            font-size: 12px;
            color: #6c757d;
            border-top: 1px dashed #acb8c5;
            padding-top: 15px;
        }

        .d-none {
            display: none;
        }

        /* ===== MODE CETAK ===== */
        @media print {
            @page {
                size: A4;
                margin: 1.8cm;
            }

            body {
                background: white;
                padding: 0;
            }

            .btn-container,
            .btn-group,
            .alert-info,
            .d-print-none {
                display: none !important;
            }

            .card {
                border: none;
                box-shadow: none;
            }

            .card-body {
                padding: 0 !important;
            }

            .badge-status,
            .detail-table th,
            .grand-total {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            .signature-line {
                border-top: 2px solid #333 !important;
            }

            table {
                page-break-inside: avoid;
            }
        }
    </style>
</head>
<body>
    <div class="laporan-container">
        <!-- Tombol Navigasi -->
        <div class="btn-container d-print-none">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <button class="btn btn-outline-secondary" onclick="history.back()">
                    <i class="mdi mdi-arrow-left me-2"></i> Kembali
                </button>
                <button class="btn btn-primary" onclick="window.print()">
                    <i class="mdi mdi-printer me-2"></i> Cetak Laporan
                </button>
            </div>

            <!-- Pilihan Jenis Laporan -->
            <div class="d-flex justify-content-center mb-4">
                <div class="btn-group">
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
            </div>
        </div>

        <!-- Card Laporan -->
        <div class="card">
            <div class="card-body">
                <!-- LAPORAN PENGAJUAN KPR -->
                <div id="laporanPengajuan">
                    <div class="laporan-header">
                        <h2>PT PROPERTI MANAGEMENT</h2>
                        <p>Jl. Sudirman No. 123, Jakarta Selatan 12190</p>
                        <p>Telp: (021) 1234567 | Email: info@propertimanagement.com</p>
                        <p>NPWP: 01.234.567.8-123.000</p>
                    </div>

                    <div class="laporan-title">
                        <h3>LAPORAN PENGAJUAN KPR</h3>
                    </div>

                    <!-- Info Invoice -->
                    <table class="info-table" style="width:100%; margin-bottom:20px;">
                        <tr><td>No. Laporan</td><td>:</td><td><strong>LAP/KPR/2025/021</strong></td></tr>
                        <tr><td>Tanggal Laporan</td><td>:</td><td>25 Februari 2025</td></tr>
                        <tr><td>Status</td><td>:</td><td><span class="badge-status badge-info">Menunggu Persetujuan</span></td></tr>
                        <tr><td>Jenis</td><td>:</td><td>KPR Non Subsidi</td></tr>
                    </table>

                    <!-- Data Customer -->
                    <div class="info-section">
                        <h5>DATA CUSTOMER</h5>
                        <table class="info-table">
                            <tr><td>Nama Customer</td><td>:</td><td><strong>Budi Santoso</strong></td></tr>
                            <tr><td>NIK</td><td>:</td><td>3273011203850001</td></tr>
                            <tr><td>No. HP</td><td>:</td><td>081234567890</td></tr>
                            <tr><td>Booking ID</td><td>:</td><td>#INV/202502/001</td></tr>
                            <tr><td>Unit</td><td>:</td><td>The Lavender - Tipe 45</td></tr>
                            <tr><td>Blok/No</td><td>:</td><td>C/12</td></tr>
                            <tr><td>Harga Unit</td><td>:</td><td>Rp 450.000.000</td></tr>
                        </table>
                    </div>

                    <!-- Detail KPR -->
                    <h5>DETAIL KPR</h5>
                    <table class="detail-table">
                        <tr><td width="30%"><strong>Bank Tujuan</strong></td><td>Bank ABC Syariah</td></tr>
                        <tr><td><strong>Jumlah Pinjaman</strong></td><td>Rp 360.000.000</td></tr>
                        <tr><td><strong>Tenor</strong></td><td>15 Tahun (180 bulan)</td></tr>
                        <tr><td><strong>Angsuran per Bulan</strong></td><td>Rp 3.200.000</td></tr>
                        <tr><td><strong>Suku Bunga</strong></td><td>7.5% per tahun</td></tr>
                    </table>

                    <!-- Timeline -->
                    <h5>TIMELINE PROSES</h5>
                    <table class="detail-table">
                        <thead><tr><th>Tahapan</th><th>Tanggal</th><th>Status</th><th>Keterangan</th></tr></thead>
                        <tbody>
                            <tr><td>Pengajuan KPR</td><td>12 Feb 2025</td><td><span class="badge-status badge-success">Selesai</span></td><td>Dokumen lengkap</td></tr>
                            <tr><td>Verifikasi Dokumen</td><td>14 Feb 2025</td><td><span class="badge-status badge-success">Selesai</span></td><td>Verifikasi by bank</td></tr>
                            <tr><td>Survey Lapangan</td><td>20 Feb 2025</td><td><span class="badge-status badge-success">Selesai</span></td><td>Nilai appraisal Rp 445 Juta</td></tr>
                            <tr><td>Persetujuan Bank</td><td>-</td><td><span class="badge-status badge-warning">Proses</span></td><td>Menunggu keputusan</td></tr>
                        </tbody>
                    </table>

                    <!-- Hasil Survey -->
                    <h5>HASIL SURVEY</h5>
                    <table class="detail-table">
                        <tr><td width="30%"><strong>Nilai Appraisal</strong></td><td>Rp 445.000.000</td></tr>
                        <tr><td><strong>Surveyor</strong></td><td>Hendra Wijaya</td></tr>
                        <tr><td><strong>Rekomendasi</strong></td><td>Layak - Sesuai Harga</td></tr>
                        <tr><td><strong>Tanggal Survey</strong></td><td>20 Februari 2025</td></tr>
                    </table>

                    <!-- Catatan -->
                    <h5>CATATAN</h5>
                    <div style="padding:15px; border:1px solid #dee2e6; border-radius:8px; margin-bottom:20px;">
                        Pengajuan KPR dalam proses persetujuan bank. Dokumen lengkap dan survey sudah dilakukan.
                    </div>

                    <!-- TANDA TANGAN - SUPER PAKSA SEJAJAR -->
                    <div class="signature-wrapper">
                        <table class="signature-table">
                            <tr>
                                <td>
                                    <div class="signature-label">Mengetahui,</div>
                                    <div class="signature-line-container">
                                        <div class="signature-line">_________________</div>
                                    </div>
                                    <div class="signature-role">Manager Marketing</div>
                                </td>
                                <td>
                                    <div class="signature-label">Mengetahui,</div>
                                    <div class="signature-line-container">
                                        <div class="signature-line">_________________</div>
                                    </div>
                                    <div class="signature-role">Finance</div>
                                </td>
                                <td>
                                    <div class="signature-label">Jakarta, 25 Februari 2025</div>
                                    <div class="signature-line-container">
                                        <div class="signature-line">Ahmad Rizki</div>
                                    </div>
                                    <div class="signature-role">Marketing Officer</div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>

                <!-- LAPORAN SP3K -->
                <div id="laporanSP3K" style="display: none;">
                    <div class="laporan-header">
                        <h2 style="color: #0047ab;">BANK ABC SYARIAH</h2>
                        <p>Kantor Cabang Jakarta Selatan</p>
                        <p>Jl. Sudirman No. 456, Jakarta</p>
                    </div>
                    <div class="laporan-title"><h3>SURAT PERSETUJUAN PRINSIP (SP3K)</h3></div>

                    <table class="info-table" style="margin-bottom:20px;">
                        <tr><td>No. SP3K</td><td>:</td><td><strong>SP3K/2025/021/ABC</strong></td></tr>
                        <tr><td>Tanggal</td><td>:</td><td>25 Februari 2025</td></tr>
                    </table>

                    <div style="margin-bottom:20px;">
                        <p>Kepada Yth,<br>Bapak Budi Santoso<br>di Tempat</p>
                        <p class="mt-4">Dengan ini kami sampaikan bahwa permohonan KPR Saudara telah <strong>DISETUJUI</strong> dengan ketentuan sebagai berikut:</p>

                        <table class="detail-table" style="margin:20px 0;">
                            <tr><td width="40%"><strong>Plafon Kredit</strong></td><td>Rp 360.000.000</td></tr>
                            <tr><td><strong>Tenor</strong></td><td>15 Tahun (180 bulan)</td></tr>
                            <tr><td><strong>Suku Bunga</strong></td><td>7.25% per tahun (fixed 3 tahun)</td></tr>
                            <tr><td><strong>Angsuran per Bulan</strong></td><td>Rp 3.150.000</td></tr>
                        </table>

                        <p><strong>Syarat dan Ketentuan:</strong></p>
                        <ol>
                            <li>Persetujuan ini berlaku 30 hari</li>
                            <li>Akad kredit paling lambat 30 Maret 2025</li>
                            <li>Dokumen asli diserahkan saat akad</li>
                            <li>Biaya provisi 1% dibayar sebelum akad</li>
                        </ol>
                    </div>

                    <!-- Tanda Tangan SP3K -->
                    <div class="signature-wrapper">
                        <table class="signature-table">
                            <tr>
                                <td style="width:100%;">
                                    <div class="signature-label">Jakarta, 25 Februari 2025</div>
                                    <div class="signature-line-container">
                                        <div class="signature-line" style="width:50%;">_________________</div>
                                    </div>
                                    <div class="signature-role">Branch Manager Bank ABC Syariah</div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>

                <!-- LAPORAN BIAYA -->
                <div id="laporanBiaya" style="display: none;">
                    <div class="laporan-header"><h2>PT PROPERTI MANAGEMENT</h2><p>Jl. Sudirman No. 123, Jakarta</p></div>
                    <div class="laporan-title"><h3>RINGKASAN BIAYA</h3></div>

                    <table class="info-table" style="margin-bottom:20px;">
                        <tr><td>No. Biaya</td><td>:</td><td><strong>BIAYA/2025/021</strong></td></tr>
                        <tr><td>Tanggal</td><td>:</td><td>25 Februari 2025</td></tr>
                    </table>

                    <div class="info-section">
                        <table class="info-table">
                            <tr><td>Nama Customer</td><td>:</td><td><strong>Budi Santoso</strong></td></tr>
                            <tr><td>Booking ID</td><td>:</td><td>#INV/202502/001</td></tr>
                            <tr><td>Unit</td><td>:</td><td>The Lavender Tipe 45</td></tr>
                        </table>
                    </div>

                    <table class="detail-table">
                        <thead><tr><th>No</th><th>Keterangan</th><th class="text-end">Jumlah</th></tr></thead>
                        <tbody>
                            <tr><td>1</td><td>Booking Fee</td><td class="text-end">Rp 10.000.000</td></tr>
                            <tr><td>2</td><td>DP 20%</td><td class="text-end">Rp 90.000.000</td></tr>
                            <tr><td>3</td><td>Biaya Survey</td><td class="text-end">Rp 500.000</td></tr>
                            <tr><td>4</td><td>Biaya Provisi Bank</td><td class="text-end">Rp 3.600.000</td></tr>
                            <tr><td>5</td><td>Biaya Notaris</td><td class="text-end">Rp 5.000.000</td></tr>
                            <tr><td>6</td><td>BPHTB</td><td class="text-end">Rp 4.500.000</td></tr>
                            <tr class="grand-total"><td colspan="2" class="text-end"><strong>TOTAL</strong></td><td class="text-end"><strong>Rp 113.600.000</strong></td></tr>
                        </tbody>
                    </table>
                </div>

                <!-- LAPORAN DOKUMEN -->
                <div id="laporanDokumen" style="display: none;">
                    <div class="laporan-header"><h2>PT PROPERTI MANAGEMENT</h2><p>Jl. Sudirman No. 123, Jakarta</p></div>
                    <div class="laporan-title"><h3>CHECKLIST DOKUMEN KPR</h3></div>

                    <table class="info-table" style="margin-bottom:20px;">
                        <tr><td>No. Dokumen</td><td>:</td><td><strong>DOK/2025/021</strong></td></tr>
                        <tr><td>Tanggal</td><td>:</td><td>25 Februari 2025</td></tr>
                    </table>

                    <div class="info-section">
                        <table class="info-table">
                            <tr><td>Nama Customer</td><td>:</td><td><strong>Budi Santoso</strong></td></tr>
                            <tr><td>Bank Tujuan</td><td>:</td><td>Bank ABC Syariah</td></tr>
                        </table>
                    </div>

                    <table class="detail-table">
                        <thead><tr><th>No</th><th>Jenis Dokumen</th><th>Status</th></tr></thead>
                        <tbody>
                            <tr><td>1</td><td>KTP Customer</td><td><span class="badge-status badge-success">Lengkap</span></td></tr>
                            <tr><td>2</td><td>Kartu Keluarga</td><td><span class="badge-status badge-success">Lengkap</span></td></tr>
                            <tr><td>3</td><td>NPWP</td><td><span class="badge-status badge-success">Lengkap</span></td></tr>
                            <tr><td>4</td><td>Slip Gaji (3 bulan)</td><td><span class="badge-status badge-warning">Belum Lengkap</span></td></tr>
                            <tr><td>5</td><td>Rekening Tabungan</td><td><span class="badge-status badge-warning">Belum Lengkap</span></td></tr>
                            <tr><td>6</td><td>Surat Nikah</td><td><span class="badge-status badge-success">Lengkap</span></td></tr>
                            <tr><td>7</td><td>KTP Pasangan</td><td><span class="badge-status badge-success">Lengkap</span></td></tr>
                        </tbody>
                    </table>
                </div>

                <!-- LAPORAN PENOLAKAN -->
                <div id="laporanPenolakan" style="display: none;">
                    <div class="laporan-header"><h2 style="color: #dc3545;">BANK ABC SYARIAH</h2><p>Kantor Cabang Jakarta Selatan</p></div>
                    <div class="laporan-title"><h3 style="color: #dc3545;">SURAT PENOLAKAN KPR</h3></div>

                    <table class="info-table" style="margin-bottom:20px;">
                        <tr><td>No. Penolakan</td><td>:</td><td><strong>TOLAK/2025/021/ABC</strong></td></tr>
                        <tr><td>Tanggal</td><td>:</td><td>25 Februari 2025</td></tr>
                    </table>

                    <div style="margin-bottom:20px;">
                        <p>Kepada Yth,<br>Bapak Budi Santoso<br>di Tempat</p>
                        <p class="mt-4">Dengan ini kami sampaikan bahwa permohonan KPR Saudara <strong>DITOLAK</strong> dengan alasan:</p>

                        <div style="background:#f8d7da; border:1px solid #f5c6cb; padding:15px; border-radius:8px; margin:20px 0;">
                            <h6 style="color:#721c24; margin-bottom:10px;">ALASAN PENOLAKAN:</h6>
                            <p style="color:#721c24;">BI Checking / SLIK bermasalah. Terdapat catatan kredit macet pada 2 tahun terakhir.</p>
                        </div>

                        <p><strong>Rekomendasi:</strong></p>
                        <ul>
                            <li>Ajukan kembali setelah 6 bulan</li>
                            <li>Ajukan ke bank lain</li>
                            <li>Gunakan skema cash/bertahap</li>
                        </ul>
                    </div>

                    <!-- Tanda Tangan Penolakan -->
                    <div class="signature-wrapper">
                        <table class="signature-table">
                            <tr>
                                <td style="width:100%;">
                                    <div class="signature-label">Jakarta, 25 Februari 2025</div>
                                    <div class="signature-line-container">
                                        <div class="signature-line" style="width:50%;">_________________</div>
                                    </div>
                                    <div class="signature-role">Analis Kredit Bank ABC Syariah</div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>

                <!-- Footer Note -->
                <div class="footer-note">
                    <p>Dokumen ini sah dan dicetak secara elektronik</p>
                    <p>Dicetak pada: {{ date('d/m/Y H:i:s') }}</p>
                </div>
            </div>
        </div>

        <!-- Info (tidak ikut print) -->
        <div class="alert alert-info d-print-none mt-3">
            <i class="mdi mdi-information-outline me-2"></i>
            Pilih jenis laporan di atas untuk preview berbeda.
        </div>
    </div>

    <script src="{{ asset('admin/assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            function setActive(btn) {
                $('.btn-group .btn').removeClass('active');
                btn.addClass('active');
            }

            $('#btnLaporanPengajuan').click(function() {
                setActive($(this));
                $('#laporanPengajuan').show();
                $('#laporanSP3K, #laporanBiaya, #laporanDokumen, #laporanPenolakan').hide();
            });

            $('#btnLaporanSP3K').click(function() {
                setActive($(this));
                $('#laporanSP3K').show();
                $('#laporanPengajuan, #laporanBiaya, #laporanDokumen, #laporanPenolakan').hide();
            });

            $('#btnLaporanBiaya').click(function() {
                setActive($(this));
                $('#laporanBiaya').show();
                $('#laporanPengajuan, #laporanSP3K, #laporanDokumen, #laporanPenolakan').hide();
            });

            $('#btnLaporanDokumen').click(function() {
                setActive($(this));
                $('#laporanDokumen').show();
                $('#laporanPengajuan, #laporanSP3K, #laporanBiaya, #laporanPenolakan').hide();
            });

            $('#btnLaporanPenolakan').click(function() {
                setActive($(this));
                $('#laporanPenolakan').show();
                $('#laporanPengajuan, #laporanSP3K, #laporanBiaya, #laporanDokumen').hide();
            });
        });
    </script>
</body>
</html>
