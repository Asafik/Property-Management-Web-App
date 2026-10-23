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
        Schema::table('akads', function (Blueprint $table) {
            if (!Schema::hasColumn('akads', 'no_ajb')) {
                $table->string('no_ajb', 100)->nullable()->after('nama_notaris');
            }
            if (!Schema::hasColumn('akads', 'tanggal_ajb')) {
                $table->date('tanggal_ajb')->nullable()->after('no_ajb');
            }
            if (!Schema::hasColumn('akads', 'nominal_ajb')) {
                $table->decimal('nominal_ajb', 15, 2)->default(0)->nullable()->after('tanggal_ajb');
            }
            if (!Schema::hasColumn('akads', 'dokumen_ajb')) {
                $table->string('dokumen_ajb', 255)->nullable()->after('nominal_ajb');
            }
        });

        Schema::table('bookings', function (Blueprint $table) {
            if (!Schema::hasColumn('bookings', 'no_ajb')) {
                $table->string('no_ajb', 100)->nullable()->after('bukti_transfer_ijb');
            }
            if (!Schema::hasColumn('bookings', 'ajb')) {
                $table->decimal('ajb', 15, 2)->default(0)->nullable()->after('no_ajb');
            }
            if (!Schema::hasColumn('bookings', 'bukti_transfer_ajb')) {
                $table->string('bukti_transfer_ajb', 255)->nullable()->after('ajb');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('akads', function (Blueprint $table) {
            if (Schema::hasColumn('akads', 'dokumen_ajb')) {
                $table->dropColumn('dokumen_ajb');
            }
            if (Schema::hasColumn('akads', 'nominal_ajb')) {
                $table->dropColumn('nominal_ajb');
            }
            if (Schema::hasColumn('akads', 'tanggal_ajb')) {
                $table->dropColumn('tanggal_ajb');
            }
            if (Schema::hasColumn('akads', 'no_ajb')) {
                $table->dropColumn('no_ajb');
            }
        });

        Schema::table('bookings', function (Blueprint $table) {
            if (Schema::hasColumn('bookings', 'bukti_transfer_ajb')) {
                $table->dropColumn('bukti_transfer_ajb');
            }
            if (Schema::hasColumn('bookings', 'ajb')) {
                $table->dropColumn('ajb');
            }
            if (Schema::hasColumn('bookings', 'no_ajb')) {
                $table->dropColumn('no_ajb');
            }
        });
    }
};
