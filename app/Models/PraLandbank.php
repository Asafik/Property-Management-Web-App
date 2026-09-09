<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PraLandbank extends Model
{
    protected $fillable = [
        'land_name',
        'area',
        'offer_price',
        'estimated_price',
        'deal_price',
        'land_owner',
        'ownership_status',
        'owner_name',
        'certificate_owner',
        'owner_contact',
        'land_source',
        'address',
        'village',
        'district',
        'city',
        'province',
        'lat',
        'lng',
        'survey_date',
        'survey_by',
        'survey_result',
        'land_status',
        'water_condition',
        'survey_notes',
        'zoning',
        'road_width',
        'road_type',
        'legal_status',
        'legal_issue_note',
        'permit_difficulty',
        'permit_difficulty_note',
        'facility_school',
        'facility_hospital',
        'facility_market',
        'facility_transport',
        'facility_mall',
        'facility_bank',
        'status',
        'file_certificate',
        'photo',
        'photo_2',
        'priority',
        'land_protection_status',
        'pbb_status',
        'pbb_note',
        'pbb_nominal',
        'notaris_id',
        'notary_appointment_date',
        'cost_ijb',
        'cost_tax',
        'cost_broker',
        'cost_other',
        'file_ijb',
        'file_tax',
        'receipt_file',
        'tax_pph_file',
        'release_deed_file',
        'payment_method',
        'installment_duration',
        'installment_count',
        'notes',
        'company_profile_id',
    ];

    public function documents()
    {
        return $this->hasMany(pra_landbank_documents::class);
    }

    public function payments()
    {
        return $this->hasMany(PraLandbankPayment::class, 'pra_landbank_id');
    }

    public function invoice()
    {
        return $this->hasOne(Invoice::class, 'pra_landbank_id');
    }

    public function notaris()
    {
        return $this->belongsTo(Notaris::class, 'notaris_id');
    }

    public function companyProfile()
    {
        return $this->belongsTo(CompanyProfile::class, 'company_profile_id');
    }
}