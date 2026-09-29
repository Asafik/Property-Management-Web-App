<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LandBank;
use App\Models\PraLandbank;
use App\Models\MasterDokumenPerizinan;
use App\Models\PerizinanTask;
use Illuminate\Http\Request;

class PerizinanController extends Controller
{
    /**
     * Halaman Utama: Monitoring Perizinan Proyek (Daftar Proyek Kawasan).
     * Mengambil tanah yang sudah DEAL DIBELI (Fase 3 Selesai / Sidang Approved),
     * baik dengan skema pembayaran Cash maupun Termin.
     */
    public function index(Request $request)
    {
        $projects = $this->getProjectsList();
        $allPermits = $this->getAllPermits($projects);

        // Map progress & status perizinan dari daftar izin aktual
        $projects = $projects->map(function ($proj) use ($allPermits) {
            $pList = $allPermits->where('proyek_id', $proj['id']);
            $total = $pList->count();
            $terbit = $pList->whereIn('status', ['Selesai', 'Terbit'])->count();
            $proses = $pList->whereIn('status', ['Berjalan', 'Proses'])->count();
            $revisi = $pList->whereIn('status', ['Tertunda', 'Revisi'])->count();

            // Progress rata-rata seluruh dokumen perizinan proyek
            $progress = $total > 0 ? round($pList->avg('progress')) : 0;

            // Status proyek kawasan
            if ($total > 0 && $terbit === $total) {
                $status = 'Selesai';
            } elseif ($revisi > 0) {
                $status = 'Tertunda';
            } elseif ($proses > 0 || $terbit > 0 || $progress > 0) {
                $status = 'Berjalan';
            } else {
                $status = 'Belum';
            }

            $proj['total']    = $total;
            $proj['terbit']   = $terbit;
            $proj['proses']   = $proses;
            $proj['revisi']   = $revisi;
            $proj['progress'] = $progress;
            $proj['status']   = $status;
            return $proj;
        });

        // Filter Pencarian
        $search = trim($request->get('search', ''));
        if (!empty($search)) {
            $searchLower = strtolower($search);
            $projects = $projects->filter(function ($proj) use ($searchLower) {
                return str_contains(strtolower($proj['nama']), $searchLower)
                    || str_contains(strtolower($proj['lokasi'] ?? ''), $searchLower)
                    || str_contains(strtolower($proj['ownership_status'] ?? ''), $searchLower)
                    || str_contains(strtolower($proj['pt'] ?? ''), $searchLower);
            });
        }

        // Filter Status
        $filterStatus = $request->get('status');
        if (!empty($filterStatus) && $filterStatus !== 'all') {
            $projects = $projects->where('status', $filterStatus);
        }

        // Global KPI Metrics (Format Dashboard)
        $totalIzin    = $allPermits->count();
        $totalSelesai = $allPermits->whereIn('status', ['Selesai', 'Terbit'])->count();
        $dalamProses  = $allPermits->whereIn('status', ['Berjalan', 'Proses'])->count();
        $tertunda     = $allPermits->whereIn('status', ['Tertunda', 'Revisi'])->count();

        $totalTugasPerizinan = 0;
        try {
            $totalTugasPerizinan = PerizinanTask::count();
        } catch (\Throwable $e) {}

        return view('perizinan.index', compact(
            'projects',
            'filterStatus',
            'search',
            'totalIzin',
            'totalSelesai',
            'dalamProses',
            'tertunda',
            'totalTugasPerizinan'
        ));
    }

    /**
     * Halaman Detail: Rincian Tabel Perizinan untuk Proyek Terpilih.
     */
    /**
     * Halaman Detail: Rincian Tabel Perizinan untuk Proyek Terpilih.
     */
    public function show(Request $request, $id)
    {
        $user = auth()->user();
        $pos = strtolower($user->position->name ?? '');
        $isStaffLegal = str_contains($pos, 'staff') && str_contains($pos, 'legal');
        $canManage = str_contains($pos, 'kepala') || str_contains($pos, 'admin') || str_contains($pos, 'owner') || str_contains($pos, 'direktur') || ($user && $user->division_id == 4);

        $projects = $this->getProjectsList();
        if ($projects->isEmpty()) {
            return redirect()->route('perizinan.index')->with('info', 'Belum ada data proyek kawasan tanah yang siap diproses perizinan.');
        }

        $allPermits = $this->getAllPermits($projects);

        // Cari data proyek
        $project = $projects->firstWhere('id', (int) $id) ?? $projects->first();

        // Ambil data perizinan milik proyek ini
        $projectAllPermits = $allPermits->where('proyek_id', $project['id']);

        // Jika Staff Legal (bukan Kepala Legal / Admin), filter hanya izin yang ditugaskan ke staf ini
        if ($isStaffLegal && !$canManage) {
            $permits = $projectAllPermits->where('employee_id', $user->id);
        } else {
            $permits = $projectAllPermits;
        }

        // Filter Status di dalam proyek
        $filterStatus = $request->get('status');
        if (!empty($filterStatus) && $filterStatus !== 'all') {
            $permits = $permits->where('status', $filterStatus);
        }

        // Filter Pencarian di dalam rincian izin
        $search = trim($request->get('search', ''));
        if (!empty($search)) {
            $searchLower = strtolower($search);
            $permits = $permits->filter(function ($item) use ($searchLower) {
                return str_contains(strtolower($item['nama_izin']), $searchLower)
                    || str_contains(strtolower($item['no_izin'] ?? ''), $searchLower)
                    || str_contains(strtolower($item['instansi'] ?? ''), $searchLower)
                    || str_contains(strtolower($item['catatan'] ?? ''), $searchLower);
            });
        }

        // Metrik Proyek Terpilih
        $totalIzin   = $permits->count();
        $totalTerbit = $permits->where('status', 'Terbit')->count();
        $totalProses = $permits->where('status', 'Proses')->count();
        $totalRevisi = $permits->where('status', 'Revisi')->count();
        $projectProgress = $totalIzin > 0 ? round($permits->avg('progress')) : 0;

        return view('perizinan.show', compact(
            'project',
            'permits',
            'filterStatus',
            'search',
            'totalIzin',
            'totalTerbit',
            'totalProses',
            'totalRevisi',
            'projectProgress',
            'isStaffLegal',
            'canManage'
        ));
    }

