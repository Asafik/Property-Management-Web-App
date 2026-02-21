<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;

class ListPengajuanController extends Controller
{
    public function index()
    {
        // Total booking dengan status pengajuan (atau active kalau pakai itu)
        $totalPengajuan = Booking::where('status', 'active')->count();

        // Ambil semua booking + relasi
        $bookings = Booking::with([
            'customer',
            'unit',
            'sales'
        ])->latest()->get();

        return view('marketing.list_pengajuan', compact(
            'totalPengajuan',
            'bookings'
        ));
    }
}