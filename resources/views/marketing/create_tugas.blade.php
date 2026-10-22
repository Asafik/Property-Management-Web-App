@extends('layouts.partial.app')

@php
    $isEdit = isset($task);
@endphp

@section('title', ($isEdit ? 'Edit Tugas Marketing' : 'Tambah Tugas Marketing') . ' - Property Management App')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard-clean.css') }}?v={{ time() }}">
    <style>
        /* ── Card Ringkas (sama persis Perizinan) ───────────────── */
        .compact-table-card {
            background: #ffffff !important;
            border: 1px solid #e2e8f0 !important;
            border-radius: 6px !important;
            box-shadow: 0 1px 3px rgba(0,0,0,0.04) !important;
            overflow: hidden;
            width: 100% !important;
        }
        .compact-table-card .card-header {
            background: #ffffff !important;
            border-bottom: 1px solid #e2e8f0 !important;
            padding: 1.1rem 1.75rem !important;
        }
        .compact-table-card .card-body {
            padding: 1.75rem !important;
            background: #ffffff !important;
        }

        /* ── Label & Input (sama persis Perizinan) ─────────────── */
        .form-label-custom {
            font-size: 0.83rem;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 0.35rem;
        }
        .form-control-custom,
        .form-select-custom {
            border: 1px solid #cbd5e1;
            border-radius: 5px !important;
            font-size: 0.88rem;
            padding: 0.55rem 0.85rem;
            color: #1e293b;
            background-color: #ffffff;
            transition: all 0.15s ease;
            height: 42px;
        }
        textarea.form-control-custom { height: auto !important; }
        .form-control-custom:focus,
        .form-select-custom:focus {
            border-color: #5046e5;
            box-shadow: 0 0 0 3px rgba(80,70,229,0.15);
            outline: none;
        }

        /* ── Tombol Kembali (sama persis Perizinan) ─────────────── */
        .btn-kembali-proyek {
            border-radius: 5px !important;
            font-size: 0.85rem;
            font-weight: 600;
            border: 1px solid #cbd5e1;
            background-color: #ffffff;
            color: #1e293b;
            transition: all 0.15s ease;
        }
        .btn-kembali-proyek:hover {
            background-color: #f8fafc !important;
            border-color: #94a3b8 !important;
            color: #0f172a !important;
            box-shadow: 0 2px 6px rgba(0,0,0,0.08) !important;
        }

        /* ── Tombol Utama (Solid Ungu 1 Warna, Tanpa Gradient) ───── */
        .btn-gradient-primary {
            background-color: #7c3aed !important;
            background-image: none !important;
            color: #ffffff !important;
            border: none !important;
            transition: all 0.2s ease;
        }
        .btn-gradient-primary:hover {
            background-color: #6d28d9 !important;
            background-image: none !important;
            color: #ffffff !important;
        }

        /* ── Status pills ─────────────────────────────────────── */
        .status-row { display: flex; gap: 8px; flex-wrap: wrap; }
        .st-radio { display: none; }
        .st-pill {
            padding: 5px 16px;
            border-radius: 30px;
            border: 1.5px solid #e2e8f0;
            font-size: 0.79rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.15s ease;
            background: #ffffff;
            color: #64748b;
        }
        .st-radio:checked + .st-pill { border-color: transparent; color: #fff; }
        #sp-pending:checked  + .st-pill { background: #d97706; }
        #sp-proses:checked   + .st-pill { background: #2563eb; }
        #sp-selesai:checked  + .st-pill { background: #059669; }

        /* ── Select2 (sama persis Perizinan) ───────────────────── */
        .select2-container { width: 100% !important; }
        .select2-container .select2-selection--single {
            height: 42px !important;
            padding: 6px 12px !important;
            border: 1px solid #cbd5e1 !important;
            border-radius: 5px !important;
            font-size: 0.88rem !important;
            display: flex !important;
            align-items: center !important;
            background-color: #ffffff !important;
        }
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: #1e293b !important;
            line-height: normal !important;
            padding-left: 0 !important;
        }
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 40px !important;
            right: 10px !important;
        }
        .select2-dropdown {
            border: 1px solid #cbd5e1 !important;
            border-radius: 5px !important;
            box-shadow: 0 4px 16px rgba(0,0,0,0.08) !important;
            font-size: 0.86rem !important;
            overflow: hidden !important;
            z-index: 1050;
        }
        .select2-results__option--highlighted[aria-selected] {
            background-color: #5046e5 !important;
            color: #ffffff !important;
        }
    </style>
@endpush

