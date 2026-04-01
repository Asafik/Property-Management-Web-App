@extends('layouts.partial.app')

@section('title', 'Analisa KPR Komersil - Property Management App')

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

.card-body {
    padding: 0.75rem;
}
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

.filter-text {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: #9a55ff;
    font-weight: 600;
    font-size: 0.95rem;
    margin-bottom: 1rem;
}

.form-label {
    font-size: 0.85rem;
    font-weight: 600;
    color: #9a55ff !important;
    margin-bottom: 0.35rem;
    letter-spacing: 0.3px;
    font-family: 'Nunito', sans-serif;
}

.form-control,
.form-select {
    border: 1px solid #e9ecef;
    border-radius: 10px;
    padding: 0.7rem 1rem;
    font-size: 0.95rem;
    transition: all 0.2s ease;
    background-color: #ffffff;
    color: #2c2e3f;
    height: auto;
    min-height: 42px;
}

.form-control:focus,
.form-select:focus {
    border-color: #9a55ff;
    box-shadow: 0 0 0 3px rgba(154, 85, 255, 0.1);
    outline: none;
}

.btn {
    font-size: 0.9rem;
    padding: 0.7rem 1.2rem;
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

.btn-sm {
    padding: 0.4rem 0.7rem;
    font-size: 0.8rem;
    border-radius: 8px;
    height: 34px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
}

.btn-gradient-primary {
    background: linear-gradient(to right, #da8cff, #9a55ff) !important;
    color: #ffffff !important;
}
.btn-gradient-secondary {
    background: #6c757d !important;
    color: #ffffff !important;
}
.btn-gradient-info {
    background: linear-gradient(to right, #36d1dc, #5b86e5) !important;
    color: #ffffff !important;
}
.btn-gradient-success {
    background: linear-gradient(to right, #11998e, #38ef7d) !important;
    color: #ffffff !important;
}

.btn-icon-only {
    width: 42px;
    height: 42px;
    padding: 0 !important;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: 10px;
}
.btn-icon-only i {
    font-size: 1.1rem;
    margin: 0 !important;
}

.btn-icon-only-mobile {
    width: 100%; height: 42px; padding: 0;
    display: inline-flex; align-items: center; justify-content: center; border-radius: 10px;
}
.btn-icon-only-mobile i { font-size: 1.1rem; margin: 0; }

.filter-row-desktop {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}
.filter-row-mobile  { display: none; }
@media (max-width: 767px) {
    .filter-row-desktop { display: none; }
    .filter-row-mobile  { display: block; margin-top: 1rem; }
}

.table thead th.sortable {
    cursor: pointer;
    transition: all 0.2s ease;
}
.table thead th.sortable:hover {
    color: #7a3fcc;
}
.table thead th i {
    font-size: 0.8rem;
    margin-left: 4px;
    opacity: 0.5;
}

.table-responsive {
    overflow-x: auto;
    overflow-y: hidden !important;
    -webkit-overflow-scrolling: touch;
    border-radius: 8px;
    margin-bottom: 0.5rem;
    max-height: unset !important;
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
    min-width: 1250px;
    border-collapse: collapse;
    margin-bottom: 0;
}
.table thead th {
    background: linear-gradient(135deg, #f8f9fa, #f1f3f5);
    color: #9a55ff;
    font-weight: 700;
    font-size: 0.82rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    border-bottom: 2px solid #e9ecef;
    padding: 0.9rem 0.65rem;
    white-space: nowrap;
}
.table tbody td {
    vertical-align: middle;
    font-size: 0.92rem;
    padding: 0.95rem 0.65rem;
    border-bottom: 1px solid #e9ecef;
    color: #2c2e3f;
    white-space: nowrap;
}
.table tbody tr:hover {
    background-color: #f8f9fa;
}

.customer-avatar {
    width: 36px;
    height: 36px;
    min-width: 36px;
    border-radius: 50%;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #da8cff, #9a55ff);
    color: #fff;
    font-size: 0.82rem;
    font-weight: 700;
    text-transform: uppercase;
    box-shadow: 0 4px 10px rgba(154, 85, 255, 0.25);
}

.customer-name {
    font-weight: 700;
    color: #2c2e3f;
}

.unit-info {
    display: flex;
    align-items: center;
    gap: 0.45rem;
    font-weight: 600;
    color: #2c2e3f;
}
.unit-info i {
    color: #9a55ff;
    font-size: 1.1rem;
}

.bank-info {
    display: flex;
    align-items: center;
    gap: 0.45rem;
    font-weight: 700;
    color: #2c2e3f;
}
.bank-info i {
    color: #17a2b8;
    font-size: 1.05rem;
}

.price-text {
    font-weight: 700;
    color: #28a745;
}

.appraisal-text {
    font-weight: 700;
    color: #17a2b8;
}

.badge-percentage {
    display: inline-block;
    padding: 0.35rem 0.75rem;
    border-radius: 20px;
    font-weight: 700;
    font-size: 0.8rem;
    color: #fff;
    background: linear-gradient(135deg, #36d1dc, #5b86e5);
}

.badge-recommendation {
    display: inline-block;
    padding: 0.35rem 0.8rem;
    border-radius: 20px;
    font-weight: 600;
    font-size: 0.82rem;
    color: #fff;
}

.badge-layak {
    background: linear-gradient(135deg, #28a745, #5fd17a);
}
.badge-dipertimbangkan {
    background: linear-gradient(135deg, #ffc107, #ffdb6d);
    color: #2c2e3f;
}
.badge-tidak-layak {
    background: linear-gradient(135deg, #dc3545, #e4606d);
}
.badge-review {
    background: linear-gradient(135deg, #ffc107, #ffdb6d);
    color: #2c2e3f;
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

.text-dark-title {
    font-size: 1.3rem !important;
    font-weight: 700;
    color: #2c2e3f !important;
    margin-bottom: 0.5rem !important;
}
@media (min-width: 576px) {
    .text-dark-title { font-size: 1.5rem !important; }
}
@media (min-width: 768px) {
    .text-dark-title { font-size: 1.7rem !important; }
}

.mdi {
    vertical-align: middle;
}
</style>

<div class="container-fluid p-2 p-sm-3 p-md-4">

    <div class="row mb-3 mb-sm-3 mb-md-4">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="text-dark-title mb-1">
                            <i class="mdi mdi-home-city-outline me-2" style="color: #9a55ff;"></i>
                            Analisa KPR Komersil
                        </h3>
                        <p class="text-muted mb-0">
                            Data analisa kelayakan KPR untuk unit komersil
                        </p>
                    </div>
                    <div class="d-none d-sm-block">
                        <i class="mdi mdi-chart-line" style="font-size: 2.5rem; color: #9a55ff; opacity: 0.2;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-2 mt-sm-2 mt-md-3">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-white">
                    <h5 class="card-title mb-0">
                        <i class="mdi mdi-account-search-outline me-2"></i>
                        Data Customer KPR Komersil
                    </h5>
                </div>

                <div class="card-body">
                    <div class="filter-card mb-4">
                        <div class="card-body p-0">
                            <!-- DESKTOP VERSION -->
                            <div class="filter-row-desktop">
                                <div class="filter-text">
                                    <i class="mdi mdi-filter-outline"></i>
                                    <span>Filter data customer</span>
                                </div>
                                <form id="filterForm" method="GET" action="{{ route('analisa.kpr.komersil') }}">
                                    <div class="row g-2 align-items-end w-100">
                                        <div class="col-md-5">
                                            <label class="form-label">Cari Customer / Unit</label>
                                            <input type="text" class="form-control" name="search" value="{{ request('search', $search ?? '') }}" placeholder="Cari nama customer...">
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label">Bank</label>
                                            <select class="form-control" name="bank">
                                                <option value="">Semua Bank</option>
                                                @foreach ($banks as $bank)
                                                    <option value="{{ $bank->id }}" {{ (string) request('bank', $bankId ?? '') === (string) $bank->id ? 'selected' : '' }}>
                                                        {{ $bank->bank_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-1">
                                            <label class="form-label">Tampil</label>
                                            <select class="form-control" name="per_page">
                                                <option value="10" {{ (int) request('per_page', $perPage ?? 10) === 10 ? 'selected' : '' }}>10</option>
                                                <option value="15" {{ (int) request('per_page', $perPage ?? 10) === 15 ? 'selected' : '' }}>15</option>
                                                <option value="25" {{ (int) request('per_page', $perPage ?? 10) === 25 ? 'selected' : '' }}>25</option>
                                            </select>
                                        </div>

                                        <div class="col-md-2">
                                            <label class="form-label invisible d-none d-md-block">Aksi</label>
                                            <div class="d-flex gap-2">
                                                <button type="submit" class="btn btn-gradient-primary btn-icon-only flex-fill" title="Filter" onclick="showFilterLoading()">
                                                    <i class="mdi mdi-filter"></i>
                                                </button>
                                                <a href="{{ route('analisa.kpr.komersil') }}" class="btn btn-gradient-secondary btn-icon-only flex-fill" title="Reset" onclick="showResetLoading(event)">
                                                    <i class="mdi mdi-refresh"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <!-- MOBILE VERSION -->
                            <div class="filter-row-mobile">
                                <div class="filter-text mb-2">
                                    <i class="mdi mdi-filter-outline"></i>
                                    <span>Filter data customer</span>
                                </div>
                                <form method="GET" action="{{ route('analisa.kpr.komersil') }}">
                                    <div class="row g-2">
                                        <div class="col-12 mb-2">
                                            <label class="form-label">Cari Customer / Unit</label>
                                            <input type="text" class="form-control" name="search" value="{{ request('search', $search ?? '') }}" placeholder="Cari nama customer...">
                                        </div>
                                        <div class="col-12 mb-2">
                                            <label class="form-label">Bank</label>
                                            <select class="form-control" name="bank">
                                                <option value="">Semua Bank</option>
                                                @foreach ($banks as $bank)
                                                    <option value="{{ $bank->id }}" {{ (string) request('bank', $bankId ?? '') === (string) $bank->id ? 'selected' : '' }}>
                                                        {{ $bank->bank_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-12 mb-2">
                                            <label class="form-label">Tampil</label>
                                            <select class="form-control" name="per_page">
                                                <option value="10" {{ (int) request('per_page', $perPage ?? 10) === 10 ? 'selected' : '' }}>10</option>
                                                <option value="15" {{ (int) request('per_page', $perPage ?? 10) === 15 ? 'selected' : '' }}>15</option>
                                                <option value="25" {{ (int) request('per_page', $perPage ?? 10) === 25 ? 'selected' : '' }}>25</option>
                                            </select>
                                        </div>
                                        <div class="col-12 mt-2">
                                            <div class="d-flex gap-2">
                                                <button type="submit" class="btn btn-gradient-primary btn-icon-only-mobile flex-fill" title="Filter" onclick="showFilterLoading()">
                                                    <i class="mdi mdi-filter"></i>
                                                </button>
                                                <a href="{{ route('analisa.kpr.komersil') }}" class="btn btn-gradient-secondary btn-icon-only-mobile flex-fill" title="Reset" onclick="showResetLoading(event)">
                                                    <i class="mdi mdi-refresh"></i>
                                                </a>
                                            </div>
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
                                    <th class="sortable" data-field="name" data-direction="{{ request('sortField') == 'name' ? (request('sortDirection') == 'asc' ? 'desc' : 'asc') : 'asc' }}">
                                        Nama Customer
                                        @if(request('sortField') == 'name')
                                            <i class="mdi mdi-{{ request('sortDirection') == 'asc' ? 'arrow-up' : 'arrow-down' }}"></i>
                                        @else
                                            <i class="mdi mdi-swap-vertical"></i>
                                        @endif
                                    </th>
                                    <th class="sortable" data-field="unit" data-direction="{{ request('sortField') == 'unit' ? (request('sortDirection') == 'asc' ? 'desc' : 'asc') : 'asc' }}">
                                        Unit
                                        @if(request('sortField') == 'unit')
                                            <i class="mdi mdi-{{ request('sortDirection') == 'asc' ? 'arrow-up' : 'arrow-down' }}"></i>
                                        @else
                                            <i class="mdi mdi-swap-vertical"></i>
                                        @endif
                                    </th>
                                    <th class="sortable" data-field="bank" data-direction="{{ request('sortField') == 'bank' ? (request('sortDirection') == 'asc' ? 'desc' : 'asc') : 'asc' }}">
                                        Bank
                                        @if(request('sortField') == 'bank')
                                            <i class="mdi mdi-{{ request('sortDirection') == 'asc' ? 'arrow-up' : 'arrow-down' }}"></i>
                                        @else
                                            <i class="mdi mdi-swap-vertical"></i>
                                        @endif
                                    </th>
                                    <th class="sortable" data-field="price" data-direction="{{ request('sortField') == 'price' ? (request('sortDirection') == 'asc' ? 'desc' : 'asc') : 'asc' }}">
                                        Harga Unit
                                        @if(request('sortField') == 'price')
                                            <i class="mdi mdi-{{ request('sortDirection') == 'asc' ? 'arrow-up' : 'arrow-down' }}"></i>
                                        @else
                                            <i class="mdi mdi-swap-vertical"></i>
                                        @endif
                                    </th>
                                    <th class="sortable" data-field="appraisal" data-direction="{{ request('sortField') == 'appraisal' ? (request('sortDirection') == 'asc' ? 'desc' : 'asc') : 'asc' }}">
                                        Appraisal
                                        @if(request('sortField') == 'appraisal')
                                            <i class="mdi mdi-{{ request('sortDirection') == 'asc' ? 'arrow-up' : 'arrow-down' }}"></i>
                                        @else
                                            <i class="mdi mdi-swap-vertical"></i>
                                        @endif
                                    </th>
                                    <th>Persentase</th>
                                    <th>Rekomendasi</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($applications as $app)
                                    @php
                                        $customerName = $app->customer->full_name ?? '-';
                                        $nameParts = preg_split('/\s+/', trim($customerName));
                                        $initialOne = isset($nameParts[0][0]) ? strtoupper($nameParts[0][0]) : 'N';
                                        $initialTwo = isset($nameParts[1][0]) ? strtoupper($nameParts[1][0]) : (isset($nameParts[0][1]) ? strtoupper($nameParts[0][1]) : 'A');
                                        $customerInitial = $initialOne . $initialTwo;

                                        $unitName = trim(($app->unit->unit_name ?? '-') . ((isset($app->unit->type) && $app->unit->type) ? ' - ' . $app->unit->type : ''));
                                        $bankName = $app->bank->bank_name ?? '-';
                                        $unitPrice = $app->unit->price ?? 0;
                                        $appraisal = $app->appraisal_value ?? 0;
                                        $percentage = isset($app->persentase_kelayakan)
                                            ? rtrim(rtrim(number_format((float) $app->persentase_kelayakan, 2, '.', ''), '0'), '.') . '%'
                                            : '-';
                                        $recommendation = $app->rekomendasi ?? '-';

                                        $recommendationClass = 'badge-review';
                                        if ($recommendation === 'Layak') {
                                            $recommendationClass = 'badge-layak';
                                        } elseif ($recommendation === 'Dipertimbangkan') {
                                            $recommendationClass = 'badge-dipertimbangkan';
                                        } elseif ($recommendation === 'Tidak Layak') {
                                            $recommendationClass = 'badge-tidak-layak';
                                        } elseif ($recommendation === 'Review') {
                                            $recommendationClass = 'badge-review';
                                        }
                                    @endphp
                                    <tr>
                                        <td class="fw-bold text-center">
                                            {{ ($applications->currentPage() - 1) * $applications->perPage() + $loop->iteration }}
                                        </td>

                                        <td>
                                            <div class="d-flex align-items-center gap-2">
                                                <div class="customer-avatar">
                                                    {{ $customerInitial }}
                                                </div>
                                                <div class="customer-name">
                                                    {{ $customerName }}
                                                </div>
                                            </div>
                                        </td>

                                        <td>
                                            <div class="unit-info">
                                                <i class="mdi mdi-home-city-outline"></i>
                                                <span>{{ $unitName }}</span>
                                            </div>
                                        </td>

                                        <td>
                                            <div class="bank-info">
                                                <i class="mdi mdi-bank"></i>
                                                <span>{{ $bankName }}</span>
                                            </div>
                                        </td>

                                        <td>
                                            <span class="price-text">
                                                Rp {{ number_format($unitPrice, 0, ',', '.') }}
                                            </span>
                                        </td>

                                        <td>
                                            <span class="appraisal-text">
                                                Rp {{ number_format($appraisal, 0, ',', '.') }}
                                            </span>
                                        </td>

                                        <td>
                                            <span class="badge-percentage">
                                                {{ $percentage }}
                                            </span>
                                        </td>

                                        <td>
                                            <span class="badge-recommendation {{ $recommendationClass }}">
                                                {{ $recommendation }}
                                            </span>
                                        </td>

                                        <td class="text-center">
                                            @if(isset($app->unit->land_bank_id, $app->unit->id))
                                                <a href="{{ route('properti.progress', ['land_bank_id' => $app->unit->land_bank_id, 'unit_id' => $app->unit->id]) }}"
                                                    class="btn btn-gradient-info btn-sm" title="Progress Pembangunan">
                                                    <i class="mdi mdi-home-edit"></i>
                                                </a>
                                            @endif

                                            @if(($app->unit->construction_progress ?? null) == 'selesai')
                                                <a href="{{ route('kpr.survey', $app->id) }}"
                                                    class="btn btn-gradient-success btn-sm" title="Proses Akad">
                                                    <i class="mdi mdi-file-document"></i>
                                                </a>
                                                  
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center text-muted py-4">
                                            Tidak ada data analisa KPR komersil
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if ($applications instanceof \Illuminate\Pagination\LengthAwarePaginator && $applications->total() > 0)
                    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mt-4">
                        <div class="pagination-info mb-2 mb-sm-0">
                            Menampilkan {{ $applications->firstItem() }} - {{ $applications->lastItem() }} dari {{ $applications->total() }} data
                        </div>
                        <nav aria-label="Page navigation">
                            <ul class="pagination pagination-sm flex-wrap justify-content-center mb-0">
                                {{-- Previous Page Link --}}
                                @if ($applications->onFirstPage())
                                    <li class="page-item disabled" aria-disabled="true">
                                        <span class="page-link" aria-label="Previous">
                                            <i class="mdi mdi-chevron-left"></i>
                                        </span>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $applications->appends(request()->query())->previousPageUrl() }}" rel="prev" aria-label="Previous" onclick="showPaginationLoading(event)">
                                            <i class="mdi mdi-chevron-left"></i>
                                        </a>
                                    </li>
                                @endif

                                {{-- Pagination Elements --}}
                                @foreach ($applications->getUrlRange(max(1, $applications->currentPage() - 2), min($applications->lastPage(), $applications->currentPage() + 2)) as $page => $url)
                                    @if ($page == $applications->currentPage())
                                        <li class="page-item active" aria-current="page">
                                            <span class="page-link">{{ $page }}</span>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $applications->appends(request()->query())->url($page) }}" onclick="showPaginationLoading(event)">{{ $page }}</a>
                                        </li>
                                    @endif
                                @endforeach

                                {{-- Next Page Link --}}
                                @if ($applications->hasMorePages())
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $applications->appends(request()->query())->nextPageUrl() }}" rel="next" aria-label="Next" onclick="showPaginationLoading(event)">
                                            <i class="mdi mdi-chevron-right"></i>
                                        </a>
                                    </li>
                                @else
                                    <li class="page-item disabled" aria-disabled="true">
                                        <span class="page-link" aria-label="Next">
                                            <i class="mdi mdi-chevron-right"></i>
                                        </span>
                                    </li>
                                @endif
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

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$(document).ready(function() {
    // Sorting functionality
    $('.sortable').click(function() {
        let field = $(this).data('field');
        let direction = $(this).data('direction');

        Swal.fire({
            title: 'Memuat...',
            html: 'Sedang mengurutkan data',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        let url = new URL(window.location.href);
        url.searchParams.set('sortField', field);
        url.searchParams.set('sortDirection', direction);
        url.searchParams.set('page', 1);

        window.location.href = url.toString();
    });
});

function showFilterLoading() {
    Swal.fire({
        title: 'Memuat...',
        html: 'Sedang memfilter data',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });
    return true;
}

function showResetLoading(event) {
    event.preventDefault();
    Swal.fire({
        title: 'Memuat...',
        html: 'Mengembalikan data awal',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });
    window.location.href = event.currentTarget.href;
}

function showPaginationLoading(event) {
    event.preventDefault();
    Swal.fire({
        title: 'Memuat...',
        html: 'Berpindah halaman',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });
    window.location.href = event.currentTarget.href;
}
</script>
@endpush
