<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LandBank;
use App\Models\LandBankUnit;
use App\Models\DevelopmentProgress;
use App\Models\DevelopmentProgressItem;
use App\Models\MasterProgressCategory;
use App\Models\MasterProgressItem;
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

        return view('properti.proses_pembangunan', compact('land', 'selectedUnit', 'items', 'masterCategories'));
    }

    public function store(Request $request)
    {
        Log::info($request->all());

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
            'items.*.dokumentasi' => 'nullable|file|mimes:jpg,jpeg,png,webp,pdf,doc,docx,heic,heif,bmp|max:10240',
            'deadline'            => 'nullable|array',
            'deadline.*'          => 'nullable|date',
        ], [
            'items.*.dokumentasi.mimes' => 'Format file dokumentasi tidak didukung. Harap gunakan file berformat: JPG, JPEG, PNG, WEBP, atau PDF.',
            'items.*.dokumentasi.max'   => 'Ukuran file dokumentasi terlalu besar. Maksimal ukuran file adalah 10 MB.',
            'items.*.dokumentasi.file'  => 'File dokumentasi harus berupa file yang valid.',
        ]);

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

                // UPDATE deadline item lama
                if ($itemId && empty($item['kategori'])) {

                    DevelopmentProgressItem::where('id', $itemId)
                        ->update([
                            'deadline' => $deadlineItem
                        ]);

                    continue;
                }

                // CREATE item baru
                $progressItem = $progress->items()->create([
                    'kategori'     => $item['kategori'],
                    'kode'         => $item['kode'],
                    'uraian'       => $item['uraian'],
                    'volume'       => $item['volume'],
                    'satuan'       => $item['satuan'],
                    'harga_satuan' => $item['harga_satuan'],
                    'total'        => $item['volume'] * $item['harga_satuan'],
                    'keterangan'   => $item['keterangan'] ?? null,
                    'deadline'     => $deadlineItem,
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
}
