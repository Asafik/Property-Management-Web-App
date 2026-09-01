<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KprApplication;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class SurveyController extends Controller
{
    public function index(Request $request)
{
    $perPage = $request->input('per_page', 10);
    $sort = $request->input('sort', 'latest');

    if (!in_array($perPage, [10, 15, 25])) {
        $perPage = 10;
    }

    $query = KprApplication::with(['customer', 'unit', 'bank'])
        ->select('kpr_applications.*')

       
        ->whereHas('unit', function ($q) {
            $q->where('jenis', 'subsidi');
        })

        ->when($request->filled('search'), function ($q) use ($request) {
            $q->whereHas('customer', function ($qc) use ($request) {
                $qc->where('full_name', 'like', '%' . $request->search . '%');
            });
        })

        ->when($request->filled('status'), function ($q) use ($request) {
            $q->where('kpr_applications.status', $request->status);
        });

    switch ($sort) {
        case 'name_asc':
            $query->join('customers', 'kpr_applications.customer_id', '=', 'customers.id')
                  ->orderBy('customers.full_name', 'asc');
            break;

        case 'name_desc':
            $query->join('customers', 'kpr_applications.customer_id', '=', 'customers.id')
                  ->orderBy('customers.full_name', 'desc');
            break;

        case 'unit_asc':
            $query->join('land_bank_units', 'kpr_applications.unit_id', '=', 'land_bank_units.id')
                  ->orderBy('land_bank_units.unit_name', 'asc');
            break;

        case 'unit_desc':
            $query->join('land_bank_units', 'kpr_applications.unit_id', '=', 'land_bank_units.id')
                  ->orderBy('land_bank_units.unit_name', 'desc');
            break;

        case 'latest':
        default:
            $query->latest('kpr_applications.created_at');
            break;
    }

    $kprApplications = $query->paginate($perPage)->withQueryString();

    return view('transaksi.customer-kpr-acc', compact('kprApplications'));
}

    public function store(Request $request, $kprId)
    {
        DB::beginTransaction();

        try {
            $kpr = KprApplication::findOrFail($kprId);

            // Bersihkan input angka rupiah/format
            $cleanNumeric = function ($val) {
                if (is_null($val) || $val === '') return null;
                $cleaned = preg_replace('/[^0-9]/', '', (string)$val);
                return $cleaned === '' ? null : (float)$cleaned;
            };

            $appraisalValue = $cleanNumeric($request->appraisal_value);
            $luasTanah = $cleanNumeric($request->luas_tanah);
            $luasBangunan = $cleanNumeric($request->luas_bangunan);
            $persentaseKelayakan = $request->filled('persentase_kelayakan') 
                ? (float)preg_replace('/[^0-9.]/', '', (string)$request->persentase_kelayakan) 
                : null;

            // Validasi file upload jika ada
            $request->validate([
                'foto_depan'      => 'nullable|file|mimes:jpg,jpeg,png|max:5120',
                'foto_interior'   => 'nullable|file|mimes:jpg,jpeg,png|max:5120',
                'foto_lingkungan' => 'nullable|file|mimes:jpg,jpeg,png|max:5120',
                'surveyor_id'     => 'nullable|exists:employees,id'
            ]);

            // Update data survey
            if ($appraisalValue !== null) {
                $kpr->appraisal_value = $appraisalValue;
            }
            if ($luasTanah !== null) {
                $kpr->luas_tanah = $luasTanah;
            }
            if ($luasBangunan !== null) {
                $kpr->luas_bangunan = $luasBangunan;
            }
            if ($request->filled('kondisi_bangunan')) {
                $kpr->kondisi_bangunan = $request->kondisi_bangunan;
            }

            $kpr->listrik = $request->has('listrik') ? 1 : 0;
            $kpr->air = $request->has('air') ? 1 : 0;
            $kpr->akses = $request->has('akses') ? 1 : 0;
            $kpr->sertifikat = $request->has('sertifikat') ? 1 : 0;
            $kpr->shm = $request->has('shm') ? 1 : 0;
            $kpr->imb = $request->has('imb') ? 1 : 0;
            
            if ($request->filled('catatan_survey')) {
                $kpr->catatan_survey = $request->catatan_survey;
            }
            if ($request->filled('rekomendasi')) {
                $kpr->rekomendasi = $request->rekomendasi;
            }
            if ($persentaseKelayakan !== null) {
                $kpr->persentase_kelayakan = $persentaseKelayakan;
            }
            if ($request->filled('surveyor_id')) {
                $kpr->surveyor_id = $request->surveyor_id;
            }
            $kpr->status = 'survey';

            // Upload foto jika ada
            $destination = public_path('uploads/kpr/survey');
            if (!file_exists($destination)) {
                mkdir($destination, 0755, true);
            }

            foreach (['foto_depan', 'foto_interior', 'foto_lingkungan'] as $fileField) {
                if ($request->hasFile($fileField)) {
                    $file = $request->file($fileField);
                    $filename = uniqid() . '_' . $fileField . '.' . $file->getClientOriginalExtension();
                    $file->move($destination, $filename);
                    $kpr->$fileField = 'kpr/survey/' . $filename;
                }
            }

            $kpr->save();

            DB::commit();

            return redirect()->back()->with('success', 'Hasil survey dan nilai appraisal berhasil disimpan!');
        } catch (\Throwable $e) {
            DB::rollBack();

            Log::error('Gagal menyimpan survey KPR', [
                'kpr_id' => $kprId,
                'error_message' => $e->getMessage()
            ]);

            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal menyimpan survey: ' . $e->getMessage());
        }
    }
}
