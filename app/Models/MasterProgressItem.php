<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterProgressItem extends Model
{
    use HasFactory;

    protected $table = 'master_progress_items';

    protected $fillable = [
        'master_progress_category_id',
        'kode',
        'uraian',
        'default_volume',
        'satuan',
        'default_harga_satuan',
        'keterangan',
        'urutan',
    ];

    protected $casts = [
        'default_volume'       => 'float',
        'default_harga_satuan' => 'integer',
        'urutan'               => 'integer',
    ];

    public function category()
    {
        return $this->belongsTo(MasterProgressCategory::class, 'master_progress_category_id');
    }
}
