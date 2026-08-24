@extends('layouts.partial.app')

@section('title', 'Pra Tanah - Property Management App')

@section('content')

    <style>
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

        .btn-fase-1 {
            background: linear-gradient(135deg, #da8cff, #9a55ff);
        }

        .btn-fase-2 {
            background: linear-gradient(135deg, #36d1dc, #5b86e5);
        }

        .btn-fase-3 {
            background: linear-gradient(135deg, #11998e, #38ef7d);
        }

        .btn-fase-delete {
            background: linear-gradient(135deg, #ff416c, #ff4b2b);
            padding: 0.32rem 0.55rem;
        }
    </style>

    <div class="container-fluid px-1 px-sm-2 px-md-3 py-2 py-md-3">

        <!-- Header Halaman (Tanpa Card Box) -->
        <div class="row mb-3 mb-md-4">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center px-1">
                    <div>
                        <h3 class="text-dark mb-1 fw-bold">
                            <i class="mdi mdi-hand-holding-usd me-2" style="color: #9a55ff;"></i>Pra Tanah / Pra Pelepasan
                        </h3>
                        <p class="text-muted mb-0">
                            Kelola data tanah yang masih dalam tahap penawaran dan negosiasi
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-2 mt-sm-2 mt-md-3">
            <div class="col-12">
                <div class="card shadow-sm border-0">
                    <div
                        class="card-header bg-white d-flex flex-wrap flex-md-row justify-content-between align-items-center gap-2 py-3">
                        <h5 class="card-title mb-0" style="font-weight: 700; color: #2c2e3f;">
                            <i class="mdi mdi-format-list-bulleted me-2" style="color: #9a55ff;"></i>Daftar Pra Tanah
                        </h5>
                        <a class="btn btn-sm btn-gradient-primary d-inline-flex align-items-center" style="gap: 5px;"
                            href="{{ route('pra-landbank.proses') }}">
                            <i class="mdi mdi-plus me-1"></i>Tambah Pra Tanah
                        </a>
                    </div>

                    <div class="card-body">
                        <!-- Filter Section -->
                        <div class="filter-card mb-3">
                            <!-- Desktop Filter -->
                            <div class="filter-row-desktop d-none d-md-block">
                                <form id="filterForm" method="GET" onsubmit="return showFilterLoading()">
                                    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 w-100">
                                        <div style="width: 280px;">
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="search" id="searchInput"
                                                    placeholder="Cari nama tanah / makelar..."
                                                    value="{{ request('search') }}"
                                                    style="border-top-right-radius: 0 !important; border-bottom-right-radius: 0 !important; border-right: none;">
                                                <button class="btn btn-gradient-primary d-flex align-items-center justify-content-center px-3" 
                                                    type="submit" title="Cari"
                                                    style="border-top-left-radius: 0 !important; border-bottom-left-radius: 0 !important; border-top-right-radius: 4px !important; border-bottom-right-radius: 4px !important; height: 38px; box-shadow: none;">
                                                    <i class="mdi mdi-magnify" style="font-size: 1.15rem; color: #ffffff;"></i>
                                                </button>
                                            </div>
                                        </div>

                                        <div class="d-flex align-items-center gap-2 ms-auto">
                                            <select class="form-control" name="limit" id="limitSelect" style="width: 115px;">
                                                <option value="5" {{ request('limit') == 5 ? 'selected' : '' }}>5 data
                                                </option>
                                                <option value="10"
                                                    {{ request('limit', 10) == 10 ? 'selected' : '' }}>10 data</option>
                                                <option value="15" {{ request('limit') == 15 ? 'selected' : '' }}>15 data
                                                </option>
                                                <option value="25" {{ request('limit') == 25 ? 'selected' : '' }}>25 data
                                                </option>
                                            </select>

                                            <button type="submit"
                                                class="btn btn-gradient-primary btn-icon-only"
                                                title="Filter">
                                                <i class="mdi mdi-filter"></i>
                                            </button>
                                            <button type="button"
                                                class="btn btn-gradient-secondary btn-icon-only"
                                                title="Reset" onclick="showResetLoading(event)">
                                                <i class="mdi mdi-refresh"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <!-- Mobile Filter -->
                            <div class="filter-row-mobile d-block d-md-none">
                                <form method="GET" onsubmit="return showFilterLoading()">
                                    <div class="row g-2">
                                        <div class="col-12 mb-2">
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="search"
                                                    id="searchInputMobile" placeholder="Cari nama tanah atau makelar..."
                                                    value="{{ request('search') }}"
                                                    style="border-top-right-radius: 0 !important; border-bottom-right-radius: 0 !important; border-right: none;">
                                                <button class="btn btn-gradient-primary d-flex align-items-center justify-content-center px-3" 
                                                    type="submit" title="Cari"
                                                    style="border-top-left-radius: 0 !important; border-bottom-left-radius: 0 !important; border-top-right-radius: 4px !important; border-bottom-right-radius: 4px !important; height: 38px; box-shadow: none;">
                                                    <i class="mdi mdi-magnify" style="font-size: 1.15rem; color: #ffffff;"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="col-6 mb-2">
                                            <select class="form-control" name="limit" id="limitSelectMobile">
                                                <option value="5" {{ request('limit') == 5 ? 'selected' : '' }}>5 data
                                                </option>
                                                <option value="10"
                                                    {{ request('limit', 10) == 10 ? 'selected' : '' }}>10 data</option>
                                                <option value="15" {{ request('limit') == 15 ? 'selected' : '' }}>15 data
                                                </option>
                                                <option value="25" {{ request('limit') == 25 ? 'selected' : '' }}>25 data
                                                </option>
                                            </select>
                                        </div>
                                        <div class="col-6 mb-2">
                                            <div class="d-flex gap-2">
                                                <button type="submit"
                                                    class="btn btn-gradient-primary btn-icon-only flex-fill"
                                                    title="Filter">
                                                    <i class="mdi mdi-filter"></i>
                                                </button>
                                                <button type="button"
                                                    class="btn btn-gradient-secondary btn-icon-only flex-fill"
                                                    onclick="showResetLoading(event)" title="Reset">
                                                    <i class="mdi mdi-refresh"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="table-wrapper">
                            <table class="table table-hover align-middle">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th>Nama Tanah</th>
                                        <th>Makelar</th>
                                        <th>Harga Negosiasi</th>
                                        <th>Progress 3 FASE</th>
                                        <th>Status</th>
                                        <th>Prioritas</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="tableBody">
                                    @forelse ($praLandBank as $index => $land)
                                        @php
                                            $priorityClass = match (strtolower($land->priority ?? 'normal')) {
                                                'urgent' => 'badge-priority-urgent',
                                                'high', 'tinggi' => 'badge-priority-high',
                                                'normal', 'sedang' => 'badge-priority-normal',
                                                'low', 'rendah' => 'badge-priority-low',
                                                default => 'badge-priority-normal',
                                            };
                                            $isTerminActive = $land->payment_method == 'termin' && $land->payments->where('status', 'belum')->count() > 0;
                                            if ($isTerminActive) {
                                                $paidCount = $land->payments->where('status', 'lunas')->count();
                                                $totalPayments = $land->payments->count();
                                                $percent = $totalPayments > 0 ? round(($paidCount / $totalPayments) * 100) : 0;
                                                $fase = 3;
                                            }
                                            switch ($isTerminActive ? 'termin_active_bypass' : $land->status) {
                                                case 'termin_active_bypass':
                                                    break;
                                                case 'fase1':
                                                    $fase = 1;
                                                    $percent = 33;
                                                    break;

                                                case 'fase2':
                                                    $fase = 2;
                                                    $percent = 66;
                                                    break;

                                                case 'fase3':
                                                case 'approved':
                                                    $fase = 3;
                                                    $percent = 100;
                                                    break;

                                                case 'rejected':
                                                    $fase = 0;
                                                    $percent = 0;
                                                    break;

                                                case 'pending':
                                                    if (!empty($land->survey_date) || !empty($land->survey_by)) {
                                                        $fase = 3;
                                                        $percent = 100;
                                                    } else {
                                                        $fase = 1;
                                                        $percent = 33;
                                                    }
                                                    break;

                                                default:
                                                    $fase = 1;
                                                    $percent = 33;
                                            }
                                        @endphp

                                        <tr id="row-{{ $land->id }}">
                                            <td class="text-center fw-bold">{{ $index + 1 }}</td>

                                            <td>
                                                <i class="mdi mdi-map-marker text-primary me-2"></i>
                                                <span class="fw-bold">{{ $land->land_name }}</span>
                                            </td>

                                            <td>
                                                <i class="mdi mdi-account-tie me-1"></i>
                                                {{ $land->land_owner ?? '-' }}
                                            </td>

                                            <td class="text-nowrap">
                                                Rp {{ number_format($land->estimated_price ?? 0, 0, ',', '.') }}
                                            </td>

                                            <td>
                                                <div class="progress-fase">

                                                    <!-- LABEL -->
                                                    <div class="progress-label">
                                                        @if ($land->status == 'rejected')
                                                            <span class="text-danger fw-bold">REJECTED</span>
                                                        @elseif($isTerminActive)
                                                            <span class="text-warning fw-bold">CICILAN ({{ $paidCount }}/{{ $totalPayments }})</span>
                                                        @elseif($land->status == 'approved')
                                                            <span class="text-success fw-bold">APPROVED</span>
                                                        @else
                                                            FASE {{ $fase }}/3
                                                        @endif
                                                    </div>

                                                    <!-- BAR -->
                                                    <div class="progress-bar-container">
                                                        <div class="progress-bar-fill {{ $isTerminActive ? 'bg-warning' : '' }}
                                                            {{ $land->status == 'approved' ? 'bg-success' : '' }}
                                                            {{ $land->status == 'rejected' ? 'bg-danger' : '' }}"
                                                            style="width: {{ $percent }}%">
                                                        </div>
                                                    </div>

                                                </div>
                                            </td>

                                            <td>
                                                @if($isTerminActive)
                                                    <span class="badge-status warning" style="background: rgba(255, 193, 7, 0.1); color: #ffc107; border: 1px solid rgba(255, 193, 7, 0.2); font-size: 11px; padding: 4px 8px; border-radius: 6px; font-weight: 600;">
                                                        Cicilan Aktif
                                                    </span>
                                                @else
                                                    <span class="badge-status 
                                                       {{ $land->status == 'approved' ? 'success' : 'nego' }}">
                                                        {{ ucfirst($land->status) }}
                                                    </span>
                                                @endif
                                            </td>

                                            <td>
                                                <span class="badge-priority {{ $priorityClass }}">
                                                    {{ ucfirst($land->priority ?? 'Normal') }}
                                                </span>
                                            </td>

                                            <td class="text-center text-nowrap">
                                                <div class="d-inline-flex align-items-center gap-1">
                                                    <a href="{{ route('pra-landbank.proses', ['id' => $land->id, 'step' => 1]) }}" 
                                                       class="btn-fase-action btn-fase-1" 
                                                       title="FASE 1: Negosiasi">
                                                        <i class="mdi mdi-account-tie"></i>
                                                        <span>Fase 1</span>
                                                    </a>

                                                    <a href="{{ route('pra-landbank.proses', ['id' => $land->id, 'step' => 2]) }}" 
                                                       class="btn-fase-action btn-fase-2" 
                                                       title="FASE 2: Survey">
                                                        <i class="mdi mdi-map-search"></i>
                                                        <span>Fase 2</span>
                                                    </a>

                                                    @if($land->status !== 'fase1' && ($land->status !== 'pending' || !empty($land->survey_date) || !empty($land->survey_by)))
                                                        <a href="{{ route('pra-landbank.proses', ['id' => $land->id, 'step' => 3]) }}" 
                                                           class="btn-fase-action btn-fase-3" 
                                                           title="FASE 3: Persetujuan">
                                                            <i class="mdi mdi-check-decagram"></i>
                                                            <span>Fase 3</span>
                                                        </a>
                                                    @endif

                                                    <form action="{{ route('pra-landbanks.destroy', $land->id) }}"
                                                        method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn-fase-action btn-fase-delete delete-btn" title="Hapus Data">
                                                            <i class="mdi mdi-trash-can-outline"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center text-muted">
                                                Tidak ada data
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mt-4">
                            <div class="pagination-info mb-2 mb-sm-0" id="paginationInfo">
                                Menampilkan 1 - 1 dari 1 data
                            </div>
                            <nav aria-label="Page navigation">
                                <ul class="pagination pagination-sm flex-wrap justify-content-center mb-0"
                                    id="pagination">
                                    <li class="page-item disabled"><span class="page-link"><i
                                                class="mdi mdi-chevron-left"></i></span></li>
                                    <li class="page-item active"><span class="page-link">1</span></li>
                                    <li class="page-item disabled"><span class="page-link"><i
                                                class="mdi mdi-chevron-right"></i></span></li>
                                </ul>
                            </nav>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Cek pesan sukses dari sessionStorage (setelah reload)
            const pendingMsg = sessionStorage.getItem('success_message');
            if (pendingMsg) {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: pendingMsg,
                    timer: 2000,
                    showConfirmButton: false
                });
                sessionStorage.removeItem('success_message');
            }

            // Konfirmasi hapus dengan SweetAlert2
            document.querySelectorAll('.delete-btn').forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const form = this.closest('form');
                    const url = form.getAttribute('action');
                    const token = form.querySelector('input[name="_token"]').value;
                    
                    Swal.fire({
                        title: 'Apakah Anda yakin?',
                        text: "Data Pra Land Bank yang dihapus tidak dapat dikembalikan!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#dc3545',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'Ya, Hapus!',
                        cancelButtonText: 'Batal',
                        reverseButtons: true
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Show loading
                            Swal.fire({
                                title: 'Menghapus...',
                                text: 'Mohon tunggu sebentar',
                                allowOutsideClick: false,
                                didOpen: () => {
                                    Swal.showLoading();
                                }
                            });

                            // Kirim request AJAX
                            fetch(url, {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': token
                                },
                                body: JSON.stringify({
                                    _method: 'DELETE'
                                })
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    sessionStorage.setItem('success_message', 'Data Pra Land Bank berhasil dihapus.');
                                    window.location.reload();
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Gagal',
                                        text: data.message || 'Gagal menghapus data.',
                                    });
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: 'Terjadi kesalahan sistem saat menghapus data.',
                                });
                            });
                        }
                    });
                });
            });
        });
    </script>
@endpush
