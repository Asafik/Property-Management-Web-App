<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\Controller;
use App\Models\LandBank;
use App\Models\Notaris;
use Illuminate\Http\Request;

class PembayaranFeeController extends Controller
{
    /**
     * Master Data Aturan Fee & Biaya (AJB, Makelar, Notaris, BPHTB, Balik Nama, dll)
     */
    protected function getMasterFeeRules()
    {
        return [
            [
                'id' => 1,
                'kode_fee' => 'FEE-AJB-01',
                'nama_fee' => 'Fee AJB (Akta Jual Beli) PPAT',
                'kategori' => 'notaris',
                'kategori_label' => 'Notaris & PPAT',
                'target_penerima' => 'PPAT Bambang Trihatmodjo, S.H., M.Kn.',
                'tipe_hitung' => 'flat',
                'tipe_hitung_label' => 'Nominal Tetap (Flat)',
                'nilai' => 5000000,
                'satuan' => 'Rp / Berkas AJB',
                'proyek' => 'Semua Proyek',
                'tipe_unit' => 'Semua Tipe (Subsidi & Komersil)',
                'syarat_cair' => 'Saat penandatanganan Akta Jual Beli resmi di hadapan PPAT & para saksi.',
                'is_active' => true,
                'keterangan' => 'Standar honorarium PPAT pembuatan akta jual beli dan pendaftaran ke BPN.'
            ],
            [
                'id' => 2,
                'kode_fee' => 'FEE-MKL-01',
                'nama_fee' => 'Fee Makelar / Perantara Unit Komersil',
                'kategori' => 'makelar',
                'kategori_label' => 'Makelar & Agen',
                'target_penerima' => 'Makelar / Agen Lepas / Broker Eksternal',
                'tipe_hitung' => 'persen',
                'tipe_hitung_label' => 'Persentase (%)',
                'nilai' => 2.5,
                'satuan' => '% dari Nilai Transaksi',
                'proyek' => 'Perumahan Jember',
                'tipe_unit' => 'Rumah Komersil (Tipe 45 & 54)',
                'syarat_cair' => 'Tahap 1: 50% saat DP lunas minimal 20%. Tahap 2: 50% saat Akad Kredit / Pelunasan.',
                'is_active' => true,
                'keterangan' => 'Komisi perantara penutup penjualan unit komersil non-subsidi.'
            ],
            [
                'id' => 3,
                'kode_fee' => 'FEE-MKL-02',
                'nama_fee' => 'Fee Makelar / Perantara Unit Subsidi (FLPP)',
                'kategori' => 'makelar',
                'kategori_label' => 'Makelar & Agen',
                'target_penerima' => 'Makelar / Agen Lepas / Broker Eksternal',
                'tipe_hitung' => 'flat',
                'tipe_hitung_label' => 'Nominal Tetap (Flat)',
                'nilai' => 3000000,
                'satuan' => 'Rp / Unit Terjual',
                'proyek' => 'Perumahan Jember',
                'tipe_unit' => 'Rumah Subsidi (Tipe 36/72)',
                'syarat_cair' => 'Dicairkan penuh 100% setelah realisasi akad kredit KPR FLPP bank selesai.',
                'is_active' => true,
                'keterangan' => 'Tarif flat perantara penutupan konsumen rumah subsidi pemerintah.'
            ],
            [
                'id' => 4,
                'kode_fee' => 'FEE-IJB-01',
                'nama_fee' => 'Fee IJB / PPJB Notaris',
                'kategori' => 'notaris',
                'kategori_label' => 'Notaris & PPAT',
                'target_penerima' => 'Notaris Siti Nurhaliza, S.H., M.Kn.',
                'tipe_hitung' => 'flat',
                'tipe_hitung_label' => 'Nominal Tetap (Flat)',
                'nilai' => 2500000,
                'satuan' => 'Rp / Akta Pengikatan',
                'proyek' => 'Semua Proyek',
                'tipe_unit' => 'Semua Tipe Unit',
                'syarat_cair' => 'Saat penandatanganan Perjanjian Pengikatan Jual Beli (PPJB / IJB) notariil.',
                'is_active' => true,
                'keterangan' => 'Biaya pembuatan akta pengikatan awal sebelum sertifikat siap AJB.'
            ],
            [
                'id' => 5,
                'kode_fee' => 'FEE-BBN-01',
                'nama_fee' => 'Fee Balik Nama (BBN) Sertifikat',
                'kategori' => 'pertanahan',
                'kategori_label' => 'Pertanahan BPN',
                'target_penerima' => 'Kantor Pertanahan ATR/BPN Kab. Jember',
                'tipe_hitung' => 'flat',
                'tipe_hitung_label' => 'Nominal Tetap (Flat)',
                'nilai' => 3500000,
                'satuan' => 'Rp / Buku Sertifikat',
                'proyek' => 'Semua Proyek',
                'tipe_unit' => 'Semua Tipe Unit',
                'syarat_cair' => 'Saat berkas AJB & bukti bayar BPHTB diserahkan ke loket pendaftaran BPN.',
                'is_active' => true,
                'keterangan' => 'Biaya resmi PNBP pendaftaran peralihan hak dari developer ke konsumen.'
            ],
            [
                'id' => 6,
                'kode_fee' => 'FEE-BPHTB-01',
                'nama_fee' => 'Fee BPHTB (Pajak Pembeli Daerah)',
                'kategori' => 'pajak',
                'kategori_label' => 'Pajak Daerah',
                'target_penerima' => 'Bapenda Kabupaten Jember',
                'tipe_hitung' => 'persen',
                'tipe_hitung_label' => 'Persentase (%)',
                'nilai' => 5.0,
                'satuan' => '% x (NPOP - NPOPTKP)',
                'proyek' => 'Semua Proyek',
                'tipe_unit' => 'Semua Tipe Unit',
                'syarat_cair' => 'Wajib divalidasi dan lunas sebelum proses AJB/BBN dilaksanakan.',
                'is_active' => true,
                'keterangan' => 'Rumus resmi: 5% dikali Nilai Transaksi dikurangi Nilai Tidak Kena Pajak (NPOPTKP).'
            ],
            [
                'id' => 7,
                'kode_fee' => 'FEE-PPH-01',
                'nama_fee' => 'Fee PPh Final Penjual (Pajak Penghasilan)',
                'kategori' => 'pajak',
                'kategori_label' => 'Pajak Pusat',
                'target_penerima' => 'Kantor Pelayanan Pajak (KPP) Pratama',
                'tipe_hitung' => 'persen',
                'tipe_hitung_label' => 'Persentase (%)',
                'nilai' => 2.5,
                'satuan' => '% dari Bruto Transaksi (1% Rumah Sederhana)',
                'proyek' => 'Semua Proyek',
                'tipe_unit' => 'Semua Tipe Unit',
                'syarat_cair' => 'Disetorkan ke kas negara via kode billing MPN G2 DJP sebelum AJB.',
                'is_active' => true,
                'keterangan' => 'PPh pengalihan hak atas tanah dan bangunan sesuai PP No. 34 Tahun 2016.'
            ],
            [
                'id' => 8,
                'kode_fee' => 'FEE-SPLIT-01',
                'nama_fee' => 'Fee Pemecahan Sertifikat (Splitsing per Kavling)',
                'kategori' => 'pertanahan',
                'kategori_label' => 'Pertanahan BPN',
                'target_penerima' => 'Petugas Ukur BPN & Notaris Rekanan',
                'tipe_hitung' => 'flat',
                'tipe_hitung_label' => 'Nominal Tetap (Flat)',
                'nilai' => 1500000,
                'satuan' => 'Rp / Bidang Pecahan Kavling',
                'proyek' => 'Perumahan Jember',
                'tipe_unit' => 'Kavling Siap Bangun',
                'syarat_cair' => 'Saat surat tugas pengukuran & pendaftaran peta bidang diterbitkan BPN.',
                'is_active' => true,
                'keterangan' => 'Biaya pemecahan sertifikat induk kawasan menjadi sertifikat satuan per nomor kavling.'
            ],
            [
                'id' => 9,
                'kode_fee' => 'FEE-MKL-03',
                'nama_fee' => 'Fee Makelar / Perantara Pembebasan Tanah Mentah',
                'kategori' => 'makelar',
                'kategori_label' => 'Makelar & Agen',
                'target_penerima' => 'Makelar Tanah / Tokoh Masyarakat Setempat',
                'tipe_hitung' => 'meter',
                'tipe_hitung_label' => 'Per Meter Persegi (m²)',
                'nilai' => 25000,
                'satuan' => 'Rp / m² Luas Tanah Bebas',
                'proyek' => 'Semua Proyek',
                'tipe_unit' => 'Lahan Mentah / Land Bank',
                'syarat_cair' => 'Dicairkan bertahap sesuai persentase luas tanah yang berhasil dibebaskan/AJB.',
                'is_active' => true,
                'keterangan' => 'Komisi mediasi pembebasan lahan dari pemilik awal / petani kepada developer.'
            ],
            [
                'id' => 10,
                'kode_fee' => 'FEE-ROYA-01',
                'nama_fee' => 'Fee Roya / Pencoretan Hak Tanggungan (APHT)',
                'kategori' => 'notaris',
                'kategori_label' => 'Notaris & PPAT',
                'target_penerima' => 'Notaris Siti Nurhaliza, S.H., M.Kn.',
                'tipe_hitung' => 'flat',
                'tipe_hitung_label' => 'Nominal Tetap (Flat)',
                'nilai' => 1800000,
                'satuan' => 'Rp / Sertifikat Induk',
                'proyek' => 'Semua Proyek',
                'tipe_unit' => 'Sertifikat Induk HGB',
                'syarat_cair' => 'Setelah ada Surat Keterangan Lunas dari Bank Kreditur Konstruksi.',
                'is_active' => false,
                'keterangan' => 'Biaya pendaftaran surat roya pencabutan hipotik/hak tanggungan di BPN.'
            ]
        ];
    }

