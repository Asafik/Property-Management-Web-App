@php
    $isEdit = isset($task);
@endphp

@extends('layouts.partial.app')

@section('title', ($isEdit ? 'Edit Penugasan Staf Legal' : 'Tugaskan Staf Legal') . ' - Property Management App')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard-clean.css') }}?v={{ time() }}">
    <style>
        /* Card Utama Berborder Radius Ringkas Sesuai Standar Modul */
        .compact-table-card {
            background: #ffffff !important;
            border: 1px solid #e2e8f0 !important;
            border-radius: 6px !important;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04) !important;
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
        textarea.form-control-custom {
            height: auto !important;
        }
        .form-control-custom:focus,
        .form-select-custom:focus {
            border-color: #6366f1;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.15);
            outline: none;
        }
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
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.08) !important;
        }

        /* Segmented Mode Button (Border Radius 5px Ringkas) */
        .mode-segmented-wrap {
            display: inline-flex;
            background: #f1f5f9;
            padding: 2.5px;
            border-radius: 5px;
            border: 1px solid #e2e8f0;
        }
        .mode-segmented-btn {
            border: none;
            background: transparent;
            padding: 4px 12px;
            font-size: 0.78rem;
            font-weight: 600;
            color: #64748b;
            border-radius: 4px;
            transition: all 0.15s ease;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
        }
        .mode-segmented-btn:hover {
            color: #1e293b;
        }
        .mode-segmented-btn.active {
            background: #4f46e5;
            color: #ffffff !important;
            box-shadow: 0 1px 3px rgba(79, 70, 229, 0.25);
        }

        /* Select2 Customization Ringkas */
        .select2-container {
            width: 100% !important;
        }
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
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08) !important;
            font-size: 0.86rem !important;
            overflow: hidden !important;
            z-index: 1050;
        }
        .select2-search--dropdown {
            padding: 8px !important;
        }
        .select2-search--dropdown .select2-search__field {
            border: 1px solid #cbd5e1 !important;
            border-radius: 4px !important;
            padding: 6px 10px !important;
            font-size: 0.85rem !important;
            outline: none !important;
        }
        .select2-results__option--highlighted[aria-selected] {
            background-color: #4f46e5 !important;
            color: #ffffff !important;
        }
    </style>
@endpush

