<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Promo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class PromoController extends Controller
{
    public function index(Request $request)
    {
        $query = Promo::query();

        // Filter search by name
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('name', 'like', "%{$search}%");
        }

        // Filter by category
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // Filter by type
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Sorting
        $sortField = $request->get('sortField', 'created_at');
        $sortDirection = $request->get('sortDirection', 'desc');

        // Kolom yang valid untuk sorting
        $validSortFields = [
            'name',
            'category',
            'type',
            'value',
            'validity_period',
            'status',
            'start_date',
            'end_date',
            'duration_days',
            'created_at'
        ];

        if (in_array($sortField, $validSortFields)) {
            $query->orderBy($sortField, $sortDirection);
        } else {
            $query->latest(); // Default sorting by created_at desc
        }

        // Jumlah tampil per halaman (10, 15, 25)
        $perPage = $request->input('per_page', 10);

        // Ambil data dengan pagination
        $promo = $query->paginate($perPage)->withQueryString();

        return view('promo.promo', compact('promo'));
    }

    public function store(Request $request)
    {
        Log::info('Request tambah promo masuk', [
            'request' => $request->all()
        ]);

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'validity_period' => 'required|in:selalu,periode',
            'type' => 'required|in:persen,nominal',
            'category' => 'required|in:promo,biaya,fasilitas',
            'status' => 'required|in:aktif,tidak_aktif',
            'value' => 'required|string',
            'start_date' => 'nullable|required_if:validity_period,periode|date',
            'end_date' => 'nullable|required_if:validity_period,periode|date|after_or_equal:start_date',
        ]);

        DB::beginTransaction();

        try {

            $value = $request->value;

            if ($request->type === 'nominal') {
                $value = str_replace('.', '', $value);
            }

            Log::info('Value setelah diproses', [
                'type' => $request->type,
                'value' => $value
            ]);

            $durationDays = null;

            if ($request->validity_period === 'periode') {
                $start = Carbon::parse($request->start_date);
                $end   = Carbon::parse($request->end_date);
                $durationDays = $start->diffInDays($end) + 1;

                Log::info('Hitung durasi promo', [
                    'start_date' => $request->start_date,
                    'end_date' => $request->end_date,
                    'duration_days' => $durationDays
                ]);
            }

            $promo = Promo::create([
                'name' => $request->name,
                'description' => $request->description,
                'validity_period' => $request->validity_period,
                'start_date' => $request->validity_period === 'periode' ? $request->start_date : null,
                'end_date' => $request->validity_period === 'periode' ? $request->end_date : null,
                'duration_days' => $durationDays,
                'type' => $request->type,
                'category' => $request->category,
                'value' => $value,
                'status' => $request->status
            ]);

            DB::commit();

            Log::info('Promo berhasil dibuat', [
                'promo_id' => $promo->id,
                'name' => $promo->name
            ]);

            return redirect()->back()->with('success', 'Promo berhasil ditambahkan');

        } catch (\Exception $e) {

            DB::rollBack();

            Log::error('Gagal menambahkan promo', [
                'error_message' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile()
            ]);

            return redirect()->back()->with('error', 'Terjadi kesalahan saat menambahkan promo');
        }
    }

    public function show($id)
    {
        $promo = Promo::findOrFail($id);
        return response()->json($promo);
    }

    public function edit($id)
    {
        $promo = Promo::findOrFail($id);
        return response()->json($promo);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'validity_period' => 'required|in:selalu,periode',
            'type' => 'required|in:persen,nominal',
            'category' => 'required|in:promo,biaya,fasilitas',
            'status' => 'required|in:aktif,tidak_aktif',
            'value' => 'required|string',
            'start_date' => 'nullable|required_if:validity_period,periode|date',
            'end_date' => 'nullable|required_if:validity_period,periode|date|after_or_equal:start_date',
        ]);

        $promo = Promo::findOrFail($id);

        $value = $request->value;
        if ($request->type === 'nominal') {
            $value = str_replace('.', '', $value);
        }

        $durationDays = null;

        if ($request->validity_period === 'periode') {
            $start = Carbon::parse($request->start_date);
            $end   = Carbon::parse($request->end_date);
            $durationDays = $start->diffInDays($end) + 1;
        }

        $promo->update([
            'name' => $request->name,
            'description' => $request->description,
            'validity_period' => $request->validity_period,
            'start_date' => $request->validity_period === 'periode' ? $request->start_date : null,
            'end_date' => $request->validity_period === 'periode' ? $request->end_date : null,
            'duration_days' => $durationDays,
            'type' => $request->type,
            'category' => $request->category,
            'value' => $value,
            'status' => $request->status
        ]);

        return redirect()->back()->with('success', 'Promo berhasil diperbarui');
    }

    public function destroy($id)
    {
        try {
            $promo = Promo::findOrFail($id);
            $promo->delete();

            return redirect()
                ->route('promo.index')
                ->with('success', 'Promo berhasil dihapus');

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Gagal menghapus promo: ' . $e->getMessage());
        }
    }

    public function getPromo($id)
    {
        try {
            $promo = Promo::findOrFail($id);

            if ($promo->type === 'nominal') {
                $promo->value_formatted = number_format($promo->value, 0, ',', '.');
            } else {
                $promo->value_formatted = $promo->value;
            }

            return response()->json([
                'success' => true,
                'data' => $promo
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data promo tidak ditemukan'
            ], 404);
        }
    }
}
