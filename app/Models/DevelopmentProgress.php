<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DevelopmentProgress extends Model
{
    protected $table = 'development_progress';

    protected $fillable = [
        'land_bank_unit_id',
        'title',
        'status',
        'total_anggaran',
    ];

    public function unit()
    {
        return $this->belongsTo(LandBankUnit::class, 'land_bank_unit_id');
    }

    public function items()
{
    return $this->hasMany(DevelopmentProgressItem::class, 'development_progress_id');
}
}
