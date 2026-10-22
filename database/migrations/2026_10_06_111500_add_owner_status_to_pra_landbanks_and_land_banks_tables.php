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
                if (!Schema::hasColumn('pra_landbanks', 'owner_status')) {
                    $table->string('owner_status', 50)->default('hidup')->nullable()->after('owner_name');
                }
            });
        }

        if (Schema::hasTable('land_banks')) {
            Schema::table('land_banks', function (Blueprint $table) {
                if (!Schema::hasColumn('land_banks', 'owner_status')) {
                    $table->string('owner_status', 50)->default('hidup')->nullable()->after('certificate_owner');
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
                if (Schema::hasColumn('pra_landbanks', 'owner_status')) {
                    $table->dropColumn('owner_status');
                }
            });
        }

        if (Schema::hasTable('land_banks')) {
            Schema::table('land_banks', function (Blueprint $table) {
                if (Schema::hasColumn('land_banks', 'owner_status')) {
                    $table->dropColumn('owner_status');
                }
            });
        }
    }
};
