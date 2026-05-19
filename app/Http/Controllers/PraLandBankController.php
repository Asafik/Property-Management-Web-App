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
    $praLandBank = PraLandbank::with('payments')->paginate(10);
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
            return $value ? preg_replace('/[^0-9]/', '', $value) : null;
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
        // MAP FIELDS BY FASE
        // =========================
        if ($request->fase === 'fase2') {
            $data['status'] = 'fase2';

            // Map Fase 2 fields
            $data['survey_date']       = $request->tgl_survey;
            $data['survey_by']         = $request->petugas;
            $data['survey_result']     = $request->hasil_survey;
            $data['survey_notes']      = $request->catatan_survey;
            $data['land_status']       = $request->land_status_temp;
            $data['water_condition']   = $request->water_condition_temp;
            $data['legal_status']      = $request->status_tanah;
            $data['legal_issue_note']  = $request->keterangan_masalah;
            $data['permit_difficulty'] = $request->kesulitan_izin;

            if ($request->has('zoning')) $data['zoning'] = $request->zoning;
            if ($request->has('road_width')) $data['road_width'] = $request->road_width ? $cleanNumber($request->road_width) : null;
            if ($request->has('road_type')) $data['road_type'] = $request->road_type;
            if ($request->has('lat')) $data['lat'] = $request->lat;
            if ($request->has('lng')) $data['lng'] = $request->lng;

            // Map facilities array to individual boolean columns
            $facList = $request->fasilitas ?? [];
            $data['facility_school']    = in_array('sekolah', $facList);
            $data['facility_hospital']  = in_array('rumah_sakit', $facList);
            $data['facility_market']    = in_array('pasar', $facList);
            $data['facility_transport'] = in_array('transportasi', $facList);
            $data['facility_mall']      = in_array('mall', $facList);
            $data['facility_bank']      = in_array('bank', $facList);
        }

        if ($request->fase === 'fase3') {
            $data['status'] = $request->status ?? 'fase3'; // approved, rejected, or pending (fase3)
            
            // Map Fase 3 fields
            $data['priority']             = $request->prioritas;
            $data['notes']                = $request->catatan;
            $data['cost_ijb']             = $request->biaya_ijb_temp ? $cleanNumber($request->biaya_ijb_temp) : null;
            $data['cost_tax']             = $request->biaya_pajak_temp ? $cleanNumber($request->biaya_pajak_temp) : null;
            $data['cost_broker']          = $request->fee_makelar_temp ? $cleanNumber($request->fee_makelar_temp) : null;
            $data['cost_other']           = $request->biaya_lain_temp ? $cleanNumber($request->biaya_lain_temp) : null;
            $data['payment_method']       = $request->payment_method_temp;
            $data['installment_duration'] = $request->installment_duration_temp;
            $data['installment_count']    = $request->installment_count_temp;

            if ($request->has('estimated_price')) {
                $data['estimated_price'] = $request->estimated_price ? $cleanNumber($request->estimated_price) : null;
            }

            // Upload file_ijb
            if ($request->hasFile('file_ijb_temp')) {
                $file = $request->file('file_ijb_temp');
                $filename = uniqid() . '_ijb_' . $file->getClientOriginalName();
                $file->move(public_path('uploads/pra_landbank/' . $record->id . '/ijb'), $filename);
                $data['file_ijb'] = 'uploads/pra_landbank/' . $record->id . '/ijb/' . $filename;
            }

            // Upload file_tax
            if ($request->hasFile('file_pajak_temp')) {
                $file = $request->file('file_pajak_temp');
                $filename = uniqid() . '_pajak_' . $file->getClientOriginalName();
                $file->move(public_path('uploads/pra_landbank/' . $record->id . '/pajak'), $filename);
                $data['file_tax'] = 'uploads/pra_landbank/' . $record->id . '/pajak/' . $filename;
            }

            // Process dynamic payment installments
            if ($data['payment_method'] === 'termin' && $request->has('installments')) {
                // Delete previous installments to overwrite or rebuild nicely
                $record->payments()->delete();

                foreach ($request->installments as $i => $inst) {
                    $amount = isset($inst['amount_temp']) ? $cleanNumber($inst['amount_temp']) : 0;
                    $dueDate = $inst['due_date'] ?? null;
                    $status = $inst['status'] ?? 'belum';
                    $termName = $inst['term_name'] ?? ('Tahap ' . $i);

                    $filePath = null;

                    // Check if file upload exists for this installment row
                    if ($request->hasFile("installments.{$i}.file")) {
                        $file = $request->file("installments.{$i}.file");
                        $filename = uniqid() . '_termin_' . $i . '_' . $file->getClientOriginalName();
                        $file->move(public_path('uploads/pra_landbank/' . $record->id . '/termin'), $filename);
                        $filePath = 'uploads/pra_landbank/' . $record->id . '/termin/' . $filename;
                    }

                    \App\Models\PraLandbankPayment::create([
                        'pra_landbank_id' => $record->id,
                        'term_name'       => $termName,
                        'amount'          => $amount,
                        'due_date'        => $dueDate,
                        'file_path'       => $filePath,
                        'status'          => $status,
                    ]);
                }
            } else {
                // If not termin, delete any existing installments
                $record->payments()->delete();
            }
        }

        // Check if there are active unpaid installments
        $isTerminActive = false;
        if (($data['payment_method'] ?? $record->payment_method) === 'termin') {
            if ($request->has('installments')) {
                foreach ($request->installments as $inst) {
                    if (($inst['status'] ?? 'belum') === 'belum') {
                        $isTerminActive = true;
                        break;
                    }
                }
            } else {
                $isTerminActive = $record->payments()->where('status', 'belum')->exists();
            }
        }

        // pastikan status tidak kosong
        $data['status'] = $data['status'] ?? $record->status;

        if ($data['status'] === 'approved' && $isTerminActive) {
            // Downgrade/force to 'fase3' because payments are still active and incomplete
            $data['status'] = 'fase3';
            $customMessage = 'Data cicilan berhasil disimpan. Progres tanah tetap dalam Fase 3 (Cicilan Aktif) karena masih ada cicilan yang belum lunas.';
        } else {
            $customMessage = 'Data keputusan sidang berhasil disimpan!';
        }

        $record->update($data);

        // =========================
        // AUTO PINDAH KE LANDBANK
        // =========================
        if ($data['status'] === 'approved') {

            $newLandBank = \App\Models\LandBank::create([
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
                'status'            => 'draft',
                'legal_status'      => 'verified'
            ]);

            // Copy all documents from pra_landbank_documents to land_bank_documents
            if ($record->documents()->exists()) {
                foreach ($record->documents as $doc) {
                    \App\Models\LandBankDocument::create([
                        'land_bank_id'     => $newLandBank->id,
                        'document_type_id' => $doc->document_type_id,
                        'document_number'  => $doc->document_number,
                        'file_path'        => $doc->file_path,
                        'status'           => 'verified',
                        'revision_number'  => $doc->revision_number
                    ]);
                }
            }
        }

        return response()->json([
            'success' => true,
            'message' => $customMessage,
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
        $query = PraLandbank::with('payments');

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
