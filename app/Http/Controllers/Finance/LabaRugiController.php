<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\Controller;
use App\Models\LandBank;
use App\Services\FinanceSyncService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LabaRugiController extends Controller
{
    protected FinanceSyncService $syncService;

    public function __construct(FinanceSyncService $syncService)
    {
        $this->syncService = $syncService;
    }

    /**
     * Tampilan Laporan Laba Rugi
     */
    public function index(Request $request)
    {
        $startDate  = $request->get('start_date', Carbon::now()->startOfYear()->toDateString());
        $endDate    = $request->get('end_date', Carbon::now()->endOfMonth()->toDateString());
        $landBankId = $request->get('land_bank_id');

        $report = $this->syncService->getIncomeStatement(
            $startDate,
            $endDate,
            $landBankId ? (int)$landBankId : null
        );

        $landBanks = LandBank::orderBy('name')->get();

        return view('keuangan.laba_rugi.index', compact(
            'report',
            'landBanks',
            'startDate',
            'endDate',
            'landBankId'
        ));
    }

    /**
     * Cetak Laporan Laba Rugi
     */
    public function cetak(Request $request)
    {
        $startDate  = $request->get('start_date', Carbon::now()->startOfYear()->toDateString());
        $endDate    = $request->get('end_date', Carbon::now()->endOfMonth()->toDateString());
        $landBankId = $request->get('land_bank_id');

        $report = $this->syncService->getIncomeStatement(
            $startDate,
            $endDate,
            $landBankId ? (int)$landBankId : null
        );

        $selectedProject = $landBankId ? LandBank::find($landBankId) : null;

        return view('keuangan.laba_rugi.cetak', compact(
            'report',
            'selectedProject',
            'startDate',
            'endDate'
        ));
    }
}
