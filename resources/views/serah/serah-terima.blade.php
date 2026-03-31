@extends('layouts.partial.app')

@section('title', 'Serah Terima Unit - Properti Management')

@section('content')
    <style>
        /* CSS KHUSUS HALAMAN SERAH TERIMA (Tidak ada di Global) */
        .serah-checklist-wrapper {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 12px;
        }

        .serah-checklist-item .check-label {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 1rem;
            background: #fff;
            border: 2px solid var(--gray-200);
            border-radius: var(--radius-xl);
            cursor: pointer;
            transition: all 0.25s ease;
            min-height: 84px;
        }

        .serah-checklist-item .check-label:hover {
            border-color: var(--primary-light);
            background: #faf7ff;
            transform: translateY(-2px);
        }

        .serah-checklist-item input[type="checkbox"]:checked + .check-label {
            border-color: var(--primary);
            background: #f7f2ff;
        }

        .check-icon {
            width: 42px;
            height: 42px;
            border-radius: var(--radius-md);
            background: #f4ecff;
            color: #bdb5cf;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .serah-checklist-item input[type="checkbox"]:checked + .check-label .check-icon {
            color: var(--primary);
            background: #ede1ff;
        }

        /* Override Green Version untuk Persetujuan */
        .approval-check-green input[type="checkbox"]:checked + .check-label {
            border-color: var(--success);
            background: var(--success-bg);
        }
        .approval-check-green input[type="checkbox"]:checked + .check-label .check-icon {
            color: var(--success);
            background: #d9f3e6;
        }

        @media (max-width: 767.98px) {
            .serah-checklist-wrapper { grid-template-columns: 1fr; }
        }
    </style>

    <div class="transaksi-page">
        {{-- Card Header Customer --}}
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="customer-header d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between gap-3">
                            <div class="d-flex align-items-center gap-3">
                                <div class="customer-avatar">
                                    <i class="mdi mdi-account text-white"></i>
                                </div>
                                <div>
                                    <h4 class="customer-name mb-1">
                                        {{ $booking->customer->full_name ?? '-' }}
                                        @php
                                            $jenis = strtolower($booking->unit->jenis ?? '');
                                            $badgeClass = $jenis == 'subsidi' ? 'badge-gradient-success' : ($jenis == 'komersil' ? 'badge-gradient-primary' : 'badge-gradient-secondary');
                                        @endphp
                                        <span class="badge {{ $badgeClass }} ms-2">
                                            {{ strtoupper($booking->unit->jenis ?? '-') }}
                                        </span>
                                    </h4>
                                    <p class="customer-booking mb-0">Kode Booking: {{ $booking->booking_code }}</p>
                                </div>
                            </div>

                            <div class="customer-unit-info">
                                <div class="info-item">
                                    <small>Unit</small>
                                    <span>{{ $booking->unit->landBank->name }}</span>
                                </div>
                                <div class="info-item">
                                    <small>Blok/No</small>
                                    <span>{{ $booking->unit->unit_code }}</span>
                                </div>
                                <div class="info-item">
                                    <small>Harga</small>
                                    <span class="text-primary fw-bold">Rp {{ number_format($booking->unit->price, 0, ',', '.') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Progress & Summary --}}
        <div class="row mt-4">
            <div class="col-12 col-lg-8 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="transaksi-section-title">
                            <i class="mdi mdi-timeline-text"></i>
                            <span>Tahapan Serah Terima Unit</span>
                        </div>

                        <div class="transaksi-progress">
                            <div class="transaksi-progress-bar" style="width: 100%;"></div>
                        </div>

                        <div class="transaksi-steps">
                            <div class="transaksi-step completed">
                                <div class="transaksi-step-icon"><i class="mdi mdi-check"></i></div>
                                <span class="transaksi-step-title">Booking</span>
                            </div>
                            <div class="transaksi-step completed">
                                <div class="transaksi-step-icon"><i class="mdi mdi-check"></i></div>
                                <span class="transaksi-step-title">Akad</span>
                            </div>
                            <div class="transaksi-step active">
                                <div class="transaksi-step-icon"><i class="mdi mdi-key"></i></div>
                                <span class="transaksi-step-title">Serah Terima</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-4 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="transaksi-section-title">
                            <i class="mdi mdi-cash-multiple"></i>
                            <span>Status Pembayaran</span>
                        </div>
                        <div class="transaksi-detail-list">
                            <div class="transaksi-detail-item">
                                <span>Status</span>
                                <span class="badge bg-success">Lunas</span>
                            </div>
                            <div class="transaksi-detail-item">
                                <span>Metode</span>
                                <span class="badge bg-primary text-white">{{ strtoupper($booking->purchase_type) }}</span>
                            </div>
                        </div>
                        <hr class="my-4">
                        <div class="transaksi-handler">
                            <div class="transaksi-handler-icon"><i class="mdi mdi-account-tie"></i></div>
                            <div><div class="fw-bold">{{ $booking->sales->name }}</div></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Form Serah Terima --}}
        <form action="{{ route('serah-terima.store', $booking->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-12 col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="transaksi-section-title">
                                <i class="mdi mdi-key"></i>
                                <span>Form Serah Terima Unit</span>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="serah-form-label">Tanggal Serah Terima</label>
                                    <input type="date" name="tanggal_serah_terima" class="serah-form-control" value="{{ date('Y-m-d') }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="serah-form-label">No. BAST</label>
                                    <input type="text" class="serah-form-control" value="Auto Generate" readonly>
                                </div>
                            </div>

                            <hr class="my-4">

                            <div class="transaksi-section-title mb-3">
                                <i class="mdi mdi-home-check-outline"></i>
                                <span>Checklist Kondisi Unit</span>
                            </div>

                            <div class="serah-checklist-wrapper">
                                @foreach (['Listrik normal', 'Air Bersih', 'Kunci Lengkap', 'Dinding/Plafon', 'Lantai Baik', 'Sanitasi'] as $index => $item)
                                    <div class="serah-checklist-item">
                                        <input type="checkbox" name="items[{{ $index }}][checked]" value="1" id="item_{{ $index }}" hidden>
                                        <label for="item_{{ $index }}" class="check-label">
                                            <span class="check-icon"><i class="mdi mdi-check-circle"></i></span>
                                            <span class="check-text">{{ $item }}</span>
                                        </label>
                                    </div>
                                @endforeach
                            </div>

                            <hr class="my-4">

                            <div class="transaksi-section-title mb-3">
                                <i class="mdi mdi-camera-outline"></i>
                                <span>Dokumentasi</span>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="serah-form-label">Foto Serah Kunci</label>
                                    <div class="serah-file-upload-modern">
                                        <input type="file" name="foto_serah_kunci" accept="image/*">
                                        <div class="serah-file-label-modern">
                                            <i class="mdi mdi-cloud-upload"></i>
                                            <div class="serah-file-info-modern">
                                                <span>Upload Foto Kunci</span>
                                                <small>Max 5MB</small>
                                            </div>
                                            <span class="serah-file-size"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="serah-form-label">Foto Kondisi Unit</label>
                                    <div class="serah-file-upload-modern">
                                        <input type="file" name="foto_kondisi_unit" accept="image/*">
                                        <div class="serah-file-label-modern">
                                            <i class="mdi mdi-cloud-upload"></i>
                                            <div class="serah-file-info-modern">
                                                <span>Upload Foto Unit</span>
                                                <small>Max 5MB</small>
                                            </div>
                                            <span class="serah-file-size"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Sidebar Action --}}
                <div class="col-12 col-lg-4">
                    <div class="transaksi-sticky">
                        <div class="card">
                            <div class="card-body">
                                <div class="transaksi-sidebar-section">
                                    <div class="transaksi-sidebar-title">Konfirmasi Akhir</div>
                                    <div class="serah-checklist-item approval-check-green">
                                        <input type="checkbox" name="persetujuan" id="persetujuan" required hidden>
                                        <label for="persetujuan" class="check-label">
                                            <span class="check-icon"><i class="mdi mdi-check-circle"></i></span>
                                            <span class="check-text">Saya menyatakan unit diterima dalam kondisi baik.</span>
                                        </label>
                                    </div>
                                </div>

                                <button type="submit" class="serah-btn serah-btn-success mt-3">
                                    <i class="mdi mdi-check-decagram"></i> Selesaikan Serah Terima
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('.serah-file-upload-modern input[type="file"]').change(function(e) {
                const file = e.target.files[0];
                const $container = $(this).closest('.serah-file-upload-modern');
                const label = $container.find('.serah-file-info-modern span');
                const sizeSpan = $container.find('.serah-file-size');

                if (file) {
                    const fileSize = (file.size / (1024 * 1024)).toFixed(2);
                    label.text(file.name.length > 25 ? file.name.substring(0, 25) + "..." : file.name);
                    sizeSpan.text(fileSize + ' MB').css('display', 'inline-block');
                }
            });
        });
    </script>
@endpush
