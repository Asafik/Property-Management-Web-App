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
use App\Models\Payment;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UnitsExport;
use Barryvdh\DomPDF\Facade\Pdf;
class SellUnitController extends Controller
{
public function index(Request $request)
{
    // =========================
    // BASE QUERY
    // =========================
    $query = LandBankUnit::with([
        'landBank',
        'activeBooking.sales',
        'activeBooking.customer'
    ]);

    // =========================
    // FILTER SECTION
    // =========================

    if ($request->filled('search')) {
        $query->where(function ($q) use ($request) {
            $q->where('block', 'like', '%' . $request->search . '%')
              ->orWhere('unit_number', 'like', '%' . $request->search . '%')
              ->orWhere('unit_code', 'like', '%' . $request->search . '%');
        });
    }

    if ($request->filled('project')) {
        $query->whereHas('landBank', function ($q) use ($request) {
            $q->where('name', $request->project);
        });
    }

    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    if ($request->filled('type')) {
        $query->where('type', $request->type);
    }

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
    // CLONE QUERY UNTUK STATISTIK
    // =========================
    $statsQuery = clone $query;

    // =========================
    // PAGINATION
    // =========================
    $units = $query->paginate(10)->withQueryString();

    // =========================
    // STATISTIK (AKURAT SESUAI FILTER)
    // =========================
    $totalUnits     = $statsQuery->count();
    $totalTersedia  = (clone $statsQuery)->where('status', 'ready')->count();
    $totalBooking   = (clone $statsQuery)->where('status', 'booked')->count();
    $totalSold      = (clone $statsQuery)->where('status', 'sold')->count();
    $totalArea      = $statsQuery->sum('area');
    $totalNilai     = $statsQuery->sum('price');

    $totalLandArea  = LandBank::sum('area');
    $sisaLuas       = max(0, $totalLandArea - $totalArea);

    // =========================
    // DATA UNTUK DENAH (TANPA PAGINATION)
    // =========================
    $unitsForDenah = (clone $statsQuery)->get()
        ->groupBy(fn($item) => $item->landBank->name ?? 'Tanpa Proyek')
        ->map(function ($projectUnits) {
            return $projectUnits->groupBy(function ($unit) {
                return explode('.', $unit->unit_code)[0];
            });
        });

    // =========================
    // DATA SUPPORT
    // =========================
    $projects = LandBank::select('id','name')->orderBy('name')->get();
    $customers = Customer::latest()->get();
    $agencies = Employee::where('role', 'agency')->latest()->get();
    $types = LandBankUnit::select('type')->distinct()->pluck('type');

    // =========================
    // RETURN VIEW
    // =========================
    return view('marketing.jual_unit', compact(
        'units',
        'unitsForDenah',
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
        'bukti_transfer'=> 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
    ]);

    $unit = LandBankUnit::findOrFail($unitId);

    // Bersihkan format rupiah
    $bookingFee = str_replace('.', '', $request->booking_fee);

    // Upload file
    $filePath = $request->file('bukti_transfer')
                        ->store('payments/booking_fee', 'public');

    DB::transaction(function () use ($request, $unit, $bookingFee, $filePath) {

        $booking = Booking::create([
            'booking_code'  => 'BOOK-' . date('Ymd') . '-' . strtoupper(Str::random(4)),
            'unit_id'       => $unit->id,
            'customer_id'   => $request->customer_id,
            'booking_date'  => now(),
            'purchase_type' => $request->purchase_type,
            'booking_fee'   => $bookingFee,
            'status'        => 'active',
        ]);

        Payment::create([
            'booking_id'      => $booking->id,
            'type'            => 'dp',
            'amount'          => $bookingFee,
            'payment_date'    => now(),
            'method'          => 'transfer',
            'reference_number'=> $filePath, // <-- simpan path file di sini
            'notes'           => 'Bukti transfer booking fee',
        ]);

        $unit->update(['status' => 'booked']);
    });

    return back()->with('success', 'Booking & bukti transfer berhasil disimpan');
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
