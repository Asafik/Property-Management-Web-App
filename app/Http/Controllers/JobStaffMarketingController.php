<?php

namespace App\Http\Controllers;

use App\Models\MarketingTask;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Notifications\NewTaskNotification;

class JobStaffMarketingController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $positionName = strtolower($user?->position?->name ?? '');
        if ($positionName === 'staff marketing') {
            return redirect()->route('marketing.sosialmedia.tugas')->with('error', 'Akses tugas marketing hanya untuk Kepala Marketing dan Administrator.');
        }

        $query = MarketingTask::with('employee');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_tugas', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%")
                  ->orWhereHas('employee', function($eq) use ($search) {
                      $eq->where('name', 'like', "%{$search}%");
                  });
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('employee_id')) {
            $query->where('employee_id', $request->employee_id);
        }

        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        $totalTugas   = MarketingTask::count();
        $pendingTugas = MarketingTask::where('status', 'Pending')->count();
        $prosesTugas  = MarketingTask::where('status', 'Proses')->count();
        $selesaiTugas = MarketingTask::where('status', 'Selesai')->count();

        $tugas = $query->orderBy('created_at', 'desc')->paginate($request->input('limit', 15))->withQueryString();

        $marketingStaff = Employee::whereHas('position', function ($query) {
            $query->where('name', 'Staff Marketing');
        })->get();

        $kategoriList = \App\Models\MarketingTask::KATEGORI_LABELS;

        return view('marketing.jobstaffmarketing', compact('tugas', 'marketingStaff', 'totalTugas', 'pendingTugas', 'prosesTugas', 'selesaiTugas', 'kategoriList'));
    }


public function store(Request $request)
{
    $request->validate([
        'employee_id' => 'required',
        'kategori'    => 'required|in:sosmed,proyeksi,umum',
        'nama_tugas'  => 'required',
        'deskripsi'   => 'nullable',
        'deadline'    => 'required|date',
        'status'      => 'required|in:Pending,Proses,Selesai',
    ]);

    if ($request->employee_id === 'all') {
        $marketingStaff = Employee::whereHas('position', function ($q) {
            $q->where('name', 'Staff Marketing');
        })->get();

        foreach ($marketingStaff as $staff) {
            $task = MarketingTask::create([
                'employee_id' => $staff->id,
                'kategori'    => $request->kategori,
                'nama_tugas'  => $request->nama_tugas,
                'deskripsi'   => $request->deskripsi,
                'deadline'    => $request->deadline,
                'status'      => $request->status,
            ]);

            try {
                $staff->notify(new NewTaskNotification($task));
            } catch (\Exception $e) {
                // Ignore notification error
            }
        }

        return redirect()->route('master.data.tugas-staff-marketing')->with('success', 'Tugas berhasil didelegasikan ke semua staff marketing (' . $marketingStaff->count() . ' orang).');
    }

    $request->validate([
        'employee_id' => 'exists:employees,id',
    ]);

    $task = MarketingTask::create([
        'employee_id' => $request->employee_id,
        'kategori'    => $request->kategori,
        'nama_tugas'  => $request->nama_tugas,
        'deskripsi'   => $request->deskripsi,
        'deadline'    => $request->deadline,
        'status'      => $request->status,
    ]);

    $employee = Employee::find($request->employee_id);
    if ($employee) {
        try {
            $employee->notify(new NewTaskNotification($task));
        } catch (\Exception $e) {
            // Ignore notification error
        }
    }

    return redirect()->route('master.data.tugas-staff-marketing')->with('success', 'Tugas berhasil ditambahkan.');
}
    public function destroy($id)
    {
        $tugas = MarketingTask::findOrFail($id);
        $tugas->delete();

        return redirect()->route('master.data.tugas-staff-marketing')->with('success', 'Tugas berhasil dihapus.');
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'kategori'    => 'required|in:sosmed,proyeksi,umum',
            'nama_tugas'  => 'required',
            'deskripsi'   => 'nullable',
            'deadline'    => 'required|date',
            'status'      => 'required|in:Pending,Proses,Selesai',
        ]);

        $tugas = MarketingTask::findOrFail($id);
        $tugas->update([
            'employee_id' => $request->employee_id,
            'kategori'    => $request->kategori,
            'nama_tugas'  => $request->nama_tugas,
            'deskripsi'   => $request->deskripsi,
            'deadline'    => $request->deadline,
            'status'      => $request->status,
        ]);

        return redirect()->route('master.data.tugas-staff-marketing')->with('success', 'Tugas berhasil diperbarui.');
    }

    public function create()
    {
        $marketingStaff = Employee::whereHas('position', function ($q) {
            $q->where('name', 'Staff Marketing');
        })->orderBy('name')->get();

        $kategoriList = \App\Models\MarketingTask::KATEGORI_LABELS;

        return view('marketing.create_tugas', compact('marketingStaff', 'kategoriList'));
    }

    public function edit($id)
    {
        $task = MarketingTask::findOrFail($id);

        $marketingStaff = Employee::whereHas('position', function ($q) {
            $q->where('name', 'Staff Marketing');
        })->orderBy('name')->get();

        $kategoriList = \App\Models\MarketingTask::KATEGORI_LABELS;

        return view('marketing.create_tugas', compact('task', 'marketingStaff', 'kategoriList'));
    }


    public function progress($id)
{
    $task = MarketingTask::with(['employee', 'guest'])->findOrFail($id);
    return view('marketing.progress', compact('task'));
}
}
