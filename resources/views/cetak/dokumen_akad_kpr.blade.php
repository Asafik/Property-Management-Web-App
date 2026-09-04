<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Berita Acara & Perjanjian Akad KPR - {{ $booking->booking_code ?? 'AKAD-KPR' }}</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    
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
            background: linear-gradient(135deg, #8b5cf6, #6366f1);
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
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.4);
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

        /* Printable Sheet Container */
        .print-container {
            width: 210mm;
            min-height: 297mm;
            padding: 16mm 20mm 20mm 20mm;
            margin: 50px auto 30px auto;
            background: #ffffff;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            position: relative;
        }

        /* Header Kop Surat */
        .header-kop {
            text-align: center;
            border-bottom: 2.5px solid #111827;
            padding-bottom: 12px;
            margin-bottom: 16px;
            position: relative;
        }

        .header-kop .company-name {
            font-size: 15pt;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            color: #0f172a;
        }

        .header-kop .company-address {
            font-size: 9.5pt;
            color: #334155;
            margin-top: 3px;
            font-family: 'Times New Roman', Times, serif;
        }

        .header-kop .company-contact {
            font-size: 9pt;
            color: #475569;
            margin-top: 2px;
        }

        .double-line {
            border-top: 1px solid #111827;
            margin-top: 2px;
        }

        /* Document Title */
        .doc-title-block {
            text-align: center;
            margin-bottom: 18px;
        }

        .doc-title {
            font-size: 13pt;
            font-weight: bold;
            text-decoration: underline;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #000000;
        }

        .doc-number {
            font-size: 10pt;
            font-weight: 600;
            color: #1e293b;
            margin-top: 3px;
        }

        /* Content Paragraphs */
        .content-section {
            margin-bottom: 12px;
            font-size: 10.5pt;
            text-align: justify;
        }

        /* Form Details Table */
        .table-data {
            width: 100%;
            border-collapse: collapse;
            margin: 8px 0 14px 0;
            font-size: 10.5pt;
        }

        .table-data td {
            padding: 3px 4px;
            vertical-align: top;
        }

        .table-data td.field-num {
            width: 20px;
            font-weight: bold;
        }

        .table-data td.field-name {
            width: 180px;
            color: #1e293b;
        }

        .table-data td.field-colon {
            width: 15px;
            text-align: center;
        }

        .table-data td.field-value {
            font-weight: 600;
            color: #000000;
        }

        /* Section Header in Body */
        .section-subtitle {
            font-weight: bold;
            text-transform: uppercase;
            font-size: 10.5pt;
            color: #0f172a;
            margin: 12px 0 4px 0;
            border-bottom: 1px solid #cbd5e1;
            padding-bottom: 2px;
        }

        /* Summary Box / Highlight */
        .box-highlight {
            border: 1.5px solid #000000;
            background-color: #f8fafc;
            padding: 10px 14px;
            margin: 10px 0 14px 0;
            border-radius: 4px;
            font-size: 10pt;
        }

        .box-highlight-title {
            font-weight: bold;
            font-size: 10.5pt;
            margin-bottom: 4px;
            text-transform: uppercase;
        }

        /* Signatures Grid */
        .signature-section {
            margin-top: 25px;
            page-break-inside: avoid;
        }

        .signature-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 10px;
            text-align: center;
        }

        .signature-box {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            min-height: 110px;
        }

        .signature-title {
            font-size: 9.5pt;
            font-weight: bold;
            color: #1e293b;
            line-height: 1.25;
        }

        .signature-name {
            font-size: 9.5pt;
            font-weight: bold;
            text-decoration: underline;
            color: #000000;
        }

        .signature-role {
            font-size: 8.5pt;
            color: #475569;
        }

        /* Print Media Styles */
        @media print {
            body {
                background: #ffffff !important;
                padding: 0 !important;
                font-size: 10.5pt;
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
                size: A4 portrait;
                margin: 15mm 15mm 15mm 15mm;
            }
        }
    </style>
