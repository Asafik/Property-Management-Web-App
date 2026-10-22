<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LandBankInfrastructureExpense extends Model
{
    use HasFactory;

    protected $table = 'land_bank_infrastructure_expenses';

    protected $fillable = [
        'land_bank_id',
        'land_bank_infrastructure_id',
        'phase',
        'material_id',
        'expense_code',
        'item_name',
        'category',
        'quantity',
        'unit',
        'unit_price',
        'total_amount',
        'expense_date',
        'vendor_name',
        'payment_method',
        'payment_status',
        'receipt_proof',
        'recorded_by',
        'notes',
    ];

    protected $casts = [
        'quantity' => 'decimal:2',
        'unit_price' => 'decimal:2',
        'total_amount' => 'decimal:2',
        'expense_date' => 'date',
    ];

    public function landBank()
    {
        return $this->belongsTo(LandBank::class, 'land_bank_id');
    }

    public function infrastructure()
    {
        return $this->belongsTo(LandBankInfrastructure::class, 'land_bank_infrastructure_id');
    }

    public function masterMaterial()
    {
        return $this->belongsTo(InfrastructureMaterial::class, 'material_id');
    }

    public function recorder()
    {
        return $this->belongsTo(Employee::class, 'recorded_by');
    }

    /**
     * Auto generate expense code
     */
    public static function generateCode($landBankId)
    {
        $count = self::where('land_bank_id', $landBankId)->count() + 1;
        return 'EXP-LB' . $landBankId . '-' . date('Ym') . '-' . str_pad($count, 3, '0', STR_PAD_LEFT);
    }
}
