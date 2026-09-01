<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Perintah Kerja (SPK) - {{ $spk->no_spk }}</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Times+New+Roman&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font@7.2.96/css/materialdesignicons.min.css">

    <style>
        body {
            background-color: #f4f6f9;
            font-family: 'Times New Roman', Times, serif;
            color: #111111;
            font-size: 11.5pt;
            line-height: 1.45;
        }

        .print-container {
            width: 210mm;
            min-height: 297mm;
            padding: 20mm 20mm 20mm 20mm;
            margin: 20px auto;
            background: #ffffff;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            box-sizing: border-box;
            position: relative;
        }

        /* Kop Surat */
        .kop-surat {
            border-bottom: 3px double #000;
            padding-bottom: 12px;
            margin-bottom: 20px;
        }

        .kop-logo {
            max-height: 75px;
            max-width: 140px;
            object-fit: contain;
        }

        .kop-company-name {
            font-family: 'Inter', sans-serif;
            font-size: 16pt;
            font-weight: 800;
            letter-spacing: 1px;
            color: #1a1a1a;
            margin-bottom: 2px;
            text-transform: uppercase;
        }

        .kop-address {
            font-size: 9.5pt;
            color: #333;
            line-height: 1.3;
            margin-bottom: 0;
            font-family: 'Inter', sans-serif;
        }

        .judul-surat {
            text-align: center;
            margin-bottom: 22px;
        }

        .judul-surat h4 {
            font-size: 14pt;
            font-weight: bold;
            text-decoration: underline;
            margin-bottom: 4px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .judul-surat p {
            font-size: 11pt;
            margin-bottom: 0;
            font-weight: 600;
        }

        .table-identitas td {
            padding: 2px 4px;
            vertical-align: top;
            font-size: 11pt;
        }

        .table-termin {
            width: 100%;
            border-collapse: collapse;
            margin: 12px 0;
            font-size: 10pt;
        }

        .table-termin th, .table-termin td {
            border: 1px solid #000;
            padding: 5px 8px;
        }

        .table-termin th {
            background-color: #f2f2f2;
            text-align: center;
            font-weight: bold;
        }

        .pasal-content {
            font-size: 10.5pt;
            text-align: justify;
        }

        .pasal-content p {
            margin-bottom: 4px;
        }

        .pasal-content ol {
            margin-bottom: 8px;
            padding-left: 20px;
        }

        .pasal-content li {
            margin-bottom: 3px;
        }

        .ttd-box {
            margin-top: 30px;
            page-break-inside: avoid;
        }

        .ttd-materai {
            width: 90px;
            height: 55px;
            border: 1px dashed #999;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 8pt;
            color: #777;
            margin: 10px auto;
            text-align: center;
        }

        /* Floating action buttons */
        .print-actions {
            position: fixed;
            bottom: 25px;
            right: 25px;
            z-index: 9999;
            display: flex;
            gap: 10px;
        }

        @media print {
            body {
                background: #fff !important;
                padding: 0 !important;
                margin: 0 !important;
            }

            .print-container {
                width: 100% !important;
                min-height: auto !important;
                padding: 0 !important;
                margin: 0 !important;
                box-shadow: none !important;
            }

            .print-actions {
                display: none !important;
            }

            @page {
                size: A4;
                margin: 15mm 15mm 15mm 15mm;
            }
        }
    </style>
</head>
<body>

    <!-- Floating Action Buttons -->
    <div class="print-actions">
        <button type="button" class="btn btn-dark shadow d-flex align-items-center gap-1" onclick="window.close()">
            <i class="mdi mdi-close"></i> Tutup
        </button>
        <button type="button" class="btn btn-primary shadow d-flex align-items-center gap-1" onclick="window.print()">
            <i class="mdi mdi-printer"></i> Cetak / Simpan PDF
        </button>
    </div>

    <div class="print-container">
        
        <!-- ================= KOP SURAT ================= -->
        <div class="kop-surat">
            <div class="row align-items-center">
                <div class="col-3 text-center">
                    @if($companySetting && $companySetting->logo)
                        <img src="{{ asset($companySetting->logo) }}" alt="Logo" class="kop-logo">
                    @else
                        <div class="p-2 border rounded bg-light text-center fw-bold small">
                            {{ $companySetting->company_name ?? ($companyProfile->name ?? 'DEVELOPER') }}
                        </div>
                    @endif
                </div>
                <div class="col-9 text-center">
                    <div class="kop-company-name">
                        {{ $spk->pihak_pertama_perusahaan ?: ($companySetting->company_name ?? ($companyProfile->name ?? 'PT. PROPERTI MANAJEMEN INDONESIA')) }}
                    </div>
                    <div class="kop-address">
                        {{ $companySetting->address ?? ($companyProfile->address ?? 'Jl. Raya Perumahan No. 01') }}
                        @if($companySetting && $companySetting->city), {{ $companySetting->city }}@endif
                        <br>
                        Telp: {{ $companySetting->phone ?? ($companyProfile->phone ?? '-') }} | Email: {{ $companySetting->email ?? 'info@property.com' }}
                    </div>
                </div>
            </div>
        </div>

        <!-- ================= JUDUL SURAT ================= -->
        <div class="judul-surat">
            <h4>SURAT PERINTAH KERJA (SPK)</h4>
            <p>Nomor : {{ $spk->no_spk }}</p>
        </div>

        <!-- ================= PEMBUKAAN ================= -->
        <p style="text-align: justify; margin-bottom: 12px;">
            Pada hari ini, <strong>{{ \Carbon\Carbon::parse($spk->tanggal_spk)->isoFormat('dddd') }}</strong> tanggal <strong>{{ \Carbon\Carbon::parse($spk->tanggal_spk)->isoFormat('D MMMM Y') }}</strong>, bertempat di kantor <strong>{{ $spk->pihak_pertama_perusahaan ?: ($companySetting->company_name ?? 'Developer') }}</strong>, telah dibuat dan disepakati Surat Perintah Kerja (SPK) oleh dan antara:
        </p>

        <!-- ================= IDENTITAS PARA PIHAK ================= -->
        <table class="table-identitas w-100 mb-2">
            <tr>
                <td style="width: 25px; font-weight: bold;">1.</td>
                <td style="width: 140px;">Nama</td>
                <td style="width: 15px;">:</td>
                <td><strong>{{ $spk->pihak_pertama_nama ?: 'Direktur Utama' }}</strong></td>
            </tr>
            <tr>
                <td></td>
                <td>Jabatan</td>
                <td>:</td>
                <td>{{ $spk->pihak_pertama_jabatan ?: 'Direktur / Project Manager' }}</td>
            </tr>
            <tr>
                <td></td>
                <td>Perusahaan / Instansi</td>
                <td>:</td>
                <td><strong>{{ $spk->pihak_pertama_perusahaan ?: ($companySetting->company_name ?? 'Developer') }}</strong></td>
            </tr>
            <tr>
                <td></td>
                <td>Alamat</td>
                <td>:</td>
                <td>{{ $spk->pihak_pertama_alamat ?: ($companySetting->address ?? '-') }}</td>
            </tr>
            <tr>
                <td></td>
                <td colspan="3" class="pt-1 pb-2">
                    Bertindak untuk dan atas nama <strong>{{ $spk->pihak_pertama_perusahaan ?: ($companySetting->company_name ?? 'Developer') }}</strong>, selanjutnya dalam perjanjian ini disebut sebagai <strong>PIHAK PERTAMA (Pemberi Tugas)</strong>.
                </td>
            </tr>

            <tr>
                <td style="font-weight: bold;">2.</td>
                <td>Nama Kontraktor/Usaha</td>
                <td>:</td>
                <td><strong>{{ $spk->kontraktor_nama }}</strong></td>
            </tr>
            <tr>
                <td></td>
                <td>Penanggung Jawab / PIC</td>
                <td>:</td>
                <td><strong>{{ $spk->kontraktor_pic ?: '-' }}</strong> @if($spk->kontraktor_ktp)(NIK: {{ $spk->kontraktor_ktp }})@endif</td>
            </tr>
            <tr>
                <td></td>
                <td>No. Telepon / HP</td>
                <td>:</td>
                <td>{{ $spk->kontraktor_telepon ?: '-' }}</td>
            </tr>
            <tr>
                <td></td>
                <td>Alamat</td>
                <td>:</td>
                <td>{{ $spk->kontraktor_alamat ?: '-' }}</td>
            </tr>
            <tr>
                <td></td>
                <td>Rekening Bank</td>
                <td>:</td>
                <td>{{ $spk->kontraktor_bank ?: '-' }} - No. {{ $spk->kontraktor_rekening ?: '-' }} (a.n {{ $spk->kontraktor_atas_nama ?: $spk->kontraktor_nama }})</td>
            </tr>
            <tr>
                <td></td>
                <td colspan="3" class="pt-1">
                    Bertindak untuk dan atas nama kontraktor / pelaksana pekerjaan, selanjutnya dalam perjanjian ini disebut sebagai <strong>PIHAK KEDUA (Penerima Tugas)</strong>.
                </td>
            </tr>
        </table>

        <p style="text-align: justify; margin-top: 10px; margin-bottom: 12px;">
            Kedua belah pihak telah sepakat dan menyetujui untuk mengadakan ikatan kerja pelaksanaan pekerjaan dengan syarat-syarat dan ketentuan sebagai berikut:
        </p>

        <!-- ================= PASAL 1: LINGKUP PEKERJAAN ================= -->
        <div class="fw-bold text-center mb-1">PASAL 1 : LINGKUP & LOKASI PEKERJAAN</div>
        <ol style="margin-bottom: 8px; padding-left: 20px; text-align: justify;">
            <li>PIHAK PERTAMA memberikan tugas kepada PIHAK KEDUA dan PIHAK KEDUA menerima tugas tersebut untuk melaksanakan pekerjaan: <strong>{{ $spk->nama_pekerjaan }}</strong>.</li>
            <li>Lokasi pekerjaan berada pada proyek <strong>{{ $spk->landBank->name ?? '-' }}</strong> @if($spk->unit) di Kavling <strong>{{ $spk->unit->unit_code }}</strong> (Tipe {{ $spk->unit->type }}, LT: {{ $spk->unit->area }}m², LB: {{ $spk->unit->building_area }}m²)@endif.</li>
            @if($spk->deskripsi_pekerjaan)
                <li>Rincian teknis pelaksanaan: {{ $spk->deskripsi_pekerjaan }}.</li>
            @endif
        </ol>

        <!-- ================= PASAL 2: BIAYA & NILAI KONTRAK ================= -->
        <div class="fw-bold text-center mb-1 mt-2">PASAL 2 : NILAI KONTRAK PEKERJAAN</div>
        <ol style="margin-bottom: 8px; padding-left: 20px; text-align: justify;">
            <li>Total biaya pelaksanaan pekerjaan yang disepakati adalah sebesar <strong>{{ $spk->formatted_nilai_kontrak }}</strong> (<em>{{ $spk->terbilang }}</em>).</li>
            <li>Nilai kontrak tersebut bersifat borongan (<em>fixed price</em>) dan sudah mencakup seluruh upah kerja, pengadaan material (apabila borong material), peralatan kerja, dan biaya operasional di lapangan.</li>
        </ol>

        <!-- ================= PASAL 3: WAKTU PELAKSANAAN ================= -->
        <div class="fw-bold text-center mb-1 mt-2">PASAL 3 : JANGKA WAKTU PELAKSANAAN</div>
        <ol style="margin-bottom: 8px; padding-left: 20px; text-align: justify;">
            <li>Jangka waktu pelaksanaan pekerjaan ditetapkan selama <strong>{{ $spk->durasi_hari }} ({{ \App\Models\Spk::penyebut($spk->durasi_hari) }}) hari kalender</strong>.</li>
            <li>Pekerjaan dimulai pada tanggal <strong>{{ \Carbon\Carbon::parse($spk->tanggal_mulai)->isoFormat('D MMMM Y') }}</strong> dan harus diserahterimakan dalam keadaan selesai 100% selambat-lambatnya pada tanggal <strong>{{ \Carbon\Carbon::parse($spk->tanggal_selesai)->isoFormat('D MMMM Y') }}</strong>.</li>
        </ol>

        <!-- ================= PASAL 4: JADWAL TERMIN PEMBAYARAN ================= -->
        <div class="fw-bold text-center mb-1 mt-2">PASAL 4 : TAHAPAN PEMBAYARAN (TERMIN)</div>
        <p style="margin-bottom: 4px; text-align: justify;">Pembayaran oleh PIHAK PERTAMA kepada PIHAK KEDUA dilakukan secara bertahap berdasarkan tahapan prestasi fisik sebagai berikut:</p>
        
        <table class="table-termin">
            <thead>
                <tr>
                    <th style="width: 40px;">No</th>
                    <th>Tahap / Uraian Termin</th>
                    <th style="width: 100px;">Syarat Fisik</th>
                    <th style="width: 80px;">Bobot</th>
                    <th style="width: 150px;">Nominal (Rp)</th>
                </tr>
            </thead>
            <tbody>
                @forelse($spk->termins as $idx => $t)
                    <tr>
                        <td class="text-center">{{ $idx + 1 }}</td>
                        <td>{{ $t->nama_tahap }}</td>
                        <td class="text-center">{{ $t->syarat_progress }}%</td>
                        <td class="text-center">{{ $t->persentase }}%</td>
                        <td class="text-end fw-bold">{{ $t->formatted_nominal }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">Pembayaran lumpsum 100% setelah serah terima pekerjaan.</td>
                    </tr>
                @endforelse
            </tbody>
            <tfoot>
                <tr style="font-weight: bold; background-color: #f9f9f9;">
                    <td colspan="3" class="text-end">TOTAL NILAI KONTRAK</td>
                    <td class="text-center">{{ $spk->termins->sum('persentase') }}%</td>
                    <td class="text-end">{{ $spk->formatted_nilai_kontrak }}</td>
                </tr>
            </tfoot>
        </table>

        <!-- ================= PASAL SYARAT KETENTUAN ================= -->
        <div class="pasal-content mt-3">
            {!! $spk->pasal_syarat_ketentuan !!}
        </div>

        @if($spk->keterangan)
            <div class="mt-2" style="font-size: 10pt;">
                <strong>Catatan Khusus:</strong> {{ $spk->keterangan }}
            </div>
        @endif

        <p style="text-align: justify; margin-top: 15px; margin-bottom: 20px;">
            Demikian Surat Perintah Kerja (SPK) ini dibuat dalam rangkap 2 (dua) bermaterai cukup dan masing-masing memiliki kekuatan hukum yang sama setelah ditandatangani oleh kedua belah pihak.
        </p>

        <!-- ================= KOLOM TANDA TANGAN ================= -->
        <div class="ttd-box">
            <div class="row text-center">
                <div class="col-6">
                    <p class="mb-1 fw-bold">PIHAK KEDUA</p>
                    <p class="text-muted small mb-0">{{ $spk->kontraktor_nama }}</p>
                    <div class="ttd-materai">
                        Materai<br>Rp 10.000
                    </div>
                    <p class="fw-bold text-decoration-underline mb-0" style="margin-top: 25px;">
                        ( {{ $spk->kontraktor_pic ?: $spk->kontraktor_nama }} )
                    </p>
                    <small class="text-muted">Kontraktor / Pelaksana</small>
                </div>

                <div class="col-6">
                    <p class="mb-1 fw-bold">PIHAK PERTAMA</p>
                    <p class="text-muted small mb-0">{{ $spk->pihak_pertama_perusahaan ?: ($companySetting->company_name ?? 'Developer') }}</p>
                    <div style="height: 75px;"></div>
                    <p class="fw-bold text-decoration-underline mb-0">
                        ( {{ $spk->pihak_pertama_nama ?: 'Direktur Utama' }} )
                    </p>
                    <small class="text-muted">{{ $spk->pihak_pertama_jabatan ?: 'Pemberi Tugas' }}</small>
                </div>
            </div>
        </div>

    </div>

</body>
</html>
