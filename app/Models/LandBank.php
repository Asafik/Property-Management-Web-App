<?php

namespace App\Models;

use App\Models\LandBankDocument;
use Illuminate\Database\Eloquent\Model;

class LandBank extends Model
{
    //
    protected $fillable = [
        'name',
        'ceritificate_no',
        'ownership_status',
        'certificate_owner',
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
    public function getCertificateNumberAttribute()
{
    $doc = $this->documents->where('type','sertifikat')->first();
    return $doc ? $doc->document_number : null;
}

}
