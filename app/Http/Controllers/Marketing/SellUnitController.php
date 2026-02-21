<?php

namespace App\Http\Controllers\Marketing;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\LandBankUnit; // pastikan model sudah ada
use App\Models\LandBank;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\Booking;
use Illuminate\Support\Facades\Log;
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
    $agencies = Employee::where('role', 'agency')
      ->latest()
      ->get();

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
  
  // public function setCustomer(Request $request, $unitId)
  // {
  //   $unit = LandBankUnit::findOrFail($unitId);

  //   $unit->customer_id = $request->customer_id;
  //   $unit->status = 'booked'; // atau Sold
  //   $unit->save();

  //   return back()->with('success', 'Customer berhasil dipasang ke unit');
  // }
 
public function setCustomer(Request $request, $unitId)
{
    $request->validate([
        'customer_id'   => 'required|exists:customers,id',
        'purchase_type' => 'required|in:cash,kpr',
        'booking_fee'   => 'required'
    ]);

    $unit = LandBankUnit::findOrFail($unitId);

    // Bersihkan format rupiah (hapus titik)
    $bookingFee = str_replace('.', '', $request->booking_fee);

    // Generate booking code
    $bookingCode = 'BOOK-' . date('Ymd') . '-' . strtoupper(Str::random(4));

    Booking::create([
        'booking_code'  => $bookingCode,
        'unit_id'       => $unit->id,
        'customer_id'   => $request->customer_id,
        'booking_date'  => now(),
        'purchase_type' => $request->purchase_type,
        'booking_fee'   => $bookingFee,
        'status'        => 'active',
    ]);

    // Update status unit
    $unit->status = 'booked';
    $unit->save();

    return back()->with('success', 'Booking berhasil dibuat & customer terpasang');
}
  // public function setAgency(Request $request, $unitId)
  // {
  //   $unit = LandBankUnit::findOrFail($unitId);

  //   $unit->employee_id = $request->employee_id;
  //   $unit->save();

  //   return back()->with('success', 'Agency berhasil dipasang ke unit');
  // }
public function setAgency(Request $request, $unitId)
{
    Log::info('=== UPDATE SALES BOOKING START ===');
    Log::info('Unit ID: ' . $unitId);
    Log::info('Request Data:', $request->all());

    try {

        $validated = $request->validate([
            'sales_id' => 'required|exists:employees,id',
        ]);

        $unit = LandBankUnit::findOrFail($unitId);

        // Ambil booking aktif berdasarkan unit
        $booking = Booking::where('unit_id', $unit->id)
                            ->where('status', 'active')
                            ->first();

        if (!$booking) {
            Log::warning('Booking tidak ditemukan');
            return back()->with('error', 'Booking belum dibuat');
        }

        $booking->sales_id = $request->sales_id;
        $booking->save();

        Log::info('Sales berhasil diupdate');

        return back()->with('success','Sales berhasil diupdate');

    } catch (\Illuminate\Validation\ValidationException $e) {

        Log::error('VALIDATION ERROR', $e->errors());
        return back()->withErrors($e->errors())->withInput();

    } catch (\Exception $e) {

        Log::error('GENERAL ERROR: ' . $e->getMessage());
        return back()->with('error','Terjadi kesalahan sistem');
    }
}

}
