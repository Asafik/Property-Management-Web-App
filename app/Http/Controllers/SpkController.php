<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Spk;
use App\Models\SpkTermin;
use App\Models\LandBank;
use App\Models\LandBankUnit;
use App\Models\CompanySetting;
use App\Models\CompanyProfile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SpkController extends Controller
{
    /**
     * Tampilkan daftar SPK Kontraktor dengan filter dan statistik.
     */
    public function index(Request $request)
    {
        $query = Spk::with(['landBank', 'unit', 'termins'])->latest();

        // Filter Pencarian
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('no_spk', 'like', "%{$search}%")
                  ->orWhere('kontraktor_nama', 'like', "%{$search}%")
                  ->orWhere('nama_pekerjaan', 'like', "%{$search}%")
                  ->orWhere('kontraktor_pic', 'like', "%{$search}%");
            });
        }

        // Filter Proyek
        if ($request->filled('land_bank_id')) {
            $query->where('land_bank_id', $request->land_bank_id);
        }

        // Filter Status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter Jenis SPK
        if ($request->filled('jenis_spk')) {
            $query->where('jenis_spk', $request->jenis_spk);
        }

        $perPage = (int) $request->input('per_page', 10);
        $spks = $query->paginate($perPage)->withQueryString();

        // Data Statistik
        $stats = [
            'total_spk' => Spk::count(),
            'spk_berjalan' => Spk::where('status', 'berjalan')->count(),
            'spk_selesai' => Spk::where('status', 'selesai')->count(),
            'spk_draft' => Spk::where('status', 'draft')->count(),
            'total_nilai' => Spk::where('status', '!=', 'dibatalkan')->sum('nilai_kontrak'),
        ];

        $landBanks = LandBank::orderBy('name', 'asc')->get();

        return view('spk.index', compact('spks', 'stats', 'landBanks', 'perPage'));
    }

    /**
     * Form pembuatan SPK baru.
     */
    public function create()
    {
        $landBanks = LandBank::with('units')->orderBy('name', 'asc')->get();
        $companySetting = CompanySetting::first();
        $companyProfile = CompanyProfile::first();

        // Generate Nomor SPK Otomatis
        $romanMonths = [1 => 'I', 2 => 'II', 3 => 'III', 4 => 'IV', 5 => 'V', 6 => 'VI', 7 => 'VII', 8 => 'VIII', 9 => 'IX', 10 => 'X', 11 => 'XI', 12 => 'XII'];
        $currentMonth = $romanMonths[(int) date('n')];
        $currentYear = date('Y');
        $nextNumber = str_pad(Spk::whereYear('created_at', date('Y'))->count() + 1, 3, '0', STR_PAD_LEFT);
        $defaultNoSpk = "SPK/{$currentYear}/{$currentMonth}/{$nextNumber}";

        // Draft Klausul / Pasal Standar SPK Developer
        $defaultPasal = $this->getDefaultPasalText();

        return view('spk.create', compact('landBanks', 'companySetting', 'companyProfile', 'defaultNoSpk', 'defaultPasal'));
    }

    /**
     * Simpan SPK baru ke database.
     */
    public function store(Request $request)
    {
        // Bersihkan format rupiah pada nilai kontrak
        $nilaiKontrakClean = $request->nilai_kontrak ? str_replace(['.', ',', 'Rp', ' '], '', $request->nilai_kontrak) : 0;
        $request->merge(['nilai_kontrak' => $nilaiKontrakClean]);

        $request->validate([
            'no_spk'               => 'required|string|unique:spks,no_spk|max:100',
            'land_bank_id'         => 'required|exists:land_banks,id',
            'land_bank_unit_id'    => 'nullable|exists:land_bank_units,id',
            'jenis_spk'            => 'required|string|max:100',
            'nama_pekerjaan'       => 'required|string|max:255',
            'kontraktor_nama'      => 'required|string|max:255',
            'kontraktor_pic'       => 'nullable|string|max:255',
            'kontraktor_ktp'       => 'nullable|string|max:50',
            'kontraktor_telepon'   => 'nullable|string|max:50',
            'tanggal_spk'          => 'required|date',
            'tanggal_mulai'        => 'required|date',
            'tanggal_selesai'      => 'required|date|after_or_equal:tanggal_mulai',
            'durasi_hari'          => 'nullable|integer|min:1',
            'nilai_kontrak'        => 'required|numeric|min:0',
            'sistem_pembayaran'    => 'required|string|in:termin,opname,lumpsum',
            'status'               => 'required|string|in:draft,berjalan,selesai,dibatalkan',
            'file_lampiran'        => 'nullable|file|mimes:pdf,jpg,jpeg,png,docx|max:15360',
        ]);

        DB::beginTransaction();
        try {
            // Upload Lampiran jika ada
            $fileLampiranPath = null;
            if ($request->hasFile('file_lampiran')) {
                $file = $request->file('file_lampiran');
                $filename = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '', $file->getClientOriginalName());
                $file->move(public_path('uploads/spk'), $filename);
                $fileLampiranPath = 'uploads/spk/' . $filename;
            }

            // Hitung durasi hari jika belum diisi
            $durasiHari = $request->durasi_hari;
            if (!$durasiHari && $request->tanggal_mulai && $request->tanggal_selesai) {
                $start = new \DateTime($request->tanggal_mulai);
                $end = new \DateTime($request->tanggal_selesai);
                $durasiHari = $start->diff($end)->days + 1;
            }

            $spk = Spk::create([
                'no_spk'                   => $request->no_spk,
                'land_bank_id'             => $request->land_bank_id,
                'land_bank_unit_id'        => $request->land_bank_unit_id ?: null,
                'jenis_spk'                => $request->jenis_spk,
                'nama_pekerjaan'           => $request->nama_pekerjaan,
                'deskripsi_pekerjaan'      => $request->deskripsi_pekerjaan,
                'pihak_pertama_nama'       => $request->pihak_pertama_nama,
                'pihak_pertama_jabatan'    => $request->pihak_pertama_jabatan,
                'pihak_pertama_perusahaan' => $request->pihak_pertama_perusahaan,
                'pihak_pertama_alamat'     => $request->pihak_pertama_alamat,
                'pihak_pertama_telepon'    => $request->pihak_pertama_telepon,
                'kontraktor_nama'          => $request->kontraktor_nama,
                'kontraktor_pic'           => $request->kontraktor_pic,
                'kontraktor_ktp'           => $request->kontraktor_ktp,
                'kontraktor_telepon'       => $request->kontraktor_telepon,
                'kontraktor_alamat'        => $request->kontraktor_alamat,
                'kontraktor_bank'          => $request->kontraktor_bank,
                'kontraktor_rekening'      => $request->kontraktor_rekening,
                'kontraktor_atas_nama'     => $request->kontraktor_atas_nama,
                'tanggal_spk'              => $request->tanggal_spk,
                'tanggal_mulai'            => $request->tanggal_mulai,
                'tanggal_selesai'          => $request->tanggal_selesai,
                'durasi_hari'              => $durasiHari ?: 0,
                'nilai_kontrak'            => $request->nilai_kontrak,
                'sistem_pembayaran'        => $request->sistem_pembayaran,
                'status'                   => $request->status,
                'progress'                 => $request->progress ?: 0,
                'file_lampiran'            => $fileLampiranPath,
                'pasal_syarat_ketentuan'   => $request->pasal_syarat_ketentuan,
                'keterangan'               => $request->keterangan,
            ]);

            // Simpan Rincian Termin jika ada
            if ($request->has('termins') && is_array($request->termins)) {
                foreach ($request->termins as $idx => $tData) {
                    if (empty($tData['nama_tahap'])) continue;

                    $nominalClean = isset($tData['nominal']) ? str_replace(['.', ',', 'Rp', ' '], '', $tData['nominal']) : 0;

                    SpkTermin::create([
                        'spk_id'              => $spk->id,
                        'termin_ke'           => $idx + 1,
                        'nama_tahap'          => $tData['nama_tahap'],
                        'persentase'          => $tData['persentase'] ?? 0,
                        'nominal'             => $nominalClean,
                        'syarat_progress'     => $tData['syarat_progress'] ?? 0,
                        'status_bayar'        => $tData['status_bayar'] ?? 'belum_dibayar',
                        'tanggal_jatuh_tempo' => $tData['tanggal_jatuh_tempo'] ?? null,
                        'keterangan'          => $tData['keterangan'] ?? null,
                    ]);
                }
            }

            // Update Kavling jika SPK Pembangunan Unit Kavling
            if ($request->land_bank_unit_id) {
                LandBankUnit::where('id', $request->land_bank_unit_id)->update([
                    'no_spk'     => $spk->no_spk,
                    'kontraktor' => $spk->kontraktor_nama,
                ]);
            }

            DB::commit();
            return redirect()->route('spk.index')->with('success', "Surat Perintah Kerja (SPK) {$spk->no_spk} berhasil dibuat!");
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error store SPK: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Gagal menyimpan SPK: ' . $e->getMessage());
        }
    }

    /**
     * Tampilkan detail SPK lengkap.
     */
    public function show($id)
    {
        $spk = Spk::with(['landBank', 'unit', 'termins'])->findOrFail($id);
        $companySetting = CompanySetting::first();
        return view('spk.show', compact('spk', 'companySetting'));
    }

    /**
     * Form edit SPK.
     */
    public function edit($id)
    {
        $spk = Spk::with(['landBank', 'unit', 'termins'])->findOrFail($id);
        $landBanks = LandBank::with('units')->orderBy('name', 'asc')->get();
        $companySetting = CompanySetting::first();
        $companyProfile = CompanyProfile::first();

        return view('spk.edit', compact('spk', 'landBanks', 'companySetting', 'companyProfile'));
    }

    /**
     * Update data SPK.
     */
    public function update(Request $request, $id)
    {
        $spk = Spk::findOrFail($id);

        $nilaiKontrakClean = $request->nilai_kontrak ? str_replace(['.', ',', 'Rp', ' '], '', $request->nilai_kontrak) : 0;
        $request->merge(['nilai_kontrak' => $nilaiKontrakClean]);

        $request->validate([
            'no_spk'               => 'required|string|max:100|unique:spks,no_spk,' . $id,
            'land_bank_id'         => 'required|exists:land_banks,id',
            'land_bank_unit_id'    => 'nullable|exists:land_bank_units,id',
            'jenis_spk'            => 'required|string|max:100',
            'nama_pekerjaan'       => 'required|string|max:255',
            'kontraktor_nama'      => 'required|string|max:255',
            'kontraktor_pic'       => 'nullable|string|max:255',
            'kontraktor_ktp'       => 'nullable|string|max:50',
            'kontraktor_telepon'   => 'nullable|string|max:50',
            'tanggal_spk'          => 'required|date',
            'tanggal_mulai'        => 'required|date',
            'tanggal_selesai'      => 'required|date|after_or_equal:tanggal_mulai',
            'durasi_hari'          => 'nullable|integer|min:1',
            'nilai_kontrak'        => 'required|numeric|min:0',
            'sistem_pembayaran'    => 'required|string|in:termin,opname,lumpsum',
            'status'               => 'required|string|in:draft,berjalan,selesai,dibatalkan',
            'file_lampiran'        => 'nullable|file|mimes:pdf,jpg,jpeg,png,docx|max:15360',
        ]);

        DB::beginTransaction();
        try {
            // Upload Lampiran baru jika ada
            if ($request->hasFile('file_lampiran')) {
                $file = $request->file('file_lampiran');
                $filename = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '', $file->getClientOriginalName());
                $file->move(public_path('uploads/spk'), $filename);
                $spk->file_lampiran = 'uploads/spk/' . $filename;
            }

            // Hitung durasi hari
            $durasiHari = $request->durasi_hari;
            if (!$durasiHari && $request->tanggal_mulai && $request->tanggal_selesai) {
                $start = new \DateTime($request->tanggal_mulai);
                $end = new \DateTime($request->tanggal_selesai);
                $durasiHari = $start->diff($end)->days + 1;
            }

            $spk->update([
                'no_spk'                   => $request->no_spk,
                'land_bank_id'             => $request->land_bank_id,
                'land_bank_unit_id'        => $request->land_bank_unit_id ?: null,
                'jenis_spk'                => $request->jenis_spk,
                'nama_pekerjaan'           => $request->nama_pekerjaan,
                'deskripsi_pekerjaan'      => $request->deskripsi_pekerjaan,
                'pihak_pertama_nama'       => $request->pihak_pertama_nama,
                'pihak_pertama_jabatan'    => $request->pihak_pertama_jabatan,
                'pihak_pertama_perusahaan' => $request->pihak_pertama_perusahaan,
                'pihak_pertama_alamat'     => $request->pihak_pertama_alamat,
                'pihak_pertama_telepon'    => $request->pihak_pertama_telepon,
                'kontraktor_nama'          => $request->kontraktor_nama,
                'kontraktor_pic'           => $request->kontraktor_pic,
                'kontraktor_ktp'           => $request->kontraktor_ktp,
                'kontraktor_telepon'       => $request->kontraktor_telepon,
                'kontraktor_alamat'        => $request->kontraktor_alamat,
                'kontraktor_bank'          => $request->kontraktor_bank,
                'kontraktor_rekening'      => $request->kontraktor_rekening,
                'kontraktor_atas_nama'     => $request->kontraktor_atas_nama,
                'tanggal_spk'              => $request->tanggal_spk,
                'tanggal_mulai'            => $request->tanggal_mulai,
                'tanggal_selesai'          => $request->tanggal_selesai,
                'durasi_hari'              => $durasiHari ?: 0,
                'nilai_kontrak'            => $request->nilai_kontrak,
                'sistem_pembayaran'        => $request->sistem_pembayaran,
                'status'                   => $request->status,
                'progress'                 => $request->progress ?: 0,
                'pasal_syarat_ketentuan'   => $request->pasal_syarat_ketentuan,
                'keterangan'               => $request->keterangan,
            ]);

            // Re-sync termin jika disediakan
            if ($request->has('termins') && is_array($request->termins)) {
                $spk->termins()->delete();
                foreach ($request->termins as $idx => $tData) {
                    if (empty($tData['nama_tahap'])) continue;

                    $nominalClean = isset($tData['nominal']) ? str_replace(['.', ',', 'Rp', ' '], '', $tData['nominal']) : 0;

                    SpkTermin::create([
                        'spk_id'              => $spk->id,
                        'termin_ke'           => $idx + 1,
                        'nama_tahap'          => $tData['nama_tahap'],
                        'persentase'          => $tData['persentase'] ?? 0,
                        'nominal'             => $nominalClean,
                        'syarat_progress'     => $tData['syarat_progress'] ?? 0,
                        'status_bayar'        => $tData['status_bayar'] ?? 'belum_dibayar',
                        'tanggal_jatuh_tempo' => $tData['tanggal_jatuh_tempo'] ?? null,
                        'keterangan'          => $tData['keterangan'] ?? null,
                    ]);
                }
            }

            // Update Kavling jika SPK Pembangunan Unit Kavling
            if ($request->land_bank_unit_id) {
                LandBankUnit::where('id', $request->land_bank_unit_id)->update([
                    'no_spk'     => $spk->no_spk,
                    'kontraktor' => $spk->kontraktor_nama,
                ]);
            }

            DB::commit();
            return redirect()->route('spk.index')->with('success', "Data SPK {$spk->no_spk} berhasil diperbarui!");
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error update SPK: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Gagal memperbarui SPK: ' . $e->getMessage());
        }
    }

    /**
     * Hapus data SPK.
     */
    public function destroy($id)
    {
        try {
            $spk = Spk::findOrFail($id);
            $noSpk = $spk->no_spk;
            $spk->delete();

            return response()->json([
                'success' => true,
                'message' => "SPK {$noSpk} berhasil dihapus."
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus SPK: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Halaman Cetak Surat Resmi SPK (Print Ready & PDF friendly).
     */
    public function cetak($id)
    {
        $spk = Spk::with(['landBank', 'unit', 'termins'])->findOrFail($id);
        $companySetting = CompanySetting::first();
        $companyProfile = CompanyProfile::first();

        return view('spk.cetak', compact('spk', 'companySetting', 'companyProfile'));
    }

    /**
     * AJAX endpoint: Mengambil list kavling berdasarkan ID Proyek (Land Bank).
     */
    public function getUnitsByProject($landBankId)
    {
        $units = LandBankUnit::where('land_bank_id', $landBankId)
            ->select('id', 'unit_code', 'block', 'unit_number', 'unit_name', 'type', 'area', 'building_area', 'status')
            ->orderBy('block', 'asc')
            ->orderBy('unit_number', 'asc')
            ->get();

        return response()->json([
            'success' => true,
            'units'   => $units
        ]);
    }

    /**
     * AJAX endpoint: Generate nomor SPK otomatis (seperti invoice).
     * Format: SPK/{JENIS_KODE}/{TAHUN}/{BULAN_ROMAWI}/{URUTAN}
     */
    public function generateNoSpk(Request $request)
    {
        $jenisSpk  = $request->input('jenis_spk', 'Pembangunan Unit');
        $landBankId = $request->input('land_bank_id');

        // Kode prefix berdasarkan jenis pekerjaan
        $jenisKode = match(true) {
            str_contains($jenisSpk, 'Infrastruktur') => 'INFRA',
            str_contains($jenisSpk, 'Fasilitas')     => 'FASUM',
            str_contains($jenisSpk, 'Pematangan')    => 'LAND',
            str_contains($jenisSpk, 'Khusus')        => 'SUBKON',
            str_contains($jenisSpk, 'Unit')          => 'KAV',
            default                                   => 'UMUM',
        };

        // Kode singkat proyek (ambil 3 huruf pertama nama proyek)
        $proyekKode = '';
        if ($landBankId) {
            $landBank = LandBank::find($landBankId);
            if ($landBank) {
                // Ambil inisial dari nama proyek (maks 4 karakter)
                $words = preg_split('/[\s\-]+/', strtoupper($landBank->name));
                $proyekKode = implode('', array_map(fn($w) => substr($w, 0, 1), array_slice($words, 0, 4)));
                $proyekKode = '/' . $proyekKode;
            }
        }

        $romanMonths = [1=>'I',2=>'II',3=>'III',4=>'IV',5=>'V',6=>'VI',7=>'VII',8=>'VIII',9=>'IX',10=>'X',11=>'XI',12=>'XII'];
        $bulan = $romanMonths[(int) date('n')];
        $tahun = date('Y');

        // Hitung urutan: berapa SPK dengan prefix yang sama di tahun ini
        $prefix = "SPK/{$jenisKode}{$proyekKode}/{$tahun}/{$bulan}/";
        $count  = Spk::where('no_spk', 'like', $prefix . '%')
                     ->whereYear('created_at', $tahun)
                     ->count();
        $urutan = str_pad($count + 1, 3, '0', STR_PAD_LEFT);

        $noSpk = $prefix . $urutan;

        return response()->json([
            'success' => true,
            'no_spk'  => $noSpk,
        ]);
    }

    /**
     * Template draft klausul & pasal standar SPK Developer Perumahan.
     */
    private function getDefaultPasalText()
    {
        return <<<HTML
<p><strong>PASAL 1: LINGKUP PEKERJAAN</strong></p>
<ol>
    <li>PIHAK PERTAMA memberikan tugas kepada PIHAK KEDUA dan PIHAK KEDUA menerima tugas tersebut untuk melaksanakan pekerjaan sesuai dengan Rencana Kerja dan Syarat-syarat (RKS), Gambar Kerja, dan Rencana Anggaran Biaya (RAB) yang telah disepakati bersama.</li>
    <li>PIHAK KEDUA wajib menyediakan tenaga kerja ahli, bahan material berkualitas sesuai spesifikasi teknis, serta peralatan kerja yang memadai untuk kelancaran pelaksanaan pekerjaan.</li>
</ol>

<p><strong>PASAL 2: JANGKA WAKTU PELAKSANAAN</strong></p>
<ol>
    <li>Pekerjaan harus dimulai selambat-lambatnya 3 (tiga) hari kalender sejak SPK ini ditandatangani.</li>
    <li>Jangka waktu penyelesaian pekerjaan disepakati dan tidak dapat diubah kecuali ada kesepakatan tertulis dari PIHAK PERTAMA karena faktor keadaan kahar (force majeure).</li>
</ol>

<p><strong>PASAL 3: SISTEM PEMBAYARAN & TERMIN</strong></p>
<ol>
    <li>Pembayaran dilakukan secara bertahap (termin) sesuai dengan pencapaian prestasi fisik pekerjaan di lapangan yang telah diverifikasi dan disetujui oleh Tim Pengawas Lapangan PIHAK PERTAMA (Berita Acara Opname Fisik).</li>
    <li>PIHAK PERTAMA berhak menahan pembayaran apabila kualitas pekerjaan di lapangan belum memenuhi standar spesifikasi teknis yang telah ditentukan.</li>
</ol>

<p><strong>PASAL 4: MASA PEMELIHARAAN (RETENSI)</strong></p>
<ol>
    <li>Masa pemeliharaan ditetapkan selama 90 (sembilan puluh) hari kalender terhitung sejak tanggal Berita Acara Serah Terima Pertama (BAST-1).</li>
    <li>Selama masa pemeliharaan, PIHAK KEDUA wajib memperbaiki setiap kerusakan, kebocoran, atau cacat struktur tanpa membebankan biaya tambahan kepada PIHAK PERTAMA.</li>
    <li>Uang retensi sebesar 5% (lima persen) akan dicairkan setelah berakhirnya masa pemeliharaan dan ditandatanganinya Berita Acara Serah Terima Kedua (BAST-2).</li>
</ol>

<p><strong>PASAL 5: SANKSI & DENDA KETERLAMBATAN</strong></p>
<ol>
    <li>Apabila PIHAK KEDUA mengalami keterlambatan dalam penyelesaian pekerjaan tanpa alasan yang dapat dibenarkan, maka dikenakan denda keterlambatan sebesar 1‰ (satu per mil) per hari dari nilai sisa pekerjaan, maksimal 5% dari total nilai kontrak.</li>
</ol>
HTML;
    }
}
