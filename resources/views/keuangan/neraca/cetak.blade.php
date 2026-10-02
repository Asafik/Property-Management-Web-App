<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Neraca Keuangan - ERP Keuangan</title>
    <link rel="stylesheet" href="{{ asset('admin/assets/vendors/css/vendor.bundle.base.css') }}">
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 10.5pt;
            color: #111;
            background: #fff;
            margin: 0;
            padding: 20px;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #000;
            padding-bottom: 8px;
            margin-bottom: 15px;
        }
        .header h3 {
            font-size: 15pt;
            font-weight: bold;
            margin: 0;
            text-transform: uppercase;
        }
        .header h4 {
            font-size: 12pt;
            margin: 3px 0;
        }
        .header p {
            font-size: 10pt;
            margin: 0;
            color: #555;
        }
        .meta-table {
            width: 100%;
            margin-bottom: 15px;
            font-size: 9.5pt;
        }
        .dual-neraca {
            width: 100%;
            border-collapse: collapse;
        }
        .dual-neraca > tbody > tr > td {
            width: 50%;
            vertical-align: top;
            padding: 0 10px;
        }
        .neraca-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 9.5pt;
        }
        .neraca-table th, .neraca-table td {
            border: 1px solid #777;
            padding: 5px 8px;
            vertical-align: middle;
        }
        .neraca-table th {
            background-color: #f2f2f2;
            text-align: left;
            font-weight: bold;
            text-transform: uppercase;
        }
        .sub-header {
            background-color: #f9f9f9;
            font-weight: bold;
            font-style: italic;
        }
        .subtotal-row {
            font-weight: bold;
            background-color: #f2f2f2;
        }
        .total-row {
            font-weight: bold;
            font-size: 10.5pt;
            background-color: #e2e8f0;
            border-top: 2px solid #000;
            border-bottom: 2px double #000;
        }
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        .signature-table {
            width: 100%;
            margin-top: 35px;
            page-break-inside: avoid;
        }
        .signature-table td {
            text-align: center;
            vertical-align: bottom;
            height: 80px;
        }
        @media print {
            body { padding: 0; }
            .no-print { display: none !important; }
            @page {
                size: A4 landscape;
                margin: 1.5cm 1cm;
            }
        }
    </style>
