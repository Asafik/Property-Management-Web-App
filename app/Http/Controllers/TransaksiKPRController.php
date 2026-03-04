<?php

namespace App\Http\Controllers;

use App\Models\Booking;
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
        $query = Booking::with(['customer', 'unit', 'sales'])
            ->where('purchase_type', 'kpr'); // sesuaikan dengan kolom kamu

        // 🔍 Search customer
        if ($request->filled('search')) {
            $search = $request->search;

            $query->whereHas('customer', function ($q) use ($search) {
                $q->where('name', 'like', "%$search%");
            });
        }

        $bookings = $query->latest()->paginate(10);

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

        // Validasi
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

        // Jika KPR disetujui / survey
        if ($request->status === 'survey') {
            // Update KPR application
            $kpr->jumlah_pinjaman = $request->jumlah_pinjaman ?? $kpr->jumlah_pinjaman;
            $kpr->estimasi_angsuran = $request->estimasi_angsuran ?? $kpr->estimasi_angsuran;
            $kpr->tenor = $request->tenor ?? $kpr->tenor;
            $kpr->bunga = $request->bunga ?? $kpr->bunga;
            $kpr->no_sp3k = $request->no_sp3k ?? $kpr->no_sp3k;
            $kpr->akad_at = $request->akad_at ?? now();
            $kpr->status = 'survey';

            // Update harga unit di KPR applications
            $kpr->harga_unit = $request->jumlah_pinjaman ?? $kpr->harga_unit;

            // Update harga di LandBankUnit
            if ($kpr->unit) {
                $kpr->unit->price = $request->jumlah_pinjaman ?? $kpr->unit->price;
                $kpr->unit->save();
            }
        }

        // Jika KPR ditolak
        if ($request->status === 'rejected') {
            $kpr->status = 'rejected';
            $kpr->rejected_at = now();
        }

        // Update catatan
        $kpr->catatan = $request->catatan;

        // Upload berita acara
        if ($request->hasFile('berita_acara')) {
            $path = $request->file('berita_acara')->store('kpr/verifikasi', 'public');
            $kpr->berita_acara = $path;
        }

        $kpr->save();
        DB::commit();

        Log::info('Verifikasi KPR berhasil disimpan', [
            'booking_id' => $bookingId,
            'user_id' => auth()->id(),
            'status' => $request->status,
        ]);

        return redirect()->back()->with('success', 'Verifikasi berhasil disimpan!');
    } catch (\Throwable $e) {
        DB::rollBack();

        Log::error('Gagal menyimpan verifikasi KPR', [
            'booking_id' => $bookingId,
            'user_id' => auth()->id(),
            'status' => $request->status ?? null,
            'error_message' => $e->getMessage(),
            'trace' => $e->getTraceAsString(),
        ]);

        return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan. Silakan coba lagi.');
    }
}
    public function verified()
    {
        // Ambil data KPR yang status dokumennya 'verified'
        $kprApplications = KprApplication::with(['customer', 'unit', 'bank'])
            ->where('status', 'dokumen')
            ->get();

        return view('transaksi.kpr-verified', compact('kprApplications'));
    }
    public function survey($id)
    {
        $application = KprApplication::with(['customer', 'unit', 'bank'])->findOrFail($id);
        
    $surveyors = Employee::where('role', 'surveyor')->get();
        // arahkan ke halaman survey dengan data KPR
        return view('marketing.survey', compact('application', 'surveyors'));
    }
    public function akad($id)
{
    $application = KprApplication::with(['customer', 'unit.agency', 'bank'])->findOrFail($id);
    return view('marketing.akad', compact('application'));
}

    
}
