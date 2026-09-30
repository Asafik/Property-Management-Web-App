<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DevelopmentProgress extends Model
{
    protected $table = 'development_progress';

    protected $fillable = [
        'land_bank_unit_id',
        'title',
        'status',
        'total_anggaran',
        'deadline'
    ];

    public function unit()
    {
        return $this->belongsTo(LandBankUnit::class, 'land_bank_unit_id');
    }

    public function items()
    {
        return $this->hasMany(DevelopmentProgressItem::class, 'development_progress_id');
    }

    public function pembayaranTermin()
    {
        return $this->hasMany(\App\Models\PembayaranTermin::class, 'development_progress_id')->orderBy('termin_ke');
    }

    public function opnameMingguan()
    {
        return $this->hasMany(\App\Models\OpnameMingguan::class, 'development_progress_id')->orderBy('minggu_ke');
    }
    public function deadlines()
    {
        return $this->hasMany(\App\Models\RabDeadline::class, 'development_progress_id');
    }
}
