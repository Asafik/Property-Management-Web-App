@extends('layouts.partial.app')

@section('title', 'Buat Kavling - Property Management App')

@section('content')
    <style>
        /* Custom Tab Styling - BootstrapDash style */
        .add-custom-tabs-wrapper {
            background: #f6f9ff;
            border-radius: 8px;
            padding: 6px;
            margin-bottom: 25px;
            border: 1px solid #e9ecef;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .add-custom-tabs {
            display: flex;
            flex-wrap: nowrap;
            gap: 4px;
            list-style: none;
            padding: 0;
            margin: 0;
            min-width: min-content;
        }

        .add-custom-tab-item {
            flex: 0 0 auto;
        }

        .add-custom-tab-link {
            display: flex;
            align-items: center;
            padding: 10px 16px;
            font-size: 0.85rem;
            font-weight: 500;
            color: #6c7383;
            background: transparent;
            border: none;
            border-radius: 6px;
            text-decoration: none;
            transition: all 0.2s ease;
            white-space: nowrap;
            gap: 6px;
            font-family: 'Nunito', sans-serif;
        }

        .add-custom-tab-link i {
            font-size: 1rem;
            color: #a5b3cb;
            transition: all 0.2s ease;
        }

        .add-custom-tab-link:hover {
            color: #9a55ff;
            background: #ffffff;
            box-shadow: 0 2px 5px rgba(154, 85, 255, 0.1);
        }

        .add-custom-tab-link:hover i {
            color: #9a55ff;
        }

        .add-custom-tab-link.active {
            color: #9a55ff;
            background: #ffffff;
            box-shadow: 0 2px 8px rgba(154, 85, 255, 0.15);
            font-weight: 600;
        }

        .add-custom-tab-link.active i {
            color: #9a55ff;
        }

        .add-custom-tab-pane {
            display: none;
        }

        .add-custom-tab-pane.active {
            display: block;
            animation: addFadeIn 0.3s ease;
        }

        @keyframes addFadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .kavling-form-group {
            margin-bottom: 1rem;
        }

        .kavling-form-group label {
            font-size: 0.8rem;
            font-weight: 600;
            color: #9a55ff !important;
            margin-bottom: 0.3rem;
            letter-spacing: 0.3px;
            font-family: 'Nunito', sans-serif;
            display: block;
        }

        .kavling-form-control {
            border: 1px solid #e9ecef;
            border-radius: 10px;
            padding: 0.7rem 0.8rem;
            font-size: 0.85rem;
            transition: all 0.2s ease;
            background-color: #ffffff;
            color: #2c2e3f;
            width: 100%;
            font-family: 'Nunito', sans-serif;
        }

        .kavling-form-control:focus {
            border-color: #9a55ff;
            box-shadow: 0 0 0 3px rgba(154, 85, 255, 0.1);
            outline: none;
        }

        select.kavling-form-control {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%239a55ff' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 0.75rem center;
            background-size: 12px;
            padding-right: 2rem;
        }

        .kavling-input-group-rp {
            display: flex;
            align-items: stretch;
            width: 100%;
        }

        .kavling-input-group-rp .kavling-form-control {
            flex: 1;
            min-width: 0;
            border-top-left-radius: 0;
            border-bottom-left-radius: 0;
            border-left: none;
        }

        .kavling-input-group-rp-addon {
            display: flex;
            align-items: center;
            padding: 0 0.75rem;
            background: #f8f9fa;
            border: 1px solid #e9ecef;
            border-right: none;
            border-radius: 10px 0 0 10px;
            font-size: 0.85rem;
            font-weight: 600;
            color: #6c757d;
            white-space: nowrap;
            font-family: 'Nunito', sans-serif;
        }

        .kavling-input-group-rp:focus-within .kavling-form-control {
            border-color: #9a55ff;
        }

        .kavling-input-group-rp:focus-within .kavling-input-group-rp-addon {
            border-color: #9a55ff;
        }

        .kavling-btn {
            font-size: 0.8rem;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
            font-family: 'Nunito', sans-serif;
            display: inline-block;
            text-decoration: none;
            cursor: pointer;
            border: none;
            width: 100%;
            text-align: center;
        }

        @media (min-width: 576px) {
            .kavling-btn {
                width: auto;
                padding: 0.5rem 1.2rem;
            }
        }

        .kavling-btn-primary {
            background: linear-gradient(to right, #da8cff, #9a55ff);
            color: #ffffff;
            box-shadow: 0 4px 12px rgba(154, 85, 255, 0.3);
        }

        .kavling-btn-primary:hover {
            background: linear-gradient(to right, #c77cff, #8a45e6);
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(154, 85, 255, 0.4);
        }

        .kavling-btn-outline-primary {
            background: transparent;
            border: 1px solid #9a55ff;
            color: #9a55ff;
        }

        .kavling-btn-outline-primary:hover {
            background: linear-gradient(135deg, #9a55ff, #da8cff);
            color: #ffffff;
            border-color: transparent;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(154, 85, 255, 0.3);
        }

        .kavling-btn-outline-success {
            background: transparent;
            border: 1px solid #28a745;
            color: #28a745;
        }

        .kavling-btn-outline-success:hover {
            background: linear-gradient(135deg, #28a745, #5cb85c);
            color: #ffffff;
            border-color: transparent;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(40, 167, 69, 0.3);
        }

        .kavling-btn-light {
            background: #f8f9fa;
            border: 1px solid #e9ecef;
            color: #2c2e3f;
        }

        .kavling-btn-light:hover {
            background: #e9ecef;
            transform: translateY(-2px);
        }

        .kavling-btn-success {
            background: linear-gradient(135deg, #28a745, #5cb85c);
            color: #ffffff;
            box-shadow: 0 4px 12px rgba(40, 167, 69, 0.3);
        }

        .kavling-btn-success:hover {
            background: linear-gradient(135deg, #218838, #4cae4c);
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(40, 167, 69, 0.4);
        }

        .kavling-file-upload-modern {
            position: relative;
            width: 100%;
        }

        .kavling-file-upload-modern input[type="file"] {
            position: absolute;
            opacity: 0;
            width: 100%;
            height: 100%;
            cursor: pointer;
            z-index: 2;
        }

        .kavling-file-upload-modern .kavling-file-label-modern {
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
            .kavling-file-upload-modern .kavling-file-label-modern {
                flex-direction: row;
                text-align: left;
                gap: 8px;
                padding: 0.75rem 1rem;
                min-height: auto;
            }
        }

        .kavling-file-upload-modern:hover .kavling-file-label-modern {
            border-color: #9a55ff;
            background: linear-gradient(135deg, #f1f0ff, #f8f9fa);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(154, 85, 255, 0.1);
        }

        .kavling-file-upload-modern .kavling-file-label-modern i {
            font-size: 1.6rem;
            color: #9a55ff;
            background: rgba(154, 85, 255, 0.1);
            padding: 8px;
            border-radius: 50%;
        }

        .kavling-file-upload-modern .kavling-file-label-modern .kavling-file-info-modern {
            flex: 1;
            width: 100%;
        }

        .kavling-file-upload-modern .kavling-file-label-modern .kavling-file-info-modern span {
            display: block;
            font-weight: 600;
            color: #2c2e3f;
            font-size: 0.8rem;
            word-break: break-word;
        }

        .kavling-file-upload-modern .kavling-file-label-modern .kavling-file-info-modern small {
            color: #6c7383;
            font-size: 0.65rem;
            display: block;
            margin-top: 2px;
        }

        .kavling-file-upload-modern .kavling-file-label-modern .kavling-file-size {
            font-size: 0.7rem;
            color: #9a55ff;
            font-weight: 600;
            background: rgba(154, 85, 255, 0.1);
            padding: 4px 10px;
            border-radius: 20px;
            white-space: nowrap;
            margin-top: 5px;
        }

        @media (min-width: 576px) {
            .kavling-file-upload-modern .kavling-file-label-modern .kavling-file-size {
                margin-top: 0;
            }
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
            text-decoration: none;
        }

        .btn-action i {
            font-size: 1.1rem;
        }

        .btn-action.edit {
            background: linear-gradient(135deg, #ffc107, #ffdb6d);
            color: #2c2e3f;
        }

        .btn-action.edit:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(255, 193, 7, 0.4);
        }

        .btn-action.delete {
            background: linear-gradient(135deg, #dc3545, #e4606d);
            color: white;
        }

        .btn-action.delete:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(220, 53, 69, 0.4);
        }

        .btn-action.progress {
            background: linear-gradient(135deg, #17a2b8, #56c6d8);
            color: white;
        }

        .btn-action.progress:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(23, 162, 184, 0.4);
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

        @media (min-width: 768px) {
            .badge {
                padding: 0.45rem 0.8rem;
                font-size: 0.85rem;
            }
        }

        .badge.badge-success {
            background: linear-gradient(135deg, #28a745, #5cb85c) !important;
            color: #ffffff;
        }

        .badge.badge-warning {
            background: linear-gradient(135deg, #ffc107, #ffdb6d) !important;
            color: #2c2e3f;
        }

        .badge.badge-primary {
            background: linear-gradient(135deg, #9a55ff, #da8cff) !important;
            color: #ffffff;
        }

        .badge.badge-info {
            background: linear-gradient(135deg, #17a2b8, #5bc0de) !important;
            color: #ffffff;
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

        .nama-unit-wrap {
            display: flex;
            flex-direction: column;
            line-height: 1.2;
        }

        .nama-unit-wrap .main-text {
            font-weight: 700;
            color: #2c2e3f;
            font-size: 0.9rem;
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
        }

        .nama-unit-wrap small {
            color: #a5b3cb;
            font-size: 0.75rem;
            margin-top: 2px;
            padding-left: 1.5rem;
        }

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

        .info-inline-icon {
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            color: #2c2e3f;
            font-weight: 600;
            font-size: 0.82rem;
            white-space: nowrap;
        }

        .info-inline-icon i {
            color: #9a55ff;
            font-size: 0.95rem;
        }

        .price-green {
            font-weight: 700;
            color: #16a34a;
            white-space: nowrap;
        }

        /* Modal Custom Style */
        .modal-custom .modal-content {
            border: none;
            border-radius: 16px;
            overflow: hidden;
        }

        .modal-custom .modal-header {
            background: linear-gradient(135deg, #da8cff, #9a55ff);
            color: white;
            border-radius: 16px 16px 0 0;
            padding: 1rem 1.5rem;
        }

        .modal-custom .modal-header .btn-close {
            filter: brightness(0) invert(1);
        }

        .modal-custom .modal-title {
            font-weight: 600;
            font-size: 1.1rem;
        }

        .modal-custom .modal-body {
            padding: 1.5rem;
            max-height: 70vh;
            overflow-y: auto;
        }

        .modal-custom .modal-footer {
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

        /* Modal tabs wrapper di dalam modal */
        .modal-tabs-wrapper {
            background: #f6f9ff;
            border-radius: 8px;
            padding: 6px;
            margin-bottom: 20px;
            border: 1px solid #e9ecef;
        }

        .modal-tabs {
            display: flex;
            flex-wrap: nowrap;
            gap: 4px;
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .modal-tab-item {
            flex: 0 0 auto;
        }

        .modal-tab-link {
            display: flex;
            align-items: center;
            padding: 8px 14px;
            font-size: 0.85rem;
            font-weight: 500;
            color: #6c7383;
            background: transparent;
            border: none;
            border-radius: 6px;
            text-decoration: none;
            transition: all 0.2s ease;
            white-space: nowrap;
            gap: 6px;
            cursor: pointer;
        }

        @media (max-width: 576px) {
            .modal-tab-link {
                padding: 10px 12px;
                font-size: 0.8rem;
                justify-content: center;
                flex: 1;
            }
        }

        @media (max-width: 400px) {
            .modal-tab-link {
                padding: 8px 6px;
                font-size: 0.75rem;
                gap: 4px;
            }
        }

        .modal-tab-link i {
            font-size: 0.9rem;
            color: #a5b3cb;
        }

        .modal-tab-link:hover {
            color: #9a55ff;
            background: #ffffff;
        }

        .modal-tab-link.active {
            color: #9a55ff;
            background: #ffffff;
            box-shadow: 0 2px 8px rgba(154, 85, 255, 0.15);
            font-weight: 600;
        }

        .modal-tab-pane {
            display: none;
        }

        .modal-tab-pane.active {
            display: block;
            animation: addFadeIn 0.3s ease;
        }

        @media (max-width: 992px) {
            .modal-tabs-wrapper {
                padding: 4px;
                margin-bottom: 1rem;
            }

            .modal-tabs {
                flex-direction: row;
                justify-content: space-between;
                gap: 2px;
            }

            .modal-tab-item {
                flex: 1;
            }

            .modal-tab-link {
                padding: 10px 6px;
                font-size: 0.75rem;
                justify-content: center;
                text-align: center;
                gap: 4px;
                min-height: 44px;
            }

            .modal-tab-link i {
                font-size: 0.9rem;
                display: block;
                margin-bottom: 1px;
            }

            .modal-tab-link span {
                display: block;
                font-size: 0.65rem;
                line-height: 1.1;
            }

            /* Modal responsif untuk 992px ke bawah */
            .modal-custom .modal-dialog {
                margin: 0.5rem;
                max-width: calc(100% - 1rem);
            }

            .modal-custom .modal-body {
                padding: 1rem;
            }

            .modal-custom .modal-header {
                padding: 0.75rem 1rem;
            }

            .modal-custom .modal-footer {
                padding: 0.75rem 1rem;
            }
        }

        @media (max-width: 576px) {
            .modal-tabs-wrapper {
                padding: 4px;
                margin-bottom: 1rem;
            }

            .modal-tabs {
                flex-direction: row;
                justify-content: space-between;
                gap: 2px;
            }

            .modal-tab-item {
                flex: 1;
            }

            .modal-tab-link {
                padding: 10px 6px;
                font-size: 0.75rem;
                justify-content: center;
                text-align: center;
                gap: 4px;
                min-height: 44px;
            }

            .modal-tab-link i {
                font-size: 0.9rem;
                display: block;
                margin-bottom: 1px;
            }

            .modal-tab-link span {
                display: block;
                font-size: 0.65rem;
                line-height: 1.1;
            }
        }

        @media (max-width: 400px) {
            .modal-tab-link {
                padding: 8px 4px;
                font-size: 0.7rem;
                gap: 2px;
                min-height: 40px;
            }

            .modal-tab-link i {
                font-size: 0.8rem;
            }

            .modal-tab-link span {
                font-size: 0.6rem;
            }
        }

        @media (max-width: 360px) {
            .modal-tab-link span {
                display: none;
            }

            .modal-tab-link {
                padding: 10px;
                justify-content: center;
                gap: 0;
            }

            .modal-tab-link i {
                margin: 0;
                font-size: 1rem;
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

            .modal-custom .modal-dialog {
                margin: 0.5rem;
                max-width: calc(100% - 1rem);
            }

            .modal-custom .modal-body {
                padding: 1rem;
            }

            .modal-custom .modal-header {
                padding: 0.75rem 1rem;
            }

            .modal-custom .modal-footer {
                padding: 0.75rem 1rem;
            }
        }

        @media (max-width: 576px) {
            .filter-card {
                padding: 0.8rem;
            }

            .modal-custom .modal-body {
                padding: 1rem;
            }
        }
    </style>

    <div class="container-fluid p-4">
        <div class="row mb-4">
            <div class="col-12">
                <div class="card shadow-sm border-0">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="mb-1 fw-bold text-dark">
                                <i class="mdi mdi-pencil-ruler me-2" style="color: #9a55ff;"></i>
                                Buat Kavling / Master Unit
                            </h4>
                            <p class="mb-0 text-muted small">
                                <i class="mdi mdi-information-outline me-1"></i>
                                Buat unit-unit kavling dari tanah yang sudah diverifikasi
                            </p>
                        </div>
                        <div class="d-none d-sm-block">
                            <i class="mdi mdi-pencil-ruler" style="font-size: 2.5rem; color: #9a55ff; opacity: 0.2;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                {{ $errors->first() }}
            </div>
        @endif

        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-header bg-white">
                        <h5 class="card-title mb-0">
                            <i class="mdi mdi-office-building text-primary me-2"></i>
                            Informasi Tanah Induk
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="text-muted small">
                                        <i class="mdi mdi-home me-1"></i>Nama Tanah / Proyek
                                    </label>
                                    <p class="fw-bold">{{ $land->name ?? '-' }}</p>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="text-muted small">
                                        <i class="mdi mdi-ruler-square me-1"></i>Luas Total Tanah
                                    </label>
                                    <p class="fw-bold">{{ number_format($land->area ?? 0, 0, ',', '.') }} m²</p>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="text-muted small">
                                        <i class="mdi mdi-chart-arc me-1"></i>Sisa Luas Belum Dikavling
                                    </label>
                                    <p class="fw-bold text-primary">
                                        {{ number_format($land->remaining_area ?? ($land->area ?? 0), 0, ',', '.') }} m²
                                    </p>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="text-muted small">
                                        <i class="mdi mdi-gavel me-1"></i>Status Legal
                                    </label>
                                    @if ($land->legal_status == 'verified')
                                        <p class="fw-bold">
                                            <span class="badge badge-success">
                                                <i class="mdi mdi-check-circle me-1"></i>Terverifikasi
                                            </span>
                                        </p>
                                    @else
                                        <p class="fw-bold">
                                            <span class="badge badge-warning">
                                                <i
                                                    class="mdi mdi-clock-outline me-1"></i>{{ ucfirst($land->legal_status) ?? '-' }}
                                            </span>
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-2">
                                    <label class="text-muted small">
                                        <i class="mdi mdi-map-marker me-1"></i>Lokasi
                                    </label>
                                    <p class="fw-bold">
                                        <i class="mdi mdi-map-marker text-danger me-1"></i>
                                        {{ $land->address ?? '-' }},
                                        Kel. {{ $land->village ?? '-' }},
                                        Kec. {{ $land->district ?? '-' }},
                                        {{ $land->city ?? '-' }},
                                        {{ $land->province ?? '-' }}
                                        {{ $land->postal_code ?? '' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
                        <h5 class="card-title mb-0">
                            <i class="mdi mdi-format-list-bulleted me-2"></i>
                            Daftar Unit Kavling
                        </h5>
                        <div class="d-flex gap-2 align-items-center">
                            <button type="button" class="btn btn-sm btn-gradient-primary" data-bs-toggle="modal"
                                data-bs-target="#tambahUnitModal">
                                <i class="mdi mdi-plus me-1"></i>Tambah
                            </button>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="filter-card mb-4">
                            <div class="card-body">
                                <div class="filter-row-desktop">
                                    <div class="filter-text">
                                        <i class="mdi mdi-filter-outline"></i>
                                        <span>Filter data unit</span>
                                    </div>

                                    <form method="GET" action="{{ url()->current() }}" id="filterForm">
                                        <div class="row g-2 align-items-end w-100">
                                            <div class="col-md-3">
                                                <label class="form-label">Cari Unit</label>
                                                <input type="text" class="form-control" name="search" id="searchInput"
                                                    value="{{ request('search') }}"
                                                    placeholder="Cari blok / unit / nama unit...">
                                            </div>

                                            <div class="col-md-2">
                                                <label class="form-label">Type</label>
                                                <select name="type" id="filterType" class="form-control">
                                                    <option value="">Semua Type</option>
                                                    @foreach ($land->units->pluck('type')->unique() as $type)
                                                        @if ($type)
                                                            <option value="{{ $type }}"
                                                                {{ request('type') == $type ? 'selected' : '' }}>
                                                                {{ $type }}
                                                            </option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-md-2">
                                                <label class="form-label">Posisi</label>
                                                <select name="position" id="filterPosisi" class="form-control">
                                                    <option value="">Semua Posisi</option>
                                                    @foreach ($land->units->pluck('position')->unique() as $position)
                                                        @if ($position)
                                                            <option value="{{ $position }}"
                                                                {{ request('position') == $position ? 'selected' : '' }}>
                                                                {{ $position }}
                                                            </option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-md-2">
                                                <label class="form-label">Hadap</label>
                                                <select name="facing" id="filterHadap" class="form-control">
                                                    <option value="">Semua Hadap</option>
                                                    @foreach ($land->units->pluck('facing')->unique() as $facing)
                                                        @if ($facing)
                                                            <option value="{{ $facing }}"
                                                                {{ request('facing') == $facing ? 'selected' : '' }}>
                                                                {{ $facing }}
                                                            </option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-md-1">
                                                <label class="form-label">Tampil</label>
                                                <select name="per_page" id="showData" class="form-control">
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
                                                        title="Filter">
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
                                    <div class="filter-text mb-2">
                                        <i class="mdi mdi-filter-outline"></i>
                                        <span>Filter data unit</span>
                                    </div>

                                    <form method="GET" action="{{ url()->current() }}" id="filterFormMobile">
                                        <div class="row g-2">
                                            <div class="col-12 mb-2">
                                                <label class="form-label">Cari Unit</label>
                                                <input type="text" class="form-control" name="search"
                                                    id="searchInputMobile" value="{{ request('search') }}"
                                                    placeholder="Cari blok / unit / nama unit...">
                                            </div>

                                            <div class="col-12 mb-2">
                                                <label class="form-label">Type</label>
                                                <select name="type" id="filterTypeMobile" class="form-control">
                                                    <option value="">Semua Type</option>
                                                    @foreach ($land->units->pluck('type')->unique() as $type)
                                                        @if ($type)
                                                            <option value="{{ $type }}"
                                                                {{ request('type') == $type ? 'selected' : '' }}>
                                                                {{ $type }}
                                                            </option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-12 mb-2">
                                                <label class="form-label">Posisi</label>
                                                <select name="position" id="filterPosisiMobile" class="form-control">
                                                    <option value="">Semua Posisi</option>
                                                    @foreach ($land->units->pluck('position')->unique() as $position)
                                                        @if ($position)
                                                            <option value="{{ $position }}"
                                                                {{ request('position') == $position ? 'selected' : '' }}>
                                                                {{ $position }}
                                                            </option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-12 mb-2">
                                                <label class="form-label">Hadap</label>
                                                <select name="facing" id="filterHadapMobile" class="form-control">
                                                    <option value="">Semua Hadap</option>
                                                    @foreach ($land->units->pluck('facing')->unique() as $facing)
                                                        @if ($facing)
                                                            <option value="{{ $facing }}"
                                                                {{ request('facing') == $facing ? 'selected' : '' }}>
                                                                {{ $facing }}
                                                            </option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-12 mb-2">
                                                <label class="form-label">Tampil</label>
                                                <select name="per_page" id="showDataMobile" class="form-control">
                                                    <option value="10"
                                                        {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10 Data
                                                    </option>
                                                    <option value="25"
                                                        {{ request('per_page') == 25 ? 'selected' : '' }}>25 Data</option>
                                                    <option value="50"
                                                        {{ request('per_page') == 50 ? 'selected' : '' }}>50 Data</option>
                                                    <option value="100"
                                                        {{ request('per_page') == 100 ? 'selected' : '' }}>100 Data
                                                    </option>
                                                </select>
                                            </div>

                                            <div class="col-6">
                                                <button type="submit"
                                                    class="btn btn-gradient-primary btn-icon-only-mobile w-100"
                                                    title="Filter">
                                                    <i class="mdi mdi-filter"></i>
                                                </button>
                                            </div>

                                            <div class="col-6">
                                                <a href="{{ url()->current() }}"
                                                    class="btn btn-gradient-secondary btn-icon-only-mobile w-100"
                                                    title="Reset">
                                                    <i class="mdi mdi-refresh"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-hover align-middle" style="min-width: 1150px;">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th>Nama - Unit</th>
                                        <th>Luas Tanah</th>
                                        <th>Luas Bangunan</th>
                                        <th>Jenis & Tipe</th>
                                        <th>Harga</th>
                                        <th>Harga IJB</th>
                                        <th>Harga AJB</th>
                                        <th>Hadap</th>
                                        <th>Posisi</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($units as $i => $unit)
                                        <tr>
                                            <td class="text-center fw-bold">{{ $units->firstItem() + $i }}</td>

                                            <td>
                                                @php
                                                    $blok = $unit->block ?? (explode('.', $unit->unit_code)[0] ?? '-');
                                                    $nomor =
                                                        $unit->unit_number ??
                                                        (explode('.', $unit->unit_code)[1] ?? '-');
                                                    $kodeTampil = $unit->unit_code ?? $blok . '.' . $nomor;
                                                @endphp
                                                <span class="info-inline-icon">
                                                    <i class="mdi mdi-home-outline"></i>
                                                    <span class="fw-bold">{{ $unit->unit_name ?? '-' }} -
                                                        {{ $kodeTampil }}</span>
                                                </span>
                                            </td>

                                            <td>
                                                <span class="info-badge-icon land-badge">
                                                    <i class="mdi mdi-ruler-square"></i>
                                                    {{ number_format($unit->area, 0, ',', '.') }} m²
                                                </span>
                                            </td>

                                            <td>
                                                <span class="info-badge-icon building-badge">
                                                    <i class="mdi mdi-home-floor-0"></i>
                                                    {{ number_format($unit->building_area ?? 0, 0, ',', '.') }} m²
                                                </span>
                                            </td>

                                            <td>
                                                @if (($unit->jenis ?? $unit->type) == 'subsidi')
                                                    <span class="badge badge-success">
                                                        <i class="mdi mdi-home-assistant me-1"></i>Subsidi
                                                        <span class="font-weight-normal" style="opacity: 0.92"> -
                                                            {{ $unit->type ?: '-' }}</span>
                                                    </span>
                                                @else
                                                    <span class="badge badge-primary">
                                                        <i class="mdi mdi-office-building me-1"></i>Komersil
                                                        <span class="font-weight-normal" style="opacity: 0.92"> -
                                                            {{ $unit->type ?: '-' }}</span>
                                                    </span>
                                                @endif
                                            </td>

                                            <td>
                                                <span class="price-green">
                                                    Rp {{ number_format($unit->price ?? 0, 0, ',', '.') }}
                                                </span>
                                            </td>

                                            <td>
                                                <span class="price-green">
                                                    Rp {{ number_format($unit->ijb_price ?? 0, 0, ',', '.') }}
                                                </span>
                                            </td>

                                            <td>
                                                <span class="price-green">
                                                    Rp {{ number_format($unit->ajb_price ?? 0, 0, ',', '.') }}
                                                </span>
                                            </td>

                                            <td>
                                                <span class="info-inline-icon">
                                                    <i class="mdi mdi-compass-outline"></i>
                                                    {{ $unit->facing ?? '-' }}
                                                </span>
                                            </td>

                                            <td>
                                                <span class="info-inline-icon">
                                                    <i class="mdi mdi-map-marker-outline"></i>
                                                    {{ $unit->position ?? '-' }}
                                                </span>
                                            </td>

                                            <td class="text-center">
                                                <a href="{{ route('properti.kavling.edit', ['unit' => $unit->id]) }}"
                                                    class="btn-action edit me-1" title="Edit">
                                                    <i class="mdi mdi-pencil"></i>
                                                </a>

                                                <a href="{{ route('properti.progress', ['land_bank_id' => $unit->land_bank_id]) }}"
                                                    class="btn-action progress me-1" title="Progress">
                                                    <i class="mdi mdi-progress-check"></i>
                                                </a>

                                                <form
                                                    action="{{ route('properti.kavling.destroy', ['unit' => $unit->id]) }}"
                                                    method="POST" style="display:inline-block;"
                                                    onsubmit="return confirm('Hapus unit {{ $unit->unit_code }}?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn-action delete" type="submit" title="Hapus">
                                                        <i class="mdi mdi-delete"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="10" class="text-center text-muted py-4">
                                                Tidak ada data unit kavling
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        @if ($units->count() > 0)
                            <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mt-4">
                                <div class="pagination-info mb-2 mb-sm-0">
                                    Menampilkan {{ $units->firstItem() }} - {{ $units->lastItem() }} dari
                                    {{ $units->total() }} data
                                </div>
                                <nav aria-label="Page navigation">
                                    <ul class="pagination pagination-sm flex-wrap justify-content-center mb-0">
                                        @if ($units->onFirstPage())
                                            <li class="page-item disabled">
                                                <span class="page-link">
                                                    <i class="mdi mdi-chevron-left"></i>
                                                </span>
                                            </li>
                                        @else
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $units->previousPageUrl() }}">
                                                    <i class="mdi mdi-chevron-left"></i>
                                                </a>
                                            </li>
                                        @endif

                                        @foreach ($units->getUrlRange(1, $units->lastPage()) as $page => $url)
                                            <li class="page-item {{ $units->currentPage() == $page ? 'active' : '' }}">
                                                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                            </li>
                                        @endforeach

                                        @if ($units->hasMorePages())
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $units->nextPageUrl() }}">
                                                    <i class="mdi mdi-chevron-right"></i>
                                                </a>
                                            </li>
                                        @else
                                            <li class="page-item disabled">
                                                <span class="page-link">
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

        <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card bg-light">
                    <div class="card-body">
                        <h5 class="card-title">
                            <i class="mdi mdi-chart-pie me-2" style="color: #9a55ff;"></i>
                            Ringkasan Kavling
                        </h5>
                        @php
                            $totalUnits = $land->units->count();
                            $totalArea = $land->units->sum('area');
                            $sisaLuas = max(0, $land->remaining_area ?? $land->area - $totalArea);
                            $totalNilai = $land->units->sum('price');

                            $map = [
                                'belum_mulai' => 0,
                                'pondasi' => 20,
                                'dinding' => 40,
                                'atap' => 60,
                                'finishing' => 80,
                                'selesai' => 100,
                            ];

                            $unitProgress = $land->units->map(function ($unit) use ($map) {
                                $status = strtolower($unit->construction_progress ?? 'belum_mulai');
                                return $map[$status] ?? 0;
                            });

                            $progressPercent = $unitProgress->count() > 0 ? $unitProgress->avg() : 0;
                        @endphp

                        <div class="row">
                            <div class="col-6">
                                <p class="text-muted mb-1"><i class="mdi mdi-counter me-1"></i>Total Unit</p>
                                <h4>{{ $totalUnits }} unit</h4>
                            </div>
                            <div class="col-6">
                                <p class="text-muted mb-1"><i class="mdi mdi-ruler-square me-1"></i>Total Luas</p>
                                <h4>{{ number_format($totalArea, 0, ',', '.') }} m²</h4>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-6">
                                <p class="text-muted mb-1"><i class="mdi mdi-chart-arc me-1"></i>Sisa Luas Tanah</p>
                                <h4>{{ number_format($sisaLuas, 0, ',', '.') }} m²</h4>
                            </div>
                            <div class="col-6">
                                <p class="text-muted mb-1"><i class="mdi mdi-currency-usd me-1"></i>Nilai Total</p>
                                <h4>Rp {{ number_format($totalNilai, 0, ',', '.') }}</h4>
                            </div>
                        </div>

                        <div class="mt-4">
                            <p class="text-muted mb-1"><i class="mdi mdi-progress-clock me-1"></i>Progress Pembangunan</p>
                            <div class="progress">
                                <div class="progress-bar bg-success" role="progressbar"
                                    style="width: {{ $progressPercent }}%;" aria-valuenow="{{ $progressPercent }}"
                                    aria-valuemin="0" aria-valuemax="100">
                                    {{ number_format($progressPercent, 0) }}%
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-header bg-white">
                        <h5 class="card-title mb-0">
                            <i class="mdi mdi-map me-2 text-primary"></i>
                            Denah Kavling
                        </h5>
                    </div>

                    <div class="card-body text-center">
                        <div style="background-color:#f8f9fa; padding:20px; border-radius:8px;">

                            <div style="display:flex; flex-wrap:wrap; justify-content:center; gap:10px;">

                                @php
                                    $allUnits = $land->units;

                                    $blokKavlings = [];
                                    foreach ($allUnits as $unit) {
                                        $blok = explode('.', $unit->unit_code)[0];
                                        $blokKavlings[$blok][] = $unit;
                                    }

                                    $allBloks = array_keys($blokKavlings);
                                @endphp

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

                                        <strong>
                                            Blok {{ $blok }} - {{ $labelType }}
                                        </strong>

                                        <div
                                            style="display:flex; flex-wrap:wrap; gap:6px; justify-content:center; margin-top:6px;">

                                            @php
                                                $numbers = [];
                                                foreach ($blokKavlings[$blok] as $unit) {
                                                    $num = (int) explode('.', $unit->unit_code)[1];
                                                    $numbers[] = $num;
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

                                                            case 'draft':
                                                                $bgColor = '#343a40';
                                                                $icon = 'pencil';
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
                                                                $extraStyle = 'background-image: repeating-linear-gradient(
                                                                45deg,
                                                                rgba(255,255,255,0.2),
                                                                rgba(255,255,255,0.2) 5px,
                                                                transparent 5px,
                                                                transparent 10px
                                                            );';
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

                                                <span
                                                    style="
                                                        background-color: {{ $bgColor }};
                                                        color:white;
                                                        padding:6px 10px;
                                                        border-radius:4px;
                                                        font-size:12px;
                                                        border: {{ $borderStyle }};
                                                        {{ $extraStyle }}
                                                        position:relative;
                                                        min-width:60px;
                                                        display:inline-block;
                                                    ">

                                                    @if ($typeBadge)
                                                        <small
                                                            style="
                                                                position:absolute;
                                                                top:-6px;
                                                                right:-6px;
                                                                background:#000;
                                                                color:#fff;
                                                                font-size:9px;
                                                                padding:2px 4px;
                                                                border-radius:50%;
                                                            ">
                                                            {{ $typeBadge }}
                                                        </small>
                                                    @endif

                                                    <i class="mdi mdi-{{ $icon }} me-1"></i>
                                                    {{ $blok . '.' . $i }}
                                                </span>
                                            @endfor
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="mt-4 text-start">
                                <h6>Status Penjualan:</h6>
                                <div class="d-flex flex-wrap gap-2 mb-3">
                                    <span class="badge bg-danger">Sold</span>
                                    <span class="badge bg-warning text-dark">Booked</span>
                                    <span class="badge bg-dark">Draft</span>
                                    <span class="badge bg-success">Ready - Subsidi</span>
                                    <span class="badge bg-primary">Ready - Komersil</span>
                                </div>

                                <h6>Progress Pembangunan (Border):</h6>
                                <div class="d-flex flex-wrap gap-2 mb-3">
                                    <span style="border:2px dashed #000; padding:4px 8px;">Belum Mulai</span>
                                    <span style="border:2px solid #000; padding:4px 8px;">Pondasi</span>
                                    <span style="border:3px solid #000; padding:4px 8px;">Dinding</span>
                                    <span style="border:3px double #000; padding:4px 8px;">Atap</span>
                                    <span style="border:3px groove #000; padding:4px 8px;">Finishing</span>
                                    <span style="border:3px solid #155724; padding:4px 8px;">Selesai</span>
                                </div>

                                <h6>Tipe Unit:</h6>
                                <div class="d-flex gap-2">
                                    <span class="badge bg-success">S = Subsidi</span>
                                    <span class="badge bg-primary">K = Komersil</span>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Unit dengan 2 Metode -->
    <div class="modal fade modal-custom" id="tambahUnitModal" tabindex="-1" aria-labelledby="tambahUnitModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahUnitModalLabel">
                        <i class="mdi mdi-plus-circle me-2"></i>Tambah Unit Kavling Baru
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body modal-scroll-body">
                    <!-- Tab Navigation di dalam modal -->
                    <div class="modal-tabs-wrapper">
                        <ul class="modal-tabs" id="modalTab" role="tablist">
                            <li class="modal-tab-item">
                                <a class="modal-tab-link active" id="modal-manual-tab" data-modal-tab="manual"
                                    role="tab">
                                    <i class="mdi mdi-pencil"></i>
                                    <span>Manual Satu per Satu</span>
                                </a>
                            </li>
                            <li class="modal-tab-item">
                                <a class="modal-tab-link" id="modal-import-tab" data-modal-tab="import" role="tab">
                                    <i class="mdi mdi-import"></i>
                                    <span>Import Excel</span>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <!-- Tab Pane Manual -->
                    <div class="modal-tab-pane active" id="modal-manual-pane">
                        <form action="{{ route('properti.storeKavling', $land->id) }}" method="POST"
                            id="formTambahUnitManual" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="kavling-form-group">
                                        <label>Blok / No. Unit</label>
                                        <input type="text" name="block" class="kavling-form-control"
                                            placeholder="Contoh: A">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="kavling-form-group">
                                        <label>Nomor Unit</label>
                                        <input type="text" name="unit_number" class="kavling-form-control"
                                            placeholder="1">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="kavling-form-group">
                                        <label>Jenis Unit</label>
                                        <select name="jenis" class="kavling-form-control">
                                            <option value="">-- Pilih Jenis --</option>
                                            <option value="subsidi">Subsidi</option>
                                            <option value="komersil">Komersil</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="kavling-form-group">
                                        <label>Type Unit</label>
                                        <input type="text" name="type" class="kavling-form-control"
                                            placeholder="60/80">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="kavling-form-group">
                                        <label>Nama Unit</label>
                                        <input type="text" name="unit_name" class="kavling-form-control"
                                            placeholder="Cluster Mawar">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="kavling-form-group">
                                        <label>Luas</label>
                                        <div class="kavling-input-group-rp">
                                            <span class="kavling-input-group-rp-addon">m²</span>
                                            <input type="number" name="area" class="kavling-form-control"
                                                placeholder="200" min="1" step="any">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="kavling-form-group">
                                        <label>Luas Bangunan</label>
                                        <div class="kavling-input-group-rp">
                                            <span class="kavling-input-group-rp-addon">m²</span>
                                            <input type="number" name="building_area" class="kavling-form-control"
                                                placeholder="200" min="1" step="any">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="kavling-form-group">
                                        <label>Harga</label>
                                        <div class="kavling-input-group-rp">
                                            <span class="kavling-input-group-rp-addon">Rp</span>
                                            <input type="text" name="price"
                                                class="kavling-form-control price-format" placeholder="500.000.000">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="kavling-form-group">
                                        <label>Harga IJB</label>
                                        <div class="kavling-input-group-rp">
                                            <span class="kavling-input-group-rp-addon">Rp</span>
                                            <input type="text" name="ijb_price"
                                                class="kavling-form-control price-format" placeholder="500.000.000">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="kavling-form-group">
                                        <label>Harga AJB</label>
                                        <div class="kavling-input-group-rp">
                                            <span class="kavling-input-group-rp-addon">Rp</span>
                                            <input type="text" name="ajb_price"
                                                class="kavling-form-control price-format" placeholder="500.000.000">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="kavling-form-group">
                                        <label>Hadap</label>
                                        <select name="facing" class="kavling-form-control">
                                            <option>Utara</option>
                                            <option>Selatan</option>
                                            <option>Timur</option>
                                            <option>Barat</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="kavling-form-group">
                                        <label>Posisi</label>
                                        <select name="position" class="kavling-form-control">
                                            <option>Hook</option>
                                            <option>Tengah</option>
                                            <option>Sudut</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-12">
                                    <div class="kavling-form-group">
                                        <label>Keterangan</label>
                                        <input type="text" name="description" class="kavling-form-control"
                                            placeholder="Opsional">
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-4">
                                    <div class="kavling-form-group">
                                        <label>No SPK</label>
                                        <input type="text" name="no_spk" class="kavling-form-control"
                                            placeholder="Contoh: SPK/001/IV/2026">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="kavling-form-group">
                                        <label>Kontraktor</label>
                                        <input type="text" name="kontraktor" class="kavling-form-control"
                                            placeholder="Nama Kontraktor">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="kavling-form-group">
                                        <label>Dokumen SPK (PDF)</label>
                                        <div class="kavling-file-upload-modern">
                                            <input type="file" name="dokumen_spk" id="uploadSPK" accept=".pdf">
                                            <div class="kavling-file-label-modern">
                                                <i class="mdi mdi-cloud-upload"></i>
                                                <div class="kavling-file-info-modern">
                                                    <span id="spkFileName">Upload Dokumen SPK</span>
                                                    <small>Format: PDF (Max: 5MB)</small>
                                                </div>
                                                <span class="kavling-file-size" id="spkFileSize"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Tab Pane Import Excel -->
                    <div class="modal-tab-pane" id="modal-import-pane">
                        <div class="text-center py-3">
                            <i class="mdi mdi-file-excel text-success" style="font-size: 48px;"></i>
                            <h5 class="mt-3">Import Data Kavling dari Excel</h5>
                            <p class="text-muted">
                                <i class="mdi mdi-information-outline me-1"></i>
                                Download template Excel, isi data unit, lalu upload kembali
                            </p>

                            <div class="row justify-content-center">
                                <div class="col-md-12">
                                    <div class="kavling-form-group">
                                        <label>Download Template</label>
                                        <div>
                                            <a href="{{ route('kavling.template') }}"
                                                class="kavling-btn kavling-btn-outline-success">
                                                <i class="mdi mdi-download me-1"></i>Template Kavling.xlsx
                                            </a>
                                        </div>
                                    </div>
                                    <form action="{{ route('kavling.import', $land->id) }}" method="POST"
                                        enctype="multipart/form-data" id="formImportExcelModal">
                                        @csrf

                                        <div class="kavling-form-group">
                                            <label>Upload File Excel</label>
                                            <div class="kavling-file-upload-modern position-relative">
                                                <input type="file" id="uploadExcelModal" name="file"
                                                    accept=".xlsx,.xls" required
                                                    style="opacity:0; position:absolute; inset:0; cursor:pointer;">
                                                <div class="kavling-file-label-modern text-center p-4 border rounded">
                                                    <i class="mdi mdi-cloud-upload" style="font-size:32px;"></i>
                                                    <div class="kavling-file-info-modern mt-2">
                                                        <span id="fileNameModal">Upload File Excel</span>
                                                        <small class="d-block text-muted">
                                                            Format: .xlsx, .xls (Max 5MB)
                                                        </small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-gradient-secondary" data-bs-dismiss="modal">
                        <i class="mdi mdi-close me-1"></i>Batal
                    </button>

                    <!-- Submit Manual -->
                    <button type="submit" form="formTambahUnitManual" class="btn btn-gradient-primary">
                        <i class="mdi mdi-content-save me-1"></i>Simpan Unit
                    </button>

                    <!-- Submit Import Excel -->
                    <button type="submit" form="formImportExcelModal" class="btn btn-gradient-success">
                        <i class="mdi mdi-upload me-1"></i>Import Excel
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Tab switching di dalam modal
        $(document).ready(function() {
            $('.modal-tab-link').on('click', function(e) {
                e.preventDefault();

                $('.modal-tab-link').removeClass('active');
                $(this).addClass('active');

                var target = $(this).data('modal-tab');
                var actionBtn = $('#modalActionBtn');

                $('.modal-tab-pane').removeClass('active');
                if (target === 'manual') {
                    $('#modal-manual-pane').addClass('active');
                    // Ubah button untuk tab manual
                    actionBtn.html('<i class="mdi mdi-content-save me-1"></i>Simpan');
                    actionBtn.attr('onclick', '$("#formTambahUnitManual").trigger("submit")');
                    actionBtn.prop('disabled', false);
                } else if (target === 'import') {
                    $('#modal-import-pane').addClass('active');
                    // Ubah button untuk tab import
                    actionBtn.html('<i class="mdi mdi-import me-1"></i>Import');
                    actionBtn.attr('onclick', '$("#formImportExcelModal").trigger("submit")');
                    actionBtn.prop('disabled', !$('#uploadExcelModal').val());
                }
            });

            // File upload handler untuk modal import
            $('#uploadExcelModal').on('change', function(e) {
                const file = e.target.files[0];
                const actionBtn = $('#modalActionBtn');
                const fileNameSpan = $('#fileNameModal');

                if (!file) {
                    actionBtn.prop('disabled', true);
                    fileNameSpan.text("Upload File Excel");
                    return;
                }

                if (file.size > 5 * 1024 * 1024) {
                    alert("File maksimal 5MB!");
                    $(this).val("");
                    actionBtn.prop('disabled', true);
                    fileNameSpan.text("Upload File Excel");
                    return;
                }

                fileNameSpan.text(file.name);
                actionBtn.prop('disabled', false);
            });

            // Format harga untuk form manual di modal
            function formatRupiah(angka) {
                if (!angka) return '';
                let nilai = angka.toString().replace(/\D/g, '');
                if (nilai) {
                    return new Intl.NumberFormat('id-ID').format(nilai);
                }
                return '';
            }

            $(document).on('keyup', '.price-format', function() {
                let nilai = $(this).val().replace(/\D/g, '');
                if (nilai) {
                    let rupiah = new Intl.NumberFormat('id-ID').format(nilai);
                    $(this).val(rupiah);
                }
            });

            // Submit form manual - hapus titik sebelum submit + loading Swal
            $('#formTambahUnitManual').on('submit', function(e) {
                e.preventDefault();
                $('.price-format').each(function() {
                    let nilai = $(this).val().replace(/\./g, '');
                    $(this).val(nilai);
                });
                Swal.fire({
                    title: 'Memuat...',
                    html: 'Sedang menyimpan data unit kavling',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
                var form = this;
                setTimeout(function() {
                    form.submit();
                }, 150);
            });

            // Submit form import + loading Swal
            $('#formImportExcelModal').on('submit', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Memuat...',
                    html: 'Sedang mengimpor data dari Excel',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
                var form = this;
                setTimeout(function() {
                    form.submit();
                }, 150);
            });

            // Validasi blok maksimal 5 karakter
            $(document).on('keyup', 'input[name="block"]', function() {
                let nilai = $(this).val();
                if (nilai.length > 5) {
                    $(this).val(nilai.substring(0, 5));
                    alert('Blok maksimal 5 karakter');
                }
            });

            // SPK file upload handler
            $('#uploadSPK').on('change', function(e) {
                const file = e.target.files[0];
                const fileNameSpan = $('#spkFileName');
                const fileSizeSpan = $('#spkFileSize');

                if (!file) {
                    fileNameSpan.text("Upload Dokumen SPK");
                    fileSizeSpan.text("");
                    return;
                }

                if (file.size > 5 * 1024 * 1024) {
                    alert("File maksimal 5MB!");
                    $(this).val("");
                    fileNameSpan.text("Upload Dokumen SPK");
                    fileSizeSpan.text("");
                    return;
                }

                fileNameSpan.text(file.name);

                const sizeKB = (file.size / 1024).toFixed(0);
                const sizeMB = (file.size / (1024 * 1024)).toFixed(2);
                if (file.size >= 1024 * 1024) {
                    fileSizeSpan.text(sizeMB + " MB");
                } else {
                    fileSizeSpan.text(sizeKB + " KB");
                }
            });

            // Reset form saat modal ditutup
            $('#tambahUnitModal').on('hidden.bs.modal', function() {
                $('#formTambahUnitManual')[0].reset();
                $('#formImportExcelModal')[0].reset();
                $('.price-format').val('');
                $('#fileNameModal').text("Upload File Excel");
                $('#spkFileName').text("Upload Dokumen SPK");
                $('#spkFileSize').text("");

                // Reset ke tab manual
                $('.modal-tab-link').removeClass('active');
                $('.modal-tab-link[data-modal-tab="manual"]').addClass('active');
                $('.modal-tab-pane').removeClass('active');
                $('#modal-manual-pane').addClass('active');

                // Reset button action ke default
                $('#modalActionBtn').html('<i class="mdi mdi-content-save me-1"></i>Simpan');
                $('#modalActionBtn').attr('onclick', '$("#formTambahUnitManual").trigger("submit")');
                $('#modalActionBtn').prop('disabled', false);
            });
        });
    </script>
    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: @json(session('success')),
                    timer: 3000,
                    timerProgressBar: true,
                    showConfirmButton: true,
                    confirmButtonText: 'OK'
                });
            });
        </script>
    @endif
    @if (session('error'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: @json(session('error'))
                });
            });
        </script>
    @endif
    @if ($errors->any())
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Validasi gagal',
                    html: @json(implode('<br>', $errors->all()))
                });
            });
        </script>
    @endif
@endpush
