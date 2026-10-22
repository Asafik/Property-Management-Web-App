<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Division;
use App\Models\Position;
use App\Models\Employee;
use App\Models\Menu;
use Illuminate\Support\Facades\Hash;

class KprStaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Pastikan Divisi Bank Ada
        $division = Division::firstOrCreate(
            ['name' => 'Bank'],
            ['name' => 'Bank']
        );

        // 2. Pastikan Jabatan KPR / Staff KPR Ada
        $position = Position::firstOrCreate(
            ['name' => 'Staff KPR'],
            [
                'name' => 'Staff KPR',
                'division_id' => $division->id
            ]
        );

        // Update jika division_id belum sesuai
        if ($position->division_id != $division->id) {
            $position->update(['division_id' => $division->id]);
        }

        // 3. Buat Pengguna / Login Staff KPR
        $employee = Employee::updateOrCreate(
            ['username' => 'staffkpr'],
            [
                'name'        => 'Staff KPR',
                'username'    => 'staffkpr',
                'password'    => Hash::make('password'),
                'division_id' => $division->id,
                'position_id' => $position->id,
                'phone'       => '08123456780',
                'address'     => 'Jember'
            ]
        );

        // Juga buat alias username 'kpr' jika diperlukan
        Employee::updateOrCreate(
            ['username' => 'kpr'],
            [
                'name'        => 'Staff KPR',
                'username'    => 'kpr',
                'password'    => Hash::make('password'),
                'division_id' => $division->id,
                'position_id' => $position->id,
                'phone'       => '08123456780',
                'address'     => 'Jember'
            ]
        );

        // 4. Hubungkan Akses Menu ke Posisi Staff KPR
        // Daftar route yang wajib diakses Staff KPR:
        $routes = [
            'dashboard',              // Dashboard
            'customer.kpr',          // Cicilan / KPR
            'kpr.customer-verified', // User verifikasi dokumen kpr
            'customer.kpr.survey',   // User Acc kpr
        ];

        // Cari menu berdasarkan route
        $menus = Menu::whereIn('route', $routes)->get();

        foreach ($menus as $menu) {
            $menu->positions()->syncWithoutDetaching([$position->id]);

            // Jika menu memiliki parent (seperti Transaksi), otomatis kaitkan parent menu
            if ($menu->parent_id) {
                $parent = Menu::find($menu->parent_id);
                if ($parent) {
                    $parent->positions()->syncWithoutDetaching([$position->id]);
                }
            }
        }

        // Pastikan Parent Menu 'Transaksi' juga terpasang
        $transaksiParent = Menu::where('name', 'Transaksi')->first();
        if ($transaksiParent) {
            $transaksiParent->positions()->syncWithoutDetaching([$position->id]);
        }

        $this->command->info("Seeder Staff KPR berhasil dijalankan!");
        $this->command->info("Username: staffkpr (atau 'kpr') | Password: password");
    }
}
