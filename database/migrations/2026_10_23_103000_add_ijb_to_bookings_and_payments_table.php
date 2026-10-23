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
        Schema::table('bookings', function (Blueprint $table) {
            if (!Schema::hasColumn('bookings', 'ijb')) {
                $table->bigInteger('ijb')->nullable()->default(0)->after('utj')->comment('Nominal Ikatan Jual Beli (IJB)');
            }
            if (!Schema::hasColumn('bookings', 'bukti_transfer_ijb')) {
                $table->string('bukti_transfer_ijb')->nullable()->after('ijb')->comment('Path file bukti transfer IJB');
            }
        });

        // Pastikan kolom type pada tabel payments mendukung tipe 'ijb'
        try {
            DB::statement("ALTER TABLE payments MODIFY COLUMN `type` VARCHAR(50) NOT NULL");
        } catch (\Exception $e) {
            // Fallback jika sudah varchar atau enum sudah terupdate
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            if (Schema::hasColumn('bookings', 'bukti_transfer_ijb')) {
                $table->dropColumn('bukti_transfer_ijb');
            }
            if (Schema::hasColumn('bookings', 'ijb')) {
                $table->dropColumn('ijb');
            }
        });
    }
};
