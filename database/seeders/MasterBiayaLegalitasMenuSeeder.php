<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;

class MasterBiayaLegalitasMenuSeeder extends Seeder
{
    public function run(): void
    {
        $keuangan = Menu::where('name', 'Keuangan')->first();
        if ($keuangan) {
            $menu = Menu::updateOrCreate(
                ['route' => 'master.biaya-legalitas.index'],
                [
                    'name' => 'Master Biaya Legalitas & Admin',
                    'parent_id' => $keuangan->id,
                    'icon' => 'mdi-cash-multiple',
                    'order' => 2
                ]
            );

            // Sync with all positions that can access Keuangan
            $positions = $keuangan->positions()->pluck('positions.id')->toArray();
            if (!empty($positions)) {
                $menu->positions()->syncWithoutDetaching($positions);
            }
        }
    }
}
