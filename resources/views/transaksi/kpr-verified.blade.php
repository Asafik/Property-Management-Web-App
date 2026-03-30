@extends('layouts.partial.app')

@section('title', 'Daftar Customer KPR Terverifikasi')

@section('content')

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
    padding: 0.75rem;
}
@media (min-width: 576px) {
    .card-header { padding: 1rem; }
}
@media (min-width: 768px) {
    .card-header { padding: 1.2rem; }
}

.card-body { padding: 0.75rem; }
@media (min-width: 576px) {
    .card-body { padding: 1rem; }
}
@media (min-width: 768px) {
    .card-body { padding: 1.2rem; }
}

.card-title {
    font-size: 0.9rem;
    font-weight: 600;
    color: #9a55ff;
    margin-bottom: 0;
}
@media (min-width: 576px) {
    .card-title { font-size: 1rem; }
}
@media (min-width: 768px) {
    .card-title { font-size: 1.1rem; }
}

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
.btn-gradient-primary {
    background: linear-gradient(to right, #da8cff, #9a55ff) !important;
    color: #ffffff !important;
}
.btn-gradient-secondary {
    background: #6c757d !important;
    color: #ffffff !important;
}
.btn-gradient-secondary:hover {
    background: #5a6268 !important;
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
.btn-icon-only i {
    font-size: 1.2rem;
    margin: 0;
}

.btn-action {
    padding: 0.45rem 0.8rem;
    border-radius: 8px;
    font-size: 0.8rem;
    font-weight: 600;
    border: none;
    color: #fff;
    transition: all 0.25s ease;
    margin: 2px;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 0.35rem;
}
.btn-action:hover {
    transform: translateY(-2px);
    color: #fff;
}
.btn-survey {
    background: linear-gradient(135deg, #17a2b8, #43c6db);
}
.btn-akad {
    background: linear-gradient(135deg, #28a745, #5dd067);
}
.btn-followup {
    background: linear-gradient(135deg, #ffc107, #ffdb6d);
    color: #2c2e3f;
}
.btn-followup:hover {
    color: #2c2e3f;
}
.btn-detail {
    background: linear-gradient(135deg, #9a55ff, #b07cff);
}

.table-responsive {
    overflow-x: auto;
    overflow-y: hidden;
    -webkit-overflow-scrolling: touch;
    border-radius: 8px;
    margin-bottom: 0.5rem;
    max-height: none;
    scrollbar-width: thin;
    scrollbar-color: #9a55ff #f0f0f0;
}
.table-responsive::-webkit-scrollbar {
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
.table-responsive::-webkit-scrollbar:vertical {
    width: 0;
}
.table-responsive::-webkit-scrollbar-thumb:vertical {
    background: transparent;
}

.table {
    width: 100%;
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
@media (min-width: 576px) {
    .table thead th {
        font-size: 0.85rem;
        padding: 0.9rem 0.6rem;
    }
}
@media (min-width: 768px) {
    .table thead th {
        font-size: 0.9rem;
        padding: 1rem 0.75rem;
    }
}

.table thead th:first-child,
.table tbody td:first-child {
    width: 40px;
    text-align: center;
}
.table tbody td {
    vertical-align: middle;
    font-size: 0.85rem;
    padding: 0.8rem 0.5rem;
    border-bottom: 1px solid #e9ecef;
    color: #2c2e3f;
    white-space: nowrap;
}
@media (min-width: 576px) {
    .table tbody td {
        font-size: 0.9rem;
        padding: 0.9rem 0.6rem;
    }
}
@media (min-width: 768px) {
    .table tbody td {
        font-size: 0.95rem;
        padding: 1rem 0.75rem;
    }
}
.table tbody tr:hover {
    background-color: #f8f9fa;
}

.customer-cell {
    display: flex;
    align-items: center;
    gap: 0.75rem;
}
.customer-initial {
    width: 38px;
    height: 38px;
    border-radius: 50%;
    background: linear-gradient(135deg, #da8cff, #9a55ff);
    color: #fff;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 0.9rem;
    flex-shrink: 0;
    box-shadow: 0 4px 12px rgba(154, 85, 255, 0.18);
}
.customer-name {
    font-weight: 700;
    color: #2c2e3f;
}

.info-with-icon {
    display: inline-flex;
    align-items: center;
    gap: 0.45rem;
}
.info-with-icon i {
    font-size: 1.1rem;
    color: #9a55ff;
}

.badge {
    padding: 0.35rem 0.6rem;
    font-size: 0.75rem;
    font-weight: 600;
    border-radius: 30px;
    display: inline-block;
    white-space: nowrap;
}
@media (min-width: 576px) { .badge { padding: 0.4rem 0.75rem; font-size: 0.8rem; } }
.badge-gradient-success { background: linear-gradient(135deg, #28a745, #5cb85c); color: #ffffff; }
.badge-gradient-primary { background: linear-gradient(to right, #da8cff, #9a55ff) !important; color: #ffffff !important; }
.badge-gradient-secondary { background: #6c757d !important; color: #ffffff !important; }

.badge-status-doc {
    padding: 0.38rem 0.85rem;
    border-radius: 20px;
    font-weight: 700;
    font-size: 0.78rem;
    display: inline-block;
    color: #fff;
}
.badge-status-doc.verified {
    background: linear-gradient(135deg, #28a745, #5dd067);
}
.badge-status-doc.survey {
    background: linear-gradient(135deg, #17a2b8, #56c6d8);
}
.badge-status-doc.akad {
    background: linear-gradient(135deg, #9a55ff, #b07cff);
}
.badge-status-doc.followup {
    background: linear-gradient(135deg, #ffc107, #ffdb6d);
    color: #2c2e3f;
}

.bank-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.45rem;
    font-weight: 700;
    color: #2c2e3f;
}
.bank-badge i {
    font-size: 1.1rem;
    color: #28a745;
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

.text-primary  { color: #9a55ff !important; }
.text-success  { color: #28a745 !important; }
.text-muted    { color: #a5b3cb !important; }
.fw-bold       { font-weight: 600 !important; }

h3.text-dark {
    font-size: 1.3rem !important;
    font-weight: 700;
    color: #2c2e3f !important;
    margin-bottom: 0.5rem !important;
}
@media (min-width: 576px) {
    h3.text-dark { font-size: 1.5rem !important; }
}
@media (min-width: 768px) {
    h3.text-dark { font-size: 1.7rem !important; }
}

.mdi { vertical-align: middle; }

.filter-row-desktop {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}
.filter-row-desktop .filter-text {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: #9a55ff;
    font-weight: 600;
    font-size: 0.95rem;
}
.filter-row-mobile { display: none; }

@media (max-width: 767px) {
    .filter-row-desktop { display: none; }
    .filter-row-mobile  { display: block; margin-top: 1rem; }
}
</style>

<div class="container-fluid p-2 p-sm-3 p-md-4">

    <div class="row mb-3 mb-sm-3 mb-md-4">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="text-dark mb-1">
                            <i class="mdi mdi-home-account me-2" style="color: #9a55ff;"></i>Daftar User KPR Terverifikasi
                        </h3>
                        <p class="text-muted mb-0">
                            Kelola User KPR yang telah terverifikasi dokumennya
                        </p>
                    </div>
                    <div class="d-none d-sm-block">
                        <i class="mdi mdi-file-check-outline" style="font-size: 2.5rem; color: #9a55ff; opacity: 0.2;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-2 mt-sm-2 mt-md-3">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-white d-flex flex-wrap flex-md-row justify-content-between align-items-center gap-2">
                    <h5 class="card-title mb-0">
                        <i class="mdi mdi-format-list-bulleted me-2"></i>Daftar User KPR Terverifikasi
                    </h5>
                </div>

                <div class="card-body">
                    <div class="filter-card mb-4">
                        <div class="card-body">
                            <div class="filter-row-desktop">
                                <div class="filter-text">
                                    <i class="mdi mdi-filter-outline"></i>
                                    <span>Filter Data KPR Terverifikasi</span>
                                </div>

                                <form method="GET" action="{{ route('kpr.customer-verified') }}">
                                    <div class="row g-2 align-items-end w-100">
                                        <div class="col-md-3">
                                            <label class="form-label">Search</label>
                                            <input
                                                type="text"
                                                class="form-control"
                                                name="search"
                                                id="searchInput"
                                                placeholder="Cari nama customer..."
                                                value="{{ request('search') }}"
                                            >
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label">Bank</label>
                                            <select class="form-control" name="bank_id" id="bankSelect">
                                                <option value="">Semua Bank</option>
                                                @foreach($banks ?? [] as $bank)
                                                    <option value="{{ $bank->id }}" {{ request('bank_id') == $bank->id ? 'selected' : '' }}>
                                                        {{ $bank->bank_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-2">
                                            <label class="form-label">Status</label>
                                            <select class="form-control" name="status" id="statusSelect">
                                                <option value="">Semua Status</option>
                                                <option value="dokumen" {{ request('status') == 'dokumen' ? 'selected' : '' }}>Terverifikasi</option>
                                                <option value="survey" {{ request('status') == 'survey' ? 'selected' : '' }}>Lanjut Survey</option>
                                                <option value="akad" {{ request('status') == 'akad' ? 'selected' : '' }}>Lanjut Akad</option>
                                                <option value="followup" {{ request('status') == 'followup' ? 'selected' : '' }}>Perlu Follow Up</option>
                                            </select>
                                        </div>

                                        <div class="col-md-2">
                                            <label class="form-label">Tampil</label>
                                            <select class="form-control" name="per_page" id="perPageSelect">
                                                <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10</option>
                                                <option value="15" {{ request('per_page') == 15 ? 'selected' : '' }}>15</option>
                                                <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                                            </select>
                                        </div>

                                        <div class="col-md-2">
                                            <label class="form-label invisible d-none d-md-block">Aksi</label>
                                            <div class="d-flex gap-2">
                                                <button type="submit" class="btn btn-gradient-primary btn-icon-only flex-fill" title="Filter">
                                                    <i class="mdi mdi-filter"></i>
                                                </button>
                                                <a href="{{ route('kpr.customer-verified') }}" class="btn btn-gradient-secondary btn-icon-only flex-fill" title="Reset">
                                                    <i class="mdi mdi-refresh"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="filter-row-mobile">
                                <div class="filter-text mb-2">
                                    <i class="mdi mdi-filter-outline"></i>
                                    <span>Filter Data KPR Terverifikasi</span>
                                </div>

                                <form method="GET" action="{{ route('kpr.customer-verified') }}">
                                    <div class="row g-2">
                                        <div class="col-12">
                                            <label class="form-label">Search</label>
                                            <input
                                                type="text"
                                                class="form-control"
                                                name="search"
                                                id="searchInputMobile"
                                                placeholder="Cari nama customer..."
                                                value="{{ request('search') }}"
                                            >
                                        </div>

                                        <div class="col-12">
                                            <label class="form-label">Bank</label>
                                            <select class="form-control" name="bank_id" id="bankSelectMobile">
                                                <option value="">Semua Bank</option>
                                                @foreach($banks ?? [] as $bank)
                                                    <option value="{{ $bank->id }}" {{ request('bank_id') == $bank->id ? 'selected' : '' }}>
                                                        {{ $bank->bank_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-12">
                                            <label class="form-label">Status</label>
                                            <select class="form-control" name="status" id="statusSelectMobile">
                                                <option value="">Semua Status</option>
                                                <option value="dokumen" {{ request('status') == 'dokumen' ? 'selected' : '' }}>Terverifikasi</option>
                                                <option value="survey" {{ request('status') == 'survey' ? 'selected' : '' }}>Lanjut Survey</option>
                                                <option value="akad" {{ request('status') == 'akad' ? 'selected' : '' }}>Lanjut Akad</option>
                                                <option value="followup" {{ request('status') == 'followup' ? 'selected' : '' }}>Perlu Follow Up</option>
                                            </select>
                                        </div>

                                        <div class="col-12">
                                            <label class="form-label">Tampil</label>
                                            <select class="form-control" name="per_page" id="perPageSelectMobile">
                                                <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10</option>
                                                <option value="15" {{ request('per_page') == 15 ? 'selected' : '' }}>15</option>
                                                <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                                            </select>
                                        </div>

                                        <div class="col-6">
                                            <button type="submit" class="btn btn-gradient-primary btn-icon-only w-100" title="Filter">
                                                <i class="mdi mdi-filter"></i>
                                            </button>
                                        </div>
                                        <div class="col-6">
                                            <a href="{{ route('kpr.customer-verified') }}" class="btn btn-gradient-secondary btn-icon-only w-100" title="Reset">
                                                <i class="mdi mdi-refresh"></i>
                                            </a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th>Nama User</th>
                                    <th>Nama - Unit</th>
                                    <th>Jenis & Tipe</th>
                                    <th>Bank</th>
                                    <th>Status Dokumen</th>
                                    <th>Tgl Verifikasi</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($kprApplications as $index => $application)
                                    @php
                                        $customerName = $application->customer->full_name ?? '-';
                                        $words = explode(' ', trim($customerName));
                                        $initial = '';

                                        foreach ($words as $word) {
                                            if ($word !== '') {
                                                $initial .= strtoupper(substr($word, 0, 1));
                                            }
                                        }

                                        $initial = substr($initial, 0, 2) ?: '-';
                                        $unitType = strtolower($application->unit->type ?? '');
                                        $status = strtolower($application->status ?? '');

                                        $statusLabel = 'Terverifikasi';
                                        $statusClass = 'verified';

                                        if ($status === 'survey') {
                                            $statusLabel = 'Lanjut Survey';
                                            $statusClass = 'survey';
                                        } elseif ($status === 'akad') {
                                            $statusLabel = 'Siap Akad';
                                            $statusClass = 'akad';
                                        } elseif ($status === 'followup' || $status === 'follow up') {
                                            $statusLabel = 'Perlu Follow Up';
                                            $statusClass = 'followup';
                                        } elseif ($status === 'dokumen') {
                                            $statusLabel = 'Terverifikasi';
                                            $statusClass = 'verified';
                                        }
                                    @endphp

                                    <tr>
                                        <td class="text-center fw-bold">
                                            {{ method_exists($kprApplications, 'firstItem') ? ($kprApplications->firstItem() + $index) : ($index + 1) }}
                                        </td>

                                        <td>
                                            <div class="customer-cell">
                                                <span class="customer-initial">{{ $initial }}</span>
                                                <span class="customer-name">{{ $customerName }}</span>
                                            </div>
                                        </td>

                                        <td>
                                            <div class="info-with-icon">
                                                <i class="mdi mdi-home"></i>
                                                <span class="fw-bold">{{ $application->unit->unit_name ?? '-' }} - {{ $application->unit->unit_code ?? '-' }}</span>
                                            </div>
                                        </td>

                                        <td>
                                            @php
                                                $jenisUnit = $application->unit->jenis ?? '';
                                                $tipeUnit = $application->unit->type ?? '-';
                                            @endphp
                                            @if (strtolower($jenisUnit) == 'subsidi')
                                                <span class="badge badge-gradient-success">
                                                    <i class="mdi mdi-home-assistant me-1"></i>{{ $jenisUnit }} - {{ $tipeUnit }}
                                                </span>
                                            @elseif(strtolower($jenisUnit) == 'komersil')
                                                <span class="badge badge-gradient-primary">
                                                    <i class="mdi mdi-office-building me-1"></i>{{ $jenisUnit }} - {{ $tipeUnit }}
                                                </span>
                                            @else
                                                <span class="badge badge-gradient-secondary">
                                                    <i class="mdi mdi-help-circle-outline me-1"></i>{{ ($jenisUnit ?: '-') . ' - ' . $tipeUnit }}
                                                </span>
                                            @endif
                                        </td>

                                        <td>
                                            <span class="bank-badge">
                                                <i class="mdi mdi-bank"></i>
                                                {{ $application->bank->bank_name ?? '-' }}
                                            </span>
                                        </td>

                                        <td>
                                            <span class="badge-status-doc {{ $statusClass }}">
                                                {{ $statusLabel }}
                                            </span>
                                        </td>

                                        <td>
                                            {{ optional($application->updated_at)->format('d M Y') ?? '-' }}
                                        </td>

                                        <td class="text-center">
                                            @if($unitType === 'komersil')
                                                @if($status === 'survey')
                                                    <a href="{{ route('kpr.survey', $application->id) }}" class="btn-action btn-survey">
                                                        Lanjut Survey
                                                    </a>
                                                @else
                                                    <a href="{{ route('kpr.akad', $application->id) }}" class="btn-action btn-akad">
                                                        Lanjut ke Akad
                                                    </a>
                                                @endif
                                            @else
                                                @if($status === 'followup' || $status === 'follow up')
                                                    <a href="{{ route('kpr.show', $application->id) }}" class="btn-action btn-followup">
                                                        Follow Up
                                                    </a>
                                                @elseif($status === 'akad')
                                                    <a href="{{ route('kpr.akad', $application->id) }}" class="btn-action btn-akad">
                                                        Lanjut ke Akad
                                                    </a>
                                                @else
                                                    <a href="{{ route('kpr.survey', $application->id) }}" class="btn-action btn-survey">
                                                        Lanjut Survey
                                                    </a>
                                                @endif
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center text-muted py-4">
                                            Tidak ada data customer KPR terverifikasi
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if(method_exists($kprApplications, 'total'))
                        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mt-4">
                            <div class="pagination-info mb-2 mb-sm-0">
                                Menampilkan {{ $kprApplications->firstItem() ?? 0 }} - {{ $kprApplications->lastItem() ?? 0 }} dari {{ $kprApplications->total() }} data
                            </div>
                            <div>
                                {{ $kprApplications->withQueryString()->links() }}
                            </div>
                        </div>
                    @else
                        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mt-4">
                            <div class="pagination-info mb-2 mb-sm-0">
                                Menampilkan 1 - {{ count($kprApplications) }} dari {{ count($kprApplications) }} data
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
                    @endif

                </div>
            </div>
        </div>
    </div>

</div>

@endsection