    /**
     * Halaman Khusus: Kelola Dokumen Perizinan & Prasyarat (Dedicated Page)
     */
    public function kelolaDokumen(Request $request, $id, $item_id)
    {
        $projects = $this->getProjectsList();
        $project = $projects->firstWhere('id', (int) $id) ?? $projects->first();
        if (!$project) {
            return redirect()->route('perizinan.index')->with('error', 'Proyek kawasan tidak ditemukan.');
        }

        $allPermits = $this->getAllPermits($projects);
        $permits = $allPermits->where('proyek_id', $project['id']);

        if ($item_id === 'baru') {
            $item = [
                'id'             => 'baru',
                'master_id'      => null,
                'task_id'        => null,
                'proyek_id'      => $project['id'],
                'proyek_nama'    => $project['nama'],
                'poin_label'     => 'Poin Baru',
                'nama_izin'      => '',
                'instansi'       => '',
                'target_selesai' => '-',
                'no_izin'        => '',
                'tanggal'        => date('d/m/Y'),
                'status'         => 'Belum',
                'progress'       => 0,
                'catatan'        => '',
                'file_dokumen'   => null,
                'pelaksana'      => null,
                'syarat_items'   => [
                    'Salinan KTP & NPWP Direksi PT Developer',
                    'Akta Pendirian & Legalitas PT Perusahaan',
                    'Surat Permohonan Resmi ke Dinas Terkait',
                ],
                'syarat_files'   => [],
                'estimasi_hari'  => 14,
                'estimasi_biaya' => 0,
            ];
        } else {
            $item = $permits->firstWhere('id', (int) $item_id)
                ?? $permits->firstWhere('master_id', (int) $item_id)
                ?? $permits->firstWhere('task_id', (int) $item_id);

            if (!$item) {
                return redirect()->route('perizinan.show', $id)->with('error', 'Dokumen perizinan tidak ditemukan.');
            }
        }

        // Ambil model lahan proyek (PraLandbank atau LandBank)
        $record = null;
        if (!empty($project['pra_id'])) {
            $record = PraLandbank::find($project['pra_id']);
        } elseif (!empty($project['land_bank_id'])) {
            $record = LandBank::find($project['land_bank_id']);
        }
        if (!$record) {
            $record = PraLandbank::find($project['id']) ?? LandBank::find($project['id']);
        }

        // Muat custom_workflow_docs dari lahan jika ada
        $customDocs = $record ? ($record->custom_workflow_docs ?? []) : [];
        if (!is_array($customDocs)) $customDocs = [];

        $matchedDoc = null;
        if (!empty($customDocs) && $item_id !== 'baru') {
            foreach ($customDocs as $cd) {
                if (!empty($item['master_id']) && !empty($cd['master_id']) && $cd['master_id'] == $item['master_id']) {
                    $matchedDoc = $cd;
                    break;
                }
                if (!empty($cd['doc_name']) && !empty($item['nama_izin'])) {
                    $cdName = strtolower(trim($cd['doc_name']));
                    $itName = strtolower(trim($item['nama_izin']));
                    if ($cdName === $itName || str_contains($cdName, $itName) || str_contains($itName, $cdName)) {
                        $matchedDoc = $cd;
                        break;
                    }
                }
            }
        }

        if ($matchedDoc) {
            if (!empty($matchedDoc['syarat_files'])) {
                $item['syarat_files'] = $matchedDoc['syarat_files'];
            }
            if (!empty($matchedDoc['syarat_items'])) {
                $item['syarat_items'] = $matchedDoc['syarat_items'];
            }
            if (!empty($matchedDoc['syarat_checklist'])) {
                $item['syarat_checklist'] = $matchedDoc['syarat_checklist'];
            }
            if (!empty($matchedDoc['file_path']) && empty($item['file_dokumen'])) {
                $item['file_dokumen'] = $matchedDoc['file_path'];
            }
            if (!empty($matchedDoc['doc_number']) && empty($item['no_izin'])) {
                $item['no_izin'] = $matchedDoc['doc_number'];
            }
            if (!empty($matchedDoc['doc_date']) && ($item['tanggal'] === '-' || empty($item['tanggal']))) {
                $item['tanggal'] = $matchedDoc['doc_date'];
            }
        }
        if (!isset($item['syarat_files'])) {
            $item['syarat_files'] = [];
        }

        // Hitung progres riil berdasarkan berkas prasyarat yang telah diunggah
        $totalSyarat = count($item['syarat_items'] ?? []);
        $uploadedCount = 0;
        foreach (($item['syarat_items'] ?? []) as $sIdx => $sName) {
            if (!empty($item['syarat_files'][$sIdx]) || !empty($item['syarat_files'][$sName])) {
                $uploadedCount++;
            }
        }
        $calculatedProgress = $totalSyarat > 0 ? (int) round(($uploadedCount / $totalSyarat) * 100) : (int) ($item['progress'] ?? 0);
        if (!empty($item['file_dokumen']) || $item['status'] === 'Terbit') {
            $calculatedProgress = 100;
        }
        $item['progress'] = $calculatedProgress;
        $item['uploaded_count'] = $uploadedCount;

        $user = auth()->user();
        $pos = strtolower($user->position->name ?? '');
        $isStaffLegal = str_contains($pos, 'staff') && str_contains($pos, 'legal');
        $canManage = str_contains($pos, 'kepala') || str_contains($pos, 'admin') || str_contains($pos, 'owner') || str_contains($pos, 'direktur') || ($user && $user->division_id == 4);

        if ($isStaffLegal && !$canManage) {
            if ($item_id === 'baru') {
                return redirect()->route('perizinan.show', $id)->with('error', 'Hanya Kepala Legal dan Admin yang dapat menambah tugas perizinan baru.');
            }
            if ($item && !empty($item['employee_id']) && $item['employee_id'] != $user->id) {
                return redirect()->route('perizinan.show', $id)->with('error', 'Anda hanya dapat mengelola dokumen perizinan yang ditugaskan kepada Anda.');
            }
        }

        return view('perizinan.kelola', compact('project', 'item', 'item_id'));
    }

