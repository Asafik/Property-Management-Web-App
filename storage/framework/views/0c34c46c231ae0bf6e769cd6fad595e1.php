<!-- Active Card Expense Filter Notification Banner -->
<div class="p-3 bg-white rounded-3 border mb-3 d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2 d-none" id="tableFilterBanner_<?php echo e($phase); ?>">
    <div class="d-flex align-items-center gap-2">
        <span class="badge bg-primary text-white rounded-2 px-2 py-1 small fw-bold">
            Filter Aktif
        </span>
        <span class="small text-dark">
            Menampilkan rincian nota belanja untuk: <strong class="text-primary fs-6" id="filterPosName_<?php echo e($phase); ?>">-</strong>
        </span>
    </div>
    <div class="d-flex align-items-center gap-2">
        <button type="button" class="btn btn-sm btn-secondary text-white rounded-2 px-3 py-1 fw-semibold shadow-sm" onclick="clearTableFilter(<?php echo e($phase); ?>)" style="font-size: 0.75rem;">
            Tampilkan Semua Belanja Fase <?php echo e($phase); ?>

        </button>
    </div>
</div>

<div class="table-responsive bg-white rounded-3 border">
    <table class="table table-elevated table-hover align-middle mb-0" id="tableExpensePhase_<?php echo e($phase); ?>" style="min-width: 880px;">
        <thead>
            <tr>
                <th class="ps-3">KODE / TANGGAL</th>
                <th>NAMA BAHAN / PENGELUARAN</th>
                <th>POS PEKERJAAN</th>
                <th>KATEGORI</th>
                <th class="text-end">VOL</th>
                <th class="text-center">SAT</th>
                <th class="text-end">HARGA SAT</th>
                <th class="text-end">TOTAL HARGA</th>
                <th>SUPPLIER / VENDOR</th>
                <th>STATUS</th>
                <th>BUKTI</th>
                <th class="text-center pe-3">AKSI</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $phaseExpenses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $exp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr class="expense-row" data-infra-id="<?php echo e($exp->land_bank_infrastructure_id ?? '0'); ?>">
                    <td class="ps-3">
                        <span class="fw-bold text-dark d-block small">#EXP-<?php echo e($exp->id); ?></span>
                        <small class="text-muted"><?php echo e($exp->expense_date ? \Carbon\Carbon::parse($exp->expense_date)->format('d/m/Y') : '-'); ?></small>
                    </td>
                    <td>
                        <strong class="text-dark"><?php echo e($exp->item_name); ?></strong>
                        <?php if($exp->notes): ?>
                            <small class="text-muted d-block"><?php echo e(Str::limit($exp->notes, 30)); ?></small>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if($exp->infrastructure): ?>
                            <span class="badge bg-soft-primary text-primary px-2 py-1 rounded-2 small">
                                <?php echo e($exp->infrastructure->item_name); ?>

                            </span>
                        <?php else: ?>
                            <span class="badge bg-light text-muted border px-2 py-1 rounded-2 small">
                                Biaya Umum Fase <?php echo e($phase); ?>

                            </span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <span class="badge bg-light text-dark border px-2 py-1 small">
                            <?php echo e($exp->category ?? 'Umum'); ?>

                        </span>
                    </td>
                    <td class="text-end fw-bold text-dark"><?php echo e(number_format($exp->quantity, 0, ',', '.')); ?></td>
                    <td class="text-center text-muted small"><?php echo e($exp->unit ?? '-'); ?></td>
                    <td class="text-end text-muted small">Rp <?php echo e(number_format($exp->unit_price, 0, ',', '.')); ?></td>
                    <td class="text-end fw-bold text-danger">Rp <?php echo e(number_format($exp->total_amount, 0, ',', '.')); ?></td>
                    <td>
                        <span class="text-muted small"><?php echo e($exp->vendor_name ?? '-'); ?></span>
                    </td>
                    <td>
                        <?php if($exp->payment_status === 'Lunas'): ?>
                            <span class="badge bg-success text-white rounded-2 px-2 py-1 small">
                                Lunas
                            </span>
                        <?php else: ?>
                            <span class="badge bg-danger text-white rounded-2 px-2 py-1 small">
                                Belum Lunas
                            </span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if($exp->receipt_proof): ?>
                            <?php
                                $rClean = ltrim(preg_replace('/^(storage\/)+/', '', $exp->receipt_proof), '/');
                                $rUrl = str_starts_with($exp->receipt_proof, 'http') 
                                    ? $exp->receipt_proof 
                                    : (file_exists(public_path($exp->receipt_proof)) ? asset($exp->receipt_proof) : (file_exists(public_path('uploads/' . $rClean)) ? asset('uploads/' . $rClean) : asset($rClean)));
                            ?>
                            <a href="<?php echo e($rUrl); ?>" target="_blank" class="btn-pill-xs">
                                Nota
                            </a>
                        <?php else: ?>
                            <span class="text-muted small">-</span>
                        <?php endif; ?>
                    </td>
                    <td class="text-center pe-3">
                        <button type="button" class="btn-table-del" onclick="deleteExpense(<?php echo e($exp->id); ?>)" title="Hapus Pengeluaran">
                            <i class="mdi mdi-delete"></i>
                        </button>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr id="emptyRow_<?php echo e($phase); ?>">
                    <td colspan="11" class="text-center py-4 text-muted">
                        <p class="mb-0">Belum ada pengeluaran bahan tercatat pada Fase <?php echo e($phase); ?>.</p>
                    </td>
                </tr>
            <?php endif; ?>
            <!-- Hidden Empty Filter Message Row -->
            <tr id="emptyFilterRow_<?php echo e($phase); ?>" class="d-none">
                <td colspan="11" class="text-center py-4 text-muted bg-light">
                    <p class="mb-0 small">Belum ada catatan belanja bahan khusus untuk pos yang dipilih.</p>
                </td>
            </tr>
        </tbody>
    </table>
</div>

<?php /**PATH D:\Property-Management-Web-App\resources\views/properti/partials/phase_expense_table.blade.php ENDPATH**/ ?>