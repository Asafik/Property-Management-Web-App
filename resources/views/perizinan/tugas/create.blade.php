@extends('layouts.partial.app')

@section('title', 'Tugaskan Staf Legal - Property Management App')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard-clean.css') }}?v={{ time() }}">
    <style>
        .compact-table-card {
            background: #ffffff !important;
            border: 1px solid #e2e8f0 !important;
            border-radius: 10px !important;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05) !important;
            overflow: hidden;
        }
        .compact-table-card .card-header {
            background: #ffffff !important;
            border-bottom: 1px solid #e2e8f0 !important;
            padding: 1rem 1.5rem !important;
        }
        .compact-table-card .card-body {
            padding: 1.5rem !important;
            background: #ffffff !important;
        }
        .form-label-custom {
            font-size: 0.83rem;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 0.35rem;
        }
        .form-control-custom,
        .form-select-custom {
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            font-size: 0.88rem;
            padding: 0.55rem 0.85rem;
            color: #1e293b;
            background-color: #ffffff;
            transition: all 0.2s ease;
        }
        .form-control-custom:focus,
        .form-select-custom:focus {
            border-color: #6366f1;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.15);
            outline: none;
        }
        .btn-kembali-proyek:hover {
            background-color: #f8fafc !important;
            border-color: #94a3b8 !important;
            color: #0f172a !important;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.08) !important;
        }
    </style>
@endpush

