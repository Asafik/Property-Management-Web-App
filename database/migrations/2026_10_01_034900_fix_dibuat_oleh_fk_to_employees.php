<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Fix opname_mingguan: drop FK ke users, ganti ke employees
        if (Schema::hasTable('opname_mingguan')) {
            Schema::table('opname_mingguan', function (Blueprint $table) {
                // Drop FK lama ke users jika ada
                try {
                    $table->dropForeign(['dibuat_oleh']);
                } catch (\Exception $e) { /* ignore */ }
                try {
                    $table->dropForeign(['disetujui_oleh']);
                } catch (\Exception $e) { /* ignore */ }

                // Tambah FK baru ke employees
                $table->foreign('dibuat_oleh')
                      ->references('id')->on('employees')
                      ->nullOnDelete();
                $table->foreign('disetujui_oleh')
                      ->references('id')->on('employees')
                      ->nullOnDelete();
            });
        }

        // Fix pembayaran_termin jika ada kolom serupa
        if (Schema::hasTable('pembayaran_termin') && Schema::hasColumn('pembayaran_termin', 'dibayar_oleh')) {
            Schema::table('pembayaran_termin', function (Blueprint $table) {
                try {
                    $table->dropForeign(['dibayar_oleh']);
                } catch (\Exception $e) { /* ignore */ }
                try {
                    $table->dropForeign(['disetujui_oleh']);
                } catch (\Exception $e) { /* ignore */ }

                $table->foreign('dibayar_oleh')
                      ->references('id')->on('employees')
                      ->nullOnDelete();
                $table->foreign('disetujui_oleh')
                      ->references('id')->on('employees')
                      ->nullOnDelete();
            });
        }
    }

    public function down(): void
    {
        // Rollback ke FK users (opsional)
    }
};
