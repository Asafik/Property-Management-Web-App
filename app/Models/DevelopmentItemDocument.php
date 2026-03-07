<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DevelopmentItemDocument extends Model
{
    protected $fillable = [
        'development_progress_item_id',
        'file_path',
        'file_type',
    ];

    public function item()
    {
        return $this->belongsTo(DevelopmentProgressItem::class);
    }
}