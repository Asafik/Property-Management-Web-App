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
        // =========================
        // FASE 1 (CREATE)
        // =========================
        if (!$request->filled('id')) {

            $data = $request->except(['file_certificate', 'photo', 'fase', 'documents', 'deleted_document_ids']);

            $data['offer_price']     = $cleanNumber($request->offer_price);
            $data['estimated_price'] = $cleanNumber($request->estimated_price);
            $data['area']            = $cleanNumber($request->area);
            if ($request->has('pbb_nominal')) {
                $data['pbb_nominal'] = $request->pbb_status === 'nunggak' ? $cleanNumber($request->pbb_nominal) : null;
            }
            if ($request->pbb_status === 'lunas') {
                $data['pbb_note'] = null;
                $data['pbb_nominal'] = null;
            }

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

            // Proses penyimpanan dokumen legalitas di Fase 1 awal
            $this->processDocuments($request, $record);

            return response()->json([
                'success' => true,
                'message' => 'Data Fase 1 dan Dokumen Legalitas berhasil disimpan',
                'id' => $record->id
            ]);
        }

        // =========================
        // UPDATE (FASE 1 / 2 / 3)
        // =========================
        $record = PraLandbank::findOrFail($request->id);
        $data   = $request->except(['id', 'fase', 'documents', 'deleted_document_ids']);

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

        if ($request->has('pbb_nominal')) {
            $data['pbb_nominal'] = ($request->pbb_status ?? $record->pbb_status) === 'nunggak' ? $cleanNumber($request->pbb_nominal) : null;
        }

        if ($request->has('pbb_status') && $request->pbb_status === 'lunas') {
            $data['pbb_note'] = null;
            $data['pbb_nominal'] = null;
        }

        // Proses penyimpanan dokumen legalitas (Fase 1 / Fase 2)
        $this->processDocuments($request, $record);

        // Jika request hanya untuk update Fase 1
        if ($request->fase === 'fase1') {
            $record->update($data);
            return response()->json([
                'success' => true,
                'message' => 'Data Fase 1 dan Dokumen Legalitas berhasil diperbarui!',
                'id'      => $record->id
            ]);
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

            // Upload Foto Lahan 1 (Fase 2)
            if ($request->hasFile('photo')) {
                $file = $request->file('photo');
                $filename = uniqid() . '_foto1_' . $file->getClientOriginalName();
                $destination = public_path('uploads/pra_landbank/' . $record->id . '/foto');
                if (!file_exists($destination)) mkdir($destination, 0755, true);
                $file->move($destination, $filename);
                $data['photo'] = 'uploads/pra_landbank/' . $record->id . '/foto/' . $filename;
            }

            // Upload Foto Lahan 2 (Fase 2)
            if ($request->hasFile('photo_2')) {
                $file = $request->file('photo_2');
                $filename = uniqid() . '_foto2_' . $file->getClientOriginalName();
                $destination = public_path('uploads/pra_landbank/' . $record->id . '/foto');
                if (!file_exists($destination)) mkdir($destination, 0755, true);
                $file->move($destination, $filename);
                $data['photo_2'] = 'uploads/pra_landbank/' . $record->id . '/foto/' . $filename;
            }
        }

        if ($request->fase === 'fase3') {
            $currentUser = auth()->user();
            $userPositionName = strtolower($currentUser->position->name ?? '');
            $userDivisionName = strtolower($currentUser->division->name ?? ($currentUser->position->division->name ?? ''));
            $userPositionId = $currentUser->position_id ?? null;
            $isAdmin = ($userPositionId == 5) || str_contains($userPositionName, 'admin');
            $isKeuangan = ($userPositionId == 7) || str_contains($userPositionName, 'keuangan') || str_contains($userPositionName, 'finance') || str_contains($userDivisionName, 'keuangan') || str_contains($userDivisionName, 'finance');

            // Validasi: seluruh dokumen legalitas wajib sudah divalidasi (Sah/Verified) oleh Kepala Legal jika memutuskan Approved
            $praDocs = pra_landbank_documents::where('pra_landbank_id', $record->id)->get();
            $activeDocs = $praDocs->filter(function($d) {
                return !empty($d->file_path) || $d->document_status === 'proses' || !empty($d->document_number);
            });
            $hasUnverified = $activeDocs->count() === 0 || $activeDocs->contains(fn($d) => !in_array($d->status, ['verified', 'valid']));

            if ($hasUnverified && ($request->status ?? 'fase3') === 'approved' && !$isAdmin) {
                return response()->json([
                    'success' => false,
                    'message' => 'Status Legalitas belum Sah! Kepala Legal wajib memvalidasi dan menyetujui seluruh berkas dokumen legalitas di Fase 1 terlebih dahulu sebelum tanah dapat disetujui (Approved).'
                ], 422);
            }

            // Validasi: Fase 2 (Survey Kelayakan) wajib sudah diisi sebelum Approved
            if (empty($record->survey_date) && ($request->status ?? 'fase3') === 'approved' && !$isAdmin) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data Survey Kelayakan belum diisi! Harap lengkapi dan simpan data Fase 2 (Survey Kelayakan Teknis & Spasial Map) terlebih dahulu sebelum tanah dapat disetujui (Approved).'
                ], 422);
            }

            if ($request->boolean('is_preview')) {
                $data['status'] = $record->status ?? 'fase3';
            } elseif ($isKeuangan && !$isAdmin && empty($request->status)) {
                $data['status'] = $record->status ?? 'fase3';
            } else {
                $data['status'] = $request->status ?? ($record->status ?? 'fase3'); // approved, rejected, or pending (fase3)
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
            $explicitMethod = $request->payment_method_temp ?? $request->payment_method;
            if (!empty($explicitMethod) && in_array(strtolower($explicitMethod), ['cash', 'termin'])) {
                $paymentMethod = strtolower($explicitMethod);
            } elseif ($request->has('installments') && is_array($request->installments) && count($request->installments) > 1) {
                $paymentMethod = 'termin';
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

            // Pemilihan Notaris & Jadwal Transaksi di Notaris
            if ($request->has('notaris_id')) {
                $data['notaris_id'] = $request->notaris_id ?: null;
            }
            if ($request->has('notary_appointment_date')) {
                $dateVal = $request->notary_appointment_date;
                if (!empty($dateVal)) {
                    try {
                        $data['notary_appointment_date'] = \Carbon\Carbon::parse($dateVal)->format('Y-m-d H:i:s');
                    } catch (\Exception $e) {
                        $data['notary_appointment_date'] = null;
                    }
                } else {
                    $data['notary_appointment_date'] = null;
                }
            }

            // Upload Kwitansi Bermaterai Pembayaran
            if ($request->hasFile('receipt_file')) {
                $file = $request->file('receipt_file');
                $filename = uniqid() . '_kwitansi_' . $file->getClientOriginalName();
                $destination = public_path('uploads/pra_landbank/' . $record->id . '/transaksi');
                if (!file_exists($destination)) mkdir($destination, 0755, true);
                $file->move($destination, $filename);
                $data['receipt_file'] = 'uploads/pra_landbank/' . $record->id . '/transaksi/' . $filename;
            }

            // Upload Bukti Bayar Pajak PPh
            if ($request->hasFile('tax_pph_file')) {
                $file = $request->file('tax_pph_file');
                $filename = uniqid() . '_pph_' . $file->getClientOriginalName();
                $destination = public_path('uploads/pra_landbank/' . $record->id . '/transaksi');
                if (!file_exists($destination)) mkdir($destination, 0755, true);
                $file->move($destination, $filename);
                $data['tax_pph_file'] = 'uploads/pra_landbank/' . $record->id . '/transaksi/' . $filename;
            }

            // Upload Salinan Akta Pelepasan Hak dari Notaris
            if ($request->hasFile('release_deed_file')) {
                $file = $request->file('release_deed_file');
                $filename = uniqid() . '_akta_pelepasan_' . $file->getClientOriginalName();
                $destination = public_path('uploads/pra_landbank/' . $record->id . '/transaksi');
                if (!file_exists($destination)) mkdir($destination, 0755, true);
                $file->move($destination, $filename);
                $data['release_deed_file'] = 'uploads/pra_landbank/' . $record->id . '/transaksi/' . $filename;
            }

            // Upload file_ijb
            if ($request->hasFile('file_ijb_temp')) {
                $file = $request->file('file_ijb_temp');
                $filename = uniqid() . '_ijb_' . $file->getClientOriginalName();
                $destination = public_path('uploads/pra_landbank/' . $record->id . '/ijb');
                if (!file_exists($destination)) mkdir($destination, 0755, true);
                $file->move($destination, $filename);
                $data['file_ijb'] = 'uploads/pra_landbank/' . $record->id . '/ijb/' . $filename;
            }

            // Upload file_tax
            if ($request->hasFile('file_pajak_temp')) {
                $file = $request->file('file_pajak_temp');
                $filename = uniqid() . '_pajak_' . $file->getClientOriginalName();
                $destination = public_path('uploads/pra_landbank/' . $record->id . '/pajak');
                if (!file_exists($destination)) mkdir($destination, 0755, true);
                $file->move($destination, $filename);
                $data['file_tax'] = 'uploads/pra_landbank/' . $record->id . '/pajak/' . $filename;
            }

            // Process payment according to method
            if ($data['payment_method'] === 'cash') {
                $existingCash = $record->payments ? ($record->payments->firstWhere('term_name', 'Pelunasan Cash Keras') ?? $record->payments->first()) : null;
                $cashFilePath = $existingCash ? $existingCash->file_path : null;

                $record->payments()->delete();

                $cashAmount = $request->cash_amount_temp ? $cleanNumber($request->cash_amount_temp) : ($data['deal_price'] ?? $data['estimated_price'] ?? 0);
                $cashDate = $request->cash_payment_date ?? now()->format('Y-m-d');
                $cashStatus = $request->cash_status ?? 'lunas';

                if ($request->hasFile('cash_file')) {
                    $file = $request->file('cash_file');
                    $filename = uniqid() . '_cash_' . $file->getClientOriginalName();
                    $destination = public_path('uploads/pra_landbank/' . $record->id . '/cash');
                    if (!file_exists($destination)) mkdir($destination, 0755, true);
                    $file->move($destination, $filename);
                    $cashFilePath = 'uploads/pra_landbank/' . $record->id . '/cash/' . $filename;
                }

                $cashPaymentType = $request->cash_payment_type ?? 'transfer';
                $cashBankName = $request->cash_bank_name ?? null;
                $cashAccountNumber = $request->cash_account_number ?? null;
                $cashAccountName = $request->cash_account_name ?? $request->cash_account_holder ?? null;

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
            $finalDealPrice = $data['deal_price'] ?? $data['estimated_price'] ?? $record->deal_price ?? $record->estimated_price;
            $finalGrandTotal = (float)$finalDealPrice 
                + (float)($data['cost_ijb'] ?? $record->cost_ijb ?? 0)
                + (float)($data['cost_tax'] ?? $record->cost_tax ?? 0)
                + (float)($data['cost_broker'] ?? $record->cost_broker ?? 0)
                + (float)($data['cost_other'] ?? $record->cost_other ?? 0);

            $landBank = \App\Models\LandBank::firstOrNew(['name' => $record->land_name]);
            $landBank->fill([
                'name'              => $record->land_name,
                'area'              => $record->area,
                'remaining_area'    => $landBank->exists ? $landBank->remaining_area : $record->area,
                'acquisition_price' => $finalGrandTotal > 0 ? $finalGrandTotal : $finalDealPrice,
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
            $record->load(['payments', 'notaris']);
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
        $user = auth()->user();
        $userPosId = (int) ($user->position_id ?? 0);
        $userRole = strtolower($user->role ?? '');
        $isAdmin = in_array($userPosId, [1, 5]) || $userRole === 'admin';
        $isKeuangan = in_array($userPosId, [7]) || str_contains($userRole, 'keuangan') || str_contains($userRole, 'finance');

        if (!$isAdmin && !$isKeuangan) {
            abort(403, 'Akses ditolak. Cetak dan pratinjau invoice hanya dapat diakses oleh Admin dan Divisi Keuangan.');
        }

        $land = PraLandbank::with(['payments', 'documents.documentType', 'notaris'])->findOrFail($id);
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

        // Hitung tanah yang memiliki dokumen tambahan / belum lengkap menunggu verifikasi Kepala Legal (berdasarkan kategori alas hak)
        $landsWithPendingDocsCount = 0;
        foreach ($praLandBank as $item) {
            $rawStatus = strtoupper($item->ownership_status ?? 'SHM');
            if (str_contains($rawStatus, 'APHB')) {
                $cat = 'APHB';
            } elseif (str_contains($rawStatus, 'WARIS')) {
                $cat = 'WARISAN';
            } elseif (str_contains($rawStatus, 'PETOK') || str_contains($rawStatus, 'GIRIK') || str_contains($rawStatus, 'LETTER')) {
                $cat = 'PETOK_C';
            } elseif (str_contains($rawStatus, 'AJB') || str_contains($rawStatus, 'HIBAH')) {
                $cat = 'AJB';
            } else {
                $cat = 'SHM';
            }

            $catDocTypeIds = $documentTypes->filter(function($dt) use ($cat) {
                $c = $dt->applicable_categories ?? [];
                return empty($c) || in_array($cat, $c);
            })->pluck('id')->toArray();

            $totalRequired = count($catDocTypeIds);
            $verifiedDocs = $item->documents->whereIn('document_type_id', $catDocTypeIds)->where('status', 'verified')->count();
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
            $land = PraLandbank::with(['documents.documentType', 'notaris'])->findOrFail($id);

            // Jika mencoba akses step=2 atau step=3 padahal dokumen belum diverifikasi sah oleh Kepala Legal
            if ($request->has('step') && (int)$request->step > 1 && !in_array($land->status, ['approved', 'rejected'])) {
                $rawStatus = strtoupper((string)($land->ownership_status ?? ''));
                if (str_contains($rawStatus, 'APHB')) {
                    $category = 'APHB';
                } elseif (str_contains($rawStatus, 'WARIS')) {
                    $category = 'WARISAN';
                } elseif (str_contains($rawStatus, 'PETOK') || str_contains($rawStatus, 'GIRIK') || str_contains($rawStatus, 'LETTER')) {
                    $category = 'PETOK_C';
                } elseif (str_contains($rawStatus, 'AJB') || str_contains($rawStatus, 'HIBAH')) {
                    $category = 'AJB';
                } elseif (!empty($rawStatus)) {
                    $category = 'SHM';
                } else {
                    $category = '';
                }

                $applicableDocs = $land->documents->filter(function($d) use ($category) {
                    $cats = $d->documentType->applicable_categories ?? [];
                    return empty($cats) || in_array($category, $cats);
                });

                $totalUploaded = $applicableDocs->whereNotNull('file_path')->count();
                $totalVerified = $applicableDocs->where('status', 'verified')->whereNotNull('file_path')->count();
                $isLegalSah = !empty($category) && $totalUploaded > 0 && ($totalUploaded === $totalVerified);

                $currentUser = auth()->user();
                $userPositionName = strtolower($currentUser->position->name ?? '');
                $userDivisionName = strtolower($currentUser->division->name ?? ($currentUser->position->division->name ?? ''));
                $userPositionId = $currentUser->position_id ?? null;
                $isAdmin = ($userPositionId == 5) || str_contains($userPositionName, 'admin');
                $isKeuangan = ($userPositionId == 7) || str_contains($userPositionName, 'keuangan') || str_contains($userPositionName, 'finance') || str_contains($userDivisionName, 'keuangan') || str_contains($userDivisionName, 'finance');

                if (!$isLegalSah && !$isAdmin && !$isKeuangan) {
                    return redirect()->route('pra-landbank.proses', ['id' => $id, 'step' => 1])
                        ->with('warning', 'Akses ke Fase 2 belum dapat dibuka. Dokumen legalitas di Fase 1 harus diverifikasi dan disahkan terlebih dahulu oleh Kepala Legal.');
                }
            }
        }
        $documentTypes = DocumentTypes::all();
        $notarisList   = \App\Models\Notaris::where('is_active', true)->orderBy('nama_notaris', 'asc')->get();
        return view('land_bank.proses_pra_land_bank', compact('land', 'documentTypes', 'notarisList'));
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

        $praLandbank = PraLandbank::with('documents.documentType')->find($doc->pra_landbank_id);
        $autoAdvanced = false;

        if ($praLandbank) {
            $rawStatus = strtoupper($praLandbank->ownership_status ?? 'SHM');
            if (str_contains($rawStatus, 'APHB')) {
                $category = 'APHB';
            } elseif (str_contains($rawStatus, 'WARIS')) {
                $category = 'WARISAN';
            } elseif (str_contains($rawStatus, 'PETOK') || str_contains($rawStatus, 'GIRIK') || str_contains($rawStatus, 'LETTER')) {
                $category = 'PETOK_C';
            } elseif (str_contains($rawStatus, 'AJB') || str_contains($rawStatus, 'HIBAH')) {
                $category = 'AJB';
            } else {
                $category = 'SHM';
            }

            $allDocs = $praLandbank->documents;
            // Filter hanya dokumen yang berlaku untuk kategori alas hak tanah ini
            $applicableDocs = $allDocs->filter(function($d) use ($category) {
                $cats = $d->documentType->applicable_categories ?? [];
                return empty($cats) || in_array($category, $cats);
            });

            $totalUploaded = $applicableDocs->whereNotNull('file_path')->count();
            $totalVerified = $applicableDocs->where('status', 'verified')->whereNotNull('file_path')->count();

            if ($totalUploaded > 0 && $totalUploaded === $totalVerified) {
                if ($praLandbank->status === 'fase1' || $praLandbank->status === 'pending') {
                    $praLandbank->update([
                        'status'       => 'fase2',
                        'legal_status' => 'clear'
                    ]);
                    $autoAdvanced = true;
                } elseif ($praLandbank->legal_status !== 'clear') {
                    $praLandbank->update([
                        'legal_status' => 'clear'
                    ]);
                }
            }
        }

        if (request()->ajax() || request()->wantsJson()) {
            return response()->json([
                'success'                => true,
                'message'                => 'Dokumen berhasil disetujui & diverifikasi oleh Kepala Legal!',
                'status'                 => 'verified',
                'auto_advanced_to_fase2' => $autoAdvanced,
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

    /**
     * Upload Berkas Notaris (Kwitansi, Bukti PPh, Akta Pelepasan) secara Instan via AJAX
     */
    public function uploadNotaryDoc(Request $request, $id)
    {
        $request->validate([
            'file_field' => 'required|string|in:receipt_file,tax_pph_file,release_deed_file',
            'file'       => 'required|file|mimes:pdf,jpg,jpeg,png|max:20480',
        ]);

        $record = PraLandbank::findOrFail($id);
        $fileField = $request->file_field;
        $file = $request->file('file');

        $prefix = match($fileField) {
            'receipt_file'      => 'kwitansi_',
            'tax_pph_file'      => 'pph_',
            'release_deed_file' => 'akta_pelepasan_',
            default             => 'notaris_'
        };

        $filename = uniqid() . '_' . $prefix . $file->getClientOriginalName();
        $destination = public_path('uploads/pra_landbank/' . $record->id . '/transaksi');
        if (!file_exists($destination)) {
            mkdir($destination, 0755, true);
        }
        $file->move($destination, $filename);
        $filePath = 'uploads/pra_landbank/' . $record->id . '/transaksi/' . $filename;

        $record->update([
            $fileField => $filePath
        ]);

        $cleanPath = str_replace('uploads/', '', $filePath);
        $previewUrl = route('dokumen.preview', ['path' => $cleanPath]);
        $docLabel = match($fileField) {
            'receipt_file'      => 'Kwitansi Pembayaran Bermaterai',
            'tax_pph_file'      => 'Bukti Pembayaran Pajak PPh',
            'release_deed_file' => 'Salinan Akta Pelepasan Hak',
            default             => 'Berkas Transaksi Notaris'
        };

        return response()->json([
            'success'      => true,
            'message'      => 'Berkas ' . $docLabel . ' berhasil diunggah!',
            'file_field'   => $fileField,
            'file_path'    => $filePath,
            'filename'     => basename($filePath),
            'preview_url'  => $previewUrl,
            'doc_label'    => $docLabel,
            'ext'          => $file->getClientOriginalExtension(),
        ]);
    }

    /**
     * Update Pilihan Notaris Rekanan & Jadwal Akta secara Instan via AJAX
     */
    public function updateNotaryInfo(Request $request, $id)
    {
        $record = PraLandbank::findOrFail($id);
        $data = [];
        if ($request->has('notaris_id')) {
            $data['notaris_id'] = $request->notaris_id ?: null;
        }
        if ($request->has('notary_appointment_date')) {
            $dateVal = $request->notary_appointment_date;
            if (!empty($dateVal)) {
                try {
                    $data['notary_appointment_date'] = \Carbon\Carbon::parse($dateVal)->format('Y-m-d H:i:s');
                } catch (\Exception $e) {
                    $data['notary_appointment_date'] = null;
                }
            } else {
                $data['notary_appointment_date'] = null;
            }
        }

        $record->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Data Notaris Rekanan & Jadwal Tanda Tangan Akta berhasil disimpan!',
        ]);
    }

    /**
     * Upload Berkas Alur Pengindukan & Perizinan (Poin 7 s/d 17) via AJAX Instan
     */
    public function uploadWorkflowDoc(Request $request, $id)
    {
        $allowedFields = [
            'desa_doc_file',
            'kecamatan_doc_file',
            'pertek_file',
            'peta_bidang_file',
            'pkkpr_file',
            'polygon_shp_file',
            'sk_hgb_file',
            'pbb_mutasi_file',
            'bphtb_validasi_file',
            'shgb_induk_file'
        ];

        $request->validate([
            'file_field' => 'required|string|in:' . implode(',', $allowedFields),
            'file'       => 'required|file|max:25600',
        ]);

        $record = PraLandbank::findOrFail($id);
        $fileField = $request->file_field;
        $file = $request->file('file');

        $labels = [
            'desa_doc_file'       => 'Blangko Permohonan Kelurahan',
            'kecamatan_doc_file'  => 'Blangko Permohonan Kecamatan',
            'pertek_file'         => 'Pertimbangan Teknis (PERTEK) BPN',
            'peta_bidang_file'    => 'Peta Bidang & Pengukuran BPN',
            'pkkpr_file'          => 'Persetujuan PKKPR OSS RBA',
            'polygon_shp_file'    => 'File Peta Polygon SHP/KML',
            'sk_hgb_file'         => 'SK HGB Badan Hukum BPN',
            'pbb_mutasi_file'     => 'SPPT PBB Mutasi Bapenda',
            'bphtb_validasi_file' => 'Bukti Validasi Pajak BPHTB',
            'shgb_induk_file'     => 'Sertifikat SHGB Induk an. PT'
        ];

        $docLabel = $labels[$fileField] ?? 'Berkas Perizinan';
        $prefix = str_replace('_file', '', $fileField) . '_';
        $filename = uniqid() . '_' . $prefix . $file->getClientOriginalName();
        $destination = public_path('uploads/pra_landbank/' . $record->id . '/pengindukan');
        
        if (!file_exists($destination)) {
            mkdir($destination, 0755, true);
        }
        $file->move($destination, $filename);
        $filePath = 'uploads/pra_landbank/' . $record->id . '/pengindukan/' . $filename;

        $record->update([
            $fileField => $filePath
        ]);

        $cleanPath = str_replace('uploads/', '', $filePath);
        $previewUrl = route('dokumen.preview', ['path' => $cleanPath]);

        return response()->json([
            'success'      => true,
            'message'      => 'Berkas ' . $docLabel . ' berhasil diunggah!',
            'file_field'   => $fileField,
            'file_path'    => $filePath,
            'filename'     => basename($filePath),
            'preview_url'  => $previewUrl,
            'doc_label'    => $docLabel,
            'ext'          => $file->getClientOriginalExtension(),
        ]);
    }

    /**
     * Upload Dokumen Tambahan Dinamis Fase 4 via AJAX
     */
    public function uploadCustomWorkflowDoc(Request $request, $id)
    {
        $request->validate([
            'doc_name'   => 'required|string|max:255',
            'doc_number' => 'nullable|string|max:255',
            'doc_date'   => 'nullable|date',
            'notes'      => 'nullable|string|max:500',
            'file'       => 'nullable|file|max:25600',
        ]);

        $record = PraLandbank::findOrFail($id);
        $docId = $request->input('doc_id') ?: ('doc_' . uniqid());
        $currentDocs = $record->custom_workflow_docs ?: [];

        $filePath = null;
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = uniqid() . '_custom_' . $file->getClientOriginalName();
            $destination = public_path('uploads/pra_landbank/' . $record->id . '/pengindukan');

            if (!file_exists($destination)) {
                mkdir($destination, 0755, true);
            }
            $file->move($destination, $filename);
            $filePath = 'uploads/pra_landbank/' . $record->id . '/pengindukan/' . $filename;
        }

        // Cari apakah update item yang sudah ada atau tambah baru
        $existingIndex = -1;
        foreach ($currentDocs as $index => $item) {
            if (($item['id'] ?? '') === $docId) {
                $existingIndex = $index;
                break;
            }
        }

        if ($existingIndex >= 0) {
            $item = $currentDocs[$existingIndex];
            $currentDocs[$existingIndex] = [
                'id'         => $docId,
                'doc_name'   => $request->doc_name,
                'doc_number' => $request->doc_number,
                'doc_date'   => $request->doc_date,
                'notes'      => $request->notes,
                'file_path'  => $filePath ?: ($item['file_path'] ?? null),
                'updated_at' => now()->toDateTimeString(),
            ];
        } else {
            $currentDocs[] = [
                'id'         => $docId,
                'doc_name'   => $request->doc_name,
                'doc_number' => $request->doc_number,
                'doc_date'   => $request->doc_date,
                'notes'      => $request->notes,
                'file_path'  => $filePath,
                'created_at' => now()->toDateTimeString(),
            ];
        }

        $record->update([
            'custom_workflow_docs' => $currentDocs
        ]);

        $savedDoc = [
            'id'         => $docId,
            'doc_name'   => $request->doc_name,
            'doc_number' => $request->doc_number,
            'doc_date'   => $request->doc_date,
            'notes'      => $request->notes,
            'file_path'  => $filePath ?: ($existingIndex >= 0 ? ($currentDocs[$existingIndex]['file_path'] ?? null) : null),
        ];

        return response()->json([
            'success'     => true,
            'message'     => 'Dokumen ' . $request->doc_name . ' berhasil disimpan!',
            'doc'         => $savedDoc,
            'doc_id'      => $docId,
            'doc_name'    => $request->doc_name,
            'file_path'   => $filePath,
            'filename'    => $filePath ? basename($filePath) : null,
            'preview_url' => $previewUrl,
            'docs'        => $currentDocs,
        ]);
    }

    /**
     * Hapus Dokumen Tambahan Dinamis Fase 4 via AJAX
     */
    public function deleteCustomWorkflowDoc(Request $request, $id)
    {
        $request->validate([
            'doc_id' => 'required|string',
        ]);

        $record = PraLandbank::findOrFail($id);
        $docId = $request->doc_id;
        $currentDocs = $record->custom_workflow_docs ?: [];

        $newDocs = [];
        foreach ($currentDocs as $doc) {
            if (($doc['id'] ?? '') === $docId) {
                if (!empty($doc['file_path']) && file_exists(public_path($doc['file_path']))) {
                    @unlink(public_path($doc['file_path']));
                }
            } else {
                $newDocs[] = $doc;
            }
        }

        $record->update([
            'custom_workflow_docs' => $newDocs
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Dokumen tambahan berhasil dihapus!',
            'docs'    => $newDocs,
        ]);
    }

    /**
     * Auto-save Data Informasi Perizinan & Pengindukan (Poin 7 s/d 17) via AJAX
     */
    public function updateWorkflowInfo(Request $request, $id)
    {
        $record = PraLandbank::findOrFail($id);

        $fields = [
            'desa_reg_no', 'desa_reg_date',
            'kecamatan_reg_no', 'kecamatan_reg_date',
            'pertek_no', 'pertek_date',
            'peta_bidang_no', 'peta_bidang_date', 'peta_bidang_area',
            'pkkpr_no', 'pkkpr_date', 'pkkpr_status',
            'sk_hgb_no', 'sk_hgb_date',
            'pbb_mutasi_nop', 'pbb_mutasi_date',
            'bphtb_nominal', 'bphtb_payment_date', 'bphtb_billing_id', 'bphtb_approval_status',
            'shgb_induk_no', 'shgb_induk_date', 'shgb_induk_area', 'hgb_process_status'
        ];

        $data = [];
        foreach ($fields as $field) {
            if ($request->has($field)) {
                $val = $request->input($field);
                if (str_contains($field, '_date') && !empty($val)) {
                    try {
                        $data[$field] = \Carbon\Carbon::parse($val)->format('Y-m-d');
                    } catch (\Exception $e) {
                        $data[$field] = null;
                    }
                } elseif (in_array($field, ['peta_bidang_area', 'shgb_induk_area', 'bphtb_nominal'])) {
                    $clean = preg_replace('/[^0-9.]/', '', (string) $val);
                    $data[$field] = $clean !== '' ? (float) $clean : null;
                } else {
                    $data[$field] = $val !== '' ? $val : null;
                }
            }
        }

        if (!empty($data)) {
            $record->update($data);
        }

        return response()->json([
            'success' => true,
            'message' => 'Data alur pengindukan & perizinan berhasil disimpan!',
        ]);
    }

    /**
     * Finalisasi Lahan: Penerbitan SHGB Induk an. PT & Migrasi Otomatis ke Pasca Land Bank
     */
    public function finalizeToPascaLandbank(Request $request, $id)
    {
        $record = PraLandbank::findOrFail($id);

        // Validasi SHGB Induk
        $shgbNo = $request->shgb_induk_no ?: $record->shgb_induk_no;
        if (empty($shgbNo)) {
            return response()->json([
                'success' => false,
                'message' => 'Nomor SHGB Induk atas nama PT wajib diisi sebelum melakukan finalisasi ke Pasca Land Bank!'
            ], 422);
        }

        // Update data SHGB bila dikirim bersamaan
        if ($request->filled('shgb_induk_no')) {
            $record->shgb_induk_no = $request->shgb_induk_no;
        }
        if ($request->filled('shgb_induk_date')) {
            $record->shgb_induk_date = $request->shgb_induk_date;
        }
        if ($request->filled('shgb_induk_area')) {
            $record->shgb_induk_area = preg_replace('/[^0-9.]/', '', (string)$request->shgb_induk_area);
        }

        // Ambil ID profil perusahaan default
        $companyId = \App\Models\CompanyProfile::first()->id ?? 1;
        $totalArea = $record->shgb_induk_area ?: ($record->peta_bidang_area ?: $record->area);

        // Buat atau update data di LandBank (Pasca Land Bank)
        $landBank = null;
        if ($record->land_bank_id) {
            $landBank = \App\Models\LandBank::find($record->land_bank_id);
        }

        $landBankData = [
            'name'                      => $record->land_name,
            'company_profile_id'        => $companyId,
            'ceritificate_no'           => $shgbNo,
            'ownership_status'          => 'SHGB',
            'certificate_owner'         => 'PT. Developer Properti (Induk)',
            'area'                      => $totalArea,
            'remaining_area'            => $totalArea,
            'acquisition_price'         => $record->deal_price ?: ($record->offer_price ?: 0),
            'acquisition_date'          => $record->shgb_induk_date ?: now()->toDateString(),
            'address'                   => $record->address ?: '-',
            'village'                   => $record->village ?: '-',
            'district'                  => $record->district ?: '-',
            'city'                      => $record->city ?: '-',
            'province'                  => $record->province ?: '-',
            'zoning'                    => $record->zoning ?: '-',
            'road_width'                => $record->road_width ?: '-',
            'road_type'                 => $record->road_type ?: '-',
            'lat'                       => $record->lat,
            'lng'                       => $record->lng,
            'file_certificate'          => $record->shgb_induk_file ?: $record->file_certificate,
            'file_pbb'                  => $record->pbb_mutasi_file,
            'photo'                     => $record->photo,
            'denah'                     => $record->peta_bidang_file,
            'status'                    => 'aktif',
            'legal_status'              => 'aman',
            'statusKavling'             => 'belum_pecah',
            'description'               => 'Tanah Induk resmi hasil pengindukan Pra Land Bank #' . $record->id . ' (' . $record->land_name . ')',
        ];

        if ($landBank) {
            $landBank->update($landBankData);
        } else {
            $landBank = \App\Models\LandBank::create($landBankData);
        }

        // Hubungkan pra_landbank ke land_bank
        $record->update([
            'land_bank_id'       => $landBank->id,
            'status'             => 'approved',
            'hgb_process_status' => 'completed_hgb_induk'
        ]);

        return response()->json([
            'success'      => true,
            'message'      => 'Selamat! Lahan ' . $record->land_name . ' resmi diterbitkan SHGB Induk an. PT dan beralih status menjadi Tanah Pasca Land Bank Aktif!',
            'land_bank_id' => $landBank->id,
            'redirect_url' => route('properti-all'),
        ]);
    }

    /**
     * Helper untuk memproses penyimpanan & upload dokumen legalitas (Fase 1 / Fase 2)
     */
    private function processDocuments(Request $request, PraLandbank $record)
    {
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
    }
}
