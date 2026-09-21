<?php

namespace Database\Seeders;

use App\Models\MasterBiayaLegalitas;
use Illuminate\Database\Seeder;

class MasterBiayaLegalitasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            // 4 Komponen Baku (Sesuai Form Pra Land Bank)
            [
                'kode_biaya'        => 'BIAYA-IJB-PPJB',
                'nama_biaya'        => 'Biaya IJB / PPJB Notaris',
                'kategori'          => 'Legalitas & Notaris',
                'tipe_perhitungan'  => 'nominal_tetap',
                'nominal_standar'   => 10000000,
                'persentase_standar'=> null,
                'pihak_penanggung'  => 'perusahaan',
                'deskripsi'         => 'Biaya pembuatan Akta Ikatan Jual Beli (IJB) atau Perjanjian Pengikatan Jual Beli (PPJB) di hadapan Notaris/PPAT.',
                'urutan'            => 1,
                'is_standard'       => true,
                'is_required'       => false,
                'is_active'         => true,
            ],
            [
                'kode_biaya'        => 'PAJAK-PPH-BPHTB',
                'nama_biaya'        => 'Estimasi Pajak PPh/BPHTB',
                'kategori'          => 'Pajak & Retribusi',
                'tipe_perhitungan'  => 'persentase',
                'nominal_standar'   => 50000000,
                'persentase_standar'=> 5.00,
                'pihak_penanggung'  => 'pembeli',
                'deskripsi'         => 'Estimasi Bea Perolehan Hak atas Tanah dan Bangunan (BPHTB) beban pembeli dan/atau PPh Final peralihan hak beban penjual.',
                'urutan'            => 2,
                'is_standard'       => true,
                'is_required'       => false,
                'is_active'         => true,
            ],
            [
                'kode_biaya'        => 'FEE-MAKELAR',
                'nama_biaya'        => 'Fee Makelar / Perantara',
                'kategori'          => 'Perantara & Broker',
                'tipe_perhitungan'  => 'persentase',
                'nominal_standar'   => 15000000,
                'persentase_standar'=> 2.50,
                'pihak_penanggung'  => 'perusahaan',
                'deskripsi'         => 'Komisi jasa mediasi / perantara makelar tanah atas keberhasilan negosiasi transaksi lahan.',
                'urutan'            => 3,
                'is_standard'       => true,
                'is_required'       => false,
                'is_active'         => true,
            ],
            [
                'kode_biaya'        => 'BIAYA-LAIN-ADMIN',
                'nama_biaya'        => 'Biaya Lain-lain Administrasi',
                'kategori'          => 'Administrasi & Operasional',
                'tipe_perhitungan'  => 'fleksibel',
                'nominal_standar'   => 5000000,
                'persentase_standar'=> null,
                'pihak_penanggung'  => 'perusahaan',
                'deskripsi'         => 'Biaya administrasi operasional pendukung, materai, fotokopi berkas, dan taktis lapangan.',
                'urutan'            => 4,
                'is_standard'       => true,
                'is_required'       => false,
                'is_active'         => true,
            ],

            // Komponen Tambahan untuk Pilihan "Tambah Biaya Admin / Lainnya"
            [
                'kode_biaya'        => 'BIAYA-PENGERINGAN',
                'nama_biaya'        => 'Biaya Retribusi Pengeringan & Tata Ruang',
                'kategori'          => 'Perizinan & Kas Desa',
                'tipe_perhitungan'  => 'nominal_tetap',
                'nominal_standar'   => 15000000,
                'persentase_standar'=> null,
                'pihak_penanggung'  => 'perusahaan',
                'deskripsi'         => 'Biaya pengeringan lahan basah / sawah ke pekarangan / perumahan melalui dinas terkait.',
                'urutan'            => 5,
                'is_standard'       => false,
                'is_required'       => false,
                'is_active'         => true,
            ],
            [
                'kode_biaya'        => 'BIAYA-PLOTTING-BPN',
                'nama_biaya'        => 'Biaya Plotting & Validasi Sertifikat BPN',
                'kategori'          => 'Legalitas & Notaris',
                'tipe_perhitungan'  => 'nominal_tetap',
                'nominal_standar'   => 5000000,
                'persentase_standar'=> null,
                'pihak_penanggung'  => 'perusahaan',
                'deskripsi'         => 'Biaya pengecekan keaslian, plotting koordinat batas, dan SKPT di Kantor Pertanahan ATR/BPN.',
                'urutan'            => 6,
                'is_standard'       => false,
                'is_required'       => false,
                'is_active'         => true,
            ],
            [
                'kode_biaya'        => 'FEE-SAKSI-BATAS',
                'nama_biaya'        => 'Biaya Saksi Sempadan & Kas Desa',
                'kategori'          => 'Perizinan & Kas Desa',
                'tipe_perhitungan'  => 'nominal_tetap',
                'nominal_standar'   => 3500000,
                'persentase_standar'=> null,
                'pihak_penanggung'  => 'perusahaan',
                'deskripsi'         => 'Biaya tanda tangan saksi batas tanah kanan/kiri/depan/belakang dan administrasi kas desa/kelurahan.',
                'urutan'            => 7,
                'is_standard'       => false,
                'is_required'       => false,
                'is_active'         => true,
            ],
            [
                'kode_biaya'        => 'BIAYA-KUASA-MENJUAL',
                'nama_biaya'        => 'Biaya Akta Kuasa Menjual Notaris',
                'kategori'          => 'Legalitas & Notaris',
                'tipe_perhitungan'  => 'nominal_tetap',
                'nominal_standar'   => 7500000,
                'persentase_standar'=> null,
                'pihak_penanggung'  => 'perusahaan',
                'deskripsi'         => 'Biaya akta kuasa menjual dari pemilik tanah kepada pihak pengembang.',
                'urutan'            => 8,
                'is_standard'       => false,
                'is_required'       => false,
                'is_active'         => true,
            ],
            [
                'kode_biaya'        => 'BIAYA-BALIK-NAMA',
                'nama_biaya'        => 'Biaya Balik Nama (BBN) Sertifikat',
                'kategori'          => 'Legalitas & Notaris',
                'tipe_perhitungan'  => 'nominal_tetap',
                'nominal_standar'   => 12000000,
                'persentase_standar'=> null,
                'pihak_penanggung'  => 'perusahaan',
                'deskripsi'         => 'Biaya proses balik nama sertifikat tanah induk ke atas nama PT / Developer.',
                'urutan'            => 9,
                'is_standard'       => false,
                'is_required'       => false,
                'is_active'         => true,
            ],
            [
                'kode_biaya'        => 'BIAYA-IZIN-WARGA',
                'nama_biaya'        => 'Kompensasi & Izin Lingkungan Warga',
                'kategori'          => 'Perizinan & Kas Desa',
                'tipe_perhitungan'  => 'nominal_tetap',
                'nominal_standar'   => 5000000,
                'persentase_standar'=> null,
                'pihak_penanggung'  => 'perusahaan',
                'deskripsi'         => 'Biaya sosialisasi, persetujuan warga sekitar jalan akses, dan izin lingkungan.',
                'urutan'            => 10,
                'is_standard'       => false,
                'is_required'       => false,
                'is_active'         => true,
            ],
        ];

        foreach ($items as $item) {
            MasterBiayaLegalitas::updateOrCreate(
                ['kode_biaya' => $item['kode_biaya']],
                $item
            );
        }
    }
}
