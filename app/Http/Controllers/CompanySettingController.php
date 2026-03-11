<?php

namespace App\Http\Controllers;

use App\Models\CompanySetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CompanySettingController extends Controller
{
    public function index()
    {
        $company = CompanySetting::first();
        return view('setting.setting', compact('company'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'company_name' => 'nullable|string|max:255',
            'npwp' => 'nullable|string|max:50',
            'address' => 'nullable|string',
            'city' => 'nullable|string|max:100',
            'province' => 'nullable|string|max:100',
            'postal_code' => 'nullable|string|max:20',
            'phone' => 'nullable|string|max:30',
            'whatsapp' => 'nullable|string|max:30',
            'email' => 'nullable|email|max:100',
            'website' => 'nullable|string|max:100',
            'founded_date' => 'nullable|date', // validasi date
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:5120',
            'favicon' => 'nullable|mimes:ico,png|max:5120',
        ]);

        // Pastikan founded_date dalam format YYYY-MM-DD
        if ($request->filled('founded_date')) {
            $validated['founded_date'] = date('Y-m-d', strtotime($request->founded_date));
        }

        $company = CompanySetting::first();

        if (!$company) {
            $company = new CompanySetting();
        }

        if ($request->hasFile('logo')) {
            if ($company->logo) {
                Storage::disk('public')->delete($company->logo);
            }
            $validated['logo'] = $request->file('logo')->store('company_setting', 'public');
        }

        if ($request->hasFile('favicon')) {
            if ($company->favicon) {
                Storage::disk('public')->delete($company->favicon);
            }
            $validated['favicon'] = $request->file('favicon')->store('company_setting', 'public');
        }

        $company->fill($validated);
        $company->save();

        return redirect()->back()->with('success', 'Pengaturan perusahaan berhasil disimpan.');
    }
}
