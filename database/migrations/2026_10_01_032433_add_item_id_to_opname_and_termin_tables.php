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
        if (Schema::hasTable('pembayaran_termin')) {
            Schema::table('pembayaran_termin', function (Blueprint $table) {
                if (!Schema::hasColumn('pembayaran_termin', 'development_progress_item_id')) {
                    $table->unsignedBigInteger('development_progress_item_id')->nullable()->after('land_bank_unit_id');
                    $table->foreign('development_progress_item_id')->references('id')->on('development_progress_items')->nullOnDelete();
                }
            });
        }

        if (Schema::hasTable('opname_mingguan')) {
            Schema::table('opname_mingguan', function (Blueprint $table) {
                if (!Schema::hasColumn('opname_mingguan', 'development_progress_item_id')) {
                    $table->unsignedBigInteger('development_progress_item_id')->nullable()->after('land_bank_unit_id');
                    $table->foreign('development_progress_item_id')->references('id')->on('development_progress_items')->nullOnDelete();
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('pembayaran_termin')) {
            Schema::table('pembayaran_termin', function (Blueprint $table) {
                if (Schema::hasColumn('pembayaran_termin', 'development_progress_item_id')) {
                    $table->dropForeign(['development_progress_item_id']);
                    $table->dropColumn('development_progress_item_id');
                }
            });
        }

        if (Schema::hasTable('opname_mingguan')) {
            Schema::table('opname_mingguan', function (Blueprint $table) {
                if (Schema::hasColumn('opname_mingguan', 'development_progress_item_id')) {
                    $table->dropForeign(['development_progress_item_id']);
                    $table->dropColumn('development_progress_item_id');
                }
            });
        }
    }
};
