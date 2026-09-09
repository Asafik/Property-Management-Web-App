<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Berikan akses menu Tanah Induk (6), Semua Tanah Pra Land Bank (7), dan Semua Tanah Pasca Land Bank (8) ke Staff Keuangan (position_id: 7)
        $menus = [6, 7, 8];
        $positionId = 7; // Staff Keuangan

        if (DB::table('positions')->where('id', $positionId)->exists()) {
            foreach ($menus as $menuId) {
                $exists = DB::table('menu_position')
                    ->where('menu_id', $menuId)
                    ->where('position_id', $positionId)
                    ->exists();

                if (!$exists) {
                    DB::table('menu_position')->insert([
                        'menu_id' => $menuId,
                        'position_id' => $positionId
                    ]);
                }
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('menu_position')
            ->whereIn('menu_id', [6, 7, 8])
            ->where('position_id', 7)
            ->delete();
    }
};
