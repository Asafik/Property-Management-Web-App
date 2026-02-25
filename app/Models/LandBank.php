<?php

namespace App\Models;

use App\Models\LandBankDocument;
use Illuminate\Database\Eloquent\Model;

class LandBank extends Model
{
    //
    protected $fillable = [
        'name',
        'company_profile_id',
        'ceritificate_no',
        'ownership_status',
        'certificate_owner',
        'area',
        'remaining_area',
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
        'status',
        'elevasi_awal',
        'elevasi_rencana',
        'volume_cut',
        'volume_fill',
        'status_cut_fill',
    ];
    public function documents()
    {
        return $this->hasMany(LandBankDocument::class);
    }
    public function revisis()
    {
        return $this->hasMany(LandBankDocument::class)
            ->whereNotNull('revisi_ke')
            ->orderBy('revisi_ke');
    }
      public function units()
    {
        return $this->hasMany(LandBankUnit::class);
    }
    public function getCertificateNumberAttribute()
{
    $doc = $this->documents->where('type','sertifikat')->first();
    return $doc ? $doc->document_number : null;
}


public function companyProfile()
{
    return $this->belongsTo(CompanyProfile::class); 
}

}
