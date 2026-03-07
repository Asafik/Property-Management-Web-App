<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siteplan;

class SiteplanController extends Controller
{
    public function show($id)
    {
        $siteplan = Siteplan::with('units')->findOrFail($id);
        return view('siteplans.show', [
            'siteplan' => $siteplan,
            'unitsForSvg' => $siteplan->units,
        ]);
    }
}