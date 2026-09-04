<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Berita Acara Verifikasi KPR - {{ $booking->booking_code ?? 'BA-KPR' }}</title>
    
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

        /* Watermark */
        .watermark-bg {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-30deg);
            font-size: 68pt;
            font-weight: bold;
            color: rgba(139, 92, 246, 0.04);
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

        /* KOP SURAT */
        .kop-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-bottom: 12px;
            border-bottom: 3px double #1e293b;
            margin-bottom: 16px;
        }

        .kop-logo-area {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .kop-logo-icon {
            width: 52px;
            height: 52px;
            background: linear-gradient(135deg, #8b5cf6, #6366f1);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 28px;
        }

        .kop-company-title {
            font-size: 14pt;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #0f172a;
        }

        .kop-company-sub {
            font-size: 9.5pt;
            color: #475569;
            margin-top: 2px;
        }

        .kop-company-meta {
            text-align: right;
            font-size: 8.5pt;
            color: #64748b;
            line-height: 1.35;
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

        /* SECTION STYLING */
        .doc-section-title {
            font-size: 10.5pt;
            font-weight: bold;
            text-transform: uppercase;
            background: #f1f5f9;
            padding: 4px 8px;
            border-left: 4px solid #6366f1;
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
            padding: 3px 6px;
            vertical-align: top;
        }

        .table-data td.td-label {
            width: 28%;
            color: #334155;
            font-weight: 600;
        }

        .table-data td.td-colon {
            width: 2%;
            text-align: center;
        }

        .table-data td.td-value {
            width: 70%;
            color: #0f172a;
        }

        /* CHECKLIST TABLE */
        .table-checklist {
            width: 100%;
            border-collapse: collapse;
            font-size: 9.5pt;
            margin: 8px 0 14px 0;
        }

        .table-checklist th,
        .table-checklist td {
            border: 1px solid #94a3b8;
            padding: 5px 8px;
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

        .status-badge-doc {
            font-weight: bold;
            display: inline-block;
            padding: 1px 6px;
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

        /* RESULT BOX */
        .decision-box {
            border: 1.5px solid #6366f1;
            background: #faf5ff;
            border-radius: 6px;
            padding: 10px 14px;
            margin: 12px 0;
        }

        .decision-title {
            font-weight: bold;
            font-size: 10.5pt;
            color: #4338ca;
            margin-bottom: 4px;
        }

        .decision-desc {
            font-size: 9.5pt;
            color: #1e1b4b;
        }

        /* SIGNATURE SECTION */
        .signature-grid {
            width: 100%;
            margin-top: 28px;
            border-collapse: collapse;
        }

        .signature-grid td {
            width: 50%;
            text-align: center;
            vertical-align: top;
            font-size: 10pt;
            padding: 0 30px;
        }

        .sig-role {
            font-weight: 600;
            color: #334155;
            margin-bottom: 65px;
        }

        .sig-name {
            font-weight: bold;
            text-decoration: underline;
            color: #0f172a;
        }

        .sig-title {
            font-size: 8.5pt;
            color: #64748b;
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

            @page {
                size: A4 portrait;
                margin: 12mm 15mm 12mm 15mm;
            }
        }
    </style>
</head>
<body>

    <!-- Floating Top Action Bar -->
    <div class="no-print-bar">
        <button type="button" class="btn-action-print" onclick="window.print()">
            <i class="mdi mdi-printer"></i>
            <span>Cetak / Simpan PDF</span>
        </button>
        <a href="{{ route('transaksi.kpr.approve', $booking->id) }}" class="btn-action-close">
            <i class="mdi mdi-arrow-left"></i>
            <span>Kembali</span>
        </a>
    </div>

    <!-- Printable Paper Sheet -->
    <div class="print-container">
        <div class="watermark-bg">VERIFIKASI KPR</div>

        <div class="content-wrap">
            <!-- KOP SURAT -->
            <div class="kop-header">
                <div class="kop-logo-area">
                    <div>
                        <div class="kop-company-title">{{ $companyProfile->name ?? 'PT PROPERTY MANAGEMENT INDONESIA' }}</div>
                        <div class="kop-company-sub">Divisi Legal & Layanan Transaksi Kredit Pemilikan Rumah (KPR)</div>
                    </div>
                </div>
                <div class="kop-company-meta">
                    <div>{{ $companyProfile->address ?? 'Jl. Properti Raya No. 88, Jawa Barat' }}</div>
                    <div>Telp: {{ $companyProfile->phone ?? '(021) 8899-7766' }}</div>
                    <div>Website: www.propertymanagement.co.id</div>
                </div>
            </div>

            <!-- TITLE -->
            <div class="doc-title-block">
                <div class="doc-main-title">BERITA ACARA VERIFIKASI BERKAS & KELAYAKAN KPR</div>
                @php
                    $romawi = [1 => 'I', 2 => 'II', 3 => 'III', 4 => 'IV', 5 => 'V', 6 => 'VI', 7 => 'VII', 8 => 'VIII', 9 => 'IX', 10 => 'X', 11 => 'XI', 12 => 'XII'];
                    $bulanSekarang = $romawi[date('n')] ?? 'IX';
                    $tahunSekarang = date('Y');
                    $noBA = "BA-KPR/{$tahunSekarang}/{$bulanSekarang}/" . str_pad($booking->id, 4, '0', STR_PAD_LEFT);
                @endphp
                <div class="doc-number">Nomor: {{ $noBA }}</div>
            </div>

            <p style="margin-bottom: 10px; font-size: 10pt; text-align: justify;">
                Pada hari ini, <strong>{{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}</strong>, telah dilakukan pemeriksaan dan verifikasi berkas persyaratan permohonan Kredit Pemilikan Rumah (KPR) oleh Tim Verifikator terhadap calon debitur / konsumen dengan data sebagai berikut:
            </p>

            <!-- 1. DATA KONSUMEN & PROPERTI -->
            <div class="doc-section-title">I. IDENTITAS KONSUMEN & UNIT PROPERTI</div>
            <table class="table-data">
                <tr>
                    <td class="td-label">Nama Lengkap Konsumen</td>
                    <td class="td-colon">:</td>
                    <td class="td-value"><strong>{{ strtoupper($booking->customer->full_name ?? '-') }}</strong></td>
                </tr>
                <tr>
                    <td class="td-label">No. KTP / NIK</td>
                    <td class="td-colon">:</td>
                    <td class="td-value">{{ $booking->customer->nik ?? $booking->customer->no_ktp ?? '-' }}</td>
                </tr>
                <tr>
                    <td class="td-label">No. Telepon / WhatsApp</td>
                    <td class="td-colon">:</td>
                    <td class="td-value">{{ $booking->customer->phone ?? $booking->customer->no_hp ?? '-' }}</td>
                </tr>
                <tr>
                    <td class="td-label">ID Booking / Referensi</td>
                    <td class="td-colon">:</td>
                    <td class="td-value"><code>{{ $booking->booking_code ?? '-' }}</code></td>
                </tr>
                <tr>
                    <td class="td-label">Proyek & Unit Kavling</td>
                    <td class="td-colon">:</td>
                    <td class="td-value">{{ $booking->unit->landBank->nama_tanah ?? 'Proyek Perumahan' }} &mdash; Blok {{ $booking->unit->unit_code ?? '-' }} ({{ $booking->unit->unit_name ?? '-' }})</td>
                </tr>
                <tr>
                    <td class="td-label">Skema & Harga Unit</td>
                    <td class="td-colon">:</td>
                    <td class="td-value">
                        <strong>{{ strtoupper($booking->unit->jenis ?? 'KPR') }}</strong> &mdash; 
                        Rp {{ number_format($booking->unit->price ?? 0, 0, ',', '.') }}
                    </td>
                </tr>
            </table>

            <!-- 2. DATA PENGAJUAN KPR -->
            <div class="doc-section-title">II. DETAIL PENGAJUAN KREDIT PEMILIKAN RUMAH (KPR)</div>
            <table class="table-data">
                <tr>
                    <td class="td-label">Bank Penyalur Tujuan</td>
                    <td class="td-colon">:</td>
                    <td class="td-value"><strong>{{ $booking->kprApplication->bank->bank_name ?? 'Bank Rekanan' }}</strong></td>
                </tr>
                <tr>
                    <td class="td-label">Plafon Pinjaman yang Diajukan</td>
                    <td class="td-colon">:</td>
                    <td class="td-value">Rp {{ number_format($booking->kprApplication->jumlah_pinjaman ?? 0, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td class="td-label">Jangka Waktu (Tenor)</td>
                    <td class="td-colon">:</td>
                    <td class="td-value">{{ $booking->kprApplication->tenor ?? '-' }} Tahun</td>
                </tr>
                <tr>
                    <td class="td-label">Estimasi Angsuran / Bulan</td>
                    <td class="td-colon">:</td>
                    <td class="td-value">Rp {{ number_format($booking->kprApplication->estimasi_angsuran ?? 0, 0, ',', '.') }} / bulan</td>
                </tr>
                <tr>
                    <td class="td-label">Staff Marketing Pendamping</td>
                    <td class="td-colon">:</td>
                    <td class="td-value">{{ $booking->sales->name ?? '-' }}</td>
                </tr>
            </table>

            <!-- 3. HASIL PEMERIKSAAN DOKUMEN -->
            <div class="doc-section-title">III. TABEL HASIL PEMERIKSAAN KELENGKAPAN BERKAS</div>
            @php
                $documentList = [
                    'ktp'             => 'KTP Pemohon',
                    'kk'              => 'Kartu Keluarga (KK)',
                    'npwp'            => 'NPWP Pemohon',
                    'slip_gaji'       => 'Slip Gaji / Surat Keterangan Penghasilan',
                    'rekening_koran'  => 'Rekening Koran (3 Bulan Terakhir)',
                    'surat_nikah'     => 'Buku Nikah / Surat Pernyataan Belum Menikah',
                    'sku'             => 'Surat Keterangan Usaha (SKU) / Legalitas',
                    'ktp_pasangan'    => 'KTP Pasangan (Bila Menikah)',
                ];
                $docs = $booking->kprApplication->documents ?? [];
            @endphp

            <table class="table-checklist">
                <thead>
                    <tr>
                        <th style="width: 8%;">No</th>
                        <th style="width: 62%;">Nama Dokumen Persyaratan</th>
                        <th style="width: 30%;">Status Pemeriksaan</th>
                    </tr>
                </thead>
                <tbody>
                    @php $no = 1; @endphp
                    @foreach ($documentList as $type => $label)
                        @php
                            $docItem = collect($docs)->firstWhere('type', $type);
                            $isValid = !empty($docItem);
                        @endphp
                        <tr>
                            <td class="text-center">{{ $no++ }}</td>
                            <td>{{ $label }}</td>
                            <td class="text-center">
                                @if($isValid)
                                    <span class="status-badge-doc valid">Valid</span>
                                @else
                                    <span class="status-badge-doc missing">Belum Valid</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- 4. KESIMPULAN & REKOMENDASI -->
            <div class="doc-section-title">IV. KESIMPULAN & REKOMENDASI VERIFIKATOR</div>
            <div class="decision-box">
                <div class="decision-title">
                    KEPUTUSAN: <u>MEMENUHI SYARAT & DISETUJUI</u>
                </div>
                <div class="decision-desc">
                    Berdasarkan hasil verifikasi keabsahan data, kelengkapan berkas administratif, dan profil keuangan calon debitur, pengajuan KPR atas nama <strong>{{ $booking->customer->full_name ?? '-' }}</strong> dinyatakan <strong>MEMENUHI PERSYARATAN</strong> untuk diteruskan ke proses <strong>Survey & Appraisal Bank</strong>.
                    @if(!empty($booking->kprApplication->catatan))
                        <div style="margin-top: 6px; font-style: italic; color: #334155;">
                            <strong>Catatan Verifikator:</strong> "{{ $booking->kprApplication->catatan }}"
                        </div>
                    @endif
                </div>
            </div>

            <!-- 5. LEMBAR TANDA TANGAN (2 PIHAK) -->
            @php
                $verifierName = auth()->user()->name ?? 'Tim Legal & Verifikasi';
                $verifierRole = auth()->user()->position->name ?? (auth()->user()->role ?? 'Staff Legal / Verifikator KPR');
            @endphp

            <table class="signature-grid">
                <tr>
                    <td>
                        <div class="sig-role">Pemohon / Calon Debitur,</div>
                        <div class="sig-name">{{ $booking->customer->full_name ?? '(...........................................)' }}</div>
                        <div class="sig-title">Konsumen Pembeli</div>
                    </td>
                    <td>
                        <div class="sig-role">Diverifikasi & Disetujui Oleh,</div>
                        <div class="sig-name">{{ $verifierName }}</div>
                        <div class="sig-title">{{ $verifierRole }}</div>
                    </td>
                </tr>
            </table>

        </div>
    </div>

</body>
</html>
