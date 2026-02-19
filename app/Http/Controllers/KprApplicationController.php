<?php

namespace App\Http\Controllers;

use App\Models\KprApplication;

use App\Models\Banks;
use Illuminate\Http\Request;

class KprApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
public function index()
{
    $banks = Banks::where('is_active',1)->get(); // atau Bank::all()

    return view('marketing.pengajuan', compact('banks'));
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
 public function store(Request $request)
{
    $kpr = KprApplication::create([
        'unit_id' => $request->unit_id,
        'customer_id' => $request->customer_id,
        'booking_id' => $request->booking_id,
        'bank_id' => $request->bank_id,
        'sales_id' => $request->sales_id,
        'harga_unit' => str_replace('.', '', $request->harga_unit),
        'dp' => str_replace('.', '', $request->dp),
        'tenor' => $request->tenor,
        'estimasi_cicilan' => str_replace('.', '', $request->estimasi_cicilan),
        'status' => 'pengajuan',
        'submitted_at' => now(),
        'catatan' => $request->catatan
    ]);

    return redirect()->back()->with('success','Pengajuan KPR berhasil dibuat');
}


    /**
     * Display the specified resource.
     */
    public function show(KprApplication $kprApplication)
    {
        //
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
