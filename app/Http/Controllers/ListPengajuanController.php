<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KprApplication;
class ListPengajuanController extends Controller
{
    //
   public function index()
{
    $totalPengajuan = KprApplication::where('status', 'pengajuan')->count();

    return view('marketing.list_pengajuan', compact('totalPengajuan'));
}
}
