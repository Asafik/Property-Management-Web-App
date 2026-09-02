@extends('layouts.partial.app')

@section('title', 'Buat SPK Baru - Property Management App')

@section('content')

<style>
    .form-section-card {
        background: #ffffff;
        border-radius: 12px;
        border: 1px solid #f1f5f9;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
        margin-bottom: 1.5rem;
        overflow: hidden;
    }

    .form-section-header {
        padding: 1rem 1.4rem;
        background: linear-gradient(135deg, #faf7ff, #f4edff);
        border-bottom: 1px solid #ede4ff;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .section-icon-box {
        width: 36px;
        height: 36px;
        border-radius: 8px;
        background: #ffffff;
        color: #9a55ff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
        box-shadow: 0 2px 8px rgba(154, 85, 255, 0.15);
    }

    .form-section-title {
        font-weight: 700;
        color: #2c2e3f;
        font-size: 1.02rem;
        margin: 0;
    }

    .form-section-body {
        padding: 1.4rem;
    }

    .form-label {
        font-weight: 600;
        font-size: 0.84rem;
        color: #334155;
        margin-bottom: 0.4rem;
    }

    .form-control, .form-select {
        border-radius: 8px;
        border: 1.5px solid #e2e8f0;
        font-size: 0.88rem;
        padding: 0.55rem 0.85rem;
        transition: all 0.2s ease;
    }

    textarea.form-control {
        height: auto !important;
        min-height: 100px !important;
    }

    #pasal_syarat_ketentuan {
        min-height: 420px !important;
        height: 420px !important;
        line-height: 1.75 !important;
        font-size: 0.9rem !important;
        background-color: #fcfdfe !important;
        border: 1.5px solid #cbd5e1 !important;
        padding: 1rem !important;
        resize: vertical !important;
    }

    #deskripsi_pekerjaan {
        min-height: 90px !important;
        height: 90px !important;
    }

    #keterangan {
        min-height: 90px !important;
        height: 90px !important;
    }

    .form-control:focus, .form-select:focus {
        border-color: #9a55ff;
        box-shadow: 0 0 0 3px rgba(154, 85, 255, 0.12);
    }

    .input-group-text {
        border: 1.5px solid #e2e8f0;
        border-radius: 8px;
        background: #f8fafc;
        font-weight: 600;
    }

    .termin-table th {
        font-size: 0.78rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #7c3aed;
        background: #fbf9ff;
        padding: 0.75rem 0.6rem;
    }

    .termin-table td {
        vertical-align: middle;
        padding: 0.6rem 0.6rem;
    }

    .btn-gradient-purple {
        background: linear-gradient(135deg, #da8cff, #9a55ff);
        color: #fff;
        border: none;
        box-shadow: 0 2px 6px rgba(154, 85, 255, 0.2);
    }
    .btn-gradient-purple:hover {
        color: #fff;
        opacity: 0.92;
        transform: translateY(-1px);
    }

    /* Animasi spin untuk tombol refresh nomor SPK */
    @keyframes spin {
        from { transform: rotate(0deg); }
        to   { transform: rotate(360deg); }
    }
    .spin-animation {
        animation: spin 0.6s linear infinite;
        display: inline-block;
    }

    /* Style nomor SPK auto-generated */
    #no_spk[readonly] {
        border-color: #cbd5e1;
        letter-spacing: 0.5px;
        background: #f8fafc;
        color: #7c3aed;
        font-weight: 700;
    }
    #no_spk[readonly]:focus {
        box-shadow: 0 0 0 3px rgba(154, 85, 255, 0.12);
        border-color: #9a55ff;
    }
</style>

