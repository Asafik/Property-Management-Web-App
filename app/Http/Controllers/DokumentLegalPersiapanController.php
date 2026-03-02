<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DokumentLegalPersiapanController extends Controller
{
    // Halaman daftar dokumen
    public function index(Request $request)
    {
        $query = Document::query();

        // Filter search by name
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('name', 'like', "%{$search}%");
        }

        // Filter by has_expiry (yes/no)
        if ($request->filled('has_expiry')) {
            if ($request->has_expiry === 'yes') {
                $query->where('has_expiry', true);
            } elseif ($request->has_expiry === 'no') {
                $query->where('has_expiry', false);
            }
        }

        $perPage = $request->input('per_page', 10);

        // Ambil data dokumen
        $documents = $query->latest()->paginate($perPage)->withQueryString();

        return view('dokument.dokument', compact('documents'));
    }

    public function store(Request $request, $bookingId)
{
    $documents = Document::all();

    foreach ($documents as $doc) {
        $inputName = 'document_' . $doc->id;
        if ($request->hasFile($inputName)) {
            $file = $request->file($inputName);
            
            // Simpan file ke folder storage/app/public/documents
            $path = $file->store('documents', 'public');

            // Simpan informasi file ke database
            $doc->uploads()->create([
                'booking_id' => $bookingId,
                'file_name'  => $file->getClientOriginalName(),
                'file_path'  => $path,
            ]);
        }
    }

    // Update status booking menjadi 'legal_done'
    $booking = Booking::findOrFail($bookingId);
    $booking->status = 'legal_done';
    $booking->save();

    return redirect()->back()->with('success', 'Dokumen berhasil diupload dan status booking diperbarui!');
}
}