<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\LandBankUnit;

class Employee extends Authenticatable
{
    protected $table = 'employees';

    protected $fillable = [
        'name',
        'username',
        'password',
        'address',
        'role'
    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];

    // relasi
    public function landbankunits(){
        return $this->hasMany(LandBankUnit::class);
    }
}
