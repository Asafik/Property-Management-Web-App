<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Banks;
use App\Models\KprApplication;
use App\Models\KprDocument;
use App\Models\Employee;
use App\Models\CompanyProfile;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class TransaksiKPRController extends Controller
{
    //

    public function index(Request $request)
    {
        $query = Booking::with(['customer', 'unit', 'sales', 'kprApplication.documents'])
            ->where(function($q) {
                $q->where('purchase_type', 'kpr')
                  ->orWhere('purchase_type', 'KPR');
            });

        // search by customer name or unit
        if ($request->filled('search')) {
            $search = trim($request->search);

            $query->where(function ($q) use ($search) {
                $q->whereHas('customer', function ($sub) use ($search) {
                    $sub->where('full_name', 'like', "%{$search}%");
                })->orWhereHas('unit', function ($sub) use ($search) {
                    $sub->where('unit_name', 'like', "%{$search}%")
                        ->orWhere('unit_code', 'like', "%{$search}%");
                });
            });
        }

        // filter status
        if ($request->filled('status')) {
            $status = strtolower($request->status);
            if ($status === 'approved') {
                $query->whereHas('kprApplication', function ($q) {
                    $q->whereIn('status', ['approved', 'analisa']);
                });
            } elseif ($status === 'survey') {
                $query->whereHas('kprApplication', function ($q) {
                    $q->where('status', 'survey');
                });
            } elseif ($status === 'rejected') {
                $query->whereHas('kprApplication', function ($q) {
                    $q->where('status', 'rejected');
                });
            } elseif ($status === 'revisi') {
                $query->whereHas('kprApplication.documents', function ($q) {
                    $q->where('status', 'revisi');
                });
            } elseif ($status === 'proses' || $status === 'menunggu') {
                $query->where(function ($q) {
                    $q->whereDoesntHave('kprApplication')
                      ->orWhereHas('kprApplication', function ($sub) {
                          $sub->whereNotIn('status', ['approved', 'rejected', 'survey', 'akad', 'completed']);
                      });
                });
            } elseif ($status === 'booking') {
                $query->where('status', 'booking');
            } else {
                $query->where('status', $request->status);
            }
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
        $booking = Booking::with([
            'customer',
            'unit',
            'sales',
            'kprApplication.bank',
            'kprApplication.documents.validator'
        ])->findOrFail($id);

        $user = Auth::user();
        $posName = strtolower($user->position->name ?? '');
        $isKepalaMarketing = str_contains($posName, 'kepala') || ($user->position_id ?? null) == 1 || str_contains($posName, 'admin') || str_contains($posName, 'direktur');

        return view('marketing.vertifikasi_kpr', compact('booking', 'isKepalaMarketing'));
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
        $isSurvey = $request->status === 'survey';

        $request->validate([
            'catatan'           => 'nullable|string',
            'status'            => 'required|string',
            'jumlah_pinjaman'   => 'nullable|numeric',
            'estimasi_angsuran' => 'nullable|numeric',
            'tenor'             => 'nullable|numeric',
            'bunga'             => 'nullable|numeric',
            'no_sp3k'           => 'nullable|string',
            'akad_at'           => 'nullable|date',
            'berita_acara'      => ($isSurvey ? 'required' : 'nullable') . '|file|mimes:jpg,jpeg,png,pdf|max:5120',
        ], [
            'berita_acara.required' => 'Dokumen Berita Acara wajib diunggah saat menyetujui verifikasi KPR.',
            'berita_acara.mimes'    => 'Format file Berita Acara harus berupa JPG, JPEG, PNG, atau PDF.',
            'berita_acara.max'      => 'Ukuran file Berita Acara maksimal 5MB.',
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
                'harga_unit'        => $booking->unit->price ?? $kpr->harga_unit,
                'submitted_at'      => $kpr->submitted_at ?? now(),
            ]);

            // update booking
            $booking->status_cash = 'done';
            $booking->status = 'cash_process';
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
        $application = KprApplication::with(['customer', 'unit.landBank', 'unit.activeBooking.sales', 'bank', 'booking.sales'])->findOrFail($id);

        // Surveyor bisa dilakukan oleh Staff Legal, Kepala Legal, Staff KPR, & Admin
        $surveyors = Employee::whereIn('position_id', [3, 4, 6, 5])
            ->orWhereHas('position', function ($q) {
                $q->whereIn('name', ['Kepala Legal', 'Staff Legal', 'Staff KPR', 'Admin']);
            })
            ->with('position')
            ->orderBy('name')
            ->get();

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

    /**
     * Cetak Berita Acara (BA) Verifikasi KPR
     */
    public function cetakBA(Request $request, $bookingId)
    {
        $booking = Booking::with([
            'customer',
            'unit.landBank',
            'kprApplication.bank',
            'kprApplication.documents',
            'sales'
        ])->findOrFail($bookingId);

        $kpr = $booking->kprApplication;
        $companyProfile = CompanyProfile::first();

        // Auto generate nama file yang rapi & terstruktur
        $cleanBookingCode = preg_replace('/[^A-Za-z0-9\-_]/', '-', $booking->booking_code ?? ('BK-' . $booking->id));
        $cleanCustomerName = preg_replace('/[^A-Za-z0-9\-_]/', '_', $booking->customer->full_name ?? 'Customer');
        $unitName = $booking->unit ? ($booking->unit->name ?? $booking->unit->unit_number ?? 'Unit') : 'Unit';
        $cleanUnitName = preg_replace('/[^A-Za-z0-9\-_]/', '_', $unitName);

        $generatedFileName = "BA_Verifikasi_KPR_{$cleanBookingCode}_{$cleanCustomerName}_{$cleanUnitName}";
        $pdfFileName = "{$generatedFileName}.pdf";

        if ($request->get('download') === 'pdf') {
            $pdf = Pdf::loadView('cetak.berita_acara_kpr', [
                'booking' => $booking,
                'kpr' => $kpr,
                'companyProfile' => $companyProfile,
                'generatedFileName' => $generatedFileName,
                'pdfFileName' => $pdfFileName,
                'isPdf' => true,
            ])->setPaper('A4', 'portrait');

            return $pdf->download($pdfFileName);
        }

        return view('cetak.berita_acara_kpr', compact('booking', 'kpr', 'companyProfile', 'generatedFileName', 'pdfFileName'));
    }

    /**
     * Validasi Dokumen KPR oleh Kepala Marketing
     */
    public function validateDocument(Request $request, $documentId)
    {
        $request->validate([
            'status'  => 'required|in:disetujui,revisi,ditolak',
            'catatan' => 'nullable|string',
        ]);

        if (in_array($request->status, ['revisi', 'ditolak']) && empty(trim($request->catatan ?? ''))) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Alasan / Catatan wajib diisi untuk status ' . ucfirst($request->status) . '.',
                ], 422);
            }
            return redirect()->back()->with('error', 'Alasan / Catatan wajib diisi untuk status ' . ucfirst($request->status) . '.');
        }

        $user = Auth::user();
        $document = KprDocument::with('kprApplication')->findOrFail($documentId);

        $document->update([
            'status'       => $request->status,
            'catatan'      => $request->status === 'disetujui' ? ($request->catatan ?? null) : $request->catatan,
            'validated_by' => $user?->id,
            'validated_at' => now(),
        ]);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Dokumen ' . ($document->document_name ?? $document->type) . ' berhasil di-' . $request->status . '.',
                'data'    => [
                    'id'               => $document->id,
                    'status'           => $document->status,
                    'status_formatted' => $document->formatted_status,
                    'badge_class'      => $document->status_badge_class,
                    'catatan'          => $document->catatan,
                    'validator_name'   => $user?->name ?? 'Kepala Marketing',
                    'validated_at'     => $document->validated_at ? $document->validated_at->format('d/m/Y H:i') : '-',
                ],
            ]);
        }

        return redirect()->back()->with('success', 'Status dokumen berhasil diperbarui menjadi ' . ucfirst($request->status) . '.');
    }

    /**
     * Upload Revisi Dokumen KPR oleh Staff Marketing / Sales
     */
    public function reuploadDocument(Request $request, $documentId)
    {
        $request->validate([
            'file' => 'required|file|mimes:jpg,jpeg,png,pdf|max:5120',
        ], [
            'file.required' => 'File dokumen revisi wajib diunggah.',
            'file.mimes'    => 'Format file harus berupa JPG, JPEG, PNG, atau PDF.',
            'file.max'      => 'Ukuran file maksimal 5MB.',
        ]);

        $document = KprDocument::with('kprApplication')->findOrFail($documentId);

        if ($request->hasFile('file')) {
            $destination = public_path('uploads/kpr');
            if (!file_exists($destination)) {
                mkdir($destination, 0777, true);
            }

            $file = $request->file('file');
            $filename = time() . '_' . $document->type . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move($destination, $filename);

            $previousCatatan = $document->catatan ? ' (Catatan revisi sebelumnya: ' . $document->catatan . ')' : '';

            $document->update([
                'path'         => 'kpr/' . $filename,
                'status'       => 'pending',
                'catatan'      => 'Revisi diunggah oleh ' . (Auth::user()->name ?? 'Staff Marketing') . ' pada ' . now()->format('d/m/Y H:i') . $previousCatatan,
                'validated_by' => null,
                'validated_at' => null,
            ]);
        }

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Dokumen ' . ($document->document_name ?? $document->type) . ' berhasil diunggah ulang dan dikirim kembali untuk verifikasi Kepala Marketing.',
                'data'    => [
                    'id'               => $document->id,
                    'status'           => $document->status,
                    'status_formatted' => $document->formatted_status,
                    'badge_class'      => $document->status_badge_class,
                    'catatan'          => $document->catatan,
                ],
            ]);
        }

        return redirect()->back()->with('success', 'Dokumen ' . ($document->document_name ?? $document->type) . ' berhasil diunggah ulang dan dikirim kembali untuk verifikasi Kepala Marketing.');
    }

    /**
     * Upload Dokumen Baru yang belum pernah diunggah
     */
    public function uploadNewDocument(Request $request, $kprId)
    {
        $request->validate([
            'type'          => 'required|string',
            'document_name' => 'required|string',
            'file'          => 'required|file|mimes:jpg,jpeg,png,pdf|max:5120',
        ], [
            'file.required' => 'File dokumen wajib diunggah.',
            'file.mimes'    => 'Format file harus berupa JPG, JPEG, PNG, atau PDF.',
            'file.max'      => 'Ukuran file maksimal 5MB.',
        ]);

        $kprApplication = KprApplication::findOrFail($kprId);

        $destination = public_path('uploads/kpr');
        if (!file_exists($destination)) {
            mkdir($destination, 0777, true);
        }

        $file = $request->file('file');
        $filename = time() . '_' . $request->type . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $file->move($destination, $filename);

        $doc = KprDocument::create([
            'kpr_application_id' => $kprApplication->id,
            'type'               => $request->type,
            'document_name'      => $request->document_name,
            'path'               => 'kpr/' . $filename,
            'status'             => 'pending',
            'catatan'            => 'Diunggah oleh ' . (Auth::user()->name ?? 'Staff Marketing') . ' pada ' . now()->format('d/m/Y H:i'),
        ]);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Dokumen ' . $request->document_name . ' berhasil diunggah dan siap diverifikasi.',
                'data'    => $doc
            ]);
        }

        return redirect()->back()->with('success', 'Dokumen ' . $request->document_name . ' berhasil diunggah dan siap diverifikasi.');
    }
}
