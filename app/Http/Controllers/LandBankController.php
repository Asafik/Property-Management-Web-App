<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LandBank;
use App\Models\CompanyProfile;
use App\Models\LandBankDocument;
use Illuminate\Support\Facades\Log;


use App\Models\DocumentTypes;
use Illuminate\Support\Facades\DB;

class LandBankController extends Controller
{
    public function index()
    {
        $companies = CompanyProfile::withCount('landBanks')->get();
        $documentTypes = DocumentTypes::orderBy('name')->get();
        return view('properti.tambah_properti', compact('companies', 'documentTypes'));
    }
public function store(Request $request)
{
    try {

        $validated = $request->validate([
            'namaTanah' => 'required|string|max:200',
            'statusKepemilikan' => 'required|string',
            'company_profile_id' => 'required|exists:company_profiles,id',
            'lokasi' => 'required|string',
            'luasTanah' => 'required|numeric',
            'hargaPerolehan' => 'required',
            'tanggalPerolehan' => 'required|date',
            'statusLegal' => 'required|string',
            'statusKavling' => 'required|string',

            'elevasi_awal'     => 'nullable|numeric',
            'elevasi_rencana'  => 'nullable|numeric',
            'volume_cut'       => 'nullable|numeric',
            'volume_fill'      => 'nullable|numeric',
            'status_cut_fill'  => 'nullable|in:planned,proses,selesai',

            'documents.*.file'   => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'documents.*.number' => 'nullable|string|max:255',
        ]);

    } catch (\Illuminate\Validation\ValidationException $e) {

        Log::warning('VALIDATION ERROR STORE LAND BANK', [
            'errors' => $e->errors(),
            'request' => $request->all()
        ]);

        throw $e; // biar tetap balik ke form dengan error
    }

    DB::beginTransaction();

    try {

        $harga = preg_replace('/[^0-9]/', '', $request->hargaPerolehan);

        $land = LandBank::create([
            'name' => $request->namaTanah,
            'company_profile_id' => $request->company_profile_id,
            'ownership_status' => $request->statusKepemilikan,
            'area' => $request->luasTanah,
            'remaining_area' => $request->luasTanah ?? null,
            'acquisition_price' => $harga,
            'acquisition_date' => $request->tanggalPerolehan,
            'address' => $request->lokasi,
            'village' => $request->kelurahan,
            'district' => $request->kecamatan,
            'city' => $request->kota,
            'province' => $request->provinsi,
            'postal_code' => $request->kodePos,
            'zoning' => $request->zonasi,
            'road_width' => $request->lebarJalan,
            'road_type' => $request->jenisJalan,
            'facility_school' => $request->has('fasSekolah'),
            'facility_hospital' => $request->has('fasRumahSakit'),
            'facility_mall' => $request->has('fasMall'),
            'facility_transport' => $request->has('fasTransportasi'),
            'legal_status' => $request->statusLegal,
            'development_status' => $request->statusKavling,
            'priority' => $request->prioritas,
            'lat' => $request->latitude,
            'lng' => $request->longitude,
            'description' => $request->deskripsi,
            'status' => 'draft',
            'elevasi_awal' => $request->elevasi_awal,
            'elevasi_rencana' => $request->elevasi_rencana,
            'volume_cut' => $request->volume_cut,
            'volume_fill' => $request->volume_fill,
            'status_cut_fill' => $request->status_cut_fill ?? 'planned',
        ]);

        if (!$land) {
            Log::error('FAILED INSERT LAND BANK', [
                'request' => $request->all()
            ]);
            throw new \Exception('Insert LandBank gagal');
        }

        // ===============================
        // HANDLE DOCUMENTS
        // ===============================
        if ($request->has('documents')) {

            foreach ($request->documents as $typeId => $doc) {

                if (empty($doc['number']) && empty($doc['file'])) {
                    continue;
                }

                $filePath = null;

                if (!empty($doc['file'])) {

                    try {
                        $filePath = $doc['file']
                            ->store('landbank/'.$land->id.'/'.$typeId, 'public');

                    } catch (\Exception $fileError) {

                        Log::error('FILE UPLOAD ERROR', [
                            'land_id' => $land->id,
                            'type_id' => $typeId,
                            'error' => $fileError->getMessage()
                        ]);

                        throw $fileError;
                    }
                }

                $docInsert = LandBankDocument::create([
                    'land_bank_id'     => $land->id,
                    'document_type_id' => $typeId,
                    'document_number'  => $doc['number'] ?? null,
                    'file_path'        => $filePath,
                    'status'           => 'pending',
                    'revision_number'  => 0,
                ]);

                if (!$docInsert) {
                    Log::error('FAILED INSERT LAND DOCUMENT', [
                        'land_id' => $land->id,
                        'type_id' => $typeId
                    ]);

                    throw new \Exception('Insert document gagal');
                }
            }
        }

        DB::commit();

        return redirect()->route('properti')
            ->with('success', 'Data properti berhasil disimpan dan menunggu verifikasi disemua tanah');

    } catch (\Exception $e) {

        DB::rollBack();

        Log::error('STORE LAND BANK ERROR', [
            'message' => $e->getMessage(),
            'line' => $e->getLine(),
            'file' => $e->getFile(),
            'request' => $request->all()
        ]);

        return back()->with('error', 'Terjadi kesalahan, silakan cek log.');
    }
}
    // ===============================
    // VERIFIKASI
    // ===============================

