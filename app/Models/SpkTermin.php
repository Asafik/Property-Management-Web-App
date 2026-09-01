<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Spk;

class SpkTermin extends Model
{
    use HasFactory;

    protected $table = 'spk_termins';

    protected $fillable = [
        'spk_id',
        'termin_ke',
        'nama_tahap',
        'persentase',
        'nominal',
        'syarat_progress',
        'status_bayar',
        'tanggal_jatuh_tempo',
        'tanggal_bayar',
        'keterangan',
    ];

    protected $casts = [
        'persentase' => 'decimal:2',
        'nominal' => 'decimal:2',
        'syarat_progress' => 'decimal:2',
        'tanggal_jatuh_tempo' => 'date:Y-m-d',
        'tanggal_bayar' => 'date:Y-m-d',
    ];

    public function spk()
    {
        return $this->belongsTo(Spk::class, 'spk_id');
    }

    public function getFormattedNominalAttribute()
    {
        return 'Rp ' . number_format($this->nominal, 0, ',', '.');
    }
}