    /**
     * Simpan Data Kelola Dokumen Perizinan
     */
    public function simpanKelolaDokumen(Request $request, $id, $item_id)
    {
        $projects = $this->getProjectsList();
        $project = $projects->firstWhere('id', (int) $id) ?? $projects->first();
        if (!$project) {
            return redirect()->route('perizinan.index')->with('error', 'Proyek kawasan tidak ditemukan.');
        }

        $allPermits = $this->getAllPermits($projects);
        $permits = $allPermits->where('proyek_id', $project['id']);

        $item = null;
        if ($item_id !== 'baru') {
            $item = $permits->firstWhere('id', (int) $item_id)
                ?? $permits->firstWhere('master_id', (int) $item_id)
                ?? $permits->firstWhere('task_id', (int) $item_id);
        }

        $request->validate([
            'nama_izin'      => 'nullable|string|max:255',
            'status'         => 'required|string',
            'progress'       => 'nullable|integer|min:0|max:100',
            'no_izin'        => 'nullable|string|max:255',
            'tanggal'        => 'nullable|string',
            'instansi'       => 'nullable|string|max:255',
            'target_selesai' => 'nullable|string',
            'catatan'        => 'nullable|string',
            'file_dokumen'   => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:20480',
        ]);

        // 1. Ambil Model Lahan (PraLandbank atau LandBank) untuk custom_workflow_docs
        $record = null;
        if (!empty($project['pra_id'])) {
            $record = PraLandbank::find($project['pra_id']);
        } elseif (!empty($project['land_bank_id'])) {
            $record = LandBank::find($project['land_bank_id']);
        }
        if (!$record) {
            $record = PraLandbank::find($project['id']) ?? LandBank::find($project['id']);
        }

        $currentDocs = $record ? ($record->custom_workflow_docs ?? []) : [];
        if (!is_array($currentDocs)) $currentDocs = [];

        $namaTugas = $request->filled('nama_izin') 
            ? $request->nama_izin 
            : ($item['nama_izin'] ?? 'Dokumen Perizinan Kawasan');

        // Cari index doc yang cocok di custom_workflow_docs
        $existingDocIndex = -1;
        foreach ($currentDocs as $idx => $cd) {
            if ($item && !empty($item['master_id']) && !empty($cd['master_id']) && $cd['master_id'] == $item['master_id']) {
                $existingDocIndex = $idx;
                break;
            }
            if (!empty($cd['doc_name'])) {
                $cdName = strtolower(trim($cd['doc_name']));
                $tName = strtolower(trim($namaTugas));
                if ($cdName === $tName || str_contains($cdName, $tName) || str_contains($tName, $cdName)) {
                    $existingDocIndex = $idx;
                    break;
                }
            }
        }

        // 2. Daftar Syarat Items
        $syaratItems = $request->input('syarat_items', []);
        if (is_string($syaratItems)) {
            $syaratItems = json_decode($syaratItems, true) ?: [];
        }
        if (empty($syaratItems) && $existingDocIndex >= 0 && !empty($currentDocs[$existingDocIndex]['syarat_items'])) {
            $syaratItems = $currentDocs[$existingDocIndex]['syarat_items'];
        }
        if (empty($syaratItems) && $item && !empty($item['syarat_items'])) {
            $syaratItems = $item['syarat_items'];
        }
        if (empty($syaratItems)) {
            $syaratItems = ['Salinan Akta Pelepasan Hak dari Notaris', 'Berkas Kepemilikan Tanah Asli', 'Legalitas Perusahaan PT'];
        }
        $syaratItems = array_values($syaratItems);

        // 3. Syarat Files: Berkas yang sudah ada sebelumnya
        $existingSyaratFiles = [];
        if ($existingDocIndex >= 0 && !empty($currentDocs[$existingDocIndex]['syarat_files'])) {
            $existingSyaratFiles = (array) $currentDocs[$existingDocIndex]['syarat_files'];
        }
        if ($request->has('existing_syarat_files')) {
            $passedExisting = $request->input('existing_syarat_files');
            if (is_string($passedExisting)) {
                $passedExisting = json_decode($passedExisting, true) ?: [];
            }
            if (is_array($passedExisting)) {
                foreach ($passedExisting as $k => $v) {
                    if (!empty($v)) $existingSyaratFiles[$k] = $v;
                }
            }
        }

        // Tangani penghapusan berkas prasyarat
        if ($request->has('deleted_syarat_files')) {
            $deleted = $request->input('deleted_syarat_files');
            if (is_string($deleted)) {
                $deleted = json_decode($deleted, true) ?: [];
            }
            if (is_array($deleted)) {
                foreach ($deleted as $delKey) {
                    unset($existingSyaratFiles[$delKey]);
                    if (isset($syaratItems[$delKey])) {
                        unset($existingSyaratFiles[$syaratItems[$delKey]]);
                    }
                }
            }
        }

        // 4. Unggah berkas prasyarat baru
        $syaratFiles = $existingSyaratFiles;
        $destSyarat = public_path('uploads/perizinan_prasyarat/' . $project['id']);
        if (!file_exists($destSyarat)) {
            mkdir($destSyarat, 0755, true);
        }

        if ($request->hasFile('syarat_files')) {
            $uploadedFiles = $request->file('syarat_files');
            if (is_array($uploadedFiles)) {
                foreach ($uploadedFiles as $sKey => $sFile) {
                    if ($sFile && $sFile->isValid()) {
                        $sName = uniqid() . '_syarat_' . preg_replace('/[^a-zA-Z0-9_\.-]/', '_', $sFile->getClientOriginalName());
                        $sFile->move($destSyarat, $sName);
                        $savedPath = 'uploads/perizinan_prasyarat/' . $project['id'] . '/' . $sName;
                        $syaratFiles[$sKey] = $savedPath;
                        if (isset($syaratItems[$sKey])) {
                            $syaratFiles[$syaratItems[$sKey]] = $savedPath;
                        }
                    }
                }
            }
        }

        // Tangani jika ada input file individual seperti syarat_file_{idx}
        foreach ($request->allFiles() as $fileKey => $sFile) {
            if (str_starts_with($fileKey, 'syarat_file_') && $sFile && $sFile->isValid()) {
                $rawIdx = str_replace('syarat_file_', '', $fileKey);
                $sName = uniqid() . '_syarat_' . preg_replace('/[^a-zA-Z0-9_\.-]/', '_', $sFile->getClientOriginalName());
                $sFile->move($destSyarat, $sName);
                $savedPath = 'uploads/perizinan_prasyarat/' . $project['id'] . '/' . $sName;
                $syaratFiles[$rawIdx] = $savedPath;
                if (isset($syaratItems[$rawIdx])) {
                    $syaratFiles[$syaratItems[$rawIdx]] = $savedPath;
                }
            }
        }

        // 5. Perhitungan Persentase Progres Otomatis dari Berkas Prasyarat
        $totalSyarat = count($syaratItems);
        $uploadedCount = 0;
        foreach ($syaratItems as $sIdx => $sTitle) {
            if (!empty($syaratFiles[$sIdx]) || !empty($syaratFiles[$sTitle])) {
                $uploadedCount++;
            }
        }
        $calculatedProgress = $totalSyarat > 0 ? (int) round(($uploadedCount / $totalSyarat) * 100) : 0;

        // Tangani Berkas Utama SK (jika ada)
        $mainFilePath = null;
        if ($request->hasFile('file_dokumen')) {
            $file = $request->file('file_dokumen');
            $filename = 'izin_' . ($item['task_id'] ?? time()) . '_' . time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/perizinan_dokumen', $filename);
            $mainFilePath = 'perizinan_dokumen/' . $filename;
        }

        // Penentuan Status dan Progres Akhir
        $inputStatus = $request->status; // 'Belum', 'Proses', 'Terbit', 'Revisi'
        if ($inputStatus === 'Terbit' || $inputStatus === 'Selesai' || $mainFilePath || $calculatedProgress >= 100) {
            $progress = 100;
            $dbStatus = 'Selesai';
            $statusStr = 'Terbit';
        } elseif ($inputStatus === 'Revisi' || $inputStatus === 'Tertunda') {
            $progress = $calculatedProgress;
            $dbStatus = 'Terkendala';
            $statusStr = 'Revisi';
        } elseif ($calculatedProgress > 0 || $inputStatus === 'Proses') {
            $progress = $calculatedProgress > 0 ? $calculatedProgress : 50;
            $dbStatus = 'Dalam Proses';
            $statusStr = 'Proses';
        } else {
            $progress = 0;
            $dbStatus = 'Pending';
            $statusStr = 'Belum';
        }

        // 6. Simpan / Perbarui custom_workflow_docs pada model Lahan
        if ($record) {
            $docId = ($existingDocIndex >= 0 && !empty($currentDocs[$existingDocIndex]['id'])) 
                ? $currentDocs[$existingDocIndex]['id'] 
                : ('doc_' . uniqid());

            $docPayload = [
                'id'               => $docId,
                'master_id'        => $item['master_id'] ?? ($existingDocIndex >= 0 ? ($currentDocs[$existingDocIndex]['master_id'] ?? null) : null),
                'poin_label'       => $item['poin_label'] ?? ($existingDocIndex >= 0 ? ($currentDocs[$existingDocIndex]['poin_label'] ?? 'Poin') : 'Poin'),
                'doc_name'         => $namaTugas,
                'instansi'         => $request->instansi ?: ($item['instansi'] ?? '-'),
                'doc_number'       => $request->no_izin ?: ($existingDocIndex >= 0 ? ($currentDocs[$existingDocIndex]['doc_number'] ?? '') : ''),
                'doc_date'         => $request->tanggal ?: ($existingDocIndex >= 0 ? ($currentDocs[$existingDocIndex]['doc_date'] ?? '') : ''),
                'status'           => strtolower($statusStr),
                'progress'         => $progress,
                'notes'            => $request->catatan,
                'syarat_items'     => $syaratItems,
                'syarat_files'     => $syaratFiles,
                'file_path'        => $mainFilePath ?: ($existingDocIndex >= 0 ? ($currentDocs[$existingDocIndex]['file_path'] ?? null) : null),
                'updated_at'       => now()->toDateTimeString(),
            ];

            if ($existingDocIndex >= 0) {
                $currentDocs[$existingDocIndex] = array_merge($currentDocs[$existingDocIndex], $docPayload);
            } else {
                $docPayload['created_at'] = now()->toDateTimeString();
                $currentDocs[] = $docPayload;
            }

            $record->custom_workflow_docs = $currentDocs;
            $record->save();

            // Sinkronisasi dua arah ke pasangan lahan jika ada
            if ($record instanceof PraLandbank && !empty($record->land_bank_id)) {
                $lb = LandBank::find($record->land_bank_id);
                if ($lb) {
                    $lb->custom_workflow_docs = $currentDocs;
                    $lb->save();
                }
            } elseif ($record instanceof LandBank) {
                $pra = PraLandbank::where('land_bank_id', $record->id)->first();
                if ($pra) {
                    $pra->custom_workflow_docs = $currentDocs;
                    $pra->save();
                }
            }
        }

        // 7. Simpan atau Perbarui PerizinanTask
        $task = null;
        if ($item && !empty($item['task_id'])) {
            $task = PerizinanTask::find($item['task_id']);
        }
        if (!$task && $item && !empty($item['master_id'])) {
            $task = PerizinanTask::where('proyek_id', $project['id'])
                ->where('master_dokumen_id', $item['master_id'])
                ->first();
        }
        if (!$task) {
            $task = PerizinanTask::where('proyek_id', $project['id'])
                ->where('nama_tugas', $namaTugas)
                ->first();
        }

        $authUserId = auth()->id() ?? 2;
        $employeeId = 2; // Default Kepala Legal
        try {
            $emp = \App\Models\Employee::find($authUserId);
            if ($emp) {
                $employeeId = $emp->id;
            } else {
                $firstLegal = \App\Models\Employee::whereHas('position', function($q) {
                    $q->where('name', 'like', '%legal%');
                })->first();
                if ($firstLegal) $employeeId = $firstLegal->id;
            }
        } catch (\Throwable $e) {}

        if (!$task) {
            $task = new PerizinanTask();
            $task->proyek_id          = $project['id'];
            $task->proyek_nama        = $project['nama'];
            $task->master_dokumen_id  = $item['master_id'] ?? null;
            $task->nama_tugas         = $namaTugas;
            $task->instansi           = $request->instansi ?: ($item['instansi'] ?? 'Instansi Terkait');
            $task->employee_id        = $employeeId;
            $task->assigned_by        = $employeeId;
        }

        if ($mainFilePath) {
            $task->file_dokumen = $mainFilePath;
        }

        // Format tanggal jika dikirim YYYY-MM-DD
        $tglTerbit = null;
        if ($request->filled('tanggal')) {
            try {
                $tglTerbit = date('Y-m-d', strtotime($request->tanggal));
            } catch (\Throwable $e) {}
        }

        $deadline = null;
        if ($request->filled('target_selesai')) {
            try {
                $deadline = date('Y-m-d', strtotime($request->target_selesai));
            } catch (\Throwable $e) {}
        }

        $task->status           = $dbStatus;
        $task->progress         = $progress;
        $task->nomor_dokumen    = $request->no_izin ?: $task->nomor_dokumen;
        $task->tanggal_terbit   = $tglTerbit ?: $task->tanggal_terbit;
        $task->deadline         = $deadline ?: $task->deadline;
        $task->instansi         = $request->instansi ?: $task->instansi;
        $task->catatan          = $request->catatan;
        $task->kendala          = ($dbStatus === 'Terkendala') ? $request->catatan : null;
        $task->updated_by       = $employeeId;
        $task->last_activity_at = now();
        $task->save();

        return redirect()->route('perizinan.show', $project['id'])
            ->with('success', 'Dokumen perizinan "' . $task->nama_tugas . '" berhasil diperbarui! Progres berkas: ' . $progress . '% (' . $uploadedCount . '/' . $totalSyarat . ' prasyarat terunggah).');
    }

