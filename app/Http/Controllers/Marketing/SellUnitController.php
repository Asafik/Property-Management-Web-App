<?php

namespace App\Http\Controllers\Marketing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LandBankUnit; // pastikan model sudah ada
use App\Models\LandBank;
use App\Models\Customer;
use App\Models\Employee;

class SellUnitController extends Controller
{
  public function index()
{
    // Ambil semua unit beserta relasi landBank
    $units = LandBankUnit::with('landBank')->get();

    // Hitung total unit
    $totalUnits = $units->count();
    $totalTersedia = $units->where('status', 'ready')->count();
    $totalBooking = $units->where('status', 'booked')->count();
    $totalSold = $units->where('status', 'sold')->count();    
    // Hitung total luas semua unit
    $totalArea = $units->sum('area');

    // Hitung sisa luas tanah per unit (jika diperlukan)
    // Contoh: total luas dari semua tanah
    $totalLandArea = LandBank::sum('area');
    $sisaLuas = max(0, $totalLandArea - $totalArea);

    // Hitung total nilai unit
    $totalNilai = $units->sum('price');
  $customers = Customer::latest()->get();
  $agencies = Employee::latest()->get();
    return view('marketing.jual_unit', compact(
        'units',
        'totalUnits',
        'totalArea',
        'sisaLuas',
        'totalNilai',
        'totalTersedia',
        'totalBooking',
        'totalSold',
        'customers',
        'agencies'
    ));
}
public function setCustomer(Request $request, $unitId)
{
    $unit = LandBankUnit::findOrFail($unitId);

    $unit->customer_id = $request->customer_id;
    $unit->status = 'booked'; // atau Sold
    $unit->save();

    return back()->with('success','Customer berhasil dipasang ke unit');
}


}
