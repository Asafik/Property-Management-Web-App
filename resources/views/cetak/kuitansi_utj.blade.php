<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kuitansi Tanda Terima UTJ - {{ $booking->booking_code ?? 'UTJ' }}</title>
    <link rel="icon" type="image/jpeg" href="{{ asset('images/logo.jpeg') }}">
    <link rel="shortcut icon" href="{{ asset('images/logo.jpeg') }}">

    @if(!isset($pdf) || !$pdf)
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@800;900&family=Plus+Jakarta+Sans:wght@500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/5.9.55/css/materialdesignicons.min.css">
    @endif

    <style>
        /* ===== RESET & BASE ===== */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        @if(isset($pdf) && $pdf)
        @page {
            size: A4 portrait;
            margin: 10mm 15mm 10mm 15mm;
        }

        html, body {
            background-color: #ffffff !important;
            padding: 0 !important;
            margin: 0 !important;
            width: 100% !important;
            font-family: 'Times New Roman', Times, serif !important;
            color: #111827;
        }

        .kuitansi-container {
            width: 100% !important;
            max-width: 100% !important;
            margin: 0 auto !important;
            padding: 0 !important;
            border: none !important;
            box-shadow: none !important;
            background: #ffffff;
        }
        @else
        body {
            font-family: 'Times New Roman', Times, serif !important;
            background-color: #f1f5f9;
            padding: 25px 20px;
            color: #111827;
        }

        .kuitansi-container {
            max-width: 210mm;
            width: 100%;
            margin: 75px auto 30px auto;
            position: relative;
            background: #ffffff;
            padding: 25px 35px;
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            border: 1px solid #e2e8f0;
        }
        @endif

        body, .kuitansi-container, table, td, th, p, h1, h2, h3, h4, h5,
        small, strong, span, div, li {
            font-family: 'Times New Roman', Times, serif !important;
        }

        @if(!isset($pdf) || !$pdf)
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
            font-family: 'Plus Jakarta Sans', sans-serif !important;
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
            font-family: 'Plus Jakarta Sans', sans-serif !important;
        }

        .no-print-bar .btn-action-print:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(2, 132, 199, 0.4);
            color: #ffffff;
        }

        .no-print-bar .btn-action-wa {
            background: linear-gradient(135deg, #25D366, #128C7E);
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
            font-family: 'Plus Jakarta Sans', sans-serif !important;
        }

        .no-print-bar .btn-action-wa:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(37, 211, 102, 0.4);
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
            font-family: 'Plus Jakarta Sans', sans-serif !important;
        }

        .no-print-bar .btn-action-close:hover {
            background: rgba(255, 255, 255, 0.25);
            color: #ffffff;
        }

        .watermark-bg {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-25deg);
            font-size: 55px;
            font-weight: bold;
            color: rgba(0, 75, 147, 0.04);
            text-transform: uppercase;
            letter-spacing: 6px;
            pointer-events: none;
            user-select: none;
            border: 3px double rgba(0, 75, 147, 0.06);
            padding: 10px 30px;
            border-radius: 10px;
            z-index: 0;
            font-family: 'Plus Jakarta Sans', sans-serif !important;
        }
        @endif

        /* ===== KOP SURAT TABLE (PERFECTLY BALANCED 3 COLUMNS) ===== */
        .kop-table {
            width: 100%;
            border-collapse: collapse;
            border-bottom: 3.5px double #004b93;
            padding-bottom: 8px;
            margin-bottom: 12px;
            table-layout: fixed;
        }

        .kop-table td {
            vertical-align: middle;
            border: none;
            padding: 0;
        }

        .company-main-title {
            color: #004b93 !important;
            font-size: 18pt !important;
            font-weight: 900 !important;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin: 0 0 2px 0;
            font-family: 'Montserrat', Arial, sans-serif !important;
            text-align: center;
            line-height: 1.15;
        }

        .company-sub-title {
            color: #002d62 !important;
            font-size: 11pt !important;
            font-weight: 800 !important;
            letter-spacing: 0.3px;
            margin: 0 0 2px 0;
            font-family: 'Plus Jakarta Sans', Arial, sans-serif !important;
            text-align: center;
        }

        .company-address {
            color: #000000 !important;
            margin: 0;
            font-size: 8.5pt !important;
            font-weight: 600;
            font-family: Arial, Helvetica, sans-serif !important;
            text-align: center;
        }

        /* ===== TITLE SECTION ===== */
        .title-box {
            text-align: center;
            margin-bottom: 12px;
        }

        .doc-title {
            font-size: 12.5pt;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            text-decoration: underline;
            margin-bottom: 2px;
            color: #0f172a;
        }

        .doc-number {
            font-size: 9.5pt;
            font-weight: 600;
            color: #334155;
            margin-bottom: 4px;
        }

        .stamp-lunas {
            display: inline-block;
            border: 1.5px solid #059669;
            color: #059669;
            font-weight: bold;
            font-size: 8pt;
            padding: 2px 10px;
            border-radius: 4px;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        /* ===== DATA TABLE STYLING ===== */
        .receipt-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
            font-size: 9.5pt;
            table-layout: fixed;
        }

        .receipt-table td {
            padding: 3px 2px;
            vertical-align: top;
            border: none;
        }

        .col-label {
            width: 25%;
            font-weight: bold;
            color: #333333;
        }

        .col-colon {
            width: 3%;
            text-align: center;
        }

        .col-value {
            width: 72%;
            color: #111111;
        }

        /* ===== BOX NOMINAL TERBILANG TABLE ===== */
        .amount-box-table {
            width: 100%;
            border: 1.5px dashed #004b93;
            background-color: #f0f7ff;
            margin: 10px 0 12px 0;
            border-collapse: collapse;
            table-layout: fixed;
        }

        .amount-box-table td {
            border: none;
            padding: 6px 12px;
            vertical-align: middle;
        }

        /* ===== UNIT DETAILS CARD ===== */
        .unit-info-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
            border: 1px solid #cbd5e1;
            font-size: 9pt;
            table-layout: fixed;
        }

        .unit-info-table th {
            background-color: #f1f5f9;
            border: 1px solid #cbd5e1;
            padding: 5px 8px;
            text-align: left;
            font-size: 9pt;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #0f172a;
        }

        .unit-info-table td {
            border: 1px solid #cbd5e1;
            padding: 4.5px 8px;
        }

        /* ===== KETENTUAN UTJ TABLE ===== */
        .notes-table {
            width: 100%;
            background-color: #fafafa;
            border: 1px solid #e5e7eb;
            margin-bottom: 10px;
            border-collapse: collapse;
            table-layout: fixed;
        }

        .notes-table td {
            padding: 6px 10px;
            border: none;
        }

        /* ===== PRINT STYLES ===== */
        @media print {
            @page {
                size: 215mm 330mm portrait;
                margin: 1.2cm 1.5cm;
            }

            body {
                background: #fff !important;
                padding: 0 !important;
                margin: 0 !important;
            }

            .no-print-bar,
            .d-print-none {
                display: none !important;
            }

            .kuitansi-container {
                box-shadow: none !important;
                border: none !important;
                padding: 0 !important;
                margin: 0 !important;
                max-width: 100% !important;
                width: 100% !important;
            }

            .amount-box-table,
            .unit-info-table th,
            .stamp-lunas {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
        }
    </style>
</head>
<body>

    @php
        $logoPath = public_path('images/logo1.png');
        $logoBase64 = file_exists($logoPath) ? 'data:image/png;base64,' . base64_encode(file_get_contents($logoPath)) : asset('images/logo1.png');
    @endphp

    @if(!isset($pdf) || !$pdf)
    <!-- FLOATING TOP ACTION BAR -->
    <div class="no-print-bar">
        <a href="javascript:history.back()" class="btn-action-close">
            <i class="mdi mdi-arrow-left"></i> Tutup / Kembali
        </a>
        <button onclick="window.print()" class="btn-action-print">
            <i class="mdi mdi-printer"></i> Cetak Kuitansi
        </button>
        <a href="{{ route('cetak.kuitansi_utj.wa', $booking->id) }}" target="_blank" class="btn-action-wa">
            <i class="mdi mdi-whatsapp"></i> Kirim ke WhatsApp
        </a>
    </div>
    @endif

    <div class="kuitansi-container">
        @if(!isset($pdf) || !$pdf)
        <!-- WATERMARK WEB -->
        <div class="watermark-bg">LUNAS - UTJ</div>
        @endif

        <div class="content-wrap">
            <!-- KOP SURAT RESMI PT. GRAHA CIPTA SEJAHTERA (3-COLUMN BALANCED TABLE) -->
            <table class="kop-table">
                <tr>
                    <td style="width: 15%; text-align: left; vertical-align: middle;">
                        <img src="{{ $logoBase64 }}" alt="Logo" style="height: 55px; max-width: 90px; display: block;">
                    </td>
                    <td style="width: 70%; text-align: center; vertical-align: middle;">
                        <div class="company-main-title">PT. GRAHA CIPTA SEJAHTERA</div>
                        <div class="company-sub-title">Developer &amp; General Contractor</div>
                        <div class="company-address">Kantor : Jl. Letjen Sutoyo No. 99 A Jember &nbsp;&nbsp; Telp. : 0331 - 331447, 0331 - 321533</div>
                    </td>
                    <td style="width: 15%;"></td>
                </tr>
            </table>

            <!-- TITLE & NO KUITANSI -->
            <div class="title-box">
                <div class="doc-title">Kuitansi Tanda Terima Pembayaran UTJ</div>
                <div class="doc-number">Nomor: {{ $kuitansiNumber }}</div>
                <div>
                    <span class="stamp-lunas">LUNAS / TERVERIFIKASI</span>
                </div>
            </div>

            <!-- DATA TRANSAKSI -->
            <table class="receipt-table">
                <tr>
                    <td class="col-label">Telah Diterima Dari</td>
                    <td class="col-colon">:</td>
                    <td class="col-value"><strong>{{ $booking->customer->full_name ?? ($booking->customer->name ?? '-') }}</strong></td>
                </tr>
                <tr>
                    <td class="col-label">No. Telepon / HP</td>
                    <td class="col-colon">:</td>
                    <td class="col-value">{{ $booking->customer->phone ?? '-' }}</td>
                </tr>
                <tr>
                    <td class="col-label">Alamat Customer</td>
                    <td class="col-colon">:</td>
                    <td class="col-value">{{ $booking->customer->address ?? '-' }}</td>
                </tr>
                <tr>
                    <td class="col-label">Tanggal Transaksi</td>
                    <td class="col-colon">:</td>
                    <td class="col-value">{{ \Carbon\Carbon::parse($booking->booking_date ?? now())->translatedFormat('d F Y') }}</td>
                </tr>
                <tr>
                    <td class="col-label">Metode Pembayaran</td>
                    <td class="col-colon">:</td>
                    <td class="col-value">
                        Transfer Bank (Uang Tanda Jadi)
                        @php
                            $ref = $utjPayment->reference_number ?? null;
                            $isImg = $ref && \Illuminate\Support\Str::contains($ref, ['.jpg', '.jpeg', '.png', '.pdf', 'payments/', 'booking_fee/']);
                        @endphp
                        @if($ref && !$isImg)
                            <small style="color: #64748b;">(Ref: {{ $ref }})</small>
                        @elseif($booking->booking_code)
                            <small style="color: #64748b;">(Kode: {{ $booking->booking_code }})</small>
                        @endif
                    </td>
                </tr>
            </table>

            <!-- BOX JUMLAH UANG & TERBILANG (PURE TABLE) -->
            <table class="amount-box-table">
                <tr>
                    <td style="width: 50%; font-size: 10pt; font-weight: bold; text-transform: uppercase; color: #004b93;">
                        Jumlah Uang Tanda Jadi (UTJ) :
                    </td>
                    <td style="width: 50%; font-size: 14pt; font-weight: bold; color: #004b93; text-align: right;">
                        Rp {{ number_format($nominalUtj, 0, ',', '.') }}
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="font-size: 9pt; font-style: italic; color: #003366; border-top: 1px solid #cce3f5; padding-top: 4px; padding-bottom: 6px;">
                        <strong>Terbilang:</strong> # {{ ucwords(trim($terbilang)) }} Rupiah #
                    </td>
                </tr>
            </table>

            <!-- DETAIL UNIT KAVLING -->
            <table class="unit-info-table">
                <thead>
                    <tr>
                        <th colspan="4">Rincian Unit Properti yang Dipesan / Dikunci</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="width: 25%; font-weight: bold; background-color: #f8fafc;">Nama Proyek</td>
                        <td style="width: 35%;">{{ $booking->unit->landBank->name ?? '-' }}</td>
                        <td style="width: 20%; font-weight: bold; background-color: #f8fafc;">Rencana Pembayaran</td>
                        <td style="width: 20%; font-weight: bold; color: #1e40af;">{{ strtoupper(str_replace('_', ' ', $booking->purchase_type ?? 'KPR')) }}</td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold; background-color: #f8fafc;">Blok &amp; Nomor Unit</td>
                        <td><strong>{{ $booking->unit->unit_name ?? ($booking->unit->block . '.' . $booking->unit->unit_number) }}</strong> (Kode: {{ $booking->unit->unit_code ?? '-' }})</td>
                        <td style="font-weight: bold; background-color: #f8fafc;">Harga Jual Unit</td>
                        <td>Rp {{ number_format($booking->unit->price ?? 0, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold; background-color: #f8fafc;">Jenis &amp; Tipe Unit</td>
                        <td>{{ ucfirst($booking->unit->jenis ?? $booking->unit->type ?? 'Komersil') }} (Tipe: {{ $booking->unit->type ?? '-' }})</td>
                        <td style="font-weight: bold; background-color: #f8fafc;">Luas Tanah / Bangunan</td>
                        <td>{{ $booking->unit->area ?? '-' }} m² / {{ $booking->unit->building_area ?? '-' }} m²</td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold; background-color: #f8fafc;">Sales / Agency</td>
                        <td>{{ $booking->sales->name ?? (auth()->user()->name ?? 'In-House Marketing') }}</td>
                        <td style="font-weight: bold; background-color: #f8fafc;">Status Booking</td>
                        <td><strong style="color: #059669;">Booking</strong></td>
                    </tr>
                </tbody>
            </table>

            <!-- KETENTUAN SINGKAT UTJ -->
            <table class="notes-table">
                <tr>
                    <td>
                        <div style="font-weight: bold; color: #1f2937; margin-bottom: 2px; text-transform: uppercase; font-size: 8pt;">Ketentuan &amp; Catatan Resmi Uang Tanda Jadi (UTJ):</div>
                        <ol style="margin-left: 14px; font-size: 7.8pt; line-height: 1.35; color: #4b5563; padding-left: 0;">
                            <li>Kuitansi ini merupakan bukti sah penerimaan Uang Tanda Jadi (UTJ) / Booking Fee pemesanan unit kavling.</li>
                            <li>Uang Tanda Jadi (UTJ) berfungsi sebagai tanda keseriusan pemesanan dan penguncian unit kavling agar tidak ditawarkan kepada pihak lain selama proses administrasi/pemberkasan berlangsung.</li>
                            <li>Nominal Uang Tanda Jadi (UTJ) tidak mengurangi total harga jual unit properti.</li>
                            <li>Pemberkasan dan kelengkapan dokumen persyaratan wajib diserahkan dalam jangka waktu sesuai ketentuan SOP Developer.</li>
                        </ol>
                    </td>
                </tr>
            </table>

            <!-- FOOTER ELEKTRONIK RESMI -->
            <div style="margin-top: 14px; text-align: center; font-size: 7.5pt; color: #64748b; border-top: 1px dashed #cbd5e1; padding-top: 6px; page-break-inside: avoid;">
                <p>Kuitansi ini sah dan diterbitkan secara resmi melalui Sistem Informasi Manajemen Properti PT. Graha Cipta Sejahtera</p>
                <p>Waktu Cetak Dokumen: {{ date('d/m/Y H:i:s') }} WIB &bull; Kode Booking: {{ $booking->booking_code ?? '-' }}</p>
            </div>
        </div>
    </div>

</body>
</html>
