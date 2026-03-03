<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class TransaksiKPRController extends Controller
{
    //

    public function index(Request $request)
    {
        $query = Booking::with(['customer', 'unit', 'sales'])
            ->where('purchase_type', 'kpr'); // sesuaikan dengan kolom kamu

        // 🔍 Search customer
        if ($request->filled('search')) {
            $search = $request->search;

            $query->whereHas('customer', function ($q) use ($search) {
                $q->where('name', 'like', "%$search%");
            });
        }

        $bookings = $query->latest()->paginate(10);

        return view('transaksi.customer-kpr', compact('bookings'));
    }
    public function approve($id)
    {
        $booking = Booking::with(['customer', 'unit', 'sales','kprApplication'])->findOrFail($id);

        return view('marketing.vertifikasi_kpr', compact('booking'));
    }
}
