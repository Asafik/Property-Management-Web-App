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
        'pos_x',
        'pos_y',
        'width',
        'height',
        'polygon_points',
    ];
    protected $casts = [
        'coordinates' => 'array',
        'polygon_points' => 'array',
    ];

    protected static function booted()
    {
        static::saving(function ($unit) {
            $cleanStatus = strtolower((string)$unit->status);
            $hasPrice = !empty($unit->price) && (float)$unit->price > 0;

            if ($unit->relationLoaded('activeBooking') && $unit->activeBooking && !in_array($unit->activeBooking->status, ['cancelled'])) {
                if (in_array(strtolower($unit->activeBooking->status), ['completed', 'done', 'sold'])) {
                    $unit->status = 'sold';
                } else {
                    $unit->status = 'booked';
                }
                return;
            }

            if (!$hasPrice && !in_array($cleanStatus, ['booked', 'booking', 'sold', 'terjual'])) {
                $unit->status = 'draft';
            } elseif ($hasPrice && (empty($cleanStatus) || $cleanStatus === 'draft')) {
                // Ketika harga sudah ditentukan (> 0), status otomatis menjadi ready / tersedia
                $unit->status = 'ready';
            }
        });
    }

    public function getStatusAttribute($value)
    {
        $cleanVal = strtolower((string)$value);

        if ($this->relationLoaded('activeBooking') && $this->activeBooking && !in_array($this->activeBooking->status, ['cancelled'])) {
            return in_array(strtolower($this->activeBooking->status), ['completed', 'done', 'sold']) ? 'sold' : 'booked';
        }

        $hasPrice = !empty($this->attributes['price']) && (float)$this->attributes['price'] > 0;

        if (!$hasPrice && !in_array($cleanVal, ['booked', 'booking', 'sold', 'terjual'])) {
            return 'draft';
        }
        if ($hasPrice && (empty($cleanVal) || $cleanVal === 'draft')) {
            return 'ready';
        }
        return $value ?: 'draft';
    }

    public function landingPage()
    {
        return $this->hasOne(\App\Models\UnitLandingPage::class, 'land_bank_unit_id');
    }
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

    public function getLatestOpnameAttribute()
    {
        if ($this->relationLoaded('progress') && $this->progress) {
            if ($this->progress->relationLoaded('opnameMingguan')) {
                return $this->progress->opnameMingguan->sortByDesc('minggu_ke')->first();
            }
            return $this->progress->opnameMingguan()->orderBy('minggu_ke', 'desc')->first();
        } elseif ($this->progress) {
            return $this->progress->opnameMingguan()->orderBy('minggu_ke', 'desc')->first();
        }
        return null;
    }

    public function getRealConstructionProgressPercentageAttribute(): float
    {
        $latest = $this->latest_opname;
        if ($latest && $latest->progress_kumulatif !== null && (float)$latest->progress_kumulatif > 0) {
            return (float) $latest->progress_kumulatif;
        }

        // Cek progres dari item-item RAB (halaman proses_pembangunan)
        if ($this->progress) {
            $items = $this->progress->relationLoaded('items') 
                ? $this->progress->items 
                : $this->progress->items()->get();

            if ($items && $items->count() > 0) {
                $totalAnggaran = (float) $items->sum('total');
                if ($totalAnggaran > 0) {
                    $weightedDone = (float) $items->sum(function($item) {
                        return ((float)$item->total) * (((float)($item->progress_persen ?? 0)) / 100);
                    });
                    $calculated = round(($weightedDone / $totalAnggaran) * 100, 1);
                    if ($calculated > 0) {
                        return $calculated;
                    }
                }
                $avg = round((float) $items->avg('progress_persen'), 1);
                if ($avg > 0) {
                    return $avg;
                }
            }
        }

        $map = [
            'belum_mulai' => 0.0,
            'pondasi'     => 20.0,
            'dinding'     => 40.0,
            'atap'        => 60.0,
            'finishing'   => 80.0,
            'selesai'     => 100.0,
        ];

        $cp = strtolower(trim((string)$this->construction_progress));
        return isset($map[$cp]) ? (float) $map[$cp] : 0.0;
    }

    /**
     * Total Nilai RAB Unit Pembangunan (Subtotal + PPN 10% persis formula halaman proses_pembangunan)
     */
    public function getTotalRabAttribute(): float
    {
        if ($this->progress) {
            $items = $this->progress->relationLoaded('items') 
                ? $this->progress->items 
                : $this->progress->items()->get();

            if ($items && $items->count() > 0) {
                $subtotal = (float) $items->sum('total');
                $ppn = round($subtotal * 0.1);
                return $subtotal + $ppn;
            }
        }
        return 0.0;
    }

    public function getTotalItemRabAttribute(): int
    {
        if ($this->progress) {
            $items = $this->progress->relationLoaded('items') 
                ? $this->progress->items 
                : $this->progress->items()->get();
            return $items ? $items->count() : 0;
        }
        return 0;
    }

    /**
     * Aksesor Legalitas Unit untuk Monitoring Legal
     */
    public function getLegalStatusKeyAttribute()
    {
        if (!empty($this->certificate_no)) {
            return 'selesai';
        }
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
        return !empty($this->certificate_no) ? $this->certificate_no : null;
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
