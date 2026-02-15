<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LandBank;
use App\Models\LandBankDocument;
use Illuminate\Support\Facades\DB;

class LandBankController extends Controller
{
    public function index()
    {
        return view('properti.tambah_properti');
    }

    public function store(Request $request)
    {
        $request->validate([
            'namaTanah' => 'required|string|max:200',
            'statusKepemilikan' => 'required|string',
            'lokasi' => 'required|string',
            'luasTanah' => 'required|numeric',
            'hargaPerolehan' => 'required',
            'tanggalPerolehan' => 'required|date',
            'noSertifikat' => 'required|string',
            'atasNama' => 'required|string',
            'statusLegal' => 'required|string',
            'statusKavling' => 'required|string',
        ]);

        DB::beginTransaction();

        try {

            $harga = preg_replace('/[^0-9]/', '', $request->hargaPerolehan);

            // ===============================
            // INSERT LAND BANK
            // ===============================
            $land = LandBank::create([
                'name' => $request->namaTanah,
                'ownership_status' => $request->statusKepemilikan,
                'certificate_no' => $request->noSertifikat,
                'certificate_owner' => $request->atasNama,

                'area' => $request->luasTanah,
                'acquisition_price' => $harga,
                'acquisition_date' => $request->tanggalPerolehan,

                'imb_no' => $request->noIMB,
                'pbb_no' => $request->noPBB,

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
                'status' => 'draft'
            ]);

            // ===============================
            // HANDLE DOCUMENT
            // ===============================
            $documents = [
                'uploadSertifikat' => [
                    'type' => 'sertifikat',
                    'number' => $request->noSertifikat
                ],
                'uploadIMB' => [
                    'type' => 'imb',
                    'number' => $request->noIMB
                ],
                'uploadPBB' => [
                    'type' => 'pbb',
                    'number' => $request->noPBB
                ],
            ];

            foreach ($documents as $field => $doc) {

                if ($request->hasFile($field)) {

                    $path = $request->file($field)
                        ->store('landbank/'.$doc['type'], 'public');

                    LandBankDocument::create([
                        'land_bank_id' => $land->id,
                        'type' => $doc['type'],
                        'file_path' => $path,
                        'document_number' => $doc['number'],
                        'status' => 'pending',
                        'revisi_ke' => 0
                    ]);
                }
            }

            DB::commit();

            if ($request->redirect == 'verifikasi') {
                return redirect('/properti/verifikasi-legal/'.$land->id)
                    ->with('success','Data tersimpan, lanjut verifikasi');
            }

            return redirect()->route('properti')
                ->with('success','Data properti berhasil disimpan');

        } catch (\Exception $e) {

            DB::rollBack();
            return back()->with('error','Terjadi kesalahan: '.$e->getMessage());
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
            'status' => 'terverifikasi'
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
            'status' => 'terverifikasi'
        ]);
    }

    // Cek apakah semua dokumen sudah terverifikasi
    $allVerified = $land->documents->every(function($doc) {
        return $doc->status === 'terverifikasi';
    });

    if ($allVerified) {
        $land->update([
            'legal_status' => 'terverifikasi'
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
            'status' => 'ditolak',
            'catatan_admin' => $request->catatan_admin,
            'revisi_ke' => $doc->revisi_ke + 1
        ]);
    }

    return back()->with('success', 'Semua dokumen ditolak & menunggu revisi.');
}

}
