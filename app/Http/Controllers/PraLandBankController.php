<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PraLandbank;

class PraLandBankController extends Controller
{
    //
    public function index(){
        return view('land_bank.pra_land_bank');
    }
    public function store(Request $request)
{
    PraLandbank::create($request->all());

    return redirect()->route('pra-landbank')
        ->with('success','Data Pra Landbank berhasil disimpan');
}
}
