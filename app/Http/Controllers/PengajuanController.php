<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PengajuanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('marketing.pengajuan', [
            'pengajuans' => Pengajuan::with(['customer', 'unit', 'marketing'])->get()
        ]);
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
    try {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'unit_id' => 'required|exists:land_bank_units,id',
            'marketing_id' => 'required|exists:employees,id',
            'payment_method' => 'required|in:cash_full,cash_tempo,kpr',
            'unit_price' => 'required|numeric',
            'down_payment' => 'nullable|numeric',
            'installment_duration' => 'nullable|integer',
            'monthly_installment' => 'nullable|numeric',
        ]);

        // Bersihkan format angka jika ada titik
        $validated['unit_price'] = str_replace('.', '', $validated['unit_price']);
        $validated['down_payment'] = str_replace('.', '', $validated['down_payment'] ?? 0);
        $validated['monthly_installment'] = str_replace('.', '', $validated['monthly_installment'] ?? 0);

        // Simpan ke database
        $pengajuan = \App\Models\Pengajuan::create($validated);

        return redirect()->route('pengajuans.index')->with('success', 'Pengajuan berhasil disubmit.');
    } catch (\Exception $e) {
        Log::error('Error saat menyimpan pengajuan', [
            'message' => $e->getMessage(),
            'line' => $e->getLine(),
            'file' => $e->getFile()
        ]);
        return back()->with('error', 'Terjadi kesalahan saat menyimpan data.');
    }
}



    /**
     * Display the specified resource.
     */
    public function show(Pengajuan $pengajuan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pengajuan $pengajuan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pengajuan $pengajuan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pengajuan $pengajuan)
    {
        //
    }
}
