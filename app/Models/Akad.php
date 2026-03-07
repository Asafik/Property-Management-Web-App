<?php

namespace App\Models;
use App\Models\Booking;
use Illuminate\Database\Eloquent\Model;

class Akad extends Model
{
    //
    protected $fillable = [
        'booking_id',
        'akad_date',
        'no_akad',
        'tanggal_akad',
        'dokumen',
        'catatan',
        'status',
        'alasan_batal',
        'tindakan',
    ];



    public function booking()
{
    return $this->belongsTo(Booking::class);
}
}
