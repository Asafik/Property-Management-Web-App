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
        'has_expiry',
        'applicable_categories',
    ];

    protected $casts = [
        'applicable_categories' => 'array',
        'has_expiry' => 'boolean',
    ];

    public function documents()
    {
        return $this->hasMany(LandBankDocument::class);
    }
}