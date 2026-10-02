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
        'certificate_no',
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
        'facility_market',
        'facility_transport',
        'facility_mall',
        'facility_bank',
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
        'fee_document_verification',
        'custom_workflow_docs',
        'desa_reg_no',
        'desa_reg_date',
        'desa_doc_file',
        'pertek_no',
        'pertek_date',
        'pertek_file',
        'peta_bidang_no',
        'peta_bidang_date',
        'peta_bidang_area',
        'peta_bidang_file',
        'pkkpr_no',
        'pkkpr_date',
        'pkkpr_status',
        'pkkpr_file',
        'sk_hgb_no',
        'sk_hgb_date',
        'sk_hgb_file',
        'shgb_induk_no',
        'shgb_induk_date',
        'shgb_induk_area',
        'shgb_induk_file',
        'notaris_id',
        'notaris_name',
    ];

    public function notary()
    {
        return $this->belongsTo(Notaris::class, 'notaris_id');
    }

    public function getNamaLandBankAttribute(): ?string
    {
        return $this->attributes['name'] ?? null;
    }

    public function notaris()
    {
        return $this->belongsTo(Notaris::class, 'notaris_id');
    }

    protected $casts = [
        'custom_workflow_docs' => 'array',
        'acquisition_date'     => 'date',
        'desa_reg_date'        => 'date',
        'pertek_date'          => 'date',
        'peta_bidang_date'     => 'date',
        'pkkpr_date'           => 'date',
        'sk_hgb_date'          => 'date',
        'shgb_induk_date'      => 'date',
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

public function getPerizinanPemecahanKavlingDetail(): array
{
    $pra = \App\Models\PraLandbank::where('land_bank_id', $this->id)
        ->orWhere('land_name', $this->name)
        ->first();

    $projectIds = array_values(array_filter([$this->id, $pra?->id, $this->id + 100]));
    $projectNames = array_values(array_filter([$this->name, $pra?->land_name]));

    // 1. Cek dari PerizinanTask
    try {
        $task = \App\Models\PerizinanTask::where(function($q) use ($projectIds, $projectNames) {
                $q->whereIn('proyek_id', $projectIds)
                  ->orWhereIn('proyek_nama', $projectNames);
            })
            ->where(function($q) {
                $q->where('master_dokumen_id', 12)
                  ->orWhere('nama_tugas', 'like', '%Pemecahan SHGB Induk%')
                  ->orWhere('nama_tugas', 'like', '%POIN-18%');
            })
            ->first();

        if ($task) {
            $taskStatus = strtolower(trim($task->status ?? ''));
            $progress = (int) ($task->progress ?? 0);

            if ($taskStatus === 'selesai' || $progress >= 100) {
                return [
                    'status'   => 'terbit',
                    'label'    => 'Terbit / Selesai',
                    'progress' => max(100, $progress),
                    'source'   => 'task',
                    'task'     => $task,
                    'proyek_id'=> $pra?->id ?? $this->id,
                ];
            }

            if (in_array($taskStatus, ['dalam proses', 'proses', 'berjalan']) || $progress > 0 || !empty($task->nomor_dokumen) || !empty($task->file_dokumen)) {
                return [
                    'status'   => 'proses',
                    'label'    => 'Dalam Proses',
                    'progress' => $progress > 0 ? $progress : 50,
                    'source'   => 'task',
                    'task'     => $task,
                    'proyek_id'=> $pra?->id ?? $this->id,
                ];
            }

            return [
                'status'   => 'belum',
                'label'    => 'Belum Diproses',
                'progress' => 0,
                'source'   => 'task',
                'task'     => $task,
                'proyek_id'=> $pra?->id ?? $this->id,
            ];
        }
    } catch (\Throwable $e) {
        // Fallback jika ada isu query
    }

    // 2. Cek dari custom_workflow_docs (pada LandBank atau PraLandbank)
    $docs = $this->custom_workflow_docs ?? $pra?->custom_workflow_docs ?? [];
    if (is_array($docs)) {
        foreach ($docs as $doc) {
            $isMatch = (!empty($doc['master_id']) && $doc['master_id'] == 12)
                || (!empty($doc['kode_dokumen']) && $doc['kode_dokumen'] === 'POIN-18')
                || (!empty($doc['id']) && $doc['id'] === 'template_pecah_kavling')
                || (!empty($doc['doc_name']) && str_contains(strtolower($doc['doc_name']), 'pemecahan shgb'));

            if ($isMatch) {
                $stLower = strtolower(trim($doc['status'] ?? ''));
                $prg = (int) ($doc['progress'] ?? 0);

                if (in_array($stLower, ['terbit', 'selesai']) || $prg >= 100) {
                    return [
                        'status'   => 'terbit',
                        'label'    => 'Terbit / Selesai',
                        'progress' => max(100, $prg),
                        'source'   => 'workflow',
                        'doc'      => $doc,
                        'proyek_id'=> $pra?->id ?? $this->id,
                    ];
                }

                if (in_array($stLower, ['proses', 'berjalan']) || $prg > 0 || !empty($doc['doc_number']) || !empty($doc['file_path'])) {
                    return [
                        'status'   => 'proses',
                        'label'    => 'Dalam Proses',
                        'progress' => $prg > 0 ? $prg : 50,
                        'source'   => 'workflow',
                        'doc'      => $doc,
                        'proyek_id'=> $pra?->id ?? $this->id,
                    ];
                }

                return [
                    'status'   => 'belum',
                    'label'    => 'Belum Diproses',
                    'progress' => 0,
                    'source'   => 'workflow',
                    'doc'      => $doc,
                    'proyek_id'=> $pra?->id ?? $this->id,
                ];
            }
        }
    }

    return [
        'status'   => 'belum',
        'label'    => 'Belum Diproses',
        'progress' => 0,
        'source'   => 'default',
        'proyek_id'=> $pra?->id ?? $this->id,
    ];
}

public function isIzinPecahKavlingReady(): bool
{
    $detail = $this->getPerizinanPemecahanKavlingDetail();
    return in_array($detail['status'], ['proses', 'terbit']);
}

public function canCreateKavling(): bool
{
    // Validasi untuk Membuka Tambah Kavling:
    // 1. Status Legalitas Wajib Terverifikasi (verified) atau berasal dari PraLandbank
    $isLegalVerified = ($this->legal_status === 'verified') || $this->isFromPraLandbank();

    // 2. Syarat Baru (Opsi A): Dokumen Perizinan POIN-18 "Proses Pemecahan SHGB Induk Perkavling"
    // minimal sudah berstatus 'proses' atau 'terbit' (tidak menunggu fisik pengolahan lahan 100% selesai)
    $isIzinReady = $this->isIzinPecahKavlingReady();

    return $isLegalVerified && $isIzinReady;
}

public function isFromPraLandbank()
{
    return \App\Models\PraLandbank::where('land_name', $this->name)->exists();
}

public function getProfileScoreAttribute(): int
{
    $checklist = $this->core_profile_checklist;
    $total = count($checklist);
    if ($total === 0) return 100;
    $filled = collect($checklist)->where('is_filled', true)->count();
    return (int) round(($filled / $total) * 100);
}

public function getCoreProfileChecklistAttribute(): array
{
    return [
        [
            'field' => 'company_profile_id',
            'label' => 'PT Mitra Pengembang',
            'icon'  => 'mdi-city-variant-outline',
            'is_filled' => !empty($this->company_profile_id),
            'val'   => $this->companyProfile->name ?? null,
        ],
        [
            'field' => 'name',
            'label' => 'Nama Proyek Kawasan',
            'icon'  => 'mdi-office-building',
            'is_filled' => !empty($this->name),
            'val'   => $this->name,
        ],
        [
            'field' => 'area',
            'label' => 'Luas Lahan Kawasan',
            'icon'  => 'mdi-texture-box',
            'is_filled' => !empty($this->area) && $this->area > 0,
            'val'   => $this->area ? number_format($this->area, 0, ',', '.') . ' m²' : null,
        ],
        [
            'field' => 'address',
            'label' => 'Alamat / Lokasi Lengkap',
            'icon'  => 'mdi-map-marker-outline',
            'is_filled' => !empty($this->address),
            'val'   => $this->address,
        ],
        [
            'field' => 'denah',
            'label' => 'Berkas Denah / Siteplan',
            'icon'  => 'mdi-floor-plan',
            'is_filled' => !empty($this->denah),
            'val'   => $this->denah ? basename($this->denah) : null,
        ],
        [
            'field' => 'coordinates',
            'label' => 'Koordinat Google Maps',
            'icon'  => 'mdi-crosshairs-gps',
            'is_filled' => !empty($this->lat) && !empty($this->lng),
            'val'   => (!empty($this->lat) && !empty($this->lng)) ? "{$this->lat}, {$this->lng}" : null,
        ],
    ];
}

public function isProfileComplete(): bool
{
    // Cek apakah seluruh data profil penting sudah dilengkapi
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
    if (empty($this->name)) $missing[] = 'Nama Proyek';
    if (empty($this->area)) $missing[] = 'Luas Lahan';
    if (empty($this->denah)) $missing[] = 'Berkas Denah / Siteplan';
    if (empty($this->address)) $missing[] = 'Alamat / Lokasi Lengkap';
    if (empty($this->lat) || empty($this->lng)) $missing[] = 'Koordinat Peta (Lat & Lng)';
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

public function getOverallProgressPercentageAttribute(): int
{
    if ($this->relationLoaded('units') ? $this->units->isNotEmpty() : $this->units()->exists()) {
        $units = $this->relationLoaded('units') ? $this->units : $this->units()->get();
        $avg = $units->avg(function ($u) {
            return $u->construction_progress_percentage;
        });
        return (int) round($avg);
    }
    return (int) ($this->profile_score ?? 35);
}

public function praLandbank()
{
    return $this->hasOne(PraLandbank::class, 'land_bank_id');
}
}

