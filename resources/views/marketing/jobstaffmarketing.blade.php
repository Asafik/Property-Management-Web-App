@extends('layouts.partial.app')

@section('title', 'Daftar Tugas Staff Marketing')

@section('content')

<style>
    .card {
        border-radius: 12px !important;
        border: none !important;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
    }

    .stat-card-custom {
        border-radius: 12px;
        border: none;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        transition: all 0.2s ease;
    }

    .stat-card-custom:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(154, 85, 255, 0.12);
    }

    .filter-card {
        padding: 0.85rem 1rem !important;
        margin-bottom: 1rem !important;
        background: #ffffff;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.03);
    }

    .form-control, .form-select, select.form-control {
        border: 1px solid #e9ecef;
        border-radius: 8px !important;
        padding: 0.6rem 0.8rem;
        font-size: 0.88rem;
        color: #2c2e3f;
        background-color: #ffffff;
        height: auto;
        min-height: 38px;
        transition: all 0.2s ease;
    }

    .form-control:focus, .form-select:focus, select.form-control:focus {
        border-color: #9a55ff !important;
        box-shadow: 0 0 0 3px rgba(154, 85, 255, 0.15) !important;
        outline: none;
    }

    .btn-gradient-primary {
        background: linear-gradient(to right, #da8cff, #9a55ff) !important;
        color: #ffffff !important;
        border: none;
    }

    .btn-gradient-secondary {
        background: #6c757d !important;
        color: #ffffff !important;
        border: none;
    }

    .btn-icon-only {
        width: 38px;
        height: 38px;
        padding: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        flex-shrink: 0;
    }

    .btn-icon-only i {
        font-size: 1.15rem;
    }

    .btn-icon-only-mobile {
        height: 38px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
    }

    .btn-icon-only-mobile i {
        font-size: 1.15rem;
    }

    .table-wrapper {
        background: #ffffff;
        border-radius: 12px;
        overflow: hidden;
    }

    .table thead th {
        background: #f8f9fc !important;
        color: #4b49ac !important;
        font-weight: 700;
        font-size: 0.82rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 1rem 0.85rem;
        border-bottom: 2px solid #edf2f9;
        white-space: nowrap;
    }

    .table tbody td {
        padding: 0.9rem 0.85rem;
        font-size: 0.88rem;
        color: #2c2e3f;
        border-bottom: 1px solid #f1f5f9;
        vertical-align: middle;
    }

    .table-hover tbody tr:hover {
        background-color: #fcfaff;
    }

    .badge-status {
        padding: 0.35rem 0.75rem;
        border-radius: 30px;
        font-weight: 600;
        font-size: 0.78rem;
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }

    .badge-status.pending {
        background: #fef3c7;
        color: #b45309;
        border: 1px solid #fde68a;
    }

    .badge-status.proses {
        background: #e0f2fe;
        color: #0284c7;
        border: 1px solid #bae6fd;
    }

    .badge-status.selesai {
        background: #dcfce7;
        color: #15803d;
        border: 1px solid #bbf7d0;
    }

    .btn-action {
        width: 32px;
        height: 32px;
        padding: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        margin: 0 2px;
        transition: all 0.2s ease;
        border: none;
        cursor: pointer;
        color: #ffffff !important;
    }

    .btn-action:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
    }

    .btn-action.progress-btn {
        background: linear-gradient(135deg, #06b6d4, #0ea5e9);
    }

    .btn-action.edit-btn {
        background: linear-gradient(135deg, #6366f1, #4f46e5);
    }

    .btn-action.delete-btn {
        background: linear-gradient(135deg, #ef4444, #dc2626);
    }

    .staff-avatar {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: linear-gradient(135deg, #da8cff, #9a55ff);
        color: #ffffff;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 0.78rem;
        margin-right: 0.5rem;
        flex-shrink: 0;
    }

    .modal-content {
        border: none;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0,0,0,0.15);
    }

    .modal-header {
        background: linear-gradient(135deg, #da8cff, #9a55ff) !important;
        color: white !important;
        padding: 1.1rem 1.5rem;
        border-bottom: none;
    }

    .modal-header .btn-close {
        filter: brightness(0) invert(1);
    }

    .modal-title {
        font-weight: 700;
        font-size: 1.1rem;
        color: #ffffff !important;
    }

    .modal-body {
        padding: 1.5rem;
        background: #ffffff;
    }

    .modal-body .form-label {
        font-size: 0.82rem;
        font-weight: 700;
        color: #3b3f5c !important;
        margin-bottom: 0.35rem;
        letter-spacing: 0.3px;
    }

    .modal-footer {
        background: #fafbfe;
        border-top: 1px solid #edf2f9;
        padding: 1rem 1.5rem;
    }

    /* Select2 Theme Alignment */
    .select2-container--bootstrap-5 .select2-selection {
        min-height: 38px !important;
        height: 38px !important;
        padding: 0.375rem 0.75rem !important;
        display: flex !important;
        align-items: center !important;
        border-color: #ebedf2 !important;
        border-radius: 6px !important;
        font-size: 0.875rem !important;
        background-color: #ffffff !important;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }
    .select2-container--bootstrap-5 .select2-selection--single .select2-selection__rendered {
        line-height: 1.5 !important;
        padding-left: 0 !important;
        color: #3b3f5c !important;
    }
    .select2-container--bootstrap-5.select2-container--focus .select2-selection,
    .select2-container--bootstrap-5.select2-container--open .select2-selection {
        border-color: #bfa5fa !important;
        box-shadow: 0 0 0 0.2rem rgba(154, 85, 255, 0.12) !important;
    }

    /* Select2 Dropdown Options Soft Hover & Active */
    .select2-container--bootstrap-5 .select2-dropdown {
        border: 1px solid #e2e8f0 !important;
        border-radius: 8px !important;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08) !important;
        overflow: hidden !important;
        z-index: 1050 !important;
    }
    .select2-container--bootstrap-5 .select2-results__option {
        padding: 0.45rem 0.85rem !important;
        font-size: 0.85rem !important;
        color: #3b3f5c !important;
        transition: background-color 0.15s ease, color 0.15s ease;
    }
    /* Hover / Highlighted (Soft Pastel Tint) */
    .select2-container--bootstrap-5 .select2-results__option--highlighted,
    .select2-container--bootstrap-5 .select2-results__option--highlighted.select2-results__option--selectable {
        background-color: #f6f1ff !important;
        color: #792fe0 !important;
    }
    /* Active / Selected (Soft Purple Tint) */
    .select2-container--bootstrap-5 .select2-results__option[aria-selected="true"],
    .select2-container--bootstrap-5 .select2-results__option--selected {
        background-color: #eee4ff !important;
        color: #6b21a8 !important;
        font-weight: 600 !important;
    }
    .select2-container--bootstrap-5 .select2-results__option--selected.select2-results__option--highlighted {
        background-color: #e4d3fe !important;
        color: #581c87 !important;
    }
</style>

<div class="container-fluid p-2 p-sm-3 p-md-4">

    <!-- Header Card Banner -->
    <div class="row mb-3 mb-sm-3 mb-md-4">
        <div class="col-12">
            <div class="card shadow-sm border-0 header-card">
                <div class="card-body p-4 p-md-4 py-4 py-md-4 d-flex justify-content-between align-items-center" style="min-height: 105px;">
                    <div>
                        <h3 class="text-dark mb-1 fw-bold" style="font-size: 1.35rem;">
                            Tugas Staff Marketing
                        </h3>
                        <p class="text-muted mb-0" style="font-size: 0.9rem;">
                            Kelola daftar penugasan dan progres pekerjaan tim marketing
                        </p>
                    </div>
                    <div class="d-none d-sm-block pe-2">
                        <i class="mdi mdi-clipboard-text-outline" style="font-size: 3rem; color: #9a55ff; opacity: 0.25;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistic Cards - Style Dashboard -->
    <div class="row g-3 mb-4">
        <div class="col-6 col-md-3">
            <div class="card stat-card-custom shadow-sm border-0 h-100 mb-0">
                <div class="card-body d-flex justify-content-between align-items-center p-3">
                    <div>
                        <h3 class="text-dark mb-1 fw-bold">{{ $totalTugas ?? 0 }}</h3>
                        <p class="text-muted mb-0">Total Tugas</p>
                    </div>
                    <div class="d-none d-sm-block">
                        <i class="mdi mdi-clipboard-list" style="font-size: 2.5rem; color: #9a55ff; opacity: 0.2;"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-6 col-md-3">
            <div class="card stat-card-custom shadow-sm border-0 h-100 mb-0">
                <div class="card-body d-flex justify-content-between align-items-center p-3">
                    <div>
                        <h3 class="text-dark mb-1 fw-bold">{{ $pendingTugas ?? 0 }}</h3>
                        <p class="text-muted mb-0">Pending</p>
                    </div>
                    <div class="d-none d-sm-block">
                        <i class="mdi mdi-clock-outline" style="font-size: 2.5rem; color: #9a55ff; opacity: 0.2;"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-6 col-md-3">
            <div class="card stat-card-custom shadow-sm border-0 h-100 mb-0">
                <div class="card-body d-flex justify-content-between align-items-center p-3">
                    <div>
                        <h3 class="text-dark mb-1 fw-bold">{{ $prosesTugas ?? 0 }}</h3>
                        <p class="text-muted mb-0">Sedang Proses</p>
                    </div>
                    <div class="d-none d-sm-block">
                        <i class="mdi mdi-progress-wrench" style="font-size: 2.5rem; color: #9a55ff; opacity: 0.2;"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-6 col-md-3">
            <div class="card stat-card-custom shadow-sm border-0 h-100 mb-0">
                <div class="card-body d-flex justify-content-between align-items-center p-3">
                    <div>
                        <h3 class="text-dark mb-1 fw-bold">{{ $selesaiTugas ?? 0 }}</h3>
                        <p class="text-muted mb-0">Selesai</p>
                    </div>
                    <div class="d-none d-sm-block">
                        <i class="mdi mdi-check-decagram" style="font-size: 2.5rem; color: #9a55ff; opacity: 0.2;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel Data & Filter Card -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white d-flex flex-wrap flex-md-row justify-content-between align-items-center gap-3 p-3">
                    <h5 class="card-title mb-0 fw-bold">
                        <i class="mdi mdi-format-list-bulleted me-2 text-primary"></i>Daftar Tugas Marketing
                    </h5>
                    <button class="btn btn-gradient-primary d-inline-flex align-items-center gap-1" data-bs-toggle="modal" data-bs-target="#createTaskModal">
                        <i class="mdi mdi-plus-circle"></i> Tambah Tugas
                    </button>
                </div>

                <div class="card-body p-3">
                    <!-- FILTER SECTION (PERSIS DASHBOARD) -->
                    <div class="filter-card mb-3">

                        <!-- DESKTOP & TABLET VERSION -->
                        <div class="filter-row-desktop d-none d-md-block">
                            <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 w-100">
                                <div class="d-flex flex-wrap align-items-center gap-2 flex-grow-1">

                                    <!-- Search -->
                                    <div style="min-width: 200px; max-width: 280px; flex: 1;">
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="searchInput"
                                                placeholder="Cari tugas / deskripsi / staff..." value="{{ request('search') }}"
                                                style="border-top-right-radius: 0 !important; border-bottom-right-radius: 0 !important; border-right: none;">
                                            <button class="btn btn-gradient-primary d-flex align-items-center justify-content-center px-3" 
                                                type="button" id="searchSubmitBtn" title="Cari"
                                                style="border-top-left-radius: 0 !important; border-bottom-left-radius: 0 !important; border-top-right-radius: 4px !important; border-bottom-right-radius: 4px !important; height: 38px; box-shadow: none;">
                                                <i class="mdi mdi-magnify" style="font-size: 1.15rem; color: #ffffff;"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <!-- Staff Marketing -->
                                    <div style="min-width: 200px; max-width: 280px;">
                                        <select class="form-control select2" id="employeeSelect" style="width: 100%;">
                                            <option value="">Semua Staff Marketing</option>
                                            @foreach ($marketingStaff as $staff)
                                                <option value="{{ $staff->id }}" {{ request('employee_id') == $staff->id ? 'selected' : '' }}>
                                                    {{ $staff->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Status -->
                                    <div style="width: 150px;">
                                        <select class="form-control select2" id="statusSelect" style="width: 100%;">
                                            <option value="">Semua Status</option>
                                            <option value="Pending" {{ request('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="Proses" {{ request('status') == 'Proses' ? 'selected' : '' }}>Proses</option>
                                            <option value="Selesai" {{ request('status') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                        </select>
                                    </div>

                                </div>

                                <!-- Right Side: Limit Dropdown + Filter & Reset Buttons -->
                                <div class="d-flex align-items-center gap-2 ms-auto">
                                    <div style="width: 90px;">
                                        <select class="form-control select2" id="limitSelect" style="width: 100%;">
                                            <option value="10" {{ request('limit') == 10 ? 'selected' : '' }}>10</option>
                                            <option value="15" {{ request('limit', 15) == 15 ? 'selected' : '' }}>15</option>
                                            <option value="25" {{ request('limit') == 25 ? 'selected' : '' }}>25</option>
                                            <option value="50" {{ request('limit') == 50 ? 'selected' : '' }}>50</option>
                                        </select>
                                    </div>
                                    <button type="button" class="btn btn-gradient-primary btn-icon-only" id="filterBtn" title="Filter">
                                        <i class="mdi mdi-filter"></i>
                                    </button>
                                    <button type="button" class="btn btn-gradient-secondary btn-icon-only" id="refreshBTN" title="Reset">
                                        <i class="mdi mdi-refresh"></i>
                                    </button>
                                </div>

                            </div>
                        </div>

                        <!-- MOBILE VERSION -->
                        <div class="filter-row-mobile d-block d-md-none">
                            <div class="row g-2">
                                <div class="col-12 mb-2">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="searchInputMobile"
                                            placeholder="Cari tugas / deskripsi / staff..." value="{{ request('search') }}"
                                            style="border-top-right-radius: 0 !important; border-bottom-right-radius: 0 !important; border-right: none;">
                                        <button class="btn btn-gradient-primary d-flex align-items-center justify-content-center px-3" 
                                            type="button" id="searchSubmitBtnMobile" title="Cari"
                                            style="border-top-left-radius: 0 !important; border-bottom-left-radius: 0 !important; border-top-right-radius: 4px !important; border-bottom-right-radius: 4px !important; height: 38px; box-shadow: none;">
                                            <i class="mdi mdi-magnify" style="font-size: 1.15rem; color: #ffffff;"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-12 mb-2">
                                    <select class="form-control select2-mobile" id="employeeSelectMobile" style="width: 100%;">
                                        <option value="">Semua Staff Marketing</option>
                                        @foreach ($marketingStaff as $staff)
                                            <option value="{{ $staff->id }}" {{ request('employee_id') == $staff->id ? 'selected' : '' }}>
                                                {{ $staff->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12 mb-2">
                                    <select class="form-control select2-mobile" id="statusSelectMobile" style="width: 100%;">
                                        <option value="">Semua Status</option>
                                        <option value="Pending" {{ request('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="Proses" {{ request('status') == 'Proses' ? 'selected' : '' }}>Proses</option>
                                        <option value="Selesai" {{ request('status') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                    </select>
                                </div>
                                <div class="col-12 mb-2">
                                    <select class="form-control select2-mobile" id="limitSelectMobile" style="width: 100%;">
                                        <option value="10" {{ request('limit') == 10 ? 'selected' : '' }}>10</option>
                                        <option value="15" {{ request('limit', 15) == 15 ? 'selected' : '' }}>15</option>
                                        <option value="25" {{ request('limit') == 25 ? 'selected' : '' }}>25</option>
                                        <option value="50" {{ request('limit') == 50 ? 'selected' : '' }}>50</option>
                                    </select>
                                </div>
                                <div class="col-6">
                                    <button type="button" class="btn btn-gradient-primary btn-icon-only-mobile w-100" id="filterBtnMobile" title="Filter">
                                        <i class="mdi mdi-filter"></i>
                                    </button>
                                </div>
                                <div class="col-6">
                                    <button type="button" class="btn btn-gradient-secondary btn-icon-only-mobile w-100" id="refreshBTNMobile" title="Reset">
                                        <i class="mdi mdi-refresh"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Table Responsive -->
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead>
                                <tr>
                                    <th class="text-center" width="5%">No</th>
                                    <th width="20%">Nama Staff</th>
                                    <th width="25%">Nama Tugas</th>
                                    <th>Deskripsi</th>
                                    <th width="15%">Deadline</th>
                                    <th width="12%">Status</th>
                                    <th class="text-center" width="12%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($tugas as $index => $item)
                                    @php
                                        $staffName = $item->employee->name ?? 'Staff';
                                        $initials = collect(explode(' ', trim($staffName)))
                                            ->filter()
                                            ->take(2)
                                            ->map(fn($w) => strtoupper(substr($w, 0, 1)))
                                            ->implode('');
                                    @endphp
                                    <tr>
                                        <td class="text-center fw-bold">{{ $tugas->firstItem() + $index }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="staff-avatar">{{ $initials ?: 'ST' }}</div>
                                                <div class="fw-bold">{{ $item->employee->name ?? 'Tidak ada staff' }}</div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <i class="mdi mdi-clipboard-text-outline text-primary me-2" style="font-size: 1.1rem;"></i>
                                                <span class="fw-bold">{{ $item->nama_tugas }}</span>
                                            </div>
                                        </td>
                                        <td style="white-space: normal; min-width: 180px;">
                                            {{ Str::limit($item->deskripsi, 80) ?: '-' }}
                                        </td>
                                        <td>
                                            <i class="mdi mdi-calendar-clock text-primary me-1"></i>
                                            {{ \Carbon\Carbon::parse($item->deadline)->format('d M Y') }}
                                        </td>
                                        <td>
                                            @php
                                                $statusClass = strtolower($item->status);
                                            @endphp
                                            <span class="badge-status {{ $statusClass }}">
                                                @if($item->status == 'Pending')
                                                    <i class="mdi mdi-clock-outline"></i>
                                                @elseif($item->status == 'Proses')
                                                    <i class="mdi mdi-progress-wrench"></i>
                                                @elseif($item->status == 'Selesai')
                                                    <i class="mdi mdi-check-circle-outline"></i>
                                                @endif
                                                {{ $item->status }}
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('marketing.tugas.progress', $item->id) }}" class="btn-action progress-btn" title="Progress Tugas">
                                                <i class="mdi mdi-chart-timeline-variant"></i>
                                            </a>
                                            <button class="btn-action edit-btn" title="Edit Tugas" data-bs-toggle="modal" data-bs-target="#editTaskModal{{ $item->id }}">
                                                <i class="mdi mdi-pencil"></i>
                                            </button>
                                            <form action="{{ route('marketing.tugas.destroy', $item->id) }}" method="POST" class="d-inline" id="deleteForm{{ $item->id }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn-action delete-btn" title="Hapus Tugas" onclick="confirmDeleteTask('{{ $item->id }}', '{{ addslashes($item->nama_tugas) }}')">
                                                    <i class="mdi mdi-delete"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center text-muted py-5">
                                            <i class="mdi mdi-clipboard-text-off-outline" style="font-size: 3rem; color: #9a55ff; opacity: 0.3;"></i>
                                            <p class="mt-2 mb-0 fw-bold">Belum ada data tugas untuk staff marketing.</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mt-4">
                        <div class="pagination-info mb-2 mb-sm-0 text-muted small">
                            Menampilkan {{ $tugas->firstItem() ?? 0 }} - {{ $tugas->lastItem() ?? 0 }} dari {{ $tugas->total() }} tugas
                        </div>
                        <nav aria-label="Page navigation">
                            {{ $tugas->links('pagination::bootstrap-4') }}
                        </nav>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>

<!-- Modal Create Task -->
<div class="modal fade" id="createTaskModal" tabindex="-1" aria-labelledby="createTaskModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createTaskModalLabel">
                    <i class="mdi mdi-plus-circle me-2"></i>Tambah Tugas Baru
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="{{ route('marketing.tugas.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="employee_id" class="form-label">Ditugaskan Kepada <span class="text-danger">*</span></label>
                        <select class="form-control" id="employee_id" name="employee_id" required>
                            <option value="" disabled selected>-- Pilih Staff Marketing --</option>
                            @foreach ($marketingStaff as $staff)
                                <option value="{{ $staff->id }}">{{ $staff->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="nama_tugas" class="form-label">Nama Tugas <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="nama_tugas" name="nama_tugas" required placeholder="Contoh: Pameran Properti Mall A">
                    </div>

                    <div class="row">
                        <div class="col-6 mb-3">
                            <label for="deadline" class="form-label">Deadline <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="deadline" name="deadline" required>
                        </div>

                        <div class="col-6 mb-3">
                            <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                            <select class="form-control" id="status" name="status" required>
                                <option value="Pending" selected>Pending</option>
                                <option value="Proses">Proses</option>
                                <option value="Selesai">Selesai</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi / Detail Penugasan</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" placeholder="Masukkan instruksi atau detail tugas..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-gradient-secondary" data-bs-dismiss="modal">
                        <i class="mdi mdi-close me-1"></i>Batal
                    </button>
                    <button type="submit" class="btn btn-gradient-primary">
                        <i class="mdi mdi-content-save me-1"></i>Simpan Tugas
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Task -->
@foreach ($tugas as $item)
<div class="modal fade" id="editTaskModal{{ $item->id }}" tabindex="-1" aria-labelledby="editTaskModalLabel{{ $item->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editTaskModalLabel{{ $item->id }}">
                    <i class="mdi mdi-pencil-circle me-2"></i>Edit Tugas Marketing
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="{{ route('marketing.tugas.update', $item->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="employee_id_{{ $item->id }}" class="form-label">Ditugaskan Kepada <span class="text-danger">*</span></label>
                        <select class="form-control" id="employee_id_{{ $item->id }}" name="employee_id" required>
                            <option value="" disabled>-- Pilih Staff Marketing --</option>
                            @foreach ($marketingStaff as $staff)
                                <option value="{{ $staff->id }}" {{ $item->employee_id == $staff->id ? 'selected' : '' }}>
                                    {{ $staff->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="nama_tugas_{{ $item->id }}" class="form-label">Nama Tugas <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="nama_tugas_{{ $item->id }}" name="nama_tugas" value="{{ $item->nama_tugas }}" required>
                    </div>

                    <div class="row">
                        <div class="col-6 mb-3">
                            <label for="deadline_{{ $item->id }}" class="form-label">Deadline <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="deadline_{{ $item->id }}" name="deadline" value="{{ \Carbon\Carbon::parse($item->deadline)->format('Y-m-d') }}" required>
                        </div>

                        <div class="col-6 mb-3">
                            <label for="status_{{ $item->id }}" class="form-label">Status <span class="text-danger">*</span></label>
                            <select class="form-control" id="status_{{ $item->id }}" name="status" required>
                                <option value="Pending" {{ $item->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                <option value="Proses" {{ $item->status == 'Proses' ? 'selected' : '' }}>Proses</option>
                                <option value="Selesai" {{ $item->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="deskripsi_{{ $item->id }}" class="form-label">Deskripsi / Detail Penugasan</label>
                        <textarea class="form-control" id="deskripsi_{{ $item->id }}" name="deskripsi" rows="3">{{ $item->deskripsi }}</textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-gradient-secondary" data-bs-dismiss="modal">
                        <i class="mdi mdi-close me-1"></i>Batal
                    </button>
                    <button type="submit" class="btn btn-gradient-primary">
                        <i class="mdi mdi-content-save me-1"></i>Update Tugas
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

@endsection

@push('scripts')
<script>
// Filter Function - Mirroring Dashboard
function executeFilter(isMobile = false) {
    const search = isMobile 
        ? document.getElementById('searchInputMobile').value 
        : document.getElementById('searchInput').value;
    
    const employeeId = isMobile 
        ? document.getElementById('employeeSelectMobile').value 
        : document.getElementById('employeeSelect').value;
    
    const status = isMobile 
        ? document.getElementById('statusSelectMobile').value 
        : document.getElementById('statusSelect').value;
    
    const limit = isMobile 
        ? document.getElementById('limitSelectMobile').value 
        : document.getElementById('limitSelect').value;

    let url = new URL(window.location.origin + window.location.pathname);
    
    if (search.trim()) url.searchParams.set('search', search.trim());
    if (employeeId) url.searchParams.set('employee_id', employeeId);
    if (status) url.searchParams.set('status', status);
    if (limit) url.searchParams.set('limit', limit);

    window.location.href = url.toString();
}

function resetAllFilters() {
    window.location.href = "{{ route('master.data.tugas-staff-marketing') }}";
}

$(document).ready(function() {
    // Init Select2 Filters (All Without Search Input)
    $('#employeeSelect, #employeeSelectMobile, #statusSelect, #limitSelect, #statusSelectMobile, #limitSelectMobile').select2({
        theme: 'bootstrap-5',
        minimumResultsForSearch: Infinity,
        width: '100%'
    });
});

document.addEventListener('DOMContentLoaded', function() {
    // Desktop Buttons
    const filterBtn = document.getElementById('filterBtn');
    const refreshBTN = document.getElementById('refreshBTN');
    const searchSubmitBtn = document.getElementById('searchSubmitBtn');
    const searchInput = document.getElementById('searchInput');

    if (filterBtn) filterBtn.addEventListener('click', () => executeFilter(false));
    if (searchSubmitBtn) searchSubmitBtn.addEventListener('click', () => executeFilter(false));
    if (refreshBTN) refreshBTN.addEventListener('click', resetAllFilters);
    if (searchInput) {
        searchInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') executeFilter(false);
        });
    }

    // Mobile Buttons
    const filterBtnMobile = document.getElementById('filterBtnMobile');
    const refreshBTNMobile = document.getElementById('refreshBTNMobile');
    const searchSubmitBtnMobile = document.getElementById('searchSubmitBtnMobile');
    const searchInputMobile = document.getElementById('searchInputMobile');

    if (filterBtnMobile) filterBtnMobile.addEventListener('click', () => executeFilter(true));
    if (searchSubmitBtnMobile) searchSubmitBtnMobile.addEventListener('click', () => executeFilter(true));
    if (refreshBTNMobile) refreshBTNMobile.addEventListener('click', resetAllFilters);
    if (searchInputMobile) {
        searchInputMobile.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') executeFilter(true);
        });
    }
});

function confirmDeleteTask(id, taskName) {
    Swal.fire({
        title: 'Yakin ingin menghapus?',
        html: `Tugas <b>${taskName}</b> akan dihapus secara permanen!`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: 'Menghapus...',
                html: 'Mohon tunggu sebentar',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
            document.getElementById('deleteForm' + id).submit();
        }
    });
}

@if (session('success'))
    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: "{{ session('success') }}",
        timer: 3000,
        timerProgressBar: true,
        confirmButtonText: 'OK',
        confirmButtonColor: '#9a55ff'
    });
@endif

@if (session('error'))
    Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: "{{ session('error') }}",
        confirmButtonColor: '#9a55ff',
        confirmButtonText: 'OK'
    });
@endif
</script>
@endpush
