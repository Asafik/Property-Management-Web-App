<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = [
        'name',
        'description',
        'required',
        'accept',
        'icon',
    ];
    //
    public function uploads()
{
    return $this->hasMany(DocumentUpload::class);
}
}
