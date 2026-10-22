@extends('layouts.partial.app')

@section('title', 'Detail Calon Pembeli - ' . $guest->name . ' - Property Management')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard-clean.css') }}?v={{ time() }}">
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

        /* 1 Card Tunggal Rapi Persis Seperti Halaman Tambah/Tabel */
        .main-form-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            box-shadow: none;
            overflow: hidden;
            margin-bottom: 1.5rem;
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

        .info-label {
            font-size: 0.78rem;
            font-weight: 700;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.4px;
            margin-bottom: 0.25rem;
        }

        .info-value {
            font-size: 0.92rem;
            font-weight: 600;
            color: #1e293b;
        }

        /* Badges - Bersih, Tidak Terlalu Bulat */
        .badge-status {
            padding: 0.3rem 0.65rem;
            border-radius: 4px;
            font-weight: 600;
            font-size: 0.76rem;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .badge-status.new {
            background: #e0f2fe;
            color: #0284c7;
            border: 1px solid #bae6fd;
        }

        .badge-status.follow_up {
            background: #fef3c7;
            color: #b45309;
            border: 1px solid #fde68a;
        }

        .badge-status.negotiation {
            background: #f3e8ff;
            color: #7e22ce;
            border: 1px solid #e9d5ff;
        }

        .badge-status.converted {
            background: #dcfce7;
            color: #15803d;
            border: 1px solid #bbf7d0;
        }

        .badge-status.lost {
            background: #f1f5f9;
            color: #64748b;
            border: 1px solid #e2e8f0;
        }

        .badge-status.hot_prospect {
            background: #fee2e2;
            color: #b91c1c;
            border: 1px solid #fecaca;
        }

        .badge-status.medium_prospect {
            background: #fef3c7;
            color: #b45309;
            border: 1px solid #fde68a;
        }

        .badge-status.cold_prospect {
            background: #e0f2fe;
            color: #0284c7;
            border: 1px solid #bae6fd;
        }

        .badge-unit {
            padding: 0.28rem 0.65rem;
            border-radius: 4px;
            font-size: 0.72rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .badge-unit.subsidi {
            background: linear-gradient(135deg, #10b981, #059669);
            color: #ffffff;
        }

        .badge-unit.komersil {
            background: linear-gradient(135deg, #6366f1, #4f46e5);
            color: #ffffff;
        }

        .badge-unit.default {
            background: linear-gradient(135deg, #64748b, #475569);
            color: #ffffff;
        }

        .btn-solid-primary {
            background-color: #7c3aed;
            border: 1px solid #7c3aed;
            color: #ffffff;
            font-weight: 600;
            border-radius: 6px;
            padding: 0.55rem 1.25rem;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            transition: all 0.2s ease;
            box-shadow: 0 1px 3px rgba(124, 58, 237, 0.3);
            text-decoration: none;
        }
        .btn-solid-primary:hover {
            background-color: #6d28d9;
            border-color: #6d28d9;
            color: #ffffff;
        }

        .btn-solid-info {
            background-color: #0284c7;
            border: 1px solid #0284c7;
            color: #ffffff;
            font-weight: 600;
            border-radius: 6px;
            padding: 0.55rem 1.25rem;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            transition: all 0.2s ease;
            text-decoration: none;
        }
        .btn-solid-info:hover {
            background-color: #0369a1;
            border-color: #0369a1;
            color: #ffffff;
        }

        .btn-solid-success {
            background-color: #10b981;
            border: 1px solid #10b981;
            color: #ffffff;
            font-weight: 600;
            border-radius: 6px;
            padding: 0.55rem 1.25rem;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            transition: all 0.2s ease;
            text-decoration: none;
        }
        .btn-solid-success:hover {
            background-color: #059669;
            border-color: #059669;
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
                Detail Calon Pembeli / Proyeksi
            </h2>
            <p class="text-muted mb-0" style="font-size: 0.88rem;">
                Informasi lengkap calon pembeli properti, minat unit, status follow up, dan penugasan marketing
            </p>
        </div>

        <div class="d-flex align-items-center gap-2 flex-wrap">
            <a href="{{ route('customer.tamu') }}" class="btn btn-sm d-inline-flex align-items-center gap-2 px-3 py-2 shadow-sm btn-kembali-proyek">
                <i class="mdi mdi-arrow-left text-white" style="font-size: 1.05rem; line-height: 1;"></i>
                <span>Kembali ke Daftar Tamu</span>
            </a>

            <button type="button" class="btn btn-sm btn-solid-info shadow-sm" onclick="openFollowUpModal({{ $guest->id }}, '{{ addslashes($guest->name) }}')">
                <i class="mdi mdi-phone-log"></i>
                <span>Follow Up</span>
            </button>

            @if($guest->status !== 'converted')
                <form action="{{ route('costomer.guests.convert', $guest->id) }}" method="POST" style="display:inline;" id="convertForm{{ $guest->id }}">
                    @csrf
                    <button type="button" class="btn btn-sm btn-solid-success shadow-sm" onclick="confirmConvert({{ $guest->id }}, '{{ addslashes($guest->name) }}')">
                        <i class="mdi mdi-account-convert"></i>
                        <span>Konversi ke Customer</span>
                    </button>
                </form>
            @endif

            <a href="{{ route('customer.tamu.edit', $guest->id) }}" class="btn btn-sm btn-solid-primary shadow-sm">
                <i class="mdi mdi-pencil"></i>
                <span>Edit Data</span>
            </a>
        </div>
    </div>

    <!-- 1 Card Tunggal Rapi (Format Card Persis Halaman Tambah/Edit & Tabel) -->
    <div class="main-form-card">
        <div class="card-header d-flex align-items-center justify-content-between flex-wrap gap-2">
            <div class="d-flex align-items-center gap-2">
                <div style="width: 32px; height: 32px; border-radius: 6px; background-color: #f3e8ff; color: #9333ea; display: inline-flex; align-items: center; justify-content: center; font-size: 1.15rem; flex-shrink: 0;">
                    <i class="mdi mdi-account-details"></i>
                </div>
                <span style="font-size: 0.95rem; font-weight: 700; color: #0f172a;">
                    Rincian Lengkap Data Proyeksi: {{ $guest->name }}
                </span>
            </div>

            <div class="d-flex align-items-center gap-2">
                <span class="badge-status {{ $guest->status }}">
                    @if ($guest->status == 'hot_prospect')
                        Hot Prospek
                    @elseif ($guest->status == 'medium_prospect')
                        Medium Prospek
                    @elseif ($guest->status == 'cold_prospect')
                        Cold Prospek
                    @elseif ($guest->status == 'converted')
                        Dikonversi / Deal
                    @elseif ($guest->status == 'lost')
                        Gagal / Batal
                    @else
                        {{ ucfirst(str_replace('_', ' ', $guest->status)) }}
                    @endif
                </span>
                <small class="text-muted">Terdaftar: {{ $guest->created_at ? $guest->created_at->format('d M Y H:i') : '-' }}</small>
            </div>
        </div>

        <div class="card-body p-3 p-md-4">
            <div class="row g-4">
                <!-- KOLOM KIRI: Informasi Calon Pembeli -->
                <div class="col-12 col-lg-6 pe-lg-4 border-col-divider">
                    <div class="section-sub-title">
                        <i class="mdi mdi-account text-primary" style="font-size: 1.15rem;"></i>
                        <span>Informasi Calon Pembeli</span>
                    </div>

                    <div class="mb-3">
                        <div class="info-label">Nama Lengkap</div>
                        <div class="info-value">{{ $guest->name }}</div>
                    </div>

                    <div class="mb-3">
                        <div class="info-label">No. WhatsApp / HP</div>
                        <div class="info-value d-flex align-items-center gap-2 flex-wrap">
                            @if($guest->phone)
                                @php
                                    $cleanPhone = preg_replace('/[^0-9]/', '', $guest->phone);
                                    if (str_starts_with($cleanPhone, '0')) {
                                        $cleanPhone = '62' . substr($cleanPhone, 1);
                                    }
                                @endphp
                                <a href="https://wa.me/{{ $cleanPhone }}" target="_blank" class="text-primary text-decoration-none fw-bold">
                                    <i class="mdi mdi-phone text-success me-1"></i>{{ $guest->phone }}
                                </a>
                                <a href="https://wa.me/{{ $cleanPhone }}?text=Halo%20{{ urlencode($guest->name) }}%2C%20saya%20dari%20tim%20pemasaran%20Graha%20Cipta%20Sejahtera..."
                                   target="_blank" class="btn btn-sm btn-success px-2 py-0.5 fw-semibold" style="font-size: 0.75rem; border-radius: 4px;">
                                    <i class="mdi mdi-whatsapp me-1"></i>Chat WA
                                </a>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="info-label">Alamat Email</div>
                        <div class="info-value">
                            @if($guest->email)
                                <a href="mailto:{{ $guest->email }}" class="text-dark text-decoration-none">
                                    <i class="mdi mdi-email-outline text-muted me-1"></i>{{ $guest->email }}
                                </a>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="info-label">Sumber Informasi</div>
                        <div class="info-value">
                            <span class="badge bg-light text-dark border px-2 py-1" style="border-radius: 4px; font-size: 0.78rem;">
                                <i class="mdi mdi-bullhorn-outline text-primary me-1"></i>{{ $guest->source ?? '-' }}
                            </span>
                        </div>
                    </div>

                    <div class="mb-0">
                        <div class="info-label">Terkait Tugas Marketing</div>
                        <div class="info-value">
                            @if($guest->marketingTask)
                                <span class="badge" style="color: #7c3aed; background: #f3e8ff; border: 1px solid #e9d5ff; border-radius: 4px; padding: 0.3rem 0.65rem; font-size: 0.78rem;">
                                    <i class="mdi mdi-clipboard-text-outline me-1"></i>{{ $guest->marketingTask->nama_tugas }}
                                </span>
                            @else
                                <span class="text-muted">Tidak dikaitkan ke tugas khusus</span>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- KOLOM KANAN: Minat Properti & Penugasan -->
                <div class="col-12 col-lg-6 ps-lg-4">
                    <div class="section-sub-title">
                        <i class="mdi mdi-home-analytics text-warning" style="font-size: 1.15rem;"></i>
                        <span>Minat Properti & Penugasan</span>
                    </div>

                    <div class="mb-3">
                        <div class="info-label">Proyek Minat</div>
                        <div class="info-value">
                            <i class="mdi mdi-office-building text-primary me-1"></i>
                            <span class="fw-bold">{{ $guest->project->name ?? '-' }}</span>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="info-label">Unit Minat</div>
                        <div class="info-value">
                            @if($guest->unit)
                                <i class="mdi mdi-home-outline text-info me-1"></i>
                                <span class="fw-bold">{{ $guest->unit->unit_name ?? $guest->unit->unit_code }}</span>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="info-label">Jenis & Tipe Unit</div>
                        <div class="info-value">
                            @if ($guest->unit && ($guest->unit->jenis || $guest->unit->type))
                                @php
                                    $unitJenis = strtolower($guest->unit->jenis ?? '');
                                    $badgeClass = match($unitJenis) {
                                        'subsidi' => 'subsidi',
                                        'komersil' => 'komersil',
                                        default => 'default'
                                    };
                                    $iconClass = match($unitJenis) {
                                        'subsidi' => 'mdi-home-assistant',
                                        'komersil' => 'mdi-office-building',
                                        default => 'mdi-tag-outline'
                                    };
                                @endphp
                                <span class="badge-unit {{ $badgeClass }}">
                                    <i class="mdi {{ $iconClass }} me-1"></i>{{ ($guest->unit->jenis ?? '') . ($guest->unit->type ? '/' . $guest->unit->type : '') }}
                                </span>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="info-label">Estimasi Budget / Anggaran</div>
                        <div class="info-value">
                            @if($guest->budget)
                                <span class="fw-bold text-success" style="font-size: 1.05rem;">
                                    Rp {{ number_format((float)str_replace(['.', ','], '', $guest->budget), 0, ',', '.') }}
                                </span>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </div>
                    </div>

                    <div class="mb-0">
                        <div class="info-label">Agent / Sales PIC</div>
                        <div class="info-value">
                            @if($guest->employee)
                                <span class="fw-bold text-dark">{{ $guest->employee->name }}</span>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <hr style="border-color: #f1f5f9; margin: 1.75rem 0 1.25rem 0;">

            <!-- BAGIAN BAWAH: Aktivitas Follow Up & Preferensi -->
            <div>
                <div class="section-sub-title">
                    <i class="mdi mdi-calendar-clock text-info" style="font-size: 1.15rem;"></i>
                    <span>Aktivitas Follow Up & Preferensi</span>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-12 col-md-6">
                        <div class="p-2.5 rounded" style="background: #f8fafc; border: 1px dashed #cbd5e1; border-radius: 6px !important;">
                            <div class="info-label mb-1" style="font-size: 0.74rem;">
                                <i class="mdi mdi-history me-1"></i>Follow Up Terakhir
                            </div>
                            <div class="fw-bold text-dark" style="font-size: 0.95rem;">
                                {{ $guest->last_follow_up ? \Carbon\Carbon::parse($guest->last_follow_up)->format('d M Y H:i') : '-' }}
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="p-2.5 rounded" style="background: #fdf4ff; border: 1px dashed #e9d5ff; border-radius: 6px !important;">
                            <div class="info-label mb-1" style="font-size: 0.74rem; color: #7c3aed;">
                                <i class="mdi mdi-calendar-arrow-right me-1"></i>Jadwal Next Follow Up
                            </div>
                            <div class="fw-bold" style="font-size: 0.95rem; color: #7c3aed;">
                                {{ $guest->next_follow_up ? \Carbon\Carbon::parse($guest->next_follow_up)->format('d M Y') : '-' }}
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <div class="info-label mb-1.5">
                        <i class="mdi mdi-text-box-outline me-1"></i>Catatan Tambahan & Preferensi Calon Pembeli
                    </div>
                    <div class="p-3" style="background: #f8fafc; border: 1px solid #e2e8f0; font-size: 0.88rem; color: #334155; min-height: 55px; white-space: pre-wrap; border-radius: 6px;">{{ $guest->notes ?: 'Tidak ada catatan tambahan untuk calon pembeli ini.' }}</div>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Modal Follow Up -->
<div class="modal fade" id="modalFollowUp" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow-sm border-0" style="border-radius: 8px; overflow: hidden;">
            <form action="{{ route('customer.tamu.followup') }}" method="POST">
                @csrf
                <input type="hidden" name="guest_id" id="followup_guest_id" value="{{ $guest->id }}">

                <div class="modal-header d-flex justify-content-between align-items-center" style="background: #7c3aed; padding: 1rem 1.4rem;">
                    <h5 class="modal-title mb-0 text-white fw-bold" style="font-size: 1.05rem;">
                        <i class="mdi mdi-phone-log me-2"></i>Follow Up Tamu
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body p-4" style="background: #ffffff;">
                    <div class="mb-3">
                        <label class="form-label" style="font-size: 0.82rem; font-weight: 700; color: #334155;">Nama Calon Pembeli</label>
                        <input type="text" class="form-control" id="followup_guest_name" value="{{ $guest->name }}" readonly style="border-radius: 6px; background: #f8fafc;">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="font-size: 0.82rem; font-weight: 700; color: #334155;">Waktu Follow Up <span class="text-danger">*</span></label>
                        <input type="datetime-local" class="form-control" name="last_follow_up" value="{{ now()->format('Y-m-d\TH:i') }}" required style="border-radius: 6px;">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="font-size: 0.82rem; font-weight: 700; color: #334155;">Catatan Follow Up</label>
                        <textarea class="form-control" name="notes" rows="3" placeholder="Hasil percakapan / minat lanjutan..." style="border-radius: 6px;"></textarea>
                    </div>
                    <hr style="border-color: #f1f5f9;">
                    <div class="mb-0">
                        <label class="form-label" style="font-size: 0.82rem; font-weight: 700; color: #334155;">Jadwal Follow Up Berikutnya</label>
                        <input type="datetime-local" class="form-control" name="next_follow_up" value="{{ now()->addDays(3)->format('Y-m-d\TH:i') }}" style="border-radius: 6px;">
                    </div>
                </div>

                <div class="modal-footer px-4 py-3" style="background: #f8fafc; border-top: 1px solid #e2e8f0;">
                    <button type="button" class="btn btn-secondary px-3" data-bs-dismiss="modal" style="border-radius: 6px;">
                        <i class="mdi mdi-close me-1"></i>Batal
                    </button>
                    <button type="submit" class="btn btn-primary px-3" style="background: #7c3aed; border-color: #7c3aed; border-radius: 6px;">
                        <i class="mdi mdi-content-save me-1"></i>Simpan Follow Up
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function openFollowUpModal(id, name) {
        document.getElementById('followup_guest_id').value = id;
        document.getElementById('followup_guest_name').value = name;
        var modal = new bootstrap.Modal(document.getElementById('modalFollowUp'));
        modal.show();
    }

    function confirmConvert(id, name) {
        Swal.fire({
            title: 'Konversi ke Customer?',
            html: `Calon pembeli <b>${name}</b> akan langsung disimpan sebagai data User / Customer baru.<br><br><span class="badge bg-warning text-dark px-2 py-1"><i class="mdi mdi-alert me-1"></i>Status: Belum Lengkap</span><br><small class="text-muted mt-2 d-block">Data NIK dan berkas KTP wajib dilengkapi di menu Data Customer agar dapat diproses untuk booking unit.</small>`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#7c3aed',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, Konversi Sekarang',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Memproses...',
                    html: 'Mohon tunggu sebentar',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
                document.getElementById('convertForm' + id).submit();
            }
        });
    }

    @if (session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: "{{ session('success') }}",
            timer: 3000,
            timerProgressBar: true,
            confirmButtonText: 'OK',
            confirmButtonColor: '#7c3aed'
        });
    @endif

    @if (session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: "{{ session('error') }}",
            confirmButtonColor: '#7c3aed',
            confirmButtonText: 'OK'
        });
    @endif
</script>
@endpush
