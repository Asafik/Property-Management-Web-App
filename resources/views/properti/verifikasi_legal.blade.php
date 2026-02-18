@extends('layouts.partial.app')

@section('title', 'Verifikasi Legal - Property Management App')

@section('content')
<style>
/* ===== MODERN STYLING UNTUK HALAMAN VERIFIKASI LEGAL ===== */

/* Container Padding - Responsif */
.container-fluid {
    padding-left: 0.5rem !important;
    padding-right: 0.5rem !important;
}

@media (min-width: 576px) {
    .container-fluid {
        padding-left: 1rem !important;
        padding-right: 1rem !important;
    }
}

@media (min-width: 768px) {
    .container-fluid {
        padding-left: 1.5rem !important;
        padding-right: 1.5rem !important;
    }
}

/* ===== CARD STYLING - PAKAI BAWAAN BOOTSTRAP ===== */
.card {
    transition: all 0.3s ease;
    margin-bottom: 1rem;
}

.card:hover {
    box-shadow: 0 8px 25px rgba(154, 85, 255, 0.1) !important;
}

.card-body {
    padding: 0.75rem;
}

@media (min-width: 576px) {
    .card-body {
        padding: 1rem;
    }
}

@media (min-width: 768px) {
    .card-body {
        padding: 1.2rem;
    }
}

/* Card Title */
.card-title {
    font-size: 0.85rem;
    font-weight: 600;
    color: #9a55ff;
}

@media (min-width: 576px) {
    .card-title {
        font-size: 0.9rem;
    }
}

@media (min-width: 768px) {
    .card-title {
        font-size: 1rem;
    }
}

/* Form Controls - Modern Styling */
.form-control, .form-select {
    border: 1px solid #e9ecef;
    border-radius: 8px;
    padding: 0.4rem 0.6rem;
    font-size: 0.75rem;
    transition: all 0.2s ease;
    background-color: #ffffff;
    color: #2c2e3f;
    height: auto;
}

@media (min-width: 576px) {
    .form-control, .form-select {
        padding: 0.5rem 0.75rem;
        font-size: 0.8rem;
        border-radius: 10px;
    }
}

@media (min-width: 768px) {
    .form-control, .form-select {
        padding: 0.6rem 0.8rem;
        font-size: 0.85rem;
    }
}

.form-control:focus, .form-select:focus {
    border-color: #9a55ff;
    box-shadow: 0 0 0 3px rgba(154, 85, 255, 0.1);
    outline: none;
}

/* Form Label */
.form-label {
    font-size: 0.7rem;
    font-weight: 600;
    color: #9a55ff !important;
    margin-bottom: 0.2rem;
    letter-spacing: 0.3px;
    font-family: 'Nunito', sans-serif;
}

@media (min-width: 576px) {
    .form-label {
        font-size: 0.75rem;
        margin-bottom: 0.25rem;
    }
}

@media (min-width: 768px) {
    .form-label {
        font-size: 0.8rem;
        margin-bottom: 0.3rem;
    }
}

.text-muted {
    color: #a5b3cb !important;
    font-size: 0.7rem;
}

@media (min-width: 576px) {
    .text-muted {
        font-size: 0.75rem;
    }
}

/* Button Styling Modern - SOLID COLORS */
.btn {
    font-size: 0.7rem;
    padding: 0.35rem 0.6rem;
    border-radius: 6px;
    font-weight: 600;
    transition: all 0.3s ease;
    font-family: 'Nunito', sans-serif;
    border: none;
}

@media (min-width: 576px) {
    .btn {
        font-size: 0.75rem;
        padding: 0.4rem 0.75rem;
        border-radius: 8px;
    }
}

@media (min-width: 768px) {
    .btn {
        font-size: 0.8rem;
        padding: 0.5rem 1rem;
        border-radius: 10px;
    }
}

.btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.btn-sm {
    padding: 0.2rem 0.4rem;
    font-size: 0.65rem;
    border-radius: 4px;
}

@media (min-width: 576px) {
    .btn-sm {
        padding: 0.25rem 0.5rem;
        font-size: 0.7rem;
        border-radius: 6px;
    }
}

@media (min-width: 768px) {
    .btn-sm {
        padding: 0.3rem 0.6rem;
        font-size: 0.75rem;
    }
}

/* SOLID BUTTON STYLES */
.btn-secondary {
    background: #6c757d !important;
    color: #ffffff !important;
}

.btn-secondary:hover {
    background: #5a6268 !important;
    color: #ffffff !important;
}

.btn-warning {
    background: #ffc107 !important;
    color: #212529 !important;
}

