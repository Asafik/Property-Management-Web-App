<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\LandBank;
use App\Models\Payment;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function index(){
        $totalProperty = LandBank::count();
        $totalCustomer = Customer::count();
        $totalPayments = Payment::count();

        $landBank = LandBank::all();
        return view('dashboard', compact('totalProperty', 'totalCustomer','totalPayments', 'landBank'));
    }
}
