<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Division;
use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AgencyPropertyController extends Controller
{
    // Menampilkan daftar sales/agent dengan filter dan search
    public function index(Request $request)
    {
        $query = Employee::query();

        // Filter search (nama atau username)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('username', 'like', "%{$search}%");
            });
        }

        // Jumlah tampil per halaman (default 10)
        $perPage = $request->input('per_page', 10);

        // Ambil data dengan pagination
        $employees = $query->latest()->paginate($perPage)->withQueryString();
    
        return view('sales.data_sales_agent', compact('employees'));
    }

    // Menampilkan form tambah sales/agent
    public function create()
    {
         $divisions = Division::all();
         $positions = Position::all();
        return view('sales.buat_sales_agent', compact('divisions','positions'));
    }

   public function store(Request $request)
{
    $request->validate([
        'name' => 'required',
        'username' => 'required|unique:employees,username',
        'password' => 'required|min:5',
        'phone' => 'required',
        'address' => 'required',
        'division_id' => 'required|exists:divisions,id',
        'position_id' => 'required|exists:positions,id',
    ]);

    Employee::create([
        'name' => $request->name,
        'username' => $request->username,
        'password' => Hash::make($request->password),
        'phone' => $request->phone,
        'address' => $request->address,
        'division_id' => $request->division_id,
        'position_id' => $request->position_id,
    ]);

    return redirect()->route('agency.index')
        ->with('success', 'Pengguna berhasil ditambahkan');
}

    // Menampilkan form edit sales/agent
    public function edit($id)
    {
        $employee = Employee::findOrFail($id);
        return view('sales.buat_sales_agent', compact('employee'));
    }

    // Menyimpan perubahan data sales/agent
    public function update(Request $request, $id)
    {
        $employee = Employee::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'username' => 'required|unique:employees,username,' . $employee->id,
            'password' => 'nullable|min:5',
            'phone' => 'required',
            'address' => 'required',
            'role' => 'required'
        ]);

        $employee->name = $request->name;
        $employee->username = $request->username;
        if ($request->password) {
            $employee->password = Hash::make($request->password);
        }
        $employee->phone = $request->phone;
        $employee->address = $request->address;
        $employee->role = $request->role;

        $employee->save();

        return redirect()->route('agency.index')
            ->with('success', 'Data Sales berhasil diperbarui');
    }

    // Menghapus data sales/agent
    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();

        return redirect()->route('agency.index')
            ->with('success', 'Sales berhasil dihapus');
    }
}
