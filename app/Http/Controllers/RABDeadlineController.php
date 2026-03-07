<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DevelopmentProgress;
use App\Models\RabDeadline;
use Carbon\Carbon;

class RABDeadlineController extends Controller
{
    /**
     * Display deadline untuk progress tertentu
     */

      public function index()
    {
        return view('properti.deadline_rab');
    }


    // public function index($progressId)
    // {
    //     try {
    //         $progress = DevelopmentProgress::with(['deadlines', 'items'])
    //                     ->findOrFail($progressId);

    //         $kategoriList = [
    //             'persiapan',
    //             'pondasi',
    //             'struktur',
    //             'dinding',
    //             'atap',
    //             'finishing',
    //             'lainnya'
    //         ];

    //         return view('properti.deadline_rab', compact('progress', 'kategoriList'));

    //     } catch (\Exception $e) {
    //         return redirect()->back()->with('error', 'Data tidak ditemukan: ' . $e->getMessage());
    //     }
    // }

    /**
     * Store deadline baru
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'development_progress_id' => 'required|exists:development_progress,id',
                'kategori' => 'required|string',
                'target_mulai' => 'nullable|date',
                'target_selesai' => 'nullable|date|after_or_equal:target_mulai',
            ]);

            RabDeadline::updateOrCreate(
                [
                    'development_progress_id' => $request->development_progress_id,
                    'kategori' => $request->kategori
                ],
                [
                    'target_mulai' => $request->target_mulai,
                    'target_selesai' => $request->target_selesai
                ]
            );

            return back()->with('success', 'Deadline berhasil disimpan');

        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menyimpan deadline: ' . $e->getMessage());
        }
    }

    /**
     * Update deadline
     */
    public function update(Request $request, $id)
    {
        try {
            $deadline = RabDeadline::findOrFail($id);

            $request->validate([
                'target_mulai' => 'nullable|date',
                'target_selesai' => 'nullable|date|after_or_equal:target_mulai',
            ]);

            $deadline->update([
                'target_mulai' => $request->target_mulai,
                'target_selesai' => $request->target_selesai
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Deadline berhasil diupdate',
                'data' => $deadline
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal update deadline: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Delete deadline
     */
    public function destroy($id)
    {
        try {
            $deadline = RabDeadline::findOrFail($id);
            $deadline->delete();

            return response()->json([
                'success' => true,
                'message' => 'Deadline berhasil dihapus'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal hapus deadline: ' . $e->getMessage()
            ], 500);
        }
    }
}
