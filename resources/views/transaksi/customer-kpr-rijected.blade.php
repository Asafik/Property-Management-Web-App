@extends('layouts.partial.app')

@section('title', 'Daftar Customer KPR Rejected - Property Management App')

@section('content')

    <style>
        .card {
            transition: all 0.3s ease;
            margin-bottom: 1rem;
            border: none !important;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        }

        .card:hover {
            box-shadow: 0 8px 25px rgba(154, 85, 255, 0.1) !important;
        }

        .card-header {
            background: linear-gradient(135deg, #ffffff, #f8f9fa);
            border-bottom: 1px solid #e9ecef;
            padding: 0.75rem;
        }

        @media (min-width: 576px) {
            .card-header {
                padding: 1rem;
            }
        }

        @media (min-width: 768px) {
            .card-header {
                padding: 1.2rem;
            }
        }

        .card-body {
            padding: 0.75rem;
        }

        @media (min-width: 576px) {
            .card-body {
                padding: 1rem;
            }
        }

        @media (min-width: 768px) {
            .card-body {
                padding: 1.2rem;
            }
        }

        .card-title {
            font-size: 0.95rem;
            font-weight: 700;
            color: #9a55ff;
            margin-bottom: 0;
        }

        @media (min-width: 576px) {
            .card-title {
                font-size: 1rem;
            }
        }

        @media (min-width: 768px) {
            .card-title {
                font-size: 1.1rem;
            }
        }

        .filter-card {
            background: linear-gradient(135deg, #f9f7ff, #f2ecff);
            border-radius: 14px;
            padding: 1rem;
            margin-bottom: 1.25rem;
            border: none;
        }

        .filter-card .form-label {
            font-size: 0.85rem;
            font-weight: 600;
            color: #9a55ff !important;
            margin-bottom: 0.4rem;
            letter-spacing: 0.3px;
        }

        .filter-card .form-control,
        .filter-card .form-select {
            padding: 0.55rem 0.8rem;
            font-size: 0.9rem;
            border-radius: 10px;
            height: auto;
            min-height: 42px;
            border: 1px solid #e0e4e9;
        }

        .form-control,
        .form-select {
            border: 1px solid #e9ecef;
            border-radius: 10px;
            padding: 0.65rem 0.9rem;
            font-size: 0.9rem;
            transition: all 0.2s ease;
            background-color: #ffffff;
            color: #2c2e3f;
            height: auto;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #9a55ff;
            box-shadow: 0 0 0 3px rgba(154, 85, 255, 0.1);
            outline: none;
        }

        .form-label {
            font-size: 0.85rem;
            font-weight: 600;
            color: #9a55ff !important;
            margin-bottom: 0.35rem;
            letter-spacing: 0.3px;
            font-family: 'Nunito', sans-serif;
        }

        .btn {
            font-size: 0.85rem;
            padding: 0.6rem 1rem;
            border-radius: 10px;
            font-weight: 600;
            transition: all 0.3s ease;
            font-family: 'Nunito', sans-serif;
            border: none;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .btn-gradient-primary {
            background: linear-gradient(to right, #da8cff, #9a55ff) !important;
            color: #ffffff !important;
        }

        .btn-gradient-secondary {
            background: #6c757d !important;
            color: #ffffff !important;
        }

        .btn-gradient-secondary:hover {
            background: #5a6268 !important;
        }

        .btn-icon-only {
            width: 42px;
            height: 42px;
            padding: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
        }

        .btn-icon-only i {
            font-size: 1.1rem;
            margin: 0;
        }

        .table-responsive {
            overflow-x: auto;
            overflow-y: hidden;
            -webkit-overflow-scrolling: touch;
            border-radius: 8px;
            margin-bottom: 0.5rem;
            scrollbar-width: thin;
            scrollbar-color: #9a55ff #f0f0f0;
        }

        .table-responsive::-webkit-scrollbar {
            height: 8px;
        }

        .table-responsive::-webkit-scrollbar-track {
            background: #f0f0f0;
            border-radius: 10px;
        }

        .table-responsive::-webkit-scrollbar-thumb {
            background: #9a55ff;
            border-radius: 10px;
        }

        .table-responsive::-webkit-scrollbar-thumb:hover {
            background: #7a3fcc;
        }

        .table-responsive::-webkit-scrollbar:vertical {
            display: none;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 0;
        }

        .table thead th {
            background: linear-gradient(135deg, #f8f9fa, #f1f3f5);
            color: #9a55ff;
            font-weight: 700;
            font-size: 0.78rem;
            text-transform: uppercase;
            letter-spacing: 0.4px;
            border-bottom: 2px solid #e9ecef;
            padding: 0.85rem 0.55rem;
            white-space: nowrap;
        }

        .table tbody td {
            vertical-align: middle;
            font-size: 0.88rem;
            padding: 0.9rem 0.55rem;
            border-bottom: 1px solid #e9ecef;
            color: #2c2e3f;
            white-space: nowrap;
        }

        .table tbody tr:hover {
            background-color: #faf8ff;
        }

        .table thead th:first-child,
        .table tbody td:first-child {
            text-align: center;
            width: 50px;
            font-weight: 700;
        }

        .customer-wrap {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .customer-initial {
            width: 38px;
            height: 38px;
            min-width: 38px;
            border-radius: 50%;
            background: linear-gradient(135deg, #da8cff, #9a55ff);
            color: #fff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 0.82rem;
            font-weight: 700;
            box-shadow: 0 4px 12px rgba(154, 85, 255, 0.25);
        }

        .customer-name {
            font-weight: 700;
            color: #2c2e3f;
        }

        .badge-type {
            padding: 0.4rem 0.85rem;
            border-radius: 20px;
            font-weight: 700;
            font-size: 0.78rem;
            display: inline-block;
        }

        .badge-subsidi {
            background: linear-gradient(135deg, #28c76f, #48da89);
            color: #fff;
        }

        .badge-komersil {
            background: linear-gradient(135deg, #9a55ff, #c084fc);
            color: #fff;
        }

        .status-doc {
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            padding: 0.4rem 0.75rem;
            border-radius: 20px;
            font-size: 0.78rem;
            font-weight: 700;
        }

        .status-incomplete {
            background: rgba(255, 159, 67, 0.12);
            color: #ff9f43;
        }

        .status-rejected {
            background: rgba(220, 53, 69, 0.12);
            color: #dc3545;
        }

        .status-revisi {
            background: rgba(0, 207, 232, 0.12);
            color: #00a8c0;
        }

        .status-default {
            background: rgba(108, 117, 125, 0.12);
            color: #6c757d;
        }

        .action-group {
            display: flex;
            gap: 0.4rem;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn-table-action {
            padding: 0.45rem 0.7rem;
            border-radius: 8px;
            font-size: 0.78rem;
            font-weight: 700;
            border: none;
            color: #fff;
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            transition: all 0.25s ease;
            text-decoration: none;
        }

        .btn-table-action:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.12);
            color: #fff;
        }

        .btn-survey {
            background: linear-gradient(135deg, #00cfe8, #4fdff0);
        }

        .btn-akad {
            background: linear-gradient(135deg, #28c76f, #48da89);
        }

        .btn-note {
            background: linear-gradient(135deg, #ff9f43, #ffbe76);
            color: #fff;
            padding: 0.45rem 0.8rem;
            border-radius: 8px;
            font-size: 0.78rem;
            font-weight: 700;
            border: none;
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
        }

        .btn-note:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(255, 159, 67, 0.25);
        }

        .pagination {
            margin: 0;
            gap: 3px;
        }

        .page-item .page-link {
            border: 1px solid #e9ecef;
            padding: 0.35rem 0.7rem;
            font-size: 0.75rem;
            color: #6c7383;
            background-color: #ffffff;
            border-radius: 6px !important;
            transition: all 0.2s ease;
            min-width: 32px;
            text-align: center;
            text-decoration: none;
        }

        .page-item.active .page-link {
            background: linear-gradient(to right, #da8cff, #9a55ff);
            border-color: transparent;
            color: #ffffff;
            box-shadow: 0 4px 12px rgba(154, 85, 255, 0.3);
        }

        .pagination-info {
            font-size: 0.82rem;
            color: #6c7383;
        }

        .text-primary {
            color: #9a55ff !important;
        }

        .text-success {
            color: #28c76f !important;
        }

        .text-danger {
            color: #dc3545 !important;
        }

        .text-muted {
            color: #a5b3cb !important;
        }

        .fw-bold {
            font-weight: 700 !important;
        }

        h3.text-dark {
            font-size: 1.35rem !important;
            font-weight: 700;
            color: #2c2e3f !important;
            margin-bottom: 0.5rem !important;
        }

        @media (min-width: 576px) {
            h3.text-dark {
                font-size: 1.5rem !important;
            }
        }

        @media (min-width: 768px) {
            h3.text-dark {
                font-size: 1.7rem !important;
            }
        }

        .modal-content {
            border: none;
            border-radius: 16px;
        }

        .modal-header {
            background: linear-gradient(135deg, #da8cff, #9a55ff);
            color: white;
            border-radius: 16px 16px 0 0;
            padding: 1rem 1.5rem;
        }

        .modal-header .btn-close {
            filter: brightness(0) invert(1);
        }

        .modal-title {
            font-weight: 700;
            font-size: 1.05rem;
        }

        .modal-body {
            padding: 1.5rem;
        }

        .modal-footer {
            border-top: 1px solid #e9ecef;
            padding: 1rem 1.5rem;
        }

        .note-box {
            background: #faf8ff;
            border: 1px solid #eee6ff;
            border-radius: 12px;
            padding: 1rem;
            color: #4b4f5c;
            line-height: 1.6;
            white-space: normal;
        }

        .mdi {
            vertical-align: middle;
        }

        .filter-row-desktop {
            display: block;
        }

        .filter-row-mobile {
            display: none;
        }

        .filter-text {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: #9a55ff;
            font-weight: 700;
            font-size: 0.95rem;
            margin-bottom: 0.9rem;
        }

        @media (max-width: 767px) {
            .filter-row-desktop {
                display: none;
            }

            .filter-row-mobile {
                display: block;
            }
        }
    </style>

    <div class="container-fluid p-2 p-sm-3 p-md-4">

        <div class="row mb-3 mb-md-4">
            <div class="col-12">
                <div class="card shadow-sm border-0">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="text-dark mb-1">
                                <i class="mdi mdi-account-cancel me-2" style="color: #9a55ff;"></i>
                                Daftar Customer KPR Rejected
                            </h3>
                            <p class="text-muted mb-0">
                                Kelola data customer KPR yang telah rejected
                            </p>
                        </div>
                        <div class="d-none d-sm-block">
                            <i class="mdi mdi-home-alert-outline"
                                style="font-size: 2.6rem; color: #9a55ff; opacity: 0.2;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-2 mt-md-3">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-white d-flex flex-wrap justify-content-between align-items-center gap-2">
                        <h5 class="card-title mb-0">
                            <i class="mdi mdi-format-list-bulleted-square me-2"></i>
                            Data Customer KPR Rejected
                        </h5>
                    </div>

                    <div class="card-body">

                        <div class="filter-card mb-4">
                            <div class="filter-row-desktop">
                                <div class="filter-text">
                                    <i class="mdi mdi-filter-outline"></i>
                                    <span>Filter Data KPR Rejected</span>
                                </div>

                                <form method="GET" action="">
                                    <div class="row g-3 align-items-end">
                                        <div class="col-md-4">
                                            <label class="form-label">Search Nama Customer / Unit Rumah</label>
                                            <input type="text" class="form-control" name="search"
                                                value="{{ request('search') }}"
                                                placeholder="Cari nama customer atau unit rumah...">
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label">Filter Status</label>
                                            <select class="form-select" name="status">
                                                <option value="">Semua Status</option>
                                                <option value="rejected"
                                                    {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected
                                                </option>
                                                <option value="revisi"
                                                    {{ request('status') == 'revisi' ? 'selected' : '' }}>Revisi</option>
                                                <option value="incomplete"
                                                    {{ request('status') == 'incomplete' ? 'selected' : '' }}>Incomplete
                                                </option>
                                                <option value="survey"
                                                    {{ request('status') == 'survey' ? 'selected' : '' }}>Survey</option>
                                                <option value="akad" {{ request('status') == 'akad' ? 'selected' : '' }}>
                                                    Akad</option>
                                                <option value="dokumen"
                                                    {{ request('status') == 'dokumen' ? 'selected' : '' }}>Dokumen</option>
                                            </select>
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label">Tampilkan</label>
                                            <select class="form-select" name="per_page">
                                                <option value="10" {{ request('per_page') == '10' ? 'selected' : '' }}>
                                                    10</option>
                                                <option value="15" {{ request('per_page') == '15' ? 'selected' : '' }}>
                                                    15</option>
                                                <option value="25" {{ request('per_page') == '25' ? 'selected' : '' }}>
                                                    25</option>
                                            </select>
                                        </div>

                                        <div class="col-md-2">
                                            <label class="form-label invisible">Aksi</label>
                                            <div class="d-flex gap-2">
                                                <button type="submit"
                                                    class="btn btn-gradient-primary btn-icon-only flex-fill" title="Filter">
                                                    <i class="mdi mdi-filter"></i>
                                                </button>
                                                <a href="{{ url()->current() }}"
                                                    class="btn btn-gradient-secondary btn-icon-only flex-fill"
                                                    title="Reset">
                                                    <i class="mdi mdi-refresh"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="filter-row-mobile">
                                <div class="filter-text">
                                    <i class="mdi mdi-filter-outline"></i>
                                    <span>Filter Data KPR Rejected</span>
                                </div>

                                <form method="GET" action="">
                                    <div class="row g-2">
                                        <div class="col-12">
                                            <label class="form-label">Search Nama Customer / Unit Rumah</label>
                                            <input type="text" class="form-control" name="search"
                                                value="{{ request('search') }}"
                                                placeholder="Cari nama customer atau unit rumah...">
                                        </div>

                                        <div class="col-12">
                                            <label class="form-label">Filter Status</label>
                                            <select class="form-select" name="status">
                                                <option value="">Semua Status</option>
                                                <option value="rejected"
                                                    {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected
                                                </option>
                                                <option value="revisi"
                                                    {{ request('status') == 'revisi' ? 'selected' : '' }}>Revisi</option>
                                                <option value="incomplete"
                                                    {{ request('status') == 'incomplete' ? 'selected' : '' }}>Incomplete
                                                </option>
                                                <option value="survey"
                                                    {{ request('status') == 'survey' ? 'selected' : '' }}>Survey</option>
                                                <option value="akad" {{ request('status') == 'akad' ? 'selected' : '' }}>
                                                    Akad</option>
                                                <option value="dokumen"
                                                    {{ request('status') == 'dokumen' ? 'selected' : '' }}>Dokumen</option>
                                            </select>
                                        </div>

                                        <div class="col-12">
                                            <label class="form-label">Tampilkan</label>
                                            <select class="form-select" name="per_page">
                                                <option value="10" {{ request('per_page') == '10' ? 'selected' : '' }}>
                                                    10</option>
                                                <option value="15" {{ request('per_page') == '15' ? 'selected' : '' }}>
                                                    15</option>
                                                <option value="25" {{ request('per_page') == '25' ? 'selected' : '' }}>
                                                    25</option>
                                            </select>
                                        </div>

                                        <div class="col-6">
                                            <button type="submit" class="btn btn-gradient-primary btn-icon-only w-100">
                                                <i class="mdi mdi-filter"></i>
                                            </button>
                                        </div>
                                        <div class="col-6">
                                            <a href="{{ url()->current() }}"
                                                class="btn btn-gradient-secondary btn-icon-only w-100">
                                                <i class="mdi mdi-refresh"></i>
                                            </a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Customer</th>
                                        <th>Unit Rumah</th>
                                        <th>Jenis</th>
                                        <th>Unit</th>
                                        <th>Bank</th>
                                        <th>Status Dokumen</th>
                                        <th>Tgl Verifikasi</th>
                                        <th>Catatan</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($kprApplications as $index => $application)
                                        @php
                                            $customerName = $application->customer->full_name ?? '-';
                                            $words = explode(' ', trim($customerName));
                                            $initial = '';
                                            foreach ($words as $word) {
                                                if ($word !== '') {
                                                    $initial .= strtoupper(substr($word, 0, 1));
                                                }
                                            }
                                            $initial = substr($initial, 0, 2) ?: '-';

                                            $status = strtolower($application->status ?? '');
                                            $unitType = strtolower($application->unit->type ?? '');
                                            $catatan = $application->catatan ?? '-';
                                        @endphp
                                        <tr>
                                            <td>{{ $index + 1 }}</td>

                                            <td>
                                                <div class="customer-wrap">
                                                    <div class="customer-initial">{{ $initial }}</div>
                                                    <span class="customer-name">{{ $customerName }}</span>
                                                </div>
                                            </td>

                                            <td>
                                                <span class="fw-bold">
                                                    <i class="mdi mdi-home-city-outline text-primary me-1"></i>
                                                    {{ $application->unit->unit_name ?? '-' }}
                                                </span>
                                            </td>

                                            <td>
                                                @if ($unitType === 'subsidi')
                                                    <span class="badge-type badge-subsidi">
                                                        <i class="mdi mdi-home me-1"></i>Subsidi
                                                    </span>
                                                @elseif($unitType === 'komersil')
                                                    <span class="badge-type badge-komersil">
                                                        <i class="mdi mdi-home me-1"></i>Komersil
                                                    </span>
                                                @else
                                                    <span class="badge-type badge-komersil">
                                                        <i
                                                            class="mdi mdi-home me-1"></i>{{ ucfirst($application->unit->type ?? '-') }}
                                                    </span>
                                                @endif
                                            </td>

                                            <td>
                                                <span class="fw-bold">
                                                    <i class="mdi mdi-home-outline text-primary me-1"></i>
                                                    {{ $application->unit->unit_code ?? '-' }}
                                                </span>
                                            </td>

                                            <td>
                                                <span class="fw-bold">
                                                    <i
                                                        class="mdi mdi-bank text-success me-1"></i>{{ $application->bank->bank_name ?? '-' }}
                                                </span>
                                            </td>

                                            <td>
                                                @if ($status === 'rejected')
                                                    <span class="status-doc status-rejected">
                                                        <i class="mdi mdi-close-circle-outline"></i>Rejected
                                                    </span>
                                                @elseif($status === 'revisi')
                                                    <span class="status-doc status-revisi">
                                                        <i class="mdi mdi-file-replace-outline"></i>Revisi
                                                    </span>
                                                @elseif($status === 'incomplete')
                                                    <span class="status-doc status-incomplete">
                                                        <i class="mdi mdi-alert-circle-outline"></i>Incomplete
                                                    </span>
                                                @elseif($status === 'survey')
                                                    <span class="status-doc status-revisi">
                                                        <i class="mdi mdi-map-marker-outline"></i>Survey
                                                    </span>
                                                @elseif($status === 'akad')
                                                    <span class="status-doc status-revisi">
                                                        <i class="mdi mdi-file-document-check-outline"></i>Akad
                                                    </span>
                                                @elseif($status === 'dokumen')
                                                    <span class="status-doc status-revisi">
                                                        <i class="mdi mdi-check-circle-outline"></i>Dokumen
                                                    </span>
                                                @else
                                                    <span class="status-doc status-default">
                                                        <i
                                                            class="mdi mdi-progress-question"></i>{{ ucfirst($application->status ?? '-') }}
                                                    </span>
                                                @endif
                                            </td>

                                            <td>
                                                <span class="fw-bold">
                                                    {{ optional($application->updated_at)->format('d M Y') ?? '-' }}
                                                </span>
                                            </td>

                                            <td>
                                                <button type="button" class="btn-note"
                                                    onclick="showNote(@js($customerName), @js($catatan))">
                                                    <i class="mdi mdi-eye-outline"></i>Lihat
                                                </button>
                                            </td>

                                            <td class="text-center">
                                                <div class="action-group">
                                                    @if ($status === 'rejected')
                                                        <a href="{{ route('pengajuan.show', $application->booking_id) }}"
                                                            class="btn-table-action btn-warning">
                                                            <i class="mdi mdi-refresh"></i> Ajukan Ulang
                                                        </a>
                                                    @elseif($unitType === 'komersil')
                                                        @if ($status === 'survey')
                                                            <a href="{{ route('kpr.survey', $application->id) }}"
                                                                class="btn-table-action btn-survey">
                                                                <i class="mdi mdi-map-marker-path"></i>Lanjut ke Survey
                                                            </a>
                                                        @else
                                                            <a href="{{ route('kpr.akad', $application->id) }}"
                                                                class="btn-table-action btn-akad">
                                                                <i class="mdi mdi-file-document-check-outline"></i>Lanjut
                                                                ke Akad
                                                            </a>
                                                        @endif
                                                    @else
                                                        <a href="{{ route('kpr.survey', $application->id) }}"
                                                            class="btn-table-action btn-survey">
                                                            <i class="mdi mdi-map-marker-path"></i>Lanjut ke Survey
                                                        </a>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="10" class="text-center text-muted py-4">
                                                Tidak ada data customer KPR rejected
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        @if (method_exists($kprApplications, 'total'))
                            <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mt-4">
                                <div class="pagination-info mb-2 mb-sm-0">
                                    Menampilkan {{ $kprApplications->firstItem() ?? 0 }} -
                                    {{ $kprApplications->lastItem() ?? 0 }} dari {{ $kprApplications->total() }} data
                                </div>
                                <div>
                                    {{ $kprApplications->withQueryString()->links() }}
                                </div>
                            </div>
                        @else
                            <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mt-4">
                                <div class="pagination-info mb-2 mb-sm-0">
                                    Menampilkan 1 - {{ count($kprApplications) }} dari {{ count($kprApplications) }} data
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
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="noteModal" tabindex="-1" aria-labelledby="noteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="noteModalLabel">
                        <i class="mdi mdi-note-text-outline me-2"></i>Catatan Customer
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-2 fw-bold text-primary" id="noteCustomerName">-</div>
                    <div class="note-box" id="noteContent">-</div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-gradient-secondary" data-bs-dismiss="modal">
                        <i class="mdi mdi-close me-1"></i>Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        function showNote(customerName, note) {
            document.getElementById('noteCustomerName').textContent = customerName;
            document.getElementById('noteContent').textContent = note;

            const modal = new bootstrap.Modal(document.getElementById('noteModal'));
            modal.show();
        }
    </script>
@endpush
