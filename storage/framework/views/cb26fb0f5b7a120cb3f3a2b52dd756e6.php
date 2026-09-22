<?php
    $allowedCategories = [];
    if ($phase == 1) {
        $allowedCategories = ['Pematangan Lahan', 'Alat Berat & Sewa', 'Upah Tenaga Kerja', 'Lain-lain'];
    } elseif ($phase == 2) {
        $allowedCategories = ['Drainase & Sanitasi', 'Aksesibilitas Jalan', 'Alat Berat & Sewa', 'Upah Tenaga Kerja', 'Lain-lain'];
    } elseif ($phase == 3) {
        $allowedCategories = ['PJU & Penerangan', 'Jaringan Air Bersih', 'Jaringan Listrik & Gerbang', 'Upah Tenaga Kerja', 'Lain-lain'];
    }

    if (!empty($allowedCategories)) {
        $priorityMaterials = $masterMaterials->filter(function($item) use ($allowedCategories) {
            return in_array($item->category, $allowedCategories);
        })->groupBy('category');

        $otherMaterials = $masterMaterials->filter(function($item) use ($allowedCategories) {
            return !in_array($item->category, $allowedCategories);
        })->groupBy('category');
    } else {
        $priorityMaterials = $masterMaterials->groupBy('category');
        $otherMaterials = collect();
    }
?>

