@extends('layouts.partial.app')

@section('title', 'Master Data SPK Kontraktor - Property Management App')

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

        .btn-spk-view {
            background: linear-gradient(135deg, #da8cff, #9a55ff);
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

        <!-- Header Card Banner -->
        <div class="row mb-3 mb-md-4">
            <div class="col-12">
                <div class="card shadow-sm border-0 header-card">
                    <div class="card-body p-4 p-md-4 py-4 py-md-4 d-flex justify-content-between align-items-center" style="min-height: 105px;">
                        <div>
                            <h3 class="text-dark mb-1 fw-bold" style="font-size: 1.35rem;">
                                SPK / Surat Perintah Kerja
                            </h3>
                            <p class="text-muted mb-0" style="font-size: 0.9rem;">
                                Kelola data SPK kontraktor, berkas kontrak, dan keterangan pekerjaan
                            </p>
                        </div>
                        <div class="d-none d-sm-block pe-2">
                            <i class="mdi mdi-file-sign" style="font-size: 3rem; color: #9a55ff; opacity: 0.25;"></i>
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
                        <button type="button" class="btn btn-sm btn-gradient-primary d-inline-flex align-items-center" style="gap: 5px;" onclick="openModalUploadSpk()">
                            <i class="mdi mdi-plus me-1"></i>Tambah SPK Kontraktor
                        </button>
                    </div>

                    <div class="card-body card-body-compact">
                        <!-- Filter Section -->
                        <div class="filter-card filter-card-compact">
                            <!-- Desktop Filter -->
                            <div class="filter-row-desktop d-none d-md-block">
                                <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 w-100">
                                    <div style="width: 280px;">
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="searchInput"
                                                placeholder="Cari nomor SPK / kontraktor..."
                                                onkeyup="filterSpkTable()"
                                                style="border-top-right-radius: 0 !important; border-bottom-right-radius: 0 !important; border-right: none; height: 38px;">
                                            <button class="btn btn-gradient-primary d-flex align-items-center justify-content-center px-3" 
                                                type="button" title="Cari" onclick="filterSpkTable()"
                                                style="border-top-left-radius: 0 !important; border-bottom-left-radius: 0 !important; border-top-right-radius: 4px !important; border-bottom-right-radius: 4px !important; height: 38px; box-shadow: none;">
                                                <i class="mdi mdi-magnify" style="font-size: 1.15rem; color: #ffffff;"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-center gap-2 ms-auto">
                                        <div style="width: 110px;">
                                            <select class="form-control select2" id="limitSelect" style="width: 100%;">
                                                <option value="5">5 Data</option>
                                                <option value="10" selected>10 Data</option>
                                                <option value="15">15 Data</option>
                                                <option value="25">25 Data</option>
                                            </select>
                                        </div>

                                        <button type="button"
                                            class="btn btn-gradient-primary btn-icon-only"
                                            title="Filter" onclick="filterSpkTable()">
                                            <i class="mdi mdi-filter"></i>
                                        </button>
                                        <button type="button"
                                            class="btn btn-gradient-secondary btn-icon-only"
                                            title="Reset" onclick="resetSpkFilter()">
                                            <i class="mdi mdi-refresh"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Mobile Filter -->
                            <div class="filter-row-mobile d-block d-md-none">
                                <div class="row g-2">
                                    <div class="col-12 mb-2">
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="searchInputMobile"
                                                placeholder="Cari nomor SPK atau kontraktor..."
                                                onkeyup="filterSpkTableMobile()"
                                                style="border-top-right-radius: 0 !important; border-bottom-right-radius: 0 !important; border-right: none; height: 38px;">
                                            <button class="btn btn-gradient-primary d-flex align-items-center justify-content-center px-3" 
                                                type="button" title="Cari" onclick="filterSpkTableMobile()"
                                                style="border-top-left-radius: 0 !important; border-bottom-left-radius: 0 !important; border-top-right-radius: 4px !important; border-bottom-right-radius: 4px !important; height: 38px; box-shadow: none;">
                                                <i class="mdi mdi-magnify" style="font-size: 1.15rem; color: #ffffff;"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-6 mb-2">
                                        <select class="form-control select2" id="limitSelectMobile" style="width: 100%;">
                                            <option value="5">5 Data</option>
                                            <option value="10" selected>10 Data</option>
                                            <option value="15">15 Data</option>
                                            <option value="25">25 Data</option>
                                        </select>
                                    </div>
                                    <div class="col-3 mb-2">
                                        <button type="button"
                                            class="btn btn-gradient-primary w-100 d-flex align-items-center justify-content-center"
                                            style="height: 38px;"
                                            title="Filter" onclick="filterSpkTableMobile()">
                                            <i class="mdi mdi-filter"></i>
                                        </button>
                                    </div>
                                    <div class="col-3 mb-2">
                                        <button type="button"
                                            class="btn btn-gradient-secondary w-100 d-flex align-items-center justify-content-center"
                                            style="height: 38px;"
                                            title="Reset" onclick="resetSpkFilter()">
                                            <i class="mdi mdi-refresh"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Table Wrapper -->
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 60px;">NO</th>
                                        <th style="width: 220px;">NOMOR SPK</th>
                                        <th>KONTRAKTOR</th>
                                        <th class="text-center" style="width: 180px;">FILE SPK</th>
                                        <th>KETERANGAN</th>
                                        <th class="text-center" style="width: 180px;">AKSI</th>
                                    </tr>
                                </thead>
                                <tbody id="spkTableBody">
                                    @forelse ($spkList as $index => $spk)
                                        <tr class="spk-row" data-no-spk="{{ strtolower($spk['no_spk']) }}" data-kontraktor="{{ strtolower($spk['kontraktor']) }}">
                                            <td class="text-center fw-bold text-muted">{{ $index + 1 }}</td>
                                            <td>
                                                <i class="mdi mdi-file-document-outline text-primary me-1"></i>
                                                <span class="fw-bold text-dark">{{ $spk['no_spk'] }}</span>
                                            </td>
                                            <td>
                                                <i class="mdi mdi-account-tie me-1 text-muted"></i>
                                                <span class="fw-bold text-dark">{{ $spk['kontraktor'] }}</span>
                                            </td>
                                            <td class="text-center">
                                                @if($spk['file_spk'])
                                                    <button type="button" class="btn btn-xs btn-outline-primary py-1 px-2 d-inline-flex align-items-center gap-1" style="border-radius: 6px; font-size: 11px;" onclick="previewDummySpk('{{ $spk['no_spk'] }}', '{{ $spk['kontraktor'] }}')">
                                                        <i class="mdi mdi-file-pdf-box text-danger fs-6"></i>
                                                        <span>Lihat Berkas SPK</span>
                                                    </button>
                                                @else
                                                    <span class="badge bg-light text-muted border py-1 px-2" style="font-size: 10px;">
                                                        <i class="mdi mdi-clock-outline me-1"></i>Belum Diunggah
                                                    </span>
                                                @endif
                                            </td>
                                            <td>
                                                <span class="text-dark small d-inline-block" title="{{ $spk['keterangan'] }}">
                                                    {{ $spk['keterangan'] }}
                                                </span>
                                            </td>
                                            <td class="text-center text-nowrap">
                                                <div class="d-inline-flex align-items-center gap-1">
                                                    <button type="button" 
                                                       class="btn-fase-action btn-spk-view" 
                                                       title="Lihat Detail SPK"
                                                       onclick="showDetailSpk('{{ $spk['no_spk'] }}', '{{ $spk['kontraktor'] }}', '{{ $spk['keterangan'] }}')">
                                                        <i class="mdi mdi-eye"></i>
                                                    </button>

                                                    <button type="button" 
                                                       class="btn-fase-action btn-spk-edit" 
                                                       title="Edit Data SPK"
                                                       onclick="editDummySpk('{{ $spk['no_spk'] }}', '{{ $spk['kontraktor'] }}', '{{ $spk['keterangan'] }}')">
                                                        <i class="mdi mdi-pencil"></i>
                                                    </button>

                                                    <button type="button" class="btn-fase-action btn-spk-delete delete-btn" title="Hapus SPK" onclick="deleteDummySpk(this, '{{ $spk['no_spk'] }}')">
                                                        <i class="mdi mdi-trash-can-outline"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr id="emptyRow">
                                            <td colspan="6" class="text-center py-5 text-muted">
                                                Tidak ada data
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination Footer -->
                        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mt-4">
                            <div class="pagination-info mb-2 mb-sm-0 text-muted small" id="paginationInfo">
                                Menampilkan 1 - {{ count($spkList) }} dari {{ count($spkList) }} data
                            </div>
                            <nav aria-label="Page navigation">
                                <ul class="pagination pagination-sm flex-wrap justify-content-center mb-0">
                                    <li class="page-item disabled"><span class="page-link"><i class="mdi mdi-chevron-left"></i></span></li>
                                    <li class="page-item active"><span class="page-link" style="background-color: #9a55ff; border-color: #9a55ff;">1</span></li>
                                    <li class="page-item"><span class="page-link">2</span></li>
                                    <li class="page-item"><span class="page-link"><i class="mdi mdi-chevron-right"></i></span></li>
                                </ul>
                            </nav>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- ============================================================== -->
    <!-- MODAL: TAMBAH / UPLOAD SPK BARU -->
    <!-- ============================================================== -->
    <div class="modal fade" id="modalUploadSpk" tabindex="-1" aria-labelledby="modalUploadSpkLabel" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content border-0 shadow" style="border-radius: 12px;">
                <div class="modal-header bg-white border-bottom py-3 px-4" style="border-top-left-radius: 12px; border-top-right-radius: 12px;">
                    <div class="d-flex align-items-center gap-2">
                        <div class="p-2 rounded-2" style="background: rgba(154, 85, 255, 0.1); color: #9a55ff;">
                            <i class="mdi mdi-file-plus fs-5"></i>
                        </div>
                        <div>
                            <h5 class="modal-title mb-0 fw-bold text-dark" id="modalUploadSpkLabel" style="font-size: 1.05rem;">Tambah SPK Kontraktor</h5>
                            <small class="text-muted">Isi data Surat Perintah Kerja baru</small>
                        </div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                
                <form id="formUploadSpk" onsubmit="handleSaveNewSpk(event)">
                    <div class="modal-body p-4">
                        <div class="row g-3">
                            
                            <!-- Nomor SPK -->
                            <div class="col-12">
                                <label class="form-label fw-semibold text-dark small">Nomor SPK <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="modal_no_spk" placeholder="Contoh: SPK/2026/PROJ/021" required style="border-radius: 6px;">
                            </div>

                            <!-- Nama Kontraktor / Vendor -->
                            <div class="col-12">
                                <label class="form-label fw-semibold text-dark small">Nama Kontraktor <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="modal_kontraktor" placeholder="Contoh: PT. Maju Konstruksi Nusantara" required style="border-radius: 6px;">
                            </div>

                            <!-- Upload File Dokumen SPK -->
                            <div class="col-12">
                                <label class="form-label fw-semibold text-dark small">Upload File SPK (PDF / DOCX / JPG)</label>
                                <div class="p-3 border rounded-3 text-center" style="border: 2px dashed #d8b4fe !important; background: #faf5ff;">
                                    <input type="file" id="modal_file_spk" class="d-none" onchange="handleModalSpkFile(this)">
                                    <label for="modal_file_spk" class="cursor-pointer mb-0 w-100">
                                        <i class="mdi mdi-cloud-upload-outline fs-2 text-purple" style="color: #9a55ff;"></i>
                                        <div class="mt-1 fw-bold text-dark" id="modal_file_name_label">Klik untuk unggah atau seret berkas ke sini</div>
                                        <small class="text-muted">Mendukung format PDF, DOCX, JPG (Maksimal 15MB)</small>
                                    </label>
                                </div>
                            </div>

                            <!-- Keterangan Pekerjaan -->
                            <div class="col-12">
                                <label class="form-label fw-semibold text-dark small">Keterangan</label>
                                <textarea class="form-control" id="modal_keterangan" rows="3" placeholder="Masukkan keterangan / catatan SPK..." style="border-radius: 6px;"></textarea>
                            </div>

                        </div>
                    </div>

                    <div class="modal-footer bg-light px-4 py-3 border-top" style="border-bottom-left-radius: 12px; border-bottom-right-radius: 12px;">
                        <button type="button" class="btn btn-secondary px-4 py-2" data-bs-dismiss="modal" style="border-radius: 6px;">Batal</button>
                        <button type="submit" class="btn btn-gradient-primary px-4 py-2 fw-semibold text-white shadow-sm" style="background: linear-gradient(to right, #da8cff, #9a55ff); border: none; border-radius: 6px;">
                            <i class="mdi mdi-content-save-outline me-1"></i>Simpan SPK
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- ============================================================== -->
    <!-- MODAL: DETAIL SPK -->
    <!-- ============================================================== -->
    <div class="modal fade" id="modalDetailSpk" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow" style="border-radius: 12px;">
                <div class="modal-header bg-light border-bottom">
                    <h5 class="modal-title fw-bold text-dark" id="detail_spk_title">Detail Surat Perintah Kerja</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="text-center mb-4">
                        <div class="p-3 d-inline-block rounded-circle" style="background: rgba(154, 85, 255, 0.1); color: #9a55ff;">
                            <i class="mdi mdi-file-sign fs-1"></i>
                        </div>
                        <h5 class="fw-bold text-dark mt-2 mb-1" id="detail_no_spk">-</h5>
                        <span class="badge bg-purple text-white px-3 py-1" style="background: #9a55ff;">SPK Kontraktor</span>
                    </div>

                    <div class="border rounded-3 p-3 bg-light mb-3">
                        <div class="row g-2 small">
                            <div class="col-5 text-muted">Nomor SPK:</div>
                            <div class="col-7 fw-bold text-dark text-end" id="detail_no_val">-</div>
                            <div class="col-5 text-muted">Kontraktor:</div>
                            <div class="col-7 fw-bold text-primary text-end" id="detail_kontraktor">-</div>
                        </div>
                    </div>

                    <div>
                        <label class="fw-bold text-dark small mb-1">Keterangan:</label>
                        <p class="text-muted small mb-0 p-2 border rounded-2 bg-white" id="detail_keterangan">-</p>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary btn-sm px-3" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        if ($('#limitSelect').length) {
            $('#limitSelect').select2({
                theme: 'bootstrap-5',
                width: '100%',
                minimumResultsForSearch: Infinity
            });
        }
        if ($('#limitSelectMobile').length) {
            $('#limitSelectMobile').select2({
                theme: 'bootstrap-5',
                width: '100%',
                minimumResultsForSearch: Infinity
            });
        }
    });

    // 1. Open Modal Upload
    function openModalUploadSpk() {
        document.getElementById('formUploadSpk').reset();
        document.getElementById('modal_file_name_label').textContent = 'Klik untuk unggah atau seret berkas ke sini';
        
        const randomNum = Math.floor(100 + Math.random() * 900);
        document.getElementById('modal_no_spk').value = `SPK/2026/PROJ/${randomNum}`;
        
        const modal = new bootstrap.Modal(document.getElementById('modalUploadSpk'));
        modal.show();
    }

    // 2. File Input Label change
    function handleModalSpkFile(input) {
        if (input.files && input.files[0]) {
            document.getElementById('modal_file_name_label').innerHTML = `<span class="text-success fw-bold"><i class="mdi mdi-check-circle me-1"></i>${input.files[0].name}</span>`;
        }
    }

    // 3. Save New SPK (Dummy Simulation)
    function handleSaveNewSpk(e) {
        e.preventDefault();

        const noSpk = document.getElementById('modal_no_spk').value;
        const kontraktor = document.getElementById('modal_kontraktor').value;
        const keterangan = document.getElementById('modal_keterangan').value || '-';

        bootstrap.Modal.getInstance(document.getElementById('modalUploadSpk')).hide();

        Swal.fire({
            title: 'Menyimpan Dokumen SPK...',
            allowOutsideClick: false,
            didOpen: () => Swal.showLoading()
        });

        setTimeout(() => {
            const tbody = document.getElementById('spkTableBody');
            const emptyRow = document.getElementById('emptyRow');
            if (emptyRow) emptyRow.remove();

            const newIndex = document.querySelectorAll('.spk-row').length + 1;
            const tr = document.createElement('tr');
            tr.className = 'spk-row';
            tr.setAttribute('data-no-spk', noSpk.toLowerCase());
            tr.setAttribute('data-kontraktor', kontraktor.toLowerCase());
            tr.style.animation = 'fadeIn 0.4s ease';

            tr.innerHTML = `
                <td class="text-center fw-bold text-muted">${newIndex}</td>
                <td>
                    <i class="mdi mdi-file-document-outline text-primary me-1"></i>
                    <span class="fw-bold text-dark">${noSpk}</span>
                </td>
                <td>
                    <i class="mdi mdi-account-tie me-1 text-muted"></i>
                    <span class="fw-bold text-dark">${kontraktor}</span>
                </td>
                <td class="text-center">
                    <button type="button" class="btn btn-xs btn-outline-primary py-1 px-2 d-inline-flex align-items-center gap-1" style="border-radius: 6px; font-size: 11px;" onclick="previewDummySpk('${noSpk}', '${kontraktor}')">
                        <i class="mdi mdi-file-pdf-box text-danger fs-6"></i>
                        <span>Lihat Berkas SPK</span>
                    </button>
                </td>
                <td>
                    <span class="text-dark small d-inline-block" title="${keterangan}">
                        ${keterangan}
                    </span>
                </td>
                <td class="text-center text-nowrap">
                    <div class="d-inline-flex align-items-center gap-1">
                        <button type="button" 
                           class="btn-fase-action btn-spk-view" 
                           title="Lihat Detail SPK"
                           onclick="showDetailSpk('${noSpk}', '${kontraktor}', '${keterangan}')">
                            <i class="mdi mdi-eye"></i>
                        </button>

                        <button type="button" 
                           class="btn-fase-action btn-spk-edit" 
                           title="Edit Data SPK"
                           onclick="editDummySpk('${noSpk}', '${kontraktor}', '${keterangan}')">
                            <i class="mdi mdi-pencil"></i>
                        </button>

                        <button type="button" class="btn-fase-action btn-spk-delete delete-btn" title="Hapus SPK" onclick="deleteDummySpk(this, '${noSpk}')">
                            <i class="mdi mdi-trash-can-outline"></i>
                        </button>
                    </div>
                </td>
            `;

            tbody.prepend(tr);

            const currentTotal = document.querySelectorAll('.spk-row').length;
            document.getElementById('paginationInfo').innerText = `Menampilkan 1 - ${currentTotal} dari ${currentTotal} data`;

            Swal.fire({
                icon: 'success',
                title: 'SPK Berhasil Disimpan!',
                text: `Surat Perintah Kerja ${noSpk} untuk ${kontraktor} telah tersimpan.`,
                timer: 2000,
                showConfirmButton: false
            });
        }, 500);
    }

    // 4. Filter & Search Table
    function filterSpkTable() {
        const search = document.getElementById('searchInput').value.toLowerCase();
        const rows = document.querySelectorAll('.spk-row');
        let visibleCount = 0;

        rows.forEach(row => {
            const noSpk = row.getAttribute('data-no-spk') || '';
            const kontraktor = row.getAttribute('data-kontraktor') || '';

            const matchSearch = noSpk.includes(search) || kontraktor.includes(search);

            if (matchSearch) {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });

        document.getElementById('paginationInfo').innerText = `Menampilkan 1 - ${visibleCount} dari ${visibleCount} data`;
    }

    function filterSpkTableMobile() {
        const search = document.getElementById('searchInputMobile').value.toLowerCase();
        const rows = document.querySelectorAll('.spk-row');
        let visibleCount = 0;

        rows.forEach(row => {
            const noSpk = row.getAttribute('data-no-spk') || '';
            const kontraktor = row.getAttribute('data-kontraktor') || '';

            const matchSearch = noSpk.includes(search) || kontraktor.includes(search);

            if (matchSearch) {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });

        document.getElementById('paginationInfo').innerText = `Menampilkan 1 - ${visibleCount} dari ${visibleCount} data`;
    }

    function resetSpkFilter() {
        if (document.getElementById('searchInput')) document.getElementById('searchInput').value = '';
        if (document.getElementById('searchInputMobile')) document.getElementById('searchInputMobile').value = '';
        filterSpkTable();
    }

    // 5. Preview File SPK Dummy
    function previewDummySpk(noSpk, kontraktor) {
        Swal.fire({
            title: `Berkas SPK: ${noSpk}`,
            html: `
                <div class="text-center p-3">
                    <i class="mdi mdi-file-pdf-box text-danger" style="font-size: 4rem;"></i>
                    <h6 class="fw-bold text-dark mt-2">${noSpk}.pdf</h6>
                    <p class="text-muted small mb-3">Kontraktor: ${kontraktor}</p>
                    <div class="alert alert-info py-2 small mb-0">
                        <i class="mdi mdi-information-outline me-1"></i>Dokumen fisik SPK telah diunggah dan terverifikasi sah.
                    </div>
                </div>
            `,
            showCancelButton: true,
            confirmButtonText: '<i class="mdi mdi-download me-1"></i> Unduh Berkas',
            cancelButtonText: 'Tutup',
            confirmButtonColor: '#9a55ff',
            cancelButtonColor: '#6c757d'
        }).then((res) => {
            if (res.isConfirmed) {
                Swal.fire({
                    icon: 'success',
                    title: 'Mengunduh Dokumen...',
                    text: `File SPK ${noSpk}.pdf sedang diunduh.`,
                    timer: 1500,
                    showConfirmButton: false
                });
            }
        });
    }

    // 6. Show Detail Modal
    function showDetailSpk(noSpk, kontraktor, ket) {
        document.getElementById('detail_no_spk').innerText = noSpk;
        document.getElementById('detail_no_val').innerText = noSpk;
        document.getElementById('detail_kontraktor').innerText = kontraktor;
        document.getElementById('detail_keterangan').innerText = ket;

        const modal = new bootstrap.Modal(document.getElementById('modalDetailSpk'));
        modal.show();
    }

    // 7. Edit SPK Dummy
    function editDummySpk(noSpk, kontraktor, ket) {
        Swal.fire({
            title: `Edit SPK: ${noSpk}`,
            html: `
                <div class="text-start mb-3">
                    <label class="form-label small fw-semibold text-dark">Nama Kontraktor</label>
                    <input type="text" id="swal_edit_kontraktor" class="form-control" value="${kontraktor}">
                </div>
                <div class="text-start mb-2">
                    <label class="form-label small fw-semibold text-dark">Keterangan</label>
                    <textarea id="swal_edit_ket" class="form-control" rows="3">${ket}</textarea>
                </div>
            `,
            showCancelButton: true,
            confirmButtonText: 'Simpan Perubahan',
            cancelButtonText: 'Batal',
            confirmButtonColor: '#9a55ff',
            cancelButtonColor: '#6c757d',
            preConfirm: () => {
                const k = document.getElementById('swal_edit_kontraktor').value;
                const kt = document.getElementById('swal_edit_ket').value;
                if (!k) {
                    Swal.showValidationMessage('Nama kontraktor tidak boleh kosong!');
                    return false;
                }
                return { k, kt };
            }
        }).then((res) => {
            if (res.isConfirmed) {
                Swal.fire({
                    icon: 'success',
                    title: 'Perubahan Disimpan!',
                    text: `Data SPK ${noSpk} berhasil diperbarui.`,
                    timer: 1500,
                    showConfirmButton: false
                });
            }
        });
    }

    // 8. Delete SPK Dummy
    function deleteDummySpk(btn, noSpk) {
        Swal.fire({
            title: 'Hapus SPK ini?',
            text: `Apakah Anda yakin ingin menghapus data SPK ${noSpk}? Tindakan ini tidak dapat dibatalkan.`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                const row = btn.closest('.spk-row');
                if (row) {
                    row.remove();
                    const currentTotal = document.querySelectorAll('.spk-row').length;
                    document.getElementById('paginationInfo').innerText = `Menampilkan 1 - ${currentTotal} dari ${currentTotal} data`;
                }

                Swal.fire({
                    icon: 'success',
                    title: 'Terhapus!',
                    text: `SPK ${noSpk} berhasil dihapus.`,
                    timer: 1500,
                    showConfirmButton: false
                });
            }
        });
    }
</script>
@endpush
