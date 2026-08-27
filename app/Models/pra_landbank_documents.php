<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class pra_landbank_documents extends Model
{
    //
    protected $fillable = [
        'pra_landbank_id',
        'document_type_id',
        'document_number',
        'file_path',
        'status',
        'revision_number'
    ];

    public function praLandbank()
    {
        return $this->belongsTo(PraLandbank::class);
    }

    public function documentType()
    {
        return $this->belongsTo(DocumentTypes::class, 'document_type_id');
    }
}
