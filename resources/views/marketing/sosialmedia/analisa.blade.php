@extends('layouts.partial.app')

@section('title', 'Analisa & Pantauan Tim - Sosial Media - Property Management')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/dashboard-clean.css') }}?v={{ time() }}">
<meta name="referrer" content="no-referrer">
<style>
    /* 100% Solid Flat Colors - Sesuai Catalog Unit (Tanpa Gradient) */
    .compact-table-card {
        background: #ffffff !important;
        border: 1px solid #e2e8f0 !important;
        border-radius: 8px !important;
        box-shadow: none !important;
        overflow: hidden;
    }

    /* Table Clean (Persis Catalog Unit & Table Lahan) */
    .table-clean {
        width: 100% !important;
        margin-bottom: 0;
    }

    .table-clean thead th {
        background: #f8fafc !important;
        color: #4b5563 !important;
        font-weight: 700;
        font-size: 0.76rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border-bottom: 2px solid #e2e8f0 !important;
        padding: 0.8rem 0.75rem !important;
        vertical-align: middle;
        white-space: nowrap;
    }

    .table-clean tbody td {
        padding: 0.8rem 0.75rem !important;
        vertical-align: middle;
        font-size: 0.84rem;
        border-bottom: 1px solid #f1f5f9;
        white-space: nowrap;
    }

    /* Tombol Aksi Persis Catalog Unit (jual_unit.blade.php) */
    .action-group {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.35rem;
    }

    .btn-action {
        width: 36px;
        height: 36px;
        padding: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 6px;
        transition: all 0.2s ease;
        border: none;
        cursor: pointer;
        text-decoration: none !important;
    }

    .btn-action i {
        font-size: 1.05rem;
        line-height: 1;
    }

    .btn-action.view {
        background: #9a55ff;
        color: #ffffff !important;
    }

    .btn-action.view:hover {
        background: #8b3df5;
        color: #ffffff !important;
        transform: translateY(-1px);
    }

    /* KPI Flat Solid Metrics Cards (Persis Catalog Unit) */
    .dash-kpi-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 1rem;
        margin-bottom: 1.5rem;
    }

    @media (max-width: 1100px) {
        .dash-kpi-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 600px) {
        .dash-kpi-grid {
            grid-template-columns: 1fr;
        }
    }

    /* Sync Dropdown Menu Styling */
    .dropdown-menu-sync {
        min-width: 290px;
        padding: 0.5rem;
        border-radius: 10px;
        border: 1px solid #e2e8f0;
        background-color: #ffffff;
        box-shadow: 0 10px 25px -5px rgba(15, 23, 42, 0.12), 0 8px 10px -6px rgba(15, 23, 42, 0.08);
        margin-top: 0.35rem !important;
    }

    .dropdown-sync-section-title {
        font-size: 0.68rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.6px;
        color: #94a3b8;
        padding: 0.4rem 0.65rem 0.25rem;
    }

    .dropdown-sync-item {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.55rem 0.65rem;
        border-radius: 8px;
        color: #1e293b;
        text-decoration: none;
        transition: all 0.15s ease;
    }

    .dropdown-sync-item:hover {
        background-color: #f8fafc;
        color: #0284c7;
    }

    .dropdown-sync-item-icon {
        width: 32px;
        height: 32px;
        border-radius: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.1rem;
        flex-shrink: 0;
        transition: all 0.15s ease;
    }

    .dropdown-sync-item.primary .dropdown-sync-item-icon {
        background-color: #e0f2fe;
        color: #0284c7;
    }

    .dropdown-sync-item:hover.primary .dropdown-sync-item-icon {
        background-color: #0284c7;
        color: #ffffff;
    }

    .dropdown-sync-item.staff .dropdown-sync-item-icon {
        background-color: #f1f5f9;
        color: #64748b;
        font-size: 1rem;
    }

    .dropdown-sync-item:hover.staff .dropdown-sync-item-icon {
        background-color: #e2e8f0;
        color: #0f172a;
    }

    .dropdown-sync-item-text {
        flex-grow: 1;
        line-height: 1.25;
    }

    .dropdown-sync-item-title {
        font-size: 0.83rem;
        font-weight: 600;
        color: #1e293b;
    }

    .dropdown-sync-item:hover .dropdown-sync-item-title {
        color: #0284c7;
    }

    .dropdown-sync-item-sub {
        font-size: 0.7rem;
        color: #94a3b8;
        margin-top: 2px;
    }

    .dropdown-sync-divider {
        height: 1px;
        background-color: #f1f5f9;
        margin: 0.4rem 0.3rem;
    }

    .dash-kpi-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        padding: 1.15rem 1.25rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
        transition: transform 0.15s ease, border-color 0.15s ease;
    }

    .dash-kpi-card:hover {
        transform: translateY(-2px);
        border-color: #cbd5e1;
    }

    .dash-kpi-left {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .dash-kpi-icon {
        width: 44px;
        height: 44px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.35rem;
        flex-shrink: 0;
    }

    .dash-kpi-info {
        display: flex;
        flex-direction: column;
    }

    .dash-kpi-label {
        font-size: 0.76rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #64748b;
        margin-bottom: 0.2rem;
    }

    .dash-kpi-val {
        font-size: 1.55rem;
        font-weight: 800;
        color: #0f172a;
        line-height: 1.15;
    }

    .dash-kpi-sub {
        font-size: 0.74rem;
        color: #94a3b8;
        margin-top: 0.2rem;
    }
</style>
@endpush

@section('content')
<div class="container-fluid px-3 px-md-4 py-4">

    <!-- Header Bersih Solid (Catalog Unit Pattern) -->
    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 mb-4">
        <div>
            <h3 class="fw-bold text-dark mb-1" style="letter-spacing: -0.02em;">Analisis & Pantauan Tim Sosial Media</h3>
            <p class="text-muted mb-0" style="font-size: 0.88rem;">
                Grafik tren perkembangan tayangan video promosi dan pantauan kinerja setoran seluruh tim marketing.
            </p>
        </div>
        <div class="d-flex flex-wrap align-items-center gap-2">
            <!-- Dropdown Pilihan Sinkronisasi (Sync dari Atas / Filter) -->
            <div class="dropdown">
                <button class="btn text-white px-3 py-2 fw-semibold d-inline-flex align-items-center gap-2 shadow-sm dropdown-toggle" type="button" id="dropdownSyncMenu" data-bs-toggle="dropdown" aria-expanded="false" style="border-radius: 6px; background-color: #0284c7; border: 1px solid #0284c7; font-size: 0.85rem;">
                    <i class="mdi mdi-sync fs-6"></i>
                    <span>Sinkronkan Metrik</span>
                </button>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-sync" aria-labelledby="dropdownSyncMenu">
                    <div class="dropdown-sync-section-title">Cakupan Sinkronisasi</div>
                    
                    <a class="dropdown-sync-item primary" href="javascript:void(0)" onclick="syncAllTasks()">
                        <div class="dropdown-sync-item-icon">
                            <i class="mdi mdi-sync"></i>
                        </div>
                        <div class="dropdown-sync-item-text">
                            <div class="dropdown-sync-item-title">Langsung Semua Video Tim</div>
                            <div class="dropdown-sync-item-sub">Perbarui seluruh metrik tayangan</div>
                        </div>
                    </a>

                    @if($marketingStaffList->isNotEmpty())
                    <div class="dropdown-sync-divider"></div>
                    <div class="dropdown-sync-section-title">Filter Berdasarkan Staff</div>

                    @foreach($marketingStaffList as $stf)
                    <a class="dropdown-sync-item staff" href="javascript:void(0)" onclick="syncAllTasks({{ $stf->id }}, '{{ addslashes($stf->name) }}')">
                        <div class="dropdown-sync-item-icon">
                            <i class="mdi mdi-account-circle-outline"></i>
                        </div>
                        <div class="dropdown-sync-item-text">
                            <div class="dropdown-sync-item-title">{{ $stf->name }}</div>
                            <div class="dropdown-sync-item-sub">{{ $stf->position->name ?? 'Staff Marketing' }}</div>
                        </div>
                    </a>
                    @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- KPI Metric Cards (Solid Flat - Catalog Unit Style) -->
    <div class="dash-kpi-grid">
        <!-- Card 1: Video Disetor -->
        <div class="dash-kpi-card">
            <div class="dash-kpi-left">
                <div class="dash-kpi-icon" style="background-color: #ecfdf5; color: #059669;">
                    <i class="mdi mdi-checkbox-marked-circle-outline"></i>
                </div>
                <div class="dash-kpi-info">
                    <div class="dash-kpi-label">Video Disetor</div>
                    <div class="dash-kpi-val">{{ $totalCompletedCount }}</div>
                    <div class="dash-kpi-sub">Total Video Dipublikasi</div>
                </div>
            </div>
        </div>

        <!-- Card 2: Total Tayangan (Views) -->
        <div class="dash-kpi-card">
            <div class="dash-kpi-left">
                <div class="dash-kpi-icon" style="background-color: #f0f9ff; color: #0284c7;">
                    <i class="mdi mdi-eye-outline"></i>
                </div>
                <div class="dash-kpi-info">
                    <div class="dash-kpi-label">Total Tayangan</div>
                    <div class="dash-kpi-val">{{ number_format($totalViews, 0, ',', '.') }}</div>
                    <div class="dash-kpi-sub">Akumulasi Views Video</div>
                </div>
            </div>
        </div>

        <!-- Card 3: Total Suka (Likes) -->
        <div class="dash-kpi-card">
            <div class="dash-kpi-left">
                <div class="dash-kpi-icon" style="background-color: #fef2f2; color: #ef4444;">
                    <i class="mdi mdi-heart-outline"></i>
                </div>
                <div class="dash-kpi-info">
                    <div class="dash-kpi-label">Total Suka (Likes)</div>
                    <div class="dash-kpi-val">{{ number_format($totalLikes, 0, ',', '.') }}</div>
                    <div class="dash-kpi-sub">Interaksi Tayangan</div>
                </div>
            </div>
        </div>

        <!-- Card 4: Rata-rata Views -->
        <div class="dash-kpi-card">
            <div class="dash-kpi-left">
                <div class="dash-kpi-icon" style="background-color: #f3e8ff; color: #9333ea;">
                    <i class="mdi mdi-chart-areaspline"></i>
                </div>
                <div class="dash-kpi-info">
                    <div class="dash-kpi-label">Rata-rata Views</div>
                    <div class="dash-kpi-val">{{ number_format($totalCompletedCount > 0 ? round($totalViews / $totalCompletedCount) : 0, 0, ',', '.') }}</div>
                    <div class="dash-kpi-sub">Per Konten Video</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Card 1: Grafik Pertumbuhan Tayangan Video Promosi -->
    <div class="card compact-table-card shadow-sm border-0 mb-4">
        <div class="card-header bg-white border-bottom p-3 px-md-4">
            <div class="d-flex align-items-center gap-2">
                <div style="width: 32px; height: 32px; border-radius: 6px; background-color: #f0fdf4; color: #16a34a; display: inline-flex; align-items: center; justify-content: center; font-size: 1.15rem; flex-shrink: 0;">
                    <i class="mdi mdi-trending-up"></i>
                </div>
                <div>
                    <h5 class="fw-bold text-dark mb-0" style="font-size: 0.95rem;">
                        Pertumbuhan Tayangan Video Promosi (7 Hari Terakhir)
                    </h5>
                    <small class="text-muted" style="font-size: 0.8rem;">
                        Akumulasi views dan likes video promosi yang telah disetorkan oleh tim marketing.
                    </small>
                </div>
            </div>
        </div>
        <div class="card-body p-4">
            <div style="position: relative; height: 340px; width: 100%;">
                <canvas id="trendChartCanvas"></canvas>
            </div>

            <div class="d-flex flex-wrap align-items-center justify-content-between mt-3 pt-3 border-top gap-2">
                <small class="text-muted" style="font-size: 0.78rem;">
                    <i class="mdi mdi-information-outline me-1"></i> Data grafik dihitung secara dinamis dari setoran video promosi aktif.
                </small>
                <span class="badge bg-light text-secondary border px-2 py-1" style="font-size: 0.75rem;">
                    Total: {{ number_format($totalViews, 0, ',', '.') }} Views &bull; {{ number_format($totalLikes, 0, ',', '.') }} Likes
                </span>
            </div>
        </div>
    </div>

    <!-- Card 2: Pantauan Seluruh Tim (Mode Admin / Leader) -->
    <div class="card compact-table-card shadow-sm border-0 mb-4">
        <div class="card-header bg-white border-bottom p-3 px-md-4 d-flex flex-wrap align-items-center justify-content-between gap-2">
            <div class="d-flex align-items-center gap-2">
                <div style="width: 32px; height: 32px; border-radius: 6px; background-color: #f3e8ff; color: #9333ea; display: inline-flex; align-items: center; justify-content: center; font-size: 1.15rem; flex-shrink: 0;">
                    <i class="mdi mdi-account-group-outline"></i>
                </div>
                <div>
                    <span style="font-size: 0.95rem; font-weight: 700; color: #0f172a;">Pantauan Kinerja Seluruh Tim Marketing</span>
                    <span class="badge bg-light text-secondary border ms-2" style="font-size: 0.75rem;">{{ $allStaffTasks->count() }} Tugas Diberikan</span>
                </div>
            </div>

        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle table-clean mb-0">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 45px;">No</th>
                            <th>Nama Staff Marketing</th>
                            <th>Nama Tugas Promosi</th>
                            <th>Batas Waktu</th>
                            <th class="text-center">Status Setoran</th>
                            <th>Link Video Disetor</th>
                            <th class="text-center" style="width: 140px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($allStaffTasks as $index => $st)
                        <tr>
                            <td class="text-center fw-bold">{{ $index + 1 }}</td>
                            <td>
                                <span class="fw-semibold text-dark" style="font-size: 0.85rem;">{{ $st->employee->name ?? 'Staff Marketing' }}</span>
                            </td>
                            <td>
                                <a href="{{ route('marketing.sosialmedia.task.show', $st->id) }}" class="fw-bold text-dark text-decoration-none">
                                    {{ $st->nama_tugas }}
                                </a>
                            </td>
                            <td>
                                @if($st->deadline)
                                <div class="fw-semibold text-danger" style="font-size: 0.8rem;">
                                    {{ \Carbon\Carbon::parse($st->deadline)->format('d M Y') }}
                                </div>
                                @else
                                <span class="text-muted small">-</span>
                                @endif
                            </td>
                            <td class="text-center">
                                @if($st->status === 'Selesai' || (!empty($st->link_postingan)))
                                <span class="badge py-1 px-2 fw-semibold" style="font-size: 0.72rem; border-radius: 6px; background-color: #ecfdf5; color: #059669; border: 1px solid #a7f3d0;">
                                    <i class="mdi mdi-check-circle me-1"></i>Sudah Setor
                                </span>
                                @else
                                <span class="badge py-1 px-2 fw-semibold" style="font-size: 0.72rem; border-radius: 6px; background-color: #fffbeb; color: #b45309; border: 1px solid #fde68a;">
                                    <i class="mdi mdi-clock-outline me-1"></i>Belum Setor
                                </span>
                                @endif
                            </td>
                            <td>
                                @if(!empty($st->link_postingan))
                                <a href="{{ $st->link_postingan }}" target="_blank" class="text-primary text-decoration-none small fw-semibold d-inline-flex align-items-center gap-1">
                                    <span>{{ Str::limit($st->link_postingan, 32) }}</span>
                                    <i class="mdi mdi-open-in-new" style="font-size: 11px;"></i>
                                </a>
                                @else
                                <span class="text-muted small italic">Belum ada link disetor</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="action-group">
                                    <a href="{{ route('marketing.sosialmedia.task.show', $st->id) }}" class="btn-action view" title="Detail Tugas">
                                        <i class="mdi mdi-eye"></i>
                                    </a>
                                    @if(!empty($st->link_postingan))
                                    <button type="button" class="btn-action" style="background: #0284c7; color: #ffffff;" onclick="syncSingleTask({{ $st->id }}, '{{ addslashes($st->nama_tugas) }}')" title="Sinkronkan Video Ini">
                                        <i class="mdi mdi-sync"></i>
                                    </button>
                                    @endif
                                    <form action="{{ route('marketing.sosialmedia.task.destroy', $st->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus tugas ini?')" class="d-inline m-0 p-0">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-action" style="background: #ef4444; color: #ffffff;" title="Hapus Tugas">
                                            <i class="mdi mdi-trash-can-outline"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">
                                Belum ada penugasan promosi yang dibuat untuk tim marketing.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
<script>
    // Inisialisasi Grafik Chart.js (Flat Solid)
    document.addEventListener('DOMContentLoaded', function() {
        const canvasEl = document.getElementById('trendChartCanvas');
        if (canvasEl) {
            const ctx = canvasEl.getContext('2d');
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['26 Sep', '27 Sep', '28 Sep', '29 Sep', '30 Sep', '01 Okt', '02 Okt'],
                    datasets: [
                        {
                            label: 'Tayangan (Views)',
                            data: {!! json_encode($chartViews) !!},
                            borderColor: '#0284c7',
                            backgroundColor: 'rgba(2, 132, 199, 0.08)',
                            borderWidth: 2.5,
                            pointBackgroundColor: '#0284c7',
                            pointBorderColor: '#ffffff',
                            pointBorderWidth: 2,
                            pointRadius: 4,
                            pointHoverRadius: 6,
                            tension: 0.35,
                            fill: true,
                        },
                        {
                            label: 'Suka (Likes)',
                            data: {!! json_encode($chartLikes) !!},
                            borderColor: '#ef4444',
                            backgroundColor: 'rgba(239, 68, 68, 0.05)',
                            borderWidth: 2.5,
                            pointBackgroundColor: '#ef4444',
                            pointBorderColor: '#ffffff',
                            pointBorderWidth: 2,
                            pointRadius: 4,
                            pointHoverRadius: 6,
                            tension: 0.35,
                            fill: true,
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'top',
                            labels: {
                                font: { family: "'Inter', sans-serif", weight: '600', size: 12 },
                                usePointStyle: true,
                                pointStyle: 'circle'
                            }
                        },
                        tooltip: {
                            backgroundColor: '#0f172a',
                            titleFont: { size: 13, weight: 'bold' },
                            bodyFont: { size: 12 },
                            padding: 10,
                            cornerRadius: 6
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: '#f1f5f9'
                            },
                            ticks: {
                                font: { family: "'Inter', sans-serif", size: 11 },
                                callback: function(value) {
                                    return value >= 1000 ? (value / 1000) + 'k' : value;
                                }
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            },
                            ticks: {
                                font: { family: "'Inter', sans-serif", size: 11 }
                            }
                        }
                    }
                }
            });
        }
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function syncAllTasks(staffId = null, staffName = null) {
        let confirmText = staffName ? `Sinkronkan metrik video untuk staf ${staffName}?` : 'Sinkronkan data tayangan seluruh video promosi yang telah disetor?';
        
        Swal.fire({
            title: 'Sinkronkan Metrik Video?',
            text: confirmText,
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Ya, Sinkronkan',
            cancelButtonText: 'Batal',
            confirmButtonColor: '#0284c7',
            cancelButtonColor: '#64748b'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Menyinkronkan...',
                    text: 'Sedang memperbarui metrik video promosi secara berkala',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                let url = "{{ route('marketing.sosialmedia.syncAll') }}";
                let formData = new FormData();
                if (staffId) {
                    formData.append('employee_id', staffId);
                }

                fetch(url, {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: formData
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Sinkronisasi Selesai!',
                            text: data.message,
                            timer: 1600,
                            showConfirmButton: false
                        }).then(() => {
                            window.location.reload();
                        });
                    } else {
                        Swal.fire('Gagal', data.message || 'Terjadi kesalahan.', 'error');
                    }
                })
                .catch(err => {
                    console.error(err);
                    Swal.fire('Error', 'Gagal menghubungi server.', 'error');
                });
            }
        });
    }

    function syncSingleTask(taskId, taskName) {
        Swal.fire({
            title: 'Sinkronkan Video Ini?',
            text: `Perbarui metrik tayangan untuk tugas "${taskName}"?`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Ya, Sinkronkan',
            cancelButtonText: 'Batal',
            confirmButtonColor: '#0284c7',
            cancelButtonColor: '#64748b'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Menyinkronkan...',
                    text: 'Sedang memproses tautan video',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                let url = "{{ url('/marketing/sosial-media/task') }}/" + taskId + "/sync";
                fetch(url, {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Tersinkronisasi!',
                            text: data.message,
                            timer: 1500,
                            showConfirmButton: false
                        }).then(() => {
                            window.location.reload();
                        });
                    } else {
                        Swal.fire('Gagal', data.message || 'Terjadi kesalahan.', 'error');
                    }
                })
                .catch(err => {
                    console.error(err);
                    Swal.fire('Error', 'Gagal menghubungi server.', 'error');
                });
            }
        });
    }
</script>
@endpush
