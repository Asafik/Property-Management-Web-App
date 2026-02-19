<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\LandBankUnit;
class Customer extends Model
{
    //
    protected $fillable = [
    'customer_id',
    'full_name',
    'nickname',
    'nik',
    'no_kk',
    'birthplace',
    'date_birth',
    'age',
    'gender',
    'religion',
    'nationality',
    'marital_status',
    'marital_date',
    'child_count',

    'spouse_name',
    'spouse_nik',
    'father_name',
    'mother_name',

    'province','city','subdistrict','village','rt','rw','postal_code','address',

    'phone','home_phone','email','office_email',

    'job_status','company_name','main_income','side_income','npwp'
];
public function units()
{
    return $this->hasMany(LandBankUnit::class, 'customer_id','id');
}

}
