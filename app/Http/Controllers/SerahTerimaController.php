<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Serah_Terima;
use App\Models\SerahTerima;
use App\Models\LandBankUnit;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SerahTerimaController extends Controller
{
    //
    public function index($id)
    {
        // Ambil semua booking, bisa diubah sesuai kebutuhan (misal pagination)
        $booking = Booking::with('customer', 'unit')->find($id); // ambil 1 booking
        $item = $booking->unit; // Ini instance LandBankUnit

        return view('serah.serah-terima', compact('booking', 'item'));
    }


    public function store(Request $request, Booking $booking)
    {
        $request->validate([
            'tanggal_serah_terima' => 'required|date',
            'lokasi_serah_terima' => 'required',
        ]);

        DB::beginTransaction();

        try {

            Log::info('Proses serah terima dimulai', [
                'booking_id' => $booking->id,
                'user_id' => auth()->id()
            ]);

            // =========================
            // 🔥 UPLOAD FOTO (FIX FINAL)
            // =========================

            $uploadFile = function ($file, $prefix) {
                if (!$file) return null;

                $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $cleanName    = preg_replace('/[^A-Za-z0-9\-]/', '_', $originalName);
                $extension    = $file->getClientOriginalExtension();

                $filename = time() . '_' . $prefix . '_' . $cleanName . '.' . $extension;

                $destination = $_SERVER['DOCUMENT_ROOT'] . '/uploads/serah_terima';

                if (!file_exists($destination)) {
                    mkdir($destination, 0755, true);
                }

                $file->move($destination, $filename);

                return 'serah_terima/' . $filename;
            };

            $foto1 = $uploadFile($request->file('foto_serah_kunci'), 'kunci');
            $foto2 = $uploadFile($request->file('foto_kondisi_unit'), 'unit');

            Log::info('Upload foto selesai', [
                'foto_serah_kunci' => $foto1,
                'foto_kondisi_unit' => $foto2,
            ]);

            // =========================
            // GENERATE NO BAST
            // =========================

            $noBast = 'BAST/' . date('m/Y') . '/' . str_pad(
                SerahTerima::count() + 1,
                3,
                '0',
                STR_PAD_LEFT
            );

            Log::info('Nomor BAST digenerate', [
                'no_bast' => $noBast
            ]);

            // =========================
            // SIMPAN SERAH TERIMA
            // =========================

            $serah = SerahTerima::create([
                'booking_id' => $booking->id,
                'no_bast' => $noBast,
                'tanggal_serah_terima' => $request->tanggal_serah_terima,
                'lokasi_serah_terima' => $request->lokasi_serah_terima,
                'catatan' => $request->catatan,
                'foto_serah_kunci' => $foto1,
                'foto_kondisi_unit' => $foto2,
            ]);

            Log::info('Data serah terima tersimpan', [
                'serah_terima_id' => $serah->id
            ]);

            // =========================
            // CHECKLIST ITEMS
            // =========================

            if ($request->items) {
                foreach ($request->items as $item) {
                    $serah->items()->create([
                        'item_name' => $item['name'],
                        'is_checked' => isset($item['checked']) ? 1 : 0,
                        'status' => isset($item['checked']) ? 'OK' : 'Perlu Perbaikan',
                    ]);
                }

                Log::info('Checklist items tersimpan', [
                    'total_items' => count($request->items)
                ]);
            }

            // =========================
            // DOKUMEN (TANPA FILE)
            // =========================

            if ($request->documents) {
                foreach ($request->documents as $doc) {
                    $serah->documents()->create([
                        'document_name' => $doc['name'],
                        'is_submitted' => isset($doc['submitted']) ? 1 : 0,
                        'status' => isset($doc['submitted']) ? 'Sudah' : 'Proses',
                    ]);
                }

                Log::info('Dokumen tersimpan', [
                    'total_documents' => count($request->documents)
                ]);
            }

            // =========================
            // UPDATE STATUS
            // =========================

            $booking->update([
                'status' => 'completed',
                'serah_terima_date' => now()
            ]);

            if ($booking->unit) {
                $booking->unit->update([
                    'status' => 'sold'
                ]);
            }

            Log::info('Status booking diupdate ke completed', [
                'booking_id' => $booking->id
            ]);

            DB::commit();

            Log::info('Proses serah terima berhasil', [
                'booking_id' => $booking->id,
                'no_bast' => $noBast
            ]);

            return redirect()->route('unit.selesai')
                ->with('success', 'Serah terima berhasil diproses.');
        } catch (\Exception $e) {

            DB::rollBack();

            Log::error('Gagal proses serah terima', [
                'booking_id' => $booking->id ?? null,
                'error_message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);

            return back()->with('error', 'Terjadi kesalahan saat proses serah terima.');
        }
    }


    public function SellDone($bookingId)
    {
        // Ambil booking beserta unit dan customer
        $booking = Booking::with('unit', 'customer')->find($bookingId);

        if (!$booking) {
            abort(404, 'Booking tidak ditemukan');
        }

        $unit = $booking->unit; // ambil unit terkait

        return view('marketing.done_sell', compact('booking', 'unit'));
    }
}
