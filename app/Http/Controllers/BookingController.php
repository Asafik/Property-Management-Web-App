<?php

namespace App\Http\Controllers;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    //
    public function updateNego(Request $request, $id)
{
    // Validasi input
    $request->validate([
        'harga_nego' => 'required|numeric|min:0',
    ]);

    // Ambil booking
    $booking = Booking::findOrFail($id);

    // Konversi input dari string format "435.000.000" ke integer
    $hargaNego = (int) str_replace(['.', ','], '', $request->harga_nego);

    // Update harga nego
    $booking->harga_nego = $hargaNego;
    $booking->save();

    // Optional: simpan log negosiasi di payment atau notes
    // $booking->notes = "Harga nego diperbarui: Rp " . number_format($hargaNego,0,',','.');
    // $booking->save();

    // Flash message
    return redirect()
        ->route('marketing.cash', $booking->id)
        ->with('success', 'Harga negosiasi berhasil diperbarui!');
}
}
