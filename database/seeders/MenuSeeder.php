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
        $keuanganStaff  = Position::where('name', 'Staff Keuangan')->first();

        // Role Groups
        $allRoles       = array_values(array_filter([$admin?->id, $marketing?->id, $staffMarketing?->id, $legal?->id, $staffLegal?->id, $staffKpr?->id, $keuanganStaff?->id]));
        $marketingRoles = array_values(array_filter([$admin?->id, $marketing?->id, $staffMarketing?->id]));
        $legalRoles     = array_values(array_filter([$admin?->id, $legal?->id, $staffLegal?->id]));
        $landbankRoles  = array_values(array_filter([$admin?->id, $legal?->id, $staffLegal?->id, $keuanganStaff?->id]));
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

        // ================= 2. TANAH INDUK (LAND BANK) =================
        $properti = Menu::create([
            'name'  => 'Tanah Induk (Land Bank)',
            'icon'  => 'mdi-office-building',
            'order' => 2
        ]);
        $properti->positions()->attach($landbankRoles);

        Menu::create([
            'name'      => 'Tanah Pra Land Bank',
            'route'     => 'pralandbank.all',
            'parent_id' => $properti->id
        ])->positions()->attach($landbankRoles);

        Menu::create([
            'name'      => 'Tanah Pasca Land Bank',
            'route'     => 'properti-all',
            'parent_id' => $properti->id
        ])->positions()->attach($landbankRoles);

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

        // ================= 3. DOKUMEN (LEGALITAS) =================
        $document = Menu::create([
            'name'  => 'Dokumen',
            'icon'  => 'mdi-file-document-multiple-outline',
            'order' => 3
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

        // ================= 4. LEGAL UNIT =================
        $legalUnitMenu = Menu::create([
            'name'  => 'Unit',
            'route' => 'legal.unit.index',
            'icon'  => 'mdi-home-city-outline',
            'order' => 4
        ]);
        $legalUnitMenu->positions()->attach($legalRoles);

        // ================= 5. PERIZINAN (LABEL PERIZINAN SENDIRI) =================
        $tugasPerizinanMenu = Menu::create([
            'name'  => 'Tugas Perizinan',
            'route' => 'perizinan.tugas.index',
            'icon'  => 'mdi-clipboard-account-outline',
            'order' => 5
        ]);
        $tugasPerizinanMenu->positions()->attach($legalRoles);

        $perizinanMenu = Menu::create([
            'name'  => 'Perizinan',
            'route' => 'perizinan.index',
            'icon'  => 'mdi-file-certificate-outline',
            'order' => 6
        ]);
        $perizinanMenu->positions()->attach($legalRoles);

        $masterDokumenMenu = Menu::create([
            'name'  => 'Master Dokumen Perizinan',
            'route' => 'master.dokumen-perizinan.index',
            'icon'  => 'mdi-file-cog-outline',
            'order' => 6.5
        ]);
        $masterDokumenMenu->positions()->attach($legalRoles);

        // ================= 6. PROYEK, PENGOLAHAN LAHAN & UNIT (ADMIN ONLY) =================
        $proyekMasterMenu = Menu::create([
            'name'  => 'Proyek',
            'route' => 'proyek.index',
            'icon'  => 'mdi-city-variant-outline',
            'order' => 7
        ]);
        $proyekMasterMenu->positions()->attach($adminOnly);

        $proyekMenu = Menu::create([
            'name'  => 'Pengolahan Lahan',
            'route' => 'proyek.pengolahan-lahan.index',
            'icon'  => 'mdi-hard-hat',
            'order' => 8
        ]);
        $proyekMenu->positions()->attach($adminOnly);

        $unitMenu = Menu::create([
            'name'  => 'Unit',
            'route' => 'proyek.unit.index',
            'icon'  => 'mdi-home-city-outline',
            'order' => 9
        ]);
        $unitMenu->positions()->attach($adminOnly);

        // ================= 7. MARKETING =================
        $marketingMenu = Menu::create([
            'name'  => 'Marketing',
            'icon'  => 'mdi-bullhorn',
            'order' => 7
        ]);
        $marketingMenu->positions()->attach($marketingRoles);

        Menu::create([
            'name'      => 'Catalog Unit',
            'route'     => 'marketing.jual-unit',
            'parent_id' => $marketingMenu->id
        ])->positions()->attach($marketingRoles);

        Menu::create([
            'name'      => 'Tugas Marketing',
            'route'     => 'master.data.tugas-staff-marketing',
            'parent_id' => $marketingMenu->id
        ])->positions()->attach($adminOnly);

        // ================= 8. USER =================
        $userMenu = Menu::create([
            'name'  => 'User',
            'icon'  => 'mdi-account-group',
            'order' => 8
        ]);
        $userMenu->positions()->attach($marketingRoles);

        Menu::create([
            'name'      => 'Data User',
            'route'     => 'customer.data',
            'parent_id' => $userMenu->id
        ])->positions()->attach($marketingRoles);

        Menu::create([
            'name'      => 'Data User Proyeksi',
            'route'     => 'customer.tamu',
            'parent_id' => $userMenu->id
        ])->positions()->attach($marketingRoles);

        // ================= 9. TRANSAKSI (KPR) =================
        $transaksi = Menu::create([
            'name'  => 'Transaksi',
            'icon'  => 'mdi-cash-multiple',
            'order' => 9
        ]);
        $transaksi->positions()->attach($kprTransaksiRoles);

        $transaksiMenus = [
            'marketing.list_pengajuan' => ['name' => 'User Booking', 'roles' => $kprTransaksiRoles],
            'customer.kpr'             => ['name' => 'KPR', 'roles' => $kprTransaksiRoles],
            'kpr.customer-verified'    => ['name' => 'User verifikasi dokumen kpr', 'roles' => $kprTransaksiRoles],
            'customer.kpr.survey'      => ['name' => 'User Acc kpr', 'roles' => $kprTransaksiRoles],
            'customer.kpr.rijected'    => ['name' => 'User Rijected kpr', 'roles' => $marketingRoles],
            'cash-tempo.timeline'      => ['name' => 'User Cash Tempo', 'roles' => $marketingRoles],
            'analisa.kpr.komersil'     => ['name' => 'User KPR Komersil', 'roles' => $marketingRoles],
        ];

        foreach ($transaksiMenus as $route => $config) {
            Menu::create([
                'name'      => $config['name'],
                'route'     => $route,
                'parent_id' => $transaksi->id
            ])->positions()->attach($config['roles']);
        }

        // ================= 10. KEUANGAN =================
        $keuanganRoles = array_values(array_filter([$admin?->id, $keuanganStaff?->id]));

        $keuangan = Menu::create([
            'name'  => 'Keuangan',
            'icon'  => 'mdi-cash-register',
            'order' => 10
        ]);
        $keuangan->positions()->attach($keuanganRoles);

        Menu::create([
            'name'      => 'Master Biaya Legalitas & Admin',
            'route'     => 'master.biaya-legalitas.index',
            'parent_id' => $keuangan->id,
            'order'     => 2
        ])->positions()->attach($keuanganRoles);

        Menu::create([
            'name'      => 'Master Fee Agency',
            'route'     => 'marketing.commission-rules.index',
            'parent_id' => $keuangan->id,
            'order'     => 3
        ])->positions()->attach($keuanganRoles);

        Menu::create([
            'name'      => 'Master HPP & Project Accounting',
            'route'     => 'keuangan.project-accounting.index',
            'parent_id' => $keuangan->id,
            'order'     => 4
        ])->positions()->attach($keuanganRoles);

        Menu::create([
            'name'      => 'Pencairan Dana KPR',
            'route'     => 'finance.kpr-disbursement.index',
            'parent_id' => $keuangan->id,
            'order'     => 5
        ])->positions()->attach($keuanganRoles);

        Menu::create([
            'name'      => 'Master Invoice',
            'route'     => 'keuangan.master-invoice.index',
            'parent_id' => $keuangan->id,
            'order'     => 6
        ])->positions()->attach($keuanganRoles);

        // ================= 11. MASTER DATA (ADMIN ONLY) =================
        $master = Menu::create([
            'name'  => 'Master Data',
            'icon'  => 'mdi-wrench',
            'order' => 11
        ]);
        $master->positions()->attach($adminOnly);

        Menu::create([
            'name'      => 'Role & Permission',
            'route'     => 'master.data.menu',
            'parent_id' => $master->id
        ])->positions()->attach($adminOnly);

        Menu::create([
            'name'      => 'Master Barang / Bahan',
            'route'     => 'master.bahan.index',
            'parent_id' => $master->id
        ])->positions()->attach($adminOnly);

        Menu::create([
            'name'      => 'Master Tahapan Progress Unit',
            'route'     => 'master.progress.index',
            'parent_id' => $master->id
        ])->positions()->attach($adminOnly);

        Menu::create([
            'name'      => 'Data Notaris',
            'route'     => 'notaris.index',
            'parent_id' => $master->id
        ])->positions()->attach(array_values(array_filter([$admin?->id, $marketing?->id, $keuanganStaff?->id])));

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

        // ================= 12. PENGGUNA =================
        $penggunaRoles = array_values(array_filter([$admin?->id, $marketing?->id]));

        $pengguna = Menu::create([
            'name'  => 'Pengguna',
            'icon'  => 'mdi-account-tie',
            'order' => 12
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

        // ================= 13. LAPORAN =================
        Menu::create([
            'name'  => 'Laporan',
            'icon'  => 'mdi-chart-bar',
            'order' => 13
        ])->positions()->attach($adminOnly);

        // ================= 14. PENGATURAN =================
        Menu::create([
            'name'  => 'Pengaturan',
            'route' => 'setting.index',
            'icon'  => 'mdi-cog',
            'order' => 14
        ])->positions()->attach($adminOnly);
    }
}
