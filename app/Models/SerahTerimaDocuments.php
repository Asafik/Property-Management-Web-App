<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SerahTerimaDocuments extends Model
{
    //
    protected $fillable = [
    'serah_terima_id',
    'document_name',
    'is_submitted',
    'status',
];
}
