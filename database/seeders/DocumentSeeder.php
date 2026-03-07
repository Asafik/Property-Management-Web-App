<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('documents')->insert([
            [
                'name' => 'KTP',
                'description' => 'Kartu Tanda Penduduk',
                'required' => true,
                'accept' => '.jpg,.jpeg,.png,.pdf',
                'icon' => 'mdi-card-account-details',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'NPWP',
                'description' => 'Nomor Pokok Wajib Pajak',
                'required' => true,
                'accept' => '.jpg,.jpeg,.png,.pdf',
                'icon' => 'mdi-file-document',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Kartu Keluarga',
                'description' => 'Kartu Keluarga',
                'required' => true,
                'accept' => '.jpg,.jpeg,.png,.pdf',
                'icon' => 'mdi-book-open',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Buku Nikah',
                'description' => 'Jika sudah menikah',
                'required' => false,
                'accept' => '.jpg,.jpeg,.png,.pdf',
                'icon' => 'mdi-ring',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Akta Cerai',
                'description' => 'Jika sudah bercerai',
                'required' => false,
                'accept' => '.jpg,.jpeg,.png,.pdf',
                'icon' => 'mdi-file-document',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Ijazah Terakhir',
                'description' => 'Pendidikan terakhir',
                'required' => true,
                'accept' => '.jpg,.jpeg,.png,.pdf',
                'icon' => 'mdi-school',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'SKCK',
                'description' => 'Surat Keterangan Catatan Kepolisian',
                'required' => false,
                'accept' => '.jpg,.jpeg,.png,.pdf',
                'icon' => 'mdi-police-badge',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Surat Keterangan Kerja',
                'description' => 'Dari perusahaan tempat bekerja',
                'required' => false,
                'accept' => '.jpg,.jpeg,.png,.pdf',
                'icon' => 'mdi-briefcase',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Slip Gaji',
                'description' => '3 bulan terakhir',
                'required' => false,
                'accept' => '.jpg,.jpeg,.png,.pdf',
                'icon' => 'mdi-cash',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Rekening Koran',
                'description' => '3 bulan terakhir',
                'required' => false,
                'accept' => '.jpg,.jpeg,.png,.pdf',
                'icon' => 'mdi-bank',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Pas Foto',
                'description' => 'Ukuran 3x4 atau 4x6',
                'required' => false,
                'accept' => '.jpg,.jpeg,.png',
                'icon' => 'mdi-face',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Tanda Tangan',
                'description' => 'Scan tanda tangan basah',
                'required' => false,
                'accept' => '.jpg,.jpeg,.png',
                'icon' => 'mdi-signature-freehand',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}