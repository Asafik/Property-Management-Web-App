<?php

namespace App\Http\Controllers\Marketing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Customer;

class CustomerController extends Controller
{
    public function index()
    {
        $customerId = $this->generateCustomerId();
        return view('marketing.tambah_customer', compact('customerId'));
    }

    // 🔥 STORE DATA CUSTOMER
    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email',
        ]);

        $customer = Customer::create([
            'customer_id' => $this->generateCustomerId(), // auto ID
            'full_name' => $request->full_name,
            'nickname' => $request->nickname,
            'nik' => $request->nik,
            'no_kk' => $request->no_kk,
            'birthplace' => $request->birthplace,
            'date_birth' => $request->date_birth,
            'age' => $request->age,
            'gender' => $request->gender,
            'religion' => $request->religion,
            'nationality' => $request->nationality,
            'marital_status' => $request->marital_status,
            'marital_date' => $request->marital_date,
            'child_count' => $request->child_count,

            // pasangan & ortu
            'spouse_name' => $request->spouse_name,
            'spouse_nik' => $request->spouse_nik,
            'father_name' => $request->father_name,
            'mother_name' => $request->mother_name,

            // alamat
            'province' => $request->province,
            'city' => $request->city,
            'subdistrict' => $request->subdistrict,
            'village' => $request->village,
            'rt' => $request->rt,
            'rw' => $request->rw,
            'postal_code' => $request->postal_code,
            'address' => $request->address,

            // kontak
            'phone' => $request->phone,
            'home_phone' => $request->home_phone,
            'email' => $request->email,
            'office_email' => $request->office_email,

            // pekerjaan
            'job_status' => $request->job_status,
            'company_name' => $request->company_name,
            'main_income' => $request->main_income,
            'side_income' => $request->side_income,
            'npwp' => $request->npwp,
        ]);

        return redirect()->back()->with('success', 'Customer berhasil disimpan');
    }

    // 🔥 AUTO GENERATE ID
    private function generateCustomerId()
    {
        $today = Carbon::now()->format('Ymd');

        $lastCustomer = Customer::whereDate('created_at', Carbon::today())
            ->orderBy('id', 'desc')
            ->first();

        if ($lastCustomer && $lastCustomer->customer_id) {
            $lastNumber = intval(substr($lastCustomer->customer_id, -3));
            $newNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
        } else {
            $newNumber = '001';
        }

        return 'CUST-' . $today . '-' . $newNumber;
    }
public function search(Request $request)
{
    $keyword = $request->keyword;

    if (!$keyword) {
        return response()->json([]);
    }

    $customers = Customer::with('units')
        ->where('full_name', 'like', "%$keyword%")
        ->orWhere('nik', 'like', "%$keyword%")
        ->limit(10)
        ->get();

    return response()->json($customers);
}

}
