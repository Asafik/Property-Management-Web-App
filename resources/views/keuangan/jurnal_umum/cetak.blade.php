<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Buku Jurnal Umum - ERP Keuangan</title>
    <link rel="stylesheet" href="{{ asset('admin/assets/vendors/css/vendor.bundle.base.css') }}">
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 11pt;
            color: #111;
            background: #fff;
            margin: 0;
            padding: 20px;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .header h3 {
            font-size: 16pt;
            font-weight: bold;
            margin: 0;
            text-transform: uppercase;
        }
        .header h4 {
            font-size: 13pt;
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
            font-size: 10pt;
        }
        .meta-table td {
            padding: 3px 0;
        }
        .data-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 9.5pt;
        }
        .data-table th, .data-table td {
            border: 1px solid #444;
            padding: 6px 8px;
            vertical-align: middle;
        }
        .data-table th {
            background-color: #f2f2f2;
            text-align: center;
            font-weight: bold;
            text-transform: uppercase;
        }
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        .fw-bold { font-weight: bold; }
        .credit-indent { padding-left: 20px !important; }
        .signature-table {
            width: 100%;
            margin-top: 40px;
            page-break-inside: avoid;
        }
        .signature-table td {
            text-align: center;
            vertical-align: bottom;
            height: 90px;
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
        <h4>LAPORAN BUKU JURNAL UMUM (GENERAL JOURNAL)</h4>
        <p>Properti: {{ $selectedProject ? $selectedProject->nama_land_bank : 'Semua Proyek & Kantor Pusat' }} | Periode: {{ $startDate ? date('d/m/Y', strtotime($startDate)) : 'Awal' }} s/d {{ $endDate ? date('d/m/Y', strtotime($endDate)) : date('d/m/Y') }}</p>
    </div>

    <table class="meta-table">
        <tr>
            <td style="width: 18%;">Tanggal Cetak</td>
            <td style="width: 32%;">: {{ date('d F Y - H:i') }} WIB</td>
            <td style="width: 18%;">Total Transaksi</td>
            <td style="width: 32%;">: {{ number_format($entries->count()) }} Transaksi</td>
        </tr>
        <tr>
            <td>Dicetak Oleh</td>
            <td>: {{ auth()->user()->name ?? 'Administrator Keuangan' }}</td>
            <td>Status Keseimbangan</td>
            <td>: {{ abs($totalDebit - $totalCredit) < 1 ? 'SEIMBANG (BALANCED)' : 'SELISIH Rp ' . number_format(abs($totalDebit - $totalCredit), 0, ',', '.') }}</td>
        </tr>
    </table>

    <table class="data-table">
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th style="width: 12%;">No. Voucher</th>
                <th style="width: 10%;">Tanggal</th>
                <th style="width: 10%;">Kode Akun</th>
                <th>Nama Akun & Uraian Transaksi</th>
                <th style="width: 15%;">Debit (Rp)</th>
                <th style="width: 15%;">Kredit (Rp)</th>
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
                    <td class="text-center fw-bold" rowspan="2">{{ $entry->entry_number }}</td>
                    <td class="text-center" rowspan="2">{{ $entry->entry_date->format('d/m/Y') }}</td>
                    <td class="text-center">{{ $debit?->account?->code ?? '-' }}</td>
                    <td>
                        <span class="fw-bold">{{ $debit?->account?->name ?? '-' }}</span>
                        <div style="font-size: 8.5pt; color: #555;">{{ $entry->description }} {{ ($entry->party_name && !str_contains(strtolower($entry->description), strtolower($entry->party_name))) ? '('.$entry->party_name.')' : '' }}</div>
                    </td>
                    <td class="text-right fw-bold">{{ $debit ? number_format($debit->amount, 0, ',', '.') : '-' }}</td>
                    <td class="text-right">-</td>
                </tr>
                {{-- Baris Kredit --}}
                <tr>
                    <td class="text-center">{{ $credit?->account?->code ?? '-' }}</td>
                    <td class="credit-indent">
                        <span>{{ $credit?->account?->name ?? '-' }}</span>
                    </td>
                    <td class="text-right">-</td>
                    <td class="text-right fw-bold">{{ $credit ? number_format($credit->amount, 0, ',', '.') : '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center py-4">Tidak ada data transaksi jurnal pada periode ini.</td>
                </tr>
            @endforelse
        </tbody>
        <tfoot>
            <tr style="background-color: #f7f7f7; font-weight: bold;">
                <td colspan="5" class="text-right" style="padding-right: 15px;">TOTAL KESELURUHAN (BALANCE):</td>
                <td class="text-right">Rp {{ number_format($totalDebit, 0, ',', '.') }}</td>
                <td class="text-right">Rp {{ number_format($totalCredit, 0, ',', '.') }}</td>
            </tr>
        </tfoot>
    </table>

    <table class="signature-table">
        <tr>
            <td style="width: 33%;">
                Dibuat Oleh,
                <br><br><br><br>
                <strong>( {{ auth()->user()->name ?? 'Staff Keuangan' }} )</strong><br>
                <span>Staff Keuangan & Kasir</span>
            </td>
            <td style="width: 33%;">
                Diperiksa Oleh,
                <br><br><br><br>
                <strong>( _______________________ )</strong><br>
                <span>Kepala Bagian Keuangan</span>
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
