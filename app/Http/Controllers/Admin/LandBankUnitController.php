<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LandBank;
use App\Models\LandBankUnit;
use App\Imports\LandBankUnitImport;
use Maatwebsite\Excel\Facades\Excel;
class LandBankUnitController extends Controller
{
    // Form buat kavling
    public function create(Request $request, $land_bank_id)
    {
        $land = LandBank::findOrFail($land_bank_id);

        // ===== FILTER =====
        $query = $land->units(); // LANGSUNG, tanpa ->query()

        // Filter search by unit code / block / unit number
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('unit_code', 'like', "%{$search}%")
                ->orWhere('block', 'like', "%{$search}%")
                ->orWhere('unit_number', 'like', "%{$search}%")
                ->orWhere('unit_name', 'like', "%{$search}%");
            });
        }

        // Filter by type
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        // Filter by position
        if ($request->filled('position')) {
            $query->where('position', $request->position);
        }

        // Filter by facing
        if ($request->filled('facing')) {
            $query->where('facing', $request->facing);
        }

        // Jumlah tampil per halaman (default 10, opsi: 10, 25, 50, 100)
        $perPage = $request->input('per_page', 10);

        // Ambil data dengan pagination
        $units = $query->paginate($perPage)->withQueryString();

        return view('properti.addkavling', compact('land', 'units', 'perPage'));
    }



    // Simpan Manual
    //  public function store(Request $request, $land_bank_id)
    // {
    //     dd($request->all());
    //     // kode lain
    // }
    public function store(Request $request, $land_bank_id)
    {
        $land = LandBank::findOrFail($land_bank_id);

        $priceClean = $request->price ? str_replace(['.', ','], '', $request->price) : null;
        $request->merge(['price' => $priceClean]);

        $request->validate([
            'block'         => 'required|string|max:5',
            'unit_number'   => 'required|string|max:5',
            'jenis'         => 'required|string|max:255',
            'type'          => 'required|string|max:50',
            'unit_name'     => 'nullable|string|max:255',
            'area'          => 'required|numeric|min:1',
            'building_area' => 'required|numeric|min:1',
            'price'         => 'nullable|numeric|min:0',
            'ijb_price'     => 'nullable|numeric|min:0',
            'ajb_price'     => 'nullable|numeric|min:0',
            'facing'        => 'nullable|in:Utara,Selatan,Timur,Barat',
            'position'      => 'nullable|in:Hook,Tengah,Sudut',
            'description'   => 'nullable|string|max:255',
        ]);


    
        if ($request->area > $land->remaining_area) {
            return back()->with('error', 'Luas unit melebihi sisa lahan!');
        }
        $unit_code = $request->block . '.' . $request->unit_number;

        if (LandBankUnit::where('unit_code', $unit_code)
            ->where('land_bank_id', $land->id)
            ->exists()
        ) {

            return back()->with('error', 'Unit ' . $unit_code . ' sudah ada di proyek ini.');
        }

        LandBankUnit::create([
            'land_bank_id' => $land->id,
            'block'        => $request->block,
            'unit_number'  => $request->unit_number,
            'unit_code'    => $unit_code,
            'jenis'        => $request->jenis,
            'type'         => $request->type,
            'unit_name'    => $request->unit_name,
            'area'         => $request->area,
            'building_area' => $request->building_area,
            'price'        => $request->price ?? 0,
            'ijb_price'    => $request->ijb_price ?? 0,
            'ajb_price'    => $request->ajb_price ?? 0,
            'facing'       => $request->facing,
            'position'     => $request->position,
            'description'  => $request->description,
            'status'       => 'draft',
        ]);

        $land->remaining_area = max(0, $land->remaining_area - $request->area);
        $land->development_status = 'progress'; // 🔥 UPDATE STATUS
        $land->save();

        return back()->with('success', 'Unit ' . $unit_code . ' berhasil ditambahkan.');
    }


    // public function store(Request $request, $land_bank_id)
    // {
    //     $land = LandBank::findOrFail($land_bank_id);

    //     $request->validate([
    //         'block'       => 'required|string|max:5',
    //         'unit_number' => 'required|string|max:5',
    //         'area'        => 'required|numeric|min:1',
    //         'price'       => 'nullable|numeric|min:0',
    //         'facing'      => 'nullable|in:Utara,Selatan,Timur,Barat',
    //         'position'    => 'nullable|in:Hook,Tengah,Sudut',
    //         'description' => 'nullable|string|max:255',
    //     ]);

    //     $unit_code = $request->block . '.' . $request->unit_number;

    //     // Debug: cek data dari form
    //     dd([
    //         'land_id'     => $land->id,
    //         'block'       => $request->block,
    //         'unit_number' => $request->unit_number,
    //         'unit_code'   => $unit_code,
    //         'area'        => $request->area,
    //         'price'       => $request->price,
    //         'facing'      => $request->facing,
    //         'position'    => $request->position,
    //         'description' => $request->description,
    //     ]);

    //     if (LandBankUnit::where('unit_code', $unit_code)->exists()) {
    //         return back()->with('error', 'Unit ' . $unit_code . ' sudah ada.');
    //     }
    //     $price = $request->price ? str_replace(['.', ','], '', $request->price) : 0;
    //     LandBankUnit::create([
    //         'land_bank_id' => $land->id,
    //         'block'        => $request->block,
    //         'unit_number'  => $request->unit_number,
    //         'unit_code'    => $unit_code,
    //         'area'         => $request->area,
    //         'price'        => $price,
    //         'facing'       => $request->facing,
    //         'position'     => $request->position,
    //         'description'  => $request->description,
    //         'status'       => 'draft',
    //     ]);

    //     $land->remaining_area = max(0, $land->remaining_area - $request->area);
    //     $land->save();

    //     return back()->with('success', 'Unit ' . $unit_code . ' berhasil ditambahkan.');
    // }


    // Generate Otomatis
    // public function generate(Request $request, $land_bank_id)
    // {
    //     $land = LandBank::findOrFail($land_bank_id);

    //     $request->validate([
    //         'jumlah_unit'      => 'required|integer|min:1',
    //         'area_per_unit'    => 'required|numeric|min:1',
    //         'price_per_unit'   => 'nullable|numeric|min:0',
    //         'prefix_block'     => 'required|string|max:5',
    //         'start_number'     => 'required|integer|min:1',
    //         'default_facing'   => 'nullable|in:Utara,Selatan,Timur,Barat',
    //         'default_position' => 'nullable|in:Hook,Tengah,Sudut',
    //     ]);

    //     $total_area_needed = $request->jumlah_unit * $request->area_per_unit;

    //     // Debug: cek data sebelum generate
    //     dd([
    //         'land_id'          => $land->id,
    //         'jumlah_unit'      => $request->jumlah_unit,
    //         'area_per_unit'    => $request->area_per_unit,
    //         'price_per_unit'   => $request->price_per_unit,
    //         'prefix_block'     => $request->prefix_block,
    //         'start_number'     => $request->start_number,
    //         'default_facing'   => $request->default_facing,
    //         'default_position' => $request->default_position,
    //         'total_area_needed' => $total_area_needed,
    //         'remaining_area'   => $land->remaining_area,
    //     ]);

    //     if ($total_area_needed > $land->remaining_area) {
    //         return back()->with('error', 'Sisa luas tanah tidak cukup untuk ' . $request->jumlah_unit . ' unit.');
    //     }

    //     $start = $request->start_number;
    //     $end   = $start + $request->jumlah_unit - 1;

    //     for ($i = $start; $i <= $end; $i++) {
    //         $unit_code = $request->prefix_block . '.' . $i;

    //         if (LandBankUnit::where('unit_code', $unit_code)->exists()) continue;

    //         LandBankUnit::create([
    //             'land_bank_id' => $land->id,
    //             'block'        => $request->prefix_block,
    //             'unit_number'  => $i,
    //             'unit_code'    => $unit_code,
    //             'area'         => $request->area_per_unit,
    //             'price'        => $request->price_per_unit,
    //             'facing'       => $request->default_facing,
    //             'position'     => $request->default_position,
    //             'status'       => 'draft',
    //         ]);
    //     }

    //     $land->remaining_area -= $total_area_needed;
    //     $land->save();

    //     return back()->with('success', $request->jumlah_unit . ' unit berhasil digenerate.');
    // }



    // Tampilkan form edit
    public function edit(LandBankUnit $unit)
    {
        return view('properti.editkavling', compact('unit'));
    }

    // Update unit
    public function update(Request $request, LandBankUnit $unit)
    {
        $request->validate([
            'block'       => 'required|string|max:5',
            'unit_number' => 'required|string|max:5',
            'area'        => 'required|numeric|min:1',
            'price'       => 'nullable|numeric|min:0',
            'ijb_price'   => 'nullable|numeric|min:0',
            'ajb_price'   => 'nullable|numeric|min:0',
            'facing'      => 'nullable|in:Utara,Selatan,Timur,Barat',
            'position'    => 'nullable|in:Hook,Tengah,Sudut',
            'description' => 'nullable|string|max:255',
        ]);

        $unit_code = $request->block . '.' . $request->unit_number;

        $unit->update([
            'block'       => $request->block,
            'unit_number' => $request->unit_number,
            'unit_code'   => $unit_code,
            'area'        => $request->area,
            'price'       => str_replace(['.', ','], '', $request->price ?? 0),
            'ijb_price'   => str_replace(['.', ','], '', $request->ijb_price ?? 0),
            'ajb_price'   => str_replace(['.', ','], '', $request->ajb_price ?? 0),
            'facing'      => $request->facing,
            'position'    => $request->position,
            'description' => $request->description,
        ]);

        return redirect()->back()->with('success', 'Unit ' . $unit_code . ' berhasil diperbarui.');
    }

    // Hapus unit
    public function destroy(LandBankUnit $unit)
    {
        $unit_code = $unit->unit_code;
        $unit->delete();

        return redirect()->back()->with('success', 'Unit ' . $unit_code . ' berhasil dihapus.');
    }
    public function updateProgress(Request $request, LandBankUnit $unit)
    {
        $request->validate([
            'construction_progress' => 'required|in:belum_mulai,pondasi,dinding,atap,finishing,selesai',
            'materials.name.*' => 'required|string',
            'materials.quantity.*' => 'nullable|numeric',
        ]);

        // update progress
        $unit->construction_progress = $request->construction_progress;
        $unit->save();

        // update bahan baku
        $unit->materials()->delete(); // hapus bahan lama dulu
        if ($request->has('materials')) {
            foreach ($request->materials['name'] as $index => $name) {
                $unit->materials()->create([
                    'name' => $name,
                    'quantity' => $request->materials['quantity'][$index] ?? null,
                    'unit' => $request->materials['unit'][$index] ?? null,
                    'notes' => $request->materials['notes'][$index] ?? null,
                    'status' => $request->materials['status'][$index] ?? 'pending'
                ]);
            }
        }

        return redirect()->back()->with('success', 'Progress dan bahan baku unit ' . $unit->unit_code . ' berhasil diperbarui.');
    }
    public function downloadTemplate()
    {
        $filePath = public_path('templates/land_bank_unit_template.xlsx');

        if (!file_exists($filePath)) {
            return redirect()->back()->with('error', 'Template tidak ditemukan.');
        }

        return response()->download($filePath, 'land_bank_unit_template.xlsx');
    }
    public function import(Request $request, $land_bank_id)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls',
        ]);

        try {
            $file = $request->file('file');
            $import = new LandBankUnitImport($land_bank_id);
            Excel::import($import, $file);

            return redirect()->back()->with('success', 'Data unit berhasil diimpor.');
        } catch (\Exception $e) {
            Log::error('Import error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengimpor: ' . $e->getMessage());
        }
    }
}
