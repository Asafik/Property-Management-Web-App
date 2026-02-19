<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\LandBankUnit;
use App\Models\LandBank;
use App\Models\DevelopmentProgressItem;

class Rabs extends Model
{
    protected $table = 'rabs'; // wajib kalau nama model plural
    protected $guarded = [];
     protected $fillable = [
        'unit_id',
        'code',
        'name',
        'description',
        'price',
        // kolom lainnya...
    ];

    // relasi ke unit
    public function unit()
    {
        return $this->belongsTo(LandBankUnit::class,'unit_id');
    }

    // relasi ke project
    public function project()
    {
        return $this->belongsTo(LandBank::class,'id');
    }

    // relasi ke progress pembangunan
    public function progress()
    {
        return $this->belongsTo(DevelopmentProgressItem::class,'id');
    }
}
