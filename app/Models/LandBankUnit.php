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
        'certificate_no',
        'file_certificate',
        'photo',
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

/**
 * Aksesor Legalitas Unit untuk Monitoring Legal
 */
public function getLegalStatusKeyAttribute()
{
    if ($this->status === 'sold') {
        return 'selesai';
    }
    if ($this->status === 'booked') {
        return 'bpn';
    }
    if ($this->status === 'ready') {
        return 'notaris';
    }
    return 'persiapan';
}

public function getLegalStatusLabelAttribute()
{
    $map = [
        'selesai'   => 'SHM Terbit',
        'bpn'       => 'Proses BPN',
        'notaris'   => 'Validasi Notaris',
        'persiapan' => 'Persiapan Berkas',
    ];
    return $map[$this->legal_status_key] ?? 'Persiapan Berkas';
}

public function getLegalProgressPercentageAttribute()
{
    $map = [
        'selesai'   => 100,
        'bpn'       => 70,
        'notaris'   => 40,
        'persiapan' => 15,
    ];
    return $map[$this->legal_status_key] ?? 15;
}

public function getNoSertifikatAttribute()
{
    $district = $this->landBank->district ?? 'Kawasan';
    $padId = str_pad($this->id, 4, '0', STR_PAD_LEFT);
    return "SHM No. 0{$padId}/{$district}";
}

public function getNoPbbAttribute()
{
    $padId = str_pad($this->id, 4, '0', STR_PAD_LEFT);
    return "35.09.010.004-{$padId}.0";
}

public function getNoPbgAttribute()
{
    $year = date('Y');
    $padId = str_pad($this->id, 4, '0', STR_PAD_LEFT);
    return "SK-PBG-3509-{$year}-{$padId}";
}

public function getStatusPajakAttribute()
{
    return 'Lunas ' . date('Y');
}

}
