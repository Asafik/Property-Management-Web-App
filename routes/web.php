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
use App\Http\Controllers\CashController;
use App\Http\Controllers\Marketing\CustomerController;
use App\Http\Controllers\Marketing\SellUnitController;
use App\Http\Controllers\ListPengajuanController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\LokasiController;
use App\Http\Controllers\CompanyProfileController;
use App\Http\Controllers\PengajuanController;

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.proses');
});


Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth'])->group(function () {

    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| ========================= MARKETING =========================
|--------------------------------------------------------------------------
*/

Route::get('/marketing/sell-unit', [SellUnitController::class, 'index'])->name('marketing.jual-unit');
Route::post('/marketing/set-agency/{unitId}', [SellUnitController::class, 'setAgency'])->name('marketing.setAgency');

Route::get('/marketing/create-customer', [CustomerController::class, 'index'])->name('marketing.tambah_customer');
Route::post('/marketing/create-customer/store', [CustomerController::class, 'store'])->name('customer.store');
Route::post('/set-customer/{unitId}', [SellUnitController::class, 'setCustomer'])->name('set.customer');
Route::get('/marketing/jual-unit/export/excel', [SellUnitController::class, 'exportExcel'])
    ->name('marketing.jual-unit.export.excel');

Route::get('/marketing/jual-unit/export/pdf', [SellUnitController::class, 'exportPdf'])
    ->name('marketing.jual-unit.export.pdf');

/*
|--------------------------------------------------------------------------
| VIEW MARKETING (sementara static)
|--------------------------------------------------------------------------
*/
// Route::get('/dashboard-list-pengajuan', fn() => view('marketing.list_pengajuan'));
Route::get('marketing/list-pengajuan', [ListPengajuanController::class, 'index'])->name('marketing.list_pengajuan');
// Route::get('/dashboard-cash', fn() => view('marketing.cash'));
Route::get('/dashboard-cash/{booking}', [ListPengajuanController::class, 'show'])->name('marketing.cash');
Route::put('/bookings/{booking}/update-nego', [BookingController::class, 'updateNego'])
    ->name('bookings.updateNego');
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
// Route::get('/dashboard-cetak-invoice-cash', fn() => view('cetak.invoice_cash'));
// Route untuk halaman web (dengan 2 tab)
Route::get('/dashboard-cetak-invoice-cash/{booking}', [InvoiceController::class, 'index'])
    ->name('cetak.invoice_cash');

// Route untuk download PDF Cash Awal
Route::get('/dashboard-cetak-invoice-cash/{booking}/pdf', [InvoiceController::class, 'cetakPdf'])
    ->name('dashboard.cetak.invoice.cash.pdf');

// Route untuk download PDF Konversi
Route::get('/dashboard-cetak-invoice-konversi/{booking}/pdf', [InvoiceController::class, 'cetakPdfKonversi'])
    ->name('dashboard.cetak.invoice.konversi.pdf');

Route::post('/payments', [PaymentController::class, 'store'])->name('payments.store');
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
Route::get('/properti/verifikasi-legal/{id}', [LandBankController::class, 'verifikasiLegal'])->name('properti.verifikasi');

Route::post('/dokumen/{id}/approve', [LandBankController::class, 'approveDocument'])->name('dokumen.approve');
Route::post('/dokumen/{id}/reject', [LandBankController::class, 'rejectDocument'])->name('dokumen.reject');

Route::post('/properti/{id}/approve-all', [LandBankController::class, 'approveAllDocuments'])->name('properti.approveAll');
Route::post('/properti/{id}/reject-all', [LandBankController::class, 'rejectAllDocuments'])->name('properti.rejectAll');

Route::post('/properti/{id}/update-revisi', [LandBankController::class, 'updateRevisi'])->name('properti.updateRevisi');
Route::post('/dokumen/{id}/update', [LandBankController::class, 'updateDocument'])->name('dokumen.update');

Route::get('/properti-revisi/{id}', [LandBankController::class, 'revisi'])->name('properti.revisi');


/*
|--------------------------------------------------------------------------
| ========================= KAVLING =========================
|--------------------------------------------------------------------------
*/
Route::get('/kavling', [PropertyController::class, 'kavlingindex'])->name('kavling.index');
Route::get('/properti-buat-kavling/template', [LandBankUnitController::class, 'downloadTemplate'])->name('kavling.template');
Route::get('/properti-buat-kavling/{land_bank_id}', [LandBankUnitController::class, 'create'])->name('properti.buatKavling');
Route::post('/properti-buat-kavling/{land_bank_id}/store', [LandBankUnitController::class, 'store'])->name('properti.storeKavling');
Route::post('/properti-buat-kavling/{land_bank_id}/import',[LandBankUnitController::class, 'import'])->name('kavling.import');


