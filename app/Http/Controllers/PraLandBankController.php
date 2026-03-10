<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PraLandbank;

class PraLandBankController extends Controller
{
    //
    public function index()
    {
        return view('land_bank.pra_land_bank');
    }

    public function store(Request $request)
    {
        $data = $request->except(['file_certificate', 'photo']);

        // bersihkan format rupiah
        $data['offer_price'] = str_replace('.', '', $request->offer_price);
        $data['estimated_price'] = str_replace('.', '', $request->estimated_price);
        $data['area'] = str_replace('.', '', $request->area);

        // upload certificate
        if ($request->hasFile('file_certificate')) {
            $file = $request->file('file_certificate');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/certificates', $filename);

            $data['file_certificate'] = $filename;
        }

        // upload photo multiple
        if ($request->hasFile('photo')) {

            $photos = [];

            foreach ($request->file('photo') as $photo) {

                $photoname = time() . '_' . $photo->getClientOriginalName();
                $photo->storeAs('public/photos', $photoname);

                $photos[] = $photoname;
            }

            $data['photo'] = json_encode($photos);
        }

        PraLandbank::create($data);

        return redirect()->route('pra-landbank')
            ->with('success', 'Data Pra Landbank berhasil disimpan');
    }

    public function indexpra()
    {

        $praLandBank = PraLandbank::all();

        return view('land_bank.all_pra_land_bank', compact('praLandBank'));
    }
}
