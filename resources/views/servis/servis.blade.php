@extends('layouts.partial.app')

@section('title', 'Service & Perbaikan - Demo UI')

@section('content')

@php
    $dummyServices = [
        [
            'id' => 1,
            'ticket_no' => 'SRV/2026/001',
            'unit_name' => 'Lavender 45 - C/12',
            'date' => '2026-03-22',
            'status' => 'Diproses',
        ],
        [
            'id' => 2,
            'ticket_no' => 'SRV/2026/002',
            'unit_name' => 'Rosemary 12 - A/08',
            'date' => '2026-03-21',
            'status' => 'Pending',
        ],
        [
            'id' => 3,
            'ticket_no' => 'SRV/2026/003',
            'unit_name' => 'Jasmine 09 - B/03',
            'date' => '2026-03-20',
            'status' => 'Selesai',
        ],
    ];
@endphp

<style>
.card {
    transition: all 0.3s ease;
    margin-bottom: 1rem;
    border: none !important;
    box-shadow: 0 4px 15px rgba(0,0,0,0.05);
}
.card:hover {
    box-shadow: 0 8px 25px rgba(154, 85, 255, 0.1) !important;
}

.card-header {
    background: linear-gradient(135deg, #ffffff, #f8f9fa);
    border-bottom: 1px solid #e9ecef;
    padding: 0.9rem 1rem;
}

.card-body {
    padding: 1rem;
}

@media (min-width: 768px) {
    .card-header {
        padding: 1rem 1.25rem;
    }

    .card-body {
        padding: 1.25rem;
    }
}

.card-title {
    font-size: 1rem;
    font-weight: 700;
    color: #9a55ff;
    margin-bottom: 0;
}

.filter-card {
    background: linear-gradient(135deg, #f9f7ff, #f2ecff);
    border-radius: 14px;
    padding: 1rem;
    margin-bottom: 1.25rem;
    border: none;
}

.form-control,
.form-select {
    border: 1px solid #e9ecef;
    border-radius: 10px;
    padding: 0.7rem 0.95rem;
    font-size: 0.92rem;
    transition: all 0.2s ease;
    background-color: #ffffff;
    color: #2c2e3f;
    min-height: 42px;
    height: 42px;
}

.form-control:focus,
.form-select:focus {
    border-color: #9a55ff;
    box-shadow: 0 0 0 3px rgba(154, 85, 255, 0.1);
    outline: none;
}

.form-label {
    font-size: 0.85rem;
    font-weight: 600;
    color: #9a55ff !important;
    margin-bottom: 0.4rem;
    letter-spacing: 0.2px;
    font-family: 'Nunito', sans-serif;
}

.btn {
    font-size: 0.88rem;
    padding: 0.65rem 1rem;
    border-radius: 10px;
    font-weight: 600;
    transition: all 0.3s ease;
    font-family: 'Nunito', sans-serif;
    border: none;
}

.btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.btn-gradient-primary {
    background: linear-gradient(to right, #da8cff, #9a55ff) !important;
    color: #ffffff !important;
}

.btn-gradient-secondary {
    background: #6c757d !important;
    color: #ffffff !important;
}

.btn-action {
    width: 36px;
    height: 36px;
    padding: 0;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: 10px;
    margin: 0 3px;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
}

.btn-action i {
    font-size: 1.1rem;
}

.btn-action.detail {
    background: linear-gradient(135deg, #17a2b8, #56c6d8);
    color: #fff;
}

.btn-action.detail:hover {
    transform: translateY(-3px);
    box-shadow: 0 5px 15px rgba(23, 162, 184, 0.4);
}

.btn-action.edit {
    background: linear-gradient(135deg, #ffc107, #ffdb6d);
    color: #2c2e3f;
}

.btn-action.edit:hover {
    transform: translateY(-3px);
    box-shadow: 0 5px 15px rgba(255, 193, 7, 0.4);
}

.btn-icon-only {
    width: 42px;
    height: 42px;
    min-width: 42px;
    padding: 0;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: 10px;
    flex-shrink: 0;
}

.btn-icon-only i {
    font-size: 1.15rem;
    margin: 0;
}

.table-responsive {
    overflow-x: auto;
    overflow-y: auto;
    -webkit-overflow-scrolling: touch;
    border-radius: 10px;
    margin-bottom: 0.5rem;
    max-height: 500px;
    scrollbar-width: thin;
    scrollbar-color: #9a55ff #f0f0f0;
}

.table-responsive::-webkit-scrollbar {
    width: 8px;
    height: 8px;
}

.table-responsive::-webkit-scrollbar-track {
    background: #f0f0f0;
    border-radius: 10px;
}

.table-responsive::-webkit-scrollbar-thumb {
    background: #9a55ff;
    border-radius: 10px;
}

.table-responsive::-webkit-scrollbar-thumb:hover {
    background: #7a3fcc;
}

.table-responsive::-webkit-scrollbar-corner {
    background: #f0f0f0;
}

.table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 0;
}

.table thead th {
    background: linear-gradient(135deg, #f8f9fa, #f1f3f5);
    color: #9a55ff;
    font-weight: 700;
    font-size: 0.8rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    border-bottom: 2px solid #e9ecef;
    padding: 0.85rem 0.75rem;
    white-space: nowrap;
    position: sticky;
    top: 0;
    z-index: 10;
}

.table tbody td {
    vertical-align: middle;
    font-size: 0.9rem;
    padding: 0.9rem 0.75rem;
    border-bottom: 1px solid #e9ecef;
    color: #2c2e3f;
    white-space: nowrap;
}

.table thead th:first-child,
.table tbody td:first-child {
    width: 60px;
    text-align: center;
}

.table tbody tr:hover {
    background-color: #f8f9fa;
}

.badge-status {
    padding: 0.4rem 0.85rem;
    border-radius: 20px;
    font-weight: 700;
    font-size: 0.78rem;
    display: inline-block;
    color: #fff;
}

.badge-status.pending {
    background: linear-gradient(135deg, #6c757d, #9aa0a6);
}

.badge-status.proses {
    background: linear-gradient(135deg, #ffc107, #ffdb6d);
    color: #2c2e3f;
}

.badge-status.selesai {
    background: linear-gradient(135deg, #28a745, #5dd879);
}

.pagination {
    margin: 0;
    gap: 3px;
}

.page-item .page-link {
    border: 1px solid #e9ecef;
    padding: 0.35rem 0.7rem;
    font-size: 0.75rem;
    color: #6c7383;
    background-color: #ffffff;
    border-radius: 6px !important;
    transition: all 0.2s ease;
    min-width: 32px;
    text-align: center;
    text-decoration: none;
}

.page-item.active .page-link {
    background: linear-gradient(to right, #da8cff, #9a55ff);
    border-color: transparent;
    color: #ffffff;
    box-shadow: 0 4px 12px rgba(154, 85, 255, 0.3);
}

.pagination-info {
    font-size: 0.8rem;
    color: #6c7383;
}

.text-primary { color: #9a55ff !important; }
.text-muted { color: #a5b3cb !important; }
.fw-bold { font-weight: 600 !important; }

h3.text-dark {
    font-size: 1.25rem !important;
    font-weight: 700;
    color: #2c2e3f !important;
    margin-bottom: 0.4rem !important;
}

@media (min-width: 576px) {
    h3.text-dark {
        font-size: 1.45rem !important;
    }
}

@media (min-width: 768px) {
    h3.text-dark {
        font-size: 1.65rem !important;
    }
}

.mdi {
    vertical-align: middle;
}

.filter-title {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: #9a55ff;
    font-weight: 700;
    font-size: 0.95rem;
    margin-bottom: 1rem;
}

.filter-actions {
    display: flex;
    gap: 0.5rem;
    align-items: flex-end;
    justify-content: flex-start;
}

.filter-actions-wrap {
    display: flex;
    align-items: end;
}

@media (max-width: 575.98px) {
    .container-fluid {
        padding-left: 0.75rem !important;
        padding-right: 0.75rem !important;
    }

    .filter-card {
        padding: 0.9rem;
    }

    .filter-actions-wrap {
        width: 100%;
    }

    .filter-actions {
        width: 100%;
        justify-content: stretch;
    }

    .filter-actions .btn-icon-only {
        flex: 1;
        width: 100%;
        min-width: 0;
    }

    .table thead th,
    .table tbody td {
        font-size: 0.82rem;
        padding: 0.8rem 0.6rem;
    }

    .pagination-info {
        text-align: center;
    }
}

@media (min-width: 576px) and (max-width: 991.98px) {
    .filter-actions-wrap {
        width: 100%;
    }

    .filter-actions {
        width: 100%;
        justify-content: flex-start;
    }
}
</style>

<div class="container-fluid p-2 p-sm-3 p-md-4">

    <div class="row mb-3 mb-sm-3 mb-md-4">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="text-dark mb-1">
                            <i class="mdi mdi-tools me-2" style="color: #9a55ff;"></i>Service & Perbaikan
                        </h3>
                        <p class="text-muted mb-0">
                            Kelola pengajuan service, perbaikan, dan garansi unit, status, tampil data servis
                        </p>
                    </div>
                    <div class="d-none d-sm-block">
                        <i class="mdi mdi-wrench" style="font-size: 2.5rem; color: #9a55ff; opacity: 0.2;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-2 mt-sm-2 mt-md-3">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">
                        <i class="mdi mdi-format-list-bulleted me-2"></i>Daftar Servis
                    </h5>
                </div>

                <div class="card-body">
                    <div class="filter-card">
                        <div class="filter-title">
                            <i class="mdi mdi-filter-outline"></i>
                            <span>Filter data servis</span>
                        </div>

                        <form id="filterForm" onsubmit="return simulateFilter(event)">
                            <div class="row g-3">
                                <div class="col-12 col-md-6 col-lg-5">
                                    <label class="form-label">Search</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="searchInput"
                                        name="search"
                                        placeholder="Cari no tiket / unit / status..."
                                    >
                                </div>

                                <div class="col-12 col-md-6 col-lg-3">
                                    <label class="form-label">Status</label>
                                    <select class="form-select" id="statusFilter" name="status">
                                        <option value="">Semua Status</option>
                                        <option value="Pending">Pending</option>
                                        <option value="Diproses">Diproses</option>
                                        <option value="Selesai">Selesai</option>
                                    </select>
                                </div>

                                <div class="col-12 col-md-6 col-lg-2">
                                    <label class="form-label">Tampil</label>
                                    <select class="form-select" id="showFilter" name="show">
                                        <option value="10">10</option>
                                        <option value="15">15</option>
                                        <option value="25">25</option>
                                    </select>
                                </div>

                                <div class="col-12 col-md-6 col-lg-2 filter-actions-wrap">
                                    <div class="filter-actions">
                                        <button type="submit" class="btn btn-gradient-primary btn-icon-only" title="Filter">
                                            <i class="mdi mdi-filter"></i>
                                        </button>
                                        <button type="button" class="btn btn-gradient-secondary btn-icon-only" title="Reset" onclick="resetFilter()">
                                            <i class="mdi mdi-refresh"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="table-responsive mt-4">
                        <table class="table table-hover align-middle">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th>No Tiket</th>
                                    <th>Unit</th>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($dummyServices as $index => $service)
                                    <tr>
                                        <td class="text-center fw-bold">{{ $index + 1 }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <i class="mdi mdi-ticket-confirmation text-primary me-2" style="font-size: 1.2rem;"></i>
                                                <span class="fw-bold">{{ $service['ticket_no'] }}</span>
                                            </div>
                                        </td>
                                        <td>{{ $service['unit_name'] }}</td>
                                        <td>{{ \Carbon\Carbon::parse($service['date'])->format('d M Y') }}</td>
                                        <td>
                                            @php
                                                $statusClass = 'pending';
                                                if ($service['status'] === 'Diproses') $statusClass = 'proses';
                                                if ($service['status'] === 'Selesai') $statusClass = 'selesai';
                                            @endphp
                                            <span class="badge-status {{ $statusClass }}">
                                                {{ $service['status'] }}
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <button class="btn-action detail me-1" title="Detail" onclick="openDetail({{ $service['id'] }})">
                                                <i class="mdi mdi-eye"></i>
                                            </button>
                                            <button class="btn-action edit" title="Edit" onclick="openEdit({{ $service['id'] }})">
                                                <i class="mdi mdi-pencil"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted py-4">
                                            Tidak ada data servis
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mt-4 gap-2">
                        <div class="pagination-info mb-0">
                            Menampilkan 1 - 3 dari 3 data
                        </div>
                        <nav aria-label="Page navigation">
                            <ul class="pagination pagination-sm flex-wrap justify-content-center mb-0">
                                <li class="page-item disabled">
                                    <span class="page-link">
                                        <i class="mdi mdi-chevron-left"></i>
                                    </span>
                                </li>
                                <li class="page-item active">
                                    <span class="page-link">1</span>
                                </li>
                                <li class="page-item disabled">
                                    <span class="page-link">
                                        <i class="mdi mdi-chevron-right"></i>
                                    </span>
                                </li>
                            </ul>
                        </nav>
                    </div>

                </div>
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
    const show = document.getElementById('showFilter')?.value || '10';

    Swal.fire({
        icon: 'success',
        title: 'Simulasi Filter',
        html: `
            <div style="text-align:left; font-size:14px;">
                <div><b>Search:</b> ${search || '-'}</div>
                <div><b>Status:</b> ${status}</div>
                <div><b>Tampil:</b> ${show}</div>
            </div>
        `,
        confirmButtonColor: '#9a55ff'
    });

    return false;
}

function resetFilter() {
    document.getElementById('filterForm')?.reset();
    document.getElementById('showFilter').value = '10';

    Swal.fire({
        icon: 'success',
        title: 'Reset Berhasil',
        text: 'Filter berhasil direset (simulasi UI).',
        confirmButtonColor: '#9a55ff'
    });
}

function openDetail(id) {
    Swal.fire({
        icon: 'info',
        title: 'Detail Servis',
        text: 'Menampilkan detail pengajuan servis ID ' + id + ' (simulasi UI).',
        confirmButtonColor: '#9a55ff'
    });
}

function openEdit(id) {
    Swal.fire({
        icon: 'success',
        title: 'Edit Servis',
        text: 'Membuka form edit untuk ID ' + id + ' (simulasi UI).',
        confirmButtonColor: '#9a55ff'
    });
}
</script>
@endpush
