<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Customer;
use App\Models\CustomerDocument;
use App\Models\LandBankUnit;
use App\Models\Booking;
use App\Models\Employee;
use Carbon\Carbon;

class CustomerSeeder extends Seeder
{
    public function run(): void
    {
        $unit = LandBankUnit::first();
        $landBank = $unit ? $unit->landBank : \App\Models\LandBank::first();

        // 1. Buat Customer Lengkap
        $customer = Customer::updateOrCreate(
            ['nik' => '3578011205930002'],
            [
                'customer_id' => 'CUST-' . date('Ymd') . '-001',
                'full_name' => 'Rian Hidayat, S.Kom',
                'nickname' => 'Rian',
                'no_kk' => '3578012004180005',
                'birthplace' => 'Surabaya',
                'date_birth' => '1993-05-12',
                'age' => 33,
                'gender' => 'Laki-laki',
                'religion' => 'Islam',
                'nationality' => 'WNI',
                'marital_status' => 'Menikah',
                'marital_date' => '2018-08-18',
                'child_count' => 1,

                'province' => 'JAWA TIMUR',
                'city' => 'KOTA SURABAYA',
                'subdistrict' => 'Rungkut',
                'village' => 'Kali Rungkut',
                'rt' => '003',
                'rw' => '005',
                'postal_code' => '60293',
                'address' => 'Jl. Rungkut Asri Timur No. 45, Rungkut, Surabaya',

                'domicile_province' => 'JAWA TIMUR',
                'domicile_city' => 'KOTA SURABAYA',
                'domicile_subdistrict' => 'Rungkut',
                'domicile_village' => 'Kali Rungkut',
                'domicile_rt' => '003',
                'domicile_rw' => '005',
                'domicile_postal_code' => '60293',
                'domicile_address' => 'Jl. Rungkut Asri Timur No. 45, Rungkut, Surabaya',

                'phone' => '081234567890',
                'home_phone' => '0318765432',
                'email' => 'rian.hidayat@gmail.com',
                'office_email' => 'rian.h@techcorp.co.id',

                'instagram' => '@rianhidayat',
                'facebook' => 'rian.hidayat',
                'tiktok' => '@rian.h',
                'x' => '@rian_h',

                'job_status' => 'Karyawan Swasta',
                'job_status_lainnya' => null,
                'company_name' => 'PT Nusantara Digital Solusindo',
                'main_income' => 15000000,
                'side_income' => 5000000,
                'npwp' => '82.415.762.3-604.000',

                'spouse_name' => 'Siti Nurhaliza, S.E.',
                'spouse_nik' => '3578015508950003',
                'father_name' => 'Bambang Hidayat',
                'mother_name' => 'Sri Wahyuni',

                'land_bank_id' => $landBank?->id,
                'unit_id' => $unit?->id,
            ]
        );

        // Pastikan folder uploads/customer_documents ada
        $uploadDir = public_path('uploads/customer_documents');
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        // 2. Buat Dokumen Customer (KTP, KK, NPWP, KTP Pasangan) dengan file fisik asli
        $docs = [
            [
                'name' => 'KTP',
                'file' => 'customer_documents/ktp_rian.jpg',
                'number' => '3578011205930002',
            ],
            [
                'name' => 'Kartu Keluarga',
                'file' => 'customer_documents/kk_rian.jpg',
                'number' => '3578012004180005',
            ],
            [
                'name' => 'NPWP',
                'file' => 'customer_documents/npwp_rian.jpg',
                'number' => '82.415.762.3-604.000',
            ],
            [
                'name' => 'KTP Pasangan',
                'file' => 'customer_documents/ktp_pasangan_rian.jpg',
                'number' => '3578015508950003',
            ],
        ];

        // Hapus dokumen lama untuk customer ini jika ada
        CustomerDocument::where('customer_id', $customer->id)->delete();

        foreach ($docs as $d) {
            CustomerDocument::create([
                'customer_id' => $customer->id,
                'document_name' => $d['name'],
                'document_number' => $d['number'],
                'file' => $d['file'],
                'upload_date' => now(),
                'status' => 'Terverifikasi',
            ]);
        }

        // 3. Hubungkan ke Unit 1 dan buat Active Booking
        $unit = LandBankUnit::find(1);
        if ($unit) {
            $unit->update([
                'customer_id' => $customer->id,
                'status' => 'booked',
            ]);

            $sales = Employee::first();

            Booking::updateOrCreate(
                ['unit_id' => $unit->id],
                [
                    'customer_id' => $customer->id,
                    'sales_id' => $sales ? $sales->id : null,
                    'booking_code' => 'BK-' . date('Ymd') . '-001',
                    'booking_fee' => 5000000,
                    'utj' => 5000000,
                    'agent_fee' => 2500000,
                    'booking_date' => Carbon::now()->subDays(5)->format('Y-m-d'),
                    'purchase_type' => 'kpr',
                    'status' => 'active',
                    'status_cash' => 'process',
                    'status_akad' => 'pending',
                    'status_legal' => 'pending',
                    'akad_date' => Carbon::now()->addMonths(1)->format('Y-m-d'),
                    'serah_terima_date' => Carbon::now()->addMonths(6)->format('Y-m-d'),
                    'notes' => 'Customer KPR Bank BTN. Berkas dokumen KTP, KK, NPWP, dan KTP Pasangan lengkap dan terverifikasi.',
                ]
            );
        }
    }
}