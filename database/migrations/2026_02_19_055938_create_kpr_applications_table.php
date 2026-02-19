<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kpr_applications', function (Blueprint $table) {
            $table->id();

            // RELASI
            $table->foreignId('land_bank_units_id')->constrained()->cascadeOnDelete();
            $table->foreignId('customer_id')->constrained()->cascadeOnDelete();
            $table->foreignId('banks_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('sales_id')->nullable()->constrained('employees')->nullOnDelete();

            // DATA PENGAJUAN
            $table->decimal('harga_unit', 15, 0)->nullable();
            $table->decimal('dp', 15, 0)->nullable();
            $table->integer('tenor')->nullable(); // tahun
            $table->decimal('estimasi_cicilan', 15, 0)->nullable();

            // STATUS KPR
            $table->enum('status', [
                'draft',
                'pengajuan',
                'dokumen',
                'survey',
                'analisa',
                'approved',
                'rejected',
                'akad'
            ])->default('draft');

            // TANGGAL PROSES
            $table->timestamp('submitted_at')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->timestamp('rejected_at')->nullable();
            $table->timestamp('akad_at')->nullable();

            // CATATAN
            $table->text('catatan')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kpr_applications');
    }
};
