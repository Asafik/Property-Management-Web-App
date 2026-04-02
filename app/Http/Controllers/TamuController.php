<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Models\Guest;
use App\Models\LandBank;
use App\Models\LandBankUnit;
use App\Models\Customer;
use App\Models\MarketingTask;
use PhpOffice\PhpSpreadsheet\Calculation\Statistical\Distributions\F;

class TamuController extends Controller
{
    //
    public function index(Request $request)
    {
        $marketingTasks = MarketingTask::all();
        $agents = Employee::where('position_id', 2)->get();
        $projects = LandBank::with('units')->get();
        $units = LandBankUnit::all(); // ambil semua unit
        $statuses = [
            'new',
            'follow_up',
            'negotiation',
            'converted',
            'lost'
        ];

        $perPage = $request->input('per_page', 10);

        $query = Guest::with(['project', 'unit', 'employee']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('name', 'like', "%{$search}%");
        }

        if ($request->filled('agent')) {
            $query->where('assigned_to', $request->agent);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Sorting
        $allowedSortFields = ['name', 'phone', 'source', 'assigned_to', 'status', 'last_follow_up', 'next_follow_up', 'created_at'];
        $sortField     = in_array($request->input('sortField'), $allowedSortFields)
                         ? $request->input('sortField')
                         : 'created_at';
        $sortDirection = $request->input('sortDirection') === 'asc' ? 'asc' : 'desc';

        $guests = $query->orderBy($sortField, $sortDirection)
                        ->paginate($perPage)
                        ->withQueryString();

        // statistik tetap pakai semua data, tidak ikut filter
        $allGuests = Guest::all();
        $totalGuests = $allGuests->count();
        $totalProspek = $allGuests->whereIn('status', ['new', 'follow_up', 'negotiation'])->count();
        $totalFollowUp = $allGuests
            ->where('next_follow_up', '!=', null)
            ->where('next_follow_up', '>=', now()->startOfDay())
            ->where('next_follow_up', '<=', now()->endOfDay())
            ->whereNotIn('status', ['converted', 'lost'])
            ->count();

        return view('customer.tamu', compact(
            'guests',
            'agents',
            'projects',
            'units',
            'statuses',
            'totalGuests',
            'totalProspek',
            'totalFollowUp',
            'marketingTasks'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'marketing_task_id' => 'nullable|exists:marketing_tasks,id',
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
            'marketing_task_id' => $request->marketing_task_id,
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
        $guest = Guest::findOrFail($id);

        if ($guest->status === 'converted') {
            return back()->with('error', 'Tamu sudah dikonversi.');
        }

        return redirect()->route('customer.create', [
            'guest_id' => $guest->id
        ]);
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

    public function destroy($id)
    {
        $guest = Guest::findOrFail($id);
        $guest->delete();

        return redirect()->back()->with('success', 'Tamu berhasil dihapus.');
    }
}