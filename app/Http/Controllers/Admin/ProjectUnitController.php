<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LandBank;
use App\Models\LandBankUnit;

class ProjectUnitController extends Controller
{
    /**
     * Halaman Utama: Daftar Unit Proyek Kawasan (Membaca langsung dari Database Riil LandBankUnit).
     * Menampilkan daftar unit dan progres konstruksi fisik.
     */
    public function index(Request $request)
    {
        $query = LandBankUnit::with(['landBank']);

        // Filter Berdasarkan Tanah / Proyek Asal
        if ($request->filled('land_bank_id') && $request->land_bank_id !== 'all') {
            $query->where('land_bank_id', (int) $request->land_bank_id);
        }

        // Filter Berdasarkan Status
        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        // Filter Berdasarkan Jenis (Subsidi / Komersil)
        if ($request->filled('jenis') && $request->jenis !== 'all') {
            $query->where('jenis', $request->jenis);
        }

        // Filter Pencarian (Kode Unit / Blok / Nomor / Nama / Proyek)
        if ($request->filled('search')) {
            $keyword = trim($request->search);
            $query->where(function ($q) use ($keyword) {
                $q->where('unit_code', 'like', "%{$keyword}%")
                    ->orWhere('block', 'like', "%{$keyword}%")
                    ->orWhere('unit_number', 'like', "%{$keyword}%")
                    ->orWhere('unit_name', 'like', "%{$keyword}%")
                    ->orWhereHas('landBank', function ($lq) use ($keyword) {
                        $lq->where('name', 'like', "%{$keyword}%")
                           ->orWhere('district', 'like', "%{$keyword}%")
                           ->orWhere('city', 'like', "%{$keyword}%");
                    });
            });
        }

        // KPI Ringkasan
        $allUnits = LandBankUnit::all();
        $totalUnit = $allUnits->count();
        $totalAvailable = $allUnits->where('status', 'ready')->count();
        $totalBooking = $allUnits->where('status', 'booked')->count();
        $totalSold = $allUnits->whereIn('status', ['sold', 'terjual'])->count();

        // Dropdown List Tanah / Proyek Asal dari Database Riil
        $landBanks = LandBank::select('id', 'name')->orderBy('name')->get();

        // Paginasi Database Riil
        $perPage = (int) $request->input('per_page', 10);
        if (!in_array($perPage, [10, 25, 50, 100])) {
            $perPage = 10;
        }

        $units = $query->orderBy('land_bank_id')
            ->orderBy('block')
            ->orderBy('unit_number')
            ->paginate($perPage)
            ->withQueryString();

        // Data Unit Lengkap untuk Modal Pilihan SPK (Grouped by LandBank)
        $allUnitsForSpk = LandBankUnit::with('landBank')
            ->select('id', 'land_bank_id', 'unit_code', 'unit_name', 'block', 'unit_number', 'type', 'jenis', 'no_spk', 'kontraktor')
            ->orderBy('land_bank_id')
            ->orderBy('block')
            ->orderBy('unit_number')
            ->get();

        return view('proyek_unit.index', compact(
            'units',
            'landBanks',
            'allUnitsForSpk',
            'totalUnit',
            'totalAvailable',
            'totalBooking',
            'totalSold'
        ));
    }

