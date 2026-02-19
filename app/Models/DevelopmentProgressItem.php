<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Rabs;

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
    public function rabs()
{
    return $this->hasMany(Rabs::class);
}

}
