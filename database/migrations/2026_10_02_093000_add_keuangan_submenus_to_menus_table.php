<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use App\Models\Menu;
use App\Models\Position;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $admin = Position::where('name', 'Admin')->first();
        $keuanganStaff = Position::where('name', 'Staff Keuangan')->first();
        $roles = array_values(array_filter([$admin?->id, $keuanganStaff?->id, 1, 7]));
        $roles = array_unique($roles);

        $keuangan = Menu::where('name', 'Keuangan')->whereNull('parent_id')->first();
        if (!$keuangan) {
            $keuangan = Menu::create([
                'name'  => 'Keuangan',
                'icon'  => 'mdi-cash-register',
                'order' => 10,
            ]);
            $keuangan->positions()->syncWithoutDetaching($roles);
        }

        $submenus = [
            [
                'name'  => 'Arus Kas (Cash Flow)',
                'route' => 'keuangan.arus-kas.index',
                'order' => 1,
            ],
            [
                'name'  => 'Buku Jurnal Umum',
                'route' => 'keuangan.jurnal.index',
                'order' => 2,
            ],
            [
                'name'  => 'Laporan Laba Rugi',
                'route' => 'keuangan.laba-rugi.index',
                'order' => 3,
            ],
            [
                'name'  => 'Neraca Keuangan',
                'route' => 'keuangan.neraca.index',
                'order' => 4,
            ],
        ];

        foreach ($submenus as $sub) {
            $menu = Menu::where('route', $sub['route'])->first();
            if (!$menu) {
                $menu = Menu::create([
                    'name'      => $sub['name'],
                    'route'     => $sub['route'],
                    'parent_id' => $keuangan->id,
                    'order'     => $sub['order'],
                ]);
            } else {
                $menu->update([
                    'name'      => $sub['name'],
                    'parent_id' => $keuangan->id,
                    'order'     => $sub['order'],
                ]);
            }
            $menu->positions()->syncWithoutDetaching($roles);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $routes = [
            'keuangan.arus-kas.index',
            'keuangan.jurnal.index',
            'keuangan.laba-rugi.index',
            'keuangan.neraca.index',
        ];

        Menu::whereIn('route', $routes)->delete();
    }
};
