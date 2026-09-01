@extends('layouts.partial.app')

@section('title', 'Detail SPK - ' . $spk->no_spk)

@section('content')

<style>
    .detail-card {
        background: #ffffff;
        border-radius: 10px;
        border: none;
        box-shadow: 0 4px 18px rgba(0, 0, 0, 0.04);
        margin-bottom: 1.5rem;
    }

    .detail-header {
        padding: 1rem 1.25rem;
        background: #fbf9ff;
        border-bottom: 1px solid #ebe5f5;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .detail-header i {
        font-size: 1.25rem;
        color: #9a55ff;
    }

    .detail-title {
        font-weight: 700;
        color: #2c2e3f;
        font-size: 1rem;
        margin: 0;
    }

    .detail-body {
        padding: 1.25rem;
    }

    .info-label {
        font-size: 0.8rem;
        color: #6c757d;
        text-transform: uppercase;
        font-weight: 600;
        margin-bottom: 0.2rem;
    }

    .info-val {
        font-size: 0.95rem;
        color: #2c2e3f;
        font-weight: 600;
        margin-bottom: 0.8rem;
    }

    .badge-status-spk {
        font-size: 0.78rem;
        font-weight: 600;
        padding: 0.35rem 0.85rem;
        border-radius: 30px;
        display: inline-flex;
        align-items: center;
        gap: 5px;
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
</style>

<div class="container-fluid px-1 px-sm-2 px-md-3 py-2 py-md-3">

    <!-- Header Actions -->
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
        <div>
            <h4 class="fw-bold text-dark mb-1">Detail Surat Perintah Kerja</h4>
            <div class="d-flex align-items-center gap-2 small">
                <span class="text-muted"><i class="mdi mdi-file-document-outline me-1"></i>{{ $spk->no_spk }}</span>
                <span class="text-muted">•</span>
                <span class="text-muted"><i class="mdi mdi-calendar-blank me-1"></i>{{ date('d F Y', strtotime($spk->tanggal_spk)) }}</span>
            </div>
        </div>
        <div class="d-flex align-items-center gap-2">
            <a href="{{ route('spk.cetak', $spk->id) }}" target="_blank" class="btn btn-sm btn-success d-inline-flex align-items-center text-white" style="background: linear-gradient(135deg, #11998e, #38ef7d); border: none;">
                <i class="mdi mdi-printer me-1"></i>Cetak Dokumen SPK
            </a>
            <a href="{{ route('spk.edit', $spk->id) }}" class="btn btn-sm btn-primary d-inline-flex align-items-center text-white" style="background: linear-gradient(135deg, #36d1dc, #5b86e5); border: none;">
                <i class="mdi mdi-pencil me-1"></i>Edit SPK
            </a>
            <a href="{{ route('spk.index') }}" class="btn btn-sm btn-outline-secondary d-inline-flex align-items-center">
                <i class="mdi mdi-arrow-left me-1"></i>Kembali
            </a>
        </div>
    </div>

    <!-- Top Highlight Cards -->
    <div class="row g-3 mb-3">
        <div class="col-md-3">
            <div class="card detail-card p-3 mb-0">
                <span class="info-label">Status Dokumen</span>
                <div class="mt-1">
                    @if($spk->status == 'berjalan')
                        <span class="badge-status-spk badge-status-berjalan">
                            <i class="mdi mdi-play-circle-outline"></i> SPK Berjalan
                        </span>
                    @elseif($spk->status == 'selesai')
                        <span class="badge-status-spk badge-status-selesai">
                            <i class="mdi mdi-check-circle-outline"></i> SPK Selesai
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
            </div>
        </div>

        <div class="col-md-3">
            <div class="card detail-card p-3 mb-0">
                <span class="info-label">Nilai Total Kontrak</span>
                <h5 class="fw-bold text-primary mb-0 mt-1">{{ $spk->formatted_nilai_kontrak }}</h5>
                <small class="text-muted" style="font-size: 0.75rem;">{{ $spk->sistem_pembayaran == 'termin' ? 'Bertahap (Termin)' : ucfirst($spk->sistem_pembayaran) }}</small>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card detail-card p-3 mb-0">
                <span class="info-label">Durasi Pelaksanaan</span>
                <h5 class="fw-bold text-dark mb-0 mt-1">{{ $spk->durasi_hari }} Hari Kalender</h5>
                <small class="text-muted" style="font-size: 0.75rem;">{{ date('d/m/Y', strtotime($spk->tanggal_mulai)) }} s/d {{ date('d/m/Y', strtotime($spk->tanggal_selesai)) }}</small>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card detail-card p-3 mb-0">
                <span class="info-label">Progres Fisik</span>
                <div class="d-flex align-items-center gap-2 mt-1">
                    <div class="progress flex-grow-1" style="height: 8px;">
                        <div class="progress-bar bg-gradient-primary" style="width: {{ $spk->progress }}%;"></div>
                    </div>
                    <span class="fw-bold text-dark">{{ $spk->progress }}%</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Detail Rows -->
    <div class="row">
        <!-- Kolom Kiri: Informasi Pekerjaan & Pihak -->
        <div class="col-lg-7">
            <!-- Informasi Pekerjaan -->
            <div class="card detail-card">
                <div class="detail-header">
                    <i class="mdi mdi-home-city-outline"></i>
                    <h5 class="detail-title">Informasi Pekerjaan & Lokasi</h5>
                </div>
                <div class="detail-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="info-label">Nama Proyek / Perumahan</div>
                            <div class="info-val text-primary">
                                <i class="mdi mdi-domain me-1"></i>{{ $spk->landBank->name ?? '-' }}
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="info-label">Unit Kavling</div>
                            <div class="info-val">
                                @if($spk->unit)
                                    <span class="badge bg-light text-dark border px-2 py-1">
                                        Kav. {{ $spk->unit->unit_code }} (Type {{ $spk->unit->type }}) - {{ $spk->unit->unit_name ?? 'Unit' }}
                                    </span>
                                @else
                                    <span class="text-muted">Fasum / Infrastruktur / Non-Kavling</span>
                                @endif
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="info-label">Judul Pekerjaan</div>
                            <div class="info-val">{{ $spk->nama_pekerjaan }}</div>
                        </div>

                        @if($spk->deskripsi_pekerjaan)
                            <div class="col-12">
                                <div class="info-label">Deskripsi Lingkup Pekerjaan</div>
                                <p class="text-muted small mb-2 p-2 rounded bg-light border">{{ $spk->deskripsi_pekerjaan }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Komparasi Pihak -->
            <div class="card detail-card">
                <div class="detail-header">
                    <i class="mdi mdi-account-group-outline"></i>
                    <h5 class="detail-title">Identitas Para Pihak</h5>
                </div>
                <div class="detail-body">
                    <div class="row g-3">
                        <div class="col-md-6 border-end">
                            <div class="fw-bold text-dark border-bottom pb-1 mb-2 small text-uppercase">
                                <i class="mdi mdi-domain text-purple me-1"></i>PIHAK PERTAMA (DEVELOPER)
                            </div>
                            <div class="small mb-1">
                                <span class="text-muted">Perusahaan:</span><br>
                                <strong>{{ $spk->pihak_pertama_perusahaan ?: 'PT. Developer' }}</strong>
                            </div>
                            <div class="small mb-1">
                                <span class="text-muted">Perwakilan:</span><br>
                                <strong>{{ $spk->pihak_pertama_nama ?: '-' }}</strong> ({{ $spk->pihak_pertama_jabatan ?: '-' }})
                            </div>
                            <div class="small mb-1">
                                <span class="text-muted">Alamat:</span><br>
                                <span>{{ $spk->pihak_pertama_alamat ?: '-' }}</span>
                            </div>
                            <div class="small">
                                <span class="text-muted">Telepon:</span><br>
                                <span>{{ $spk->pihak_pertama_telepon ?: '-' }}</span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="fw-bold text-dark border-bottom pb-1 mb-2 small text-uppercase">
                                <i class="mdi mdi-account-hard-hat text-warning me-1"></i>PIHAK KEDUA (KONTRAKTOR)
                            </div>
                            <div class="small mb-1">
                                <span class="text-muted">Kontraktor:</span><br>
                                <strong class="text-primary">{{ $spk->kontraktor_nama }}</strong>
                            </div>
                            <div class="small mb-1">
                                <span class="text-muted">PIC / Penanggung Jawab:</span><br>
                                <strong>{{ $spk->kontraktor_pic ?: '-' }}</strong>
                                @if($spk->kontraktor_ktp)
                                    <small class="text-muted">(NIK: {{ $spk->kontraktor_ktp }})</small>
                                @endif
                            </div>
                            <div class="small mb-1">
                                <span class="text-muted">Kontak / HP:</span><br>
                                <span>{{ $spk->kontraktor_telepon ?: '-' }}</span>
                            </div>
                            <div class="small mb-1">
                                <span class="text-muted">Alamat:</span><br>
                                <span>{{ $spk->kontraktor_alamat ?: '-' }}</span>
                            </div>
                            <div class="small">
                                <span class="text-muted">Rekening Pencairan:</span><br>
                                <span>{{ $spk->kontraktor_bank ?: '-' }} - {{ $spk->kontraktor_rekening ?: '-' }} (a.n {{ $spk->kontraktor_atas_nama ?: '-' }})</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Klausul Pasal SPK -->
            <div class="card detail-card">
                <div class="detail-header">
                    <i class="mdi mdi-gavel"></i>
                    <h5 class="detail-title">Klausul Perjanjian & Syarat Ketentuan</h5>
                </div>
                <div class="detail-body" style="max-height: 400px; overflow-y: auto;">
                    {!! $spk->pasal_syarat_ketentuan !!}
                </div>
            </div>
        </div>

        <!-- Kolom Kanan: Jadwal Termin & Berkas -->
        <div class="col-lg-5">
            <!-- Skema & Jadwal Termin -->
            <div class="card detail-card">
                <div class="detail-header">
                    <i class="mdi mdi-table-clock"></i>
                    <h5 class="detail-title">Skema Jadwal Termin Pembayaran</h5>
                </div>
                <div class="detail-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0" style="font-size: 0.85rem;">
                            <thead class="table-light">
                                <tr>
                                    <th class="ps-3">TAHAP TERMIN</th>
                                    <th class="text-center">BOBOT</th>
                                    <th class="text-end">NOMINAL</th>
                                    <th class="text-center pe-3">STATUS</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($spk->termins as $t)
                                    <tr>
                                        <td class="ps-3">
                                            <div class="fw-bold text-dark">{{ $t->nama_tahap }}</div>
                                            <small class="text-muted">Syarat Fisik: {{ $t->syarat_progress }}%</small>
                                        </td>
                                        <td class="text-center fw-bold">{{ $t->persentase }}%</td>
                                        <td class="text-end fw-semibold text-primary">{{ $t->formatted_nominal }}</td>
                                        <td class="text-center pe-3">
                                            @if($t->status_bayar == 'lunas')
                                                <span class="badge bg-success" style="font-size: 10px;">LUNAS</span>
                                            @elseif($t->status_bayar == 'proses')
                                                <span class="badge bg-warning text-dark" style="font-size: 10px;">PROSES</span>
                                            @else
                                                <span class="badge bg-light text-muted border" style="font-size: 10px;">BELUM</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-3 text-muted">Belum ada data termin</td>
                                    </tr>
                                @endforelse
                            </tbody>
                            <tfoot class="table-light fw-bold">
                                <tr>
                                    <td class="ps-3">TOTAL KONTRAK</td>
                                    <td class="text-center">{{ $spk->termins->sum('persentase') }}%</td>
                                    <td class="text-end text-primary">{{ $spk->formatted_nilai_kontrak }}</td>
                                    <td></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Lampiran Dokumen Fisik -->
            <div class="card detail-card">
                <div class="detail-header">
                    <i class="mdi mdi-paperclip"></i>
                    <h5 class="detail-title">Berkas Fisik & Dokumen Pendukung</h5>
                </div>
                <div class="detail-body">
                    @if($spk->file_lampiran)
                        <div class="p-3 border rounded-3 bg-light d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center gap-2">
                                <i class="mdi mdi-file-pdf-box text-danger fs-2"></i>
                                <div>
                                    <h6 class="mb-0 fw-bold text-dark">{{ basename($spk->file_lampiran) }}</h6>
                                    <small class="text-muted">Berkas Scan SPK / Lampiran Fisik</small>
                                </div>
                            </div>
                            <a href="{{ asset($spk->file_lampiran) }}" target="_blank" class="btn btn-sm btn-primary">
                                <i class="mdi mdi-eye me-1"></i>Lihat File
                            </a>
                        </div>
                    @else
                        <div class="text-center py-4 text-muted">
                            <i class="mdi mdi-file-clock-outline fs-2 opacity-50"></i>
                            <p class="small mb-0 mt-1">Belum ada berkas fisik scan yang diunggah</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

</div>

@endsection
