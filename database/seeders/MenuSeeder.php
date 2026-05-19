<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Menu;
use App\Models\Position;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
{
    // Ambil posisi
    $admin = Position::where('name', 'Admin')->first();
    $marketing = Position::where('name', 'Kepala Marketing')->first();
    $staffMarketing = Position::where('name', 'Staff Marketing')->first();
    $legal = Position::where('name', 'Kepala Legal')->first();

    // ================= DASHBOARD =================
    $dashboard = Menu::create([
        'name' => 'Dashboard',
        'route' => 'dashboard',
        'icon' => 'mdi-home',
        'order' => 1
    ]);

    $dashboard->positions()->attach([$admin->id, $marketing->id, $staffMarketing->id, $legal->id]);

    // ================= MARKETING =================
    $marketingMenu = Menu::create([
        'name' => 'Marketing',
        'icon' => 'mdi-bullhorn',
        'order' => 2
    ]);

    $marketingMenu->positions()->attach([$admin->id, $marketing->id, $staffMarketing->id]);

    Menu::create([
        'name' => 'Catalog Unit',
        'route' => 'marketing.jual-unit',
        'parent_id' => $marketingMenu->id
    ])->positions()->attach([$admin->id, $marketing->id, $staffMarketing->id]);

    Menu::create([
        'name' => 'User Booking',
        'route' => 'marketing.list_pengajuan',
        'parent_id' => $marketingMenu->id
    ])->positions()->attach([$admin->id, $marketing->id, $staffMarketing->id]);


    // ================= PROPERTI =================
    $properti = Menu::create([
        'name' => 'Tanah Induk (Land Bank)',
        'icon' => 'mdi-office-building',
        'order' => 3
    ]);

    $properti->positions()->attach([$admin->id, $legal->id]);

    Menu::create([
        'name' => 'Semua Tanah Pra Land Bank',
        'route' => 'pralandbank.all',
        'parent_id' => $properti->id
    ])->positions()->attach([$admin->id, $legal->id]);

    Menu::create([
        'name' => 'Semua Tanah Pasca Land Bank',
        'route' => 'properti-all',
        'parent_id' => $properti->id
    ])->positions()->attach([$admin->id, $legal->id]);

    Menu::create([
        'name' => 'Tambah Kavling',
        'route' => 'kavling.index',
        'parent_id' => $properti->id
    ])->positions()->attach([$admin->id, $legal->id]);

    Menu::create([
        'name' => 'Lokasi',
        'route' => 'lokasi.index',
        'parent_id' => $properti->id
    ])->positions()->attach([$admin->id, $legal->id]);

    // ================= USER =================
    $userMenu = Menu::create([
        'name' => 'User',
        'icon' => 'mdi-account-group',
        'order' => 4

    ]);

    Menu::create([
        'name' => 'Data User',
        'route' => 'customer.data',
        'parent_id' => $userMenu->id
    ]);

    Menu::create([
        'name' => 'Data User Proyeksi',
        'route' => 'customer.tamu',
        'parent_id' => $userMenu->id
    ]);

    // ================= TRANSAKSI =================
    $transaksi = Menu::create([
        'name' => 'Transaksi',
        'icon' => 'mdi-cash-multiple',
        'order' => 5
    ]);

    $transaksiMenus = [
        'customer.kpr' => 'Cicilan / KPR',
        'kpr.customer-verified' => 'User verifikasi dokumen kpr',
        'customer.kpr.survey' => 'User Acc kpr',
        'customer.kpr.rijected' => 'User Rijected kpr',
        'cash-tempo.timeline' => 'User Cash Tempo',
        'analisa.kpr.komersil' => 'User KPR Komersil',
    ];

    foreach ($transaksiMenus as $route => $name) {
        Menu::create([
            'name' => $name,
            'route' => $route,
            'parent_id' => $transaksi->id
        ]);
    }

    // ================= DOCUMENT =================
    $document = Menu::create([
        'name' => 'Document',
        'icon' => 'mdi-account-cog',
        'order' => 6
    ]);

    $document->positions()->attach([$admin->id]);

    $docMenus = [
        'dokument.index' => 'Tanah Induk (LandBank)',
        'dokument.persiapan' => 'Pecah Tanah Induk Unit',
        'document.user.persiapan-legal' => 'Data User Persiapan Pecah Legal'
    ];

    foreach ($docMenus as $route => $name) {
        Menu::create([
            'name' => $name,
            'route' => $route,
            'parent_id' => $document->id
        ])->positions()->attach([$admin->id]);
    }

    // ================= PENGGUNA =================
    $pengguna = Menu::create([
        'name' => 'Pengguna',
        'icon' => 'mdi-account-tie',
        'order' => 7
    ]);

    $pengguna->positions()->attach([$admin->id]);

    Menu::create([
        'name' => 'Buat Pengguna',
        'route' => 'agency.create',
        'parent_id' => $pengguna->id
    ])->positions()->attach([$admin->id]);

    Menu::create([
        'name' => 'Data Pengguna',
        'route' => 'agency.index',
        'parent_id' => $pengguna->id
    ])->positions()->attach([$admin->id]);

   // ================= MASTER DATA =================
    $master = Menu::create([
        'name' => 'Master Data',
        'icon' => 'mdi-wrench',
        'order' => 8
    ]);

    // attach role ke parent
    $master->positions()->attach([$admin->id]);

    // ================= CHILD MENU =================

    // Role & Permission
    Menu::create([
        'name' => 'Role & Permission',
        'route' => 'master.data.menu',
        'parent_id' => $master->id
    ])->positions()->attach([$admin->id]);

    // Menu lainnya
    $masterMenus = [
        'promo.index' => 'Promo',
        'company-profile.index' => 'PT',
        'servis' => 'Servis',
        'bank.index' => 'Data Bank',
        'rab.deadline.index' => 'Deadline RAB',
        'master.data.division.index' => 'Divisi', // ✔ diperbaiki typo
        'master.data.posisi' => 'Posisi',
    ];

    foreach ($masterMenus as $route => $name) {
        Menu::create([
            'name' => $name,
            'route' => $route,
            'parent_id' => $master->id
        ])->positions()->attach([$admin->id]);
    }

    // ================= LAPORAN =================
    Menu::create([
        'name' => 'Laporan',
        'icon' => 'mdi-chart-bar',
        'order' => 9
    ]);

    // ================= PENGATURAN =================
    Menu::create([
        'name' => 'Pengaturan',
        'route' => 'setting.index',
        'icon' => 'mdi-cog',
        'order' => 10
    ])->positions()->attach([$admin->id]);
}
}
