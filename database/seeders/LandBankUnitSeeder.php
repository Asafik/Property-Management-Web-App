<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LandBank;
use App\Models\CompanyProfile;

class LandBankUnitSeeder extends Seeder
{
    /**
     * Run the database seeds for LandBank. Seluruh unit kavling dihapus dari seeder.
     */
    public function run(): void
    {
        $company = CompanyProfile::first();
        $companyId = $company ? $company->id : 1;

        // 1. Pastikan Ada LandBank (Kawasan Proyek)
        LandBank::firstOrCreate(
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

        LandBank::firstOrCreate(
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

        // Seluruh pembuatan unit kavling dihapus dari seeder sesuai permintaan agar unit tidak di-seed otomatis.
    }
}
