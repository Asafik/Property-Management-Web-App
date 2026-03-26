<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PraLandbank;
use Illuminate\Support\Facades\Log;

class PraLandBankController extends Controller
{
    public function index()
    {
        return view('land_bank.pra_land_bank');
    }

    public function store(Request $request)
    {
        try {
            $data = $request->except(['file_certificate', 'photo']);

            // bersihkan format rupiah
            $data['offer_price']     = str_replace('.', '', $request->offer_price);
            $data['estimated_price'] = str_replace('.', '', $request->estimated_price);
            $data['area']            = str_replace('.', '', $request->area);

            // upload certificate
            if ($request->hasFile('file_certificate')) {
                $file     = $request->file('file_certificate');
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

            return response()->json([
                'success' => true,
                'message' => 'Data Pra Landbank berhasil disimpan'
            ]);

        } catch (\Exception $e) {
            Log::error('Error simpan pra landbank: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan data: ' . $e->getMessage()
            ], 500);
        }
    }

    public function indexpra(Request $request)
    {
        $query = PraLandbank::query();

        // Search: nama tanah
        if ($request->filled('search')) {
            $query->where('land_name', 'like', '%' . $request->search . '%');
        }

        // Filter: status negosiasi
        if ($request->filled('negotiation_status')) {
            $query->where('negotiation_status', $request->negotiation_status);
        }

        // Sort
        $allowedSorts  = ['land_name', 'estimated_price', 'negotiation_status', 'created_at'];
        $sortField     = in_array($request->get('sortField'), $allowedSorts)
                         ? $request->get('sortField')
                         : 'created_at';
        $sortDirection = $request->get('sortDirection', 'desc') === 'asc' ? 'asc' : 'desc';
        $query->orderBy($sortField, $sortDirection);

        // perPage: 10, 15, 25
        $perPage = in_array((int) $request->get('perPage', 10), [10, 15, 25])
            ? (int) $request->get('perPage', 10)
            : 10;

        $praLandBank = $query->paginate($perPage)->withQueryString();

        return view('land_bank.all_pra_land_bank', compact('praLandBank'));
    }
}
