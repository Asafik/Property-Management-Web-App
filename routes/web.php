
<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LandBankController;
use Illuminate\Support\Facades\Route;


Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');
// marketing
Route::get('/dashboard-jual-unit', function () {
    return view('marketing.jual_unit');
});

Route::get('/dashboard-tambah-customer', function () {
    return view('marketing.tambah_customer');
});

// properti
// Route::get('/dashboard-tambah-properti', function () {
//     return view('properti.tambah_properti');
// });
Route::get('/properti', [LandBankController::class, 'index'])->name('properti');
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
