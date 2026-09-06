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
        // UPLOAD FILE (STANDAR & DINAMIS)
        // =============================
        $fileFields = [
            'ktp'            => 'KTP Pemohon',
            'kk'             => 'Kartu Keluarga (KK)',
            'npwp'           => 'NPWP Pemohon',
            'slip_gaji'      => 'Slip Gaji 3 Bulan',
            'rekening_koran' => 'Rekening Koran',
            'sku'            => 'SKU / Surat Keterangan Kerja',
            'surat_nikah'    => 'Buku / Surat Nikah',
            'ktp_pasangan'   => 'KTP Pasangan',
        ];

        $docMap = [
            'ktp'          => 'KTP',
            'kk'           => 'Kartu Keluarga',
            'npwp'         => 'NPWP',
            'ktp_pasangan' => 'KTP Pasangan'
        ];

        $destination = $_SERVER['DOCUMENT_ROOT'] . '/uploads/kpr';
        if (!file_exists($destination)) {
            mkdir($destination, 0755, true);
        }

        // 1. Dokumen Standar
        foreach ($fileFields as $field => $label) {
            if ($request->hasFile($field)) {
                $file = $request->file($field);
                $filename = uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move($destination, $filename);
                $path = 'kpr/' . $filename;

                KprDocument::create([
                    'kpr_application_id' => $kprApplication->id,
                    'type'               => $field,
                    'document_name'      => $label,
                    'path'               => $path,
                    'status'             => 'pending',
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
                        'document_name'      => $label,
                        'path'               => $customerDoc->file,
                        'status'             => 'pending',
                    ]);
                }
            }
        }

        // 2. Dokumen Tambahan Dinamis
        if ($request->has('additional_documents') && is_array($request->additional_documents)) {
            foreach ($request->additional_documents as $idx => $docData) {
                if (isset($docData['file']) && $request->hasFile("additional_documents.{$idx}.file")) {
                    $docFile = $request->file("additional_documents.{$idx}.file");
                    $docName = !empty($docData['name']) ? trim($docData['name']) : 'Dokumen Pendukung ' . ($idx + 1);
                    $docSlug = \Illuminate\Support\Str::slug($docName, '_');
                    $filename = uniqid() . '_' . $docSlug . '.' . $docFile->getClientOriginalExtension();

                    $docFile->move($destination, $filename);
                    $path = 'kpr/' . $filename;

                    KprDocument::create([
                        'kpr_application_id' => $kprApplication->id,
                        'type'               => 'custom_' . $docSlug,
                        'document_name'      => $docName,
                        'path'               => $path,
                        'status'             => 'pending',
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
        $application = KprApplication::with([
            'customer',
            'unit.activeBooking.sales',
            'bank',
            'booking.sales'
        ])->findOrFail($id);

        $noBast = 'BAST/' . date('m/Y') . '/' . str_pad(
            \App\Models\SerahTerima::count() + 1,
            3,
            '0',
            STR_PAD_LEFT
        );

        return view('serah.serah-terima-kpr', [
            'application' => $application,
            'booking' => $application->booking,
            'noBast' => $noBast
        ]);
    }
public function pecahLegal($id)
{
    $application = KprApplication::findOrFail($id);
    return redirect()->route('kpr.approve', $application->booking_id ?? $application->id);
}
}
