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
        Schema::table('pra_landbanks', function (Blueprint $table) {
            if (!Schema::hasColumn('pra_landbanks', 'pbb_nominal')) {
                $table->bigInteger('pbb_nominal')->nullable()->after('pbb_note');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pra_landbanks', function (Blueprint $table) {
            if (Schema::hasColumn('pra_landbanks', 'pbb_nominal')) {
                $table->dropColumn('pbb_nominal');
            }
        });
    }
};