@section('content')
<div class="container-fluid px-2 px-md-4 py-3">

    {{-- ── Header & Tombol Kembali (sama persis Perizinan) ──────── --}}
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-3">
        <div>
            <h2 class="text-dark mb-1 fw-bold" style="font-size:1.55rem; letter-spacing:-0.02em;">
                {{ $isEdit ? 'Edit Tugas Marketing' : 'Tambah Tugas Marketing' }}
            </h2>
            <p class="text-muted mb-0" style="font-size:0.88rem;">
                {{ $isEdit ? 'Perbarui informasi dan rincian penugasan staff marketing.' : 'Buat penugasan baru ke staff marketing. Bisa pilih staf individu atau langsung ke semua staff.' }}
            </p>
        </div>
        <div>
            <a href="{{ route('master.data.tugas-staff-marketing') }}"
               class="btn btn-sm d-inline-flex align-items-center px-3 py-2 shadow-sm btn-kembali-proyek">
                <i class="mdi mdi-arrow-left text-primary" style="font-size:1.05rem; line-height:1; margin-right:6px !important; color: #5046e5 !important;"></i>
                <span>Kembali ke Daftar Tugas</span>
            </a>
        </div>
    </div>

    {{-- ── Alert / Validation errors ─────────────────────────────── --}}
    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-3"
             role="alert" style="border-radius:5px; background:#fef2f2; color:#991b1b;">
            <div class="fw-bold mb-1">Periksa kembali data yang dimasukkan:</div>
            <ul class="mb-0 ps-3">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- ── Form Container ─────────────────────────────────────────── --}}
    <div class="row">
        <div class="col-12">
            <div class="card compact-table-card w-100">

                {{-- Card Header --}}
                <div class="card-header d-flex align-items-center gap-2">
                    <div style="width:32px; height:32px; border-radius:5px; background-color:#f3e8ff; color:#5046e5;
                                display:inline-flex; align-items:center; justify-content:center;
                                font-size:1.15rem; flex-shrink:0; margin-right:8px;">
                        <i class="mdi {{ $isEdit ? 'mdi-pencil-outline' : 'mdi-clipboard-plus-outline' }}"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold text-dark mb-0" style="font-size:0.98rem;">
                            {{ $isEdit ? 'Formulir Pembaruan Tugas Marketing' : 'Formulir Penugasan Staff Marketing Baru' }}
                        </h5>
                        <small class="text-muted" style="font-size:0.78rem;">
                            {{ $isEdit ? 'Perbarui data yang diperlukan lalu klik Update Tugas untuk menyimpan perubahan.' : 'Lengkapi semua informasi di bawah lalu klik Simpan untuk mendelegasikan tugas.' }}
                        </small>
                    </div>
                </div>

                {{-- Form Body --}}
                <div class="card-body">
                    <form action="{{ $isEdit ? route('marketing.tugas.update', $task->id) : route('marketing.tugas.store') }}" method="POST" id="formTambahTugas">
                        @csrf
                        @if($isEdit)
                            @method('PUT')
                        @endif

                        {{-- hidden status synced by JS --}}
                        <input type="hidden" name="status" id="statusHidden" value="{{ old('status', $task->status ?? 'Pending') }}">

                        <div class="row g-3">

                            {{-- 1. Ditugaskan Kepada (Pilih Staf atau Langsung ke Semua) --}}
                            <div class="col-md-6">
                                <label class="form-label-custom">
                                    Ditugaskan Kepada (Staff Marketing) <span class="text-danger">*</span>
                                </label>
                                <select name="employee_id" id="selectEmployeeId" class="form-select form-select-custom" required>
                                    <option value="">-- Cari &amp; Pilih Staff Marketing --</option>
                                    @if(!$isEdit)
                                        <option value="all" {{ old('employee_id') === 'all' ? 'selected' : '' }}>
                                            Semua Staff Marketing — Langsung ke Semua Staff
                                        </option>
                                    @endif
                                    @foreach ($marketingStaff as $staff)
                                        <option value="{{ $staff->id }}" {{ old('employee_id', $task->employee_id ?? '') == $staff->id ? 'selected' : '' }}>
                                            {{ $staff->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <small class="text-muted d-block mt-1" style="font-size:0.74rem;">
                                    @if(!$isEdit)
                                        Bisa pilih 1 staf khusus atau langsung pilih <b>[Semua Staff Marketing]</b> untuk delegasi serentak.
                                    @else
                                        Staff yang dipilih akan menerima penugasan ini.
                                    @endif
                                </small>
                            </div>

                            {{-- 2. Deadline --}}
                            <div class="col-md-6">
                                <label class="form-label-custom">
                                    Tenggat Waktu (Deadline) <span class="text-danger">*</span>
                                </label>
                                <input type="date" name="deadline" class="form-control form-control-custom"
                                       value="{{ old('deadline', isset($task->deadline) ? \Carbon\Carbon::parse($task->deadline)->format('Y-m-d') : '') }}" required>
                                <small class="text-muted d-block mt-1" style="font-size:0.74rem;">
                                    Tugas akan ditandai terlambat jika melewati tanggal ini.
                                </small>
                            </div>

                            {{-- 3. Nama Tugas --}}
                            <div class="col-md-6">
                                <label class="form-label-custom">
                                    Nama Tugas <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="nama_tugas" class="form-control form-control-custom"
                                       value="{{ old('nama_tugas', $task->nama_tugas ?? '') }}" required
                                       placeholder="Contoh: Pameran Properti Mall A – Oktober 2026">
                            </div>

                            {{-- 4. Kategori Tugas (Dropdown Pilihan Saja) --}}
                            <div class="col-md-6">
                                <label class="form-label-custom">
                                    Kategori Tugas <span class="text-danger">*</span>
                                </label>
                                @php
                                    $currKategori = old('kategori', $task->kategori ?? 'sosmed');
                                @endphp
                                <select name="kategori" id="selectKategori" class="form-select form-select-custom" required>
                                    <option value="" disabled {{ !$currKategori ? 'selected' : '' }}>-- Pilih Kategori Tugas --</option>
                                    @foreach($kategoriList as $val => $label)
                                        <option value="{{ $val }}" {{ $currKategori === $val ? 'selected' : '' }}>
                                            {{ $label }}
                                        </option>
                                    @endforeach
                                </select>
                                <small class="text-muted d-block mt-1" style="font-size:0.74rem;">
                                    Pilih kategori agar tugas masuk ke modul terkait (Sosial Media / Proyeksi / Umum).
                                </small>
                            </div>

                            {{-- 5. Target Angka & Satuan Rencana --}}
                            <div class="{{ $isEdit ? 'col-md-4' : 'col-md-6' }}">
                                <label class="form-label-custom">
                                    Target Angka Rencana <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <input type="number" name="target_jumlah" id="targetJumlahInput" class="form-control form-control-custom"
                                           value="{{ old('target_jumlah', $task->target_jumlah ?? 1) }}" min="1" required
                                           placeholder="Contoh: 5, 10, 20">
                                    <span class="input-group-text bg-light text-muted border-start-0" style="border: 1px solid #cbd5e1; border-top-right-radius: 5px !important; border-bottom-right-radius: 5px !important; font-size: 0.82rem;">
                                        Target
                                    </span>
                                </div>
                                <small class="text-muted d-block mt-1" style="font-size:0.74rem;">
                                    Misal target <b>5</b> video atau <b>10</b> calon pembeli.
                                </small>
                            </div>

                            <div class="{{ $isEdit ? 'col-md-4' : 'col-md-6' }}">
                                <label class="form-label-custom">
                                    Satuan Target <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="satuan_target" id="satuanTargetInput" list="listSatuanTarget" class="form-control form-control-custom"
                                       value="{{ old('satuan_target', $task->satuan_target ?? ($currKategori === 'proyeksi' ? 'Calon Pembeli' : 'Video')) }}" required
                                       placeholder="Contoh: Video, Calon Pembeli, Konten">
                                <datalist id="listSatuanTarget">
                                    <option value="Video">
                                    <option value="Calon Pembeli">
                                    <option value="Konten Postingan">
                                    <option value="Leads / Prospek">
                                    <option value="Kunjungan / Survey">
                                    <option value="Item">
                                </datalist>
                                <small class="text-muted d-block mt-1" style="font-size:0.74rem;">
                                    Bisa pilih opsi rekomendasi atau ketik nama satuan bebas.
                                </small>
                            </div>

                            @if($isEdit)
                            <div class="col-md-4">
                                <label class="form-label-custom">
                                    Realisasi Tercapai Saat Ini
                                </label>
                                <div class="input-group">
                                    <input type="number" name="realisasi_jumlah" id="realisasiJumlahInput" class="form-control form-control-custom"
                                           value="{{ old('realisasi_jumlah', $task->realisasi_jumlah ?? 0) }}" min="0">
                                    <span class="input-group-text bg-light text-muted border-start-0" style="border: 1px solid #cbd5e1; border-top-right-radius: 5px !important; border-bottom-right-radius: 5px !important; font-size: 0.82rem;">
                                        Tercapai
                                    </span>
                                </div>
                                <small class="text-muted d-block mt-1" style="font-size:0.74rem;">
                                    Jumlah capaian yang telah diselesaikan staf.
                                </small>
                            </div>
                            @endif

                            {{-- 6. Status --}}
                            <div class="col-12">
                                <label class="form-label-custom">
                                    Status <span class="text-danger">*</span>
                                </label>
                                @php
                                    $currStatus = old('status', $task->status ?? 'Pending');
                                @endphp
                                <div class="status-row mt-1">
                                    <input type="radio" class="st-radio" id="sp-pending"
                                           name="status_pill" value="Pending"
                                           {{ $currStatus === 'Pending' ? 'checked' : '' }}>
                                    <label class="st-pill" for="sp-pending">
                                        <i class="mdi mdi-clock-outline me-1"></i>Pending
                                    </label>

                                    <input type="radio" class="st-radio" id="sp-proses"
                                           name="status_pill" value="Proses"
                                           {{ $currStatus === 'Proses' ? 'checked' : '' }}>
                                    <label class="st-pill" for="sp-proses">
                                        <i class="mdi mdi-progress-clock me-1"></i>Proses
                                    </label>

                                    <input type="radio" class="st-radio" id="sp-selesai"
                                           name="status_pill" value="Selesai"
                                           {{ $currStatus === 'Selesai' ? 'checked' : '' }}>
                                    <label class="st-pill" for="sp-selesai">
                                        <i class="mdi mdi-check-circle-outline me-1"></i>Selesai
                                    </label>
                                </div>
                            </div>

                            {{-- 7. Deskripsi / Instruksi --}}
                            <div class="col-12">
                                <label class="form-label-custom">
                                    Instruksi / Deskripsi Tugas
                                </label>
                                <textarea name="deskripsi" rows="4" class="form-control form-control-custom"
                                          placeholder="Tuliskan instruksi, target, atau catatan khusus untuk staff marketing...">{{ old('deskripsi', $task->deskripsi ?? '') }}</textarea>
                            </div>

                        </div>{{-- /row --}}

                        {{-- ── Action Buttons (sama persis Perizinan) ─────── --}}
                        <div class="d-flex align-items-center justify-content-between pt-4 mt-4 border-top">
                            <a href="{{ route('master.data.tugas-staff-marketing') }}"
                               class="btn btn-light border px-4 py-2 fw-semibold d-inline-flex align-items-center"
                               style="border-radius:5px; font-size:0.86rem; color:#475569;">
                                <i class="mdi mdi-close" style="font-size:1rem; margin-right:6px !important;"></i>
                                <span>Batal</span>
                            </a>

                            <button type="submit" class="btn btn-gradient-primary px-4 py-2 fw-semibold shadow-sm d-inline-flex align-items-center"
                                    style="border-radius:5px; font-size:0.88rem;" id="saveBtn">
                                <i class="mdi {{ $isEdit ? 'mdi-content-save-check' : 'mdi-send-check' }}" style="font-size:1.1rem; margin-right:8px !important;"></i>
                                <span>{{ $isEdit ? 'Update Tugas' : 'Simpan & Delegasikan Tugas' }}</span>
                            </button>
                        </div>

                    </form>
                </div>{{-- /card-body --}}

            </div>
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script>
$(document).ready(function () {

    // Select2 untuk staff
    $('#selectEmployeeId').select2({
        placeholder: '-- Cari & Pilih Staff Marketing --',
        allowClear: true,
        width: '100%'
    });

    // Select2 untuk kategori
    $('#selectKategori').select2({
        placeholder: '-- Pilih Kategori Tugas --',
        minimumResultsForSearch: Infinity,
        width: '100%'
    }).on('change', function () {
        var kat = $(this).val();
        var satuanInput = $('#satuanTargetInput');
        var curVal = satuanInput.val().trim();
        if (!curVal || curVal === 'Video' || curVal === 'Calon Pembeli' || curVal === 'Item') {
            if (kat === 'sosmed') {
                satuanInput.val('Video');
            } else if (kat === 'proyeksi') {
                satuanInput.val('Calon Pembeli');
            } else {
                satuanInput.val('Item');
            }
        }
    });

    // Sync status pills → hidden input
    function syncStatus() {
        var val = $('input[name="status_pill"]:checked').val() || 'Pending';
        $('#statusHidden').val(val);
    }
    syncStatus();
    $('input[name="status_pill"]').on('change', syncStatus);

    // Guard double-submit
    $('#formTambahTugas').on('submit', function () {
        syncStatus();
        $('#saveBtn').prop('disabled', true)
                    .html('<i class="mdi mdi-loading mdi-spin" style="margin-right:8px !important;"></i><span>Menyimpan...</span>');
    });

});
</script>
@endpush
