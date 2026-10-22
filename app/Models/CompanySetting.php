<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanySetting extends Model
{
    use HasFactory;

    protected $table = 'company_settings';

    protected $fillable = [
        'company_name',
        'npwp',
        'address',
        'city',
        'province',
        'postal_code',
        'phone',
        'whatsapp',
        'email',
        'website',
        'founded_date',
        'logo',
        'favicon',
    ];

    protected $casts = [
        'founded_date' => 'date:Y-m-d',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
