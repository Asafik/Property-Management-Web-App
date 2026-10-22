<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CashTempoDocument extends Model
{
    protected $fillable = [
        'cash_tempo_id',
        'ktp',
        'npwp',
        'surat_perjanjian'
    ];
}