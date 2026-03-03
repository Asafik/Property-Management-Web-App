<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KprApplication extends Model
{
    protected $fillable = [
        'unit_id',
        'customer_id',
        'booking_id',
        'banks_id',
        'sales_id',
        'harga_unit',
        'dp',
        'tenor',
        'jumlah_pinjaman',
        'bunga',
        'estimasi_angsuran',
        'status',
        'submitted_at',
        'approved_at',
        'rejected_at',
        'akad_at',
        'catatan',
        'berita_acara'
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
        return $this->belongsTo(Banks::class, 'banks_id');
    }

    public function sales()
    {
        return $this->belongsTo(Employee::class, 'sales_id');
    }
    public function documents()
{
    return $this->hasMany(KprDocument::class);
}
}