    /**
     * Finalisasi Lahan dari Perizinan ke Pasca Land Bank
     */
    public function finalizeToPasca(Request $request, $id)
    {
        // 1. Cari data PraLandbank berdasarkan ID atau nama proyek
        $record = PraLandbank::find($id);

        if (!$record) {
            // Jika ID yang dikirim adalah ID bentukan (misal $dbl->id + 100) atau langsung LandBank
            $landBank = LandBank::find($id) ?? LandBank::find($id - 100);
            if ($landBank) {
                return response()->json([
                    'success'      => true,
                    'message'      => 'Kawasan ' . $landBank->name . ' sudah berada di Pasca Land Bank.',
                    'land_bank_id' => $landBank->id,
                    'redirect_url' => route('properti.edit', ['id' => $landBank->id]),
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Data proyek kawasan tidak ditemukan.'
            ], 404);
        }

        // Ambil ID profil perusahaan default
        $companyId = \App\Models\CompanyProfile::first()->id ?? null;
        $totalArea = $record->field_area ?: ($record->area ?: 0);

        // Buat atau update data di LandBank (Pasca Land Bank)
        $landBank = null;
        if ($record->land_bank_id) {
            $landBank = LandBank::find($record->land_bank_id);
        }
        if (!$landBank) {
            $landBank = LandBank::where('name', $record->land_name)->first();
        }

        // Alur kerja dokumen pengindukan (custom_workflow_docs)
        $workflowDocs = $record->custom_workflow_docs;
        if (empty($workflowDocs)) {
            $workflowDocs = \App\Http\Controllers\Admin\PropertyController::getDefaultFase4Templates($record);
        }

        $landBankData = [
            'name'                      => $record->land_name,
            'company_profile_id'        => $companyId,
            'certificate_no'            => $record->certificate_no ?: ($record->land_name . ' (' . ($record->ownership_status ?? 'SHM') . ')'),
            'ownership_status'          => $record->ownership_status ?: 'SHM',
            'certificate_owner'         => $record->certificate_owner ?: ($record->owner_name ?: '-'),
            'custom_workflow_docs'      => $workflowDocs,
            'area'                      => $totalArea,
            'remaining_area'            => $totalArea,
            'acquisition_price'         => $record->deal_price ?: ($record->offer_price ?: 0),
            'acquisition_date'          => $record->survey_date ?: now()->toDateString(),
            'address'                   => $record->address ?: '-',
            'village'                   => $record->village ?: '-',
            'district'                  => $record->district ?: '-',
            'city'                      => $record->city ?: '-',
            'province'                  => $record->province ?: '-',
            'zoning'                    => $record->zoning ?: '-',
            'road_width'                => (isset($record->road_width) && is_numeric($record->road_width)) ? (int)$record->road_width : null,
            'road_type'                 => $record->road_type ?: '-',
            'lat'                       => $record->lat,
            'lng'                       => $record->lng,
            'file_certificate'          => $record->file_certificate,
            'file_pbb'                  => $record->pbb_mutasi_file,
            'photo'                     => $record->photo,
            'denah'                     => $record->peta_bidang_file,
            'status'                    => 'aktif',
            'legal_status'              => 'aman',
            'development_status'        => 'Belum',
            'description'               => 'Tanah Induk dialihkan dari Perizinan Proyek #' . $record->id . ' (' . $record->land_name . ')',
        ];

        if ($landBank) {
            $landBank->update($landBankData);
        } else {
            $landBank = LandBank::create($landBankData);
        }

        // Hubungkan pra_landbank ke land_bank
        $record->update([
            'land_bank_id' => $landBank->id,
            'status'       => 'approved',
        ]);

        return response()->json([
            'success'      => true,
            'message'      => 'Kawasan ' . $record->land_name . ' berhasil dialihkan ke Pasca Land Bank!',
            'land_bank_id' => $landBank->id,
            'redirect_url' => route('properti.edit', ['id' => $landBank->id]),
        ]);
    }

    /**
     * Koleksi Data Proyek / Kawasan Tanah:
     * Mengambil tanah yang sudah DEAL DIBELI (Fase 3 Selesai / Approved di PraLandbank),
     * baik skema cash maupun termin.
     */
    private function getProjectsList()
    {
        $projects = collect();

        // 1. Ambil data dari PraLandbank yang berstatus 'approved' / sudah deal sidang
        try {
            $approvedPraLands = PraLandbank::with('landBank')
                ->where('status', 'approved')
                ->orWhere('status', 'fase3')
                ->orWhereNotNull('deal_price')
                ->orWhereIn('payment_method', ['cash', 'termin'])
                ->get();

            foreach ($approvedPraLands as $pra) {
                $lokasi = $pra->city ?? ($pra->district ?? ($pra->address ?: 'Jember'));
                $paymentMethod = $pra->payment_method ? ucwords($pra->payment_method) : 'Termin / Cash';
                
                $landBankId = $pra->land_bank_id;
                if (!$landBankId) {
                    $foundLb = LandBank::where('name', $pra->land_name)->first();
                    if ($foundLb) {
                        $landBankId = $foundLb->id;
                    }
                }

                $projects->push([
                    'id'                     => $pra->id,
                    'pra_id'                 => $pra->id,
                    'land_bank_id'           => $landBankId,
                    'is_finalized_to_pasca'  => !empty($landBankId),
                    'nama'                   => $pra->land_name,
                    'pt'                     => 'PT Graha Cipta Sejahtera',
                    'lokasi'                 => $lokasi,
                    'luas'                   => number_format($pra->area ?? 0, 0, ',', '.') . ' m²',
                    'ownership_status'       => $pra->ownership_status ?: 'SHGB Induk',
                    'payment_method'         => $paymentMethod,
                    'deal_price'             => $pra->deal_price,
                    'target_selesai'         => '-',
                    'progress'               => 0,
                    'status'                 => 'Belum',
                ]);
            }
        } catch (\Throwable $e) {
            // Silently continue if table error
        }

        // 2. Ambil juga dari LandBank jika ada nama yang belum tercover
        try {
            $dbLands = LandBank::all();
            foreach ($dbLands as $dbl) {
                if (!$projects->contains('nama', $dbl->name)) {
                    $projects->push([
                        'id'                     => $dbl->id + 100,
                        'pra_id'                 => null,
                        'land_bank_id'           => $dbl->id,
                        'is_finalized_to_pasca'  => true,
                        'nama'                   => $dbl->name,
                        'pt'                     => 'PT Graha Cipta Sejahtera',
                        'lokasi'                 => $dbl->city ?? ($dbl->address ?: 'Kaliwates, Jember'),
                        'luas'                   => number_format($dbl->area ?? 0, 0, ',', '.') . ' m²',
                        'ownership_status'       => $dbl->ownership_status ?: 'SHGB Induk',
                        'payment_method'         => 'Cash / Termin',
                        'deal_price'             => null,
                        'target_selesai'         => '-',
                        'progress'               => 0,
                        'status'                 => 'Belum',
                    ]);
                }
            }
        } catch (\Throwable $e) {
            // Silently continue
        }

        return $projects;
    }

    /**
     * Sumber Data Perizinan Lapangan & Legalitas per Proyek.
     * Mengambil dari tabel Master Dokumen Perizinan dan disinkronkan dengan data aktual PerizinanTask.
     */
    private function getAllPermits($projects)
    {
        $permits = collect();

        // 1. Ambil data Master Dokumen Perizinan
        try {
            $masterDocs = MasterDokumenPerizinan::orderBy('urutan', 'asc')->get();
        } catch (\Throwable $e) {
            $masterDocs = collect();
        }

        // 2. Ambil data tugas perizinan aktual dari tim legal (PerizinanTask)
        try {
            $tasks = PerizinanTask::with('employee')->get();
        } catch (\Throwable $e) {
            $tasks = collect();
        }

        $globalId = 1;
        foreach ($projects as $proj) {
            // Ambil semua task yang terkait proyek ini (berdasarkan id atau nama kawasan)
            $projTasks = $tasks->filter(function ($t) use ($proj) {
                if (!empty($t->proyek_id) && $t->proyek_id == $proj['id']) {
                    return true;
                }
                if (!empty($t->proyek_nama) && strtolower(trim($t->proyek_nama)) === strtolower(trim($proj['nama']))) {
                    return true;
                }
                return false;
            });

            // Ambil custom_workflow_docs dari lahan proyek jika ada
            $projRecord = null;
            if (!empty($proj['pra_id'])) {
                $projRecord = PraLandbank::find($proj['pra_id']);
            } elseif (!empty($proj['land_bank_id'])) {
                $projRecord = LandBank::find($proj['land_bank_id']);
            }
            if (!$projRecord) {
                $projRecord = PraLandbank::find($proj['id']) ?? LandBank::find($proj['id']);
            }
            $projWorkflowDocs = $projRecord ? ($projRecord->custom_workflow_docs ?? []) : [];
            if (!is_array($projWorkflowDocs)) $projWorkflowDocs = [];

            $matchedTaskIds = [];

            if ($masterDocs->isNotEmpty()) {
                foreach ($masterDocs as $idx => $m) {
                    $poinLabel = str_replace('-', ' ', ucwords(strtolower($m->kode_dokumen ?? '')));
                    if (empty($poinLabel) || $poinLabel === 'Poin') {
                        $poinLabel = 'Poin ' . ($m->urutan ?? ($idx + 7));
                    }

                    // Pecah syarat dokumen
                    $syaratItems = [];
                    if (!empty($m->syarat_dokumen)) {
                        $rawLines = preg_split('/\r\n|\r|\n/', $m->syarat_dokumen);
                        foreach ($rawLines as $line) {
                            $cleaned = trim(ltrim(trim($line), '•-* '));
                            if (!empty($cleaned)) {
                                $syaratItems[] = $cleaned;
                            }
                        }
                    }
                    if (empty($syaratItems)) {
                        $syaratItems = ['Salinan Akta Pelepasan Hak dari Notaris', 'Berkas Kepemilikan Tanah Asli', 'Legalitas Perusahaan PT'];
                    }

                    // Cari apakah ada data di custom_workflow_docs
                    $matchedWf = null;
                    foreach ($projWorkflowDocs as $cwd) {
                        if (!empty($cwd['master_id']) && $cwd['master_id'] == $m->id) {
                            $matchedWf = $cwd;
                            break;
                        }
                        if (!empty($cwd['doc_name'])) {
                            $cwName = strtolower(trim($cwd['doc_name']));
                            $mName = strtolower(trim($m->nama_dokumen));
                            if ($cwName === $mName || str_contains($cwName, $mName) || str_contains($mName, $cwName)) {
                                $matchedWf = $cwd;
                                break;
                            }
                        }
                    }

                    $syaratFiles = [];
                    if ($matchedWf) {
                        if (!empty($matchedWf['syarat_items'])) $syaratItems = $matchedWf['syarat_items'];
                        if (!empty($matchedWf['syarat_files'])) $syaratFiles = (array) $matchedWf['syarat_files'];
                    }

                    // Cari apakah ada task penugasan yang cocok untuk izin ini
                    $matchedTask = $projTasks->first(function ($t) use ($m, $matchedTaskIds) {
                        if (in_array($t->id, $matchedTaskIds)) return false;
                        if (!empty($t->master_dokumen_id) && $t->master_dokumen_id == $m->id) {
                            return true;
                        }
                        $tName = strtolower(trim($t->nama_tugas ?? ''));
                        $mName = strtolower(trim($m->nama_dokumen ?? ''));
                        return $tName === $mName || str_contains($mName, $tName) || str_contains($tName, $mName);
                    });

                    // Default jika belum ada task pengerjaan
                    $status      = 'Belum';
                    $progress    = 0;
                    $noIzin      = null;
                    $tanggal     = '-';
                    $fileDokumen = null;
                    $catatan     = $m->deskripsi ?: 'Kajian dan proses administrasi penerbitan dokumen izin kawasan.';
                    $pelaksana   = null;
                    $taskId      = null;

                    if ($matchedWf) {
                        if (!empty($matchedWf['file_path'])) $fileDokumen = $matchedWf['file_path'];
                        if (!empty($matchedWf['doc_number'])) $noIzin = $matchedWf['doc_number'];
                        if (!empty($matchedWf['doc_date'])) $tanggal = $matchedWf['doc_date'];
                    }

                    if ($matchedTask) {
                        $matchedTaskIds[] = $matchedTask->id;
                        $taskId      = $matchedTask->id;
                        $progress    = (int) $matchedTask->progress;
                        $noIzin      = $matchedTask->nomor_dokumen ?: $noIzin;
                        $tanggal     = $matchedTask->tanggal_terbit ? date('d/m/Y', strtotime($matchedTask->tanggal_terbit)) : $tanggal;
                        $fileDokumen = $matchedTask->file_dokumen ?: $fileDokumen;
                        $catatan     = $matchedTask->kendala ?: ($matchedTask->catatan ?: $catatan);
                        $pelaksana   = $matchedTask->employee ? $matchedTask->employee->name : null;

                        if ($matchedTask->status === 'Selesai' || $progress >= 100) {
                            $status = 'Terbit';
                        } elseif ($matchedTask->status === 'Terkendala') {
                            $status = 'Revisi';
                        } elseif ($matchedTask->status === 'Dalam Proses' || $progress > 0) {
                            $status = 'Proses';
                        } else {
                            $status = 'Belum';
                        }
                    }

                    // Jika progress masih 0, hitung otomatis dari berkas prasyarat yang terunggah
                    if ($progress === 0 && !empty($syaratFiles)) {
                        $totS = count($syaratItems);
                        $upS = 0;
                        foreach ($syaratItems as $sI => $sN) {
                            if (!empty($syaratFiles[$sI]) || !empty($syaratFiles[$sN])) {
                                $upS++;
                            }
                        }
                        if ($totS > 0 && $upS > 0) {
                            $progress = (int) round(($upS / $totS) * 100);
                            if ($progress >= 100) {
                                $status = 'Terbit';
                            } elseif ($status === 'Belum') {
                                $status = 'Proses';
                            }
                        }
                    }

                    $permits->push([
                        'id'              => $globalId++,
                        'master_id'       => $m->id,
                        'task_id'         => $taskId,
                        'employee_id'     => ($matchedTask && $matchedTask->employee_id) ? $matchedTask->employee_id : null,
                        'proyek_id'       => $proj['id'],
                        'proyek_nama'     => $proj['nama'],
                        'poin_label'      => $poinLabel,
                        'nama_izin'       => $m->nama_dokumen,
                        'instansi'        => ($matchedTask && $matchedTask->instansi) ? $matchedTask->instansi : ($m->instansi_terkait ?: 'Kantor Pertanahan (ATR/BPN)'),
                        'target_selesai'  => ($matchedTask && $matchedTask->deadline) ? date('d/m/Y', strtotime($matchedTask->deadline)) : '-',
                        'no_izin'         => $noIzin,
                        'tanggal'         => $tanggal,
                        'status'          => $status,
                        'progress'        => $progress,
                        'catatan'         => $catatan,
                        'file_dokumen'    => $fileDokumen,
                        'pelaksana'       => $pelaksana,
                        'syarat_items'    => $syaratItems,
                        'syarat_files'    => $syaratFiles,
                        'estimasi_hari'   => $m->estimasi_hari,
                        'estimasi_biaya'  => $m->estimasi_biaya,
                    ]);
                }
            }

            // Tambahkan juga task perizinan custom proyek ini yang belum ada di master docs
            $customTasks = $projTasks->whereNotIn('id', $matchedTaskIds);
            foreach ($customTasks as $ct) {
                $status   = 'Belum';
                $progress = (int) $ct->progress;
                if ($ct->status === 'Selesai' || $progress >= 100) {
                    $status = 'Terbit';
                } elseif ($ct->status === 'Terkendala') {
                    $status = 'Revisi';
                } elseif ($ct->status === 'Dalam Proses' || $progress > 0) {
                    $status = 'Proses';
                }

                $permits->push([
                    'id'              => $globalId++,
                    'master_id'       => null,
                    'task_id'         => $ct->id,
                    'employee_id'     => $ct->employee_id,
                    'proyek_id'       => $proj['id'],
                    'proyek_nama'     => $proj['nama'],
                    'poin_label'      => 'Tugas Khusus',
                    'nama_izin'       => $ct->nama_tugas,
                    'instansi'        => $ct->instansi ?: 'Dinas Terkait',
                    'target_selesai'  => $ct->deadline ? date('d/m/Y', strtotime($ct->deadline)) : '-',
                    'no_izin'         => $ct->nomor_dokumen,
                    'tanggal'         => $ct->tanggal_terbit ? date('d/m/Y', strtotime($ct->tanggal_terbit)) : '-',
                    'status'          => $status,
                    'progress'        => $progress,
                    'catatan'         => $ct->kendala ?: ($ct->catatan ?: 'Tugas perizinan khusus staf legal.'),
                    'file_dokumen'    => $ct->file_dokumen,
                    'pelaksana'       => $ct->employee ? $ct->employee->name : null,
                    'syarat_items'    => ['Berkas Kelengkapan Permohonan'],
                    'estimasi_hari'   => 7,
                    'estimasi_biaya'  => 0,
                ]);
            }
        }

        return $permits;
    }
}
