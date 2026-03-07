<?php

namespace App\Http\Controllers;

use App\Models\Division;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class DivisionController extends Controller
{
    public function index()
    {
        $division = Division::paginate(5);
        return view('master_data.devisi', compact('division'));
    }

    // Simpan data baru
   public function store(Request $request)
{
    try {

        // Validasi
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Simpan data
        Division::create([
            'name' => $request->name,
        ]);

        return redirect()->back()->with('success', 'Division berhasil ditambahkan!');

    } catch (\Throwable $e) {

        // Simpan error ke log
        Log::error('Gagal menambahkan division', [
            'user_id' => auth()->id(),
            'request' => $request->all(),
            'error_message' => $e->getMessage(),
            'trace' => $e->getTraceAsString()
        ]);

        return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data');
    }
}
public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required'
    ]);

    $division = Division::findOrFail($id);

    $division->update([
        'name'=>$request->name
    ]);

    return back()->with('success','Division berhasil diupdate');
}
public function destroy($id)
{
    $division = Division::findOrFail($id);

    // cek apakah masih ada karyawan
    if ($division->employees()->count() > 0) {
        return redirect()->back()->with('error', 'Divisi tidak bisa dihapus karena masih memiliki karyawan.');
    }

    $division->delete();

    return redirect()->back()->with('success', 'Divisi berhasil dihapus.');
}
}