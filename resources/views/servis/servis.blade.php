@extends('layouts.partial.app')

@section('title', 'Service & Perbaikan - Property Management App')

@section('content')

@php
    $dummyServices = [
        [
            'id' => 1,
            'ticket_no' => 'SRV/2026/001',
            'unit_name' => 'Lavender 45 - Blok C/12',
            'customer_name' => 'Budi Santoso',
            'issue' => 'Kebocoran atap pada area kamar tidur utama',
            'date' => '2026-03-22',
            'status' => 'Diproses',
        ],
        [
            'id' => 2,
            'ticket_no' => 'SRV/2026/002',
            'unit_name' => 'Rosemary 12 - Blok A/08',
            'customer_name' => 'Siti Nurhaliza',
            'issue' => 'Kran wastafel kamar mandi kendur dan rembes',
            'date' => '2026-03-21',
            'status' => 'Pending',
        ],
        [
            'id' => 3,
            'ticket_no' => 'SRV/2026/003',
            'unit_name' => 'Jasmine 09 - Blok B/03',
            'customer_name' => 'Agus Prasetyo',
            'issue' => 'Finishing cat dinding bagian teras mengelupas',
            'date' => '2026-03-20',
            'status' => 'Selesai',
        ],
    ];
@endphp

<div class="container-fluid px-1 px-sm-2 px-md-3 py-2 py-md-3">

    <!-- Header Halaman (Tanpa Card Box) -->
    <div class="row mb-3 mb-md-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center px-1">
                <div>
                    <h3 class="text-dark mb-1 fw-bold">
                        <i class="mdi mdi-wrench-clock-outline me-2" style="color: #9a55ff;"></i>Service & Perbaikan
                    </h3>
                    <p class="text-muted mb-0">Kelola pengajuan service, komplain perbaikan, dan klaim garansi unit properti</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-2 mt-sm-2 mt-md-3">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white d-flex flex-wrap flex-md-row justify-content-between align-items-center gap-2">
                    <h5 class="card-title mb-0">
                        <i class="mdi mdi-format-list-bulleted me-2"></i>Daftar Pengajuan Servis
                    </h5>
                    <button type="button" class="btn btn-sm btn-gradient-primary d-flex align-items-center gap-1 shadow-sm" onclick="openTambahServis()">
                        <i class="mdi mdi-plus-circle" style="font-size: 1rem;"></i>
                        <span>Tambah Pengajuan</span>
                    </button>
                </div>

                <div class="card-body">
                    <!-- Filter Section -->
                    <div class="filter-card mb-3">
                        <!-- Desktop Version -->
                        <div class="filter-row-desktop d-none d-md-block">
                            <form id="filterForm" onsubmit="return simulateFilter(event)">
                                <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 w-100">
                                    <div class="d-flex flex-wrap align-items-center gap-2 flex-grow-1">
                                        <!-- Search Input -->
                                        <div style="min-width: 260px; max-width: 360px; flex: 1;">
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="search" id="searchInput"
                                                    placeholder="Cari no tiket / unit / customer..."
                                                    style="border-top-right-radius: 0 !important; border-bottom-right-radius: 0 !important; border-right: none;">
                                                <button class="btn btn-gradient-primary d-flex align-items-center justify-content-center px-3" 
                                                    type="submit" title="Cari"
                                                    style="border-top-left-radius: 0 !important; border-bottom-left-radius: 0 !important; border-top-right-radius: 4px !important; border-bottom-right-radius: 4px !important; height: 38px; box-shadow: none;">
                                                    <i class="mdi mdi-magnify" style="font-size: 1.15rem; color: #ffffff;"></i>
                                                </button>
                                            </div>
                                        </div>

                                        <!-- Status Filter -->
                                        <div style="width: 155px;">
                                            <select class="form-control" name="status" id="statusFilter">
                                                <option value="">Semua Status</option>
                                                <option value="Pending">Pending</option>
                                                <option value="Diproses">Diproses</option>
                                                <option value="Selesai">Selesai</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Right Limit & Buttons -->
                                    <div class="d-flex align-items-center gap-2 ms-auto">
                                        <div style="width: 110px;">
                                            <select class="form-control" name="per_page" id="perPageSelect">
                                                <option value="10">10 data</option>
                                                <option value="15">15 data</option>
                                                <option value="25">25 data</option>
                                                <option value="50">50 data</option>
                                            </select>
                                        </div>

                                        <button type="submit" class="btn btn-gradient-primary btn-icon-only" title="Filter">
                                            <i class="mdi mdi-filter"></i>
                                        </button>
                                        <button type="button" class="btn btn-gradient-secondary btn-icon-only" title="Reset" onclick="resetFilter()">
                                            <i class="mdi mdi-refresh"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <!-- Mobile Version -->
                        <div class="filter-row-mobile d-block d-md-none">
                            <form onsubmit="return simulateFilter(event)">
                                <div class="row g-2">
                                    <div class="col-12 mb-2">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="search" id="searchInputMobile"
                                                placeholder="Cari no tiket / unit / customer..."
                                                style="border-top-right-radius: 0 !important; border-bottom-right-radius: 0 !important; border-right: none;">
                                            <button class="btn btn-gradient-primary d-flex align-items-center justify-content-center px-3" 
                                                type="submit" title="Cari"
                                                style="border-top-left-radius: 0 !important; border-bottom-left-radius: 0 !important; border-top-right-radius: 4px !important; border-bottom-right-radius: 4px !important; height: 38px; box-shadow: none;">
                                                <i class="mdi mdi-magnify" style="font-size: 1.15rem; color: #ffffff;"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="col-12 mb-2">
                                        <select class="form-control" name="status" id="statusFilterMobile">
                                            <option value="">Semua Status</option>
                                            <option value="Pending">Pending</option>
                                            <option value="Diproses">Diproses</option>
                                            <option value="Selesai">Selesai</option>
                                        </select>
                                    </div>

                                    <div class="col-12 mb-2">
                                        <select class="form-control" name="per_page">
                                            <option value="10">10 data</option>
                                            <option value="15">15 data</option>
                                            <option value="25">25 data</option>
                                            <option value="50">50 data</option>
                                        </select>
                                    </div>

                                    <div class="col-6">
                                        <button type="submit" class="btn btn-gradient-primary w-100 d-flex align-items-center justify-content-center gap-1">
                                            <i class="mdi mdi-filter"></i> Filter
                                        </button>
                                    </div>
                                    <div class="col-6">
                                        <button type="button" class="btn btn-gradient-secondary w-100 d-flex align-items-center justify-content-center gap-1" onclick="resetFilter()">
                                            <i class="mdi mdi-refresh"></i> Reset
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Tabel Data Servis -->
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th>No. Tiket</th>
                                    <th>Unit Properti</th>
                                    <th>Pemohon / Konsumen</th>
                                    <th>Tanggal Pengajuan</th>
                                    <th>Status Servis</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($dummyServices as $index => $service)
                                    <tr>
                                        <td class="text-center fw-bold">{{ $index + 1 }}</td>
                                        <td>
                                            <span class="badge bg-light text-primary fw-bold px-2 py-1 border" style="font-size: 0.78rem;">
                                                <i class="mdi mdi-ticket-confirmation-outline me-1"></i>{{ $service['ticket_no'] }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <i class="mdi mdi-home-outline text-primary me-2" style="font-size: 1.2rem;"></i>
                                                <span class="fw-bold text-dark">{{ $service['unit_name'] }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="text-dark fw-medium">{{ $service['customer_name'] }}</span>
                                        </td>
                                        <td>
                                            <span class="d-inline-flex align-items-center gap-1 text-muted" style="font-size: 0.82rem;">
                                                <i class="mdi mdi-calendar-clock text-primary"></i>
                                                <span>{{ \Carbon\Carbon::parse($service['date'])->format('d M Y') }}</span>
                                            </span>
                                        </td>
                                        <td>
                                            @if($service['status'] === 'Selesai')
                                                <span class="status-badge aktif">
                                                    <i class="mdi mdi-check-circle"></i> Selesai
                                                </span>
                                            @elseif($service['status'] === 'Diproses')
                                                <span class="status-badge" style="background: rgba(255, 193, 7, 0.15); color: #b78103; border-color: rgba(255, 193, 7, 0.3);">
                                                    <i class="mdi mdi-progress-clock"></i> Diproses
                                                </span>
                                            @else
                                                <span class="status-badge nonaktif">
                                                    <i class="mdi mdi-clock-outline"></i> Pending
                                                </span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <div class="d-inline-flex align-items-center gap-1">
                                                <button class="btn-action fase2" title="Lihat Detail" onclick="openDetail({{ json_encode($service) }})">
                                                    <i class="mdi mdi-eye"></i>
                                                </button>
                                                <button class="btn-action edit" title="Edit Servis" onclick="openEdit({{ json_encode($service) }})">
                                                    <i class="mdi mdi-pencil"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center text-muted py-4">
                                            <i class="mdi mdi-tools me-2" style="font-size: 1.5rem;"></i>
                                            Tidak ada data servis ditemukan.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mt-4">
                        <div class="pagination-info mb-2 mb-sm-0 text-muted" style="font-size: 0.82rem;">
                            Menampilkan 1 - 3 dari 3 data
                        </div>
                        <nav aria-label="Page navigation">
                            <ul class="pagination pagination-sm flex-wrap justify-content-center mb-0">
                                <li class="page-item disabled">
                                    <span class="page-link"><i class="mdi mdi-chevron-left"></i></span>
                                </li>
                                <li class="page-item active">
                                    <span class="page-link">1</span>
                                </li>
                                <li class="page-item disabled">
                                    <span class="page-link"><i class="mdi mdi-chevron-right"></i></span>
                                </li>
                            </ul>
                        </nav>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>

<!-- Modal Tambah / Edit Servis -->
<div class="modal fade" id="modalServis" tabindex="-1" aria-labelledby="modalServisLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-white border-bottom">
                <h5 class="modal-title fw-bold" id="modalServisLabel" style="color: #2c2e3f;">
                    <i class="mdi mdi-wrench-outline me-2" id="modalServisIcon" style="color: #9a55ff;"></i>
                    <span id="modalServisTitle">Tambah Pengajuan Servis</span>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formServis" onsubmit="return handleSimpanServis(event)">
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label fw-bold" style="color: #2c2e3f;">Unit Properti <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="servisUnit" placeholder="Contoh: Lavender 45 - Blok C/12" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold" style="color: #2c2e3f;">Nama Pemohon / Konsumen <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="servisCustomer" placeholder="Contoh: Budi Santoso" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold" style="color: #2c2e3f;">Status Servis</label>
                        <select class="form-control" id="servisStatus">
                            <option value="Pending">Pending</option>
                            <option value="Diproses">Diproses</option>
                            <option value="Selesai">Selesai</option>
                        </select>
                    </div>
                    <div class="mb-0">
                        <label class="form-label fw-bold" style="color: #2c2e3f;">Deskripsi Kerusakan / Keluhan</label>
                        <textarea class="form-control" id="servisIssue" rows="3" placeholder="Tuliskan keluhan atau detail perbaikan..."></textarea>
                    </div>
                </div>

                <div class="modal-footer bg-light border-top">
                    <button type="button" class="btn btn-secondary btn-sm px-3" data-bs-dismiss="modal">
                        Batal
                    </button>
                    <button type="submit" class="btn btn-gradient-primary btn-sm px-4">
                        <i class="mdi mdi-content-save me-1"></i>Simpan Data
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Detail Servis -->
<div class="modal fade" id="modalDetailServis" tabindex="-1" aria-labelledby="modalDetailServisLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-white border-bottom">
                <h5 class="modal-title fw-bold" id="modalDetailServisLabel" style="color: #2c2e3f;">
                    <i class="mdi mdi-information-outline me-2" style="color: #17a2b8;"></i>Detail Pengajuan Servis
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="row g-2 mb-3">
                    <div class="col-6">
                        <div class="modal-detail-box">
                            <div class="detail-label">No. Tiket</div>
                            <div class="detail-value text-primary" id="detailTicketNo">-</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="modal-detail-box">
                            <div class="detail-label">Status</div>
                            <div class="detail-value" id="detailStatus">-</div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="modal-detail-box">
                            <div class="detail-label">Unit Properti</div>
                            <div class="detail-value" id="detailUnitName">-</div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="modal-detail-box">
                            <div class="detail-label">Pemohon / Konsumen</div>
                            <div class="detail-value" id="detailCustomerName">-</div>
                        </div>
                    </div>
                </div>

                <div class="p-3 bg-light rounded-3 border">
                    <label class="fw-bold text-muted mb-1" style="font-size: 0.75rem; text-transform: uppercase;">Deskripsi Masalah / Servis</label>
                    <p class="mb-0 text-dark" id="detailIssue" style="font-size: 0.9rem;">-</p>
                </div>
            </div>
            <div class="modal-footer bg-light border-top">
                <button type="button" class="btn btn-secondary btn-sm px-4" data-bs-dismiss="modal">
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
function simulateFilter(event) {
    event.preventDefault();
    const search = document.getElementById('searchInput')?.value || '';
    const status = document.getElementById('statusFilter')?.value || 'Semua Status';

    Swal.fire({
        icon: 'success',
        title: 'Filter Diterapkan',
        html: `Pencarian: <b>${search || '-'}</b> | Status: <b>${status}</b>`,
        timer: 1500,
        showConfirmButton: false
    });
    return false;
}

function resetFilter() {
    document.getElementById('filterForm')?.reset();
    Swal.fire({
        icon: 'success',
        title: 'Filter Direset',
        timer: 1200,
        showConfirmButton: false
    });
}

function openTambahServis() {
    $('#formServis')[0].reset();
    $('#modalServisTitle').text('Tambah Pengajuan Servis');
    $('#modalServisIcon').removeClass('mdi-pencil').addClass('mdi-plus-circle');
    $('#modalServis').modal('show');
}

function openEdit(service) {
    $('#servisUnit').val(service.unit_name);
    $('#servisCustomer').val(service.customer_name);
    $('#servisStatus').val(service.status);
    $('#servisIssue').val(service.issue);

    $('#modalServisTitle').text('Edit Pengajuan Servis');
    $('#modalServisIcon').removeClass('mdi-plus-circle').addClass('mdi-pencil');
    $('#modalServis').modal('show');
}

function openDetail(service) {
    $('#detailTicketNo').text(service.ticket_no);
    $('#detailStatus').text(service.status);
    $('#detailUnitName').text(service.unit_name);
    $('#detailCustomerName').text(service.customer_name);
    $('#detailIssue').text(service.issue);

    $('#modalDetailServis').modal('show');
}

function handleSimpanServis(event) {
    event.preventDefault();
    $('#modalServis').modal('hide');

    Swal.fire({
        icon: 'success',
        title: 'Berhasil Disimpan!',
        text: 'Data pengajuan servis berhasil diproses.',
        timer: 2000,
        showConfirmButton: true,
        confirmButtonColor: '#9a55ff'
    });
    return false;
}
</script>
@endpush
