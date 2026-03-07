<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class  Banks extends Model
{
    //
    protected $table = 'banks';
    protected $fillable = [
        'bank_name',
        'account_holder',
        'number',
        'is_active',
    ];
}
