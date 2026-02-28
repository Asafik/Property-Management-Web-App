<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Promo;

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

 public function show($id)
{
    $booking = Booking::with([
        'customer',
        'unit',
        'sales',
        'kprApplication.bank',
        'payments'
    ])->findOrFail($id);

    $unit = $booking->unit;

    // Ambil promo aktif & masih berlaku
    $promos = Promo::where('status', 'aktif')
        ->where(function ($q) {
            $q->where('validity_period', 'selalu')
              ->orWhere(function ($q2) {
                  $q2->where('validity_period', 'periode')
                     ->whereDate('start_date', '<=', now())
                     ->whereDate('end_date', '>=', now());
              });
        })
        ->get();

    return view('marketing.cash', compact('booking', 'unit', 'promos'));
}
}