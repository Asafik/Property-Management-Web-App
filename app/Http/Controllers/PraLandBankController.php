<?php

namespace App\Http\Controllers;

use App\Models\pra_landbank_documents;
use App\Models\DocumentTypes;
use Illuminate\Http\Request;
use App\Models\PraLandbank;
use App\Models\Invoice;
use Illuminate\Support\Facades\Log;

class PraLandBankController extends Controller
{
   public function index()
{
    $praLandBank = PraLandbank::with(['payments', 'documents.documentType'])->paginate(10);
    $documentTypes = DocumentTypes::all();
    $totalRequiredTypes = $documentTypes->count();

    $landsWithPendingDocsCount = 0;
    foreach ($praLandBank as $item) {
        $totalRequired = max($totalRequiredTypes, $item->documents->count());
        $verifiedDocs = $item->documents->where('status', 'verified')->count();
        if ($verifiedDocs < $totalRequired) {
            $landsWithPendingDocsCount++;
        }
    }

    return view('land_bank.all_pra_land_bank', compact('praLandBank', 'documentTypes', 'landsWithPendingDocsCount'));
}

public function store(Request $request)
{
    try {

        // =========================
        // CLEAN NUMBER
        // =========================
        $cleanNumber = function ($value) {
            return $value ? preg_replace('/[^0-9]/', '', $value) : null;
        };

        // =========================
        // VALIDASI BASIC
        // =========================
        if ($request->fase !== 'fase1' && !$request->filled('id')) {
            return response()->json([
                'success' => false,
                'message' => 'ID wajib ada untuk fase lanjutan'
            ], 400);
        }

        // =========================
        // FASE 1 (CREATE)
        // =========================
        if (!$request->filled('id')) {

            $data = $request->except(['file_certificate', 'photo', 'fase']);

            $data['offer_price']     = $cleanNumber($request->offer_price);
            $data['estimated_price'] = $cleanNumber($request->estimated_price);
            $data['area']            = $cleanNumber($request->area);

            $data['status'] = 'fase1';

            // upload certificate
            if ($request->hasFile('file_certificate')) {
                $file = $request->file('file_certificate');
                $filename = uniqid() . '_' . $file->getClientOriginalName();
                $file->storeAs('public/certificates', $filename);
                $data['file_certificate'] = $filename;
            }

            // upload photos
            if ($request->hasFile('photo')) {
                $photos = [];
                foreach ($request->file('photo') as $photo) {
                    $photoname = uniqid() . '_' . $photo->getClientOriginalName();
                    $photo->storeAs('public/photos', $photoname);
                    $photos[] = $photoname;
                }
                $data['photo'] = json_encode($photos);
            }

            $record = PraLandbank::create($data);

            return response()->json([
                'success' => true,
                'message' => 'Fase 1 berhasil',
                'id' => $record->id
            ]);
        }

        // =========================
        // UPDATE (FASE 2 / 3)
        // =========================
        $record = PraLandbank::findOrFail($request->id);
        $data   = $request->except(['id', 'fase']);

        // clean number
        if ($request->has('offer_price')) {
            $data['offer_price'] = $cleanNumber($request->offer_price);
        }

        if ($request->has('estimated_price')) {
            $data['estimated_price'] = $cleanNumber($request->estimated_price);
        }

        if ($request->has('area')) {
            $data['area'] = $cleanNumber($request->area);
        }

        // =========================
        // FILE UPLOAD
        // =========================



        // Handle deleted documents
        if ($request->filled('deleted_document_ids')) {
            $deletedIds = array_filter(explode(',', $request->deleted_document_ids));
            if (!empty($deletedIds)) {
                pra_landbank_documents::where('pra_landbank_id', $record->id)
                    ->whereIn('id', $deletedIds)
                    ->delete();
            }
        }

        if ($request->has('documents')) {
            foreach ($request->documents as $key => $doc) {
                $docTypeId = $doc['document_type_id'] ?? $key;
                $docNumber = $doc['number'] ?? null;
                $docId     = $doc['id'] ?? null;

                if (empty($docTypeId)) {
                    continue;
                }

                $existingDoc = null;
                if (!empty($docId)) {
                    $existingDoc = pra_landbank_documents::where('pra_landbank_id', $record->id)->find($docId);
                } else {
                    $existingDoc = pra_landbank_documents::where('pra_landbank_id', $record->id)
                        ->where('document_type_id', $docTypeId)
                        ->first();
                }

                $hasFile = $request->hasFile("documents.{$key}.file");

                if (empty($docNumber) && !$hasFile && !$existingDoc) {
                    continue;
                }

                $filePath = $existingDoc ? $existingDoc->file_path : null;

                if ($hasFile) {
                    $file = $request->file("documents.{$key}.file");
                    $filename = uniqid() . '.' . $file->getClientOriginalExtension();
                    $destination = public_path('uploads/pra_landbank/' . $record->id . '/' . $docTypeId);

                    if (!file_exists($destination)) {
                        mkdir($destination, 0755, true);
                    }

                    $file->move($destination, $filename);
                    $filePath = 'uploads/pra_landbank/' . $record->id . '/' . $docTypeId . '/' . $filename;
                }

                // Jika baru upload file baru / revisi berkas, status otomatis 'pending' menunggu validasi Kepala Legal
                $docStatus = $hasFile ? 'pending' : ($existingDoc ? ($existingDoc->status ?? 'pending') : 'pending');
                $docPhysicalStatus = $doc['document_status'] ?? ($existingDoc->document_status ?? 'ada');
                $processNotes      = $doc['process_notes'] ?? ($existingDoc->process_notes ?? null);

                if ($existingDoc) {
                    $existingDoc->update([
                        'document_type_id' => $docTypeId,
                        'document_number'  => $docNumber,
                        'document_status'  => $docPhysicalStatus,
                        'process_notes'    => $processNotes,
                        'file_path'        => $filePath,
                        'status'           => $docStatus,
                    ]);
                } else {
                    pra_landbank_documents::create([
                        'pra_landbank_id'  => $record->id,
                        'document_type_id' => $docTypeId,
                        'document_number'  => $docNumber,
                        'document_status'  => $docPhysicalStatus,
                        'process_notes'    => $processNotes,
                        'file_path'        => $filePath,
                        'status'           => $docStatus,
                        'revision_number'  => 0,
                    ]);
                }
            }

            // Jika ada dokumen baru/tambahan yang belum diverifikasi, sesuaikan legal_status
            $allCurrentDocs = pra_landbank_documents::where('pra_landbank_id', $record->id)->get();
            $unverifiedDocsCount = $allCurrentDocs->where('status', '!=', 'verified')->count();
            if ($unverifiedDocsCount > 0 && $record->legal_status === 'clear') {
                $record->update(['legal_status' => 'process']);
            }
        }

        // =========================
        // MAP FIELDS BY FASE
        // =========================
        if ($request->fase === 'fase2') {
            $data['status'] = 'fase2';

            // Map Fase 2 fields
            $data['survey_date']       = $request->tgl_survey;
            $data['survey_by']         = $request->petugas;
            $data['survey_result']     = $request->hasil_survey;
            $data['survey_notes']      = $request->catatan_survey;
            $data['land_status']       = $request->land_status_temp;
            $data['water_condition']   = $request->water_condition_temp;
            $data['legal_status']      = $request->status_tanah;
            $data['legal_issue_note']  = $request->keterangan_masalah;
            $data['permit_difficulty']      = $request->kesulitan_izin;
            $data['permit_difficulty_note'] = $request->keterangan_kesulitan_izin;

            if ($request->has('zoning')) $data['zoning'] = $request->zoning;
            if ($request->has('road_width')) $data['road_width'] = $request->road_width ? $cleanNumber($request->road_width) : null;
            if ($request->has('road_type')) $data['road_type'] = $request->road_type;
            if ($request->has('lat')) $data['lat'] = $request->lat;
            if ($request->has('lng')) $data['lng'] = $request->lng;

            // Map facilities array to individual boolean columns
            $facList = $request->fasilitas ?? [];
            $data['facility_school']    = in_array('sekolah', $facList);
            $data['facility_hospital']  = in_array('rumah_sakit', $facList);
            $data['facility_market']    = in_array('pasar', $facList);
            $data['facility_transport'] = in_array('transportasi', $facList);
            $data['facility_mall']      = in_array('mall', $facList);
            $data['facility_bank']      = in_array('bank', $facList);
        }

        if ($request->fase === 'fase3') {
            // Validasi: seluruh dokumen legalitas wajib sudah divalidasi (Sah/Verified) oleh Kepala Legal
            $praDocs = pra_landbank_documents::where('pra_landbank_id', $record->id)->get();
            $activeDocs = $praDocs->filter(function($d) {
                return !empty($d->file_path) || $d->document_status === 'proses' || !empty($d->document_number);
            });
            $hasUnverified = $activeDocs->count() === 0 || $activeDocs->contains(fn($d) => !in_array($d->status, ['verified', 'valid']));

            if ($hasUnverified && ($request->status ?? 'fase3') !== 'rejected') {
                return response()->json([
                    'success' => false,
                    'message' => 'Status Legalitas belum Sah! Kepala Legal wajib memvalidasi dan menyetujui seluruh berkas dokumen legalitas di Fase 2 terlebih dahulu sebelum dapat melanjutkan ke Fase 3.'
                ], 422);
            }

            if ($request->boolean('is_preview')) {
                $data['status'] = $record->status ?? 'fase3';
            } else {
                $data['status'] = $request->status ?? 'fase3'; // approved, rejected, or pending (fase3)
            }
            
            // Map Fase 3 fields
            if ($request->filled('prioritas')) {
                $data['priority'] = $request->prioritas;
            }
            if ($request->has('catatan')) {
                $data['notes'] = $request->catatan;
            }

            // Biaya-biaya lain / transaksi:
            // JIKA ada input terisi yang dikirim form, perbarui nilainya.
            // JIKA tidak dikirim (misal saat form disabled atau hanya update progres pembayaran termin),
            // PERTAHANKAN NILAI YANG SUDAH ADA di $record (JANGAN fallback ke 0).
            if ($request->has('biaya_ijb_temp') && $request->filled('biaya_ijb_temp')) {
                $data['cost_ijb'] = $cleanNumber($request->biaya_ijb_temp);
            } elseif (!$record->exists) {
                $data['cost_ijb'] = 0;
            }

            if ($request->has('biaya_pajak_temp') && $request->filled('biaya_pajak_temp')) {
                $data['cost_tax'] = $cleanNumber($request->biaya_pajak_temp);
            } elseif (!$record->exists) {
                $data['cost_tax'] = 0;
            }

            if ($request->has('fee_makelar_temp') && $request->filled('fee_makelar_temp')) {
                $data['cost_broker'] = $cleanNumber($request->fee_makelar_temp);
            } elseif (!$record->exists) {
                $data['cost_broker'] = 0;
            }

            if ($request->has('biaya_lain_temp') || ($request->has('custom_costs') && is_array($request->custom_costs))) {
                $otherCost = 0;
                if ($request->filled('biaya_lain_temp')) {
                    $otherCost += (float)$cleanNumber($request->biaya_lain_temp);
                }
                if ($request->has('custom_costs') && is_array($request->custom_costs)) {
                    foreach ($request->custom_costs as $cCost) {
                        if (!empty($cCost['amount'])) {
                            $otherCost += (float)$cleanNumber($cCost['amount']);
                        }
                    }
                }
                $data['cost_other'] = $otherCost;
            } elseif (!$record->exists) {
                $data['cost_other'] = 0;
            }

            // Ensure payment_method is correctly detected
            if ($request->has('installments') && is_array($request->installments) && count($request->installments) > 1) {
                $paymentMethod = 'termin';
            } elseif ($request->filled('payment_method_temp')) {
                $paymentMethod = $request->payment_method_temp;
            } elseif ($request->filled('payment_method')) {
                $paymentMethod = $request->payment_method;
            } else {
                $paymentMethod = $record->payment_method ?? 'cash';
            }
            $data['payment_method'] = $paymentMethod;

            if ($data['payment_method'] === 'cash') {
                $data['installment_duration'] = null;
                $data['installment_count']    = 1;
            } else {
                $data['installment_duration'] = $request->installment_duration_temp ?? $record->installment_duration;
                $data['installment_count']    = $request->installment_count_temp ?? (is_array($request->installments) ? count($request->installments) : $record->installment_count);
            }

            if ($request->has('deal_price') && $request->filled('deal_price')) {
                $finalDealPrice = $cleanNumber($request->deal_price);
                $data['deal_price'] = $finalDealPrice;
                $data['estimated_price'] = $finalDealPrice;
            } elseif ($request->has('estimated_price') && $request->filled('estimated_price')) {
                $finalDealPrice = $cleanNumber($request->estimated_price);
                $data['deal_price'] = $finalDealPrice;
                $data['estimated_price'] = $finalDealPrice;
            }

            // Upload file_ijb
            if ($request->hasFile('file_ijb_temp')) {
                $file = $request->file('file_ijb_temp');
                $filename = uniqid() . '_ijb_' . $file->getClientOriginalName();
                $file->move(public_path('uploads/pra_landbank/' . $record->id . '/ijb'), $filename);
                $data['file_ijb'] = 'uploads/pra_landbank/' . $record->id . '/ijb/' . $filename;
            }

            // Upload file_tax
            if ($request->hasFile('file_pajak_temp')) {
                $file = $request->file('file_pajak_temp');
                $filename = uniqid() . '_pajak_' . $file->getClientOriginalName();
                $file->move(public_path('uploads/pra_landbank/' . $record->id . '/pajak'), $filename);
                $data['file_tax'] = 'uploads/pra_landbank/' . $record->id . '/pajak/' . $filename;
            }

            // Process payment according to method
            if ($data['payment_method'] === 'cash') {
                $record->payments()->delete();

                $cashAmount = $request->cash_amount_temp ? $cleanNumber($request->cash_amount_temp) : ($data['estimated_price'] ?? 0);
                $cashDate = $request->cash_payment_date ?? now()->format('Y-m-d');
                $cashStatus = $request->cash_status ?? 'lunas';
                $cashFilePath = null;

                if ($request->hasFile('cash_file')) {
                    $file = $request->file('cash_file');
                    $filename = uniqid() . '_cash_' . $file->getClientOriginalName();
                    $file->move(public_path('uploads/pra_landbank/' . $record->id . '/cash'), $filename);
                    $cashFilePath = 'uploads/pra_landbank/' . $record->id . '/cash/' . $filename;
                }

                $cashPaymentType = $request->cash_payment_type ?? 'transfer';
                $cashBankName = $request->cash_bank_name ?? null;
                $cashAccountNumber = $request->cash_account_number ?? null;
                $cashAccountName = $request->cash_account_name ?? null;

                \App\Models\PraLandbankPayment::create([
                    'pra_landbank_id' => $record->id,
                    'term_name'       => 'Pelunasan Cash Keras',
                    'amount'          => $cashAmount,
                    'due_date'        => $cashDate,
                    'file_path'       => $cashFilePath,
                    'status'          => $cashStatus,
                    'payment_type'    => $cashPaymentType,
                    'bank_name'       => $cashBankName,
                    'account_number'  => $cashAccountNumber,
                    'account_name'    => $cashAccountName,
                ]);
            } elseif ($data['payment_method'] === 'termin' && $request->has('installments')) {
                // Get existing payments to preserve amounts if disabled on frontend
                $existingPayments = $record->payments->keyBy('term_name');
                $oldPaymentsList = $record->payments->values();
                $totalDeal = (float)($data['deal_price'] ?? $record->deal_price ?? 0);
                $instCount = is_array($request->installments) ? count($request->installments) : 1;

                $record->payments()->delete();

                foreach ($request->installments as $i => $inst) {
                    $termName = $inst['term_name'] ?? ('Tahap ' . $i);
                    $amount = isset($inst['amount_temp']) ? $cleanNumber($inst['amount_temp']) : 0;

                    // Jika amount bernilai 0 (misal terkirim kosong/disabled), ambil dari record lama atau bagi rata dari harga deal
                    if ($amount == 0) {
                        $matchPmt = $existingPayments->get($termName) ?? ($oldPaymentsList[$i - 1] ?? null);
                        if ($matchPmt && $matchPmt->amount > 0) {
                            $amount = (float)$matchPmt->amount;
                        } elseif ($totalDeal > 0 && $instCount > 0) {
                            $amount = round($totalDeal / $instCount);
                        }
                    }

                    $dueDate = $inst['due_date'] ?? null;
                    $status = $inst['status'] ?? 'belum';
                    $filePath = $inst['existing_file_path'] ?? null;

                    // Check if file upload exists for this installment row
                    if ($request->hasFile("installments.{$i}.file")) {
                        $file = $request->file("installments.{$i}.file");
                        $filename = uniqid() . '_termin_' . $i . '_' . $file->getClientOriginalName();
                        $file->move(public_path('uploads/pra_landbank/' . $record->id . '/termin'), $filename);
                        $filePath = 'uploads/pra_landbank/' . $record->id . '/termin/' . $filename;
                    }

                    $paymentType = $inst['payment_type'] ?? 'transfer';
                    $bankName = $inst['bank_name'] ?? null;
                    $accountNumber = $inst['account_number'] ?? null;
                    $accountName = $inst['account_name'] ?? null;

                    \App\Models\PraLandbankPayment::create([
                        'pra_landbank_id' => $record->id,
                        'term_name'       => $termName,
                        'amount'          => $amount,
                        'due_date'        => $dueDate,
                        'file_path'       => $filePath,
                        'status'          => $status,
                        'payment_type'    => $paymentType,
                        'bank_name'       => $bankName,
                        'account_number'  => $accountNumber,
                        'account_name'    => $accountName,
                    ]);
                }
            } else {
                $record->payments()->delete();
            }
        }

        // pastikan status tidak kosong
        $data['status'] = $data['status'] ?? $record->status;

        if ($data['status'] === 'approved') {
            if ($record->exists && $record->status === 'approved') {
                $customMessage = 'Progres dan data pembayaran termin tanah berhasil diperbarui!';
            } else {
                $customMessage = 'Keputusan sidang berhasil disetujui (DIAMBIL)! Data tanah telah otomatis masuk ke menu Semua Tanah Pasca Land Bank.';
            }
        } else {
            $customMessage = 'Data keputusan sidang berhasil disimpan!';
        }

        $record->update($data);

        // =========================
        // AUTO PINDAH KE LANDBANK (PASCA LAND BANK)
        // =========================
        if ($data['status'] === 'approved') {
            $finalAcquisitionPrice = $data['deal_price'] ?? $data['estimated_price'] ?? $record->deal_price ?? $record->estimated_price;

            $landBank = \App\Models\LandBank::firstOrNew(['name' => $record->land_name]);
            $landBank->fill([
                'name'              => $record->land_name,
                'area'              => $record->area,
                'remaining_area'    => $landBank->exists ? $landBank->remaining_area : $record->area,
                'acquisition_price' => $finalAcquisitionPrice,
                'acquisition_date'  => $landBank->exists ? $landBank->acquisition_date : now()->toDateString(),
                'address'           => $record->address,
                'village'           => $record->village,
                'district'          => $record->district,
                'city'              => $record->city,
                'province'          => $record->province,
                'zoning'            => $record->zoning,
                'road_width'        => $record->road_width,
                'road_type'         => $record->road_type,
                'ownership_status'  => $record->ownership_status ?? 'SHM',
                'certificate_owner' => $record->certificate_owner ?? $record->owner_name ?? $record->land_owner,
                'facility_school'   => (bool)($record->facility_school ?? false),
                'facility_hospital' => (bool)($record->facility_hospital ?? false),
                'facility_mall'     => (bool)($record->facility_mall ?? false),
                'facility_transport'=> (bool)($record->facility_transport ?? false),
                'lat'               => $record->lat,
                'lng'               => $record->lng,
                'file_certificate'  => $record->file_certificate,
                'photo'             => $record->photo,
                'priority'          => $record->priority ?? 'Normal',
                'status'            => $landBank->exists ? $landBank->status : 'active',
                'legal_status'      => 'verified',
                'development_status'=> $landBank->exists ? $landBank->development_status : 'Belum'
            ]);
            $landBank->save();

            // Initialize default infrastructure site development items (PJU, Selokan, Jalan, etc.)
            $landBank->initializeDefaultInfrastructures();

            // Copy all documents from pra_landbank_documents to land_bank_documents
            if ($record->documents()->exists()) {
                foreach ($record->documents as $doc) {
                    \App\Models\LandBankDocument::firstOrCreate([
                        'land_bank_id'     => $landBank->id,
                        'document_type_id' => $doc->document_type_id,
                    ], [
                        'document_number'  => $doc->document_number,
                        'file_path'        => $doc->file_path,
                        'status'           => 'verified',
                        'revision_number'  => $doc->revision_number ?? 0
                    ]);
                }
            }
        }

        // =========================
        // SINKRONISASI INVOICE KE DATABASE
        // =========================
        $invoice = null;
        if ($request->fase === 'fase3' || $record->deal_price || $record->estimated_price) {
            $record->load('payments');
            $invoice = Invoice::syncFromPraLandbank($record);
        }

        return response()->json([
            'success'     => true,
            'message'     => $customMessage,
            'status'      => $data['status'],
            'land_id'     => $record->id,
            'invoice_id'  => $invoice ? $invoice->id : null,
            'invoice_num' => $invoice ? $invoice->invoice_number : null,
            'invoice_url' => route('pra-landbank.invoice', $record->id),
        ]);

    } catch (\Exception $e) {

        \Log::error($e->getMessage());

        return response()->json([
            'success' => false,
            'message' => $e->getMessage()
        ], 500);
    }
}

