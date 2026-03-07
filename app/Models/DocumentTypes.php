<?php

namespace App\Models;

use App\Models\LandBankDocument;
use Illuminate\Database\Eloquent\Model;

class DocumentTypes extends Model
{
    //
    protected $fillable = [
        'name',
        'code',
        'has_expiry'
    ];
 public function documents()
    {
        return $this->hasMany(LandBankDocument::class);
    }
}