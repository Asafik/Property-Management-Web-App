<?php

namespace App\Http\Controllers\Marketing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LandingpageManagementController extends Controller
{
    /**
     * Data Contoh Unit Ready untuk Pengelolaan Landing Page
     */
    private function getSampleUnits()
    {
        return collect([
            1 => (object)[
                'id' => 1,
                'unit_code' => 'A.01',
                'unit_name' => 'Kavling Sakura Hook',
                'project_name' => 'Perumahan Grand Cipta Jember',
                'address' => 'Jl. Kaliwates No. 88, Kaliwates, Jember',
                'type' => '36/72',
                'building_area' => 36,
                'area' => 72,
                'jenis' => 'Subsidi',
                'price' => 185000000,
                'status' => 'ready',
                'promo_badge' => 'DP 0% & Free Biaya Notaris',
                'photo' => 'https://images.pexels.com/photos/164522/pexels-photo-164522.jpeg?auto=compress&cs=tinysrgb&w=800&h=600&fit=crop',
                'gallery' => [
                    'https://images.pexels.com/photos/164522/pexels-photo-164522.jpeg?auto=compress&cs=tinysrgb&w=800&h=600&fit=crop',
                    'https://images.pexels.com/photos/280221/pexels-photo-280221.jpeg?auto=compress&cs=tinysrgb&w=800&h=600&fit=crop',
                    'https://images.pexels.com/photos/259588/pexels-photo-259588.jpeg?auto=compress&cs=tinysrgb&w=800&h=600&fit=crop',
                    'https://images.pexels.com/photos/280229/pexels-photo-280229.jpeg?auto=compress&cs=tinysrgb&w=800&h=600&fit=crop',
                ],
                'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'is_featured' => true,
                'is_published' => true,
                'headline' => 'Rumah Subsidi Hook Cantik Siap Huni di Lokasi Strategis',
                'bedrooms' => 2,
                'bathrooms' => 1,
                'carport' => 1,
                'floors' => 1,
                'electricity' => '1.300 Watt',
                'water' => 'PDAM',
                'certificate' => 'SHM / PBG Lengkap',
                'facing' => 'Timur',
                'year_built' => '2024',
                'condition' => 'Baru & Siap Huni',
                'cicilan_estimasi' => 1100000,
                'dp_persen' => 1,
                'tenor_estimasi' => 20,
                'sales_name' => 'Rizky Pratama (Tim Marketing A)',
                'sales_phone' => '081234567890',
                'map_link' => 'https://maps.google.com/?q=-8.1724,113.7007',
                'description' => 'Rumah subsidi modern hook siap huni di lokasi strategis Kaliwates. Lingkungan asri, one gate system, dan bebas banjir. Hanya 7 menit ke pusat kota dan kampus UNEJ.',
                'features' => ['One Gate System', 'Keamanan 24 Jam', 'Jalan Paving 6 Meter', 'Taman Terbuka Hijau', 'Masjid Komplek', 'Bebas Banjir', 'Dekat Sarana Pendidikan'],
                'bank_partners' => 'Bank BTN, Bank Syariah Indonesia (BSI), Bank Mandiri',
            ],
            2 => (object)[
                'id' => 2,
                'unit_code' => 'B.01',
                'unit_name' => 'Kavling Lavender Eksklusif',
                'project_name' => 'Perumahan Harmoni Indah',
                'address' => 'Jl. Tegal Besar Indah Blok C, Tegal Besar, Jember',
                'type' => '45/84',
                'building_area' => 45,
                'area' => 84,
                'jenis' => 'Komersil',
                'price' => 325000000,
                'status' => 'ready',
                'promo_badge' => 'Cashback 15 Juta & Free Canopy',
                'photo' => 'https://images.pexels.com/photos/258154/pexels-photo-258154.jpeg?auto=compress&cs=tinysrgb&w=800&h=600&fit=crop',
                'gallery' => [
                    'https://images.pexels.com/photos/258154/pexels-photo-258154.jpeg?auto=compress&cs=tinysrgb&w=800&h=600&fit=crop',
                    'https://images.pexels.com/photos/276724/pexels-photo-276724.jpeg?auto=compress&cs=tinysrgb&w=800&h=600&fit=crop',
                ],
                'video_url' => '',
                'is_featured' => true,
                'is_published' => true,
                'headline' => 'Hunian Scandinavian Modern Tipe 45 Nyaman & Sejuk',
                'bedrooms' => 3,
                'bathrooms' => 2,
                'carport' => 1,
                'floors' => 1,
                'electricity' => '2.200 Watt',
                'water' => 'PDAM & Sumur Bor',
                'certificate' => 'SHM Murni',
                'facing' => 'Utara',
                'year_built' => '2024',
                'condition' => 'Baru & Siap Huni',
                'cicilan_estimasi' => 2100000,
                'dp_persen' => 5,
                'tenor_estimasi' => 20,
                'sales_name' => 'Siti Nurhaliza (Senior Property Advisor)',
                'sales_phone' => '082198765432',
                'map_link' => 'https://maps.google.com/?q=-8.1824,113.6907',
                'description' => 'Hunian komersil berkonsep Scandinavian minimalis di Tegal Besar. Material bangunan premium, plafond tinggi 4 meter, sirkulasi udara sejuk, dan pencahayaan alami melimpah.',
                'features' => ['One Gate System', 'CCTV 24 Jam', 'Row Jalan 8 Meter', 'Clubhouse & Kolam Renang', 'Masjid Komplek', 'Playground Anak'],
                'bank_partners' => 'Bank BTN, BSI, Bank Mandiri, Bank BCA, Bank BRI',
            ],
            3 => (object)[
                'id' => 3,
                'unit_code' => 'C.05',
                'unit_name' => 'Kavling Orchid Premium',
                'project_name' => 'Perumahan Grand Cipta Jember',
                'address' => 'Jl. Patrang Makmur No. 12, Patrang, Jember',
                'type' => '54/105',
                'building_area' => 54,
                'area' => 105,
                'jenis' => 'Komersil',
                'price' => 460000000,
                'status' => 'ready',
                'promo_badge' => 'Subsidi Bunga KPR 2% 1 Tahun',
                'photo' => null,
                'gallery' => [],
                'video_url' => '',
                'is_featured' => false,
                'is_published' => false,
                'headline' => 'Rumah Mewah Tipe 54 Halaman Luas Carport 2 Mobil',
                'bedrooms' => 3,
                'bathrooms' => 2,
                'carport' => 2,
                'floors' => 1,
                'electricity' => '2.200 Watt',
                'water' => 'PDAM',
                'certificate' => 'SHM',
                'facing' => 'Selatan',
                'year_built' => '2024',
                'condition' => 'Baru & Siap Huni',
                'cicilan_estimasi' => 2900000,
                'dp_persen' => 10,
                'tenor_estimasi' => 20,
                'sales_name' => 'Rizky Pratama',
                'sales_phone' => '081234567890',
                'map_link' => '',
                'description' => 'Unit premium tipe 54 dengan sisa tanah belakang luas. Desain modern tropis dengan carport muat 2 mobil.',
                'features' => ['Sisa Tanah Belakang Luas', 'Smart Door Lock', 'CCTV Lingkungan', 'Dekat RSUD Patrang', 'Bebas Banjir'],
                'bank_partners' => 'Bank BTN, Bank BSI, Bank Mandiri',
            ],
        ]);
    }

