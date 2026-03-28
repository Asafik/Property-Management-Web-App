<?php

namespace App\Http\Controllers;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BookingController extends Controller
{
    //
public function updateNego(Request $request, $id)
{
    try {
    
        $cleanHarga = str_replace(['.', ','], '', $request->harga_nego);

            $request->merge([
            'harga_nego' => $cleanHarga
        ]);


        $request->validate([
            'harga_nego' => 'required|numeric|min:0',
        ]);

        // Ambil booking
        $booking = Booking::findOrFail($id);

        // Log sebelum update
        Log::info('Update nego dimulai', [
            'booking_id' => $id,
            'harga_input_raw' => $request->harga_nego,
            'user_id' => auth()->id(),
            'ip' => request()->ip()
        ]);

        // Simpan ke database
        $booking->harga_nego = (int) $request->harga_nego;
        $booking->status_cash = 'process';
        $booking->save();

        // Log setelah berhasil
        Log::info('Update nego berhasil', [
            'booking_id' => $booking->id,
            'harga_nego' => $booking->harga_nego,
            'status_cash' => $booking->status_cash
        ]);

        return redirect()
            ->route('marketing.cash', $booking->id)
            ->with('success', 'Harga negosiasi berhasil diperbarui dan status cash diupdate!');

    } catch (\Exception $e) {

        // Log error jika gagal
        Log::error('Update nego gagal', [
            'booking_id' => $id,
            'error' => $e->getMessage(),
            'input' => $request->all()
        ]);

        return redirect()->back()->with('error', 'Terjadi kesalahan saat update!');
    }
}
}
