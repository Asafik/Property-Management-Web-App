<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    use HasFactory;

    protected $fillable = [
        'ticket_number',
        'booking_id',
        'unit_id',
        'customer_id',
        'kategori',
        'judul_keluhan',
        'deskripsi',
        'prioritas',
        'status',
        'tanggal_pengajuan',
        'tanggal_selesai',
        'foto_keluhan',
        'foto_penyelesaian',
        'petugas_penanggung_jawab',
        'catatan_perbaikan',
        'biaya_perbaikan',
    ];

    protected $casts = [
        'tanggal_pengajuan' => 'date',
        'tanggal_selesai' => 'date',
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function unit()
    {
        return $this->belongsTo(LandBankUnit::class, 'unit_id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
