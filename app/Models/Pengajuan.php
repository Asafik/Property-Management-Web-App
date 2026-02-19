<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pengajuan extends Model
{
    use HasFactory;

    protected $table = 'pengajuans';

    protected $fillable = [
        'customer_id',
        'unit_id',
        'marketing_id',
        'payment_method',
        'unit_price',
        'down_payment',
        'installment_duration',
        'monthly_installment',
        'status',
    ];

    // ================= RELATION =================

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function unit()
    {
        return $this->belongsTo(LandBankUnit::class, 'unit_id');
    }

    public function marketing()
    {
        return $this->belongsTo(Employee::class, 'marketing_id');
    }

    public function kprApplication()
    {
        return $this->hasOne(KprApplication::class, 'pengajuan_id');
    }
}
