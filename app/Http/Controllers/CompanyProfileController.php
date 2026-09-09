<?php

namespace App\Http\Controllers;

use App\Models\CompanyProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CompanyProfileController extends Controller
{
    public function index(Request $request)
    {
        $query = CompanyProfile::query();

        // Search filter
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('name', 'like', "%{$search}%");
        }

        // Sorting
        $sortField = $request->get('sortField', 'created_at');
        $sortDirection = $request->get('sortDirection', 'desc');

        // Kolom yang valid untuk sorting
        $validSortFields = ['name', 'address', 'phone', 'land_banks_count', 'created_at'];

        if (in_array($sortField, $validSortFields)) {
            if ($sortField == 'land_banks_count') {
                // Jika sorting berdasarkan jumlah land bank
                $query->withCount('landBanks')->orderBy('land_banks_count', $sortDirection);
            } else {
                $query->orderBy($sortField, $sortDirection);
            }
        } else {
            $query->latest(); // Default sorting by created_at desc
        }

        // Jumlah tampil per halaman
        $perPage = $request->input('per_page', 10);

        // Ambil data dengan pagination
        $companies = $query->withCount('landBanks')
                          ->paginate($perPage)
                          ->withQueryString();

        return view('pt.pt', compact('companies'));
    }

    public function edit(CompanyProfile $companyProfile)
    {
        return response()->json($companyProfile);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string|max:500',
            'phone' => 'nullable|string|max:20',
            'file_akta_pendirian' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240',
            'file_akta_perubahan' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240',
            'file_npwp'           => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240',
            'file_direksi'        => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240',
            'file_nib'            => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240',
            'file_domisili'       => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240',
        ], [
            'name.required' => 'Nama PT wajib diisi!',
        ]);

        DB::beginTransaction();

        try {
            $data = [
                'name' => $request->name,
                'address' => $request->address,
                'phone' => $request->phone,
            ];

            $fileFields = [
                'file_akta_pendirian',
                'file_akta_perubahan',
                'file_npwp',
                'file_direksi',
                'file_nib',
                'file_domisili',
            ];

            $destination = public_path('uploads/legalitas_pt');
            if (!file_exists($destination)) {
                mkdir($destination, 0777, true);
            }

            foreach ($fileFields as $field) {
                if ($request->hasFile($field)) {
                    $file = $request->file($field);
                    $filename = $field . '_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                    $file->move($destination, $filename);
                    $data[$field] = 'uploads/legalitas_pt/' . $filename;
                }
            }

            CompanyProfile::create($data);

            DB::commit();

            return redirect()
                ->route('company-profile.index')
                ->with('success', 'Company profile dan berkas legalitas PT berhasil ditambahkan.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function update(Request $request, CompanyProfile $companyProfile)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string|max:500',
            'phone' => 'nullable|string|max:20',
            'file_akta_pendirian' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240',
            'file_akta_perubahan' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240',
            'file_npwp'           => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240',
            'file_direksi'        => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240',
            'file_nib'            => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240',
            'file_domisili'       => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240',
        ], [
            'name.required' => 'Nama PT wajib diisi!',
        ]);

        $data = $request->only(['name', 'address', 'phone']);

        $fileFields = [
            'file_akta_pendirian',
            'file_akta_perubahan',
            'file_npwp',
            'file_direksi',
            'file_nib',
            'file_domisili',
        ];

        $destination = public_path('uploads/legalitas_pt');
        if (!file_exists($destination)) {
            mkdir($destination, 0777, true);
        }

        foreach ($fileFields as $field) {
            if ($request->hasFile($field)) {
                // Remove old file if exists
                if (!empty($companyProfile->$field) && file_exists(public_path($companyProfile->$field))) {
                    @unlink(public_path($companyProfile->$field));
                }
                $file = $request->file($field);
                $filename = $field . '_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move($destination, $filename);
                $data[$field] = 'uploads/legalitas_pt/' . $filename;
            }
        }

        $companyProfile->update($data);

        return redirect()
            ->route('company-profile.index')
            ->with('success', 'Company profile dan berkas legalitas PT berhasil diperbarui.');
    }

    public function destroy(CompanyProfile $companyProfile)
    {
        $fileFields = [
            'file_akta_pendirian',
            'file_akta_perubahan',
            'file_npwp',
            'file_direksi',
            'file_nib',
            'file_domisili',
        ];

        foreach ($fileFields as $field) {
            if (!empty($companyProfile->$field) && file_exists(public_path($companyProfile->$field))) {
                @unlink(public_path($companyProfile->$field));
            }
        }

        CompanyProfile::destroy($companyProfile->id);

        return redirect()
            ->route('company-profile.index')
            ->with('success', 'Company profile berhasil dihapus.');
    }

    public function getProjects($id)
    {
        $company = CompanyProfile::with([
            'landBanks.units'
        ])->findOrFail($id);

        return response()->json($company);
    }
}
