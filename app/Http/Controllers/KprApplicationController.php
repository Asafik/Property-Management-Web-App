<?php

namespace App\Http\Controllers;

use App\Models\KprApplication;
use App\Models\Banks;
use App\Models\LandBankUnit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Booking;
use App\Models\KprDocument;
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
            'booking_id' => 'required|exists:bookings,id',
            'customer_id' => 'required|exists:customers,id',
            'unit_id'     => 'required|exists:land_bank_units,id',
            'banks_id'    => 'required|exists:banks,id',
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

        if ($dp > $hargaUnit) {
            throw new \Exception('DP tidak boleh lebih besar dari harga unit');
        }

        // =============================
        // HITUNG PINJAMAN & ANGSURAN
        // =============================
        $jumlahPinjaman   = $hargaUnit - $dp;
        $bungaTotal       = $jumlahPinjaman * ($bunga / 100);
        $totalPinjaman    = $jumlahPinjaman + $bungaTotal;
        $estimasiAngsuran = $totalPinjaman / ($tenor * 12);

        // =============================
        // SIMPAN DATA KPR
        // =============================
        $kprApplication = KprApplication::create([
            'booking_id'        => $request->booking_id,
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
            'status'            => 'dokumen',
            'submitted_at'      => now(),
        ]);

        // =============================
        // UPDATE BOOKING
        // =============================
        $booking = Booking::where('id', $request->booking_id)
            ->where('unit_id', $request->unit_id)
            ->firstOrFail();

        $booking->purchase_type = 'kpr';
        $booking->status_cash   = 'pending';
        $booking->status_akad   = 'pending';
        $booking->status_legal  = 'pending';
        $booking->status        = 'lanjut_kpr';

        $booking->save();

        // =============================
        // UPLOAD FILE DOKUMEN
        // =============================
        $fileFields = [
            'slip_gaji',
            'rekening_koran',
            'npwp',
            'sku',
            'surat_nikah',
            'ktp_pasangan',
            'kk',
            'ktp'
        ];

        foreach ($fileFields as $field) {
            if ($request->hasFile($field)) {
                $path = $request->file($field)->store('kpr', 'public');

                KprDocument::create([
                    'kpr_application_id' => $kprApplication->id,
                    'type'               => $field,
                    'path'               => $path,
                ]);
            }
        }

        DB::commit();

        return redirect()->back()
            ->with('success', 'Pengajuan KPR berhasil disimpan');

    } catch (\Throwable $e) {

        DB::rollBack();

        Log::error('Gagal simpan KPR', [
            'error' => $e->getMessage()
        ]);

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
