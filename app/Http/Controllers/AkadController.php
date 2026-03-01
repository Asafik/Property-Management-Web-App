<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Akad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
class AkadController extends Controller
{
    public function index(Booking $booking)
    {
        // Optional: validasi biar nggak bisa akses kalau belum lunas
        if ($booking->status !== 'cash_process' && $booking->status !== 'akad') {
            return redirect()->back()->with('error', 'Booking belum bisa masuk tahap akad.');
        }

        return view('marketing.akad_cash', compact('booking'));
    }
  public function store(Request $request, Booking $booking)
{
    try {
        // Log request masuk
        Log::info('Proses store akad', [
            'booking_id' => $booking->id,
            'request' => $request->all()
        ]);

        // Validasi status booking
        if ($booking->status !== 'cash_process' && $booking->status !== 'akad') {
            Log::warning('Booking belum lunas', ['booking_id' => $booking->id]);
            return redirect()->back()->with('error', 'Booking belum lunas.');
        }

        // Validasi request
        $request->validate([
            'tanggal_akad' => 'nullable|date',
            'dokumen' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'catatan' => 'nullable|string',
            'no_akad' => 'nullable|string',
            'alasan_batal' => 'nullable|string',
            'alasan_lainnya' => 'nullable|string',
            'tindakan' => 'nullable|string',
            'status_pembayaran' => 'nullable|string'
        ]);

        $filePath = null;
        if ($request->hasFile('dokumen')) {
            $filePath = $request->file('dokumen')->store('dokumen_akad', 'public');
            Log::info('Dokumen akad diupload', ['file' => $filePath]);
        }

        // Jika form Selesai
        if ($request->has('tanggal_akad')) {
            $noAkad = $request->no_akad ?? 'AKD-' . date('Y') . '-' . str_pad(Akad::count() + 1, 4, '0', STR_PAD_LEFT);

            Akad::create([
                'booking_id' => $booking->id,
                'no_akad' => $noAkad,
                'tanggal_akad' => $request->tanggal_akad,
                'dokumen' => $filePath,
                'catatan' => $request->catatan,
                'status' => 'selesai'
            ]);

            $booking->update([
                'status' => 'akad'
            ]);

            Log::info('Akad selesai berhasil diproses', ['booking_id' => $booking->id, 'no_akad' => $noAkad]);

            return redirect()->route('dashboard_cash')->with('success', 'Akad selesai berhasil diproses.');
        }

        // Jika form Batal
        if ($request->has('alasan_batal')) {
            Akad::create([
                'booking_id' => $booking->id,
                'no_akad' => null,
                'tanggal_akad' => null,
                'dokumen' => $filePath,
                'catatan' => $request->catatan ?? ($request->alasan_lainnya ?? $request->alasan_batal),
                'status' => 'batal',
                'tindakan' => $request->tindakan
            ]);

            $booking->update([
                'status' => 'batal'
            ]);

            Log::info('Akad dibatalkan', [
                'booking_id' => $booking->id,
                'alasan' => $request->alasan_batal,
                'tindakan' => $request->tindakan
            ]);

            return redirect()->route('dashboard_cash')->with('success', 'Akad dibatalkan dan tindakan berhasil diproses.');
        }

        Log::warning('Form tidak lengkap atau tidak valid', ['booking_id' => $booking->id]);

        return redirect()->back()->with('error', 'Form tidak lengkap atau tidak valid.');
    } catch (\Exception $e) {
        Log::error('Error saat store akad', [
            'booking_id' => $booking->id,
            'message' => $e->getMessage(),
            'trace' => $e->getTraceAsString()
        ]);

        return redirect()->back()->with('error', 'Terjadi kesalahan saat memproses akad. Silakan coba lagi.');
    }
}
}