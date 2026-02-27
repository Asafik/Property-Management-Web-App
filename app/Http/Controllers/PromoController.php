<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Promo;
use Carbon\Carbon;

class PromoController extends Controller
{
    //
    public function index()
    {

        $promo = Promo::all();
        return view('promo.promo', compact('promo'));
    }
    public function store(Request $request)
{
    $request->validate([
        'name' => 'required',
        'description' => 'required',
        'validity_period' => 'required|in:selalu,periode',
        'type' => 'required',
        'category' => 'required',
        'status' => 'required',
        'value' => 'required',
        'start_date' => 'nullable|required_if:validity_period,periode|date',
        'end_date' => 'nullable|required_if:validity_period,periode|date|after_or_equal:start_date',
    ]);

    $durationDays = null;

    if ($request->validity_period === 'periode') {

        $start = Carbon::parse($request->start_date);
        $end   = Carbon::parse($request->end_date);

        // +1 supaya tanggal mulai ikut dihitung
        $durationDays = $start->diffInDays($end) + 1;
    }

    Promo::create([
        'name' => $request->name,
        'description' => $request->description,
        'validity_period' => $request->validity_period,
        'start_date' => $request->validity_period === 'periode' ? $request->start_date : null,
        'end_date' => $request->validity_period === 'periode' ? $request->end_date : null,
        'duration_days' => $durationDays,
        'type' => $request->type,
        'category' => $request->category,
        'value' => $request->value,
        'status' => $request->status
    ]);

    return redirect()->back()->with('success', 'Promo berhasil ditambahkan');
}
}
