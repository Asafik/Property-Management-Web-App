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
        // 1. Add target_volume, realized_volume, and volume_unit to land_bank_infrastructures
        Schema::table('land_bank_infrastructures', function (Blueprint $table) {
            if (!Schema::hasColumn('land_bank_infrastructures', 'target_volume')) {
                $table->decimal('target_volume', 12, 2)->default(100)->after('volume');
            }
            if (!Schema::hasColumn('land_bank_infrastructures', 'realized_volume')) {
                $table->decimal('realized_volume', 12, 2)->default(0)->after('target_volume');
            }
            if (!Schema::hasColumn('land_bank_infrastructures', 'volume_unit')) {
                $table->string('volume_unit', 50)->default('unit')->after('realized_volume');
            }
        });

        // 2. Create progress logs table for real daily/weekly site logs and documentation
        if (!Schema::hasTable('land_bank_infrastructure_logs')) {
            Schema::create('land_bank_infrastructure_logs', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('land_bank_infrastructure_id');
                $table->date('log_date');
                $table->decimal('volume_achieved', 12, 2)->default(0); // Capaian volume di hari/catatan ini
                $table->decimal('cumulative_volume', 12, 2)->default(0); // Total volume kumulatif saat itu
                $table->decimal('progress_percent', 5, 2)->default(0); // % saat log ini
                $table->string('mandor_name')->nullable();
                $table->string('photo_documentation')->nullable();
                $table->text('notes')->nullable();
                $table->unsignedBigInteger('recorded_by')->nullable();
                $table->timestamps();

                $table->foreign('land_bank_infrastructure_id', 'fk_infra_log_id')
                      ->references('id')
                      ->on('land_bank_infrastructures')
                      ->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('land_bank_infrastructure_logs');

        Schema::table('land_bank_infrastructures', function (Blueprint $table) {
            if (Schema::hasColumn('land_bank_infrastructures', 'target_volume')) {
                $table->dropColumn(['target_volume', 'realized_volume', 'volume_unit']);
            }
        });
    }
};
