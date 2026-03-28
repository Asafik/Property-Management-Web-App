<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Document;
use App\Models\DocumentUpload;

class DocumentLegalController extends Controller
{
    public function index($id)
    {
        $booking = Booking::with(['customer', 'unit'])->findOrFail($id);

        // Ambil master dokumen
        $documents = Document::orderBy('id')->get();
        $uploads = DocumentUpload::where('booking_id', $id)->get()->keyBy('document_id');
        return view('marketing.cash_dokument_legal', compact('booking', 'documents','uploads'));
    }

        public function store(Request $request, $bookingId)
        {
        
            $request->validate([
                'document_*' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
            ]);

            foreach ($request->allFiles() as $key => $file) {

                if ($file) {

                    
                    $documentId = str_replace('document_', '', $key);

                    $path = $file->store('document_uploads', 'public');

                
                    DocumentUpload::updateOrCreate(
                        [
                            'booking_id'  => $bookingId,
                            'document_id' => $documentId,
                        ],
                        [
                            'file_name' => $file->getClientOriginalName(),
                            'file_path' => $path,
                        ]
                    );
                }
            }
                    Booking::where('id', $bookingId)->update([
                'status_legal' => 'done'
            ]);

            return redirect()->back()->with('success', 'Dokumen berhasil diupload');
        }
}