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
        'owner_status',
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

    /**
     * Kategori normalisasi status kepemilikan tanah di Pasca Land Bank.
     */
    public function getOwnershipCategoryAttribute(): string
    {
        $rawStatus = strtoupper((string)($this->ownership_status ?? 'SHM'));
        if (str_contains($rawStatus, 'APHB')) {
            return 'APHB';
        } elseif (str_contains($rawStatus, 'WARIS')) {
            return 'WARISAN';
        } elseif (str_contains($rawStatus, 'PETOK') || str_contains($rawStatus, 'GIRIK') || str_contains($rawStatus, 'LETTER')) {
            return 'PETOK_C';
        } elseif (str_contains($rawStatus, 'AJB') || str_contains($rawStatus, 'HIBAH')) {
            return 'AJB';
        } elseif (str_contains($rawStatus, 'HGB') || str_contains($rawStatus, 'SHGB')) {
            return 'HGB';
        } elseif (str_contains($rawStatus, 'HGU')) {
            return 'HGU';
        } elseif (str_contains($rawStatus, 'HP')) {
            return 'HP';
        }
        return 'SHM';
    }

    /**
     * Dokumen wajib yang berlaku sesuai status kepemilikan tanah.
     */
    public function getApplicableDocumentTypes()
    {
        $category = $this->ownership_category;
        return DocumentTypes::all()->filter(function ($dt) use ($category) {
            $cats = $dt->applicable_categories ?? [];
            if (empty($cats)) return false;
            if (in_array($category, $cats)) return true;
            // Jika HGB/SHGB/HGU/HP, dokumen dasar kepemilikan berlaku
            if (in_array($category, ['HGB', 'SHGB', 'HGU', 'HP']) && in_array('SHM', $cats) && in_array($dt->code, ['SERTIFIKAT', 'KTP_PENJUAL', 'KARTU_KELUARGA', 'SURAT_NIKAH', 'NPWP', 'SPPT_PBB'])) {
                return true;
            }
            return false;
        });
    }

    /**
     * Jumlah dokumen wajib yang harus dipenuhi sesuai status tanah.
     */
    public function getRequiredDocumentCountAttribute(): int
    {
        $count = $this->getApplicableDocumentTypes()->count();
        return $count > 0 ? $count : 6;
    }

    /**
     * Jumlah dokumen wajib yang telah diunggah berkasnya.
     */
    public function getUploadedDocumentCountAttribute(): int
    {
        $applicableTypeIds = $this->getApplicableDocumentTypes()->pluck('id')->toArray();
        $docs = $this->merged_documents;
        
        return $docs->filter(function ($d) use ($applicableTypeIds) {
            return in_array($d->document_type_id, $applicableTypeIds) && !empty($d->file_path);
        })->count();
    }

    /**
     * Jumlah dokumen wajib yang telah terverifikasi resmi (sah).
     */
    public function getVerifiedDocumentCountAttribute(): int
    {
        if ($this->isFromPraLandbank() || $this->legal_status === 'verified') {
            return $this->required_document_count;
        }

        $applicableTypeIds = $this->getApplicableDocumentTypes()->pluck('id')->toArray();
        $docs = $this->merged_documents;

        return $docs->filter(function ($d) use ($applicableTypeIds) {
            return in_array($d->document_type_id, $applicableTypeIds) && !empty($d->file_path) && $d->status === 'verified';
        })->count();
    }

    /**
     * Mengecek apakah seluruh dokumen fisik wajib sesuai status tanah telah lengkap diunggah.
     */
    public function isDokumenFisikLengkap(): bool
    {
        return $this->uploaded_document_count >= $this->required_document_count;
    }

    /**
     * Persentase kelengkapan unggah dokumen wajib (0 - 100%).
     */
    public function getDocumentCompletenessPercentAttribute(): int
    {
        $required = $this->required_document_count;
        if ($required <= 0) return 100;
        $uploaded = $this->uploaded_document_count;
        return min(100, (int) round(($uploaded / $required) * 100));
    }

    /**
     * Persentase verifikasi legalitas dokumen wajib (0 - 100%).
     */
    public function getLegalVerificationPercentAttribute(): int
    {
        if ($this->isFromPraLandbank() || $this->legal_status === 'verified') {
            return 100;
        }
        $required = $this->required_document_count;
        if ($required <= 0) return 0;
        $verified = $this->verified_document_count;
        return min(100, (int) round(($verified / $required) * 100));
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

    // 1. ATURAN UTAMA: Cek Dokumen Perizinan POIN-18 "Proses Pemecahan SHGB Induk Perkavling (Pasca Land Bank)"
    // Ketika POIN-18 ini selesai / terbit (atau progres 100%), unit kavling sudah dapat dibuat!
    
    // A. Cek POIN-18 dari PerizinanTask
    try {
        $task18 = \App\Models\PerizinanTask::where(function($q) use ($projectIds, $projectNames) {
                $q->whereIn('proyek_id', $projectIds)
                  ->orWhereIn('proyek_nama', $projectNames);
            })
            ->where(function($q) {
                $q->where('master_dokumen_id', 12)
                  ->orWhere('nama_tugas', 'like', '%Pemecahan SHGB Induk%')
                  ->orWhere('nama_tugas', 'like', '%POIN-18%');
            })
            ->first();

        if ($task18) {
            $taskStatus = strtolower(trim($task18->status ?? ''));
            $progress = (int) ($task18->progress ?? 0);
            if (in_array($taskStatus, ['selesai', 'terbit']) || $progress >= 100) {
                return [
                    'status'   => 'terbit',
                    'label'    => 'POIN-18 Selesai (Siap Buat Unit)',
                    'progress' => max(100, $progress),
                    'source'   => 'task_poin18',
                    'task'     => $task18,
                    'proyek_id'=> $pra?->id ?? $this->id,
                ];
            }

            if (in_array($taskStatus, ['dalam proses', 'proses', 'berjalan']) || $progress > 0 || !empty($task18->nomor_dokumen) || !empty($task18->file_dokumen)) {
                return [
                    'status'   => 'proses',
                    'label'    => 'POIN-18 Dalam Proses',
                    'progress' => $progress > 0 ? $progress : 50,
                    'source'   => 'task_poin18',
                    'task'     => $task18,
                    'proyek_id'=> $pra?->id ?? $this->id,
                ];
            }
        }
    } catch (\Throwable $e) {}

    // B. Cek POIN-18 dari custom_workflow_docs (pada LandBank atau PraLandbank)
    $docs = $this->custom_workflow_docs ?? $pra?->custom_workflow_docs ?? [];
    if (is_array($docs)) {
        foreach ($docs as $doc) {
            $isPoin18 = (!empty($doc['master_id']) && (int)$doc['master_id'] === 12)
                || (!empty($doc['kode_dokumen']) && (str_contains(strtoupper($doc['kode_dokumen']), 'POIN-18') || (str_contains(strtoupper($doc['kode_dokumen']), '18') && !str_contains(strtoupper($doc['kode_dokumen']), '17'))))
                || (!empty($doc['id']) && $doc['id'] === 'template_pecah_kavling')
                || (!empty($doc['doc_name']) && (str_contains(strtolower($doc['doc_name']), 'pemecahan shgb') || str_contains(strtolower($doc['doc_name']), 'pemecahan hgb')));

            if ($isPoin18) {
                $stLower = strtolower(trim($doc['status'] ?? ''));
                $prg = (int) ($doc['progress'] ?? 0);

                if (in_array($stLower, ['terbit', 'selesai']) || $prg >= 100) {
                    return [
                        'status'   => 'terbit',
                        'label'    => 'POIN-18 Selesai (Siap Buat Unit)',
                        'progress' => max(100, $prg),
                        'source'   => 'workflow_poin18',
                        'doc'      => $doc,
                        'proyek_id'=> $pra?->id ?? $this->id,
                    ];
                }

                if (in_array($stLower, ['proses', 'berjalan']) || $prg > 0 || !empty($doc['doc_number']) || !empty($doc['file_path'])) {
                    return [
                        'status'   => 'proses',
                        'label'    => 'POIN-18 Dalam Proses',
                        'progress' => $prg > 0 ? $prg : 50,
                        'source'   => 'workflow_poin18',
                        'doc'      => $doc,
                        'proyek_id'=> $pra?->id ?? $this->id,
                    ];
                }
            }
        }
    }

    // C. Cek apakah ada sertifikat pecahan perkavling (POIN-19 selesai)
    try {
        $task19 = \App\Models\PerizinanTask::where(function($q) use ($projectIds, $projectNames) {
                $q->whereIn('proyek_id', $projectIds)
                  ->orWhereIn('proyek_nama', $projectNames);
            })
            ->where(function($q) {
                $q->where('master_dokumen_id', 13)
                  ->orWhere('nama_tugas', 'like', '%POIN-19%')
                  ->orWhere('nama_tugas', 'like', '%Sertipikat Selesai Per Kavling%');
            })
            ->first();

        if ($task19) {
            $taskStatus = strtolower(trim($task19->status ?? ''));
            $progress = (int) ($task19->progress ?? 0);
            if (in_array($taskStatus, ['selesai', 'terbit']) || $progress >= 100) {
                return [
                    'status'   => 'terbit',
                    'label'    => 'POIN-18/19 Selesai (Siap Buat Unit)',
                    'progress' => 100,
                    'source'   => 'task_poin19',
                    'task'     => $task19,
                    'proyek_id'=> $pra?->id ?? $this->id,
                ];
            }
        }
    } catch (\Throwable $e) {}

    return [
        'status'   => 'belum',
        'label'    => 'Menunggu POIN-18 Selesai',
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

    // 2. Syarat Dokumen: Dokumen Perizinan POIN-17 "SHGB Induk Selesai atas nama PT" sudah selesai/terbit (100%),
    // atau POIN-18 "Proses Pemecahan SHGB Induk Perkavling" minimal sudah berstatus proses/terbit.
    $isIzinReady = $this->isIzinPecahKavlingReady();

    return $isLegalVerified && $isIzinReady;
}

public function isFromPraLandbank()
{
    return \App\Models\PraLandbank::dealAndPaidApproved()
        ->where(function($q) {
            $q->where('land_name', $this->name)
              ->orWhere('land_bank_id', $this->id);
        })
        ->exists();
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

    /**
     * Auto-sinkronisasi seluruh berkas dan nomor dokumen dari Pengurusan Perizinan & Pra Land Bank ke Pasca Land Bank.
     */
    public function syncDocumentsFromPerizinanAndPra(): void
    {
        // Cari PraLandbank terkait
        $pra = $this->praLandbank
            ?: \App\Models\PraLandbank::where('land_bank_id', $this->id)->first()
            ?: \App\Models\PraLandbank::where('land_name', $this->name)->first();

        if ($pra && empty($pra->land_bank_id)) {
            $pra->update(['land_bank_id' => $this->id]);
        }

        $proyekId = $pra ? $pra->id : $this->id;

        // 1. Sinkronisasi dokumen dari PraLandbank (pra_landbank_documents)
        if ($pra) {
            $praDocs = \App\Models\pra_landbank_documents::where('pra_landbank_id', $pra->id)->get();
            foreach ($praDocs as $pd) {
                if (empty($pd->file_path)) continue;

                $status = ($pd->status === 'approved' || $pd->status === 'verified') ? 'verified' : ($pd->status === 'rejected' ? 'rejected' : 'pending');

                $existing = \App\Models\LandBankDocument::where('land_bank_id', $this->id)
                    ->where('document_type_id', $pd->document_type_id)
                    ->first();

                if (!$existing) {
                    \App\Models\LandBankDocument::create([
                        'land_bank_id'     => $this->id,
                        'document_type_id' => $pd->document_type_id,
                        'document_number'  => $pd->document_number,
                        'file_path'        => $pd->file_path,
                        'status'           => $status,
                    ]);
                } else {
                    $updates = [];
                    if (empty($existing->file_path) && !empty($pd->file_path)) {
                        $updates['file_path'] = $pd->file_path;
                    }
                    if (empty($existing->document_number) && !empty($pd->document_number)) {
                        $updates['document_number'] = $pd->document_number;
                    }
                    if (!empty($updates)) {
                        $existing->update($updates);
                    }
                }
            }

            // Atribut direct pada Pra (Sertifikat, PBB, Denah / Peta Bidang)
            $landUpdates = [];
            if (empty($this->file_certificate) && !empty($pra->file_certificate)) {
                $landUpdates['file_certificate'] = $pra->file_certificate;
            }
            if (empty($this->certificate_no) && !empty($pra->certificate_no)) {
                $landUpdates['certificate_no'] = $pra->certificate_no;
            }
            if (empty($this->file_pbb) && !empty($pra->pbb_mutasi_file)) {
                $landUpdates['file_pbb'] = $pra->pbb_mutasi_file;
            }
            if (empty($this->pbb_no) && !empty($pra->pbb_mutasi_nop)) {
                $landUpdates['pbb_no'] = $pra->pbb_mutasi_nop;
            }
            if (empty($this->denah) && !empty($pra->peta_bidang_file)) {
                $landUpdates['denah'] = $pra->peta_bidang_file;
            }
            if (!empty($landUpdates)) {
                $this->update($landUpdates);
            }
        }

        // 2. Mapping MasterDokumenPerizinan ID ke DocumentTypes ID
        $masterToDocTypeMap = [
            1  => 26, // Penandatanganan Blangko Permohonan
            2  => 16, // PERTEK
            3  => 17, // Peta Bidang
            4  => 18, // PKKPR
            5  => 19, // Permohonan HGB
            6  => 20, // SK HGB
            7  => 21, // Mutasi PBB
            8  => 22, // Pajak PBB BPHTB
            9  => 23, // Validasi BPHTB
            10 => 24, // Buku HGB Induk
            11 => 25, // SHGB Induk
            12 => 27, // Pemecahan SHGB
            13 => 28, // Sertipikat Kavling
        ];

        // Ambil semua tugas perizinan dengan berkas / nomor dokumen
        $tasks = \App\Models\PerizinanTask::where(function($q) use ($proyekId) {
                $q->where('proyek_id', $proyekId)
                  ->orWhere('proyek_nama', $this->name);
            })
            ->where(function($q) {
                $q->whereNotNull('file_dokumen')
                  ->orWhereNotNull('nomor_dokumen');
            })
            ->get();

        $landUpdates = [];
        foreach ($tasks as $task) {
            $docTypeId = null;
            if (!empty($task->master_dokumen_id) && isset($masterToDocTypeMap[$task->master_dokumen_id])) {
                $docTypeId = $masterToDocTypeMap[$task->master_dokumen_id];
            } else {
                $name = strtolower($task->nama_tugas ?? '');
                if (str_contains($name, 'blangko')) $docTypeId = 26;
                elseif (str_contains($name, 'pertek')) $docTypeId = 16;
                elseif (str_contains($name, 'peta bidang')) $docTypeId = 17;
                elseif (str_contains($name, 'pkkpr')) $docTypeId = 18;
                elseif (str_contains($name, 'permohonan') && str_contains($name, 'hgb')) $docTypeId = 19;
                elseif (str_contains($name, 'sk hgb')) $docTypeId = 20;
                elseif (str_contains($name, 'mutasi pajak') || (str_contains($name, 'mutasi') && str_contains($name, 'pbb'))) $docTypeId = 21;
                elseif (str_contains($name, 'pajak pbb selesai') || str_contains($name, 'bphtb')) $docTypeId = 22;
                elseif (str_contains($name, 'validasi bphtb')) $docTypeId = 23;
                elseif (str_contains($name, 'penerbitan') && str_contains($name, 'hgb')) $docTypeId = 24;
                elseif (str_contains($name, 'shgb induk')) $docTypeId = 25;
                elseif (str_contains($name, 'pemecahan')) $docTypeId = 27;
                elseif (str_contains($name, 'per kavling')) $docTypeId = 28;
            }

            if ($docTypeId && !empty($task->file_dokumen)) {
                $existing = \App\Models\LandBankDocument::where('land_bank_id', $this->id)
                    ->where('document_type_id', $docTypeId)
                    ->first();

                if (!$existing) {
                    \App\Models\LandBankDocument::create([
                        'land_bank_id'     => $this->id,
                        'document_type_id' => $docTypeId,
                        'document_number'  => $task->nomor_dokumen,
                        'file_path'        => $task->file_dokumen,
                        'status'           => 'verified',
                    ]);
                } else {
                    $updates = [];
                    if (empty($existing->file_path) && !empty($task->file_dokumen)) {
                        $updates['file_path'] = $task->file_dokumen;
                    }
                    if (empty($existing->document_number) && !empty($task->nomor_dokumen)) {
                        $updates['document_number'] = $task->nomor_dokumen;
                    }
                    if (!empty($updates)) {
                        $existing->update($updates);
                    }
                }
            }

            // Atribut penting pada profil LandBank
            if ($task->master_dokumen_id == 11 || str_contains(strtolower($task->nama_tugas ?? ''), 'shgb induk')) {
                if (empty($this->shgb_induk_no) && !empty($task->nomor_dokumen)) {
                    $landUpdates['shgb_induk_no'] = $task->nomor_dokumen;
                }
                if (empty($this->shgb_induk_file) && !empty($task->file_dokumen)) {
                    $landUpdates['shgb_induk_file'] = $task->file_dokumen;
                }
                if (empty($this->shgb_induk_date) && !empty($task->tanggal_terbit)) {
                    $landUpdates['shgb_induk_date'] = $task->tanggal_terbit;
                }
            }
            if ($task->master_dokumen_id == 3 || str_contains(strtolower($task->nama_tugas ?? ''), 'peta bidang')) {
                if (empty($this->peta_bidang_no) && !empty($task->nomor_dokumen)) {
                    $landUpdates['peta_bidang_no'] = $task->nomor_dokumen;
                }
                if (empty($this->denah) && !empty($task->file_dokumen)) {
                    $landUpdates['denah'] = $task->file_dokumen;
                }
            }
            if ($task->master_dokumen_id == 2 || str_contains(strtolower($task->nama_tugas ?? ''), 'pertek')) {
                if (empty($this->pertek_no) && !empty($task->nomor_dokumen)) {
                    $landUpdates['pertek_no'] = $task->nomor_dokumen;
                }
            }
            if ($task->master_dokumen_id == 4 || str_contains(strtolower($task->nama_tugas ?? ''), 'pkkpr')) {
                if (empty($this->pkkpr_no) && !empty($task->nomor_dokumen)) {
                    $landUpdates['pkkpr_no'] = $task->nomor_dokumen;
                }
            }
            if ($task->master_dokumen_id == 6 || str_contains(strtolower($task->nama_tugas ?? ''), 'sk hgb')) {
                if (empty($this->sk_hgb_no) && !empty($task->nomor_dokumen)) {
                    $landUpdates['sk_hgb_no'] = $task->nomor_dokumen;
                }
            }
        }

        // Sinkronisasi dari custom_workflow_docs jika ada berkas yang belum tercakup di tasks
        $workflowDocs = $pra ? ($pra->custom_workflow_docs ?: $this->custom_workflow_docs) : $this->custom_workflow_docs;
        if (!empty($workflowDocs) && is_array($workflowDocs)) {
            foreach ($workflowDocs as $wd) {
                if (empty($wd['file_path'])) continue;
                $mId = $wd['master_id'] ?? null;
                $docTypeId = ($mId && isset($masterToDocTypeMap[$mId])) ? $masterToDocTypeMap[$mId] : null;
                if ($docTypeId) {
                    $existing = \App\Models\LandBankDocument::where('land_bank_id', $this->id)
                        ->where('document_type_id', $docTypeId)
                        ->first();
                    if (!$existing) {
                        \App\Models\LandBankDocument::create([
                            'land_bank_id'     => $this->id,
                            'document_type_id' => $docTypeId,
                            'document_number'  => $wd['doc_number'] ?? null,
                            'file_path'        => $wd['file_path'],
                            'status'           => 'verified',
                        ]);
                    } elseif (empty($existing->file_path)) {
                        $existing->update(['file_path' => $wd['file_path']]);
                    }
                }
            }
        }

        if (!empty($landUpdates)) {
            $this->update($landUpdates);
        }

        // 3. Fallback Dokumen Inti (Type 1: SERTIFIKAT, Type 6: SPPT_PBB) jika ada file di atribut lahan
        $doc1 = \App\Models\LandBankDocument::where('land_bank_id', $this->id)->where('document_type_id', 1)->first();
        if (!$doc1 && (!empty($this->file_certificate) || !empty($this->certificate_no))) {
            \App\Models\LandBankDocument::create([
                'land_bank_id'     => $this->id,
                'document_type_id' => 1,
                'document_number'  => $this->certificate_no,
                'file_path'        => $this->file_certificate ?: '-',
                'status'           => 'verified',
            ]);
        }

        $doc6 = \App\Models\LandBankDocument::where('land_bank_id', $this->id)->where('document_type_id', 6)->first();
        if (!$doc6 && (!empty($this->file_pbb) || !empty($this->pbb_no))) {
            \App\Models\LandBankDocument::create([
                'land_bank_id'     => $this->id,
                'document_type_id' => 6,
                'document_number'  => $this->pbb_no,
                'file_path'        => $this->file_pbb ?: '-',
                'status'           => 'verified',
            ]);
        }
    }
}

