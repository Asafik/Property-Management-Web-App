<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LandBank extends Model
{
    //
    protected $fillable = [
        'name',
        'ceritificate_no',
        'ownership_status',
        'cerificate_owner',
        'area',
        'acquisition_price',
        'acquisition_date',
        'imb_no',
        'pbb_no',
        'address',
        'village',
        'district',
        'city',
        'province',
        'postal_code',
        'zoning',
        'road_width',
        'road_type',
        'facility_school',
        'facility_hospital',
        'facility_mall',
        'facility_transport',
        'legal_status',
        'development_status',
        'priority',
        'lat',
        'lng',
        'file_certificate',
        'file_imb',
        'file_pbb',
        'photo',
        'description',
        'status'
    ];
}
