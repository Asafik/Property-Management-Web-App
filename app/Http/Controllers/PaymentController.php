<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Booking;
use Illuminate\Support\Facades\Storage;

class PaymentController extends Controller
{
public function store(Request $request)
{
    $request->validate([
        'booking_id' => 'required|exists:bookings,id',
        'type' => 'required|in:booking_fee,dp,cicilan,pelunasan',
        'amount' => 'required|numeric',
        'payment_date' => 'nullable|date',
        'method' => 'nullable|string',
        'notes' => 'nullable|string',
        'reference_number' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
    ]);

    // Simpan payment
    $payment = new Payment();
    $payment->booking_id = $request->booking_id;
    $payment->type = $request->type;
    $payment->amount = str_replace('.', '', $request->amount);
    $payment->payment_date = $request->payment_date;
    $payment->method = $request->method;
    $payment->notes = $request->notes;

    if ($request->hasFile('reference_number')) {
        $path = $request->file('reference_number')->store('bukti_transfer', 'public');
        $payment->reference_number = $path;
    }

    $payment->save();

    // Update status booking menjadi 'completed'
    $booking = \App\Models\Booking::find($request->booking_id);
    if ($booking) {
        $booking->status = 'completed';
        $booking->save();
    }

    return redirect()->back()->with('success', 'Pembayaran berhasil dibuat dan status booking diupdate!');
}
}