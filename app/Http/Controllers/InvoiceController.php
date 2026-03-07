<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;


class InvoiceController extends Controller
{
    public function index($id)
    {
        $booking = Booking::with('payments', 'unit', 'customer', 'sales')->findOrFail($id);
        $invoiceNumber = 'INV/CASH/' . date('Y') . '/' . str_pad($booking->id, 3, '0', STR_PAD_LEFT);

        $downloadUrlCash = route('dashboard.cetak.invoice.cash.pdf', $booking->id);
        $downloadUrlKonversi = route('dashboard.cetak.invoice.konversi.pdf', $booking->id);

        // QR Code SVG untuk WEB
        try {
            $qrCodeSvg = QrCode::format('svg')
                ->size(150)
                ->color(75, 73, 172)
                ->generate($downloadUrlCash);
        } catch (\Exception $e) {
            $qrCodeSvg = null;
        }

        $terbilang = $this->terbilang(($booking->unit->price ?? 450000000) - ($booking->harga_nego ?? 20000000));

        return view('cetak.invoice_cash', compact(
            'booking',
            'invoiceNumber',
            'qrCodeSvg',
            'terbilang',
            'downloadUrlCash',
            'downloadUrlKonversi'
        ));
    }

    public function cetakPdf(Booking $booking)
    {
        return $this->generatePdf($booking, 'cash');
    }

    public function cetakPdfKonversi(Booking $booking)
    {
        return $this->generatePdf($booking, 'konversi');
    }

    private function generatePdf(Booking $booking, $jenis = 'cash')
    {
        $booking->load('payments', 'unit', 'customer', 'sales');

        if ($jenis == 'konversi') {
            $invoiceNumber = 'INV/CASH-KONV/' . date('Y') . '/' . str_pad($booking->id, 3, '0', STR_PAD_LEFT);
        } else {
            $invoiceNumber = 'INV/CASH/' . date('Y') . '/' . str_pad($booking->id, 3, '0', STR_PAD_LEFT);
        }

        $qrData = json_encode([
            'invoice' => $invoiceNumber,
            'customer' => $booking->customer->name ?? '-',
            'amount' => $booking->unit->price ?? 0,
            'date' => now()->format('Y-m-d'),
            'type' => $jenis
        ]);

        // QR Code - PAKSA PAKAI PNG (PASTI MUNCUL DI DOMPDF)
        $qrBase64 = null;
        try {
            $qrPng = QrCode::format('png')
                ->size(150)
                ->margin(1)
                ->color(75, 73, 172)
                ->generate($qrData);

            $qrBase64 = 'data:image/png;base64,' . base64_encode($qrPng);
            Log::info('QR PDF sukses: ' . $invoiceNumber);
        } catch (\Exception $e) {
            Log::error('QR PDF gagal: ' . $e->getMessage());
            $qrBase64 = null;
        }

        $terbilang = $this->terbilang(($booking->unit->price ?? 450000000) - ($booking->harga_nego ?? 20000000));

        $pdf = Pdf::loadView('cetak.invoice_cash', [
            'booking' => $booking,
            'invoiceNumber' => $invoiceNumber,
            'qrBase64' => $qrBase64, // PNG base64 untuk PDF
            'terbilang' => $terbilang,
            'jenis' => $jenis,
            'pdf' => true
        ])->setPaper('A4', 'portrait');

        $fileName = 'invoice_' . ($jenis == 'konversi' ? 'konversi_' : '') . str_replace(['/', '\\'], '-', $invoiceNumber) . '.pdf';
        return $pdf->download($fileName);
    }

    private function terbilang($angka)
    {
        $angka = abs($angka);
        $huruf = ["", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas"];

        if ($angka < 12) return $huruf[$angka];
        if ($angka < 20) return $huruf[$angka - 10] . " belas";
        if ($angka < 100) return $huruf[floor($angka / 10)] . " puluh " . $huruf[$angka % 10];
        if ($angka < 200) return "seratus " . $this->terbilang($angka - 100);
        if ($angka < 1000) return $huruf[floor($angka / 100)] . " ratus " . $this->terbilang($angka % 100);
        if ($angka < 2000) return "seribu " . $this->terbilang($angka - 1000);
        if ($angka < 1000000) return $this->terbilang(floor($angka / 1000)) . " ribu " . $this->terbilang($angka % 1000);
        if ($angka < 1000000000) return $this->terbilang(floor($angka / 1000000)) . " juta " . $this->terbilang($angka % 1000000);

        return "Angka terlalu besar";
    }
   public function sendToWa($id)
{
    $booking = Booking::findOrFail($id);

    $downloadUrlCash = route('dashboard.cetak.invoice.cash.pdf', $booking->id);
    $downloadUrlKonversi = route('dashboard.cetak.invoice.konversi.pdf', $booking->id);

    $invoiceNumber = 'INV/CASH/' . date('Y') . '/' . str_pad($booking->id, 3, '0', STR_PAD_LEFT);

    $pdf = PDF::loadView(
        'cetak.invoice_cash',
        compact('booking','downloadUrlCash','downloadUrlKonversi','invoiceNumber')
    )->setPaper('A4', 'portrait');

    // =========================
    // Pastikan folder ada
    // =========================
    $folderPath = public_path('invoices');

    if (!File::exists($folderPath)) {
        File::makeDirectory($folderPath, 0755, true);
    }

    // Supaya tidak overwrite file lama
    $fileName = 'invoice-' . $booking->id . '-' . time() . '.pdf';
    $filePath = $folderPath . '/' . $fileName;

    $pdf->save($filePath);

    // =========================
    // Format nomor WA
    // =========================
    $phone = preg_replace('/[^0-9]/', '', $booking->customer->phone); 

    if (Str::startsWith($phone, '0')) {
        $phone = '62' . substr($phone, 1);
    }

    // =========================
    // Buat pesan WA
    // =========================
    $message = urlencode(
        "Halo {$booking->customer->full_name},\n\n"
        . "Berikut invoice Anda:\n"
        . url('invoices/' . $fileName)
        . "\n\nTerima kasih."
    );

    return redirect("https://wa.me/{$phone}?text={$message}");
}
}
