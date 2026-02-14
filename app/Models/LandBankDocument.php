<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LandBankDocument extends Model
{
    protected $fillable = [
        'land_bank_id',
        'type',
        'file_path',
        'document_number',
        'status',
        'catatan_admin',
        'revisi_ke'
    ];

    // Relasi ke LandBank
    public function landBank()
    {
        return $this->belongsTo(LandBank::class);
    }
}
