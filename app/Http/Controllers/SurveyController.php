<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KprApplication;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class SurveyController extends Controller
{
    public function index()
    {
        // Ambil data KPR yang statusnya 'survey'
        $kprApplications = KprApplication::with(['customer', 'unit', 'bank'])
            ->where('status', 'survey')
            ->get();

        return view('transaksi.customer-kpr-acc', compact('kprApplications'));
    }

    public function store(Request $request, $kprId)
    {
        DB::beginTransaction();

        try {

            $request->merge([
                // Bersihkan angka
                'appraisal_value'      => preg_replace('/[^0-9]/', '', $request->appraisal_value),
                'luas_tanah'           => preg_replace('/[^0-9]/', '', $request->luas_tanah),
                'luas_bangunan'        => preg_replace('/[^0-9]/', '', $request->luas_bangunan),
                'persentase_kelayakan' => preg_replace('/[^0-9.]/', '', $request->persentase_kelayakan),

                // Normalisasi checkbox
                'listrik'    => $request->has('listrik') ? 1 : 0,
                'air'        => $request->has('air') ? 1 : 0,
                'akses'      => $request->has('akses') ? 1 : 0,
                'sertifikat' => $request->has('sertifikat') ? 1 : 0,
                'shm'        => $request->has('shm') ? 1 : 0,
                'imb'        => $request->has('imb') ? 1 : 0,
            ]);

            $kpr = KprApplication::findOrFail($kprId);

            // ✅ Validasi input survey
            $request->validate([
                'appraisal_value' => 'nullable|numeric',
                'luas_tanah' => 'nullable|numeric',
                'luas_bangunan' => 'nullable|numeric',
                'kondisi_bangunan' => 'nullable|string',
                'listrik' => 'nullable|boolean',
                'air' => 'nullable|boolean',
                'akses' => 'nullable|boolean',
                'sertifikat' => 'nullable|boolean',
                'shm' => 'nullable|boolean',
                'imb' => 'nullable|boolean',
                'catatan_survey' => 'nullable|string',
                'rekomendasi' => 'nullable|string',
                'persentase_kelayakan' => 'nullable|numeric',
                'foto_depan' => 'nullable|file|mimes:jpg,jpeg,png|max:5120',
                'foto_interior' => 'nullable|file|mimes:jpg,jpeg,png|max:5120',
                'foto_lingkungan' => 'nullable|file|mimes:jpg,jpeg,png|max:5120',
                'surveyor_id' => 'nullable|exists:employees,id'
            ]);

            // Update data survey
            $kpr->appraisal_value = $request->appraisal_value;
            $kpr->luas_tanah = $request->luas_tanah;
            $kpr->luas_bangunan = $request->luas_bangunan;
            $kpr->kondisi_bangunan = $request->kondisi_bangunan;
            $kpr->listrik = $request->boolean('listrik');
            $kpr->air = $request->boolean('air');
            $kpr->akses = $request->boolean('akses');
            $kpr->sertifikat = $request->boolean('sertifikat');
            $kpr->shm = $request->boolean('shm');
            $kpr->imb = $request->boolean('imb');
            $kpr->catatan_survey = $request->catatan_survey;
            $kpr->rekomendasi = $request->rekomendasi;
            $kpr->persentase_kelayakan = $request->persentase_kelayakan;
            $kpr->surveyor_id = $request->surveyor_id;

            // Upload foto jika ada
            foreach (['foto_depan', 'foto_interior', 'foto_lingkungan'] as $fileField) {
                if ($request->hasFile($fileField)) {
                    $path = $request->file($fileField)->store('kpr/survey', 'public');
                    $kpr->$fileField = $path;
                }
            }

            // Update status survey selesai
            $kpr->status = 'survey';
            $kpr->save();

            DB::commit();

            return redirect()->back()->with('success', 'Hasil survey berhasil disimpan!');
        } catch (\Throwable $e) {

            DB::rollBack();

            Log::error('Gagal menyimpan survey KPR', [
                'kpr_id' => $kprId,
                'user_id' => auth()->id(),
                'error_message' => $e->getMessage()
            ]);

            return redirect()->back()
                ->withInput()
                ->with('error', $e->getMessage()); // 🔥 sementara tampilkan error asli
        }
    }
}
