<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Position; // Pastikan Model Position dipanggil
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $positions = Position::all();
        $menus = Menu::with(['positions', 'parent'])->paginate(10);
        return view('menu.index', compact('menus', 'positions'));
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
    // 1. Validasi input
    $request->validate([
        'menu_id' => 'required|exists:menus,id',
        'position_ids' => 'required|array', // Harus berupa array karena select multiple
        'position_ids.*' => 'exists:positions,id'
    ]);

    // 2. Cari Menu yang sedang diedit
    $menu = Menu::findOrFail($request->menu_id);

    // 3. Simpan hak akses (otomatis insert ke tabel menu_position)
    $menu->positions()->sync($request->position_ids);

    // 4. Kembali ke halaman sebelumnya dengan pesan sukses
    return redirect()->back()->with('success', 'Hak akses posisi untuk menu ' . $menu->name . ' berhasil diperbarui!');
}
}
