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
        'target_jumlah',
        'satuan_target',
        'realisasi_jumlah',
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

    /**
     * Realisasi aktual:
     * - Jika status 'Selesai' dan realisasi belum diset manual, otomatis dianggap mencapai target (penuh).
     * - Jika kategori sosmed dan sudah ada link postingan, otomatis minimal 1 / target tercapai.
     * - Jika kategori proyeksi (tamu/leads), otomatis membaca jumlah tamu yang terdata.
     */
    public function getRealisasiAktualAttribute(): int
    {
        $manual = (int) ($this->realisasi_jumlah ?? 0);
        $target = max(1, (int) ($this->target_jumlah ?? 1));

        // Jika tugas sudah ditandai 'Selesai' dan realisasi masih 0, otomatis dianggap sudah memenuhi target
        if ($this->status === 'Selesai' && $manual <= 0) {
            return $target;
        }

        // Jika kategori sosmed dan sudah ada link postingan bukti setor
        if ($this->kategori === self::KATEGORI_SOSMED && !empty($this->link_postingan) && $manual <= 0) {
            return $target;
        }

        // Jika kategori proyeksi, baca tamu atau realisasi manual mana yang lebih tinggi
        if ($this->kategori === self::KATEGORI_PROYEKSI) {
            $guestCount = $this->guest()->count();
            return max($manual, $guestCount);
        }

        return $manual;
    }

    /**
     * Persentase capaian target (0 - 100%)
     */
    public function getPersentaseCapaianAttribute(): int
    {
        if ($this->status === 'Selesai') {
            return 100;
        }

        $target = (int) ($this->target_jumlah ?? 0);
        if ($target <= 0) {
            return 0;
        }

        $persen = round(($this->realisasi_aktual / $target) * 100);
        return (int) min(100, max(0, $persen));
    }
}

