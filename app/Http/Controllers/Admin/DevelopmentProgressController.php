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

            // 🔥 INI YANG WAJIB ADA
            $lastKategori = strtolower(trim($item['kategori']));

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

            if ($request->hasFile("items.$index.dokumentasi")) {
                $file = $request->file("items.$index.dokumentasi");
                $filePath = $file->store('progress_dokumentasi', 'public');

                $progressItem->documents()->create([
                    'file_path' => $filePath,
                ]);
            }
        }

        // ===============================
        // Mapping kategori → progress enum
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

        if ($progressEnum === 'finishing') {
            $unit->status = 'ready';
        }

        if ($request->filled('price')) {
            $unit->price = $request->price;
        }

        $unit->save();

        DB::commit();

        return back()->with('success', 'RAB & Dokumentasi berhasil disimpan.');

    } catch (\Exception $e) {

        DB::rollBack();

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

        $totalAnggaran = 0;

        if ($progress) {
            // Hitung total dari semua item
            $totalAnggaran = $progress->items()->sum('total');

            // Update kolom total_anggaran di tabel utama progress
            $progress->total_anggaran = $totalAnggaran;
            $progress->status = 'completed';
            $progress->save();
        }

        
        $unit->price = $unit->price + $totalAnggaran;

        // Update progress unit
        $unit->construction_progress = 'selesai';
        $unit->status = 'ready';
        $unit->save();

        return response()->json([
            'success' => true,
            'message' => 'RAB berhasil di-ACC dan harga unit diperbarui',
            'construction_progress' => $unit->construction_progress,
            'total_anggaran' => $totalAnggaran,
            'price_baru' => $unit->price,
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
public function destroy($itemId)
{
    $item = DevelopmentProgressItem::findOrFail($itemId); // Ambil item
    $item->delete(); // Hapus

    return response()->json([
        'success' => true,
        'message' => 'Item berhasil dihapus!'
    ]);
}
}