.btn-warning:hover {
    background: #e0a800 !important;
    color: #212529 !important;
}

.btn-danger {
    background: #dc3545 !important;
    color: #ffffff !important;
}

.btn-danger:hover {
    background: #c82333 !important;
    color: #ffffff !important;
}

.btn-success {
    background: #28a745 !important;
    color: #ffffff !important;
}

.btn-success:hover {
    background: #218838 !important;
    color: #ffffff !important;
}

.btn-primary {
    background: linear-gradient(to right, #da8cff, #9a55ff) !important;
    color: #ffffff !important;
    box-shadow: 0 4px 12px rgba(154, 85, 255, 0.3);
}

.btn-primary:hover {
    background: linear-gradient(to right, #c77cff, #8a45e6) !important;
    color: #ffffff !important;
}

/* Gradient Buttons - hanya untuk icon buttons */
.btn-gradient-primary {
    background: linear-gradient(to right, #da8cff, #9a55ff);
    color: #ffffff;
    box-shadow: 0 4px 12px rgba(154, 85, 255, 0.3);
}

.btn-gradient-primary:hover {
    background: linear-gradient(to right, #c77cff, #8a45e6);
    color: #ffffff;
}

.btn-gradient-success {
    background: linear-gradient(135deg, #28a745, #5cb85c);
    color: #ffffff;
    box-shadow: 0 4px 12px rgba(40, 167, 69, 0.3);
}

.btn-gradient-success:hover {
    background: linear-gradient(135deg, #218838, #4cae4c);
    color: #ffffff;
}

.btn-gradient-danger {
    background: linear-gradient(135deg, #dc3545, #e4606d);
    color: #ffffff;
    box-shadow: 0 4px 12px rgba(220, 53, 69, 0.3);
}

.btn-gradient-danger:hover {
    background: linear-gradient(135deg, #c82333, #dc3545);
    color: #ffffff;
}

/* Light Button */
.btn-light {
    background: #f8f9fa;
    border: 1px solid #e9ecef;
    color: #2c2e3f;
}

.btn-light:hover {
    background: #e9ecef;
    color: #2c2e3f;
    transform: translateY(-2px);
}

/* Badge Styling Modern */
.badge {
    padding: 0.3rem 0.5rem;
    font-size: 0.7rem;
    font-weight: 600;
    border-radius: 30px;
    display: inline-block;
    white-space: nowrap;
}

@media (min-width: 576px) {
    .badge {
        padding: 0.35rem 0.65rem;
        font-size: 0.75rem;
    }
}

@media (min-width: 768px) {
    .badge {
        padding: 0.4rem 0.8rem;
        font-size: 0.8rem;
    }
}

/* Badge Colors */
.badge.bg-warning {
    background: linear-gradient(135deg, #ffc107, #ffdb6d) !important;
    color: #2c2e3f;
}

.badge.bg-success {
    background: linear-gradient(135deg, #28a745, #5cb85c) !important;
    color: #ffffff;
}

.badge.bg-danger {
    background: linear-gradient(135deg, #dc3545, #e4606d) !important;
    color: #ffffff;
}

.badge.bg-primary {
    background: linear-gradient(135deg, #9a55ff, #da8cff) !important;
    color: #ffffff;
}

/* Table Styling Modern */
.table-responsive {
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
    border-radius: 8px;
    margin-bottom: 0.5rem;
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
    font-size: 0.7rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    border-bottom: 2px solid #e9ecef;
    padding: 0.6rem 0.4rem;
    white-space: nowrap;
}

@media (min-width: 576px) {
    .table thead th {
        font-size: 0.75rem;
        padding: 0.7rem 0.5rem;
    }
}

@media (min-width: 768px) {
    .table thead th {
        font-size: 0.8rem;
        padding: 0.85rem 0.75rem;
    }
}

.table tbody td {
    vertical-align: middle;
    font-size: 0.75rem;
    padding: 0.6rem 0.4rem;
    border-bottom: 1px solid #e9ecef;
    color: #2c2e3f;
}

@media (min-width: 576px) {
    .table tbody td {
        font-size: 0.8rem;
        padding: 0.7rem 0.5rem;
    }
}

@media (min-width: 768px) {
    .table tbody td {
        font-size: 0.85rem;
        padding: 0.85rem 0.75rem;
    }
}

.table tbody tr:hover {
    background-color: #f8f9fa;
}

/* Modal Styling Modern */
.modal-content {
    border: none;
    border-radius: 16px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
}

.modal-header {
    background: linear-gradient(135deg, #ffffff, #f8f9fa);
    border-bottom: 1px solid #e9ecef;
    padding: 1rem;
    border-radius: 16px 16px 0 0;
}

.modal-title {
    font-size: 1rem;
    font-weight: 700;
    color: #9a55ff;
}

@media (min-width: 576px) {
    .modal-title {
        font-size: 1.1rem;
    }
}

.modal-body {
    padding: 1.2rem;
}

.modal-footer {
    border-top: 1px solid #e9ecef;
    padding: 1rem;
    border-radius: 0 0 16px 16px;
}

/* Progress Bar Styling */
.progress {
    background-color: #e9ecef;
    border-radius: 10px;
    overflow: hidden;
}

.progress-bar {
    background: linear-gradient(135deg, #28a745, #5cb85c);
    border-radius: 10px;
    transition: width 0.3s ease;
}

/* Typography */
h3.text-dark {
    font-size: 1.2rem !important;
    font-weight: 700;
    color: #2c2e3f !important;
    margin-bottom: 0.25rem !important;
}

@media (min-width: 576px) {
    h3.text-dark {
        font-size: 1.3rem !important;
    }
}

@media (min-width: 768px) {
    h3.text-dark {
        font-size: 1.5rem !important;
    }
}

@media (min-width: 992px) {
    h3.text-dark {
        font-size: 1.8rem !important;
    }
}

h5 {
    font-size: 0.9rem;
    font-weight: 600;
    color: #2c2e3f;
}

@media (min-width: 576px) {
    h5 {
        font-size: 1rem;
    }
}

@media (min-width: 768px) {
    h5 {
        font-size: 1.1rem;
    }
}

/* Text colors */
.fw-bold {
    font-weight: 600 !important;
}

.text-muted {
    color: #a5b3cb !important;
}

.text-danger {
    color: #dc3545 !important;
}

/* Card bg-light */
.card.bg-light {
    background: linear-gradient(135deg, #f8f9fa, #f1f3f5) !important;
}

/* Progress badge */
.badge.bg-primary {
    background: linear-gradient(135deg, #9a55ff, #da8cff) !important;
}

/* Info properti row */
.row .col-md-3 {
    margin-bottom: 0.5rem;
}

@media (min-width: 768px) {
    .row .col-md-3 {
        margin-bottom: 0;
    }
}

/* Button group */
.d-flex.gap-2 {
    gap: 0.3rem !important;
}

@media (min-width: 576px) {
    .d-flex.gap-2 {
        gap: 0.5rem !important;
    }
}

/* Better touch targets for mobile */
input, select, textarea, button {
    font-size: 16px !important;
}

/* Form textarea */
textarea.form-control {
    min-height: 100px;
}

/* Small text in modal */
.small.text-muted {
    font-size: 0.65rem !important;
}

@media (min-width: 576px) {
    .small.text-muted {
        font-size: 0.7rem !important;
    }
}
</style>

<div class="container-fluid p-4">
    {{-- ================= HEADER CARD ================= --}}
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h3 class="text-dark mb-1">Verifikasi Legal Properti</h3>
                    <p class="text-muted mb-0">Periksa dan verifikasi kelengkapan dokumen legal tanah</p>
                </div>
            </div>
        </div>
    </div>

    {{-- ================= INFO PROPERTI ================= --}}
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="mb-3">Informasi Properti</h5>

            <div class="row">
                <div class="col-md-3">
                    <small class="text-muted">Nama Tanah</small>
                    <p class="fw-bold">{{ $land->name }}</p>
                </div>

                <div class="col-md-3">
                    <small class="text-muted">Status Kepemilikan</small>
                    <p class="fw-bold">{{ $land->ownership_status }}</p>
                </div>

                <div class="col-md-3">
                    <small class="text-muted">Luas</small>
                    <p class="fw-bold">{{ number_format($land->area, 0, ',', '.') }} m²</p>
                </div>

                <div class="col-md-3">
                    <small class="text-muted">Tanggal Pengajuan</small>
                    <p class="fw-bold">{{ $land->created_at->format('d M Y') }}</p>
                </div>
            </div>

            <div class="mt-3">
                <small class="text-muted">Alamat</small>
                <p class="fw-bold">
                    {{ $land->address }},
                    {{ $land->village }},
                    {{ $land->district }},
                    {{ $land->city }},
                    {{ $land->province }}
                </p>
            </div>
        </div>
    </div>

    {{-- ================= PROGRESS ================= --}}
    @php
        $total = $land->documents->count();
        $verified = $land->documents->where('status', 'terverifikasi')->count();
        $percent = $total > 0 ? ($verified / $total) * 100 : 0;
    @endphp

    <div class="card bg-light mb-4">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <strong>Progress Verifikasi</strong>
                <span class="badge bg-primary">
                    {{ $verified }} dari {{ $total }} terverifikasi
                </span>
            </div>

            <div class="progress mt-2" style="height:8px;">
                <div class="progress-bar bg-success" style="width: {{ $percent }}%">
                </div>
            </div>

            <small class="text-muted">{{ round($percent) }}% selesai</small>
        </div>
    </div>

    {{-- ================= TABEL DOKUMEN ================= --}}
    <div class="card">
        <div class="card-body">
            <h5 class="mb-3">Daftar Dokumen</h5>

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Jenis</th>
                            <th>Nomor</th>
                            <th>Tanggal Upload</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($land->documents as $doc)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ ucfirst($doc->type) }}</td>
                                <td>{{ $doc->document_number ?? '-' }}</td>
                                <td>{{ $doc->created_at->format('d M Y') }}</td>
                                <td>
                                    @if ($doc->status == 'pending')
                                        <span class="badge bg-warning">Pending</span>
                                    @elseif($doc->status == 'terverifikasi')
                                        <span class="badge bg-success">Terverifikasi</span>
                                    @else
                                        <span class="badge bg-danger">Ditolak</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ asset('storage/' . $doc->file_path) }}" target="_blank"
                                        class="btn btn-sm btn-gradient-primary">
                                        <i class="mdi mdi-eye"></i>
                                    </a>

                                    @if ($doc->status == 'pending')
                                        <form action="{{ route('dokumen.approve', $doc->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            <button class="btn btn-sm btn-gradient-success">
                                                <i class="mdi mdi-check"></i>
                                            </button>
                                        </form>

                                        <form action="{{ route('dokumen.reject', $doc->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            <button type="button" class="btn btn-sm btn-gradient-danger"
                                                data-bs-toggle="modal"
                                                data-bs-target="#rejectModal{{ $doc->id }}">
                                                <i class="mdi mdi-close"></i>
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>

                            <!-- Modal Reject Individual -->
                            <div class="modal fade" id="rejectModal{{ $doc->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="{{ route('dokumen.reject', $doc->id) }}" method="POST">
                                            @csrf
                                            <div class="modal-header">
                                                <h5 class="modal-title">
                                                    Tolak Dokumen
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal">
                                                </button>
                                            </div>

                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label class="form-label">
                                                        Catatan Penolakan <span class="text-danger">*</span>
                                                    </label>
                                                    <textarea name="catatan_admin" class="form-control" rows="4" required></textarea>
                                                    <small class="text-muted">
                                                        Wajib diisi sebelum dokumen ditolak.
                                                    </small>
                                                </div>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                    Batal
                                                </button>
                                                <button type="submit" class="btn btn-danger">
                                                    Tolak Dokumen
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">
                                    Belum ada dokumen
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- ================= ACTION ================= --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                        <!-- Kiri - BUTTON KEMBALI SOLID -->
                        <a href="{{ route('properti-all') }}" class="btn btn-secondary">
                            <i class="mdi mdi-arrow-left me-1"></i> Kembali
                        </a>

                        <!-- Kanan - SOLID BUTTONS -->
                        <div class="d-flex gap-2 flex-wrap">
                            @if ($land->documents->where('status', 'ditolak')->count() > 0)
                                <a href="{{ route('properti.revisi', $land->id) }}" class="btn btn-warning">
                                    Revisi Dokumen
                                </a>
                            @endif

                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalTolak">
                                Tolak Pengajuan
                            </button>

                            <form id="formSetujuiSemua" method="POST" action="{{ route('properti.approveAll', $land->id) }}">
                                @csrf
                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#confirmModal">
                                    Setujui Semua
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Konfirmasi Setuju Semua -->
    <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmModalLabel">Konfirmasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menyetujui semua? <br>
                    <small class="text-muted">Silakan dicek kembali dokumennya sebelum menyetujui.</small>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-success" id="confirmSubmit">Ya, Setujui</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tolak Semua -->
    <div class="modal fade" id="modalTolak" tabindex="-1" aria-labelledby="modalTolakLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST" action="{{ route('properti.rejectAll', $land->id) }}">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTolakLabel">Tolak Semua Dokumen</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="catatan_admin" class="form-label">Catatan Penolakan</label>
                            <textarea class="form-control" name="catatan_admin" id="catatan_admin" rows="3" placeholder="Masukkan catatan..." required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger">Tolak Semua</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script>
    document.getElementById('confirmSubmit').addEventListener('click', function() {
        document.getElementById('formSetujuiSemua').submit();
    });
</script>
@endpush
