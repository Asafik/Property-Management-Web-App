<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CompanyProfile;
use Carbon\Carbon;

class CompanyProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \Illuminate\Support\Facades\Schema::disableForeignKeyConstraints();
        CompanyProfile::truncate();
        \Illuminate\Support\Facades\Schema::enableForeignKeyConstraints();

        CompanyProfile::create([
            'id'         => 1,
            'name'       => 'PT. Graha Cipta Sejahtera',
            'address'    => 'Jl. Letjen Sutoyo No. 99 A Jember',
            'phone'      => '0331-331447 / 0331-321533',
            'file_akta_pendirian' => null,
            'file_akta_perubahan' => null,
            'file_npwp'           => null,
            'file_direksi'        => null,
            'file_nib'            => null,
            'file_domisili'       => null,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
