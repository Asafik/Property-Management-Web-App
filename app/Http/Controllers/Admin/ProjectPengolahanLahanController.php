<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LandBank;
use Illuminate\Http\Request;

class ProjectPengolahanLahanController extends Controller
{
    /**
     * Halaman Utama: Monitoring Pengolahan Lahan Proyek (Daftar Proyek Kawasan).
     */
    public function index(Request $request)
    {
        $projects = $this->getProjectsList();

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

        // KPI Metrics
        $totalProyek = $projects->count();
        $totalSelesai = $projects->where('status', 'Selesai')->count();
        $dalamProses = $projects->where('status', 'Berjalan')->count();
        $tertunda = $projects->where('status', 'Tertunda')->count();

        return view('pengolahan_lahan.index', compact(
            'projects',
            'proyekId',
            'filterStatus',
            'totalProyek',
            'totalSelesai',
            'dalamProses',
            'tertunda'
        ));
    }

    /**
     * Koleksi Data Proyek Kawasan untuk Monitoring Pengolahan Lahan.
     */
    private function getProjectsList()
    {
        // Ambil data dari LandBank jika ada
        $land1 = LandBank::find(1);

        $progress1 = 65;
        if ($land1) {
            $calc = $land1->overall_infrastructure_progress;
            if ($calc > 0) {
                $progress1 = (int) $calc;
            }
        }

        return collect([
            [
                'id' => 1,
                'nama' => 'Perumahan Jember Indah',
                'pt' => 'PT Graha Cipta Sejahtera',
                'lokasi' => 'Kaliwates, Jember',
                'luas' => '24.500 m²',
                'ownership_status' => 'SHGB Induk',
                'target_selesai' => '30 Jul 2026',
                'status' => 'Berjalan',
                'progress' => $progress1,
                'fase_aktif' => 'Fase 2: Drainase & Jalan Kawasan',
                'anggaran_total' => 'Rp 850.000.000',
                'realisasi_biaya' => 'Rp 552.500.000',
            ],
            [
                'id' => 2,
                'nama' => 'Graha Harmoni Kaliwates',
                'pt' => 'PT Graha Cipta Sejahtera',
                'lokasi' => 'Kaliwates, Jember',
                'luas' => '18.200 m²',
                'ownership_status' => 'SHGB Induk',
                'target_selesai' => '15 Des 2026',
                'status' => 'Berjalan',
                'progress' => 35,
                'fase_aktif' => 'Fase 1: Cut & Fill & Perataan',
                'anggaran_total' => 'Rp 620.000.000',
                'realisasi_biaya' => 'Rp 217.000.000',
            ],
        ]);
    }
}
