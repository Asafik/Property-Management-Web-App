<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (Schema::hasTable('land_bank_infrastructures') && !Schema::hasColumn('land_bank_infrastructures', 'phase')) {
            Schema::table('land_bank_infrastructures', function (Blueprint $table) {
                $table->unsignedTinyInteger('phase')->default(1)->after('land_bank_id'); // 1 = Fase 1 Pematangan, 2 = Fase 2 Drainase & Jalan, 3 = Fase 3 Utilitas & PJU
            });
        }

        if (Schema::hasTable('land_bank_infrastructure_expenses') && !Schema::hasColumn('land_bank_infrastructure_expenses', 'phase')) {
            Schema::table('land_bank_infrastructure_expenses', function (Blueprint $table) {
                $table->unsignedTinyInteger('phase')->default(1)->after('land_bank_id');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('land_bank_infrastructures') && Schema::hasColumn('land_bank_infrastructures', 'phase')) {
            Schema::table('land_bank_infrastructures', function (Blueprint $table) {
                $table->dropColumn('phase');
            });
        }

        if (Schema::hasTable('land_bank_infrastructure_expenses') && Schema::hasColumn('land_bank_infrastructure_expenses', 'phase')) {
            Schema::table('land_bank_infrastructure_expenses', function (Blueprint $table) {
                $table->dropColumn('phase');
            });
        }
    }
};
