@extends('layouts.partial.app')

@section('title', 'Pra Tanah - Property Management App')

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
            font-size: 0.9rem;
            font-weight: 600;
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
            border-radius: 12px;
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
            padding: 0.5rem 0.75rem;
            font-size: 0.9rem;
            border-radius: 8px;
            height: auto;
            min-height: 40px;
            border: 1px solid #e0e4e9;
        }

        .form-control,
        .form-select {
            border: 1px solid #e9ecef;
            border-radius: 8px;
            padding: 0.6rem 0.8rem;
            font-size: 0.9rem;
            transition: all 0.2s ease;
            background-color: #ffffff;
            color: #2c2e3f;
            height: auto;
        }

        @media (min-width: 576px) {

            .form-control,
            .form-select {
                padding: 0.7rem 1rem;
                font-size: 0.95rem;
                border-radius: 10px;
            }
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
            margin-bottom: 0.3rem;
            letter-spacing: 0.3px;
            font-family: 'Nunito', sans-serif;
        }

        .btn {
            font-size: 0.85rem;
            padding: 0.6rem 1rem;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
            font-family: 'Nunito', sans-serif;
            border: none;
        }

        @media (min-width: 576px) {
            .btn {
                font-size: 0.9rem;
                padding: 0.7rem 1.2rem;
                border-radius: 10px;
            }
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

        .btn-gradient-info {
            background: linear-gradient(135deg, #17a2b8, #56c6d8) !important;
            color: #ffffff !important;
        }

        .btn-gradient-warning {
            background: linear-gradient(135deg, #ffc107, #ffdb6d) !important;
            color: #2c2e3f !important;
        }

        .btn-gradient-danger {
            background: linear-gradient(135deg, #dc3545, #e4606d) !important;
            color: #ffffff !important;
        }

        .btn-gradient-success {
            background: linear-gradient(135deg, #28a745, #6fdf8c) !important;
            color: #ffffff !important;
        }

        .btn-action {
            width: 36px;
            height: 36px;
            padding: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            margin: 0 3px;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
        }

        .btn-action i {
            font-size: 1.1rem;
        }

        .btn-action.fase1 {
            background: linear-gradient(135deg, #9a55ff, #da8cff);
            color: white;
        }

        .btn-action.fase2 {
            background: linear-gradient(135deg, #17a2b8, #56c6d8);
            color: white;
        }

        .btn-action.fase3 {
            background: linear-gradient(135deg, #28a745, #6fdf8c);
            color: white;
        }

        .btn-action.edit {
            background: linear-gradient(135deg, #ffc107, #ffdb6d);
            color: #2c2e3f;
        }

        .btn-action.delete {
            background: linear-gradient(135deg, #dc3545, #e4606d);
            color: white;
        }

        .btn-action.view {
            background: linear-gradient(135deg, #6c757d, #8a8f97);
            color: white;
        }

        .btn-action:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        /* TABEL - DENGAN SCROLLBAR */
        .table-wrapper {
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            border-radius: 8px;
            margin-bottom: 0.5rem;
            scrollbar-width: thin;
            scrollbar-color: #9a55ff #f0f0f0;
        }

        .table-wrapper::-webkit-scrollbar {
            height: 8px;
        }

        .table-wrapper::-webkit-scrollbar-track {
            background: #f0f0f0;
            border-radius: 10px;
        }

        .table-wrapper::-webkit-scrollbar-thumb {
            background: #9a55ff;
            border-radius: 10px;
        }

        .table-wrapper::-webkit-scrollbar-thumb:hover {
            background: #7b3fcc;
        }

        .table {
            width: 100%;
            table-layout: auto;
            border-collapse: collapse;
            margin-bottom: 0;
        }

        .table thead th {
            background: linear-gradient(135deg, #f8f9fa, #f1f3f5);
            color: #9a55ff;
            font-weight: 600;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 2px solid #e9ecef;
            padding: 0.8rem 0.5rem;
            white-space: nowrap;
        }

        @media (min-width: 576px) {
            .table thead th {
                font-size: 0.85rem;
                padding: 0.9rem 0.6rem;
            }
        }

        @media (min-width: 768px) {
            .table thead th {
                font-size: 0.9rem;
                padding: 1rem 0.75rem;
            }
        }

        .table thead th:first-child {
            padding-left: 0.5rem;
            width: 50px;
            text-align: center;
        }

        .table tbody td:first-child {
            padding-left: 0.5rem;
            font-weight: 500;
            width: 50px;
            text-align: center;
        }

        .table tbody td {
            vertical-align: middle;
            font-size: 0.85rem;
            padding: 0.8rem 0.5rem;
            border-bottom: 1px solid #e9ecef;
            color: #2c2e3f;
        }

        @media (min-width: 576px) {
            .table tbody td {
                font-size: 0.9rem;
                padding: 0.9rem 0.6rem;
            }
        }

        @media (min-width: 768px) {
            .table tbody td {
                font-size: 0.95rem;
                padding: 1rem 0.75rem;
            }
        }

        .table tbody tr:hover {
            background-color: #f8f9fa;
        }

        /* Progress Bar Styling */
        .progress-fase {
            width: 100%;
            min-width: 180px;
        }

        .progress-fase .progress-label {
            font-size: 0.65rem;
            color: #9a55ff;
            margin-bottom: 3px;
            font-weight: 600;
        }

        .progress-fase .progress-bar-container {
            background-color: #e9ecef;
            border-radius: 10px;
            height: 8px;
            overflow: hidden;
        }

        .progress-fase .progress-bar-fill {
            background: linear-gradient(to right, #9a55ff, #da8cff);
            border-radius: 10px;
            height: 100%;
            transition: width 0.3s ease;
        }

        .progress-fase .progress-percent {
            font-size: 0.6rem;
            color: #6c7383;
            margin-top: 3px;
            text-align: right;
        }

        /* FASE Badge */
        .fase-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 0.7rem;
            font-weight: 600;
        }

        .fase-badge.fase1 {
            background: rgba(154, 85, 255, 0.15);
            color: #9a55ff;
        }

        .fase-badge.fase2 {
            background: rgba(23, 162, 184, 0.15);
            color: #17a2b8;
        }

        .fase-badge.fase3 {
            background: rgba(40, 167, 69, 0.15);
            color: #28a745;
        }

        .fase-badge.completed {
            background: rgba(40, 167, 69, 0.15);
            color: #28a745;
        }

        .fase-badge.cancelled {
            background: rgba(220, 53, 69, 0.15);
            color: #dc3545;
        }

        .badge-status {
            padding: 0.35rem 0.8rem;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.75rem;
            display: inline-block;
        }

        .badge-status.nego {
            background: linear-gradient(135deg, #ffc107, #ffdb6d);
            color: #2c2e3f;
        }

        .badge-status.survey {
            background: linear-gradient(135deg, #17a2b8, #56c6d8);
            color: #fff;
        }

        .badge-status.deal {
            background: linear-gradient(135deg, #28a745, #6fdf8c);
            color: #fff;
        }

        .badge-status.batal {
            background: linear-gradient(135deg, #dc3545, #e4606d);
            color: #fff;
        }

        .badge-status.pending {
            background: linear-gradient(135deg, #6c757d, #8a8f97);
            color: #fff;
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
            font-size: 0.8rem;
            color: #6c7383;
        }

        /* MODAL STYLING */
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
            font-weight: 600;
            font-size: 1.1rem;
        }

        .modal-body {
            padding: 1.5rem;
            max-height: 70vh;
            overflow-y: auto;
        }

        .modal-footer {
            border-top: 1px solid #e9ecef;
            padding: 1rem 1.5rem;
        }

        /* Section dalam Modal */
        .modal-section {
            margin-bottom: 1.5rem;
            border-bottom: 1px solid #e9ecef;
            padding-bottom: 1rem;
        }

        .modal-section:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .modal-section-title {
            font-size: 0.9rem;
            font-weight: 700;
            color: #9a55ff;
            margin-bottom: 0.8rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .modal-section-title i {
            font-size: 1rem;
        }

        .info-row {
            display: flex;
            margin-bottom: 0.5rem;
            font-size: 0.85rem;
        }

        .info-label {
            width: 120px;
            font-weight: 600;
            color: #6c7383;
        }

        .info-value {
            flex: 1;
            color: #2c2e3f;
        }

        .text-primary {
            color: #9a55ff !important;
        }

        .text-muted {
            color: #a5b3cb !important;
        }

        .fw-bold {
            font-weight: 600 !important;
        }

        h3.text-dark {
            font-size: 1.3rem !important;
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

        .mdi {
            vertical-align: middle;
        }


        /* MODERN CHECKBOX & UPLOAD STYLES FROM PRA_LAND_BANK */
        .pratanah-checkbox-group {
            display: flex;
            flex-wrap: wrap;
            gap: 0.75rem;
            justify-content: flex-start;
            margin-top: 0.5rem;
        }

        .pratanah-checkbox-wrapper {
            position: relative;
            min-width: 130px;
            flex: 1 1 auto;
        }

        .pratanah-checkbox-input {
            position: absolute;
            opacity: 0;
            width: 0;
            height: 0;
        }

        .pratanah-checkbox-label {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 0.6rem 1rem;
            background: linear-gradient(135deg, #f8f9fa, #f1f3f5);
            border: 2px solid #e9ecef;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .pratanah-checkbox-input:checked+.pratanah-checkbox-label {
            border-color: #9a55ff;
            background: linear-gradient(135deg, #f1f0ff, #e8e0ff);
            box-shadow: 0 5px 15px rgba(154, 85, 255, 0.1);
        }

        .pratanah-check-icon {
            font-size: 1.2rem;
            color: #d0d4db;
            transition: all 0.3s ease;
        }

        .pratanah-checkbox-input:checked+.pratanah-checkbox-label .pratanah-check-icon {
            color: #9a55ff;
        }

        .pratanah-check-text {
            font-size: 0.85rem;
            color: #2c2e3f;
            font-weight: 500;
        }

        .pratanah-checkbox-input:checked+.pratanah-checkbox-label .pratanah-check-text {
            color: #9a55ff;
            font-weight: 600;
        }

        /* Modern File Upload */
        .pratanah-file-upload-modern {
            position: relative;
            width: 100%;
        }

        .pratanah-file-upload-modern input[type="file"] {
            position: absolute;
            opacity: 0;
            width: 100%;
            height: 100%;
            cursor: pointer;
            z-index: 2;
        }

        .pratanah-file-label-modern {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 0.6rem 1rem;
            background: linear-gradient(135deg, #f8f9fa, #f1f3f5);
            border: 2px dashed #d0d4db;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .pratanah-file-upload-modern:hover .pratanah-file-label-modern {
            border-color: #9a55ff;
            background: linear-gradient(135deg, #f1f0ff, #f8f9fa);
        }

        .pratanah-file-label-modern i {
            font-size: 1.5rem;
            color: #9a55ff;
            background: rgba(154, 85, 255, 0.1);
            padding: 8px;
            border-radius: 50%;
        }

        .pratanah-file-info-modern {
            flex: 1;
        }

        .pratanah-file-info-modern span {
            display: block;
            font-weight: 600;
            color: #2c2e3f;
            font-size: 0.8rem;
        }

        .pratanah-file-info-modern small {
            color: #6c7383;
            font-size: 0.65rem;
        }

        .pratanah-file-size {
            font-size: 0.7rem;
            color: #9a55ff;
            font-weight: 600;
            background: rgba(154, 85, 255, 0.1);
            padding: 2px 8px;
            border-radius: 20px;
        }

        /* Map Container */
        .pratanah-map-container {
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid #e9ecef;
            height: 300px;
            margin-top: 0.5rem;
        }

        /* Filter Styles from posisi.blade.php */
        .filter-row-desktop {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .filter-row-desktop .filter-text {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: #9a55ff;
            font-weight: 600;
            font-size: 0.95rem;
        }

        .filter-row-mobile {
            display: none;
        }

        @media (max-width: 767px) {
            .filter-row-desktop {
                display: none;
            }

            .filter-row-mobile {
                display: block;
                margin-top: 1rem;
            }
        }

        .btn-icon-only {
            width: 40px;
            height: 40px;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
        }

        .btn-icon-only i {
            font-size: 1.2rem;
            margin: 0;
        }

        .btn-icon-only-mobile {
            width: 100%;
            height: 40px;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
        }

        .btn-icon-only-mobile i {
            font-size: 1.2rem;
            margin: 0;
        }
    </style>

    <div class="container-fluid p-2 p-sm-3 p-md-4">

        <div class="row mb-3 mb-sm-3 mb-md-4">
            <div class="col-12">
                <div class="card shadow-sm border-0">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="text-dark mb-1">
                                <i class="mdi mdi-hand-holding-usd me-2" style="color: #9a55ff;"></i>Pra Tanah / Pra Pelepasan
                            </h3>
                            <p class="text-muted mb-0">
                                Kelola data tanah yang masih dalam tahap penawaran dan negosiasi
                            </p>
                        </div>
                        <div class="d-none d-sm-block">
                            <i class="mdi mdi-hand-holding-usd"
                                style="font-size: 2.5rem; color: #9a55ff; opacity: 0.2;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-2 mt-sm-2 mt-md-3">
            <div class="col-12">
                <div class="card">
                    <div
                        class="card-header bg-white d-flex flex-wrap flex-md-row justify-content-between align-items-center gap-2">
                        <h5 class="card-title mb-0">
                            <i class="mdi mdi-format-list-bulleted me-2"></i>Daftar Pra Tanah
                        </h5>
                        <a class="btn btn-gradient-primary d-inline-flex align-items-center" style="padding: 0.6rem 1.2rem; font-size: 0.9rem; gap: 5px;"
                            href="{{ route('pra-landbank.proses') }}">
                            <i class="mdi mdi-plus me-1"></i>Tambah Pra Tanah
                        </a>
                    </div>

                    <div class="card-body">
                        <div class="filter-card mb-4">
                            <div class="card-body">
                                <!-- Desktop Filter -->
                                <div class="filter-row-desktop">
                                    <div class="filter-text">
                                        <i class="mdi mdi-filter-outline"></i>
                                        <span>Filter data pra tanah</span>
                                    </div>
                                    <form id="filterForm" method="GET" onsubmit="return showFilterLoading()">
                                        <div class="row g-2 align-items-end w-100">
                                            <div class="col-md-8">
                                                <label class="form-label">Cari Nama Tanah / Makelar</label>
                                                <input type="text" class="form-control" name="search" id="searchInput"
                                                    placeholder="Nama tanah atau makelar..."
                                                    value="{{ request('search') }}">
                                            </div>
                                            <div class="col-md-2">
                                                <label class="form-label">Tampil</label>
                                                <select class="form-control" name="limit" id="limitSelect">
                                                    <option value="5" {{ request('limit') == 5 ? 'selected' : '' }}>5
                                                    </option>
                                                    <option value="10"
                                                        {{ request('limit', 10) == 10 ? 'selected' : '' }}>10</option>
                                                    <option value="15" {{ request('limit') == 15 ? 'selected' : '' }}>15
                                                    </option>
                                                    <option value="25" {{ request('limit') == 25 ? 'selected' : '' }}>25
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="d-flex gap-2">
                                                    <button type="submit"
                                                        class="btn btn-gradient-primary btn-icon-only flex-fill"
                                                        title="Filter">
                                                        <i class="mdi mdi-filter"></i>
                                                    </button>
                                                    <button type="button"
                                                        class="btn btn-gradient-secondary btn-icon-only flex-fill"
                                                        title="Reset" onclick="showResetLoading(event)">
                                                        <i class="mdi mdi-refresh"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <!-- Mobile Filter -->
                                <div class="filter-row-mobile">
                                    <div class="filter-text mb-2">
                                        <i class="mdi mdi-filter-outline"></i>
                                        <span>Filter data pra tanah</span>
                                    </div>
                                    <form method="GET" onsubmit="return showFilterLoading()">
                                        <div class="row g-2">
                                            <div class="col-12 mb-2">
                                                <label class="form-label">Cari Nama Tanah / Makelar</label>
                                                <input type="text" class="form-control" name="search"
                                                    id="searchInputMobile" placeholder="Nama tanah atau makelar..."
                                                    value="{{ request('search') }}">
                                            </div>
                                            <div class="col-12 mb-2">
                                                <label class="form-label">Tampil</label>
                                                <select class="form-control" name="limit" id="limitSelectMobile">
                                                    <option value="5" {{ request('limit') == 5 ? 'selected' : '' }}>5
                                                    </option>
                                                    <option value="10"
                                                        {{ request('limit', 10) == 10 ? 'selected' : '' }}>10</option>
                                                    <option value="15" {{ request('limit') == 15 ? 'selected' : '' }}>15
                                                    </option>
                                                    <option value="25" {{ request('limit') == 25 ? 'selected' : '' }}>25
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="col-6">
                                                <button type="submit"
                                                    class="btn btn-gradient-primary btn-icon-only-mobile w-100">
                                                    <i class="mdi mdi-filter"></i> Filter
                                                </button>
                                            </div>
                                            <div class="col-6">
                                                <button type="button"
                                                    class="btn btn-gradient-secondary btn-icon-only-mobile w-100"
                                                    onclick="showResetLoading(event)">
                                                    <i class="mdi mdi-refresh"></i> Reset
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
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
                                            $priorityColor = match (strtolower($land->priority ?? 'normal')) {
                                                'urgent' => '#dc3545',
                                                'high' => '#ffc107',
                                                'normal' => '#0dcaf0',
                                                'low' => '#6c757d',
                                                default => '#0dcaf0',
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
                                                <span class="badge-status"
                                                    style="background:{{ $priorityColor }};color:#2c2e3f;">
                                                    🟠 {{ ucfirst($land->priority ?? 'Normal') }}
                                                </span>
                                            </td>

                                            <td class="text-center">
                                                <a href="{{ route('pra-landbank.proses', ['id' => $land->id, 'step' => 1]) }}" class="btn-action fase1 me-1 d-inline-flex align-items-center justify-content-center text-decoration-none" title="FASE 1" style="width: 32px; height: 32px; border-radius: 50%; background: rgba(154, 85, 255, 0.1); color: #9a55ff; border: none; display: inline-flex;">
                                                    <i class="mdi mdi-account-tie"></i>
                                                </a>

                                                <a href="{{ route('pra-landbank.proses', ['id' => $land->id, 'step' => 2]) }}" class="btn-action fase2 me-1 d-inline-flex align-items-center justify-content-center text-decoration-none" title="FASE 2" style="width: 32px; height: 32px; border-radius: 50%; background: rgba(23, 162, 184, 0.1); color: #17a2b8; border: none; display: inline-flex;">
                                                    <i class="mdi mdi-magnify"></i>
                                                </a>

                                                @if($land->status !== 'fase1' && ($land->status !== 'pending' || !empty($land->survey_date) || !empty($land->survey_by)))
                                                    <a href="{{ route('pra-landbank.proses', ['id' => $land->id, 'step' => 3]) }}" class="btn-action fase3 me-1 d-inline-flex align-items-center justify-content-center text-decoration-none" title="FASE 3" style="width: 32px; height: 32px; border-radius: 50%; background: rgba(40, 167, 69, 0.1); color: #28a745; border: none; display: inline-flex;">
                                                        <i class="mdi mdi-check-decagram"></i>
                                                    </a>
                                                @endif

                                                <form action="{{ route('pra-landbanks.destroy', $land->id) }}"
                                                    method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn-action delete delete-btn" title="Hapus">
                                                        <i class="mdi mdi-delete"></i>
                                                    </button>
                                                </form>
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
