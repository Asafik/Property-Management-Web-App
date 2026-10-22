@extends('layouts.partial.app')

@section('title', (isset($guest) ? 'Edit' : 'Tambah') . ' Tamu / Proyeksi - Property Management')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard-clean.css') }}?v={{ time() }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    <style>
        /* Tombol Kembali Sama Persis Halaman Perizinan Kelola */
        .btn-kembali-proyek {
            border-radius: 6px !important;
            font-size: 0.85rem;
            font-weight: 700;
            border: 1px solid #64748b !important;
            background-color: #64748b !important;
            color: #ffffff !important;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1) !important;
            transition: all 0.15s ease;
            text-decoration: none;
        }
        .btn-kembali-proyek:hover {
            background-color: #475569 !important;
            border-color: #475569 !important;
            color: #ffffff !important;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15) !important;
        }

        /* 1 Card Tunggal Rapi */
        .main-form-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            box-shadow: none;
            overflow: hidden;
        }

        .main-form-card .card-header {
            background: #ffffff;
            border-bottom: 1px solid #e2e8f0;
            padding: 1rem 1.4rem;
        }

        .section-sub-title {
            font-size: 0.92rem;
            font-weight: 700;
            color: #0f172a;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 1.25rem;
            padding-bottom: 0.6rem;
            border-bottom: 1px solid #f1f5f9;
        }

        .form-label {
            font-size: 0.82rem;
            font-weight: 700;
            color: #334155;
            margin-bottom: 0.4rem;
            text-transform: uppercase;
            letter-spacing: 0.4px;
        }

        .form-control, .form-select {
            border: 1.5px solid #e2e8f0;
            border-radius: 6px;
            padding: 0.6rem 0.85rem;
            font-size: 0.88rem;
            color: #1e293b;
            background-color: #ffffff;
            transition: all 0.2s ease;
        }

        .form-control:focus, .form-select:focus {
            border-color: #7c3aed !important;
            box-shadow: 0 0 0 3px rgba(124, 58, 237, 0.15) !important;
            outline: none;
        }

        .input-group > :first-child {
            border-top-left-radius: 6px !important;
            border-bottom-left-radius: 6px !important;
        }
        .input-group > :last-child {
            border-top-right-radius: 6px !important;
            border-bottom-right-radius: 6px !important;
        }

        /* Select2 alignment */
        .select2-container--bootstrap-5 .select2-selection {
            min-height: 42px !important;
            border: 1.5px solid #e2e8f0 !important;
            border-radius: 6px !important;
            padding: 0.4rem 0.75rem !important;
        }

        .select2-container--bootstrap-5.select2-container--focus .select2-selection,
        .select2-container--bootstrap-5.select2-container--open .select2-selection {
            border-color: #7c3aed !important;
            box-shadow: 0 0 0 3px rgba(124, 58, 237, 0.15) !important;
        }

        .btn-solid-primary {
            background-color: #7c3aed;
            border: 1px solid #7c3aed;
            color: #ffffff;
            font-weight: 600;
            border-radius: 6px;
            padding: 0.6rem 1.4rem;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            transition: all 0.2s ease;
            box-shadow: 0 1px 3px rgba(124, 58, 237, 0.3);
        }

        .btn-solid-primary:hover {
            background-color: #6d28d9;
            border-color: #6d28d9;
            color: #ffffff;
        }

        .btn-solid-secondary {
            background-color: #64748b;
            border: 1px solid #64748b;
            color: #ffffff;
            font-weight: 600;
            border-radius: 6px;
            padding: 0.6rem 1.4rem;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            transition: all 0.2s ease;
            text-decoration: none;
        }

        .btn-solid-secondary:hover {
            background-color: #475569;
            border-color: #475569;
            color: #ffffff;
        }

        @media (min-width: 992px) {
            .border-col-divider {
                border-right: 1px solid #f1f5f9;
            }
        }
    </style>
@endpush

