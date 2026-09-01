@extends('layouts.partial.app')

@section('title', 'Marketing Jual Unit - Property Management App')

@section('content')
    <style>
        /* ===== JUAL UNIT SPECIFIC STYLES ===== */
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

        /* Seamless Rupiah Input Group (Prefix Rp on Left) */
        .rupiah-input-group {
            display: flex !important;
            flex-wrap: nowrap !important;
            align-items: stretch !important;
            width: 100% !important;
        }

        .rupiah-input-group .input-group-text {
            background-color: #f8fafc !important;
            border: 1.5px solid #e2e8f0 !important;
            border-right: none !important;
            border-top-left-radius: 8px !important;
            border-bottom-left-radius: 8px !important;
            border-top-right-radius: 0 !important;
            border-bottom-right-radius: 0 !important;
            color: #9a55ff !important;
            font-size: 0.95rem !important;
            font-weight: 700 !important;
            padding: 0 0.85rem !important;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            min-height: 42px !important;
            margin: 0 !important;
        }

        .rupiah-input-group .form-control {
            border-top-left-radius: 0 !important;
            border-bottom-left-radius: 0 !important;
            border-top-right-radius: 8px !important;
            border-bottom-right-radius: 8px !important;
            border: 1.5px solid #e2e8f0 !important;
            border-left: 1.5px solid #e2e8f0 !important;
            min-height: 42px !important;
            margin: 0 !important;
            flex: 1 1 auto;
        }

        .rupiah-input-group:focus-within .input-group-text {
            border-color: #9a55ff !important;
            background-color: #fdfaff !important;
        }

        .rupiah-input-group:focus-within .form-control {
            border-color: #9a55ff !important;
            box-shadow: 0 0 0 3px rgba(154, 85, 255, 0.15) !important;
        }

        /* Search Input Group in Filter (Input on Left, Purple Button on Right) */
        .search-input-group {
            display: flex !important;
            flex-wrap: nowrap !important;
            align-items: stretch !important;
            width: 100% !important;
            height: 38px !important;
        }

        .search-input-group .form-control {
            height: 38px !important;
            min-height: 38px !important;
            border-top-left-radius: 8px !important;
            border-bottom-left-radius: 8px !important;
            border-top-right-radius: 0 !important;
            border-bottom-right-radius: 0 !important;
            border: 1.5px solid #e2e8f0 !important;
            border-right: none !important;
            font-size: 0.88rem !important;
            padding: 0.45rem 0.85rem !important;
            margin: 0 !important;
            flex: 1 1 auto;
        }

        .search-input-group .btn-search-submit {
            height: 38px !important;
            min-height: 38px !important;
            border-top-left-radius: 0 !important;
            border-bottom-left-radius: 0 !important;
            border-top-right-radius: 8px !important;
            border-bottom-right-radius: 8px !important;
            padding: 0 0.95rem !important;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            box-shadow: none !important;
            border: none !important;
            font-size: 1.15rem !important;
            color: #ffffff !important;
            margin: 0 !important;
            flex-shrink: 0;
        }

        .search-input-group:focus-within .form-control {
            border-color: #9a55ff !important;
            box-shadow: 0 0 0 3px rgba(154, 85, 255, 0.15) !important;
        }

        /* Siteplan */
        .siteplan-scroll-container {
            width: 100%;
            overflow: hidden !important;
            border: 2px solid #9a55ff;
            border-radius: 12px;
            background: #ffffff;
            height: 620px;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 0;
            user-select: none;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
            position: relative;
        }

        .siteplan-scroll-container .canvas-container {
            width: 100% !important;
            height: 100% !important;
            margin: 0 !important;
        }

        #siteplanCanvas {
            display: block;
            border-radius: 10px;
            cursor: grab;
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

        #modalCustomer .timeline-detail-item:hover,
        #modalAgency .timeline-detail-item:hover {
            transform: none !important;
            box-shadow: none !important;
            border-color: #efe6ff !important;
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
        }

        /* ===== OPTIMASI LEBAR & PADDING (DESKTOP, TABLET & MOBILE) ===== */
        .content-wrapper {
            padding: 1.25rem 1rem !important;
        }

        .card-body {
            padding: 0.85rem 1rem !important;
        }

        .filter-card {
            background: transparent !important;
            padding: 0 !important;
            margin-bottom: 1.25rem !important;
            border: none !important;
        }

        .table-responsive {
            width: 100% !important;
            margin-bottom: 0 !important;
        }

        .table {
            width: 100% !important;
            margin-bottom: 0 !important;
        }

        /* Mode Tablet (iPad / 768px - 1024px) */
        @media (max-width: 1024px) {
            .content-wrapper {
                padding: 1.15rem 0.85rem !important;
            }
            .container-fluid {
                padding-left: 0.25rem !important;
                padding-right: 0.25rem !important;
            }
        }

        /* Mode HP / Mobile */
        @media (max-width: 576px) {
            .content-wrapper {
                padding: 0.85rem 0.65rem !important;
            }
            .container-fluid {
                padding-left: 0.25rem !important;
                padding-right: 0.25rem !important;
            }
            .card-body {
                padding: 0.75rem 0.75rem !important;
            }
        }

        /* Select2 Theme Alignment */
        .select2-container--bootstrap-5 .select2-selection {
            min-height: 38px !important;
            height: 38px !important;
            padding: 0.375rem 0.75rem !important;
            display: flex !important;
            align-items: center !important;
            border-color: #ebedf2 !important;
            border-radius: 6px !important;
            font-size: 0.875rem !important;
            background-color: #ffffff !important;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }
        .select2-container--bootstrap-5 .select2-selection--single .select2-selection__rendered {
            line-height: 1.5 !important;
            padding-left: 0 !important;
            color: #3b3f5c !important;
        }
        .select2-container--bootstrap-5.select2-container--focus .select2-selection,
        .select2-container--bootstrap-5.select2-container--open .select2-selection {
            border-color: #bfa5fa !important;
            box-shadow: 0 0 0 0.2rem rgba(154, 85, 255, 0.12) !important;
        }

        /* Select2 Dropdown Options Soft Hover & Active */
        .select2-container--bootstrap-5 .select2-dropdown {
            border: 1px solid #e2e8f0 !important;
            border-radius: 8px !important;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08) !important;
            overflow: hidden !important;
            z-index: 1050 !important;
        }
        .select2-container--bootstrap-5 .select2-results__option {
            padding: 0.45rem 0.85rem !important;
            font-size: 0.85rem !important;
            color: #3b3f5c !important;
            transition: background-color 0.15s ease, color 0.15s ease;
        }
        /* Hover / Highlighted (Soft Pastel Tint) */
        .select2-container--bootstrap-5 .select2-results__option--highlighted,
        .select2-container--bootstrap-5 .select2-results__option--highlighted.select2-results__option--selectable {
            background-color: #f6f1ff !important;
            color: #792fe0 !important;
        }
        /* Active / Selected (Soft Purple Tint) */
        .select2-container--bootstrap-5 .select2-results__option[aria-selected="true"],
        .select2-container--bootstrap-5 .select2-results__option--selected {
            background-color: #eee4ff !important;
            color: #6b21a8 !important;
            font-weight: 600 !important;
        }
        .select2-container--bootstrap-5 .select2-results__option--selected.select2-results__option--highlighted {
            background-color: #e4d3fe !important;
            color: #581c87 !important;
        }

        /* ===== VIEW TOGGLE GROUP STYLING ===== */
        .btn-view-toggle {
            padding: 0.38rem 0.85rem;
            font-size: 0.82rem;
            font-weight: 600;
            border-radius: 6px !important;
            border: 1.5px solid #e2e8f0;
            background: #ffffff;
            color: #4a5568;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            cursor: pointer;
        }
        .btn-view-toggle:hover {
            border-color: #c4b5fd;
            color: #7c3aed;
            background: #faf5ff;
        }
        .btn-view-toggle.active {
            background: linear-gradient(135deg, #da8cff, #9a55ff) !important;
            color: #ffffff !important;
            border-color: #9a55ff !important;
            box-shadow: 0 2px 6px rgba(154, 85, 255, 0.25);
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
                                Marketing Jual Unit
                            </h3>
                            <p class="text-muted mb-0" style="font-size: 0.9rem;">
                                Kelola unit-unit yang siap dipasarkan ke customer
                            </p>
                        </div>
                        <div class="d-none d-sm-block pe-2">
                            <i class="mdi mdi-home-group" style="font-size: 3rem; color: #9a55ff; opacity: 0.25;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="row g-3 mb-4">
            <div class="col-6 col-md-3">
                <div class="card shadow-sm border-0 h-100 mb-0">
                    <div class="card-body d-flex justify-content-between align-items-center p-3">
                        <div>
                            <h3 class="text-dark mb-1 fw-bold">{{ $totalUnits }}</h3>
                            <p class="text-muted mb-0">Total Unit</p>
                        </div>
                        <div class="d-none d-sm-block">
                            <i class="mdi mdi-home-city" style="font-size: 2.5rem; color: #9a55ff; opacity: 0.2;"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card shadow-sm border-0 h-100 mb-0">
                    <div class="card-body d-flex justify-content-between align-items-center p-3">
                        <div>
                            <h3 class="text-dark mb-1 fw-bold">{{ $totalTersedia }}</h3>
                            <p class="text-muted mb-0">Tersedia</p>
                        </div>
                        <div class="d-none d-sm-block">
                            <i class="mdi mdi-check-circle-outline" style="font-size: 2.5rem; color: #9a55ff; opacity: 0.2;"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card shadow-sm border-0 h-100 mb-0">
                    <div class="card-body d-flex justify-content-between align-items-center p-3">
                        <div>
                            <h3 class="text-dark mb-1 fw-bold">{{ $totalBooking }}</h3>
                            <p class="text-muted mb-0">Booking</p>
                        </div>
                        <div class="d-none d-sm-block">
                            <i class="mdi mdi-bookmark-check-outline" style="font-size: 2.5rem; color: #9a55ff; opacity: 0.2;"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card shadow-sm border-0 h-100 mb-0">
                    <div class="card-body d-flex justify-content-between align-items-center p-3">
                        <div>
                            <h3 class="text-dark mb-1 fw-bold">{{ $totalSold }}</h3>
                            <p class="text-muted mb-0">Terjual</p>
                        </div>
                        <div class="d-none d-sm-block">
                            <i class="mdi mdi-cash-check" style="font-size: 2.5rem; color: #9a55ff; opacity: 0.2;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabel Data -->
        <div class="row mt-2 mt-sm-2 mt-md-3">
            <div class="col-12">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white d-flex flex-column flex-lg-row justify-content-between align-items-start align-items-lg-center py-3 px-3 px-md-4 gap-2 border-bottom">
                        <h5 class="card-title mb-0" style="font-weight: 700; color: #2c2e3f; font-size: 1rem;">
                            <i class="mdi mdi-format-list-bulleted me-2" style="color: #9a55ff;"></i>
                            Daftar Unit
                        </h5>
                        <div class="d-flex flex-wrap align-items-center gap-2">
                            <!-- Toggle View -->
                            <div class="d-flex align-items-center gap-1" id="viewToggleGroup" role="group">
                                <button type="button" class="btn btn-view-toggle active" id="btnTableView"
                                    onclick="switchView('table')">
                                    <i class="mdi mdi-view-list"></i><span>Table</span>
                                </button>
                                <button type="button" class="btn btn-view-toggle" id="btnGridView"
                                    onclick="switchView('grid')">
                                    <i class="mdi mdi-view-grid"></i><span>Grid</span>
                                </button>
                                <button type="button" class="btn btn-view-toggle" id="btnDenahView"
                                    onclick="switchView('denah')">
                                    <i class="mdi mdi-floor-plan"></i><span>Denah Unit</span>
                                </button>
                                <button type="button" class="btn btn-view-toggle" id="btnSitePlandView"
                                    onclick="switchView('sitepland')">
                                    <i class="mdi mdi-map"></i><span>Siteplan</span>
                                </button>
                            </div>
                            <!-- Aturan Komisi Agent Button -->
                            <button type="button" class="btn btn-sm btn-gradient-info text-white d-inline-flex align-items-center gap-1.5 px-3 shadow-sm"
                                style="height: 32px; border-radius: 6px; font-weight: 600;" data-bs-toggle="modal" data-bs-target="#modalMasterCommissionRules">
                                <i class="mdi mdi-cogs text-white"></i>
                                <span class="text-white">Aturan Komisi</span>
                            </button>
                            <!-- Export Buttons -->
                            <a href="{{ route('marketing.jual-unit.export.excel') }}"
                                class="btn btn-sm btn-gradient-success d-inline-flex align-items-center gap-1 px-3" style="height: 32px; border-radius: 6px;">
                                <i class="mdi mdi-file-excel"></i>
                                <span>Excel</span>
                            </a>
                            <a href="{{ route('marketing.jual-unit.export.pdf') }}" 
                                class="btn btn-sm btn-gradient-danger d-inline-flex align-items-center gap-1 px-3" style="height: 32px; border-radius: 6px;">
                                <i class="mdi mdi-file-pdf"></i>
                                <span>PDF</span>
                            </a>
                        </div>
                    </div>

                    <div class="card-body p-3 p-md-4">
                        <!-- Filter Section -->
                        <div class="filter-card mb-3">
                            <!-- FILTER DESKTOP -->
                            <div class="filter-row-desktop d-none d-lg-block">
                                <form method="GET" action="{{ route('marketing.jual-unit') }}" id="filterForm">
                                    @if(request('sort'))
                                        <input type="hidden" name="sort" value="{{ request('sort') }}">
                                    @endif
                                    @if(request('direction'))
                                        <input type="hidden" name="direction" value="{{ request('direction') }}">
                                    @endif
                                    <div class="row g-2 align-items-center w-100 m-0">
                                        <!-- Search Input -->
                                        <div class="col-lg-3 col-xl-3 p-0 pe-2">
                                            <div class="input-group search-input-group">
                                                <input type="text" name="search" value="{{ request('search') }}"
                                                    class="form-control" placeholder="Cari blok, unit, customer...">
                                                <button class="btn btn-gradient-primary btn-search-submit px-3" 
                                                    type="submit" title="Cari">
                                                    <i class="mdi mdi-magnify"></i>
                                                </button>
                                            </div>
                                        </div>

                                        <!-- Project Dropdown -->
                                        <div class="col-lg-2 col-xl-2 p-0 pe-2">
                                            <select name="project" class="form-control select2" id="projectSelect" style="width: 100%;">
                                                <option value="">Semua Proyek</option>
                                                @foreach ($projects as $p)
                                                    <option value="{{ $p->id }}"
                                                        {{ request('project') == $p->id ? 'selected' : '' }}>
                                                        {{ $p->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <!-- Jenis Dropdown -->
                                        <div class="col-lg-2 col-xl-2 p-0 pe-2">
                                            <select name="jenis" class="form-control select2" id="jenisSelect" style="width: 100%;">
                                                <option value="">Semua Jenis</option>
                                                <option value="subsidi"
                                                    {{ request('jenis') == 'subsidi' ? 'selected' : '' }}>Subsidi
                                                </option>
                                                <option value="komersil"
                                                    {{ request('jenis') == 'komersil' ? 'selected' : '' }}>Komersil
                                                </option>
                                            </select>
                                        </div>

                                        <!-- Status Dropdown -->
                                        <div class="col-lg-2 col-xl-2 p-0 pe-2">
                                            <select name="status" class="form-control select2" id="statusSelect" style="width: 100%;">
                                                <option value="">Semua Status</option>
                                                <option value="ready"
                                                    {{ request('status') == 'ready' ? 'selected' : '' }}>Tersedia
                                                </option>
                                                <option value="booked"
                                                    {{ request('status') == 'booked' ? 'selected' : '' }}>Booking
                                                </option>
                                                <option value="sold"
                                                    {{ request('status') == 'sold' ? 'selected' : '' }}>
                                                    Terjual</option>
                                            </select>
                                        </div>

                                        <!-- Right Side: Limit Dropdown + Filter & Reset Buttons -->
                                        <div class="col-lg-3 col-xl-3 p-0 d-flex align-items-center justify-content-end gap-2 ms-auto">
                                            <div style="width: 100px;">
                                                <select name="perPage" class="form-control select2" id="perPageSelect" style="width: 100%;">
                                                    <option value="10"
                                                        {{ request('perPage') == 10 ? 'selected' : '' }}>10 Data
                                                    </option>
                                                    <option value="25"
                                                        {{ request('perPage') == 25 ? 'selected' : '' }}>25 Data
                                                    </option>
                                                    <option value="50"
                                                        {{ request('perPage') == 50 ? 'selected' : '' }}>50 Data
                                                    </option>
                                                    <option value="100"
                                                        {{ request('perPage') == 100 ? 'selected' : '' }}>100 Data
                                                    </option>
                                                </select>
                                            </div>
                                            <button type="submit"
                                                class="btn btn-gradient-primary btn-icon-only"
                                                id="filterBtn" title="Filter">
                                                <i class="mdi mdi-filter"></i>
                                            </button>
                                            <a href="{{ route('marketing.jual-unit') }}"
                                                class="btn btn-gradient-secondary btn-icon-only"
                                                title="Reset" onclick="showResetLoading(event)">
                                                <i class="mdi mdi-refresh"></i>
                                            </a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- FILTER MOBILE / TABLET -->
                            <div class="d-block d-lg-none">
                                <form method="GET" action="{{ route('marketing.jual-unit') }}" id="filterFormMobile">
                                    @if(request('sort'))
                                        <input type="hidden" name="sort" value="{{ request('sort') }}">
                                    @endif
                                    @if(request('direction'))
                                        <input type="hidden" name="direction" value="{{ request('direction') }}">
                                    @endif
                                    <div class="row g-2">
                                        <div class="col-12 mb-2">
                                            <div class="input-group search-input-group">
                                                <input type="text" name="search"
                                                    value="{{ request('search') }}" class="form-control"
                                                    placeholder="Cari blok, unit, customer..." id="searchMobile">
                                                <button class="btn btn-gradient-primary btn-search-submit px-3" 
                                                    type="submit" title="Cari">
                                                    <i class="mdi mdi-magnify"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6 mb-2">
                                            <select name="project" class="form-control select2-mobile" id="projectSelectMobile" style="width: 100%;">
                                                <option value="">Semua Proyek</option>
                                                @foreach ($projects as $p)
                                                    <option value="{{ $p->id }}"
                                                        {{ request('project') == $p->id ? 'selected' : '' }}>
                                                        {{ $p->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-12 col-sm-6 mb-2">
                                            <select name="jenis" class="form-control select2-mobile" id="jenisSelectMobile" style="width: 100%;">
                                                <option value="">Semua Jenis</option>
                                                <option value="subsidi"
                                                    {{ request('jenis') == 'subsidi' ? 'selected' : '' }}>Subsidi
                                                </option>
                                                <option value="komersil"
                                                    {{ request('jenis') == 'komersil' ? 'selected' : '' }}>Komersil
                                                </option>
                                            </select>
                                        </div>
                                        <div class="col-6 mb-2">
                                            <select name="status" class="form-control select2-mobile" id="statusSelectMobile" style="width: 100%;">
                                                <option value="">Semua Status</option>
                                                <option value="ready"
                                                    {{ request('status') == 'ready' ? 'selected' : '' }}>Tersedia
                                                </option>
                                                <option value="booked"
                                                    {{ request('status') == 'booked' ? 'selected' : '' }}>Booking
                                                </option>
                                                <option value="sold"
                                                    {{ request('status') == 'sold' ? 'selected' : '' }}>
                                                    Terjual</option>
                                            </select>
                                        </div>
                                        <div class="col-6 mb-2">
                                            <select name="perPage" class="form-control select2-mobile" id="perPageSelectMobile" style="width: 100%;">
                                                <option value="10"
                                                    {{ request('perPage') == 10 ? 'selected' : '' }}>10 Data
                                                    </option>
                                                <option value="25"
                                                    {{ request('perPage') == 25 ? 'selected' : '' }}>25 Data
                                                    </option>
                                                <option value="50"
                                                    {{ request('perPage') == 50 ? 'selected' : '' }}>50 Data
                                                    </option>
                                                <option value="100"
                                                    {{ request('perPage') == 100 ? 'selected' : '' }}>100 Data
                                                    </option>
                                            </select>
                                        </div>
                                        <div class="col-6">
                                            <button type="submit"
                                                class="btn btn-gradient-primary btn-icon-only-mobile w-100 d-flex align-items-center justify-content-center"
                                                id="filterBtnMobile" title="Filter" style="height: 38px;">
                                                <i class="mdi mdi-filter me-1"></i> <span>Filter</span>
                                            </button>
                                        </div>
                                        <div class="col-6">
                                            <a href="{{ route('marketing.jual-unit') }}"
                                                class="btn btn-gradient-secondary btn-icon-only-mobile w-100 d-flex align-items-center justify-content-center"
                                                title="Reset" onclick="showResetLoading(event)" style="height: 38px;">
                                                <i class="mdi mdi-refresh me-1"></i> <span>Reset</span>
                                            </a>
                                        </div>
                                    </div>
                                </form>
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
                                            <th class="sortable" data-field="block"
                                                data-direction="{{ request('sort') == 'block' ? (request('direction') == 'asc' ? 'desc' : 'asc') : 'asc' }}">
                                                Nama - Unit
                                                @if (request('sort') == 'block')
                                                    <i
                                                        class="mdi mdi-{{ request('direction') == 'asc' ? 'arrow-up' : 'arrow-down' }}"></i>
                                                @else
                                                    <i class="mdi mdi-swap-vertical"></i>
                                                @endif
                                            </th>
                                            <th class="sortable" data-field="jenis"
                                                data-direction="{{ request('sort') == 'jenis' ? (request('direction') == 'asc' ? 'desc' : 'asc') : 'asc' }}">
                                                Jenis & Tipe
                                                @if (request('sort') == 'jenis')
                                                    <i
                                                        class="mdi mdi-{{ request('direction') == 'asc' ? 'arrow-up' : 'arrow-down' }}"></i>
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
                                            <th class="sortable" data-field="agent_name"
                                                data-direction="{{ request('sort') == 'agent_name' ? (request('direction') == 'asc' ? 'desc' : 'asc') : 'asc' }}">
                                                Agent
                                                @if (request('sort') == 'agent_name')
                                                    <i
                                                        class="mdi mdi-{{ request('direction') == 'asc' ? 'arrow-up' : 'arrow-down' }}"></i>
                                                @else
                                                    <i class="mdi mdi-swap-vertical"></i>
                                                @endif
                                            </th>
                                            <th>Fee Agent</th>
                                            <th class="sortable" data-field="customer_name"
                                                data-direction="{{ request('sort') == 'customer_name' ? (request('direction') == 'asc' ? 'desc' : 'asc') : 'asc' }}">
                                                Customer
                                                @if (request('sort') == 'customer_name')
                                                    <i
                                                        class="mdi mdi-{{ request('direction') == 'asc' ? 'arrow-up' : 'arrow-down' }}"></i>
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
                                                    // Tersedia = biru
                                                    $statusBadge = 'badge-available-komersil';
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
                                                } elseif (
                                                    strtolower($unit->status) == 'draft' ||
                                                    strtolower($unit->status) == 'draff'
                                                ) {
                                                    // Draft dianggap Tersedia dan warna biru
                                                    $statusBadge = 'badge-available-komersil';
                                                    $statusIcon = 'mdi-check-circle-outline';
                                                    $statusText = 'Tersedia';
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
                                                $progressClass =
                                                    $progress < 100 ? 'progress-green' : 'progress-dark-green';
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
                                                            {{ $unit->unit_code ?? ($unit->block ?? '') . ' ' . ($unit->unit_number ?? '') }}
                                                        </span>
                                                    </div>
                                                </td>
                                                <td>
                                                    @if (strtolower($unit->jenis ?? '') == 'subsidi')
                                                        <span class="badge badge-gradient-success">
                                                            <i class="mdi mdi-home-assistant me-1"></i>{{ $unit->jenis }}
                                                            -
                                                            {{ $unit->type ?? '-' }}
                                                        </span>
                                                    @elseif(strtolower($unit->jenis ?? '') == 'komersil')
                                                        <span class="badge badge-gradient-primary">
                                                            <i
                                                                class="mdi mdi-office-building me-1"></i>{{ $unit->jenis }}
                                                            -
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
                                                        <i
                                                            class="mdi mdi-home-floor-1"></i>{{ $unit->building_area ?? '-' }}
                                                    </span>
                                                </td>
                                                <td class="price-text">Rp
                                                    {{ number_format($unit->price ?? 0, 0, ',', '.') }}
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
                                                    Rp
                                                    {{ number_format($unit->activeBooking->agent_fee ?? 0, 0, ',', '.') }}
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
                                                    Rp
                                                    {{ number_format($unit->activeBooking->booking_fee ?? 0, 0, ',', '.') }}
                                                </td>
                                                <td class="text-center">
                                                    <div class="action-group">
                                                        <button class="btn-action view" title="Detail"
                                                            data-bs-toggle="modal" data-bs-target="#detailUnitModal"
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
                                                    <i class="mdi mdi-home-outline"
                                                        style="font-size: 2rem; opacity: 0.3;"></i>
                                                    <p class="mt-2">Data unit belum tersedia</p>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            <!-- PAGINATION - COMPACT -->
                            @if ($units instanceof \Illuminate\Pagination\LengthAwarePaginator && $units->total() > 0)
                                <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mt-3 pt-2">
                                    <div class="pagination-info mb-2 mb-sm-0">
                                        Menampilkan {{ $units->firstItem() }} - {{ $units->lastItem() }} dari {{ $units->total() }} unit
                                    </div>
                                    <nav aria-label="Page navigation">
                                        <ul class="pagination pagination-sm flex-wrap justify-content-center mb-0">
                                            {{-- Previous Page Link --}}
                                            @if ($units->onFirstPage())
                                                <li class="page-item disabled" aria-disabled="true">
                                                    <span class="page-link" aria-label="Previous">
                                                        <i class="mdi mdi-chevron-left"></i>
                                                    </span>
                                                </li>
                                            @else
                                                <li class="page-item">
                                                    <a class="page-link"
                                                        href="{{ $units->appends(request()->query())->previousPageUrl() }}"
                                                        rel="prev" aria-label="Previous">
                                                        <i class="mdi mdi-chevron-left"></i>
                                                    </a>
                                                </li>
                                            @endif

                                            {{-- Pagination Elements --}}
                                            @foreach ($units->getUrlRange(max(1, $units->currentPage() - 2), min($units->lastPage(), $units->currentPage() + 2)) as $page => $url)
                                                @if ($page == $units->currentPage())
                                                    <li class="page-item active" aria-current="page">
                                                        <span class="page-link">{{ $page }}</span>
                                                    </li>
                                                @else
                                                    <li class="page-item">
                                                        <a class="page-link"
                                                            href="{{ $units->appends(request()->query())->url($page) }}">{{ $page }}</a>
                                                    </li>
                                                @endif
                                            @endforeach

                                            {{-- Next Page Link --}}
                                            @if ($units->hasMorePages())
                                                <li class="page-item">
                                                    <a class="page-link"
                                                        href="{{ $units->appends(request()->query())->nextPageUrl() }}"
                                                        rel="next" aria-label="Next">
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
                                                    {{ $unit->unit_code ?? ($unit->block ?? '') . ' ' . ($unit->unit_number ?? '') }}
                                                </h6>
                                                <p class="text-muted small mb-1"><i
                                                        class="mdi mdi-office-building me-1"></i>{{ $unit->landBank->name ?? '-' }}
                                                </p>
                                                <p class="small mb-1"><i
                                                        class="mdi mdi-ruler-square me-1"></i>{{ $unit->building_area ?? ($unit->area ?? '-') }}
                                                    mÂ² | <i class="mdi mdi-currency-usd me-1"></i>Rp
                                                    {{ number_format($unit->price ?? 0, 0, ',', '.') }}</p>

                                                <div class="mt-2 border-top pt-2">
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
                                                                style="width: 24px; height: 24px; font-size: 0.7rem; background: linear-gradient(135deg, #667eea, #764ba2);">
                                                                {{ $sInitials }}
                                                            </div>
                                                            <small
                                                                class="text-muted fw-bold">{{ Str::limit($salesName, 15) }}</small>
                                                        </div>
                                                    @else
                                                        <small class="text-muted"><i
                                                                class="mdi mdi-account-tie me-1"></i>-</small>
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

                            <!-- PAGINATION - GRID VIEW -->
                            @if ($units instanceof \Illuminate\Pagination\LengthAwarePaginator && $units->total() > 0)
                                <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mt-3 pt-2">
                                    <div class="pagination-info mb-2 mb-sm-0">
                                        Menampilkan {{ $units->firstItem() }} - {{ $units->lastItem() }} dari {{ $units->total() }} unit
                                    </div>
                                    <nav aria-label="Page navigation">
                                        <ul class="pagination pagination-sm flex-wrap justify-content-center mb-0">
                                            @if ($units->onFirstPage())
                                                <li class="page-item disabled" aria-disabled="true">
                                                    <span class="page-link" aria-label="Previous">
                                                        <i class="mdi mdi-chevron-left"></i>
                                                    </span>
                                                </li>
                                            @else
                                                <li class="page-item">
                                                    <a class="page-link"
                                                        href="{{ $units->appends(request()->query())->previousPageUrl() }}"
                                                        rel="prev" aria-label="Previous">
                                                        <i class="mdi mdi-chevron-left"></i>
                                                    </a>
                                                </li>
                                            @endif

                                            @foreach ($units->getUrlRange(max(1, $units->currentPage() - 2), min($units->lastPage(), $units->currentPage() + 2)) as $page => $url)
                                                @if ($page == $units->currentPage())
                                                    <li class="page-item active" aria-current="page">
                                                        <span class="page-link">{{ $page }}</span>
                                                    </li>
                                                @else
                                                    <li class="page-item">
                                                        <a class="page-link"
                                                            href="{{ $units->appends(request()->query())->url($page) }}">{{ $page }}</a>
                                                    </li>
                                                @endif
                                            @endforeach

                                            @if ($units->hasMorePages())
                                                <li class="page-item">
                                                    <a class="page-link"
                                                        href="{{ $units->appends(request()->query())->nextPageUrl() }}"
                                                        rel="next" aria-label="Next">
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

                        <!-- DENAH VIEW -->
                        <div id="denahView" style="display: none;">
                            <div class="denah-container">
                                <div style="display:flex; flex-wrap:wrap; justify-content:center; gap:10px;">
                                    @php
                                        $unitsByProject = $units->groupBy(function ($item) {
                                            return $item->landBank->name ?? 'Tanpa Proyek';
                                        });
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
                                            <h6 class="text-primary mb-3"><i
                                                    class="mdi mdi-office-building me-2"></i>Proyek:
                                                {{ $projectName }}</h6>
                                            @foreach ($allBloks as $blok)
                                                <div style="margin-bottom:15px; width:100%;">
                                                    @php
                                                        $typesInBlok = collect($blokKavlings[$blok])
                                                            ->pluck('type')
                                                            ->unique()
                                                            ->values()
                                                            ->toArray();
                                                        $typeLetters = [];
                                                        foreach ($typesInBlok as $type) {
                                                            if ($type == 'subsidi') {
                                                                $typeLetters[] = 'S';
                                                            } elseif ($type == 'komersil') {
                                                                $typeLetters[] = 'K';
                                                            }
                                                        }
                                                        $labelType = implode(' & ', $typeLetters);
                                                    @endphp
                                                    <strong style="font-size: 14px;">Blok {{ $blok }} -
                                                        {{ $labelType }} <small
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
                                                                $unitFound = collect($blokKavlings[$blok])->firstWhere(
                                                                    'unit_code',
                                                                    $blok . '.' . $i,
                                                                );
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
                                                                            $extraStyle =
                                                                                'background-image: repeating-linear-gradient(45deg, rgba(255,255,255,0.2), rgba(255,255,255,0.2) 5px, transparent 5px, transparent 10px);';
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
                                                                @if ($typeBadge)
                                                                    <span
                                                                        class="type-badge-small">{{ $typeBadge }}</span>
                                                                @endif
                                                                <i
                                                                    class="mdi mdi-{{ $icon }} me-1"></i>{{ $blok . '.' . $i }}
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
                                            <div class="d-flex gap-2"><span class="badge bg-success">S =
                                                    Subsidi</span><span class="badge bg-primary">K = Komersil</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- SITEPLAN VIEW -->
                        <div id="sitePlandView" style="display: none;">
                            <div class="denah-container" style="padding: 1rem;">
                                <!-- Project Selector Toolbar for Siteplan -->
                                <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-3 p-3 bg-light rounded-3 border">
                                    <div class="d-flex align-items-center gap-2 flex-grow-1" style="max-width: 450px;">
                                        <label for="siteplanProjectSelect" class="fw-bold text-dark mb-0 d-flex align-items-center" style="font-size: 0.88rem; white-space: nowrap;">
                                            <i class="mdi mdi-home-city text-primary me-2" style="font-size: 1.25rem;"></i>Pilih Proyek:
                                        </label>
                                        <select id="siteplanProjectSelect" class="form-control select2" style="width: 100%;">
                                            @foreach ($projects as $p)
                                                <option value="{{ $p->id }}"
                                                    data-denah="{{ $p->denah ? asset('storage/' . $p->denah) : '' }}"
                                                    data-name="{{ $p->name }}"
                                                    {{ (request('project') == $p->id || (empty(request('project')) && $loop->first)) ? 'selected' : '' }}>
                                                    {{ $p->name }} {{ $p->denah ? ' (✓ Denah Terunggah)' : ' (Denah Default)' }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="d-flex align-items-center gap-2">
                                        <span id="siteplanDenahStatusBadge"></span>
                                    </div>
                                </div>

                                <!-- Floating Controls (Vertical Stack matching user's image) -->
                                <div class="siteplan-floating-controls">
                                    <button type="button" class="siteplan-control-btn" onclick="zoom(1.2)"
                                        title="Zoom In">
                                        <i class="mdi mdi-plus"></i>
                                    </button>
                                    <button type="button" class="siteplan-control-btn" onclick="zoom(0.8)"
                                        title="Zoom Out">
                                        <i class="mdi mdi-minus"></i>
                                    </button>
                                    <button type="button" class="siteplan-control-btn" onclick="resetZoom()"
                                        title="Reset Zoom" style="position: relative;">
                                        <i class="mdi mdi-refresh"></i>
                                        <span id="zoomPercent" class="badge bg-primary text-white"
                                            style="position: absolute; bottom: -5px; right: -5px; font-size: 0.65rem; padding: 2px 4px; border-radius: 4px;">63%</span>
                                    </button>
                                    <button type="button" class="siteplan-control-btn" id="btnFullscreen"
                                        onclick="toggleFullscreen()" title="Fullscreen">
                                        <i class="mdi mdi-fullscreen"></i>
                                    </button>
                                </div>
                                <div class="siteplan-scroll-container">
                                    <canvas id="siteplanCanvas"></canvas>
                                </div>

                                <!-- Legend Status Penjualan & Status Pembangunan Fisik -->
                                <div class="mt-3 p-3 bg-white rounded-3 border shadow-sm">
                                    <div class="row g-3">
                                        <!-- Status Progress Pembangunan -->
                                        <div class="col-md-7 border-end">
                                            <h6 class="fw-bold text-dark mb-2" style="font-size: 0.82rem;">
                                                <i class="mdi mdi-hammer-wrench text-warning me-1"></i>Status Pembangunan Fisik (Warna Bulatan):
                                            </h6>
                                            <div class="d-flex flex-wrap gap-2">
                                                <span class="badge" style="background: #adb5bd; color: #fff; font-size: 11px; padding: 4px 8px;">Belum Mulai (0%)</span>
                                                <span class="badge" style="background: #fd7e14; color: #fff; font-size: 11px; padding: 4px 8px;">Pondasi (20%)</span>
                                                <span class="badge" style="background: #ffc107; color: #212529; font-size: 11px; padding: 4px 8px;">Dinding (40%)</span>
                                                <span class="badge" style="background: #17a2b8; color: #fff; font-size: 11px; padding: 4px 8px;">Atap (60%)</span>
                                                <span class="badge" style="background: #9a55ff; color: #fff; font-size: 11px; padding: 4px 8px;">Finishing (80%)</span>
                                                <span class="badge" style="background: #28a745; color: #fff; font-size: 11px; padding: 4px 8px;">Selesai (100%)</span>
                                            </div>
                                        </div>

                                        <!-- Status Penjualan -->
                                        <div class="col-md-5">
                                            <h6 class="fw-bold text-dark mb-2" style="font-size: 0.82rem;">
                                                <i class="mdi mdi-circle-outline text-primary me-1"></i>Status Penjualan (Garis Border):
                                            </h6>
                                            <div class="d-flex flex-wrap gap-2">
                                                <span class="badge" style="background: rgba(220, 53, 69, 0.15); color: #dc3545; border: 1.5px solid #dc3545; font-size: 11px; padding: 4px 8px;">Terjual / Sold (Border Merah)</span>
                                                <span class="badge" style="background: rgba(255, 193, 7, 0.15); color: #d39e00; border: 1.5px solid #ffc107; font-size: 11px; padding: 4px 8px;">Booked (Border Emas)</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-3 text-center">
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
                                                        <div class="timeline-detail-label"><i
                                                                class="mdi mdi-home-outline"></i>Nama Unit</div>
                                                        <div class="timeline-detail-value" id="m_unit_name">-</div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="timeline-detail-item">
                                                        <div class="timeline-detail-label"><i
                                                                class="mdi mdi-alpha-b-box-outline"></i>Blok</div>
                                                        <div class="timeline-detail-value" id="m_block">-</div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="timeline-detail-item">
                                                        <div class="timeline-detail-label"><i
                                                                class="mdi mdi-numeric"></i>Nomor Unit</div>
                                                        <div class="timeline-detail-value" id="m_unit_number">-</div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="timeline-detail-item">
                                                        <div class="timeline-detail-label"><i
                                                                class="mdi mdi-format-list-bulleted-type"></i>Jenis Unit
                                                        </div>
                                                        <div class="timeline-detail-value" id="m_jenis">-</div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="timeline-detail-item">
                                                        <div class="timeline-detail-label"><i
                                                                class="mdi mdi-home-group"></i>Tipe Unit</div>
                                                        <div class="timeline-detail-value" id="m_type">-</div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="timeline-detail-item">
                                                        <div class="timeline-detail-label"><i
                                                                class="mdi mdi-ruler-square"></i>Luas Tanah</div>
                                                        <div class="timeline-detail-value" id="m_area">-</div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="timeline-detail-item">
                                                        <div class="timeline-detail-label"><i
                                                                class="mdi mdi-home-city-outline"></i>Luas Bangunan</div>
                                                        <div class="timeline-detail-value" id="m_building">-</div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="timeline-detail-item">
                                                        <div class="timeline-detail-label"><i
                                                                class="mdi mdi-cash-outline"></i>Harga</div>
                                                        <div class="timeline-detail-value price" id="m_price">-</div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="timeline-detail-item">
                                                        <div class="timeline-detail-label"><i
                                                                class="mdi mdi-compass-outline"></i>Arah Hadap</div>
                                                        <div class="timeline-detail-value" id="m_direction">-</div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="timeline-detail-item">
                                                        <div class="timeline-detail-label"><i
                                                                class="mdi mdi-toggle-switch-outline"></i>Status Unit</div>
                                                        <div class="timeline-detail-value" id="m_status">-</div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="timeline-detail-item">
                                                        <div class="timeline-detail-label"><i
                                                                class="mdi mdi-progress-check"></i>Status Pembangunan</div>
                                                        <div class="timeline-detail-value">
                                                            <div class="progress-wrapper" id="m_construction_wrapper">
                                                                <div class="progress-row">
                                                                    <div class="progress">
                                                                        <div class="progress-bar-custom progress-green"
                                                                            id="m_progress_bar" style="width: 0%"></div>
                                                                    </div>
                                                                    <span class="progress-percent"
                                                                        id="m_progress_pct">0%</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="timeline-detail-item">
                                                        <div class="timeline-detail-label"><i
                                                                class="mdi mdi-map-marker-outline"></i>Alamat</div>
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
                                                        <div class="timeline-detail-label"><i
                                                                class="mdi mdi-account-outline"></i>Customer</div>
                                                        <div class="timeline-detail-value">
                                                            <div class="name-wrap">
                                                                <div class="name-initial" id="m_customer_initial"
                                                                    style="background: linear-gradient(135deg, #da8cff, #9a55ff);">
                                                                    -</div>
                                                                <div class="name-info">
                                                                    <div class="name-title" id="m_customer">-</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="timeline-detail-item">
                                                        <div class="timeline-detail-label"><i
                                                                class="mdi mdi-account-tie-outline"></i>Sales / Agency
                                                        </div>
                                                        <div class="timeline-detail-value">
                                                            <div class="name-wrap">
                                                                <div class="name-initial" id="m_sales_initial"
                                                                    style="background: linear-gradient(135deg, #667eea, #764ba2);">
                                                                    -</div>
                                                                <div class="name-info">
                                                                    <div class="name-title" id="m_sales">-</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="timeline-detail-item">
                                                        <div class="timeline-detail-label"><i
                                                                class="mdi mdi-calendar-today"></i>Tanggal Booking</div>
                                                        <div class="timeline-detail-value" id="m_booking_date">-</div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="timeline-detail-item">
                                                        <div class="timeline-detail-label"><i
                                                                class="mdi mdi-cash-multiple"></i>Booking Fee</div>
                                                        <div class="timeline-detail-value fee-text" id="m_booking_fee">-
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="timeline-detail-item">
                                                        <div class="timeline-detail-label"><i
                                                                class="mdi mdi-hand-coin-outline"></i>Agent Fee</div>
                                                        <div class="timeline-detail-value fee-text" id="m_agent_fee">-
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="timeline-detail-item">
                                                        <div class="timeline-detail-label"><i
                                                                class="mdi mdi-toggle-switch"></i>Status Booking</div>
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
                    </div>
                </div>
            </div>
        </div>

        <!-- MODAL CUSTOMER -->
        <div class="modal fade" id="modalCustomer" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" style="max-width: 540px;">
                <div class="modal-content border-0 shadow-lg" style="border-radius: 14px; overflow: hidden;">
                    <div class="modal-header bg-light border-bottom" style="padding: 1.1rem 1.4rem;">
                        <h5 class="modal-title fw-bold text-dark mb-0 d-flex align-items-center">
                            <i class="mdi mdi-account-plus text-primary me-2" style="font-size: 1.35rem;"></i>
                            Pilih Customer & Booking Unit
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">
                        <form id="formCustomerBooking" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" id="customer_unit_id" name="unit_id">

                            <!-- Field Pilih Customer (Select2 Search) -->
                            <div class="mb-3">
                                <label class="form-label fw-bold" style="color: #3b3f5c; font-size: 0.88rem;">
                                    <i class="mdi mdi-account-search text-primary me-1"></i>Pilih Customer <span class="text-danger">*</span>
                                </label>
                                <select class="form-control select2-customer-modal" id="select_customer_id" name="customer_id" style="width: 100%;" required>
                                    <option value="">-- Cari & Pilih Customer (ID / Nama) --</option>
                                    @foreach ($customers as $c)
                                        <option value="{{ $c->id }}" data-id="{{ $c->customer_id ?? '' }}">
                                            @if(!empty($c->customer_id)) [{{ $c->customer_id }}] @endif {{ $c->full_name }}
                                        </option>
                                    @endforeach
                                </select>
                                <small class="text-muted mt-1 d-block" style="font-size: 0.78rem;">
                                    <i class="mdi mdi-information-outline me-1"></i>Cari berdasarkan ID Customer atau nama lengkap
                                </small>
                            </div>

                            <!-- Field Metode Pembayaran -->
                            <div class="mb-3">
                                <label class="form-label fw-bold" style="color: #3b3f5c; font-size: 0.88rem;">
                                    <i class="mdi mdi-credit-card-outline text-primary me-1"></i>Metode Pembayaran <span class="text-danger">*</span>
                                </label>
                                <select class="form-control" id="select_purchase_type" name="purchase_type" required style="border: 1.5px solid #e2e8f0; border-radius: 8px; min-height: 42px; font-weight: 600;">
                                    <option value="cash">Cash Keras</option>
                                    <option value="cash_tempo">Cash Tempo</option>
                                    <option value="kpr" selected>KPR</option>
                                </select>
                            </div>

                            <!-- Field Nominal Booking Fee -->
                            <div class="mb-3">
                                <label class="form-label fw-bold" style="color: #3b3f5c; font-size: 0.88rem;">
                                    <i class="mdi mdi-cash-multiple text-primary me-1"></i>Nominal Booking Fee <span class="text-danger">*</span>
                                </label>
                                <div class="input-group rupiah-input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="text" class="form-control rupiah-format" id="booking_fee" name="booking_fee" placeholder="Contoh: 5.000.000" autocomplete="off" required>
                                </div>
                                <small class="text-muted mt-1 d-block" style="font-size: 0.78rem;">
                                    <i class="mdi mdi-information-outline me-1"></i>Nominal booking fee yang dibayar oleh customer
                                </small>
                            </div>

                            <!-- Field Upload Bukti Transfer -->
                            <div class="mb-2">
                                <label class="form-label fw-bold" style="color: #3b3f5c; font-size: 0.88rem;">
                                    <i class="mdi mdi-cloud-upload text-primary me-1"></i>Upload Bukti Transfer <span class="text-danger">*</span>
                                </label>
                                <div class="file-upload-modern">
                                    <input type="file" id="bukti_transfer" name="bukti_transfer" accept=".jpg,.jpeg,.png,.pdf" required>
                                    <div class="file-label-modern" id="buktiLabel">
                                        <i class="mdi mdi-cloud-upload" style="font-size: 1.75rem; color: #9a55ff;"></i>
                                        <div class="file-info-modern">
                                            <span id="buktiFileName" class="fw-bold text-dark">Upload Bukti Transfer</span>
                                            <small class="text-muted d-block">Format: JPG, PNG, PDF (Max 2MB)</small>
                                        </div>
                                        <span class="file-size text-muted small" id="buktiFileSize"></span>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer bg-light border-top px-4 py-3 d-flex justify-content-end gap-2">
                        <button type="button" class="btn btn-secondary px-3" data-bs-dismiss="modal" style="border-radius: 8px; font-weight: 600;">
                            Batal
                        </button>
                        <button type="button" class="btn btn-gradient-primary px-4" id="btnSimpanCustomer" style="border-radius: 8px; font-weight: 600;">
                            <i class="mdi mdi-content-save me-1"></i>Simpan Customer
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- MODAL AGENCY DENGAN OTOMATISASI KOMISI -->
        <div class="modal fade" id="modalAgency" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" style="max-width: 540px;">
                <div class="modal-content border-0 shadow-lg" style="border-radius: 14px; overflow: hidden;">
                    <div class="modal-header bg-light border-bottom" style="padding: 1.1rem 1.4rem;">
                        <div>
                            <h5 class="modal-title fw-bold text-dark mb-0 d-flex align-items-center">
                                <i class="mdi mdi-office-building text-primary me-2" style="font-size: 1.35rem;"></i>
                                Pasang Agency & Komisi
                            </h5>
                            <small class="text-muted" style="font-size: 0.78rem;">Komisi agent dihitung otomatis berdasarkan master aturan</small>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">
                        <!-- Ringkasan Unit Terpilih -->
                        <div class="p-3 rounded-3 mb-3" style="background: #f8fafc; border: 1px solid #e2e8f0;">
                            <div class="d-flex justify-content-between align-items-start mb-1">
                                <div>
                                    <span class="badge bg-primary text-white mb-1" id="agency_modal_unit_code" style="font-size: 0.75rem; border-radius: 6px;">Unit -</span>
                                    <h6 class="fw-bold text-dark mb-0" id="agency_modal_unit_name">-</h6>
                                </div>
                                <span class="badge" id="agency_modal_jenis_badge" style="font-size: 0.78rem; font-weight: 700; padding: 5px 10px; border-radius: 15px;">-</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mt-2 pt-2 border-top">
                                <span class="text-muted small">Harga Jual Unit:</span>
                                <span class="fw-bold text-success" id="agency_modal_unit_price" style="font-size: 0.95rem;">Rp 0</span>
                            </div>
                        </div>

                        <form id="formAgency" method="POST">
                            @csrf
                            <input type="hidden" name="unit_id" id="agency_unit_id">

                            <!-- Field Pilih Agency (Select2 Search) -->
                            <div class="mb-3">
                                <label class="form-label fw-bold" style="color: #3b3f5c; font-size: 0.88rem;">
                                    <i class="mdi mdi-account-tie text-primary me-1"></i>Nama Agency / Agent <span class="text-danger">*</span>
                                </label>
                                <select class="form-control select2-agency-modal" id="select_sales_id" name="sales_id" style="width: 100%;" required>
                                    <option value="">-- Cari & Pilih Agency / Agent --</option>
                                    @foreach ($agencies as $a)
                                        <option value="{{ $a->id }}" data-phone="{{ $a->phone ?? '' }}" data-address="{{ $a->address ?? '' }}">
                                            {{ $a->name }} @if(!empty($a->phone)) ({{ $a->phone }}) @endif
                                        </option>
                                    @endforeach
                                </select>
                                <small class="text-muted mt-1 d-block" style="font-size: 0.78rem;">
                                    <i class="mdi mdi-information-outline me-1"></i>Ketik untuk mencari nama atau nomor HP agency
                                </small>
                            </div>

                            <!-- Box Notifikasi Otomatisasi Komisi -->
                            <div class="p-2.5 px-3 rounded-3 mb-3 d-flex align-items-center justify-content-between" id="auto_calc_info_box" style="background: #eef2ff; border: 1px solid #c7d2fe;">
                                <div class="d-flex align-items-center gap-2">
                                    <i class="mdi mdi-calculator-variant text-primary fs-5"></i>
                                    <div>
                                        <span class="fw-bold text-primary d-block" id="auto_calc_rule_name" style="font-size: 0.82rem;">Otomatisasi Komisi</span>
                                        <small class="text-muted" id="auto_calc_formula" style="font-size: 0.76rem;">Dihitung berdasarkan master aturan</small>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-xs btn-outline-primary py-1 px-2.5 d-inline-flex align-items-center gap-1" id="btnRecalculateFee" title="Hitung Ulang Berdasarkan Aturan" style="font-size: 0.74rem; border-radius: 6px;">
                                    <i class="mdi mdi-refresh"></i>
                                    <span>Hitung Ulang</span>
                                </button>
                            </div>

                            <!-- Field Nominal Agent Fee -->
                            <div class="mb-2">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <label class="form-label fw-bold mb-0" style="color: #3b3f5c; font-size: 0.88rem;">
                                        <i class="mdi mdi-cash-multiple text-primary me-1"></i>Nominal Komisi / Agent Fee <span class="text-danger">*</span>
                                    </label>
                                    <span class="badge bg-success bg-opacity-10 text-success" style="font-size: 0.72rem; font-weight: 700;">Otomatis Terisi</span>
                                </div>
                                <div class="input-group rupiah-input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="text" class="form-control rupiah-format" name="agent_fee" id="agent_fee_modal" placeholder="Contoh: 5.000.000" autocomplete="off" required>
                                </div>
                                <small class="text-muted mt-1 d-block" style="font-size: 0.78rem;">
                                    <i class="mdi mdi-check-circle-outline text-success me-1"></i>Terisi otomatis sesuai aturan komisi aktif. Anda tetap dapat mengubahnya jika ada negosiasi khusus.
                                </small>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer bg-light border-top px-4 py-3 d-flex justify-content-end gap-2">
                        <button type="button" class="btn btn-secondary px-3" data-bs-dismiss="modal" style="border-radius: 8px; font-weight: 600;">
                            Batal
                        </button>
                        <button type="button" class="btn btn-gradient-primary px-4" id="btnSimpanAgency" style="border-radius: 8px; font-weight: 600;">
                            <i class="mdi mdi-content-save me-1"></i>Simpan Agency
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- ========================================================================= -->
        <!-- MODAL MASTER ATURAN KOMISI & FEE AGENT (PENGATURAN KOMISI OTOMATIS) -->
        <!-- ========================================================================= -->
        <div class="modal fade" id="modalMasterCommissionRules" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content border-0 shadow-lg" style="border-radius: 16px; overflow: hidden;">
                    <div class="modal-header bg-gradient-primary text-white" style="padding: 1.2rem 1.5rem;">
                        <div class="d-flex align-items-center gap-2">
                            <div class="rounded-circle bg-white bg-opacity-20 p-2 d-inline-flex align-items-center justify-content-center" style="width: 42px; height: 42px;">
                                <i class="mdi mdi-cogs text-white fs-4"></i>
                            </div>
                            <div>
                                <h5 class="modal-title fw-bold text-white mb-0">Master Aturan Komisi & Fee Agent</h5>
                                <small class="text-white text-opacity-85" style="font-size: 0.8rem;">Otomatisasi perhitungan komisi agency setiap transaksi di Catalog Unit</small>
                            </div>
                        </div>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body p-3 p-md-4" style="background: #f8fafc;">
                        <!-- Summary Cards -->
                        <div class="row g-2 mb-3">
                            <div class="col-6 col-md-3">
                                <div class="card border-0 shadow-sm p-2.5 text-center" style="border-radius: 10px; background: #ffffff;">
                                    <small class="text-muted d-block" style="font-size: 0.75rem;">Total Aturan</small>
                                    <h5 class="fw-bold text-dark mb-0" id="stat_total_rules">{{ $commissionRules->count() }}</h5>
                                </div>
                            </div>
                            <div class="col-6 col-md-3">
                                <div class="card border-0 shadow-sm p-2.5 text-center" style="border-radius: 10px; background: #ffffff;">
                                    <small class="text-muted d-block" style="font-size: 0.75rem;">Aturan Aktif</small>
                                    <h5 class="fw-bold text-success mb-0" id="stat_active_rules">{{ $commissionRules->where('is_active', true)->count() }}</h5>
                                </div>
                            </div>
                            <div class="col-6 col-md-3">
                                <div class="card border-0 shadow-sm p-2.5 text-center" style="border-radius: 10px; background: #ffffff;">
                                    <small class="text-muted d-block" style="font-size: 0.75rem;">Skema Komersil</small>
                                    <h5 class="fw-bold text-primary mb-0">{{ $commissionRules->where('target_type', 'komersil')->count() }}</h5>
                                </div>
                            </div>
                            <div class="col-6 col-md-3">
                                <div class="card border-0 shadow-sm p-2.5 text-center" style="border-radius: 10px; background: #ffffff;">
                                    <small class="text-muted d-block" style="font-size: 0.75rem;">Skema Subsidi</small>
                                    <h5 class="fw-bold text-info mb-0">{{ $commissionRules->where('target_type', 'subsidi')->count() }}</h5>
                                </div>
                            </div>
                        </div>

                        <!-- Top Action: Button Tambah Aturan Baru -->
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h6 class="fw-bold text-dark mb-0" style="font-size: 0.95rem;">
                                <i class="mdi mdi-format-list-bulleted-type text-primary me-1"></i>Daftar Aturan Komisi Aktif
                            </h6>
                            <button type="button" class="btn btn-sm btn-gradient-primary d-inline-flex align-items-center gap-1.5 px-3 py-1.5 shadow-sm"
                                id="btnToggleFormRule" style="border-radius: 8px; font-weight: 600; font-size: 0.82rem;">
                                <i class="mdi mdi-plus-circle"></i>
                                <span>+ Tambah Aturan Komisi</span>
                            </button>
                        </div>

                        <!-- Form Tambah / Edit Aturan (Collapsible Card) -->
                        <div class="card border-0 shadow-sm mb-3 d-none" id="formRuleContainer" style="border-radius: 12px; background: #ffffff; border: 1px solid #e0e7ff;">
                            <div class="card-header bg-white py-2.5 px-3 border-bottom d-flex justify-content-between align-items-center">
                                <span class="fw-bold text-primary small" id="formRuleTitle">
                                    <i class="mdi mdi-pencil-plus me-1"></i>Form Tambah Aturan Komisi Baru
                                </span>
                                <button type="button" class="btn-close btn-sm" id="btnCloseFormRule" style="font-size: 0.7rem;"></button>
                            </div>
                            <div class="card-body p-3 p-md-3">
                                <form id="formCommissionRule">
                                    @csrf
                                    <input type="hidden" id="rule_id" name="rule_id" value="">
                                    
                                    <div class="row g-2.5">
                                        <!-- Nama Aturan -->
                                        <div class="col-12 col-md-6">
                                            <label class="form-label fw-bold small text-dark mb-1">Nama Aturan <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control form-control-sm" id="rule_name" name="name" placeholder="Contoh: Komisi Komersil 2.5%" required>
                                        </div>

                                        <!-- Target Proyek -->
                                        <div class="col-12 col-md-6">
                                            <label class="form-label fw-bold small text-dark mb-1">Target Proyek</label>
                                            <select class="form-select form-select-sm" id="rule_land_bank_id" name="land_bank_id">
                                                <option value="">-- Berlaku untuk Semua Proyek --</option>
                                                @foreach ($projects as $prj)
                                                    <option value="{{ $prj->id }}">{{ $prj->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <!-- Target Jenis Unit -->
                                        <div class="col-12 col-md-4">
                                            <label class="form-label fw-bold small text-dark mb-1">Target Jenis Unit <span class="text-danger">*</span></label>
                                            <select class="form-select form-select-sm" id="rule_target_type" name="target_type" required>
                                                <option value="all">Semua Jenis Unit</option>
                                                <option value="komersil">Khusus Komersil</option>
                                                <option value="subsidi">Khusus Subsidi</option>
                                            </select>
                                        </div>

                                        <!-- Metode Perhitungan Komisi -->
                                        <div class="col-12 col-md-4">
                                            <label class="form-label fw-bold small text-dark mb-1">Metode Komisi <span class="text-danger">*</span></label>
                                            <select class="form-select form-select-sm" id="rule_calculation_type" name="calculation_type" required>
                                                <option value="percentage">Persentase (% dari Harga Jual)</option>
                                                <option value="fixed">Nominal Tetap (Flat Rp)</option>
                                            </select>
                                        </div>

                                        <!-- Nilai Komisi -->
                                        <div class="col-12 col-md-4">
                                            <label class="form-label fw-bold small text-dark mb-1" id="rule_value_label">Nilai Komisi (%) <span class="text-danger">*</span></label>
                                            <div class="input-group input-group-sm">
                                                <span class="input-group-text fw-bold text-primary" id="rule_value_prefix">%</span>
                                                <input type="number" step="any" min="0" class="form-control form-control-sm" id="rule_value" name="value" placeholder="2.5" required>
                                            </div>
                                        </div>

                                        <!-- Keterangan -->
                                        <div class="col-12">
                                            <label class="form-label fw-bold small text-dark mb-1">Keterangan / Deskripsi</label>
                                            <input type="text" class="form-control form-control-sm" id="rule_description" name="description" placeholder="Catatan aturan komisi (opsional)">
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-end gap-2 mt-3 pt-2 border-top">
                                        <button type="button" class="btn btn-sm btn-light border px-3" id="btnCancelFormRule">Batal</button>
                                        <button type="submit" class="btn btn-sm btn-gradient-primary px-3 fw-bold" id="btnSaveCommissionRule">
                                            <i class="mdi mdi-content-save me-1"></i>Simpan Aturan
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Daftar Aturan Cards / Table -->
                        <div class="table-responsive bg-white rounded-3 shadow-sm border">
                            <table class="table table-hover align-middle mb-0" id="tableCommissionRules" style="font-size: 0.85rem;">
                                <thead class="table-light">
                                    <tr style="background: #f8fafc; border-bottom: 2px solid #e2e8f0;">
                                        <th class="py-2.5 px-3" style="color: #334155; font-weight: 800; font-size: 0.8rem;">Nama Aturan</th>
                                        <th class="py-2.5" style="color: #334155; font-weight: 800; font-size: 0.8rem;">Proyek</th>
                                        <th class="py-2.5" style="color: #334155; font-weight: 800; font-size: 0.8rem;">Target Unit</th>
                                        <th class="py-2.5" style="color: #334155; font-weight: 800; font-size: 0.8rem;">Skema Komisi</th>
                                        <th class="py-2.5 text-center" style="color: #334155; font-weight: 800; font-size: 0.8rem;">Status</th>
                                        <th class="py-2.5 text-center" style="width: 100px; color: #334155; font-weight: 800; font-size: 0.8rem;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($commissionRules as $rule)
                                        <tr id="rule_row_{{ $rule->id }}">
                                            <td class="px-3">
                                                <span class="fw-bold text-dark d-block">{{ $rule->name }}</span>
                                                @if($rule->description)
                                                    <small class="text-muted" style="font-size: 0.75rem;">{{ $rule->description }}</small>
                                                @endif
                                            </td>
                                            <td>
                                                @if($rule->land_bank_id)
                                                    <span class="badge" style="background: #e0f2fe !important; color: #0369a1 !important; border: 1px solid #bae6fd; font-weight: 700; font-size: 0.76rem; padding: 4px 8px; border-radius: 6px;">
                                                        <i class="mdi mdi-office-building me-1"></i>{{ $rule->landBank->name ?? '-' }}
                                                    </span>
                                                @else
                                                    <span class="badge" style="background: #f1f5f9 !important; color: #1e293b !important; border: 1px solid #cbd5e1; font-weight: 700; font-size: 0.76rem; padding: 4px 8px; border-radius: 6px;">
                                                        <i class="mdi mdi-earth me-1 text-secondary"></i>Semua Proyek
                                                    </span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($rule->target_type === 'komersil')
                                                    <span class="badge" style="background: #6366f1 !important; color: #ffffff !important; font-weight: 700; font-size: 0.76rem; padding: 4px 8px; border-radius: 6px;">Komersil</span>
                                                @elseif($rule->target_type === 'subsidi')
                                                    <span class="badge" style="background: #10b981 !important; color: #ffffff !important; font-weight: 700; font-size: 0.76rem; padding: 4px 8px; border-radius: 6px;">Subsidi</span>
                                                @else
                                                    <span class="badge" style="background: #475569 !important; color: #ffffff !important; font-weight: 700; font-size: 0.76rem; padding: 4px 8px; border-radius: 6px;">Semua Unit</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($rule->calculation_type === 'percentage')
                                                    <span class="fw-bold text-primary" style="font-size: 0.88rem;">{{ floatval($rule->value) }}%</span>
                                                    <small class="text-muted d-block" style="font-size: 0.72rem;">dari Harga Jual</small>
                                                @else
                                                    <span class="fw-bold text-success" style="font-size: 0.88rem;">Rp {{ number_format($rule->value, 0, ',', '.') }}</span>
                                                    <small class="text-muted d-block" style="font-size: 0.72rem;">Nominal Flat per Unit</small>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <div class="form-check form-switch d-inline-block m-0">
                                                    <input class="form-check-input switch-rule-status" type="checkbox" role="switch"
                                                        data-id="{{ $rule->id }}" {{ $rule->is_active ? 'checked' : '' }} style="cursor: pointer;">
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <div class="d-inline-flex gap-1">
                                                    <button type="button" class="btn btn-xs btn-outline-primary btn-edit-rule p-1"
                                                        data-id="{{ $rule->id }}"
                                                        data-name="{{ $rule->name }}"
                                                        data-land_bank_id="{{ $rule->land_bank_id ?? '' }}"
                                                        data-target_type="{{ $rule->target_type }}"
                                                        data-calculation_type="{{ $rule->calculation_type }}"
                                                        data-value="{{ floatval($rule->value) }}"
                                                        data-description="{{ $rule->description ?? '' }}"
                                                        title="Edit Aturan" style="border-radius: 5px; width: 28px; height: 28px;">
                                                        <i class="mdi mdi-pencil" style="font-size: 0.85rem;"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-xs btn-outline-danger btn-delete-rule p-1"
                                                        data-id="{{ $rule->id }}"
                                                        title="Hapus Aturan" style="border-radius: 5px; width: 28px; height: 28px;">
                                                        <i class="mdi mdi-trash-can-outline" style="font-size: 0.85rem;"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr id="empty_rule_row">
                                            <td colspan="6" class="text-center py-4 text-muted">
                                                <i class="mdi mdi-information-outline fs-4 d-block mb-1"></i>
                                                Belum ada aturan komisi. Silakan tambah aturan baru di atas.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- Live Interactive Simulator Box -->
                        <div class="card border-0 shadow-sm mt-3 p-3" style="border-radius: 12px; background: #f0fdf4; border: 1px solid #bbf7d0;">
                            <span class="fw-bold text-success small mb-2 d-flex align-items-center">
                                <i class="mdi mdi-calculator text-success fs-5 me-1"></i>Simulasi Kalkulator Komisi Live
                            </span>
                            <div class="row g-2 align-items-center">
                                <div class="col-12 col-md-5">
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text bg-white">Harga Unit Rp</span>
                                        <input type="text" class="form-control rupiah-format" id="sim_price" value="200.000.000" placeholder="200.000.000">
                                    </div>
                                </div>
                                <div class="col-12 col-md-3">
                                    <select class="form-select form-select-sm" id="sim_jenis">
                                        <option value="komersil">Komersil</option>
                                        <option value="subsidi">Subsidi</option>
                                    </select>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="p-2 rounded-2 bg-white border text-end">
                                        <small class="text-muted d-block" style="font-size: 0.72rem;">Hasil Komisi:</small>
                                        <span class="fw-bold text-success" id="sim_result" style="font-size: 0.95rem;">Rp 5.000.000</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer bg-white border-top px-4 py-2.5 d-flex justify-content-between align-items-center">
                        <small class="text-muted" style="font-size: 0.78rem;">
                            <i class="mdi mdi-shield-check text-success me-1"></i>Perhitungan komisi akan langsung terintegrasi otomatis ke setiap pemilihan Agency
                        </small>
                        <button type="button" class="btn btn-sm btn-secondary px-3" data-bs-dismiss="modal" style="border-radius: 8px;">Tutup</button>
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
</div>
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/5.3.0/fabric.min.js"></script>

    <script>
        // ========== MASTER COMMISSION RULES & CATALOG UNITS MAP ==========
        window.commissionRules = @json($commissionRules);
        window.catalogUnitsMap = {
            @foreach($unitsForSvg as $u)
            {{ $u->id }}: {
                id: {{ $u->id }},
                unit_code: "{{ $u->unit_code }}",
                unit_name: "{{ str_replace(["\r", "\n"], ' ', addslashes($u->unit_name ?? '')) }}",
                block: "{{ $u->block }}",
                unit_number: "{{ $u->unit_number }}",
                jenis: "{{ $u->jenis ?? $u->type }}",
                type: "{{ $u->type }}",
                price: {{ $u->price ?? 0 }},
                land_bank_id: {{ $u->land_bank_id ?? 'null' }}
            },
            @endforeach
        };

        // Fungsi Hitung Komisi Agent Otomatis Client-side
        window.calculateAgentFee = function(price, jenis, landBankId) {
            const unitPrice = parseFloat(String(price).replace(/[^0-9.]/g, '')) || 0;
            const cleanJenis = String(jenis || 'komersil').toLowerCase().trim();
            const rules = window.commissionRules || [];

            // Filter aturan yang aktif
            const activeRules = rules.filter(r => r.is_active == 1 || r.is_active === true);

            let matched = null;

            // 1. Coba aturan spesifik proyek & spesifik jenis
            matched = activeRules.find(r => {
                if (r.land_bank_id && r.land_bank_id == landBankId && r.target_type === cleanJenis) {
                    if (r.min_price && unitPrice < parseFloat(r.min_price)) return false;
                    if (r.max_price && unitPrice > parseFloat(r.max_price)) return false;
                    return true;
                }
                return false;
            });

            // 2. Coba aturan spesifik proyek & target all
            if (!matched) {
                matched = activeRules.find(r => {
                    if (r.land_bank_id && r.land_bank_id == landBankId && r.target_type === 'all') {
                        if (r.min_price && unitPrice < parseFloat(r.min_price)) return false;
                        if (r.max_price && unitPrice > parseFloat(r.max_price)) return false;
                        return true;
                    }
                    return false;
                });
            }

            // 3. Coba aturan global spesifik jenis (misal: semua komersil / semua subsidi)
            if (!matched) {
                matched = activeRules.find(r => {
                    if (!r.land_bank_id && r.target_type === cleanJenis) {
                        if (r.min_price && unitPrice < parseFloat(r.min_price)) return false;
                        if (r.max_price && unitPrice > parseFloat(r.max_price)) return false;
                        return true;
                    }
                    return false;
                });
            }

            // 4. Coba aturan global target all
            if (!matched) {
                matched = activeRules.find(r => {
                    if (!r.land_bank_id && r.target_type === 'all') {
                        if (r.min_price && unitPrice < parseFloat(r.min_price)) return false;
                        if (r.max_price && unitPrice > parseFloat(r.max_price)) return false;
                        return true;
                    }
                    return false;
                });
            }

            if (!matched) {
                // Fallback default
                if (cleanJenis === 'subsidi') {
                    return {
                        fee: 3500000,
                        ruleName: 'Default Subsidi Flat',
                        formula: 'Nominal Flat Rp 3.500.000',
                        ruleId: null
                    };
                } else {
                    const calculated = Math.round((unitPrice * 2.5) / 100);
                    return {
                        fee: calculated,
                        ruleName: 'Default Komersil (2.5%)',
                        formula: '2.5% dari Harga Jual (Rp ' + new Intl.NumberFormat('id-ID').format(calculated) + ')',
                        ruleId: null
                    };
                }
            }

            let fee = 0;
            let formula = '';
            const val = parseFloat(matched.value) || 0;
            if (matched.calculation_type === 'percentage') {
                fee = Math.round((unitPrice * val) / 100);
                formula = `${val}% dari Harga Jual (Rp ${new Intl.NumberFormat('id-ID').format(fee)})`;
            } else {
                fee = Math.round(val);
                formula = `Nominal Flat Rp ${new Intl.NumberFormat('id-ID').format(fee)}`;
            }

            return {
                fee: fee,
                ruleName: matched.name,
                formula: formula,
                ruleId: matched.id
            };
        };

        // ========== POPULATE DETAIL MODAL DIRECTLY ==========
        window.populateModalDirectly = function(data) {
            // ---- Informasi Unit ----
            document.getElementById('m_unit_name').innerText = data.unitName || '-';
            document.getElementById('m_block').innerText = data.block || '-';
            document.getElementById('m_unit_number').innerText = data.unitNumber || '-';
            document.getElementById('m_jenis').innerText = data.jenis || '-';
            document.getElementById('m_type').innerText = data.type || '-';
            document.getElementById('m_area').innerText = new Intl.NumberFormat('id-ID').format(data.area || 0) +
                ' m\u00b2';
            document.getElementById('m_building').innerText = new Intl.NumberFormat('id-ID').format(data.building ||
                0) + ' m\u00b2';
            document.getElementById('m_price').innerText = 'Rp ' + new Intl.NumberFormat('id-ID').format(data.price ||
                0);
            document.getElementById('m_direction').innerText = data.direction || '-';
            document.getElementById('m_address').innerText = data.address || '-';

            // ---- Badge Status Unit ----
            const statusRaw = data.statusRaw || '';
            const statusText = data.statusText || statusRaw;
            const jenisRaw = (data.jenis || '').toLowerCase();
            const typeRaw = (data.type || '').toLowerCase();
            let statusBadgeHtml = '';
            if (statusRaw === 'ready' || statusRaw === 'tersedia') {
                const cls = (jenisRaw === 'subsidi' || typeRaw === 'subsidi') ? 'badge-available-subsidi' :
                    'badge-available-komersil';
                statusBadgeHtml =
                    `<span class="badge-soft ${cls}"><i class="mdi mdi-check-circle-outline"></i>Tersedia</span>`;
            } else if (statusRaw === 'booked') {
                statusBadgeHtml =
                    `<span class="badge-soft badge-booking"><i class="mdi mdi-bookmark-check-outline"></i>Booking</span>`;
            } else if (statusRaw === 'sold') {
                statusBadgeHtml =
                `<span class="badge-soft badge-sold"><i class="mdi mdi-cash-check"></i>Terjual</span>`;
            } else {
                statusBadgeHtml =
                    `<span class="badge-soft badge-draft"><i class="mdi mdi-information-outline"></i>${statusText || 'Draft'}</span>`;
            }
            document.getElementById('m_status').innerHTML = statusBadgeHtml;

            // ---- Progress Pembangunan ----
            const progressMap = {
                belum_mulai: 0,
                pondasi: 20,
                dinding: 40,
                atap: 60,
                finishing: 80,
                selesai: 100
            };
            const pct = progressMap[data.construction] !== undefined ? progressMap[data.construction] : 0;
            document.getElementById('m_progress_bar').style.width = pct + '%';
            document.getElementById('m_progress_bar').className = 'progress-bar-custom ' + (pct < 100 ?
                'progress-green' : 'progress-dark-green');
            document.getElementById('m_progress_pct').innerText = pct + '%';

            // ---- Booking Card Show/Hide ----
            const hasBooking = data.hasBooking === 1 || data.hasBooking === '1' || data.hasBooking === true;
            document.getElementById('m_booking_card').style.display = hasBooking ? '' : 'none';
            document.getElementById('m_no_booking_card').style.display = hasBooking ? 'none' : '';

            if (hasBooking) {
                const customerName = data.customer || '-';
                const salesName = data.sales || '-';

                document.getElementById('m_customer').innerText = customerName;
                document.getElementById('m_customer_initial').innerText = (customerName !== '-' && customerName) ?
                    customerName.trim().charAt(0).toUpperCase() : '?';
                document.getElementById('m_sales').innerText = salesName;
                document.getElementById('m_sales_initial').innerText = (salesName !== '-' && salesName) ? salesName
                    .trim().charAt(0).toUpperCase() : '?';
                document.getElementById('m_booking_date').innerText = data.bookingDate || '-';
                document.getElementById('m_booking_fee').innerText = 'Rp ' + new Intl.NumberFormat('id-ID').format(data
                    .bookingFee || 0);
                document.getElementById('m_agent_fee').innerText = 'Rp ' + new Intl.NumberFormat('id-ID').format(data
                    .agentFee || 0);

                // Badge Status Booking
                const bookingStatus = data.bookingStatus || '-';
                let bookingBadgeHtml = '';
                if (bookingStatus === 'active') {
                    bookingBadgeHtml =
                        `<span class="badge-soft badge-available-subsidi"><i class="mdi mdi-check-circle"></i>Aktif</span>`;
                } else if (bookingStatus === 'completed' || bookingStatus === 'lunas') {
                    bookingBadgeHtml =
                        `<span class="badge-soft badge-available-subsidi"><i class="mdi mdi-check-circle"></i>Selesai</span>`;
                } else if (bookingStatus === 'cancelled') {
                    bookingBadgeHtml =
                        `<span class="badge-soft badge-sold"><i class="mdi mdi-close-circle-outline"></i>Dibatalkan</span>`;
                } else {
                    const bLabel = bookingStatus.charAt(0).toUpperCase() + bookingStatus.slice(1);
                    bookingBadgeHtml =
                        `<span class="badge-soft badge-draft"><i class="mdi mdi-clock-outline"></i>${bLabel}</span>`;
                }
                document.getElementById('m_booking_status').innerHTML = bookingBadgeHtml;
            }
        };

        // ========== DETAIL MODAL HANDLER ==========
        const detailModal = document.getElementById('detailUnitModal');
        if (detailModal) {
            detailModal.addEventListener('show.bs.modal', function(event) {
                let button = event.relatedTarget;
                if (!button) return; // Triggered programmatically, already populated!

                // ---- Informasi Unit ----
                document.getElementById('m_unit_name').innerText = button.getAttribute('data-unit_name') || '-';
                document.getElementById('m_block').innerText = button.getAttribute('data-block') || '-';
                document.getElementById('m_unit_number').innerText = button.getAttribute('data-unit_number') || '-';
                document.getElementById('m_jenis').innerText = button.getAttribute('data-jenis') || '-';
                document.getElementById('m_type').innerText = button.getAttribute('data-type') || '-';
                document.getElementById('m_area').innerText = new Intl.NumberFormat('id-ID').format(button
                    .getAttribute('data-area') || 0) + ' m\u00b2';
                document.getElementById('m_building').innerText = new Intl.NumberFormat('id-ID').format(button
                    .getAttribute('data-building') || 0) + ' m\u00b2';
                document.getElementById('m_price').innerText = 'Rp ' + new Intl.NumberFormat('id-ID').format(button
                    .getAttribute('data-price') || 0);
                document.getElementById('m_direction').innerText = button.getAttribute('data-direction') || '-';
                document.getElementById('m_address').innerText = button.getAttribute('data-address') || '-';

                // ---- Badge Status Unit ----
                const statusRaw = button.getAttribute('data-status_raw') || '';
                const statusText = button.getAttribute('data-status_text') || statusRaw;
                const jenisRaw = (button.getAttribute('data-jenis') || '').toLowerCase();
                const typeRaw = (button.getAttribute('data-type') || '').toLowerCase();
                let statusBadgeHtml = '';
                if (statusRaw === 'ready' || statusRaw === 'tersedia') {
                    const cls = (jenisRaw === 'subsidi' || typeRaw === 'subsidi') ? 'badge-available-subsidi' :
                        'badge-available-komersil';
                    statusBadgeHtml =
                        `<span class="badge-soft ${cls}"><i class="mdi mdi-check-circle-outline"></i>Tersedia</span>`;
                } else if (statusRaw === 'booked') {
                    statusBadgeHtml =
                        `<span class="badge-soft badge-booking"><i class="mdi mdi-bookmark-check-outline"></i>Booking</span>`;
                } else if (statusRaw === 'sold') {
                    statusBadgeHtml =
                        `<span class="badge-soft badge-sold"><i class="mdi mdi-cash-check"></i>Terjual</span>`;
                } else {
                    statusBadgeHtml =
                        `<span class="badge-soft badge-draft"><i class="mdi mdi-information-outline"></i>${statusText || 'Draft'}</span>`;
                }
                document.getElementById('m_status').innerHTML = statusBadgeHtml;

                // ---- Progress Pembangunan ----
                const progressMap = {
                    belum_mulai: 0,
                    pondasi: 20,
                    dinding: 40,
                    atap: 60,
                    finishing: 80,
                    selesai: 100
                };
                const construction = button.getAttribute('data-construction') || 'belum_mulai';
                const pct = progressMap[construction] !== undefined ? progressMap[construction] : 0;
                document.getElementById('m_progress_bar').style.width = pct + '%';
                document.getElementById('m_progress_bar').className = 'progress-bar-custom ' + (pct < 100 ?
                    'progress-green' : 'progress-dark-green');
                document.getElementById('m_progress_pct').innerText = pct + '%';

                // ---- Booking Card Show/Hide ----
                const hasBooking = button.getAttribute('data-has_booking') === '1';
                document.getElementById('m_booking_card').style.display = hasBooking ? '' : 'none';
                document.getElementById('m_no_booking_card').style.display = hasBooking ? 'none' : '';

                if (hasBooking) {
                    const customerName = button.getAttribute('data-customer') || '-';
                    const salesName = button.getAttribute('data-sales') || '-';

                    document.getElementById('m_customer').innerText = customerName;
                    document.getElementById('m_customer_initial').innerText = (customerName !== '-' &&
                        customerName) ? customerName.trim().charAt(0).toUpperCase() : '?';
                    document.getElementById('m_sales').innerText = salesName;
                    document.getElementById('m_sales_initial').innerText = (salesName !== '-' && salesName) ?
                        salesName.trim().charAt(0).toUpperCase() : '?';
                    document.getElementById('m_booking_date').innerText = button.getAttribute(
                        'data-booking_date') || '-';
                    document.getElementById('m_booking_fee').innerText = 'Rp ' + new Intl.NumberFormat('id-ID')
                        .format(button.getAttribute('data-booking_fee') || 0);
                    document.getElementById('m_agent_fee').innerText = 'Rp ' + new Intl.NumberFormat('id-ID')
                        .format(button.getAttribute('data-agent_fee') || 0);

                    // Badge Status Booking
                    const bookingStatus = button.getAttribute('data-booking_status') || '-';
                    let bookingBadgeHtml = '';
                    if (bookingStatus === 'active') {
                        bookingBadgeHtml =
                            `<span class="badge-soft badge-available-subsidi"><i class="mdi mdi-check-circle"></i>Aktif</span>`;
                    } else if (bookingStatus === 'completed' || bookingStatus === 'lunas') {
                        bookingBadgeHtml =
                            `<span class="badge-soft badge-available-subsidi"><i class="mdi mdi-check-circle"></i>Selesai</span>`;
                    } else if (bookingStatus === 'cancelled') {
                        bookingBadgeHtml =
                            `<span class="badge-soft badge-sold"><i class="mdi mdi-close-circle-outline"></i>Dibatalkan</span>`;
                    } else {
                        const bLabel = bookingStatus.charAt(0).toUpperCase() + bookingStatus.slice(1);
                        bookingBadgeHtml =
                            `<span class="badge-soft badge-draft"><i class="mdi mdi-clock-outline"></i>${bLabel}</span>`;
                    }
                    document.getElementById('m_booking_status').innerHTML = bookingBadgeHtml;
                }
            });
        }

        
        // ========== SITEPLAN CANVAS (DINAMIS DENAH LANDBANK) ==========
        const canvas = new fabric.Canvas('siteplanCanvas');
        let originalWidth = 0;
        let originalHeight = 0;
        let zoomLevel = 1.0;
        let isCanvasFocused = false;

        // Dataset Semua Unit untuk Siteplan
        const allUnitsData = [
            @foreach ($unitsForSvg as $unit)
            {
                id: "{{ $unit->id }}",
                land_bank_id: "{{ $unit->land_bank_id }}",
                unitCode: "{{ $unit->unit_code }}",
                unitName: "{{ str_replace(["\r", "\n"], ' ', addslashes($unit->unit_name ?? '-')) }}",
                unitNumber: "{{ str_replace(["\r", "\n"], ' ', addslashes($unit->unit_number ?? '-')) }}",
                block: "{{ str_replace(["\r", "\n"], ' ', addslashes($unit->block ?? '-')) }}",
                jenis: "{{ str_replace(["\r", "\n"], ' ', addslashes($unit->jenis ?? '-')) }}",
                type: "{{ str_replace(["\r", "\n"], ' ', addslashes($unit->type ?? '-')) }}",
                address: "{{ str_replace(["\r", "\n"], ' ', addslashes($unit->landBank->address ?? '-')) }}",
                area: {{ $unit->area ?? 0 }},
                building: {{ $unit->building_area ?? 0 }},
                price: {{ $unit->price ?? 0 }},
                direction: "{{ str_replace(["\r", "\n"], ' ', addslashes($unit->facing ?? '-')) }}",
                statusRaw: "{{ $unit->status }}",
                statusText: "{{ $unit->status == 'ready' || $unit->status == 'tersedia' ? 'Tersedia' : ($unit->status == 'sold' ? 'Terjual' : 'Booking') }}",
                construction: "{{ $unit->construction_progress ?? 'belum_mulai' }}",
                hasBooking: {{ $unit->activeBooking ? 1 : 0 }},
                customer: "{{ str_replace(["\r", "\n"], ' ', addslashes($unit->activeBooking->customer->full_name ?? '-')) }}",
                sales: "{{ str_replace(["\r", "\n"], ' ', addslashes($unit->activeBooking->sales->name ?? '-')) }}",
                bookingDate: "{{ $unit->activeBooking ? \Carbon\Carbon::parse($unit->activeBooking->booking_date)->format('d F Y') : '-' }}",
                bookingFee: {{ $unit->activeBooking->booking_fee ?? 0 }},
                agentFee: {{ $unit->activeBooking->agent_fee ?? 0 }},
                bookingStatus: "{{ str_replace(["\r", "\n"], ' ', addslashes($unit->activeBooking->status ?? '-')) }}",
                pos_x: {{ $unit->pos_x ?? 100 }},
                pos_y: {{ $unit->pos_y ?? 100 }},
                width: {{ $unit->width ?? 80 }},
                angle: {{ $unit->angle ?? 0 }},
            },
            @endforeach
        ];

        // Function Load Siteplan Berdasarkan Proyek & Denah yang Diupload
        function loadProjectSiteplan(landBankId) {
            const projectSelect = document.getElementById('siteplanProjectSelect');
            let selectedOption = null;
            if (projectSelect) {
                if (landBankId) {
                    projectSelect.value = landBankId;
                }
                selectedOption = projectSelect.options[projectSelect.selectedIndex];
            }

            const denahUrl = (selectedOption && selectedOption.dataset.denah) ? selectedOption.dataset.denah : "{{ asset('images/siteplan.jpeg') }}";
            const hasCustomDenah = !!(selectedOption && selectedOption.dataset.denah);
            const projectName = selectedOption ? selectedOption.dataset.name : 'Proyek';

            const statusBadge = document.getElementById('siteplanDenahStatusBadge');
            if (statusBadge) {
                if (hasCustomDenah) {
                    statusBadge.innerHTML = `<span class="badge bg-success" style="font-size: 0.78rem; border-radius: 6px;"><i class="mdi mdi-check-circle me-1"></i>Denah Proyek (${projectName}) Terpasang</span>`;
                } else {
                    statusBadge.innerHTML = `<span class="badge bg-warning text-dark" style="font-size: 0.78rem; border-radius: 6px;"><i class="mdi mdi-information me-1"></i>Denah Default (Belum upload denah di Landbank)</span>`;
                }
            }

            // Bersihkan objek lama di canvas
            canvas.clear();

            fabric.Image.fromURL(denahUrl, function(img) {
                originalWidth = img.width;
                originalHeight = img.height;

                canvas.defaultCursor = 'grab';

                canvas.setBackgroundImage(img, function() {
                    const curProjectId = projectSelect ? projectSelect.value : landBankId;
                    const unitsToShow = curProjectId 
                        ? allUnitsData.filter(u => u.land_bank_id == curProjectId)
                        : allUnitsData;

                    unitsToShow.forEach(u => {
                        let fillColor = '#adb5bd'; // default abu-abu untuk Belum Mulai (0%)
                        let strokeColor = '#495057';
                        let strokeWidth = 1.5;
                        let strokeDash = null;

                        switch (u.construction) {
                            case 'pondasi':
                                fillColor = '#fd7e14'; // Oranye
                                strokeColor = '#d96509';
                                strokeWidth = 3;
                                strokeDash = [5, 2];
                                break;
                            case 'dinding':
                                fillColor = '#ffc107'; // Kuning Emas
                                strokeColor = '#d39e00';
                                strokeWidth = 3;
                                strokeDash = [5, 2];
                                break;
                            case 'atap':
                                fillColor = '#17a2b8'; // Cyan
                                strokeColor = '#117a8b';
                                strokeWidth = 3.5;
                                strokeDash = [6, 2];
                                break;
                            case 'finishing':
                                fillColor = '#9a55ff'; // Ungu
                                strokeColor = '#7a3bcf';
                                strokeWidth = 3.5;
                                strokeDash = [6, 2];
                                break;
                            case 'selesai':
                                fillColor = '#28a745'; // HIJAU HANYA JIKA PEMBANGUNAN SUDAH SELESAI (100%)
                                strokeColor = '#1e7e34';
                                strokeWidth = 3;
                                break;
                            default:
                                fillColor = '#adb5bd';
                                strokeColor = '#6c757d';
                                strokeWidth = 1.5;
                                break;
                        }

                        // Border status penjualan
                        if (u.statusRaw === 'sold') {
                            strokeColor = '#dc3545';
                            strokeWidth = 4;
                            strokeDash = null;
                        } else if (u.statusRaw === 'booked') {
                            strokeColor = '#ffc107';
                            strokeWidth = 3.5;
                        }

                        const circle = new fabric.Circle({
                            left: u.pos_x,
                            top: u.pos_y,
                            radius: u.width / 2,
                            angle: u.angle,
                            fill: fillColor,
                            opacity: 0.75,
                            stroke: strokeColor,
                            strokeWidth: strokeWidth,
                            strokeDashArray: strokeDash,
                            hasControls: true,
                            hasBorders: true,
                            lockRotation: false
                        });

                        circle.unitId = u.id;
                        circle.unitCode = u.unitCode;
                        circle.unitName = u.unitName;
                        circle.unitNumber = u.unitNumber;
                        circle.block = u.block;
                        circle.jenis = u.jenis;
                        circle.type = u.type;
                        circle.address = u.address;
                        circle.area = u.area;
                        circle.building = u.building;
                        circle.price = u.price;
                        circle.direction = u.direction;
                        circle.statusRaw = u.statusRaw;
                        circle.statusText = u.statusText;
                        circle.construction = u.construction;
                        circle.hasBooking = u.hasBooking;
                        circle.customer = u.customer;
                        circle.sales = u.sales;
                        circle.bookingDate = u.bookingDate;
                        circle.bookingFee = u.bookingFee;
                        circle.agentFee = u.agentFee;
                        circle.bookingStatus = u.bookingStatus;

                        canvas.add(circle);
                    });

                    resetZoom();
                    canvas.renderAll();
                }, {
                    originX: 'left',
                    originY: 'top'
                });
            });
        }

        // Listener jika dropdown proyek di tab siteplan diganti
        document.addEventListener('DOMContentLoaded', function() {
            const projectSelect = document.getElementById('siteplanProjectSelect');
            if (projectSelect) {
                projectSelect.addEventListener('change', function() {
                    loadProjectSiteplan(this.value);
                });
            }
            loadProjectSiteplan(projectSelect ? projectSelect.value : null);
        });

        // Zoom on Mouse Wheel (Figma/Canva style: Zoom to the exact mouse pointer position!)
        canvas.on('mouse:wheel', function(opt) {
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

        canvas.on('mouse:down', function(opt) {
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

        canvas.on('mouse:move', function(opt) {
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

        canvas.on('mouse:up', function(opt) {
            canvas.setViewportTransform(canvas.viewportTransform);
            isDragging = false;
            canvas.selection = true;
            canvas.defaultCursor = 'grab';
            canvas.setCursor('grab');
        });

        // CANVAS FOCUS LOGIC TO AVOID SCROLL HIJACKING
        const siteplanScrollContainer = document.querySelector('.siteplan-scroll-container');

        if (siteplanScrollContainer) {
            siteplanScrollContainer.addEventListener('click', function(e) {
                isCanvasFocused = true;
                siteplanScrollContainer.style.borderColor = '#28a745'; // Glowing green active border
                siteplanScrollContainer.style.boxShadow = '0 0 15px rgba(40, 167, 69, 0.3)';
                e.stopPropagation();
            });
        }

        document.addEventListener('click', function(e) {
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
            if (!canvas || !originalWidth || !originalHeight) return;

            const scrollContainer = document.querySelector('.siteplan-scroll-container');
            const containerWidth = (scrollContainer && scrollContainer.clientWidth > 0) ? scrollContainer.clientWidth : (canvas.getWidth() || 1100);
            const containerHeight = (scrollContainer && scrollContainer.clientHeight > 0) ? scrollContainer.clientHeight : 620;

            canvas.setWidth(containerWidth);
            canvas.setHeight(containerHeight);

            // Calculate fit scale so 100% of the siteplan is visible without clipping
            const scaleX = (containerWidth - 20) / originalWidth;
            const scaleY = (containerHeight - 20) / originalHeight;
            const fitScale = Math.min(scaleX, scaleY);

            zoomLevel = fitScale;

            const panX = (containerWidth - originalWidth * fitScale) / 2;
            const panY = (containerHeight - originalHeight * fitScale) / 2;

            canvas.setViewportTransform([fitScale, 0, 0, fitScale, panX, panY]);
            canvas.calcOffset();
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
        document.addEventListener('keydown', function(e) {
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

        // Window resize listener
        window.addEventListener('resize', function() {
            if (typeof canvas !== 'undefined' && canvas && document.getElementById('sitePlandView').style.display !== 'none') {
                resetZoom();
            }
        });

        function getColor(status, type) {
            if (type === "komersil" && status === "ready") return "#2675BB";
            if (status === "ready") return "#28a745";
            if (status === "booked") return "#FFD700";
            if (status === "sold") return "#FA2800";
            return "#6c757d";
        }

        // Info Border / Stroke Status Konstruksi Bangunan
        function getConstructionStrokeInfo(progress) {
            switch (progress) {
                case 'pondasi':
                    return { stroke: '#fd7e14', strokeWidth: 3.5, dash: [6, 3], label: 'Pondasi (20%)', color: '#fd7e14' };
                case 'dinding':
                    return { stroke: '#ffc107', strokeWidth: 3.5, dash: [6, 3], label: 'Dinding (40%)', color: '#ffc107' };
                case 'atap':
                    return { stroke: '#17a2b8', strokeWidth: 4,   dash: [8, 3], label: 'Atap (60%)',    color: '#17a2b8' };
                case 'finishing':
                    return { stroke: '#9a55ff', strokeWidth: 4,   dash: [8, 3], label: 'Finishing (80%)', color: '#9a55ff' };
                case 'selesai':
                    return { stroke: '#28a745', strokeWidth: 3,   dash: null,   label: 'Selesai (100%)', color: '#28a745' };
                default:
                    return { stroke: '#212529', strokeWidth: 1.2, dash: null,   label: 'Belum Mulai (0%)', color: '#6c757d' };
            }
        }

        // Populate Modal Detail Unit secara langsung dari objek Canvas
        window.populateModalDirectly = function(data) {
            document.getElementById('m_unit_name').innerText = data.unitName || '-';
            document.getElementById('m_block').innerText = data.block || '-';
            document.getElementById('m_unit_number').innerText = data.unitNumber || '-';
            document.getElementById('m_jenis').innerText = data.jenis ? (data.jenis.charAt(0).toUpperCase() + data.jenis.slice(1)) : '-';
            document.getElementById('m_type').innerText = data.type || '-';
            document.getElementById('m_area').innerText = data.area ? data.area + ' m²' : '-';
            document.getElementById('m_building').innerText = data.building ? data.building + ' m²' : '-';
            document.getElementById('m_price').innerText = 'Rp ' + new Intl.NumberFormat('id-ID').format(data.price || 0);
            document.getElementById('m_direction').innerText = data.direction || '-';
            document.getElementById('m_address').innerText = data.address || '-';

            // Status Penjualan
            const sRaw = (data.statusRaw || '').toLowerCase();
            const jRaw = (data.jenis || '').toLowerCase();
            const tRaw = (data.type || '').toLowerCase();
            let sHtml = '';
            if (sRaw === 'ready' || sRaw === 'tersedia') {
                if (tRaw === 'komersil' || jRaw === 'komersil') {
                    sHtml = `<span class="badge shadow-sm" style="background: #2675BB; color: #ffffff !important; font-size: 0.82rem; font-weight: 700; padding: 6px 12px; border-radius: 20px;"><i class="mdi mdi-office-building me-1"></i>Tersedia (Ready Komersil)</span>`;
                } else {
                    sHtml = `<span class="badge shadow-sm" style="background: #28a745; color: #ffffff !important; font-size: 0.82rem; font-weight: 700; padding: 6px 12px; border-radius: 20px;"><i class="mdi mdi-check-circle me-1"></i>Tersedia (Ready Subsidi)</span>`;
                }
            } else if (sRaw === 'booked') {
                sHtml = `<span class="badge shadow-sm" style="background: #ffc107; color: #212529 !important; font-size: 0.82rem; font-weight: 700; padding: 6px 12px; border-radius: 20px;"><i class="mdi mdi-bookmark-check me-1"></i>Booked (Terbooking)</span>`;
            } else if (sRaw === 'sold' || sRaw === 'terjual') {
                sHtml = `<span class="badge shadow-sm" style="background: #dc3545; color: #ffffff !important; font-size: 0.82rem; font-weight: 700; padding: 6px 12px; border-radius: 20px;"><i class="mdi mdi-close-circle me-1"></i>Terjual (Sold)</span>`;
            } else {
                sHtml = `<span class="badge bg-secondary shadow-sm" style="color: #ffffff !important; font-size: 0.82rem; font-weight: 700; padding: 6px 12px; border-radius: 20px;">${data.statusText || sRaw}</span>`;
            }
            document.getElementById('m_status').innerHTML = sHtml;

            // Progress Pembangunan Fisik
            const progressMap = { belum_mulai: 0, pondasi: 20, dinding: 40, atap: 60, finishing: 80, selesai: 100 };
            const prog = data.construction || 'belum_mulai';
            const pct = progressMap[prog] !== undefined ? progressMap[prog] : 0;
            const strokeInfo = getConstructionStrokeInfo(prog);

            document.getElementById('m_progress_bar').style.width = pct + '%';
            document.getElementById('m_progress_bar').style.background = strokeInfo.color;
            document.getElementById('m_progress_pct').innerText = pct + '% (' + strokeInfo.label + ')';

            // Booking info
            const hasBooking = data.hasBooking == 1 || data.hasBooking === true;
            document.getElementById('m_booking_card').style.display = hasBooking ? '' : 'none';
            document.getElementById('m_no_booking_card').style.display = hasBooking ? 'none' : '';

            if (hasBooking) {
                const cust = data.customer || '-';
                const sales = data.sales || '-';
                document.getElementById('m_customer').innerText = cust;
                document.getElementById('m_customer_initial').innerText = (cust !== '-' && cust) ? cust.trim().charAt(0).toUpperCase() : '?';
                document.getElementById('m_sales').innerText = sales;
                document.getElementById('m_sales_initial').innerText = (sales !== '-' && sales) ? sales.trim().charAt(0).toUpperCase() : '?';
                document.getElementById('m_booking_date').innerText = data.bookingDate || '-';
                document.getElementById('m_booking_fee').innerText = 'Rp ' + new Intl.NumberFormat('id-ID').format(data.bookingFee || 0);
                document.getElementById('m_agent_fee').innerText = 'Rp ' + new Intl.NumberFormat('id-ID').format(data.agentFee || 0);

                const bStatus = data.bookingStatus || '-';
                let bBadge = '';
                if (bStatus === 'active') {
                    bBadge = `<span class="badge-soft badge-available-subsidi"><i class="mdi mdi-check-circle"></i>Aktif</span>`;
                } else if (bStatus === 'completed' || bStatus === 'lunas') {
                    bBadge = `<span class="badge-soft badge-available-subsidi"><i class="mdi mdi-check-circle"></i>Selesai</span>`;
                } else if (bStatus === 'cancelled') {
                    bBadge = `<span class="badge-soft badge-sold"><i class="mdi mdi-close-circle-outline"></i>Dibatalkan</span>`;
                } else {
                    bBadge = `<span class="badge-soft badge-draft">${bStatus}</span>`;
                }
                document.getElementById('m_booking_status').innerHTML = bBadge;
            }
        };

        function openUnitDetailFromObject(target) {
            if (!target || !target.unitId) return;
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

        // Buka modal detail saat bulatan di-KLIK (single click)
        let clickStartPos = { x: 0, y: 0 };
        canvas.on('mouse:down', function(e) {
            if (e.e) {
                clickStartPos = { x: e.e.clientX, y: e.e.clientY };
            }
        });

        canvas.on('mouse:up', function(e) {
            if (e.target && e.target.unitId && e.e) {
                const dist = Math.hypot(e.e.clientX - clickStartPos.x, e.e.clientY - clickStartPos.y);
                if (dist < 6) {
                    openUnitDetailFromObject(e.target);
                }
            }
        });

        // Double click cadangan
        canvas.on('mouse:dblclick', function(e) {
            if (e.target && e.target.unitId) {
                openUnitDetailFromObject(e.target);
            }
        });

        function savePosition() {
            let units = [];
            canvas.getObjects().forEach(function(obj) {
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
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        units: units
                    })
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: 'Posisi unit berhasil disimpan',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }
                })
                .catch(error => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: 'Terjadi kesalahan saat menyimpan posisi'
                    });
                });
        }

        // ========== SWITCH VIEW FUNCTION ==========
        function switchView(view) {
            document.getElementById('tableView').style.display = 'none';
            document.getElementById('gridView').style.display = 'none';
            document.getElementById('denahView').style.display = 'none';
            document.getElementById('sitePlandView').style.display = 'none';
            document.querySelectorAll('#viewToggleGroup .btn, .btn-group .btn').forEach(btn => btn.classList.remove('active'));
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
                    setTimeout(function() {
                        const projSelect = document.getElementById('siteplanProjectSelect');
                        loadProjectSiteplan(projSelect ? projSelect.value : null);
                        resetZoom();
                    }, 50);
                }
            }
        }

        // ========== OPEN CUSTOMER MODAL ==========
        window.openCustomerModal = function(unitId) {
            if (!unitId) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Unit tidak valid!'
                });
                return;
            }
            $('#modalCustomer').attr('data-unit-id', unitId);
            $('#customer_unit_id').val(unitId);
            $('#select_customer_id').val('').trigger('change');
            $('#select_purchase_type').val('kpr');
            $('#booking_fee').val('');
            $('#bukti_transfer').val('');
            $('#buktiFileName').text('Upload Bukti Transfer');
            $('#buktiFileSize').text('');
            $('#buktiLabel').removeClass('file-selected');
            $('#modalCustomer').modal('show');
        };

        // ========== OPEN AGENCY MODAL DENGAN PERHITUNGAN OTOMATIS ==========
        window.openAgentModal = function(unitId) {
            if (!unitId) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Unit tidak valid!'
                });
                return;
            }
            $('#modalAgency').data('unit', unitId);
            $('#agency_unit_id').val(unitId);
            $('#select_sales_id').val('').trigger('change');

            const unit = (window.catalogUnitsMap && window.catalogUnitsMap[unitId]) ? window.catalogUnitsMap[unitId] : {};
            const unitPrice = unit.price || 0;
            const unitJenis = unit.jenis || unit.type || 'komersil';
            const landBankId = unit.land_bank_id || null;

            // Update UI Ringkasan Unit di Modal
            $('#agency_modal_unit_code').text('Unit ' + (unit.unit_code || unit.block || '-'));
            $('#agency_modal_unit_name').text(unit.unit_name || (unit.block + '.' + unit.unit_number) || 'Unit Kavling');
            $('#agency_modal_unit_price').text('Rp ' + new Intl.NumberFormat('id-ID').format(unitPrice));
            
            const isSub = String(unitJenis).toLowerCase() === 'subsidi';
            $('#agency_modal_jenis_badge').text(isSub ? 'Subsidi' : 'Komersil')
                .removeClass('bg-primary bg-success')
                .addClass(isSub ? 'bg-success text-white' : 'bg-primary text-white');

            // Kalkulasi Otomatis Fee Sesuai Aturan
            applyAutoCalculatedFee(unitPrice, unitJenis, landBankId);

            $('#modalAgency').modal('show');
        };

        function applyAutoCalculatedFee(unitPrice, unitJenis, landBankId) {
            const calc = window.calculateAgentFee(unitPrice, unitJenis, landBankId);
            $('#agent_fee_modal').val(new Intl.NumberFormat('id-ID').format(calc.fee));
            $('#auto_calc_rule_name').html('<i class="mdi mdi-check-decagram me-1 text-primary"></i>' + calc.ruleName);
            $('#auto_calc_formula').text('Aturan: ' + calc.formula);
        }

        $(document).ready(function () {
            // Inisialisasi Select2 untuk Pilih Customer di dalam Modal
            $('#select_customer_id').select2({
                theme: 'bootstrap-5',
                dropdownParent: $('#modalCustomer'),
                placeholder: '-- Cari & Pilih Customer (ID / Nama) --',
                allowClear: true,
                width: '100%'
            });

            // Inisialisasi Select2 untuk Pilih Agency di dalam Modal
            $('#select_sales_id').select2({
                theme: 'bootstrap-5',
                dropdownParent: $('#modalAgency'),
                placeholder: '-- Cari & Pilih Agency / Agent --',
                allowClear: true,
                width: '100%'
            });


            // Format Rupiah
            $('#booking_fee, #agent_fee_modal').on('input', function() {
                let value = $(this).val().replace(/[^0-9]/g, '');
                if (value) $(this).val(new Intl.NumberFormat('id-ID').format(value));
                else $(this).val('');
            });

            // File upload handler
            $('#bukti_transfer').on('change', function() {
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

            // Simpan Customer & Booking Unit
            $('#btnSimpanCustomer').on('click', function(e) {
                e.preventDefault();
                let customerId = $('#select_customer_id').val();
                let purchaseType = $('#select_purchase_type').val();
                let unitId = $('#modalCustomer').attr('data-unit-id') || $('#customer_unit_id').val();
                let bookingFee = $('#booking_fee').val().replace(/\./g, '').replace(/,/g, '').trim();
                let buktiTransfer = $('#bukti_transfer')[0].files[0];

                if (!unitId) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Unit belum dipilih!'
                    });
                    return;
                }
                if (!customerId) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Customer Belum Dipilih',
                        text: 'Silakan cari dan pilih Customer terlebih dahulu!'
                    });
                    return;
                }
                if (!purchaseType) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Metode Pembayaran Kosong',
                        text: 'Silakan pilih metode pembayaran (Cash / KPR)!'
                    });
                    return;
                }
                if (!bookingFee || parseInt(bookingFee) <= 0) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Booking Fee Kosong',
                        text: 'Nominal booking fee harus diisi dan lebih dari 0!'
                    });
                    return;
                }
                if (!buktiTransfer) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Bukti Transfer Kosong',
                        text: 'Bukti transfer wajib diupload!'
                    });
                    return;
                }
                if (buktiTransfer.size > 2 * 1024 * 1024) {
                    Swal.fire({
                        icon: 'error',
                        title: 'File Terlalu Besar',
                        text: 'Ukuran file maksimal 2MB!'
                    });
                    return;
                }
                const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'application/pdf'];
                if (!allowedTypes.includes(buktiTransfer.type)) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Tipe File Tidak Didukung',
                        text: 'Format file harus JPG, PNG, atau PDF!'
                    });
                    return;
                }

                let formData = new FormData();
                formData.append('_token', '{{ csrf_token() }}');
                formData.append('customer_id', customerId);
                formData.append('purchase_type', purchaseType);
                formData.append('booking_fee', bookingFee);
                formData.append('bukti_transfer', buktiTransfer);
                let actionUrl = "{{ route('set.customer', ':unitId') }}".replace(':unitId', unitId);

                Swal.fire({
                    title: 'Memproses...',
                    text: 'Harap tunggu sebentar',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                $.ajax({
                    url: actionUrl,
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        $('#modalCustomer').modal('hide');
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: response.message || 'Customer berhasil dipilih & unit terbooking',
                            timer: 1500,
                            showConfirmButton: false
                        }).then(() => location.reload());
                    },
                    error: function(xhr) {
                        let errorMsg = 'Terjadi kesalahan';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMsg = xhr.responseJSON.message;
                        } else if (xhr.responseJSON && xhr.responseJSON.errors) {
                            errorMsg = Object.values(xhr.responseJSON.errors).join('\n');
                        }
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: errorMsg
                        });
                    }
                });
            });

            // Simpan Agency / Agent
            $('#btnSimpanAgency').on('click', function(e) {
                e.preventDefault();
                let salesId = $('#select_sales_id').val();
                let agentFeeRaw = $('#agent_fee_modal').val().replace(/\./g, '').replace(/,/g, '').trim();
                let unitId = $('#modalAgency').data('unit') || $('#agency_unit_id').val();

                if (!unitId) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Unit tidak valid! Silakan coba lagi.'
                    });
                    return;
                }

                if (!salesId) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Agency Belum Dipilih',
                        text: 'Silakan cari dan pilih Agency / Agent terlebih dahulu!'
                    });
                    return;
                }

                if (!agentFeeRaw || parseInt(agentFeeRaw) <= 0) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Agent Fee Kosong',
                        text: 'Nominal Agent Fee wajib diisi dan lebih dari 0!'
                    });
                    return;
                }

                // Langsung simpan tanpa konfirmasi popup
                Swal.fire({
                    title: 'Memproses...',
                    text: 'Harap tunggu sebentar',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                $.ajax({
                    url: "{{ url('marketing/set-agency') }}/" + unitId,
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        sales_id: salesId,
                        agent_fee: agentFeeRaw
                    },
                    success: function(response) {
                        $('#modalAgency').modal('hide');
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: response.message || 'Agency berhasil dipasang ke unit',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => location.reload());
                    },
                    error: function(xhr) {
                        let errMsg = 'Terjadi kesalahan saat menyimpan';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errMsg = xhr.responseJSON.message;
                        } else if (xhr.responseJSON && xhr.responseJSON.errors) {
                            errMsg = Object.values(xhr.responseJSON.errors).join('\n');
                        }
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: errMsg
                        });
                    }
                });
            });

            // Search dan Filter Customer Table
            $('#searchCustomer').on('keyup', function() {
                const searchTerm = $(this).val().toLowerCase();
                $('#customerTable tbody tr').each(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(searchTerm) > -1);
                });
            });

            $('#filterPekerjaan').on('change', function() {
                const job = $(this).val();
                if (!job) $('#customerTable tbody tr').show();
                else {
                    $('#customerTable tbody tr').each(function() {
                        const jobText = $(this).find('td:eq(4)').text().trim();
                        $(this).toggle(jobText === job);
                    });
                }
            });

            // Tombol Hitung Ulang Fee di Modal Agency
            $('#btnRecalculateFee').on('click', function() {
                let unitId = $('#modalAgency').data('unit') || $('#agency_unit_id').val();
                let unit = (window.catalogUnitsMap && window.catalogUnitsMap[unitId]) ? window.catalogUnitsMap[unitId] : {};
                let unitPrice = unit.price || 0;
                let unitJenis = unit.jenis || unit.type || 'komersil';
                let landBankId = unit.land_bank_id || null;
                applyAutoCalculatedFee(unitPrice, unitJenis, landBankId);
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    title: 'Komisi berhasil dihitung ulang!',
                    showConfirmButton: false,
                    timer: 1500
                });
            });

            // =========================================================
            // SCRIPT MASTER ATURAN KOMISI (CRUD & TOGGLE & SIMULATOR)
            // =========================================================

            // Toggle Tampilkan / Sembunyikan Form Tambah Rule
            $('#btnToggleFormRule').on('click', function() {
                resetFormRule();
                $('#formRuleContainer').removeClass('d-none');
                $('#formRuleTitle').html('<i class="mdi mdi-pencil-plus me-1"></i>Form Tambah Aturan Komisi Baru');
                $('#rule_name').focus();
            });

            $('#btnCloseFormRule, #btnCancelFormRule').on('click', function() {
                $('#formRuleContainer').addClass('d-none');
                resetFormRule();
            });

            function resetFormRule() {
                $('#rule_id').val('');
                $('#rule_name').val('');
                $('#rule_land_bank_id').val('');
                $('#rule_target_type').val('all');
                $('#rule_calculation_type').val('percentage').trigger('change');
                $('#rule_value').val('');
                $('#rule_description').val('');
            }

            // Ganti placeholder / label nilai komisi sesuai metode
            $('#rule_calculation_type').on('change', function() {
                const val = $(this).val();
                if (val === 'percentage') {
                    $('#rule_value_label').html('Nilai Komisi (%) <span class="text-danger">*</span>');
                    $('#rule_value_prefix').text('%');
                    $('#rule_value').attr('placeholder', 'Contoh: 2.5');
                } else {
                    $('#rule_value_label').html('Nilai Komisi Flat (Rp) <span class="text-danger">*</span>');
                    $('#rule_value_prefix').text('Rp');
                    $('#rule_value').attr('placeholder', 'Contoh: 4000000');
                }
            });

            // Submit Form Tambah / Edit Aturan Komisi (AJAX)
            $('#formCommissionRule').on('submit', function(e) {
                e.preventDefault();
                let ruleId = $('#rule_id').val();
                let isEdit = !!ruleId;
                let url = isEdit 
                    ? "{{ url('marketing/commission-rules') }}/" + ruleId
                    : "{{ route('marketing.commission-rules.store') }}";
                let method = isEdit ? 'PUT' : 'POST';

                let data = {
                    _token: '{{ csrf_token() }}',
                    name: $('#rule_name').val(),
                    land_bank_id: $('#rule_land_bank_id').val() || null,
                    target_type: $('#rule_target_type').val(),
                    calculation_type: $('#rule_calculation_type').val(),
                    value: $('#rule_value').val(),
                    description: $('#rule_description').val()
                };

                let $btn = $('#btnSaveCommissionRule');
                $btn.prop('disabled', true).html('<i class="mdi mdi-loading mdi-spin me-1"></i>Menyimpan...');

                $.ajax({
                    url: url,
                    type: method,
                    data: data,
                    success: function(res) {
                        $btn.prop('disabled', false).html('<i class="mdi mdi-content-save me-1"></i>Simpan Aturan');
                        if (res.success) {
                            $('#formRuleContainer').addClass('d-none');
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: res.message || 'Aturan komisi berhasil disimpan',
                                timer: 1500,
                                showConfirmButton: false
                            }).then(() => location.reload());
                        }
                    },
                    error: function(xhr) {
                        $btn.prop('disabled', false).html('<i class="mdi mdi-content-save me-1"></i>Simpan Aturan');
                        let errMsg = 'Terjadi kesalahan saat menyimpan aturan';
                        if (xhr.responseJSON && xhr.responseJSON.message) errMsg = xhr.responseJSON.message;
                        else if (xhr.responseJSON && xhr.responseJSON.errors) errMsg = Object.values(xhr.responseJSON.errors).join('\n');
                        Swal.fire({ icon: 'error', title: 'Gagal', text: errMsg });
                    }
                });
            });

            // Edit Aturan Komisi
            $(document).on('click', '.btn-edit-rule', function() {
                let id = $(this).data('id');
                let name = $(this).data('name');
                let landBankId = $(this).data('land_bank_id');
                let targetType = $(this).data('target_type');
                let calculationType = $(this).data('calculation_type');
                let value = $(this).data('value');
                let description = $(this).data('description');

                $('#rule_id').val(id);
                $('#rule_name').val(name);
                $('#rule_land_bank_id').val(landBankId);
                $('#rule_target_type').val(targetType);
                $('#rule_calculation_type').val(calculationType).trigger('change');
                $('#rule_value').val(value);
                $('#rule_description').val(description);

                $('#formRuleTitle').html('<i class="mdi mdi-pencil me-1"></i>Edit Aturan Komisi: ' + name);
                $('#formRuleContainer').removeClass('d-none');
                $('#formRuleContainer')[0].scrollIntoView({ behavior: 'smooth' });
            });

            // Toggle Status Aktif / Non-Aktif Aturan Komisi (AJAX)
            $(document).on('change', '.switch-rule-status', function() {
                let id = $(this).data('id');
                let isChecked = $(this).is(':checked');

                $.ajax({
                    url: "{{ url('marketing/commission-rules') }}/" + id + "/toggle",
                    type: 'POST',
                    data: { _token: '{{ csrf_token() }}' },
                    success: function(res) {
                        // Update local rule
                        let found = window.commissionRules.find(r => r.id == id);
                        if (found) found.is_active = res.is_active;

                        // Recalculate stats
                        let activeCount = window.commissionRules.filter(r => r.is_active == 1 || r.is_active === true).length;
                        $('#stat_active_rules').text(activeCount);

                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            icon: 'success',
                            title: res.message || 'Status aturan berhasil diubah',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    },
                    error: function() {
                        Swal.fire({ icon: 'error', title: 'Gagal', text: 'Gagal mengubah status aturan komisi' });
                    }
                });
            });

            // Hapus Aturan Komisi (AJAX)
            $(document).on('click', '.btn-delete-rule', function() {
                let id = $(this).data('id');
                Swal.fire({
                    title: 'Hapus Aturan Komisi?',
                    text: 'Aturan ini tidak akan digunakan lagi untuk perhitungan otomatis komisi!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ url('marketing/commission-rules') }}/" + id,
                            type: 'DELETE',
                            data: { _token: '{{ csrf_token() }}' },
                            success: function(res) {
                                $('#rule_row_' + id).fadeOut(300, function() { $(this).remove(); });
                                window.commissionRules = window.commissionRules.filter(r => r.id != id);
                                $('#stat_total_rules').text(window.commissionRules.length);
                                let activeCount = window.commissionRules.filter(r => r.is_active == 1 || r.is_active === true).length;
                                $('#stat_active_rules').text(activeCount);

                                Swal.fire({
                                    icon: 'success',
                                    title: 'Terhapus!',
                                    text: res.message || 'Aturan komisi berhasil dihapus',
                                    timer: 1500,
                                    showConfirmButton: false
                                });
                            },
                            error: function() {
                                Swal.fire({ icon: 'error', title: 'Gagal', text: 'Gagal menghapus aturan komisi' });
                            }
                        });
                    }
                });
            });

            // Live Simulator Calculator in Modal
            $('#sim_price, #sim_jenis').on('input change keyup', function() {
                let rawPrice = $('#sim_price').val().replace(/\./g, '').replace(/,/g, '').trim();
                let p = parseFloat(rawPrice) || 0;
                let j = $('#sim_jenis').val();
                let calc = window.calculateAgentFee(p, j, null);
                $('#sim_result').text('Rp ' + new Intl.NumberFormat('id-ID').format(calc.fee));
            });

            // Reset form saat modal ditutup
            $('#modalCustomer, #modalAgency').on('hidden.bs.modal', function() {
                $('#booking_fee, #agent_fee_modal').val('');
                $('#select_customer_id').val('').trigger('change');
                $('#select_sales_id').val('').trigger('change');
                $('#bukti_transfer').val('');
                $('#buktiFileName').text('Upload Bukti Transfer');
                $('#buktiFileSize').text('');
                $('#buktiLabel').removeClass('file-selected');
            });
        });

        // ========== SESSION FLASH MESSAGES ==========
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 2000
            });
        @endif
        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "{{ session('error') }}",
                confirmButtonColor: '#d33'
            });
        @endif
        @if ($errors->any())
            Swal.fire({
                icon: 'warning',
                title: 'Validasi Gagal',
                html: `{!! implode('<br>', $errors->all()) !!}`
            });
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

            // ========== SELECT2 FILTERS (NO SEARCH INPUT) ==========
            $('#jenisSelect, #statusSelect, #perPageSelect, #jenisSelectMobile, #statusSelectMobile, #perPageSelectMobile').select2({
                theme: 'bootstrap-5',
                minimumResultsForSearch: Infinity,
                width: '100%'
            });

            // Auto submit filter desktop saat nilai dropdown berubah
            $('#jenisSelect, #statusSelect, #perPageSelect').on('change', function() {
                showFilterLoading();
                $('#filterForm').submit();
            });

            // Auto submit filter mobile saat nilai dropdown berubah
            $('#jenisSelectMobile, #statusSelectMobile, #perPageSelectMobile').on('change', function() {
                showFilterLoading();
                $('#filterFormMobile').submit();
            });

            // Loading saat form filter disubmit manual (pencarian teks / tombol cari)
            $('#filterForm, #filterFormMobile').on('submit', function() {
                showFilterLoading();
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
