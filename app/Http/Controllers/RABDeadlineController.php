<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DevelopmentProgress;
use App\Models\RabDeadline;

class RABDeadlineController extends Controller
{
    public function index($progressId)
{
    $progress = DevelopmentProgress::with(['deadlines', 'items'])
                ->findOrFail($progressId);

    $kategoriList = [
        'persiapan',
        'pondasi',
        'struktur',
        'dinding',
        'atap',
        'finishing',
        'lainnya'
    ];

    return view('properti.deadline_rab', compact('progress', 'kategoriList'));
}

   public function store(Request $request)
{
    RABDeadline::updateOrCreate(
        [
            'development_progress_id' => $request->development_progress_id
        ],
        [
            'target_mulai' => $request->target_mulai,
            'target_selesai' => $request->target_selesai
        ]
    );

    return back()->with('success', 'Deadline berhasil disimpan');
}
}