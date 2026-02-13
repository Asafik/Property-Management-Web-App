<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
});
 //properti
 Route::get('/dashboard-tambah-properti', function () {
    return view('properti.tambah_properti');
});

 Route::get('/properti/verifikasi-legal', function () {
    return view('properti.verifikasi_legal');
});

 Route::get('/properti-buat-kavling', function () {
    return view('properti.addkavling');
});


