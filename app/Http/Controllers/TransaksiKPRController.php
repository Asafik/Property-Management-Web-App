<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Banks;
use App\Models\KprApplication;
use App\Models\Employee;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class TransaksiKPRController extends Controller
{
    //

    public function index(Request $request)
    {
        $query = Booking::with(['customer', 'unit', 'sales', 'kprApplication'])
            ->where('purchase_type', 'kpr');

        // search by customer name only
        if ($request->filled('search')) {
            $search = trim($request->search);

            $query->whereHas('customer', function ($q) use ($search) {
                $q->where('full_name', 'like', "%{$search}%");
            });
        }

        // filter status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // sort
        $sort = $request->input('sort', 'latest');

        switch ($sort) {
            case 'name_asc':
                $query->join('customers', 'bookings.customer_id', '=', 'customers.id')
                    ->orderBy('customers.full_name', 'asc')
                    ->select('bookings.*');
                break;

            case 'name_desc':
                $query->join('customers', 'bookings.customer_id', '=', 'customers.id')
                    ->orderBy('customers.full_name', 'desc')
                    ->select('bookings.*');
                break;

            case 'unit_asc':
                $query->join('land_bank_units', 'bookings.unit_id', '=', 'land_bank_units.id')
                    ->orderBy('land_bank_units.unit_code', 'asc')
                    ->select('bookings.*');
                break;

            case 'unit_desc':
                $query->join('land_bank_units', 'bookings.unit_id', '=', 'land_bank_units.id')
                    ->orderBy('land_bank_units.unit_code', 'desc')
                    ->select('bookings.*');
                break;

            case 'latest':
            default:
                $query->latest();
                break;
        }

        // per page
        $perPage = (int) $request->input('per_page', 10);
        $allowedPerPage = [10, 15, 25];

        if (!in_array($perPage, $allowedPerPage)) {
            $perPage = 10;
        }

        // pagination
        $bookings = $query->paginate($perPage)->appends($request->query());

        return view('transaksi.customer-kpr', compact('bookings'));
    }


    public function approve($id)
    {
        $booking = Booking::with(['customer', 'unit', 'sales', 'kprApplication.bank', 'kprApplication.documents'])->findOrFail($id);

        return view('marketing.vertifikasi_kpr', compact('booking'));
    }

 public function storeVerifikasi(Request $request, $bookingId)
{
    DB::beginTransaction();

    try {
        $booking = Booking::findOrFail($bookingId);
        $kpr = $booking->kprApplication;

        if (!$kpr) {
            throw new \Exception("KPR Application untuk booking ID {$bookingId} tidak ditemukan");
        }

        // VALIDASI
        $request->validate([
            'catatan' => 'nullable|string',
            'status' => 'required|string',
            'jumlah_pinjaman' => 'nullable|numeric',
            'estimasi_angsuran' => 'nullable|numeric',
            'tenor' => 'nullable|numeric',
            'bunga' => 'nullable|numeric',
            'no_sp3k' => 'nullable|string',
            'akad_at' => 'nullable|date',
            'berita_acara' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
        ]);

        // =========================
        // PROSES SURVEY / APPROVAL
        // =========================
        if ($request->status === 'survey') {

            // cek jenis unit (AMAN dari null)
            $unitType = optional($kpr->unit)->jenis;

            // tentukan status KPR
            $kprStatus = $unitType === 'komersil' ? 'analisa' : 'approved';

            $kpr->fill([
                'jumlah_pinjaman'   => $request->jumlah_pinjaman ?? $kpr->jumlah_pinjaman,
                'estimasi_angsuran' => $request->estimasi_angsuran ?? $kpr->estimasi_angsuran,
                'tenor'             => $request->tenor ?? $kpr->tenor,
                'bunga'             => $request->bunga ?? $kpr->bunga,
                'no_sp3k'           => $request->no_sp3k ?? $kpr->no_sp3k,
                'akad_at'           => $request->akad_at ?? now(),
                'status'            => $kprStatus, // 🔥 LOGIC UTAMA
                'harga_unit'        => $request->jumlah_pinjaman ?? $kpr->harga_unit,
                'submitted_at'      => $kpr->submitted_at ?? now(),
            ]);

            // update booking
            $booking->status_cash = 'done';
            $booking->status = 'cash_process';

            // update harga unit
            if ($kpr->unit) {
                $kpr->unit->update([
                    'price' => $request->jumlah_pinjaman ?? $kpr->unit->price
                ]);
            }
        }

        // =========================
        // JIKA DITOLAK
        // =========================
        if ($request->status === 'rejected') {
            $kpr->status = 'rejected';
            $kpr->rejected_at = now();
            $kpr->submitted_at = null;

            $booking->status_cash = 'rejected';
        }

        // =========================
        // CATATAN + FILE
        // =========================
        $kpr->catatan = $request->catatan;

        if ($request->hasFile('berita_acara')) {

            $file = $request->file('berita_acara');

            $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $cleanName = preg_replace('/[^A-Za-z0-9\-]/', '_', $originalName);
            $extension = $file->getClientOriginalExtension();

            $filename = time() . '_' . $cleanName . '.' . $extension;

            $destination = $_SERVER['DOCUMENT_ROOT'] . '/uploads/kpr/verifikasi';

            if (!file_exists($destination)) {
                mkdir($destination, 0755, true);
            }

            $file->move($destination, $filename);

            $path = 'kpr/verifikasi/' . $filename;

            $kpr->berita_acara = $path;
        }

        // =========================
        // SAVE
        // =========================
        $kpr->save();
        $booking->save();

        DB::commit();

        Log::info('Verifikasi KPR berhasil disimpan', [
            'booking_id' => $bookingId,
            'status' => $request->status,
        ]);

        return redirect()->back()->with('success', 'Verifikasi berhasil disimpan!');
    } catch (\Throwable $e) {

        DB::rollBack();

        Log::error('Gagal menyimpan verifikasi KPR: ' . $e->getMessage());

        return redirect()->back()
            ->withInput()
            ->with('error', 'Terjadi kesalahan.');
    }
}
    public function verified(Request $request)
    {
        $query = KprApplication::with(['customer', 'unit', 'bank'])
            ->where('status', 'approved');

        // Filter search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('customer', function ($q) use ($search) {
                $q->where('full_name', 'like', "%$search%");
            });
        }

        // Filter bank
        if ($request->filled('bank_name')) {
            $query->where('bank_name', $request->bank_name);
        }

        // Filter unit
        if ($request->filled('unit_code')) {
            $query->where('unit_code', $request->unit_code);
        }

        // Pagination
        $perPage = $request->input('per_page', 10);
        $allowedPerPage = [10, 25, 50];
        if (!in_array($perPage, $allowedPerPage)) {
            $perPage = 10;
        }

        $kprApplications = $query->latest()->paginate($perPage);
        $kprApplications->appends($request->query());

        // Data untuk dropdown filter
        $banks = Banks::all();

        return view('transaksi.kpr-verified', compact('kprApplications', 'banks',));
    }


    public function survey($id)
    {
        $application = KprApplication::with(['customer', 'unit', 'bank'])->findOrFail($id);

        $surveyors = Employee::where('position_id', 3)->get();

        return view('marketing.survey', compact('application', 'surveyors'));
    }
    public function akad($id)
    {
        $application = KprApplication::with(['customer', 'unit.agency', 'bank'])->findOrFail($id);

        return view('marketing.akad', compact('application'));
    }


