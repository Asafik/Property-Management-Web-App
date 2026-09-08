<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DocumentTypes; 
use Carbon\Carbon;

class DocumentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $allCategories = ['SHM', 'AJB', 'APHB', 'WARISAN', 'PETOK_C'];

        $documentTypes = [
            [
                'name' => 'Sertifikat SHM Asli',
                'code' => 'SERTIFIKAT',
                'has_expiry' => false,
                'applicable_categories' => ['SHM'],
            ],
            [
                'name' => 'KTP Penjual / Ahli Waris (Suami - Istri)',
                'code' => 'KTP_PENJUAL',
                'has_expiry' => false,
                'applicable_categories' => $allCategories,
            ],
            [
                'name' => 'Kartu Keluarga (KK)',
                'code' => 'KARTU_KELUARGA',
                'has_expiry' => false,
                'applicable_categories' => $allCategories,
            ],
            [
                'name' => 'Buku / Surat Nikah',
                'code' => 'SURAT_NIKAH',
                'has_expiry' => false,
                'applicable_categories' => $allCategories,
            ],
            [
                'name' => 'NPWP Penjual / Ahli Waris',
                'code' => 'NPWP',
                'has_expiry' => false,
                'applicable_categories' => $allCategories,
            ],
            [
                'name' => 'SPPT PBB Terakhir',
                'code' => 'SPPT_PBB',
                'has_expiry' => false,
                'applicable_categories' => $allCategories,
            ],
            [
                'name' => 'Akta Jual Beli (AJB) / Akta Hibah Asli',
                'code' => 'AJB_HIBAH',
                'has_expiry' => false,
                'applicable_categories' => ['AJB', 'WARISAN'],
            ],
            [
                'name' => 'Akta Pembagian Hak Bersama (APHB)',
                'code' => 'APHB',
                'has_expiry' => false,
                'applicable_categories' => ['APHB'],
            ],
            [
                'name' => 'Surat Keterangan Riwayat Tanah (Kelurahan)',
                'code' => 'RIWAYAT_TANAH',
                'has_expiry' => false,
                'applicable_categories' => ['AJB', 'APHB', 'WARISAN', 'PETOK_C'],
            ],
            [
                'name' => 'Salinan Kutipan Letter C Desa',
                'code' => 'LETTER_C',
                'has_expiry' => false,
                'applicable_categories' => ['AJB', 'APHB', 'WARISAN', 'PETOK_C'],
            ],
            [
                'name' => 'Surat Keterangan Penguasaan Fisik & BA Kesaksian',
                'code' => 'PENGUASAAN_FISIK',
                'has_expiry' => false,
                'applicable_categories' => ['AJB', 'APHB', 'WARISAN', 'PETOK_C'],
            ],
            [
                'name' => 'Berita Acara Persetujuan Tanda Batas',
                'code' => 'TANDA_BATAS',
                'has_expiry' => false,
                'applicable_categories' => ['AJB', 'APHB', 'WARISAN', 'PETOK_C'],
            ],
            [
                'name' => 'Surat Keterangan Ahli Waris',
                'code' => 'KETERANGAN_WARIS',
                'has_expiry' => false,
                'applicable_categories' => ['APHB', 'WARISAN'],
            ],
            [
                'name' => 'Surat / Akta Kematian Pewaris',
                'code' => 'AKTA_KEMATIAN',
                'has_expiry' => false,
                'applicable_categories' => ['APHB', 'WARISAN'],
            ],
            [
                'name' => 'Petok C / Girik Asli',
                'code' => 'PETOK_C',
                'has_expiry' => false,
                'applicable_categories' => ['PETOK_C'],
            ],
        ];

        foreach ($documentTypes as $type) {
            DocumentTypes::updateOrCreate(
                ['code' => $type['code']],
                [
                    'name' => $type['name'],
                    'has_expiry' => $type['has_expiry'],
                    'applicable_categories' => $type['applicable_categories'],
                    'updated_at' => Carbon::now(),
                ]
            );
        }
    }
}
