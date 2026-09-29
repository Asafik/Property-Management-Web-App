<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PerizinanTask;
use App\Models\LandBank;
use App\Models\MasterDokumenPerizinan;
use App\Models\Employee;

class PerizinanTaskSeeder extends Seeder
{
        $lb1 = LandBank::find(1);
        $lb2 = LandBank::find(2);

        if (!$lb1 && !$lb2) {
            return;
        }

        $mPertek = MasterDokumenPerizinan::where('nama_dokumen', 'like', '%PERTEK%')->first();
        $mPkkpr  = MasterDokumenPerizinan::where('nama_dokumen', 'like', '%PKKPR%')->first();
        $mPeta   = MasterDokumenPerizinan::where('nama_dokumen', 'like', '%PETA BIDANG%')->first();
        $mHgb    = MasterDokumenPerizinan::where('nama_dokumen', 'like', '%HGB%')->first();
        $mPbb    = MasterDokumenPerizinan::where('nama_dokumen', 'like', '%PBB%')->first();

        $legalStaff = Employee::where('division_id', 2)->first() ?? Employee::find(2) ?? Employee::find(1);
        $adminId = Employee::find(3)?->id ?? 1;

        $tasks = [
            [
                'proyek_id'         => $lb1?->id ?? 1,
                'proyek_nama'       => $lb1?->name ?? 'Perumahan Jember Indah',
                'master_dokumen_id' => $mPertek?->id,
                'nama_tugas'        => 'Pengurusan PERTEK BPN',
                'instansi'          => 'Kantor Pertanahan BPN Kab. Jember',
                'employee_id'       => $legalStaff?->id,
                'assigned_by'       => $adminId,
                'deadline'          => now()->addDays(5),
                'status'            => 'Dalam Proses',
                'progress'          => 65,
                'catatan'           => 'Sedang melengkapi berkas verifikasi peta bidang dan permohonan dinas.',
                'last_activity_at'  => now(),
            ],
            [
                'proyek_id'         => $lb1?->id ?? 1,
                'proyek_nama'       => $lb1?->name ?? 'Perumahan Jember Indah',
                'master_dokumen_id' => $mPkkpr?->id,
                'nama_tugas'        => 'Validasi PKKPR Dinas PUPR',
                'instansi'          => 'Dinas PUPR & Cipta Karya',
                'employee_id'       => $legalStaff?->id,
                'assigned_by'       => $adminId,
                'deadline'          => now()->addDays(12),
                'status'            => 'Selesai',
                'progress'          => 100,
                'nomor_dokumen'     => '503/PKKPR-JBR/2026',
                'tanggal_terbit'    => now()->subDays(3),
                'catatan'           => 'Surat persetujuan kesesuaian ruang resmi terbit.',
                'last_activity_at'  => now()->subDays(3),
            ],
            [
                'proyek_id'         => $lb2?->id ?? 2,
                'proyek_nama'       => $lb2?->name ?? 'Graha Harmoni Kaliwates',
                'master_dokumen_id' => $mPeta?->id,
                'nama_tugas'        => 'Pengukuran Lapangan & Peta Bidang',
                'instansi'          => 'Kantor Pertanahan BPN Kab. Jember',
                'employee_id'       => $legalStaff?->id,
                'assigned_by'       => $adminId,
                'deadline'          => now()->addDays(3),
                'status'            => 'Dalam Proses',
                'progress'          => 40,
                'catatan'           => 'Menunggu jadwal juru ukur BPN dan saksi batas tetangga.',
                'last_activity_at'  => now()->subDay(),
            ],
            [
                'proyek_id'         => $lb2?->id ?? 2,
                'proyek_nama'       => $lb2?->name ?? 'Graha Harmoni Kaliwates',
                'master_dokumen_id' => $mPbb?->id,
                'nama_tugas'        => 'Mutasi Subjek PBB BAPENDA',
                'instansi'          => 'BAPENDA Kab. Jember',
                'employee_id'       => $legalStaff?->id,
                'assigned_by'       => $adminId,
                'deadline'          => now()->subDays(1),
                'status'            => 'Terkendala',
                'progress'          => 25,
                'catatan'           => 'Perlu kelengkapan SPPT PBB tahun berjalan dari pemilik asal.',
                'kendala'           => 'SPPT asli belum diserahkan oleh pemilik lahan lama.',
                'last_activity_at'  => now(),
            ],
            [
                'proyek_id'         => $lb1?->id ?? 1,
                'proyek_nama'       => $lb1?->name ?? 'Perumahan Jember Indah',
                'master_dokumen_id' => $mHgb?->id,
                'nama_tugas'        => 'Permohonan SK HGB Badan Hukum',
                'instansi'          => 'Kantor Wilayah BPN',
                'employee_id'       => $legalStaff?->id,
                'assigned_by'       => $adminId,
                'deadline'          => now()->addDays(20),
                'status'            => 'Menunggu',
                'progress'          => 10,
                'catatan'           => 'Menunggu penerbitan PERTEK dan pengesahan siteplan.',
                'last_activity_at'  => now(),
            ],
        ];

        foreach ($tasks as $data) {
            PerizinanTask::updateOrCreate(
                [
                    'proyek_id'   => $data['proyek_id'],
                    'nama_tugas'  => $data['nama_tugas'],
                ],
                $data
            );
        }
    }
}
