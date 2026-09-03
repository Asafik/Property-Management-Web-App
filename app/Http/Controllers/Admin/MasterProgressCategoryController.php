<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MasterProgressCategory;
use App\Models\MasterProgressItem;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MasterProgressCategoryController extends Controller
{
    public function index()
    {
        $categories = MasterProgressCategory::with('items')
            ->orderBy('urutan', 'asc')
            ->get();

        $totalCategories = $categories->count();
        $totalItems = $categories->sum(fn($c) => $c->items->count());
        $totalEstimasi = $categories->sum(function ($c) {
            return $c->items->sum(fn($i) => $i->default_volume * $i->default_harga_satuan);
        });

        return view('master_data.progress_kategori.index', compact('categories', 'totalCategories', 'totalItems', 'totalEstimasi'));
    }

    public function storeCategory(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'prefix'        => 'nullable|string|max:10',
            'icon'          => 'nullable|string|max:50',
            'urutan'        => 'nullable|integer',
        ]);

        $slug = Str::slug($request->nama_kategori, '_');
        if (empty($slug)) {
            $slug = 'kat_' . time();
        }

        // Cek jika slug sudah ada, beri suffix unik
        if (MasterProgressCategory::where('slug', $slug)->exists()) {
            $slug .= '_' . rand(10, 99);
        }

        $urutan = $request->urutan ?? (MasterProgressCategory::max('urutan') + 1);

        MasterProgressCategory::create([
            'nama_kategori' => $request->nama_kategori,
            'slug'          => $slug,
            'prefix'        => $request->prefix ?? (string)$urutan,
            'icon'          => $request->icon ?? 'folder-outline',
            'urutan'        => $urutan,
            'is_active'     => true,
        ]);

        return redirect()->back()->with('success', 'Kategori / Tahapan Progress Pembangunan berhasil ditambahkan!');
    }

    public function updateCategory(Request $request, $id)
    {
        $category = MasterProgressCategory::findOrFail($id);

        $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'prefix'        => 'nullable|string|max:10',
            'icon'          => 'nullable|string|max:50',
            'urutan'        => 'nullable|integer',
            'is_active'     => 'nullable|boolean',
        ]);

        $category->update([
            'nama_kategori' => $request->nama_kategori,
            'prefix'        => $request->prefix ?? $category->prefix,
            'icon'          => $request->icon ?? $category->icon,
            'urutan'        => $request->urutan ?? $category->urutan,
            'is_active'     => $request->has('is_active') ? (bool)$request->is_active : $category->is_active,
        ]);

        return redirect()->back()->with('success', 'Kategori Progress berhasil diperbarui!');
    }

    public function destroyCategory($id)
    {
        $category = MasterProgressCategory::findOrFail($id);
        $category->delete();

        return redirect()->back()->with('success', 'Kategori beserta rincian itemnya berhasil dihapus!');
    }

    public function storeItem(Request $request, $categoryId)
    {
        $category = MasterProgressCategory::findOrFail($categoryId);

        $request->validate([
            'uraian'               => 'required|string|max:255',
            'kode'                 => 'nullable|string|max:20',
            'default_volume'       => 'nullable|numeric',
            'satuan'               => 'required|string|max:20',
            'default_harga_satuan' => 'required|numeric',
            'keterangan'           => 'nullable|string|max:255',
        ]);

        $urutan = $category->items()->count() + 1;
        $kode = $request->kode ?: ($category->prefix . '.' . $urutan);

        MasterProgressItem::create([
            'master_progress_category_id' => $category->id,
            'kode'                        => $kode,
            'uraian'                      => $request->uraian,
            'default_volume'              => $request->default_volume ?? 1,
            'satuan'                      => $request->satuan,
            'default_harga_satuan'        => $request->default_harga_satuan,
            'keterangan'                  => $request->keterangan,
            'urutan'                      => $urutan,
        ]);

        return redirect()->back()->with('success', 'Item pekerjaan berhasil ditambahkan ke ' . $category->nama_kategori);
    }

    public function updateItem(Request $request, $itemId)
    {
        $item = MasterProgressItem::findOrFail($itemId);

        $request->validate([
            'uraian'               => 'required|string|max:255',
            'kode'                 => 'nullable|string|max:20',
            'default_volume'       => 'nullable|numeric',
            'satuan'               => 'required|string|max:20',
            'default_harga_satuan' => 'required|numeric',
            'keterangan'           => 'nullable|string|max:255',
        ]);

        $item->update([
            'kode'                 => $request->kode ?? $item->kode,
            'uraian'               => $request->uraian,
            'default_volume'       => $request->default_volume ?? 1,
            'satuan'               => $request->satuan,
            'default_harga_satuan' => $request->default_harga_satuan,
            'keterangan'           => $request->keterangan,
        ]);

        return redirect()->back()->with('success', 'Item pekerjaan berhasil diperbarui!');
    }

    public function destroyItem($itemId)
    {
        $item = MasterProgressItem::findOrFail($itemId);
        $item->delete();

        return redirect()->back()->with('success', 'Item pekerjaan berhasil dihapus!');
    }
}