<div class="container-fluid px-1 px-sm-2 px-md-3 py-2 py-md-3">

    <!-- Header Card Banner -->
    <div class="row mb-3 mb-md-4">
        <div class="col-12">
            <div class="card shadow-sm border-0 header-card" style="border-radius: 12px; background: #ffffff;">
                <div class="card-body p-3 p-md-4 d-flex justify-content-between align-items-center flex-wrap gap-3">
                    <div>
                        <div class="d-flex align-items-center gap-2 mb-1">
                            <span class="badge px-2.5 py-1" style="background: rgba(154, 85, 255, 0.1); color: #9a55ff; font-weight: 600; font-size: 0.78rem; border-radius: 6px;">
                                <i class="mdi mdi-file-sign me-1"></i>Modul Kontrak Kerja
                            </span>
                            <span class="text-muted small">|</span>
                            <span class="text-muted small">SPK Kontraktor</span>
                        </div>
                        <h3 class="text-dark mb-1 fw-bold" style="font-size: 1.35rem;">
                            Buat Surat Perintah Kerja (SPK)
                        </h3>
                        <p class="text-muted mb-0" style="font-size: 0.88rem;">
                            Penerbitan surat perintah kerja resmi antara developer dan mitra kontraktor/pemborong
                        </p>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <a href="{{ route('spk.index') }}" class="btn btn-outline-secondary btn-sm px-3 py-2 d-inline-flex align-items-center gap-1.5" style="border-radius: 8px; font-weight: 600;">
                            <i class="mdi mdi-arrow-left fs-6"></i> Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-3" role="alert" style="border-radius: 10px;">
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

    <form action="{{ route('spk.store') }}" method="POST" enctype="multipart/form-data" id="formSpk">
        @csrf

        <!-- ========================================== -->
        <!-- 1. DATA UMUM & NOMOR SPK -->
        <!-- ========================================== -->
        <div class="card form-section-card">
            <div class="form-section-header">
                <div class="section-icon-box">
                    <i class="mdi mdi-file-document-outline"></i>
                </div>
                <h5 class="form-section-title">1. Informasi Pokok SPK & Proyek</h5>
            </div>
            <div class="form-section-body">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label fw-semibold text-dark small">
                            Nomor SPK <span class="text-danger">*</span>
                            <span class="badge bg-success ms-1" style="font-size: 9px; vertical-align: middle;">AUTO</span>
                        </label>
                        <div class="input-group">
                            <input type="text" name="no_spk" id="no_spk" class="form-control fw-bold font-monospace"
                                   value="{{ old('no_spk', $defaultNoSpk) }}" required readonly
                                   style="background: #f8f9fa; color: #0d6efd; cursor: default; font-size: 13px;">
                            <button type="button" class="btn btn-outline-secondary" id="btnRefreshNoSpk" title="Generate ulang nomor SPK" onclick="refreshNoSpk()">
                                <i class="mdi mdi-refresh" id="iconRefreshSpk"></i>
                            </button>
                        </div>
                        <small class="text-muted">Nomor otomatis berdasarkan jenis & proyek. Klik <i class="mdi mdi-refresh"></i> untuk generate ulang.</small>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-semibold text-dark small">Tanggal SPK <span class="text-danger">*</span></label>
                        <input type="date" name="tanggal_spk" id="tanggal_spk" class="form-control" value="{{ old('tanggal_spk', date('Y-m-d')) }}" required>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-semibold text-dark small">Jenis SPK <span class="text-danger">*</span></label>
                        <select name="jenis_spk" id="jenis_spk" class="form-select select2" required onchange="handleJenisSpkChange(this.value)">
                            <option value="Pembangunan Unit" {{ old('jenis_spk') == 'Pembangunan Unit' ? 'selected' : '' }}>Pembangunan Unit Rumah</option>
                            <option value="Infrastruktur Jalan & Drainase" {{ old('jenis_spk') == 'Infrastruktur Jalan & Drainase' ? 'selected' : '' }}>Infrastruktur (Jalan, Paving, Saluran)</option>
                            <option value="Fasilitas Umum & Sarana" {{ old('jenis_spk') == 'Fasilitas Umum & Sarana' ? 'selected' : '' }}>Fasilitas Umum (Pos, Gerbang, Taman, Masjid)</option>
                            <option value="Pematangan Lahan (Cut & Fill)" {{ old('jenis_spk') == 'Pematangan Lahan (Cut & Fill)' ? 'selected' : '' }}>Pematangan Lahan (Cut & Fill / Talud)</option>
                            <option value="Pekerjaan Khusus / Subkon" {{ old('jenis_spk') == 'Pekerjaan Khusus / Subkon' ? 'selected' : '' }}>Pekerjaan Khusus / Sub-Kontraktor</option>
                            <option value="Lainnya" {{ old('jenis_spk') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold text-dark small">Proyek Perumahan (Land Bank) <span class="text-danger">*</span></label>
                        <select name="land_bank_id" id="land_bank_id" class="form-select select2" required>
                            <option value="">-- Pilih Proyek Perumahan --</option>
                            @foreach($landBanks as $lb)
                                <option value="{{ $lb->id }}" {{ old('land_bank_id', request('land_bank_id')) == $lb->id ? 'selected' : '' }}>
                                    {{ $lb->name }} ({{ $lb->location ?? 'Lokasi Proyek' }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6" id="unit_kavling_container">
                        <label class="form-label fw-semibold text-dark small">Unit Kavling (Opsional / Jika Ada)</label>
                        <select name="land_bank_unit_id" id="land_bank_unit_id" class="form-select select2" onchange="handleUnitSelect(this)">
                            <option value="">-- Pilih Unit Kavling (Opsional) --</option>
                        </select>
                        <small class="text-muted">Pilih jika SPK ditujukan untuk pembangunan unit kavling tertentu</small>
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-semibold text-dark small">Nama / Judul Pekerjaan <span class="text-danger">*</span></label>
                        <input type="text" name="nama_pekerjaan" id="nama_pekerjaan" class="form-control" 
                               placeholder="Nama pekerjaan..." 
                               value="{{ old('nama_pekerjaan') }}" required>
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-semibold text-dark small">Deskripsi & Lingkup Pekerjaan</label>
                        <textarea name="deskripsi_pekerjaan" id="deskripsi_pekerjaan" class="form-control" rows="2" 
                                  placeholder="Deskripsi lingkup pekerjaan...">{{ old('deskripsi_pekerjaan') }}</textarea>
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
                <div class="card form-section-card h-100">
                    <div class="form-section-header">
                        <div class="section-icon-box">
                            <i class="mdi mdi-domain"></i>
                        </div>
                        <h5 class="form-section-title">2A. Pihak Pertama (Developer)</h5>
                    </div>
                    <div class="form-section-body">
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label">Nama Perusahaan Developer</label>
                                <input type="text" name="pihak_pertama_perusahaan" class="form-control" 
                                       value="{{ old('pihak_pertama_perusahaan', $companySetting->company_name ?? ($companyProfile->name ?? 'PT. PROPERTI MANAJEMEN INDONESIA')) }}">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Nama Pejabat / Perwakilan</label>
                                <input type="text" name="pihak_pertama_nama" class="form-control" 
                                       value="{{ old('pihak_pertama_nama', auth()->user()->name ?? 'Direktur Utama') }}">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Jabatan</label>
                                <input type="text" name="pihak_pertama_jabatan" class="form-control" 
                                       value="{{ old('pihak_pertama_jabatan', 'Direktur Utama / Project Manager') }}">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Telepon / WhatsApp</label>
                                <input type="text" name="pihak_pertama_telepon" class="form-control" 
                                       value="{{ old('pihak_pertama_telepon', $companySetting->phone ?? ($companySetting->whatsapp ?? '-')) }}">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Alamat Kantor</label>
                                <input type="text" name="pihak_pertama_alamat" class="form-control" 
                                       value="{{ old('pihak_pertama_alamat', $companySetting->address ?? ($companyProfile->address ?? '-')) }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pihak Kedua (Kontraktor) -->
            <div class="col-lg-6">
                <div class="card form-section-card h-100">
                    <div class="form-section-header">
                        <div class="section-icon-box">
                            <i class="mdi mdi-account-hard-hat"></i>
                        </div>
                        <h5 class="form-section-title">2B. Pihak Kedua (Kontraktor)</h5>
                    </div>
                    <div class="form-section-body">
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label">Nama Kontraktor / Usaha <span class="text-danger">*</span></label>
                                <input type="text" name="kontraktor_nama" id="kontraktor_nama" class="form-control" 
                                       placeholder="Nama kontraktor / pemborong..." value="{{ old('kontraktor_nama') }}" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Nama Penanggung Jawab (PIC)</label>
                                <input type="text" name="kontraktor_pic" id="kontraktor_pic" class="form-control" 
                                       placeholder="Nama PIC..." value="{{ old('kontraktor_pic') }}">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">No. KTP PIC</label>
                                <input type="text" name="kontraktor_ktp" id="kontraktor_ktp" class="form-control" 
                                       placeholder="Nomor KTP..." value="{{ old('kontraktor_ktp') }}">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">No. HP / WhatsApp Kontraktor</label>
                                <input type="text" name="kontraktor_telepon" id="kontraktor_telepon" class="form-control" 
                                       placeholder="Nomor telepon..." value="{{ old('kontraktor_telepon') }}">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Alamat Kontraktor</label>
                                <input type="text" name="kontraktor_alamat" id="kontraktor_alamat" class="form-control" 
                                       placeholder="Alamat domisili..." value="{{ old('kontraktor_alamat') }}">
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Nama Bank</label>
                                <input type="text" name="kontraktor_bank" id="kontraktor_bank" class="form-control" 
                                       placeholder="Nama bank..." value="{{ old('kontraktor_bank') }}">
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">No. Rekening</label>
                                <input type="text" name="kontraktor_rekening" id="kontraktor_rekening" class="form-control" 
                                       placeholder="Nomor rekening..." value="{{ old('kontraktor_rekening') }}">
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Atas Nama Rekening</label>
                                <input type="text" name="kontraktor_atas_nama" id="kontraktor_atas_nama" class="form-control" 
                                       placeholder="Atas nama rekening..." value="{{ old('kontraktor_atas_nama') }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ========================================== -->
        <!-- 3. FINANSIAL, WAKTU & SISTEM PEMBAYARAN -->
        <!-- ========================================== -->
        <div class="card form-section-card">
            <div class="form-section-header">
                <div class="section-icon-box">
                    <i class="mdi mdi-cash-multiple"></i>
                </div>
                <h5 class="form-section-title">3. Nilai Kontrak & Waktu Pelaksanaan</h5>
            </div>
            <div class="form-section-body">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Nilai Total Kontrak (Rp) <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="text" name="nilai_kontrak" id="nilai_kontrak" class="form-control fw-bold text-primary" 
                                   placeholder="0" value="{{ old('nilai_kontrak') }}" required oninput="formatRupiahInput(this); calculateAllTermins(); updateTerbilang(this.value);">
                        </div>
                        <small class="text-muted d-block mt-1" id="terbilang_text"><em>Terbilang: Nol Rupiah</em></small>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Tanggal Mulai Kerja <span class="text-danger">*</span></label>
                        <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="form-control" 
                               value="{{ old('tanggal_mulai', date('Y-m-d')) }}" required onchange="calculateDurasi()">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Tanggal Target Selesai <span class="text-danger">*</span></label>
                        <input type="date" name="tanggal_selesai" id="tanggal_selesai" class="form-control" 
                               value="{{ old('tanggal_selesai', date('Y-m-d', strtotime('+90 days'))) }}" required onchange="calculateDurasi()">
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Durasi Pelaksanaan (Hari)</label>
                        <div class="input-group">
                            <input type="number" name="durasi_hari" id="durasi_hari" class="form-control bg-light" value="{{ old('durasi_hari', 90) }}" readonly>
                            <span class="input-group-text">Hari</span>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Sistem Pembayaran</label>
                        <select name="sistem_pembayaran" id="sistem_pembayaran" class="form-select select2">
                            <option value="termin" {{ old('sistem_pembayaran') == 'termin' ? 'selected' : '' }}>Bertahap (Termin Prestasi Fisik)</option>
                            <option value="opname" {{ old('sistem_pembayaran') == 'opname' ? 'selected' : '' }}>Opname Bulanan / Progres</option>
                            <option value="lumpsum" {{ old('sistem_pembayaran') == 'lumpsum' ? 'selected' : '' }}>Lumpsum (Sekali Bayar)</option>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Status SPK</label>
                        <select name="status" id="status" class="form-select select2">
                            <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft (Konsep)</option>
                            <option value="berjalan" {{ old('status') == 'berjalan' ? 'selected' : 'selected' }}>Berjalan (Aktif)</option>
                            <option value="selesai" {{ old('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                            <option value="dibatalkan" {{ old('status') == 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Upload Berkas Fisik / Lampiran</label>
                        <input type="file" name="file_lampiran" class="form-control" accept=".pdf,.jpg,.jpeg,.png,.docx">
                        <small class="text-muted">PDF / Gambar scan bermaterai (Maks 15MB)</small>
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
                    <div class="section-icon-box">
                        <i class="mdi mdi-table-clock"></i>
                    </div>
                    <h5 class="form-section-title">4. Skema & Jadwal Termin Pembayaran</h5>
                </div>
                <div class="d-flex align-items-center gap-2 flex-wrap">
                    <button type="button" class="btn btn-sm btn-outline-primary py-1.5 px-3 d-inline-flex align-items-center gap-1" style="border-radius: 8px; font-weight: 600;" onclick="applyPresetTermin('standar')">
                        <i class="mdi mdi-flash"></i>Preset Standar Rumah (5 Tahap)
                    </button>
                    <button type="button" class="btn btn-sm btn-outline-info py-1.5 px-3 d-inline-flex align-items-center gap-1" style="border-radius: 8px; font-weight: 600;" onclick="applyPresetTermin('infra')">
                        <i class="mdi mdi-flash"></i>Preset Infrastruktur (4 Tahap)
                    </button>
                    <button type="button" class="btn btn-sm btn-gradient-purple py-1.5 px-3 d-inline-flex align-items-center gap-1" style="border-radius: 8px; font-weight: 600;" onclick="addTerminRow()">
                        <i class="mdi mdi-plus"></i>Tambah Baris
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
                                <th style="min-width: 150px;">KETERANGAN</th>
                                <th class="text-center" style="width: 60px;">AKSI</th>
                            </tr>
                        </thead>
                        <tbody id="terminTableBody">
                            <!-- Rows will be injected by JavaScript -->
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
                                <td colspan="3">
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
            <div class="form-section-header justify-content-between flex-wrap gap-2">
                <div class="d-flex align-items-center gap-2">
                    <div class="section-icon-box">
                        <i class="mdi mdi-gavel"></i>
                    </div>
                    <h5 class="form-section-title">5. Klausul Ketentuan & Pasal Perjanjian SPK</h5>
                </div>
                <small class="text-muted"><i class="mdi mdi-shield-check-outline me-1"></i>Draft Klausul Standar Developer</small>
            </div>
            <div class="form-section-body">
                <div class="mb-3">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <label class="form-label mb-0">Isi Pasal & Ketentuan Kontrak (Dapat diedit sesuai kesepakatan)</label>
                    </div>
                    <textarea name="pasal_syarat_ketentuan" id="pasal_syarat_ketentuan" class="form-control" rows="12" 
                              style="font-family: inherit; font-size: 0.88rem; line-height: 1.65; background-color: #fcfdfe; border-color: #cbd5e1;">{{ old('pasal_syarat_ketentuan', $defaultPasal) }}</textarea>
                    <small class="text-muted d-block mt-1">
                        <i class="mdi mdi-information-outline me-1"></i>Klausul pasal di atas akan tercetak otomatis pada lembar resmi Surat Perintah Kerja (SPK).
                    </small>
                </div>

                <div>
                    <label class="form-label">Catatan Tambahan / Keterangan Khusus</label>
                    <textarea name="keterangan" id="keterangan" class="form-control" rows="3" placeholder="Catatan tambahan (opsional)...">{{ old('keterangan') }}</textarea>
                </div>
            </div>
        </div>

        <!-- Tombol Aksi Submit Footer Card -->
        <div class="card shadow-sm border-0 mb-5" style="border-radius: 12px; background: #ffffff;">
            <div class="card-body p-3 d-flex justify-content-between align-items-center flex-wrap gap-3">
                <a href="{{ route('spk.index') }}" class="btn btn-outline-secondary px-3 py-2 d-inline-flex align-items-center gap-1.5" style="border-radius: 8px; font-weight: 600;">
                    <i class="mdi mdi-arrow-left"></i> Kembali ke Daftar SPK
                </a>
                <div class="d-flex align-items-center gap-2">
                    <a href="{{ route('spk.index') }}" class="btn btn-light px-4 py-2" style="border-radius: 8px; font-weight: 600; color: #64748b; border: 1px solid #e2e8f0;">
                        Batal
                    </a>
                    <button type="submit" class="btn btn-gradient-primary px-4 py-2.5 fw-bold text-white shadow-sm d-inline-flex align-items-center gap-2" style="background: linear-gradient(135deg, #da8cff, #9a55ff); border: none; border-radius: 8px;">
                        <i class="mdi mdi-content-save-check-outline fs-5"></i>
                        <span>Simpan & Terbitkan SPK</span>
                    </button>
                </div>
            </div>
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

        // Apply default preset on initial load
        applyPresetTermin('standar');
        calculateDurasi();

        // Auto-load kavling jika land_bank_id sudah dipilih via URL param
        const preselectedLandBank = $('#land_bank_id').val();
        if (preselectedLandBank) {
            loadProjectUnits(preselectedLandBank);
        }

        // Re-generate nomor SPK otomatis saat jenis atau proyek berubah
        $('#jenis_spk').on('change', function() {
            refreshNoSpk();
        });
        $('#land_bank_id').on('change', function() {
            loadProjectUnits(this.value);
            refreshNoSpk();
        });
    });

    // Auto-generate Nomor SPK seperti invoice
    function refreshNoSpk() {
        const jenisSpk  = $('#jenis_spk').val() || '';
        const landBankId = $('#land_bank_id').val() || '';

        const icon = $('#iconRefreshSpk');
        icon.addClass('spin-animation');

        $.ajax({
            url: '/api/spk/generate-number',
            type: 'GET',
            data: { jenis_spk: jenisSpk, land_bank_id: landBankId },
            success: function(res) {
                if (res.success) {
                    $('#no_spk').val(res.no_spk);
                }
            },
            error: function() {
                // Fallback: biarkan nomor yang sudah ada
            },
            complete: function() {
                icon.removeClass('spin-animation');
            }
        });
    }

    // 1. Format Rupiah Input
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

    // 2. Terbilang Rupiah Helper
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

    // 3. Hitung Durasi Hari
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

    // 4. AJAX Load Kavling berdasarkan Proyek
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
                            <option value="${u.id}" data-type="${u.type || ''}" data-code="${u.unit_code}" data-name="${u.unit_name || ''}">
                                Kav. ${u.unit_code} (Type ${u.type || '-'}) - ${u.unit_name || 'Unit'}
                            </option>
                        `);
                    });
                }
                unitSelect.trigger('change');
            },
            error: function() {
                unitSelect.empty().append('<option value="">-- Gagal memuat kavling --</option>');
            }
        });
    }

    // 5. Handle Unit Select -> Update Nama Pekerjaan
    function handleUnitSelect(select) {
        const selected = $(select).find(':selected');
        const unitCode = selected.data('code');
        const unitType = selected.data('type');
        
        if (unitCode) {
            const currentJob = document.getElementById('nama_pekerjaan');
            if (!currentJob.value || currentJob.value.includes('Pembangunan')) {
                currentJob.value = `Pembangunan 1 Unit Rumah Type ${unitType || ''} Kavling ${unitCode}`;
            }
        }
    }

    function handleJenisSpkChange(val) {
        const container = document.getElementById('unit_kavling_container');
        if (val === 'Pembangunan Unit') {
            container.style.display = 'block';
        } else {
            // tetep keliatan tapi opsional
            container.style.display = 'block';
        }
    }

    // 6. Termin Builder & Presets
    const terminPresets = {
        standar: [
            { nama: 'Termin I (DP & Pekerjaan Pondasi)', progress: 20, persen: 20 },
            { nama: 'Termin II (Struktur & Dinding Pasangan)', progress: 50, persen: 30 },
            { nama: 'Termin III (Rangka Atap & Plesteran)', progress: 80, persen: 25 },
            { nama: 'Termin IV (Finishing & BAST-1)', progress: 100, persen: 20 },
            { nama: 'Termin V (Retensi Garansi Pemeliharaan)', progress: 100, persen: 5 }
        ],
        infra: [
            { nama: 'Termin I (Uang Muka / Mobilisasi)', progress: 0, persen: 25 },
            { nama: 'Termin II (Progres Fisik 50%)', progress: 50, persen: 35 },
            { nama: 'Termin III (Progres Fisik 100% / BAST-1)', progress: 100, persen: 35 },
            { nama: 'Termin IV (Retensi Garansi Pemeliharaan)', progress: 100, persen: 5 }
        ]
    };

    function applyPresetTermin(type) {
        const tbody = document.getElementById('terminTableBody');
        tbody.innerHTML = '';
        const list = terminPresets[type] || terminPresets.standar;

        list.forEach((item, idx) => {
            addTerminRow(item.nama, item.progress, item.persen);
        });

        calculateAllTermins();
    }

    function addTerminRow(nama = '', progress = 0, persen = 0) {
        const tbody = document.getElementById('terminTableBody');
        const count = tbody.querySelectorAll('tr').length;
        const rowIdx = count;
        const defaultName = nama || `Termin ${rowIdx + 1}`;

        const tr = document.createElement('tr');
        tr.className = 'termin-row';
        tr.innerHTML = `
            <td class="text-center fw-bold text-muted termin-no">${rowIdx + 1}</td>
            <td>
                <input type="text" name="termins[${rowIdx}][nama_tahap]" class="form-control form-control-sm" 
                       value="${defaultName}" placeholder="Nama tahap..." required>
            </td>
            <td>
                <div class="input-group input-group-sm">
                    <input type="number" step="0.1" min="0" max="100" name="termins[${rowIdx}][syarat_progress]" 
                           class="form-control text-center" value="${progress}">
                    <span class="input-group-text">%</span>
                </div>
            </td>
            <td>
                <div class="input-group input-group-sm">
                    <input type="number" step="0.1" min="0" max="100" name="termins[${rowIdx}][persentase]" 
                           class="form-control text-center termin-persen" value="${persen}" 
                           oninput="calculateTerminNominal(this); calculateAllTermins();">
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
                <input type="text" name="termins[${rowIdx}][keterangan]" class="form-control form-control-sm" 
                       placeholder="Keterangan...">
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
        const tbody = document.getElementById('terminTableBody');
        if (tbody.querySelectorAll('tr').length <= 1) {
            Swal.fire('Info', 'Minimal harus ada 1 baris termin.', 'info');
            return;
        }
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

        // Update footer totals
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

    function calculateTerminNominal(input) {
        // dipanggil saat input persentase berubah
        calculateAllTermins();
    }
</script>
@endpush
