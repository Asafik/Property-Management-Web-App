@extends('layouts.partial.app')

@section('title', 'Deadline RAB per Unit - Property Management App')

@section('content')

<div class="container-fluid px-1 px-sm-2 px-md-3 py-2 py-md-3">

    <!-- Header Card Banner -->
    <div class="row mb-3 mb-md-4">
        <div class="col-12">
            <div class="card shadow-sm border-0 header-card">
                <div class="card-body p-4 p-md-4 py-4 py-md-4 d-flex justify-content-between align-items-center" style="min-height: 105px;">
                    <div>
                        <h3 class="text-dark mb-1 fw-bold" style="font-size: 1.35rem;">
                            Deadline RAB per Unit
                        </h3>
                        <p class="text-muted mb-0" style="font-size: 0.9rem;">
                            Monitor deadline setiap tahapan pekerjaan dan estimasi target penyelesaian unit
                        </p>
                    </div>
                    <div class="d-none d-sm-block pe-2">
                        <i class="mdi mdi-clock-alert-outline" style="font-size: 3rem; color: #9a55ff; opacity: 0.25;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-2 mt-sm-2 mt-md-3">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white d-flex flex-wrap flex-md-row justify-content-between align-items-center gap-2">
                    <h5 class="card-title mb-0">
                        <i class="mdi mdi-format-list-bulleted me-2"></i>Daftar Deadline Unit Properti
                    </h5>
                    <!-- Status summary pill badges -->
                    <div class="d-flex flex-wrap gap-1">
                        <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 px-2 py-1" style="font-size: 0.75rem;">
                            <i class="mdi mdi-check-circle me-1"></i>Selesai: 2
                        </span>
                        <span class="badge bg-info bg-opacity-10 text-info border border-info border-opacity-25 px-2 py-1" style="font-size: 0.75rem;">
                            <i class="mdi mdi-progress-check me-1"></i>On Track: 3
                        </span>
                        <span class="badge bg-warning bg-opacity-10 text-warning border border-warning border-opacity-25 px-2 py-1" style="font-size: 0.75rem; color: #b78103 !important;">
                            <i class="mdi mdi-clock-alert me-1"></i>Mendekati Deadline: 2
                        </span>
                        <span class="badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-25 px-2 py-1" style="font-size: 0.75rem;">
                            <i class="mdi mdi-alert-circle me-1"></i>Terlambat: 1
                        </span>
                    </div>
                </div>

                <div class="card-body">
                    <!-- Filter Section -->
                    <div class="filter-card mb-3">
                        <!-- Desktop Version -->
                        <div class="filter-row-desktop d-none d-md-block">
                            <form id="filterForm" onsubmit="return false;">
                                <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 w-100">
                                    <div class="d-flex flex-wrap align-items-center gap-2 flex-grow-1">
                                        <!-- Search Input -->
                                        <div style="min-width: 240px; max-width: 320px; flex: 1;">
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="search" id="searchInput"
                                                    placeholder="Cari unit atau blok..."
                                                    style="border-top-right-radius: 0 !important; border-bottom-right-radius: 0 !important; border-right: none;">
                                                <button class="btn btn-gradient-primary d-flex align-items-center justify-content-center px-3" 
                                                    type="submit" title="Cari"
                                                    style="border-top-left-radius: 0 !important; border-bottom-left-radius: 0 !important; border-top-right-radius: 4px !important; border-bottom-right-radius: 4px !important; height: 38px; box-shadow: none;">
                                                    <i class="mdi mdi-magnify" style="font-size: 1.15rem; color: #ffffff;"></i>
                                                </button>
                                            </div>
                                        </div>

                                        <!-- Cluster Filter -->
                                        <div style="width: 170px;">
                                            <select class="form-control" name="cluster" id="clusterSelect">
                                                <option value="">Semua Cluster</option>
                                                <option value="mawar">Cluster Mawar</option>
                                                <option value="melati">Cluster Melati</option>
                                                <option value="kenanga">Cluster Kenanga</option>
                                                <option value="cempaka">Cluster Cempaka</option>
                                                <option value="anggrek">Cluster Anggrek</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Right Limit & Buttons -->
                                    <div class="d-flex align-items-center gap-2 ms-auto">
                                        <div style="width: 110px;">
                                            <select class="form-control" name="per_page" id="perPageSelect">
                                                <option value="10">10 data</option>
                                                <option value="15">15 data</option>
                                                <option value="25">25 data</option>
                                                <option value="50">50 data</option>
                                            </select>
                                        </div>

                                        <button type="submit" class="btn btn-gradient-primary btn-icon-only" title="Filter">
                                            <i class="mdi mdi-filter"></i>
                                        </button>
                                        <button type="button" class="btn btn-gradient-secondary btn-icon-only" title="Reset" onclick="resetFilter()">
                                            <i class="mdi mdi-refresh"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <!-- Mobile Version -->
                        <div class="filter-row-mobile d-block d-md-none">
                            <form onsubmit="return false;">
                                <div class="row g-2">
                                    <div class="col-12 mb-2">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="search" id="searchInputMobile"
                                                placeholder="Cari unit atau blok..."
                                                style="border-top-right-radius: 0 !important; border-bottom-right-radius: 0 !important; border-right: none;">
                                            <button class="btn btn-gradient-primary d-flex align-items-center justify-content-center px-3" 
                                                type="submit" title="Cari"
                                                style="border-top-left-radius: 0 !important; border-bottom-left-radius: 0 !important; border-top-right-radius: 4px !important; border-bottom-right-radius: 4px !important; height: 38px; box-shadow: none;">
                                                <i class="mdi mdi-magnify" style="font-size: 1.15rem; color: #ffffff;"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="col-12 mb-2">
                                        <select class="form-control" name="cluster" id="clusterSelectMobile">
                                            <option value="">Semua Cluster</option>
                                            <option value="mawar">Cluster Mawar</option>
                                            <option value="melati">Cluster Melati</option>
                                            <option value="kenanga">Cluster Kenanga</option>
                                            <option value="cempaka">Cluster Cempaka</option>
                                            <option value="anggrek">Cluster Anggrek</option>
                                        </select>
                                    </div>

                                    <div class="col-12 mb-2">
                                        <select class="form-control" name="per_page">
                                            <option value="10">10 data</option>
                                            <option value="15">15 data</option>
                                            <option value="25">25 data</option>
                                            <option value="50">50 data</option>
                                        </select>
                                    </div>

                                    <div class="col-6">
                                        <button type="submit" class="btn btn-gradient-primary w-100 d-flex align-items-center justify-content-center gap-1">
                                            <i class="mdi mdi-filter"></i> Filter
                                        </button>
                                    </div>
                                    <div class="col-6">
                                        <button type="button" class="btn btn-gradient-secondary w-100 d-flex align-items-center justify-content-center gap-1" onclick="resetFilter()">
                                            <i class="mdi mdi-refresh"></i> Reset
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Tabel Data Unit -->
                    <div class="table-responsive">
                        <table class="table table-hover align-middle" id="tableUnit">
                            <thead>
                                <tr>
                                    <th class="text-center" width="4%">No</th>
                                    <th width="16%">Unit & Cluster</th>
                                    <th width="16%">Progress Keseluruhan</th>
                                    <th width="12%">Target Mulai</th>
                                    <th width="12%">Target Selesai</th>
                                    <th width="8%">Durasi</th>
                                    <th width="10%">Sisa Waktu</th>
                                    <th width="12%">Status</th>
                                    <th class="text-center" width="10%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Unit 1 -->
                                <tr>
                                    <td class="text-center fw-bold">1</td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <span class="badge bg-light text-dark fw-bold border px-2 py-1 font-monospace" style="font-size: 0.82rem;">Blok A.1</span>
                                            <span class="badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-25 px-2 py-1" style="font-size: 0.72rem;">Cluster Mawar</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="progress mb-1" style="height: 6px; border-radius: 4px;">
                                            <div class="progress-bar bg-success" style="width: 92%"></div>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center text-muted" style="font-size: 0.75rem;">
                                            <span class="fw-bold text-success">92%</span>
                                            <span>11/12 item</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="d-inline-flex align-items-center gap-1 text-muted" style="font-size: 0.8rem;">
                                            <i class="mdi mdi-calendar-start text-primary"></i>01 Mar 2024
                                        </span>
                                    </td>
                                    <td>
                                        <span class="d-inline-flex align-items-center gap-1 text-muted" style="font-size: 0.8rem;">
                                            <i class="mdi mdi-calendar-end text-primary"></i>20 Jun 2024
                                        </span>
                                    </td>
                                    <td><span class="fw-medium">112 hari</span></td>
                                    <td><span class="badge bg-light text-primary border fw-bold px-2 py-1">H-15</span></td>
                                    <td>
                                        <span class="status-badge" style="background: rgba(23, 162, 184, 0.12); color: #17a2b8; border-color: rgba(23, 162, 184, 0.25);">
                                            <i class="mdi mdi-progress-check"></i> On Track
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-inline-flex align-items-center gap-1">
                                            <button type="button" class="btn-action edit" title="Edit Target Deadline" onclick="openEditDeadline('A.1', 'Cluster Mawar', '2024-03-01', '2024-06-20')">
                                                <i class="mdi mdi-pencil"></i>
                                            </button>
                                            <button type="button" class="btn-action fase2" title="Lihat Detail Pekerjaan" onclick="openDetailUnit('A.1', 'Cluster Mawar')">
                                                <i class="mdi mdi-eye"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Unit 2 -->
                                <tr>
                                    <td class="text-center fw-bold">2</td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <span class="badge bg-light text-dark fw-bold border px-2 py-1 font-monospace" style="font-size: 0.82rem;">Blok B.2</span>
                                            <span class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25 px-2 py-1" style="font-size: 0.72rem;">Cluster Melati</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="progress mb-1" style="height: 6px; border-radius: 4px;">
                                            <div class="progress-bar bg-success" style="width: 100%"></div>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center text-muted" style="font-size: 0.75rem;">
                                            <span class="fw-bold text-success">100%</span>
                                            <span>12/12 item</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="d-inline-flex align-items-center gap-1 text-muted" style="font-size: 0.8rem;">
                                            <i class="mdi mdi-calendar-start text-primary"></i>01 Mar 2024
                                        </span>
                                    </td>
                                    <td>
                                        <span class="d-inline-flex align-items-center gap-1 text-muted" style="font-size: 0.8rem;">
                                            <i class="mdi mdi-calendar-end text-primary"></i>15 Mei 2024
                                        </span>
                                    </td>
                                    <td><span class="fw-medium">76 hari</span></td>
                                    <td><span class="text-success fw-bold">Selesai</span></td>
                                    <td>
                                        <span class="status-badge aktif">
                                            <i class="mdi mdi-check-circle"></i> Selesai
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-inline-flex align-items-center gap-1">
                                            <button type="button" class="btn-action edit" title="Edit Target Deadline" onclick="openEditDeadline('B.2', 'Cluster Melati', '2024-03-01', '2024-05-15')">
                                                <i class="mdi mdi-pencil"></i>
                                            </button>
                                            <button type="button" class="btn-action fase2" title="Lihat Detail Pekerjaan" onclick="openDetailUnit('B.2', 'Cluster Melati')">
                                                <i class="mdi mdi-eye"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Unit 3 -->
                                <tr>
                                    <td class="text-center fw-bold">3</td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <span class="badge bg-light text-dark fw-bold border px-2 py-1 font-monospace" style="font-size: 0.82rem;">Blok C.1</span>
                                            <span class="badge bg-info bg-opacity-10 text-info border border-info border-opacity-25 px-2 py-1" style="font-size: 0.72rem;">Cluster Kenanga</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="progress mb-1" style="height: 6px; border-radius: 4px;">
                                            <div class="progress-bar bg-warning" style="width: 65%"></div>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center text-muted" style="font-size: 0.75rem;">
                                            <span class="fw-bold text-warning">65%</span>
                                            <span>8/12 item</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="d-inline-flex align-items-center gap-1 text-muted" style="font-size: 0.8rem;">
                                            <i class="mdi mdi-calendar-start text-primary"></i>15 Mar 2024
                                        </span>
                                    </td>
                                    <td>
                                        <span class="d-inline-flex align-items-center gap-1 text-muted" style="font-size: 0.8rem;">
                                            <i class="mdi mdi-calendar-end text-primary"></i>30 Jun 2024
                                        </span>
                                    </td>
                                    <td><span class="fw-medium">108 hari</span></td>
                                    <td><span class="badge bg-warning bg-opacity-25 text-dark fw-bold border border-warning px-2 py-1">H-5</span></td>
                                    <td>
                                        <span class="status-badge" style="background: rgba(255, 193, 7, 0.15); color: #b78103; border-color: rgba(255, 193, 7, 0.3);">
                                            <i class="mdi mdi-clock-alert"></i> Mendekati Deadline
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-inline-flex align-items-center gap-1">
                                            <button type="button" class="btn-action edit" title="Edit Target Deadline" onclick="openEditDeadline('C.1', 'Cluster Kenanga', '2024-03-15', '2024-06-30')">
                                                <i class="mdi mdi-pencil"></i>
                                            </button>
                                            <button type="button" class="btn-action fase2" title="Lihat Detail Pekerjaan" onclick="openDetailUnit('C.1', 'Cluster Kenanga')">
                                                <i class="mdi mdi-eye"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Unit 4 -->
                                <tr>
                                    <td class="text-center fw-bold">4</td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <span class="badge bg-light text-dark fw-bold border px-2 py-1 font-monospace" style="font-size: 0.82rem;">Blok D.2</span>
                                            <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 px-2 py-1" style="font-size: 0.72rem;">Cluster Cempaka</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="progress mb-1" style="height: 6px; border-radius: 4px;">
                                            <div class="progress-bar bg-primary" style="width: 45%"></div>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center text-muted" style="font-size: 0.75rem;">
                                            <span class="fw-bold text-primary">45%</span>
                                            <span>5/12 item</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="d-inline-flex align-items-center gap-1 text-muted" style="font-size: 0.8rem;">
                                            <i class="mdi mdi-calendar-start text-primary"></i>01 Apr 2024
                                        </span>
                                    </td>
                                    <td>
                                        <span class="d-inline-flex align-items-center gap-1 text-muted" style="font-size: 0.8rem;">
                                            <i class="mdi mdi-calendar-end text-primary"></i>15 Jul 2024
                                        </span>
                                    </td>
                                    <td><span class="fw-medium">106 hari</span></td>
                                    <td><span class="badge bg-light text-primary border fw-bold px-2 py-1">H-20</span></td>
                                    <td>
                                        <span class="status-badge" style="background: rgba(23, 162, 184, 0.12); color: #17a2b8; border-color: rgba(23, 162, 184, 0.25);">
                                            <i class="mdi mdi-progress-check"></i> On Track
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-inline-flex align-items-center gap-1">
                                            <button type="button" class="btn-action edit" title="Edit Target Deadline" onclick="openEditDeadline('D.2', 'Cluster Cempaka', '2024-04-01', '2024-07-15')">
                                                <i class="mdi mdi-pencil"></i>
                                            </button>
                                            <button type="button" class="btn-action fase2" title="Lihat Detail Pekerjaan" onclick="openDetailUnit('D.2', 'Cluster Cempaka')">
                                                <i class="mdi mdi-eye"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Unit 5 -->
                                <tr>
                                    <td class="text-center fw-bold">5</td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <span class="badge bg-light text-dark fw-bold border px-2 py-1 font-monospace" style="font-size: 0.82rem;">Blok E.1</span>
                                            <span class="badge bg-warning bg-opacity-10 text-dark border border-warning border-opacity-25 px-2 py-1" style="font-size: 0.72rem;">Cluster Anggrek</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="progress mb-1" style="height: 6px; border-radius: 4px;">
                                            <div class="progress-bar bg-danger" style="width: 30%"></div>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center text-muted" style="font-size: 0.75rem;">
                                            <span class="fw-bold text-danger">30%</span>
                                            <span>4/12 item</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="d-inline-flex align-items-center gap-1 text-muted" style="font-size: 0.8rem;">
                                            <i class="mdi mdi-calendar-start text-primary"></i>01 Feb 2024
                                        </span>
                                    </td>
                                    <td>
                                        <span class="d-inline-flex align-items-center gap-1 text-muted" style="font-size: 0.8rem;">
                                            <i class="mdi mdi-calendar-end text-primary"></i>30 Mei 2024
                                        </span>
                                    </td>
                                    <td><span class="fw-medium">120 hari</span></td>
                                    <td><span class="badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-25 fw-bold px-2 py-1">Lewat 5 hari</span></td>
                                    <td>
                                        <span class="status-badge" style="background: rgba(220, 53, 69, 0.12); color: #dc3545; border-color: rgba(220, 53, 69, 0.25);">
                                            <i class="mdi mdi-alert-circle"></i> Terlambat
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-inline-flex align-items-center gap-1">
                                            <button type="button" class="btn-action edit" title="Edit Target Deadline" onclick="openEditDeadline('E.1', 'Cluster Anggrek', '2024-02-01', '2024-05-30')">
                                                <i class="mdi mdi-pencil"></i>
                                            </button>
                                            <button type="button" class="btn-action fase2" title="Lihat Detail Pekerjaan" onclick="openDetailUnit('E.1', 'Cluster Anggrek')">
                                                <i class="mdi mdi-eye"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mt-4">
                        <div class="pagination-info mb-2 mb-sm-0 text-muted" style="font-size: 0.82rem;">
                            Menampilkan 1 - 5 dari 5 unit
                        </div>
                        <nav aria-label="Page navigation">
                            <ul class="pagination pagination-sm flex-wrap justify-content-center mb-0">
                                <li class="page-item disabled">
                                    <span class="page-link"><i class="mdi mdi-chevron-left"></i></span>
                                </li>
                                <li class="page-item active">
                                    <span class="page-link">1</span>
                                </li>
                                <li class="page-item disabled">
                                    <span class="page-link"><i class="mdi mdi-chevron-right"></i></span>
                                </li>
                            </ul>
                        </nav>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>

