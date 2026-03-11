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
        $documentTypes = [
            [
                'name' => 'IMB',
                'code' => 'IMB',
                'has_expiry' => false,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Akta Tanah',
                'code' => 'AKTA_TANAH',
                'has_expiry' => false,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Sertifikat',
                'code' => 'SERTIFIKAT',
                'has_expiry' => false,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        foreach ($documentTypes as $type) {
            DocumentTypes::create($type);
        }
    }
}
