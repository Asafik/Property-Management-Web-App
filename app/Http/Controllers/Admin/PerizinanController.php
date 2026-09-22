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
        $user = auth()->user();
        if ($user) {
            $pos = strtolower($user->position->name ?? '');
            $isStaffLegal = str_contains($pos, 'staff') && str_contains($pos, 'legal');
            $canManage = str_contains($pos, 'kepala') || str_contains($pos, 'admin') || str_contains($pos, 'owner') || str_contains($pos, 'direktur') || ($user->division_id == 4);
            if ($isStaffLegal && !$canManage && !$request->has('stay')) {
                return redirect()->route('perizinan.tugas.index');
            }
        }

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
        $projects = $this->getProjectsList();
        if ($projects->isEmpty()) {
            return redirect()->route('perizinan.index')->with('info', 'Belum ada data proyek kawasan tanah yang siap diproses perizinan.');
        }

        $allPermits = $this->getAllPermits($projects);

        // Cari data proyek
        $project = $projects->firstWhere('id', (int) $id) ?? $projects->first();

        // Ambil data perizinan milik proyek ini
        $permits = $allPermits->where('proyek_id', $project['id']);

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
        $projectAllPermits = $allPermits->where('proyek_id', $project['id']);
        $totalIzin   = $projectAllPermits->count();
        $totalTerbit = $projectAllPermits->where('status', 'Terbit')->count();
        $totalProses = $projectAllPermits->where('status', 'Proses')->count();
        $totalRevisi = $projectAllPermits->where('status', 'Revisi')->count();
        $projectProgress = $totalIzin > 0 ? round($projectAllPermits->avg('progress')) : 0;

        return view('perizinan.show', compact(
            'project',
            'permits',
            'filterStatus',
            'search',
            'totalIzin',
            'totalTerbit',
            'totalProses',
            'totalRevisi',
            'projectProgress'
        ));
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

                    if ($matchedTask) {
                        $matchedTaskIds[] = $matchedTask->id;
                        $taskId      = $matchedTask->id;
                        $progress    = (int) $matchedTask->progress;
                        $noIzin      = $matchedTask->nomor_dokumen;
                        $tanggal     = $matchedTask->tanggal_terbit ? date('d/m/Y', strtotime($matchedTask->tanggal_terbit)) : '-';
                        $fileDokumen = $matchedTask->file_dokumen;
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

                    $permits->push([
                        'id'              => $globalId++,
                        'master_id'       => $m->id,
                        'task_id'         => $taskId,
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
