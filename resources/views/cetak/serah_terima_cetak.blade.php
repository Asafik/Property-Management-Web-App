<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Berita Acara Serah Terima Unit - Properti Management</title>

    @if(!isset($pdf) || !$pdf)
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/5.9.55/css/materialdesignicons.min.css">
    @endif

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Times New Roman', Times, serif !important;
            background-color: {{ isset($pdf) && $pdf ? 'white' : '#f5f7fa' }};
            padding: {{ isset($pdf) && $pdf ? '0' : '30px 20px' }};
            margin: {{ isset($pdf) && $pdf ? '2cm' : '0' }};
            display: flex;
            justify-content: center;
            min-height: 100vh;
        }

        body, .card, .card-body, table, td, th, p, h1, h2, h3, h4, h5,
        .btn, .badge-status, .info-section, .footer-note,
        .alert, small, strong, span, div, li {
            font-family: 'Times New Roman', Times, serif !important;
        }

        .document-container {
            max-width: 210mm;
            width: 100%;
            margin: 0 auto;
            position: relative;
            box-shadow: {{ isset($pdf) && $pdf ? 'none' : '0 8px 20px rgba(0,0,0,0.1)' }};
        }

        /* WATERMARK */
        .watermark-text {
            user-select: none;
            font-size: 56px;
            color: rgba(75, 73, 172, 0.12);
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-30deg);
            white-space: nowrap;
            z-index: 999;
            pointer-events: none;
            font-weight: bold;
            border: 4px double rgba(75, 73, 172, 0.08);
            padding: 18px 42px;
            border-radius: 10px;
            letter-spacing: 4px;
            text-align: center;
        }

        @if(!isset($pdf) || !$pdf)
        .watermark-pattern {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            pointer-events: none;
            z-index: 998;
            opacity: 0.08;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            align-items: center;
            transform: rotate(-20deg);
        }

        .watermark-pattern span {
            font-size: 42px;
            font-weight: bold;
            color: #4b49ac;
            margin: 40px;
            white-space: nowrap;
        }
        @endif

        /* BUTTON */
        @if(!isset($pdf) || !$pdf)
        .btn-container {
            margin-bottom: 20px;
        }

        .btn {
            padding: 8px 18px;
            border-radius: 6px;
            border: none;
            cursor: pointer;
            font-size: 14px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            transition: 0.2s;
            text-decoration: none;
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

        .btn:hover {
            opacity: 0.92;
        }
        @endif

        /* CARD */
        .card {
            background: white;
            border-radius: 8px;
            box-shadow: {{ isset($pdf) && $pdf ? 'none' : '0 2px 15px rgba(0, 0, 0, 0.1)' }};
            margin-bottom: {{ isset($pdf) && $pdf ? '0' : '25px' }};
            position: relative;
            z-index: 1;
            border: {{ isset($pdf) && $pdf ? 'none' : '1px solid #e0e5ec' }};
        }

        .card-body {
            padding: 36px 42px;
        }

        /* HEADER */
        .document-header {
            text-align: center;
            margin-bottom: 22px;
            border-bottom: 2px solid #4b49ac;
            padding-bottom: 18px;
        }

        .document-header h2 {
            color: #4b49ac;
            font-size: 28px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 5px;
        }

        .document-header p {
            color: #6c757d;
            margin: 2px 0;
            font-size: 14px;
        }

        .document-title {
            text-align: center;
            margin: 18px 0 26px;
        }

        .document-title h3 {
            font-size: 22px;
            font-weight: bold;
            color: #333;
            border-bottom: 2px dashed #4b49ac;
            padding-bottom: 8px;
            display: inline-block;
            text-transform: uppercase;
        }

        .document-subtitle {
            margin-top: 8px;
            font-size: 14px;
            color: #666;
        }

        /* TABLE */
        .info-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 15px;
            line-height: 1.6;
            table-layout: fixed;
        }

        .info-table td {
            padding: 6px 5px;
            border: none;
            vertical-align: top;
            word-break: break-word;
            overflow-wrap: anywhere;
        }

        .info-table td:first-child {
            width: 190px;
            font-weight: 600;
            color: #555;
        }

        .info-table td:nth-child(2) {
            width: 15px;
            text-align: center;
        }

        .info-table td:last-child {
            width: auto;
        }

        /* SECTION */
        .info-section {
            margin-bottom: 24px;
            padding: 18px 22px;
            background-color: #f8f9fc;
            border-left: 6px solid #4b49ac;
            border-radius: 0 8px 8px 0;
        }

        .info-section h5,
        h5 {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 14px;
            color: #4b49ac;
            text-decoration: underline;
            text-underline-offset: 5px;
        }

        .paragraph {
            font-size: 15px;
            line-height: 1.8;
            text-align: justify;
            margin-bottom: 18px;
        }

        .check-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 12px;
            font-size: 15px;
        }

        .check-table th,
        .check-table td {
            border: 1px solid #d9dee7;
            padding: 10px 12px;
            vertical-align: top;
        }

        .check-table th {
            background: #eef1f7;
            text-align: center;
            font-weight: bold;
        }

        .checkmark {
            font-weight: bold;
            color: #00a651;
            font-size: 16px;
        }

        .xmark {
            font-weight: bold;
            color: #dc3545;
            font-size: 16px;
        }

        .doc-list {
            width: 100%;
            border-collapse: collapse;
            margin-top: 12px;
            font-size: 15px;
        }

        .doc-list th,
        .doc-list td {
            border: 1px solid #d9dee7;
            padding: 10px 12px;
            vertical-align: top;
        }

        .doc-list th {
            background: #eef1f7;
            text-align: center;
        }

        .badge-status {
            display: inline-block;
            padding: 5px 16px;
            border-radius: 30px;
            font-size: 13px;
            font-weight: 700;
            letter-spacing: 0.3px;
        }

        .badge-success {
            background-color: #00d25b;
            color: white;
        }

        .badge-warning {
            background-color: #ffab2e;
            color: white;
        }

        .notes-box {
            margin-top: 10px;
            padding: 14px 16px;
            background: #fafafa;
            border: 1px solid #dfe4ea;
            border-radius: 8px;
            min-height: 80px;
            font-size: 15px;
            line-height: 1.7;
        }

        .photo-box {
            margin-top: 10px;
            padding: 14px 16px;
            background: #fafafa;
            border: 1px dashed #b8c2d1;
            border-radius: 8px;
            min-height: 52px;
            font-size: 14px;
            color: #666;
        }

        .footer-note {
            margin-top: 35px;
            text-align: center;
            font-size: 12px;
            color: #6c757d;
            border-top: 1px dashed #acb8c5;
            padding-top: 18px;
        }

        .text-center {
            text-align: center;
        }

        .mb-15 { margin-bottom: 15px; }
        .mt-20 { margin-top: 20px; }

        /* PRINT */
        @media print {
            @page {
                size: A4;
                margin: 1.8cm;
            }

            body {
                background: white;
                padding: 0;
                margin: 0;
            }

            .document-container {
                max-width: 100%;
                box-shadow: none;
            }

            .btn-container,
            .d-print-none,
            .watermark-pattern {
                display: none !important;
            }

            .card {
                border: none;
                box-shadow: none;
            }

            .card-body {
                padding: 0;
            }

            .watermark-text {
                opacity: 0.15;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            .badge-success,
            .badge-warning {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
        }
    </style>
</head>
<body>

    @php
        $statusSerahTerima = 'Selesai';

        $checklists = $serahTerima->checklists ?? [
            ['nama' => 'Listrik berfungsi normal', 'status' => true, 'keterangan' => '-'],
            ['nama' => 'Air mengalir lancar', 'status' => true, 'keterangan' => '-'],
            ['nama' => 'Pintu & jendela berfungsi baik', 'status' => true, 'keterangan' => '-'],
            ['nama' => 'Kunci lengkap (pintu utama, pagar)', 'status' => true, 'keterangan' => '3 buah'],
            ['nama' => 'Dinding & plafon baik', 'status' => true, 'keterangan' => '-'],
            ['nama' => 'Lantai keramik baik', 'status' => true, 'keterangan' => '-'],
            ['nama' => 'Kloset & sanitasi berfungsi', 'status' => true, 'keterangan' => '-'],
            ['nama' => 'Meteran listrik & air terpasang', 'status' => true, 'keterangan' => '-'],
        ];

        $dokumenDiserahkan = $serahTerima->dokumen ?? [
            ['nama' => 'Kunci Unit', 'status' => true, 'keterangan' => '3 buah'],
            ['nama' => 'Akad KPR Asli', 'status' => true, 'keterangan' => '-'],
            ['nama' => 'Sertifikat Hak Milik (SHM)', 'status' => true, 'keterangan' => '-'],
            ['nama' => 'IMB / PBG', 'status' => true, 'keterangan' => '-'],
            ['nama' => 'Buku Panduan & Garansi', 'status' => true, 'keterangan' => '-'],
        ];
    @endphp

    <div class="watermark-text">BAST SERAH TERIMA UNIT</div>

    @if(!isset($pdf) || !$pdf)
    <div class="watermark-pattern">
        <span>PT PROPERTI MANAGEMENT</span><span>PT PROPERTI MANAGEMENT</span>
        <span>PT PROPERTI MANAGEMENT</span><span>PT PROPERTI MANAGEMENT</span>
        <span>PT PROPERTI MANAGEMENT</span><span>PT PROPERTI MANAGEMENT</span>
    </div>
    @endif

    <div class="document-container">
        @if(!isset($pdf) || !$pdf)
        <div class="btn-container d-print-none">
            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:16px;">
                <div>
                    <button class="btn btn-outline-secondary" onclick="history.back()">
                        <i class="mdi mdi-arrow-left"></i> Kembali
                    </button>
                </div>
                <div style="display:flex; gap:10px;">
                    @if(isset($downloadUrl))
                    <a href="{{ $downloadUrl }}" class="btn btn-success" target="_blank">
                        <i class="mdi mdi-download"></i> Download PDF
                    </a>
                    @endif
                    <button class="btn btn-primary" onclick="window.print()">
                        <i class="mdi mdi-printer"></i> Cetak
                    </button>
                </div>
            </div>
        </div>
        @endif

        <div class="card">
            <div class="card-body">

                <div class="document-header">
                    <h2>PT PROPERTI MANAGEMENT</h2>
                    <p>Jl. Sudirman No. 123, Jakarta Selatan 12190</p>
                    <p>Telp: (021) 1234567 | Email: info@propertimanagement.com</p>
                    <p>NPWP: 01.234.567.8-123.000</p>
                </div>

                <div class="document-title">
                    <h3>Berita Acara Serah Terima Unit</h3>
                    <div class="document-subtitle">
                        Nomor: <strong>{{ $serahTerima->nomor_bast ?? 'BAST/KPR/03/2024/012' }}</strong>
                    </div>
                </div>

                <div class="paragraph">
                    Pada hari ini,
                    <strong>{{ \Carbon\Carbon::parse($serahTerima->tanggal_serah_terima ?? now())->translatedFormat('d F Y') }}</strong>,
                    bertempat di
                    <strong>{{ $serahTerima->lokasi_serah_terima ?? 'Di Site / Proyek' }}</strong>,
                    telah dilakukan serah terima unit rumah dari pihak
                    <strong>PT Properti Management</strong>
                    kepada pembeli/customer dengan rincian sebagaimana tercantum di bawah ini.
                </div>

                <!-- DATA CUSTOMER -->
                <div class="info-section">
                    <h5>DATA CUSTOMER</h5>
                    <table class="info-table">
                        <tr>
                            <td>Nama Customer</td>
                            <td>:</td>
                            <td><strong>{{ $booking->customer->full_name ?? 'Muhamad Ilham' }}</strong></td>
                        </tr>
                        <tr>
                            <td>NIK</td>
                            <td>:</td>
                            <td>{{ $booking->customer->nik ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td>No. HP</td>
                            <td>:</td>
                            <td>{{ $booking->customer->phone ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td>Kode Booking</td>
                            <td>:</td>
                            <td>{{ $booking->booking_code ?? 'BK-KPR-2024-089' }}</td>
                        </tr>
                        <tr>
                            <td>Jenis Pembiayaan</td>
                            <td>:</td>
                            <td>{{ $booking->payment_method ?? 'KPR Subsidi' }}</td>
                        </tr>
                    </table>
                </div>

                <!-- DATA UNIT -->
                <div class="info-section">
                    <h5>DATA UNIT</h5>
                    <table class="info-table">
                        <tr>
                            <td>Nama Unit</td>
                            <td>:</td>
                            <td>{{ $booking->unit->cluster ?? 'Cluster Kamboja' }}</td>
                        </tr>
                        <tr>
                            <td>Blok / Nomor</td>
                            <td>:</td>
                            <td>{{ $booking->unit->unit_code ?? 'C-08' }}</td>
                        </tr>
                        <tr>
                            <td>Tipe Unit</td>
                            <td>:</td>
                            <td>{{ $booking->unit->type ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td>Harga Unit</td>
                            <td>:</td>
                            <td>Rp {{ number_format($booking->unit->price ?? 650000000, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td>Status Serah Terima</td>
                            <td>:</td>
                            <td>
                                <span class="badge-status badge-success">
                                    {{ $statusSerahTerima }}
                                </span>
                            </td>
                        </tr>
                    </table>
                </div>

                <!-- PIHAK -->
                <div class="info-section">
                    <h5>PIHAK YANG MENYERAHKAN & MENERIMA</h5>
                    <table class="info-table">
                        <tr>
                            <td>Diserahkan Oleh</td>
                            <td>:</td>
                            <td>{{ $serahTerima->handled_by_name ?? ($booking->sales->name ?? 'Dian Permata') }}</td>
                        </tr>
                        <tr>
                            <td>Jabatan</td>
                            <td>:</td>
                            <td>{{ $serahTerima->handled_by_role ?? 'Marketing KPR' }}</td>
                        </tr>
                        <tr>
                            <td>Diterima Oleh</td>
                            <td>:</td>
                            <td>{{ $booking->customer->full_name ?? 'Muhamad Ilham' }}</td>
                        </tr>
                        <tr>
                            <td>Saksi</td>
                            <td>:</td>
                            <td>{{ $serahTerima->saksi ?? '-' }}</td>
                        </tr>
                    </table>
                </div>

                <h5>CHECKLIST KONDISI UNIT</h5>
                <table class="check-table">
                    <thead>
                        <tr>
                            <th width="7%">No</th>
                            <th>Item Pemeriksaan</th>
                            <th width="18%">Status</th>
                            <th width="28%">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($checklists as $i => $item)
                        <tr>
                            <td class="text-center">{{ $i + 1 }}</td>
                            <td>{{ is_array($item) ? $item['nama'] : $item->nama }}</td>
                            <td class="text-center">
                                @if(is_array($item) ? $item['status'] : $item->status)
                                    <span class="checkmark">Baik / Sesuai</span>
                                @else
                                    <span class="xmark">Belum Sesuai</span>
                                @endif
                            </td>
                            <td>{{ is_array($item) ? ($item['keterangan'] ?? '-') : ($item->keterangan ?? '-') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="mt-20">
                    <h5>DOKUMEN YANG DISERAHKAN</h5>
                    <table class="doc-list">
                        <thead>
                            <tr>
                                <th width="7%">No</th>
                                <th>Nama Dokumen / Item</th>
                                <th width="18%">Status</th>
                                <th width="28%">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($dokumenDiserahkan as $i => $doc)
                            <tr>
                                <td class="text-center">{{ $i + 1 }}</td>
                                <td>{{ is_array($doc) ? $doc['nama'] : $doc->nama }}</td>
                                <td class="text-center">
                                    {{ (is_array($doc) ? $doc['status'] : $doc->status) ? 'Diserahkan' : 'Belum' }}
                                </td>
                                <td>{{ is_array($doc) ? ($doc['keterangan'] ?? '-') : ($doc->keterangan ?? '-') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-20">
                    <h5>DOKUMENTASI SERAH TERIMA</h5>

                    <div class="mb-15">
                        <strong>Foto Serah Terima Kunci</strong>
                        <div class="photo-box">
                            {{ $serahTerima->foto_kunci ?? 'Terlampir / sesuai arsip sistem' }}
                        </div>
                    </div>

                    <div class="mb-15">
                        <strong>Foto Kondisi Unit</strong>
                        <div class="photo-box">
                            {{ $serahTerima->foto_unit ?? 'Terlampir / sesuai arsip sistem' }}
                        </div>
                    </div>
                </div>

                <div class="mt-20">
                    <h5>CATATAN</h5>
                    <div class="notes-box">
                        {{ $serahTerima->catatan ?? 'Tidak ada catatan tambahan.' }}
                    </div>
                </div>

                <div class="info-section mt-20">
                    <h5>PERNYATAAN</h5>
                    <div class="paragraph" style="margin-bottom:0;">
                        Dengan ditandatanganinya Berita Acara Serah Terima Unit ini, maka pihak pembeli menyatakan bahwa unit telah diterima
                        dalam kondisi baik, layak huni, dan sesuai dengan hasil pemeriksaan/checklist yang telah dilakukan bersama.
                        Segala dokumen dan perlengkapan yang tercantum juga dinyatakan telah diterima sebagaimana mestinya.
                    </div>
                </div>

                <table style="width:100%; margin-top:55px; border-collapse:collapse; page-break-inside:avoid;">
                    <tr>
                        <td style="width:30%; text-align:center; vertical-align:top; padding:0;">
                            <p style="margin:0 0 5px 0; font-weight:500; font-size:14px;">Yang Menyerahkan,</p>
                            <div style="margin-top:60px; border-top:2px solid #000; padding-top:10px; font-weight:600; font-size:16px;">
                                {{ $serahTerima->handled_by_name ?? ($booking->sales->name ?? '_________________') }}
                            </div>
                            <p style="color:#6c757d; font-size:12px; margin-top:5px;">
                                {{ $serahTerima->handled_by_role ?? 'Marketing KPR' }}
                            </p>
                        </td>

                        <td style="width:5%;"></td>

                        <td style="width:30%; text-align:center; vertical-align:top; padding:0;">
                            <p style="margin:0 0 5px 0; font-weight:500; font-size:14px;">Yang Menerima,</p>
                            <div style="margin-top:60px; border-top:2px solid #000; padding-top:10px; font-weight:600; font-size:16px;">
                                {{ $booking->customer->full_name ?? '_________________' }}
                            </div>
                            <p style="color:#6c757d; font-size:12px; margin-top:5px;">Customer / Pembeli</p>
                        </td>

                        <td style="width:5%;"></td>

                        <td style="width:30%; text-align:center; vertical-align:top; padding:0;">
                            <p style="margin:0 0 5px 0; font-weight:500; font-size:14px;">Saksi,</p>
                            <div style="margin-top:60px; border-top:2px solid #000; padding-top:10px; font-weight:600; font-size:16px;">
                                {{ $serahTerima->saksi ?? '_________________' }}
                            </div>
                            <p style="color:#6c757d; font-size:12px; margin-top:5px;">Saksi Serah Terima</p>
                        </td>
                    </tr>
                </table>

                <div class="footer-note">
                    <p>Dokumen ini sah dan dicetak secara elektronik</p>
                    <p>Berita Acara Serah Terima Unit ini digunakan sebagai bukti penyerahan unit kepada customer</p>
                    <p>Dicetak pada: {{ date('d/m/Y H:i:s') }}</p>
                </div>

            </div>
        </div>

        @if(!isset($pdf) || !$pdf)
        <div class="d-print-none" style="background:#e8ecf5;padding:12px;border-radius:8px;margin-top:10px;">
            <i class="mdi mdi-information-outline"></i>
            Dokumen ini dilengkapi watermark untuk keamanan.
        </div>
        @endif
    </div>
</body>
</html>
