<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\LandBankUnit;
class Customer extends Model
{
    //
protected $fillable = [
    'customer_id',
    'status_kelengkapan',
    'guest_id',
    'land_bank_id',
    'unit_id',

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

    'instagram',
    'facebook',

    'province','city','subdistrict','village','rt','rw','postal_code','address',

    'phone','home_phone','email','office_email',

    'job_status','company_name','main_income','side_income','npwp','job_status_lainnya',

    'domicile_province','domicile_city','domicile_subdistrict','domicile_village',
    'domicile_rt','domicile_rw','domicile_postal_code','domicile_address',
];

public static function generateCustomerId(): string
{
    $today = now()->format('Ymd');
    $lastCustomer = self::whereDate('created_at', now()->today())
        ->orderBy('id', 'desc')
        ->first();

    if ($lastCustomer && $lastCustomer->customer_id) {
        $lastNumber = intval(substr($lastCustomer->customer_id, -3));
        $newNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
    } else {
        $newNumber = '001';
    }

    return 'CUST-' . $today . '-' . $newNumber;
}

public function getIsLengkapAttribute(): bool
{
    if ($this->status_kelengkapan === 'lengkap') {
        return true;
    }
    // Jika ada NIK valid, otomatis dianggap lengkap
    return !empty($this->nik);
}

public function units()
{
    return $this->hasMany(LandBankUnit::class, 'customer_id','id');
}
public function documents()
{
    return $this->hasMany(CustomerDocument::class);
}
public function landBank()
{
    return $this->belongsTo(LandBank::class);
}
public function guest()
{
    return $this->belongsTo(Guest::class);
}

}
