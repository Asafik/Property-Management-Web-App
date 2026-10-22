<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KprDisbursement extends Model
{
    use HasFactory;

    protected $table = 'kpr_disbursements';

    protected $fillable = [
        'kpr_application_id',
        'land_bank_unit_id',
        'booking_id',
        'termin_ke',
        'nama_termin',
        'nominal_cair',
        'tanggal_cair',
        'bank_penyalur',
        'rekening_tujuan',
        'no_referensi_bank',
        'bukti_transfer',
        'catatan',
        'created_by',
    ];

    protected $casts = [
        'nominal_cair' => 'float',
        'tanggal_cair' => 'date',
        'termin_ke'    => 'integer',
    ];

    public function kprApplication()
    {
        return $this->belongsTo(KprApplication::class, 'kpr_application_id');
    }

    public function unit()
    {
        return $this->belongsTo(LandBankUnit::class, 'land_bank_unit_id');
    }

    public function booking()
    {
        return $this->belongsTo(Booking::class, 'booking_id');
    }

    public function creator()
    {
        return $this->belongsTo(Employee::class, 'created_by');
    }
}
