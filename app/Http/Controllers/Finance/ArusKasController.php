<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\Controller;
use App\Models\ChartOfAccount;
use App\Models\JournalEntry;
use App\Models\LandBank;
use App\Services\FinanceSyncService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ArusKasController extends Controller
{
    protected FinanceSyncService $syncService;

    public function __construct(FinanceSyncService $syncService)
    {
        $this->syncService = $syncService;
    }

    /**
     * Dashboard & Laporan Arus Kas
     */
    public function index(Request $request)
    {
        // Default periode: gunakan awal tahun berjalan (YTD) atau tanggal transaksi awal agar mutasi terlihat lengkap
        $defaultStartDate = Carbon::now()->startOfYear()->toDateString();
        $firstEntryDate = JournalEntry::whereIn('cash_flow_category', ['operating', 'investing', 'financing'])
            ->orderBy('entry_date', 'asc')
            ->value('entry_date');
        if ($firstEntryDate) {
            $parsedFirst = Carbon::parse($firstEntryDate)->toDateString();
            if ($parsedFirst < $defaultStartDate) {
                $defaultStartDate = $parsedFirst;
            }
        }

        $startDate  = $request->get('start_date', $defaultStartDate);
        $endDate    = $request->get('end_date', Carbon::now()->endOfMonth()->toDateString());
        $landBankId = $request->get('land_bank_id');
        $tab        = $request->get('tab', 'statement'); // statement or list

        $report = $this->syncService->getCashFlowReport($startDate, $endDate, $landBankId ? (int)$landBankId : null);

        // List mutasi kas dengan pagination untuk tab daftar kas
        $mutasiQuery = JournalEntry::with(['items.account', 'landBank', 'creator'])
            ->whereIn('cash_flow_category', ['operating', 'investing', 'financing'])
            ->whereBetween('entry_date', [$startDate, $endDate]);

        if ($landBankId) {
            $mutasiQuery->where('land_bank_id', $landBankId);
        }

        $mutasiEntries = $mutasiQuery->orderBy('entry_date', 'desc')
            ->orderBy('id', 'desc')
            ->paginate(25)
            ->withQueryString();

        $landBanks = LandBank::orderBy('name')->get();
        
        // Akun untuk Quick Entry Kas Masuk & Kas Keluar
        $cashBankAccounts = ChartOfAccount::active()
            ->where('sub_category', 'Kas & Bank')
            ->orderBy('code')
            ->get();

        $contraAccounts = ChartOfAccount::active()
            ->where('sub_category', '!=', 'Kas & Bank')
            ->orderBy('code')
            ->get();

        return view('keuangan.arus_kas.index', compact(
            'report',
            'mutasiEntries',
            'landBanks',
            'cashBankAccounts',
            'contraAccounts',
            'startDate',
            'endDate',
            'landBankId',
            'tab'
        ));
    }

    /**
     * Form Halaman Sendiri untuk Input Kas Masuk (BKM) & Kas Keluar (BKK)
     */
    public function create(Request $request)
    {
        $type = strtoupper($request->get('type', 'BKM'));
        if (!in_array($type, ['BKM', 'BKK'])) {
            $type = 'BKM';
        }

        $landBanks = LandBank::orderBy('name')->get();

        $cashBankAccounts = ChartOfAccount::active()
            ->where('sub_category', 'Kas & Bank')
            ->orderBy('code')
            ->get();

        $contraAccounts = ChartOfAccount::active()
            ->where('sub_category', '!=', 'Kas & Bank')
            ->orderBy('code')
            ->get();

        return view('keuangan.arus_kas.create', compact(
            'type',
            'landBanks',
            'cashBankAccounts',
            'contraAccounts'
        ));
    }

    /**
     * Tambah Transaksi Kas Manual (Quick BKM / BKK)
     */
    public function storeManual(Request $request)
    {
        $request->validate([
            'voucher_type'        => 'required|in:BKM,BKK',
            'entry_date'          => 'required|date',
            'cash_bank_account_id'=> 'required|exists:chart_of_accounts,id',
            'contra_account_id'   => 'required|exists:chart_of_accounts,id|different:cash_bank_account_id',
            'cash_flow_category'  => 'required|in:operating,investing,financing',
            'amount'              => 'required|numeric|min:1',
            'description'         => 'required|string|max:1000',
            'party_name'          => 'nullable|string|max:150',
            'land_bank_id'        => 'nullable|exists:land_banks,id',
            'proof_file'          => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:5120',
        ], [
            'contra_account_id.different' => 'Akun Lawan tidak boleh sama dengan Akun Kas/Bank.',
        ]);

        DB::beginTransaction();
        try {
            $date = Carbon::parse($request->entry_date);
            $entryNumber = $this->syncService->generateEntryNumber($request->voucher_type, $date);

            $proofPath = null;
            if ($request->hasFile('proof_file')) {
                $proofPath = $request->file('proof_file')->store('financial_proofs', 'public');
            }

            $isBKM = ($request->voucher_type === 'BKM');
            $transType = $isBKM ? 'inflow' : 'outflow';

            // Jika BKM (Kas Masuk): Kas/Bank di DEBIT, Akun Lawan (Pendapatan/Modal/Piutang) di KREDIT
            // Jika BKK (Kas Keluar): Akun Lawan (Biaya/HPP/Hutang/Aset) di DEBIT, Kas/Bank di KREDIT
            $debitAccId  = $isBKM ? $request->cash_bank_account_id : $request->contra_account_id;
            $creditAccId = $isBKM ? $request->contra_account_id : $request->cash_bank_account_id;

            $entry = JournalEntry::create([
                'entry_number'       => $entryNumber,
                'entry_date'         => $date,
                'transaction_type'   => $transType,
                'cash_flow_category' => $request->cash_flow_category,
                'source_module'      => 'manual',
                'land_bank_id'       => $request->land_bank_id,
                'description'        => $request->description,
                'party_name'         => $request->party_name,
                'payment_method'     => $isBKM ? 'Kas Masuk' : 'Kas Keluar',
                'total_amount'       => $request->amount,
                'proof_file'         => $proofPath,
                'is_auto_generated'  => false,
                'created_by'         => \App\Models\User::where('id', auth()->id())->value('id'),
            ]);

            $this->syncService->createJournalItems(
                $entry,
                $debitAccId,
                $creditAccId,
                $request->amount,
                $request->description
            );

            DB::commit();
            return redirect()->route('keuangan.arus-kas.index')->with('success', "Transaksi Kas {$entryNumber} berhasil dicatat.");
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal mencatat transaksi kas: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Hapus Transaksi Kas Manual
     */
    public function destroyManual($id)
    {
        $entry = JournalEntry::findOrFail($id);

        if ($entry->is_auto_generated) {
            return redirect()->back()->with('error', 'Transaksi otomatis dari proyek tidak bisa dihapus dari form ini.');
        }

        if ($entry->proof_file && Storage::disk('public')->exists($entry->proof_file)) {
            Storage::disk('public')->delete($entry->proof_file);
        }

        $entry->delete();

        return redirect()->back()->with('success', "Transaksi kas {$entry->entry_number} berhasil dihapus.");
    }

    /**
     * Cetak Laporan Arus Kas
     */
    public function cetak(Request $request)
    {
        $defaultStartDate = Carbon::now()->startOfYear()->toDateString();
        $firstEntryDate = JournalEntry::whereIn('cash_flow_category', ['operating', 'investing', 'financing'])
            ->orderBy('entry_date', 'asc')
            ->value('entry_date');
        if ($firstEntryDate) {
            $parsedFirst = Carbon::parse($firstEntryDate)->toDateString();
            if ($parsedFirst < $defaultStartDate) {
                $defaultStartDate = $parsedFirst;
            }
        }

        $startDate  = $request->get('start_date', $defaultStartDate);
        $endDate    = $request->get('end_date', Carbon::now()->endOfMonth()->toDateString());
        $landBankId = $request->get('land_bank_id');

        $report = $this->syncService->getCashFlowReport($startDate, $endDate, $landBankId ? (int)$landBankId : null);
        $selectedProject = $landBankId ? LandBank::find($landBankId) : null;

        return view('keuangan.arus_kas.cetak', compact(
            'report',
            'selectedProject',
            'startDate',
            'endDate'
        ));
    }
}
