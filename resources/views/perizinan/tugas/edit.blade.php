@extends('layouts.partial.app')

@section('title', 'Edit Penugasan Staf Legal - Property Management App')

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
                Edit Penugasan Staf Legal
            </h2>
            <p class="text-muted mb-0" style="font-size: 0.88rem;">
                Perbarui rincian berkas izin, alihkan penugasan staf (reassign), atau sesuaikan tenggat waktu.
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
                        <div style="width: 32px; height: 32px; border-radius: 5px; background-color: #fef3c7; color: #d97706; display: inline-flex; align-items: center; justify-content: center; font-size: 1.15rem; flex-shrink: 0; margin-right: 8px;">
                            <i class="mdi mdi-account-edit-outline"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold text-dark mb-0" style="font-size: 0.98rem;">Formulir Perubahan Data Penugasan</h5>
                            <small class="text-muted" style="font-size: 0.78rem;">ID Tugas #{{ $task->id }} &bull; Dibuat {{ $task->created_at->format('d M Y, H:i') }}</small>
                        </div>
                    </div>

                    <!-- Badge Status Saat Ini -->
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
                </div>

                <!-- Form Body -->
                <div class="card-body">
                    <form action="{{ route('perizinan.tugas.update', $task->id) }}" method="POST" id="formEditTugaskanLegal">
                        @csrf
                        @method('PUT')

                        <div class="row g-3">

                            <!-- 1. Nama Dokumen / Tugas Perizinan -->
                            <div class="col-md-7">
                                <label class="form-label-custom">
                                    Nama Dokumen / Tugas Perizinan <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="nama_tugas" id="editNamaTugas" class="form-control form-control-custom" placeholder="Nama berkas atau tugas izin..." value="{{ old('nama_tugas', $task->nama_tugas) }}" required>
                                <small class="text-muted d-block mt-1" style="font-size: 0.74rem;">
                                    Nama resmi dokumen atau perizinan yang didelegasikan.
                                </small>
                            </div>

                            <!-- 2. Instansi Terkait -->
                            <div class="col-md-5">
                                <label class="form-label-custom">
                                    Instansi / Dinas Terkait
                                </label>
                                <input type="text" name="instansi" id="editInstansi" class="form-control form-control-custom" placeholder="Contoh: DPMPTSP / BPN / DLH" value="{{ old('instansi', $task->instansi) }}">
                                <small class="text-muted d-block mt-1" style="font-size: 0.74rem;">
                                    Dinas atau kementerian penanggung jawab izin.
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
                                        <option value="{{ $proj['id'] }}" {{ (old('proyek_id', $task->proyek_id) == $proj['id']) ? 'selected' : '' }}>
                                            {{ $proj['nama'] }}
                                        </option>
                                    @endforeach
                                </select>
                                <small class="text-muted d-block mt-1" style="font-size: 0.74rem;">
                                    Tautkan berkas izin ini ke proyek kawasan tertentu.
                                </small>
                            </div>

                            <!-- 4. Ditugaskan Kepada (Staf Legal Pelaksana - Reassign) -->
                            <div class="col-md-6">
                                <label class="form-label-custom">
                                    Ditugaskan Kepada (Staf Legal) <span class="text-danger">*</span>
                                </label>
                                <select name="employee_id" id="selectEmployeeId" class="form-select form-select-custom" required>
                                    <option value="">-- Cari & Pilih Staf Legal Pelaksana --</option>
                                    @foreach($legalStaffs as $staf)
                                        <option value="{{ $staf->id }}" {{ (old('employee_id', $task->employee_id) == $staf->id) ? 'selected' : '' }}>
                                            {{ $staf->name }} &bull; {{ $staf->position->name ?? 'Staff Legal' }}
                                        </option>
                                    @endforeach
                                </select>
                                <small class="text-muted d-block mt-1" style="font-size: 0.74rem;">
                                    Ganti staf jika ingin mengalihkan tanggung jawab tugas (*reassign*).
                                </small>
                            </div>

                            <!-- 5. Tenggat Waktu (Deadline) -->
                            <div class="col-md-6">
                                <label class="form-label-custom">
                                    Tenggat Waktu Selesai (Deadline)
                                </label>
                                <input type="date" name="deadline" class="form-control form-control-custom" value="{{ old('deadline', $task->deadline ? $task->deadline->format('Y-m-d') : '') }}">
                                <small class="text-muted d-block mt-1" style="font-size: 0.74rem;">
                                    Sistem akan menandai status "Terlambat" jika melewati tanggal ini.
                                </small>
                            </div>

                            <!-- 6. Status Tugas -->
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

                            <!-- 7. Instruksi & Catatan Khusus -->
                            <div class="col-12">
                                <label class="form-label-custom">
                                    Instruksi / Catatan Khusus Penugasan
                                </label>
                                <textarea name="catatan" rows="4" class="form-control form-control-custom" placeholder="Tuliskan arahan spesifik pengurusan berkas, persyaratan wajib, dll.">{{ old('catatan', $task->catatan) }}</textarea>
                            </div>

                        </div>

                        <!-- Divider & Action Buttons -->
                        <div class="d-flex align-items-center justify-content-between pt-4 mt-4 border-top">
                            <a href="{{ route('perizinan.tugas.index') }}" class="btn btn-light border px-4 py-2 fw-semibold d-inline-flex align-items-center" style="border-radius: 5px; font-size: 0.86rem; color: #475569;">
                                <i class="mdi mdi-close" style="font-size: 1rem; margin-right: 6px !important;"></i>
                                <span>Batal</span>
                            </a>

                            <button type="submit" class="btn btn-primary px-4 py-2 fw-semibold shadow-sm d-inline-flex align-items-center" style="border-radius: 5px; font-size: 0.88rem; background-color: #4f46e5; border-color: #4f46e5;">
                                <i class="mdi mdi-content-save-check-outline" style="font-size: 1.1rem; margin-right: 8px !important;"></i>
                                <span>Simpan Perubahan Penugasan</span>
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
    $(document).ready(function() {
        // Inisialisasi Select2 untuk Proyek Kawasan
        $('#selectProyekId').select2({
            placeholder: '-- Bebas / Kawasan Umum --',
            allowClear: true,
            width: '100%'
        });

        // Inisialisasi Select2 untuk Staf Legal
        $('#selectEmployeeId').select2({
            placeholder: '-- Cari & Pilih Staf Legal Pelaksana --',
            allowClear: true,
            width: '100%'
        });
    });
</script>
@endpush