    public function invoice($id)
    {
        $land = PraLandbank::with(['payments', 'documents.documentType'])->findOrFail($id);
        $invoice = Invoice::syncFromPraLandbank($land);
        $invoiceNumber = $invoice->invoice_number;
        return view('cetak.invoice_pra_land_bank', compact('land', 'invoice', 'invoiceNumber'));
    }

    public function indexpra(Request $request)
    {
        $query = PraLandbank::with(['payments', 'documents.documentType']);

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

        // perPage: 5, 10, 15, 25
        $perPage = in_array((int) $request->get('perPage', 10), [5, 10, 15, 25])
            ? (int) $request->get('perPage', 10)
            : 10;

        $praLandBank = $query->paginate($perPage)->withQueryString();
        $documentTypes = DocumentTypes::all();
        $totalRequiredTypes = $documentTypes->count();

        // Hitung tanah yang memiliki dokumen tambahan / belum lengkap menunggu verifikasi Kepala Legal
        $landsWithPendingDocsCount = 0;
        foreach ($praLandBank as $item) {
            $totalRequired = max($totalRequiredTypes, $item->documents->count());
            $verifiedDocs = $item->documents->where('status', 'verified')->count();
            if ($verifiedDocs < $totalRequired) {
                $landsWithPendingDocsCount++;
            }
        }

        return view('land_bank.all_pra_land_bank', compact('praLandBank', 'documentTypes', 'landsWithPendingDocsCount'));
    }
    public function proses(Request $request, $id = null)
    {
        $land = null;
        if ($id) {
            $land = PraLandbank::with('documents.documentType')->findOrFail($id);
        }
        $documentTypes = DocumentTypes::all();
        return view('land_bank.proses_pra_land_bank', compact('land', 'documentTypes'));
    }
    public function destroy($id)
    {
        try {
            $record = PraLandbank::findOrFail($id);
            $record->delete();

            if (request()->ajax() || request()->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Data Pra Land Bank berhasil dihapus'
                ]);
            }