</head>
<body>
    <div class="no-print mb-3 text-end">
        <button onclick="window.print()" class="btn btn-primary btn-sm px-4 fw-bold">
            <i class="mdi mdi-printer"></i> Cetak / Simpan PDF
        </button>
        <button onclick="window.close()" class="btn btn-secondary btn-sm px-3">
            Tutup
        </button>
    </div>

    <div class="header">
        <h3>PT GRAHA CIPTA SEJAHTERA</h3>
        <h4>NERACA KEUANGAN (BALANCE SHEET)</h4>
        <p>Proyek: {{ $selectedProject ? $selectedProject->nama_land_bank : 'Semua Proyek (Konsolidasi)' }} | Posisi Per Tanggal: {{ date('d F Y', strtotime($asOfDate)) }}</p>
    </div>

    <table class="meta-table">
        <tr>
            <td style="width: 20%;">Tanggal Cetak</td>
            <td style="width: 30%;">: {{ date('d/m/Y H:i') }} WIB</td>
            <td style="width: 20%;">Status Keseimbangan</td>
            <td style="width: 30%;">: {{ $report['is_balanced'] ? 'SEIMBANG (BALANCED)' : 'SELISIH Rp ' . number_format(abs($report['difference']), 0, ',', '.') }}</td>
        </tr>
    </table>

    <table class="dual-neraca">
        <tbody>
            <tr>
                {{-- SISI KIRI: ASET --}}
                <td>
                    <table class="neraca-table">
                        <thead>
                            <tr>
                                <th>ASET (AKTIVA)</th>
                                <th style="width: 35%;" class="text-right">JUMLAH (RP)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="sub-header">
                                <td colspan="2">1. ASET LANCAR</td>
                            </tr>
                            @php $subCurrent = 0; @endphp
                            @forelse($report['assets_current'] as $item)
                                @php $subCurrent += $item['balance']; @endphp
                                <tr>
                                    <td>[{{ $item['account']->code }}] {{ $item['account']->name }}</td>
                                    <td class="text-right">Rp {{ number_format($item['balance'], 0, ',', '.') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2" style="font-style: italic; color: #777;">- Tidak ada saldo</td>
                                </tr>
                            @endforelse
                            <tr class="subtotal-row">
                                <td>Subtotal Aset Lancar:</td>
                                <td class="text-right">Rp {{ number_format($subCurrent, 0, ',', '.') }}</td>
                            </tr>

                            <tr class="sub-header">
                                <td colspan="2">2. PERSEDIAAN PROPERTI & PROYEK (WIP)</td>
                            </tr>
                            @php $subProj = 0; @endphp
                            @forelse($report['assets_project'] as $item)
                                @php $subProj += $item['balance']; @endphp
                                <tr>
                                    <td>[{{ $item['account']->code }}] {{ $item['account']->name }}</td>
                                    <td class="text-right">Rp {{ number_format($item['balance'], 0, ',', '.') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2" style="font-style: italic; color: #777;">- Tidak ada saldo</td>
                                </tr>
                            @endforelse
                            <tr class="subtotal-row">
                                <td>Subtotal Persediaan Properti:</td>
                                <td class="text-right">Rp {{ number_format($subProj, 0, ',', '.') }}</td>
                            </tr>

                            <tr class="total-row">
                                <td>TOTAL ASET (AKTIVA)</td>
                                <td class="text-right">Rp {{ number_format($report['total_assets'], 0, ',', '.') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </td>

                {{-- SISI KANAN: KEWAJIBAN & EKUITAS --}}
                <td>
                    <table class="neraca-table">
                        <thead>
                            <tr>
                                <th>KEWAJIBAN & EKUITAS (PASIVA)</th>
                                <th style="width: 35%;" class="text-right">JUMLAH (RP)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="sub-header">
                                <td colspan="2">1. KEWAJIBAN JANGKA PENDEK (LIABILITAS)</td>
                            </tr>
                            @forelse($report['liabilities'] as $item)
                                <tr>
                                    <td>[{{ $item['account']->code }}] {{ $item['account']->name }}</td>
                                    <td class="text-right">Rp {{ number_format($item['balance'], 0, ',', '.') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2" style="font-style: italic; color: #777;">- Tidak ada kewajiban lancar</td>
                                </tr>
                            @endforelse
                            <tr class="subtotal-row">
                                <td>Subtotal Kewajiban:</td>
                                <td class="text-right">Rp {{ number_format($report['total_liabilities'], 0, ',', '.') }}</td>
                            </tr>

                            <tr class="sub-header">
                                <td colspan="2">2. EKUITAS & MODAL PEMILIK</td>
                            </tr>
                            @forelse($report['equity'] as $item)
                                <tr>
                                    <td>[{{ $item['account']->code }}] {{ $item['account']->name }}</td>
                                    <td class="text-right">Rp {{ number_format($item['balance'], 0, ',', '.') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2" style="font-style: italic; color: #777;">- Tidak ada saldo ekuitas</td>
                                </tr>
                            @endforelse
                            <tr class="subtotal-row">
                                <td>Subtotal Ekuitas:</td>
                                <td class="text-right">Rp {{ number_format($report['total_equity'], 0, ',', '.') }}</td>
                            </tr>

                            <tr class="total-row">
                                <td>TOTAL KEWAJIBAN & EKUITAS</td>
                                <td class="text-right">Rp {{ number_format($report['total_liabilities_and_equity'], 0, ',', '.') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>

    <table class="signature-table">
        <tr>
            <td style="width: 33%;">
                Dibuat Oleh,
                <br><br><br><br>
                <strong>( {{ auth()->user()->name ?? 'Staff Keuangan' }} )</strong><br>
                <span>Staff Akuntansi</span>
            </td>
            <td style="width: 33%;">
                Diperiksa Oleh,
                <br><br><br><br>
                <strong>( _______________________ )</strong><br>
                <span>Manager Keuangan</span>
            </td>
            <td style="width: 33%;">
                Disetujui Oleh,
                <br><br><br><br>
                <strong>( _______________________ )</strong><br>
                <span>Direktur Utama</span>
            </td>
        </tr>
    </table>
</body>
</html>
