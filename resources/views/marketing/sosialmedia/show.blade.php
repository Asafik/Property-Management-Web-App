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
</style>
@endpush

@section('content')
<div class="container-fluid px-2 px-md-4 py-3">

    <!-- Top Navigation & Action -->
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-3">
        <div class="d-flex align-items-center gap-2">
            <a href="{{ route('marketing.sosialmedia.index') }}" class="btn btn-sm btn-outline-secondary d-inline-flex align-items-center gap-1.5 px-3 py-1.5" style="border-radius: 6px; font-weight: 600;">
                <i class="mdi mdi-arrow-left"></i>
                <span>Kembali ke Daftar Tugas</span>
            </a>
            <span class="badge bg-light text-secondary border px-2 py-1" style="font-size: 0.74rem;">
                TUGAS ID #{{ $task->id }}
            </span>
        </div>

        <div class="d-flex align-items-center gap-2">
            @if(!$task->link_postingan)
            <button type="button" class="btn btn-sm btn-solid-primary d-inline-flex align-items-center gap-1.5 px-3 py-1.5 shadow-sm" onclick="bukaModalSetorTugas({{ $task->id }}, '{{ addslashes($task->nama_tugas) }}')">
                <i class="mdi mdi-upload fs-6"></i>
                <span>Setor Link Tugas Ini</span>
            </button>
            @else
            <a href="{{ $task->link_postingan }}" target="_blank" class="btn btn-sm btn-solid-success d-inline-flex align-items-center gap-1.5 px-3 py-1.5 shadow-sm">
                <i class="mdi mdi-play-circle fs-6"></i>
                <span>Tonton Video Tayang</span>
            </a>
            @endif
        </div>
    </div>

    <!-- Header Banner Tugas -->
    <div class="detail-card p-4">
        <div class="d-flex flex-wrap align-items-start justify-content-between gap-3">
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

            <!-- Card 2: Bahan Materi Promosi -->
            <div class="detail-card">
                <div class="detail-card-header d-flex align-items-center justify-content-between">
                    <h5 class="fw-bold text-dark mb-0" style="font-size: 0.95rem;">
                        <i class="mdi mdi-folder-google-drive text-success me-1"></i> Bahan Materi Promosi & Aset Digital
                    </h5>
                </div>
                <div class="detail-card-body">
                    <div class="d-flex flex-column flex-sm-row align-items-start align-items-sm-center justify-content-between gap-3 p-3 rounded-2" style="background-color: #f8fafc; border: 1px solid #e2e8f0;">
                        <div>
                            <div class="fw-bold text-dark mb-0.5" style="font-size: 0.88rem;">
                                Google Drive: Foto Brosur & Footage Video Unit
                            </div>
                            <small class="text-muted">Aset visual resmi dari pengembang untuk bahan materi editing video promosi Anda.</small>
                        </div>
                        <a href="https://drive.google.com" target="_blank" class="btn btn-sm btn-outline-secondary py-1.5 px-3 d-inline-flex align-items-center gap-1.5" style="border-radius: 6px; font-size: 0.8rem; font-weight: 600;">
                            <i class="mdi mdi-download text-success"></i>
                            <span>Buka Google Drive</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Card 3: Bukti Setoran (Jika Sudah Disetor) -->
            @if($task->link_postingan)
            <div class="detail-card">
                <div class="detail-card-header d-flex align-items-center justify-content-between">
                    <h5 class="fw-bold text-dark mb-0" style="font-size: 0.95rem;">
                        <i class="mdi mdi-check-decagram text-success me-1"></i> Bukti Setoran Penugasan
                    </h5>
                    <span class="badge bg-success-subtle text-success fw-bold px-2 py-1" style="font-size: 0.74rem;">
                        Terverifikasi Selesai
                    </span>
                </div>
                <div class="detail-card-body">
                    <div class="row g-3">
                        <div class="col-md-7">
                            <label class="text-muted small fw-semibold d-block mb-1">Tautan URL Video yang Disetor:</label>
                            <div class="p-2.5 rounded-2 mb-2 d-flex align-items-center justify-content-between gap-2" style="background-color: #f8fafc; border: 1px solid #e2e8f0;">
                                <a href="{{ $task->link_postingan }}" target="_blank" class="text-primary text-truncate fw-semibold small text-decoration-none">
                                    <i class="mdi mdi-link-variant me-1"></i>{{ $task->link_postingan }}
                                </a>
                                <a href="{{ $task->link_postingan }}" target="_blank" class="btn btn-xs btn-outline-primary py-0.5 px-2" style="font-size: 0.72rem; border-radius: 4px;">
                                    Buka
                                </a>
                            </div>

                            @if($task->catatan_setor)
                            <label class="text-muted small fw-semibold d-block mb-1">Catatan dari Staff Marketing:</label>
                            <p class="text-dark small mb-0 p-2.5 rounded-2" style="background-color: #f8fafc; border: 1px solid #e2e8f0;">
                                {{ $task->catatan_setor }}
                            </p>
                            @endif
                        </div>

                        <div class="col-md-5">
                            <label class="text-muted small fw-semibold d-block mb-1">Performa Tayangan:</label>
                            <div class="d-flex align-items-center gap-2 mb-2">
                                <div class="p-2.5 rounded-2 flex-grow-1 text-center" style="background-color: #f0f9ff; border: 1px solid #bae6fd;">
                                    <div class="fw-bold text-primary" style="font-size: 1.1rem;">{{ number_format($task->views ?: 0, 0, ',', '.') }}</div>
                                    <small class="text-muted" style="font-size: 0.72rem;">Tayangan (Views)</small>
                                </div>
                                <div class="p-2.5 rounded-2 flex-grow-1 text-center" style="background-color: #fef2f2; border: 1px solid #fecaca;">
                                    <div class="fw-bold text-danger" style="font-size: 1.1rem;">{{ number_format($task->likes ?: 0, 0, ',', '.') }}</div>
                                    <small class="text-muted" style="font-size: 0.72rem;">Suka (Likes)</small>
                                </div>
                            </div>
                            <small class="text-muted d-block text-center" style="font-size: 0.72rem;">
                                Disetor pada: {{ $task->tanggal_setor ? \Carbon\Carbon::parse($task->tanggal_setor)->format('d M Y, H:i') . ' WIB' : '-' }}
                            </small>
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
            <div class="detail-card" style="border-left: 4px solid #f59e0b !important;">
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
