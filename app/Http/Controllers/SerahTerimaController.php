<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;

class SerahTerimaController extends Controller
{
    //
public function index($id)
{
    // Ambil semua booking, bisa diubah sesuai kebutuhan (misal pagination)
   $booking = Booking::with('customer', 'unit')->find($id); // ambil 1 booking
return view('serah.serah-terima', compact('booking'));
}
}
