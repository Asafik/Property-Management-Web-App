<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LandBank;
use Illuminate\Support\Facades\DB;

class LandBankController extends Controller
{
    //
    public function index(){
        return view('properti.tambah_properti');
    }

//     public function store(Request $request)
// {
//     // ===== VALIDATION =====
//     $validated = $request->validate([
//         'namaTanah' => 'required|string|max:255',
//         'statusKepemilikan' => 'required|string|max:50',
//         'noSertifikat' => 'required|string|max:100',
//         'atasNama' => 'required|string|max:255',

//         'luasTanah' => 'required|numeric',
//         'hargaPerolehan' => 'required',
//         'tanggalPerolehan' => 'required|date',

//         'lokasi' => 'required|string',
//         'kelurahan' => 'nullable|string|max:100',
//         'kecamatan' => 'nullable|string|max:100',
//         'kota' => 'nullable|string|max:100',
//         'provinsi' => 'nullable|string|max:100',
//         'kodePos' => 'nullable|string|max:10',

//         'noIMB' => 'nullable|string|max:100',
//         'noPBB' => 'nullable|string|max:100',

//         'zonasi' => 'nullable|string|max:100',
//         'lebarJalan' => 'nullable|numeric',
//         'jenisJalan' => 'nullable|string|max:50',

//         'statusLegal' => 'required|string|max:50',
//         'statusKavling' => 'required|string|max:50',
//         'prioritas' => 'nullable|string|max:50',

//         'latitude' => 'nullable|string',
//         'longitude' => 'nullable|string',

//         'uploadSertifikat' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
//         'uploadIMB' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
//         'uploadPBB' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',

//         'deskripsi' => 'nullable|string'
//     ]);

//     // ===== FORMAT HARGA (hapus titik koma Rp) =====
//     $harga = str_replace('.', '', $request->hargaPerolehan);
//     $harga = str_replace(',', '', $harga);

//     // ===== UPLOAD FILE =====
//     $fileSertifikat = null;
//     if ($request->hasFile('uploadSertifikat')) {
//         $fileSertifikat = $request->file('uploadSertifikat')->store('sertifikat', 'public');
//     }

//     $fileIMB = null;
//     if ($request->hasFile('uploadIMB')) {
//         $fileIMB = $request->file('uploadIMB')->store('imb', 'public');
//     }

//     $filePBB = null;
//     if ($request->hasFile('uploadPBB')) {
//         $filePBB = $request->file('uploadPBB')->store('pbb', 'public');
//     }

//     // ===== INSERT =====
//     LandBank::create([
//         'name' => $request->namaTanah,
//         'ownership_status' => $request->statusKepemilikan,
//         'certificate_no' => $request->noSertifikat,
//         'certificate_owner' => $request->atasNama,

//         'area' => $request->luasTanah,
//         'acquisition_price' => $harga,
//         'acquisition_date' => $request->tanggalPerolehan,

//         'imb_no' => $request->noIMB,
//         'pbb_no' => $request->noPBB,

//         'address' => $request->lokasi,
//         'village' => $request->kelurahan,
//         'district' => $request->kecamatan,
//         'city' => $request->kota,
//         'province' => $request->provinsi,
//         'postal_code' => $request->kodePos,

//         'zoning' => $request->zonasi,
//         'road_width' => $request->lebarJalan,
//         'road_type' => $request->jenisJalan,

//         'facility_school' => $request->has('fasSekolah'),
//         'facility_hospital' => $request->has('fasRumahSakit'),
//         'facility_mall' => $request->has('fasMall'),
//         'facility_transport' => $request->has('fasTransportasi'),

//         'legal_status' => $request->statusLegal,
//         'development_status' => $request->statusKavling,
//         'priority' => $request->prioritas,

//         'lat' => $request->latitude,
//         'lng' => $request->longitude,

//         'file_certificate' => $fileSertifikat,
//         'file_imb' => $fileIMB,
//         'file_pbb' => $filePBB,

//         'description' => $request->deskripsi,
//         'status' => 'draft'
//     ]);

//     dd($request->all());
//     return redirect()->route('properti')
//         ->with('success', 'Data Properti Berhasil Ditambahkan');
// }
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

    // ===== format rupiah =====
    $harga = preg_replace('/[^0-9]/', '', $request->hargaPerolehan);

    // ===== upload =====
    $sertifikat = null;
    $imb = null;
    $pbb = null;

    if ($request->hasFile('uploadSertifikat')) {
        $sertifikat = $request->file('uploadSertifikat')->store('sertifikat','public');
    }

    if ($request->hasFile('uploadIMB')) {
        $imb = $request->file('uploadIMB')->store('imb','public');
    }

    if ($request->hasFile('uploadPBB')) {
        $pbb = $request->file('uploadPBB')->store('pbb','public');
    }

    // ===== INSERT SESUAI MIGRATION =====
    $id = DB::table('land_banks')->insertGetId([
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

        'file_certificate' => $sertifikat,
        'file_imb' => $imb,
        'file_pbb' => $pbb,

        'description' => $request->deskripsi,
        'status' => 'draft',

        'created_at' => now(),
        'updated_at' => now()
    ]);

    // ===== tombol lanjut =====
    if ($request->redirect == 'verifikasi') {
        return redirect('/properti/verifikasi-legal/'.$id)
            ->with('success','Data tersimpan, lanjut verifikasi');
    }

    return redirect()->route('properti')
        ->with('success','Data properti berhasil disimpan');
}





}
