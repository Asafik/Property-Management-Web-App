<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LandBankInfrastructure extends Model
{
    use HasFactory;

    protected $fillable = [
        'land_bank_id',
        'phase',
        'item_name',
        'category',
        'volume',
        'target_volume',
        'realized_volume',
        'volume_unit',
        'bobot_persen',
        'progress_percent',
        'status',
        'target_start',
        'target_end',
        'contractor_name',
        'cost_estimate',
        'photo_proof',
        'notes',
    ];

    protected $casts = [
        'phase'            => 'integer',
        'target_volume'    => 'float',
        'realized_volume'  => 'float',
        'bobot_persen'     => 'float',
        'progress_percent' => 'float',
        'cost_estimate'    => 'float',
        'target_start'     => 'date',
        'target_end'       => 'date',
    ];

    public function landBank()
    {
        return $this->belongsTo(LandBank::class, 'land_bank_id');
    }

    public function expenses()
    {
        return $this->hasMany(LandBankInfrastructureExpense::class, 'land_bank_infrastructure_id');
    }

    public function logs()
    {
        return $this->hasMany(LandBankInfrastructureLog::class, 'land_bank_infrastructure_id')->latest('log_date');
    }

    public function getTotalExpenseAttribute(): float
    {
        return (float) $this->expenses()->sum('total_amount');
    }

    /**
     * Recalculate and update progress percent based on target and realized volume
     */
    public function recalculateProgress(): float
    {
        $target = (float) $this->target_volume;
        $realized = (float) $this->realized_volume;

        if ($target > 0) {
            $pct = round(min(100, ($realized / $target) * 100), 1);
        } else {
            $pct = $realized > 0 ? 100.0 : 0.0;
        }

        $this->progress_percent = $pct;
        if ($pct >= 100) {
            $this->status = 'selesai';
        } elseif ($pct > 0) {
            $this->status = 'proses';
        } else {
            $this->status = 'belum_mulai';
        }

        $this->save();
        return $pct;
    }

    /**
     * Get default standard infrastructure items organized by Phase with realistic target volumes & units
     */
    public static function getDefaultItems(): array
    {
        return [
            // FASE 1: PEMATANGAN LAHAN & CUT-FILL
            [
                'phase'            => 1,
                'item_name'        => 'Cut & Fill / Pembersihan & Perataan Lahan',
                'category'         => 'Pematangan Lahan',
                'volume'           => '1.500 m³',
                'target_volume'    => 1500,
                'realized_volume'  => 0,
                'volume_unit'      => 'm³',
                'bobot_persen'     => 50.0,
                'progress_percent' => 0,
                'status'           => 'belum_mulai',
                'notes'            => 'Pembersihan semak, galian, timbunan, dan perataan kontur tanah utama.'
            ],
            [
                'phase'            => 1,
                'item_name'        => 'Pemadatan Tanah & Pembentukan Badan Kawasan',
                'category'         => 'Pematangan Lahan',
                'volume'           => '10.000 m²',
                'target_volume'    => 10000,
                'realized_volume'  => 0,
                'volume_unit'      => 'm²',
                'bobot_persen'     => 50.0,
                'progress_percent' => 0,
                'status'           => 'belum_mulai',
                'notes'            => 'Pemadatan sub-grade menggunakan vibro roller dan pembentukan peil elevasi.'
            ],

            // FASE 2: DRAINASE & AKSES JALAN KAWASAN
            [
                'phase'            => 2,
                'item_name'        => 'Pembangunan Selokan & Saluran Drainase (U-Ditch)',
                'category'         => 'Drainase & Sanitasi',
                'volume'           => '600 Meter',
                'target_volume'    => 600,
                'realized_volume'  => 0,
                'volume_unit'      => 'meter',
                'bobot_persen'     => 50.0,
                'progress_percent' => 0,
                'status'           => 'belum_mulai',
                'notes'            => 'Pemasangan saluran beton U-Ditch 40x40 dan gorong-gorong pembuangan utama.'
            ],
            [
                'phase'            => 2,
                'item_name'        => 'Pengerasan & Paving / Pengaspalan Jalan Kawasan',
                'category'         => 'Aksesibilitas Jalan',
                'volume'           => '2.500 m²',
                'target_volume'    => 2500,
                'realized_volume'  => 0,
                'volume_unit'      => 'm²',
                'bobot_persen'     => 50.0,
                'progress_percent' => 0,
                'status'           => 'belum_mulai',
                'notes'            => 'Pemasangan paving block K-300 / aspal hotmix dan kanstein pembatas jalan.'
            ],

            // FASE 3: UTILITAS LINGKUNGAN (PJU, AIR, LISTRIK & GERBANG)
            [
                'phase'            => 3,
                'item_name'        => 'Pemasangan Tiang & Lampu PJU (Penerangan Jalan)',
                'category'         => 'PJU & Penerangan',
                'volume'           => '35 Titik',
                'target_volume'    => 35,
                'realized_volume'  => 0,
                'volume_unit'      => 'titik tiang',
                'bobot_persen'     => 30.0,
                'progress_percent' => 0,
                'status'           => 'belum_mulai',
                'notes'            => 'Instalasi tiang oktagonal 7m, lampu LED 60W, dan kabel power bawah tanah.'
            ],
            [
                'phase'            => 3,
                'item_name'        => 'Jaringan Distribusi Air Bersih (PDAM / Sumur Bor)',
                'category'         => 'Jaringan Air Bersih',
                'volume'           => '800 Meter',
                'target_volume'    => 800,
                'realized_volume'  => 0,
                'volume_unit'      => 'meter pipa',
                'bobot_persen'     => 30.0,
                'progress_percent' => 0,
                'status'           => 'belum_mulai',
                'notes'            => 'Pemasangan pipa PVC AW distribusi air bersih ke seluruh batas kavling.'
            ],
            [
                'phase'            => 3,
                'item_name'        => 'Jaringan Listrik PLN & Pembangunan Gerbang Kawasan',
                'category'         => 'Jaringan Listrik & Gerbang',
                'volume'           => '1 Paket',
                'target_volume'    => 1,
                'realized_volume'  => 0,
                'volume_unit'      => 'paket',
                'bobot_persen'     => 40.0,
                'progress_percent' => 0,
                'status'           => 'belum_mulai',
                'notes'            => 'Penyambungan trafo PLN kawasan, gapura ikonik kawasan, dan pos keamanan.'
            ],
        ];
    }
}
