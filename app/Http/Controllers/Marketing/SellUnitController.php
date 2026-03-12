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
use App\Notifications\BookingNotification;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;
use App\Exports\UnitsExport;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Notification;

class SellUnitController extends Controller
{
    public function index(Request $request)
    {
        // =========================
        // BASE QUERY
        // =========================
        $user = Auth::user();
        $query = LandBankUnit::with([
            'landBank',
            'activeBooking.sales',
            'activeBooking.customer'
        ]);
        // jika posisi marketing → hanya unit miliknya
        if (($user->position->name ?? '') === 'Marketing') {
            $query->whereHas('activeBooking', function ($q) use ($user) {
                $q->where('sales_id', $user->id);
            });
        }
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
        $projects = LandBank::select('id', 'name')->orderBy('name')->get();
        $customers = Customer::latest()->get();
        $agencies = Employee::where('position_id', 5)->latest()->get();
        $types = LandBankUnit::select('type')->distinct()->pluck('type');

        $unitPaths = [
            'A.1' => 'M16.77 101.2h44.35v24.11h-44.35v-24.11z', // path statik A.1
            'A.2' => 'M16.77 126.1h44.35v26.86h-44.35v-26.86z', // contoh
            'B.1' => 'M126.5 70.05h48.66v47.34c0 4.78-3.53 8.2-7.77 8.2h-40.89v-55.54z',
            // tambahkan semua unit...
        ];

        // ambil unit dari DB
        $unitsForSvg = (clone $statsQuery)->get(['id', 'unit_code', 'status', 'type', 'pos_x', 'pos_y']); // pastikan ada kolom tipe

        // set warna sesuai tipe
        // Tentukan warna berdasarkan status & type
        foreach ($unitsForSvg as $unit) {
            if ($unit->type === 'komersil' && $unit->status === 'ready') {
                $unit->fillColor = '#2675BB'; // biru
            } elseif ($unit->status === 'ready') {
                $unit->fillColor = '#CE2A2E'; // merah
            } else {
                $unit->fillColor = '#0DA351'; // hijau default
            }
        }
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
            'types',
            'unitsForSvg',
            'unitPaths'

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
            'bukti_transfer' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
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
                'reference_number' => $filePath,
                'notes'           => 'Bukti transfer booking fee',
            ]);

            $unit->update(['status' => 'booked']);

            // =============================
            // NOTIFIKASI
            // =============================

            $users = collect();

            // sales
            $sales = Employee::find($booking->sales_id);
            if ($sales) {
                $users->push($sales);
            }

            // admin
            $admins = Employee::whereRelation('position', 'name', 'Admin')->get();
            $users = $users->merge($admins);

            Notification::send($users, new BookingNotification($booking));
        });

        return back()->with('success', 'Booking, bukti transfer, dan notifikasi berhasil disimpan');
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
                return back()->with('error', 'Booking untuk unit ini belum dibuat.');
            }

            // Bersihkan format rupiah
            $agentFee = str_replace(['.', ','], '', $request->agent_fee);

            $booking->update([
                'sales_id'  => $request->sales_id,
                'agent_fee' => $agentFee
            ]);

            Log::info('Sales & Agent Fee berhasil diupdate');

            // =============================
            // KIRIM NOTIFIKASI
            // =============================

            $users = collect();

            // SALES YANG DIPILIH
            $sales = Employee::find($booking->sales_id);
            if ($sales) {
                $users->push($sales);
            }

            // ADMIN
            $admins = Employee::whereRelation('position', 'name', 'Admin')->get();
            $users = $users->merge($admins);

            Notification::send($users, new BookingNotification($booking));

            Log::info('Notifikasi berhasil dikirim');

            return back()->with('success', 'Sales & Agent Fee berhasil diupdate');
        } catch (\Illuminate\Validation\ValidationException $e) {

            Log::error('VALIDATION ERROR', $e->errors());
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {

            Log::error('GENERAL ERROR: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat update sales.');
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
    public function savePosition(Request $request)
    {

        foreach ($request->units as $unit) {

            LandBankUnit::where('id', $unit['id'])->update([
                'pos_x' => $unit['pos_x'],
                'pos_y' => $unit['pos_y'],
                'width' => $unit['width'],   // pastikan kolom ini ada di DB
                'height' => $unit['height']  // pastikan kolom ini ada di DB
            ]);
        }

        return response()->json([
            'success' => true
        ]);
    }
}
