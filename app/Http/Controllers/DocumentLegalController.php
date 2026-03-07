<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Document; // <- jangan lupa import

class DocumentLegalController extends Controller
{
    public function index($id)
    {
        $booking = Booking::with(['customer', 'unit'])->findOrFail($id);

        // Ambil master dokumen
        $documents = Document::orderBy('id')->get();

        return view('marketing.cash_dokument_legal', compact('booking', 'documents'));
    }
}