@section('content')
<div class="container-fluid px-2 px-md-4 py-3">

    <!-- Header & Tombol Kembali -->
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">
        <div>
            <h2 class="text-dark mb-1 fw-bold" style="font-size: 1.55rem; letter-spacing: -0.02em;">
                Tugaskan Staf Legal
            </h2>
            <p class="text-muted mb-0" style="font-size: 0.88rem;">
                Delegasi penugasan pengurusan izin kawasan, penentuan tenggat waktu, dan pembagian wewenang staf legal.
            </p>
        </div>

        <div>
            <a href="{{ route('perizinan.tugas.index') }}" class="btn btn-sm d-inline-flex align-items-center gap-2 px-3 py-2 shadow-sm btn-kembali-proyek" style="border: 1px solid #cbd5e1; background-color: #ffffff; color: #1e293b; border-radius: 8px; font-weight: 600; font-size: 0.85rem; transition: all 0.2s ease;">
                <i class="mdi mdi-arrow-left text-primary" style="font-size: 1.1rem; line-height: 1;"></i>
                <span>Kembali ke Daftar Tugas</span>
            </a>
        </div>
    </div>

    <!-- Alert Notifikasi -->
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm d-flex align-items-center gap-2 mb-4" role="alert" style="border-radius: 8px; background: #fef2f2; color: #991b1b;">
            <i class="mdi mdi-alert-circle fs-5 text-danger"></i>
            <div>{{ session('error') }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-4" role="alert" style="border-radius: 8px; background: #fef2f2; color: #991b1b;">
            <div class="fw-bold mb-1">Periksa kembali data yang dimasukkan:</div>
            <ul class="mb-0 ps-3">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Form Container -->
    <div class="row justify-content-center">
        <div class="col-lg-10 col-xl-9">
            <div class="card compact-table-card">
                
                <!-- Card Header -->
                <div class="card-header d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center gap-2">
                        <div style="width: 34px; height: 34px; border-radius: 8px; background-color: #f3e8ff; color: #9333ea; display: inline-flex; align-items: center; justify-content: center; font-size: 1.2rem; flex-shrink: 0;">
                            <i class="mdi mdi-clipboard-plus-outline"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold text-dark mb-0" style="font-size: 1rem;">Formulir Penugasan Staf Legal Baru</h5>
                            <small class="text-muted" style="font-size: 0.78rem;">Lengkapi rincian berkas izin kawasan yang akan didelegasikan</small>
                        </div>
                    </div>
                </div>

                <!-- Form Body -->
                <div class="card-body">
                    <form action="{{ route('perizinan.tugas.store') }}" method="POST" id="formTugaskanLegal" onsubmit="return validateFormTugaskan()">
                        @csrf

                        <div class="row g-3">

                            <!-- 1. Nama Tugas Perizinan -->
                            <div class="col-md-7">
                                <div class="d-flex align-items-center justify-content-between mb-1">
                                    <label class="form-label-custom mb-0">
                                        Nama Dokumen / Tugas Perizinan <span class="text-danger">*</span>
                                    </label>
                                    <button type="button" class="btn btn-link p-0 text-primary text-decoration-none fw-semibold" id="btnToggleManualTugas" onclick="toggleManualNamaTugas()" style="font-size: 0.78rem;">
                                        <i class="mdi mdi-keyboard-outline me-0.5"></i>Ketik Manual
                                    </button>
                                </div>

                                <!-- Dropdown Pilihan Dokumen Perizinan (Default) -->
                                <div id="wrapperSelectNamaTugas">
                                    <select class="form-select form-select-custom w-100" id="selectNamaTugas" onchange="onSelectNamaTugasChange(this)">
                                        <option value="">-- Pilih Dokumen / Tugas Perizinan --</option>
                                        @foreach($masterDocs as $md)
                                            <option value="{{ $md->nama_dokumen }}" 
                                                data-instansi="{{ $md->instansi_terkait }}"
                                                data-catatan="{{ $md->deskripsi }}">
                                                {{ $md->kode_dokumen ? '[' . $md->kode_dokumen . '] ' : '' }}{{ $md->nama_dokumen }}
                                            </option>
                                        @endforeach
                                        <option value="__custom__">✍️ + Ketik Manual / Izin Lainnya...</option>
                                    </select>
                                </div>

                                <!-- Input Ketik Manual (Jika memilih custom atau klik toggle) -->
                                <div id="wrapperInputNamaTugas" style="display: none;" class="mt-2">
                                    <input type="text" id="inputManualNamaTugas" class="form-control form-control-custom" placeholder="Contoh: Pengurusan Izin Amdal Kawasan / PKKPR Khusus" oninput="onManualInputNamaTugas(this.value)">
                                </div>

                                <!-- Hidden field yang dikirim ke controller -->
                                <input type="hidden" name="nama_tugas" id="tambahNamaTugas" required>
                                <small class="text-muted d-block mt-1" style="font-size: 0.74rem;">
                                    Pilih dari daftar master dokumen atau klik "Ketik Manual" untuk izin kustom.
                                </small>
                            </div>

                            <!-- 2. Instansi Terkait -->
                            <div class="col-md-5">
                                <label class="form-label-custom">
                                    Instansi / Dinas Terkait
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light text-muted border-end-0" style="border-radius: 8px 0 0 8px;">
                                        <i class="mdi mdi-bank-outline"></i>
                                    </span>
                                    <input type="text" name="instansi" id="tambahInstansi" class="form-control form-control-custom border-start-0" placeholder="Contoh: DPMPTSP / BPN / DLH" style="border-radius: 0 8px 8px 0;">
                                </div>
                                <small class="text-muted d-block mt-1" style="font-size: 0.74rem;">
                                    Terisi otomatis dari master dokumen atau dapat diubah.
                                </small>
                            </div>

                            <!-- 3. Proyek Kawasan -->
                            <div class="col-md-6">
                                <label class="form-label-custom">
                                    Proyek Kawasan Properti
                                </label>
                                <select name="proyek_id" class="form-select form-select-custom">
                                    <option value="">-- Bebas / Kawasan Umum --</option>
                                    @foreach($projects as $proj)
                                        <option value="{{ $proj['id'] }}" {{ old('proyek_id') == $proj['id'] ? 'selected' : '' }}>
                                            {{ $proj['nama'] }}
                                        </option>
                                    @endforeach
                                </select>
                                <small class="text-muted d-block mt-1" style="font-size: 0.74rem;">
                                    Tautkan berkas izin ini ke proyek kawasan tertentu.
                                </small>
                            </div>

                            <!-- 4. Ditugaskan Kepada (Staf Legal Pelaksana) -->
                            <div class="col-md-6">
                                <label class="form-label-custom">
                                    Ditugaskan Kepada (Staf Legal) <span class="text-danger">*</span>
                                </label>
                                <select name="employee_id" class="form-select form-select-custom" required>
                                    <option value="">-- Pilih Staf Legal Pelaksana --</option>
                                    @foreach($legalStaffs as $staf)
                                        <option value="{{ $staf->id }}" {{ old('employee_id') == $staf->id ? 'selected' : '' }}>
                                            {{ $staf->name }} &bull; {{ $staf->position->name ?? 'Staff Legal' }}
                                        </option>
                                    @endforeach
                                </select>
                                <small class="text-muted d-block mt-1" style="font-size: 0.74rem;">
                                    Staf yang ditugaskan akan melihat tugas ini pada dashboard kerjanya.
                                </small>
                            </div>

                            <!-- 5. Tenggat Waktu (Deadline) -->
                            <div class="col-md-6">
                                <label class="form-label-custom">
                                    Tenggat Waktu Selesai (Deadline)
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light text-muted border-end-0" style="border-radius: 8px 0 0 8px;">
                                        <i class="mdi mdi-calendar-clock"></i>
                                    </span>
                                    <input type="date" name="deadline" class="form-control form-control-custom border-start-0" min="{{ date('Y-m-d') }}" value="{{ old('deadline') }}" style="border-radius: 0 8px 8px 0;">
                                </div>
                                <small class="text-muted d-block mt-1" style="font-size: 0.74rem;">
                                    Sistem akan menandai "Terlambat" jika melewati tanggal ini.
                                </small>
                            </div>

                            <!-- 6. Instruksi & Catatan Khusus -->
                            <div class="col-12">
                                <label class="form-label-custom">
                                    Instruksi / Catatan Khusus Penugasan
                                </label>
                                <textarea name="catatan" id="tambahCatatan" rows="4" class="form-control form-control-custom" placeholder="Tuliskan arahan spesifik pengurusan berkas, persyaratan wajib yang harus dibawa staf, kontak dinas terkait, dll.">{{ old('catatan') }}</textarea>
                            </div>

                        </div>

                        <!-- Divider & Action Buttons -->
                        <div class="d-flex align-items-center justify-content-between pt-4 mt-4 border-top">
                            <a href="{{ route('perizinan.tugas.index') }}" class="btn btn-light border px-4 py-2 fw-semibold" style="border-radius: 8px; font-size: 0.86rem;">
                                <i class="mdi mdi-close me-1"></i> Batal
                            </a>

                            <button type="submit" class="btn btn-gradient-primary px-4 py-2 fw-semibold shadow-sm d-inline-flex align-items-center gap-1.5" style="border-radius: 8px; font-size: 0.88rem;">
                                <i class="mdi mdi-send-check" style="font-size: 1.05rem;"></i>
                                <span>Simpan & Delegasikan Tugas</span>
                            </button>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script>
    var isManualMode = false;

    function toggleManualNamaTugas() {
        isManualMode = !isManualMode;
        var wrapperSelect = document.getElementById('wrapperSelectNamaTugas');
        var wrapperInput  = document.getElementById('wrapperInputNamaTugas');
        var btnToggle     = document.getElementById('btnToggleManualTugas');
        var hiddenInput   = document.getElementById('tambahNamaTugas');

        if (isManualMode) {
            wrapperSelect.style.display = 'none';
            wrapperInput.style.display  = 'block';
            btnToggle.innerHTML = '<i class="mdi mdi-format-list-bulleted me-0.5"></i>Pilih dari Daftar Master';
            hiddenInput.value = document.getElementById('inputManualNamaTugas').value.trim();
            document.getElementById('inputManualNamaTugas').focus();
        } else {
            wrapperSelect.style.display = 'block';
            wrapperInput.style.display  = 'none';
            btnToggle.innerHTML = '<i class="mdi mdi-keyboard-outline me-0.5"></i>Ketik Manual';
            var sel = document.getElementById('selectNamaTugas');
            hiddenInput.value = (sel.value && sel.value !== '__custom__') ? sel.value : '';
        }
    }

    function onSelectNamaTugasChange(sel) {
        var hiddenInput = document.getElementById('tambahNamaTugas');
        if (sel.value === '__custom__') {
            toggleManualNamaTugas();
            return;
        }

        hiddenInput.value = sel.value;

        // Auto-fill instansi & catatan dari data attribute
        var selectedOpt = sel.options[sel.selectedIndex];
        if (selectedOpt && selectedOpt.dataset) {
            var instansi = selectedOpt.dataset.instansi || '';
            var catatan  = selectedOpt.dataset.catatan || '';
            var inpInstansi = document.getElementById('tambahInstansi');
            var inpCatatan  = document.getElementById('tambahCatatan');

            if (instansi && inpInstansi && !inpInstansi.value) {
                inpInstansi.value = instansi;
            }
            if (catatan && inpCatatan && !inpCatatan.value) {
                inpCatatan.value = catatan;
            }
        }
    }

    function onManualInputNamaTugas(val) {
        document.getElementById('tambahNamaTugas').value = val.trim();
    }

    function validateFormTugaskan() {
        var namaTugas = document.getElementById('tambahNamaTugas').value.trim();
        if (!namaTugas) {
            alert('Silakan pilih atau ketik Nama Dokumen / Tugas Perizinan terlebih dahulu.');
            if (isManualMode) {
                document.getElementById('inputManualNamaTugas').focus();
            } else {
                document.getElementById('selectNamaTugas').focus();
            }
            return false;
        }
        return true;
    }
</script>
@endpush
