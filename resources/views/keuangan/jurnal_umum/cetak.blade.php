<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Buku Jurnal Umum - PT. Graha Cipta Sejahtera</title>
    
    <!-- Google Fonts untuk Kop Surat & Dokumen Resmi -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@800;900&family=Plus+Jakarta+Sans:wght@500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font@7.2.96/css/materialdesignicons.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Plus Jakarta Sans', Arial, Helvetica, sans-serif;
            background-color: #f1f5f9;
            color: #0f172a;
            font-size: 10.5px;
            line-height: 1.35;
            padding: 20px;
        }

        /* Screen Wrapper (Optimal for A4 / F4 Landscape) */
        .print-container {
            max-width: 320mm; /* A4 / F4 Landscape Width */
            margin: 0 auto;
            background: #ffffff;
            padding: 22px 28px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            border-radius: 6px;
        }

        /* Screen Action Bar (Toolbar) */
        .action-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 18px;
            padding-bottom: 12px;
            border-bottom: 1px solid #e2e8f0;
        }
        .action-bar-left {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .btn-action {
            padding: 7px 16px;
            border-radius: 6px;
            font-weight: 700;
            font-size: 11px;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: all 0.15s ease;
        }
        .btn-back {
            background: #ffffff;
            color: #475569;
            border: 1px solid #cbd5e1;
        }
        .btn-back:hover {
            background: #f8fafc;
            color: #0f172a;
        }
        .btn-print {
            background: #9a55ff;
            color: #ffffff;
            border: 1px solid #9a55ff;
        }
        .btn-print:hover {
            background: #8435f5;
            border-color: #8435f5;
        }
        .paper-tag {
            font-size: 11px;
            color: #64748b;
            background: #f1f5f9;
            padding: 5px 12px;
            border-radius: 4px;
            border: 1px solid #e2e8f0;
            font-weight: 600;
        }

        /* ===== KOP SURAT RESMI PT. GRAHA CIPTA SEJAHTERA ===== */
        .document-header {
            margin-bottom: 14px;
            border-bottom: 3.5px double #004b93;
            padding-bottom: 10px;
            position: relative;
        }
        .document-header-inner {
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            min-height: 70px;
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
            height: 65px;
            max-width: 120px;
            object-fit: contain;
        }
        .document-header-text {
            text-align: center;
            width: 100%;
            padding: 0 70px;
        }
        .company-main-title {
            color: #004b93 !important;
            font-size: 22px !important;
            font-weight: 900 !important;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            margin: 0 0 2px 0;
            font-family: 'Montserrat', 'Arial Black', sans-serif !important;
            text-align: center;
        }
        .company-sub-title {
            color: #002d62 !important;
            font-size: 13.5px !important;
            font-weight: 800 !important;
            letter-spacing: 0.3px;
            margin: 0 0 3px 0;
            font-family: 'Plus Jakarta Sans', Arial, sans-serif !important;
            text-align: center;
        }
        .company-address {
            color: #1e293b !important;
            margin: 0;
            font-size: 10.5px !important;
            font-weight: 500;
            line-height: 1.35;
            text-align: center;
        }

        /* ===== JUDUL LAPORAN ===== */
        .report-title-box {
            text-align: center;
            margin-bottom: 14px;
        }
        .report-title {
            font-size: 14px;
            font-weight: 800;
            text-transform: uppercase;
            color: #0f172a;
            letter-spacing: 0.5px;
            margin-bottom: 3px;
        }
        .report-meta-text {
            font-size: 10px;
            color: #475569;
        }

        /* ===== META INFO BAR ===== */
        .meta-info-card {
            width: 100%;
            background: #f8fafc;
            border: 1px solid #cbd5e1;
            border-radius: 4px;
            padding: 6px 12px;
            margin-bottom: 14px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 9.5px;
        }
        .meta-item {
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .meta-label {
            font-weight: 600;
            color: #64748b;
        }
        .meta-val {
            font-weight: 700;
            color: #0f172a;
        }
        .balance-badge-ok {
            background: #dcfce7;
            color: #166534;
            padding: 2px 8px;
            border-radius: 3px;
            font-weight: 800;
            border: 1px solid #86efac;
        }
        .balance-badge-diff {
            background: #fee2e2;
            color: #991b1b;
            padding: 2px 8px;
            border-radius: 3px;
            font-weight: 800;
            border: 1px solid #fca5a5;
        }

        /* ===== TABEL JURNAL UMUM ===== */
        .data-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 9.5px;
            margin-bottom: 16px;
        }
        .data-table th, 
        .data-table td {
            border: 1px solid #94a3b8;
            padding: 5px 7px;
            vertical-align: middle;
        }
        .data-table th {
            background-color: #f1f5f9;
            font-size: 9.5px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.3px;
            color: #1e293b;
            text-align: center;
        }
        .account-code {
            font-family: Consolas, 'Courier New', monospace;
            font-weight: 700;
            color: #475569;
        }
        .credit-indent {
            padding-left: 20px !important;
            color: #475569;
            font-style: italic;
        }
        .total-row {
            font-weight: 800;
            font-size: 10.5px;
            background-color: #f1f5f9 !important;
            color: #0f172a;
            border-top: 2px solid #334155 !important;
            border-bottom: 2.5px double #334155 !important;
        }

        .text-right { text-align: right !important; }
        .text-center { text-align: center !important; }
        .fw-bold { font-weight: 700 !important; }

        /* ===== TANDA TANGAN (SIGNATURES) ===== */
        .signature-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            page-break-inside: avoid;
        }
        .signature-table td {
            border: none;
            text-align: center;
            vertical-align: top;
            font-size: 9.5px;
            width: 33.33%;
            padding: 0 15px;
        }
        .sign-title {
            font-weight: 600;
            color: #475569;
            margin-bottom: 50px;
        }
        .sign-name {
            font-weight: 800;
            color: #0f172a;
            border-top: 1px solid #1e293b;
            padding-top: 3px;
            display: inline-block;
            min-width: 170px;
        }
        .sign-role {
            font-size: 9px;
            color: #64748b;
            margin-top: 2px;
        }

        /* ===== PRINT STYLING (A4 / F4 LANDSCAPE) ===== */
        @page {
            size: landscape;
            margin: 8mm 10mm;
        }

        @media print {
            body {
                background: #ffffff !important;
                padding: 0 !important;
                font-size: 9px;
                color: #000000 !important;
            }
            .no-print {
                display: none !important;
            }
            .print-container {
                max-width: 100% !important;
                box-shadow: none !important;
                border-radius: 0 !important;
                padding: 0 !important;
                margin: 0 !important;
            }
            .data-table th, .total-row, .meta-info-card {
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }
        }
    </style>
