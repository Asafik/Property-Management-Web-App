<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LandBank;
use App\Models\LandBankUnit;
use App\Models\DevelopmentProgress;
use App\Models\DevelopmentProgressItem;
use App\Models\MasterProgressCategory;
use App\Models\MasterProgressItem;
use App\Models\PembayaranTermin;
use App\Models\OpnameMingguan;
use App\Models\UnitLandingPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DevelopmentProgressController extends Controller
{
    // public function index($land_bank_id, Request $request)
    // {
    //     $land = LandBank::with('units')->findOrFail($land_bank_id);

    //     $unitId = $request->unit_id ?? $land->units->first()->id;

    //     $selectedUnit = $land->units()
    //         ->with('progress.items')
    //         ->findOrFail($unitId);

    //     // Ambil semua item dari progress unit
    //     $items = $selectedUnit->progress ? $selectedUnit->progress->items : collect();

    //     return view('properti.proses_pembangunan', compact('land', 'selectedUnit', 'items'));
    // }
    public function index($land_bank_id, Request $request)
    {
        $land = LandBank::with('units')->findOrFail($land_bank_id);

        // Ambil unit yang dipilih, atau default unit pertama
        $unitId = $request->unit_id ?? $land->units->first()->id;

        $selectedUnit = $land->units()
            ->with('progress.items') // ambil progress beserta items
            ->findOrFail($unitId);

        // Jika belum ada progress, buat otomatis
        if (!$selectedUnit->progress) {
            $selectedUnit->progress()->create([
                'title' => 'Progress Pembangunan',
            ]);

            // reload relasi supaya $selectedUnit->progress sudah ada
            $selectedUnit->load('progress.items');
        }

        // Ambil semua item dari progress unit
        $items = $selectedUnit->progress->items;

        // Ambil master kategori yang aktif
        $masterCategories = MasterProgressCategory::with('items')
            ->where('is_active', true)
            ->orderBy('urutan', 'asc')
            ->get();

        $opnameMingguan = $selectedUnit->progress
            ? OpnameMingguan::where('development_progress_id', $selectedUnit->progress->id)
                ->orderBy('minggu_ke', 'asc')
                ->get()
            : collect();

        $pembayaranTermin = $selectedUnit->progress
            ? PembayaranTermin::where('development_progress_id', $selectedUnit->progress->id)
                ->orderBy('termin_ke', 'asc')
                ->get()
            : collect();

        $user = auth()->user();
        $posName = strtolower($user->position->name ?? '');
        $canEditDeadline = str_contains($posName, 'admin')
            || str_contains($posName, 'owner')
            || str_contains($posName, 'direktur')
            || (str_contains($posName, 'kepala') && str_contains($posName, 'proyek'))
            || in_array($user->position_id ?? 0, [5, 8]);

        return view('properti.proses_pembangunan', compact('land', 'selectedUnit', 'items', 'masterCategories', 'opnameMingguan', 'pembayaranTermin', 'canEditDeadline'));
    }

    public function store(Request $request)
    {
        Log::info($request->all());

        $user = auth()->user();
        $posName = strtolower($user->position->name ?? '');
        $canEditDeadline = str_contains($posName, 'admin')
            || str_contains($posName, 'owner')
            || str_contains($posName, 'direktur')
            || (str_contains($posName, 'kepala') && str_contains($posName, 'proyek'))
            || in_array($user->position_id ?? 0, [5, 8]);

        // Sanitize items input for rupiah dots and decimal commas
        if ($request->has('items')) {
            $items = $request->input('items');
            foreach ($items as $k => $v) {
                if (isset($v['harga_satuan'])) {
                    // Selalu buang titik dan pemisah ribuan rupiah (contoh: "90.000" -> 90000, "90.000.000" -> 90000000)
                    $cleanPrice = preg_replace('/[^0-9]/', '', (string)$v['harga_satuan']);
                    $items[$k]['harga_satuan'] = (float)($cleanPrice ?: 0);
                }
                if (isset($v['volume'])) {
                    $cleanVol = str_replace(',', '.', (string)$v['volume']);
                    $items[$k]['volume'] = (float)($cleanVol ?: 0);
                }
            }
            $request->merge(['items' => $items]);
        }

        $request->validate([
            'land_bank_unit_id'   => 'required|exists:land_bank_units,id',
            'items'               => 'nullable|array',
            'items.*.id'          => 'nullable|exists:development_progress_items,id',
            'items.*.kategori'    => 'nullable|string',
            'items.*.kode'        => 'nullable|string',
            'items.*.uraian'      => 'nullable|string',
            'items.*.volume'      => 'nullable|numeric',
            'items.*.satuan'      => 'nullable|string',
            'items.*.harga_satuan'=> 'nullable|numeric',
            'items.*.keterangan'  => 'nullable|string',
            'items.*.progress_persen' => 'nullable|numeric|min:0|max:100',
            'items.*.dokumentasi' => 'nullable|file|mimes:jpg,jpeg,png,webp,pdf,doc,docx,heic,heif,bmp|max:10240',
            'deadline'            => 'nullable|array',
            'deadline.*'          => 'nullable|date',
        ], [
            'items.*.dokumentasi.mimes' => 'Format file dokumentasi tidak didukung. Harap gunakan file berformat: JPG, JPEG, PNG, WEBP, atau PDF.',
            'items.*.dokumentasi.max'   => 'Ukuran file dokumentasi terlalu besar. Maksimal ukuran file adalah 10 MB.',
            'items.*.dokumentasi.file'  => 'File dokumentasi harus berupa file yang valid.',
        ]);

        $unit = LandBankUnit::findOrFail($request->land_bank_unit_id);
        if (in_array(strtolower($unit->status ?? ''), ['sold', 'soldout']) || strtolower($unit->construction_progress ?? '') === 'selesai') {
            return redirect()->back()->with('error', 'Unit telah selesai / sold out. Rincian progress pembangunan telah dikunci dan tidak dapat diubah.');
        }

        DB::beginTransaction();

        try {

            $progress = DevelopmentProgress::firstOrCreate(
                ['land_bank_unit_id' => $request->land_bank_unit_id],
                ['title' => $request->title ?? 'Progress Baru']
            );

            foreach ($request->items ?? [] as $index => $item) {

                $itemId = $item['id'] ?? null;

                $deadlineItem = $item['deadline']
                    ?? ($itemId ? ($request->deadline[$itemId] ?? null) : null);

                $progressPersen = isset($item['progress_persen']) ? max(0, min(100, (int)$item['progress_persen'])) : 0;

                // UPDATE deadline, progress_persen & dokumentasi item lama
                if ($itemId && empty($item['kategori'])) {

                    $updateFields = [];
                    if ($canEditDeadline) {
                        $updateFields['deadline'] = $deadlineItem;
                    }
                    if (isset($item['progress_persen'])) {
                        $updateFields['progress_persen'] = $progressPersen;
                    }

                    if (!empty($updateFields)) {
                        DevelopmentProgressItem::where('id', $itemId)->update($updateFields);
                    }

                    // Upload dokumentasi untuk item lama jika ada file yang diunggah
                    if ($request->hasFile("items.$index.dokumentasi") || $request->hasFile("items.$itemId.dokumentasi")) {
                        $file = $request->file("items.$index.dokumentasi") ?? $request->file("items.$itemId.dokumentasi");
                        $fileName = 'doc_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                        $relDir = 'uploads/progress_dokumentasi';

                        $dir1 = public_path($relDir);
                        $dir2 = base_path($relDir);
                        $dir3 = base_path('public/' . $relDir);

                        foreach ([$dir1, $dir2, $dir3] as $d) {
                            if (!file_exists($d)) @mkdir($d, 0755, true);
                        }

                        $file->move($dir1, $fileName);
                        if ($dir2 !== $dir1 && file_exists($dir2) && file_exists($dir1 . '/' . $fileName)) {
                            @copy($dir1 . '/' . $fileName, $dir2 . '/' . $fileName);
                        }

                        $filePath = "{$relDir}/{$fileName}";

                        $existingProgressItem = DevelopmentProgressItem::find($itemId);
                        if ($existingProgressItem) {
                            $existingProgressItem->documents()->create([
                                'file_path' => $filePath
                            ]);
                        }
                    }

                    continue;
                }

                // CREATE item baru
                $progressItem = $progress->items()->create([
                    'kategori'        => $item['kategori'],
                    'kode'            => $item['kode'],
                    'uraian'          => $item['uraian'],
                    'volume'          => $item['volume'],
                    'satuan'          => $item['satuan'],
                    'harga_satuan'    => $item['harga_satuan'],
                    'total'           => $item['volume'] * $item['harga_satuan'],
                    'keterangan'      => $item['keterangan'] ?? null,
                    'progress_persen' => $progressPersen,
                    'deadline'        => $canEditDeadline ? $deadlineItem : null,
                ]);

                // Upload dokumentasi (Direct Public Uploads Mirror)
                if ($request->hasFile("items.$index.dokumentasi")) {
                    $file = $request->file("items.$index.dokumentasi");
                    $fileName = 'doc_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                    $relDir = 'uploads/progress_dokumentasi';

                    $dir1 = public_path($relDir);
                    $dir2 = base_path($relDir);
                    $dir3 = base_path('public/' . $relDir);

                    foreach ([$dir1, $dir2, $dir3] as $d) {
                        if (!file_exists($d)) @mkdir($d, 0755, true);
                    }

                    $file->move($dir1, $fileName);
                    if ($dir2 !== $dir1 && file_exists($dir2) && file_exists($dir1 . '/' . $fileName)) {
                        @copy($dir1 . '/' . $fileName, $dir2 . '/' . $fileName);
                    }

                    $filePath = "{$relDir}/{$fileName}";

                    $progressItem->documents()->create([
                        'file_path' => $filePath
                    ]);
                }
            }

            /* ==============================
               UPDATE PROGRESS PEMBANGUNAN UNIT BERDASARKAN KATEGORI TERTINGGI
            ============================== */
            $categories = $progress->items()
                ->pluck('kategori')
                ->map(fn($c) => strtolower(trim($c)))
                ->filter()
                ->unique()
                ->toArray();

            $status = 'belum_mulai';

            if (!empty($categories)) {
                // Evaluasi fase tertinggi pekerjaan yang telah diinput
                if (in_array('lainnya', $categories) || in_array('finishing', $categories)) {
                    $status = 'finishing';
                } elseif (in_array('atap', $categories)) {
                    $status = 'atap';
                } elseif (in_array('dinding', $categories) || in_array('struktur', $categories)) {
                    $status = 'dinding';
                } elseif (in_array('pondasi', $categories) || in_array('persiapan', $categories)) {
                    $status = 'pondasi';
                } else {
                    $status = 'pondasi';
                }
            }

            // Jika status progress RAP sudah di-ACC/completed, status tetap 'selesai'
            if ($progress->status === 'completed') {
                $status = 'selesai';
            }

            if ($request->has('checklist_kondisi')) {
                $progress->checklist_kondisi = $request->input('checklist_kondisi', []);
                $progress->save();
            }

            // Sync Spesifikasi Fisik & 4 Foto Unit ke Landing Page Marketing (Tabel unit_landing_pages)
            $unitLp = UnitLandingPage::firstOrCreate(
                ['land_bank_unit_id' => $unit->id],
                [
                    'headline' => $unit->unit_name ? "Hunian Modern {$unit->unit_name} Siap Huni" : "Unit {$unit->unit_code} Siap Huni",
                    'is_published' => true,
                ]
            );

            if ($request->filled('bedrooms')) {
                $unitLp->bedrooms = (int)$request->bedrooms;
            }
            if ($request->filled('bathrooms')) {
                $unitLp->bathrooms = (int)$request->bathrooms;
            }
            if ($request->filled('carport')) {
                $unitLp->carport = (int)$request->carport;
            }
            if ($request->filled('floors')) {
                $unitLp->floors = (int)$request->floors;
            }
            if ($request->filled('electricity')) {
                $unitLp->electricity = $request->electricity;
            }

            // Upload 4 Foto Fisik Unit:
            // Slot 1: Foto Depan / Fasad (disimpan ke land_bank_units.photo)
            if ($request->hasFile('photo_fasad')) {
                $path = $request->file('photo_fasad')->store('units', 'public');
                $unit->photo = $path;
                $unit->save();
            }

            // Slot 2, 3, 4: Galeri Pendukung (Ruang Tamu, Kamar Tidur, Dapur/Denah)
            $gallery = is_array($unitLp->gallery) ? $unitLp->gallery : [];
            while (count($gallery) < 3) {
                $gallery[] = null;
            }

            if ($request->hasFile('photo_ruang_tamu')) {
                $gallery[0] = $request->file('photo_ruang_tamu')->store('units/gallery', 'public');
            }
            if ($request->hasFile('photo_kamar_tidur')) {
                $gallery[1] = $request->file('photo_kamar_tidur')->store('units/gallery', 'public');
            }
            if ($request->hasFile('photo_dapur')) {
                $gallery[2] = $request->file('photo_dapur')->store('units/gallery', 'public');
            }

            $cleanGallery = array_values(array_filter($gallery));
            if (!empty($cleanGallery)) {
                $unitLp->gallery = $cleanGallery;
            }

            $unitLp->save();

            LandBankUnit::where('id', $request->land_bank_unit_id)
                ->update([
                    'construction_progress' => $status
                ]);

            DB::commit();

            return back()->with('success', 'RAP & Dokumentasi berhasil disimpan.');
        } catch (\Exception $e) {

            DB::rollBack();

            Log::error('Error store development progress', [
                'message' => $e->getMessage(),
            ]);

            return back()->with('error', 'Terjadi kesalahan, cek log.');
        }
    }
    public function accAjax($unitId)
    {
        try {
            // Ambil unit
            $unit = LandBankUnit::findOrFail($unitId);

            // Ambil progress terkait
            $progress = $unit->progress; // hasOne(DevelopmentProgress)

            // Cek apakah RAP unit ini sudah di-ACC sebelumnya
            if (($progress && $progress->status === 'completed') || $unit->construction_progress === 'selesai') {
                return response()->json([
                    'success' => false,
                    'message' => 'RAP untuk unit ini sudah di-ACC sebelumnya dan tidak dapat di-ACC ulang.',
                ], 400);
            }

            $totalAnggaran = 0;

            if ($progress) {
                // Hitung subtotal + PPN 10% (sesuai kalkulasi RAP di tampilan)
                $subtotal = $progress->items()->sum('total');
                $ppn = $subtotal * 0.1;
                $totalAnggaran = round($subtotal + $ppn);

                // Update kolom total_anggaran di tabel utama progress
                $progress->total_anggaran = $totalAnggaran;
                $progress->status = 'completed';
                $progress->save();
            }

            // Harga jual unit tetap UTUH (tidak dijumlahkan dengan anggaran RPP/RAP).
            // Anggaran RPP/RAP dicatat terpisah pada modul development_progresses / HPP.

            // Update progress unit
            $unit->construction_progress = 'selesai';
            $unit->status = 'ready';
            $unit->save();

            return response()->json([
                'success' => true,
                'message' => 'RAP berhasil di-ACC. Biaya RPP dicatat terpisah dan harga jual unit tetap utuh.',
                'construction_progress' => $unit->construction_progress,
                'total_anggaran' => $totalAnggaran,
                'price_unit' => $unit->price,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal: ' . $e->getMessage(),
            ]);
        }
    }


    public function uploadDocumentation(Request $request, $itemId)
    {
        $request->validate([
            'dokumentasi' => 'required|file|mimes:jpg,jpeg,png,webp,pdf,doc,docx,heic,heif,bmp|max:10240'
        ], [
            'dokumentasi.required' => 'Silakan pilih file dokumentasi terlebih dahulu.',
            'dokumentasi.mimes'    => 'Format file dokumentasi tidak didukung. Harap gunakan file berformat: JPG, JPEG, PNG, WEBP, atau PDF.',
            'dokumentasi.max'      => 'Ukuran file dokumentasi terlalu besar. Maksimal ukuran file adalah 10 MB.',
        ]);

        $item = DevelopmentProgressItem::findOrFail($itemId);

        if ($request->file('dokumentasi')) {
            $file = $request->file('dokumentasi');
            $fileName = 'doc_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $relDir = 'uploads/progress_dokumentasi';

            $dir1 = public_path($relDir);
            $dir2 = base_path($relDir);
            $dir3 = base_path('public/' . $relDir);

            foreach ([$dir1, $dir2, $dir3] as $d) {
                if (!file_exists($d)) @mkdir($d, 0755, true);
            }

            $file->move($dir1, $fileName);
            if ($dir2 !== $dir1 && file_exists($dir2) && file_exists($dir1 . '/' . $fileName)) {
                @copy($dir1 . '/' . $fileName, $dir2 . '/' . $fileName);
            }

            $path = "{$relDir}/{$fileName}";
            $item->dokumentasi = $path;
            $item->save();
        }

        return back()->with('success', 'File dokumentasi berhasil diupload!');
    }
    public function destroy($itemId)
    {
        $item = DevelopmentProgressItem::findOrFail($itemId); // Ambil item
        $item->delete(); // Hapus

        return response()->json([
            'success' => true,
            'message' => 'Item berhasil dihapus!'
        ]);
    }

    /**
     * Menerapkan Template Standar RAP (I. Perizinan s/d VIII. Lainnya) secara dinamis dari Master Categories
     */
    public function applyTemplate($unitId)
    {
        try {
            $unit = LandBankUnit::findOrFail($unitId);
            if (in_array(strtolower($unit->status ?? ''), ['sold', 'soldout']) || strtolower($unit->construction_progress ?? '') === 'selesai') {
                return back()->with('error', 'Unit telah selesai / sold out. Template progress tidak dapat diterapkan.');
            }

            $progress = DevelopmentProgress::firstOrCreate(
                ['land_bank_unit_id' => $unit->id],
                ['title' => 'Progress Pembangunan Unit ' . $unit->unit_code]
            );

            $masterCategories = MasterProgressCategory::with('items')
                ->where('is_active', true)
                ->orderBy('urutan', 'asc')
                ->get();

            $inserted = 0;

            if ($masterCategories->count() > 0) {
                foreach ($masterCategories as $masterCat) {
                    foreach ($masterCat->items as $masterItem) {
                        $exists = $progress->items()
                            ->where('kategori', $masterCat->slug)
                            ->where('uraian', $masterItem->uraian)
                            ->exists();

                        if (!$exists) {
                            $progress->items()->create([
                                'kategori'     => $masterCat->slug,
                                'kode'         => $masterItem->kode,
                                'uraian'       => $masterItem->uraian,
                                'volume'       => $masterItem->default_volume,
                                'satuan'       => $masterItem->satuan,
                                'harga_satuan' => $masterItem->default_harga_satuan,
                                'total'        => round($masterItem->default_volume * $masterItem->default_harga_satuan),
                                'keterangan'   => $masterItem->keterangan,
                            ]);
                            $inserted++;
                        }
                    }
                }
            } else {
                $templateItems = DevelopmentProgressItem::getDefaultTemplateItems();
                foreach ($templateItems as $item) {
                    $exists = $progress->items()
                        ->where('kategori', $item['kategori'])
                        ->where('uraian', $item['uraian'])
                        ->exists();

                    if (!$exists) {
                        $progress->items()->create($item);
                        $inserted++;
                    }
                }
            }

            $subtotal = $progress->items()->sum('total');
            $ppn = round($subtotal * 0.1);
            $progress->total_anggaran = $subtotal + $ppn;
            $progress->save();

            return back()->with('success', "Template Standar RAP berhasil diterapkan ({$inserted} item baru ditambahkan dari Master)! ");
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menerapkan template RAP: ' . $e->getMessage());
        }
    }

    // =====================================================
    // PEMBAYARAN TERMIN
    // =====================================================

    public function storeTermin(Request $request)
    {
        $request->validate([
            'development_progress_id' => 'required|exists:development_progress,id',
            'land_bank_unit_id'       => 'required|exists:land_bank_units,id',
            'termin_ke'               => 'required|integer|min:1',
            'nama_termin'             => 'required|string|max:150',
            'uraian_pekerjaan'        => 'nullable|string',
            'syarat_progress_persen'  => 'nullable|numeric|min:0|max:100',
            'persentase_bayar'        => 'nullable|numeric|min:0|max:100',
            'nominal'                 => 'nullable|string',
            'tanggal_jatuh_tempo'     => 'nullable|date',
            'catatan'                 => 'nullable|string',
            'development_progress_item_id' => 'nullable|exists:development_progress_items,id',
        ]);

        $nominal = (float) preg_replace('/[^0-9.]/', '', str_replace(',', '.', $request->nominal ?? '0'));

        $termin = PembayaranTermin::create([
            'development_progress_id'      => $request->development_progress_id,
            'land_bank_unit_id'            => $request->land_bank_unit_id,
            'development_progress_item_id' => $request->development_progress_item_id,
            'termin_ke'                    => $request->termin_ke,
            'nama_termin'                  => $request->nama_termin,
            'uraian_pekerjaan'             => $request->uraian_pekerjaan,
            'syarat_progress_persen'       => $request->syarat_progress_persen ?? 0,
            'persentase_bayar'             => $request->persentase_bayar ?? 0,
            'nominal'                      => $nominal,
            'tanggal_jatuh_tempo'          => $request->tanggal_jatuh_tempo,
            'catatan'                      => $request->catatan,
            'status'                       => 'menunggu',
        ]);

        return response()->json(['success' => true, 'message' => 'Termin berhasil ditambahkan.', 'data' => $termin]);
    }

    public function updateTerminStatus(Request $request, $id)
    {
        $request->validate([
            'status'          => 'required|in:menunggu,diajukan,disetujui,dibayar,ditolak',
            'tanggal_bayar'   => 'nullable|date',
            'no_bukti_bayar'  => 'nullable|string|max:100',
            'catatan'         => 'nullable|string',
        ]);

        $termin = PembayaranTermin::findOrFail($id);
        $termin->status = $request->status;

        if ($request->status === 'dibayar') {
            $termin->tanggal_bayar = $request->tanggal_bayar ?? now()->toDateString();
            $termin->dibayar_oleh  = auth()->id();
            $termin->no_bukti_bayar = $request->no_bukti_bayar;
        } elseif ($request->status === 'disetujui') {
            $termin->disetujui_oleh = auth()->id();
        }
        if ($request->catatan) $termin->catatan = $request->catatan;
        $termin->save();

        return response()->json(['success' => true, 'message' => 'Status termin berhasil diperbarui.', 'data' => $termin]);
    }

    public function destroyTermin($id)
    {
        $termin = PembayaranTermin::findOrFail($id);
        $termin->delete();
        return response()->json(['success' => true, 'message' => 'Termin berhasil dihapus.']);
    }

    // =====================================================
    // OPNAME MINGGUAN
    // =====================================================

    public function storeOpname(Request $request)
    {
        $request->validate([
            'development_progress_id'      => 'required|exists:development_progress,id',
            'land_bank_unit_id'            => 'required|exists:land_bank_units,id',
            'minggu_ke'                    => 'required|integer|min:1',
            'tanggal_mulai_minggu'         => 'required|date',
            'tanggal_akhir_minggu'         => 'required|date|after_or_equal:tanggal_mulai_minggu',
            'progress_minggu_ini'          => 'nullable|numeric|min:0|max:100',
            'progress_kumulatif'           => 'nullable|numeric|min:0|max:100',
            'jumlah_pekerja'               => 'nullable|integer|min:0',
            'material_digunakan'           => 'nullable|string',
            'kendala'                      => 'nullable|string',
            'solusi'                       => 'nullable|string',
            'rencana_minggu_depan'         => 'nullable|string',
            'catatan'                      => 'nullable|string',
            'uraian_pekerjaan'             => 'nullable|array',
            'development_progress_item_id' => 'nullable|exists:development_progress_items,id',
        ]);

        // Auto-generate no_opname
        $progressId = $request->development_progress_id;
        $count = OpnameMingguan::where('development_progress_id', $progressId)->count() + 1;
        $noOpname = 'OPN-' . date('Y') . '-' . str_pad($count, 3, '0', STR_PAD_LEFT);

        $opname = OpnameMingguan::create([
            'development_progress_id'      => $progressId,
            'land_bank_unit_id'            => $request->land_bank_unit_id,
            'development_progress_item_id' => $request->development_progress_item_id,
            'no_opname'                    => $noOpname,
            'minggu_ke'                    => $request->minggu_ke,
            'tanggal_mulai_minggu'         => $request->tanggal_mulai_minggu,
            'tanggal_akhir_minggu'         => $request->tanggal_akhir_minggu,
            'progress_minggu_ini'          => $request->progress_minggu_ini ?? 0,
            'progress_kumulatif'           => $request->progress_kumulatif ?? 0,
            'jumlah_pekerja'               => $request->jumlah_pekerja,
            'material_digunakan'           => $request->material_digunakan,
            'kendala'                      => $request->kendala,
            'solusi'                       => $request->solusi,
            'rencana_minggu_depan'         => $request->rencana_minggu_depan,
            'catatan'                      => $request->catatan,
            'uraian_pekerjaan'             => $request->uraian_pekerjaan ?? [],
            'status'                       => 'draft',
            'dibuat_oleh'                  => auth()->check() ? auth()->id() : null,
        ]);

        // Sinkronisasi update progress_persen ke item RAP di database jika ada
        if (!empty($request->uraian_pekerjaan) && is_array($request->uraian_pekerjaan)) {
            foreach ($request->uraian_pekerjaan as $uItem) {
                if (is_array($uItem) && !empty($uItem['item_id']) && isset($uItem['progress_total'])) {
                    $progVal = max(0, min(100, (float)$uItem['progress_total']));
                    DevelopmentProgressItem::where('id', $uItem['item_id'])
                        ->where('development_progress_id', $progressId)
                        ->update(['progress_persen' => $progVal]);
                }
            }
        }

        // Sinkronisasi status konstruksi unit
        $unit = LandBankUnit::find($request->land_bank_unit_id);
        if ($unit && $request->filled('progress_kumulatif')) {
            $kum = (float)$request->progress_kumulatif;
            if ($kum >= 100) $unit->construction_progress = 'selesai';
            elseif ($kum >= 80) $unit->construction_progress = 'finishing';
            elseif ($kum >= 60) $unit->construction_progress = 'atap';
            elseif ($kum >= 40) $unit->construction_progress = 'dinding';
            elseif ($kum >= 20) $unit->construction_progress = 'pondasi';
            elseif ($kum > 0) $unit->construction_progress = 'pondasi';
            $unit->save();
        }

        return response()->json(['success' => true, 'message' => 'Opname minggu ke-' . $request->minggu_ke . ' berhasil disimpan.', 'data' => $opname]);
    }

    public function updateOpnameStatus(Request $request, $id)
    {
        $request->validate([
            'status'           => 'required|in:draft,diajukan,disetujui,ditolak',
            'catatan_reviewer' => 'nullable|string',
        ]);

        $opname = OpnameMingguan::findOrFail($id);
        $opname->status = $request->status;
        if ($request->catatan_reviewer) $opname->catatan_reviewer = $request->catatan_reviewer;
        if ($request->status === 'disetujui') {
            $opname->disetujui_oleh = auth()->id();
            $opname->tanggal_disetujui = now();
        }
        $opname->save();

        return response()->json(['success' => true, 'message' => 'Status opname berhasil diperbarui.', 'data' => $opname]);
    }

    public function destroyOpname($id)
    {
        $opname = OpnameMingguan::findOrFail($id);
        $opname->delete();
        return response()->json(['success' => true, 'message' => 'Data opname berhasil dihapus.']);
    }

    public function updateChecklistKondisi(Request $request, LandBankUnit $unit)
    {
        try {
            $progress = DevelopmentProgress::firstOrCreate(
                ['land_bank_unit_id' => $unit->id],
                ['title' => 'Progress Pembangunan']
            );

            $checklist = $request->input('checklist_kondisi', []);
            $progress->checklist_kondisi = $checklist;
            $progress->save();

            return response()->json([
                'success' => true,
                'message' => 'Checklist kondisi unit berhasil diperbarui',
                'checklist' => $checklist,
            ]);
        } catch (\Exception $e) {
            Log::error('Error update checklist kondisi: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui checklist: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * AJAX: Update Spesifikasi Teknis & Upload/Hapus 4 Foto Unit (Integrasi Proyek & Marketing)
     */
    public function updateSpesifikasiFoto(Request $request, LandBankUnit $unit)
    {
        try {
            $unitLp = UnitLandingPage::firstOrCreate(
                ['land_bank_unit_id' => $unit->id],
                [
                    'headline' => $unit->unit_name ? "Hunian Modern {$unit->unit_name} Siap Huni" : "Unit {$unit->unit_code} Siap Huni",
                    'is_published' => true,
                ]
            );

            // 1. Update spesifikasi jika dikirim
            if ($request->has('electricity')) {
                $unitLp->electricity = $request->electricity;
            }
            if ($request->has('floors')) {
                $unitLp->floors = (int)$request->floors;
            }
            if ($request->has('carport')) {
                $unitLp->carport = (int)$request->carport;
            }
            if ($request->has('bedrooms')) {
                $unitLp->bedrooms = (int)$request->bedrooms;
            }
            if ($request->has('bathrooms')) {
                $unitLp->bathrooms = (int)$request->bathrooms;
            }

            // 2. Upload / Hapus foto per slot
            $slot = $request->input('slot'); // 1, 2, 3, 4
            $uploadedUrl = null;

            if ($request->hasFile('photo')) {
                $file = $request->file('photo');
                if ($slot == 1) {
                    $path = $file->store('units', 'public');
                    $unit->photo = $path;
                    $unit->save();
                    $uploadedUrl = asset('storage/' . $path);
                } else {
                    $gallery = is_array($unitLp->gallery) ? $unitLp->gallery : [];
                    while (count($gallery) < 3) {
                        $gallery[] = null;
                    }
                    $galleryIdx = ((int)$slot) - 2;
                    $path = $file->store('units/gallery', 'public');
                    $gallery[$galleryIdx] = $path;
                    $unitLp->gallery = array_values(array_filter($gallery));
                    $uploadedUrl = asset('storage/' . $path);
                }
            } elseif ($request->input('action') === 'delete' && $slot) {
                if ($slot == 1) {
                    $unit->photo = null;
                    $unit->save();
                } else {
                    $gallery = is_array($unitLp->gallery) ? $unitLp->gallery : [];
                    $galleryIdx = ((int)$slot) - 2;
                    if (isset($gallery[$galleryIdx])) {
                        unset($gallery[$galleryIdx]);
                        $unitLp->gallery = array_values($gallery);
                    }
                }
            }

            $unitLp->save();

            return response()->json([
                'success' => true,
                'message' => 'Spesifikasi & foto fisik unit berhasil disinkronkan ke Landing Page Marketing.',
                'slot'    => $slot,
                'url'     => $uploadedUrl,
            ]);
        } catch (\Exception $e) {
            Log::error('Error update spesifikasi & foto unit: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui data: ' . $e->getMessage(),
            ], 500);
        }
    }
}