<!-- Modal Detail Pekerjaan Unit -->
<div class="modal fade" id="detailUnitModal" tabindex="-1" aria-labelledby="detailUnitModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-white border-bottom">
                <h5 class="modal-title fw-bold" id="detailUnitModalLabel" style="color: #2c2e3f;">
                    <i class="mdi mdi-home-outline me-2" style="color: #9a55ff;"></i>
                    Detail Pekerjaan Unit <span id="detailUnitNumber" class="text-primary"></span> - <span id="detailUnitCluster" class="text-muted"></span>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead>
                            <tr>
                                <th width="5%" class="text-center">No</th>
                                <th width="25%">Tahapan Pekerjaan</th>
                                <th width="15%">Progress</th>
                                <th width="15%">Target Mulai</th>
                                <th width="15%">Target Selesai</th>
                                <th width="10%">Durasi</th>
                                <th width="15%">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center fw-bold">1</td>
                                <td class="fw-bold">Pekerjaan Pondasi</td>
                                <td>
                                    <div class="progress mb-1" style="height: 5px;">
                                        <div class="progress-bar bg-success" style="width: 100%"></div>
                                    </div>
                                    <small class="text-success fw-bold">100%</small>
                                </td>
                                <td>01 Mar 2024</td>
                                <td>15 Mar 2024</td>
                                <td>15 hari</td>
                                <td><span class="status-badge aktif">Selesai</span></td>
                            </tr>
                            <tr>
                                <td class="text-center fw-bold">2</td>
                                <td class="fw-bold">Pekerjaan Struktur</td>
                                <td>
                                    <div class="progress mb-1" style="height: 5px;">
                                        <div class="progress-bar bg-success" style="width: 100%"></div>
                                    </div>
                                    <small class="text-success fw-bold">100%</small>
                                </td>
                                <td>16 Mar 2024</td>
                                <td>30 Apr 2024</td>
                                <td>46 hari</td>
                                <td><span class="status-badge aktif">Selesai</span></td>
                            </tr>
                            <tr>
                                <td class="text-center fw-bold">3</td>
                                <td class="fw-bold">Pekerjaan Dinding & Plester</td>
                                <td>
                                    <div class="progress mb-1" style="height: 5px;">
                                        <div class="progress-bar bg-success" style="width: 85%"></div>
                                    </div>
                                    <small class="text-info fw-bold">85%</small>
                                </td>
                                <td>01 Apr 2024</td>
                                <td>15 Mei 2024</td>
                                <td>45 hari</td>
                                <td><span class="status-badge" style="background: rgba(23, 162, 184, 0.12); color: #17a2b8;">On Track</span></td>
                            </tr>
                            <tr>
                                <td class="text-center fw-bold">4</td>
                                <td class="fw-bold">Pekerjaan Atap & Rangka Baja</td>
                                <td>
                                    <div class="progress mb-1" style="height: 5px;">
                                        <div class="progress-bar bg-warning" style="width: 60%"></div>
                                    </div>
                                    <small class="text-warning fw-bold">60%</small>
                                </td>
                                <td>16 Apr 2024</td>
                                <td>10 Mei 2024</td>
                                <td>25 hari</td>
                                <td><span class="status-badge" style="background: rgba(255, 193, 7, 0.15); color: #b78103;">Mendekati</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer bg-light border-top">
                <button type="button" class="btn btn-secondary btn-sm px-4" data-bs-dismiss="modal">
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Deadline -->
<div class="modal fade" id="editDeadlineModal" tabindex="-1" aria-labelledby="editDeadlineModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <form id="formEditDeadline" onsubmit="return handleSimpanDeadline(event)">
                <div class="modal-header bg-white border-bottom">
                    <h5 class="modal-title fw-bold" id="editDeadlineModalLabel" style="color: #2c2e3f;">
                        <i class="mdi mdi-clock-edit-outline me-2" style="color: #9a55ff;"></i>
                        Edit Target Deadline Unit
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label fw-bold" style="color: #2c2e3f;">Unit & Cluster</label>
                        <input type="text" class="form-control bg-light" id="editUnitDisplay" readonly>
                    </div>

                    <div class="row g-2 mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold" style="color: #2c2e3f;">Target Mulai <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" name="target_mulai" id="editTargetMulai" required onchange="hitungDurasi()">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold" style="color: #2c2e3f;">Target Selesai <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" name="target_selesai" id="editTargetSelesai" required onchange="hitungDurasi()">
                        </div>
                    </div>

                    <div class="p-3 bg-light rounded-3 border">
                        <div class="d-flex align-items-center justify-content-between">
                            <span class="text-muted fw-semibold" style="font-size: 0.85rem;">Estimasi Total Durasi:</span>
                            <span class="badge bg-primary bg-opacity-10 text-primary fw-bold px-3 py-2" id="durasiText" style="font-size: 0.9rem;">0 hari</span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light border-top">
                    <button type="button" class="btn btn-secondary btn-sm px-3" data-bs-dismiss="modal">
                        Batal
                    </button>
                    <button type="submit" class="btn btn-gradient-primary btn-sm px-4">
                        <i class="mdi mdi-content-save me-1"></i>Simpan Perubahan
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
function openDetailUnit(unit, cluster) {
    $('#detailUnitNumber').text(unit);
    $('#detailUnitCluster').text(cluster);
    $('#detailUnitModal').modal('show');
}

