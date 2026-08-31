<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InfrastructureMaterial;
use Illuminate\Http\Request;

class InfrastructureMaterialController extends Controller
{
    /**
     * Display listing of master infrastructure materials
     */
    public function index(Request $request)
    {
        // Ensure defaults exist
        if (InfrastructureMaterial::count() === 0) {
            InfrastructureMaterial::seedDefaultMaterials();
        }

        $query = InfrastructureMaterial::query();

        if ($request->filled('search')) {
            $search = trim($request->search);
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('code', 'like', "%{$search}%")
                  ->orWhere('specification', 'like', "%{$search}%");
            });
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        if ($request->filled('status')) {
            $query->where('is_active', (bool)$request->status);
        }

        $sortField = $request->get('sortField', 'name');
        $sortDirection = $request->get('sortDirection', 'asc');
        $allowedSortFields = ['code', 'name', 'category', 'unit', 'default_price', 'is_active', 'created_at'];

        if (in_array($sortField, $allowedSortFields)) {
            $query->orderBy($sortField, $sortDirection === 'desc' ? 'desc' : 'asc');
        } else {
            $query->orderBy('category')->orderBy('name');
        }

        $perPage = (int)$request->get('per_page', 10);
        if (!in_array($perPage, [10, 15, 25, 50])) {
            $perPage = 10;
        }

        $categories = InfrastructureMaterial::select('category')->distinct()->pluck('category');
        $materials = $query->paginate($perPage)->withQueryString();

        return view('master_data.bahan_infrastruktur.index', compact('materials', 'categories'));
    }

    /**
     * API search for autocomplete dropdown in Pengolahan Lahan
     */
    public function searchApi(Request $request)
    {
        $search = trim($request->get('q', ''));
        $category = $request->get('category');

        $query = InfrastructureMaterial::where('is_active', true);

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('code', 'like', "%{$search}%");
            });
        }

        if ($category) {
            $query->where('category', $category);
        }

        $items = $query->orderBy('name')->limit(30)->get();

        return response()->json([
            'success' => true,
            'data' => $items
        ]);
    }

    /**
     * Get material data for edit modal
     */
    public function edit($id)
    {
        $material = InfrastructureMaterial::findOrFail($id);
        return response()->json($material);
    }

    /**
     * Store a new master material
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'          => 'required|string|max:255',
            'category'      => 'required|string|max:100',
            'unit'          => 'required|string|max:50',
            'default_price' => 'nullable|numeric|min:0',
            'specification' => 'nullable|string',
            'code'          => 'nullable|string|max:50|unique:infrastructure_materials,code',
        ]);

        if (empty($validated['code'])) {
            $prefix = strtoupper(substr(preg_replace('/[^a-zA-Z]/', '', $validated['category'] ?? 'MAT'), 0, 3));
            $count = InfrastructureMaterial::count() + 1;
            $validated['code'] = 'MAT-' . ($prefix ?: 'GEN') . '-' . str_pad($count, 3, '0', STR_PAD_LEFT);
        }

        $material = InfrastructureMaterial::create($validated);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Master bahan baru berhasil ditambahkan.',
                'material' => $material
            ]);
        }

        return redirect()->back()->with('success', 'Master bahan baru berhasil ditambahkan.');
    }

    /**
     * Update master material
     */
    public function update(Request $request, $id)
    {
        $material = InfrastructureMaterial::findOrFail($id);

        $validated = $request->validate([
            'name'          => 'required|string|max:255',
            'category'      => 'required|string|max:100',
            'unit'          => 'required|string|max:50',
            'default_price' => 'nullable|numeric|min:0',
            'specification' => 'nullable|string',
            'code'          => 'nullable|string|max:50|unique:infrastructure_materials,code,' . $material->id,
            'is_active'     => 'nullable|boolean',
        ]);

        $validated['is_active'] = $request->has('is_active') ? (bool)$request->is_active : true;

        $material->update($validated);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Master bahan berhasil diperbarui.',
                'material' => $material
            ]);
        }

        return redirect()->back()->with('success', 'Master bahan berhasil diperbarui.');
    }

    /**
     * Delete master material
     */
    public function destroy(Request $request, $id)
    {
        $material = InfrastructureMaterial::findOrFail($id);
        $material->delete();

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Master bahan berhasil dihapus.'
            ]);
        }

        return redirect()->back()->with('success', 'Master bahan berhasil dihapus.');
    }
}
