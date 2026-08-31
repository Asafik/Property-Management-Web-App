<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LandBank;
use App\Models\LandBankInfrastructure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LandBankInfrastructureController extends Controller
{
    /**
     * Display dedicated Pengolahan Lahan blade page
     */
    public function index($land_bank_id)
    {
        $land = LandBank::with(['infrastructures.expenses', 'expenses.masterMaterial'])->findOrFail($land_bank_id);

        // Auto-initialize default items if empty
        if ($land->infrastructures->isEmpty()) {
            $land->initializeDefaultInfrastructures();
            $land->load('infrastructures');
        }

        // Auto-initialize default master materials if empty
        if (\App\Models\InfrastructureMaterial::count() === 0) {
            \App\Models\InfrastructureMaterial::seedDefaultMaterials();
        }

        $infrastructures = $land->infrastructures;
        $expenses = $land->expenses()->with(['infrastructure', 'masterMaterial', 'recorder'])->latest('expense_date')->get();
        $masterMaterials = \App\Models\InfrastructureMaterial::where('is_active', true)->orderBy('category')->orderBy('name')->get();

        // Dynamic Global Phase Aggregation (Berlaku untuk SEMUA Land Bank)
        $allGlobalPhases = \App\Models\LandBankInfrastructure::pluck('phase')->unique()->filter()->values();
        $maxPhase = max(3, $allGlobalPhases->isEmpty() ? 3 : $allGlobalPhases->max());
        $allPhaseNumbers = collect(range(1, $maxPhase));

        $phaseTitles = [
            1 => ['title' => 'Cut & Fill & Pemadatan', 'subtitle' => 'Perataan, Cut & Fill & Pemadatan Tanah Sub-grade'],
            2 => ['title' => 'Drainase & Jalan Kawasan', 'subtitle' => 'Pembangunan Selokan U-Ditch, Paving & Aspal'],
            3 => ['title' => 'Utilitas & Fasilitas', 'subtitle' => 'PJU, Jaringan Air Bersih, Listrik & Gerbang Kawasan'],
        ];

        $phaseData = [];
        foreach ($allPhaseNumbers as $ph) {
            $items = $infrastructures->where('phase', $ph);
            $globalCategory = \App\Models\LandBankInfrastructure::where('phase', $ph)->whereNotNull('category')->where('category', '!=', '')->value('category');
            $firstCat = $items->first()->category ?? $globalCategory;
            $title = $phaseTitles[$ph]['title'] ?? ($firstCat ? "{$firstCat}" : "Tahapan {$ph}");
            $subtitle = $phaseTitles[$ph]['subtitle'] ?? "Pekerjaan konstruksi dan pematangan lahan lanjutan {$title}.";

            $phaseData[$ph] = [
                'phase'    => $ph,
                'title'    => $title,
                'subtitle' => $subtitle,
                'items'    => $items,
                'progress' => $land->getPhaseProgress($ph),
                'status'   => $land->getPhaseStatus($ph),
                'expenses' => $expenses->where('phase', $ph),
            ];
        }

        // Backward compatibility individual phase variables
        $fase1Items = $infrastructures->where('phase', 1);
        $fase2Items = $infrastructures->where('phase', 2);
        $fase3Items = $infrastructures->where('phase', 3);

        $fase1Progress = $land->getPhaseProgress(1);
        $fase2Progress = $land->getPhaseProgress(2);
        $fase3Progress = $land->getPhaseProgress(3);

        $fase1Status = $land->getPhaseStatus(1);
        $fase2Status = $land->getPhaseStatus(2);
        $fase3Status = $land->getPhaseStatus(3);

        $nextPhaseNum = $maxPhase + 1;

        // Financial Calculations
        $totalExpense = (float) $expenses->sum('total_amount');
        $totalLunas = (float) $expenses->where('payment_status', 'Lunas')->sum('total_amount');
        $totalHutang = (float) $expenses->where('payment_status', '!=', 'Lunas')->sum('total_amount');
        $totalEstimate = (float) $infrastructures->sum('cost_estimate');

        return view('properti.pengolahan_lahan', compact(
            'land', 
            'infrastructures', 
            'phaseData',
            'allPhaseNumbers',
            'nextPhaseNum',
            'fase1Items',
            'fase2Items',
            'fase3Items',
            'fase1Progress',
            'fase2Progress',
            'fase3Progress',
            'fase1Status',
            'fase2Status',
            'fase3Status',
            'expenses', 
            'masterMaterials', 
            'totalExpense', 
            'totalLunas', 
            'totalHutang', 
            'totalEstimate'
        ));
    }

    /**
     * Get infrastructure items for a LandBank project (AJAX)
     */
    public function getItems($land_bank_id)
    {
        $land = LandBank::with('infrastructures')->findOrFail($land_bank_id);
        
        // Auto-initialize default items if empty
        if ($land->infrastructures->isEmpty()) {
            $land->initializeDefaultInfrastructures();
            $land->load('infrastructures');
        }

        return response()->json([
            'success' => true,
            'land' => [
                'id' => $land->id,
                'name' => $land->name,
                'area' => $land->area,
                'development_status' => $land->development_status,
                'overall_progress' => $land->overall_infrastructure_progress,
                'can_create_kavling' => $land->canCreateKavling(),
            ],
            'items' => $land->infrastructures,
        ]);
    }

    /**
     * Store a new custom infrastructure item
     */
    public function store(Request $request, $land_bank_id)
    {
        $land = LandBank::findOrFail($land_bank_id);

        $request->validate([
            'item_name'        => 'required|string|max:255',
            'phase'            => 'required|integer|min:1',
            'new_phase_name'   => 'nullable|string|max:255',
            'category'         => 'nullable|string|max:100',
            'target_volume'    => 'nullable|numeric|min:0.01',
            'volume_unit'      => 'nullable|string|max:50',
            'bobot_persen'     => 'nullable|numeric|min:0|max:100',
            'progress_percent' => 'nullable|numeric|min:0|max:100',
            'contractor_name'  => 'nullable|string|max:255',
            'cost_estimate'    => 'nullable|numeric|min:0',
            'target_start'     => 'nullable|date',
            'target_end'       => 'nullable|date',
            'notes'            => 'nullable|string',
            'photo_proof'      => 'nullable|image|max:5120',
        ]);

        $progress = (float)($request->progress_percent ?? 0);
        $status = 'belum_mulai';
        if ($progress >= 100) {
            $status = 'selesai';
        } elseif ($progress > 0) {
            $status = 'proses';
        }

        $photoPath = null;
        if ($request->hasFile('photo_proof')) {
            $photoPath = $request->file('photo_proof')->store("uploads/landbank/{$land->id}/infrastructure", 'public');
        }

        $targetVolume = $request->filled('target_volume') ? (float)$request->target_volume : 100;
        $volumeUnit = $request->filled('volume_unit') ? $request->volume_unit : 'unit';
        $category = $request->category ?: ($request->new_phase_name ?: 'Pekerjaan Fisik');

        $item = $land->infrastructures()->create([
            'phase'            => (int)($request->phase ?? 1),
            'item_name'        => $request->item_name,
            'category'         => $category,
            'volume'           => number_format($targetVolume, 0, ',', '.') . ' ' . $volumeUnit,
            'target_volume'    => $targetVolume,
            'realized_volume'  => round(($progress / 100) * $targetVolume, 2),
            'volume_unit'      => $volumeUnit,
            'bobot_persen'     => (float)($request->bobot_persen ?? 25),
            'progress_percent' => $progress,
            'status'           => $status,
            'target_start'     => $request->target_start,
            'target_end'       => $request->target_end,
            'contractor_name'  => $request->contractor_name,
            'cost_estimate'    => $request->cost_estimate,
            'photo_proof'      => $photoPath,
            'notes'            => $request->notes,
        ]);

        $this->syncLandDevelopmentStatus($land);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => "Pos pekerjaan '{$item->item_name}' berhasil ditambahkan ke Fase {$item->phase}",
                'item' => $item,
                'overall_progress' => $land->fresh()->overall_infrastructure_progress,
                'development_status' => $land->fresh()->development_status,
            ]);
        }

        return back()->with('success', "Pos pekerjaan '{$item->item_name}' berhasil ditambahkan ke Fase {$item->phase}");
    }

    /**
     * Update an infrastructure item progress based on real field volume & documentation
     */
    public function update(Request $request, $id)
    {
        $item = LandBankInfrastructure::with('landBank')->findOrFail($id);
        $land = $item->landBank;

        $request->validate([
            'item_name'        => 'sometimes|required|string|max:255',
            'category'         => 'nullable|string|max:100',
            'volume'           => 'nullable|string|max:100',
            'target_volume'    => 'nullable|numeric|min:0.01',
            'realized_volume'  => 'nullable|numeric|min:0',
            'volume_unit'      => 'nullable|string|max:50',
            'bobot_persen'     => 'nullable|numeric|min:0|max:100',
            'progress_percent' => 'nullable|numeric|min:0|max:100',
            'status'           => 'nullable|in:belum_mulai,proses,selesai',
            'contractor_name'  => 'nullable|string|max:255',
            'cost_estimate'    => 'nullable|numeric|min:0',
            'log_date'         => 'nullable|date',
            'notes'            => 'nullable|string',
            'photo_proof'      => 'nullable|image|max:5120',
        ]);

        $targetVolume = $request->filled('target_volume') ? (float)$request->target_volume : (float)$item->target_volume;
        $realizedVolume = $request->filled('realized_volume') ? (float)$request->realized_volume : (float)$item->realized_volume;
        $volumeUnit = $request->input('volume_unit', $item->volume_unit ?? 'm³');

        // Calculate real percentage from volume if available
        if ($request->has('realized_volume') && $targetVolume > 0) {
            $progress = round(min(100, ($realizedVolume / $targetVolume) * 100), 1);
        } elseif ($request->has('progress_percent')) {
            $progress = (float)$request->progress_percent;
            $realizedVolume = round(($progress / 100) * $targetVolume, 2);
        } else {
            $progress = (float)$item->progress_percent;
        }

        $status = $request->status;
        if (!$status) {
            if ($progress >= 100 || $realizedVolume >= $targetVolume) {
                $status = 'selesai';
                $progress = 100;
            } elseif ($progress > 0 || $realizedVolume > 0) {
                $status = 'proses';
            } else {
                $status = 'belum_mulai';
            }
        }

        $data = [
            'target_volume'    => $targetVolume,
            'realized_volume'  => $realizedVolume,
            'volume_unit'      => $volumeUnit,
            'progress_percent' => $progress,
            'status'           => $status,
        ];

        if ($request->has('item_name')) $data['item_name'] = $request->item_name;
        if ($request->has('category')) $data['category'] = $request->category;
        if ($request->has('bobot_persen')) $data['bobot_persen'] = (float)$request->bobot_persen;
        if ($request->has('contractor_name')) $data['contractor_name'] = $request->contractor_name;
        if ($request->has('cost_estimate')) $data['cost_estimate'] = $request->cost_estimate;
        if ($request->has('target_start')) $data['target_start'] = $request->target_start;
        if ($request->has('target_end')) $data['target_end'] = $request->target_end;
        if ($request->has('notes')) $data['notes'] = $request->notes;

        $photoPath = null;
        if ($request->hasFile('photo_proof')) {
            if ($item->photo_proof && Storage::disk('public')->exists($item->photo_proof)) {
                Storage::disk('public')->delete($item->photo_proof);
            }
            $photoPath = $request->file('photo_proof')->store("uploads/landbank/{$land->id}/infrastructure", 'public');
            $data['photo_proof'] = $photoPath;
        }

        $item->update($data);

        // Record real progress log
        \App\Models\LandBankInfrastructureLog::create([
            'land_bank_infrastructure_id' => $item->id,
            'log_date'                    => $request->input('log_date', now()->toDateString()),
            'volume_achieved'             => $realizedVolume,
            'cumulative_volume'           => $realizedVolume,
            'progress_percent'            => $progress,
            'mandor_name'                 => $request->input('contractor_name', $item->contractor_name),
            'photo_documentation'         => $photoPath ?? $item->photo_proof,
            'notes'                       => $request->input('notes', $item->notes),
            'recorded_by'                 => auth()->id(),
        ]);

        $this->syncLandDevelopmentStatus($land);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => "Progres {$item->item_name} berhasil dicatat ({$realizedVolume} / {$targetVolume} {$volumeUnit} - {$progress}%)",
                'item' => $item->fresh(),
                'phase_progress' => $land->fresh()->getPhaseProgress($item->phase),
                'overall_progress' => $land->fresh()->overall_infrastructure_progress,
                'development_status' => $land->fresh()->development_status,
                'can_create_kavling' => $land->fresh()->canCreateKavling(),
            ]);
        }

        return back()->with('success', 'Progress pekerjaan berhasil diperbarui');
    }

    /**
     * Delete an infrastructure item
     */
    public function destroy(Request $request, $id)
    {
        $item = LandBankInfrastructure::with('landBank')->findOrFail($id);
        $land = $item->landBank;

        if ($item->photo_proof && Storage::disk('public')->exists($item->photo_proof)) {
            Storage::disk('public')->delete($item->photo_proof);
        }

        $item->delete();

        $this->syncLandDevelopmentStatus($land);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Item pekerjaan berhasil dihapus',
                'overall_progress' => $land->fresh()->overall_infrastructure_progress,
                'development_status' => $land->fresh()->development_status,
            ]);
        }

        return back()->with('success', 'Item pekerjaan berhasil dihapus');
    }

    /**
     * Finalize entire development or specific status
     */
    public function finalizeStatus(Request $request, $land_bank_id)
    {
        $land = LandBank::findOrFail($land_bank_id);

        $request->validate([
            'development_status' => 'required|string|in:Belum,Proses,Selesai'
        ]);

        $land->development_status = $request->development_status;

        if ($request->development_status === 'Selesai') {
            $land->infrastructures()->update([
                'progress_percent' => 100,
                'status'           => 'selesai'
            ]);
        }

        $land->save();

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => "Status pembangunan berhasil diubah menjadi {$request->development_status}",
                'development_status' => $land->development_status,
                'overall_progress' => $land->overall_infrastructure_progress,
                'can_create_kavling' => $land->canCreateKavling(),
            ]);
        }

        return back()->with('success', "Status pembangunan berhasil diubah menjadi {$request->development_status}");
    }

    /**
     * Finalize a specific Phase (1, 2, or 3)
     */
    public function finalizePhase(Request $request, $land_bank_id, $phase)
    {
        $land = LandBank::findOrFail($land_bank_id);
        $phaseNum = (int)$phase;

        $land->infrastructures()->where('phase', $phaseNum)->update([
            'progress_percent' => 100,
            'status'           => 'selesai'
        ]);

        $this->syncLandDevelopmentStatus($land);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => "Fase {$phaseNum} berhasil diselesaikan 100%!",
                'phase_progress' => $land->getPhaseProgress($phaseNum),
                'overall_progress' => $land->overall_infrastructure_progress,
                'can_create_kavling' => $land->canCreateKavling(),
            ]);
        }

        return back()->with('success', "Fase {$phaseNum} berhasil diselesaikan 100%!");
    }

    /**
     * Store new infrastructure expense / material usage (Supports multiple materials in 1 transaction/receipt)
     */
    public function storeExpense(Request $request, $land_bank_id)
    {
        $land = LandBank::findOrFail($land_bank_id);

        $receiptPath = null;
        if ($request->hasFile('receipt_proof')) {
            $file = $request->file('receipt_proof');
            $fileName = 'receipt_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $receiptPath = $file->storeAs('uploads/infrastructure_receipts', $fileName, 'public');
        }

        $infraId = $request->filled('land_bank_infrastructure_id') ? $request->land_bank_infrastructure_id : null;
        $phase = (int)($request->phase ?? 1);
        if ($infraId) {
            $infra = \App\Models\LandBankInfrastructure::find($infraId);
            if ($infra) $phase = $infra->phase;
        }

        $commonData = [
            'land_bank_id'                => $land->id,
            'land_bank_infrastructure_id' => $infraId,
            'phase'                       => $phase,
            'expense_date'                => $request->input('expense_date', now()->toDateString()),
            'vendor_name'                 => $request->input('vendor_name'),
            'payment_method'              => $request->input('payment_method', 'Cash'),
            'payment_status'              => $request->input('payment_status', 'Lunas'),
            'receipt_proof'               => $receiptPath,
            'recorded_by'                 => auth()->id(),
        ];

        // 1. If multi-item array provided
        if ($request->has('items') && is_array($request->items) && count($request->items) > 0) {
            $createdCount = 0;
            $baseCode = \App\Models\LandBankInfrastructureExpense::generateCode($land->id);

            foreach ($request->items as $idx => $row) {
                if (empty($row['item_name']) || empty($row['quantity'])) continue;

                $qty = (float)($row['quantity'] ?? 1);
                $price = (float)($row['unit_price'] ?? 0);
                $total = $qty * $price;

                $itemData = array_merge($commonData, [
                    'expense_code' => (count($request->items) > 1) ? "{$baseCode}-" . ($idx + 1) : $baseCode,
                    'material_id'  => !empty($row['material_id']) ? $row['material_id'] : null,
                    'item_name'    => $row['item_name'],
                    'category'     => $row['category'] ?? 'Material',
                    'quantity'     => $qty,
                    'unit'         => $row['unit'] ?? 'unit',
                    'unit_price'   => $price,
                    'total_amount' => $total,
                    'notes'        => !empty($row['notes']) ? $row['notes'] : $request->notes,
                ]);

                \App\Models\LandBankInfrastructureExpense::create($itemData);
                $createdCount++;
            }

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => "Berhasil mencatat {$createdCount} item belanja bahan dalam 1 transaksi nota.",
                ]);
            }

            return redirect()->back()->with('success', "Berhasil mencatat {$createdCount} item belanja bahan dalam 1 transaksi nota.");
        }

        // 2. Single item fallback
        $validated = $request->validate([
            'item_name'   => 'required|string|max:255',
            'category'    => 'nullable|string|max:100',
            'quantity'    => 'required|numeric|min:0.01',
            'unit'        => 'required|string|max:50',
            'unit_price'  => 'required|numeric|min:0',
        ]);

        $itemData = array_merge($commonData, [
            'expense_code' => \App\Models\LandBankInfrastructureExpense::generateCode($land->id),
            'material_id'  => $request->material_id,
            'item_name'    => $validated['item_name'],
            'category'     => $validated['category'] ?? 'Material',
            'quantity'     => (float)$validated['quantity'],
            'unit'         => $validated['unit'],
            'unit_price'   => (float)$validated['unit_price'],
            'total_amount' => (float)$validated['quantity'] * (float)$validated['unit_price'],
            'notes'        => $request->notes,
        ]);

        $expense = \App\Models\LandBankInfrastructureExpense::create($itemData);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Pencatatan pengeluaran bahan berhasil disimpan.',
                'expense' => $expense
            ]);
        }

        return redirect()->back()->with('success', 'Pencatatan pengeluaran bahan berhasil disimpan.');
    }

    /**
     * Update an infrastructure expense
     */
    public function updateExpense(Request $request, $id)
    {
        $expense = \App\Models\LandBankInfrastructureExpense::findOrFail($id);

        $validated = $request->validate([
            'land_bank_infrastructure_id' => 'nullable|exists:land_bank_infrastructures,id',
            'material_id'                 => 'nullable|exists:infrastructure_materials,id',
            'item_name'                   => 'required|string|max:255',
            'category'                    => 'nullable|string|max:100',
            'quantity'                    => 'required|numeric|min:0.01',
            'unit'                        => 'required|string|max:50',
            'unit_price'                  => 'required|numeric|min:0',
            'expense_date'                => 'nullable|date',
            'vendor_name'                 => 'nullable|string|max:255',
            'payment_method'              => 'nullable|string|max:100',
            'payment_status'              => 'nullable|string|in:Lunas,Belum Lunas',
            'receipt_proof'               => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:5120',
            'notes'                       => 'nullable|string',
        ]);

        $validated['total_amount'] = (float)$validated['quantity'] * (float)$validated['unit_price'];

        // Handle receipt update
        if ($request->hasFile('receipt_proof')) {
            if ($expense->receipt_proof && Storage::disk('public')->exists($expense->receipt_proof)) {
                Storage::disk('public')->delete($expense->receipt_proof);
            }
            $file = $request->file('receipt_proof');
            $fileName = 'receipt_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('uploads/infrastructure_receipts', $fileName, 'public');
            $validated['receipt_proof'] = $path;
        }

        $expense->update($validated);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Pengeluaran bahan berhasil diperbarui.',
                'expense' => $expense
            ]);
        }

        return redirect()->back()->with('success', 'Pengeluaran bahan berhasil diperbarui.');
    }

    /**
     * Delete an infrastructure expense
     */
    public function destroyExpense(Request $request, $id)
    {
        $expense = \App\Models\LandBankInfrastructureExpense::findOrFail($id);

        if ($expense->receipt_proof && Storage::disk('public')->exists($expense->receipt_proof)) {
            Storage::disk('public')->delete($expense->receipt_proof);
        }

        $expense->delete();

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Data pengeluaran bahan berhasil dihapus.'
            ]);
        }

        return redirect()->back()->with('success', 'Data pengeluaran bahan berhasil dihapus.');
    }

    /**
     * Helper to sync LandBank development_status based on overall progress
     */
    private function syncLandDevelopmentStatus(LandBank $land)
    {
        $progress = $land->fresh()->overall_infrastructure_progress;

        if ($progress >= 100) {
            $land->development_status = 'Selesai';
        } elseif ($progress > 0) {
            $land->development_status = 'Proses';
        } else {
            $land->development_status = 'Belum';
        }

        $land->save();
    }
}
