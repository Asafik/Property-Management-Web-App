@extends('layouts.partial.app')

@section('title', 'Master Data PT - Property Management App')

@section('content')
<link rel="stylesheet" href="{{ asset('assets/css/pt/pt.css') }}">

    <div class="container-fluid p-2 p-sm-3 p-md-4">
        <!-- Header Dashboard -->
        <div class="row mb-3 mb-sm-3 mb-md-4">
            <div class="col-12">
                <div class="card shadow-sm border-0">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="text-dark mb-1">
                                <i class="mdi mdi-domain me-2" style="color: #9a55ff;"></i>
                                Master Data PT
                            </h3>
                            <p class="text-muted mb-0">
                                <i class="mdi mdi-information-outline me-1"></i>
                                Kelola data perusahaan (PT) untuk keperluan administrasi
                            </p>
                        </div>
                        <div class="d-none d-sm-block">
                            <i class="mdi mdi-domain" style="font-size: 2.5rem; color: #9a55ff; opacity: 0.2;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabel Data PT -->
        <div class="row mt-2 mt-sm-2 mt-md-3">
            <div class="col-12">
                <div class="card">
                    <div
                        class="card-header bg-white d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
                        <h5 class="card-title mb-2 mb-md-0">
                            <i class="mdi mdi-format-list-bulleted me-2 text-primary"></i>
                            Daftar Perusahaan (PT)
                        </h5>
                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-sm btn-gradient-primary" data-bs-toggle="modal"
                                data-bs-target="#modalTambahPT">
                                <i class="mdi mdi-plus me-1"></i><span class="d-none d-sm-inline">Tambah PT</span>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Filter Section -->
                        <div class="filter-card">
                            <div class="card-body">
                                <h6 class="card-title mb-3" style="font-size: 1rem;">
                                    <i class="mdi mdi-filter-outline me-1"></i>Filter Data
                                </h6>

                                <!-- FILTER UNTUK MOBILE -->
                                <div class="d-block d-md-none">
                                    <div class="mb-3">
                                        <label class="form-label">
                                            <i class="mdi mdi-magnify me-1"></i>Cari PT
                                        </label>
                                        <input type="text" class="form-control" placeholder="Cari nama PT...">
                                    </div>

                                    <div class="row g-2">
                                        <div class="col-6">
                                            <label class="form-label">
                                                <i class="mdi mdi-counter me-1"></i>Tampil
                                            </label>
                                            <select class="form-control">
                                                <option value="10">10</option>
                                                <option value="25">25</option>
                                                <option value="50">50</option>
                                                <option value="100">100</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row g-2 mt-2">
                                        <div class="col-6">
                                            <button type="button" class="btn btn-gradient-primary w-100">
                                                <i class="mdi mdi-filter me-1"></i> Filter
                                            </button>
                                        </div>
                                        <div class="col-6">
                                            <button type="button" class="btn btn-gradient-secondary w-100">
                                                <i class="mdi mdi-refresh me-1"></i> Reset
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <!-- FILTER UNTUK TABLET & DESKTOP -->
                                <div class="d-none d-md-block">
                                    <div class="row g-2 align-items-end">
                                        <div class="col-md-5">
                                            <label class="form-label">
                                                <i class="mdi mdi-magnify me-1"></i>Cari PT
                                            </label>
                                            <input type="text" class="form-control" placeholder="Cari nama PT...">
                                        </div>
                                        <div class="col-md-2">
                                            <label class="form-label">
                                                <i class="mdi mdi-counter me-1"></i>Tampil
                                            </label>
                                            <select class="form-control">
                                                <option value="10">10</option>
                                                <option value="25">25</option>
                                                <option value="50">50</option>
                                                <option value="100">100</option>
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <button type="button" class="btn btn-gradient-primary w-100">
                                                <i class="mdi mdi-filter me-1"></i> Filter
                                            </button>
                                        </div>
                                        <div class="col-md-2">
                                            <button type="button" class="btn btn-gradient-secondary w-100 btn-icon-only"
                                                title="Reset">
                                                <i class="mdi mdi-refresh"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Tabel PT -->
                        <div class="table-responsive">

                            <table class="table table-hover" id="tablePT" style="width:100%">
                                <thead>
                                    <tr>
                                        <th class="text-center"><i class="mdi mdi-counter me-1"></i>No</th>
                                        <th><i class="mdi mdi-domain me-1"></i>Nama PT</th>
                                        <th><i class="mdi mdi-map-marker me-1"></i>Alamat</th>
                                        <th><i class="mdi mdi-phone me-1"></i>No. HP</th>
                                        <th class="text=center"><i class="mdi mdi-file-document me-1"></i>Jumlah Project
                                        </th>
                                        <th class="text-center"><i class="mdi mdi-cog me-1"></i>Aksi</th>
                                    </tr>
                                </thead>


                                <tbody>
                                    @foreach ($companies as $item)
                                        <tr>
                                            <td class="text-center fw-bold">{{ $loop->iteration }}</td>

                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <i class="mdi mdi-domain text-primary me-2"></i>
                                                    <span class="fw-bold">{{ $item->name }}</span>
                                                </div>
                                            </td>

                                            <td>{{ $item->address }}</td>
                                            <td>{{ $item->phone }}</td>


                                            <td class="text-center">
                                                <span class="badge bg-success project-badge" data-id="{{ $item->id }}"
                                                    style="cursor:pointer;">
                                                    {{ $item->land_banks_count }} Project
                                                </span>
                                            </td>

                                            <td class="text-center">
                                                <div class="d-flex justify-content-center gap-1">
                                                    <button type="button" class="btn btn-outline-warning btn-sm btnEdit"
                                                        title="Edit" data-bs-toggle="modal"
                                                        data-bs-target="#modalEditPT" data-id="{{ $item->id }}"
                                                        data-name="{{ $item->name }}"
                                                        data-address="{{ $item->address }}"
                                                        data-phone="{{ $item->phone }}">
                                                        <i class="mdi mdi-pencil"></i>
                                                    </button>
                                                    <form action="{{ route('company-profile.destroy', $item->id) }}"
                                                        method="POST" class="formDelete">
                                                        @csrf
                                                        @method('DELETE')

                                                        <button type="button"
                                                            class="btn btn-outline-danger btn-sm btnDelete"
                                                            data-name="{{ $item->name }}">
                                                            <i class="mdi mdi-delete"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="modal fade" id="modalProjects" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="mdi mdi-domain"></i> Daftar Project
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <div id="projectContent">
                    <div class="text-center py-4">
                        <div class="spinner-border text-primary"></div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
                        </div>

                        <!-- Pagination UI -->
                        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mt-3">
                            <div class="pagination-info mb-2 mb-sm-0">
                                <i class="mdi mdi-information-outline me-1"></i>
                                Menampilkan 1 - 5 dari 5 data
                            </div>
                            <nav aria-label="Page navigation">
                                <ul class="pagination pagination-sm flex-wrap justify-content-center mb-0"
                                    style="gap: 2px;">
                                    <li class="page-item disabled">
                                        <a class="page-link" href="#" tabindex="-1" aria-label="Previous">
                                            <i class="mdi mdi-chevron-left"></i>
                                        </a>
                                    </li>
                                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item disabled">
                                        <a class="page-link" href="#" aria-label="Next">
                                            <i class="mdi mdi-chevron-right"></i>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tombol Aksi Bawah -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="d-flex flex-column flex-sm-row justify-content-start">
                            <a href="{{ route('dashboard') }}" class="btn btn-gradient-secondary">
                                <i class="mdi mdi-arrow-left me-1"></i>Kembali ke Dashboard
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL TAMBAH PT -->
    <div class="modal fade" id="modalTambahPT" tabindex="-1" aria-labelledby="modalTambahPTLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTambahPTLabel">
                        <i class="mdi mdi-domain-plus me-2" style="color: #9a55ff;"></i>
                        Tambah PT Baru
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formTambahPT" action="{{ route('company-profile.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="modal-form-group">
                                    <label>
                                        <i class="mdi mdi-domain me-1"></i>Nama PT
                                    </label>
                                    <input type="text" name="name" class="modal-form-control"
                                        placeholder="Contoh: PT Properti Management">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="modal-form-group">
                                    <label>
                                        <i class="mdi mdi-map-marker me-1"></i>Alamat
                                    </label>
                                    <textarea name="address" class="modal-form-control" rows="3" placeholder="Alamat lengkap PT..."></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="modal-form-group">
                                    <label>
                                        <i class="mdi mdi-phone me-1"></i>No. HP
                                    </label>
                                    <input type="text" name="phone" class="modal-form-control"
                                        placeholder="Contoh: 081234567890">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-gradient-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" form="formTambahPT" class="btn btn-gradient-primary">Simpan</button>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL EDIT PT -->
    <div class="modal fade" id="modalEditPT" tabindex="-1" aria-labelledby="modalEditPTLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditPTLabel">
                        <i class="mdi mdi-pencil me-2" style="color: #9a55ff;"></i>
                        Edit PT
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <form id="formEditPT" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-12">
                                <div class="modal-form-group">
                                    <label>Nama PT</label>
                                    <input type="text" name="name" id="editName" class="modal-form-control">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="modal-form-group">
                                    <label>Alamat</label>
                                    <textarea name="address" id="editAddress" class="modal-form-control" rows="3"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="modal-form-group">
                                    <label>No. HP</label>
                                    <input type="text" name="phone" id="editPhone" class="modal-form-control">
                                </div>
                            </div>
                        </div>

                    </form>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-gradient-secondary" data-bs-dismiss="modal">Batal</button>

                    <button type="submit" form="formEditPT" class="btn btn-gradient-primary">
                        Update
                    </button>
                </div>

            </div>
        </div>
    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                document.querySelectorAll('.btnDelete').forEach(button => {
                    button.addEventListener('click', function() {
                        let form = this.closest('.formDelete');
                        let companyName = this.getAttribute('data-name');

                        Swal.fire({
                            title: 'Yakin mau hapus?',
                            text: " " + companyName + " akan dihapus!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#d33',
                            cancelButtonColor: '#6c757d',
                            confirmButtonText: 'Ya, hapus!',
                            cancelButtonText: 'Batal'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                form.submit();
                            }
                        });
                    });
                });
            });
        </script>
        <script>
            $(document).ready(function() {
                // Inisialisasi DataTables - hanya untuk sorting
                let table = $('#tablePT').DataTable({
                    responsive: true,
                    paging: false,
                    info: false,
                    searching: false,
                    lengthChange: false,
                    ordering: true,
                    language: {
                        emptyTable: "Data PT belum tersedia",
                        zeroRecords: "Data tidak ditemukan",
                    },
                    columnDefs: [{
                            orderable: false,
                            targets: [4]
                        } // Non-aktifkan sorting untuk kolom Aksi
                    ]
                });
            });
        </script>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const editButtons = document.querySelectorAll('.btnEdit');
                editButtons.forEach(button => {
                    button.addEventListener('click', function() {
                        let id = this.getAttribute('data-id');
                        let name = this.getAttribute('data-name');
                        let address = this.getAttribute('data-address');
                        let phone = this.getAttribute('data-phone');

                        document.getElementById('editName').value = name;
                        document.getElementById('editAddress').value = address;
                        document.getElementById('editPhone').value = phone;

                        // Set action form dynamically
                        document.getElementById('formEditPT').action =
                            `/dashboard-pt/${id}`;
                    });
                });
            });
        </script>

        @if (session('success'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: "{{ session('success') }}",
                    timer: 2000,
                    showConfirmButton: false
                });
            </script>
        @endif

        @if (session('error'))
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: "{{ session('error') }}",
                    timer: 2000,
                    showConfirmButton: false
                });
            </script>
        @endif

        <script>
            $(document).on('click', '.project-badge', function() {
                let companyId = $(this).data('id');

                // Tampilkan modal dan spinner
                $('#modalProjects').modal('show');
                $('#projectContent').html(`
                    <div class="text-center py-4">
                        <div class="spinner-border text-primary" role="status"></div>
                    </div>
                `);

                // Fungsi untuk escape HTML agar aman dari XSS
                function escapeHtml(text) {
                    return $('<div>').text(text).html();
                }

                // Ambil data project
                $.get('/company/' + companyId + '/projects', function(response) {
                    let html = '';

                    // Tampilkan nama PT
                    if(response.name) {
                        html += `<h5 class="mb-3">${escapeHtml(response.name)}</h5>`;
                    }

                    if (!response.land_banks || response.land_banks.length === 0) {
                        html += `<div class="alert alert-warning">Tidak ada project</div>`;
                    } else {
                        response.land_banks.forEach(function(project) {
                            html += `
                                <div class="card mb-3">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <strong>${escapeHtml(project.name)}</strong>
                                        <span class="badge bg-info">${project.units.length} Unit</span>
                                    </div>
                                    <div class="card-body">
                            `;

                            if (project.units && project.units.length > 0) {
                                html += `<ul class="list-group">`;
                                project.units.forEach(function(unit) {
                                    html += `
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <div>
                                                <strong>${escapeHtml(unit.unit_name)}</strong><br>
                                                <small class="text-muted">
                                                    Code: ${escapeHtml(unit.unit_code)} |
                                                    Type: ${escapeHtml(unit.type)} |
                                                    Progress: ${escapeHtml(unit.construction_progress)}
                                                </small>
                                            </div>
                                        </li>
                                    `;
                                });
                                html += `</ul>`;
                            } else {
                                html += `<small class="text-muted">Belum ada unit</small>`;
                            }

                            html += `</div></div>`;
                        });
                    }

                    $('#projectContent').html(html);
                })
                .fail(function() {
                    $('#projectContent').html('<div class="alert alert-danger">Gagal memuat data project.</div>');
                });
            });
        </script>
    @endpush
@endsection
