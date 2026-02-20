<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| CONTROLLER IMPORT
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\Admin\PropertyController;
use App\Http\Controllers\Admin\LandBankUnitController;
use App\Http\Controllers\Admin\DevelopmentProgressController;
use App\Http\Controllers\Admin\VerifikasiLegalController;

use App\Http\Controllers\LandBankController;
use App\Http\Controllers\AgencyPropertyController;
use App\Http\Controllers\KprApplicationController;
use App\Http\Controllers\RABController;

use App\Http\Controllers\Marketing\CustomerController;
use App\Http\Controllers\Marketing\SellUnitController;
use App\Http\Controllers\ListPengajuanController;
use App\Http\Controllers\PengajuanController;

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/
Route::get('/',[LoginController::class,'index'])->name('login');
Route::post('/login',[LoginController::class,'login'])->name('login.proses');
Route::get('/logout',[LoginController::class,'logout'])->name('logout');

Route::get('/register', function () {
    return view('auth.register');
});


/*
|--------------------------------------------------------------------------
| DASHBOARD
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


/*
|--------------------------------------------------------------------------
| ========================= MARKETING =========================
|--------------------------------------------------------------------------
*/

Route::get('/marketing/sell-unit',[SellUnitController::class, 'index'])->name('marketing.jual-unit');
Route::post('/marketing/set-agency/{unitId}',[SellUnitController::class, 'setAgency'])->name('marketing.setAgency');

Route::get('/marketing/create-customer', [CustomerController::class, 'index'])->name('marketing.tambah_customer');
Route::post('/marketing/create-customer/store', [CustomerController::class, 'store'])->name('customer.store');
Route::post('/set-customer/{unitId}', [SellUnitController::class, 'setCustomer'])->name('set.customer');


/*
|--------------------------------------------------------------------------
| VIEW MARKETING (sementara static)
|--------------------------------------------------------------------------
*/
// Route::get('/dashboard-list-pengajuan', fn() => view('marketing.list_pengajuan'));
Route::get('marketing/list-pengajuan', [ListPengajuanController::class, 'index'])->name('marketing.list_pengajuan');
Route::get('/dashboard-cash', fn() => view('marketing.cash'));
Route::get('/dashboard-approved', fn() => view('marketing.approved'));
Route::get('/dashboard-akad', fn() => view('marketing.akad'));
Route::get('/dashboard-vertifikasi-kpr', fn() => view('marketing.vertifikasi_kpr'));
Route::get('/dashboard-survey', fn() => view('marketing.survey'));



/*
|--------------------------------------------------------------------------
| CETAK
|--------------------------------------------------------------------------
*/
Route::get('/dashboard-cetak-laporan', fn() => view('cetak.laporan'));
Route::get('/dashboard-cetak-invoice-cash', fn() => view('cetak.invoice_cash'));
// Route::get('/dashboard-cetak-rab', fn() => view('cetak.rab'));
Route::get('/dashboard-cetak-rab/{unit_id}', [RABController::class, 'index'])->name('cetak.rab');



/*
|--------------------------------------------------------------------------
| ========================= PROPERTI =========================
|--------------------------------------------------------------------------
*/

// list properti
Route::get('/properti', [PropertyController::class, 'index'])->name('properti-all');

// tambah properti
Route::get('/properti-create', [LandBankController::class, 'index'])->name('properti');
Route::post('/properti/create', [LandBankController::class, 'store'])->name('properti.store');


/*
|--------------------------------------------------------------------------
| VERIFIKASI LEGAL
|--------------------------------------------------------------------------
*/
Route::get('/properti/verifikasi-legal/{id}',[LandBankController::class, 'verifikasiLegal'])->name('properti.verifikasi');

Route::post('/dokumen/{id}/approve',[LandBankController::class, 'approveDocument'])->name('dokumen.approve');
Route::post('/dokumen/{id}/reject',[LandBankController::class, 'rejectDocument'])->name('dokumen.reject');

Route::post('/properti/{id}/approve-all',[LandBankController::class, 'approveAllDocuments'])->name('properti.approveAll');
Route::post('/properti/{id}/reject-all',[LandBankController::class, 'rejectAllDocuments'])->name('properti.rejectAll');

Route::post('/properti/{id}/update-revisi',[LandBankController::class, 'updateRevisi'])->name('properti.updateRevisi');
Route::post('/dokumen/{id}/update',[LandBankController::class, 'updateDocument'])->name('dokumen.update');

Route::get('/properti-revisi/{id}',[LandBankController::class, 'revisi'])->name('properti.revisi');


/*
|--------------------------------------------------------------------------
| ========================= KAVLING =========================
|--------------------------------------------------------------------------
*/
Route::get('/kavling',[PropertyController::class, 'kavlingindex'])->name('kavling.index');

Route::get('/properti-buat-kavling/{land_bank_id}',[LandBankUnitController::class, 'create'])->name('properti.buatKavling');
Route::post('/properti-buat-kavling/{land_bank_id}/store',[LandBankUnitController::class, 'store'])->name('properti.storeKavling');
Route::post('/properti-buat-kavling/{land_bank_id}/generate',[LandBankUnitController::class, 'generate'])->name('properti.generateKavling');

// edit kavling
Route::get('/properti/kavling/{unit}/edit',[LandBankUnitController::class, 'edit'])->name('properti.kavling.edit');
Route::put('/properti/kavling/{unit}',[LandBankUnitController::class, 'update'])->name('properti.kavling.update');
Route::delete('/properti/kavling/{unit}',[LandBankUnitController::class, 'destroy'])->name('properti.kavling.destroy');


/*
|--------------------------------------------------------------------------
| PROGRESS PEMBANGUNAN
|--------------------------------------------------------------------------
*/
Route::get('properti/kavling/{unit}/update-progress',[LandBankUnitController::class, 'updateProgress'])->name('properti.kavling.updateProgress');

Route::post('/properti/progress/acc-ajax/{unit}',[DevelopmentProgressController::class, 'accAjax'])->name('properti.progress.acc.ajax');
Route::post('/progress/{item}/upload',[DevelopmentProgressController::class, 'uploadDocumentation'])->name('progress.uploadDocumentation');

Route::get('/properti/progress/{land_bank_id}',[DevelopmentProgressController::class, 'index'])->name('properti.progress');
Route::post('/properti/progress/store',[DevelopmentProgressController::class, 'store'])->name('properti.progress.store');


/*
|--------------------------------------------------------------------------
| ========================= AGENCY / SALES =========================
|--------------------------------------------------------------------------
*/
Route::get('/Agency-Create',[AgencyPropertyController::class, 'index'])->name('agency');
Route::post('/agency/store',[AgencyPropertyController::class,'store'])->name('agency.store');

/*
|--------------------------------------------------------------------------
| PENGAJUAN
|--------------------------------------------------------------------------*/
Route::get('/pengajuan', [KprApplicationController::class, 'index'])->name('pengajuan.index');
Route::post('/pengajuan/store', [KprApplicationController::class, 'store'])->name('kpr.store');
Route::get('/pengajuan/search-customer',
[CustomerController::class, 'search'])->name('pengajuan.search-customer');


Route::get('/master-data-bank',[BankController::class, 'index'])->name('bank.index');
Route::post('/master-data-bank/store',[BankController::class, 'store'])->name('bank.store');