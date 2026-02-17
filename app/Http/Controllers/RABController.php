<?php

namespace App\Http\Controllers;
use App\Models\LandBankUnit;
use Illuminate\Http\Request;

class RABController extends Controller
{
    //
public function acc($id)
{
    $unit = LandBankUnit::findOrFail($id);

    // Update kolom construction_progress menjadi 'selesai'
    $unit->construction_progress = 'selesai';
    $unit->save();

    return redirect()->back()->with('success', 'RAB berhasil di-ACC dan progress menjadi selesai.');
}

}
