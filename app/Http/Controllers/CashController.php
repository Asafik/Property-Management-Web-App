<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\CashTempo;
use App\Models\CashTempoInstallment;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CashController extends Controller
{
    //
    public function index(Booking $booking)
    {
        $booking->load([
            'customer.documents',
            'unit'
        ]);

        return view('marketing.cash_pengajuan', compact('booking'));
    }
   public function store(Request $request)
{
    Log::info('Cash Tempo Request Masuk', $request->all());

    $request->validate([
        'booking_id' => 'required|exists:bookings,id',
        'harga_unit' => 'required|numeric',
        'diskon' => 'nullable|numeric',
        'booking_fee' => 'required|numeric',
        'dp' => 'required|numeric',
        'tenor_bulan' => 'required|integer',
        'tanggal_mulai_angsuran' => 'required|date',
        'denda_persen' => 'required|numeric',
        'metode_pembayaran' => 'required|string'
    ], [
        'metode_pembayaran.required' => 'Metode pembayaran wajib dipilih',
    ]);

    DB::beginTransaction();

    try {

        Log::info('Mulai proses cash tempo');

        // CAST ANGKA
        $hargaUnit   = (float) $request->harga_unit;
        $diskon      = (float) ($request->diskon ?? 0);
        $bookingFee  = (float) $request->booking_fee;
        $dp          = (float) $request->dp;
        $tenor       = (int) $request->tenor_bulan;

        $hargaSetelahDiskon = $hargaUnit - $diskon;

        Log::info('Perhitungan harga', [
            'harga_unit' => $hargaUnit,
            'diskon' => $diskon,
            'harga_setelah_diskon' => $hargaSetelahDiskon
        ]);

        // VALIDASI DP MINIMAL 20%
        $minimalDP = $hargaSetelahDiskon * 0.20;

        if ($dp < $minimalDP) {

            $minimalDpFormat = 'Rp ' . number_format($minimalDP, 0, ',', '.');

            return back()->with('error', 'DP minimal 20% dari harga unit yaitu ' . $minimalDpFormat);
        }

        // HITUNG SISA PEMBAYARAN
        $sisaPembayaran = $hargaSetelahDiskon - $dp;

        // HITUNG ANGSURAN
        $angsuranPerBulan = round($sisaPembayaran / $tenor);

        Log::info('Perhitungan angsuran', [
            'sisa_pembayaran' => $sisaPembayaran,
            'tenor' => $tenor,
            'angsuran_per_bulan' => $angsuranPerBulan
        ]);

        $tanggalMulai = Carbon::parse($request->tanggal_mulai_angsuran);
        $tanggalAkhir = $tanggalMulai->copy()->addMonths($tenor);

        // SIMPAN CASH TEMPO
        $cashTempo = CashTempo::create([
            'booking_id' => $request->booking_id,
            'harga_unit' => $hargaUnit,
            'diskon' => $diskon,
            'booking_fee' => $bookingFee,
            'dp' => $dp,
            'sisa_pembayaran' => $sisaPembayaran,
            'tenor_bulan' => $tenor,
            'tanggal_mulai_angsuran' => $tanggalMulai,
            'tanggal_jatuh_tempo_akhir' => $tanggalAkhir,
            'denda_persen' => $request->denda_persen,
            'metode_pembayaran' => $request->metode_pembayaran,
            'status' => 'process'
        ]);

        Log::info('Cash tempo berhasil dibuat', [
            'cash_tempo_id' => $cashTempo->id
        ]);

        // GENERATE ANGSURAN
        $sisaPokok = $sisaPembayaran;

        for ($i = 1; $i <= $tenor; $i++) {

            $jatuhTempo = $tanggalMulai->copy()->addMonths($i - 1);

            // ANGSURAN TERAKHIR DISESUAIKAN
            if ($i == $tenor) {
                $angsuran = $sisaPokok;
            } else {
                $angsuran = $angsuranPerBulan;
            }

            $sisaPokok -= $angsuran;

            $installment = CashTempoInstallment::create([
                'cash_tempo_id' => $cashTempo->id,
                'bulan_ke' => $i,
                'jatuh_tempo' => $jatuhTempo,
                'nominal_angsuran' => $angsuran,
                'sisa_pokok' => max($sisaPokok, 0),
                'status' => 'pending'
            ]);

            Log::info('Angsuran dibuat', [
                'bulan_ke' => $i,
                'jatuh_tempo' => $jatuhTempo->toDateString(),
                'nominal' => $angsuran,
                'sisa_pokok' => $sisaPokok
            ]);
        }

        // UPDATE BOOKING
        Booking::where('id', $request->booking_id)->update([
            'status_cash' => 'process',
            'booking_fee' => $bookingFee
        ]);

        Log::info('Booking berhasil diperbarui', [
            'booking_id' => $request->booking_id,
            'status_cash' => 'process',
            'booking_fee' => $bookingFee
        ]);

        DB::commit();

        Log::info('Transaksi cash tempo selesai');

        return redirect()->back()->with('success', 'Cash tempo berhasil dibuat');

    } catch (\Exception $e) {

        DB::rollback();

        Log::error('Error cash tempo', [
            'message' => $e->getMessage(),
            'line' => $e->getLine(),
            'file' => $e->getFile()
        ]);

        return back()->with('error', 'Terjadi kesalahan sistem');
    }
}
}
