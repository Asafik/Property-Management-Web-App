<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceController extends Controller
{
    // Halaman preview web
    public function index($id)
    {
        $booking = Booking::with('payments', 'unit', 'customer')->findOrFail($id);

        $invoiceNumber = 'INV/CASH/' . date('Y') . '/' . str_pad($booking->id, 3, '0', STR_PAD_LEFT);

         // URL download PDF otomatis pakai route() → sesuaikan APP_URL
    $downloadUrl = route('dashboard.cetak.invoice.cash.pdf', $booking->id);

        // QR Code SVG
        $qrCodeSvg = QrCode::format('svg')->size(150)->generate($downloadUrl);

        return view('cetak.invoice_cash', compact('booking', 'invoiceNumber', 'qrCodeSvg'));
    }

    // Generate & download PDF
public function cetakPdf(Booking $booking)
{
    $invoiceNumber = 'INV/CASH/' . date('Y') . '/' . str_pad($booking->id, 3, '0', STR_PAD_LEFT);

    // Generate QR Code untuk PDF
    $qrData = json_encode([
        'invoice_number' => $invoiceNumber,
        'customer_name' => $booking->customer->name ?? '-',
        'total_amount' => $booking->unit->price ?? 0,
        'due_date' => now()->format('Y-m-d'),
    ]);
    $qrCodeSvg = QrCode::format('svg')->size(150)->generate($qrData);

    $pdf = Pdf::loadView('cetak.invoice_cash', [
        'booking' => $booking,
        'invoiceNumber' => $invoiceNumber,
        'qrCodeSvg' => $qrCodeSvg, // 🔹 kirim ke view
    ])->setPaper('a4');

   $fileName = 'invoice_' . str_replace(['/', '\\'], '-', $invoiceNumber) . '.pdf';

return $pdf->download($fileName);
}
}