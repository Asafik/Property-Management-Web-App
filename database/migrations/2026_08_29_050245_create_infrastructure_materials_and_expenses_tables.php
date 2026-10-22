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
        // 1. Tabel Master Bahan & Jasa Infrastruktur / Pengolahan Lahan
        if (!Schema::hasTable('infrastructure_materials')) {
            Schema::create('infrastructure_materials', function (Blueprint $table) {
                $table->id();
                $table->string('code')->unique()->nullable();
                $table->string('name');
                $table->string('category')->default('Umum'); // PJU, Drainase, Jalan, Pematangan / Cut & Fill, Air Bersih, Listrik, Alat Berat, Upah
                $table->string('unit')->default('unit'); // sak, m3, m2, batang, rit, titik, meter, hari, jam, ls, paket
                $table->decimal('default_price', 15, 2)->default(0);
                $table->text('specification')->nullable();
                $table->boolean('is_active')->default(true);
                $table->timestamps();
            });
        }

        // 2. Tabel Pencatatan Realisasi Pengeluaran & Pemakaian Bahan per Proyek Land Bank
        if (!Schema::hasTable('land_bank_infrastructure_expenses')) {
            Schema::create('land_bank_infrastructure_expenses', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('land_bank_id');
                $table->unsignedBigInteger('land_bank_infrastructure_id')->nullable();
                $table->unsignedBigInteger('material_id')->nullable();
                $table->string('expense_code')->nullable();
                $table->string('item_name');
                $table->string('category')->nullable();
                $table->decimal('quantity', 12, 2)->default(1);
                $table->string('unit')->default('unit');
                $table->decimal('unit_price', 15, 2)->default(0);
                $table->decimal('total_amount', 15, 2)->default(0);
                $table->date('expense_date')->nullable();
                $table->string('vendor_name')->nullable();
                $table->string('payment_method')->default('Cash'); // Cash, Transfer Bank, Tempo / Hutang
                $table->string('payment_status')->default('Lunas'); // Lunas, Belum Lunas
                $table->string('receipt_proof')->nullable(); // Foto Nota / Bukti Pengeluaran
                $table->unsignedBigInteger('recorded_by')->nullable();
                $table->text('notes')->nullable();
                $table->timestamps();

                // Explicit shorter foreign key names to prevent MySQL 64-char limit error
                $table->foreign('land_bank_id', 'fk_exp_land_id')->references('id')->on('land_banks')->onDelete('cascade');
                $table->foreign('land_bank_infrastructure_id', 'fk_exp_infra_id')->references('id')->on('land_bank_infrastructures')->onDelete('set null');
                $table->foreign('material_id', 'fk_exp_material_id')->references('id')->on('infrastructure_materials')->onDelete('set null');
                $table->foreign('recorded_by', 'fk_exp_employee_id')->references('id')->on('employees')->onDelete('set null');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('land_bank_infrastructure_expenses');
        Schema::dropIfExists('infrastructure_materials');
    }
};
