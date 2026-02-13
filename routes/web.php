<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
});
 //properti
 Route::get('/dashboard-tambah-properti', function () {
    return view('properti.tambah_properti');
});