    /**
     * Halaman Daftar Unit Ready untuk Landing Page
     */
    public function index(Request $request)
    {
        $units = $this->getSampleUnits();

        $search = strtolower($request->get('search', ''));
        $kategori = strtolower($request->get('kategori', 'all'));
        $status = strtolower($request->get('status', 'all'));

        $filteredUnits = $units->filter(function ($item) use ($search, $kategori, $status) {
            if (!empty($search)) {
                $matchedSearch = str_contains(strtolower($item->unit_code), $search) ||
                                 str_contains(strtolower($item->unit_name), $search) ||
                                 str_contains(strtolower($item->project_name), $search) ||
                                 str_contains(strtolower($item->type), $search);
                if (!$matchedSearch) return false;
            }

            if ($kategori !== 'all' && !empty($kategori)) {
                if (strtolower($item->jenis) !== $kategori) return false;
            }

            if ($status !== 'all' && !empty($status)) {
                if ($status === 'tayang' && empty($item->photo)) return false;
                if ($status === 'kosong' && !empty($item->photo)) return false;
            }

            return true;
        });

        $totalReady = $units->count();
        $totalWithPhoto = $units->filter(fn($u) => !empty($u->photo))->count();
        $totalNoPhoto = $units->filter(fn($u) => empty($u->photo))->count();
        $totalFeatured = $units->filter(fn($u) => $u->is_featured)->count();

        return view('marketing.landingpage.index', compact(
            'filteredUnits',
            'totalReady',
            'totalWithPhoto',
            'totalNoPhoto',
            'totalFeatured'
        ));
    }

    /**
     * Halaman Khusus Mandiri: Edit Data & Tampilan Landing Page Unit (Tanpa Modal)
     */
    public function edit($id)
    {
        $units = $this->getSampleUnits();
        $unit = $units->get($id) ?? $units->first();

        return view('marketing.landingpage.edit', compact('unit'));
    }

    /**
     * Simpan Perubahan Data Landing Page
     */
    public function update(Request $request, $id)
    {
        return redirect()->route('marketing.landingpage.index')
            ->with('success', 'Data publikasi Halaman Utama untuk unit berhasil diperbarui!');
    }
}
