@extends('layouts.partial.app')

@section('title', 'Detail Progress Tugas')

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
    .btn-gradient-primary { background: linear-gradient(to right, #da8cff, #9a55ff) !important; color: #ffffff !important; }
    .btn-gradient-secondary { background: #6c757d !important; color: #ffffff !important; }
    .btn-gradient-secondary:hover { background: #5a6268 !important; }

    .btn-outline-purple {
        background: transparent;
        border: 2px solid #9a55ff !important;
        color: #9a55ff;
        padding: 0.35rem 0.9rem;
        font-size: 0.8rem;
        border-radius: 20px;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
    }
    .btn-outline-purple:hover {
        background: #9a55ff;
        color: #ffffff;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(154, 85, 255, 0.3);
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
    @media (min-width: 768px) { .badge { padding: 0.45rem 0.8rem; font-size: 0.85rem; } }

    .table-responsive {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
        border-radius: 8px;
        margin-bottom: 0.5rem;
        scrollbar-width: thin;
        scrollbar-color: #9a55ff #f0f0f0;
    }
    .table-responsive::-webkit-scrollbar { height: 8px; }
    .table-responsive::-webkit-scrollbar-track { background: #f0f0f0; border-radius: 10px; }
    .table-responsive::-webkit-scrollbar-thumb { background: #9a55ff; border-radius: 10px; }
    .table-responsive::-webkit-scrollbar-thumb:hover { background: #7b3fcc; }

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
    }
    @media (min-width: 576px) { .table tbody td { font-size: 0.9rem; padding: 0.9rem 0.6rem; } }
    @media (min-width: 768px) { .table tbody td { font-size: 0.95rem; padding: 1rem 0.75rem; } }
    .table tbody tr:hover { background-color: #f8f9fa; }

    .text-primary { color: #9a55ff !important; }
    .text-muted { color: #a5b3cb !important; }
    .fw-bold { font-weight: 600 !important; }

    h3.text-dark {
        font-size: 1.3rem !important;
        font-weight: 700;
        color: #2c2e3f !important;
        margin-bottom: 0.5rem !important;
    }
    @media (min-width: 576px) { h3.text-dark { font-size: 1.5rem !important; } }
    @media (min-width: 768px) { h3.text-dark { font-size: 1.7rem !important; } }

    .mdi { vertical-align: middle; }

    /* Timeline Detail Card - from dashboard */
    .timeline-detail-card {
        background: linear-gradient(135deg, #faf7ff, #f4efff);
        border: 1px solid #eadcff;
        border-radius: 14px;
        padding: 1rem;
        margin-bottom: 1rem;
    }

    .timeline-detail-title {
        font-size: 0.95rem;
        font-weight: 700;
        color: #9a55ff;
        margin-bottom: 0.85rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .timeline-detail-item {
        background: #ffffff;
        border: 1px solid #efe6ff;
        border-radius: 10px;
        padding: 0.75rem 0.85rem;
        height: 100%;
        transition: all 0.3s ease;
    }

    .timeline-detail-item:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(154, 85, 255, 0.1);
        border-color: #9a55ff;
    }

    .timeline-detail-label {
        font-size: 0.75rem;
        color: #8b8fa3;
        margin-bottom: 0.2rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 0.35rem;
    }

    .timeline-detail-value {
        font-size: 0.92rem;
        color: #2c2e3f;
        font-weight: 700;
    }

    /* Status badge gradient */
    .status-badge-gradient {
        padding: 0.3rem 0.8rem;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.85rem;
        display: inline-block;
    }
    .status-badge-gradient.success { background: linear-gradient(135deg, #28a745, #5cb85c); color: #fff; }
    .status-badge-gradient.warning { background: linear-gradient(135deg, #ffc107, #ffdb6d); color: #2c2e3f; }
    .status-badge-gradient.secondary { background: linear-gradient(135deg, #6c757d, #8f9baf); color: #fff; }

    /* Prospek badge */
    .badge-hot { background: linear-gradient(135deg, #dc3545, #e4606d); color: #fff; }
    .badge-medium { background: linear-gradient(135deg, #ffc107, #ffdb6d); color: #2c2e3f; }
    .badge-cold { background: linear-gradient(135deg, #6c757d, #8f9baf); color: #fff; }
    .badge-converted { background: linear-gradient(135deg, #28a745, #6fdf8c); color: #fff; }
    .badge-failed { background: linear-gradient(135deg, #343a40, #6c757d); color: #fff; }

    /* Alert */
    .alert {
        border-radius: 12px;
        border: none;
        animation: slideDown 0.3s ease;
    }
    @keyframes slideDown {
        from { opacity: 0; transform: translateY(-20px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>

<div class="container-fluid p-2 p-sm-3 p-md-4">

    <!-- Header -->
    <div class="row mb-3 mb-sm-3 mb-md-4">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="text-dark mb-1">
                            <i class="mdi mdi-chart-timeline-variant me-2" style="color: #9a55ff;"></i>Detail Progress Tugas
                        </h3>
                        <p class="text-muted mb-0">
                            Lihat progres dan daftar prospek dari tugas staff marketing
                        </p>
                    </div>
                    <div class="d-none d-sm-block">
                        <i class="mdi mdi-chart-timeline-variant" style="font-size: 2.5rem; color: #9a55ff; opacity: 0.2;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Back Button -->
    <div class="mb-3">
        <a href="{{ route('master.data.tugas-staff-marketing') }}" class="btn btn-gradient-secondary btn-sm">
            <i class="mdi mdi-arrow-left me-1"></i> Kembali ke Daftar Tugas
        </a>
    </div>

    <!-- Detail Task Card - Timeline style from dashboard -->
    <div class="timeline-detail-card">
        <div class="timeline-detail-title">
            <i class="mdi mdi-clipboard-list-outline me-1"></i>Informasi Tugas
        </div>
        <div class="row g-3">
            <div class="col-md-6">
                <div class="timeline-detail-item">
                    <div class="timeline-detail-label"><i class="mdi mdi-clipboard-list"></i>Nama Tugas</div>
                    <div class="timeline-detail-value">{{ $task->nama_tugas }}</div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="timeline-detail-item">
                    <div class="timeline-detail-label"><i class="mdi mdi-account"></i>Ditugaskan Kepada</div>
                    <div class="timeline-detail-value">{{ $task->employee->name ?? 'Tidak ada staff' }}</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="timeline-detail-item">
                    <div class="timeline-detail-label"><i class="mdi mdi-calendar-clock"></i>Tenggat Waktu</div>
                    <div class="timeline-detail-value">{{ \Carbon\Carbon::parse($task->deadline)->format('d M Y') }}</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="timeline-detail-item">
                    <div class="timeline-detail-label"><i class="mdi mdi-flag"></i>Status Tugas</div>
                    <div class="timeline-detail-value">
                        @if ($task->status == 'Selesai')
                            <span class="status-badge-gradient success"><i class="mdi mdi-check-circle"></i> Selesai</span>
                        @elseif($task->status == 'Proses')
                            <span class="status-badge-gradient warning"><i class="mdi mdi-clock"></i> Proses</span>
                        @else
                            <span class="status-badge-gradient secondary"><i class="mdi mdi-timer-sand"></i> Pending</span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="timeline-detail-item">
                    <div class="timeline-detail-label"><i class="mdi mdi-account-group"></i>Total Prospek</div>
                    <div class="timeline-detail-value">{{ $task->guest->count() }} Orang</div>
                </div>
            </div>
            <div class="col-12">
                <div class="timeline-detail-item">
                    <div class="timeline-detail-label"><i class="mdi mdi-text-box-outline"></i>Deskripsi</div>
                    <div class="timeline-detail-value">{{ $task->deskripsi ?? '-' }}</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Prospek Table -->
    <div class="row mt-2 mt-sm-2 mt-md-3">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">
                        <i class="mdi mdi-account-multiple-outline me-2"></i>Daftar Prospek (Guests) dari Tugas Ini
                    </h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th>Nama Prospek</th>
                                    <th>No. HP</th>
                                    <th>Sumber</th>
                                    <th>Status Prospek</th>
                                    <th>Catatan Terakhir</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($task->guest as $index => $guest)
                                    <tr>
                                        <td class="text-center fw-bold">{{ $index + 1 }}</td>
                                        <td>
                                            <i class="mdi mdi-account text-primary me-2"></i>
                                            <span class="fw-bold">{{ $guest->name }}</span>
                                        </td>
                                        <td>
                                            <i class="mdi mdi-phone text-primary me-2"></i>
                                            {{ $guest->phone ?? '-' }}
                                        </td>
                                        <td>
                                            <i class="mdi mdi-source-branch text-primary me-2"></i>
                                            {{ $guest->source ?? '-' }}
                                        </td>
                                        <td>
                                            @if ($guest->status == 'hot_prospect')
                                                <span class="badge badge-hot"><i class="mdi mdi-fire me-1"></i>Hot Prospek</span>
                                            @elseif ($guest->status == 'medium_prospect')
                                                <span class="badge badge-medium"><i class="mdi mdi-chart-line me-1"></i>Medium Prospek</span>
                                            @elseif ($guest->status == 'cold_prospect')
                                                <span class="badge badge-cold"><i class="mdi mdi-snowflake me-1"></i>Cold Prospek</span>
                                            @elseif ($guest->status == 'converted')
                                                <span class="badge badge-converted"><i class="mdi mdi-check-circle me-1"></i>Deal / Closing</span>
                                            @else
                                                <span class="badge badge-failed"><i class="mdi mdi-close-circle me-1"></i>Gagal / Batal</span>
                                            @endif
                                        </td>
                                        <td style="white-space: normal; min-width: 150px;">
                                            {{ Str::limit($guest->notes, 40) ?? '-' }}
                                        </td>
                                        <td class="text-center">
                                            <button class="btn btn-outline-purple btn-sm" data-bs-toggle="modal" data-bs-target="#detailGuestModal{{ $guest->id }}">
                                                <i class="mdi mdi-eye"></i> Lihat
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center text-muted py-4">
                                            <i class="mdi mdi-inbox-outline" style="font-size: 3rem;"></i>
                                            <p class="mt-2 mb-0">Belum ada prospek/tamu yang didapatkan dari tugas ini.</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Modal Detail Guest -->
@foreach ($task->guest as $guest)
<div class="modal fade modal-detail-unit" id="detailGuestModal{{ $guest->id }}" tabindex="-1" aria-labelledby="detailGuestModalLabel{{ $guest->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="mdi mdi-account-details me-2"></i>Detail Prospek
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="timeline-detail-card">
                    <div class="timeline-detail-title">
                        <i class="mdi mdi-account-outline me-1"></i>Informasi Prospek
                    </div>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="timeline-detail-item">
                                <div class="timeline-detail-label"><i class="mdi mdi-account"></i>Nama Prospek</div>
                                <div class="timeline-detail-value">{{ $guest->name }}</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="timeline-detail-item">
                                <div class="timeline-detail-label"><i class="mdi mdi-phone"></i>No. HP</div>
                                <div class="timeline-detail-value">{{ $guest->phone ?? '-' }}</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="timeline-detail-item">
                                <div class="timeline-detail-label"><i class="mdi mdi-source-branch"></i>Sumber</div>
                                <div class="timeline-detail-value">{{ $guest->source ?? '-' }}</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="timeline-detail-item">
                                <div class="timeline-detail-label"><i class="mdi mdi-flag"></i>Status Prospek</div>
                                <div class="timeline-detail-value">
                                    @if ($guest->status == 'hot_prospect')
                                        <span class="badge badge-hot"><i class="mdi mdi-fire me-1"></i>Hot Prospek</span>
                                    @elseif ($guest->status == 'medium_prospect')
                                        <span class="badge badge-medium"><i class="mdi mdi-chart-line me-1"></i>Medium Prospek</span>
                                    @elseif ($guest->status == 'cold_prospect')
                                        <span class="badge badge-cold"><i class="mdi mdi-snowflake me-1"></i>Cold Prospek</span>
                                    @elseif ($guest->status == 'converted')
                                        <span class="badge badge-converted"><i class="mdi mdi-check-circle me-1"></i>Deal / Closing</span>
                                    @else
                                        <span class="badge badge-failed"><i class="mdi mdi-close-circle me-1"></i>Gagal / Batal</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="timeline-detail-item">
                                <div class="timeline-detail-label"><i class="mdi mdi-text-box-outline"></i>Catatan</div>
                                <div class="timeline-detail-value">{{ $guest->notes ?? '-' }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-gradient-secondary" data-bs-dismiss="modal">
                    <i class="mdi mdi-close me-1"></i>Tutup
                </button>
            </div>
        </div>
    </div>
</div>
@endforeach

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Auto close alert after 3 seconds
        setTimeout(function() {
            document.querySelectorAll('.alert').forEach(function(alert) {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            });
        }, 3000);
    });
</script>
@endpush
