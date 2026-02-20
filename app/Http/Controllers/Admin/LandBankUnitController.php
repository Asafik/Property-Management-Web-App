<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LandBank;
use App\Models\LandBankUnit;

class LandBankUnitController extends Controller
{
    // Form buat kavling
public function create($land_bank_id)
{
    // Ambil land beserta units
    $land = LandBank::with('units')->findOrFail($land_bank_id);

    // Mapping status ke persentase
    $map = [
        'belum_mulai' => 0,
        'pondasi'     => 20,
        'dinding'     => 40,
        'atap'        => 60,
        'finishing'   => 80,
        'selesai' => 100
    ];

    foreach ($land->units as $unit) {
        // Pastikan value string sesuai mapping
        $status = strtolower($unit->construction_progress ?? 'belum_mulai');
        $unit->progress_percentage = $map[$status] ?? 0;
    }

    return view('properti.addkavling', compact('land'));
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
            'type'          => 'required|string|max:50',
            'area'          => 'required|numeric|min:1',
            'building_area' => 'required|numeric|min:1',
            'price'         => 'nullable|numeric|min:0',
            'facing'        => 'nullable|in:Utara,Selatan,Timur,Barat',
            'position'      => 'nullable|in:Hook,Tengah,Sudut',
            'description'   => 'nullable|string|max:255',
        ]);


        $unit_code = $request->block . '.' . $request->unit_number;

        if (LandBankUnit::where('unit_code', $unit_code)->exists()) {
            return back()->with('error', 'Unit ' . $unit_code . ' sudah ada.');
        }

        LandBankUnit::create([
            'land_bank_id' => $land->id,
            'block'        => $request->block,
            'unit_number'  => $request->unit_number,
            'unit_code'    => $unit_code,
            'type'         => $request->type,
            'area'         => $request->area,
            'building_area' => $request->building_area,
            'price'        => $request->price ?? 0,
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
public function generate(Request $request, $land_bank_id)
{
    Log::info('=== GENERATE KAVLING START ===');
    Log::info('Request Data:', $request->all());

    try {

        $land = LandBank::findOrFail($land_bank_id);
        Log::info('Land ditemukan', ['land_id' => $land->id, 'remaining_area' => $land->remaining_area]);

        // Bersihkan harga
        if ($request->has('price_per_unit')) {
            $request->merge([
                'price_per_unit' => str_replace(['.', ','], '', $request->price_per_unit)
            ]);
        }

        $validated = $request->validate([
            'jumlah_unit'        => 'required|integer|min:1',
            'area_per_unit'      => 'required|numeric|min:1',
            'building_area_unit' => 'required|numeric|min:1',
            'price_per_unit'     => 'nullable|numeric|min:0',
            'prefix_block'       => 'required|string|max:5',
            'start_number'       => 'required|integer|min:1',
            'type' => 'nullable|string|max:20',
            'default_facing'     => 'nullable|in:Utara,Selatan,Timur,Barat',
            'default_position'   => 'nullable|in:Hook,Tengah,Sudut',
        ]);

        Log::info('Validation lolos');

        $total_area_needed = $request->jumlah_unit * $request->area_per_unit;

        Log::info('Total area needed', [
            'total' => $total_area_needed,
            'remaining' => $land->remaining_area
        ]);

        if ($total_area_needed > $land->remaining_area) {
            Log::warning('Sisa tanah tidak cukup');
            return back()->with('error', 'Sisa luas tanah tidak cukup.');
        }

        $start = $request->start_number;
        $end   = $start + $request->jumlah_unit - 1;

        for ($i = $start; $i <= $end; $i++) {

            $unit_code = $request->prefix_block . '.' . $i;

            if (LandBankUnit::where('unit_code', $unit_code)->exists()) {
                Log::warning('Unit sudah ada', ['unit_code' => $unit_code]);
                continue;
            }

            Log::info('Membuat unit', ['unit_code' => $unit_code]);

            LandBankUnit::create([
                'land_bank_id' => $land->id,
                'block'        => $request->prefix_block,
                'unit_number'  => $i,
                'unit_code'    => $unit_code,
                'area'         => $request->area_per_unit,
                'building_area'=> $request->building_area_unit,
                'price'        => $request->price_per_unit,
                'type'         => $request->type, 
                'facing'       => $request->default_facing,
                'position'     => $request->default_position,
                'status'       => 'draft',
            ]);
        }

        $land->remaining_area -= $total_area_needed;
        $land->save();

        Log::info('Generate selesai');
        Log::info('=== GENERATE KAVLING END ===');

        return back()->with('success', $request->jumlah_unit . ' unit berhasil digenerate.');

    } catch (\Exception $e) {

        Log::error('ERROR GENERATE KAVLING', [
            'message' => $e->getMessage(),
            'line' => $e->getLine(),
            'file' => $e->getFile(),
        ]);

        return back()->with('error', 'Terjadi error. Cek log.');
    }
}


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
}
