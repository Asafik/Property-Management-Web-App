<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Employee;
use App\Models\Promo;

class ListPengajuanController extends Controller
{
    public function index(Request $request)
    {
        // Query builder untuk bookings dengan relasi
        $query = Booking::with([
            'customer',
            'unit',
            'sales'
        ]);

        // Filter Pencarian (customer, booking code, unit)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('booking_code', 'like', "%{$search}%")
                    ->orWhereHas('customer', function ($customer) use ($search) {
                        $customer->where('full_name', 'like', "%{$search}%");
                    })
                    ->orWhereHas('unit', function ($unit) use ($search) {
                        $unit->where('block', 'like', "%{$search}%")
                            ->orWhere('unit_number', 'like', "%{$search}%");
                    });
            });
        }

        // Filter Status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter Metode Pembayaran
        if ($request->filled('metode')) {
            $query->where('purchase_type', $request->metode);
        }
        // Filter by Customer Name Explicitly
        if ($request->filled('name')) {
            $name = $request->name;
            $query->whereHas('customer', function ($q) use ($name) {
                $q->where('full_name', 'like', "%{$name}%");
            });
        }

        // Filter by ID Booking Explicitly
        if ($request->filled('id_booking')) {
            $id_booking = $request->id_booking;
            $query->where(function ($q) use ($id_booking) {
                $q->where('id', 'like', "%{$id_booking}%")
                  ->orWhere('booking_code', 'like', "%{$id_booking}%");
            });
        }

        // Sorting Logic
        $sortColumn = $request->input('sort');
        $sortDirection = $request->input('direction', 'asc');
        $sortDirection = in_array(strtolower($sortDirection), ['asc', 'desc']) ? strtolower($sortDirection) : 'asc';

        if ($sortColumn === 'name') {
            $query->join('customers', 'bookings.customer_id', '=', 'customers.id')
                  ->orderBy('customers.full_name', $sortDirection)
                  ->select('bookings.*');
        } elseif ($sortColumn === 'id_booking') {
            $query->orderBy('booking_code', $sortDirection);
        } elseif (in_array($sortColumn, ['id', 'booking_code', 'status', 'purchase_type', 'created_at'])) {
            $query->orderBy($sortColumn, $sortDirection);
        } else {
            $query->latest('bookings.created_at'); // Menggunakan nama tabel saat default untuk menghindari ambiguitas jika ada join nantinya
        }

        // Jumlah tampil per halaman
        $perPage = $request->input('per_page', 10);

        // Ambil data dengan pagination
        $bookings = $query->paginate($perPage)->withQueryString();

        // Total booking dengan status pengajuan (untuk statistik)
        $totalPengajuan = Booking::where('status', 'active')->count();

        // Total untuk statistik lainnya (opsional)
        $totalKpr = Booking::where('purchase_type', 'kpr')->count();
        $totalCash = Booking::where('purchase_type', 'cash')->count();
        $totalLunas = Booking::whereIn('status', ['completed', 'cash_process'])->count();

        $marketing = Employee::where('division_id', 1)->get();


        return view('marketing.list_pengajuan', compact(
            'totalPengajuan',
            'totalKpr',
            'totalCash',
            'totalLunas',
            'bookings',
            'marketing'
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
