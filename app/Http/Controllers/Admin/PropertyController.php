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
    return view('properti.edit', compact('land', 'companies', 'documentTypes'));
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

                $isDocVerified = ($existingDoc && $existingDoc->status === 'verified') || $isLandVerified;

                // Jika dokumen sudah verified dan sudah punya file, kunci agar tidak bisa ditimpa
                if ($isDocVerified && $existingDoc && !empty($existingDoc->file_path)) {
                    continue;
                }

                $filePath = $existingDoc ? $existingDoc->file_path : null;

                if (!empty($doc['file']) && !$isDocVerified) {
                    $file = $doc['file'];
                    $filename = uniqid() . '.' . $file->getClientOriginalExtension();
                    $destination = $_SERVER['DOCUMENT_ROOT'] . '/uploads/landbank/' . $land->id . '/' . $typeId;

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
                    if (!$isDocVerified && isset($doc['number'])) {
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
}
