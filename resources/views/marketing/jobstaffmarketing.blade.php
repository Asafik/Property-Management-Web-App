@extends('layouts.partial.app')

@section('title', 'Daftar Tugas Staff Marketing')

@section('content')

<style>
.card {
    transition: all 0.3s ease;
    margin-bottom: 1rem;
    border: none !important;
    box-shadow: 0 4px 15px rgba(0,0,0,0.05);
}
.card:hover { box-shadow: 0 8px 25px rgba(154, 85, 255, 0.1) !important; }
.card-header {
    background: linear-gradient(135deg, #ffffff, #f8f9fa);
    border-bottom: 1px solid #e9ecef;
    padding: 0.75rem;
}
@media (min-width: 576px) { .card-header { padding: 1rem; } }
@media (min-width: 768px) { .card-header { padding: 1.2rem; } }

.card-body { padding: 0.75rem; }
@media (min-width: 576px) { .card-body { padding: 1rem; } }
@media (min-width: 768px) { .card-body { padding: 1.2rem; } }

.card-title { font-size: 0.9rem; font-weight: 600; color: #9a55ff; margin-bottom: 0; }
@media (min-width: 576px) { .card-title { font-size: 1rem; } }
@media (min-width: 768px) { .card-title { font-size: 1.1rem; } }

.filter-card {
    background: linear-gradient(135deg, #f9f7ff, #f2ecff);
    border-radius: 12px;
    padding: 1rem;
    margin-bottom: 1.25rem;
    border: none;
}
.filter-card .form-label {
    font-size: 0.85rem;
    font-weight: 600;
    color: #9a55ff !important;
    margin-bottom: 0.4rem;
    letter-spacing: 0.3px;
}
.filter-card .form-control,
.filter-card .form-select {
    padding: 0.5rem 0.75rem;
    font-size: 0.9rem;
    border-radius: 8px;
    height: auto;
    min-height: 40px;
    border: 1px solid #e0e4e9;
}

.form-control, .form-select {
    border: 1px solid #e9ecef;
    border-radius: 8px;
    padding: 0.6rem 0.8rem;
    font-size: 0.9rem;
    transition: all 0.2s ease;
    background-color: #ffffff;
    color: #2c2e3f;
    height: auto;
}
@media (min-width: 576px) {
    .form-control, .form-select {
        padding: 0.7rem 1rem;
        font-size: 0.95rem;
        border-radius: 10px;
    }
}
.form-control:focus, .form-select:focus {
    border-color: #9a55ff;
    box-shadow: 0 0 0 3px rgba(154, 85, 255, 0.1);
    outline: none;
}
.form-label {
    font-size: 0.85rem;
    font-weight: 600;
    color: #9a55ff !important;
    margin-bottom: 0.3rem;
    letter-spacing: 0.3px;
    font-family: 'Nunito', sans-serif;
}

.btn {
    font-size: 0.85rem;
    padding: 0.6rem 1rem;
    border-radius: 8px;
    font-weight: 600;
    transition: all 0.3s ease;
    font-family: 'Nunito', sans-serif;
    border: none;
}
@media (min-width: 576px) {
    .btn {
        font-size: 0.9rem;
        padding: 0.7rem 1.2rem;
        border-radius: 10px;
    }
}
.btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}
.btn-gradient-primary   { background: linear-gradient(to right, #da8cff, #9a55ff) !important; color: #ffffff !important; }
.btn-gradient-secondary { background: #6c757d !important; color: #ffffff !important; }
.btn-gradient-secondary:hover { background: #5a6268 !important; }
.btn-gradient-info { background: linear-gradient(135deg, #17a2b8, #56c6d8) !important; color: #ffffff !important; }
.btn-gradient-warning { background: linear-gradient(135deg, #ffc107, #ffdb6d) !important; color: #2c2e3f !important; }
.btn-gradient-danger { background: linear-gradient(135deg, #dc3545, #e4606d) !important; color: #ffffff !important; }
.btn-gradient-success { background: linear-gradient(135deg, #28a745, #6fdf8c) !important; color: #ffffff !important; }

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
.btn-action i { font-size: 1.1rem; }
.btn-action.progress {
    background: linear-gradient(135deg, #17a2b8, #56c6d8);
    color: white;
}
.btn-action.progress:hover {
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
.btn-action.delete {
    background: linear-gradient(135deg, #dc3545, #e4606d);
    color: white;
}
.btn-action.delete:hover {
    transform: translateY(-3px);
    box-shadow: 0 5px 15px rgba(220, 53, 69, 0.4);
}

.btn-icon-only {
    width: 40px;
    height: 40px;
    padding: 0;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: 8px;
}
.btn-icon-only i { font-size: 1.2rem; margin: 0; }

.table-wrapper {
    position: relative;
    width: 100%;
    overflow-x: auto;
    overflow-y: visible;
    -webkit-overflow-scrolling: touch;
    border-radius: 8px;
    margin-bottom: 0.5rem;
}
.table-wrapper::-webkit-scrollbar {
    height: 8px;
}
.table-wrapper::-webkit-scrollbar-track {
    background: #f0f0f0;
    border-radius: 10px;
}
.table-wrapper::-webkit-scrollbar-thumb {
    background: #9a55ff;
    border-radius: 10px;
}
.table-wrapper::-webkit-scrollbar-thumb:hover {
    background: #7a3fcc;
}

.table {
    width: 100%;
    min-width: 800px;
    border-collapse: collapse;
    margin-bottom: 0;
}
.table thead th {
    background: linear-gradient(135deg, #f8f9fa, #f1f3f5);
    color: #9a55ff;
    font-weight: 600;
    font-size: 0.8rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    border-bottom: 2px solid #e9ecef;
    padding: 0.8rem 0.5rem;
    white-space: nowrap;
}
@media (min-width: 576px) { .table thead th { font-size: 0.85rem; padding: 0.9rem 0.6rem; } }
@media (min-width: 768px) { .table thead th { font-size: 0.9rem; padding: 1rem 0.75rem; } }

.table thead th:first-child { padding-left: 0.5rem; width: 50px; text-align: center; }
.table tbody td:first-child { padding-left: 0.5rem; font-weight: 500; width: 50px; text-align: center; }
.table tbody td {
    vertical-align: middle;
    font-size: 0.85rem;
    padding: 0.8rem 0.5rem;
    border-bottom: 1px solid #e9ecef;
    color: #2c2e3f;
    white-space: nowrap;
}
@media (min-width: 576px) { .table tbody td { font-size: 0.9rem; padding: 0.9rem 0.6rem; } }
@media (min-width: 768px) { .table tbody td { font-size: 0.95rem; padding: 1rem 0.75rem; } }
.table tbody tr:hover { background-color: #f8f9fa; }

.badge-status {
    padding: 0.35rem 0.8rem;
    border-radius: 20px;
    font-weight: 600;
    font-size: 0.75rem;
    display: inline-block;
}
.badge-status.pending {
    background: linear-gradient(135deg, #6c757d, #8f9baf);
    color: #fff;
}
.badge-status.proses {
    background: linear-gradient(135deg, #ffc107, #ffdb6d);
    color: #2c2e3f;
}
.badge-status.selesai {
    background: linear-gradient(135deg, #28a745, #6fdf8c);
    color: #fff;
}

.pagination { margin: 0; gap: 3px; }
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

.modal-content {
    border: none;
    border-radius: 16px;
}
.modal-header {
    background: linear-gradient(135deg, #da8cff, #9a55ff);
    color: white;
    border-radius: 16px 16px 0 0;
    padding: 1rem 1.5rem;
}
.modal-header .btn-close {
    filter: brightness(0) invert(1);
}
.modal-title {
    font-weight: 600;
    font-size: 1.1rem;
}
.modal-body {
    padding: 1.5rem;
}
.modal-footer {
    border-top: 1px solid #e9ecef;
    padding: 1rem 1.5rem;
}

.text-primary  { color: #9a55ff !important; }
.text-muted    { color: #a5b3cb !important; }
.fw-bold       { font-weight: 600 !important; }

h3.text-dark {
    font-size: 1.3rem !important;
    font-weight: 700;
    color: #2c2e3f !important;
    margin-bottom: 0.5rem !important;
}
@media (min-width: 576px) { h3.text-dark { font-size: 1.5rem !important; } }
@media (min-width: 768px) { h3.text-dark { font-size: 1.7rem !important; } }

.mdi { vertical-align: middle; }

.filter-controls {
    display: flex;
    flex-wrap: wrap;
    align-items: flex-end;
    gap: 1rem;
}
.filter-controls .filter-search {
    flex: 1;
    min-width: 200px;
}
.filter-controls .filter-limit {
    width: 100px;
}
.filter-controls .filter-buttons {
    display: flex;
    gap: 0.5rem;
}

.alert {
    border-radius: 12px;
    border: none;
    animation: slideDown 0.3s ease;
}

@keyframes slideDown {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
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
                            <i class="mdi mdi-format-list-checkbox me-2" style="color: #9a55ff;"></i>Daftar Tugas Staff Marketing
                        </h3>
                        <p class="text-muted mb-0">
                            Kelola tugas dan progres pekerjaan staff marketing
                        </p>
                    </div>
                    <div class="d-none d-sm-block">
                        <i class="mdi mdi-format-list-checkbox" style="font-size: 2.5rem; color: #9a55ff; opacity: 0.2;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="mdi mdi-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="mdi mdi-alert-circle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row mt-2 mt-sm-2 mt-md-3">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-white d-flex flex-wrap flex-md-row justify-content-between align-items-center gap-2">
                    <h5 class="card-title mb-0">
                        <i class="mdi mdi-format-list-bulleted me-2"></i>Daftar Tugas
                    </h5>
                    <button class="btn btn-gradient-primary" style="padding: 0.6rem 1.2rem; font-size: 0.9rem;" data-bs-toggle="modal" data-bs-target="#createTaskModal">
                        <i class="mdi mdi-plus me-1"></i>Tambah Tugas
                    </button>
                </div>

                <div class="card-body">
                    <div class="filter-card mb-4">
                        <div class="card-body">
                            <div class="filter-controls">
                                <div class="filter-search">
                                    <label class="form-label">Cari Nama Tugas</label>
                                    <input type="text" class="form-control" id="searchInput" placeholder="Cari nama tugas..." value="{{ request('search') }}">
                                </div>
                                <div class="filter-limit">
                                    <label class="form-label">Tampilkan</label>
                                    <select class="form-select" id="limitSelect">
                                        <option value="10" {{ request('limit') == 10 ? 'selected' : '' }}>10</option>
                                        <option value="15" {{ request('limit') == 15 ? 'selected' : '' }}>15</option>
                                        <option value="25" {{ request('limit') == 25 ? 'selected' : '' }}>25</option>
                                    </select>
                                </div>
                                <div class="filter-buttons">
                                    <button type="button" class="btn btn-gradient-primary btn-icon-only" title="Filter" onclick="applyFilter()">
                                        <i class="mdi mdi-filter"></i>
                                    </button>
                                    <button type="button" class="btn btn-gradient-secondary btn-icon-only" title="Reset" onclick="resetFilter()">
                                        <i class="mdi mdi-refresh"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="table-wrapper">
                        <table class="table table-hover align-middle">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th>Nama Staff</th>
                                    <th>Nama Tugas</th>
                                    <th>Deskripsi</th>
                                    <th>Deadline</th>
                                    <th>Status</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($tugas as $index => $item)
                                    <tr>
                                        <td class="text-center fw-bold">{{ $tugas->firstItem() + $index }}</td>
                                        <td>
                                            <i class="mdi mdi-account text-primary me-2"></i>
                                            {{ $item->employee->name ?? 'Tidak ada staff' }}
                                        </td>
                                        <td>
                                            <i class="mdi mdi-clipboard-list text-primary me-2"></i>
                                            <span class="fw-bold">{{ $item->nama_tugas }}</span>
                                        </td>
                                        <td style="white-space: normal; min-width: 200px;">
                                            {{ Str::limit($item->deskripsi, 100) ?: '-' }}
                                        </td>
                                        <td>
                                            <i class="mdi mdi-calendar-clock me-1"></i>
                                            {{ \Carbon\Carbon::parse($item->deadline)->format('d M Y') }}
                                        </td>
                                        <td>
                                            @php
                                                $statusClass = strtolower($item->status);
                                            @endphp
                                            <span class="badge-status {{ $statusClass }}">
                                                {{ $item->status }}
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('marketing.tugas.progress', $item->id) }}" class="btn-action progress" title="Update Progress">
                                                <i class="mdi mdi-chart-timeline-variant"></i>
                                            </a>
                                            <button class="btn-action edit" title="Edit" data-bs-toggle="modal" data-bs-target="#editTaskModal{{ $item->id }}">
                                                <i class="mdi mdi-pencil"></i>
                                            </button>
                                            <form action="{{ route('marketing.tugas.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirmDelete(event)">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-action delete" title="Hapus">
                                                    <i class="mdi mdi-delete"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center text-muted py-4">
                                            <i class="mdi mdi-inbox-outline" style="font-size: 3rem;"></i>
                                            <p class="mt-2 mb-0">Belum ada data tugas untuk staff marketing.</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mt-4">
                        <div class="pagination-info mb-2 mb-sm-0">
                            Menampilkan {{ $tugas->firstItem() ?? 0 }} - {{ $tugas->lastItem() ?? 0 }} dari {{ $tugas->total() }} data
                        </div>
                        <nav aria-label="Page navigation">
                            {{ $tugas->appends(request()->query())->links('pagination::bootstrap-4') }}
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
                        <select class="form-select" id="employee_id" name="employee_id" required>
                            <option value="" disabled selected>-- Pilih Staff Marketing --</option>
                            @foreach ($marketingStaff as $staff)
                                <option value="{{ $staff->id }}">{{ $staff->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="nama_tugas" class="form-label">Nama Tugas <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="nama_tugas" name="nama_tugas" required placeholder="Masukkan nama tugas...">
                    </div>

                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" placeholder="Opsional..."></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="deadline" class="form-label">Tenggat Waktu (Deadline) <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" id="deadline" name="deadline" required>
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                        <select class="form-select" id="status" name="status" required>
                            <option value="Pending" selected>Pending</option>
                            <option value="Proses">Proses</option>
                            <option value="Selesai">Selesai</option>
                        </select>
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
                    <i class="mdi mdi-pencil-circle me-2"></i>Edit Tugas
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="{{ route('marketing.tugas.update', $item->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="employee_id_{{ $item->id }}" class="form-label">Ditugaskan Kepada <span class="text-danger">*</span></label>
                        <select class="form-select" id="employee_id_{{ $item->id }}" name="employee_id" required>
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

                    <div class="mb-3">
                        <label for="deskripsi_{{ $item->id }}" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="deskripsi_{{ $item->id }}" name="deskripsi" rows="3">{{ $item->deskripsi }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="deadline_{{ $item->id }}" class="form-label">Tenggat Waktu (Deadline) <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" id="deadline_{{ $item->id }}" name="deadline" value="{{ \Carbon\Carbon::parse($item->deadline)->format('Y-m-d') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="status_{{ $item->id }}" class="form-label">Status <span class="text-danger">*</span></label>
                        <select class="form-select" id="status_{{ $item->id }}" name="status" required>
                            <option value="Pending" {{ $item->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                            <option value="Proses" {{ $item->status == 'Proses' ? 'selected' : '' }}>Proses</option>
                            <option value="Selesai" {{ $item->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-gradient-secondary" data-bs-dismiss="modal">
                        <i class="mdi mdi-close me-1"></i>Batal
                    </button>
                    <button type="submit" class="btn btn-gradient-warning">
                        <i class="mdi mdi-pencil me-1"></i>Update Tugas
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
// Filter function
function applyFilter() {
    const search = document.getElementById('searchInput').value;
    const limit = document.getElementById('limitSelect').value;

    let url = new URL(window.location.href);
    if (search) url.searchParams.set('search', search);
    else url.searchParams.delete('search');

    if (limit) url.searchParams.set('limit', limit);
    else url.searchParams.delete('limit');

    url.searchParams.set('page', '1');
    window.location.href = url.toString();
}

// Reset filter
function resetFilter() {
    document.getElementById('searchInput').value = '';
    document.getElementById('limitSelect').value = '15';

    let url = new URL(window.location.href);
    url.searchParams.delete('search');
    url.searchParams.delete('limit');
    url.searchParams.set('page', '1');
    window.location.href = url.toString();
}

// Confirm delete with SweetAlert
function confirmDelete(event) {
    event.preventDefault();
    const form = event.target;

    Swal.fire({
        title: 'Yakin ingin menghapus?',
        text: 'Data tugas akan dihapus secara permanen!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
    });

    return false;
}

// Auto close alert after 3 seconds
document.addEventListener('DOMContentLoaded', function() {
    setTimeout(function() {
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(function(alert) {
            const bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        });
    }, 3000);

    // Enter key filter
    document.getElementById('searchInput').addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            applyFilter();
        }
    });
});
</script>
@endpush
