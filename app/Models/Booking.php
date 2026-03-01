<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'unit_id',
        'customer_id',
        'sales_id',
        'agent_fee',
        'booking_code',
        'booking_fee',
        'booking_date',
        'purchase_type',
        'status',
        'notes',
    ];
    protected $casts = [
    'booking_date' => 'date',
    'dp_date' => 'date',
    'pelunasan_date' => 'date',
    'akad_date' => 'date',
    'serah_terima_date' => 'date',
];
    
    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    

    // Booking -> Unit
    public function unit()
    {
        return $this->belongsTo(LandBankUnit::class, 'unit_id');
    }

    // Booking -> Customer
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    // Booking -> Sales (Employee)
    public function sales()
    {
        return $this->belongsTo(Employee::class, 'sales_id');
    }

    // Booking -> KPR (1 booking 1 KPR)
    public function kprApplication()
    {
        return $this->hasOne(KprApplication::class, 'booking_id');
    }

    
    public function payments()
    {
        return $this->hasMany(Payment::class, 'booking_id');
    }
    public function akad()
{
    return $this->hasOne(Akad::class);
}
public function finalPayment()
{
    return $this->hasOne(Payment::class)->latestOfMany();
}
}