// edit kavling
Route::get('/properti/kavling/{unit}/edit', [LandBankUnitController::class, 'edit'])->name('properti.kavling.edit');
Route::put('/properti/kavling/{unit}', [LandBankUnitController::class, 'update'])->name('properti.kavling.update');
Route::delete('/properti/kavling/{unit}', [LandBankUnitController::class, 'destroy'])->name('properti.kavling.destroy');


/*
|--------------------------------------------------------------------------
| PROGRESS PEMBANGUNAN
|--------------------------------------------------------------------------
*/
Route::get('properti/kavling/{unit}/update-progress', [LandBankUnitController::class, 'updateProgress'])->name('properti.kavling.updateProgress');

Route::post('/properti/progress/acc-ajax/{unit}', [DevelopmentProgressController::class, 'accAjax'])->name('properti.progress.acc.ajax');
Route::post('/progress/{item}/upload', [DevelopmentProgressController::class, 'uploadDocumentation'])->name('progress.uploadDocumentation');

Route::get('/properti/progress/{land_bank_id}', [DevelopmentProgressController::class, 'index'])->name('properti.progress');
Route::post('/properti/progress/store', [DevelopmentProgressController::class, 'store'])->name('properti.progress.store');


/*
|--------------------------------------------------------------------------
| ========================= AGENCY / SALES =========================
|--------------------------------------------------------------------------
*/
Route::get('/Agency-Create', [AgencyPropertyController::class, 'index'])->name('agency');
Route::post('/agency/store', [AgencyPropertyController::class, 'store'])->name('agency.store');

/*
|--------------------------------------------------------------------------
| PENGAJUAN
|--------------------------------------------------------------------------*/
Route::get(
    '/pengajuan/{booking}',
    [KprApplicationController::class, 'show']
)->name('pengajuan.show');

Route::post('/pengajuan/store', [KprApplicationController::class, 'store'])->name('pengajuan.store');
Route::get(
    '/pengajuan/search-customer',
    [CustomerController::class, 'search']
)->name('pengajuan.search-customer');

// Route::get('/dashboard-cash-pengajuan', function () {
//     return view('marketing.cash_pengajuan');
// });

Route::get('/dashboard-cash-pengajuan', [CashController::class, 'index'])->name('marketing.cash_pengajuan');

Route::get('/master-data-bank', [BankController::class, 'index'])->name('bank.index');
Route::post('/master-data-bank/store', [BankController::class, 'store'])->name('bank.store');

Route::get('/dashboard-akad-cash', function () {
    return view('marketing.akad_cash');
});

Route::get('/dashboard-cash-dokument-legal', function () {
    return view('marketing.cash_dokument_legal');
});


// Route::get('/dashboard-lokasi', function () {
//     return view('lokasi.lokasi');
// });
Route::get('/dashboard-lokasi', [LokasiController::class, 'index'])->name('lokasi.index');
Route::get('/lokasi-data', [LokasiController::class, 'lokasiData']); // Untuk JSON


Route::get('/dashboard-promo', function () {
    return view('promo.promo');
});

// Route::get('/dashboard-pt', function () {
//     return view('pt.pt');
// });
Route::get('/dashboard-pt', [CompanyProfileController::class, 'index'])->name('company-profile.index');
Route::post('/dashboard-pt/store', [CompanyProfileController::class, 'store'])->name('company-profile.store');
Route::delete('/dashboard-pt/{companyProfile}', [CompanyProfileController::class, 'destroy'])->name('company-profile.destroy');
Route::get('/company/{id}/projects', [CompanyProfileController::class, 'getProjects']);
Route::put('/dashboard-pt/{companyProfile}', [CompanyProfileController::class, 'update'])->name('company-profile.update');
Route::get('/dashboard-servis', function () {
    return view('servis.servis');
});


Route::get('/dashboard-dokument', function () {
    return view('dokument.dokument');
});



Route::get('/dashboard-pengaturan', function () {
    return view('setting.setting');
});

Route::get('/dashboard-customer', function () {
    return view('customer.customer');
});

Route::get('/dashboard-tamu', function () {
    return view('customer.tamu');
});


});