<!-- Inline Multi-Item Expense Form for Phase <?php echo e($phase); ?> -->
<div class="card border-0 shadow-sm rounded-3 mb-4 d-none" id="inlineExpenseForm_Phase<?php echo e($phase); ?>" style="background: #f8faff; border: 1px solid #eef2f6 !important;">
    <div class="card-body p-3 p-md-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h6 class="fw-bold text-primary mb-0">
                    Catat Transaksi Belanja Bahan / Nota - <?php echo e($phaseData[$phase]['title'] ?? 'Tahapan ' . $phase); ?>

                </h6>
                <small class="text-muted">Pilih bahan dari <strong>Master Barang</strong> atau ketik langsung jika ada kebutuhan baru.</small>
            </div>
            <button type="button" class="btn-close" onclick="toggleInlineAddExpense(<?php echo e($phase); ?>)"></button>
        </div>

        <form action="<?php echo e(route('properti.infrastruktur.expense.store', $land->id)); ?>" method="POST" enctype="multipart/form-data" id="multiExpenseForm_<?php echo e($phase); ?>">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="phase" value="<?php echo e($phase); ?>">
            <input type="hidden" name="land_bank_infrastructure_id" id="selectedInfraId_<?php echo e($phase); ?>" value="">

            <!-- Pos Terpilih Banner -->
            <div class="p-2 px-3 rounded-3 border mb-3 d-flex justify-content-between align-items-center bg-white" id="selectedPosNotice_<?php echo e($phase); ?>">
                <div class="d-flex align-items-center gap-2">
                    <span class="badge bg-soft-primary text-primary px-2 py-1 rounded-2 small fw-bold">Pos Pekerjaan:</span>
                    <span class="small text-dark fw-bold" id="selectedPosName_<?php echo e($phase); ?>">- Seluruh Pos <?php echo e($phaseData[$phase]['title'] ?? 'Tahapan ' . $phase); ?> (Umum) -</span>
                </div>
                <button type="button" class="btn btn-sm btn-light border text-secondary rounded-2 px-3 py-1 fw-semibold shadow-sm" onclick="resetSelectedPos(<?php echo e($phase); ?>)" title="Ganti ke Umum" style="font-size: 0.75rem;">
                    Reset ke Umum
                </button>
            </div>

            <!-- Informational Header of the Receipt -->
            <div class="p-3 bg-white rounded-3 border mb-3">
                <h6 class="small fw-bold text-dark mb-2">Data Transaksi & Nota:</h6>
                <div class="row g-2">
                    <div class="col-md-3">
                        <label class="small text-muted fw-bold mb-1">Tanggal Belanja</label>
                        <input type="date" name="expense_date" class="form-control form-control-sm" value="<?php echo e(date('Y-m-d')); ?>">
                    </div>
                    <div class="col-md-3">
                        <label class="small text-muted fw-bold mb-1">Toko / Vendor / Supplier</label>
                        <input type="text" name="vendor_name" class="form-control form-control-sm" placeholder="Nama Toko Bangunan / Mandor">
                    </div>
                    <div class="col-md-2">
                        <label class="small text-muted fw-bold mb-1">Metode Bayar</label>
                        <select name="payment_method" class="form-select form-select-sm">
                            <option value="Cash">Cash / Tunai</option>
                            <option value="Transfer Bank">Transfer Bank</option>
                            <option value="Tempo / Hutang Vendor">Tempo / Hutang</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="small text-muted fw-bold mb-1">Status Bayar</label>
                        <select name="payment_status" class="form-select form-select-sm">
                            <option value="Lunas">Lunas</option>
                            <option value="Belum Lunas">Belum Lunas (Tempo)</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="small text-muted fw-bold mb-1">Upload Bukti Nota</label>
                        <div class="properti-file-upload-modern">
                            <input type="file" name="receipt_proof" id="receipt_proof_<?php echo e($phase); ?>" accept=".pdf,.jpg,.jpeg,.png" data-type-name="Bukti Nota">
                            <div class="properti-file-label-modern py-1 px-2">
                                <i class="mdi mdi-cloud-upload"></i>
                                <div class="properti-file-info-modern">
                                    <span class="file-title-text small">Upload Nota Belanja</span>
                                    <small class="file-sub-text text-muted" style="font-size: 0.7rem;">PDF, JPG, PNG (Max: 2MB)</small>
                                </div>
                                <span class="properti-file-size"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <label class="small text-muted fw-bold mb-1">Catatan Transaksi</label>
                        <input type="text" name="notes" class="form-control form-control-sm" placeholder="Catatan transaksi / nomor nota (opsional)..." style="height: 38px;">
                    </div>
                </div>
            </div>

            <!-- Multi-Item Material Rows Table -->
            <div class="bg-white rounded-3 border p-3 mb-3">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h6 class="small fw-bold text-dark mb-0">
                        Daftar Bahan / Material yang Dibelanjakan:
                    </h6>
                    <button type="button" class="btn btn-sm btn-primary text-white px-3 rounded-2 shadow-sm fw-semibold" onclick="addNewMaterialRow(<?php echo e($phase); ?>)" style="font-size: 0.78rem;">
                        + Tambah Baris Bahan Lain
                    </button>
                </div>

                <div class="table-responsive">
                    <table class="table table-sm table-bordered align-middle mb-0" id="tableMultiItems_<?php echo e($phase); ?>" style="min-width: 750px;">
                        <thead class="bg-light small text-muted text-center">
                            <tr>
                                <th style="width: 30%;">Pilih dari Master / Nama Bahan</th>
                                <th style="width: 15%;">Kategori</th>
                                <th style="width: 12%;">Qty / Volume</th>
                                <th style="width: 10%;">Satuan</th>
                                <th style="width: 15%;">Harga Satuan (Rp)</th>
                                <th style="width: 14%;">Subtotal (Rp)</th>
                                <th style="width: 4%;">#</th>
                            </tr>
                        </thead>
                        <tbody id="multiItemBody_<?php echo e($phase); ?>">
                            <!-- Initial Row 0 -->
                            <tr id="rowItem_<?php echo e($phase); ?>_0" data-row-idx="0">
                                <td>
                                    <!-- Select Master or Custom Input -->
                                    <div class="d-flex flex-column gap-1">
                                        <select class="form-control form-control-sm select2 select-master-item-row" data-phase="<?php echo e($phase); ?>" data-row-idx="0" onchange="onSelectRowMaterial(this, <?php echo e($phase); ?>, 0)" style="width: 100%;">
                                            <option value="">-- Cari / Pilih dari Master Bahan --</option>
                                            <?php $__currentLoopData = $priorityMaterials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $catName => $items): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <optgroup label="📂 <?php echo e($catName); ?>">
                                                    <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($mm->id); ?>"
                                                                data-name="<?php echo e($mm->name); ?>"
                                                                data-category="<?php echo e($mm->category); ?>"
                                                                data-unit="<?php echo e($mm->unit); ?>"
                                                                data-price="<?php echo e($mm->default_price); ?>">
                                                            <?php echo e($mm->name); ?> (Rp <?php echo e(number_format($mm->default_price, 0, ',', '.')); ?>/<?php echo e($mm->unit); ?>)
                                                        </option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </optgroup>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($otherMaterials->isNotEmpty()): ?>
                                                <?php $__currentLoopData = $otherMaterials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $catName => $items): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <optgroup label="📂 <?php echo e($catName); ?> (Lainnya)">
                                                        <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($mm->id); ?>"
                                                                    data-name="<?php echo e($mm->name); ?>"
                                                                    data-category="<?php echo e($mm->category); ?>"
                                                                    data-unit="<?php echo e($mm->unit); ?>"
                                                                    data-price="<?php echo e($mm->default_price); ?>">
                                                                <?php echo e($mm->name); ?> (Rp <?php echo e(number_format($mm->default_price, 0, ',', '.')); ?>/<?php echo e($mm->unit); ?>)
                                                            </option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </optgroup>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        </select>
                                        <input type="hidden" name="items[0][material_id]" id="inputMatId_<?php echo e($phase); ?>_0">
                                        <input type="text" name="items[0][item_name]" id="inputItemName_<?php echo e($phase); ?>_0" class="form-control form-control-sm" placeholder="Nama Bahan / Jasa *" required>
                                    </div>
                                </td>
                                <td>
                                    <input type="text" name="items[0][category]" id="inputCat_<?php echo e($phase); ?>_0" class="form-control form-control-sm" placeholder="Kategori">
                                </td>
                                <td>
                                    <input type="number" step="any" name="items[0][quantity]" id="inputQty_<?php echo e($phase); ?>_0" class="form-control form-control-sm text-end" value="1" min="0.01" required oninput="calcMultiRowTotal(<?php echo e($phase); ?>, 0)">
                                </td>
                                <td>
                                    <input type="text" name="items[0][unit]" id="inputUnit_<?php echo e($phase); ?>_0" class="form-control form-control-sm text-center" placeholder="sak, m3" required>
                                </td>
                                <td>
                                    <input type="text" name="items[0][unit_price]" id="inputPrice_<?php echo e($phase); ?>_0" class="form-control form-control-sm text-end price-format" placeholder="0" required oninput="calcMultiRowTotal(<?php echo e($phase); ?>, 0)">
                                </td>
                                <td>
                                    <input type="text" id="displayRowSubtotal_<?php echo e($phase); ?>_0" class="form-control form-control-sm text-end fw-bold text-danger bg-light" value="Rp 0" readonly>
                                </td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-sm btn-link text-danger p-0" onclick="removeMaterialRow(<?php echo e($phase); ?>, 0)" title="Hapus baris">
                                        <i class="mdi mdi-close-circle fs-5"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr class="bg-light">
                                <td colspan="5" class="text-end fw-bold text-dark small py-2">
                                    TOTAL KESELURUHAN NOTA:
                                </td>
                                <td colspan="2" class="text-end pe-3 py-2">
                                    <strong class="text-danger fs-6" id="grandTotalNotaDisplay_<?php echo e($phase); ?>">Rp 0</strong>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

            <!-- Master Material Template Hidden Options for Dynamic Rows -->
            <template id="masterOptionsTemplate_<?php echo e($phase); ?>">
                <option value="">-- Pilih dari Master Barang / Bahan --</option>
                <?php $__currentLoopData = $priorityMaterials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $catName => $items): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <optgroup label="📂 <?php echo e($catName); ?>">
                        <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($mm->id); ?>"
                                    data-name="<?php echo e($mm->name); ?>"
                                    data-category="<?php echo e($mm->category); ?>"
                                    data-unit="<?php echo e($mm->unit); ?>"
                                    data-price="<?php echo e($mm->default_price); ?>">
                                <?php echo e($mm->name); ?> (Rp <?php echo e(number_format($mm->default_price, 0, ',', '.')); ?>/<?php echo e($mm->unit); ?>)
                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </optgroup>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php if($otherMaterials->isNotEmpty()): ?>
                    <?php $__currentLoopData = $otherMaterials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $catName => $items): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <optgroup label="📂 <?php echo e($catName); ?> (Lainnya)">
                            <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($mm->id); ?>"
                                        data-name="<?php echo e($mm->name); ?>"
                                        data-category="<?php echo e($mm->category); ?>"
                                        data-unit="<?php echo e($mm->unit); ?>"
                                        data-price="<?php echo e($mm->default_price); ?>">
                                    <?php echo e($mm->name); ?> (Rp <?php echo e(number_format($mm->default_price, 0, ',', '.')); ?>/<?php echo e($mm->unit); ?>)
                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </optgroup>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            </template>

            <div class="d-flex flex-column flex-sm-row justify-content-end gap-2 pt-2 border-top">
                <button type="button" class="btn btn-sm btn-secondary rounded-2 px-3 order-2 order-sm-1" onclick="toggleInlineAddExpense(<?php echo e($phase); ?>)">Batal</button>
                <button type="submit" class="btn btn-sm btn-gradient-primary rounded-2 px-4 shadow-sm order-1 order-sm-2">
                    Simpan Semua Belanja Bahan
                </button>
            </div>
        </form>
    </div>
</div>
    <?php /**PATH D:\Property-Management-Web-App\resources\views/properti/partials/inline_expense_form.blade.php ENDPATH**/ ?>