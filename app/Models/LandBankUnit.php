<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\UnitMaterial; // pastikan nama kelas sesuai

class LandBankUnit extends Model
{
    protected $fillable = [
        'land_bank_id',
        'block',
        'unit_number',
        'unit_code',
        'area',
        'price',
        'facing',
        'position',
        'description',
        'status',
        'x',
        'y',
        'construction_progress', // jika ada kolom progress
    ];

    public function landBank()
    {
        return $this->belongsTo(LandBank::class);
    }

    public function materials()
    {
        return $this->hasMany(UnitMaterial::class, 'unit_id');
    }
}
