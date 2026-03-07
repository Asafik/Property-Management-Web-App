<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    //
    public function uploads()
{
    return $this->hasMany(DocumentUpload::class);
}
}
