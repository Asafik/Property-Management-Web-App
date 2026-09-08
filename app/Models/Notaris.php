<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notaris extends Model
{
    use HasFactory;

    protected $table = 'notaris';

    protected $fillable = [
        'nama_notaris',
        'no_sk',
        'wilayah_kerja',
        'alamat_kantor',
        'telepon',
        'email',
        'nama_kontak_person',
        'nama_bank',
        'nomor_rekening',
        'atas_nama_rekening',
        'keterangan',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Scope untuk notaris yang aktif saja.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
