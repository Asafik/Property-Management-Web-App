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
use App\Http\Controllers\LandBankDocumentController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\SiteplanController;
use App\Http\Controllers\PromoController;
use App\Http\Controllers\TamuController;
use App\Http\Controllers\AkadController;
use App\Http\Controllers\CustomerKPRRijectedController;
use App\Http\Controllers\DivisionController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\DocumentLegalController;
use App\Http\Controllers\DocumentPersiapanPecahLegalController;
use App\Http\Controllers\DokumentLegalPersiapanController;
use App\Http\Controllers\PraLandBankController;
use App\Http\Controllers\RABDeadlineController;
use App\Http\Controllers\SerahTerimaController;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\TransaksiKPRController;
use App\Http\Controllers\CompanySettingController;
use App\Http\Controllers\TimelineCashTempoController;

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

Route::middleware(['auth','position:manager,admin,staff,marketing'])->group(function () {

    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| ========================= MARKETING =========================
|--------------------------------------------------------------------------
*/

Route::get('/marketing/sell-unit', [SellUnitController::class, 'index'])->name('marketing.jual-unit');
Route::post('/marketing/set-agency/{unitId}', [SellUnitController::class, 'setAgency'])->name('marketing.setAgency');
Route::post('/unit/save-position', [SellUnitController::class,'savePosition'])
->name('unit.save.position');

Route::post('/set-customer/{unitId}', [SellUnitController::class, 'setCustomer'])->name('set.customer');
Route::get('/marketing/jual-unit/export/excel', [SellUnitController::class, 'exportExcel'])
    ->name('marketing.jual-unit.export.excel');

Route::get('/marketing/jual-unit/export/pdf', [SellUnitController::class, 'exportPdf'])
    ->name('marketing.jual-unit.export.pdf');

    Route::get('marketing/list-pengajuan', [ListPengajuanController::class, 'index'])->name('marketing.list_pengajuan');

/*
|--------------------------------------------------------------------------
| VIEW MARKETING (sementara static)
|--------------------------------------------------------------------------
*/
// Route::get('/dashboard-list-pengajuan', fn() => view('marketing.list_pengajuan'));

// Route::get('/dashboard-cash', fn() => view('marketing.cash'));
Route::get('/dashboard-cash/{booking}', [ListPengajuanController::class, 'show'])->name('marketing.cash');
Route::put('/bookings/{booking}/update-nego', [BookingController::class, 'updateNego'])
    ->name('bookings.updateNego');
Route::get('/dashboard-approved', fn() => view('marketing.approved'));
Route::get('/dashboard-akad', fn() => view('marketing.akad'));

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
    Route::get('/invoice/{id}/wa', [InvoiceController::class, 'sendToWa'])
    ->name('cetak.invoice_wa');

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
Route::get('/all-properti', [PropertyController::class, 'index'])->name('properti-all');
Route::get('/all-pra-landbank', [PraLandBankController::class, 'indexpra'])->name('pralandbank.all');
// tambah properti
Route::get('/create-landbank', [LandBankController::class, 'index'])->name('properti');
Route::get('/create-pralandbank', [PraLandBankController::class, 'index'])->name('pra-landbank');
Route::post('/properti/pra-landbank/store', [PraLandBankController::class, 'store'])->name('pra-landbanks.store');
Route::post('/properti/create', [LandBankController::class, 'store'])->name('properti.store');
Route::get('/properti/verifikasi-legal/{id}', [LandBankController::class, 'verifikasiLegal'])->name('properti.verifikasi');


/*
|--------------------------------------------------------------------------
| VERIFIKASI LEGAL
|--------------------------------------------------------------------------
*/

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
Route::delete('/properti/progress/item/{itemId}', [DevelopmentProgressController::class, 'destroy'])->name('properti.progress.item.destroy');


/*
|--------------------------------------------------------------------------
| ========================= AGENCY / SALES =========================
|--------------------------------------------------------------------------
*/

/*
|--------------------------------------------------------------------------
| PENGAJUAN
|--------------------------------------------------------------------------*/
Route::get(
    '/pengajuan/{booking}',
    [KprApplicationController::class, 'show']
)->name('pengajuan.show');

Route::post('/pengajuan/store', [KprApplicationController::class, 'store'])->name('pengajuan.store');
Route::get('/kpr/serah-terima/{id}', [KprApplicationController::class, 'serahTerima'])->name('kpr.serahterima');
Route::get('/kpr/pecah-legal/{id}', [KprApplicationController::class, 'pecahLegal'])
    ->name('kpr.pecahlegal');
Route::get(
    '/pengajuan/search-customer',
    [CustomerController::class, 'search']
)->name('pengajuan.search-customer');

// Route::get('/dashboard-cash-pengajuan', function () {
//     return view('marketing.cash_pengajuan');
// });

Route::get('/marketing/cash/{booking}', [CashController::class, 'index'])->name('marketing.cash_tempo');
Route::post('/marketin/cash-tempo/store', [CashController::class, 'store'])->name('cash-tempo.store');

// Route::get('/dashboard-akad-cash', function () {
//     return view('marketing.akad_cash');
// });

Route::get('/dashboard-cash-dokument-legal', function () {
    return view('marketing.cash_dokument_legal');
});


// Route::get('/dashboard-lokasi', function () {
//     return view('lokasi.lokasi');

// });
Route::prefix('lokasi')->name('lokasi.')->group(function () {
    Route::get('/', [LokasiController::class, 'index'])->name('index');
    Route::get('/data', [LokasiController::class, 'lokasiData'])->name('data'); // Untuk JSON

});


// Route::get('/dashboard-promo', function () {
//     return view('promo.promo');
// });

// Route::get('/dashboard-pt', function () {
//     return view('pt.pt');
// });





Route::get('/servis', function () {
    return view('servis.servis');
});


// Route::get('/dashboard-dokument', function () {
//     return view('dokument.dokument');
// });




// Route untuk Dokument Legal Persiapan
Route::get('/dokument-persiapan', [DokumentLegalPersiapanController::class, 'index'])
    ->name('dokument.persiapan');
    Route::post('/documents/persiapan-pecah-legal', [DocumentPersiapanPecahLegalController::class, 'store'])
    ->name('documents.storePersiapanPecahLegal');
    Route::delete('/documents/{id}', [DocumentPersiapanPecahLegalController::class, 'destroy'])
    ->name('documents.destroy');

Route::post('/documents/{booking}/store', [DokumentLegalPersiapanController::class, 'store'])
    ->name('document_legal.store');


Route::get('/siteplan/{id}', [SiteplanController::class, 'show'])->name('siteplan.show');




Route::get('/customer/guest', [TamuController::class, 'index'])->name('customer.tamu');
Route::post('/customer/guest/store', [TamuController::class, 'store'])->name('customer.tamu.store');
Route::post('/customer/guest/follow-up', [TamuController::class, 'followUp'])->name('customer.tamu.followup');
Route::post('/customer/guest/{id}/convert', [TamuController::class, 'convert'])
    ->name('costomer.guests.convert');
Route::get('/customer/guest/{id}/edit', [TamuController::class, 'editAjax']);
Route::put('/customer/guest/{id}', [TamuController::class, 'update']);


Route::get('/akad/akad-cash/{booking}', [AkadController::class, 'index'])->name('akad.cash');
Route::post('/akad/akad-cash/{booking}/store', [AkadController::class, 'store'])->name('akad.cash.store');
Route::get('/akad/akad-cash/serah-terima/{booking}', [SerahTerimaController::class, 'index'])->name('booking.serah-terima');
Route::post('/akad/akad-cash/serah-terima/{booking}/store', [SerahTerimaController::class, 'store'])->name('serah-terima.store');

// Route::get('/akad-serah-unit', function () {
//     return view('marketing.serah_unit');
// });

Route::get('/data-dokument/user/persiapan/legal', [DocumentPersiapanPecahLegalController::class, 'index'])->name('document.user.persiapan-legal');
Route::get('/document-legal/detail/{booking}', [DocumentPersiapanPecahLegalController::class,'detail'])
->name('document_legal.detail');
Route::get('persiapan-dokument-legal/cash/{booking}', [DocumentLegalController::class, 'index'])->name('cash.document.legal');
Route::post('persiapan-dokument-legal/cash/store', [DocumentLegalController::class, 'store'])->name('document_legal.store');


Route::get('/customer-profil-cash', function () {
    return view('customer.customer_profil_cash');
});

Route::get('/customer-profil-kpr', function () {
    return view('customer.customer_profil_kpr');
});


// Route untuk Customer KPR
Route::get('/customer-kpr', [TransaksiKPRController::class, 'index'])->name('customer.kpr');

Route::get('/transaksi/kpr/{booking}/approve', [TransaksiKPRController::class, 'approve'])->name('transaksi.kpr.approve');

Route::post('/transaksi/kpr/{booking}/verifikasi', [TransaksiKPRController::class, 'storeVerifikasi'])->name('kpr.verifikasi.store');

Route::get('/transaksi/kpr/verified', [TransaksiKPRController::class, 'verified'])->name('kpr.customer-verified');

Route::get('/transaksi/kpr/{kprApplication}/survey', [TransaksiKPRController::class, 'survey'])->name('kpr.survey');

Route::get('/transaksi/kpr/{id}/akad', [TransaksiKPRController::class, 'akad'])->name('kpr.akad');
Route::get('/transaksi/kpr/akad-kpr/{id}', [AkadController::class, 'akadkpr'])->name('kpr.approve');

// Route untuk Customer KPR ACC (Survey)
Route::get('/customer-kpr-acc', [SurveyController::class, 'index'])->name('customer.kpr.survey');
Route::get('/customer-kpr-rijected', [CustomerKPRRijectedController::class, 'index'])->name('customer.kpr.rijected');
Route::post('/kpr/survey/{kprId}/store', [SurveyController::class, 'store'])->name('kpr.survey.store');


// Route::get('/dashboard-dedline-rab', function () {
//     return view('properti.dedline_rab');

// Route::get('/rab-deadline/{progressId}', [RABDeadlineController::class, 'index'])->name('rab.deadline.index');

Route::get('/rab-deadline', [RABDeadlineController::class, 'index'])->name('rab.deadline.index');

Route::get('/survey-komersil', function () {
    return view('marketing.survey_komersil');
});

// Route::get('/devisi', function () {
//     return view('master_data.devisi');
// });


// MASTER DATA USER/CUSTOMER
Route::get('/data-customer', [CustomerController::class, 'customerData'])->name('customer.data');
Route::get('/customer/create', [CustomerController::class, 'create'])->name('customer.create');
Route::post('/customer/store', [CustomerController::class, 'store'])->name('customer.store');
// Route::get('/customer/search', [CustomerController::class, 'search'])->name('customer.search');


// MASTER DATA DOKUMEN PASCA LANDBANK/DOKUMEN TYPE
Route::get('/dokument-tanah-induk', [LandBankDocumentController::class, 'index'])->name('dokument.index');
Route::post('/dokument/store', [LandBankDocumentController::class, 'store'])->name('document-types.store');
Route::get('/dokument/{id}/edit', [LandBankDocumentController::class, 'edit'])->name('document-types.edit');
Route::put('/dokument/{id}/update', [LandBankDocumentController::class, 'update'])->name('document-types.update');
Route::delete('/dokument/{id}/delete', [LandBankDocumentController::class, 'destroy'])->name('document-types.destroy');




// EMPLOYEE/AGENCY
Route::get('/agency', [AgencyPropertyController::class, 'index'])->name('agency.index');
Route::get('/agency/create', [AgencyPropertyController::class, 'create'])->name('agency.create');
Route::post('/agency/store', [AgencyPropertyController::class, 'store'])->name('agency.store');
Route::get('/agency/{id}/edit', [AgencyPropertyController::class, 'edit'])->name('agency.edit');
Route::put('/agency/{id}', [AgencyPropertyController::class, 'update'])->name('agency.update');
Route::delete('/agency/{id}', [AgencyPropertyController::class, 'destroy'])->name('agency.destroy');
// MASTER DATA PROMO
Route::get('/promo', [PromoController::class, 'index'])->name('promo.index');
Route::post('/promo/store', [PromoController::class, 'store'])->name('promo.store');
Route::get('/promo/{id}/edit', [PromoController::class, 'edit'])->name('promo.edit');
Route::put('/promo/{id}', [PromoController::class, 'update'])->name('promo.update');
Route::delete('/promo/{id}', [PromoController::class, 'destroy'])->name('promo.destroy');
Route::get('/promo/{id}', [PromoController::class, 'show'])->name('promo.show');
Route::get('/promo/get/{id}', [PromoController::class, 'getPromo'])->name('promo.get');
// MASTER DATA PT/COMPANY
Route::get('/pt', [CompanyProfileController::class, 'index'])->name('company-profile.index');
Route::post('/pt/store', [CompanyProfileController::class, 'store'])->name('company-profile.store');
Route::get('/pt/{companyProfile}/edit', [CompanyProfileController::class, 'edit'])->name('company-profile.edit');
Route::put('/pt/{companyProfile}', [CompanyProfileController::class, 'update'])->name('company-profile.update');
Route::delete('/pt/{companyProfile}', [CompanyProfileController::class, 'destroy'])->name('company-profile.destroy');
Route::get('/company/{id}/projects', [CompanyProfileController::class, 'getProjects']);
// MASTER DATA BANK
Route::get('/master-data-bank', [BankController::class, 'index'])->name('bank.index');
Route::post('/master-data-bank/store', [BankController::class, 'store'])->name('bank.store');
Route::get('/master-data-bank/{id}/edit', [BankController::class, 'edit'])->name('bank.edit');
Route::put('/master-data-bank/{id}', [BankController::class, 'update'])->name('bank.update');
Route::delete('/master-data-bank/{id}', [BankController::class, 'destroy'])->name('bank.destroy');
// MASTER DATA DIVISION
Route::get('/master-data/division', [DivisionController::class, 'index'])->name('master.data.division.index');
Route::post('/master-data/division/store', [DivisionController::class, 'store'])->name('master.data.division.store');
Route::put('/master-data/division/update/{id}', [DivisionController::class, 'update'])->name('master.data.division.update');
Route::delete('/master-data/division/{id}', [DivisionController::class, 'destroy'])->name('master.data.division.delete');
// MASTER DATA POSITION
Route::get('/master-data/posisi', [PositionController::class, 'index'])->name('master.data.posisi');
Route::post('/master-data/posisi/store', [PositionController::class, 'store'])->name('master.data.posisi.store');
Route::put('/master-data/posisi/update/{position}', [PositionController::class, 'update'])->name('master.data.posisi.update');
Route::delete('/master-data/posisi/{position}', [PositionController::class, 'destroy'])->name('master.data.posisi.delete');
Route::get('/master-data/posisi/get-by-division/{divisionId}', [PositionController::class, 'getByDivision'])->name('master.data.posisi.by-division');


// Route::get('/done', function () {
//     return view('marketing.done_sell');
// });
Route::get('customer/unit/booking/done/{bookingId}', [SerahTerimaController::class, 'SellDone'])
     ->name('unit.selesai');

// Route halaman pengaturan
Route::get('/pengaturan', [CompanySettingController::class, 'index'])->name('setting.index');
Route::post('/pengaturan', [CompanySettingController::class, 'update'])->name('setting.update');

// Route::get('/all-pra-landbank', function () {
//     return view('land_bank.all_pra_land_bank');
// });

// Route::get('/cash-tempo-timline', function () {
//     return view('transaksi.timline_pembayaran');
// });
Route::get('/cash-tempo-timeline', [TimelineCashTempoController::class, 'index'])->name('cash-tempo.timeline');
Route::get('/cash-tempo/timeline/{id}', [TimelineCashTempoController::class,'timeline']);
Route::post('/cash-tempo/update', [TimelineCashTempoController::class, 'update'])->name('cash-tempo.update');
Route::post('/cash-tempo/payments', [TimelineCashTempoController::class, 'storePayment'])->name('cash-tempo.storePayment');
});



