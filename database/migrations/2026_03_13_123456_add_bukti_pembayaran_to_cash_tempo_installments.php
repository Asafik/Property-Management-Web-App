<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('cash_tempo_installments', function (Blueprint $table) {
            // Menambahkan kolom untuk menyimpan bukti pembayaran
            $table->string('bukti_pembayaran')->nullable()->after('tanggal_bayar');
        });
    }

    public function down()
    {
        Schema::table('cash_tempo_installments', function (Blueprint $table) {
            // Menghapus kolom jika rollback
            $table->dropColumn('bukti_pembayaran');
        });
    }
};