@extends('layouts.partial.app')

@section('title', 'Edit SPK - ' . $spk->no_spk)

@section('content')

<style>
    .form-section-card {
        background: #ffffff;
        border-radius: 10px;
        border: none;
        box-shadow: 0 4px 18px rgba(0, 0, 0, 0.04);
        margin-bottom: 1.5rem;
    }

    .form-section-header {
        padding: 1rem 1.25rem;
        background: #fbf9ff;
        border-bottom: 1px solid #ebe5f5;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .form-section-header i {
        font-size: 1.25rem;
        color: #9a55ff;
    }

    .form-section-title {
        font-weight: 700;
        color: #2c2e3f;
        font-size: 1rem;
        margin: 0;
    }

    .form-section-body {
        padding: 1.25rem;
    }

    .termin-table th {
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #9a55ff;
        background: #fbf9ff;
    }

    .termin-table td {
        vertical-align: middle;
        padding: 0.5rem 0.5rem;
    }

    .btn-gradient-purple {
        background: linear-gradient(135deg, #da8cff, #9a55ff);
        color: #fff;
        border: none;
    }
    .btn-gradient-purple:hover {
        color: #fff;
        opacity: 0.9;
    }
</style>

<div class="container-fluid px-1 px-sm-2 px-md-3 py-2 py-md-3">

    <!-- Breadcrumb & Title -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h4 class="fw-bold text-dark mb-1">Edit Surat Perintah Kerja (SPK)</h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 small">
                    <li class="breadcrumb-item"><a href="{{ route('spk.index') }}" class="text-decoration-none">SPK Kontraktor</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit {{ $spk->no_spk }}</li>
                </ol>
            </nav>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('spk.cetak', $spk->id) }}" target="_blank" class="btn btn-sm btn-outline-success d-inline-flex align-items-center">
                <i class="mdi mdi-printer me-1"></i>Cetak SPK
            </a>
            <a href="{{ route('spk.index') }}" class="btn btn-sm btn-outline-secondary d-inline-flex align-items-center">
                <i class="mdi mdi-arrow-left me-1"></i>Kembali
            </a>
        </div>
    </div>

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-3" role="alert">
            <i class="mdi mdi-alert-circle me-2 fs-5 align-middle"></i>
            <strong>Terdapat kesalahan input:</strong>
            <ul class="mb-0 mt-1 small">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <form action="{{ route('spk.update', $spk->id) }}" method="POST" enctype="multipart/form-data" id="formSpk">
        @csrf
        @method('PUT')

        <!-- ========================================== -->
        <!-- 1. DATA UMUM & NOMOR SPK -->
        <!-- ========================================== -->
        <div class="card form-section-card">
            <div class="form-section-header">
                <i class="mdi mdi-file-document-outline"></i>
                <h5 class="form-section-title">1. Informasi Pokok SPK & Proyek</h5>
            </div>
            <div class="form-section-body">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label fw-semibold text-dark small">Nomor SPK <span class="text-danger">*</span></label>
                        <input type="text" name="no_spk" id="no_spk" class="form-control" value="{{ old('no_spk', $spk->no_spk) }}" required>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-semibold text-dark small">Tanggal SPK <span class="text-danger">*</span></label>
                        <input type="date" name="tanggal_spk" id="tanggal_spk" class="form-control" value="{{ old('tanggal_spk', $spk->tanggal_spk ? $spk->tanggal_spk->format('Y-m-d') : '') }}" required>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-semibold text-dark small">Jenis SPK <span class="text-danger">*</span></label>
                        <select name="jenis_spk" id="jenis_spk" class="form-select select2" required>
                            <option value="Pembangunan Unit" {{ old('jenis_spk', $spk->jenis_spk) == 'Pembangunan Unit' ? 'selected' : '' }}>Pembangunan Unit Rumah</option>
                            <option value="Infrastruktur Jalan & Drainase" {{ old('jenis_spk', $spk->jenis_spk) == 'Infrastruktur Jalan & Drainase' ? 'selected' : '' }}>Infrastruktur (Jalan, Paving, Saluran)</option>
                            <option value="Fasilitas Umum & Sarana" {{ old('jenis_spk', $spk->jenis_spk) == 'Fasilitas Umum & Sarana' ? 'selected' : '' }}>Fasilitas Umum (Pos, Gerbang, Taman, Masjid)</option>
                            <option value="Pematangan Lahan (Cut & Fill)" {{ old('jenis_spk', $spk->jenis_spk) == 'Pematangan Lahan (Cut & Fill)' ? 'selected' : '' }}>Pematangan Lahan (Cut & Fill / Talud)</option>
                            <option value="Pekerjaan Khusus / Subkon" {{ old('jenis_spk', $spk->jenis_spk) == 'Pekerjaan Khusus / Subkon' ? 'selected' : '' }}>Pekerjaan Khusus / Sub-Kontraktor</option>
                            <option value="Lainnya" {{ old('jenis_spk', $spk->jenis_spk) == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold text-dark small">Proyek Perumahan (Land Bank) <span class="text-danger">*</span></label>
                        <select name="land_bank_id" id="land_bank_id" class="form-select select2" required onchange="loadProjectUnits(this.value)">
                            <option value="">-- Pilih Proyek Perumahan --</option>
                            @foreach($landBanks as $lb)
                                <option value="{{ $lb->id }}" {{ old('land_bank_id', $spk->land_bank_id) == $lb->id ? 'selected' : '' }}>
                                    {{ $lb->name }} ({{ $lb->location ?? 'Lokasi Proyek' }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6" id="unit_kavling_container">
                        <label class="form-label fw-semibold text-dark small">Unit Kavling (Opsional)</label>
                        <select name="land_bank_unit_id" id="land_bank_unit_id" class="form-select select2" onchange="handleUnitSelect(this)">
                            <option value="">-- Pilih Unit Kavling (Opsional) --</option>
                            @if($spk->landBank && $spk->landBank->units)
                                @foreach($spk->landBank->units as $u)
                                    <option value="{{ $u->id }}" {{ old('land_bank_unit_id', $spk->land_bank_unit_id) == $u->id ? 'selected' : '' }}
                                            data-type="{{ $u->type }}" data-code="{{ $u->unit_code }}">
                                        Kav. {{ $u->unit_code }} (Type {{ $u->type }}) - {{ $u->unit_name ?? 'Unit' }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-semibold text-dark small">Nama / Judul Pekerjaan <span class="text-danger">*</span></label>
                        <input type="text" name="nama_pekerjaan" id="nama_pekerjaan" class="form-control" 
                               value="{{ old('nama_pekerjaan', $spk->nama_pekerjaan) }}" required>
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-semibold text-dark small">Deskripsi & Lingkup Pekerjaan</label>
                        <textarea name="deskripsi_pekerjaan" id="deskripsi_pekerjaan" class="form-control" rows="2">{{ old('deskripsi_pekerjaan', $spk->deskripsi_pekerjaan) }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        <!-- ========================================== -->
        <!-- 2. IDENTITAS PARA PIHAK -->
        <!-- ========================================== -->
        <div class="row">
            <!-- Pihak Pertama (Developer) -->
            <div class="col-lg-6">
                <div class="card form-section-card">
                    <div class="form-section-header">
                        <i class="mdi mdi-domain"></i>
                        <h5 class="form-section-title">2A. Pihak Pertama (Pemberi Tugas / Developer)</h5>
                    </div>
                    <div class="form-section-body">
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label fw-semibold text-dark small">Nama Perusahaan Developer</label>
                                <input type="text" name="pihak_pertama_perusahaan" class="form-control" 
                                       value="{{ old('pihak_pertama_perusahaan', $spk->pihak_pertama_perusahaan) }}">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold text-dark small">Nama Pejabat / Perwakilan</label>
                                <input type="text" name="pihak_pertama_nama" class="form-control" 
                                       value="{{ old('pihak_pertama_nama', $spk->pihak_pertama_nama) }}">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold text-dark small">Jabatan</label>
                                <input type="text" name="pihak_pertama_jabatan" class="form-control" 
                                       value="{{ old('pihak_pertama_jabatan', $spk->pihak_pertama_jabatan) }}">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold text-dark small">Telepon / WhatsApp</label>
                                <input type="text" name="pihak_pertama_telepon" class="form-control" 
                                       value="{{ old('pihak_pertama_telepon', $spk->pihak_pertama_telepon) }}">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold text-dark small">Alamat Kantor</label>
                                <input type="text" name="pihak_pertama_alamat" class="form-control" 
                                       value="{{ old('pihak_pertama_alamat', $spk->pihak_pertama_alamat) }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pihak Kedua (Kontraktor) -->
            <div class="col-lg-6">
                <div class="card form-section-card">
                    <div class="form-section-header">
                        <i class="mdi mdi-account-hard-hat"></i>
                        <h5 class="form-section-title">2B. Pihak Kedua (Kontraktor / Pemborong)</h5>
                    </div>
                    <div class="form-section-body">
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label fw-semibold text-dark small">Nama Kontraktor / Usaha <span class="text-danger">*</span></label>
                                <input type="text" name="kontraktor_nama" id="kontraktor_nama" class="form-control" 
                                       value="{{ old('kontraktor_nama', $spk->kontraktor_nama) }}" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold text-dark small">Nama Penanggung Jawab (PIC)</label>
                                <input type="text" name="kontraktor_pic" id="kontraktor_pic" class="form-control" 
                                       value="{{ old('kontraktor_pic', $spk->kontraktor_pic) }}">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold text-dark small">No. KTP PIC</label>
                                <input type="text" name="kontraktor_ktp" id="kontraktor_ktp" class="form-control" 
                                       value="{{ old('kontraktor_ktp', $spk->kontraktor_ktp) }}">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold text-dark small">No. HP / WhatsApp Kontraktor</label>
                                <input type="text" name="kontraktor_telepon" id="kontraktor_telepon" class="form-control" 
                                       value="{{ old('kontraktor_telepon', $spk->kontraktor_telepon) }}">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold text-dark small">Alamat Kontraktor</label>
                                <input type="text" name="kontraktor_alamat" id="kontraktor_alamat" class="form-control" 
                                       value="{{ old('kontraktor_alamat', $spk->kontraktor_alamat) }}">
                            </div>

                            <div class="col-md-4">
                                <label class="form-label fw-semibold text-dark small">Nama Bank</label>
                                <input type="text" name="kontraktor_bank" id="kontraktor_bank" class="form-control" 
                                       value="{{ old('kontraktor_bank', $spk->kontraktor_bank) }}">
                            </div>

                            <div class="col-md-4">
                                <label class="form-label fw-semibold text-dark small">No. Rekening</label>
                                <input type="text" name="kontraktor_rekening" id="kontraktor_rekening" class="form-control" 
                                       value="{{ old('kontraktor_rekening', $spk->kontraktor_rekening) }}">
                            </div>

                            <div class="col-md-4">
                                <label class="form-label fw-semibold text-dark small">Atas Nama Rekening</label>
                                <input type="text" name="kontraktor_atas_nama" id="kontraktor_atas_nama" class="form-control" 
                                       value="{{ old('kontraktor_atas_nama', $spk->kontraktor_atas_nama) }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ========================================== -->
        <!-- 3. FINANSIAL, WAKTU & STATUS -->
        <!-- ========================================== -->
        <div class="card form-section-card">
            <div class="form-section-header">
                <i class="mdi mdi-cash-multiple"></i>
                <h5 class="form-section-title">3. Nilai Kontrak & Waktu Pelaksanaan</h5>
            </div>
            <div class="form-section-body">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label fw-semibold text-dark small">Nilai Total Kontrak (Rp) <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text bg-light fw-bold">Rp</span>
                            <input type="text" name="nilai_kontrak" id="nilai_kontrak" class="form-control fw-bold text-primary" 
                                   value="{{ old('nilai_kontrak', number_format($spk->nilai_kontrak, 0, ',', '.')) }}" 
                                   required oninput="formatRupiahInput(this); calculateAllTermins(); updateTerbilang(this.value);">
                        </div>
                        <small class="text-muted d-block mt-1" id="terbilang_text"><em>Terbilang: {{ $spk->terbilang }}</em></small>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-semibold text-dark small">Tanggal Mulai Kerja <span class="text-danger">*</span></label>
                        <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="form-control" 
                               value="{{ old('tanggal_mulai', $spk->tanggal_mulai ? $spk->tanggal_mulai->format('Y-m-d') : '') }}" required onchange="calculateDurasi()">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-semibold text-dark small">Tanggal Target Selesai <span class="text-danger">*</span></label>
                        <input type="date" name="tanggal_selesai" id="tanggal_selesai" class="form-control" 
                               value="{{ old('tanggal_selesai', $spk->tanggal_selesai ? $spk->tanggal_selesai->format('Y-m-d') : '') }}" required onchange="calculateDurasi()">
                    </div>

                    <div class="col-md-3">
                        <label class="form-label fw-semibold text-dark small">Durasi Pelaksanaan (Hari)</label>
                        <div class="input-group">
                            <input type="number" name="durasi_hari" id="durasi_hari" class="form-control bg-light" value="{{ old('durasi_hari', $spk->durasi_hari) }}" readonly>
                            <span class="input-group-text bg-light">Hari Kalender</span>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label fw-semibold text-dark small">Sistem Pembayaran</label>
                        <select name="sistem_pembayaran" id="sistem_pembayaran" class="form-select select2">
                            <option value="termin" {{ old('sistem_pembayaran', $spk->sistem_pembayaran) == 'termin' ? 'selected' : '' }}>Bertahap (Termin Prestasi Fisik)</option>
                            <option value="opname" {{ old('sistem_pembayaran', $spk->sistem_pembayaran) == 'opname' ? 'selected' : '' }}>Opname Bulanan / Progres</option>
                            <option value="lumpsum" {{ old('sistem_pembayaran', $spk->sistem_pembayaran) == 'lumpsum' ? 'selected' : '' }}>Lumpsum (Sekali Bayar)</option>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label fw-semibold text-dark small">Status SPK</label>
                        <select name="status" id="status" class="form-select select2">
                            <option value="draft" {{ old('status', $spk->status) == 'draft' ? 'selected' : '' }}>Draft (Konsep)</option>
                            <option value="berjalan" {{ old('status', $spk->status) == 'berjalan' ? 'selected' : '' }}>Berjalan (Aktif)</option>
                            <option value="selesai" {{ old('status', $spk->status) == 'selesai' ? 'selected' : '' }}>Selesai</option>
                            <option value="dibatalkan" {{ old('status', $spk->status) == 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label fw-semibold text-dark small">Progress Saat Ini (%)</label>
                        <div class="input-group">
                            <input type="number" name="progress" min="0" max="100" class="form-control fw-bold" value="{{ old('progress', $spk->progress) }}">
                            <span class="input-group-text">%</span>
                        </div>
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-semibold text-dark small">Ganti / Unggah Berkas Fisik Lampiran (Opsional)</label>
                        <input type="file" name="file_lampiran" class="form-control" accept=".pdf,.jpg,.jpeg,.png,.docx">
                        @if($spk->file_lampiran)
                            <small class="text-success d-block mt-1">
                                <i class="mdi mdi-file-check-outline me-1"></i>Berkas saat ini: <a href="{{ asset($spk->file_lampiran) }}" target="_blank">{{ basename($spk->file_lampiran) }}</a>
                            </small>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- ========================================== -->
        <!-- 4. SKEMA TERMIN PEMBAYARAN DINAMIS -->
        <!-- ========================================== -->
        <div class="card form-section-card">
            <div class="form-section-header justify-content-between flex-wrap gap-2">
                <div class="d-flex align-items-center gap-2">
                    <i class="mdi mdi-table-clock"></i>
                    <h5 class="form-section-title">4. Skema & Jadwal Termin Pembayaran</h5>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <button type="button" class="btn btn-xs btn-gradient-purple py-1 px-2" onclick="addTerminRow()">
                        <i class="mdi mdi-plus me-1"></i>+ Tambah Baris
                    </button>
                </div>
            </div>
            <div class="form-section-body">
                <div class="table-responsive">
                    <table class="table table-bordered align-middle termin-table" id="terminTable">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 50px;">NO</th>
                                <th style="min-width: 200px;">TAHAP / URAIAN TERMIN</th>
                                <th class="text-center" style="width: 140px;">SYARAT PROGRES (%)</th>
                                <th class="text-center" style="width: 130px;">BOBOT (%)</th>
                                <th class="text-end" style="min-width: 170px;">NOMINAL (RP)</th>
                                <th class="text-center" style="width: 160px;">JATUH TEMPO</th>
                                <th class="text-center" style="width: 130px;">STATUS BAYAR</th>
                                <th style="min-width: 140px;">KETERANGAN</th>
                                <th class="text-center" style="width: 60px;">AKSI</th>
                            </tr>
                        </thead>
                        <tbody id="terminTableBody">
                            @foreach($spk->termins as $idx => $t)
                                <tr class="termin-row">
                                    <td class="text-center fw-bold text-muted termin-no">{{ $idx + 1 }}</td>
                                    <td>
                                        <input type="text" name="termins[{{ $idx }}][nama_tahap]" class="form-control form-control-sm" 
                                               value="{{ $t->nama_tahap }}" required>
                                    </td>
                                    <td>
                                        <div class="input-group input-group-sm">
                                            <input type="number" step="0.1" min="0" max="100" name="termins[{{ $idx }}][syarat_progress]" 
                                                   class="form-control text-center" value="{{ $t->syarat_progress }}">
                                            <span class="input-group-text">%</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="input-group input-group-sm">
                                            <input type="number" step="0.1" min="0" max="100" name="termins[{{ $idx }}][persentase]" 
                                                   class="form-control text-center termin-persen" value="{{ $t->persentase }}" 
                                                   oninput="calculateAllTermins();">
                                            <span class="input-group-text">%</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="input-group input-group-sm">
                                            <span class="input-group-text">Rp</span>
                                            <input type="text" name="termins[{{ $idx }}][nominal]" class="form-control text-end termin-nominal fw-semibold" 
                                                   value="{{ number_format($t->nominal, 0, ',', '.') }}" readonly>
                                        </div>
                                    </td>
                                    <td>
                                        <input type="date" name="termins[{{ $idx }}][tanggal_jatuh_tempo]" class="form-control form-control-sm" 
                                               value="{{ $t->tanggal_jatuh_tempo ? $t->tanggal_jatuh_tempo->format('Y-m-d') : '' }}">
                                    </td>
                                    <td>
                                        <select name="termins[{{ $idx }}][status_bayar]" class="form-select form-select-sm">
                                            <option value="belum_dibayar" {{ $t->status_bayar == 'belum_dibayar' ? 'selected' : '' }}>Belum Bayar</option>
                                            <option value="proses" {{ $t->status_bayar == 'proses' ? 'selected' : '' }}>Proses</option>
                                            <option value="lunas" {{ $t->status_bayar == 'lunas' ? 'selected' : '' }}>Lunas</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="text" name="termins[{{ $idx }}][keterangan]" class="form-control form-control-sm" 
                                               value="{{ $t->keterangan }}">
                                    </td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-sm btn-outline-danger p-1" onclick="removeTerminRow(this)" title="Hapus Baris">
                                            <i class="mdi mdi-close"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="table-light fw-bold">
                                <td colspan="3" class="text-end">TOTAL BOBOT & NOMINAL:</td>
                                <td class="text-center">
                                    <span id="totalPersentaseBadge" class="badge bg-success fs-6">100%</span>
                                </td>
                                <td class="text-end">
                                    <span id="totalNominalText" class="text-primary fs-6">Rp 0</span>
                                </td>
                                <td colspan="4">
                                    <small id="terminStatusNote" class="text-success fw-semibold">
                                        <i class="mdi mdi-check-circle me-1"></i>Total persentase pas 100%
                                    </small>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

        <!-- ========================================== -->
        <!-- 5. KLAUSUL PASAL & PERJANJIAN SPK -->
        <!-- ========================================== -->
        <div class="card form-section-card">
            <div class="form-section-header">
                <i class="mdi mdi-gavel"></i>
                <h5 class="form-section-title">5. Klausul Ketentuan & Pasal Perjanjian SPK</h5>
            </div>
            <div class="form-section-body">
                <div class="mb-3">
                    <label class="form-label fw-semibold text-dark small">Draft Pasal Perjanjian</label>
                    <textarea name="pasal_syarat_ketentuan" id="pasal_syarat_ketentuan" class="form-control" rows="8" style="font-family: inherit; font-size: 0.9rem;">{{ old('pasal_syarat_ketentuan', $spk->pasal_syarat_ketentuan) }}</textarea>
                </div>

                <div>
                    <label class="form-label fw-semibold text-dark small">Catatan Tambahan / Keterangan Khusus</label>
                    <textarea name="keterangan" id="keterangan" class="form-control" rows="2">{{ old('keterangan', $spk->keterangan) }}</textarea>
                </div>
            </div>
        </div>

        <!-- Tombol Aksi Submit -->
        <div class="d-flex justify-content-end align-items-center gap-2 mb-5">
            <a href="{{ route('spk.index') }}" class="btn btn-secondary px-4 py-2">Batal</a>
            <button type="submit" class="btn btn-gradient-primary px-5 py-2 fw-semibold text-white shadow-sm" style="background: linear-gradient(to right, #da8cff, #9a55ff); border: none;">
                <i class="mdi mdi-content-save-check-outline me-1 fs-6 align-middle"></i>Perbarui SPK
            </button>
        </div>

    </form>

</div>

@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        if ($('.select2').length) {
            $('.select2').select2({
                theme: 'bootstrap-5',
                width: '100%'
            });
        }

        calculateAllTermins();
        calculateDurasi();
    });

    function formatRupiahInput(el) {
        let val = el.value.replace(/[^0-9]/g, '');
        if (!val) {
            el.value = '';
            return;
        }
        el.value = new Intl.NumberFormat('id-ID').format(val);
    }

    function getRawNumber(str) {
        if (!str) return 0;
        return parseFloat(str.toString().replace(/[^0-9]/g, '')) || 0;
    }

    function updateTerbilang(val) {
        const num = getRawNumber(val);
        if (num === 0) {
            document.getElementById('terbilang_text').innerHTML = '<em>Terbilang: Nol Rupiah</em>';
            return;
        }
        const text = terbilang(num) + ' Rupiah';
        document.getElementById('terbilang_text').innerHTML = `<strong class="text-dark">Terbilang:</strong> <span class="text-primary fw-semibold">${text}</span>`;
    }

    function terbilang(n) {
        const bilangan = ['', 'Satu', 'Dua', 'Tiga', 'Empat', 'Lima', 'Enam', 'Tujuh', 'Delapan', 'Sembilan', 'Sepuluh', 'Sebelas'];
        let temp = '';
        if (n < 12) {
            temp = bilangan[n];
        } else if (n < 20) {
            temp = terbilang(n - 10) + ' Belas';
        } else if (n < 100) {
            temp = terbilang(Math.floor(n / 10)) + ' Puluh ' + terbilang(n % 10);
        } else if (n < 200) {
            temp = 'Seratus ' + terbilang(n - 100);
        } else if (n < 1000) {
            temp = terbilang(Math.floor(n / 100)) + ' Ratus ' + terbilang(n % 100);
        } else if (n < 2000) {
            temp = 'Seribu ' + terbilang(n - 1000);
        } else if (n < 1000000) {
            temp = terbilang(Math.floor(n / 1000)) + ' Ribu ' + terbilang(n % 1000);
        } else if (n < 1000000000) {
            temp = terbilang(Math.floor(n / 1000000)) + ' Juta ' + terbilang(n % 1000000);
        } else if (n < 1000000000000) {
            temp = terbilang(Math.floor(n / 1000000000)) + ' Milyar ' + terbilang(n % 1000000000);
        } else {
            temp = terbilang(Math.floor(n / 1000000000000)) + ' Triliun ' + terbilang(n % 1000000000000);
        }
        return temp.trim();
    }

    function calculateDurasi() {
        const start = document.getElementById('tanggal_mulai').value;
        const end = document.getElementById('tanggal_selesai').value;
        if (start && end) {
            const startDate = new Date(start);
            const endDate = new Date(end);
            const diffTime = endDate - startDate;
            const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)) + 1;
            document.getElementById('durasi_hari').value = diffDays > 0 ? diffDays : 1;
        }
    }

    function loadProjectUnits(landBankId) {
        const unitSelect = $('#land_bank_unit_id');
        unitSelect.empty().append('<option value="">-- Memuat data kavling... --</option>');

        if (!landBankId) {
            unitSelect.empty().append('<option value="">-- Pilih Unit Kavling (Opsional) --</option>');
            return;
        }

        $.ajax({
            url: `/api/spk/project-units/${landBankId}`,
            type: 'GET',
            success: function(res) {
                unitSelect.empty().append('<option value="">-- Pilih Unit Kavling (Opsional) --</option>');
                if (res.success && res.units.length > 0) {
                    res.units.forEach(u => {
                        unitSelect.append(`
                            <option value="${u.id}" data-type="${u.type || ''}" data-code="${u.unit_code}">
                                Kav. ${u.unit_code} (Type ${u.type || '-'}) - ${u.unit_name || 'Unit'}
                            </option>
                        `);
                    });
                }
                unitSelect.trigger('change');
            }
        });
    }

    function addTerminRow() {
        const tbody = document.getElementById('terminTableBody');
        const count = tbody.querySelectorAll('tr').length;
        const rowIdx = count;

        const tr = document.createElement('tr');
        tr.className = 'termin-row';
        tr.innerHTML = `
            <td class="text-center fw-bold text-muted termin-no">${rowIdx + 1}</td>
            <td>
                <input type="text" name="termins[${rowIdx}][nama_tahap]" class="form-control form-control-sm" 
                       value="Termin ${rowIdx + 1}" required>
            </td>
            <td>
                <div class="input-group input-group-sm">
                    <input type="number" step="0.1" min="0" max="100" name="termins[${rowIdx}][syarat_progress]" 
                           class="form-control text-center" value="0">
                    <span class="input-group-text">%</span>
                </div>
            </td>
            <td>
                <div class="input-group input-group-sm">
                    <input type="number" step="0.1" min="0" max="100" name="termins[${rowIdx}][persentase]" 
                           class="form-control text-center termin-persen" value="0" 
                           oninput="calculateAllTermins();">
                    <span class="input-group-text">%</span>
                </div>
            </td>
            <td>
                <div class="input-group input-group-sm">
                    <span class="input-group-text">Rp</span>
                    <input type="text" name="termins[${rowIdx}][nominal]" class="form-control text-end termin-nominal fw-semibold" 
                           value="0" readonly>
                </div>
            </td>
            <td>
                <input type="date" name="termins[${rowIdx}][tanggal_jatuh_tempo]" class="form-control form-control-sm">
            </td>
            <td>
                <select name="termins[${rowIdx}][status_bayar]" class="form-select form-select-sm">
                    <option value="belum_dibayar">Belum Bayar</option>
                    <option value="proses">Proses</option>
                    <option value="lunas">Lunas</option>
                </select>
            </td>
            <td>
                <input type="text" name="termins[${rowIdx}][keterangan]" class="form-control form-control-sm">
            </td>
            <td class="text-center">
                <button type="button" class="btn btn-sm btn-outline-danger p-1" onclick="removeTerminRow(this)" title="Hapus Baris">
                    <i class="mdi mdi-close"></i>
                </button>
            </td>
        `;

        tbody.appendChild(tr);
        renumberTermins();
        calculateAllTermins();
    }

    function removeTerminRow(btn) {
        btn.closest('tr').remove();
        renumberTermins();
        calculateAllTermins();
    }

    function renumberTermins() {
        const rows = document.querySelectorAll('.termin-row');
        rows.forEach((r, i) => {
            r.querySelector('.termin-no').textContent = i + 1;
        });
    }

    function calculateAllTermins() {
        const totalKontrak = getRawNumber(document.getElementById('nilai_kontrak').value);
        let totalPersen = 0;
        let totalNominal = 0;

        const rows = document.querySelectorAll('.termin-row');
        rows.forEach(r => {
            const persenInput = r.querySelector('.termin-persen');
            const nominalInput = r.querySelector('.termin-nominal');
            const persen = parseFloat(persenInput.value) || 0;

            const nom = Math.round((persen / 100) * totalKontrak);
            nominalInput.value = new Intl.NumberFormat('id-ID').format(nom);

            totalPersen += persen;
            totalNominal += nom;
        });

        const badge = document.getElementById('totalPersentaseBadge');
        badge.textContent = `${totalPersen.toFixed(1)}%`;

        document.getElementById('totalNominalText').textContent = 'Rp ' + new Intl.NumberFormat('id-ID').format(totalNominal);

        const note = document.getElementById('terminStatusNote');
        if (Math.abs(totalPersen - 100) < 0.01) {
            badge.className = 'badge bg-success fs-6';
            note.className = 'text-success fw-semibold';
            note.innerHTML = '<i class="mdi mdi-check-circle me-1"></i>Total persentase pas 100%';
        } else {
            badge.className = 'badge bg-danger fs-6';
            note.className = 'text-danger fw-semibold';
            note.innerHTML = `<i class="mdi mdi-alert-circle me-1"></i>Total persentase ${totalPersen.toFixed(1)}% (Harus 100%)`;
        }
    }
</script>
@endpush
