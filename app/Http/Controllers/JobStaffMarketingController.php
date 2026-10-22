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
            'employee_id'   => 'required',
            'kategori'      => 'required|in:sosmed,proyeksi,umum',
            'nama_tugas'    => 'required|string|max:255',
            'target_jumlah' => 'nullable|integer|min:1',
            'satuan_target' => 'nullable|string|max:50',
            'deskripsi'     => 'nullable',
            'deadline'      => 'required|date',
            'status'        => 'required|in:Pending,Proses,Selesai',
        ]);

        $targetJumlah = max(1, (int) $request->input('target_jumlah', 1));
        $satuanTarget = $request->input('satuan_target') ?: 'Item';

        if ($request->employee_id === 'all') {
            $marketingStaff = Employee::whereHas('position', function ($q) {
                $q->where('name', 'Staff Marketing');
            })->get();

            foreach ($marketingStaff as $staff) {
                $task = MarketingTask::create([
                    'employee_id'      => $staff->id,
                    'kategori'         => $request->kategori,
                    'nama_tugas'       => $request->nama_tugas,
                    'target_jumlah'    => $targetJumlah,
                    'satuan_target'    => $satuanTarget,
                    'realisasi_jumlah' => 0,
                    'deskripsi'        => $request->deskripsi,
                    'deadline'         => $request->deadline,
                    'status'           => $request->status,
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
            'employee_id'      => $request->employee_id,
            'kategori'         => $request->kategori,
            'nama_tugas'       => $request->nama_tugas,
            'target_jumlah'    => $targetJumlah,
            'satuan_target'    => $satuanTarget,
            'realisasi_jumlah' => 0,
            'deskripsi'        => $request->deskripsi,
            'deadline'         => $request->deadline,
            'status'           => $request->status,
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
            'employee_id'      => 'required|exists:employees,id',
            'kategori'         => 'required|in:sosmed,proyeksi,umum',
            'nama_tugas'       => 'required|string|max:255',
            'target_jumlah'    => 'nullable|integer|min:1',
            'satuan_target'    => 'nullable|string|max:50',
            'realisasi_jumlah' => 'nullable|integer|min:0',
            'deskripsi'        => 'nullable',
            'deadline'         => 'required|date',
            'status'           => 'required|in:Pending,Proses,Selesai',
        ]);

        $tugas = MarketingTask::findOrFail($id);

        $targetJumlah = max(1, (int) $request->input('target_jumlah', $tugas->target_jumlah ?? 1));
        $satuanTarget = $request->input('satuan_target') ?: ($tugas->satuan_target ?? 'Item');
        $realisasi    = $request->has('realisasi_jumlah') ? (int) $request->input('realisasi_jumlah') : ($tugas->realisasi_jumlah ?? 0);

        $tugas->update([
            'employee_id'      => $request->employee_id,
            'kategori'         => $request->kategori,
            'nama_tugas'       => $request->nama_tugas,
            'target_jumlah'    => $targetJumlah,
            'satuan_target'    => $satuanTarget,
            'realisasi_jumlah' => $realisasi,
            'deskripsi'        => $request->deskripsi,
            'deadline'         => $request->deadline,
            'status'           => $request->status,
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

    public function updateProgress(Request $request, $id)
    {
        $request->validate([
            'realisasi_jumlah' => 'required|integer|min:0',
            'status'           => 'required|in:Pending,Proses,Selesai',
            'catatan_setor'    => 'nullable|string|max:1000',
        ]);

        $task = MarketingTask::findOrFail($id);

        $task->update([
            'realisasi_jumlah' => (int) $request->realisasi_jumlah,
            'status'           => $request->status,
            'catatan_setor'    => $request->catatan_setor,
        ]);

        return redirect()->back()->with('success', 'Progress realisasi capaian tugas berhasil diperbarui.');
    }
}
