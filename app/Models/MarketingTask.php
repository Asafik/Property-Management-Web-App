<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MarketingTask extends Model
{
    const KATEGORI_SOSMED   = 'sosmed';
    const KATEGORI_PROYEKSI = 'proyeksi';
    const KATEGORI_UMUM     = 'umum';

    const KATEGORI_LABELS = [
        'sosmed'   => 'Sosial Media / Konten',
        'proyeksi' => 'Proyeksi / Akuisisi Tamu',
        'umum'     => 'Operasional / Umum',
    ];

    protected $fillable = [
        'employee_id',
        'kategori',
        'nama_tugas',
        'deskripsi',
        'platform',
        'link_postingan',
        'catatan_setor',
        'tanggal_setor',
        'views',
        'likes',
        'deadline',
        'status',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function guest()
    {
        return $this->hasMany(Guest::class, 'marketing_task_id');
    }

    /**
     * Label tampilan untuk kategori
     */
    public function getKategoriLabelAttribute(): string
    {
        return self::KATEGORI_LABELS[$this->kategori] ?? ucfirst($this->kategori ?? '-');
    }
}

