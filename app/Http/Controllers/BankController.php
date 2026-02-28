<?php

namespace App\Http\Controllers;

use App\Models\Banks;
use Illuminate\Http\Request;

class BankController extends Controller
{
    public function index()
    {
        $banks = Banks::all();
        return view('bank.data_bank', compact('banks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'bank_name' => 'required|string|max:255',
            'account_holder' => 'required|string|max:255',
            'number' => 'required|string|max:50',
            'is_active' => 'required|boolean',
        ]);

        Banks::create([
            'bank_name' => $request->bank_name,
            'account_holder' => $request->account_holder,
            'number' => $request->number,
            'is_active' => $request->is_active,
        ]);

        return redirect()->route('bank.index')->with('success', 'Data bank berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $bank = Banks::findOrFail($id);
        return response()->json($bank);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'bank_name' => 'required|string|max:255',
            'account_holder' => 'required|string|max:255',
            'number' => 'required|string|max:50',
            'is_active' => 'required|boolean',
        ]);

        $bank = Banks::findOrFail($id);

        $bank->update([
            'bank_name' => $request->bank_name,
            'account_holder' => $request->account_holder,
            'number' => $request->number,
            'is_active' => $request->is_active,
        ]);

        return redirect()->route('bank.index')->with('success', 'Data bank berhasil diperbarui.');
    }

   
        public function destroy($id)
        {
            try {
                $bank = Banks::findOrFail($id);
                $bank->delete();

                return redirect()->route('bank.index')->with('success', 'Data bank berhasil dihapus.');
            } catch (\Exception $e) {
                return redirect()->route('bank.index')->with('error', 'Gagal menghapus data bank: ' . $e->getMessage());
            }
        }
}
