<?php

namespace App\Http\Controllers;

use App\Models\CashTempo;
use App\Models\CashTempoInstallment;
use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Http\Request;

class TimelineCashTempoController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        $perPage = $request->get('per_page', 10);
        $sort = $request->get('sort', 'latest');

        if (!in_array($perPage, [10, 15, 25])) {
            $perPage = 10;
        }

        $query = CashTempo::with([
            'booking.customer',
            'booking.unit',
            'installments'
        ]);

        if (!empty($search)) {
            $query->whereHas('booking.customer', function ($q) use ($search) {
                $q->where('full_name', 'like', '%' . $search . '%');
            });
        }

        switch ($sort) {
            case 'name_asc':
                $query->join('bookings', 'cash_tempos.booking_id', '=', 'bookings.id')
                    ->join('customers', 'bookings.customer_id', '=', 'customers.id')
                    ->orderBy('customers.full_name', 'asc')
                    ->select('cash_tempos.*');
                break;

            case 'name_desc':
                $query->join('bookings', 'cash_tempos.booking_id', '=', 'bookings.id')
                    ->join('customers', 'bookings.customer_id', '=', 'customers.id')
                    ->orderBy('customers.full_name', 'desc')
                    ->select('cash_tempos.*');
                break;

            case 'tenor_asc':
                $query->orderBy('tenor_bulan', 'asc');
                break;

            case 'tenor_desc':
                $query->orderBy('tenor_bulan', 'desc');
                break;

            default:
                $query->latest();
                break;
        }

        $tenors = $query->paginate($perPage)->withQueryString();

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
        CashTempo::where('id', $request->id)->update([
            'tenor_bulan' => $request->tenor_bulan,
            'denda_persen' => $request->denda_persen,
            'metode_pembayaran' => $request->metode_pembayaran
        ]);

        return back()->with('success', 'Data berhasil diupdate');
    }

    public function storePayment(Request $request)
    {
        $request->validate([
            'installment_id' => 'required|exists:cash_tempo_installments,id',
            'bukti_pembayaran' => 'required|file|mimes:jpg,png,pdf|max:2048',
        ]);

        $installment = CashTempoInstallment::findOrFail($request->installment_id);

        if ($request->hasFile('bukti_pembayaran')) {
            $file = $request->file('bukti_pembayaran');
            $path = $file->store('bukti_pembayaran', 'public');
            $installment->bukti_pembayaran = $path;
        }

        $installment->status = 'paid';
        $installment->tanggal_bayar = now();
        $installment->save();

        $tenor = CashTempo::find($installment->cash_tempo_id);

        $unpaid = CashTempoInstallment::where('cash_tempo_id', $tenor->id)
            ->where('status', '!=', 'paid')
            ->count();

        if ($unpaid == 0) {
            $tenor->status = 'lunas';
            $tenor->save();

            $booking = Booking::find($tenor->booking_id);

            if ($booking) {
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
