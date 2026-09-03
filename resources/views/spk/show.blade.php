@extends('layouts.partial.app')

@section('title', 'Detail SPK - ' . $spk->no_spk . ' - Property Management App')

@section('content')

<style>
    .header-card {
        background: #ffffff;
        border-radius: 10px;
        border: none;
        box-shadow: 0 4px 18px rgba(0, 0, 0, 0.04);
    }

    .stat-card-detail {
        background: #ffffff;
        border-radius: 10px;
        border: none;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.04);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .stat-card-detail:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.07);
    }

    .stat-icon-box-detail {
        width: 44px;
        height: 44px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.4rem;
    }

    .detail-card {
        background: #ffffff;
        border-radius: 10px;
        border: none;
        box-shadow: 0 4px 18px rgba(0, 0, 0, 0.04);
        margin-bottom: 1.25rem;
    }

    .detail-header {
        padding: 0.9rem 1.25rem;
        background: #fbf9ff;
        border-bottom: 1px solid #ebe5f5;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .detail-header-left {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .detail-header-left i {
        font-size: 1.25rem;
        color: #9a55ff;
    }

    .detail-title {
        font-weight: 700;
        color: #2c2e3f;
        font-size: 0.95rem;
        margin: 0;
    }

    .detail-body {
        padding: 1.25rem;
    }

    .info-label {
        font-size: 0.78rem;
        color: #64748b;
        text-transform: uppercase;
        font-weight: 600;
        letter-spacing: 0.3px;
        margin-bottom: 0.25rem;
    }

    .info-val {
        font-size: 0.92rem;
        color: #1e293b;
        font-weight: 600;
        margin-bottom: 0.75rem;
    }

    /* Status Badge Styling */
    .badge-status-spk {
        font-size: 0.75rem;
        font-weight: 600;
        padding: 0.32rem 0.75rem;
        border-radius: 30px;
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }

    .badge-status-draft {
        background: rgba(108, 117, 125, 0.12);
        color: #6c757d;
        border: 1px solid rgba(108, 117, 125, 0.25);
    }

    .badge-status-berjalan {
        background: rgba(23, 162, 184, 0.12);
        color: #0d8a9e;
        border: 1px solid rgba(23, 162, 184, 0.25);
    }

    .badge-status-selesai {
        background: rgba(40, 167, 69, 0.12);
        color: #1e7e34;
        border: 1px solid rgba(40, 167, 69, 0.25);
    }

    .badge-status-dibatalkan {
        background: rgba(220, 53, 69, 0.12);
        color: #bd2130;
        border: 1px solid rgba(220, 53, 69, 0.25);
    }

    /* Table Termin */
    .table-termin-detail thead th {
        color: #7c3aed;
        font-weight: 700;
        font-size: 0.78rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        background: #fbf9ff;
        border-bottom: 1px solid #ebe5f5;
        padding: 0.65rem 0.85rem;
    }

    .table-termin-detail tbody td {
        padding: 0.65rem 0.85rem;
        vertical-align: middle;
        font-size: 0.86rem;
    }

    .pasal-display-box {
        background: #fafbfc;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        padding: 1.15rem;
        line-height: 1.7;
        font-size: 0.88rem;
        color: #334155;
        white-space: pre-line;
        max-height: 480px;
        overflow-y: auto;
    }
</style>

