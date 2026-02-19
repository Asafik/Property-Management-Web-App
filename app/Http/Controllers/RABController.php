<?php

namespace App\Http\Controllers;
use App\Models\LandBankUnit;
use Illuminate\Http\Request;

class RABController extends Controller
{
    //

public function index($unit_id)
{
    $unit = LandBankUnit::with('progress.items')->findOrFail($unit_id);

    $progressItems = $unit->progress ? $unit->progress->items : collect(); // collection kosong jika progress null

    return view('cetak.rab', compact('unit', 'progressItems'));
}



public function acc($id)
{
    $unit = LandBankUnit::findOrFail($id);

    // Update kolom construction_progress menjadi 'selesai'
    $unit->construction_progress = 'selesai';
    $unit->save();

    return redirect()->back()->with('success', 'RAB berhasil di-ACC dan progress menjadi selesai.');
}

}
