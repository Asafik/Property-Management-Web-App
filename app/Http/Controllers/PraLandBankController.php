<?php

namespace App\Http\Controllers;

use App\Models\pra_landbank_documents;
use App\Models\DocumentTypes;
use Illuminate\Http\Request;
use App\Models\PraLandbank;
use Illuminate\Support\Facades\Log;

class PraLandBankController extends Controller
{
   public function index()
{
    $praLandBank = PraLandbank::paginate(10);
    $documentTypes = pra_landbank_documents::all();

    return view('land_bank.all_pra_land_bank', compact('praLandBank', 'documentTypes'));
}

public function store(Request $request)
{
    try {

        // =========================
        // CLEAN NUMBER
        // =========================
        $cleanNumber = function ($value) {
            return $value ? str_replace('.', '', $value) : null;
        };

        // =========================
        // VALIDASI BASIC
        // =========================
        if ($request->fase !== 'fase1' && !$request->filled('id')) {
            return response()->json([
                'success' => false,
                'message' => 'ID wajib ada untuk fase lanjutan'
            ], 400);
        }

        // =========================
        // FASE 1 (CREATE)
        // =========================
        if (!$request->filled('id')) {

            $data = $request->except(['file_certificate', 'photo', 'fase']);

            $data['offer_price']     = $cleanNumber($request->offer_price);
            $data['estimated_price'] = $cleanNumber($request->estimated_price);
            $data['area']            = $cleanNumber($request->area);

            $data['status'] = 'fase1';

            // upload certificate
            if ($request->hasFile('file_certificate')) {
                $file = $request->file('file_certificate');
                $filename = uniqid() . '_' . $file->getClientOriginalName();
                $file->storeAs('public/certificates', $filename);
                $data['file_certificate'] = $filename;
            }

            // upload photos
            if ($request->hasFile('photo')) {
                $photos = [];
                foreach ($request->file('photo') as $photo) {
                    $photoname = uniqid() . '_' . $photo->getClientOriginalName();
                    $photo->storeAs('public/photos', $photoname);
                    $photos[] = $photoname;
                }
                $data['photo'] = json_encode($photos);
            }

            $record = PraLandbank::create($data);

            return response()->json([
                'success' => true,
                'message' => 'Fase 1 berhasil',
                'id' => $record->id
            ]);
        }

        // =========================
        // UPDATE (FASE 2 / 3)
        // =========================
        $record = PraLandbank::findOrFail($request->id);
        $data   = $request->except(['id', 'fase']);

        // clean number
        if ($request->has('offer_price')) {
            $data['offer_price'] = $cleanNumber($request->offer_price);
        }

        if ($request->has('estimated_price')) {
            $data['estimated_price'] = $cleanNumber($request->estimated_price);
        }

        if ($request->has('area')) {
            $data['area'] = $cleanNumber($request->area);
        }

        // =========================
        // FILE UPLOAD
        // =========================



if ($request->has('documents')) {

    foreach ($request->documents as $typeId => $doc) {

        if (empty($doc['number']) && empty($doc['file'])) {
            continue;
        }

        $filePath = null;

        if (!empty($doc['file'])) {

            $file = $doc['file'];
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();

            $destination = public_path('uploads/pra_landbank/' . $record->id . '/' . $typeId);

            if (!file_exists($destination)) {
                mkdir($destination, 0755, true);
            }

            $file->move($destination, $filename);

            $filePath = 'uploads/pra_landbank/' . $record->id . '/' . $typeId . '/' . $filename;
        }

        pra_landbank_documents::create([
            'pra_landbank_id' => $record->id,
            'document_type_id' => $typeId,
            'document_number' => $doc['number'] ?? null,
            'file_path' => $filePath,
            'status' => 'pending',
            'revision_number' => 0,
        ]);
    }
}

        // =========================
        // STATUS
        // =========================
        if ($request->fase === 'fase2') {
            $data['status'] = 'fase2';
        }

        if ($request->fase === 'fase3') {
            $data['status'] = 'fase3';
        }

        if (in_array($request->status, ['approved', 'rejected'])) {
            $data['status'] = $request->status;
        }

        // pastikan status tidak kosong
        $data['status'] = $data['status'] ?? $record->status;

        $record->update($data);

        // =========================
        // AUTO PINDAH KE LANDBANK
        // =========================
        if ($data['status'] === 'approved') {

            \App\Models\LandBank::create([
                'name'              => $record->land_name,
                'area'              => $record->area,
                'acquisition_price' => $record->estimated_price,
                'address'           => $record->address,
                'village'           => $record->village,
                'district'          => $record->district,
                'city'              => $record->city,
                'province'          => $record->province,
                'zoning'            => $record->zoning,
                'road_width'        => $record->road_width,
                'road_type'         => $record->road_type,
                'lat'               => $record->lat,
                'lng'               => $record->lng,
                'file_certificate'  => $record->file_certificate,
                'photo'             => $record->photo,
                'status'            => 'draft'
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Berhasil update',
            'status'  => $data['status']
        ]);

    } catch (\Exception $e) {

        \Log::error($e->getMessage());

        return response()->json([
            'success' => false,
            'message' => $e->getMessage()
        ], 500);
    }
}
    public function indexpra(Request $request)
    {
        $query = PraLandbank::query();

        // Search: nama tanah
        if ($request->filled('search')) {
            $query->where('land_name', 'like', '%' . $request->search . '%');
        }

        // Filter: status negosiasi
        if ($request->filled('negotiation_status')) {
            $query->where('negotiation_status', $request->negotiation_status);
        }

        // Sort
        $allowedSorts  = ['land_name', 'estimated_price', 'negotiation_status', 'created_at'];
        $sortField     = in_array($request->get('sortField'), $allowedSorts)
            ? $request->get('sortField')
            : 'created_at';
        $sortDirection = $request->get('sortDirection', 'desc') === 'asc' ? 'asc' : 'desc';
        $query->orderBy($sortField, $sortDirection);

        // perPage: 10, 15, 25
        $perPage = in_array((int) $request->get('perPage', 10), [10, 15, 25])
            ? (int) $request->get('perPage', 10)
            : 10;

        $praLandBank = $query->paginate($perPage)->withQueryString();
         $documentTypes = DocumentTypes::all();
        return view('land_bank.all_pra_land_bank', compact('praLandBank', 'documentTypes'));
    }
    public function proses(Request $request, $id = null)
    {
        $land = null;
        if ($id) {
            $land = PraLandbank::with('documents.documentType')->findOrFail($id);
        }
        $documentTypes = DocumentTypes::all();
        return view('land_bank.proses_pra_land_bank', compact('land', 'documentTypes'));
    }
    public function destroy($id)
    {
        try {
            $record = PraLandbank::findOrFail($id);
            $record->delete();

            return response()->json([
                'success' => true,
                'message' => 'Data berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());

            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
