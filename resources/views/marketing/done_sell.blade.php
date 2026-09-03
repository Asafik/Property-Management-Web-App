@extends('layouts.partial.app')

@section('title', 'Detail Unit Terjual - Property Management App')

@section('content')
    <style>
        .sold-unit-page {
            color: #2c2e3f;
        }

        /* ===== CARD ===== */
        .sold-unit-page .card {
            border: 0;
            margin-bottom: 1rem;
            box-shadow: 0 4px 18px rgba(44, 46, 63, 0.05);
            transition: box-shadow 0.25s ease;
            background: #fff;
        }

        .sold-unit-page .card:hover {
            transform: none !important;
            box-shadow: 0 8px 20px rgba(154, 85, 255, 0.08);
        }

        .sold-unit-page .card-header {
            background: #ffffff;
            border-bottom: 1px solid #f0edf7;
            padding: 1rem 1.25rem;
        }

        .sold-unit-page .card-body {
            padding: 1.25rem;
        }

        .sold-unit-page .card-title {
            font-size: 1rem;
            font-weight: 700;
            color: #2c2e3f;
            margin-bottom: 0;
            display: flex;
            align-items: center;
            gap: 8px;
            letter-spacing: 0.2px;
        }

        .sold-unit-page .card-title i {
            color: #9a55ff !important;
            font-size: 1.1rem;
        }

        /* ===== HEADER STATUS ===== */
        .sold-status-card .card-body {
            padding: 1.5rem;
        }

        .sold-status-main {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .sold-status-left {
            display: flex;
            align-items: center;
            gap: 1rem;
            min-width: 0;
            flex: 1;
        }

        .sold-status-icon {
            width: 64px;
            height: 64px;
            border-radius: 12px;
            background: linear-gradient(135deg, #28a745, #5cb85c);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            box-shadow: 0 6px 14px rgba(40, 167, 69, 0.18);
        }

        .sold-status-icon i {
            font-size: 1.9rem;
        }

        .sold-status-title {
            font-size: 1.35rem;
            font-weight: 800;
            color: #2c2e3f;
            margin-bottom: 0.3rem;
            line-height: 1.2;
        }

        .sold-status-meta {
            color: #6c7383;
            font-size: 0.92rem;
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 0.5rem;
        }

        .sold-unit-box {
            min-width: 110px;
            padding: 0.85rem 1rem;
            background: linear-gradient(135deg, #f8f4ff, #f2ecff);
            border: 1px solid #eadfff;
            text-align: center;
            box-shadow: 0 4px 12px rgba(154, 85, 255, 0.08);
        }

        .sold-unit-label {
            display: block;
            font-size: 0.72rem;
            font-weight: 700;
            color: #8d86a5;
            text-transform: uppercase;
            letter-spacing: 0.4px;
            margin-bottom: 0.25rem;
        }

        .sold-unit-code {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.35rem;
            padding: 0.45rem 0.75rem;
            background: linear-gradient(135deg, #28a745, #5cb85c);
            color: #fff;
            font-size: 0.95rem;
            font-weight: 800;
            line-height: 1;
        }

        .sold-unit-code i {
            font-size: 0.95rem;
        }

        /* ===== INFO BOX ===== */
        .info-box {
            background: linear-gradient(135deg, #faf8ff, #f3ecff);
            border: 1px solid #eee6ff;
            border-radius: 12px;
            padding: 1.15rem 1.2rem;
            height: 100%;
        }

        .info-row {
            display: flex;
            align-items: flex-start;
            gap: 0.85rem;
            margin-bottom: 0.8rem;
        }

        .info-row:last-child {
            margin-bottom: 0;
        }

        .info-label {
            width: 130px;
            min-width: 130px;
            font-size: 0.83rem;
            font-weight: 700;
            color: #6c7383;
            line-height: 1.5;
        }

        .info-value {
            flex: 1;
            font-size: 0.94rem;
            font-weight: 600;
            color: #2c2e3f;
            line-height: 1.55;
            word-break: break-word;
        }

        .info-value-large {
            font-size: 1.1rem;
            font-weight: 800;
            color: #28a745;
        }

        /* ===== DETAIL CARD ===== */
        .detail-card {
            border: 1px solid #eeeaf7;
            border-radius: 12px;
            padding: 1rem 1.1rem;
            background: #fff;
            box-shadow: inset 0 0 0 1px rgba(255, 255, 255, 0.4);
            transition: all 0.25s ease;
        }

        .detail-card:hover {
            border-color: rgba(154, 85, 255, 0.28);
            box-shadow: 0 10px 25px rgba(154, 85, 255, 0.08);
        }

        .customer-summary {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1.25rem;
        }

        .customer-avatar {
            width: 72px;
            height: 72px;
            border-radius: 50%;
            background: linear-gradient(135deg, #9a55ff, #b57cff);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            box-shadow: 0 10px 20px rgba(154, 85, 255, 0.18);
        }

        .customer-avatar i {
            font-size: 2rem;
        }

        .customer-name {
            font-size: 1.35rem;
            font-weight: 800;
            color: #2c2e3f;
            margin-bottom: 0.2rem;
            line-height: 1.2;
        }

        .customer-booking {
            font-size: 0.9rem;
            color: #7b8092;
            margin-bottom: 0;
        }

        /* ===== BADGE ===== */
        .badge {
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            padding: 0.45rem 0.8rem;
            border-radius: 999px;
            font-size: 0.76rem;
            font-weight: 700;
            line-height: 1;
            border: none;
        }

        .badge-success {
            background: linear-gradient(135deg, #28a745, #5cb85c);
            color: white;
        }

        .badge-warning {
            background: linear-gradient(135deg, #ffc107, #ffdb6d);
            color: #2c2e3f;
        }

        .badge-info {
            background: linear-gradient(135deg, #17a2b8, #5bc0de);
            color: white;
        }

        .badge-primary {
            background: linear-gradient(135deg, #9a55ff, #da8cff);
            color: white;
        }

        /* ===== DOCUMENT LIST (COMPACT 2-COLUMN GRID) ===== */
        .document-list {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 0.65rem;
        }

        .document-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 0.6rem;
            padding: 0.65rem 0.85rem;
            background: #ffffff;
            border: 1px solid #e9edf4;
            border-radius: 9px;
            transition: all 0.2s ease;
            min-height: 52px;
        }

        .document-item:hover {
            background: #faf8ff;
            border-color: #d8c5ff;
            box-shadow: 0 4px 12px rgba(154, 85, 255, 0.08);
            transform: translateY(-1px);
        }

        .document-info {
            display: flex;
            align-items: center;
            gap: 0.65rem;
            min-width: 0;
            flex: 1;
        }

        .document-icon-wrapper {
            width: 32px;
            height: 32px;
            border-radius: 7px;
            background: #f1ebff;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .document-icon-wrapper i {
            font-size: 1.15rem;
        }

        .document-name {
            font-weight: 700;
            font-size: 0.82rem;
            color: #2c2e3f;
            line-height: 1.25;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            display: block;
        }

        .document-sub {
            font-size: 0.72rem;
            color: #8c90a4;
            line-height: 1.2;
            display: block;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .btn-eye {
            width: 30px;
            height: 30px;
            border-radius: 6px;
            background: linear-gradient(135deg, #9a55ff, #da8cff);
            color: white;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: none;
            flex-shrink: 0;
            font-size: 0.9rem;
            transition: all 0.2s ease;
        }

        .btn-eye:hover {
            box-shadow: 0 4px 10px rgba(154, 85, 255, 0.35);
            color: #ffffff;
            transform: scale(1.05);
        }

        @media (max-width: 767.98px) {
            .document-list {
                grid-template-columns: 1fr;
            }
        }

        /* ===== PRICE ===== */
        .price-summary {
            background: linear-gradient(135deg, #fcfbff, #f5f1ff);
            border: 1px solid #eee6ff;
            border-radius: 12px;
            padding: 1rem 1rem 0.9rem;
        }

        .price-row {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 1rem;
            margin-bottom: 0.8rem;
            font-size: 0.93rem;
            color: #2c2e3f;
        }

        .price-row span:first-child {
            color: #6c7383;
            font-weight: 600;
        }

        .price-row span:last-child {
            text-align: right;
            font-weight: 700;
            color: #2c2e3f;
        }

        .price-row.total {
            border-top: 1px dashed #d7c8ff;
            margin-top: 0.9rem;
            padding-top: 0.9rem;
        }

        .price-row.total span {
            font-size: 1.05rem;
            font-weight: 800 !important;
            color: #28a745 !important;
        }

        /* ===== TIMELINE ===== */
        .timeline-completed {
            position: relative;
            padding-left: 28px;
        }

        .timeline-completed::before {
            content: '';
            position: absolute;
            left: 7px;
            top: 8px;
            bottom: 8px;
            width: 2px;
            background: linear-gradient(to bottom, rgba(40, 167, 69, 0.35), rgba(40, 167, 69, 0.65));
        }

        .timeline-item {
            position: relative;
            padding-bottom: 1.25rem;
        }

        .timeline-item:last-child {
            padding-bottom: 0;
        }

        .timeline-item::before {
            content: '';
            position: absolute;
            left: -27px;
            top: 3px;
            width: 14px;
            height: 14px;
            box-sizing: border-box;
            border-radius: 50%;
            background: #28a745;
            border: 3px solid #ffffff;
            box-shadow: 0 0 0 3px rgba(40, 167, 69, 0.2);
        }

        .timeline-date {
            font-size: 0.78rem;
            color: #28a745;
            font-weight: 800;
            margin-bottom: 0.15rem;
        }

        .timeline-title {
            font-size: 1rem;
            font-weight: 800;
            color: #2c2e3f;
            margin-bottom: 0.15rem;
            line-height: 1.35;
        }

        .timeline-desc {
            font-size: 0.88rem;
            color: #6c7383;
            line-height: 1.5;
        }

        /* ===== BUTTON ===== */
        .btn {
            font-size: 0.88rem;
            padding: 0.72rem 1.05rem;
            border-radius: 12px;
            font-weight: 700;
            transition: all 0.25s ease;
            border: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.35rem;
        }

        .btn:hover {
            transform: none;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.08);
        }

        .btn-primary {
            background: linear-gradient(to right, #da8cff, #9a55ff);
            color: white;
        }

        .btn-outline-primary {
            background: transparent;
            border: 1px solid #9a55ff;
            color: #9a55ff;
        }

        .btn-outline-primary:hover {
            background: linear-gradient(135deg, #9a55ff, #da8cff);
            color: white;
            border-color: transparent;
        }

        .btn-outline-secondary {
            background: transparent;
            border: 1px solid #c7c9d1;
            color: #6c757d;
        }

        .btn-outline-secondary:hover {
            background: #6c757d;
            color: white;
            border-color: #6c757d;
        }

        .btn-success {
            background: linear-gradient(135deg, #28a745, #5cb85c);
            color: white;
        }

        /* ===== ADDITIONAL INFO ===== */
        .additional-info-item {
            display: flex;
            align-items: center;
            gap: 0.6rem;
            padding: 0.85rem 0.95rem;
            background: #fcfbff;
            border: 1px solid #f0eaff;
            border-radius: 10px;
            height: 100%;
        }

        .additional-info-item i {
            font-size: 1.15rem;
            flex-shrink: 0;
        }

        .note-box {
            background: linear-gradient(135deg, #faf8ff, #f6f2ff);
            border: 1px solid #efe7ff;
            border-radius: 10px;
            padding: 1rem 1rem 0.9rem;
        }

        /* ===== ACTION CARD ===== */
        .action-card .card-body {
            padding: 1rem 1.25rem;
        }

        .action-wrap {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .action-right {
            display: flex;
            gap: 0.75rem;
            flex-wrap: wrap;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 991.98px) {
            .sold-unit-page .card-header,
            .sold-unit-page .card-body {
                padding: 1rem;
            }

            .sold-status-title {
                font-size: 1.25rem;
            }

            .customer-name {
                font-size: 1.15rem;
            }
        }

        @media (max-width: 767.98px) {
            .sold-unit-page .container-fluid {
                padding-left: 0.75rem !important;
                padding-right: 0.75rem !important;
            }

            .sold-status-main {
                align-items: flex-start;
            }

            .sold-status-left {
                width: 100%;
            }

            .sold-unit-box {
                width: 100%;
                min-width: 100%;
                text-align: left;
                padding: 0.85rem 0.9rem;
            }

            .sold-unit-code {
                width: 100%;
            }

            .action-wrap,
            .action-right {
                width: 100%;
            }

            .action-right .btn,
            .action-wrap > div:first-child,
            .action-wrap > div:first-child .btn {
                width: 100%;
            }
        }

        @media (max-width: 575.98px) {
            .sold-unit-page .card-header {
                padding: 0.9rem 0.9rem;
            }

            .sold-unit-page .card-body,
            .sold-status-card .card-body,
            .action-card .card-body {
                padding: 0.9rem;
            }

            .sold-status-left {
                gap: 0.85rem;
                align-items: flex-start;
            }

            .sold-status-icon {
                width: 56px;
                height: 56px;
                border-radius: 10px;
            }

            .sold-status-icon i {
                font-size: 1.6rem;
            }

            .sold-status-title {
                font-size: 1.05rem;
            }

            .sold-status-meta {
                font-size: 0.82rem;
            }

            .customer-summary {
                align-items: flex-start;
            }

            .customer-avatar {
                width: 58px;
                height: 58px;
            }

            .customer-avatar i {
                font-size: 1.6rem;
            }

            .customer-name {
                font-size: 1.05rem;
            }

            .info-row {
                flex-direction: column;
                gap: 0.15rem;
                margin-bottom: 0.75rem;
            }

            .info-label {
                width: 100%;
                min-width: 100%;
                font-size: 0.78rem;
            }

            .info-value {
                font-size: 0.9rem;
            }

            .document-item {
                padding: 0.85rem 0.85rem;
            }

            .document-name {
                font-size: 0.9rem;
            }

            .price-row {
                flex-direction: column;
                gap: 0.18rem;
                margin-bottom: 0.75rem;
            }

            .price-row span:last-child {
                text-align: left;
            }

            .timeline-title {
                font-size: 0.94rem;
            }

            .timeline-desc {
                font-size: 0.84rem;
            }

            .badge {
                font-size: 0.72rem;
                padding: 0.42rem 0.7rem;
            }

            .btn {
                width: 100%;
                padding: 0.8rem 1rem;
            }
        }

        /* ===== COMPLAINT TABLE STYLES (DASHBOARD STYLE) ===== */
        .complaint-table-card {
            border-radius: 14px;
            overflow: hidden;
            border: 1px solid #edf2f9;
            box-shadow: 0 4px 18px rgba(0, 0, 0, 0.04);
            background: #fff;
        }

        .complaint-table-card .card-header {
            background: #ffffff;
            border-bottom: 1.5px solid #f1f3f7;
            padding: 1.1rem 1.25rem;
        }

        .complaint-table {
            width: 100%;
            margin-bottom: 0;
            border-collapse: separate;
            border-spacing: 0;
        }

        .complaint-table thead th {
            background-color: #faf8ff !important;
            color: #6c7383 !important;
            font-size: 0.78rem !important;
            font-weight: 700 !important;
            text-transform: uppercase !important;
            letter-spacing: 0.5px !important;
            border-top: none !important;
            border-bottom: 1.5px solid #edf2f7 !important;
            padding: 0.85rem 1rem !important;
            vertical-align: middle !important;
            white-space: nowrap;
        }

        .complaint-table tbody td {
            padding: 0.85rem 1rem !important;
            vertical-align: middle !important;
            font-size: 0.88rem !important;
            border-bottom: 1px solid #f1f3f7 !important;
            color: #2c2e3f;
        }

        .complaint-table tbody tr {
            transition: background-color 0.2s ease;
        }

        .complaint-table tbody tr:hover {
            background-color: #faf7ff !important;
        }

        .badge-ticket {
            background: #f3e8ff;
            color: #7e22ce;
            font-weight: 700;
            border: 1px solid #e9d5ff;
            border-radius: 6px;
            padding: 0.35rem 0.6rem;
            font-size: 0.8rem;
            font-family: 'SFMono-Regular', Menlo, Monaco, Consolas, monospace;
            display: inline-block;
        }

        .badge-category {
            background: #ede9fe;
            color: #6d28d9;
            font-weight: 700;
            border-radius: 6px;
            padding: 0.25rem 0.55rem;
            font-size: 0.72rem;
            text-transform: uppercase;
            letter-spacing: 0.3px;
            display: inline-block;
        }

        .badge-priority {
            padding: 0.32rem 0.75rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.3px;
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
        }

        .badge-priority.darurat {
            background: #fee2e2;
            color: #dc2626;
            border: 1px solid #fecaca;
        }

        .badge-priority.tinggi {
            background: #fef3c7;
            color: #d97706;
            border: 1px solid #fde68a;
        }

        .badge-priority.sedang {
            background: #e0f2fe;
            color: #0284c7;
            border: 1px solid #bae6fd;
        }

        .badge-priority.rendah {
            background: #f1f5f9;
            color: #64748b;
            border: 1px solid #e2e8f0;
        }

        .badge-status-pills {
            padding: 0.35rem 0.8rem;
            border-radius: 20px;
            font-size: 0.76rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.3px;
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
        }

        .badge-status-pills.selesai {
            background: linear-gradient(135deg, #28c76f, #48da89);
            color: #fff;
            box-shadow: 0 2px 6px rgba(40, 199, 111, 0.2);
        }

        .badge-status-pills.diproses {
            background: linear-gradient(135deg, #9a55ff, #da8cff);
            color: #fff;
            box-shadow: 0 2px 6px rgba(154, 85, 255, 0.2);
        }

        .badge-status-pills.pengecekan {
            background: linear-gradient(135deg, #00cfe8, #48da89);
            color: #fff;
        }

        .badge-status-pills.diajukan {
            background: #fff7ed;
            color: #ea580c;
            border: 1px solid #fed7aa;
        }

        .badge-status-pills.ditolak {
            background: #fef2f2;
            color: #ef4444;
            border: 1px solid #fecaca;
        }

        .badge-foto-bukti {
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            padding: 0.28rem 0.65rem;
            border-radius: 6px;
            font-size: 0.74rem;
            font-weight: 700;
            line-height: 1.2;
            transition: all 0.2s ease;
            white-space: nowrap;
        }

        .badge-foto-bukti.foto-awal {
            background: #fef2f2;
            color: #ef4444;
            border: 1px solid #fecaca;
        }

        .badge-foto-bukti.foto-awal:hover {
            background: #ef4444;
            color: #ffffff;
            border-color: #ef4444;
            transform: translateY(-1px);
            box-shadow: 0 2px 6px rgba(239, 68, 68, 0.25);
        }

        .badge-foto-bukti.foto-selesai {
            background: #f0fdf4;
            color: #16a34a;
            border: 1px solid #bbf7d0;
        }

        .badge-foto-bukti.foto-selesai:hover {
            background: #16a34a;
            color: #ffffff;
            border-color: #16a34a;
            transform: translateY(-1px);
            box-shadow: 0 2px 6px rgba(22, 163, 74, 0.25);
        }

        .btn-update-complaint {
            border: 1.5px solid #9a55ff;
            color: #9a55ff;
            background: #fff;
            font-weight: 700;
            font-size: 0.82rem;
            border-radius: 8px;
            padding: 0.38rem 0.85rem;
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            transition: all 0.2s ease;
            box-shadow: 0 2px 5px rgba(154, 85, 255, 0.08);
        }

        .btn-update-complaint:hover {
            background: linear-gradient(135deg, #da8cff, #9a55ff);
            color: #fff;
            border-color: #9a55ff;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(154, 85, 255, 0.25);
        }

        .btn-delete-complaint {
            border: 1.5px solid #fee2e2;
            color: #ef4444;
            background: #fef2f2;
            font-weight: 700;
            font-size: 0.82rem;
            border-radius: 8px;
            padding: 0.38rem 0.65rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
        }

        .btn-delete-complaint:hover {
            background: #ef4444;
            color: #fff;
            border-color: #ef4444;
            transform: translateY(-1px);
            box-shadow: 0 4px 10px rgba(239, 68, 68, 0.25);
        }

        .complaint-item-card {
            background: #ffffff;
            border: 1.5px solid #ede8fc !important;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(154, 85, 255, 0.04);
            transition: all 0.2s ease;
        }

        .complaint-item-card:hover {
            border-color: #c9b0f9 !important;
            box-shadow: 0 4px 12px rgba(154, 85, 255, 0.08);
        }

        .badge-complaint-summary {
            padding: 0.35rem 0.75rem;
            border-radius: 20px;
            font-size: 0.76rem;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
        }

        /* ===== COMPACT MODERN MODAL ===== */
        .modal-custom-compact {
            max-width: 580px !important;
            margin: 1.5rem auto;
        }

        /* Cegah layar jumping/scroll ke atas saat modal dibuka */
        body.modal-open {
            overflow: hidden !important;
            height: auto !important;
            min-height: 100vh !important;
            position: static !important;
        }

        body.modal-open .container-scroller,
        body.modal-open .page-body-wrapper,
        body.modal-open .content-wrapper,
        body.modal-open .main-panel {
            overflow: visible !important;
            height: auto !important;
        }

        .modal-content {
            border: none !important;
            border-radius: 16px !important;
            overflow: hidden !important;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.16) !important;
        }

        .modal-header {
            background: #ffffff !important;
            color: #2c2e3f !important;
            border-bottom: 1px solid #f0edf7 !important;
            padding: 1.1rem 1.4rem !important;
        }

        .modal-header .modal-title {
            font-size: 1.05rem !important;
            font-weight: 700 !important;
            color: #2c2e3f !important;
            display: flex;
            align-items: center;
            gap: 0.45rem;
        }

        .modal-header .btn-close-custom,
        .modal-header .btn-close {
            background: transparent;
            border: none;
            color: #64748b;
            font-size: 1.5rem;
            line-height: 1;
            opacity: 0.75;
            cursor: pointer;
            transition: all 0.2s ease;
            padding: 0;
        }

        .modal-header .btn-close-custom:hover,
        .modal-header .btn-close:hover {
            opacity: 1;
            color: #0f172a;
        }

        .modal-body {
            padding: 1.25rem 1.4rem !important;
            background: #ffffff;
        }

        .modal-footer {
            background: #faf8ff !important;
            border-top: 1px solid #f0edf7 !important;
            padding: 0.85rem 1.4rem !important;
        }

        .modal-custom-compact .form-control,
        .modal-custom-compact .form-select,
        #modalAddComplaint .form-control,
        #modalAddComplaint .form-select {
            border: 1.5px solid #e2e8f0 !important;
            border-radius: 8px !important;
            padding: 0.55rem 0.85rem !important;
            font-size: 0.88rem !important;
            color: #2c2e3f !important;
            background-color: #ffffff !important;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .modal-custom-compact .form-control:focus,
        .modal-custom-compact .form-select:focus,
        #modalAddComplaint .form-control:focus,
        #modalAddComplaint .form-select:focus {
            border-color: #9a55ff !important;
            box-shadow: 0 0 0 3px rgba(154, 85, 255, 0.12) !important;
            outline: none !important;
        }

        .custom-file-upload-modern {
            position: relative;
            width: 100%;
        }

        .custom-file-upload-modern input[type="file"] {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
            z-index: 2;
        }

        .custom-file-label-modern {
            display: flex;
            align-items: center;
            gap: 0.65rem;
            padding: 0.45rem 0.75rem;
            background: #ffffff;
            border: 1.5px dashed #cbd5e1;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .custom-file-upload-modern:hover .custom-file-label-modern {
            border-color: #9a55ff;
            background: #fbf9ff;
        }

        .custom-file-upload-modern.has-file .custom-file-label-modern {
            border-color: #10b981;
            border-style: solid;
            background: #f0fdf4;
        }

        .custom-file-label-modern i {
            font-size: 1.35rem;
            color: #9a55ff;
            flex-shrink: 0;
            transition: color 0.2s;
        }

        .custom-file-upload-modern.has-file .custom-file-label-modern i {
            color: #10b981 !important;
        }

        .custom-file-info-modern {
            min-width: 0;
            flex: 1;
            overflow: hidden;
        }

        .custom-file-info-modern span {
            display: block;
            font-size: 0.82rem;
            font-weight: 600;
            color: #2c2e3f;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .custom-file-info-modern small {
            display: block;
            font-size: 0.72rem;
            color: #8b8fa3;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .modal-custom-compact .form-label,
        #modalAddComplaint .form-label {
            font-size: 0.82rem !important;
            font-weight: 700 !important;
            color: #475569 !important;
            margin-bottom: 0.35rem !important;
        }
    </style>

    @php
        if (!function_exists('resolveFileUrl')) {
            function resolveFileUrl($path) {
                if (empty($path)) return '#';
                $path = str_replace('\\', '/', $path);
                if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
                    return $path;
                }
                $clean = ltrim($path, '/');
                if (file_exists(public_path($clean))) {
                    return asset($clean);
                }
                if (file_exists(public_path('uploads/' . $clean))) {
                    return asset('uploads/' . $clean);
                }
                if (file_exists(public_path('storage/' . $clean))) {
                    return asset('storage/' . $clean);
                }
                if (file_exists(storage_path('app/public/' . $clean))) {
                    return asset('storage/' . $clean);
                }
                if (str_starts_with($clean, 'uploads/') || str_starts_with($clean, 'storage/')) {
                    return asset($clean);
                }
                if (str_starts_with($clean, 'serah_terima/')) {
                    return asset('storage/' . $clean);
                }
                return asset('uploads/' . $clean);
            }
        }

        $kpr = $booking->kprApplication;
        $akad = $booking->akad;
        $serahTerima = $booking->serahTerima;
        $purchaseType = strtolower($booking->purchase_type ?? ($unit->purchase_type ?? 'cash'));
        
        $closingDate = $serahTerima?->tanggal_serah_terima 
            ? \Carbon\Carbon::parse($serahTerima->tanggal_serah_terima)->translatedFormat('d F Y') 
            : ($akad?->tanggal_akad 
                ? \Carbon\Carbon::parse($akad->tanggal_akad)->translatedFormat('d F Y') 
                : ($booking->serah_terima_date 
                    ? \Carbon\Carbon::parse($booking->serah_terima_date)->translatedFormat('d F Y') 
                    : ($booking->akad_date 
                        ? \Carbon\Carbon::parse($booking->akad_date)->translatedFormat('d F Y') 
                        : ($booking->updated_at ? $booking->updated_at->translatedFormat('d F Y') : '-'))));

        $totalPrice = $booking->total_price ?? ($unit->price ?? 0);
        $utjAmount = $booking->utj ?? ($booking->booking_fee ?? 0);
        $totalPaid = $booking->payments ? $booking->payments->sum('amount') : 0;
        $remaining = max(0, $totalPrice - $totalPaid);
    @endphp

    <div class="container-fluid p-2 p-sm-3 p-md-4 sold-unit-page">
        <!-- Header dengan Status TERJUAL -->
        <div class="row mb-3">
            <div class="col-12">
                <div class="card sold-status-card">
                    <div class="card-body">
                        <div class="sold-status-main">
                            <div class="sold-status-left">
                                <div class="sold-status-icon">
                                    <i class="mdi mdi-check"></i>
                                </div>
                                <div>
                                    <h4 class="sold-status-title">UNIT TELAH TERJUAL</h4>
                                    <div class="sold-status-meta">
                                        <span><i class="mdi mdi-calendar me-1"></i> Closing: {{ $closingDate }}</span>
                                        <span class="badge badge-success">SELESAI</span>
                                    </div>
                                </div>
                            </div>

                            <div class="sold-unit-box">
                                <span class="sold-unit-label">Unit</span>
                                <span class="sold-unit-code">
                                    <i class="mdi mdi-home"></i> {{ $unit->unit_code ?? '-' }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Row: Info Unit -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-white">
                        <h5 class="card-title">
                            <i class="mdi mdi-home-variant"></i>
                            INFORMASI UNIT YANG DIBELI
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="info-box">
                                    <div class="info-row">
                                        <span class="info-label">Nama Unit</span>
                                        <span class="info-value fw-bold">Tipe {{ $unit->type ?? '-' }} -
                                            {{ $unit->unit_name ?? '-' }}</span>
                                    </div>
                                    <div class="info-row">
                                        <span class="info-label">Blok / No</span>
                                        <span class="info-value">{{ $unit->unit_code ?? '-' }}</span>
                                    </div>
                                    <div class="info-row">
                                        <span class="info-label">Luas Tanah</span>
                                        <span class="info-value">{{ $unit->area ?? ($kpr->luas_tanah ?? '-') }} m²</span>
                                    </div>
                                    <div class="info-row">
                                        <span class="info-label">Luas Bangunan</span>
                                        <span class="info-value">{{ $unit->building_area ?? ($kpr->luas_bangunan ?? '-') }} m²</span>
                                    </div>
                                    <div class="info-row">
                                        <span class="info-label">Hadap</span>
                                        <span class="info-value">{{ $unit->facing ?? '-' }}</span>
                                    </div>
                                    <div class="info-row">
                                        <span class="info-label">Posisi</span>
                                        <span class="info-value">{{ $unit->position ?? '-' }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="info-box">
                                    <div class="info-row">
                                        <span class="info-label">Lokasi</span>
                                        <span class="info-value">{{ $unit->landBank->address ?? ($unit->landBank->project_name ?? '-') }}</span>
                                    </div>
                                    <div class="info-row">
                                        <span class="info-label">Koordinat</span>
                                        <span class="info-value">{{ $unit->landBank->lat ?? '-' }},
                                            {{ $unit->landBank->lng ?? '-' }}</span>
                                    </div>
                                    <div class="info-row">
                                        <span class="info-label">Zonasi</span>
                                        <span class="info-value">{{ $unit->landBank->zoning ?? ($unit->landBank->nama_cluster ?? '-') }}</span>
                                    </div>
                                    <div class="info-row">
                                        <span class="info-label">Lebar Jalan</span>
                                        <span class="info-value">{{ $unit->landBank->road_width ? $unit->landBank->road_width . 'm' : '-' }}
                                            ({{ $unit->landBank->road_type ?? '-' }})</span>
                                    </div>
                                    <div class="info-row">
                                        <span class="info-label">Listrik</span>
                                        <span class="info-value">{{ $unit->electricity ?? ($unit->listrik ?? '1300 VA') }}</span>
                                    </div>
                                    <div class="info-row">
                                        <span class="info-label">Sumber Air</span>
                                        <span class="info-value">{{ $unit->water_source ?? ($unit->air ?? 'PDAM / Sumur Bor') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Row: Data Customer & Dokumen -->
        <div class="row mt-3">
            <div class="col-md-6 mb-3 mb-md-0">
                <div class="card h-100">
                    <div class="card-header bg-white">
                        <h5 class="card-title">
                            <i class="mdi mdi-account-circle"></i>
                            DATA CUSTOMER
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="customer-summary">
                            <div class="customer-avatar">
                                <i class="mdi mdi-account"></i>
                            </div>
                            <div>
                                <h4 class="customer-name">{{ $booking->customer->full_name ?? '-' }}</h4>
                                <p class="customer-booking">Booking ID: {{ $booking->booking_code ?? '-' }}</p>
                            </div>
                        </div>

                        <div class="detail-card">
                            <div class="info-row">
                                <span class="info-label">NIK</span>
                                <span class="info-value">{{ $booking->customer->nik ?? '-' }}</span>
                            </div>
                            <div class="info-row">
                                <span class="info-label">NPWP</span>
                                <span class="info-value">{{ $booking->customer->npwp ?? '-' }}</span>
                            </div>
                            <div class="info-row">
                                <span class="info-label">No. HP</span>
                                <span class="info-value">{{ $booking->customer->phone ?? '-' }}</span>
                            </div>
                            <div class="info-row">
                                <span class="info-label">Email</span>
                                <span class="info-value">{{ $booking->customer->email ?? '-' }}</span>
                            </div>
                            <div class="info-row">
                                <span class="info-label">Alamat</span>
                                <span class="info-value">{{ $booking->customer->address ?? '-' }}</span>
                            </div>
                            <div class="info-row">
                                <span class="info-label">Pekerjaan</span>
                                <span class="info-value">{{ $booking->customer->job_status ?? '-' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card h-100">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center flex-wrap gap-2">
                        <h5 class="card-title mb-0">
                            <i class="mdi mdi-file-document-multiple text-primary"></i>
                            DOKUMEN TRANSAKSI
                        </h5>
                        <span class="badge bg-soft-primary text-primary font-monospace px-2 py-1" style="font-size: 0.75rem; border-radius: 6px; background: #faf8ff; border: 1px solid #efe8ff;">
                            <i class="mdi mdi-folder-check-outline me-1"></i> Berkas Transaksi
                        </span>
                    </div>
                    <div class="card-body">
                        <div class="document-list">
                            {{-- Dokumen Akad --}}
                            @if(!empty($akad?->dokumen))
                                <div class="document-item">
                                    <div class="document-info">
                                        <div class="document-icon-wrapper">
                                            <i class="mdi mdi-file-pdf text-danger"></i>
                                        </div>
                                        <div style="min-width: 0; flex: 1;">
                                            <span class="document-name" title="Dokumen Akad">Dokumen Akad</span>
                                            <small class="document-sub">{{ $akad->no_akad ? 'No: ' . $akad->no_akad : 'Berkas Akad' }}</small>
                                        </div>
                                    </div>
                                    <a href="{{ resolveFileUrl($akad->dokumen) }}" target="_blank" class="btn-eye" title="Lihat Dokumen">
                                        <i class="mdi mdi-eye"></i>
                                    </a>
                                </div>
                            @endif

                            {{-- Dokumen SPK --}}
                            @if(!empty($unit->dokumen_spk))
                                <div class="document-item">
                                    <div class="document-info">
                                        <div class="document-icon-wrapper">
                                            <i class="mdi mdi-file-document-outline text-primary"></i>
                                        </div>
                                        <div style="min-width: 0; flex: 1;">
                                            <span class="document-name" title="Dokumen SPK Pembangunan">SPK Pembangunan</span>
                                            <small class="document-sub">SPK Unit</small>
                                        </div>
                                    </div>
                                    <a href="{{ resolveFileUrl($unit->dokumen_spk) }}" target="_blank" class="btn-eye" title="Lihat Dokumen">
                                        <i class="mdi mdi-eye"></i>
                                    </a>
                                </div>
                            @endif

                            {{-- Foto Serah Kunci --}}
                            @if(!empty($serahTerima?->foto_serah_kunci))
                                <div class="document-item">
                                    <div class="document-info">
                                        <div class="document-icon-wrapper">
                                            <i class="mdi mdi-key text-warning"></i>
                                        </div>
                                        <div style="min-width: 0; flex: 1;">
                                            <span class="document-name" title="Foto Serah Kunci">Foto Serah Kunci</span>
                                            <small class="document-sub">{{ $serahTerima->no_bast ? 'BAST: ' . $serahTerima->no_bast : 'Serah Terima' }}</small>
                                        </div>
                                    </div>
                                    <a href="{{ resolveFileUrl($serahTerima->foto_serah_kunci) }}" target="_blank" class="btn-eye" title="Lihat Foto Serah Kunci">
                                        <i class="mdi mdi-eye"></i>
                                    </a>
                                </div>
                            @endif

                            {{-- Foto Kondisi Unit --}}
                            @if(!empty($serahTerima?->foto_kondisi_unit))
                                <div class="document-item">
                                    <div class="document-info">
                                        <div class="document-icon-wrapper">
                                            <i class="mdi mdi-camera text-info"></i>
                                        </div>
                                        <div style="min-width: 0; flex: 1;">
                                            <span class="document-name" title="Foto Kondisi Unit">Kondisi Unit (BAST)</span>
                                            <small class="document-sub">Serah Terima</small>
                                        </div>
                                    </div>
                                    <a href="{{ resolveFileUrl($serahTerima->foto_kondisi_unit) }}" target="_blank" class="btn-eye" title="Lihat Foto Kondisi">
                                        <i class="mdi mdi-eye"></i>
                                    </a>
                                </div>
                            @endif

                            {{-- Foto Survey KPR (Depan, Interior, Lingkungan) --}}
                            @if(!empty($kpr?->foto_depan))
                                <div class="document-item">
                                    <div class="document-info">
                                        <div class="document-icon-wrapper">
                                            <i class="mdi mdi-home-outline text-primary"></i>
                                        </div>
                                        <div style="min-width: 0; flex: 1;">
                                            <span class="document-name" title="Foto Survey Tampak Depan">Survey Depan</span>
                                            <small class="document-sub">Survey Unit</small>
                                        </div>
                                    </div>
                                    <a href="{{ resolveFileUrl($kpr->foto_depan) }}" target="_blank" class="btn-eye" title="Lihat Foto">
                                        <i class="mdi mdi-eye"></i>
                                    </a>
                                </div>
                            @endif
                            @if(!empty($kpr?->foto_interior))
                                <div class="document-item">
                                    <div class="document-info">
                                        <div class="document-icon-wrapper">
                                            <i class="mdi mdi-home-floor-1 text-primary"></i>
                                        </div>
                                        <div style="min-width: 0; flex: 1;">
                                            <span class="document-name" title="Foto Survey Interior Unit">Survey Interior</span>
                                            <small class="document-sub">Survey Unit</small>
                                        </div>
                                    </div>
                                    <a href="{{ resolveFileUrl($kpr->foto_interior) }}" target="_blank" class="btn-eye" title="Lihat Foto">
                                        <i class="mdi mdi-eye"></i>
                                    </a>
                                </div>
                            @endif
                            @if(!empty($kpr?->foto_lingkungan))
                                <div class="document-item">
                                    <div class="document-info">
                                        <div class="document-icon-wrapper">
                                            <i class="mdi mdi-tree text-success"></i>
                                        </div>
                                        <div style="min-width: 0; flex: 1;">
                                            <span class="document-name" title="Foto Survey Lingkungan">Survey Lingkungan</span>
                                            <small class="document-sub">Survey Unit</small>
                                        </div>
                                    </div>
                                    <a href="{{ resolveFileUrl($kpr->foto_lingkungan) }}" target="_blank" class="btn-eye" title="Lihat Foto">
                                        <i class="mdi mdi-eye"></i>
                                    </a>
                                </div>
                            @endif

                            {{-- Dokumen KPR --}}
                            @if($kpr && $kpr->documents && $kpr->documents->count() > 0)
                                @foreach($kpr->documents as $doc)
                                    <div class="document-item">
                                        <div class="document-info">
                                            <div class="document-icon-wrapper">
                                                <i class="mdi mdi-file-check-outline text-success"></i>
                                            </div>
                                            <div style="min-width: 0; flex: 1;">
                                                <span class="document-name" title="{{ ucwords(str_replace('_', ' ', $doc->type ?? 'Dokumen KPR')) }}">{{ ucwords(str_replace('_', ' ', $doc->type ?? 'Dokumen KPR')) }}</span>
                                                <small class="document-sub">{{ $doc->status ?? 'Terverifikasi' }}</small>
                                            </div>
                                        </div>
                                        <a href="{{ resolveFileUrl($doc->path) }}" target="_blank" class="btn-eye" title="Lihat Dokumen">
                                            <i class="mdi mdi-eye"></i>
                                        </a>
                                    </div>
                                @endforeach
                            @endif

                            {{-- Fallback jika belum ada berkas upload fisik --}}
                            @if(empty($akad?->dokumen) && empty($unit->dokumen_spk) && (!$kpr || $kpr->documents->isEmpty()) && empty($serahTerima?->foto_kondisi_unit) && empty($serahTerima?->foto_serah_kunci) && empty($kpr?->foto_depan))
                                <div class="document-item">
                                    <div class="document-info">
                                        <div class="document-icon-wrapper">
                                            <i class="mdi mdi-file-check-outline text-success"></i>
                                        </div>
                                        <div style="min-width: 0; flex: 1;">
                                            <span class="document-name">Kelengkapan Berkas</span>
                                            <small class="document-sub">Administrasi</small>
                                        </div>
                                    </div>
                                    <span class="badge badge-success" style="font-size: 0.7rem;">Terverifikasi</span>
                                </div>
                                <div class="document-item">
                                    <div class="document-info">
                                        <div class="document-icon-wrapper">
                                            <i class="mdi mdi-certificate text-warning"></i>
                                        </div>
                                        <div style="min-width: 0; flex: 1;">
                                            <span class="document-name">Sertifikat</span>
                                            <small class="document-sub">SHGB / SHM</small>
                                        </div>
                                    </div>
                                    <span class="badge badge-info" style="font-size: 0.7rem;">Legal</span>
                                </div>
                            @endif
                        </div>

                        <div class="mt-3 text-md-end text-start">
                            <span class="badge badge-success p-2">
                                <i class="mdi mdi-check-circle"></i> Berkas Terverifikasi
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Row: Rincian Harga & Riwayat -->
        <div class="row mt-3">
            <div class="col-md-6 mb-3 mb-md-0">
                <div class="card h-100">
                    <div class="card-header bg-white">
                        <h5 class="card-title">
                            <i class="mdi mdi-cash-multiple"></i>
                            RINCIAN HARGA & PEMBAYARAN
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="price-summary">
                            @if ($purchaseType == 'cash' || $purchaseType == 'cash_tempo')
                                <div class="price-row">
                                    <span>Harga Unit</span>
                                    <span>Rp {{ number_format($totalPrice, 0, ',', '.') }}</span>
                                </div>
                                <div class="price-row">
                                    <span>Uang Tanda Jadi (UTJ)</span>
                                    <span>Rp {{ number_format($utjAmount, 0, ',', '.') }}</span>
                                </div>
                                <div class="price-row">
                                    <span>Total Terbayar</span>
                                    <span class="text-success fw-bold">Rp {{ number_format($totalPaid, 0, ',', '.') }}</span>
                                </div>
                                <div class="price-row total">
                                    <span>Sisa Tagihan</span>
                                    <span class="{{ $remaining > 0 ? 'text-danger' : 'text-success' }}">
                                        Rp {{ number_format($remaining, 0, ',', '.') }}
                                    </span>
                                </div>
                            @elseif($purchaseType == 'kpr')
                                <div class="price-row">
                                    <span>Harga Unit</span>
                                    <span>Rp {{ number_format($kpr->harga_unit ?? $totalPrice, 0, ',', '.') }}</span>
                                </div>
                                <div class="price-row">
                                    <span>Uang Tanda Jadi (UTJ)</span>
                                    <span>Rp {{ number_format($utjAmount, 0, ',', '.') }}</span>
                                </div>
                                <div class="price-row">
                                    <span>Uang Muka / DP</span>
                                    <span>Rp {{ number_format($kpr->dp ?? 0, 0, ',', '.') }}</span>
                                </div>
                                <div class="price-row">
                                    <span>Plafon / Pinjaman KPR Disetujui</span>
                                    <span class="text-primary fw-bold">Rp {{ number_format($kpr->jumlah_pinjaman ?? 0, 0, ',', '.') }}</span>
                                </div>
                                <div class="price-row">
                                    <span>Tenor</span>
                                    <span>{{ $kpr->tenor ?? '-' }} Tahun</span>
                                </div>
                                <div class="price-row">
                                    <span>Suku Bunga</span>
                                    <span>{{ $kpr->bunga ?? '-' }}%</span>
                                </div>
                                <div class="price-row total">
                                    <span>Estimasi Angsuran / Bulan</span>
                                    <span class="text-success">Rp {{ number_format($kpr->estimasi_angsuran ?? 0, 0, ',', '.') }}</span>
                                </div>
                            @endif
                        </div>

                        @if ($purchaseType == 'kpr' && $kpr)
                            <div class="mt-3">
                                <div class="info-row">
                                    <span class="info-label">Bank Penyalur</span>
                                    <span class="info-value fw-bold">{{ $kpr->bank->bank_name ?? '-' }}</span>
                                </div>
                                <div class="info-row">
                                    <span class="info-label">No. SP3K</span>
                                    <span class="info-value">{{ $kpr->no_sp3k ?? '-' }}</span>
                                </div>
                                <div class="info-row">
                                    <span class="info-label">No. Akad</span>
                                    <span class="info-value">{{ $akad->no_akad ?? '-' }}</span>
                                </div>
                                <div class="info-row">
                                    <span class="info-label">Tanggal Akad</span>
                                    <span class="info-value">{{ $akad?->tanggal_akad ? \Carbon\Carbon::parse($akad->tanggal_akad)->translatedFormat('d F Y') : '-' }}</span>
                                </div>
                                <div class="info-row">
                                    <span class="info-label">Notaris</span>
                                    <span class="info-value">{{ $akad->nama_notaris ?? '-' }}</span>
                                </div>
                                <div class="info-row">
                                    <span class="info-label">Lokasi Akad</span>
                                    <span class="info-value">{{ $akad->lokasi_akad ?? '-' }}</span>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card h-100">
                    <div class="card-header bg-white">
                        <h5 class="card-title">
                            <i class="mdi mdi-timeline-text"></i>
                            RIWAYAT TRANSAKSI
                        </h5>
                    </div>

                    <div class="card-body">
                        <div class="timeline-completed">
                            @if($purchaseType == 'cash' || $purchaseType == 'cash_tempo')
                                <div class="timeline-item">
                                    <div class="timeline-date">
                                        {{ $booking->created_at ? $booking->created_at->translatedFormat('d M Y') : '-' }}
                                    </div>
                                    <div class="timeline-title">Booking Unit & UTJ</div>
                                    <div class="timeline-desc">
                                        Customer melakukan booking unit (UTJ: Rp {{ number_format($utjAmount, 0, ',', '.') }})
                                    </div>
                                </div>

                                <div class="timeline-item">
                                    <div class="timeline-date">
                                        {{ $booking->created_at ? $booking->created_at->translatedFormat('d M Y') : '-' }}
                                    </div>
                                    <div class="timeline-title">Pembayaran & Administrasi</div>
                                    <div class="timeline-desc">
                                        Total pembayaran tercatat sebesar Rp {{ number_format($totalPaid, 0, ',', '.') }}
                                    </div>
                                </div>

                                <div class="timeline-item">
                                    <div class="timeline-date">
                                        {{ $akad?->tanggal_akad ? \Carbon\Carbon::parse($akad->tanggal_akad)->translatedFormat('d M Y') : ($booking->akad_date ? $booking->akad_date->translatedFormat('d M Y') : '-') }}
                                    </div>
                                    <div class="timeline-title">Akad Jual Beli</div>
                                    <div class="timeline-desc">
                                        Akad transaksi berhasil diproses
                                    </div>
                                </div>

                                <div class="timeline-item">
                                    <div class="timeline-date">
                                        {{ $serahTerima?->tanggal_serah_terima ? \Carbon\Carbon::parse($serahTerima->tanggal_serah_terima)->translatedFormat('d M Y') : ($booking->serah_terima_date ? $booking->serah_terima_date->translatedFormat('d M Y') : ($booking->updated_at ? $booking->updated_at->translatedFormat('d M Y') : '-')) }}
                                    </div>
                                    <div class="timeline-title">Serah Terima Unit</div>
                                    <div class="timeline-desc">
                                        Unit resmi diserahkan kepada customer
                                    </div>
                                </div>
                            @elseif($purchaseType == 'kpr')
                                <div class="timeline-item">
                                    <div class="timeline-date">
                                        {{ $booking->created_at ? $booking->created_at->translatedFormat('d M Y') : '-' }}
                                    </div>
                                    <div class="timeline-title">Booking Unit & UTJ</div>
                                    <div class="timeline-desc">
                                        Customer booking unit (UTJ: Rp {{ number_format($utjAmount, 0, ',', '.') }})
                                    </div>
                                </div>

                                <div class="timeline-item">
                                    <div class="timeline-date">
                                        {{ $kpr?->submitted_at ? \Carbon\Carbon::parse($kpr->submitted_at)->translatedFormat('d M Y') : ($booking->created_at ? $booking->created_at->translatedFormat('d M Y') : '-') }}
                                    </div>
                                    <div class="timeline-title">Pengajuan & Verifikasi KPR</div>
                                    <div class="timeline-desc">
                                        Pengajuan KPR ke {{ $kpr->bank->bank_name ?? 'Bank' }} telah diverifikasi
                                    </div>
                                </div>

                                <div class="timeline-item">
                                    <div class="timeline-date">
                                        {{ $kpr?->survey_date ? \Carbon\Carbon::parse($kpr->survey_date)->translatedFormat('d M Y') : '-' }}
                                    </div>
                                    <div class="timeline-title">Survey & Penilaian Bank</div>
                                    <div class="timeline-desc">
                                        Hasil survey kelayakan {{ $kpr->persentase_kelayakan ?? '100' }}%
                                    </div>
                                </div>

                                <div class="timeline-item">
                                    <div class="timeline-date">
                                        {{ $akad?->tanggal_akad ? \Carbon\Carbon::parse($akad->tanggal_akad)->translatedFormat('d M Y') : ($booking->akad_date ? $booking->akad_date->translatedFormat('d M Y') : '-') }}
                                    </div>
                                    <div class="timeline-title">Akad Kredit</div>
                                    <div class="timeline-desc">
                                        Akad kredit selesai dilaksanakan (No: {{ $akad->no_akad ?? '-' }})
                                    </div>
                                </div>

                                <div class="timeline-item">
                                    <div class="timeline-date">
                                        {{ $serahTerima?->tanggal_serah_terima ? \Carbon\Carbon::parse($serahTerima->tanggal_serah_terima)->translatedFormat('d M Y') : ($booking->serah_terima_date ? $booking->serah_terima_date->translatedFormat('d M Y') : ($booking->updated_at ? $booking->updated_at->translatedFormat('d M Y') : '-')) }}
                                    </div>
                                    <div class="timeline-title">Serah Terima Unit</div>
                                    <div class="timeline-desc">
                                        Unit resmi diserahterimakan kepada customer
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div class="mt-3 text-center text-md-center">
                            <span class="badge badge-success p-2">
                                <i class="mdi mdi-check-circle"></i>
                                STATUS: {{ strtoupper($booking->status ?? 'SELESAI') }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Row: Informasi Tambahan -->
        <div class="row mt-3">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-white">
                        <h5 class="card-title">
                            <i class="mdi mdi-information-outline"></i>
                            INFORMASI TAMBAHAN
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <div class="additional-info-item">
                                    <i class="mdi mdi-calendar-check text-success"></i>
                                    <div>
                                        <span class="fw-bold">Masa Garansi:</span>
                                        <span> 12 Bulan (s/d {{ $serahTerima?->tanggal_serah_terima ? \Carbon\Carbon::parse($serahTerima->tanggal_serah_terima)->addYear()->translatedFormat('F Y') : \Carbon\Carbon::now()->addYear()->translatedFormat('F Y') }})</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="additional-info-item">
                                    <i class="mdi mdi-tools text-primary"></i>
                                    <div>
                                        <span class="fw-bold">Jadwal Maintenance:</span>
                                        <span> Setiap 6 bulan</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="additional-info-item">
                                    <i class="mdi mdi-phone text-info"></i>
                                    <div>
                                        <span class="fw-bold">Sales Marketing:</span>
                                        <span> {{ $booking->sales->name ?? ($booking->sales->full_name ?? 'In-House Sales') }} ({{ $booking->sales->phone ?? ($booking->sales->no_hp ?? '-') }})</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr class="my-3">

                        <div class="row">
                            <div class="col-md-8">
                                <div class="note-box">
                                    <small class="text-muted d-block mb-1">Catatan:</small>
                                    <p class="mb-0">
                                        {{ $serahTerima?->catatan ?? ($akad?->catatan ?? ($booking->notes ?? 'Unit telah diserahkan kepada customer dalam kondisi baik bersama dokumen transaksi yang sah.')) }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Row: Modul Complaint / Keluhan & Garansi -->
        <div class="row mt-3">
            <div class="col-12">
                <div class="card complaint-table-card border-0">
                    @php
                        $complaints = $booking->complaints ?? collect([]);
                    @endphp
                    <div class="card-header bg-white d-flex justify-content-between align-items-center flex-wrap gap-2 py-3">
                        <h5 class="card-title mb-0 fw-bold" style="color: #2c2e3f;">
                            KELUHAN & KLAIM GARANSI (COMPLAINT)
                        </h5>
                        <button type="button" class="btn btn-gradient-primary btn-sm shadow-sm px-3 fw-bold d-flex align-items-center gap-1" onclick="openAddComplaintModal(event)">
                            <i class="mdi mdi-plus-circle me-1"></i> Ajukan Keluhan Baru
                        </button>
                    </div>
                    <div class="card-body p-0">
                        @if($complaints->count() > 0)
                            <div class="table-responsive">
                                <table class="table complaint-table table-hover align-middle mb-0">
                                    <thead>
                                        <tr>
                                            <th style="width: 140px;">No. Tiket</th>
                                            <th style="width: 120px;">Tgl Pengajuan</th>
                                            <th>Kategori & Detail Keluhan</th>
                                            <th class="text-center" style="width: 100px;">Prioritas</th>
                                            <th class="text-center" style="width: 120px;">Status Progress</th>
                                            <th style="width: 120px;">Foto / Bukti</th>
                                            <th style="width: 180px;">Penanggung Jawab</th>
                                            <th class="text-center" style="width: 140px;">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($complaints as $c)
                                            <tr>
                                                <td>
                                                    <span class="badge-ticket">{{ $c->ticket_number }}</span>
                                                </td>
                                                <td>
                                                    <small class="text-muted fw-semibold">{{ $c->tanggal_pengajuan ? $c->tanggal_pengajuan->format('d M Y') : '-' }}</small>
                                                </td>
                                                <td>
                                                    <span class="badge-category mb-1">
                                                        {{ str_replace('_', ' ', $c->kategori) }}
                                                    </span>
                                                    <div class="fw-bold text-dark">{{ $c->judul_keluhan }}</div>
                                                    <small class="text-muted text-wrap d-block" style="max-width: 320px; line-height: 1.4;">{{ Str::limit($c->deskripsi, 100) }}</small>
                                                </td>
                                                <td class="text-center">
                                                    <span class="badge-priority {{ strtolower($c->prioritas) }}">
                                                        {{ $c->prioritas }}
                                                    </span>
                                                </td>
                                                <td class="text-center">
                                                    <span class="badge-status-pills {{ strtolower($c->status) }}">
                                                        {{ $c->status }}
                                                    </span>
                                                    @if($c->status == 'selesai' && $c->tanggal_selesai)
                                                        <small class="d-block text-success mt-1" style="font-size: 0.72rem; font-weight: 600;">
                                                            {{ $c->tanggal_selesai->format('d M Y') }}
                                                        </small>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="d-inline-flex flex-column gap-1.5 align-items-start">
                                                        @if($c->foto_keluhan)
                                                            <a href="{{ resolveFileUrl($c->foto_keluhan) }}" target="_blank" class="badge-foto-bukti foto-awal text-decoration-none" title="Lihat Foto Keluhan Awal">
                                                                <i class="mdi mdi-image-outline me-1"></i> Foto Awal
                                                            </a>
                                                        @endif
                                                        @if($c->foto_penyelesaian)
                                                            <a href="{{ resolveFileUrl($c->foto_penyelesaian) }}" target="_blank" class="badge-foto-bukti foto-selesai text-decoration-none" title="Lihat Foto Bukti Penyelesaian">
                                                                <i class="mdi mdi-check-all me-1"></i> Foto Selesai
                                                            </a>
                                                        @endif
                                                        @if(!$c->foto_keluhan && !$c->foto_penyelesaian)
                                                            <span class="text-muted small fst-italic">Tanpa Foto</span>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td>
                                                    <small class="fw-bold text-dark d-block">{{ $c->petugas_penanggung_jawab ?? 'Belum Ditugaskan' }}</small>
                                                    @if($c->catatan_perbaikan)
                                                        <small class="text-muted d-block text-truncate" style="max-width: 170px;" title="{{ $c->catatan_perbaikan }}">"{{ $c->catatan_perbaikan }}"</small>
                                                    @endif
                                                    @if($c->biaya_perbaikan > 0)
                                                        <small class="text-danger fw-bold d-block mt-0.5" style="font-size: 0.75rem;">Biaya: Rp {{ number_format($c->biaya_perbaikan, 0, ',', '.') }}</small>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    <div class="d-inline-flex align-items-center gap-1">
                                                        <button type="button" class="btn btn-sm btn-update-complaint"
                                                            data-complaint="{{ base64_encode(json_encode($c)) }}"
                                                            onclick="handleUpdateComplaintClick(this, event)"
                                                            title="Update Progress Keluhan">
                                                            <i class="mdi mdi-wrench"></i> Update
                                                        </button>
                                                        <button type="button" class="btn btn-sm btn-delete-complaint"
                                                            onclick="confirmDeleteComplaint({{ $c->id }}, '{{ $c->ticket_number }}')"
                                                            title="Hapus Data Keluhan">
                                                            <i class="mdi mdi-trash-can-outline"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-center py-4">
                                <div class="mb-2">
                                    <i class="mdi mdi-check-circle-outline text-success" style="font-size: 3rem;"></i>
                                </div>
                                <h6 class="fw-bold text-dark mb-1">Belum Ada Keluhan / Komplain</h6>
                                <p class="text-muted small mb-3">Unit dalam kondisi baik dan masa garansi aktif berjalan.</p>
                                <button type="button" class="btn btn-gradient-primary btn-sm px-3" onclick="openAddComplaintModal(event)">
                                    <i class="mdi mdi-plus-circle"></i> Ajukan Keluhan Baru
                                </button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Tombol Aksi -->
        <div class="row mt-3">
            <div class="col-12">
                <div class="card action-card">
                    <div class="card-body">
                        <div class="action-wrap">
                            <div>
                                <a href="{{ route('marketing.jual-unit') }}" class="btn btn-outline-secondary">
                                    <i class="mdi mdi-arrow-left"></i> Kembali ke Daftar
                                </a>
                                <a href="{{ route('servis') }}" class="btn btn-outline-primary ms-2">
                                    <i class="mdi mdi-face-agent"></i> Buka Modul Servis
                                </a>
                            </div>
                            <div class="action-right">
                                <a href="{{ route('serah-terima.cetak', $booking->id) }}" target="_blank" class="btn btn-outline-primary d-inline-flex align-items-center gap-1 shadow-sm">
                                    <i class="mdi mdi-printer"></i> Cetak Lembar BAST Resmi
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL: AJUKAN KELUHAN BARU (MULTI-KELUHAN PER RUMAH) -->
    <div class="modal fade" id="modalAddComplaint" tabindex="-1" role="dialog" aria-labelledby="modalAddComplaintLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-custom-compact" role="document">
            <div class="modal-content border-0 shadow-lg" style="border-radius: 16px; overflow: hidden;">
                <div class="modal-header bg-white border-bottom py-2.5 px-3 px-md-4 d-flex justify-content-between align-items-center">
                    <h5 class="modal-title fw-bold text-dark mb-0" id="modalAddComplaintLabel" style="font-size: 1rem;">
                        <i class="mdi mdi-alert-circle-outline text-primary me-1"></i> Form Pengajuan Keluhan
                    </h5>
                    <button type="button" class="btn-close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('complaints.store') }}" method="POST" enctype="multipart/form-data" id="formAddComplaint">
                    @csrf
                    <input type="hidden" name="booking_id" value="{{ $booking->id }}">
                    <div class="modal-body p-3 p-md-4" style="background: #f8fafc; max-height: 75vh; overflow-y: auto;">
                        <div class="px-3 py-2 rounded-2 mb-3 border d-flex justify-content-between align-items-center flex-wrap gap-1" style="background: #faf8ff !important; border-color: #eee6ff !important;">
                            <div>
                                <span class="fw-bold text-dark" style="font-size: 0.88rem;">{{ $unit->unit_name ?? '-' }}</span>
                                <span class="badge bg-primary bg-opacity-10 text-primary font-monospace ms-1" style="font-size: 0.72rem;">Blok {{ $unit->unit_code ?? '-' }}</span>
                            </div>
                            <div class="small text-muted" style="font-size: 0.78rem;">
                                Konsumen: <strong class="text-dark">{{ $booking->customer->full_name ?? '-' }}</strong>
                            </div>
                        </div>

                        <!-- Container Dynamic Repeater Keluhan -->
                        <div id="complaintItemsContainer" class="d-flex flex-column gap-3">
                            <!-- Item #1 -->
                            <div class="complaint-item-card p-3 p-md-3 bg-white" data-index="0">
                                <div class="d-flex justify-content-between align-items-center mb-2 pb-2 border-bottom">
                                    <span class="fw-bold text-dark item-number-label" style="font-size: 0.88rem;">
                                        <i class="mdi mdi-numeric-1-circle text-primary me-1 fs-5 align-middle"></i> Keluhan #1
                                    </span>
                                    <button type="button" class="btn btn-sm btn-outline-danger btn-remove-item d-none" onclick="removeComplaintItem(this)" style="font-size: 0.75rem; padding: 0.2rem 0.5rem; border-radius: 6px;">
                                        <i class="mdi mdi-trash-can-outline"></i> Hapus
                                    </button>
                                </div>
                                <div class="row g-2">
                                    <div class="col-md-6 mb-2">
                                        <label class="form-label small fw-bold text-dark mb-1">Kategori Keluhan <span class="text-danger">*</span></label>
                                        <select class="form-control form-select" name="items[0][kategori]" required>
                                            <option value="">Pilih Kategori</option>
                                            <option value="kebocoran">Kebocoran Atap / Talang / Dinding</option>
                                            <option value="kelistrikan">Kelistrikan, Stopkontak & Lampu</option>
                                            <option value="sanitasi_pipa">Sanitasi, Saluran Air & Kran</option>
                                            <option value="pintu_jendela">Pintu, Jendela, Kunci & Kusen</option>
                                            <option value="struktur_dinding">Retak Dinding / Plesteran</option>
                                            <option value="finishing_cat">Cat Mengelupas / Keramik Pecah</option>
                                            <option value="lainnya">Lainnya / Masalah Umum</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <label class="form-label small fw-bold text-dark mb-1">Tingkat Prioritas <span class="text-danger">*</span></label>
                                        <select class="form-control form-select" name="items[0][prioritas]" required>
                                            <option value="rendah">Rendah</option>
                                            <option value="sedang" selected>Sedang</option>
                                            <option value="tinggi">Tinggi</option>
                                            <option value="darurat">Darurat</option>
                                        </select>
                                    </div>
                                    <div class="col-12 mb-2">
                                        <label class="form-label small fw-bold text-dark mb-1">Judul Keluhan <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="items[0][judul_keluhan]" placeholder="Judul keluhan..." required>
                                    </div>
                                    <div class="col-12 mb-2">
                                        <label class="form-label small fw-bold text-dark mb-1">Deskripsi Keluhan <span class="text-danger">*</span></label>
                                        <textarea class="form-control" name="items[0][deskripsi]" rows="2" placeholder="Detail rincian keluhan..." required></textarea>
                                    </div>
                                    <div class="col-12 mb-1">
                                        <label class="form-label small fw-bold text-dark mb-1">Foto Bukti Keluhan (Opsional)</label>
                                        <div class="custom-file-upload-modern" data-default-text="Pilih Foto Bukti">
                                            <input type="file" name="items[0][foto_keluhan]" accept="image/*,application/pdf">
                                            <div class="custom-file-label-modern">
                                                <i class="mdi mdi-cloud-upload-outline"></i>
                                                <div class="custom-file-info-modern">
                                                    <span class="file-name-text">Pilih Foto Bukti</span>
                                                    <small class="file-desc-text">Format: JPG, PNG, PDF (Maks. 5MB)</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Tombol Tambah Item Keluhan Baru -->
                        <div class="mt-3 text-center">
                            <button type="button" class="btn btn-sm btn-outline-primary px-3 py-1.5 rounded-2 fw-semibold shadow-sm" onclick="addComplaintItem()">
                                <i class="mdi mdi-plus-circle-outline me-1"></i> + Tambah Keluhan
                            </button>
                        </div>
                    </div>
                    <div class="modal-footer bg-white border-top py-2.5 px-3 px-md-4 d-flex justify-content-between align-items-center">
                        <span class="small text-muted" id="lblItemCount">Total: <strong>1 keluhan</strong></span>
                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-outline-secondary btn-sm px-3 rounded-2 fw-semibold" data-dismiss="modal" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-gradient-primary btn-sm px-4 fw-semibold text-white shadow-sm rounded-2" id="btnSubmitComplaints">
                                <i class="mdi mdi-send me-1"></i> Ajukan Keluhan
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- MODAL: UPDATE PROGRESS KELUHAN -->
    <div class="modal fade" id="modalUpdateComplaint" tabindex="-1" role="dialog" aria-labelledby="modalUpdateComplaintLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-custom-compact" role="document">
            <div class="modal-content border-0 shadow-lg" style="border-radius: 16px; overflow: hidden;">
                <div class="modal-header bg-white border-bottom py-2.5 px-3 px-md-4 d-flex justify-content-between align-items-center">
                    <h5 class="modal-title fw-bold text-dark mb-0" id="modalUpdateComplaintLabel" style="font-size: 1rem;">
                        <i class="mdi mdi-progress-wrench text-primary me-1"></i> Update Progress Keluhan
                    </h5>
                    <button type="button" class="btn-close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formUpdateComplaint" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body p-3 p-md-4">
                        <div class="card bg-light border-0 mb-3 rounded-3" style="background: #faf8ff !important; border: 1px solid #efe6ff !important;">
                            <div class="card-body p-2.5 px-3">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <span class="badge-ticket" id="lblUpdateTicket">-</span>
                                    <span class="badge-priority sedang" id="lblUpdatePrioritas">-</span>
                                </div>
                                <h6 class="fw-bold text-dark mb-1 mt-1" id="lblUpdateJudul" style="font-size: 0.9rem;">-</h6>
                                <p class="text-muted small mb-0" id="lblUpdateDeskripsi">-</p>
                            </div>
                        </div>

                        <div class="row g-2">
                            <div class="col-md-6 mb-2">
                                <label class="form-label">Status Penanganan <span class="text-danger">*</span></label>
                                <select class="form-control form-select" name="status" id="selectUpdateStatus" required>
                                    <option value="diajukan">Diajukan</option>
                                    <option value="diproses">Diproses</option>
                                    <option value="pengecekan">Pengecekan</option>
                                    <option value="selesai">Selesai</option>
                                    <option value="ditolak">Ditolak</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label class="form-label">Petugas / Teknisi</label>
                                <input type="text" class="form-control" name="petugas_penanggung_jawab" id="inputUpdatePetugas" placeholder="Nama teknisi...">
                            </div>
                            <div class="col-12 mb-2">
                                <label class="form-label">Catatan Perbaikan</label>
                                <textarea class="form-control" name="catatan_perbaikan" id="inputUpdateCatatan" rows="2" placeholder="Catatan tindakan perbaikan..."></textarea>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label class="form-label">Biaya Perbaikan (Rp)</label>
                                <input type="text" class="form-control text-start font-monospace" id="inputUpdateBiayaDisplay" placeholder="Rp 0" oninput="formatRupiahInput(this, 'inputUpdateBiaya')">
                                <input type="hidden" name="biaya_perbaikan" id="inputUpdateBiaya" value="0">
                            </div>
                            <div class="col-md-6 mb-2">
                                <label class="form-label">Foto Hasil Perbaikan</label>
                                <div class="custom-file-upload-modern" data-default-text="Pilih Foto Penyelesaian">
                                    <input type="file" name="foto_penyelesaian" accept="image/*,application/pdf">
                                    <div class="custom-file-label-modern">
                                        <i class="mdi mdi-cloud-upload-outline"></i>
                                        <div class="custom-file-info-modern">
                                            <span class="file-name-text">Pilih Foto Penyelesaian</span>
                                            <small class="file-desc-text">Format: JPG, PNG, PDF (Maks. 5MB)</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer bg-white border-top py-2.5 px-3 px-md-4 d-flex justify-content-end gap-2">
                        <button type="button" class="btn btn-outline-secondary btn-sm px-3 rounded-2 fw-semibold" data-dismiss="modal" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-gradient-primary btn-sm px-4 fw-semibold text-white shadow-sm rounded-2">
                            <i class="mdi mdi-content-save me-1"></i> Simpan Progress
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    var itemCounter = 1;
    var savedScrollPos = 0;

    function formatRupiahInput(input, hiddenId) {
        var value = input.value.replace(/[^0-9]/g, '');
        var hiddenInput = document.getElementById(hiddenId);
        if (hiddenInput) {
            hiddenInput.value = value ? parseInt(value) : 0;
        }
        if (!value) {
            input.value = '';
            return;
        }
        input.value = 'Rp ' + parseInt(value, 10).toLocaleString('id-ID');
    }

    $(document).on('change', '.custom-file-upload-modern input[type="file"]', function(e) {
        var wrapper = $(this).closest('.custom-file-upload-modern');
        var nameText = wrapper.find('.file-name-text');
        var descText = wrapper.find('.file-desc-text');
        if (this.files && this.files.length > 0) {
            var file = this.files[0];
            var fileSize = (file.size / (1024 * 1024)).toFixed(2) + ' MB';
            wrapper.addClass('has-file');
            nameText.text(file.name);
            descText.text('Ukuran: ' + fileSize);
        } else {
            wrapper.removeClass('has-file');
            nameText.text(wrapper.data('default-text') || 'Pilih File');
            descText.text('Format: JPG, PNG, PDF (Maks. 5MB)');
        }
    });

    function openAddComplaintModal(event) {
        if (event) {
            event.preventDefault();
            event.stopPropagation();
        }
        savedScrollPos = window.scrollY || window.pageYOffset || document.documentElement.scrollTop;

        var modalEl = document.getElementById('modalAddComplaint');
        if (!modalEl) return;

        if (window.jQuery && typeof $(modalEl).modal === 'function') {
            $(modalEl).modal('show');
        } else if (window.bootstrap && bootstrap.Modal) {
            var modal = bootstrap.Modal.getOrCreateInstance(modalEl);
            modal.show();
        }

        setTimeout(function() {
            window.scrollTo({ top: savedScrollPos, behavior: 'instant' });
        }, 10);
    }

    function addComplaintItem() {
        var container = document.getElementById('complaintItemsContainer');
        var index = itemCounter++;
        var html = `
            <div class="complaint-item-card p-3 p-md-3 bg-white" data-index="${index}">
                <div class="d-flex justify-content-between align-items-center mb-2 pb-2 border-bottom">
                    <span class="fw-bold text-dark item-number-label" style="font-size: 0.88rem;">
                        <i class="mdi mdi-numeric-${index + 1}-circle text-primary me-1 fs-5 align-middle"></i> Keluhan #${index + 1}
                    </span>
                    <button type="button" class="btn btn-sm btn-outline-danger btn-remove-item" onclick="removeComplaintItem(this)" style="font-size: 0.75rem; padding: 0.2rem 0.5rem; border-radius: 6px;">
                        <i class="mdi mdi-trash-can-outline"></i> Hapus
                    </button>
                </div>
                <div class="row g-2">
                    <div class="col-md-6 mb-2">
                        <label class="form-label small fw-bold text-dark mb-1">Kategori Keluhan <span class="text-danger">*</span></label>
                        <select class="form-control form-select" name="items[${index}][kategori]" required>
                            <option value="">Pilih Kategori</option>
                            <option value="kebocoran">Kebocoran Atap / Talang / Dinding</option>
                            <option value="kelistrikan">Kelistrikan, Stopkontak & Lampu</option>
                            <option value="sanitasi_pipa">Sanitasi, Saluran Air & Kran</option>
                            <option value="pintu_jendela">Pintu, Jendela, Kunci & Kusen</option>
                            <option value="struktur_dinding">Retak Dinding / Plesteran</option>
                            <option value="finishing_cat">Cat Mengelupas / Keramik Pecah</option>
                            <option value="lainnya">Lainnya / Masalah Umum</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-2">
                        <label class="form-label small fw-bold text-dark mb-1">Tingkat Prioritas <span class="text-danger">*</span></label>
                        <select class="form-control form-select" name="items[${index}][prioritas]" required>
                            <option value="rendah">Rendah</option>
                            <option value="sedang" selected>Sedang</option>
                            <option value="tinggi">Tinggi</option>
                            <option value="darurat">Darurat</option>
                        </select>
                    </div>
                    <div class="col-12 mb-2">
                        <label class="form-label small fw-bold text-dark mb-1">Judul Keluhan <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="items[${index}][judul_keluhan]" placeholder="Judul keluhan..." required>
                    </div>
                    <div class="col-12 mb-2">
                        <label class="form-label small fw-bold text-dark mb-1">Deskripsi Keluhan <span class="text-danger">*</span></label>
                        <textarea class="form-control" name="items[${index}][deskripsi]" rows="2" placeholder="Detail rincian keluhan..." required></textarea>
                    </div>
                    <div class="col-12 mb-1">
                        <label class="form-label small fw-bold text-dark mb-1">Foto Bukti Keluhan (Opsional)</label>
                        <div class="custom-file-upload-modern" data-default-text="Pilih Foto Bukti">
                            <input type="file" name="items[${index}][foto_keluhan]" accept="image/*,application/pdf">
                            <div class="custom-file-label-modern">
                                <i class="mdi mdi-cloud-upload-outline"></i>
                                <div class="custom-file-info-modern">
                                    <span class="file-name-text">Pilih Foto Bukti</span>
                                    <small class="file-desc-text">Format: JPG, PNG, PDF (Maks. 5MB)</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `;
        container.insertAdjacentHTML('beforeend', html);
        updateItemNumbers();
    }

    function removeComplaintItem(btn) {
        var card = btn.closest('.complaint-item-card');
        if (card) {
            card.remove();
            updateItemNumbers();
        }
    }

    function updateItemNumbers() {
        var cards = document.querySelectorAll('#complaintItemsContainer .complaint-item-card');
        cards.forEach(function(card, idx) {
            var label = card.querySelector('.item-number-label');
            if (label) {
                label.innerHTML = `<i class="mdi mdi-numeric-${idx + 1}-circle text-primary me-1 fs-5 align-middle"></i> Keluhan #${idx + 1}`;
            }
            var removeBtn = card.querySelector('.btn-remove-item');
            if (removeBtn) {
                if (cards.length > 1) {
                    removeBtn.classList.remove('d-none');
                } else {
                    removeBtn.classList.add('d-none');
                }
            }
        });

        var countLabel = document.getElementById('lblItemCount');
        if (countLabel) {
            countLabel.innerHTML = `Total Keluhan: <strong>${cards.length} item</strong>`;
        }

        var submitBtn = document.getElementById('btnSubmitComplaints');
        if (submitBtn) {
            submitBtn.innerHTML = `<i class="mdi mdi-send me-1"></i> Ajukan (${cards.length}) Keluhan`;
        }
    }

    function handleUpdateComplaintClick(btn, event) {
        if (event) {
            event.preventDefault();
            event.stopPropagation();
        }
        try {
            var base64Data = btn.getAttribute('data-complaint');
            var jsonStr = decodeURIComponent(escape(window.atob(base64Data)));
            var complaint = JSON.parse(jsonStr);
            openUpdateProgressModal(complaint);
        } catch(e) {
            console.error('Error parsing complaint data', e);
        }
    }

    function openUpdateProgressModal(complaint) {
        savedScrollPos = window.scrollY || window.pageYOffset || document.documentElement.scrollTop;

        var form = document.getElementById('formUpdateComplaint');
        if (form) {
            form.action = '{{ url('/complaints') }}/' + complaint.id + '/update';
        }

        if (document.getElementById('lblUpdateTicket')) document.getElementById('lblUpdateTicket').innerText = complaint.ticket_number || '-';
        if (document.getElementById('lblUpdatePrioritas')) document.getElementById('lblUpdatePrioritas').innerText = (complaint.prioritas || 'SEDANG').toUpperCase();
        if (document.getElementById('lblUpdateJudul')) document.getElementById('lblUpdateJudul').innerText = complaint.judul_keluhan || '-';
        if (document.getElementById('lblUpdateDeskripsi')) document.getElementById('lblUpdateDeskripsi').innerText = complaint.deskripsi || '-';

        if (document.getElementById('selectUpdateStatus')) document.getElementById('selectUpdateStatus').value = complaint.status || 'diajukan';
        if (document.getElementById('inputUpdatePetugas')) document.getElementById('inputUpdatePetugas').value = complaint.petugas_penanggung_jawab || '';
        if (document.getElementById('inputUpdateCatatan')) document.getElementById('inputUpdateCatatan').value = complaint.catatan_perbaikan || '';
        
        var rawBiaya = parseInt(complaint.biaya_perbaikan) || 0;
        if (document.getElementById('inputUpdateBiaya')) document.getElementById('inputUpdateBiaya').value = rawBiaya;
        if (document.getElementById('inputUpdateBiayaDisplay')) {
            document.getElementById('inputUpdateBiayaDisplay').value = rawBiaya > 0 ? 'Rp ' + rawBiaya.toLocaleString('id-ID') : 'Rp 0';
        }

        // Reset file upload state in modal
        var updateFileWrap = $('#modalUpdateComplaint .custom-file-upload-modern');
        updateFileWrap.removeClass('has-file');
        updateFileWrap.find('input[type="file"]').val('');
        updateFileWrap.find('.file-name-text').text('Pilih Foto Penyelesaian');
        updateFileWrap.find('.file-desc-text').text('Format: JPG, PNG, PDF (Maks. 5MB)');

        var modalEl = document.getElementById('modalUpdateComplaint');
        if (!modalEl) return;

        if (window.jQuery && typeof $(modalEl).modal === 'function') {
            $(modalEl).modal('show');
        } else if (window.bootstrap && bootstrap.Modal) {
            var modal = bootstrap.Modal.getOrCreateInstance(modalEl);
            modal.show();
        }

        setTimeout(function() {
            window.scrollTo({ top: savedScrollPos, behavior: 'instant' });
        }, 10);
    }

    function confirmDeleteComplaint(id, ticket) {
        Swal.fire({
            title: 'Hapus Keluhan?',
            text: 'Data keluhan ' + (ticket ? '#' + ticket : '') + ' akan dihapus permanen dari sistem.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6e7881',
            confirmButtonText: '<i class="mdi mdi-trash-can"></i> Ya, Hapus',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                var form = document.createElement('form');
                form.method = 'POST';
                form.action = '{{ url("/complaints") }}/' + id;
                
                var csrf = document.createElement('input');
                csrf.type = 'hidden';
                csrf.name = '_token';
                csrf.value = '{{ csrf_token() }}';
                form.appendChild(csrf);

                var method = document.createElement('input');
                method.type = 'hidden';
                method.name = '_method';
                method.value = 'DELETE';
                form.appendChild(method);

                document.body.appendChild(form);
                form.submit();
            }
        });
    }

    document.addEventListener('DOMContentLoaded', function() {
        // Prevent scroll jump on Bootstrap modal events
        ['modalAddComplaint', 'modalUpdateComplaint'].forEach(function(modalId) {
            var el = document.getElementById(modalId);
            if (el) {
                el.addEventListener('show.bs.modal', function() {
                    savedScrollPos = window.scrollY || window.pageYOffset || document.documentElement.scrollTop;
                });
                el.addEventListener('shown.bs.modal', function() {
                    window.scrollTo({ top: savedScrollPos, behavior: 'instant' });
                });
                el.addEventListener('hidden.bs.modal', function() {
                    window.scrollTo({ top: savedScrollPos, behavior: 'instant' });
                });
            }
        });

        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: {!! json_encode(session('success')) !!},
                confirmButtonColor: '#9a55ff',
                timer: 3500,
                timerProgressBar: true
            });
        @endif

        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: {!! json_encode(session('error')) !!},
                confirmButtonColor: '#9a55ff'
            });
        @endif

        @if ($errors->any())
            Swal.fire({
                icon: 'error',
                title: 'Validasi Gagal!',
                html: {!! json_encode(implode('<br>', $errors->all())) !!},
                confirmButtonColor: '#9a55ff'
            });
        @endif
    });
</script>
@endpush
