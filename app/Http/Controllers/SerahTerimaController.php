<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\SerahTerima;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SerahTerimaController extends Controller
{
    /**
     * Menampilkan halaman form serah terima
     */
    public function index($id)
    {
        $booking = Booking::with(['customer', 'unit'])->findOrFail($id);
        $item = $booking->unit;

        return view('serah.serah-terima', compact('booking', 'item'));
    }

    /**
     * Memproses penyimpanan data serah terima
     */
    public function store(Request $request, Booking $booking)
    {
        $request->validate([
            'tanggal_serah_terima' => 'required|date',
            'lokasi_serah_terima' => 'required',
            'persetujuan' => 'required',
        ]);

        DB::beginTransaction();

        try {
            Log::info('Proses serah terima dimulai', [
                'booking_id' => $booking->id,
                'user_id' => auth()->id()
            ]);

            // =========================
            // UPLOAD FOTO
            // =========================
            $foto1 = $request->file('foto_serah_kunci')
                ?->store('serah_terima', 'public');

            $foto2 = $request->file('foto_kondisi_unit')
                ?->store('serah_terima', 'public');

            // =========================
            // GENERATE NO BAST
            // =========================
            $noBast = 'BAST/' . date('m/Y') . '/' . str_pad(
                SerahTerima::count() + 1,
                3,
                '0',
                STR_PAD_LEFT
            );

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
                'saksi' => $request->saksi,
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
            }

            // =========================
            // DOKUMEN
            // =========================
            if ($request->documents) {
                foreach ($request->documents as $doc) {
                    $serah->documents()->create([
                        'document_name' => $doc['name'],
                        'is_submitted' => isset($doc['submitted']) ? 1 : 0,
                        'status' => isset($doc['submitted']) ? 'Sudah' : 'Proses',
                    ]);
                }
            }

            // =========================
            // UPDATE STATUS
            // =========================
            $booking->update([
                'status' => 'completed',
                'serah_terima_date' => $request->tanggal_serah_terima
            ]);

            if ($booking->unit) {
                $booking->unit->update([
                    'status' => 'sold'
                ]);
            }

            DB::commit();

            Log::info('Proses serah terima berhasil', [
                'booking_id' => $booking->id,
                'no_bast' => $noBast
            ]);

            return redirect()->route('unit.selesai', ['bookingId' => $booking->id])
                ->with('success', 'Serah terima berhasil diproses.');
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Gagal proses serah terima', [
                'error_message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);

            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Halaman sukses
     */
    public function SellDone($bookingId)
    {
        $booking = Booking::with([
            'unit',
            'unit.landBank',
            'customer',
            'sales',
            'serahTerima'
        ])->findOrFail($bookingId);

        $unit = $booking->unit;

        return view('marketing.done_sell', compact('booking', 'unit'));
    }
}