            return redirect()->route('pralandbank.all')->with('success', 'Data Pra Land Bank berhasil dihapus');
        } catch (\Exception $e) {
            Log::error($e->getMessage());

            if (request()->ajax() || request()->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => $e->getMessage()
                ], 500);
            }

            return redirect()->route('pralandbank.all')->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }

    /**
     * Validasi Dokumen Legalitas oleh Kepala Legal
     */
    public function approveDocument($id)
    {
        $doc = pra_landbank_documents::findOrFail($id);
        $doc->update([
            'status' => 'verified',
        ]);

        $praLandbank = PraLandbank::with('documents')->find($doc->pra_landbank_id);
        $autoAdvanced = false;

        if ($praLandbank) {
            $allDocs = $praLandbank->documents;
            $totalUploaded = $allDocs->whereNotNull('file_path')->count();
            $totalVerified = $allDocs->where('status', 'verified')->whereNotNull('file_path')->count();

            if ($totalUploaded > 0 && $totalUploaded === $totalVerified) {
                if (in_array($praLandbank->status, ['fase1', 'fase2'])) {
                    $praLandbank->update([
                        'status'       => 'fase3',
                        'legal_status' => 'clear'
                    ]);
                    $autoAdvanced = true;
                }
            }
        }

        if (request()->ajax() || request()->wantsJson()) {
            return response()->json([
                'success'                => true,
                'message'                => 'Dokumen berhasil disetujui & diverifikasi oleh Kepala Legal!',
                'status'                 => 'verified',
                'auto_advanced_to_fase3' => $autoAdvanced,
            ]);
        }

        return back()->with('success', 'Dokumen berhasil disetujui & diverifikasi oleh Kepala Legal.');
    }

    /**
     * Penolakan / Revisi Dokumen oleh Kepala Legal
     */
    public function rejectDocument(Request $request, $id)
    {
        $request->validate([
            'catatan_admin' => 'nullable|string|max:1000'
        ]);

        $doc = pra_landbank_documents::findOrFail($id);
        $doc->update([
            'status'          => 'rejected',
            'admin_notes'     => $request->catatan_admin,
            'revision_number' => ($doc->revision_number ?? 0) + 1,
        ]);

        if ($request->filled('catatan_admin')) {
            $land = PraLandbank::find($doc->pra_landbank_id);
            if ($land) {
                $land->update(['legal_issue_note' => $request->catatan_admin]);
            }
        }

        if (request()->ajax() || request()->wantsJson()) {
            return response()->json([
                'success'         => true,
                'message'         => 'Dokumen ditolak & menunggu perbaikan berkas.',
                'status'          => 'rejected',
                'notes'           => $request->catatan_admin,
                'revision_number' => $doc->revision_number
            ]);
        }

        return back()->with('success', 'Dokumen ditolak & menunggu perbaikan berkas.');
    }

    /**
     * Upload berkas fisik dokumen yang sudah selesai/jadi oleh Staff Legal (Tanpa membatalkan status validasi paralel)
     */
    public function uploadCompletedDocument(Request $request, $id)
    {
        $request->validate([
            'document_number' => 'nullable|string|max:255',
            'file'            => 'required|file|mimes:pdf,jpg,jpeg,png|max:20480',
            'process_notes'   => 'nullable|string',
        ]);

        $doc = pra_landbank_documents::findOrFail($id);
        $record = PraLandbank::findOrFail($doc->pra_landbank_id);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $destination = public_path('uploads/pra_landbank/' . $record->id . '/' . $doc->document_type_id);

            if (!file_exists($destination)) {
                mkdir($destination, 0755, true);
            }

            $file->move($destination, $filename);
            $filePath = 'uploads/pra_landbank/' . $record->id . '/' . $doc->document_type_id . '/' . $filename;

            $doc->update([
                'document_number' => $request->filled('document_number') ? $request->document_number : $doc->document_number,
                'file_path'       => $filePath,
                'document_status' => 'ada',
                'process_notes'   => $request->filled('process_notes') ? $request->process_notes : 'Dokumen fisik telah selesai dan diunggah oleh Staff Legal.',
            ]);
        }

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Berkas fisik dokumen ' . ($doc->documentType->name ?? '') . ' berhasil diunggah & status diperbarui menjadi Lengkap!',
                'doc'     => $doc->fresh(['documentType']),
            ]);
        }

        return back()->with('success', 'Berkas fisik dokumen berhasil diunggah!');
    }
}
