@extends('layouts.partial.app')

@section('title', 'Master Data SPK Kontraktor - Property Management App')

@section('content')

    <style>
        .stat-card {
            border: none !important;
            border-radius: 10px;
            background: #ffffff;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.04);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
        }

        .stat-icon-box {
            width: 48px;
            height: 48px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }

        .btn-fase-action {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 4px;
            padding: 0.32rem 0.65rem;
            font-size: 0.78rem;
            font-weight: 600;
            border-radius: 6px;
            border: none;
            color: #ffffff !important;
            transition: all 0.2s ease;
            box-shadow: 0 2px 4px rgba(0,0,0,0.08);
            text-decoration: none;
            line-height: 1.2;
            cursor: pointer;
        }

        .btn-fase-action i {
            font-size: 0.95rem;
        }

        .btn-fase-action:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.15);
            color: #ffffff !important;
        }

        .btn-spk-view {
            background: linear-gradient(135deg, #da8cff, #9a55ff);
        }

        .btn-spk-print {
            background: linear-gradient(135deg, #11998e, #38ef7d);
        }

        .btn-spk-edit {
            background: linear-gradient(135deg, #36d1dc, #5b86e5);
        }

        .btn-spk-delete {
            background: linear-gradient(135deg, #ff416c, #ff4b2b);
            padding: 0.32rem 0.55rem;
        }

        .btn-icon-only {
            width: 38px;
            height: 38px;
            padding: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 4px;
        }

        .header-card {
            background: #ffffff;
            border-radius: 8px !important;
            border: none !important;
            box-shadow: 0 4px 18px rgba(0, 0, 0, 0.04);
            margin-bottom: 0;
        }

        .card-header-compact {
            padding: 0.85rem 1.25rem !important;
            border-bottom: 1px solid #ebedf2 !important;
        }

        .card-body-compact {
            padding: 0.85rem 1.25rem 1rem 1.25rem !important;
        }

        .filter-card-compact {
            margin-bottom: 0.75rem !important;
            padding: 0 !important;
        }

        .table thead th {
            color: #9a55ff;
            font-weight: 700;
            font-size: 0.78rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            background: #fbf9ff;
            border-bottom: 1px solid #ebe5f5;
            padding: 0.6rem 0.75rem !important;
        }

        .table tbody td {
            padding: 0.6rem 0.75rem !important;
            vertical-align: middle;
            border-bottom: 1px solid #f2eff8;
            font-size: 0.88rem;
        }

        /* Badge Status Custom */
        .badge-status-spk {
            font-size: 0.72rem;
            font-weight: 600;
            padding: 0.28rem 0.65rem;
            border-radius: 30px;
            display: inline-flex;
            align-items: center;
            gap: 4px;
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

        /* Select2 Theme Alignment */
        .select2-container--bootstrap-5 .select2-selection {
            min-height: 38px !important;
            height: 38px !important;
            padding: 0.375rem 0.75rem !important;
            display: flex !important;
            align-items: center !important;
            border-color: #e0e4e9 !important;
            border-radius: 4px !important;
            font-size: 0.875rem !important;
            background-color: #ffffff !important;
        }
        .select2-container--bootstrap-5.select2-container--focus .select2-selection,
        .select2-container--bootstrap-5.select2-container--open .select2-selection {
            border-color: #bfa5fa !important;
            box-shadow: 0 0 0 0.2rem rgba(154, 85, 255, 0.12) !important;
        }
    </style>

    <div class="container-fluid px-1 px-sm-2 px-md-3 py-2 py-md-3">

        <!-- Alert Notification -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-3" role="alert" style="border-radius: 8px;">
                <i class="mdi mdi-check-circle me-2 fs-5 align-middle"></i>
                <strong>Sukses!</strong> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-3" role="alert" style="border-radius: 8px;">
                <i class="mdi mdi-alert-circle me-2 fs-5 align-middle"></i>
                <strong>Error!</strong> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Header Card Banner -->
        <div class="row mb-3 mb-md-4">
            <div class="col-12">
                <div class="card shadow-sm border-0 header-card">
                    <div class="card-body p-4 p-md-4 py-4 py-md-4 d-flex justify-content-between align-items-center" style="min-height: 105px;">
                        <div>
                            <h3 class="text-dark mb-1 fw-bold" style="font-size: 1.35rem;">
                                Surat Perintah Kerja (SPK) Kontraktor
                            </h3>
                            <p class="text-muted mb-0" style="font-size: 0.9rem;">
                                Buat, kelola, monitor termin pembayaran, dan cetak surat resmi SPK kontraktor & pemborong
                            </p>
                        </div>
                        <div class="d-none d-sm-block pe-2">
                            <i class="mdi mdi-file-document-edit-outline" style="font-size: 3rem; color: #9a55ff; opacity: 0.25;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Summary Statistics Cards -->
        <div class="row g-3 mb-3 mb-md-4">
            <div class="col-6 col-md-3">
                <div class="card stat-card p-3">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <span class="text-muted small fw-semibold">Total SPK</span>
                            <h4 class="fw-bold text-dark mb-0 mt-1">{{ $stats['total_spk'] }}</h4>
                        </div>
                        <div class="stat-icon-box" style="background: rgba(154, 85, 255, 0.12); color: #9a55ff;">
                            <i class="mdi mdi-file-document-multiple-outline"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-6 col-md-3">
                <div class="card stat-card p-3">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <span class="text-muted small fw-semibold">SPK Berjalan</span>
                            <h4 class="fw-bold text-info mb-0 mt-1">{{ $stats['spk_berjalan'] }}</h4>
                        </div>
                        <div class="stat-icon-box" style="background: rgba(23, 162, 184, 0.12); color: #17a2b8;">
                            <i class="mdi mdi-progress-clock"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-6 col-md-3">
                <div class="card stat-card p-3">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <span class="text-muted small fw-semibold">SPK Selesai</span>
                            <h4 class="fw-bold text-success mb-0 mt-1">{{ $stats['spk_selesai'] }}</h4>
                        </div>
                        <div class="stat-icon-box" style="background: rgba(40, 167, 69, 0.12); color: #28a745;">
                            <i class="mdi mdi-check-decagram-outline"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-6 col-md-3">
                <div class="card stat-card p-3">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <span class="text-muted small fw-semibold">Total Nilai Kontrak</span>
                            <h5 class="fw-bold text-primary mb-0 mt-1" style="font-size: 1.05rem;">Rp {{ number_format($stats['total_nilai'], 0, ',', '.') }}</h5>
                        </div>
                        <div class="stat-icon-box" style="background: rgba(84, 110, 237, 0.12); color: #546eed;">
                            <i class="mdi mdi-cash-multiple"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-2 mt-sm-2 mt-md-3">
            <div class="col-12">
                <div class="card shadow-sm border-0" style="border-radius: 8px;">
                    <div class="card-header bg-white d-flex flex-wrap flex-md-row justify-content-between align-items-center gap-2 card-header-compact">
                        <h5 class="card-title mb-0" style="font-weight: 700; color: #2c2e3f;">
                            <i class="mdi mdi-format-list-bulleted me-2" style="color: #9a55ff;"></i>Daftar SPK Kontraktor
                        </h5>
                        <a href="{{ route('spk.create') }}" class="btn btn-sm btn-gradient-primary d-inline-flex align-items-center" style="gap: 5px; text-decoration: none;">
                            <i class="mdi mdi-plus me-1"></i>Buat SPK Baru
                        </a>
                    </div>

                    <div class="card-body card-body-compact">
                        <!-- Filter Section Form -->
                        <form method="GET" action="{{ route('spk.index') }}" class="filter-card filter-card-compact mb-3">
                            <div class="row g-2 align-items-center">
                                <div class="col-12 col-md-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="search" value="{{ request('search') }}"
                                            placeholder="Cari no SPK / kontraktor / pekerjaan..."
                                            style="height: 38px;">
                                        <button class="btn btn-gradient-primary d-flex align-items-center justify-content-center px-3" 
                                            type="submit" title="Cari" style="box-shadow: none;">
                                            <i class="mdi mdi-magnify" style="font-size: 1.15rem; color: #ffffff;"></i>
                                        </button>
                                    </div>
                                </div>

                                <div class="col-6 col-md-3">
                                    <select class="form-control select2" name="land_bank_id" onchange="this.form.submit()" style="width: 100%;">
                                        <option value="">Semua Proyek / Land Bank</option>
                                        @foreach($landBanks as $lb)
                                            <option value="{{ $lb->id }}" {{ request('land_bank_id') == $lb->id ? 'selected' : '' }}>
                                                {{ $lb->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-6 col-md-2">
                                    <select class="form-control select2" name="status" onchange="this.form.submit()" style="width: 100%;">
                                        <option value="">Semua Status</option>
                                        <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                                        <option value="berjalan" {{ request('status') == 'berjalan' ? 'selected' : '' }}>Berjalan</option>
                                        <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                        <option value="dibatalkan" {{ request('status') == 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                                    </select>
                                </div>

                                <div class="col-6 col-md-2">
                                    <select class="form-control select2" name="per_page" onchange="this.form.submit()" style="width: 100%;">
                                        <option value="5" {{ $perPage == 5 ? 'selected' : '' }}>5 Data</option>
                                        <option value="10" {{ $perPage == 10 ? 'selected' : '' }}>10 Data</option>
                                        <option value="25" {{ $perPage == 25 ? 'selected' : '' }}>25 Data</option>
                                        <option value="50" {{ $perPage == 50 ? 'selected' : '' }}>50 Data</option>
                                    </select>
                                </div>

                                <div class="col-6 col-md-2 d-flex gap-2">
                                    <button type="submit" class="btn btn-gradient-primary flex-fill d-flex align-items-center justify-content-center" style="height: 38px;" title="Terapkan Filter">
                                        <i class="mdi mdi-filter me-1"></i> Filter
                                    </button>
                                    <a href="{{ route('spk.index') }}" class="btn btn-gradient-secondary btn-icon-only flex-shrink-0" style="height: 38px;" title="Reset Filter">
                                        <i class="mdi mdi-refresh"></i>
                                    </a>
                                </div>
                            </div>
                        </form>

                        <!-- Table Wrapper -->
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 50px;">NO</th>
                                        <th style="width: 200px;">NOMOR SPK & TANGGAL</th>
                                        <th style="width: 220px;">PROYEK & PEKERJAAN</th>
                                        <th style="width: 180px;">KONTRAKTOR / MANDOR</th>
                                        <th class="text-end" style="width: 150px;">NILAI KONTRAK</th>
                                        <th class="text-center" style="width: 120px;">PROGRESS</th>
                                        <th class="text-center" style="width: 110px;">STATUS</th>
                                        <th class="text-center" style="width: 160px;">AKSI</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($spks as $index => $spk)
                                        <tr>
                                            <td class="text-center fw-bold text-muted">
                                                {{ $spks->firstItem() + $index }}
                                            </td>
                                            <td>
                                                <div class="fw-bold text-dark mb-1">
                                                    <i class="mdi mdi-file-document-outline text-primary me-1"></i>
                                                    {{ $spk->no_spk }}
                                                </div>
                                                <small class="text-muted">
                                                    <i class="mdi mdi-calendar-blank-outline me-1"></i>{{ $spk->tanggal_spk ? date('d/m/Y', strtotime($spk->tanggal_spk)) : '-' }}
                                                </small>
                                            </td>
                                            <td>
                                                <div class="fw-bold text-dark mb-1">
                                                    {{ $spk->nama_pekerjaan }}
                                                </div>
                                                <div class="small text-muted d-flex align-items-center gap-1">
                                                    <i class="mdi mdi-domain text-purple"></i>
                                                    <span>{{ $spk->landBank->name ?? '-' }}</span>
                                                    @if($spk->unit)
                                                        <span class="badge bg-light text-dark border ms-1">
                                                            Kav. {{ $spk->unit->unit_code }} ({{ $spk->unit->type }})
                                                        </span>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div class="fw-semibold text-dark mb-1">
                                                    <i class="mdi mdi-account-tie me-1 text-muted"></i>
                                                    {{ $spk->kontraktor_nama }}
                                                </div>
                                                @if($spk->kontraktor_pic)
                                                    <small class="text-muted d-block">
                                                        PIC: {{ $spk->kontraktor_pic }}
                                                    </small>
                                                @endif
                                                @if($spk->kontraktor_telepon)
                                                    <small class="text-muted d-block">
                                                        <i class="mdi mdi-phone-outline me-1"></i>{{ $spk->kontraktor_telepon }}
                                                    </small>
                                                @endif
                                            </td>
                                            <td class="text-end">
                                                <span class="fw-bold text-primary">
                                                    {{ $spk->formatted_nilai_kontrak }}
                                                </span>
                                                <small class="text-muted d-block">
                                                    {{ $spk->termins->count() }} Termin
                                                </small>
                                            </td>
                                            <td class="text-center">
                                                <div class="d-flex align-items-center justify-content-center gap-2">
                                                    <div class="progress flex-grow-1" style="height: 6px; width: 60px;">
                                                        <div class="progress-bar bg-gradient-primary" role="progressbar" 
                                                             style="width: {{ $spk->progress }}%;" 
                                                             aria-valuenow="{{ $spk->progress }}" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                    <span class="small fw-bold text-dark">{{ $spk->progress }}%</span>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                @if($spk->status == 'berjalan')
                                                    <span class="badge-status-spk badge-status-berjalan">
                                                        <i class="mdi mdi-play-circle-outline"></i> Berjalan
                                                    </span>
                                                @elseif($spk->status == 'selesai')
                                                    <span class="badge-status-spk badge-status-selesai">
                                                        <i class="mdi mdi-check-circle-outline"></i> Selesai
                                                    </span>
                                                @elseif($spk->status == 'dibatalkan')
                                                    <span class="badge-status-spk badge-status-dibatalkan">
                                                        <i class="mdi mdi-close-circle-outline"></i> Batal
                                                    </span>
                                                @else
                                                    <span class="badge-status-spk badge-status-draft">
                                                        <i class="mdi mdi-file-clock-outline"></i> Draft
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="text-center text-nowrap">
                                                <div class="d-inline-flex align-items-center gap-1">
                                                    <!-- Detail SPK -->
                                                    <a href="{{ route('spk.show', $spk->id) }}" 
                                                       class="btn-fase-action btn-spk-view" 
                                                       title="Lihat Detail SPK">
                                                        <i class="mdi mdi-eye"></i>
                                                    </a>

                                                    <!-- Cetak Surat SPK -->
                                                    <a href="{{ route('spk.cetak', $spk->id) }}" 
                                                       target="_blank"
                                                       class="btn-fase-action btn-spk-print" 
                                                       title="Cetak Surat SPK">
                                                        <i class="mdi mdi-printer"></i>
                                                    </a>

                                                    <!-- Edit SPK -->
                                                    <a href="{{ route('spk.edit', $spk->id) }}" 
                                                       class="btn-fase-action btn-spk-edit" 
                                                       title="Edit SPK">
                                                        <i class="mdi mdi-pencil"></i>
                                                    </a>

                                                    <!-- Hapus SPK -->
                                                    <button type="button" 
                                                            class="btn-fase-action btn-spk-delete" 
                                                            title="Hapus SPK" 
                                                            onclick="deleteSpk('{{ $spk->id }}', '{{ $spk->no_spk }}')">
                                                        <i class="mdi mdi-trash-can-outline"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center py-5 text-muted">
                                                <div class="py-4">
                                                    <i class="mdi mdi-file-document-outline" style="font-size: 3rem; opacity: 0.3;"></i>
                                                    <h6 class="mt-2 fw-semibold text-dark">Belum Ada Data SPK Kontraktor</h6>
                                                    <p class="small text-muted mb-3">Klik tombol di bawah untuk membuat Surat Perintah Kerja pertama</p>
                                                    <a href="{{ route('spk.create') }}" class="btn btn-sm btn-gradient-primary">
                                                        <i class="mdi mdi-plus me-1"></i>Buat SPK Baru
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination Footer -->
                        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mt-4">
                            <div class="pagination-info mb-2 mb-sm-0 text-muted small">
                                Menampilkan {{ $spks->firstItem() ?? 0 }} - {{ $spks->lastItem() ?? 0 }} dari {{ $spks->total() }} data
                            </div>
                            <div>
                                {{ $spks->links('pagination::bootstrap-5') }}
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

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
    });

    // Delete SPK Action
    function deleteSpk(id, noSpk) {
        Swal.fire({
            title: 'Hapus SPK ini?',
            text: `Apakah Anda yakin ingin menghapus data SPK ${noSpk}? Semua jadwal termin yang terkait juga akan dihapus.`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Menghapus data...',
                    allowOutsideClick: false,
                    didOpen: () => Swal.showLoading()
                });

                $.ajax({
                    url: `/spk/${id}`,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(res) {
                        if (res.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Terhapus!',
                                text: res.message,
                                timer: 1500,
                                showConfirmButton: false
                            }).then(() => {
                                window.location.reload();
                            });
                        } else {
                            Swal.fire('Error', res.message || 'Gagal menghapus data', 'error');
                        }
                    },
                    error: function(xhr) {
                        Swal.fire('Error', 'Terjadi kesalahan sistem saat menghapus data.', 'error');
                    }
                });
            }
        });
    }
</script>
@endpush
