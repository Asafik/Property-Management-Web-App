@extends('layouts.partial.app')

@section('title', 'Data Tamu / Proyeksi')

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
        .form-select,
        textarea.form-control {
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
            .form-select,
            textarea.form-control {
                padding: 0.7rem 1rem;
                font-size: 0.95rem;
                border-radius: 10px;
            }
        }

        .form-control:focus,
        .form-select:focus,
        textarea.form-control:focus {
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

        .btn-gradient-success {
            background: linear-gradient(135deg, #43e97b, #38f9d7) !important;
            color: #ffffff !important;
        }

        .btn-gradient-info {
            background: linear-gradient(135deg, #4facfe, #00f2fe) !important;
            color: #ffffff !important;
        }

        .btn-gradient-secondary {
            background: #6c757d !important;
            color: #ffffff !important;
        }

        .btn-gradient-secondary:hover {
            background: #5a6268 !important;
        }

        .btn-gradient-warning {
            background: linear-gradient(135deg, #ffc107, #ffdb6d) !important;
            color: #2c2e3f !important;
        }

        .btn-gradient-danger {
            background: linear-gradient(135deg, #dc3545, #e4606d) !important;
            color: #ffffff !important;
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

        .header-action-group {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
        }

        @media (max-width: 576px) {
            .header-action-group {
                width: 100%;
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 8px;
            }

            .header-action-group .btn-add {
                grid-column: span 2;
            }

            .header-action-group .btn {
                width: 100%;
                justify-content: center;
                display: flex;
                align-items: center;
            }

            .header-action-group .d-none.d-sm-inline {
                display: inline !important;
                /* Force text to show on mobile since we have grid space */
                margin-left: 4px;
            }
        }

        .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            border-radius: 8px;
            margin-bottom: 0.5rem;
            scrollbar-width: thin;
            scrollbar-color: #9a55ff #f0f0f0;
        }

        .table-responsive::-webkit-scrollbar {
            width: 8px;
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

        .table-responsive::-webkit-scrollbar-corner {
            background: #f0f0f0;
        }

        .table {
            width: 100%;
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
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .table thead th.sortable {
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .table thead th.sortable:hover {
            color: #7a3fcc;
        }

        .table thead th i {
            font-size: 0.8rem;
            margin-left: 4px;
            opacity: 0.5;
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
            width: 40px;
            text-align: center;
        }

        .table tbody td:first-child {
            padding-left: 0.5rem;
            font-weight: 500;
            width: 40px;
            text-align: center;
        }

        .table tbody td {
            vertical-align: middle;
            font-size: 0.85rem;
            padding: 0.8rem 0.5rem;
            border-bottom: 1px solid #e9ecef;
            color: #2c2e3f;
            white-space: nowrap;
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

        .badge-status {
            padding: 0.35rem 0.8rem;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.82rem;
            display: inline-block;
            color: #fff;
        }

        .badge-status.new {
            background: linear-gradient(135deg, #da8cff, #9a55ff);
        }

        .badge-status.follow_up {
            background: linear-gradient(135deg, #4facfe, #00f2fe);
        }

        .badge-status.negotiation {
            background: linear-gradient(135deg, #ffc107, #ff9800);
        }

        .badge-status.converted {
            background: linear-gradient(135deg, #43e97b, #38f9d7);
        }

        .badge-status.lost {
            background: linear-gradient(135deg, #dc3545, #e4606d);
        }

        .badge {
            padding: 0.35rem 0.6rem;
            font-size: 0.75rem;
            font-weight: 600;
            border-radius: 30px;
            display: inline-block;
            white-space: nowrap;
        }

        @media (min-width: 576px) {
            .badge {
                padding: 0.4rem 0.75rem;
                font-size: 0.8rem;
            }
        }

        .badge-gradient-primary {
            background: linear-gradient(to right, #da8cff, #9a55ff) !important;
            color: #ffffff !important;
        }

        .badge-gradient-success {
            background: linear-gradient(135deg, #28a745, #5cb85c) !important;
            color: #ffffff !important;
        }

        .badge-gradient-secondary {
            background: #6c757d !important;
            color: #ffffff !important;
        }

        .btn-action {
            width: 32px;
            height: 32px;
            padding: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            margin: 0 2px;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
        }

        .btn-action i {
            font-size: 1rem;
        }

        .btn-action.edit {
            background: linear-gradient(135deg, #ffc107, #ffdb6d);
            color: #2c2e3f;
        }

        .btn-action.edit:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(255, 193, 7, 0.3);
        }

        .btn-action.delete {
            background: linear-gradient(135deg, #dc3545, #e4606d);
            color: white;
        }

        .btn-action.delete:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(220, 53, 69, 0.3);
        }

        .btn-action.info {
            background: linear-gradient(135deg, #17a2b8, #5bc0de);
            color: white;
        }

        .btn-action.info:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(23, 162, 184, 0.3);
        }

        .btn-action.success {
            background: linear-gradient(135deg, #28a745, #5cb85c);
            color: white;
        }

        .btn-action.success:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(40, 167, 69, 0.3);
        }

        .customer-info {
            display: flex;
            align-items: center;
            gap: 0.65rem;
        }

        .customer-initial {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.9rem;
            font-weight: 700;
            flex-shrink: 0;
            box-shadow: 0 4px 10px rgba(102, 126, 234, 0.2);
        }

        .name-avatar {
            width: 38px !important;
            height: 38px !important;
            border-radius: 50% !important;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 0.95rem !important;
            color: #9a55ff;
            flex-shrink: 0;
            background: rgba(154, 85, 255, 0.1);
            border: 1px solid rgba(154, 85, 255, 0.2);
        }

        .info-icon {
            color: #9a55ff;
            font-size: 1rem;
            margin-right: 0.35rem;
            vertical-align: middle;
        }

        .name-avatar {
            width: 38px;
            height: 38px;
            min-width: 38px;
            border-radius: 50%;
            background: linear-gradient(135deg, #da8cff, #9a55ff);
            color: #fff;
            font-size: 0.85rem;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 12px rgba(154, 85, 255, 0.25);
        }

        .name-wrap {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .form-badge-rp {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 58px;
            padding: 0.6rem 0.9rem;
            border-radius: 8px 0 0 8px;
            background: linear-gradient(135deg, #f2ecff, #e7dbff);
            color: #7a3fcc;
            font-weight: 700;
            border: 1px solid #e9ecef;
            border-right: none;
        }

        .input-group-rp .form-control {
            border-top-left-radius: 0;
            border-bottom-left-radius: 0;
        }

        .rp-example {
            font-size: 0.75rem;
            color: #8a94a6;
            margin-top: 0.35rem;
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

        .modal-content {
            border: none;
            border-radius: 16px;
            overflow: hidden;
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
        }

        .modal-footer {
            border-top: 1px solid #e9ecef;
            padding: 1rem 1.5rem;
        }

        .modal-scroll-body {
            max-height: 70vh;
            overflow-y: auto;
            overflow-x: hidden;
            scrollbar-width: thin;
            scrollbar-color: #9a55ff #f1f1f1;
        }

        .modal-scroll-body::-webkit-scrollbar {
            width: 8px;
        }

        .modal-scroll-body::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        .modal-scroll-body::-webkit-scrollbar-thumb {
            background: linear-gradient(180deg, #da8cff, #9a55ff);
            border-radius: 10px;
        }

        .modal-scroll-body::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(180deg, #c678ff, #7f3dff);
        }

        .stat-card {
            background: linear-gradient(135deg, #ffffff, #f8f9fa);
            border-radius: 16px;
            padding: 1.2rem;
            height: 100%;
            display: flex;
            align-items: center;
            gap: 1rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            border: none;
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(154, 85, 255, 0.12);
        }

        .stat-card .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            color: white;
            flex-shrink: 0;
        }

        .stat-card .stat-icon.total {
            background: linear-gradient(135deg, #667eea, #764ba2);
        }

        .stat-card .stat-icon.prospek {
            background: linear-gradient(135deg, #ff9a9e, #f6416c);
        }

        .stat-card .stat-icon.followup {
            background: linear-gradient(135deg, #43e97b, #38f9d7);
        }

        .stat-card .stat-icon.converted {
            background: linear-gradient(135deg, #4facfe, #00f2fe);
        }

        .stat-card .stat-content {
            flex: 1;
            min-width: 0;
        }

        .stat-card .stat-content h3 {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 0.2rem;
            color: #2c2e3f;
            line-height: 1.2;
        }

        .stat-card .stat-content p {
            font-size: 0.9rem;
            color: #6c757d;
            margin-bottom: 0;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .text-primary {
            color: #9a55ff !important;
        }

        .text-danger {
            color: #dc3545 !important;
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

        @media (max-width: 768px) {
            .stat-card {
                padding: 1rem;
                gap: 0.75rem;
            }

            .stat-card .stat-icon {
                width: 45px;
                height: 45px;
                font-size: 1.4rem;
            }

            .stat-card .stat-content h3 {
                font-size: 1.3rem;
            }

            .stat-card .stat-content p {
                font-size: 0.75rem;
            }
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

        @media (max-width: 576px) {
            .stat-card {
                padding: 0.75rem;
                gap: 0.5rem;
            }

            .stat-card .stat-icon {
                width: 40px;
                height: 40px;
                font-size: 1.2rem;
            }

            .stat-card .stat-content h3 {
                font-size: 1.1rem;
            }

            .stat-card .stat-content p {
                font-size: 0.7rem;
            }
        }

        .badge-status.hot_prospect {
            background: #fee2e2;
            color: #991b1b;
        }

        .badge-status.medium_prospect {
            background: #fef3c7;
            color: #92400e;
        }

        .badge-status.cold_prospect {
            background: #dbeafe;
            color: #1e40af;
        }

        .badge-status.converted {
            background: #dcfce7;
            color: #166534;
        }

        .badge-status.lost {
            background: #f1f5f9;
            color: #475569;
        }
    </style>

    <div class="container-fluid p-2 p-sm-3 p-md-4">


        <div class="row mb-3 mb-sm-3 mb-md-4">
            <div class="col-12">
                <div class="card shadow-sm border-0">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="text-dark mb-1">
                                <i class="mdi mdi-account-group me-2" style="color: #9a55ff;"></i>Data Tamu / Proyeksi
                            </h3>
                            <p class="text-muted mb-0">
                                Kelola data pengunjung dan calon pembeli unit properti
                            </p>
                        </div>
                        <div class="d-none d-sm-block">
                            <i class="mdi mdi-account-group" style="font-size: 2.5rem; color: #9a55ff; opacity: 0.2;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-3 mb-4">
            <div class="col-6 col-md-3">
                <div class="stat-card">
                    <div class="stat-icon total">
                        <i class="mdi mdi-account-group"></i>
                    </div>
                    <div class="stat-content">
                        <h3>{{ $totalGuests ?? 0 }}</h3>
                        <p>Total Tamu / Proyeksi</p>
                    </div>
                </div>
            </div>

            <div class="col-6 col-md-3">
                <div class="stat-card">
                    <div class="stat-icon prospek">
                        <i class="mdi mdi-fire"></i>
                    </div>
                    <div class="stat-content">
                        <h3>{{ $totalProspek ?? 0 }}</h3>
                        <p>Total Proyeksi Aktif</p>
                    </div>
                </div>
            </div>

            <div class="col-6 col-md-3">
                <div class="stat-card">
                    <div class="stat-icon followup">
                        <i class="mdi mdi-phone-check"></i>
                    </div>
                    <div class="stat-content">
                        <h3>{{ $totalFollowUp ?? 0 }}</h3>
                        <p>Follow Up Hari Ini</p>
                    </div>
                </div>
            </div>

            <div class="col-6 col-md-3">
                <div class="stat-card">
                    <div class="stat-icon converted">
                        <i class="mdi mdi-handshake"></i>
                    </div>
                    <div class="stat-content">
                        <h3>{{ $guests->where('status', 'converted')->count() ?? 0 }}</h3>
                        <p>Converted / Deal</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-2 mt-sm-2 mt-md-3">
            <div class="col-12">
                <div class="card">
                    <div
                        class="card-header bg-white d-flex flex-wrap flex-md-row justify-content-between align-items-center gap-3">
                        <h5 class="card-title mb-0">
                            <i class="mdi mdi-format-list-bulleted me-2"></i>Daftar Tamu / Prospek
                        </h5>

                        <div class="header-action-group">
                            <button class="btn btn-gradient-success" onclick="$('#modalImportTamu').modal('show')">
                                <i class="mdi mdi-import"></i><span class="d-none d-sm-inline">Import</span>
                            </button>
                            <button class="btn btn-gradient-danger" onclick="$('#modalExportTamu').modal('show')">
                                <i class="mdi mdi-export"></i><span class="d-none d-sm-inline">Export</span>
                            </button>
                            <button type="button" class="btn btn-gradient-primary btn-add" data-bs-toggle="modal"
                                data-bs-target="#modalGuest">
                                <i class="mdi mdi-plus"></i><span class="d-none d-sm-inline">Tambah Proyeksi</span>
                            </button>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="filter-card mb-4">
                            <div class="card-body">
                                <div class="filter-row-desktop">
                                    <div class="filter-text">
                                        <i class="mdi mdi-filter-outline"></i>
                                        <span>Filter data tamu / prospek</span>
                                    </div>

                                    <form method="GET" action="{{ route('customer.tamu') }}" id="filterFormDesktop">
                                        <div class="row g-2 align-items-end w-100">
                                            <div class="col-md-3">
                                                <label class="form-label">Cari</label>
                                                <input type="text" class="form-control" name="search" id="searchInput"
                                                    placeholder="Nama tamu / prospek..." value="{{ request('search') }}">
                                            </div>

                                            <div class="col-md-3">
                                                <label class="form-label">Agent</label>
                                                <select class="form-control" name="agent" id="agentSelect">
                                                    <option value="">Semua Agent</option>
                                                    @foreach ($agents as $agent)
                                                        <option value="{{ $agent->id }}"
                                                            {{ request('agent') == $agent->id ? 'selected' : '' }}>
                                                            {{ $agent->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-md-2">
                                                <label class="form-label">Status</label>
                                                <select class="form-control" name="status" id="statusSelect">
                                                    <option value="">Semua Status</option>
                                                    <option value="new"
                                                        {{ request('status') == 'new' ? 'selected' : '' }}>Baru</option>
                                                    <option value="follow_up"
                                                        {{ request('status') == 'follow_up' ? 'selected' : '' }}>Sudah
                                                        Dihubungi</option>
                                                    <option value="negotiation"
                                                        {{ request('status') == 'negotiation' ? 'selected' : '' }}>
                                                        Negosiasi</option>
                                                    <option value="converted"
                                                        {{ request('status') == 'converted' ? 'selected' : '' }}>Dikonversi
                                                        / Deal</option>
                                                    <option value="lost"
                                                        {{ request('status') == 'lost' ? 'selected' : '' }}>Gagal / Batal
                                                    </option>
                                                </select>
                                            </div>

                                            <div class="col-md-2">
                                                <label class="form-label">Tampil</label>
                                                <select class="form-control" name="per_page">
                                                    <option value="10"
                                                        {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10</option>
                                                    <option value="25"
                                                        {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                                                    <option value="50"
                                                        {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                                                    <option value="100"
                                                        {{ request('per_page') == 100 ? 'selected' : '' }}>100</option>
                                                </select>
                                            </div>

                                            <div class="col-md-2">
                                                <label class="form-label invisible d-none d-md-block">Aksi</label>
                                                <div class="d-flex gap-2">
                                                    <button type="submit"
                                                        class="btn btn-gradient-primary btn-icon-only flex-fill"
                                                        title="Filter" onclick="showFilterLoading()">
                                                        <i class="mdi mdi-filter"></i>
                                                    </button>
                                                    <a href="{{ route('customer.tamu') }}"
                                                        class="btn btn-gradient-secondary btn-icon-only flex-fill"
                                                        title="Reset" onclick="showResetLoading(event)">
                                                        <i class="mdi mdi-refresh"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="filter-row-mobile">
                                    <div class="filter-text mb-2">
                                        <i class="mdi mdi-filter-outline"></i>
                                        <span>Filter data tamu / prospek</span>
                                    </div>
                                    <form method="GET" action="{{ route('customer.tamu') }}" id="filterFormMobile">
                                        <div class="row g-2">
                                            <div class="col-12 mb-2">
                                                <label class="form-label">Cari</label>
                                                <input type="text" class="form-control" name="search"
                                                    placeholder="Nama tamu / prospek..." value="{{ request('search') }}">
                                            </div>
                                            <div class="col-12 mb-2">
                                                <label class="form-label">Agent</label>
                                                <select class="form-control" name="agent">
                                                    <option value="">Semua Agent</option>
                                                    @foreach ($agents as $agent)
                                                        <option value="{{ $agent->id }}"
                                                            {{ request('agent') == $agent->id ? 'selected' : '' }}>
                                                            {{ $agent->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-12 mb-2">
                                                <label class="form-label">Status</label>
                                                <select class="form-control" name="status">
                                                    <option value="">Semua Status</option>
                                                    <option value="new"
                                                        {{ request('status') == 'new' ? 'selected' : '' }}>Baru</option>
                                                    <option value="follow_up"
                                                        {{ request('status') == 'follow_up' ? 'selected' : '' }}>Sudah
                                                        Dihubungi</option>
                                                    <option value="negotiation"
                                                        {{ request('status') == 'negotiation' ? 'selected' : '' }}>
                                                        Negosiasi</option>
                                                    <option value="converted"
                                                        {{ request('status') == 'converted' ? 'selected' : '' }}>Dikonversi
                                                        / Deal</option>
                                                    <option value="lost"
                                                        {{ request('status') == 'lost' ? 'selected' : '' }}>Gagal / Batal
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="col-12 mb-2">
                                                <label class="form-label">Tampil</label>
                                                <select class="form-control" name="per_page">
                                                    <option value="10"
                                                        {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10</option>
                                                    <option value="25"
                                                        {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                                                    <option value="50"
                                                        {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                                                    <option value="100"
                                                        {{ request('per_page') == 100 ? 'selected' : '' }}>100</option>
                                                </select>
                                            </div>
                                            <div class="col-6">
                                                <button type="submit"
                                                    class="btn btn-gradient-primary btn-icon-only-mobile w-100"
                                                    onclick="showFilterLoading()">
                                                    <i class="mdi mdi-filter"></i>
                                                </button>
                                            </div>
                                            <div class="col-6">
                                                <a href="{{ route('customer.tamu') }}"
                                                    class="btn btn-gradient-secondary btn-icon-only-mobile w-100"
                                                    onclick="showResetLoading(event)">
                                                    <i class="mdi mdi-refresh"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead>
                                    <tr>
                                        <th class="text-center" width="5%">No</th>
                                        <th class="sortable" width="15%" data-field="name"
                                            data-direction="{{ request('sortField') == 'name' ? (request('sortDirection') == 'asc' ? 'desc' : 'asc') : 'asc' }}">
                                            Nama Tamu
                                            @if (request('sortField') == 'name')
                                                <i
                                                    class="mdi mdi-{{ request('sortDirection') == 'asc' ? 'arrow-up' : 'arrow-down' }}"></i>
                                            @else
                                                <i class="mdi mdi-swap-vertical"></i>
                                            @endif
                                        </th>
                                        <th class="sortable" width="12%" data-field="phone"
                                            data-direction="{{ request('sortField') == 'phone' ? (request('sortDirection') == 'asc' ? 'desc' : 'asc') : 'asc' }}">
                                            No HP
                                            @if (request('sortField') == 'phone')
                                                <i
                                                    class="mdi mdi-{{ request('sortDirection') == 'asc' ? 'arrow-up' : 'arrow-down' }}"></i>
                                            @else
                                                <i class="mdi mdi-swap-vertical"></i>
                                            @endif
                                        </th>
                                        <th>Email</th>
                                        <th>Sumber Info</th>
                                        <th>Proyek</th>
                                        <th>Nama - Unit</th>
                                        <th>Jenis & Tipe</th>
                                        <th class="sortable" width="12%" data-field="assigned_to"
                                            data-direction="{{ request('sortField') == 'assigned_to' ? (request('sortDirection') == 'asc' ? 'desc' : 'asc') : 'asc' }}">
                                            Agent
                                            @if (request('sortField') == 'assigned_to')
                                                <i
                                                    class="mdi mdi-{{ request('sortDirection') == 'asc' ? 'arrow-up' : 'arrow-down' }}"></i>
                                            @else
                                                <i class="mdi mdi-swap-vertical"></i>
                                            @endif
                                        </th>
                                        <th class="sortable" width="10%" data-field="status"
                                            data-direction="{{ request('sortField') == 'status' ? (request('sortDirection') == 'asc' ? 'desc' : 'asc') : 'asc' }}">
                                            Status
                                            @if (request('sortField') == 'status')
                                                <i
                                                    class="mdi mdi-{{ request('sortDirection') == 'asc' ? 'arrow-up' : 'arrow-down' }}"></i>
                                            @else
                                                <i class="mdi mdi-swap-vertical"></i>
                                            @endif
                                        </th>
                                        <th class="sortable" width="12%" data-field="last_follow_up"
                                            data-direction="{{ request('sortField') == 'last_follow_up' ? (request('sortDirection') == 'asc' ? 'desc' : 'asc') : 'asc' }}">
                                            Last Follow
                                            @if (request('sortField') == 'last_follow_up')
                                                <i
                                                    class="mdi mdi-{{ request('sortDirection') == 'asc' ? 'arrow-up' : 'arrow-down' }}"></i>
                                            @else
                                                <i class="mdi mdi-swap-vertical"></i>
                                            @endif
                                        </th>
                                        <th class="sortable" width="12%" data-field="next_follow_up"
                                            data-direction="{{ request('sortField') == 'next_follow_up' ? (request('sortDirection') == 'asc' ? 'desc' : 'asc') : 'asc' }}">
                                            Next Follow
                                            @if (request('sortField') == 'next_follow_up')
                                                <i
                                                    class="mdi mdi-{{ request('sortDirection') == 'asc' ? 'arrow-up' : 'arrow-down' }}"></i>
                                            @else
                                                <i class="mdi mdi-swap-vertical"></i>
                                            @endif
                                        </th>
                                        <th class="text-center" width="10%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($guests as $index => $guest)
                                        @php
                                            $initials = collect(explode(' ', trim($guest->name)))
                                                ->filter()
                                                ->take(2)
                                                ->map(fn($word) => strtoupper(substr($word, 0, 1)))
                                                ->implode('');
                                        @endphp
                                        <tr>
                                            <td class="text-center fw-bold">{{ $index + 1 }}</td>
                                            <td>
                                                <div class="name-wrap">
                                                    <div class="name-avatar">{{ $initials ?: 'TG' }}</div>
                                                    <div class="fw-bold">{{ $guest->name }}</div>
                                                </div>
                                            </td>
                                            <td>
                                                <i class="mdi mdi-phone info-icon"></i>{{ $guest->phone }}
                                            </td>
                                            <td>
                                                <i class="mdi mdi-email-outline info-icon"></i>{{ $guest->email ?? '-' }}
                                            </td>
                                            <td>
                                                <i class="mdi mdi-bullhorn-outline info-icon"></i>{{ $guest->source }}
                                            </td>
                                            <td>
                                                <span class="icon-text">
                                                    <i class="mdi mdi-office-building info-icon"></i>
                                                    <span class="fw-bold">{{ $guest->project->name ?? '-' }}</span>
                                                </span>
                                            </td>
                                            <td>
                                                <span class="icon-text">
                                                    <i class="mdi mdi-home-outline info-icon"></i>
                                                    <span class="fw-bold">{{ $guest->unit->unit_name ?? '-' }} -
                                                        {{ $guest->unit->unit_code ?? '-' }}</span>
                                                </span>
                                            </td>
                                            <td>
                                                @if ($guest->unit)
                                                    @if (strtolower($guest->unit->jenis ?? '') == 'subsidi')
                                                        <span class="badge badge-gradient-success">
                                                            <i
                                                                class="mdi mdi-home-assistant me-1"></i>{{ $guest->unit->jenis }}/{{ $guest->unit->type ?? '-' }}
                                                        </span>
                                                    @elseif(strtolower($guest->unit->jenis ?? '') == 'komersil')
                                                        <span class="badge badge-gradient-primary">
                                                            <i
                                                                class="mdi mdi-office-building me-1"></i>{{ $guest->unit->jenis }}/{{ $guest->unit->type ?? '-' }}
                                                        </span>
                                                    @else
                                                        <span class="badge badge-gradient-secondary">
                                                            <i
                                                                class="mdi mdi-help-circle-outline me-1"></i>{{ ($guest->unit->jenis ?? '-') . '/' . ($guest->unit->type ?? '-') }}
                                                        </span>
                                                    @endif
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($guest->employee)
                                                    @php
                                                        $agentName = $guest->employee->name;
                                                        $aInitials = '';
                                                        foreach (explode(' ', trim($agentName)) as $word) {
                                                            if ($word !== '') {
                                                                $aInitials .= strtoupper(substr($word, 0, 1));
                                                            }
                                                        }
                                                        $aInitials = substr($aInitials ?: 'A', 0, 2);
                                                    @endphp
                                                    <div class="customer-info">
                                                        <div class="customer-initial">
                                                            {{ $aInitials }}
                                                        </div>
                                                        <span class="fw-bold">{{ $agentName }}</span>
                                                    </div>
                                                @else
                                                    <i class="mdi mdi-account-tie text-primary me-1"></i>
                                                    -
                                                @endif
                                            </td>
                                            <td>
                                                <span class="badge-status {{ $guest->status }}">
                                                    @if ($guest->status == 'hot_prospect')
                                                        Hot Prospect
                                                    @elseif ($guest->status == 'medium_prospect')
                                                        Medium Prospect
                                                    @elseif ($guest->status == 'cold_prospect')
                                                        Cold Prospect
                                                    @elseif ($guest->status == 'converted')
                                                        Dikonversi / Deal
                                                    @elseif ($guest->status == 'lost')
                                                        Gagal / Batal
                                                    @else
                                                        {{ ucfirst(str_replace('_', ' ', $guest->status)) }}
                                                    @endif
                                                </span>
                                            </td>
                                            <td>
                                                <i class="mdi mdi-calendar-clock info-icon"></i>
                                                {{ $guest->last_follow_up ? \Carbon\Carbon::parse($guest->last_follow_up)->format('d M Y') : '-' }}
                                            </td>
                                            <td>
                                                <i class="mdi mdi-calendar-check-outline info-icon"></i>
                                                {{ $guest->next_follow_up ? \Carbon\Carbon::parse($guest->next_follow_up)->format('d M Y') : '-' }}
                                            </td>
                                            <td class="text-center">
                                                <div class="d-flex justify-content-center gap-1">
                                                    <button class="btn-action info" title="Follow Up"
                                                        onclick="openFollowUpModal({{ $guest->id }}, '{{ addslashes($guest->name) }}')">
                                                        <i class="mdi mdi-phone-log"></i>
                                                    </button>

                                                    <form action="{{ route('costomer.guests.convert', $guest->id) }}"
                                                        method="POST" style="display:inline;"
                                                        id="convertForm{{ $guest->id }}">
                                                        @csrf
                                                        <button type="button" class="btn-action success"
                                                            title="Konversi ke Customer"
                                                            onclick="confirmConvert({{ $guest->id }}, '{{ addslashes($guest->name) }}')">
                                                            <i class="mdi mdi-account-convert"></i>
                                                        </button>
                                                    </form>

                                                    <button class="btn-action edit btnEditTamu" title="Edit"
                                                        data-id="{{ $guest->id }}">
                                                        <i class="mdi mdi-pencil"></i>
                                                    </button>

                                                    <form action="/customer/guest/{{ $guest->id }}" method="POST"
                                                        id="deleteForm{{ $guest->id }}" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn-action delete" title="Hapus"
                                                            onclick="confirmDelete({{ $guest->id }})">
                                                            <i class="mdi mdi-delete"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="13" class="text-center text-muted py-4">
                                                <i class="mdi mdi-account-off" style="font-size: 2rem; opacity: 0.3;"></i>
                                                <p class="mt-2 mb-0">Tidak ada data tamu / prospek</p>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        @if ($guests instanceof \Illuminate\Pagination\LengthAwarePaginator && $guests->total() > 0)
                            <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mt-4">
                                <div class="pagination-info mb-2 mb-sm-0">
                                    Menampilkan {{ $guests->firstItem() }} - {{ $guests->lastItem() }} dari
                                    {{ $guests->total() }} data
                                </div>
                                <nav aria-label="Page navigation">
                                    <ul class="pagination pagination-sm flex-wrap justify-content-center mb-0">
                                        {{-- Previous Page Link --}}
                                        @if ($guests->onFirstPage())
                                            <li class="page-item disabled" aria-disabled="true">
                                                <span class="page-link" aria-label="Previous">
                                                    <i class="mdi mdi-chevron-left"></i>
                                                </span>
                                            </li>
                                        @else
                                            <li class="page-item">
                                                <a class="page-link"
                                                    href="{{ $guests->appends(request()->query())->previousPageUrl() }}"
                                                    rel="prev" aria-label="Previous"
                                                    onclick="showPaginationLoading(event)">
                                                    <i class="mdi mdi-chevron-left"></i>
                                                </a>
                                            </li>
                                        @endif

                                        {{-- Pagination Elements --}}
                                        @foreach ($guests->getUrlRange(max(1, $guests->currentPage() - 2), min($guests->lastPage(), $guests->currentPage() + 2)) as $page => $url)
                                            @if ($page == $guests->currentPage())
                                                <li class="page-item active" aria-current="page">
                                                    <span class="page-link">{{ $page }}</span>
                                                </li>
                                            @else
                                                <li class="page-item">
                                                    <a class="page-link"
                                                        href="{{ $guests->appends(request()->query())->url($page) }}"
                                                        onclick="showPaginationLoading(event)">{{ $page }}</a>
                                                </li>
                                            @endif
                                        @endforeach

                                        {{-- Next Page Link --}}
                                        @if ($guests->hasMorePages())
                                            <li class="page-item">
                                                <a class="page-link"
                                                    href="{{ $guests->appends(request()->query())->nextPageUrl() }}"
                                                    rel="next" aria-label="Next"
                                                    onclick="showPaginationLoading(event)">
                                                    <i class="mdi mdi-chevron-right"></i>
                                                </a>
                                            </li>
                                        @else
                                            <li class="page-item disabled" aria-disabled="true">
                                                <span class="page-link" aria-label="Next">
                                                    <i class="mdi mdi-chevron-right"></i>
                                                </span>
                                            </li>
                                        @endif
                                    </ul>
                                </nav>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalGuest" tabindex="-1" aria-labelledby="modalGuestLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalGuestLabel">
                        <i class="mdi mdi-plus-circle me-2"></i>Tambah Tamu / Prospek
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="{{ route('customer.tamu.store') }}" method="POST">
                    @csrf


                    <div class="modal-body modal-scroll-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="name"
                                    placeholder="Masukkan nama lengkap" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Marketing Task</label>
                                <select class="form-control" name="marketing_task_id">
                                    <option value="">Pilih Task</option>
                                    @foreach ($marketingTasks as $task)
                                        <option value="{{ $task->id }}">{{ $task->nama_tugas }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">No HP <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="phone"
                                    placeholder="Masukkan nomor HP" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" placeholder="Masukkan email">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Sumber Informasi <span class="text-danger">*</span></label>
                                <select class="form-control" name="source" required>
                                    <option value="">Pilih Sumber Informasi</option>
                                    <option value="Instagram">Instagram</option>
                                    <option value="Facebook">Facebook</option>
                                    <option value="Website">Website</option>
                                    <option value="Referensi">Referensi</option>
                                    <option value="Pameran">Pameran</option>
                                    <option value="Lainnya">Lainnya</option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Proyek Minat <span class="text-danger">*</span></label>
                                <select class="form-control" name="land_bank_id" id="projectSelect" required>
                                    <option value="">Pilih Proyek</option>
                                    @foreach ($projects as $project)
                                        <option value="{{ $project->id }}">{{ $project->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tipe Unit</label>
                                <select class="form-control" name="unit_id" id="unitSelect">
                                    <option value="">Pilih Unit</option>
                                    @foreach ($units as $unit)
                                        <option value="{{ $unit->id }}" data-project="{{ $unit->land_bank_id }}">
                                            {{ $unit->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Agent <span class="text-danger">*</span></label>
                                <select class="form-control" name="assigned_to" required>
                                    <option value="">Pilih Agent</option>
                                    @foreach ($agents as $agent)
                                        <option value="{{ $agent->id }}">{{ $agent->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Status <span class="text-danger">*</span></label>
                                <select class="form-control" name="status" required>
                                    <option value="">Pilih Status</option>
                                    <option value="hot_prospect">Hot Prospek</option>
                                    <option value="medium_prospect">Medium Prospek</option>
                                    <option value="cold_prospect">Cold Prospek</option>
                                    <option value="converted">Deal / Booking</option>
                                    <option value="lost">Gagal / Batal</option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Budget</label>
                                <div class="d-flex input-group-rp">
                                    <span class="form-badge-rp">RP</span>
                                    <input type="text" class="form-control" name="budget" id="budgetInput"
                                        placeholder="1000.0000.000.00">
                                </div>
                                <small class="rp-example">Contoh: 1000.0000.000.00</small>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Next Follow Up <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" name="next_follow_up" required>
                            </div>

                            <div class="col-12 mb-3">
                                <label class="form-label">Catatan</label>
                                <textarea class="form-control" name="notes" rows="4" placeholder="Masukkan catatan tambahan"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-gradient-secondary" data-bs-dismiss="modal">
                            <i class="mdi mdi-close me-1"></i>Batal
                        </button>
                        <button type="submit" class="btn btn-gradient-primary">
                            <i class="mdi mdi-content-save me-1"></i>Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalEditTamu" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="mdi mdi-account-edit me-2"></i>Edit Data Tamu
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <form id="formEditTamu" method="POST">
                        @csrf
                        @method('PUT')

                        <input type="hidden" id="edit_id">

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                <input type="text" name="name" id="edit_name" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">No. HP <span class="text-danger">*</span></label>
                                <input type="text" name="phone" id="edit_phone" class="form-control" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" id="edit_email" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Sumber Informasi <span class="text-danger">*</span></label>
                                <select name="source" id="edit_source" class="form-control" required>
                                    <option value="">-- Pilih Sumber --</option>
                                    <option value="instagram">Instagram</option>
                                    <option value="facebook">Facebook</option>
                                    <option value="tiktok">TikTok</option>
                                    <option value="iklan">Iklan Online</option>
                                    <option value="referensi">Referensi</option>
                                    <option value="walk-in">Walk-in</option>
                                    <option value="lainnya">Lainnya</option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Agent <span class="text-danger">*</span></label>
                                <select name="assigned_to" id="edit_assigned_to" class="form-control" required>
                                    <option value="">-- Pilih Agent --</option>
                                    @foreach ($agents as $agent)
                                        <option value="{{ $agent->id }}">{{ $agent->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Status Prospek <span class="text-danger">*</span></label>
                                <select name="status" id="edit_status" class="form-control" required>
                                    <option value="new">Baru</option>
                                    <option value="follow_up">Sudah Dihubungi</option>
                                    <option value="negotiation">Negosiasi</option>
                                    <option value="converted">Dikonversi / Deal</option>
                                    <option value="lost">Gagal / Batal</option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Proyek Minat <span class="text-danger">*</span></label>
                                <select name="land_bank_id" id="edit_land_bank_id" class="form-control" required>
                                    <option value="">-- Pilih Proyek --</option>
                                    @foreach ($projects as $project)
                                        <option value="{{ $project->id }}">{{ $project->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tipe Unit</label>
                                <select name="unit_id" id="edit_unit_id" class="form-control">
                                    <option value="">-- Pilih Unit --</option>
                                    @foreach ($units as $unit)
                                        <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Last Follow Up</label>
                                <input type="datetime-local" name="last_follow_up" id="edit_last_follow_up"
                                    class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Next Follow Up <span class="text-danger">*</span></label>
                                <input type="datetime-local" name="next_follow_up" id="edit_next_follow_up"
                                    class="form-control" required>
                            </div>

                            <div class="col-12">
                                <hr style="border-color: rgba(154,85,255,0.15);">
                            </div>

                            <div class="col-12 mb-3">
                                <label class="form-label">Catatan</label>
                                <textarea name="notes" id="edit_notes" class="form-control" rows="4"
                                    placeholder="Masukkan catatan tambahan"></textarea>
                            </div>
                        </div>

                        <div class="modal-footer px-0 pb-0">
                            <button type="button" class="btn btn-gradient-secondary" data-bs-dismiss="modal">
                                <i class="mdi mdi-close me-1"></i>Batal
                            </button>
                            <button type="submit" class="btn btn-gradient-primary">
                                <i class="mdi mdi-content-save me-1"></i>Update Data
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalFollowUp" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ route('customer.tamu.followup') }}" method="POST">
                    @csrf
                    <input type="hidden" name="guest_id" id="followup_guest_id">

                    <div class="modal-header">
                        <h5 class="modal-title">
                            <i class="mdi mdi-phone-log me-2"></i>Follow Up Tamu
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Nama Tamu</label>
                            <input type="text" class="form-control" id="followup_guest_name" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Waktu Follow Up <span class="text-danger">*</span></label>
                            <input type="datetime-local" class="form-control" name="last_follow_up" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Catatan Follow Up</label>
                            <textarea class="form-control" name="notes" rows="3" placeholder="Hasil follow up..."></textarea>
                        </div>
                        <hr style="border-color: rgba(154,85,255,0.2);">
                        <div class="mb-3">
                            <label class="form-label">Jadwal Follow Up Berikutnya</label>
                            <input type="datetime-local" class="form-control" name="next_follow_up">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-gradient-secondary" data-bs-dismiss="modal">
                            <i class="mdi mdi-close me-1"></i>Batal
                        </button>
                        <button type="submit" class="btn btn-gradient-primary">
                            <i class="mdi mdi-content-save me-1"></i>Simpan Follow Up
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal Import Tamu --}}
    <div class="modal fade" id="modalImportTamu" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="mdi mdi-import me-2" style="color: #9a55ff;"></i>Import Data Tamu
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center mb-4">
                        <i class="mdi mdi-file-excel" style="font-size: 64px; color: #28a745;"></i>
                        <h6 class="mt-3">Import dari file Excel</h6>
                        <p class="text-muted small">Download template terlebih dahulu untuk memudahkan import data</p>
                    </div>

                    <div class="d-flex gap-2 mb-4">
                        <a href="#" class="btn btn-outline-success w-50">
                            <i class="mdi mdi-download me-1"></i>Download Template
                        </a>
                        <a href="#" class="btn btn-outline-info w-50">
                            <i class="mdi mdi-eye me-1"></i>Lihat Contoh
                        </a>
                    </div>

                    <div class="mb-3">
                        <label class="form-label"><i class="mdi mdi-file-upload me-1 text-primary"></i>Upload File
                            Excel</label>
                        <input type="file" class="form-control" accept=".xlsx,.xls,.csv">
                        <small class="text-muted">Format: .xlsx, .xls, .csv (Max 5MB)</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-gradient-secondary" data-bs-dismiss="modal">
                        <i class="mdi mdi-close me-1"></i>Batal
                    </button>
                    <button type="button" class="btn btn-gradient-success">
                        <i class="mdi mdi-import me-1"></i>Import Data
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Export Tamu --}}
    <div class="modal fade" id="modalExportTamu" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="mdi mdi-export me-2" style="color: #9a55ff;"></i>Export Data Tamu
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center mb-4">
                        <i class="mdi mdi-file-download" style="font-size: 64px; color: #9a55ff;"></i>
                        <h6 class="mt-3">Pilih format export</h6>
                    </div>

                    <div class="d-flex gap-3 justify-content-center">
                        <button class="btn btn-outline-success p-3" style="width: 100px;">
                            <i class="mdi mdi-file-excel" style="font-size: 32px;"></i>
                            <span class="d-block small mt-2">Excel</span>
                        </button>
                        <button class="btn btn-outline-danger p-3" style="width: 100px;">
                            <i class="mdi mdi-file-pdf" style="font-size: 32px;"></i>
                            <span class="d-block small mt-2">PDF</span>
                        </button>
                        <button class="btn btn-outline-primary p-3" style="width: 100px;">
                            <i class="mdi mdi-file-delimited" style="font-size: 32px;"></i>
                            <span class="d-block small mt-2">CSV</span>
                        </button>
                    </div>

                    <hr class="my-4">

                    <div class="mb-3">
                        <label class="form-label"><i class="mdi mdi-filter-outline me-1 text-primary"></i>Filter Data yang
                            Diexport</label>
                        <select class="form-control">
                            <option value="semua">Semua Tamu</option>
                            <option value="new">Tamu Baru</option>
                            <option value="follow_up">Sudah Dihubungi</option>
                            <option value="negotiation">Negosiasi</option>
                            <option value="converted">Jadi Booking / Beli</option>
                            <option value="lost">Batal</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-gradient-secondary" data-bs-dismiss="modal">
                        <i class="mdi mdi-close me-1"></i>Batal
                    </button>
                    <button type="button" class="btn btn-gradient-primary">
                        <i class="mdi mdi-export me-1"></i>Export Data
                    </button>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).on('click', '.btnEditTamu', function() {
            let id = $(this).data('id');

            $.ajax({
                url: '/customer/guest/' + id + '/edit',
                type: 'GET',
                success: function(data) {
                    $('#formEditTamu')[0].reset();

                    $('#edit_id').val(data.id);
                    $('#edit_name').val(data.name ?? '');
                    $('#edit_phone').val(data.phone ?? '');
                    $('#edit_email').val(data.email ?? '');
                    $('#edit_source').val(data.source ?? '');
                    $('#edit_assigned_to').val(data.assigned_to ?? '');
                    $('#edit_status').val(data.status ?? '');
                    $('#edit_land_bank_id').val(data.land_bank_id ?? '');
                    $('#edit_unit_id').val(data.unit_id ?? '');
                    $('#edit_notes').val(data.notes ?? '');

                    if (data.last_follow_up) {
                        $('#edit_last_follow_up').val(data.last_follow_up.replace(' ', 'T').substring(0,
                            16));
                    }
                    if (data.next_follow_up) {
                        $('#edit_next_follow_up').val(data.next_follow_up.replace(' ', 'T').substring(0,
                            16));
                    }

                    $('#formEditTamu').attr('action', '/customer/guest/' + data.id);

                    const modal = new bootstrap.Modal(document.getElementById('modalEditTamu'));
                    modal.show();
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: 'Data tidak dapat dimuat.',
                        confirmButtonColor: '#dc3545'
                    });
                }
            });
        });

        function openFollowUpModal(id, name) {
            document.getElementById('followup_guest_id').value = id;
            document.getElementById('followup_guest_name').value = name;
            var modal = new bootstrap.Modal(document.getElementById('modalFollowUp'));
            modal.show();
        }

        function confirmDelete(id) {
            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: 'Data tamu ini akan dihapus secara permanen.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Menghapus...',
                        html: 'Mohon tunggu sebentar',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });
                    document.getElementById('deleteForm' + id).submit();
                }
            });
        }

        function confirmConvert(id, name) {
            Swal.fire({
                title: 'Konversi ke Customer?',
                html: `Tamu <b>${name}</b> akan dikonversi menjadi customer.`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#198754',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Konversi!',
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

        function formatBudgetCustom(value) {
            let onlyNumbers = value.replace(/\D/g, '');
            if (!onlyNumbers) return '';

            let groups = [];
            while (onlyNumbers.length > 4) {
                groups.unshift(onlyNumbers.slice(-2));
                onlyNumbers = onlyNumbers.slice(0, -2);
            }
            if (onlyNumbers.length > 0) {
                groups.unshift(onlyNumbers);
            }

            return groups.join('.');
        }

        document.addEventListener('DOMContentLoaded', function() {
            const projects = @json($projects);
            const projectSelect = document.getElementById('projectSelect');
            const unitSelect = document.getElementById('unitSelect');
            const budgetInput = document.getElementById('budgetInput');

            if (projectSelect) {
                projectSelect.addEventListener('change', function() {
                    const projectId = this.value;
                    unitSelect.innerHTML = '<option value="">-- Pilih Unit --</option>';
                    const selected = projects.find(p => p.id == projectId);

                    if (selected && selected.units?.length > 0) {
                        selected.units.forEach(unit => {
                            unitSelect.innerHTML +=
                                `<option value="${unit.id}">${unit.unit_code ?? ''} - ${unit.name ?? unit.unit_name ?? ''}</option>`;
                        });
                    }
                });
            }

            if (budgetInput) {
                budgetInput.addEventListener('input', function() {
                    this.value = formatBudgetCustom(this.value);
                });
            }
        });


        // Notification Session SweetAlerts
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: "{{ session('success') }}",
                timer: 3000,
                timerProgressBar: true,
                confirmButtonText: 'OK',
                confirmButtonColor: '#9a55ff'
            });
        @endif

        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "{{ session('error') }}",
                confirmButtonColor: '#9a55ff',
                confirmButtonText: 'OK'
            });
        @endif

        // Sorting functionality
        $(document).ready(function() {
            $('#modalGuest form, #formEditTamu, #modalFollowUp form, #modalImportTamu form').on('submit',
                function() {
                    Swal.fire({
                        title: 'Memproses...',
                        text: 'Mohon tunggu sebentar',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });
                });

            $('.sortable').click(function() {
                let field = $(this).data('field');
                let direction = $(this).data('direction');

                Swal.fire({
                    title: 'Memuat...',
                    html: 'Sedang mengurutkan data',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                let url = new URL(window.location.href);
                url.searchParams.set('sortField', field);
                url.searchParams.set('sortDirection', direction);
                url.searchParams.set('page', 1);

                window.location.href = url.toString();
            });

            $('#filterFormDesktop, #filterFormMobile').on('submit', function() {
                Swal.fire({
                    title: 'Memuat...',
                    text: 'Mohon tunggu sebentar',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
            });
        });

        function showPaginationLoading(event) {
            event.preventDefault();
            Swal.fire({
                title: 'Memuat...',
                html: 'Sedang memuat halaman',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
            window.location.href = event.currentTarget.href;
        }

        function showFilterLoading() {
            Swal.fire({
                title: 'Memuat...',
                html: 'Sedang memfilter data',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
        }

        function showResetLoading(event) {
            event.preventDefault();
            Swal.fire({
                title: 'Memuat...',
                html: 'Sedang mereset filter',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
            window.location.href = event.currentTarget.href;
        }
    </script>
@endpush
