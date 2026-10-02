<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\Controller;
use App\Models\ChartOfAccount;
use App\Models\JournalEntry;
use App\Models\JournalEntryItem;
use App\Models\LandBank;
use App\Services\FinanceSyncService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class JurnalUmumController extends Controller
{
    protected FinanceSyncService $syncService;

    public function __construct(FinanceSyncService $syncService)
    {
        $this->syncService = $syncService;
    }

    /**
     * Tampilan Utama Buku Jurnal
     */
    public function index(Request $request)
    {
        $startDate   = $request->get('start_date');
        $endDate     = $request->get('end_date');
        $landBankId  = $request->get('land_bank_id');
        $type        = $request->get('type');
        $source      = $request->get('source_module');
        $search      = $request->get('search');

        $query = JournalEntry::with(['items.account', 'landBank', 'creator']);

        if ($startDate) {
            $query->where('entry_date', '>=', $startDate);
        }
        if ($endDate) {
            $query->where('entry_date', '<=', $endDate);
        }
        if ($landBankId) {
            $query->where('land_bank_id', $landBankId);
        }
        if ($type && $type !== 'all') {
            $query->where('transaction_type', $type);
        }
        if ($source && $source !== 'all') {
            $query->where('source_module', $source);
        }
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('entry_number', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('party_name', 'like', "%{$search}%");
            });
        }

        // Summary KPI
        $allEntries = (clone $query)->get();
        $totalEntries = $allEntries->count();
        $totalDebit  = JournalEntryItem::whereIn('journal_entry_id', $allEntries->pluck('id'))
            ->where('type', 'debit')
            ->sum('amount');
        $totalCredit = JournalEntryItem::whereIn('journal_entry_id', $allEntries->pluck('id'))
            ->where('type', 'credit')
            ->sum('amount');
        $isBalanced  = abs($totalDebit - $totalCredit) < 1.0;

        $autoCount   = $allEntries->where('is_auto_generated', true)->count();
        $manualCount = $allEntries->where('is_auto_generated', false)->count();

        $entries = $query->orderBy('entry_date', 'desc')
            ->orderBy('id', 'desc')
            ->paginate(20)
            ->withQueryString();

        $landBanks = LandBank::orderBy('name')->get();
        $accounts  = ChartOfAccount::active()->orderBy('code')->get();

        return view('keuangan.jurnal_umum.index', compact(
            'entries',
            'totalEntries',
            'totalDebit',
            'totalCredit',
            'isBalanced',
            'autoCount',
            'manualCount',
            'landBanks',
            'accounts',
            'startDate',
            'endDate',
            'landBankId',
            'type',
            'source',
            'search'
        ));
    }

    /**
     * Halaman Buat Voucher / Jurnal Baru (Dedicated Create Page)
     */
    public function create(Request $request)
    {
        $type = strtoupper($request->get('type', 'BKM'));
        if (!in_array($type, ['BKM', 'BKK', 'JRN'])) {
            $type = 'BKM';
        }

        $landBanks = LandBank::orderBy('name')->get();
        $accounts  = ChartOfAccount::active()->orderBy('code')->get();

        return view('keuangan.jurnal_umum.create', compact('type', 'landBanks', 'accounts'));
    }

    /**
     * Simpan Entri Jurnal Manual / Voucher
     */
    public function store(Request $request)
    {
        $request->validate([
            'entry_date'       => 'required|date',
            'voucher_type'     => 'required|in:BKM,BKK,JRN',
            'description'      => 'required|string|max:1000',
            'land_bank_id'     => 'nullable|exists:land_banks,id',
            'party_name'       => 'nullable|string|max:150',
            'payment_method'   => 'nullable|string|max:50',
            'proof_file'       => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:5120',
            'debit_account_id' => 'required|exists:chart_of_accounts,id',
            'credit_account_id'=> 'required|exists:chart_of_accounts,id|different:debit_account_id',
            'amount'           => 'required|numeric|min:1',
        ], [
            'credit_account_id.different' => 'Akun Kredit tidak boleh sama dengan Akun Debit.',
            'amount.min'                  => 'Nominal harus lebih dari 0.',
        ]);

        DB::beginTransaction();
        try {
            $date = Carbon::parse($request->entry_date);
            $entryNumber = $this->syncService->generateEntryNumber($request->voucher_type, $date);

            $proofPath = null;
            if ($request->hasFile('proof_file')) {
                $proofPath = $request->file('proof_file')->store('financial_proofs', 'public');
            }

            // Tentukan transaction_type & cash_flow_category
            $transType = 'general';
            $cfCategory = 'none';

            if ($request->voucher_type === 'BKM') {
                $transType = 'inflow';
                $cfCategory = $request->cash_flow_category ?? 'operating';
            } elseif ($request->voucher_type === 'BKK') {
                $transType = 'outflow';
                $cfCategory = $request->cash_flow_category ?? 'operating';
            }

            $entry = JournalEntry::create([
                'entry_number'       => $entryNumber,
                'entry_date'         => $date,
                'transaction_type'   => $transType,
                'cash_flow_category' => $cfCategory,
                'source_module'      => 'manual',
                'land_bank_id'       => $request->land_bank_id,
                'description'        => $request->description,
                'party_name'         => $request->party_name,
                'payment_method'     => $request->payment_method ?? 'Tunai / Transfer',
                'total_amount'       => $request->amount,
                'proof_file'         => $proofPath,
                'is_auto_generated'  => false,
                'created_by'         => \App\Models\User::where('id', auth()->id())->value('id'),
            ]);

            $this->syncService->createJournalItems(
                $entry,
                $request->debit_account_id,
                $request->credit_account_id,
                $request->amount,
                $request->description
            );

            DB::commit();
            return redirect()->route('keuangan.jurnal.index')->with('success', "Entri voucher {$entryNumber} berhasil disimpan.");
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal menyimpan jurnal: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Detail voucher untuk modal / print
     */
    public function show($id)
    {
        $entry = JournalEntry::with(['items.account', 'landBank', 'creator'])->findOrFail($id);
        return response()->json([
            'status' => true,
            'data'   => $entry,
        ]);
    }

    /**
     * Hapus entri manual
     */
    public function destroy($id)
    {
        $entry = JournalEntry::findOrFail($id);

        if ($entry->is_auto_generated) {
            return redirect()->back()->with('error', 'Transaksi otomatis dari modul proyek tidak dapat dihapus manual dari sini.');
        }

        if ($entry->proof_file && Storage::disk('public')->exists($entry->proof_file)) {
            Storage::disk('public')->delete($entry->proof_file);
        }

        $entry->delete();

        return redirect()->back()->with('success', "Entri jurnal {$entry->entry_number} berhasil dihapus.");
    }

    /**
     * Trigger Sinkronisasi Data Transaksi Proyek
     */
    public function sync()
    {
        $result = $this->syncService->syncAll();

        if ($result['status']) {
            $totalNew = array_sum($result['stats']);
            return redirect()->back()->with('success', "Sinkronisasi berhasil! {$totalNew} transaksi telah diselaraskan ke Buku Jurnal.");
        }

        return redirect()->back()->with('error', "Sinkronisasi gagal: " . $result['message']);
    }

    /**
     * Cetak Buku Jurnal
     */
    public function cetak(Request $request)
    {
        $startDate   = $request->get('start_date');
        $endDate     = $request->get('end_date');
        $landBankId  = $request->get('land_bank_id');
        $type        = $request->get('type');

        $query = JournalEntry::with(['items.account', 'landBank', 'creator']);

        if ($startDate) {
            $query->where('entry_date', '>=', $startDate);
        }
        if ($endDate) {
            $query->where('entry_date', '<=', $endDate);
        }
        if ($landBankId) {
            $query->where('land_bank_id', $landBankId);
        }
        if ($type && $type !== 'all') {
            $query->where('transaction_type', $type);
        }

        $entries = $query->orderBy('entry_date', 'asc')->orderBy('id', 'asc')->get();
        $totalDebit  = JournalEntryItem::whereIn('journal_entry_id', $entries->pluck('id'))->where('type', 'debit')->sum('amount');
        $totalCredit = JournalEntryItem::whereIn('journal_entry_id', $entries->pluck('id'))->where('type', 'credit')->sum('amount');
        $selectedProject = $landBankId ? LandBank::find($landBankId) : null;

        return view('keuangan.jurnal_umum.cetak', compact(
            'entries',
            'totalDebit',
            'totalCredit',
            'selectedProject',
            'startDate',
            'endDate'
        ));
    }
}