</head>
<body>

    <!-- Floating Top Bar for Screen Preview -->
    <div class="no-print-bar">
        <button onclick="window.print()" class="btn-action-print">
            <i class="mdi mdi-printer"></i>
            <span>Cetak Dokumen Akad</span>
        </button>
        <button onclick="window.close()" class="btn-action-close">
            <i class="mdi mdi-close"></i>
            <span>Tutup</span>
        </button>
    </div>

    @php
        $akadDate = optional($existingAkad)->tanggal_akad 
            ? \Carbon\Carbon::parse($existingAkad->tanggal_akad) 
            : \Carbon\Carbon::now();
        $hariIndo = ['Sunday' => 'Minggu', 'Monday' => 'Senin', 'Tuesday' => 'Selasa', 'Wednesday' => 'Rabu', 'Thursday' => 'Kamis', 'Friday' => 'Jumat', 'Saturday' => 'Sabtu'];
        $namaHari = $hariIndo[$akadDate->format('l')] ?? 'Senin';
    @endphp

    <div class="print-container">
        
        <!-- Header Kop Surat -->
        <div class="header-kop">
            <div class="company-name">{{ $companyProfile->company_name ?? 'PROPERTY MANAGEMENT & DEVELOPMENT' }}</div>
            <div class="company-address">{{ $companyProfile->address ?? 'Jl. Raya Utama Properti No. 88, Kawasan Mandiri Terpadu' }}</div>
            <div class="company-contact">Telp: {{ $companyProfile->phone ?? '(021) 7890-1234' }} | Email: {{ $companyProfile->email ?? 'legal@propertymanagement.co.id' }} | Website: www.propertymanagement.co.id</div>
            <div class="double-line"></div>
        </div>

        <!-- Document Title -->
        <div class="doc-title-block">
            <div class="doc-title">BERITA ACARA & PERJANJIAN AKAD KREDIT PEMILIKAN RUMAH (KPR)</div>
            <div class="doc-number">Nomor: {{ $noAkad ?? ('AKAD/KPR/' . date('Ym') . '/' . str_pad($booking->id ?? 1, 4, '0', STR_PAD_LEFT)) }}</div>
        </div>

        <div class="content-section">
            Pada hari ini, <strong>{{ $namaHari }}</strong> tanggal <strong>{{ $akadDate->translatedFormat('d') }}</strong> bulan <strong>{{ $akadDate->translatedFormat('F') }}</strong> tahun <strong>{{ $akadDate->translatedFormat('Y') }}</strong> ({{ $akadDate->translatedFormat('d F Y') }}), bertempat di <strong>{{ optional($existingAkad)->lokasi_akad ?? 'Kantor Notaris / Kantor Bank Pelaksana' }}</strong>, telah diadakan proses penandatanganan Akad Kredit Pemilikan Rumah (KPR) dan Pengikatan Jual Beli antara pihak-pihak sebagai berikut:
        </div>

        <!-- PIHAK I -->
        <div class="section-subtitle">I. PIHAK KONSUMEN / DEBITUR</div>
        <table class="table-data">
            <tr>
                <td class="field-name">Nama Lengkap Debitur</td>
                <td class="field-colon">:</td>
                <td class="field-value">{{ $booking->customer->full_name ?? '-' }}</td>
            </tr>
            <tr>
                <td class="field-name">Nomor KTP / NIK</td>
                <td class="field-colon">:</td>
                <td class="field-value">{{ $booking->customer->nik ?? $booking->customer->no_ktp ?? '-' }}</td>
            </tr>
            <tr>
                <td class="field-name">No. Telepon / WhatsApp</td>
                <td class="field-colon">:</td>
                <td class="field-value">{{ $booking->customer->phone ?? '-' }}</td>
            </tr>
            <tr>
                <td class="field-name">Alamat Domisili</td>
                <td class="field-colon">:</td>
                <td class="field-value">{{ $booking->customer->address ?? 'Sesuai Data KTP Terlampir' }}</td>
            </tr>
            <tr>
                <td class="field-name">Pekerjaan / Instansi</td>
                <td class="field-colon">:</td>
                <td class="field-value">{{ $booking->customer->job ?? $booking->customer->pekerjaan ?? 'Karyawan Swasta / Wiraswasta' }}</td>
            </tr>
        </table>

        <!-- PIHAK II -->
        <div class="section-subtitle">II. PIHAK PENGEMBANG / DEVELOPER</div>
        <table class="table-data">
            <tr>
                <td class="field-name">Nama Perusahaan</td>
                <td class="field-colon">:</td>
                <td class="field-value">{{ $companyProfile->company_name ?? 'PT. PROPERTI MANAGEMENT DEVELOPER' }}</td>
            </tr>
            <tr>
                <td class="field-name">Nama Perumahan / Proyek</td>
                <td class="field-colon">:</td>
                <td class="field-value">{{ $booking->unit->landBank->project_name ?? ($booking->unit->landBank->nama_land_bank ?? 'Grand Horizon Residence') }}</td>
            </tr>
            <tr>
                <td class="field-name">Diwakili Oleh</td>
                <td class="field-colon">:</td>
                <td class="field-value">{{ auth()->user()->name ?? ($booking->sales->name ?? 'Direktur / Kuasa Manajemen') }}</td>
            </tr>
        </table>

        <!-- OBJEK UNIT & FASILITAS KPR -->
        <div class="section-subtitle">III. DATA OBJEK UNIT PROPERTI & FASILITAS KPR</div>
        <table class="table-data">
            <tr>
                <td class="field-name">Tipe Unit / Blok & No</td>
                <td class="field-colon">:</td>
                <td class="field-value">Tipe {{ $booking->unit->type ?? '-' }} / Blok {{ $booking->unit->unit_code ?? '-' }} (Skema: {{ strtoupper($booking->unit->jenis ?? 'KPR') }})</td>
            </tr>
            <tr>
                <td class="field-name">Harga Jual Properti</td>
                <td class="field-colon">:</td>
                <td class="field-value">Rp {{ number_format($booking->unit->price ?? 0, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td class="field-name">Bank Rekanan Pelaksana</td>
                <td class="field-colon">:</td>
                <td class="field-value">{{ $kpr->bank->bank_name ?? 'Bank Tabungan Negara (BTN)' }}</td>
            </tr>
            <tr>
                <td class="field-name">Plafon Kredit (KPR) Disetujui</td>
                <td class="field-colon">:</td>
                <td class="field-value">Rp {{ number_format($kpr->jumlah_pinjaman ?? ($booking->unit->price ?? 0), 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td class="field-name">Jangka Waktu (Tenor) / Angsuran</td>
                <td class="field-colon">:</td>
                <td class="field-value">{{ $kpr->tenor ?? '15' }} Tahun / Estimasi Rp {{ number_format($kpr->estimasi_angsuran ?? 0, 0, ',', '.') }} per bulan</td>
            </tr>
            <tr>
                <td class="field-name">Notaris / PPAT Pembuat Akta</td>
                <td class="field-colon">:</td>
                <td class="field-value">{{ optional($existingAkad)->nama_notaris ?? 'Siti Nurhaliza, SH., M.Kn.' }}</td>
            </tr>
        </table>

        <!-- PERNYATAAN & KESEPAKATAN -->
        <div class="box-highlight">
            <div class="box-highlight-title">KLAUSUL & KESEPAKATAN AKAD KREDIT:</div>
            <ol style="margin-left: 18px; line-height: 1.4;">
                <li>Para Pihak telah memeriksa dan menyetujui seluruh kelengkapan dokumen persyaratan legalitas KPR dan Surat Penegasan Persetujuan Penyediaan Kredit (SP3K) dari Bank.</li>
                <li>Pihak Debitur menyetujui pemotongan rekening dan kewajiban angsuran bulanan sesuai tata tertib perjanjian kredit dengan pihak Bank.</li>
                <li>Pihak Developer berkewajiban menyelesaikan unit dan menyerahterimakan kunci fisik (BAST) sesuai spesifikasi yang telah disepakati.</li>
                <li>Segala pengurusan Akta Jual Beli (AJB), Balik Nama Sertifikat, dan APHT diproses secara sah melalui Notaris/PPAT yang ditunjuk.</li>
            </ol>
        </div>

        <div class="content-section" style="margin-top: 10px;">
            Demikian Berita Acara & Perjanjian Akad KPR ini dibuat dan ditandatangani dalam rangkap yang cukup, mempunyai kekuatan hukum yang sama, dan mengikat bagi masing-masing pihak.
        </div>

        <!-- TANDA TANGAN 4 PIHAK -->
        <div class="signature-section">
            <div class="signature-grid">
                <!-- Pihak 1 -->
                <div class="signature-box">
                    <div class="signature-title">PIHAK I<br>Debitur / Konsumen</div>
                    <div style="height: 50px;"></div>
                    <div>
                        <div class="signature-name">{{ $booking->customer->full_name ?? 'Debitur' }}</div>
                        <div class="signature-role">Konsumen KPR</div>
                    </div>
                </div>

                <!-- Pihak 2 -->
                <div class="signature-box">
                    <div class="signature-title">PIHAK II<br>Pengembang / Developer</div>
                    <div style="height: 50px;"></div>
                    <div>
                        <div class="signature-name">{{ auth()->user()->name ?? 'Manajemen Developer' }}</div>
                        <div class="signature-role">{{ auth()->user()->role ?? 'Kuasa Developer' }}</div>
                    </div>
                </div>

                <!-- Pihak 3 -->
                <div class="signature-box">
                    <div class="signature-title">PIHAK III<br>Notaris / PPAT</div>
                    <div style="height: 50px;"></div>
                    <div>
                        <div class="signature-name">{{ optional($existingAkad)->nama_notaris ?? 'Siti Nurhaliza, SH' }}</div>
                        <div class="signature-role">Notaris / PPAT</div>
                    </div>
                </div>

                <!-- Pihak 4 -->
                <div class="signature-box">
                    <div class="signature-title">PIHAK IV<br>Bank Pelaksana</div>
                    <div style="height: 50px;"></div>
                    <div>
                        <div class="signature-name">{{ $kpr->bank->bank_name ?? 'Pimpinan Cabang Bank' }}</div>
                        <div class="signature-role">Consumer Loan Officer</div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</body>
</html>
