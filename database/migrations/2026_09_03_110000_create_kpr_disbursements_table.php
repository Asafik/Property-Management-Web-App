<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kpr_disbursements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kpr_application_id')->nullable()->constrained('kpr_applications')->nullOnDelete();
            $table->foreignId('land_bank_unit_id')->constrained('land_bank_units')->cascadeOnDelete();
            $table->foreignId('booking_id')->nullable()->constrained('bookings')->nullOnDelete();
            $table->integer('termin_ke')->default(1);
            $table->string('nama_termin')->default('Pencairan Plafon KPR');
            $table->decimal('nominal_cair', 15, 2);
            $table->date('tanggal_cair');
            $table->string('bank_penyalur')->nullable(); // e.g. BCA, BTN, BRI, Mandiri
            $table->string('rekening_tujuan')->nullable(); // Rekening Bank Developer
            $table->string('no_referensi_bank')->nullable(); // No Ref Transfer / SP2D
            $table->string('bukti_transfer')->nullable(); // File Bukti Transfer / Rekening Koran
            $table->text('catatan')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kpr_disbursements');
    }
};
