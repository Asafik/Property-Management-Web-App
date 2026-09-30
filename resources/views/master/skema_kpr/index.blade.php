@extends('layouts.partial.app')

@section('title', 'Master Skema Angsuran KPR - Property Management App')

@section('content')

<div class="container-fluid px-1 px-sm-2 px-md-3 py-2 py-md-3">

    <!-- Header Card Banner -->
    <div class="row mb-3 mb-md-4">
        <div class="col-12">
            <div class="card shadow-sm border-0 header-card" style="background: linear-gradient(135deg, #ffffff, #faf5ff); border-left: 5px solid #9a55ff !important;">
                <div class="card-body p-4 d-flex justify-content-between align-items-center" style="min-height: 105px;">
                    <div>
                        <h3 class="text-dark mb-1 fw-bold" style="font-size: 1.35rem;">
                            <i class="mdi mdi-calculator-variant-outline me-2 text-primary"></i>Master Skema Angsuran KPR
                        </h3>
                        <p class="text-muted mb-0" style="font-size: 0.9rem;">
                            Kelola data nominal angsuran flat KPR per bank, produk, dan tenor tahun (Tahun 1-5, 6-10, dst) untuk pengajuan KPR
                        </p>
                    </div>
                    <div class="d-none d-sm-block pe-2">
                        <i class="mdi mdi-chart-timeline-variant" style="font-size: 3rem; color: #9a55ff; opacity: 0.25;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Alert Success / Error -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show d-flex align-items-center mb-3" role="alert">
            <i class="mdi mdi-check-circle fs-5 me-2"></i>
            <div>{{ session('success') }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center mb-3" role="alert">
            <i class="mdi mdi-alert-circle fs-5 me-2"></i>
            <div>{{ session('error') }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row mt-2">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white d-flex flex-wrap justify-content-between align-items-center gap-2 py-3">
                    <h5 class="card-title mb-0 fw-bold">
                        <i class="mdi mdi-format-list-bulleted me-2 text-primary"></i>Daftar Skema Angsuran Flat KPR
                    </h5>
                    <button type="button" class="btn btn-sm btn-gradient-primary d-flex align-items-center gap-1 shadow-sm px-3 py-2 fw-semibold" onclick="openModalTambah()">
                        <i class="mdi mdi-plus-circle" style="font-size: 1rem;"></i>
                        <span>Tambah Skema KPR</span>
                    </button>
                </div>

                <div class="card-body">
                    <!-- Filter Section -->
                    <div class="p-3 mb-3 rounded-3 border bg-light">
                        <form id="filterForm" method="GET" action="{{ route('master.skema-kpr.index') }}">
                            <div class="row g-2 align-items-center">
                                <div class="col-12 col-md-3">
                                    <input type="text" class="form-control form-control-sm" name="search"
                                        placeholder="Cari skema, periode, atau bank..." value="{{ request('search') }}">
                                </div>
                                <div class="col-6 col-md-2">
                                    <select class="form-select form-select-sm" name="bank_id">
                                        <option value="">-- Semua Bank --</option>
                                        @foreach($banks as $b)
                                            <option value="{{ $b->id }}" {{ request('bank_id') == $b->id ? 'selected' : '' }}>{{ $b->bank_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-6 col-md-2">
                                    <select class="form-select form-select-sm" name="tenor">
                                        <option value="">-- Semua Tenor --</option>
                                        <option value="5" {{ request('tenor') == '5' ? 'selected' : '' }}>5 Tahun</option>
                                        <option value="10" {{ request('tenor') == '10' ? 'selected' : '' }}>10 Tahun</option>
                                        <option value="15" {{ request('tenor') == '15' ? 'selected' : '' }}>15 Tahun</option>
                                        <option value="20" {{ request('tenor') == '20' ? 'selected' : '' }}>20 Tahun</option>
                                    </select>
                                </div>
                                <div class="col-6 col-md-2">
                                    <select class="form-select form-select-sm" name="produk_kpr">
                                        <option value="">-- Semua Produk --</option>
                                        <option value="subsidi" {{ request('produk_kpr') == 'subsidi' ? 'selected' : '' }}>KPR Subsidi</option>
                                        <option value="non_subsidi" {{ request('produk_kpr') == 'non_subsidi' ? 'selected' : '' }}>KPR Non Subsidi</option>
                                        <option value="syariah" {{ request('produk_kpr') == 'syariah' ? 'selected' : '' }}>KPR Syariah</option>
                                    </select>
                                </div>
                                <div class="col-6 col-md-3 d-flex gap-2">
                                    <button type="submit" class="btn btn-sm btn-primary px-3 fw-semibold">
                                        <i class="mdi mdi-filter me-1"></i>Filter
                                    </button>
                                    <a href="{{ route('master.skema-kpr.index') }}" class="btn btn-sm btn-outline-secondary px-3">
                                        <i class="mdi mdi-refresh me-1"></i>Reset
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Table Data -->
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0" style="font-size: 0.88rem;">
                            <thead class="table-light text-muted">
                                <tr>
                                    <th class="text-center" style="width: 50px;">No</th>
                                    <th>Bank Tujuan</th>
                                    <th>Produk KPR</th>
                                    <th>Tenor</th>
                                    <th>Bunga (%)</th>
                                    <th>Periode Cicilan (Flat)</th>
                                    <th>Angsuran / Bulan</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center" style="width: 120px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($skemas as $index => $item)
                                    <tr>
                                        <td class="text-center fw-bold">{{ $skemas->firstItem() + $index }}</td>
                                        <td>
                                            <div class="fw-bold text-dark d-flex align-items-center gap-1.5">
                                                <i class="mdi mdi-bank text-primary"></i>
                                                <span>{{ $item->bank->bank_name ?? '-' }}</span>
                                            </div>
                                            @if($item->nama_skema)
                                                <small class="text-muted">{{ $item->nama_skema }}</small>
                                            @endif
                                        </td>
                                        <td>
                                            @if($item->produk_kpr === 'subsidi')
                                                <span class="badge bg-success bg-opacity-10 text-success fw-bold px-2 py-1">KPR Subsidi</span>
                                            @elseif($item->produk_kpr === 'syariah')
                                                <span class="badge bg-info bg-opacity-10 text-info fw-bold px-2 py-1">KPR Syariah</span>
                                            @else
                                                <span class="badge bg-primary bg-opacity-10 text-primary fw-bold px-2 py-1">KPR Non Subsidi</span>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="fw-bold">{{ $item->tenor }} Tahun</span>
                                            <small class="text-muted d-block">({{ $item->tenor * 12 }} Bulan)</small>
                                        </td>
                                        <td>
                                            <span class="badge bg-secondary bg-opacity-10 text-dark fw-bold">{{ number_format($item->bunga, 2, ',', '.') }}%</span>
                                        </td>
                                        <td>
                                            <span class="badge px-2.5 py-1.5" style="background: #ede9fe; color: #7c3aed; font-weight: 700; font-size: 0.8rem;">
                                                <i class="mdi mdi-calendar-check me-1"></i>{{ $item->periode_tahun }}
                                            </span>
                                            @if($item->keterangan)
                                                <small class="text-muted d-block mt-0.5" style="font-size: 0.74rem;">{{ $item->keterangan }}</small>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="fw-bold text-success fs-6">
                                                Rp {{ number_format($item->angsuran_per_bulan, 0, ',', '.') }}
                                            </span>
                                            <span class="text-muted small">/bln</span>
                                        </td>
                                        <td class="text-center">
                                            @if($item->is_active)
                                                <span class="badge bg-success px-2 py-1">Aktif</span>
                                            @else
                                                <span class="badge bg-secondary px-2 py-1">Nonaktif</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <div class="d-inline-flex gap-1">
                                                <button type="button" class="btn btn-sm btn-outline-primary py-1 px-2" title="Edit Skema" onclick="openModalEdit({{ $item->id }})">
                                                    <i class="mdi mdi-pencil"></i>
                                                </button>
                                                <button type="button" class="btn btn-sm btn-outline-danger py-1 px-2" title="Hapus Skema" onclick="confirmDelete({{ $item->id }})">
                                                    <i class="mdi mdi-trash-can"></i>
                                                </button>
                                            </div>
                                            <form id="delete-form-{{ $item->id }}" action="{{ route('master.skema-kpr.destroy', $item->id) }}" method="POST" style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center py-4 text-muted">
                                            <i class="mdi mdi-information-outline fs-3 d-block mb-1 text-secondary"></i>
                                            Belum ada data skema angsuran KPR. Silakan klik tombol <strong>Tambah Skema KPR</strong> di atas.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-between align-items-center mt-3 flex-wrap gap-2">
                        <small class="text-muted">
                            Menampilkan {{ $skemas->firstItem() ?? 0 }} - {{ $skemas->lastItem() ?? 0 }} dari {{ $skemas->total() }} data
                        </small>
                        <div>
                            {{ $skemas->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- MODAL TAMBAH / EDIT SKEMA KPR -->
<div class="modal fade" id="modalSkemaKpr" tabindex="-1" aria-labelledby="modalSkemaKprLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content" style="border-radius: 12px; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.15);">
            <form id="formSkemaKpr" method="POST" action="{{ route('master.skema-kpr.store') }}">
                @csrf
                <div id="methodContainer"></div>

                <div class="modal-header border-bottom py-3 px-4 bg-light">
                    <h5 class="modal-title fw-bold text-dark" id="modalSkemaKprLabel">
                        <i class="mdi mdi-calculator-variant me-1 text-primary"></i>Tambah Skema Angsuran KPR
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body p-4">
                    <div class="row g-3">
                        <div class="col-12 col-md-6">
                            <label class="form-label small fw-bold text-dark">Bank Tujuan <span class="text-danger">*</span></label>
                            <select class="form-select form-select-sm" name="bank_id" id="modal_bank_id" required>
                                <option value="">-- Pilih Bank --</option>
                                @foreach($banks as $b)
                                    <option value="{{ $b->id }}">{{ $b->bank_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-12 col-md-6">
                            <label class="form-label small fw-bold text-dark">Produk KPR <span class="text-danger">*</span></label>
                            <select class="form-select form-select-sm" name="produk_kpr" id="modal_produk_kpr" required>
                                <option value="subsidi">KPR Subsidi</option>
                                <option value="non_subsidi">KPR Non Subsidi</option>
                                <option value="syariah">KPR Syariah</option>
                            </select>
                        </div>

                        <div class="col-12">
                            <label class="form-label small fw-bold text-dark">Nama Skema (Opsional)</label>
                            <input type="text" class="form-control form-control-sm" name="nama_skema" id="modal_nama_skema" placeholder="Contoh: KPR Subsidi FLPP BTN">
                        </div>

                        <div class="col-12 col-md-6">
                            <label class="form-label small fw-bold text-dark">Tenor Angsuran <span class="text-danger">*</span></label>
                            <select class="form-select form-select-sm" name="tenor" id="modal_tenor" required>
                                <option value="5">5 Tahun (60 Bulan)</option>
                                <option value="10">10 Tahun (120 Bulan)</option>
                                <option value="15" selected>15 Tahun (180 Bulan)</option>
                                <option value="20">20 Tahun (240 Bulan)</option>
                            </select>
                        </div>

                        <div class="col-12 col-md-6">
                            <label class="form-label small fw-bold text-dark">Suku Bunga (%) <span class="text-danger">*</span></label>
                            <div class="input-group input-group-sm">
                                <input type="number" step="0.01" class="form-control" name="bunga" id="modal_bunga" value="5.00" required>
                                <span class="input-group-text">%</span>
                            </div>
                        </div>

                        <div class="col-12">
                            <label class="form-label small fw-bold text-dark">Periode Tahun (Flat) <span class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-sm" name="periode_tahun" id="modal_periode_tahun" required placeholder="Contoh: Tahun 1 - 5, Tahun 6 - 10, atau Flat Sepanjang Tenor">
                            <small class="text-muted" style="font-size: 0.74rem;">Bisa diisi rentang tahun (misal: Tahun 1 - 5) atau 'Flat Sepanjang Tenor'.</small>
                        </div>

                        <div class="col-12">
                            <label class="form-label small fw-bold text-dark">Nominal Angsuran Flat per Bulan (Rp) <span class="text-danger">*</span></label>
                            <div class="input-group input-group-sm">
                                <span class="input-group-text fw-bold text-success">Rp</span>
                                <input type="number" class="form-control fw-bold text-success" name="angsuran_per_bulan" id="modal_angsuran_per_bulan" required placeholder="Contoh: 700000" min="0" step="1000">
                            </div>
                        </div>

                        <div class="col-12">
                            <label class="form-label small fw-bold text-dark">Keterangan Tambahan</label>
                            <textarea class="form-control form-control-sm" name="keterangan" id="modal_keterangan" rows="2" placeholder="Catatan syarat ketentuan cicilan"></textarea>
                        </div>

                        <div class="col-12">
                            <div class="form-check form-switch mt-1">
                                <input class="form-check-input" type="checkbox" name="is_active" id="modal_is_active" value="1" checked>
                                <label class="form-check-label small fw-semibold text-dark" for="modal_is_active">Aktifkan Skema Ini</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer border-top py-2.5 px-4 bg-light d-flex justify-content-between">
                    <button type="button" class="btn btn-sm btn-light border px-3" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-sm btn-primary px-4 fw-bold">
                        <i class="mdi mdi-content-save me-1"></i>Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
let modalEl = null;

function getModal() {
    if (!modalEl) {
        modalEl = new bootstrap.Modal(document.getElementById('modalSkemaKpr'));
    }
    return modalEl;
}

function openModalTambah() {
    $('#modalSkemaKprLabel').html('<i class="mdi mdi-calculator-variant me-1 text-primary"></i>Tambah Skema Angsuran KPR');
    $('#formSkemaKpr').attr('action', "{{ route('master.skema-kpr.store') }}");
    $('#methodContainer').html('');
    
    // Reset inputs
    $('#modal_bank_id').val('');
    $('#modal_produk_kpr').val('subsidi');
    $('#modal_nama_skema').val('');
    $('#modal_tenor').val('15');
    $('#modal_bunga').val('5.00');
    $('#modal_periode_tahun').val('Tahun 1 - 5');
    $('#modal_angsuran_per_bulan').val('');
    $('#modal_keterangan').val('');
    $('#modal_is_active').prop('checked', true);

    getModal().show();
}

function openModalEdit(id) {
    Swal.fire({
        title: 'Memuat data...',
        allowOutsideClick: false,
        didOpen: () => { Swal.showLoading(); }
    });

    $.ajax({
        url: "{{ url('master-skema-kpr') }}/" + id + "/edit",
        type: 'GET',
        success: function(data) {
            Swal.close();
            $('#modalSkemaKprLabel').html('<i class="mdi mdi-pencil me-1 text-primary"></i>Edit Skema Angsuran KPR');
            $('#formSkemaKpr').attr('action', "{{ url('master-skema-kpr') }}/" + id);
            $('#methodContainer').html('@method("PUT")');

            $('#modal_bank_id').val(data.bank_id);
            $('#modal_produk_kpr').val(data.produk_kpr);
            $('#modal_nama_skema').val(data.nama_skema);
            $('#modal_tenor').val(data.tenor);
            $('#modal_bunga').val(data.bunga);
            $('#modal_periode_tahun').val(data.periode_tahun);
            $('#modal_angsuran_per_bulan').val(data.angsuran_per_bulan);
            $('#modal_keterangan').val(data.keterangan);
            $('#modal_is_active').prop('checked', data.is_active == 1);

            getModal().show();
        },
        error: function(err) {
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: 'Tidak dapat memuat detail skema KPR.'
            });
        }
    });
}

function confirmDelete(id) {
    Swal.fire({
        title: 'Hapus Skema KPR?',
        text: 'Data skema angsuran ini akan dihapus secara permanen.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, Hapus',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('delete-form-' + id).submit();
        }
    });
}
</script>
@endpush
