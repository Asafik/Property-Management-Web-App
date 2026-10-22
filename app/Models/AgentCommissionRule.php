<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgentCommissionRule extends Model
{
    use HasFactory;

    protected $table = 'agent_commission_rules';

    protected $fillable = [
        'name',
        'land_bank_id',
        'target_type',
        'calculation_type',
        'value',
        'min_price',
        'max_price',
        'is_active',
        'description',
    ];

    protected $casts = [
        'value'      => 'decimal:2',
        'min_price'  => 'decimal:2',
        'max_price'  => 'decimal:2',
        'is_active'  => 'boolean',
    ];

    public function landBank()
    {
        return $this->belongsTo(LandBank::class, 'land_bank_id');
    }

    /**
     * Hitung komisi otomatis berdasarkan harga, jenis (subsidi/komersil), dan proyek.
     *
     * @param float|int $unitPrice
     * @param string|null $jenis ('subsidi', 'komersil', dll)
     * @param int|null $landBankId
     * @return array ['fee' => float, 'rule' => AgentCommissionRule|null, 'description' => string]
     */
    public static function calculateCommission($unitPrice, $jenis = 'komersil', $landBankId = null)
    {
        $unitPrice = floatval(preg_replace('/[^0-9.]/', '', strval($unitPrice)));
        $jenisClean = strtolower(trim($jenis ?? 'komersil'));

        $rules = self::where('is_active', true)->get();

        // 1. Coba cari aturan spesifik project & spesifik jenis
        $matchedRule = $rules->first(function ($r) use ($landBankId, $jenisClean, $unitPrice) {
            if ($r->land_bank_id && $r->land_bank_id == $landBankId && $r->target_type === $jenisClean) {
                if ($r->min_price && $unitPrice < $r->min_price) return false;
                if ($r->max_price && $unitPrice > $r->max_price) return false;
                return true;
            }
            return false;
        });

        // 2. Coba cari aturan spesifik project & target all
        if (!$matchedRule) {
            $matchedRule = $rules->first(function ($r) use ($landBankId, $unitPrice) {
                if ($r->land_bank_id && $r->land_bank_id == $landBankId && $r->target_type === 'all') {
                    if ($r->min_price && $unitPrice < $r->min_price) return false;
                    if ($r->max_price && $unitPrice > $r->max_price) return false;
                    return true;
                }
                return false;
            });
        }

        // 3. Coba cari aturan global spesifik jenis (misal: semua komersil atau semua subsidi)
        if (!$matchedRule) {
            $matchedRule = $rules->first(function ($r) use ($jenisClean, $unitPrice) {
                if (empty($r->land_bank_id) && $r->target_type === $jenisClean) {
                    if ($r->min_price && $unitPrice < $r->min_price) return false;
                    if ($r->max_price && $unitPrice > $r->max_price) return false;
                    return true;
                }
                return false;
            });
        }

        // 4. Coba cari aturan global target all
        if (!$matchedRule) {
            $matchedRule = $rules->first(function ($r) use ($unitPrice) {
                if (empty($r->land_bank_id) && $r->target_type === 'all') {
                    if ($r->min_price && $unitPrice < $r->min_price) return false;
                    if ($r->max_price && $unitPrice > $r->max_price) return false;
                    return true;
                }
                return false;
            });
        }

        if (!$matchedRule) {
            // Default fallback jika tidak ada aturan sama sekali: 2.5% komersil, Rp 3.5jt subsidi
            if ($jenisClean === 'subsidi') {
                return [
                    'fee' => 3500000,
                    'rule' => null,
                    'formula' => 'Default Subsidi (Rp 3.500.000)',
                ];
            } else {
                $calculated = round(($unitPrice * 2.5) / 100);
                return [
                    'fee' => $calculated,
                    'rule' => null,
                    'formula' => 'Default Komersil 2.5% (' . number_format($calculated, 0, ',', '.') . ')',
                ];
            }
        }

        // Hitung nilai fee
        if ($matchedRule->calculation_type === 'percentage') {
            $fee = round(($unitPrice * floatval($matchedRule->value)) / 100);
            $formula = "{$matchedRule->name} ({$matchedRule->value}% = Rp " . number_format($fee, 0, ',', '.') . ")";
        } else {
            $fee = round(floatval($matchedRule->value));
            $formula = "{$matchedRule->name} (Nominal Flat Rp " . number_format($fee, 0, ',', '.') . ")";
        }

        return [
            'fee' => $fee,
            'rule' => $matchedRule,
            'formula' => $formula,
        ];
    }
}
