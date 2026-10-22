@extends('layouts.partial.app')

@section('title', isset($employee) ? 'Edit Pengguna - Property Management App' : 'Tambah Pengguna - Property Management App')

@section('content')

<div class="container-fluid px-1 px-sm-2 px-md-3 py-2 py-md-3">

    <!-- Header Card Banner -->
    <div class="row mb-3 mb-md-4">
        <div class="col-12">
            <div class="card shadow-sm border-0 header-card">
                <div class="card-body p-4 p-md-4 py-4 py-md-4 d-flex flex-wrap justify-content-between align-items-center gap-3" style="min-height: 105px;">
                    <div>
                        <h3 class="text-dark mb-1 fw-bold" style="font-size: 1.35rem;">
                            {{ isset($employee) ? 'Edit Data Pengguna' : 'Tambah Data Pengguna' }}
                        </h3>
                        <p class="text-muted mb-0" style="font-size: 0.9rem;">
                            {{ isset($employee) ? 'Perbarui data akun dan informasi hak akses pengguna' : 'Buat akun staf/pengguna baru untuk operasional sistem properti' }}
                        </p>
                    </div>
                    <div class="d-flex align-items-center gap-3">
                        <a href="{{ route('agency.index') }}" class="btn btn-sm btn-gradient-secondary d-flex align-items-center gap-1 btn-back shadow-sm px-3 py-2">
                            <i class="mdi mdi-arrow-left" style="font-size: 1rem;"></i>
                            <span>Kembali</span>
                        </a>
                        <div class="d-none d-md-block pe-2">
                            <i class="mdi {{ isset($employee) ? 'mdi-account-edit' : 'mdi-account-plus' }}" style="font-size: 3rem; color: #9a55ff; opacity: 0.25;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Form Tambah/Edit Pengguna -->
    <div class="row mt-2 mt-sm-2 mt-md-3">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white d-flex flex-wrap flex-md-row justify-content-between align-items-center gap-2">
                    <h5 class="card-title mb-0">
                        <i class="mdi mdi-form-select me-2"></i>
                        {{ isset($employee) ? 'Formulir Edit Data Pengguna' : 'Formulir Registrasi Pengguna Baru' }}
                    </h5>
                    <span class="badge bg-light text-muted border px-2 py-1" style="font-size: 0.75rem;">
                        <span class="text-danger">*</span> Wajib Diisi
                    </span>
                </div>

                <div class="card-body p-3 p-md-4">
                    <form action="{{ isset($employee) ? route('agency.update', $employee->id) : route('agency.store') }}" method="POST" class="main-form">
                        @csrf
                        @if(isset($employee))
                            @method('PUT')
                        @endif

                        <!-- Alert info -->
                        <div class="alert alert-info border-0 shadow-sm d-flex align-items-center gap-2 mb-4 py-2 px-3" style="background: rgba(154, 85, 255, 0.08); border-left: 4px solid #9a55ff !important; border-radius: 8px;">
                            <i class="mdi mdi-information-outline text-primary" style="font-size: 1.25rem;"></i>
                            <span class="text-dark" style="font-size: 0.85rem;">
                                Akun pengguna ini digunakan untuk autentikasi login, otorisasi menu, dan penugasan pada sistem manajemen properti.
                            </span>
                        </div>

                        <div class="row g-3 mb-3">
                            <!-- Nama Lengkap -->
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-dark" style="font-size: 0.85rem;">
                                    Nama Lengkap <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="name" class="form-control"
                                    placeholder="Contoh: Budi Santoso"
                                    value="{{ old('name', $employee->name ?? '') }}" required>
                            </div>

                            <!-- Username -->
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-dark" style="font-size: 0.85rem;">
                                    Username <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="username" class="form-control"
                                    placeholder="Contoh: budi.santoso"
                                    value="{{ old('username', $employee->username ?? '') }}" required>
                            </div>
                        </div>

                        <div class="row g-3 mb-3">
                            <!-- Password -->
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-dark" style="font-size: 0.85rem;">
                                    {{ isset($employee) ? 'Password Baru (kosongkan jika tidak diubah)' : 'Password Akun *' }}
                                </label>
                                <div class="input-group">
                                    <input type="password" name="password" id="password" class="form-control"
                                        placeholder="{{ isset($employee) ? 'Masukkan password baru jika ingin mengubah' : 'Minimal 5 karakter' }}"
                                        {{ isset($employee) ? '' : 'required' }}
                                        style="border-top-right-radius: 0 !important; border-bottom-right-radius: 0 !important; border-right: none;">
                                    <button class="btn btn-outline-secondary d-flex align-items-center justify-content-center px-3" 
                                        type="button" onclick="togglePassword('password', this)"
                                        style="border-top-left-radius: 0 !important; border-bottom-left-radius: 0 !important; border-top-right-radius: 4px !important; border-bottom-right-radius: 4px !important; border-color: #e9ecef; background: #f8f9fa;">
                                        <i class="mdi mdi-eye" style="font-size: 1.1rem; color: #6c7383;"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Nomor HP -->
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-dark" style="font-size: 0.85rem;">
                                    Nomor Handphone / WhatsApp <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="phone" class="form-control"
                                    placeholder="Contoh: 081234567890"
                                    value="{{ old('phone', $employee->phone ?? '') }}" required>
                            </div>
                        </div>

                        <div class="row g-3 mb-3">
                            <!-- Divisi -->
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-dark" style="font-size: 0.85rem;">
                                    Divisi <span class="text-danger">*</span>
                                </label>
                                <select name="division_id" id="divisionSelect" class="form-control" required {{ count($divisions) === 1 ? 'style=background-color:#f8f9fa;' : '' }}>
                                    @if(count($divisions) > 1)
                                        <option value="">-- Pilih Divisi --</option>
                                    @endif
                                    @foreach($divisions as $division)
                                        <option value="{{ $division->id }}"
                                            {{ old('division_id', $employee->division_id ?? ($defaultDivisionId ?? '')) == $division->id ? 'selected' : '' }}>
                                            {{ $division->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @if(count($divisions) === 1)
                                    <small class="text-muted mt-1 d-block" style="font-size: 0.76rem;">
                                        <i class="mdi mdi-lock-outline text-primary me-1"></i>Otomatis disesuaikan dengan Divisi Marketing
                                    </small>
                                @endif
                            </div>

                            <!-- Posisi / Jabatan -->
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-dark" style="font-size: 0.85rem;">
                                    Posisi / Jabatan <span class="text-danger">*</span>
                                </label>
                                <select name="position_id" id="positionSelect" class="form-control" required>
                                    <option value="">-- Pilih Posisi / Jabatan --</option>
                                    @foreach($positions as $position)
                                        <option value="{{ $position->id }}" data-division="{{ $position->division_id }}"
                                            {{ old('position_id', $employee->position_id ?? ($defaultPositionId ?? '')) == $position->id ? 'selected' : '' }}>
                                            {{ $position->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @if(count($divisions) === 1)
                                    <small class="text-muted mt-1 d-block" style="font-size: 0.76rem;">
                                        <i class="mdi mdi-check-circle-outline text-success me-1"></i>Otomatis diatur ke Posisi Staff Marketing
                                    </small>
                                @endif
                            </div>
                        </div>

                        <!-- Alamat -->
                        <div class="row g-3 mb-4">
                            <div class="col-12">
                                <label class="form-label fw-bold text-dark" style="font-size: 0.85rem;">
                                    Alamat Lengkap <span class="text-danger">*</span>
                                </label>
                                <textarea name="address" class="form-control" rows="3" placeholder="Masukkan alamat lengkap tempat tinggal..." required>{{ old('address', $employee->address ?? '') }}</textarea>
                            </div>
                        </div>

                        <hr class="my-4" style="border-top: 1px solid #e9ecef;">

                        <!-- Tombol Aksi Form Mentok Kanan -->
                        <div class="d-flex justify-content-end align-items-center gap-2 pt-1">
                            <button type="reset" class="btn btn-sm btn-outline-secondary px-3 btn-reset" style="width: auto;">
                                <i class="mdi mdi-refresh me-1"></i>Reset Form
                            </button>

                            <button type="submit" class="btn btn-sm btn-gradient-primary px-4 d-flex align-items-center gap-1 shadow-sm" style="width: auto;">
                                <i class="mdi mdi-content-save me-1"></i>
                                <span>{{ isset($employee) ? 'Update Pengguna' : 'Simpan Pengguna' }}</span>
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function togglePassword(inputId, button) {
    const passwordInput = document.getElementById(inputId);
    const icon = button.querySelector('i');

    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        icon.classList.remove('mdi-eye');
        icon.classList.add('mdi-eye-off');
    } else {
        passwordInput.type = 'password';
        icon.classList.remove('mdi-eye-off');
        icon.classList.add('mdi-eye');
    }
}

document.addEventListener("DOMContentLoaded", function() {
    // Dynamic Filter Posisi berdasarkan Divisi
    const divisionSelect = document.getElementById('divisionSelect');
    const positionSelect = document.getElementById('positionSelect');
    if (divisionSelect && positionSelect) {
        function filterPositions() {
            const selectedDiv = divisionSelect.value;
            let firstValid = null;
            let currentSelectedStillValid = false;

            Array.from(positionSelect.options).forEach((opt, idx) => {
                if (idx === 0) return; // placeholder
                const optDiv = opt.getAttribute('data-division');
                if (!selectedDiv || optDiv === selectedDiv) {
                    opt.style.display = '';
                    opt.disabled = false;
                    if (!firstValid) firstValid = opt.value;
                    if (opt.value === positionSelect.value) currentSelectedStillValid = true;
                } else {
                    opt.style.display = 'none';
                    opt.disabled = true;
                }
            });

            if (!currentSelectedStillValid && firstValid && selectedDiv) {
                positionSelect.value = firstValid;
            }
        }

        divisionSelect.addEventListener('change', filterPositions);
        filterPositions();
    }

    function showLoading(message = 'Mohon tunggu sebentar...') {
        Swal.fire({
            title: 'Memuat...',
            text: message,
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });
    }

    const form = document.querySelector('.main-form');
    if (form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();

            Swal.fire({
                title: '{{ isset($employee) ? 'Update Data Pengguna?' : 'Simpan Data Pengguna?' }}',
                text: 'Pastikan seluruh isian data pengguna sudah benar.',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#9a55ff',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, {{ isset($employee) ? 'Update!' : 'Simpan!' }}',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    showLoading('{{ isset($employee) ? 'Mengupdate data...' : 'Menyimpan data...' }}');
                    form.submit();
                }
            });
        });
    }

    const backBtn = document.querySelector('.btn-back');
    if (backBtn) {
        backBtn.addEventListener('click', function(e) {
            e.preventDefault();
            showLoading('Kembali ke daftar pengguna...');
            window.location.href = this.href;
        });
    }

    const resetBtn = document.querySelector('.btn-reset');
    if (resetBtn) {
        resetBtn.addEventListener('click', function() {
            Swal.fire({
                icon: 'info',
                title: 'Form Direset',
                timer: 1000,
                showConfirmButton: false
            });
        });
    }
});

@if(session('success'))
    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: "{{ session('success') }}",
        timer: 2500,
        timerProgressBar: true,
        showConfirmButton: true,
        confirmButtonColor: '#9a55ff'
    });
@endif

@if(session('error'))
    Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: "{{ session('error') }}",
        showConfirmButton: true,
        confirmButtonColor: '#dc3545'
    });
@endif

@if ($errors->any())
    Swal.fire({
        icon: 'error',
        title: 'Validasi Gagal',
        html: `{!! implode('<br>', $errors->all()) !!}`,
        confirmButtonColor: '#dc3545',
        confirmButtonText: 'Tutup'
    });
@endif
</script>
@endpush
