@extends('layouts.partial.app') @section('title', 'Properti - All ') @section('content') <!-- KONTEN DASHBOARD -->
<div class="container-fluid p-2 p-sm-3 p-md-4 p-lg-4"> <!-- Header Dashboard -->
    <div class="row mb-3 mb-sm-3 mb-md-4">
        <div class="col-12">
            <h3 class="text-dark fs-4 fs-sm-3 fs-md-3 fs-lg-2">Semua Properti</h3>
        </div>
    </div> <!-- Tabel dengan Filter UI -->
    <div class="row mt-2 mt-sm-2 mt-md-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body pt-2 pt-sm-2 pt-md-3"> <!-- Filter Section - Responsive untuk Mobile & Tablet -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card border-0 mb-2">
                                <div class="card-body py-2 py-sm-2 py-md-3 px-2 px-sm-2 px-md-3">
                                    <h6 class="card-title mb-2 fw-bold small"> <i
                                            class="mdi mdi-filter-outline me-1"></i>Filter Data </h6>
                                    <!-- VERSION 1: FILTER UNTUK MOBILE (di bawah 768px) -->
                                    <div class="d-block d-sm-block d-md-none"> <!-- Search - Full width di mobile -->
                                        <div class="mb-2"> <label
                                                class="form-label text-muted small mb-1">Pencarian</label> <input
                                                type="text" class="form-control form-control-sm"
                                                placeholder="Cari nama properti..."> </div>
                                        <!-- Grid 2 kolom untuk filter lainnya -->
                                        <div class="row g-2">
                                            <div class="col-6"> <label
                                                    class="form-label text-muted small mb-1">Kategori</label> <select
                                                    class="form-control form-control-sm">
                                                    <option value="">Semua</option>
                                                    <option value="Rumah">Rumah</option>
                                                    <option value="Apartemen">Apartemen</option>
                                                    <option value="Ruko">Ruko</option>
                                                    <option value="Tanah">Tanah</option>
                                                </select> </div>
                                            <div class="col-6"> <label
                                                    class="form-label text-muted small mb-1">Lokasi</label> <select
                                                    class="form-control form-control-sm">
                                                    <option value="">Semua</option>
                                                    <option value="Jakarta Selatan">Jaksel</option>
                                                    <option value="Jakarta Pusat">Jakpus</option>
                                                    <option value="Jakarta Barat">Jakbar</option>
                                                    <option value="Jakarta Timur">Jaktim</option>
                                                </select> </div>
                                        </div>
                                        <div class="row g-2 mt-2">
                                            <div class="col-6"> <label
                                                    class="form-label text-muted small mb-1">Tampil</label> <select
                                                    class="form-control form-control-sm">
                                                    <option value="10">10</option>
                                                    <option value="25">25</option>
                                                    <option value="50">50</option>
                                                </select> </div>
                                            <div class="col-6 d-flex align-items-end"> <button type="button"
                                                    class="btn btn-gradient-secondary btn-sm w-100"> <i
                                                        class="mdi mdi-refresh"></i> Reset </button> </div>
                                        </div>
                                    </div> <!-- VERSION 2: FILTER UNTUK TABLET (768px - 991px) -->
                                    <div class="d-none d-md-block d-lg-none">
                                        <div class="row g-2"> <!-- Search - Lebih besar di tablet -->
                                            <div class="col-md-4"> <label
                                                    class="form-label text-muted small mb-1">Pencarian</label> <input
                                                    type="text" class="form-control form-control-sm"
                                                    placeholder="Cari nama properti..."> </div>
                                            <!-- Kategori & Lokasi dalam 2 kolom -->
                                            <div class="col-md-3"> <label
                                                    class="form-label text-muted small mb-1">Kategori</label> <select
                                                    class="form-control form-control-sm">
                                                    <option value="">Semua Kategori</option>
                                                    <option value="Rumah">Rumah</option>
                                                    <option value="Apartemen">Apartemen</option>
                                                    <option value="Ruko">Ruko</option>
                                                    <option value="Tanah">Tanah</option>
                                                </select> </div>
                                            <div class="col-md-3"> <label
                                                    class="form-label text-muted small mb-1">Lokasi</label> <select
                                                    class="form-control form-control-sm">
                                                    <option value="">Semua Lokasi</option>
                                                    <option value="Jakarta Selatan">Jakarta Selatan</option>
                                                    <option value="Jakarta Pusat">Jakarta Pusat</option>
                                                    <option value="Jakarta Barat">Jakarta Barat</option>
                                                    <option value="Jakarta Timur">Jakarta Timur</option>
                                                </select> </div> <!-- Tampil dan Reset dalam 1 baris -->
                                            <div class="col-md-2"> <label
                                                    class="form-label text-muted small mb-1">Tampil</label> <select
                                                    class="form-control form-control-sm">
                                                    <option value="10">10</option>
                                                    <option value="25">25</option>
                                                    <option value="50">50</option>
                                                </select> </div>
                                        </div> <!-- Baris kedua untuk tombol reset (tablet) -->
                                        <div class="row mt-2">
                                            <div class="col-md-12"> <button type="button"
                                                    class="btn btn-gradient-secondary btn-sm"> <i
                                                        class="mdi mdi-refresh me-1"></i> Reset Filter </button> </div>
                                        </div>
                                    </div> <!-- VERSION 3: FILTER UNTUK DESKTOP (di atas 992px) - TETAP SAMA -->
                                    <div class="d-none d-lg-block">
                                        <div class="row g-2">
                                            <div class="col-md-3"> <label
                                                    class="form-label text-muted small mb-1">Pencarian</label> <input
                                                    type="text" class="form-control form-control-sm"
                                                    placeholder="Cari nama properti..."> </div>
                                            <div class="col-md-2"> <label
                                                    class="form-label text-muted small mb-1">Kategori</label> <select
                                                    class="form-control form-control-sm">
                                                    <option value="">Semua Kategori</option>
                                                    <option value="Rumah">Rumah</option>
                                                    <option value="Apartemen">Apartemen</option>
                                                    <option value="Ruko">Ruko</option>
                                                    <option value="Tanah">Tanah</option>
                                                </select> </div>
                                            <div class="col-md-3"> <label
                                                    class="form-label text-muted small mb-1">Lokasi</label> <select
                                                    class="form-control form-control-sm">
                                                    <option value="">Semua Lokasi</option>
                                                    <option value="Jakarta Selatan">Jakarta Selatan</option>
                                                    <option value="Jakarta Pusat">Jakarta Pusat</option>
                                                    <option value="Jakarta Barat">Jakarta Barat</option>
                                                    <option value="Jakarta Timur">Jakarta Timur</option>
                                                    <option value="Tangerang">Tangerang</option>
                                                    <option value="Bekasi">Bekasi</option>
                                                    <option value="Depok">Depok</option>
                                                    <option value="Bogor">Bogor</option>
                                                </select> </div>
                                            <div class="col-md-2"> <label
                                                    class="form-label text-muted small mb-1">Tampil</label> <select
                                                    class="form-control form-control-sm">
                                                    <option value="10">10 Data</option>
                                                    <option value="25">25 Data</option>
                                                    <option value="50">50 Data</option>
                                                    <option value="100">100 Data</option>
                                                </select> </div>
                                            <div class="col-md-2 d-flex align-items-end"> <button type="button"
                                                    class="btn btn-gradient-secondary btn-sm w-100"> <i
                                                        class="mdi mdi-refresh me-1"></i> Reset </button> </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- Tabel Data - Responsive -->
                    <div class="table-responsive">
                        <table class="table table-hover table-sm">
                            <thead>
                                <tr>
                                    <th class="text-nowrap">No</th>
                                    <th class="text-nowrap">Nama Properti</th>
                                    <th class="text-nowrap">Kategori</th>
                                    <!-- Sembunyikan Lokasi di mobile, tampilkan di tablet/desktop -->
                                    <th class="text-nowrap d-none d-md-table-cell">Lokasi</th>
                                    <th class="text-nowrap">Harga Beli </th>
                                    <th class="text-nowrap">Status Legalitas</th>
                                    <th class="text-nowrap">Status Pembangunan</th>
                                    <th class="text-nowrap">Dokumen</th>
                                    <th class="text-nowrap">Aksi</th>

                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($landBanks as $index => $item)
                                    <tr>
                                        <td>{{ $landBanks->firstItem() + $index }}</td>
                                        <td>
                                            <div class="d-flex align-items-center"> <span class="small">
                                                    {{ $item->name }} </span> </div>
                                        </td>
                                        <td> <span class="small"> {{ $item->zoning }} </span> </td>
                                        <td class="d-none d-md-table-cell"> <span class="small"> {{ $item->address }}
                                            </span> </td>
                                        <td> <span class="small text-nowrap"> Rp
                                                {{ number_format($item->acquisition_price, 0, ',', '.') }} </span> </td>
                                        <td>
                                            @if ($item->legal_status== 'terverifikasi')
                                                <label class="badge badge-gradient-success badge-sm"> Terverifikasi </label>
                                            @elseif ($item->legal_status == 'Pending')
                                                <label class="badge badge-gradient-warning badge-sm"> Pending </label>
                                            @else
                                                <label class="badge badge-gradient-danger badge-sm"> Revisi </label>
                                            @endif
                                        </td>
                                        <td>
                                             @if ($item->development_status== 'Selesai')
                                                <label class="badge badge-gradient-success badge-sm"> Selesai </label>
                                            @elseif ($item->development_status == 'progress')
                                                <label class="badge badge-gradient-warning badge-sm"> On Progress </label>
                                            @else
                                                <label class="badge badge-gradient-danger badge-sm"> Belum </label>
                                            @endif
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-gradient-info"
                                                data-bs-toggle="modal"
                                                data-bs-target="#documentModal{{ $item->id }}">
                                                <i class="mdi mdi-file-document"></i>
                                                ({{ $item->documents->count() }})
                                            </button>
                                            <div class="modal fade" id="documentModal{{ $item->id }}"
                                                tabindex="-1" aria-labelledby="documentModalLabel{{ $item->id }}"
                                                aria-hidden="true">

                                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                                    <div class="modal-content">

                                                        <!-- Header -->
                                                        <div class="modal-header">
                                                            <h5 class="modal-title"
                                                                id="documentModalLabel{{ $item->id }}">
                                                                Dokumen - {{ $item->name }}
                                                            </h5>

                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close">
                                                            </button>
                                                        </div>

                                                        <!-- Body -->
                                                        <div class="modal-body">

                                                            @if ($item->documents->count() > 0)
                                                                <div class="table-responsive">
                                                                    <table
                                                                        class="table table-bordered table-sm align-middle">
                                                                        <thead class="table-light">
                                                                            <tr>
                                                                                <th>Nomer Dokumen</th>
                                                                                <th>Tipe</th>
                                                                                <th>Status</th>
                                                                                <th width="100">Aksi</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            @foreach ($item->documents as $doc)
                                                                                <tr>
                                                                                    <td>
                                                                                        {{ $doc->document_number }}
                                                                                        --
                                                                                        {{ $doc->landbank->ownership_status ?? '-' }}
                                                                                        /
                                                                                        {{ $doc->landbank->certificate_owner ?? '-' }}
                                                                                    </td>

                                                                                    <td>{{ $doc->type }}</td>

                                                                                    <td>
                                                                                        @if ($doc->status == 'pending')
                                                                                            <span
                                                                                                class="badge bg-warning text-dark">
                                                                                                Pending
                                                                                            </span>
                                                                                        @elseif($doc->status == 'ditolak')
                                                                                            <span
                                                                                                class="badge bg-danger">
                                                                                                Ditolak
                                                                                            </span>
                                                                                        @elseif($doc->status == 'terverifikasi')
                                                                                            <span
                                                                                                class="badge bg-success">
                                                                                                Terverifikasi
                                                                                            </span>
                                                                                        @else
                                                                                            <span
                                                                                                class="badge bg-secondary">
                                                                                                {{ ucfirst($doc->status) }}
                                                                                            </span>
                                                                                        @endif
                                                                                    </td>

                                                                                    <td>
                                                                                        <a href="{{ asset('storage/' . $doc->file_path) }}"
                                                                                            target="_blank"
                                                                                            class="btn btn-sm btn-primary">
                                                                                            Lihat
                                                                                        </a>
                                                                                    </td>
                                                                                </tr>

                                                                                @if ($doc->status === 'ditolak' && !empty($doc->catatan_admin))
                                                                                    <tr>
                                                                                        <td colspan="4">
                                                                                            <div
                                                                                                class="border-start border-4 border-danger ps-3 py-2 bg-light text-danger small">
                                                                                                <strong>Alasan
                                                                                                    Ditolak:</strong>
                                                                                                {{ $doc->catatan_admin }}
                                                                                            </div>
                                                                                        </td>
                                                                                    </tr>
                                                                                @endif
                                                                            @endforeach
                                                                        </tbody>


                                                                    </table>
                                                                </div>
                                                            @else
                                                                <div class="text-center text-muted py-3">
                                                                    Tidak ada dokumen.
                                                                </div>
                                                            @endif

                                                        </div>

                                                        <!-- Footer -->
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">
                                                                Tutup
                                                            </button>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>


                                        </td>
                                        <td>

    @if($doc->status == 'pending')
       <a href="{{ route('properti.verifikasi', $doc->landbank->id) }}"
   class="btn btn-sm btn-success">
    Verifikasi Legal
</a>

    @elseif($doc->status == 'terverifikasi')
        <span class="badge bg-success">
            Sudah Diverifikasi
        </span>

    @elseif($doc->status == 'ditolak')
        <span class="badge bg-danger">
            Ditolak
        </span>
    @endif

</td>



                                </tr> @empty <tr>
                                        <td colspan="9" class="text-center text-muted"> Data belum tersedia </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                    </div> <!-- Pagination Sederhana - Responsive -->
                    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mt-3">
                        <div class="text-muted small mb-2 mb-sm-0"> <span class="small text-muted"> Menampilkan
                                {{ $landBanks->firstItem() }} - {{ $landBanks->lastItem() }} dari
                                {{ $landBanks->total() }} data </span> </div>
                        <div class="d-flex justify-content-center mt-3"> {{ $landBanks->links() }} </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- AKHIR KONTEN DASHBOARD --> @endsection @push('styles')
@endpush @push('scripts')
<script></script>
@endpush
