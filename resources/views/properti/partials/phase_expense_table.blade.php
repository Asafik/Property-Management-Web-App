<!-- Active Card Expense Filter Notification Banner -->
<div class="p-3 bg-white rounded-3 border mb-3 d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2 d-none" id="tableFilterBanner_{{ $phase }}">
    <div class="d-flex align-items-center gap-2">
        <span class="badge bg-primary text-white rounded-2 px-2 py-1 small fw-bold">
            Filter Aktif
        </span>
        <span class="small text-dark">
            Menampilkan rincian nota belanja untuk: <strong class="text-primary fs-6" id="filterPosName_{{ $phase }}">-</strong>
        </span>
    </div>
    <div class="d-flex align-items-center gap-2">
        <button type="button" class="btn btn-sm btn-secondary text-white rounded-2 px-3 py-1 fw-semibold shadow-sm" onclick="clearTableFilter({{ $phase }})" style="font-size: 0.75rem;">
            Tampilkan Semua Belanja Fase {{ $phase }}
        </button>
    </div>
</div>

<div class="table-responsive bg-white rounded-3 border">
    <table class="table table-elevated table-hover align-middle mb-0" id="tableExpensePhase_{{ $phase }}" style="min-width: 880px;">
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
            @forelse($phaseExpenses as $exp)
                <tr class="expense-row" data-infra-id="{{ $exp->land_bank_infrastructure_id ?? '0' }}">
                    <td class="ps-3">
                        <span class="fw-bold text-dark d-block small">#EXP-{{ $exp->id }}</span>
                        <small class="text-muted">{{ $exp->expense_date ? \Carbon\Carbon::parse($exp->expense_date)->format('d/m/Y') : '-' }}</small>
                    </td>
                    <td>
                        <strong class="text-dark">{{ $exp->item_name }}</strong>
                        @if($exp->notes)
                            <small class="text-muted d-block">{{ Str::limit($exp->notes, 30) }}</small>
                        @endif
                    </td>
                    <td>
                        @if($exp->infrastructure)
                            <span class="badge bg-soft-primary text-primary px-2 py-1 rounded-2 small">
                                {{ $exp->infrastructure->item_name }}
                            </span>
                        @else
                            <span class="badge bg-light text-muted border px-2 py-1 rounded-2 small">
                                Biaya Umum Fase {{ $phase }}
                            </span>
                        @endif
                    </td>
                    <td>
                        <span class="badge bg-light text-dark border px-2 py-1 small">
                            {{ $exp->category ?? 'Umum' }}
                        </span>
                    </td>
                    <td class="text-end fw-bold text-dark">{{ number_format($exp->quantity, 0, ',', '.') }}</td>
                    <td class="text-center text-muted small">{{ $exp->unit ?? '-' }}</td>
                    <td class="text-end text-muted small">Rp {{ number_format($exp->unit_price, 0, ',', '.') }}</td>
                    <td class="text-end fw-bold text-danger">Rp {{ number_format($exp->total_amount, 0, ',', '.') }}</td>
                    <td>
                        <span class="text-muted small">{{ $exp->vendor_name ?? '-' }}</span>
                    </td>
                    <td>
                        @if($exp->payment_status === 'Lunas')
                            <span class="badge bg-success text-white rounded-2 px-2 py-1 small">
                                Lunas
                            </span>
                        @else
                            <span class="badge bg-danger text-white rounded-2 px-2 py-1 small">
                                Belum Lunas
                            </span>
                        @endif
                    </td>
                    <td>
                        @if($exp->receipt_proof)
                            <a href="{{ asset('storage/' . $exp->receipt_proof) }}" target="_blank" class="btn-pill-xs">
                                Nota
                            </a>
                        @else
                            <span class="text-muted small">-</span>
                        @endif
                    </td>
                    <td class="text-center pe-3">
                        <button type="button" class="btn-table-del" onclick="deleteExpense({{ $exp->id }})" title="Hapus Pengeluaran">
                            <i class="mdi mdi-delete"></i>
                        </button>
                    </td>
                </tr>
            @empty
                <tr id="emptyRow_{{ $phase }}">
                    <td colspan="11" class="text-center py-4 text-muted">
                        <p class="mb-0">Belum ada pengeluaran bahan tercatat pada Fase {{ $phase }}.</p>
                    </td>
                </tr>
            @endforelse
            <!-- Hidden Empty Filter Message Row -->
            <tr id="emptyFilterRow_{{ $phase }}" class="d-none">
                <td colspan="11" class="text-center py-4 text-muted bg-light">
                    <p class="mb-0 small">Belum ada catatan belanja bahan khusus untuk pos yang dipilih.</p>
                </td>
            </tr>
        </tbody>
    </table>
</div>

