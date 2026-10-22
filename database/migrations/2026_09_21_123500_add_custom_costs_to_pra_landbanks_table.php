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
        if (Schema::hasTable('pra_landbanks')) {
            Schema::table('pra_landbanks', function (Blueprint $table) {
                if (!Schema::hasColumn('pra_landbanks', 'custom_costs')) {
                    $table->json('custom_costs')->nullable()->after('cost_other');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('pra_landbanks')) {
            Schema::table('pra_landbanks', function (Blueprint $table) {
                if (Schema::hasColumn('pra_landbanks', 'custom_costs')) {
                    $table->dropColumn('custom_costs');
                }
            });
        }
    }
};
