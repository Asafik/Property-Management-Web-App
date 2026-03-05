<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\LandBank;
use App\Models\Payment;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProperty = LandBank::count();
        $totalCustomer = Customer::count();
        $totalPayments = Payment::count();
        $totalUnit = \App\Models\LandBankUnit::count();

        $landBank = LandBank::with([
            'companyProfile',
            'units.activeBooking.customer', // Booking terakhir + customer
            'units.progress',               // Progress pembangunan
        ])->get()->map(function($lb) {

            // Tambahkan array unit lengkap dengan progress dan booking
            $lb->units_detail = $lb->units->map(function($unit) {
    return [
        'type' => $unit->type ?? $unit->type ?? '-',
        'unit_code' => $unit->unit_code ?? $unit->unit_code ?? '-',
        'unit_name' => $unit->unit_name ?? $unit->unit_number ?? '-',
        'construction_progress'  => $unit->construction_progress ? [
            'stage'      => $unit->progress->stage ?? '-',
            'percentage' => $unit->progress->percentage ?? 0,
        ] : null,
        'booking'   => $unit->activeBooking ? [
            'customer_name' => optional($unit->activeBooking->customer)->full_name ?? 'Customer',
            'status'        => $unit->activeBooking->status ?? '-',
        ] : null,
    ];
});

return $lb;
        });

        return view('dashboard', compact(
            'totalProperty',
            'totalCustomer',
            'totalPayments',
            'totalUnit',
            'landBank'
        ));
    }
}