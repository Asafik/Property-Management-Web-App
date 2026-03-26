@extends('layouts.partial.app')

@section('title', 'Semua Pra Tanah - Property Management App')

@section('content')
<style>
/* ===== CARD ===== */
.card { transition: all 0.3s ease; margin-bottom: 1rem; border: none !important; box-shadow: 0 4px 15px rgba(0,0,0,0.05); }
.card:hover { box-shadow: 0 8px 25px rgba(154,85,255,0.1) !important; }
.card-header { background: linear-gradient(135deg,#ffffff,#f8f9fa); border-bottom: 1px solid #e9ecef; padding: 0.9rem 1.2rem; }
.card-body { padding: 0.75rem; }
@media (min-width:576px){ .card-body { padding:1rem; } }
@media (min-width:768px){ .card-body { padding:1.2rem; } }
.card-title { font-size:0.9rem; font-weight:600; color:#9a55ff; margin-bottom:0; }
@media (min-width:576px){ .card-title { font-size:1rem; } }
@media (min-width:768px){ .card-title { font-size:1.1rem; } }

/* ===== FILTER ===== */
.filter-card {
    background: linear-gradient(135deg,#f9f7ff,#f2ecff);
    border-radius: 12px; padding: 1rem; margin-bottom: 1.25rem; border: none;
}
.filter-card .form-label { font-size:0.85rem; font-weight:600; color:#9a55ff !important; margin-bottom:0.4rem; letter-spacing:0.3px; }
.filter-card .form-control, .filter-card .form-select { padding:0.5rem 0.75rem; font-size:0.9rem; border-radius:8px; height:auto; min-height:40px; border:1px solid #e0e4e9; }

/* ===== FORM ===== */
.form-control, .form-select { border:1px solid #e9ecef; border-radius:8px; padding:0.6rem 0.8rem; font-size:0.9rem; transition:all 0.2s ease; background-color:#ffffff; color:#2c2e3f; height:auto; }
.form-control:focus, .form-select:focus { border-color:#9a55ff; box-shadow:0 0 0 3px rgba(154,85,255,0.1); outline:none; }
.form-label { font-size:0.85rem; font-weight:600; color:#9a55ff !important; margin-bottom:0.3rem; letter-spacing:0.3px; font-family:'Nunito',sans-serif; }

/* ===== BUTTON ===== */
.btn { font-size:0.85rem; padding:0.6rem 1rem; border-radius:8px; font-weight:600; transition:all 0.3s ease; font-family:'Nunito',sans-serif; border:none; }
@media (min-width:576px){ .btn { font-size:0.9rem; padding:0.7rem 1.2rem; border-radius:10px; } }
.btn:hover { transform:translateY(-2px); box-shadow:0 5px 15px rgba(0,0,0,0.1); }
.btn-sm { padding:0.35rem 0.7rem; font-size:0.8rem; border-radius:6px; }
.btn-gradient-primary { background:linear-gradient(to right,#da8cff,#9a55ff) !important; color:#ffffff !important; }
.btn-gradient-secondary { background:#6c757d !important; color:#ffffff !important; }
.btn-gradient-secondary:hover { background:#5a6268 !important; }
.btn-icon-only { width:40px; height:40px; padding:0; display:flex; align-items:center; justify-content:center; border-radius:8px; }
.btn-icon-only i { font-size:1.2rem; margin:0; }

/* ===== ACTION ===== */
.btn-action { width:34px; height:34px; padding:0; display:inline-flex; align-items:center; justify-content:center; border-radius:10px; margin:0 2px; transition:all 0.3s ease; border:none; cursor:pointer; }
.btn-action i { font-size:1rem; }
.btn-action.view { background:linear-gradient(135deg,#17a2b8,#5bc0de); color:#fff; }
.btn-action.view:hover { transform:translateY(-3px); box-shadow:0 5px 15px rgba(23,162,184,0.4); }
.btn-action.edit { background:linear-gradient(135deg,#ffc107,#ffdb6d); color:#2c2e3f; }
.btn-action.edit:hover { transform:translateY(-3px); box-shadow:0 5px 15px rgba(255,193,7,0.4); }

/* ===== TABLE ===== */
.table-responsive { overflow-x:auto; overflow-y:visible; -webkit-overflow-scrolling:touch; border-radius:8px; margin-bottom:0.5rem; scrollbar-width:thin; scrollbar-color:#9a55ff #f0f0f0; }
.table-responsive::-webkit-scrollbar { height:8px; }
.table-responsive::-webkit-scrollbar-track { background:#f0f0f0; border-radius:10px; }
.table-responsive::-webkit-scrollbar-thumb { background:#9a55ff; border-radius:10px; }
.table-responsive::-webkit-scrollbar-thumb:hover { background:#7a3fcc; }
.table { width:100%; border-collapse:collapse; margin-bottom:0; }
.table thead th { background:linear-gradient(135deg,#f8f9fa,#f1f3f5); color:#9a55ff; font-weight:600; font-size:0.8rem; text-transform:uppercase; letter-spacing:0.5px; border-bottom:2px solid #e9ecef; padding:0.8rem 0.5rem; white-space:nowrap; cursor:pointer; transition:all 0.2s ease; }
.table thead th:hover { color:#7a3fcc; }
.table thead th.no-sort { cursor:default; }
.table thead th.no-sort:hover { color:#9a55ff; }
.table thead th i.sort-icon { font-size:0.8rem; margin-left:4px; opacity:0.5; transition:all 0.2s ease; }
.table thead th.active-sort i.sort-icon { opacity:1; color:#7a3fcc; }
@media (min-width:576px){ .table thead th { font-size:0.85rem; padding:0.9rem 0.6rem; } }
@media (min-width:768px){ .table thead th { font-size:0.9rem; padding:1rem 0.75rem; } }
.table thead th:first-child { padding-left:0.5rem; width:40px; text-align:center; cursor:default; }
.table thead th:first-child:hover { color:#9a55ff; }
.table tbody td:first-child { padding-left:0.5rem; font-weight:500; width:40px; text-align:center; }
.table tbody td { vertical-align:middle; font-size:0.85rem; padding:0.8rem 0.5rem; border-bottom:1px solid #e9ecef; color:#2c2e3f; white-space:nowrap; }
@media (min-width:576px){ .table tbody td { font-size:0.9rem; padding:0.9rem 0.6rem; } }
@media (min-width:768px){ .table tbody td { font-size:0.95rem; padding:1rem 0.75rem; } }
.table tbody tr:hover { background-color:#f8f9fa; }

/* ===== BADGE STATUS ===== */
.badge-status { padding:0.35rem 0.8rem; border-radius:20px; font-weight:600; font-size:0.82rem; display:inline-flex; align-items:center; gap:0.3rem; }
.badge-deal      { background:linear-gradient(135deg,#28a745,#5cb85c); color:#fff; }
.badge-almost    { background:linear-gradient(135deg,#17a2b8,#5bc0de); color:#fff; }
.badge-cancel    { background:linear-gradient(135deg,#dc3545,#e4606d); color:#fff; }
.badge-negotiate { background:linear-gradient(135deg,#ffc107,#ffdb6d); color:#2c2e3f; }

/* ===== PAGINATION ===== */
.pagination { margin:0; gap:3px; }
.page-item .page-link { border:1px solid #e9ecef; padding:0.35rem 0.7rem; font-size:0.75rem; color:#6c7383; background-color:#ffffff; border-radius:6px !important; transition:all 0.2s ease; min-width:32px; text-align:center; cursor:pointer; text-decoration:none; }
@media (min-width:576px){ .page-item .page-link { padding:0.4rem 0.8rem; font-size:0.8rem; min-width:36px; } }
@media (min-width:768px){ .page-item .page-link { padding:0.45rem 0.9rem; font-size:0.85rem; min-width:40px; } }
.page-item.active .page-link { background:linear-gradient(to right,#da8cff,#9a55ff); border-color:transparent; color:#ffffff; box-shadow:0 4px 12px rgba(154,85,255,0.3); }
.page-item .page-link:hover { background-color:#f8f9fa; border-color:#9a55ff; color:#9a55ff; transform:translateY(-1px); }
.page-item.disabled .page-link { background-color:#f8f9fa; color:#a5b3cb; pointer-events:none; }
.pagination-info { font-size:0.8rem; color:#6c7383; }

/* ===== MISC ===== */
h3.text-dark { font-size:1.3rem !important; font-weight:700; color:#2c2e3f !important; margin-bottom:0.5rem !important; }
@media (min-width:576px){ h3.text-dark { font-size:1.5rem !important; } }
@media (min-width:768px){ h3.text-dark { font-size:1.7rem !important; } }
.mdi { vertical-align:middle; }
.text-primary  { color:#9a55ff !important; }
.text-muted    { color:#a5b3cb !important; }
.fw-bold       { font-weight:600 !important; }
.filter-row-desktop { display:flex; flex-wrap:wrap; align-items:flex-end; gap:0.5rem; }
.filter-row-mobile  { display:none; }
@media (max-width:767px){ .filter-row-desktop { display:none; } .filter-row-mobile { display:block; margin-top:1rem; } }
</style>

<div class="container-fluid p-2 p-sm-3 p-md-4">

    {{-- Header --}}
    <div class="row mb-3 mb-sm-3 mb-md-4">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="text-dark mb-1">
                            <i class="mdi mdi-map-marker-multiple me-2" style="color:#9a55ff;"></i>
                            Semua Pra Tanah / Pra Landbank
                        </h3>
                        <p class="text-muted mb-0">
                            <i class="mdi mdi-information-outline me-1"></i>
                            Daftar seluruh tanah dalam tahap pra-pelepasan (penawaran/negosiasi)
                        </p>
                    </div>
                    <div class="d-none d-sm-block">
                        <i class="mdi mdi-map-marker-multiple" style="font-size:2.5rem;color:#9a55ff;opacity:0.2;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Tabel Card --}}
    <div class="row mt-2 mt-sm-2 mt-md-3">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-white">
                    <h5 class="card-title mb-0">
                        <i class="mdi mdi-format-list-bulleted me-2"></i>Daftar Semua Pra Tanah
                    </h5>
                </div>
                <div class="card-body">

                    {{-- FILTER --}}
                    <div class="filter-card mb-4">
                        <div class="card-body">
                            <h6 style="font-size:0.95rem;font-weight:700;color:#9a55ff;margin-bottom:1rem;">
                                <i class="mdi mdi-filter-outline me-1"></i>Filter Data Pra Landbank
                            </h6>

                            {{-- DESKTOP --}}
                            <div class="filter-row-desktop">
                                <div class="row g-2 align-items-end w-100">

                                    {{-- Search Nama Tanah --}}
                                    <div class="col-md-4">
                                        <label class="form-label">Cari Nama Tanah</label>
                                        <input type="text" class="form-control" id="searchInput"
                                            placeholder="Ketik nama tanah..."
                                            value="{{ request('search') }}">
                                    </div>

                                    {{-- Status Negosiasi --}}
                                    <div class="col-md-3">
                                        <label class="form-label">Status Negosiasi</label>
                                        <select class="form-control" id="statusSelect">
                                            <option value="">Semua Status</option>
                                            <option value="negotiation" {{ request('negotiation_status')=='negotiation'?'selected':'' }}>Masih Negosiasi</option>
                                            <option value="almost_deal"  {{ request('negotiation_status')=='almost_deal'?'selected':'' }}>Hampir Deal</option>
                                            <option value="deal"         {{ request('negotiation_status')=='deal'?'selected':'' }}>Sudah Deal</option>
                                            <option value="cancel"       {{ request('negotiation_status')=='cancel'?'selected':'' }}>Batal</option>
                                        </select>
                                    </div>

                                    {{-- Tampil --}}
                                    <div class="col-md-2">
                                        <label class="form-label">Tampil</label>
                                        <select class="form-control" id="perPageSelect">
                                            <option value="10" {{ request('perPage',10)==10?'selected':'' }}>10</option>
                                            <option value="15" {{ request('perPage')==15?'selected':'' }}>15</option>
                                            <option value="25" {{ request('perPage')==25?'selected':'' }}>25</option>
                                        </select>
                                    </div>

                                    {{-- Tombol --}}
                                    <div class="col-md-3">
                                        <label class="form-label invisible d-none d-md-block">Aksi</label>
                                        <div class="d-flex gap-2">
                                            <button type="button" class="btn btn-gradient-primary btn-icon-only flex-fill" id="filterBtn" title="Filter">
                                                <i class="mdi mdi-filter"></i>
                                            </button>
                                            <button type="button" class="btn btn-gradient-secondary btn-icon-only flex-fill" id="resetBtn" title="Reset">
                                                <i class="mdi mdi-refresh"></i>
                                            </button>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            {{-- MOBILE --}}
                            <div class="filter-row-mobile">
                                <div class="row g-2">
                                    <div class="col-12 mb-2">
                                        <label class="form-label">Cari Nama Tanah</label>
                                        <input type="text" class="form-control" id="searchInputMobile"
                                            placeholder="Ketik nama tanah..."
                                            value="{{ request('search') }}">
                                    </div>
                                    <div class="col-12 mb-2">
                                        <label class="form-label">Status Negosiasi</label>
                                        <select class="form-control" id="statusSelectMobile">
                                            <option value="">Semua Status</option>
                                            <option value="negotiation" {{ request('negotiation_status')=='negotiation'?'selected':'' }}>Masih Negosiasi</option>
                                            <option value="almost_deal"  {{ request('negotiation_status')=='almost_deal'?'selected':'' }}>Hampir Deal</option>
                                            <option value="deal"         {{ request('negotiation_status')=='deal'?'selected':'' }}>Sudah Deal</option>
                                            <option value="cancel"       {{ request('negotiation_status')=='cancel'?'selected':'' }}>Batal</option>
                                        </select>
                                    </div>
                                    <div class="col-12 mb-2">
                                        <label class="form-label">Tampil</label>
                                        <select class="form-control" id="perPageSelectMobile">
                                            <option value="10" {{ request('perPage',10)==10?'selected':'' }}>10</option>
                                            <option value="15" {{ request('perPage')==15?'selected':'' }}>15</option>
                                            <option value="25" {{ request('perPage')==25?'selected':'' }}>25</option>
                                        </select>
                                    </div>
                                    <div class="col-6">
                                        <button type="button" class="btn btn-gradient-primary w-100" id="filterBtnMobile">
                                            <i class="mdi mdi-filter"></i>
                                        </button>
                                    </div>
                                    <div class="col-6">
                                        <button type="button" class="btn btn-gradient-secondary w-100" id="resetBtnMobile">
                                            <i class="mdi mdi-refresh"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    {{-- TABEL --}}
                    <div class="table-responsive">
                        <table class="table table-hover align-middle" style="width:100%;margin-bottom:0;">
                            <thead>
                                <tr>
                                    <th class="text-center no-sort">No</th>
                                    <th class="sortable" data-field="land_name"
                                        data-direction="{{ request('sortField')=='land_name' ? (request('sortDirection')=='asc'?'desc':'asc') : 'asc' }}">
                                        Nama Tanah
                                        @if(request('sortField')=='land_name')
                                            <i class="mdi mdi-{{ request('sortDirection')=='asc' ? 'arrow-up' : 'arrow-down' }} sort-icon"></i>
                                        @else
                                            <i class="mdi mdi-swap-vertical sort-icon"></i>
                                        @endif
                                    </th>
                                    <th>Makelar / Sumber</th>
                                    <th>Lokasi</th>
                                    <th class="sortable" data-field="estimated_price"
                                        data-direction="{{ request('sortField')=='estimated_price' ? (request('sortDirection')=='asc'?'desc':'asc') : 'asc' }}">
                                        Harga Negosiasi
                                        @if(request('sortField')=='estimated_price')
                                            <i class="mdi mdi-{{ request('sortDirection')=='asc' ? 'arrow-up' : 'arrow-down' }} sort-icon"></i>
                                        @else
                                            <i class="mdi mdi-swap-vertical sort-icon"></i>
                                        @endif
                                    </th>
                                    <th class="sortable" data-field="negotiation_status"
                                        data-direction="{{ request('sortField')=='negotiation_status' ? (request('sortDirection')=='asc'?'desc':'asc') : 'asc' }}">
                                        Status
                                        @if(request('sortField')=='negotiation_status')
                                            <i class="mdi mdi-{{ request('sortDirection')=='asc' ? 'arrow-up' : 'arrow-down' }} sort-icon"></i>
                                        @else
                                            <i class="mdi mdi-swap-vertical sort-icon"></i>
                                        @endif
                                    </th>
                                    <th class="text-center no-sort">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($praLandBank as $item)
                                    <tr>
                                        <td class="text-center fw-bold">{{ $loop->iteration + ($praLandBank->currentPage() - 1) * $praLandBank->perPage() }}</td>
                                        <td>
                                            <div class="d-flex align-items-center gap-2">
                                                <i class="mdi mdi-home-variant text-primary" style="font-size:1.2rem;"></i>
                                                <span class="fw-bold">{{ $item->land_name ?? '-' }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center gap-2">
                                                <i class="mdi mdi-account-tie" style="font-size:1.2rem;color:#17a2b8;"></i>
                                                <span>{{ $item->land_source ?? '-' }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center gap-2">
                                                <i class="mdi mdi-map-marker" style="font-size:1.2rem;color:#dc3545;"></i>
                                                <span>{{ Str::limit($item->address ?? '-', 30) }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="fw-bold" style="color:#28a745;">Rp {{ number_format($item->estimated_price ?? 0, 0, ',', '.') }}</span>
                                        </td>
                                        <td>
                                            @php $ns = $item->negotiation_status ?? ''; @endphp
                                            @if($ns == 'deal')
                                                <span class="badge-status badge-deal"><i class="mdi mdi-check-circle"></i> Sudah Deal</span>
                                            @elseif($ns == 'almost_deal')
                                                <span class="badge-status badge-almost"><i class="mdi mdi-check"></i> Hampir Deal</span>
                                            @elseif($ns == 'cancel')
                                                <span class="badge-status badge-cancel"><i class="mdi mdi-close-circle"></i> Batal</span>
                                            @else
                                                <span class="badge-status badge-negotiate"><i class="mdi mdi-clock-outline"></i> Masih Negosiasi</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <button class="btn-action view" title="Lihat Detail">
                                                <i class="mdi mdi-eye"></i>
                                            </button>
                                            <button class="btn-action edit" title="Edit">
                                                <i class="mdi mdi-pencil"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center text-muted py-5">
                                            <i class="mdi mdi-hand-holding" style="font-size:3rem;opacity:0.3;"></i>
                                            <p class="mt-2 mb-0">Tidak ada data pra tanah yang tersedia.</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination --}}
                    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mt-4">
                        <div class="pagination-info mb-2 mb-sm-0">
                            Menampilkan <strong>{{ $praLandBank->firstItem() ?? 0 }}</strong> -
                            <strong>{{ $praLandBank->lastItem() ?? 0 }}</strong> dari
                            <strong>{{ $praLandBank->total() }}</strong> data
                        </div>
                        <nav>
                            <ul class="pagination">
                                {{-- Prev --}}
                                @if($praLandBank->onFirstPage())
                                    <li class="page-item disabled">
                                        <span class="page-link"><i class="mdi mdi-chevron-left"></i></span>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $praLandBank->appends(request()->query())->previousPageUrl() }}" onclick="showPaginationLoading(event)">
                                            <i class="mdi mdi-chevron-left"></i>
                                        </a>
                                    </li>
                                @endif

                                {{-- Halaman --}}
                                @foreach($praLandBank->getUrlRange(max(1, $praLandBank->currentPage() - 2), min($praLandBank->lastPage(), $praLandBank->currentPage() + 2)) as $page => $url)
                                    @if($page == $praLandBank->currentPage())
                                        <li class="page-item active">
                                            <span class="page-link">{{ $page }}</span>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $praLandBank->appends(request()->query())->url($page) }}" onclick="showPaginationLoading(event)">{{ $page }}</a>
                                        </li>
                                    @endif
                                @endforeach

                                {{-- Next --}}
                                @if($praLandBank->hasMorePages())
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $praLandBank->appends(request()->query())->nextPageUrl() }}" onclick="showPaginationLoading(event)">
                                            <i class="mdi mdi-chevron-right"></i>
                                        </a>
                                    </li>
                                @else
                                    <li class="page-item disabled">
                                        <span class="page-link"><i class="mdi mdi-chevron-right"></i></span>
                                    </li>
                                @endif
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
<script>
$(document).ready(function () {

    // =============================================
    // Helper: build URL params lalu redirect
    // =============================================
    function applyFilter(isMobile) {
        var search  = isMobile ? $('#searchInputMobile').val()  : $('#searchInput').val();
        var status  = isMobile ? $('#statusSelectMobile').val() : $('#statusSelect').val();
        var perPage = isMobile ? $('#perPageSelectMobile').val(): $('#perPageSelect').val();

        showFilterLoading();

        var params = new URLSearchParams({
            search:             search,
            negotiation_status: status,
            perPage:            perPage,
            sortField:          '{{ request('sortField', 'created_at') }}',
            sortDirection:      '{{ request('sortDirection', 'desc') }}'
        });
        window.location.href = '{{ route('pralandbank.all') }}?' + params.toString();
    }

    // Filter & Reset — Desktop
    $('#filterBtn').on('click', function () { applyFilter(false); });
    $('#resetBtn').on('click', function () {
        showResetLoading({ preventDefault: function(){}, currentTarget: { href: '{{ route('pralandbank.all') }}' } });
    });

    // Filter & Reset — Mobile
    $('#filterBtnMobile').on('click', function () { applyFilter(true); });
    $('#resetBtnMobile').on('click', function () {
        showResetLoading({ preventDefault: function(){}, currentTarget: { href: '{{ route('pralandbank.all') }}' } });
    });

    // Enter → filter
    $('#searchInput').on('keypress', function (e) {
        if (e.which === 13) { applyFilter(false); }
    });
    $('#searchInputMobile').on('keypress', function (e) {
        if (e.which === 13) { applyFilter(true); }
    });

    // =============================================
    // Sort kolom (klik header th.sortable)
    // =============================================
    $('.sortable').on('click', function () {
        var field     = $(this).data('field');
        var direction = $(this).data('direction');

        Swal.fire({
            title: 'Memuat...',
            html: 'Sedang mengurutkan data',
            allowOutsideClick: false,
            didOpen: () => { Swal.showLoading(); }
        });

        var params = new URLSearchParams({
            search:             '{{ request('search') }}',
            negotiation_status: '{{ request('negotiation_status') }}',
            perPage:            '{{ request('perPage', 10) }}',
            sortField:          field,
            sortDirection:      direction
        });
        window.location.href = '?' + params.toString();
    });

    // =============================================
    // Pagination loading
    // =============================================
    $(document).on('click', '.pagination a', function (e) {
        showPaginationLoading(e);
    });

    // =============================================
    // Tombol Aksi
    // =============================================
    $('.btn-action.view').on('click', function () {
        Swal.fire({ icon:'info', title:'Fitur Detail', text:'Fitur lihat detail akan segera tersedia.', confirmButtonColor:'#9a55ff' });
    });
    $('.btn-action.edit').on('click', function () {
        Swal.fire({ icon:'info', title:'Fitur Edit', text:'Fitur edit akan segera tersedia.', confirmButtonColor:'#9a55ff' });
    });

});

// Fungsi loading untuk filter
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

// Fungsi loading untuk reset
function showResetLoading(event) {
    event.preventDefault();
    Swal.fire({
        title: 'Memuat...',
        html: 'Sedang mereset filter',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });
    window.location.href = event.currentTarget.href;
}

// Fungsi loading untuk pagination
function showPaginationLoading(event) {
    event.preventDefault();
    Swal.fire({
        title: 'Memuat...',
        html: 'Sedang memuat halaman',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });
    window.location.href = event.currentTarget.href;
}
</script>
@endpush

