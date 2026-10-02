<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\Controller;
use App\Models\LandBank;
use App\Services\FinanceSyncService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class NeracaController extends Controller
{
    protected FinanceSyncService $syncService;

    public function __construct(FinanceSyncService $syncService)
    {
        $this->syncService = $syncService;
    }

    /**
     * Tampilan Neraca Keuangan
     */
    public function index(Request $request)
    {
        $asOfDate   = $request->get('as_of_date', Carbon::today()->toDateString());
        $landBankId = $request->get('land_bank_id');

        $report = $this->syncService->getBalanceSheet(
            $asOfDate,
            $landBankId ? (int)$landBankId : null
        );

        $landBanks = LandBank::orderBy('name')->get();

        return view('keuangan.neraca.index', compact(
            'report',
            'landBanks',
            'asOfDate',
            'landBankId'
        ));
    }

    /**
     * Cetak Neraca Keuangan
     */
    public function cetak(Request $request)
    {
        $asOfDate   = $request->get('as_of_date', Carbon::today()->toDateString());
        $landBankId = $request->get('land_bank_id');

        $report = $this->syncService->getBalanceSheet(
            $asOfDate,
            $landBankId ? (int)$landBankId : null
        );

        $selectedProject = $landBankId ? LandBank::find($landBankId) : null;

        return view('keuangan.neraca.cetak', compact(
            'report',
            'selectedProject',
            'asOfDate'
        ));
    }
}
