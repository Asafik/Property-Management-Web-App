<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\Position;
use Illuminate\Database\Seeder;

class MasterBiayaLegalitasMenuSeeder extends Seeder
{
    public function run(): void
    {
        $master = Menu::where('name', 'Master Data')->first();
        if ($master) {
            $menu = Menu::updateOrCreate(
                ['route' => 'master.biaya-legalitas.index'],
                [
                    'name'      => 'Master Biaya Legalitas & Admin',
                    'parent_id' => $master->id,
                    'icon'      => 'mdi-cash-multiple',
                    'order'     => 2
                ]
            );

            // Sync with positions: Admin, Keuangan, Legal
            $admin          = Position::where('name', 'Admin')->first();
            $legal          = Position::where('name', 'Kepala Legal')->first();
            $staffLegal     = Position::where('name', 'Staff Legal')->first();
            $keuanganStaff  = Position::where('name', 'Staff Keuangan')->first();

            $targetPositions = array_values(array_filter([
                $admin?->id,
                $legal?->id,
                $staffLegal?->id,
                $keuanganStaff?->id,
            ]));

            if (!empty($targetPositions)) {
                $menu->positions()->syncWithoutDetaching($targetPositions);
                $master->positions()->syncWithoutDetaching($targetPositions);
            }
        }
    }
}

