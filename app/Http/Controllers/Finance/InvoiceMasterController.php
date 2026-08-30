<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\PraLandbank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class InvoiceMasterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Auto sync PraLandbank records if invoice table is empty or on load
        if (Invoice::count() === 0) {
            $this->syncPraLandbanksInternal();
        }

        $query = Invoice::with(['praLandbank', 'booking', 'creator']);

        // Search Keyword
        if ($request->filled('search')) {
            $search = trim($request->search);
            $query->where(function ($q) use ($search) {
                $q->where('invoice_number', 'like', "%{$search}%")
                  ->orWhere('title', 'like', "%{$search}%")
                  ->orWhere('recipient_name', 'like', "%{$search}%")
                  ->orWhere('recipient_contact', 'like', "%{$search}%")
                  ->orWhere('notes', 'like', "%{$search}%");
            });
        }

        // Filter Category
        if ($request->filled('category') && $request->category !== 'all') {
            $query->where('category', $request->category);
        }

        // Filter Status
        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('payment_status', $request->status);
        }

        // Filter Payment Method
        if ($request->filled('payment_method') && $request->payment_method !== 'all') {
            $query->where('payment_method', $request->payment_method);
        }

        // Filter Date Range
        if ($request->filled('start_date')) {
            $query->whereDate('invoice_date', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->whereDate('invoice_date', '<=', $request->end_date);
        }

        // Sort
        $sortField = $request->get('sort_by', 'created_at');
        $sortDirection = $request->get('sort_order', 'desc');
        $allowedSorts = ['invoice_number', 'title', 'recipient_name', 'total_amount', 'paid_amount', 'remaining_amount', 'payment_status', 'invoice_date', 'created_at'];
        if (in_array($sortField, $allowedSorts)) {
            $query->orderBy($sortField, $sortDirection === 'asc' ? 'asc' : 'desc');
        } else {
            $query->orderBy('created_at', 'desc');
        }

        // Summary KPI Metrics (Calculated before pagination)
        $kpiQuery = clone $query;
        $allMatching = $kpiQuery->get();

        $stats = [
            'total_invoices_count' => $allMatching->count(),
            'total_amount'         => $allMatching->sum('total_amount'),
            'total_paid'           => $allMatching->sum('paid_amount'),
            'total_remaining'      => $allMatching->sum('remaining_amount'),
            'count_lunas'          => $allMatching->where('payment_status', 'lunas')->count(),
            'count_partial'        => $allMatching->where('payment_status', 'partial')->count(),
            'count_pending'        => $allMatching->where('payment_status', 'pending')->count(),
            'count_pra_landbank'   => $allMatching->where('category', 'pra_landbank')->count(),
        ];

        // Pagination
        $perPage = in_array((int)$request->get('per_page', 10), [10, 25, 50, 100]) ? (int)$request->get('per_page', 10) : 10;
        $invoices = $query->paginate($perPage)->withQueryString();

        return view('keuangan.master_invoice.index', compact('invoices', 'stats'));
    }

    /**
     * Show invoice details (JSON or View)
     */
    public function show($id)
    {
        $invoice = Invoice::with(['praLandbank.payments', 'praLandbank.documents.documentType', 'booking', 'creator'])->findOrFail($id);

        if (request()->ajax() || request()->wantsJson()) {
            return response()->json([
                'success' => true,
                'data'    => $invoice,
                'print_url' => $invoice->pra_landbank_id ? route('pra-landbank.invoice', $invoice->pra_landbank_id) : null
            ]);
        }

        return view('keuangan.master_invoice.show', compact('invoice'));
    }

    /**
     * Store a newly created manual invoice
     */
    public function store(Request $request)
    {
        $cleanNumber = function ($value) {
            return $value ? preg_replace('/[^0-9]/', '', $value) : 0;
        };

        $request->validate([
            'title'          => 'required|string|max:255',
            'category'       => 'required|string|max:50',
            'recipient_name' => 'required|string|max:255',
            'total_amount'   => 'required',
            'invoice_date'   => 'required|date',
            'payment_status' => 'required|in:pending,partial,lunas,cancelled',
        ]);

        try {
            $totalAmount = (float)$cleanNumber($request->total_amount);
            $paidAmount  = (float)$cleanNumber($request->paid_amount ?? 0);

            if ($request->payment_status === 'lunas' && $paidAmount == 0) {
                $paidAmount = $totalAmount;
            }

            $remainingAmount = max(0, $totalAmount - $paidAmount);

            // Generate custom Invoice Number if not provided
            $invoiceNumber = $request->invoice_number;
            if (empty($invoiceNumber)) {
                $prefix = strtoupper(substr($request->category, 0, 3));
                $invoiceNumber = 'INV-' . $prefix . '/' . date('Y') . '/' . str_pad(Invoice::count() + 1, 5, '0', STR_PAD_LEFT);
            }

            $invoice = Invoice::create([
                'invoice_number'   => $invoiceNumber,
                'category'         => $request->category,
                'title'            => $request->title,
                'recipient_name'   => $request->recipient_name,
                'recipient_contact'=> $request->recipient_contact,
                'total_amount'     => $totalAmount,
                'paid_amount'      => $paidAmount,
                'remaining_amount' => $remainingAmount,
                'payment_method'   => $request->payment_method ?? 'transfer',
                'payment_status'   => $request->payment_status,
                'invoice_date'     => $request->invoice_date,
                'due_date'         => $request->due_date,
                'notes'            => $request->notes,
                'created_by'       => auth()->id(),
            ]);

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Invoice baru berhasil disimpan ke database!',
                    'data'    => $invoice
                ]);
            }

            return redirect()->route('keuangan.master-invoice.index')->with('success', 'Invoice baru berhasil ditambahkan.');
        } catch (\Exception $e) {
            Log::error('Error store invoice: ' . $e->getMessage());
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
            }
            return back()->with('error', 'Gagal menambahkan invoice: ' . $e->getMessage());
        }
    }

    /**
     * Update invoice details / payment status
     */
    public function update(Request $request, $id)
    {
        $cleanNumber = function ($value) {
            return $value !== null && $value !== '' ? preg_replace('/[^0-9]/', '', $value) : null;
        };

        $invoice = Invoice::findOrFail($id);

        try {
            $totalAmount = $request->has('total_amount') ? (float)$cleanNumber($request->total_amount) : (float)$invoice->total_amount;
            $paidAmount = $request->has('paid_amount') ? (float)$cleanNumber($request->paid_amount) : (float)$invoice->paid_amount;
            
            $status = $request->payment_status ?? $invoice->payment_status;
            if ($status === 'lunas' && $paidAmount < $totalAmount) {
                $paidAmount = $totalAmount;
            }

            $remainingAmount = max(0, $totalAmount - $paidAmount);
            if ($paidAmount >= $totalAmount && $totalAmount > 0) {
                $status = 'lunas';
            } elseif ($paidAmount > 0 && $paidAmount < $totalAmount) {
                $status = 'partial';
            }

            $invoice->update([
                'title'            => $request->title ?? $invoice->title,
                'recipient_name'   => $request->recipient_name ?? $invoice->recipient_name,
                'recipient_contact'=> $request->recipient_contact ?? $invoice->recipient_contact,
                'total_amount'     => $totalAmount,
                'paid_amount'      => $paidAmount,
                'remaining_amount' => $remainingAmount,
                'payment_method'   => $request->payment_method ?? $invoice->payment_method,
                'payment_status'   => $status,
                'due_date'         => $request->due_date ?? $invoice->due_date,
                'notes'            => $request->notes ?? $invoice->notes,
            ]);

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Data Invoice dan Status Pembayaran berhasil diperbarui!',
                    'data'    => $invoice
                ]);
            }

            return redirect()->route('keuangan.master-invoice.index')->with('success', 'Data invoice berhasil diperbarui.');
        } catch (\Exception $e) {
            Log::error('Error update invoice: ' . $e->getMessage());
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
            }
            return back()->with('error', 'Gagal memperbarui invoice: ' . $e->getMessage());
        }
    }

    /**
     * Delete an invoice
     */
    public function destroy($id)
    {
        try {
            $invoice = Invoice::findOrFail($id);
            $invoice->delete();

            if (request()->ajax() || request()->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Invoice berhasil dihapus dari database.'
                ]);
            }

            return redirect()->route('keuangan.master-invoice.index')->with('success', 'Invoice berhasil dihapus.');
        } catch (\Exception $e) {
            Log::error('Error delete invoice: ' . $e->getMessage());
            if (request()->ajax() || request()->wantsJson()) {
                return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
            }
            return back()->with('error', 'Gagal menghapus invoice: ' . $e->getMessage());
        }
    }

    /**
     * Sync all Pra Land Bank records to Invoices table
     */
    public function syncAll()
    {
        try {
            $count = $this->syncPraLandbanksInternal();
            return response()->json([
                'success' => true,
                'message' => "Sinkronisasi berhasil! {$count} data transaksi Pra Land Bank telah sinkron ke Master Invoice database.",
                'count'   => $count
            ]);
        } catch (\Exception $e) {
            Log::error('Error syncAll invoices: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Internal helper to sync PraLandbank
     */
    private function syncPraLandbanksInternal(): int
    {
        $lands = PraLandbank::with('payments')->get();
        $synced = 0;

        foreach ($lands as $land) {
            Invoice::syncFromPraLandbank($land);
            $synced++;
        }

        return $synced;
    }
}
