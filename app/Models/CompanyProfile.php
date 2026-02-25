<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\LandBank;
class CompanyProfile extends Model
{
    //
    protected $fillable = [
        'name',
        'address',
        'phone',
    ];

    public function landBanks()
    {
        return $this->hasMany(LandBank::class);
    }
}
