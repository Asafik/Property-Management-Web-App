<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MasterSkemaKpr extends Model
{
    use HasFactory;

    protected $table = 'master_skema_kprs';

    protected $fillable = [
        'bank_id',
        'produk_kpr',
        'nama_skema',
        'tenor',
        'bunga',
        'periode_tahun',
        'angsuran_per_bulan',
        'keterangan',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'tenor' => 'integer',
        'bunga' => 'float',
        'angsuran_per_bulan' => 'float',
    ];

    public function bank()
    {
        return $this->belongsTo(Banks::class, 'bank_id');
    }
}
