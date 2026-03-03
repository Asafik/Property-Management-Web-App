<?php

namespace App\Http\Controllers;

use App\Models\KprApplication;
use App\Models\Banks;
use App\Models\LandBankUnit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Booking;
class KprApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function show(Booking $booking)
{
    // load relasi customer + unit
    $booking->load(['customer', 'unit']);

    // ambil daftar bank aktif
    $banks = Banks::where('is_active', 1)->get();

    // tampilkan form KPR untuk booking ini
    return view('marketing.pengajuan', compact('booking', 'banks'));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     dd($request->all());

    // }
 
public function store(Request $request)
{
    DB::beginTransaction();

    try {

        // =============================
        // VALIDASI
        // =============================
        $request->validate([
            'customer_id' => 'required',
            'unit_id'     => 'required',
            'banks_id'    => 'required',
            'dp'          => 'required|numeric|min:0',
            'tenor'       => 'required|numeric|min:1',
            'bunga'       => 'required|numeric|min:0',
        ]);

        // =============================
        // AMBIL UNIT
        // =============================
        $unit = LandBankUnit::findOrFail($request->unit_id);

        $hargaUnit = $unit->price ?? 0;

        if ($hargaUnit <= 0) {
            throw new \Exception('Harga unit tidak ditemukan');
        }

        $dp    = $request->dp;
        $tenor = $request->tenor;
        $bunga = $request->bunga;

        // Pastikan DP tidak lebih besar dari harga
        if ($dp > $hargaUnit) {
            throw new \Exception('DP tidak boleh lebih besar dari harga unit');
        }

        // =============================
        // HITUNG PINJAMAN (BACKEND)
        // =============================
        $jumlahPinjaman = $hargaUnit - $dp;

        // =============================
        // HITUNG ANGSURAN (BUNGA FLAT)
        // =============================
        $bungaTotal    = $jumlahPinjaman * ($bunga / 100);
        $totalPinjaman = $jumlahPinjaman + $bungaTotal;

        $estimasiAngsuran = $totalPinjaman / ($tenor * 12);

        // =============================
        // UPLOAD FILE
        // =============================
        $upload = [];
        $fileFields = [
            'slip_gaji',
            'rekening_koran',
            'npwp',
            'sku',
            'surat_nikah',
            'ktp_pasangan'
        ];

        foreach ($fileFields as $field) {
            if ($request->hasFile($field)) {
                $upload[$field] = $request->file($field)->store('kpr', 'public');
            }
        }

        // =============================
        // SIMPAN DATA
        // =============================
        KprApplication::create([
            'booking_id'        => $request->booking_id ?? $request->unit_id,
            'customer_id'       => $request->customer_id,
            'unit_id'           => $request->unit_id,
            'banks_id'          => $request->banks_id,
            'produk_kpr'        => $request->produk_kpr,
            'harga_unit'        => $hargaUnit,
            'jumlah_pinjaman'   => $jumlahPinjaman,
            'dp'                => $dp,
            'tenor'             => $tenor,
            'bunga'             => $bunga,
            'estimasi_angsuran' => round($estimasiAngsuran),
            'status_pekerjaan'  => $request->status_pekerjaan,
            'status'            => 'pengajuan',
            'submitted_at'      => now(),

            'slip_gaji'      => $upload['slip_gaji'] ?? null,
            'rekening_koran' => $upload['rekening_koran'] ?? null,
            'npwp'           => $upload['npwp'] ?? null,
            'sku'            => $upload['sku'] ?? null,
            'surat_nikah'    => $upload['surat_nikah'] ?? null,
            'ktp_pasangan'   => $upload['ktp_pasangan'] ?? null,
        ]);

        DB::commit();

        return redirect()->back()
            ->with('success', 'Pengajuan KPR berhasil disimpan');

    } catch (\Throwable $e) {

        DB::rollBack();

        return redirect()->back()
            ->withInput()
            ->with('error', $e->getMessage());
    }
}




   

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KprApplication $kprApplication)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, KprApplication $kprApplication)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KprApplication $kprApplication)
    {
        //
    }
}
