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
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\TransaksiKPRController;
use App\Http\Controllers\CompanySettingController;
use App\Http\Controllers\LandingpageController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\TimelineCashTempoController;
use App\Http\Controllers\DocumentPreviewController;
use App\Http\Controllers\JobStaffMarketingController;
use App\Http\Controllers\DocumentTypeController;
use App\Http\Controllers\SpkController;
use App\Http\Controllers\Finance\InvoiceMasterController;
use App\Http\Controllers\Finance\ProjectAccountingController;

/*
|--------------------------------------------------------------------------
| Landing Page
|--------------------------------------------------------------------------
*/

Route::get('/beranda', function () {
    return view('home.index');
});

Route::get('/detail', function () {
    return view('home.detail');
})->name('home.detail');
/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.proses');
});

Route::get('/', [LandingpageController::class, 'index'])->name('landingpage');
// Route::get('/', function () {
//     return redirect()->route('login');
// });

Route::middleware(['auth', 'position:1,2,3,4,5,6'])->group(function () {

    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/detail/{id}', [DashboardController::class, 'show'])->name('dashboard.detail');
    Route::get('/proyek/refresh', [DashboardController::class, 'refresh']);
    Route::get('/notifications/read/{id}', function ($id) {
        $notif = auth()->user()->notifications()->find($id);

        if ($notif) {
            $notif->markAsRead();
            return redirect($notif->data['url'] ?? '/');
        }

        return back();
    })->name('notifications.read');

    /*
    |--------------------------------------------------------------------------
    | ========================= MARKETING =========================
    |--------------------------------------------------------------------------
    */

    Route::get('/marketing/sell-unit', [SellUnitController::class, 'index'])->name('marketing.jual-unit');
    Route::post('/marketing/set-agency/{unitId}', [SellUnitController::class, 'setAgency'])->name('marketing.setAgency');
    Route::post('/unit/save-position', [SellUnitController::class, 'savePosition'])
        ->name('unit.save.position');

    Route::post('/set-customer/{unitId}', [SellUnitController::class, 'setCustomer'])->name('set.customer');
    Route::get('/marketing/jual-unit/export/excel', [SellUnitController::class, 'exportExcel'])
        ->name('marketing.jual-unit.export.excel');

    Route::get('/marketing/jual-unit/export/pdf', [SellUnitController::class, 'exportPdf'])
        ->name('marketing.jual-unit.export.pdf');

    // Master Aturan Komisi Agent
    Route::get('/marketing/commission-rules', [SellUnitController::class, 'commissionRulesIndex'])
        ->name('marketing.commission-rules.index');
    Route::post('/marketing/commission-rules/store', [SellUnitController::class, 'storeCommissionRule'])
        ->name('marketing.commission-rules.store');
    Route::put('/marketing/commission-rules/{id}', [SellUnitController::class, 'updateCommissionRule'])
        ->name('marketing.commission-rules.update');
    Route::delete('/marketing/commission-rules/{id}', [SellUnitController::class, 'destroyCommissionRule'])
        ->name('marketing.commission-rules.destroy');
    Route::post('/marketing/commission-rules/{id}/toggle', [SellUnitController::class, 'toggleCommissionRule'])
        ->name('marketing.commission-rules.toggle');
    Route::get('/marketing/commission-rules/calculate', [SellUnitController::class, 'calculateCommissionApi'])
        ->name('marketing.commission-rules.calculate');

    Route::get('marketing/list-pengajuan', [ListPengajuanController::class, 'index'])->name('marketing.list_pengajuan');
    Route::delete('/marketing/pengajuan/{id}', [ListPengajuanController::class, 'destroy'])
    ->name('pengajuan.destroy');

    Route::get('/document-preview', [DocumentPreviewController::class, 'preview'])->name('document.preview');

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
    Route::get('/properti/all', [PropertyController::class, 'index'])->name('properti.all');
    Route::get('/all-pra-landbank', [PraLandBankController::class, 'indexpra'])->name('pralandbank.all');
    Route::get('/properti/pra-landbank/proses/{id?}', [PraLandBankController::class, 'proses'])->name('pra-landbank.proses');
    Route::get('/properti/pra-landbank/invoice/{id}', [PraLandBankController::class, 'invoice'])->name('pra-landbank.invoice');
    // tambah properti
    Route::get('/create-landbank', [LandBankController::class, 'index'])->name('properti');
    Route::get('/create-pralandbank', [PraLandBankController::class, 'index'])->name('pra-landbank');
    Route::post('/properti/pra-landbank/store', [PraLandBankController::class, 'store'])->name('pra-landbanks.store');
    Route::delete('/properti/pra-landbank/{id}', [PraLandBankController::class, 'destroy'])->name('pra-landbanks.destroy');
    Route::post('/pra-landbank/dokumen/{id}/approve', [PraLandBankController::class, 'approveDocument'])->name('pra-dokumen.approve');
    Route::post('/pra-landbank/dokumen/{id}/reject', [PraLandBankController::class, 'rejectDocument'])->name('pra-dokumen.reject');
    Route::post('/pra-landbank/dokumen/{id}/upload-completed', [PraLandBankController::class, 'uploadCompletedDocument'])->name('pra-dokumen.upload-completed');
    Route::post('/properti/create', [LandBankController::class, 'store'])->name('properti.store');
    Route::get('/properti/verifikasi-legal/{id}', [LandBankController::class, 'verifikasiLegal'])->name('properti.verifikasi');
    Route::post('/properti/{id}/update-company', [PropertyController::class, 'updateCompanyAjax'])->name('properti.updateCompany');
    Route::post('/properti/{id}/update', [PropertyController::class, 'update'])->name('properti.update');
    Route::get('/properti/{id}/edit', [PropertyController::class, 'edit'])->name('properti.edit');


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
    Route::post('/properti/{id}/update-legal-status', [LandBankController::class, 'updateLegalStatus'])->name('properti.updateLegalStatus');

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
    Route::post('/properti-buat-kavling/{land_bank_id}/import', [LandBankUnitController::class, 'import'])->name('kavling.import');
    Route::post('/properti-buat-kavling/{land_bank_id}/assign-spk', [LandBankUnitController::class, 'assignSpk'])->name('properti.kavling.assignSpk');


    // edit kavling
    Route::get('/properti/kavling/{unit}/edit', [LandBankUnitController::class, 'edit'])->name('properti.kavling.edit');
    Route::put('/properti/kavling/{unit}', [LandBankUnitController::class, 'update'])->name('properti.kavling.update');
    Route::delete('/properti/kavling/{unit}', [LandBankUnitController::class, 'destroy'])->name('properti.kavling.destroy');


    /*
    |--------------------------------------------------------------------------
    | PROGRESS PEMBANGUNAN UNIT (RAP) & PENGOLAHAN LAHAN (SITE DEVELOPMENT)
    |--------------------------------------------------------------------------
    */
    Route::get('/properti-pengolahan-lahan/{land_bank_id}', [\App\Http\Controllers\Admin\LandBankInfrastructureController::class, 'index'])->name('properti.pengolahanLahan');
    Route::get('/properti/{land_bank_id}/pengolahan-lahan', [\App\Http\Controllers\Admin\LandBankInfrastructureController::class, 'index'])->name('properti.pengolahan-lahan');
    Route::get('/properti/pengolahan_lahan/{land_bank_id}', [\App\Http\Controllers\Admin\LandBankInfrastructureController::class, 'index']);
    Route::get('/properti pengolahan lahan/{land_bank_id}', [\App\Http\Controllers\Admin\LandBankInfrastructureController::class, 'index']);
    Route::get('/properti/{land_bank_id}/infrastruktur', [\App\Http\Controllers\Admin\LandBankInfrastructureController::class, 'getItems'])->name('properti.infrastruktur.get');
    Route::post('/properti/{land_bank_id}/infrastruktur/store', [\App\Http\Controllers\Admin\LandBankInfrastructureController::class, 'store'])->name('properti.infrastruktur.store');
    Route::post('/properti/infrastruktur/{id}/update', [\App\Http\Controllers\Admin\LandBankInfrastructureController::class, 'update'])->name('properti.infrastruktur.update');
    Route::delete('/properti/infrastruktur/{id}', [\App\Http\Controllers\Admin\LandBankInfrastructureController::class, 'destroy'])->name('properti.infrastruktur.destroy');
    Route::post('/properti/{land_bank_id}/infrastruktur/finalize', [\App\Http\Controllers\Admin\LandBankInfrastructureController::class, 'finalizeStatus'])->name('properti.infrastruktur.finalize');
    Route::post('/properti/{land_bank_id}/infrastruktur/phase/{phase}/finalize', [\App\Http\Controllers\Admin\LandBankInfrastructureController::class, 'finalizePhase'])->name('properti.infrastruktur.phase.finalize');

    // Pencatatan Realisasi Keuangan & Pemakaian Bahan Pengolahan Lahan
    Route::post('/properti/{land_bank_id}/infrastruktur/expense/store', [\App\Http\Controllers\Admin\LandBankInfrastructureController::class, 'storeExpense'])->name('properti.infrastruktur.expense.store');
    Route::post('/properti/infrastruktur/expense/{id}/update', [\App\Http\Controllers\Admin\LandBankInfrastructureController::class, 'updateExpense'])->name('properti.infrastruktur.expense.update');
    Route::delete('/properti/infrastruktur/expense/{id}', [\App\Http\Controllers\Admin\LandBankInfrastructureController::class, 'destroyExpense'])->name('properti.infrastruktur.expense.destroy');

    // Master Bahan & Jasa Infrastruktur Pembangunan / Pengolahan Lahan
    Route::get('/master-data-bahan-infrastruktur', [\App\Http\Controllers\Admin\InfrastructureMaterialController::class, 'index'])->name('master.bahan.index');
    Route::get('/master-data-bahan-infrastruktur/{id}/edit', [\App\Http\Controllers\Admin\InfrastructureMaterialController::class, 'edit'])->name('master.bahan.edit');
    Route::post('/master-data-bahan-infrastruktur/store', [\App\Http\Controllers\Admin\InfrastructureMaterialController::class, 'store'])->name('master.bahan.store');
    Route::post('/master-data-bahan-infrastruktur/{id}/update', [\App\Http\Controllers\Admin\InfrastructureMaterialController::class, 'update'])->name('master.bahan.update');
    Route::delete('/master-data-bahan-infrastruktur/{id}', [\App\Http\Controllers\Admin\InfrastructureMaterialController::class, 'destroy'])->name('master.bahan.destroy');
    Route::get('/api/master-bahan-infrastruktur/search', [\App\Http\Controllers\Admin\InfrastructureMaterialController::class, 'searchApi'])->name('master.bahan.search');

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
    Route::get('/kpr/pecah-legal/{id}', [KprApplicationController::class, 'pecahLegal'])->name('kpr.pecahlegal');


    Route::get('/pengajuan/search-customer',[CustomerController::class, 'search'])->name('pengajuan.search-customer');

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





    Route::get('/servis', [ComplaintController::class, 'index'])->name('servis');
    Route::post('/complaints/store', [ComplaintController::class, 'store'])->name('complaints.store');
    Route::match(['put', 'post'], '/complaints/{id}/update', [ComplaintController::class, 'update'])->name('complaints.update');
    Route::delete('/complaints/{id}', [ComplaintController::class, 'destroy'])->name('complaints.destroy');

    // ==========================================
    // SISTEM KEUANGAN & PROJECT ACCOUNTING (ERP)
    // ==========================================
    Route::get('/keuangan/project-accounting', [ProjectAccountingController::class, 'index'])->name('keuangan.project-accounting.index');
    Route::get('/keuangan/project-accounting/cetak', [ProjectAccountingController::class, 'cetak'])->name('keuangan.project-accounting.cetak');
    Route::get('/keuangan/master-invoice', [InvoiceMasterController::class, 'index'])->name('keuangan.master-invoice.index');
    Route::get('/keuangan/master-invoice/export/excel', [InvoiceMasterController::class, 'exportExcel'])->name('keuangan.master-invoice.export');
    Route::post('/keuangan/master-invoice/sync', [InvoiceMasterController::class, 'syncPraLandbanks'])->name('keuangan.master-invoice.sync');
    Route::get('/keuangan/master-invoice/{id}', [InvoiceMasterController::class, 'show'])->name('keuangan.master-invoice.show');


    Route::resource('dokument', LandBankDocumentController::class);
    Route::get('/dokument-persiapan-pecah-unit', [DokumentLegalPersiapanController::class, 'index'])->name('dokument.persiapan');







    Route::get('/siteplan/{id}', [SiteplanController::class, 'show'])->name('siteplan.show');




    Route::get('/customer/guest', [TamuController::class, 'index'])->name('customer.tamu');
    Route::post('/customer/guest/store', [TamuController::class, 'store'])->name('customer.tamu.store');
    Route::post('/customer/guest/follow-up', [TamuController::class, 'followUp'])->name('customer.tamu.followup');
    Route::post('/customer/guest/{id}/convert', [TamuController::class, 'convert'])
        ->name('costomer.guests.convert');
    Route::get('/customer/guest/{id}/edit', [TamuController::class, 'editAjax']);
    Route::put('/customer/guest/{id}', [TamuController::class, 'update']);
    Route::delete('/customer/guest/{id}', [TamuController::class, 'destroy'])->name('customer.tamu.destroy');


    Route::get('/akad/akad-cash-keras/{booking}', [AkadController::class, 'index'])->name('akad.cash');
    Route::post('/akad/akad-cash/{booking}/store', [AkadController::class, 'store'])->name('akad.cash.store');
    Route::get('/akad/akad-cash/serah-terima/{booking}', [SerahTerimaController::class, 'index'])->name('booking.serah-terima');
    Route::post('/akad/akad-cash/serah-terima/{booking}/store', [SerahTerimaController::class, 'store'])->name('serah-terima.store');

    // Route::get('/akad-serah-unit', function () {
    //     return view('marketing.serah_unit');
    // });

    Route::get('/data-dokument/user/persiapan/legal', [DocumentPersiapanPecahLegalController::class, 'index'])->name('document.user.persiapan-legal');
    Route::get('/document-legal/detail/{booking}', [DocumentPersiapanPecahLegalController::class, 'detail'])
        ->name('document_legal.detail');
    Route::get('persiapan-dokument-legal/cash/{booking}', [DocumentLegalController::class, 'index'])->name('cash.document.legal');
    Route::post('persiapan-dokument-legal/cash/store/{booking}', [DocumentLegalController::class, 'store'])->name('document_legal.store');
    Route::post('/document-upload', [DocumentPersiapanPecahLegalController::class, 'upload'])->name('document.upload');



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
    Route::post('/transaksi/kpr/akad-kpr/store/{booking}', [AkadController::class, 'storeKPR'])->name('akad.kpr.store');

    // Route untuk Customer KPR ACC (Survey)
    Route::get('/customer-kpr-acc', [SurveyController::class, 'index'])->name('customer.kpr.survey');
    Route::get('/customer-kpr-rijected', [CustomerKPRRijectedController::class, 'index'])->name('customer.kpr.rijected');
    Route::post('/kpr/survey/{kprId}/store', [SurveyController::class, 'store'])->name('kpr.survey.store');


    Route::get('/customer-kpr-komersil/', [TransaksiKPRController::class, 'analisaKPRKomersil'])->name('analisa.kpr.komersil');
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
    Route::get('/customer/{id}/edit', [CustomerController::class, 'edit'])->name('customer.edit');
    Route::put('/customer/{id}/update', [CustomerController::class, 'update'])->name('customer.update');
    Route::delete('/customer/{id}/destroy', [CustomerController::class, 'destroy'])->name('customer.destroy');
    // MASTER DATA DOKUMEN PASCA LANDBANK/DOKUMEN TYPE
    Route::get('/dokument-tanah-induk', [LandBankDocumentController::class, 'index'])->name('dokument.index');
    Route::post('/dokument/store', [LandBankDocumentController::class, 'store'])->name('document-types.store');
    Route::get('/dokument/{id}/edit', [LandBankDocumentController::class, 'edit'])->name('document-types.edit');
    Route::put('/dokument/{id}/update', [LandBankDocumentController::class, 'update'])->name('document-types.update');
    Route::delete('/dokument/{id}/delete', [LandBankDocumentController::class, 'destroy'])->name('document-types.destroy');

    // Route untuk Dokument Legal Persiapan
    Route::get('/dokument-persiapan', [DokumentLegalPersiapanController::class, 'index'])->name('dokument.persiapan');
    Route::post('/documents/persiapan-pecah-legal', [DocumentPersiapanPecahLegalController::class, 'store'])->name('documents.storePersiapanPecahLegal');
    Route::get('/documents/persiapan-pecah-legal/{id}/edit', [DocumentPersiapanPecahLegalController::class, 'edit'])->name('documents.editPersiapanPecahLegal');
    Route::put('/documents/persiapan-pecah-legal/{id}', [DocumentPersiapanPecahLegalController::class, 'update'])->name('documents.updatePersiapanPecahLegal');
    Route::delete('/documents/{id}', [DocumentPersiapanPecahLegalController::class, 'destroy'])->name('documents.destroy');
    Route::post('/documents/{booking}/store', [DokumentLegalPersiapanController::class, 'store'])->name('document_legal.store');

    // ==============================================================
    // MASTER DATA & MANAJEMEN SPK KONTRAKTOR
    // ==============================================================
    Route::get('/spk', [SpkController::class, 'index'])->name('spk.index');
    Route::get('/spk/create', [SpkController::class, 'create'])->name('spk.create');
    Route::post('/spk/store', [SpkController::class, 'store'])->name('spk.store');
    Route::get('/spk/{id}', [SpkController::class, 'show'])->name('spk.show');
    Route::get('/spk/{id}/edit', [SpkController::class, 'edit'])->name('spk.edit');
    Route::put('/spk/{id}', [SpkController::class, 'update'])->name('spk.update');
    Route::delete('/spk/{id}', [SpkController::class, 'destroy'])->name('spk.destroy');
    Route::get('/spk/{id}/cetak', [SpkController::class, 'cetak'])->name('spk.cetak');
    Route::get('/api/spk/project-units/{landBankId}', [SpkController::class, 'getUnitsByProject'])->name('spk.project-units');
    Route::get('/api/spk/generate-number', [SpkController::class, 'generateNoSpk'])->name('spk.generate-number');


    // EMPLOYEE/AGENCY
    Route::get('/agency', [AgencyPropertyController::class, 'index'])->name('agency.index');
    Route::get('/agency/create', [AgencyPropertyController::class, 'create'])->name('agency.create');
    Route::post('/agency/store', [AgencyPropertyController::class, 'store'])->name('agency.store');
    Route::get('/agency/{id}/edit', [AgencyPropertyController::class, 'edit'])->name('agency.edit');
    Route::put('/agency/{id}', [AgencyPropertyController::class, 'update'])->name('agency.update');
    Route::delete('/agency/{id}', [AgencyPropertyController::class, 'destroy'])->name('agency.destroy');
    // MASTER DATA PROMO
    Route::get('/master-data-promo', [PromoController::class, 'index'])->name('promo.index');
    Route::post('/master-data-promo/store', [PromoController::class, 'store'])->name('promo.store');
    Route::get('/master-data-promo/{id}/edit', [PromoController::class, 'edit'])->name('promo.edit');
    Route::put('/master-data-promo/{id}', [PromoController::class, 'update'])->name('promo.update');
    Route::delete('/master-data-promo/{id}', [PromoController::class, 'destroy'])->name('promo.destroy');
    Route::get('/master-data-promo/{id}', [PromoController::class, 'show'])->name('promo.show');
    Route::get('/master-data-promo/get/{id}', [PromoController::class, 'getPromo'])->name('promo.get');
    // MASTER DATA PT/COMPANY
    Route::get('/master-data-pt', [CompanyProfileController::class, 'index'])->name('company-profile.index');
    Route::post('/master-data-pt/store', [CompanyProfileController::class, 'store'])->name('company-profile.store');
    Route::get('/master-data-pt/{companyProfile}/edit', [CompanyProfileController::class, 'edit'])->name('company-profile.edit');
    Route::put('/master-data-pt/{companyProfile}', [CompanyProfileController::class, 'update'])->name('company-profile.update');
    Route::delete('/master-data-pt/{companyProfile}', [CompanyProfileController::class, 'destroy'])->name('company-profile.destroy');
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

    // MASTER DATA JENIS DOKUMEN
    Route::get('/master-data/jenis-dokumen', [DocumentTypeController::class, 'index'])->name('master.data.jenis-dokumen.index');
    Route::post('/master-data/jenis-dokumen/store', [DocumentTypeController::class, 'store'])->name('master.data.jenis-dokumen.store');
    Route::get('/master-data/jenis-dokumen/{id}/edit', [DocumentTypeController::class, 'edit'])->name('master.data.jenis-dokumen.edit');
    Route::put('/master-data/jenis-dokumen/{id}', [DocumentTypeController::class, 'update'])->name('master.data.jenis-dokumen.update');
    Route::delete('/master-data/jenis-dokumen/{id}', [DocumentTypeController::class, 'destroy'])->name('master.data.jenis-dokumen.destroy');

    // Master Data Hak Akses Menu
    Route::get('/master-data/permissions', [MenuController::class, 'index'])->name('master.data.menu');
    Route::post('/menu/permissions/{position_id}/update', [MenuController::class, 'updatePermissions'])->name('positions.update_permissions');
    Route::post('/menu/store-positions', [MenuController::class, 'storePositions'])->name('menu.store_positions');
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
    Route::get('/cash-tempo/timeline/{id}', [TimelineCashTempoController::class, 'timeline']);
    Route::post('/cash-tempo/update', [TimelineCashTempoController::class, 'update'])->name('cash-tempo.update');
    Route::post('/cash-tempo/payments', [TimelineCashTempoController::class, 'storePayment'])->name('cash-tempo.storePayment');

    Route::get('/serah-terima/cetak/{id}', [SerahTerimaController::class, 'cetak'])->name('serah-terima.cetak');
    Route::get('/serah-terima-cetak', fn() => view('cetak.serah_terima_cetak'));

    Route::get('/dokumen/preview/{path}', function ($path) {
        $path = urldecode($path);
        $cleanPath = ltrim(preg_replace('/^uploads[\/\\\\]/', '', $path), '/\\');

        // Cari file di beberapa kemungkinan lokasi (public_path, storage, dll)
        $candidates = [
            public_path('uploads/' . $cleanPath),
            public_path($cleanPath),
            public_path($path),
            base_path('public/uploads/' . $cleanPath),
            base_path('public/' . $path),
            storage_path('app/public/' . $cleanPath),
            storage_path('app/public/' . $path),
            storage_path('app/' . $cleanPath),
            storage_path('app/' . $path),
        ];

        foreach ($candidates as $fullPath) {
            if (file_exists($fullPath) && is_file($fullPath)) {
                $ext = strtolower(pathinfo($fullPath, PATHINFO_EXTENSION));
                $mimeType = match ($ext) {
                    'pdf' => 'application/pdf',
                    'jpg', 'jpeg' => 'image/jpeg',
                    'png' => 'image/png',
                    'webp' => 'image/webp',
                    'gif' => 'image/gif',
                    'svg' => 'image/svg+xml',
                    default => mime_content_type($fullPath) ?: 'application/octet-stream'
                };

                return response()->file($fullPath, [
                    'Content-Type' => $mimeType,
                    'Content-Disposition' => 'inline; filename="' . basename($fullPath) . '"',
                    'Cache-Control' => 'no-cache, private',
                ]);
            }
        }

        abort(404, 'Dokumen fisik tidak ditemukan di server.');
    })->where('path', '.*')->name('dokumen.preview');

    Route::get('/storage/{path}', function ($path) {
        $path = urldecode($path);
        $cleanPath = ltrim($path, '/\\');

        $candidates = [
            storage_path('app/public/' . $cleanPath),
            storage_path('app/' . $cleanPath),
            public_path('storage/' . $cleanPath),
            public_path('uploads/' . $cleanPath),
            public_path($cleanPath),
            base_path('storage/app/public/' . $cleanPath),
        ];

        foreach ($candidates as $fullPath) {
            if (file_exists($fullPath) && is_file($fullPath)) {
                $ext = strtolower(pathinfo($fullPath, PATHINFO_EXTENSION));
                $mimeType = match ($ext) {
                    'pdf' => 'application/pdf',
                    'jpg', 'jpeg' => 'image/jpeg',
                    'png' => 'image/png',
                    'webp' => 'image/webp',
                    'gif' => 'image/gif',
                    'svg' => 'image/svg+xml',
                    default => mime_content_type($fullPath) ?: 'application/octet-stream'
                };

                return response()->file($fullPath, [
                    'Content-Type' => $mimeType,
                    'Content-Disposition' => 'inline; filename="' . basename($fullPath) . '"',
                    'Cache-Control' => 'public, max-age=86400',
                ]);
            }
        }

        abort(404, 'File storage tidak ditemukan di server.');
    })->where('path', '.*')->name('storage.preview');
    // Master data laporan job staf marketing
    Route::get('/job-staff-marketing', [JobStaffMarketingController::class, 'index'])->name('master.data.tugas-staff-marketing');
    Route::get('/job-staff-marketing/create', [JobStaffMarketingController::class, 'create'])->name('marketing.create');
    Route::post('/job-staff-marketing/store', [JobStaffMarketingController::class, 'store'])->name('marketing.tugas.store');
    Route::delete('/job-staff-marketing/{id}', [JobStaffMarketingController::class, 'destroy'])->name('marketing.tugas.destroy');
    Route::put('/job-staff-marketing/{id}', [JobStaffMarketingController::class, 'update'])->name('marketing.tugas.update');
    Route::get('/job-staff-marketing/progress/{id}', [JobStaffMarketingController::class, 'progress'])->name('marketing.tugas.progress');

    /*
    |--------------------------------------------------------------------------
    | ========================= KEUANGAN / FINANCE =========================
    |--------------------------------------------------------------------------
    */
    Route::prefix('keuangan')->name('keuangan.')->group(function () {
        Route::get('/master-invoice', [InvoiceMasterController::class, 'index'])->name('master-invoice.index');
        Route::get('/master-invoice/{id}', [InvoiceMasterController::class, 'show'])->name('master-invoice.show');
        Route::post('/master-invoice/store', [InvoiceMasterController::class, 'store'])->name('master-invoice.store');
        Route::post('/master-invoice/{id}', [InvoiceMasterController::class, 'update'])->name('master-invoice.update');
        Route::delete('/master-invoice/{id}', [InvoiceMasterController::class, 'destroy'])->name('master-invoice.destroy');
        Route::post('/master-invoice-sync-all', [InvoiceMasterController::class, 'syncAll'])->name('master-invoice.sync-all');
    });
});