<div class="container-fluid px-1 px-sm-2 px-md-3 py-2 py-md-3">

    <!-- Header Banner & Action Buttons -->
    <div class="card shadow-sm border-0 header-card mb-3 mb-md-4">
        <div class="card-body p-3 p-md-4 d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3">
            <div>
                <div class="d-flex align-items-center gap-2 flex-wrap mb-1">
                    <h4 class="fw-bold text-dark mb-0" style="font-size: 1.25rem;">
                        {{ $spk->no_spk }}
                    </h4>
                    @if($spk->status == 'berjalan')
                        <span class="badge-status-spk badge-status-berjalan">
                            <i class="mdi mdi-play-circle-outline"></i> Berjalan
                        </span>
                    @elseif($spk->status == 'selesai')
                        <span class="badge-status-spk badge-status-selesai">
                            <i class="mdi mdi-check-circle-outline"></i> Selesai
                        </span>
                    @elseif($spk->status == 'dibatalkan')
                        <span class="badge-status-spk badge-status-dibatalkan">
                            <i class="mdi mdi-close-circle-outline"></i> Dibatalkan
                        </span>
                    @else
                        <span class="badge-status-spk badge-status-draft">
                            <i class="mdi mdi-file-clock-outline"></i> Draft Konsep
                        </span>
                    @endif
                </div>
                <div class="d-flex align-items-center gap-2 text-muted small flex-wrap">
                    <span><i class="mdi mdi-calendar-blank-outline me-1"></i>Tanggal SPK: {{ date('d M Y', strtotime($spk->tanggal_spk)) }}</span>
                    <span>•</span>
                    <span><i class="mdi mdi-hard-hat me-1"></i>{{ $spk->kontraktor_nama }}</span>
                    <span>•</span>
                    <span><i class="mdi mdi-domain me-1"></i>{{ $spk->landBank->name ?? 'Proyek' }}</span>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="d-flex align-items-center gap-2 flex-wrap ms-md-auto">
                <a href="{{ route('spk.cetak', $spk->id) }}" target="_blank" class="btn btn-sm btn-gradient-primary d-inline-flex align-items-center gap-1 text-white shadow-sm" style="background: linear-gradient(135deg, #11998e, #38ef7d); border: none; border-radius: 6px; padding: 0.45rem 0.9rem;">
                    <i class="mdi mdi-printer"></i>
                    <span>Cetak Surat SPK</span>
                </a>
                <a href="{{ route('spk.edit', $spk->id) }}" class="btn btn-sm btn-gradient-primary d-inline-flex align-items-center gap-1 text-white shadow-sm" style="background: linear-gradient(135deg, #36d1dc, #5b86e5); border: none; border-radius: 6px; padding: 0.45rem 0.9rem;">
                    <i class="mdi mdi-pencil"></i>
                    <span>Edit SPK</span>
                </a>
                <a href="{{ route('spk.index') }}" class="btn btn-sm btn-outline-secondary d-inline-flex align-items-center gap-1" style="border-radius: 6px; padding: 0.45rem 0.9rem;">
                    <i class="mdi mdi-arrow-left"></i>
                    <span>Kembali</span>
                </a>
            </div>
        </div>
    </div>

    <!-- 4 Highlight Statistic Cards -->
    <div class="row g-3 mb-3 mb-md-4">
        <div class="col-6 col-md-3">
            <div class="card stat-card-detail p-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="info-label">Nilai Kontrak</span>
                        <h5 class="fw-bold text-primary mb-0 mt-1" style="font-size: 1.05rem;">{{ $spk->formatted_nilai_kontrak }}</h5>
                        <small class="text-muted d-block mt-0.5" style="font-size: 0.74rem;">{{ $spk->termins->count() }} Tahap Termin</small>
                    </div>
                    <div class="stat-icon-box-detail" style="background: rgba(154, 85, 255, 0.12); color: #9a55ff;">
                        <i class="mdi mdi-cash-multiple"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-6 col-md-3">
            <div class="card stat-card-detail p-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="info-label">Durasi Waktu</span>
                        <h5 class="fw-bold text-dark mb-0 mt-1" style="font-size: 1.05rem;">{{ $spk->durasi_hari }} Hari</h5>
                        <small class="text-muted d-block mt-0.5" style="font-size: 0.74rem;">{{ date('d/m/y', strtotime($spk->tanggal_mulai)) }} - {{ date('d/m/y', strtotime($spk->tanggal_selesai)) }}</small>
                    </div>
                    <div class="stat-icon-box-detail" style="background: rgba(23, 162, 184, 0.12); color: #17a2b8;">
                        <i class="mdi mdi-clock-outline"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-6 col-md-3">
            <div class="card stat-card-detail p-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="info-label">Progres Fisik</span>
                        <h5 class="fw-bold text-success mb-0 mt-1" style="font-size: 1.05rem;">{{ $spk->progress }}%</h5>
                        <div class="progress mt-1" style="height: 5px; width: 85px; background: #e2e8f0;">
                            <div class="progress-bar bg-gradient-primary" style="width: {{ $spk->progress }}%;"></div>
                        </div>
                    </div>
                    <div class="stat-icon-box-detail" style="background: rgba(40, 167, 69, 0.12); color: #28a745;">
                        <i class="mdi mdi-progress-check"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-6 col-md-3">
            <div class="card stat-card-detail p-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="info-label">Jenis SPK</span>
                        <h6 class="fw-bold text-dark mb-0 mt-1" style="font-size: 0.95rem;">{{ $spk->jenis_spk }}</h6>
                        <small class="text-muted d-block mt-0.5" style="font-size: 0.74rem;">Sistem: {{ ucfirst($spk->sistem_pembayaran) }}</small>
                    </div>
                    <div class="stat-icon-box-detail" style="background: rgba(84, 110, 237, 0.12); color: #546eed;">
                        <i class="mdi mdi-file-document-edit-outline"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content 2 Columns -->
    <div class="row g-3">
        <!-- Kolom Kiri: Informasi Lingkup, Pihak & Klausul -->
        <div class="col-lg-7">
            
            <!-- Card 1: Informasi Pekerjaan & Lokasi -->
            <div class="card detail-card">
                <div class="detail-header">
                    <div class="detail-header-left">
                        <i class="mdi mdi-home-city-outline"></i>
                        <h5 class="detail-title">Informasi Pekerjaan & Lokasi Proyek</h5>
                    </div>
                </div>
                <div class="detail-body">
                    <div class="row g-2">
                        <div class="col-md-6">
                            <div class="info-label">Proyek / Land Bank</div>
                            <div class="info-val text-primary">
                                <i class="mdi mdi-domain me-1"></i>{{ $spk->landBank->name ?? '-' }}
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="info-label">Unit Kavling</div>
                            <div class="info-val">
                                @if($spk->unit)
                                    <span class="badge bg-light text-dark border px-2 py-1 font-monospace" style="font-size: 0.8rem;">
                                        Kav. {{ $spk->unit->unit_code }} (Type {{ $spk->unit->type }}) - LT: {{ $spk->unit->area }}m² / LB: {{ $spk->unit->building_area }}m²
                                    </span>
                                @else
                                    <span class="text-muted fw-normal">Infrastruktur / Fasum / Non-Kavling</span>
                                @endif
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="info-label">Nama / Judul Pekerjaan</div>
                            <div class="info-val text-dark fw-bold fs-6">{{ $spk->nama_pekerjaan }}</div>
                        </div>

                        @if($spk->deskripsi_pekerjaan)
                            <div class="col-12">
                                <div class="info-label">Deskripsi Lingkup Pekerjaan</div>
                                <div class="p-2.5 rounded bg-light border text-muted small" style="line-height: 1.6;">
                                    {{ $spk->deskripsi_pekerjaan }}
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Card 2: Identitas Para Pihak -->
            <div class="card detail-card">
                <div class="detail-header">
                    <div class="detail-header-left">
                        <i class="mdi mdi-account-group-outline"></i>
                        <h5 class="detail-title">Identitas Para Pihak</h5>
                    </div>
                </div>
                <div class="detail-body">
                    <div class="row g-3">
                        <!-- Pihak Pertama -->
                        <div class="col-md-6 border-end-md">
                            <div class="fw-bold text-dark border-bottom pb-1 mb-2 small text-uppercase d-flex align-items-center gap-1">
                                <i class="mdi mdi-domain" style="color: #9a55ff;"></i>
                                <span>PIHAK PERTAMA (DEVELOPER)</span>
                            </div>
                            <div class="small mb-1.5">
                                <span class="text-muted">Perusahaan:</span><br>
                                <strong>{{ $spk->pihak_pertama_perusahaan ?: 'PT. Developer' }}</strong>
                            </div>
                            <div class="small mb-1.5">
                                <span class="text-muted">Nama Pejabat:</span><br>
                                <strong>{{ $spk->pihak_pertama_nama ?: '-' }}</strong> ({{ $spk->pihak_pertama_jabatan ?: 'Direktur' }})
                            </div>
                            <div class="small mb-1.5">
                                <span class="text-muted">Alamat:</span><br>
                                <span>{{ $spk->pihak_pertama_alamat ?: '-' }}</span>
                            </div>
                            <div class="small">
                                <span class="text-muted">Telepon:</span><br>
                                <span>{{ $spk->pihak_pertama_telepon ?: '-' }}</span>
                            </div>
                        </div>

                        <!-- Pihak Kedua -->
                        <div class="col-md-6">
                            <div class="fw-bold text-dark border-bottom pb-1 mb-2 small text-uppercase d-flex align-items-center gap-1">
                                <i class="mdi mdi-account-hard-hat text-warning"></i>
                                <span>PIHAK KEDUA (KONTRAKTOR)</span>
                            </div>
                            <div class="small mb-1.5">
                                <span class="text-muted">Kontraktor / Usaha:</span><br>
                                <strong class="text-primary">{{ $spk->kontraktor_nama }}</strong>
                            </div>
                            <div class="small mb-1.5">
                                <span class="text-muted">Penanggung Jawab (PIC):</span><br>
                                <strong>{{ $spk->kontraktor_pic ?: '-' }}</strong>
                                @if($spk->kontraktor_ktp)
                                    <small class="text-muted">(NIK: {{ $spk->kontraktor_ktp }})</small>
                                @endif
                            </div>
                            <div class="small mb-1.5">
                                <span class="text-muted">Kontak / HP:</span><br>
                                <span>{{ $spk->kontraktor_telepon ?: '-' }}</span>
                            </div>
                            <div class="small mb-1.5">
                                <span class="text-muted">Alamat:</span><br>
                                <span>{{ $spk->kontraktor_alamat ?: '-' }}</span>
                            </div>
                            <div class="small">
                                <span class="text-muted">Rekening Pembayaran:</span><br>
                                <span class="font-monospace fw-semibold">{{ $spk->kontraktor_bank ?: '-' }} - {{ $spk->kontraktor_rekening ?: '-' }} (a.n {{ $spk->kontraktor_atas_nama ?: '-' }})</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card 3: Klausul Ketentuan & Pasal Perjanjian -->
            <div class="card detail-card">
                <div class="detail-header">
                    <div class="detail-header-left">
                        <i class="mdi mdi-gavel"></i>
                        <h5 class="detail-title">Klausul Perjanjian & Syarat Ketentuan</h5>
                    </div>
                </div>
                <div class="detail-body">
                    @if($spk->pasal_syarat_ketentuan)
                        <div class="pasal-display-box">
                            @if(strip_tags($spk->pasal_syarat_ketentuan) == $spk->pasal_syarat_ketentuan)
                                {!! nl2br(e($spk->pasal_syarat_ketentuan)) !!}
                            @else
                                {!! $spk->pasal_syarat_ketentuan !!}
                            @endif
                        </div>
                    @else
                        <div class="text-center py-4 text-muted">
                            <i class="mdi mdi-file-document-outline fs-3 opacity-50"></i>
                            <p class="small mb-0 mt-1">Tidak ada pasal khusus yang dicatat</p>
                        </div>
                    @endif

                    @if($spk->keterangan)
                        <div class="mt-3 p-2.5 rounded bg-light border">
                            <strong class="text-dark small d-block mb-1"><i class="mdi mdi-information-outline me-1 text-primary"></i>Catatan Tambahan:</strong>
                            <span class="small text-muted">{{ $spk->keterangan }}</span>
                        </div>
                    @endif
                </div>
            </div>

        </div>

        <!-- Kolom Kanan: Jadwal Termin & Berkas -->
        <div class="col-lg-5">
            
            <!-- Card 4: Skema Jadwal Termin Pembayaran -->
            <div class="card detail-card">
                <div class="detail-header">
                    <div class="detail-header-left">
                        <i class="mdi mdi-table-clock"></i>
                        <h5 class="detail-title">Skema & Jadwal Termin</h5>
                    </div>
                    <span class="badge bg-light text-primary border fw-bold">{{ $spk->termins->count() }} Termin</span>
                </div>
                <div class="detail-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle table-termin-detail mb-0">
                            <thead>
                                <tr>
                                    <th class="ps-3">TAHAP TERMIN</th>
                                    <th class="text-center">BOBOT</th>
                                    <th class="text-end pe-3">NOMINAL (RP)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($spk->termins as $idx => $t)
                                    <tr>
                                        <td class="ps-3">
                                            <div class="fw-bold text-dark">{{ $t->nama_tahap }}</div>
                                            <small class="text-muted d-block">
                                                Syarat Fisik: <strong>{{ $t->syarat_progress }}%</strong>
                                                @if($t->tanggal_jatuh_tempo)
                                                    • Jatuh tempo: {{ date('d/m/Y', strtotime($t->tanggal_jatuh_tempo)) }}
                                                @endif
                                            </small>
                                        </td>
                                        <td class="text-center fw-bold">{{ $t->persentase }}%</td>
                                        <td class="text-end pe-3 fw-bold text-primary">{{ $t->formatted_nominal }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center py-3 text-muted">Belum ada rincian termin</td>
                                    </tr>
                                @endforelse
                            </tbody>
                            <tfoot class="table-light fw-bold">
                                <tr>
                                    <td class="ps-3">TOTAL KONTRAK</td>
                                    <td class="text-center">{{ $spk->termins->sum('persentase') }}%</td>
                                    <td class="text-end pe-3 text-primary">{{ $spk->formatted_nilai_kontrak }}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Card 5: Berkas Fisik & Dokumen Pendukung -->
            <div class="card detail-card">
                <div class="detail-header">
                    <div class="detail-header-left">
                        <i class="mdi mdi-paperclip"></i>
                        <h5 class="detail-title">Berkas Fisik SPK</h5>
                    </div>
                </div>
                <div class="detail-body">
                    @if($spk->file_lampiran)
                        <div class="p-3 border rounded-3 bg-light d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center gap-2">
                                <i class="mdi mdi-file-pdf-box text-danger fs-2"></i>
                                <div>
                                    <h6 class="mb-0 fw-bold text-dark">{{ basename($spk->file_lampiran) }}</h6>
                                    <small class="text-muted">Dokumen Lampiran / Scan SPK</small>
                                </div>
                            </div>
                            <a href="{{ asset($spk->file_lampiran) }}" target="_blank" class="btn btn-sm btn-gradient-primary text-white shadow-sm" style="border-radius: 6px;">
                                <i class="mdi mdi-eye me-1"></i>Lihat File
                            </a>
                        </div>
                    @else
                        <div class="text-center py-4 text-muted">
                            <i class="mdi mdi-file-clock-outline fs-2 opacity-50"></i>
                            <p class="small mb-0 mt-1">Belum ada berkas scan yang diunggah</p>
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>

</div>

@endsection
