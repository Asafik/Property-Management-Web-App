@extends('layouts.partial.app')

@section('title', 'Detail Tugas Promosi - Property Management')

@push('styles')
<meta name="referrer" content="no-referrer">
<style>
    /* 100% Solid Flat Colors - NO GRADIENTS */
    .detail-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        box-shadow: none;
        margin-bottom: 1.25rem;
        overflow: hidden;
    }

    .detail-card-header {
        background: #ffffff;
        border-bottom: 1px solid #e2e8f0;
        padding: 1rem 1.25rem;
    }

    .detail-card-body {
        padding: 1.25rem;
    }

    .table-detail-info td {
        padding: 0.65rem 0.5rem;
        font-size: 0.85rem;
        border-bottom: 1px solid #f1f5f9;
        vertical-align: middle;
    }

    .table-detail-info tr:last-child td {
        border-bottom: none;
    }

    .btn-solid-primary {
        background: #7c3aed !important;
        border: 1px solid #6d28d9 !important;
        color: #ffffff !important;
        font-weight: 600;
        box-shadow: none !important;
        border-radius: 6px;
        transition: background 0.15s ease;
    }
    .btn-solid-primary:hover {
        background: #6d28d9 !important;
        color: #ffffff !important;
    }

    .btn-solid-success {
        background: #10b981 !important;
        border: 1px solid #059669 !important;
        color: #ffffff !important;
        font-weight: 600;
        box-shadow: none !important;
        border-radius: 6px;
        transition: background 0.15s ease;
    }
    .btn-solid-success:hover {
        background: #059669 !important;
        color: #ffffff !important;
    }
    .btn-kembali-proyek {
        border-radius: 8px !important;
        font-size: 0.85rem;
        font-weight: 700;
        border: 1px solid #64748b !important;
        background-color: #64748b !important;
        color: #ffffff !important;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1) !important;
        transition: all 0.15s ease;
        text-decoration: none !important;
    }
    .btn-kembali-proyek:hover {
        background-color: #475569 !important;
        border-color: #475569 !important;
        color: #ffffff !important;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15) !important;
    }

    /* Video Preview Card Kecil */
    .video-preview-card {
        width: 120px;
        height: 165px;
        border-radius: 8px;
        overflow: hidden;
        position: relative;
        background-color: #1e1b4b;
        border: 1px solid #cbd5e1;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        padding: 8px;
        text-decoration: none !important;
        transition: transform 0.15s ease, box-shadow 0.15s ease, border-color 0.15s ease;
        flex-shrink: 0;
    }
    .video-preview-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(124, 58, 237, 0.2);
        border-color: #7c3aed;
    }
    .video-preview-thumb {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .video-preview-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(180deg, rgba(15, 23, 42, 0.4) 0%, rgba(15, 23, 42, 0.1) 40%, rgba(15, 23, 42, 0.8) 100%);
        pointer-events: none;
    }
    .video-play-btn {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background-color: #ffffff;
        color: #7c3aed;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.15rem;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.25);
        transition: transform 0.15s ease, background-color 0.15s ease, color 0.15s ease;
    }
    .video-preview-card:hover .video-play-btn {
        transform: translate(-50%, -50%) scale(1.1);
        background-color: #7c3aed;
        color: #ffffff;
    }
    .video-badge-pill {
        font-size: 0.65rem;
        font-weight: 700;
        padding: 2px 6px;
        border-radius: 4px;
        z-index: 2;
        display: inline-flex;
        align-items: center;
        gap: 3px;
        align-self: flex-start;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
    }
    .video-bottom-info {
        z-index: 2;
        font-size: 0.68rem;
        font-weight: 600;
        color: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 3px;
    }

    /* Metric View & Like Boxes */
    .metric-stat-box {
        border-radius: 8px;
        padding: 0.55rem 0.95rem;
        display: inline-flex;
        align-items: center;
        gap: 0.75rem;
        min-width: 125px;
    }
    .metric-stat-box.view-box {
        background-color: #f0f9ff;
        border: 1px solid #bae6fd;
    }
    .metric-stat-box.like-box {
        background-color: #fef2f2;
        border: 1px solid #fecaca;
    }
    .metric-stat-icon {
        width: 32px;
        height: 32px;
        border-radius: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.1rem;
        flex-shrink: 0;
    }
    .metric-stat-box.view-box .metric-stat-icon {
        background-color: #e0f2fe;
        color: #0284c7;
    }
    .metric-stat-box.like-box .metric-stat-icon {
        background-color: #fee2e2;
        color: #dc2626;
    }
    .metric-stat-number {
        font-size: 1.15rem;
        font-weight: 800;
        line-height: 1.1;
    }
    .metric-stat-box.view-box .metric-stat-number {
        color: #0369a1;
    }
    .metric-stat-box.like-box .metric-stat-number {
        color: #b91c1c;
    }
    .metric-stat-title {
        font-size: 0.72rem;
        font-weight: 700;
        color: #64748b;
        letter-spacing: 0.3px;
    }
