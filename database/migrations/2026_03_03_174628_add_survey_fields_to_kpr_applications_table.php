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
        Schema::table('kpr_applications', function (Blueprint $table) {
            //
            // database/migrations/xxxx_xx_xx_create_kpr_applications_table.php

$table->decimal('appraisal_value', 15, 0)->nullable();    // Nilai Appraisal
$table->decimal('luas_tanah', 8, 2)->nullable();         // m²
$table->decimal('luas_bangunan', 8, 2)->nullable();      // m²
$table->string('kondisi_bangunan')->nullable();          // Baru/Baik/Cukup/Perlu Renovasi

// Checklist Unit (boolean)
$table->boolean('listrik')->default(false);
$table->boolean('air')->default(false);
$table->boolean('akses')->default(false);
$table->boolean('sertifikat')->default(false);
$table->boolean('shm')->default(false);
$table->boolean('imb')->default(false);

// Dokumentasi Survey (file path)
$table->string('foto_depan')->nullable();
$table->string('foto_interior')->nullable();
$table->string('foto_lingkungan')->nullable();

// Catatan & rekomendasi
$table->text('catatan_survey')->nullable();
$table->string('rekomendasi')->nullable();
$table->integer('persentase_kelayakan')->nullable();

// Relasi Surveyor (employee_id)
$table->foreignId('surveyor_id')->nullable()->constrained('employees')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kpr_applications', function (Blueprint $table) {
            //
        });
    }
};
