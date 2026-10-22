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
        if ($angka < 1000000000000) return $this->terbilang(floor($angka / 1000000000)) . " milyar " . $this->terbilang($angka % 1000000000);

        return "Angka terlalu besar";
    }

    public function cetakKuitansiUtj($id)
    {
        $booking = Booking::with(['unit', 'unit.landBank', 'customer', 'sales', 'payments'])->findOrFail($id);
        
        $kuitansiNumber = 'KW-UTJ/' . date('Ymd', strtotime($booking->booking_date ?? now())) . '/' . str_pad($booking->id, 4, '0', STR_PAD_LEFT);
        
        $utjPayment = $booking->payments->where('type', 'booking_fee')->first();
        $nominalUtj = $booking->utj ?? $booking->booking_fee ?? ($utjPayment->amount ?? 0);
        $terbilang = $this->terbilang($nominalUtj);

        $downloadUrl = route('dashboard.cetak.kuitansi.utj.pdf', $booking->id);

        return view('cetak.kuitansi_utj', compact(
            'booking',
            'kuitansiNumber',
            'nominalUtj',
            'terbilang',
            'utjPayment',
            'downloadUrl'
        ));
    }

    public function cetakKuitansiUtjPdf($id)
    {
        $booking = Booking::with(['unit', 'unit.landBank', 'customer', 'sales', 'payments'])->findOrFail($id);
        
        $kuitansiNumber = 'KW-UTJ/' . date('Ymd', strtotime($booking->booking_date ?? now())) . '/' . str_pad($booking->id, 4, '0', STR_PAD_LEFT);
        
        $utjPayment = $booking->payments->where('type', 'booking_fee')->first();
        $nominalUtj = $booking->utj ?? $booking->booking_fee ?? ($utjPayment->amount ?? 0);
        $terbilang = $this->terbilang($nominalUtj);

        $pdf = Pdf::loadView('cetak.kuitansi_utj', [
            'booking' => $booking,
            'kuitansiNumber' => $kuitansiNumber,
            'nominalUtj' => $nominalUtj,
            'terbilang' => $terbilang,
            'utjPayment' => $utjPayment,
            'pdf' => true
        ])->setPaper('A4', 'portrait')->setOption('isRemoteEnabled', true)->setOption('isHtml5ParserEnabled', true);

        $fileName = 'kuitansi_utj_' . str_replace(['/', '\\'], '-', $kuitansiNumber) . '.pdf';
        return $pdf->download($fileName);
    }
    public function sendUtjToWa($id)
    {
        $booking = Booking::with(['unit', 'unit.landBank', 'customer', 'sales', 'payments'])->findOrFail($id);

        $kuitansiNumber = 'KW-UTJ/' . date('Ymd', strtotime($booking->booking_date ?? now())) . '/' . str_pad($booking->id, 4, '0', STR_PAD_LEFT);
        $utjPayment = $booking->payments->where('type', 'booking_fee')->first();
        $nominalUtj = $booking->utj ?? $booking->booking_fee ?? ($utjPayment->amount ?? 0);
        $terbilang = $this->terbilang($nominalUtj);

        $pdf = Pdf::loadView('cetak.kuitansi_utj', [
            'booking' => $booking,
            'kuitansiNumber' => $kuitansiNumber,
            'nominalUtj' => $nominalUtj,
            'terbilang' => $terbilang,
            'utjPayment' => $utjPayment,
            'pdf' => true
        ])->setPaper('A4', 'portrait')->setOption('isRemoteEnabled', true)->setOption('isHtml5ParserEnabled', true);

        $folderPath = public_path('invoices');
        if (!File::exists($folderPath)) {
            File::makeDirectory($folderPath, 0755, true);
        }

        $fileName = 'kuitansi-utj-' . $booking->id . '-' . time() . '.pdf';
        $filePath = $folderPath . '/' . $fileName;
        $pdf->save($filePath);

        $customerPhone = $booking->customer->phone ?? '';
        $phone = preg_replace('/[^0-9]/', '', $customerPhone);
        if (Str::startsWith($phone, '0')) {
            $phone = '62' . substr($phone, 1);
        }

        $proyek = $booking->unit->landBank->name ?? '-';
        $unitCode = $booking->unit->unit_name ?? ($booking->unit->unit_code ?? '-');
        $nominalFormatted = 'Rp ' . number_format($nominalUtj, 0, ',', '.');
        $tanggal = \Carbon\Carbon::parse($booking->booking_date ?? now())->translatedFormat('d F Y');
        $customerName = $booking->customer->full_name ?? ($booking->customer->name ?? 'Bpk/Ibu');

        $text = "Halo Bapak/Ibu *{$customerName}*,\n\n"
            . "Berikut kami sampaikan *Kuitansi Resmi Penerimaan Uang Tanda Jadi (UTJ)* pemesanan unit properti Anda:\n\n"
            . "📋 *No. Kuitansi* : {$kuitansiNumber}\n"
            . "🏠 *Unit Proyek*  : {$proyek} (Blok {$unitCode})\n"
            . "💵 *Jumlah UTJ*   : {$nominalFormatted}\n"
            . "✅ *Status*       : *LUNAS / TERVERIFIKASI*\n"
            . "📅 *Tanggal*      : {$tanggal}\n\n"
            . "Dokumen kuitansi resmi dapat Anda unduh/lihat pada tautan berikut:\n"
            . "👉 " . url('invoices/' . $fileName) . "\n\n"
            . "Terima kasih atas kepercayaan Anda.\n"
            . "*PT. GRAHA CIPTA SEJAHTERA*";

        $message = urlencode($text);

        return redirect("https://wa.me/{$phone}?text={$message}");
    }

    public function sendToWa($id)
    {
        $booking = Booking::with('payments', 'unit', 'customer', 'sales')->findOrFail($id);

        $downloadUrlCash = route('dashboard.cetak.invoice.cash.pdf', $booking->id);
        $downloadUrlKonversi = route('dashboard.cetak.invoice.konversi.pdf', $booking->id);

        $invoiceNumber = 'INV/CASH/' . date('Y') . '/' . str_pad($booking->id, 3, '0', STR_PAD_LEFT);

        $pdf = PDF::loadView(
            'cetak.invoice_cash',
            compact('booking','downloadUrlCash','downloadUrlKonversi','invoiceNumber')
        )->setPaper('A4', 'portrait');

        $folderPath = public_path('invoices');
        if (!File::exists($folderPath)) {
            File::makeDirectory($folderPath, 0755, true);
        }

        $fileName = 'invoice-' . $booking->id . '-' . time() . '.pdf';
        $filePath = $folderPath . '/' . $fileName;

        $pdf->save($filePath);

        $customerPhone = $booking->customer->phone ?? '';
        $phone = preg_replace('/[^0-9]/', '', $customerPhone); 
        if (Str::startsWith($phone, '0')) {
            $phone = '62' . substr($phone, 1);
        }

        $message = urlencode(
            "Halo {$booking->customer->full_name},\n\n"
            . "Berikut invoice Anda:\n"
            . url('invoices/' . $fileName)
            . "\n\nTerima kasih."
        );

        return redirect("https://wa.me/{$phone}?text={$message}");
    }
}
