<?php

namespace App\Http\Controllers\Marketing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Customer;
use App\Models\CustomerDocument;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Guest;

class CustomerController extends Controller
{
    public function create(Request $request)
    {
        $customerId = $this->generateCustomerId();
        $guest = null;

        if ($request->guest_id) {
            $guest = Guest::find($request->guest_id);
        }

        return view('customer.tambah_customer', compact('customerId', 'guest'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'guest_id' => 'nullable|exists:guests,id',
            'full_name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email',
            'uploadKtp' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'uploadKk' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'uploadNpwp' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'uploadPasangan' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        DB::beginTransaction();

        try {
            if ($request->guest_id) {
                $guest = Guest::findOrFail($request->guest_id);
                if ($guest->status === 'converted') {
                    return back()->with('error', 'Guest sudah dikonversi sebelumnya.');
                }
            }

            $customer = Customer::create([
                'customer_id' => $this->generateCustomerId(),
                'full_name' => $request->full_name,
                'nickname' => $request->nickname,
                'nik' => $request->nik,
                'no_kk' => $request->no_kk,
                'birthplace' => $request->birthplace,
                'date_birth' => $request->date_birth,
                'age' => $request->age,
                'gender' => $request->gender,
                'religion' => $request->religion,
                'nationality' => $request->nationality,
                'marital_status' => $request->marital_status,
                'marital_date' => $request->marital_date,
                'child_count' => $request->child_count,
                'spouse_name' => $request->spouse_name,
                'spouse_nik' => $request->spouse_nik,
                'father_name' => $request->father_name,
                'mother_name' => $request->mother_name,
                'province' => $request->province,
                'city' => $request->city,
                'subdistrict' => $request->subdistrict,
                'village' => $request->village,
                'rt' => $request->rt,
                'rw' => $request->rw,
                'postal_code' => $request->postal_code,
                'address' => $request->address,
                'phone' => $request->phone,
                'home_phone' => $request->home_phone,
                'email' => $request->email,
                'office_email' => $request->office_email,
                'job_status' => $request->job_status,
                'job_status_lainnya' => $request->job_status_lainnya,
                'company_name' => $request->company_name,
                'main_income' => $request->main_income ? (int) preg_replace('/[^\d]/', '', $request->main_income) : null,
                'side_income' => $request->side_income ? (int) preg_replace('/[^\d]/', '', $request->side_income) : null,
                'npwp' => $request->npwp,
                'domicile_province' => $request->domicile_province,
                'domicile_city' => $request->domicile_city,
                'domicile_subdistrict' => $request->domicile_subdistrict,
                'domicile_village' => $request->domicile_village,
                'domicile_rt' => $request->domicile_rt,
                'domicile_rw' => $request->domicile_rw,
                'domicile_postal_code' => $request->domicile_postal_code,
                'domicile_address' => $request->domicile_address,
                'instagram' => $request->instagram,
                'facebook' => $request->facebook,
            ]);

            $documents = [
                'uploadKtp' => 'KTP',
                'uploadKk' => 'Kartu Keluarga',
                'uploadNpwp' => 'NPWP',
                'uploadPasangan' => 'KTP Pasangan',
            ];

            foreach ($documents as $inputName => $docName) {
                if ($request->hasFile($inputName)) {
                    $file = $request->file($inputName);
                    $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                    $cleanName = preg_replace('/[^A-Za-z0-9\-]/', '_', $originalName);
                    $extension = $file->getClientOriginalExtension();
                    $filename = time() . '_' . $cleanName . '.' . $extension;

                    $destination = public_path('uploads/customer_documents');

                    if (!file_exists($destination)) {
                        mkdir($destination, 0755, true);
                    }

                    $file->move($destination, $filename);
                    $path = 'customer_documents/' . $filename;

                    CustomerDocument::create([
                        'customer_id' => $customer->id,
                        'document_name' => $docName,
                        'file' => $path,
                        'upload_date' => now(),
                        'status' => 'Pending',
                    ]);
                }
            }

            if ($request->guest_id) {
                $guest->update(['status' => 'converted']);
            }

            DB::commit();

            return redirect()->route('customer.data')->with('success', 'Customer berhasil disimpan');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error simpan customer: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage());
        }
    }

    public function customerData(Request $request)
    {
        $query = Customer::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('full_name', 'like', "%{$search}%")
                    ->orWhere('customer_id', 'like', "%{$search}%");
            });
        }

        if ($request->filled('pekerjaan')) {
            $query->where('job_status', $request->pekerjaan);
        }

        $sortField = $request->get('sortField', 'created_at');
        $sortDirection = $request->get('sortDirection', 'desc');
        $allowedSorts = ['customer_id', 'full_name', 'phone', 'job_status', 'created_at'];

        if (!in_array($sortField, $allowedSorts)) {
            $sortField = 'created_at';
        }

        $query->orderBy($sortField, $sortDirection);

        $perPage = $request->get('per_page', 10);
        $customers = $query->paginate($perPage)->withQueryString();

        return view('customer.customer', compact('customers'));
    }

    public function detailCustomer($id)
    {
        $customer = Customer::with(['units', 'documents'])->findOrFail($id);
        return view('customer.detail_customer', compact('customer'));
    }

    public function search(Request $request)
    {
        $keyword = $request->keyword;

        if (!$keyword) {
            return response()->json([]);
        }

        $customers = Customer::with('units')
            ->where('full_name', 'like', "%$keyword%")
            ->orWhere('nik', 'like', "%$keyword%")
            ->limit(10)
            ->get();

        return response()->json($customers);
    }

   public function edit($id)
    {
        $customer = Customer::with('documents')->findOrFail($id);
        $guest = null;
        return view('customer.tambah_customer', compact('customer', 'guest'));
    }
    public function update(Request $request, $id)
    {
        $customer = Customer::findOrFail($id);

        $request->validate([
            'full_name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email',
            'uploadKtp' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:10240',
            'uploadKk' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:10240',
            'uploadNpwp' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:10240',
            'uploadPasangan' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:10240',
        ]);

        DB::beginTransaction();

        try {
            $customer->update([
                'full_name' => $request->full_name,
                'nickname' => $request->nickname,
                'nik' => $request->nik,
                'no_kk' => $request->no_kk,
                'birthplace' => $request->birthplace,
                'date_birth' => $request->date_birth,
                'age' => $request->age,
                'gender' => $request->gender,
                'religion' => $request->religion,
                'nationality' => $request->nationality,
                'marital_status' => $request->marital_status,
                'marital_date' => $request->marital_date,
                'child_count' => $request->child_count,
                'spouse_name' => $request->spouse_name,
                'spouse_nik' => $request->spouse_nik,
                'father_name' => $request->father_name,
                'mother_name' => $request->mother_name,
                'province' => $request->province,
                'city' => $request->city,
                'subdistrict' => $request->subdistrict,
                'village' => $request->village,
                'rt' => $request->rt,
                'rw' => $request->rw,
                'postal_code' => $request->postal_code,
                'address' => $request->address,
                'phone' => $request->phone,
                'home_phone' => $request->home_phone,
                'email' => $request->email,
                'office_email' => $request->office_email,
                'job_status' => $request->job_status,
                'job_status_lainnya' => $request->job_status_lainnya,
                'company_name' => $request->company_name,
                'main_income' => $request->main_income ? (int) preg_replace('/[^\d]/', '', $request->main_income) : null,
                'side_income' => $request->side_income ? (int) preg_replace('/[^\d]/', '', $request->side_income) : null,
                'npwp' => $request->npwp,
                'domicile_province' => $request->domicile_province,
                'domicile_city' => $request->domicile_city,
                'domicile_subdistrict' => $request->domicile_subdistrict,
                'domicile_village' => $request->domicile_village,
                'domicile_rt' => $request->domicile_rt,
                'domicile_rw' => $request->domicile_rw,
                'domicile_postal_code' => $request->domicile_postal_code,
                'domicile_address' => $request->domicile_address,
                'instagram' => $request->instagram,
                'facebook' => $request->facebook,
            ]);

            $documents = [
                'uploadKtp' => 'KTP',
                'uploadKk' => 'Kartu Keluarga',
                'uploadNpwp' => 'NPWP',
                'uploadPasangan' => 'KTP Pasangan',
            ];

            foreach ($documents as $inputName => $docName) {
                if ($request->hasFile($inputName)) {
                    $file = $request->file($inputName);
                    $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                    $cleanName = preg_replace('/[^A-Za-z0-9\-]/', '_', $originalName);
                    $extension = $file->getClientOriginalExtension();
                    $filename = time() . '_' . $cleanName . '.' . $extension;

                    $destination = public_path('uploads/customer_documents');

                    if (!file_exists($destination)) {
                        mkdir($destination, 0755, true);
                    }

                    $file->move($destination, $filename);
                    $path = 'customer_documents/' . $filename;

                    $existingDoc = CustomerDocument::where('customer_id', $customer->id)
                        ->where('document_name', $docName)
                        ->first();

                    if ($existingDoc) {
                        $oldFile = public_path('uploads/' . $existingDoc->file);
                        if (file_exists($oldFile)) {
                            @unlink($oldFile);
                        }
                        $existingDoc->update([
                            'file' => $path,
                            'upload_date' => now(),
                            'status' => 'Pending',
                        ]);
                    } else {
                        CustomerDocument::create([
                            'customer_id' => $customer->id,
                            'document_name' => $docName,
                            'file' => $path,
                            'upload_date' => now(),
                            'status' => 'Pending',
                        ]);
                    }
                }
            }

            DB::commit();

            return redirect()->route('customer.data')->with('success', 'Customer berhasil diperbarui');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error update customer: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat memperbarui data: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $customer = Customer::withCount(['units', 'documents'])->findOrFail($id);

        if ($customer->units_count > 0) {
            return response()->json(['error' => 'Customer tidak dapat dihapus karena masih memiliki unit properti.'], 422);
        }

        if ($customer->documents_count > 0) {
            return response()->json(['error' => 'Customer tidak dapat dihapus karena masih memiliki dokumen terupload.'], 422);
        }

        DB::beginTransaction();
        try {
            foreach($customer->documents as $doc) {
                $publicPath = public_path('uploads/' . $doc->file);
                if (file_exists($publicPath)) {
                    @unlink($publicPath);
                }
                if (\Storage::disk('public')->exists($doc->file)) {
                    \Storage::disk('public')->delete($doc->file);
                }
            }

            $customer->delete();
            DB::commit();

            return response()->json(['success' => 'Customer berhasil dihapus']);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error hapus customer: '.$e->getMessage());
            return response()->json(['error' => 'Terjadi kesalahan saat menghapus data.'], 500);
        }
    }

    private function generateCustomerId()
    {
        $today = Carbon::now()->format('Ymd');
        $lastCustomer = Customer::whereDate('created_at', Carbon::today())
            ->orderBy('id', 'desc')
            ->first();

        if ($lastCustomer && $lastCustomer->customer_id) {
            $lastNumber = intval(substr($lastCustomer->customer_id, -3));
            $newNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
        } else {
            $newNumber = '001';
        }

        return 'CUST-' . $today . '-' . $newNumber;
    }
}
