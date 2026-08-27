<?php

namespace App\Http\Controllers;
use App\Models\KprApplication;
use Illuminate\Http\Request;

class CustomerKPRRijectedController extends Controller
{
    //
    public function index(Request $request)
    {
        $query = KprApplication::with(['customer', 'unit', 'bank'])
            ->where('status', 'rejected');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($query) use ($search) {
                $query->whereHas('customer', function ($q) use ($search) {
                    $q->where('full_name', 'like', "%{$search}%");
                })->orWhereHas('unit', function ($q) use ($search) {
                    $q->where('unit_name', 'like', "%{$search}%")
                      ->orWhere('unit_code', 'like', "%{$search}%");
                });
            });
        }

        if ($request->filled('sort')) {
            $sort = $request->sort;
            if ($sort === 'name_asc') {
                $query->join('customers', 'kpr_applications.customer_id', '=', 'customers.id')
                      ->orderBy('customers.full_name', 'asc')
                      ->select('kpr_applications.*');
            } elseif ($sort === 'name_desc') {
                $query->join('customers', 'kpr_applications.customer_id', '=', 'customers.id')
                      ->orderBy('customers.full_name', 'desc')
                      ->select('kpr_applications.*');
            } elseif ($sort === 'unit_asc') {
                $query->join('units', 'kpr_applications.unit_id', '=', 'units.id')
                      ->orderBy('units.unit_name', 'asc')
                      ->select('kpr_applications.*');
            } elseif ($sort === 'unit_desc') {
                $query->join('units', 'kpr_applications.unit_id', '=', 'units.id')
                      ->orderBy('units.unit_name', 'desc')
                      ->select('kpr_applications.*');
            }
        } else {
            $query->latest();
        }

        $perPage = $request->input('per_page', 10);
        $kprApplications = $query->paginate($perPage)->withQueryString();

        return view('transaksi.customer-kpr-rijected', compact('kprApplications'));
    }
    
}
