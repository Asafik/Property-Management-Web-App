<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Promo;
use Carbon\Carbon;

class PromoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $promos = [
            // ===== PROMO DISKON =====
            [
                'name' => 'Early Bird 10%',
                'description' => 'Diskon 10% untuk pembelian unit sebelum proyek dimulai',
                'validity_period' => 'periode',
                'start_date' => Carbon::now()->toDateString(),
                'end_date' => Carbon::now()->addMonths(3)->toDateString(),
                'duration_days' => Carbon::now()->diffInDays(Carbon::now()->addMonths(3)) + 1,
                'type' => 'persen',
                'category' => 'promo',
                'value' => 10, // 10%
                'status' => 'aktif',
            ],
            [
                'name' => 'Diskon Pelunasan',
                'description' => 'Diskon 5% untuk pelunasan cash keras',
                'validity_period' => 'selalu',
                'start_date' => null,
                'end_date' => null,
                'duration_days' => null,
                'type' => 'persen',
                'category' => 'promo',
                'value' => 5,
                'status' => 'aktif',
            ],
            [
                'name' => 'Promo Spesial Lebaran',
                'description' => 'Potongan Rp 5.000.000 untuk pembelian unit type 45',
                'validity_period' => 'periode',
                'start_date' => Carbon::now()->addMonths(2)->toDateString(),
                'end_date' => Carbon::now()->addMonths(3)->toDateString(),
                'duration_days' => Carbon::now()->addMonths(2)->diffInDays(Carbon::now()->addMonths(3)) + 1,
                'type' => 'nominal',
                'category' => 'promo',
                'value' => 5000000,
                'status' => 'aktif',
            ],

            // ===== BIAYA TAMBAHAN =====
            [
                'name' => 'PPN 11%',
                'description' => 'Pajak Pertambahan Nilai 11% untuk semua transaksi',
                'validity_period' => 'selalu',
                'start_date' => null,
                'end_date' => null,
                'duration_days' => null,
                'type' => 'persen',
                'category' => 'biaya',
                'value' => 11,
                'status' => 'aktif',
            ],
            [
                'name' => 'Biaya Kanopi',
                'description' => 'Biaya pembuatan kanopi per meter',
                'validity_period' => 'selalu',
                'start_date' => null,
                'end_date' => null,
                'duration_days' => null,
                'type' => 'nominal',
                'category' => 'biaya',
                'value' => 350000,
                'status' => 'aktif',
            ],
            [
                'name' => 'Biaya Pagar',
                'description' => 'Biaya pembuatan pagar depan',
                'validity_period' => 'selalu',
                'start_date' => null,
                'end_date' => null,
                'duration_days' => null,
                'type' => 'nominal',
                'category' => 'biaya',
                'value' => 2500000,
                'status' => 'aktif',
            ],
            [
                'name' => 'Biaya IMB',
                'description' => 'Izin Mendirikan Bangunan',
                'validity_period' => 'selalu',
                'start_date' => null,
                'end_date' => null,
                'duration_days' => null,
                'type' => 'nominal',
                'category' => 'biaya',
                'value' => 1500000,
                'status' => 'aktif',
            ],

            // ===== FASILITAS =====
            [
                'name' => 'AC 1 PK',
                'description' => 'Biaya pemasangan AC 1 PK per unit',
                'validity_period' => 'selalu',
                'start_date' => null,
                'end_date' => null,
                'duration_days' => null,
                'type' => 'nominal',
                'category' => 'fasilitas',
                'value' => 3500000,
                'status' => 'aktif',
            ],
            [
                'name' => 'Water Heater',
                'description' => 'Pemasangan water heater di kamar mandi utama',
                'validity_period' => 'selalu',
                'start_date' => null,
                'end_date' => null,
                'duration_days' => null,
                'type' => 'nominal',
                'category' => 'fasilitas',
                'value' => 1200000,
                'status' => 'tidak_aktif',
            ],
            [
                'name' => 'Keramik Granit',
                'description' => 'Upgrade lantai keramik ke granit',
                'validity_period' => 'selalu',
                'start_date' => null,
                'end_date' => null,
                'duration_days' => null,
                'type' => 'nominal',
                'category' => 'fasilitas',
                'value' => 7500000,
                'status' => 'aktif',
            ],
        ];

        foreach ($promos as $promo) {
            Promo::create($promo);
        }
    }
}
