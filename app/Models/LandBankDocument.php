<?php

namespace App\Models;
use App\Models\DocumentTypes;
use Illuminate\Database\Eloquent\Model;

class LandBankDocument extends Model
{
    protected $fillable = [
        'land_bank_id',
            'document_type_id', // ← WAJIB ADA
        
        'file_path',
        'document_number',
        'status',
        'admin_notes',
        'revision_number'
    ];

    // Relasi ke LandBank
    public function landBank()
    {
        return $this->belongsTo(LandBank::class);
    }
    public function documentType()
{
    return $this->belongsTo(DocumentTypes::class);
}
}
