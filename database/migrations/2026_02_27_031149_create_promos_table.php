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
        // Cek dulu, kalau tabel belum ada, buat baru
        if (!Schema::hasTable('promos')) {
            Schema::create('promos', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->text('description');

                $table->enum('validity_period', ['selalu', 'periode']);
                $table->date('start_date')->nullable();
                $table->date('end_date')->nullable();
                $table->integer('duration_days')->nullable();

                $table->enum('type', ['persen', 'nominal']);
                $table->enum('category', ['promo', 'biaya', 'fasilitas']);

                $table->enum('status', ['aktif', 'tidak_aktif'])->default('aktif');

                $table->timestamps();
            });
        } else {
            // Kalau tabel sudah ada, tinggal tambahkan kolom yang belum ada
            Schema::table('promos', function (Blueprint $table) {
                if (!Schema::hasColumn('promos', 'duration_days')) {
                    $table->integer('duration_days')->nullable()->after('end_date');
                }
                if (!Schema::hasColumn('promos', 'value')) {
                    $table->decimal('value', 15, 2)->after('category');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('promos')) {
            Schema::table('promos', function (Blueprint $table) {
                if (Schema::hasColumn('promos', 'duration_days')) {
                    $table->dropColumn('duration_days');
                }
                if (Schema::hasColumn('promos', 'value')) {
                    $table->dropColumn('value');
                }
            });
        }
    }
};