@extends('layouts.partial.app')

@section('title', 'Detail Progress Tugas Marketing')

@section('content')

<style>
    .card {
        border-radius: 12px !important;
        border: none !important;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
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

    .info-card-item {
        background: #ffffff;
        border: 1px solid #edf2f9;
        border-radius: 10px;
        padding: 0.85rem 1rem;
        height: 100%;
        transition: all 0.2s ease;
    }

    .info-card-item:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(154, 85, 255, 0.08);
        border-color: #e2d4fd;
    }

    .info-card-label {
        font-size: 0.76rem;
        color: #8b8fa3;
        margin-bottom: 0.3rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.4px;
        display: flex;
        align-items: center;
        gap: 0.35rem;
    }

    .info-card-label i {
        color: #9a55ff;
        font-size: 0.95rem;
    }

    .info-card-value {
        font-size: 0.95rem;
        color: #2c2e3f;
        font-weight: 700;
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

    .badge-status.hot_prospect {
        background: #fee2e2;
        color: #b91c1c;
        border: 1px solid #fecaca;
    }

    .badge-status.medium_prospect {
        background: #fef3c7;
        color: #b45309;
        border: 1px solid #fde68a;
    }

    .badge-status.cold_prospect {
        background: #e0f2fe;
        color: #0284c7;
        border: 1px solid #bae6fd;
    }

    .badge-status.converted {
        background: #dcfce7;
        color: #15803d;
        border: 1px solid #bbf7d0;
    }

    .badge-status.lost {
        background: #f1f5f9;
        color: #64748b;
        border: 1px solid #e2e8f0;
    }

    .guest-avatar {
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

    .btn-action.info {
        background: linear-gradient(135deg, #06b6d4, #0ea5e9);
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

    .modal-footer {
        background: #fafbfe;
        border-top: 1px solid #edf2f9;
        padding: 1rem 1.5rem;
    }
</style>

<div class="container-fluid p-2 p-sm-3 p-md-4">

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-3" role="alert" style="border-radius: 6px; background: #ecfdf5; color: #065f46;">
            <i class="mdi mdi-check-circle me-1"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Header Judul & Tombol Kembali -->
    <div class="row mb-3 mb-sm-3 mb-md-4">
        <div class="col-12">
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 px-1">
                <div>
                    <h3 class="text-dark mb-1 fw-bold">
                        <i class="mdi mdi-chart-timeline-variant me-2" style="color: #7c3aed;"></i>Detail Progress Tugas
                    </h3>
                    <p class="text-muted mb-0">Informasi detail target rencana, realisasi capaian, dan daftar prospek</p>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <button type="button" class="btn d-inline-flex align-items-center gap-1 shadow-sm"
                            style="background-color: #7c3aed; color: #ffffff; border: none; height: 38px; padding: 0.5rem 1rem; border-radius: 6px; font-weight: 600;"
                            data-bs-toggle="modal" data-bs-target="#updateProgressModal">
                        <i class="mdi mdi-pencil-box-outline"></i> Update Realisasi &amp; Status
                    </button>
                    <a href="{{ route('master.data.tugas-staff-marketing') }}" class="btn btn-gradient-secondary d-inline-flex align-items-center gap-1" style="height: 38px; padding: 0.5rem 1rem; border-radius: 6px;">
                        <i class="mdi mdi-arrow-left"></i> Kembali ke Daftar Tugas
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Card Informasi Tugas -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white p-3 border-bottom d-flex align-items-center justify-content-between">
                    <h5 class="card-title mb-0 fw-bold">
                        <i class="mdi mdi-clipboard-text-outline me-2 text-primary"></i>Informasi Penugasan &amp; Target Rencana
                    </h5>
                    @php
                        $persen = $task->persentase_capaian;
                        $badgeColor = $persen >= 100 ? '#10b981' : ($persen > 0 ? '#3b82f6' : '#64748b');
                    @endphp
                    <span class="badge" style="background: {{ $persen >= 100 ? '#d1fae5' : '#eff6ff' }}; color: {{ $badgeColor }}; font-weight: 700; font-size: 0.82rem; padding: 5px 12px; border-radius: 30px;">
                        Capaian: {{ $persen }}%
                    </span>
                </div>
                <div class="card-body p-3">
                    <div class="row g-3">
                        <div class="col-12 col-md-6">
                            <div class="info-card-item">
                                <div class="info-card-label"><i class="mdi mdi-clipboard-text-outline"></i>Nama Tugas</div>
                                <div class="info-card-value">{{ $task->nama_tugas }}</div>
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="info-card-item">
                                <div class="info-card-label"><i class="mdi mdi-account-tie"></i>Ditugaskan Kepada</div>
                                <div class="info-card-value">{{ $task->employee->name ?? 'Tidak ada staff' }}</div>
                            </div>
                        </div>

                        {{-- TARGET vs REALISASI CARDS --}}
                        <div class="col-12 col-md-4">
                            <div class="info-card-item" style="border-left: 3px solid #7c3aed;">
                                <div class="info-card-label"><i class="mdi mdi-bullseye-arrow" style="color: #7c3aed;"></i>Target Rencana</div>
                                <div class="info-card-value" style="color: #7c3aed;">
                                    {{ $task->target_jumlah ?? 1 }} <span style="font-size: 0.82rem; font-weight: normal; color: #64748b;">{{ $task->satuan_target ?: 'Item' }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-4">
                            <div class="info-card-item" style="border-left: 3px solid {{ $persen >= 100 ? '#10b981' : '#3b82f6' }};">
                                <div class="info-card-label"><i class="mdi mdi-check-decagram" style="color: {{ $persen >= 100 ? '#10b981' : '#3b82f6' }};"></i>Realisasi Tercapai</div>
                                <div class="info-card-value" style="color: {{ $persen >= 100 ? '#10b981' : '#3b82f6' }};">
                                    {{ $task->realisasi_aktual }} <span style="font-size: 0.82rem; font-weight: normal; color: #64748b;">{{ $task->satuan_target ?: 'Item' }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-4">
                            <div class="info-card-item">
                                <div class="info-card-label"><i class="mdi mdi-chart-line"></i>Progres Capaian</div>
                                <div class="mt-1">
                                    <div class="d-flex justify-content-between mb-1" style="font-size: 0.8rem; font-weight: 700;">
                                        <span>{{ $task->realisasi_aktual }} / {{ $task->target_jumlah ?? 1 }}</span>
                                        <span style="color: {{ $badgeColor }};">{{ $persen }}%</span>
                                    </div>
                                    <div class="progress" style="height: 7px; background: #e2e8f0; border-radius: 4px;">
                                        <div class="progress-bar" style="width: {{ $persen }}%; background-color: {{ $badgeColor }}; border-radius: 4px;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-4">
                            <div class="info-card-item">
                                <div class="info-card-label"><i class="mdi mdi-calendar-clock"></i>Tenggat Waktu (Deadline)</div>
                                <div class="info-card-value">{{ \Carbon\Carbon::parse($task->deadline)->format('d M Y') }}</div>
                            </div>
                        </div>

                        <div class="col-12 col-md-4">
                            <div class="info-card-item">
                                <div class="info-card-label"><i class="mdi mdi-flag-outline"></i>Status Tugas</div>
                                <div class="info-card-value">
                                    @php
                                        $tStatus = strtolower($task->status);
                                    @endphp
                                    <span class="badge-status {{ $tStatus }}">
                                        @if($task->status == 'Pending')
                                            <i class="mdi mdi-clock-outline"></i>
                                        @elseif($task->status == 'Proses')
                                            <i class="mdi mdi-progress-wrench"></i>
                                        @elseif($task->status == 'Selesai')
                                            <i class="mdi mdi-check-circle-outline"></i>
                                        @endif
                                        {{ $task->status }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-4">
                            <div class="info-card-item">
                                <div class="info-card-label"><i class="mdi mdi-account-group-outline"></i>Total Tamu / Prospek</div>
                                <div class="info-card-value">{{ $task->guest->count() }} Orang</div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="info-card-item">
                                <div class="info-card-label"><i class="mdi mdi-text-box-outline"></i>Deskripsi & Instruksi</div>
                                <div class="info-card-value" style="font-weight: 500; font-size: 0.9rem;">
                                    {{ $task->deskripsi ?: 'Tidak ada deskripsi tambahan.' }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel Daftar Tamu / Prospek dari Tugas Ini -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white d-flex justify-content-between align-items-center p-3 border-bottom">
                    <h5 class="card-title mb-0 fw-bold">
                        <i class="mdi mdi-account-multiple me-2 text-primary"></i>Daftar Prospek / Tamu dari Tugas Ini
                    </h5>
                    <span class="badge" style="background: #f4efff; color: #7e22ce; border: 1px solid #e9d5ff; font-weight: 700;">
                        Total: {{ $task->guest->count() }}
                    </span>
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead>
                                <tr>
                                    <th class="text-center" width="5%">No</th>
                                    <th>Nama Prospek</th>
                                    <th>No. HP</th>
                                    <th>Sumber Info</th>
                                    <th>Status Prospek</th>
                                    <th>Catatan Terakhir</th>
                                    <th class="text-center" width="10%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($task->guest as $index => $guest)
                                    @php
                                        $initials = collect(explode(' ', trim($guest->name)))
                                            ->filter()
                                            ->take(2)
                                            ->map(fn($w) => strtoupper(substr($w, 0, 1)))
                                            ->implode('');
                                    @endphp
                                    <tr>
                                        <td class="text-center fw-bold">{{ $index + 1 }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="guest-avatar">{{ $initials ?: 'TG' }}</div>
                                                <div class="fw-bold">{{ $guest->name }}</div>
                                            </div>
                                        </td>
                                        <td>
                                            <i class="mdi mdi-phone text-primary me-1"></i>{{ $guest->phone ?? '-' }}
                                        </td>
                                        <td>
                                            <i class="mdi mdi-bullhorn-outline text-primary me-1"></i>{{ $guest->source ?? '-' }}
                                        </td>
                                        <td>
                                            @php
                                                $statusKey = strtolower($guest->status ?? '');
                                            @endphp
                                            <span class="badge-status {{ $statusKey }}">
                                                @if ($guest->status == 'hot_prospect')
                                                    <i class="mdi mdi-fire"></i> Hot Prospek
                                                @elseif ($guest->status == 'medium_prospect')
                                                    <i class="mdi mdi-chart-line"></i> Medium Prospek
                                                @elseif ($guest->status == 'cold_prospect')
                                                    <i class="mdi mdi-snowflake"></i> Cold Prospek
                                                @elseif ($guest->status == 'converted')
                                                    <i class="mdi mdi-check-circle"></i> Deal / Closing
                                                @else
                                                    <i class="mdi mdi-close-circle"></i> Gagal / Batal
                                                @endif
                                            </span>
                                        </td>
                                        <td style="white-space: normal; min-width: 180px;">
                                            {{ Str::limit($guest->notes, 60) ?: '-' }}
                                        </td>
                                        <td class="text-center">
                                            <button class="btn-action info" title="Lihat Detail Prospek" data-bs-toggle="modal" data-bs-target="#detailGuestModal{{ $guest->id }}">
                                                <i class="mdi mdi-eye"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center text-muted py-5">
                                            <i class="mdi mdi-account-off-outline" style="font-size: 3rem; color: #9a55ff; opacity: 0.3;"></i>
                                            <p class="mt-2 mb-0 fw-bold">Belum ada data prospek/tamu yang didapatkan dari tugas ini.</p>
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
<div class="modal fade" id="detailGuestModal{{ $guest->id }}" tabindex="-1" aria-labelledby="detailGuestModalLabel{{ $guest->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailGuestModalLabel{{ $guest->id }}">
                    <i class="mdi mdi-account-details me-2"></i>Detail Prospek / Tamu
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row g-3">
                    <div class="col-12 col-md-6">
                        <div class="info-card-item">
                            <div class="info-card-label"><i class="mdi mdi-account"></i>Nama Prospek</div>
                            <div class="info-card-value">{{ $guest->name }}</div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="info-card-item">
                            <div class="info-card-label"><i class="mdi mdi-phone"></i>No. HP</div>
                            <div class="info-card-value">{{ $guest->phone ?? '-' }}</div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="info-card-item">
                            <div class="info-card-label"><i class="mdi mdi-email-outline"></i>Email</div>
                            <div class="info-card-value">{{ $guest->email ?? '-' }}</div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="info-card-item">
                            <div class="info-card-label"><i class="mdi mdi-bullhorn-outline"></i>Sumber Informasi</div>
                            <div class="info-card-value">{{ $guest->source ?? '-' }}</div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="info-card-item">
                            <div class="info-card-label"><i class="mdi mdi-flag"></i>Status Prospek</div>
                            <div class="info-card-value mt-1">
                                @php
                                    $mStatus = strtolower($guest->status ?? '');
                                @endphp
                                <span class="badge-status {{ $mStatus }}">
                                    @if ($guest->status == 'hot_prospect')
                                        <i class="mdi mdi-fire"></i> Hot Prospek
                                    @elseif ($guest->status == 'medium_prospect')
                                        <i class="mdi mdi-chart-line"></i> Medium Prospek
                                    @elseif ($guest->status == 'cold_prospect')
                                        <i class="mdi mdi-snowflake"></i> Cold Prospek
                                    @elseif ($guest->status == 'converted')
                                        <i class="mdi mdi-check-circle"></i> Deal / Closing
                                    @else
                                        <i class="mdi mdi-close-circle"></i> Gagal / Batal
                                    @endif
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="info-card-item">
                            <div class="info-card-label"><i class="mdi mdi-text-box-outline"></i>Catatan</div>
                            <div class="info-card-value" style="font-weight: 500; font-size: 0.9rem;">
                                {{ $guest->notes ?? '-' }}
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

<!-- Modal Update Realisasi & Status Progres -->
<div class="modal fade" id="updateProgressModal" tabindex="-1" aria-labelledby="updateProgressModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 12px; overflow: hidden; border: none;">
            <div class="modal-header" style="background-color: #7c3aed !important; background-image: none !important; color: #ffffff !important; padding: 1rem 1.25rem;">
                <h5 class="modal-title fw-bold" id="updateProgressModalLabel" style="color: #ffffff !important; font-size: 1.05rem;">
                    <i class="mdi mdi-chart-line-variant me-2"></i>Update Realisasi &amp; Status Tugas
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="filter: brightness(0) invert(1);"></button>
            </div>
            <form action="{{ route('marketing.tugas.update-progress', $task->id) }}" method="POST">
                @csrf
                <div class="modal-body p-3 p-md-4">
                    <div class="alert alert-light border mb-3 p-2" style="font-size: 0.82rem; border-radius: 6px;">
                        <div class="text-muted">Target Rencana:</div>
                        <div class="fw-bold text-dark fs-6">{{ $task->target_jumlah ?? 1 }} {{ $task->satuan_target ?: 'Item' }}</div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold text-dark" style="font-size: 0.83rem;">
                            Realisasi Capaian Saat Ini (Angka) <span class="text-danger">*</span>
                        </label>
                        <div class="input-group">
                            <input type="number" name="realisasi_jumlah" class="form-control"
                                   value="{{ old('realisasi_jumlah', $task->realisasi_aktual) }}" min="0" required
                                   style="border: 1px solid #cbd5e1; border-radius: 5px 0 0 5px; height: 42px;">
                            <span class="input-group-text bg-light text-muted" style="border: 1px solid #cbd5e1; border-radius: 0 5px 5px 0; font-size: 0.85rem;">
                                {{ $task->satuan_target ?: 'Item' }}
                            </span>
                        </div>
                        <small class="text-muted d-block mt-1" style="font-size: 0.74rem;">
                            Masukkan jumlah yang sudah berhasil dicapai hingga saat ini.
                        </small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold text-dark" style="font-size: 0.83rem;">
                            Status Tugas <span class="text-danger">*</span>
                        </label>
                        <select name="status" class="form-select" required style="border: 1px solid #cbd5e1; border-radius: 5px; height: 42px; font-size: 0.88rem;">
                            <option value="Pending" {{ old('status', $task->status) === 'Pending' ? 'selected' : '' }}>Pending</option>
                            <option value="Proses" {{ old('status', $task->status) === 'Proses' ? 'selected' : '' }}>Proses</option>
                            <option value="Selesai" {{ old('status', $task->status) === 'Selesai' ? 'selected' : '' }}>Selesai</option>
                        </select>
                    </div>

                    <div class="mb-2">
                        <label class="form-label fw-bold text-dark" style="font-size: 0.83rem;">
                            Catatan Perkembangan / Keterangan
                        </label>
                        <textarea name="catatan_setor" class="form-control" rows="3"
                                  placeholder="Tuliskan catatan perkembangan realisasi tugas..."
                                  style="border: 1px solid #cbd5e1; border-radius: 5px; font-size: 0.88rem;">{{ old('catatan_setor', $task->catatan_setor) }}</textarea>
                    </div>
                </div>
                <div class="modal-footer bg-light border-top p-3 d-flex justify-content-between">
                    <button type="button" class="btn btn-light border px-3 py-2 fw-semibold" data-bs-dismiss="modal" style="border-radius: 5px; font-size: 0.85rem;">
                        Batal
                    </button>
                    <button type="submit" class="btn px-4 py-2 fw-semibold shadow-sm text-white" style="background-color: #7c3aed; border: none; border-radius: 5px; font-size: 0.88rem;">
                        <i class="mdi mdi-content-save-check me-1"></i> Simpan Perkembangan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
