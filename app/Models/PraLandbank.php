<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PraLandbank extends Model
{
    protected $fillable = [
        'land_name',
        'area',
        'field_area',
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
        'desa_reg_no',
        'desa_reg_date',
        'desa_doc_file',
        'kecamatan_reg_no',
        'kecamatan_reg_date',
        'kecamatan_doc_file',
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
        'polygon_shp_file',
        'sk_hgb_no',
        'sk_hgb_date',
        'sk_hgb_file',
        'pbb_mutasi_nop',
        'pbb_mutasi_date',
        'pbb_mutasi_file',
        'bphtb_nominal',
        'bphtb_payment_date',
        'bphtb_billing_id',
        'bphtb_validasi_file',
        'bphtb_approval_status',
        'shgb_induk_no',
        'shgb_induk_date',
        'shgb_induk_area',
        'shgb_induk_file',
        'land_bank_id',
        'hgb_process_status',
        'custom_workflow_docs',
        'payment_method',
        'installment_duration',
        'installment_count',
        'notes',
        'company_profile_id',
        'custom_costs',
    ];

    protected $casts = [
        'custom_workflow_docs' => 'array',
        'custom_costs'         => 'array',
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

    public function landBank()
    {
        return $this->belongsTo(LandBank::class, 'land_bank_id');
    }

    public function companyProfile()
    {
        return $this->belongsTo(CompanyProfile::class, 'company_profile_id');
    }

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
        }
        return 'SHM';
    }

    public function getApplicableDocumentTypes()
    {
        $category = $this->ownership_category;
        return DocumentTypes::all()->filter(function ($dt) use ($category) {
            $cats = $dt->applicable_categories ?? [];
            return empty($cats) || in_array($category, $cats);
        });
    }

    public function isDokumenFisikLengkap(): bool
    {
        $applicableTypes = $this->getApplicableDocumentTypes();
        if ($applicableTypes->isEmpty()) {
            return false;
        }

        $docs = $this->relationLoaded('documents') ? $this->documents : $this->documents()->get();

        foreach ($applicableTypes as $type) {
            $doc = $docs->firstWhere('document_type_id', $type->id);
            if (!$doc) {
                return false;
            }
            $isAda = ($doc->document_status === 'ada');
            $hasFile = !empty($doc->file_path);
            $isProses = ($doc->document_status === 'proses');

            if ((!$isAda && !$hasFile) || ($isProses && !$hasFile)) {
                return false;
            }
        }

        return true;
    }

    public function isProfilePTLengkap(): bool
    {
        return !empty($this->company_profile_id);
    }

    /**
     * Memindahkan data tanah Pra Land Bank ke Pasca Land Bank (LandBank) secara otomatis
     * ketika dokumen fisik lengkap dan profil PT telah diisi.
     */
    public function syncToPascaLandbank(): ?LandBank
    {
        if (!$this->isDokumenFisikLengkap() || !$this->isProfilePTLengkap()) {
            return null;
        }

        $landBank = null;
        if ($this->land_bank_id) {
            $landBank = LandBank::find($this->land_bank_id);
        }
        if (!$landBank) {
            $landBank = LandBank::where('name', $this->land_name)->first();
        }
        if (!$landBank) {
            $landBank = new LandBank();
        }

        $totalArea = $this->field_area ?: ($this->area ?: 0);
        $dealPrice = $this->deal_price ?: ($this->estimated_price ?: ($this->offer_price ?: 0));

        $workflowDocs = $this->custom_workflow_docs;
        if (empty($workflowDocs)) {
            $workflowDocs = \App\Http\Controllers\Admin\PropertyController::getDefaultFase4Templates($this);
        }

        $landBank->fill([
            'name'                 => $this->land_name,
            'company_profile_id'   => $this->company_profile_id,
            'certificate_no'       => $this->certificate_no ?: ($this->land_name . ' (' . ($this->ownership_status ?? 'SHM') . ')'),
            'ownership_status'     => $this->ownership_status ?: 'SHM',
            'certificate_owner'    => $this->certificate_owner ?: ($this->owner_name ?: ($this->land_owner ?: '-')),
            'custom_workflow_docs' => $workflowDocs,
            'area'                 => $totalArea,
            'remaining_area'       => $landBank->exists ? $landBank->remaining_area : $totalArea,
            'acquisition_price'    => $dealPrice,
            'acquisition_date'     => $landBank->exists ? $landBank->acquisition_date : ($this->survey_date ?: now()->toDateString()),
            'address'              => $this->address ?: '-',
            'village'              => $this->village ?: '-',
            'district'             => $this->district ?: '-',
            'city'                 => $this->city ?: '-',
            'province'             => $this->province ?: '-',
            'zoning'               => $this->zoning ?: '-',
            'road_width'           => (isset($this->road_width) && is_numeric($this->road_width)) ? (int)$this->road_width : null,
            'road_type'            => $this->road_type ?: '-',
            'lat'                  => $this->lat,
            'lng'                  => $this->lng,
            'file_certificate'     => $this->file_certificate,
            'file_pbb'             => $this->pbb_mutasi_file,
            'photo'                => $this->photo,
            'denah'                => $this->peta_bidang_file,
            'status'               => 'aktif', // WAJIB 'aktif' agar muncul di modul Pasca Land Bank
            'legal_status'         => 'aman',
            'development_status'   => $landBank->exists ? $landBank->development_status : 'Belum',
            'description'          => 'Tanah Induk dialihkan otomatis dari Pra Land Bank #' . $this->id . ' (' . $this->land_name . ')',
        ]);
        $landBank->save();

        // Inisialisasi infrastruktur default
        $landBank->initializeDefaultInfrastructures();

        // Salin berkas dokumen ke land_bank_documents
        if ($this->documents()->exists()) {
            foreach ($this->documents as $doc) {
                LandBankDocument::firstOrCreate([
                    'land_bank_id'     => $landBank->id,
                    'document_type_id' => $doc->document_type_id,
                ], [
                    'document_number'  => $doc->document_number,
                    'file_path'        => $doc->file_path,
                    'status'           => 'verified',
                    'revision_number'  => $doc->revision_number ?? 0
                ]);
            }
        }

        // Sinkronisasi status dan ID relasi di Pra Land Bank
        $updates = ['land_bank_id' => $landBank->id];
        if (in_array($this->status, ['fase1', 'fase2', 'fase3', 'pending']) || empty($this->status)) {
            $updates['status'] = 'approved';
        }
        $this->update($updates);

        return $landBank;
    }
}