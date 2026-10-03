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
        // Hanya tampilkan tugas kategori "proyeksi" di dropdown Tamu / User Proyeksi
        $marketingTasks = MarketingTask::where('kategori', \App\Models\MarketingTask::KATEGORI_PROYEKSI)
                            ->orderBy('nama_tugas')
                            ->get();
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

        $query = Guest::with(['project', 'unit', 'employee', 'marketingTask']);

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
        $totalConverted = $allGuests->where('status', 'converted')->count();

        $user = auth()->user();
        $employeeId = $user?->employee_id ?? $user?->id;

        $activeTask = MarketingTask::with('employee')
            ->where('kategori', MarketingTask::KATEGORI_PROYEKSI)
            ->where('status', '!=', 'Selesai')
            ->when($employeeId, function($q) use ($employeeId) {
                $q->where('employee_id', $employeeId);
            })
            ->latest()
            ->first();

        if (!$activeTask) {
            $activeTask = MarketingTask::with('employee')
                ->where('kategori', MarketingTask::KATEGORI_PROYEKSI)
                ->where('status', '!=', 'Selesai')
                ->latest()
                ->first();
        }

        return view('customer.tamu', compact(
            'guests',
            'agents',
            'projects',
            'units',
            'statuses',
            'totalGuests',
            'totalProspek',
            'totalFollowUp',
            'totalConverted',
            'marketingTasks',
            'activeTask'
        ));
    }

    public function create()
    {
        $agents = Employee::where('position_id', 2)->get();
        if ($agents->isEmpty()) {
            $agents = Employee::all();
        }
        $projects = LandBank::with('units')->get();
        $units = LandBankUnit::all();
        $marketingTasks = MarketingTask::where('kategori', \App\Models\MarketingTask::KATEGORI_PROYEKSI)
                            ->orderBy('nama_tugas')
                            ->get();
        if ($marketingTasks->isEmpty()) {
            $marketingTasks = MarketingTask::all();
        }
        $statuses = [
            'hot_prospect'    => 'Hot Prospek',
            'medium_prospect' => 'Medium Prospek',
            'cold_prospect'   => 'Cold Prospek',
            'converted'       => 'Deal / Booking',
            'lost'            => 'Batal / Lost'
        ];

        $currentUser = auth()->user();
        $isStaff = $currentUser && ($currentUser->position_id == 2 || stripos($currentUser->position?->name ?? '', 'staff') !== false);

        return view('customer.tamu_create', compact(
            'agents',
            'projects',
            'units',
            'marketingTasks',
            'statuses',
            'currentUser',
            'isStaff'
        ));
    }

    public function store(Request $request)
    {
        $currentUser = auth()->user();
        $isStaff = $currentUser && ($currentUser->position_id == 2 || stripos($currentUser->position?->name ?? '', 'staff') !== false);

        $request->validate([
            'name' => 'required',
            'marketing_task_id' => 'nullable|exists:marketing_tasks,id',
            'phone' => 'required',
            'email' => 'nullable|email',
            'source' => 'required',
            'land_bank_id' => 'required|exists:land_banks,id',
            'unit_id' => 'nullable|exists:land_bank_units,id',
            'status' => 'required',
            'assigned_to' => $isStaff ? 'nullable' : 'required',
            'next_follow_up' => 'required|date',
        ]);

        $assignedTo = $isStaff ? ($currentUser?->id ?? $request->assigned_to) : $request->assigned_to;

        $marketingTaskId = $request->marketing_task_id;
        if (!$marketingTaskId && $assignedTo) {
            $activeTask = MarketingTask::where('kategori', MarketingTask::KATEGORI_PROYEKSI)
                ->where('status', '!=', 'Selesai')
                ->where('employee_id', $assignedTo)
                ->latest()
                ->first();
            $marketingTaskId = $activeTask?->id;
        }

        $guest = Guest::create([
            'name' => $request->name,
            'marketing_task_id' => $marketingTaskId,
            'phone' => $request->phone,
            'email' => $request->email,
            'source' => $request->source,
            'land_bank_id' => $request->land_bank_id,
            'unit_id' => $request->unit_id,
            'budget' => $request->budget,
            'notes' => $request->notes,
            'status' => $request->status,
            'assigned_to' => $assignedTo,
            'last_follow_up' => now(),
            'next_follow_up' => $request->next_follow_up,
        ]);

        // Sinkronisasi otomatis ke target tugas marketing terkait
        if ($marketingTaskId) {
            $task = MarketingTask::find($marketingTaskId);
            if ($task) {
                $count = $task->guest()->count();
                $task->realisasi_jumlah = $count;
                if ($count >= ($task->target_jumlah ?? 1)) {
                    $task->status = 'Selesai';
                } elseif ($task->status === 'Pending') {
                    $task->status = 'Proses';
                }
                $task->save();
            }
        }

        return redirect()->route('customer.tamu')->with('success', 'Data calon pembeli / proyeksi berhasil ditambahkan.');
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
        $guest = Guest::with(['marketingTask', 'employee'])->findOrFail($id);

        if ($guest->status === 'converted') {
            return back()->with('error', 'Calon pembeli ini sudah pernah dikonversi sebelumnya.');
        }

        // Generate customer ID baru
        $customerId = Customer::generateCustomerId();

        // Buat Customer secara instan dengan status "belum_lengkap"
        $customer = Customer::create([
            'customer_id'        => $customerId,
            'status_kelengkapan' => 'belum_lengkap',
            'guest_id'           => $guest->id,
            'land_bank_id'       => $guest->land_bank_id,
            'unit_id'            => $guest->unit_id,
            'full_name'          => $guest->name,
            'phone'              => $guest->phone,
            'email'              => $guest->email,
            'job_status'         => 'Lainnya',
        ]);

        // Update status calon pembeli/tamu menjadi converted
        $guest->update(['status' => 'converted']);

        // Sinkronisasi capaian tugas marketing jika tamu ini berasal dari tugas marketing
        if ($guest->marketing_task_id) {
            $task = $guest->marketingTask;
            if ($task) {
                $count = $task->guest()->count();
                $task->realisasi_jumlah = $count;
                if ($count >= ($task->target_jumlah ?? 1)) {
                    $task->status = 'Selesai';
                }
                $task->save();
            }
        }

        return redirect()->route('customer.data')->with('success', "Calon pembeli '{$guest->name}' berhasil langsung dikonversi menjadi User ({$customerId})! Status: Belum Lengkap (Wajib melengkapi data NIK/KTP sebelum bisa booking unit di Catalog Unit).");
    }

    public function show($id)
    {
        $guest = Guest::with(['project', 'unit', 'employee', 'marketingTask'])->findOrFail($id);
        return view('customer.tamu_detail', compact('guest'));
    }

    public function edit($id)
    {
        $guest = Guest::findOrFail($id);
        $agents = Employee::where('position_id', 2)->get();
        if ($agents->isEmpty()) {
            $agents = Employee::all();
        }
        $projects = LandBank::with('units')->get();
        $units = LandBankUnit::where('land_bank_id', $guest->land_bank_id)->get();
        if ($units->isEmpty()) {
            $units = LandBankUnit::all();
        }
        $marketingTasks = MarketingTask::where('kategori', \App\Models\MarketingTask::KATEGORI_PROYEKSI)
                            ->orderBy('nama_tugas')
                            ->get();
        if ($marketingTasks->isEmpty()) {
            $marketingTasks = MarketingTask::all();
        }
        $statuses = [
            'hot_prospect'    => 'Hot Prospek',
            'medium_prospect' => 'Medium Prospek',
            'cold_prospect'   => 'Cold Prospek',
            'converted'       => 'Deal / Booking',
            'lost'            => 'Batal / Lost'
        ];

        $currentUser = auth()->user();
        $isStaff = $currentUser && ($currentUser->position_id == 2 || stripos($currentUser->position?->name ?? '', 'staff') !== false);

        return view('customer.tamu_create', compact(
            'guest',
            'agents',
            'projects',
            'units',
            'marketingTasks',
            'statuses',
            'currentUser',
            'isStaff'
        ));
    }

    public function update(Request $request, $id)
    {
        $currentUser = auth()->user();
        $isStaff = $currentUser && ($currentUser->position_id == 2 || stripos($currentUser->position?->name ?? '', 'staff') !== false);

        $request->validate([
            'name' => 'required',
            'marketing_task_id' => 'nullable|exists:marketing_tasks,id',
            'phone' => 'required',
            'email' => 'nullable|email',
            'source' => 'required',
            'land_bank_id' => 'required|exists:land_banks,id',
            'unit_id' => 'nullable|exists:land_bank_units,id',
            'status' => 'required',
            'assigned_to' => $isStaff ? 'nullable' : 'required',
            'next_follow_up' => 'required|date',
        ]);

        $guest = Guest::findOrFail($id);
        $assignedTo = $isStaff ? ($guest->assigned_to ?: ($currentUser?->id ?? $request->assigned_to)) : ($request->assigned_to ?? $guest->assigned_to);

        $guest->update([
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
            'assigned_to' => $assignedTo,
            'last_follow_up' => $request->filled('last_follow_up') ? $request->last_follow_up : $guest->last_follow_up,
            'next_follow_up' => $request->next_follow_up,
        ]);

        return redirect()->route('customer.tamu')->with('success', 'Data calon pembeli / proyeksi berhasil diperbarui.');
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