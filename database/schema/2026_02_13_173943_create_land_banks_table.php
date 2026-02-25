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
        Schema::create('land_banks', function (Blueprint $table) {
            $table->id();

            // ===== MAIN INFORMATION =====
            $table->string('name')->nullable();
            $table->string('certificate_no')->nullable();
            $table->string('ownership_status')->nullable();
            $table->string('certificate_owner')->nullable(); // atas nama sertifikat
            $table->float('area')->nullable();
            $table->bigInteger('acquisition_price')->nullable();
            $table->date('acquisition_date')->nullable();

            // ===== LEGAL =====
            $table->string('imb_no')->nullable();
            $table->string('pbb_no')->nullable();

            // ===== ADDRESS =====
            $table->text('address')->nullable();
            $table->string('village')->nullable();
            $table->string('district')->nullable();
            $table->string('city')->nullable();
            $table->string('province')->nullable();
            $table->string('postal_code')->nullable();

            // ===== ADDITIONAL LAND INFO =====
            $table->string('zoning')->nullable(); // residential, commercial
            $table->integer('road_width')->nullable(); // lebar jalan
            $table->string('road_type')->nullable(); // aspal/beton/tanah

            // ===== FACILITIES =====
            $table->boolean('facility_school')->default(false);
            $table->boolean('facility_hospital')->default(false);
            $table->boolean('facility_mall')->default(false);
            $table->boolean('facility_transport')->default(false);

            // ===== STATUS =====
            $table->string('legal_status')->default('Pending');
            $table->string('development_status')->default('Belum');
            $table->string('priority')->default('Normal');

            // ===== MAP LOCATION =====
            $table->string('lat')->nullable();
            $table->string('lng')->nullable();

            // ===== FILES =====
            $table->string('file_certificate')->nullable();
            $table->string('file_imb')->nullable();
            $table->string('file_pbb')->nullable();
            $table->string('photo')->nullable();

            // ===== NOTES =====
            $table->text('description')->nullable();
            // ===== CUT & FILL (EARTHWORK) =====
            $table->decimal('elevasi_awal', 8, 2)->nullable();      // elevasi eksisting
            $table->decimal('elevasi_rencana', 8, 2)->nullable();   // elevasi setelah grading
            $table->decimal('volume_cut', 15, 2)->nullable();       // volume galian (m3)
            $table->decimal('volume_fill', 15, 2)->nullable();      // volume timbunan (m3)
            $table->enum('status_cut_fill', ['planned', 'proses', 'selesai'])
                ->default('planned');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('land_banks');
    }
};
