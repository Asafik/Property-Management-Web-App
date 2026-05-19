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
use App\Models\Promo;
class KprApplicationController extends Controller
{
  
    public function show(Booking $booking)
{
    // load relasi customer + unit
    $booking->load(['customer.documents', 'unit']);

    // Map customer documents for easy lookup in the view
    $existingCustomerDocs = [];
    if ($booking->customer && $booking->customer->documents) {
        foreach ($booking->customer->documents as $doc) {
            $existingCustomerDocs[$doc->document_name] = $doc->file;
        }
    }

    // ambil daftar bank aktif
    $banks = Banks::where('is_active', 1)->get();
    $promos = Promo::all();
    // tampilkan form KPR untuk booking ini
    return view('marketing.pengajuan', compact('booking', 'banks', 'promos', 'existingCustomerDocs'));
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
            'promo_id'    => 'nullable|exists:promos,id',
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
        // AMBIL PROMO (SNAPSHOT UNTUK AUDIT)
        // =============================
        $promoId    = $request->promo_id;
        $promoValue = 0;
        $promoName  = null;

        if ($promoId) {
            $promo = Promo::find($promoId);
            $promoValue = $promo->value ?? 0;
            $promoName  = $promo->name ?? null;
        }

        // =============================
        // HITUNG PINJAMAN & ANGSURAN
        // =============================
        $hargaSetelahPromo = $hargaUnit - $promoValue;
        $jumlahPinjaman    = $hargaSetelahPromo - $dp;

        if ($jumlahPinjaman < 0) {
            $jumlahPinjaman = 0;
        }

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

           
            'promo_id'          => $promoId,
            'promo_name'        => $promoName,
            'promo_value'       => $promoValue,

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
        // UPLOAD FILE (ROOT - SESUAI PUNYAMU)
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

        $docMap = [
            'ktp' => 'KTP',
            'kk' => 'Kartu Keluarga',
            'npwp' => 'NPWP',
            'ktp_pasangan' => 'KTP Pasangan'
        ];

        foreach ($fileFields as $field) {

            if ($request->hasFile($field)) {

                $file = $request->file($field);
                $filename = uniqid() . '.' . $file->getClientOriginalExtension();

                $destination = $_SERVER['DOCUMENT_ROOT'] . '/uploads/kpr';

                if (!file_exists($destination)) {
                    mkdir($destination, 0755, true);
                }

                $file->move($destination, $filename);

                $path = 'kpr/' . $filename;

                KprDocument::create([
                    'kpr_application_id' => $kprApplication->id,
                    'type'               => $field,
                    'path'               => $path,
                ]);
            } elseif (isset($docMap[$field])) {
                // If not uploaded but exists in customer documents, copy/reference the existing customer document path!
                $customerDoc = \App\Models\CustomerDocument::where('customer_id', $request->customer_id)
                    ->where('document_name', $docMap[$field])
                    ->first();
                
                if ($customerDoc && $customerDoc->file) {
                    KprDocument::create([
                        'kpr_application_id' => $kprApplication->id,
                        'type'               => $field,
                        'path'               => $customerDoc->file,
                    ]);
                }
            }
        }

        DB::commit();

        return redirect()->route('customer.kpr')
            ->with('success', 'Pengajuan KPR berhasil disimpan');

    } catch (\Throwable $e) {

        DB::rollBack();

        Log::error('Gagal simpan KPR', [
            'error' => $e->getMessage()
        ]);

        return redirect()->route('customer.kpr')
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
    public function serahTerima($id)
{
    $application = KprApplication::with(['customer','unit','bank'])->findOrFail($id);

   return view('serah.serah-terima-kpr', [
    'application' => $application,
    'booking' => $application->booking
]);
}
public function pecahLegal($id)
{
    $application = KprApplication::with([
        'customer',
        'unit',
        'bank',
        'documents'
    ])->findOrFail($id);

    return view('pecah_legal.pecah_legal_kpr', compact('application'));
}
}
