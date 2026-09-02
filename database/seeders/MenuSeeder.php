<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu;
use App\Models\Position;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Truncate existing menu data to avoid duplicate entries
        Schema::disableForeignKeyConstraints();
        DB::table('menu_position')->truncate();
        DB::table('menus')->truncate();
        Schema::enableForeignKeyConstraints();

        // Ambil posisi yang ada
        $admin          = Position::where('name', 'Admin')->first();
        $marketing      = Position::where('name', 'Kepala Marketing')->first();
        $staffMarketing = Position::where('name', 'Staff Marketing')->first();
        $legal          = Position::where('name', 'Kepala Legal')->first();
        $staffLegal     = Position::where('name', 'Staff Legal')->first();
        $staffKpr       = Position::where('name', 'Staff KPR')->orWhere('name', 'KPR')->first();

        // Role Groups
        $allRoles       = array_values(array_filter([$admin?->id, $marketing?->id, $staffMarketing?->id, $legal?->id, $staffLegal?->id, $staffKpr?->id]));
        $marketingRoles = array_values(array_filter([$admin?->id, $marketing?->id, $staffMarketing?->id]));
        $legalRoles     = array_values(array_filter([$admin?->id, $legal?->id, $staffLegal?->id]));
        $adminOnly      = array_values(array_filter([$admin?->id]));
        $kprTransaksiRoles = array_values(array_filter([$admin?->id, $marketing?->id, $staffMarketing?->id, $staffKpr?->id]));

        // ================= 1. DASHBOARD =================
        $dashboard = Menu::create([
            'name'  => 'Dashboard',
            'route' => 'dashboard',
            'icon'  => 'mdi-home',
            'order' => 1
        ]);
        $dashboard->positions()->attach($allRoles);

        // ================= 2. MARKETING =================
        $marketingMenu = Menu::create([
            'name'  => 'Marketing',
            'icon'  => 'mdi-bullhorn',
            'order' => 2
        ]);
        $marketingMenu->positions()->attach($marketingRoles);

        Menu::create([
            'name'      => 'Catalog Unit',
            'route'     => 'marketing.jual-unit',
            'parent_id' => $marketingMenu->id
        ])->positions()->attach($marketingRoles);

        Menu::create([
            'name'      => 'User Booking',
            'route'     => 'marketing.list_pengajuan',
            'parent_id' => $marketingMenu->id
        ])->positions()->attach($marketingRoles);

        Menu::create([
            'name'      => 'Tugas Marketing',
            'route'     => 'master.data.tugas-staff-marketing',
            'parent_id' => $marketingMenu->id
        ])->positions()->attach($adminOnly);

        // ================= 3. TANAH INDUK (LAND BANK) =================
        $properti = Menu::create([
            'name'  => 'Tanah Induk (Land Bank)',
            'icon'  => 'mdi-office-building',
            'order' => 3
        ]);
        $properti->positions()->attach($legalRoles);

        Menu::create([
            'name'      => 'Semua Tanah Pra Land Bank',
            'route'     => 'pralandbank.all',
            'parent_id' => $properti->id
        ])->positions()->attach($legalRoles);

        Menu::create([
            'name'      => 'Semua Tanah Pasca Land Bank',
            'route'     => 'properti-all',
            'parent_id' => $properti->id
        ])->positions()->attach($legalRoles);

        Menu::create([
            'name'      => 'Tambah Kavling',
            'route'     => 'kavling.index',
            'parent_id' => $properti->id
        ])->positions()->attach($legalRoles);

        Menu::create([
            'name'      => 'Lokasi',
            'route'     => 'lokasi.index',
            'parent_id' => $properti->id
        ])->positions()->attach($legalRoles);

        // ================= 4. USER =================
        $userMenu = Menu::create([
            'name'  => 'User',
            'icon'  => 'mdi-account-group',
            'order' => 4
        ]);
        $userMenu->positions()->attach($adminOnly);

        Menu::create([
            'name'      => 'Data User',
            'route'     => 'customer.data',
            'parent_id' => $userMenu->id
        ])->positions()->attach($adminOnly);

        Menu::create([
            'name'      => 'Data User Proyeksi',
            'route'     => 'customer.tamu',
            'parent_id' => $userMenu->id
        ])->positions()->attach($adminOnly);

        // ================= 5. TRANSAKSI =================
        $transaksi = Menu::create([
            'name'  => 'Transaksi',
            'icon'  => 'mdi-cash-multiple',
            'order' => 5
        ]);
        $transaksi->positions()->attach($kprTransaksiRoles);

        $transaksiMenus = [
            'customer.kpr'          => ['name' => 'Cicilan / KPR', 'roles' => $kprTransaksiRoles],
            'kpr.customer-verified' => ['name' => 'User verifikasi dokumen kpr', 'roles' => $kprTransaksiRoles],
            'customer.kpr.survey'   => ['name' => 'User Acc kpr', 'roles' => $kprTransaksiRoles],
            'customer.kpr.rijected' => ['name' => 'User Rijected kpr', 'roles' => $marketingRoles],
            'cash-tempo.timeline'   => ['name' => 'User Cash Tempo', 'roles' => $marketingRoles],
            'analisa.kpr.komersil'  => ['name' => 'User KPR Komersil', 'roles' => $marketingRoles],
        ];

        foreach ($transaksiMenus as $route => $config) {
            Menu::create([
                'name'      => $config['name'],
                'route'     => $route,
                'parent_id' => $transaksi->id
            ])->positions()->attach($config['roles']);
        }

        // ================= 6. DOCUMENT =================
        $document = Menu::create([
            'name'  => 'Document',
            'icon'  => 'mdi-file-document-box-multiple-outline',
            'order' => 6
        ]);
        $document->positions()->attach($legalRoles);

        $docMenus = [
            'dokument.index'                => 'Tanah Induk (LandBank)',
            'dokument.persiapan'            => 'Pecah Tanah Induk Unit',
            'document.user.persiapan-legal' => 'Data User Persiapan Pecah Legal',
            'spk.index'                     => 'SPK Kontraktor'
        ];

        foreach ($docMenus as $route => $name) {
            Menu::create([
                'name'      => $name,
                'route'     => $route,
                'parent_id' => $document->id
            ])->positions()->attach($legalRoles);
        }

        // ================= 7. PENGGUNA =================
        $penggunaRoles = array_values(array_filter([$admin?->id, $marketing?->id]));

        $pengguna = Menu::create([
            'name'  => 'Pengguna',
            'icon'  => 'mdi-account-tie',
            'order' => 7
        ]);
        $pengguna->positions()->attach($penggunaRoles);

        Menu::create([
            'name'      => 'Buat Pengguna',
            'route'     => 'agency.create',
            'parent_id' => $pengguna->id
        ])->positions()->attach($penggunaRoles);

        Menu::create([
            'name'      => 'Data Pengguna',
            'route'     => 'agency.index',
            'parent_id' => $pengguna->id
        ])->positions()->attach($penggunaRoles);

        // ================= 8. MASTER DATA =================
        $kepalaLegalAndAdmin = array_values(array_filter([$admin?->id, $legal?->id]));

        $master = Menu::create([
            'name'  => 'Master Data',
            'icon'  => 'mdi-wrench',
            'order' => 8
        ]);
        $master->positions()->attach($kepalaLegalAndAdmin);

        Menu::create([
            'name'      => 'Role & Permission',
            'route'     => 'master.data.menu',
            'parent_id' => $master->id
        ])->positions()->attach($adminOnly);

        Menu::create([
            'name'      => 'Master Barang / Bahan',
            'route'     => 'master.bahan.index',
            'parent_id' => $master->id
        ])->positions()->attach($kepalaLegalAndAdmin);

        Menu::create([
            'name'      => 'Master SPK',
            'route'     => 'spk.index',
            'parent_id' => $master->id
        ])->positions()->attach($kepalaLegalAndAdmin);

        $masterMenus = [
            'promo.index'                => 'Promo',
            'company-profile.index'      => 'PT',
            'servis'                     => 'Servis',
            'bank.index'                 => 'Data Bank',
            'rab.deadline.index'         => 'Deadline RAB',
            'master.data.division.index' => 'Divisi',
            'master.data.posisi'         => 'Posisi',
        ];

        foreach ($masterMenus as $route => $name) {
            Menu::create([
                'name'      => $name,
                'route'     => $route,
                'parent_id' => $master->id
            ])->positions()->attach($adminOnly);
        }

        // ================= 9. KEUANGAN =================
        $keuanganRoles = array_values(array_filter([$admin?->id, $marketing?->id, $staffMarketing?->id, $legal?->id]));

        $keuangan = Menu::create([
            'name'  => 'Keuangan',
            'icon'  => 'mdi-cash-register',
            'order' => 9
        ]);
        $keuangan->positions()->attach($keuanganRoles);

        Menu::create([
            'name'      => 'Master HPP & Project Accounting',
            'route'     => 'keuangan.project-accounting.index',
            'parent_id' => $keuangan->id
        ])->positions()->attach($keuanganRoles);

        Menu::create([
            'name'      => 'Master Invoice',
            'route'     => 'keuangan.master-invoice.index',
            'parent_id' => $keuangan->id
        ])->positions()->attach($marketingRoles);

        Menu::create([
            'name'      => 'Master Fee Agency',
            'route'     => 'marketing.commission-rules.index',
            'parent_id' => $keuangan->id
        ])->positions()->attach($marketingRoles);

        // ================= 10. LAPORAN =================
        Menu::create([
            'name'  => 'Laporan',
            'icon'  => 'mdi-chart-bar',
            'order' => 10
        ])->positions()->attach($adminOnly);

        // ================= 11. PENGATURAN =================
        Menu::create([
            'name'  => 'Pengaturan',
            'route' => 'setting.index',
            'icon'  => 'mdi-cog',
            'order' => 11
        ])->positions()->attach($adminOnly);
    }
}
