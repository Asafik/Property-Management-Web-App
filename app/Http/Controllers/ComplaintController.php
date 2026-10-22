<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Complaint;
use App\Models\Customer;
use App\Models\LandBankUnit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ComplaintController extends Controller
{
    /**
     * Tampilkan halaman servis / komplain (Dikelompokkan per Unit / Rumah)
     */
    public function index(Request $request)
    {
        $search = $request->search;
        $status = $request->status;
        $kategori = $request->kategori;

        // Query Unit / Booking yang memiliki keluhan (Grouped per Unit / Rumah)
        $unitQuery = Booking::with([
            'unit.landBank',
            'customer',
            'complaints' => function ($q) use ($status, $kategori, $search) {
                $q->latest();
                if (!empty($status)) {
                    $q->where('status', $status);
                }
                if (!empty($kategori)) {
                    $q->where('kategori', $kategori);
                }
                if (!empty($search)) {
                    $q->where(function ($sub) use ($search) {
                        $sub->where('ticket_number', 'like', "%$search%")
                            ->orWhere('judul_keluhan', 'like', "%$search%")
                            ->orWhere('deskripsi', 'like', "%$search%");
                    });
                }
            }
        ])
        ->whereHas('complaints', function ($q) use ($status, $kategori, $search) {
            if (!empty($status)) {
                $q->where('status', $status);
            }
            if (!empty($kategori)) {
                $q->where('kategori', $kategori);
            }
            if (!empty($search)) {
                $q->where(function ($sub) use ($search) {
                    $sub->where('ticket_number', 'like', "%$search%")
                        ->orWhere('judul_keluhan', 'like', "%$search%")
                        ->orWhere('deskripsi', 'like', "%$search%")
                        ->orWhereHas('customer', function ($cq) use ($search) {
                            $cq->where('full_name', 'like', "%$search%")
                               ->orWhere('phone', 'like', "%$search%");
                        })
                        ->orWhereHas('unit', function ($uq) use ($search) {
                            $uq->where('unit_code', 'like', "%$search%")
                               ->orWhere('unit_name', 'like', "%$search%");
                        });
                });
            }
        })
        ->latest('updated_at');

        $perPage = (int) $request->input('per_page', 10);
        $unitBookings = $unitQuery->paginate($perPage);

        // Statistik
        $stats = [
            'total' => Complaint::count(),
            'diajukan' => Complaint::where('status', 'diajukan')->count(),
            'diproses' => Complaint::whereIn('status', ['diproses', 'pengecekan'])->count(),
            'selesai' => Complaint::where('status', 'selesai')->count(),
        ];

        $soldBookings = Booking::with(['unit', 'customer'])
            ->whereIn('status', ['completed', 'akad', 'done'])
            ->orWhereNotNull('serah_terima_date')
            ->get();

        return view('servis.servis', compact('unitBookings', 'stats', 'soldBookings'));
    }

    /**
     * Generate Ticket Number Unik
     */
    protected function generateTicketNumber()
    {
        $month = date('m');
        $year = date('Y');
        $prefix = "CMP/$year/$month/";
        $count = Complaint::whereYear('created_at', $year)->whereMonth('created_at', $month)->count() + 1;

        do {
            $ticket = $prefix . str_pad($count, 4, '0', STR_PAD_LEFT);
            $exists = Complaint::where('ticket_number', $ticket)->exists();
            $count++;
        } while ($exists);

        return $ticket;
    }

    /**
     * Simpan keluhan baru (Mendukung 1 rumah / booking dengan multiple keluhan sekaligus)
     */
    public function store(Request $request)
    {
        $request->validate([
            'booking_id' => 'required|exists:bookings,id',
        ]);

        try {
            $booking = Booking::with(['unit', 'customer'])->findOrFail($request->booking_id);
            
            // Cek jika pengajuan menggunakan format multiple items
            if ($request->has('items') && is_array($request->items) && count($request->items) > 0) {
                $createdTickets = [];
                $destination = public_path('uploads/complaints');
                if (!file_exists($destination)) {
                    mkdir($destination, 0755, true);
                }

                foreach ($request->items as $index => $item) {
                    if (empty($item['judul_keluhan']) || empty($item['kategori'])) {
                        continue;
                    }

                    $fotoPath = null;
                    if ($request->hasFile("items.{$index}.foto_keluhan")) {
                        $file = $request->file("items.{$index}.foto_keluhan");
                        $filename = time() . '_' . $index . '_complaint_' . preg_replace('/[^A-Za-z0-9\-]/', '_', pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
                        $file->move($destination, $filename);
                        $fotoPath = 'uploads/complaints/' . $filename;
                    }

                    $ticketNumber = $this->generateTicketNumber();

                    Complaint::create([
                        'ticket_number'     => $ticketNumber,
                        'booking_id'        => $booking->id,
                        'unit_id'           => $booking->unit_id,
                        'customer_id'       => $booking->customer_id,
                        'kategori'          => $item['kategori'] ?? 'lainnya',
                        'judul_keluhan'     => $item['judul_keluhan'],
                        'deskripsi'         => $item['deskripsi'] ?? '-',
                        'prioritas'         => $item['prioritas'] ?? 'sedang',
                        'status'            => 'diajukan',
                        'tanggal_pengajuan' => now(),
                        'foto_keluhan'      => $fotoPath,
                    ]);

                    $createdTickets[] = $ticketNumber;
                }

                $count = count($createdTickets);
                if ($count > 0) {
                    $ticketsStr = implode(', ', $createdTickets);
                    Log::info("{$count} Komplain baru berhasil dibuat untuk Booking #{$booking->id} ($ticketsStr)");
                    return redirect()->back()->with('success', "Berhasil mengajukan {$count} keluhan untuk unit ini (No Tiket: {$ticketsStr}).");
                }
            }

            // Single item fallback
            $request->validate([
                'kategori'      => 'required|string',
                'judul_keluhan' => 'required|string|max:255',
                'deskripsi'     => 'required|string',
                'prioritas'     => 'required|in:rendah,sedang,tinggi,darurat',
                'foto_keluhan'  => 'nullable|file|mimes:jpg,jpeg,png,webp,pdf|max:5120',
            ]);

            $fotoPath = null;
            if ($request->hasFile('foto_keluhan')) {
                $file = $request->file('foto_keluhan');
                $filename = time() . '_complaint_' . preg_replace('/[^A-Za-z0-9\-]/', '_', pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
                $destination = public_path('uploads/complaints');
                if (!file_exists($destination)) {
                    mkdir($destination, 0755, true);
                }
                $file->move($destination, $filename);
                $fotoPath = 'uploads/complaints/' . $filename;
            }

            $ticketNumber = $this->generateTicketNumber();

            Complaint::create([
                'ticket_number'     => $ticketNumber,
                'booking_id'        => $booking->id,
                'unit_id'           => $booking->unit_id,
                'customer_id'       => $booking->customer_id,
                'kategori'          => $request->kategori,
                'judul_keluhan'     => $request->judul_keluhan,
                'deskripsi'         => $request->deskripsi,
                'prioritas'         => $request->prioritas,
                'status'            => 'diajukan',
                'tanggal_pengajuan' => now(),
                'foto_keluhan'      => $fotoPath,
            ]);

            Log::info("Komplain baru berhasil dibuat: $ticketNumber untuk Booking #{$booking->id}");

            return redirect()->back()->with('success', "Keluhan berhasil diajukan dengan Nomor Tiket: $ticketNumber.");
        } catch (\Exception $e) {
            Log::error('Error store complaint: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal mengajukan keluhan: ' . $e->getMessage());
        }
    }

    /**
     * Update progress atau status penyelesaian komplain
     */
    public function update(Request $request, $id)
    {
        $complaint = Complaint::findOrFail($id);

        $request->validate([
            'status'                    => 'required|in:diajukan,diproses,pengecekan,selesai,ditolak',
            'petugas_penanggung_jawab'  => 'nullable|string',
            'catatan_perbaikan'         => 'nullable|string',
            'biaya_perbaikan'           => 'nullable|numeric',
            'foto_penyelesaian'         => 'nullable|file|mimes:jpg,jpeg,png,webp,pdf|max:5120',
        ]);

        try {
            $data = [
                'status'                    => $request->status,
                'petugas_penanggung_jawab'  => $request->petugas_penanggung_jawab,
                'catatan_perbaikan'         => $request->catatan_perbaikan,
                'biaya_perbaikan'           => $request->biaya_perbaikan ?? $complaint->biaya_perbaikan,
            ];

            if ($request->status === 'selesai' && empty($complaint->tanggal_selesai)) {
                $data['tanggal_selesai'] = now();
            }

            if ($request->hasFile('foto_penyelesaian')) {
                $file = $request->file('foto_penyelesaian');
                $filename = time() . '_resolved_' . preg_replace('/[^A-Za-z0-9\-]/', '_', pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
                $destination = public_path('uploads/complaints');
                if (!file_exists($destination)) {
                    mkdir($destination, 0755, true);
                }
                $file->move($destination, $filename);
                $data['foto_penyelesaian'] = 'uploads/complaints/' . $filename;
            }

            $complaint->update($data);

            return redirect()->back()->with('success', 'Progress keluhan #' . $complaint->ticket_number . ' berhasil diperbarui.');
        } catch (\Exception $e) {
            Log::error('Error update complaint: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal memperbarui keluhan: ' . $e->getMessage());
        }
    }

    /**
     * Hapus keluhan
     */
    public function destroy($id)
    {
        try {
            $complaint = Complaint::findOrFail($id);
            $complaint->delete();
            return redirect()->back()->with('success', 'Data keluhan berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus data keluhan.');
        }
    }

    /**
     * Tampilkan formulir pengaduan mandiri untuk konsumen pembeli rumah (Akses Publik / Scan QR)
     */
    public function customerForm($identifier)
    {
        $booking = Booking::with(['unit.landBank', 'customer', 'complaints' => function ($q) {
            $q->latest();
        }])
        ->where('booking_code', $identifier)
        ->orWhere('id', $identifier)
        ->firstOrFail();

        $unit = $booking->unit;
        $customer = $booking->customer;

        // Hitung status garansi (Standar garansi pemeliharaan 100 hari setelah serah terima / akad)
        $bastDate = $booking->serah_terima_date ?? $booking->akad_date ?? $booking->booking_date;
        $garansiStatus = 'Aktif';
        $garansiDaysLeft = 100;
        $garansiExpiry = null;

        if ($bastDate) {
            $garansiExpiry = \Carbon\Carbon::parse($bastDate)->addDays(100);
            $now = now();
            if ($now->greaterThan($garansiExpiry)) {
                $garansiStatus = 'Berakhir';
                $garansiDaysLeft = 0;
            } else {
                $garansiDaysLeft = (int) $now->diffInDays($garansiExpiry, false);
            }
        }

        $complaintUrl = route('complaint.customer.form', $booking->booking_code ?: $booking->id);

        return view('customer.complaint_form', compact(
            'booking',
            'unit',
            'customer',
            'garansiStatus',
            'garansiDaysLeft',
            'garansiExpiry',
            'complaintUrl'
        ));
    }

    /**
     * Simpan pengaduan langsung dari formulir konsumen publik
     */
    public function customerStore(Request $request, $identifier)
    {
        $booking = Booking::with(['unit', 'customer'])
            ->where('booking_code', $identifier)
            ->orWhere('id', $identifier)
            ->firstOrFail();

        $request->validate([
            'nama_pelapor'  => 'nullable|string|max:150',
            'no_whatsapp'   => 'nullable|string|max:30',
        ]);

        try {
            $destination = public_path('uploads/complaints');
            if (!file_exists($destination)) {
                mkdir($destination, 0755, true);
            }

            $createdTickets = [];
            $pelaporInfo = '';
            if (!empty($request->nama_pelapor) || !empty($request->no_whatsapp)) {
                $pelaporInfo = "[Pelapor: " . ($request->nama_pelapor ?? $booking->customer->full_name ?? 'Konsumen') . " | WA: " . ($request->no_whatsapp ?? $booking->customer->phone ?? '-') . "]\n";
            }

            // Mode Multi-Item
            if ($request->has('items') && is_array($request->items) && count($request->items) > 0) {
                foreach ($request->items as $index => $item) {
                    if (empty($item['judul_keluhan']) || empty($item['kategori'])) {
                        continue;
                    }

                    $fotoPath = null;
                    if ($request->hasFile("items.{$index}.foto_keluhan")) {
                        $file = $request->file("items.{$index}.foto_keluhan");
                        $filename = time() . '_' . $index . '_cust_' . preg_replace('/[^A-Za-z0-9\-]/', '_', pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
                        $file->move($destination, $filename);
                        $fotoPath = 'uploads/complaints/' . $filename;
                    }

                    $ticketNumber = $this->generateTicketNumber();

                    Complaint::create([
                        'ticket_number'     => $ticketNumber,
                        'booking_id'        => $booking->id,
                        'unit_id'           => $booking->unit_id,
                        'customer_id'       => $booking->customer_id,
                        'kategori'          => $item['kategori'] ?? 'lainnya',
                        'judul_keluhan'     => $item['judul_keluhan'],
                        'deskripsi'         => $pelaporInfo . ($item['deskripsi'] ?? '-'),
                        'prioritas'         => $item['prioritas'] ?? 'sedang',
                        'status'            => 'diajukan',
                        'tanggal_pengajuan' => now(),
                        'foto_keluhan'      => $fotoPath,
                    ]);

                    $createdTickets[] = $ticketNumber;
                }
            } else {
                // Fallback Single Item
                $request->validate([
                    'kategori'      => 'required|string',
                    'judul_keluhan' => 'required|string|max:255',
                    'deskripsi'     => 'required|string',
                    'prioritas'     => 'nullable|in:rendah,sedang,tinggi,darurat',
                    'foto_keluhan'  => 'nullable|file|mimes:jpg,jpeg,png,webp,pdf|max:10240',
                ]);

                $fotoPath = null;
                if ($request->hasFile('foto_keluhan')) {
                    $file = $request->file('foto_keluhan');
                    $filename = time() . '_cust_' . preg_replace('/[^A-Za-z0-9\-]/', '_', pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
                    $file->move($destination, $filename);
                    $fotoPath = 'uploads/complaints/' . $filename;
                }

                $ticketNumber = $this->generateTicketNumber();

                Complaint::create([
                    'ticket_number'     => $ticketNumber,
                    'booking_id'        => $booking->id,
                    'unit_id'           => $booking->unit_id,
                    'customer_id'       => $booking->customer_id,
                    'kategori'          => $request->kategori,
                    'judul_keluhan'     => $request->judul_keluhan,
                    'deskripsi'         => $pelaporInfo . $request->deskripsi,
                    'prioritas'         => $request->prioritas ?? 'sedang',
                    'status'            => 'diajukan',
                    'tanggal_pengajuan' => now(),
                    'foto_keluhan'      => $fotoPath,
                ]);

                $createdTickets[] = $ticketNumber;
            }

            if (empty($createdTickets)) {
                return redirect()->back()->with('error', 'Mohon isi minimal 1 rincian keluhan dengan judul dan kategori.');
            }

            $firstTicket = $createdTickets[0];
            return redirect()->route('complaint.customer.success', [
                'identifier' => $booking->booking_code ?: $booking->id,
                'ticket'     => $firstTicket
            ])->with('allTickets', $createdTickets);

        } catch (\Exception $e) {
            Log::error('Error customer complaint store: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Terjadi kendala saat mengirim pengaduan: ' . $e->getMessage());
        }
    }

    /**
     * Tampilkan halaman sukses pengaduan untuk konsumen
     */
    public function customerSuccess($identifier, $ticket)
    {
        $booking = Booking::with(['unit.landBank', 'customer'])
            ->where('booking_code', $identifier)
            ->orWhere('id', $identifier)
            ->firstOrFail();

        $complaint = Complaint::where('ticket_number', $ticket)
            ->where('booking_id', $booking->id)
            ->first();

        $recentComplaints = Complaint::where('booking_id', $booking->id)
            ->latest()
            ->take(5)
            ->get();

        return view('customer.complaint_success', compact(
            'booking',
            'complaint',
            'recentComplaints',
            'ticket'
        ));
    }

    /**
     * Tampilkan lembar stiker QR Code / Barcode pengaduan yang siap dicetak
     */
    public function printBarcodeSticker($bookingId)
    {
        $booking = Booking::with(['unit.landBank', 'customer', 'serahTerima'])
            ->where('id', $bookingId)
            ->orWhere('booking_code', $bookingId)
            ->firstOrFail();

        $unit = $booking->unit;
        $customer = $booking->customer;

        $complaintIdentifier = $booking->booking_code ?: $booking->id;
        $complaintUrl = route('complaint.customer.form', $complaintIdentifier);

        try {
            $qrCodeSvg = QrCode::format('svg')
                ->size(220)
                ->color(26, 32, 44)
                ->generate($complaintUrl);
        } catch (\Exception $e) {
            $qrCodeSvg = null;
        }

        return view('customer.complaint_barcode_sticker', compact(
            'booking',
            'unit',
            'customer',
            'complaintUrl',
            'qrCodeSvg'
        ));
    }
}
