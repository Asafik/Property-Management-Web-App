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
        Schema::create('unit_landing_pages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('land_bank_unit_id')->constrained('land_bank_units')->onDelete('cascade');
            
            // Narasi & Promosi
            $table->string('headline')->nullable();
            $table->string('promo_badge')->nullable();
            $table->text('description')->nullable();
            $table->json('features')->nullable();
            $table->json('gallery')->nullable();

            // Spesifikasi Fisik & Ruang
            $table->integer('bedrooms')->default(2)->nullable();
            $table->integer('bathrooms')->default(1)->nullable();
            $table->integer('carport')->default(1)->nullable();
            $table->integer('floors')->default(1)->nullable();

            // Utilitas & Legalitas
            $table->string('electricity')->default('1.300 Watt')->nullable();
            $table->string('water')->nullable();
            $table->string('certificate')->nullable();
            $table->string('year_built')->nullable();
            $table->string('condition')->default('Baru & Siap Huni (100%)')->nullable();

            // Kontak Petugas / Lobby
            $table->string('sales_name')->nullable();
            $table->string('sales_phone')->nullable();

            // Titik Lokasi Peta Presisi
            $table->decimal('lat', 10, 8)->nullable();
            $table->decimal('lng', 11, 8)->nullable();
            $table->text('map_link')->nullable();

            // Visibilitas & Unggulan
            $table->boolean('is_published')->default(true);
            $table->boolean('is_featured')->default(false);

            // Simulasi Cicilan KPR
            $table->bigInteger('cicilan_estimasi')->nullable();
            $table->decimal('dp_persen', 5, 2)->default(1)->nullable();
            $table->integer('tenor_estimasi')->default(20)->nullable();
            $table->string('bank_partners')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('unit_landing_pages');
    }
};
