@extends('layouts.partial.app')

@section('title', 'Pengajuan KPR - Property Management App')

@section('content')
    <link rel="stylesheet" href="{{ asset('assets/css/marketing/pengajuan.css') }}">

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
                            <!-- Search Customer -->
                            <div class="pengajuan-form-group" style="position: relative;">

                                <label for="searchCustomer">
                                    Cari Customer
                                    <span class="pengajuan-text-danger">*</span>
                                </label>

                                <div class="pengajuan-search-wrapper">
                                    <i class="mdi mdi-magnify pengajuan-search-icon"></i>
                                    <input type="text" class="pengajuan-search-input" id="searchCustomer"
                                        placeholder="Cari customer..." autocomplete="off">
                                </div>

                                <!-- Hidden ID untuk dikirim ke server -->
                                <input type="hidden" name="customer_id" id="customer_id">

                                <!-- Dropdown hasil pencarian -->
                                <div id="customerResults" class="pengajuan-search-results"></div>

                                <small class="pengajuan-text-muted">
                                    Ketik nama, NIK, atau unit
                                </small>

                            </div>


                            <hr class="pengajuan-hr">

                            <div class="pengajuan-section-title">
                                <i class="mdi mdi-home-city"></i>
                                Detail Unit yang Dibooking
                            </div>

                            <!-- Info Unit -->
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

                            <div class="pengajuan-section-title">
                                <i class="mdi mdi-bank"></i>
                                Data Pengajuan KPR
                            </div>

                            <div class="pengajuan-row">
                                <div class="pengajuan-col-12 pengajuan-col-md-6">
                                    <!-- Pilih Bank -->
                                    <div class="pengajuan-form-group">
                                        <label for="bank">Bank Tujuan <span
                                                class="pengajuan-text-danger">*</span></label>
                                        <select class="pengajuan-form-control" id="bank" name="bank" required>
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
                                    <!-- Produk KPR -->
                                    <div class="pengajuan-form-group">
                                        <label for="produkKpr">Produk KPR</label>
                                        <select class="pengajuan-form-control" id="produkKpr" name="produkKpr">
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
                                    <!-- Jumlah Pinjaman -->
                                    <div class="pengajuan-form-group">
                                        <label for="jumlahPinjaman">Jumlah Pinjaman <span
                                                class="pengajuan-text-danger">*</span></label>
                                        <div class="pengajuan-input-group">
                                            <div class="pengajuan-input-group-prepend">
                                                <span class="pengajuan-input-group-text">Rp</span>
                                            </div>
                                            <input type="text" class="pengajuan-form-control" id="jumlahPinjaman"
                                                name="jumlahPinjaman" placeholder="360.000.000" value="360.000.000"
                                                required>
                                        </div>
                                        <small class="pengajuan-text-muted">Maksimal 80%</small>
                                    </div>
                                </div>
                                <div class="pengajuan-col-12 pengajuan-col-sm-6 pengajuan-col-md-4">
                                    <!-- Uang Muka (DP) -->
                                    <div class="pengajuan-form-group">
                                        <label>Uang Muka (DP)</label>
                                        <div class="pengajuan-input-group">
                                            <div class="pengajuan-input-group-prepend">
                                                <span class="pengajuan-input-group-text">Rp</span>
                                            </div>
                                            <input type="text" class="pengajuan-form-control" id="uangMuka"
                                                name="down_payment" required>
                                        </div>
                                    </div>

                                </div>
                                <div class="pengajuan-col-12 pengajuan-col-sm-6 pengajuan-col-md-4">
                                    <!-- Tenor -->
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
                                    <!-- Suku Bunga -->
                                    <div class="pengajuan-form-group">
                                        <label for="bunga">Suku Bunga (%)</label>
                                        <div class="pengajuan-input-group">
                                            <input type="text" class="pengajuan-form-control" id="bunga"
                                                name="bunga" placeholder="7.5" value="7.5">
                                            <div class="pengajuan-input-group-prepend">
                                                <span class="pengajuan-input-group-text">%</span>
                                            </div>
                                        </div>
                                        <small class="pengajuan-text-muted">Per tahun</small>
                                    </div>
                                </div>
                                <div class="pengajuan-col-12 pengajuan-col-sm-6 pengajuan-col-md-4">
                                    <!-- Estimasi Angsuran -->
                                    <div class="pengajuan-form-group">
                                        <label>Estimasi Angsuran</label>
                                        <div class="pengajuan-input-group">
                                            <div class="pengajuan-input-group-prepend">
                                                <span class="pengajuan-input-group-text">Rp</span>
                                            </div>
                                            <input type="text" class="pengajuan-form-control" id="angsuran"
                                                name="monthly_installment">
                                        </div>
                                    </div>

                                </div>
                                <div class="pengajuan-col-12 pengajuan-col-sm-6 pengajuan-col-md-4">
                                    <!-- Status Pekerjaan -->
                                    <div class="pengajuan-form-group">
                                        <label for="statusPekerjaan">Status Pekerjaan</label>
                                        <input type="text" class="pengajuan-form-control" id="statusPekerjaan"
                                            name="statusPekerjaan" value="Karyawan Swasta">
                                    </div>
                                </div>
                            </div>

                            <hr class="pengajuan-hr">

                            <div class="pengajuan-section-title">
                                <i class="mdi mdi-file-document"></i>
                                Upload Dokumen Pendukung
                            </div>
                            <p class="pengajuan-text-muted small mb-3">Dokumen tambahan untuk pengajuan KPR</p>

                            <div class="pengajuan-row">
                                <div class="pengajuan-col-12 pengajuan-col-md-6">
                                    <div class="pengajuan-form-group">
                                        <label for="slipGaji">Slip Gaji (3 bulan) <span
                                                class="pengajuan-text-danger">*</span></label>
                                        <div class="pengajuan-file-upload">
                                            <input type="file" id="slipGaji" name="slipGaji"
                                                accept=".jpg,.jpeg,.png,.pdf">
                                            <div class="pengajuan-file-label">
                                                <i class="mdi mdi-cloud-upload"></i>
                                                <div class="pengajuan-file-info">
                                                    <span>Upload Slip Gaji</span>
                                                    <small>Max 5MB</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="pengajuan-col-12 pengajuan-col-md-6">
                                    <div class="pengajuan-form-group">
                                        <label for="rekening">Rekening Tabungan (3 bulan) <span
                                                class="pengajuan-text-danger">*</span></label>
                                        <div class="pengajuan-file-upload">
                                            <input type="file" id="rekening" name="rekening"
                                                accept=".jpg,.jpeg,.png,.pdf">
                                            <div class="pengajuan-file-label">
                                                <i class="mdi mdi-cloud-upload"></i>
                                                <div class="pengajuan-file-info">
                                                    <span>Upload Rekening</span>
                                                    <small>Max 5MB</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="pengajuan-row">
                                <div class="pengajuan-col-12 pengajuan-col-md-6">
                                    <div class="pengajuan-form-group">
                                        <label for="npwp">NPWP</label>
                                        <div class="pengajuan-file-upload">
                                            <input type="file" id="npwp" name="npwp"
                                                accept=".jpg,.jpeg,.png,.pdf">
                                            <div class="pengajuan-file-label">
                                                <i class="mdi mdi-cloud-upload"></i>
                                                <div class="pengajuan-file-info">
                                                    <span>Upload NPWP</span>
                                                    <small>Max 5MB</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="pengajuan-col-12 pengajuan-col-md-6">
                                    <div class="pengajuan-form-group">
                                        <label for="sku">Surat Keterangan Usaha</label>
                                        <div class="pengajuan-file-upload">
                                            <input type="file" id="sku" name="sku"
                                                accept=".jpg,.jpeg,.png,.pdf">
                                            <div class="pengajuan-file-label">
                                                <i class="mdi mdi-cloud-upload"></i>
                                                <div class="pengajuan-file-info">
                                                    <span>Upload SKU</span>
                                                    <small>Max 5MB</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="pengajuan-row">
                                <div class="pengajuan-col-12 pengajuan-col-md-6">
                                    <div class="pengajuan-form-group">
                                        <label for="suratNikah">Surat Nikah</label>
                                        <div class="pengajuan-file-upload">
                                            <input type="file" id="suratNikah" name="suratNikah"
                                                accept=".jpg,.jpeg,.png,.pdf">
                                            <div class="pengajuan-file-label">
                                                <i class="mdi mdi-cloud-upload"></i>
                                                <div class="pengajuan-file-info">
                                                    <span>Upload Surat Nikah</span>
                                                    <small>Max 5MB</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="pengajuan-col-12 pengajuan-col-md-6">
                                    <div class="pengajuan-form-group">
                                        <label for="ktpPasangan">KTP Pasangan</label>
                                        <div class="pengajuan-file-upload">
                                            <input type="file" id="ktpPasangan" name="ktpPasangan"
                                                accept=".jpg,.jpeg,.png,.pdf">
                                            <div class="pengajuan-file-label">
                                                <i class="mdi mdi-cloud-upload"></i>
                                                <div class="pengajuan-file-info">
                                                    <span>Upload KTP Pasangan</span>
                                                    <small>Max 5MB</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr class="pengajuan-hr">

                            <!-- Catatan Tambahan -->
                            <div class="pengajuan-form-group">
                                <label for="catatan" class="pengajuan-text-primary">Catatan Tambahan</label>
                                <textarea class="pengajuan-form-control" id="catatan" name="catatan" rows="2"
                                    placeholder="Contoh: Penghasilan tambahan..."></textarea>
                            </div>

                            <!-- Info Marketing -->
                            <div class="pengajuan-alert pengajuan-alert-info d-flex align-items-start gap-3 mb-4"
                                role="alert">
                                <i class="mdi mdi-account-tie" style="font-size: 24px;"></i>
                                <div>
                                    <strong>Ditangani oleh:</strong> Ahmad Rizki (Marketing Officer)<br>
                                    <small class="pengajuan-text-muted">Marketing yang menangani customer ini</small>
                                </div>
                            </div>

                            <!-- Tombol Aksi -->
                            <div class="d-flex flex-column flex-sm-row justify-content-between gap-3 mt-4">
                                <div class="d-flex flex-wrap gap-2 w-100 w-sm-auto">
                                    <a href="{{ url('/marketing/kpr') }}"
                                        class="pengajuan-btn pengajuan-btn-outline-secondary flex-grow-1 flex-sm-grow-0">
                                        <i class="mdi mdi-arrow-left me-1"></i>Kembali
                                    </a>
                                    <button type="reset"
                                        class="pengajuan-btn pengajuan-btn-secondary flex-grow-1 flex-sm-grow-0">
                                        <i class="mdi mdi-refresh me-1"></i>Reset
                                    </button>
                                </div>
                                <div class="d-flex flex-wrap gap-2 w-100 w-sm-auto justify-content-end">
                                    <button type="button"
                                        class="pengajuan-btn pengajuan-btn-outline-primary flex-grow-1 flex-sm-grow-0">
                                        <i class="mdi mdi-content-save me-1"></i>Simpan Draft
                                    </button>
                                    <button type="submit"
                                        class="pengajuan-btn pengajuan-btn-primary flex-grow-1 flex-sm-grow-0">
                                        <i class="mdi mdi-send me-1"></i>Submit
                                    </button>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            $('#searchCustomer').on('keyup', function() {

                let keyword = $(this).val();

                if (keyword.length < 2) {
                    $('#customerResults').hide();
                    return;
                }

                $.ajax({
                    url: "{{ route('pengajuan.search-customer') }}",
                    type: "GET",
                    data: {
                        keyword: keyword
                    },
                    success: function(data) {

                        let html = '';

                        if (data.length > 0) {

                            data.forEach(function(item) {
                                html += `
                        <div class="result-item" 
                             data-id="${item.id}"
                             data-name="${item.full_name}"
                             data-unit="${item.units ? item.units[0].type : ''}"
                             data-block="${item.units ? item.units[0].unit_code : ''}"
                             data-price="${item.units ? item.units[0].price : ''}"
                             data-status="${item.units ? item.units[0].status : ''}">
                            ${item.full_name} - ${item.nik}
                        </div>
                    `;
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

                $('#searchCustomer').val(name);
                $('#customer_id').val(id);

                $('#unit_name').val(unit);
                $('#unit_block').val(block);
                $('#unit_price').val(new Intl.NumberFormat('id-ID').format(price));
                $('#booking_status').val(status);

                $('#customerResults').hide();
            });
            / Bersihkan format titik sebelum submit
            $('form').on('submit', function() {
                let dp = $('input[name="down_payment"]').val();
                let angsuran = $('input[name="monthly_installment"]').val();

                if (dp) $('input[name="down_payment"]').val(dp.replace(/\./g, ''));
                if (angsuran) $('input[name="monthly_installment"]').val(angsuran.replace(/\./g, ''));
            });
        </script>
    @endpush
@endsection