@section('content')
<div class="container-fluid px-2 px-md-4 py-3">

    <!-- Header & Tombol Kembali -->
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-3">
        <div>
            <h2 class="text-dark mb-1 fw-bold" style="font-size: 1.55rem; letter-spacing: -0.02em;">
                {{ $isEdit ? 'Edit Penugasan Staf Legal' : 'Tugaskan Staf Legal' }}
            </h2>
            <p class="text-muted mb-0" style="font-size: 0.88rem;">
                {{ $isEdit ? 'Perbarui rincian berkas izin, alihkan penugasan staf (reassign), atau sesuaikan tenggat waktu.' : 'Delegasi penugasan pengurusan izin kawasan, penentuan tenggat waktu, dan pembagian wewenang staf legal.' }}
            </p>
        </div>

        <div>
            <a href="{{ route('perizinan.tugas.index') }}" class="btn btn-sm d-inline-flex align-items-center px-3 py-2 shadow-sm btn-kembali-proyek">
                <i class="mdi mdi-arrow-left text-primary" style="font-size: 1.05rem; line-height: 1; margin-right: 6px !important;"></i>
                <span>Kembali ke Daftar Tugas</span>
            </a>
        </div>
    </div>

    <!-- Alert Notifikasi -->
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm d-flex align-items-center gap-2 mb-3" role="alert" style="border-radius: 5px; background: #fef2f2; color: #991b1b;">
            <i class="mdi mdi-alert-circle fs-5 text-danger" style="margin-right: 6px !important;"></i>
            <div>{{ session('error') }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-3" role="alert" style="border-radius: 5px; background: #fef2f2; color: #991b1b;">
            <div class="fw-bold mb-1">Periksa kembali data yang dimasukkan:</div>
            <ul class="mb-0 ps-3">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Form Container: Mentok Kanan-Kiri (col-12) -->
    <div class="row">
        <div class="col-12">
            <div class="card compact-table-card w-100">
                
                <!-- Card Header -->
                <div class="card-header d-flex flex-wrap align-items-center justify-content-between gap-2">
                    <div class="d-flex align-items-center gap-2">
                        @if($isEdit)
                            <div style="width: 32px; height: 32px; border-radius: 5px; background-color: #fef3c7; color: #d97706; display: inline-flex; align-items: center; justify-content: center; font-size: 1.15rem; flex-shrink: 0; margin-right: 8px;">
                                <i class="mdi mdi-account-edit-outline"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold text-dark mb-0" style="font-size: 0.98rem;">Formulir Perubahan Data Penugasan</h5>
                                <small class="text-muted" style="font-size: 0.78rem;">ID Tugas #{{ $task->id }} &bull; Dibuat {{ $task->created_at->format('d M Y, H:i') }}</small>
                            </div>
                        @else
                            <div style="width: 32px; height: 32px; border-radius: 5px; background-color: #f3e8ff; color: #9333ea; display: inline-flex; align-items: center; justify-content: center; font-size: 1.15rem; flex-shrink: 0; margin-right: 8px;">
                                <i class="mdi mdi-clipboard-plus-outline"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold text-dark mb-0" style="font-size: 0.98rem;">Formulir Penugasan Staf Legal Baru</h5>
                                <small class="text-muted" style="font-size: 0.78rem;">Lengkapi rincian berkas izin kawasan yang akan didelegasikan</small>
                            </div>
                        @endif
                    </div>

                    @if($isEdit)
                        <div>
                            @if($task->status == 'Selesai')
                                <span class="badge bg-success-subtle text-success border border-success-subtle px-2.5 py-1" style="font-size: 0.78rem;">Status: Selesai</span>
                            @elseif($task->status == 'Dalam Proses')
                                <span class="badge bg-info-subtle text-info border border-info-subtle px-2.5 py-1" style="font-size: 0.78rem;">Status: Dalam Proses</span>
                            @elseif($task->status == 'Terkendala')
                                <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-2.5 py-1" style="font-size: 0.78rem;">Status: Terkendala</span>
                            @else
                                <span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle px-2.5 py-1" style="font-size: 0.78rem;">Status: Pending</span>
                            @endif
                        </div>
                    @endif
                </div>

                <!-- Form Body -->
                <div class="card-body">
                    <form action="{{ $isEdit ? route('perizinan.tugas.update', $task->id) : route('perizinan.tugas.store') }}" method="POST" id="formTugaskanLegal" onsubmit="return validateFormTugaskan()">
                        @csrf
                        @if($isEdit)
                            @method('PUT')
                        @endif

                        <div class="row g-3">

                            <!-- 1. Nama Tugas Perizinan -->
                            <div class="col-md-7">
                                <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mb-2">
                                    <label class="form-label-custom mb-0">
                                        Nama Dokumen / Tugas Perizinan <span class="text-danger">*</span>
                                    </label>
                                    
                                    <!-- Segmented Switch Mode (Pilih Master vs Ketik Manual) -->
                                    <div class="mode-segmented-wrap">
                                        <button type="button" class="mode-segmented-btn active" id="btnModeMaster" onclick="switchModeTugas('master')">
                                            <i class="mdi mdi-format-list-bulleted" style="margin-right: 5px !important;"></i>Pilih dari Master
                                        </button>
                                        <button type="button" class="mode-segmented-btn" id="btnModeManual" onclick="switchModeTugas('manual')">
                                            <i class="mdi mdi-pencil-outline" style="margin-right: 5px !important;"></i>Ketik Manual
                                        </button>
                                    </div>
                                </div>

                                <!-- Mode 1: Live Search Select2 Master Dokumen -->
                                <div id="wrapperSelectNamaTugas">
                                    <select class="form-select form-select-custom w-100" id="selectNamaTugas">
                                        <option value="">-- Cari atau Pilih Dokumen Perizinan --</option>
                                        @foreach($masterDocs as $md)
                                            <option value="{{ $md->nama_dokumen }}" 
                                                data-id="{{ $md->id }}"
                                                data-kode="{{ $md->kode_dokumen }}"
                                                data-instansi="{{ $md->instansi_terkait }}"
                                                data-catatan="{{ $md->deskripsi }}">
                                                {{ $md->kode_dokumen ? '[' . $md->kode_dokumen . '] ' : '' }}{{ $md->nama_dokumen }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Mode 2: Input Ketik Manual (Clean Standard Input) -->
                                <div id="wrapperInputNamaTugas" style="display: none;">
                                    <input type="text" id="inputManualNamaTugas" class="form-control form-control-custom" placeholder="Ketik nama berkas / tugas izin (misal: Izin Reklame, Amdal Khusus, dll.)..." oninput="onManualInputNamaTugas(this.value)">
                                </div>

                                <!-- Hidden field yang dikirim ke controller -->
                                <input type="hidden" name="master_dokumen_id" id="tambahMasterDokumenId" value="{{ old('master_dokumen_id', $isEdit ? $task->master_dokumen_id : '') }}">
                                <input type="hidden" name="nama_tugas" id="tambahNamaTugas" value="{{ old('nama_tugas', $isEdit ? $task->nama_tugas : '') }}" required>
                                <small class="text-muted d-block mt-1" id="keteranganMode" style="font-size: 0.74rem;">
                                    Ketik kata kunci untuk mencari dokumen izin dari master secara live. Poin yang sudah ditugaskan ke staf lain otomatis dinonaktifkan.
                                </small>
                            </div>

                            <!-- 2. Instansi Terkait (Clean Standard Input) -->
                            <div class="col-md-5">
                                <label class="form-label-custom">
                                    Instansi / Dinas Terkait
                                </label>
                                <input type="text" name="instansi" id="tambahInstansi" class="form-control form-control-custom" placeholder="Contoh: DPMPTSP / BPN / DLH" value="{{ old('instansi', $isEdit ? $task->instansi : '') }}">
                                <small class="text-muted d-block mt-1" style="font-size: 0.74rem;">
                                    Otomatis terisi saat memilih master dokumen atau dapat diisi manual.
                                </small>
                            </div>

                            <!-- 3. Proyek Kawasan -->
                            <div class="col-md-6">
                                <label class="form-label-custom">
                                    Proyek Kawasan Properti
                                </label>
                                <select name="proyek_id" id="selectProyekId" class="form-select form-select-custom">
                                    <option value="">-- Bebas / Kawasan Umum --</option>
                                    @foreach($projects as $proj)
                                        <option value="{{ $proj['id'] }}" {{ (old('proyek_id', $selectedProyekId ?? ($isEdit ? $task->proyek_id : '')) == $proj['id']) ? 'selected' : '' }}>
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
                                <select name="employee_id" id="selectEmployeeId" class="form-select form-select-custom" required>
                                    <option value="">-- Cari & Pilih Staf Legal Pelaksana --</option>
                                    @foreach($legalStaffs as $staf)
                                        <option value="{{ $staf->id }}" {{ (old('employee_id', $isEdit ? $task->employee_id : '') == $staf->id) ? 'selected' : '' }}>
                                            {{ $staf->name }} &bull; {{ $staf->position->name ?? 'Staff Legal' }}
                                        </option>
                                    @endforeach
                                </select>
                                <small class="text-muted d-block mt-1" style="font-size: 0.74rem;">
                                    {{ $isEdit ? 'Ganti staf jika ingin mengalihkan tanggung jawab tugas (reassign).' : 'Staf yang ditugaskan akan melihat tugas ini pada dashboard kerjanya.' }}
                                </small>
                            </div>

                            <!-- 5. Tenggat Waktu (Deadline) (Clean Standard Date Input) -->
                            <div class="col-md-6">
                                <label class="form-label-custom">
                                    Tenggat Waktu Selesai (Deadline)
                                </label>
                                <input type="date" name="deadline" class="form-control form-control-custom" value="{{ old('deadline', ($isEdit && $task->deadline) ? $task->deadline->format('Y-m-d') : '') }}">
                                <small class="text-muted d-block mt-1" style="font-size: 0.74rem;">
                                    Sistem akan menandai status "Terlambat" jika melewati tanggal ini.
                                </small>
                            </div>

                            <!-- 6. Status Tugas (Khusus Mode Edit) -->
                            @if($isEdit)
                                <div class="col-md-6">
                                    <label class="form-label-custom">
                                        Status Tugas
                                    </label>
                                    <select name="status" class="form-select form-select-custom">
                                        <option value="Pending" {{ old('status', $task->status) == 'Pending' ? 'selected' : '' }}>Pending (Menunggu Dimulai)</option>
                                        <option value="Dalam Proses" {{ old('status', $task->status) == 'Dalam Proses' ? 'selected' : '' }}>Dalam Proses (Sedang Dikerjakan)</option>
                                        <option value="Selesai" {{ old('status', $task->status) == 'Selesai' ? 'selected' : '' }}>Selesai (Izin Terbit/Final)</option>
                                        <option value="Terkendala" {{ old('status', $task->status) == 'Terkendala' ? 'selected' : '' }}>Terkendala (Ada Hambatan Lapangan)</option>
                                    </select>
                                    <small class="text-muted d-block mt-1" style="font-size: 0.74rem;">
                                        Status penanganan tugas saat ini.
                                    </small>
                                </div>
                            @endif

                            <!-- 7. Instruksi & Catatan Khusus -->
                            <div class="col-12">
                                <label class="form-label-custom">
                                    Instruksi / Catatan Khusus Penugasan
                                </label>
                                <textarea name="catatan" id="tambahCatatan" rows="4" class="form-control form-control-custom" placeholder="Tuliskan arahan spesifik pengurusan berkas, persyaratan wajib yang harus dibawa staf, kontak dinas terkait, dll.">{{ old('catatan', $isEdit ? $task->catatan : '') }}</textarea>
                            </div>

                        </div>

                        <!-- Divider & Action Buttons -->
                        <div class="d-flex align-items-center justify-content-between pt-4 mt-4 border-top">
                            <a href="{{ route('perizinan.tugas.index') }}" class="btn btn-light border px-4 py-2 fw-semibold d-inline-flex align-items-center" style="border-radius: 5px; font-size: 0.86rem; color: #475569;">
                                <i class="mdi mdi-close" style="font-size: 1rem; margin-right: 6px !important;"></i>
                                <span>Batal</span>
                            </a>

                            @if($isEdit)
                                <button type="submit" class="btn btn-primary px-4 py-2 fw-semibold shadow-sm d-inline-flex align-items-center" style="border-radius: 5px; font-size: 0.88rem; background-color: #4f46e5; border-color: #4f46e5;">
                                    <i class="mdi mdi-content-save-check-outline" style="font-size: 1.1rem; margin-right: 8px !important;"></i>
                                    <span>Simpan Perubahan Penugasan</span>
                                </button>
                            @else
                                <button type="submit" class="btn btn-gradient-primary px-4 py-2 fw-semibold shadow-sm d-inline-flex align-items-center" style="border-radius: 5px; font-size: 0.88rem;">
                                    <i class="mdi mdi-send-check" style="font-size: 1.1rem; margin-right: 8px !important;"></i>
                                    <span>Simpan & Delegasikan Tugas</span>
                                </button>
                            @endif
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
    var currentMode = 'master';

    @php
        $assignedTasksJson = ($existingTasks ?? collect())->map(function($t) {
            return [
                'id'                => $t->id,
                'proyek_id'         => $t->proyek_id ? (string) $t->proyek_id : '',
                'proyek_nama'       => strtolower(trim($t->proyek_nama ?? '')),
                'master_dokumen_id' => $t->master_dokumen_id ? (int) $t->master_dokumen_id : null,
                'nama_tugas'        => trim($t->nama_tugas ?? ''),
                'nama_tugas_lower'  => strtolower(trim($t->nama_tugas ?? '')),
                'employee_id'       => $t->employee_id,
                'employee_name'     => $t->employee ? $t->employee->name : 'Staf Lain',
            ];
        })->values();
    @endphp

    var assignedTasks = @json($assignedTasksJson);

    // Fungsi cek apakah dokumen/poin sudah ditugaskan pada proyek terpilih
    function getAssignedTaskForDoc(docId, docName, selectedProyekId, selectedProyekText) {
        if (!selectedProyekId && !selectedProyekText) {
            return null;
        }

        var valClean = (docName || '').toLowerCase().replace(/\[poin-\d+\]\s*/i, '').trim();

        for (var i = 0; i < assignedTasks.length; i++) {
            var t = assignedTasks[i];

            // 1. Cek kecocokan Proyek
            var matchProj = false;
            if (selectedProyekId && t.proyek_id) {
                matchProj = (String(t.proyek_id) === String(selectedProyekId));
            } else if (selectedProyekText && t.proyek_nama) {
                matchProj = (t.proyek_nama === selectedProyekText);
            }

            if (!matchProj) continue;

            // 2. Cek kecocokan Poin Dokumen
            if (docId && t.master_dokumen_id && Number(docId) === Number(t.master_dokumen_id)) {
                return t;
            }

            var tClean = (t.nama_tugas_lower || '').replace(/\[poin-\d+\]\s*/i, '').trim();
            if (valClean && tClean) {
                if (valClean === tClean || valClean.indexOf(tClean) !== -1 || tClean.indexOf(valClean) !== -1) {
                    return t;
                }
            }
        }

        return null;
    }

    // Refresh ketersediaan pilihan master dokumen berdasarkan proyek yang dipilih
    function refreshMasterDocAvailability(showWarningIfReset) {
        var selectedProyekId = $('#selectProyekId').val();
        var selectedProyekText = ($('#selectProyekId option:selected').text() || '').trim().toLowerCase();
        if (selectedProyekId === '') {
            selectedProyekText = '';
        }

        var currentSelectedDoc = $('#selectNamaTugas').val();
        var currentSelectedId  = $('#tambahMasterDokumenId').val();
        var hasConflict = false;
        var conflictStaff = '';
        var conflictDocName = '';

        $('#selectNamaTugas option').each(function() {
            var opt = $(this);
            var val = opt.val();
            if (!val) return;

            var baseText = opt.attr('data-base-text');
            if (!baseText) {
                baseText = opt.text().trim();
                opt.attr('data-base-text', baseText);
            }

            var docId = opt.attr('data-id');
            var assigned = getAssignedTaskForDoc(docId, val, selectedProyekId, selectedProyekText);

            if (assigned) {
                opt.prop('disabled', true);
                opt.text(baseText + ' ⛔ (Sudah ditugaskan ke: ' + assigned.employee_name + ')');
                if (currentSelectedDoc === val || (docId && currentSelectedId && Number(docId) === Number(currentSelectedId))) {
                    hasConflict = true;
                    conflictStaff = assigned.employee_name;
                    conflictDocName = baseText;
                }
            } else {
                opt.prop('disabled', false);
                opt.text(baseText);
            }
        });

        // Re-inisialisasi Select2 agar perubahan disabled & teks dirender
        $('#selectNamaTugas').select2({
            placeholder: '-- Cari atau Pilih Dokumen Perizinan --',
            allowClear: true,
            width: '100%',
            templateResult: function(data) {
                if (!data.id) return data.text;
                var $element = $(data.element);
                if ($element.prop('disabled')) {
                    return $('<span style="color: #94a3b8; font-style: italic; cursor: not-allowed;">' + data.text + '</span>');
                }
                return data.text;
            }
        });

        if (hasConflict) {
            $('#selectNamaTugas').val('').trigger('change');
            document.getElementById('tambahNamaTugas').value = '';
            document.getElementById('tambahMasterDokumenId').value = '';

            if (showWarningIfReset) {
                if (typeof Swal !== 'undefined') {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Poin Sudah Ditugaskan',
                        html: 'Dokumen <b>' + conflictDocName + '</b> sudah ditugaskan kepada staf <b>' + conflictStaff + '</b> untuk proyek ini.<br><small class="text-muted">1 Poin perizinan hanya dapat ditugaskan ke 1 staf. Silakan pilih poin izin lainnya.</small>',
                        confirmButtonColor: '#4f46e5'
                    });
                } else {
                    alert('Dokumen ' + conflictDocName + ' sudah ditugaskan kepada staf ' + conflictStaff + ' untuk proyek ini. 1 Poin perizinan hanya dapat ditugaskan ke 1 staf.');
                }
            }
        }
    }

    $(document).ready(function() {
        // Inisialisasi Select2 Dokumen Perizinan
        $('#selectNamaTugas').select2({
            placeholder: '-- Cari atau Pilih Dokumen Perizinan --',
            allowClear: true,
            width: '100%'
        }).on('change', function() {
            var val = $(this).val();
            var hiddenInput = document.getElementById('tambahNamaTugas');
            var hiddenId    = document.getElementById('tambahMasterDokumenId');
            hiddenInput.value = val || '';

            if (val) {
                var selectedOpt = this.options[this.selectedIndex];
                if (selectedOpt && selectedOpt.dataset) {
                    var docId    = selectedOpt.dataset.id || '';
                    hiddenId.value = docId;

                    // Double-check apakah poin ini sudah ditugaskan pada proyek terpilih
                    var selectedProyekId = $('#selectProyekId').val();
                    var selectedProyekText = ($('#selectProyekId option:selected').text() || '').trim().toLowerCase();
                    if (selectedProyekId === '') selectedProyekText = '';

                    var assigned = getAssignedTaskForDoc(docId, val, selectedProyekId, selectedProyekText);
                    if (assigned) {
                        $('#selectNamaTugas').val('').trigger('change');
                        hiddenInput.value = '';
                        hiddenId.value = '';
                        if (typeof Swal !== 'undefined') {
                            Swal.fire({
                                icon: 'warning',
                                title: 'Poin Sudah Ditugaskan',
                                html: 'Poin perizinan tersebut sudah ditugaskan kepada <b>' + assigned.employee_name + '</b> untuk proyek ini.<br><small class="text-muted">1 Poin perizinan hanya dapat ditugaskan ke 1 staf.</small>',
                                confirmButtonColor: '#4f46e5'
                            });
                        } else {
                            alert('Poin perizinan tersebut sudah ditugaskan kepada ' + assigned.employee_name + ' untuk proyek ini.');
                        }
                        return;
                    }

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
            } else {
                hiddenId.value = '';
            }
        });

        // Inisialisasi Select2 untuk Proyek Kawasan
        $('#selectProyekId').select2({
            placeholder: '-- Bebas / Kawasan Umum --',
            allowClear: true,
            width: '100%'
        }).on('change', function() {
            refreshMasterDocAvailability(true);
        });

        // Inisialisasi Select2 untuk Staf Legal
        $('#selectEmployeeId').select2({
            placeholder: '-- Cari & Pilih Staf Legal Pelaksana --',
            allowClear: true,
            width: '100%'
        });

        // Refresh ketersediaan dokumen saat halaman pertama kali dibuka
        refreshMasterDocAvailability(false);

        @if($isEdit)
            // Deteksi apakah nama tugas di mode edit ada di master atau merupakan teks manual
            var initialTaskName = @json($task->nama_tugas ?? '');
            if (initialTaskName) {
                var matched = false;
                $('#selectNamaTugas option').each(function() {
                    if ($(this).val() === initialTaskName) {
                        matched = true;
                        return false;
                    }
                });

                if (matched) {
                    $('#selectNamaTugas').val(initialTaskName).trigger('change');
                    switchModeTugas('master');
                } else {
                    document.getElementById('inputManualNamaTugas').value = initialTaskName;
                    document.getElementById('tambahNamaTugas').value = initialTaskName;
                    switchModeTugas('manual');
                }
            }
        @endif
    });

    // Switch Mode: Master vs Manual
    function switchModeTugas(mode) {
        currentMode = mode;
        var btnMaster     = document.getElementById('btnModeMaster');
        var btnManual     = document.getElementById('btnModeManual');
        var wrapMaster    = document.getElementById('wrapperSelectNamaTugas');
        var wrapManual    = document.getElementById('wrapperInputNamaTugas');
        var hiddenInput   = document.getElementById('tambahNamaTugas');
        var hiddenId      = document.getElementById('tambahMasterDokumenId');
        var ketMode       = document.getElementById('keteranganMode');

        if (mode === 'manual') {
            btnMaster.classList.remove('active');
            btnManual.classList.add('active');

            wrapMaster.style.display = 'none';
            wrapManual.style.display = 'block';

            var manualVal = document.getElementById('inputManualNamaTugas').value.trim();
            hiddenInput.value = manualVal;
            hiddenId.value = '';
            ketMode.textContent = 'Ketik bebas nama dokumen atau tugas perizinan yang ingin didelegasikan.';
            document.getElementById('inputManualNamaTugas').focus();
        } else {
            btnManual.classList.remove('active');
            btnMaster.classList.add('active');

            wrapManual.style.display = 'none';
            wrapMaster.style.display = 'block';

            var masterVal = $('#selectNamaTugas').val();
            hiddenInput.value = masterVal || '';
            var selectedOpt = document.getElementById('selectNamaTugas').selectedOptions[0];
            hiddenId.value = (selectedOpt && selectedOpt.dataset) ? (selectedOpt.dataset.id || '') : '';
            ketMode.textContent = 'Ketik kata kunci untuk mencari dokumen izin dari master secara live. Poin yang sudah ditugaskan otomatis dinonaktifkan.';
        }
    }

    function onManualInputNamaTugas(val) {
        document.getElementById('tambahNamaTugas').value = val.trim();
    }

    function validateFormTugaskan() {
        var namaTugas = document.getElementById('tambahNamaTugas').value.trim();
        if (!namaTugas) {
            alert('Silakan pilih dari master dokumen atau ketik nama tugas perizinan terlebih dahulu.');
            if (currentMode === 'manual') {
                document.getElementById('inputManualNamaTugas').focus();
            } else {
                $('#selectNamaTugas').select2('open');
            }
            return false;
        }

        var docId = document.getElementById('tambahMasterDokumenId').value;
        var selectedProyekId = $('#selectProyekId').val();
        var selectedProyekText = ($('#selectProyekId option:selected').text() || '').trim().toLowerCase();
        if (selectedProyekId === '') selectedProyekText = '';

        // Validasi Duplikasi Poin Perizinan
        var assigned = getAssignedTaskForDoc(docId, namaTugas, selectedProyekId, selectedProyekText);
        if (assigned) {
            var staff = assigned.employee_name || 'staf lain';
            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    icon: 'error',
                    title: 'Poin Sudah Ditugaskan',
                    html: 'Poin perizinan <b>' + namaTugas + '</b> sudah ditugaskan kepada staf <b>' + staff + '</b> untuk proyek ini.<br><small class="text-muted">1 Poin perizinan hanya dapat ditugaskan ke 1 staf. Poin ini tidak bisa diinputkan lagi.</small>',
                    confirmButtonColor: '#4f46e5'
                });
            } else {
                alert('Poin perizinan ' + namaTugas + ' sudah ditugaskan kepada staf ' + staff + ' untuk proyek ini. 1 Poin hanya dapat ditugaskan ke 1 staf.');
            }
            return false;
        }

        var staf = document.getElementById('selectEmployeeId').value;
        if (!staf) {
            alert('Silakan pilih Staf Legal Pelaksana.');
            $('#selectEmployeeId').select2('open');
            return false;
        }

        return true;
    }
</script>
@endpush
