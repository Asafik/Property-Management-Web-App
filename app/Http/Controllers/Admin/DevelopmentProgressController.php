<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LandBank;
use App\Models\LandBankUnit;
use App\Models\DevelopmentProgress;
use App\Models\DevelopmentProgressItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // ← INI WAJIB

class DevelopmentProgressController extends Controller
{
public function index($land_bank_id, Request $request)
{
    $land = LandBank::with('units')->findOrFail($land_bank_id);

    $unitId = $request->unit_id ?? $land->units->first()->id;

    $selectedUnit = $land->units()
        ->with('progress.items')
        ->findOrFail($unitId);

    // Ambil semua item dari progress unit
    $items = $selectedUnit->progress ? $selectedUnit->progress->items : collect();

    return view('properti.proses_pembangunan', compact('land', 'selectedUnit', 'items'));
}

public function store(Request $request)
{
    DB::beginTransaction();

    try {
        $progress = DevelopmentProgress::firstOrCreate(
            ['land_bank_unit_id' => $request->land_bank_unit_id],
            ['title' => $request->title ?? 'Progress Baru']
        );

        $lastKategori = null;

        foreach ($request->items ?? [] as $item) {
            $progress->items()->create([
                'kategori'     => $item['kategori'],
                'kode'         => $item['kode'],
                'uraian'       => $item['uraian'],
                'volume'       => $item['volume'],
                'satuan'       => $item['satuan'],
                'harga_satuan' => $item['harga_satuan'],
                'total'        => $item['volume'] * $item['harga_satuan'],
                'keterangan'   => $item['keterangan'] ?? null,
            ]);

            $lastKategori = $item['kategori'];
        }

        // Mapping kategori → progress enum
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

        // Update status jika finishing
        if ($progressEnum === 'finishing') {
            $unit->status = 'ready';
        }

        // Update harga jual final dari form
        if ($request->filled('price')) {
            $unit->price = $request->price;
        }

        $unit->save();

        DB::commit();

        return back()->with('success', 'RAB & Harga Jual berhasil disimpan.');
    } catch (\Exception $e) {
        DB::rollBack();
        return back()->with('error', $e->getMessage());
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
