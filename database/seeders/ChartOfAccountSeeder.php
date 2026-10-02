<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ChartOfAccount;

class ChartOfAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $accounts = [
            // 1. ASET
            ['code' => '1-1001', 'name' => 'Kas Operasional Kantor', 'category' => 'asset', 'sub_category' => 'Kas & Bank', 'normal_balance' => 'debit', 'description' => 'Kas tunai kantor harian'],
            ['code' => '1-1002', 'name' => 'Kas Proyek Lapangan', 'category' => 'asset', 'sub_category' => 'Kas & Bank', 'normal_balance' => 'debit', 'description' => 'Kas kecil mandor & pengawas'],
            ['code' => '1-1010', 'name' => 'Bank Operasional Perusahaan', 'category' => 'asset', 'sub_category' => 'Kas & Bank', 'normal_balance' => 'debit', 'description' => 'Rekening bank operasional utama'],
            ['code' => '1-1020', 'name' => 'Bank Rekening Escrow / KPR', 'category' => 'asset', 'sub_category' => 'Kas & Bank', 'normal_balance' => 'debit', 'description' => 'Rekening penampungan pencairan KPR bank'],
            ['code' => '1-1101', 'name' => 'Piutang Penjualan Unit Konsumen', 'category' => 'asset', 'sub_category' => 'Piutang Usaha', 'normal_balance' => 'debit', 'description' => 'Sisa tagihan invoice/angsuran konsumen'],
            ['code' => '1-1102', 'name' => 'Piutang Pencairan KPR Bank', 'category' => 'asset', 'sub_category' => 'Piutang Usaha', 'normal_balance' => 'debit', 'description' => 'Dana KPR disetujui bank menunggu pencairan'],
            ['code' => '1-1201', 'name' => 'Persediaan Tanah Mentah (Pra-Landbank)', 'category' => 'asset', 'sub_category' => 'Persediaan Properti', 'normal_balance' => 'debit', 'description' => 'Nilai pembebasan lahan yang sedang berlangsung'],
            ['code' => '1-1202', 'name' => 'Persediaan Tanah Matang & Kaveling', 'category' => 'asset', 'sub_category' => 'Persediaan Properti', 'normal_balance' => 'debit', 'description' => 'Kaveling siap bangun setelah pengolahan lahan'],
            ['code' => '1-1203', 'name' => 'Bangunan Dalam Pengerjaan (Unit WIP)', 'category' => 'asset', 'sub_category' => 'Persediaan Properti', 'normal_balance' => 'debit', 'description' => 'Konstruksi unit dalam proses SPK'],
            ['code' => '1-1301', 'name' => 'Uang Muka Biaya & Pajak Dimuka', 'category' => 'asset', 'sub_category' => 'Aset Lancar Lainnya', 'normal_balance' => 'debit', 'description' => 'Uang muka perizinan atau biaya operasional'],

            // 2. KEWAJIBAN
            ['code' => '2-2001', 'name' => 'Hutang SPK Mandor / Kontraktor', 'category' => 'liability', 'sub_category' => 'Hutang Lancar', 'normal_balance' => 'credit', 'description' => 'Kewajiban termin SPK yang belum dibayar'],
            ['code' => '2-2002', 'name' => 'Hutang Vendor Material & Infrastruktur', 'category' => 'liability', 'sub_category' => 'Hutang Lancar', 'normal_balance' => 'credit', 'description' => 'Tagihan suplier material proyek'],
            ['code' => '2-2010', 'name' => 'Pendapatan Diterima Dimuka (Uang Muka Konsumen)', 'category' => 'liability', 'sub_category' => 'Hutang Lancar', 'normal_balance' => 'credit', 'description' => 'Booking fee & DP konsumen sebelum serah terima unit'],
            ['code' => '2-2020', 'name' => 'Hutang Pajak Proyek & Notaris', 'category' => 'liability', 'sub_category' => 'Hutang Lancar', 'normal_balance' => 'credit', 'description' => 'Kewajiban PPN/PPh/BPHTB'],

            // 3. EKUITAS
            ['code' => '3-3001', 'name' => 'Modal Disetor Pemilik', 'category' => 'equity', 'sub_category' => 'Modal Usaha', 'normal_balance' => 'credit', 'description' => 'Modal awal & tambahan modal pemilik'],
            ['code' => '3-3002', 'name' => 'Laba Ditahan', 'category' => 'equity', 'sub_category' => 'Laba Ditahan', 'normal_balance' => 'credit', 'description' => 'Akumulasi laba periode sebelumnya'],
            ['code' => '3-3003', 'name' => 'Laba Tahun Berjalan', 'category' => 'equity', 'sub_category' => 'Laba Periode Berjalan', 'normal_balance' => 'credit', 'description' => 'Laba/rugi periode berjalan dari laporan laba rugi'],

            // 4. PENDAPATAN
            ['code' => '4-4001', 'name' => 'Pendapatan Penjualan Unit KPR', 'category' => 'revenue', 'sub_category' => 'Pendapatan Properti', 'normal_balance' => 'credit', 'description' => 'Realisasi akad penjualan skema KPR'],
            ['code' => '4-4002', 'name' => 'Pendapatan Penjualan Unit Cash Keras', 'category' => 'revenue', 'sub_category' => 'Pendapatan Properti', 'normal_balance' => 'credit', 'description' => 'Pelunasan penjualan tunai keras'],
            ['code' => '4-4003', 'name' => 'Pendapatan Penjualan Unit Cash Bertempo', 'category' => 'revenue', 'sub_category' => 'Pendapatan Properti', 'normal_balance' => 'credit', 'description' => 'Angsuran pokok cash tempo konsumen'],
            ['code' => '4-4010', 'name' => 'Pendapatan Tanda Jadi (UTJ / Booking Fee)', 'category' => 'revenue', 'sub_category' => 'Pendapatan Properti', 'normal_balance' => 'credit', 'description' => 'Penerimaan booking fee unit'],
            ['code' => '4-4099', 'name' => 'Pendapatan Administrasi & Lain-lain', 'category' => 'revenue', 'sub_category' => 'Pendapatan Lain', 'normal_balance' => 'credit', 'description' => 'Biaya admin akad, perubahan denah, bunga simpanan, dll'],

            // 5. HPP
            ['code' => '5-5001', 'name' => 'HPP Pembelian & Pembebasan Lahan', 'category' => 'cogs', 'sub_category' => 'HPP Proyek', 'normal_balance' => 'debit', 'description' => 'Alokasi harga tanah per kaveling yang terjual'],
            ['code' => '5-5002', 'name' => 'HPP Konstruksi Unit (SPK Mandor & Material)', 'category' => 'cogs', 'sub_category' => 'HPP Proyek', 'normal_balance' => 'debit', 'description' => 'Biaya langsung pembangunan unit'],
            ['code' => '5-5003', 'name' => 'HPP Pembangunan Infrastruktur & Fasilitas', 'category' => 'cogs', 'sub_category' => 'HPP Proyek', 'normal_balance' => 'debit', 'description' => 'Biaya jalan, drainase, penerangan kawasan'],
            ['code' => '5-5004', 'name' => 'HPP Perizinan, Sertifikasi & Legalitas Proyek', 'category' => 'cogs', 'sub_category' => 'HPP Proyek', 'normal_balance' => 'debit', 'description' => 'Biaya pecah sertifikat, PBG/IMB, amdal'],

            // 6. BEBAN OPERASIONAL
            ['code' => '6-6001', 'name' => 'Beban Komisi Marketing & Fee Agency', 'category' => 'expense', 'sub_category' => 'Beban Pemasaran', 'normal_balance' => 'debit', 'description' => 'Fee agen & reward closing sales'],
            ['code' => '6-6002', 'name' => 'Beban Promosi, Iklan & Sosial Media', 'category' => 'expense', 'sub_category' => 'Beban Pemasaran', 'normal_balance' => 'debit', 'description' => 'Brosur, baliho, ads, expo properti'],
            ['code' => '6-6010', 'name' => 'Beban Gaji & Upah Karyawan', 'category' => 'expense', 'sub_category' => 'Beban Operasional Kantor', 'normal_balance' => 'debit', 'description' => 'Gaji tetap staf kantor & manajemen'],
            ['code' => '6-6020', 'name' => 'Beban Operasional Kantor, Listrik & Internet', 'category' => 'expense', 'sub_category' => 'Beban Operasional Kantor', 'normal_balance' => 'debit', 'description' => 'Listrik, air, wifi, ATK, pemeliharaan kantor'],
            ['code' => '6-6030', 'name' => 'Beban Jasa Notaris & Konsultan Legal', 'category' => 'expense', 'sub_category' => 'Beban Operasional Kantor', 'normal_balance' => 'debit', 'description' => 'Jasa konsultan hukum & notaris kantor'],
            ['code' => '6-6099', 'name' => 'Beban Operasional Lain-lain', 'category' => 'expense', 'sub_category' => 'Beban Operasional Kantor', 'normal_balance' => 'debit', 'description' => 'Pengeluaran umum lain yang tidak terklasifikasi'],
        ];

        foreach ($accounts as $acc) {
            ChartOfAccount::updateOrCreate(
                ['code' => $acc['code']],
                $acc
            );
        }
    }
}
