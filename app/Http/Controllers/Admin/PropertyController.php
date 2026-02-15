<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LandBank;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    //
public function index()
{
    $landBanks = LandBank::with('documents')
        ->latest()
        ->paginate(10);

    return view('properti.index', compact('landBanks'));
}

}
