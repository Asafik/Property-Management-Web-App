<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;

class CashController extends Controller
{
    //
    public function index(Booking $booking)
    {
        $booking->load(['customer', 'unit']);

        return view('marketing.cash_pengajuan', compact('booking'));
    }
}