    /**
     * Terbitkan & Hubungkan Kontrak SPK Borongan ke Multi-Unit Proyek
     */
    public function assignSpk(Request $request)
    {
        $request->validate([
            'no_spk'        => 'required|string|max:255',
            'kontraktor'    => 'required|string|max:255',
            'nilai_kontrak' => 'nullable|string|max:255',
            'tanggal_spk'   => 'nullable|date',
            'unit_ids'      => 'required|array|min:1',
            'unit_ids.*'    => 'exists:land_bank_units,id',
            'dokumen_spk'   => 'nullable|file|mimes:pdf|max:15360',
            'description'   => 'nullable|string|max:500',
        ], [
            'unit_ids.required'   => 'Pilih minimal satu unit kavling untuk SPK ini.',
            'unit_ids.min'        => 'Pilih minimal satu unit kavling untuk SPK ini.',
            'no_spk.required'     => 'Nomor SPK wajib diisi.',
            'kontraktor.required' => 'Nama Kontraktor wajib diisi.'
        ]);

        $unitCount = count($request->unit_ids);
        $nilaiPerUnit = $request->nilai_kontrak ? (float) str_replace(['.', ',', 'Rp', ' '], '', $request->nilai_kontrak) : 0;
        $totalNilaiKontrak = $nilaiPerUnit * $unitCount;

        $selectedUnits = LandBankUnit::whereIn('id', $request->unit_ids)->get();
        $primaryLandBankId = $selectedUnits->first()?->land_bank_id;

        $spkPath = null;
        if ($request->hasFile('dokumen_spk')) {
            $file = $request->file('dokumen_spk');
            $filename = 'SPK_' . time() . '_' . preg_replace('/[^A-Za-z0-9_\-\.]/', '_', $file->getClientOriginalName());
            $destination = public_path("uploads/spk");
            if (!file_exists($destination)) {
                mkdir($destination, 0755, true);
            }
            $file->move($destination, $filename);
            $spkPath = "uploads/spk/{$filename}";
        }

        $updateData = [
            'no_spk'     => $request->no_spk,
            'kontraktor' => $request->kontraktor,
        ];

        if ($spkPath) {
            $updateData['dokumen_spk'] = $spkPath;
        }

        // Update semua unit yang dipilih
        LandBankUnit::whereIn('id', $request->unit_ids)->update($updateData);

        // Sync / Create / Update record di tabel spks
        $spkData = [
            'land_bank_id'        => $primaryLandBankId,
            'land_bank_unit_id'   => $unitCount == 1 ? $request->unit_ids[0] : null,
            'jenis_spk'           => 'Pembangunan Unit',
            'nama_pekerjaan'      => 'Pembangunan Unit ' . ($selectedUnits->first()?->landBank?->name ?? 'Proyek') . ($unitCount > 1 ? " ({$unitCount} Unit)" : ''),
            'kontraktor_nama'     => $request->kontraktor,
            'tanggal_spk'         => $request->tanggal_spk ?: date('Y-m-d'),
            'tanggal_mulai'       => $request->tanggal_spk ?: date('Y-m-d'),
            'tanggal_selesai'     => date('Y-m-d', strtotime(($request->tanggal_spk ?: date('Y-m-d')) . ' +90 days')),
            'durasi_hari'         => 90,
            'nilai_kontrak'       => $totalNilaiKontrak,
            'sistem_pembayaran'   => 'termin',
            'status'              => 'berjalan',
            'progress'            => 0,
            'keterangan'          => $request->description,
        ];

        if ($spkPath) {
            $spkData['file_lampiran'] = $spkPath;
        }

        $spk = \App\Models\Spk::updateOrCreate(
            ['no_spk' => $request->no_spk],
            $spkData
        );

        // Jika SPK belum memiliki termin dan nilai kontrak > 0, generate termin standar otomatis
        if ($spk->termins()->count() == 0 && $totalNilaiKontrak > 0) {
            $defaultTermins = [
                ['termin_ke' => 1, 'nama_tahap' => 'Termin 1 (Pondasi & Struktur Bawah)', 'persentase' => 25, 'syarat_progress' => 25],
                ['termin_ke' => 2, 'nama_tahap' => 'Termin 2 (Dinding, Kusen & Atap)', 'persentase' => 35, 'syarat_progress' => 60],
                ['termin_ke' => 3, 'nama_tahap' => 'Termin 3 (Finishing, Keramik & Cat)', 'persentase' => 35, 'syarat_progress' => 95],
                ['termin_ke' => 4, 'nama_tahap' => 'Termin 4 (Retensi Pemeliharaan)', 'persentase' => 5, 'syarat_progress' => 100],
            ];

            foreach ($defaultTermins as $dt) {
                $nominalTermin = ($dt['persentase'] / 100) * $totalNilaiKontrak;
                \App\Models\SpkTermin::create([
                    'spk_id'          => $spk->id,
                    'termin_ke'       => $dt['termin_ke'],
                    'nama_tahap'      => $dt['nama_tahap'],
                    'persentase'      => $dt['persentase'],
                    'syarat_progress' => $dt['syarat_progress'],
                    'nominal'         => $nominalTermin,
                    'status'          => 'belum',
                ]);
            }
        }

        return redirect()->back()->with('success', "Kontrak SPK '{$request->no_spk}' berhasil diterbitkan dan ditugaskan ke {$unitCount} unit kavling!");
    }
}
