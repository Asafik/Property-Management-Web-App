<?php

namespace App\Http\Controllers;

use App\Models\Position;
use App\Models\Division;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PositionController extends Controller
{
    public function index(Request $request)
    {
        $query = Position::with('division');

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('division_id')) {
            $query->where('division_id', $request->division_id);
        }

        $perPage = $request->input('per_page', 10);

        $positions = $query
            ->latest() // data terbaru paling atas
            ->paginate($perPage)
            ->withQueryString();

        $divisions = Division::all();

        return view('master_data.posisi', compact('positions', 'divisions'));
    }

    public function create()
    {
        $divisions = Division::all();
        return view('positions.create', compact('divisions'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'division_id' => 'required|exists:divisions,id',
            'name' => 'required|string|max:255|unique:positions,name'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        Position::create([
            'division_id' => $request->division_id,
            'name' => $request->name
        ]);

        return redirect()->route('master.data.posisi')
            ->with('success', 'Posisi berhasil ditambahkan.');
    }

    public function show(Position $position)
    {
        $position->load('division', 'users');
        return view('positions.show', compact('position'));
    }

    public function edit(Position $position)
    {
        $divisions = Division::all();
        return view('positions.edit', compact('position', 'divisions'));
    }

    public function update(Request $request, Position $position)
    {
        $validator = Validator::make($request->all(), [
            'division_id' => 'required|exists:divisions,id',
            'name' => 'required|string|max:255|unique:positions,name,' . $position->id
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $position->update([
            'division_id' => $request->division_id,
            'name' => $request->name
        ]);

        return redirect()->route('master.data.posisi')
            ->with('success', 'Posisi berhasil diperbarui.');
    }

    public function destroy(Position $position)
    {
        $position->delete();

        return redirect()->route('master.data.posisi')
            ->with('success', 'Posisi berhasil dihapus.');
    }

    public function getByDivision($divisionId)
    {
        $positions = Position::where('division_id', $divisionId)->get();
        return response()->json($positions);
    }
}
