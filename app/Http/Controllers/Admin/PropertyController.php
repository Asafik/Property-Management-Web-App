<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LandBank;
use App\Models\CompanyProfile;
use App\Models\LandBankUnit;
use App\Models\DocumentTypes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PropertyController extends Controller
{
    //
   public function index(Request $request)
{
    $query = LandBank::with('companyProfile');

    // Filter Search Nama
    if ($request->search) {
        $query->where('name', 'like', '%' . $request->search . '%');
    }

    // Filter Company
    if ($request->company_profile_id) {
        $query->where('company_profile_id', $request->company_profile_id);
    }

    // Filter Kategori
    if ($request->kategori) {
        $query->where('zoning', $request->kategori);
    }

    // Filter Legalitas
    if ($request->legalitas) {
        $query->where('legal_status', $request->legalitas);
    }

    // Filter Pembangunan
    if ($request->pembangunan) {
        $query->where('development_status', $request->pembangunan);
    }

    // Sort - only by name
    $sortBy = $request->sort_by;
    $sortOrder = $request->sort_order ?? 'asc';

    if ($sortBy === 'name') {
        $query->orderBy('name', $sortOrder);
    } else {
        // Default sorting by latest (or you can set default to name)
        $query->latest();
    }

    // Show per page
    $show = $request->show ?? 10;

    $landBanks = $query->paginate($show);

    $companies = CompanyProfile::orderBy('name')->get();
    $categories = \App\Models\LandBank::select('zoning')
        ->whereNotNull('zoning')
        ->distinct()
        ->orderBy('zoning')
        ->pluck('zoning');

    return view('properti.index', compact('landBanks', 'companies', 'categories'));
}


public function kavlingindex(Request $request)
{
    $query = LandBank::where(function($q) {
        $q->where('legal_status', 'verified')
          ->orWhereIn('name', \App\Models\PraLandbank::pluck('land_name'));
    });

    // Filter Search Nama
    if ($request->filled('search')) {
        $query->where('name', 'like', '%' . $request->search . '%');
    }

    // Filter Type (zoning)
    if ($request->filled('type')) {
        $query->where('zoning', $request->type);
    }

    // Filter Status
    if ($request->filled('status')) {
        if ($request->status == 'sold') {
            $query->where('status', 'sold');
        } elseif ($request->status == 'booking') {
            $query->where('status', 'booking');
        } elseif ($request->status == 'available') {
            $query->whereNotIn('status', ['sold', 'booking'])
                  ->where(function($sub) {
                      $sub->where('development_status', 'Selesai')
                          ->orWhere('overall_infrastructure_progress', '>=', 100);
                  });
        } elseif ($request->status == 'processing') {
            $query->whereNotIn('status', ['sold', 'booking'])
                  ->where(function($sub) {
                      $sub->where(function($sq) {
                          $sq->whereNull('development_status')
                             ->orWhere('development_status', '!=', 'Selesai');
                      })
                      ->where(function($sq) {
                          $sq->whereNull('overall_infrastructure_progress')
                             ->orWhere('overall_infrastructure_progress', '<', 100);
                      });
                  });
        }
    }

    // Sort
    $allowedSorts = ['name', 'zoning', 'acquisition_price', 'area', 'status', 'created_at'];
    $sort = $request->input('sort', 'created_at');
    $direction = $request->input('direction', 'desc');

    if (!in_array($sort, $allowedSorts)) {
        $sort = 'created_at';
    }

    if (!in_array($direction, ['asc', 'desc'])) {
        $direction = 'desc';
    }

    $query->orderBy($sort, $direction);

    // Show per page - UPDATED to 10, 15, 20
    $perPage = (int) $request->input('per_page', 10);
    if (!in_array($perPage, [10, 15, 20])) {
        $perPage = 10;
    }

    $lands = $query->paginate($perPage)->withQueryString();

    // Untuk dropdown filter
    $types = LandBank::where(function($q) {
            $q->where('legal_status', 'verified')
              ->orWhereIn('name', \App\Models\PraLandbank::pluck('land_name'));
        })
        ->whereNotNull('zoning')
        ->distinct()
        ->orderBy('zoning')
        ->pluck('zoning');

    return view('properti.kavling', compact('lands', 'types'));
}

public function updateCompanyAjax(Request $request, $id)
{
    try {
        $request->validate([
            'company_profile_id' => 'required|exists:company_profiles,id',
        ]);

        $land = LandBank::findOrFail($id);
        $land->update([
            'company_profile_id' => $request->company_profile_id
        ]);

        return response()->json([
            'success' => true,
            'message' => 'PT Mitra berhasil diperbarui!'
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => $e->getMessage()
        ], 500);
    }
}

public function edit($id)
{
    $land = LandBank::with('documents')->findOrFail($id);
    $companies = CompanyProfile::withCount('landBanks')->get();
    $documentTypes = DocumentTypes::orderBy('name')->get();

    // Load workflow perizinan & pengindukan
    $workflowDocs = $land->custom_workflow_docs;
    if (empty($workflowDocs) || !is_array($workflowDocs)) {
        // Ambil dari data PraLandbank jika ada relasi
        $pra = \App\Models\PraLandbank::where('land_bank_id', $land->id)
            ->orWhere('land_name', $land->name)
            ->first();
        if ($pra && !empty($pra->custom_workflow_docs)) {
            $workflowDocs = $pra->custom_workflow_docs;
            // Salin ke land_bank agar tersimpan permanen di Pasca
            $land->update(['custom_workflow_docs' => $workflowDocs]);
        } else {
            $workflowDocs = self::getDefaultFase4Templates($land);
        }
    }

    $masterDocuments = \App\Models\MasterDokumenPerizinan::where('is_active', true)
        ->orderBy('urutan', 'asc')
        ->orderBy('nama_dokumen', 'asc')
        ->get();

    return view('properti.edit', compact('land', 'companies', 'documentTypes', 'workflowDocs', 'masterDocuments'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'namaTanah' => 'required|string|max:200',
        'company_profile_id' => 'nullable|exists:company_profiles,id',
        'statusKepemilikan' => 'nullable|string',
        'lokasi' => 'required|string',
        'luasTanah' => 'required|numeric',
        'hargaPerolehan' => 'required',
        'tanggalPerolehan' => 'nullable|date',
        'statusLegal' => 'nullable|string',
        'statusKavling' => 'nullable|string',
        'fee_document_verification' => 'nullable|string',
        'latitude'                  => 'nullable|string',
        'longitude'                 => 'nullable|string',
        'denah'                     => 'nullable|file|mimes:pdf,jpg,jpeg,png,webp,svg|max:5120',
        'documents.*.file'   => 'nullable|file|mimes:pdf,jpg,jpeg,png,webp|max:2048',
        'documents.*.number' => 'nullable|string|max:255',
    ]);

    DB::beginTransaction();
    try {
        $harga = preg_replace('/[^0-9]/', '', $request->hargaPerolehan);
        $fee_verification = $request->fee_document_verification ? preg_replace('/[^0-9]/', '', $request->fee_document_verification) : null;
        $land = LandBank::findOrFail($id);
        
        $land->update([
            'name' => $request->namaTanah,
            'company_profile_id' => $request->company_profile_id ?? 1,
            'ownership_status' => $request->statusKepemilikan ?? 'SHM',
            'address' => $request->lokasi,
            'village' => $request->kelurahan,
            'district' => $request->kecamatan,
            'city' => $request->kota,
            'province' => $request->provinsi,
            'postal_code' => $request->kodePos,
            'area' => $request->luasTanah,
            'remaining_area' => $request->luasTanah,
            'acquisition_price' => $harga,
            'acquisition_date' => $request->tanggalPerolehan ?? now()->format('Y-m-d'),
            'zoning' => $request->zonasi,
            'road_width' => $request->lebarJalan,
            'road_type' => $request->jenisJalan,
            'facility_school' => $request->has('fasSekolah'),
            'facility_hospital' => $request->has('fasRumahSakit'),
            'facility_mall' => $request->has('fasMall'),
            'facility_transport' => $request->has('fasTransportasi'),
            'description' => $request->deskripsi,
            'legal_status' => $request->statusLegal ?? 'pending',
            'development_status' => $request->statusKavling ?? 'Belum',
            'priority' => $request->prioritas,
            'lat' => $request->latitude,
            'lng' => $request->longitude,
            'fee_document_verification' => $fee_verification,
        ]);

        // HANDLE DENAH / SITEPLAN UPLOAD
        if ($request->hasFile('denah')) {
            $denahFile = $request->file('denah');
            $denahFilename = 'denah_' . uniqid() . '.' . $denahFile->getClientOriginalExtension();
            $destination = public_path('uploads/landbank/' . $land->id . '/denah');
            if (!file_exists($destination)) {
                mkdir($destination, 0755, true);
            }
            $denahFile->move($destination, $denahFilename);
            $land->update([
                'denah' => 'landbank/' . $land->id . '/denah/' . $denahFilename
            ]);
        }

        // HANDLE DOCUMENTS (Hanya untuk dokumen yang belum terverifikasi)
        if ($request->has('documents')) {
            $isLandVerified = $land->isFromPraLandbank() || $land->legal_status === 'verified';

            foreach ($request->documents as $typeId => $doc) {
                if (empty($doc['number']) && empty($doc['file'])) {
                    continue;
                }

                $existingDoc = \App\Models\LandBankDocument::where('land_bank_id', $land->id)
                    ->where('document_type_id', $typeId)
                    ->first();

                // Dokumen hanya dikunci jika SUDAH memiliki file DAN statusnya verified/berasal dari pra landbank
                $isDocVerified = $existingDoc && !empty($existingDoc->file_path) && (($existingDoc->status === 'verified') || $isLandVerified);

                // Jika dokumen sudah verified dan sudah punya file, kunci agar tidak bisa ditimpa
                if ($isDocVerified) {
                    continue;
                }

                $filePath = $existingDoc ? $existingDoc->file_path : null;

                if (!empty($doc['file'])) {
                    $file = $doc['file'];
                    $filename = uniqid() . '.' . $file->getClientOriginalExtension();
                    $destination = public_path('uploads/landbank/' . $land->id . '/' . $typeId);

                    if (!file_exists($destination)) {
                        mkdir($destination, 0755, true);
                    }

                    $file->move($destination, $filename);
                    $filePath = 'landbank/' . $land->id . '/' . $typeId . '/' . $filename;
                }

                if ($existingDoc) {
                    $updateData = [
                        'file_path' => $filePath,
                    ];
                    if (isset($doc['number'])) {
                        $updateData['document_number'] = $doc['number'];
                    }
                    $existingDoc->update($updateData);
                } else {
                    \App\Models\LandBankDocument::create([
                        'land_bank_id'     => $land->id,
                        'document_type_id' => $typeId,
                        'document_number'  => $doc['number'] ?? null,
                        'file_path'        => $filePath,
                        'status'           => 'pending',
                    ]);
                }
            }
        }

        DB::commit();
        return redirect()->route('properti-all')->with('success', 'Data Properti berhasil diperbarui!');
    } catch (\Exception $e) {
        DB::rollBack();
        return redirect()->back()->with('error', 'Gagal memperbarui properti: ' . $e->getMessage())->withInput();
    }
}

    /**
     * Upload / Simpan Dokumen Dinamis Workflow Pasca Land Bank via AJAX
     */
    public function uploadCustomWorkflowDoc(Request $request, $id)
    {
        $request->validate([
            'doc_name'   => 'required|string|max:255',
            'doc_number' => 'nullable|string|max:255',
            'doc_date'   => 'nullable|date',
            'instansi'   => 'nullable|string|max:255',
            'poin_label' => 'nullable|string|max:100',
            'status'     => 'nullable|string|max:50',
            'luas'       => 'nullable|string|max:50',
            'nominal'    => 'nullable|string|max:50',
            'notes'      => 'nullable|string|max:500',
            'file'       => 'nullable|file|max:25600',
            'file_doc'   => 'nullable|file|max:25600',
        ]);

        $land = LandBank::findOrFail($id);
        $docId = $request->input('doc_id') ?: ('doc_' . uniqid());
        $currentDocs = $land->custom_workflow_docs;
        if (!is_array($currentDocs)) {
            $currentDocs = [];
        }

        $filePath = null;
        $uploadedFile = $request->file('file') ?: $request->file('file_doc');
        if ($uploadedFile) {
            $file = $uploadedFile;
            $filename = uniqid() . '_pengindukan_' . $file->getClientOriginalName();
            $destination = public_path('uploads/landbank/' . $land->id . '/pengindukan');

            if (!file_exists($destination)) {
                mkdir($destination, 0755, true);
            }
            $file->move($destination, $filename);
            $filePath = 'uploads/landbank/' . $land->id . '/pengindukan/' . $filename;
        }

        // Cari apakah update item yang sudah ada atau tambah baru
        $existingIndex = -1;
        foreach ($currentDocs as $index => $item) {
            if (($item['id'] ?? '') === $docId) {
                $existingIndex = $index;
                break;
            }
        }

        $status = $request->input('status', 'belum');
        if ($filePath && $status === 'belum') {
            $status = 'terbit';
        }

        $cleanNominal = $request->filled('nominal') ? (float)preg_replace('/[^0-9.]/', '', $request->nominal) : null;
        $cleanLuas = $request->filled('luas') ? (float)preg_replace('/[^0-9.]/', '', $request->luas) : null;

        // Prasyarat Dokumen & Checklist
        $syaratDokumen = $request->input('syarat_dokumen', '');
        $syaratChecklist = $request->input('syarat_checklist', []);
        if (is_string($syaratChecklist)) {
            $syaratChecklist = json_decode($syaratChecklist, true) ?: [];
        }
        if (!is_array($syaratChecklist)) {
            $syaratChecklist = [];
        }

        // Parse syarat_items dari syarat_dokumen
        $syaratItems = [];
        if (!empty($syaratDokumen)) {
            $lines = preg_split('/[\r\n]+/', $syaratDokumen);
            foreach ($lines as $line) {
                $cleanLine = trim(preg_replace('/^[•\-\*\d+\.]\s*/u', '', trim($line)));
                if (!empty($cleanLine)) {
                    $syaratItems[] = $cleanLine;
                }
            }
        }
        if (empty($syaratItems) && $existingIndex >= 0 && !empty($currentDocs[$existingIndex]['syarat_items'])) {
            $syaratItems = $currentDocs[$existingIndex]['syarat_items'];
        }

        // Existing syarat_files map
        $existingSyaratFiles = [];
        if ($existingIndex >= 0 && !empty($currentDocs[$existingIndex]['syarat_files'])) {
            $existingSyaratFiles = (array)$currentDocs[$existingIndex]['syarat_files'];
        }
        if ($request->has('existing_syarat_files')) {
            $passedExisting = $request->input('existing_syarat_files');
            if (is_string($passedExisting)) {
                $passedExisting = json_decode($passedExisting, true) ?: [];
            }
            if (is_array($passedExisting)) {
                $existingSyaratFiles = array_merge($existingSyaratFiles, $passedExisting);
            }
        }

        // Handle deleted syarat files
        if ($request->has('deleted_syarat_files')) {
            $deleted = $request->input('deleted_syarat_files');
            if (is_string($deleted)) {
                $deleted = json_decode($deleted, true) ?: [];
            }
            if (is_array($deleted)) {
                foreach ($deleted as $delKey) {
                    unset($existingSyaratFiles[$delKey]);
                }
            }
        }

        // Handle newly uploaded files per syarat item
        $syaratFiles = $existingSyaratFiles;
        $destinationSyarat = public_path('uploads/landbank/' . $land->id . '/prasyarat');
        if (!file_exists($destinationSyarat)) {
            mkdir($destinationSyarat, 0755, true);
        }

        if ($request->hasFile('syarat_files')) {
            $uploadedSyaratFiles = $request->file('syarat_files');
            if (is_array($uploadedSyaratFiles)) {
                foreach ($uploadedSyaratFiles as $key => $sFile) {
                    if ($sFile && $sFile->isValid()) {
                        $sFilename = uniqid() . '_syarat_' . preg_replace('/[^a-zA-Z0-9_\.-]/', '_', $sFile->getClientOriginalName());
                        $sFile->move($destinationSyarat, $sFilename);
                        $savedPath = 'uploads/landbank/' . $land->id . '/prasyarat/' . $sFilename;

                        $itemName = isset($syaratItems[$key]) ? $syaratItems[$key] : (string)$key;
                        $syaratFiles[$itemName] = $savedPath;

                        if (!in_array($itemName, $syaratChecklist)) {
                            $syaratChecklist[] = $itemName;
                        }
                    }
                }
            }
        }

        // Also check for individual syarat_file_{$key} inputs
        foreach ($request->allFiles() as $fileKey => $sFile) {
            if (str_starts_with($fileKey, 'syarat_file_') && $sFile && $sFile->isValid()) {
                $rawIdx = str_replace('syarat_file_', '', $fileKey);
                $idxParts = explode('_', $rawIdx);
                $idx = end($idxParts);
                $sFilename = uniqid() . '_syarat_' . preg_replace('/[^a-zA-Z0-9_\.-]/', '_', $sFile->getClientOriginalName());
                $sFile->move($destinationSyarat, $sFilename);
                $savedPath = 'uploads/landbank/' . $land->id . '/prasyarat/' . $sFilename;

                $itemName = isset($syaratItems[$idx]) ? $syaratItems[$idx] : (isset($syaratItems[$rawIdx]) ? $syaratItems[$rawIdx] : (string)$rawIdx);
                $syaratFiles[$itemName] = $savedPath;

                if (!in_array($itemName, $syaratChecklist)) {
                    $syaratChecklist[] = $itemName;
                }
            }
        }

        $docPayload = [
            'id'               => $docId,
            'poin_label'       => $request->input('poin_label', 'Dokumen'),
            'doc_name'         => $request->doc_name,
            'instansi'         => $request->input('instansi', '-'),
            'doc_number'       => $request->doc_number,
            'doc_date'         => $request->doc_date,
            'status'           => $status,
            'nominal'          => $cleanNominal,
            'luas'             => $cleanLuas,
            'notes'            => $request->notes,
            'syarat_dokumen'   => $syaratDokumen ?: ($existingIndex >= 0 ? ($currentDocs[$existingIndex]['syarat_dokumen'] ?? '') : ''),
            'syarat_items'     => $syaratItems,
            'syarat_checklist' => $syaratChecklist,
            'syarat_files'     => $syaratFiles,
            'file_path'        => $filePath ?: ($existingIndex >= 0 ? ($currentDocs[$existingIndex]['file_path'] ?? null) : null),
            'is_template'      => $existingIndex >= 0 ? ($currentDocs[$existingIndex]['is_template'] ?? false) : false,
            'is_final_goal'    => $docId === 'template_shgb_induk' || ($existingIndex >= 0 && !empty($currentDocs[$existingIndex]['is_final_goal'])),
            'updated_at'       => now()->toDateTimeString(),
        ];

        if ($existingIndex >= 0) {
            $currentDocs[$existingIndex] = $docPayload;
        } else {
            $docPayload['created_at'] = now()->toDateTimeString();
            $currentDocs[] = $docPayload;
        }

        // Sinkronisasi data ke kolom tabel model LandBank untuk kompatibilitas
        $syncUpdates = ['custom_workflow_docs' => $currentDocs];

        if ($docId === 'template_desa_kecamatan' || $docId === 'template_desa') {
            $syncUpdates['desa_reg_no'] = $request->doc_number;
            $syncUpdates['desa_reg_date'] = $request->doc_date;
            if ($filePath) $syncUpdates['desa_doc_file'] = $filePath;
        } elseif ($docId === 'template_pertek') {
            $syncUpdates['pertek_no'] = $request->doc_number;
            $syncUpdates['pertek_date'] = $request->doc_date;
            if ($filePath) $syncUpdates['pertek_file'] = $filePath;
        } elseif ($docId === 'template_peta_bidang') {
            $syncUpdates['peta_bidang_no'] = $request->doc_number;
            $syncUpdates['peta_bidang_date'] = $request->doc_date;
            if ($cleanLuas) $syncUpdates['peta_bidang_area'] = $cleanLuas;
            if ($filePath) $syncUpdates['peta_bidang_file'] = $filePath;
        } elseif ($docId === 'template_pkkpr') {
            $syncUpdates['pkkpr_no'] = $request->doc_number;
            $syncUpdates['pkkpr_date'] = $request->doc_date;
            $syncUpdates['pkkpr_status'] = $status === 'terbit' ? 'terbit' : ($status === 'ditolak' ? 'ditolak' : 'proses');
            if ($filePath) $syncUpdates['pkkpr_file'] = $filePath;
        } elseif ($docId === 'template_sk_hgb') {
            $syncUpdates['sk_hgb_no'] = $request->doc_number;
            $syncUpdates['sk_hgb_date'] = $request->doc_date;
            if ($filePath) $syncUpdates['sk_hgb_file'] = $filePath;
        } elseif ($docId === 'template_shgb_induk') {
            $syncUpdates['shgb_induk_no'] = $request->doc_number;
            $syncUpdates['shgb_induk_date'] = $request->doc_date;
            if ($cleanLuas) $syncUpdates['shgb_induk_area'] = $cleanLuas;
            if ($filePath) {
                $syncUpdates['shgb_induk_file'] = $filePath;
                $syncUpdates['file_certificate'] = $filePath;
            }
        }

        $land->update($syncUpdates);

        // Jika ada relasi pra_landbank, sinkronkan juga
        $pra = \App\Models\PraLandbank::where('land_bank_id', $land->id)->first();
        if ($pra) {
            $pra->update($syncUpdates);
        }

        return response()->json([
            'success' => true,
            'message' => 'Dokumen ' . $request->doc_name . ' berhasil diperbarui!',
            'doc'     => $docPayload
        ]);
    }

    /**
     * Hapus Dokumen Dinamis Workflow Pasca Land Bank via AJAX
     */
    public function deleteCustomWorkflowDoc(Request $request, $id)
    {
        $request->validate([
            'doc_id' => 'required|string',
        ]);

        $land = LandBank::findOrFail($id);
        $docId = $request->input('doc_id');
        $currentDocs = $land->custom_workflow_docs;
        if (!is_array($currentDocs)) {
            $currentDocs = [];
        }

        $filtered = array_values(array_filter($currentDocs, function($d) use ($docId) {
            return ($d['id'] ?? '') !== $docId;
        }));

        $land->update([
            'custom_workflow_docs' => $filtered
        ]);

        $pra = \App\Models\PraLandbank::where('land_bank_id', $land->id)->first();
        if ($pra) {
            $pra->update(['custom_workflow_docs' => $filtered]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Dokumen berhasil dihapus dari alur perizinan.',
            'docs'    => $filtered
        ]);
    }

    /**
     * Memuat Template Standar Perizinan (Poin 7 s/d 19) ke Dokumen Pasca Land Bank
     */
    public function loadFase4DefaultTemplate(Request $request, $id)
    {
        $land = LandBank::findOrFail($id);
        $templates = self::getDefaultFase4Templates($land);

        $currentDocs = $land->custom_workflow_docs;
        if (empty($currentDocs) || !is_array($currentDocs)) {
            $currentDocs = $templates;
        } else {
            $existingIds = array_column($currentDocs, 'id');
            foreach ($templates as $t) {
                if (!in_array($t['id'], $existingIds)) {
                    $currentDocs[] = $t;
                }
            }
        }

        $land->update([
            'custom_workflow_docs' => $currentDocs
        ]);

        $pra = \App\Models\PraLandbank::where('land_bank_id', $land->id)->first();
        if ($pra) {
            $pra->update(['custom_workflow_docs' => $currentDocs]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Template standar legalitas perizinan berhasil dimuat!',
            'docs'    => $currentDocs
        ]);
    }

    /**
     * Tambahkan batch dokumen dari Master Dokumen Perizinan
     */
    public function addBatchFromMaster(Request $request, $id)
    {
        $request->validate([
            'master_ids' => 'required|array',
            'master_ids.*' => 'integer|exists:master_dokumen_perizinans,id',
        ]);

        $land = LandBank::findOrFail($id);
        $masterItems = \App\Models\MasterDokumenPerizinan::whereIn('id', $request->master_ids)->get();

        $currentDocs = $land->custom_workflow_docs;
        if (!is_array($currentDocs)) {
            $currentDocs = [];
        }

        $existingNames = array_map(function($d) {
            return strtolower(trim($d['doc_name'] ?? ''));
        }, $currentDocs);

        $addedCount = 0;
        foreach ($masterItems as $m) {
            if (in_array(strtolower(trim($m->nama_dokumen)), $existingNames)) {
                continue;
            }

            $syaratItems = [];
            if (!empty($m->syarat_dokumen)) {
                $lines = preg_split('/[\r\n]+/', $m->syarat_dokumen);
                foreach ($lines as $line) {
                    $clean = trim(preg_replace('/^[•\-\*\d+\.]\s*/u', '', trim($line)));
                    if (!empty($clean)) {
                        $syaratItems[] = $clean;
                    }
                }
            }

            $currentDocs[] = [
                'id'               => 'master_' . $m->id . '_' . uniqid(),
                'poin_label'       => $m->kode_dokumen ?: 'Perizinan',
                'doc_name'         => $m->nama_dokumen,
                'instansi'         => $m->instansi_terkait ?: '-',
                'doc_number'       => '',
                'doc_date'         => '',
                'status'           => 'belum',
                'nominal'          => $m->estimasi_biaya ?: null,
                'luas'             => null,
                'notes'            => $m->deskripsi ?: '',
                'syarat_dokumen'   => $m->syarat_dokumen ?: '',
                'syarat_items'     => $syaratItems,
                'syarat_checklist' => [],
                'syarat_files'     => [],
                'file_path'        => null,
                'is_template'      => false,
                'is_final_goal'    => str_contains(strtolower($m->nama_dokumen), 'shgb induk'),
                'created_at'       => now()->toDateTimeString(),
            ];
            $addedCount++;
        }

        $land->update([
            'custom_workflow_docs' => $currentDocs
        ]);

        $pra = \App\Models\PraLandbank::where('land_bank_id', $land->id)->first();
        if ($pra) {
            $pra->update(['custom_workflow_docs' => $currentDocs]);
        }

        return response()->json([
            'success' => true,
            'message' => "Berhasil menambahkan {$addedCount} dokumen perizinan dari Master Data!",
            'docs'    => $currentDocs
        ]);
    }

    /**
     * Template Standar Legalitas & Perizinan Pasca Land Bank (Poin 7–19)
     */
    public static function getDefaultFase4Templates($land = null)
    {
        return [
            // Poin 7: Kelurahan & Kecamatan
            [
                'id'              => 'template_desa_kecamatan',
                'poin_label'      => 'Poin 7',
                'doc_name'        => 'Penandatanganan Blangko Permohonan Kelurahan & Kecamatan Setempat',
                'instansi'        => 'Pihak Kelurahan dan Kantor Kecamatan Setempat',
                'doc_number'      => $land->desa_reg_no ?? '',
                'doc_date'        => $land && $land->desa_reg_date ? \Carbon\Carbon::parse($land->desa_reg_date)->format('Y-m-d') : '',
                'status'          => ($land && $land->desa_doc_file) ? 'terbit' : (($land && $land->desa_reg_no) ? 'proses' : 'belum'),
                'file_path'       => $land->desa_doc_file ?? null,
                'syarat_dokumen'  => "• Upload Salinan Akta Pelepasan Hak dari Notaris\n• Copy Salinan akta pelepasan\n• Berkas kepemilikan tanah yang sudah lengkap\n• Legalitas PT",
                'syarat_items'    => [
                    'Upload Salinan Akta Pelepasan Hak dari Notaris',
                    'Copy Salinan akta pelepasan',
                    'Berkas kepemilikan tanah yang sudah lengkap',
                    'Legalitas PT'
                ],
                'syarat_checklist'=> [],
                'syarat_files'    => [],
                'notes'           => 'Registrasi blangko permohonan pengalihan/pengindukan an. PT di pihak kelurahan dan kecamatan setempat.',
                'is_template'     => true,
            ],

            // Poin 8: PERTEK BPN
            [
                'id'              => 'template_pertek',
                'poin_label'      => 'Poin 8',
                'doc_name'        => 'Proses Pertimbangan Teknis Pertanahan (PERTEK)',
                'instansi'        => 'Kantor Pertanahan (ATR/BPN)',
                'doc_number'      => $land->pertek_no ?? '',
                'doc_date'        => $land && $land->pertek_date ? \Carbon\Carbon::parse($land->pertek_date)->format('Y-m-d') : '',
                'status'          => ($land && $land->pertek_file) ? 'terbit' : (($land && $land->pertek_no) ? 'proses' : 'belum'),
                'file_path'       => $land->pertek_file ?? null,
                'nominal'         => 2500000,
                'syarat_dokumen'  => "• Copy Salinan akta pelepasan\n• Berkas kepemilikan tanah yang sudah lengkap\n• Legalitas PT",
                'syarat_items'    => [
                    'Copy Salinan akta pelepasan',
                    'Berkas kepemilikan tanah yang sudah lengkap',
                    'Legalitas PT'
                ],
                'syarat_checklist'=> [],
                'syarat_files'    => [],
                'notes'           => 'Kajian teknis kesesuaian ruang dan kemampuan tanah oleh tim Kantor Pertanahan ATR/BPN.',
                'is_template'     => true,
            ],

            // Poin 9: Peta Bidang & Pengukuran
            [
                'id'              => 'template_peta_bidang',
                'poin_label'      => 'Poin 9',
                'doc_name'        => 'Proses Peta Bidang dan Pengukuran Tanah (NIB)',
                'instansi'        => 'Seksi Survei & Pemetaan ATR/BPN',
                'doc_number'      => $land->peta_bidang_no ?? '',
                'doc_date'        => $land && $land->peta_bidang_date ? \Carbon\Carbon::parse($land->peta_bidang_date)->format('Y-m-d') : '',
                'luas'            => $land->peta_bidang_area ?? ($land->area ?? ''),
                'status'          => ($land && $land->peta_bidang_file) ? 'terbit' : (($land && $land->peta_bidang_no) ? 'proses' : 'belum'),
                'file_path'       => $land->peta_bidang_file ?? null,
                'nominal'         => 3500000,
                'syarat_dokumen'  => "• Copy Salinan akta pelepasan\n• Berkas kepemilikan tanah yang sudah lengkap\n• Legalitas PT",
                'syarat_items'    => [
                    'Copy Salinan akta pelepasan',
                    'Berkas kepemilikan tanah yang sudah lengkap',
                    'Legalitas PT'
                ],
                'syarat_checklist'=> [],
                'syarat_files'    => [],
                'notes'           => 'Pengukuran batas keliling fisik bidang tanah & penerbitan Peta Bidang NIB oleh BPN.',
                'is_template'     => true,
            ],

            // Poin 10: PKKPR Dinas PTSP & PU
            [
                'id'              => 'template_pkkpr',
                'poin_label'      => 'Poin 10',
                'doc_name'        => 'Proses PKKPR (Dinas PTSP dan Dinas PU Tata Ruang)',
                'instansi'        => 'Dinas PTSP & Dinas PU Tata Ruang / OSS RBA',
                'doc_number'      => $land->pkkpr_no ?? '',
                'doc_date'        => $land && $land->pkkpr_date ? \Carbon\Carbon::parse($land->pkkpr_date)->format('Y-m-d') : '',
                'status'          => ($land && $land->pkkpr_status === 'terbit') ? 'terbit' : (($land && $land->pkkpr_status === 'ditolak') ? 'ditolak' : (($land && $land->pkkpr_no) ? 'proses' : 'belum')),
                'file_path'       => $land->pkkpr_file ?? null,
                'syarat_dokumen'  => "• Input pada system OSS RBA\n• Legalitas PT\n• Sket gambar tanah\n• Polygon / SHP\n• Pertek BPN\n• Peta Bidang BPN",
                'syarat_items'    => [
                    'Input pada system OSS RBA',
                    'Legalitas PT',
                    'Sket gambar tanah',
                    'Polygon / SHP',
                    'Pertek BPN',
                    'Peta Bidang BPN'
                ],
                'syarat_checklist'=> [],
                'syarat_files'    => [],
                'notes'           => 'Persetujuan Kesesuaian Kegiatan Pemanfaatan Ruang (PKKPR) pada sistem OSS RBA.',
                'is_template'     => true,
            ],

            // Poin 11: Permohonan HGB Badan Hukum
            [
                'id'              => 'template_permohonan_hgb',
                'poin_label'      => 'Poin 11',
                'doc_name'        => 'Permohonan HGB Badan Hukum (Pengindukan Sertipikat)',
                'instansi'        => 'Kantor Pertanahan ATR/BPN',
                'doc_number'      => '',
                'doc_date'        => '',
                'status'          => 'belum',
                'file_path'       => null,
                'nominal'         => 5000000,
                'syarat_dokumen'  => "• Legalitas PT\n• PKKPR\n• PERTEK\n• PETA BIDANG",
                'syarat_items'    => [
                    'Legalitas PT',
                    'PKKPR',
                    'PERTEK',
                    'PETA BIDANG'
                ],
                'syarat_checklist'=> [],
                'syarat_files'    => [],
                'notes'           => 'Pendaftaran berkas permohonan hak atas tanah an. PT ke Kantor Pertanahan.',
                'is_template'     => true,
            ],

            // Poin 12: Rekomendasi Peil Banjir
            [
                'id'              => 'template_peil_banjir',
                'poin_label'      => 'Poin 12',
                'doc_name'        => 'Rekomendasi Peil Banjir',
                'instansi'        => 'Dinas Pekerjaan Umum & Tata Ruang (PUPR)',
                'doc_number'      => '',
                'doc_date'        => '',
                'status'          => 'belum',
                'file_path'       => null,
                'syarat_dokumen'  => "• Gambar Kontur & Elevasi Lahan\n• Perencanaan Saluran Drainase Kawasan\n• Titik Buang Air Utama (Outfall)\n• PKKPR OSS RBA",
                'syarat_items'    => [
                    'Gambar Kontur & Elevasi Lahan',
                    'Perencanaan Saluran Drainase Kawasan',
                    'Titik Buang Air Utama (Outfall)',
                    'PKKPR OSS RBA'
                ],
                'syarat_checklist'=> [],
                'syarat_files'    => [],
                'notes'           => 'Kajian elevasi tanah aman banjir dan rekomendasi teknis saluran pembuangan air kawasan perumahan.',
                'is_template'     => true,
            ],

            // Poin 13: Dokumen Lingkungan (UKL-UPL / SPPL)
            [
                'id'              => 'template_lingkungan',
                'poin_label'      => 'Poin 13',
                'doc_name'        => 'Persetujuan Lingkungan Hidup (UKL-UPL / SPPL)',
                'instansi'        => 'Dinas Lingkungan Hidup (DLH)',
                'doc_number'      => '',
                'doc_date'        => '',
                'status'          => 'belum',
                'file_path'       => null,
                'syarat_dokumen'  => "• Dokumen Rencana Pengelolaan Lingkungan (RKL-RPL)\n• Siteplan Pra Rencana\n• Surat Kesesuaian Tata Ruang (PKKPR)\n• Profil Usaha dan Badan Hukum PT",
                'syarat_items'    => [
                    'Dokumen Rencana Pengelolaan Lingkungan (RKL-RPL)',
                    'Siteplan Pra Rencana',
                    'Surat Kesesuaian Tata Ruang (PKKPR)',
                    'Profil Usaha dan Badan Hukum PT'
                ],
                'syarat_checklist'=> [],
                'syarat_files'    => [],
                'notes'           => 'Persetujuan kelayakan lingkungan hidup dan pengelolaan dampak limbah kawasan perumahan dari DLH.',
                'is_template'     => true,
            ],

            // Poin 14: Rekomendasi Andalalin
            [
                'id'              => 'template_andalalin',
                'poin_label'      => 'Poin 14',
                'doc_name'        => 'Rekomendasi Analisis Dampak Lalu Lintas (Andalalin)',
                'instansi'        => 'Dinas Perhubungan (Dishub)',
                'doc_number'      => '',
                'doc_date'        => '',
                'status'          => 'belum',
                'file_path'       => null,
                'syarat_dokumen'  => "• Kajian Sirkulasi Akses Keluar-Masuk Proyek\n• Lebar ROW Jalan Utama & Klasifikasi Jalan\n• Rencana Penempatan Rambu & Marka Jalan",
                'syarat_items'    => [
                    'Kajian Sirkulasi Akses Keluar-Masuk Proyek',
                    'Lebar ROW Jalan Utama & Klasifikasi Jalan',
                    'Rencana Penempatan Rambu & Marka Jalan'
                ],
                'syarat_checklist'=> [],
                'syarat_files'    => [],
                'notes'           => 'Rekomendasi teknis keselamatan dan kelancaran arus lalu lintas pada akses jalan masuk kawasan perumahan.',
                'is_template'     => true,
            ],

            // Poin 15: Validasi Pajak BPHTB
            [
                'id'              => 'template_validasi_bphtb',
                'poin_label'      => 'Poin 15',
                'doc_name'        => 'Validasi Pembayaran Pajak BPHTB',
                'instansi'        => 'Badan Pendapatan Daerah (Bapenda / BPKAD)',
                'doc_number'      => '',
                'doc_date'        => '',
                'status'          => 'belum',
                'file_path'       => null,
                'nominal'         => 0,
                'syarat_dokumen'  => "• Bukti Setor Bank / NTPN BPHTB\n• Salinan Akta Pelepasan Hak / SSPD\n• SPPT & Bukti Lunas PBB 5 Tahun Terakhir\n• Validasi Nilai Perolehan Objek Pajak (NPOP)",
                'syarat_items'    => [
                    'Bukti Setor Bank / NTPN BPHTB',
                    'Salinan Akta Pelepasan Hak / SSPD',
                    'SPPT & Bukti Lunas PBB 5 Tahun Terakhir',
                    'Validasi Nilai Perolehan Objek Pajak (NPOP)'
                ],
                'syarat_checklist'=> [],
                'syarat_files'    => [],
                'notes'           => 'Pengesahan dan validasi resmi setoran Bea Perolehan Hak atas Tanah dan Bangunan (BPHTB) oleh Bapenda.',
                'is_template'     => true,
            ],

            // Poin 16: SK HGB BPN
            [
                'id'              => 'template_sk_hgb',
                'poin_label'      => 'Poin 16',
                'doc_name'        => 'Surat Keputusan Pemberian Hak Guna Bangunan (SK HGB)',
                'instansi'        => 'Kantor Pertanahan / Kanwil ATR/BPN',
                'doc_number'      => $land->sk_hgb_no ?? '',
                'doc_date'        => $land && $land->sk_hgb_date ? \Carbon\Carbon::parse($land->sk_hgb_date)->format('Y-m-d') : '',
                'status'          => ($land && $land->sk_hgb_file) ? 'terbit' : (($land && $land->sk_hgb_no) ? 'proses' : 'belum'),
                'file_path'       => $land->sk_hgb_file ?? null,
                'syarat_dokumen'  => "• Berita Acara Sidang Panitia A / Pemeriksaan Tanah BPN\n• Bukti Lunas Validasi BPHTB\n• Bukti Setor PNBP SK Hak BPN",
                'syarat_items'    => [
                    'Berita Acara Sidang Panitia A / Pemeriksaan Tanah BPN',
                    'Bukti Lunas Validasi BPHTB',
                    'Bukti Setor PNBP SK Hak BPN'
                ],
                'syarat_checklist'=> [],
                'syarat_files'    => [],
                'notes'           => 'Keputusan resmi pemberian Hak Guna Bangunan atas nama PT dari Kepala Kantor Pertanahan / Kanwil BPN.',
                'is_template'     => true,
            ],

            // Poin 17: Buku SHGB Induk an. PT (Gol Akhir Pengindukan)
            [
                'id'              => 'template_shgb_induk',
                'poin_label'      => 'Poin 17',
                'doc_name'        => 'Penerbitan Buku Sertipikat SHGB Induk an. PT',
                'instansi'        => 'Kantor Pertanahan (ATR/BPN)',
                'doc_number'      => $land->shgb_induk_no ?? ($land->certificate_no ?? ''),
                'doc_date'        => $land && $land->shgb_induk_date ? \Carbon\Carbon::parse($land->shgb_induk_date)->format('Y-m-d') : '',
                'luas'            => $land->shgb_induk_area ?? ($land->area ?? ''),
                'status'          => ($land && $land->shgb_induk_file) ? 'terbit' : (($land && $land->shgb_induk_no) ? 'proses' : 'belum'),
                'file_path'       => $land->shgb_induk_file ?? ($land->file_certificate ?? null),
                'syarat_dokumen'  => "• Asli SK Pemberian HGB BPN\n• Bukti Pembayaran Pendaftaran Hak / Buku Tanah\n• Salinan Akta Pendirian & Legalitas PT Terkini",
                'syarat_items'    => [
                    'Asli SK Pemberian HGB BPN',
                    'Bukti Pembayaran Pendaftaran Hak / Buku Tanah',
                    'Salinan Akta Pendirian & Legalitas PT Terkini'
                ],
                'syarat_checklist'=> [],
                'syarat_files'    => [],
                'notes'           => 'Buku Sertipikat SHGB Induk resmi terbit atas nama PT.',
                'is_template'     => true,
                'is_final_goal'   => true,
            ],

            // Poin 18: Pengesahan Siteplan
            [
                'id'              => 'template_siteplan',
                'poin_label'      => 'Poin 18',
                'doc_name'        => 'Pengesahan Gambar Siteplan Kawasan Perumahan',
                'instansi'        => 'Dinas Perumahan, Kawasan Permukiman & Cipta Karya (DPKPP)',
                'doc_number'      => '',
                'doc_date'        => '',
                'status'          => 'belum',
                'file_path'       => null,
                'syarat_dokumen'  => "• Buku SHGB Induk an. PT\n• Gambar Desain Rencana Tapak / Siteplan (Format CAD/PDF)\n• Rekomendasi Peil Banjir & Andalalin\n• Persetujuan Lingkungan UKL-UPL / SPPL",
                'syarat_items'    => [
                    'Buku SHGB Induk an. PT',
                    'Gambar Desain Rencana Tapak / Siteplan (Format CAD/PDF)',
                    'Rekomendasi Peil Banjir & Andalalin',
                    'Persetujuan Lingkungan UKL-UPL / SPPL'
                ],
                'syarat_checklist'=> [],
                'syarat_files'    => [],
                'notes'           => 'Pengesahan komposisi luas kavling efektif, sarana jalan, utilitas, dan fasos-fasum oleh Dinas Perumahan / Pemda.',
                'is_template'     => true,
            ],

            // Poin 19: Pemecahan SHGB Perkavling
            [
                'id'              => 'template_pecah_kavling',
                'poin_label'      => 'Poin 19',
                'doc_name'        => 'Proses Pemecahan SHGB Induk Perkavling (Kavling Ready)',
                'instansi'        => 'Seksi Penetapan Hak & Pendaftaran BPN',
                'doc_number'      => '',
                'doc_date'        => '',
                'status'          => 'belum',
                'file_path'       => null,
                'syarat_dokumen'  => "• Asli Buku SHGB Induk an. PT\n• Salinan Pengesahan Siteplan Resmi Pemda\n• Formulir Permohonan Pemecahan Bidang Tanah ke BPN",
                'syarat_items'    => [
                    'Asli Buku SHGB Induk an. PT',
                    'Salinan Pengesahan Siteplan Resmi Pemda',
                    'Formulir Permohonan Pemecahan Bidang Tanah ke BPN'
                ],
                'syarat_checklist'=> [],
                'syarat_files'    => [],
                'notes'           => 'Pemecahan sertifikat induk menjadi sertifikat pecahan per-kavling unit perumahan siap jual dan akad KPR.',
                'is_template'     => true,
            ],
        ];
    }
}
