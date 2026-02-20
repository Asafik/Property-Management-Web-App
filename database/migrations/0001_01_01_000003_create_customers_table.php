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
Schema::create('customers', function (Blueprint $table) {
    $table->id();
    $table->string('customer_id')->nullable();
    // DATA PRIBADI
    $table->string('full_name')->nullable();
    $table->string('nickname')->nullable();
    $table->bigInteger('nik')->nullable();
    $table->bigInteger('no_kk')->nullable();
    $table->string('birthplace')->nullable();
    $table->date('date_birth')->nullable();
    $table->integer('age')->nullable();
    $table->string('gender')->nullable();
    $table->string('religion')->nullable();
    $table->string('nationality')->nullable()->default('WNI');
    $table->string('marital_status')->nullable();
    $table->date('marital_date')->nullable();
    $table->integer('child_count')->nullable();

    // ALAMAT KTP
    $table->string('province')->nullable();
    $table->string('city')->nullable();
    $table->string('subdistrict')->nullable();
    $table->string('village')->nullable();
    $table->string('rt')->nullable();
    $table->string('rw')->nullable();
    $table->integer('postal_code')->nullable();
    $table->text('address')->nullable();

    // ALAMAT DOMISILI
    $table->string('domicile_province')->nullable();
    $table->string('domicile_city')->nullable();
    $table->string('domicile_subdistrict')->nullable();
    $table->string('domicile_village')->nullable();
    $table->string('domicile_rt')->nullable();
    $table->string('domicile_rw')->nullable();
    $table->integer('domicile_postal_code')->nullable();
    $table->text('domicile_address')->nullable();

    // KONTAK
    $table->string('phone')->nullable();
    $table->string('home_phone')->nullable();
    $table->string('email')->nullable();
    $table->string('office_email')->nullable();

    // SOSIAL MEDIA
    $table->string('instagram')->nullable();
    $table->string('facebook')->nullable();
    $table->string('tiktok')->nullable();
    $table->string('x')->nullable();

    // PEKERJAAN & KEUANGAN
    $table->enum('job_status', [
        'PNS',
        'Karyawan Swasta',
        'Wiraswasta',
        'Ibu Rumah Tangga',
        'Pensiunan',
        'Lainnya'
    ])->nullable();
    $table->string('job_status_lainnya')->nullable();
    $table->string('company_name')->nullable();
    $table->bigInteger('main_income')->nullable();
    $table->bigInteger('side_income')->nullable();
    $table->string('npwp')->nullable();

    // 👨‍👩‍👧 DATA KELUARGA
    $table->string('spouse_name')->nullable(); // nama pasangan
    $table->string('spouse_nik')->nullable(); // nik pasangan
    $table->string('father_name')->nullable();
    $table->string('mother_name')->nullable();

    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
