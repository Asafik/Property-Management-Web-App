<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SerahTerima extends Model
{
    protected $table = 'serah_terimas';
    protected $fillable = [
    'booking_id',
    'no_bast',
    'tanggal_serah_terima',
    'lokasi_serah_terima',
    'catatan',
    'foto_serah_kunci',
    'foto_kondisi_unit',
];

public function items()
{
    return $this->hasMany(SerahTerimaItems::class);
}

public function documents()
{
    return $this->hasMany(SerahTerimaDocuments::class);
}
}
