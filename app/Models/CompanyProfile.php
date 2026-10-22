<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\LandBank;
class CompanyProfile extends Model
{
    //
    protected $fillable = [
        'name',
        'address',
        'phone',
        'file_akta_pendirian',
        'file_akta_perubahan',
        'file_npwp',
        'file_direksi',
        'file_nib',
        'file_domisili',
    ];

    public function landBanks()
    {
        return $this->hasMany(LandBank::class);
    }

    public function praLandbanks()
    {
        return $this->hasMany(PraLandbank::class, 'company_profile_id');
    }

    /**
     * Check count of uploaded legal documents (out of 6)
     */
    public function getUploadedLegalDocsCountAttribute(): int
    {
        $fields = [
            'file_akta_pendirian',
            'file_akta_perubahan',
            'file_npwp',
            'file_direksi',
            'file_nib',
            'file_domisili',
        ];
        $count = 0;
        foreach ($fields as $f) {
            if (!empty($this->$f)) {
                $count++;
            }
        }
        return $count;
    }

    public function getIsLegalCompleteAttribute(): bool
    {
        return $this->uploaded_legal_docs_count === 6;
    }
}
