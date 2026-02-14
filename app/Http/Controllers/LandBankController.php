<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LandBank;
use App\Models\LandBankDocument;
use Illuminate\Support\Facades\DB;

class LandBankController extends Controller
{
    //
    public function index(){
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

        // ===== format rupiah =====
        $harga = preg_replace('/[^0-9]/', '', $request->hargaPerolehan);

        // ===== INSERT LAND BANK =====
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

        // ===== HANDLE DOCUMENTS =====
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

public function rejectDocument($id)
{
    $doc = LandBankDocument::findOrFail($id);

    $doc->update([
        'status' => 'ditolak',
        'revisi_ke' => $doc->revisi_ke + 1
    ]);

    return back()->with('success', 'Dokumen ditolak');
}

}
