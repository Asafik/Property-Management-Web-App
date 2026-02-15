
<?php

use App\Http\Controllers\Admin\PropertyController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LandBankController;
use Illuminate\Support\Facades\Route;


Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');
// marketing
Route::get('/dashboard-jual-unit', function () {
    return view('marketing.jual_unit');
});

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

Route::get('/dashboard-kpr', function () {
    return view('marketing.kpr');
});

Route::get('/dashboard-survey', function () {
    return view('marketing.survey');
});

Route::get('/dashboard-pengajuan', function () {
    return view('marketing.pengajuan');
});

Route::get('/dashboard-tambah-customer', function () {
    return view('marketing.tambah_customer');
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


Route::get('/properti-buat-kavling', function () {
    return view('properti.addkavling');
});


Route::get('/properti-revisi/{id}', 
    [LandBankController::class, 'revisi']
)->name('properti.revisi');
