@extends('layouts.partial.app')

@section('title', 'Pencairan Dana KPR (Disbursement) - Property Management App')

@section('content')
<div class="container-fluid px-1 px-sm-2 px-md-3 py-2 py-md-3">

    <!-- Header Banner -->
    <div class="row mb-3 mb-md-4">
        <div class="col-12">
            <div class="card shadow-sm border-0 header-card" style="background: linear-gradient(135deg, #ffffff 0%, #f7f5ff 100%); border-radius: 14px;">
                <div class="card-body p-3 p-md-4 d-flex justify-content-between align-items-center">
                    <div>
                        <span class="badge bg-primary px-3 py-1.5 mb-2" style="font-size: 0.76rem; border-radius: 6px;">
                            <i class="mdi mdi-bank-transfer me-1"></i>Modul Keuangan & Piutang KPR
                        </span>
                        <h3 class="text-dark mb-1 fw-bold" style="font-size: 1.35rem;">
                            Pencairan Dana KPR (KPR Disbursement)
                        </h3>
                        <p class="text-muted mb-0" style="font-size: 0.88rem;">
                            Monitoring & pencatatan realisasi transfer dana plafon KPR dari pihak Bank ke rekening Developer
                        </p>
                    </div>
                    <div class="d-none d-sm-block pe-2">
                        <i class="mdi mdi-bank-check" style="font-size: 3.2rem; color: #9a55ff; opacity: 0.25;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Metric KPI Cards -->
    <div class="row g-3 mb-4">
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm p-3 h-100" style="border-radius: 12px; background: #ffffff; border-left: 4px solid #3b82f6 !important;">
                <span class="text-muted small fw-semibold text-uppercase d-block" style="font-size: 0.73rem;">Total Plafon KPR (Piutang)</span>
                <h4 class="fw-bold text-dark font-monospace mt-1 mb-0">Rp {{ number_format($totalPlafonKpr, 0, ',', '.') }}</h4>
                <small class="text-muted" style="font-size: 0.74rem;">Dari {{ $totalUnitKpr }} unit skema KPR</small>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm p-3 h-100" style="border-radius: 12px; background: #ffffff; border-left: 4px solid #10b981 !important;">
                <span class="text-muted small fw-semibold text-uppercase d-block" style="font-size: 0.73rem;">Dana KPR Sudah Dicairkan</span>
                <h4 class="fw-bold text-success font-monospace mt-1 mb-0">Rp {{ number_format($totalDanaCair, 0, ',', '.') }}</h4>
                <small class="text-success" style="font-size: 0.74rem;">
                    <i class="mdi mdi-check-circle me-1"></i>Realisasi Kas Masuk Bank
                </small>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm p-3 h-100" style="border-radius: 12px; background: #ffffff; border-left: 4px solid #f59e0b !important;">
                <span class="text-muted small fw-semibold text-uppercase d-block" style="font-size: 0.73rem;">Sisa Dana Belum Cair</span>
                <h4 class="fw-bold text-warning font-monospace mt-1 mb-0">Rp {{ number_format($totalSisaPiutang, 0, ',', '.') }}</h4>
                <small class="text-muted" style="font-size: 0.74rem;">Menunggu transfer dari Bank</small>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-xl-3">
            @php
                $pctTotal = $totalPlafonKpr > 0 ? round(($totalDanaCair / $totalPlafonKpr) * 100) : 0;
            @endphp
            <div class="card border-0 shadow-sm p-3 h-100" style="border-radius: 12px; background: #ffffff; border-left: 4px solid #8b5cf6 !important;">
                <span class="text-muted small fw-semibold text-uppercase d-block" style="font-size: 0.73rem;">Persentase Realisasi Kas</span>
                <h4 class="fw-bold text-primary font-monospace mt-1 mb-1">{{ $pctTotal }}%</h4>
                <div class="progress" style="height: 6px; border-radius: 4px;">
                    <div class="progress-bar bg-gradient-primary" style="width: {{ $pctTotal }}%;"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter & Search Bar -->
    <div class="card shadow-sm border-0 mb-4" style="border-radius: 12px;">
        <div class="card-body p-3">
            <form method="GET" action="{{ route('finance.kpr-disbursement.index') }}" class="row g-2 align-items-center">
                <div class="col-12 col-md-4">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Cari nama kavling, unit, konsumen..." value="{{ request('search') }}" style="border-radius: 8px 0 0 8px;">
                        <button class="btn btn-gradient-primary px-3" type="submit" style="border-radius: 0 8px 8px 0;">
                            <i class="mdi mdi-magnify"></i>
                        </button>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <select name="land_bank_id" class="form-select" onchange="this.form.submit()" style="border-radius: 8px;">
                        <option value="">Semua Project (Land Bank)</option>
                        @foreach($projects as $p)
                            <option value="{{ $p->id }}" {{ request('land_bank_id') == $p->id ? 'selected' : '' }}>
                                {{ $p->name }} ({{ $p->units_count }} Unit)
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-6 col-md-3">
                    <select name="status_pencairan" class="form-select" onchange="this.form.submit()" style="border-radius: 8px;">
                        <option value="all">Semua Status Pencairan</option>
                        <option value="belum_cair" {{ request('status_pencairan') == 'belum_cair' ? 'selected' : '' }}>Belum Cair (0%)</option>
                        <option value="termin" {{ request('status_pencairan') == 'termin' ? 'selected' : '' }}>Cair Sebagian (Termin)</option>
                        <option value="lunas" {{ request('status_pencairan') == 'lunas' ? 'selected' : '' }}>Lunas / Selesai (100%)</option>
                    </select>
                </div>
                <div class="col-12 col-md-2 d-flex justify-content-end">
                    <a href="{{ route('finance.kpr-disbursement.index') }}" class="btn btn-outline-secondary w-100" style="border-radius: 8px;">
                        <i class="mdi mdi-refresh me-1"></i>Reset
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Data Table Card -->
    <div class="card shadow-sm border-0 mb-4" style="border-radius: 12px; overflow: hidden;">
        <div class="card-header bg-white py-3 px-4 d-flex justify-content-between align-items-center border-bottom">
            <h5 class="card-title mb-0 fw-bold text-dark">
                <i class="mdi mdi-format-list-numbered me-2 text-primary"></i>Daftar Unit KPR & Status Pencairan Bank
            </h5>
            <span class="text-muted small">Total <strong>{{ count($unitsData) }}</strong> Unit Terdata</span>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" style="font-size: 0.88rem;">
                    <thead class="table-light">
                        <tr>
                            <th class="text-center" style="width: 50px;">NO</th>
                            <th>KAVLING / UNIT</th>
                            <th>KONSUMEN & BANK</th>
                            <th class="text-end">HARGA & DP</th>
                            <th class="text-end">PLAFON KPR</th>
                            <th class="text-end">REALISASI CAIR</th>
                            <th class="text-end">SISA PIUTANG</th>
                            <th class="text-center">STATUS</th>
                            <th class="text-center" style="width: 170px;">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($unitsData as $idx => $row)
                            <tr>
                                <td class="text-center fw-bold text-muted">{{ $idx + 1 }}</td>
                                <td>
                                    <div class="fw-bold text-dark">{{ $row->unit->unit_name ?? 'Unit ' . $row->unit->unit_code }}</div>
                                    <small class="text-muted d-block">
                                        <i class="mdi mdi-home-outline text-primary me-1"></i>Kode: <strong class="font-monospace text-primary">{{ $row->unit->unit_code }}</strong> | Tipe: {{ $row->unit->type }}
                                    </small>
                                    <small class="text-muted d-block">{{ $row->unit->landBank->name ?? '-' }}</small>
                                </td>
                                <td>
                                    <div class="fw-bold text-dark">{{ $row->customer->full_name ?? '-' }}</div>
                                    <small class="text-muted d-block">
                                        <i class="mdi mdi-phone me-1"></i>{{ $row->customer->phone ?? '-' }}
                                    </small>
                                    <span class="badge bg-light text-primary border mt-1">
                                        <i class="mdi mdi-bank-outline me-1"></i>{{ $row->bankName }}
                                    </span>
                                </td>
                                <td class="text-end">
                                    <div class="fw-bold text-dark font-monospace">Rp {{ number_format($row->hargaJual, 0, ',', '.') }}</div>
                                    <small class="text-success font-monospace d-block">
                                        DP: Rp {{ number_format($row->dpKonsumen, 0, ',', '.') }}
                                    </small>
                                </td>
                                <td class="text-end font-monospace fw-bold text-primary">
                                    Rp {{ number_format($row->plafonKpr, 0, ',', '.') }}
                                </td>
                                <td class="text-end">
                                    <div class="fw-bold text-success font-monospace">Rp {{ number_format($row->totalCair, 0, ',', '.') }}</div>
                                    <div class="progress mt-1" style="height: 5px;">
                                        <div class="progress-bar bg-success" style="width: {{ $row->persenCair }}%;"></div>
                                    </div>
                                    <small class="text-muted" style="font-size: 0.72rem;">{{ $row->persenCair }}% terealisasi</small>
                                </td>
                                <td class="text-end font-monospace fw-bold {{ $row->sisaCair > 0 ? 'text-warning' : 'text-muted' }}">
                                    Rp {{ number_format($row->sisaCair, 0, ',', '.') }}
                                </td>
                                <td class="text-center">
                                    @if($row->statusPencairan === 'lunas')
                                        <span class="badge bg-success text-white px-2.5 py-1.5" style="border-radius: 6px; font-weight: 700;">
                                            <i class="mdi mdi-check-all me-1"></i>Lunas 100%
                                        </span>
                                    @elseif($row->statusPencairan === 'termin')
                                        <span class="badge bg-warning text-dark px-2.5 py-1.5" style="border-radius: 6px; font-weight: 700;">
                                            <i class="mdi mdi-progress-clock me-1"></i>Cair Sebagian
                                        </span>
                                    @else
                                        <span class="badge bg-danger text-white px-2.5 py-1.5" style="border-radius: 6px; font-weight: 700;">
                                            <i class="mdi mdi-clock-alert-outline me-1"></i>Belum Cair
                                        </span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center align-items-center gap-1">
                                        @if($row->sisaCair > 0)
                                            <button type="button" class="btn btn-sm btn-gradient-success d-inline-flex align-items-center px-2.5 py-1.5" onclick="openModalDisbursement({{ json_encode($row) }})" title="Input Pencairan Dana Bank" style="border-radius: 6px; font-size: 0.78rem; font-weight: 700;">
                                                <i class="mdi mdi-plus-circle me-1"></i>+ Cairkan
                                            </button>
                                        @else
                                            <button type="button" class="btn btn-sm btn-light border text-success d-inline-flex align-items-center px-2.5 py-1.5" disabled style="border-radius: 6px; font-size: 0.78rem; font-weight: 700; opacity: 0.85;">
                                                <i class="mdi mdi-check-circle me-1"></i>Selesai
                                            </button>
                                        @endif

                                        <button type="button" class="btn btn-sm btn-outline-primary d-inline-flex align-items-center px-2 py-1.5" onclick="openModalHistory({{ json_encode($row) }})" title="Lihat Riwayat Pencairan" style="border-radius: 6px; font-size: 0.78rem;">
                                            <i class="mdi mdi-history"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center py-5 text-muted">
                                    <i class="mdi mdi-information-outline fs-2 d-block mb-2 text-muted"></i>
                                    Belum ada data unit dengan skema pembayaran KPR
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<!-- MODAL: INPUT PENCAIRAN KPR BARU -->
<div class="modal fade" id="modalDisbursement" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 14px; overflow: hidden;">
            <div class="modal-header bg-white border-bottom py-3 px-4">
                <div>
                    <h5 class="modal-title fw-bold text-dark" id="modalDisbursementTitle">Catat Pencairan Dana KPR dari Bank</h5>
                    <small class="text-primary fw-semibold" id="modalDisbursementSubtitle">-</small>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formDisbursement" method="POST" action="{{ route('finance.kpr-disbursement.store') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="land_bank_unit_id" id="disburse_unit_id">

                <div class="modal-body p-4 bg-light">
                    <!-- Info Box -->
                    <div class="p-3 bg-white border rounded-3 mb-3">
                        <div class="row g-2">
                            <div class="col-4">
                                <small class="text-muted d-block">Plafon KPR</small>
                                <span class="fw-bold font-monospace text-primary" id="info_plafon_kpr">Rp 0</span>
                            </div>
                            <div class="col-4">
                                <small class="text-muted d-block">Sudah Dicairkan</small>
                                <span class="fw-bold font-monospace text-success" id="info_total_cair">Rp 0</span>
                            </div>
                            <div class="col-4">
                                <small class="text-muted d-block">Sisa Belum Cair</small>
                                <span class="fw-bold font-monospace text-warning" id="info_sisa_cair">Rp 0</span>
                            </div>
                        </div>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-dark">Nama Termin Pencairan <span class="text-danger">*</span></label>
                            <input type="text" name="nama_termin" id="disburse_nama_termin" class="form-control" placeholder="Contoh: Pencairan 100% Penuh / Termin 1 - Pondasi" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-dark">Tanggal Dana Masuk Rekening <span class="text-danger">*</span></label>
                            <input type="date" name="tanggal_cair" id="disburse_tanggal" class="form-control" value="{{ date('Y-m-d') }}" required>
                        </div>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-dark">Nominal Pencairan Masuk (Rp) <span class="text-danger">*</span></label>
                            <input type="number" name="nominal_cair" id="disburse_nominal" class="form-control font-monospace text-end fw-bold text-success" placeholder="0" required>
                            <small class="text-muted" style="font-size: 0.72rem;">Masukkan nominal yang ditransfer oleh Bank</small>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-dark">Bank Penyalur KPR</label>
                            <input type="text" name="bank_penyalur" id="disburse_bank_penyalur" class="form-control" placeholder="Contoh: Bank BCA / Bank BTN">
                        </div>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-dark">Rekening Tujuan Developer</label>
                            <input type="text" name="rekening_tujuan" id="disburse_rekening_tujuan" class="form-control" placeholder="Contoh: Rekening Operasional PT Developer">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-dark">No. Referensi Bank / SP2D</label>
                            <input type="text" name="no_referensi_bank" id="disburse_ref" class="form-control font-monospace" placeholder="Nomor referensi mutasi bank">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-bold text-dark">Upload Bukti Rekening Koran / Bukti Transfer Bank</label>
                        <input type="file" name="bukti_transfer" class="form-control" accept="image/*,application/pdf">
                        <small class="text-muted" style="font-size: 0.72rem;">Format didukung: JPG, PNG, PDF (Maks. 10MB)</small>
                    </div>

                    <div class="mb-0">
                        <label class="form-label small fw-bold text-dark">Catatan Tambahan</label>
                        <textarea name="catatan" class="form-control" rows="2" placeholder="Catatan opsional mengenai pencairan KPR..."></textarea>
                    </div>
                </div>

                <div class="modal-footer bg-white border-top py-2.5 px-4 d-flex justify-content-end">
                    <button type="button" class="btn btn-sm btn-light border px-3" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-sm btn-gradient-success px-4 fw-semibold">
                        <i class="mdi mdi-check-circle me-1"></i>Simpan Realisasi Pencairan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- MODAL: RIWAYAT PENCAIRAN PER UNIT -->
<div class="modal fade" id="modalHistory" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 14px; overflow: hidden;">
            <div class="modal-header bg-white border-bottom py-3 px-4">
                <div>
                    <h5 class="modal-title fw-bold text-dark">Riwayat Realisasi Pencairan KPR</h5>
                    <small class="text-primary fw-semibold" id="modalHistorySubtitle">-</small>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4 bg-light">
                <div class="table-responsive bg-white rounded-3 border">
                    <table class="table table-hover align-middle mb-0" style="font-size: 0.85rem;">
                        <thead class="table-light">
                            <tr>
                                <th>TERMIN</th>
                                <th>TGL CAIR</th>
                                <th class="text-end">NOMINAL CAIR</th>
                                <th>BANK & REF</th>
                                <th>BUKTI</th>
                                <th class="text-center">AKSI</th>
                            </tr>
                        </thead>
                        <tbody id="historyTableBody">
                            <!-- Populated via JS -->
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer bg-white border-top py-2.5 px-4 d-flex justify-content-end">
                <button type="button" class="btn btn-sm btn-light border px-4" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function formatRupiah(num) {
        return 'Rp ' + (num || 0).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    function openModalDisbursement(data) {
        document.getElementById('disburse_unit_id').value = data.unit.id;
        document.getElementById('modalDisbursementSubtitle').innerText = (data.unit.unit_name || data.unit.unit_code) + ' - ' + (data.customer ? data.customer.full_name : '');
        document.getElementById('info_plafon_kpr').innerText = formatRupiah(data.plafonKpr);
        document.getElementById('info_total_cair').innerText = formatRupiah(data.totalCair);
        document.getElementById('info_sisa_cair').innerText = formatRupiah(data.sisaCair);

        document.getElementById('disburse_nominal').value = data.sisaCair;
        document.getElementById('disburse_bank_penyalur').value = data.bankName;

        let countTermin = (data.disbursements ? data.disbursements.length : 0) + 1;
        if (data.totalCair == 0) {
            document.getElementById('disburse_nama_termin').value = 'Pencairan Plafon KPR (100% Penuh)';
        } else {
            document.getElementById('disburse_nama_termin').value = 'Pencairan Termin Ke-' + countTermin;
        }

        if (window.bootstrap && bootstrap.Modal) {
            new bootstrap.Modal(document.getElementById('modalDisbursement')).show();
        } else if (window.jQuery) {
            $('#modalDisbursement').modal('show');
        }
    }

    function openModalHistory(data) {
        document.getElementById('modalHistorySubtitle').innerText = (data.unit.unit_name || data.unit.unit_code) + ' - ' + (data.customer ? data.customer.full_name : '');
        let tbody = document.getElementById('historyTableBody');
        tbody.innerHTML = '';

        if (!data.disbursements || data.disbursements.length === 0) {
            tbody.innerHTML = '<tr><td colspan="6" class="text-center py-4 text-muted">Belum ada catatan pencairan dana KPR untuk unit ini.</td></tr>';
        } else {
            data.disbursements.forEach(function(d) {
                let buktiHtml = d.bukti_transfer 
                    ? `<a href="/${d.bukti_transfer}" target="_blank" class="badge bg-primary text-white text-decoration-none"><i class="mdi mdi-file-document me-1"></i>Lihat Bukti</a>`
                    : '<span class="text-muted">-</span>';

                let row = `
                    <tr>
                        <td class="fw-bold text-dark">${d.nama_termin || ('Termin ' + d.termin_ke)}</td>
                        <td>${d.tanggal_cair}</td>
                        <td class="text-end font-monospace fw-bold text-success">${formatRupiah(d.nominal_cair)}</td>
                        <td>
                            <span class="d-block fw-semibold">${d.bank_penyalur || '-'}</span>
                            <small class="text-muted font-monospace">${d.no_referensi_bank || ''}</small>
                        </td>
                        <td>${buktiHtml}</td>
                        <td class="text-center">
                            <form action="/keuangan/pencairan-kpr/${d.id}" method="POST" class="d-inline form-delete-disburse">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-xs btn-link text-danger p-0 btn-delete-disburse" title="Hapus Catatan Ini">
                                    <i class="mdi mdi-trash-can-outline font-size-16"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                `;
                tbody.innerHTML += row;
            });
        }

        if (window.bootstrap && bootstrap.Modal) {
            new bootstrap.Modal(document.getElementById('modalHistory')).show();
        } else if (window.jQuery) {
            $('#modalHistory').modal('show');
        }
    }

    $(document).on('click', '.btn-delete-disburse', function(e) {
        e.preventDefault();
        let form = $(this).closest('form');
        Swal.fire({
            title: 'Hapus Catatan Pencairan Ini?',
            text: 'Nominal pencairan akan ditarik kembali dari perhitungan kas proyek!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
</script>
@endpush
