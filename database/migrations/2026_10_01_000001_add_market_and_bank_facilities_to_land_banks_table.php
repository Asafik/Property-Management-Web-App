<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('land_banks', function (Blueprint $table) {
            if (!Schema::hasColumn('land_banks', 'facility_market')) {
                $table->boolean('facility_market')->default(false)->after('facility_hospital');
            }
            if (!Schema::hasColumn('land_banks', 'facility_bank')) {
                $table->boolean('facility_bank')->default(false)->after('facility_transport');
            }
        });

        // Sync existing records from pra_landbanks
        if (Schema::hasTable('pra_landbanks')) {
            $praLands = DB::table('pra_landbanks')->get();
            foreach ($praLands as $pra) {
                DB::table('land_banks')
                    ->where(function($q) use ($pra) {
                        if (!empty($pra->land_bank_id)) {
                            $q->where('id', $pra->land_bank_id);
                        } else {
                            $q->where('name', $pra->land_name);
                        }
                    })
                    ->update([
                        'facility_market' => $pra->facility_market ?? false,
                        'facility_bank'   => $pra->facility_bank ?? false,
                    ]);
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('land_banks', function (Blueprint $table) {
            if (Schema::hasColumn('land_banks', 'facility_market')) {
                $table->dropColumn('facility_market');
            }
            if (Schema::hasColumn('land_banks', 'facility_bank')) {
                $table->dropColumn('facility_bank');
            }
        });
    }
};
