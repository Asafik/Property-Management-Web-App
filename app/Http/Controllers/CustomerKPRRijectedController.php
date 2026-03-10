<?php

namespace App\Http\Controllers;
use App\Models\KprApplication;
use Illuminate\Http\Request;

class CustomerKPRRijectedController extends Controller
{
    //
        public function index()
    {
        // Ambil data KPR yang statusnya 'survey'
        $kprApplications = KprApplication::with(['customer', 'unit', 'bank'])
            ->where('status', 'rejected')
            ->get();

        return view('transaksi.customer-kpr-rijected', compact('kprApplications'));
    }
    
}
