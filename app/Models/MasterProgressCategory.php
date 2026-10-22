<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterProgressCategory extends Model
{
    use HasFactory;

    protected $table = 'master_progress_categories';

    protected $fillable = [
        'nama_kategori',
        'slug',
        'prefix',
        'icon',
        'urutan',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'urutan'    => 'integer',
    ];

    public function items()
    {
        return $this->hasMany(MasterProgressItem::class, 'master_progress_category_id')->orderBy('urutan', 'asc');
    }
}
