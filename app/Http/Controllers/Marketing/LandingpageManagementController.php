<?php

namespace App\Http\Controllers\Marketing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LandBankUnit;
use App\Models\LandBank;
use Illuminate\Support\Str;

class LandingpageManagementController extends Controller
{
    /**
     * Halaman Daftar Unit Ready untuk Landing Page
     * Mengambil langsung dari database Katalog Unit (LandBankUnit) dengan 2 syarat:
     * 1. Status ketersediaan: 'ready' atau 'tersedia'
     * 2. Pembangunan: 'selesai' atau '100%'
     */
    public function index(Request $request)
    {
        $search = strtolower(trim($request->get('search', '')));
        $kategori = strtolower(trim($request->get('kategori', 'all')));
        $statusFilter = strtolower(trim($request->get('status', 'all')));

        // Query Dasar: Ambil unit katalog berstatus Tersedia/Ready dan Progres Selesai/100%
        $baseQuery = LandBankUnit::with('landBank')
            ->where(function ($q) {
                $q->whereIn('status', ['ready', 'tersedia', 'available', 'Ready', 'Tersedia', 'Available'])
                  ->orWhere('status', 'like', '%ready%')
                  ->orWhere('status', 'like', '%tersedia%')
                  ->orWhere('status', 'like', '%avail%');
            })
            ->where(function ($q) {
                $q->whereIn('construction_progress', ['selesai', '100', 'Selesai'])
                  ->orWhere('construction_progress', 'like', '%selesai%');
            });

        // 1. KPI Metrik Akumulatif
        $totalReady = (clone $baseQuery)->count();
        $totalWithPhoto = (clone $baseQuery)->whereNotNull('photo')->where('photo', '!=', '')->count();
        $totalNoPhoto = (clone $baseQuery)->where(function ($q) {
            $q->whereNull('photo')->orWhere('photo', '');
        })->count();
        $totalFeatured = 0; // Default untuk unit unggulan

        // 2. Terapkan Filter & Pencarian
        $query = clone $baseQuery;

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('unit_code', 'like', "%{$search}%")
                  ->orWhere('unit_name', 'like', "%{$search}%")
                  ->orWhere('type', 'like', "%{$search}%")
                  ->orWhere('block', 'like', "%{$search}%")
                  ->orWhere('unit_number', 'like', "%{$search}%")
                  ->orWhereHas('landBank', function ($lq) use ($search) {
                      $lq->where('name', 'like', "%{$search}%")
                         ->orWhere('address', 'like', "%{$search}%");
                  });
            });
        }

        if ($kategori !== 'all' && !empty($kategori)) {
            $query->where('jenis', 'like', "%{$kategori}%");
        }

        if ($statusFilter !== 'all' && !empty($statusFilter)) {
            if ($statusFilter === 'tayang') {
                $query->whereNotNull('photo')->where('photo', '!=', '');
            } elseif ($statusFilter === 'kosong') {
                $query->where(function ($q) {
                    $q->whereNull('photo')->orWhere('photo', '');
                });
            }
        }

        $filteredUnits = $query->orderBy('unit_code')->get();

        // Siapkan properti tambahan agar kompatibel penuh dengan view
        $filteredUnits->transform(function ($item) {
            $item->project_name = $item->landBank->name ?? 'Perumahan';
            $item->address = $item->landBank->address ?? '-';
            $item->is_featured = false;
            $item->is_published = !empty($item->photo);
            return $item;
        });

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
        $unit = LandBankUnit::with(['landBank', 'landingPage'])->find($id);

        if (!$unit) {
            return redirect()->route('marketing.landingpage.index')
                ->with('error', 'Unit tidak ditemukan dalam database.');
        }

        $lp = $unit->landingPage;

        // Ambil default dari Pasca & Pra jika belum tersimpan di landingPage
        $pascaLat = $unit->landBank?->lat;
        $pascaLng = $unit->landBank?->lng;

        $praLand = \App\Models\PraLandbank::where('land_bank_id', $unit->land_bank_id)
            ->orWhere('land_name', $unit->landBank?->name)
            ->first();
        $praLat = $praLand?->lat;
        $praLng = $praLand?->lng;

        $praWater = $praLand?->water_condition;
        $waterDefault = ($praWater === 'sumur_bor') ? 'Sumur Bor' : (($praWater === 'pdam') ? 'PDAM' : ($praWater ? ucwords(str_replace('_', ' ', $praWater)) : 'PDAM / Sumur Bor'));

        $activeLat = $lp?->lat ?: ($pascaLat ?: ($praLat ?: -8.175024));
        $activeLng = $lp?->lng ?: ($pascaLng ?: ($praLng ?: 113.708797));

        // Assign nilai ke $unit agar kompatibel 100% dengan view blade
        $unit->project_name = $unit->landBank->name ?? 'Perumahan';

        $lb = $unit->landBank;
        $addressParts = [];
        if ($lb) {
            if (!empty($lb->address)) $addressParts[] = $lb->address;
            if (!empty($lb->village)) $addressParts[] = 'Desa/Kel. ' . $lb->village;
            if (!empty($lb->district)) $addressParts[] = 'Kec. ' . $lb->district;
            if (!empty($lb->city)) $addressParts[] = $lb->city;
        }
        $defaultAddress = count($addressParts) > 0 ? implode(', ', $addressParts) : ($unit->address ?: 'Jawa Timur');
        $unit->address = !empty($lp?->address) ? $lp->address : $defaultAddress;
        $unit->gallery = $lp?->gallery ?? [];
        $unit->is_featured = (bool) ($lp?->is_featured ?? false);
        $unit->is_published = (bool) ($lp?->is_published ?? !empty($unit->photo));
        $unit->headline = $lp?->headline ?? ($unit->unit_name ? "Hunian Modern {$unit->unit_name} Siap Huni" : "Unit {$unit->unit_code} Siap Huni");
        $unit->promo_badge = $lp?->promo_badge ?? '';
        $unit->cicilan_estimasi = $lp?->cicilan_estimasi ?? (int)round(($unit->price ?: 200000000) * 0.007);
        $unit->dp_persen = $lp?->dp_persen ?? 1;
        $unit->tenor_estimasi = $lp?->tenor_estimasi ?? 20;
        $unit->bedrooms = $lp?->bedrooms ?? 2;
        $unit->bathrooms = $lp?->bathrooms ?? 1;
        $unit->carport = $lp?->carport ?? 1;
        $unit->floors = $lp?->floors ?? 1;

        $unit->electricity = $lp?->electricity ?? '1.300 Watt';
        $unit->water = $lp?->water ?? $waterDefault;
        $unit->certificate = $lp?->certificate ?? ($unit->certificate_no ?? ($unit->landBank->ownership_status ?? 'SHM / PBG Lengkap'));
        $unit->year_built = $lp?->year_built ?? ($unit->created_at ? $unit->created_at->format('Y') : date('Y'));
        $unit->condition = $lp?->condition ?? 'Baru & Siap Huni (100%)';
        $unit->sales_name = $lp?->sales_name ?: 'Customer Service / Lobby Kantor';
        $unit->sales_phone = $lp?->sales_phone ?: '0811999988888';

        $unit->lat = $activeLat;
        $unit->lng = $activeLng;
        $unit->pasca_lat = $pascaLat;
        $unit->pasca_lng = $pascaLng;
        $unit->pra_lat = $praLat;
        $unit->pra_lng = $praLng;
        $unit->map_link = $lp?->map_link ?: "https://www.google.com/maps?q={$activeLat},{$activeLng}";

        $unit->description = $lp?->description ?: ($unit->description ?: "Unit siap huni berlokasi strategis di " . ($unit->landBank->name ?? 'perumahan kami') . ". Pembangunan telah rampung 100% dan siap serah terima kunci.");
        $unit->features = $lp?->features ?? ['One Gate System', 'Keamanan 24 Jam', 'Jalan Paving', 'Bebas Banjir', 'Listrik & Air Siap Pakai'];
        $unit->bank_partners = $lp?->bank_partners ?: 'Bank BTN, Bank Syariah Indonesia (BSI), Bank Mandiri';

        return view('marketing.landingpage.edit', compact('unit', 'lp'));
    }

    /**
     * Simpan Perubahan Data Landing Page ke Tabel Terpisah: UnitLandingPage
     */
    public function update(Request $request, $id)
    {
        $unit = LandBankUnit::findOrFail($id);

        // 1. Update data pokok unit (Foto utama, Harga, Deskripsi) jika ada perubahan
        if ($request->has('remove_main_photo') && $request->remove_main_photo == '1') {
            $unit->photo = null;
        } elseif ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('units', 'public');
            $unit->photo = $path;
        }

        if ($request->filled('price')) {
            $unit->price = preg_replace('/[^\d]/', '', $request->price);
        }

        if ($request->filled('description')) {
            $unit->description = $request->description;
        }

        $unit->save();

        // 2. Simpan ke tabel mandiri terpisah: UnitLandingPage
        $lpData = [
            'headline' => $request->headline,
            'promo_badge' => $request->promo_badge,
            'description' => $request->description,
            'address' => $request->address,
            'bedrooms' => $request->filled('bedrooms') ? (int)$request->bedrooms : 2,
            'bathrooms' => $request->filled('bathrooms') ? (int)$request->bathrooms : 1,
            'carport' => $request->filled('carport') ? (int)$request->carport : 1,
            'floors' => $request->filled('floors') ? (int)$request->floors : 1,
            'electricity' => $request->electricity ?? '1.300 Watt',
            'water' => $request->water,
            'certificate' => $request->certificate,
            'year_built' => $request->year_built,
            'condition' => $request->condition ?? 'Baru & Siap Huni (100%)',
            'sales_name' => $request->sales_name,
            'sales_phone' => $request->sales_phone,
            'lat' => $request->filled('lat') ? (float)$request->lat : null,
            'lng' => $request->filled('lng') ? (float)$request->lng : null,
            'map_link' => $request->map_link,
            'is_published' => $request->has('is_published'),
            'is_featured' => $request->has('is_featured'),
            'cicilan_estimasi' => $request->filled('cicilan_estimasi') ? (int) preg_replace('/[^\d]/', '', $request->cicilan_estimasi) : null,
            'dp_persen' => $request->filled('dp_persen') ? (float)$request->dp_persen : 1,
            'tenor_estimasi' => $request->filled('tenor_estimasi') ? (int)$request->tenor_estimasi : 20,
            'bank_partners' => $request->bank_partners,
        ];

        // Fitur array
        if ($request->has('features')) {
            if (is_array($request->features)) {
                $lpData['features'] = $request->features;
            } else {
                $rawFeat = explode(',', $request->features);
                $lpData['features'] = array_values(array_filter(array_map('trim', $rawFeat)));
            }
        }

        // Upload galeri foto tambahan (Maksimal 3 foto galeri -> Total dengan foto depan = maksimal 4 foto)
        $currentLp = \App\Models\UnitLandingPage::where('land_bank_unit_id', $unit->id)->first();
        $gallery = [];

        // 1. Simpan foto galeri lama yang dipertahankan pengguna
        if ($request->has('existing_gallery') && is_array($request->existing_gallery)) {
            foreach ($request->existing_gallery as $exPath) {
                if (!empty($exPath)) {
                    $gallery[] = $exPath;
                }
            }
        } elseif (!$request->has('gallery_files') && !$request->has('gallery') && $currentLp && is_array($currentLp->gallery)) {
            // Fallback jika form tidak mengirim input galeri sama sekali
            $gallery = $currentLp->gallery;
        }

        // 2. Upload foto baru dari slot galeri interaktif
        if ($request->hasFile('gallery_files')) {
            foreach ($request->file('gallery_files') as $gFile) {
                if ($gFile) {
                    $gPath = $gFile->store('units/gallery', 'public');
                    $gallery[] = $gPath;
                }
            }
        }

        // Fallback jika masih ada upload file multiple biasa
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $gFile) {
                if ($gFile) {
                    $gPath = $gFile->store('units/gallery', 'public');
                    $gallery[] = $gPath;
                }
            }
        }

        // Batasi maksimal 3 foto galeri pendukung (sehingga total tepat maksimal 4 foto)
        $gallery = array_slice(array_values(array_filter($gallery)), 0, 3);
        $lpData['gallery'] = $gallery;

        // Simpan / update ke tabel terpisah unit_landing_pages
        \App\Models\UnitLandingPage::updateOrCreate(
            ['land_bank_unit_id' => $unit->id],
            $lpData
        );

        return redirect()->route('marketing.landingpage.index')
            ->with('success', 'Data publikasi Halaman Utama untuk unit ' . $unit->unit_code . ' berhasil disimpan di tabel terpisah!');
    }
}
