<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CashTempo extends Model
{
    protected $fillable = [
        'booking_id',
        'harga_unit',
        'diskon',
        'booking_fee',
        'dp',
        'sisa_pembayaran',
        'tenor_bulan',
        'tanggal_mulai_angsuran',
        'tanggal_jatuh_tempo_akhir',
        'denda_persen',
        'metode_pembayaran',
        'status'
    ];

    public function installments()
    {
        return $this->hasMany(CashTempoInstallment::class);
    }

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}