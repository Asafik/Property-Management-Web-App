<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KprDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        'kpr_application_id',
        'type',
        'path',
    ];

    public function kprApplication()
    {
        return $this->belongsTo(KprApplication::class);
    }
}