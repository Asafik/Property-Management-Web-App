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
        if (Schema::hasTable('unit_landing_pages')) {
            Schema::table('unit_landing_pages', function (Blueprint $table) {
                if (!Schema::hasColumn('unit_landing_pages', 'address')) {
                    $table->text('address')->nullable()->after('description');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('unit_landing_pages')) {
            Schema::table('unit_landing_pages', function (Blueprint $table) {
                if (Schema::hasColumn('unit_landing_pages', 'address')) {
                    $table->dropColumn('address');
                }
            });
        }
    }
};
