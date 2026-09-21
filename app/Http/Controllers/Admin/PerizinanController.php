<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LandBank;
use App\Models\PraLandbank;
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

        // Map progress & status perizinan dari daftar izin
        $projects = $projects->map(function ($proj) use ($allPermits) {
            $pList = $allPermits->where('proyek_id', $proj['id']);
            $total = $pList->count();
            $terbit = $pList->whereIn('status', ['Selesai', 'Terbit'])->count();
            $proses = $pList->whereIn('status', ['Berjalan', 'Proses'])->count();
            $revisi = $pList->whereIn('status', ['Tertunda', 'Revisi', 'Belum'])->count();
            $progress = $total > 0 ? round(($terbit / $total) * 100) : 75;

            $proj['total'] = $total;
            $proj['terbit'] = $terbit;
            $proj['proses'] = $proses;
            $proj['revisi'] = $revisi;
            $proj['progress'] = $progress;
            $proj['status'] = $terbit == $total && $total > 0 ? 'Selesai' : ($revisi > 0 ? 'Tertunda' : 'Berjalan');
            return $proj;
        });

        // Filter Proyek
        $proyekId = $request->get('proyek_id');
        if (!empty($proyekId) && $proyekId !== 'all') {
            $projects = $projects->where('id', (int) $proyekId);
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
        $tertunda     = $allPermits->whereIn('status', ['Tertunda', 'Revisi', 'Belum'])->count();

        return view('perizinan.index', compact(
            'projects',
            'proyekId',
            'filterStatus',
            'totalIzin',
            'totalSelesai',
            'dalamProses',
            'tertunda'
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

        return view('perizinan.show', compact(
            'project',
            'permits',
            'filterStatus',
            'search',
            'totalIzin',
            'totalTerbit',
            'totalProses',
            'totalRevisi'
        ));
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
            $approvedPraLands = PraLandbank::where('status', 'approved')
                ->orWhereNotNull('deal_price')
                ->get();

            foreach ($approvedPraLands as $pra) {
                $lokasi = $pra->city ?? ($pra->district ?? ($pra->address ?: 'Jember'));
                $paymentMethod = $pra->payment_method ? ucwords($pra->payment_method) : 'Termin / Cash';
                
                $projects->push([
                    'id'               => $pra->id,
                    'pra_id'           => $pra->id,
                    'nama'             => $pra->land_name,
                    'pt'               => 'PT Graha Cipta Sejahtera',
                    'lokasi'           => $lokasi,
                    'luas'             => number_format($pra->area ?? 0, 0, ',', '.') . ' m²',
                    'ownership_status' => $pra->ownership_status ?: 'SHGB Induk',
                    'payment_method'   => $paymentMethod,
                    'deal_price'       => $pra->deal_price,
                    'target_selesai'   => '-',
                    'progress'         => 0,
                    'status'           => 'Belum',
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
                        'id'               => $dbl->id + 100,
                        'pra_id'           => null,
                        'nama'             => $dbl->name,
                        'pt'               => 'PT Graha Cipta Sejahtera',
                        'lokasi'           => $dbl->city ?? ($dbl->address ?: 'Kaliwates, Jember'),
                        'luas'             => number_format($dbl->area ?? 0, 0, ',', '.') . ' m²',
                        'ownership_status' => $dbl->ownership_status ?: 'SHGB Induk',
                        'payment_method'   => 'Cash / Termin',
                        'deal_price'       => null,
                        'target_selesai'   => '-',
                        'progress'         => 0,
                        'status'           => 'Belum',
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
     * Mengambil langsung dari tabel Master Dokumen Perizinan (MasterDokumenPerizinan).
     */
    private function getAllPermits($projects)
    {
        $permits = collect();

        // Ambil data dari Master Dokumen Perizinan di database
        try {
            $masterDocs = \App\Models\MasterDokumenPerizinan::orderBy('urutan', 'asc')->get();
        } catch (\Throwable $e) {
            $masterDocs = collect();
        }

        $globalId = 1;
        foreach ($projects as $proj) {
            if ($masterDocs->isNotEmpty()) {
                foreach ($masterDocs as $idx => $m) {
                    // Poin label (misal: POIN-07 -> Poin 7)
                    $poinLabel = str_replace('-', ' ', ucwords(strtolower($m->kode_dokumen ?? '')));
                    if (empty($poinLabel) || $poinLabel === 'Poin') {
                        $poinLabel = 'Poin ' . ($m->urutan ?? ($idx + 7));
                    }

                    // Pecah syarat_dokumen menjadi list
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

                    // Default status perizinan bersih & kosong (Belum Dimulai)
                    $status   = 'Belum';
                    $progress = 0;
                    $noIzin   = null;
                    $tanggal  = '-';

                    $permits->push([
                        'id'              => $globalId++,
                        'master_id'       => $m->id,
                        'proyek_id'       => $proj['id'],
                        'proyek_nama'     => $proj['nama'],
                        'poin_label'      => $poinLabel,
                        'nama_izin'       => $m->nama_dokumen,
                        'instansi'        => $m->instansi_terkait ?: 'Kantor Pertanahan (ATR/BPN)',
                        'target_selesai'  => '-',
                        'no_izin'         => null,
                        'tanggal'         => '-',
                        'status'          => 'Belum',
                        'progress'        => 0,
                        'catatan'         => $m->deskripsi ?: 'Kajian dan proses administrasi penerbitan dokumen izin kawasan.',
                        'file_dokumen'    => null,
                        'syarat_items'    => $syaratItems,
                        'estimasi_hari'   => $m->estimasi_hari,
                        'estimasi_biaya'  => $m->estimasi_biaya,
                    ]);
                }
            } else {
                // Fallback default jika master dokumen kosong
                $defaultList = [
                    ['poin_label' => 'Poin 7', 'nama_izin' => 'Blangko Permohonan Kelurahan & Kecamatan', 'instansi' => 'Pihak Kelurahan & Kantor Kecamatan'],
                    ['poin_label' => 'Poin 8', 'nama_izin' => 'Pertimbangan Teknis Pertanahan (PERTEK BPN)', 'instansi' => 'Kantor Pertanahan (ATR/BPN)'],
                    ['poin_label' => 'Poin 9', 'nama_izin' => 'Peta Bidang dan Pengukuran Tanah (NIB)', 'instansi' => 'Seksi Survei & Pemetaan ATR/BPN'],
                    ['poin_label' => 'Poin 10', 'nama_izin' => 'Kesesuaian Tata Ruang (PKKPR Darat)', 'instansi' => 'Dinas PUPR / PTSP & OSS-RBA'],
                    ['poin_label' => 'Poin 11', 'nama_izin' => 'Rekomendasi Peil Banjir Kawasan', 'instansi' => 'Dinas SDA / Pekerjaan Umum SDA'],
                    ['poin_label' => 'Poin 12', 'nama_izin' => 'Pertimbangan Teknis Andalalin (Lalu Lintas)', 'instansi' => 'Dinas Perhubungan (Dishub)'],
                    ['poin_label' => 'Poin 13', 'nama_izin' => 'Dokumen Lingkungan Hidup (SPPL / UKL-UPL)', 'instansi' => 'Dinas Lingkungan Hidup (DLH)'],
                    ['poin_label' => 'Poin 14', 'nama_izin' => 'Pengesahan Rencana Tapak (Siteplan Pemda)', 'instansi' => 'Dinas Perumahan Rakyat & CK'],
                    ['poin_label' => 'Poin 15', 'nama_izin' => 'SK Pemberian Hak Guna Bangunan (SK HGB BPN)', 'instansi' => 'Kanwil / Kantor Pertanahan ATR/BPN'],
                    ['poin_label' => 'Poin 16', 'nama_izin' => 'Validasi & Pembayaran Pajak BPHTB', 'instansi' => 'Badan Pendapatan Daerah (Bapenda)'],
                    ['poin_label' => 'Poin 17', 'nama_izin' => 'Penerbitan Buku SHGB Induk an. PT', 'instansi' => 'Kantor Pertanahan ATR/BPN'],
                    ['poin_label' => 'Poin 18', 'nama_izin' => 'PBG Induk Kawasan (SIMBG)', 'instansi' => 'DPMPTSP melalui Sistem SIMBG'],
                    ['poin_label' => 'Poin 19', 'nama_izin' => 'Pemecahan Sertifikat SHGB per Kavling/Unit', 'instansi' => 'Seksi Penetapan Hak ATR/BPN'],
                ];
                foreach ($defaultList as $idx => $def) {
                    $permits->push([
                        'id'              => $globalId++,
                        'master_id'       => $idx + 1,
                        'proyek_id'       => $proj['id'],
                        'proyek_nama'     => $proj['nama'],
                        'poin_label'      => $def['poin_label'],
                        'nama_izin'       => $def['nama_izin'],
                        'instansi'        => $def['instansi'],
                        'target_selesai'  => '-',
                        'no_izin'         => null,
                        'tanggal'         => '-',
                        'status'          => 'Belum',
                        'progress'        => 0,
                        'catatan'         => 'Pengurusan dokumen izin kawasan.',
                        'file_dokumen'    => null,
                        'syarat_items'    => ['Salinan Akta Pelepasan Notaris', 'Berkas Kepemilikan Asli'],
                        'estimasi_hari'   => 14,
                        'estimasi_biaya'  => 0,
                    ]);
                }
            }
        }

        return $permits;
    }
}
