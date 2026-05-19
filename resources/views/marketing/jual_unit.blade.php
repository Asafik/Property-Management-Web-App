@extends('layouts.partial.app')

@section('title', 'Marketing Jual Unit - Property Management App')

@section('content')
    <style>
        /* ===== CSS DARI UI KEDUA (TETAP) ===== */
        .card {
            transition: all 0.3s ease;
            margin-bottom: 1rem;
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

        /* ===== STATISTICS CARDS ===== */
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
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
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

        .stat-card .stat-icon.total-unit {
            background: linear-gradient(135deg, #667eea, #764ba2);
        }

        .stat-card .stat-icon.tersedia {
            background: linear-gradient(135deg, #43e97b, #38f9d7);
        }

        .stat-card .stat-icon.booking {
            background: linear-gradient(135deg, #f6d365, #fda085);
        }

        .stat-card .stat-icon.terjual {
            background: linear-gradient(135deg, #f093fb, #f5576c);
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

        /* ===== FILTER SECTION ===== */
        .filter-card {
            background: linear-gradient(135deg, #f9f7ff, #f2ecff);
            border-radius: 12px;
            padding: 1rem;
            margin-bottom: 1.25rem;
        }

        .filter-card .card-body {
            padding: 1rem !important;
        }

        .filter-card .form-label {
            font-size: 0.85rem;
            font-weight: 600;
            color: #9a55ff !important;
            margin-bottom: 0.4rem;
            letter-spacing: 0.3px;
            white-space: nowrap;
        }

        .filter-card .form-control,
        .filter-card .form-select {
            padding: 0.5rem 0.75rem;
            font-size: 0.9rem;
            border-radius: 8px;
            height: 40px;
            border: 1px solid #e0e4e9;
            width: 100%;
        }

        .filter-card .btn {
            padding: 0.5rem 0.75rem;
            font-size: 0.85rem;
            height: 40px;
            border-radius: 8px;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
        }

        /* Form Controls */
        .form-control,
        .form-select {
            border: 1px solid #e9ecef;
            border-radius: 8px;
            padding: 0.6rem 0.8rem;
            font-size: 0.9rem;
            transition: all 0.2s ease;
            background-color: #ffffff;
            color: #2c2e3f;
            height: 40px;
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
        }

        /* Button Styling */
        .btn {
            font-size: 0.85rem;
            padding: 0.6rem 1rem;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .btn-sm {
            padding: 0.35rem 0.7rem;
            font-size: 0.8rem;
            border-radius: 6px;
            height: 32px;
        }

        .btn-gradient-primary {
            background: linear-gradient(to right, #da8cff, #9a55ff) !important;
            color: #ffffff !important;
        }

        .btn-gradient-secondary {
            background: #6c757d !important;
            color: #ffffff !important;
        }

        .btn-gradient-success {
            background: linear-gradient(135deg, #28a745, #5cb85c) !important;
            color: #ffffff !important;
        }

        .btn-gradient-danger {
            background: linear-gradient(135deg, #dc3545, #e4606d) !important;
            color: #ffffff !important;
        }

        .btn-gradient-info {
            background: linear-gradient(135deg, #17a2b8, #5bc0de) !important;
            color: #ffffff !important;
        }

        .btn-outline-primary {
            background: transparent;
            border: 1px solid #9a55ff;
            color: #9a55ff;
            padding: 0.4rem 0.75rem;
        }

        .btn-outline-primary:hover {
            background: linear-gradient(to right, #da8cff, #9a55ff);
            color: #ffffff;
            border-color: transparent;
        }

        /* Badge Styling */
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

        .badge-gradient-success {
            background: linear-gradient(135deg, #28a745, #5cb85c);
            color: #ffffff;
        }

        .badge-gradient-primary {
            background: linear-gradient(to right, #da8cff, #9a55ff) !important;
            color: #ffffff !important;
        }

        .badge-gradient-secondary {
            background: #6c757d !important;
            color: #ffffff !important;
        }

        .badge-gradient-warning {
            background: linear-gradient(135deg, #ffc107, #ffdb6d);
            color: #2c2e3f;
        }

        .badge-gradient-danger {
            background: linear-gradient(135deg, #dc3545, #e4606d);
            color: #ffffff;
        }

        /* ===== CSS DARI UI PERTAMA (UNTUK TABEL) ===== */
        .badge-soft {
            padding: 0.4rem 0.8rem;
            border-radius: 20px;
            font-weight: 700;
            font-size: 0.78rem;
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
        }

        .badge-available-subsidi {
            background: #28a745;
            color: #ffffff;
        }

        .badge-available-komersil {
            background: #0d6efd;
            color: #ffffff;
        }

        .badge-booking {
            background: #ffc107;
            color: #2c2e3f;
        }

        .badge-sold {
            background: #dc3545;
            color: #ffffff;
        }

        .badge-draft {
            background: #6c757d;
            color: #ffffff;
        }

        .price-text {
            color: #28a745 !important;
            font-weight: 700;
        }

        .fee-text {
            color: #28a745 !important;
            font-weight: 700;
        }

        .progress-wrapper {
            min-width: 200px;
        }

        .progress-row {
            display: flex;
            align-items: center;
            gap: 0.6rem;
        }

        .progress {
            flex: 1;
            height: 10px;
            border-radius: 20px;
            background: #edf0f5;
            overflow: hidden;
        }

        .progress-percent {
            min-width: 42px;
            text-align: right;
            font-size: 0.78rem;
            font-weight: 700;
            color: #6c7383;
        }

        .progress-bar-custom {
            height: 100%;
            border-radius: 20px;
        }

        .customer-info {
            display: flex;
            align-items: center;
            gap: 0.65rem;
        }

        .customer-initial {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: linear-gradient(135deg, #da8cff, #9a55ff);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.8rem;
            font-weight: 700;
            flex-shrink: 0;
            box-shadow: 0 4px 10px rgba(154, 85, 255, 0.2);
        }

        .progress-green {
            background: linear-gradient(to right, #28a745, #5dd17a);
        }

        .progress-dark-green {
            background: linear-gradient(to right, #198754, #31b87a);
        }

        .icon-text {
            display: inline-flex;
            align-items: center;
            gap: 0.45rem;
        }

        .icon-text i {
            font-size: 1rem;
            color: #9a55ff;
        }

        .btn-action {
            width: 36px;
            height: 36px;
            padding: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            margin: 0 2px;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
        }

        .btn-action i {
            font-size: 1rem;
        }

        .btn-action.view {
            background: linear-gradient(to right, #da8cff, #9a55ff);
            color: #fff;
        }

        .btn-action.customer {
            background: linear-gradient(135deg, #28a745, #5dd17a);
            color: #fff;
        }

        .btn-action.agent {
            background: linear-gradient(135deg, #ffc107, #ffdb6d);
            color: #2c2e3f;
        }

        .action-group {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.25rem;
        }

        /* ===== TABEL UTAMA: UI selaras list_pengajuan.blade.php (#tableView saja) ===== */
        #tableView .table-responsive {
            overflow-x: auto;
            overflow-y: hidden;
            -webkit-overflow-scrolling: touch;
            border-radius: 8px;
            margin-bottom: 0.5rem;
            scrollbar-width: thin;
            scrollbar-color: #9a55ff #f0f0f0;
        }

        #tableView .table-responsive::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        #tableView .table-responsive::-webkit-scrollbar-track {
            background: #f0f0f0;
            border-radius: 10px;
        }

        #tableView .table-responsive::-webkit-scrollbar-thumb {
            background: #9a55ff;
            border-radius: 10px;
        }

        #tableView .table-responsive::-webkit-scrollbar-thumb:hover {
            background: #7a3fcc;
        }

        #tableView .table-responsive::-webkit-scrollbar-corner {
            background: #f0f0f0;
        }

        #tableView .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 0;
            min-width: 1200px;
        }

        #tableView .table thead th {
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
            cursor: pointer;
            transition: all 0.2s ease;
        }

        #tableView .table thead th:hover {
            color: #7a3fcc;
        }

        #tableView .table thead th i {
            font-size: 0.8rem;
            margin-left: 4px;
            opacity: 0.5;
        }

        #tableView .table thead th.active-sort {
            color: #7a3fcc;
        }

        #tableView .table thead th.active-sort i {
            opacity: 1;
            color: #7a3fcc;
        }

        @media (min-width: 576px) {
            #tableView .table thead th {
                font-size: 0.85rem;
                padding: 0.9rem 0.6rem;
            }
        }

        @media (min-width: 768px) {
            #tableView .table thead th {
                font-size: 0.9rem;
                padding: 1rem 0.75rem;
            }
        }

        #tableView .table thead th:first-child {
            width: 40px;
            text-align: center;
        }

        #tableView .table tbody td:first-child {
            font-weight: 500;
            width: 40px;
            text-align: center;
        }

        #tableView .table tbody td {
            vertical-align: middle;
            font-size: 0.85rem;
            padding: 0.8rem 0.5rem;
            border-bottom: 1px solid #e9ecef;
            color: #2c2e3f;
            white-space: nowrap;
        }

        @media (min-width: 576px) {
            #tableView .table tbody td {
                font-size: 0.9rem;
                padding: 0.9rem 0.6rem;
            }
        }

        @media (min-width: 768px) {
            #tableView .table tbody td {
                font-size: 0.95rem;
                padding: 1rem 0.75rem;
            }
        }

        #tableView .table tbody tr:hover {
            background-color: #f8f9fa;
        }

        #tableView .customer-initial {
            width: 38px;
            height: 38px;
            font-size: 0.9rem;
        }

        /* ===== CSS LAINNYA DARI UI KEDUA ===== */
        .text-primary {
            color: #9a55ff !important;
        }

        .text-info {
            color: #17a2b8 !important;
        }

        .text-danger {
            color: #dc3545 !important;
        }

        .text-success {
            color: #28a745 !important;
        }

        .fw-bold {
            font-weight: 600 !important;
        }

        .text-muted {
            color: #a5b3cb !important;
        }

        h3.text-dark {
            font-size: 1.3rem !important;
            font-weight: 700;
            color: #2c2e3f !important;
            margin-bottom: 0.5rem !important;
        }

        @media (max-width: 576px) {
            h3.text-dark {
                font-size: 1.2rem !important;
            }
        }

        .filter-text {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: #9a55ff;
            font-weight: 700;
            font-size: 0.95rem;
            margin-bottom: 1rem;
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

        .invisible {
            visibility: hidden;
        }

        .filter-col {
            padding-left: 3px;
            padding-right: 3px;
        }

        .filter-row {
            margin-bottom: 0.5rem;
        }

        .filter-row:last-child {
            margin-bottom: 0;
        }

        .btn-filter-reset {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
            width: 100%;
            height: 40px;
        }

        /* Grid View */
        .grid-card {
            border: 1px solid #e0e4e9 !important;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.02);
        }

        .grid-card:hover {
            border-color: #9a55ff !important;
            box-shadow: 0 4px 12px rgba(154, 85, 255, 0.15) !important;
        }

        /* Pagination */
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

        /* Denah Styling */
        .denah-container {
            background: linear-gradient(135deg, #f9f7ff, #f2ecff);
            border-radius: 16px;
            padding: 2rem;
            min-height: 400px;
            position: relative !important;
        }

        .unit-box {
            position: relative;
            min-width: 70px;
            display: inline-block;
            padding: 8px 12px;
            border-radius: 50px;
            font-size: 12px;
            font-weight: 600;
            color: white;
            transition: all 0.2s ease;
        }

        .unit-box:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .type-badge-small {
            position: absolute;
            top: -8px;
            right: -8px;
            background: #000;
            color: #fff;
            font-size: 9px;
            padding: 2px 5px;
            border-radius: 50%;
            font-weight: bold;
        }

        .legend-box {
            padding: 6px 12px;
            border-radius: 4px;
            font-size: 12px;
            color: white;
        }

        /* File Upload */
        .file-upload-modern {
            position: relative;
            width: 100%;
        }

        .file-upload-modern input[type="file"] {
            position: absolute;
            opacity: 0;
            width: 100%;
            height: 100%;
            cursor: pointer;
            z-index: 2;
        }

        .file-upload-modern .file-label-modern {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            gap: 6px;
            padding: 1rem 0.6rem;
            background: linear-gradient(135deg, #f8f9fa, #f1f3f5);
            border: 2px dashed #d0d4db;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
            min-height: 100px;
        }

        @media (min-width: 576px) {
            .file-upload-modern .file-label-modern {
                flex-direction: row;
                text-align: left;
                gap: 8px;
                padding: 0.75rem 1rem;
                min-height: auto;
            }
        }

        .file-upload-modern:hover .file-label-modern {
            border-color: #9a55ff;
            background: linear-gradient(135deg, #f1f0ff, #f8f9fa);
            transform: translateY(-2px);
        }

        .file-upload-modern .file-label-modern i {
            font-size: 1.6rem;
            color: #9a55ff;
            background: rgba(154, 85, 255, 0.1);
            padding: 8px;
            border-radius: 50%;
        }

        .file-upload-modern .file-label-modern.file-selected {
            border-color: #28a745;
            background: linear-gradient(135deg, #f0fff4, #e6f7e6);
        }

        /* Siteplan */
        .siteplan-scroll-container {
            width: 100%;
            overflow: hidden !important; /* Pure viewport navigation */
            border: 2px solid #9a55ff;
            border-radius: 12px;
            background: #f8f9fa;
            max-height: 700px;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            padding: 20px;
            user-select: none;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        .siteplan-scroll-container .canvas-container {
            margin: auto !important;
        }

        #siteplanCanvas {
            display: block;
            border-radius: 8px;
            cursor: pointer;
        }

        .btn-save-position {
            background: linear-gradient(135deg, #28a745, #5cb85c);
            color: white;
            border: none;
            padding: 10px 25px;
            font-weight: 600;
            border-radius: 8px;
            margin-top: 15px;
            transition: all 0.3s ease;
        }

        .btn-save-position:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(40, 167, 69, 0.3);
        }

        /* Fullscreen Mode Styling */
        .denah-container.fullscreen-mode {
            width: 100vw !important;
            height: 100vh !important;
            max-width: 100vw !important;
            max-height: 100vh !important;
            position: fixed !important;
            top: 0 !important;
            left: 0 !important;
            z-index: 9999 !important;
            background: linear-gradient(135deg, #1e1e2f, #0f0f1a) !important;
            padding: 1.5rem !important;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            overflow-y: auto;
        }
        .denah-container.fullscreen-mode .siteplan-scroll-container {
            flex-grow: 1;
            max-height: calc(100vh - 120px) !important;
            border-color: #9a55ff;
            background: #12121e;
        }
        .denah-container.fullscreen-mode .fw-bold.text-primary {
            color: #da8cff !important;
        }
        .denah-container.fullscreen-mode .modal-detail-unit {
            background: rgba(15, 15, 26, 0.75) !important;
            backdrop-filter: blur(8px) !important;
        }

        /* Floating Siteplan Controls (Mockup Style) */
        .siteplan-floating-controls {
            position: absolute;
            top: 20px;
            right: 20px;
            z-index: 1050;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .siteplan-control-btn {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            background: #ffffff;
            border: 1px solid #e4eaf2;
            box-shadow: 0 4px 10px rgba(160, 175, 195, 0.15);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #4a5568;
            cursor: pointer;
            transition: all 0.2s ease;
            outline: none;
            padding: 0;
        }

        .siteplan-control-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(154, 85, 255, 0.15);
            border-color: #9a55ff;
            color: #9a55ff;
        }

        .siteplan-control-btn:active {
            transform: translateY(0);
        }

        .siteplan-control-btn i {
            font-size: 1.3rem;
        }

        /* Modal Detail Sederhana */
        .modal-detail-simple .modal-header {
            background: #9a55ff;
            color: white;
            border-bottom: none;
        }

        .modal-detail-simple .modal-body p {
            margin-bottom: 12px;
            padding: 8px 12px;
            background: #f8f9fa;
            border-left: 3px solid #9a55ff;
        }

        .modal-detail-simple strong {
            color: #9a55ff;
            width: 80px;
            display: inline-block;
        }

        .mdi {
            vertical-align: middle;
        }

        .btn-group .btn-outline-primary.active {
            background: linear-gradient(to right, #da8cff, #9a55ff);
            color: #ffffff;
        }

        /* Area badges */
        .info-badge-icon {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.38rem 0.75rem;
            border-radius: 999px;
            font-weight: 600;
            font-size: 0.82rem;
            white-space: nowrap;
        }

        .info-badge-icon i {
            font-size: 0.95rem;
        }

        .land-badge {
            background: linear-gradient(135deg, #fff8e1, #ffefb3);
            color: #9a6700;
        }

        .building-badge {
            background: linear-gradient(135deg, #eef2ff, #dbe4ff);
            color: #4c63d2;
        }

        /* ===== MODAL DETAIL UNIT LENGKAP STYLES (MIRRORING TIMELINE PEMBAYARAN) ===== */
        .modal-detail-unit .modal-header {
            background: linear-gradient(135deg, #da8cff, #9a55ff);
            color: white;
            border-radius: 16px 16px 0 0;
            padding: 1rem 1.5rem;
            border: none;
        }

        .modal-detail-unit .modal-title {
            color: #ffffff;
            font-weight: 600;
            font-size: 1.1rem;
        }

        .modal-detail-unit .modal-header .btn-close {
            filter: brightness(0) invert(1);
            opacity: 0.8;
        }

        .modal-detail-unit .modal-header .btn-close:hover {
            opacity: 1;
        }

        .modal-detail-unit .modal-content {
            border: none;
            border-radius: 16px;
        }

        .modal-detail-unit .modal-body {
            padding: 1.5rem;
            background: #ffffff;
        }

        .timeline-detail-card {
            background: linear-gradient(135deg, #faf7ff, #f4efff);
            border: 1px solid #eadcff;
            border-radius: 14px;
            padding: 1rem;
            margin-bottom: 1rem;
        }

        .timeline-detail-title {
            font-size: 0.95rem;
            font-weight: 700;
            color: #9a55ff;
            margin-bottom: 0.85rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .timeline-detail-item {
            background: #ffffff;
            border: 1px solid #efe6ff;
            border-radius: 10px;
            padding: 0.75rem 0.85rem;
            height: 100%;
            transition: all 0.3s ease;
        }

        .timeline-detail-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(154, 85, 255, 0.1);
            border-color: #9a55ff;
        }

        .timeline-detail-label {
            font-size: 0.75rem;
            color: #8b8fa3;
            margin-bottom: 0.2rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.35rem;
        }

        .timeline-detail-value {
            font-size: 0.92rem;
            color: #2c2e3f;
            font-weight: 700;
        }

        .timeline-detail-value.price {
            color: #28a745;
            font-weight: 800;
        }

        .timeline-detail-value.fee-text {
            color: #28a745;
            font-weight: 800;
        }

        /* Badge di dalam modal detail - pastikan icon & warna tidak ter-override */
        .timeline-detail-value .badge-soft {
            color: inherit;
        }

        .timeline-detail-value .badge-soft.badge-available-subsidi {
            color: #ffffff !important;
        }

        .timeline-detail-value .badge-soft.badge-available-komersil {
            color: #ffffff !important;
        }

        .timeline-detail-value .badge-soft.badge-booking {
            color: #2c2e3f !important;
        }

        .timeline-detail-value .badge-soft.badge-sold {
            color: #ffffff !important;
        }

        .timeline-detail-value .badge-soft.badge-draft {
            color: #ffffff !important;
        }

        .timeline-detail-value .badge-soft i.mdi {
            font-size: 1rem !important;
            color: inherit !important;
        }

        /* Name components styling */
        .name-wrap {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .name-initial {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: linear-gradient(135deg, #da8cff, #9a55ff);
            color: #fff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 0.9rem;
            flex-shrink: 0;
            box-shadow: 0 4px 12px rgba(154, 85, 255, 0.25);
        }

        .name-info {
            display: flex;
            flex-direction: column;
            line-height: 1.3;
        }

        .name-title {
            font-weight: 700;
            color: #2c2e3f;
            font-size: 0.95rem;
        }

        .info-chip {
            display: inline-flex;
            align-items: center;
            gap: 0.45rem;
            padding: 0.45rem 0.8rem;
            border-radius: 999px;
            font-size: 0.82rem;
            font-weight: 700;
            margin-right: 0.5rem;
            margin-bottom: 0.25rem;
        }

        .badge-status {
            padding: 0.45rem 0.85rem;
            border-radius: 20px;
            font-weight: 700;
            font-size: 0.82rem;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
        }

        .badge-status.active {
            background: linear-gradient(135deg, #28c76f, #48da89);
            color: #fff;
        }

        .badge-status.process {
            background: linear-gradient(135deg, #ffc107, #ffdb6d);
            color: #2c2e3f;
        }

        .badge-status.inactive {
            background: linear-gradient(135deg, #6c757d, #9aa0a6);
            color: #fff;
        }

        /* Progress Bar Enhancement */
        .progress-wrapper {
            flex: 1;
            max-width: 150px;
        }

        .progress-row {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .progress {
            height: 8px;
            border-radius: 10px;
            background: #f0f0f0;
            overflow: hidden;
            flex: 1;
        }

        .progress-bar-custom {
            height: 100%;
            border-radius: 10px;
            transition: width 0.6s ease;
        }

        .progress.active {
            background: linear-gradient(135deg, #28c76f, #48da89);
        }

        .progress.process {
            background: linear-gradient(135deg, #ffc107, #ffdb6d);
        }

        .progress-percent {
            font-size: 0.75rem;
            font-weight: 700;
            color: #6c7383;
            min-width: 35px;
            text-align: right;
        }

        /* Empty State */
        .text-center.text-muted.py-5 {
            background: linear-gradient(135deg, #f8f9fa, #f1f3f5);
            border-radius: 12px;
            margin: 1rem 0;
        }

        .text-center.text-muted.py-5 i {
            color: #9a55ff;
            opacity: 0.3;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .timeline-detail-card {
                padding: 0.75rem;
            }

            .timeline-detail-item {
                padding: 0.6rem 0.7rem;
            }

            .name-initial {
                width: 32px;
                height: 32px;
                font-size: 0.8rem;
            }

            .name-title {
                font-size: 0.85rem;
            }

            .timeline-detail-item:hover {
                transform: none;
            }
        }
    </style>

    <div class="container-fluid p-2 p-sm-3 p-md-4">
        <!-- Header Dashboard -->
        <div class="row mb-3 mb-sm-3 mb-md-4">
            <div class="col-12">
                <div class="card shadow-sm border-0">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="text-dark mb-1">
                                <i class="mdi mdi-home-group me-2" style="color: #9a55ff;"></i>
                                Marketing Jual Unit
                            </h3>
                            <p class="text-muted mb-0 small">
                                <i class="mdi mdi-information-outline me-1"></i>
                                Kelola unit-unit yang siap dipasarkan ke customer
                            </p>
                        </div>
                        <div class="d-none d-sm-block">
                            <i class="mdi mdi-home-group" style="font-size: 2.5rem; color: #9a55ff; opacity: 0.2;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="row g-3 mb-4">
            <div class="col-6 col-md-3">
                <div class="stat-card">
                    <div class="stat-icon total-unit"><i class="mdi mdi-home-group"></i></div>
                    <div class="stat-content">
                        <h3>{{ $totalUnits }}</h3>
                        <p>Total Unit</p>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-card">
                    <div class="stat-icon tersedia"><i class="mdi mdi-check-circle-outline"></i></div>
                    <div class="stat-content">
                        <h3>{{ $totalTersedia }}</h3>
                        <p>Tersedia</p>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-card">
                    <div class="stat-icon booking"><i class="mdi mdi-bookmark-check-outline"></i></div>
                    <div class="stat-content">
                        <h3>{{ $totalBooking }}</h3>
                        <p>Booking</p>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-card">
                    <div class="stat-icon terjual"><i class="mdi mdi-cash-check"></i></div>
                    <div class="stat-content">
                        <h3>{{ $totalSold }}</h3>
                        <p>Terjual</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabel Data -->
        <div class="row mt-2 mt-sm-2 mt-md-3">
            <div class="col-12">
                <div class="card">
                    <div
                        class="card-header bg-white d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
                        <h5 class="card-title mb-2 mb-md-0">
                            <i class="mdi mdi-format-list-bulleted me-2 text-primary"></i>
                            Daftar Unit
                        </h5>
                        <div class="d-flex gap-2">
                            <a href="{{ route('marketing.jual-unit.export.excel') }}"
                                class="btn btn-sm btn-gradient-success">
                                <i class="mdi mdi-export me-1"></i>
                                <span class="d-none d-sm-inline">Excel</span>
                            </a>
                            <a href="{{ route('marketing.jual-unit.export.pdf') }}" class="btn btn-sm btn-gradient-danger">
                                <i class="mdi mdi-file-pdf me-1"></i>
                                <span class="d-none d-sm-inline">PDF</span>
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Filter Section -->
                        <div class="filter-card mb-4">
                            <div class="card-body">
                                <div class="filter-text">
                                    <i class="mdi mdi-filter-outline"></i>
                                    <span>Filter data</span>
                                </div>
                                <form method="GET" action="{{ route('marketing.jual-unit') }}" id="filterForm">
                                    <!-- FILTER DESKTOP -->
                                    <div class="d-none d-md-block">
                                        <div class="row g-2 align-items-end w-100">
                                            <div class="col-md-5 filter-col">
                                                <label class="form-label"><i class="mdi mdi-magnify me-1"></i>Cari</label>
                                                <input type="text" name="search" value="{{ request('search') }}"
                                                    class="form-control" placeholder="Cari block/unit, customer, agent...">
                                            </div>
                                            <div class="col-md-2 filter-col">
                                                <label class="form-label"><i
                                                        class="mdi mdi-office-building me-1"></i>Jenis</label>
                                                <select name="jenis" class="form-control">
                                                    <option value="">Semua Jenis</option>
                                                    <option value="subsidi" {{ request('jenis') == 'subsidi' ? 'selected' : '' }}>Subsidi</option>
                                                    <option value="komersil" {{ request('jenis') == 'komersil' ? 'selected' : '' }}>Komersil</option>
                                                </select>
                                            </div>
                                            <div class="col-md-2 filter-col">
                                                <label class="form-label"><i
                                                        class="mdi mdi-chart-arc me-1"></i>Status</label>
                                                <select name="status" class="form-control">
                                                    <option value="">Semua Status</option>
                                                    <option value="ready" {{ request('status') == 'ready' ? 'selected' : '' }}>Tersedia</option>
                                                    <option value="booked" {{ request('status') == 'booked' ? 'selected' : '' }}>Booking</option>
                                                    <option value="sold" {{ request('status') == 'sold' ? 'selected' : '' }}>
                                                        Terjual</option>
                                                </select>
                                            </div>
                                            <div class="col-md-1 filter-col">
                                                <label class="form-label"><i class="mdi mdi-counter me-1"></i>Tampil</label>
                                                <select name="perPage" class="form-control">
                                                    <option value="10" {{ request('perPage') == 10 ? 'selected' : '' }}>10
                                                    </option>
                                                    <option value="25" {{ request('perPage') == 25 ? 'selected' : '' }}>25
                                                    </option>
                                                    <option value="50" {{ request('perPage') == 50 ? 'selected' : '' }}>50
                                                    </option>
                                                    <option value="100" {{ request('perPage') == 100 ? 'selected' : '' }}>100
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="col-md-2 filter-col">
                                                <label class="form-label invisible d-none d-md-block">Aksi</label>
                                                <div class="d-flex gap-2">
                                                    <button type="submit"
                                                        class="btn btn-gradient-primary btn-icon-only flex-fill"
                                                        id="filterBtn" title="Filter" onclick="showFilterLoading()">
                                                        <i class="mdi mdi-filter"></i>
                                                    </button>
                                                    <a href="{{ route('marketing.jual-unit') }}"
                                                        class="btn btn-gradient-secondary btn-icon-only flex-fill"
                                                        title="Reset" onclick="showResetLoading(event)">
                                                        <i class="mdi mdi-refresh"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- FILTER MOBILE -->
                                    <div class="d-block d-md-none">
                                        <div class="row filter-row g-1">
                                            <div class="col-12">
                                                <label class="form-label"><i class="mdi mdi-magnify me-1"></i>Cari
                                                    Unit</label>
                                                <input type="text" name="search_mobile" value="{{ request('search') }}"
                                                    class="form-control" placeholder="Cari..." id="searchMobile">
                                            </div>
                                        </div>
                                        <div class="row filter-row g-1">
                                            <div class="col-12">
                                                <label class="form-label"><i
                                                        class="mdi mdi-office-building me-1"></i>Jenis</label>
                                                <select name="jenis" class="form-control">
                                                    <option value="">Semua Jenis</option>
                                                    <option value="subsidi" {{ request('jenis') == 'subsidi' ? 'selected' : '' }}>Subsidi</option>
                                                    <option value="komersil" {{ request('jenis') == 'komersil' ? 'selected' : '' }}>Komersil</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row filter-row g-1">
                                            <div class="col-6">
                                                <label class="form-label"><i
                                                        class="mdi mdi-chart-arc me-1"></i>Status</label>
                                                <select name="status" class="form-control">
                                                    <option value="">Semua</option>
                                                    <option value="ready" {{ request('status') == 'ready' ? 'selected' : '' }}>Tersedia</option>
                                                    <option value="booked" {{ request('status') == 'booked' ? 'selected' : '' }}>Booking</option>
                                                    <option value="sold" {{ request('status') == 'sold' ? 'selected' : '' }}>
                                                        Terjual</option>
                                                </select>
                                            </div>
                                            <div class="col-6">
                                                <label class="form-label"><i class="mdi mdi-counter me-1"></i>Tampil</label>
                                                <select name="perPage" class="form-control">
                                                    <option value="10" {{ request('perPage') == 10 ? 'selected' : '' }}>10
                                                    </option>
                                                    <option value="25" {{ request('perPage') == 25 ? 'selected' : '' }}>25
                                                    </option>
                                                    <option value="50" {{ request('perPage') == 50 ? 'selected' : '' }}>50
                                                    </option>
                                                    <option value="100" {{ request('perPage') == 100 ? 'selected' : '' }}>100
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row filter-row g-1">
                                            <div class="col-12 mt-2">
                                                <div class="d-flex gap-2">
                                                    <button type="submit"
                                                        class="btn btn-gradient-primary btn-icon-only flex-fill"
                                                        id="filterBtnMobile" title="Filter" onclick="showFilterLoading()">
                                                        <i class="mdi mdi-filter"></i>
                                                    </button>
                                                    <a href="{{ route('marketing.jual-unit') }}"
                                                        class="btn btn-gradient-secondary btn-icon-only flex-fill"
                                                        title="Reset" onclick="showResetLoading(event)">
                                                        <i class="mdi mdi-refresh"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Toggle View -->
                        <div class="d-flex justify-content-end mb-3">
                            <div class="btn-group btn-group-sm" role="group">
                                <button type="button" class="btn btn-outline-primary active" id="btnTableView"
                                    onclick="switchView('table')"><i class="mdi mdi-view-list me-1"></i><span
                                        class="d-none d-sm-inline">Table</span></button>
                                <button type="button" class="btn btn-outline-primary" id="btnGridView"
                                    onclick="switchView('grid')"><i class="mdi mdi-view-grid me-1"></i><span
                                        class="d-none d-sm-inline">Grid</span></button>
                                <button type="button" class="btn btn-outline-primary" id="btnDenahView"
                                    onclick="switchView('denah')"><i class="mdi mdi-floor-plan me-1"></i><span
                                        class="d-none d-sm-inline">Denah Unit</span></button>
                                <button type="button" class="btn btn-outline-primary" id="btnSitePlandView"
                                    onclick="switchView('sitepland')"><i class="mdi mdi-floor-plan me-1"></i><span
                                        class="d-none d-sm-inline">Siteplan</span></button>
                            </div>
                        </div>

                        <!-- ========== TABLE VIEW DENGAN STYLE UI PERTAMA ========== -->
                        <div id="tableView" style="display: block;">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th>Proyek</th>
                                            <th class="sortable" data-field="block" data-direction="{{ request('sort') == 'block' ? (request('direction') == 'asc' ? 'desc' : 'asc') : 'asc' }}">
                                                Nama - Unit
                                                @if(request('sort') == 'block')
                                                    <i class="mdi mdi-{{ request('direction') == 'asc' ? 'arrow-up' : 'arrow-down' }}"></i>
                                                @else
                                                    <i class="mdi mdi-swap-vertical"></i>
                                                @endif
                                            </th>
                                            <th class="sortable" data-field="jenis" data-direction="{{ request('sort') == 'jenis' ? (request('direction') == 'asc' ? 'desc' : 'asc') : 'asc' }}">
                                                Jenis & Tipe
                                                @if(request('sort') == 'jenis')
                                                    <i class="mdi mdi-{{ request('direction') == 'asc' ? 'arrow-up' : 'arrow-down' }}"></i>
                                                @else
                                                    <i class="mdi mdi-swap-vertical"></i>
                                                @endif
                                            </th>
                                            <th class="d-none d-md-table-cell">Lokasi</th>
                                            <th>Luas Tanah</th>
                                            <th>Luas Bangunan</th>
                                            <th>Harga</th>
                                            <th>Hadap</th>
                                            <th>Status</th>
                                            <th>Status Pembangunan / Progres</th>
                                            <th class="sortable" data-field="agent_name" data-direction="{{ request('sort') == 'agent_name' ? (request('direction') == 'asc' ? 'desc' : 'asc') : 'asc' }}">
                                                Agent
                                                @if(request('sort') == 'agent_name')
                                                    <i class="mdi mdi-{{ request('direction') == 'asc' ? 'arrow-up' : 'arrow-down' }}"></i>
                                                @else
                                                    <i class="mdi mdi-swap-vertical"></i>
                                                @endif
                                            </th>
                                            <th>Fee Agent</th>
                                            <th class="sortable" data-field="customer_name" data-direction="{{ request('sort') == 'customer_name' ? (request('direction') == 'asc' ? 'desc' : 'asc') : 'asc' }}">
                                                Customer
                                                @if(request('sort') == 'customer_name')
                                                    <i class="mdi mdi-{{ request('direction') == 'asc' ? 'arrow-up' : 'arrow-down' }}"></i>
                                                @else
                                                    <i class="mdi mdi-swap-vertical"></i>
                                                @endif
                                            </th>
                                            <th>Booking Fee</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($units as $index => $unit)
                                            @php
                                                // Mapping status untuk badge soft
                                                $statusBadge = '';
                                                $statusIcon = '';
                                                $statusText = ucfirst($unit->status);
                                                if ($unit->status == 'ready' || $unit->status == 'tersedia') {
                                                    if (strtolower($unit->type) == 'subsidi') {
                                                        $statusBadge = 'badge-available-subsidi';
                                                    } else {
                                                        $statusBadge = 'badge-available-komersil';
                                                    }
                                                    $statusIcon = 'mdi-check-circle-outline';
                                                    $statusText = 'Tersedia';
                                                } elseif ($unit->status == 'sold') {
                                                    $statusBadge = 'badge-sold';
                                                    $statusIcon = 'mdi-cash-check';
                                                    $statusText = 'Terjual';
                                                } elseif ($unit->status == 'booked') {
                                                    $statusBadge = 'badge-booking';
                                                    $statusIcon = 'mdi-bookmark-check-outline';
                                                    $statusText = 'Booking';
                                                } elseif (strtolower($unit->status) == 'draft' || strtolower($unit->status) == 'draff') {
                                                    $statusBadge = 'badge-draft';
                                                    $statusIcon = 'mdi-file-document-edit-outline';
                                                    $statusText = 'Draft';
                                                } else {
                                                    $statusBadge = 'badge-soft';
                                                    $statusIcon = 'mdi-information-outline';
                                                }

                                                // Progress mapping
                                                $progressMap = [
                                                    'belum_mulai' => 0,
                                                    'pondasi' => 20,
                                                    'dinding' => 40,
                                                    'atap' => 60,
                                                    'finishing' => 80,
                                                    'selesai' => 100,
                                                ];
                                                $progress = $progressMap[$unit->construction_progress] ?? 0;
                                                $progressClass = $progress < 100 ? 'progress-green' : 'progress-dark-green';
                                            @endphp
                                            <tr>
                                                <td class="fw-bold text-center">{{ $units->firstItem() + $index }}</td>
                                                <td>
                                                    <span class="icon-text">
                                                        <i class="mdi mdi-office-building"></i>
                                                        <span class="fw-bold">{{ $unit->landBank->name ?? '-' }}</span>
                                                    </span>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <i class="mdi mdi-home-outline text-primary me-2"
                                                            style="font-size: 1.1rem;"></i>
                                                        <span class="fw-bold">
                                                            {{ $unit->unit_name ?? '-' }} -
                                                            {{ $unit->unit_code ?? (($unit->block ?? '') . ' ' . ($unit->unit_number ?? '')) }}
                                                        </span>
                                                    </div>
                                                </td>
                                                <td>
                                                    @if (strtolower($unit->jenis ?? '') == 'subsidi')
                                                        <span class="badge badge-gradient-success">
                                                            <i class="mdi mdi-home-assistant me-1"></i>{{ $unit->jenis }} -
                                                            {{ $unit->type ?? '-' }}
                                                        </span>
                                                    @elseif(strtolower($unit->jenis ?? '') == 'komersil')
                                                        <span class="badge badge-gradient-primary">
                                                            <i class="mdi mdi-office-building me-1"></i>{{ $unit->jenis }} -
                                                            {{ $unit->type ?? '-' }}
                                                        </span>
                                                    @else
                                                        <span class="badge badge-gradient-secondary">
                                                            <i
                                                                class="mdi mdi-help-circle-outline me-1"></i>{{ ($unit->jenis ?? '-') . ' - ' . ($unit->type ?? '-') }}
                                                        </span>
                                                    @endif
                                                </td>
                                                <td class="d-none d-md-table-cell">
                                                    <span class="icon-text">
                                                        <i class="mdi mdi-map-marker-outline"></i>
                                                        <span>{{ Str::limit($unit->landBank->address ?? '-', 20) }}</span>
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="info-badge-icon land-badge">
                                                        <i class="mdi mdi-arrow-expand-all"></i>{{ $unit->area ?? '-' }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="info-badge-icon building-badge">
                                                        <i class="mdi mdi-home-floor-1"></i>{{ $unit->building_area ?? '-' }} 
                                                    </span>
                                                </td>
                                                <td class="price-text">Rp {{ number_format($unit->price ?? 0, 0, ',', '.') }}
                                                </td>
                                                <td class="fw-bold"><i
                                                        class="mdi mdi-compass-outline text-primary me-1"></i>{{ $unit->facing ?? '-' }}
                                                </td>
                                                <td>
                                                    <span class="badge-soft {{ $statusBadge }}">
                                                        <i class="mdi {{ $statusIcon }}"></i>{{ $statusText }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <div class="progress-wrapper">
                                                        <div class="progress-row">
                                                            <div class="progress">
                                                                <div class="progress-bar-custom {{ $progressClass }}"
                                                                    style="width: {{ $progress }}%;"></div>
                                                            </div>
                                                            <div class="progress-percent">{{ $progress }}%</div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    @if ($unit->activeBooking && $unit->activeBooking->sales)
                                                        @php
                                                            $salesName = $unit->activeBooking->sales->name;
                                                            $sInitials = '';
                                                            foreach (explode(' ', trim($salesName)) as $word) {
                                                                if ($word !== '') {
                                                                    $sInitials .= strtoupper(substr($word, 0, 1));
                                                                }
                                                            }
                                                            $sInitials = substr($sInitials ?: 'S', 0, 2);
                                                        @endphp
                                                        <div class="customer-info">
                                                            <div class="customer-initial"
                                                                style="background: linear-gradient(135deg, #667eea, #764ba2);">
                                                                {{ $sInitials }}
                                                            </div>
                                                            <span>{{ $salesName }}</span>
                                                        </div>
                                                    @else
                                                        <i class="mdi mdi-account-tie text-primary me-1"></i>
                                                        -
                                                    @endif
                                                </td>
                                                <td class="fee-text">
                                                    Rp {{ number_format($unit->activeBooking->agent_fee ?? 0, 0, ',', '.') }}
                                                </td>
                                                <td>
                                                    @if ($unit->activeBooking && $unit->activeBooking->customer)
                                                        @php
                                                            $customerName = $unit->activeBooking->customer->full_name;
                                                            $initials = '';
                                                            foreach (explode(' ', trim($customerName)) as $word) {
                                                                if ($word !== '') {
                                                                    $initials .= strtoupper(substr($word, 0, 1));
                                                                }
                                                            }
                                                            $initials = substr($initials ?: 'C', 0, 2);
                                                        @endphp
                                                        <div class="customer-info">
                                                            <div class="customer-initial">
                                                                {{ $initials }}
                                                            </div>
                                                            <span>{{ $customerName }}</span>
                                                        </div>
                                                    @else
                                                        <i class="mdi mdi-account-outline text-primary me-1"></i>
                                                        -
                                                    @endif
                                                </td>
                                                <td class="fee-text">
                                                    Rp {{ number_format($unit->activeBooking->booking_fee ?? 0, 0, ',', '.') }}
                                                </td>
                                                <td class="text-center">
                                                    <div class="action-group">
                                                        <button class="btn-action view" title="Detail" data-bs-toggle="modal"
                                                            data-bs-target="#detailUnitModal"
                                                            data-unit_name="{{ $unit->unit_name ?? '-' }}"
                                                            data-unit="{{ $unit->unit_code }}"
                                                            data-unit_number="{{ $unit->unit_number ?? '-' }}"
                                                            data-block="{{ $unit->block ?? '-' }}"
                                                            data-jenis="{{ $unit->jenis ?? '-' }}"
                                                            data-type="{{ $unit->type ?? '-' }}"
                                                            data-address="{{ $unit->landBank->address ?? '-' }}"
                                                            data-area="{{ $unit->area ?? 0 }}"
                                                            data-building="{{ $unit->building_area ?? 0 }}"
                                                            data-price="{{ $unit->price ?? 0 }}"
                                                            data-direction="{{ $unit->facing ?? '-' }}"
                                                            data-status_raw="{{ $unit->status }}"
                                                            data-status_text="{{ $statusText }}"
                                                            data-construction="{{ $unit->construction_progress ?? 'belum_mulai' }}"
                                                            data-has_booking="{{ $unit->activeBooking ? '1' : '0' }}"
                                                            data-customer="{{ $unit->activeBooking->customer->full_name ?? '-' }}"
                                                            data-sales="{{ $unit->activeBooking->sales->name ?? '-' }}"
                                                            data-booking_date="{{ $unit->activeBooking ? \Carbon\Carbon::parse($unit->activeBooking->booking_date)->format('d F Y') : '-' }}"
                                                            data-booking_fee="{{ $unit->activeBooking->booking_fee ?? 0 }}"
                                                            data-agent_fee="{{ $unit->activeBooking->agent_fee ?? 0 }}"
                                                            data-booking_status="{{ $unit->activeBooking->status ?? '-' }}">
                                                            <i class="mdi mdi-eye"></i>
                                                        </button>
                                                        @if (auth()->user()->position_id != 4)
                                                            <button class="btn-action customer" title="Pilih Customer"
                                                                onclick="openCustomerModal({{ $unit->id }})">
                                                                <i class="mdi mdi-account-plus"></i>
                                                            </button>
                                                            <button class="btn-action agent" title="Pilih Agent"
                                                                onclick="openAgentModal({{ $unit->id }})">
                                                                <i class="mdi mdi-account-search"></i>
                                                            </button>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="16" class="text-center text-muted py-4">
                                                    <i class="mdi mdi-home-outline" style="font-size: 2rem; opacity: 0.3;"></i>
                                                    <p class="mt-2">Data unit belum tersedia</p>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- GRID VIEW -->
                        <div id="gridView" style="display: none;">
                            <div class="row g-3">
                                @forelse ($units as $unit)
                                    <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
                                        <div class="card grid-card h-100">
                                            <div class="card-body p-3">
                                                <div class="position-relative">
                                                    @if ($unit->status == 'ready' || $unit->status == 'tersedia')
                                                        <span
                                                            class="badge badge-gradient-success position-absolute top-0 end-0 m-2"><i
                                                                class="mdi mdi-check-circle me-1"></i>Tersedia</span>
                                                    @elseif($unit->status == 'sold')
                                                        <span
                                                            class="badge badge-gradient-danger position-absolute top-0 end-0 m-2"><i
                                                                class="mdi mdi-cash-check me-1"></i>Terjual</span>
                                                    @else
                                                        <span
                                                            class="badge badge-gradient-warning position-absolute top-0 end-0 m-2"><i
                                                                class="mdi mdi-clock-outline me-1"></i>{{ ucfirst($unit->status) }}</span>
                                                    @endif
                                                    <div class="text-center bg-light py-3 py-md-4 rounded">
                                                        <i class="mdi mdi-home-outline"
                                                            style="font-size: 36px; color: #9a55ff;"></i>
                                                    </div>
                                                </div>
                                                <h6 class="mt-2 fw-bold"><i
                                                        class="mdi mdi-home-variant text-primary me-1"></i>{{ $unit->unit_name ?? '-' }}
                                                    -
                                                    {{ $unit->unit_code ?? (($unit->block ?? '') . ' ' . ($unit->unit_number ?? '')) }}
                                                </h6>
                                                <p class="text-muted small mb-1"><i
                                                        class="mdi mdi-office-building me-1"></i>{{ $unit->landBank->name ?? '-' }}
                                                </p>
                                                <p class="small mb-1"><i
                                                        class="mdi mdi-ruler-square me-1"></i>{{ $unit->building_area ?? ($unit->area ?? '-') }}
                                                    mÂ² | <i class="mdi mdi-currency-usd me-1"></i>Rp
                                                    {{ number_format($unit->price ?? 0, 0, ',', '.') }}</p>

                                                <div class="mt-2 border-top pt-2">
                                                    @if($unit->activeBooking && $unit->activeBooking->customer)
                                                        @php
                                                            $customerName = $unit->activeBooking->customer->full_name;
                                                            $initials = '';
                                                            foreach (explode(' ', trim($customerName)) as $word) {
                                                                if ($word !== '') {
                                                                    $initials .= strtoupper(substr($word, 0, 1));
                                                                }
                                                            }
                                                            $initials = substr($initials ?: 'C', 0, 2);
                                                        @endphp
                                                        <div class="customer-info mb-1">
                                                            <div class="customer-initial"
                                                                style="width: 24px; height: 24px; font-size: 0.7rem;">
                                                                {{ $initials }}
                                                            </div>
                                                            <small
                                                                class="text-muted fw-bold">{{ Str::limit($customerName, 15) }}</small>
                                                        </div>
                                                    @else
                                                        <small class="text-muted d-block mb-1"><i
                                                                class="mdi mdi-account-outline me-1"></i>-</small>
                                                    @endif
                                                </div>

                                                <div class="d-flex justify-content-between align-items-center mt-1">
                                                    @if($unit->activeBooking && $unit->activeBooking->sales)
                                                        @php
                                                            $salesName = $unit->activeBooking->sales->name;
                                                            $sInitials = '';
                                                            foreach (explode(' ', trim($salesName)) as $word) {
                                                                if ($word !== '') {
                                                                    $sInitials .= strtoupper(substr($word, 0, 1));
                                                                }
                                                            }
                                                            $sInitials = substr($sInitials ?: 'S', 0, 2);
                                                        @endphp
                                                        <div class="customer-info">
                                                            <div class="customer-initial"
                                                                style="width: 24px; height: 24px; font-size: 0.7rem; background: linear-gradient(135deg, #667eea, #764ba2);">
                                                                {{ $sInitials }}
                                                            </div>
                                                            <small
                                                                class="text-muted fw-bold">{{ Str::limit($salesName, 15) }}</small>
                                                        </div>
                                                    @else
                                                        <small class="text-muted"><i class="mdi mdi-account-tie me-1"></i>-</small>
                                                    @endif
                                                    <button class="btn btn-outline-danger btn-sm"
                                                        onclick="openCustomerModal({{ $unit->id }})"><i
                                                            class="mdi mdi-account-plus"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="col-12">
                                        <div class="text-center text-muted py-5"><i class="mdi mdi-home-outline"
                                                style="font-size: 3rem; opacity: 0.3;"></i>
                                            <p class="mt-3">Belum ada unit tersedia</p>
                                        </div>
                                    </div>
                                @endforelse
                            </div>
                        </div>

                        <!-- DENAH VIEW -->
                        <div id="denahView" style="display: none;">
                            <div class="denah-container">
                                <div style="display:flex; flex-wrap:wrap; justify-content:center; gap:10px;">
                                    @php
                                        $unitsByProject = $units->groupBy(function ($item) {
                                            return $item->landBank->name ?? 'Tanpa Proyek'; });
                                    @endphp
                                    @foreach ($unitsByProject as $projectName => $projectUnits)
                                        @php
                                            $blokKavlings = [];
                                            foreach ($projectUnits as $unit) {
                                                $blok = explode('.', $unit->unit_code)[0];
                                                $blokKavlings[$blok][] = $unit;
                                            }
                                            $allBloks = array_keys($blokKavlings);
                                        @endphp
                                        <div
                                            style="margin-bottom: 25px; width:100%; border-bottom: 1px dashed #9a55ff; padding-bottom: 15px;">
                                            <h6 class="text-primary mb-3"><i class="mdi mdi-office-building me-2"></i>Proyek:
                                                {{ $projectName }}</h6>
                                            @foreach ($allBloks as $blok)
                                                <div style="margin-bottom:15px; width:100%;">
                                                    @php
                                                        $typesInBlok = collect($blokKavlings[$blok])->pluck('type')->unique()->values()->toArray();
                                                        $typeLetters = [];
                                                        foreach ($typesInBlok as $type) {
                                                            if ($type == 'subsidi')
                                                                $typeLetters[] = 'S';
                                                            elseif ($type == 'komersil')
                                                                $typeLetters[] = 'K';
                                                        }
                                                        $labelType = implode(' & ', $typeLetters);
                                                    @endphp
                                                    <strong style="font-size: 14px;">Blok {{ $blok }} - {{ $labelType }} <small
                                                            class="text-muted ms-2">({{ count($blokKavlings[$blok]) }}
                                                            unit)</small></strong>
                                                    <div
                                                        style="display:flex; flex-wrap:wrap; gap:8px; justify-content:flex-start; margin-top:8px;">
                                                        @php
                                                            $numbers = [];
                                                            foreach ($blokKavlings[$blok] as $unit) {
                                                                $numbers[] = (int) explode('.', $unit->unit_code)[1];
                                                            }
                                                            $maxNum = max($numbers);
                                                        @endphp
                                                        @for ($i = 1; $i <= $maxNum; $i++)
                                                            @php
                                                                $unitFound = collect($blokKavlings[$blok])->firstWhere('unit_code', $blok . '.' . $i);
                                                                $bgColor = '#6c757d';
                                                                $icon = 'close';
                                                                $borderStyle = 'none';
                                                                $extraStyle = '';
                                                                $typeBadge = '';
                                                                if ($unitFound) {
                                                                    switch ($unitFound->status) {
                                                                        case 'sold':
                                                                            $bgColor = '#dc3545';
                                                                            $icon = 'check';
                                                                            break;
                                                                        case 'booked':
                                                                            $bgColor = '#ffc107';
                                                                            $icon = 'clock';
                                                                            break;
                                                                        case 'ready':
                                                                            if ($unitFound->type == 'subsidi') {
                                                                                $bgColor = '#28a745';
                                                                                $typeBadge = 'S';
                                                                            } else {
                                                                                $bgColor = '#0d6efd';
                                                                                $typeBadge = 'K';
                                                                            }
                                                                            $icon = 'home';
                                                                            break;
                                                                    }
                                                                    switch ($unitFound->construction_progress) {
                                                                        case 'belum_mulai':
                                                                            $borderStyle = '2px dashed #000';
                                                                            $extraStyle = 'background-image: repeating-linear-gradient(45deg, rgba(255,255,255,0.2), rgba(255,255,255,0.2) 5px, transparent 5px, transparent 10px);';
                                                                            break;
                                                                        case 'pondasi':
                                                                            $borderStyle = '2px solid #000';
                                                                            break;
                                                                        case 'dinding':
                                                                            $borderStyle = '3px solid #000';
                                                                            break;
                                                                        case 'atap':
                                                                            $borderStyle = '3px double #000';
                                                                            break;
                                                                        case 'finishing':
                                                                            $borderStyle = '3px groove #000';
                                                                            break;
                                                                        case 'selesai':
                                                                            $borderStyle = '3px solid #155724';
                                                                            break;
                                                                    }
                                                                }
                                                            @endphp
                                                            <span class="unit-box"
                                                                style="background-color: {{ $bgColor }}; border: {{ $borderStyle }}; {{ $extraStyle }}"
                                                                title="{{ $unitFound ? $unitFound->unit_code . ' - ' . ucfirst($unitFound->status) : 'Unit ' . $blok . '.' . $i . ' belum tersedia' }}">
                                                                @if ($typeBadge)<span
                                                                class="type-badge-small">{{ $typeBadge }}</span>@endif
                                                                <i class="mdi mdi-{{ $icon }} me-1"></i>{{ $blok . '.' . $i }}
                                                            </span>
                                                        @endfor
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endforeach
                                </div>
                                <div class="mt-5 pt-3 border-top">
                                    <h6 class="mb-3">Keterangan:</h6>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <h6 class="small fw-bold">Status Penjualan:</h6>
                                            <div class="d-flex flex-wrap gap-2 mb-3"><span
                                                    class="legend-box bg-danger">Sold</span><span
                                                    class="legend-box bg-warning text-dark">Booked</span><span
                                                    class="legend-box bg-success">Ready - Subsidi</span><span
                                                    class="legend-box bg-primary">Ready - Komersil</span><span
                                                    class="legend-box" style="background-color:#6c757d;">Belum
                                                    Tersedia</span></div>
                                        </div>
                                        <div class="col-md-4">
                                            <h6 class="small fw-bold">Progress Pembangunan (Border):</h6>
                                            <div class="d-flex flex-wrap gap-2 mb-3"><span
                                                    style="border:2px dashed #000; padding:4px 8px; background:#f8f9fa;">Belum
                                                    Mulai</span><span
                                                    style="border:2px solid #000; padding:4px 8px; background:#f8f9fa;">Pondasi</span><span
                                                    style="border:3px solid #000; padding:4px 8px; background:#f8f9fa;">Dinding</span><span
                                                    style="border:3px double #000; padding:4px 8px; background:#f8f9fa;">Atap</span><span
                                                    style="border:3px groove #000; padding:4px 8px; background:#f8f9fa;">Finishing</span><span
                                                    style="border:3px solid #155724; padding:4px 8px; background:#f8f9fa;">Selesai</span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <h6 class="small fw-bold">Tipe Unit:</h6>
                                            <div class="d-flex gap-2"><span class="badge bg-success">S = Subsidi</span><span
                                                    class="badge bg-primary">K = Komersil</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- SITEPLAN VIEW -->
                        <div id="sitePlandView" style="display: none;">
                            <div class="denah-container" style="padding: 1rem;">
                                <!-- Floating Controls (Vertical Stack matching user's image) -->
                                <div class="siteplan-floating-controls">
                                    <button type="button" class="siteplan-control-btn" onclick="zoom(1.2)" title="Zoom In">
                                        <i class="mdi mdi-plus"></i>
                                    </button>
                                    <button type="button" class="siteplan-control-btn" onclick="zoom(0.8)" title="Zoom Out">
                                        <i class="mdi mdi-minus"></i>
                                    </button>
                                    <button type="button" class="siteplan-control-btn" onclick="resetZoom()" title="Reset Zoom" style="position: relative;">
                                        <i class="mdi mdi-refresh"></i>
                                        <span id="zoomPercent" class="badge bg-primary text-white" style="position: absolute; bottom: -5px; right: -5px; font-size: 0.65rem; padding: 2px 4px; border-radius: 4px;">63%</span>
                                    </button>
                                    <button type="button" class="siteplan-control-btn" id="btnFullscreen" onclick="toggleFullscreen()" title="Fullscreen">
                                        <i class="mdi mdi-fullscreen"></i>
                                    </button>
                                </div>
                                <div class="siteplan-scroll-container">
                                    <canvas id="siteplanCanvas"></canvas>
                                </div>
                                <div class="mt-4 text-center">
                                    <button type="button" class="btn btn-save-position" onclick="savePosition()"><i
                                            class="mdi mdi-content-save me-2"></i>Simpan Posisi Unit</button>
                                </div>
                            </div>
                        </div>

                        <!-- Modal Detail Unit Lengkap -->
                        <div class="modal fade modal-detail-unit" id="detailUnitModal" tabindex="-1">
                            <div class="modal-dialog modal-xl modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">
                                            <i class="mdi mdi-home-circle me-2"></i>
                                            Detail Unit Lengkap
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Informasi Unit -->
                                        <div class="timeline-detail-card">
                                            <div class="timeline-detail-title">
                                                <i class="mdi mdi-home-outline me-1"></i>Informasi Unit
                                            </div>
                                            <div class="row g-3">
                                                <div class="col-md-4">
                                                    <div class="timeline-detail-item">
                                                        <div class="timeline-detail-label"><i class="mdi mdi-home-outline"></i>Nama Unit</div>
                                                        <div class="timeline-detail-value" id="m_unit_name">-</div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="timeline-detail-item">
                                                        <div class="timeline-detail-label"><i class="mdi mdi-alpha-b-box-outline"></i>Blok</div>
                                                        <div class="timeline-detail-value" id="m_block">-</div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="timeline-detail-item">
                                                        <div class="timeline-detail-label"><i class="mdi mdi-numeric"></i>Nomor Unit</div>
                                                        <div class="timeline-detail-value" id="m_unit_number">-</div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="timeline-detail-item">
                                                        <div class="timeline-detail-label"><i class="mdi mdi-format-list-bulleted-type"></i>Jenis Unit</div>
                                                        <div class="timeline-detail-value" id="m_jenis">-</div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="timeline-detail-item">
                                                        <div class="timeline-detail-label"><i class="mdi mdi-home-group"></i>Tipe Unit</div>
                                                        <div class="timeline-detail-value" id="m_type">-</div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="timeline-detail-item">
                                                        <div class="timeline-detail-label"><i class="mdi mdi-ruler-square"></i>Luas Tanah</div>
                                                        <div class="timeline-detail-value" id="m_area">-</div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="timeline-detail-item">
                                                        <div class="timeline-detail-label"><i class="mdi mdi-home-city-outline"></i>Luas Bangunan</div>
                                                        <div class="timeline-detail-value" id="m_building">-</div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="timeline-detail-item">
                                                        <div class="timeline-detail-label"><i class="mdi mdi-cash-outline"></i>Harga</div>
                                                        <div class="timeline-detail-value price" id="m_price">-</div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="timeline-detail-item">
                                                        <div class="timeline-detail-label"><i class="mdi mdi-compass-outline"></i>Arah Hadap</div>
                                                        <div class="timeline-detail-value" id="m_direction">-</div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="timeline-detail-item">
                                                        <div class="timeline-detail-label"><i class="mdi mdi-toggle-switch-outline"></i>Status Unit</div>
                                                        <div class="timeline-detail-value" id="m_status">-</div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="timeline-detail-item">
                                                        <div class="timeline-detail-label"><i class="mdi mdi-progress-check"></i>Status Pembangunan</div>
                                                        <div class="timeline-detail-value">
                                                            <div class="progress-wrapper" id="m_construction_wrapper">
                                                                <div class="progress-row">
                                                                    <div class="progress">
                                                                        <div class="progress-bar-custom progress-green" id="m_progress_bar" style="width: 0%"></div>
                                                                    </div>
                                                                    <span class="progress-percent" id="m_progress_pct">0%</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="timeline-detail-item">
                                                        <div class="timeline-detail-label"><i class="mdi mdi-map-marker-outline"></i>Alamat</div>
                                                        <div class="timeline-detail-value" id="m_address">-</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Informasi Booking -->
                                        <div class="timeline-detail-card" id="m_booking_card">
                                            <div class="timeline-detail-title">
                                                <i class="mdi mdi-calendar-check-outline me-1"></i>Informasi Booking
                                            </div>
                                            <div class="row g-3">
                                                <div class="col-md-6">
                                                    <div class="timeline-detail-item">
                                                        <div class="timeline-detail-label"><i class="mdi mdi-account-outline"></i>Customer</div>
                                                        <div class="timeline-detail-value">
                                                            <div class="name-wrap">
                                                                <div class="name-initial" id="m_customer_initial" style="background: linear-gradient(135deg, #da8cff, #9a55ff);">-</div>
                                                                <div class="name-info"><div class="name-title" id="m_customer">-</div></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="timeline-detail-item">
                                                        <div class="timeline-detail-label"><i class="mdi mdi-account-tie-outline"></i>Sales / Agency</div>
                                                        <div class="timeline-detail-value">
                                                            <div class="name-wrap">
                                                                <div class="name-initial" id="m_sales_initial" style="background: linear-gradient(135deg, #667eea, #764ba2);">-</div>
                                                                <div class="name-info"><div class="name-title" id="m_sales">-</div></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="timeline-detail-item">
                                                        <div class="timeline-detail-label"><i class="mdi mdi-calendar-today"></i>Tanggal Booking</div>
                                                        <div class="timeline-detail-value" id="m_booking_date">-</div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="timeline-detail-item">
                                                        <div class="timeline-detail-label"><i class="mdi mdi-cash-multiple"></i>Booking Fee</div>
                                                        <div class="timeline-detail-value fee-text" id="m_booking_fee">-</div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="timeline-detail-item">
                                                        <div class="timeline-detail-label"><i class="mdi mdi-hand-coin-outline"></i>Agent Fee</div>
                                                        <div class="timeline-detail-value fee-text" id="m_agent_fee">-</div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="timeline-detail-item">
                                                        <div class="timeline-detail-label"><i class="mdi mdi-toggle-switch"></i>Status Booking</div>
                                                        <div class="timeline-detail-value" id="m_booking_status">-</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Placeholder jika tidak ada booking -->
                                        <div class="timeline-detail-card" id="m_no_booking_card" style="display:none;">
                                            <div class="text-center text-muted py-5">
                                                <i class="mdi mdi-information-outline" style="font-size: 3rem;"></i>
                                                <p class="mb-0">Belum ada booking untuk unit ini.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal Detail Sederhana untuk Siteplan -->
                        <div class="modal fade" id="myModal" tabindex="-1">
                            <div class="modal-dialog modal-sm modal-dialog-centered">
                                <div class="modal-content modal-detail-simple">
                                    <div class="modal-header">
                                        <h5 class="modal-title"><i class="mdi mdi-home-circle me-2"></i>Detail Unit</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p><strong>Unit Code:</strong><span class="unit-code">-</span></p>
                                        <p><strong>Status:</strong><span class="unit-status">-</span></p>
                                        <p><strong>Posisi:</strong><span class="unit-pos">-</span></p>
                                        <p><strong>Ukuran:</strong><span class="unit-size">-</span></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pagination -->
                        @if ($units->count() > 0)
                            <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mt-3">
                                <div class="pagination-info mb-2 mb-sm-0"><i
                                        class="mdi mdi-information-outline me-1"></i>Menampilkan {{ $units->firstItem() }} -
                                    {{ $units->lastItem() }} dari {{ $units->total() }} data</div>
                                <nav aria-label="Page navigation">
                                    <ul class="pagination pagination-sm flex-wrap justify-content-center mb-0"
                                        style="gap: 2px;">
                                        @if ($units->onFirstPage())
                                            <li class="page-item disabled"><span class="page-link"><i
                                                        class="mdi mdi-chevron-left"></i></span></li>
                                        @else<li class="page-item"><a class="page-link"
                                            href="{{ $units->previousPageUrl() }}"><i class="mdi mdi-chevron-left"></i></a>
                                        </li>@endif
                                        @foreach ($units->getUrlRange(1, $units->lastPage()) as $page => $url)
                                            <li class="page-item {{ $units->currentPage() == $page ? 'active' : '' }}"><a
                                                    class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                                        @endforeach
                                        @if ($units->hasMorePages())
                                            <li class="page-item"><a class="page-link" href="{{ $units->nextPageUrl() }}"><i
                                                        class="mdi mdi-chevron-right"></i></a></li>
                                        @else<li class="page-item disabled"><span class="page-link"><i
                                        class="mdi mdi-chevron-right"></i></span></li>@endif
                                    </ul>
                                </nav>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!-- MODAL CUSTOMER -->
        <div class="modal fade" id="modalCustomer" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><i class="mdi mdi-account-multiple me-2" style="color: #9a55ff;"></i>Data
                            Customer</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="card mb-3 border-0 shadow-sm">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold"><i
                                                class="mdi mdi-cash-multiple text-primary me-1"></i>Booking Fee <span
                                                class="text-danger">*</span></label>
                                        <div class="input-group"><span class="input-group-text bg-white">Rp</span><input
                                                type="text" class="form-control" id="booking_fee" name="booking_fee"
                                                placeholder="Masukkan booking fee" autocomplete="off"></div>
                                        <small class="text-muted">Nominal booking fee yang dibayar customer</small>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold"><i
                                                class="mdi mdi-cloud-upload text-primary me-1"></i>Upload Bukti Transfer
                                            <span class="text-danger">*</span></label>
                                        <div class="file-upload-modern">
                                            <input type="file" id="bukti_transfer" name="bukti_transfer"
                                                accept=".jpg,.jpeg,.png,.pdf">
                                            <div class="file-label-modern" id="buktiLabel">
                                                <i class="mdi mdi-cloud-upload"></i>
                                                <div class="file-info-modern"><span id="buktiFileName">Upload Bukti
                                                        Transfer</span><small>Format: JPG, PNG, PDF (Max 2MB)</small></div>
                                                <span class="file-size" id="buktiFileSize"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-12"><small class="text-muted"><i
                                                class="mdi mdi-information-outline me-1"></i>Pilih customer lalu klik metode
                                            pembayaran (Cash/KPR)</small></div>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-3 border-0 shadow-sm">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-8"><label class="form-label fw-bold"><i
                                                class="mdi mdi-magnify text-primary me-1"></i>Cari Customer</label><input
                                            type="text" id="searchCustomer" class="form-control"
                                            placeholder="Cari nama, ID, atau no. HP customer..."></div>
                                    <div class="col-md-4"><label class="form-label fw-bold"><i
                                                class="mdi mdi-briefcase text-primary me-1"></i>Filter
                                            Pekerjaan</label><select class="form-control" id="filterPekerjaan">
                                            <option value="">Semua Pekerjaan</option>
                                            @php $uniqueJobs = collect($customers)->pluck('job_status')->unique()->filter(); @endphp
                                            @foreach ($uniqueJobs as $job)<option value="{{ $job }}">{{ $job }}</option>
                                            @endforeach
                                        </select></div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-2"><span
                                class="text-muted small"><i class="mdi mdi-account-multiple me-1"></i>Total:
                                {{ count($customers) }} customer</span><span class="badge badge-gradient-info"><i
                                    class="mdi mdi-information-outline me-1"></i>Klik tombol Cash/KPR untuk memilih</span>
                        </div>
                        <div class="table-responsive"
                            style="max-height: 350px; overflow-y: auto; border: 1px solid #e9ecef; border-radius: 8px;">
                            <table class="table table-bordered align-middle mb-0" id="customerTable">
                                <thead class="table-light" style="position: sticky; top: 0; background: white; z-index: 5;">
                                    <tr>
                                        <th class="text-center" style="width: 50px;">No</th>
                                        <th>ID Customer</th>
                                        <th>Nama</th>
                                        <th>No HP</th>
                                        <th>Pekerjaan</th>
                                        <th class="text-center" style="width: 160px;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($customers as $c)
                                        <tr>
                                            <td class="text-center fw-bold">{{ $loop->iteration }}</td>
                                            <td><span class="badge bg-light text-dark">{{ $c->customer_id ?? '-' }}</span></td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-2"
                                                        style="width: 32px; height: 32px; font-size: 12px; background: linear-gradient(135deg, #da8cff, #9a55ff) !important;">
                                                        {{ strtoupper(substr($c->full_name ?? 'C', 0, 1)) }}</div><span
                                                        class="fw-medium">{{ $c->full_name ?? '-' }}</span>
                                                </div>
                                            </td>
                                            <td><i class="mdi mdi-whatsapp text-success me-1"></i>{{ $c->phone ?? '-' }}</td>
                                            <td>@if($c->job_status)<span class="badge bg-light text-dark"><i
                                            class="mdi mdi-briefcase-outline me-1"></i>{{ $c->job_status === 'Lainnya' ? ($c->job_status_lainnya ?: '-') : $c->job_status }}</span>@else<span
                                                        class="text-muted">-</span>@endif</td>
                                            <td class="text-center">
                                                <div class="d-flex gap-1 justify-content-center"><button type="button"
                                                        class="btn btn-sm btn-success pilihCustomer" data-id="{{ $c->id }}"
                                                        data-type="cash" style="padding: 0.25rem 0.75rem;"><i
                                                            class="mdi mdi-cash me-1"></i>Cash Keras</button><button
                                                        type="button" class="btn btn-sm btn-info pilihCustomer"
                                                        data-id="{{ $c->id }}" data-type="cash_tempo"
                                                        style="padding: 0.25rem 0.75rem;"><i
                                                            class="mdi mdi-cash-multiple me-1"></i>Cash Tempo</button><button
                                                        type="button" class="btn btn-sm btn-primary pilihCustomer"
                                                        data-id="{{ $c->id }}" data-type="kpr"
                                                        style="padding: 0.25rem 0.75rem;"><i
                                                            class="mdi mdi-bank me-1"></i>KPR</button></div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center py-4"><i class="mdi mdi-account-off"
                                                    style="font-size: 2rem; opacity: 0.3;"></i>
                                                <p class="mt-2 text-muted">Tidak ada data customer</p>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- MODAL AGENCY -->
        <div class="modal fade" id="modalAgency" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><i class="mdi mdi-office-building me-2" style="color: #9a55ff;"></i>Pilih
                            Agency</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="card mb-3 border-0 shadow-sm">
                            <div class="card-body">
                                <form id="formAgency" method="POST">@csrf<input type="hidden" name="sales_id" id="sales_id">
                                    <div class="row">
                                        <div class="col-md-6"><label class="form-label fw-bold"><i
                                                    class="mdi mdi-cash text-primary me-1"></i>Agent Fee</label>
                                            <div class="input-group"><span class="input-group-text bg-white">Rp</span><input
                                                    type="text" class="form-control" name="agent_fee" id="agent_fee_modal"
                                                    placeholder="Masukkan agent fee" autocomplete="off"></div><small
                                                class="text-muted"><i class="mdi mdi-information-outline me-1"></i>Masukkan
                                                nominal fee untuk agency yang dipilih</small>
                                        </div>
                                        <div class="col-md-6"><label class="form-label fw-bold"><i
                                                    class="mdi mdi-magnify text-primary me-1"></i>Cari Agency</label>
                                            <div class="position-relative"><i class="mdi mdi-magnify position-absolute"
                                                    style="left: 12px; top: 10px; color: #9a55ff; z-index: 10;"></i><input
                                                    type="text" id="searchAgency" class="form-control"
                                                    placeholder="Cari nama agency..." style="padding-left: 40px;"></div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-2"><span
                                class="text-muted small"><i class="mdi mdi-office-building me-1"></i>Total:
                                {{ count($agencies) }} agency</span><span class="badge badge-gradient-info"><i
                                    class="mdi mdi-information-outline me-1"></i>Klik tombol Pilih untuk memilih
                                agency</span></div>
                        <div class="table-responsive"
                            style="max-height: 400px; overflow-y: auto; border: 1px solid #e9ecef; border-radius: 8px;">
                            <table class="table table-bordered align-middle mb-0">
                                <thead class="table-light" style="position: sticky; top: 0; background: white; z-index: 5;">
                                    <tr>
                                        <th class="text-center" style="width: 50px;">No</th>
                                        <th>Nama Agency</th>
                                        <th>No HP</th>
                                        <th>Alamat</th>
                                        <th class="text-center" style="width: 120px;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($agencies as $a)
                                                        <tr>
                                                            <td class="text-center fw-bold">{{ $loop->iteration }}</td>
                                                            <td>
                                                                <div class="d-flex align-items-center">
                                                                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-2"
                                                                        style="width: 32px; height: 32px; font-size: 12px; background: linear-gradient(135deg, #da8cff, #9a55ff) !important;">
                                                                        {{ strtoupper(substr($a->name ?? 'A', 0, 1)) }}</div><span
                                                                        class="fw-medium">{{ $a->name }}</span>
                                                                </div>
                                                            </td>
                                                            <td><i class="mdi mdi-phone text-success me-1"></i>{{ $a->phone }}
                                            </div>
                                        </div>
                                        </td>
                                        <td><i class="mdi mdi-map-marker text-danger me-1"></i>{{ $a->address }}</td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-sm btn-gradient-success pilihAgency" data-id="{{ $a->id }}"
                                                style="border-radius: 20px; padding: 0.25rem 1rem;"><i
                                                    class="mdi mdi-check me-1"></i>Pilih</button>
                                        </td>
                                        </tr>
                                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4"><i class="mdi mdi-office-building-off"
                                    style="font-size: 2rem; opacity: 0.3;"></i>
                                <p class="mt-2 text-muted">Tidak ada data agency</p>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>

    <!-- Form tersembunyi untuk submit customer -->
    <form id="formBooking" method="POST" enctype="multipart/form-data" style="display: none;">
        @csrf
        <input type="hidden" name="customer_id" id="customer_id">
        <input type="hidden" name="purchase_type" id="purchase_type">
        <input type="hidden" name="booking_fee" id="booking_fee_hidden">
        <input type="file" name="bukti_transfer" id="bukti_transfer_hidden">
    </form>
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/5.3.0/fabric.min.js"></script>

    <script>
        // ========== POPULATE DETAIL MODAL DIRECTLY ==========
        window.populateModalDirectly = function (data) {
            // ---- Informasi Unit ----
            document.getElementById('m_unit_name').innerText   = data.unitName || '-';
            document.getElementById('m_block').innerText       = data.block || '-';
            document.getElementById('m_unit_number').innerText = data.unitNumber || '-';
            document.getElementById('m_jenis').innerText       = data.jenis || '-';
            document.getElementById('m_type').innerText        = data.type || '-';
            document.getElementById('m_area').innerText        = new Intl.NumberFormat('id-ID').format(data.area || 0) + ' m\u00b2';
            document.getElementById('m_building').innerText    = new Intl.NumberFormat('id-ID').format(data.building || 0) + ' m\u00b2';
            document.getElementById('m_price').innerText       = 'Rp ' + new Intl.NumberFormat('id-ID').format(data.price || 0);
            document.getElementById('m_direction').innerText   = data.direction || '-';
            document.getElementById('m_address').innerText     = data.address || '-';

            // ---- Badge Status Unit ----
            const statusRaw  = data.statusRaw || '';
            const statusText = data.statusText || statusRaw;
            const jenisRaw   = (data.jenis || '').toLowerCase();
            const typeRaw    = (data.type || '').toLowerCase();
            let statusBadgeHtml = '';
            if (statusRaw === 'ready' || statusRaw === 'tersedia') {
                const cls = (jenisRaw === 'subsidi' || typeRaw === 'subsidi') ? 'badge-available-subsidi' : 'badge-available-komersil';
                statusBadgeHtml = `<span class="badge-soft ${cls}"><i class="mdi mdi-check-circle-outline"></i>Tersedia</span>`;
            } else if (statusRaw === 'booked') {
                statusBadgeHtml = `<span class="badge-soft badge-booking"><i class="mdi mdi-bookmark-check-outline"></i>Booking</span>`;
            } else if (statusRaw === 'sold') {
                statusBadgeHtml = `<span class="badge-soft badge-sold"><i class="mdi mdi-cash-check"></i>Terjual</span>`;
            } else {
                statusBadgeHtml = `<span class="badge-soft badge-draft"><i class="mdi mdi-information-outline"></i>${statusText || 'Draft'}</span>`;
            }
            document.getElementById('m_status').innerHTML = statusBadgeHtml;

            // ---- Progress Pembangunan ----
            const progressMap = { belum_mulai:0, pondasi:20, dinding:40, atap:60, finishing:80, selesai:100 };
            const pct = progressMap[data.construction] !== undefined ? progressMap[data.construction] : 0;
            document.getElementById('m_progress_bar').style.width = pct + '%';
            document.getElementById('m_progress_bar').className   = 'progress-bar-custom ' + (pct < 100 ? 'progress-green' : 'progress-dark-green');
            document.getElementById('m_progress_pct').innerText   = pct + '%';

            // ---- Booking Card Show/Hide ----
            const hasBooking = data.hasBooking === 1 || data.hasBooking === '1' || data.hasBooking === true;
            document.getElementById('m_booking_card').style.display    = hasBooking ? '' : 'none';
            document.getElementById('m_no_booking_card').style.display = hasBooking ? 'none' : '';

            if (hasBooking) {
                const customerName = data.customer || '-';
                const salesName    = data.sales || '-';

                document.getElementById('m_customer').innerText         = customerName;
                document.getElementById('m_customer_initial').innerText = (customerName !== '-' && customerName) ? customerName.trim().charAt(0).toUpperCase() : '?';
                document.getElementById('m_sales').innerText            = salesName;
                document.getElementById('m_sales_initial').innerText    = (salesName !== '-' && salesName) ? salesName.trim().charAt(0).toUpperCase() : '?';
                document.getElementById('m_booking_date').innerText     = data.bookingDate || '-';
                document.getElementById('m_booking_fee').innerText      = 'Rp ' + new Intl.NumberFormat('id-ID').format(data.bookingFee || 0);
                document.getElementById('m_agent_fee').innerText        = 'Rp ' + new Intl.NumberFormat('id-ID').format(data.agentFee || 0);

                // Badge Status Booking
                const bookingStatus = data.bookingStatus || '-';
                let bookingBadgeHtml = '';
                if (bookingStatus === 'active') {
                    bookingBadgeHtml = `<span class="badge-soft badge-available-subsidi"><i class="mdi mdi-check-circle"></i>Aktif</span>`;
                } else if (bookingStatus === 'completed' || bookingStatus === 'lunas') {
                    bookingBadgeHtml = `<span class="badge-soft badge-available-subsidi"><i class="mdi mdi-check-circle"></i>Selesai</span>`;
                } else if (bookingStatus === 'cancelled') {
                    bookingBadgeHtml = `<span class="badge-soft badge-sold"><i class="mdi mdi-close-circle-outline"></i>Dibatalkan</span>`;
                } else {
                    const bLabel = bookingStatus.charAt(0).toUpperCase() + bookingStatus.slice(1);
                    bookingBadgeHtml = `<span class="badge-soft badge-draft"><i class="mdi mdi-clock-outline"></i>${bLabel}</span>`;
                }
                document.getElementById('m_booking_status').innerHTML = bookingBadgeHtml;
            }
        };

        // ========== DETAIL MODAL HANDLER ==========
        const detailModal = document.getElementById('detailUnitModal');
        if (detailModal) {
            detailModal.addEventListener('show.bs.modal', function (event) {
                let button = event.relatedTarget;
                if (!button) return; // Triggered programmatically, already populated!

                // ---- Informasi Unit ----
                document.getElementById('m_unit_name').innerText   = button.getAttribute('data-unit_name') || '-';
                document.getElementById('m_block').innerText       = button.getAttribute('data-block') || '-';
                document.getElementById('m_unit_number').innerText = button.getAttribute('data-unit_number') || '-';
                document.getElementById('m_jenis').innerText       = button.getAttribute('data-jenis') || '-';
                document.getElementById('m_type').innerText        = button.getAttribute('data-type') || '-';
                document.getElementById('m_area').innerText        = new Intl.NumberFormat('id-ID').format(button.getAttribute('data-area') || 0) + ' m\u00b2';
                document.getElementById('m_building').innerText    = new Intl.NumberFormat('id-ID').format(button.getAttribute('data-building') || 0) + ' m\u00b2';
                document.getElementById('m_price').innerText       = 'Rp ' + new Intl.NumberFormat('id-ID').format(button.getAttribute('data-price') || 0);
                document.getElementById('m_direction').innerText   = button.getAttribute('data-direction') || '-';
                document.getElementById('m_address').innerText     = button.getAttribute('data-address') || '-';

                // ---- Badge Status Unit ----
                const statusRaw  = button.getAttribute('data-status_raw')  || '';
                const statusText = button.getAttribute('data-status_text') || statusRaw;
                const jenisRaw   = (button.getAttribute('data-jenis') || '').toLowerCase();
                const typeRaw    = (button.getAttribute('data-type')  || '').toLowerCase();
                let statusBadgeHtml = '';
                if (statusRaw === 'ready' || statusRaw === 'tersedia') {
                    const cls = (jenisRaw === 'subsidi' || typeRaw === 'subsidi') ? 'badge-available-subsidi' : 'badge-available-komersil';
                    statusBadgeHtml = `<span class="badge-soft ${cls}"><i class="mdi mdi-check-circle-outline"></i>Tersedia</span>`;
                } else if (statusRaw === 'booked') {
                    statusBadgeHtml = `<span class="badge-soft badge-booking"><i class="mdi mdi-bookmark-check-outline"></i>Booking</span>`;
                } else if (statusRaw === 'sold') {
                    statusBadgeHtml = `<span class="badge-soft badge-sold"><i class="mdi mdi-cash-check"></i>Terjual</span>`;
                } else {
                    statusBadgeHtml = `<span class="badge-soft badge-draft"><i class="mdi mdi-information-outline"></i>${statusText || 'Draft'}</span>`;
                }
                document.getElementById('m_status').innerHTML = statusBadgeHtml;

                // ---- Progress Pembangunan ----
                const progressMap = { belum_mulai:0, pondasi:20, dinding:40, atap:60, finishing:80, selesai:100 };
                const construction = button.getAttribute('data-construction') || 'belum_mulai';
                const pct = progressMap[construction] !== undefined ? progressMap[construction] : 0;
                document.getElementById('m_progress_bar').style.width = pct + '%';
                document.getElementById('m_progress_bar').className   = 'progress-bar-custom ' + (pct < 100 ? 'progress-green' : 'progress-dark-green');
                document.getElementById('m_progress_pct').innerText   = pct + '%';

                // ---- Booking Card Show/Hide ----
                const hasBooking = button.getAttribute('data-has_booking') === '1';
                document.getElementById('m_booking_card').style.display    = hasBooking ? '' : 'none';
                document.getElementById('m_no_booking_card').style.display = hasBooking ? 'none' : '';

                if (hasBooking) {
                    const customerName = button.getAttribute('data-customer') || '-';
                    const salesName    = button.getAttribute('data-sales')    || '-';

                    document.getElementById('m_customer').innerText         = customerName;
                    document.getElementById('m_customer_initial').innerText = (customerName !== '-' && customerName) ? customerName.trim().charAt(0).toUpperCase() : '?';
                    document.getElementById('m_sales').innerText            = salesName;
                    document.getElementById('m_sales_initial').innerText    = (salesName !== '-' && salesName) ? salesName.trim().charAt(0).toUpperCase() : '?';
                    document.getElementById('m_booking_date').innerText     = button.getAttribute('data-booking_date') || '-';
                    document.getElementById('m_booking_fee').innerText      = 'Rp ' + new Intl.NumberFormat('id-ID').format(button.getAttribute('data-booking_fee') || 0);
                    document.getElementById('m_agent_fee').innerText        = 'Rp ' + new Intl.NumberFormat('id-ID').format(button.getAttribute('data-agent_fee') || 0);

                    // Badge Status Booking
                    const bookingStatus = button.getAttribute('data-booking_status') || '-';
                    let bookingBadgeHtml = '';
                    if (bookingStatus === 'active') {
                        bookingBadgeHtml = `<span class="badge-soft badge-available-subsidi"><i class="mdi mdi-check-circle"></i>Aktif</span>`;
                    } else if (bookingStatus === 'completed' || bookingStatus === 'lunas') {
                        bookingBadgeHtml = `<span class="badge-soft badge-available-subsidi"><i class="mdi mdi-check-circle"></i>Selesai</span>`;
                    } else if (bookingStatus === 'cancelled') {
                        bookingBadgeHtml = `<span class="badge-soft badge-sold"><i class="mdi mdi-close-circle-outline"></i>Dibatalkan</span>`;
                    } else {
                        const bLabel = bookingStatus.charAt(0).toUpperCase() + bookingStatus.slice(1);
                        bookingBadgeHtml = `<span class="badge-soft badge-draft"><i class="mdi mdi-clock-outline"></i>${bLabel}</span>`;
                    }
                    document.getElementById('m_booking_status').innerHTML = bookingBadgeHtml;
                }
            });
        }

        
        // Move detail modal inside the fullscreen element when shown in fullscreen
        $(document).ready(function () {
            $('#detailUnitModal').on('show.bs.modal', function () {
                if (document.fullscreenElement) {
                    const container = document.querySelector('#sitePlandView .denah-container');
                    if (container) {
                        container.appendChild(this);
                    }
                }
            });
            $('#detailUnitModal').on('hidden.bs.modal', function () {
                // Always move it back to body when hidden to prevent styling or visibility issues on other tabs
                document.body.appendChild(this);
            });
        });
        
        // ========== SITEPLAN CANVAS ==========
        const canvas = new fabric.Canvas('siteplanCanvas');
        const siteplanImage = "{{ asset('images/siteplan.jpeg') }}";
        let originalWidth = 0;
        let originalHeight = 0;
        let zoomLevel = 1.0;
        
        // Canvas Focus to avoid Page Scroll Hijacking
        let isCanvasFocused = false;

        fabric.Image.fromURL(siteplanImage, function (img) {
            originalWidth = img.width;
            originalHeight = img.height;
            
            // Set canvas size dynamically to match the container card width
            let initialWidth = 1100;
            const cardBody = document.querySelector('.card-body');
            if (cardBody && cardBody.clientWidth > 0) {
                initialWidth = cardBody.clientWidth - 40;
            }
            
            zoomLevel = 0.63; // default zoom at 63%
            
            canvas.setWidth(initialWidth);
            canvas.setHeight(originalHeight * zoomLevel); // Fit image height perfectly!
            
            // Calculate pan offset to center the 63% zoomed siteplan perfectly
            const panX = (initialWidth - originalWidth * zoomLevel) / 2;
            const panY = 0; // Vertically fits exactly
            
            canvas.setViewportTransform([zoomLevel, 0, 0, zoomLevel, panX, panY]);
            updateZoomText();
            
            // Premium grab cursors
            canvas.defaultCursor = 'grab';
            
            canvas.setBackgroundImage(img, function () {
                @foreach ($unitsForSvg as $unit)
                    const circle{{ $unit->id }} = new fabric.Circle({
                        left: {{ $unit->pos_x ?? 100 }},
                        top: {{ $unit->pos_y ?? 100 }},
                        radius: {{ ($unit->width ?? 80) / 2 }},
                        angle: {{ $unit->angle ?? 0 }},
                        fill: getColor("{{ $unit->status }}", "{{ $unit->type }}"),
                        opacity: 0.6,
                        stroke: 'black',
                        strokeWidth: 1,
                        hasControls: true,
                        hasBorders: true,
                        lockRotation: false
                    });
                    circle{{ $unit->id }}.unitId = "{{ $unit->id }}";
                    circle{{ $unit->id }}.unitCode = "{{ $unit->unit_code }}";
                    circle{{ $unit->id }}.unitName = "{{ str_replace(["\r", "\n"], ' ', addslashes($unit->unit_name ?? '-')) }}";
                    circle{{ $unit->id }}.unitNumber = "{{ str_replace(["\r", "\n"], ' ', addslashes($unit->unit_number ?? '-')) }}";
                    circle{{ $unit->id }}.block = "{{ str_replace(["\r", "\n"], ' ', addslashes($unit->block ?? '-')) }}";
                    circle{{ $unit->id }}.jenis = "{{ str_replace(["\r", "\n"], ' ', addslashes($unit->jenis ?? '-')) }}";
                    circle{{ $unit->id }}.type = "{{ str_replace(["\r", "\n"], ' ', addslashes($unit->type ?? '-')) }}";
                    circle{{ $unit->id }}.address = "{{ str_replace(["\r", "\n"], ' ', addslashes($unit->landBank->address ?? '-')) }}";
                    circle{{ $unit->id }}.area = {{ $unit->area ?? 0 }};
                    circle{{ $unit->id }}.building = {{ $unit->building_area ?? 0 }};
                    circle{{ $unit->id }}.price = {{ $unit->price ?? 0 }};
                    circle{{ $unit->id }}.direction = "{{ str_replace(["\r", "\n"], ' ', addslashes($unit->facing ?? '-')) }}";
                    circle{{ $unit->id }}.statusRaw = "{{ $unit->status }}";
                    circle{{ $unit->id }}.statusText = "{{ $unit->status == 'ready' || $unit->status == 'tersedia' ? 'Tersedia' : ($unit->status == 'sold' ? 'Terjual' : 'Booking') }}";
                    circle{{ $unit->id }}.construction = "{{ $unit->construction_progress ?? 'belum_mulai' }}";
                    circle{{ $unit->id }}.hasBooking = {{ $unit->activeBooking ? 1 : 0 }};
                    circle{{ $unit->id }}.customer = "{{ str_replace(["\r", "\n"], ' ', addslashes($unit->activeBooking->customer->full_name ?? '-')) }}";
                    circle{{ $unit->id }}.sales = "{{ str_replace(["\r", "\n"], ' ', addslashes($unit->activeBooking->sales->name ?? '-')) }}";
                    circle{{ $unit->id }}.bookingDate = "{{ $unit->activeBooking ? \Carbon\Carbon::parse($unit->activeBooking->booking_date)->format('d F Y') : '-' }}";
                    circle{{ $unit->id }}.bookingFee = {{ $unit->activeBooking->booking_fee ?? 0 }};
                    circle{{ $unit->id }}.agentFee = {{ $unit->activeBooking->agent_fee ?? 0 }};
                    circle{{ $unit->id }}.bookingStatus = "{{ str_replace(["\r", "\n"], ' ', addslashes($unit->activeBooking->status ?? '-')) }}";
                    canvas.add(circle{{ $unit->id }});
                @endforeach
                canvas.renderAll();
            }, { originX: 'left', originY: 'top' });
        });

        // Zoom on Mouse Wheel (Figma/Canva style: Zoom to the exact mouse pointer position!)
        canvas.on('mouse:wheel', function (opt) {
            if (!isCanvasFocused) return; // Allow page scroll if not clicked/activated first!
            
            if (typeof originalWidth === 'undefined' || originalWidth === 0) return;
            const delta = opt.e.deltaY;
            let zoomVal = canvas.getZoom();
            
            zoomVal *= (delta < 0 ? 1.1 : 0.9);
            
            if (zoomVal > 3.0) zoomVal = 3.0;
            if (zoomVal < 0.2) zoomVal = 0.2;
            
            zoomLevel = zoomVal;
            
            const pointer = canvas.getPointer(opt.e);
            canvas.zoomToPoint(new fabric.Point(pointer.x, pointer.y), zoomLevel);
            
            opt.e.preventDefault();
            opt.e.stopPropagation();
            canvas.renderAll();
            updateZoomText();
        });

        // Background Drag to Pan (Figma/Canva style!)
        let isDragging = false;
        let lastPosX, lastPosY;

        canvas.on('mouse:down', function (opt) {
            const evt = opt.e;
            if (!canvas.getActiveObject()) {
                isDragging = true;
                canvas.selection = false;
                canvas.defaultCursor = 'grabbing';
                canvas.setCursor('grabbing');
                lastPosX = evt.clientX;
                lastPosY = evt.clientY;
            }
        });

        canvas.on('mouse:move', function (opt) {
            if (isDragging) {
                const e = opt.e;
                const vpt = canvas.viewportTransform;
                vpt[4] += e.clientX - lastPosX;
                vpt[5] += e.clientY - lastPosY;
                canvas.requestRenderAll();
                lastPosX = e.clientX;
                lastPosY = e.clientY;
            }
        });

        canvas.on('mouse:up', function (opt) {
            canvas.setViewportTransform(canvas.viewportTransform);
            isDragging = false;
            canvas.selection = true;
            canvas.defaultCursor = 'grab';
            canvas.setCursor('grab');
        });

        // CANVAS FOCUS LOGIC TO AVOID SCROLL HIJACKING
        const siteplanScrollContainer = document.querySelector('.siteplan-scroll-container');

        if (siteplanScrollContainer) {
            siteplanScrollContainer.addEventListener('click', function (e) {
                isCanvasFocused = true;
                siteplanScrollContainer.style.borderColor = '#28a745'; // Glowing green active border
                siteplanScrollContainer.style.boxShadow = '0 0 15px rgba(40, 167, 69, 0.3)';
                e.stopPropagation();
            });
        }

        document.addEventListener('click', function (e) {
            if (siteplanScrollContainer && !siteplanScrollContainer.contains(e.target)) {
                isCanvasFocused = false;
                siteplanScrollContainer.style.borderColor = '#9a55ff'; // Restore default purple
                siteplanScrollContainer.style.boxShadow = 'none';
            }
        });

        // Zoom Functions
        function zoom(factor) {
            if (zoomLevel * factor > 3.0 || zoomLevel * factor < 0.2) return;
            zoomLevel = zoomLevel * factor;
            canvas.zoomToPoint(new fabric.Point(canvas.getWidth() / 2, canvas.getHeight() / 2), zoomLevel);
            updateZoomText();
        }

        function resetZoom() {
            zoomLevel = 0.63;
            const containerWidth = canvas.getWidth();
            const containerHeight = canvas.getHeight();
            
            // Pan to center the image both horizontally and vertically inside the canvas viewport!
            const panX = (containerWidth - originalWidth * zoomLevel) / 2;
            const panY = (containerHeight - originalHeight * zoomLevel) / 2;
            
            canvas.setViewportTransform([zoomLevel, 0, 0, zoomLevel, panX, panY]);
            canvas.renderAll();
            updateZoomText();
        }

        function updateZoomText() {
            const txt = document.getElementById('zoomPercent');
            if (txt) {
                txt.textContent = Math.round(zoomLevel * 100) + '%';
            }
        }

        // Fullscreen Functions
        function toggleFullscreen() {
            const container = document.querySelector('#sitePlandView .denah-container');
            if (!document.fullscreenElement) {
                if (container.requestFullscreen) {
                    container.requestFullscreen();
                } else if (container.webkitRequestFullscreen) {
                    container.webkitRequestFullscreen();
                } else if (container.msRequestFullscreen) {
                    container.msRequestFullscreen();
                }
            } else {
                if (document.exitFullscreen) {
                    document.exitFullscreen();
                }
            }
        }

        // Listen for fullscreen events
        document.addEventListener('fullscreenchange', handleFullscreenChange);
        document.addEventListener('webkitfullscreenchange', handleFullscreenChange);
        document.addEventListener('mozfullscreenchange', handleFullscreenChange);
        document.addEventListener('MSFullscreenChange', handleFullscreenChange);

        function handleFullscreenChange() {
            const container = document.querySelector('#sitePlandView .denah-container');
            const btn = document.getElementById('btnFullscreen');
            const scrollContainer = document.querySelector('.siteplan-scroll-container');
            const cardBody = document.querySelector('.card-body');
            
            if (document.fullscreenElement) {
                container.classList.add('fullscreen-mode');
                if (btn) btn.innerHTML = '<i class="mdi mdi-fullscreen-exit"></i>';
                
                // Fullscreen canvas size adjustment
                if (typeof canvas !== 'undefined' && canvas && scrollContainer) {
                    // Let canvas take the full width/height of the fullscreen container minus paddings
                    const newWidth = scrollContainer.clientWidth - 40;
                    const newHeight = scrollContainer.clientHeight - 40;
                    
                    canvas.setWidth(newWidth > 0 ? newWidth : window.innerWidth - 80);
                    canvas.setHeight(newHeight > 0 ? newHeight : window.innerHeight - 160);
                }
            } else {
                container.classList.remove('fullscreen-mode');
                if (btn) btn.innerHTML = '<i class="mdi mdi-fullscreen"></i>';
                
                // Restore normal canvas size
                if (typeof canvas !== 'undefined' && canvas) {
                    let normalWidth = 1100;
                    if (cardBody && cardBody.clientWidth > 0) {
                        normalWidth = cardBody.clientWidth - 40;
                    }
                    canvas.setWidth(normalWidth);
                    if (typeof originalHeight !== 'undefined' && originalHeight > 0) {
                        canvas.setHeight(originalHeight * 0.63);
                    }
                }
            }
            
            if (typeof canvas !== 'undefined' && canvas) {
                // Re-center and reset zoom to perfectly fit the new dimensions
                resetZoom();
                canvas.calcOffset();
                canvas.renderAll();
            }
        }

        // Keyboard navigation for micro-adjustments (Arrow Keys)
        document.addEventListener('keydown', function (e) {
            if (typeof canvas === 'undefined' || !canvas) return;
            const activeObject = canvas.getActiveObject();
            if (!activeObject) return;

            const keys = ['ArrowUp', 'ArrowDown', 'ArrowLeft', 'ArrowRight'];
            if (keys.includes(e.key)) {
                e.preventDefault();
            }

            const step = e.shiftKey ? 10 : 1; // 10px if Shift is held, otherwise 1px

            if (e.key === 'ArrowUp') {
                activeObject.set('top', activeObject.top - step);
            } else if (e.key === 'ArrowDown') {
                activeObject.set('top', activeObject.top + step);
            } else if (e.key === 'ArrowLeft') {
                activeObject.set('left', activeObject.left - step);
            } else if (e.key === 'ArrowRight') {
                activeObject.set('left', activeObject.left + step);
            }

            activeObject.setCoords();
            canvas.renderAll();
        });

        function getColor(status, type) {
            if (type === "komersil" && status === "ready") return "#2675BB";
            if (status === "ready") return "#CE2A2E";
            if (status === "booked") return "#FFD700";
            if (status === "sold") return "#FA2800";
            return "gray";
        }

        canvas.on('mouse:dblclick', function (e) {
            if (e.target && e.target.unitId) {
                const target = e.target;
                const data = {
                    unitName: target.unitName,
                    unitCode: target.unitCode,
                    unitNumber: target.unitNumber,
                    block: target.block,
                    jenis: target.jenis,
                    type: target.type,
                    address: target.address,
                    area: target.area,
                    building: target.building,
                    price: target.price,
                    direction: target.direction,
                    statusRaw: target.statusRaw,
                    statusText: target.statusText,
                    construction: target.construction,
                    hasBooking: target.hasBooking,
                    customer: target.customer,
                    sales: target.sales,
                    bookingDate: target.bookingDate,
                    bookingFee: target.bookingFee,
                    agentFee: target.agentFee,
                    bookingStatus: target.bookingStatus
                };
                
                window.populateModalDirectly(data);
                const modal = new bootstrap.Modal(document.getElementById('detailUnitModal'));
                modal.show();
            }
        });

        function savePosition() {
            let units = [];
            canvas.getObjects().forEach(function (obj) {
                if (obj.unitId) {
                    units.push({
                        id: obj.unitId,
                        pos_x: Math.round(obj.left),
                        pos_y: Math.round(obj.top),
                        width: Math.round(obj.getScaledWidth()),
                        height: Math.round(obj.getScaledHeight()),
                        angle: Math.round(obj.angle)
                    });
                }
            });
            fetch("{{ route('unit.save.position') }}", {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                body: JSON.stringify({ units: units })
            })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({ icon: 'success', title: 'Berhasil', text: 'Posisi unit berhasil disimpan', showConfirmButton: false, timer: 1500 });
                    }
                })
                .catch(error => {
                    Swal.fire({ icon: 'error', title: 'Gagal', text: 'Terjadi kesalahan saat menyimpan posisi' });
                });
        }

        // ========== SWITCH VIEW FUNCTION ==========
        function switchView(view) {
            document.getElementById('tableView').style.display = 'none';
            document.getElementById('gridView').style.display = 'none';
            document.getElementById('denahView').style.display = 'none';
            document.getElementById('sitePlandView').style.display = 'none';
            document.querySelectorAll('.btn-group .btn').forEach(btn => btn.classList.remove('active'));
            if (view === 'table') {
                document.getElementById('tableView').style.display = 'block';
                document.getElementById('btnTableView').classList.add('active');
            } else if (view === 'grid') {
                document.getElementById('gridView').style.display = 'block';
                document.getElementById('btnGridView').classList.add('active');
            } else if (view === 'denah') {
                document.getElementById('denahView').style.display = 'block';
                document.getElementById('btnDenahView').classList.add('active');
            } else if (view === 'sitepland') {
                document.getElementById('sitePlandView').style.display = 'block';
                document.getElementById('btnSitePlandView').classList.add('active');
                if (typeof canvas !== 'undefined' && canvas) {
                    // Update canvas width dynamically in case screen size is different or resized
                    let newWidth = 1100;
                    const cardBody = document.querySelector('.card-body');
                    if (cardBody && cardBody.clientWidth > 0) {
                        newWidth = cardBody.clientWidth - 40;
                    }
                    canvas.setWidth(newWidth);
                    if (typeof originalHeight !== 'undefined' && originalHeight > 0) {
                        canvas.setHeight(originalHeight * 0.63);
                    }
                    
                    // Re-center on tab active!
                    resetZoom();
                    
                    canvas.calcOffset();
                    canvas.renderAll();
                }
            }
        }

        // ========== OPEN CUSTOMER MODAL ==========
        window.openCustomerModal = function (unitId) {
            if (!unitId) {
                Swal.fire({ icon: 'error', title: 'Error', text: 'Unit tidak valid!' });
                return;
            }
            $('#modalCustomer').attr('data-unit-id', unitId);
            $('#booking_fee').val('');
            $('#bukti_transfer').val('');
            $('#buktiFileName').text('Upload Bukti Transfer');
            $('#buktiFileSize').text('');
            $('#buktiLabel').removeClass('file-selected');
            $('#modalCustomer').modal('show');
        };

        // ========== OPEN AGENCY MODAL ==========
        window.openAgentModal = function (unitId) {
            if (!unitId) {
                Swal.fire({ icon: 'error', title: 'Error', text: 'Unit tidak valid!' });
                return;
            }
            $('#modalAgency').data('unit', unitId);
            $('#formAgency').attr('action', "{{ url('marketing/set-agency') }}/" + unitId);
            $('#sales_id').val('');
            $('#agent_fee_modal').val('');
            $('#modalAgency').modal('show');
        };

        $(document).ready(function () {


            // Format Rupiah
            $('#booking_fee, #agent_fee_modal').on('input', function () {
                let value = $(this).val().replace(/[^0-9]/g, '');
                if (value) $(this).val(new Intl.NumberFormat('id-ID').format(value));
                else $(this).val('');
            });

            // File upload handler
            $('#bukti_transfer').on('change', function () {
                const file = this.files[0];
                const $label = $('#buktiLabel');
                const $fileName = $('#buktiFileName');
                const $fileSize = $('#buktiFileSize');
                if (file) {
                    $fileName.text(file.name.length > 30 ? file.name.substring(0, 30) + '...' : file.name);
                    if (file.size < 1024 * 1024) $fileSize.text((file.size / 1024).toFixed(1) + ' KB');
                    else $fileSize.text((file.size / (1024 * 1024)).toFixed(1) + ' MB');
                    $label.addClass('file-selected');
                } else {
                    $fileName.text('Upload Bukti Transfer');
                    $fileSize.text('');
                    $label.removeClass('file-selected');
                }
            });

            // Pilih Customer
            $(document).on('click', '.pilihCustomer', function () {
                let customerId = $(this).data('id');
                let purchaseType = $(this).data('type');
                let unitId = $('#modalCustomer').attr('data-unit-id');
                let bookingFee = $('#booking_fee').val().replace(/\./g, '');
                let buktiTransfer = $('#bukti_transfer')[0].files[0];

                if (!unitId) {
                    Swal.fire({ icon: 'error', title: 'Oops...', text: 'Unit belum dipilih!' });
                    return;
                }
                if (!bookingFee || parseInt(bookingFee) <= 0) {
                    Swal.fire({ icon: 'warning', title: 'Booking Fee Kosong', text: 'Booking fee harus diisi dan lebih dari 0!' });
                    return;
                }
                if (!buktiTransfer) {
                    Swal.fire({ icon: 'warning', title: 'Bukti Transfer Kosong', text: 'Bukti transfer wajib diupload!' });
                    return;
                }
                if (buktiTransfer.size > 2 * 1024 * 1024) {
                    Swal.fire({ icon: 'error', title: 'File Terlalu Besar', text: 'Ukuran file maksimal 2MB!' });
                    return;
                }
                const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'application/pdf'];
                if (!allowedTypes.includes(buktiTransfer.type)) {
                    Swal.fire({ icon: 'error', title: 'Tipe File Tidak Didukung', text: 'Format file harus JPG, PNG, atau PDF!' });
                    return;
                }

                Swal.fire({
                    title: 'Yakin pilih customer ini?',
                    html: `<p class="mb-1">Jenis: <b>${purchaseType.toUpperCase()}</b></p><p>Booking Fee: <b>Rp ${new Intl.NumberFormat('id-ID').format(bookingFee)}</b></p><p class="small text-muted mt-2">File: ${buktiTransfer.name}</p>`,
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Simpan!',
                    cancelButtonText: 'Batal',
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33'
                }).then((result) => {
                    if (result.isConfirmed) {
                        let formData = new FormData();
                        formData.append('_token', '{{ csrf_token() }}');
                        formData.append('customer_id', customerId);
                        formData.append('purchase_type', purchaseType);
                        formData.append('booking_fee', bookingFee);
                        formData.append('bukti_transfer', buktiTransfer);
                        let actionUrl = "{{ route('set.customer', ':unitId') }}".replace(':unitId', unitId);

                        Swal.fire({ title: 'Memproses...', text: 'Harap tunggu', allowOutsideClick: false, didOpen: () => { Swal.showLoading(); } });

                        $.ajax({
                            url: actionUrl,
                            type: 'POST',
                            data: formData,
                            processData: false,
                            contentType: false,
                            success: function (response) {
                                $('#modalCustomer').modal('hide');
                                Swal.fire({ icon: 'success', title: 'Berhasil!', text: response.message || 'Customer berhasil dipilih', timer: 1500, showConfirmButton: false }).then(() => location.reload());
                            },
                            error: function (xhr) {
                                let errorMsg = 'Terjadi kesalahan';
                                if (xhr.responseJSON && xhr.responseJSON.message) errorMsg = xhr.responseJSON.message;
                                else if (xhr.responseJSON && xhr.responseJSON.errors) errorMsg = Object.values(xhr.responseJSON.errors).join('\n');
                                Swal.fire({ icon: 'error', title: 'Gagal', text: errorMsg });
                            }
                        });
                    }
                });
            });

            // Pilih Agency
            $(document).on('click', '.pilihAgency', function () {
                let salesId = $(this).data('id');
                let agentFeeRaw = $('#agent_fee_modal').val().replace(/\./g, '').replace(/,/g, '').trim();
                if (!agentFeeRaw || parseInt(agentFeeRaw) <= 0) {
                    Swal.fire({ icon: 'warning', title: 'Oops...', text: 'Agent fee wajib diisi dan lebih dari 0!' });
                    return;
                }
                let unitId = $('#modalAgency').data('unit');
                if (!unitId) {
                    Swal.fire({ icon: 'error', title: 'Error', text: 'Unit tidak valid! Silakan coba lagi.' });
                    return;
                }

                Swal.fire({
                    title: 'Yakin pilih agency ini?',
                    html: `Agent Fee: <b>Rp ${new Intl.NumberFormat('id-ID').format(agentFeeRaw)}</b>`,
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Pilih!',
                    cancelButtonText: 'Batal',
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({ title: 'Memproses...', text: 'Harap tunggu', allowOutsideClick: false, didOpen: () => { Swal.showLoading(); } });

                        let formData = new FormData();
                        formData.append('_token', '{{ csrf_token() }}');
                        formData.append('sales_id', salesId);
                        formData.append('agent_fee', agentFeeRaw);
                        let actionUrl = "{{ url('marketing/set-agency') }}/" + unitId;

                        $.ajax({
                            url: actionUrl,
                            type: 'POST',
                            data: formData,
                            processData: false,
                            contentType: false,
                            success: function (response) {
                                $('#modalAgency').modal('hide');
                                Swal.fire({ icon: 'success', title: 'Berhasil', text: response.message || 'Agency berhasil dipilih', showConfirmButton: false, timer: 1500 }).then(() => location.reload());
                            },
                            error: function (xhr) {
                                let errMsg = 'Terjadi kesalahan';
                                if (xhr.responseJSON && xhr.responseJSON.message) errMsg = xhr.responseJSON.message;
                                Swal.fire({ icon: 'error', title: 'Gagal', text: errMsg });
                            }
                        });
                    }
                });
            });

            // Search dan Filter
            $('#searchCustomer').on('keyup', function () {
                const searchTerm = $(this).val().toLowerCase();
                $('#customerTable tbody tr').each(function () {
                    $(this).toggle($(this).text().toLowerCase().indexOf(searchTerm) > -1);
                });
            });

            $('#filterPekerjaan').on('change', function () {
                const job = $(this).val();
                if (!job) $('#customerTable tbody tr').show();
                else {
                    $('#customerTable tbody tr').each(function () {
                        const jobText = $(this).find('td:eq(4)').text().trim();
                        $(this).toggle(jobText === job);
                    });
                }
            });

            $('#searchAgency').on('keyup', function () {
                const searchTerm = $(this).val().toLowerCase();
                $('#modalAgency .table tbody tr').each(function () {
                    $(this).toggle($(this).text().toLowerCase().indexOf(searchTerm) > -1);
                });
            });

            // Reset form saat modal ditutup
            $('#modalCustomer, #modalAgency').on('hidden.bs.modal', function () {
                $('#booking_fee, #agent_fee_modal').val('');
                $('#bukti_transfer').val('');
                $('#buktiFileName').text('Upload Bukti Transfer');
                $('#buktiFileSize').text('');
                $('#buktiLabel').removeClass('file-selected');
            });
        });

        // ========== SESSION FLASH MESSAGES ==========
        @if (session('success'))
            Swal.fire({ icon: 'success', title: 'Berhasil', text: "{{ session('success') }}", showConfirmButton: false, timer: 2000 });
        @endif
        @if (session('error'))
            Swal.fire({ icon: 'error', title: 'Oops...', text: "{{ session('error') }}", confirmButtonColor: '#d33' });
        @endif
        @if ($errors->any())
            Swal.fire({ icon: 'warning', title: 'Validasi Gagal', html: `{!! implode('<br>', $errors->all()) !!}` });
        @endif

        // ========== SEARCH SYNC ==========
        // Sinkronisasi search field antara desktop dan mobile
        $(document).ready(function() {
            // Ketika desktop search berubah, sync ke mobile
            $('input[name="search"]').on('input', function() {
                $('#searchMobile').val($(this).val());
            });

            // Ketika mobile search berubah, sync ke desktop
            $('#searchMobile').on('input', function() {
                $('input[name="search"]').val($(this).val());
            });

            // ========== SORTING FUNCTIONALITY ==========
            // Sorting functionality
            $('.sortable').click(function() {
                let field = $(this).data('field');
                let direction = $(this).data('direction');

                // Toggle direction
                if (direction === 'asc') {
                    direction = 'desc';
                } else {
                    direction = 'asc';
                }

                // Show loading
                Swal.fire({
                    title: 'Mengurutkan...',
                    html: 'Sedang mengurutkan data',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                // Build URL dengan sorting parameters
                let url = new URL(window.location.href);
                url.searchParams.set('sort', field);
                url.searchParams.set('direction', direction);
                url.searchParams.set('page', 1);

                // Redirect dengan delay untuk efek loading
                setTimeout(() => {
                    window.location.href = url.toString();
                }, 500);
            });

            // Saat submit form, pastikan hanya desktop search yang digunakan
            $('#filterForm').on('submit', function() {
                // Copy mobile search ke desktop search jika mobile terlihat
                if ($(window).width() < 768) {
                    var mobileSearch = $('#searchMobile').val();
                    $('input[name="search"]').val(mobileSearch);
                }

                // Hapus field duplikat untuk mencegah duplikasi parameter
                $('input[name="search_mobile"]').remove();

                // Hapus select duplikat (mobile version) untuk mencegah duplikasi parameter
                $('select[name="jenis"]').not(':first').remove();
                $('select[name="status"]').not(':first').remove();
                $('select[name="perPage"]').not(':first').remove();

                return true;
            });
        });

            // Fungsi loading untuk filter
            function showFilterLoading() {
                Swal.fire({
                    title: 'Memuat...',
                    html: 'Sedang memfilter data',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
                return true;
            }

        // Fungsi loading untuk reset
        function showResetLoading(event) {
            event.preventDefault();
            let url = event.currentTarget.href;
            Swal.fire({
                title: 'Memuat...',
                html: 'Sedang mereset data',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
            window.location.href = url;
        }
    </script>
@endpush