    /**
     * Tampilan utama Master Aturan Fee
     */
    public function index(Request $request)
    {
        $allRules = collect($this->getMasterFeeRules());

        // Hitung KPI Ringkasan
        $totalRules     = $allRules->count();
        $activeRules    = $allRules->where('is_active', true)->count();
        $flatRules      = $allRules->where('tipe_hitung', 'flat')->count();
        $persenRules    = $allRules->where('tipe_hitung', 'persen')->count();
        $meterRules     = $allRules->where('tipe_hitung', 'meter')->count();
        $makelarRules   = $allRules->where('kategori', 'makelar')->count();
        $notarisRules   = $allRules->where('kategori', 'notaris')->count();

        // Filter Logic
        $filtered = $allRules;

        // 1. Search filter
        if ($search = $request->get('search')) {
            $q = strtolower(trim($search));
            $filtered = $filtered->filter(function ($item) use ($q) {
                return str_contains(strtolower($item['kode_fee']), $q)
                    || str_contains(strtolower($item['nama_fee']), $q)
                    || str_contains(strtolower($item['kategori_label']), $q)
                    || str_contains(strtolower($item['target_penerima']), $q)
                    || str_contains(strtolower($item['proyek']), $q)
                    || str_contains(strtolower($item['keterangan']), $q);
            });
        }

        // 2. Kategori filter
        if ($kategori = $request->get('kategori')) {
            if ($kategori !== 'all') {
                $filtered = $filtered->filter(function ($item) use ($kategori) {
                    return $item['kategori'] === $kategori;
                });
            }
        }

        // 3. Tipe Hitung filter
        if ($tipe = $request->get('tipe_hitung')) {
            if ($tipe !== 'all') {
                $filtered = $filtered->filter(function ($item) use ($tipe) {
                    return $item['tipe_hitung'] === $tipe;
                });
            }
        }

        // 4. Status filter
        if ($status = $request->get('status')) {
            if ($status !== 'all') {
                $isActiveBool = ($status === '1' || $status === 'aktif');
                $filtered = $filtered->filter(function ($item) use ($isActiveBool) {
                    return $item['is_active'] === $isActiveBool;
                });
            }
        }

        // Ambil data notaris & proyek untuk dropdown modal
        $notarisList = Notaris::where('is_active', true)->get();
        $proyekList  = LandBank::select('id', 'name')->get();

        return view('keuangan.pembayaran.index', [
            'rules'         => $filtered,
            'totalRules'    => $totalRules,
            'activeRules'   => $activeRules,
            'flatRules'     => $flatRules,
            'persenRules'   => $persenRules,
            'meterRules'    => $meterRules,
            'makelarRules'  => $makelarRules,
            'notarisRules'  => $notarisRules,
            'notarisList'   => $notarisList,
            'proyekList'    => $proyekList,
        ]);
    }

    /**
     * Halaman Simulasi & Kalkulator Fee Otomatis (Tinggal Pakai)
     */
    public function simulasi(Request $request)
    {
        $allRules = collect($this->getMasterFeeRules());
        $activeRules = $allRules->where('is_active', true)->values();

        return view('keuangan.pembayaran.simulasi', [
            'rules'        => $activeRules,
            'defaultHarga' => (float)($request->get('harga', 350000000)),
            'defaultLuas'  => (float)($request->get('luas', 72)),
        ]);
    }
}
