<?php

namespace App\Http\Controllers;

use App\Models\CompanyProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CompanyProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = CompanyProfile::query();

        // Filter search by name
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('name', 'like', "%{$search}%");
        }

        // Jumlah tampil per halaman (default 10, opsi: 10, 15, 25)
        $perPage = $request->input('per_page', 10);

        // Ambil data dengan pagination dan eager loading landBanks count
        $companies = $query->withCount('landBanks')
                          ->latest()
                          ->paginate($perPage)
                          ->withQueryString();

        return view('pt.pt', compact('companies'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string|max:500',
            'phone' => 'nullable|string|max:20',
        ], [
            'name.required' => 'Nama PT wajib diisi!',
        ]);

        DB::beginTransaction();

        try {

            CompanyProfile::create([
                'name' => $request->name,
                'address' => $request->address,
                'phone' => $request->phone,
            ]);

            DB::commit();

            return redirect()
                ->route('company-profile.index')
                ->with('success', 'Company profile berhasil ditambahkan.');

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CompanyProfile $companyProfile)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string|max:500',
            'phone' => 'nullable|string|max:20',
        ], [
            'name.required' => 'Nama PT wajib diisi!',
        ]);

        $companyProfile->update($request->only(['name', 'address', 'phone']));

        return redirect()
            ->route('company-profile.index')
            ->with('success', 'Company profile berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CompanyProfile $companyProfile)
    {
        CompanyProfile::destroy($companyProfile->id);

        return redirect()
            ->route('company-profile.index')
            ->with('success', 'Company profile berhasil dihapus.');
    }

    public function getProjects($id)
    {
        $company = CompanyProfile::with([
            'landBanks.units' // pastikan relasi units ada
        ])->findOrFail($id);

        return response()->json($company);
    }
}
