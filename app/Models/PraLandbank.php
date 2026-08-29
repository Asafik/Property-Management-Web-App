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
        'dp_amount',
        'file_dp',
        'land_owner',
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
        'facility_school',
        'facility_hospital',
        'facility_market',
        'facility_transport',
        'facility_mall',
        'facility_bank',
        'status',
        'file_certificate',
        'photo',
        'priority',
        'cost_ijb',
        'cost_tax',
        'cost_broker',
        'cost_other',
        'file_ijb',
        'no_akta',
        'file_tax',
        'no_pajak',
        'no_kkpr',
        'file_kkpr',
        'no_siteplan',
        'file_siteplan',
        'no_shgb',
        'file_shgb',
        'no_pbg',
        'file_pbg',
        'payment_method',
        'installment_duration',
        'installment_count',
        'notes'
    ];

    public function documents()
    {
        return $this->hasMany(pra_landbank_documents::class);
    }

    public function payments()
    {
        return $this->hasMany(PraLandbankPayment::class, 'pra_landbank_id');
    }
}