    public function verifikasiLegal($id)
    {
        $land = LandBank::with('documents')->findOrFail($id);
        return view('properti.verifikasi_legal', compact('land'));
    }

    public function approveDocument($id)
    {
        $doc = LandBankDocument::findOrFail($id);

        $doc->update([
            'status' => 'verified'
        ]);

        return back()->with('success', 'Dokumen berhasil diverifikasi');
    }

    public function rejectDocument(Request $request, $id)
{
    $request->validate([
        'catatan_admin' => 'required|string|max:1000'
    ], [
        'catatan_admin.required' => 'Catatan penolakan wajib diisi.'
    ]);

    $doc = LandBankDocument::findOrFail($id);

    $doc->update([
        'status' => 'ditolak',
        'catatan_admin' => $request->catatan_admin,
        'revisi_ke' => $doc->revisi_ke + 1
    ]);

    return back()->with('success', 'Dokumen ditolak & menunggu revisi.');
}


    // ===============================
    // REVISI DATA
    // ===============================

public function revisi($id)
{
    $land = LandBank::with('documents')->findOrFail($id);

    $documents = $land->documents->where('status', 'ditolak');

    // hitung progress
    $total = $land->documents->count();
    $verified = $land->documents->where('status', 'terverifikasi')->count();
    $progress = $total > 0 ? round(($verified / $total) * 100) : 0;

    return view('properti.revisi', compact('land', 'documents', 'progress'));
}


    public function updateRevisi(Request $request, $id)
    {
        $land = LandBank::findOrFail($id);

        $land->update([
            'certificate_owner' => $request->certificate_owner,
            'ownership_status' => $request->ownership_status,
            'area' => $request->area,
            'acquisition_price' => preg_replace('/[^0-9]/','',$request->acquisition_price),
            'acquisition_date' => $request->acquisition_date,
            'legal_status' => $request->legal_status,
            'development_status' => $request->development_status,
            'priority' => $request->priority,
            'description' => $request->description,
            'status' => 'pending',
             'lat' => $request->lat,
            'lng' => $request->lng,
        ]);

        return redirect()
            ->route('properti.verifikasi',$land->id)
            ->with('success','Revisi berhasil disimpan & dikirim ulang untuk verifikasi');
    }

    // ===============================
    // REVISI DOKUMEN
    // ===============================

    public function updateDocument(Request $request, $id)
    {
        $request->validate([
            'file' => 'required|file|mimes:pdf,jpg,jpeg,png'
        ]);

        $doc = LandBankDocument::findOrFail($id);

        $path = $request->file('file')
            ->store('landbank/'.$doc->type, 'public');

        $doc->update([
            'file_path' => $path,
            'status' => 'pending'
        ]);

        return redirect()
            ->route('properti.verifikasi', $doc->land_bank_id)
            ->with('success','Dokumen berhasil direvisi, menunggu verifikasi ulang');
    }
    // ===============================
// MASS APPROVE & REJECT
// ===============================

public function approveAllDocuments($id)
{
    $land = LandBank::with('documents')->findOrFail($id);

    foreach ($land->documents as $doc) {
        $doc->update([
            'status' => 'verified',
        ]);
    }

    // Cek apakah semua dokumen sudah terverifikasi
    $allVerified = $land->documents->every(function($doc) {
        return $doc->status === 'verified';
    });

    if ($allVerified) {
        $land->update([
            'legal_status' => 'verified'
        ]);
    }

    return back()->with('success', 'Semua dokumen berhasil disetujui');
}


public function rejectAllDocuments(Request $request, $id)
{
    $request->validate([
        'catatan_admin' => 'required|string|max:1000'
    ], [
        'catatan_admin.required' => 'Catatan penolakan wajib diisi.'
    ]);

    $land = LandBank::with('documents')->findOrFail($id);

    foreach ($land->documents as $doc) {
        $doc->update([
            'status' => 'rejected',
            'catatan_admin' => $request->catatan_admin,
            'revisi_ke' => $doc->revisi_ke + 1
        ]);
    }

    return back()->with('success', 'Semua dokumen ditolak & menunggu revisi.');
}

}
