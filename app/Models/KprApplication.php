<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KprApplication extends Model
{
    protected $fillable = [
        'unit_id',
        'customer_id',
        'booking_id',
        'bank_id',
        'sales_id',
        'harga_unit',
        'dp',
        'tenor',
        'estimasi_cicilan',
        'status',
        'submitted_at',
        'approved_at',
        'rejected_at',
        'akad_at',
        'catatan'
    ];

    // relasi
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function unit()
    {
        return $this->belongsTo(LandBankUnit::class);
    }

    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }

    public function sales()
    {
        return $this->belongsTo(Employee::class, 'sales_id');
    }
}
