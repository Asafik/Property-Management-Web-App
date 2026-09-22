<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LandBank;
use App\Models\LandBankUnit;
use App\Models\CompanyProfile;

class LandBankUnitSeeder extends Seeder
{
    /**
     * Run the database seeds for LandBank and LandBankUnits.
     */
    public function run(): void
    {
        $company = CompanyProfile::first();
        $companyId = $company ? $company->id : 1;

        // 1. Pastikan Ada LandBank (Kawasan Proyek)
        $land1 = LandBank::firstOrCreate(
            ['name' => 'Perumahan Jember Indah'],
            [
                'company_profile_id' => $companyId,
                'area'               => 15000,
                'remaining_area'     => 15000,
                'acquisition_price'  => 4500000000,
                'acquisition_date'   => now()->subMonths(6)->toDateString(),
                'address'            => 'Jl. Hayam Wuruk No. 45',
                'village'            => 'Sempusari',
                'district'           => 'Kaliwates',
                'city'               => 'Jember',
                'province'           => 'Jawa Timur',
                'postal_code'        => '68131',
                'ownership_status'   => 'SHGB Induk',
                'status'             => 'active',
                'legal_status'       => 'verified',
                'development_status' => 'Sedang Dibangun',
                'lat'                => -8.1845,
                'lng'                => 113.6680,
            ]
        );

        $land2 = LandBank::firstOrCreate(
            ['name' => 'Graha Harmoni Kaliwates'],
            [
                'company_profile_id' => $companyId,
                'area'               => 12000,
                'remaining_area'     => 12000,
                'acquisition_price'  => 3800000000,
                'acquisition_date'   => now()->subMonths(4)->toDateString(),
                'address'            => 'Jl. Gajah Mada Blok B',
                'village'            => 'Jember Kidul',
                'district'           => 'Kaliwates',
                'city'               => 'Jember',
                'province'           => 'Jawa Timur',
                'postal_code'        => '68132',
                'ownership_status'   => 'SHGB Induk',
                'status'             => 'active',
                'legal_status'       => 'verified',
                'development_status' => 'Sedang Dibangun',
                'lat'                => -8.1725,
                'lng'                => 113.6820,
            ]
        );

        // 2. Daftar Unit Proyek Kawasan
        $unitsData = [
            // Proyek 1: Perumahan Jember Indah
            [
                'land_bank_id'          => $land1->id,
                'unit_code'             => 'A-01',
                'block'                 => 'A',
                'unit_number'           => '01',
                'unit_name'             => 'Tipe 36/72 Standar',
                'type'                  => '36/72',
                'jenis'                 => 'subsidi',
                'area'                  => 72,
                'building_area'         => 36,
                'price'                 => 168000000,
                'ijb_price'             => 168000000,
                'ajb_price'             => 168000000,
                'status'                => 'sold',
                'construction_progress' => 'selesai',
            ],
            [
                'land_bank_id'          => $land1->id,
                'unit_code'             => 'A-02',
                'block'                 => 'A',
                'unit_number'           => '02',
                'unit_name'             => 'Tipe 36/72 Standar',
                'type'                  => '36/72',
                'jenis'                 => 'subsidi',
                'area'                  => 72,
                'building_area'         => 36,
                'price'                 => 168000000,
                'ijb_price'             => 168000000,
                'ajb_price'             => 168000000,
                'status'                => 'booked',
                'construction_progress' => 'finishing',
            ],
            [
                'land_bank_id'          => $land1->id,
                'unit_code'             => 'A-03',
                'block'                 => 'A',
                'unit_number'           => '03',
                'unit_name'             => 'Tipe 36/72 Standar',
                'type'                  => '36/72',
                'jenis'                 => 'subsidi',
                'area'                  => 72,
                'building_area'         => 36,
                'price'                 => 168000000,
                'ijb_price'             => 168000000,
                'ajb_price'             => 168000000,
                'status'                => 'ready',
                'construction_progress' => 'dinding',
            ],
            [
                'land_bank_id'          => $land1->id,
                'unit_code'             => 'B-01',
                'block'                 => 'B',
                'unit_number'           => '01',
                'unit_name'             => 'Tipe 45/84 Hook',
                'type'                  => '45/84',
                'jenis'                 => 'komersil',
                'area'                  => 84,
                'building_area'         => 45,
                'price'                 => 320000000,
                'ijb_price'             => 320000000,
                'ajb_price'             => 320000000,
                'status'                => 'sold',
                'construction_progress' => 'selesai',
            ],
            [
                'land_bank_id'          => $land1->id,
                'unit_code'             => 'B-02',
                'block'                 => 'B',
                'unit_number'           => '02',
                'unit_name'             => 'Tipe 45/84 Standar',
                'type'                  => '45/84',
                'jenis'                 => 'komersil',
                'area'                  => 84,
                'building_area'         => 45,
                'price'                 => 295000000,
                'ijb_price'             => 295000000,
                'ajb_price'             => 295000000,
                'status'                => 'booked',
                'construction_progress' => 'atap',
            ],
            [
                'land_bank_id'          => $land1->id,
                'unit_code'             => 'B-03',
                'block'                 => 'B',
                'unit_number'           => '03',
                'unit_name'             => 'Tipe 45/84 Standar',
                'type'                  => '45/84',
                'jenis'                 => 'komersil',
                'area'                  => 84,
                'building_area'         => 45,
                'price'                 => 295000000,
                'ijb_price'             => 295000000,
                'ajb_price'             => 295000000,
                'status'                => 'ready',
                'construction_progress' => 'pondasi',
            ],

            // Proyek 2: Graha Harmoni Kaliwates
            [
                'land_bank_id'          => $land2->id,
                'unit_code'             => 'C-01',
                'block'                 => 'C',
                'unit_number'           => '01',
                'unit_name'             => 'Tipe 36/60 Subsidi',
                'type'                  => '36/60',
                'jenis'                 => 'subsidi',
                'area'                  => 60,
                'building_area'         => 36,
                'price'                 => 162000000,
                'ijb_price'             => 162000000,
                'ajb_price'             => 162000000,
                'status'                => 'sold',
                'construction_progress' => 'selesai',
            ],
            [
                'land_bank_id'          => $land2->id,
                'unit_code'             => 'C-02',
                'block'                 => 'C',
                'unit_number'           => '02',
                'unit_name'             => 'Tipe 36/60 Subsidi',
                'type'                  => '36/60',
                'jenis'                 => 'subsidi',
                'area'                  => 60,
                'building_area'         => 36,
                'price'                 => 162000000,
                'ijb_price'             => 162000000,
                'ajb_price'             => 162000000,
                'status'                => 'booked',
                'construction_progress' => 'dinding',
            ],
            [
                'land_bank_id'          => $land2->id,
                'unit_code'             => 'C-03',
                'block'                 => 'C',
                'unit_number'           => '03',
                'unit_name'             => 'Tipe 36/60 Subsidi',
                'type'                  => '36/60',
                'jenis'                 => 'subsidi',
                'area'                  => 60,
                'building_area'         => 36,
                'price'                 => 162000000,
                'ijb_price'             => 162000000,
                'ajb_price'             => 162000000,
                'status'                => 'ready',
                'construction_progress' => 'belum_mulai',
            ],
            [
                'land_bank_id'          => $land2->id,
                'unit_code'             => 'D-01',
                'block'                 => 'D',
                'unit_number'           => '01',
                'unit_name'             => 'Tipe 54/105 Premium',
                'type'                  => '54/105',
                'jenis'                 => 'komersil',
                'area'                  => 105,
                'building_area'         => 54,
                'price'                 => 450000000,
                'ijb_price'             => 450000000,
                'ajb_price'             => 450000000,
                'status'                => 'ready',
                'construction_progress' => 'finishing',
            ],
        ];

        foreach ($unitsData as $u) {
            LandBankUnit::firstOrCreate(
                [
                    'land_bank_id' => $u['land_bank_id'],
                    'unit_code'    => $u['unit_code'],
                ],
                $u
            );
        }
    }
}
