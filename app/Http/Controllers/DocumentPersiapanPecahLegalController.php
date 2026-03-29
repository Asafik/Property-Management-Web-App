<?php

namespace App\Http\Controllers;

use App\Models\DocumentTypes;
use App\Models\Document;
use App\Models\DocumentUpload;
use App\Models\Booking;
use App\Models\CashTempoDocument;
use Illuminate\Http\Request;

class DocumentPersiapanPecahLegalController extends Controller
{

public function index(Request $request)
{
    $documents = Document::get();
    $requiredDocs = $documents->where('required', true)->pluck('id');
    $requiredCount = $requiredDocs->count();

    // Stats Base Query (Unfiltered)
    $allBookings = Booking::with(['documentUploads'])->get();
    
    $totalBooking = $allBookings->count();
    $lengkap = 0;
    $kurang = 0;
    $revisi = 0;

    foreach ($allBookings as $booking) {
        $uploaded = $booking->documentUploads
            ->whereIn('document_id', $requiredDocs)
            ->count();

        if ($uploaded >= $requiredCount && $requiredCount > 0) {
            $lengkap++;
        } else {
            $kurang++;
        }

        if ($booking->documentUploads->where('status', 'revisi')->count()) {
            $revisi++;
        }
    }

    // Query for Datatable Output
    $query = Booking::with(['customer', 'unit', 'documentUploads'])->select('bookings.*');

    // 1. Search (Booking Code & Customer Name)
    if ($request->filled('search')) {
        $search = $request->search;
        $query->where(function (\Illuminate\Database\Eloquent\Builder $q) use ($search) {
            $q->where('booking_code', 'like', "%{$search}%")
              ->orWhereHas('customer', function ($qCustomer) use ($search) {
                  $qCustomer->where('full_name', 'like', "%{$search}%");
              });
        });
    }

    // 2. Filter Kelengkapan
    if ($request->filled('kelengkapan')) {
        if ($requiredCount > 0) {
            if ($request->kelengkapan == 'lengkap') {
                $query->whereHas('documentUploads', function ($q) use ($requiredDocs) {
                    $q->whereIn('document_id', $requiredDocs);
                }, '>=', $requiredCount);
            } elseif ($request->kelengkapan == 'belum_lengkap') {
                $query->whereHas('documentUploads', function ($q) use ($requiredDocs) {
                    $q->whereIn('document_id', $requiredDocs);
                }, '<', $requiredCount);
            }
        }
    }

    // 3. Filter Status (siap_pecah / revisi)
    if ($request->filled('status')) {
        if ($request->status == 'revisi') {
            $query->whereHas('documentUploads', function ($q) {
                $q->where('status', 'revisi');
            });
        } elseif ($request->status == 'siap_pecah') {
            if ($requiredCount > 0) {
                $query->whereHas('documentUploads', function ($q) use ($requiredDocs) {
                    $q->whereIn('document_id', $requiredDocs);
                }, '>=', $requiredCount);
            }
        }
    }

    // 4. Filter Jenis (subsidi / komersil)
    if ($request->filled('jenis')) {
        $jenis = $request->jenis;
        $query->whereHas('unit', function ($q) use ($jenis) {
            if ($jenis == 'komersil') {
                $q->where(function($sub) {
                    $sub->where('jenis', 'like', '%komersil%')
                        ->orWhere('jenis', 'like', '%komersial%');
                });
            } else {
                $q->where('jenis', 'like', "%{$jenis}%");
            }
        });
    }

    // 5. Sorting
    $sortField = $request->input('sortField', 'created_at');
    $sortDirection = $request->input('sortDirection', 'desc');

    if ($sortField == 'name') {
        $query->join('customers', 'bookings.customer_id', '=', 'customers.id')
              ->orderBy('customers.full_name', $sortDirection);
    } elseif ($sortField == 'unit') {
        $query->join('land_bank_units', 'bookings.unit_id', '=', 'land_bank_units.id')
              ->orderBy('land_bank_units.unit_name', $sortDirection);
    } else {
        if (in_array($sortField, ['booking_code', 'created_at', 'id'])) {
            $query->orderBy("bookings.{$sortField}", $sortDirection);
        } else {
            $query->orderBy('bookings.created_at', 'desc');
        }
    }

    // 6. Pagination
    $perPage = $request->input('per_page', 10);
    $bookings = $query->paginate($perPage)->withQueryString();

    return view('dokument.data_dokument_cash', compact(
        'bookings',
        'documents',
        'totalBooking',
        'lengkap',
        'kurang',
        'revisi'
    ));
}
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'accept' => 'nullable|string',
            'icon' => 'nullable|string'
        ]);

        Document::create([
            'name' => $request->name,
            'description' => $request->description,
            'required' => $request->has('required'),
            'accept' => $request->accept ?? '.jpg,.jpeg,.png,.pdf',
            'icon' => $request->icon
        ]);

        return back()->with('success', 'Dokumen berhasil ditambahkan');
    }
    public function edit($id)
    {
        $document = Document::findOrFail($id);
        return response()->json($document);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255'
        ]);

        $document = Document::findOrFail($id);
        
        $updateData = [
            'name' => $request->name,
            'description' => $request->description,
            'required' => $request->has('required')
        ];
        
        if ($request->has('code')) {
            $updateData['code'] = $request->code;
        }
        
        $document->update($updateData);

        return redirect()->back()->with('success', 'Dokumen berhasil diperbarui');
    }

    public function destroy($id)
{
    $document = Document::findOrFail($id);

    $document->delete();

    return redirect()->back()->with('success', 'Dokumen berhasil dihapus');
}
public function detail($bookingId)
{
    $booking = Booking::with(['documentUploads','customer','unit'])->findOrFail($bookingId);

    $documents = Document::all();

    return view('document_legal.partials.detail', compact('booking','documents'));
}
public function upload(Request $request)
{
    $request->validate([
        'file' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048'
    ]);

    $file = $request->file('file')->store('documents','public');

    DocumentUpload::create([
        'booking_id' => $request->booking_id,
        'document_id' => $request->document_id,
        'file_name' => $request->file('file')->getClientOriginalName(),
        'file_path' => $file
    ]);

    // Ambil dokumen wajib
    $requiredDocs = Document::where('required', true)->pluck('id');

    // Hitung dokumen yang sudah diupload
    $uploadedDocs = DocumentUpload::where('booking_id', $request->booking_id)
        ->whereIn('document_id', $requiredDocs)
        ->count();

    // Jika semua dokumen wajib sudah ada
    if ($uploadedDocs >= $requiredDocs->count()) {

        Booking::where('id', $request->booking_id)
            ->update([
                'status_legal' => 'done'
            ]);
    }

    return back()->with('success','Dokumen berhasil diupload');
}

public function uploadCashTempoDocuments(Request $request, $cashTempoId)
{
    $request->validate([
        'ktp' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
        'npwp' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
        'surat_perjanjian' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
    ]);

    // Ambil data lama atau buat baru
    $data = CashTempoDocument::firstOrNew([
        'cash_tempo_id' => $cashTempoId
    ]);

    // Upload masing-masing file jika ada
    if ($request->hasFile('ktp')) {
        $data->ktp = $request->file('ktp')->store('cash_tempo_documents', 'public');
    }

    if ($request->hasFile('npwp')) {
        $data->npwp = $request->file('npwp')->store('cash_tempo_documents', 'public');
    }

    if ($request->hasFile('surat_perjanjian')) {
        $data->surat_perjanjian = $request->file('surat_perjanjian')->store('cash_tempo_documents', 'public');
    }

    $data->save();

    return back()->with('success', 'Dokumen berhasil diupload');
}
}
