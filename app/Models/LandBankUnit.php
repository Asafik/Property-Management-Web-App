<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\UnitMaterial; // pastikan nama kelas sesuai
use App\Models\DevelopmentProgress;
use App\Models\Employee;

class LandBankUnit extends Model
{
    protected $fillable = [
        'land_bank_id',
        'block',
        'unit_number',
        'unit_code',
        'type',
        'area',
        'building_area',
        'price',
        'facing',
        'position',
        'description',
        'status',
        'x',
        'y',
        'construction_progress', // jika ada kolom progress
    ];

    public function getConstructionProgressPercentageAttribute()
    {
        $map = [
            'belum_mulai' => 0,
            'pondasi'     => 20,
            'dinding'     => 40,
            'atap'        => 60,
            'finishing'   => 80,
            'selesai'     => 100,
        ];

        return $map[$this->construction_progress] ?? 0;
    }
    public function landBank()
    {
        return $this->belongsTo(LandBank::class);
    }

    public function materials()
    {
        return $this->hasMany(UnitMaterial::class, 'unit_id');
    }
    public function developmentProgress()
    {
        return $this->hasOne(DevelopmentProgress::class);
    }
    public function items()
    {
        return $this->hasMany(DevelopmentProgressItem::class);
    }

    public function unit()
    {
        return $this->belongsTo(LandBankUnit::class, 'land_bank_unit_id');
    }
    public function progress()
    {
        return $this->hasOne(DevelopmentProgress::class, 'land_bank_unit_id');
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
    public function agency()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
}
