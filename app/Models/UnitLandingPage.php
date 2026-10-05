<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnitLandingPage extends Model
{
    use HasFactory;

    protected $table = 'unit_landing_pages';

    protected $fillable = [
        'land_bank_unit_id',
        'headline',
        'promo_badge',
        'description',
        'address',
        'features',
        'gallery',
        'bedrooms',
        'bathrooms',
        'carport',
        'floors',
        'electricity',
        'water',
        'certificate',
        'year_built',
        'condition',
        'sales_name',
        'sales_phone',
        'lat',
        'lng',
        'map_link',
        'is_published',
        'is_featured',
        'cicilan_estimasi',
        'dp_persen',
        'tenor_estimasi',
        'bank_partners',
    ];

    protected $casts = [
        'features' => 'array',
        'gallery' => 'array',
        'is_published' => 'boolean',
        'is_featured' => 'boolean',
        'lat' => 'float',
        'lng' => 'float',
        'dp_persen' => 'float',
    ];

    /**
     * Relasi ke LandBankUnit (Katalog Unit)
     */
    public function unit()
    {
        return $this->belongsTo(LandBankUnit::class, 'land_bank_unit_id');
    }
}
