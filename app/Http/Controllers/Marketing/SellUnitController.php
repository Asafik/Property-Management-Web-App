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
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UnitsExport;
use Barryvdh\DomPDF\Facade\Pdf;
class SellUnitController extends Controller
{
public function index(Request $request)
{
    // Ambil query dulu (belum get)
   $query = LandBankUnit::with([
        'landBank',
        'activeBooking.sales',
        'activeBooking.customer'
    ]);

    // =========================
    // FILTER SECTION
    // =========================

    // Search (blok / nama lokasi dll)
    if ($request->filled('search')) {
        $query->where(function ($q) use ($request) {
            $q->where('block', 'like', '%' . $request->search . '%')
              ->orWhere('unit_number', 'like', '%' . $request->search . '%');
        });
    }

    // Filter Project (dari relasi landBank)
    if ($request->filled('project')) {
        $query->whereHas('landBank', function ($q) use ($request) {
            $q->where('name', $request->project);
        });
    }

    // Filter Status
    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }
    if ($request->filled('type')) {
    $query->where('type', $request->type);
}

    // Filter Harga
    if ($request->filled('price')) {
        if ($request->price == '<500') {
            $query->where('price', '<', 500000000);
        } elseif ($request->price == '500-1000') {
            $query->whereBetween('price', [500000000, 1000000000]);
        } elseif ($request->price == '>1000') {
            $query->where('price', '>', 1000000000);
        }
    }

    // =========================
    // AMBIL DATA
    // =========================

   $units = $query->paginate(10)->withQueryString();

    // =========================
    // SEMUA LOGIC LAMA TETAP
    // =========================

    $totalUnits = $units->count();
    $totalTersedia = $units->where('status', 'ready')->count();
    $totalBooking = $units->where('status', 'booked')->count();
    $totalSold = $units->where('status', 'sold')->count();

    $totalArea = $units->sum('area');

    $totalLandArea = LandBank::sum('area');
    $sisaLuas = max(0, $totalLandArea - $totalArea);

    $totalNilai = $units->sum('price');
    $projects = LandBank::select('id','name')->orderBy('name')->get();
    $customers = Customer::latest()->get();
    $agencies = Employee::where('role', 'agency')
        ->latest()
        ->get();
    $types = LandBankUnit::select('type')
            ->distinct()
            ->pluck('type');
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
        'agencies',
        'projects',
        'types'
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
        'booking_fee'   => 'required',
        
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
            'sales_id'  => 'required|exists:employees,id',
            'agent_fee' => 'required'
        ]);

        $unit = LandBankUnit::findOrFail($unitId);

        $booking = Booking::where('unit_id', $unit->id)
                          ->where('status', 'active')
                          ->first();

        if (!$booking) {
            Log::warning('Booking tidak ditemukan');
            return back()->with('error', 'Booking untuk unit ini belum dibuat. Silakan buat booking terlebih dahulu.');
        }

        // Bersihkan format rupiah
        $agentFee = str_replace(['.', ','], '', $request->agent_fee);

        $booking->update([
            'sales_id'  => $request->sales_id,
            'agent_fee' => $agentFee
        ]);

        Log::info('Sales & Agent Fee berhasil diupdate');

        return back()->with('success','Sales & Agent Fee berhasil diupdate');

    } catch (\Illuminate\Validation\ValidationException $e) {

        Log::error('VALIDATION ERROR', $e->errors());
        return back()->withErrors($e->errors())->withInput();

    } catch (\Exception $e) {

        Log::error('GENERAL ERROR: ' . $e->getMessage());
       return back()->with('error', 'Booking untuk unit ini belum dibuat. Silakan buat booking terlebih dahulu.');
    }
}
public function exportExcel()
{
    return Excel::download(new UnitsExport, 'data-unit.xlsx');
}
public function exportPdf()
{
    $units = LandBankUnit::with('landBank')->get();

    $pdf = Pdf::loadView('exports.units_pdf', compact('units'));

    return $pdf->download('data-unit.pdf');
}
// public function exportPdf()
// {
//     $units = LandBankUnit::with('landBank')->get();
//     return view('exports.units_pdf', compact('units'));
// }
}
