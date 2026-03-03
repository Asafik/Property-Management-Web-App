<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\KprApplication;
use Illuminate\Support\Facades\DB;
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
        $booking = Booking::findOrFail($bookingId);

        $request->validate([
            'catatan' => 'nullable|string',
            'tindakan' => 'required|string',
            'berita_acara' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
        ]);

        DB::beginTransaction();
        try {
            $kpr = $booking->kprApplication;

            // Update status dan catatan
            if ($request->tindakan === 'Lengkapi Dokumen') {
                $kpr->status = 'dokumen';
            } elseif ($request->tindakan === 'Banding Ulang') {
                $kpr->status = 'pengajuan';
            } elseif ($request->tindakan === 'Batalkan Transaksi') {
                $kpr->status = 'rejected';
                $kpr->rejected_at = now();
            } elseif ($request->tindakan === 'Pindah ke Cash') {
                $kpr->status = 'approved';
                $kpr->approved_at = now();
            } elseif ($request->tindakan === 'Ajukan ke Bank Lain') {
                $kpr->status = 'pengajuan';
            }

            $kpr->catatan = $request->catatan;

            // Upload berita acara jika ada
            if ($request->hasFile('berita_acara')) {
                $path = $request->file('berita_acara')->store('kpr/verifikasi', 'public');
                $kpr->berita_acara = $path;
            }

            $kpr->save();

            DB::commit();
            return redirect()->back()->with('success', 'Verifikasi berhasil disimpan!');
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $e->getMessage());
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

        // arahkan ke halaman survey dengan data KPR
        return view('marketing.survey', compact('application'));
    }
    public function akad($id)
{
    $application = KprApplication::with(['customer', 'unit', 'bank'])->findOrFail($id);
    return view('marketing.akad', compact('application'));
}
}