@section('content')
<div class="container-fluid px-2 px-md-4 py-3">

    <!-- Top Header Breadcrumb & Actions (Sama Persis Format Halaman Perizinan Kelola) -->
    <div class="d-flex flex-wrap justify-content-between align-items-md-center align-items-stretch gap-3 mb-4">
        <div>
            <h2 class="text-dark mb-1 fw-bold" style="font-size: 1.55rem; letter-spacing: -0.02em;">
                {{ isset($guest) ? 'Edit Data Calon Pembeli / Proyeksi' : 'Tambah Calon Pembeli / Proyeksi' }}
            </h2>
            <p class="text-muted mb-0" style="font-size: 0.88rem;">
                @if(isset($guest))
                    Perbarui data kontak, minat unit, status prospek, dan jadwal follow up untuk <strong class="text-dark">{{ $guest->name }}</strong>
                @else
                    Input data prospek dan calon pembeli baru untuk follow up pemasaran unit properti
                @endif
            </p>
        </div>

        <div class="d-flex align-items-center gap-2">
            <a href="{{ route('customer.tamu') }}" class="btn btn-sm d-inline-flex align-items-center gap-2 px-3 py-2 shadow-sm btn-kembali-proyek">
                <i class="mdi mdi-arrow-left text-white" style="font-size: 1.05rem; line-height: 1;"></i>
                <span>Kembali ke Daftar Tamu</span>
            </a>
        </div>
    </div>

    @if (isset($errors) && $errors->any())
        <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert" style="border-radius: 8px;">
            <div class="d-flex align-items-center gap-2">
                <i class="mdi mdi-alert-circle font-size-18"></i>
                <div>
                    <h6 class="mb-0 fw-bold">Terdapat kesalahan pengisian formulir:</h6>
                    <ul class="mb-0 ps-3 mt-1" style="font-size: 0.85rem;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- 1 Card Tunggal Rapi (Tetap 2 Kolom Kiri & Kanan di dalamnya) -->
    <div class="main-form-card">
        <div class="card-header d-flex align-items-center gap-2">
            <div style="width: 32px; height: 32px; border-radius: 6px; background-color: #f3e8ff; color: #9333ea; display: inline-flex; align-items: center; justify-content: center; font-size: 1.15rem; flex-shrink: 0;">
                <i class="mdi {{ isset($guest) ? 'mdi-account-edit' : 'mdi-account-plus' }}"></i>
            </div>
            <span style="font-size: 0.95rem; font-weight: 700; color: #0f172a;">
                {{ isset($guest) ? 'Formulir Edit Proyeksi: ' . $guest->name : 'Formulir Data Proyeksi Baru' }}
            </span>
        </div>

        <div class="card-body p-3 p-md-4">
            <form action="{{ isset($guest) ? route('customer.tamu.update', $guest->id) : route('customer.tamu.store') }}" method="POST" id="formTamu">
                @csrf
                @if(isset($guest))
                    @method('PUT')
                @endif

                <div class="row g-4">
                    <!-- KOLOM KIRI: Informasi Calon Pembeli -->
                    <div class="col-12 col-lg-6 pe-lg-4 border-col-divider">
                        <div class="section-sub-title">
                            <i class="mdi mdi-account text-primary" style="font-size: 1.15rem;"></i>
                            <span>Informasi Calon Pembeli</span>
                        </div>

                        <!-- Nama Lengkap -->
                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="name" value="{{ old('name', $guest->name ?? '') }}" placeholder="Contoh: Budi Santoso" required>
                        </div>

                        <!-- No HP -->
                        <div class="mb-3">
                            <label class="form-label">No. WhatsApp / HP <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text" style="background: #f8fafc; border: 1.5px solid #e2e8f0; border-right: none; color: #64748b; font-size: 0.88rem;">
                                    <i class="mdi mdi-phone"></i>
                                </span>
                                <input type="text" class="form-control" name="phone" value="{{ old('phone', $guest->phone ?? '') }}" placeholder="Contoh: 081234567890" style="border-left: none;" required>
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <div class="input-group">
                                <span class="input-group-text" style="background: #f8fafc; border: 1.5px solid #e2e8f0; border-right: none; color: #64748b; font-size: 0.88rem;">
                                    <i class="mdi mdi-email-outline"></i>
                                </span>
                                <input type="email" class="form-control" name="email" value="{{ old('email', $guest->email ?? '') }}" placeholder="Contoh: budi@gmail.com" style="border-left: none;">
                            </div>
                        </div>

                        <!-- Sumber Informasi -->
                        <div class="mb-0">
                            <label class="form-label">Sumber Informasi <span class="text-danger">*</span></label>
                            @php
                                $currentSource = (string) old('source', $guest->source ?? '');
                            @endphp
                            <select class="form-select" name="source" required>
                                <option value="">-- Pilih Sumber Informasi --</option>
                                <option value="Instagram" {{ strcasecmp($currentSource, 'Instagram') === 0 ? 'selected' : '' }}>Instagram</option>
                                <option value="Facebook" {{ strcasecmp($currentSource, 'Facebook') === 0 ? 'selected' : '' }}>Facebook</option>
                                <option value="TikTok" {{ strcasecmp($currentSource, 'TikTok') === 0 ? 'selected' : '' }}>TikTok</option>
                                <option value="Website" {{ strcasecmp($currentSource, 'Website') === 0 ? 'selected' : '' }}>Website</option>
                                <option value="Referensi" {{ strcasecmp($currentSource, 'Referensi') === 0 ? 'selected' : '' }}>Referensi</option>
                                <option value="Pameran" {{ strcasecmp($currentSource, 'Pameran') === 0 ? 'selected' : '' }}>Pameran</option>
                                <option value="Walk-in" {{ strcasecmp($currentSource, 'Walk-in') === 0 ? 'selected' : '' }}>Walk-in</option>
                                <option value="Lainnya" {{ strcasecmp($currentSource, 'Lainnya') === 0 ? 'selected' : '' }}>Lainnya</option>
                            </select>
                        </div>
                    </div>

                    <!-- KOLOM KANAN: Minat Properti & Penugasan -->
                    <div class="col-12 col-lg-6 ps-lg-4">
                        <div class="section-sub-title">
                            <i class="mdi mdi-home-analytics text-warning" style="font-size: 1.15rem;"></i>
                            <span>Minat Properti & Penugasan</span>
                        </div>

                        <!-- Proyek Minat -->
                        <div class="mb-3">
                            <label class="form-label">Proyek Minat <span class="text-danger">*</span></label>
                            <select class="form-control" name="land_bank_id" id="projectSelect" required style="width: 100%;">
                                <option value="">-- Pilih Proyek --</option>
                                @foreach ($projects as $project)
                                    <option value="{{ $project->id }}" {{ old('land_bank_id', $guest->land_bank_id ?? '') == $project->id ? 'selected' : '' }}>
                                        {{ $project->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Tipe Unit -->
                        <div class="mb-3">
                            <label class="form-label">Tipe Unit Minat</label>
                            <select class="form-control" name="unit_id" id="unitSelect" style="width: 100%;">
                                <option value="">-- Pilih Proyek Terlebih Dahulu --</option>
                            </select>
                        </div>

                        <div class="row g-3">
                            <!-- Agent / Sales -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Agent / Sales <span class="text-danger">*</span></label>
                                @if ($isStaff ?? false)
                                    <input type="hidden" name="assigned_to" value="{{ old('assigned_to', $guest->assigned_to ?? ($currentUser->id ?? auth()->id())) }}">
                                    <div class="input-group">
                                        <span class="input-group-text bg-light text-muted" style="border: 1.5px solid #e2e8f0; border-right: none; font-size: 0.88rem;">
                                            <i class="mdi mdi-account-check text-success"></i>
                                        </span>
                                        @php
                                            $assignedAgentName = $guest->employee?->name ?? ($currentUser->name ?? (auth()->user()?->name ?? 'Staff Marketing'));
                                        @endphp
                                        <input type="text" class="form-control bg-light text-dark fw-bold" value="{{ $assignedAgentName }}" readonly style="border-left: none; cursor: not-allowed;">
                                    </div>
                                @else
                                    <select class="form-select" name="assigned_to" required>
                                        <option value="">-- Pilih Agent --</option>
                                        @foreach ($agents as $agent)
                                            <option value="{{ $agent->id }}" {{ old('assigned_to', $guest->assigned_to ?? auth()->id()) == $agent->id ? 'selected' : '' }}>
                                                {{ $agent->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                @endif
                            </div>

                            <!-- Status Prospek -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Status Prospek <span class="text-danger">*</span></label>
                                @php
                                    $currentStatus = old('status', $guest->status ?? 'medium_prospect');
                                @endphp
                                <select class="form-select" name="status" required>
                                    <option value="">-- Pilih Status --</option>
                                    <option value="hot_prospect" {{ $currentStatus == 'hot_prospect' ? 'selected' : '' }}>Hot Prospek</option>
                                    <option value="medium_prospect" {{ $currentStatus == 'medium_prospect' ? 'selected' : '' }}>Medium Prospek</option>
                                    <option value="cold_prospect" {{ $currentStatus == 'cold_prospect' ? 'selected' : '' }}>Cold Prospek</option>
                                    <option value="converted" {{ $currentStatus == 'converted' ? 'selected' : '' }}>Deal / Booking</option>
                                    <option value="lost" {{ $currentStatus == 'lost' ? 'selected' : '' }}>Gagal / Batal</option>
                                </select>
                            </div>
                        </div>

                        <div class="row g-3">
                            <!-- Budget (Anggaran) -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Budget / Anggaran</label>
                                <div class="input-group">
                                    <span class="input-group-text fw-bold text-primary" style="background: #f8fafc; border: 1.5px solid #e2e8f0; border-right: none; font-size: 0.88rem;">Rp</span>
                                    <input type="text" class="form-control" name="budget" id="budgetInput" value="{{ old('budget', isset($guest) && $guest->budget ? number_format((float)str_replace(['.', ','], '', $guest->budget), 0, ',', '.') : '') }}" placeholder="Contoh: 350.000.000" style="border-left: none;">
                                </div>
                            </div>

                            <!-- Next Follow Up -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Next Follow Up <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" name="next_follow_up" value="{{ old('next_follow_up', isset($guest) && $guest->next_follow_up ? \Carbon\Carbon::parse($guest->next_follow_up)->format('Y-m-d') : now()->addDays(1)->format('Y-m-d')) }}" required>
                            </div>
                        </div>

                        <!-- Last Follow Up (Khusus saat Edit) -->
                        @if(isset($guest))
                            <div class="mb-3">
                                <label class="form-label">Terakhir Dihubungi (Last Follow Up)</label>
                                <input type="datetime-local" class="form-control" name="last_follow_up" value="{{ old('last_follow_up', $guest->last_follow_up ? \Carbon\Carbon::parse($guest->last_follow_up)->format('Y-m-d\TH:i') : '') }}">
                                <small class="text-muted" style="font-size: 0.78rem;">Waktu terakhir kali calon pembeli ini dikontak/difollow-up.</small>
                            </div>
                        @endif

                        <!-- Catatan -->
                        <div class="mb-0">
                            <label class="form-label">Catatan Tambahan</label>
                            <textarea class="form-control" name="notes" rows="3" placeholder="Catatan preferensi pembeli, lokasi kerja, cara pembayaran yang diinginkan, dll...">{{ old('notes', $guest->notes ?? '') }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Footer Action Buttons (Menyatu Rapi di Bawah Form) -->
                <div class="d-flex align-items-center justify-content-end gap-2 pt-4 mt-4" style="border-top: 1px solid #e2e8f0;">
                    <a href="{{ route('customer.tamu') }}" class="btn-solid-secondary">
                        <i class="mdi mdi-close"></i>
                        <span>Batal</span>
                    </a>
                    <button type="submit" class="btn-solid-primary">
                        <i class="mdi mdi-content-save"></i>
                        <span>{{ isset($guest) ? 'Simpan Perubahan' : 'Simpan Proyeksi' }}</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        const projectsData = @json($projects);
        const allUnitsData = @json($units);
        const selectedUnitIdInitial = '{{ old('unit_id', $guest->unit_id ?? '') }}';

        function getUnitDisplayName(unit) {
            let name = unit.unit_name || unit.unit_code || ('Unit #' + unit.id);
            if (unit.block) {
                name += ' (Blok ' + unit.block + (unit.unit_number ? ' No. ' + unit.unit_number : '') + ')';
            }
            if (unit.type) {
                name += ' - Tipe ' + unit.type;
            }
            return name;
        }

        function filterUnitsForSelect(selectEl, projectId, selectedUnitId = null) {
            const $select = $(selectEl);
            if (!$select.length) return;

            $select.empty();

            if (!projectId) {
                $select.append('<option value="">-- Pilih Proyek Terlebih Dahulu --</option>');
            } else {
                $select.append('<option value="">-- Pilih Unit --</option>');

                let unitsToRender = [];
                const selectedProject = projectsData.find(p => String(p.id) === String(projectId));
                if (selectedProject && selectedProject.units && selectedProject.units.length > 0) {
                    unitsToRender = selectedProject.units;
                } else {
                    unitsToRender = allUnitsData.filter(u => String(u.land_bank_id) === String(projectId));
                }

                if (unitsToRender.length === 0) {
                    $select.append('<option value="" disabled>Tidak ada unit tersedia untuk proyek ini</option>');
                } else {
                    unitsToRender.forEach(unit => {
                        const isSelected = selectedUnitId && String(selectedUnitId) === String(unit.id);
                        const opt = new Option(getUnitDisplayName(unit), unit.id, false, isSelected);
                        $(opt).attr('data-project', unit.land_bank_id);
                        $select.append(opt);
                    });
                }
            }

            if (selectedUnitId) {
                $select.val(selectedUnitId);
            } else {
                $select.val('');
            }

            if ($select.hasClass('select2-hidden-accessible')) {
                $select.trigger('change.select2');
            }
        }

        $(document).ready(function() {
            $('#projectSelect').select2({
                theme: 'bootstrap-5',
                placeholder: '-- Pilih Proyek --',
                allowClear: true,
                width: '100%'
            });

            $('#unitSelect').select2({
                theme: 'bootstrap-5',
                placeholder: '-- Pilih Proyek Terlebih Dahulu --',
                allowClear: true,
                width: '100%'
            });

            $('#projectSelect').on('change select2:select select2:clear', function() {
                const projectId = $(this).val();
                filterUnitsForSelect($('#unitSelect'), projectId, null);
            });

            // Initial trigger if project is pre-selected (e.g. on Edit or validation error)
            const initProjectId = $('#projectSelect').val();
            if (initProjectId) {
                filterUnitsForSelect($('#unitSelect'), initProjectId, selectedUnitIdInitial);
            }

            // Budget format
            const budgetInput = document.getElementById('budgetInput');
            if (budgetInput) {
                budgetInput.addEventListener('input', function() {
                    let onlyNumbers = this.value.replace(/\D/g, '');
                    if (onlyNumbers) {
                        this.value = new Intl.NumberFormat('id-ID').format(onlyNumbers);
                    } else {
                        this.value = '';
                    }
                });
            }

            $('#formTamu').on('submit', function() {
                Swal.fire({
                    title: 'Menyimpan Data...',
                    text: 'Mohon tunggu sebentar',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
            });
        });
    </script>
@endpush
