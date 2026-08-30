<!-- Active Card Expense Filter Notification Banner -->
<div class="p-3 bg-white rounded-4 border mb-3 d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2 d-none" id="tableFilterBanner_{{ $phase }}" style="border-left: 4px solid #9a55ff !important;">
    <div class="d-flex align-items-center gap-2">
        <span class="badge bg-primary text-white rounded-pill px-2 py-1 small fw-bold">
            <i class="mdi mdi-filter-variant me-1"></i>Filter Aktif
        </span>
        <span class="small text-dark">
            Menampilkan rincian nota belanja untuk: <strong class="text-primary fs-6" id="filterPosName_{{ $phase }}">-</strong>
        </span>
    </div>
    <div class="d-flex align-items-center gap-2">
        <button type="button" class="btn btn-xs btn-outline-secondary rounded-pill px-3 py-1 small" onclick="clearTableFilter({{ $phase }})">
            <i class="mdi mdi-filter-remove-outline me-1"></i>Tampilkan Semua Belanja Fase {{ $phase }}
        </button>
    </div>
</div>

<div class="table-responsive bg-white rounded-4 border">
    <table class="table table-elevated table-hover align-middle mb-0" id="tableExpensePhase_{{ $phase }}">
        <thead>
            <tr>
                <th class="ps-3">KODE / TANGGAL</th>
                <th>NAMA BAHAN / PENGELUARAN</th>
                <th>POS PEKERJAAN</th>
                <th>KATEGORI</th>
                <th>VOLUME / QTY</th>
                <th>HARGA SATUAN</th>
                <th>TOTAL BIAYA</th>
                <th>VENDOR / TOKO</th>
                <th>STATUS BAYAR</th>
                <th>BUKTI NOTA</th>
                <th class="text-center pe-3">AKSI</th>
            </tr>
        </thead>
        <tbody>
            @forelse($phaseExpenses as $exp)
                <tr class="expense-row-phase-{{ $phase }}" data-infra-id="{{ $exp->land_bank_infrastructure_id ?? '' }}">
                    <td class="ps-3">
                        <code class="text-primary fw-bold">{{ $exp->expense_code ?? '-' }}</code>
                        <span class="small text-muted d-block">{{ $exp->expense_date ? $exp->expense_date->format('d M Y') : '-' }}</span>
                    </td>
                    <td>
                        <strong class="text-dark d-block">{{ $exp->item_name }}</strong>
                        @if($exp->notes)
                            <small class="text-muted d-block mt-1">{{ Str::limit($exp->notes, 30) }}</small>
                        @endif
                    </td>
                    <td>
                        @if($exp->infrastructure)
                            <span class="badge bg-light text-dark border"><i class="mdi mdi-cube-outline me-1 text-primary"></i>{{ $exp->infrastructure->item_name }}</span>
                        @else
                            <span class="badge bg-light text-muted border">- Umum Fase {{ $phase }} -</span>
                        @endif
                    </td>
                    <td>
                        <span class="badge bg-soft-primary text-primary small py-1 px-2 rounded-pill">{{ $exp->category ?? 'Umum' }}</span>
                    </td>
                    <td>
                        <span class="fw-bold">{{ number_format($exp->quantity, 0, ',', '.') }}</span>
                        <span class="text-muted small">{{ $exp->unit }}</span>
                    </td>
                    <td>
                        Rp {{ number_format($exp->unit_price, 0, ',', '.') }}
                    </td>
                    <td>
                        <strong class="text-danger fs-6">
                            Rp {{ number_format($exp->total_amount, 0, ',', '.') }}
                        </strong>
                    </td>
                    <td>
                        <span class="text-muted small">{{ $exp->vendor_name ?? '-' }}</span>
                    </td>
                    <td>
                        @if($exp->payment_status === 'Lunas')
                            <span class="badge bg-success text-white rounded-pill px-2 py-1 small">
                                <i class="mdi mdi-check me-1"></i>Lunas
                            </span>
                        @else
                            <span class="badge bg-danger text-white rounded-pill px-2 py-1 small">
                                <i class="mdi mdi-alert-circle-outline me-1"></i>Belum Lunas
                            </span>
                        @endif
                    </td>
                    <td>
                        @if($exp->receipt_proof)
                            <a href="{{ asset('storage/' . $exp->receipt_proof) }}" target="_blank" class="btn btn-sm btn-outline-primary py-0 px-2 rounded-pill small">
                                <i class="mdi mdi-file-document-outline me-1"></i>Nota
                            </a>
                        @else
                            <span class="text-muted small">-</span>
                        @endif
                    </td>
                    <td class="text-center pe-3">
                        <button type="button" class="btn btn-sm btn-outline-danger p-1 rounded-circle" onclick="deleteExpense({{ $exp->id }})" title="Hapus Pengeluaran">
                            <i class="mdi mdi-delete"></i>
                        </button>
                    </td>
                </tr>
            @empty
                <tr id="emptyRow_{{ $phase }}">
                    <td colspan="11" class="text-center py-5 text-muted">
                        <i class="mdi mdi-cash-remove fs-1 opacity-25"></i>
                        <p class="mt-2 mb-0">Belum ada pengeluaran bahan tercatat pada Fase {{ $phase }}.</p>
                    </td>
                </tr>
            @endforelse
            <!-- Hidden Empty Filter Message Row -->
            <tr id="emptyFilterRow_{{ $phase }}" class="d-none">
                <td colspan="11" class="text-center py-4 text-muted bg-light">
                    <i class="mdi mdi-information-outline fs-3 text-primary opacity-50"></i>
                    <p class="mt-1 mb-0 small">Belum ada catatan belanja bahan khusus untuk pos yang dipilih.</p>
                </td>
            </tr>
        </tbody>
    </table>
</div>
