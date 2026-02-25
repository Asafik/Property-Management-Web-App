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
public function index()
{
    $companies = CompanyProfile::withCount('landBanks')->get();

    return view('pt.pt', compact('companies'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */

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
     * Display the specified resource.
     */
    public function show(CompanyProfile $companyProfile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CompanyProfile $companyProfile)
    {
        //
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
            
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CompanyProfile $companyProfile)
    {
        //
        CompanyProfile::destroy($companyProfile->id);
        return redirect()
            ->route('company-profile.index')
            ->with('success', 'Company profile berhasil dihapus.');

    }
}