function openEditDeadline(unit, cluster, tglMulai, tglSelesai) {
    $('#editUnitDisplay').val('Unit ' + unit + ' - ' + cluster);
    $('#editTargetMulai').val(tglMulai);
    $('#editTargetSelesai').val(tglSelesai);
    hitungDurasi();
    $('#editDeadlineModal').modal('show');
}

function hitungDurasi() {
    let mulai = $('#editTargetMulai').val();
    let selesai = $('#editTargetSelesai').val();

    if (mulai && selesai) {
        let d1 = new Date(mulai);
        let d2 = new Date(selesai);
        let diffTime = d2 - d1;
        let diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)) + 1;
        if (diffDays < 0) diffDays = 0;
        $('#durasiText').text(diffDays + ' hari');
    } else {
        $('#durasiText').text('0 hari');
    }
}

function resetFilter() {
    $('#filterForm')[0].reset();
    Swal.fire({
        icon: 'success',
        title: 'Filter Direset',
        timer: 1200,
        showConfirmButton: false
    });
}

function handleSimpanDeadline(event) {
    event.preventDefault();
    $('#editDeadlineModal').modal('hide');

    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: 'Deadline target pekerjaan unit berhasil diperbarui.',
        timer: 2000,
        showConfirmButton: true,
        confirmButtonColor: '#9a55ff'
    });
    return false;
}
</script>
@endpush
