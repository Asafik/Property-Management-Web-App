<?php

namespace App\Http\Controllers;

use App\Models\CashTempo;
use App\Models\CashTempoInstallment;
use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Http\Request;

class TimelineCashTempoController extends Controller
{
    //
    public function index(){
       $tenors = CashTempo::with(['booking.customer'])
        ->latest()
        ->get();
        return view('transaksi.timline_pembayaran', compact('tenors'));
    }
public function timeline($id)
{
    $cashTempo = CashTempo::with([
        'installments',
        'booking.customer',
        'booking.unit'
    ])->findOrFail($id);

    return response()->json($cashTempo);
}
public function update(Request $request)
{
    CashTempo::where('id',$request->id)->update([
        'tenor_bulan' => $request->tenor_bulan,
        'denda_persen' => $request->denda_persen,
        'metode_pembayaran' => $request->metode_pembayaran
    ]);

    return back()->with('success','Data berhasil diupdate');
}
public function storePayment(Request $request)
{
    $request->validate([
        'installment_id' => 'required|exists:cash_tempo_installments,id',
        'bukti_pembayaran' => 'required|file|mimes:jpg,png,pdf|max:2048',
    ]);

    $installment = CashTempoInstallment::findOrFail($request->installment_id);

    // Upload bukti pembayaran
    if ($request->hasFile('bukti_pembayaran')) {
        $file = $request->file('bukti_pembayaran');
        $path = $file->store('bukti_pembayaran', 'public');
        $installment->bukti_pembayaran = $path;
    }

    $installment->status = 'paid';
    $installment->tanggal_bayar = now();
    $installment->save();

    // Ambil tenor
    $tenor = CashTempo::find($installment->cash_tempo_id);

    // cek sisa angsuran
    $unpaid = CashTempoInstallment::where('cash_tempo_id', $tenor->id)
        ->where('status', '!=', 'paid')
        ->count();

    if ($unpaid == 0) {

        // update tenor
        $tenor->status = 'lunas';
        $tenor->save();

        $booking = Booking::find($tenor->booking_id);

        if ($booking) {

            // INSERT ke table payments
            Payment::create([
                'booking_id' => $booking->id,
                'type' => 'pelunasan',
                'amount' => $installment->nominal_angsuran,
                'payment_date' => now(),
                'status' => 'paid',
                'method' => 'Transfer Bank',
                'reference_number' => $installment->bukti_pembayaran,
                'notes' => 'Pelunasan Cash Tempo'
            ]);

            // update booking
            $booking->update([
                'status_cash' => 'done',
                'pelunasan_date' => now()
            ]);
        }
    }

    return response()->json([
        'message' => 'Pembayaran berhasil disimpan'
    ]);
}
}