public function analisaKPRKomersil(Request $request)
{
    $perPage = $request->input('per_page', 10);
    $perPage = in_array((int) $perPage, [10, 15, 25]) ? (int) $perPage : 10;

    $search = $request->input('search');
    $bankId = $request->input('bank');

    $sortField = $request->input('sortField', 'name');
    $sortDirection = $request->input('sortDirection', 'asc');
    $allowedSortFields = ['name', 'unit', 'bank', 'price', 'appraisal'];

    if (!in_array($sortField, $allowedSortFields)) {
        $sortField = 'name';
    }

    if (!in_array($sortDirection, ['asc', 'desc'])) {
        $sortDirection = 'asc';
    }

    $applications = KprApplication::with(['customer', 'unit', 'bank'])

       
        ->where(function ($query) {
            $query->where('kpr_applications.status', 'analisa')
                  ->orWhere('kpr_applications.status', 'survey');
        })

       
        ->when($search, function ($query) use ($search) {
            $query->whereHas('customer', function ($q) use ($search) {
                $q->where('full_name', 'like', '%' . $search . '%');
            });
        })

       
        ->when($bankId, function ($query) use ($bankId) {
            $query->where('banks_id', $bankId);
        })

        
        ->join('customers', 'kpr_applications.customer_id', '=', 'customers.id')
        ->join('land_bank_units', 'kpr_applications.unit_id', '=', 'land_bank_units.id')
        ->leftJoin('banks', 'kpr_applications.banks_id', '=', 'banks.id')

      
        ->when($sortField == 'name', function ($q) use ($sortDirection) {
            $q->orderBy('customers.full_name', $sortDirection);
        })
        ->when($sortField == 'unit', function ($q) use ($sortDirection) {
            $q->orderBy('land_bank_units.unit_name', $sortDirection);
        })
        ->when($sortField == 'bank', function ($q) use ($sortDirection) {
            $q->orderBy('banks.bank_name', $sortDirection);
        })
        ->when($sortField == 'price', function ($q) use ($sortDirection) {
            $q->orderBy('land_bank_units.price', $sortDirection);
        })
        ->when($sortField == 'appraisal', function ($q) use ($sortDirection) {
            $q->orderBy('kpr_applications.appraisal_value', $sortDirection);
        })

        ->select('kpr_applications.*')
        ->paginate($perPage)
        ->withQueryString();

    $banks = Banks::orderBy('bank_name')->get();

    return view('marketing.analisa_kpr_komersil', compact(
        'applications',
        'banks',
        'search',
        'bankId',
        'perPage'
    ));
}
}
