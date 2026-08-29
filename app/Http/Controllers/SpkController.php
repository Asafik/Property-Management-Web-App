<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SpkController extends Controller
{
    /**
     * Display a listing of SPK (Surat Perintah Kerja) Kontraktor.
     */
    public function index()
    {
        // Dummy data list SPK Kontraktor
        $spkList = [
            [
                'id' => 1,
                'no_spk' => 'SPK/2026/KAV-A01/008',
                'nama_proyek' => 'Grand Permata Indah',
                'unit_kavling' => 'Kavling A-01 (Type 36/72)',
                'kontraktor' => 'PT. Maju Konstruksi Nusantara',
                'kontraktor_pic' => 'Bpk. Hendra Gunawan (0812-3456-7890)',
                'tanggal_spk' => '2026-08-10',
                'deadline_spk' => '2026-11-10',
                'nilai_kontrak' => 145000000,
                'file_spk' => 'uploads/spk/dummy_spk_kav_a01.pdf',
                'status' => 'Berjalan',
                'progress' => '45%',
                'keterangan' => 'Pembangunan struktur utama, pondasi batu kali, dan dinding bata merah'
            ],
            [
                'id' => 2,
                'no_spk' => 'SPK/2026/KAV-B05/012',
                'nama_proyek' => 'Grand Permata Indah',
                'unit_kavling' => 'Kavling B-05 (Type 45/84)',
                'kontraktor' => 'CV. Karya Mandiri Sejahtera',
                'kontraktor_pic' => 'Bpk. Ahmad Fauzi (0821-9876-5432)',
                'tanggal_spk' => '2026-07-15',
                'deadline_spk' => '2026-10-15',
                'nilai_kontrak' => 180000000,
                'file_spk' => 'uploads/spk/dummy_spk_kav_b05.pdf',
                'status' => 'Berjalan',
                'progress' => '70%',
                'keterangan' => 'Pengerjaan atap baja ringan, plester aci, dan instalasi pipa listrik'
            ],
            [
                'id' => 3,
                'no_spk' => 'SPK/2026/INFRA-01/003',
                'nama_proyek' => 'Bukit Hijau Regency',
                'unit_kavling' => 'Fasum & PSU Utama',
                'kontraktor' => 'PT. Bina Sarana Infrastruktur',
                'kontraktor_pic' => 'Ir. Bambang Triyono (0813-1122-3344)',
                'tanggal_spk' => '2026-05-01',
                'deadline_spk' => '2026-07-30',
                'nilai_kontrak' => 350000000,
                'file_spk' => 'uploads/spk/dummy_spk_infra_01.pdf',
                'status' => 'Selesai',
                'progress' => '100%',
                'keterangan' => 'Pavingisasi jalan utama ROW 8 meter dan saluran drainase U-Ditch 40cm'
            ],
            [
                'id' => 4,
                'no_spk' => 'SPK/2026/KAV-C09/019',
                'nama_proyek' => 'Bukit Hijau Regency',
                'unit_kavling' => 'Kavling C-09 (Type 54/105)',
                'kontraktor' => 'CV. Graha Jaya Abadi',
                'kontraktor_pic' => 'Bpk. Dedi Supriyadi (0856-4433-2211)',
                'tanggal_spk' => '2026-08-20',
                'deadline_spk' => '2026-12-20',
                'nilai_kontrak' => 220000000,
                'file_spk' => null,
                'status' => 'Draft',
                'progress' => '0%',
                'keterangan' => 'Menunggu verifikasi tanda tangan direksi & penyerahan uang muka tahap 1'
            ],
            [
                'id' => 5,
                'no_spk' => 'SPK/2026/GATE-02/005',
                'nama_proyek' => 'Grand Permata Indah',
                'unit_kavling' => 'Main Gate & Pos Security',
                'kontraktor' => 'PT. Mahakarya Steel & Decor',
                'kontraktor_pic' => 'Bpk. Rahmat Santoso (0819-7788-9900)',
                'tanggal_spk' => '2026-06-10',
                'deadline_spk' => '2026-08-25',
                'nilai_kontrak' => 95000000,
                'file_spk' => 'uploads/spk/dummy_spk_gate.pdf',
                'status' => 'Selesai',
                'progress' => '100%',
                'keterangan' => 'Pembuatan gapura gerbang one-gate system, pos jaga security, dan CCTV booth'
            ]
        ];

        return view('spk.index', compact('spkList'));
    }
}
