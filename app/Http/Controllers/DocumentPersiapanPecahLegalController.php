<?php

namespace App\Http\Controllers;

use App\Models\DocumentTypes;
use App\Models\Document;
use App\Models\DocumentUpload;
use App\Models\Booking;
use Illuminate\Http\Request;

class DocumentPersiapanPecahLegalController extends Controller
{

public function index()
{
    $documents = Document::get();
    $requiredDocs = $documents->where('required', true)->pluck('id');

    $bookings = Booking::with(['customer','unit','documentUploads'])->get();

    $totalBooking = $bookings->count();

    $lengkap = 0;
    $kurang = 0;
    $revisi = 0;

    foreach ($bookings as $booking) {

        $uploaded = $booking->documentUploads
            ->whereIn('document_id', $requiredDocs)
            ->count();

        if ($uploaded >= $requiredDocs->count()) {
            $lengkap++;
        } else {
            $kurang++;
        }

        // jika ada status revisi
        if ($booking->documentUploads->where('status','revisi')->count()) {
            $revisi++;
        }
    }

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
}
