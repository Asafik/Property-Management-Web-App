<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\LandBankUnit;

class Employee extends Model
{
    //
    protected $fillable = [
        'name',
        'username',
        'password',
        'address',
        'role'
    ];

    public function landbankunits(){
        return $this->hasMany(LandBankUnit::class);
    }
}
