<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UnitMaterial extends Model
{
    protected $table = 'unit_materials'; // sesuaikan nama tabel migration
    protected $fillable = ['unit_id','name','quantity','unit','notes','status'];

    public function unit()
    {
        return $this->belongsTo(LandBankUnit::class, 'unit_id');
    }
}
