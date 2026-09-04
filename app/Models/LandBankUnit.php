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
        'jenis',
        'type',
        'unit_name',
        'area',
        'building_area',
        'price',
        'ijb_price',
        'ajb_price',
        'facing',
        'position',
        'description',
        'status',
        'coordinates',
        'map_scale',
        'construction_progress',
        'no_spk',
        'dokumen_spk',
        'kontraktor',
    ];
    protected $casts = [
    'coordinates' => 'array',
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
    public function progress()
    {
        return $this->hasOne(DevelopmentProgress::class, 'land_bank_unit_id');
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
    public function items(){
        return $this->hasMany(DevelopmentProgressItem::class, 'unit_id');
    }
    public function agency()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
 public function rabs()
{
    return $this->hasMany(Rabs::class, 'unit_id');
}
public function activeBooking()
{
    return $this->hasOne(Booking::class, 'unit_id')
        ->whereNotIn('status', ['cancelled'])
        ->latestOfMany();
}

    public function complaints()
    {
        return $this->hasMany(Complaint::class, 'unit_id');
    }

    public function spk()
    {
        return $this->belongsTo(Spk::class, 'no_spk', 'no_spk');
    }

/**
 * Total Biaya Perizinan dari RAB Unit
 */
public function getBiayaRabPerizinanAttribute(): float
{
    if ($this->progress && $this->progress->items) {
        return (float) $this->progress->items->where('kategori', 'perizinan')->sum('total');
    }
    return 0.0;
}

/**
 * Total Biaya Pembangunan Rumah Fisik dari RAB Unit (Non-Perizinan)
 */
public function getBiayaRabRumahAttribute(): float
{
    if ($this->progress && $this->progress->items) {
        return (float) $this->progress->items->where('kategori', '!=', 'perizinan')->sum('total');
    }
    return 0.0;
}

/**
 * Alokasi Biaya Infrastruktur Kawasan / Jalan untuk Unit ini
 */
public function getAlokasiBiayaInfrastrukturAttribute(): float
{
    if (!$this->landBank) return 0.0;
    
    $totalExpenses = (float) $this->landBank->expenses()->sum('total_amount');
    if ($totalExpenses <= 0) {
        $totalExpenses = (float) $this->landBank->infrastructures()->sum('cost_estimate');
    }
    
    $totalUnits = $this->landBank->units()->count() ?: 1;
    return round($totalExpenses / $totalUnits, 2);
}

public function kprDisbursements()
{
    return $this->hasMany(KprDisbursement::class, 'land_bank_unit_id')->orderBy('tanggal_cair', 'desc');
}

}
