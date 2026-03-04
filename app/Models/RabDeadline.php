<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RabDeadline extends Model
{
    protected $fillable = [
        'development_progress_id',
        'kategori',
        'target_mulai',
        'target_selesai',
        'deadline'
    ];

    public function progress()
    {
        return $this->belongsTo(\App\Models\DevelopmentProgress::class, 'development_progress_id');
    }
}