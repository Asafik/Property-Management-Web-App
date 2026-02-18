
<?php

use App\Http\Controllers\Admin\DevelopmentProgressController;
use App\Http\Controllers\Admin\PropertyController;
use App\Http\Controllers\RABController;
use App\Http\Controllers\Admin\VerifikasiLegalController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LandBankController;
use App\Http\Controllers\Admin\LandBankUnitController;
use App\Http\Controllers\AgencyPropertyController;
use App\Http\Controllers\Marketing\CustomerController;
use App\Http\Controllers\Marketing\SellUnitController;
use App\Models\DevelopmentProgress;
use Illuminate\Support\Facades\Route;


Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');
// marketing
// Route::get('/dashboard-jual-unit', function () {
//     return view('marketing.jual_unit');
// });
Route::get('/marketing/sell-unit',[SellUnitController::class, 'index'])->name('marketing.jual-unit');
Route::post('/marketing/set-agency/{unitId}',
    [SellUnitController::class, 'setAgency']
)->name('marketing.setAgency');

Route::get('/dashboard-list-pengajuan', function () {
    return view('marketing.list_pengajuan');
});

Route::get('/dashboard-cash', function () {
    return view('marketing.cash');
});

Route::get('/dashboard-approved', function () {
    return view('marketing.approved');
});

Route::get('/dashboard-akad', function () {
    return view('marketing.akad');
});

Route::get('/dashboard-vertifikasi-kpr', function () {
    return view('marketing.vertifikasi_kpr');
});

Route::get('/dashboard-survey', function () {
    return view('marketing.survey');
});

Route::get('/dashboard-pengajuan', function () {
    return view('marketing.pengajuan');
});

// Route::get('/dashboard-tambah-customer', function () {
//     return view('marketing.tambah_customer');
// });

Route::get('/marketing/create-customer', [CustomerController::class, 'index'])->name('marketing.tambah_customer');
Route::post('/marketing/create-customer/store', [CustomerController::class, 'store'])->name('customer.store');
Route::post('/set-customer/{unitId}', [SellUnitController::class, 'setCustomer'])
    ->name('set.customer');

//cetak
Route::get('/dashboard-cetak-laporan', function () {
    return view('cetak.laporan');
});

Route::get('/dashboard-cetak-invoice-cash', function () {
    return view('cetak.invoice_cash');
});

Route::get('/dashboard-cetak-rab', function () {
    return view('cetak.rab');
});



// properti
// Route::get('/dashboard-tambah-properti', function () {
//     return view('properti.tambah_properti');
// });
Route::get('/properti', [PropertyController::class, 'index'])->name('properti-all');
Route::get('/properti-create', [LandBankController::class, 'index'])->name('properti');
Route::post('/properti/create', [LandBankController::class, 'store'])->name('properti.store');



Route::get('/properti/verifikasi-legal/{id}',
    [LandBankController::class, 'verifikasiLegal']
)->name('properti.verifikasi');
Route::post('/dokumen/{id}/approve',
    [LandBankController::class, 'approveDocument']
)->name('dokumen.approve');

Route::post('/dokumen/{id}/reject',
    [LandBankController::class, 'rejectDocument']
)->name('dokumen.reject');
Route::post('/properti/{id}/approve-all', [LandBankController::class, 'approveAllDocuments'])
    ->name('properti.approveAll');

Route::post('/properti/{id}/reject-all', [LandBankController::class, 'rejectAllDocuments'])
    ->name('properti.rejectAll');

Route::post('/properti/{id}/update-revisi',
    [LandBankController::class, 'updateRevisi']
)->name('properti.updateRevisi');

Route::post('/dokumen/{id}/update',
    [LandBankController::class, 'updateDocument']
)->name('dokumen.update');

Route::get('/kavling', [PropertyController::class, 'kavlingindex'])
    ->name('kavling.index');

// Route::get('/properti-buat-kavling', function () {
//     return view('properti.addkavling');
// });
Route::get('/properti-buat-kavling/{land_bank_id}', [LandBankUnitController::class, 'create'])
    ->name('properti.buatKavling');
// Simpan Manual
Route::post('/properti-buat-kavling/{land_bank_id}/store', [LandBankUnitController::class, 'store'])->name('properti.storeKavling');

// Generate Otomatis
Route::post('/properti-buat-kavling/{land_bank_id}/generate', [LandBankUnitController::class, 'generate'])->name('properti.generateKavling');
// Edit unit kavling
Route::get('/properti/kavling/{unit}/edit', [LandBankUnitController::class, 'edit'])
     ->name('properti.kavling.edit');

// Update unit kavling
Route::put('/properti/kavling/{unit}', [LandBankUnitController::class, 'update'])
     ->name('properti.kavling.update');

// Delete unit kavling
Route::delete('/properti/kavling/{unit}', [LandBankUnitController::class, 'destroy'])
     ->name('properti.kavling.destroy');


Route::get('properti/kavling/{unit}/update-progress', [LandBankUnitController::class, 'updateProgress'])->name('properti.kavling.updateProgress');

    Route::post('/properti/progress/acc-ajax/{unit}', [\App\Http\Controllers\Admin\DevelopmentProgressController::class, 'accAjax'])
    ->name('properti.progress.acc.ajax');

Route::post('/progress/{item}/upload', [DevelopmentProgressController::class, 'uploadDocumentation'])->name('progress.uploadDocumentation');





// Route::get('/properti-daftar-pembangunan', function () {
//     return view('properti.daftar_pembangunan');
// });
Route::get('/properti/progress/{land_bank_id}',
    [DevelopmentProgressController::class, 'index']
)->name('properti.progress');

Route::post('/properti/progress/store',
    [DevelopmentProgressController::class, 'store']
)->name('properti.progress.store');



Route::get('/properti-revisi/{id}',
    [LandBankController::class, 'revisi']
)->name('properti.revisi');


// Sales
// Route::get('/dashboard-sales', function () {
//     return view('sales.sales_agent');
// });
Route::get('/Agency-Create', [AgencyPropertyController::class, 'index'])
    ->name('agency');
Route::post('/agency/store',[AgencyPropertyController::class,'store'])->name('agency.store');


Route::get('/login', function () {
    return view('auth.login');
});

Route::get('/register', function () {
    return view('auth.register');
});
