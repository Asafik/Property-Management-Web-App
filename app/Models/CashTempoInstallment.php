<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CashTempoInstallment extends Model
{
    protected $fillable = [
        'cash_tempo_id',
        'bulan_ke',
        'jatuh_tempo',
        'nominal_angsuran',
        'sisa_pokok',
        'status',
        'tanggal_bayar'
    ];

    public function cashTempo()
    {
        return $this->belongsTo(CashTempo::class);
    }
}