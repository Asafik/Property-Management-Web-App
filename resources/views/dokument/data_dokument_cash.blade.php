@extends('layouts.partial.app')

@section('title', 'Pengecekan Dokumen Cash Legal - Property Management App')

@section('content')
    <link rel="stylesheet" href="{{ asset('assets/css/bank/bank.css') }}">

    <div class="container-fluid p-2 p-sm-3 p-md-4">
        <!-- Header Dashboard -->
        <div class="row mb-3 mb-sm-3 mb-md-4">
            <div class="col-12">
                <div class="card shadow-sm border-0">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="text-dark mb-1">
                                <i class="mdi mdi-file-document-multiple me-2" style="color: #9a55ff;"></i>
                                Pengecekan Dokumen Cash Legal
                            </h3>
                            <p class="text-muted mb-0">
                                <i class="mdi mdi-information-outline me-1"></i>
                                Cek kelengkapan dokumen legal per booking
                            </p>
                        </div>
                        <div class="d-none d-sm-block">
                            <i class="mdi mdi-file-document" style="font-size: 2.5rem; color: #9a55ff; opacity: 0.2;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabel Pengecekan Dokumen -->
        <div class="row mt-2 mt-sm-2 mt-md-3">
            <div class="col-12">
                <div class="card">
                    <div
                        class="card-header bg-white d-flex flex-wrap flex-md-row justify-content-between align-items-center gap-2">
                        <h5 class="card-title mb-0">
                            <i class="mdi mdi-format-list-bulleted me-2 text-primary"></i>
                            Daftar Pengecekan Dokumen
                        </h5>
                    </div>

                    <div class="card-body">
                        <!-- FILTER SECTION -->
                        <div class="filter-card mb-4">
                            <div class="card-body">
                                <h6 class="card-title mb-3" style="font-size: 1rem;">
                                    <i class="mdi mdi-filter-outline me-1" style="color: #9a55ff;"></i>
                                    Filter Data
                                </h6>

                                <!-- MOBILE VERSION -->
                                <div class="d-block d-md-none">
                                    <form method="GET" action="#">
                                        <div class="mb-3">
                                            <label class="form-label fw-semibold">
                                                <i class="mdi mdi-magnify me-1" style="color: #9a55ff;"></i>
                                                Cari Booking / Customer
                                            </label>
                                            <input type="text" class="form-control" name="search"
                                                placeholder="Cari ID booking atau nama..." style="height: 45px;">
                                        </div>

                                        <div class="row g-2 mb-3">
                                            <div class="col-6">
                                                <label class="form-label fw-semibold">
                                                    <i class="mdi mdi-flag me-1" style="color: #9a55ff;"></i>Kelengkapan
                                                </label>
                                                <select class="form-control" name="kelengkapan" style="height: 45px;">
                                                    <option value="">Semua</option>
                                                    <option value="lengkap">Lengkap</option>
                                                    <option value="kurang">Kurang</option>
                                                </select>
                                            </div>
                                            <div class="col-6">
                                                <label class="form-label fw-semibold">
                                                    <i class="mdi mdi-chart-arc me-1" style="color: #9a55ff;"></i>Status
                                                </label>
                                                <select class="form-control" name="status" style="height: 45px;">
                                                    <option value="">Semua</option>
                                                    <option value="verified">Terverifikasi</option>
                                                    <option value="pending">Pending</option>
                                                    <option value="rejected">Revisi</option>
                                                    <option value="draft">Draft</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row g-2">
                                            <div class="col-6">
                                                <button type="submit"
                                                    class="btn btn-gradient-primary w-100 py-2 d-flex align-items-center justify-content-center">
                                                    <i class="mdi mdi-filter me-1"></i> Filter
                                                </button>
                                            </div>
                                            <div class="col-6">
                                                <a href="#"
                                                    class="btn btn-gradient-secondary w-100 py-2 d-flex align-items-center justify-content-center">
                                                    <i class="mdi mdi-refresh me-1"></i> Reset
                                                </a>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <!-- DESKTOP VERSION -->
                                <div class="d-none d-md-block">
                                    <form method="GET" action="#">
                                        <div class="row g-2 align-items-end">
                                            <div class="col-md-3">
                                                <label class="form-label">
                                                    <i class="mdi mdi-magnify me-1" style="color: #9a55ff;"></i>
                                                    Cari Booking / Customer
                                                </label>
                                                <input type="text" class="form-control" name="search"
                                                    placeholder="ID booking atau nama...">
                                            </div>

                                            <div class="col-md-2">
                                                <label class="form-label">
                                                    <i class="mdi mdi-flag me-1" style="color: #9a55ff;"></i>Kelengkapan
                                                </label>
                                                <select class="form-control" name="kelengkapan">
                                                    <option value="">Semua</option>
                                                    <option value="lengkap">Lengkap</option>
                                                    <option value="kurang">Kurang</option>
                                                </select>
                                            </div>

                                            <div class="col-md-2">
                                                <label class="form-label">
                                                    <i class="mdi mdi-chart-arc me-1" style="color: #9a55ff;"></i>Status
                                                </label>
                                                <select class="form-control" name="status">
                                                    <option value="">Semua</option>
                                                    <option value="verified">Terverifikasi</option>
                                                    <option value="pending">Pending</option>
                                                    <option value="rejected">Revisi</option>
                                                    <option value="draft">Draft</option>
                                                </select>
                                            </div>

                                            <div class="col-md-2">
                                                <label class="form-label">
                                                    <i class="mdi mdi-counter me-1" style="color: #9a55ff;"></i>Tampil
                                                </label>
                                                <select class="form-control" name="per_page">
                                                    <option value="10">10</option>
                                                    <option value="15">15</option>
                                                    <option value="25">25</option>
                                                    <option value="50">50</option>
                                                </select>
                                            </div>

                                            <div class="col-md-1">
                                                <label class="form-label invisible">Filter</label>
                                                <button type="submit"
                                                    class="btn btn-gradient-primary w-100 d-flex align-items-center justify-content-center">
                                                    <i class="mdi mdi-filter me-1"></i> Filter
                                                </button>
                                            </div>

                                            <div class="col-md-2">
                                                <label class="form-label invisible">Reset</label>
                                                <a href="#"
                                                    class="btn btn-gradient-secondary w-100 d-flex align-items-center justify-content-center"
                                                    title="Reset">
                                                    <i class="mdi mdi-refresh me-1"></i> Reset
                                                </a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- STATS CARDS -->
                        <div class="row g-3 mb-4">
                            <div class="col-6 col-md-3">
                                <div class="card bg-light border-0">
                                    <div class="card-body p-3">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0 me-3">
                                                <i class="mdi mdi-file-document text-primary"
                                                    style="font-size: 2rem;"></i>
                                            </div>
                                            <div>
                                                <h5 class="fw-bold mb-0">{{ $totalBooking }}</h5>
                                                <p class="text-muted small mb-0">Total Booking</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-md-3">
                                <div class="card bg-light border-0">
                                    <div class="card-body p-3">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0 me-3">
                                                <i class="mdi mdi-check-circle text-success" style="font-size: 2rem;"></i>
                                            </div>
                                            <div>
                                                <h5 class="fw-bold mb-0">{{ $lengkap }}</h5>
                                                <p class="text-muted small mb-0">Lengkap</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-md-3">
                                <div class="card bg-light border-0">
                                    <div class="card-body p-3">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0 me-3">
                                                <i class="mdi mdi-clock-outline text-warning"
                                                    style="font-size: 2rem;"></i>
                                            </div>
                                            <div>
                                                <h5 class="fw-bold mb-0">{{ $kurang }}</h5>
                                                <p class="text-muted small mb-0">Kurang</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-md-3">
                                <div class="card bg-light border-0">
                                    <div class="card-body p-3">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0 me-3">
                                                <i class="mdi mdi-alert-circle text-danger" style="font-size: 2rem;"></i>
                                            </div>
                                            <div>
                                                <h5 class="fw-bold mb-0">{{ $revisi }}</h5>
                                                <p class="text-muted small mb-0">Perlu Revisi</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- TABEL PENGECEKAN DOKUMEN -->
                        <div class="table-responsive">
                            <table class="table table-hover align-middle" id="tableCekDokumen">
                                <thead>
                                    <tr>
                                        <th class="text-center" width="5%">No</th>
                                        <th width="15%">ID Booking</th>
                                        <th width="20%">Nama Customer</th>
                                        <th width="20%">Unit</th>
                                        <th width="15%">Kelengkapan</th>
                                        <th width="15%">Status</th>
                                        <th class="text-center" width="10%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($bookings as $booking)
                                        @php
                                            $requiredDocs = $documents->where('required', true)->count();
                                            $uploaded = $booking->documentUploads
                                                ->whereIn(
                                                    'document_id',
                                                    $documents->where('required', true)->pluck('id'),
                                                )
                                                ->count();

                                            $lengkap = $uploaded >= $requiredDocs;
                                        @endphp

                                        <tr>
                                            <td class="text-center fw-bold">{{ $loop->iteration }}</td>

                                            <td>
                                                <span class="badge bg-light text-dark">
                                                    {{ $booking->booking_code }}
                                                </span>
                                            </td>

                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <i class="mdi mdi-account-circle text-primary me-2"></i>
                                                    {{ $booking->customer->full_name ?? '-' }}
                                                </div>
                                            </td>

                                            <td>
                                                {{ $booking->unit->unit_name ?? '-' }}
                                                Type : {{ $booking->unit->type ?? '-' }}
                                                Jenis : {{ $booking->unit->jenis ?? '-' }}
                                            </td>

                                            <td>
                                                @if ($lengkap)
                                                    <span class="badge badge-gradient-success">
                                                        <i class="mdi mdi-check-circle me-1"></i>Lengkap
                                                    </span>
                                                @else
                                                    <span class="badge badge-gradient-warning">
                                                        <i
                                                            class="mdi mdi-clock-outline me-1"></i>{{ $uploaded }}/{{ $requiredDocs }}
                                                    </span>
                                                @endif
                                            </td>

                                            <td>

                                                @if ($lengkap)
                                                    <span class="badge badge-gradient-success">
                                                        <i class="mdi mdi-check-circle me-1"></i>Siap Pecah Legal Unit
                                                    </span>
                                                @else
                                                    <span class="badge badge-gradient-warning">
                                                        <i class="mdi mdi-clock-outline me-1"></i>Pending
                                                    </span>
                                                @endif

                                            </td>

                                            <td class="text-center">
                                                <div class="d-flex justify-content-center gap-1">

                                                    <!-- Detail Dokumen -->
                                                    <button class="btn btn-outline-info btn-sm btn-detail-dokumen"
                                                        data-booking="{{ $booking->id }}" title="Detail Dokumen">
                                                        <i class="mdi mdi-eye"></i>
                                                    </button>

                                                    <!-- Button Akad -->
                                                    @if ($lengkap)
                                                        <a href="{{ route('akad.cash', $booking->id) }}"
                                                            class="btn btn-success btn-sm" title="Proses Akad">
                                                            <i class="mdi mdi-file-sign"></i>
                                                        </a>
                                                    @else
                                                        <button class="btn btn-secondary btn-sm" disabled
                                                            title="Dokumen belum lengkap">
                                                            <i class="mdi mdi-file-sign"></i>
                                                        </button>
                                                    @endif

                                                </div>
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="modal fade" id="modalDokumen" tabindex="-1">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <h5 class="modal-title">
                                            <i class="mdi mdi-file-document me-1"></i>
                                            Detail Dokumen Legal
                                        </h5>

                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>

                                    <div class="modal-body">

                                        <div id="loadingDokumen" class="text-center py-4">
                                            <div class="spinner-border text-primary"></div>
                                        </div>

                                        <div id="contentDokumen"></div>

                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- PAGINATION SECTION -->
                        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mt-4">
                            <div class="pagination-info mb-2 mb-sm-0">
                                <i class="mdi mdi-information-outline me-1 text-primary"></i>
                                Menampilkan 1 - 5 dari 24 data booking
                            </div>

                            <nav aria-label="Page navigation">
                                <ul class="pagination pagination-sm flex-wrap justify-content-center mb-0"
                                    style="gap: 2px;">
                                    <li class="page-item disabled">
                                        <span class="page-link" aria-label="Previous">
                                            <i class="mdi mdi-chevron-left"></i>
                                        </span>
                                    </li>
                                    <li class="page-item active">
                                        <span class="page-link">1</span>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="#">2</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="#">3</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="#">4</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="#">5</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="#" aria-label="Next">
                                            <i class="mdi mdi-chevron-right"></i>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tombol Kembali -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="d-flex flex-column flex-sm-row justify-content-start">
                            <a href="#" class="btn btn-gradient-secondary">
                                <i class="mdi mdi-arrow-left me-1"></i>
                                Kembali ke Dashboard
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // Inisialisasi DataTables dengan minimal features
            if ($.fn.DataTable.isDataTable('#tableCekDokumen')) {
                $('#tableCekDokumen').DataTable().destroy();
            }

            $('#tableCekDokumen').DataTable({
                responsive: true,
                ordering: true,
                paging: false,
                info: false,
                searching: false,
                lengthChange: false,
                destroy: true,
                language: {
                    emptyTable: "Data booking belum tersedia",
                    zeroRecords: "Data tidak ditemukan",
                },
                columnDefs: [{
                        orderable: false,
                        targets: [6]
                    } // Kolom aksi tidak bisa diurutkan
                ]
            });
        });
    </script>
    <script>
        document.querySelectorAll('.btn-detail-dokumen').forEach(btn => {

    btn.addEventListener('click', function(e) {

        e.preventDefault()

        let bookingId = this.dataset.booking

        // tampilkan modal
        $('#modalDokumen').modal('show')

        document.getElementById('loadingDokumen').style.display = 'block'
        document.getElementById('contentDokumen').innerHTML = ''

        fetch(`/document-legal/detail/${bookingId}`)
            .then(res => res.text())
            .then(html => {

                document.getElementById('loadingDokumen').style.display = 'none'
                document.getElementById('contentDokumen').innerHTML = html

            })

    })

})
    </script>
@endpush
