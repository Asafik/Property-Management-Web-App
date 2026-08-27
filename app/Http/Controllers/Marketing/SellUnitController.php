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
            'activeBooking',
            'activeBooking.sales',
            'activeBooking.customer',
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

        // Debug semua parameter
        Log::info('All request params: ' . json_encode($request->all()));
        Log::info('Jenis param: ' . $request->jenis);
        Log::info('Status param: ' . $request->status);

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                // Search in unit fields
                $q->where('block', 'like', '%' . $request->search . '%')
                    ->orWhere('unit_number', 'like', '%' . $request->search . '%')
                    ->orWhere('unit_code', 'like', '%' . $request->search . '%')
                    // Search in agent/sales name
                    ->orWhereHas('activeBooking.sales', function ($subQ) use ($request) {
                        $subQ->where('name', 'like', '%' . $request->search . '%');
                    })
                    // Search in customer name - gunakan full_name
                    ->orWhereHas('activeBooking', function ($subQ) use ($request) {
                        $subQ->whereHas('customer', function ($customerQ) use ($request) {
                            $customerQ->where('full_name', 'like', '%' . $request->search . '%');
                        });
                    });
            });
        }

        if ($request->filled('jenis')) {
            Log::info('Filter jenis: ' . $request->jenis);
            $query->where('jenis', $request->jenis);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // =========================
        // SEARCH BY AGENT/SALES
        // =========================
        if ($request->filled('agent')) {
            $query->whereHas('activeBooking.sales', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->agent . '%');
            });
        }

        // =========================
        // SEARCH BY CUSTOMER
        // =========================
        if ($request->filled('customer')) {
            $query->whereHas('activeBooking.customer', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->customer . '%');
            });
        }

        // =========================
        // SEARCH BY UNIT NAME (BLOCK - UNIT)
        // =========================
        if ($request->filled('unit_name')) {
            $query->where(function ($q) use ($request) {
                $q->where('block', 'like', '%' . $request->unit_name . '%')
                  ->orWhere('unit_number', 'like', '%' . $request->unit_name . '%')
                  ->orWhereRaw("CONCAT(block, ' - ', unit_number) LIKE ?", ['%' . $request->unit_name . '%']);
            });
        }

        // =========================
        // SEARCH BY AGENT/SALES
        // =========================
        if ($request->filled('agent')) {
            $query->whereHas('activeBooking.sales', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->agent . '%');
            });
        }

        // =========================
        // SEARCH BY CUSTOMER
        // =========================
        if ($request->filled('customer')) {
            $query->whereHas('activeBooking', function ($q) use ($request) {
                $q->whereHas('customer', function ($customerQ) use ($request) {
                    $customerQ->where('full_name', 'like', '%' . $request->customer . '%');
                });
            });
        }

        // =========================
        // SORTING SECTION
        // =========================

        // Default sorting
        $sortField = $request->get('sort', 'block');
        $sortDirection = $request->get('direction', 'asc');

        // Validate sort field
        $allowedSortFields = ['block', 'unit_number', 'jenis', 'agent_name', 'customer_name'];
        if (!in_array($sortField, $allowedSortFields)) {
            $sortField = 'block';
        }

        // Validate sort direction
        if (!in_array($sortDirection, ['asc', 'desc'])) {
            $sortDirection = 'asc';
        }

        // Apply sorting
        switch ($sortField) {
            case 'block':
                $query->orderBy('block', $sortDirection)
                      ->orderBy('unit_number', $sortDirection);
                break;

            case 'unit_number':
                $query->orderBy('unit_number', $sortDirection)
                      ->orderBy('block', $sortDirection);
                break;

            case 'jenis':
                $query->orderBy('jenis', $sortDirection)
                      ->orderBy('block', $sortDirection);
                break;

            case 'agent_name':
                $query->leftJoin('bookings as b', function($join) {
                    $join->on('b.unit_id', '=', 'land_bank_units.id')
                         ->where('b.status', '!=', 'cancelled');
                })
                ->leftJoin('employees as e', 'e.id', '=', 'b.sales_id')
                ->select('land_bank_units.*', 'e.name as agent_name')
                ->orderBy('agent_name', $sortDirection)
                ->orderBy('block', $sortDirection);
                break;

            case 'customer_name':
                $query->leftJoin('bookings as b', function($join) {
                    $join->on('b.unit_id', '=', 'land_bank_units.id')
                         ->where('b.status', '!=', 'cancelled');
                })
                ->leftJoin('customers as c', 'c.id', '=', 'b.customer_id')
                ->select('land_bank_units.*', 'c.full_name as customer_name')
                ->orderBy('customer_name', $sortDirection)
                ->orderBy('block', $sortDirection);
                break;
        }

        // =========================
        // CLONE QUERY UNTUK STATISTIK
        // =========================
        $statsQuery = clone $query;

        // =========================
        // PAGINATION
        // =========================
        $perPage = $request->get('perPage', 10);
        if (!in_array($perPage, [10, 15, 25])) {
            $perPage = 10;
        }
        $units = $query->paginate($perPage)->withQueryString();

        // Debug SQL
        Log::info('SQL Query: ' . $query->toSql());
        Log::info('Bindings: ' . json_encode($query->getBindings()));

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
        $agencies = Employee::where('position_id', 2)->latest()->get();
        $types = LandBankUnit::select('type')->distinct()->pluck('type');

        $unitPaths = [
            'A.1' => 'M16.77 101.2h44.35v24.11h-44.35v-24.11z', // path statik A.1
            'A.2' => 'M16.77 126.1h44.35v26.86h-44.35v-26.86z', // contoh
            'B.1' => 'M126.5 70.05h48.66v47.34c0 4.78-3.53 8.2-7.77 8.2h-40.89v-55.54z',
            // tambahkan semua unit...
        ];

        // ambil unit dari DB
        $unitsForSvg = (clone $statsQuery)->get(); // ambil semua kolom dan relasi agar detail unit lengkap terisi di siteplan

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
            'unitPaths',
            'sortField',
            'sortDirection'
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
            'purchase_type' => 'required|in:cash,kpr,cash_tempo',
            'booking_fee'   => 'required',
            'bukti_transfer' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $unit = LandBankUnit::findOrFail($unitId);

        // CEK STATUS UNIT
        if ($unit->status === 'sold' || $unit->status === 'booked') {
            return response()->json([
                'message' => 'Unit ini sudah tidak tersedia untuk booking.'
            ], 422); // status 422 agar ajax masuk error
        }

        // Bersihkan format rupiah
        $bookingFee = str_replace('.', '', $request->booking_fee);

        // Upload file
        if ($request->hasFile('bukti_transfer')) {

            $file = $request->file('bukti_transfer');

            $filename = uniqid() . '.' . $file->getClientOriginalExtension();

            $destination = $_SERVER['DOCUMENT_ROOT'] . '/uploads/payments/booking_fee';

            // buat folder kalau belum ada
            if (!file_exists($destination)) {
                mkdir($destination, 0755, true);
            }

            $file->move($destination, $filename);

            $filePath = 'payments/booking_fee/' . $filename;
        }

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

            // NOTIFIKASI
            $users = collect();
            $sales = Employee::find($booking->sales_id);
            if ($sales) $users->push($sales);

            $admins = Employee::whereRelation('position', 'name', 'Admin')->get();
            $users = $users->merge($admins);

            Notification::send($users, new BookingNotification($booking));
        });

        return response()->json([
            'message' => 'Booking berhasil disimpan'
        ], 200);
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
                Log::warning('Booking tidak ditemukan untuk unit ID: ' . $unitId);
                return response()->json([
                    'message' => 'Booking untuk unit ini belum dibuat. Pilih customer terlebih dahulu.'
                ], 422);
            }

            // Bersihkan format rupiah (hapus titik dan koma)
            $agentFee = str_replace(['.', ',', ' '], '', $request->agent_fee);

            $booking->update([
                'sales_id'  => $request->sales_id,
                'agent_fee' => $agentFee
            ]);

            Log::info('Sales & Agent Fee berhasil diupdate. Sales ID: ' . $request->sales_id . ', Agent Fee: ' . $agentFee);

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
            $admins = Employee::whereRelation('position', 'name', 'Staff Marketing')->get();
            $users = $users->merge($admins);

            Notification::send($users, new BookingNotification($booking));

            Log::info('Notifikasi berhasil dikirim');

            return response()->json([
                'message' => 'Agency & Agent Fee berhasil disimpan'
            ], 200);
        } catch (\Illuminate\Validation\ValidationException $e) {

            Log::error('VALIDATION ERROR', $e->errors());
            return response()->json([
                'message' => 'Validasi gagal: ' . implode(', ', array_merge(...array_values($e->errors())))
            ], 422);
        } catch (\Exception $e) {

            Log::error('GENERAL ERROR: ' . $e->getMessage());
            return response()->json([
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
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
