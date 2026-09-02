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
        'denah',
        'description',
        'status',
        'elevasi_awal',
        'elevasi_rencana',
        'volume_cut',
        'volume_fill',
        'status_cut_fill',
        'fee_document_verification',
    ];
    public function documents()
    {
        return $this->hasMany(LandBankDocument::class);
    }
    public function getMergedDocumentsAttribute()
    {
        $docs = $this->documents;
        if ($docs->count() > 0) {
            return $docs;
        }

        $pra = \App\Models\PraLandbank::where('land_name', $this->name)->first();
        if ($pra) {
            return $pra->documents;
        }

        return collect();
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
public function guests()
{
    return $this->hasMany(Guest::class);
}
public function infrastructures()
{
    return $this->hasMany(LandBankInfrastructure::class, 'land_bank_id');
}

public function expenses()
{
    return $this->hasMany(LandBankInfrastructureExpense::class, 'land_bank_id');
}

public function getTotalInfrastructureExpenseAttribute(): float
{
    return (float) $this->expenses()->sum('total_amount');
}

public function getOverallInfrastructureProgressAttribute()
{
    $items = $this->infrastructures;
    if ($items->count() === 0) {
        return in_array(strtolower($this->development_status), ['selesai', 'done']) ? 100 : 0;
    }

    $totalBobot = $items->sum('bobot_persen');
    if ($totalBobot > 0) {
        $weightedProgress = 0;
        foreach ($items as $item) {
            $weightedProgress += ($item->progress_percent * ($item->bobot_persen / $totalBobot));
        }
        return round($weightedProgress, 1);
    }

    return round($items->avg('progress_percent'), 1);
}

public function initializeDefaultInfrastructures()
{
    if ($this->infrastructures()->count() === 0) {
        foreach (LandBankInfrastructure::getDefaultItems() as $item) {
            $this->infrastructures()->create($item);
        }
    }
    return $this->infrastructures;
}

public function getPhaseProgress(int $phase): float
{
    $items = $this->infrastructures()->where('phase', $phase)->get();
    if ($items->isEmpty()) {
        return 0.0;
    }

    $totalBobot = $items->sum('bobot_persen');
    if ($totalBobot > 0) {
        $weighted = 0;
        foreach ($items as $item) {
            $weighted += ($item->progress_percent * ($item->bobot_persen / $totalBobot));
        }
        return round($weighted, 1);
    }

    return round($items->avg('progress_percent') ?? 0, 1);
}

public function getPhaseStatus(int $phase): string
{
    $progress = $this->getPhaseProgress($phase);
    if ($progress >= 100) {
        return 'Selesai';
    } elseif ($progress > 0) {
        return 'Proses';
    }
    return 'Belum Mulai';
}

public function canCreateKavling(): bool
{
    // Validasi Ganda untuk Membuka Tambah Kavling:
    // 1. Status Legalitas Wajib Terverifikasi (verified)
    $isLegalVerified = ($this->legal_status === 'verified') || $this->isFromPraLandbank();

    // 2. Pengolahan Lahan / Pembangunan Wajib 100% Selesai
    $isDevSelesai = in_array(strtolower($this->development_status), ['selesai', 'done']) || $this->overall_infrastructure_progress >= 100;

    return $isLegalVerified && $isDevSelesai;
}

public function isFromPraLandbank()
{
    return \App\Models\PraLandbank::where('land_name', $this->name)->exists();
}

public function isProfileComplete(): bool
{
    // Cek apakah data profil penting sudah dilengkapi
    return !empty($this->company_profile_id) 
        && !empty($this->name) 
        && !empty($this->area) 
        && !empty($this->address)
        && !empty($this->denah);
}

public function getMissingProfileFields(): array
{
    $missing = [];
    if (empty($this->company_profile_id)) $missing[] = 'PT Mitra Pengembang';
    if (empty($this->denah)) $missing[] = 'Berkas Denah / Siteplan';
    if (empty($this->address)) $missing[] = 'Alamat / Lokasi Lengkap';
    if (empty($this->lat) || empty($this->lng)) $missing[] = 'Koordinat Peta';
    return $missing;
}

public function getGrandTotalAcquisitionPriceAttribute(): float
{
    $pra = \App\Models\PraLandbank::where('land_name', $this->name)->first();
    if ($pra) {
        if ($pra->invoice && $pra->invoice->total_amount > 0) {
            return (float) $pra->invoice->total_amount;
        }
        $deal = (float) ($pra->deal_price ?: ($pra->estimated_price ?: ($this->acquisition_price ?: 0)));
        $costs = (float) $pra->cost_ijb + (float) $pra->cost_tax + (float) $pra->cost_broker + (float) $pra->cost_other;
        if ($deal + $costs > 0) {
            return $deal + $costs;
        }
    }

    return (float) ($this->acquisition_price ?? 0);
}
}
