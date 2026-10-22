<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Position; // Pastikan Model Position dipanggil
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        $positions = Position::orderBy('name')->get();
        $parentMenus = Menu::whereNull('parent_id')->orderBy('name')->get();
        $query = Menu::with(['positions', 'parent']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('route', 'like', "%{$search}%");
            });
        }

        if ($request->filled('parent_id')) {
            if ($request->parent_id === 'main') {
                $query->whereNull('parent_id');
            } else {
                $query->where('parent_id', $request->parent_id);
            }
        }

        if ($request->filled('position_id')) {
            $query->whereHas('positions', function ($q) use ($request) {
                $q->where('positions.id', $request->position_id);
            });
        }

        // Metrics KPI untuk Card Dashboard persis Catalog Unit
        $totalMenus = Menu::count();
        $totalParentMenus = Menu::whereNull('parent_id')->count();
        $totalSubMenus = Menu::whereNotNull('parent_id')->count();
        $totalPositions = Position::count();

        $perPage = $request->input('per_page', 10);
        $menus = $query->paginate($perPage)->withQueryString();

        return view('menu.index', compact(
            'menus', 
            'positions', 
            'parentMenus',
            'totalMenus', 
            'totalParentMenus', 
            'totalSubMenus', 
            'totalPositions'
        ));
    }

    // Fungsi untuk memproses data dari form hak akses
    public function updatePermissions(Request $request, $position_id)
    {
        // 1. Validasi data (memastikan menu_id yang dikirim berbentuk array)
        // Boleh kosong/null jika user mencabut semua hak akses (tidak ada yang dicentang)
        $request->validate([
            'menu_id' => 'nullable|array'
        ]);

        // 2. Cari data Posisi berdasarkan ID
        $position = Position::findOrFail($position_id);

        // 3. MAGIC LARAVEL: Gunakan sync() untuk memperbarui tabel pivot (menu_position)
        // Jika menu_id kosong (tidak ada yang dicentang), sync([]) akan menghapus semua aksesnya.
        $position->menus()->sync($request->menu_id ?? []);

        // 4. Kembalikan ke halaman sebelumnya dengan pesan sukses
        return redirect()->back()->with('success', 'Hak akses untuk posisi ' . $position->name . ' berhasil diperbarui!');
    }

    public function storePositions(Request $request)
    {
        // 1. Validasi input (nullable agar jika semua posisi dicabut tidak error)
        $request->validate([
            'menu_id' => 'required|exists:menus,id',
            'position_ids' => 'nullable|array',
            'position_ids.*' => 'exists:positions,id'
        ]);

        // 2. Cari Menu yang sedang diedit
        $menu = Menu::findOrFail($request->menu_id);

        // 3. Simpan hak akses (otomatis insert/delete ke tabel menu_position)
        $menu->positions()->sync($request->position_ids ?? []);

        // 4. Jika menu ini adalah sub-menu (memiliki parent), pastikan parent_id juga diberikan akses ke posisi-posisi ini
        if ($menu->parent_id) {
            $parentMenu = Menu::find($menu->parent_id);
            if ($parentMenu) {
                $parentMenu->positions()->syncWithoutDetaching($request->position_ids);
            }
        }

        // 5. Kembali ke halaman sebelumnya dengan pesan sukses
        return redirect()->back()->with('success', 'Hak akses posisi untuk menu ' . $menu->name . ' berhasil diperbarui!');
    }
}
