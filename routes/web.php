<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
});

// marketing
Route::get('/dashboard-jual-unit', function () {
    return view('marketing.jual_unit');
});

Route::get('/dashboard-tambah-customer', function () {
    return view('marketing.tambah_customer');
});

// properti
Route::get('/dashboard-tambah-properti', function () {
    return view('properti.tambah_properti');
});

Route::get('/properti/verifikasi-legal', function () {
    return view('properti.verifikasi_legal');
});

Route::get('/properti-buat-kavling', function () {
    return view('properti.addkavling');
});