</head>
<body>

    <div class="print-container">
        <!-- Toolbar Layar (No Print) -->
        <div class="action-bar no-print">
            <div class="action-bar-left">
                <button onclick="window.close(); if(!window.closed){ history.back(); }" class="btn-action btn-back">
                    <i class="mdi mdi-arrow-left"></i> Tutup / Kembali
                </button>
                <span class="paper-tag">
                    <i class="mdi mdi-file-document-outline me-1"></i> Format: <strong>A4 / F4 Landscape</strong>
                </span>
            </div>
            <button onclick="window.print()" class="btn-action btn-print">
                <i class="mdi mdi-printer"></i> Cetak / Simpan PDF
            </button>
        </div>

        <!-- KOP SURAT RESMI PT. GRAHA CIPTA SEJAHTERA -->
        <div class="document-header">
            <div class="document-header-inner">
                <div class="header-logo-left">
                    <img src="{{ asset('images/logo1.png') }}" alt="Logo PT. Graha Cipta Sejahtera" class="document-header-logo">
                </div>
                <div class="document-header-text">
                    <h2 class="company-main-title">PT. GRAHA CIPTA SEJAHTERA</h2>
                    <div class="company-sub-title">Developer &amp; General Contractor</div>
                    <p class="company-address">Kantor : Jl. Letjen Sutoyo No. 99 A Jember &nbsp;&bull;&nbsp; Telp. : 0331 - 331447, 0331 - 321533</p>
                </div>
            </div>
        </div>

        <!-- Judul Laporan -->
        <div class="report-title-box">
            <h3 class="report-title">LAPORAN BUKU JURNAL UMUM (GENERAL JOURNAL)</h3>
            <p class="report-meta-text">
                Properti: <strong>{{ $selectedProject ? $selectedProject->nama_land_bank : 'Semua Proyek & Kantor Pusat' }}</strong> &nbsp;&bull;&nbsp;
                Periode: <strong>{{ $startDate ? date('d/m/Y', strtotime($startDate)) : 'Awal' }} s/d {{ $endDate ? date('d/m/Y', strtotime($endDate)) : date('d/m/Y') }}</strong>
            </p>
        </div>

        <!-- Meta Info Bar -->
        <div class="meta-info-card">
            <div class="meta-item">
                <span class="meta-label">Tanggal Cetak:</span>
                <span class="meta-val">{{ date('d F Y - H:i') }} WIB</span>
            </div>
            <div class="meta-item">
                <span class="meta-label">Total Transaksi:</span>
                <span class="meta-val">{{ number_format($entries->count()) }} Transaksi</span>
            </div>
            <div class="meta-item">
                <span class="meta-label">Status Keseimbangan:</span>
                @if(abs($totalDebit - $totalCredit) < 1)
                    <span class="balance-badge-ok">SEIMBANG (BALANCED)</span>
                @else
                    <span class="balance-badge-diff">SELISIH Rp {{ number_format(abs($totalDebit - $totalCredit), 0, ',', '.') }}</span>
                @endif
            </div>
            <div class="meta-item">
                <span class="meta-label">Dicetak Oleh:</span>
                <span class="meta-val">{{ auth()->user()->name ?? 'Administrator Keuangan' }}</span>
            </div>
        </div>

        <!-- Tabel Data Jurnal Umum -->
        <table class="data-table">
            <thead>
                <tr>
                    <th style="width: 4%;">NO</th>
                    <th style="width: 14%;">NO. VOUCHER</th>
                    <th style="width: 10%;">TANGGAL</th>
                    <th style="width: 10%;">KODE AKUN</th>
                    <th>NAMA AKUN &amp; URAIAN TRANSAKSI</th>
                    <th style="width: 14%;" class="text-right">DEBIT (RP)</th>
                    <th style="width: 14%;" class="text-right">KREDIT (RP)</th>
                </tr>
            </thead>
            <tbody>
                @php $no = 1; @endphp
                @forelse($entries as $entry)
                    @php
                        $debit = $entry->items->where('type', 'debit')->first();
                        $credit = $entry->items->where('type', 'credit')->first();
                    @endphp
                    {{-- Baris Debit --}}
                    <tr>
                        <td class="text-center" rowspan="2">{{ $no++ }}</td>
                        <td class="text-center fw-bold" rowspan="2" style="font-family: Consolas, monospace; color: #1e293b;">
                            {{ $entry->entry_number }}
                        </td>
                        <td class="text-center" rowspan="2">{{ $entry->entry_date->format('d/m/Y') }}</td>
                        <td class="text-center account-code">{{ $debit?->account?->code ?? '-' }}</td>
                        <td>
                            <span class="fw-bold text-dark">{{ $debit?->account?->name ?? '-' }}</span>
                            <div style="font-size: 8.5px; color: #64748b; margin-top: 1px;">
                                {{ $entry->description }} {{ ($entry->party_name && !str_contains(strtolower($entry->description), strtolower($entry->party_name))) ? '('.$entry->party_name.')' : '' }}
                            </div>
                        </td>
                        <td class="text-right fw-bold" style="color: #15803d;">
                            {{ $debit ? number_format($debit->amount, 0, ',', '.') : '-' }}
                        </td>
                        <td class="text-right" style="color: #94a3b8;">-</td>
                    </tr>
                    {{-- Baris Kredit --}}
                    <tr>
                        <td class="text-center account-code">{{ $credit?->account?->code ?? '-' }}</td>
                        <td class="credit-indent">
                            <span>{{ $credit?->account?->name ?? '-' }}</span>
                        </td>
                        <td class="text-right" style="color: #94a3b8;">-</td>
                        <td class="text-right fw-bold" style="color: #b91c1c;">
                            {{ $credit ? number_format($credit->amount, 0, ',', '.') : '-' }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-4" style="color: #94a3b8; font-style: italic;">
                            - Tidak ada data transaksi jurnal pada periode ini -
                        </td>
                    </tr>
                @endforelse
            </tbody>
            <tfoot>
                <tr class="total-row">
                    <td colspan="5" class="text-right" style="padding-right: 15px;">TOTAL KESELURUHAN (BALANCE):</td>
                    <td class="text-right" style="color: #15803d;">Rp {{ number_format($totalDebit, 0, ',', '.') }}</td>
                    <td class="text-right" style="color: #b91c1c;">Rp {{ number_format($totalCredit, 0, ',', '.') }}</td>
                </tr>
            </tfoot>
        </table>

        <!-- Tanda Tangan 3 Pihak -->
        <table class="signature-table">
            <tr>
                <td>
                    <div class="sign-title">Dibuat Oleh,</div>
                    <div class="sign-name">( {{ auth()->user()->name ?? 'Staff Keuangan' }} )</div>
                    <div class="sign-role">Staff Keuangan &amp; Kasir</div>
                </td>
                <td>
                    <div class="sign-title">Diperiksa Oleh,</div>
                    <div class="sign-name">( _______________________ )</div>
                    <div class="sign-role">Manager Keuangan</div>
                </td>
                <td>
                    <div class="sign-title">Disetujui Oleh,</div>
                    <div class="sign-name">( _______________________ )</div>
                    <div class="sign-role">Direktur Utama</div>
                </td>
            </tr>
        </table>
    </div>

</body>
</html>

