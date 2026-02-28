<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Models\Guest;
use App\Models\LandBank;
use App\Models\LandBankUnit;
use App\Models\Customer;
use PhpOffice\PhpSpreadsheet\Calculation\Statistical\Distributions\F;

class TamuController extends Controller
{
    //
    public function index()
    {
        $guests = Guest::with(['project', 'unit', 'employee',])->get();
        $agents = Employee::where('role', 'agency')->get();
        $projects = LandBank::with('units')->get();
        $units = LandBankUnit::all(); // ambil semua unit
        $statuses = [
            'new',
            'follow_up',
            'negotiation',
            'converted',
            'lost'
        ];
        $totalGuests = $guests->count();
        $totalProspek = $guests->whereIn('status', ['new', 'follow_up', 'negotiation'])->count();
        $totalFollowUp = $guests
            ->where('next_follow_up', '!=', null)
            ->where('next_follow_up', '>=', now()->startOfDay())
            ->where('next_follow_up', '<=', now()->endOfDay())
            ->whereNotIn('status', ['converted', 'lost'])
            ->count();
        return view('customer.tamu', compact('guests', 'agents', 'projects', 'units', 'statuses', 'totalGuests', 'totalProspek', 'totalFollowUp'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'email' => 'nullable|email',
            'source' => 'required',
            'land_bank_id' => 'required|exists:land_banks,id',
            'unit_id' => 'nullable|exists:land_bank_units,id',
            'status' => 'required',
            'assigned_to' => 'required',
            'next_follow_up' => 'required|date',
        ]);

        Guest::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'source' => $request->source,
            'land_bank_id' => $request->land_bank_id,
            'unit_id' => $request->unit_id,
            'budget' => $request->budget,
            'notes' => $request->notes,
            'status' => $request->status,
            'assigned_to' => $request->assigned_to,
            'last_follow_up' => now(),
            'next_follow_up' => $request->next_follow_up,
        ]);

        return redirect()->back()->with('success', 'Tamu berhasil ditambahkan.');
    }
    public function followUp(Request $request)
    {
        $request->validate([
            'guest_id' => 'required|exists:guests,id',
            'last_follow_up' => 'required|date',
            'next_follow_up' => 'nullable|date',
            'notes' => 'nullable'
        ]);

        $guest = Guest::findOrFail($request->guest_id);

        $guest->update([
            'last_follow_up' => $request->last_follow_up,
            'next_follow_up' => $request->next_follow_up,
            'notes' => $request->notes,
            'status' => 'follow_up'
        ]);

        return back()->with('success', 'Follow up berhasil disimpan.');
    }
    public function convert($id)
    {
        $guest = Guest::with(['project', 'unit'])->findOrFail($id);

        if ($guest->status === 'converted') {
            return back()->with('error', 'Tamu sudah dikonversi.');
        }

        Customer::create([
            'guest_id' => $guest->id,   // ✅ INI YANG KURANG
            'full_name' => $guest->name,
            'phone' => $guest->phone,
            'email' => $guest->email,
            'land_bank_id' => $guest->land_bank_id,
            'unit_id' => $guest->unit_id,
        ]);

        $guest->update([
            'status' => 'converted'
        ]);

        return back()->with('success', 'Tamu berhasil dikonversi menjadi customer.');
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'email' => 'nullable|email',
            'source' => 'required',
            'land_bank_id' => 'required|exists:land_banks,id',
            'unit_id' => 'nullable|exists:land_bank_units,id',
            'status' => 'required',
            'assigned_to' => 'required',
            'next_follow_up' => 'required|date',
        ]);

        $guest = Guest::findOrFail($id);

        $guest->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'source' => $request->source,
            'land_bank_id' => $request->land_bank_id,
            'unit_id' => $request->unit_id,
            'budget' => $request->budget,
            'notes' => $request->notes,
            'status' => $request->status,
            'assigned_to' => $request->assigned_to,
            'last_follow_up' => now(),
            'next_follow_up' => $request->next_follow_up,
        ]);

        return redirect()->back()->with('success', 'Tamu berhasil diperbarui.');
    }

    public function editAjax($id)
    {
        $tamu = Guest::findOrFail($id);
        return response()->json($tamu);
    }
}