</style>
@endpush

@section('content')
<div class="container-fluid px-2 px-md-4 py-3">

    <!-- Header Banner Tugas (Dengan Tombol Kembali Terintegrasi di Kanan) -->
    <div class="detail-card p-4 mb-3">
        <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
            <div>
                <div class="d-flex flex-wrap align-items-center gap-2 mb-2">
                    @if($task->link_postingan)
                    <span class="badge py-1.5 px-2.5 fw-semibold" style="font-size: 0.78rem; border-radius: 6px; background-color: #ecfdf5; color: #059669; border: 1px solid #a7f3d0;">
                        <i class="mdi mdi-check-circle me-1"></i>Sudah Selesai Disetor
                    </span>
                    @else
                    <span class="badge py-1.5 px-2.5 fw-semibold" style="font-size: 0.78rem; border-radius: 6px; background-color: #fffbeb; color: #b45309; border: 1px solid #fde68a;">
                        <i class="mdi mdi-clock-outline me-1"></i>Belum Disetor
                    </span>
                    @endif

                    <span class="badge bg-light text-danger border px-2.5 py-1.5 fw-bold" style="font-size: 0.78rem;">
                        <i class="mdi mdi-instagram me-1"></i>{{ $task->platform ?: 'Instagram Reels / TikTok' }}
                    </span>

                    @if($task->deadline)
                    <span class="badge bg-danger-subtle text-danger fw-bold px-2.5 py-1.5" style="font-size: 0.78rem;">
                        <i class="mdi mdi-calendar-alert me-1"></i>Batas Waktu: {{ \Carbon\Carbon::parse($task->deadline)->format('d F Y') }}
                    </span>
                    @endif
                </div>

                <h3 class="fw-bold text-dark mb-1" style="font-size: 1.45rem;">
                    {{ $task->nama_tugas }}
                </h3>
                <p class="text-muted mb-0" style="font-size: 0.88rem;">
                    Ditugaskan kepada: <strong class="text-dark">{{ $task->employee->name ?? 'Staff Marketing' }}</strong> ({{ $task->employee->position->name ?? 'Marketing' }}) &bull; Dibuat pada {{ $task->created_at ? $task->created_at->format('d M Y, H:i') . ' WIB' : '-' }}
                </p>
            </div>

            <!-- Tombol Kembali ke Daftar Tugas (Rapi di Kanan) -->
            <div class="d-flex align-items-center gap-2 flex-shrink-0">
                <a href="{{ route('marketing.sosialmedia.tugas') }}" class="btn btn-sm d-inline-flex align-items-center gap-2 px-3 py-2 shadow-sm btn-kembali-proyek">
                    <i class="mdi mdi-arrow-left text-white" style="font-size: 1.05rem; line-height: 1;"></i>
                    <span>Kembali ke Daftar Tugas</span>
                </a>
            </div>
        </div>
    </div>

    <div class="row g-3">
        <!-- Kolom Kiri: Deskripsi & Arahan Penugasan -->
        <div class="col-lg-8">
            
            <!-- Card 1: Deskripsi Lengkap -->
            <div class="detail-card">
                <div class="detail-card-header d-flex align-items-center justify-content-between">
                    <h5 class="fw-bold text-dark mb-0" style="font-size: 0.95rem;">
                        <i class="mdi mdi-text-box-search-outline text-primary me-1"></i> Deskripsi & Rincian Tugas
                    </h5>
                </div>
                <div class="detail-card-body">
                    @if($task->deskripsi)
                    <div class="p-3 rounded-2 mb-3" style="background-color: #f8fafc; border: 1px solid #e2e8f0; font-size: 0.9rem; line-height: 1.6; color: #334155; white-space: pre-line;">
                        {{ $task->deskripsi }}
                    </div>
                    @else
                    <p class="text-muted fst-italic mb-3">Tidak ada catatan deskripsi tambahan untuk tugas ini.</p>
                    @endif

                    <!-- Panduan Pembuatan Konten -->
                    <h6 class="fw-bold text-dark mb-2" style="font-size: 0.88rem;">
                        <i class="mdi mdi-check-circle-outline text-success me-1"></i> Ketentuan Pembuatan Konten:
                    </h6>
                    <ul class="list-unstyled mb-0" style="font-size: 0.85rem; color: #475569;">
                        <li class="d-flex align-items-start gap-2 mb-1.5">
                            <i class="mdi mdi-checkbox-marked-circle text-primary mt-0.5"></i>
                            <span>Format video vertikal (9:16) berdurasi 30 - 60 detik.</span>
                        </li>
                        <li class="d-flex align-items-start gap-2 mb-1.5">
                            <i class="mdi mdi-checkbox-marked-circle text-primary mt-0.5"></i>
                            <span>Sertakan informasi keunggulan unit: DP 0%, bebas biaya-biaya, lokasi strategis, dan nomor kontak pemasaran.</span>
                        </li>
                        <li class="d-flex align-items-start gap-2 mb-1.5">
                            <i class="mdi mdi-checkbox-marked-circle text-primary mt-0.5"></i>
                            <span>Gunakan audio/sound yang sedang tren di platform untuk meningkatkan jangkauan tayangan.</span>
                        </li>
                        <li class="d-flex align-items-start gap-2">
                            <i class="mdi mdi-checkbox-marked-circle text-primary mt-0.5"></i>
                            <span>Setelah video tayang, salin tautan postingan (URL) dan kirimkan melalui tombol setoran.</span>
                        </li>
                    </ul>
                </div>
            </div>


            <!-- Card 3: Bukti Setoran (Jika Sudah Disetor) -->
            @if($task->link_postingan)
            @php
                $videoUrl = $task->link_postingan;
                $thumbnailUrl = null;
                $platformBadge = 'Video';
                $platformColor = '#475569';
                $platformIcon = 'mdi-video';

                if (preg_match('/(?:youtube\.com\/(?:watch\?v=|shorts\/|embed\/)|youtu\.be\/)([a-zA-Z0-9_-]{11})/i', $videoUrl, $ytMatches)) {
                    $thumbnailUrl = "https://img.youtube.com/vi/" . $ytMatches[1] . "/hqdefault.jpg";
                    $platformBadge = 'YouTube';
                    $platformColor = '#ef4444';
                    $platformIcon = 'mdi-youtube';
                } elseif (preg_match('/(?:instagram\.com\/(?:p|reel|reels)\/([a-zA-Z0-9_-]+))/i', $videoUrl, $igMatches)) {
                    $platformBadge = 'Instagram Reels';
                    $platformColor = '#e1306c';
                    $platformIcon = 'mdi-instagram';
                } elseif (preg_match('/tiktok\.com/i', $videoUrl)) {
                    $platformBadge = 'TikTok';
                    $platformColor = '#0f172a';
                    $platformIcon = 'mdi-music-note';
                }
            @endphp
            <div class="detail-card">
                <div class="detail-card-header d-flex align-items-center justify-content-between">
                    <h5 class="fw-bold text-dark mb-0" style="font-size: 0.95rem;">
                        <i class="mdi mdi-check-decagram text-success me-1"></i> Bukti Setoran Penugasan
                    </h5>
                    <span class="badge py-1.5 px-2.5 fw-semibold" style="font-size: 0.76rem; border-radius: 6px; background-color: #ecfdf5; color: #059669; border: 1px solid #a7f3d0;">
                        <i class="mdi mdi-check-circle me-1"></i>Terverifikasi Selesai
                    </span>
                </div>
                <div class="detail-card-body">
                    <div class="row g-4 align-items-start">
                        
                        <!-- Preview Card Kecil Thumbnail Video -->
                        <div class="col-auto">
                            <label class="text-muted small fw-semibold d-block mb-2">Preview Video:</label>
                            <a href="{{ $task->link_postingan }}" target="_blank" class="video-preview-card" title="Klik untuk memutar video asli">
                                @if($thumbnailUrl)
                                    <img src="{{ $thumbnailUrl }}" alt="Video Thumbnail" class="video-preview-thumb">
                                @else
                                    <div class="video-preview-thumb" style="background: #1e1b4b; display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 4px;">
                                        <i class="mdi {{ $platformIcon }}" style="font-size: 2.8rem; color: #818cf8;"></i>
                                        <span style="font-size: 0.65rem; color: #c7d2fe; font-weight: 600;">{{ $platformBadge }}</span>
                                    </div>
                                @endif
                                <div class="video-preview-overlay"></div>
                                
                                <span class="video-badge-pill" style="background-color: {{ $platformColor }}; color: #ffffff;">
                                    <i class="mdi {{ $platformIcon }}"></i>{{ $platformBadge }}
                                </span>
                                
                                <div class="video-play-btn">
                                    <i class="mdi mdi-play"></i>
                                </div>
                                
                                <div class="video-bottom-info">
                                    <i class="mdi mdi-open-in-new me-0.5"></i>Tonton Video
                                </div>
                            </a>
                        </div>

                        <!-- Kolom Detail Tautan & Metrik (View & Like) -->
                        <div class="col">
                            <!-- Tautan URL Video -->
                            <div class="mb-3">
                                <label class="text-muted small fw-semibold d-block mb-2">Tautan URL Video yang Disetor:</label>
                                <div class="p-2 px-3 rounded-2 d-flex align-items-center justify-content-between gap-3" style="background-color: #f8fafc; border: 1px solid #e2e8f0;">
                                    <a href="{{ $task->link_postingan }}" target="_blank" class="text-primary text-truncate fw-semibold small text-decoration-none d-flex align-items-center gap-2" style="max-width: calc(100% - 110px);" title="{{ $task->link_postingan }}">
                                        <i class="mdi mdi-link-variant text-secondary fs-6"></i>
                                        <span class="text-truncate">{{ $task->link_postingan }}</span>
                                    </a>
                                    <a href="{{ $task->link_postingan }}" target="_blank" class="btn btn-sm btn-solid-primary d-inline-flex align-items-center gap-1 px-3 py-1 flex-shrink-0" style="border-radius: 6px; font-size: 0.78rem;">
                                        <i class="mdi mdi-open-in-new"></i>
                                        <span>Buka Link</span>
                                    </a>
                                </div>
                            </div>

                            <!-- Metrik Performa: View & Like -->
                            <div class="mb-3">
                                <label class="text-muted small fw-semibold d-block mb-2">Performa Tayangan Video:</label>
                                <div class="d-flex align-items-center gap-4">
                                    <!-- Metric Box: View -->
                                    <div class="metric-stat-box view-box">
                                        <div class="metric-stat-icon">
                                            <i class="mdi mdi-eye"></i>
                                        </div>
                                        <div>
                                            <div class="metric-stat-number">{{ number_format($task->views ?: 0, 0, ',', '.') }}</div>
                                            <div class="metric-stat-title">View</div>
                                        </div>
                                    </div>

                                    <!-- Metric Box: Like -->
                                    <div class="metric-stat-box like-box">
                                        <div class="metric-stat-icon">
                                            <i class="mdi mdi-heart"></i>
                                        </div>
                                        <div>
                                            <div class="metric-stat-number">{{ number_format($task->likes ?: 0, 0, ',', '.') }}</div>
                                            <div class="metric-stat-title">Like</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @if($task->catatan_setor)
                            <div class="mb-2">
                                <label class="text-muted small fw-semibold d-block mb-1">Catatan dari Staff Marketing:</label>
                                <p class="text-dark small mb-0 p-2.5 rounded-2" style="background-color: #f8fafc; border: 1px solid #e2e8f0;">
                                    {{ $task->catatan_setor }}
                                </p>
                            </div>
                            @endif

                            <div class="text-muted mt-2" style="font-size: 0.75rem;">
                                <i class="mdi mdi-calendar-check text-success me-1"></i>Disetor pada: <span class="fw-semibold text-secondary">{{ $task->tanggal_setor ? \Carbon\Carbon::parse($task->tanggal_setor)->format('d M Y, H:i') . ' WIB' : '-' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif

        </div>

        <!-- Kolom Kanan: Rangkuman Info & Tindakan -->
        <div class="col-lg-4">
            
            <!-- Box Ringkasan Penugasan -->
            <div class="detail-card">
                <div class="detail-card-header">
                    <h5 class="fw-bold text-dark mb-0" style="font-size: 0.92rem;">
                        <i class="mdi mdi-information-outline text-secondary me-1"></i> Rangkuman Informasi
                    </h5>
                </div>
                <div class="detail-card-body p-0">
                    <table class="table table-detail-info mb-0">
                        <tr>
                            <td class="text-muted" style="width: 120px;">Status Tugas</td>
                            <td class="fw-bold">
                                @if($task->link_postingan)
                                <span class="badge py-1 px-2 fw-semibold" style="font-size: 0.74rem; border-radius: 6px; background-color: #ecfdf5; color: #059669; border: 1px solid #a7f3d0;">
                                    <i class="mdi mdi-check-circle me-1"></i>Selesai
                                </span>
                                @else
                                <span class="badge py-1 px-2 fw-semibold" style="font-size: 0.74rem; border-radius: 6px; background-color: #fffbeb; color: #b45309; border: 1px solid #fde68a;">
                                    <i class="mdi mdi-clock-outline me-1"></i>Belum Disetor
                                </span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td class="text-muted">Staff Marketing</td>
                            <td class="fw-bold text-dark">{{ $task->employee->name ?? 'Staff Marketing' }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Platform Target</td>
                            <td>
                                <span class="badge bg-light text-dark border px-2 py-1" style="font-size: 0.74rem;">
                                    {{ $task->platform ?: 'Instagram Reels / TikTok' }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-muted">Batas Waktu</td>
                            <td class="fw-bold text-danger">
                                {{ $task->deadline ? \Carbon\Carbon::parse($task->deadline)->format('d M Y') : '-' }}
                            </td>
                        </tr>
                        <tr>
                            <td class="text-muted">Tanggal Dibuat</td>
                            <td class="text-muted">{{ $task->created_at ? $task->created_at->format('d M Y') : '-' }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <!-- Box Aksi Setor Tugas (Jika Belum Selesai) -->
            @if(!$task->link_postingan)
            <div class="detail-card">
                <div class="detail-card-body">
                    <h6 class="fw-bold text-dark mb-1" style="font-size: 0.92rem;">
                        <i class="mdi mdi-upload text-warning me-1"></i> Siap Menyetorkan Link?
                    </h6>
                    <p class="text-muted small mb-3">
                        Jika video promosi telah diunggah di Instagram Reels atau TikTok Anda, klik tombol di bawah untuk menyetorkan tautan postingan.
                    </p>
                    <button type="button" class="btn btn-sm btn-solid-primary w-100 py-2 d-inline-flex align-items-center justify-content-center gap-1.5 shadow-sm" onclick="bukaModalSetorTugas({{ $task->id }}, '{{ addslashes($task->nama_tugas) }}')">
                        <i class="mdi mdi-upload fs-6"></i>
                        <span>Setor Tautan Video Promosi</span>
                    </button>
                </div>
            </div>
            @endif

        </div>
    </div>

</div>

<!-- Modal Setor Link Tugas -->
<div class="modal fade" id="modalSetorTugas" tabindex="-1" aria-labelledby="modalSetorTugasLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow" style="border-radius: 10px; overflow: hidden;">
            <div class="modal-header bg-white border-bottom px-4 py-3">
                <div class="d-flex align-items-center gap-2">
                    <div style="width: 32px; height: 32px; border-radius: 6px; background-color: #f3e8ff; display: flex; align-items: center; justify-content: center; color: #7c3aed;">
                        <i class="mdi mdi-upload fs-5"></i>
                    </div>
                    <div>
                        <h5 class="modal-title fw-bold text-dark mb-0" id="modalSetorTugasLabel" style="font-size: 1rem;">
                            Setor Link Video Promosi
                        </h5>
                        <small class="text-muted" style="font-size: 0.76rem;">Formulir laporan bukti tayang tugas marketing</small>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <form id="formSetorTugasNyata" onsubmit="kirimSetorTugasDb(event)">
                @csrf
                <input type="hidden" name="task_id" id="modalInputTaskId" value="{{ $task->id }}">

                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label fw-bold text-dark" style="font-size: 0.84rem;">
                            Tugas yang Dikerjakan
                        </label>
                        <input type="text" id="modalInputNamaTugas" class="form-control bg-light fw-bold" readonly value="{{ $task->nama_tugas }}" style="font-size: 0.88rem; border-radius: 6px;">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold text-dark" style="font-size: 0.84rem;">
                            Platform Media Sosial <span class="text-danger">*</span>
                        </label>
                        <select name="platform" id="modalInputPlatform" class="form-select" style="font-size: 0.88rem; border-radius: 6px;" required>
                            <option value="Instagram Reels">Instagram Reels (@instagram)</option>
                            <option value="TikTok">TikTok (@tiktok)</option>
                            <option value="YouTube Shorts">YouTube Shorts</option>
                            <option value="Facebook Video">Facebook Video / Reels</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold text-dark" style="font-size: 0.84rem;">
                            Link URL Postingan Video <span class="text-danger">*</span>
                        </label>
                        <div class="input-group">
                            <span class="input-group-text bg-light text-muted border-end-0">
                                <i class="mdi mdi-link-variant"></i>
                            </span>
                            <input type="url" name="link_postingan" id="modalInputUrlVideo" class="form-control border-start-0" 
                                   placeholder="https://www.instagram.com/reel/C... atau https://www.tiktok.com/@..." 
                                   required style="font-size: 0.88rem; border-radius: 0 6px 6px 0;">
                        </div>
                        <small class="text-muted" style="font-size: 0.74rem;">
                            *Salin tautan video promosi yang sudah Anda tayangkan di medsos.
                        </small>
                    </div>

                    <div class="mb-2">
                        <label class="form-label fw-bold text-dark" style="font-size: 0.84rem;">
                            Catatan Tambahan (Opsional)
                        </label>
                        <textarea name="catatan_setor" id="modalInputCatatan" class="form-control" rows="2" placeholder="Contoh: Sudah ditayangkan di akun pribadi & kantor, caption menyertakan kontak WA..." style="font-size: 0.85rem; border-radius: 6px;"></textarea>
                    </div>
                </div>

                <div class="modal-footer bg-light border-top px-4 py-2.5">
                    <button type="button" class="btn btn-sm btn-secondary fw-semibold px-3 py-1.5" data-bs-dismiss="modal" style="border-radius: 6px;">
                        Batal
                    </button>
                    <button type="submit" class="btn btn-sm btn-solid-success px-4 py-1.5 d-inline-flex align-items-center gap-1 shadow-sm" style="border-radius: 6px;">
                        <i class="mdi mdi-check-circle-outline"></i>
                        <span>Kirim Bukti Setoran Tugas</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function bukaModalSetorTugas(taskId, namaTugas) {
        document.getElementById('modalInputTaskId').value = taskId;
        document.getElementById('modalInputNamaTugas').value = namaTugas;
        const modal = new bootstrap.Modal(document.getElementById('modalSetorTugas'));
        modal.show();
    }

    function kirimSetorTugasDb(e) {
        e.preventDefault();
        const form = document.getElementById('formSetorTugasNyata');
        const formData = new FormData(form);
        const modalEl = document.getElementById('modalSetorTugas');
        const modalInstance = bootstrap.Modal.getInstance(modalEl);

        Swal.fire({
            title: 'Menyimpan...',
            text: 'Sedang memproses tautan video promosi Anda',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        fetch("{{ route('marketing.sosialmedia.submitTask') }}", {
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
                if (modalInstance) {
                    modalInstance.hide();
                }
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil Disimpan!',
                    text: 'Link video promosi telah berhasil disimpan.',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#10b981'
                }).then(() => {
                    window.location.reload();
                });
            } else {
                Swal.fire('Gagal Menyimpan', data.message || 'Terjadi kesalahan saat menyimpan.', 'error');
            }
        })
        .catch(err => {
            console.error(err);
            Swal.fire('Error', 'Gagal menghubungi server.', 'error');
        });
    }
</script>
@endpush

