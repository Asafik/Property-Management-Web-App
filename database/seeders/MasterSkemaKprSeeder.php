<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MasterSkemaKpr;
use App\Models\Banks;

class MasterSkemaKprSeeder extends Seeder
{
    public function run()
    {
        $banks = Banks::all();
        if ($banks->isEmpty()) {
            return;
        }

        foreach ($banks as $bank) {
            // Contoh Tenor 15 Tahun (Flat / Step-up Tahun 1 - 5, 6 - 10, dst)
            MasterSkemaKpr::updateOrCreate(
                [
                    'bank_id' => $bank->id,
                    'produk_kpr' => 'subsidi',
                    'tenor' => 15,
                    'periode_tahun' => 'Tahun 1 - 5',
                ],
                [
                    'nama_skema' => 'KPR Subsidi FLPP ' . $bank->bank_name,
                    'bunga' => 5.00,
                    'angsuran_per_bulan' => 700000,
                    'keterangan' => 'Cicilan flat periode tahun 1 sampai tahun 5',
                    'is_active' => true,
                ]
            );

            MasterSkemaKpr::updateOrCreate(
                [
                    'bank_id' => $bank->id,
                    'produk_kpr' => 'subsidi',
                    'tenor' => 15,
                    'periode_tahun' => 'Tahun 6 - 10',
                ],
                [
                    'nama_skema' => 'KPR Subsidi FLPP ' . $bank->bank_name,
                    'bunga' => 5.00,
                    'angsuran_per_bulan' => 850000,
                    'keterangan' => 'Cicilan flat periode tahun 6 sampai tahun 10',
                    'is_active' => true,
                ]
            );

            MasterSkemaKpr::updateOrCreate(
                [
                    'bank_id' => $bank->id,
                    'produk_kpr' => 'subsidi',
                    'tenor' => 15,
                    'periode_tahun' => 'Tahun 11 - 15',
                ],
                [
                    'nama_skema' => 'KPR Subsidi FLPP ' . $bank->bank_name,
                    'bunga' => 5.00,
                    'angsuran_per_bulan' => 1050000,
                    'keterangan' => 'Cicilan flat periode tahun 11 sampai tahun 15',
                    'is_active' => true,
                ]
            );

            // Tenor 10 Tahun
            MasterSkemaKpr::updateOrCreate(
                [
                    'bank_id' => $bank->id,
                    'produk_kpr' => 'subsidi',
                    'tenor' => 10,
                    'periode_tahun' => 'Tahun 1 - 5',
                ],
                [
                    'nama_skema' => 'KPR Subsidi FLPP ' . $bank->bank_name,
                    'bunga' => 5.00,
                    'angsuran_per_bulan' => 950000,
                    'keterangan' => 'Cicilan flat periode tahun 1 sampai 5 (Tenor 10 Thn)',
                    'is_active' => true,
                ]
            );

            MasterSkemaKpr::updateOrCreate(
                [
                    'bank_id' => $bank->id,
                    'produk_kpr' => 'subsidi',
                    'tenor' => 10,
                    'periode_tahun' => 'Tahun 6 - 10',
                ],
                [
                    'nama_skema' => 'KPR Subsidi FLPP ' . $bank->bank_name,
                    'bunga' => 5.00,
                    'angsuran_per_bulan' => 1150000,
                    'keterangan' => 'Cicilan flat periode tahun 6 sampai 10 (Tenor 10 Thn)',
                    'is_active' => true,
                ]
            );

            // Tenor 20 Tahun
            MasterSkemaKpr::updateOrCreate(
                [
                    'bank_id' => $bank->id,
                    'produk_kpr' => 'subsidi',
                    'tenor' => 20,
                    'periode_tahun' => 'Tahun 1 - 5',
                ],
                [
                    'nama_skema' => 'KPR Subsidi FLPP ' . $bank->bank_name,
                    'bunga' => 5.00,
                    'angsuran_per_bulan' => 600000,
                    'keterangan' => 'Cicilan flat periode tahun 1 sampai 5 (Tenor 20 Thn)',
                    'is_active' => true,
                ]
            );
        }
    }
}
