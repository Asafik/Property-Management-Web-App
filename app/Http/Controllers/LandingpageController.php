<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Guest;
use App\Models\LandBank;
use App\Models\LandBankUnit;
use App\Models\Employee;
use App\Models\MarketingTask;

class LandingpageController extends Controller
{
    public function index()
    {
        return view('home.index');
    }

    /**
     * Tampilkan Halaman Mandiri Formulir Buku Tamu / Data Tamu Prospek
     */
    public function bukuTamu(Request $request)
    {
        $projects = LandBank::with('units')->get();
        $units = LandBankUnit::all();
        $agents = Employee::where('position_id', 2)->get();
        if ($agents->isEmpty()) {
            $agents = Employee::all();
        }
        // Hanya tampilkan tugas kategori "proyeksi" di buku tamu landing page
        $marketingTasks = MarketingTask::where('kategori', \App\Models\MarketingTask::KATEGORI_PROYEKSI)
                            ->orderBy('nama_tugas')
                            ->get();

        $selectedProjectId = $request->get('project_id', $projects->first()->id ?? null);
        $selectedUnitId = $request->get('unit_id', null);
        $unitName = $request->get('unit', 'Cluster Tegal Besar (Ready Stock)');

        return view('home.buku-tamu', compact(
            'projects',
            'units',
            'agents',
            'marketingTasks',
            'selectedProjectId',
            'selectedUnitId',
            'unitName'
        ));
    }

    /**
     * Simpan Pengisian Buku Tamu Web Langsung ke Database CRM (Tabel Guests / Tamu Prospek)
     * Format field persis sama dengan TamuController::store
     */
    public function storeBukuTamu(Request $request)
    {
        $request->validate([
            'name'              => 'required|string|max:255',
            'phone'             => 'required|string|max:50',
            'email'             => 'nullable|email|max:255',
            'source'            => 'required',
            'marketing_task_id' => 'nullable|exists:marketing_tasks,id',
            'land_bank_id'      => 'required|exists:land_banks,id',
            'unit_id'           => 'nullable|exists:land_bank_units,id',
            'status'            => 'required',
            'assigned_to'       => 'nullable|exists:employees,id',
            'next_follow_up'    => 'required|date',
            'budget'            => 'nullable',
            'notes'             => 'nullable|string|max:1000',
        ]);

        // Siapkan Assigned To (Agent default jika tidak dipilih)
        $assignedTo = $request->assigned_to;
        if (!$assignedTo) {
            $defaultAgent = Employee::where('position_id', 2)->first() ?? Employee::first();
            $assignedTo = $defaultAgent ? $defaultAgent->id : null;
        }

        // Susun Catatan & Budget
        $cleanBudget = null;
        if ($request->filled('budget')) {
            $cleanBudget = preg_replace('/\D/', '', $request->budget);
        }

        $notesFinal = $request->notes ?? '';
        if ($cleanBudget) {
            $budgetFormatted = 'Rp ' . number_format((float)$cleanBudget, 0, ',', '.');
            $notesFinal = trim("Budget: " . $budgetFormatted . ($notesFinal ? "\n" . $notesFinal : ""));
        }

        // Simpan persis ke Tabel Guests
        $guest = Guest::create([
            'name'              => $request->name,
            'marketing_task_id' => $request->marketing_task_id ?: null,
            'phone'             => $request->phone,
            'email'             => $request->email ?: null,
            'source'            => $request->source,
            'land_bank_id'      => $request->land_bank_id,
            'unit_id'           => $request->unit_id ?: null,
            'notes'             => $notesFinal ?: null,
            'status'            => $request->status,
            'assigned_to'       => $assignedTo,
            'last_follow_up'    => now(),
            'next_follow_up'    => $request->next_follow_up,
        ]);

        return redirect()->route('home.buku-tamu')->with('success', [
            'name'  => $guest->name,
            'phone' => $guest->phone,
            'id'    => $guest->id,
            'msg'   => 'Terima kasih, ' . $guest->name . '! Data tamu / prospek Anda telah resmi tersimpan di sistem Graha Cipta Sejahtera.'
        ]);
    }
}
