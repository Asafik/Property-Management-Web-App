<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Akad;
use App\Models\KprApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AkadController extends Controller
{
    public function index(Booking $booking)
    {
        // Validasi: hanya bisa akses jika cash sudah dalam proses atau sudah lunas
        if ($booking->status_cash !== 'process' && $booking->status_cash !== 'done') {
            return redirect()->back()->with('error', 'Booking belum bisa masuk tahap akad.');
        }

        return view('marketing.akad_cash', compact('booking'));
    }
    function generateNoAkad()
    {
        $year = date('Y');
        $prefix = "AKAD/CASH/$year/";

        $lastNumber = Akad::whereYear('created_at', $year)->count() + 1;

        do {
            $noAkad = $prefix . str_pad($lastNumber, 4, '0', STR_PAD_LEFT);
            $exists = Akad::where('no_akad', $noAkad)->exists();
            $lastNumber++;
        } while ($exists);

        return $noAkad;
    }
    public function store(Request $request, Booking $booking)
    {
        try {
            // Log request masuk
            Log::info('Proses store akad', [
                'booking_id' => $booking->id,
                'request' => $request->all()
            ]);

            // Validasi: hanya bisa akad jika cash sudah process atau done
            if (!in_array($booking->status_cash, ['process', 'done'])) {
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

            // Upload dokumen jika ada
            $filePath = null;
            if ($request->hasFile('dokumen')) {
                $filePath = $request->file('dokumen')->store('dokumen_akad', 'public');
                Log::info('Dokumen akad diupload', ['file' => $filePath]);
            }

            // ===== FORM SELESAI =====
            if ($request->filled('tanggal_akad')) {
               $noAkad = $request->no_akad ?? $this->generateNoAkad();

                Akad::create([
                    'booking_id' => $booking->id,
                    'no_akad' => $noAkad,
                    'tanggal_akad' => $request->tanggal_akad,
                    'dokumen' => $filePath,
                    'catatan' => $request->catatan,
                    'status' => 'selesai'
                ]);

                // Update status akad di booking
                $booking->update([
                    'status_akad' => 'done',
                    'status' => 'akad',
                    'akad_date' => now()

                ]);

                Log::info('Akad selesai berhasil diproses', [
                    'booking_id' => $booking->id,
                    'no_akad' => $noAkad
                ]);

                return redirect()->back()->with('success', 'Akad selesai berhasil diproses.');
            }

            // ===== FORM BATAL =====
            if ($request->filled('alasan_batal')) {
                Akad::create([
                    'booking_id' => $booking->id,
                    'no_akad' => null,
                    'tanggal_akad' => null,
                    'dokumen' => $filePath,
                    'catatan' => $request->catatan ?? ($request->alasan_lainnya ?? $request->alasan_batal),
                    'status' => 'batal',
                    'tindakan' => $request->tindakan
                ]);

                // Update status akad di booking
                $booking->update([
                    'status_akad' => 'cancelled'
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
    public function akadKPR($id)
    {
        $kpr = KprApplication::with(['customer', 'unit', 'bank', 'sales', 'documents'])->findOrFail($id);

        return view('marketing.akad_closing', compact('kpr'));
    }
    public function storeKPR(Request $request, Booking $booking)
    {
        try {
            // Log request masuk
            Log::info('Proses store akad', [
                'booking_id' => $booking->id,
                'request' => $request->all()
            ]);

            // Validasi: hanya bisa akad jika cash sudah process atau done
            if (!in_array($booking->status_cash, ['process', 'done'])) {
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

            // Upload dokumen jika ada
            $filePath = null;
            if ($request->hasFile('dokumen')) {
                $filePath = $request->file('dokumen')->store('dokumen_akad', 'public');
                Log::info('Dokumen akad diupload', ['file' => $filePath]);
            }

            // ===== FORM SELESAI =====
            if ($request->filled('tanggal_akad')) {

             $noAkad = $request->no_akad ?? $this->generateNoAkad();

                Akad::create([
                    'booking_id' => $booking->id,
                    'no_akad' => $noAkad,
                    'tanggal_akad' => $request->tanggal_akad,
                    'dokumen' => $filePath,
                    'catatan' => $request->catatan,
                    'status' => 'selesai'
                ]);

                // ✅ Update booking
                $booking->update([
                    'status_akad' => 'done',
                    'status' => 'akad',
                    'akad_date' => now()
                ]);

                // ✅ TAMBAHAN: update KPR
                $kpr = KprApplication::where('booking_id', $booking->id)->first();

                if ($kpr) {
                    $kpr->update([
                        'status' => 'akad' // atau status_kpr kalau nama field beda
                    ]);
                }

                Log::info('Akad selesai berhasil diproses', [
                    'booking_id' => $booking->id,
                    'no_akad' => $noAkad
                ]);

                return redirect()->back()->with('success', 'Akad selesai berhasil diproses.');
            }

            // ===== FORM BATAL =====
            if ($request->filled('alasan_batal')) {
                Akad::create([
                    'booking_id' => $booking->id,
                    'no_akad' => null,
                    'tanggal_akad' => null,
                    'dokumen' => $filePath,
                    'catatan' => $request->catatan ?? ($request->alasan_lainnya ?? $request->alasan_batal),
                    'status' => 'batal',
                    'tindakan' => $request->tindakan
                ]);

                // Update status akad di booking
                $booking->update([
                    'status_akad' => 'cancelled'
                ]);

                Log::info('Akad dibatalkan', [
                    'booking_id' => $booking->id,
                    'alasan' => $request->alasan_batal,
                    'tindakan' => $request->tindakan
                ]);

                return redirect()->back()->with('success', 'Akad dibatalkan dan tindakan berhasil diproses.');
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
