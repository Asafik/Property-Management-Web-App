<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\MasterDokumenPerizinan;
use App\Models\PerizinanTask;
use App\Models\PerizinanTaskLog;
use App\Models\PraLandbank;
use App\Models\LandBank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PerizinanTaskController extends Controller
{
    /**
     * Helper untuk cek role & wewenang user saat ini
     */
    private function getUserRoleContext()
    {
        $user = auth()->user();
        $pos = strtolower($user->position->name ?? '');

        $isStaffLegal   = str_contains($pos, 'staff') && str_contains($pos, 'legal');
        $isKepalaLegal  = str_contains($pos, 'kepala') && str_contains($pos, 'legal');
        $isOwnerOrAdmin = str_contains($pos, 'admin') || str_contains($pos, 'owner') || str_contains($pos, 'direktur') || ($user->division_id == 4);

        // Kepala Legal & Owner / Admin memiliki hak manajerial penuh (assign, edit, delete, pantau semua)
        $canManage = $isKepalaLegal || $isOwnerOrAdmin;

        return [
            'user'           => $user,
            'pos'            => $pos,
            'isStaffLegal'   => $isStaffLegal,
            'isKepalaLegal'  => $isKepalaLegal,
            'isOwnerOrAdmin' => $isOwnerOrAdmin,
            'canManage'      => $canManage,
        ];
    }

    /**
     * Halaman Utama: Daftar Tugas Perizinan
     * - Staf Legal: hanya melihat tugas miliknya
     * - Kepala Legal & Owner: melihat semua tugas & monitoring
     */
    public function index(Request $request)
    {
        $ctx = $this->getUserRoleContext();
        $user = $ctx['user'];
        $canManage = $ctx['canManage'];
        $isStaffLegal = $ctx['isStaffLegal'];

        $query = PerizinanTask::with(['employee.position', 'assigner.position', 'updater.position', 'proyek'])
            ->latest('last_activity_at')
            ->latest('created_at');

        // Batasi untuk Staf Legal jika tidak memiliki hak manajerial
        if ($isStaffLegal && !$canManage) {
            $query->where('employee_id', $user->id);
        }

        // Filter Staf Pelaksana (khusus Kepala Legal / Owner)
        if ($request->filled('employee_id') && $request->employee_id !== 'all') {
            $query->where('employee_id', $request->employee_id);
        }

        // Filter Proyek
        if ($request->filled('proyek_id') && $request->proyek_id !== 'all') {
            $query->where('proyek_id', $request->proyek_id);
        }

        // Filter Status
        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        // Filter Pencarian
        if ($request->filled('search')) {
            $s = trim($request->search);
            $query->where(function ($q) use ($s) {
                $q->where('nama_tugas', 'like', "%{$s}%")
                  ->orWhere('proyek_nama', 'like', "%{$s}%")
                  ->orWhere('instansi', 'like', "%{$s}%")
                  ->orWhere('nomor_dokumen', 'like', "%{$s}%")
                  ->orWhereHas('employee', function ($eq) use ($s) {
                      $eq->where('name', 'like', "%{$s}%");
                  });
            });
        }

        // Hitung KPI Berdasarkan Cakupan Akses User
        $baseKpiQuery = PerizinanTask::query();
        if ($isStaffLegal && !$canManage) {
            $baseKpiQuery->where('employee_id', $user->id);
        }

        $totalTugas     = (clone $baseKpiQuery)->count();
        $tugasPending   = (clone $baseKpiQuery)->where('status', 'Pending')->count();
        $tugasProses    = (clone $baseKpiQuery)->where('status', 'Dalam Proses')->count();
        $tugasSelesai   = (clone $baseKpiQuery)->where('status', 'Selesai')->count();
        $tugasTerkendala= (clone $baseKpiQuery)->where('status', 'Terkendala')->count();

        $tasks = $query->paginate($request->input('limit', 15))->withQueryString();

        // Data Pelengkap Form (Staf Legal, Proyek, Master Dokumen)
        $legalStaffs = Employee::where(function ($q) {
            $q->whereHas('position', function ($pq) {
                $pq->where('name', 'like', '%legal%');
            })->orWhere('division_id', 2);
        })->orderBy('name', 'asc')->get();

        // Jika filter staf kosong, fallback ke semua staf yang ada
        if ($legalStaffs->isEmpty()) {
            $legalStaffs = Employee::orderBy('name', 'asc')->get();
        }

        // Ambil daftar Proyek Kawasan
        $projects = collect();
        try {
            $praList = PraLandbank::where('status', 'approved')
                ->orWhereNotNull('deal_price')
                ->orderBy('land_name', 'asc')
                ->get();
            foreach ($praList as $p) {
                $projects->push([
                    'id'   => $p->id,
                    'nama' => $p->land_name,
                ]);
            }
        } catch (\Throwable $e) {}

        if ($projects->isEmpty()) {
            try {
                $dbLands = LandBank::orderBy('name', 'asc')->get();
                foreach ($dbLands as $dbl) {
                    $projects->push([
                        'id'   => $dbl->id,
                        'nama' => $dbl->name,
                    ]);
                }
            } catch (\Throwable $e) {}
        }

        // Template Master Dokumen Perizinan
        $masterDocs = collect();
        try {
            $masterDocs = MasterDokumenPerizinan::orderBy('urutan', 'asc')->get();
        } catch (\Throwable $e) {}

        return view('perizinan.tugas.index', compact(
            'tasks',
            'ctx',
            'canManage',
            'isStaffLegal',
            'totalTugas',
            'tugasPending',
            'tugasProses',
            'tugasSelesai',
            'tugasTerkendala',
            'legalStaffs',
            'projects',
            'masterDocs'
        ));
    }

    /**
     * Simpan Penugasan Tugas Baru (Kepala Legal / Owner / Admin)
     */
    public function store(Request $request)
    {
        $ctx = $this->getUserRoleContext();
        if (!$ctx['canManage']) {
            return redirect()->back()->with('error', 'Anda tidak memiliki hak akses untuk membagi tugas.');
        }

        $request->validate([
            'nama_tugas'         => 'required|string|max:255',
            'employee_id'        => 'required|exists:employees,id',
            'proyek_id'          => 'nullable',
            'instansi'           => 'nullable|string|max:255',
            'deadline'           => 'nullable|date',
            'catatan'            => 'nullable|string',
            'master_dokumen_id'  => 'nullable|integer',
        ]);

        $proyekNama = null;
        if ($request->filled('proyek_id')) {
            $pra = PraLandbank::find($request->proyek_id);
            $proyekNama = $pra ? $pra->land_name : $request->input('proyek_nama');
        } elseif ($request->filled('proyek_nama')) {
            $proyekNama = $request->input('proyek_nama');
        }

        $task = PerizinanTask::create([
            'proyek_id'          => $request->proyek_id ?: null,
            'proyek_nama'        => $proyekNama,
            'master_dokumen_id'  => $request->master_dokumen_id ?: null,
            'nama_tugas'         => $request->nama_tugas,
            'instansi'           => $request->instansi ?: 'Instansi Terkait',
            'employee_id'        => $request->employee_id,
            'assigned_by'        => $ctx['user']->id,
            'updated_by'         => $ctx['user']->id,
            'deadline'           => $request->deadline,
            'status'             => 'Pending',
            'progress'           => 0,
            'catatan'            => $request->catatan,
            'last_activity_at'   => now(),
        ]);

        // Catat di Audit Trail Log
        $assignedStaff = Employee::find($request->employee_id);
        PerizinanTaskLog::create([
            'perizinan_task_id' => $task->id,
            'user_id'           => $ctx['user']->id,
            'action'            => 'Penugasan Baru',
            'old_status'        => null,
            'new_status'        => 'Pending',
            'old_progress'      => null,
            'new_progress'      => 0,
            'keterangan'        => 'Tugas baru dibuat oleh ' . $ctx['user']->name . ' (' . ($ctx['user']->position->name ?? 'Manajemen') . ') dan didelegasikan kepada ' . ($assignedStaff->name ?? 'Staf') . ($task->deadline ? ' dengan deadline ' . $task->deadline->format('d M Y') : ''),
        ]);

        return redirect()->route('perizinan.tugas.index')->with('success', 'Tugas perizinan berhasil ditugaskan kepada ' . ($assignedStaff->name ?? 'Staf') . '.');
    }

    /**
     * Update Penugasan / Reassign / Edit Detail Tugas (Kepala Legal / Owner)
     */
    public function update(Request $request, $id)
    {
        $ctx = $this->getUserRoleContext();
        if (!$ctx['canManage']) {
            return redirect()->back()->with('error', 'Anda tidak memiliki hak akses untuk mengubah penugasan ini.');
        }

        $task = PerizinanTask::findOrFail($id);

        $request->validate([
            'nama_tugas'   => 'required|string|max:255',
            'employee_id'  => 'required|exists:employees,id',
            'proyek_id'    => 'nullable',
            'instansi'     => 'nullable|string|max:255',
            'deadline'     => 'nullable|date',
            'catatan'      => 'nullable|string',
            'status'       => 'nullable|in:Pending,Dalam Proses,Selesai,Terkendala',
        ]);

        $oldEmployeeId = $task->employee_id;
        $oldStaff = $task->employee;
        $newStaff = Employee::find($request->employee_id);

        $proyekNama = $task->proyek_nama;
        if ($request->filled('proyek_id') && $request->proyek_id != $task->proyek_id) {
            $pra = PraLandbank::find($request->proyek_id);
            $proyekNama = $pra ? $pra->land_name : $task->proyek_nama;
        }

        $oldStatus = $task->status;
        $newStatus = $request->input('status', $oldStatus);

        $task->update([
            'nama_tugas'       => $request->nama_tugas,
            'employee_id'      => $request->employee_id,
            'proyek_id'        => $request->proyek_id ?: $task->proyek_id,
            'proyek_nama'      => $proyekNama,
            'instansi'         => $request->instansi ?: $task->instansi,
            'deadline'         => $request->deadline,
            'catatan'          => $request->catatan,
            'status'           => $newStatus,
            'updated_by'       => $ctx['user']->id,
            'last_activity_at' => now(),
        ]);

        // Catat Log Perubahan
        $logNotes = [];
        $action = 'Edit Penugasan';

        if ($oldEmployeeId != $request->employee_id) {
            $action = 'Pengalihan Tugas (Reassign)';
            $logNotes[] = 'Tugas dialihkan dari ' . ($oldStaff->name ?? 'Staf Lama') . ' ke ' . ($newStaff->name ?? 'Staf Baru');
        }

        if ($oldStatus != $newStatus) {
            $logNotes[] = 'Status diubah dari ' . $oldStatus . ' menjadi ' . $newStatus;
        }

        if (empty($logNotes)) {
            $logNotes[] = 'Informasi penugasan diperbarui oleh ' . $ctx['user']->name;
        }

        PerizinanTaskLog::create([
            'perizinan_task_id' => $task->id,
            'user_id'           => $ctx['user']->id,
            'action'            => $action,
            'old_status'        => $oldStatus,
            'new_status'        => $newStatus,
            'old_progress'      => $task->progress,
            'new_progress'      => $task->progress,
            'keterangan'        => implode('; ', $logNotes),
        ]);

        return redirect()->route('perizinan.tugas.index')->with('success', 'Data penugasan perizinan berhasil diperbarui.');
    }

    /**
     * Update Progres & Status oleh Staf Legal Pelaksana / Kepala Legal
     * Mencatat User mana yang mengupdate, jam, progres %, status, kendala & upload file SK
     */
    public function updateProgress(Request $request, $id)
    {
        $ctx = $this->getUserRoleContext();
        $user = $ctx['user'];
        $task = PerizinanTask::findOrFail($id);

        // Jika staf legal biasa, pastikan hanya boleh update tugasnya sendiri
        if ($ctx['isStaffLegal'] && !$ctx['canManage'] && $task->employee_id !== $user->id) {
            return redirect()->back()->with('error', 'Anda hanya dapat memperbarui tugas yang ditugaskan kepada Anda.');
        }

        $request->validate([
            'status'          => 'required|in:Pending,Dalam Proses,Selesai,Terkendala',
            'progress'        => 'required|integer|min:0|max:100',
            'nomor_dokumen'   => 'nullable|string|max:255',
            'tanggal_terbit'  => 'nullable|date',
            'kendala'         => 'nullable|string',
            'file_dokumen'    => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:15360', // Maks 15MB
        ]);

        $oldStatus   = $task->status;
        $newStatus   = $request->status;
        $oldProgress = $task->progress;
        $newProgress = (int) $request->progress;

        // Harmonisasi Status dan Persentase Progres
        if ($newStatus === 'Selesai') {
            $newProgress = 100;
        } elseif ($newStatus === 'Pending') {
            $newProgress = 0;
        } elseif ($newStatus === 'Terkendala') {
            // Status terkendala tidak boleh 100%
            if ($newProgress >= 100) {
                $newProgress = 50;
            }
        } else { // Dalam Proses
            if ($newProgress === 100) {
                $newStatus = 'Selesai';
            } elseif ($newProgress === 0) {
                $newProgress = 25;
            }
        }

        // Upload Berkas Bukti / SK jika ada
        $filePath = $task->file_dokumen;
        $uploadedFileName = null;
        if ($request->hasFile('file_dokumen')) {
            $file = $request->file('file_dokumen');
            $filename = 'izin_' . $task->id . '_' . time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/perizinan_dokumen', $filename);
            $filePath = 'perizinan_dokumen/' . $filename;
            $uploadedFileName = $file->getClientOriginalName();
        }

        $task->update([
            'status'           => $newStatus,
            'progress'         => $newProgress,
            'nomor_dokumen'    => $request->nomor_dokumen ?: $task->nomor_dokumen,
            'tanggal_terbit'   => $request->tanggal_terbit ?: $task->tanggal_terbit,
            'kendala'          => $request->kendala,
            'file_dokumen'     => $filePath,
            'updated_by'       => $user->id,
            'last_activity_at' => now(),
        ]);

        // Bentuk keterangan log yang jelas dan informatif
        $details = [];
        if ($oldStatus !== $newStatus) {
            $details[] = "Status berubah dari '{$oldStatus}' ke '{$newStatus}'";
        }
        if ($oldProgress !== $newProgress) {
            $details[] = "Progres dinaikkan dari {$oldProgress}% menjadi {$newProgress}%";
        }
        if ($uploadedFileName) {
            $details[] = "Mengunggah dokumen SK/Izin: {$uploadedFileName}";
        }
        if ($request->filled('nomor_dokumen') && $request->nomor_dokumen !== $task->nomor_dokumen) {
            $details[] = "Nomor Dokumen: {$request->nomor_dokumen}";
        }
        if ($request->filled('kendala')) {
            $details[] = "Catatan: " . $request->kendala;
        }

        $keteranganLog = !empty($details) 
            ? implode(" | ", $details)
            : "Memperbarui status dan progres pekerjaan oleh " . $user->name;

        // Catat Riwayat Perubahan ke tabel Audit Trail
        PerizinanTaskLog::create([
            'perizinan_task_id' => $task->id,
            'user_id'           => $user->id,
            'action'            => $newStatus === 'Selesai' ? 'Izin Terbit & Selesai' : ($newStatus === 'Terkendala' ? 'Laporan Kendala Lapangan' : 'Update Progres'),
            'old_status'        => $oldStatus,
            'new_status'        => $newStatus,
            'old_progress'      => $oldProgress,
            'new_progress'      => $newProgress,
            'keterangan'        => $keteranganLog,
            'file_dokumen'      => $filePath,
        ]);

        return redirect()->back()->with('success', 'Progres dan status perizinan berhasil diperbarui oleh ' . $user->name . '.');
    }

    /**
     * API JSON: Mengambil Riwayat Perubahan (Audit Trail Timeline) untuk sebuah tugas
     */
    public function getLogs($id)
    {
        $task = PerizinanTask::with([
            'logs.user.position',
            'employee.position',
            'assigner.position',
            'updater.position',
            'proyek'
        ])->findOrFail($id);

        $logData = $task->logs->map(function ($log) {
            return [
                'id'           => $log->id,
                'action'       => $log->action,
                'user_name'    => $log->user->name ?? 'Sistem',
                'user_pos'     => $log->user->position->name ?? 'Staff',
                'old_status'   => $log->old_status,
                'new_status'   => $log->new_status,
                'old_progress' => $log->old_progress,
                'new_progress' => $log->new_progress,
                'keterangan'   => $log->keterangan,
                'file_url'     => $log->file_dokumen ? asset('storage/' . $log->file_dokumen) : null,
                'created_at'   => $log->created_at->format('d M Y, H:i'),
                'time_ago'     => $log->created_at->diffForHumans(),
            ];
        });

        return response()->json([
            'status'  => 'success',
            'task'    => [
                'id'            => $task->id,
                'nama_tugas'    => $task->nama_tugas,
                'proyek_nama'   => $task->proyek_nama,
                'status'        => $task->status,
                'progress'      => $task->progress,
                'staff_name'    => $task->employee->name ?? '-',
                'staff_pos'     => $task->employee->position->name ?? 'Staff Legal',
                'assigner_name' => $task->assigner->name ?? '-',
                'updater_name'  => $task->updater->name ?? '-',
                'updater_pos'   => $task->updater->position->name ?? '-',
                'nomor_dokumen' => $task->nomor_dokumen,
                'file_url'      => $task->file_dokumen ? asset('storage/' . $task->file_dokumen) : null,
            ],
            'logs'    => $logData,
        ]);
    }

    /**
     * Hapus Tugas (Kepala Legal / Owner / Admin)
     */
    public function destroy($id)
    {
        $ctx = $this->getUserRoleContext();
        if (!$ctx['canManage']) {
            return redirect()->back()->with('error', 'Anda tidak memiliki hak akses untuk menghapus tugas ini.');
        }

        $task = PerizinanTask::findOrFail($id);
        if ($task->file_dokumen && Storage::exists('public/' . $task->file_dokumen)) {
            Storage::delete('public/' . $task->file_dokumen);
        }
        $task->delete();

        return redirect()->route('perizinan.tugas.index')->with('success', 'Tugas perizinan berhasil dihapus.');
    }
}
