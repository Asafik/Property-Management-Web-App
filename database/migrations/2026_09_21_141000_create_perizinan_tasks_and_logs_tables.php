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
        if (!Schema::hasTable('perizinan_tasks')) {
            Schema::create('perizinan_tasks', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('proyek_id')->nullable()->index();
                $table->string('proyek_nama')->nullable();
                $table->unsignedBigInteger('master_dokumen_id')->nullable()->index();
                $table->string('nama_tugas');
                $table->string('instansi')->nullable();
                $table->unsignedBigInteger('employee_id')->comment('Staf Legal yang ditugaskan')->index();
                $table->unsignedBigInteger('assigned_by')->comment('Kepala Legal / Owner pemberi tugas')->index();
                $table->unsignedBigInteger('updated_by')->nullable()->comment('User terakhir yang mengupdate data/status')->index();
                $table->date('deadline')->nullable();
                $table->string('status')->default('Pending'); // Pending, Dalam Proses, Selesai, Terkendala
                $table->integer('progress')->default(0); // 0 - 100 %
                $table->string('nomor_dokumen')->nullable();
                $table->date('tanggal_terbit')->nullable();
                $table->text('catatan')->nullable(); // Instruksi tugas
                $table->text('kendala')->nullable(); // Catatan kendala lapangan dari staf
                $table->string('file_dokumen')->nullable(); // File bukti izin / SK
                $table->timestamp('last_activity_at')->nullable();
                $table->timestamps();

                $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
                $table->foreign('assigned_by')->references('id')->on('employees')->onDelete('cascade');
                $table->foreign('updated_by')->references('id')->on('employees')->onDelete('set null');
            });
        }

        if (!Schema::hasTable('perizinan_task_logs')) {
            Schema::create('perizinan_task_logs', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('perizinan_task_id')->index();
                $table->unsignedBigInteger('user_id')->comment('User yang melakukan perubahan')->index();
                $table->string('action')->default('Update Progres'); // Penugasan Baru, Update Status, Update Progres, Upload Berkas, Catatan Kendala, Reassign Staf
                $table->string('old_status')->nullable();
                $table->string('new_status')->nullable();
                $table->integer('old_progress')->nullable();
                $table->integer('new_progress')->nullable();
                $table->text('keterangan')->nullable();
                $table->string('file_dokumen')->nullable();
                $table->timestamps();

                $table->foreign('perizinan_task_id')->references('id')->on('perizinan_tasks')->onDelete('cascade');
                $table->foreign('user_id')->references('id')->on('employees')->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perizinan_task_logs');
        Schema::dropIfExists('perizinan_tasks');
    }
};
