<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DevelopmentProgressItem extends Model
{
    protected $fillable = [
        'development_progress_id',
        'kategori',
        'kode',
        'uraian',
        'volume',
        'satuan',
        'harga_satuan',
        'total',
        'keterangan',
    ];

    public function progress()
    {
        return $this->belongsTo(DevelopmentProgress::class, 'development_progress_id');
    }
}
