<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AgencyPropertyController extends Controller
{
    public function index()
    {
        return view('sales.sales_agent');
    }

public function store(Request $request)
{
    $request->validate([
        'name' => 'required',
        'username' => 'required|unique:employees,username',
        'password' => 'required|min:5',
        'phone' => 'required',
        'address' => 'required',
        'role' => 'required'
    ]);

    Employee::create([
        'name' => $request->name,
        'username' => $request->username,
        'password' => bcrypt($request->password),
        'role' => $request->role,
        'phone' => $request->phone,
        'address' => $request->address,
    ]);

    return redirect('/agency')->with('success','Sales berhasil ditambahkan');
}

}
