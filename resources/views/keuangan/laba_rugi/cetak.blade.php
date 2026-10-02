<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Laporan Laba Rugi - PT. Graha Cipta Sejahtera</title>
    
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
        .badge-profit {
            background: #dcfce7;
            color: #166534;
            padding: 2px 8px;
            border-radius: 3px;
            font-weight: 800;
            border: 1px solid #86efac;
        }
        .badge-deficit {
            background: #fee2e2;
            color: #991b1b;
            padding: 2px 8px;
            border-radius: 3px;
            font-weight: 800;
            border: 1px solid #fca5a5;
        }

        /* ===== TABEL STATEMENT LABA RUGI ===== */
        .statement-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 9.5px;
            margin-bottom: 16px;
        }
        .statement-table th, 
        .statement-table td {
            border: 1px solid #94a3b8;
            padding: 5px 8px;
            vertical-align: middle;
        }
        .statement-table th {
            background-color: #f1f5f9;
            font-size: 10px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.3px;
            color: #1e293b;
        }
        .section-header-row {
            background-color: #f8fafc;
            font-weight: 800;
            color: #1e293b;
            text-transform: uppercase;
            font-size: 9.5px;
            letter-spacing: 0.3px;
        }
        .item-row td {
            background-color: #ffffff;
        }
        .item-indent {
            padding-left: 20px !important;
        }
        .account-code {
            font-family: Consolas, 'Courier New', monospace;
            font-weight: 700;
            color: #475569;
            margin-right: 4px;
        }
        .subtotal-row {
            font-weight: 700;
            background-color: #f8fafc;
            border-top: 1.5px dashed #94a3b8;
        }
        .gross-profit-row {
            font-weight: 800;
            font-size: 10.5px;
            background-color: #eff6ff !important;
            color: #1d4ed8;
            border-top: 2px solid #3b82f6 !important;
            border-bottom: 2px solid #3b82f6 !important;
        }
        .net-profit-row {
            font-weight: 800;
            font-size: 10.5px;
            background-color: #ecfdf5 !important;
            color: #065f46;
            border-top: 2px solid #10b981 !important;
            border-bottom: 2.5px double #10b981 !important;
        }
        .net-deficit-row {
            font-weight: 800;
            font-size: 10.5px;
            background-color: #fef2f2 !important;
            color: #991b1b;
            border-top: 2px solid #ef4444 !important;
            border-bottom: 2.5px double #ef4444 !important;
        }

        .text-right { text-align: right !important; }
        .text-center { text-align: center !important; }

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
            .section-header-row, .subtotal-row, .gross-profit-row, .net-profit-row, .net-deficit-row, .meta-info-card, .statement-table th {
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
            <h3 class="report-title">LAPORAN LABA RUGI (INCOME STATEMENT)</h3>
            <p class="report-meta-text">
                Proyek: <strong>{{ $selectedProject ? $selectedProject->nama_land_bank : 'Semua Proyek (Konsolidasi)' }}</strong> &nbsp;&bull;&nbsp;
                Periode: <strong>{{ date('d F Y', strtotime($startDate)) }} s/d {{ date('d F Y', strtotime($endDate)) }}</strong>
            </p>
        </div>

        <!-- Meta Info Bar -->
        <div class="meta-info-card">
            <div class="meta-item">
                <span class="meta-label">Tanggal Cetak:</span>
                <span class="meta-val">{{ date('d/m/Y H:i') }} WIB</span>
            </div>
            <div class="meta-item">
                <span class="meta-label">Kinerja Bersih:</span>
                @if($report['net_income'] >= 0)
                    <span class="badge-profit">PROFIT Rp {{ number_format($report['net_income'], 0, ',', '.') }} (Margin: {{ number_format($report['net_income_margin'], 1) }}%)</span>
                @else
                    <span class="badge-deficit">DEFISIT (Rp {{ number_format(abs($report['net_income']), 0, ',', '.') }}) (Margin: {{ number_format($report['net_income_margin'], 1) }}%)</span>
                @endif
            </div>
            <div class="meta-item">
                <span class="meta-label">Dicetak Oleh:</span>
                <span class="meta-val">{{ auth()->user()->name ?? 'Staff Keuangan' }}</span>
            </div>
        </div>

        <!-- Tabel Laporan Laba Rugi -->
        <table class="statement-table">
            <thead>
                <tr>
                    <th style="width: 70%;">KETERANGAN / POS REKENING AKUN</th>
                    <th style="width: 30%;" class="text-right">JUMLAH (RP)</th>
                </tr>
            </thead>
            <tbody>
                {{-- 1. PENDAPATAN --}}
                <tr class="section-header-row">
                    <td colspan="2">1. PENDAPATAN USAHA (REVENUE)</td>
                </tr>
                @forelse($report['revenue_data'] as $rev)
                    <tr class="item-row">
                        <td class="item-indent">
                            <span class="account-code">[{{ $rev['account']->code }}]</span>
                            {{ $rev['account']->name }}
                            <span style="color: #64748b; font-size: 8.5px; margin-left: 6px;">({{ $rev['account']->sub_category }})</span>
                        </td>
                        <td class="text-right">Rp {{ number_format($rev['balance'], 0, ',', '.') }}</td>
                    </tr>
                @empty
                    <tr class="item-row">
                        <td colspan="2" class="item-indent" style="font-style: italic; color: #94a3b8;">- Tidak ada pendapatan pada periode ini -</td>
                    </tr>
                @endforelse
                <tr class="subtotal-row">
                    <td style="font-weight: 700;">TOTAL PENDAPATAN:</td>
                    <td class="text-right" style="font-weight: 700; color: #0284c7;">Rp {{ number_format($report['total_revenue'], 0, ',', '.') }}</td>
                </tr>

                {{-- 2. HPP --}}
                <tr class="section-header-row">
                    <td colspan="2">2. HARGA POKOK PENJUALAN (HPP PROYEK)</td>
                </tr>
                @forelse($report['cogs_data'] as $cogs)
                    <tr class="item-row">
                        <td class="item-indent">
                            <span class="account-code">[{{ $cogs['account']->code }}]</span>
                            {{ $cogs['account']->name }}
                            <span style="color: #64748b; font-size: 8.5px; margin-left: 6px;">({{ $cogs['account']->sub_category }})</span>
                        </td>
                        <td class="text-right" style="color: #b91c1c;">(Rp {{ number_format($cogs['balance'], 0, ',', '.') }})</td>
                    </tr>
                @empty
                    <tr class="item-row">
                        <td colspan="2" class="item-indent" style="font-style: italic; color: #94a3b8;">- Tidak ada realisasi HPP pada periode ini -</td>
                    </tr>
                @endforelse
                <tr class="subtotal-row">
                    <td style="font-weight: 700;">TOTAL HARGA POKOK PENJUALAN (HPP):</td>
                    <td class="text-right" style="font-weight: 700; color: #b91c1c;">(Rp {{ number_format($report['total_cogs'], 0, ',', '.') }})</td>
                </tr>

                {{-- 3. LABA KOTOR --}}
                <tr class="gross-profit-row">
                    <td>
                        LABA KOTOR (GROSS PROFIT)
                        <span style="font-weight: normal; font-size: 9px; margin-left: 6px;">(Total Pendapatan - Total HPP) &bull; Margin: {{ number_format($report['gross_profit_margin'], 1) }}%</span>
                    </td>
                    <td class="text-right">Rp {{ number_format($report['gross_profit'], 0, ',', '.') }}</td>
                </tr>

                {{-- 4. BEBAN OPERASIONAL --}}
                <tr class="section-header-row">
                    <td colspan="2">3. BEBAN OPERASIONAL & PEMASARAN</td>
                </tr>
                @forelse($report['expense_data'] as $exp)
                    <tr class="item-row">
                        <td class="item-indent">
                            <span class="account-code">[{{ $exp['account']->code }}]</span>
                            {{ $exp['account']->name }}
                            <span style="color: #64748b; font-size: 8.5px; margin-left: 6px;">({{ $exp['account']->sub_category }})</span>
                        </td>
                        <td class="text-right" style="color: #b91c1c;">(Rp {{ number_format($exp['balance'], 0, ',', '.') }})</td>
                    </tr>
                @empty
                    <tr class="item-row">
                        <td colspan="2" class="item-indent" style="font-style: italic; color: #94a3b8;">- Tidak ada beban operasional tercatat pada periode ini -</td>
                    </tr>
                @endforelse
                <tr class="subtotal-row">
                    <td style="font-weight: 700;">TOTAL BEBAN OPERASIONAL:</td>
                    <td class="text-right" style="font-weight: 700; color: #b91c1c;">(Rp {{ number_format($report['total_expense'], 0, ',', '.') }})</td>
                </tr>

                {{-- 5. LABA BERSIH OPERASIONAL --}}
                <tr class="{{ $report['net_income'] >= 0 ? 'net-profit-row' : 'net-deficit-row' }}">
                    <td>
                        LABA / (RUGI) BERSIH OPERASIONAL (NET INCOME)
                        <span style="font-weight: normal; font-size: 9px; margin-left: 6px;">(Laba Kotor - Total Beban) &bull; Margin: {{ number_format($report['net_income_margin'], 1) }}%</span>
                    </td>
                    <td class="text-right">Rp {{ number_format($report['net_income'], 0, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>

        <!-- Tanda Tangan 3 Pihak -->
        <table class="signature-table">
            <tr>
                <td>
                    <div class="sign-title">Dibuat Oleh,</div>
                    <div class="sign-name">( {{ auth()->user()->name ?? 'Staff Akuntansi' }} )</div>
                    <div class="sign-role">Staff Akuntansi</div>
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

