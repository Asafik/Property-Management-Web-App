<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LandBank;
use App\Models\LandBankUnit;
use App\Models\DevelopmentProgress;
use App\Models\DevelopmentProgressItem;
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

        return view('properti.proses_pembangunan', compact('land', 'selectedUnit', 'items'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'land_bank_unit_id' => 'required|exists:land_bank_units,id',
            'items' => 'nullable|array',
            'items.*.kategori' => 'required|string',
            'items.*.kode' => 'required|string',
            'items.*.uraian' => 'required|string',
            'items.*.volume' => 'required|numeric',
            'items.*.satuan' => 'required|string',
            'items.*.harga_satuan' => 'required|numeric',
            'items.*.keterangan' => 'nullable|string',
            'items.*.dokumentasi' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        DB::beginTransaction();

        try {

            $progress = DevelopmentProgress::firstOrCreate(
                ['land_bank_unit_id' => $request->land_bank_unit_id],
                ['title' => $request->title ?? 'Progress Baru']
            );

            $lastKategori = null;

            foreach ($request->items ?? [] as $index => $item) {

                // 1️⃣ Simpan item dulu
                $progressItem = $progress->items()->create([
                    'kategori'     => $item['kategori'],
                    'kode'         => $item['kode'],
                    'uraian'       => $item['uraian'],
                    'volume'       => $item['volume'],
                    'satuan'       => $item['satuan'],
                    'harga_satuan' => $item['harga_satuan'],
                    'total'        => $item['volume'] * $item['harga_satuan'],
                    'keterangan'   => $item['keterangan'] ?? null,
                ]);

                // 2️⃣ Jika ada file → simpan ke tabel documents
                if ($request->hasFile("items.$index.dokumentasi")) {

                    $file = $request->file("items.$index.dokumentasi");

                    $filePath = $file->store('progress_dokumentasi', 'public');

                    $progressItem->documents()->create([
                        'file_path' => $filePath,
                    ]);
                }
            }

            // ===============================
            // 3️⃣ Mapping kategori → progress enum
            // ===============================
            $kategoriMapping = [
                'persiapan' => 'belum_mulai',
                'pondasi'   => 'pondasi',
                'struktur'  => 'dinding',
                'dinding'   => 'dinding',
                'atap'      => 'atap',
                'finishing' => 'finishing',
                'selesai'   => 'selesai',
            ];

            $progressEnum = $kategoriMapping[$lastKategori] ?? 'belum_mulai';

            $unit = LandBankUnit::findOrFail($request->land_bank_unit_id);
            $unit->construction_progress = $progressEnum;

            // Jika tahap finishing → status ready
            if ($progressEnum === 'finishing') {
                $unit->status = 'ready';
            }

            // Update harga jual jika diisi
            if ($request->filled('price')) {
                $unit->price = $request->price;
            }

            $unit->save();

            DB::commit();

            Log::info("RAB & Dokumentasi berhasil disimpan", [
                'unit_id' => $request->land_bank_unit_id,
                'progress_enum' => $progressEnum,
                'user_id' => auth()->id() ?? null,
            ]);

            return back()->with('success', 'RAB & Dokumentasi berhasil disimpan.');
        } catch (\Exception $e) {

            DB::rollBack();

            Log::error("Gagal menyimpan RAB & Dokumentasi", [
                'unit_id' => $request->land_bank_unit_id ?? null,
                'error_message' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
                'user_id' => auth()->id() ?? null,
            ]);

            return back()->with('error', 'Terjadi kesalahan, cek log.');
        }
    }


    public function accAjax($unitId)
    {
        try {
            // Ambil unit
            $unit = LandBankUnit::findOrFail($unitId);

            // Update progress unit
            $unit->construction_progress = 'selesai';
            $unit->status = 'ready';
            $unit->save();

            // Ambil progress terkait
            $progress = $unit->progress; // hasOne(DevelopmentProgress)

            if ($progress) {
                // Hitung total dari semua item
                $totalAnggaran = $progress->items()->sum('total');

                // Update kolom total_anggaran di tabel utama
                $progress->total_anggaran = $totalAnggaran;
                $progress->status = 'completed'; // opsional, bisa set completed
                $progress->save();
            }

            return response()->json([
                'success' => true,
                'message' => 'RAB berhasil di-ACC dan total anggaran diperbarui',
                'construction_progress' => $unit->construction_progress,
                'total_anggaran' => $progress->total_anggaran ?? 0,
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
            'dokumentasi' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048'
        ]);

        $item = DevelopmentProgressItem::findOrFail($itemId);

        if ($request->file('dokumentasi')) {
            $path = $request->file('dokumentasi')->store('dokumentasi', 'public');
            $item->dokumentasi = $path;
            $item->save();
        }

        return back()->with('success', 'File berhasil diupload!');
    }
}
