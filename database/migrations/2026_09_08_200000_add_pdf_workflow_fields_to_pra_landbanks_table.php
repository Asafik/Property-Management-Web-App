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
            if (!Schema::hasColumn('pra_landbanks', 'land_protection_status')) {
                $table->string('land_protection_status', 30)->nullable()->default('aman')->after('ownership_status'); // aman, lbs, lsd, lp2b
            }
            if (!Schema::hasColumn('pra_landbanks', 'pbb_status')) {
                $table->string('pbb_status', 30)->nullable()->default('lunas')->after('land_protection_status'); // lunas, nunggak
            }
            if (!Schema::hasColumn('pra_landbanks', 'notaris_id')) {
                $table->foreignId('notaris_id')->nullable()->constrained('notaris')->nullOnDelete()->after('priority');
            }
            if (!Schema::hasColumn('pra_landbanks', 'notary_appointment_date')) {
                $table->dateTime('notary_appointment_date')->nullable()->after('notaris_id');
            }
            if (!Schema::hasColumn('pra_landbanks', 'receipt_file')) {
                $table->string('receipt_file')->nullable()->after('file_tax'); // Kwitansi bermaterai pembayaran
            }
            if (!Schema::hasColumn('pra_landbanks', 'tax_pph_file')) {
                $table->string('tax_pph_file')->nullable()->after('receipt_file'); // Bukti Pembayaran Pajak PPh
            }
            if (!Schema::hasColumn('pra_landbanks', 'release_deed_file')) {
                $table->string('release_deed_file')->nullable()->after('tax_pph_file'); // Salinan Akta Pelepasan Notaris
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pra_landbanks', function (Blueprint $table) {
            $table->dropForeign(['notaris_id']);
            $table->dropColumn([
                'land_protection_status',
                'pbb_status',
                'notaris_id',
                'notary_appointment_date',
                'receipt_file',
                'tax_pph_file',
                'release_deed_file'
            ]);
        });
    }
};
