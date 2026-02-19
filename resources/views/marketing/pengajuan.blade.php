@extends('layouts.partial.app')

@section('title', 'Pengajuan KPR - Property Management App')

@section('content')
    <link rel="stylesheet" href="{{ asset('assets/css/marketing/pengajuan.css') }}">

    <style>
        /* ===== MODERN FILE UPLOAD STYLING UNTUK HALAMAN PENGAJUAN KPR ===== */
        .pengajuan-file-upload-modern {
            position: relative;
            width: 100%;
            margin-bottom: 1rem;
        }

        .pengajuan-file-upload-modern input[type="file"] {
            position: absolute;
            opacity: 0;
            width: 100%;
            height: 100%;
            cursor: pointer;
            z-index: 2;
        }

        .pengajuan-file-upload-modern .pengajuan-file-label-modern {
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
            .pengajuan-file-upload-modern .pengajuan-file-label-modern {
                flex-direction: row;
                text-align: left;
                gap: 8px;
                padding: 0.75rem 1rem;
                min-height: auto;
            }
        }

        .pengajuan-file-upload-modern:hover .pengajuan-file-label-modern {
            border-color: #9a55ff;
            background: linear-gradient(135deg, #f1f0ff, #f8f9fa);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(154, 85, 255, 0.1);
        }

        .pengajuan-file-upload-modern .pengajuan-file-label-modern i {
            font-size: 1.6rem;
            color: #9a55ff;
            background: rgba(154, 85, 255, 0.1);
            padding: 8px;
            border-radius: 50%;
        }

        .pengajuan-file-upload-modern .pengajuan-file-label-modern .pengajuan-file-info-modern {
            flex: 1;
            width: 100%;
        }

        .pengajuan-file-upload-modern .pengajuan-file-label-modern .pengajuan-file-info-modern span {
            display: block;
            font-weight: 600;
            color: #2c2e3f;
            font-size: 0.8rem;
            word-break: break-word;
        }

        .pengajuan-file-upload-modern .pengajuan-file-label-modern .pengajuan-file-info-modern small {
            color: #6c7383;
            font-size: 0.65rem;
            display: block;
            margin-top: 2px;
        }

        .pengajuan-file-upload-modern .pengajuan-file-label-modern .pengajuan-file-size {
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
            .pengajuan-file-upload-modern .pengajuan-file-label-modern .pengajuan-file-size {
                margin-top: 0;
            }
        }

        /* View file button */
        .pengajuan-view-file-btn {
            background: linear-gradient(135deg, #28a745, #5cb85c);
            color: white;
            border: none;
            border-radius: 6px;
            padding: 0.25rem 0.5rem;
            font-size: 0.65rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 4px;
            width: 100%;
            margin-top: 4px;
            text-decoration: none;
        }

        .pengajuan-view-file-btn:hover {
            background: linear-gradient(135deg, #218838, #4cae4c);
            transform: translateY(-1px);
            box-shadow: 0 2px 5px rgba(40, 167, 69, 0.2);
            color: white;
            text-decoration: none;
        }

        /* File upload container dalam grid */
        .pengajuan-file-upload-wrapper {
            margin-bottom: 1rem;
        }

        .pengajuan-file-upload-wrapper label {
            font-size: 0.8rem;
            font-weight: 600;
            color: #9a55ff !important;
            margin-bottom: 0.3rem;
            letter-spacing: 0.3px;
            font-family: 'Nunito', sans-serif;
            display: block;
        }

        @media (max-width: 576px) {
            .pengajuan-file-upload-modern .pengajuan-file-label-modern {
                padding: 0.8rem 0.5rem;
                min-height: 80px;
            }

            .pengajuan-file-upload-modern .pengajuan-file-label-modern i {
                font-size: 1.4rem;
                padding: 6px;
            }

            .pengajuan-file-upload-modern .pengajuan-file-label-modern .pengajuan-file-info-modern span {
                font-size: 0.75rem;
            }

            .pengajuan-file-upload-modern .pengajuan-file-label-modern .pengajuan-file-info-modern small {
                font-size: 0.6rem;
            }
        }

        /* Required star styling */
        .pengajuan-text-danger {
            color: #dc3545 !important;
            font-size: 0.8rem;
        }

        /* Form styling konsisten */
        .pengajuan-form-group {
            margin-bottom: 1rem;
        }

        .pengajuan-form-group label {
            font-size: 0.8rem;
            font-weight: 600;
            color: #9a55ff !important;
            margin-bottom: 0.3rem;
            letter-spacing: 0.3px;
            font-family: 'Nunito', sans-serif;
            display: block;
        }

        /* Input group styling */
        .pengajuan-input-group {
            display: flex;
            align-items: stretch;
            width: 100%;
        }

        .pengajuan-input-group-prepend {
            display: flex;
        }

        .pengajuan-input-group-text {
            display: flex;
            align-items: center;
            padding: 0.7rem 0.8rem;
            font-size: 0.85rem;
            font-weight: 400;
            line-height: 1;
            color: #6c7383;
            text-align: center;
            white-space: nowrap;
            background: linear-gradient(135deg, #f8f9fa, #f1f3f5);
            border: 1px solid #e9ecef;
            border-radius: 10px 0 0 10px;
            border-right: none;
        }

        .pengajuan-input-group .pengajuan-form-control {
            border-radius: 0 10px 10px 0;
        }
    </style>

    <div class="container-fluid p-3 p-md-4">
        <!-- Header -->
        <div class="pengajuan-row mb-3 mb-md-4">
            <div class="pengajuan-col-12">
                <h3 class="text-dark fw-bold" style="color: #2c2e3f; margin-bottom: 0.25rem;">Form Pengajuan KPR</h3>
                <p class="pengajuan-text-muted small" style="margin-bottom: 0;">Lengkapi data pengajuan KPR untuk customer
                    yang sudah booking unit</p>
            </div>
        </div>

        <!-- Info Status -->
        <div class="pengajuan-row mb-3">
            <div class="pengajuan-col-12">
                <div class="pengajuan-card pengajuan-bg-light border-0">
                    <div class="pengajuan-card-body py-3">
                        <div class="d-flex flex-column flex-sm-row align-items-start align-items-sm-center gap-2">
                            <div>
                                <span class="pengajuan-badge pengajuan-badge-primary">Pengajuan Baru</span>
                            </div>
                            <div class="pengajuan-text-muted small d-flex align-items-center">
                                <i class="mdi mdi-calendar me-1 pengajuan-text-primary"></i>
                                <span>Tanggal: 14 Februari 2026</span>
                            </div>
                            <div class="ms-sm-auto mt-2 mt-sm-0">
                                <span class="pengajuan-badge pengajuan-badge-warning">Status: Draft</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Pengajuan KPR -->
        <div class="pengajuan-row">
            <div class="pengajuan-col-12">
                <div class="pengajuan-card">
                    <div
                        class="pengajuan-card-header d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-2">
                        <h4 class="mb-0 d-flex align-items-center">
                            <i class="mdi mdi-bank me-2 pengajuan-text-primary"></i>
                            Data Pengajuan KPR
                        </h4>
                    </div>
                    <div class="pengajuan-card-body">
                        <form class="pengajuan-form-sample" method="POST" action="{{ route('pengajuans.store') }}"
                            enctype="multipart/form-data">
                            @csrf

                            <!-- Alert Info -->
                            <div class="pengajuan-alert pengajuan-alert-info d-flex align-items-start gap-2 mb-4"
                                role="alert">
                                <i class="mdi mdi-information-outline mt-1 flex-shrink-0"></i>
                                <span>Pastikan data customer sudah lengkap di menu <strong>Tambah Customer</strong> sebelum
                                    mengajukan KPR.</span>
                            </div>

                            <!-- Search Customer -->
                            <div class="pengajuan-form-group" style="position: relative;">
                                <label for="searchCustomer">Cari Customer <span
                                        class="pengajuan-text-danger">*</span></label>
                                <div class="pengajuan-search-wrapper">
                                    <i class="mdi mdi-magnify pengajuan-search-icon"></i>
                                    <input type="text" class="pengajuan-search-input" id="searchCustomer"
                                        placeholder="Cari customer..." autocomplete="off">
                                </div>

                                <!-- Hidden inputs -->
                                <input type="hidden" name="customer_id" id="customer_id">
                                <input type="hidden" name="unit_id" id="unit_id">
                                <input type="hidden" name="marketing_id"
                                    value="{{ session('employee_id') }}">

                                <!-- Dropdown hasil pencarian -->
                                <div id="customerResults" class="pengajuan-search-results"></div>
                                <small class="pengajuan-text-muted">Ketik nama, NIK, atau unit</small>
                            </div>

                            <hr class="pengajuan-hr">

                            <!-- Detail Unit yang Dibooking -->
                            <div class="pengajuan-section-title">
                                <i class="mdi mdi-home-city"></i>
                                Detail Unit yang Dibooking
                            </div>
                            <div class="pengajuan-row">
                                <div class="pengajuan-col-12 pengajuan-col-sm-6 pengajuan-col-md-3">
                                    <div class="pengajuan-form-group">
                                        <label>Nama Unit</label>
                                        <input type="text" id="unit_name" class="pengajuan-form-control" readonly>
                                    </div>
                                </div>

                                <div class="pengajuan-col-6 pengajuan-col-sm-6 pengajuan-col-md-2">
                                    <div class="pengajuan-form-group">
                                        <label>Blok/No</label>
                                        <input type="text" id="unit_block" class="pengajuan-form-control" readonly>
                                    </div>
                                </div>

                                <div class="pengajuan-col-6 pengajuan-col-sm-6 pengajuan-col-md-3">
                                    <div class="pengajuan-form-group">
                                        <label>Harga Unit</label>
                                        <input type="text" id="unit_price" class="pengajuan-form-control" readonly>
                                    </div>
                                </div>

                                <div class="pengajuan-col-12 pengajuan-col-sm-6 pengajuan-col-md-4">
                                    <div class="pengajuan-form-group">
                                        <label>Status Booking</label>
                                        <input type="text" id="booking_status" class="pengajuan-form-control" readonly>
                                    </div>
                                </div>
                            </div>

                            <hr class="pengajuan-hr">

                            <!-- Data Pengajuan KPR -->
                            <div class="pengajuan-section-title">
                                <i class="mdi mdi-bank"></i>
                                Data Pengajuan KPR
                            </div>

                            <div class="pengajuan-row">
                                <div class="pengajuan-col-12 pengajuan-col-md-6">
                                    <div class="pengajuan-form-group">
                                        <label>Bank Tujuan <span class="pengajuan-text-danger">*</span></label>
                                        <select class="pengajuan-form-control" name="bank" required>
                                            <option value="">-- Pilih Bank --</option>
                                            <option>Bank ABC Syariah</option>
                                            <option>Bank Mandiri</option>
                                            <option>Bank BCA</option>
                                            <option>Bank BNI</option>
                                            <option>Bank BRI</option>
                                            <option>Bank BTN</option>
                                            <option>Bank CIMB Niaga</option>
                                            <option>Bank Danamon</option>
                                            <option>Bank Permata</option>
                                            <option>Bank Maybank</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="pengajuan-col-12 pengajuan-col-md-6">
                                    <div class="pengajuan-form-group">
                                        <label>Produk KPR</label>
                                        <select class="pengajuan-form-control" name="produkKpr">
                                            <option>KPR Subsidi</option>
                                            <option>KPR Non Subsidi</option>
                                            <option>KPR Syariah</option>
                                            <option>KPR Milenial</option>
                                            <option>KPR Pensiunan</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="pengajuan-row">
                                <div class="pengajuan-col-12 pengajuan-col-sm-6 pengajuan-col-md-4">
                                    <div class="pengajuan-form-group">
                                        <label>Jumlah Pinjaman <span class="pengajuan-text-danger">*</span></label>
                                        <div class="pengajuan-input-group">
                                            <div class="pengajuan-input-group-prepend"><span
                                                    class="pengajuan-input-group-text">Rp</span></div>
                                            <input type="text" class="pengajuan-form-control" name="jumlahPinjaman"
                                                placeholder="360.000.000" value="360.000.000" required>
                                        </div>
                                        <small class="pengajuan-text-muted">Maksimal 80%</small>
                                    </div>
                                </div>

                                <div class="pengajuan-col-12 pengajuan-col-sm-6 pengajuan-col-md-4">
                                    <div class="pengajuan-form-group">
                                        <label>Uang Muka (DP)</label>
                                        <div class="pengajuan-input-group">
                                            <div class="pengajuan-input-group-prepend"><span
                                                    class="pengajuan-input-group-text">Rp</span></div>
                                            <input type="text" class="pengajuan-form-control" name="down_payment"
                                                id="uangMuka" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="pengajuan-col-12 pengajuan-col-sm-6 pengajuan-col-md-4">
                                    <div class="pengajuan-form-group">
                                        <label>Tenor</label>
                                        <select class="pengajuan-form-control" name="installment_duration" required>
                                            <option value="">-- Pilih --</option>
                                            <option value="5">5 Tahun</option>
                                            <option value="10">10 Tahun</option>
                                            <option value="15">15 Tahun</option>
                                            <option value="20">20 Tahun</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="pengajuan-row">
                                <div class="pengajuan-col-12 pengajuan-col-sm-6 pengajuan-col-md-4">
                                    <div class="pengajuan-form-group">
                                        <label>Suku Bunga (%)</label>
                                        <div class="pengajuan-input-group">
                                            <input type="text" class="pengajuan-form-control" name="bunga"
                                                placeholder="7.5" value="7.5">
                                            <div class="pengajuan-input-group-prepend"><span
                                                    class="pengajuan-input-group-text">%</span></div>
                                        </div>
                                        <small class="pengajuan-text-muted">Per tahun</small>
                                    </div>
                                </div>

                                <div class="pengajuan-col-12 pengajuan-col-sm-6 pengajuan-col-md-4">
                                    <div class="pengajuan-form-group">
                                        <label>Estimasi Angsuran</label>
                                        <div class="pengajuan-input-group">
                                            <div class="pengajuan-input-group-prepend"><span
                                                    class="pengajuan-input-group-text">Rp</span></div>
                                            <input type="text" class="pengajuan-form-control"
                                                name="monthly_installment" id="angsuran">
                                        </div>
                                    </div>
                                </div>

                                <div class="pengajuan-col-12 pengajuan-col-sm-6 pengajuan-col-md-4">
                                    <div class="pengajuan-form-group">
                                        <label>Status Pekerjaan</label>
                                        <input type="text" class="pengajuan-form-control" name="statusPekerjaan"
                                            value="Karyawan Swasta">
                                    </div>
                                </div>
                            </div>

                            <hr class="pengajuan-hr">

                            <!-- Upload Dokumen dengan Modern Styling -->
                            <div class="pengajuan-section-title">
                                <i class="mdi mdi-file-document"></i>
                                Upload Dokumen Pendukung
                            </div>
                            <p class="pengajuan-text-muted small mb-3">Dokumen tambahan untuk pengajuan KPR</p>

                            <div class="pengajuan-row">
                                <div class="pengajuan-col-12 pengajuan-col-md-6">
                                    <div class="pengajuan-file-upload-wrapper">
                                        <label>Slip Gaji (3 bulan) <span class="pengajuan-text-danger">*</span></label>
                                        <div class="pengajuan-file-upload-modern">
                                            <input type="file" name="slipGaji" id="slipGaji" accept=".jpg,.jpeg,.png,.pdf">
                                            <div class="pengajuan-file-label-modern">
                                                <i class="mdi mdi-cloud-upload"></i>
                                                <div class="pengajuan-file-info-modern">
                                                    <span id="slipGaji-label">Upload Slip Gaji</span>
                                                    <small>Format: PDF, JPG, PNG (Max 2MB)</small>
                                                </div>
                                                <span class="pengajuan-file-size" id="slipGaji-size"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="pengajuan-col-12 pengajuan-col-md-6">
                                    <div class="pengajuan-file-upload-wrapper">
                                        <label>Rekening Tabungan (3 bulan) <span class="pengajuan-text-danger">*</span></label>
                                        <div class="pengajuan-file-upload-modern">
                                            <input type="file" name="rekening" id="rekening" accept=".jpg,.jpeg,.png,.pdf">
                                            <div class="pengajuan-file-label-modern">
                                                <i class="mdi mdi-cloud-upload"></i>
                                                <div class="pengajuan-file-info-modern">
                                                    <span id="rekening-label">Upload Rekening</span>
                                                    <small>Format: PDF, JPG, PNG (Max 2MB)</small>
                                                </div>
                                                <span class="pengajuan-file-size" id="rekening-size"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="pengajuan-row">
                                <div class="pengajuan-col-12 pengajuan-col-md-6">
                                    <div class="pengajuan-file-upload-wrapper">
                                        <label>NPWP</label>
                                        <div class="pengajuan-file-upload-modern">
                                            <input type="file" name="npwp" id="npwp" accept=".jpg,.jpeg,.png,.pdf">
                                            <div class="pengajuan-file-label-modern">
                                                <i class="mdi mdi-cloud-upload"></i>
                                                <div class="pengajuan-file-info-modern">
                                                    <span id="npwp-label">Upload NPWP</span>
                                                    <small>Format: PDF, JPG, PNG (Max 2MB)</small>
                                                </div>
                                                <span class="pengajuan-file-size" id="npwp-size"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="pengajuan-col-12 pengajuan-col-md-6">
                                    <div class="pengajuan-file-upload-wrapper">
                                        <label>Surat Keterangan Usaha</label>
                                        <div class="pengajuan-file-upload-modern">
                                            <input type="file" name="sku" id="sku" accept=".jpg,.jpeg,.png,.pdf">
                                            <div class="pengajuan-file-label-modern">
                                                <i class="mdi mdi-cloud-upload"></i>
                                                <div class="pengajuan-file-info-modern">
                                                    <span id="sku-label">Upload SKU</span>
                                                    <small>Format: PDF, JPG, PNG (Max 2MB)</small>
                                                </div>
                                                <span class="pengajuan-file-size" id="sku-size"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="pengajuan-row">
                                <div class="pengajuan-col-12 pengajuan-col-md-6">
                                    <div class="pengajuan-file-upload-wrapper">
                                        <label>Surat Nikah</label>
                                        <div class="pengajuan-file-upload-modern">
                                            <input type="file" name="suratNikah" id="suratNikah" accept=".jpg,.jpeg,.png,.pdf">
                                            <div class="pengajuan-file-label-modern">
                                                <i class="mdi mdi-cloud-upload"></i>
                                                <div class="pengajuan-file-info-modern">
                                                    <span id="suratNikah-label">Upload Surat Nikah</span>
                                                    <small>Format: PDF, JPG, PNG (Max 2MB)</small>
                                                </div>
                                                <span class="pengajuan-file-size" id="suratNikah-size"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="pengajuan-col-12 pengajuan-col-md-6">
                                    <div class="pengajuan-file-upload-wrapper">
                                        <label>KTP Pasangan</label>
                                        <div class="pengajuan-file-upload-modern">
                                            <input type="file" name="ktpPasangan" id="ktpPasangan" accept=".jpg,.jpeg,.png,.pdf">
                                            <div class="pengajuan-file-label-modern">
                                                <i class="mdi mdi-cloud-upload"></i>
                                                <div class="pengajuan-file-info-modern">
                                                    <span id="ktpPasangan-label">Upload KTP Pasangan</span>
                                                    <small>Format: PDF, JPG, PNG (Max 2MB)</small>
                                                </div>
                                                <span class="pengajuan-file-size" id="ktpPasangan-size"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr class="pengajuan-hr">

                            <div class="pengajuan-form-group">
                                <label>Catatan Tambahan</label>
                                <textarea class="pengajuan-form-control" name="catatan" rows="2"
                                    placeholder="Contoh: Penghasilan tambahan..."></textarea>
                            </div>

                            <div class="pengajuan-alert pengajuan-alert-info d-flex align-items-start gap-3 mb-4">
                                <i class="mdi mdi-account-tie" style="font-size: 24px;"></i>
                                <div>
                                    <strong>Ditangani oleh:</strong> Ahmad Rizki (Marketing Officer)<br>
                                    <small class="pengajuan-text-muted">Marketing yang menangani customer ini</small>
                                </div>
                            </div>

                            <div class="d-flex flex-column flex-sm-row justify-content-between gap-3 mt-4">
                                <a href="{{ url('/marketing/kpr') }}"
                                    class="pengajuan-btn pengajuan-btn-outline-secondary">Kembali</a>
                                <button type="submit" class="pengajuan-btn pengajuan-btn-primary">Submit</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Search customer functionality
    $('#searchCustomer').on('keyup', function() {
        let keyword = $(this).val();
        if (keyword.length < 2) {
            $('#customerResults').hide();
            return;
        }

        $.ajax({
            url: "{{ route('pengajuan.search-customer') }}",
            type: "GET",
            data: { keyword: keyword },
            success: function(data) {
                let html = '';
                if (data.length > 0) {
                    data.forEach(function(item) {
                        let unit = item.units ? item.units[0] : null;
                        html += `
                        <div class="result-item"
                             data-id="${item.id}"
                             data-name="${item.full_name}"
                             data-unit="${unit ? unit.type : ''}"
                             data-block="${unit ? unit.unit_code : ''}"
                             data-price="${unit ? unit.price : ''}"
                             data-status="${unit ? unit.status : ''}"
                             data-unit-id="${unit ? unit.id : ''}">
                            ${item.full_name} - ${item.nik}
                        </div>`;
                    });
                    $('#customerResults').html(html).show();
                } else {
                    $('#customerResults').html('<div class="p-2">Tidak ditemukan</div>').show();
                }
            }
        });
    });

    $(document).on('click', '.result-item', function() {
        let id = $(this).data('id');
        let name = $(this).data('name');
        let unit = $(this).data('unit');
        let block = $(this).data('block');
        let price = $(this).data('price');
        let status = $(this).data('status');
        let unitId = $(this).data('unit-id');

        $('#searchCustomer').val(name);
        $('#customer_id').val(id);
        $('#unit_id').val(unitId);
        $('#unit_name').val(unit);
        $('#unit_block').val(block);
        $('#unit_price').val(new Intl.NumberFormat('id-ID').format(price));
        $('#booking_status').val(status);
        $('#customerResults').hide();
    });

    // Modern file upload preview
    function initFileUpload(inputId, labelId, sizeId) {
        $('#' + inputId).on('change', function(e) {
            const fileName = e.target.files[0]?.name;
            const fileSize = e.target.files[0]?.size;

            if (fileName) {
                $('#' + labelId).text(fileName.length > 30 ? fileName.substring(0, 30) + '...' : fileName);
                if (fileSize) {
                    const sizeInMB = (fileSize / (1024 * 1024)).toFixed(2);
                    $('#' + sizeId).text(sizeInMB + ' MB');
                }
            } else {
                // Reset ke teks awal berdasarkan input
                if (inputId === 'slipGaji') {
                    $('#' + labelId).text('Upload Slip Gaji');
                } else if (inputId === 'rekening') {
                    $('#' + labelId).text('Upload Rekening');
                } else if (inputId === 'npwp') {
                    $('#' + labelId).text('Upload NPWP');
                } else if (inputId === 'sku') {
                    $('#' + labelId).text('Upload SKU');
                } else if (inputId === 'suratNikah') {
                    $('#' + labelId).text('Upload Surat Nikah');
                } else if (inputId === 'ktpPasangan') {
                    $('#' + labelId).text('Upload KTP Pasangan');
                }
                $('#' + sizeId).text('');
            }
        });
    }

    // Initialize file upload previews
    initFileUpload('slipGaji', 'slipGaji-label', 'slipGaji-size');
    initFileUpload('rekening', 'rekening-label', 'rekening-size');
    initFileUpload('npwp', 'npwp-label', 'npwp-size');
    initFileUpload('sku', 'sku-label', 'sku-size');
    initFileUpload('suratNikah', 'suratNikah-label', 'suratNikah-size');
    initFileUpload('ktpPasangan', 'ktpPasangan-label', 'ktpPasangan-size');
});
</script>
@endpush
