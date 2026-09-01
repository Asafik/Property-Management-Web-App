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
        $authUser = auth()->user();
        $posName = strtolower($authUser?->position?->name ?? '');
        $divName = strtolower($authUser?->division?->name ?? '');
        $isAdmin = ($posName === 'admin' || $divName === 'super admin' || $authUser?->position_id == 5 || $authUser?->division_id == 4);
        $isMarketing = ($divName === 'marketing' || $authUser?->division_id == 1 || str_contains($posName, 'marketing'));

        $query = Employee::with(['division', 'position']);

        // Jika login sebagai Kepala Marketing / Staff Marketing (bukan Admin), filter hanya anggota divisi Marketing
        if ($isMarketing && !$isAdmin) {
            $query->where('division_id', 1);
        }

        // Filter search (nama atau username)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('username', 'like', "%{$search}%");
            });
        }

        // Sorting
        $sortField = $request->input('sortField', 'created_at');
        $sortDirection = $request->input('sortDirection', 'desc');
        $validSortFields = ['name', 'username', 'phone', 'address', 'created_at'];

        if (in_array($sortField, $validSortFields)) {
            $query->orderBy($sortField, $sortDirection === 'asc' ? 'asc' : 'desc');
        }

        // Jumlah tampil per halaman (default 10)
        $perPage = $request->input('per_page', 10);

        // Ambil data dengan pagination
        $employees = $query->paginate($perPage)->withQueryString();

        return view('sales.data_sales_agent', compact('employees', 'sortField', 'sortDirection'));
    }

    // Menampilkan form tambah sales/agent
    public function create()
    {
        $authUser = auth()->user();
        $posName = strtolower($authUser?->position?->name ?? '');
        $divName = strtolower($authUser?->division?->name ?? '');
        $isAdmin = ($posName === 'admin' || $divName === 'super admin' || $authUser?->position_id == 5 || $authUser?->division_id == 4);
        $isMarketing = ($divName === 'marketing' || $authUser?->division_id == 1 || str_contains($posName, 'marketing'));

        // Jika user adalah Kepala Marketing, otomatis batasi ke Divisi Marketing dan Posisi Staff Marketing
        if ($isMarketing && !$isAdmin) {
            $divisions = Division::where('id', 1)->orWhere('name', 'Marketing')->get();
            $positions = Position::where('division_id', 1)->get();
            $defaultDivisionId = $divisions->first()->id ?? 1;
            
            // Default Posisi: Staff Marketing (ID 2)
            $staffPosition = Position::where('division_id', $defaultDivisionId)
                ->where(function($q) {
                    $q->where('name', 'like', '%Staff%')
                      ->orWhere('name', 'like', '%Marketing%');
                })
                ->where('name', 'not like', '%Kepala%')
                ->first();
            $defaultPositionId = $staffPosition ? $staffPosition->id : 2;
        } else {
            $divisions = Division::all();
            $positions = Position::all();
            $defaultDivisionId = null;
            $defaultPositionId = null;
        }

        return view('sales.buat_sales_agent', compact('divisions', 'positions', 'defaultDivisionId', 'defaultPositionId'));
    }

    public function store(Request $request)
    {
        $authUser = auth()->user();
        $posName = strtolower($authUser?->position?->name ?? '');
        $divName = strtolower($authUser?->division?->name ?? '');
        $isAdmin = ($posName === 'admin' || $divName === 'super admin' || $authUser?->position_id == 5 || $authUser?->division_id == 4);
        $isMarketing = ($divName === 'marketing' || $authUser?->division_id == 1 || str_contains($posName, 'marketing'));

        if ($isMarketing && !$isAdmin) {
            $request->merge([
                'division_id' => 1
            ]);
        }

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
        $authUser = auth()->user();
        $posName = strtolower($authUser?->position?->name ?? '');
        $divName = strtolower($authUser?->division?->name ?? '');
        $isAdmin = ($posName === 'admin' || $divName === 'super admin' || $authUser?->position_id == 5 || $authUser?->division_id == 4);
        $isMarketing = ($divName === 'marketing' || $authUser?->division_id == 1 || str_contains($posName, 'marketing'));

        if ($isMarketing && !$isAdmin) {
            $divisions = Division::where('id', 1)->orWhere('name', 'Marketing')->get();
            $positions = Position::where('division_id', 1)->get();
            $defaultDivisionId = $employee->division_id ?? 1;
            $defaultPositionId = $employee->position_id;
        } else {
            $divisions = Division::all();
            $positions = Position::all();
            $defaultDivisionId = $employee->division_id;
            $defaultPositionId = $employee->position_id;
        }

        return view('sales.buat_sales_agent', compact('employee', 'divisions', 'positions', 'defaultDivisionId', 'defaultPositionId'));
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
            'division_id' => 'required|exists:divisions,id',
            'position_id' => 'required|exists:positions,id',
        ]);

        $employee->name = $request->name;
        $employee->username = $request->username;

        if ($request->filled('password')) {
            $employee->password = Hash::make($request->password);
        }

        $employee->phone = $request->phone;
        $employee->address = $request->address;
        $employee->division_id = $request->division_id;
        $employee->position_id = $request->position_id;
        $employee->save();

        return redirect()->route('agency.index')
            ->with('success', 'Data berhasil diperbarui');
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
