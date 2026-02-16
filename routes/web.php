
<?php

use App\Http\Controllers\Admin\PropertyController;
use App\Http\Controllers\Admin\VerifikasiLegalController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LandBankController;
use App\Http\Controllers\Admin\LandBankUnitController;
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

// web.php
Route::get('properti/kavling/{unit}/update-progress', [LandBankUnitController::class, 'updateProgress'])->name('properti.kavling.updateProgress');

Route::get('/properti-revisi/{id}', 
    [LandBankController::class, 'revisi']
)->name('properti.revisi');
